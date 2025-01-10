<?php



use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\TableAbilitiesController;
use App\Http\Controllers\TableStudentController;

use App\Http\Controllers\createFormController;
use App\Http\Controllers\CreateFormController as ControllersCreateFormController;
use App\Http\Controllers\FormController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CreateAccountController;
use App\Http\Controllers\SeanceController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\ValidateController;
use App\Http\Controllers\AuthController;

// Home route
Route::get('/', function () {
    return view('home');
})->middleware('auth') -> name('home');

Route::prefix('/seance')->name('seance.')->controller(SeanceController::class)->group(function() {

    Route::post('/', 'save')->name('save');

    Route::get('/creation/{date_session}', 'creation')->name('creation');

});


// Profile route
Route::get('/profile', function () {
    return view('profile.profile');
});

// Hash test route
Route::get('/hash', function () {
    return Hash::make("1234");
});

// Routes de connexion et déconnexion
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::get('/logout', [AuthController::class, 'doLogout']);

// Route pour afficher le formulaire
Route::get('/create-account', function () {
    return view('create_account'); // Charge la vue pour afficher le formulaire
})->name('account.form');

// Route pour traiter le formulaire (POST)
Route::post('/create-account', [CreateAccountController::class, 'choiceUser'])->name('account.create');

Route::get('/evaluations/{idSession}', [EvaluationController::class, 'index'])->name('abilities_evaluation');
Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');

Route::post('/get-abilities', [EvaluationController::class, 'getAbilitiesByStudent'])->name('abilities.by.student');
Route::post('/abilities-by-student', [EvaluationController::class, 'getAbilitiesByStudent'])->name('abilities.by.student');


// Route::middleware(['auth'])->group(function () {
//     Route::get('/evaluations', [EvaluationController::class, 'index'])->name('evaluations.index');
//     Route::post('/evaluations', [EvaluationController::class, 'store'])->name('evaluations.store');
// });


//Routes pour les différents calendriers
Route::get('/calendar/calendarDirector/', [\App\Http\Controllers\CalendarController::class, 'calendarDirector'])->name('calendar.calendarDirector');
Route::get('/calendar/calendarStudent', [App\Http\Controllers\CalendarController::class, 'calendarStudents'])->name('calendar.calendarStudents');
Route::get('/calendar/calendarInitiator', [App\Http\Controllers\CalendarController::class, 'calendarInitiator'])->name('calendar.calendarInitiator');
Route::get('/calendar', [App\Http\Controllers\CalendarController::class, 'BaseCalendar']);


Route::get('/liste', [ManageController::class, 'index'])->name('liste');
Route::delete('/student/{ID_PER}', [ManageController::class, 'manageDeleteStudent'])->name('student.delete');
Route::delete('/initiator/{ID_PER}', [ManageController::class, 'manageDeleteInitiator'])->name('initiator.delete');
Route::delete('/training_managers/{ID_PER}', [ManageController::class, 'manageDeleteTrainingManager'])->name('training_managers.delete');



Route::get('/persons/{ID_PER}/edit', [ManageController::class, 'editUser'])->name('persons.edit');
Route::put('/persons/{ID_PER}', [ManageController::class, 'updateUser'])->name('persons.update');


Route::get('/tableAbilities', [TableAbilitiesController::class,'TableAbilitiesPage'])->name('tableAbilities');
Route::get('/tableStudent', [TableStudentController::class,'TableStudentPage'])->name('tableStudent');
Route::post('/tableStudent',[TableStudentController::class,'TableStudentPage']);
Route::post('/validate',[ValidateController::class, 'levelUp'])->name('validate');


Route::prefix('/creationFormation')->name('creationFormation')->controller(ControllersCreateFormController::class)->group(function () {

    Route::get('/','create')->name('create');

    Route::post('/', 'store')->name('store');

});

Route::prefix('/formation')->name('formation')->controller(FormController::class)->group(function () {

    Route::get('/','create')->name('create');

});

Route::get('/formation',[FormController::class,'create'])->name('formation');

Route::delete('/formation/{ID_FORMATION}',[FormController::class, 'deleteFormation'])->name('formation.delete');

Route::get('/detailsSessions/{idSession}',[SeanceController::class, 'getDetails'])->name('detailsSessions');

Route::get('/StudentsInitiatorsFormations', [FormController::class, 'getStudentsAndInitators'])->name('listStudentsInitiators');

