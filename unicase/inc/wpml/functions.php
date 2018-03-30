<?php

if ( ! function_exists( 'unicase_style_icl_languages_dropdown' ) ) {
	function unicase_style_icl_languages_dropdown( $items, $args ) {
		$items = str_replace( 'menu-item-language-current', 'menu-item-language-current dropdown', $items );
		$items = str_replace( '<a href="#" onclick="return false">', '<a href="#" data-toggle="dropdown" onclick="return false">', $items );
		$items = str_replace( 'submenu-languages', 'submenu-languages dropdown-menu', $items );
		return $items;
	}
}