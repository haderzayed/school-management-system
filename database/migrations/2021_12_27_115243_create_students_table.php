<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->unsignedBigInteger('gender_id');
            $table->foreign('gender_id')->on('genders')->references('id')
                  ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('nationality_id');
            $table->foreign('nationality_id')->on('nationalities')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('blood_id');
            $table->foreign('blood_id')->on('bloods')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('grade_id');
            $table->foreign('grade_id')->on('grades')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->on('classrooms')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->foreign('section_id')->on('sections')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->unsignedBigInteger('parent_id');
            $table->foreign('parent_id')->on('my_parents')->references('id')
                ->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('date_birth');
            $table->string('academic_year');
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
        Schema::dropIfExists('students');
    }
}
