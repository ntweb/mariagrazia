<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
	use \Dimsav\Translatable\Translatable;
    
    protected $table = 'lab_pages';

    public $translatedAttributes = ['title', 'description', 'mtitle', 'mdescription', 'mkeys', 'murl'];    
}
