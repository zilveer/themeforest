jQuery(document).ready(function() {
	jQuery(document).on('click', '.upload_button', function(event) {

		var $clicked = jQuery(this), frame,
			input_id = $clicked.parent("div").find('.input-upload').attr('id'),
			media_type = $clicked.attr('rel');

		event.preventDefault();
		if ( frame ) {
			frame.open();
			return;
		}
		frame = wp.media.frames.aq_media_uploader = wp.media({
			library: {
				type: media_type
			},
			view: {
			}
		});
		
		frame.on( 'select', function() {
			var attachment = frame.state().get('selection').first();
			jQuery('#'+input_id).val(attachment.attributes.url);
			if(media_type == 'image') {
			$clicked.parent().parent().find('img').attr('src', attachment.attributes.url);
			}
		});
		frame.open();
	});
	
	/* another!! */
	
	jQuery(document).on('click', '.upload_button2', function(event) {
		var $clicked = jQuery(this), frame,
		input_id = $clicked.parent("div").find('.input-upload').attr('id'),

		media_type = $clicked.attr('rel');
       // alert(input_id);
        console.log('#'+input_id);
	event.preventDefault();
	if ( frame ) {
		frame.open();
		return;
	}
	frame = wp.media.frames.aq_media_uploader = wp.media({
		library: {
			type: media_type
		},
		view: {
			
		}
	});
	
	frame.on( 'select', function() {
		var attachment = frame.state().get('selection').first();
        console.log('#'+input_id);
		jQuery('#'+input_id).val(attachment.attributes.url);
		if(media_type == 'image') {
		$clicked.parent().parent().find('img').attr('src', attachment.attributes.url);
		}
		
	});
	frame.open();
});
	
	/* another!! */
	
	jQuery(document).on('click', '.upload_button3', function(event) {
		var $clicked = jQuery(this), frame,
		media_type = $clicked.attr('rel');
	event.preventDefault();
	if ( frame ) {
		frame.open();
		return;
	}
	frame = wp.media.frames.aq_media_uploader = wp.media({
		library: {
			type: media_type
		},
		view: {
		}
	});
	frame.open();
});

	/* another!! */
	
	jQuery(document).on('click', '.upload_button4', function(event) {
		var $clicked = jQuery(this), frame,
		input_id = $clicked.parent().find('.input-upload').attr('id'),
		media_type = $clicked.attr('rel');
		var upload_button=jQuery(this);
	event.preventDefault();
	if ( frame ) {
		frame.open();
		return;
	}
	frame = wp.media.frames.aq_media_uploader = wp.media({
		library: {
			type: media_type
		},
		view: {
		}
	});
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
	
	

	/* and some other!! */


	jQuery('.clients_new_field').click(function(){ 
		var last_id=jQuery(this).parent().find('.clients_fields input[type="text"]').last().attr('data-id');
		var last_name=jQuery(this).parent().find('.clients_fields input[data-type="link"]').last().attr('name');
		var last_name_image=jQuery(this).parent().find('.clients_fields input[data-type="image"]').last().attr('name');
		var last_id_content=jQuery(this).parent().find('.clients_fields input[data-type="link"]').last().attr('id');
		var last_id_image=jQuery(this).parent().find('.clients_fields input[data-type="image"]').last().attr('id');
		var last_id_new=parseInt(last_id)+1;
		jQuery(this).parent().find('.clients_fields').append('<p><input id="'+last_id_content+'" type="text" name="'+last_name+'" value="link" data-type="link" /><input id="'+last_id_image+'" type="text" name="'+last_name_image+'" class="upurl input-upload" data-id="'+last_id_new+'" style="display:none;" data-type="image" /><input style="cursor:pointer;" class="upload_button4" type="button" value="Add/Change Image"/>  <a class="rem_client" title="remove">[ x ]</a> </p>');
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
		
	jQuery('.gall_new_field').click(function(){  
		var last_id=jQuery(this).parent().find('.gall_fields input[type="text"]').last().attr('data-id');
		var last_name_image=jQuery(this).parent().find('.gall_fields input[data-type="image"]').last().attr('name');
		var last_id_image=jQuery(this).parent().find('.gall_fields input[data-type="image"]').last().attr('id');
		var last_id_new=parseInt(last_id)+1;
		jQuery(this).parent().find('.gall_fields').append('<p>Image URL:<br/><input id="'+last_id_image+'" type="text" name="'+last_name_image+'" class="upurl input-upload" data-id="'+last_id_new+'" data-type="image" /><input style="cursor:pointer;" class="upload_button4" type="button" value="Add/Change Image"/>  <a class="rem_gall" title="remove">[ x ]</a> </p>');
		});jQuery('.rem_gall').live('click', function() {
		jQuery(this).parent().remove();
	});

	

});