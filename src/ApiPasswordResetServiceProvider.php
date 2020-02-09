<?php

namespace Globaldevteam\LaravelApiPasswordReset;

use Illuminate\Support\ServiceProvider;

class ApiPasswordResetServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/apiPasswordReset.php', 'apiPasswordReset');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        if ($this->app->runningInConsole()) {
            $this->publishConfigs();
        }
    }

    protected function publishConfigs()
    {
        $this->publishes([
            __DIR__ . '/config/apiPasswordReset.php' => config_path('apiPasswordReset.php'),
            __DIR__.'/resources/lang'=> app_path('/resources/lang')
        ], 'laravel-api-password-reset');
    }
}
