<?php

namespace Globaldevteam\LaravelApiPasswordReset\app\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected function standardApiErrorResponse($exception, $code = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        Log::error($exception->getMessage());

        return response()->json(
            ['message' => 'Internal Server Error'],
            $code
        );
    }

    protected function standardApiResponse($data, $dataName, $status = 200, $message = null)
    {
        if ($message) {
            return response()->json(
                [
                    'message' => $message,
                    $dataName => $data,
                ],
                $status
            );
        }

        return response()->json(
            [
                $dataName => $data,
            ],
            $status
        );
    }
}
