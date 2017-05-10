<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfficesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('lab_offices', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address', 150)->nullable();
            $table->string('city', 150)->nullable();
            $table->string('zipcode', 10)->nullable();
            $table->string('telephone', 50)->nullable();
            $table->string('fax', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('latitude', 50)->nullable();
            $table->string('longitude', 50)->nullable();
            $table->string('uploadfolder', 50)->nullable();
            $table->string('img', 100)->nullable();
            $table->string('type', 50);
            $table->enum('active', [0,1]);
            $table->integer('order')->nullable();
            $table->integer('id_created_by')->nullable();
            $table->integer('id_updated_by')->nullable();            
            $table->timestamps();
        });

        Schema::create('lab_offices_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('office_id')->unsigned();

            $table->string('title');
            $table->string('abstract', 250)->nullable();
            $table->text('description')->nullable();
            $table->string('mtitle')->nullable();
            $table->string('mdescription', 250)->nullable();
            $table->string('mkeys')->nullable();
            $table->string('murl')->nullable();
            
            $table->string('locale')->index();

            $table->unique(['office_id','locale']);
            $table->foreign('office_id')->references('id')->on('lab_offices')->onDelete('cascade');
        });          
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_offices_translations');
        Schema::dropIfExists('lab_offices');        
    }
}
