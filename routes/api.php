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
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\ProcurementController;
use App\Http\Controllers\Api\CollegeController;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\BulsuAnnouncementController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\CampusController;
use App\Http\Controllers\Api\BulsuBacTypeController;
use App\Http\Controllers\Api\BulsuBacController;
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
        Route::post('/logout', [AuthController::class, 'logout']);

        //Routes for bulsu Personnel api
        Route::apiResource('bulsuPersonnel', PersonnelController::class);

        //Routes for bulsu_about
        Route::apiResource('bulsuAbout', BulsuAboutController::class)->only('index', 'store', 'show', 'update', 'destroy');
        Route::get('/bulsuGoals',[BulsuGoalsController::class, 'index']);
        Route::get('/bulsuGoal/subGoals/{id}', [BulsuSubgoalsController::class, 'showSubGoal']);
        Route::get('/boardOfRegents', [BoardOfRegentController::class, 'index']);
        Route::apiResource('administrativeCouncil', AdministrativeOfficesController::class)->only('index', 'store', 'show');
        Route::apiResource('executiveOfficial', ExecutiveController::class)->only('index', 'store');

        Route::apiResource('announcement', BulsuAnnouncementController::class)->only('index', 'store', 'update');

        //academics
        Route::apiResource('news', NewsController::class)->only('index',);
        Route::apiResource('procurement', ProcurementController::class)->only('index');
        Route::apiResource('college', CollegeController::class)->only('index');
        Route::apiResource('course', CourseController::class)->only('index');
        Route::apiResource('department', DepartmentController::class)->only('index', 'store', 'update', 'destroy');
        Route::apiResource('campus', CampusController::class)->only('index', 'store', 'show', 'update', 'destroy');
        Route::apiResource('bacType', BulsuBacTypeController::class)->only('index', 'store', 'update', 'destroy');
        Route::apiResource('bac', BulsuBacController::class)->only('index', 'store', 'show', 'update', 'destroy');

        //Routes for bulsu Academic
        Route::post('/college', [CollegeController::class, 'store']);
        Route::post('/course', [CourseController::class, 'store']);
        Route::post('/procurement', [ProcurementController::class, 'store']);
        Route::post('/news', [NewsController::class,  'store']);
    

    // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    // });
});
