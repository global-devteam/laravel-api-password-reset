<?php

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

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1','middleware'=>'api'], function () {
    Route::group(['prefix' => 'auth'], function () {

        Route::post('password', 'Globaldevteam\LaravelApiPasswordReset\app\Http\Controllers\PasswordResetController@store');
        Route::get('password/show/{token}', 'Globaldevteam\LaravelApiPasswordReset\app\Http\Controllers\PasswordResetController@show');
        Route::delete('password', 'Globaldevteam\LaravelApiPasswordReset\app\Http\Controllers\PasswordResetController@destroy');

    });

});

