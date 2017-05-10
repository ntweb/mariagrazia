<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSedeToStaff extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lab_staff', function (Blueprint $table) {
            $table->integer('office_id')->default(0)->after('id');
            $table->string('code', 10)->nullable()->after('office_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lab_staff', function (Blueprint $table) {
            $table->dropColumn('office_id');
            $table->dropColumn('code');
        });
    }
}
