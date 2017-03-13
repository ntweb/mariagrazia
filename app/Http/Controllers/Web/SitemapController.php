<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App;

class SitemapController extends Controller
{
    

    public function index($what) {

		$sitemap = App::make("sitemap");		

    	switch ($what) {
    		case 'pages':
				// homepage
				$homepage = \App\Page::find(1);
				$sitemap->add(action('Web\HomepageController@index'), $homepage->updated_at, '1.0', 'monthly');

				// other pages
				$arrElements = \App\Page::active()->where('module', '<>', 'homepage')->get();
				foreach ($arrElements as $v) {
					$sitemap->add(action('Web\PageController@show', array($v->id, $v->murl)), $v->updated_at, '0.9', 'monthly');
				}

    			break;

    		case 'news':

    			// news standard
				$arrElements = \App\News::active()->type('standard')->orderBy('id', 'desc')->get();
				foreach ($arrElements as $v) {
					$sitemap->add(action('Web\NewsController@show', array($v->id, $v->murl)), $v->updated_at, '0.9', 'monthly');
				}

				break;

    		default:
    			# code...
    			break;
    	}

    	return $sitemap->render('xml');
    }
}
