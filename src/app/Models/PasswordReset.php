<?php


namespace Globaldevteam\LaravelApiPasswordReset\app\Models;


use Illuminate\Database\Eloquent\Model;

class PasswordReset extends Model
{
    protected $fillable = [
        'email', 'token'
    ];

    public static function baseRules()
    {
        return
            [
                'email' => 'required|string|email|exists:users,email'
            ];
    }

    public static function deleteRules()
    {
        return
            [
                'email' => 'required|string|email|exists:users,email',
                'password' => 'required|string|confirmed',
                'token' => 'required|string|exists:password_resets,token'
            ];
    }
}
