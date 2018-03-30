jQuery(function ($) {

	if ($('form#post input[type=file]').length) {
		$('form#post').attr('enctype', 'multipart/form-data');
	}
	function enable_wp_write_panel_submit_button() {
		$('#ajax-loading').css('visibility', 'hidden');
		$('#publish').removeClass('button-primary-disabled');
	}
	$('.clone-ecf').live('click', function () {
	    var src_row = $(this).parents('tr')
	    var new_row = src_row.clone();
	    new_row.find('td:first').html('');
	    new_row.find('td:last').html('');
	    var field = new_row.find('input, textarea, select').eq(0);// .each(function () {
	    var related_fields = $('*[rel=' + field.attr('rel') + ']');
	    var new_id = field.attr('id') + '-' + related_fields.length;
	    field.attr('id', new_id);
	    field.val('');
		new_row.insertAfter(related_fields.eq(related_fields.length - 1).parents('tr:eq(0)'));
		$('p.ecf-description[rel=' + src_row.find('.ecf-description').attr('rel') + ']:not(:last)').hide();
		new_row.find('.ecf-description').show();
		field.focus();
		return false;
	});
	
	$('.delete-ecf').click(function () {
		var container = $(this).parents('tr:eq(0)');
	    var field = container.find('input, textarea, select').not('[name*=original_vals]');
	    field.remove();
	    container.hide();
	    return false;
	});
	
	if ($('img.radio_image').length){
	
		$('.ecf-set-list').each(function(){
		
			var saved = false;
			thisList = $(this);
			
			thisList.find('input[type=radio].ecf-ecf_fieldimageradio').each(function(){
				thisFieldSet = $(this);
			
				if (thisFieldSet.prop('checked')){
					saved = true;
					var thisID = thisFieldSet.attr('value');
					thisFieldSet.parents('.ecf-set-list').find('img.radio_image[rel='+thisID+']').addClass('active');
				}
			});
			
			if (saved == false){
				thisList.find('img.radio_image:first-child').addClass('active');
			}
			
		});
		
		$('img.radio_image').click(function(){
			var thisID = $(this).attr('rel');
			$(this).parent().find('img.radio_image').removeClass('active');
			$(this).addClass('active');
			$(this).parent().find('input[type=radio][value="'+thisID+'"]').prop('checked',true);
		});
	}

	$('.delete-file').click(function() {
		if (!confirm("Are you sure?")) {
			return false;
		}
	});
	
	$('.ecf-set-showall').click(function() {
		$(this).parent().hide().nextAll().show();	
		return false;
	});
	
	$('form#post').submit(function() {
		var required_fields = $('.ecf-field.required');
		for (var i=0; i < required_fields.length; i++) {
			var f = $(required_fields[i]);
			if (f.val()=='') {
				alert('Please enter ' + $('label[for=' + f.attr('id') + ']').html().toLowerCase());
				enable_wp_write_panel_submit_button();
				f.focus();
				return false;
			}
		}
	});
	
	/* Image field */
	setTimeout(function() {
		carbon_init();
	}, 1);

	function carbon_field(node) {
		var field = {};

		if ( node.data('carbon_field') ) {
			node.trigger('reinit_field.carbon');
			$.error('Field already parsed');
		};

		node.data('carbon_field', field);
		field.node = node;
		field.type = node.data('type')

		return field;
	}

	function carbon_init(context) {
		var fields;

		if ( !context ) {
			context = $('body');
		};

		fields = $('.carbon-field:not(.carbon-field-skip)', context);

		fields.each(function() {
			var th = $(this),
				type = th.data('type'),
				field;

			if ( typeof carbon_field[type] == 'undefined' ) {
				return;
			};

			try {
				field = carbon_field(th);
				carbon_field[type](th, field);
			} catch (e) {
				carbon_log_error("Couldn't render a field: " + (e.message || e) );
			}
		});
		
		$('table.layout-table em.help-text').each(function () {
			var fileField = $(this).closest('tr').find('td div.carbon-file');
			
			if (fileField.length) {
				$(this).insertBefore(fileField.find('div.carbon-description')).wrap('<div class="help-text" />');
			}
		});
	}

	carbon_field.File = function(element, field_obj) {
		if (typeof(crb_media_types) == 'undefined') {
			var crb_media_types = {};
		}

		// Runs when the image button is clicked.
		$(element).find('.c2_open_media').click(function (e) {
			e.preventDefault();
			
			var row = $(this).closest('.carbon-field'),
				input_field = row.find('input.carbon-file-field'),
				button_label = $(this).attr('data-window-button-label'),
				window_label = $(this).attr('data-window-label'),
				value_type = $(this).attr('data-value-type'),
				file_type = $(this).attr('data-type'); // audio, video, image
			
			if (typeof(crb_media_types[element.data('type')] == 'undefined')) {
				crb_media_types[element.data('type')] = wp.media.frames.crb_media_field = wp.media({
					title: window_label ? window_label : crbl10n.title,
					library: { type: file_type }, // autio, video, image
					button: { text: button_label },
					multiple: false
				});
				
				var crb_media_field = crb_media_types[element.data('type')];
				
				// Runs when an image is selected.
				crb_media_field.on('select', function () {
					// Grabs the attachment selection and creates a JSON representation of the model.
					var media_attachment = crb_media_field.state().get('selection').first().toJSON();
					//Object:
					// alt, author, caption, dateFormatted, description, editLink, filename, height, icon, id, link, menuOrder, mime, name, status, subtype, title, type, uploadedTo, url, width
					
					// Sends the attachment URL to our custom image input field.
					var media_value = media_attachment[value_type];

					input_field.val(media_value);

					switch (file_type) {
						case 'image':
							// image field type
							row.find('.carbon-view_image').attr( 'src', media_value );
							row.find('.carbon-view_file').attr( 'href', media_value );
							row.find('.carbon-description, img').show();
							break;
						case 'audio':
						case 'video':
						default:
							if (parseInt(media_value)==media_value) {
								// attachment field type
								if (media_attachment.type=='image') {
									row.find('.carbon-view_image').attr( 'src', media_attachment.url );
									row.find('.carbon-description, img').show();
								}else{
									// all other file types
									row.find('.carbon-description, img').hide();
								};
							}else{
								// file field type
							};
							row.find('span.attachment_url').html( media_attachment.url );
							row.find('.carbon-view_file').attr('href', media_attachment.url);
							row.find('.carbon-description').show();
					}
				});
			}
			
			var crb_media_field = crb_media_types[element.data('type')];
			
			// Opens the media library frame
			crb_media_field.open();
		});

		$(element).find('.carbon-file-remove').click(function (e) {
			var fieldContainer = $(this).closest('.carbon-field');
			
			fieldContainer.find('.carbon-description').hide();
			fieldContainer.find('input.carbon-file-field').attr('value', '');
			fieldContainer.find('span.attachment_url').html('');
			fieldContainer.find('img').hide();
		});
	}

	carbon_field.Image = carbon_field.File;
	
});