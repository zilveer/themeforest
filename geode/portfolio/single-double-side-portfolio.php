<?php
/**
 * @package WordPress
 * @subpackage Geode
 * @since Geode 1.0
 */

get_header(); ?>

<?php get_template_part( 'title', 'post' ); ?>
<div class="site-content cf site-main double-side-template">

	<?php geode_sidebar('left'); ?>

	<div id="primary" class="alignleft" data-delay="0">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'portfolio/content', get_post_format() ); ?>
				<?php geode_related_posts(); ?>
				<?php comments_template( '', true ); ?>
			<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->

	<?php geode_sidebar('right'); ?>
	
</div><!-- .site-content -->

<?php get_footer(); ?>

