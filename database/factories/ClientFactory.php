<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class ClientFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "lastName" => $this->faker->lastName,
            "firstName" => $this->faker->firstName,
            "email" => $this->faker->email,
            "tel" => $this->faker->phoneNumber
        ];
    }
}