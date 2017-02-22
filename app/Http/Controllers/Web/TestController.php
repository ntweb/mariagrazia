<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function __construct()
    {
        parent::__construct();        
        $this->middleware('auth');

        //** all you want to share
        //** view()->share('var', 'value');        
    }	

    public function index () {
    	return view()->make('web.test.index');
    }
}
