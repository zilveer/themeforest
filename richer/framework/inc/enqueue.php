<?php

function richer_scripts_basic() {  
	global $options_data;
	/* ------------------------------------------------------------------------ */
	/* Register Scripts */
	/* ------------------------------------------------------------------------ */
	wp_register_script('superfish', get_template_directory_uri() . '/framework/js/superfish.js', 'jquery', '1.4', TRUE);
	wp_register_script('prettyPhoto', get_template_directory_uri() . '/framework/js/prettyPhoto.js', 'jquery', '3.1', TRUE);
	wp_register_script('flexslider-js', get_template_directory_uri() . '/framework/js/jquery.flexslider-min.js', 'jquery', '2.2.0', TRUE);
	wp_register_script('plugins-js', get_template_directory_uri() . '/framework/js/plugins.js', 'jquery', '1.0', true);
	wp_register_script('isotope-js', get_template_directory_uri() . '/framework/js/isotope.js', 'jquery', '1.5', TRUE);
	wp_register_script('functions', get_template_directory_uri() . '/framework/js/functions.js', 'jquery', '1.0', TRUE);
	wp_register_script('shortcodes', get_template_directory_uri() . '/framework/js/shortcodes.js', 'jquery', '1.0', TRUE);	

	wp_register_script( 'jquery.map', get_template_directory_uri() . '/framework/js/gmap.js', array(), '', true);
	wp_register_script('gmaps.api', 'https://maps.google.com/maps/api/js?v=3.exp&amp;key=AIzaSyB6eNiHeZzBF7xL_lprgdJNABXsZZoUvmA&amp;language='.substr(get_locale(), 0, 2), array(), false, true);

	wp_register_script('owl-carousel', get_template_directory_uri() . '/framework/js/owl-carousel-js/owl.carousel.min.js', 'jquery', '1.3.3', TRUE);
	
	/* ------------------------------------------------------------------------ */
	/* Enqueue Scripts */
	/* ------------------------------------------------------------------------ */
	//wp_enqueue_script('jquery');

	
	wp_enqueue_script('plugins-js');
  	wp_enqueue_script('superfish');
  	wp_enqueue_script('flexslider-js');
  	if(is_page_template('page-portfolio-col1.php') || is_page_template('page-portfolio-col2.php') || is_page_template('page-portfolio-col3.php') || is_page_template('page-portfolio-col4.php') || is_page_template('page-portfolio-col3-excerpts.php')) {
  		wp_enqueue_script('isotope-js');
  	}
  	wp_enqueue_script('shortcodes');
  	wp_enqueue_script('functions');
}
add_action( 'wp_enqueue_scripts', 'richer_scripts_basic' );  

function richer_styles_basic()  
{  
	
	/* ------------------------------------------------------------------------ */
	/* Register Stylesheets */
	/* ------------------------------------------------------------------------ */
	wp_register_style( 'skeleton', get_template_directory_uri() . '/framework/css/grid.css', array(), '1', 'all' );
	wp_register_style( 'responsive', get_template_directory_uri() . '/framework/css/responsive.css', array('stylesheet'), '1', 'all' );
	wp_register_style( 'FontAwesome', get_template_directory_uri() . '/framework/css/font-icons/awesome-font/css/font-awesome.min.css', array(), '4.1', 'all' );
	wp_register_style( 'SosaIcons', get_template_directory_uri() . '/framework/css/font-icons/sosa-font/style.min.css', array('stylesheet'), '1.0', 'all' );

	wp_register_style( 'owl-carousel', get_template_directory_uri() . '/framework/css/owl-carousel-css/owl.carousel.css', array(), '1.3.3', 'all' );
	/* ------------------------------------------------------------------------ */
	/* Enqueue Stylesheets */
	/* ------------------------------------------------------------------------ */
	$upload_dir = wp_upload_dir();
	if (file_exists($upload_dir['basedir']. "/caches/style_dynamic.css") && asw_css_folder_writable()) {
		wp_register_style("style_dynamic", set_url_scheme($upload_dir['baseurl'])."/caches/style_dynamic.css", array(), '1.0', 'all');
	} else {
		wp_register_style("style_dynamic", get_template_directory_uri() . "/framework/inc/customcss.php", array(), '1.0', 'all');
	}

	if(class_exists('RevSlider')) {
		wp_register_style( 'stylesheet', get_template_directory_uri(). '/style.css', array('rs-plugin-settings'), '1.0', 'all' ); // Main Stylesheet after RevolutionSlider
	} else {
		wp_register_style( 'stylesheet', get_template_directory_uri(). '/style.css', array(), '1.0', 'all' ); // Main Stylesheet
	}
	
	
	wp_enqueue_style( 'FontAwesome' );
	wp_enqueue_style( 'SosaIcons' );
	wp_enqueue_style( 'skeleton' );
	global $options_data;
	wp_enqueue_style( 'stylesheet' );
	if($options_data['check_responsive'] == true) {
		wp_enqueue_style( 'responsive'); 
	}
	wp_enqueue_style( 'style_dynamic' );
	
}  
add_action( 'wp_enqueue_scripts', 'richer_styles_basic', 1 ); 

/* ------------------------------------------------------------------------ */
/* EOF
/* ------------------------------------------------------------------------ */

?>