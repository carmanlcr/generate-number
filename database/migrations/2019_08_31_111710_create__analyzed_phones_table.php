<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnalyzedPhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ANALYZEDPHONES', function (Blueprint $table) {
            $table->bigIncrements('ANALYZEDPHONES_ID');
            $table->bigInteger('PHONES_ID');
            $table->string('TEXT',500);
            $table->dateTime('DATE');
            $table->integer('SERVER');
            $table->integer('STATES_ID');
            $table->integer('LANGUAGES_ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ANALYZEDPHONES');
    }
}
