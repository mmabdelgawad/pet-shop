<?php

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class JwtException extends Exception
{
    public static function missingToken(): self
    {
        return new self('Bearer token is missing.', Response::HTTP_UNAUTHORIZED);
    }

    public static function invalidToken(string $message): self
    {
        return new self($message, Response::HTTP_UNAUTHORIZED);
    }

    public function render(): JsonResponse
    {
        return response()->json(['message' => $this->message], $this->code);
    }
}
