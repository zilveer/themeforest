<?php
/**
 * Related Carousel Products
 * @version     5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $product;

$related = $product->get_related( theme_get_option('advanced','woocommerce_related_products_number'));

if ( sizeof( $related ) === 0 ) return;

$related_ids = implode(',', $related);

?>


<div class="related products">
	<?php echo do_shortcode('[product_carousel title="<h2>'.__( 'Related Products', 'woocommerce' ).'</h2>" ids="'.$related_ids.'" nav="true"]');?>
</div>
