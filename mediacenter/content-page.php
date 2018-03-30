<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package mediacenter
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php
	/**
	 * @hooked mc_display_page_header - 10
	 * @hooked mc_page_content - 20
	 */
	do_action( 'mc_page' );
	?>

</div><!-- #post-<?php the_ID(); ?> -->