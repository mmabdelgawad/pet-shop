<?php

use App\Actions\Jwt\TokenEncode;
use App\Models\Brand;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\BrandSeeder;
use Database\Seeders\UserSeeder;

/** @var Tests\TestCase $this */
beforeEach(function () {
    $this->seed(UserSeeder::class);
    $this->seed(BrandSeeder::class);

    /** @var User $user */
    $user = User::where('email', 'petshop@buckhill.com')->first();

    [$this->token] = app(TokenEncode::class)->handle($user->uuid);
});

test('listing brands with limit', function () {
    $this->get('/api/v1/brands?limit=2', [
        'Authorization' => "Bearer $this->token",
    ])
        ->assertStatus(200)
        ->assertJsonCount(2, 'data');
});

test('listing brands with sorting', function () {
    $brands = Brand::orderBy('id', 'desc')->limit(10)->get(['uuid', 'title', 'slug', 'created_at', 'updated_at'])->map(function ($brand) {
        return [
            'uuid' => $brand->uuid,
            'title' => $brand->title,
            'slug' => $brand->slug,
            'created_at' => Carbon::parse($brand->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($brand->updated_at)->format('Y-m-d H:i:s'),
        ];
    })->toArray();

    $this->get('/api/v1/brands?sortBy=id&sort=desc', [
        'Authorization' => "Bearer $this->token",
    ])
        ->assertStatus(200)
        ->assertJsonIsArray('data')
        ->assertJsonPathCanonicalizing('data', $brands);
});
