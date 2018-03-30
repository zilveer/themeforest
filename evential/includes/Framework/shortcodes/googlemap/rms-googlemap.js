(function() {
   tinymce.create('tinymce.plugins.googlemap', {
      init : function(ed, url) {
         ed.addButton('googlemap', {
            title : 'Google Map',
            image : url+'/googlemap.png',
            onclick : function() {
               // triggers the thickbox
                var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                W = W - 80;
                H = H - 84;
                tb_show( 'Google Map Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=googlemap-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Google Map",
            author : 'ThemexLab',
            authorurl : 'http://www.themexlab.com',
            infourl : 'http://www.themexlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('googlemap', tinymce.plugins.googlemap);
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="googlemap-form"><table id="googlemap-table" class="form-table">\
			<tr>\
				<th><label for="googlemap_lat">Map Lat</label></th>\
				<td><input type="text" name="lat" id="googlemap_lat" value=""/><br/>\
				<small>Insert map Lat Direction.</small></td>\
			</tr>\
			<tr>\
				<th><label for="googlemap_lng">Map Lng</label></th>\
				<td><input type="text" name="lng" id="googlemap_lng" value=""/><br/>\
				<small>Insert map Lng Direction.</small></td>\
			</tr>\
			<tr>\
				<th><label for="googlemap_icon">Map Icon</label></th>\
				<td><input type="text" name="lng" id="googlemap_icon" value=""/><br/>\
				<small>Insert map icon Link.</small></td>\
			</tr>\
			<tr>\
				<th><label for="googlemap_zoom">Map Zoom</label></th>\
				<td><input type="text" name="zoom" id="googlemap_zoom" value=""/><br/>\
				<small>Insert map icon Link.</small></td>\
			</tr>\
			<tr>\
				<th><label for="googlemap_contents">Map Top Content</label></th>\
				<td><input type="text" name="contents" id="googlemap_contents" value=""/><br/>\
				<small>Insert Map Top Content.</small></td>\
			</tr>\
			<tr>\
				<th><label for="googlemap_contents2">Map Content</label></th>\
				<td><input type="text" name="contents2" id="googlemap_contents2" value=""/><br/>\
				<small>Insert Map Content.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="googlemap_submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#googlemap_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			
			var options = {
							'lat' : '',
							'lng' : '',
							'icon' : '',
							'zoom' : '',
							'contents' : '',
							'contents2' : ''
						};
			var shortcode = '[rms-googlemap';
			
			for( var index in options) {
				var value = table.find('#googlemap_' + index).val();
				
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