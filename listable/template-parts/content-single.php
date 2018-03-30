<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Listable
 */

$has_image = false; ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-featured"></div>
		<div class="header-content">
			<div class="entry-meta">
				<?php
				listable_posted_on();

				$post_categories = wp_get_post_categories( $post->ID );
				if ( ! is_wp_error( $post_categories ) ) {
					foreach ( $post_categories as $c ) {
						$cat = get_category( $c );
						echo '<a class="category-link" href="' . esc_sql( get_category_link( $cat->cat_ID ) ) . '">' . $cat->name . '</a>';
					}
				} ?>

			</div><!-- .entry-meta -->
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<span class="entry-subtitle"><?php echo get_the_excerpt(); ?></span>

			<?php if ( function_exists( 'sharing_display' ) ) : ?>
				<?php sharing_display( '', true ); ?>
			<?php endif; ?>
		</div>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'listable' ),
			'after'  => '</div>',
		) );
		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->

