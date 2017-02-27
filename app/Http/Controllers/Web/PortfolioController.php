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

class PortfolioController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        //** $this->middleware('auth');

        //** all you want to share
        //** view()->share('var', 'value');
        
        view()->share('review_type', 'portfolio');
    }	

    public function index (Request $request) {
    	$data['page'] = page('portfolio', '1');
    	if (!$data['page']) abort(404);

    	//** getting alla types of portfolio
    	$data['arrTypes'] = types('portfolio');

    	//** for paging
    	$data['arrElements'] = \App\Portfolio::active()->paginate(2);

        //**** SEO ****//
        SEO::setTitle($data['page']->mtitle);
        SEO::setDescription($data['page']->mdescription);
        SEO::opengraph()->setUrl(url()->current());        
        SEO::opengraph()->addProperty('locale', LaravelLocalization::getCurrentLocaleRegional());
        if ($data['page']->img)
            SEO::opengraph()->addImage(img($data['page'], 'img')); 

    	return view()->make('web.portfolio.index', $data);
    }

    public function show ($id) {

    	$data['page'] = \App\Portfolio::where('id', '=', $id)->active()->first();
    	if (!$data['page']) abort(404);

		//** for resource localization url **//
		$data['route_loalization_resource'] = 'routes.portfolio_show';
		foreach (\App\Language::all() as $v) {
			$data['route_loalization_resource_param'][$v->lang] = array('id' => $id, 'title' => $data['page']->translateOrDefault($v->lang)->murl);
		}
		//** for resource localization url **//

    	$data['page_images'] = $data['page']->attachments_images()->get();
    	$data['page_docs'] = $data['page']->attachments_docs()->get();

        //**** SEO ****//
        SEO::setTitle($data['page']->mtitle);
        SEO::setDescription($data['page']->mdescription);
        SEO::opengraph()->setUrl(url()->current());        
        SEO::opengraph()->addProperty('locale', LaravelLocalization::getCurrentLocaleRegional());
        if ($data['page']->img)
            SEO::opengraph()->addImage(img($data['page'], 'img')); 
        
		return view()->make('web.portfolio.show', $data);
    }
}
