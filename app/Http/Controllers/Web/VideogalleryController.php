<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;

class VideogalleryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        //** $this->middleware('auth');

        //** all you want to share
        //** view()->share('var', 'value');
        
        view()->share('review_type', 'videogallery');
    }

    public function index (Request $request) {
    	$data['page'] = page('videogallery', '1');
    	if (!$data['page']) abort(404);

    	//** for paging
    	$data['arrElements'] = \App\Videogallery::active()->type('standard')->paginate(2);

    	return view()->make('web.videogallery.index', $data);
    }

    public function show ($id) {

    	$data['page'] = \App\Videogallery::where('id', '=', $id)->active()->type('standard')->first();
    	if (!$data['page']) abort(404);

		//** for resource localization url **//
		$data['route_loalization_resource'] = 'routes.videogallery_show';
		foreach (\App\Language::all() as $v) {
			$data['route_loalization_resource_param'][$v->lang] = array('id' => $id, 'title' => $data['page']->translateOrDefault($v->lang)->murl);
		}
		//** for resource localization url **//

		return view()->make('web.videogallery.show', $data);
    }  
}
