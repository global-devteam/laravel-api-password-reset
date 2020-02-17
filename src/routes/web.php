<?php

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => Config::get('apiPasswordRecovery.routes.web.prefix'), 'middleware' => Config::get('apiPasswordRecovery.routes.web.middleware')], function () {
    $uri = Config::get('apiPasswordRecovery.routes.web.uri');
    Route::get($uri . '/show/{token}', 'Globaldevteam\LaravelApiPasswordReset\app\Http\Controllers\PasswordResetController@show')->name('password-recovery.show');

});
