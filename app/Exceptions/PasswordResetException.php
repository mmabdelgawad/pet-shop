<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class PasswordResetException extends Exception
{
    public static function invalidToken(): self
    {
        return new self('Invalid reset token.', Response::HTTP_NOT_FOUND);
    }

    public function render(): JsonResponse
    {
        return response()->json(['message' => $this->message], $this->code);
    }
}
