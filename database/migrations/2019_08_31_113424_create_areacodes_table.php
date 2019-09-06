<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAreacodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AREACODES', function (Blueprint $table) {
            $table->increments('AREACODES_ID');
            $table->string('CODE',45);
            $table->string('CITY',100);
            $table->integer('STATESZONE_ID');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('AREACODES');
    }
}
