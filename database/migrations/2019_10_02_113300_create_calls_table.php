<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('CALLS', function (Blueprint $table) {
            $table->bigIncrements('calls_id');
            $table->string('DATE',45);
            $table->integer('ONE');
            $table->integer('TWO');
            $table->integer('THREE');
            $table->integer('THREE_TO_FIVE');
            $table->integer('MORE_THAN_FIVE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('CALLS');
    }
}
