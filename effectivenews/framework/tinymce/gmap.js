(function() {
    tinymce.create('tinymce.plugins.gmap', {
        init : function(ed, url) {
            ed.addButton('gmap', {
                title : 'Add a Google Map',
                image : url+'/images/map.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'Map', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=gmap-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('gmap', tinymce.plugins.gmap);
    
    // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="gmap-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="gmap-width">Width</label>\
			    <span>in pixels or percent</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="gmap-width" name="width" >\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="gmap-height">Height</label>\
			    <span>in pixels or percent</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="gmap-height" name="height" >\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="gmap-src">URL</label>\
			    <span>map url here</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			    <input type="text" id="gmap-src" name="src" >\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="gmap-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#gmap-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'width':'',
				'height':'',
				'src':''
		};
			var shortcode = '[google_map';
			
			for( var index in options) {
				var value = table.find('#gmap-' + index).val();
				
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
