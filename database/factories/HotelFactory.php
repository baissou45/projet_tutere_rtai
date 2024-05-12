<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class HotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            "city" => $this->faker->city,
            "country" => $this->faker->country,
            "zip" => $this->faker->postcode,
            "rate" => $this->faker->numberBetween(1, 5),
            "description" => $this->faker->paragraphs(3, true),
            "user_id" => 1,
            "tel" => $this->faker->phoneNumber,
            "email" => $this->faker->safeEmail,
            "long" => $this->faker->longitude,
            "lat" => $this->faker->latitude,
            "state"  => $this->faker->country
        ];
    }
}
