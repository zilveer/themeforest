<?php
/**
 * Returns and loads the Google font stylesheet URL, if available.
 *
 * To disable in a child theme, use wp_dequeue_style()
 * function mytheme_dequeue_fonts() {
 *     wp_dequeue_style( 'flow-google-fonts' );
 * }
 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
 *
 * @return void
 */
function flow_google_fonts() {
	$fonts_url = '';
	$font_families = array();
	$font_families[] = 'Dosis:400,700';
	$font_families[] = 'Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800';
	$font_families[] = 'Lato:300,400';
	//$protocol = is_ssl() ? 'https' : 'http';
	$query_args = array(
		'family' => implode( '|', $font_families ),
		'subset' => 'latin,latin-ext',
	);
	//$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

	wp_enqueue_style( 'flow-google-fonts', esc_url_raw( $fonts_url ), array(), null );	
}
add_action( 'wp_enqueue_scripts', 'flow_google_fonts' );
