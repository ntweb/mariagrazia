<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang', 3)->nullable();
            $table->string('html_lang', 7)->nullable();
            $table->string('ico', 10)->nullable();
            $table->string('datetime', 20)->nullable();
            $table->string('date', 10)->nullable();
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
        Schema::dropIfExists('lab_languages');
    }
}
