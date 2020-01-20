<?php

namespace Globaldevteam\LaravelApiPasswordReset\app\Services;

use App\User;
use Carbon\Carbon;
use Globaldevteam\LaravelApiPasswordReset\app\Http\Requests\PasswordResetFormRequest;
use Globaldevteam\LaravelApiPasswordReset\app\Models\PasswordReset;
use Globaldevteam\LaravelApiPasswordReset\app\Notifications\PasswordResetRequestNotification;
use Globaldevteam\LaravelApiPasswordReset\app\Notifications\PasswordResetSuccessNotification;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class PasswordResetService
{
    public function store(PasswordResetFormRequest $request)
    {
        $input = $request->validated();

        $user = User::where('email', $input['email'])->first();

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => Str::random(60),
            ]
        );
        if ($user && $passwordReset) {
            $user->notify(
                new PasswordResetRequestNotification($passwordReset->token, $user->name)
            );
        }

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

    public function destroy(PasswordResetFormRequest $request)
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
        $user->password = bcrypt($input['password']);
        $user->save();
        $passwordReset->delete();
        $user->notify(new PasswordResetSuccessNotification($user->name));

        return response()->json(['message' => 'Password successfully reset', 'user' => $user], Response::HTTP_OK);
    }
}
