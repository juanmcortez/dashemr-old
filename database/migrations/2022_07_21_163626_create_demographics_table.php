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
        Schema::create('demographics', function (Blueprint $table) {
            $table->id('pid');

            $table->enum('title', ['unassigned', 'mr', 'mrs', 'ms', 'dr', 'other'])->default('unassigned');

            $table->string('firstName')->default('N');
            $table->string('middleName')->nullable();
            $table->string('lastName')->default('N');

            $table->date('dateOfBirth')->default(now());
            $table->enum('genre', ['male', 'female', 'undisclosed', 'other'])->default('undisclosed');

            $table->string('socialSecurityNumber')->nullable();
            $table->string('driverLicenseNumber')->nullable();

            $table->string('street')->nullable();
            $table->string('streetExtended')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('country')->nullable();

            $table->string('homePhone')->default('000 000-0000');
            $table->string('cellPhone')->nullable();
            $table->string('emailAddress')->nullable();

            $table->enum('civilStatus', ['unassigned', 'single', 'married', 'divorced', 'widowed', 'separated', 'domesticPartner', 'other'])->default('unassigned');

            $table->string('language')->default('en');
            $table->string('ethnicity')->default('unassigned');
            $table->string('race')->default('unassigned');

            $table->date('dateDeceased')->nullable();
            $table->string('reasonDeceased')->nullable();

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
        Schema::dropIfExists('demographics');
    }
};
