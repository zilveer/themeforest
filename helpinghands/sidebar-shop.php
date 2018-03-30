<?php
/**
 * WooCommerce Sidebar
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */
?>

<div class="col-md-3 col-sm-3 sd-sidebar-shop">
	<?php if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar('woocommerce-sidebar') );	 ?>
</div>