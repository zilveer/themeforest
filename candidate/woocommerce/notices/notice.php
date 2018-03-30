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
<div class="alert-box alert-box-button info animate-onscroll">
		<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 woomessage">
	<?php echo wp_kses_post( $message ); ?></div></div></div>
	
	
<?php endforeach; ?>