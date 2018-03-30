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
<ul class="alert alert-danger fade in woocommerce-error"><div class="icon-alert"><i class="fa fa-times"></i></div><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<?php foreach ( $messages as $message ) : ?>
		<li><?php echo wp_kses_post( $message ); ?></li>
	<?php endforeach; ?>
</ul>