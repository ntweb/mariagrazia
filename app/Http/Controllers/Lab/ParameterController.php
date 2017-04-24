<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Log;

class ParameterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        view()->share('table', 'lab_parameters');
        view()->share('uploadfolder', 'parameters');

        \LaravelLocalization::setLocale('it');
        view()->share('default_lang', config('laravellocalization.supportedLocales.it'));

        view()->share('mod_name', 'Parametri');
        view()->share('mod_action', 'Lista');
        view()->share('mod_object', 'Parametro');
    }

    public function edit ($module2nd) {
        $data['mod_action'] = 'Modifica';
        $data['mod_object'] = $module2nd;
    	$data['arrParameters'] = \App\Parameter::where('module2nd', '=', $module2nd)->get();

    	return view()->make('lab.parameter.edit', $data);
    }

    public function update (Request $request) {
    	foreach ($request->except('_token') as $k => $v) {
    		$xxx = explode('__', $k);
    		$field = $xxx[0];
    		$label = $xxx[1];

    		$el = \App\Parameter::where('label', '=', $label)->first();
    		if ($el) {
    			$el->$field = $v;
    			$el->save();
    		}
    	}

    	return response()->json(array('success' => trans('lab.store_ok')));
    }
}
