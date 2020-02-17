<?php

namespace Globaldevteam\LaravelApiPasswordReset\app\Http\Controllers;

use Exception;
use Globaldevteam\LaravelApiPasswordReset\app\Http\Requests\PasswordRecoveryFormRequest;
use Globaldevteam\LaravelApiPasswordReset\app\Services\PasswordRecoveryService;
use Illuminate\Http\Response;

class PasswordResetController extends Controller
{
    private $passwordResetService;

    public function __construct(PasswordRecoveryService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }

    public function store(PasswordRecoveryFormRequest $request)
    {
        try {
            return $this->passwordResetService->store($request);
        } catch (Exception $exception) {
            return $this->standardApiErrorResponse($exception, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($token)
    {
        try {
            return $this->passwordResetService->show($token);
        } catch (Exception $exception) {
            return $this->standardApiErrorResponse($exception, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(PasswordRecoveryFormRequest $request)
    {
        try {
            return $this->passwordResetService->destroy($request);
        } catch (Exception $exception) {
            return $this->standardApiErrorResponse($exception, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
