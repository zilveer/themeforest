<?php

// DO NOT MODIFY
// define("THEME_SLUG", 'shopkeeper'); 
// define("THEME_NAME", 'Shopkeeper');

// theme textdomain - must be loaded before redux
load_theme_textdomain( 'shopkeeper', get_template_directory() . '/languages' );

/******************************************************************************/
/***************************** Theme Options **********************************/
/******************************************************************************/

if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/settings/redux/ReduxCore/framework.php' ) ) {
    require_once( dirname( __FILE__ ) . '/settings/redux/ReduxCore/framework.php' );
}
if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/settings/shopkeeper.config.php' ) ) {
    require_once( dirname( __FILE__ ) . '/settings/shopkeeper.config.php' );
}

global $shopkeeper_theme_options;


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

//Include Custom Posts
require('inc/custom-posts/portfolio.php');



include_once('inc/custom-styles/custom-styles.php'); // Load Custom Styles
include_once('inc/templates/post-meta.php'); // Load Post meta template
include_once('inc/templates/template-tags.php'); // Load Template Tags

include_once('inc/widgets/social-media.php'); // Load Widget Social Media



//Include Shortcodes
include_once('inc/shortcodes/product-categories.php');
include_once('inc/shortcodes/socials.php');
include_once('inc/shortcodes/from-the-blog.php');
include_once('inc/shortcodes/google-map.php');
include_once('inc/shortcodes/banner.php');
include_once('inc/shortcodes/icon-box.php');
include_once('inc/shortcodes/portfolio.php');
include_once('inc/shortcodes/add-to-cart.php');
include_once('inc/shortcodes/wc-mod-product.php');



//Include Metaboxes
include_once('inc/metaboxes/page.php');
include_once('inc/metaboxes/post.php');
include_once('inc/metaboxes/portfolio.php');
include_once('inc/metaboxes/product.php');


//Custom Menu
include_once('inc/custom-menu/custom-menu.php');

//Quick View
include_once('inc/woocommerce/quick_view.php');

//Theme welcome page
if (is_admin()):
	include_once('inc/admin/admin.php');
endif;



/******************************************************************************/
/************************ Plugin recommendations ******************************/
/******************************************************************************/

// require_once dirname( __FILE__ ) . '/inc/tgm/class-tgm-plugin-activation-mod1.php';
// require_once dirname( __FILE__ ) . '/inc/tgm/plugins.php';





/******************************************************************************/
/*************************** Visual Composer **********************************/
/******************************************************************************/

if (class_exists('WPBakeryVisualComposerAbstract')) {
	
	add_action( 'init', 'visual_composer_stuff' );
	function visual_composer_stuff() {
		
		//disable update
		// Vc_Manager::getInstance()->disableUpdater(true);

		
		//enable vc on post types
		if(function_exists('vc_set_default_editor_post_types')) vc_set_default_editor_post_types( array('post','page','product','portfolio') );
		
		// Modify and remove existing shortcodes from VC
		include_once('inc/shortcodes/visual-composer/custom_vc.php');
		
		// VC Templates
		$vc_templates_dir = get_template_directory() . '/inc/shortcodes/visual-composer/vc_templates/';
		vc_set_template_dir($vc_templates_dir);
		
		// Add new shortcodes to VC
		include_once('inc/shortcodes/visual-composer/from-the-blog.php');
		include_once('inc/shortcodes/visual-composer/social-media-profiles.php');
		include_once('inc/shortcodes/visual-composer/google-map.php');
		include_once('inc/shortcodes/visual-composer/banner.php');
		include_once('inc/shortcodes/visual-composer/icon-box.php');
		include_once('inc/shortcodes/visual-composer/portfolio.php');
		
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
			include_once('inc/shortcodes/visual-composer/wc-product-categories.php');
			include_once('inc/shortcodes/visual-composer/wc-product-categories-grid.php');
		}
		
		// Remove vc_teaser
		if (is_admin()) :
			function remove_vc_teaser() {
				remove_meta_box('vc_teaser', '' , 'side');
			}
			add_action( 'admin_head', 'remove_vc_teaser' );
		endif;
	
	}

	// Filter to replace default css class names for vc_row shortcode and vc_column
	/*add_filter( 'vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2 );
	function custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {
		
		if ( $tag == 'vc_row' || $tag == 'vc_row_inner' ) {
			$class_string = str_replace( 'vc_row-fluid', 'row', $class_string );
		}

		if ( $tag == 'vc_column' || $tag == 'vc_column_inner' ) {
			$class_string = preg_replace( '/vc_col-xs-(\d{1,2})/', 'large-$1 columns column_container', $class_string );
			$class_string = preg_replace( '/vc_col-sm-(\d{1,2})/', 'large-$1 columns column_container', $class_string );
			$class_string = preg_replace( '/vc_col-md-(\d{1,2})/', 'large-$1 columns column_container', $class_string );
			$class_string = preg_replace( '/vc_col-lg-(\d{1,2})/', 'large-$1 columns column_container', $class_string );
		}

		return $class_string;

	}*/

}

