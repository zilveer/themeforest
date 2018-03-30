<?php
/**
 * Google Fonts
 *
 * @package Magzilla
 * @since 	Magzilla 1.0
**/

$ft_customfont = '';

if(!empty($ft_option['google_body'])){

	$google_fonts = array( $ft_option['google_body'], $ft_option['google_font_titles'], $ft_option['google_main_nav'], $ft_option['google_secondary_nav'], $ft_option['google_font_module_title'], $ft_option['google_font_widget_title'], $ft_option['google_font_breadcrumb'], $ft_option['google_font_single_title'], $ft_option['google_font_post_meta'], $ft_option['google_font_single_meta'], $ft_option['google_font_single_sections'], $ft_option['google_font_headings'], $ft_option['google_font_logo'], $ft_option['google_font_section_title'] );

	foreach( $google_fonts as $google_font ) {
		if( !is_array( $google_font ) ) {

			$ft_customfont = str_replace( ' ', '+', $google_font ) . ':300italic,400italic,500italic,600italic,700italic,800italic,300,400,500,600,700,800|' . $ft_customfont;
		}
	}
}

if ( $ft_customfont != "" ) {
	function google_font() {
		global $ft_customfont;
		$protocol = is_ssl() ? 'https' : 'http';
		wp_enqueue_style( 'google-fonts', "$protocol://fonts.googleapis.com/css?subset=latin,latin-ext&family=". substr_replace( $ft_customfont,"",-1 ) . " rel='stylesheet' type='text/css" );
	}
	add_action( 'wp_enqueue_scripts', 'google_font', 15 );
}
?>