/*global $, jQuery, document, tabid:true, redux_opts, confirm, relid:true*/

jQuery(document).ready(function () {

    if (jQuery('#last_tab').val() === '') {
        jQuery('.redux-opts-group-tab:first').slideDown('fast');
        jQuery('#redux-opts-group-menu li:first').addClass('active');
    } else {
        tabid = jQuery('#last_tab').val();
        jQuery('#' + tabid + '_section_group').slideDown('fast');
        jQuery('#' + tabid + '_section_group_li').addClass('active');
    }

    jQuery('input[name="' + redux_opts.opt_name + '[defaults]"]').click(function () {
        if (!confirm(redux_opts.reset_confirm)) {
            return false;
        }
    });

    jQuery('.redux-opts-group-tab-link-a').click(function () {
        relid = jQuery(this).attr('data-rel');

        jQuery('#last_tab').val(relid);

        jQuery('.redux-opts-group-tab').each(function () {
            if (jQuery(this).attr('id') === relid + '_section_group') {
                jQuery(this).delay(400).fadeIn(1200);
            } else {
                jQuery(this).fadeOut('fast');
            }
        });

        jQuery('.redux-opts-group-tab-link-li').each(function () {
            if (jQuery(this).attr('id') !== relid + '_section_group_li' && jQuery(this).hasClass('active')) {
                jQuery(this).removeClass('active');
            }
            if (jQuery(this).attr('id') === relid + '_section_group_li') {
                jQuery(this).addClass('active');
            }
        });
    });

    if (jQuery('#redux-opts-save').is(':visible')) {
        jQuery('#redux-opts-save').delay(4000).slideUp('slow');
    }

    if (jQuery('#redux-opts-imported').is(':visible')) {
        jQuery('#redux-opts-imported').delay(4000).slideUp('slow');
    }

    jQuery('#redux-opts-form-wrapper').on('change', 'input, textarea, select', function () {
        if(this.id === 'google_webfonts' && this.value === '') return;
        jQuery('#redux-opts-save-warn').slideDown('slow');
    });

    jQuery('#redux-opts-import-code-button').click(function () {
        if (jQuery('#redux-opts-import-link-wrapper').is(':visible')) {
            jQuery('#redux-opts-import-link-wrapper').fadeOut('fast');
            jQuery('#import-link-value').val('');
        }
        jQuery('#redux-opts-import-code-wrapper').fadeIn('slow');
    });

    jQuery('#redux-opts-import-link-button').click(function () {
        if (jQuery('#redux-opts-import-code-wrapper').is(':visible')) {
            jQuery('#redux-opts-import-code-wrapper').fadeOut('fast');
            jQuery('#import-code-value').val('');
        }
        jQuery('#redux-opts-import-link-wrapper').fadeIn('slow');
    });

    jQuery('#redux-opts-export-code-copy').click(function () {
        if (jQuery('#redux-opts-export-link-value').is(':visible')) {jQuery('#redux-opts-export-link-value').fadeOut('slow'); }
        jQuery('#redux-opts-export-code').toggle('fade');
    });

    jQuery('#redux-opts-export-link').click(function () {
        if (jQuery('#redux-opts-export-code').is(':visible')) {jQuery('#redux-opts-export-code').fadeOut('slow'); }
        jQuery('#redux-opts-export-link-value').toggle('fade');
    });


	/* CUSTOM JS */
	
	var bodyFontOption = jQuery('#body_font_option_0').parent().find('input:checked'),
		webBodyFont = jQuery('#web_body_font').parent().parent(),
		googleStandardFont = jQuery('#google_standard_font').parent().parent(),
		fdStandardFont = jQuery('#fontdeck_standard_font').parent().parent(),
		headingFontOption = jQuery('#headings_font_option_0').parent().find('input:checked'),
		webHeadingFont = jQuery('#web_heading_font').parent().parent(),
		googleHeadingFont = jQuery('#google_heading_font').parent().parent(),
		fdHeadingFont = jQuery('#fontdeck_heading_font').parent().parent(),
		menuFontOption = jQuery('#menu_font_option_0').parent().find('input:checked'),
		webMenuFont = jQuery('#web_menu_font').parent().parent(),
		googleMenuFont = jQuery('#google_menu_font').parent().parent(),
		fdMenuFont = jQuery('#fontdeck_menu_font').parent().parent(),
		fdJS = jQuery('#fontdeck_js').parent().parent();
		
	bodyFontChange(bodyFontOption.val());	
	
	bodyFontOption.parent().find('input').click(function() {
	     bodyFontChange(jQuery(this).val());
	})
	
	function bodyFontChange(value) {
		if (value == "default") {
			webBodyFont.css('display', 'none');
			googleStandardFont.css('display', 'none');
			fdStandardFont.css('display', 'none');
			fdJS.css('display', 'none');
		} else if (value == "standard") {
			webBodyFont.css('display', 'table-row');
			googleStandardFont.css('display', 'none');
			fdStandardFont.css('display', 'none');
			fdJS.css('display', 'none');
		} else if (value == "google") {
			webBodyFont.css('display', 'none');
			googleStandardFont.css('display', 'table-row');
			fdStandardFont.css('display', 'none');
			fdJS.css('display', 'none');
		} else if (value == "fontdeck") {
			webBodyFont.css('display', 'none');
			googleStandardFont.css('display', 'none');
			fdStandardFont.css('display', 'table-row');
			fdJS.css('display', 'table-row');
		}
	}
	
	headingFontChange(headingFontOption.val());	
	
	headingFontOption.parent().find('input').click(function() {
	     headingFontChange(jQuery(this).val());
	})
	
	function headingFontChange(value) {
		if (value == "default") {
			webHeadingFont.css('display', 'none');
			googleHeadingFont.css('display', 'none');
			fdHeadingFont.css('display', 'none');
			fdJS.css('display', 'none');
		} else if (value == "standard") {
			webHeadingFont.css('display', 'table-row');
			googleHeadingFont.css('display', 'none');
			fdHeadingFont.css('display', 'none');
			fdJS.css('display', 'none');
		} else if (value == "google") {
			webHeadingFont.css('display', 'none');
			googleHeadingFont.css('display', 'table-row');
			fdHeadingFont.css('display', 'none');
			fdJS.css('display', 'none');
		} else if (value == "fontdeck") {
			webHeadingFont.css('display', 'none');
			googleHeadingFont.css('display', 'none');
			fdHeadingFont.css('display', 'table-row');
			fdJS.css('display', 'table-row');
		}
	}
	
	
	menuFontChange(menuFontOption.val());	
	
	menuFontOption.parent().find('input').click(function() {
	     menuFontChange(jQuery(this).val());
	})
	
	function menuFontChange(value) {
		if (value == "default") {
			webMenuFont.css('display', 'none');
			googleMenuFont.css('display', 'none');
			fdMenuFont.css('display', 'none');
			fdJS.css('display', 'none');
		} else if (value == "standard") {
			webMenuFont.css('display', 'table-row');
			googleMenuFont.css('display', 'none');
			fdMenuFont.css('display', 'none');
			fdJS.css('display', 'none');
		} else if (value == "google") {
			webMenuFont.css('display', 'none');
			googleMenuFont.css('display', 'table-row');
			fdMenuFont.css('display', 'none');
			fdJS.css('display', 'none');
		} else if (value == "fontdeck") {
			webMenuFont.css('display', 'none');
			googleMenuFont.css('display', 'none');
			fdMenuFont.css('display', 'table-row');
			fdJS.css('display', 'table-row');
		}
	}
	
	jQuery('#body_font_size').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview p').css('font-size', data.value + 'px');
	});
	jQuery('#body_font_line_height').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview p').css('line-height', data.value + 'px');
	});
	
	jQuery('#h1_font_size').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview h1').css('font-size', data.value + 'px');
	});
	jQuery('#h1_font_line_height').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview h1').css('line-height', data.value + 'px');
	});
	
	jQuery('#h2_font_size').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview h2').css('font-size', data.value + 'px');
	});
	jQuery('#h2_font_line_height').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview h2').css('line-height', data.value + 'px');
	});
	
	jQuery('#h3_font_size').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview h3').css('font-size', data.value + 'px');
	});
	jQuery('#h3_font_line_height').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview h3').css('line-height', data.value + 'px');
	});
	
	jQuery('#h4_font_size').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview h4').css('font-size', data.value + 'px');
	});
	jQuery('#h4_font_line_height').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview h4').css('line-height', data.value + 'px');
	});
	
	jQuery('#h5_font_size').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview h5').css('font-size', data.value + 'px');
	});
	jQuery('#h5_font_line_height').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview h5').css('line-height', data.value + 'px');
	});
	
	jQuery('#h6_font_size').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview h6').css('font-size', data.value + 'px');
	});
	jQuery('#h6_font_line_height').bind("slider:changed", function (event, data) {
		jQuery('#typography-preview h6').css('line-height', data.value + 'px');
	});
		
});
