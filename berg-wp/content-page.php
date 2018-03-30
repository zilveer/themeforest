<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package berg-wp
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages(array(
				'before' => '<div class="page-links">' . __('Pages:', 'BERG'),
				'after'  => '</div>',
			));
		?>
	</div>
	<footer class="entry-footer">
		<?php edit_post_link( __( 'Edit', 'BERG'), '<span class="edit-link">', '</span>' ); ?>
	</footer>
</article>