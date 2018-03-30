<?php

// =============================================================================
// Initializes and sets up the WordPress Live Preview feature by including
// sections, controls, and settings.
//
// - Sections: organize the controls.
// - Controls: receive input and pass it to the settings.
// - Settings: interface with the existing options in the theme.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Set path
//   02. Require Files
//   03. Enqueue files

// =============================================================================

// Set Path
// =============================================================================

$customizer_path = KLEO_LIB_DIR . '/customizer';



// Require Files
// =============================================================================

require_once( $customizer_path . '/controls.php' );
require_once( $customizer_path . '/register.php' );
require_once( $customizer_path . '/output.php' );



// Enqueue Files
// =============================================================================

if ( ! function_exists( 'kleo_enqueue_customizer_controls_scripts' ) ) {
    function kleo_enqueue_customizer_controls_scripts() {
        wp_enqueue_script('kleo-customizer-controls-js', KLEO_LIB_URI . '/customizer/assets/kleo-customizer-controls.js', array('jquery'), KLEO_THEME_VERSION, true);
    }

    add_action('customize_controls_print_footer_scripts', 'kleo_enqueue_customizer_controls_scripts');
}

if ( ! function_exists( 'kleo_enqueue_customizer_controls_styles' ) ) {
    function kleo_enqueue_customizer_controls_styles() {
        wp_enqueue_style('kleo-customizer-controls', KLEO_LIB_URI . '/customizer/assets/customizer-controls.css', NULL, KLEO_THEME_VERSION, 'all');
    }

    add_action('customize_controls_print_styles', 'kleo_enqueue_customizer_controls_styles');
}


/**
 * Used by hook: 'customize_preview_init'
 *
 * @see add_action('customize_preview_init',$func)
 */
function kleo_customizer_live_preview() {
    wp_enqueue_script(
        'kleo-customizer',			//Give the script an ID
        KLEO_LIB_URI . '/customizer/assets/theme-customizer.js', //Point to file
        array( 'jquery','customize-preview' ),	//Define dependencies
        '',						//Define a version (optional)
        true						//Put script in footer?
    );
}
add_action( 'customize_preview_init', 'kleo_customizer_live_preview' );


//Write changes after customizer save
add_action( 'customize_save_after', 'kleo_unlink_dynamic_css' );