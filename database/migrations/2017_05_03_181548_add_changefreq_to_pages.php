<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddChangefreqToPages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('lab_categories', function (Blueprint $table) {
            $table->enum('changefreq', array('always','hourly','daily','weekly','monthly','yearly','never'))->default('monthly')->after('order');
            $table->enum('priority', array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0'))->default('0.5')->after('changefreq');
        });

        Schema::table('lab_news', function (Blueprint $table) {
            $table->enum('changefreq', array('always','hourly','daily','weekly','monthly','yearly','never'))->default('monthly')->after('order');
            $table->enum('priority', array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0'))->default('0.5')->after('changefreq');
        });

        Schema::table('lab_pages', function (Blueprint $table) {
            $table->enum('changefreq', array('always','hourly','daily','weekly','monthly','yearly','never'))->default('monthly')->after('order');
            $table->enum('priority', array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0'))->default('0.5')->after('changefreq');
        });

        Schema::table('lab_products', function (Blueprint $table) {
            $table->enum('changefreq', array('always','hourly','daily','weekly','monthly','yearly','never'))->default('monthly')->after('order');
            $table->enum('priority', array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0'))->default('0.5')->after('changefreq');
        });

        Schema::table('lab_services', function (Blueprint $table) {
            $table->enum('changefreq', array('always','hourly','daily','weekly','monthly','yearly','never'))->default('monthly')->after('order');
            $table->enum('priority', array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0'))->default('0.5')->after('changefreq');
        });

        Schema::table('lab_subcategories', function (Blueprint $table) {
            $table->enum('changefreq', array('always','hourly','daily','weekly','monthly','yearly','never'))->default('monthly')->after('order');
            $table->enum('priority', array('0.0','0.1','0.2','0.3','0.4','0.5','0.6','0.7','0.8','0.9','1.0'))->default('0.5')->after('changefreq');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
    */
    public function down()
    {

        Schema::table('lab_categories', function (Blueprint $table) {
            $table->dropColumn('changefreq');
            $table->dropColumn('priority');
        });

        Schema::table('lab_news', function (Blueprint $table) {
            $table->dropColumn('changefreq');
            $table->dropColumn('priority');
        });

        Schema::table('lab_pages', function (Blueprint $table) {
            $table->dropColumn('changefreq');
            $table->dropColumn('priority');
        });

        Schema::table('lab_products', function (Blueprint $table) {
            $table->dropColumn('changefreq');
            $table->dropColumn('priority');
        });

        Schema::table('lab_services', function (Blueprint $table) {
            $table->dropColumn('changefreq');
            $table->dropColumn('priority');
        });        

        Schema::table('lab_subcategories', function (Blueprint $table) {
            $table->dropColumn('changefreq');
            $table->dropColumn('priority');
        });
    }
}
