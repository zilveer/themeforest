<?php
/**
 * Thankyou page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php if ($order) : ?>

	<?php if (in_array($order->status, array('failed'))) : ?>

		<p><?php _e('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction.', 'yit'); ?></p>

		<p><?php
			if (is_user_logged_in()) :
				_e('Please attempt your purchase again or go to your account page.', 'yit');
			else :
				_e('Please attempt your purchase again.', 'yit');
			endif;
		?></p>

		<p>
			<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay"><?php _e('Pay', 'yit') ?></a>
			<?php if (is_user_logged_in()) : ?>
			<a href="<?php echo esc_url( get_permalink(wc_get_page_id('myaccount')) ); ?>" class="button pay"><?php _e('My Account', 'yit'); ?></a>
			<?php endif; ?>
		</p>

	<?php else : ?>

		<p><?php _e('Thank you. Your order has been received.', 'yit'); ?></p>

        <table class="shop_table thankyou">
        	<thead>
            	<tr>
                	<th><?php _e('Order:', 'yit'); ?></th>
                    <th><?php _e('Date:', 'yit'); ?></th>
                    <th><?php _e('Total:', 'yit'); ?></th>
                    <?php if ($order->payment_method_title) : ?>
                    <th><?php _e('Payment method:', 'yit'); ?></th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
            	<tr>
                	<td><?php echo $order->get_order_number(); ?></td>
                	<td><?php echo date_i18n(get_option('date_format'), strtotime($order->order_date)); ?></td>
                	<td><?php echo $order->get_formatted_order_total(); ?></td>
                    <?php if ($order->payment_method_title) : ?>
                	<td><?php echo $order->payment_method_title; ?></td>
                    <?php endif; ?>
                </tr>
            </tbody>
        </table>
		<div class="clear"></div>

		<?php
			/*
			<ul class="order_details">
				<li class="order">
					<?php _e('Order:', 'yit'); ?>
					<strong><?php echo $order->get_order_number(); ?></strong>
				</li>
				<li class="date">
					<?php _e('Date:', 'yit'); ?>
					<strong><?php echo date_i18n(get_option('date_format'), strtotime($order->order_date)); ?></strong>
				</li>
				<li class="total">
					<?php _e('Total:', 'yit'); ?>
					<strong><?php echo $order->get_formatted_order_total(); ?></strong>
				</li>
				<?php if ($order->payment_method_title) : ?>
				<li class="method">
					<?php _e('Payment method:', 'yit'); ?>
					<strong><?php
						echo $order->payment_method_title;
					?></strong>
				</li>
				<?php endif; ?>
			</ul>
			<div class="clear"></div>
			*/
		?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_thankyou_' . $order->payment_method, $order->id ); ?>
	<?php do_action( 'woocommerce_thankyou', $order->id ); ?>

<?php else : ?>

	<p><?php _e('Thank you. Your order has been received.', 'yit'); ?></p>

<?php endif; ?>