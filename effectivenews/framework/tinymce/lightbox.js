(function() {
    tinymce.create('tinymce.plugins.lightbox', {
        init : function(ed, url) {
            ed.addButton('lightbox', {
                title : 'Add a lightbox',
                image : url+'/images/lightbox.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'lightbox Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=lightbox-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('lightbox', tinymce.plugins.lightbox);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="lightbox-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_custom_media_upload lightbox_thumbnail">\
			<a class="mom_upload_media mom_tiny_button upload_custom_icon" href="#">Lightbox Thumbnail</a>\
			<img class="mom_custom_icon_prev" src="'+mom_url+'/framework/shortcodes/images/custom_img.png" alt="">\
			<input type="text" id="lightbox-thumb" value="" style="visibility: hidden;" />\
		    </div>\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="lightbox-type">Type</label>\
			    <span>image or video</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<select name="type" id="lightbox-type">\
				<option value="">image</option>\
				<option value="video">Video</option>\
			</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="lightbox-link">Link</label>\
			    <span>it can be image link or video link (youtube&vimeo only), if leave empty it will be the thumbnail image link.</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<input id="lightbox-link" value="" type="text" class="text">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    </div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="lightbox-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
	
		jQuery('.mom-color-field').wpColorPicker();

// media upload
	var file_frame;
	var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
	var set_to_post_id = post_id; // Set this
	$('.lightbox_thumbnail a.upload_custom_icon').live('click', function( event ){
	    var $this = $(this);
	event.preventDefault();
	if ( file_frame ) {
	file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
	file_frame.open();
	return;
	} else {
	wp.media.model.settings.post.id = set_to_post_id;
	}
	file_frame = wp.media.frames.file_frame = wp.media({
	title: jQuery( this ).data( 'uploader_title' ),
	button: {
	text: jQuery( this ).data( 'uploader_button_text' ),
	},
	multiple: false
	});
	 
	file_frame.on( 'select', function() {
	attachment = file_frame.state().get('selection').first().toJSON();
	
	    table.find('#lightbox-thumb').val(attachment.url);
	    $this.next('img').attr({src: attachment.url});
	
	wp.media.model.settings.post.id = wp_media_post_id;
	});
	file_frame.open();
	});
	jQuery('.lightbox_thumbnail a.upload_custom_icon').on('click', function() {
	wp.media.model.settings.post.id = wp_media_post_id;
	});
		// handles the click event of the submit button
		form.find('#lightbox-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = {
				'thumb':'',
				'type':'',
				'link':'',
		};
			var shortcode = '[lightbox';
			
			for( var index in options) {
				var value = table.find('#lightbox-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
