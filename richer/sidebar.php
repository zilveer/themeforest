<div id="sidebar" class="span3">
	<?php 
	
	if(is_page()){
		/* Page Sidebar */
		$name = get_post_meta($post->ID, 'sbg_selected_sidebar_replacement', true);
		if($name) {
			generated_dynamic_sidebar($name[0]);
		}
	} else {
		/* Blog Sidebar */
		if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('Blog Widgets') );
	}
	?>
</div>