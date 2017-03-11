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

class SubcategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        //** $this->middleware('auth');

        //** all you want to share
        //** view()->share('var', 'value');
        
        view()->share('review_type', 'subcategory');
    }

    public function index ($foo_category, $foo_subcategory, $id) {
        $data['show_subcategory'] = true;;
    	$data['page'] = \App\Subcategory::active()->where('id', '=', $id)->first();
    	if (!$data['page']) abort(404);

        if (!Session::has('breadcrumb_cat'))
            Session::put('breadcrumb_cat', $data['page']->category);
        
        Session::put('breadcrumb_subcat', $data['page']);
        Session::forget('breadcrumb_prod');

    	//** for paging
    	$data['arrElements'] = \App\Product::active()->where('type', '=', $id)->paginate(2);

        //**** SEO ****//
        SEO::setTitle($data['page']->mtitle);
        SEO::setDescription($data['page']->mdescription);
        SEO::opengraph()->setUrl(url()->current());        
        SEO::opengraph()->addProperty('locale', LaravelLocalization::getCurrentLocaleRegional());
        if ($data['page']->img)
            SEO::opengraph()->addImage(img($data['page'], 'img')); 

    	return view()->make('web.ecommerce.category.index', $data);
    }
}
