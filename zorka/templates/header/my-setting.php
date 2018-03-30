<?php
/**
 * Created by PhpStorm.
 * User: hoantv
 * Date: 2015-04-15
 * Time: 10:22 AM
 */

if ( !class_exists( 'WooCommerce' ) ) {
	return;
}
global $woocommerce;
$myaccount_page_id = woocommerce_get_page_id('myaccount');
$myaccount_page_url = '';
if ( $myaccount_page_id ) {
	$myaccount_page_url = get_permalink( $myaccount_page_id );
}

?>
<ul class="my-setting">
	<li>
		<span><?php esc_html_e('My Settings','zorka') ?> <i class="fa fa-angle-down"></i></span>
		<ul>
			<?php if (!empty($myaccount_page_url)): ?>
				<li><a href="<?php echo esc_url($myaccount_page_url) ?>"><i class="fa fa-user"></i> <?php esc_html_e('My Account','zorka'); ?></a></li>
			<?php endif;?>
			<?php if (class_exists( 'YITH_WCWL' ) ):?>
				<li><a href="<?php echo esc_url(YITH_WCWL::get_instance()->get_wishlist_url())?>"><i class="fa fa-heart"></i> <?php esc_html_e('Wish List','zorka') ?></a></li>
			<?php endif;?>
			<li><a href="<?php echo esc_url($woocommerce->cart->get_cart_url()) ?>"><i class="fa fa-shopping-cart"></i> <?php esc_html_e('Shopping Cart','zorka'); ?></a></li>
			<li><a href="<?php echo esc_url($woocommerce->cart->get_checkout_url()) ?>"><i class="fa fa-share"></i> <?php esc_html_e('Checkout','zorka'); ?></a></li>
		</ul>
	</li>
</ul>