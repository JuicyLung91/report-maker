<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvalidDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('invalid_days', function (Blueprint $table) {
            $table->increments('IDinvalidDays');
            $table->unsignedInteger('weeksID');
            $table->unsignedInteger('reason');
            $table->unsignedInteger('date');

            $table->foreign('weeksID')->references('IDweeks')->on('weeks');
            $table->foreign('reason')->references('IDinvalidReasons')->on('invalid_reasons');
            $table->foreign('date')->references('IDdates')->on('dates');
            
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invalid_days');
    }
}
