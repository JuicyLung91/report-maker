<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDaysToTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('days_to_tasks', function (Blueprint $table) {
            $table->increments('IDdaysToTaks');

            $table->unsignedInteger('oneDay');
            $table->unsignedInteger('task');
            $table->foreign('oneDay')->references('IDoneDay')->on('one_days');
            $table->foreign('task')->references('IDtasks')->on('tasks');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('days_to_tasks');
    }
}
