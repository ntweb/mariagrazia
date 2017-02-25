<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdpaymentToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lab_orders', function (Blueprint $table) {
            $table->integer('id_payment')->default(0)->after('id_coupon');
            $table->integer('id_shipment')->default(0)->after('id_payment');
            $table->string('type')->after('paid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lab_orders', function (Blueprint $table) {
            $table->dropColumn('id_payment');
            $table->dropColumn('id_shipment');
            $table->dropColumn('type');
        });
    }
}
