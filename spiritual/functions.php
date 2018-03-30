<?php
define('SWM_THEME_DIR', get_template_directory_uri());
define('SWM_ADMIN', get_template_directory() . '/framework/');
define('SWM_DIRECTORY', get_template_directory_uri());
define('THEME_CSS', SWM_DIRECTORY . '/css');
define('ADMIN_CSS', SWM_DIRECTORY . '/framework/css/');
define('SWM_WOO', get_template_directory() . '/woocommerce/');
define('SWM_TRIBE_EVENT', get_template_directory() . '/tribe-events/');
define('SWM_THEME_NAME', 'spiritual');

include_once (SWM_ADMIN . 'customizer/customizer.php');
require_once (SWM_ADMIN . 'output-css.php');
include_once (SWM_ADMIN . 'image-sizes.php');

/* ---> Theme's custom function file <------------------------ */
 
require_once (SWM_ADMIN . 'general-functions.php');

/* ----------------------------------------------------- */

include_once (SWM_ADMIN . 'breadcrumbs.php');
include_once (SWM_ADMIN . 'tgm-plugin-activation/custom-plugin-activation.php');
include_once (SWM_ADMIN . 'register-widgets.php');
include_once (SWM_ADMIN . 'admin-functions.php');
include_once (SWM_ADMIN . 'multiple-featured-images.php');
include_once (SWM_ADMIN . 'meta-box-options.php');

// call woocommerce 
if ( class_exists( 'Woocommerce' ) ) {
	include_once (SWM_WOO . 'swm-custom/swm-woocommerce.php');
}

//event calendar
if ( class_exists( 'Tribe__Events__Main' ) ) { 
	include_once (SWM_TRIBE_EVENT . 'swm-custom/swm-event-functions.php');
}

/* ************************************************************************************** 
	Register Javascripts and CSS Files - Frontend
************************************************************************************** */

