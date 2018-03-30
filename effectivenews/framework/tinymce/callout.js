(function() {
    tinymce.create('tinymce.plugins.callout', {
        init : function(ed, url) {
            ed.addButton('callout', {
                title : 'Add a callout',
                image : url+'/images/callitout.png',
                onclick : function() {
// triggers the thickcallout
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'callout Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=callout-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('callout', tinymce.plugins.callout);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="callout-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-style">Style</label>\
			    <span>Customize box style</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
				<div class="mom_color_wrap" style="margin-top:0;">\
				<div class="mom_color"><span style="width:100%;">Background Image <a class="upload_callout_bg" href="#">Upload Image</a></span><input type="text" name="bgimg" id="callout-bgimg" value=""></div>\
				<div class="mom_color"><span>Background Color</span><input type="text" class="mom-color-field" id="callout-bg" value=""></div>\
				<div class="mom_color"><span>Text Color</span><input type="text" class="mom-color-field" id="callout-color" value=""></div>\
				<div class="mom_color"><span>Border Color</span><input type="text" class="mom-color-field" id="callout-border" value=""></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-radius">Radius</label>\
			    <span>insert box border radius number eg. 10</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="radius" id="callout-radius" value="">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-font">Font</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="font" id="callout-font">'+$faces+'</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-fontsize">Font Size</label>\
			    <span>insert a font size as a number eg. 14</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="fontsize" id="callout-fontsize" value="">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-content">Content</label>\
			    <span>Arbitrary text or HTML, shortcodes</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <textarea id="callout-content" name="content" cols="40" rows="6"></textarea>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_infobr"><h3>Box Button</h3></div>\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-bt_pos">Button Position</label>\
			    <span>Button Position</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select id="callout-bt_pos">\
				<option value="right">Right</option>\
				<option value="bottomLeft">Bottom left</option>\
				<option value="bottomRight">Bottom right</option>\
				<option value="bottomCenter">Bottom center</option>\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-bt_content">Content</label>\
			    <span>insert button text ex: Click Here</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="callout-bt_content" value="Click Here" name"content">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-bt_color">Color</label>\
			    <span>Select one or make your own</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="color" id="callout-bt_color">\
					<option value="">Default</option>\
					<option value="yellow">Yellow</option>\
					<option value="orange">Orange</option>\
					<option value="orange2">Orange2</option>\
					<option value="red">Red</option>\
					<option value="brown">Brown</option>\
					<option value="pink">Pink</option>\
					<option value="purple">Purple</option>\
					<option value="green2">Dark Green</option>\
					<option value="green">Green</option>\
					<option value="blue">Blue</option>\
					<option value="blue2">Dark Blue</option>\
					<option value="gray2">Dark Gray</option>\
					<option value="gray">Gray</option>\
					<option value="" class="custom">Custom</option>\
				</select>\
				<div class="mom_color_wrap calloutbt_custom_colors hide">\
				<div class="mom_color"><span>Background Color</span><input type="text" class="mom-color-field" name="bgcolor" id="callout-bt_bgcolor" value=""></div>\
				<div class="mom_color"><span>Background Hover</span><input type="text" class="mom-color-field" name="hoverbg" id="callout-bt_hoverbg" value=""></div>\
				<div class="mom_color"><span>Text Color</span><input type="text" class="mom-color-field" name="textcolor" id="callout-bt_textcolor" value=""></div>\
				<div class="mom_color"><span>Text Hover</span><input type="text" class="mom-color-field"  name="texthcolor" id="callout-bt_texthcolor" value=""></div>\
				<div class="mom_color"><span>Border Color</span><input type="text" class="mom-color-field" name="bordercolor" id="callout-bt_bordercolor" value=""></div>\
				<div class="mom_color"><span>Border Hover</span><input type="text" class="mom-color-field" name="hoverborder" id="callout-bt_hoverborder" value=""></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-bt_size">Size</label>\
			    <span>select from medium or big</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="size" id="callout-bt_size">\
					<option value="">Medium</option>\
					<option value="big">Big</option>\
					<option value="bigger">Bigger</option>\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-bt_link">Link</label>\
			    <span>the link of the button.</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="link" id="callout-bt_link" value=""/>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-bt_target">Link target</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="target" id="callout-bt_target">\
					<option value="">Open in same window/tab</option>\
					<option value="_blank">Open in new window/tab</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-bt_font">Font</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="font" id="callout-bt_font">'+$faces+'</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-bt_font_style">Font Style</label>\
			    <span>Normal or <em>Italic</em></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="font_style" id="callout-bt_font_style">\
					<option value="">Normal</option>\
					<option value="italic">Italic</option>\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-bt_font_weight">Font Weight</label>\
			    <span>Normal or <strong>Bold</strong></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="font_weight" id="callout-bt_font_weight">\
					<option value="">Normal</option>\
					<option value="bold">Bold</option>\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-bt_radius">Radius</label>\
			    <span>insert a radius number eg. 10</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="radius" id="callout-bt_radius" value="">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-bt_outer_border">Outer Border</label>\
			    <span>its make the button look awesome</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="ch_switch"><input type="checkbox" name="outer_border" id="callout-bt_outer_border" value=""><label><i></i></label></div>\
				<div class="mom_color_wrap calloutbt_ob_colors hide">\
				<div class="mom_color"><span>Border Color</span><input type="text" class="mom-color-field" name="outer_border_color" id="callout-bt_outer_border_color" value=""></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="callout-bt_icons">Icon</label>\
			    <span>tons of icon fit with any button</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="ch_switch"><input type="checkbox" name="icons" id="callout-bt_icons" value=""><label><i></i></label></div>\
				<div class="mom_color_wrap calloutbt_icon_colors hide">\
				<div class="mom_color"><span>Icon Color</span><input type="text" class="mom-color-field" name="icon_color" id="callout-bt_icon_color" value=""></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		        <div class="mom_tiny_icons_wrap calloutbt_icons hide"></div>\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="callout-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		table.find('.mom-color-field').wpColorPicker();
		form.appendTo('body').hide();
		
	var file_frame;
	var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
	var set_to_post_id = post_id; // Set this
	$('.upload_callout_bg').live('click', function( event ){
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
	text: jQuery( this ).data( 'uploader_calloutbt_text' ),
	},
	multiple: false
	});
	 
	file_frame.on( 'select', function() {
	attachment = file_frame.state().get('selection').first().toJSON();
	
	    table.find('#callout-bgimg').val(attachment.url);
	
	wp.media.model.settings.post.id = wp_media_post_id;
	});
	file_frame.open();
	});
	jQuery('.upload_callout_bg').on('click', function() {
	wp.media.model.settings.post.id = wp_media_post_id;
	});

	//Button settings
	$('#callout-bt_color').change( function() {
	   if($(this).attr('class') === 'custom') {
		$('.calloutbt_custom_colors').slideDown(250);
	   } else {
		$('.calloutbt_custom_colors').slideUp('fast');
	   }
	});
	
	$('#callout-bt_icons').click( function() {
	    var $this = $(this);
		if ($this.is(':checked')) {
		$('.calloutbt_icons').slideDown(250);
		$('.calloutbt_icon_colors').slideDown(250);
		} else {
		    $('.calloutbt_icons').slideUp('fast');
		    $('.calloutbt_icon_colors').slideUp(250);
		}
	});

	$('#callout-bt_outer_border').click( function() {
	    var $this = $(this);
		if ($this.is(':checked')) {
		$('.calloutbt_ob_colors').slideDown(250);
		} else {
		    $('.calloutbt_ob_colors').slideUp(250);
		}
	});

		var icons = form.find('.mom_tiny_icons_wrap');
		// handles the click event of the submit button
		form.find('#callout-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
		if ($('#callout-bt_content').val() !== '') { 
			var options = { 
				'bgimg':'',
				'bg':'',
				'color':'',
				'border':'',
				'radius':'',
				'font':'',
				'fontsize':'',
                                'bt_content' : '',
                                'bt_pos' : '',
				'bt_style':'',
                                'bt_color': '',
                                'bt_link': '',
                                'bt_size':'',
                                'bt_target': '',
                                'bt_font' : '',
                                'bt_font_style': '',
                                'bt_font_weight': '',
                                'bt_textcolor':'',
                                'bt_texthcolor':'',
                                'bt_bgcolor':'',
                                'bt_hoverbg':'',
                                'bt_bordercolor': '',
                                'bt_hoverborder': '',
                                'bt_radius':'',
			};
		} else {
		    	var options = { 
				'bgimg':'',
				'bg':'',
				'color':'',
				'border':'',
				'radius':'',
				'font':'',
				'fontsize':'',
			};

		}

			var iconbt = icons.find('input[name="mom_menu_item_icon"]:checked').val();
			iconcolor = $('#callout-bt_icon_color').val();
			obcolor = $('#callout-bt_outer_border_color').val();
			if($('#callout-bt_icons').is(':checked')) {
			    iconabt = ' bt_icon="'+iconbt+'"';
			    if (iconcolor !== '') {
			    iconacolor = ' bt_icon_color="'+iconcolor+'"';
			    } else {
			    iconacolor = '';
			    }
			} else {
			    iconabt ='';
			    iconacolor = '';
			}
			
			if($('#callout-bt_outer_border').is(':checked')) {
			    outer_border = ' bt_outer_border="true"';
    			    if (obcolor !== '') {
			    obcolor = ' bt_outer_border_color="'+obcolor+'"';
			    } else {
			    obcolor = '';
			    }

			} else {
			    outer_border ='';   
			    obcolor = '';
			}

			var shortcode = '[callout';
			
			for( var index in options) {
				var value = table.find('#callout-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += outer_border+obcolor+iconabt+iconacolor+']' + table.find('#callout-content').val()+
			'[/callout]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
