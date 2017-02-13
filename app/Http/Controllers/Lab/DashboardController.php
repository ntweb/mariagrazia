<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

	public function __construct()
	{
	    $this->middleware('auth');
	}
	
    public function index () {

   		// Parameters 2nmodule
   		$data['arrParameters'] = \App\Parameter::select('module2nd')->where('module', '=', 'parameter')->groupBy('module2nd')->get();

    	return view()->make('lab.dashboard.default', $data);
    }
}
