<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Validator;
use Auth;
use Log;
use Session;
use Storage;
use Faker;

class CouponController extends Controller
{

    protected $uploadfolder = 'coupon';
    protected $arrType;
    protected $default_lang;

    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');

        view()->share('table', 'lab_coupon');
        view()->share('uploadfolder', $this->uploadfolder);
        

        \LaravelLocalization::setLocale('it');
        $this->default_lang = config('laravellocalization.supportedLocales.it');
        view()->share('default_lang', $this->default_lang);

        view()->share('mod_name', 'Coupon');
        view()->share('mod_action', 'Lista');
        view()->share('mod_object', 'Coupon');

        // Tipologie
        $el = \App\Parameter::where('module', '=', 'type')->where('label', '=', 'coupon')->first();
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
        $data['route_search'] = action('Lab\CouponController@index');

        if ($request->has('key'))
            $query = \App\Coupon::where('id', '=', $request->get('key'))
                                    ->orWhere('title', 'LIKE', '%'.$request->get('key').'%');
        else
            $query = \App\Coupon::orderBy('id', 'desc');


        // filter type
        if ($request->has('type'))
            $query->where('type', '=', $request->get('type'));

        $data['arrElements'] = $query->paginate(50);
        return view()->make('lab.coupon.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['mod_action'] = 'Crea nuovo elemento';
        $data['mod_object'] = 'Coupon';

        $data['back'] = action('Lab\CouponController@index');
        $data['route'] = action('Lab\CouponController@store');

        // fake coupon
        $faker = Faker\Factory::create();
        $data['code'] = strtoupper(substr($faker->md5, 0, 5));

        return view()->make('lab.coupon.create', $data);
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
        $fieldsToValidate["code"] = "required|unique:lab_coupons";

        $fields = $request->except('_token');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = new \App\Coupon;
            foreach ($fields as $key => $value) {
                $el->$key = $value;
            }

            // default 
            $el->uploadfolder = $this->uploadfolder;
            $el->type = $this->arrType[0];

            $el->id_created_by = Auth::user()->id;
            if (!$el->save()){
                return response()->json(array('error' => trans('lab.errore-sql')));
            }            

            $result['id'] = $el->id;
            $result['route'] = action('Lab\CouponController@edit', array($el->id));

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
        $data['mod_object'] = 'Coupon : ID '.$id;

        $data['route'] = action('Lab\CouponController@update', array($id));
        $data['route_settings'] = action('Lab\CouponController@settings', array($id));
        $data['back'] = Session::get('backurl', action('Lab\CouponController@index'));
        $data['el'] = \App\Coupon::find($id);

        return view()->make('lab.coupon.edit', $data);
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
            $el = \App\Coupon::find($id);
            foreach ($fields as $key => $value) {
                $el->$key = $value;
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
        $el = \App\Coupon::find($id);

        Storage::disk('docs')->deleteDirectory($el->uploadfolder.'/'.$el->id);

        $el->delete();
        $result['id'] = $id;
        return response()->json(array('success' => trans('lab.store_ok'), 'result' => json_encode($result)));                
    }

    public function settings(Request $request, $id)
    {
        $fieldsToValidate['amount'] = array('required', 'regex:/^\d*(\.\d{2,4})?$/');

        $fields = $request->except('_token');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = \App\Coupon::find($id);
            foreach ($fields as $key => $value) {
                $el->$key = $value;

                if (($key == 'begin' || $key == 'end') && $value) $el->$key = \Carbon\Carbon::createFromFormat($this->default_lang['date'], $value)->toDateString();
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
        $el = \App\Coupon::find($id);

        $storage = $el->uploadfolder.'/'.$el->id.'/';
        $filename = $el->$img;

        Storage::disk('docs')->delete($storage.$filename);

        $el->$img = null;
        $el->save();

        $result['id'] = $el->id;
        return response()->json(array('success' => trans('lab.store_ok'), 'result' => json_encode($result)));        
    }

    public function changeFlag($id, $field) {
        $el = \App\Coupon::find($id);

        if ($el->$field) $el->$field = '0';
        else $el->$field = '1';

        $el->save();

        $result['id'] = $el->id;
        $result['flag'] = $el->$field;
        return response()->json(array('success' => trans('lab.store_ok'), 'result' => json_encode($result)));
    }
}
