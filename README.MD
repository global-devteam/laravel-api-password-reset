# Laravel Api Password Reset

Easy laravel api password reset for your application

Setting up the package

1. Have a laravel project installed
2. Create /packages/global-devteam/ folder in the root of the project
3. Clone package repo into the newly created folder
4. Go to the root composer.json file and add the following to the PSR-4 section under autoload section:
`"Globaldevteam\\LaravelApiPasswordReset\\": "packages/global-devteam/laravel-api-password-reset/src/"`

5. Open app.php file and add the service provider:
`\Globaldevteam\LaravelApiPasswordReset\ApiPasswordResetServiceProvider::class,`
6. Run `composer dumpautoload`
7. Run `php artisan migrate`

PS. Once the package is done and published on packagist we can simply use composer require
