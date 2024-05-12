<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Client;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run() {

        User::factory(1)->create();
        // Apihotel::factory(10)->create();
        Hotel::factory(10)->create();
        Room::factory(50)->create();
        Client::factory(100)->create();
    }
}
