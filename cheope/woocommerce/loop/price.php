<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
?>

<?php if ($price_html = $product->get_price_html()) : ?>
	<span class="price"><?php echo $price_html; ?></span>
	<a class="read-more" href="<?php the_permalink() ?>"><?php echo apply_filters( 'yit_shop_loop_read_more_text', __( 'Read More', 'yit' ) ) ?></a>
<?php endif; ?>