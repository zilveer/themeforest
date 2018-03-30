<?php
/**
 * Show messages
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! $messages ) return;
?>

<?php foreach ( $messages as $message ) : ?>
	<div class="woocommerce-message">  
		<div class="alert alert-success">
			<span class="alert-icon"><i class="fa fa-check"></i></span>
			<?php echo wp_kses_post( $message ); ?>
		</div>
	</div>
<?php endforeach; ?>
