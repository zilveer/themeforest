<?php
/**
 * Loop Rating
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.2.10
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

if ( get_option( 'woocommerce_enable_review_rating' ) == 'no' )
	return;


$rating = $product->get_average_rating();
if ($rating > 0) {

	$rating_html = '<span class="star-rating" title="' . sprintf(__('Rated %s out of 5', 'dfd'), $rating) . '">';
	$rating_html .= '<span style="width:' . ( ( $rating / 5 ) * 100 ) . '%"><strong class="rating">' . $rating . '</strong> ' . __('out of 5', 'dfd') . '</span>';
	$rating_html .= '</span>';

	echo $rating_html;
}
