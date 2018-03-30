<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage Morphis
 * 
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php // yoast breadcrumb integration
		if ( function_exists('yoast_breadcrumb') ) {
		   yoast_breadcrumb('<div id="breadcrumbs">','</div><hr />');		   
		}
	?>
	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'morphis' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<div class="clear"></div>
	<footer class="entry-meta">
		<div class="clear"></div>
		<?php edit_post_link( __( 'Edit', 'morphis' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->

