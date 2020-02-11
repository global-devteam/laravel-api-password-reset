<?php

namespace Globaldevteam\LaravelApiPasswordReset;

use Illuminate\Support\ServiceProvider;

class ApiPasswordResetServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/apiPasswordRecovery.php', 'apiPasswordRecovery');
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
            __DIR__ . '/config/apiPasswordRecovery.php' => config_path('apiPasswordRecovery.php'),
            __DIR__.'/resources/lang'=> base_path('/resources/lang'),
            __DIR__.'/resources/views/notifications/api-password-recovery.blade.php'=> resource_path('views/vendor/api-password-recovery.blade.php'),
        ], 'laravel-api-password-recovery');
    }
}
