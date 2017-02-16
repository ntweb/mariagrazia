<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductoptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_productoptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_product');
            $table->string('uploadfolder', 50);
            $table->string('img', 100)->nullable();
            $table->string('type', 50);
            $table->decimal('price', 30,4)->default(0);
            $table->string('color', 20)->nullable();
            $table->integer('order')->nullable();
            $table->enum('active', [0,1]);
            $table->integer('id_created_by')->nullable();
            $table->integer('id_updated_by')->nullable();            
            $table->timestamps();
        });

        Schema::create('lab_productoptions_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('productoption_id')->unsigned();

            $table->string('title')->nullable();
            $table->string('locale')->index();

            $table->unique(['productoption_id','locale']);
            $table->foreign('productoption_id')->references('id')->on('lab_productoptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_productoptions_translations');
        Schema::dropIfExists('lab_productoptions');
    }
}
