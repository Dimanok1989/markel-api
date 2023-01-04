<?php

use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\CompanyFormController;
use App\Http\Controllers\UsersController;
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
        Route::get('/', [UsersController::class, "get"]);
        Route::delete('logout', [UsersController::class, "logout"]);
    });
    Route::post('registration', [UsersController::class, "registration"]);
    Route::post('login', [UsersController::class, "login"]);
});

Route::middleware('auth:sanctum')->group(function () {

    Route::apiResources([
        'company' => CompanyController::class,
    ]);

    Route::resources([
        'company.form' => CompanyFormController::class,
    ]);
});
