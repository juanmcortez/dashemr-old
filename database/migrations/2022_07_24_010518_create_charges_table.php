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
        Schema::create('charges', function (Blueprint $table) {
            $table->id('chargeID');

            $table->unsignedBigInteger('encounter');
            $table->foreign('encounter')->references('encounter')->on('encounters');

            $table->enum('codeType', ['CPT4', 'HCPCS', 'ANES', 'CVX', ''])->default('CPT4')->nullable();
            $table->string('code', 8)->default('99213');
            $table->string('codeText', 128)->nullable();

            $table->float('fee', 8, 2)->default(0);
            $table->float('copay', 8, 2)->default(0);
            $table->integer('units')->default(1);

            $table->string('modifier', 64)->nullable();
            $table->text('ICDitems')->nullable();

            $table->string('NDCvalue', 32)->nullable();
            $table->integer('NDCquantity')->nullable();
            $table->enum('NDCtype', ['ML', 'Grams', 'Miligrams', 'I.U.', 'Units'])->default('ML');

            $table->timestamp('anesthesiaStartTime')->nullable();
            $table->timestamp('anesthesiaStopTime')->nullable();
            $table->timestamp('anesthesiaLapseTime')->nullable();
            $table->integer('anesthesiaTimeUnits')->default(0)->nullable();
            $table->integer('anesthesiaBaseUnits')->default(0)->nullable();
            $table->float('anesthesiaUnitCharge', 8, 2)->default(0)->nullable();
            $table->string('anesthesiaM1')->nullable();
            $table->string('anesthesiaM2')->nullable();
            $table->string('anesthesiaInfusion')->nullable();
            $table->float('anesthesiaBasicValue', 8, 2)->default(0)->nullable();
            $table->integer('anesthesiaModifierUnits')->default(0)->nullable();

            $table->text('noteCodes')->nullable();
            $table->string('custom1', 64)->nullable();
            $table->string('custom2', 64)->nullable();
            $table->string('custom3', 64)->nullable();
            $table->string('custom4', 64)->nullable();
            $table->string('custom5', 64)->nullable();

            $table->timestamps();
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
        Schema::dropIfExists('charges');
    }
};
