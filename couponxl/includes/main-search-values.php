<?php

$term_name = '';
if( empty( $location ) ){
	$initial_location = couponxl_get_option( 'initial_location' );
	$term = get_term_by( 'id', $initial_location, 'location' );
	if( !empty( $term ) ){
		$location = $term->slug;
		$term_name = $term->name;
	}
}
else{
    $term_location = get_term_by( 'slug', $location, 'location' );
    if( !empty( $term_location ) ){
    	$term_name = $term_location->name;
    }
}


$store_name = '';
if( !empty( $offer_store ) ){
    $store_obj = get_post( $offer_store );
    $store_name = $store_obj->post_title;
}
?>