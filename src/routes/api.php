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

Route::group(['prefix' => Config::get('apiPasswordRecovery.routes.api.prefix'), 'middleware' => Config::get('apiPasswordRecovery.routes.api.middleware')], function () {
    $uri = Config::get('apiPasswordRecovery.routes.api.uri');
    Route::post($uri, 'Globaldevteam\LaravelApiPasswordReset\app\Http\Controllers\PasswordResetController@store')->name('password-recovery.store');
    Route::delete($uri, 'Globaldevteam\LaravelApiPasswordReset\app\Http\Controllers\PasswordResetController@destroy')->name('password-recovery.destroy');
});
