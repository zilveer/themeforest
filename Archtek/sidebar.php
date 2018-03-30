<?php
    
    $sidebar = '';
    
    // If it's a blog page
    if((is_home() || is_archive() || is_single()) && !is_tax()) {
        
		$sidebar = 'right';
		if ( function_exists( 'ot_get_option' ) ) {
        	$sidebar = ot_get_option('uxbarn_to_setting_blog_sidebar');
		}
        
        if($sidebar != '') {
            $sidebar = 'blog-widget-area';
        }
        
    } else if(is_search()) {
        
        $sidebar = 'search-result-widget-area';
        
    } else { // For a normal page
        
        $sidebar = uxbarn_get_array_value(get_post_meta($post->ID, 'uxbarn_setting_select_custom_sidebar'), 0);
    	
    }
    
    dynamic_sidebar($sidebar);
        
?>