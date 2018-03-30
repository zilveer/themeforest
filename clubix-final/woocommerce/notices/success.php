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
	<div class="alert alert-success fade in woocommerce-message"><div class="icon-alert"><i class="fa fa-check"></i></div><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo wp_kses_post( $message ); ?></div>
<?php endforeach; ?>
