<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;

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

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function () {

    Route::get('/user', [\App\Http\Controllers\Api\v1\UserController::class, 'index']);

    Route::post('/logout', [\App\Http\Controllers\Api\v1\AuthController::class, 'logout']);

    Route::post('/my/jobs', [\App\Http\Controllers\Api\v1\JobController::class, 'store']);

    Route::get('/my/jobs/', [\App\Http\Controllers\Api\v1\JobController::class, 'showMyJobs']);

    Route::patch('/my/jobs/{job}', [\App\Http\Controllers\Api\v1\JobController::class, 'update']);

    Route::delete('/my/jobs/{job}', [\App\Http\Controllers\Api\v1\JobController::class, 'delete']);
});

Route::group(['prefix' => 'v1', 'middleware' => 'cors:json.response'], function () {

    Route::post('/register', [\App\Http\Controllers\Api\v1\AuthController::class, 'register']);

    Route::post('/login', [\App\Http\Controllers\Api\v1\AuthController::class, 'login']);

    Route::get('/jobs', [\App\Http\Controllers\Api\v1\JobController::class, 'index']);

    Route::get('/jobs/search', [\App\Http\Controllers\Api\v1\JobController::class, 'search']);

    Route::get('/jobs/{job}', [\App\Http\Controllers\Api\v1\JobController::class, 'show']);

    Route::post('/jobs/{job}/apply', [\App\Http\Controllers\Api\v1\ApplicationController::class, 'store']);
});
