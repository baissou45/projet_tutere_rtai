<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Rapport;
use App\Models\Tournee;
use App\Models\Transfert;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Testing\Fakes\Fake;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $faker = Faker::create();

        \App\Models\User::factory(20)->create();
        User::create([
            "nom" => $faker->lastName,
            "prenom" => $faker->firstName,
            "password" => bcrypt('aaaaaaaa'),
            "sexe" => ['h', 'f'][random_int(0, 1)],
            "tel" => $faker->phoneNumber,
            "email" => "a@a.aa",
            "type" =>'a',
        ]);

        $inspecteurs = User::where('type', 'i')->get()->map(function($inspecteur) {
            $inspecteur->update([
                "secretaire_id" => User::where('type', 's')->inRandomOrder()->first()->id
            ]);

            return $inspecteur;
        });

        \App\Models\Tournee::factory(100)->create();
        Tournee::all()->map(function($tournee) use($faker, $inspecteurs){
            $tournee->update([
                "inspecteur_id" => $inspecteurs->pluck('id')->random(),
                "etat" => "Effectuer"
            ]);

            if(Carbon::parse($tournee->date)->isBefore(now())){

                Rapport::create([
                    "signature" => $faker->boolean,
                    "created_at" => $tournee->date,
                    "tournee_id" => $tournee->id,
                    "inspecteur_id" => $tournee->inspecteur_id,
                    "description" => $faker->sentence(random_int(10, 40))
                ]);

            }
        });

        for ($i=0; $i < 5; $i++) {
            Transfert::create([
                "inspecteur_id" => $inspecteurs->pluck('id')->random(),
                "secretaire_id" => User::where('type', 's')->inRandomOrder()->first()->id,
                "date_debut" => Carbon::now()->subDays(random_int(1, 3)),
                "date_fin" => Carbon::now()->addDays(random_int(6, 14)),
                "description" => $faker->sentence(random_int(3, 10)),
            ]);
        }

    }
}
