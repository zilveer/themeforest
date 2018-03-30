(function() {
   tinymce.create('tinymce.plugins.pricing', {
      init : function(ed, url) {
         ed.addButton('pricing', {
            title : 'Pricing',
            image : url+'/pricing.png',
            onclick : function() {
               // triggers the thickbox
                var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
                W = W - 80;
                H = H - 84;
                tb_show( 'Pricing Shortcode', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=pricing-form' );
            }
         });
      },
      createControl : function(n, cm) {
         return null;
      },
      getInfo : function() {
         return {
            longname : "Pricing",
            author : 'RMS IT',
            authorurl : 'http://www.themeonlab.com',
            infourl : 'http://www.themeonlab.com',
            version : "1.0"
         };
      }
   });
   tinymce.PluginManager.add('pricing', tinymce.plugins.pricing);
   // executes this when the DOM is ready
	jQuery(function(){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="pricing-form"><table id="pricing-table" class="form-table">\
			<tr>\
				<th><label for="pricing_slider">Aricing Shortcode</label></th>\
				<td><small>\
                                Please Press Insert button. You will get a Demo Shortcode.<br/>\
                                Edit the shortcode Title and ammount to achive your requirement<br/><br/>\
                                [rms-pricgroup width="one_third"]<br/>\
                                [rms-priceheading amount="" title=""][/rms-priceheading]<br/>\
                                [rms-pricefull]<br/>\
                                [rms-pricedata]Fast activations[/rms-pricedata]<br/>\
                                [rms-pricedata]100&amp; uptime[/rms-pricedata]<br/>\
                                [rms-pricedata]Branded cpanel[/rms-pricedata]<br/>\
                                [/rms-pricefull]<br/>\
                                [/rms-pricgroup]<br/>\
                                </small></td>\
			</tr>\
		</table>\
		<p class="submit">\
			<input type="button" id="pricing_submit" class="button-primary" value="Insert Tab" name="submit" />\
		</p>\
		</div>');
		
		var table = form.find('table');
		form.appendTo('body').hide();
		
		// handles the click event of the submit button
		form.find('#pricing_submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
			var shortcode = '[rms-pricgroup width="one_third"]';
                            shortcode += '[rms-priceheading amount="" title=""][/rms-priceheading]';
                            shortcode += '[rms-pricefull]';
                            shortcode += '[rms-pricedata]Fast activations[/rms-pricedata]';
                            shortcode += '[rms-pricedata]100&amp; uptime[/rms-pricedata]';
                            shortcode += '[rms-pricedata]Branded cpanel[/rms-pricedata]';
                            shortcode += '[/rms-pricefull]';
                            shortcode += '[/rms-pricgroup]';
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			// closes Thickbox
			tb_remove();
		});
	});
})();