<?php

if (function_exists('dynamic_sidebar')) :

	if (get_post_type() == 'video-items'){
		
			dynamic_sidebar('default-sidebar');
			dynamic_sidebar('videos-sidebar');
		
	} else if (is_page()){
		
			dynamic_sidebar('default-sidebar');
			dynamic_sidebar('page-sidebar');
		
	} else if (is_single() || is_archive() || is_category() || is_search()){
		
			dynamic_sidebar('default-sidebar');
			dynamic_sidebar('post-sidebar');
		
	} else {
	
		dynamic_sidebar('default-sidebar');
	
	}


endif;

?>