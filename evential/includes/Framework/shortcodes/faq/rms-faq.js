(function() {
   tinymce.create('tinymce.plugins.faq', {
      init : function(ed, url) {
         ed.addButton('faq', {
            title : 'faq',
            image : url+'/faq.png',
            onclick : function() {
               // triggers the thickbox
                var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                W = W - 80;
                H = H - 84;
                tb_show( 'Our faq Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=faq-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "faq",
            author : 'RMS IT',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('faq', tinymce.plugins.faq);
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="faq-form"><table id="faq-table" class="form-table">\
			<tr>\
				<th><label for="faq_text">Title text</label></th>\
				<td><input type="text" name="text" id="faq_text" value="" /><br />\
				<small>Insert Title Text.</small></td>\
			</tr>\
			<tr>\
				<th><label for="faq_content">Content Text</label></th>\
				<td><input type="text" name="content" id="faq_content" value="" /><br />\
				<small>Insert Content Text.</small></td>\
			</tr>\
			<tr>\
				<th><label for="faq_number">Number Of faq</label></th>\
				<td><input type="text" name="number" id="faq_number" value="4" /><br />\
				<small>How many faq you want to show.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="faq_submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#faq_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'text'            : '',
				'content'         : '',
				'number'          : ''
				};
			var shortcode = '[rms-faq';
			
			for( var index in options) {
				var value = table.find('#faq_' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
                                {
					shortcode += ' ' + index + '="' + value + '"';
                                }
			}
			
			shortcode += ']';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();