<?php
/*
 Template Name: Contact form page
 This page template displays the content and after that - a contact form.
 */

get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		
		//get all the page meta data (settings) needed (function located in lib/functions/meta.php)
		$page_settings=pexeto_get_post_meta($post->ID, array('slider','layout','show_title','sidebar'));
		
		if(!$page_settings['show_title'] || $page_settings['show_title']=='global'){
			$page_settings['show_title']=get_opt('_show_page_title');	
		}
		
		//create a data object that will be used globally by the other files that are included
		$pex_page=new stdClass();
		$pex_page->layout=$page_settings['layout'];
		$pex_page->slider=$page_settings['slider'];
		$pex_page->sidebar=$page_settings['sidebar'];
		
		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
		  wp_reset_postdata();
		 if($page_settings['show_title']!='off'){?>
    	<h1 class="page-heading"><?php the_title(); ?></h1><div class="double-line"></div>	
    <?php }
	
	the_content();
	
	//include the contact template
	locate_template( array( 'includes/contact-form.php'), true, true );
	}
}

//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>

