<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uploadfolder', 50)->nullable();
            $table->string('img', 100)->nullable();
            $table->string('module', 50)->nullable();
            $table->enum('active', [0,1]);
            $table->integer('id_created_by')->nullable();
            $table->integer('id_updated_by')->nullable();
            $table->timestamps();
        });

        Schema::create('lab_pages_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('page_id')->unsigned();

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('mtitle')->nullable();
            $table->string('mdescription', 250)->nullable();
            $table->string('mkeys')->nullable();
            $table->string('murl')->nullable();
            
            $table->string('locale')->index();

            $table->unique(['page_id','locale']);
            $table->foreign('page_id')->references('id')->on('lab_pages')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_pages_translations');
        Schema::dropIfExists('lab_pages');
    }
}
