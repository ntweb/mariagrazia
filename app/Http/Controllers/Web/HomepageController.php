<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;

class HomepageController extends Controller
{
    public function index() {
    	$data['page'] = page('homepage', '1');
    	if (!$data['page']) abort(404);

    	// notizie
    	$data['arrN'] = \App\News::active()->type('standard')->orderBy('order')->get();


    	return view()->make('web.homepage.index', $data);
    }
}
