<?php
/**
 * @package unicase
 */

$additional_post_classes = apply_filters( 'unicase_additional_post_classes', array() );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_post_classes ); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

	<?php
	/**
 	 * @hooked unicase_post_header() - 10
 	 * @hooked unicase_post_meta() - 20
 	 * @hooked unicase_post_content() - 30
	 */
	do_action( 'unicase_loop_post' );
	?>

</article><!-- #post-## -->