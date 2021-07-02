<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
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

//<useless>
Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});
Route::group(['middleware' => ['web']], function () {
  Route::get('/login/{id}', function (Request $request, $id) { Auth::loginUsingId($id); return Auth::user(); });    
});
Route::get('/email/{id}', [App\Http\Controllers\NotifyEmailController::class, 'dispatchMailJob']);
//</useless>

Route::prefix('/user')->group(function () {
  Route::post('/login', [UserController::class, 'login']);
  Route::post('/logout', [UserController::class, 'logout']);
});

Route::group(['middleware' => ['auth']], function () {

  Route::prefix('/user')->group(function () {
    Route::get('/retrieve', function() { return Auth::user(); });
    Route::post('/update-settings', [UserController::class, 'updateSettings']);
  });

  Route::get('/jobs/{id}', [JobController::class, 'index']);
  Route::prefix('/job')->group(function () { 
    Route::post('/store', [JobController::class, 'store']);
    Route::post('/update-status', [JobController::class, 'updateStatus']);
    Route::post('/update-notify', [JobController::class, 'updateNotify']);
    Route::post('/assign', [JobController::class, 'assign']);
    Route::post('/terminate', [JobController::class, 'terminate']);
  });

  Route::get('/messages/{id}', [MessageController::class, 'index']);
  Route::prefix('/message')->group(function () { 
    Route::post('/store', [MessageController::class, 'store']);
  });

  Route::prefix('/file')->group(function () { 
    Route::post('/store', [FileController::class, 'store']);
    Route::get('/download/{id}', [FileController::class, 'download']);
  });
});