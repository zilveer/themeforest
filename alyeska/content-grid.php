<?php
/**
 * The template used for displaying posts in a grid.
 */
?>
<div class="grid-item column <?php echo themeblvd_get_att( 'size' ); ?><?php if( themeblvd_get_att( 'counter' ) % themeblvd_get_att( 'columns' ) == 0 ) echo ' last'; ?>">
	<div class="article-wrap">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php themeblvd_the_post_thumbnail( themeblvd_get_att( 'location' ), themeblvd_get_att( 'size' ) ); ?>
			<div class="entry-content">
				<?php if( 'show' == themeblvd_get_option( 'post_grid_title', null, 'show' ) ) : ?>
					<h2 class="entry-title"><?php themeblvd_the_title(); ?></h2>
				<?php endif; ?>
				<?php if( 'show' == themeblvd_get_option( 'post_grid_excerpt', null, 'show' ) ) : ?>
					<div class="excerpt">
						<?php the_excerpt(); ?>
					</div>
				<?php endif; ?>
				<?php if( 'show' == themeblvd_get_option( 'post_grid_button', null, 'show' ) ) : ?>
					<div class="read-more-link">
						<?php echo themeblvd_button( themeblvd_get_local( 'read_more' ), get_permalink( get_the_ID() ), 'default', '_self', 'small', 'read-more', get_the_title( get_the_ID() )  ); ?>
					</div>
				<?php endif; ?>
			</div><!-- .entry-content -->
		</article><!-- #post-<?php the_ID(); ?> -->
	</div><!-- .article-wrap (end) -->
</div><!-- .grid-item (end) -->