<?php
/**
 * Setup theme specific functions
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    Setup
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'theme/setup.php' );
if (  is_admin() ) prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'theme/admin.php' );
if (  is_admin() ) prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'theme/settings.php' );
if (  is_admin() ) prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'theme/meta.php' );
if ( !is_admin() ) prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'theme/frontend.php' );
prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'theme/designs.php' );
prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'theme/tgmpa.php' );
prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'theme/plugins.php' );
prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'theme/shortcodes.php' );

if ( !is_admin() ) prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'sliders/post.php' );
if ( !is_admin() ) prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'sliders/post-carousel.php' );
if ( !is_admin() ) prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'sliders/post-grid.php' );
if ( class_exists( 'woocommerce' ) ) { 
	if ( !is_admin() ) prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'sliders/product.php' );
	if ( !is_admin() ) prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'sliders/product-carousel.php' );
}

if ( class_exists( 'woocommerce' ) ) { 
	prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'woocommerce/functions.php' );
	prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'woocommerce/widgets.php' );
	if (  is_admin() ) prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'woocommerce/admin.php' );
	if ( !is_admin() ) prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'woocommerce/frontend.php' );
	if ( !is_admin() ) prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'woocommerce/shortcodes.php' );
}

prima_load( trailingslashit(PRIMA_CUSTOM_DIR) . 'theme/update.php' );
