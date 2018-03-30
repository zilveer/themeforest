<?php

if( !function_exists('qode_startit_search_body_class') ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function qode_startit_search_body_class($classes) {

		if ( is_active_widget( false, false, 'qode_search_opener' ) ) {

			$classes[] = 'qodef-' . qode_startit_options()->getOptionValue('search_type');

			if ( qode_startit_options()->getOptionValue('search_type') == 'fullscreen-search' ) {

				$classes[] = 'qodef-' . qode_startit_options()->getOptionValue('search_animation');

			}

		}
		return $classes;

	}

	add_filter('body_class', 'qode_startit_search_body_class');
}

if ( ! function_exists('qode_startit_get_search') ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function qode_startit_get_search() {

		if ( qode_startit_active_widget( false, false, 'qode_search_opener' ) ) {

			$search_type = qode_startit_options()->getOptionValue('search_type');

			if ($search_type == 'search-covers-header') {
				qode_startit_set_position_for_covering_search();
				return;
			} else if ($search_type == 'search-slides-from-window-top') {
				qode_startit_set_search_position_in_menu( $search_type );
				if ( qode_startit_is_responsive_on() ) {
					qode_startit_set_search_position_mobile();
				}
				return;
			}

			qode_startit_load_search_template();

		}
	}

}

if ( ! function_exists('qode_startit_set_position_for_covering_search') ) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function qode_startit_set_position_for_covering_search() {

		$containing_sidebar = qode_startit_active_widget( false, false, 'qode_search_opener' );

		foreach ($containing_sidebar as $sidebar) {

			if ( strpos( $sidebar, 'top-bar' ) !== false ) {
				add_action( 'qode_startit_after_header_top_html_open', 'qode_startit_load_search_template');
			} else if ( strpos( $sidebar, 'main-menu' ) !== false ) {
				add_action( 'qode_startit_after_header_menu_area_html_open', 'qode_startit_load_search_template');
			} else if ( strpos( $sidebar, 'mobile-logo' ) !== false ) {
				add_action( 'qode_startit_after_mobile_header_html_open', 'qode_startit_load_search_template');
			} else if ( strpos( $sidebar, 'logo' ) !== false ) {
				add_action( 'qode_startit_after_header_logo_area_html_open', 'qode_startit_load_search_template');
			} else if ( strpos( $sidebar, 'sticky' ) !== false ) {
				add_action( 'qode_startit_after_sticky_menu_html_open', 'qode_startit_load_search_template');
			}

		}

	}

}

if ( ! function_exists('qode_startit_set_search_position_in_menu') ) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function qode_startit_set_search_position_in_menu( $type ) {

		add_action( 'qode_startit_after_header_menu_area_html_open', 'qode_startit_load_search_template');

	}
}

if ( ! function_exists('qode_startit_set_search_position_mobile') ) {
	/**
	 * Hooks search template to mobile header
	 */
	function qode_startit_set_search_position_mobile() {

		add_action( 'qode_startit_after_mobile_header_html_open', 'qode_startit_load_search_template');

	}

}

if ( ! function_exists('qode_startit_load_search_template') ) {
	/**
	 * Loads HTML template with parameters
	 */
	function qode_startit_load_search_template() {
		global $qode_startit_IconCollections;

		$search_type = qode_startit_options()->getOptionValue('search_type');

		$search_icon = '';
		$search_icon_close = '';
		if ( qode_startit_options()->getOptionValue('search_icon_pack') !== '' ) {
			$search_icon = $qode_startit_IconCollections->getSearchIcon( qode_startit_options()->getOptionValue('search_icon_pack'), true );
			$search_icon_close = $qode_startit_IconCollections->getSearchClose( qode_startit_options()->getOptionValue('search_icon_pack'), true );
		}

		$parameters = array(
			'search_in_grid'		=> qode_startit_get_meta_field_intersect('search_in_grid') == 'yes' ? true : false,
			'search_icon'			=> $search_icon,
			'search_icon_close'		=> $search_icon_close
		);

		qode_startit_get_module_template_part( 'templates/types/'.$search_type, 'search', '', $parameters );

	}

}