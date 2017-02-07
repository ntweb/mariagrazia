<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login() {
    	return view()->make('lab.login.default');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->get('email'), 'password' => $request->get('password'), 'active' => '1'])) {            
            return redirect()->intended(action('Lab\DashboardController@index'));
        }
        return redirect()->action('Lab\LoginController@login')->with('error', true);;
    }

}
