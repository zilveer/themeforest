(function() {
   tinymce.create('tinymce.plugins.countdown', {
      init : function(ed, url) {
         ed.addButton('countdown', {
            title : 'countdown',
            image : url+'/counter.png',
            onclick : function() {
               // triggers the thickbox
                var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                W = W - 80;
                H = H - 84;
                tb_show( 'countdown Member Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=countdown-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "countdown",
            author : 'ThemeonLab',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('countdown', tinymce.plugins.countdown);
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="countdown-form"><table id="countdown-table" class="form-table">\
			<tr>\
				<th><label for="countdown_text">Title Text</label></th>\
				<td><input type="text" name="text" id="countdown_text" value="" /><br />\
				<small>Insert Title Text.</small></td>\
			</tr>\
			<tr>\
				<th><label for="countdown_content">Content Text</label></th>\
				<td><input type="text" name="content" id="countdown_content" value="" /><br />\
				<small>Insert Content Text.</small></td>\
			</tr>\
			<tr>\
				<th><label for="countdown_year">Year</label></th>\
				<td><input type="text" name="year" id="countdown_year" value="" /><br />\
				<small>Insert Year.</small></td>\
			</tr>\
			<tr>\
				<th><label for="countdown_month">Month</label></th>\
				<td><input type="text" name="month" id="countdown_month" value="" /><br />\
				<small>Insert Month.</small></td>\
			</tr>\
			<tr>\
				<th><label for="countdown_day">Day</label></th>\
				<td><input type="text" name="day" id="countdown_day" value="" /><br />\
				<small>Insert Day.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="countdown_submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#countdown_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = { 
				'text'            : '',
				'content'         : '',
				'year'            : '',
				'month'           : '',
				'day'             : ''
				}; 
			var shortcode = '[rms-countdown';
			
			for( var index in options) {
				var value = table.find('#countdown_' + index).val();
				
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