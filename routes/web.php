<?php


use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\TableAbilitiesController;
use App\Http\Controllers\TableStudentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\EvaluationController;

// Home route
Route::get('/', function () {
    return view('home');
})->middleware('auth');

Route::prefix('/seance')->name('seance.')->controller(SeanceController::class)->group(function() {

    Route::post('/', 'save')->name('save');

    Route::get('/creation', 'creation')->name('creation');

});

// Profile route
Route::get('/profile', function () {
    return view('profile.profile');
});

// Hash test route
Route::get('/hash', function () {
    return Hash::make("0000");
});

// Connection and disconnection routes
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogin']);
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'doLogout']);

// Route pour afficher le formulaire
Route::get('/create-account', function () {
    return view('create_account'); // Charge la vue pour afficher le formulaire
})->name('account.form');

// Route pour traiter le formulaire (POST)
Route::post('/create-account', [CreateAccountController::class, 'choiceUser'])->name('account.create');


Route::get('/abilities-evaluation', function () {
    return view('abilities_evaluation'); // Charge la vue pour afficher le formulaire
})->name('evaluation.form');

Route::get('/evaluations', [EvaluationController::class, 'index'])->name('abilities_evaluation');
Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');

Route::post('/get-abilities', [EvaluationController::class, 'getAbilitiesByStudent'])->name('abilities.by.student');
Route::post('/abilities-by-student', [EvaluationController::class, 'getAbilitiesByStudent'])->name('abilities.by.student');


// Route::middleware(['auth'])->group(function () {
//     Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');
//     Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');
// });

//Routes pour les différents calendriers
Route::get('/calendar/calendarDirector', [\App\Http\Controllers\CalendarController::class, 'calendarDirector']);
Route::get('/calendar/calendarStudent', [App\Http\Controllers\CalendarController::class, 'calendarStudents']);
Route::get('/calendar/calendarInitiator', [App\Http\Controllers\CalendarController::class, 'calendarInitiator']);
Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'BaseCalendar']);
Route::get('/calendar/testdays/{newdate}', [App\Http\Controllers\CalendarController::class, 'AddDate']);


//Tablestudent routes
Route::get('/tableAbilities', [TableAbilitiesController::class,'TableAbilitiesPage']);
Route::get('/tableStudent', [TableStudentController::class,'TableStudentPage']);
Route::post('/tableStudent',[TableStudentController::class,'TableStudentPage']);
