<?php

use Illuminate\Database\Seeder;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lab_languages')->insert([
            'lang' => 'it',
            'html_lang' => 'it_IT',
            'ico' => null,
            'datetime' => 'd/m/Y H:i',
            'date' => 'd/m/Y',
        ]);
    }
}
