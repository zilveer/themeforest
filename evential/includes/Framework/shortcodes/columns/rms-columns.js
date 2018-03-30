(function() {
   tinymce.create('tinymce.plugins.columns', {
      init : function(ed, url) {
         ed.addButton('columns', {
            title : 'Columns',
            image : url+'/icon.png',
            onclick : function() {
               // triggers the thickbox
                var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                W = W - 80;
                H = H - 84;
                tb_show( 'Team Member Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=columns-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Columns",
            author : 'ThemeonLab',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('columns', tinymce.plugins.columns);
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="columns-form"><table id="columns-table" class="form-table">\
			<tr>\
				<th><label for="columns_part">Team Slider</label></th>\
				<td><select name="part" id="columns_part">\
                                <option value="1">1/12 Columns</option>\
                                <option value="2">2/12 Columns</option>\
                                <option value="3">3/12 Columns</option>\
                                <option value="4">4/12 Columns</option>\
                                <option value="5">5/12 Columns</option>\
                                <option value="6">6/12 Columns</option>\
                                <option value="7">7/12 Columns</option>\
                                <option value="8">8/12 Columns</option>\
                                <option value="9">9/12 Columns</option>\
                                <option value="10">10/12 Columns</option>\
                                <option value="11">11/12 Columns</option>\
                                <option value="12">12/12 Columns</option>\
                                </select><br />\
				<small>Select Column Layout. </small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="columns_submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#columns_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'part'            : ''
				};
			var shortcode = '[rms-columns';
			
			for( var index in options) {
				var value = table.find('#columns_' + index).val();
				
				// attaches the attribute to the shortcode only if it's different from the default value
				if ( value !== options[index] )
                                {
					shortcode += ' ' + index + '="' + value + '"';
                                }
			}
                        shortcode += ']';
			shortcode += 'Insert your content here';
			shortcode += '[/rms-columns]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();

