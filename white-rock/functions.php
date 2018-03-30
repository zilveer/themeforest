<?php
/**
 * progression functions and definitions
 *
 * @package progression
 * @since progression 1.0
 */


// Post Thumbnails
add_theme_support('post-thumbnails');
add_image_size('progression-slider-retina', 2000, 925, true);
add_image_size('progression-slider', 1500, 694, true);
add_image_size('progression-page-title', 1600, 300, true);
add_image_size('progression-blog', 1140, 435, true);
add_image_size('progression-portfolio-thumb', 600, 338, true); //600 wide by 1200 tall Image cropped
add_image_size('progression-single-portfolio', 1140, 550, true);
add_image_size('progression-single-portfolio-uncropped', 1140, 1000, false);
add_image_size('progression-menu-tall', 300, 375, true);


/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since progression 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */


/* 
 * Loads the Options Panel
 *
 * If you're loading from a child theme use stylesheet_directory
 * instead of template_directory
 */
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/' );
	require_once dirname( __FILE__ ) . '/inc/options-framework.php';
}


if ( ! function_exists( 'progression_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since progression 1.0
 */
function progression_setup() {
	
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	/**
	 * Custom template tags for this theme.  Blog Comments Found Here
	 */
	require( get_template_directory() . '/inc/template-tags.php' );


	/**
	 * Registering Custom Meta Boxes 
	 * https://github.com/tammyhart/Reusable-Custom-WordPress-Meta-Boxes
	 * Include the file that creates the class and a file that instantiates the class
	 */
	require( get_template_directory() . '/metaboxes/meta_box.php' );
	require( get_template_directory() . '/inc/custom_meta_boxes.php' );
	
	
	// Include widgets
	require( get_template_directory() . '/widgets/widgets.php' );
	
	// Shortcodes
	include_once('shortcodes.php');
	

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on progression, use a find and replace
	 * to change 'progression' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'progression', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	
	
	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'gallery' ) );
	add_post_type_support( 'portfolio', 'post-formats' );
	add_post_type_support( 'menu', 'post-formats' );


	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'progression' ),
		'footer' => __( 'Footer Menu', 'progression' ),
	) );
	


}
endif; // progression_setup
add_action( 'after_setup_theme', 'progression_setup' );



if( class_exists( 'kdMultipleFeaturedImages' ) ) {

	$args1 = array(
	            'id' => 'featured-image-2',
	            'post_type' => 'page',      // Set this to post or page
	            'labels' => array(
	                'name'      => 'Featured image 2',
	                'set'       => 'Set featured image 2',
	                'remove'    => 'Remove featured image 2',
	                'use'       => 'Use as featured image 2',
	            )
	    );

	    $args2 = array(
	            'id' => 'featured-image-3',
	            'post_type' => 'page',      // Set this to post or page
	            'labels' => array(
	                'name'      => 'Featured image 3',
	                'set'       => 'Set featured image 3',
	                'remove'    => 'Remove featured image 3',
	                'use'       => 'Use as featured image 3',
	            )
	    );
	

	    new kdMultipleFeaturedImages( $args1 );
	    new kdMultipleFeaturedImages( $args2 );
}



/**
 * Registering Portfolio Custom Post Type
 */
add_action('init', 'pyre_init');
function pyre_init() {
	register_post_type(
		'portfolio',
		array(
			'labels' => array(
				'name' => 'Portfolio',
				'singular_name' => 'Portfolio'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'portfolio-type'),
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail','comments'),
			'can_export' => true,
		)
	);
	
	register_post_type(
		'menu',
		array(
			'labels' => array(
				'name' => 'Menu',
				'singular_name' => 'Menu Item'
			),
			'public' => true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'menu-type'),
			'supports' => array('title', 'editor', 'excerpt', 'thumbnail','comments'),
			'can_export' => true,
		)
	);

	register_taxonomy('portfolio_type', 'portfolio', array('hierarchical' => true, 'label' => 'Portfolio Categories', 'query_var' => true, 'rewrite' => true));
	
	register_taxonomy('menu_type', 'menu', array('hierarchical' => true, 'label' => 'Menu Categories', 'query_var' => true, 'rewrite' => true));
	
}





/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since progression 1.0
 */
