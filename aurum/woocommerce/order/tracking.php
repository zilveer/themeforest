<?php
/**
 * Order tracking
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.0
 */

/* Note: This file has been altered by Laborator */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$order_status_text = sprintf( __( 'Order <mark>%s</mark> which was made <mark>%s</mark> has the status &ldquo;<mark>%s</mark>&rdquo;', 'aurum' ), $order->get_order_number(), human_time_diff( strtotime( $order->order_date ), current_time( 'timestamp' ) ) . ' ' . __( 'ago', 'aurum' ), wc_get_order_status_name( $order->get_status() ) );

if ( $order->has_status( 'completed' ) ) $order_status_text .= ' ' . __( 'and was completed', 'aurum' ) . ' ' . human_time_diff( strtotime( $order->completed_date ), current_time( 'timestamp' ) ) . __( ' ago', 'aurum' );

$order_status_text .= '.';

# start: modified by Arlind Nushi
echo '<div class="alert alert-info def-m">';
	echo apply_filters( 'woocommerce_order_tracking_status', $order_status_text, $order );
echo '</div>';
# end: modified by Arlind Nushi

$notes = $order->get_customer_order_notes();

if ( $notes ) : ?>

	<h2 class="order-notes-title"><?php _e( 'Order Updates', 'aurum' ); ?></h2>
	<ol class="order-notes list-unstyled">
		<?php foreach ( $notes as $i => $note ) : ?>
		<li>
			<i><?php echo $i+1; ?></i>
			<div class="description">
				<?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
			</div>
			<p class="meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'aurum' ), strtotime( $note->comment_date ) ); ?></p>
		</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>

<?php do_action( 'woocommerce_view_order', $order->id ); ?>
