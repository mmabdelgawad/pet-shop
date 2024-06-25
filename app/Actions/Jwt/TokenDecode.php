<?php

namespace App\Actions\Jwt;

use App\Exceptions\Auth\JwtException;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenDecode
{
    /**
     * @param string $token
     * @return array<string, string>
     * @throws JwtException
     */
    public function handle(string $token): array
    {
        $jwtConfig = config('jwt');

        try {
            $decodedObject = JWT::decode($token, new Key($jwtConfig['key'], $jwtConfig['algo']));
        } catch (Exception $e) {
            throw JwtException::invalidToken($e->getMessage());
        }

        return json_decode((string) json_encode($decodedObject), true);
    }
}
