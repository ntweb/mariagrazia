<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
	use \Dimsav\Translatable\Translatable;
    
    protected $table = 'lab_staff';
    public $translatedAttributes = ['title', 'description', 'mtitle', 'mdescription', 'mkeys', 'murl'];

    public function created_by(){
		return $this->belongsTo('\App\User','id_created_by');
    }

    public function updated_by(){
		return $this->belongsTo('\App\User','id_updated_by');
    }
}
