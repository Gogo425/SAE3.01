<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show the login page.
     */
    public function login()
    {
        // Return the login view to the user
        return view('login');
    }

    /**
     * Handle login form submission.
     * 
     * @param Request $request The incoming HTTP request containing login credentials.
     */
    public function doLogin(Request $request)
    {
        // Attempt to log in the user with the provided email and password
        if (Auth::attempt([
            'email' => $request['email'],    // User's email from the request
            'password' => $request['password'] // User's password from the request
        ])) {
            // If successful, regenerate the session to prevent session fixation attacks
            session()->regenerate();

            // Redirect to the home page
            return view('home');
        }

        // If login fails, return the login view again
        return view('login');
    }

    /**
     * Handle user logout.
     */
    public function doLogout()
    {
        // Log out the currently authenticated user
        Auth::logout();

        // Redirect the user to the login page
        return redirect('/login');
    }
}
