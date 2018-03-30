<?php

/******************************************************************************/
/***************************** Theme Options *********************************/
/******************************************************************************/

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/settings/redux/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/settings/redux/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/settings/mrtailor.config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/settings/mrtailor.config.php' );
}

/******************************************************************************/
/******************************** Includes ************************************/
/******************************************************************************/

require_once('inc/helpers/helpers.php');

if ( is_admin() ) 
{
	if ( ! class_exists('Getbowtied_Admin_Pages') )
	{
		require_once( get_template_directory() . '/inc/tgm/class-tgm-plugin-activation.php' );
		require_once( get_template_directory() . '/inc/tgm/plugins.php' );
	}
}

include_once('inc/custom-styles/custom-styles.php'); // Load Custom Styles
include_once('inc/templates/post-meta.php'); // Load Post meta template
include_once('inc/templates/template-tags.php'); // Load Template Tags

//Include metaboxes
define('_TEMPLATEURL', WP_CONTENT_URL . '/themes/' . basename(TEMPLATEPATH));

include_once 'inc/wpalchemy/MetaBox-mod.php';
include_once 'inc/wpalchemy/MediaAccess-mod.php';

add_action( 'init', 'mr_tailor_metabox_styles' ); 
function mr_tailor_metabox_styles()
{
    if ( is_admin() ) 
    { 
        wp_enqueue_style( 'wpalchemy-metabox', _TEMPLATEURL . '/css/wp-admin-metabox.css' );
    }
}

$wpalchemy_media_access = new WPAlchemy_MediaAccess();

//Include metaboxes
include_once 'inc/metaboxes/slider-spec.php';
include_once 'inc/metaboxes/map-spec.php';

//Include Custom Posts
include_once('inc/custom-posts/portfolio.php');

//Include shortcodes
include_once('inc/shortcodes/product-categories.php');
include_once('inc/shortcodes/socials.php');
include_once('inc/shortcodes/from-the-blog.php');
include_once('inc/shortcodes/from-the-blog-listing.php');
include_once('inc/shortcodes/separator.php');
include_once('inc/shortcodes/spacing.php');
include_once('inc/shortcodes/banner.php');
include_once('inc/shortcodes/google-map.php');
include_once('inc/shortcodes/portfolio.php');
include_once('inc/shortcodes/wc-mod-product.php');
include_once('inc/shortcodes/add-to-cart.php');

//Mixed shortcodes
include_once('inc/shortcodes/mixed/recent-products-mixed.php');
include_once('inc/shortcodes/mixed/featured-products-mixed.php');
include_once('inc/shortcodes/mixed/sale-products-mixed.php');
include_once('inc/shortcodes/mixed/best-selling-products-mixed.php');
include_once('inc/shortcodes/mixed/top-rated-products-mixed.php');
include_once('inc/shortcodes/mixed/product-category-mixed.php');
include_once('inc/shortcodes/mixed/products-mixed.php');
include_once('inc/shortcodes/mixed/products-by-attribute-mixed.php');
include_once('inc/shortcodes/mixed/blog-posts-mixed.php');
include_once('inc/shortcodes/mixed/lookbook-mixed.php');

//Sliders shortcodes
include_once('inc/shortcodes/sliders/recent-products-slider.php');
include_once('inc/shortcodes/sliders/featured-products-slider.php');
include_once('inc/shortcodes/sliders/sale-products-slider.php');
include_once('inc/shortcodes/sliders/best-selling-products-slider.php');
include_once('inc/shortcodes/sliders/top-rated-products-slider.php');
include_once('inc/shortcodes/sliders/product-category-slider.php');
include_once('inc/shortcodes/sliders/products-slider.php');
include_once('inc/shortcodes/sliders/products-by-attribute-slider.php');

//Include Metaboxes
include_once('inc/metaboxes/page.php');
include_once('inc/metaboxes/portfolio.php');

//Custom Menu
include_once('inc/custom-menu/custom-menu.php');




/******************************************************************************/
/*************************** Visual Composer **********************************/
/******************************************************************************/

