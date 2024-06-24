<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

final class UserException extends Exception
{
    public static function notFound(): self
    {
        return new self('User not found.', Response::HTTP_NOT_FOUND);
    }

    public function render(): JsonResponse
    {
        return response()->json(['message' => $this->message], $this->code);
    }
}
