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

            $table->dateTime('conditionOriginatedDate')->nullable();
            $table->dateTime('firstConsultedDate')->nullable();
            $table->dateTime('lastSeenDate')->nullable();
            $table->dateTime('acuteManifestationDate')->nullable();
            $table->dateTime('lastXRayDate')->nullable();
            $table->enum('illnessAccidentPregnancy', ['Illness', 'Accident', 'Pregnancy', ''])->nullable();
            $table->string('autoAccidentState', 64)->nullable();
            $table->dateTime('accidentDate')->nullable();
            $table->boolean('employmentRelated')->default(false);

            $table->string('mammographyCertificateNumber', 64)->nullable();
            $table->enum('claimReason', ['Original', 'Adjustment', 'Void', ''])->nullable();
            $table->string('originalReferenceNumber', 64)->nullable();
            $table->enum('delayReason', ['Authorization', 'Delay', 'Litigation', ''])->nullable();
            $table->enum('claimNote', ['Additional', 'Block', 'Certificate', ''])->nullable();
            $table->string('codeClaimNote', 64)->nullable();
            $table->enum('lineNote', ['Additional', 'Goal', 'Payment', ''])->nullable();
            $table->string('codeLineNote', 64)->nullable();
            $table->enum('reportType', ['Admission', 'Dental', 'Discharge', ''])->nullable();
            $table->enum('reportTransmission', ['Available', 'Fax', 'Mail', ''])->nullable();
            $table->string('attachmentControlNumber', 64)->nullable();
            $table->boolean('medicaidServicesEP')->default(false);
            $table->boolean('referralGiven')->default(false);
            $table->enum('condition1', ['New', 'NotUsed', 'Patient', 'UnderTreatment', ''])->nullable();
            $table->enum('condition2', ['New', 'NotUsed', 'Patient', 'UnderTreatment', ''])->nullable();
            $table->enum('condition3', ['New', 'NotUsed', 'Patient', 'UnderTreatment', ''])->nullable();

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