add_action( 'vc_before_init', 'shopkeeper_vcSetAsTheme' );
function shopkeeper_vcSetAsTheme() {
    vc_manager()->disableUpdater(true);
	vc_set_as_theme();
}




/******************************************************************************/
/****************************** Ajax url **************************************/
/******************************************************************************/

add_action('wp_head','shopkeeper_ajaxurl');
function shopkeeper_ajaxurl() {
?>
    <script type="text/javascript">
        var shopkeeper_ajaxurl = '<?php echo admin_url('admin-ajax.php', 'relative'); ?>';
    </script>
<?php
}

/******************************************************************************/
/************************ Ajax calls ******************************************/
/******************************************************************************/

function refresh_dynamic_contents() {
	global $woocommerce, $yith_wcwl;
    $data = array(
        'cart_count_products' => class_exists('WooCommerce') ? WC()->cart->get_cart_contents_count() : 0,
        'wishlist_count_products' => class_exists('YITH_WCWL') ? yith_wcwl_count_products() : 0,
    );
	wp_send_json($data);
}
add_action( 'wp_ajax_refresh_dynamic_contents', 'refresh_dynamic_contents' );
add_action( 'wp_ajax_nopriv_refresh_dynamic_contents', 'refresh_dynamic_contents' );






/******************************************************************************/
/*********************** shopkeeper setup *************************************/
/******************************************************************************/


if ( ! function_exists( 'shopkeeper_setup' ) ) :
function shopkeeper_setup() {
	
	global $shopkeeper_theme_options;

	// frontend presets
	if (isset($_GET["preset"])) { 
		$preset = $_GET["preset"];
	} else {
		$preset = "";
	}

	if ($preset != "") {
		if ( file_exists( dirname( __FILE__ ) . '/_presets/'.$preset.'.json' ) ) {
		$theme_options_json = file_get_contents( dirname( __FILE__ ) . '/_presets/'.$preset.'.json' );
		$shopkeeper_theme_options = json_decode($theme_options_json, true);
		}
	}
	
	/** Theme support **/
	add_theme_support( 'title-tag' );
	add_theme_support( 'menus' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce');
	function custom_header_custom_bg() {
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );
	}
   	
	add_post_type_support('page', 'excerpt');
	
	
	/** Add Image Sizes **/
	$shop_catalog_image_size = get_option( 'shop_catalog_image_size' );
	$shop_single_image_size = get_option( 'shop_single_image_size' );
	add_image_size('product_small_thumbnail', (int)$shop_catalog_image_size['width']/3, (int)$shop_catalog_image_size['height']/3, isset($shop_catalog_image_size['crop']) ? true : false); // made from shop_catalog_image_size
	add_image_size('shop_single_small_thumbnail', (int)$shop_single_image_size['width']/3, (int)$shop_single_image_size['height']/3, isset($shop_catalog_image_size['crop']) ? true : false); // made from shop_single_image_size
	add_image_size( 'blog-isotope', 620, 500, true ); 
	
	/** Register menus **/	
	register_nav_menus( array(
		'top-bar-navigation' => __( 'Top Bar Navigation', 'shopkeeper' ),
		'main-navigation' => __( 'Main Navigation', 'shopkeeper' ),
		'footer-navigation' => __( 'Footer Navigation', 'shopkeeper' ),
	) );
	
	if ( (isset($shopkeeper_theme_options['main_header_off_canvas'])) && (trim($shopkeeper_theme_options['main_header_off_canvas']) == "1" ) ) {
		register_nav_menus( array(
			'secondary_navigation' => __( 'Secondary Navigation (Off-Canvas)', 'shopkeeper' ),
		) );
	}
	
	if ( (isset($shopkeeper_theme_options['main_header_layout'])) && ( $shopkeeper_theme_options['main_header_layout'] == "2" ) ) {
		register_nav_menus( array(
			'centered_header_left_navigation' => __( 'Centered Header - Left Navigation', 'shopkeeper' ),
			'centered_header_right_navigation' => __( 'Centered Header - Right Navigation', 'shopkeeper' ),
		) );
	}
	
	/** WooCommerce Number of products displayed per page **/	
	if ( (isset($shopkeeper_theme_options['products_per_page'])) ) {
		add_filter( 'loop_shop_per_page', create_function( '$cols', 'return ' . $shopkeeper_theme_options['products_per_page'] . ';' ), 20 );
	}

	/******************************************************************************/
	/* WooCommerce remove review tab **********************************************/
	/******************************************************************************/
	if ( (isset($shopkeeper_theme_options['review_tab'])) && ($shopkeeper_theme_options['review_tab'] == "0" ) ) {
	add_filter( 'woocommerce_product_tabs', 'shopkeeper_remove_reviews_tab', 98);
		function shopkeeper_remove_reviews_tab($tabs) {
			unset($tabs['reviews']);
			return $tabs;
		}
	}
}
endif; // shopkeeper_setup
add_action( 'after_setup_theme', 'shopkeeper_setup' );

/******************************************************************************/
/**************************** Enqueue styles **********************************/
/******************************************************************************/

// frontend
function shopkeeper_styles() {
	
	global $shopkeeper_theme_options;

	wp_enqueue_style('shopkeeper-styles', get_template_directory_uri() . '/css/styles.css', array(), getbowtied_theme_version(), 'all' );
	
	wp_enqueue_style('shopkeeper-font-awesome', get_template_directory_uri() . '/inc/fonts/font-awesome/css/font-awesome.min.css', array(), '4.6.3', 'all' );
	wp_enqueue_style('shopkeeper-font-linea-arrows', get_template_directory_uri() . '/inc/fonts/linea-fonts/arrows/styles.css', array(), '1.0', 'all' );
	wp_enqueue_style('shopkeeper-font-linea-basic', get_template_directory_uri() . '/inc/fonts/linea-fonts/basic/styles.css', array(), '1.0', 'all' );
	wp_enqueue_style('shopkeeper-font-linea-basic_elaboration', get_template_directory_uri() . '/inc/fonts/linea-fonts/basic_elaboration/styles.css', array(), '1.0', 'all' );
	wp_enqueue_style('shopkeeper-font-linea-ecommerce', get_template_directory_uri() . '/inc/fonts/linea-fonts/ecommerce/styles.css', array(), '1.0', 'all' );
	wp_enqueue_style('shopkeeper-font-linea-music', get_template_directory_uri() . '/inc/fonts/linea-fonts/music/styles.css', array(), '1.0', 'all' );
	wp_enqueue_style('shopkeeper-font-linea-software', get_template_directory_uri() . '/inc/fonts/linea-fonts/software/styles.css', array(), '1.0', 'all' );
	wp_enqueue_style('shopkeeper-font-linea-weather', get_template_directory_uri() . '/inc/fonts/linea-fonts/weather/styles.css', array(), '1.0', 'all' );	
	
	wp_enqueue_style('shopkeeper-fresco', get_template_directory_uri() . '/css/fresco/fresco.css', array(), '1.3.0', 'all' );	
	
	if ( isset($shopkeeper_theme_options['main_header_layout']) ) {		
		if ( $shopkeeper_theme_options['main_header_layout'] == "1" ) {
			wp_enqueue_style('shopkeeper-header-default', get_template_directory_uri() . '/css/header-default.css', array(), '1.0', 'all' );
		} 		
		elseif ( $shopkeeper_theme_options['main_header_layout'] == "2" ) {
			wp_enqueue_style('shopkeeper-header-centered-2menus', get_template_directory_uri() . '/css/header-centered-2menus.css', array(), '1.0', 'all' );
		}
		elseif ( $shopkeeper_theme_options['main_header_layout'] == "3" ) {
			wp_enqueue_style('shopkeeper-header-centered-menu-under', get_template_directory_uri() . '/css/header-centered-menu-under.css', array(), '1.0', 'all' );
		} 		
	}		
	else {	
		wp_enqueue_style('shopkeeper-header-default', get_template_directory_uri() . '/css/header-default.css', array(), '1.0', 'all' );	
	}
	
	if (isset($shopkeeper_theme_options['font_source']) && ($shopkeeper_theme_options['font_source'] == "2")) {
		if ( (isset($shopkeeper_theme_options['font_google_code'])) && ($shopkeeper_theme_options['font_google_code'] != "") ) {
			wp_enqueue_style('shopkeeper-font_google_code', $shopkeeper_theme_options['font_google_code'], array(), '1.0', 'all' );
		}
	}		

	wp_enqueue_style('shopkeeper-default-style', get_stylesheet_uri());

}
add_action( 'wp_enqueue_scripts', 'shopkeeper_styles', 99 );



