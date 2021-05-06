<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\TimelineEventController;

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


Route::post('/user/login', [LoginController::class, 'login']);
Route::post('/user/logout', [LoginController::class, 'logout']); 
Route::group(['middleware' => ['web']], function () {
  Route::get('/login/{id}', function (Request $request, $id) { Auth::loginUsingId($id); return Auth::user(); });    
});

Route::group(['middleware' => ['auth']], function () {

  Route::get('/jobs/{id}', [JobController::class, 'index']);
  Route::prefix('/job')->group(function () { 
    Route::post('/store', [JobController::class, 'store']);
    Route::post('/update-status/{id}', [JobController::class, 'updateStatus']);
    Route::post('/update-notify/{id}', [JobController::class, 'updateNotify']);
    Route::post('/assign/{id}', [JobController::Class, 'assign']);
    Route::post('/destroy/{id}', [JobController::class, 'destroy']);
  });

  Route::get('/messages/{id}', [MessageController::class, 'index']);
  Route::prefix('/message')->group(function () { 
    Route::post('/store', [MessageController::class, 'store']);
  });

  Route::get('/notifications/{id}', [NotificationController::class, 'index']);
  Route::prefix('/notification')->group(function () { 
    Route::post('/store', [NotificationController::class, 'store']);
    Route::post('/destroy/{id}', [NotificationController::class, 'destroy']);
  });

  Route::prefix('/file')->group(function () { 
    Route::post('/store', [FileController::class, 'store']);
    Route::get('/download/{id}', [FileController::class, 'download']);
  });

  Route::prefix('/timeline-event')->group(function () { 
    Route::post('/store', [TimelineEventController::class, 'store']);    
  }); 
});