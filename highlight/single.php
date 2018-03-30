<?php
/**
 * Single Post Template - this is the template for the single blog post.
 */
get_header();

if(have_posts()){
	while(have_posts()){
		the_post();
		$subtitle=get_post_meta($post->ID, 'subtitle_value', true);
		$slider='none';
		$layout=get_opt('_blog_layout');
		$sidebar=get_opt('_blog_sidebar');
		
		//include the before content template
		locate_template( array( 'includes/html-before-content.php'), true, true );

		//include the post template
		locate_template( array( 'includes/post-template.php'), true, false );
	}
} 

//include the comments template
comments_template(); 

//include the after content template
locate_template( array( 'includes/html-after-content.php'), true, true );

get_footer();   ?>
