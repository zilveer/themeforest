<?php

if ( !function_exists( 'om_custom_front_javascript' ) ) {
	function om_custom_front_javascript() {
		
		$jquery='';
		
		// Lightbox
		$lightbox=get_option(OM_THEME_PREFIX . 'prettyphoto_lightbox');
		if(!$lightbox)
			$lightbox='enabled';
			
		if($lightbox == 'enabled') {
			$social_tools=get_option(OM_THEME_PREFIX . 'prettyphoto_social_tools');
			$overlay_gallery=get_option(OM_THEME_PREFIX . 'prettyphoto_overlay_gallery');
			
			$args=array();
			if(get_option(OM_THEME_PREFIX . 'prettyphoto_social_tools') != 'true')
				$args[]='social_tools: ""';
			if(get_option(OM_THEME_PREFIX . 'prettyphoto_show_title') == 'false')
				$args[]='show_title: false';
			if(get_option(OM_THEME_PREFIX . 'prettyphoto_overlay_gallery') == 'true')
				$args[]='overlay_gallery: true';
			else
				$args[]='overlay_gallery: false';
				
			$jquery.='lightbox_init({'.implode(',',$args).'});';
		}
		
		// Sidebar Sliding

		if(get_option(OM_THEME_PREFIX."sidebar_sliding") == 'true') {
			$jquery.='sidebar_slide_init();';
		}
	
		if($jquery)
			echo '<script>jQuery(function(){'.$jquery.'});</script>';
		
	}
	
	add_action('wp_head', 'om_custom_front_javascript');
}

