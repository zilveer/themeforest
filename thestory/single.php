<?php
/**
 * Single Post Template - this is the template for the single blog post.
 */

get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		//get all the page data needed and set it to an object that can be used in other files
		$pexeto_page=array();
		$pexeto_page['sidebar']=pexeto_option( 'post_sidebar' );
		$pexeto_page['slider']='none';
		$pexeto_page['layout']=pexeto_option( 'post_layout' );
		

		$pexeto_page['style'] = pexeto_get_single_meta($post->ID, 'post_style');
		if($pexeto_page['style'] === 'header'){
			$pexeto_page['header_display'] = array('show_title'=>true);
			$pexeto_page['title']=$post->post_title;
			$pexeto_page['subtitle'] =  pexeto_get_single_meta($post->ID, 'subtitle');
			$pexeto_page['hide_thumbnail'] = true;
			$pexeto_page['hide_title'] = true;
		}else{
			$pexeto_page['header_display'] = array('show_title'=>false);
			$pexeto_page['title']='';
		}

		//include the before content template
		locate_template( array( 'includes/html-before-content.php' ), true, true );

		//include the post template
		locate_template( array( 'includes/post-template.php' ), true, false );

		//include the comments template
		comments_template();
	}
}

//include the after content template
locate_template( array( 'includes/html-after-content.php' ), true, true );

get_footer();   ?>
