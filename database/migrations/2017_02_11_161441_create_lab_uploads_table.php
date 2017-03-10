<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_uploads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_el');
            $table->string('uploadfolder', 50);
            $table->string('filename', 100);
            $table->integer('size')->nullable();
            $table->integer('order')->nullable();
            $table->enum('img', [0,1]);
            $table->enum('active', [0,1]);
            $table->integer('id_created_by')->nullable();
            $table->integer('id_updated_by')->nullable();            
            $table->timestamps();
        });

        Schema::create('lab_uploads_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('upload_id')->unsigned();

            $table->string('mtitle')->nullable();
            $table->string('mdescription', 250)->nullable();
            $table->string('mkeys')->nullable();

            $table->string('locale')->index();

            $table->unique(['upload_id','locale']);
            $table->foreign('upload_id')->references('id')->on('lab_uploads')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_uploads_translations');
        Schema::dropIfExists('lab_uploads');
    }
}
