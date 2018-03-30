<?php

function theme_register_js() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_register_script('modernizr', get_template_directory_uri() . '/js/modernizr-2.0.6.min.js', 'jquery');
		wp_register_script('superfish', get_template_directory_uri() . '/js/superfish.js', 'jquery');
		wp_register_script('prettyPhoto', get_template_directory_uri() . '/js/jquery.prettyPhoto.js', 'jquery');
		wp_register_script('masonry', get_template_directory_uri() . '/js/jquery.masonry.min.js', 'jquery');
		wp_register_script('slides', get_template_directory_uri() . '/js/slides.min.jquery.js', 'jquery');
		wp_register_script('jplayer', get_template_directory_uri().'/js/jquery.jplayer.min.js', 'jquery');
		wp_register_script('theme_custom', get_template_directory_uri() . '/js/functions.js', 'jquery', '1.0', TRUE);
		
		//Default On Scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('modernizr');
		wp_enqueue_script('superfish');
		wp_enqueue_script('prettyPhoto');
		wp_enqueue_script('jplayer');
		wp_enqueue_script('masonry');
		wp_enqueue_script('slides');
		wp_enqueue_script('theme_custom');
		
	}
}
add_action('init', 'theme_register_js');
	
	
// load single scripts only on single pages
function theme_single_scripts() {
	if(is_singular()) wp_enqueue_script( 'comment-reply' ); // loads the javascript required for threaded comments 
}
add_action('wp_print_scripts', 'theme_single_scripts');



/*-----------------------------------------------------------------------------------*/
/*	Register and load admin javascript
/*-----------------------------------------------------------------------------------*/

function theme_admin_js($hook) {
	if ($hook == 'post.php' || $hook == 'post-new.php') {
		wp_register_script('theme-admin', get_template_directory_uri() . '/js/functions.admin.js', 'jquery');
		wp_enqueue_script('theme-admin');
	}
}
add_action('admin_enqueue_scripts','theme_admin_js',10,1);
					
?>