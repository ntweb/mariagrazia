<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;

use Mail;
use App\Mail\SendContact;

class ContactController extends Controller
{
    public function index() {
    	$data['page'] = page('contact', '1');
    	if (!$data['page']) abort(404);

    	return view()->make('web.contact.index', $data);
    }

    public function send (Request $request) {
        $fieldsToValidate["name"] = "required";
        $fieldsToValidate["subject"] = "required";
        $fieldsToValidate["email"] = "required|email";
        $fieldsToValidate["message"] = "required";

        $validator = Validator::make($request->all(), $fieldsToValidate);
        if (!$validator->fails()) {

        	// send email
	        Mail::to(param('site_email_admin'))
	            ->queue(new SendContact($request->all()));

            return response()->json(array('success' => trans('labels.sent_ok')));
        }
        
        return response()->json(
                                array(
                                    //'error' => trans('labels.compilare_campi_obbligatori'),
                                    'errorfields' => $validator->messages()
                                )
                            );      	
    }
}
