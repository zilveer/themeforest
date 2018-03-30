<?php
/**
 * The template for displaying archives.
 */
get_header(); ?>

	<?php $style = get_option( 'krown_blog_style', 'modern' ); ?>

	<div id="posts-container" class="<?php echo $style; ?> clearfix">

		<?php while ( have_posts() ) : the_post();

			if ( isset ( $style ) && $style == 'classic' ) {
				get_template_part( 'content-classic' );
			} else {
				get_template_part( 'content' );
			}
			
		endwhile; ?>

	</div>

	<div class="infinite-barrier"><span class="preloader"></span><p class="end"><?php _e( 'No More Posts', 'krown' ); ?></p><a id="infinite-link" href="<?php echo next_posts( 0, false ); ?>"><?php _e( 'Load More Posts', 'krown' ); ?></a></div>

<?php get_footer(); ?>