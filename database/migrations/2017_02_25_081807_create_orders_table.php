<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lab_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user');
            $table->integer('id_coupon')->default(0);

            $table->string('payment_type')->nullable();
            $table->string('payment_log')->nullable();
            $table->string('payment_token')->nullable();
            
            $table->string('shipment_name')->nullable();
            $table->string('shipment_businessname')->nullable();
            $table->string('shipment_cf')->nullable();
            $table->string('shipment_vat')->nullable();
            $table->string('shipment_telephone')->nullable();
            $table->string('shipment_city')->nullable();
            $table->string('shipment_political_short_name')->nullable();
            $table->string('shipment_country_short_name')->nullable();
            $table->string('shipment_address')->nullable();
            $table->string('shipment_street_number')->nullable();
            $table->string('shipment_postal_code')->nullable();
            $table->text('shipment_note')->nullable();

            $table->decimal('total', 30,4)->default(0);
            $table->enum('paid', [0,1]);

            $table->timestamps();
        });

        Schema::create('lab_orders_rows', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_order');
            $table->integer('id_el');

            $table->string('type')->nullable();
            $table->string('row_title')->nullable();
            $table->string('row_options')->nullable();
            $table->string('row_price')->nullable();
            $table->string('row_qty')->nullable();
            $table->string('row_tax')->nullable();
            $table->string('row_taxable')->nullable();            
            $table->string('row_subtotal')->nullable();
            
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
        Schema::dropIfExists('lab_orders_rows');
        Schema::dropIfExists('lab_orders');
    }
}
