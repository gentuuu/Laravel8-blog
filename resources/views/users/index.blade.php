@extends('layouts.dashboard')

@section('title')
    {{ trans('users.title.index')}}
@endsection

@section('breadcrumbs')
    {{ Breadcrumbs::render('users') }}
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
       <div class="card">
          <div class="card-header">
             <div class="row">
                <div class="col-md-6">
                   <form action="" method="GET">
                      <div class="input-group">
                         <input name="keyword" value="" type="search" class="form-control" placeholder="">
                         <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                               <i class="fas fa-search"></i>
                            </button>
                         </div>
                      </div>
                   </form>
                </div>
                <div class="col-md-6">
                   <a href="" class="btn btn-primary float-right" role="button">
                      Create
                      <i class="fas fa-plus-square"></i>
                   </a>
                </div>
             </div>
          </div>
          <div class="card-body">
             <div class="row">
                @forelse ($users as $item)
                <div class="col-md-4">
                    <div class="card my-1">
                       <div class="card-body">
                          <div class="row">
                             <div class="col-md-2">
                                <i class="fas fa-id-badge fa-5x"></i>
                             </div>
                             <div class="col-md-10">
                                <table>
                                   <tr>
                                      <th>
                                        {{ trans('users.label.name')}}
                                      </th>
                                      <td>:</td>
                                      <td>
                                         {{ $item->name }}
                                      </td>
                                   </tr>
                                   <tr>
                                      <th>
                                        {{ trans('users.label.email')}}
                                      </th>
                                      <td>:</td>
                                      <td>
                                        {{ $item->email }}
                                      </td>
                                   </tr>
                                   <tr>
                                      <th>
                                        {{ trans('users.label.role')}}
                                      </th>
                                      <td>:</td>
                                      <td>
                                        {{ $item->roles->first()->name }}
                                      </td>
                                   </tr>
                                </table>
                             </div>
                          </div>
                          <div class="float-right">
                             <!-- edit -->
                             <a href="{{ route('users.edit', ['user' => $item]) }}" class="btn btn-sm btn-info" role="button">
                                <i class="fas fa-edit"></i>
                             </a>
                             <!-- delete -->
                             <form class="d-inline" role="alert"
                                 alert-text="{{ trans('users.alert.delete.message.confirm', ['name' => $item->name]) }}" 
                                 action="{{ route('users.destroy', ['user'=> $item]) }}" method="POST">
                                 @csrf
                                 @method('DELETE')
                                 <button type="submit" class="btn btn-sm btn-danger">
                                     <i class="fas fa-trash"></i>
                                 </button>
                             </form>
                          </div>
                       </div>
                    </div>
                 </div>
                @empty
                    <p>
                        <strong>
                            {{ trans('users.label.no_data.fetch') }}
                        </strong>
                    </p>
                @endforelse
             </div>
          </div>
          <div class="card-footer">
             <!-- Todo:paginate -->
          </div>
       </div>
    </div>
 </div>
@endsection


@push('javascript-internal')
<script>
    $(document).ready(function(){
        $("form[role='alert']").submit(function(event){
            event.preventDefault();
            Swal.fire({
            title: "{{trans('users.alert.delete.title')}}",
            text: $(this).attr('allert-text'),
            icon: 'warning',
            allowOutsideClick: false,
            showCancelButton: true,
            cancelButtonText: "{{trans('users.button.cancel.value')}}",
            reverseButtons: true,
            confirmButtonText: "{{trans('users.button.delete.value')}}",
            }).then((result) => {
            if (result.isConfirmed) {
                event.target.submit();
            }
            });
        });
    });
</script>
    
@endpush