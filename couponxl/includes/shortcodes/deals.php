<?php
function couponxl_deals_func( $atts, $content ){
	extract( shortcode_atts( array(
		'icon' => '',
		'title' => '',
		'small_title' => '',
		'deal_categories' => '',
		'deal_locations' => '',
		'deal_stores' => '',
		'deals_number' => '3',
		'deals_orderby' => 'offer_expire',
		'deals_order' => 'ASC',
		'orderby' => '',
		'order' => '',
		'items' => '',
	), $atts ) );

	$items = explode( ",", $items );
	$col = 4;
	$offer_view = '';
	ob_start();
	include( locate_template( 'includes/box-elements/deals.php' ) );
	$content = ob_get_contents();
	ob_end_clean();

	return $content;
}

add_shortcode( 'deals', 'couponxl_deals_func' );

function couponxl_deals_params(){
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
			"heading" => __("Deal Category","couponxl"),
			"param_name" => "deal_categories",
			"value" => couponxl_get_custom_tax_list( 'offer_cat', 'left' ),
			"description" => __("Filter deals by category.","couponxl")
		),
		array(
			"type" => "multidropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Deal Location","couponxl"),
			"param_name" => "deal_locations",
			"value" => couponxl_get_custom_tax_list( 'location', 'left' ),
			"description" => __("Filter deals by location.","couponxl")
		),
		array(
			"type" => "multidropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Deal Store","couponxl"),
			"param_name" => "deal_stores",
			"value" => couponxl_get_custom_list( 'store', array(), '', 'left' ),
			"description" => __("Filter deals by store.","couponxl")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Number Of Deals ( Used By Filter )","couponxl"),
			"param_name" => "deals_number",
			"value" => "",
			"description" => __("Input number of deals you wish to show which is used for the filter ( -1 for all ).","couponxl")
		),			
		array(
			"type" => "multidropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Deals","couponxl"),
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
                        'key' => 'deal_status',
                        'value' => 'has_items',
                        'compare' => '='
                    ),
                    array(
                    	'key' => 'offer_type',
                    	'value' => 'deal',
                    	'compare' => '='
                    )
    			),
			), '', 'left' ),

			"description" => __("Select deals you wish to present","couponxl")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Order By","couponxl"),
			"param_name" => "deals_orderby",
			"value" => array(
				__( 'Expire Time', 'couponxl' ) => 'offer_expire',
				__( 'Date Added', 'couponxl' ) => 'date',
				__( 'Title', 'couponxl' ) => 'title',
			),
			"description" => __("Select by which field to order deals","couponxl")
		),
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Order","couponxl"),
			"param_name" => "deals_order",
			"value" => array(
				__( 'Ascending', 'couponxl' ) => 'ASC',
				__( 'Descending', 'couponxl' ) => 'DESC',
			),
			"description" => __("Select how to order deals","couponxl")
		),		
	);
}

if( function_exists( 'vc_map' ) ){
	vc_map( array(
	   "name" => __("Deals", 'couponxl'),
	   "base" => "deals",
	   "category" => __('Content', 'couponxl'),
	   "params" => couponxl_deals_params()
	) );
}

?>