if (class_exists('WPBakeryVisualComposerAbstract')) {
	
	add_action( 'init', 'visual_composer_stuff' );
	function visual_composer_stuff() {
	
		//enable vc on post types
		if(function_exists('vc_set_default_editor_post_types')) vc_set_default_editor_post_types( array('post','page','product','portfolio') );
		
		// Modify and remove existing shortcodes from VC
		include_once('inc/shortcodes/visual-composer/custom_vc.php');
		
		// VC Templates
		$vc_templates_dir = get_template_directory() . '/inc/shortcodes/visual-composer/vc_templates/';
		vc_set_template_dir($vc_templates_dir);
		
		// Add new shortcodes to VC
		include_once('inc/shortcodes/visual-composer/blog-posts.php');
		include_once('inc/shortcodes/visual-composer/social-media-profiles.php');
		include_once('inc/shortcodes/visual-composer/banner.php');
		include_once('inc/shortcodes/visual-composer/google-map.php');
        include_once('inc/shortcodes/visual-composer/portfolio.php');
		
		// Title
		include_once('inc/shortcodes/visual-composer/title.php');
		include_once('inc/shortcodes/visual-composer/output/title.php');
		
		// Add new Shop shortcodes to VC
		if (class_exists('WooCommerce')) {
			include_once('inc/shortcodes/visual-composer/wc-recent-products.php');
			include_once('inc/shortcodes/visual-composer/wc-featured-products.php');
			include_once('inc/shortcodes/visual-composer/wc-products-by-category.php');
			include_once('inc/shortcodes/visual-composer/wc-products-by-attribute.php');
			include_once('inc/shortcodes/visual-composer/wc-product-by-id-sku.php');
			include_once('inc/shortcodes/visual-composer/wc-products-by-ids-skus.php');
			include_once('inc/shortcodes/visual-composer/wc-sale-products.php');
			include_once('inc/shortcodes/visual-composer/wc-top-rated-products.php');
			include_once('inc/shortcodes/visual-composer/wc-best-selling-products.php');
			include_once('inc/shortcodes/visual-composer/wc-add-to-cart-button.php');
			include_once('inc/shortcodes/visual-composer/wc-add-to-cart-button-custom.php');
			include_once('inc/shortcodes/visual-composer/wc-product-categories.php');
			include_once('inc/shortcodes/visual-composer/wc-product-categories-grid.php');
            include_once('inc/shortcodes/visual-composer/lookbook.php');
		}
		
		// Remove vc_teaser
		if (is_admin()) :
			function remove_vc_teaser() {
				remove_meta_box('vc_teaser', '' , 'side');
			}
			add_action( 'admin_head', 'remove_vc_teaser' );
		endif;
	
	}

}

add_action( 'vc_before_init', 'mrtailor_vcSetAsTheme' );
function mrtailor_vcSetAsTheme() {
	vc_manager()->disableUpdater(true);
	vc_set_as_theme();
}


/******************************************************************************/
/****************************** Ajax url **************************************/
/******************************************************************************/

add_action('wp_head','mrtailor_ajaxurl');
function mrtailor_ajaxurl() {
?>
    <script type="text/javascript">
        var mrtailor_ajaxurl = '<?php echo admin_url('admin-ajax.php', 'relative'); ?>';
    </script>
<?php
}

/******************************************************************************/
/************************ Ajax calls ******************************************/
/******************************************************************************/

// ajax refresh_dynamic_contents
function refresh_dynamic_contents() {
    global $woocommerce, $yith_wcwl;
    $data = array(
        'cart_count_products' => class_exists('WooCommerce') ? $woocommerce->cart->cart_contents_count : 0,
        'wishlist_count_products' => class_exists('YITH_WCWL') ? yith_wcwl_count_products() : 0,
    );
    wp_send_json($data);
}
add_action( 'wp_ajax_refresh_dynamic_contents', 'refresh_dynamic_contents' );
add_action( 'wp_ajax_nopriv_refresh_dynamic_contents', 'refresh_dynamic_contents' );



/******************************************************************************/
/*********************** mr_tailor setup **************************************/
/******************************************************************************/


