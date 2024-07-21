<?php

namespace App\Exceptions;

use App\Http\Helpers\ResponseJson;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HttpAuthorizationException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     */
    public function render(Request $request): JsonResponse
    {
        return ResponseJson::error('Unauthorized', Response::HTTP_UNAUTHORIZED);
    }
}
