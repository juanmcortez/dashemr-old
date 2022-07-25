<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Invoices\Charge;
use Illuminate\Database\Seeder;
use App\Models\Patients\Patient;
use App\Models\Invoices\Encounter;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Continue_;
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
        /*$randomCreatedDate = fake()->dateTimeBetween('-5 years', 'now');
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
            });*/

        // $users = DB::connection('mysql2')->select('SELECT * FROM patient_data WHERE id = :id', ['id' => 1]);
        /*$users = DB::connection('mysql2')->select('SELECT COUNT(*) FROM patient_data');
        var_dump($users);*/

        $patientData = DB::connection('PGMdatabase')->select('SELECT * FROM patient_data');
        foreach ($patientData as $patientInfo) {
            Patient::factory()
                ->create([
                    'externalPid'   => $patientInfo->pubpid,
                    'created_at'    => $patientInfo->date,
                    'updated_at'    => $patientInfo->date,
                ]);

            $patientInfo->DOB = ($patientInfo->DOB == '0000-00-00' || $patientInfo->DOB == null) ? now()->format('Y-m-d') : $patientInfo->DOB;
            $patientInfo->deceased_date = ($patientInfo->deceased_date == '0000-00-00 00:00:00') ? null : $patientInfo->deceased_date;

            Demographic::factory()
                ->create([
                    'pid'                   => $patientInfo->pid,
                    'title'                 => $patientInfo->title,
                    'firstName'             => $patientInfo->fname,
                    'middleName'            => $patientInfo->mname,
                    'lastName'              => $patientInfo->lname,
                    'dateOfBirth'           => $patientInfo->DOB,
                    'genre'                 => $patientInfo->sex,
                    'socialSecurityNumber'  => $patientInfo->ss,
                    'driverLicenseNumber'   => $patientInfo->drivers_license,
                    'street'                => $patientInfo->street,
                    'city'                  => $patientInfo->city,
                    'state'                 => $patientInfo->state,
                    'zip'                   => $patientInfo->postal_code,
                    'country'               => $patientInfo->country_code,
                    'homePhone'             => $patientInfo->phone_home,
                    'cellPhone'             => $patientInfo->phone_cell,
                    'emailAddress'          => $patientInfo->email,
                    'civilStatus'           => $patientInfo->status,
                    'language'              => $patientInfo->language,
                    'ethnicity'             => $patientInfo->ethnicity,
                    'race'                  => $patientInfo->race,
                    'dateDeceased'          => $patientInfo->deceased_date,
                    'reasonDeceased'        => $patientInfo->deceased_reason,
                    'created_at'            => $patientInfo->date,
                    'updated_at'            => $patientInfo->date,
                ]);

            $encounterData = DB::connection('PGMdatabase')
                ->select('SELECT * FROM form_encounter WHERE pid = :pid', ['pid' => $patientInfo->pid]);

            foreach ($encounterData as $encounterInfo) {

                $encounterInfo->onset_date = ($encounterInfo->onset_date == '0000-00-00 00:00:00') ? null : $encounterInfo->onset_date;
                $encounterInfo->discharge_date = ($encounterInfo->discharge_date == '0000-00-00') ? null : $encounterInfo->discharge_date;

                $chargesData = DB::connection('PGMdatabase')
                    ->select(
                        'SELECT * FROM billing WHERE pid = :pid AND encounter = :enc AND code_type NOT IN ("ICD9", "ICD10") AND activity = 1',
                        ['pid' => $patientInfo->pid, 'enc' => $encounterInfo->encounter]
                    );

                Encounter::factory()
                    ->create([
                        'encounter'                     => $encounterInfo->encounter,
                        'pid'                           => $encounterInfo->pid,
                        'entryDate'                     => $chargesData[0]->date,
                        'serviceDate'                   => $encounterInfo->date,
                        'serviceDateTo'                 => $encounterInfo->date_to,
                        'facilityID'                    => $encounterInfo->facility_id,
                        'billingFacilityID'             => $encounterInfo->facility_id,
                        'placeOfServiceID'              => $encounterInfo->place_of_service,
                        'sensitivity'                   => $encounterInfo->sensitivity,
                        'admisionDate'                  => $encounterInfo->onset_date,
                        'dischargeDate'                 => $encounterInfo->discharge_date,
                        'renderingProviderID'           => $encounterInfo->referring_physician_id,
                        'referringProviderID'           => $encounterInfo->provider_id,
                        'orderingProviderID'            => $encounterInfo->ordering_physician_id,
                        'supervisingProviderID'         => $encounterInfo->supervising_physician_id,
                        'consult'                       => null,
                        'authorizationNumberID'         => $encounterInfo->authorization_id,
                        'conditionOriginatedDate'       => null,
                        'firstConsultedDate'            => null,
                        'lastSeenDate'                  => null,
                        'acuteManifestationDate'        => null,
                        'lastXRayDate'                  => null,
                        'illnessAccidentPregnancy'      => null,
                        'autoAccidentState'             => null,
                        'accidentDate'                  => null,
                        'employmentRelated'             => false,
                        'mammographyCertificateNumber'  => null,
                        'claimReason'                   => null,
                        'originalReferenceNumber'       => null,
                        'delayReason'                   => null,
                        'claimNote'                     => null,
                        'codeClaimNote'                 => null,
                        'lineNote'                      => null,
                        'codeLineNote'                  => null,
                        'reportType'                    => null,
                        'reportTransmission'            => null,
                        'attachmentControlNumber'       => null,
                        'medicaidServicesEP'            => false,
                        'referralGiven'                 => false,
                        'condition1'                    => null,
                        'condition2'                    => null,
                        'condition2'                    => null,
                    ]);

                foreach ($chargesData as $chargesInfo) {

                    Charge::factory()
                        ->create([
                            'encounter'     => $chargesInfo->encounter,
                            'codeType'      => $chargesInfo->code_type,
                            'code'          => $chargesInfo->code,
                            'codeText'      => $chargesInfo->code_desc_837,
                            'fee'           => $chargesInfo->fee,
                            'copay'         => 0,
                            'units'         => $chargesInfo->units,
                            'NDCvalue'      => $chargesInfo->ndc_info,
                            'NDCquantity'   => null,
                            'NDCtype'       => 'ML',
                            'modifier'      => $chargesInfo->modifier,
                            'noteCodes'     => $chargesInfo->notecodes,
                            'custom1'       => $chargesInfo->custom1,
                            'custom2'       => $chargesInfo->custom2,
                            'custom3'       => $chargesInfo->custom3,
                            'custom4'       => $chargesInfo->custom4,
                            'custom5'       => $chargesInfo->custom5,
                            'ICDitems'      => $chargesInfo->justify,
                        ]);
                }
            }
        }
    }
}
