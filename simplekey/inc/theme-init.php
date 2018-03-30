<?php
/** 
 * Theme Initialize
 * @package VAN Framework
 * You can initialize this theme functions like menu,sidebar,thumbnail size,post format and so on.
 * And you can also include more advanced extendsions like custom post type or widgets here. 
 */

global $VAN;
$theme 	= wp_get_theme( 'simplekey' );

add_action( 'simplekey_init', 'simplekey_load_framework');
function simplekey_load_framework(){
	
	/*-------------------------------------------------------
	* The path to VAN Framework and theme specific functions
	-------------------------------------------------------*/
	$functions_path = 	get_template_directory() . '/inc/functions/';
	$admin_path 	= 	get_template_directory() . '/inc/options/';
	$vc_path 		=	get_template_directory() . '/vc_extends/';
	$extensions_path = get_template_directory() . '/inc/extensions/';
	
	/*The common functions and theme functions*/
	require_once($functions_path."lib.php");        //  Functions Liburary
	require_once($functions_path."theme-functions.php");          // Theme functions
	require_once($functions_path."deprecated.php");               // Deprecated functions
	
	/*Admin functions and Van Panel*/
	require_once($functions_path."admin-functions.php");   					// Admin functions
	require_once($functions_path."shortcodes/shortcodes.php");   					    // Shortcodes
	require_once($functions_path."shortcodes/generator/shortcode-generator.php");     // Shortcodes generator
	require_once($vc_path."vc_extends.php"); 
	
	/**
	 * Plugins
	 */
	require_once(get_template_directory() . '/inc/plugins/plugins.php');
    
    $current_user = wp_get_current_user();
	if(is_admin()){
	  require_once($admin_path."van-options.php"); 				 // Theme options
	}           

	/*Add custom field at post,page or category edit page*/
	require_once($extensions_path.'metabox.php');
	require_once($extensions_path."theme-category-field.php");
	require_once($extensions_path."portfolio-type.php");
}
do_action('simplekey_init');

add_action( 'after_setup_theme', 'simplekey_support' );
function simplekey_support(){
	 
	/*Add some useful support*/
	add_editor_style('editor-style.css');
	add_theme_support( 'automatic-feed-links' );
	
    /*Add Title*/
	add_theme_support( 'title-tag' );
	
	/*Declare WooCommerce support*/
	add_theme_support('woocommerce');

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	/*
 	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on focux, use a find and replace
	 * to change 'focux' to the name of your theme in all the template files.
	 */
	
	load_theme_textdomain( 'SimpleKey', get_template_directory().'/languages' ); 
	$locale = get_locale(); 
	$locale_file = get_template_directory_uri()."/languages/$locale.php"; 
	if ( is_readable($locale_file) ) require_once($locale_file);
	
	
	if ( ! isset( $content_width ) ) $content_width = 980;
	remove_filter('the_content', 'wptexturize');
	add_filter('widget_text', 'do_shortcode');
	
	/*Add diffierent size for post thumbnails*/
	add_theme_support('post-thumbnails');
	if ( function_exists( 'add_image_size')){  
	    add_image_size('blog_thumbnail', 260, 218,true);
		add_image_size('slider_thumbnail', 400, 510,true);
		add_image_size('image_single_slider', 980, 730,true);
		add_image_size('portfolio_thumbnail', 640, 640,true);
	}

	/*Init nav menus*/
	register_nav_menus(array(
	  'primary_navi' => esc_html__('Primary Menu','SimpleKey'),
	  'footer_navi' => esc_html__('Footer Menu','SimpleKey'),
	));

	/*Change excerpt more string*/
	function simplekey_excerpt_more( $more ) {
		return '...';
	}
	add_filter( 'excerpt_more', 'simplekey_excerpt_more' );
	
	/*Init widget*/
	add_action( 'widgets_init', 'van_widgets_init' );
	function van_widgets_init() {
		register_sidebar(array(
			'name' => esc_html__( 'Blog sidebar', 'SimpleKey' ),
			'id' => 'blog-sidebar',
			'before_widget' => '<div class="widget">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>',
		));
	}
}


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
add_action( 'after_setup_theme', 'simplekey_content_width', 0 );
function simplekey_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'simplekey_content_width', 960 );
}

