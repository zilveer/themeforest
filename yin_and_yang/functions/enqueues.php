<?php

/*-----------------------------------------------------------------------------------*/
/*	Register and Enqueue Theme Styles
/*-----------------------------------------------------------------------------------*/

function onioneye_add_main_styles() {
	
	wp_enqueue_style( 'onioneye-normalize', get_template_directory_uri() . '/css/normalize.css' );
	wp_enqueue_style( 'onioneye-flexslider', get_template_directory_uri() . '/css/flexslider.css' );
    wp_enqueue_style( 'onioneye-style', get_stylesheet_uri() );  
    
}

function onioneye_add_fonts() {

    $protocol = is_ssl() ? 'https' : 'http';
        
    // Load the heading font
    if(!get_theme_mod('onioneye_extended_chars_enabled', false)) {
		wp_enqueue_style( 'onioneye-open-sans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300,400&subset=latin,latin-ext" );   
	}
	else {
		wp_enqueue_style( 'onioneye-open-sans', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300,400&subset=cyrillic,cyrillic-ext,latin,greek-ext,greek,latin-ext,vietnamese" );
	}
        
} 

add_action( 'wp_enqueue_scripts', 'onioneye_add_main_styles', 1 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_fonts', 4 );


/*-----------------------------------------------------------------------------------*/
/*	Register and Enqueue Admin Styles
/*-----------------------------------------------------------------------------------*/

function onioneye_add_custom_admin_style($hook) {
    
    if ('themes.php' != $hook) {
        return;
    }
    wp_enqueue_style( 'onioneye-custom-admin-style', get_template_directory_uri() . '/css/admin-style.css' );
    
}

add_action( 'admin_enqueue_scripts', 'onioneye_add_custom_admin_style' );


/*-----------------------------------------------------------------------------------*/
/*	Register and Enqueue Theme Scripts
/*-----------------------------------------------------------------------------------*/

function onioneye_add_modernizr() {
	
    wp_register_script( 'onioneye-modernizr', get_template_directory_uri() . '/js/modernizr.custom-2.7.1.min.js', false, '2.7.1' );
    wp_enqueue_script( 'onioneye-modernizr' );

}  


function onioneye_add_jquery() {
	
    wp_enqueue_script( 'jquery' );
	
}  


function onioneye_add_imagesloaded() {
	
	wp_enqueue_script( 'onioneye-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.min.js', array ( 'jquery' ), '3.1.8' );

}


function onioneye_add_flexslider() {
		
	wp_enqueue_script( 'onioneye-flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array ( 'jquery' ) );

}


function onioneye_add_isotope() {
	
	wp_enqueue_script( 'onioneye-isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array ( 'jquery' ) );

}


function onioneye_add_superfish() {
	
	wp_register_script( 'onioneye-superfish', get_template_directory_uri() . '/js/superfish.min.js', array( 'jquery' ), '1.7.4', true );
    wp_enqueue_script( 'onioneye-superfish' );
	
}


function onioneye_add_hoverintent() {
	
    wp_register_script( 'onioneye-hoverintent', get_template_directory_uri() . '/js/jquery.hoverIntent.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'onioneye-hoverintent' );
	
} 


function onioneye_add_webfontloader() {
	
    wp_enqueue_script( 'onioneye-webfontloader', get_template_directory_uri() . '/js/webfontloader.js', array( 'jquery' ), '1.5.19' );
	
} 


function onioneye_add_jquery_lavalamp() {
	
    wp_register_script( 'onioneye-lavalamp', get_template_directory_uri() . '/js/jquery.lavalamp.min.js', array( 'jquery' ), '1.4.0', true );
    wp_enqueue_script( 'onioneye-lavalamp' );
	
} 


function onioneye_add_jquery_easing() {
	
    wp_register_script( 'onioneye-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'onioneye-easing' );
	
} 


function onioneye_add_fit_vids() {
	
    wp_register_script( 'onioneye-fit_vids', get_template_directory_uri() . '/js/jquery.fitvids.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'onioneye-fit_vids' );
	
} 


function onioneye_add_transit() {
	
    wp_register_script( 'onioneye-transit', get_template_directory_uri() . '/js/jquery.transit.min.js', array( 'jquery' ), '0.9.9', true );
    wp_enqueue_script( 'onioneye-transit' );
	
} 


function onioneye_add_bg_check() {
	
    wp_register_script( 'onioneye-bg-check', get_template_directory_uri() . '/js/background-check.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'onioneye-bg-check' );
	
}


function onioneye_add_comment_reply() {
	// Adds JavaScript to pages with the comment form to support sites with threaded comments (when in use).
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
}


function onioneye_add_viewport_units_buggyfill() {

	wp_register_script( 'onioneye-viewport-units-buggyfill', get_template_directory_uri() . '/js/viewport-units-buggyfill.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'onioneye-viewport-units-buggyfill' );	
	
} 


function onioneye_add_custom_header_jquery() {
	
	wp_enqueue_script( 'onioneye-custom-header-js', get_template_directory_uri() . '/js/jquery.header.custom.js', array( 'jquery' ) );
	wp_localize_script( 'onioneye-custom-header-js', 'headJS', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'templateurl' => get_template_directory_uri(), 'themePath' => get_template_directory_uri(), 'prevPost' => __( 'Go to the previous post', 'onioneye' ), 'nextPost' => __( 'Go to the next post', 'onioneye' ) ) );	
		
} 


function onioneye_add_custom_footer_jquery() {

	wp_register_script( 'onioneye-custom-footer-js', get_template_directory_uri() . '/js/jquery.footer.custom.js', array( 'jquery' ), false, true );
	wp_enqueue_script( 'onioneye-custom-footer-js' );	
	
} 


/* wp enqueue script */
add_action( 'wp_enqueue_scripts', 'onioneye_add_modernizr', 5 ); 
add_action( 'wp_enqueue_scripts', 'onioneye_add_transit', 10 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_jquery', 15 ); 
add_action( 'wp_enqueue_scripts', 'onioneye_add_webfontloader', 20 ); 
add_action( 'wp_enqueue_scripts', 'onioneye_add_imagesloaded', 23 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_custom_header_jquery', 24 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_flexslider', 25 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_isotope', 28 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_jquery_easing', 30 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_jquery_lavalamp', 35 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_superfish', 40 ); 
add_action( 'wp_enqueue_scripts', 'onioneye_add_hoverintent', 50 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_fit_vids', 70 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_bg_check', 75 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_viewport_units_buggyfill', 80 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_custom_footer_jquery', 90 );
add_action( 'wp_enqueue_scripts', 'onioneye_add_comment_reply' );

?>