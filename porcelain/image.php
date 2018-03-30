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
		$pexeto_page['slider']='none';
		$pexeto_page['show_title']=true;
		$pexeto_page['layout']='full';

		//include the before content template
		locate_template( array( 'includes/html-before-content.php' ), true, true );
		?>
		<div class="content-box">
		<img src="<?php echo wp_get_attachment_url(); ?>" alt="<?php the_title(); ?>"/>

		<?php

		the_content();

		?>
		</div>
		<?php

		//include the comments template
		comments_template();
	}
}



//include the after content template
locate_template( array( 'includes/html-after-content.php' ), true, true );

get_footer();   ?>
