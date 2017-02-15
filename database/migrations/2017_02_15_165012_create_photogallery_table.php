<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotogalleryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_photogalleries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uploadfolder', 50)->nullable();
            $table->string('img', 100)->nullable();
            $table->string('type', 50);
            $table->datetime('begin')->nullable();
            $table->enum('homepage', [0,1]);
            $table->enum('active', [0,1]);
            $table->integer('order')->nullable();
            $table->integer('id_created_by')->nullable();
            $table->integer('id_updated_by')->nullable();            
            $table->timestamps();
        });

        Schema::create('lab_photogalleries_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('photogallery_id')->unsigned();

            $table->string('title');
            $table->string('abstract')->nullable();
            $table->text('description')->nullable();
            $table->string('mtitle')->nullable();
            $table->string('mdescription')->nullable();
            $table->string('mkeys')->nullable();
            $table->string('murl')->nullable();
            
            $table->string('locale')->index();

            $table->unique(['photogallery_id','locale']);
            $table->foreign('photogallery_id')->references('id')->on('lab_photogalleries')->onDelete('cascade');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_photogalleries_translations');
        Schema::dropIfExists('lab_photogalleries');
    }
}
