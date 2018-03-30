<?php

$args = array(
	'post_type' => 'offer',
	'post_title' => $offer_title,
	'post_content' => $offer_description,
	'post_status' => 'draft',
	'tax_input' => array()
);

if( !empty( $offer_cat ) ){
	$all_cats = array();
	$all_to_assign = get_ancestors( $offer_cat, 'offer_cat' );
	if( !empty( $all_to_assign ) ){
		$all_cats = $all_to_assign;
	}
	$all_cats[] = $offer_cat;
	$args['tax_input']['offer_cat'] = $all_cats;
}
if( !empty( $location ) ){
	$all_locations = array();
	$all_to_locations = get_ancestors( $location, 'location' );
	if( !empty( $all_to_locations ) ){
		$all_locations = $all_to_locations;
	}
	$all_locations[] = $location;	
	$args['tax_input']['location'] = $all_locations;
}

if( $offer_type == 'coupon' && !empty( $coupon_excerpt ) ){
	$args['post_excerpt'] = $coupon_excerpt;
}

$offer_id = wp_insert_post( $args );

set_post_thumbnail( $offer_id, $offer_featured_image );

update_post_meta( $offer_id, 'offer_type', $offer_type );
update_post_meta( $offer_id, 'offer_store', $offer_store );
update_post_meta( $offer_id, 'offer_new_store', $offer_new_store );
update_post_meta( $offer_id, 'offer_new_category', $offer_new_category );
update_post_meta( $offer_id, 'offer_new_location', $offer_new_location );
update_post_meta( $offer_id, 'offer_start', (float)$offer_start );
update_post_meta( $offer_id, 'offer_expire', (float)$offer_expire );
update_post_meta( $offer_id, 'offer_in_slider', 'no' );

/* SAVE COUPON SPECIFIC DATA */
if( $offer_type == 'coupon' ){
	update_post_meta( $offer_id, 'coupon_type', $coupon_type );
	update_post_meta( $offer_id, 'coupon_code', $coupon_code );
	update_post_meta( $offer_id, 'coupon_sale', $coupon_sale );
	update_post_meta( $offer_id, 'coupon_image', $coupon_image );
	update_post_meta( $offer_id, 'coupon_link', $coupon_link );
	$offer_submit_price = couponxl_get_option( 'coupon_submit_price' );
}	
/* SAVE DEAL SPECIFIC DATA */
else{
	update_post_meta( $offer_id, 'deal_link', $deal_link );
	update_post_meta( $offer_id, 'deal_items', $deal_items );
	update_post_meta( $offer_id, 'deal_item_vouchers', $deal_item_vouchers );
	update_post_meta( $offer_id, 'deal_price', $deal_price );
	update_post_meta( $offer_id, 'deal_sale_price', $deal_sale_price );
	update_post_meta( $offer_id, 'deal_discount', $deal_discount );
	update_post_meta( $offer_id, 'deal_in_short', $deal_in_short );
	if( !empty( $deal_markers ) ){
		for( $i=0; $i<sizeof( $deal_markers['deal_marker_longitude'] ); $i++ ) {
			if( !empty( $deal_markers['deal_marker_longitude'][$i] ) && !empty( $deal_markers['deal_marker_latitude'][$i] ) ){
				add_post_meta( $offer_id, 'deal_markers', array(
					'deal_marker_longitude' => $deal_markers['deal_marker_longitude'][$i],
					'deal_marker_latitude' => $deal_markers['deal_marker_latitude'][$i]
				) );
			}
		}
	}
	if( !empty( $deal_images ) ){
		$deal_images = explode( ",", $deal_images );
		$deal_images_array = array();
		$counter = 0;
		foreach ( $deal_images as $deal_image ) {
			$deal_images_array['sm-field-'.$counter] = $deal_image;
			$counter++;
		}
		$deal_images = array( serialize( $deal_images_array ) );
		update_post_meta( $offer_id, 'deal_images', implode( "", $deal_images ) );
	}
	update_post_meta( $offer_id, 'deal_type', $deal_type );
	$offer_submit_price = couponxl_get_option( 'deal_submit_price' );
}

echo '<div class="deal-message"></div>';
if( !empty( $offer_submit_price ) ){
	update_post_meta( $offer_id, 'offer_initial_payment', 'not_paid' );
	ob_start();
	couponxl_offer_submit_paypal_link( $offer_id );
	$response = ob_get_contents();
	ob_end_clean();
	if( !isset( $response['error'] ) ){
		$message = '<div class="alert alert-info">'.__( 'Your offer is successfully submited. In  order to be reviewd and approved you need to pay for its submission. You can do that by clicking on ', 'couponxl' ).''.$response.'</div>';
		couponxl_new_offer( $offer_id );
	}
	else{
		$message = '<div class="alert alert-danger">'.$response['error'].'</a></div>';
	}														
}
else{
	update_post_meta( $offer_id, 'offer_initial_payment', 'paid' );
	$message = '<div class="alert alert-success">'.__( 'Your offer is submited and it will be reviewed as soon as possible', 'couponxl' ).'</div>';
	couponxl_new_offer( $offer_id );
}

?>