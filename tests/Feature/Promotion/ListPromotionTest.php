<?php

use App\Actions\Jwt\TokenEncode;
use App\Models\Promotion;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\PromotionSeeder;
use Database\Seeders\UserSeeder;

/** @var Tests\TestCase $this */
beforeEach(function () {
    $this->seed(UserSeeder::class);
    $this->seed(PromotionSeeder::class);

    /** @var User $user */
    $user = User::where('email', 'petshop@buckhill.com')->first();

    [$this->token] = app(TokenEncode::class)->handle($user->uuid);
});

test('listing promotions with limit', function () {
    $this->get('/api/v1/promotions?limit=2', [
        'Authorization' => "Bearer $this->token",
    ])
        ->assertStatus(200)
        ->assertJsonCount(2, 'data');
});

test('listing valid promotions', function () {
    $promotions = Promotion::orderBy('id', 'desc')
        ->valid()
        ->limit(15)
        ->get(['uuid', 'title', 'content', 'metadata', 'created_at', 'updated_at'])
        ->map(function ($promotion) {
            return [
                'uuid' => $promotion->uuid,
                'title' => $promotion->title,
                'content' => $promotion->content,
                'metadata' => $promotion->metadata,
                'created_at' => Carbon::parse($promotion->created_at)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::parse($promotion->updated_at)->format('Y-m-d H:i:s'),
            ];
        })->toArray();

    $this->get('/api/v1/promotions?valid=1&limit=15', [
        'Authorization' => "Bearer $this->token",
    ])
        ->assertStatus(200)
        ->assertJsonCount(15, 'data')
        ->assertJsonPathCanonicalizing('data', $promotions);
});

test('listing promotions with sorting', function () {
    $promotions = Promotion::orderBy('id', 'desc')
        ->limit(10)
        ->get(['uuid', 'title', 'content', 'metadata', 'created_at', 'updated_at'])
        ->map(function ($promotion) {
            return [
                'uuid' => $promotion->uuid,
                'title' => $promotion->title,
                'content' => $promotion->content,
                'metadata' => $promotion->metadata,
                'created_at' => Carbon::parse($promotion->created_at)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::parse($promotion->updated_at)->format('Y-m-d H:i:s'),
            ];
        })->toArray();

    $this->get('/api/v1/promotions?sortBy=id&sort=desc', [
        'Authorization' => "Bearer $this->token",
    ])
        ->assertStatus(200)
        ->assertJsonIsArray('data')
        ->assertJsonPathCanonicalizing('data', $promotions);
});
