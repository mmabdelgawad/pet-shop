<?php

use App\Actions\Jwt\TokenEncode;
use App\Http\Resources\UserOrdersResource;
use App\Models\Order;
use App\Models\User;
use Database\Seeders\UserSeeder;

/** @var Tests\TestCase $this */
beforeEach(function () {
    $this->seed(UserSeeder::class);

    /** @var User $user */
    $user = User::where('email', 'petshop@buckhill.com')->first();

    [$this->token] = app(TokenEncode::class)->handle($user->uuid);
});

test('listing user orders with limit', function () {
    $this->get('/api/v1/user/orders?limit=2', [
        'Authorization' => "Bearer $this->token",
    ])
        ->assertStatus(200)
        ->assertJsonCount(2, 'data');
});

test('only this user orders are returned', function () {
    $otherUserOrders = Order::where('user_id', '2')->with(['payment', 'orderStatus'])->get();
    $resource = UserOrdersResource::collection($otherUserOrders)->response()->getData(true)['data'];

    $response = $this->get('/api/v1/user/orders', [
        'Authorization' => "Bearer $this->token",
    ])
        ->assertStatus(200);

    expect($response->json('data'))->not()->toEqual($resource);
});
