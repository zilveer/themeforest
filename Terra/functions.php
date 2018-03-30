<?php
///////////////////////////////////////////
//--------- OT THEME OPTIONS ---------------//
///////////////////////////////////////////

// Optional OT params
add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_show_new_layout', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
include_once( 'option-tree/ot-loader.php' );

// BOC Theme Options
include_once( 'includes/theme-options.php' );

///////////////////////////////////////////
//--------- OT THEME OPTIONS :: END --------//
///////////////////////////////////////////


// Terra Customizer Theme Options
include_once( 'includes/customizer_theme-options.php' );
include_once( 'includes/meta_boxes.php' );

// Default RSS feed links
add_theme_support('automatic-feed-links');

// Sets up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 940;

// Post Formats
add_theme_support( 'post-formats',  array( 'gallery','video' ));
add_post_type_support( 'post', 'post-formats' );
add_post_type_support( 'portfolio', 'post-formats' );


// Enable Background Support
$args = array(
    'default-color' => 'f6f6f6',
    'default-image' => get_template_directory_uri() . '/images/main_bgr.png',
);
add_theme_support( 'custom-background', $args );

// Terra Customizer Theme Options
add_action( 'customize_register', 'aqua_customize_register' );

// Add customize Menu Item
add_action ('admin_menu', 'customizetheme_admin');
function customizetheme_admin() {
    add_theme_page( 'Customize', 'Customize', 'edit_theme_options', 'customize.php' ); 
}


