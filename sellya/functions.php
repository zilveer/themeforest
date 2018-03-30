<?php

/**

 * @package Sellya

 * @subpackage Sellya

 */

define('SWPF_FREAMWORK_DIRECTORY','swpf');  

require_once ('admin/index.php');

require_once("swpf/widgets/swpf-tweets-widget.php");

require_once("swpf/widgets/swpf-address-info-widget.php");

require_once("swpf/widgets/custom-photo-slider-widget.php");

require_once("swpf/widgets/swpf-ad-120-by-240-widget.php");

require_once("swpf/widgets/swpf-ad-125-by-125-widget.php");

require_once("swpf/widgets/swpf-blog-widget.php");

require_once("swpf/widgets/swpf-flickr-widget.php");

require_once("swpf/widgets/swpf-tab-widget.php");

require_once("swpf/widgets/swpf-popular-post-widget.php");

require_once("swpf/ctp/sds_wcm_brands.php");

require_once("swpf/widgets/swpf-brands-widget.php");

require_once("swpf/class-search-autocomplete.php");

require_once("swpf/nav_menu_walker.php");

require_once("swpf/sliders.php");

require_once("swpf/class-tgm-plugin-activation.php");


/* Remove unwanted actions */


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );

/* Remove Add to cart button and quantity from single product and from whole wp site*/

//remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

add_action('woocommerce_right_sm_product_summary','woocommerce_output_related_products',20);

global $smof_data;

if(isset($smof_data['sellya_product_alt_image_setting']) and $smof_data['sellya_product_alt_image_setting'] == 0){
        
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
}



/*end add/remove actions*/


/* add tgm action*/

add_action( 'tgmpa_register', 'sellya_register_required_plugins' );

function sellya_register_required_plugins(){

	/**

	 * Array of plugin arrays. Required keys are name and slug.

	 * If the source is NOT from the .org repo, then source is also required.

	 */

	$plugins = array(

		array(

			'name'     				=> 'Breadcrumb NavXT', // The plugin name

			'slug'     				=> 'breadcrumb-navxt', // The plugin slug (typically the folder name)

			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required

			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented

			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch

			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins

			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

		),

		array(

			'name'     				=> 'Contact Form 7', // The plugin name

			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)

			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required

			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented

			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch

			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins

			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

		),

		array(

			'name'     				=> 'Really Simple CAPTCHA', // The plugin name

			'slug'     				=> 'really-simple-captcha', // The plugin slug (typically the folder name)

			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required

			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented

			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch

			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins

			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

		),
		
		array(

			'name'     				=> 'Sellya Shortcodes', // The plugin name

			'slug'     				=> 'sellya-shortcodes', // The plugin slug (typically the folder name)

			'source'   				=> get_template_directory() . '/swpf/plugins/sellya-shortcodes.zip', // The plugin source

			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required

			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented

			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch

			'force_deactivation'            => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins

			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL

		),
		
//		array(
//
//			'name'     				=> 'Smartdatasoft Woocommerce Latest Product by Category', // The plugin name
//
//			'slug'     				=> 'sds-wc-cat', // The plugin slug (typically the folder name)
//
//			'source'   				=> get_template_directory() . '/swpf/plugins/sds-wc-cat.zip', // The plugin source
//
//			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
//
//			'version' 				=> '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
//
//			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
//
//			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
//
//			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
//
//		),



	);



	// Change this to your theme text domain, used for internationalising strings

	$theme_text_domain = 'sellya';



	/**

	 * Array of configuration settings. Amend each line as needed.

	 * If you want the default strings to be available under your own theme domain,

	 * leave the strings uncommented.

	 * Some of the strings are added into a sprintf, so see the comments at the

	 * end of each line for what each argument will be.

	 */

	$config = array(

		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.

		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins

		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug

		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug

		'menu'         		=> 'install-required-plugins', 	// Menu slug

		'has_notices'      	=> true,                       	// Show admin notices or not

		'is_automatic'    	=> false,					   	// Automatically activate plugins after installation or not

		'message' 			=> '',							// Message to output right before the plugins table

		'strings'      		=> array(

			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),

			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),

			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name

			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),

			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)

			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)

			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)

			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)

			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)

			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)

			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)

			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)

			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),

			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),

			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),

			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),

			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link

			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'

		)

	);

	tgmpa( $plugins, $config );


}

//add_action('post_thumbnail_html','set_sellya_default_post_image',20, 5);

function set_sellya_default_post_image($html, $post_id, $post_thumbnail_id, $size, $attr){

	if(!$post_thumbnail_id):

		$w = gettype($size[0]) != 'integer'?'':$size[0];

		$h = gettype($size[0]) != 'integer'?'':$size[1];

		if(gettype($size) != 'array'):

			$w = get_option( $size . '_size_w' );

			$h = get_option( $size . '_size_h' );

		endif;
		return $img = sprintf("<img src='".get_template_directory_uri()."/image/featured-%sx$h.jpg' alt='featured-%sx$h' height='$h' width='$w' />",$w,$w);

	endif;

	return $html;

}


function sellya_setup() {
	/*
	 * Makes sellya Sport available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on sellya Sport, use a find and replace
	 * to change 'sellya' to the name of your theme in all the template files.
	 */

	load_theme_textdomain( 'sellya', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.

	add_editor_style();

	// Custom Header

	$defaults = array(
		'default-image'          => '',
		'random-default'         => false,
		'width'                  => 0,
		'height'                 => 0,
		'flex-height'            => false,
		'flex-width'             => false,
		'default-text-color'     => '',
		'header-text'            => true,
		'uploads'                => true,
		'wp-head-callback'       => '',
		'admin-head-callback'    => '',
		'admin-preview-callback' => '',
	);
	//add_theme_support( 'custom-header', $defaults );

	// Adds RSS feed links to <head> for posts and comments.

	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'woocommerce' );

	// This theme supports a variety of post formats.

	//add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );

	// This theme uses wp_nav_menu() in one location.

	register_nav_menu( 'primary', __( 'Primary Menu', 'sellya' ) );
	register_nav_menu( 'topnav', __( 'Top Menu', 'sellya' ) );

	/*
	 * This theme supports custom background color and image, and here
	 * we also set up the default background color.
	 */

	/*add_theme_support( 'custom-background', array(

		'default-color' => 'e6e6e6',

	) );
*/
	// This theme uses a custom image size for featured images, displayed on "standard" posts.

	add_theme_support( 'post-thumbnails' );

	set_post_thumbnail_size( 590, 211 ); // Unlimited height, soft crop

		// Add Twenty Eleven's custom image sizes.

	// Used for large feature (header) images.

	//add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );

	add_image_size( 'large-feature',590, 211, true );

	// Used for featured posts if a large-feature doesn't exist.

	add_image_size( 'small-feature', 500, 300 );

	add_image_size('blog-post-img',640,229,true);

	add_option('blog-post-img_size_w',640) or update_option('blog-post-img_size_w',640);

	add_option('blog-post-img_size_h',229) or update_option('blog-post-img_size_h',229);

//	create_wcm_sds_brands_table(); // create wp_wcm_sds_brands table if not exists
	
}

add_action( 'after_setup_theme', 'sellya_setup' );

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since sellya Sport 1.0
 */

