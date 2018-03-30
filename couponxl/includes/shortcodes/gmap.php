<?php
function couponxl_gmap_func( $atts, $content ){
	extract( shortcode_atts( array(
		'source' => 'stores',
		'height' => '400px;'
	), $atts ) );	

	$markers = array();

	if( $source == 'stores' ){
		$stores = get_posts(array(
			'post_type' => 'store',
			'post_status' => 'publish',
			'posts_per_page' => '-1',
		));
		if( !empty( $stores ) ){
			foreach ( $stores as $store ) {
				$image_id =  get_post_meta( $store->ID, 'store_gmap_marker', true );
				$image_data = wp_get_attachment_image_src( $image_id, 'full' );
				$marker = !empty( $image_data[0] ) ? $image_data[0] : '';
				$latitude =  get_post_meta( $store->ID, 'store_gmap_latitude', true );
				$longitude =  get_post_meta( $store->ID, 'store_gmap_longitude', true );
				if( !empty( $latitude ) && !empty( $longitude ) ){
					$markers[] = array(
						'marker' => $marker,
						'latitude' => $latitude,
						'longitude' => $longitude,
						'url' => get_permalink( $store->ID ),
						'title' => get_the_title( $store->ID )
					);
				}
			}
		}
	}
	else if( $source == 'deals' ){
		$deals = get_posts(array(
			'post_type' => 'offer',
			'post_status' => 'publish',
			'posts_per_page' => '-1',
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
			)
		));

		if( !empty( $deals ) ){
			foreach ( $deals as $deal ) {
				$offer_store =  get_post_meta( $deal->ID, 'offer_store', true );
				$image_id = get_post_meta( $offer_store, 'store_gmap_marker', true );
				$image_data = wp_get_attachment_image_src( $image_id, 'full' );
				$marker = !empty( $image_data[0] ) ? $image_data[0] : '';
				$deal_markers = get_post_meta( $deal->ID, 'deal_markers' );
				if( !empty( $deal_markers ) ){
					foreach( $deal_markers as $deal_marker ){
						$markers[] = array(
							'marker' => $marker,
							'latitude' => $deal_marker['deal_marker_latitude'],
							'longitude' => $deal_marker['deal_marker_longitude'],
							'url' => get_permalink( $deal->ID ),
							'title' => get_the_title( $deal->ID )
						);						
					}
				}
			}
		}
	}

	$rnd = couponxl_random_string();

	$style_css = '<style> .'.$rnd.'{ height: '.$height.' } </style>';

	return couponxl_shortcode_style( $style_css ).'
	<div class="gmap">
		<div class="hidden main_map_markers">
			'.json_encode( $markers ).'
		</div>
		<div class="marker-map '.esc_attr( $rnd ).'"></div>
	</div>';	
}

add_shortcode( 'gmap', 'couponxl_gmap_func' );

function couponxl_gmap_params(){
	return array(
		array(
			"type" => "dropdown",
			"holder" => "div",
			"class" => "",
			"heading" => __("Dispaly","couponxl"),
			"param_name" => "source",
			"value" => array(
				__( 'Stores', 'couponxl' ) => 'stores',
				__( 'Deals', 'couponxl' ) => 'deals',
			),
			"description" => __("Select what to show on google map","couponxl")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Map Height","couponxl"),
			"param_name" => "height",
			"value" => '400px',
			"description" => __("Input map height in pixels","couponxl")
		),		
	);
}
?>