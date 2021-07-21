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
        Route::group([ 'prefix' => 'currencies', 'namespace' => "Currency" ], function () {
            Route::get('list', "CurrencyController@getList");
            Route::get('currency/{currency_id}', 'CurrencyController@getCurrency');
        });
        Route::group([ 'prefix' => 'valets', 'namespace' => 'Valet' ], function () {
            Route::get('', "ValetController@getValetsList");
            Route::group([ 'prefix' => 'valet' ], function () {
                Route::post('', "ValetController@createValet");
                Route::group([ 'prefix' => '{valet}' ], function () {
                    Route::get('', "ValetController@getValet");
                    Route::put('', "ValetController@updateValet");
                    Route::delete('', "ValetController@deleteValet");
                });
            });
        });
    });
});
