<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Increase loop count
$woocommerce_loop['loop']++;

// Get thumbnail

do_action( 'woocommerce_before_subcategory', $category );

$thumb = get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true );

if ( $thumb != '' ) {
	$img_url = wp_get_attachment_image_src( $thumb, 'full' );
} else {
	$img_url = Array( get_template_directory_uri() . '/images/blank_2.gif' );
}

$retina = krown_retina();
$retina_thumb = '';

$img_factor = '0';
$c = get_option( 'krown_shop_columns', 'four' ) == 'four' ? 324 : ( get_option( 'krown_shop_columns', 'four' ) == 'three' ? 432 : 648 );

if ( get_option( 'krown_shop_style', 'fixed' ) == 'masonry' ) {

	$img_factor = 1;
	$img_width = $c;
	$img_height = null;

} else {

	$img_width = $c;
	$img_height = $img_width / 4 * 3;

}

if ( $retina === 'true' && $retina_thumb != '' ) {

	$retina_url = wp_get_attachment_image_src( $retina_thumb, 'full' );
	$image = aq_resize( $retina_url[0], $img_width*2, $img_height != null ? $img_height*2 : null, false, false );

} else {

	$image = aq_resize( $img_url[0], $img_width, $img_height, true, false );

}  

?>

<li <?php post_class( 'item' ); ?> data-factor="<?php echo $img_factor; ?>">

	<a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>">

		<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php the_title(); ?>" class="image" />

		<div class="caption">

			<div>

				<div>

					<h3><?php echo $category->name; ?></h3>
					<span class="count"><?php echo '(' . $category->count . ')'; ?></span>

					<?php do_action( 'woocommerce_after_subcategory_title', $category ); ?>

				</div>

			</div>

		</div>

	</a>

	<?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</li>