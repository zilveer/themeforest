<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * Theme appearance.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Modules\Core\Appearance
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$thb_tc = new THB_ThemeCustomization();
$thb_theme = thb_theme();

/**
 * Theme modification cached option
 */
thb_define('THB_CUSTOMIZATIONS', 'thb_theme_customizations_' . get_option( 'stylesheet' ));

// Customizer shortcut ---------------------------------------------------------

if( !function_exists('thb_customizer_shortcut') ) {
	function thb_customizer_shortcut() {
		if( thb_system_is_development() ) {
			$page_title = __('Customize', 'thb_text_domain');
			add_theme_page($page_title, $page_title, 'edit_theme_options', 'customize.php');
		}
	}
	// add_action( 'admin_menu', 'thb_customizer_shortcut', 99 );
}

// -----------------------------------------------------------------------------

$thb_theme->setCustomization($thb_tc);

if( ! function_exists('thb_render_customizations') ) {
	function thb_render_customizations( $oldvalue=null, $_newvalue=null ) {
		ob_start();
		thb_theme()->getCustomization()->render(true);
		$css = ob_get_clean();

		update_option(THB_CUSTOMIZATIONS, $css);
	}

	add_action( 'update_option_theme_mods_' . get_option( 'stylesheet' ), 'thb_render_customizations', 9999 );
}

if( ! function_exists('thb_populate_customizations') ) {
	function thb_populate_customizations() {
		thb_render_customizations();
	}

	if( get_option(THB_CUSTOMIZATIONS) == '' ) {
		add_action( 'init', 'thb_populate_customizations' );
	}
}

if( ! function_exists('thb_append_theme_customization') ) {
	function thb_append_theme_customization() {
		thb_css_start('thb_theme_customization');
			thb_theme()->getCustomization()->render(true);
			// echo get_option(THB_CUSTOMIZATIONS);
			thb_custom_css();
		thb_css_end();
	}

	add_action( 'thb_head', 'thb_append_theme_customization' );
}