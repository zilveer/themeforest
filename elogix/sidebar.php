<?php 
	if(is_page()){
		/* Page Sidebar */
		generated_dynamic_sidebar(); 
	} else {
		/* Blog Sidebar */
		if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Sidebar Widgets') );
	}
?>