(function($){
shibaMediaForm = {
	// get_selected_media(document.posts-filter.list)

	hidden : function(name, value, f) {
		  $('<input>').attr({
			  type: 'hidden',
			  name: name,
			  value: value
		  }).appendTo(f);
	},
	
	addActions : function(f) { // addMediaActions
		// If action is remove then unset doaction so that it does not get caught in 
		// upload.php
		var action = $('#mlib_action').val(); 
			
//		$('input[name=_wp_http_referer]', f).each(function() { alert($(this).val()); });
		jQuery('input[name=_wp_http_referer]', f).remove();
		if ((action == 'remove') || (action == 'set_tags') || (action == 'add_tags')) {
			$('#mlib_doaction').attr('name', 'shiba_doaction');
			// For 3.1 need to rename action and action2
			$('#mlib_action').attr('name', 'shiba_action');
		}
	},	
	
	getMedia : function(form) { //  processMediaPlusForm
		var s = $('#' + form);
		var t = $('#shiba-mlib-form');
		var num = 0;
		
		// get all checked input elements
		$('input[name="media[]"]:checked', s).each(function() { 
			shibaMediaForm.hidden('media[]', $(this).val(), t);
			num++;
		});
		if (num <= 0) {
			$('#mlib_doaction').attr('name', 'shiba_doaction');
			// For 3.1 need to rename action and action2
			$('#mlib_action').attr('name', 'shiba_action');
		}
		// prepare form actions so that it will be properly processed
		shibaMediaForm.addActions(t);
	}
};

})(jQuery);
