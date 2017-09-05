<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class FlagController extends Controller
{
    public function change ($table, $id, $field, $currentstatus) {
    	$newstatus = ($currentstatus == '0') ? '1' : '0';

    	if (DB::table($table)->where('id', '=', $id)->update([ $field => $newstatus]))
    		return response()->json( ['status' => $newstatus ] ,200);

    	return response()->json( ['error' => true ], 404 );
    }
}
