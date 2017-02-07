var maincontainer = '#rpc-container'; // containe rprincipale per risultati RPC

(function($) {

	$(document).on('ready', function(){
	
		$(document).on('submit', 'form.ns', function(e){
			e.preventDefault();

			var frm = $(this);
			var btn = frm.find("*[type='submit']").first();
			var route = frm.data('route');
			if (typeof route === 'undefined' ) {alert ('error: no route detected.'); return false;}

			var check = frm.find("*[type='checkbox'][name='confirm']").first();
			if (check.length)
				if (!check.is(':checked')){
					popUpError('Please confirm.')
					return false;
				}

			var dataserialized = frm.serialize();
			var callback = frm.data('callback');
			if (typeof callback === 'undefined') callback = null;

			var method = frm.data('method');
			if (typeof method === 'undefined') method = 'POST';

			if (method == 'POST') {
				var dataserialized = new FormData(frm[0]); // per upload dei file
				var processData = false;
				var contentType = false;
			}
			else { // PUT
				var dataserialized = frm.serialize();				
				var processData = false;				
				var contentType = 'application/x-www-form-urlencoded,multipart/form-data,text/plain';
			}			

			var btnOldValue = btn.html();
			btn.attr('disabled', 'disabled');
			btn.html('Wait..');
			waitButton(btn, true);

			var dataType = 'json';

	        $.ajax({
	            method: method,
	            url: route,
				data: dataserialized,
				cache: false,
				processData: processData,
				contentType: contentType,				
	            dataType: dataType,
	            timeout: 60000, // timeout ad 1 minuto
	            error: function(jqXHR, textStatus, errorThrown){
	              if (textStatus == 'timeout') {
	              	popUpError ('Timeout error');                
	              } 
				  else {				  	
				  	popUpError (jqXHR.status+" "+errorThrown);
				  }
	            },
	            beforeSend: function() {

					hideErrorsSuccess();
	            },
	            success: function(data){
					if (data.error) {
						simpleError (frm, data.error);
					}
					if (data.errorfields) {
						fieldsError (frm, data.errorfields);
					}

					if (data.error || data.errorfields)
						return false;

					if (callback) {
						if (data.result)
							callback = callback.replace("param", data.result);
						
						eval(callback+";");
					}

					if (data.redirect)
						window.location.replace(data.redirect);

					if (data.success)
						simpleSuccess (frm, data.success);

		  			var _ismodified = frm.find("input[name='_ismodified']").first();
		  			if (_ismodified.length) {
		  				_ismodified.val(0);
		  			}


	            },
	            complete: function(){
				  btn.html(btnOldValue);
				  btn.removeAttr('disabled');
				  waitButton(btn, false);
				  
				  if (frm.hasClass('ns-reset')) {				  	
				  	frm[0].reset();
				  }
	            }
	        });					

		});

		$(document).on( "submit", ".form-get-html", function(e) {
			e.preventDefault();
			var route = $(this).data('route');
			var container = $(this).data('container');
			var callback = $(this).data('callback');
			var confirm = $(this).data('confirm');
			
			var dataserialized = $(this).serialize();

			if (route.indexOf("?")<0)			
				route = route+'?'+dataserialized;
			else
				route = route+'&'+dataserialized;

			getHtml(route, container, callback, confirm);
		});

		$(document).on( "click", ".get-html", function(e) {
			e.preventDefault();
			var btn = $(this);
			var route = btn.data('route');
			var container = btn.data('container');
			var callback = $(this).data('callback');
			var confirm = $(this).data('confirm');			

			getHtml(route, container, callback, confirm);
		});

		$(document).on( "click", ".get-json", function(e) {
			e.preventDefault();
			var btn = $(this);
			var route = btn.data('route');
			var callback = btn.data('callback');
			if (typeof callback === 'undefined') callback = null;

			getJson(route, btn, callback);
		});

	   $(document).on( "change", "._ismodified input, ._ismodified select, ._ismodified textarea", function(){
	   		var frm = $(this).closest('form');
	   		$(this).addClass('warning');
	   		if (frm.length) {
	  			var _ismodified = frm.find("input[name='_ismodified']").first();
	  			if (_ismodified.length) {
	  				// console.log(_ismodified);
	  				_ismodified.val(1);
	  			}
	   		}
	   }); 		

	});

	$(document).on('keyup', '.format-code', function(){

		var precode = $(".format-code[name='precode']").first().val().trim();
		var postcode = $(".format-code[name='postcode']").first().val().trim();
		var code = $("input[name='code']").first();


		var str = "" + postcode;
		var pad = "00000";
		var ans = pad.substring(0, pad.length - str.length) + str;
		var formattedcode = precode+"-"+ans;
		
		code.val(formattedcode.toUpperCase());
		$(".format-code[name='precode']").first().val(precode); // trim
		$(".format-code[name='postcode']").first().val(postcode); // trim

	});

	$(document).on('click', "input[name='fl_reminder']", function(){				
		if ($(this).is(':checked'))
			$(this).closest('form').find("textarea[name='reminder']").first().show(100);
		else
			$(this).closest('form').find("textarea[name='reminder']").first().hide(100);
	});

	$(document).on('shown.bs.tab', 'a[data-toggle="tab"]', function (e) {
	  	// console.log(e.target) // newly activated tab
	  	// console.log(e.relatedTarget) // previous active tab

	  	// controllo se esiste un form e se è stato modificato
	  	var prevTab = $($(e.relatedTarget).attr('href'));
	  	if (prevTab.length) {
	  		// console.log(prevTab);
	  		var frm = prevTab.find('form').first();
	  		if (frm.length) {
	  			// console.log(frm);
	  			var _ismodified = frm.find("input[name='_ismodified']").first();
	  			if (_ismodified.length) {
	  				// console.log(_ismodified);
	  				if (_ismodified.val() == 1) {
	  					// alert ('Has been modified!!!!!!');	 
	  					simpleError(frm, 'Please, save modified form.')
	  					$(e.relatedTarget).tab('show');	  					
	  				}
	  			}
	  		}
	  	}
	});

	$(document).on('click', '.edit-allegato', function(e){
		var frm = $('#frm-allegato');
		frm.find("input[name='num']").first().val($(this).data('num'));
		frm.find("input[name='label']").first().val($(this).data('label'));
		frm.find("input[name='id']").first().val($(this).data('id'));
		frm.find("input[name='brand']").first().val($(this).data('brand'));		
		frm.find("input[name='code']").first().val($(this).data('code'));		
	});

	$(document).on('click', '.callback', function(e){
		var callback = $(this).data('callback');
		eval(callback+";");
	});

})(jQuery);

