<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->integer('id_user')->nullable();
            $table->string('type', 50);
            $table->decimal('amount', 30,4)->default(0);
            $table->string('uploadfolder', 50)->nullable();
            $table->string('img', 100)->nullable();
            $table->datetime('begin')->nullable();
            $table->datetime('end')->nullable();
            $table->enum('active', [0,1]);
            $table->integer('id_created_by')->nullable();
            $table->integer('id_updated_by')->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_coupons');
    }
}
