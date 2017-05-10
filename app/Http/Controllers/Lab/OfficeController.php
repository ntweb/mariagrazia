<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;

class OfficeController extends Controller
{

    protected $uploadfolder = 'offices';
    protected $arrType;
    protected $default_lang;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');

        view()->share('table', 'lab_offices');
        view()->share('uploadfolder', $this->uploadfolder);

        \LaravelLocalization::setLocale('it');
        $this->default_lang = config('laravellocalization.supportedLocales.it');
        view()->share('default_lang', $this->default_lang);

        view()->share('mod_name', 'Sedi / Uffici');
        view()->share('mod_action', 'Lista');
        view()->share('mod_object', 'Office');

        // Tipologie
        $el = \App\Parameter::where('module', '=', 'type')->where('label', '=', 'offices')->first();
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
        $data['route_search'] = action('Lab\OfficeController@index');

        if ($request->has('key'))
            $query = \App\Office::whereHas('translations', function ($query) use ($request) {
                                $query->where('locale', 'it')
                                ->where('title', 'LIKE', '%'.$request->get('key').'%')
                                ->orWhere('office_id', '=', $request->get('key'));
                            });
        else
            $query = \App\Office::orderBy('order')->orderBy('id', 'desc');

        // filter type
        if ($request->has('type'))
            $query->where('type', '=', $request->get('type'));

        $data['arrElements'] = $query->paginate(50);
        return view()->make('lab.office.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['mod_action'] = 'Crea nuovo elemento';
        $data['mod_object'] = 'Sedi / Uffici';

        $data['back'] = action('Lab\OfficeController@index');
        $data['route'] = action('Lab\OfficeController@store');

        return view()->make('lab.office.create', $data);
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
            $el = new \App\Office;
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
                return response()->json(array('error' => trans('lab.errore-sql')));
            }            

            $result['id'] = $el->id;
            $result['route'] = action('Lab\OfficeController@edit', array($el->id));

            return response()->json(array('success' => trans('lab.store_ok'), 'result' => json_encode($result['route'])));
        }
        
        return response()->json(
                                array(
                                    'error' => trans('lab.compilare_campi_obbligatori'),
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
        $data['mod_object'] = 'Office : ID '.$id;

        $data['route'] = action('Lab\OfficeController@update', array($id));
        $data['route_settings'] = action('Lab\OfficeController@settings', array($id));
        $data['back'] = Session::get('backurl', action('Lab\OfficeController@index'));
        $data['el'] = \App\Office::find($id);

        return view()->make('lab.office.edit', $data);
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
            $el = \App\Office::find($id);
            foreach ($fields as $key => $value) {
                $el->translateOrNew($request->get('lang'))->$key = $value;

                // murl
                if ($key == 'murl') $el->translateOrNew($request->get('lang'))->murl = str_slug($value);
            }

            $el->id_updated_by = Auth::user()->id;
            if (!$el->save()){
                return response()->json(array('error' => trans('lab.errore-sql')));
            }            

            $result['id'] = $el->id;
            return response()->json(array('success' => trans('lab.store_ok'), 'result' => json_encode($result)));
        }
        
        return response()->json(
                                array(
                                    'error' => trans('lab.compilare_campi_obbligatori'),
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
        $el = \App\Office::find($id);

        Storage::disk('docs')->deleteDirectory($el->uploadfolder.'/'.$el->id);

        $el->delete();
        $result['id'] = $id;
        return response()->json(array('success' => trans('lab.store_ok'), 'result' => json_encode($result)));                
    }

    public function settings(Request $request, $id)
    {
        $fieldsToValidate = array();

        $fields = $request->except('_token');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = \App\Office::find($id);
            foreach ($fields as $key => $value) {
                $el->$key = $value;

                if ($key == 'begin' && $value) $el->$key = \Carbon\Carbon::createFromFormat($this->default_lang['date'], $value)->toDateString();
            }

            $el->id_updated_by = Auth::user()->id;
            if (!$el->save()){
                return response()->json(array('error' => trans('lab.errore-sql')));
            }            

            $result['id'] = $el->id;
            return response()->json(array('success' => trans('lab.store_ok'), 'result' => json_encode($result)));
        }
        
        return response()->json(
                                array(
                                    'error' => trans('lab.compilare_campi_obbligatori'),
                                    'errorfields' => $validator->messages()
                                )
                            );        
    }

    public function deleteImg($id,$img) {
        $el = \App\Office::find($id);

        $storage = $el->uploadfolder.'/'.$el->id.'/';
        $filename = $el->$img;

        Storage::disk('docs')->delete($storage.$filename);

        $el->$img = null;
        $el->save();

        $result['id'] = $el->id;
        return response()->json(array('success' => trans('lab.store_ok'), 'result' => json_encode($result)));        
    }

    public function changeFlag($id, $field) {
        $el = \App\Office::find($id);

        if ($el->$field) $el->$field = '0';
        else $el->$field = '1';

        $el->save();

        $result['id'] = $el->id;
        $result['flag'] = $el->$field;
        return response()->json(array('success' => trans('lab.store_ok'), 'result' => json_encode($result)));
    }

}