function sellya_scripts_styles() {

	global $wp_styles, $wp_scripts;
	global $smof_data;

	/*
	 * Adds JavaScript to pages with the comment form to support
	 * sites with threaded comments (when in use).
	 */

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )

		wp_enqueue_script( 'comment-reply' );
	
	/*
	 * Loads our special font CSS file.
	 *
	 * The use of Open Sans by default is localized. For languages that use
	 * characters not supported by the font, the font can be disabled.
	 *
	 * To disable in a child theme, use wp_dequeue_style()
	 * function mytheme_dequeue_fonts() {
	 *     wp_dequeue_style( 'sellya-fonts' );
	 * }
	 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
	 */

	/* translators: If there are characters in your language that are not supported

	   by Open Sans, translate this to 'off'. Do not translate into your own language. */

	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'sellya' ) ) {

		$subsets = 'latin,latin-ext';

		/* translators: To add an additional Open Sans character subset specific to your language, translate

		   this to 'greek', 'cyrillic' or 'vietnamese'. Do not translate into your own language. */

		$subset = _x( 'no-subset', 'Open Sans font: add new subset (greek, cyrillic, vietnamese)', 'sellya' );

		if ( 'cyrillic' == $subset )

			$subsets .= ',cyrillic,cyrillic-ext';

		elseif ( 'greek' == $subset )

			$subsets .= ',greek,greek-ext';

		elseif ( 'vietnamese' == $subset )

			$subsets .= ',vietnamese';



		$protocol = is_ssl() ? 'https' : 'http';

		$query_args = array(

			'family' => 'Open+Sans:400italic,700italic,400,700',

			'subset' => $subsets,

		);

		wp_enqueue_style( 'sellya-fonts', esc_url(add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" )), array(), null );
				
		$query_args = array('family'=>'Oswald');
		
		wp_enqueue_style( 'Oswald', esc_url(add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" )), array(), null );
		
		$query_args = array('family'=>'PT+Sans+Narrow');
		
		wp_enqueue_style( 'PTSansNarrow', esc_url(add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" )), array(), null );

	}
	
	$fonts = array(
		'_body_fonts', 
		'_headings_fonts',
		'_price_fonts',
		'_buttonf_fonts',
		'_search_fonts',
		'_cart_fonts',
		'_mm_fonts'		
	);
	
	foreach($fonts as $font):
	
		$font = 'sellya'.$font;
	
		if($smof_data[$font] != ''):
		
			$query_args = array('family'=>$smof_data[$font]);
                
                        $fontsrc = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
                        
                        $font_headers = get_headers($fontsrc);
                        
                        if(isset($font_headers[0]) && strpos($font_headers[0],'400') === FALSE){                     
                            wp_enqueue_style( preg_replace('/[\W]/','',$smof_data[$font]), esc_url($fontsrc), array(), null );
                        }
		
		
		endif;
	
	endforeach;
	
	/*
	 * Loads our main stylesheet.
	 */


        wp_enqueue_style('livesearch',get_template_directory_uri().'/css/livesearch.css',array(),'1.0');
	wp_enqueue_style( 'Awesome-styles', get_template_directory_uri() . "/css/font-awesome.css", '', '3.2.1' );
	
	wp_enqueue_style('bootstrap',get_template_directory_uri().'/css/bootstrap.css');
	
	wp_enqueue_style('stylesheet',get_template_directory_uri().'/css/stylesheet.css');
	
	wp_enqueue_style('stylesheet-mobile',get_template_directory_uri().'/css/stylesheet-mobile.css');
	
	
	
	wp_enqueue_style( 'sellya-style', get_stylesheet_uri() );

	wp_enqueue_style('custom-style',get_template_directory_uri().'/custom_style.php',array(),'1.0');

	wp_enqueue_style( 'Shortcode-styles', get_template_directory_uri()."/css/shortcode-styles.css" );

	

	/* Load Other designs css*/

	$prefix =  isset($_SERVER['HTTPS'])?'https:':'http:';
	
	
	 /* Theme Skins */
	
	$theme_skin = $smof_data['sellya_skin'];
        
        if(isset($_COOKIE['sellya_skin'])){		
            $theme_skin = $_COOKIE['sellya_skin'];
	}
        
        if(isset($_GET['skin']) and $theme_skin != $_GET['skin']){
            $theme_skin = $_GET['skin'];
        }
        
	
	if($theme_skin == 'Kids'):

		wp_enqueue_style( 'Kids', get_template_directory_uri()."/css/stylesheet/sellya_kids.css" );

		wp_enqueue_style( 'Salsa', "$prefix//fonts.googleapis.com/css?family=Salsa" );

	elseif($theme_skin == 'Sport'):

		wp_enqueue_style( 'Sport', get_template_directory_uri()."/css/stylesheet/sellya_sport.css" );

	elseif($theme_skin == 'Fashion'):

		wp_enqueue_style( 'Fashion', get_template_directory_uri()."/css/stylesheet/sellya_fashion.css" );

	elseif($theme_skin == 'Gifts'):

		wp_enqueue_style( 'Gifts', get_template_directory_uri()."/css/stylesheet/sellya_gifts.css" );

	elseif($theme_skin == 'Restaurant'):

		wp_enqueue_style( 'Restaurant', get_template_directory_uri()."/css/stylesheet/sellya_restaurant.css" );

		wp_enqueue_style( 'Bree-Serif', "$prefix//fonts.googleapis.com/css?family=Bree+Serif" );

		wp_enqueue_style( 'Ubuntu', "$prefix//fonts.googleapis.com/css?family=Ubuntu" );

	elseif($theme_skin == 'Light'):

		wp_enqueue_style( 'Light', get_template_directory_uri()."/css/stylesheet/sellya_light.css" );

	elseif($theme_skin == 'Electronics'):

		wp_enqueue_style( 'Electronics', get_template_directory_uri()."/css/stylesheet/sellya_electronics.css" );

		wp_enqueue_style( 'Cuprum', "$prefix//fonts.googleapis.com/css?family=Cuprum" );

	endif;

	/*

	 * Loads the Internet Explorer specific stylesheet.

	 */
	 
	
	wp_register_style( 'sellya-ie-7', get_template_directory_uri() . '/css/ie7.css', array(),'1.0');
	
	$wp_styles->add_data( 'sellya-ie-7', 'conditional', 'IE 7' );
	
	wp_enqueue_style( 'sellya-ie-7');
	
	
	wp_register_style( 'sellya-ie-8', get_template_directory_uri() . '/css/ie8.css', array(),'1.0' );
	
	$wp_styles->add_data( 'sellya-ie-8', 'conditional', 'IE 8' );
	
	wp_enqueue_style( 'sellya-ie-8');
	
	
	wp_register_style( 'sellya-ie', get_template_directory_uri() . '/css/ie.css', array( 'sellya-style' ), '1.0' );
	
	$wp_styles->add_data( 'sellya-ie', 'conditional', 'lte IE 9' );
	
	wp_enqueue_style( 'sellya-ie');
	

	wp_enqueue_script(array('jquery-ui-accordion','jquery-ui-tabs','jquery-ui-draggable','jquery-ui-droppable','jquery-ui-position'),'',array('jquery','jquery-ui-core'));

}

add_action( 'wp_enqueue_scripts', 'sellya_scripts_styles', 20 );

function sellya_set_theme_outlook(){
    if(isset($_GET['skin'])){		
        $theme_skin = $_GET['skin'];
        //$dirname = ABSPATH;
        setcookie('sellya_skin',$theme_skin,time()+3600, ABSPATH);				
    }
    
}
add_action('template_redirect','sellya_set_theme_outlook');





add_action('wp_head','add_product_categories_js');

function add_product_categories_js($content){
	
	?>
    
<script type="text/javascript">

jQuery(function($){		
	"use strict";
	$("ul.product-categories li").each(function(){
	
		if($(this).find('ul.children').length>0){
		  
		  $(this).addClass('parent-cat');
		  
		  $(this).prepend('<span class="expand plus"></span>');
		  
		  $('ul.children li').removeClass('parent-cat');
		  
		}
	
	});
        $('ul.product-categories li.parent-cat .expand').on('click',function(e){
            e.preventDefault();
            if($(this).hasClass('plus')){
                
                $(this).removeClass('plus').addClass('minus');		
		$(this).parent().children('ul.children').slideDown(250);
                
            }else{
                $(this).removeClass('minus').addClass('plus');		
		$(this).parent().find('ul.children').slideUp(250).find('.minus').removeClass('minus').addClass('plus');
            }
            
        });
	
	$('.btn-navbar').toggle(function(){
		
		$(this).next('.nav-collapse').slideDown(200);
		
	},function(){
		
		$(this).next('.nav-collapse').slideUp(200);
		
	})
	
	$(".navbar .nav > li").each(function(){
	
		if($(this).find('ul').length>0){
	
			$(this).prepend('<span class="expand">+</span>');
			
		}
		
	});
	
	
	
	$(".navbar .nav > li > span.expand").live('click',function(){
	
		var elem = $(this).parent().find('ul');
		
		if(elem.length>0 && elem.css('display')=='none'){
			
			elem.slideDown(200);
			
			$(this).html('-');
			
		}
		else if(elem.length>0 && elem.css('display')=='block'){
			
			elem.slideUp(200);
			
			$(this).html('+');
			
		}
		
	});
	

});
	
</script>
    <?php
	
}


function sellya_scripts_styles_pre(){
		
	global $post;

	$pagetemplate = '';

	$sellya_page_template = '';	

	if(is_page()){
		
		$pagetemplate = get_page_template();
		$sellya_page_template = get_post_meta($post->ID, 'sellya_page_template', true);
	}	
	
	/**
	 * Loading CSS
	 */
	
	wp_enqueue_style('ui.totop',get_template_directory_uri().'/css/ui.totop.css');
	
	wp_enqueue_style('tipTip',get_template_directory_uri().'/css/tipTip.css');
	
	wp_enqueue_style('carousel',get_template_directory_uri().'/css/carousel.css');
	
	//wp_enqueue_style('elastic-slideshow',get_template_directory_uri().'/css/elastic_slideshow.css');
	
	
	wp_enqueue_style('staffCircleEffect',get_template_directory_uri().'/css/staffCircleEffect.css');
	
	/**
	 * Loading JS
	 */
	 
	wp_enqueue_script('cookie',get_template_directory_uri().'/js/jquery.cookie.js',array('jquery'),'',true);
	
	wp_enqueue_script('easing',get_template_directory_uri().'/js/jquery.easing.js',array('jquery'),'',true);
	
	//if(strpos($pagetemplate,'template-home') !== FALSE):		
	
		wp_enqueue_style('elastic-slideshow',get_template_directory_uri().'/css/elastic_slideshow.css');
	
		wp_enqueue_script('elastislide',get_template_directory_uri().'/js/jquery.elastislide.js',array('jquery'),'',true);	
		
	
	//endif;
	
	
	//if(strpos($pagetemplate,'template-home-fullwidth-with-flexslider') !== FALSE):
	
		wp_enqueue_style('flexslider',get_template_directory_uri().'/css/flexslider.css');
	
		wp_enqueue_script('flexslider',get_template_directory_uri().'/js/jquery.flexslider-min.js',array('jquery'),'',true);
	
	//endif;
	
	
	//if(is_single() and $post->post_type == 'product'):
	
		wp_enqueue_style('cloud-zoom',get_template_directory_uri().'/css/cloud-zoom.css');
	
		wp_enqueue_style('colorbox',get_template_directory_uri().'/js/colorbox/colorbox.css');
	
		wp_enqueue_script('cloud-zoom',get_template_directory_uri().'/js/cloud-zoom.js',array('jquery'),'',true);
	
		wp_enqueue_script('colorbox',get_template_directory_uri().'/js/colorbox/jquery.colorbox.js',array('jquery'),'',true);	
		wp_enqueue_script('bxSlider',get_template_directory_uri().'/js/jquery.bxSlider.js',array('jquery'),'',true);
	
	//endif;
	
	if(strpos($sellya_page_template,'template-portfolio') !== FALSE):
	
		wp_enqueue_style('colorbox',get_template_directory_uri().'/js/colorbox/colorbox.css');
		
		wp_enqueue_script('colorbox',get_template_directory_uri().'/js/colorbox/jquery.colorbox.js',array('jquery'),'',true);
		wp_enqueue_script('isotope',get_template_directory_uri().'/js/jquery.isotope.min.js',array('jquery'),'',true);
	
	endif;
	
	
	//if(strpos($pagetemplate,'template-home') !== FALSE and strpos($pagetemplate,'template-home-fullwidth-with-flexslider') === FALSE and strpos($pagetemplate,'template-home-fullwidth-with-product-slider') === FALSE):
	
		wp_enqueue_style('camera',get_template_directory_uri().'/css/camera.css');
	
		wp_enqueue_script('camera',get_template_directory_uri().'/js/camera.js',array('jquery'),'',true);
		
		
        //endif;    
	wp_enqueue_script(array('jquery-ui-core','jquery-ui-autocomplete'),'',array('jquery'));
	wp_enqueue_script('lc_dropdown',get_template_directory_uri().'/js/lc_dropdown.js',array('jquery'),'',true);	
	wp_enqueue_script('tipTip',get_template_directory_uri().'/js/jquery.tipTip.js',array('jquery'),'',true);		
	wp_enqueue_script('bootstrap-dropdown',get_template_directory_uri().'/js/bootstrap-dropdown.js',array('jquery'),'',true);	
	wp_enqueue_script('bootstrap-collapse',get_template_directory_uri().'/js/bootstrap-collapse.js',array('jquery'),'',true);		
}


add_action( 'wp_enqueue_scripts', 'sellya_scripts_styles_pre' );


function set_sellya_skin_cookie(){

	if(isset($_GET['skin'])){
		
		$theme_skin = $_GET['skin'];
		setcookie('sellya_skin', $theme_skin, time() + ( 2 * 3600),'/', $_SERVER['HTTP_HOST']);
		
	}
	
}

add_action('wp','set_sellya_skin_cookie');


function sellya_footer_callback(){
	
	global $post,$woocommerce,$smof_data,$product;
	
	
	$template = '';
	
	if(is_page()):
	
		$template = basename(get_page_template());
	
		$template = substr($template,0,strrpos($template,'.'));
		
	endif;
	
	
	
	$pagetemplate = $template;
	
	$elastisliders = array('featured-slider'=>true,'latest-slider'=>true);
	
	
?>

	<!-- We will load all the js in the footer because that will help us to load the webpage fast! //-->

<?php
//if(strpos($pagetemplate,'template-home') !== FALSE):
	foreach($elastisliders as $id=>$val):?>
    
    <script type="text/javascript">
    jQuery('#<?php echo $id?>').elastislide({

		speed       : 450,	// animation speed
	
		easing      : '',	// animation easing effect	
	
		minItems	: 1			
	
	});
	</script>
<?php 
	endforeach;
?> 
	<script type="text/javascript">
    
        jQuery('#carousel-featured-0').elastislide({
    
            speed       : 450,	// animation speed
            easing      : 'ease-in-out',	// animation easing effect
    
    
            // the minimum number of items to show. When we resize the window, this will make sure minItems are always shown (unless of course minItems is higher than the total number of elements)
            minItems	: 1
        });
    
        //Fix to adjust on windows resize
        jQuery(window).triggerHandler('resize.elastislide');
        
        jQuery('#carousel-latest-0').elastislide({
    
            speed       : 450,	// animation speed
            easing      : '',	// animation easing effect
    
    
            // the minimum number of items to show. When we resize the window, this will make sure minItems are always shown (unless of course minItems is higher than the total number of elements)
            minItems	: 1
        });
    
        //Fix to adjust on windows resize
        jQuery(window).triggerHandler('resize.elastislide');
    
        jQuery('#carousel0').elastislide({
    
            speed       : 450,	// animation speed
            easing      : '',	// animation easing effect
    
    
            // the minimum number of items to show. When we resize the window, this will make sure minItems are always shown (unless of course minItems is higher than the total number of elements)
            minItems	: 1
        });
    
        //Fix to adjust on windows resize
        jQuery(window).triggerHandler('resize.elastislide');
        
        
        jQuery('#carousel1').elastislide({
    
            speed       : 450,	// animation speed
            easing      : '',	// animation easing effect
    
    
            // the minimum number of items to show. When we resize the window, this will make sure minItems are always shown (unless of course minItems is higher than the total number of elements)
            minItems	: 1
        });
        jQuery('#carouselbanners').elastislide({
    
            speed       : 450,	// animation speed
            easing      : '',	// animation easing effect
    
    
            // the minimum number of items to show. When we resize the window, this will make sure minItems are always shown (unless of course minItems is higher than the total number of elements)
            minItems	: 1
        });
    
    
        //Fix to adjust on windows resize
        jQuery(window).triggerHandler('resize.elastislide');
    
    </script>
<?php
//endif;
?>
    <script type="text/javascript">
    
	
	jQuery(function(){
		"use strict";
		jQuery(".facebook_right").hover(function(){            
			jQuery(".facebook_right").stop(true, false).animate({right: "0" }, 800, 'easeOutQuint' );        
		},
		function(){     
			jQuery(".facebook_right").stop(true, false).animate({right: "-245" }, 800, 'easeInQuint' );        
		},1000);    
			  
		jQuery(".facebook_left").hover(function(){            
		   jQuery(".facebook_left").stop(true, false).animate({left: "0" }, 800, 'easeOutQuint' );        
		},
		function(){            
		   jQuery(".facebook_left").stop(true, false).animate({left: "-245" }, 800, 'easeInQuint' );        
		},1000);    
	});  
    </script>
    <script type="text/javascript">    
	jQuery(function(){
		"use strict";
		jQuery(".custom_box_right").hover(function(){            
			jQuery(".custom_box_right").stop(true, false).animate({right: "0" }, 800, 'easeOutQuint' );        
		},
		function(){            
			jQuery(".custom_box_right").stop(true, false).animate({right: "-245" }, 800, 'easeInQuint' );      
		},1000);    
	
		jQuery(".custom_box_left").hover(function(){            
			jQuery(".custom_box_left").stop(true, false).animate({left: "0" }, 800, 'easeOutQuint' );        
		},
		function(){            
			jQuery(".custom_box_left").stop(true, false).animate({left: "-245" }, 800, 'easeInQuint' );        
		},1000);    
	});  
    </script>
      
    
    
    <?php 
	//if(strpos($pagetemplate,'template-home') !== FALSE and strpos($pagetemplate,'template-home-fullwidth-with-flexslider') === FALSE and strpos($pagetemplate,'template-home-fullwidth-with-product-slider') === FALSE):
	?>
    
    <script type="text/javascript">
	jQuery(function($){
		"use strict";
		$('#camera_wrap_0').camera({
			thumbnails: true,
			loader: true,
			hover: false
		});			
	});
	</script>
    
    <?php 
	//endif;
	?>
    <?php 
	//if((is_single() and $post->post_type == 'product')):
	?>
    
    <script type="text/javascript">
	jQuery(function($){
		"use strict";
		$('.colorbox').colorbox({
			overlayClose: true,
			opacity: 0.5,			
		});
					
	});
	</script>
    <?php
	//endif;
	?>
    
    <?php
	if(strpos($pagetemplate,'template-portfolio') !== FALSE):
	?>
    <script type="text/javascript">
    jQuery(function($){
		"use strict";
		$('#works-container a.mosaic-overlay').colorbox({
			overlayClose: true,
			opacity: 0.5,
			width: '100%'
		});
	});
	</script>
    <?php
	endif;
	?>
    
    <script type="text/javascript">
        /*jQuery(document).ready(function($) {
			"use strict";
			$.UItoTop({ easingType: 'easeOutQuart' });	
        });*/
        
        jQuery(function($){
			"use strict";
            $(".tiptip").tipTip();
            
            $('body').on('DOMNodeInserted', '.blockUI.blockOverlay', function(e) {
                var h = $(window).height();                
                $(this).css({height:h+'px',zIndex:9999999,display:'block',position:'fixed'});
            });
            
            
            $('#cart > .heading a').live('mouseover', function() {
                
                $('#cart').addClass('active');			
                $('#cart .content').show();			
                $('#cart').live('mouseleave', function() {
                    $(this).removeClass('active');
                    $(this).find('.content').hide();
                });
            });
            
            $('.woocommerce-tabs ul.tabs li a').unbind('click'); //unbind woocommerce default event on woocommerce-tabs 
            
            $('.woocommerce-tabs ul.tabs li a').click(function(){
    
                var $tab = $(this);
                
                var $tabs_wrapper = $tab.closest('.woocommerce-tabs');
                
                var $tab_parent = $tab.closest('li');
                
              if($('html,body').outerWidth(true)<751 && $tab_parent.hasClass('hidden-phone')){
                    return false;
              }
                    
                $('ul.tabs li', $tabs_wrapper).removeClass('active');
                $('div.panel', $tabs_wrapper).hide();
                $('div' + $tab.attr('href')).show();
                $tab.parent().addClass('active');
        
                return false;
            });
            
            $( "#tab" ).tabs();
            
            $('.sellya_tabs').tabs();
            
            
            $('#content #comments .commentList li').bind('DOMNodeInserted',function(e){
				
				e.preventDefault();	
              
                var widW = $(window).width();
            
                var elem = $('#content #comments .commentList li div#respond');
                
                var topV = 24;
                
                topV += $('#wpadminbar').length>0 ? $('#wpadminbar').height() : 0;
                
				if(widW > 750){
                  elem.css('top',topV+'px');				
				}
                
            });	
            
        });
            
            
    </script>
    
    <?php 
//	if(isset($post->post_type) and $post->post_type == 'product' and isset($woocommerce)):
	if(is_singular('product')):
            
        
	?>
    <script type="text/javascript">
		jQuery(function($){

                    <?php if($smof_data['sellya_en_colorbox'] != 1){?>
                            
                        $('.cloud-zoom').CloudZoom({zoomWidth:'auto',zoomHeight:'auto',position:'inside'});
                        $(document.body).on('click','.image-additional a,.cloud-zoom-gallery',function(){

                            var $this = $(this);
                            var src = $this.attr('href');
                            $('.product-info .left .image > #wrap a, .product-info .left .image .zoom-b a').attr('href',src);
                            $('.product-info .left .image > #wrap a img').attr('src',src);                        
                            $('.cloud-zoom').data('zoom').destroy();                                
                            $('.cloud-zoom').CloudZoom({zoomWidth:'auto',zoomHeight:'auto',position:'inside'});  
                            setTimeout(function(){
                                if($('.mousetrap').length > 1)
                                    $('.mousetrap:not(:last-child)').remove();
                            },500);
                            return false;
                        });
                    <?php }?>
                    var form = $('form.variations_form');

                    if(form.length === 1){

                           var variations = form.data('product_variations');
                           var $product_img = $('.product div.image img#image');                    
                           var src = $product_img.attr('src');

                           $.each(variations,function(k,v){                                    
                               var match = 0;
                               var count = 0;

                               $.each(v.attributes, function(name,value){
                                   count++;
                                   var vval = form.find('[name="'+name+'"] > option[selected]').val();

                                   if(value === vval || (value === '' && vval !== undefined && vval !== ''))
                                       match++;                                        
                               });

                               if(match === count){
                                   if(v.image_src != '' && v.image_link != ''){                                
                                       $product_img.parent().attr('href',v.image_link);
                                       $product_img.attr('src',v.image_link);
                                       $product_img.closest('.image').find('.zoom-b a').attr('href',v.image_link);
                                      <?php if($smof_data['sellya_en_colorbox'] != 1){?>
                                               
                                               if($('.cloud-zoom').data('zoom') != null)
                                                   $('.cloud-zoom').data('zoom').destroy();
                                               setTimeout(function(){
                                                   $('.cloud-zoom').CloudZoom({zoomWidth:'auto',zoomHeight:'auto',position:'inside'});
                                               },600);                                        
                                       <?php }?>

                                   }                                        
                               }

                           });

                   }

                    form.on('found_variation',function(event, variation){
                        
                        var $product 		= $(this).closest( '.product' );
                        var $product_img 	= $product.find( 'div.image img:eq(0)' );
                        var $product_link 	= $product.find( 'div.image a.cloud-zoom:eq(0)' );

                        var cloud_zoom          = $product.find('a.cloud-zoom');

                        if(variation.variation_id != 'undefined' && variation.image_link){                                

                            cloud_zoom.attr("href",variation.image_link);
                            cloud_zoom.find('img').attr("src",variation.image_link);

                            $product.find('.zoom-b a.colorbox').attr("href",variation.image_link);

                            <?php if($smof_data['sellya_en_colorbox'] != 1){?>
                                if($('.cloud-zoom').data('zoom') != null)
                                    $('.cloud-zoom').data('zoom').destroy();
                                setTimeout(function(){
                                    $('.cloud-zoom').CloudZoom({zoomWidth:'auto',zoomHeight:'auto',position:'inside'});
                                },600);                                        
                            <?php }?>
                                
                        }else{
                            $(this).trigger('pr_reset_image');
                        }


                    }).on( 'pr_reset_image', function( event ) {
                        var $product 		= $(this).closest( '.product' );
                        $product.find('.image-additional .cloud-zoom-gallery:first-child').trigger('click');
                    });
                    $('.product').on('click','.reset_variations',function(){
                        form.trigger('pr_reset_image');
                    });

            });
	</script>
    
    <?php
	
	endif;
	
	?>
    

<?php
	
}

add_action('wp_footer','sellya_footer_callback',100);


/**

 * Creates a nicely formatted and more specific title element text

 * for output in head of document, based on current view.

 *

 * @since sellya Sport 1.0

 *

 * @param string $title Default title text for current view.

 * @param string $sep Optional separator.

 * @return string Filtered title.

 */

function sellya_wp_title( $title, $sep ) {

	global $paged, $page;



	if ( is_feed() )

		return $title;



	// Add the site name.

	$title .= get_bloginfo( 'name' );



	// Add the site description for the home/front page.

	$site_description = get_bloginfo( 'description', 'display' );

	if ( $site_description && ( is_home() || is_front_page() ) )

		$title = "$title $sep $site_description";



	// Add a page number if necessary.

	if ( $paged >= 2 || $page >= 2 )

		$title = "$title $sep " . sprintf( __( 'Page %s', 'sellya' ), max( $paged, $page ) );



	return $title;

}

add_filter( 'wp_title', 'sellya_wp_title', 10, 2 );



/**

 * Makes our wp_nav_menu() fallback -- wp_page_menu() -- show a home link.

 *

 * @since sellya Sport 1.0

 */

function sellya_page_menu_args( $args ) {

	if ( ! isset( $args['show_home'] ) )

		$args['show_home'] = true;

	return $args;

}

add_filter( 'wp_page_menu_args', 'sellya_page_menu_args' );

/**
* Enabling Shortcode in Text Widget
*
*/

add_filter('widget_text', 'do_shortcode');

/**
 * Registers our main widget area and the front page widget areas.
 *
 * @since sellya Sport 1.0
 */

function sellya_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Blog Leftbar', 'sellya' ),
		'id' => 'blogsidebar',
		'before_widget' => '<div class="box %2$s" id="%1$s"> ',
		'after_widget' => "</div>",
		'before_title' => '<div class="box-heading"><h2>',
		'after_title' => '</h2></div>',
	) );	

	register_sidebar( array(
		'name' => __( 'Page Left Sidebar', 'sellya' ),
		'id' => 'page-left-sidebar',
		'before_widget' => '<div class="box %2$s" id="%1$s"> ',
		'after_widget' => "</div>",
		'before_title' => '<div class="box-heading"><h2>',
		'after_title' => '</h2></div>',
	) );

	register_sidebar( array(
		'name' => __( 'Page Right Sidebar', 'sellya' ),
		'id' => 'page-right-sidebar',
		'before_widget' => '<div class="box %2$s" id="%1$s"> ',
		'after_widget' => "</div>",
		'before_title' => '<div class="box-heading"><h2>',
		'after_title' => '</h2></div>',
	) );

	register_sidebar( array(
		'name' => __( 'Homepage Sidebar', 'sellya' ),
		'id' => 'home-leftbar',
		'before_widget' => '<div class="box %2$s" id="%1$s"> ',
		'after_widget' => "</div>",
		'before_title' => '<div class="box-heading"><h2>',
		'after_title' => '</h2></div>',
	) );

	register_sidebar( array(
		'name' => __( 'Shop Leftbar', 'sellya' ),
		'id' => 'leftbar',
		'before_widget' => '<div class="box %2$s" id="%1$s"> ',
		'after_widget' => "</div>",
		'before_title' => '<div class="box-heading"><h2>',
		'after_title' => '</h2></div>',
	) );

	

	register_sidebar( array(
		'name' => __( 'Footer1', 'sellya' ),
		'id' => 'footer1',
		'before_widget' => '<div class="span4"> ',
		'after_widget' => "</div>",
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer2', 'sellya' ),
		'id' => 'footer2',
		'before_widget' => '<div class="span3"> ',
		'after_widget' => "</div>",
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	) );

}

add_action( 'widgets_init', 'sellya_widgets_init' );



if ( ! function_exists( 'sellya_content_nav' ) ) :

/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since sellya Sport 1.0
 */
function sellya_content_nav( $html_id ) {

	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>

		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">

			<h3 class="assistive-text"><?php _e( 'Post navigation', 'sellya' ); ?></h3>

			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'sellya' ) ); ?></div>

			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'sellya' ) ); ?></div>

		</nav><!-- #<?php echo $html_id; ?> .navigation -->

	<?php endif;

}