// Enqueue Styles
function boc_style() {
    
	wp_enqueue_style( 'boc-style', get_bloginfo( 'stylesheet_url' ) );
	$protocol = is_ssl() ? 'https' : 'http';
    wp_enqueue_style( 'boc-fonts', "$protocol://fonts.googleapis.com/css?family=Lato:400,700,900|Open+Sans:300italic,400italic,600italic,400,300,600,900|PT+Serif:400,400italic" );

  	$fonts_already_loaded = array("Lato","Open+Sans", "PT+Serif");
	$fonts_to_load = array();

	// Load Nav Font 
	if(!in_array(($nav_font = ot_get_option('nav_font_family')), $fonts_already_loaded)) {
		if($nav_font){
			$fonts_to_load[] = $nav_font;
		}
	}
	// Load Headings Font 
	if(!in_array(($heading_font = ot_get_option('heading_font_family')), $fonts_already_loaded)) {
		if($heading_font){	
			$fonts_to_load[] = $heading_font;
		}
	}
	// Load Buttons Font 
	if(!in_array(($button_font = ot_get_option('button_font_family')), $fonts_already_loaded)) {
		if($button_font){		
			$fonts_to_load[] = $button_font;
		}
	}

	// Loading additional fonts
	foreach($fonts_to_load as $font){
		
		if(!in_array($font, $fonts_already_loaded)){
			$protocol = is_ssl() ? 'https' : 'http';
	    	wp_enqueue_style('boc-custom-font-'.$font, "$protocol://fonts.googleapis.com/css?family=$font",array('boc-fonts'));		
		}	
	}  	
  	
  	
	$inline_css = '';
	
	// Nav font family
	if($nav_font!="Open+Sans"){
		$inline_css .="
			#menu {
				font-family: '".str_replace('+',' ',$nav_font)."';
			}\n";		
	}
	// Nav font size
	if(($nav_font_size=ot_get_option('nav_font_size'))!="16px"){
		$inline_css .="
			#menu > ul > li > a {
				font-size: ".$nav_font_size.";
			}
			#menu > ul > li ul > li > a {
				font-size: ".((int)(substr($nav_font_size,0,2)) - 2).'px'.";
			}\n";
	}
	
	// Custom Menu BGR color
	if( (($nav_bgr_color=get_theme_mod('nav_bgr_color'))!="#9DD91F") && ((get_theme_mod('main_menu_style') == 'custom_menu')||(get_theme_mod('main_menu_style') == 'custom_menu2')||(get_theme_mod('main_menu_style') == 'custom_menu3')||(get_theme_mod('main_menu_style') == 'custom_menu4')||(get_theme_mod('main_menu_style') == 'custom_menu5'))){
		$inline_css .="
		
			.custom_menu #menu > ul > li ul > li > a:hover { background-color: ".$nav_bgr_color.";}

        	.custom_menu2 #menu > ul > li > div { border-top: 2px solid ".$nav_bgr_color.";}
        	.custom_menu2 .nav_arrow:after  { border-bottom-color: ".$nav_bgr_color.";}
        	
        	.custom_menu3 #menu > ul > li > div { border-top: 2px solid ".$nav_bgr_color.";}
        	.custom_menu3 .nav_arrow:after { border-bottom-color: ".$nav_bgr_color.";}
        		
        	.custom_menu4 #menu > ul > li > div { border-top: 2px solid ".$nav_bgr_color.";}
        	.custom_menu4 #menu > ul > li ul > li > a:hover { background-color: ".$nav_bgr_color.";}
        	.custom_menu4 .nav_arrow:after { border-bottom-color: ".$nav_bgr_color.";}

        	.custom_menu5 #menu > ul > li ul > li > a:hover { background-color: ".$nav_bgr_color.";}
        ";
	}
	
	
	// Main Color
	$aqua_main_color=get_theme_mod('aqua_main_color');
	if(($aqua_main_color)&&($aqua_main_color!="#9DD91F")){
		$inline_css .='	
			#wrapper { border-top: 3px solid '.HexToRGB($aqua_main_color,40).'; }
	    	a:hover, a:focus { color:'.$aqua_main_color.'; }
	    	.button:hover,a:hover.button,button:hover,input[type="submit"]:hover,input[type="reset"]:hover,	input[type="button"]:hover, .button_hilite, a.button_hilite { color: #fff; background-color:'.$aqua_main_color.';}
	    	input.button_hilite, a.button_hilite, .button_hilite { color: #fff; background-color:'.$aqua_main_color.';}
	    	.button_hilite:hover, input.button_hilite:hover, a:hover.button_hilite { color: #fff; background-color: #444444;}
	    			
	    	.section_big_title h1 strong { color:'.$aqua_main_color.';}
	    	a:hover .pic_info.type2 .info_overlay { border-bottom: 1px solid '.$aqua_main_color.';}
	    	.section_featured_texts h3 a:hover { color:'.$aqua_main_color.';}

	    	.htabs a.selected  { border-top: 1px solid '.$aqua_main_color.';}


	    				    			
	    	.breadcrumb a:hover{ color: '.$aqua_main_color.';}

	    	.tagcloud a:hover { background-color: '.$aqua_main_color.';}
	    	.month { background-color: '.$aqua_main_color.';}
	    	.small_month  { background-color: '.$aqua_main_color.';}


	    		    
	    	.post_meta a:hover{ color: '.$aqua_main_color.';}

	    	#portfolio_filter ul li div:hover{ background-color: '.$aqua_main_color.';}
	    	.counter-digit { color: '.$aqua_main_color.';}	    		    
	    		    
	    		   
	    	.next:hover,.prev:hover{ background-color: '.$aqua_main_color.';}
	    	.pagination .links a:hover{ background-color: '.$aqua_main_color.';}
	    	.hilite{ background: '.HexToRGB($aqua_main_color,30).';}
			.price_column.price_column_featured ul li.price_column_title{ background: '.$aqua_main_color.';}

	    	blockquote{ border-left: 4px solid '.$aqua_main_color.'; }
		    		   
	    	.info  h2{ background-color: '.$aqua_main_color.';}
	    	#footer a:hover { color: '.$aqua_main_color.';}
	    	#footer .latest_post_sidebar img:hover { border: 3px solid '.$aqua_main_color.';}
	    	#footer.footer_light .latest_post_sidebar img:hover { border: 1px solid '.$aqua_main_color.'; background: '.$aqua_main_color.';}
		';
		
	}	
	
	

	// Headings font family
	if($heading_font!="Open+Sans"){
		$inline_css .="
		h1, h2, h3, h4, h5, .title, .section_big_title h1, .heading, #footer h3, .info_overlay h3 {
			font-family: '".str_replace('+',' ',$heading_font)."';
		}\n";		
	}	
	// Button font family
	if($button_font!="Open+Sans"){
		$inline_css .="
		.button, a.button, button, input[type='submit'], input[type='reset'], input[type='button'] {
			font-family: '".str_replace('+',' ',$button_font)."';
		}\n";		
	}	
	// Body font family
	$body_font = ot_get_option('body_font_family');
	if($body_font!="Open+Sans"){
		$inline_css .="
		body {
			font-family: '".str_replace('+',' ',$body_font)."';
		}\n";		
	}	

	// Breadcrumbs
	if(!$boc_breadcrumb = ot_get_option('breadcrumbs')){
		$inline_css .="
		.breadcrumb {
			display: none;
		}\n";
	}

	// Custom CSS
	if($boc_custom_css = ot_get_option('custom_css')){
		$inline_css .="\n\n".$boc_custom_css."\n";
	}		

    wp_add_inline_style( 'boc-style', $inline_css );
}

add_action( 'wp_enqueue_scripts', 'boc_style' );







// Enqueue Scripts
function boc_scripts() {
	 wp_enqueue_script('jquery');
	 wp_enqueue_script('jquery.easing', get_template_directory_uri().'/js/libs.js');
	 wp_enqueue_script('terra.common', get_template_directory_uri().'/js/common.js');
	 
	 echo '<!--[if lt IE 9]>';
     echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
     echo '<![endif]-->';
}

add_action( 'wp_enqueue_scripts', 'boc_scripts' );	 
	 
	 

	 
// Register Navigation
add_theme_support('menus');
register_nav_menu('main_navigation', 'Main Navigation');


// Custom functions + Widgets
require_once( 'includes/boc_custom.php' );
require_once( 'includes/boc_widgets.php' );

add_action('widgets_init', 'boc_load_widgets');


// Make theme available for translation
load_theme_textdomain( 'Terra', get_template_directory() . '/languages' );

// Let WP manage title - it's removed from header.php
add_theme_support( 'title-tag' );


/*--------------------------------------*/
/*    Clean up Shortcodes
/*--------------------------------------*/
function wpex_clean_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'wpex_clean_shortcodes');



