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
            $table->unsignedInteger('startDate');
            $table->unsignedInteger('endDate');
            $table->unsignedInteger('schoolDate');
            $table->string('schoolDayName');
            $table->integer('workingDays');
            $table->foreign('startDate')->references('IDdates')->on('dates');
            $table->foreign('endDate')->references('IDdates')->on('dates');
            $table->foreign('schoolDate')->references('IDdates')->on('dates');
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
