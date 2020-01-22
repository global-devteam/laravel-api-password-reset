# Laravel Api Password Reset

Easy laravel api password reset for your application

1. Run `composer require global-devteam/laravel-api-password-reset`
2. Run `php artisan vendor:publish --tag=laravel-api-password-reset`
3. Run `php artisan migrate`
4. Run `php artisan route:list | grep password` to see new routes

This package relies on the `User.php` and it should be at the default location.

## POST
`api/v1/auth/password`
payload:
```JSON
{
	"email":"user@email.com"
}
```
This endpoint sends an email to the user so you must have your email server setup

## GET
`api/v1/auth/password/show/{token}`

This endpoint validates the token and it is valid you will get the token object otherwise an invalid message will be returned

## DELETE
`api/v1/auth/password`
payload:
```JSON
{
	"email":"user@email.com",
	"password":"secret",
	"password_confirmation":"secret",
	"token": "k8sgO6"
}
```
This endpoint changes the password and sends an email to the user so you must have your email server setup
