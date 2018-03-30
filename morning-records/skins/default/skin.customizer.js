// Interactive change skin custom styles
function morning_records_skin_customizer(option, val) {

	var custom_style = '';

	// Remove 'false' to apply changes without reloading page
	if (option == 'body_style') {
		jQuery('body')
			.removeClass('body_style_boxed body_style_wide body_style_fullwide body_style_fullscreen')
			.addClass('body_style_'+val);
		if (val == 'boxed') jQuery('#custom_options #co_bg_pattern_list a').eq(0).trigger('click');

	} else if (option == 'body_scheme') {

		var classes = jQuery('html').attr('class');
		if (classes) {
			var parts = classes.split(' ');
			classes = '';
			for (var i=0; i<parts.length; i++) {
				if (parts[i].indexOf('scheme_')==-1) 
					classes += (classes ? ' ' : '') + parts[i];
			}
			classes += (classes ? ' ' : '') + 'scheme_' + val;
			jQuery('html').attr('class', classes);
		}

	} else if (option == 'bg_color') {

		jQuery("#custom_options .co_switch_box a[data-value='boxed']").trigger('click');
		jQuery('#custom_options #co_bg_pattern_list .co_pattern_wrapper, #custom_options #co_bg_images_list .co_image_wrapper').removeClass('active');
		jQuery('.body_wrap').removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_image_1 bg_image_2 bg_image_3').css('backgroundColor', val);

	} else if (option == 'bg_pattern') {

		jQuery('.body_wrap')
			.removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_image_1 bg_image_2 bg_image_3')
			.css('backgroundColor', 'transparent')
			.addClass('bg_pattern_' + val);

	} else if (option == 'bg_image') {

		jQuery('.body_wrap')
			.removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_image_1 bg_image_2 bg_image_3')
			.css('backgroundColor', 'transparent')
			.addClass('bg_image_' + val);

	} else {

		morning_records_custom_options_show_loader();
		//location.reload();
		var loc = jQuery('#co_site_url').val();
		var params = MORNING_RECORDS_STORAGE['co_add_params']!=undefined ? MORNING_RECORDS_STORAGE['co_add_params'] : {};
		params[option] = val;
		var pos = -1, pos2 = -1, pos3 = -1;
		for (var option in params) {
			val = params[option];
			pos = pos2 = pos3 = -1;
			if ((pos = loc.indexOf('?')) > 0) {
				if ((pos2 = loc.indexOf(option, pos)) > 0) {
					if ((pos3 = loc.indexOf('&', pos2)) > 0)
						loc = loc.substr(0, pos2) + option+'='+val + loc.substr(pos3);
					else
						loc = loc.substr(0, pos2) + option+'='+val;
				} else
					loc += '&'+option+'='+val;
			} else
				loc += '?'+option+'='+val;
		}
		window.location.href = loc;
		return;

	}

	if (custom_style != '') {
		var styles = jQuery('#morning_records-customizer-styles-'+option).length > 0 ? jQuery('#morning_records-customizer-styles-'+option) : '';
		if (styles.length == 0)
			jQuery('head').append('<style id="morning_records-customizer-styles-'+option+'" type="text/css">'+custom_style+'</style>');
		else
			styles.html(custom_style);
	}
}
