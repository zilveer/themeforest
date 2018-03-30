<?php

// 3rd Lib Style
wp_enqueue_style( 'carousel', THEME_URI . '/css/carousel.css', true, THEME_VERSION );
wp_enqueue_style( 'font-awesome', THEME_URI . '/css/font-awesome.min.css', true, THEME_VERSION );
wp_enqueue_style( 'fancybox', THEME_URI . '/js/fancybox/jquery.fancybox-1.3.4.css', true, THEME_VERSION );

// Theme Style
wp_enqueue_style( 'layout', THEME_URI . '/css/layout.css', true, THEME_VERSION );
wp_enqueue_style( 'screen', THEME_URI . '/css/screen.css', true, THEME_VERSION );

// RTL
if( theme_options('appearance', 'text_rtl') == 'on' )
	wp_enqueue_style( 'rtl', THEME_URI . '/css/rtl.css', true, THEME_VERSION );

// Responsive
if( theme_options('appearance', 'enable_responsive') != 'off' )
	wp_enqueue_style( 'responsive', THEME_URI . '/css/media-queries.css', true, THEME_VERSION );

// Customize Box
if( theme_options('advance', 'show_customize') == 'on' )
	wp_enqueue_style( 'customize-panel', THEME_URI . '/css/customize-panel.css', true, THEME_VERSION );

// Standard style.css for child-theme
wp_enqueue_style( 'theme-style', get_stylesheet_uri(), false, THEME_VERSION );

// Exclude CSS from Better WordPress Minify
add_filter('bwp_minify_style_ignore', 'exclude_my_css');
function exclude_my_css($excluded)
{
    $excluded = array('font-awesome');
    return $excluded;
}

?>