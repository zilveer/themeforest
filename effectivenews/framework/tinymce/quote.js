(function() {
    tinymce.create('tinymce.plugins.quote', {
        init : function(ed, url) {
            ed.addButton('quote', {
                title : 'Add a quote',
                image : url+'/images/quote.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Quote', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=quote-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('quote', tinymce.plugins.quote);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="quote-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="quote-font">Font</label>\
			    <span>quote content font</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<select name="font" id="quote-font">'+$faces+'</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="quote-font_size">Font Size</label>\
			    <span>quote content font size eg. 18</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<input type="text" id="quote-font_size" name="font_size" >\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="quote-font_style">Font Style</label>\
			    <span>normal or italic</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<select name="font_style" id="quote-font_style">\
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
			    <label for="">Quote Style</label>\
			    <span>customize it</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
    			<div class="mom_color_wrap">\
				<div class="mom_color"><span>Background color</span><input type="text" id="quote-bgcolor" name="bgcolor" class="mom-color-field" /></div>\
				<div class="mom_color"><span>Text color</span><input type="text" id="quote-color" name="color" class="mom-color-field"></div>\
				<div class="mom_color"><span>Highlight color</span><input type="text" id="quote-bcolor" name="bcolor" class="mom-color-field"></div>\
			</div>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="quote-arrow">Show Arrow</label>\
			    <span>little arrow on highlight</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
    			<select name="arrow" id="quote-arrow">\
					<option value="">No</option>\
					<option value="yes">Yes</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="quote-align">Alignment</label>\
			    <span>it can be aligned with any content</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
    			<select name="align" id="quote-align">\
					<option value="">none</option>\
					<option value="right">Right</option>\
					<option value="left">Left</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    </div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="quote-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
	
		jQuery('.mom-color-field').wpColorPicker();

		// handles the click event of the submit button
		form.find('#quote-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = {
				'font':'',
				'font_size':'',
				'font_style':'',
				'color':'',
				'bgcolor':'',
				'bcolor':'',
				'arrow':'',
				'align': ''
		};
			selected = tinyMCE.activeEditor.selection.getContent();
			var shortcode = '[quote';
			
			for( var index in options) {
				var value = table.find('#quote-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']' +selected+'[/quote]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
