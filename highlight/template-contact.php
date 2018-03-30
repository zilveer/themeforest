<?php
/*
 Template Name: Contact form page
 This page template displays the content and after that - a contact form.
 */

get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		$subtitle=get_post_meta($post->ID, 'subtitle_value', true);
		$intro=get_post_meta($post->ID, 'intro_value', true);
		$slider=get_post_meta($post->ID, 'slider_value', $single = true);
		$slider_prefix=get_post_meta($post->ID, 'slider_name_value', true);
		if($slider_prefix=='default'){
			$slider_prefix='';
		}
		$layout=get_post_meta($post->ID, 'layout_value', true);
		if($layout==''){
			$layout='right';
		}
		$show_title=get_opt('_show_page_title');
		$sidebar=get_post_meta($post->ID, 'sidebar_value', $single = true);
		if($sidebar==''){
			$sidebar='default';
		}
		
		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );
		
		 if($show_title!='off'){?>
    	<h1 class="page-heading"><?php the_title(); ?></h1><hr/>	
    <?php }
	
	the_content();
	
	//include the contact template
	locate_template( array( 'includes/form.php'), true, true );
	}
}

//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();
?>

