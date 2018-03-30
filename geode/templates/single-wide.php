<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */

get_header(); ?>

<?php if ( get_post_format()!='aside' && get_post_format() != 'status'  ) {
	get_template_part( 'title', 'post' ); 
} ?>
<div id="primary" class="site-content">
	<div id="content" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
			<?php geode_related_posts(); ?>
			<?php comments_template( '', true ); ?>
		<?php endwhile; // end of the loop. ?>
	</div><!-- #content -->
</div><!-- #primary -->

<?php get_footer(); ?>

