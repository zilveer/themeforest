(function() {
   tinymce.create('tinymce.plugins.hurryup', {
      init : function(ed, url) {
         ed.addButton('hurryup', {
            title : 'hurryup',
            image : url+'/hurryup.png',
            onclick : function() {
                    // triggers the thickbox
                    var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                    W = W - 80;
                    H = H - 84;
                    tb_show( 'HurryUP Counter Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=hurryup-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "hurryup",
            author : 'ThemeonLab',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('hurryup', tinymce.plugins.hurryup);
   
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="hurryup-form"><table id="hurryup-table" class="form-table">\
			<tr>\
				<h4 style="color: red;">If you want simple HurryUP Counter then select "Hummry Up Style 1" <br />and if you want HurryUP Counter With opoup Contact Form Pllease select "Hummry Up Style 2"</h4></td>\
			</tr>\
			<tr>\
				<th><label for="hurryup-type">Hurry Up Type</label></th>\
				<td><select name="type" id="hurryup-type" >\
					<option value="Hummry-Up-Style1">Hummry Up Style 1</option>\
					<option value="Hummry-Up-Style2">Hummry Up Style 2</option>\
					</select><br />\
				<small>Select Button Type.</small></td>\
			</tr>\
			<tr>\
				<th><label for="hurryup-seatleft">Seat Left</label></th>\
				<td><input type="text" name="seatleft" id="hurryup-seatleft" value="" /><br />\n\
                <small>Insert How Many Seat Left.</small></td>\
			</tr>\
			<tr>\
				<th><label for="hurryup-text">First Text</label></th>\
				<td><input type="text" name="text" id="hurryup-text" value="" /><br />\n\
                <small>Insert First Text.</small></td>\
			</tr>\
			<tr>\
				<th><label for="hurryup-texts">Second Text</label></th>\
				<td><input type="text" name="texts" id="hurryup-texts" value="" /><br />\n\
                <small>Insert Second Text.</small></td>\
			</tr>\
			<tr>\
				<th><label for="hurryup-content">Content Text</label></th>\
				<td><input type="text" name="content" id="hurryup-content" value="" /><br />\n\
                <small>Insert Content Text.</small></td>\
			</tr>\
			<tr>\
				<th><label for="hurryup-buttontext">Button Text</label></th>\
				<td><input type="text" name="buttontext" id="hurryup-buttontext" value="#" /><br />\
				<small>Insert Button Text</small>\</td>\
			</tr>\
			<tr>\
				<th><label for="hurryup-link">Button Link</label></th>\
				<td><input type="text" name="link" id="hurryup-link" value="#" /><br />\
				<small>Insert Link. If you want a button then make it blank</small>\</td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="hurryup-submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#hurryup-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
					'type' 			: '',
					'seatleft' 		: '',
					'text' 			: '',
					'texts' 		: '',
					'buttontext' 	: '',
					'content' 		: '',
					'link' 			: ''
				};
			var shortcode = '[rms-hurryup';
			
			for( var index in options) {
				var value = table.find('#hurryup-' + index).val();
				
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