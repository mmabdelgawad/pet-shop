<?php

namespace App\Actions\Auth;

use App\Actions\Jwt\StoreUserJwtToken;
use App\Actions\Jwt\TokenEncode;
use App\Exceptions\Auth\AuthException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

readonly class LoginAction
{
    public function __construct(
        private TokenEncode $tokenEncode,
        private  StoreUserJwtToken $storeUserJwtToken
    ) {
    }

    /**
     * @param array<string, string> $credentials
     * @return array<int, string>
     * @throws AuthException
     */
    public function handle(array $credentials): array
    {
        $user = User::where('email', $credentials['email'])->first();

        if ( ! $user || ! Hash::check($credentials['password'], $user->password)) {
            throw AuthException::invalidCredentials();
        }

        [$token, $payload] = $this->tokenEncode->handle($user->uuid);

        $this->storeUserJwtToken->handle($user, $payload);

        $user->update([
            'last_login_at' => now(),
        ]);

        return [$token, $user];
    }
}
