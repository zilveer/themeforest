<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WPCharming
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (is_home()) { ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php } ?>

	<?php
	$enable_page_header = get_post_meta( $post->ID, '_wpc_enable_page_header', true );
	$hide_page_title    = get_post_meta( $post->ID, '_wpc_hide_page_title', true );
	if ( $hide_page_title != 'on' ) {
		?>
		<h1 class="page-entry-title"><?php the_title(); ?></h1>
		<?php
	}
	?>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'wpcharming' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
