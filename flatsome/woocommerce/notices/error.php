<?php
/**
 * Show error messages
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

<div class="woocommerce-messages alert-color medium-text-center container">
	<div class="message-wrapper">
		<ul class="woocommerce-error woocommerce-message">
			<?php foreach ( $messages as $message ) : ?>
				<li><span class="message-icon icon-close"></span> <?php echo wp_kses_post( $message ); ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
