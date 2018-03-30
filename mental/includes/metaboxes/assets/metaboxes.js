
/* ========================================================================= *\
	Metaboxes
\* ========================================================================= */


/**
 * Metabox switcher for showing betabox only for certain page templates
 *
 * @param templateName
 * @param metaboxSelector
 */
function metabox_template_switcher(templateName, metaboxSelector) {
	var templateSwitcher = jQuery('#page_template'); //Page template in the publishing options
	var metabox = jQuery(metaboxSelector);

	if (templateSwitcher.val() === templateName) {
		metabox.show();
	} else {
		metabox.hide();
	}

	templateSwitcher.change(function (e) {
		if (templateSwitcher.val() === templateName) {
			metabox.show();
		}
		else {
			metabox.hide();
		}
	});
}

/**
 * Metabox switcher for showing betabox only for certain post formats
 *
 * @param format
 * @param metaboxSelector
 */
function metabox_format_switcher(format, metaboxSelector) {
	var formatRadios = jQuery('#post-formats-select input[type="radio"]');
	var metabox = jQuery(metaboxSelector);

	if (formatRadios.filter(':checked').val() == format) {
		metabox.show();
	} else {
		metabox.hide();
	}

	formatRadios.on('change', function () {
		if (jQuery(this).val() == format) {
			metabox.show();
		} else {
			metabox.hide();
		}
	});

}
