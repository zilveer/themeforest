(function() {
   tinymce.create('tinymce.plugins.mybtn', {
      init : function(ed, url) {
         ed.addButton('mybtn', {
            title : 'mybtn',
            image : url+'/mybtn.png',
            onclick : function() {
                    // triggers the thickbox
                    var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                    W = W - 80;
                    H = H - 84;
                    tb_show( 'My Button Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=mybtn-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "mybtn",
            author : 'ThemeonLab',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('mybtn', tinymce.plugins.mybtn);
   
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="mybtn-form"><table id="mybtn-table" class="form-table">\
			<tr>\
				<th><label for="mybtn-type">Button Type</label></th>\
				<td><select name="type" id="mybtn-type" >\
					<option value="Button-Big-color">Button Big color</option>\
					<option value="Button-Small-color">Button Small color</option>\
					<option value="Button-Big-Nocolor">Button Big Nocolor</option>\
					</select><br />\
				<small>Select Button Type.</small></td>\
			</tr>\
			<tr>\
				<th><label for="mybtn-class">Button Class</label></th>\
				<td><input type="text" name="class" id="mybtn-class" value="" /><br />\n\
                <small>Insert Button Class.</small></td>\
			</tr>\
			<tr>\
				<th><label for="mybtn-text">Button Text</label></th>\
				<td><input type="text" name="text" id="mybtn-text" value="" /><br />\n\
                <small>Insert Button Text.</small></td>\
			</tr>\
			<tr>\
				<th><label for="mybtn-link">Button Link</label></th>\
				<td><input type="text" name="link" id="mybtn-link" value="#" /><br />\
				<small>Insert Link. If you want a button then make it blank</small>\</td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="mybtn-submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#mybtn-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
                    'type'          : '',
                    'text'          : '',
                    'link'          : '',
                    'class'         : ''
				};
			var shortcode = '[rms-mybtn';
			
			for( var index in options) {
				var value = table.find('#mybtn-' + index).val();
				
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