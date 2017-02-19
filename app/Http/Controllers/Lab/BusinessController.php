<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;

class BusinessController extends Controller
{

    protected $uploadfolder = 'business';
    protected $arrType;
    protected $default_lang;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');

        view()->share('table', 'lab_business');
        view()->share('uploadfolder', $this->uploadfolder);
        $this->default_lang = \App\Language::first();
        view()->share('default_lang', $this->default_lang);

        view()->share('mod_name', 'Business');
        view()->share('mod_action', 'Lista');
        view()->share('mod_object', 'Business');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
            
        // for back button
        Session::put('backurl', $request->fullUrl());
        $data['route_search'] = action('Lab\BusinessController@index');

        if ($request->has('key'))
            $query = \App\User::where('business', '=', '1')
                                ->where(function ($query) use ($request) {
                                    $query->where('id', '=', $request->get('key'))
                                    ->orWhere('name', 'LIKE', '%'.$request->get('key').'%')
                                    ->orWhere('lastname', 'LIKE', '%'.$request->get('key').'%')
                                    ->orWhere('email', 'LIKE', '%'.$request->get('key').'%');
                                });

        else
            $query = \App\User::where('business', '=', '1')->orderBy('id', 'desc');

        $data['arrElements'] = $query->paginate(50);
        return view()->make('lab.business.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['el'] = \App\User::find($id);

        $data['mod_action'] = 'Modifica';
        $data['mod_object'] = 'Business : ID '.$id;

        $data['route'] = action('Lab\BusinessController@update', array($data['el']->b->id));
        $data['route_settings'] = action('Lab\BusinessController@settings', array($id));
        $data['back'] = Session::get('backurl', action('Lab\BusinessController@index'));

        return view()->make('lab.business.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fieldsToValidate["businessname"] = "required";

        $fields = $request->except('_token', 'lang');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = \App\Business::find($id);
            foreach ($fields as $key => $value) {
                $el->$key = $value;
            }

            $el->id_updated_by = Auth::user()->id;
            if (!$el->save()){
                return response()->json(array('error' => trans('labels.errore-sql')));
            }            

            $result['id'] = $el->id;
            return response()->json(array('success' => trans('labels.store_ok'), 'result' => json_encode($result)));
        }
        
        return response()->json(
                                array(
                                    'error' => trans('labels.compilare_campi_obbligatori'),
                                    'errorfields' => $validator->messages()
                                )
                            );        
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //                
    }

    public function settings(Request $request, $id)
    {
        $fieldsToValidate = array();

        $fields = $request->except('_token');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = \App\User::find($id);
            foreach ($fields as $key => $value) {
                $el->$key = $value;
            }

            if (!$el->save()){
                return response()->json(array('error' => trans('labels.errore-sql')));
            }            

            $result['id'] = $el->id;
            return response()->json(array('success' => trans('labels.store_ok'), 'result' => json_encode($result)));
        }
        
        return response()->json(
                                array(
                                    'error' => trans('labels.compilare_campi_obbligatori'),
                                    'errorfields' => $validator->messages()
                                )
                            );        
    }

    public function changeFlag($id, $field) {
        $el = \App\User::find($id);

        if ($el->$field) $el->$field = '0';
        else $el->$field = '1';

        $el->save();

        $result['id'] = $el->id;
        $result['flag'] = $el->$field;
        return response()->json(array('success' => trans('labels.store_ok'), 'result' => json_encode($result)));
    }
}
