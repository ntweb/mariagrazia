<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videogallery extends Model
{
	use \Dimsav\Translatable\Translatable;
    
    protected $table = 'lab_videogalleries';
    public $translatedAttributes = ['title', 'abstract', 'description', 'mtitle', 'mdescription', 'mkeys', 'murl'];

    public function created_by(){
		return $this->belongsTo('\App\User','id_created_by');
    }

    public function updated_by(){
		return $this->belongsTo('\App\User','id_updated_by');
    }
}
