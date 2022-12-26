<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'user'], function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/', [\App\Http\Controllers\UsersController::class, "get"]);
        Route::delete('logout', [\App\Http\Controllers\UsersController::class, "logout"]);
    });
    Route::post('registration', [\App\Http\Controllers\UsersController::class, "registration"]);
    Route::post('login', [\App\Http\Controllers\UsersController::class, "login"]);
});

// Route::middleware('auth:sanctum')->get('/', function (Request $request) {
//     return $request->user();
// });