function progression_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Sidebar', 'progression' ),
		'id' => 'sidebar-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div><div class="sidebar-spacer"></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Widgets', 'progression' ),
		'id' => 'footer-widgets',
		'before_widget' => '<div id="%1$s" class="widget homepage-widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="header-underline">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Menu Widgets Column 1', 'progression' ),
		'id' => 'menu-widgets-col-1',
		'before_widget' => '<div id="%1$s" class="widget menu-widget %2$s">',
		'after_widget' => '</div><div class="menu-spacer"></div>',
		'before_title' => '<h3 class="header-underline">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Menu Widgets Column 2', 'progression' ),
		'id' => 'menu-widgets-col-2',
		'before_widget' => '<div id="%1$s" class="widget menu-widget %2$s">',
		'after_widget' => '</div><div class="menu-spacer"></div>',
		'before_title' => '<h3 class="header-underline">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Breakfast Widgets Column 1', 'progression' ),
		'id' => 'breakfast-widgets-col-1',
		'before_widget' => '<div id="%1$s" class="widget menu-widget %2$s">',
		'after_widget' => '</div><div class="menu-spacer"></div>',
		'before_title' => '<h3 class="header-underline">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Breakfast Widgets Column 2', 'progression' ),
		'id' => 'breakfast-widgets-col-2',
		'before_widget' => '<div id="%1$s" class="widget menu-widget %2$s">',
		'after_widget' => '</div><div class="menu-spacer"></div>',
		'before_title' => '<h3 class="header-underline">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Lunch Widgets Column 1', 'progression' ),
		'id' => 'lunch-widgets-col-1',
		'before_widget' => '<div id="%1$s" class="widget menu-widget %2$s">',
		'after_widget' => '</div><div class="menu-spacer"></div>',
		'before_title' => '<h3 class="header-underline">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Lunch Widgets Column 2', 'progression' ),
		'id' => 'lunch-widgets-col-2',
		'before_widget' => '<div id="%1$s" class="widget menu-widget %2$s">',
		'after_widget' => '</div><div class="menu-spacer"></div>',
		'before_title' => '<h3 class="header-underline">',
		'after_title' => '</h3>',
	) );
	
	
	register_sidebar( array(
		'name' => __( 'Dinner Widgets Column 1', 'progression' ),
		'id' => 'dinner-widgets-col-1',
		'before_widget' => '<div id="%1$s" class="widget menu-widget %2$s">',
		'after_widget' => '</div><div class="menu-spacer"></div>',
		'before_title' => '<h3 class="header-underline">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Dinner Widgets Column 2', 'progression' ),
		'id' => 'dinner-widgets-col-2',
		'before_widget' => '<div id="%1$s" class="widget menu-widget %2$s">',
		'after_widget' => '</div><div class="menu-spacer"></div>',
		'before_title' => '<h3 class="header-underline">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Dessert Widgets Column 1', 'progression' ),
		'id' => 'dessert-widgets-col-1',
		'before_widget' => '<div id="%1$s" class="widget menu-widget %2$s">',
		'after_widget' => '</div><div class="menu-spacer"></div>',
		'before_title' => '<h3 class="header-underline">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Dessert Widgets Column 2', 'progression' ),
		'id' => 'dessert-widgets-col-2',
		'before_widget' => '<div id="%1$s" class="widget menu-widget %2$s">',
		'after_widget' => '</div><div class="menu-spacer"></div>',
		'before_title' => '<h3 class="header-underline">',
		'after_title' => '</h3>',
	) );
	
}
add_action( 'widgets_init', 'progression_widgets_init' );


/* WooCommerce */
add_theme_support( 'woocommerce' );
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);



// Pagination
function kriesi_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><span class='arrows'>&laquo;</span></a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><span class='arrows'>&lsaquo;</span></a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<a href='#' class='selected'>".$i."</a>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'><span class='arrows'>&rsaquo;</span></a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'><span class='arrows'>&raquo;</span></a>";
         echo "</div>\n";
     }
}





// Pagination
function infinite_kriesi_pagination($pages = '', $range = 1)
{  
     $showitems = ($range);  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }

     }   

     if(1 != $pages)
     {
         echo "";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "";

         if($paged > 1 && $showitems < $pages) echo "";


         for ($i=1; $i <= $pages; $i++)
         {
	
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range+1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "":"<nav id='page-nav'><a href='".get_pagenum_link($i)."'>".__('Load More', 'progression')."</a></nav>";
             }
			
         }
        
         echo "\n";
     }

	
}





