<?php

if ( !defined( "crazyblog_DIR" ) )
	die( '!!!' );


$nested = array(
	'crazyblog_author_info_with_carousal' => 'crazyblog_author_info_with_carousal_block',
);

if ( !empty( $nested ) && count( $nested ) > 0 ) {
	foreach ( $nested as $parent => $child ) {
		if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
			if ( function_exists( 'crazyblog_nested_shortcode' ) ) {
				crazyblog_nested_shortcode( "class WPBakeryShortCode_{$parent} extends WPBakeryShortCodesContainer{}" );
			}
		}
		if ( class_exists( 'WPBakeryShortCode' ) ) {
			if ( function_exists( 'crazyblog_nested_shortcode' ) ) {
				crazyblog_nested_shortcode( "class WPBakeryShortCode_{$child} extends WPBakeryShortCode{}" );
			}
		}
	}
}




