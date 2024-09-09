<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('apartments')->insert([
            [
                'user_id' => 1, // ID dell'utente proprietario
                'title' => 'Appartamento Centrale',
                'rooms_num' => 3,
                'beds_num' => 2,
                'bathroom_num' => 1,
                'sq_mt' => 100,
                'address' => 'Via Roma, 10, Milano',
                'latitude' => 45.4642,
                'longitude' => 9.1900,
                'images' => 'uploads/apartments/04_LCM_SLIDER_HB_2000x1333-min.jpg',
                'visibility' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1, // Secondo appartamento per user 1
                'title' => 'Appartamento con Vista',
                'rooms_num' => 4,
                'beds_num' => 3,
                'bathroom_num' => 2,
                'sq_mt' => 120,
                'address' => 'Corso Venezia, 15, Milano',
                'latitude' => 45.4700,
                'longitude' => 9.2100,
                'images' => 'uploads/apartments/04_LCM_SLIDER_HB_2000x1333-min.jpg',
                'visibility' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1, // Terzo appartamento per user 1
                'title' => 'Monolocale in Centro',
                'rooms_num' => 1,
                'beds_num' => 1,
                'bathroom_num' => 1,
                'sq_mt' => 50,
                'address' => 'Via Manzoni, 22, Milano',
                'latitude' => 45.4675,
                'longitude' => 9.1920,
                'images' => 'uploads/apartments/04_LCM_SLIDER_HB_2000x1333-min.jpg',
                'visibility' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

    }
}