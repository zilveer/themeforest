(function() {
    tinymce.create('tinymce.plugins.visibility', {
        init : function(ed, url) {
            ed.addButton('visibility', {
                title : 'Add a visibility',
                image : url+'/images/eye.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'visibility', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=visibility-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('visibility', tinymce.plugins.visibility);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="visibility-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="visibility-visible_on">Visible On</label>\
			    <span>select where you want see this content</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
    			<select name="align" id="visibility-visible_on">\
					<option value="desktop">Desktop</option>\
					<option value="device">Device (mobiles and tablets)</option>\
					<option value="tablet">Tablet</option>\
					<option value="mobile">Mobile</option>\
				</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    </div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="visibility-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
	
		// handles the click event of the submit button
		form.find('#visibility-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = {
				'visible_on':'',
		};
			selected = tinyMCE.activeEditor.selection.getContent();
			var shortcode = '[visibility';
			
			for( var index in options) {
				var value = table.find('#visibility-' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
					shortcode += ' ' + index + '="' + value + '"';
			}
			
			shortcode += ']' +selected+'[/visibility]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
