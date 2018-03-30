<?php

/**
 * Ebor Framework
 * Styles & Scripts Enqueuement
 * @since version 1.0
 * @author TommusRhodus
 */

/**
 * Ebor Load Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * @since version 1.0
 * @author TommusRhodus
 */ 
function ebor_load_scripts() {
	$protocol = is_ssl() ? 'https' : 'http';
	      
	//Enqueue Styles
	wp_enqueue_style( 'ebor-raleway-font', "$protocol://fonts.googleapis.com/css?family=Raleway:300,400,700" );
	wp_enqueue_style( 'ebor-lato-font', "$protocol://fonts.googleapis.com/css?family=Lato:400,700" );
	wp_enqueue_style( 'ebor-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
	wp_enqueue_style( 'ebor-style', get_stylesheet_uri() );
	wp_enqueue_style( 'ebor-animate', get_template_directory_uri() . '/css/animate.css' );
	wp_enqueue_style( 'ebor-owl', get_template_directory_uri() . '/css/owl.carousel.css' );
	wp_enqueue_style( 'ebor-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
	wp_enqueue_style( 'ebor-cube', get_template_directory_uri() . '/css/cubeportfolio.min.css' );
	wp_enqueue_style( 'ebor-flickerplate', get_template_directory_uri() . '/css/flickerplate.css' );
	wp_enqueue_style( 'ebor-slideshow', get_template_directory_uri() . '/css/slideshow.css' );
	wp_enqueue_style( 'ebor-custom', get_template_directory_uri() . '/custom.css' );
	
	//Dequeue Styles
	wp_dequeue_style('aqpb-view-css');
	wp_deregister_style('aqpb-view-css');
	
	//Enqueue Scripts
	if( get_option('use_preloader', 1) == 1 )
		wp_enqueue_script( 'ebor-royal', get_template_directory_uri() . '/js/royal_preloader.min.js', array('jquery'), false, true  );
		
	$sslPrefix = ( is_ssl() ) ? 'https://maps-api-ssl.google.com' : 'http://maps.googleapis.com';
 	$key = ( get_option('ebor_gmap_api') ) ? '?key=' . get_option('ebor_gmap_api') : false;
	wp_enqueue_script('googlemapsapi', $sslPrefix . '/maps/api/js' . $key, array( 'jquery' ), false, true);
	
	wp_enqueue_script( 'jquery-effects-core' );
	wp_enqueue_script( 'ebor-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), false, true  );
	wp_enqueue_script( 'ebor-modernizr', get_template_directory_uri() . '/js/custom.modernizr.js', array('jquery'), false, false  );
	
	wp_enqueue_script( 'ebor-appear', get_template_directory_uri() . '/js/jquery.appear.js', array('jquery'), false, true  );
	wp_enqueue_script( 'ebor-cubeportfolio', get_template_directory_uri() . '/js/jquery.cubeportfolio.min.js', array('jquery'), false, true  );
	wp_enqueue_script( 'ebor-retina', get_template_directory_uri() . '/js/retina.js', array('jquery'), false, true  );
	wp_enqueue_script( 'ebor-smooth-scroll', get_template_directory_uri() . '/js/smooth-scroll.js', array('jquery'), false, true  );
	wp_enqueue_script( 'ebor-socialstream', get_template_directory_uri() . '/js/socialstream.jquery.js', array('jquery'), false, true  );
	wp_enqueue_script( 'ebor-plugins', get_template_directory_uri() . '/js/plugins.js', array('jquery'), false, true  );
	wp_enqueue_script( 'ebor-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), false, true  );
	wp_enqueue_script( 'ebor-main', get_template_directory_uri() . '/js/main.js', array('jquery'), false, true  );
	
	//Enqueue Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
	/**
	 * Dequeue Scripts
	 */
	wp_dequeue_script('aqpb-view-js');
	wp_deregister_script('aqpb-view-js');
	
	/**
	 * localize script
	 */
	$script_data = array( 
		'disable_ajax' => get_option('disable_ajax', 0),
	);
	wp_localize_script( 'ebor-scripts', 'wp_data', $script_data );
}
add_action('wp_enqueue_scripts', 'ebor_load_scripts');

/**
 * Ebor Load Non Standard Scripts
 * Quickly insert HTML into wp_head()
 * @since version 1.0
 * @author TommusRhodus
 */
function ebor_load_non_standard_scripts() {
	echo '<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		  <!--[if lt IE 9]>
		  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
		  	<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		  <![endif]-->';
}
add_action('wp_head', 'ebor_load_non_standard_scripts', 95);

/**
 * Ebor Load Admin Scripts
 * Properly Enqueues Scripts & Styles for the theme
 * @since version 1.0
 * @author TommusRhodus
 */
function ebor_admin_load_scripts(){
	wp_enqueue_script('ebor-admin-js', get_template_directory_uri().'/ebor_framework/admin.js', array('jquery'));
	wp_enqueue_style( 'ebor-admin-css', get_template_directory_uri() . '/ebor_framework/css/admin.css' );
	wp_enqueue_style( 'ebor-awesome', get_template_directory_uri() . '/css/font-awesome.min.css' );
}
add_action('admin_enqueue_scripts', 'ebor_admin_load_scripts', 200);