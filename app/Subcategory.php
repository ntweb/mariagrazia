<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
	use \Dimsav\Translatable\Translatable;
    
    protected $table = 'lab_subcategories';
    public $translatedAttributes = ['title', 'abstract', 'description', 'mtitle', 'mdescription', 'mkeys', 'murl'];

    public function created_by(){
		return $this->belongsTo('\App\User','id_created_by');
    }

    public function updated_by(){
		return $this->belongsTo('\App\User','id_updated_by');
    }

    public function category(){
		return $this->belongsTo('\App\Category','type');
    }

    public function scopeActive ($query, $active = '1') {
        if ($active)
            return $query->where('active','=',$active);

        return $query;
    }    

    public function products() {
        return $this->hasMany('\App\Product', 'type')
                        ->where('lab_products.active', '=', '1');
    }
}