endif;



if ( ! function_exists( 'sellya_comment' ) ) :

/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own sellya_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since sellya Sport 1.0
 */

function sellya_comment( $comment, $args, $depth ) {
	
	$GLOBALS['comment'] = $comment;

	$max_depth = $args['max_depth'];

	$liclass = ( $GLOBALS['ncc'] % 2 == 0 )? 'even' : 'odd';

	?>

	<li class="<?php echo $liclass." depth-$depth"?>">

         <div itemtype="http://schema.org/UserComments" itemscope="" itemprop="comment" id="comment-<?php echo $comment->comment_ID?>">

            <?php echo get_avatar($comment->user_id,54,'',$comment->comment_author);?>

            <div class="name"><?php echo $comment->comment_author;?></div>

            <div class="created">

				<span itemprop="commentTime"><?php echo date(get_option('date_format').' '.get_option('time_format'),strtotime($comment->comment_date));?></span>

            </div>

            <p itemprop="commentText"><?php echo get_comment_text($comment->comment_ID);?></p>

			<div class="reply">

				<?php

				$arr = array('reply_text' => __( 'Reply', 'sellya' ));

				comment_reply_link( array_merge($arr,array('depth'=>$depth,'max_depth'=>$max_depth)));

				?>

			</div>

		</div>

<?php	

	$GLOBALS['ncc']++;

}

