<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
	use \Dimsav\Translatable\Translatable;
    
    protected $table = 'lab_banners';
    public $translatedAttributes = ['title', 'abstract', 'description'];

    public function created_by(){
		return $this->belongsTo('\App\User','id_created_by');
    }

    public function updated_by(){
		return $this->belongsTo('\App\User','id_updated_by');
    }
}