/*Load secondary scripts*/
add_action('wp_enqueue_scripts', 'simplekey_scripts');
function simplekey_scripts(){
    global $VAN;
    
    wp_enqueue_script( 'waypoints' );
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.41385.js', array('jquery'), null, false );
    wp_enqueue_script( 'jpreloader', get_template_directory_uri() . '/assets/js/jpreloader.min.js', array('jquery'), null, false );
	wp_enqueue_script( 'easing', get_template_directory_uri() . '/assets/js/jquery.easing.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'placeholder', get_template_directory_uri() . '/assets/js/jquery.placeholder.js', array('jquery'), null, true );
	wp_enqueue_script( 'hoverIntent-1', get_template_directory_uri() . '/assets/js/jquery.hoverIntent.js', array('jquery'), null, true );
	wp_enqueue_script( 'scrollTo', get_template_directory_uri() . '/assets/js/jquery.scrollTo-1.4.3.1-min.js', array('jquery'), null, true );
	wp_enqueue_script( 'localscroll', get_template_directory_uri() . '/assets/js/jquery.localscroll-1.2.7-min.js', array('jquery'), null, true );
	wp_enqueue_script( 'nicescroll', get_template_directory_uri() . '/assets/js/jquery.nicescroll.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'lazyload', get_template_directory_uri() . '/assets/js/jquery.lazyload.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'flexslider', get_template_directory_uri() . '/assets/js/flexslider/jquery.flexslider-min.js', array('jquery'), null, true );
	wp_enqueue_script( 'colorbox', get_template_directory_uri() . '/assets/js/colorbox/jquery.colorbox.js', array('jquery'), null, true );
	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/jquery.isotope.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'simplekey-contactform', get_template_directory_uri() . '/assets/js/jquery.contact-form.js', array('jquery'), null, true );
	wp_enqueue_script( 'mobilemenu', get_template_directory_uri() . '/assets	`/js/jquery.mobilemenu.js', array('jquery'), null, true );
	wp_enqueue_script( 'superfish', get_template_directory_uri() . '/assets/js/jquery.superfish.js', array('jquery'), null, true );
	wp_enqueue_script( 'sticky', get_template_directory_uri() . '/assets/js/jquery.sticky.js', array('jquery'), null, true );
	wp_enqueue_script( 'parallax', get_template_directory_uri() . '/assets/js/jquery.parallax-1.1.3.js', array('jquery'), null, true );
	wp_enqueue_script( 'simplekey_common', get_template_directory_uri() . '/inc/functions/assets/js/common.js', null, null, true );
	wp_enqueue_script( 'simplekey', get_template_directory_uri() . '/assets/js/jquery.simplekey.js', array('jquery'), null, true );
	
	
	/* ================================
     * Output the javascript arguments
     * ===============================*/
     
	if(is_home() || is_front_page()){ 
	   if($VAN['isLoad']==1 || !isset($VAN['isLoad'])){
	     $isLoad=1;
	   }else{
	     $isLoad=0;
	   }
	}else{
	     $isLoad=0;
	}
		
	if(!isset($VAN['isResponsive']) || $VAN['isResponsive']==1){
	  $isResponsive='1';
	}else{
	  $isResponsive='0';	 
    }
	if(!isset($VAN['isParallax']) || $VAN['isParallax']==1){
	  $isParallax='1';
	}else{
	  $isParallax='0';
	}
	
	$args='<script type="text/javascript">
	  var isLoad='.$isLoad.';
	  var isResponsive='.$isResponsive.';
	  var isParallax='.$isParallax.PHP_EOL;
	
	if(!isset($VAN['isNiceScroll']) || $VAN['isNiceScroll']=='1'){
	  $nicescroll=1;
	}else{
	  $nicescroll=0;
	}
	
	$is_admin=0;
	if(is_admin_bar_showing()){
		$is_admin=1;
	}
	$args.='var pixel="'.get_template_directory_uri().'/inc/functions/images/pixel.gif";
	  var loadimg="'.get_template_directory_uri().'/inc/functions/images/loader2.gif";
	  var isNiceScroll='.$nicescroll.';
      var mobileMenuText="'.__('Navigate to ...','SimpleKey').'";
      var is_admin='.$is_admin.';
</script>'.PHP_EOL;
		
	echo $args;
	
   /* ================================
    * Output the CSS files
    * ===============================*/
   wp_enqueue_style("style", get_stylesheet_uri(), false, null, "all");
   wp_enqueue_style("simplekey-general", get_template_directory_uri()."/assets/css/general.css", false, null, "all");
   wp_enqueue_style("simplekey-layout", get_template_directory_uri()."/assets/css/layout.css", false, null, "all");
   wp_enqueue_style("font-awesome", get_template_directory_uri()."/assets/css/font-awesome/assets/css/font-awesome.min.css", false, null, "all");
   wp_enqueue_style("magicfont", get_template_directory_uri()."/assets/css/magicfont/magicfont.css", false, null, "all");
   wp_enqueue_style("simplekey-shortcodes", get_template_directory_uri()."/inc/functions/shortcodes/shortcodes.css", false, "2.0", "all");
   wp_enqueue_style("flexslider", get_template_directory_uri()."/assets/js/flexslider/flexslider.css", false, "", "all");
   wp_enqueue_style("colorbox", get_template_directory_uri()."/assets/js/colorbox/colorbox.css", false, "", "all");
   wp_enqueue_style("simplekey-fonts", get_template_directory_uri()."/assets/css/fonts.css", false, "1.0", "all");
   
   if ( class_exists( 'woocommerce' ) ){
    wp_dequeue_style( 'woocommerce_frontendstyles' );
	wp_enqueue_style( "woocommerce-simplekey", get_template_directory_uri()."/woocommerce/woocommerce-simplekey.css",false, null, "all");
    wp_enqueue_style( 'woocommerce_responsive_frontend', get_stylesheet_directory_uri()."/woocommerce/woocommerce-responsive.css" );
   }
}

