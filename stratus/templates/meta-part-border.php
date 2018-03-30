<?php
//-----------------------------------------------------
// Border Settings and Output
//-----------------------------------------------------

$border_show = "";
$border_display = "";
$border_full_width = "";

$themo_page_ID = $post->ID;

// Support for Woo Pages.
// Sometimes the page id isn't explicit so we have to go and look for it.
$themo_woo_page_ID = themo_return_woo_page_ID();
if($themo_woo_page_ID){
    $themo_page_ID = $themo_woo_page_ID;
}

/* We can also use arrays if present */
if(isset($options_array) && !empty( $options_array )){
    if(isset($options_array[$key.'_show_border'])){
		$border_show = $options_array[$key.'_show_border'];
	}
	if(isset($options_array[$key.'_border'])){
		$border_display = $options_array[$key.'_border'];
	}
	if(isset($options_array[$key.'_border_full_width'])){
		$border_full_width = $options_array[$key.'_border_full_width'];
	}
}elseif (isset($themo_custom_post_type_meta) && $themo_custom_post_type_meta) {
    $border_show = get_post_meta($themo_page_ID, '__show_border', true );
    $border_display = get_post_meta($themo_page_ID, '__border', true );
    $border_full_width = get_post_meta($themo_page_ID, '__border_full_width', true );
}else{
    $border_show = get_post_meta($themo_page_ID, $key.'_show_border', true );
	$border_display = get_post_meta($themo_page_ID, $key.'_border', true );
	$border_full_width = get_post_meta($themo_page_ID, $key.'_border_full_width', true );
}

echo themo_return_meta_box_borders($border_show,$border_display,'top',$border_full_width);