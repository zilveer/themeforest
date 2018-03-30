/**
 * Main jQuery media file for the plugin.
 *
 * @since 1.0.0
 *
 * @package CS Media Plugin
 * @author  Fox
 */
jQuery(document).ready(function($){
	"use strict";
	// Item
	var item;
    // Prepare the variable that holds our custom media manager.
    var tgm_media_frame;
    // new frame;
    tgm_media_frame = wp.media.frames.tgm_media_frame = wp.media({
        className: 'media-frame tgm-media-frame',
        frame: 'select',
        multiple: false,
        title: 'Select Background Image',
        library: {
            type: 'image'
        },
        button: {
            text:  'SELECT'
        }
    });
    // Bind to our click event in order to open up the new media experience.
	$(document.body).on('click', '.images-field ul li i.add', function(e){
		"use strict";
		item = $(this);
		tgm_media_frame.open();
		return;
    });
	//Edit
	$(document.body).on('click', '.images-field ul li i.edit', function(e){
		"use strict";
		item = $(this);
		tgm_media_frame.open();
		return;
    });
	// Remove
	$(document.body).on('click', '.images-field ul li i.remove', function(e){
		"use strict";
		var li = $(this).parent();
		var ul = li.parent();
		li.remove();
		//ul.append('<li class"items" data-id=""><i class="add dashicons dashicons-plus-alt"></i>')
		renderValues(ul);
		return;
    });

    tgm_media_frame.on('select', function(){
    	"use strict";
        // Grab our attachment selection and construct a JSON representation of the model.
        var media_attachment = tgm_media_frame.state().get('selection').first().toJSON();
        // Send the attachment URL to our custom input field via jQuery.
        if(media_attachment.id != undefined){
        	var li = item.parent();
        	li.attr('data-id', media_attachment.id);
        	li.attr('style', 'background-image:url('+media_attachment.url+');background-size: cover;');

        	var ul = li.parent('ul');
        	if(ul.attr('data-type') != 'single' && !li.find('i').hasClass('edit')){
	        	ul.append('\n<li data-id=""><i class="edit dashicons dashicons-plus-alt"></i></li>');
        	}
        	if(!li.find('i').hasClass('remove')){
    			li.append('<i class="remove dashicons dashicons-dismiss"></i>');
    		}
        	renderValues(ul);
        } else {

        }
    });
    function renderValues(ul) {
    	"use strict";
    	var values = [];
    	var i = 0;
    	ul.find('li').each(function(){
    		"use strict";
    		if($(this).attr('data-id') != ''){
    			values[i] = $(this).attr('data-id');
    		}
    		i++;
    	});
    	ul.parent().find('input').val(values.join(','));
	}
});