// admin area
function shopkeeper_admin_styles() {
    if ( is_admin() ) {
        
		wp_enqueue_style("wp-color-picker");
		wp_enqueue_style("shopkeeper_admin_styles", get_template_directory_uri() . "/css/wp-admin-custom.css", false, "1.0", "all");
		
		if (class_exists('WPBakeryVisualComposerAbstract')) { 
			wp_enqueue_style('shopkeeper_visual_composer', get_template_directory_uri() .'/css/visual-composer.css', false, "1.0", 'all');
			wp_enqueue_style('shopkeeper-font-linea-arrows', get_template_directory_uri() . '/inc/fonts/linea-fonts/arrows/styles.css', false, '1.0', 'all' );
			wp_enqueue_style('shopkeeper-font-linea-basic', get_template_directory_uri() . '/inc/fonts/linea-fonts/basic/styles.css', false, '1.0', 'all' );
			wp_enqueue_style('shopkeeper-font-linea-basic_elaboration', get_template_directory_uri() . '/inc/fonts/linea-fonts/basic_elaboration/styles.css', false, '1.0', 'all' );
			wp_enqueue_style('shopkeeper-font-linea-ecommerce', get_template_directory_uri() . '/inc/fonts/linea-fonts/ecommerce/styles.css', false, '1.0', 'all' );
			wp_enqueue_style('shopkeeper-font-linea-music', get_template_directory_uri() . '/inc/fonts/linea-fonts/music/styles.css', false, '1.0', 'all' );
			wp_enqueue_style('shopkeeper-font-linea-software', get_template_directory_uri() . '/inc/fonts/linea-fonts/software/styles.css', false, '1.0', 'all' );
			wp_enqueue_style('shopkeeper-font-linea-weather', get_template_directory_uri() . '/inc/fonts/linea-fonts/weather/styles.css', false, '1.0', 'all' );
		}
    }
}
add_action( 'admin_enqueue_scripts', 'shopkeeper_admin_styles' );







/******************************************************************************/
/*************************** Enqueue scripts **********************************/
/******************************************************************************/

