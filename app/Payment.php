<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
	use \Dimsav\Translatable\Translatable;
    
    protected $table = 'lab_payments';
    public $translatedAttributes = ['title', 'abstract', 'consumer_message'];

    public function created_by(){
		return $this->belongsTo('\App\User','id_created_by');
    }

    public function updated_by(){
		return $this->belongsTo('\App\User','id_updated_by');
    }

    public function scopeActive ($query, $active = '1') {
    	if ($active)
        	return $query->where('active','=',$active);

        return $query;
    }    

    public function scopeType ($query, $type) {
    	return $query->where('type','=',$type);
    }
}
