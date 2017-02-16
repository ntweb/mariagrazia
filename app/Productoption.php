<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Productoption extends Model
{
	use \Dimsav\Translatable\Translatable;
    
    protected $table = 'lab_productoptions';
    public $translatedAttributes = ['title'];

    public function created_by(){
		return $this->belongsTo('\App\User','id_created_by');
    }

    public function updated_by(){
		return $this->belongsTo('\App\User','id_updated_by');
    }

}
