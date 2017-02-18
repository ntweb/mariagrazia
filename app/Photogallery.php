<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photogallery extends Model
{
	use \Dimsav\Translatable\Translatable;
    
    protected $table = 'lab_photogalleries';
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

    public function scopeType ($query, $type) {
    	return $query->where('type','=',$type);
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
        
}
