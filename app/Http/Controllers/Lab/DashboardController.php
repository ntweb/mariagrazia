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
    	return view()->make('lab.dashboard.default');
    }
}
