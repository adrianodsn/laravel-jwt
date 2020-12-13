<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
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

Route::get('/', function () {
    return response()->json(['name' => 'Laravel JWT API', 'version' => '1.0.0']);
});

Route::post('register', UserController::class . '@store');

Route::group(['prefix' => 'auth'], function () {
    Route::post('login', AuthController::class . '@login');
    Route::post('refresh', AuthController::class . '@refresh');
});

Route::group(['middleware' => 'apiJwt'], function () {

    Route::group(['prefix' => 'auth'], function () {
        Route::post('logout', AuthController::class . '@logout');
        Route::get('me', AuthController::class . '@me');
        Route::get('user', AuthController::class . '@me');
    });

    Route::get('users', UserController::class . '@index');
});


// Route::group(['middleware' => 'auth:api', 'prefix' => 'auth'], function ($router) {
//     Route::post('logout', AuthController::class . '@logout');
//     Route::get('me', AuthController::class . '@me');
//     Route::get('user', AuthController::class . '@me');
//     Route::get('users', UserController::class . '@index');
// });
