<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){

        Schema::create('PHONES', function (Blueprint $table) {
            $table->bigIncrements('PHONES_ID');
            $table->integer('AREACODES_ID');
            $table->string('PHONE');
            $table->dateTime('DATE');
            $table->integer('USERS_ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('PHONES');
    }
}
