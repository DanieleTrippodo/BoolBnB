<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ApartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
          // Esempio di relazione tra appartamenti e servizi extra
        DB::table('apartment_service')->insert([
            [
                'apartment_id' => 1,  // ID dell'appartamento
                'extra_service_id' => 1,  // ID del servizio extra (Wi-Fi)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 1,  // ID dell'appartamento
                'extra_service_id' => 2,  // ID del servizio extra (Parcheggio)
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 2,  // Un altro appartamento
                'extra_service_id' => 3,  // Piscina
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 2,
                'extra_service_id' => 4,  // Aria Condizionata
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 3,
                'extra_service_id' => 5,  // Lavatrice
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 3,
                'extra_service_id' => 6,  // Animali Ammessi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 3,
                'extra_service_id' => 7,  // Palestra
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}