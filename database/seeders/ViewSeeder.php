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
        DB::table('views')->insert([
            'apartment_id' => 1,
            'view_date' => $faker->date('Y-m-d', 'now'),
            'ip_address' => '192.168.0.1',
        ]);
    }
}