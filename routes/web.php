<?php


use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\SeanceController;

// Route de l'accueil
Route::get('/', function () {
    return view('home');
});

Route::prefix('/seance')->name('seance.')->controller(SeanceController::class)->group(function() {

    Route::post('/', 'save')->name('save');

    Route::get('/creation', 'creation')->name('creation');

});

// Route du profile
Route::get('/profile', function () {
    return view('profile.profile');
});

// Donne le hashage de 0000 pour avoir un mot de passe au cas où
Route::get('/hash', function () {
    return Hash::make("0000");
});

// Routes de connexion et déconnexion
Route::get('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\AuthController::class, 'doLogin']);
Route::get('/logout', [\App\Http\Controllers\AuthController::class, 'doLogout']);

// Route pour afficher le formulaire
Route::get('/create-account', function () {
    return view('create_account'); // Charge la vue pour afficher le formulaire
})->name('account.form');

// Route pour traiter le formulaire (POST)
Route::post('/create-account', [CreateAccountController::class, 'choiceUser'])->name('account.create');


/*Route::get('/abilities-evaluation', function () {
    return view('abilities_evaluation'); // Charge la vue pour afficher le formulaire
})->name('evaluation.form');

Route::get('/evaluations', [EvaluationController::class, 'index'])->name('abilities_evaluation');
Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');*/

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

