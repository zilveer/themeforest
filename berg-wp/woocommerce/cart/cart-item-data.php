<?php
/**
 * Cart item data (when outputting non-flat)
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version 	19.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>
<?php
	foreach ( $item_data as $data ) :
		$key = sanitize_text_field( $data['key'] );
?>
<span><?php echo wp_kses_post( $data['key'] ); ?>: <?php echo wp_kses_post( $data['value'] ); ?></span>
<?php endforeach; ?>