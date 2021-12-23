<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMyParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('my_parents', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('password');

            //father information
            $table->string('father_name');
            $table->string('national_id_father');
            $table->string('passport_id_father');
            $table->string('phone_father');
            $table->string('job_father');
            $table->string('address_father');
            $table->unsignedBigInteger('nationality_father_id');
            $table->foreign('nationality_father_id')->on('nationalities')->references('id')
                   ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('blood_type_father_id');
            $table->foreign('blood_type_father_id')->on('bloods')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('religion_father_id');
            $table->foreign('religion_father_id')->on('religions')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            //mother information
            $table->string('mother_name');
            $table->string('national_id_mother');
            $table->string('passport_id_mother')->nullable();
            $table->string('phone_mother');
            $table->string('job_mother');
            $table->string('address_mother');
            $table->unsignedBigInteger('nationality_mother_id');
            $table->foreign('nationality_mother_id')->on('nationalities')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('blood_type_mother_id');
            $table->foreign('blood_type_mother_id')->on('bloods')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('religion_mother_id');
            $table->foreign('religion_mother_id')->on('religions')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('my_parents');
    }
}
