<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('auth/login', AuthController::class . '@login');
Route::post('auth/refresh', AuthController::class . '@refresh');

Route::group(['middleware' => 'apiJwt'], function () {
    Route::post('auth/logout', AuthController::class . '@logout');
    Route::post('auth/me', AuthController::class . '@me');
    Route::get('auth/user', AuthController::class . '@me');

    Route::get('users', UserController::class . '@index');
});
