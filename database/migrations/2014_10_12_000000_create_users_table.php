<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('tel');
            $table->enum('sexe', ['h', 'f'])->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('type', ['s', 'i', 'a'])->nullable()->default('i')->comment('I pour inspecteur, S pour sécretaire et A pour Admin');
            $table->foreignId('secretaire_id')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
