<?php 

/**
 * We use LESS CSS in Pivot, don't worry, this is all parsed and cached the first time you load your page,
 * or when you change the theme options, this is not re-compiled on every page load.
 * Variables are passed to the LESS files from the enqueue section of theme_functions
 * If you need to you can edit the LESS files manually, though you'd be best doing this from a child theme.
 */
get_template_part( 'admin/lessc.inc' );
get_template_part( 'admin/wp-less' );

/**
 * Load standard areas of the theme-side framework
 * These should be loaded at all times.
 */
get_template_part( 'admin/theme_menus_widgets' );
get_template_part( 'admin/theme_functions' );
get_template_part( 'admin/theme_scripts' );
get_template_part( 'admin/theme_filters' );
get_template_part( 'admin/theme_support' );
get_template_part( 'admin/theme_options' );

/**
 * Some parts of the framework only need to run on admin views.
 * These would be those.
 * Calling these only on admin saves some operation time for the theme, everything in the name of speed.
 */
if( is_admin() ){
	if (!( class_exists( 'TGM_Plugin_Activation' ) ))
		get_template_part( 'admin/class-tgm-plugin-activation' );
	
	get_template_part( 'admin/theme_metaboxes' );
}

/**
 * If WPML exists, let's load in our custom functions.
 */
if( function_exists('icl_get_languages') ){
	get_template_part( 'admin/theme_wpml' );
}

/**
 * If WooCommerce exists, let's load in our custom functions.
 */
if( class_exists('Woocommerce') ){
	get_template_part( 'admin/theme_woocommerce');
}