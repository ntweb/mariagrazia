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

class HomepageController extends Controller
{

    public function index() {
    	$data['page'] = page('homepage', '1');
    	if (!$data['page']) abort(404);

        // banners
        $data['arrB'] = \App\Banner::active()->orderBy('order')->get();

        // loghi partner
        $data['arrP'] = \App\Partner::active()->orderBy('order')->get();

        // Dicono di noi
        $data['arrR'] = \App\Review::active()->orderBy('order')->get();

    	// notizie
    	$data['arrN'] = \App\News::active()->type('standard')->orderBy('order')->get();


    	//**** SEO ****//
        SEO::setTitle($data['page']->mtitle);
        SEO::setDescription($data['page']->mdescription);
        SEO::opengraph()->setUrl(url()->current());        
        SEO::opengraph()->addProperty('locale', LaravelLocalization::getCurrentLocaleRegional());
        SEO::opengraph()->addProperty('type', 'website');
        if ($data['page']->img)
        	SEO::opengraph()->addImage(img($data['page'], 'img'));

    	return view()->make('web.homepage.index', $data);
    }
}
