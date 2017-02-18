<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;

class ServiceController extends Controller
{

    protected $uploadfolder = 'services';
    protected $arrType;
    protected $default_lang;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');

        view()->share('table', 'lab_services');
        view()->share('uploadfolder', $this->uploadfolder);
        $this->default_lang = \App\Language::first();
        view()->share('default_lang', $this->default_lang);

        view()->share('mod_name', 'Servizi');
        view()->share('mod_action', 'Lista');
        view()->share('mod_object', 'Servizio');

        // Tipologie
        $el = \App\Parameter::where('module', '=', 'type')->where('label', '=', 'services')->first();
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
        $data['route_search'] = action('Lab\ServiceController@index');

        if ($request->has('key'))
            $query = \App\Service::whereHas('translations', function ($query) use ($request) {
                                $query->where('locale', 'it')
                                ->where('title', 'LIKE', '%'.$request->get('key').'%')
                                ->orWhere('service_id', '=', $request->get('key'));
                            });
        else
            $query = \App\Service::orderBy('order')->orderBy('id', 'desc');


        // filter type
        if ($request->has('type'))
            $query->where('type', '=', $request->get('type'));

        $data['arrElements'] = $query->paginate(50);
        return view()->make('lab.service.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['mod_action'] = 'Crea nuovo elemento';
        $data['mod_object'] = 'Servizi';

        $data['back'] = action('Lab\ServiceController@index');
        $data['route'] = action('Lab\ServiceController@store');

        return view()->make('lab.service.create', $data);
    }

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

        $fields = $request->except('_token');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = new \App\Service;
            foreach ($fields as $key => $value) {
                $el->$key = $value;

                // mtitle and murl
                if ($key == 'title') {
                    $el->translateOrNew($request->get('lang'))->mtitle = $value;                
                    $el->translateOrNew($request->get('lang'))->murl = str_slug($value);                
                }
              
            }

            // default 
            $el->uploadfolder = $this->uploadfolder;
            $el->type = $this->arrType[0];

            $el->id_created_by = Auth::user()->id;
            if (!$el->save()){
                return response()->json(array('error' => trans('labels.errore-sql')));
            }            

            $result['id'] = $el->id;
            $result['route'] = action('Lab\ServiceController@edit', array($el->id));

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

        $data['mod_action'] = 'Modifica';
        $data['mod_object'] = 'Servizio : ID '.$id;

        $data['route'] = action('Lab\ServiceController@update', array($id));
        $data['route_settings'] = action('Lab\ServiceController@settings', array($id));
        $data['back'] = Session::get('backurl', action('Lab\ServiceController@index'));
        $data['el'] = \App\Service::find($id);

        return view()->make('lab.service.edit', $data);
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
        $fieldsToValidate["title"] = "required";

        $fields = $request->except('_token', 'lang');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = \App\Service::find($id);
            foreach ($fields as $key => $value) {
                $el->translateOrNew($request->get('lang'))->$key = $value;

                // murl
                if ($key == 'murl') $el->translateOrNew($request->get('lang'))->murl = str_slug($value);
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
        $el = \App\Service::find($id);

        Storage::disk('docs')->deleteDirectory($el->uploadfolder.'/'.$el->id);

        $el->delete();
        $result['id'] = $id;
        return response()->json(array('success' => trans('labels.store_ok'), 'result' => json_encode($result)));                
    }

    public function settings(Request $request, $id)
    {
        $fieldsToValidate = array();

        $fields = $request->except('_token');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = \App\Service::find($id);
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

    public function deleteImg($id,$img) {
        $el = \App\Service::find($id);

        $storage = $el->uploadfolder.'/'.$el->id.'/';
        $filename = $el->$img;

        Storage::disk('docs')->delete($storage.$filename);

        $el->$img = null;
        $el->save();

        $result['id'] = $el->id;
        return response()->json(array('success' => trans('labels.store_ok'), 'result' => json_encode($result)));        
    }

    public function changeFlag($id, $field) {
        $el = \App\Service::find($id);

        if ($el->$field) $el->$field = '0';
        else $el->$field = '1';

        $el->save();

        $result['id'] = $el->id;
        $result['flag'] = $el->$field;
        return response()->json(array('success' => trans('labels.store_ok'), 'result' => json_encode($result)));
    }
}
