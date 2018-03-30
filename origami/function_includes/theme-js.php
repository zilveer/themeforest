<?php
if (!is_admin()) add_action( 'wp_print_scripts', 'themeteam_add_javascript' );
function themeteam_add_javascript( ) {
	wp_enqueue_script('jquery');
	
	wp_enqueue_script( 'preload', get_bloginfo('template_directory').'/js/jquery.preload.js', array( 'jquery' ) );
	wp_enqueue_script( 'easyslider', get_bloginfo('template_directory').'/js/easySlider1.7.js', array( 'jquery' ) );
	wp_enqueue_script( 'tweetable', get_bloginfo('template_directory').'/js/jquery.tweetable.js', array( 'jquery' ) );
	wp_enqueue_script( 'galleria', get_bloginfo('template_directory').'/js/galleria/galleria.js', array( 'jquery' ) );
	wp_enqueue_script( 'prettyphoto', get_bloginfo('template_directory').'/js/prettyphoto/js/jquery.prettyPhoto.js', array( 'jquery' ) );
	wp_enqueue_script( 'nivo', get_bloginfo('template_directory').'/js/nivoslider/jquery.nivo.slider.pack.js', array( 'jquery' ) );
	wp_enqueue_script( 'toolsmin', get_bloginfo('template_directory').'/js/jquery.tools.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'cycle', get_bloginfo('template_directory').'/js/jquery.cycle.all.min.js', array( 'jquery' ) );
	wp_enqueue_script( 'js', get_bloginfo('template_directory').'/js/js.js', array( 'jquery' ) );
	
	
}
?>
