<?php
/**
 * @package unicase
 */

$additional_post_classes = apply_filters( 'unicase_additional_post_classes', array() );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_post_classes ); ?> itemscope="" itemtype="http://schema.org/BlogPosting">
	<?php
		$post_format = get_post_format();
		if( $post_format != 'quote' && $post_format != 'link' && $post_format != 'aside' && $post_format != 'status' ):

		/**
		* @hooked unicase_post_header - 10
		* @hooked unicase_post_meta - 20
		* @hooked unicase_post_content - 30
		*/
		do_action( 'unicase_single_post' );
	else : 
			unicase_post_content();
	endif;
	?>

</article><!-- #post-## -->