if ( ! function_exists( 'mr_tailor_setup' ) ) :
function mr_tailor_setup() {
	
	global $mr_tailor_theme_options;

	// frontend presets
	if (isset($_GET["preset"])) { 
		$preset = $_GET["preset"];
	} else {
		$preset = "";
	}

	if ($preset != "") {
		if ( file_exists( dirname( __FILE__ ) . '/_presets/'.$preset.'.json' ) ) {
		$theme_options_json = file_get_contents( dirname( __FILE__ ) . '/_presets/'.$preset.'.json' );
		$mr_tailor_theme_options = json_decode($theme_options_json, true);
		}
	}
	
	/** Theme support **/
	add_theme_support( 'menus' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio' ) );
	add_theme_support( 'woocommerce');
	function custom_header_custom_bg() {
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );
	}
	
	/** Add Image Sizes **/
	$shop_catalog_image_size = get_option( 'shop_catalog_image_size' );
	$shop_single_image_size = get_option( 'shop_single_image_size' );
    add_image_size('product_small_thumbnail', (int)$shop_catalog_image_size['width']/3, (int)$shop_catalog_image_size['height']/3, isset($shop_catalog_image_size['crop']) ? true : false); // made from shop_catalog_image_size
	add_image_size('shop_single_small_thumbnail', (int)$shop_single_image_size['width']/3, (int)$shop_single_image_size['height']/3, isset($shop_catalog_image_size['crop']) ? true : false); // made from shop_single_image_size
	
	
	//add_image_size('default_gallery_img', 300, 300, true);
	//add_image_size('product_small_thumbnail', 100, 100, true);
	
	/** Register menus **/ 
	register_nav_menus( array(
		'top-bar-navigation' => __( 'Top Bar Navigation', 'mr_tailor' ),
		'main-navigation' => __( 'Main Navigation', 'mr_tailor' ),
	) );

	/** Theme textdomain **/
	load_theme_textdomain( 'mr_tailor', get_template_directory() . '/languages' );
	
	/** WooCommerce Number of products displayed per page **/
	if ( (isset($mr_tailor_theme_options['products_per_page'])) ) {
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $mr_tailor_theme_options['products_per_page'] . ';' ), 20 );
	}

}
endif; // mr_tailor_setup
add_action( 'after_setup_theme', 'mr_tailor_setup' );




/******************************************************************************/
/*********************** Enable excerpts **************************************/
/******************************************************************************/

add_action('init', 'mr_tailor_post_type_support');
function mr_tailor_post_type_support() {
	add_post_type_support( 'page', 'excerpt' );
}






/******************************************************************************/
/**************************** Enqueue styles **********************************/
/******************************************************************************/

// frontend
function mr_tailor_styles() {
	
	global $mr_tailor_theme_options;

	wp_enqueue_style('mr_tailor-app', get_template_directory_uri() . '/css/app.css', array(), '1.0', 'all' );
	wp_enqueue_style('mr_tailor-easyzoom', get_template_directory_uri() . '/css/easyzoom.css', array(), '1.0', 'all' );
	wp_enqueue_style('mr_tailor-woocommerce-overwrite', get_template_directory_uri() . '/css/woocommerce-overwrite.css', array(), '1.0', 'all' );	
	
	wp_enqueue_style('mr_tailor-animate', get_template_directory_uri() . '/css/animate.min.css', array(), '1.0', 'all' );		
	wp_enqueue_style('mr_tailor-animations-products-grid', get_template_directory_uri() . '/css/animations-products-grid.css', array(), '1.0', 'all' );
	wp_enqueue_style('mr_tailor-fresco', get_template_directory_uri() . '/css/fresco/fresco.css', array(), '1.3.0', 'all' );
	wp_enqueue_style('mr_tailor-swiper', get_template_directory_uri() . '/css/swiper.min.css', array(), '3.3.1', 'all' );
	wp_enqueue_style('mr_tailor-owl', get_template_directory_uri() . '/css/owl.carousel.css', array(), '1.3.1', 'all' );
	wp_enqueue_style('mr_tailor-owl-theme', get_template_directory_uri() . '/css/owl.theme.css', array(), '1.3.1', 'all' );
	wp_enqueue_style('mr_tailor-offcanvas', get_template_directory_uri() . '/css/offcanvas.css', array(), '1.0', 'all' );
	wp_enqueue_style('mr_tailor-nanoscroller', get_template_directory_uri() . '/css/nanoscroller.css', array(), '0.7.6', 'all' );
	wp_enqueue_style('mr_tailor-select2', get_template_directory_uri() . '/css/select2.css', array(), '3.5.1', 'all' );
	
	wp_enqueue_style('mr_tailor-defaults', get_template_directory_uri() . '/css/defaults.css', array(), '1.0', 'all' );
	wp_enqueue_style('mr_tailor-styles', get_template_directory_uri() . '/css/styles.css', array(), '1.0', 'all' );
	wp_enqueue_style('mr_tailor-responsive', get_template_directory_uri() . '/css/responsive.css', array(), '1.0', 'all' );
	
	wp_enqueue_style('mr_tailor-fonts', get_template_directory_uri() . '/inc/fonts/getbowtied-fonts/style.css', array(), '1.0', 'all' );
	
	wp_enqueue_style('mr_tailor-font-awesome', get_template_directory_uri() . '/inc/fonts/font-awesome/css/font-awesome.min.css', array(), '1.0', 'all' );

	wp_enqueue_style('mr_tailor-default-style', get_stylesheet_uri());		
	
	if (file_exists(dirname( __FILE__ ) . '/_theme-explorer/css/theme-explorer.css')) {
		wp_enqueue_style('mr_tailor-theme-explorer', get_template_directory_uri() . '/_theme-explorer/css/theme-explorer.css', array(), '1.0', 'all' );
	}

}
add_action( 'wp_enqueue_scripts', 'mr_tailor_styles', 99 );


