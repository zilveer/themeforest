jQuery(document).ready(function() {
"use strict";
	jQuery(document).on('click', '.upload_button', function(event) {
		var $clicked = jQuery(this), frame,
			input_id = $clicked.parents("div").find('.input-upload').attr('id'),
			media_type = $clicked.attr('rel');
			var upload_button=jQuery(this);
		event.preventDefault();
		// If the media frame already exists, reopen it.
		if ( frame ) {
			frame.open();
			return;
		}
		
		// Create the media frame.
		frame = wp.media.frames.aq_media_uploader = wp.media({
			// Set the media type
			library: {
				type: media_type
			},
			view: {
				
			}
		});
		
		// When an image is selected, run a callback.
		frame.on( 'select', function() {
			// Grab the selected attachment.
			var attachment = frame.state().get('selection').first();
			upload_button.prev('input[type="text"]').val(attachment.attributes.url);
			//jQuery('#'+input_id).val(attachment.attributes.url);
			if(media_type == 'image') {
			
			$clicked.parent().parent().find('img').attr('src', attachment.attributes.url);
			}
			
		});

		frame.open();
	
	});jQuery(document).on('click', '.upload_button2', function(event) {
		var $clicked = jQuery(this), frame,
		input_id = $clicked.parents("div").find('.input-upload').attr('id'),
		media_type = $clicked.attr('rel');
		var upload_button=jQuery(this);
	event.preventDefault();
	// If the media frame already exists, reopen it.
	if ( frame ) {
		frame.open();
		return;
	}
	
	// Create the media frame.
	frame = wp.media.frames.aq_media_uploader = wp.media({
		// Set the media type
		library: {
			type: media_type
		},
		view: {
			
		}
	});
	
	// When an image is selected, run a callback.
	frame.on( 'select', function() {
		// Grab the selected attachment.
		var attachment = frame.state().get('selection').first();
		upload_button.prev('input[type="text"]').val(attachment.attributes.url);
		//jQuery('#'+input_id).val(attachment.attributes.url);
		if(media_type == 'image') {
		$clicked.parent().parent().find('img').attr('src', attachment.attributes.url);
		}
		
	});

	frame.open();

});
	
	
	
	jQuery(document).on('click', '.upload_button3', function(event) {
		var $clicked = jQuery(this), frame,
		media_type = $clicked.attr('rel');
	event.preventDefault();
	// If the media frame already exists, reopen it.
	if ( frame ) {
		frame.open();
		return;
	}
	
	// Create the media frame.
	frame = wp.media.frames.aq_media_uploader = wp.media({
		// Set the media type
		library: {
			type: media_type
		},
		view: {
			
		}
	});
	
	

	frame.open();

});

	jQuery('.clients_new_field').click(function(){ 
		var last_id=jQuery(this).parent().find('.clients_fields input[type="text"]').last().attr('data-id');
		var last_name=jQuery(this).parent().find('.clients_fields input[data-type="link"]').last().attr('name');
		var last_name_image=jQuery(this).parent().find('.clients_fields input[data-type="image"]').last().attr('name');
		var last_id_content=jQuery(this).parent().find('.clients_fields input[data-type="link"]').last().attr('id');
		var last_id_image=jQuery(this).parent().find('.clients_fields input[data-type="image"]').last().attr('id');
		var last_id_new=parseInt(last_id)+1;
		jQuery(this).parent().find('.clients_fields').append('<p><input id="'+last_id_content+'" type="text" name="'+last_name+'" value="link" data-type="link" /><input id="'+last_id_image+'" type="text" name="'+last_name_image+'" class="upurl input-upload" data-id="'+last_id_new+'" style="display:none;" data-type="image" /><input style="cursor:pointer;" class="upload_button2" type="button" value="Add/Change Image"/>  <a class="rem_client" title="remove">[ x ]</a> </p>');
		});jQuery('.rem_client').live('click', function() {
		jQuery(this).parent().remove();
	});
	
	jQuery('.testimonials_new_field').click(function(){
		var last_id=jQuery(this).parent().find('.testimonials_fields input[type="text"]').last().attr('data-id');
		var last_name_text=jQuery(this).parent().find('.testimonials_fields textarea[data-type="text"]').last().attr('name');
		var last_name_author=jQuery(this).parent().find('.testimonials_fields input[data-type="author"]').last().attr('name');
		var last_name_position=jQuery(this).parent().find('.testimonials_fields input[data-type="position"]').last().attr('name');
		var last_name_link=jQuery(this).parent().find('.testimonials_fields input[data-type="link"]').last().attr('name');
		var last_id_text=jQuery(this).parent().find('.testimonials_fields textarea[data-type="text"]').last().attr('id');
		var last_id_author=jQuery(this).parent().find('.testimonials_fields input[data-type="author"]').last().attr('id');
		var last_id_position=jQuery(this).parent().find('.testimonials_fields input[data-type="position"]').last().attr('id');
		var last_id_link=jQuery(this).parent().find('.testimonials_fields input[data-type="link"]').last().attr('id');
		var last_id_new=parseInt(last_id)+1;
		jQuery(this).parent().find('.testimonials_fields').append('<p class="ptop">Text<br/><textarea id="'+last_id_text+'" type="text" data-type="text" name="'+last_name_text+'"></textarea><br/>Name<br/><input id="'+last_id_author+'" type="text" data-type="author" name="'+last_name_author+'" /><br/>Position<br/><input id="'+last_id_position+'" type="text" data-type="position" name="'+last_name_position+'" /><br/>Link<br/><input id="'+last_id_link+'" type="text" data-type="link" name="'+last_name_link+'"/> <a class="rem_testimonial" title="remove">[ x ]</a></p>');
	
	});jQuery('.rem_testimonial').live('click', function() {
		jQuery(this).parent().remove();
	});
	
});