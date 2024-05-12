<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apihotel extends Model {
    use HasFactory;

    protected $fillable = [
        'id',
        'id_t',
        'property_type_id',
        'name',
        'hotel_description',
        'star_rating',
        'review_rating',
        'review_rating_desc',
        'thumbnail',
        'thumbnail_hq',
        'city_id',
        'city_name',
        'address_line_one',
        'state_code',
        'state_name',
        'country_code',
        'country_name',
        'zip',
        'latitude',
        'longitude',
        'neighborhood_id',
        'neighborhood_name',
        'hotel_chain_id',
        'hotel_chain_group_id',
        'hotel_chain_name',
        'hotel_chain_code',
        'hotel_chain_codes_b',
        'hotel_chain_codes_t',
        'amenity_data',
        'review_score_data',
        'check_in_information',
        'plugin_data',
        'room_data',
    ];

    protected $casts = [
        'thumbnail_hq' => 'array',
        'city' => 'array',
        'address' => 'array',
        'geo' => 'array',
        'neighborhood' => 'array',
        'hotel_chain' => 'array',
        'amenity_data' => 'array',
        'review_score_data' => 'array',
        'check_in_information' => 'array',
        'plugin_data' => 'array',
        'room_data' => 'array',
    ];
}