function getHtml(route, container, callback, confirmmsg) {
	(function($) {
		if(typeof container == "undefined") 
			container = maincontainer;

		if(typeof confirmmsg != "undefined") {
			if (!confirm(confirmmsg)) return false;
		}

		spinner(container);

		$.get(route, function(data){							
			$(container).html(data);

			if (typeof callback !== 'undefined')
				eval(callback+";");

			initUI();
		}, 'html');
	})(jQuery);
}

function getHtmlNoSpinner(route, container) {
	(function($) {
		if(typeof container == "undefined") 
			container = maincontainer;

		$.get(route, function(data){							
			$(container).html(data);
			initUI();
		}, 'html');
	})(jQuery);
}

function getJson(route, btn, callback) {
	(function($) {
		var txt = btn.html();
		btn.html('wait...');
		$.get(route, function(data){							

			btn.html(txt);

			if (data.error) {
				popUpError (data.error);
				return;
			}

			if (callback) {
				if (data.result)
					callback = callback.replace("param", data.result);
								
				eval(callback+";");
			}

			if (data.success)
				popUpSuccess (data.success);
			
		}, 'json');

	})(jQuery);
}

function spinner (container) {
	(function($) {
		data = '<div style="margin-left: 10px; margin-top: 5px;"><i class="fa fa-circle-o-notch fa-spin spinner" aria-hidden="true"></i> wait...</div>';
		$(container).html(data);
	})(jQuery);
}

function waitButton(btn, bool) {
	(function($) {
		if (bool) {
			btn.hide(0);
			var loader = $('<i class="fa fa-circle-o-notch fa-spin spinner" aria-hidden="true"></i>');
			loader.insertBefore(btn);
		}
		else {
			$('.spinner').remove();
			btn.show(0);
		}
	})(jQuery);
}

function simpleError (frm, message) {
	var errorAlert = frm.find('.alert-danger').first();
	if (errorAlert.length > 0) {
		errorAlert.html(message);
		errorAlert.show(0);
		return true;
	}

	popUpError(message);		
}

function fieldsError (frm, errorFields) {
	(function($) {
		$.each(errorFields, function(i, el) {
			var element = frm.find("*[name='"+i+"']").first();
			element.closest('.form-group').addClass('has-error');
			$('<span>').addClass('label')
					.addClass('label-danger')
					.addClass('pull-left')
					.addClass('margin-top2px')
					.text(el)
					.insertAfter(element);
		});
	})(jQuery);
}

function popUpError (message) {		
	swal({
        title: "Error",
        text: message,
        confirmButtonColor: "#DD6B55"
    });		
}

function simpleSuccess (frm, message) {
	var successAlert = frm.find('.alert-success').first();
	if (successAlert.length > 0) {
		successAlert.html(message);
		successAlert.show(0);
		return true;
	}

	popUpSuccess(message);
}

function popUpSuccess (message) {

    text = '<div class="activity-item"> <i class="fa fa-thumbs-o-up text-alert"></i> <div class="activity"> '+message+' </div> </div>';
    layout = 'topRight';
    type = 'success';

	var n = noty({
                text: text,
                type: type,
                dismissQueue: true,
                layout: layout,
                closeWith: ['click'],
                theme: 'MatMixNoty',
                maxVisible: 10,                
                animation: {
                    open: 'noty_animated bounceInRight',
                    close: 'noty_animated bounceOutRight',
                    easing: 'swing',
                    speed: 500
                }
            });
            setTimeout(function () {
                n.close();
            }, 3000);    
}

function hideErrorsSuccess () {
	(function($) {
		$('.alert-danger').hide(0);
		$('.alert-sucess').hide(0);
		$('.label-danger').remove();
		$('*').removeClass('has-error');
		$('*').removeClass('warning');
	})(jQuery);
}	

function openCl (result) {
	var route = result.route;
	getHtml(route);
}	

function openContact (result) {
	var route = result.route;
	getHtml(route);
}	

function openQi (id) {
	(function($) {
		var el = $(id);
		if (el.length)
			el.trigger('click');
	})(jQuery);	
}

function refreshCalendar() {
	bootbox.hideAll();
	(function($) {
	$('#event-calendar').fullCalendar('refetchEvents');
	})(jQuery);
}

function initUI() {
	jQuery('.tabbedwidget').tabs();	
}