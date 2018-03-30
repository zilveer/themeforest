<?php 
/**
 * Setup WooCommerce specific shortcodes
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    WooCommerce
 * @subpackage Shortcodes
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Register products shortcodes.
 *
 * @since PrimaShop 1.0
 */
add_shortcode('prima_products', 'prima_products_shortcodes');
add_shortcode('prima_featured_products', 'prima_products_shortcodes');
add_shortcode('prima_onsale_products', 'prima_products_shortcodes');
add_shortcode('prima_bestsellers_products', 'prima_products_shortcodes');
add_shortcode('prima_toprated_products', 'prima_products_shortcodes');
add_shortcode('prima_products_in_category', 'prima_products_shortcodes');
add_shortcode('prima_products_in_tag', 'prima_products_shortcodes');
add_shortcode('prima_products_in_attribute', 'prima_products_shortcodes');
add_shortcode('prima_products_with_skus', 'prima_products_shortcodes');
add_shortcode('prima_products_with_ids', 'prima_products_shortcodes');
function prima_products_shortcodes($atts, $content=null, $code=""){
	global $woocommerce, $prima_products_atts;
	
	$default_atts = array(
		'title' => '', 
		'numbers' => '4', 
		'columns' => '4',
		'orderby' => 'date', 
		'order' => 'desc',
		'image_width' => '',
		'image_height' => '',
		'image_crop' => 'yes',
		'product_image' => 'yes',
		'product_saleflash' => 'yes',
		'product_title' => 'yes',
		'product_rating' => 'yes',
		'product_price' => 'yes',
		'product_excerpt' => 'no',
		'product_button' => 'no',
		'product_custom' => '',
		'link_to_shop' => 'no',
	);
	
	$query_args = array(
		'post_type'	=> 'product',
		'post_status' => 'publish',
		'ignore_sticky_posts'	=> 1,
	);
	
	$query_args['meta_query'] = $woocommerce->query->get_meta_query();
	
	switch($code){
		case 'prima_products':
			$atts = shortcode_atts( $default_atts, $atts);
			$prima_products_atts = $atts;
		break;
		case 'prima_featured_products':
			$atts = shortcode_atts( $default_atts, $atts);
			$prima_products_atts = $atts;
			
			$query_args['meta_query'][] = array(
				'key' => '_featured',
				'value' => 'yes'
			);
		break;
		case 'prima_onsale_products':
			$atts = shortcode_atts( $default_atts, $atts);
			$prima_products_atts = $atts;
			
			$product_ids_on_sale = woocommerce_get_product_ids_on_sale();
			$product_ids_on_sale[] = 0;

			$query_args['no_found_rows'] = 1;
			$query_args['post__in'] = $product_ids_on_sale;
		break;
		case 'prima_bestsellers_products':
			$default_atts['orderby'] = 'meta_value_num';
			$atts = shortcode_atts( $default_atts, $atts);
			$prima_products_atts = $atts;
			
			$query_args['meta_key'] = 'total_sales';
			$query_args['no_found_rows'] = 1;
		break;
		case 'prima_toprated_products':
			$atts = shortcode_atts( $default_atts, $atts);
			$prima_products_atts = $atts;
			
			add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
			$query_args['no_found_rows'] = 1;
		break;
		case 'prima_products_in_category':
			$default_atts['category'] = '';
			$atts = shortcode_atts( $default_atts, $atts);
			$prima_products_atts = $atts;
			
			if ( !$atts['category'] ) return '<p class="woocommerce-info">'.__('No defined product category slug in the current shortcode.', 'primathemes').'</p>';
				
			$term = term_exists( $atts['category'], 'product_cat' );
			if ($term !== 0 && $term !== null) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'product_cat',
						'field' => 'id',
						'terms' => array( $term['term_id'] ),
						'operator' => 'IN'
					)
				);
			}
			else {
				return '<p class="woocommerce-info">'.sprintf( __('%s product category does not exist.', 'primathemes'), $atts['category'] ).'</p>';
			}
		break;
		case 'prima_products_in_tag':
			$default_atts['tag'] = '';
			$atts = shortcode_atts( $default_atts, $atts);
			$prima_products_atts = $atts;
			
			if ( !$atts['tag'] ) return '<p class="woocommerce-info">'.__('No defined product tag slug in the current shortcode.', 'primathemes').'</p>';
				
			$term = term_exists( $atts['tag'], 'product_tag' );
			if ($term !== 0 && $term !== null) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => 'product_tag',
						'field' => 'id',
						'terms' => array( $term['term_id'] ),
						'operator' => 'IN'
					)
				);
			}
			else {
				return '<p class="woocommerce-info">'.sprintf( __('%s product tag does not exist.', 'primathemes'), $atts['tag'] ).'</p>';
			}
		break;
		case 'prima_products_in_attribute':
			$atts_orig = $atts;
			
			$default_atts['attribute'] = '';
			$atts = shortcode_atts( $default_atts, $atts);
			$prima_products_atts = $atts;
			
			if ( !$atts['attribute'] ) return '<p class="woocommerce-info">'.__('No defined product attribute in the current shortcode.', 'primathemes').'</p>';
			
			if ( function_exists( 'wc_attribute_taxonomy_name' ) )
				$taxonomy = wc_attribute_taxonomy_name($atts['attribute']);
			else
				$taxonomy = $woocommerce->attribute_taxonomy_name($atts['attribute']);
			if ( !taxonomy_exists($taxonomy) ) return '<p class="woocommerce-info">'.sprintf( __('There is no "%s" product attribute in the current shop.', 'primathemes'), $atts['attribute']).'</p>';
			
			if ( !isset($atts_orig[$atts['attribute']]) ) return '<p class="woocommerce-info">'.sprintf( __('There is no defined "%s" product attribute in the current shop.', 'primathemes'), $atts['attribute']).'</p>';
			
			$term = term_exists( esc_attr($atts_orig[$atts['attribute']]), $taxonomy );
			if ($term !== 0 && $term !== null) {
				$query_args['tax_query'] = array(
					array(
						'taxonomy' => $taxonomy,
						'field' => 'id',
						'terms' => array( $term['term_id'] ),
						'operator' => 'IN'
					)
				);
			}
			else {
				return '<p class="woocommerce-info">'.sprintf( __('%s product attribute does not exist.', 'primathemes'), $atts_orig[$atts['attribute']] ).'</p>';
			}
		break;
		case 'prima_products_with_skus':
			$default_atts['numbers'] = -1;
			$default_atts['skus'] = '';
			$atts = shortcode_atts( $default_atts, $atts);
			$prima_products_atts = $atts;
			
			if ( !$atts['skus'] ) return '<p class="woocommerce-info">'.__('No defined SKUs in the current shortcode.', 'primathemes').'</p>';
				
			$skus = explode(',', $atts['skus']);
			array_walk($skus, create_function('&$val', '$val = trim($val);'));
			$query_args['meta_query'][] = array(
				'key' => '_sku',
				'value' => $skus,
				'compare' => 'IN'
			);
		break;
		case 'prima_products_with_ids':
			$default_atts['numbers'] = -1;
			$default_atts['ids'] = '';
			$atts = shortcode_atts( $default_atts, $atts);
			$prima_products_atts = $atts;
			
			if ( !$atts['ids'] ) return '<p class="woocommerce-info">'.__('No defined IDs in the current shortcode.', 'primathemes').'</p>';
				
			$ids = explode(',', $atts['ids']);
			array_walk($ids, create_function('&$val', '$val = trim($val);'));
			$query_args['post__in'] = $ids;
		break;
	}
			
	$query_args['posts_per_page'] = $atts['numbers'];
	$query_args['orderby'] = $atts['orderby'];
	$query_args['order'] = $atts['order'];
	
	query_posts($query_args);
	ob_start();
	get_template_part( 'prima-shortcode-shop' );
	wp_reset_query();
	switch($code){
		case 'prima_toprated_products':
			remove_filter( 'posts_clauses', array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
		break;
	}
	
	return ob_get_clean();
}

