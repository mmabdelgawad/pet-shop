<?php

use App\Actions\Jwt\TokenEncode;
use App\Models\User;
use Database\Seeders\UserSeeder;

/** @var Tests\TestCase $this */
beforeEach(function () {
    $this->seed(UserSeeder::class);
});

test('issue a new token', function () {
    /** @var User $user */
    $user = User::where('email', 'petshop@buckhill.com')->first();

    [$token, $payload] = app(TokenEncode::class)->handle($user->uuid);

    expect($token)->not()->toBeNull()
        ->and($payload)->toBeArray()
        ->toHaveCount(6)
        ->toHaveKeys(['iss', 'aud', 'iat', 'exp', 'jti', 'sub'])
        ->and($payload['iss'])->toEqual(config('app.name'))
        ->and($payload['aud'])->toEqual(config('app.url'))
        ->and($payload['iat'])->toEqual(now()->timestamp)
        ->and($payload['exp'])->toEqual(now()->addMinutes(config('jwt.expires_after_minutes'))->timestamp)
        ->and($payload['jti'])->toEqual(sha1($user->uuid.time()))
        ->and($payload['sub'])->toEqual($user->uuid);
});
