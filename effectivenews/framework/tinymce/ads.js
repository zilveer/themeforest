(function() {
    tinymce.create('tinymce.plugins.ads', {
        init : function(ed, url) {
            ed.addButton('ads', {
                title : 'Insert Ad',
                image : url+'/images/ads.png',
                onclick : function() {
// triggers the thickbox
						var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 720 < width ) ? 720 : width;
						W = W - 80;
						H = H - 84;
						tb_show( 'ads', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=ads-form' );
						                }
            });
        },
        createControl : function(n, cm) {
            return null;
        }
    });
    tinymce.PluginManager.add('ads', tinymce.plugins.ads);
    
    // executes this when the DOM is ready
	jQuery(function($){
		// creates a form to be displayed everytime the button is clicked
		// you should achieve this using AJAX instead of direct html code like this
		var form = jQuery('<div id="ads-form">\
		<div class="mom_tiny_form">\
		    <div class="mom_tiny_form_element">\
			<div class="mom_tiny_desc">\
			<div class="mom_td_bubble">\
			    <label for="ads-id">Select Ad</label>\
			    <span>select the ad</span>\
			</div>\
			</div>\
			<div class="mom_tiny_input">\
			<select name="type" id="ads-id">\
			'+$ads+'\
			</select>\
			</div>\
			<div class="clear"></div>\
		    </div>\
		    <!-- end element -->\
		</div><!-- end form -->\
		<div class="mom_submit_form">\
			<input type="button" id="ads-submit" class="button-primary" value="Save" name="submit" />\
		</div>\
		</div>');
		var table = form.find('.mom_tiny_form');
		form.appendTo('body').hide();
		// handles the click event of the submit button
		form.find('#ads-submit').click(function(){
			// defines the options and their default values
			// again, this is not the most elegant way to do this
			// but well, this gets the job done nonetheless
	    var shortcode = '';
	    var ad = $('#ads-id').val();

			shortcode = '[ad id="'+ad+'"]';
			
			// inserts the shortcode into the active editor
			tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
			
			// closes Thickbox
			tb_remove();
		});
	});
})();
