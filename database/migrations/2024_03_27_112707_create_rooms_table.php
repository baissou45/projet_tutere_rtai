<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            $table->foreignId('hotel_id')->nullable();

            $table->string('number')->nullable();
            $table->string('type')->nullable();
            $table->string('price')->nullable();
            $table->string('image')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('rooms');
    }
};
