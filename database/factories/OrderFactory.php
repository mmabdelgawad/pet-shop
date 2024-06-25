<?php

namespace Database\Factories;

use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'order_status_id' => OrderStatus::factory()->create()->id,
            'payment_id' => Payment::factory()->create()->id,
            'uuid' => fake()->uuid,
            'products' => [
                [
                    'name' => fake()->word,
                    'price' => fake()->randomFloat(2, 0, 100),
                    'quantity' => fake()->randomNumber(2),
                ],
                [
                    'name' => fake()->word,
                    'price' => fake()->randomFloat(2, 0, 100),
                    'quantity' => fake()->randomNumber(2),
                ],
            ],
            'address' => [
                'street' => fake()->streetAddress,
                'city' => fake()->city,
                'zip' => fake()->postcode,
            ],
            'delivery_fee' => fake()->randomFloat(2, 0, 100),
            'amount' => fake()->randomFloat(2, 0, 100),
            'shipped_at' => fake()->dateTime,
        ];
    }
}
