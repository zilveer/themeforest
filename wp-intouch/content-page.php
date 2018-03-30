<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage InTouch
 * @since InTouch 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
	</header>

	<div class="entry-content clearfix">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'color-theme-framework' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<footer class="page-entry-meta">
		<?php edit_post_link( __( 'Edit', 'color-theme-framework' ), '<span class="edit-link"><i class="icon-pencil"></i>', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
