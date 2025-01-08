<?php

use App\Http\Controllers\CalendarController;
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
    return view('home');
});

Route::get('/calendar/calendarDirector', [\App\Http\Controllers\CalendarController::class, 'calendarDirector']);
Route::get('/calendar/calendarStudent', [\App\Http\Controllers\CalendarController::class, 'calendarStudents']);
Route::get('/calendar/calendarInitiator', [\App\Http\Controllers\CalendarController::class, 'calendarInitiator']);
Route::get('/calendar', [\App\Http\Controllers\CalendarController::class, 'BaseCalendar']);
Route::get('/calendar/testdays/{newdate}', [\App\Http\Controllers\CalendarController::class, 'AddDate']);