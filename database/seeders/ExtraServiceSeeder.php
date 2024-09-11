<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExtraServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('extra_services')->insert([
            [
                'id' => 1,
                'name' => 'Wi-Fi',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'Parcheggio',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'Piscina',
                'is_available' => false, // In questo esempio, non è disponibile
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'Aria Condizionata',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 5,
                'name' => 'Lavatrice',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 6,
                'name' => 'Animali Ammessi',
                'is_available' => false, // Non disponibile
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 7,
                'name' => 'Palestra',
                'is_available' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

    }
}
