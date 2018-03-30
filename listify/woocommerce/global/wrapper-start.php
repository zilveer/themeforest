<?php
/**
 * Content wrappers
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( is_singular( 'product' ) ) {
	$active = is_active_sidebar( 'widget-area-sidebar-product' );
} else {
	$active = is_active_sidebar( 'widget-area-sidebar-shop' );
}

$class = $active ? 'col-md-8' : '';

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<div <?php echo apply_filters( 'listify_cover', 'page-cover' ); ?>>

	<div class="page-title cover-wrapper">
		<?php woocommerce_page_title(); ?>
	</div>

</div>

<div id="primary" class="container">
	<div class="row content-area">

		<?php
			if ( ! is_singular( 'product' ) ) :
				get_sidebar( 'shop-archive' );
			endif;
		?>

		<main id="main" class="site-main col-xs-12 <?php echo $class; ?>" role="main">
