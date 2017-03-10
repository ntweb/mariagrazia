<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_partners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('businessname');
            $table->string('email')->nullable();
            $table->string('site')->nullable();
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

        Schema::create('lab_partners_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('partner_id')->unsigned();

            $table->string('title');
            $table->string('abstract', 250)->nullable();
            $table->text('description')->nullable();
            $table->string('mtitle')->nullable();
            $table->string('mdescription', 250)->nullable();
            $table->string('mkeys')->nullable();
            $table->string('murl')->nullable();
            
            $table->string('locale')->index();

            $table->unique(['partner_id','locale']);
            $table->foreign('partner_id')->references('id')->on('lab_partners')->onDelete('cascade');
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_partners_translations');
        Schema::dropIfExists('lab_partners');
    }
}
