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

<?php foreach ( $messages as $message ) : ?>
	<div class="grve-woo-info grve-bg-blue"><?php echo wp_kses_post( $message ); ?></div>
<?php endforeach;
	
//Omit closing PHP tag to avoid accidental whitespace output errors.
