<?php

use App\Http\Controllers\createFormController;
use App\Http\Controllers\CreateFormController as ControllersCreateFormController;
use App\Http\Controllers\FormationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/creationFormation')->name('creationFormation')->controller(ControllersCreateFormController::class)->group(function () {

    Route::get('/','create')->name('create');

    Route::post('/', 'store')->name('store');

});

//Route::post('/formations', [FormationController::class, 'store']);