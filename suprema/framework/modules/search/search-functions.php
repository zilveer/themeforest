<?php

if( !function_exists('suprema_qodef_search_body_class') ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function suprema_qodef_search_body_class($classes) {

		if ( is_active_widget( false, false, 'qode_search_opener' ) ) {

			$classes[] = 'qodef-' . suprema_qodef_options()->getOptionValue('search_type');

			if ( suprema_qodef_options()->getOptionValue('search_type') == 'fullscreen-search' ) {

				$classes[] = 'qodef-search-fade';

			}

		}
		return $classes;

	}

	add_filter('body_class', 'suprema_qodef_search_body_class');
}

if ( ! function_exists('suprema_qodef_get_search') ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function suprema_qodef_get_search() {

		if ( suprema_qodef_active_widget( false, false, 'qode_search_opener' ) ) {

			$search_type = suprema_qodef_options()->getOptionValue('search_type');

			if ($search_type == 'search-covers-header') {
				suprema_qodef_set_position_for_covering_search();
				return;
			}

			suprema_qodef_load_search_template();

		}
	}

}

if ( ! function_exists('suprema_qodef_set_position_for_covering_search') ) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function suprema_qodef_set_position_for_covering_search() {

		$containing_sidebar = suprema_qodef_active_widget( false, false, 'qode_search_opener' );

		foreach ($containing_sidebar as $sidebar) {

			if ( strpos( $sidebar, 'top-bar' ) !== false ) {
				add_action( 'suprema_qodef_after_header_top_html_open', 'suprema_qodef_load_search_template');
			} else if ( strpos( $sidebar, 'main-menu' ) !== false ) {
				add_action( 'suprema_qodef_after_header_menu_area_html_open', 'suprema_qodef_load_search_template');
			} else if ( strpos( $sidebar, 'mobile-logo' ) !== false ) {
				add_action( 'suprema_qodef_after_mobile_header_html_open', 'suprema_qodef_load_search_template');
			} else if ( strpos( $sidebar, 'logo' ) !== false ) {
				add_action( 'suprema_qodef_after_header_logo_area_html_open', 'suprema_qodef_load_search_template');
			} else if ( strpos( $sidebar, 'sticky' ) !== false ) {
				add_action( 'suprema_qodef_after_sticky_menu_html_open', 'suprema_qodef_load_search_template');
			}

		}

	}

}

if ( ! function_exists('suprema_qodef_set_search_position_in_menu') ) {
	/**
	 * Finds part of header where search template will be loaded
	 */
	function suprema_qodef_set_search_position_in_menu( $type ) {

		add_action( 'suprema_qodef_after_header_menu_area_html_open', 'suprema_qodef_load_search_template');

	}
}

if ( ! function_exists('suprema_qodef_set_search_position_mobile') ) {
	/**
	 * Hooks search template to mobile header
	 */
	function suprema_qodef_set_search_position_mobile() {

		add_action( 'suprema_qodef_after_mobile_header_html_open', 'suprema_qodef_load_search_template');

	}

}

if ( ! function_exists('suprema_qodef_load_search_template') ) {
	/**
	 * Loads HTML template with parameters
	 */
	function suprema_qodef_load_search_template() {
		global $suprema_qodef_IconCollections;

		$search_type = suprema_qodef_options()->getOptionValue('search_type');

		$search_icon = '';
		$search_icon_close = '';
		if ( suprema_qodef_options()->getOptionValue('search_icon_pack') !== '' ) {
			$search_icon = $suprema_qodef_IconCollections->getSearchIcon( suprema_qodef_options()->getOptionValue('search_icon_pack'), true );
			$search_icon_close = $suprema_qodef_IconCollections->getSearchClose( suprema_qodef_options()->getOptionValue('search_icon_pack'), true );
		}

		$parameters = array(
			'search_in_grid'		=> suprema_qodef_options()->getOptionValue('search_in_grid') == 'yes' ? true : false,
			'search_icon'			=> $search_icon,
			'search_icon_close'		=> $search_icon_close
		);

		suprema_qodef_get_module_template_part( 'templates/types/'.$search_type, 'search', '', $parameters );

	}

}