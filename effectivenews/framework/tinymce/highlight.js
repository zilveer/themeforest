(function() {
    tinymce.create('tinymce.plugins.highlight', {
        init : function(ed, url) {
            ed.addButton('highlight', {
                title : 'Add a highlight',
                image : url+'/images/highlight.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'highlight Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=highlight-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('highlight', tinymce.plugins.highlight);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="highlight-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="highlight-bgcolor">Background</label>\
			    <span>highlight background color</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="highlight-bgcolor" class="mom-color-field" name="bgcolor" />\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="highlight-txtcolor">Text</label>\
			    <span>highlight Text color</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="highlight-txtcolor" class="mom-color-field" name="txtcolor" />\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="highlight-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		table.find('.mom-color-field').wpColorPicker();

		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#highlight-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'bgcolor':'',
				'txtcolor':''
		};
		     selected = tinyMCE.activeEditor.selection.getContent();
		    var shortcode = '[highlight';
			
			for( var index in options) {
				var value = table.find('#highlight-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']' +selected+'[/highlight]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