// frontend
function shopkeeper_scripts() {
	
	global $shopkeeper_theme_options;
	
	/** In Header **/
	
	// wp_enqueue_script('shopkeeper-google-maps', 'https://maps.googleapis.com/maps/api/js', array(), '1.0', FALSE);
	
	if (isset($shopkeeper_theme_options['font_source']) && ($shopkeeper_theme_options['font_source'] == "3")) {
		if ( (isset($shopkeeper_theme_options['font_typekit_kit_id'])) && ($shopkeeper_theme_options['font_typekit_kit_id'] != "") ) {
			wp_enqueue_script('shopkeeper-font_typekit', '//use.typekit.net/'.$shopkeeper_theme_options['font_typekit_kit_id'].'.js', array(), NULL, FALSE );
			wp_enqueue_script('shopkeeper-font_typekit_exec', get_template_directory_uri() . '/js/components/typekit.js', array(), NULL, FALSE );
		}
	}	
	
	/** In Footer **/
	if( is_rtl() ){
			wp_enqueue_script('shopkeeper-scripts-dist-rtl', get_template_directory_uri() . '/js/scripts-dist-rtl.js', array('jquery'), '1.0', TRUE);
	}
	else{	wp_enqueue_script('shopkeeper-scripts-dist', get_template_directory_uri() . '/js/scripts-dist.js', array('jquery'), '1.0', TRUE);	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'shopkeeper_scripts', 99 );



// admin area
function shopkeeper_admin_scripts() {
    if ( is_admin() ) {
        global $post_type;
		
		if ( (isset($_GET['post_type']) && ($_GET['post_type'] == 'portfolio')) || ($post_type == 'portfolio')) :
			wp_enqueue_script("shopkeeper_admin_scripts", get_template_directory_uri() . "/js/components/wp-admin-portfolio.js", array('wp-color-picker'), false, "1.0");
		endif;
		
    }
}
add_action( 'admin_enqueue_scripts', 'shopkeeper_admin_scripts' );





/*********************************************************************************************/
/******************************** Tweak WP admin bar  ****************************************/
/*********************************************************************************************/

add_action( 'wp_head', 'shopkeeper_override_toolbar_margin', 11 );
function shopkeeper_override_toolbar_margin() {	
	if ( is_admin_bar_showing() ) {
		?>
			<style type="text/css" media="screen">
				@media only screen and (max-width: 63.9375em) {
					html { margin-top: 0 !important; }
					* html body { margin-top: 0 !important; }
				}
			</style>
		<?php 
	}
}


/******************************************************************************/
/****** Register widgetized area and update sidebar with default widgets ******/
/******************************************************************************/

function shopkeeper_widgets_init() {
	
	$sidebars_widgets = wp_get_sidebars_widgets();	
	$footer_area_widgets_counter = "0";	
	if (isset($sidebars_widgets['footer-widget-area'])) $footer_area_widgets_counter  = count($sidebars_widgets['footer-widget-area']);
	
	switch ($footer_area_widgets_counter) {
		case 0:
			$footer_area_widgets_columns ='large-12';
			break;
		case 1:
			$footer_area_widgets_columns ='large-12';
			break;
		case 2:
			$footer_area_widgets_columns ='large-6';
			break;
		case 3:
			$footer_area_widgets_columns ='large-4';
			break;
		case 4:
			$footer_area_widgets_columns ='large-3';
			break;
		default:
			$footer_area_widgets_columns ='large-3';
	}
	
	//default sidebar
	register_sidebar(array(
		'name'          => __( 'Sidebar', 'shopkeeper' ),
		'id'            => 'default-sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	));
	
	//footer widget area
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area', 'shopkeeper' ),
		'id'            => 'footer-widget-area',
		'before_widget' => '<div class="' . $footer_area_widgets_columns . ' columns"><aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside></div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	//catalog widget area
	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'shopkeeper' ),
		'id'            => 'catalog-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	//offcanvas widget area
	register_sidebar( array(
		'name'          => __( 'Right Offcanvas Sidebar', 'shopkeeper' ),
		'id'            => 'offcanvas-widget-area',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'shopkeeper_widgets_init' );





/******************************************************************************/
/****** Remove Woocommerce prettyPhoto ***********************************************/
/******************************************************************************/

add_action( 'wp_enqueue_scripts', 'shopkeeper_remove_woo_lightbox', 99 );
function shopkeeper_remove_woo_lightbox() {
    wp_dequeue_script('prettyPhoto-init');
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



/******************************************************************************/
/* Change breadcrumb separator on woocommerce page ****************************/
/******************************************************************************/

add_filter( 'woocommerce_breadcrumb_defaults', 'jk_change_breadcrumb_delimiter' );
function jk_change_breadcrumb_delimiter( $defaults ) {
    // Change the breadcrumb delimeter from '/' to '>'  
    $defaults['delimiter'] = ' &gt; ';
    return $defaults;
}







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
add_action( 'redux/page/shopkeeper_theme_options/enqueue', 'newIconFont' );




/******************************************************************************/
/* Remove Admin Bar - Only display to administrators **************************/
/******************************************************************************/

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		show_admin_bar(false);
	}
}




/******************************************************************************/
/* WooCommerce Update Number of Items in the cart *****************************/
/******************************************************************************/

add_action('woocommerce_ajax_added_to_cart', 'shopkeeper_ajax_added_to_cart');
function shopkeeper_ajax_added_to_cart() {

	add_filter('add_to_cart_fragments', 'shopkeeper_shopping_bag_items_number');
	function shopkeeper_shopping_bag_items_number( $fragments ) 
	{
		global $woocommerce;
		ob_start(); ?>

		<script>
		(function($){
			$('.shopping-bag-button').trigger('click');
		})(jQuery);
		</script>
        
        <span class="shopping_bag_items_number"><?php echo esc_html(WC()->cart->get_cart_contents_count()); ?></span>

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
		'posts_per_page' => '6',
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
		//return '<div><img data-src="' . $image_src[0] . '" class="lazyOwl"></div>';
	} elseif ( wc_placeholder_img_src() ) {
		return wc_placeholder_img( $size );
	}
}






/******************************************************************************/
/* WooCommerce Wrap Oembed Stuff **********************************************/
/******************************************************************************/
add_filter('embed_oembed_html', 'shopkeeper_embed_oembed_html', 99, 4);
function shopkeeper_embed_oembed_html($html, $url, $attr, $post_id) {
	return '<div class="video-container">' . $html . '</div>';
}




/******************************************************************************/
/* Share Product **************************************************************/
/******************************************************************************/

function getbowtied_single_share_product() {
    global $post, $product, $shopkeeper_theme_options;
    if ( (isset($shopkeeper_theme_options['sharing_options'])) && ($shopkeeper_theme_options['sharing_options'] == "1" ) ) :
	?>

    <div class="product_socials_wrapper show-share-text-on-mobiles">
		<div class="row">
			<div class="large-12 columns">
				
				<div class="share-product-text">
					<?php _e('Share this product', 'shopkeeper' ); ?>
				</div><!--.share-product-text-->
                
                <?php
					//Get the Thumbnail URL
					$src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), false, '' );
				?>
				
				<div class="product_socials_wrapper_inner">
					<a href="//www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank" class="social_media social_media_facebook"><i class="fa fa-facebook"></i></a>
					<a href="//twitter.com/share?url=<?php the_permalink(); ?>" target="_blank" class="social_media social_media_twitter"><i class="fa fa-twitter"></i></a>
					<a href="//plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank" class="social_media social_media_googleplus"><i class="fa fa-google-plus"></i></a>
					<a href="//pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>&amp;media=<?php echo esc_url($src[0]) ?>&amp;description=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="social_media social_media_pinterest"><i class="fa fa-pinterest"></i></a>
				</div><!--.product_socials_wrapper_inner-->
				
			</div>
		</div>
	</div><!--.product_socials_wrapper-->

<?php
    endif;
}
add_filter( 'getbowtied_woocommerce_before_single_product_summary_data_tabs', 'getbowtied_single_share_product', 50 );





/******************************************************************************/
/****** WooCommerce Wishlist YITH Ajax Hook ***********************************/
/******************************************************************************/

/*function wishlist_shortcode_offcanvas() {
    echo do_shortcode('[shopkeeper_yith_wcwl_wishlist]');
    die;
}
add_action('wp_ajax_wishlist_shortcode', 'wishlist_shortcode_offcanvas');
add_action('wp_ajax_nopriv_wishlist_shortcode', 'wishlist_shortcode_offcanvas');*/



/******************************************************************************/
/****** Set woocommerce images sizes ******************************************/
/******************************************************************************/

/**
 * Hook in on activation
 */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'shopkeeper_woocommerce_image_dimensions', 1 );

