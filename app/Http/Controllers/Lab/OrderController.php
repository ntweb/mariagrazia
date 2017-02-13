<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Log;
use Auth;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(Request $request, $table) {
    	
    	foreach ($request->get('item') as $o => $id) {
    		DB::table($table)->where('id', $id)->update(['order' => $o]);
    	}

    	return response()->json(array('success' => trans('labels.update_ok')));
    }
}