function progression_studios_plugin_google_maps_customizer( $wp_customize ) {
	$wp_customize->add_section( 'progression_studios_panel_google_Maps', array(
		'priority'    => 800,
       'title'       => esc_html__( 'Google Maps', 'invested-progression' ),
    ) );
	 
	$wp_customize->add_setting( 'progression_studios_google_maps_api' ,array(
		'default' =>  '',
		'sanitize_callback' => 'progression_studios_plugin_google_maps_sanitize_text',
	) );
	$wp_customize->add_control( 'progression_studios_google_maps_api', array(
		'label'          => 'Google Maps API Key',
		'description'    => 'See documentation under "Google Maps API Key" for directions. Get API key: https://developers.google.com/maps/documentation/javascript/get-api-key',
		'section' => 'progression_studios_panel_google_Maps',
		'type' => 'text',
		'priority'   => 10,
		)
	
	);
}
add_action( 'customize_register', 'progression_studios_plugin_google_maps_customizer' );
/* Sanitize Text */
function progression_studios_plugin_google_maps_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}





/**
 * Enqueue scripts and styles
 */
function progression_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css', array( 'style' ) );
	wp_enqueue_style( 'shortcodes', get_template_directory_uri() . '/css/shortcodes.css', array( 'style' ) );
	wp_enqueue_style( 'google-fonts', 'http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic', array( 'style' ) );

	wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/libs/modernizr-2.0.6.min.js', false, '20120206', false );
	wp_enqueue_script( 'plugins', get_template_directory_uri() . '/js/plugins.js', array( 'jquery' ), '20120206', false );
	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/script.js', array( 'jquery' ), '20120206', false );
	wp_enqueue_script( 'shortcodes', get_template_directory_uri() . '/js/progression-shortcodes-lib.js', array( 'jquery' ), '20120206', false );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'progression_scripts' );



