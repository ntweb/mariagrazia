<?php

use Illuminate\Database\Seeder;
use App\Log;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	App::setLocale('it');

    	$arrTip = param('news', 'value', ',');

    	$faker = Faker\Factory::create();
    	foreach ($arrTip as $k => $v) {

    		// creo 50 notizie per tipologia    		
    		for ($i=0; $i < 50 ; $i++) { 
    			
	    		$n = new \App\News;
	    		$n->type = $v;
	    		$n->title = $faker->text($faker->numberBetween(40, 100));
	    		$n->abstract = $faker->text(200);
	    		$n->description = $faker->paragraph(20);
	    		$n->mtitle = $n->title;
	    		$n->murl = str_slug($n->title);
	    		$n->mdescription = $faker->text(20);
	    		$n->homepage = $faker->randomElement($array = array ('0','1'));
	    		$n->active = '1';

	    		$n->begin = $faker->dateTime();
	    		$n->uploadfolder= 'news';
	    		$n->id_created_by = 1;
	    		$n->save();

	    		@File::makeDirectory(public_path('media'));
	    		@File::makeDirectory(public_path('media/news'));
	    		@File::makeDirectory(public_path('media/news/'.$n->id));
	    		$img = $faker->image(public_path('media/news/'.$n->id),$faker->numberBetween(1000, 800), $faker->numberBetween(800, 600),null,false);
	    		$n->img = $img;
	    		$n->save();

    		}
    	}


    }
}
