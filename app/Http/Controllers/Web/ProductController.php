<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;
use App;

use SEO;
use LaravelLocalization;

class ProductController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        
        //** $this->middleware('auth');

        //** all you want to share
        //** view()->share('var', 'value');
        
        view()->share('review_type', 'products');
    }

    public function index(Request $request)
    {            
        $data['show_search'] = true;

        if ($request->has('key'))
            $query = \App\Product::where('code', '=', $request->get('key'))
                                    ->orWhereHas('translations', function ($query) use ($request) {
                                        $query->where('locale', App::getLocale())
                                        ->where('title', 'LIKE', '%'.$request->get('key').'%');
                                    });

        // filter type
        if ($request->has('type')) {
            $query->where('type', '=', $request->get('type'));
            $data['type'] = \App\Subcategory::find($request->get('type'));
        }

        $request->flash();

        $data['arrElements'] = $query->paginate(50);
        return view()->make('web.ecommerce.category.index', $data);
    }

    public function show($foo_category, $foo_subcategory, $foo_product, $id) {

    	$data['show_prod_detail'] = true;
    	$data['page'] = \App\Product::active()->where('id', '=', $id)->first();
    	if (!$data['page']) abort(404);

        Session::put('breadcrumb_prod', $data['page']);

        $data['page_images'] = $data['page']->attachments_images()->get();
        $data['page_docs'] = $data['page']->attachments_docs()->get();

        $data['page_reviews'] = $data['page']->reviews()->get();
        $data['options_colors'] = $data['page']->options_colors()->get();
        $data['options_sizes'] = $data['page']->options_sizes()->get();
        
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
