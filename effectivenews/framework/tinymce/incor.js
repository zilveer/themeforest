(function() {
    tinymce.create('tinymce.plugins.incor', {
        init : function(ed, url) {
            ed.addButton('incor', {
                title : 'Add a anchor',
                image : url+'/images/ancor.png',
                              onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'incor', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=incor-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('incor', tinymce.plugins.incor);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="incor-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="incor-name">Name</label>\
			    <span></span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<input type="text" id="incor-name" name="name" >\
			</div>\
			<div class="clear"></div>\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="incor-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
				
		form.appendTo('body').hide();

		// handles the click event of the submit button
		form.find('#incor-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'name':'',
		};
			var shortcode = '[incor'
			
			for( var index in options) {
				var value = table.find('#incor-' + index).val();
				
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