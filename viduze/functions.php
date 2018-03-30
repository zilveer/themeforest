<?php 
	
	/*	
	*	CrunchPress function.php
	*	---------------------------------------------------------------------
	* 	@version	1.0
	*   @ Package   Viduze Theme
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains all important functions and features of the theme.
	*	---------------------------------------------------------------------
	*/
	
	// constants
	
	define('THEME_NAME_S','cp');                                   // Short name of theme (used for various purpose in CP framework)
	define('THEME_NAME_F','Framework');                            // Full name of theme (used for various purpose in CP framework)
	
	define('CP_THEME_PATH_URL', get_template_directory_uri());           
	define('CP_THEME_PATH_SER', get_template_directory() );
	
	define('AJAX_URL', admin_url( 'admin-ajax.php' ));             // Define admin url
	define('FONT_SAMPLE_TEXT', 'Font Family'); 				       // Demo font text of the CrunchPress panel
   
	define('TH_FW_BE_URL', CP_THEME_PATH_URL. '/framework');             // Define URL path of framework directory
	define('TH_FW_BE_SER', CP_THEME_PATH_SER. '/framework');             // Define server path of framework directory
	 
	define( 'FW_FE_JS', CP_THEME_PATH_URL . '/javascript' );             // Define fron-end javascript directory
	define( 'FW_FE_CSS', CP_THEME_PATH_URL . '/stylesheet' );  			 // Define fron-end stylesheet directory
	
	add_theme_support( 'woocommerce' );
		   
	$my_theme = wp_get_theme();
	define('FW_BE_SER_VER', $my_theme->get( 'Version' ));
	
	$date_format = get_option(THEME_NAME_S.'_default_date_format','F d, Y');                     // Get default date format
	$widget_date_format = get_option(THEME_NAME_S.'_default_widget_date_format','M d, Y');       // Get default date format for widgets
	define('GDL_DATE_FORMAT', $date_format);
	define('GDL_WIDGET_DATE_FORMAT', $widget_date_format);
 
	$cp_is_responsive = 'enable';
	$cp_is_responsive = ($cp_is_responsive == 'enable')? true: false;
	
	$default_post_sidebar = get_option(THEME_NAME_S.'_default_post_sidebar','post-no-sidebar');   // Get default post sidebar
	$default_post_sidebar = str_replace('post-', '', $default_post_sidebar);               
	$default_post_left_sidebar = get_option(THEME_NAME_S.'_default_post_left_sidebar','');        // Get option for left sidebar
	$default_post_right_sidebar = get_option(THEME_NAME_S.'_default_post_right_sidebar','');      // Get option for right sidebar
	
	if( !function_exists('get_root_directory') ){                                                 // Get file path ( to support child theme )
		function get_root_directory( $path ){
			if( file_exists( get_stylesheet_directory() . '/' . $path ) ){
				return get_stylesheet_directory() . '/';
			}else{
				return get_stylesheet_directory() . '/';
			}
		}
	}
		$my_theme = wp_get_theme();
	define('THEME_NAME', $my_theme->get( 'Name' ));
	
	
	if ( is_singular() ) wp_enqueue_script( "comment-reply" );
		
	// enable navigation menu
	if(function_exists('add_theme_support')){
		add_theme_support('menus');
		register_nav_menus(array('main_menu' => 'Main Menu','footer_menu' => 'Footer Menu'));
	}
	  
	// include essential files to enhance framework functionality
	include_once(TH_FW_BE_SER.'/script-handler.php');										  // It includes all javacript and style in theme
	include_once(TH_FW_BE_SER.'/extensions/super-object.php'); 				    			  // Super object function
	include_once(TH_FW_BE_SER.'/cp-functions.php'); 						 				  // Registered CP framework functions
	include_once(TH_FW_BE_SER.'/cp-option.php');											  // CP framework control panel
	include_once(TH_FW_BE_SER.'/extensions/fontloader.php');								  // Load necessary font
	include_once(TH_FW_BE_SER.'/extensions/shortcodes/shortcodes.php'); 					  // Register shortcode
	include_once(TH_FW_BE_SER.'/extensions/cutom_meta_boxes.php'); 			     			  // Register meta boxes 
 	include_once(TH_FW_BE_SER.'/extensions/breadcrumbs.php');                  				  // Register breadcrumbs navigation
	include_once(TH_FW_BE_SER.'/extensions/post-likes.php');                  				  // Register breadcrumbs navigation
	include_once(TH_FW_BE_SER.'/extensions/jplayer.php');
	$seo = get_option ( THEME_NAME_S . '_seo', 'enable' ); 
    if ($seo== "enable") { include_once(TH_FW_BE_SER.	'/extensions/seo_module.php'); } 	  // Register seo module
 	include_once(TH_FW_BE_SER.	'/extensions/breadcrumbs.php');                				  // Register breadcrumbs navigation
	
	include_once(CP_THEME_PATH_SER. '/includes/front-end/page-elements.php');	                        // Organize page item element
	include_once(CP_THEME_PATH_SER. '/includes/front-end/product-elements.php');                        // Organize Product elements
	include_once(CP_THEME_PATH_SER. '/includes/front-end/video-elements.php');                          // Organize Video elements
	include_once(CP_THEME_PATH_SER. '/includes/front-end/portfolio-elements.php');                      // Organize Portfolio elements
	include_once(CP_THEME_PATH_SER. '/includes/front-end/blog-elements.php');                           // Organize Blog elements
	include_once(CP_THEME_PATH_SER. '/includes/front-end/twitter-feed.php');     
	
	
	// exterior plugins
	
	include_once(TH_FW_BE_SER. '/extensions/filosofo-image/filosofo-custom-image-sizes.php');  // Custom image re-size plugin
 
	if(!is_admin()){
		
		include_once(TH_FW_BE_SER. '/extensions/sliders.php');	                            // Functions to print sliders
	    include_once(TH_FW_BE_SER. '/extensions/comment.php'); 						     	// function to get list of comment
		include_once(TH_FW_BE_SER. '/extensions/pagination.php'); 					 		// Register pagination plugin
		include_once(TH_FW_BE_SER. '/extensions/social-shares.php'); 						// Register social shares 
		include_once(TH_FW_BE_SER. '/extensions/theme-login.php'); 
		
		
		include_once( 'woocommerce/config.php' );
		
	}
	
		include_once(TH_FW_BE_SER. '/options/meta-template.php'); 								// templates for post portfolio and gallery
		include_once(TH_FW_BE_SER. '/options/post-option.php');							        // Register meta fields for post_type
		include_once(TH_FW_BE_SER. '/options/page-option.php'); 								// Register meta fields page post_type
	
	
	// include custom widget
	
		foreach ( glob( CP_THEME_PATH_SER . '/includes/widgets/*.php') as $filename ):
		include $filename;
		endforeach;
       
	   
	   $item_fetch =  get_option(THEME_NAME_S.'_products_item_fetch','12'); 
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return '.$item_fetch.';' ), 20 );

 	  function social_media_header () {
		  
				$cp_icon_type = 'light';
				$cp_social_icon = array(
					/*'dribbble'=> array('name'=>THEME_NAME_S.'_dribbble', 'id'=> 'social_dribbble'),*/
					'facebook' => array('name'=>THEME_NAME_S.'_facebook', 'id'=> 'social_facebook'),
					'linkedin' => array('name'=>THEME_NAME_S.'_linkedin', 'id'=> 'social_linkedin'),
					'tumblr'=> array('name'=>THEME_NAME_S.'_tumblr', 'id'=> 'social_trumblr'),
					'twitter' => array('name'=>THEME_NAME_S.'_twitter', 'id'=> 'social_twitter'),
					'vimeo' => array('name'=>THEME_NAME_S.'_vimeo', 'id'=> 'social_vimeo'),
					'youtube' => array('name'=>THEME_NAME_S.'_youtube', 'id'=> 'social_youtube'),
					/*'google_plus' => array('name'=>THEME_NAME_S.'_google_plus', 'id'=> 'social_google_plus'),*/
					/*'pinterest' => array('name'=>THEME_NAME_S.'_pinterest', 'id'=> 'social_pinterest')*/
					);
				
				foreach( $cp_social_icon as $social_name => $social_icon ){
				
					$social_link = get_option($social_icon['name']);
					if( !empty($social_link) ){
					 	echo '<a class="social_active '. $social_icon['id'].'" target="_blank" href="' . $social_link . '"><span style="display: inline;" class="da-animate da-slideFromLeft"></span>' ;
						echo '</a>';
					  global $social_name;
					}	
				}
				
	}    
   
    if ( ! isset( $content_width ) ) $content_width = 1170;
	wp_link_pages();
	
	
	add_theme_support('automatic-feed-links');
	
	add_theme_support('post-formats', array( 'video'));
	
	if(!empty($taxes)) {
		foreach($taxes as $tax=>$terms) {
			$args['tax_query']['relation'] = 'AND';
			
			if($tax=='post_format' && ($terms=='-1' || $terms=='standard')) {
				$post_formats = get_theme_support('post-formats');
				$terms = array();
				foreach ($post_formats[0] as $format) {
					$terms[] = 'post-format-'.$format;
				}
				$args['tax_query'][] = array(
					'taxonomy' => $tax,
					'field' => 'slug',
					'terms' => $terms,
					'operator' => 'NOT IN'
				);
			} elseif($tax == 'post_tag') {
				if(!is_array($terms))
					$terms = explode(',', trim($terms));
				$args['tax_query'][] = array(
					'taxonomy' => $tax,
					'field' => 'slug',
					'terms' => $terms,
					'operator' => 'IN'
				);
			} else {
				$args['tax_query'][] = array(
					'taxonomy' => $tax,
					'field' => 'id',
					'terms' => (array)$terms,
					'operator' => 'IN'
				);
			}
		}
	}



function ajax_login_init(){


    wp_register_script('ajax-login-script', get_template_directory_uri() . '/javascript/ajax-login-script.js', array('jquery') ); 
    wp_enqueue_script('ajax-login-script');

    wp_localize_script( 'ajax-login-script', 'ajax_login_object', array( 
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'redirecturl' => home_url(),
        'loadingmessage' => __('Sending user info, please wait...')
    ));

    // Enable the user with no privileges to run ajax_login() in AJAX
    add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

// Execute the action only if the user isn't logged in
if (!is_user_logged_in()) {
    add_action('init', 'ajax_login_init');
}

function ajax_login(){

    // First check the nonce, if it fails the function will break
    check_ajax_referer( 'ajax-login-nonce', 'security' );

    // Nonce is checked, get the POST data and sign user on
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;

    $user_signon = wp_signon( $info, false );
    if ( is_wp_error($user_signon) ){
        echo json_encode(array('loggedin'=>false, 'message'=>__('Wrong username or password.')));
    } else {
        echo json_encode(array('loggedin'=>true, 'message'=>__('Login successful, redirecting...')));
    }

    die();
}
function load_wp_media_files() {

wp_enqueue_media();

}

add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );

