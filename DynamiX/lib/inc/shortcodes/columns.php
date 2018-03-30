<?php

/* ------------------------------------
:: COLUMNS
------------------------------------*/

function columns_shortcode( $atts, $content = null, $code ) {
   extract( shortcode_atts( array(
      'border' => '',
	  'height' => '',
	  'class' => '',
), $atts ) );
	if($code=="two_columns") {
	$classes = $class." two_column";	
	} elseif($code=="two_columns_last") {
	$classes = $class." two_column last clearfix";	
	} elseif($code=="three_columns") {
	$classes = $class." three_column";	
	} elseif($code=="three_columns_last") {
	$classes = $class." three_column last clearfix";	
	} elseif($code=="four_columns") {
	$classes = $class." four_column";	
	} elseif($code=="four_columns_last") {
	$classes = $class." four_column last clearfix";	
	} elseif($code=="five_columns") {
	$classes = $class." five_column";	
	} elseif($code=="five_columns_last") {
	$classes = $class." five_column last clearfix";	
	} elseif($code=="six_columns") {
	$classes = $class." six_column";	
	} elseif($code=="six_columns_last") {
	$classes = $class." six_column last clearfix";	
	} elseif($code=="onethird_columns") {
	$classes = $class." three_column";	
	} elseif($code=="twothirds_columns") {
	$classes = $class." two_thirds_column";	
	} elseif($code=="onethird_columns_last") {
	$classes = $class." three_column last clearfix";	
	} elseif($code=="twothirds_columns_last") {
	$classes = $class." two_thirds_column last clearfix";	
	} elseif($code=="onefourth_columns") {
	$classes = $class." four_column";	
	} elseif($code=="threefourths_columns") {
	$classes = $class." three_fourths_column";	
	} elseif($code=="onefourth_columns_last") {
	$classes = $class." four_column last clearfix";	
	} elseif($code=="threefourths_columns_last") {
	$classes = $class." three_fourths_column last clearfix";	
	}
	
	if(esc_attr($height)!='') {
	$height = 'style="height:'. esc_attr($height) .'px"';
	}
	
	$clear = strpos($code,"_last");

	if($clear === false) {
		return '<div class="columns shortcode block '. $classes .' '. esc_attr($border) .'">
		<div class="columns-inner" '. $height.'>
		'. do_shortcode($content) .'</div></div>';
	} else {
		return '<div class="columns shortcode block '. $classes .' '. esc_attr($border) .'">
		<div class="columns-inner" '. $height.'>
		'. do_shortcode($content) .'</div></div><div class="clear"></div>';
	}
}

	add_shortcode('two_columns', 'columns_shortcode');
	add_shortcode('two_columns_last', 'columns_shortcode');
	add_shortcode('three_columns', 'columns_shortcode');
	add_shortcode('three_columns_last', 'columns_shortcode');
	add_shortcode('onethird_columns', 'columns_shortcode');
	add_shortcode('twothirds_columns', 'columns_shortcode');
	add_shortcode('onethird_columns_last', 'columns_shortcode');
	add_shortcode('twothirds_columns_last', 'columns_shortcode');
	add_shortcode('four_columns', 'columns_shortcode');
	add_shortcode('four_columns_last', 'columns_shortcode');
	add_shortcode('five_columns', 'columns_shortcode');
	add_shortcode('five_columns_last', 'columns_shortcode');
	add_shortcode('six_columns', 'columns_shortcode');
	add_shortcode('six_columns_last', 'columns_shortcode');
	add_shortcode('onefourth_columns', 'columns_shortcode');
	add_shortcode('threefourths_columns', 'columns_shortcode');
	add_shortcode('onefourth_columns_last', 'columns_shortcode');
	add_shortcode('threefourths_columns_last', 'columns_shortcode');