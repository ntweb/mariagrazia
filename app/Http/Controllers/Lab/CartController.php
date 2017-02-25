<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;

class CartController extends Controller
{

    protected $uploadfolder = 'news';
    protected $arrType;
    protected $default_lang;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');

        $this->default_lang = \App\Language::first();
        view()->share('default_lang', $this->default_lang);        

        view()->share('mod_name', 'Ordini');
        view()->share('mod_action', 'Lista');
        view()->share('mod_object', 'Ordini');

        // Tipologie
        $el = \App\Parameter::where('module', '=', 'type')->where('label', '=', 'orderstatus')->first();
        $this->arrType = explode(',', $el->value);
        view()->share('arrType', $this->arrType);
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
        $data['route_search'] = action('Lab\CartController@index');

        if ($request->has('key'))
            $query = \App\Order::where('id', '=', $request->get('key'));
        else
            $query = \App\Order::orderBy('id', 'desc');

        // filter type
        if ($request->has('type'))
            $query->where('type', '=', $request->get('type'));

        $data['arrElements'] = $query->paginate(50);
        return view()->make('lab.cart.index', $data);

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
        $data['mod_action'] = 'Visualizza';
        $data['mod_object'] = 'Ordine : ID '.$id;

        $data['route'] = action('Lab\CartController@update', array($id));        
        $data['back'] = Session::get('backurl', action('Lab\CartController@index'));
        $data['el'] = \App\Order::find($id);

        return view()->make('lab.cart.edit', $data);
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

        $fields = $request->except('_token', 'lang');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = \App\Order::find($id);
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
}
