<?php
/**
 * Show error messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>

<ul class="woocommerce-error v_alert_box alert-error list_none">
	<?php foreach ( $messages as $message ) : ?>
		<li>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&#10006;</button>
		<?php echo wp_kses_post( $message ); ?>
		</li>
	<?php endforeach; ?>
</ul>
