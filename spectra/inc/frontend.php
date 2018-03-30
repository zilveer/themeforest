<?php
/**
 * Plugin Name: 	Spectra
 * Theme Author: 	Mariusz Rek - Rascals Themes
 * Theme URI: 		http://rascals.eu/spectra
 * Author URI: 		http://rascals.eu
 * File:			frontend.php
 * =========================================================================================================================================
 *
 * @package spectra
 * @since 1.0.0
 */

/* ----------------------------------------------------------------------
	GOOGLE FONTS
/* ---------------------------------------------------------------------- */
function spectra_google_fonts() {
	global $spectra_opts;

	if ( $spectra_opts->get_option( 'use_google_fonts' ) == 'on' ) {
	    if ( $spectra_opts->get_option( 'google_fonts' ) ) {
		    foreach ( $spectra_opts->get_option( 'google_fonts' ) as $font ) {
		    	$temp_font = str_replace( ',', '%2C', $font['font_link'] );
				$spectra_opts->e_esc( $temp_font );
			}
			if ( $spectra_opts->get_option( 'google_code' ) ) {
			   echo '<style type="text/css" media="screen">' . "\n";
			   $spectra_opts->e_get_option( 'google_code' );
			   echo '</style>' . "\n";
			}
		}
	}
}

add_action( 'wp_head', 'spectra_google_fonts' );


/* ----------------------------------------------------------------------
	CUSTOMIZER
/* ---------------------------------------------------------------------- */
function spectra_customizer() {
	global $spectra_opts;

	// Accent Color
	echo "\n" . '<style type="text/css" media="screen">' . "\n";
	$accent_color = get_theme_mod( 'accent_color', '#f4624a' );
	if ( '#f4624a' !== $accent_color ) {
		
		echo '
			/* Selection */
			::-moz-selection { background: ' . $accent_color . ' }
		 	::selection { background: ' . $accent_color . ' }
			
			/* Color */
		   	a, a > *, 
		   	.entry-meta a:hover,
		   	.color,
		   	#slidebar header a:hover,
		   	#slidebar header a:hover span,
		   	#slidemenu header a:hover,
			#slidemenu header a:hover span, 
		   	.entry-title a:hover,
		   	.entry-meta a:hover,
		   	.blog-grid-items article .entry-grid-title a:hover,
		   	.content-title a:hover,
			.countdown .seconds,
			#events-list .event-date, #events-list-anim .event-date,
			#events-list-anim h2, #events-list-anim h2 a:hover,
			.masonry-events .event-date,
			.masonry-events .event-brick:hover .event-title,
			.comment .author a:hover,
			.widget a:hover,
			.widget-title a:hover,
			.widget table#wp-calendar #next a:hover, .widget table#wp-calendar #prev a:hover,
			.widget_rss li a,
			.tweets-widget li a,
			.tweets-widget li .date a:hover,
			.tweets li .date a:hover, /* >> Start shortcodes color */
			.tweets-slider .slide .date a:hover,
			.single-track .track-title:hover,
			ol.tracklist .track-buttons a:hover
			{ color: ' . $accent_color . ' }

			/* Background color */
			.edit-link a:hover,
			.comments-link,
			.section-sign,
			.widget table .buy-tickets:hover,
			.comment .reply a,
			.widget button,
			.widget .button,
			.widget input[type="button"],
			.widget input[type="reset"],
			.widget input[type="submit"],
			.widget_tag_cloud .tagcloud a:hover,
			input[type="submit"], button, .btn, .widget .btn,
			.thumb-icon .icon,
			.badge.new,
			.steps .step .step-number, /* >> Start shortcodes color */
			.single-track .track-buttons a,
			.icon_column a:hover,
			#site .wpb_tour_next_prev_nav a
		   	{ background-color: ' . $accent_color . ' }

		   	/* Border color */
			#slidemenu ul li a:hover
			{ border-color: ' . $accent_color . ' }
		';
		
	}

	// Headings
	$headings_color = get_theme_mod( 'headings_color', '#ffffff' );
	if ( '#ffffff' !== $headings_color ) {
		echo 'h1, h2, h3, h4, h5, h6 { color: ' . $headings_color . ' }';
	}

	// Body BG color
	$body_bg_color = get_theme_mod( 'body_bg_color', '#222222' );
	if ( '#222222' !== $body_bg_color ) {
		echo 'body { background-color: ' . $body_bg_color . ' }';
	}

	// Body Color
	$body_color = get_theme_mod( 'body_color', '#b1b1b1' );
	if ( '#b1b1b1' !== $body_color ) {
		echo 'body { color: ' . $body_color . ' }';
	}
	echo '</style>' . "\n";
	
}

add_action( 'wp_head', 'spectra_customizer' );


/* ----------------------------------------------------------------------
	QUICK CSS
/* ---------------------------------------------------------------------- */
function spectra_quick_css() {
	global $spectra_opts;
	
    if ( $spectra_opts->get_option( 'custom_css' ) &&  $spectra_opts->get_option( 'custom_css' ) != ''  ) {
	  
		echo '<style type="text/css" media="screen" id="custom_css_">' . "\n";
		$spectra_opts->e_get_option( 'custom_css' );
		echo '</style>' . "\n";
	}
	
}

//add_action( 'wp_head', 'spectra_quick_css' );

// By External File
function spectra_quick_css_file() {
	
	global $spectra_opts;

    /* CSS */
	if ( $spectra_opts->get_option( 'custom_css' ) && $spectra_opts->get_option( 'custom_css' ) != '' ) {
        wp_enqueue_style( 'quick-css', get_template_directory_uri() . '/inc/quick-css.php' );
    }

}
add_action( 'wp_enqueue_scripts', 'spectra_quick_css_file' );


/* ----------------------------------------------------------------------
	QUICK JS
/* ---------------------------------------------------------------------- */
function spectra_quick_js() {
	global $spectra_opts;
	
    if ( $spectra_opts->get_option( 'custom_js' ) &&  $spectra_opts->get_option( 'custom_js' ) != ''  ) {
	  
		echo '<script type="text/javascript" id="custom_javascripts_">' . "\n";
		$spectra_opts->e_get_option( 'custom_js' );
		echo '</script>' . "\n";
	}
	
}
// add_action( 'wp_head', 'spectra_quick_js' );

// By External File
function spectra_quick_js_file() {
	
	global $spectra_opts;
		
	/* JS */
	if ( $spectra_opts->get_option( 'custom_js' ) && $spectra_opts->get_option( 'custom_js' ) != '' ) {
        wp_enqueue_script('quick-js', get_template_directory_uri() . '/inc/quick-js.php', false, false, true);
    }

}
add_action( 'wp_enqueue_scripts', 'spectra_quick_js_file' );