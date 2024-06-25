<?php

use App\Actions\Jwt\TokenEncode;
use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Database\Seeders\CategorySeeder;
use Database\Seeders\UserSeeder;

/** @var Tests\TestCase $this */
beforeEach(function () {
    $this->seed(UserSeeder::class);
    $this->seed(CategorySeeder::class);

    /** @var User $user */
    $user = User::where('email', 'petshop@buckhill.com')->first();

    [$this->token] = app(TokenEncode::class)->handle($user->uuid);
});

test('listing categories with limit', function () {
    $this->get('/api/v1/categories?limit=2', [
        'Authorization' => "Bearer $this->token",
    ])
        ->assertStatus(200)
        ->assertJsonCount(2, 'data');
});

test('listing categories with sorting', function () {
    $categories = Category::orderBy('id', 'desc')->limit(10)->get(['uuid', 'title', 'slug', 'created_at', 'updated_at'])->map(function (Category $category) {
        return [
            'uuid' => $category->uuid,
            'title' => $category->title,
            'slug' => $category->slug,
            'created_at' => Carbon::parse($category->created_at)->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::parse($category->updated_at)->format('Y-m-d H:i:s'),
        ];
    })->toArray();

    $this->get('/api/v1/categories?sortBy=id&sort=desc', [
        'Authorization' => "Bearer $this->token",
    ])
        ->assertStatus(200)
        ->assertJsonIsArray('data')
        ->assertJsonPathCanonicalizing('data', $categories);
});
