<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;

class CategoryController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        
        //** $this->middleware('auth');

        //** all you want to share
        //** view()->share('var', 'value');
        
        view()->share('review_type', 'category');
    }

    public function index ($foo_category, $id) {
    	$data['page'] = \App\Category::active()->where('id', '=', $id)->first();
    	if (!$data['page']) abort(404);

    	Session::put('breadcrumb_cat', $data['page']);
    	Session::forget('breadcrumb_subcat');
    	Session::forget('breadcrumb_prod');

    	return view()->make('web.ecommerce.category.index', $data);
    }    

}
