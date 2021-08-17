<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('users.index',[
            'users' => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "name" => "required|string|max:30",
                "role" => "required" ,
                "email" => "required|email|unique:users,email",
                "password" => "required|min:6|confirmed"   
            ],
            [],
            $this->attributes()
        );

        if ($validator->fails()){
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try{
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->assignRole($request->role);
            Alert::success(
                trans('users.alert.create.title'),
                trans('users.alert.create.message.success')
            );
            return redirect()->route('users.index');
        } catch(\Throwable $th){
            DB::rollBack();
            Alert::error(
                trans('users.alert.create.title'),
                trans('users.alert.create.message.error', ['error' => $th->getMessage()])
            );
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally{
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roleSelected' => $user->roles->first()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make(
            $request->all(),
            [
                "role" => "required",
            ],
            [],
            $this->attributes()
        );

        if ($validator->fails()){
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try{
            $user->syncRoles($request->role);
            Alert::success(
                trans('users.alert.update.title'),
                trans('users.alert.update.message.success')
            );
            return redirect()->route('users.index');
        } catch(\Throwable $th){
            DB::rollBack();
            Alert::error(
                trans('users.alert.update.title'),
                trans('users.alert.update.message.error', ['error' => $th->getMessage()])
            );
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        } finally{
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try{
            $user->removeRole($user->roles->first());
            $user->delete();
            Alert::success(
                trans('users.alert.delete.title'),
                trans('users.alert.delete.message.success')
            );
        } catch(\Throwable $th){
            DB::rollBack();
            Alert::error(
                trans('users.alert.delete.title'),
                trans('users.alert.delete.message.error', ['error' => $th->getMessage()])
            );
        } finally{
            DB::commit();
            return redirect()->back();
        }
    }

    private function attributes(){
        return [
            "name" => trans('users.form_control.input.name.attribute'),
            "role" => trans('users.form_control.input.role.attribute'),
            "email" => trans('users.form_control.input.email.attribute'),
            "password" => trans('users.form_control.input.password.attribute'),
        ];
    }
}
