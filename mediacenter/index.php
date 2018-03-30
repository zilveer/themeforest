<?php
/*
 * The template for displaying Blog Posts
 */
	get_header(); 
?>

<?php

	$blog_layout = media_center_blog_layout();

	if ( $blog_layout == 'without_sidebar' ) {

		$full_width_density = media_center_blog_fw_density();

		if ( $full_width_density == 'wide' ) {
			get_template_part( 'templates/layouts/blog-fullwidth-wide' );
		} else {
			get_template_part( 'templates/layouts/blog-fullwidth-narrow' );
		}

	} else if ( $blog_layout == 'sidebar_left' ) {
		get_template_part( 'templates/layouts/blog-sidebar-left' );
	} else{
		get_template_part( 'templates/layouts/blog-sidebar-right' );
	}

?>


<?php get_footer();