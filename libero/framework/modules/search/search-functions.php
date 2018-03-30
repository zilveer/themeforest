<?php

if( !function_exists('libero_mikado_search_body_class') ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function libero_mikado_search_body_class($classes) {

		if ( is_active_widget( false, false, 'mkd_search_opener' ) ) {

			$classes[] = 'mkd-' . libero_mikado_options()->getOptionValue('search_type');

			if ( libero_mikado_options()->getOptionValue('search_type') == 'fullscreen-search' ) {

				$classes[] = 'mkd-' . libero_mikado_options()->getOptionValue('search_animation');

			}

		}
		return $classes;

	}

	add_filter('body_class', 'libero_mikado_search_body_class');
}

if ( ! function_exists('libero_mikado_get_search') ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function libero_mikado_get_search() {

		if ( libero_mikado_active_widget( false, false, 'mkd_search_opener' ) ) {

			$search_type = libero_mikado_options()->getOptionValue('search_type');

			if ($search_type == 'search-covers-header') {
				libero_mikado_set_position_for_covering_search();
				return;
			} else if ($search_type == 'search-slides-from-window-top' || $search_type == 'search-slides-from-header-bottom') {
				libero_mikado_set_search_position_in_menu( $search_type );
				if ( libero_mikado_is_responsive_on() ) {
					libero_mikado_set_search_position_mobile();
				}
				return;
			}

			libero_mikado_load_search_template();

		}
	}

}

if ( ! function_exists('libero_mikado_set_position_for_covering_search') ) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function libero_mikado_set_position_for_covering_search() {

		$containing_sidebar = libero_mikado_active_widget( false, false, 'mkd_search_opener' );

		foreach ($containing_sidebar as $sidebar) {
			if ( strpos( $sidebar, 'top-bar' ) !== false ) {
				add_action( 'libero_mikado_after_header_top_html_open', 'libero_mikado_load_search_template');
			} else if ( strpos( $sidebar, 'header-top' ) !== false ) {
				add_action( 'libero_mikado_after_header_menu_area_html_open', 'libero_mikado_load_search_template');
			} else if ( strpos( $sidebar, 'main-menu' ) !== false ) {
				add_action( 'libero_mikado_after_header_menu_area_html_open', 'libero_mikado_load_search_template');
			} else if ( strpos( $sidebar, 'mobile-logo' ) !== false ) {
				add_action( 'libero_mikado_after_mobile_header_html_open', 'libero_mikado_load_search_template');
			} else if ( strpos( $sidebar, 'logo' ) !== false ) {
				add_action( 'libero_mikado_after_header_menu_area_html_open', 'libero_mikado_load_search_template');
			} else if ( strpos( $sidebar, 'sticky' ) !== false ) {
				add_action( 'libero_mikado_after_sticky_menu_html_open', 'libero_mikado_load_search_template');
			}

		}

	}

}

if ( ! function_exists('libero_mikado_set_search_position_in_menu') ) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function libero_mikado_set_search_position_in_menu( $type ) {

		add_action( 'libero_mikado_after_header_menu_area_html_open', 'libero_mikado_load_search_template');
		if ( $type == 'search-slides-from-header-bottom' ) {
			add_action( 'libero_mikado_after_sticky_menu_html_open', 'libero_mikado_load_search_template');
		}

	}
}

if ( ! function_exists('libero_mikado_set_search_position_mobile') ) {
	/**
	 * Hooks search template to mobile header
	 */
	function libero_mikado_set_search_position_mobile() {

		add_action( 'libero_mikado_after_mobile_header_html_open', 'libero_mikado_load_search_template');

	}

}

if ( ! function_exists('libero_mikado_load_search_template') ) {
	/**
	 * Loads HTML template with parameters
	 */
	function libero_mikado_load_search_template() {
		global $libero_mikado_IconCollections;

		$search_type = libero_mikado_options()->getOptionValue('search_type');

		$search_icon = '';
		$search_icon_close = '';
		if ( libero_mikado_options()->getOptionValue('search_icon_pack') !== '' ) {
			$search_icon = $libero_mikado_IconCollections->getSearchIcon( libero_mikado_options()->getOptionValue('search_icon_pack'), true );
			$search_icon_close = $libero_mikado_IconCollections->getSearchClose( libero_mikado_options()->getOptionValue('search_icon_pack'), true );
		}

		$parameters = array(
			'search_in_grid'		=> libero_mikado_options()->getOptionValue('search_in_grid') == 'yes' ? true : false,
			'search_icon'			=> $search_icon,
			'search_icon_close'		=> $search_icon_close
		);

		libero_mikado_get_module_template_part( 'templates/types/'.$search_type, 'search', '', $parameters );

	}

}