<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('apihotels', function (Blueprint $table) {
            $table->id();
            $table->string('id_t')->unique();
            $table->integer('property_type_id');
            $table->string('name');
            $table->text('hotel_description');
            $table->decimal('star_rating', 3, 1);
            $table->decimal('review_rating', 3, 1);
            $table->string('review_rating_desc');
            $table->string('thumbnail');
            $table->json('thumbnail_hq');
            $table->json('city');
            $table->json('address');
            $table->json('geo');
            $table->json('neighborhood');
            $table->json('hotel_chain');
            $table->json('amenity_data');
            $table->json('review_score_data');
            $table->json('check_in_information');
            $table->json('plugin_data');
            $table->json('room_data');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('apihotels');
    }
};
