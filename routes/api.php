<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PersonnelController;
use App\Http\Controllers\Api\ExecutiveController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\BulsuAboutController;
use App\Http\Controllers\Api\BulsuGoalsController;
use App\Http\Controllers\Api\BulsuSubgoalsController;
use App\Http\Controllers\Api\BoardOfRegentController;
use App\Http\Controllers\Api\AdministrativeOfficesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'v1'], function() {

    //Public Routes
    //Routes for Auth user
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    //Protected Routes
    Route::group(['middleware' => ['auth:sanctum']], function() {

        //Routes for Auth user
        Route::get('/me', [AuthController::class, 'me']);
        Route::get('/me', [AuthController::class, 'me'])->middleware('auth:sanctum');
        Route::post('/logout', [AuthController::class, 'logout']);
        //Routes for bulsu Personnel api
        Route::apiResource('bulsuPersonnel', PersonnelController::class);
    });
    


    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
    
    
    
    
    //Routes for bulsu_about
    Route::get('/bulsuAbout', [BulsuAboutController::class, 'index']);
    Route::get('/bulsuGoals',[BulsuGoalsController::class, 'index']);
    Route::get('/bulsuGoal/subGoals/{id}', [BulsuSubgoalsController::class, 'showSubGoal']);
    Route::get('/boardOfRegents', [BoardOfRegentController::class, 'index']);
    Route::get('/administrativeCouncil', [AdministrativeOfficesController::class, 'index']);
    Route::apiResource('executiveOfficial', ExecutiveController::class);

});
