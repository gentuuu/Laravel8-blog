<?php

namespace App\Http\Controllers;


class LocalizationController extends Controller
{
   //pierwszy sposób
    // public function __invoke($language = 'en')
    // {
    //     request()->session()->put('locale', $language);
    //     return redirect()->back();
    // }

     //drugi sposób
     public function switch($language = 'en')
     {
         request()->session()->put('locale', $language);
         return redirect()->back();
     }
}
