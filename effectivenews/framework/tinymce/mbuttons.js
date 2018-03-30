(function() {
    tinymce.create('tinymce.plugins.mbutton', {
        init : function(ed, url) {
            ed.addButton('mbutton', {
                title : 'Add a Button',
                image : url+'/images/buttons.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 110;
						tb_show( 'Button', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=button-form' );
						}
            });
	}
    });
    tinymce.PluginManager.add('mbutton', tinymce.plugins.mbutton);
    
    // executes this when the DOM is ready
	jQuery(function($){
		var form = jQuery('<div id="button-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="button-content">Content</label>\
			    <span>insert button text ex: Click Here</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="button-content" value="Click Here" name"content">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="button-color">Color</label>\
			    <span>Select one or make your own</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="color" id="button-color">\
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
					<option value="custom">Custom</option>\
				</select>\
				<div class="mom_color_wrap button_custom_colors hide">\
				<div class="mom_color"><span>Background Color</span><input type="text" class="mom-color-field" name="bgcolor" id="button-bgcolor" value=""></div>\
				<div class="mom_color"><span>Background Hover</span><input type="text" class="mom-color-field" name="hoverbg" id="button-hoverbg" value=""></div>\
				<div class="mom_color"><span>Text Color</span><input type="text" class="mom-color-field" name="textcolor" id="button-textcolor" value=""></div>\
				<div class="mom_color"><span>Text Hover</span><input type="text" class="mom-color-field"  name="texthcolor" id="button-texthcolor" value=""></div>\
				<div class="mom_color"><span>Border Color</span><input type="text" class="mom-color-field" name="bordercolor" id="button-bordercolor" value=""></div>\
				<div class="mom_color"><span>Border Hover</span><input type="text" class="mom-color-field" name="hoverborder" id="button-hoverborder" value=""></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="button-size">Size</label>\
			    <span>select from medium or big</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="size" id="button-size">\
					<option value="">Medium</option>\
					<option value="big">Big</option>\
					<option value="bigger">Bigger</option>\
			    </select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="button-align">Align</label>\
			    <span>right,left and center</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="style" id="button-align">\
					<option value="">Left</option>\
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
			    <label for="button-width">Width</label>\
			    <span>it can be 100% width</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="style" id="button-width">\
					<option value="">Fit with content</option>\
					<option value="full">full width</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="button-link">Link</label>\
			    <span>the link of the button.</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="link" id="button-link" value=""/>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="button-target">Link target</label>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="target" id="button-target">\
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
			    <label for="button-font">Font</label>\
			    <span>600+ font available</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="font" id="button-font">'+$faces+'</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="button-font_style">Font Style</label>\
			    <span>Normal or <em>Italic</em></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="font_style" id="button-font_style">\
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
			    <label for="button-font_weight">Font Weight</label>\
			    <span>Normal or <em>Bold</em></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <select name="font_weight" id="button-font_weight">\
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
			    <label for="button-radius">Radius</label>\
			    <span>insert a radius number eg. 10</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" name="radius" id="button-radius" value="">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="button-outer_border">Outer Border</label>\
			    <span>its make the button look awesome</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="ch_switch"><input type="checkbox" name="outer_border" id="button-outer_border" value=""><label><i></i></label></div>\
				<div class="mom_color_wrap button_ob_colors hide">\
				<div class="mom_color"><span>Border Color</span><input type="text" class="mom-color-field" name="outer_border_color" id="button-outer_border_color" value=""></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="button-icons">Icon</label>\
			    <span>Tons of icons fit with any button</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <div class="ch_switch"><input type="checkbox" name="icons" id="button-icons" value=""><label><i></i></label></div>\
				<div class="mom_color_wrap button_icon_colors hide">\
				<div class="mom_color"><span>Icon Color</span><input type="text" class="mom-color-field" name="icon_color" id="button-icon_color" value=""></div>\
				</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		        <div class="mom_tiny_icons_wrap button_icons hide"></div>\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="button-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		$('.mom-color-field').wpColorPicker();
	
	//Button settings
	$('#button-color').change( function() {
	   if($(this).val() === 'custom') {
		$('.button_custom_colors').slideDown(250);
	   } else {
		$('.button_custom_colors').slideUp('fast');
	   }
	});
	
	$('#button-icons').click( function() {
	    var $this = $(this);
		if ($this.is(':checked')) {
		$('.button_icons').slideDown(250);
		$('.button_icon_colors').slideDown(250);
		} else {
		    $('.button_icons').slideUp('fast');
		    $('.button_icon_colors').slideUp(250);
		}
	});

	$('#button-outer_border').click( function() {
	    var $this = $(this);
		if ($this.is(':checked')) {
		$('.button_ob_colors').slideDown(250);
		} else {
		    $('.button_ob_colors').slideUp(250);
		}
	});
	    jQuery.ajax({
		    type: "post",
		    url: MomCats.url,
		    dataType: 'html',
		    data: "action=mom_loadIcon&nonce="+MomCats.nonce,
		    beforeSend: function() {
		    },
		    success: function(data){
			$('body').find('.mom_tiny_icons_wrap').html(data);
	    }
	    });						
	    var icons = form.find('.mom_tiny_icons_wrap');
	// handles the click event of the submit button
		form.find('#button-submit').on('click', function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = {
				'width' : '',
				'color': '',
				'link': '',
				'size':'',
				'align':'',
				'target': '',
				'font' : '',
				'font_style': '',
				'font_weight': '',
				'textcolor':'',
				'texthcolor':'',
				'bgcolor':'',
				'hoverbg':'',
				'bordercolor': '',
				'hoverborder': '',
				'radius':'',
		};

			iconcolor = $('#button-icon_color').val();
			obcolor = $('#button-outer_border_color').val();
			var iconbt = icons.find('input[name="mom_menu_item_icon"]:checked').val();
			if($('#button-icons').is(':checked')) {
			    iconabt = ' icon="'+iconbt+'"';
			    if (iconcolor !== '') {
			    iconacolor = ' icon_color="'+iconcolor+'"';
			    } else {
			    iconacolor = '';
			    }
			} else {
			    iconabt ='';
			    iconacolor = '';
			}
			
			if($('#button-outer_border').is(':checked')) {
			    outer_border = ' outer_border="true"';
    			    if (obcolor !== '') {
			    obcolor = ' outer_border_color="'+obcolor+'"';
			    } else {
			    obcolor = '';
			    }

			} else {
			    outer_border ='';   
			    obcolor = '';
			}

			var shortcode = '[button';
			
			for( var index in options) {
				var value = table.find('#button-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += outer_border+obcolor+iconabt+iconacolor+']' + table.find('#button-content').val()+'[/button]';

			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
