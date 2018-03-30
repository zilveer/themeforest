<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Get woo_options
global $woo_options;

// $wo_logo			= ( isset( $woo_options['woo_texttitle'] ) && $woo_options['woo_texttitle'] == 'true' ) && ( isset( $woo_options['woo_tagline'] ) && $woo_options['woo_tagline'] == 'true' );

// Setup the tag to be used for the header area (`h1` on the front page and `span` on all others).
$heading_tag 		= 'span';
if ( is_home() || is_front_page() ) { $heading_tag = 'h1'; }

// Get our website's name, description and URL. We use them several times below so lets get them once.
$site_title 		= esc_attr( get_bloginfo( 'name' ) );
$site_description 	= esc_attr( get_bloginfo( 'description' ) );
$site_url 			= esc_url( home_url( '/' ) );

// get customizer options
$df_options 		= get_theme_mod( 'df_options' );
// get logo url
$logo_url 			= isset( $df_options['logo'] ) ? esc_url( $df_options['logo'] ) : NULL;
// get retina logo url
$retina_logo_url 	= isset( $df_options['retina_logo'] ) ? esc_url( $df_options['retina_logo'] ) : NULL;
// get retina logo width
$retina_logo_width 	= isset( $df_options['width_logo'] ) ? esc_attr( $df_options['width_logo'] ) : NULL;
// get retina logo height
$retina_logo_height	= isset( $df_options['height_logo'] ) ? esc_attr( $df_options['height_logo'] ) : NULL;
// customize logo logic
// $customize_logo		= isset( $df_options['logo'] ) && $df_options['logo'] != '';


// html logo
echo '<div id="logo">';

	//Website heading/logo and description text.
	if ( $logo_url ) :

		if ( is_ssl() ) :
		    $logo_url = str_replace( 'http://', 'https://', $logo_url );
		endif;

		echo '<a href="' . $site_url . '" title="' . $site_description . '"><img src="' . $logo_url . '" alt="' . $site_title . '" class="logo-normal" /></a>';

	    // Opt Retina Logo
		// if ( isset( $df_options['retina_logo'] ) && $df_options['retina_logo'] != '' ) :
		if ( $retina_logo_url ) :
			echo '<a href="' . $site_url . '" title="' . $site_description . '"><img src="' . $retina_logo_url . '" width="' . $retina_logo_width . '" height="' . $retina_logo_height . '" alt="' . $site_title . '" class="logo-retina" /></a>';
		endif;

	else :

		echo '<'. $heading_tag . ' class="site-title"><a href="' . $site_url . '">' . $site_title . '</a></' . $heading_tag . '>';

		if ( $site_description != '' ) :
		    echo '<span class="site-description">' . $site_description . '</span>';
		endif;

	endif; // End IF Statement

echo '</div>';