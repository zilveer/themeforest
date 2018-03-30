(function() {
   tinymce.create('tinymce.plugins.heading', {
      init : function(ed, url) {
         ed.addButton('heading', {
            title : 'Heading',
            image : url+'/heading.png',
            onclick : function() {
               // triggers the thickbox
                var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                W = W - 80;
                H = H - 84;
                tb_show( 'Heading Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=heading-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Heading",
            author : 'ThemeonLab',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('heading', tinymce.plugins.heading);
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="heading-form"><table id="heading-table" class="form-table">\
			<tr>\
				<th><label for="heading_type">Header Type</label></th>\
				<td><select name="type" id="heading_type" >\
					<option value="Header-Big">Header Big</option>\
					<option value="Header-Center">Header Center</option>\
					<option value="Header-Left">Header-Left</option>\
					</select><br />\
				<small>Select Header Type.</small></td>\
			</tr>\
			<tr>\
				<th><label for="heading_text">Heading Text</label></th>\
				<td><input type="text" name="text" id="heading_text" value="" /><br />\
				<small>Heading Display Text.</small></td>\
			</tr>\
			<tr>\
				<th><label for="heading_icon">Icon Class</label></th>\
				<td><input type="text" name="icon" id="heading_icon" value="" /><br />\
				<small>Font-Awesome icon class insert here.</small></td>\
			</tr>\
			<tr>\
				<th><label for="heading_content">Content For Below Title</label></th>\
				<td><textarea name="content" id="heading_content" style="width:300px;height:180px;"></textarea><br />\n\
                <small>Insert Content.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="section_submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#section_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
								'text'              : '',
                                'content'           : '',
                                'icon'              : '',
                                'type'              : ''
				};
			var shortcode = '[rms-heading';
			
			for( var index in options) {
				var value = table.find('#heading_' + index).val();
				
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