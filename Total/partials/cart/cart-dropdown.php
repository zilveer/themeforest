<?php
/**
 * Header cart dropdown
 *
 * @package Total WordPress theme
 * @subpackage Partials
 * @version 3.0.0
 */ ?>

<div id="current-shop-items-dropdown" class="clr">

	<div id="current-shop-items-inner" class="clr">

		<?php
		// Display WooCommerce cart
		the_widget( 'WC_Widget_Cart' ); ?>

	</div><!-- #current-shop-items-inner -->
	
</div><!-- #current-shop-items-dropdown -->