// admin area
function mr_tailor_admin_styles() {
    if ( is_admin() ) {
        
		wp_enqueue_style("mr_tailor_admin_styles", get_template_directory_uri() . "/css/wp-admin-custom.css", false, "1.0", "all");
		
		if (class_exists('WPBakeryVisualComposerAbstract')) { 
			wp_enqueue_style('mr_tailor_visual_composer', get_template_directory_uri() .'/css/visual-composer.css', false, "1.0", 'all');
		}
    }
}
add_action( 'admin_enqueue_scripts', 'mr_tailor_admin_styles' );





/******************************************************************************/
/*************************** Enqueue scripts **********************************/
/******************************************************************************/

// frontend
function mr_tailor_scripts() {
	
	global $mr_tailor_theme_options;
	
	/** In Header **/
	wp_enqueue_script('mr_tailor-modernizr', get_template_directory_uri() . '/js/modernizr.custom.js', '', '2.6.3', FALSE);

	wp_enqueue_script('mr_tailor-google-maps', 'https://maps.googleapis.com/maps/api/js?sensor=false', array(), '1.0', FALSE);
	
	if ($mr_tailor_theme_options['main_font_source'] == "2") {
		if ( (isset($mr_tailor_theme_options['main_font_typekit_kit_id'])) && ($mr_tailor_theme_options['main_font_typekit_kit_id'] != "") ) {
			wp_enqueue_script('mr_tailor-main_font_typekit', '//use.typekit.net/'.$mr_tailor_theme_options['main_font_typekit_kit_id'].'.js', array(), NULL, FALSE );
		}
	}
	
	if ($mr_tailor_theme_options['secondary_font_source'] == "2") {
		if ( (isset($mr_tailor_theme_options['secondary_font_typekit_kit_id'])) && ($mr_tailor_theme_options['secondary_font_typekit_kit_id'] != "") ) {
			wp_enqueue_script('mr_tailor-secondary_font_typekit', '//use.typekit.net/'.$mr_tailor_theme_options['secondary_font_typekit_kit_id'].'.js', array(), NULL, FALSE );
		}
	}
	
	if ( ($mr_tailor_theme_options['main_font_source'] == "2") || ($mr_tailor_theme_options['secondary_font_source'] == "2") ) {
		if ( ((isset($mr_tailor_theme_options['main_font_typekit_kit_id'])) && ($mr_tailor_theme_options['main_font_typekit_kit_id'] != "")) || ((isset($mr_tailor_theme_options['secondary_font_typekit_kit_id'])) && ($mr_tailor_theme_options['secondary_font_typekit_kit_id'] != "")) ) {
			function mr_tailor_typekit_exec() {
				echo '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
			}
			add_action('wp_head', 'mr_tailor_typekit_exec');
		}
	}
	
	if ( ($mr_tailor_theme_options['main_font_source'] == "2") && ($mr_tailor_theme_options['secondary_font_source'] == "2") ) {
		if ( ((isset($mr_tailor_theme_options['main_font_typekit_kit_id'])) && ($mr_tailor_theme_options['main_font_typekit_kit_id'] != "")) || ((isset($mr_tailor_theme_options['secondary_font_typekit_kit_id'])) && ($mr_tailor_theme_options['secondary_font_typekit_kit_id'] != "")) ) {
			if ( $mr_tailor_theme_options['main_font_typekit_kit_id'] == $mr_tailor_theme_options['secondary_font_typekit_kit_id'] ) {
				wp_dequeue_script('mr_tailor-secondary_font_typekit');
			}
		}
	}
	
	/** In Footer **/
	
	if (file_exists(dirname( __FILE__ ) . '/js/_combined.min.js')) {
		
		wp_enqueue_script('mr_tailor-combined-scripts', get_template_directory_uri() . '/js/_combined.min.js', array('jquery'), '1.0', TRUE);
		
	} else {
		
		wp_enqueue_script('mr_tailor-foundation', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), '5.2.0', TRUE);
		wp_enqueue_script('mr_tailor-foundation-interchange', get_template_directory_uri() . '/js/foundation.interchange.js', array('jquery'), '5.2.0', TRUE);
		wp_enqueue_script('mr_tailor-isotope', get_template_directory_uri() . '/js/isotope.pkgd.min.js', array('jquery'), 'v2.0.0', TRUE);
		wp_enqueue_script('mr_tailor-imagesloaded', get_template_directory_uri() . '/js/imagesloaded.js', array('jquery'), 'v3.1.4', TRUE);
		wp_enqueue_script('mr_tailor-touchswipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array('jquery'), '1.6.5', TRUE);
		wp_enqueue_script('mr_tailor-fitvids', get_template_directory_uri() . '/js/jquery.fitvids.js', array('jquery'), '1.0.3', TRUE);
		wp_enqueue_script('mr_tailor-idangerous-swiper', get_template_directory_uri() . '/js/swiper.min.js', array('jquery'), '3.3.1', TRUE);
		wp_enqueue_script('mr_tailor-owl', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), '1.3.1', TRUE);
		wp_enqueue_script('mr_tailor-fresco', get_template_directory_uri() . '/js/fresco.js', array('jquery'), '1.3.0', TRUE);
		wp_enqueue_script('mr_tailor-nanoscroller', get_template_directory_uri() . '/js/jquery.nanoscroller.min.js', array('jquery'), '0.7.6', TRUE);
		wp_enqueue_script('mr_tailor-select2', get_template_directory_uri() . '/js/select2.min.js', array('jquery'), '3.5.1', TRUE);
		wp_enqueue_script('mr_tailor-scroll_to', get_template_directory_uri() . '/js/jquery.scroll_to.js', array('jquery'), '1.4.5', TRUE);
		wp_enqueue_script('mr_tailor-stellar', get_template_directory_uri() . '/js/jquery.stellar.min.js', array('jquery'), '0.6.2', TRUE);
		wp_enqueue_script('mr_tailor-snapscroll', get_template_directory_uri() . '/js/jquery.snapscroll.min.js', array('jquery'), '1.6.1', TRUE);
		wp_enqueue_script('mr_tailor-easyzoom', get_template_directory_uri() . '/js/easyzoom.js', array('jquery'), '1.0', TRUE);
		wp_enqueue_script('mr_tailor-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', TRUE);
		
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'mr_tailor_scripts', 99 );



