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
        
        if (Auth::attempt($request->only('email', 'password'))) {
            session()->regenerate();
            return  redirect()->route('home')->with('sucess', 'Session ajouté avec succès');        }
    

     
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return redirect()->route('login')->withErrors([
                    'email' => 'Il n\'y a pas de compte avec cette adresse mail',
                ]);
            }
        
            
            if (!Hash::check($request->password, $user->password)) {
                
                return redirect()->route('login')->withErrors([
                    'password' => 'Le mot de passe est incorrect.',
                ]);
            }


    }

    public function doLogout(){

        Auth::logout();

        return view('login');
    }

}
