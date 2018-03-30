<?php
/**
 * Default page template - all the pages by default use this template unless another page template has been assigned.
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
    	
    if($page_settings['show_title']=='on'){?>
    	<h1 class="page-heading"><?php the_title(); ?></h1><div class="double-line"></div>	
    <?php }
    
	the_content();
	wp_link_pages();

	echo pexeto_get_share_btns_html($post->ID, 'page');
	}
	
	if(get_opt('_page_comments')!='off'){
	//include the comments template
	comments_template(); 
	}
}

//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>

