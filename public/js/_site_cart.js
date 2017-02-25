(function($) {

	$(document).on('ready', function(){

		$(document).on('click', '*[data-cart-widget="mod_qty"]', function(){
			var v = parseInt($(this).data('v'));
			var target = $('.target-'+$(this).data('target')).first();
			var val = parseInt(target.val()) + v;
			if (val > 0) target.val(val);

			var frm = $('.cart-form-'+$(this).data('target')).first();
			var qty = frm.find('input[name="qty"]').first()
			qty.val(target.val());

		});

		$(document).on('click', '*[data-cart-widget="add"]', function(){
			var frm = $($(this).data('target')).first();
			var data_serialized = frm.serialize();
			var route = frm.data('route');
			var btn = $(this);
			var v = btn.html();
			btn.html('wait...');
			btn.attr('disabled', 'disabled');

			$.post(route, data_serialized, function(data){
				btn.html(v);
				btn.removeAttr('disabled');
				if (data.error)
					alertify.error(data.error);
				if (data.success) {
					alertify.success(data.success);
					refreshCartWidget();
				}

			}, 'json');

		});

		$(document).on('click', '*[data-cart-widget="delete"]', function(){
			var route = $(this).data('route');
			var v = $(this).data('v');
			$.get(route, function(data){
				if (data.error)
					alertify.error(data.error);
				else {
					$(v).remove();
					if (data.location)
						window.location.replace(data.location);
					else
						refreshCartWidget();
				}
			}, 'json');

		});

		$(document).on('click', '*[data-cart-widget="mod_color"]', function(){
			var v = $(this).data('v');
			var frm = $($(this).data('target')).first();
			frm.find('input[name="color"]').first().val(v);
		});

		$(document).on('click', '*[data-cart-widget="mod_size"]', function(){
			var v = $(this).data('v');
			var frm = $($(this).data('target')).first();
			frm.find('input[name="size"]').first().val(v);
		});

		function refreshCartWidget() {
			var widget = $('*[data-cart-widget="cart_refresh"]').first();
			var route = widget.data('route');
			$.get(route, function(data){
				widget.html(data);
			}, 'html');
		}

	});

})(jQuery);