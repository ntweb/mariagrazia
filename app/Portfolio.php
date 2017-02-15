<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
	use \Dimsav\Translatable\Translatable;
    
    protected $table = 'lab_portfolios';
    public $translatedAttributes = ['title', 'abstract', 'description', 'mtitle', 'mdescription', 'mkeys', 'murl'];

    public function created_by(){
		return $this->belongsTo('\App\User','id_created_by');
    }

    public function updated_by(){
		return $this->belongsTo('\App\User','id_updated_by');
    }
}
