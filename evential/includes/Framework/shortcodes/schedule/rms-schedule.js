(function() {
   tinymce.create('tinymce.plugins.schedule', {
      init : function(ed, url) {
         ed.addButton('schedule', {
            title : 'schedule',
            image : url+'/schedule.png',
            onclick : function() {
               // triggers the thickbox
                var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                W = W - 80;
                H = H - 84;
                tb_show( 'schedule Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=schedule-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "schedule",
            author : 'ThemexLab',
            authorurl : 'http://www.themexlab.com',
            infourl : 'http://www.themexlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('schedule', tinymce.plugins.schedule);
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="schedule-form"><table id="schedule-table" class="form-table">\
			<tr>\
				<th><label for="schedule_number">Number Of schedule</label></th>\
				<td><input type="text" name="number" id="schedule_number" value="3" /><br />\
				<small>How many member you want to show.</small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="schedule_submit" class="button-primary" value="Insert Button" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#schedule_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var options = {
						'number'             : ''
				};
			var shortcode = '[rms-schedule';
			
			for( var index in options) {
				var value = table.find('#schedule_' + index).val();
				
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