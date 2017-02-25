<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amount', 30,4)->default(0);
            $table->string('amount_type')->default('value');
            $table->integer('tax')->default(0);
            $table->string('uploadfolder', 50)->nullable();
            $table->string('type', 50);
            $table->enum('active', [0,1]);
            $table->integer('order')->nullable();
            $table->integer('id_created_by')->nullable();
            $table->integer('id_updated_by')->nullable();            
            $table->timestamps();
        });

        Schema::create('lab_payments_translations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_id')->unsigned();

            $table->string('title');
            $table->string('abstract')->nullable();
            
            $table->string('locale')->index();

            $table->unique(['payment_id','locale']);
            $table->foreign('payment_id')->references('id')->on('lab_payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lab_payments_translations');
        Schema::dropIfExists('lab_payments');
    }
}
