<?php
/**
 * Functions to handle post grid shortcodes
 *
 * NOTE: This shortcode use product shortcode markup
 *
 * WARNING: This file is part of the PrimaShop parent theme.
 * Please do all modifications in the form of a child theme.
 *
 * @category   PrimaShop
 * @package    Sliders
 * @subpackage Post
 * @author     PrimaThemes
 * @link       http://www.primathemes.com
 */

/**
 * Register posts grid shortcodes.
 *
 * @since PrimaShop 1.1
 */ 
add_shortcode('prima_grid_posts', 'prima_grid_post_shortcodes');
function prima_grid_post_shortcodes($atts, $content=null, $code=""){
	global $wp_query, $prima_shortcodes_scripts;
	extract(shortcode_atts(array(
		'post_type' => 'post',
		'category' 	=> null,
		'numbers' 	=> 4,
		'columns' 	=> 4,
		'orderby' => 'date', 
		'order' => 'desc',
		'ids' => '',
		'image' 	=> 'yes',
		'image_width' 	=> 250,
		'image_height' 	=> 150,
		'post_title' => 'yes',
		'limit_content' => '120',
		'read_more' => '',
	), $atts));
	$box_id = rand(1000, 9999);
	$query_args = array(
		'post_status' => 'publish',
		'ignore_sticky_posts' => 1,
	);
	if ( !empty($ids) ) { 
		$ids = explode(',', $ids);
		array_walk($ids, create_function('&$val', '$val = trim($val);'));
		$query_args['post__in'] = $ids;
		$query_args['posts_per_page'] = -1;
		$query_args['orderby'] = 'post__in';
	}
	else {
		$query_args['posts_per_page'] = $numbers;
		$query_args['post_type'] = $post_type;
		$query_args['orderby'] = $orderby;
		$query_args['order'] = $order;
		if ( $category ) {
			$term = term_exists( $category, 'category' );
			if ($term !== 0 && $term !== null)
				$query_args['cat'] = $term['term_id'];
		}
	}
	query_posts($query_args);
	if (have_posts()) : 
		$prima_catalog_loop = 0;
		$prima_catalog_column = $columns;
		$content = '<div class="woocommerce ps-products ps-posts-grid">';
		$content .= '<ul class="products products-col-'.$prima_catalog_column.'">';
	while (have_posts()) : the_post();
		$prima_catalog_loop++;
		$product_class = $prima_catalog_loop%2 ? ' odd' : ' even';
		if ($prima_catalog_loop%$prima_catalog_column==0) $product_class .= ' last';
		if (($prima_catalog_loop-1)%$prima_catalog_column==0) $product_class .= ' first';
		$content .= '<li class="product'.$product_class.'">';
		if ( $image == 'yes' ) {
			$content .= '<div class="product-image-box">';
			$img_args = array();
			$img_args['width'] = $image_width;
			$img_args['height'] = $image_height;
			$img_args['image_scan'] = false;
			$img_args['link_to_post'] = true;
			$content .= prima_get_image($img_args);
			$content .= '</div>';
		}
		if ( $post_title == 'yes' ) {
			$content .= '<h3><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
		}
		if ( $limit_content > 0 ) {
			$content .= prima_get_excerpt_limit( $limit_content, $read_more );
		}
		$content .= '</li>';
	endwhile;
		$content .= '</ul></div>';
	endif;
	wp_reset_query();
	
	return $content;
}
