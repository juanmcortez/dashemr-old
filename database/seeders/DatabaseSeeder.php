<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Invoices\Charge;
use Illuminate\Database\Seeder;
use App\Models\Patients\Patient;
use App\Models\Invoices\Encounter;
use App\Models\Patients\Demographic;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $randomCreatedDate = fake()->dateTimeBetween('-5 years', 'now');
        $randomPatients = rand(2500, 9800);
        Patient::factory($randomPatients)
            ->create([
                'created_at' => $randomCreatedDate,
                'updated_at' => $randomCreatedDate,
            ])
            ->each(function ($patient) use ($randomCreatedDate) {
                // For each patient create 1 demographic
                Demographic::factory()
                    ->create([
                        'pid'           => $patient->pid,
                        'created_at'    => $randomCreatedDate,
                        'updated_at'    => $randomCreatedDate,
                    ]);

                // For each patient create a random number of encounter
                $randomEncounters = rand(1, 22);
                Encounter::factory()
                    ->count($randomEncounters)
                    ->create([
                        'pid' => $patient->pid,
                    ])
                    ->each(function ($invoice) {
                        $randomencounterCreateDate = fake()->dateTimeBetween('-3 years', 'now');
                        $invoice->entryDate = $randomencounterCreateDate;
                        $randomencounterCreateDate = fake()->dateTimeBetween('-3 years', 'now');
                        $invoice->serviceDate = $randomencounterCreateDate;
                        $invoice->update();

                        // For each encounter create a random number of charges
                        $randomCharges = rand(1, 12);
                        Charge::factory()
                            ->count($randomCharges)
                            ->create(['encounter' => $invoice->encounter]);
                    });
            });
    }
}
