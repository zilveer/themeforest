<?php
/**
 * @package unicase
 */

$additional_post_classes = apply_filters( 'unicase_additional_post_classes', array() );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_post_classes ); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

	<?php
		$post_format = get_post_format();
		if( $post_format != 'quote' && $post_format != 'link' ) :

			unicase_post_thumbnail( 'unicase_blog-carousel-thumb' );
			unicase_post_header();
			unicase_post_excerpt();
			unicase_post_readmore();
		elseif( $post_format != 'aside' && $post_format != 'status') :
			unicase_post_thumbnail( 'unicase_blog-carousel-thumb' );
			unicase_post_excerpt();
			unicase_post_readmore();
		else :
			get_template_part( 'templates/contents/content', get_post_format() );
		endif;
	?>

</article><!-- #post-## -->