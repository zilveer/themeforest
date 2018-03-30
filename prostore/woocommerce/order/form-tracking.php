<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/woocommerce/order/form-tracking.php
 * @sub-package WooCommerce/Templates/order/form-tracking.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce, $post; ?>

	
	<form action="<?php echo esc_url( get_permalink($post->ID) ); ?>" method="post" class="track_order">
		<div class="row container">	
			<div class="twelve columns">
				<p><?php _e('To track your order please enter your Order ID in the box below and press return. This was given to you on your receipt and in the confirmation email you should have received.', 'woocommerce'); ?></p>
			</div>
		</div>
		<div class="row container">			
			<div class="six columns">
				<label for="orderid"><?php _e('Order ID', 'woocommerce'); ?></label> 
				<input class="input-text" type="text" name="orderid" id="orderid" placeholder="<?php _e('Found in your order confirmation email.', 'woocommerce'); ?>" />
			</div>
			<div class="six columns end">
				<label for="order_email"><?php _e('Billing Email', 'woocommerce'); ?></label> 
				<input class="input-text" type="text" name="order_email" id="order_email" placeholder="<?php _e('Email you used during checkout.', 'woocommerce'); ?>" />
			</div>	
		</div>
		
		<p class="submit-changes text-center">	
			<input type="submit" class="button large" name="track" value="<?php _e('Track"', 'woocommerce'); ?>" /></p>
			<?php $woocommerce->nonce_field('order_tracking') ?>
		</p>
		
	</form>