<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! $messages ){
	return;
}

?>

<div class="woocommerce-messages medium-text-center">
	<div class="message-wrapper">
		<?php foreach ( $messages as $message ) : ?>
			<div class="woocommerce-message container">
				<?php echo wp_kses_post( $message ); ?>
			</div>
		<?php endforeach; ?>
	</div>
</div>