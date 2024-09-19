<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ApartmentSponsorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ottieni tutti i piani di sponsorizzazione e 7 appartamenti casuali
        $sponsorIds = DB::table('sponsors')->pluck('id')->toArray();
        $apartmentIds = DB::table('apartments')->inRandomOrder()->limit(7)->pluck('id')->toArray();

        $sponsorings = [];
        $startDate = Carbon::now();

        foreach ($apartmentIds as $apartmentId) {
            // Seleziona un piano di sponsorizzazione casuale
            $sponsorId = $sponsorIds[array_rand($sponsorIds)];

            // Ottieni la durata del piano selezionato
            $duration = DB::table('sponsors')->where('id', $sponsorId)->value('duration');
            $endDate = $startDate->copy()->addHours($duration);

            // Aggiungi l'associazione alla tabella ponte
            $sponsorings[] = [
                'apartment_id' => $apartmentId,
                'sponsor_id' => $sponsorId,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }

        // Inserisci le associazioni nella tabella apartment_sponsor
        DB::table('apartment_sponsor')->insert($sponsorings);
    }
}