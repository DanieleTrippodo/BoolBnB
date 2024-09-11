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
            [
                'name' => 'Giovanni',
                'surname' => 'Gino',
                'email' => 'admin@gmail.com',
                'date_of_birth'=> '2000-01-01',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Marco',
                'surname' => 'Rossi',
                'email' => 'marco.rossi@gmail.com',
                'date_of_birth'=> '1995-02-02',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Luca',
                'surname' => 'Verdi',
                'email' => 'luca.verdi@gmail.com',
                'date_of_birth'=> '1998-03-03',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Paolo',
                'surname' => 'Bianchi',
                'email' => 'paolo.bianchi@gmail.com',
                'date_of_birth'=> '1992-04-04',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Francesco',
                'surname' => 'Neri',
                'email' => 'francesco.neri@gmail.com',
                'date_of_birth'=> '1988-05-05',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Andrea',
                'surname' => 'Gialli',
                'email' => 'andrea.gialli@gmail.com',
                'date_of_birth'=> '1990-06-06',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Matteo',
                'surname' => 'Blu',
                'email' => 'matteo.blu@gmail.com',
                'date_of_birth'=> '1985-07-07',
                'password'=> Hash::make('password'),
            ]
        ]);
    }
}