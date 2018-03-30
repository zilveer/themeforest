<?php
if ( !defined('ABSPATH') ){
 exit; 
}

/*-----------------------------------------------------------------------------------*/
/* Load style.css in the <head> */
/*-----------------------------------------------------------------------------------*/

if ( ! is_admin() ) { add_action( 'wp_enqueue_scripts', 'woo_load_frontend_css', 20 ); }

if ( ! function_exists( 'woo_load_frontend_css' ) ) {
	function woo_load_frontend_css () {
		wp_register_style( 'theme-stylesheet', get_stylesheet_uri(), array(), '1.0.7', 'all' );
		wp_enqueue_style( 'theme-stylesheet' );
		wp_register_style( 'df-style', get_template_directory_uri() . '/includes/assets/css/layout.css' );
		wp_enqueue_style( 'df-style' );
	} // End woo_load_frontend_css()
}

/*-----------------------------------------------------------------------------------*/
/* Load site width CSS in the header */
/*-----------------------------------------------------------------------------------*/

//add_action( 'wp_head', 'woo_load_site_width_css', 10 );

if ( ! function_exists( 'woo_load_site_width_css' ) ) {
function woo_load_site_width_css () {
	$settings = woo_get_dynamic_values( array( 'layout_width' => 940 ) );
    $layout_width = intval( $settings['layout_width'] );
    if ( 0 < $layout_width ) { /* Has legitimate width */ } else { $layout_width = 940; } // Default Width
?>

<!-- Adjust the website width -->
<style type="text/css">
	 .col-full { max-width: <?php echo intval( $layout_width ); ?>px !important; }
</style>
<?php
}  
}

function fnc_custom_css(){
	$output = '';
	$custom_css = get_option( 'woo_custom_css' );
	if ( $custom_css != '' ) {
			$output .= $custom_css;
	}

	// Output styles
	if ( $output != '' ) {
		$output = strip_tags( $output );
		$output = '<style type="text/css">' . $output . '</style>';
		echo stripslashes( $output );
	}
}
add_action( 'wp_head', 'fnc_custom_css', 10 );