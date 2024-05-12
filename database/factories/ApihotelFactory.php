<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hotel>
 */
class ApihotelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
{
    return [
        'id_t' => $this->faker->unique()->randomNumber(8),
        'property_type_id' => $this->faker->numberBetween(1, 20),
        'name' => $this->faker->company,
        'hotel_description' => $this->faker->paragraph,
        'star_rating' => $this->faker->randomFloat(1, 1, 5),
        'review_rating' => $this->faker->randomFloat(1, 0, 10),
        'review_rating_desc' => $this->faker->randomElement(['Poor', 'Fair', 'Good', 'Very Good', 'Excellent']),
        'thumbnail' => $this->faker->imageUrl(),
        'thumbnail_hq' => [
            'hundred_fifty_square' => $this->faker->imageUrl(),
            'three_hundred_square' => $this->faker->imageUrl(),
        ],
        'city' => [
            'id' => $this->faker->unique()->randomNumber(8),
            'name' => $this->faker->city,
        ],
        'address' => [
            'city_name' => $this->faker->city,
            'address_line_one' => $this->faker->streetAddress,
            'state_code' => $this->faker->countryCode,
            'state_name' => $this->faker->country,
            'country_code' => $this->faker->countryCode,
            'country_name' => $this->faker->country,
            'zip' => $this->faker->postcode,
        ],
        'geo' => [
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
        ],
        'neighborhood' => [
            'id' => $this->faker->unique()->randomNumber(4),
            'name' => $this->faker->citySuffix,
        ],
        'hotel_chain' => [
            'id' => $this->faker->unique()->randomNumber(3),
            'group_id' => $this->faker->unique()->randomNumber(4),
            'name' => $this->faker->company,
            'code' => $this->faker->word,
            'chain_codes_b' => $this->faker->sentence,
            'chain_codes_t' => $this->faker->word,
        ],
        'amenity_data' => [
            [
                'id' => $this->faker->unique()->randomNumber(2),
                'name' => $this->faker->word,
            ],
            [
                'id' => $this->faker->unique()->randomNumber(2),
                'name' => $this->faker->word,
            ],
            // Add more amenities as needed
        ],
        'review_score_data' => [
            'cleanliness_score' => $this->faker->randomFloat(1, 0, 10),
        ],
        'check_in_information' => [
            'standard_check_in' => $this->faker->boolean,
        ],
        'plugin_data' => [
            'pet_friendly' => [
                'plugin_id' => $this->faker->randomNumber(1),
                'plugin_name' => 'pet_friendly',
                'hotelid_ppn' => $this->faker->unique()->randomNumber(8),
                'policy' => $this->faker->sentence,
                'policy_verified' => $this->faker->boolean,
                'enable' => $this->faker->boolean,
                'creation_date_time' => $this->faker->dateTime->format('Y-m-d H:i:s'),
            ],
        ],
        'room_data' => [
            [
                'id' => $this->faker->unique()->uuid,
                'title' => $this->faker->word,
                'description' => $this->faker->sentence,
                'room_square_footage' => $this->faker->optional()->numberBetween(100, 500),
                'rate_data' => [
                    [
                        'source' => 'PPN',
                        'rate_type' => 'MER',
                        'commission_type' => 'NET',
                        'distribution_type' => 'PUBLIC',
                        'payment_type' => 'PREPAID',
                        'board_type' => 'NONE',
                        'inventory_type' => 'BKG',
                        'program_types' => [],
                        'occupancy_limit' => $this->faker->numberBetween(1, 4),
                        'available_rooms' => $this->faker->numberBetween(1, 20),
                        'ppn_bundle' => $this->faker->word,
                        'rate_plan_code' => $this->faker->word,
                        'rate_tracking_id' => $this->faker->uuid,
                        'benchmark_price_details' => [
                            'saving_percentage' => $this->faker->numberBetween(0, 50),
                            'baseline_currency' => $this->faker->currencyCode,
                            'baseline_price' => $this->faker->randomFloat(2, 50, 200),
                            'source_currency' => $this->faker->currencyCode,
                            'source_price' => $this->faker->randomFloat(2, 50, 200),
                            'display_currency' => $this->faker->currencyCode,
                            'display_price' => $this->faker->randomFloat(2, 50, 200),
                        ],
                        'price_details' => [
                            'baseline_currency' => $this->faker->currencyCode,
                            'baseline_symbol' => '$',
                            'baseline_price' => $this->faker->randomFloat(2, 50, 200),
                            'baseline_sub_total' => $this->faker->randomFloat(2, 50, 200),
                            'baseline_total' => $this->faker->randomFloat(2, 50, 200),
                            'source_currency' => $this->faker->currencyCode,
                            'source_symbol' => '$',
                            'source_price' => $this->faker->randomFloat(2, 50, 200),
                            'source_sub_total' => $this->faker->randomFloat(2, 50, 200),
                            'source_total' => $this->faker->randomFloat(2, 50, 200),
                            'display_currency' => $this->faker->currencyCode,
                            'display_symbol' => '$',
                            'display_price' => $this->faker->randomFloat(2, 50, 200),
                            'display_sub_total' => $this->faker->randomFloat(2, 50, 200),
                            'display_total' => $this->faker->randomFloat(2, 50, 200),
                        ],
                        'refund_type' => $this->faker->randomElement(['NONE', 'PARTIAL', 'FULL']),
                        'deposit_required' => $this->faker->boolean(),
                        'language' => $this->faker->languageCode,
                    ],
                    // Ajouter d'autres données de taux au besoin
                ],
            ],
            // Ajouter d'autres données de chambre au besoin
        ],
    ];
}

}



