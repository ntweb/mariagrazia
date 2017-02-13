<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
	use \Dimsav\Translatable\Translatable;
    
    protected $table = 'lab_uploads';
    public $translatedAttributes = ['mtitle', 'mdescription', 'mkeys'];    
}
