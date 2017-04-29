<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeToPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lab_pages', function (Blueprint $table) {            
            $table->string('type', 50)->default('standard')->after('img');
            $table->integer('order')->nullable()->after('active');
        });        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lab_pages', function (Blueprint $table) {            
            $table->dropColumn('type');
            $table->dropColumn('order');
        });        
    }
}
