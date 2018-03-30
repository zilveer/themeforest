<?php
function couponxl_coupons_func( $atts, $content ){
	extract( shortcode_atts( array(
		'icon' => '',
		'title' => '',
		'small_title' => '',
		'coupon_categories' => '',
		'coupon_locations' => '',
		'coupon_stores' => '',
		'coupons_number' => '3',
		'coupons_orderby' => 'offer_expire',
		'coupons_order' => 'ASC',		
		'items' => '',
	), $atts ) );

	$items = explode( ",", $items );
	$is_shortcode = true;
	$col = 4;
	$offer_view = '';
	ob_start();
	include( locate_template( 'includes/box-elements/coupons.php' ) );
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

add_shortcode( 'coupons', 'couponxl_coupons_func' );

function couponxl_coupons_params(){
	return array(
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Icon","couponxl"),
			"param_name" => "icon",
			"value" => couponxl_awesome_icons_list(),
			"description" => __("Select icon","couponxl")
		),
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
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Small Title","couponxl"),
			"param_name" => "small_title",
			"value" => '',
			"description" => __("Input title for the right link.","couponxl")
		),
		array(
			"type" => "multidropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Coupon Category","couponxl"),
			"param_name" => "coupon_categories",
			"value" => couponxl_get_custom_tax_list( 'offer_cat', 'left' ),
			"description" => __("Filter coupons by category.","couponxl")
		),
		array(
			"type" => "multidropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Coupon Location","couponxl"),
			"param_name" => "coupon_locations",
			"value" => couponxl_get_custom_tax_list( 'location', 'left' ),
			"description" => __("Filter coupons by location.","couponxl")
		),
		array(
			"type" => "multidropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Coupon Store","couponxl"),
			"param_name" => "coupon_stores",
			"value" => couponxl_get_custom_list( 'store', array(), '', 'left' ),
			"description" => __("Filter coupons by store.","couponxl")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Number Of Coupons ( Used By Filter )","couponxl"),
			"param_name" => "coupons_number",
			"value" => "",
			"description" => __("Input number of coupons you wish to show which is used for the filter ( -1 for all ).","couponxl")
		),		
		array(
			"type" => "multidropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Coupons","couponxl"),
			"param_name" => "items",
			"value" => couponxl_get_custom_list( 'offer', array(
    			'meta_query' => array(
    				'relation' => 'AND',
					array(
						'key' => 'offer_start',
						'value' => current_time( 'timestamp' ),
						'compare' => '<='
					),
					array(
						'key' => 'offer_expire',
						'value' => current_time( 'timestamp' ),
						'compare' => '>='
					),
                    array(
                    	'key' => 'offer_type',
                    	'value' => 'coupon',
                    	'compare' => '='
                    )
    			),
			), '', 'left' ),
			"description" => __("Select coupons you wish to present","couponxl")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Order By","couponxl"),
			"param_name" => "coupons_orderby",
			"value" => array(
				__( 'Expire Time', 'couponxl' ) => 'offer_expire',
				__( 'Date Added', 'couponxl' ) => 'date',
				__( 'Title', 'couponxl' ) => 'title',
			),
			"description" => __("Select by which field to order coupons","couponxl")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Order","couponxl"),
			"param_name" => "coupons_order",
			"value" => array(
				__( 'Ascending', 'couponxl' ) => 'ASC',
				__( 'Descending', 'couponxl' ) => 'DESC',
			),
			"description" => __("Select how to order coupons","couponxl")
		),
	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Coupons", 'couponxl'),
	   "base" => "coupons",
	   "category" => __('Content', 'couponxl'),
	   "params" => couponxl_coupons_params()
	) );
}

?>