function whiterock_customize_register($wp_customize)
{
	
	$wp_customize->add_section( 'whiterock_text_scheme' , array(
	    'title'      => __('Font Colors','progression'),
	    'priority'   => 35,
	) );
	
	$wp_customize->add_setting('body_text', array(
	    'default'     => '#5f6567'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'body_text', array(
		'label'        => __( 'Body Default Font Color', 'progression' ),
		'section'    => 'whiterock_text_scheme',
		'settings'   => 'body_text',
		'priority'   => 10,
	)));
	
	
	$wp_customize->add_setting('navigation_text', array(
	    'default'     => '#000000'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_text', array(
		'label'        => __( 'Navigation Font Color', 'progression' ),
		'section'    => 'whiterock_text_scheme',
		'settings'   => 'navigation_text',
		'priority'   => 20,
	)));
	
	$wp_customize->add_setting('navigation_text_hover', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'navigation_text_hover', array(
		'label'        => __( 'Navigation Hover/Selected Font Color', 'progression' ),
		'section'    => 'whiterock_text_scheme',
		'settings'   => 'navigation_text_hover',
		'priority'   => 25,
	)));
	
	
	$wp_customize->add_setting('page_title_text', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_title_text', array(
		'label'        => __( 'Page Title Font Color', 'progression' ),
		'section'    => 'whiterock_text_scheme',
		'settings'   => 'page_title_text',
		'priority'   => 30,
	)));
	
	
	$wp_customize->add_setting('link_color', array(
	    'default'     => '#5f757e'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_color', array(
		'label'        => __( 'Default Link Font Color', 'progression' ),
		'section'    => 'whiterock_text_scheme',
		'settings'   => 'link_color',
		'priority'   => 40,
	)));
	
	
	$wp_customize->add_setting('link_hover_color', array(
	    'default'     => '#88a5b1'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'link_hover_color', array(
		'label'        => __( 'Default Link Hover Color', 'progression' ),
		'section'    => 'whiterock_text_scheme',
		'settings'   => 'link_hover_color',
		'priority'   => 50,
	)));
	
	
	
	$wp_customize->add_setting('headings_default_color', array(
	    'default'     => '#7b7562'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'headings_default_color', array(
		'label'        => __( 'Headings Font Color', 'progression' ),
		'section'    => 'whiterock_text_scheme',
		'settings'   => 'headings_default_color',
		'priority'   => 60,
	)));
	

	
	

	$wp_customize->add_setting('footer_link_color', array(
	    'default'     => '#aca693'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_link_color', array(
		'label'        => __( 'Footer Link Color', 'progression' ),
		'section'    => 'whiterock_text_scheme',
		'settings'   => 'footer_link_color',
		'priority'   => 90,
	)));
	
	

	
	
	$wp_customize->add_setting('button_text_color', array(
	    'default'     => '#88a5b1'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_text_color', array(
		'label'        => __( 'Button Text Link Color', 'progression' ),
		'section'    => 'whiterock_text_scheme',
		'settings'   => 'button_text_color',
		'priority'   => 75,
	)));
	
	
	$wp_customize->add_setting('button_text_color_hover', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_text_color_hover', array(
		'label'        => __( 'Button Text Hover Link Color', 'progression' ),
		'section'    => 'whiterock_text_scheme',
		'settings'   => 'button_text_color_hover',
		'priority'   => 80,
	)));
	
	
	$wp_customize->add_section( 'whiterock_color_scheme' , array(
	    'title'      => __('Background Colors','progression'),
	    'priority'   => 30,
	) );
	
	$wp_customize->add_setting('header_bg', array(
	    'default'     => '#6c858a'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'header_bg', array(
		'label'        => __( 'Navigation Background Color', 'progression' ),
		'section'    => 'whiterock_color_scheme',
		'settings'   => 'header_bg',
		'priority'   => 1,
	)));
	
	
	$wp_customize->add_setting('page_title_line_background', array(
	    'default'     => '#88a5b1'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_title_line_background', array(
		'label'        => __( 'Header Divider Background Highlight', 'progression' ),
		'section'    => 'whiterock_color_scheme',
		'settings'   => 'page_title_line_background',
		'priority'   => 5,
	)));
	
	
	
	$wp_customize->add_setting('page_title_background', array(
	    'default'     => '#576e78'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'page_title_background', array(
		'label'        => __( 'Page Title Background Highlight', 'progression' ),
		'section'    => 'whiterock_color_scheme',
		'settings'   => 'page_title_background',
		'priority'   => 10,
	)));
	

	$wp_customize->add_setting('content_bg', array(
	    'default'     => '#f2f1ed'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'content_bg', array(
		'label'        => __( 'Body FallBack Background Color', 'progression' ),
		'section'    => 'whiterock_color_scheme',
		'settings'   => 'content_bg',
		'priority'   => 30,
	)));
	
	
	
	$wp_customize->add_setting('footer_bg', array(
	    'default'     => '#bdb7a4'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_bg', array(
		'label'        => __( 'Footer Base Background Highlight', 'progression' ),
		'section'    => 'whiterock_color_scheme',
		'settings'   => 'footer_bg',
		'priority'   => 50,
	)));
	
	
	$wp_customize->add_setting('footer_top_bg', array(
	    'default'     => '#e3e0d9'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'footer_top_bg', array(
		'label'        => __( 'Footer Widget Area Background Color', 'progression' ),
		'section'    => 'whiterock_color_scheme',
		'settings'   => 'footer_top_bg',
		'priority'   => 40,
	)));
	
	
	$wp_customize->add_setting('button_bg', array(
	    'default'     => '#ffffff'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_bg', array(
		'label'        => __( 'Button Background Color', 'progression' ),
		'section'    => 'whiterock_color_scheme',
		'settings'   => 'button_bg',
		'priority'   => 60,
	)));
	
	
	
	$wp_customize->add_setting('button_hover_bg', array(
	    'default'     => '#aacedd'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'button_hover_bg', array(
		'label'        => __( 'Button Hover Background Color', 'progression' ),
		'section'    => 'whiterock_color_scheme',
		'settings'   => 'button_hover_bg',
		'priority'   => 70,
	)));
	
	
	$wp_customize->add_setting('hightlight_bg', array(
	    'default'     => '#88a5b1'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'hightlight_bg', array(
		'label'        => __( 'Container Border Bottom Highlight', 'progression' ),
		'section'    => 'whiterock_color_scheme',
		'settings'   => 'hightlight_bg',
		'priority'   => 80,
	)));
	
	
	$wp_customize->add_setting('secondary_hightlight_bg', array(
	    'default'     => '#bdb7a4'
	));
	
	
	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'secondary_hightlight_bg', array(
		'label'        => __( 'Header Underline and Sidebar Border Color', 'progression' ),
		'section'    => 'whiterock_color_scheme',
		'settings'   => 'secondary_hightlight_bg',
		'priority'   => 80,
	)));
	
}
add_action('customize_register', 'whiterock_customize_register');


