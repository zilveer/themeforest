<?php
/**
 * Product Loop End
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

// Related products, end just the shop wrapper from loop-start.php
if ( is_singular() ) {
	echo '</div>';
	return;
} else {
	// End .site-main from wrapper-start.php
	echo '</main>';

	// End the #primary and .content-area from wrapper-start.php
	if ( is_post_type_archive( 'product' ) || is_tax( array( 'product_cat', 'product_tag' ) ) ) {
		echo '</div></div>';
	}
}