/*
*
*	SHORTCODE ADD BUTTON
*
*/	
jQuery(function($){
	 
	//add editor shortcut button
	if( "undefined"!=typeof tinymce ){ 

		tinymce.create('tinymce.plugins.rt_theme_shortcodes', {
			init : function(ed, url) {

				ed.addButton('rt_themeshortcode', {
					title : 'Theme Shortcodes',
					image : url+'/../images/theme-shorcodes.png', 
					onclick : function() {
							jQuery( "#wp-admin-bar-rt_shortcode_helper_button").trigger("click");
					}
				});				
			},
			createControl : function(n, cm) {
				return null;
			},
			getInfo : function() {
				return {
					longname : "Shortcodes",
					author : 'RT-Theme',
					version : "1.0"
				};
			}
		});
		tinymce.PluginManager.add('rt_themeshortcode', tinymce.plugins.rt_theme_shortcodes);
	}	

});