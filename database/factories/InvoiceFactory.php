<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $paid = $this->faker->boolean();

        return [
            'user_id' => \App\Models\User::factory(),
            'type' => $this->faker->randomElement(['B', 'C', 'P']), // Assuming 'B', 'C', 'D' are valid types
            'paid' => $paid,
            'value' => $this->faker->numberBetween(1000, 10000),
            'payment_date' => $paid ? $this->faker->randomElement([$this->faker->dateTimeThisMonth()]) : null
        ];
    }
}
