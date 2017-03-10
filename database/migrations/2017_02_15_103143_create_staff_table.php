<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_staff', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('role')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('cell')->nullable();
            $table->string('fb')->nullable();
            $table->string('tw')->nullable();
            $table->string('gp')->nullable();
            $table->string('ln')->nullable();
            $table->string('uploadfolder', 50)->nullable();
            $table->string('img', 100)->nullable();
            $table->string('type', 50);
            $table->enum('homepage', [0,1]);
            $table->enum('active', [0,1]);
            $table->integer('order')->nullable();
            $table->integer('id_created_by')->nullable();
            $table->integer('id_updated_by')->nullable();            
            $table->timestamps();
        });

        Schema::create('lab_staff_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('staff_id')->unsigned();

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('mtitle')->nullable();
            $table->string('mdescription', 250)->nullable();
            $table->string('mkeys')->nullable();
            $table->string('murl')->nullable();
            
            $table->string('locale')->index();

            $table->unique(['staff_id','locale']);
            $table->foreign('staff_id')->references('id')->on('lab_staff')->onDelete('cascade');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_staff_translations');
        Schema::dropIfExists('lab_staff');
    }
}
