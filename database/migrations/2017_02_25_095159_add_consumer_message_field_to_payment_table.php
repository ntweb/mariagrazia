<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddConsumerMessageFieldToPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lab_payments_translations', function (Blueprint $table) {
            $table->text('consumer_message')->nullable()->after('abstract');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lab_payments_translations', function (Blueprint $table) {
            $table->dropColumn('consumer_message');
        });
    }
}