// Images

add_theme_support('post-thumbnails');

set_post_thumbnail_size(640, 300, true); //size of thumbs
add_image_size('small-thumb', 60, 60, true);
add_image_size('portfolio-medium', 460, 290, true);
add_image_size('portfolio-full', 940, 600, true);


add_action('init', 'boc_register_widgets');
function boc_register_widgets(){


	// Register widgetized locations
	if(function_exists('register_sidebar')) {
		
		// Register Dynamic Widgets (OT)
		if (ot_get_option('boc_sidebars')){
			$dynamic_sidebars = ot_get_option('boc_sidebars');
			foreach ($dynamic_sidebars as $dynamic_sidebar) {
				register_sidebar(array(
					'name' => $dynamic_sidebar["title"],
					'id' => $dynamic_sidebar["id"],
					'before_widget' => '<div id="%1$s" class="widget %2$s">',
					'after_widget' => '</div>',
					'before_title' => '<h4 class="left_title"><span>',
					'after_title' => '</span></h4>',
					));
			}
		}

		register_sidebar(array(
			'name' => 'Terra Sidebar',
			'id'   => 'terra_sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="left_title"><span>',
			'after_title' => '</span></h4>',
		));

		register_sidebar(array(
			'name' => 'Footer Widget 1',
			'id'   => 'terra_footer_widget1',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'name' => 'Footer Widget 2',
			'id'   => 'terra_footer_widget2',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'name' => 'Footer Widget 3',
			'id'   => 'terra_footer_widget3',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));

		register_sidebar(array(
			'name' => 'Footer Widget 4',
			'id'   => 'terra_footer_widget4',
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));
		
		register_sidebar(array(
			'name' => 'Terra Contact Sidebar',
			'id'   => 'terra_contact_widget',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="left_title"><span>',
			'after_title' => '</span></h4>',
		));		
		
	}
}


// Register custom post types
add_action('init', 'boc_custom_types');
function boc_custom_types() {
	register_post_type(
		'portfolio',
		array(
			'labels' => array(
				'name' => 'Portfolio',
				'singular_name' => 'Portfolio'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio_item'),
			'supports' => array('title', 'editor', 'thumbnail'),
			'can_export' => true,
			'show_in_nav_menus' => true,
		)
	);

	register_taxonomy('portfolio_category', 'portfolio', array('hierarchical' => true, 'label' => 'Portfolio Categories', 'query_var' => true, 'rewrite' => true));
}

/*
function my_rewrite_flush() {
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'my_rewrite_flush' );
*/

/**
 * add a default-gravatar to options
 */
if ( !function_exists('fb_addgravatar') ) {
	function fb_addgravatar( $avatar_defaults ) {
		$myavatar = get_template_directory_uri() . '/images/comment_avatar.png';
		$avatar_defaults[$myavatar] = 'people';
		return $avatar_defaults;
	}
	add_filter( 'avatar_defaults', 'fb_addgravatar' );
}


// BOC Shortcodes
include_once( 'includes/shortcodes.php' );
add_action('init', 'boc_add_buttons');

// Use shortcodes in Widgets
add_filter('widget_text', 'do_shortcode');


// Customize Tag Cloud
function my_tag_cloud_args($in){
    return 'smallest=13&largest=13&number=25&orderby=name&unit=px';
}
add_filter( 'widget_tag_cloud_args', 'my_tag_cloud_args');


// Customize Items per page for Portfolio Taxonomy
$option_posts_per_page = get_option( 'posts_per_page' );
add_action( 'init', 'my_modify_posts_per_page', 0);
function my_modify_posts_per_page() {
    add_filter( 'option_posts_per_page', 'my_option_posts_per_page' );
}
function my_option_posts_per_page( $value ) {
    global $option_posts_per_page;
    if ( is_tax( 'portfolio_category') ) {
        return (ot_get_option('portfolio_items_per_page',9) ? ot_get_option('portfolio_items_per_page',9) : 9);
    } else {
        return $option_posts_per_page;
    }
}
