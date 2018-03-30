<?php
/**
 * Setup WooCommerce specific admin functions
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    WooCommerce
 * @subpackage Admin
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Show product attributes on menus management page.
 *
 * @since PrimaShop 1.0
 */
add_filter( 'woocommerce_attribute_show_in_nav_menus', 'prima_attribute_show_in_nav_menus' );
function prima_attribute_show_in_nav_menus( $show ) {
	return true;
}

/**
 * Hide some metaboxes on Shop page for the shake of consistency.
 *
 * @since PrimaShop 1.0.3
 */
add_action( 'admin_head-post.php', 'prima_wc_hide_metabox_shop' );
function prima_wc_hide_metabox_shop() {
	if ( isset( $_GET['post'] ) )
		$post_id = $post_ID = (int) $_GET['post'];
	elseif ( isset( $_POST['post_ID'] ) )
		$post_id = $post_ID = (int) $_POST['post_ID'];
	else
		$post_id = $post_ID = 0;
	$shop_page_id 	= woocommerce_get_page_id( 'shop' );

	if ( $shop_page_id != $post_id )
		return;
    ?>
	<style type="text/css">
	.prima_meta_id_prima_layout, .prima_meta_id_page_breadcrumb_hide, .prima_meta_id_page_title_hide, #prima_sidebar_settings_metabox_form { display: none; }
	</style>
	<?php 
}

/**
 * Add header settings for all taxonomies and ability for product attributes to upload thumbnails.
 *
 * @since PrimaShop 1.1
 */
add_filter( 'prima_metabox_product_cat_header_args', 'prima_metabox_types_header_args_featured' );
add_filter( 'prima_metabox_product_tag_header_args', 'prima_metabox_types_header_args_featured' );
global $woocommerce;
if ( function_exists( 'wc_get_attribute_taxonomies' ) ) {
	$prima_attribute_tax = wc_get_attribute_taxonomies();
}
else {
	$prima_attribute_tax = $woocommerce->get_attribute_taxonomies();
}
if ( $prima_attribute_tax ) :
	foreach ($prima_attribute_tax as $tax) :
		if ( function_exists( 'wc_attribute_taxonomy_name' ) )
			$taxonomy_name = wc_attribute_taxonomy_name($tax->attribute_name);
		else
			$taxonomy_name = $woocommerce->attribute_taxonomy_name($tax->attribute_name);
		if ( function_exists ( 'prima_metabox_types_header_args_featured' ) ) {
			add_filter( "prima_metabox_{$taxonomy_name}_header_args", 'prima_metabox_types_header_args_featured' );
		}
	endforeach;
endif;

/**
 * Enqueue Media Library to product attributes edit page.
 *
 * @since PrimaShop 1.1
 */
add_action( 'admin_enqueue_scripts', 'prima_wc_product_attribute_scripts' );
function prima_wc_product_attribute_scripts() {
    $screen       = get_current_screen();
	global $woocommerce;
	if ( function_exists( 'wc_get_attribute_taxonomies' ) )
		$prima_attribute_tax = wc_get_attribute_taxonomies();
	else
		$prima_attribute_tax = $woocommerce->get_attribute_taxonomies();
	$screen_pa = array();
	if ( $prima_attribute_tax ) {
		foreach ($prima_attribute_tax as $tax) {
			if ( function_exists( 'wc_attribute_taxonomy_name' ) )
				$taxonomy_name = wc_attribute_taxonomy_name($tax->attribute_name);
			else
				$taxonomy_name = $woocommerce->attribute_taxonomy_name($tax->attribute_name);
			$screen_pa[] = 'edit-'.$taxonomy_name;
		}
	}
    if ( in_array( $screen->id, $screen_pa ) )
		wp_enqueue_media();
}

if ( class_exists( 'WC_Admin_Taxonomies' ) ) { 
	class Prima_WC_Admin_Taxonomies extends WC_Admin_Taxonomies {
		public function __construct() {
			global $woocommerce;
			if ( function_exists( 'wc_get_attribute_taxonomies' ) ) {
				$prima_attribute_tax = wc_get_attribute_taxonomies();
			}
			if ( $prima_attribute_tax ) :
				foreach ($prima_attribute_tax as $tax) :
					if ( function_exists( 'wc_attribute_taxonomy_name' ) )
						$taxonomy_name = wc_attribute_taxonomy_name($tax->attribute_name);
					else
						$taxonomy_name = $woocommerce->attribute_taxonomy_name($tax->attribute_name);
					add_action( "{$taxonomy_name}_add_form_fields", array( $this, 'add_category_fields' ) );
					add_action( "{$taxonomy_name}_edit_form_fields", array( $this, 'edit_category_fields' ), 10 );
				endforeach;
			endif;
		}
	}
	new Prima_WC_Admin_Taxonomies();
}
