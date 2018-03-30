<?php
/**
 * Order tracking
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$order_status_text = sprintf( __( 'Order #%s which was made %s has the status &ldquo;%s&rdquo;', 'woocommerce' ), $order->get_order_number(), human_time_diff( strtotime( $order->order_date ), current_time( 'timestamp' ) ) . ' ' . esc_html__( 'ago', 'woocommerce' ), wc_get_order_status_name( $order->get_status() ) );

if ( $order->has_status( 'completed' ) ) $order_status_text .= ' ' . esc_html__( 'and was completed', 'woocommerce' ) . ' ' . human_time_diff( strtotime( $order->completed_date ), current_time( 'timestamp' ) ) . esc_html__( ' ago', 'woocommerce' );

$order_status_text .= '.';

echo wpautop( esc_attr( apply_filters( 'woocommerce_order_tracking_status', $order_status_text, $order ) ) );

$notes = $order->get_customer_order_notes();

if ( $notes ) : ?>
	<h3 class="grve-align-center"><?php esc_html_e( 'Order Updates', 'woocommerce' ); ?></h3>
	<ol class="commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
		<li class="comment note">
			<div class="comment_container">
				<div class="comment-text">
					<p class="meta"><?php echo date_i18n( esc_html__( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></p>
					<div class="description">
						<?php echo wpautop( wptexturize( wp_kses_post( $note->comment_content ) ) ); ?>
					</div>
	  				<div class="clear"></div>
	  			</div>
				<div class="clear"></div>
			</div>
		</li>
		<?php endforeach; ?>
	</ol>
<?php endif; ?>

<?php do_action( 'woocommerce_view_order', $order->id );
	
//Omit closing PHP tag to avoid accidental whitespace output errors.
