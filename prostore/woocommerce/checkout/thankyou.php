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
 * @package 	proStore/woocommerce/checkout/thankyou.php
 * @sub-package WooCommerce/Templates/checkout/thankyou.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce; ?>

<?php if ($order) : ?>

	<?php if (in_array($order->status, array('failed'))) : ?>

		<div class="checkout">
			
			<ul class="woocommerce_message alert alert-box hide-on-print">
				<li><span class="alert-color"><em class="icon-cancel"></em></span></li>
				<li><p><?php _e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce'); ?></p></li>
			</ul>
		
			<p><?php _e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'woocommerce'); ?></p>
	
			<p><?php
				if (is_user_logged_in()) :
					_e('Please attempt your purchase again or go to your account page.', 'woocommerce');
				else :
					_e('Please attempt your purchase again.', 'woocommerce');
				endif;
			?></p>
		
			<p>
				<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay large success">><em class="icon-money"></em> <?php _e('Pay', 'woocommerce') ?></a>
				<?php if (is_user_logged_in()) : ?>
				<a href="<?php echo esc_url( get_permalink(woocommerce_get_page_id('myaccount')) ); ?>" class="button pay large"><em class="icon-user"></em> <?php _e('My Account', 'woocommerce'); ?></a>
				<?php endif; ?>
			</p>
						
			<div class="panel payment_method">
				<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
			</div>
		</div>

	<?php else : ?>
	
		<?php 
			do_action( 'woocommerce_thankyou', $order->id ); 	
		?>
		
		<div class="checkout">
			
			<ul class="woocommerce_message success alert-box hide-on-print">
				<li><span class="success-color"><em class="icon-ok"></em></span></li>
				<li><p><?php _e('Thank you. Your order has been received.', 'woocommerce'); ?></p></li>
			</ul>
		
			<ul class="order_details">
				<li class="order">
					<?php _e('Order:', 'woocommerce'); ?>
					<strong><?php echo $order->get_order_number(); ?></strong>
				</li>
				<li class="date">
					<?php _e('Date:', 'woocommerce'); ?>
					<strong><?php echo date_i18n(get_option('date_format'), strtotime($order->order_date)); ?></strong>
				</li>
				<li class="total">
					<?php _e('Total:', 'woocommerce'); ?>
					<strong><?php echo $order->get_formatted_order_total(); ?></strong>
				</li>
				<?php if ($order->payment_method_title) : ?>
				<li class="method">
					<?php _e('Payment method:', 'woocommerce'); ?>
					<strong><?php
						echo $order->payment_method_title;
					?></strong>
				</li>
				<?php endif; ?>	
			</ul>	
			
			<?php do_action('custom_thankyou', $order->id ); ?>
			
			<div class="panel payment_method">
				<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
			</div>
		
			<script type="text/javascript">
				function newPopup(url) {
					popupWindow = window.open(
					url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
				}
			</script>

			<p class="text-center">
				<a href="JavaScript:newPopup('<?php the_permalink() ?>?order=<?php echo $_GET['order']; ?>&key=<?php echo $_GET['key']; ?>&disp=print');" rel="nofollow" title="Printable order" class="printable_version button large alert hide-on-print"><em class="icon-print"></em> Printable Version</a>
			</p>	
		</div>

	<?php endif; ?>

<?php else : ?>	

	<ul class="woocommerce_message success alert-box" style="margin-bottom:30px;">
		<li><span class="success-color"><em class="icon-ok"></em></span></li>
		<li><p><?php _e('Thank you. Your order has been received.', 'woocommerce'); ?></p></li>
	</ul>

<?php endif; ?>