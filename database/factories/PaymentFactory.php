<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $supportedTypes = [
            'credit_card',
            'cash_on_delivery',
            'bank_transfer',
        ];

        return [
            'uuid' => fake()->uuid,
            'type' => fake()->randomElement($supportedTypes),
            'details' => json_encode([
                'card_type' => fake()->creditCardType,
                'last_four' => fake()->randomNumber(4),
                'expiration_date' => fake()->creditCardExpirationDate,
            ]),
        ];
    }
}
