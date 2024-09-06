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
                'is_available' => true, // Indica se il servizio è disponibile
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}