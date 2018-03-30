<?php
/**
 * Theme Name: 		SPECTRA - Responsive Music Wordpress Theme
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			customizer.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */

global $spectra_opts;

function spectra_customize_register( $wp_customize ) {

	// Section
    $wp_customize->add_section(
        'theme_colors',
        array(
            'title' => __( 'Theme Colors', SPECTRA_THEME ),
            'description' => __( 'Change default theme colors. Please SAVE and REFRESH your browser to see the new styles.', SPECTRA_THEME ),
            'priority' => 35,
        )
    );

    // ACCENT COLOR
    $wp_customize->add_setting(
    	'accent_color',
	    array(
	        'default' => '#f4624a',
        	'sanitize_callback' => 'sanitize_hex_color',
        	'transport'   => 'postMessage'
	    )
	);
	$wp_customize->add_control(
	    'accent_color',
	    array(
	        'label' => 'Accent Color',
	        'section' => 'theme_colors',
	        'type' => 'text'
	    )
	);
	$wp_customize->add_control(
    	new WP_Customize_Color_Control(
	        $wp_customize,
	        'accent_color',
	        array(
	            'label' => 'Accent Color',
	            'section' => 'theme_colors',
	            'settings' => 'accent_color',

	        )
	    )
	);

	 // HEADINGS COLORS
    $wp_customize->add_setting(
    	'headings_color',
	    array(
	        'default' => '#ffffff',
        	'sanitize_callback' => 'sanitize_hex_color',
        	'transport'   => 'postMessage'
	    )
	);
	$wp_customize->add_control(
	    'headings_color',
	    array(
	        'label' => 'Headings Colors',
	        'section' => 'theme_colors',
	        'type' => 'text'
	    )
	);
	$wp_customize->add_control(
    	new WP_Customize_Color_Control(
	        $wp_customize,
	        'headings_color',
	        array(
	            'label' => 'Haadings Colors',
	            'section' => 'theme_colors',
	            'settings' => 'headings_color',

	        )
	    )
	);

	// BODY BACKGROUND COLOR
    $wp_customize->add_setting(
    	'body_bg_color',
	    array(
	        'default' => '#222222',
        	'sanitize_callback' => 'sanitize_hex_color',
        	'transport'   => 'postMessage'
	    )
	);
	$wp_customize->add_control(
	    'body_bg_color',
	    array(
	        'label' => 'Body Background Color',
	        'section' => 'theme_colors',
	        'type' => 'text'
	    )
	);
	$wp_customize->add_control(
    	new WP_Customize_Color_Control(
	        $wp_customize,
	        'body_bg_color',
	        array(
	            'label' => 'Body Background Color',
	            'section' => 'theme_colors',
	            'settings' => 'body_bg_color',

	        )
	    )
	);

	// BODY COLOR
    $wp_customize->add_setting(
    	'body_color',
	    array(
	        'default' => '#b1b1b1',
        	'sanitize_callback' => 'sanitize_hex_color',
        	'transport'   => 'postMessage'
	    )
	);
	$wp_customize->add_control(
	    'body_color',
	    array(
	        'label' => 'Body Color',
	        'section' => 'theme_colors',
	        'type' => 'text'
	    )
	);
	$wp_customize->add_control(
    	new WP_Customize_Color_Control(
	        $wp_customize,
	        'body_color',
	        array(
	            'label' => 'Body Color',
	            'section' => 'theme_colors',
	            'settings' => 'body_color',

	        )
	    )
	);

}
add_action( 'customize_register', 'spectra_customize_register' );