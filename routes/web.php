<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateAccountController;

Route::get('/', function () {
    return view('welcome');
});

// Route pour afficher le formulaire
Route::get('/create-account', function () {
    return view('create_account'); // Charge la vue pour afficher le formulaire
})->name('account.form');

// Route pour traiter le formulaire (POST)
Route::post('/create-account', [CreateAccountController::class, 'choiceUser'])->name('account.create');
