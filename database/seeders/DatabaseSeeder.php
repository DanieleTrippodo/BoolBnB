<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ExtraServices;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            UserSeeder::class,
            ApartmentSeeder::class,
            SponsorSeeder::class,
            ViewSeeder::class,
            MessageSeeder::class,
            ExtraServiceSeeder::class,
            ApartmentServiceSeeder::class,

        ]);


    }
}