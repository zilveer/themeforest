<?php

/**
 * Header slider template for LayerSlider WP
 *
 * @package  wpv
 */

$post_id = wpv_get_the_ID();

if(is_null($post_id)) return;

$id = (int)str_replace('layerslider-', '', wpv_post_meta($post_id, 'slider-category', true));

if(!empty($id) && function_exists('layerslider_check_unit')) {
	global $wpdb;

	$table_name = $wpdb->prefix . "layerslider";

	$slider = $wpdb->get_row("SELECT * FROM $table_name
								WHERE id = ".(int)$id." AND flag_hidden = '0'
								AND flag_deleted = '0'
								ORDER BY date_c DESC LIMIT 1" , ARRAY_A);

	if($slider !== null) {
		$slides = json_decode($slider['data'], true);

		echo "<div class='layerslider-fixed-wrapper' style='height:".layerslider_check_unit($slides['properties']['height'])."'>";
		echo do_shortcode('[layerslider id="'.$id.'"]');
		echo "</div>";
		echo '<div style="height:1px;margin-top:-1px"></div>';

	}
}