endif; // ends check for sellya_comment()

if ( ! function_exists( 'sellya_entry_meta' ) ) :

/**

 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.

 *

 * Create your own sellya_entry_meta() to override in a child theme.

 *

 * @since sellya Sport 1.0

 */

function sellya_entry_meta() {

	// Translators: used between list items, there is a space after the comma.

	$categories_list = get_the_category_list( __( ', ', 'sellya' ) );

	// Translators: used between list items, there is a space after the comma.

	//$tag_list = get_the_tag_list( '', __( ', ', 'sellya' ) );

	$date = sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',

		esc_url( get_permalink() ),

		esc_attr( get_the_time() ),

		esc_attr( get_the_date( 'c' ) ),

		esc_html( get_the_date() )

	);

	$author = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',

		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),

		esc_attr( sprintf( __( 'View all posts by %s', 'sellya' ), get_the_author() ) ),

		get_the_author()

	);

	// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.

	if ( $categories_list ) {

		$utility_text = __( 'Posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'sellya' );

	} else {

		$utility_text = __( 'This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'sellya' );

	}

	printf(

		$utility_text,

		$categories_list,

		$tag_list,

		$date,

		$author

	);

}

endif;



/**

 * Extends the default WordPress body class to denote:

 * 1. Using a full-width layout, when no active widgets in the sidebar

 *    or full-width template.

 * 2. Front Page template: thumbnail in use and number of sidebars for

 *    widget areas.

 * 3. White or empty background color to change the layout and spacing.

 * 4. Custom fonts enabled.

 * 5. Single or multiple authors.

 *

 * @since sellya Sport 1.0

 *

 * @param array Existing class values.

 * @return array Filtered class values.

 */

function sellya_body_class( $classes ) {

	$background_color = get_background_color();



	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )

		$classes[] = 'full-width';



	if ( is_page_template( 'page-templates/front-page.php' ) ) {

		$classes[] = 'template-front-page';

		if ( has_post_thumbnail() )

			$classes[] = 'has-post-thumbnail';

		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )

			$classes[] = 'two-sidebars';

	}



	if ( empty( $background_color ) )

		$classes[] = 'custom-background-empty';

	elseif ( in_array( $background_color, array( 'fff', 'ffffff' ) ) )

		$classes[] = 'custom-background-white';



	// Enable custom font class only if the font CSS is queued to load.

	if ( wp_style_is( 'sellya-fonts', 'queue' ) )

		$classes[] = 'custom-font-enabled';



	if ( ! is_multi_author() )

		$classes[] = 'single-author';



	return $classes;

}

