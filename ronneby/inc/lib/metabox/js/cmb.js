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

	$('.cmb_upload_button').live('click', function () {
		var buttonLabel;
		formfield = $(this).prev('input').attr('name');
		buttonLabel = 'Use as ' + $('label[for=' + formfield + ']').text();
		tb_show('', 'media-upload.php?post_id=' + $('#post_ID').val() + '&type=file&cmb_force_send=true&cmb_send_label=' + buttonLabel + '&TB_iframe=true');
		return false;
	});

	$('.cmb_remove_file_button').live('click', function () {
		formfield = $(this).attr('rel');
		$('input#' + formfield).val('');
		$('input#' + formfield + '_id').val('');
		$(this).parent().remove();
		return false;
	});

	window.original_send_to_editor = window.send_to_editor;
    window.send_to_editor = function (html) {
		var itemurl, itemclass, itemClassBits, itemid, htmlBits, itemtitle,
			image, uploadStatus = true;

		if (formfield) {

	        if ($(html).html(html).find('img').length > 0) {
				itemurl = $(html).html(html).find('img').attr('src'); // Use the URL to the size selected.
				itemclass = $(html).html(html).find('img').attr('class'); // Extract the ID from the returned class name.
				itemClassBits = itemclass.split(" ");
				itemid = itemClassBits[itemClassBits.length - 1];
				itemid = itemid.replace('wp-image-', '');
	        } else {
				// It's not an image. Get the URL to the file instead.
				htmlBits = html.split("'"); // jQuery seems to strip out XHTML when assigning the string to an object. Use alternate method.
				
				if (htmlBits.length>1) {
					itemurl = htmlBits[1]; // Use the URL to the file.
				} else {
					itemurl = '';
				}
				
				if (htmlBits.length>2) {
					itemtitle = htmlBits[2];
					itemtitle = itemtitle.replace('>', '');
					itemtitle = itemtitle.replace('</a>', '');
				} else {
					itemtitle = '';
				}
				itemid = ""; // TO DO: Get ID for non-image attachments.
			}

			image = /(jpe?g|png|gif|ico)$/gi;

			if (itemurl && itemurl.match(image)) {
				uploadStatus = '<div class="img_status"><img src="' + itemurl + '" alt="" /><a href="#" class="cmb_remove_file_button" rel="' + formfield + '">Remove Image</a></div>';
			} else {
				// No output preview if it's not an image
				// Standard generic output if it's not an image.
				html = '<a href="' + itemurl + '" target="_blank" rel="external">View File</a>';
				uploadStatus = '<div class="no_image"><span class="file_link">' + html + '</span>&nbsp;&nbsp;&nbsp;<a href="#" class="cmb_remove_file_button" rel="' + formfield + '">Remove</a></div>';
			}

			$('#' + formfield).val(itemurl);
			$('#' + formfield + '_id').val(itemid);
			$('#' + formfield).siblings('.cmb_media_status').slideDown().html(uploadStatus);
			tb_remove();

		} else {
			window.original_send_to_editor(html);
		}

		formfield = '';
	};

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



	//Show/hide metabox, depending on element value
	jQuery(document).ready(function() {
		toggleMetaboxOnFormat("post_video_custom_fields", 'video');
		toggleMetaboxOnFormat("post_audio_custom_fields", 'audio');
		toggleMetaboxOnFormat("post_quote_custom_fields", 'quote');

		jQuery("input[name=post_format]").on("change", function() {
			toggleMetaboxOnFormat("post_video_custom_fields", 'video');
			toggleMetaboxOnFormat("post_audio_custom_fields", 'audio');
			toggleMetaboxOnFormat("post_quote_custom_fields", 'quote');
		});
	});

    function toggleMetaboxOnFormat(metaboxId, value) {
		var format = jQuery("input[name=post_format]:checked").val();
		if (format != value) {
			jQuery("#" + metaboxId).slideUp("fast");
		} else {
			jQuery("#" + metaboxId).slideDown("fast");
		}
	}

});
(function($) {
	'use strict';
	$(document).ready(function() {
		var checkbox = $('#dfd_enable_animation');
		var showHideElements = $('#dfd_enable_dots').parents('tr');
		var hideShowElements = $('#dfd_animation_style').parents('tr');
		var showHideOnePageOptions = function() {
			if(checkbox.is(':checked')) {
				showHideElements.hide();
				hideShowElements.show();
			} else {
				showHideElements.show();
				hideShowElements.hide();
			}
		};
		showHideOnePageOptions();
		checkbox.change(function() {
			showHideOnePageOptions();
		});
	});
})(jQuery);
(function($) {
	'use strict';
	$(document).ready(function() {
		var select = $('#preloader_style'),
			css_anim_field = $('#preloader_animation_style').parents('tr'),
			css_anim_color = css_anim_field.next('tr'),
			preloader_image = $('#preloader_img').parents('tr'),
			bar_height = $('#preloader_bar_height').parents('tr'),
			bar_bg = bar_height.next('tr'),
			bar_opacity = bar_bg.next('tr'),
			bar_position = bar_opacity.next('tr');
		var showHidePreloaderOptions = function() {
			switch(select.val()) {
				case 'css_animation':
					css_anim_field.show();
					css_anim_color.show();
					preloader_image.hide();
					bar_height.hide();
					bar_bg.hide();
					bar_opacity.hide();
					bar_position.hide();
					break;
				case 'image':
					css_anim_field.hide();
					css_anim_color.hide();
					preloader_image.show();
					bar_height.hide();
					bar_bg.hide();
					bar_opacity.hide();
					bar_position.hide();
					break;
				case 'progress_bar':
					css_anim_field.hide();
					css_anim_color.hide();
					preloader_image.hide();
					bar_height.show();
					bar_bg.show();
					bar_opacity.show();
					bar_position.show();
					break;
				default:
					css_anim_field.hide();
					css_anim_color.hide();
					preloader_image.hide();
					bar_height.hide();
					bar_bg.hide();
					bar_opacity.hide();
					bar_position.hide();
					break;
			}
		};
		showHidePreloaderOptions();
		select.change(function() {
			showHidePreloaderOptions();
		});
	});
})(jQuery);
(function($) {
	'use strict';
	$(document).ready(function() {
		var select = $('#dfd_gallery_single_type'),
			slides = $('#dfd_gallery_single_slides'),
			autoplay = $('#dfd_gallery_single_autoplay'),
			slideshowSpeed = $('#dfd_gallery_single_slideshow_speed'),
			columns = $('#dfd_gallery_single_columns'),
			imageWidth = $('#dfd_gallery_single_image_width'),
			imageHeight = $('#dfd_gallery_single_image_height');
		var showHideGalleryOptions = function() {
			switch(select.val()) {
				case 'carousel':
					slides.parents('tr').show();
					autoplay.parents('tr').show();
					slideshowSpeed.parents('tr').show();
					imageWidth.parents('tr').show();
					imageHeight.parents('tr').show();
					columns.val('').parents('tr').hide();
					break;
				case 'masonry':
					slides.val('').parents('tr').hide();
					autoplay.val('').parents('tr').hide();
					slideshowSpeed.val('').parents('tr').hide();
					imageWidth.val('').parents('tr').hide();
					imageHeight.val('').parents('tr').hide();
					columns.parents('tr').show();
					break;
				case 'fitRows':
					slides.val('').parents('tr').hide();
					autoplay.val('').parents('tr').hide();
					slideshowSpeed.val('').parents('tr').hide();
					columns.parents('tr').show();
					imageWidth.parents('tr').show();
					imageHeight.parents('tr').show();
					break;
				default:
					slides.val('').parents('tr').hide();
					autoplay.val('').parents('tr').hide();
					slideshowSpeed.val('').parents('tr').hide();
					columns.val('').parents('tr').hide();
					imageWidth.val('').parents('tr').hide();
					imageHeight.val('').parents('tr').hide();
					break;
			}
		};
		showHideGalleryOptions();
		select.change(function() {
			showHideGalleryOptions();
		});
	});
})(jQuery);
(function($) {
	'use strict';
	$(document).ready(function() {
		var select = $('#dfd_gallery_layout_style'),
			columns = $('#dfd_gallery_columns');
		var showHideLoopGalleryOptions = function() {
			var selectVal = select.val();
			if(selectVal == 'masonry' || selectVal == 'fitRows') {
				columns.parents('tr').show();
			} else {
				columns.val('').parents('tr').hide();
			}
		};
		showHideLoopGalleryOptions();
		select.change(function() {
			showHideLoopGalleryOptions();
		});
	});
})(jQuery);
(function($) {
	'use strict';
	$(document).ready(function() {
		var select = $('#dfd_gallery_show_title'),
			settings = $('#dfd_gallery_title_position');
		var showHideTitleOption = function() {
			var selectVal = select.val();
			if(selectVal == 'on') {
				settings.parents('tr').show();
			} else {
				settings.val('').parents('tr').hide();
			}
		};
		showHideTitleOption();
		select.change(function() {
			showHideTitleOption();
		});
	});
})(jQuery);
(function($) {
	'use strict';
	$(document).ready(function() {
		var select = $('#folio_layout_style'),
			columns = $('#folio_columns');
		var showHideLoopGalleryOptions = function() {
			var selectVal = select.val();
			if(selectVal == 'masonry' || selectVal == 'fitRows') {
				columns.parents('tr').show();
			} else {
				columns.val('').parents('tr').hide();
			}
		};
		showHideLoopGalleryOptions();
		select.change(function() {
			showHideLoopGalleryOptions();
		});
	});
})(jQuery);
(function($) {
	'use strict';
	$(document).ready(function() {
		var select = $('#blog_layout_style'),
			columns = $('#blog_columns'),
			sort_panel = $('#blog_sort_panel'),
			sort_panel_align = $('#blog_sort_panel_align'),
			offset = $('#blog_items_offset');
		var showHideLoopBlogOptions = function() {
			var selectVal = select.val();
			if(selectVal == 'masonry' || selectVal == 'fitRows') {
				columns.parents('tr').show();
				sort_panel.parents('tr').show();
				sort_panel_align.parents('tr').show();
				offset.parents('tr').show();
			} else {
				columns.val('').parents('tr').hide();
				sort_panel.val('').parents('tr').hide();
				sort_panel_align.val('').parents('tr').hide();
				offset.val('').parents('tr').hide();
			}
		};
		showHideLoopBlogOptions();
		select.change(function() {
			showHideLoopBlogOptions();
		});
	});
})(jQuery);
(function($) {
	'use strict';
	$(document).ready(function() {
		var sort_panel = $('#blog_sort_panel'),
			sort_panel_align = $('#blog_sort_panel_align');
		var showHideLoopSortOptions = function() {
			var selectVal = sort_panel.val();
			if(selectVal != 'on') {
				sort_panel_align.val('').parents('tr').hide();
			} else {
				sort_panel_align.parents('tr').show();
			}
		};
		showHideLoopSortOptions();
		sort_panel.change(function() {
			showHideLoopSortOptions();
		});
	});
})(jQuery);