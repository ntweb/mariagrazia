<?php

	// get Page by id or module
	function page($id_or_module, $active = null) {
		return \App\Page::active($active)->where('id', '=', $id_or_module)->orWhere('module', '=', $id_or_module)->first();
	}

	// get date in locale format
	function fdate($date) {
		if (!$date)
			return null;

		$locale = App::getLocale();
		$l = \App\Language::where('lang', '=', $locale)->first();
		return date($l->date, strtotime($date));
	}

	// get datetime in locale format
	function fdatetime($date) {
		if (!$date)
			return null;

		$locale = App::getLocale();
		$l = \App\Language::where('lang', '=', $locale)->first();
		return date($l->date, strtotime($date));
	}

	function types($label) {
		$types = \App\Parameter::where('label', '=', $label)->first();
		return explode(',', $types->value);
	}

	// get youtube video pic
	// size => hq, mq, sd, max or ''
	function youtube_img($url, $size = 'mq') {

		$queryString = parse_url($url, PHP_URL_QUERY);
		parse_str($queryString, $params);

		return "https://img.youtube.com/vi/".$params['v']."/".$size."default.jpg";
	}

	// get youtube video iframe
	function youtube_video($url) {
		$url = 'https://www.youtube.com/oembed?url='.$url.'&format=json';
		$data = json_decode(file_get_contents($url));

		return $data->html;
	}

	// get doc of model
	function doc($el, $field) {
		$id = $el->id;
		$gallery = '';
		if ($field == 'filename') { // in gallery upload
			$id = $el->id_el;
			$gallery = 'mm/';
		} 

		$folder = $el->uploadfolder;
		$filename = $folder.'/'.$id.'/'.$gallery.$el->$field;

		return url('media/'.$folder.'/'.$id.'/'.$gallery.$el->$field);
	}
	
	// get img of model
	function img($el, $field, $rid = null) {

		$id = $el->id;
		$gallery = '';
		if ($field == 'filename') { // in gallery upload
			$id = $el->id_el;
			$gallery = 'mm/';
		} 

		$folder = $el->uploadfolder;
		$filename = $folder.'/'.$id.'/'.$gallery.$el->$field;

		$rid = strtolower($rid);

		// ridimensiono
		if ($rid && Storage::disk('docs')->exists($filename)) { 
			// controllo se esiste gia il file ridimensionato
			if (!Storage::disk('docs')->exists($folder.'/'.$id.'/'.$gallery.$rid.'-'.$el->$field)) {
				$img = Image::make('media/'.$filename);
				$xxx = explode('x', $rid);
		    	$w = $xxx[0];
		    	$h = $xxx[1];
		    	if ($w == 'n' || $h == 'n'){ // ridimensiono
					$img->resize($w, $h, function ($constraint) {
					    $constraint->aspectRatio();
					});		  				
		    	}
		    	else { // crop
		    		$img->fit($w, $h);
		    	}
		    	$img->save('media/'.$folder.'/'.$id.'/'.$gallery.$rid.'-'.$el->$field,100);
			}
		}

		if ($rid) $rid = str_replace('-', '', $rid).'-';
		return url('media/'.$folder.'/'.$id.'/'.$gallery.$rid.$el->$field);
	}