/**
 * Register product taxonomies shortcodes.
 *
 * @since PrimaShop 1.0
 */
add_shortcode('prima_product_categories', 'prima_product_taxonomies_shortcodes');
add_shortcode('prima_product_attributes', 'prima_product_taxonomies_shortcodes');
function prima_product_taxonomies_shortcodes($atts, $content=null, $code=""){
	global $woocommerce, $prima_productcats_atts, $product_categories;
	if ( function_exists( 'wc_get_image_size' ) )
		$image_size = wc_get_image_size( 'shop_catalog' );
	else
		$image_size = $woocommerce->get_image_size( 'shop_catalog' );
	
	$default_atts = array(
		'title' => '', 
		'hide_empty' => 'no',
		'numbers' => '', 
		'columns' => '4',
		'orderby' => '', 
		'order' => '',
		'parent' => null,
		'child_of' => null,
		'include' => null,
		'exclude' => null,
		'image_width' => $image_size['width'],
		'image_height' => $image_size['height'],
		'image_crop' => ( $image_size['crop'] ? 'yes' : 'no' ),
		'show_image' => 'yes',
		'show_title' => 'yes',
		'show_count' => 'yes',
		'style' => '',
	);
	
	$cat_args = array();
	$cat_args['menu_order'] = 'ASC';
	$cat_args['pad_counts'] = 1;
	
	switch($code){
		case 'prima_product_categories':
			$atts = shortcode_atts( $default_atts, $atts);
			
			$cat_args['taxonomy'] = 'product_cat';
			
			// NOTE: using child_of instead of parent - this is not ideal but due to a WP bug ( http://core.trac.wordpress.org/ticket/15626 ) pad_counts won't work
			if ( is_numeric( $atts['child_of'] ) ) 
				$cat_args['child_of'] = $atts['child_of'];
			if ( is_numeric( $atts['parent'] ) )
				$cat_args['child_of'] = $atts['parent'];
		break;
		case 'prima_product_attributes':
			$default_atts['attribute'] = '';
			$atts = shortcode_atts( $default_atts, $atts);
			
			if ( !$atts['attribute'] ) return '<p class="woocommerce-info">'.__('No defined product attribute taxonomy in the current shortcode.', 'primathemes').'</p>';
			
			if ( function_exists( 'wc_attribute_taxonomy_name' ) )
				$taxonomy = wc_attribute_taxonomy_name($atts['attribute']);
			else
				$taxonomy = $woocommerce->attribute_taxonomy_name($atts['attribute']);
			if ( !taxonomy_exists($taxonomy) ) return '<p class="woocommerce-info">'.sprintf( __('There is no "%s" product attribute taxonomy in the current shop.', 'primathemes'), $atts['attribute']).'</p>';

			$cat_args['taxonomy'] = $taxonomy;
		break;
	}

	$cat_args['hide_empty'] = ( $atts['hide_empty'] == 'yes' ? true : false );
	if ( $atts['orderby'] ) $cat_args['orderby'] = $atts['orderby'];
	if ( $atts['order'] ) $cat_args['order'] = $atts['order'];

	if ( trim( $atts['include'] ) ) $cat_args['include'] = explode( ",", $atts['include'] );
	if ( trim( $atts['exclude'] ) ) $cat_args['exclude'] = explode( ",", $atts['exclude'] );
	
	$prima_productcats_atts = $atts;
	$product_categories = get_categories( $cat_args );

	if ($product_categories) :
	
		ob_start();
		get_template_part( 'prima-shortcode-productcat' );
		
		return ob_get_clean();
	endif;
}
