<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Auth;
use \App\Models\Persons;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller {

    public function login() {

        return view('auth.login');

    }

    public function doLogin(LoginRequest $request){
        $credentials = $request->validated();

        $user = Persons::where('EMAIL', $credentials['EMAIL'])->first();

        if( Auth::attempt($credentials, true) ){
            //Auth::login($user);
            return view('auth.profile');
        }

        return redirect('login');

    }

}