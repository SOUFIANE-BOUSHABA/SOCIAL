<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function show(){
        return view('front-office.users');
    }

    public function search($value){
        dump($value);
        return 'hhhh';
    }
}
