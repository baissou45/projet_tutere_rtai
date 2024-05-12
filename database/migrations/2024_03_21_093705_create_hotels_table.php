<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void {
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id');

            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('tel')->nullable();
            $table->string('email')->nullable();
            $table->string('country');
            $table->double('long')->nullable();
            $table->double('lat')->nullable();
            $table->float('rate');
            $table->string('zip');
            $table->string('state')->nullable();
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('hotels');
    }
};
