<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOneDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('one_days', function (Blueprint $table) {
            $table->increments('IDoneDay');

            $table->unsignedInteger('weekID');
            $table->unsignedInteger('date');

            $table->foreign('weekID')->references('IDweeks')->on('weeks');
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
        Schema::dropIfExists('one_days');
    }
}
