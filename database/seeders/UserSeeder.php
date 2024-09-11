<?php

namespace Database\Seeders;

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
            ],
            [
                'name' => 'Chiara',
                'surname' => 'Viola',
                'email' => 'chiara.viola@gmail.com',
                'date_of_birth'=> '1993-08-08',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Sara',
                'surname' => 'Rosa',
                'email' => 'sara.rosa@gmail.com',
                'date_of_birth'=> '1997-09-09',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Alessandro',
                'surname' => 'Marrone',
                'email' => 'alessandro.marrone@gmail.com',
                'date_of_birth'=> '1989-10-10',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Giorgio',
                'surname' => 'Azzurri',
                'email' => 'giorgio.azzurri@gmail.com',
                'date_of_birth'=> '1982-11-11',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Martina',
                'surname' => 'Ciano',
                'email' => 'martina.ciano@gmail.com',
                'date_of_birth'=> '1994-12-12',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Elena',
                'surname' => 'Argento',
                'email' => 'elena.argento@gmail.com',
                'date_of_birth'=> '1996-01-01',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Fabio',
                'surname' => 'Oro',
                'email' => 'fabio.oro@gmail.com',
                'date_of_birth'=> '1980-02-02',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Simone',
                'surname' => 'Zaffiro',
                'email' => 'simone.zaffiro@gmail.com',
                'date_of_birth'=> '1991-03-03',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Giulia',
                'surname' => 'Perla',
                'email' => 'giulia.perla@gmail.com',
                'date_of_birth'=> '1987-04-04',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Valentina',
                'surname' => 'Corallo',
                'email' => 'valentina.corallo@gmail.com',
                'date_of_birth'=> '1984-05-05',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Federico',
                'surname' => 'Rubino',
                'email' => 'federico.rubino@gmail.com',
                'date_of_birth'=> '1999-06-06',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Ilaria',
                'surname' => 'Zaffiro',
                'email' => 'ilaria.zaffiro@gmail.com',
                'date_of_birth'=> '1992-07-07',
                'password'=> Hash::make('password'),
            ],
            [
                'name' => 'Stefano',
                'surname' => 'Topazio',
                'email' => 'stefano.topazio@gmail.com',
                'date_of_birth'=> '1983-08-08',
                'password'=> Hash::make('password'),
            ],
        ]);
    }
}