<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserprofilesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('userprofiles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('motto')->default('motto');
            $table->string('about')->default('about');
            $table->integer('height');
            $table->string('htunit')->default('cm');
            $table->integer('weight');
            $table->string('wtunit')->default('kg');
            $table->integer('relationhist');
            $table->integer('education');
            $table->integer('profession');
            $table->integer('bodytype')->nullable();
            $table->integer('zodiac')->nullable();
            $table->enum('disability', ['y', 'n'])->default('n');
            $table->string('fluency')->nullable();
            $table->integer('haircolor')->nullable();
            $table->integer('hairapp')->nullable();
            $table->integer('eyecolor')->nullable();
            $table->integer('eyewear')->nullable();
            $table->integer('ethinicity')->nullable();
            $table->enum('tatoo', ['y', 'n'])->default('n');
            $table->integer('appearance')->nullable();
            $table->integer('smoke')->nullable();
            $table->integer('drink')->nullable();
            $table->string('pets')->nullable();
            $table->string('countries_visit')->nullable();
            $table->integer('marital');
            $table->enum('children', ['y', 'n'])->default('n');
            $table->integer('relationlooking');
            $table->integer('relmarital');
            $table->integer('relethinicity')->nullable();
            $table->enum('reltatoo', ['y', 'n'])->default('n');
            $table->integer('relappearance')->nullable();
            $table->integer('relsmoke')->nullable();
            $table->integer('reldrink')->nullable();
            $table->string('relpets')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('userprofiles');
    }

}
