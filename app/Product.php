<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	use \Dimsav\Translatable\Translatable;
    
    protected $table = 'lab_products';
    public $translatedAttributes = ['title', 'abstract', 'description', 'mtitle', 'mdescription', 'mkeys', 'murl'];

    public function created_by(){
		return $this->belongsTo('\App\User','id_created_by');
    }

    public function updated_by(){
		return $this->belongsTo('\App\User','id_updated_by');
    }

    public function subcategory(){
		return $this->belongsTo('\App\Subcategory','type');
    }

    public function scopeType ($query, $type) {
        return $query->where('type','=',$type);
    }
    
    public function scopeActive ($query, $active = '1') {
        if ($active)
            return $query->where('active','=',$active);

        return $query;
    }
    
    private function attachments() {
        return $this->hasMany('\App\Upload', 'id_el');
    }

    public function attachments_images() {
        return $this->attachments()->where('img', '=', '1')->where('uploadfolder', '=', $this->uploadfolder);
    }

    public function attachments_docs() {
        return $this->attachments()->where('img', '=', '0')->where('uploadfolder', '=', $this->uploadfolder);
    }

    public function reviews() {        
        return $this->hasMany('\App\Review', 'id_el')->where('type', '=', $this->uploadfolder)->active();
    }        

    private function options() {
        return $this->hasMany('\App\Productoption', 'id_product');
    }

    public function options_colors() {
        return $this->options()->where('type', '=', 'color')
                                ->where('active', '=', '1')
                                ->orderBy('order');
    }

    public function options_sizes() {
        return $this->options()->where('type', '=', 'size')
                                ->where('active', '=', '1')
                                ->orderBy('order');
    }

}
