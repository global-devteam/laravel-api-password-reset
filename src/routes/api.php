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

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => Config::get('apiPasswordRecovery.route.prefix'), 'middleware' => Config::get('apiPasswordRecovery.route.middleware')], function () {
    $uri = Config::get('apiPasswordReset.route.uri');
    Route::post($uri, 'Globaldevteam\LaravelApiPasswordReset\app\Http\Controllers\PasswordResetController@store')->name('password-recovery.store');
    Route::get($uri.'/show/{token}', 'Globaldevteam\LaravelApiPasswordReset\app\Http\Controllers\PasswordResetController@show')->name('password-recovery.show');
    Route::delete($uri, 'Globaldevteam\LaravelApiPasswordReset\app\Http\Controllers\PasswordResetController@destroy')->name('password-recovery.destroy');
});
