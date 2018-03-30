(function() {
   tinymce.create('tinymce.plugins.textblock', {
      init : function(ed, url) {
         ed.addButton('textblock', {
            title : 'textblock',
            image : url+'/about.png',
            onclick : function() {
                    // triggers the thickbox
                    var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                    W = W - 80;
                    H = H - 84;
                    tb_show( 'My Button Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=textblock-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "textblock",
            author : 'ThemeonLab',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('textblock', tinymce.plugins.textblock);
   
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="textblock-form"><table id="textblock-table" class="form-table">\
			<tr>\
				<th><label for="textblock-text">Text For Title</label></th>\
				<td><input type="text" name="text" id="textblock-text" value="Lorem Ipsum" /><br />\
                <small>Insert Title 1st part then icon and then 2nd part.</small></td>\
			</tr>\
			<tr>\
				<th><label for="textblock-content">Content For Show</label></th>\
				<td><textarea name="content" id="textblock-content" style="width:300px;height:180px;"></textarea><br />\n\
                <small>Insert Content.</small></td>\
			</tr>\
			<tr>\
				<th><label for="textblock-icon">Fontawesome Icon</label></th>\
				<td><input type="text" name="icon" id="textblock-icon" value="" /><br />\
				<small>Insert a icon from FontAwesome:http://fortawesome.github.io/Font-Awesome/icons/. Code Example:\'fa-angellist\'</small></td>\
			</tr>\
			<tr>\
				<th><label for="textblock-texts">Button Text</label></th>\
				<td><input type="text" name="texts" id="textblock-texts" value="" /><br />\
				<small>Insert Button Text</small></td>\
			</tr>\
			<tr>\
				<th><label for="textblock-link">Button Link</label></th>\
				<td><input type="text" name="link" id="textblock-link" value="" /><br />\
				<small>Insert Button Link</small></td>\
			</tr>\
			<tr>\
				<th><label for="textblock-class">Button Class</label></th>\
				<td><input type="text" name="class" id="textblock-class" value="" /><br />\
				<small>Button Class</small></td>\
			</tr>\
			<tr>\
				<th><label for="textblock-align">Text Align</label></th>\
				<td><select name="align" id="textblock-align">\
                                <option value="left">Left Align</option>\
                                <option value="center">Center Align</option>\
                                <option value="right">Right Align</option>\
                                </select><br />\
				<small>Heagin Highlighted Text Align.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="textblock-submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#textblock-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
                'text' 				: '',
				'content' 			: '',
				'icon' 				: '',
				'class' 			: '',
				'link' 				: '',
				'texts' 			: '',
				'align' 			: ''
				};
			var shortcode = '[rms-textblock';
			
			for( var index in options) {
				var value = table.find('#textblock-' + index).val();
				
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