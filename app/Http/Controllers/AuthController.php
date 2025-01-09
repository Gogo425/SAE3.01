<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    
    public function login(){
        return view('login');
    }

    public function doLogin(Request $request){
        
        if(Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password']
        ])){
            session()->regenerate();

            return view('home');
        }

        return view('home');
    }

    public function doLogout(){

        Auth::logout();

        return view('login');
    }

}
