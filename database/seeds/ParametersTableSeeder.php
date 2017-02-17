<?php

use Illuminate\Database\Seeder;

class ParametersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('lab_parameters')->insert([
        	['module' => 'parameter',	'module2nd' => 'google_map',	'label' => 'google_api_key',			'value' => 'AIzaSyBvxiiIDh5-xrYrXBQ7z-gwggXpt1Y66Ro', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'google_map',	'label' => 'latitude',					'value' => '41.128161', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'google_map',	'label' => 'longitude',					'value' => '16.858814', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'google_map',	'label' => 'infowindow', 				'value' => null, 'extras' => '<p>business name</p>'],
        	['module' => 'parameter',	'module2nd' => 'mailchimp',		'label' => 'mailchimp_api_key', 		'value' => null, 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'mailchimp',		'label' => 'mailchimp_list_id', 		'value' => null, 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'paypal',		'label' => 'paypal_testmode',					'value' => 1, 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'paypal',		'label' => 'paypal_api_user_test',		'value' => 'dm-facilitator_api1.artisanlab.it', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'paypal',		'label' => 'paypal_api_password_test',	'value' => 'MJJXR84CGD3V7J3M', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'paypal',		'label' => 'paypal_api_signature_test',	'value' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AJ4G40AHd2wS-PukizIDnqwFd13a', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'paypal',		'label' => 'paypal_api_user', 			'value' => null, 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'paypal',		'label' => 'paypal_api_password', 		'value' => null, 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'paypal',		'label' => 'paypal_api_signature', 		'value' => null, 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_url',					'value' => 'www.nomesito.it', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_email',				'value' => 'info@nomesito.it', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_email_admin',			'value' => 'admin@nomesito.it', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_business_name',		'value' => 'Business name', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_phone',				'value' => '(+39) 123456789', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_cell',					'value' => '(+39) 987654321', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_fax',					'value' => '(+39) 123456789', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_address',				'value' => 'Lincoln rd.', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_city',					'value' => 'Miami', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_state',				'value' => 'Florida', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_fb',					'value' => 'http://www.facebook.com', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_tw',					'value' => 'http://www.twitter.com', 'extras' => null],
        	['module' => 'parameter',	'module2nd' => 'site',			'label' => 'site_gp',					'value' => 'http://www.google.com', 'extras' => null],
            ['module' => 'parameter',   'module2nd' => 'site',          'label' => 'site_ln',                   'value' => 'http://www.linkedin.com', 'extras' => null],
            ['module' => 'type', 'module2nd' => null, 'label' => 'news', 'value' => 'standard', 'extras' => null],
            ['module' => 'type', 'module2nd' => null, 'label' => 'services', 'value' => 'standard', 'extras' => null],
            ['module' => 'type', 'module2nd' => null, 'label' => 'staff', 'value' => 'standard', 'extras' => null],
            ['module' => 'type', 'module2nd' => null, 'label' => 'partners', 'value' => 'standard', 'extras' => null],
            ['module' => 'type', 'module2nd' => null, 'label' => 'photogallery', 'value' => 'standard', 'extras' => null],
            ['module' => 'type', 'module2nd' => null, 'label' => 'videogallery', 'value' => 'standard', 'extras' => null],
            ['module' => 'type', 'module2nd' => null, 'label' => 'portfolio', 'value' => 'standard', 'extras' => null],
            ['module' => 'type', 'module2nd' => null, 'label' => 'category', 'value' => 'standard', 'extras' => null],
            ['module' => 'type', 'module2nd' => null, 'label' => 'productoptions', 'value' => 'color,size', 'extras' => null],
            ['module' => 'type', 'module2nd' => null, 'label' => 'banner', 'value' => 'standard', 'extras' => null],
            ['module' => 'type', 'module2nd' => null, 'label' => 'review', 'value' => 'news,product', 'extras' => null],
            ['module' => 'type', 'module2nd' => null, 'label' => 'coupon', 'value' => 'percent,value', 'extras' => null],
        ]);
    }
}
