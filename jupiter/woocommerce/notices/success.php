<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>

<?php foreach ( $messages as $message ) : ?>
	<div class="mk-message-box mk-confirm-message-box"><span><?php echo wp_kses_post( $message ); ?><div class="clearboth"></div></span></div>
<?php endforeach; ?>
