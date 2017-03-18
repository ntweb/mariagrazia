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

class PhotogalleryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        //** $this->middleware('auth');

        //** all you want to share
        //** view()->share('var', 'value');
        
        view()->share('review_type', 'photogallery');
    }

    public function index (Request $request) {
    	$data['page'] = page('photogallery', '1');
    	if (!$data['page']) abort(404);

    	//** for paging
    	$data['arrElements'] = \App\Photogallery::active()->type('standard')->paginate(2);

        //**** SEO ****//
        SEO::setTitle($data['page']->mtitle);
        SEO::setDescription($data['page']->mdescription);
        SEO::opengraph()->setUrl(url()->current());        
        SEO::opengraph()->addProperty('locale', LaravelLocalization::getCurrentLocaleRegional());
        if ($data['page']->img)
            SEO::opengraph()->addImage(img($data['page'], 'img')); 

    	return view()->make('web.photogallery.index', $data);
    }

    public function show ($id) {

    	$data['page'] = \App\Photogallery::where('id', '=', $id)->active()->type('standard')->first();
    	if (!$data['page']) abort(404);

		//** for resource localization url **//
		$data['route_loalization_resource'] = 'routes.photogallery_show';
		foreach (\LaravelLocalization::getSupportedLocales() as $localeCode => $l) {
			$data['route_loalization_resource_param'][$localeCode] = array('id' => $id, 'title' => $data['page']->translateOrDefault($localeCode)->murl);
		}
		//** for resource localization url **//

    	$data['page_images'] = $data['page']->attachments_images()->get();

        //**** SEO ****//
        SEO::setTitle($data['page']->mtitle);
        SEO::setDescription($data['page']->mdescription);
        SEO::opengraph()->setUrl(url()->current());        
        SEO::opengraph()->addProperty('locale', LaravelLocalization::getCurrentLocaleRegional());
        if ($data['page']->img)
            SEO::opengraph()->addImage(img($data['page'], 'img')); 
        
		return view()->make('web.photogallery.show', $data);
    }      
}
