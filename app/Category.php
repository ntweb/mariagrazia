<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;

class Category extends Model
{
	use \Dimsav\Translatable\Translatable;
    
    protected $table = 'lab_categories';
    public $translatedAttributes = ['title', 'abstract', 'description', 'mtitle', 'mdescription', 'mkeys', 'murl'];

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

    public function subcategories() {
    	return $this->hasMany('\App\Subcategory', 'type')
    					->where('lab_subcategories.active', '=', '1')
    					->whereHas('translations', function ($query) {
                                $query->where('locale', App::getLocale())
                                ->orderBy('title');
                            });
    }
}
