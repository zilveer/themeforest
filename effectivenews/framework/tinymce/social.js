(function() {
    tinymce.create('tinymce.plugins.social', {
        init : function(ed, url) {
            ed.addButton('social', {
                title : 'Insert Social Icon',
                image : url+'/images/social.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Social Icon', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=social-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('social', tinymce.plugins.social);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="social-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="social-align">Align</label>\
			    <span>Icon alignment</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="social-align">\
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
			    <label for="social-size">Size</label>\
			    <span>set Icon Size</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="social-size">\
			<option value="16">16px</option>\
			<option value="24">24px</option>\
			<option value="32" selected="selected">32px</option>\
			<option value="48">48px</option>\
			<option value="custom">Custom Size</option>\
		    </select>\
    			<div class="mom_color_wrap social_icon_size hide">\
				<div class="mom_color"><span>Custom Icon Size</span><input type="text" id="social-custom_size" value="" class="custom_input"></div>\
			</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="social-iconbg">Icon background</label>\
			    <span>select icon background type circle, square</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		    <select id="social-iconbg">\
			<option value="">none</option>\
			<option value="square">Square</option>\
			<option value="circle">Circle</option>\
		    </select>\
    			<div class="mom_color_wrap soc_bg hide">\
				<div class="mom_color"><span>Background color</span><input type="text" id="social-iconbg_color" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Background Hover</span><input type="text" id="social-iconbg_colorh" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Border color</span><input type="text" id="social-iconbd_color" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Border Hover</span><input type="text" id="social-iconbd_colorh" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Border Width</span><input type="text" id="social-iconbd_width" value="" class="custom_input"></div>\
				<div class="mom_color soc_radius hide"><span>Square Radius</span><input type="text" id="social-square_radius" value="" class="custom_input"></div>\
			</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="social-link">Icon Link</label>\
			    <span>the social link</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="social-link" value="#">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="social-tooltip">Icon Tooltip</label>\
			    <span>social icon name just see it on hover state</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<input type="text" id="social-tooltip">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="social-type">Icon</label>\
			    <span>you can change icon colors too</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
    			<div class="mom_color_wrap vector_icons" style="margin-top: 0;">\
				<div class="mom_color"><span>Icon Color</span><input type="text" id="social-color" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Icon Hover</span><input type="text" id="social-colorh" class="mom-color-field" value="" /></div>\
			</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_icons_wrap vector_icons">\
		    </div>\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="social-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.icon_table');
		form.appendTo('body').hide();

		jQuery('.mom-color-field').wpColorPicker();

		$('label.mom_img_icon').click(function() {
			if(!$(this).hasClass('slected_icon')) {
			    $('label.mom_img_icon').removeClass('slected_icon');
			    $(this).addClass('slected_icon');
			}
		    });
		jQuery('#social-size').change(function() {
   		if (jQuery(this).val() === 'custom') {
		    jQuery('.social_icon_size').slideDown(250); 
		} else {
		    jQuery('.social_icon_size').slideUp('fast'); 
		}

		    });
		$('#social-iconbg').change(function () {
		    if (jQuery(this).val() !== '') {
			$('.soc_bg').slideDown(250);
		    } else {
			$('.soc_bg').slideUp('fast');
		    }
		    if (jQuery(this).val() === 'square') {
			$('.soc_radius').slideDown(250);
		    } else {
			$('.soc_radius').slideUp('fast');
		    }

		});
		
		var icons = form.find('.mom_tiny_icons_wrap');
		// handles the click event of the submit button
		form.find('#social-submit').click(function(){
			//output
                    var align = jQuery('#social-align').val();
                    var link = jQuery('#social-link').val();
                    var iconbg = jQuery('#social-iconbg').val();
                    var iconbgcolor = jQuery('#social-iconbg_color').val();
                    var iconbgcolorh = jQuery('#social-iconbg_colorh').val();
		    var square_radius = jQuery('#social-square_radius').val();
		    var iconbdcolor = jQuery('#social-iconbd_color').val();
		    var iconbdcolorh = jQuery('#social-iconbd_colorh').val();
		    var icon_bd_width = jQuery('#social-iconbd_width').val();
                    var icon = icons.find('input[name="mom_menu_item_icon"]:checked').val();
                    var tooltip = jQuery('#social-tooltip').val();
		    
	    
		    var iconSize = jQuery('#social-size').val();
		    if (iconSize !== 'custom') {
			var size = 'size="'+iconSize+'" ';
		    } else {
			var size = 'size="'+jQuery('#social-custom_size').val()+'" ';
		    }
			var iconColor = jQuery('#social-color').val();
			var iconColorh = jQuery('#social-colorh').val();
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

		    if (tooltip !== '') {
			itooltip = 'tooltip="'+tooltip+'" '
		    } else {
			itooltip = '';
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
		output = '[social icon="'+icon+'" link="'+link+'" '+ialign+size+iconc+iconch+iconbg+iconbgcolor+iconbgcolorh+square_radius+iconbdcolor+iconbdcolorh+icon_bd_width+itooltip+']';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, output);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
