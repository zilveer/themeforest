<?php
/**
 *  single blog posts
 * 
 * @package toranj
 * @author owwwlab
 */
$blog_options = owlab_get_blog_options();

if ( have_posts() ) : while( have_posts() ) : the_post();

			
//which layout should we use here
switch (ot_get_option('single_blog_post_layout')) {
	case 'full':
		include(locate_template(OWLAB_TEMPLATES . '/blog/single-full.php'));
		break;

	case 'regular':
		include(locate_template(OWLAB_TEMPLATES . '/blog/single-regular.php'));
		break;

	default:
		# code...
		break;
}

endwhile; endif; 
?>