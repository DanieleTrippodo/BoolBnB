<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Apartment;

class SponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sponsor')->insert([
            'apartment_id' => 1,
            'sponsorship_plan' => 'Premium',
            'duration' => 30,
            'cost' => 9,99
        ]);
    }
}
