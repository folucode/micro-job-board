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

Route::prefix('v1')->group(function () {
    Route::middleware('auth:api')->get('/user', [\App\Http\Controllers\Api\v1\UserController::class, 'index']);

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('auth:api')->name('dashboard');

    Route::post('/register', [\App\Http\Controllers\Api\v1\AuthController::class, 'register'])
        ->middleware('guest:api');

    Route::post('/login', [\App\Http\Controllers\Api\v1\AuthController::class, 'login'])
        ->middleware('cors:json.response');

    Route::post('/logout', [\App\Http\Controllers\Api\v1\AuthController::class, 'logout'])->middleware('auth:api');

    Route::post('/my/jobs', [\App\Http\Controllers\Api\v1\JobController::class, 'store'])->middleware('auth:api');

    Route::get('/jobs', [\App\Http\Controllers\Api\v1\JobController::class, 'index'])->middleware('cors:json.response');

    Route::get('/jobs/search', [\App\Http\Controllers\Api\v1\JobController::class, 'search'])->middleware('cors:json.response');

    Route::get('/jobs/{job}', [\App\Http\Controllers\Api\v1\JobController::class, 'show'])->middleware('cors:json.response');

    Route::delete('/my/jobs/{job}', [\App\Http\Controllers\Api\v1\JobController::class, 'delete'])->middleware('auth:api');

    Route::get('/my/jobs/', [\App\Http\Controllers\Api\v1\JobController::class, 'showMyJobs'])->middleware('auth:api');

    Route::patch('/my/jobs/{job}', [\App\Http\Controllers\Api\v1\JobController::class, 'update'])->middleware('auth:api');

    Route::post('/jobs/{job}/apply', [\App\Http\Controllers\Api\v1\ApplicationController::class, 'store'])->middleware('cors:json.response');
});
