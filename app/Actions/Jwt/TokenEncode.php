<?php

namespace App\Actions\Jwt;

use Firebase\JWT\JWT;

readonly class TokenEncode
{
    /**
     * @param string $userUuid
     * @return array<int, mixed>
     */
    public function handle(string $userUuid): array
    {
        $jwtConfig = config('jwt');

        $payload = [
            'iss' => config('app.name'),
            'aud' => config('app.url'),
            'iat' => now()->timestamp,
            'exp' => now()->addMinutes($jwtConfig['expires_after_minutes'])->timestamp,
            'jti' => sha1($userUuid.time()),
            'sub' => $userUuid,
        ];

        $token = JWT::encode($payload, $jwtConfig['key'], $jwtConfig['algo']);

        return [$token, $payload];
    }
}
