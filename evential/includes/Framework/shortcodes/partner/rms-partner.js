(function() {
   tinymce.create('tinymce.plugins.partner', {
      init : function(ed, url) {
         ed.addButton('partner', {
            title : 'Our Partner',
            image : url+'/partner.png',
            onclick : function() {
               // triggers the thickbox
                var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                W = W - 80;
                H = H - 84;
                tb_show( 'Our Partners Logo Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=partner-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Our Partner Logo",
            author : 'RMS IT',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('partner', tinymce.plugins.partner);
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="partner-form"><table id="partner-table" class="form-table">\
			<tr>\
				<th><label for="partner">Our Partners Shortcode</label></th>\
				<td><small>\
                                Please Press Insert button. You will get a Demo Shortcode.<br/>\
                                Edit the shortcode to achive your requirement.<br/><br/>\
                                <strong>Demo Shortcode</strong><br/>\
                                [rms-partners title="GOLD PARTNERS"]<br/>\
                                [rms-partner logo="http://placehold.it/171x100/ffffff&text=LOGO"]<br/>\
                                [rms-partner logo="http://placehold.it/171x100/ffffff&text=LOGO"]<br/>\
                                [rms-partner logo="http://placehold.it/171x100/ffffff&text=LOGO"]<br/>\
                                [/rms-partners]<br/>\
                                </small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="partner_submit" class="button-primary" value="Insert Partner" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#partner_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			
			var shortcode = '[rms-partners title="GOLD PARTNERS"]';
                            shortcode += '[rms-partner logo="http://placehold.it/171x100/ffffff&text=LOGO"]';
                            shortcode += '[rms-partner logo="http://placehold.it/171x100/ffffff&text=LOGO"]';
                            shortcode += '[rms-partner logo="http://placehold.it/171x100/ffffff&text=LOGO"]';
                            shortcode += '[/rms-partners]';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();