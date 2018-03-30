(function() {
    tinymce.create('tinymce.plugins.divide', {
        init : function(ed, url) {
            ed.addButton('divide', {
                title : 'Add a divider',
                image : url+'/images/divide.png',
                              onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'divider', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=divide-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('divide', tinymce.plugins.divide);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="divide-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="divide-style">Style</label>\
			    <span>4 styles, default margin bottom 25px</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<select id="divide-style" name="style">\
				<option value="">Line</option>\
				<option value="dots">Dots</option>\
				<option value="dashs">Dashes</option>\
				</select>\
				<div class="mom_color_wrap">\
				<div class="mom_color divider_default_par"><span>Icon</span><select name="icon" id="divide-icon">\
					<option value="">none</option>\
					<option value="square">Square</option>\
					<option value="circle">Circle</option>\
				</select></div>\
				<div class="mom_color divider_default_par"><span>Icon Position</span><select name="icon_position" id="divide-icon_position">\
					<option value="">Center</option>\
					<option value="left">Left</option>\
					<option value="right">Right</option>\
				</select></div>\
				<div class="mom_color"><span>Space above it</span><input type="text" id="divide-margin_top" name="margin_top" class="custom_input" /></div>\
				<div class="mom_color"><span>Space under it</span><input type="text" id="divide-margin_bottom" name="margin_bottom" class="custom_input" /></div>\
				</div>\
					</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="divide-width">Width</label>\
			    <span>select divider width "long, medium, short"</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<select id="divide-width" name="width">\
				<option value="">Long</option>\
				<option value="medium">Medium</option>\
				<option value="short">Short</option>\
			</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="divide-color">Divider Color</label>\
			    <span>custom color</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="divide-color" class="mom-color-field">\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="divide-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
				table.find('.mom-color-field').wpColorPicker();
		form.appendTo('body').hide();

		// handles the click event of the submit button
		form.find('#divide-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'style':'',
				'icon': '',
				'icon_position': '',
				'margin_top': '',
				'margin_bottom': '',
				'width': '',
				'color': ''
		};
			var shortcode = '[divide'
			
			for( var index in options) {
				var value = table.find('#divide-' + index).val();
				
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