// admin area
function mr_tailor_admin_scripts() {
    if ( is_admin() ) {
        global $post_type;
		
		if ( (isset($_GET['post_type']) && ($_GET['post_type'] == 'portfolio')) || ($post_type == 'portfolio')) :
			wp_enqueue_script("mr_tailor_admin_scripts", get_template_directory_uri() . "/js/wp-admin-portfolio.js", array('wp-color-picker'), false, "1.0");
		endif;
		
    }
}
add_action( 'admin_enqueue_scripts', 'mr_tailor_admin_scripts' );






/*********************************************************************************************/
/******************************** Fix empty title on homepage  *******************************/
/*********************************************************************************************/

/*add_filter( 'wp_title', 'mr_tailor_hack_wp_title_for_home' );
function mr_tailor_hack_wp_title_for_home( $title )
{
	if( empty( $title ) && ( is_home() || is_front_page() ) ) {
		return __( 'Home', 'mr_tailor' ) . ' | ' . get_bloginfo( 'description' );
	}
	return $title;
}*/

add_filter( 'wp_title', 'mr_tailor_wp_title', 10, 2 );
function mr_tailor_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'mr_tailor' ), max( $paged, $page ) );
	}

	return $title;
}



/******************************************************************************/
/******************** Revolution Slider set as Theme **************************/
/******************************************************************************/

if(function_exists( 'set_revslider_as_theme' )){
	add_action( 'init', 'mr_tailor_set_revslider_as_theme' );
	function mr_tailor_set_revslider_as_theme() {
		set_revslider_as_theme();
	}
}





