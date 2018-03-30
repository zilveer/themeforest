<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package metcreative
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content single-page">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'metcreative' ), 'after' => '</div>' ) ); ?>
		<div class="clearfix"></div>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
<div class="clearfix"></div>