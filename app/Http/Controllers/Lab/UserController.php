<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;

class UserController extends Controller
{

    protected $uploadfolder = 'users';
    protected $arrType;
    protected $default_lang;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');

        view()->share('table', 'users');
        view()->share('uploadfolder', $this->uploadfolder);
        view()->share('default_lang', \App\Languages::first());

        view()->share('mod_name', 'User');
        view()->share('mod_action', 'Lista');
        view()->share('mod_object', 'User');
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
        $data['route_search'] = action('Lab\UserController@index');

        if ($request->has('key'))
            $data['arrElements'] = \App\user::where('name', 'LIKE', '%'.$request->get('key').'%')
                                                ->orWhere('name', 'LIKE', '%'.$request->get('key').'%')
                                                ->orWhere('email', 'LIKE', '%'.$request->get('key').'%')
                                                ->orWhere('id', '=', $request->get('key'))
                                                ->paginate(50);
        else
            $data['arrElements'] = \App\user::where('business', '=', '0')->orderBy('id')->paginate(50);
        
        return view()->make('lab.user.index', $data);    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['mod_action'] = 'Crea nuovo';
        $data['mod_object'] = 'Utente';

        $data['back'] = action('Lab\UserController@index');
        $data['route'] = action('Lab\UserController@store');

        return view()->make('lab.user.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fieldsToValidate['name'] = 'required';
        $fieldsToValidate['email'] = 'required|email';
        $fieldsToValidate['password'] = 'required|min:6';

        $fields = $request->except('_token');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = new \App\User;
            foreach ($fields as $key => $value) {
                $el->$key = $value;

                if ($key == 'password' && $value) $el->$key = bcrypt($value);
            }

            if (!$el->save()){
                return response()->json(array('error' => trans('labels.errore-sql')));
            }            

            $result['id'] = $el->id;
            $result['route'] = action('Lab\UserController@edit', array($el->id));

            return response()->json(array('success' => trans('labels.store_ok'), 'result' => json_encode($result['route'])));
        }
        
        return response()->json(
                                array(
                                    'error' => trans('labels.compilare_campi_obbligatori'),
                                    'errorfields' => $validator->messages()
                                )
                            ); 
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
        $data['el'] = \App\user::find($id);
        return view()->make('lab.user.edit', $data);
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

    public function password(Request $request, $id)
    {
        $fieldsToValidate['password'] = 'required|min:6';

        $fields = $request->except('_token');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = \App\User::find($id);
            foreach ($fields as $key => $value) {
                $el->$key = $value;

                if ($key == 'password' && $value) $el->$key = bcrypt($value);
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