/******************************************************************************/
/****** Register widgetized area and update sidebar with default widgets ******/
/******************************************************************************/

function mr_tailor_widgets_init() {
	
	$sidebars_widgets = wp_get_sidebars_widgets();	
	$footer_area_widgets_counter = "0";	
	if (isset($sidebars_widgets['footer-widget-area'])) $footer_area_widgets_counter  = count($sidebars_widgets['footer-widget-area']);
	
	switch ($footer_area_widgets_counter) {
		case 0:
			$footer_area_widgets_columns ='large-12';
			break;
		case 1:
			$footer_area_widgets_columns ='large-12 medium-12 small-12';
			break;
		case 2:
			$footer_area_widgets_columns ='large-6 medium-6 small-12';
			break;
		case 3:
			$footer_area_widgets_columns ='large-4 medium-6 small-12';
			break;
		case 4:
			$footer_area_widgets_columns ='large-3 medium-6 small-12';
			break;
		case 5:
			$footer_area_widgets_columns ='footer-5-columns large-2 medium-6 small-12';
			break;
		case 6:
			$footer_area_widgets_columns ='large-2 medium-6 small-12';
			break;
		default:
			$footer_area_widgets_columns ='large-2 medium-6 small-12';
	}
	
	//default sidebar
	register_sidebar(array(
		'name'          => __( 'Sidebar', 'mr_tailor' ),
		'id'            => 'default-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	//footer widget area
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'mr_tailor' ),
		'id'            => 'footer-widget-area',
		'before_widget' => '<div class="' . $footer_area_widgets_columns . ' columns"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	//catalog widget area
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'mr_tailor' ),
		'id'            => 'catalog-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'mr_tailor_widgets_init' );



// Remove Woocommerce prettyPhoto
/*add_action( 'wp_enqueue_scripts', 'mr_tailor_remove_woocommerce_prettyPhoto', 99 );
function mr_tailor_remove_woocommerce_prettyPhoto() {
    wp_dequeue_script('prettyPhoto');
    wp_dequeue_script('prettyPhoto-init');
    wp_dequeue_style('woocommerce_prettyPhoto_css');
}*/





/*********************************************************************************************/
/*********** Remove Admin Bar - Only display to administrators *******************************/
/*********************************************************************************************/

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}





/*********************************************************************************************/
/************************** WooCommerce Custom Out of Stock **********************************/
/*********************************************************************************************/


add_action( 'init', 'out_of_stock_stuff' );
function out_of_stock_stuff() {

	global $mr_tailor_theme_options;
	
	if (isset($mr_tailor_theme_options['out_of_stock_text'])) {		
		add_filter( 'woocommerce_get_availability', 'custom_get_availability', 1, 2);
		function custom_get_availability( $availability, $_product ) {
			global $mr_tailor_theme_options;
			if ( !$_product->is_in_stock() ) $availability['availability'] = __($mr_tailor_theme_options['out_of_stock_text'], 'mr_tailor');
			return $availability;
		}		
	}

}





/*********************************************************************************************/
/****************************** WooCommerce Custom Sale **************************************/
/*********************************************************************************************/


add_action( 'init', 'sale_stuff' );
function sale_stuff() {

	global $mr_tailor_theme_options;

	if (isset($mr_tailor_theme_options['sale_text'])) {
		add_filter('woocommerce_sale_flash', 'custom_sale_flash', 10, 3);
		function custom_sale_flash($text, $post, $_product) {
			global $mr_tailor_theme_options;
			return '<span class="onsale">'.__($mr_tailor_theme_options['sale_text'], 'mr_tailor').'</span>';  
		}
	}

}



/*********************************************************************************************/
/****************************** WooCommerce Category Image ***********************************/
/*********************************************************************************************/

if ( ! function_exists( 'woocommerce_add_category_header_img' ) ) :
	require_once('inc/addons/woocommerce-header-category-image.php');
endif;



/******************************************************************************/
/****** Add Fresco to Galleries ***********************************************/
/******************************************************************************/

add_filter( 'wp_get_attachment_link', 'sant_prettyadd', 10, 6);
function sant_prettyadd ($content, $id, $size, $permalink, $icon, $text) {
    if ($permalink) {
    	return $content;    
    }
    $content = preg_replace("/<a/","<span class=\"fresco\" data-fresco-group=\"\"", $content, 1);
    return $content;
}




