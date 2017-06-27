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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
			$table->string('username')->unique();
            $table->string('password');
			$table->char('gender', 1)->nullable();
			$table->date('birthday')->nullable();
			$table->string('profileimage')->nullable();
			$table->boolean('onlinestatus')->default(0);
			$table->boolean('chatstatus')->default(1);
			$table->tinyInteger('verified')->default(1); // this column will be a TINYINT with a default value of 0 , [0 for false & 1 for true i.e. verified]
            $table->string('verification_token')->nullable(); 
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
