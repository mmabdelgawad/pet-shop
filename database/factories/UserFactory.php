<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => fake()->uuid(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'is_admin' => fake()->randomElement([0, 1]),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => fake()->randomElement([now(), null]),
            'password' => bcrypt(fake()->password),
            'address' => fake()->address,
            'phone_number' => fake()->phoneNumber(),
            'is_marketing' => fake()->randomElement([0, 1]),
            'last_login_at' => fake()->randomElement([now(), null]),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
