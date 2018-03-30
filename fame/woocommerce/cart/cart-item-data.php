<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	2.4.0
 */

if ( ! defined( 'ABSPATH' ) ){
	exit;
}

?>
<div class="variation">
	<?php foreach ( $item_data as $data ) : ?>
		<p class="variation-<?php echo sanitize_html_class( $data['key'] ); ?>"><?php echo wp_kses_post( $data['key'] ); ?>:
		<span class="variation-<?php echo sanitize_html_class( $data['key'] ); ?>"><?php echo wp_kses_post( $data['display'] ); ?></span></p>
	<?php endforeach; ?>
</div>
