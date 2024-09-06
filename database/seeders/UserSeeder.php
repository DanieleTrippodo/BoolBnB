<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{

    public function run(): void
    {
        DB::table('users')->insert([
            'name' =>  'Giovanni',
            'surname' => 'Gino',
            'email' => 'admin@gmail.com',
            'date_of_birth'=> '2000-01-01',
            'password'=> Hash::make ('password'),
        ]);
    }
}
