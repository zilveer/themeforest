(function($){

	'use strict';
	
	var flowuploader = {
		inituploader: function(sel){
			jQuery(sel).each(function(){
				jQuery(this).click(function(){
					var FU_w = jQuery(this).parent(); // this uploader instance full container (wrapper of everything)
					
					// wp.media.send.to.editor will automatically trigger window.send_to_editor for backwards compatibility
					// and therefore call tb_remove() which is not what we want in this case
					
					// backup original window.send_to_editor
					window.original_send_to_editor = window.send_to_editor;

					// override window.send_to_editor
					window.send_to_editor = function(html) {
						// html argument might not be useful in this case
						// use the data from var attachment (attachment) here to make your own ajax call or use data from b and send it back to your defined input fields etc.
						// restore original window.send_to_editor
						window.send_to_editor = window.original_send_to_editor;
					}
					
					// backup of original send function
					var send_attachment_backup = wp.media.editor.send.attachment;
					
					// temporary send function
					wp.media.editor.send.attachment = function(props, attachment){
				
						var chosenSize = props.size; // full, large, medium, thumbnail
						
						// Empty current input data
						FU_w.find('.flowuploader_media_preview_image').empty();
						FU_w.find('.flowuploader_remove').remove();

						if(attachment.type == 'image'){
							if('sizes' in attachment){
								var preview_image = jQuery('<img />').attr('src', attachment.sizes[chosenSize].url).attr('alt', attachment.alt);
							}else{
								var preview_image = jQuery('<img />').attr('src', attachment.url).attr('alt', attachment.alt);
							}
							
							// Add preview image
							FU_w.find('.flowuploader_media_preview_image').empty().append(preview_image);
							FU_w.find('.flowuploader_media_preview_image').before('<a href="#" class="flowuploader_remove">Remove</a>');
						}
						
						// Add attachment URL to input
						if('sizes' in attachment){
							FU_w.find('.flowuploader_media_url').val(attachment.sizes[chosenSize].url);
						}else{
							FU_w.find('.flowuploader_media_url').val(attachment.url);
						}
						FU_w.find('.flowuploader_media_url').trigger('change');
						
						// restore original send function
						wp.media.editor.send.attachment = send_attachment_backup;
					}
					wp.media.editor.open();
					
					// Init blur function
					var el = jQuery(this).parent().find('.flowuploader_media_url');
					if(el.length){
						flowuploader.reloadimgonblur(el);
						//el.blur();
						el.trigger('input');
					}
					
					return false;
				});
			});
		},
		/* inituploader: function(sel){
			$(sel).each(function(){
				$(this).on('click', function(){
					var FU_w = $(this).parent(); // this uploader instance's full container (wrapper of everything)
					
					var file_frame = wp.media( {
						title: 'Select an Image',
						//button: {
						//	text: 'Select'
						//},
						multiple: false,
						library: {
							type: 'image'
						}
					} );
					
					file_frame.state( 'library' ).on( 'select', function() {
						// Get the selected attachment. Since we have disabled multiple selection
						// we want the first one of the collection.
						var attachment = this.get( 'selection' ).first();
						
						console.log(attachment);
						
						var preview_image = $('<img />').attr('src', attachment.attributes.url).attr('alt', attachment.attributes.alt);
						console.log(preview_image);
						FU_w.find('.flowuploader_media_preview_image').empty().append(preview_image).append('<span class="flowuploader_remove">remove</span>');
						console.log(FU_w);

						// Call the function which will output the attachment details
						//media.handleMediaAttachment( attachment );
					} );
					
					file_frame.open();

 					// backup of original send function
					var send_attachment_backup = wp.media.editor.send.attachment;
					
					// temporary send function
					wp.media.editor.send.attachment = function(props, attachment){
				
						var chosenSize = props.size; // full, large, medium, thumbnail
						// Empty current input data
						FU_w.find('.flowuploader_media_preview_image').empty();

						if(attachment.type == 'image'){
							if('sizes' in attachment){
								var preview_image = $('<img />').attr('src', attachment.sizes[chosenSize].url).attr('alt', attachment.alt);
							}else{
								var preview_image = $('<img />').attr('src', attachment.url).attr('alt', attachment.alt);
							}
							
							// Add preview image
							FU_w.find('.flowuploader_media_preview_image').empty().append(preview_image).append('<span class="flowuploader_remove">remove</span>');
						}
						
						// Add attachment URL to input
						if('sizes' in attachment){
							FU_w.find('.flowuploader_media_url').val(attachment.sizes[chosenSize].url);
						}else{
							FU_w.find('.flowuploader_media_url').val(attachment.url);
						}
						FU_w.find('.flowuploader_media_url').trigger('change');
						
						// Init remove function
						//flowuploader.removeonclick(FU_w.find('.flowuploader_media_preview_image').find('.flowuploader_remove'));
						
						// restore original send function
						wp.media.editor.send.attachment = send_attachment_backup;
					}
					wp.media.editor.open();
					
					// Init blur function
					var el = $(this).parent().find('.flowuploader_media_url');
					if(el.length){
						flowuploader.reloadimgonblur(el);
						el.blur();
					}
					
					return false;
				});
			});
		}, */
		reloadimgonblur: function(el){
			//$(el).on('blur', function(){
			$(el).on('input', function(){
				var el_val = $(this).val();
				
				if(!el_val){
					return;
				}
				
				var preview_container = $(this).parent().find('.flowuploader_media_preview_image');
				
				if(el_val.match(/(^.*\.jpg|jpeg|png|gif|ico|svg|svgz*)/gi)){
					preview_container.find('.flowuploader_remove').remove();
					preview_container.html('<div class="empty-canvas visible"><p>Image will appear here if its URL above is valid.</p></div>');
					$('<img />').attr('src', el_val).load(function(){
						preview_container.html('<img src="'+el_val+'" alt="" />');
						preview_container.before('<a href="#" class="flowuploader_remove">Remove</a>');
					});							
					flowuploader.removeonclick(preview_container.find('.flowuploader_remove'));
				}else{
					preview_container.html('');
				}
			});
		},
		removeonclick: function(el){
			$(el).click(function(){
			
				// Remove URL from input
				var FU_f = $(this).parent().parent().find('.flowuploader_media_url');
				if(FU_f.length){
					FU_f.val('');
				}
				
				// Remove preview image
				var FU_p = $(this).parent().parent().find('.flowuploader_media_preview_image');
				if(FU_p.length){
					FU_p.html('');
				}
				
				// Remove remove button
				if($(this).length){
					$(this).remove();
				}
				
			});
		},
		remove: function(el){
			el.each(function(){
			
				// Remove URL from input
				var FU_f = $(this).parent().parent().find('.flowuploader_media_url');
				if(FU_f.length){
					FU_f.val('');
				}
				
				// Remove preview image
				var FU_p = $(this).parent().parent().find('.flowuploader_media_preview_image');
				if(FU_p.length){
					FU_p.html('');
				}
				
				// Remove remove button
				if($(this).length){
					$(this).remove();
				}
			});
		}
	};

	$(document).ready(function(){
	
		// Init blur function
		var el = $('.flowuploader_media_url');
		if(el.length){
			flowuploader.reloadimgonblur(el);
			//el.blur();
			el.trigger('input');
		}
		
		// Init remove function
		$(document).on('click', '.flowuploader_remove', function(){
			flowuploader.remove($(this));
		});
		
		// Init uploader
		flowuploader.inituploader('.flowuploader_upload_button');
	});

}(jQuery));
