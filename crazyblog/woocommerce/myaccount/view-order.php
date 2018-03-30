<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/view-order.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author    WooThemes
 * @package   WooCommerce/Templates
 * @version   2.6.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php wc_print_notices(); ?>

<p class="order-info"><?php printf( esc_html__( 'Order', 'crazyblog' ) . '#<mark class="order-number">%s</mark> ' . esc_html__( ' was placed on ', 'crazyblog' ) . '<mark class="order-date">%s</mark> ' . esc_html__( ' and is currently ', 'crazyblog' ) . '<mark class="order-status">%s</mark>.', $order->get_order_number(), date_i18n( get_option( 'date_format' ), strtotime( $order->order_date ) ), wc_get_order_status_name( $order->get_status() ) ); ?></p>

<?php if ( $notes = $order->get_customer_order_notes() ) :
	?>
	<h2><?php esc_html_e( 'Order Updates', 'crazyblog' ); ?></h2>
	<ol class="commentlist notes">
		<?php foreach ( $notes as $note ) : ?>
			<li class="comment note">
				<div class="comment_container">
					<div class="comment-text">
						<p class="meta"><?php echo date_i18n( esc_html__( 'l jS \o\f F Y, h:ia', 'crazyblog' ), strtotime( $note->comment_date ) ); ?></p>
						<div class="description">
							<?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>
			</li>
		<?php endforeach; ?>
	</ol>
	<?php
endif;

do_action( 'woocommerce_view_order', $order_id );
