<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Idylle
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php
			if ( is_single()) {

			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php idylle_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->



	<div class="entry-content">

		<?php if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) { ?>

		    <div class="post-thumb">
				<a class="post-url" title="<?php get_the_title(); ?>" href="<?php esc_url(the_permalink()); ?>">
					<?php the_post_thumbnail('idylle-blog-thumb'); ?>
				</a>
			</div>

		<?php } ?>

		<?php if( !is_singular() ) : ?>
			<?php the_excerpt(); ?>
		<?php else: ?>
		<?php
			the_content( sprintf(
				/* translators: %s: Name of current post. */
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'idylle' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'idylle' ),
				'after'  => '</div>',
			) );
		?>
		<?php endif; ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php idylle_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

