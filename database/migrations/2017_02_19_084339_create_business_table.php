<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_business', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->string('businessname')->nullable();
            $table->string('cf', 50)->nullable();
            $table->string('vat', 50)->nullable();
            $table->string('telephone', 20)->nullable();
            $table->string('political_short_name', 50)->nullable();
            $table->string('country_short_name', 10)->nullable();
            $table->string('place', 20)->nullable();
            $table->string('city', 50)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('street_number', 100)->nullable();
            $table->string('postal_code', 20)->nullable();
            $table->integer('id_created_by')->nullable();
            $table->integer('id_updated_by')->nullable();            
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
        Schema::dropIfExists('lab_business');
    }
}
