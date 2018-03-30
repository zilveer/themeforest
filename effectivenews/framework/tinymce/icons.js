(function() {
    tinymce.create('tinymce.plugins.icons', {
        init : function(ed, url) {
            ed.addButton('icons', {
                title : 'Insert Iconbox',
                image : url+'/images/iconbox.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Iconbox', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=icon-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('icons', tinymce.plugins.icons);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="icon-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="icon-title">Title</label>\
			    <span>box title</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<input type="text" id="icon-title">\
    			<div class="mom_color_wrap">\
				<div class="mom_color"><span>Title Align</span><select id="icon-title_align">\
			<option value="left">Left</option>\
			<option value="center">Center</option>\
			<option value="right">Right</option>\
		    </select></div>\
		<div class="mom_color"><span>Title color</span><input type="text" id="icon-title_color" class="mom-color-field" value="" /></div>\
		<div class="mom_color"><span>Title Link</span><input type="text" id="icon-title_link" class="custom_input_big" value="" /></div>\
			</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="icon-content">Content</label>\
			    <span>Arbitrary text or HTML, Shortcodes.</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<textarea id="icon-content" rows="4"></textarea>\
    			<div class="mom_color_wrap">\
				<div class="mom_color"><span>Content Align</span><select id="icon-content_align">\
			<option value="left">Left</option>\
			<option value="center">Center</option>\
			<option value="right">Right</option>\
		    </select></div>\
		<div class="mom_color"><span>Content color</span><input type="text" id="icon-content_color" class="mom-color-field" value="" /></div>\
			</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="icon-content">Layout</label>\
			    <span>plain or boxed</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
<label class="mom_icon_layout mom_radio_img"><input type="radio" checked="checked" name="icon-layout" value="plain"><img src="'+mom_url+'/framework/shortcodes/images/plainbox.png"><i></i></label>\
		    <label class="mom_icon_layout mom_radio_img"><input type="radio" name="icon-layout" value="boxed"><img src="'+mom_url+'/framework/shortcodes/images/boxed.png"><i></i></label>\
    			<div class="mom_color_wrap iconbox_colors hide">\
				<div class="mom_color"><span>Background color</span><input type="text" id="icon-bg" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Border color</span><input type="text" id="icon-border" class="mom-color-field" value="" /></div>\
			</div>\
		    </div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="icon-align">Icon Alignment</label>\
			    <span>select icon position</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		    <label class="mom_icon_align mom_radio_img"><input type="radio" checked="checked" name="icon-align" value="left"><img src="'+mom_url+'/framework/shortcodes/images/iconleft.png"><i></i></label>\
		    <label class="mom_icon_align mom_radio_img"><input type="radio" name="icon-align" value="center"><img src="'+mom_url+'/framework/shortcodes/images/iconcenter.png"><i></i></label>\
		    <label class="mom_icon_align mom_radio_img"><input type="radio" name="icon-align" value="right"><img src="'+mom_url+'/framework/shortcodes/images/iconright.png"><i></i></label>\
		    <label class="mom_icon_align mom_radio_img"><input type="radio" name="icon-align" value="middle_left"><img src="'+mom_url+'/framework/shortcodes/images/iconmleft.png"><i></i></label>\
		    <label class="mom_icon_align mom_radio_img"><input type="radio" name="icon-align" value="middle_right"><img src="'+mom_url+'/framework/shortcodes/images/iconmright.png"><i></i></label>\
		    </div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="icon-align">Icon Align to</label>\
			    <span>box or title</span>\
			</div>\
			</div>\
		<div class="mom_tiny_input">\
		    <select id="icon-icon_align_to">\
			<option value="box">Box</option>\
			<option value="title">Title</option>\
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
			    <select id="icon-size">\
			<option value="16">16px</option>\
			<option value="24">24px</option>\
			<option value="32" selected="selected">32px</option>\
			<option value="48">48px</option>\
			<option value="custom">Custom Size</option>\
		    </select>\
    			<div class="mom_color_wrap iconbox_custom_icon_size hide">\
				<div class="mom_color"><span>Custom Icon Size</span><input type="text" id="icon-custom_size" value="" class="custom_input"></div>\
			</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="icon-iconbg">Icon background</label>\
			    <span>select icon background type circle, square</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		    <select id="icon-iconbg">\
			<option value="">none</option>\
			<option value="square">Square</option>\
			<option value="circle">Circle</option>\
		    </select>\
    			<div class="mom_color_wrap icb_bg hide">\
				<div class="mom_color"><span>Background color</span><input type="text" id="icon-iconbg_color" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Background Hover</span><input type="text" id="icon-iconbg_colorh" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Border color</span><input type="text" id="icon-iconbd_color" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Border Hover</span><input type="text" id="icon-iconbd_colorh" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Border Width</span><input type="text" id="icon-iconbd_width" value="" class="custom_input"></div>\
				<div class="mom_color icb_radius hide"><span>Square Radius</span><input type="text" id="icon-square_radius" value="" class="custom_input"></div>\
				<div class="mom_color"><span>Hover Animation</span><select id="icon-hover_animation">\
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
			    <label for="icon-icon_link">Icon Link</label>\
			    <span>icon link if needed</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<input type="text" id="icon-icon_link">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="icon-animation">Icon Animatin</label>\
			    <span>tons of animations</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<select id="icon-icon_animation">\
			      <option value="">None</option>\
			    <optgroup label="Attention Seekers">\
			      <option value="bounce">bounce</option>\
			      <option value="flash">flash</option>\
			      <option value="pulse">pulse</option>\
			      <option value="rubberBand">rubberBand</option>\
			      <option value="shake">shake</option>\
			      <option value="swing">swing</option>\
			      <option value="tada">tada</option>\
			      <option value="wobble">wobble</option>\
			    </optgroup>\
			    <optgroup label="Bouncing Entrances">\
			      <option value="bounceIn">bounceIn</option>\
			      <option value="bounceInDown">bounceInDown</option>\
			      <option value="bounceInLeft">bounceInLeft</option>\
			      <option value="bounceInRight">bounceInRight</option>\
			      <option value="bounceInUp">bounceInUp</option>\
			    </optgroup>\
			    <optgroup label="Fading Entrances">\
			      <option value="fadeIn">fadeIn</option>\
			      <option value="fadeInDown">fadeInDown</option>\
			      <option value="fadeInDownBig">fadeInDownBig</option>\
			      <option value="fadeInLeft">fadeInLeft</option>\
			      <option value="fadeInLeftBig">fadeInLeftBig</option>\
			      <option value="fadeInRight">fadeInRight</option>\
			      <option value="fadeInRightBig">fadeInRightBig</option>\
			      <option value="fadeInUp">fadeInUp</option>\
			      <option value="fadeInUpBig">fadeInUpBig</option>\
			    </optgroup>\
			    <optgroup label="Flippers">\
			      <option value="flip">flip</option>\
			      <option value="flipInX">flipInX</option>\
			      <option value="flipInY">flipInY</option>\
			    </optgroup>\
			    <optgroup label="Lightspeed">\
			      <option value="lightSpeedIn">lightSpeedIn</option>\
			    </optgroup>\
			    <optgroup label="Rotating Entrances">\
			      <option value="rotateIn">rotateIn</option>\
			      <option value="rotateInDownLeft">rotateInDownLeft</option>\
			      <option value="rotateInDownRight">rotateInDownRight</option>\
			      <option value="rotateInUpLeft">rotateInUpLeft</option>\
			      <option value="rotateInUpRight">rotateInUpRight</option>\
			    </optgroup>\
			    <optgroup label="Sliders">\
			      <option value="slideInDown">slideInDown</option>\
			      <option value="slideInLeft">slideInLeft</option>\
			      <option value="slideInRight">slideInRight</option>\
			    </optgroup>\
			    <optgroup label="Specials">\
			      <option value="hinge">hinge</option>\
			      <option value="rollIn">rollIn</option>\
			    </optgroup>\
			  </select>\
			  <div class="mom_color_wrap icb_ani hide">\
<div class="mom_color"><span>Duration</span><input type="text" id="icon-icon_animation_duration" class="custom_input" /></div>\
<div class="mom_color"><span>Delay</span><input type="text" id="icon-icon_animation_delay" class="custom_input" /></div>\
<div class="mom_color"><span>Iteration</span><input type="text" id="icon-icon_animation_iteration" class="custom_input" /></div>\
			</div>\
					</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="icon-type">Icon Type</label>\
			    <span>vector or upload your own icon</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="icon-type">\
			<option value="vector">Vector Icon</option>\
			<option value="custom">Custom Icon</option>\
		    </select>\
    			<div class="mom_color_wrap iconbox_vector_icons">\
				<div class="mom_color"><span>Icon Color</span><input type="text" id="icon-color" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Icon Hover</span><input type="text" id="icon-colorh" class="mom-color-field" value="" /></div>\
			</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_icons_wrap iconbox_vector_icons"></div>\
		    <div class="mom_custom_media_upload iconbox_custom_icon hide">\
			<a class="mom_upload_media mom_tiny_button upload_custom_icon" href="#">Upload Custom Icon</a>\
			<img class="mom_custom_icon_prev" src="'+mom_url+'/framework/shortcodes/images/custom_img.png" alt="">\
			<input type="text" id="icon-custom" value="" style="visibility: hidden;" />\
		    </div>\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="icon-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();

		jQuery('.mom-color-field').wpColorPicker();

// media upload
	var file_frame;
	var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
	var set_to_post_id = post_id; // Set this
	$('.iconbox_custom_icon a.upload_custom_icon').live('click', function( event ){
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
	
	    table.find('#icon-custom').val(attachment.url);
	    $this.next('img').attr({src: attachment.url});
	
	wp.media.model.settings.post.id = wp_media_post_id;
	});
	file_frame.open();
	});
	jQuery('.iconbox_custom_icon a.upload_custom_icon').on('click', function() {
	wp.media.model.settings.post.id = wp_media_post_id;
	});

		jQuery('#icon-size').change(function() {
   		if (jQuery(this).val() === 'custom') {
		    jQuery('.iconbox_custom_icon_size').slideDown(250); 
		} else {
		    jQuery('.iconbox_custom_icon_size').slideUp('fast'); 
		}

		    });
		$('#icon-iconbg').change(function () {
		    if (jQuery(this).val() !== '') {
			$('.icb_bg').slideDown(250);
		    } else {
			$('.icb_bg').slideUp('fast');
		    }
		    if (jQuery(this).val() === 'square') {
			$('.icb_radius').slideDown(250);
		    } else {
			$('.icb_radius').slideUp('fast');
		    }

		});
		$('#icon-icon_animation').change(function () {
		    if (jQuery(this).val() !== '') {
			$('.icb_ani').slideDown(250);
		    } else {
			$('.icb_ani').slideUp('fast');
		    }
		    
		});
		$('#icon-type').change(function () {
		    if ($(this).val() !== 'vector') {
			$('.iconbox_vector_icons').slideUp('fast');
		    } else {
			$('.iconbox_vector_icons').slideDown(250);
		    }
		    if ($(this).val() === 'image') {
			$('.iconbox_image_icons').slideDown(250);
		    } else {
			$('.iconbox_image_icons').slideUp('fast');
		    }
		    if ($(this).val() === 'custom') {
			$('.iconbox_custom_icon').slideDown(250);
		    } else {
			$('.iconbox_custom_icon').slideUp('fast');
		    }
		});

		$('label.mom_img_icon').click(function() {
			if(!$(this).hasClass('slected_icon')) {
			    $('label.mom_img_icon').removeClass('slected_icon');
			    $(this).addClass('slected_icon');
			}
		    });
		$('input[name="icon-layout"]').click( function() {
		    if ($(this).val() === 'boxed') {
			$('.iconbox_colors').show();
		    } else {
			$('.iconbox_colors').hide();
		    }
		});

		var icons = form.find('.mom_tiny_icons_wrap');
		// handles the click event of the submit button
		form.find('#icon-submit').click(function(){
			//output
                    //var column = jQuery('#icon-column').val();
                    var title = jQuery('#icon-title').val();
                    var title_link = jQuery('#icon-title_link').val();
		    var titleAlign = jQuery('#icon-title_align').val(); 
		    var contentAlign = jQuery('#icon-content_align').val(); 
                    var icontent = jQuery('#icon-content').val();
                    var layout = jQuery('input[name="icon-layout"]:checked').val();
                    var bg = jQuery('#icon-bg').val();
                    var border = jQuery('#icon-border').val();
                    var titleColor = jQuery('#icon-title_color').val();
                    var contentColor = jQuery('#icon-content_color').val();
                    var iconbg = jQuery('#icon-iconbg').val();
                    var iconbgcolor = jQuery('#icon-iconbg_color').val();
                    var iconbgcolorh = jQuery('#icon-iconbg_colorh').val();
		    var square_radius = jQuery('#icon-square_radius').val();
		    var iconbdcolor = jQuery('#icon-iconbd_color').val();
		    var iconbdcolorh = jQuery('#icon-iconbd_colorh').val();
		    var icon_bd_width = jQuery('#icon-iconbd_width').val();
		    var icon_hover_animation = jQuery('#icon-hover_animation').val();
		    var icon_link = jQuery('#icon-icon_link').val();
		    var icon_ani = jQuery('#icon-icon_animation').val();
		    var icon_ani_du = jQuery('#icon-icon_animation_duration').val();
		    var icon_ani_de = jQuery('#icon-icon_animation_delay').val();
		    var icon_ani_it = jQuery('#icon-icon_animation_iteration').val();

                    var type = jQuery('#icon-type').val();
                    var align = jQuery('input[name="icon-align"]:checked').val();
                    var icon_align_to = jQuery('#icon-icon_align_to').val();
                    var icon = icons.find('input[name="mom_menu_item_icon"]:checked').val();
		    if(type === 'custom') {
			icon = jQuery('#icon-custom').val();
		    }
		    bgcolor = '';
		    bordercolor = '';
		    tcolor = '';
		    ccolor = '';
		    iani = '';
		    iani_du = '';
		    iani_de = '';
		    iani_it = '';
		    if (icon_ani !== '') {
			iani = ' icon_animation="'+icon_ani+'"';
		    }
		    if (icon_ani_du !== '') {
			iani_du = ' icon_animation_duration="'+icon_ani_du+'"';
		    }
		    if (icon_ani_de !== '') {
			iani_de = ' icon_animation_delay="'+icon_ani_de+'"';
		    }
		    if (icon_ani_it !== '') {
			iani_it = ' icon_animation_iteration="'+icon_ani_it+'"';
		    }
		    if(layout === 'boxed') {
			ilayout = 'layout="boxed" ';
			if (bg !== '') {
			    bgcolor = 'bg="'+bg+'" ';
			}
			if (border !== '') {
			    bordercolor = 'border="'+border+'" ';
			}
		    } else {
			ilayout = '';
		    }
		    if(titleColor !== '') {
			tcolor = 'title_color="'+titleColor+'" ';
		    }
		    if(contentColor !== '') {
			ccolor = 'content_color="'+contentColor+'" ';
		    }

		    var iconSize = jQuery('#icon-size').val();
		    if (iconSize !== 'custom') {
			var size = 'size="'+iconSize+'" ';
		    } else {
			var size = 'size="'+jQuery('#icon-custom_size').val()+'" ';
		    }
                    if(type === 'vector') {
			var iconColor = jQuery('#icon-color').val();
			var iconColorh = jQuery('#icon-colorh').val();
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
		    
		    //Links
		    if (title_link !== '') {
			title_link = ' title_link="'+title_link+'"'
		    }
		    if (icon_link !== '') {
			icon_link = ' icon_link="'+icon_link+'"'
		    }
		    
		output = '[iconbox title="'+title+'" title_align="'+titleAlign+'" content_align="'+contentAlign+'" '+ilayout+bgcolor+bordercolor+tcolor+ccolor+' align="'+align+'" type="'+type+'" icon="'+icon+'" icon_align_to="'+icon_align_to+'" '+size+iconc+iconch+iconbg+iconbgcolor+iconbgcolorh+square_radius+iconbdcolor+iconbdcolorh+icon_bd_width+iani+iani_du+iani_de+iani_it+title_link+icon_link+']'+icontent+'[/iconbox]';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, output);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
