// Image Select script
jQuery( document ).ready( function( $ ) {

	$('.rpp_show-expert-options').live('change', function(){
		if( $(this).is(':checked') ) {
			$(this).parent().parent().find('.rpp_expert-panel').show();
		} else {
			$(this).parent().parent().find('.rpp_expert-panel').hide();
		}
	});

	$('.rpp_show-expert-options').trigger('change');


	// Actions for screens with the file select button
	if ( $( '.slt-fs-button' ).length ) {

		// Invoke Media Library interface on button click
		$( '.slt-fs-button' ).click( function() {
			$( 'html' ).addClass( 'File' );
			tb_show( '', 'media-upload.php?slt_fs_field=' + $( this ).siblings( 'input.slt-fs-value' ).attr( 'id' ) + '&type=file&TB_iframe=true' );
			return false;
		});

		// Wipe form values when remove checkboxes are checked
		$( '.menu-save' ).parents( 'form' ).submit( function() {
			$( '.slt-fs-remove:checked' ).each( function() {
				$( this ).parent().find( '.slt-fs-value' ).val( '' );
				$( this ).parent().parent().find( '.edit-menu-item-custom' ).val('');
			});
		});

	}

	// Actions for the Media Library overlay
	if ( $( "body" ).attr( 'id' ) == 'media-upload' ) {

		// Make sure it's an overlay invoked by this plugin
		var parent_doc, parent_src, parent_src_vars, current_tab;
		var select_button = '<a href="#" class="slt-fs-insert button-secondary">' + slt_file_select.text_select_file + '</a>';
		parent_doc = parent.document;
		parent_src = parent_doc.getElementById( 'TB_iframeContent' ).src;
		parent_src_vars = slt_fs_get_url_vars( parent_src );
		if ( 'slt_fs_field' in parent_src_vars ) {
			current_tab = $( 'ul#sidemenu a.current' ).parent( 'li' ).attr( 'id' );
			$( 'ul#sidemenu li#tab-type_url' ).remove();
			$( 'p.ml-submit' ).remove();
			switch ( current_tab ) {
				case 'tab-type': {
					// File upload
					$( 'table.describe tbody tr:not(.submit)' ).remove();
					//$( 'table.describe tr.submit td.savesend input' ).replaceWith( select_button );
					$( 'table.describe tr.submit td.savesend input' ).remove();
					$( 'table.describe tr.submit td.savesend' ).prepend( select_button );
					break;
				}
				case 'tab-library': {
					// Media Library
					$( '#media-items .media-item a.toggle' ).remove();
					$( '#media-items .media-item' ).each( function() {
						$( this ).prepend( select_button );
					});
					$( 'a.slt-fs-insert' ).css({
						'display':  'block',
						'float':    'right',
						'margin':   '7px 20px 0 0'
					});
					break;
				}
			}
			// Select functionality
			$( 'a.slt-fs-insert' ).click( function() {
				var item_id;
				if ( $( this ).parent().attr( 'class' ) == 'savesend' ) {
					item_id = $( this ).siblings( '.del-attachment' ).attr( 'id' );
					item_id = item_id.match( /del_attachment_([0-9]+)/ );
					item_id = item_id[1];
				} else {
					item_id = $( this ).parent().attr( 'id' );
					item_id = item_id.match( /media\-item\-([0-9]+)/ );
					item_id = item_id[1];
				}
				parent.slt_fs_select_item( item_id, parent_src_vars['slt_fs_field'] );
				return false;
			});
		}

	}

});

// Parse URL variables
// See: http://papermashup.com/read-url-get-variables-withjavascript/
function slt_fs_get_url_vars( s ) {
	var vars = {};
	var parts = s.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		vars[key] = value;
	});
	return vars;
}

function slt_fs_select_item( item_id, field_id ) {
	var field, preview_div, preview_size, field_value;
	field = jQuery('#' + field_id);
	field_value = jQuery( '#' + field_id + '-edit-menu-item-custom' );
	preview_div = jQuery( '#' + field_id + '_preview' );
	preview_size = jQuery( '#' + field_id + '_preview-size' ).val();

	// Load preview image
	preview_div.html( '' ).load( slt_file_select.ajaxurl, {
		id: 		item_id,
		size:		preview_size,
		action:		'slt_fs_get_file'
	});

	// Pass ID to form field
	field.val( item_id );

	// Pass value to form field
	jQuery.ajax({
		url: slt_file_select.ajaxurl,
		data: {
			id: 		item_id,
			size:		preview_size,
			action:		'slt_fs_get_file_url'
		},
		success: function(data) {
			field_value.val( data );
		}
	});

	// Close interface down
	tb_remove();
	jQuery( 'html' ).removeClass( 'File' );
}

