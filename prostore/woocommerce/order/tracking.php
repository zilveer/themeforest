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
 * @package 	proStore/woocommerce/order/tracking.php
 * @sub-package WooCommerce/Templates/order/tracking.php
 * @file		1.0
 * @file(Woo)	1.6.4
 */
?>
<?php global $woocommerce; ?>
	
<?php
	$status = get_term_by('slug', $order->status, 'shop_order_status');
	$order_status_text = sprintf( __('Order %s which was made %s has the status &ldquo;%s&rdquo;', 'woocommerce'), $order->get_order_number(), human_time_diff(strtotime($order->order_date), current_time('timestamp')) . ' ' . __('ago', 'woocommerce'), $status->name );
?>

		<div class="tracking_alert alert-box <?php echo $status->name; ?>">
			<div class="icon-box">
				<?php
					switch($status->name) {
						case "pending" :
							echo '<em class="icon-progress"></em>';
							break;
						case "failed" :
							echo '<em class="icon-cancel"></em>';
							break;
						case "on-hold" :
							echo '<em class="icon-flag"></em>';
							break;
						case "processing" :
							echo '<em class="icon-progress"></em>';
							break;
						case "completed" :
							echo '<em class="icon-ok"></em>';
							break;
						case "refunded" :
							echo '<em class="icon-back-alt"></em>';
							break;
						case "cancelled" :
							echo '<em class="icon-cancel"></em>';
							break;
					}
				?>
			</div>
			<div>
				<p><?php _e('Thank you. Your order has been received.', 'woocommerce'); ?></p>				
				<?php
					if ($order->status == 'completed') $order_status_text .= ' ' . __('and was completed', 'woocommerce') . ' ' . human_time_diff(strtotime($order->completed_date), current_time('timestamp')).__(' ago', 'woocommerce');
				
					$order_status_text .= '.';
				
					echo wpautop(apply_filters('woocommerce_order_tracking_status', $order_status_text, $order));
				?>
			</div>
		</div>

<?php
	$notes = $order->get_customer_order_notes();
	if ($notes) :
		?>
		<h4><em class="icon-rss-alt"></em> <?php _e('Order Updates', 'woocommerce'); ?></h4>
		<div class="panel order_updates">
			<ol class="commentlist notes">
				<?php foreach ($notes as $note) : ?>
				<li class="comment note">
					<div class="comment_container row container">
						<div class="comment-text four columns">
							<p class="meta"><?php echo date_i18n('l jS \of F Y, h:ia', strtotime($note->comment_date)); ?></p>
						</div>
						<div class="description eight columns">
								<?php echo wpautop(wptexturize($note->comment_content)); ?>
						</div>
					</div>
				</li>
				<?php endforeach; ?>
			</ol>
		</div>
		<?php
	endif;
?>

<?php do_action( 'woocommerce_view_order', $order->id ); ?>