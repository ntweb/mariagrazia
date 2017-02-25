<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 50)->nullable();
            $table->decimal('price', 30,4)->default(0);
            $table->decimal('price_discount', 30,4)->default(0);
            $table->integer('tax')->default(0);
            $table->string('uploadfolder', 50)->nullable();
            $table->string('img', 100)->nullable();
            $table->integer('type');
            $table->enum('new', [0,1]);
            $table->enum('discount', [0,1]);
            $table->enum('homepage', [0,1]);
            $table->enum('active', [0,1]);
            $table->integer('order')->nullable();
            $table->integer('id_created_by')->nullable();
            $table->integer('id_updated_by')->nullable();            
            $table->timestamps();
        });

        Schema::create('lab_products_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();

            $table->string('title');
            $table->string('abstract')->nullable();
            $table->text('description')->nullable();
            $table->string('mtitle')->nullable();
            $table->string('mdescription')->nullable();
            $table->string('mkeys')->nullable();
            $table->string('murl')->nullable();
            
            $table->string('locale')->index();

            $table->unique(['product_id','locale']);
            $table->foreign('product_id')->references('id')->on('lab_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_products_translations');
        Schema::dropIfExists('lab_products');
    }
}