if ( !function_exists('swm_load_scripts') ) {
	function swm_load_scripts () {
		if ( !is_admin() ) {			

			// Customizer - Google fonts
			$swm_body_sf = get_theme_mod( 'swm_body_sf','none' );
            $swm_top_nav_sf = get_theme_mod( 'swm_top_nav_sf','none' );        
            $swm_headings_sf = get_theme_mod( 'swm_headings_sf','none' );  
            $subsets = '';

            // Sub Sets
            if ( get_theme_mod( 'swm_google_font_subset' ) == 1 ) {
                $subsets = 'latin,latin-ext';
                $subsets .= (get_theme_mod( 'swm_google_font_subset_cyrillic' ) == 1) ? ',cyrillic,cyrillic-ext' : ''; 
                $subsets .= (get_theme_mod( 'swm_google_font_subset_greek' ) == 1) ? ',greek,greek-ext' : ''; 
                $subsets .= (get_theme_mod( 'swm_google_font_subset_vietnamese' ) == 1) ? ',vietnamese' : '';           
            }

            $google_fonts_add_list = array(
                'family' => swm_output_google_font_url('swm_body_font_family','swm_body_font_weight','%7C',$swm_body_sf) . swm_output_google_font_url('swm_top_nav_font_family','swm_top_nav_font_weight','%7C',$swm_top_nav_sf) . swm_output_google_font_url('swm_headings_font_family','swm_headings_font_weight','',$swm_headings_sf),
                'subset' => $subsets,
            );          

            $protocol = is_ssl() ? 'https' : 'http';
            $get_google_font_families = esc_url(add_query_arg( $google_fonts_add_list, $protocol . '://fonts.googleapis.com/css' ));             

            if ( $swm_body_sf == 'none' || $swm_top_nav_sf == 'none' || $swm_headings_sf == 'none' ) {                 
                wp_enqueue_style( 'swm-google-fonts',   $get_google_font_families,   NULL, NULL, 'all' );                              
            }          

			// Remove poli shortcodes similar plugins files
			wp_dequeue_script( 'swm-poli-plugins' );
			wp_dequeue_script( 'swm-poli-isotope' );	
			wp_dequeue_style( 'swm-poli-font-awesome' );			
			
			// Javascripts
			if ( class_exists( 'Woocommerce' ) ) {
				wp_enqueue_script('woo-custom', SWM_THEME_DIR . '/woocommerce/swm-custom/js/custom.js', 'jquery', '1.0', TRUE);				
			}

			wp_enqueue_script( 'swm-modernizer', SWM_THEME_DIR . '/js/modernizer.js', 'jquery' );	
			wp_enqueue_script( 'jquery' );		
			wp_enqueue_script( 'swm-prettyPhoto',  SWM_THEME_DIR.'/js/prettyPhoto/js/jquery.prettyPhoto.js', 'jquery', "3.1.6", true );
			wp_enqueue_script( 'swm-theme-plugins', SWM_THEME_DIR . '/js/plugins.js', 'jquery','1.0', TRUE );
			wp_enqueue_script( 'swm-sermons-media', SWM_THEME_DIR . '/js/mediaelement-and-player.min.js', 'jquery','1.0', TRUE );		
			wp_enqueue_script( 'swm-theme-settings', SWM_THEME_DIR . '/js/theme-settings.js', 'jquery','1.0', TRUE );
			wp_enqueue_script( 'swm-menus' );		
			wp_enqueue_script( 'swm-isotope', SWM_THEME_DIR . '/js/isotope.js', 'jquery', '1.0', TRUE );		

			// CSS			
			wp_enqueue_style( 'swm-font-icons', SWM_THEME_DIR . '/fonts/font-awesome.css', '', '1.0' );	
			wp_enqueue_style( 'swm-global', THEME_CSS . '/global.css', '', '1.0' );	
			wp_enqueue_style( 'swm-mediaplayer', THEME_CSS . '/player/media-player.css', '', '1.0' );			
			wp_enqueue_style( 'swm-main-css', SWM_THEME_DIR . '/style.css', '', '1.0');				
			wp_enqueue_style( 'swm-prettyphoto', SWM_THEME_DIR . '/js/prettyPhoto/css/prettyPhoto.css', '', '1.0' );			
			wp_enqueue_style( 'swm-layout', THEME_CSS . '/layout.css', '', '1.0' );
			
			if ( class_exists( 'Woocommerce' ) ) {
				wp_enqueue_style( 'swm-woocommerce', THEME_CSS . '/swm-woocommerce.css', '', '1.0' );				
			}

			wp_enqueue_style( 'swm-responsive', THEME_CSS . '/responsive.css', '', '1.0' );		
			wp_enqueue_style( 'swm-retina', THEME_CSS . '/retina.css', '', '1.0' );
			wp_enqueue_style( 'swm-custom', SWM_THEME_DIR . '/custom.css', '', '1.0' );

							
		}

	}
}

add_action('wp_enqueue_scripts', 'swm_load_scripts',999);

/* ************************************************************************************** 
	Multiple Featured Images
************************************************************************************** */

if( class_exists( 'kdMultipleFeaturedImages' ) ) {
	$i = 1;
	$swm_multiple_featured_img_number = get_theme_mod('swm_multiple_featured_imgs',5);

	while($i <= $swm_multiple_featured_img_number) {
        $args = array(
                'id' => 'featured-image-'.$i,
                'post_type' => 'post',
                'labels' => array(
                    'name'      => 'Gallery Image '.$i,
                    'set'       => 'Set gallery image '.$i,
                    'remove'    => 'Remove gallery image '.$i,
                    'use'       => 'Use as gallery image '.$i,
                )
        );

        new kdMultipleFeaturedImages( $args );
        $i++;
	}
}

/* ************************************************************************************** 
	Register Javascripts and CSS Files - Backend ( Admin )
************************************************************************************** */

if (!function_exists('swm_admin_scripts')) {
  function swm_admin_scripts() {   
    wp_enqueue_script('jquery-ui-slider');
    wp_enqueue_script('swm-admin-javascripts', get_template_directory_uri() . '/framework/js/admin-javascripts.js', array('jquery')); 
  	wp_enqueue_script('jquery-ui-sortable');    

    wp_enqueue_style('nav-menu');
    wp_enqueue_style( 'swm-style-wp-admin', ADMIN_CSS . 'style-wp-admin.css', '', '1.0' ); 

  }
}

add_action('admin_enqueue_scripts', 'swm_admin_scripts',1000);

/* ************************************************************************************** 
	Title Tag
************************************************************************************** */

function swm_theme_slug_setup() {
   add_theme_support( 'title-tag' );
}
add_action( 'after_setup_theme', 'swm_theme_slug_setup' );