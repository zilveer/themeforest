<?php
/**
 * The template for displaying all single posts.
 *
 * @package berg-wp
 */

get_header(); ?>

<?php while ( have_posts() ) : the_post(); ?>
<?php

	$post_meta = get_post_meta(get_the_ID());
	if (isset($post_meta['post_template'][0])) {
		$post_template = $post_meta['post_template'][0];

		if ($post_template != 'default' && $post_template != '') {
			if ($post_template == 'post_template_2') {
				get_template_part( 'content', 'single2' ); 
			} else {
				get_template_part( 'content', 'single' ); 
			}
		} else {
			if (YSettings::g('berg_post_template') == 1) {
				get_template_part( 'content', 'single' );
			} else {
				get_template_part( 'content', 'single2' ); 
			}
		}
	} else {
		get_template_part( 'content', 'single' ); 
	}

	if ( comments_open() || '0' != get_comments_number() ) {
		comments_template();	
	}

?>

<?php endwhile; // end of the loop. ?>

<?php
	berg_getFooter();
	get_template_part('footer'); 
?>