function whiterock_customize_css()
{
    ?>
 
<style type="text/css">
.sf-menu ul, .sf-menu li.current-menu-item, .sf-menu a:hover, .sf-menu li a:hover, .sf-menu a:hover, .sf-menu a:visited:hover, .sf-menu li.sfHover a, .sf-menu li.sfHover a:visited {background-color:<?php echo get_theme_mod('header_bg', '#6c858a'); ?>;  }
#header-top-bar, #page-title-divider { background:<?php echo get_theme_mod('page_title_line_background', '#88a5b1'); ?>; }
#page-title h1 {border-bottom:8px solid <?php echo get_theme_mod('page_title_background', '#576e78'); ?>; }
.widget-area-highlight  {background:<?php echo get_theme_mod('footer_top_bg', '#e3e0d9'); ?>; }
#copyright { border-top-color:<?php echo get_theme_mod('footer_bg', '#bdb7a4'); ?>;  }
#tweets-sidebar {background:<?php echo get_theme_mod('content_bg', '#f2f1ed'); ?>;}
#tweets-sidebar:before {border-top: 10px solid <?php echo get_theme_mod('content_bg', '#f2f1ed'); ?>;}
body, footer, #main { background-color:<?php echo get_theme_mod('content_bg', '#f2f1ed'); ?>;}
#main img, #map-contact, .video-container, .video-post-image {border-bottom:5px solid <?php echo get_theme_mod('hightlight_bg', '#88a5b1'); ?>;}
.menu-item-container {border-bottom:4px solid <?php echo get_theme_mod('hightlight_bg', '#88a5b1'); ?>; }
body ul#open-hours li, body #main ul.menu-items li, .type-post {border-bottom:1px dotted <?php echo get_theme_mod('secondary_hightlight_bg', '#bdb7a4'); ?>; }
.header-underline {border-bottom:3px solid <?php echo get_theme_mod('secondary_hightlight_bg', '#bdb7a4'); ?>;}
#sidebar {border-left:1px dotted <?php echo get_theme_mod('secondary_hightlight_bg', '#bdb7a4'); ?>;}
body {color:<?php echo get_theme_mod('body_text', '#5f6567'); ?>;}
a {color:<?php echo get_theme_mod('link_color', '#5f757e'); ?>;}
a:hover, #copyright li a:hover {color:<?php echo get_theme_mod('link_hover_color', '#88a5b1'); ?>;}
h1, h2, h3, h4, h5, h6 {color:<?php echo get_theme_mod('headings_default_color', '#7b7562'); ?>;}
.sf-menu a, .sf-menu a:visited  {color: <?php echo get_theme_mod('navigation_text', '#000000'); ?>;}
.sf-menu li.current-menu-item a, .sf-menu li.current-menu-item a:visited, .sf-menu a:hover, .sf-menu li a:hover, .sf-menu a:hover, .sf-menu a:visited:hover, .sf-menu li.sfHover a, .sf-menu li.sfHover a:visited {color:<?php echo get_theme_mod('navigation_text_hover', '#ffffff'); ?>;}
#page-title h1 {color:<?php echo get_theme_mod('page_title_text', '#ffffff'); ?>;}
#copyright li a {color:<?php echo get_theme_mod('footer_link_color', '#aca693'); ?>;}
body #main a.button, body #main button.single_add_to_cart_button, body #main input.button, body.woocommerce-cart #main input.button.checkout-button, body #main button.button,
.wpcf7  input.wpcf7-submit, ul.filter-children li a, a.rock-button, input.button, .pagination a, .social-icons a, .rock-button, a .rock-button, #respond input#submit, body #main a.progression-grey {
	color:<?php echo get_theme_mod('button_text_color', '#88a5b1'); ?>; 
	background:<?php echo get_theme_mod('button_bg', '#ffffff'); ?>;
	border-bottom:2px solid <?php echo get_theme_mod('button_hover_bg', '#aacedd'); ?>;
}
.rock-button a {color:<?php echo get_theme_mod('button_text_color', '#88a5b1'); ?>; }
body #main a.button:hover, body #main button.single_add_to_cart_button:hover, body #main input.button:hover, body.woocommerce-cart #main input.button.checkout-button:hover, body #main button.button:hover,
.wpcf7  input.wpcf7-submit:hover, ul.filter-children li a:hover, ul.filter-children li.current_page_item a, #respond input#submit:hover, .rock-button:hover, a.rock-button:hover, .social-icons a:hover, input.button:hover, .pagination a:hover, .pagination a.selected, .social-icons a:hover, body #main a.progression-grey:hover 
{background:<?php echo get_theme_mod('button_hover_bg', '#aacedd'); ?>; 
color:<?php echo get_theme_mod('button_text_color_hover', '#ffffff'); ?>;
border-bottom:2px solid <?php echo get_theme_mod('button_hover_bg', '#aacedd'); ?>;
}
.rock-button:hover a {color:<?php echo get_theme_mod('button_text_color_hover', '#ffffff'); ?>;}
</style>
    <?php
}
add_action('wp_head', 'whiterock_customize_css');


