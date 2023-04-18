<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskStatusController;


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

Route::post('/auth/register', [AuthController::class, 'register']);

Route::post('/auth/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/me', function(Request $request) {
        return auth()->user();
    });

    Route::post('/auth/logout', [AuthController::class, 'logout']);

    //api routes
    Route::apiResource('users', UserController::class);
    Route::apiResource('task_status', TaskStatusController::class);
    //get user tasks
    route::get('users/{id}/tasks',[UserController::class, 'userTasks']);
    //get associeted user tasks for task_status
    route::get('task_status/{id}/associated_user_tasks',[TaskStatusController::class, 'associatedUserTasks']);
    //get associeted  tasks for task_status
    route::get('task_status/{id}/associated_tasks',[TaskStatusController::class, 'associatedTasks']);

});



