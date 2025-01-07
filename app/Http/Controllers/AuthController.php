<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Requests;
use Illuminate\Support\Facades\Auth;
use \App\Models\Persons;

class AuthController extends Controller {

    public function login() {

        return view('auth.login');

    }

    public function doLogin(LoginRequest $request){



        $credentials = $request->validated();

        

        $persons = Persons::where('EMAIL', $credentials['EMAIL'])->first();

        Auth::attempt($credentials);
    
        Auth::login($persons);

        Auth::user();

    }

}