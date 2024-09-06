<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        //
        DB::table('messages')->insert([
            [
                'apartment_id' => 1,
                'name' => $faker->name,
                'sender_email' => $faker->safeEmail,
                'message' => $faker->text(200),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
