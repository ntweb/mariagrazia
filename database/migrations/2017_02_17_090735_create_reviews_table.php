<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_el')->default(0);
            $table->string('type', 50);
            $table->string('title', 100)->nullable();
            $table->string('name', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('site', 100)->nullable();
            $table->text('description', 100)->nullable();
            $table->text('answer', 100)->nullable();
            $table->integer('vote')->default(0);
            $table->integer('order')->nullable();
            $table->string('uploadfolder', 50)->nullable();
            $table->string('img', 50)->nullable();
            $table->enum('homepage', [0,1]);
            $table->enum('active', [0,1]);
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
        Schema::dropIfExists('lab_reviews');
    }
}
