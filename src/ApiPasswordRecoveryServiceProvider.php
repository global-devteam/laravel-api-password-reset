<?php

namespace Globaldevteam\LaravelApiPasswordReset;

use Illuminate\Support\ServiceProvider;

class ApiPasswordRecoveryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/apiPasswordRecovery.php', 'apiPasswordRecovery');
    }

    public function boot()
    {
        // $this->loadViewsFrom(__DIR__ . '/resources/views/', 'notification.api-password-recovery');
        $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        if ($this->app->runningInConsole()) {
            $this->publishConfigs();
        }
    }

    protected function publishConfigs()
    {
        $this->publishes([
            __DIR__ . '/config/apiPasswordRecovery.php' => config_path('apiPasswordRecovery.php'),
            __DIR__ . '/resources/lang' => base_path('/resources/lang'),
            __DIR__ . '/resources/views/notifications/api-password-recovery.blade.php' => resource_path('views/vendor/email/api-password-recovery.blade.php'),
            __DIR__ . '/resources/views/apiPasswordRecoveryForm.blade.php' => resource_path('views/vendor/form/apiPasswordRecovery.blade.php'),
        ], 'laravel-api-password-recovery');
    }
}
