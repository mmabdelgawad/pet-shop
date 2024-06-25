<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
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
            'title' => fake()->word(),
            'content' => fake()->paragraph(),
            'metadata' => [
                'valid_from' => fake()->dateTimeBetween('-1 month')->format('Y-m-d H:i:s'),
                'valid_to' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d H:i:s'),
            ],
        ];
    }

    /**
     * Indicate that the model's promotion should be invalid.
     */
    public function invalid(): static
    {
        return $this->state(fn (array $attributes) => [
            'metadata' => [
                'valid_from' => fake()->dateTimeBetween('-2 month', '-1 month')->format('Y-m-d H:i:s'),
                'valid_to' => fake()->dateTimeBetween('-1 month', '-1 day')->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}
