<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tournee>
 */
class TourneeFactory extends Factory {
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array {
        return [
            "adresse_complet" => $this->faker->address,
            "date" => Carbon::now()->addDay(mt_rand(-60, 14)),
            "etat" => ['Programmer', 'Non Effectuer', "Effectuer", "Annuler"][random_int(0, 3)],
        ];
    }
}
