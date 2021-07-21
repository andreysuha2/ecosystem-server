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

Route::group([ 'prefix' => "auth", "namespace" => "Authenticate"], function () {
    Route::get('check', function () {
        return response()->json([ 'message' => 'ok' ]);
    });
    Route::put("login", "AuthController@login");
    Route::post("registration", "AuthController@registration");
    Route::put("logout", "AuthController@logout")->middleware('auth:sanctum');
});

Route::group([ 'middleware' => "auth:sanctum" ], function () {
    Route::group([ 'prefix' => 'user', 'namespace' => 'User' ], function () {
        Route::get('', "UserController@getUser");
    });
    Route::group([ 'prefix' => 'finances' ], function () {
        Route::group([ 'prefix' => 'valet', 'namespace' => 'Valet' ], function () {
            Route::get('{valet_id}', "ValetController@getValet");
        });
    });
});
