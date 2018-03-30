<?php
/**
 * Demo Imported Settings
 *
 * @package	HelpingHands
 * @author Skat
 * @copyright 2015, Skat Design
 * @link http://www.skat.tf
 * @since HelpingHands 1.0
 */

if ( !function_exists( 'wbc_importer_description_text' ) ) {
	function wbc_importer_description_text( $description ) {
		$message = '<p>'. esc_html__( 'Best if used on new WordPress install.', 'framework' ) .'</p>';
		$message .= '<p>'. esc_html__( 'Images are for demo purpose only.', 'framework' ) .'</p>';
		$message .= '<p>'. esc_html__( 'Please be patient. Importing the demo content may take a while.', 'framework' ) .'</p>';
		return $message;
	}

	add_filter( 'wbc_importer_description', 'wbc_importer_description_text', 10 );
}

if ( ! function_exists( 'wbc_filter_title' ) ) {
			/**
			 * Filter for changing demo title in options panel so it's not folder name.
			 *
			 * @param [string] $title name of demo data folder
			 *
			 * @return [string] return title for demo name.
			 */
			function wbc_filter_title( $title ) {
				return trim( ucfirst( str_replace( "-", " ", $title ) ) );
			}
			add_filter( 'wbc_importer_directory_title', 'wbc_filter_title', 10 );
		}

if ( ! function_exists( 'sd_set_home_menu' ) ) {
	function sd_set_home_menu( $demo_active_import , $demo_directory_path ) {

		reset( $demo_active_import );
		$current_key = key( $demo_active_import );
		
		/************************************************************************
		* Import slider(s) for the current demo being imported
		*************************************************************************/
		if ( class_exists( 'RevSlider' ) ) {

			$wbc_sliders_array = array(
				'style-1' => 'homeslider.zip',
				'style-2' => 'homeslider1.zip',
				'style-3' => 'homeslider2.zip',
				'style-4' => 'homeslider3.zip',
			);
			if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
				$wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];
				if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
					$slider = new RevSlider();
					$slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
				}
			}
		}

		/************************************************************************
		* Setting Menus
		*************************************************************************/

		$wbc_menu_array = array( 'style-1', 'style-3', 'style-4' );

		if ( isset( $demo_active_import[$current_key]['directory'] ) && ! empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$top_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );

			if ( isset( $top_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-header-menu' => $top_menu->term_id,
					)
				);
			}
			
			$footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
			
			if ( isset( $footer_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'footer-menu' => $footer_menu->term_id,
					)
				);
			}

		}
		
		$wbc_menu_array2 = array( 'style-2' );

		if ( isset( $demo_active_import[$current_key]['directory'] ) && ! empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array2 ) ) {
			$top_menu2 = get_term_by( 'name', 'Main Menu', 'nav_menu' );

			if ( isset( $top_menu2->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'top-bar-menu' => $top_menu2->term_id,
					)
				);
			}
			
			$footer_menu2 = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
			
			if ( isset( $footer_menu2->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'footer-menu' => $footer_menu2->term_id,
					)
				);
			}

		}

		/************************************************************************
		* Set HomePage
		*************************************************************************/

		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'style-1' => 'Home',
			'style-2' => 'Home',
			'style-3' => 'Home',
			'style-4' => 'Home',
		);

		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}

	}
	add_action( 'wbc_importer_after_content_import', 'sd_set_home_menu', 10, 2 );
}