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
				$sitemap->add(action('Web\HomepageController@index'), $homepage->updated_at, $homepage->priority, $homepage->changefreq);

				// other pages
				$arrElements = \App\Page::active('1')
    									->get();
    									
				foreach ($arrElements as $v) {
					$sitemap->add(action('Web\PageController@show', array($v->murl, $v->id)), $v->updated_at, $v->priority, $v->changefreq);
				}

    			break;

    		case 'news':
    			// news standard
				$arrElements = \App\News::active()->type('standard')->orderBy('id', 'desc')->get();
				foreach ($arrElements as $v) {
					$sitemap->add(action('Web\NewsController@show', array($v->id, $v->murl)), $v->updated_at, $v->priority, $v->changefreq);
				}

				break;

            case 'category':

                // category
                $arrElements = \App\Category::active()->orderBy('created_at', 'desc')->get();
                foreach ($arrElements as $v) {
                    $sitemap->add(action('Web\CategoryController@index', array($v->murl, $v->id)), $v->updated_at, $v->priority, $v->changefreq);
                }

                break;                

            case 'subcategory':

                // subcategory
                $arrElements = \App\Subcategory::active()->orderBy('created_at', 'desc')->get();
                foreach ($arrElements as $v) {
                    $sitemap->add(action('Web\SubcategoryController@index', array($v->category->murl, $v->murl, $v->id)), $v->updated_at, $v->priority, $v->changefreq);
                }

                break;                

            case 'products':

                // products
                $arrElements = \App\Product::active()->orderBy('created_at', 'desc')->limit(1000)->get();
                foreach ($arrElements as $v) {
                    $sitemap->add(action('Web\ProductController@show', array($v->category->murl, $v->subcategory->murl, $v->murl, $v->id)), $v->updated_at, $v->priority, $v->changefreq);
                }

                break;                

    		default:
    			# code...
    			break;
    	}

    	return $sitemap->render('xml');
    }

    public function sitemap() {
    	$data['page'] = page('sitemap', '1');
    	if (!$data['page']) abort(404);

        //**** SEO ****//
        SEO::setTitle($data['page']->mtitle);
        SEO::setDescription($data['page']->mdescription);
        SEO::opengraph()->setUrl(url()->current());        
        SEO::opengraph()->addProperty('locale', LaravelLocalization::getCurrentLocaleRegional());
        if ($data['page']->img)
            SEO::opengraph()->addImage(img($data['page'], 'img'));  


    	$data['arrPages'] = \App\Page::active('1')
    									->get();

    	return view()->make('web.sitemap.sitemap', $data);
    }    
}