add_filter( 'body_class', 'sellya_body_class' );



/**

 * Adjusts content_width value for full-width and single image attachment

 * templates, and when there are no active widgets in the sidebar.

 *

 * @since sellya Sport 1.0

 */

function sellya_content_width() {

	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {

		global $content_width;

		$content_width = 960;

	}

}

add_action( 'template_redirect', 'sellya_content_width' );



/**

 * Add postMessage support for site title and description for the Theme Customizer.

 *

 * @since sellya Sport 1.0

 *

 * @param WP_Customize_Manager $wp_customize Theme Customizer object.

 * @return void

 */

function sellya_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';

}

//add_action( 'customize_register', 'sellya_customize_register' );



/**

 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.

 *

 * @since sellya Sport 1.0

 */

function sellya_customize_preview_js() {

	wp_enqueue_script( 'sellya-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20120827', true );

}

add_action( 'customize_preview_init', 'sellya_customize_preview_js' );





function new_excerpt_more($more) {

       global $post;

	return '<div class="entry-meta"><a class="post-read-more" href="'. get_permalink($post->ID) . '">'.__('Continue Reading &raquo;','sellya').'</a></div>';

}

add_filter('excerpt_more', 'new_excerpt_more');





function mytheme_init() {

	add_filter('comment_form_defaults','mytheme_comments_form_defaults');

	}

	add_action('after_setup_theme','mytheme_init');

	

	function mytheme_comments_form_defaults($default) {

	unset($default['comment_notes_after']);

	return $default;

}



function get_leftbar( $name = null ) {

	get_sidebar($name);

}

if(!function_exists('get_blogleftbar')){

function get_blogleftbar( $name = null ) {

	get_sidebar($name);

}

}






add_action( 'add_meta_boxes', 'add_custom_template_meta_box' );



add_action( 'save_post', 'save_template_sidebar_location' );



function add_custom_template_meta_box(){

	add_meta_box('_change_sidebar_position','Sidebar Position','change_template_sidebar_location','page','side');

}



function change_template_sidebar_location($post){

	$sidebar_pos = get_post_meta($post->ID,'page-sidebar-pos',true);	

	$templateFile = 'template-home-with-sidebars.php';

	$currentTemplate = get_post_meta($post->ID,'_wp_page_template',true);	

	if($templateFile != $currentTemplate):

	?>

    <style type="text/css">

    	#_change_sidebar_position{ display:none;}

	</style>

    <?php

	endif;

	?>

    <div id="page-sidebar-pos-parent">    	
		<select name="page-sidebar-pos">

            <option value="left"<?php if($sidebar_pos == 'left') echo ' selected="selected"';?>>Left</option>

            <option value="right"<?php if($sidebar_pos == 'right') echo ' selected="selected"';?>>Right</option>

        </select>

    </div>

    <script type="text/javascript">

		jQuery(function($){

			"use strict";
			
			var templateFile = '<?php echo $templateFile;?>';
			
			$('#page_template').change(function(){
			
				var pageTemplate = $(this).val();
				
				if(pageTemplate === templateFile){
				  
				  $('#_change_sidebar_position').show();
				  
				}
				
				else{
				  
				  $('#_change_sidebar_position').hide();
				  
				}
			
			});
		  
		});

    </script>

    <?php


}

