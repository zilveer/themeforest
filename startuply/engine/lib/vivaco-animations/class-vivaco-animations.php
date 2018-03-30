<?php

/**
 * We need to define this so that VC will show our nesting container correctly
 */
if ( class_exists( 'WPBakeryShortCodesContainer' ) && ! class_exists( 'WPBakeryShortCode_Css_Animation' ) ) {
	class WPBakeryShortCode_Css_Animation extends WPBakeryShortCodesContainer {
	}
} else {
	// If we can't detech the classes it means that VC is embeded in a theme,
	global $composer_settings;

	// The class WPBakeryShortCodesContainer is defined in VC's shortcodes.php, include it so we can define our container
	if ( ! empty( $composer_settings ) ) {
		if ( array_key_exists( 'COMPOSER_LIB', $composer_settings ) ) {
			$lib_dir = $composer_settings['COMPOSER_LIB'];
			if ( file_exists( $lib_dir . 'shortcodes.php' ) ) {
				require_once( $lib_dir . 'shortcodes.php' );
			}
		}
	}

	// We need to define this so that VC will show our nesting container correctly
	if ( class_exists( 'WPBakeryShortCodesContainer' ) && ! class_exists( 'WPBakeryShortCode_Css_Animation' ) ) {
		class WPBakeryShortCode_Css_Animation extends WPBakeryShortCodesContainer {
		}
	}
}
