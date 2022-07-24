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

            $table->enum('codeType', ['CPT4', 'HCPCS', 'ANES', 'CVX'])->default('CPT4');
            $table->string('code', 8)->default('99213');
            $table->string('codeText', 128)->nullable();

            $table->float('fee')->default(0);
            $table->float('copay')->default(0);
            $table->integer('units')->default(1);

            $table->string('NDCvalue', 13)->nullable();
            $table->integer('NDCquantity')->nullable();
            $table->enum('NDCtype', ['ML', 'Grams', 'Miligrams', 'I.U.', 'Units'])->default('ML');

            $table->string('modifier', 64)->nullable();
            $table->string('ICDitems', 128)->nullable();

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
