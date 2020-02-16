<?php

namespace Globaldevteam\LaravelApiPasswordReset\app\Services;

use App\User;
use Carbon\Carbon;
use Globaldevteam\LaravelApiPasswordReset\app\Http\Requests\PasswordRecoveryFormRequest;
use Globaldevteam\LaravelApiPasswordReset\app\Models\PasswordReset;
use Globaldevteam\LaravelApiPasswordReset\app\Notifications\PasswordRecoveryRequestNotification;
use Globaldevteam\LaravelApiPasswordReset\app\Notifications\PasswordRecoverySuccessNotification;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Str;

class PasswordRecoveryService
{
    public function store(PasswordRecoveryFormRequest $request)
    {
        $input = $request->validated();

        $user = User::where('email', $input['email'])->first();
        if (!$user) {
            return response()->json([
                'message' => 'No user was found with this email address',
            ], Response::HTTP_NOT_FOUND);
        }
        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(Config::get('apiPasswordRecovery.tokenSize')),
            ]
        );
        $user->notify(
            new PasswordRecoveryRequestNotification($passwordReset->token, $user->name)
        );
        return response()->json([
            'message' => 'We have e-mailed your password reset link!',
        ], Response::HTTP_CREATED);
    }

    public function show($token)
    {
        $passwordReset = PasswordReset::where('token', $token)
            ->first();
        if (!$passwordReset) {
            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], Response::HTTP_NOT_FOUND);
        }
        if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
            $passwordReset->delete();

            return response()->json([
                'message' => 'This password reset token is invalid.',
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json($passwordReset, Response::HTTP_OK);
    }

    public function destroy(PasswordRecoveryFormRequest $request)
    {
        $input = $request->validated();
        $passwordReset = PasswordReset::where([
            ['token', $input['token']],
            ['email', $input['email']],
        ])->first();

        $user = User::where('email', $passwordReset->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'We can\'t find a user with that e-mail address.',
            ], Response::HTTP_NOT_FOUND);
        }
        if (Config::get('apiPasswordRecovery.bcryptPassword')) {
            $user->password = bcrypt($input['password']);
        } else {
            $user->password = $input['password'];
        }
        $user->save();
        PasswordReset::where([
            ['token', $input['token']],
            ['email', $input['email']],
        ])->delete();
        $user->notify(new PasswordRecoverySuccessNotification($user->name));
        return response()->json(['message' => 'Password successfully reset', 'user' => $user], Response::HTTP_OK);
    }
}