/**
 * Load Google Fonts
 * Hook: focux_scripts
 */
add_action( 'wp_enqueue_scripts', 'simplekey_font_styles',20);
function simplekey_font_styles() {
    wp_enqueue_style( 'simplekey-default-fonts', simplekey_fonts_url(), array(), null );
}
function simplekey_fonts_url() {
    $fonts_url = '';
    $Lato = _x( 'on', 'Lato: on or off', 'simplekey' );
    
    if ('off' !== $Lato) {
	    $font_families = array();
	 
	    
	    if ( 'off' !== $Lato ) {
	        $font_families[] = 'Lato:100,300,400,700 900';
	    }
	    
	    $query_args = array(
            'family' => urlencode( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext,vietnamese,cyrillic-ext,cyrillic,greek,greek-ext' ),
        );
 
        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}
    
    return esc_url_raw( $fonts_url );
}

/*Integration Head in dashbroad*/
add_action('admin_init', 'simplekey_admin_init');
function simplekey_admin_init(){
	wp_enqueue_style( 'farbtastic' );
	wp_enqueue_script( 'farbtastic' );
	wp_enqueue_style("simplekey-admin", get_template_directory_uri()."/inc/functions/assets/css/admin.css", false, "1.0", "all");
	wp_enqueue_script("simplekey-admin-script", get_template_directory_uri()."/inc/functions/assets/js/admin_script.js");
}
?>