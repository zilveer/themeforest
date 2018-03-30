jQuery(function($) {
	"use strict";
	
	window.om_init_browse_button = function(context) {
	
		jQuery('.input-browse-button', context).click(function(event) {
			event.preventDefault();
	
			var $button=jQuery(this);		 
			var input_id=jQuery(this).attr('rel');
			var custom_file_frame;
	
		  // If the media frame already exists, reopen it.
		  if ( jQuery(this).data('custom_file_frame') ) {
		  	custom_file_frame=jQuery(this).data('custom_file_frame');
		    custom_file_frame.open();
		    return;
		  }
		  
		  jQuery(this).data('custom_file_frame', null);
		  
		  var args={
	        // Set the title of the modal.
	        title: jQuery(this).data("choose"),
	
	        // Customize the submit button.
	        button: {
	            // Set the text of the button.
	            text: jQuery(this).data("select")
	        },
	        multiple: false
	    };
	    if(jQuery(this).data('library')) {
	    	args.library={
	    		type: jQuery(this).data('library')
	    	};
	    }
			custom_file_frame = wp.media.frames.customHeader = wp.media(args);
			jQuery(this).data('custom_file_frame', custom_file_frame);
	
	    custom_file_frame.on( "select", function() {
				var attachment = custom_file_frame.state().get("selection").first();
				jQuery('#'+input_id).val(attachment.attributes.url);
				
				if($button.data('mode') == 'preview') {
					jQuery('#'+$button.data('base-id')+'_image').html('<a href="'+attachment.attributes.url+'" target="_blank"><img src="'+attachment.attributes.url+'" /></a>');
				}
			});
			
			custom_file_frame.open();
			
			return;
		});
		
		jQuery('.input-browse-button-remove', context).click(function(event){
			event.preventDefault();
	
			jQuery('#'+jQuery(this).data('base-id')+'_image').html('');
			jQuery('#'+jQuery(this).data('base-id')+'_input').val('');
			
		});
		
		
		jQuery('.media-add-button', context).click(function(event) {
			event.preventDefault();
	
			var $button=jQuery(this);		 
			var custom_file_frame;
			var post_id=jQuery(this).data('post-id');
	
		  // If the media frame already exists, reopen it.
		  if ( jQuery(this).data('custom_file_frame') ) {
		  	custom_file_frame=jQuery(this).data('custom_file_frame');
		  	custom_file_frame.uploader.uploader.param( 'post_id', post_id );
		    custom_file_frame.open();
		    return;
		  }
		  
		  wp.media.model.settings.post.id = post_id;
		  jQuery(this).data('custom_file_frame', null);
		  
		  var args={
	        // Set the title of the modal.
	        title: jQuery(this).data("choose"),
	
	        // Customize the submit button.
	        button: {
	            // Set the text of the button.
	            text: ''
	        },
	        multiple: false,
	        library: {
	        	type: 'image'
	        }
	    };
	
			var old_contentUserSetting = wp.media.controller.Library.prototype.defaults.contentUserSetting;
			wp.media.controller.Library.prototype.defaults.contentUserSetting = false;
	
			custom_file_frame = wp.media.frames.customHeader = wp.media(args);
			jQuery(this).data('custom_file_frame', custom_file_frame);
	
	    custom_file_frame.on( "select", function() {
				return false;
			});
			
			custom_file_frame.open();
			
			wp.media.controller.Library.prototype.defaults.contentUserSetting = old_contentUserSetting;
			
			return;
		});
		
		jQuery('.media-manage-attached-button', context).click(function(event) {
			event.preventDefault();
	
			var $button=jQuery(this);		 
			var custom_file_frame;
			var post_id=jQuery(this).data('post-id');
	
		  // If the media frame already exists, reopen it.
		  if ( jQuery(this).data('custom_file_frame') ) {
		  	custom_file_frame=jQuery(this).data('custom_file_frame');
		  	custom_file_frame.uploader.uploader.param( 'post_id', post_id );
		    custom_file_frame.open();
		    return;
		  }
		  
		  wp.media.model.settings.post.id = post_id;
		  jQuery(this).data('custom_file_frame', null);
		  
		  var args={
	        // Set the title of the modal.
	        title: jQuery(this).data("choose"),
	
	        // Customize the submit button.
	        button: {
	            // Set the text of the button.
	            text: ''
	        },
	        multiple: false,
	        library: {
	        	type: 'image',
	        	uploadedTo: post_id,
	        	orderby: 'menuOrder',
	        	order: 'ASC'
	        }
	    };
	
			custom_file_frame = wp.media.frames.customHeader = wp.media(args);
			jQuery(this).data('custom_file_frame', custom_file_frame);
	
	    custom_file_frame.on( "select", function() {
				return false;
			});
			
			custom_file_frame.open();
			
			return;
		});
		
	}
	
	om_init_browse_button();
	
});