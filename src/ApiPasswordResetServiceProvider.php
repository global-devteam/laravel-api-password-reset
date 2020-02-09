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
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'Globaldevteam\LaravelApiPasswordReset;');
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
        ], 'laravel-api-password-reset');
    }
}
