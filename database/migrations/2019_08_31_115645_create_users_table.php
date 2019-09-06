<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('USERS', function (Blueprint $table) {
            $table->increments('USERS_ID');
            $table->string('NAME',45);
            $table->string('USERNAME')->unique();
            $table->string('EMAIL')->unique();
            $table->string('PASSWORD',120);
            $table->rememberToken();
            $table->timestamps();
            $table->integer('USERROLES_ID');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('USERS');
    }
}