/**
 * Define image sizes
 */
function shopkeeper_woocommerce_image_dimensions() {
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
		'crop'		=> 1 		// false
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog ); 		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

if ( ! function_exists('shopkeeper_woocommerce_image_dimensions') ) :
	function shopkeeper_woocommerce_image_dimensions() {
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
	add_action( 'after_switch_theme', 'shopkeeper_woocommerce_image_dimensions', 1 );
endif;

if ( ! isset( $content_width ) ) $content_width = 900;

/******************************************************************************/
/****** Remove customize link from admin bar***********************************/
/******************************************************************************/
add_action( 'admin_bar_menu', 'remove_customize_link', 999 );
function remove_customize_link( $wp_admin_bar ) 
{
    $wp_admin_bar->remove_menu( 'customize' );
}

/******************************************************************************/
/****** Limit number of cross-sells *******************************************/
/******************************************************************************/
add_filter('woocommerce_cross_sells_total', 'cartCrossSellTotal');
function cartCrossSellTotal($total) {
	$total = '2';
	return $total;
}

//delete_option('getbowtied_tools_force_activate');

/******************************************************************************/
/****** Force GetbowtiedTools Update*******************************************/
/******************************************************************************/
if ( ! class_exists( 'GetbowtiedToolsUpdater') ) {
	require('inc/plugins/plugin-updater.php');

	$plugin_update = new GetbowtiedToolsUpdater('1.0.1', 'https://my.getbowtied.com/getbowtied-tools/update.php', 'getbowtied-tools/index.php');
}

/******************************************************************************/
/****** Custom Sale label *****************************************************/
/******************************************************************************/

add_filter('woocommerce_sale_flash', 'woocommerce_custom_sale_tag_sale_flash', 10, 3);
function woocommerce_custom_sale_tag_sale_flash($original, $post, $product) {
	global $shopkeeper_theme_options;
	echo '<span class="onsale">'.$shopkeeper_theme_options['sale_label'].'</span>';
}