function save_template_sidebar_location($post_id){

	if(!isset($_POST['page-sidebar-pos'])) return;

    $metaval = $_POST['page-sidebar-pos'];

    add_post_meta($post_id,'page-sidebar-pos',$metaval,true) or update_post_meta($post_id,'page-sidebar-pos',$metaval);

}


add_action('woocommerce_single_product_summary','add_rating_to_single_product_summary');

function add_rating_to_single_product_summary(){

	global $wpdb, $post, $product;

?>
<div class="product_custom_review">

	<div class="product_custom_rating">

		<div id="reviews">

            <div id="comments">        
    
                <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
    
                    <?php echo $product->get_rating_html()?>
    
                </div>
    
            </div><!--#comments-->

    	</div><!--#reviews-->

    </div>

    <?php if ( comments_open() ) :?>

    <div class="product_custom_review_bottom">

        <center>

<span class="write_review_link review_num"><?php echo comments_number(__('0 review','sellya'), __('1 review','sellya'), __('% reviews','sellya')); ?></span>

        <span class="write_review_link"><?php echo __('Write a review','sellya') ?></span>

	</center>

    

    </div>

    <script type="text/javascript">

		jQuery(function($){

		  "use strict";
		
		  $('span.write_review_link').click(function(){
			
			$('.woocommerce-tabs ul.tabs li').removeClass('active');
			
			$('.woocommerce-tabs .panel').hide();
			
			$('.woocommerce-tabs ul.tabs li.reviews_tab').addClass('active');
			
			$('.woocommerce-tabs #tab-reviews').show();
			
			var revpos = 0;
			
			if($(this).hasClass('review_num')){
			  
			  revpos = $('.woocommerce-tabs #tab-reviews').offset();
			  
			}
			
			else{
			  
			  revpos = $('#review_form_wrapper').offset();
			
			}
			
			revpos = revpos.top;
			
			
			if($('#wpadminbar').length>0){
			  
			  revpos -= 28;
			  
			}
			
			$('html,body').animate({scrollTop: revpos+'px'},500);
			
		  });
		  
		});

    </script>

    <?php endif;?>

</div>

<?php

}

function show_header_carts()	
{

	global $woocommerce;

 if ( sizeof( $woocommerce->cart->get_cart() ) > 0 ) : ?>

	<div class="mini-cart-info">

    <table>

        <tbody>

        <?php foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) :

			$_product = $cart_item['data'];

			if ( ! apply_filters('woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) || ! $_product->exists() || $cart_item['quantity'] == 0 )

                        continue;

			// Get price

			$product_price = get_option( 'woocommerce_display_cart_prices_excluding_tax' ) == 'yes' || $woocommerce->customer->is_vat_exempt() ? $_product->get_price_excluding_tax() : $_product->get_price();

			$product_price = apply_filters( 'woocommerce_cart_item_price_html', woocommerce_price( $product_price ), $cart_item, $cart_item_key );

	?>

        <tr>

            <td class="image">

            <a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>"><?php echo $_product->get_image(); ?></a>

            </td>

            <td class="name"><a href="<?php echo get_permalink( $cart_item['product_id'] ); ?>"><?php echo apply_filters('woocommerce_widget_cart_product_title', $_product->get_title(), $_product ); ?></a>

            </td>

            <td class="quantity"><?php print( '&times; '.$cart_item['quantity']); ?></td>

            <td class="total"><?php echo $product_price;?></td>

        </tr>

       <?php

	   endforeach;

	   ?>

	</tbody></table>

    </div>

    <div class="mini-cart-total">

      <table>

		<tbody>

        <tr>

          <td align="right"><b>Sub-Total:</b></td>

          <td align="right"><?php echo $woocommerce->cart->get_cart_subtotal(); ?></td>

        </tr>

        <tr>

          <td align="right"><b><?php _e('Total:','sellya')?></b></td>

          <td align="right"><?php echo $woocommerce->cart->get_cart_total(); ?></td>

        </tr>

        </tbody></table>

    </div>

	<div class="checkout"><a href="<?php echo $woocommerce->cart->get_cart_url(); ?>" class="button"><?php _e('View Cart', 'sellya'); ?></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $woocommerce->cart->get_checkout_url(); ?>" class="button checkout"><?php _e('Checkout', 'sellya'); ?></a></div>

<?php else:?>

    <div class="empty"><?php _e('Your shopping cart is empty!','sellya')?></div>

<?php endif;

}


add_action('woocommerce_after_single_product','get_bottom_related_product');


function get_bottom_related_product(){

	global $smof_data, $woocommerce, $wpdb, $post, $product;

	

	if(!isset($woocommerce)) return ;

	$related = $product->get_related();	

	$posts_per_page = ($smof_data['sellya_product_page_design'] == 1) ? 4 : 3;

	if($smof_data['sellya_related_pro'] != '0' && $smof_data['sellya_related_product_pos'] == 'bottom' && !empty($related)):	

		$args = apply_filters('woocommerce_related_products_args', array(

					'post_type'				=> 'product',

					'ignore_sticky_posts'	=> 1,

					'no_found_rows' 		=> 1,

					'posts_per_page' 		=> $posts_per_page,

					'orderby' 				=> 'rand',

					'post__in' 				=> $related,

				) );

		$q = new WP_Query( $args );

		$n = 0;

	?>

		<div class="related-products-bottom">

            <h2><?php echo __('Related Products','sellya');?></h2>
            			
            <div class="product-grid">

            <?php

            if($q->have_posts()): while($q->have_posts()): $q->the_post();

                $product_id = get_the_ID();

                $n++;

            ?>

                <div class="span <?php                    

                    if ( ( $n - 1 ) % 4 == 0 )

                        echo 'span-first-child';

                    ?>">

                    <div class="pbox">

                     <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

                    <div class="image">

                      <a href="<?php the_permalink(); ?>">

                          <?php

                              /**

                               * woocommerce_before_shop_loop_item_title hook

                               *

                               * @hooked woocommerce_show_product_loop_sale_flash - 10

                               * @hooked woocommerce_template_loop_product_thumbnail - 10

                               */

                              do_action( 'woocommerce_before_shop_loop_item_title' );

                          ?>

                      </a>      

                      </div>
					<?php 
					$product = get_product($product_id);
					?>
                    
                      <div class="description hidden-phone hidden-tablet"><?php echo apply_filters( 'woocommerce_short_description', $product->post->post_excerpt ) ?></div>

                      <div class="rating hidden-phone hidden-tablet">

                            <div id="reviews">

                                <div id="comments">

                                <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">

                                    <?php 

                                        echo $product->get_rating_html();

                                    ?>

                                </div>

                                </div><!--#comments-->

                            </div><!--#reviews-->

                      </div><!--.rating-->

                      <div class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

                      <?php

                          /**

                           * woocommerce_after_shop_loop_item_title hook

                           *

                           * @hooked woocommerce_template_loop_price - 10

                           */

                          do_action( 'woocommerce_after_shop_loop_item_title' );

                      ?>
  

                      <div class="cart"><?php do_action( 'woocommerce_after_shop_loop_item' ); ?></div>

                      <div class="clear"></div>

                    </div>
                
                </div>

            <?php endwhile; endif; wp_reset_query();?>

            </div><!--.product-grid-->    

        </div><!--.related-products-bottom-->

    <?php

    endif;

}



function get_product_slider($attr = array()){

	/** 

	 * @get_product_slider function

	 * element id(id), heading title(title), type = (featured, top rated, recent), number of posts(number)

	 *

	*/

	global $woocommerce, $wpdb ; 
	global $smof_data;
	if(!isset($woocommerce)) return ;

	$defaults = array(
                            'number'=>-1,
                            'slider'=>true
                    );

	$params = wp_parse_args($attr, $defaults);

	extract($params);

	$query_args = array('posts_per_page' => $number, 'no_found_rows' => 1, 'post_status' => 'publish', 'post_type' => 'product' );

	switch($type):

		case 'featured':

			$query_args['meta_query'] = $woocommerce->query->get_meta_query();

			$query_args['meta_query'][] = array(

				'key' => '_featured',

				'value' => 'yes'

			);

		break;

		case 'top_rated':

			$query_args['meta_query'] = $woocommerce->query->get_meta_query();		

		break;

		default:

			$query_args['meta_query'] = array();

			$query_args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
		
			$query_args['meta_query']   = array_filter( $query_args['meta_query'] );

		break;

	endswitch;

	$q = new WP_Query( $query_args );

	if($q->have_posts()):

	?>

<div class="featured-wrap">

	<h2><?php echo $title;?></h2>

	<div class="product-grid">

        <div class="woocommerce">

        	<div id="<?php echo $id;?>" class="products-slider textwidget">

                <ul class="products">

                <?php

                while($q->have_posts()): $q->the_post();

                    $product_id = get_the_ID();

                    $altimgclass = $smof_data['sellya_product_alt_image_setting'] != 0? 'span havealtimg':'span';
                ?>

                    <li class="<?php echo $altimgclass?>">

                        <div class="pbox">

                         <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

                        <div class="image">

                          <a href="<?php the_permalink(); ?>">

                              <?php                                  

                                  do_action( 'woocommerce_before_shop_loop_item_title' );

                              ?>                              

                          </a>      

                          </div><!--.image -->
                            <?php 
                            $product = get_product($product_id);
                          if($smof_data['sellya_product_alt_image_setting'] == 0){
                            ?>
                          
                          <div class="description hidden-phone hidden-tablet">
                              <?php echo apply_filters( 'woocommerce_short_description', $product->post->post_excerpt ) ?>
                          </div>
                          
                          <div class="rating hidden-phone hidden-tablet">
                                <div id="reviews">
                                    <div id="comments">                        
                                        <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                            <?php echo $product->get_rating_html();?>
                                        </div>
                                    </div><!--#comments-->
                                </div><!--#reviews-->
                          </div><!--.rating-->
                          <?php
                          } else{
                          ?>
                          <div class="description hidden-phone hidden-tablet">
                              <?php
                              $attchments  = $product->get_gallery_attachment_ids();

                                if(isset($attchments[0])){
                                    echo wp_get_attachment_image($attchments[0],'thumbnail',false,array('class'=>"product-img-alt attchment-thumbnail"));
                                }
                                else{
                                    the_post_thumbnail('thumbnail');
                                }
                              ?>
                          </div>
                          <?php }?>
                          
                          <div class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></div>

                          <?php

                              do_action( 'woocommerce_after_shop_loop_item_title' );

                          ?>

                          <div class="cart"><?php do_action( 'woocommerce_after_shop_loop_item' ); ?></div>

                          <div class="clear"></div>

                        </div><!--.pbox -->

                    </li>

                <?php endwhile; ?>

                </ul><!--.products -->

            </div><!--.textwidget -->

    	</div><!--.woocommerce -->

    </div><!--.product-grid-->

</div><!--.featured-wrap -->

    <?php 
	if($slider):
	
		if(isset($GLOBALS['elastislides'])):
		
			if(!empty($GLOBALS['elastislides']))
		
				$GLOBALS['elastislides'] .= "#{$id}," ;
				
			else
				$GLOBALS['elastislides'] = "#{$id}," ;
		
		endif;
	
	endif; 

endif; wp_reset_query();

   

}




add_action( 'admin_enqueue_scripts', 'sellya_admin_enqueue' );



function sellya_admin_enqueue(){

	wp_enqueue_script('jquery');	

}



if(!function_exists('sellya_product_category_markup')){

function sellya_product_category_markup(){

	global $smof_data;

	global $woocommerce;

	

	if(!isset($woocommerce)) return ;

	?>

    <div class="box-content">

        <div class="box-category-home row-fluid">

        <?php 

        $args = array('hide_empty'=>false,'parent'=>0);

        $terms = get_terms('product_cat',$args);

        $n = 0;

        $cat_per_row = intval($smof_data['sellya_categories_per_row']);
 
 		if($cat_per_row == 6)
			$col_class = 2;
		elseif($cat_per_row == 4)	
 			$col_class = 3;
		elseif($cat_per_row == 3)	
 			$col_class = 4;
		else	
 			$col_class = 6;
			
			
        //$col_class = $cat_per_row == 6 ? 2 : 3;

        $subcat_per_col = intval($smof_data['sellya_subcategories_per_column']);				

        if(!empty($terms)): foreach($terms as $term):

            $term_link = $term_parent_link = get_term_link($term->slug,'product_cat');

            $thumbnail_id = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );

            $image = wp_get_attachment_image_src($thumbnail_id,'full');

            $image = $image[0]; 

            $no_img_class = '';

            if(!$thumbnail_id):

                    $image = sprintf("%s/image/no_image-100x100.png",get_template_directory_uri());

                    $no_img_class = "no-cat-img";

            endif;
        ?>                

            <div class="span<?php echo $col_class?><?php echo ( $n % $cat_per_row == 0 )? " span-first-child" : ""?>">
            	<?php if($smof_data['sellya_category_grid_icon_status'] != 0):?>

                <div class="image"><a href="<?php echo $term_link?>"><img class="<?php echo $no_img_class?>" src="<?php echo $image;?>" width="100" height="100" title="<?php echo $term->name?>" alt="<?php echo $term->name?>"></a>

                </div>

                <?php endif;?>

                <a href="<?php echo $term_link?>"><?php echo $term->name?></a>

                <?php 

                $arg2 = array('hide_empty'=>false,'parent'=>$term->term_id,'number'=>$subcat_per_col);

                $t2 = get_terms('product_cat',$arg2);						

                if(!empty($t2)):

                ?>

                <div>

                    <ul>

                        <?php 

                        foreach($t2 as $child):

                        $term_link = get_term_link($child->slug,'product_cat');

                        ?>

                        <li><a href="<?php echo $term_link?>"><?php echo $child->name?> (<?php echo $child->count?>)</a></li>

                        <?php endforeach;?>

                    </ul>

                </div>
				<div class="all">
	                <a href="<?php echo $term_parent_link?>">More</a>
                </div>
                <?php endif;?>

            </div><!--.span2 -->

        <?php

        $n++;

        endforeach;

        endif;

        ?>

        </div><!--.box-category-home -->

    </div><!--.box-content -->

    <?php	

}

}

