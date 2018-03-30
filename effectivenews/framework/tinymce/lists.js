(function() {
    tinymce.create('tinymce.plugins.customLists', {
        init : function(ed, url) {
            ed.addButton('customLists', {
                title : 'Insert List',
                image : url+'/images/lists.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height()-50, W = ( 720 < width ) ? 720: width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Lists', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=list-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('customLists', tinymce.plugins.customLists);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="list-form">\
		<div class="mom_tiny_form">\
			<div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="list-content">Content</label>\
			    <span>List items</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
		 <textarea id="list-content">list item per line. </textarea>\
				<div class="mom_color_wrap">\
				<div class="mom_color"><span>Space above it</span><input type="text" id="list-margin_top" name="margin_top" class="custom_input" /></div>\
				<div class="mom_color"><span>Space under it</span><input type="text" id="list-margin_bottom" name="margin_bottom" class="custom_input" /></div>\
				</div>\
				</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="list-iconbg">Icon Background</label>\
			    <span>circle and square available</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<select id="list-iconbg">\
			<option value="">none</option>\
			<option value="square">Square</option>\
			<option value="circle">Circle</option>\
		    </select>\
    			<div class="mom_color_wrap lics_bg hide">\
				<div class="mom_color"><span>Background color</span><input type="text" id="list-iconbg_color" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Background Hover</span><input type="text" id="list-iconbg_colorh" class="mom-color-field" value="" /></div>\
				<div class="mom_color lics_radius hide"><span>Square Radius</span><input type="text" id="list-square_radius" value="" class="custom_input"></div>\
			</div>\
		</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="list-icon_size">Icon Size</label>\
			    <span>default icon size is 16 some icons maybe looking big or small so you can change icon size from here</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<input type="text" id="list-icon_size" value="">\
		</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="list-type">Icon</label>\
			    <span>you can change icon colors too</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
    			<div class="mom_color_wrap vector_icons" style="margin-top: 0;">\
				<div class="mom_color"><span>Icon Color</span><input type="text" id="list-color" class="mom-color-field" value="" /></div>\
				<div class="mom_color"><span>Icon Hover</span><input type="text" id="list-colorh" class="mom-color-field" value="" /></div>\
			</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_icons_wrap list_vector_icons">\
		    </div>\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="list-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.list_table');
		form.appendTo('body').hide();

		jQuery('.mom-color-field').wpColorPicker();
		
		$('#list-iconbg').change(function () {
		    if (jQuery(this).val() !== '') {
			$('.lics_bg').slideDown(250);
		    } else {
			$('.lics_bg').slideUp('fast');
		    }
		    if (jQuery(this).val() === 'square') {
			$('.lics_radius').slideDown(250);
		    } else {
			$('.lics_radius').slideUp('fast');
		    }

		});

		var icons = form.find('.mom_tiny_icons_wrap');
		// handles the click event of the submit button
		form.find('#list-submit').click(function(){
			//output
                    var icon = icons.find('input[name="mom_menu_item_icon"]:checked').val();
                    var iconColor = jQuery('#list-color').val();
                    var iconColorh = jQuery('#list-colorh').val();
                    var iconbg = jQuery('#list-iconbg').val();
                    var iconsize = jQuery('#list-icon_size').val();
                    var iconbgcolor = jQuery('#list-iconbg_color').val();
                    var iconbgcolorh = jQuery('#list-iconbg_colorh').val();
		    var margin_top = jQuery('#list-margin_top').val();
		    var margin_bottom = jQuery('#list-margin_bottom').val();
                    var list = jQuery('#list-content').val();
		    var lines = list.split(/\n/);
		    var texts = []
		    for (var i=0; i < lines.length; i++) {
		      // only push this line if it contains a non whitespace character.
		      if (/\S/.test(lines[i])) {
			texts.push($.trim(lines[i]));
		      }
		    }
                    
		    var square_radius = jQuery('#list-square_radius').val();

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

    		    if(iconsize !== '') {
			iconsize = 'icon_size="'+iconsize+'" ';
		    } else {
			iconsize = '';
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
		    
		    if( margin_top !== '' ) {
			margin_top = 'margin_top="'+margin_top+'" ';
		    }

		    if( margin_bottom !== '' ) {
			margin_bottom = 'margin_bottom="'+margin_bottom+'" ';
		    }

		selected = tinyMCE.activeEditor.selection.getContent();
		output = '[list icon="'+icon+'" '+iconc+iconch+iconsize+iconbg+iconbgcolor+iconbgcolorh+square_radius+margin_top+margin_bottom+']'+texts+'[/list]';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, output);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
