(function() {
    tinymce.create('tinymce.plugins.icona', {
        init : function(ed, url) {
            ed.addButton('icona', {
                title : 'Insert Icon',
                image : url+'/images/icon.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Icon', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=icona-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('icona', tinymce.plugins.icona);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="icona-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="icona-align">Align</label>\
			    <span>Icon alignment</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="icona-align">\
			<option value="">left</option>\
			<option value="right">Right</option>\
			<option value="center">Center</option>\
		    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="icona-size">Size</label>\
			    <span>Select Icon Size. note custom size not work for Image Icons</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="icona-size">\
			<option value="16">16px</option>\
			<option value="24">24px</option>\
			<option value="32" selected="selected">32px</option>\
			<option value="48">48px</option>\
			<option value="custom">Custom Size</option>\
		    </select>\
    			<div class="mom_color_wrap custom_icon_size hide">\
				<div class="mom_color"><span>Custom Icon Size</span><input type="text" id="icona-custom_size" value="" class="custom_input"></div>\
			</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="icona-iconbg">Icon background</label>\
			    <span>select icon background type circle, square</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		    <select id="icona-iconbg">\
			<option value="">none</option>\
			<option value="square">Square</option>\
			<option value="circle">Circle</option>\
		    </select>\
    			<div class="mom_color_wrap ics_bg hide">\
				<div class="mom_color"><span>Background color</span><input type="text" id="icona-iconbg_color" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Background Hover</span><input type="text" id="icona-iconbg_colorh" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Border color</span><input type="text" id="icona-iconbd_color" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Border Hover</span><input type="text" id="icona-iconbd_colorh" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Border Width</span><input type="text" id="icona-iconbd_width" value="" class="custom_input"></div>\
				<div class="mom_color ics_radius hide"><span>Square Radius</span><input type="text" id="icona-square_radius" value="" class="custom_input"></div>\
				<div class="mom_color"><span>Hover Animation</span><select id="icona-hover_animation">\
					<option value="border_increase">Border Increase</option>\
					<option value="border_decrease">Border Decrease</option>\
					<option value="icon_move">Icon Move</option>\
					<option value="none">None</option>\
				</select></div>\
			</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="icona-type">Icon Type</label>\
			    <span>vector or images or upload your own icon</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="icona-type">\
			<option value="vector">Vector Icon</option>\
			<option value="custom">Custom Icon</option>\
		    </select>\
    			<div class="mom_color_wrap vector_icons">\
				<div class="mom_color"><span>Icon Color</span><input type="text" id="icona-color" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Icon Hover</span><input type="text" id="icona-colorh" class="mom-color-field" value="" /></div>\
			</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		        <div class="mom_tiny_icons_wrap vector_icons"></div>\
		    <div class="mom_custom_media_upload icona_custom_icon hide">\
			<a class="mom_upload_media mom_tiny_button upload_custom_icon" href="#">Upload Custom Icon</a>\
			<img class="mom_custom_icon_prev" src="'+mom_url+'/framework/shortcodes/images/custom_img.png" alt="">\
			<input type="text" id="icona-custom" value="" style="visibility: hidden;" />\
		    </div>\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="icona-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();

		jQuery('.mom-color-field').wpColorPicker();
// media upload
	var file_frame;
	var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
	var set_to_post_id = post_id; // Set this
	$('.icona_custom_icon a.upload_custom_icon').live('click', function( event ){
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
	
	    table.find('#icona-custom').val(attachment.url);
	    $this.next('img').attr({src: attachment.url});
	
	wp.media.model.settings.post.id = wp_media_post_id;
	});
	file_frame.open();
	});
	jQuery('.icona_custom_icon a.upload_custom_icon').on('click', function() {
	wp.media.model.settings.post.id = wp_media_post_id;
	});


		jQuery('#icona-size').change(function() {
   		if (jQuery(this).val() === 'custom') {
		    jQuery('.custom_icon_size').slideDown(250); 
		} else {
		    jQuery('.custom_icon_size').slideUp('fast'); 
		}

		    });
		$('#icona-iconbg').change(function () {
		    if (jQuery(this).val() !== '') {
			$('.ics_bg').slideDown(250);
		    } else {
			$('.ics_bg').slideUp('fast');
		    }
		    if (jQuery(this).val() === 'square') {
			$('.ics_radius').slideDown(250);
		    } else {
			$('.ics_radius').slideUp('fast');
		    }

		});
		
		$('#icona-type').change(function () {
		    if ($(this).val() !== 'vector') {
			$('.vector_icons').slideUp('fast');
		    } else {
			$('.vector_icons').slideDown(250);
		    }
		    if ($(this).val() === 'image') {
			$('.image_icons').slideDown(250);
		    } else {
			$('.image_icons').slideUp('fast');
		    }
		    if ($(this).val() === 'custom') {
			$('.icona_custom_icon').slideDown(250);
		    } else {
			$('.icona_custom_icon').slideUp('fast');
		    }
		});

//icon live search
    $("#icona-form #filter").keyup(function(){

        // Retrieve the input field text and reset the count to zero
        var filter = $(this).val(), count = 0;


        var regex = new RegExp(filter, "i"); // Create a regex variable outside the loop statement

        // Loop through the icons
        $(this).parent().nextAll(".icons_wrap").find(".mom_tiny_icon").each(function(){
            var classname = $('i', this).attr('class');
            // If the list item does not contain the text phrase fade it out
            if (classname.search(regex) < 0) { // use the variable here
                $(this).hide();

            // Show the list item if the phrase matches and increase the count by 1
            } else {
                $(this).fadeIn();
                count++;
            }
        });

    });
		var icons = form.find('.mom_tiny_icons_wrap');
		// handles the click event of the submit button
		form.find('#icona-submit').click(function(){
			//output
                    var align = jQuery('#icona-align').val();
                    var iconbg = jQuery('#icona-iconbg').val();
                    var iconbgcolor = jQuery('#icona-iconbg_color').val();
                    var iconbgcolorh = jQuery('#icona-iconbg_colorh').val();
		    var square_radius = jQuery('#icona-square_radius').val();
		    var iconbdcolor = jQuery('#icona-iconbd_color').val();
		    var iconbdcolorh = jQuery('#icona-iconbd_colorh').val();
		    var icon_bd_width = jQuery('#icona-iconbd_width').val();
		    var icon_hover_animation = jQuery('#icona-hover_animation').val();
                    var type = jQuery('#icona-type').val();
                    var icon = icons.find('input[name="mom_menu_item_icon"]:checked').val();
		    
		    if(type === 'custom') {
			icon = jQuery('#icona-custom').val();
		    }
	    
		    var iconSize = jQuery('#icona-size').val();
		    if (iconSize !== 'custom') {
			var size = 'size="'+iconSize+'" ';
		    } else {
			var size = 'size="'+jQuery('#icona-custom_size').val()+'" ';
		    }
                    if(type === 'vector') {
			var iconColor = jQuery('#icona-color').val();
			var iconColorh = jQuery('#icona-colorh').val();
			if(iconColor !== '') {
			    iconc = 'icon_color="'+iconColor+'" ';
			} else {
			    iconc = '';
			}
		    if(iconColorh !== '') {
			    iconch = 'icon_color_hover="'+iconColorh+'" ';
		    } else {
			    iconch ='';
			}
		    } else {
			    iconc = '';
			    iconch ='';
		    }
		    if(iconbg !== '') {
			iconbg = 'icon_bg="'+iconbg+'" ';
		    } else {
			iconbg = '';
		    }

		    if(iconbgcolor !== '') {
			iconbgcolor = 'icon_bg_color="'+iconbgcolor +'" ';
		    } else {
			iconbgcolor = '';
		    }
		    if(iconbgcolorh !== '') {
			iconbgcolorh = 'icon_bg_hover="'+iconbgcolorh +'" ';
		    } else {
			iconbgcolorh = '';
		    }

		    if( square_radius !== '' ) {
			square_radius = 'square_bg_radius="'+square_radius+'" ';
		    } else {
			square_radius = '';
		    }
		    
		    if (align !== '') {
			ialign = 'align="'+align+'" '
		    } else {
			ialign = '';
		    }

		    if(iconbdcolor !== '') {
			iconbdcolor = 'icon_bd_color="'+iconbdcolor +'" ';
		    } else {
			iconbdcolor = '';
		    }
		    if(iconbdcolorh !== '') {
			iconbdcolorh = 'icon_bd_hover="'+iconbdcolorh +'" ';
		    } else {
			iconbdcolorh = '';
		    }
		    if( icon_bd_width !== '' ) {
			icon_bd_width = 'icon_bd_width="'+icon_bd_width+'" ';
		    } else {
			icon_bd_width = '';
		    }
		    if (icon_hover_animation !== '') {
			icon_hover_animation = 'hover_animation="'+icon_hover_animation+'" ';
		    }
		output = '[icon type="'+type+'" icon="'+icon+'" '+ialign+size+iconc+iconch+iconbg+iconbgcolor+iconbgcolorh+square_radius+iconbdcolor+iconbdcolorh+icon_bd_width+icon_hover_animation+']';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, output);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
