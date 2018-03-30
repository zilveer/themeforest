<?php
function couponxl_featured_stores_func( $atts, $content ){
	extract( shortcode_atts( array(
		'title' => '',
		'text' => '',
		'target' => '',
		'btn_text' => '',
		'link' => '',
		'items' => '',
	), $atts ) );

	$items = explode( ",", $items );

	ob_start();
	include( locate_template( 'includes/box-elements/featured-stores.php' ) );
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

add_shortcode( 'featured_stores', 'couponxl_featured_stores_func' );

function couponxl_featured_stores_params(){
	return array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title","couponxl"),
			"param_name" => "title",
			"value" => "",
			"description" => __("Input title.","couponxl")
		),
		array(
			"type" => "textarea",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text","couponxl"),
			"param_name" => "text",
			"value" => '',
			"description" => __("Input text.","couponxl")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Select Window","couponxl"),
			"param_name" => "target",
			"value" => array(
				__( 'Same Window', 'couponxl' ) => '_self',
				__( 'New Window', 'couponxl' ) => '_blank',
			),
			"description" => __("Select window where to open the link.","couponxl")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Text","couponxl"),
			"param_name" => "btn_text",
			"value" => '',
			"description" => __("Input button text.","couponxl")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Link","couponxl"),
			"param_name" => "link",
			"value" => '',
			"description" => __("Input button link.","couponxl")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Items","couponxl"),
			"param_name" => "items",
			"value" => "",
			"description" => __("Input items you wish to show in comma separated list.","couponxl")
		),		
	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Featured Stores", 'couponxl'),
	   "base" => "featured_stores",
	   "category" => __('Content', 'couponxl'),
	   "params" => couponxl_featured_stores_params()
	) );
}

?>