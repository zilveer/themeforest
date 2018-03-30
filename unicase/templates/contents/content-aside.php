<?php
/**
 * @package unicase
 */

$additional_post_classes = apply_filters( 'unicase_additional_post_classes', array() );

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $additional_post_classes ); ?> itemscope="" itemtype="http://schema.org/BlogPosting">

	<?php unicase_post_content(); ?>

</article><!-- #post-## -->