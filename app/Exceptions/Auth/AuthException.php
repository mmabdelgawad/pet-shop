<?php

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class AuthException extends Exception
{
    public static function invalidCredentials(): self
    {
        return new self('Invalid credentials.', Response::HTTP_UNAUTHORIZED);
    }

    public function render(): JsonResponse
    {
        return response()->json(['message' => $this->message], $this->code);
    }
}
