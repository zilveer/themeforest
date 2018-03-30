<?php
/**
 * 404 Page Template
 */
get_header(); ?>

	<h2><?php _e( 'Uh oh! (404 Error)', 'krown' ); ?></h2>

	<h4><?php _e( 'We are really sorry but the page you requested is missing :(', 'krown' ); ?></h4>

	<?php rewind_posts(); ?>

<?php get_footer(); ?>