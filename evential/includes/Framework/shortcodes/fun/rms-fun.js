(function() {
   tinymce.create('tinymce.plugins.fun', {
      init : function(ed, url) {
         ed.addButton('fun', {
            title : 'Counter',
            image : url+'/skill.png',
            onclick : function() {
               // triggers the thickbox
                var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                W = W - 80;
                H = H - 84;
                tb_show( 'Fun Facts Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=fun-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Fun Facts",
            author : 'RMS IT',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('fun', tinymce.plugins.fun);
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="fun-form"><table id="fun-table" class="form-table">\
			<tr>\
				<th><label for="fun_facts">Fun Facts Shortcode</label></th>\
				<td><small>\
                                Please Press Insert button. You will get a Demo Shortcode.<br/>\
                                Edit the shortcode to achive your requirement.<br/><br/>\
                                <strong>Demo Shortcode</strong><br/>\
                                [rms-funs]<br/>\
                                [rms-fun icon="fa fa-clock-o" count="4780"]hours of week[/rms-fun]<br/>\
                                [rms-fun icon="fa fa-coffee" count="1570"]coffees drank[/rms-fun]<br/>\
                                [rms-fun icon="fa fa-music" count="4870"]tracks played[/rms-fun]<br/>\
                                [rms-fun icon="fa fa-group" count="150"]clients[/rms-fun]<br/>\
                                [/rms-funs]<br/>\
                                </small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="fun_submit" class="button-primary" value="Insert Fun" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#fun_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			
			var shortcode = '[rms-funs]';
                            shortcode += '[rms-fun icon="fa fa-clock-o" count="4780"]hours of week[/rms-fun]';
                            shortcode += '[rms-fun icon="fa fa-coffee" count="1570"]coffees drank[/rms-fun]';
                            shortcode += '[rms-fun icon="fa fa-music" count="4870"]tracks played[/rms-fun]';
                            shortcode += '[rms-fun icon="fa fa-group" count="150"]clients[/rms-fun]';
                            shortcode += '[/rms-funs]';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();