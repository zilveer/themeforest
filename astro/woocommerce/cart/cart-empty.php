<?php
/**
 * Empty cart page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<p><h5><?php _e( 'Your cart is currently empty.', 'astro' ) ?></h5></p>

<?php do_action('woocommerce_cart_is_empty'); ?>

<p>
	<a class="button" href="<?php echo get_permalink(woocommerce_get_page_id('shop')); ?>">
		<?php _e( '&larr; Return To Shop', 'astro' ) ?>
	</a>
</p>
<div class="cart_related">
<?php
	echo '<div class="prk_titlify_father"><h3 class="zero_color small">';
	_e( 'Recent Products', 'astro' );
	echo '</h3></div>';
	echo do_shortcode('[recent_products per_page="3" columns="3"]');
?>
</div>