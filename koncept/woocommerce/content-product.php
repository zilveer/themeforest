<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Get thumbnail

$thumb = get_post_thumbnail_id();
$img_url = wp_get_attachment_image_src( $thumb, 'full' );

global $post;

$retina = krown_retina();
$retina_thumb = get_post_meta( $post->ID, 'portfolio_retina-thumbnail_thumbnail_id', true );

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

<li <?php post_class( 'item' ); ?> data-factor=<?php echo $img_factor; ?>>

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

	<a href="<?php the_permalink(); ?>">

		<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php the_title(); ?>" class="image" />

		<div class="caption">

			<div>

				<div>

					<h3><?php do_action( 'woocommerce_shop_loop_item_title' ); ?></h3>
					<span class="category"><?php krown_categories( $post->ID, 'product_cat' ); ?></span>
					<?php woocommerce_get_template( 'loop/price.php' ); ?>

				</div>

			</div>

		</div>

	</a>

	<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

</li>