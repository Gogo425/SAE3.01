<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\EvaluationController;

// Route de l'accueil
Route::get('/', function () {
    return view('home');
});