<?php

use App\Actions\Jwt\TokenEncode;
use App\Models\User;
use Database\Seeders\UserSeeder;

/** @var Tests\TestCase $this */
beforeEach(function () {
    $this->seed(UserSeeder::class);
});

test('missing bearer token', function () {
    $this->post('/api/v1/auth/logout', [], ['Accept' => 'application/json'])
        ->assertStatus(401)
        ->assertJsonStructure(['message'])
        ->assertJson(['message' => 'Bearer token is missing.']);
});

test('user object is shared during request lifecycle', function () {
    /** @var User $user */
    $user = User::where('email', 'petshop@buckhill.com')->first();

    [$token] = app(TokenEncode::class)->handle($user->uuid);

    $this->post('/api/v1/auth/logout', [], [
        'Accept' => 'application/json',
        'Authorization' => "Bearer $token",
    ])
        ->assertStatus(200)
        ->assertJsonStructure(['message'])
        ->assertJson(['message' => 'Successfully logged out']);
});
