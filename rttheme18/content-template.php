<?php
/**
 * 
 * Template Contents 
 * displays output of a template
 * 
 * 
 * Customization Tip :  if( $rt_templateID == "your_template_id" ) { echo 'do something' }
 *
 */ 
get_header(); ?>
 
	<?php   
		//get the content
		do_action( 'get_content_output' );
	?>

<?php get_footer(); ?>