jQuery(document).ready(function($) {
	$('body').on('click','.pt-favourite-vendor',function(e){
		"use strict";
		e.preventDefault();
		var btn = $(this);
		var vendor_id = btn.data("vendor_id");
		btn.addClass('adding');
		$.ajax({
			type: "post",
			dataType: 'json',
			url: ajax_var.url,
			data: "action=pt-favourite-vendor&nonce="+ajax_var.nonce+"&vendor_id="+vendor_id,
			success: function(data){
				btn.removeClass('adding');
				if ( btn.hasClass('remove-vendor') ) {
					btn.removeClass('pt-favourite-vendor');
					btn.html('<i class="fa fa-times" aria-hidden="true"></i>Removed Successfully');
				} else {
					if (data.added == true) {
						btn.addClass('added');
						btn.prop('title', data.title);
						btn.find('span').html(data.message);
					} else if (data.added == 'no-access') {
						$(".header-container").before(data.message);
					} else {
						btn.removeClass('added');
						btn.prop('title', data.title);
						btn.find('span').html(data.message);
					}
				}
			}
		});
	});
});
