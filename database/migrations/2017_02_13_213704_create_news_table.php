<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_news', function (Blueprint $table) {
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

        Schema::create('lab_news_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('news_id')->unsigned();

            $table->string('title');
            $table->string('abstract', 250)->nullable();
            $table->text('description')->nullable();
            $table->string('mtitle')->nullable();
            $table->string('mdescription', 250)->nullable();
            $table->string('mkeys')->nullable();
            $table->string('murl')->nullable();
            
            $table->string('locale')->index();

            $table->unique(['news_id','locale']);
            $table->foreign('news_id')->references('id')->on('lab_news')->onDelete('cascade');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_news_translations');
        Schema::dropIfExists('lab_news');
    }
}
