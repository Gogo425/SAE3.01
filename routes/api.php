<?php

use App\Http\Controllers\Api\AbilitiesController;
use App\Http\Controllers\Api\EvaluationsController;
use App\Http\Controllers\Api\FormationsController;
use App\Http\Controllers\Api\InitiatorsController;
use App\Http\Controllers\Api\LevelsController;
use App\Http\Controllers\Api\LocationsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonsController;
use App\Http\Controllers\Api\RequeteController;
use App\Http\Controllers\Api\SessionsController;
use App\Http\Controllers\Api\SkillsController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\StudentsController;
use App\Http\Controllers\Api\Technical_directorsController;
use App\Http\Controllers\Api\Training_managersController;
use App\Http\Controllers\Api\TrainsController;
use App\Http\Controllers\Api\WorksController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('requete', RequeteController::class);

Route::apiResource('abilities', AbilitiesController::class);
Route::apiResource('evaluations', EvaluationsController::class);
Route::apiResource('formations', FormationsController::class);
Route::apiResource('initiators', InitiatorsController::class);
Route::apiResource('levels', LevelsController::class);
Route::apiResource('locations', LocationsController::class);
Route::apiResource('sessions', SessionsController::class);
Route::apiResource('skills', SkillsController::class);
Route::apiResource('status', StatusController::class);
Route::apiResource('technical_directors', Technical_directorsController::class);
Route::apiResource('training_managers', Training_managersController::class);
Route::apiResource('trains', TrainsController::class);
Route::apiResource('works', WorksController::class);

Route::apiResource('persons', PersonsController::class);

Route::apiResource('students', StudentsController::class);