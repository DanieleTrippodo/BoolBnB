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
            // Appartamenti per user_id 1
            [
                'user_id' => 1, // ID dell'utente 1
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
                'images' => 'uploads/apartments/AdobeStock_297606677-scaled.jpeg',
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
                'images' => 'uploads/apartments/casa-moderna-_800x478.jpg',
                'visibility' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Appartamenti per user_id 2
            [
                'user_id' => 2,
                'title' => 'Bilocale vicino al Duomo',
                'rooms_num' => 2,
                'beds_num' => 1,
                'bathroom_num' => 1,
                'sq_mt' => 70,
                'address' => 'Via Dante, 5, Milano',
                'latitude' => 45.4680,
                'longitude' => 9.1870,
                'images' => 'uploads/apartments/appartamento2.jpeg',
                'visibility' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Appartamenti per user_id 3
            [
                'user_id' => 3,
                'title' => 'Attico con Terrazza',
                'rooms_num' => 5,
                'beds_num' => 4,
                'bathroom_num' => 3,
                'sq_mt' => 200,
                'address' => 'Via Vittorio Veneto, 30, Roma',
                'latitude' => 41.9028,
                'longitude' => 12.4964,
                'images' => 'uploads/apartments/appartamento3.jpeg',
                'visibility' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Appartamenti per user_id 4
            [
                'user_id' => 4,
                'title' => 'Appartamento vicino al mare',
                'rooms_num' => 3,
                'beds_num' => 2,
                'bathroom_num' => 1,
                'sq_mt' => 90,
                'address' => 'Via Lungomare, 12, Napoli',
                'latitude' => 40.8518,
                'longitude' => 14.2681,
                'images' => 'uploads/apartments/appartamento4.jpeg',
                'visibility' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Appartamenti per user_id 5
            [
                'user_id' => 5,
                'title' => 'Trilocale Moderno',
                'rooms_num' => 3,
                'beds_num' => 2,
                'bathroom_num' => 2,
                'sq_mt' => 110,
                'address' => 'Via Garibaldi, 7, Firenze',
                'latitude' => 43.7696,
                'longitude' => 11.2558,
                'images' => 'uploads/apartments/appartamento5.jpeg',
                'visibility' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Appartamenti per user_id 6
            [
                'user_id' => 6,
                'title' => 'Appartamento vicino al Parco',
                'rooms_num' => 4,
                'beds_num' => 3,
                'bathroom_num' => 2,
                'sq_mt' => 130,
                'address' => 'Via Verdi, 2, Torino',
                'latitude' => 45.0703,
                'longitude' => 7.6869,
                'images' => 'uploads/apartments/appartamento6.jpeg',
                'visibility' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            // Appartamenti per user_id 7
            [
                'user_id' => 7,
                'title' => 'Monolocale Economico',
                'rooms_num' => 1,
                'beds_num' => 1,
                'bathroom_num' => 1,
                'sq_mt' => 40,
                'address' => 'Via Milano, 50, Genova',
                'latitude' => 44.4056,
                'longitude' => 8.9463,
                'images' => 'uploads/apartments/appartamento7.jpeg',
                'visibility' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}