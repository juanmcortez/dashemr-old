<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('encounters', function (Blueprint $table) {
            $table->id('encounter');

            $table->unsignedBigInteger('pid');
            $table->foreign('pid')->references('pid')->on('patients');

            $table->dateTime('entryDate')->default(now());
            $table->dateTime('serviceDate')->default(now());
            $table->dateTime('serviceDateTo')->nullable();

            $table->unsignedBigInteger('facilityID')->nullable();
            $table->unsignedBigInteger('billingFacilityID')->nullable();
            $table->unsignedBigInteger('placeOfServiceID')->nullable();
            $table->enum('sensitivity', ['Normal', 'High', 'None'])->default('Normal');

            $table->dateTime('admisionDate')->nullable();
            $table->dateTime('dischargeDate')->nullable();

            $table->unsignedBigInteger('renderingProviderID')->nullable();
            $table->unsignedBigInteger('referringProviderID')->nullable();
            $table->unsignedBigInteger('orderingProviderID')->nullable();
            $table->unsignedBigInteger('supervisingProviderID')->nullable();

            $table->longText('consult')->nullable();
            $table->unsignedBigInteger('authorizationNumberID')->nullable();
            // Problem Tab
            $table->dateTime('conditionOriginatedDate')->nullable();
            $table->dateTime('firstConsultedDate')->nullable();
            $table->dateTime('lastSeenDate')->nullable();
            $table->dateTime('acuteManifestationDate')->nullable();
            $table->dateTime('lastXRayDate')->nullable();
            $table->enum('illnessAccidentPregnancy', ['Illness', 'Accident', 'Pregnancy', ''])->nullable();
            $table->string('autoAccidentState', 64)->nullable();
            $table->dateTime('accidentDate')->nullable();
            $table->boolean('employmentRelated')->default(false);
            // Miscellaneous Tab
            $table->string('mammographyCertificateNumber', 64)->nullable();
            $table->enum('claimReason', ['OriginalClaim', 'AdjustmentReplacementPreviousClaim', 'VoidCancelPreviousClaim', ''])->nullable();
            $table->string('originalReferenceNumber', 64)->nullable();
            $table->enum('delayReason', ['AuthorizationDelays', 'DelayCertifyingProvider', 'DelayCustomMadeAppliances', 'DelayEligibilityDetermination', 'DelayPriorApproval', 'DelaySupplyingBillingForms', 'Litigation', 'OriginalDeniedNotBillingLimit', 'Other', 'ProofEligibilityUnavailable', ''])->nullable();
            $table->enum('claimNote', ['AdditionalInformation', 'Block19PaperClaim', 'CertificationNarrative', 'DiagnosisDescription', 'GoalPlans', 'Payment', 'ThirdPartyOrganization', ''])->nullable();
            $table->string('codeClaimNote', 64)->nullable();
            $table->enum('lineNote', ['AdditionalInformation', 'GoalPlans', 'Payment', 'ThirdPartyOrganizationNot', ''])->nullable();
            $table->string('codeLineNote', 64)->nullable();
            $table->enum('reportType', ['AdmissionSummary', 'Certification', 'DentalModels', 'DiagnosticReport', 'DischargeSummary', ''])->nullable();
            $table->enum('reportTransmission', ['AvailableProviderSite', 'ByFax', 'ByMail', 'ElectronicOnly', 'Email', ''])->nullable();
            $table->string('attachmentControlNumber', 64)->nullable();
            $table->boolean('medicaidServicesEP')->default(false);
            $table->boolean('referralGiven')->default(false);
            $table->enum('condition1', ['NewServicesRequested', 'NotUsed', 'PatientRefusedReferral', 'UnderTreatment', ''])->nullable();
            $table->enum('condition2', ['NewServicesRequested', 'NotUsed', 'PatientRefusedReferral', 'UnderTreatment', ''])->nullable();
            $table->enum('condition3', ['NewServicesRequested', 'NotUsed', 'PatientRefusedReferral', 'UnderTreatment', ''])->nullable();
            // Labs Tab
            $table->string('accessionNumberLabLevel', 64)->nullable();
            $table->string('salesRepresentative', 64)->nullable();
            $table->string('locationCode', 64)->nullable();
            $table->string('locationName', 64)->nullable();
            $table->string('labUserDefined', 64)->nullable();
            $table->string('referenceLab', 64)->nullable();
            $table->string('panelName', 64)->nullable();
            $table->string('labTestType', 64)->nullable();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('encounters');
    }
};
