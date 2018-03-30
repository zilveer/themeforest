(function() {	

			jQuery('.sc_mask ,.sc_close_modal').live('click', function () {
				jQuery('.sc_mask').remove();
				jQuery('.sc_modal_container').remove();
			});
			
			jQuery('.sc_slide_body').hide();
			jQuery('.sc_page').hide();
			
			jQuery('.sc_activate_nav li a').live('click', function () {
				jQuery('.sc_activate_nav li a').removeClass('active');

				jQuery(this).addClass('active');

				var page = jQuery(this).attr('href');

				jQuery('.sc_slide_body').hide();

				jQuery('.sc_page').hide();

				jQuery(page).fadeIn(100);

				return false;
			});
	
	
    tinymce.create('tinymce.plugins.SC_button', {
        /**
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        init : function(ed, url) {

		
			
			
			ed.addCommand(
			  'shortcodeButton',
			  function() {
				/**
				 * @param Object Popup settings
				 * @param Object Arguments to pass to the Popup
				 */
				 
				 
				modal = jQuery('#my_plugin_dialog').clone().html();
				jQuery('body').prepend('<div class="sc_mask"></div>');
					
					var maskHeight = jQuery(document).height();
					var maskWidth = jQuery(window).width();
					jQuery('.sc_mask').css({'width':maskWidth,'height':maskHeight});
					jQuery('.sc_mask').fadeTo("slow",0.6); 	
					jQuery('body').prepend('<div class="sc_modal_container"><div class="sc_modal_header">Shortcodes<span class="sc_close_modal">x</span></div></div>');
					jQuery(modal).appendTo('.sc_modal_container');
					var winH = jQuery(window).height();
					var winW = jQuery(window).width();
					jQuery('.sc_modal_container').css('top',  winH/2-jQuery('.sc_modal_container').height()/2);
					jQuery('.sc_modal_container').css('left', winW/2-jQuery('.sc_modal_container').width()/2);
					jQuery('.my_sc_title').click( function() {
						var sc = jQuery(this).next('.my_shortcode_text').html();
						
						ed.selection.setContent(sc);
						var sc = '';
						jQuery('.sc_mask').detach();
						jQuery('.sc_modal_container').detach();
					});
			  }
			);
			
			
		 ed.addButton('shortcodeButton', {
                title : 'Shortcode',
                cmd : 'shortcodeButton',
                image : url + '/sc_button.png'
            });
			
			
			
			
	
        },

       
        createControl : function(n, cm) {
            return null;
        },

        
        getInfo : function() {
            return {
                    longname : 'Shortcode Buttons',
                    author : '',
                    authorurl : '',
                    infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                    version : ""
            };
        }
    });

    tinymce.PluginManager.add('sc_button', tinymce.plugins.SC_button);
})();