function blog_one_column_excerpt($content, $len = 20)

{
	$arr = explode(" ",$content);
        
	$cont = array();
	if(count($arr)>$len):

		for($n = 0;$n < $len; $n++):

			$cont[$n] = $arr[$n];
                        
		endfor;
		return '<p>'.implode(' ',$cont).'</p><br />';
	endif;
	return "<p>{$content}</p><br />";

}

function top_cart_script(){

	global $woocommerce;

	if(isset($woocommerce) && get_option( 'woocommerce_cart_redirect_after_add' ) != 'yes'):

?>

	<script type="text/javascript">

    jQuery(function($) {
  
		"use strict";
		
		$(document).off("click",".add_to_cart_button");
		
		$(document).on("click",".add_to_cart_button",function(){
			
		  
		  var t = $(this);
		  
		  if(t.hasClass('product_type_variable') || t.hasClass('product_type_grouped') || $('#header #cart').length < 1){
			return true;
		  }
		  
		  t.removeClass("added");
		  
		  t.addClass("loading");
		  
		  var data={action:"woocommerce_add_to_cart",product_id:t.attr("data-product_id"),quantity:t.attr("data-quantity")};
		  
		  var res = '';
		  
		  var symbol = "<?php echo utf8_encode(get_woocommerce_currency_symbol())?>";
		  
		  if($('input.currency_symbol').length < 1){
			
			$('#footer').append("<input class='currency_symbol' type='hidden' value='"+symbol+"' />");	
			
		  }
		  
		  symbol = $('input.currency_symbol').val();
		  
		  $.post(woocommerce_params.ajax_url,data,function(n){
			
			t.removeClass("loading");
			
			t.addClass("added");
			
			$.each(n.fragments,function(k,v){
			  
			  res = v;                        
			  
			});
			
			if($("#footer .top_cart_elem").length>0){				
			  
			  $("#footer .top_cart_elem").html(res);					
			  
			}
			
			else{
			  
			  $("#footer").prepend("<div class='top_cart_elem' style='visibility:hidden;'></div>");
			  
			  $("#footer .top_cart_elem").html(res);
			  
			}			
			
			var telem = $('.top_cart_elem');
			
			var cart_list = [];
			
			var totallen = telem.find('ul.cart_list.product_list_widget li').length;
			
			var total = $.trim(telem.find('p.total span.amount').text());
			
			var qty = 0;
			
			for(var i = 0; i < totallen; i++){
			  
			  cart_list[i] = [];
			  
			  var li = telem.find('ul.cart_list.product_list_widget li').eq(i);
			  
			  cart_list[i].href = li.find('a').attr('href');
			  
			  cart_list[i].img = li.find('a img').attr('src');
			  
			  cart_list[i].title = $.trim(li.find('a').text());
			  
			  cart_list[i].quantity = li.find('span.quantity').text();
			  
			  qty = cart_list[i].quantity.split(symbol);
			  
			  cart_list[i].quantity = parseInt($.trim(qty[0]),10);
			  
			  cart_list[i].price = symbol+qty[1]; 
			  
			}
			
			var thtml = '';
			
			var totalq = 0;
			
			$.each(cart_list,function(key,value){
			  
			  thtml += "<tr>";
			  
			  thtml += "<td class='image'><a href='"+value.href+"'><img src='"+value.img+"' class='attachment-shop_thumbnail wp-post-image' width='90' height='90'></a></td>";
			  
			  thtml += "<td class='name'><a href='"+value.href+"'>"+value.title+"</a></td>";
			  
			  thtml += "<td class='quantity buttons_added'>x&nbsp;"+value.quantity+"</td>";
			  
			  thtml += "<td class='total'><span class='amount'>"+value.price+"</span></td>";
			  
			  thtml += "</tr>";
			  
			  totalq += value.quantity;
			  
			});
			
			thtml = '<div class="mini-cart-info"><table>'+thtml+'</table></div>';
			
			thtml += '<div class="mini-cart-total"><table><tr><td align="right"><b>Sub-Total:</b></td><td align="right"><span class="amount">'+total+'</span></td></tr><tr><td align="right"><b>Total:</b></td><td align="right"><span class="amount">'+total+'</span></td></tr></table></div>';
			
			thtml += '<div class="checkout"><a class="button" href="<?php echo $woocommerce->cart->get_cart_url();?>"><?php _e('View Cart','sellya')?></a>&nbsp;&nbsp;<a class="button checkout" href="<?php echo $woocommerce->cart->get_checkout_url()?>"><?php _e('Checkout','sellya')?></a></div>';
			
			var itemtext = totalq>1?"<?php _e('items','sellya')?>":"<?php _e('item','sellya')?>";
			
			$("#header #cart .heading span#cart-total").html(totalq+' '+itemtext+' - <span class="amount">'+total+'</span>');
			
			$("#header #cart .content").html(thtml);
			
//			setTimeout(function(){
//			  
//			  $('.add_to_cart_button').removeClass('added');                
//			  
//			},2000);
			
			$("#footer .top_cart_elem").html('');
			
		  });
		  
		  return false;
		  
		});
	  
	});

    </script>

<?php endif; //if(isset($woocommerce))

}

