<?php
/**
 * Default page template - all the pages by default use this template unless another page template has been assigned.
 */
get_header();

		
		//create a data object that will be used globally by the other files that are included
		$pex_page=new stdClass();
		$pex_page->layout='full';
		$pex_page->slider='none';
		$pex_page->sidebar='default';
		
		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
    	wp_reset_postdata();
    	
    
	woocommerce_content();

//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>

