<?php
/*
 Template Name: Home page
 Displays the content of the page and three services boxes after that.
 */

get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		$subtitle=get_post_meta($post->ID, 'subtitle_value', true);
		$intro=get_post_meta($post->ID, 'intro_value', true);
		$slider=get_post_meta($post->ID, 'slider_value', true);	
		$slider_prefix=get_post_meta($post->ID, 'slider_name_value', true);
		if($slider_prefix=='default'){
			$slider_prefix='';
		} 
		$sidebar='right';
		$layout='full';

		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
		the_content();
	}
}

echo pexeto_services_boxes();

//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>