//Adds gallery shortcode defaults of size="medium" and columns="2"
/*
function custom_gallery_atts( $out, $pairs, $atts ) {
   
    $atts = shortcode_atts( array(
        'size' => 'default_gallery_img',
    ), $atts );

    $out['size'] = $atts['size'];

    return $out;

}
add_filter( 'shortcode_atts_gallery', 'custom_gallery_atts', 10, 3 );
*/



/******************************************************************************/
/****** Add Font Awesome to Redux *********************************************/
/******************************************************************************/

function newIconFont() {

    wp_register_style(
        'redux-font-awesome',
        get_template_directory_uri() . '/inc/fonts/font-awesome/css/font-awesome.min.css',
        array(),
        time(),
        'all'
    );  
    wp_enqueue_style( 'redux-font-awesome' );
}
// This example assumes the opt_name is set to mr_tailor_theme_options.
add_action( 'redux/page/mr_tailor_theme_options/enqueue', 'newIconFont' );





/******************************************************************************/
/* WooCommerce Update Number of Items in the cart *****************************/
/******************************************************************************/

add_action('woocommerce_ajax_added_to_cart', 'mr_tailor_ajax_added_to_cart');
function mr_tailor_ajax_added_to_cart() {

	add_filter('add_to_cart_fragments', 'mr_tailor_shopping_bag_items_number');
	function mr_tailor_shopping_bag_items_number( $fragments ) 
	{
		global $woocommerce;
		ob_start(); ?>

		<script>
		(function($){
			$('.shopping-bag-button').trigger('click');
		})(jQuery);
		</script>
        
        <span class="shopping_bag_items_number"><?php echo $woocommerce->cart->cart_contents_count; ?></span>

		<?php
		$fragments['.shopping_bag_items_number'] = ob_get_clean();
		return $fragments;
	}

}



/******************************************************************************/
/* WooCommerce Number of Related Products *************************************/
/******************************************************************************/

function woocommerce_output_related_products() {
	$atts = array(
		'posts_per_page' => '12',
		'orderby'        => 'rand'
	);
	woocommerce_related_products($atts);
}



/******************************************************************************/
/* WooCommerce Add data-src & lazyOwl to Thumbnails ***************************/
/******************************************************************************/
function woocommerce_get_product_thumbnail( $size = 'product_small_thumbnail', $placeholder_width = 0, $placeholder_height = 0  ) {
	global $post;

	if ( has_post_thumbnail() ) {
		$image_src = wp_get_attachment_image_src( get_post_thumbnail_id(), 'shop_catalog' );
		return get_the_post_thumbnail( $post->ID, $size, array('data-src' => $image_src[0], 'class' => 'lazyOwl') );
	} elseif ( wc_placeholder_img_src() ) {
		return wc_placeholder_img( $size );
	}
}

function woocommerce_subcategory_thumbnail( $category ) {
	$small_thumbnail_size  	= apply_filters( 'single_product_small_thumbnail_size', 'product_small_thumbnail' );
	$thumbnail_size  		= apply_filters( 'single_product_small_thumbnail_size', 'shop_catalog' );
	$dimensions    			= wc_get_image_size( $small_thumbnail_size );
	$thumbnail_id  			= get_woocommerce_term_meta( $category->term_id, 'thumbnail_id', true  );

	if ( $thumbnail_id ) {
		$image_small = wp_get_attachment_image_src( $thumbnail_id, $small_thumbnail_size  );
		$image_small = $image_small[0];
		$image = wp_get_attachment_image_src( $thumbnail_id, $thumbnail_size  );
		$image = $image[0];
	} else {
		$image = $image_small = wc_placeholder_img_src();
		
	}

	if ( $image_small )
		echo '<img data-src="' . esc_url( $image ) . '" class="lazyOwl" src="' . esc_url( $image_small ) . '" alt="' . esc_attr( $category->name ) . '" width="' . esc_attr( $dimensions['width'] ) . '" height="' . esc_url( $dimensions['height'] ) . '" />';
}





/******************************************************************************/
/* WooCommerce Wrap Oembed Stuff **********************************************/
/******************************************************************************/
add_filter('embed_oembed_html', 'mr_tailor_embed_oembed_html', 99, 4);
function mr_tailor_embed_oembed_html($html, $url, $attr, $post_id) {
	return '<div class="video-container">' . $html . '</div>';
}




/******************************************************************************/
/****** Overwrite WooCommerce Widgets *****************************************/
/******************************************************************************/
 

