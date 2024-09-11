<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Apartment;
use Faker\Generator as Faker;

class ViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        // Ottieni tutti gli appartamenti esistenti
        $apartments = Apartment::all();

        foreach ($apartments as $apartment) {
            // Genera un numero casuale di visualizzazioni per ogni appartamento
            for ($i = 0; $i < rand(5, 15); $i++) {
                DB::table('views')->insert([
                    'apartment_id' => $apartment->id,
                    'view_date' => $faker->dateTimeBetween('-1 year', 'now'),
                    'ip_address' => $faker->ipv4,
                ]);
            }
        }
    }
}