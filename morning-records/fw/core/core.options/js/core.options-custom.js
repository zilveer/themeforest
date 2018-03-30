/* global jQuery:false */

jQuery(document).ready(function() {
	MORNING_RECORDS_STORAGE['media_frame'] = null;
	MORNING_RECORDS_STORAGE['media_link'] = '';
	jQuery('.morning_records_media_selector').on('click', function(e) {
		morning_records_show_media_manager(this);
		e.preventDefault();
		return false;
	});
});

function morning_records_show_media_manager(el) {
	"use strict";

	MORNING_RECORDS_STORAGE['media_link'] = jQuery(el);
	// If the media frame already exists, reopen it.
	if ( MORNING_RECORDS_STORAGE['media_frame'] ) {
		MORNING_RECORDS_STORAGE['media_frame'].open();
		return false;
	}

	// Create the media frame.
	MORNING_RECORDS_STORAGE['media_frame'] = wp.media({
		// Set the title of the modal.
		title: MORNING_RECORDS_STORAGE['media_link'].data('choose'),
		// Tell the modal to show only images.
		library: {
			type: 'image'
		},
		// Multiple choise
		multiple: MORNING_RECORDS_STORAGE['media_link'].data('multiple')===true ? 'add' : false,
		// Customize the submit button.
		button: {
			// Set the text of the button.
			text: MORNING_RECORDS_STORAGE['media_link'].data('update'),
			// Tell the button not to close the modal, since we're
			// going to refresh the page when the image is selected.
			close: true
		}
	});

	// When an image is selected, run a callback.
	MORNING_RECORDS_STORAGE['media_frame'].on( 'select', function(selection) {
		"use strict";
		// Grab the selected attachment.
		var field = jQuery("#"+MORNING_RECORDS_STORAGE['media_link'].data('linked-field')).eq(0);
		var attachment = '';
		if (MORNING_RECORDS_STORAGE['media_link'].data('multiple')===true) {
			MORNING_RECORDS_STORAGE['media_frame'].state().get('selection').map( function( att ) {
				attachment += (attachment ? "\n" : "") + att.toJSON().url;
			});
			var val = field.val();
			attachment = val + (val ? "\n" : '') + attachment;
		} else {
			attachment = MORNING_RECORDS_STORAGE['media_frame'].state().get('selection').first().toJSON().url;
		}
		field.val(attachment);
		if (field.siblings('img').length > 0) field.siblings('img').attr('src', attachment);
		field.trigger('change');
	});

	// Finally, open the modal.
	MORNING_RECORDS_STORAGE['media_frame'].open();
	return false;
}
