<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    public function login() {

        return view('auth.login');

    }

    public function doLogin(LoginRequest $request){

        //$credentials = $request->validated();

        dd(\App\Models\Persons::find(1));

        //Auth::attempt($credentials);
    }

}