function overwride_woocommerce_widgets() { 
	if ( class_exists( 'WC_Widget_Cart' ) ) {
		include_once( 'inc/widgets/woocommerce-cart.php' ); 
		register_widget( 'mr_tailor_WC_Widget_Cart' );
	}
}
add_action( 'widgets_init', 'overwride_woocommerce_widgets', 15 );




/******************************************************************************/
/****** Set woocommerce images sizes ******************************************/
/******************************************************************************/

if ( ! function_exists('mr_tailor_woocommerce_image_dimensions') ) :
	function mr_tailor_woocommerce_image_dimensions() {
		global $pagenow;
	 
		if ( ! isset( $_GET['activated'] ) || $pagenow != 'themes.php' ) {
			return;
		}

	  	$catalog = array(
			'width' 	=> '350',	// px
			'height'	=> '435',	// px
			'crop'		=> 1 		// true
		);

		$single = array(
			'width' 	=> '570',	// px
			'height'	=> '708',	// px
			'crop'		=> 1 		// true
		);

		$thumbnail = array(
			'width' 	=> '70',	// px
			'height'	=> '87',	// px
			'crop'		=> 0 		// false
		);

		// Image sizes
		update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
		update_option( 'shop_single_image_size', $single ); 		// Single product image
		update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
	}
	add_action( 'after_switch_theme', 'mr_tailor_woocommerce_image_dimensions', 1 );
endif;


/******************************************************************************/
/****** Share Product *********************************************************/
/******************************************************************************/

function getbowtied_single_share_product() {
    global $post, $product, $mr_tailor_theme_options;
    if ( (isset($mr_tailor_theme_options['sharing_options'])) && ($mr_tailor_theme_options['sharing_options'] == "1" ) ) :
?>

    <div class="box-share-master-container">
        <div class="box-share-container product-share-container">

            <a class="trigger-share-list" href="#"><i class="fa fa-share-alt"></i><?php _e( 'Share this product', 'mr_tailor' )?></a>
            <div class="box-share-list">

                <?php
                    //Get the Thumbnail URL
                    $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
                ?>

                <div class="box-share-list-inner">
                    <a href="//www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" class="box-share-link" target="_blank"><i class="fa fa-facebook"></i><span>Facebook</span></a>
                    <a href="//twitter.com/share?url=<?php the_permalink(); ?>" class="box-share-link" target="_blank"><i class="fa fa-twitter"></i><span>Twitter</span></a>
                    <a href="//plus.google.com/share?url=<?php the_permalink(); ?>" class="box-share-link" target="_blank"><i class="fa fa-google-plus"></i><span>Google</span></a>
                    <a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url($src[0]) ?>&amp;description=<?php echo urlencode(get_the_title()); ?>" class="box-share-link" target="_blank"><i class="fa fa-pinterest"></i><span>Pinterest</span></a>
                </div><!--.box-share-list-inner-->

            </div><!--.box-share-list-->
        </div>
    </div><!--.box-share-master-container-->

<?php
    endif;
}
add_filter( 'woocommerce_single_product_summary', 'getbowtied_single_share_product', 50 );




/********************************************************************************/
if ( ! isset( $content_width ) ) $content_width = 640; /* pixels */


/******************************************************************************/
/****** Remove customize link from admin bar***********************************/
/******************************************************************************/
add_action( 'admin_bar_menu', 'remove_customize_link', 999 );
function remove_customize_link( $wp_admin_bar ) 
{
    $wp_admin_bar->remove_menu( 'customize' );
}

/******************************************************************************/
/****** Track recent products *************************************************/
/******************************************************************************/
function custom_track_product_view() {
    if ( ! is_singular( 'product' ) ) {
        return;
    }

    global $post;

    if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) )
        $viewed_products = array();
    else
        $viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );

    if ( ! in_array( $post->ID, $viewed_products ) ) {
        $viewed_products[] = $post->ID;
    }

    if ( sizeof( $viewed_products ) > 4 ) {
        array_shift( $viewed_products );
    }

    // Store for session only
    wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
}

add_action( 'template_redirect', 'custom_track_product_view', 20 );

/******************************************************************************/
/****** Limit number of cross-sells *******************************************/
/******************************************************************************/
add_filter('woocommerce_cross_sells_total', 'cartCrossSellTotal');
function cartCrossSellTotal($total) {
	$total = '2';
	return $total;
}