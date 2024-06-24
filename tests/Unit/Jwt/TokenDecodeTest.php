<?php

use App\Actions\Jwt\TokenDecode;
use App\Actions\Jwt\TokenEncode;
use App\Models\User;
use Database\Seeders\UserSeeder;

/** @var Tests\TestCase $this */
beforeEach(function () {
    $this->seed(UserSeeder::class);
});

test('decode valid token', function () {
    /** @var User $user */
    $user = User::where('email', 'petshop@buckhill.com')->first();

    [$token, $payload] = app(TokenEncode::class)->handle($user->uuid);
    $decodedToken = app(TokenDecode::class)->handle($token);

    expect($decodedToken)->toBeArray()
        ->toHaveCount(6)
        ->toHaveKeys(['iss', 'aud', 'iat', 'exp', 'jti', 'sub'])
        ->and($decodedToken['iss'])->toEqual($payload['iss'])
        ->and($decodedToken['aud'])->toEqual($payload['aud'])
        ->and($decodedToken['iat'])->toEqual($payload['iat'])
        ->and($decodedToken['exp'])->toEqual($payload['exp'])
        ->and($decodedToken['jti'])->toEqual($payload['jti'])
        ->and($decodedToken['sub'])->toEqual($payload['sub']);
});
