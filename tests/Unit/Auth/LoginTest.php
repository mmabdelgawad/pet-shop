<?php

use App\Actions\Auth\LoginAction;
use App\Actions\Jwt\StoreUserJwtToken;
use App\Actions\Jwt\TokenEncode;
use App\Exceptions\Auth\AuthException;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\UserSeeder;

/** @var Tests\TestCase $this */
beforeEach(function () {
    $this->seed(UserSeeder::class);
});

test('invalid email and password', function () {
    $this->expectException(AuthException::class);
    $this->expectExceptionMessage('Invalid credentials');

    app(LoginAction::class)->handle([
        'email' => 'test@buckhill.com',
        'password' => 'password',
    ]);
});

test('user not found, valid email incorrect password', function () {
    $this->expectException(AuthException::class);
    $this->expectExceptionMessage('Invalid credentials');

    app(LoginAction::class)->handle([
        'email' => 'petshop@buckhill.com',
        'password' => 'invalid',
    ]);
});

test('last login at updated successfully', function () {
    app(LoginAction::class)->handle([
        'email' => 'petshop@buckhill.com',
        'password' => 'petshop',
    ]);

    /** @var User $user */
    $user = User::where('email', 'petshop@buckhill.com')->first();

    expect($user->last_login_at)->not()->toBeNull()
        ->and($user->last_login_at)->toEqual(now()->toDateTimeString());
});

test('user token stored successfully in database', function () {
    /** @var User $user */
    $user = User::where('email', 'petshop@buckhill.com')->first();

    [, $payload] = app(TokenEncode::class)->handle($user->uuid);
    app(StoreUserJwtToken::class)->handle($user, $payload);

    expect($user->tokens)->toHaveCount(1);

    /** @var App\Models\JwtToken $jwtToken */
    $jwtToken = $user->tokens->first();

    expect($jwtToken)
        ->not()->toBeNull()
        ->and($jwtToken->unique_id)->toEqual($payload['jti'])
        ->and($jwtToken->expires_at)->toEqual(Carbon::parse($payload['exp'])->toDateTimeString());
});

test('logged in successfully', function () {
    $result = app(LoginAction::class)->handle([
        'email' => 'petshop@buckhill.com',
        'password' => 'petshop',
    ]);

    expect($result)
        ->toBeArray()
        ->toHaveCount(2);
});
