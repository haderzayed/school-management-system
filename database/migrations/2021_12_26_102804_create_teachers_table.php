<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('password');
            $table->string('name');
            $table->unsignedBigInteger('specialization_id');
            $table->foreign('specialization_id')->on('specializations')->references('id')
                  ->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('gender_id');
            $table->foreign('gender_id')->on('genders')->references('id')
                ->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('joining_date');
            $table->text('address');
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
        Schema::dropIfExists('teachers');
    }
}
