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
                'images' => 'image1.jpg',
                'visibility' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]
         ]);

    }
}