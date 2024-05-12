<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Room>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hotel_id' => $this->faker->numberBetween(1, 10),
            'number' => $this->faker->numberBetween(40, 200),
            'type' => $this->faker->randomElement(["Single King bed", "Double Queens bed", "Queen bed", "King bed", "Twin beds", "Sofa bed", "Bunk bed", "Single King Handicap", "Double Queen Handicap", "Single King Suite", "Double Queen Suite", "Executive"]),
            'price' => $this->faker->numberBetween(1, 10),
            'description' => $this->faker->paragraph($this->faker->numberBetween(1, 3), false),
            'image' => $this->faker->imageUrl(640, 480),
        ];
    }
}