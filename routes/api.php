<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\NotificationController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/messages/{id}', [MessageController::class, 'index']);//->middleware('auth');
Route::prefix('/message')->group(function () { 
    Route::post('/store', [MessageController::class, 'store']);
});

Route::get('/jobs/{id}', [JobController::class, 'index']);//->name("jobsRoute");
Route::prefix('/job')->group(function () { 
    Route::post('/store', [JobController::class, 'store']);
    Route::post('/update/{id}', [JobController::class, 'update']);
});

Route::get('/notifications/{id}', [NotificationController::class, 'index']);//->middleware('auth');
Route::prefix('/notification')->group(function () { 
    Route::post('/store', [NotificationController::class, 'store']);
    Route::post('/destroy/{id}', [NotificationController::class, 'destroy']);
});