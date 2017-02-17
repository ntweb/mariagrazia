<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_banners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uploadfolder', 50)->nullable();
            $table->string('img', 100)->nullable();
            $table->string('background', 100)->nullable();
            $table->string('type', 50);
            $table->enum('active', [0,1]);
            $table->integer('order')->nullable();
            $table->integer('id_created_by')->nullable();
            $table->integer('id_updated_by')->nullable();            
            $table->timestamps();
        });

        Schema::create('lab_banners_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('banner_id')->unsigned();

            $table->string('title');
            $table->string('abstract')->nullable();
            $table->text('description')->nullable();
            
            $table->string('locale')->index();

            $table->unique(['banner_id','locale']);
            $table->foreign('banner_id')->references('id')->on('lab_banners')->onDelete('cascade');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_banners_translations');
        Schema::dropIfExists('lab_banners');
    }
}
