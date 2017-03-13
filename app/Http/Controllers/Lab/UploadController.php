<?php

namespace App\Http\Controllers\Lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Log;
use Storage;
use Plupload;
use Auth;
use File;

class UploadController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth');

        view()->share('table', 'lab_uploads');
        // view()->share('default_lang', \App\Language::first());

        view()->share('default_lang', config('laravellocalization.supportedLocales.it'));

        \LaravelLocalization::setLocale('it');
    }

    // upload cms images
    public function image(Request $request, $id, $table, $folder) {

		$fieldsToValidate = array();
    	foreach ($request->all() as $key => $v) {
            $pos = strpos($key, 'img');
            if ($pos !== false)
                $fieldsToValidate[$key] = 'required|image|max:1000';

    		$pos = strpos($key, 'background');
    		if ($pos !== false)
        		$fieldsToValidate[$key] = 'required|image|max:1000';
    	}

        $fields = $request->all();
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {  

        	// ciclo su tutti i campi chiamati 'img'
        	foreach ($fieldsToValidate as $key => $v) {
            	$storage = $folder.'/'.$id.'/';
            	$filename = str_slug(pathinfo($request->file($key)->getClientOriginalName(), PATHINFO_FILENAME)).".".pathinfo($request->file($key)->getClientOriginalName(), PATHINFO_EXTENSION);
        		
            	// carico il file quote nello storage ridenominandolo per evitare duplicati
            	if (!Storage::disk('docs')->put($storage.$filename, file_get_contents($request->file($key)->getRealPath())))
                	return response()->json(array('error' => trans('labels.errore_can_not_save_storage')));
        	
	            if (!DB::table($table)
            			->where('id', $id)
            			->update([$key => $filename, 'uploadfolder' => $folder])) {

	                return response()->json(array('error' => trans('labels.errore-sql')));
	            }
        	}

            $result['id'] = $id;
            return response()->json(array('success' => trans('labels.update_ok'), 'result' => json_encode($result)));
        }

        return response()->json(
                                array(
                                    // 'error' => trans('labels.compilare_campi_obbligatori'),
                                    'errorfields' => $validator->messages()
                                )
                            );     	
    }

    // upload cms multiple file
    public function multiupload(Request $request, $id, $folder) {
	    return Plupload::receive('file', function ($file) use ($id, $folder)
	    {
	    	$storage = $folder.'/'.$id.'/mm/';
	    	$filename = str_slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)).".".pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);

	    	$is_img = '0';
			if(substr($file->getMimeType(), 0, 5) == 'image') {
			    $is_img = '1';
			}	    	

	    	if (Storage::disk('docs')->put($storage.$filename, file_get_contents($file->getRealPath())))
	    	{
	    		$u = new \App\Upload;
	    		$u->id_el = $id;
	    		$u->uploadfolder = $folder;
	    		$u->filename = $filename;
	    		$u->img = $is_img;
	    		$u->size = Storage::disk('docs')->size($storage.$filename);
	    		$u->active = '1';
	    		$u->id_created_by = Auth::user()->id;

	    		$u->mtitle = $filename;
	    		$u->save();

	        	return 'ready';
	    	}

	    	return false;
	    });    	
    }

    // list cms uploaded mmultiple files
    public function index(Request $request, $id, $folder) {
    	$data['id'] = $id;
    	$data['uploadfolder'] = $folder;
    	$data['arrUploaded'] = \App\Upload::where('id_el', '=', $id)
    										->where('uploadfolder', '=', $folder)
    										->orderBy('order')
    										->get();

		return view()->make('lab.upload.index', $data);
    }

    public function edit ($id) {
        $data['route'] = action('Lab\UploadController@update', array($id));
        $data['route_settings'] = action('Lab\UploadController@settings', array($id));      
        $data['el'] = \App\Upload::find($id);

    	return view()->make('lab.upload.edit', $data);
    }

   public function update(Request $request, $id)
    {
        $fieldsToValidate["mtitle"] = "required";

        $fields = $request->except('_token', 'lang');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = \App\Upload::find($id);
            foreach ($fields as $key => $value) {
                $el->translateOrNew($request->get('lang'))->$key = $value;
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
                                    // 'error' => trans('labels.compilare_campi_obbligatori'),
                                    'errorfields' => $validator->messages()
                                )
                            );        
    
    }
    public function settings(Request $request, $id)
    {
        $fieldsToValidate = array();

        $fields = $request->except('_token');
        $validator = Validator::make($fields, $fieldsToValidate);
        if (!$validator->fails()) {
            $el = \App\Upload::find($id);
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
                                    // 'error' => trans('labels.compilare_campi_obbligatori'),
                                    'errorfields' => $validator->messages()
                                )
                            );        
    }

    public function delete($id) {
    	$el = \App\Upload::find($id);
    	if ($el->delete()) {

	    	$storage = $el->uploadfolder.'/'.$el->id_el.'/mm/';
	    	$filename = $el->filename;

			Storage::disk('docs')->delete($storage.$filename);

            $result['id'] = $el->id;
            return response()->json(array('success' => trans('labels.store_ok'), 'result' => json_encode($result)));
    	}

    	return response()->json(array('error' => trans('labels.errore-sql')));
    }

    public function changeFlag($id, $field) {
        $el = \App\Upload::find($id);

        if ($el->$field) $el->$field = '0';
        else $el->$field = '1';

        $el->save();

        $result['id'] = $el->id;
        $result['flag'] = $el->$field;
        return response()->json(array('success' => trans('labels.store_ok'), 'result' => json_encode($result)));
    }    

}
