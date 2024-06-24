<?php

use Database\Seeders\UserSeeder;

/** @var Tests\TestCase $this */
beforeEach(function () {
    $this->seed(UserSeeder::class);
});

test('validation errors', function () {
    $this->post('/api/v1/auth/login', [
        'email' => '',
        'password' => '',
    ])
        ->assertStatus(422)
        ->assertJsonValidationErrors(['email', 'password']);
});

test('successful login', function () {
    $this->post('/api/v1/auth/login', [
        'email' => 'petshop@buckhill.com',
        'password' => 'petshop',
    ])
        ->assertStatus(200)
        ->assertJsonStructure([
            'data' => [
                'uuid',
                'first_name',
                'last_name',
                'email',
                'email_verified_at',
                'avatar',
                'address',
                'phone_number',
                'is_marketing',
                'created_at',
                'updated_at',
                'last_login_at',
                'token',
            ],
        ]);
});
