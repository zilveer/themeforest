<?php
	//register view
	$views = get_post_meta( get_the_ID(), 'offer_views', true );
	if( empty( $views ) ){
		$views = 1;
	}
	else{
		$views++;
	}
	update_post_meta( get_the_ID(), 'offer_views', $views );
	$offer_type = get_post_meta( get_the_ID(), 'offer_type', true );
	if( $offer_type == 'coupon' ){
	    include( locate_template( 'includes/offers/coupons.php' ) );
	}
	else{
	    include( locate_template( 'includes/offers/deals.php' ) );
	}
?>