// AJAX Upload
function upload_image (url) {
	jQuery('.upload_image').each(function() {

		var object = jQuery(this);
		var object_id = jQuery(this).attr('id');
		new AjaxUpload(jQuery(this), {
			action: url,
			name: object_id,
			data: {
				action: 'ajax_post_action',
				type: 'upload',
				data: object_id
			},
			autoSubmit: true,
			responseType: false,
			onChange: function(file, extension) {},
			onSubmit: function(file, extension) {

				// Allow only images.
				if (extension && /^(jpg|png|jpeg|gif|ico)$/.test(extension)) {
					object.text('Uploading');
					this.disable();
					interval = window.setInterval(function() {
						var text = object.text();
						if (text.length < 13) {
							object.text(text + '.');
						} else {
							object.text('Uploading');
						}
					}, 200);
				} else {
					var html = '<div id="media-upload-error">Error: only images are allowed</div>';
					jQuery("#media-upload-error").remove();
					object.parent().after(html);

					return false;
				}
			},
			onComplete: function(file, response) {
				var html = '';

				window.clearInterval(interval);
				object.text('Upload Image');
				this.enable();

				// If there was an error
				if(response.search('Upload Error') > -1) {
					html = '<div id="media-upload-error">' + response + '</div>';
					jQuery("#media-upload-error").remove();
					object.parent().after(html);

				} else {
					html = '<a class="uploaded-image thickbox" href="' + response + '"><img class="added-image" id="image_' + object_id + '" src="' + response + '" alt="" /></a>';

					jQuery("#media-upload-error").remove();
					jQuery("#image_" + object_id).remove();
					object.parent().after(html);
					jQuery('img#image_' + object_id).fadeIn();
					object.parent().prev('input').val(response);
				}
			}
		});

	});
}

// Remove image
function remove_image (el, url) {
	var data = {
		action: 'ajax_post_action',
		type: 'image_reset',
		data: jQuery(el).attr('title')
	};

	jQuery.post(url, data, function(response) {
		var image_to_remove = jQuery('#image_' + jQuery(el).attr('title'));
		var button_to_hide = jQuery('#reset_' + jQuery(el).attr('title'));
		image_to_remove.fadeOut(500, function(){
			jQuery(el).remove();
		});

		// Hide button
		button_to_hide.fadeOut('fast', function () {
			jQuery(el).parent().parent().find('input').val('');
		});
	});

	return false;
}

jQuery(document).ready(function() {

	// Choose layout
	jQuery("#ch_layouts img").click(function() {
		jQuery(this).parent().parent().find(".selected").removeClass("selected");
		jQuery(this).addClass("selected");
	});

	// When changing font family
	jQuery('.font-family').change(function() {
		var google_font = true;
		var currentId = jQuery(this).attr('id');
		var container = jQuery(this).closest(".section-font");
		var preview = container.find('.font-preview');

		// Check if it's a google web font or not
		var arr = ["Arial", "Verdana", "Georgia", "Tahoma", "Trebuchet MS", "Calibri", "Geneva"];
		jQuery.each(arr, function() {
			if (jQuery("#" + currentId + " :selected").text() == this) {
				google_font = false;
				return false;
			}
		});

		// Only add style if it's a google font
		if (google_font) {
			var link = document.createElement('LINK');
			link.rel = "stylesheet";
			link.type = "text/css";
			link.href = 'http://fonts.googleapis.com/css?family=' + jQuery(this).val() + '&subset=cyrillic,greek,latin';
		}

		container.find('.font-styles').append(link);
		preview.css("font-family", jQuery("#" + currentId + " :selected").text());
	});

	// When changing font size
	jQuery('.font-size').change(function() {
		var preview = jQuery(this).closest(".section-font").find('.font-preview');
		preview.css("font-size", "" + jQuery(this).val() + "px");
	});

	// When changing font line height
	jQuery('.line-height').change(function() {
		var preview = jQuery(this).closest(".section-font").find('.font-preview');
		preview.css("line-height", "" + jQuery(this).val() + "px");
	});

	// When changing font weight
	jQuery('.font-weight').change(function() {
		var preview = jQuery(this).closest(".section-font").find('.font-preview');

		// If bold
		if (jQuery(this).val() == 'normal' || jQuery(this).val() == 'bold') {
			preview.css("font-style", "normal");
			preview.css("fontWeight", jQuery(this).val());
		} else if (jQuery(this).val() == 'italic') {
			preview.css("fontWeight", "normal");
			preview.css("font-style", jQuery(this).val());
		} else if (jQuery(this).val() == 'bold_italic') {
			preview.css("font-style", "italic");
			preview.css("fontWeight", "bold");
		}


	});

	// Select all anchor tag with rel set to tooltip
	jQuery('a[rel=tooltip]').mouseover(function(e) {

		// Grab the title attribute's value and assign it to a variable
		var tip = jQuery(this).attr('id');

		// Append the tooltip template and its value
		jQuery(this).append('<div class="tooltip"><div class="tipBody">' + tip + '</div></div>');

		// Show the tooltip with faceIn effect
		jQuery('.tooltip').fadeIn('500');
		jQuery('.tooltip').fadeTo('10',0.8);

	}).mouseout(function() {

		// Put back the title attribute's value
		jQuery(this).attr('id', jQuery(this).attr('id'));

		// Remove the appended tooltip template
		jQuery(this).children('div.tooltip').remove();
	});

	jQuery('.how_many').live('change',function(){
		var wrap = jQuery(this).closest('p').siblings('.advertisement_container');
		wrap.children('div').hide();
		jQuery('.hidden_container:lt('+jQuery(this).val()+')', wrap).show();
	});
});



function SetSliderValue(sliderId, textBoxControl) {
	var amount = textBoxControl.value;
	var minimum = jQuery(sliderId).slider("option", "min");
	var maximum = jQuery(sliderId).slider("option", "max");

	if (amount > minimum || amount < maximum){
		jQuery(sliderId).slider('option', 'value', amount);
	}
}