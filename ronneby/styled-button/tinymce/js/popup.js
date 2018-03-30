var StyledButtonPopup = {
	init: function() {
	},
	
	insert: function(form, preview) {
		if (form == undefined || form.length == 0 || button_shortcode_name == undefined) {
			console.log('Form or shortcode name is undefined');
			return false;
		}
		
		var form_data = form.serializeArray();
		
		var shortcode = '['+button_shortcode_name;
		jQuery.each(form_data, function(key, setting){
			shortcode += ' '+setting.name+'="'+setting.value+'"';
		});
		shortcode += ']';
		
		if (preview != undefined && preview == true) {
			jQuery('#preview').empty();
			jQuery.post(ajaxurl, {action: 'styled_button_preview', shortcode: shortcode}, function(response) {
				if (response != '') {
					jQuery('#preview').html(response);
				}
			});
		} else {
			tinyMCEPopup.editor.execCommand('mceInsertContent', false, shortcode);
			tinyMCEPopup.close();
		}
	}
}

tinyMCEPopup.onInit.add(StyledButtonPopup.init, StyledButtonPopup);