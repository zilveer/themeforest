<?php if(! defined('ABSPATH')){ return; }

$single_blog_layout = zget_option('sg_layout', 'blog_options', false, 'classic');
if( 'modern' == $single_blog_layout ){
	remove_filter( 'the_content', array( PostLoveHgFrontend::get_instance(), 'display_love_button'), 100 );
}

/**
 * Helper function for displaying the love button
 * @return null
 */
add_action( 'znkl_love_post_area', 'znkl_show_love_button' );
function znkl_show_love_button(){
	echo plhg_get_love_button();
}
