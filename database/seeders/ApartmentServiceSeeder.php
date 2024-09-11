<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApartmentServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('apartment_service')->insert([
            // Servizi per l'appartamento 1
            [
                'apartment_id' => 1,
                'extra_service_id' => 1,  // Wi-Fi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 1,
                'extra_service_id' => 2,  // Parcheggio
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 1,
                'extra_service_id' => 4,  // Aria Condizionata
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 2
            [
                'apartment_id' => 2,
                'extra_service_id' => 3,  // Piscina
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 2,
                'extra_service_id' => 5,  // Lavatrice
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 2,
                'extra_service_id' => 6,  // Animali Ammessi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 3
            [
                'apartment_id' => 3,
                'extra_service_id' => 1,  // Wi-Fi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 3,
                'extra_service_id' => 7,  // Palestra
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 4
            [
                'apartment_id' => 4,
                'extra_service_id' => 4,  // Aria Condizionata
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 4,
                'extra_service_id' => 6,  // Animali Ammessi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 5
            [
                'apartment_id' => 5,
                'extra_service_id' => 2,  // Parcheggio
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 5,
                'extra_service_id' => 5,  // Lavatrice
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 6
            [
                'apartment_id' => 6,
                'extra_service_id' => 1,  // Wi-Fi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 7
            [
                'apartment_id' => 7,
                'extra_service_id' => 7,  // Palestra
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 8
            [
                'apartment_id' => 8,
                'extra_service_id' => 3,  // Piscina
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 8,
                'extra_service_id' => 6,  // Animali Ammessi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 9
            [
                'apartment_id' => 9,
                'extra_service_id' => 4,  // Aria Condizionata
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'apartment_id' => 9,
                'extra_service_id' => 2,  // Parcheggio
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 10
            [
                'apartment_id' => 10,
                'extra_service_id' => 5,  // Lavatrice
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 11
            [
                'apartment_id' => 11,
                'extra_service_id' => 6,  // Animali Ammessi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 12
            [
                'apartment_id' => 12,
                'extra_service_id' => 3,  // Piscina
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 13
            [
                'apartment_id' => 13,
                'extra_service_id' => 7,  // Palestra
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 14
            [
                'apartment_id' => 14,
                'extra_service_id' => 1,  // Wi-Fi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 15
            [
                'apartment_id' => 15,
                'extra_service_id' => 2,  // Parcheggio
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 16
            [
                'apartment_id' => 16,
                'extra_service_id' => 6,  // Animali Ammessi
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 17
            [
                'apartment_id' => 17,
                'extra_service_id' => 3,  // Piscina
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 18
            [
                'apartment_id' => 18,
                'extra_service_id' => 7,  // Palestra
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 19
            [
                'apartment_id' => 19,
                'extra_service_id' => 4,  // Aria Condizionata
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Servizi per l'appartamento 20
            [
                'apartment_id' => 20,
                'extra_service_id' => 5,  // Lavatrice
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}