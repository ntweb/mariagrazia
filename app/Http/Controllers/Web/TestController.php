<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Mail;
use App\Mail\AdminAlert;

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

        $m = new \App\Mailmessage('aaaaaabbbbbb');        
        Mail::to(param('site_email_admin'))
            ->queue(new AdminAlert($m));

    	return view()->make('web.test.index');
    }
}
