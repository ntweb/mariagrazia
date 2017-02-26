<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;

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

        Session::put('breadcrumb_subcat', $data['page']);
        Session::forget('breadcrumb_prod');

    	//** for paging
    	$data['arrElements'] = \App\Product::active()->where('type', '=', $id)->paginate(2);

    	return view()->make('web.ecommerce.category.index', $data);
    }
}