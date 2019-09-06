<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountrysLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('COUNTRYS_LANGUAGE', function (Blueprint $table) {
            $table->increments('COUNTRYS_LANGUAGE_ID');
            $table->integer('COUNTRYS_ID');
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
        Schema::dropIfExists('COUNTRYS_LANGUAGE');
    }
}
