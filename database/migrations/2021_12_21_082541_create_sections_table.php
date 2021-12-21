<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('status')->default(0);
            $table->unsignedBigInteger('grade_id');
            $table->foreign('grade_id')->on('grades')->references('id')
                  ->cascadeOnDelete()->cascadeOnUpdate() ;
            $table->unsignedBigInteger('class_id');
            $table->foreign('class_id')->on('classrooms')->references('id')
                   ->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('sections');
    }
}
