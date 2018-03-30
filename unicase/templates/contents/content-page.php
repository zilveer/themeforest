<?php
/**
 * @package unicase
 */

$additional_post_classes = apply_filters( 'unicase_additional_page_post_classes', array() );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_post_classes ); ?>>
	<?php
	/**
	 * @hooked unicase_page_header - 10
	 * @hooked unicase_page_content - 20
	 */
	do_action( 'unicase_page' );
	?>
</article><!-- #post-## -->
