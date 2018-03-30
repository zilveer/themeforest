<?php
/**
 * Sidebar
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! is_singular( 'product' ) ) {
	return;
}
?>

		<?php get_sidebar( 'shop' ); ?>

	</div>

</div>