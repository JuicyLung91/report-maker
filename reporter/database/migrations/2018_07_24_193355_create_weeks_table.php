<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWeeksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('weeks', function (Blueprint $table) {
            $table->increments('IDweeks');
            $table->unsignedInteger('startDate')->unique();
            $table->unsignedInteger('endDate')->unique();
            $table->string('schoolDate');
            $table->string('schoolDayName');
            $table->integer('workingDays');
            $table->integer('trainingYear');
            $table->foreign('startDate')->references('IDdates')->on('dates');
            $table->foreign('endDate')->references('IDdates')->on('dates');
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('weeks');
    }
}
