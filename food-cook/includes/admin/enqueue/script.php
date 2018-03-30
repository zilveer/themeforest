<?php
// File Security Check
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && basename( __FILE__ ) == basename( $_SERVER['SCRIPT_FILENAME'] ) ) :
    die ( 'You do not have sufficient permissions to access this page' );
endif;


/* ================================================================================= */
/* Theme Frontend JS 																 */
/* ================================================================================= */
if ( ! is_admin() ) : add_action( 'wp_print_scripts', 'woothemes_add_javascript' ); endif;

if ( ! function_exists( 'woothemes_add_javascript' ) ) :
	function woothemes_add_javascript() {
		global $woo_options;

		wp_enqueue_script( 	'df-plugins', 			get_template_directory_uri() . '/includes/assets/js/plugins.js', array( 'jquery' ), '', true );
		wp_register_script( 'featured-slider', 		get_template_directory_uri() . '/includes/assets/js/featured-slider.js', array( 'jquery', 'jquery-flexslider' ),'', true );
		wp_enqueue_script( 	'jquery-ui-tabs' );

		wp_enqueue_script( 'custom_script', 		get_template_directory_uri() . '/includes/assets/js/script.min.js', array( 'jquery' ), '1.0', true);

		do_action( 'woothemes_add_javascript' );
	} // End woothemes_add_javascript()
endif;

/* ================================================================================= */
/* Theme Meta Toogle Options JavaScript												 */
/* ================================================================================= */
add_action( 'admin_enqueue_scripts', 'woothemes_add_admin_javascript' );

if ( ! function_exists( 'woothemes_add_admin_javascript' ) ) :
	function woothemes_add_admin_javascript() {
		global $pagenow;
        
        if ( in_array( $pagenow, array( 'post.php', 'post-new.php', 'page-new.php', 'page.php' ) ) ) :
			wp_enqueue_script( 'woo-postmeta-options-custom-toggle', get_template_directory_uri() . '/includes/assets/js/admin/meta-options-custom-toggle.js', array( 'jquery' ), '1.0.0', true );
		endif;

	} // End woothemes_add_admin_javascript()
endif;

/* ================================================================================= */
/* Theme Customizer Admin Import/Export JavaScript									 */
/* ================================================================================= */
add_action( 'admin_enqueue_scripts', 'df_impexp_customizer_admin_scripts' );

if ( ! function_exists( 'df_impexp_customizer_admin_scripts' ) ) :
    function df_impexp_customizer_admin_scripts() {
        wp_register_script( 'df-customizer-admin-impexp', get_template_directory_uri() . '/includes/assets/js/admin/theme-customizer-admin.js', array( 'jquery' ), '28042014', true );
        wp_enqueue_script( 'df-customizer-admin-impexp' );
    }
endif;

/* ================================================================================= */
/* Theme Customizer JavaScript									 					 */
/* ================================================================================= */
add_action( 'customize_controls_print_footer_scripts', 'df_enqueue_customizer_admin_scripts' );

if ( ! function_exists( 'df_enqueue_customizer_admin_scripts' ) ) :
	function df_enqueue_customizer_admin_scripts() {
		wp_register_script( 'df-customizer-admin', get_template_directory_uri() . '/includes/assets/js/admin/theme-customizer.js', array( 'jquery' ), '26042014', true );
		wp_enqueue_script( 'df-customizer-admin' );
	}
endif;

/* ================================================================================= */
/* Theme Customizer Stylesheet									 					 */
/* ================================================================================= */
add_action( 'customize_controls_print_styles', 'df_enqueue_customizer_admin_style' );

if ( ! function_exists( 'df_enqueue_customizer_admin_style' ) ) :
	function df_enqueue_customizer_admin_style() {
		wp_register_style( 'df-customizer-admin', get_template_directory_uri() . '/includes/assets/css/admin/theme-customizer.css' );
		wp_enqueue_style( 'df-customizer-admin' );
	}
endif;

/* ================================================================================= */
/* Register Modernizr & HTML5 in IE								 					 */
/* ================================================================================= */
add_action( 'wp_head', 'html5_shiv_modernizr' );

function html5_shiv_modernizr() {
	echo '<!--[if lte IE 8]>';
	echo '<script src="' . esc_url( 'https://html5shiv.googlecode.com/svn/trunk/html5.js' ) . '"></script>';
	echo '<![endif]-->';
	echo '<script src="' . esc_url( get_template_directory_uri().'/includes/assets/js/libs/modernizr-2.6.1.min.js' ) . '"></script>';
}

add_action( 'woothemes_add_javascript' , 'woo_load_featured_slider_js' );

function woo_load_featured_slider_js() {
	if ( is_home() || is_front_page() || is_page_template( 'template-home.php' ) ) :

		//Slider settings
		$settings = array(
			'featured_speed' 			=> '7',
			'featured_hover' 			=> 'true',
			'featured_action' 			=> 'true',
			'featured_touchswipe' 		=> 'true',
			'featured_animation_speed' 	=> '0.6',
			'featured_pagination' 		=> 'false',
			'featured_nextprev' 		=> 'true',
			'featured_animation' 		=> 'fade'
		);

		$settings = woo_get_dynamic_values( $settings );

		if ( $settings['featured_speed'] == '0' ) { $slideshow = 'false'; } else { $slideshow = 'true'; }
		if ( $settings['featured_touchswipe'] ) { $touchSwipe = 'true'; } else { $touchSwipe = 'false'; }
		if ( $settings['featured_hover'] ) { $pauseOnHover = 'true'; } else { $pauseOnHover = 'false'; }
		if ( $settings['featured_action'] ) { $pauseOnAction = 'true'; } else { $pauseOnAction = 'false'; }
		if ( ! in_array( $settings['featured_animation'], array( 'fade', 'slide' ) ) ) { $settings['featured_animation'] = 'fade'; }

		$slideshowSpeed 	= (int) $settings['featured_speed'] * 1000; // milliseconds
		$animationDuration 	= (int) $settings['featured_animation_speed'] * 1000; // milliseconds
		$nextprev 			= $settings['featured_nextprev'];
		$manualControls 	= '';

		if ( $settings['featured_pagination'] == 'true' ) {
			$pagination = 'true';
		} else {
			$pagination = 'false';
		}

		$data = array(
			'animation' 		=> $settings['featured_animation'],
			'controlsContainer' => '.controls-container',
			'smoothHeight' 		=> 'true',
			'directionNav' 		=> $nextprev,
			'controlNav' 		=> $pagination,
			'manualControls' 	=> $manualControls,
			'slideshow' 		=> $slideshow,
			'pauseOnHover' 		=> $pauseOnHover,
			'slideshowSpeed' 	=> $slideshowSpeed,
			'animationDuration' => $animationDuration,
			'touch' 			=> $touchSwipe,
			'pauseOnHover' 		=> $pauseOnHover,
			'pauseOnAction' 	=> $pauseOnAction
		);

		wp_localize_script( 'featured-slider', 'woo_localized_data', $data);

		wp_enqueue_script( 'featured-slider' );
	endif; // End woo_load_featured_slider_js()
}

// add_action( 'wp_footer' , 'woo_load_responsive_tabs_js', 30 );

function woo_load_responsive_tabs_js(){
	if( is_woocommerce_activated() && is_product() ) {
		echo "
		<script>	
			jQuery(document).ready(function(){	
			jQuery('.woocommerceTabs').easyResponsiveTabs({
			       	 	type: 'default', 
			       	 	width: 'auto', 
			       		fit: true     
			         });
			});
		</script>";
	} 

}