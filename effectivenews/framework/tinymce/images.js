(function() {
    tinymce.create('tinymce.plugins.images', {
        init : function(ed, url) {
            ed.addButton('images', {
                title : 'Add a images grid',
                image : url+'/images/images.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Images grid', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=images-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('images', tinymce.plugins.images);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="images-form">\
		 		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="images-type">Type</label>\
			    <span>grid or caruosel</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="images-type">\
					<option value="">Grid</option>\
					<option value="carousel">Carousel</option>\
				    </select>\
				<div class="mom_color_wrap itc_item hide">\
				<div class="mom_color"><label for="images-auto_slide">Auto Slide</label><input id="images-auto_slide" type="checkbox"></div>\
				<div class="mom_color"><span>Auto Slide Duration</span><input id="images-auto_duration" value="" type="text" class="custom_input" /> ms</div>\
				</div>\
			    </div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="images-cols">Columns</label>\
			    <span>grid or caruosel</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="images-cols">\
					<option value="three">Three Columns</option>\
					<option value="four">Four Columns</option>\
					<option value="five" selected="selected">Five Columns</option>\
					<option value="six">Six Columns</option>\
				    </select>\
			    </div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="images-lightbox">Enable lightbox</label>\
			    <span>if you enable this the image link must be the big image url if you leave link empty the lightbox open the same image</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="ch_switch"><input type="checkbox" id="images-lightbox" value=""><label><i></i></label></div>\
			    </div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div style="margin-bottom:20px;"></div>\
		    <div class="mom_custom_media_upload no_border" style="padding-top:0;">\
			<a class="mom_upload_media mom_tiny_button upload_grid_images"  style="margin-bottom:30px;" href="#">Upload Images</a>\
			<div class="mom_images_grid_container"></div>\
		    </div>\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="images-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');

		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('#images-type').change( function() {
		    if($(this).val() === 'carousel') {
			$('.itc_item').slideDown();
		    } else {
			$('.itc_item').slideUp();
		    }
		});
//upload images
	var file_frame;
	var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
	var set_to_post_id = post_id; // Set this
	$('.upload_grid_images').live('click', function( event ){
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
	multiple: true
	});
	 
	file_frame.on( 'select', function() {
	     var selection = file_frame.state().get('selection');
 
	    selection.map( function( attachment ) {
	    attachment = attachment.toJSON();
	    var img_thumb = '';
	    if (attachment.sizes['thumbnail'] !== undefined) {
		img_thumb = attachment.sizes['thumbnail']['url'];
	    } else {
		img_thumb = attachment.url;
	    }
	    	table.find('.mom_images_grid_container').append('<div class="mg_image"><img src="'+img_thumb+'" alt="" /><input class="image_url" value="'+attachment.id+'" type="hidden"><input class="image_link"><i class="link_icon momizat-icon-link"></i><i class="image_remove fa-icon-remove"></i></div>');
	    });
	
	wp.media.model.settings.post.id = wp_media_post_id;
	});
	file_frame.open();
	});
	jQuery('.upload_grid_images').on('click', function() {
	wp.media.model.settings.post.id = wp_media_post_id;
	});
// edit images
                jQuery('.link_icon').live('click', function() {
                        jQuery(this).parent().find('.image_link').fadeToggle();
                });

                jQuery('.image_remove').live('click', function() {
                        jQuery(this).parent().slideUp(300, function() {jQuery(this).remove();});
                    return false;
                });

jQuery('.mom_images_grid_container').sortable()
		// handles the click event of the submit button
		form.find('#images-submit').click(function(){
			//output
		      	var options = {
				'type':'',
				'cols': '',
				'auto_duration':''
			};
			if($('#images-auto_slide').is(':checked')) {
			    auto_slide = ' auto_slide="true"';

			} else {
			    auto_slide = '';   
			}
		    
			if($('#images-lightbox').is(':checked')) {
			    lightbox = ' lightbox="true"';

			} else {
			    lightbox = '';   
			}
			
			output = ' [images';
		    	for( var index in options) {
				var value = table.find('#images-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					output += ' ' + index + '="' + value + '"';
			}
			output += auto_slide+lightbox+']<br>'
		
                jQuery('.mom_images_grid_container .mg_image').each(function(index) {
                    var link = jQuery(this).find('.image_link').val();
                    var image = jQuery(this).find('.image_url').val();
		if($('#images-lightbox').is(':checked')) {
		    if (link === '') {
			link = image;
		    }
		} else {
		    if (link === '') {
			link = '#';
		    }
		}
                    output += ' [image link="'+link+'" image="'+image+'"]<br>';
                });
                output += ' [/images] ';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, output);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();