<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $messages = [];
        $apartmentIds = [1, 2, 3, 4, 5, 6, 7]; // Gli ID degli appartamenti esistenti

        // Genera 15 messaggi
        for ($i = 0; $i < 15; $i++) {
            // Ogni messaggio sarà associato a un appartamento a rotazione
            $messages[] = [
                'apartment_id' => $apartmentIds[$i % count($apartmentIds)], // Distribuisci tra appartamenti
                'name' => $faker->name,
                'sender_email' => $faker->safeEmail,
                'message' => $faker->text(200),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // Inserisci i messaggi nel database
        DB::table('messages')->insert($messages);
    }
}