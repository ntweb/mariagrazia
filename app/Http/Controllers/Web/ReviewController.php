<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;

class ReviewController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validator
        $fieldsToValidate["title"] = "required";
        $fieldsToValidate["name"] = "required";
        $fieldsToValidate["email"] = "required|email";
        $fieldsToValidate["site"] = 'sometimes|nullable|url';
        $fieldsToValidate["description"] = "required";

        $fields = $request->except('_token');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = new \App\Review;
            foreach ($fields as $key => $value) {
                $el->$key = $value;

                if($key == 'description') $el->$key = nl2br($value);
            }

            if (!$el->save()){
                return response()->json(array('error' => trans('labels.errore-sql')));
            }            

            $result['id'] = $el->id;
            return response()->json(array('success' => trans('labels.store_ok')));
        }
        
        return response()->json(
                                array(
                                    // 'error' => trans('labels.compilare_campi_obbligatori'),
                                    'errorfields' => $validator->messages()
                                )
                            );
    }

}