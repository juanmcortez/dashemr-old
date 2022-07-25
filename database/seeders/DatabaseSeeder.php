<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Invoices\Charge;
use Illuminate\Database\Seeder;
use App\Models\Patients\Patient;
use App\Models\Invoices\Encounter;
use Illuminate\Support\Facades\DB;
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

                $extraFields = DB::connection('PGMdatabase')
                    ->select(
                        'SELECT * FROM metadata_fields_values WHERE pid = :pid AND encounter = :enc ORDER BY id_tab, id_field',
                        ['pid' => $patientInfo->pid, 'enc' => $encounterInfo->encounter]
                    );

                for ($tab = 1; $tab <= 4; $tab++) {
                    switch ($tab) {
                        case 1:
                        default:
                            $maxfield = 9;
                            break;
                        case 2:
                            $maxfield = 17;
                            break;
                        case 3:
                            $maxfield = 8;
                            break;
                    }
                    for ($field = 1; $field <= $maxfield; $field++) {
                        $extraData[$tab][$field] = null;
                        foreach ($extraFields as $fieldItems) {
                            if ($fieldItems->id_tab == $tab && $fieldItems->id_field == $field) {
                                $extraData[$tab][$field] = (empty($fieldItems->field_value)) ? null : $fieldItems->field_value;
                            }
                        }
                    }
                }

                $chargesData = DB::connection('PGMdatabase')
                    ->select(
                        'SELECT * FROM billing WHERE pid = :pid AND encounter = :enc AND code_type NOT IN ("ICD9", "ICD10")',
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
                        'consult'                       => $encounterInfo->reason,
                        'authorizationNumberID'         => $encounterInfo->authorization_id,
                        'conditionOriginatedDate'       => (empty($extraData[1][1])) ? null : date('Y-m-d', strtotime($extraData[1][1])),
                        'firstConsultedDate'            => (empty($extraData[1][2])) ? null : date('Y-m-d', strtotime($extraData[1][2])),
                        'lastSeenDate'                  => (empty($extraData[1][3])) ? null : date('Y-m-d', strtotime($extraData[1][3])),
                        'acuteManifestationDate'        => (empty($extraData[1][4])) ? null : date('Y-m-d', strtotime($extraData[1][4])),
                        'lastXRayDate'                  => (empty($extraData[1][5])) ? null : date('Y-m-d', strtotime($extraData[1][5])),
                        'illnessAccidentPregnancy'      => $extraData[1][6],
                        'autoAccidentState'             => $extraData[1][7],
                        'accidentDate'                  => (empty($extraData[1][8])) ? null : date('Y-m-d', strtotime($extraData[1][8])),
                        'employmentRelated'             => (empty($extraData[1][9]) || $extraData[1][9] == 'off') ? false : true,
                        'mammographyCertificateNumber'  => $extraData[2][1],
                        'claimReason'                   => $extraData[2][2],
                        'originalReferenceNumber'       => $extraData[2][3],
                        'delayReason'                   => $extraData[2][4],
                        'claimNote'                     => $extraData[2][5],
                        'codeClaimNote'                 => $extraData[2][6],
                        'lineNote'                      => $extraData[2][7],
                        'codeLineNote'                  => $extraData[2][8],
                        'reportType'                    => $extraData[2][9],
                        'reportTransmission'            => $extraData[2][10],
                        'attachmentControlNumber'       => $extraData[2][11],
                        'medicaidServicesEP'            => (empty($extraData[2][13]) || $extraData[2][13] == 'off') ? false : true,
                        'referralGiven'                 => (empty($extraData[2][14]) || $extraData[2][14] == 'off') ? false : true,
                        'condition1'                    => $extraData[2][15],
                        'condition2'                    => $extraData[2][16],
                        'condition3'                    => $extraData[2][17],
                        'accessionNumberLabLevel'       => $extraData[3][1],
                        'salesRepresentative'           => $extraData[3][2],
                        'locationCode'                  => $extraData[3][3],
                        'locationName'                  => $extraData[3][4],
                        'labUserDefined'                => $extraData[3][5],
                        'referenceLab'                  => $extraData[3][6],
                        'panelName'                     => $extraData[3][7],
                        'labTestType'                   => $extraData[3][8],
                    ]);

                foreach ($chargesData as $chargesInfo) {
                    $chargesInfo->anesthesia_start_time = ($chargesInfo->anesthesia_start_time == '00:00:00') ? null : $chargesInfo->anesthesia_start_time;
                    $chargesInfo->anesthesia_stop_time = ($chargesInfo->anesthesia_stop_time == '00:00:00') ? null : $chargesInfo->anesthesia_stop_time;
                    $chargesInfo->anesthesia_lapse_time = ($chargesInfo->anesthesia_lapse_time == 0) ? null : $chargesInfo->anesthesia_lapse_time;
                    Charge::factory()
                        ->create([
                            'encounter'                 => $chargesInfo->encounter,
                            'codeType'                  => $chargesInfo->code_type,
                            'code'                      => $chargesInfo->code,
                            'codeText'                  => $chargesInfo->code_desc_837,
                            'fee'                       => $chargesInfo->fee,
                            'copay'                     => 0,
                            'units'                     => $chargesInfo->units,
                            'modifier'                  => $chargesInfo->modifier,
                            'ICDitems'                  => $chargesInfo->justify,
                            'NDCvalue'                  => $chargesInfo->ndc_info,
                            'NDCquantity'               => null,
                            'NDCtype'                   => 'ML',
                            'anesthesiaStartTime'       => $chargesInfo->anesthesia_start_time,
                            'anesthesiaStopTime'        => $chargesInfo->anesthesia_stop_time,
                            'anesthesiaLapseTime'       => $chargesInfo->anesthesia_lapse_time,
                            'anesthesiaTimeUnits'       => $chargesInfo->anesthesia_time_units,
                            'anesthesiaBaseUnits'       => $chargesInfo->anesthesia_base_units,
                            'anesthesiaUnitCharge'      => $chargesInfo->anesthesia_unit_charge,
                            'anesthesiaM1'              => $chargesInfo->anesthesia_m1select,
                            'anesthesiaM2'              => $chargesInfo->anesthesia_m2select,
                            'anesthesiaInfusion'        => $chargesInfo->anesthesia_infusion,
                            'anesthesiaBasicValue'      => $chargesInfo->anesthesia_basic_value,
                            'anesthesiaModifierUnits'   => $chargesInfo->anesthesia_mods_units,
                            'noteCodes'                 => $chargesInfo->notecodes,
                            'custom1'                   => $chargesInfo->custom1,
                            'custom2'                   => $chargesInfo->custom2,
                            'custom3'                   => $chargesInfo->custom3,
                            'custom4'                   => $chargesInfo->custom4,
                            'custom5'                   => $chargesInfo->custom5,
                            'created_at'                => $chargesInfo->date,
                            'updated_at'                => $chargesInfo->updated_at,
                            'deleted_at'                => ($chargesInfo->activity) ? null : $chargesInfo->updated_at,
                        ]);
                }
            }
        }
    }
}
