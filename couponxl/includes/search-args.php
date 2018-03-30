<?php
	$permalink = couponxl_get_permalink_by_tpl( 'page-tpl_search_page' );
	global $wp, $couponxl_slugs;
	
	foreach( $couponxl_slugs as $slug => $trans_slug ){
		global $$slug;
		$$slug = isset( $wp->query_vars[$trans_slug] ) ? $wp->query_vars[$trans_slug] : '';
		if( empty( $$slug ) ){
			$$slug = isset( $wp->query_vars[$slug] ) ? $wp->query_vars[$slug] : '';
		}
	}

	$default_offer_listing = couponxl_get_option( 'default_offer_listing' );
	if( empty( $offer_view ) ){
		$offer_view = $default_offer_listing;
	}

	if( isset( $keyword ) ){
		$keyword = str_replace( '_', ' ', $keyword );
		$keyword = urldecode( $keyword );
	}

?>