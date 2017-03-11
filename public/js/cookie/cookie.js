var storage = Storages.localStorage;
// storage.setExpires(7);
var is_cookie_info_hidden = storage.isSet('is_cookie_info_hidden');


$(document).ready(function(){

	// library
	// https://github.com/julien-maurel/js-storage
	if (is_cookie_info_hidden) 
		$('#cookie-info').hide(0);
	else
		$('#cookie-info').show(0);

	$('#close-cookie-info').on('click', function(){
		storage.set('is_cookie_info_hidden','cookie_accepted'); 
		$('#cookie-info').hide(0);
	});

});