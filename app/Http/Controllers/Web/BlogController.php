<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;

use SEO;
use LaravelLocalization;

class BlogController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        //** $this->middleware('auth');

        //** all you want to share
        //** view()->share('var', 'value');
        
        view()->share('review_type', 'news');
    }	

    public function index (Request $request) {
    	$data['page'] = page('blog', '1');
    	if (!$data['page']) abort(404);

    	//** for paging
    	$data['arrElements'] = \App\News::active()->type('blog')->paginate(2);


        //**** SEO ****//
        SEO::setTitle($data['page']->mtitle);
        SEO::setDescription($data['page']->mdescription);
        SEO::opengraph()->setUrl(url()->current());
        SEO::opengraph()->addProperty('locale', LaravelLocalization::getCurrentLocaleRegional());   
        if ($data['page']->img)
            SEO::opengraph()->addImage(img($data['page'], 'img'));

    	return view()->make('web.blog.index', $data);
    }

    public function show ($id) {

    	$data['page'] = \App\News::where('id', '=', $id)->active()->type('blog')->first();
    	if (!$data['page']) abort(404);

		//** for resource localization url **//
		$data['route_loalization_resource'] = 'routes.blog_show';
		foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $l) {
			$data['route_loalization_resource_param'][$localeCode] = array('id' => $id, 'title' => $data['page']->translateOrDefault($localeCode)->murl);
		}
		//** for resource localization url **//

    	$data['page_images'] = $data['page']->attachments_images()->get();
    	$data['page_docs'] = $data['page']->attachments_docs()->get();

    	$data['page_reviews'] = $data['page']->reviews()->get();

        //**** SEO ****//
        SEO::setTitle($data['page']->mtitle);
        SEO::setDescription($data['page']->mdescription);
        SEO::opengraph()->setUrl(url()->current());        
        SEO::opengraph()->addProperty('type', 'article');
        SEO::opengraph()->addProperty('locale', LaravelLocalization::getCurrentLocaleRegional());
        SEO::opengraph()->addProperty('published_time', $data['page']->created_at);
        SEO::opengraph()->addProperty('modified_time', $data['page']->updated_at);
        if ($data['page']->img)
            SEO::opengraph()->addImage(img($data['page'], 'img'));


		return view()->make('web.blog.show', $data);
    }    
}
