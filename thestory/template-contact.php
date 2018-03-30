<?php
/*
 Template Name: Contact form page
 This page template displays the content and after that - a contact form.
 */

get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		
		//get all the page meta data (settings) needed (function located in functions/meta.php)
		$pexeto_page=pexeto_get_post_meta($post->ID, array('slider','layout','header_display','sidebar'));
		
		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
	
	?><div class="content-box"><?php 

	the_content();
	
	//include the contact template
	locate_template( array( 'includes/contact-form.php'), true, true );

	?></div><?php
	}
}

//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>