add_action('wp_footer','top_cart_script',20);

function footer_google_analytics_code(){

	global $smof_data;

	if(empty($smof_data['sellya_google_analytics'])) return;

	echo $smof_data['sellya_google_analytics'];

}



add_action('wp_footer','footer_google_analytics_code',100);


function get_prev_next_product_object($postid, $dir = 'next'){

	global $wpdb;

	if($dir == 'prev')

		$sql = "SELECT * FROM $wpdb->posts where post_type = 'product' and post_status = 'publish' and ID < $postid order by ID desc limit 0,1";

	else

		$sql = "SELECT * FROM $wpdb->posts where post_type = 'product' and post_status = 'publish' and ID > $postid order by ID asc limit 0,1";

	$result = $wpdb->get_row($sql);

	if(!is_wp_error($result)):

		if(!empty($result)):

			return $result;

		else:

			return false;

		endif;

	else:

		return false;

	endif;

}

function wcm_sds_single_product_prev_next(){

	global $woocommerce,$post;

	if(!isset($woocommerce) or !is_single()) return;

	?>

    <div id="prev-next">

    	<div id="sds_product_quicknavContainer">    

            <div class="sds_product_quicknav-nav">

            	<?php 

				$prev = get_prev_next_product_object($post->ID, 'prev');

				if(!empty($prev)):			

					$prevproduct = get_product($prev->ID);

					$attachments = $prevproduct->get_gallery_attachment_ids();

					$image = "";

					if(!empty($attachments[0])) $image = wp_get_attachment_image_src($attachments[0],array(48,48));

					if(isset($image[0])):

						$image = $image[0];

					elseif(has_post_thumbnail($prev->ID)):

						$attach_id = get_post_thumbnail_id($prev->ID);

						$image = wp_get_attachment_image_src($attach_id,array(48,48));

						$image = $image[0];
						
					endif;

				?>

					<div class="item left">

						<a title="<?php echo $prev->post_title?>" href="<?php echo get_permalink($prev->ID)?>" class="tiptip"><span><?php _e('&laquo; Previous','sellya')?></span></a>

						<div class="quick_img prev_image">

							<img width="48" height="48" src="<?php echo $image?>" alt="<?php echo $prev->post_title?>" title="<?php echo $prev->post_title?>">

						</div>

					</div><!--.left -->

                <?php

				endif;

				$next = get_prev_next_product_object($post->ID);

				if(!empty($next)):

					$nextproduct = get_product($next->ID);

					$image = "";

					$attachments = $nextproduct->get_gallery_attachment_ids();				
				
					if(!empty($attachments[0])) $image = wp_get_attachment_image_src($attachments[0],array(48,48));

					if(isset($image[0])): 
					
						$image = $image[0];
						
					elseif(has_post_thumbnail($next->ID)):

						$attach_id = get_post_thumbnail_id($next->ID);
		
						$image = wp_get_attachment_image_src($attach_id,array(48,48));

						$image = $image[0];

					endif;

				?>

					<div class="item right">
						<a title="<?php echo $next->post_title?>" href="<?php echo get_permalink($next->ID)?>" class="tiptip"><span><?php _e('Next &raquo;','sellya')?></span></a>

						<div class="quick_img next_image">

							<img width="48" height="48" src="<?php echo $image?>" alt="<?php echo $next->post_title?>" title="<?php echo $next->post_title?>">

						</div>

                                        </div><!--.right -->

               <?php

			   endif;

			   ?>

                    </div><!--.sds_product_quicknav-nav -->

		</div><!--#sds_product_quicknavContainer -->

	</div><!--#prev-next -->

   <script type="text/javascript">

	jQuery(function($){
		"use strict";
		$(".tiptip").hover(function() {
		
			$(this).next(".quick_img").show() ;
		
		}, function() {
		
			$(this).next(".quick_img").hide();
		
		});
	  
	});

 	</script>
 
    <?php

}

add_action('woocommerce_before_main_content','wcm_sds_single_product_prev_next',20);


function remove_sorting_action_from_brands_list(){

	$tax = get_query_var('taxonomy');

	$tax = $tax == 'brands' ? $tax : false;

	if($tax) remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

}

add_action('template_redirect','remove_sorting_action_from_brands_list');

function get_brands_carousel(){

	global $woocommerce, $smof_data;

	
        
	if(!isset($woocommerce) or $smof_data['sellya_show_brands'] != 1) return;

	$taxonomy = 'brands';

	$args = array('hide_empty'=>false);

	$terms = get_terms($taxonomy, $args);

	if(!empty($terms)):

	?>

	<section id="homepage-brands-wall" class="span">

            
            
	<?php 
        
        if($smof_data['sellya_brands_wall_status'] != 1):

		$pref = '<div class="es-carousel-banners-wrapper"><div id="carouselbanners" class="es-carousel-banners"><ul>';

		$suff =	'</ul></div></div>';

	 else:

	   	$pref = '';

		$suff = '';

	 endif;

	 echo $pref;

        foreach($terms as $c=>$term):

			$attach_id = wcm_sds_brands_thumbnail_id($term->term_id);

			if($attach_id):

				$image = wp_get_attachment_image_src($attach_id, 'full');

				$image = $image[0];

		?>

        	<?php if($smof_data['sellya_brands_wall_status'] != 1):?>

        		<li><a href="<?php echo get_term_link( $term->slug, $taxonomy )?>"><img src="<?php echo $image?>"  alt="<?php echo $term->name?>" title="<?php echo $term->name?>" width="133" /></a></li>        

            <?php else:

					$bpr = $smof_data['sellya_brands_per_row'];

					$class = $bpr == 4? "span3" : "span2";

					$class .= (($c % $bpr) == 0) ? " span-first-child":"";

			?>

            		<div class="<?php echo $class?> brand-wall-item">

                            <div class="image">

                                <a href="<?php echo get_term_link( $term->slug, $taxonomy )?>">

                                <img title="<?php echo $term->name?>" alt="<?php echo $term->name?>" src="<?php echo $image?>">

                                </a>

                            </div><!--.image -->

            		</div>

            <?php endif;
                endif;
            endforeach;

		?>  
       	<?php echo $suff;?>
	

    </section>

    <?php

    endif;

}

if(!function_exists('get_sellya_blog_short_text')){


function get_sellya_blog_short_text($content){
		
	$cont = preg_split('/<span id="more-([0-9]+)"><\/span>/',$content);
	
	$cont[0] = preg_replace('/\[[^\]]*\]/','',$cont[0]);
	
	$cont[0] = str_replace('(more...)','',$cont[0]);
	
	return "<p>". strip_tags($cont[0])."</p>";
			
}
}


//add_action('wp_head',create_function('','echo \'<link rel="icon" href="http://localhost/sellya_wp_3_8_1/wp-content/themes/sellya/image/success.png" type="image/png" />\'."\n";'),1);


//add_filter( 'add_to_cart_text', 'woo_custom_cart_button_text' );
//    function woo_custom_cart_button_text() {
//    return __( 'Buy it', 'woocommerce' );
//}


add_action('init','sellya_theme_init');

function sellya_theme_init(){
    add_filter('wp_get_attachment_image_attributes','sellya_alter_wp_get_attachment_image_attributes');
}

function sellya_alter_wp_get_attachment_image_attributes($attr)
{
    if(isset($attr['sizes'])){
        unset($attr['sizes']);
    }
    if(isset($attr['srcset'])){
        unset($attr['srcset']);
    }
    return $attr;
}