<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use App\Models\Patients\Invoice;
use App\Models\Patients\Patient;
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

                // For each patient create a random number of invoices
                $randomInvoices = rand(1, 22);
                Invoice::factory()
                    ->count($randomInvoices)
                    ->create([
                        'pid'           => $patient->pid,
                    ])
                    ->each(function ($invoice) {
                        $randomInvoiceCreateDate = fake()->dateTimeBetween('-3 years', 'now');
                        $invoice->entryDate = $randomInvoiceCreateDate;
                        $randomInvoiceCreateDate = fake()->dateTimeBetween('-3 years', 'now');
                        $invoice->serviceDate = $randomInvoiceCreateDate;
                        $invoice->update();
                    });
            });
    }
}
