/**
 * Controls the behaviours of custom metabox fields.
 *
 * @author Andrew Norcross
 * @author Jared Atchison
 * @author Bill Erickson
 * @author Justin Sternberg
 * @see    https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

/*jslint browser: true, devel: true, indent: 4, maxerr: 50, sub: true */
/*global jQuery, tb_show, tb_remove */

/**
 * Custom jQuery for Custom Metaboxes and Fields
 */
jQuery(document).ready(function ($) {
	'use strict';

	var formfield;

	/**
	 * Initialize timepicker (this will be moved inline in a future release)
	 */
	$('.cmb_timepicker').each(function () {
		$('#' + jQuery(this).attr('id')).timePicker({
			startTime: "07:00",
			endTime: "22:00",
			show24Hours: false,
			separator: ':',
			step: 30
		});
	});

	/**
	 * Initialize jQuery UI datepicker (this will be moved inline in a future release)
	 */
	$('.cmb_datepicker').each(function () {
		$('#' + jQuery(this).attr('id')).datepicker();
		// $('#' + jQuery(this).attr('id')).datepicker({ dateFormat: 'yy-mm-dd' });
		// For more options see http://jqueryui.com/demos/datepicker/#option-dateFormat
	});
	// Wrap date picker in class to narrow the scope of jQuery UI CSS and prevent conflicts
	$("#ui-datepicker-div").wrap('<div class="cmb_element" />');

	/**
	 * Initialize color picker
	 */
	if (typeof jQuery.wp === 'object' && typeof jQuery.wp.wpColorPicker === 'function') {
		$('input:text.cmb_colorpicker').wpColorPicker();
	} else {
		$('input:text.cmb_colorpicker').each(function (i) {
			$(this).after('<div id="picker-' + i + '" style="z-index: 1000; background: #EEE; border: 1px solid #CCC; position: absolute; display: block;"></div>');
			$('#picker-' + i).hide().farbtastic($(this));
		})
		.focus(function () {
			$(this).next().show();
		})
		.blur(function () {
			$(this).next().hide();
		});
	}

	/**
	 * File and image upload handling
	 */
	$('.cmb_upload_file').change(function () {
		formfield = $(this).attr('name');
		$('#' + formfield + '_id').val("");
	});

	$('.cmb_upload_button').on('click', function (event) {
		formfield = $(this).prev('input').attr('name');
		var activeFileUploadContext = $(this).parent();

        event.preventDefault();

        // if its not null, its broking custom_file_frame's onselect "activeFileUploadContext"
        var custom_file_frame = null;

        // Create the media frame.
        console.log(wp);
        custom_file_frame = wp.media.frames.customHeader = wp.media({
        	// Set the title of the modal.
            title: $(this).data("choose"),

            // Tell the modal to show only images. Ignore if want ALL
            library: {
                type: 'image'
            },
            // Customize the submit button.
            button: {
                // Set the text of the button.
                text: $(this).data("update")
            }
        });

        custom_file_frame.on( "select", function() {
            // Grab the selected attachment.
            var attachment = custom_file_frame.state().get("selection").first();

            // Update value of the targetfield input with the attachment url.
            $('#' + formfield ).val(attachment.attributes.url);
            $('#' + formfield + '_id' ).val(attachment.attributes.id);
        });

        custom_file_frame.open();

	});

	$('.cmb_remove_file_button').live('click', function () {
		formfield = $(this).attr('rel');
		$('input#' + formfield).val('');
		$('input#' + formfield + '_id').val('');
		$(this).parent().remove();
		return false;
	});

	/**
	 * Ajax oEmbed display
	 */

	// ajax on paste
	$('.cmb_oembed').bind('paste', function (e) {
		var pasteitem = $(this);
		// paste event is fired before the value is filled, so wait a bit
		setTimeout(function () {
			// fire our ajax function
			doCMBajax(pasteitem, 'paste');
		}, 100);
	}).blur(function () {
		// when leaving the input
		setTimeout(function () {
			// if it's been 2 seconds, hide our spinner
			$('.postbox table.cmb_metabox .cmb-spinner').hide();
		}, 2000);
	});

	// ajax when typing
	$('.cmb_metabox').on('keyup', '.cmb_oembed', function (event) {
		// fire our ajax function
		doCMBajax($(this), event);
	});

	// function for running our ajax
	function doCMBajax(obj, e) {
		// get typed value
		var oembed_url = obj.val();
		// only proceed if the field contains more than 6 characters
		if (oembed_url.length < 6)
			return;

		// only proceed if the user has pasted, pressed a number, letter, or whitelisted characters
		if (e === 'paste' || e.which <= 90 && e.which >= 48 || e.which >= 96 && e.which <= 111 || e.which == 8 || e.which == 9 || e.which == 187 || e.which == 190) {

			// get field id
			var field_id = obj.attr('id');
			// get our inputs context for pinpointing
			var context = obj.parents('.cmb_metabox tr td');
			// show our spinner
			$('.cmb-spinner', context).show();
			// clear out previous results
			$('.embed_wrap', context).html('');
			// and run our ajax function
			setTimeout(function () {
				// if they haven't typed in 500 ms
				if ($('.cmb_oembed:focus').val() == oembed_url) {
					$.ajax({
						type : 'post',
						dataType : 'json',
						url : window.ajaxurl,
						data : {
							'action': 'cmb_oembed_handler',
							'oembed_url': oembed_url,
							'field_id': field_id,
							'post_id': window.cmb_ajax_data.post_id,
							'cmb_ajax_nonce': window.cmb_ajax_data.ajax_nonce
						},
						success: function (response) {
							// if we have a response id
							if (typeof response.id !== 'undefined') {
								// hide our spinner
								$('.cmb-spinner', context).hide();
								// and populate our results from ajax response
								$('.embed_wrap', context).html(response.result);
							}
						}
					});
				}
			}, 500);
		}
	}

});