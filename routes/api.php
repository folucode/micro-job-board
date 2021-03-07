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
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware('auth:api')->name('dashboard');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->middleware('guest:api');

    Route::post('/login', [\App\Http\Controllers\Api\v1\AuthController::class, 'login'])
        ->middleware('cors:json.response');

    Route::post('/logout', [\App\Http\Controllers\Api\v1\AuthController::class, 'logout'])->middleware('auth:api');

    // Route::middleware('auth:api')->group(function () {
    //     // our routes to be protected will go in here
    //     Route::post('/logout', 'Auth\ApiAuthController@logout')->name('logout.api');
    // });
});
