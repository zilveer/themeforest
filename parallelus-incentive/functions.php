<?php if ( __FILE__ == $_SERVER['SCRIPT_FILENAME'] ) { die(); }


// Execute hooks before framework loads
do_action( 'functions_before' );


#-----------------------------------------------------------------
# Load framework
#-----------------------------------------------------------------
include_once TEMPLATEPATH . '/framework/load.php';



// Execute hooks after framework loads
do_action( 'functions_after' ); ?><?php if ( __FILE__ == $_SERVER['SCRIPT_FILENAME'] ) { die(); }

// Content width
if ( ! isset( $content_width ) ) $content_width = 783; 
// Template size variables
if ( ! isset( $max_content_width ) ) $max_content_width = 1200; // the largest possible width
if ( ! defined( 'MAX_COLUMNS' ) ) define( 'MAX_COLUMNS', 12); // number of columns in layout (UPDATE: Pull from Layout Manager)


#-----------------------------------------------------------------
# Theme Features
#-----------------------------------------------------------------

function theme_features_setup() {
	// Translation
	load_theme_textdomain( 'framework', get_template_directory() . '/languages' );
	
	// WP Stuff
	add_editor_style(); // Admin editor styles
	add_theme_support( 'automatic-feed-links' ); // RSS feeds	
	add_theme_support( 'post-formats', array( 'audio', 'gallery', 'image', 'link', 'quote', 'video' ) ); // Post formats.	
	register_nav_menu( 'primary', __( 'Primary Menu', 'framework' ) ); // Main menu

	// Post thumbnails
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 800, 9999 ); // default width, unlimited height, soft crop

	// Additional image sizes
	add_image_size( 'half-width-thumb', 575, 9999 );
	add_image_size( 'full-width-thumb', 1200, 9999 );
	add_image_size( 'portfolio-thumb',  600, 450, true ); // 4x3 ratio, hard crop
	add_image_size( 'portfolio-thumb-masonry',  600, 9999, true ); // unlimited height
}
add_action( 'after_setup_theme', 'theme_features_setup' );


#-----------------------------------------------------------------
# Styles and Scripts
#-----------------------------------------------------------------

function theme_styles_and_scripts() {
	global $wp_styles;

	// JavaScript
	//...............................................

	// Register scripts
	wp_register_script( 'modernizr',  get_stylesheet_directory_uri() . '/assets/js/modernizr-2.6.2-respond-1.1.0.min.js', array(), '2.6.2' );
	wp_register_script( 'jplayer',    get_stylesheet_directory_uri() . '/assets/js/jquery.jplayer.min.js', array('jquery'), '2.2.0', true );
	wp_register_script( 'rw_isotope', get_stylesheet_directory_uri() . '/assets/js/jquery.isotope.min.js', array('jquery'), '1.5.25', true );
	wp_register_script( 'theme-js',   get_stylesheet_directory_uri() . '/assets/js/onLoad.js', array('jquery'), '1.0', true ); // The theme's JS functions

	// Enqueue scripts
	wp_enqueue_script( 'jquery' ); 
	wp_enqueue_script( 'modernizr' ); 
	wp_enqueue_script( 'jplayer' );
	wp_enqueue_script( 'rw_isotope' );   // TODO: load only on filtered portfolio pages
	wp_enqueue_script( 'theme-js' );

	// Threaded comment support
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	// Dequeue
	wp_dequeue_script('content-rotator'); // Included in onLoad.js

	// CSS
	//...............................................

	// Default
	wp_enqueue_style( 'theme-styles', get_stylesheet_uri() );

	// Skin
	$skin = get_theme_skin();
	wp_enqueue_style( 'theme-skin', get_stylesheet_directory_uri() . '/'. $skin, array( 'theme-styles' ) );

	// Feature specific
	$deps = array();
	if( wp_style_is( 'font-awesome', 'registered' ) )
		$deps[] = 'font-awesome';
	$deps[] = 'ubermenu-font-awesome';
	wp_enqueue_style( 'font-awesome-theme', get_stylesheet_directory_uri() . '/assets/css/font-awesome.min.css', $deps );
	wp_enqueue_style( 'colorbox', get_stylesheet_directory_uri() . '/assets/css/colorbox.css' );

	// IE only
	wp_enqueue_style( 'theme-ie', get_stylesheet_directory_uri() . '/assets/css/ie.css', array( 'theme-css' ) );
		$wp_styles->add_data( 'theme-ie', 'conditional', 'lt IE 9' );
	wp_enqueue_style( 'font-awesome-ie', get_stylesheet_directory_uri() . '/assets/css/font-awesome-ie7.min.css', array( 'font-awesome' ) );
		$wp_styles->add_data( 'font-awesome-ie', 'conditional', 'lte IE 7' );

	// Dequeue
	wp_dequeue_style('content-rotator'); // Included in style.css

	// Fonts
	//...............................................

	// Include Google Fonts
	$googleFonts   = array();
	$gFont_Heading = get_options_data('options-page', 'font-heading-google');
	$gFont_Body    = get_options_data('options-page', 'font-body-google');

	if ( !empty($gFont_Heading) ) $googleFonts[] = $gFont_Heading;
	if ( !empty($gFont_Body) ) $googleFonts[] = $gFont_Body;

	if ( count($googleFonts) ) {  
		$gFontList  = str_replace(' ', '+', implode('|', $googleFonts)); // make ready for query string		
		$protocol   = is_ssl() ? 'https' : 'http';
		$subsets    = 'latin,latin-ext';
		$query_args = array( 'family' => $gFontList, 'subset' => $subsets );
		wp_enqueue_style( 'google-font', add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ), array(), null );
	}
}
add_action( 'wp_enqueue_scripts', 'theme_styles_and_scripts', 11 );

function ubermenu_custom_menu_item_defaults_lite( $defaults ){
	$cdefs = get_option( UBERMENU_MENU_ITEM_DEFAULTS_OPTION_KEY );
	if( $cdefs ){
		if( is_array( $cdefs ) ){
			foreach( $cdefs as $key => $val ){
				$defaults[$key] = $val;
			}
		}
	}
	$defaults['item_display'] = 'auto';
	return $defaults;
}
add_filter( 'ubermenu_menu_item_settings_defaults' , 'ubermenu_custom_menu_item_defaults_lite' );

#-----------------------------------------------------------------
# More stuff...
#-----------------------------------------------------------------

// Find more theme specific content functions in the Theme Utilities 
// extensions folder, located in: "extensions/theme-utilities/"

?>