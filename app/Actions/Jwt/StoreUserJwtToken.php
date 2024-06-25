<?php

namespace App\Actions\Jwt;

use App\Models\User;

class StoreUserJwtToken
{
    /**
     * @param User $user
     * @param array<string, mixed> $payload
     * @return void
     */
    public function handle(User $user, array $payload): void
    {
        $user->tokens()->create([
            'unique_id' => $payload['jti'],
            'token_title' => 'User JWT Token',
            'expires_at' => $payload['exp'],
        ]);
    }
}
