<?php

/*-----------------------------------------------------------------------------------*/
/* Slightly Modified Options Framework
/*-----------------------------------------------------------------------------------*/
require_once ('admin/index.php');


/*-----------------------------------------------------------------------------------*/
/* Sets up theme defaults and registers the various WordPress features that
 * Theme supports.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_theme_setup' ) ) {	
	function ct_theme_setup(){

		// Makes theme available for translation.
		load_theme_textdomain( 'color-theme-framework', get_template_directory() . '/languages' );

		// This theme supports a variety of post formats.
		add_theme_support( 'post-formats', array( 'image', 'gallery', 'video', 'audio' ) );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// This theme uses a custom image size for featured images, displayed on "standard" posts.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// This automatically adds the relevant feed links everywhere on the whole site.
		add_theme_support( 'automatic-feed-links' );

		register_nav_menus( array(
			'main_menu' => __( 'main navigation' , 'color-theme-framework' )
			)
		);

		// Registers a new image sizes.
		add_image_size( 'slider-thumb', 560, 316, true );
		add_image_size( 'single-post-thumb', 848, 478, true ); //cropped single
		add_image_size( 'carousel-thumb', 360, 203, true ); // carousel thumbnails
		add_image_size( 'small-thumb', 75, 75, true ); // small thumbnail
		
	}
}
add_action('after_setup_theme', 'ct_theme_setup');


/*-----------------------------------------------------------------------------------*/
/*  WOOCOMMERCE
/*-----------------------------------------------------------------------------------*/
add_theme_support( 'woocommerce' );
define('WOOCOMMERCE_USE_CSS', false);

add_action('woocommerce_before_shop_loop_item_title', 'ct_woocommerce_thumbnail', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
function ct_woocommerce_thumbnail() {
	global $product, $woocommerce;

	$size = 'shop_catalog';

	$id = get_the_ID();
	$gallery = get_post_meta($id, '_product_image_gallery', true);
	$attachment_image = '';
	if(!empty($gallery)) {
		$gallery = explode(',', $gallery);
		$first_image_id = $gallery[0];
		$attachment_image = wp_get_attachment_image($first_image_id , $size, false, array('class' => 'hover-image'));
	}
	$thumb_image = get_the_post_thumbnail($id , $size);

	/*echo $attachment_image;*/
	echo $thumb_image;

	$in_cart = ct_is_in_cart();
	if($in_cart) {
				echo '<div class="product-added" style="display:block">';
				echo '<i class="icon icon-check"></i>';
				echo '</div>';

				echo '<div class="overlay-added-image"></div>';
			
	} 
}


if ( ! function_exists( 'is_woocommerce_activated' ) ) {
	function is_woocommerce_activated() {
		if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
	}
}


if ( !function_exists( 'ct_is_in_cart' ) ) {
	function ct_is_in_cart() {
		global $product, $woocommerce;

		$items_in_cart = array();

		if($woocommerce->cart->get_cart() && is_array($woocommerce->cart->get_cart())) {
			foreach($woocommerce->cart->get_cart() as $cart) {
				$items_in_cart[] = $cart['product_id'];
			}
		}

		$id = get_the_ID();
		$in_cart = in_array($id, $items_in_cart);

		return $in_cart;
	}
}

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);



/* Theme Activation Hook */
add_action('admin_init','ct_theme_activation');
function ct_theme_activation()
{
	global $pagenow;
	if(is_admin() && 'themes.php' == $pagenow && isset($_GET['activated'])) 
	{
		update_option('shop_catalog_image_size', array('width' => 500, 'height' => 500, 0));
		update_option('shop_single_image_size', array('width' => 770, 'height' => '', 0));
		update_option('shop_thumbnail_image_size', array('width' => 120, 'height' => 120, 0));
	}
}

if (!function_exists('ct_get_shop_product_excerpt')) {
	function ct_get_shop_product_excerpt() {
		global $post, $ct_options;
			
			$excerpt_length = $ct_options['ct_shop_excerpt_lenght'];

			if ( !empty( $excerpt_length ) ) :

				if ( $post->post_excerpt ) {
					echo '<div itemprop="description" class="shop-product-description">';
						echo strip_tags( mb_substr( $post->post_excerpt, 0, $excerpt_length ) ) . '...';
					echo '</div>';				
				}

			endif;	
	}
}

// Lets create the function to house our form
function woocommerce_catalog_page_ordering() {
?>


<?php
} 
// now we set our cookie if we need to
function dl_sort_by_page($count) {
  if (isset($_COOKIE['shop_pageResults'])) { // if normal page load with cookie
     $count = $_COOKIE['shop_pageResults'];
  }
  if (isset($_GET['woocommerce-sort-by-columns'])) { //if form submitted
    setcookie('shop_pageResults', $_GET['woocommerce-sort-by-columns'], time()+1209600, '/', 'beadsnwire.lukeseall.co.uk/', false); //this will fail if any part of page has been output- hope this works!
    $count = $_GET['woocommerce-sort-by-columns'];
  }
  // else normal page load and no cookie
  return $count;
}
//add_filter('loop_shop_per_page','dl_sort_by_page');
//add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_page_ordering', 20 );

/**
* WooCommerce Extra Feature
* --------------------------
*
* Change number of related products on product page
* Set your own value for 'posts_per_page'
*
*/
function woo_related_products_limit() {
	global $product, $ct_options;

	$posts_per_page = $ct_options['ct_shop_posts_per_page'];	
	$orderby = 'date';
	$related = $product->get_related($posts_per_page);
	$args = array(
		'post_type' => 'product',
		'no_found_rows' => 1,
		'posts_per_page' => $posts_per_page,
		'ignore_sticky_posts' => 1,
		'orderby' => $orderby,
		'post__in' => $related,
		'post__not_in' => array($product->id)
		);
	return $args;
}
add_filter( 'woocommerce_related_products_args', 'woo_related_products_limit' );



/*-----------------------------------------------------------------------------------*/
/* TGM Plugin Activation
/*-----------------------------------------------------------------------------------*/
require_once('includes/class-tgm-plugin-activation.php');
add_action('tgmpa_register', 'ct_register_required_plugins');

function ct_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'AJAX Thumbnail Rebuild', // The plugin name
			'slug'     				=> 'ajax-thumbnail-rebuild', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		),
		array(
			'name'     				=> 'Meta Box', // The plugin name
			'slug'     				=> 'meta-box', // The plugin slug (typically the folder name)
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		),
		array(
			'name'     				=> 'WooCommerce Product Archive Customiser', // The plugin name
			'slug'     				=> 'woocommerce-product-archive-customiser', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		),
		array(
			'name'     				=> 'CT Shortcodes', // The plugin name
			'slug'     				=> 'ct-shortcodes', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/includes/plugins/ct-shortcodes.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		)
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'id'           => 'intouch-tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );

}



/*-----------------------------------------------------------------------------------*/
/* Convert Hex Color to RGB
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_hex2rgb' ) ) {
	function ct_hex2rgb($hex) {
		$hex = str_replace("#", "", $hex);

		if(strlen($hex) == 3) {
			$r = hexdec(substr($hex,0,1).substr($hex,0,1));
			$g = hexdec(substr($hex,1,1).substr($hex,1,1));
			$b = hexdec(substr($hex,2,1).substr($hex,2,1));
		} else {
			$r = hexdec(substr($hex,0,2));
			$g = hexdec(substr($hex,2,2));
			$b = hexdec(substr($hex,4,2));
		}
		
		$rgb = array($r, $g, $b);
		//return implode(",", $rgb); // returns the rgb values separated by commas
		return $rgb; // returns an array with the rgb values
	}
}

/*-----------------------------------------------------------------------------------*/
/* Sticky Menu
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_sticky_menu' ) ) {
	function ct_sticky_menu() {
		global $ct_options;
		$sticky_menu = $ct_options['ct_sticky_menu'];
		$header_background = $ct_options['ct_header_background'];
		$header_bg_type = $ct_options['ct_header_bg_type'];

		$rgb = ct_hex2rgb($header_background);
		$rgba = "rgba(" . $rgb[0] . "," . $rgb[1] . "," . $rgb[2] . "," . "0.9)";
		$rgba_default = "rgba(" . $rgb[0] . "," . $rgb[1] . "," . $rgb[2] . "," . "1)";
		if ( $header_bg_type != 'Color' ) { $rgba_default = 'none'; $header_background = 'none'; }

		if ( $sticky_menu ) { ?>
			<script type="text/javascript">
			/* <![CDATA[ */
				jQuery.noConflict()(function($){
					$(document).ready(function(){

						var menuheight = $('.ct-menu-container').height();

						var sticky_navigation_offset_top = $('.ct-menu-container').offset().top;
						var sticky_navigation = function(){
							var scroll_top = $(window).scrollTop(); // our current vertical position from the top
		
							if (scroll_top > sticky_navigation_offset_top) { 
								<?php if ( !is_admin_bar_showing() ) : ?>
									$('body').css({ 'padding-top': menuheight });
									$('.ct-menu-container').css({ 'padding-top':0, 'padding-bottom':0, 'position': 'fixed', 'top':0, 'left':0, 'z-index':201, 'width':'100%', 'box-shadow': '2px 2px 6px rgba(0,0,0,.2)', 'background-color': '#f5f5f5'});
									$('.sf-menu > li > a').attr('style','padding-top:15px !important; padding-bottom:15px !important');
								<?php else : ?>
									$('body').css({ 'padding-top': menuheight });
									$('.ct-menu-container').css({ 'padding-top':0, 'padding-bottom':0, 'position': 'fixed', 'top':28, 'left':0, 'z-index':201, 'width':'100%', 'box-shadow': '2px 2px 6px rgba(0,0,0,.2)', 'background-color': '#f5f5f5'});
									$('.sf-menu > li > a').attr('style','padding-top:15px !important; padding-bottom:15px !important');
								<?php endif; ?>
							} else {
								$('.ct-menu-container').css({ 'padding-top':0, 'padding-bottom':0, 'top' : 0, 'position': 'relative', 'z-index':201, 'box-shadow': 'none', 'background-color': 'transparent' }); 
								$('.sf-menu > li > a').css({ 'padding-top': '1.64em', 'padding-bottom': '1.64em' });
								$('body').css({ 'padding-top': 0 });
							}
						};

						// run our function on load
						sticky_navigation();

						// and run it again every time you scroll
						$(window).scroll(function() {
							sticky_navigation();
						});
					});
				});
			/* ]]> */   
			</script>
		<?php
		}
	}
	add_action('wp_footer', 'ct_sticky_menu');
}


/*
*	-------------------------------------------------------------------------------------------------------
*	Add Google Analytics
*	-------------------------------------------------------------------------------------------------------
*/

if ( !function_exists ( 'ct_func_google' ) ) {
	function ct_func_google() {
		global $ct_options;
		echo stripslashes ( $ct_options['ct_google_analytics'] );
	}
}

add_action('wp_enqueue_scripts', 'ct_func_google');


/*-----------------------------------------------------------------------------------*/
/* To add backwards compatibility for older versions
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	function ct_render_title() {
?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php
	}
	add_action( 'wp_head', 'ct_render_title' );
}


/*-----------------------------------------------------------------------------------*/
/* Registers our theme widget areas and sidebars
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_widgets_init' ) ) {
function ct_widgets_init() {

	register_sidebar(array(
		'name' => 'Homepage Sidebar',
		'id' => 'ct_homepage_sidebar',
		'description' => __( 'Appears on the Sidebar of the Homepage', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));
	
	register_sidebar(array(
		'name' => 'Homepage Header',
		'id' => 'ct_homepage_header',
		'description' => __( 'Appears in the header of the Home page (above main menu)', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Homepage Top',
		'id' => 'ct_homepage_top',
		'description' => __( 'Appears on the top of the Homepage (below main menu)', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Homepage Slider',
		'id' => 'ct_homepage_slider',
		'description' => __( 'Appears on the Slider area of the Homepage', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Homepage Main',
		'id' => 'ct_homepage_main',
		'description' => __( 'Appears on the Main area of the Homepage', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Homepage Main-Right',
		'id' => 'ct_homepage_main_r',
		'description' => __( 'Appears on the Main-Right area of the Homepage', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Homepage Sidebar',
		'id' => 'ct_homepage_sidebar',
		'description' => __( 'Appears on the Sidebar of the Homepage', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Homepage Bottom',
		'id' => 'ct_homepage_bottom',
		'description' => __( 'Appears on the Bottom area of the Homepage', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Post Page Header',
		'id' => 'ct_single_header',
		'description' => __( 'Appears in the header of the Post page (above main menu)', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Post Page Top',
		'id' => 'ct_single_top',
		'description' => __( 'Appears on the Post page (very top)', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name'			=> 'Post Page Sidebar',
		'id'			=> 'ct_single_sidebar',
		'description'	=> __( 'Appears on the Post page', 'color-theme-framework' ),
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Category Page Header',
		'id' => 'ct_category_header',
		'description' => __( 'Appears in the header of the Category page (above main menu)', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Category Page Top',
		'id' => 'ct_category_top',
		'description' => __( 'Appears on the Category page (very top)', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name'			=> 'Category Page Sidebar',
		'id'			=> 'ct_category_sidebar',
		'description'	=> __( 'Appears on the Category (tag, archive, etc.) page', 'color-theme-framework' ),
		'before_widget'	=> '<aside id="%1$s" class="widget %2$s">',
		'after_widget'	=> '</aside>',
		'before_title'	=> '<h3 class="widget-title">',
		'after_title'	=> '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Page Header',
		'id' => 'ct_page_header',
		'description' => __( 'Appears in the header of the Page (above main menu)', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Page Top',
		'id' => 'ct_page_top',
		'description' => __( 'Appears in the Top of the Page', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Page Sidebar',
		'id' => 'ct_page_sidebar',
		'description' => __( 'Appears on the Pages', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Blog Page Header',
		'id' => 'ct_blog_header',
		'description' => __( 'Appears in the header of the Blog Page (above main menu)', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Blog Page Top',
		'id' => 'ct_blog_top',
		'description' => __( 'Appears in the Top of the Blog Page', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Blog Page Sidebar',
		'id' => 'ct_blog_sidebar',
		'description' => __( 'Appears on the Blog Page', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Footer',
		'id' => 'ct_footer',
		'description' => __( 'Appears on the Footer area', 'color-theme-framework' ),
		'before_widget' => '<div class="col-lg-3"><aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside></div><!-- .col-lg-3 -->',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>',
	));

	register_sidebar(array(
		'name' => 'Woocommerce Sidebar',
		'id' => 'ct_woocommerce_sidebar',
		'description' => __( 'Appears on the Woocommerce Shop', 'color-theme-framework' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '<span class="bottom-triangle"></span></h3>'
	));
}
add_action( 'widgets_init', 'ct_widgets_init' );
}


if ( !isset( $content_width ) ) 
	$content_width = 980;


/*-----------------------------------------------------------------------------------*/
/*  Adding CSS gradient-based color picker - Iris
/*-----------------------------------------------------------------------------------*/
if ( is_admin() ) {
	add_action( 'admin_enqueue_scripts', 'ct_enqueue_color_picker' );

	function ct_enqueue_color_picker( $hooksuffix ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Add Thumbnails in Manage Posts/Pages List
/*-----------------------------------------------------------------------------------*/
// Add the posts and pages columns filter. They can both use the same function.
add_filter('manage_posts_columns', 'ct_add_post_thumbnail_column', 5);
add_filter('manage_pages_columns', 'ct_add_post_thumbnail_column', 5);

// Add the column
function ct_add_post_thumbnail_column($cols){
  $cols['tcb_post_thumb'] = __('Featured', 'color-theme-framework');
  return $cols;
}

// Hook into the posts an pages column managing. Sharing function callback again.
add_action('manage_posts_custom_column', 'ct_display_post_thumbnail_column', 5, 2);
add_action('manage_pages_custom_column', 'ct_display_post_thumbnail_column', 5, 2);

// Grab featured-thumbnail size post thumbnail and display it.
function ct_display_post_thumbnail_column($col, $id){
  switch($col){
	case 'tcb_post_thumb':
	  if( function_exists('the_post_thumbnail') )
		echo the_post_thumbnail( 'small-thumb' );
	  else
		echo 'Not supported in theme';
	  break;
  }
}


/*-----------------------------------------------------------------------------------*/
/*  Change excerpt length
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_new_excerpt_length' ) ) {
	function ct_new_excerpt_length($length) {
		return 999;
	}
}
add_filter('excerpt_length', 'ct_new_excerpt_length');


/*-----------------------------------------------------------------------------------*/
/*  Change excerpt more string
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_new_excerpt_more' ) ) {
	function ct_new_excerpt_more($more) {
		return '...';
	}
}
add_filter('excerpt_more', 'ct_new_excerpt_more');


/*-----------------------------------------------------------------------------------*/
/*  Show Featured Images in RSS Feed
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_featuredtorss' ) ) {
	function ct_featuredtorss($content) {
		global $post;
		if ( has_post_thumbnail( $post->ID ) ){
			$content = '<div>' . get_the_post_thumbnail( $post->ID, 'thumbnail', array( 'style' => 'margin-bottom: 15px;' ) ) . '</div>' . $content;
		}
		return $content;
	}
}
add_filter('the_excerpt_rss', 'ct_featuredtorss');
add_filter('the_content_feed', 'ct_featuredtorss');


/*-----------------------------------------------------------------------------------*/
/*  Enable Shortcodes In Sidebar Widgets
/*-----------------------------------------------------------------------------------*/
add_filter('widget_text', 'do_shortcode');


/*-----------------------------------------------------------------------------------*/
/*  Enqueues scripts for front-end
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_scripts_method' ) ) {
function ct_scripts_method() {

	//enqueue jquery
	wp_enqueue_script('jquery');

	if( !is_admin() ) {
	
		global $ct_options;
		$is_retinajs = $ct_options['ct_is_retinajs'];
		if ( isset($ct_options['ct_is_bootstrapjs']) ) $is_bootstrapjs = $ct_options['ct_is_bootstrapjs']; else $is_bootstrapjs = 1;

		if ( $is_retinajs ) {
			/* Retina */
			wp_register_script('ct-retina-js',get_template_directory_uri().'/js/retina.js',false, null , true);
			wp_enqueue_script('ct-retina-js',array('jquery'));
		}

		/* Prettyphoto */
		wp_register_script('ct-prettyphoto-js',get_template_directory_uri().'/js/jquery.prettyphoto.js',false, null , true);
		wp_enqueue_script('ct-prettyphoto-js',array('jquery'));

		if ( $is_bootstrapjs ) {
			/* Bootstrap */
			wp_register_script('ct-jquery-bootstrap',get_template_directory_uri().'/js/bootstrap.min.js',false, null , true);
			wp_enqueue_script('ct-jquery-bootstrap',array('jquery'));
		}


		/* IE Fix JS */
		wp_enqueue_script( 'porada-html5shiv-js', '//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js', array( 'jquery' ), '', true );
		wp_script_add_data( 'porada-html5shiv-js', 'conditional', 'lt IE 9' );

		wp_enqueue_script( 'porada-respond-js', '//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js', array( 'jquery' ), '', true );
		wp_script_add_data( 'porada-respond-js', 'conditional', 'lt IE 9' );


		/* Custom JS */
		wp_register_script('ct-custom-js',get_template_directory_uri().'/js/custom.js',false, null , true);
		wp_enqueue_script('ct-custom-js',array('jquery'));

    	$ct_localization_array = array(	'go_to'	=>  __('MENU', 'color-theme-framework') );
		wp_localize_script( 'ct-custom-js', 'ct_localization', $ct_localization_array );

		/* Post Like JS */	
		wp_register_script( 'ct-postlike-js', get_template_directory_uri() . '/js/post-like.js', false, null , true );
		wp_enqueue_script( 'ct-postlike-js', array( 'jquery' ) );

		wp_localize_script( 'ct-postlike-js', 'ajax_var', array(
			'url' => admin_url( 'admin-ajax.php' ),
			'nonce' => wp_create_nonce( 'ajax-nonce' )
		));

		$subsets = 'latin,latin-ext';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => 'Maven+Pro',
			'subset' => $subsets,
		);
		wp_enqueue_style( 'ct-maven-pro-fonts', esc_url( add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" ) ), array(), null );		

		/*
		* Adds JavaScript to pages with the comment form to support
		* sites with threaded comments (when in use).
		*/
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
			wp_enqueue_script( 'comment-reply' );

	} /* End Include jQuery Libraries */
  }
}

add_action('wp_enqueue_scripts', 'ct_scripts_method');


/*-----------------------------------------------------------------------------------*/
/*  Enqueues styles for front-end
/*-----------------------------------------------------------------------------------*/
if ( !function_exists ('ct_header_styles' ) ) {
	function ct_header_styles() {

		global $wp_styles, $ct_options;
		$responsive_layout = $ct_options['ct_responsive_layout'];

		wp_enqueue_style( 'bootstrap-main-style',get_template_directory_uri().'/css/bootstrap.min.css','','','all');
		wp_enqueue_style( 'font-awesome-style',get_template_directory_uri().'/css/font-awesome.min.css','','','all');
		wp_enqueue_style( 'ct-style',get_stylesheet_directory_uri().'/style.css','','','all');

		if ( class_exists('Woocommerce') ) {
			wp_enqueue_style( 'ct-woocommerce', get_template_directory_uri() . '/css/woocommerce.css', '', '', 'all' );
		}

		if ( $responsive_layout ) {
			wp_enqueue_style( 'ct-rwd-style',get_template_directory_uri().'/css/rwd-styles.css','','','all');
		}
		wp_enqueue_style( 'options-css-style',get_template_directory_uri().'/css/options.css','','','all');
	}
}

add_action('wp_enqueue_scripts', 'ct_header_styles'); 


/*-----------------------------------------------------------------------------------*/
/* Add Google Fonts for Headings 
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_custom_fonts' ) ) {
		function ct_custom_fonts() {
			global $ct_options;
		
			$google_fonts = stripslashes( $ct_options['ct_google_fonts']['face'] );
			$menu_google_fonts = stripslashes( $ct_options['ct_menu_google_fonts']['face'] );
			$use_menu_gf = stripslashes( $ct_options['ct_use_menu_gf'] );

			if ( !empty( $google_fonts ) ) {
				echo '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=' . str_replace(" ", "%20", $google_fonts) . ':300,400,400italic,700,700italic&amp;subset=latin,cyrillic-ext,cyrillic,latin-ext" type="text/css" />';								
				echo '<style type="text/css">h1,h2,h3,h4,h5,h6,.ct-google-font,.ct-google-font a { ';
				echo 'font-family: "' . $google_fonts .'", Helvetica, Arial, sans-serif';
				echo '}</style>';
			}

			if ( $use_menu_gf ) {
				if ( $menu_google_fonts != $google_fonts ) {
					echo '<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=' . str_replace(" ", "%20", $menu_google_fonts) . ':300,400,400italic,700,700italic&amp;subset=latin,cyrillic-ext,cyrillic,latin-ext" type="text/css" />';								
					echo '<style type="text/css">.sf-menu a { ';
					echo 'font-family: "' . $menu_google_fonts .'", Helvetica, Arial, sans-serif';
					echo '}</style>';
				} else {
					echo '<style type="text/css">.sf-menu a { ';
					echo 'font-family: "' . $menu_google_fonts .'", Helvetica, Arial, sans-serif';
					echo '}</style>';
				}
			}
	}
}
add_action('wp_head','ct_custom_fonts');


/*-----------------------------------------------------------------------------------*/
/*  Fav and touch icons
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_fav_icons' ) ) {
	function ct_fav_icons() {
		global $ct_options;
			
		echo "<!-- Fav and touch icons -->\n";
		echo "<link rel=\"shortcut icon\" href=\"" . stripslashes( $ct_options['ct_custom_favicon'] ) . "\">\n";
		echo '<link href="' . stripslashes( $ct_options['ct_ios_60_upload'] ) . '" rel="apple-touch-icon" />';
		echo '<link href="' . stripslashes( $ct_options['ct_ios_76_upload'] ) . '" rel="apple-touch-icon" sizes="76x76" />';
		echo '<link href="' . stripslashes( $ct_options['ct_ios_120_upload'] ) . '" rel="apple-touch-icon" sizes="120x120" />';
		echo '<link href="' . stripslashes( $ct_options['ct_ios_152_upload'] ) . '" rel="apple-touch-icon" sizes="152x152" />';
		echo "<!--[if IE 7]>\n";
		echo "<link rel=\"stylesheet\" href=\"" . get_template_directory_uri() . "/css/font-awesome-ie7.min.css\">\n";
		echo "<![endif]-->\n";
	}
}
add_action('wp_enqueue_scripts','ct_fav_icons');


/*-----------------------------------------------------------------------------------*/
/* Add IE conditional fix to header 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_ie_fix' ) ) {
	function ct_ie_fix () {
		echo "<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->\n";
		echo "<!--[if lt IE 9]>\n";
		echo "<script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>\n";
		echo "<script src=\"" . get_template_directory_uri() . "/js/respond.min.js\"></script>\n";
		echo "<![endif]-->\n";
	}
}
//add_action('wp_enqueue_scripts', 'ct_ie_fix');


/*-----------------------------------------------------------------------------------*/
/* Enable all HTML Tags in Profile Bios
/*-----------------------------------------------------------------------------------*/
//disable WordPress sanitization to allow more than just $allowedtags from /wp-includes/kses.php
remove_filter('pre_user_description', 'wp_filter_kses');
//add sanitization for WordPress posts
add_filter( 'pre_user_description', 'wp_filter_post_kses');


/*-----------------------------------------------------------------------------------*/
/* Set an option for a cURL transfer
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_curl_subscribers_text_counter' ) ) {
	function ct_curl_subscribers_text_counter( $xml_url ) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $xml_url);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Youtube counter
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_yt_count' ) ) {
	function ct_yt_count( $username ) { 
		try {
			@$xmlData = @ct_curl_subscribers_text_counter('http://gdata.youtube.com/feeds/api/users/' . strtolower($username)); 
			@$xmlData = str_replace('yt:', 'yt', $xmlData); 
			@$xml = new SimpleXMLElement($xmlData); 
			@$ytCount['yt_count'] = ( string ) $xml->ytstatistics['subscriberCount'];
			@$ytCount['page_url'] = "http://www.youtube.com/user/".$username;
		} catch (Exception $e) {
			$ytCount['yt_count'] = 0;
			$ytCount['page_url'] = "http://www.youtube.com";
		}
		return($ytCount); 
	} 
}


/*-----------------------------------------------------------------------------------*/
/* Twitter counter
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_twitter_count' ) ) {
	function ct_twitter_count( $twitter_id ) {
		try {
			@$url = "https://api.twitter.com/1/users/show.json?screen_name=".$twitter_id;
			@$reply = json_decode(@ct_curl_subscribers_text_counter($url));
			@$twitter['followers_count'] = $reply->followers_count;
		} catch (Exception $e) {
			$twitter['followers_count'] = '0';
		}
		return $twitter;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get Related Post function 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_related_posts' ) ) {
	function ct_get_related_posts($post_id, $tags = array(), $posts_number_display, $order_by) {
		$query = new WP_Query();

		$post_types = get_post_types();
		unset($post_types['page'], $post_types['attachment'], $post_types['revision'], $post_types['nav_menu_item']);

		if($tags) {
			foreach($tags as $tag) {
				$tagsA[] = $tag->term_id;
			}
		}
	   $query = new WP_Query( array('orderby'				=> $order_by,
									'showposts'				=> $posts_number_display,
									'post_type'				=> $post_types,
									'post__not_in'			=> array($post_id),
									'tag__in'				=> $tagsA,
									'ignore_sticky_posts'	=> 1 
									)
							);
		return $query;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Pagination function 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_pagination' ) ) {
	function ct_pagination($pages = '', $range = 4)
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
			echo "<div class=\"pagination clearfix\" role=\"navigation\"><span>".__('Page ','color-theme-framework').$paged." ".__('of','color-theme-framework')." ".$pages."</span>";

			if (is_rtl()) {
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><i class=\"icon-double-angle-right\"></i> ".__('First','color-theme-framework')."</a>";
			} else {
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><i class=\"icon-double-angle-left\"></i> ".__('First','color-theme-framework')."</a>";
			}


			if (is_rtl()) {
				if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><i class=\"icon-angle-right\"></i> ".__('Previous','color-theme-framework')."</a>";
			} else {
				if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><i class=\"icon-angle-left\"></i> ".__('Previous','color-theme-framework')."</a>";
			}
 
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
				}
			}
 
			if (is_rtl()) {
				if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__('Next','color-theme-framework')." <i class=\"icon-angle-left\"></i></a>";  
			} else {
				if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__('Next','color-theme-framework')." <i class=\"icon-angle-right\"></i></a>";
			}

			if (is_rtl()) {
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last','color-theme-framework')." <i class=\"icon-double-angle-left\"></i></a>";
			} else {
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last','color-theme-framework')." <i class=\"icon-double-angle-right\"></i></a>";
			}

			echo "</div>\n";
		}
    }
}


/*-----------------------------------------------------------------------------------*/
/* Get DailyMotion Thumbnail
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'getDailyMotionThumb' ) ) {
	function getDailyMotionThumb( $id ) {
		if ( ! function_exists( 'curl_init' ) ) {
			return null;
		}
		else {
		  $ch = curl_init();
		  $videoinfo_url = "https://api.dailymotion.com/video/$id?fields=thumbnail_url";
		  curl_setopt( $ch, CURLOPT_URL, $videoinfo_url );
		  curl_setopt( $ch, CURLOPT_HEADER, 0 );
		  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
		  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
		  curl_setopt( $ch, CURLOPT_TIMEOUT, 10 );
		  curl_setopt( $ch, CURLOPT_FAILONERROR, true ); // Return an error for curl_error() processing if HTTP response code >= 400
		  $output = curl_exec( $ch );
		  $output = json_decode( $output );
		  $output = $output->thumbnail_url;
		  if ( curl_error( $ch ) != null ) {
			$output = new WP_Error( 'dailymotion_info_retrieval', __( 'Error retrieving video information from the URL','color-theme-framework') . '<a href="' . $videoinfo_url . '">' . $videoinfo_url . '</a>.<br /><a href="http://curl.haxx.se/libcurl/c/libcurl-errors.html">Libcurl error</a> ' . curl_errno( $ch ) . ': <code>' . curl_error( $ch ) . '</code>. If opening that URL in your web browser returns anything else than an error page, the problem may be related to your web server and might be something your host administrator can solve.' );
		  }
		  curl_close( $ch ); // Moved here to allow curl_error() operation above. Was previously below curl_exec() call.
		  return $output;
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get Post Count
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_post_count' ) ) {
	function ct_get_post_count() {
		$res_search = new WP_Query("showposts=-1");
		$count = $res_search->post_count;

	   return $count; 
		 
	   wp_reset_query();
	   unset($res_search, $count);
	}
}


/*-----------------------------------------------------------------------------------*/
/* This is function gets the post views and display it in admin panel.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'getPostViews' ) ) {
	function getPostViews( $postID ){
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0";
		}
		return $count. __('','color-theme-framework');
	}
}

if ( !function_exists( 'setPostViews' ) ) {
	function setPostViews($postID) {
	if (!current_user_can('administrator') ) :
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if($count==''){
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		}else{
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	endif;
	}
}

if ( !function_exists( 'posts_column_views' ) ) {
	function posts_column_views($defaults){
		$defaults['post_views'] = __( 'Views' , 'color-theme-framework' );
		return $defaults;
	}
}

if ( !function_exists( 'posts_custom_column_views' ) ) {
	function posts_custom_column_views($column_name, $id){
		if( $column_name === 'post_views' ) {
			echo getPostViews( get_the_ID() );
		}
	}
}

add_filter('manage_posts_columns', 'posts_column_views');
add_action('manage_posts_custom_column', 'posts_custom_column_views',5,2);



/*-----------------------------------------------------------------------------------*/
/* Add Theme Custom Widgets
/*-----------------------------------------------------------------------------------*/
include("functions/ct-carousel-widget.php");
include("functions/ct-twitter-widget.php");
include("functions/ct-popular-posts-widget.php");
include("functions/ct-news-ticker-vertical-widget.php");
include("functions/ct-slider-widget.php");
include("functions/ct-recent-comments-widget.php");
include("functions/ct-flickr-widget.php");
//include("functions/ct-instagram-widget.php");
include("functions/ct-blog-widget.php");
include("functions/ct-photo-news-widget.php");
include("functions/ct-categories-widget.php");
include("functions/ct-social-counter-widget.php");
include("functions/ct-social-icons-widget.php");
include("functions/ct-text-widget.php");
include("functions/ct-small-slider-widget.php");
include("functions/ct-related-thumbs-widget.php");

/*-----------------------------------------------------------------------------------*/
/* Add Theme Extra Features
/*-----------------------------------------------------------------------------------*/

/* Add Color Picker field for Categories */
require_once("includes/categories-color.php");

/* Post Like */
require_once("post-like.php");

/* Theme Metaboxes */
require_once("includes/theme-metaboxes.php");


/*-----------------------------------------------------------------------------------*/
/* Get Entry Share
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_share' ) ) {
	function ct_get_share() { 
		global $post;
		$ct_title = get_the_title();
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
		//str_replace(" ", "%20", $ct_title);
		?>
		<div class="entry-share-icons">
			<span class="ct-pinterest" title="<?php _e('Share on Pinterest', 'color-theme-framework'); ?>"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo $large_image_url[0]; ?>&amp;description=<?php echo str_replace(" ", "%20", $ct_title); ?>" target="_blank"><i class="icon-pinterest"></i></a></span>
			<span class="ct-fb" title="<?php _e('Share on Facebook', 'color-theme-framework'); ?>"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="icon-facebook"></i></a></span>
			<span class="ct-twitter" title="<?php _e('Share on Twitter', 'color-theme-framework'); ?>"><a href="https://twitter.com/intent/tweet?text=<?php echo str_replace(" ", "%20", $ct_title); ?>&amp;url=<?php the_permalink(); ?>" target="_blank"><i class="icon-twitter"></i></a></span>
			<span class="ct-gplus" title="<?php _e('Share on Google Plus', 'color-theme-framework'); ?>"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="icon-google-plus"></i></a></span>
		</div><!-- .entry-share-icons -->
<?php
	}
}


/*-----------------------------------------------------------------------------------*/
/*  This will add rel=lightbox[postid] to the href of the image link
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_add_prettyphoto_rel' ) ) {
	global $ct_options;
	if ( isset( $ct_options['ct_add_prettyphoto'] ) ) { $add_prettyphoto = $ct_options['ct_add_prettyphoto']; } else { $add_prettyphoto = 1; }

	if ( $add_prettyphoto ) :		
		function ct_add_prettyphoto_rel ($content)
		{   
			global $post;
			$pattern = "/<a(.*?)href=('|\")([^>]*).(bmp|gif|jpeg|jpg|png)('|\")(.*?)>(.*?)<\/a>/i";
			$replacement = '<a$1href=$2$3.$4$5 rel="prettyphoto['.$post->ID.']"$6>$7</a>';
			$content = preg_replace($pattern, $replacement, $content);
			return $content;
		}
		add_filter('the_content', 'ct_add_prettyphoto_rel', 12);
	endif;
}


/*-----------------------------------------------------------------------------------*/
/*  Custom Background and Custom CSS
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_custom_head_css' ) ) {
	function ct_custom_head_css() {

		$output = '';

		global $wp_query, $ct_options;
		if( is_home() ) {
			$postid = get_option('page_for_posts');
		} elseif( is_search() || is_404() || is_category() || is_tag() || is_author() ) {
			$postid = 0;
		} else {
			$postid = $wp_query->post->ID;
		}

		/* -- Get the unique custom background image for page --------------------*/
		$bg_img = get_post_meta($postid, 'ct_mb_background_image', true);
		$src = wp_get_attachment_image_src( $bg_img, 'full' );
		$bg_img = $src[0];

		if( empty($bg_img) ) {
			/* -- Background image not defined, fallback to default background -- */
			$bg_pos = strtolower ( stripslashes ( $ct_options['ct_default_bg_position'] ) );
			if ( $bg_pos == 'full screen' ) {
				$bg_pos = 'full';
			}
			$bg_type = stripslashes ( $ct_options['ct_default_bg_type'] );

			if( $bg_pos != 'full' ) {
				/* -- Setup body backgroung image, if not fullscreen -- */
				if ( $bg_type == 'Uploaded' ) {
					$bg_img = stripslashes ( $ct_options['ct_default_bg_image'] );
				} else if ( $bg_type == 'Predefined' ) {
					$bg_img = stripslashes ( $ct_options['ct_default_predefined_bg'] );
				}

				if( !empty($bg_img) ) {
					$bg_img = " url($bg_img)";
				} else {
					$bg_img = " none";
				}

				$bg_repeat = strtolower ( stripslashes ( $ct_options['ct_default_bg_repeat'] ) );
				$bg_attachment = strtolower ( stripslashes ( $ct_options['ct_default_bg_attachment'] ) );
				$bg_color = get_post_meta($postid, 'ct_mb_background_color', true);

				if( empty($bg_color) ) { 
					$bg_color = stripslashes ( $ct_options['ct_body_background'] );
				}

				$output .= "body { \n\tbackground-color: $bg_color;\n\tbackground-image: $bg_img;\n\tbackground-attachment: $bg_attachment;\n\tbackground-repeat: $bg_repeat;\n\tbackground-position: top $bg_pos; \n}\n";
			}    
		} else {
			/* -- Custom image defined, check default position -------------------- */
			$bg_pos = get_post_meta($postid, 'ct_mb_background_position', true);

			if( $bg_pos != 'full' ) {
				/* -- Setup body backgroung image, if not fullscreen -- */
				$bg_img = " url($bg_img)";

				/* -- Get the repeat and backgroung color options -- */
				$bg_repeat = get_post_meta($postid, 'ct_mb_background_repeat', true);
				$bg_attachment = get_post_meta($postid, 'ct_mb_background_attachment', true);
				$bg_color = get_post_meta($postid, 'ct_mb_background_color', true);

				if( empty($bg_color) ) {
					$bg_color = stripslashes ( $ct_options['ct_body_background'] );
				}

				$output .= "body { \n\tbackground-color: $bg_color;\n\tbackground-image: $bg_img;\n\tbackground-attachment: $bg_attachment;\n\tbackground-repeat: $bg_repeat;\n\tbackground-position: top $bg_pos; \n}\n";
			}
		}
		
		/* -- Custom CSS from Theme Options --------------------*/
		$custom_css = stripslashes ( $ct_options['ct_custom_css'] );
	
		if ( !empty($custom_css) ) {
			$output .= $custom_css . "\n";
		}
		
		/* -- Output our custom styles --------------------------*/
		if ($output <> '') {
			$output = "<!-- Custom Styles -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
			echo stripslashes($output);
		}
	
	}

	add_action('wp_head', 'ct_custom_head_css');
}


/*-----------------------------------------------------------------------------------*/
/* If we go beyond the last page and request a page that doesn't exist,
 * force WordPress to return a 404.
 * See http://core.trac.wordpress.org/ticket/15770
/*-----------------------------------------------------------------------------------*/
function ct_custom_paged_404_fix( ) {
	global $wp_query;
	if ( is_404() || !is_paged() || 0 != count( $wp_query->posts ) )
		return;
	$wp_query->set_404();
	status_header( 404 );
	nocache_headers();
}
add_action( 'wp', 'ct_custom_paged_404_fix' );


/*-----------------------------------------------------------------------------------*/
/* Displays page links for paginated posts/pages
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_wp_link_pages' ) ) {
	function ct_wp_link_pages( $args = '' ) {
		$defaults = array(
			'before'			=> '<p class="pagination clearfix"><span>' . __( 'Pages:', 'color-theme-framework' ) . '</span>', 
			'after'				=> '</p>',
			'text_before'		=> '',
			'text_after'		=> '',
			'next_or_number'	=> 'number', 
			'nextpagelink'		=> __( 'Next page', 'color-theme-framework' ),
			'previouspagelink'	=> __( 'Previous page', 'color-theme-framework' ),
			'pagelink'			=> '%',
			'echo'				=> 1
		);

		$r = wp_parse_args( $args, $defaults );
		$r = apply_filters( 'wp_link_pages_args', $r );
		extract( $r, EXTR_SKIP );

		global $page, $numpages, $multipage, $more, $pagenow;

		$output = '';
		if ( $multipage ) {
			if ( 'number' == $next_or_number ) {
				$output .= $before;
				for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {
					$j = str_replace( '%', $i, $pagelink );
					$output .= ' ';
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
						$output .= _wp_link_page( $i );
					else
						$output .= '<span class="current">';

					$output .= $text_before . $j . $text_after;
					if ( $i != $page || ( ( ! $more ) && ( $page == 1 ) ) )
						$output .= '</a>';
					else
						$output .= '</span>';
				}
				$output .= $after;
			} else {
				if ( $more ) {
					$output .= $before;
					$i = $page - 1;
					if ( $i && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $previouspagelink . $text_after . '</a>';
					}
					$i = $page + 1;
					if ( $i <= $numpages && $more ) {
						$output .= _wp_link_page( $i );
						$output .= $text_before . $nextpagelink . $text_after . '</a>';
					}
					$output .= $after;
				}
			}
		}

		if ( $echo )
			echo $output;

		return $output;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Displays Read more link
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_get_readmore' ) ) {
	function ct_get_readmore() {
		echo "<a class=\"ct-read-more ct-google-font\" href=\"" . get_permalink() . "\" title=\"" . __('Permalink to ','color-theme-framework') . the_title('','',false) . "\">" . __('Read more','color-theme-framework') ."</a>";
	}
}


/*-----------------------------------------------------------------------------------*/
/* Pagination function 
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_pagination' ) ) {
	function ct_pagination($pages = '', $range = 4) {
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
			echo "<div class=\"pagination clearfix\" role=\"navigation\"><span>".__('Page ','color-theme-framework').$paged." ".__('of','color-theme-framework')." ".$pages."</span>";

			if (is_rtl()) {
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><i class=\"icon-double-angle-right\"></i> ".__('First','color-theme-framework')."</a>";
			} else {
				if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><i class=\"icon-double-angle-left\"></i> ".__('First','color-theme-framework')."</a>";
			}


			if (is_rtl()) {
				if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><i class=\"icon-angle-right\"></i> ".__('Previous','color-theme-framework')."</a>";
			} else {
				if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><i class=\"icon-angle-left\"></i> ".__('Previous','color-theme-framework')."</a>";
			}
 
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
				}
			}
 
			if (is_rtl()) {
				if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__('Next','color-theme-framework')." <i class=\"icon-angle-left\"></i></a>";  
			} else {
				if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__('Next','color-theme-framework')." <i class=\"icon-angle-right\"></i></a>";
			}

			if (is_rtl()) {
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last','color-theme-framework')." <i class=\"icon-double-angle-left\"></i></a>";
			} else {
				if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last','color-theme-framework')." <i class=\"icon-double-angle-right\"></i></a>";
			}

			echo "</div>\n";
		}
	}
}

if ( !function_exists( 'ct_pagination_none' ) ) {
	function pagination($pages = '', $range = 3)	{ 
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
			echo "<div class=\"pagination clearfix\" style=\"display:none\"><span>".__('Page ','color-theme-framework').$paged." ".__('of','color-theme-framework')." ".$pages."</span>";
			if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'><i class=\"icon-double-angle-left\"></i> ".__('First','color-theme-framework')."</a>";
			if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'><i class=\"icon-angle-left\"></i> ".__('Previous','color-theme-framework')."</a>";
 
			for ($i=1; $i <= $pages; $i++)
			{
				if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
				{
					echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
				}
			}
 
			if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">".__('Next','color-theme-framework')." <i class=\"icon-angle-right\"></i></a>";  
			if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>".__('Last','color-theme-framework')." <i class=\"icon-double-angle-right\"></i></a>";
			echo "</div>\n";
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/* Print an excerpt by specifying a maximium number of characters.
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_excerpt_max_charlength' ) ) {
	function ct_excerpt_max_charlength($charlength) {
		$excerpt = get_the_excerpt();
		$charlength++;

		if ( mb_strlen( $excerpt ) > $charlength ) {
			$subex = mb_substr( $excerpt, 0, $charlength - 5 );
			$exwords = explode( ' ', $subex );
			$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
			if ( $excut < 0 ) {
				echo mb_substr( $subex, 0, $excut );
			} else {
				echo $subex;
		}	
			echo '...';
		} else {
			echo $excerpt;
		}
	}
}


/*-----------------------------------------------------------------------------------*/
/*  Get Post Excerpt
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_post_excerpt' ) ) {
	function ct_get_post_excerpt($charlength) {
		$post_excerpt = get_the_excerpt();
		echo strip_tags(mb_substr($post_excerpt, 0, $charlength ) ) . ' ...';
	}
}


/*-----------------------------------------------------------------------------------*/
/* Adding custom user profile fields
/*-----------------------------------------------------------------------------------*/
add_action( 'show_user_profile', 'ct_extra_profile_fields' );
add_action( 'edit_user_profile', 'ct_extra_profile_fields' );

function ct_extra_profile_fields( $user ) { ?>

	<h3><?php _e( 'Author Social icons' , 'color-theme-framework' ); ?></h3>

	<table class="form-table">

		<tr>
			<th><label for="facebook"><?php _e( 'Facebook' , 'color-theme-framework' ); ?></label></th>

			<td>
				<input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e( 'Please enter your Facebook URL' , 'color-theme-framework'); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="twitter"><?php _e( 'Twitter' , 'color-theme-framework' ); ?></label></th>

			<td>
				<input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e( 'Please enter your Twitter URL' , 'color-theme-framework'); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="google_plus"><?php _e( 'Google Plus' , 'color-theme-framework' ); ?></label></th>

			<td>
				<input type="text" name="google_plus" id="google_plus" value="<?php echo esc_attr( get_the_author_meta( 'google_plus', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e( 'Please enter your Google Plus URL' , 'color-theme-framework'); ?></span>
			</td>
		</tr>

		<tr>
			<th><label for="pinterest"><?php _e( 'Pinterest' , 'color-theme-framework' ); ?></label></th>

			<td>
				<input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( get_the_author_meta( 'pinterest', $user->ID ) ); ?>" class="regular-text" /><br />
				<span class="description"><?php _e( 'Please enter your Pinterest URL' , 'color-theme-framework'); ?></span>
			</td>
		</tr>		
	</table>
<?php }

add_action( 'personal_options_update', 'ct_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'ct_save_extra_profile_fields' );

function ct_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;

	/* Copy and paste this line for additional fields. */
	update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
	update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
	update_user_meta( $user_id, 'google_plus', $_POST['google_plus'] );
	update_user_meta( $user_id, 'pinterest', $_POST['pinterest'] );
}


/*-----------------------------------------------------------------------------------*/
/* Breadcrumb
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_breadcrumb' ) ) {
	function ct_breadcrumb() {

        if ( !is_front_page() ) {
			echo '<i class="icon-home"></i><a href="'.home_url().'">'.__('Home','color-theme-framework').'</a> &#47; ';
		}

		if ( (is_category() || is_single() ) and !is_attachment() ) {
			$category = get_the_category();
			$ID = $category[0]->cat_ID;
			//echo get_category_parents($ID, TRUE, ' &rarr; ', FALSE );
			if ( is_category() ) :
				global $cat;
				echo get_category_parents($cat, TRUE, ' &#47; ');
			else :
				//echo get_category_parents($ID, TRUE, ' &#47; ', FALSE );
				$thecats = get_category_parents($ID, TRUE, ' &#47; ', FALSE );
				if(!is_object($thecats)) echo $thecats;
			endif;
		}

		if(is_single() || is_page()) { the_title(); }
		if(is_tag()){ echo __('Tag: ','color-theme-framework').single_tag_title('',FALSE); }
		if(is_404()){ echo __('404 - Page not Found','color-theme-framework'); }
		if(is_search()){ echo __('Search','color-theme-framework'); }
		if(is_year() ){ echo get_the_time('M Y'); }
		if(is_author()){ echo __('Author Archives','color-theme-framework'); }
		else if(is_archive() and !is_tag()){ echo __('Archives','color-theme-framework'); }
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get icon link for video posts
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_icon_link' ) ) {
	function ct_get_icon_link() {
		global $post;
		$video_type = get_post_meta( $post->ID, 'ct_mb_post_video_type', true );
		$videoid = get_post_meta( $post->ID, 'ct_mb_post_video_file', true );
		$perma_link = get_permalink($post->ID);

		if ( $video_type == 'youtube' ) {
			if ( !empty($videoid) ) :
				$perma_link = 'http://www.youtube.com/watch?v='.$videoid;
				echo '<div class="video youtube"><a href="' . $perma_link . '" data-rel="prettyPhoto" title="'. __('Watch Youtube Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
			else :
				echo '<div class="video youtube"><a href="' . $perma_link . '" title="'. __('Watch Youtube Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
			endif;
		}
		else if ( $video_type == 'vimeo' ) {
			if ( !empty($videoid) ) :
				$perma_link = 'http://vimeo.com/'.$videoid;	
				echo '<div class="video vimeo"><a href="' . $perma_link . '" data-rel="prettyPhoto" title="'. __('Watch Vimeo Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
			else :
				echo '<div class="video vimeo"><a href="' . $perma_link . '" title="'. __('Watch Vimeo Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
			endif;							
		}
	  	else if ( $video_type == 'dailymotion' ) {
			if ( !empty($videoid) ) :
				$perma_link = 'http://www.dailymotion.com/video/'.$videoid;
				echo '<div class="video dailymotion"><a href="' . $perma_link . '" data-rel="prettyPhoto" title="'. __('Watch DailyMotion Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
			else :
				echo '<div class="video dailymotion"><a href="' . $perma_link . '" title="'. __('Watch DailyMotion Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
			endif;				  			
	  	}
	  	else {
			echo '<div class="video custom-video"><a href="' . $perma_link . '" title="'. __('Watch Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';				  			
  		}
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get icon for video posts
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_video_icon' ) ) {
	function ct_get_video_icon() {
		global $post;
		$video_type = get_post_meta( $post->ID, 'ct_mb_post_video_type', true );
		$perma_link = get_permalink($post->ID);

		if ( $video_type == 'youtube' ) {
			echo '<div class="video youtube"><a href="' . $perma_link . '" title="'. __('Youtube Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
		}
		else if ( $video_type == 'vimeo' ) {
			echo '<div class="video vimeo"><a href="' . $perma_link . '" title="'. __('Vimeo Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
		}
	  	else if ( $video_type == 'dailymotion' ) {
			echo '<div class="video dailymotion"><a href="' . $perma_link . '" title="'. __('DailyMotion Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';
	  	}
	  	else {
			echo '<div class="video custom-video"><a href="' . $perma_link . '" title="'. __('Video','color-theme-framework').'"><i class="icon-play"></i></a></div>';				  			
  		}
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get icon for audio posts
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_audio_icon' ) ) {
	function ct_get_audio_icon() {
		global $post;
		$perma_link = get_permalink($post->ID);
		echo '<div class="audio"><a href="' . $perma_link . '" title="'. __('Play Audio','color-theme-framework').'"><i class="icon-music"></i></a></div>';
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get iframe video player
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_video_player' ) ) {
	function ct_get_video_player() {
		global $post;
		$video_type = get_post_meta( $post->ID, 'ct_mb_post_video_type', true );
		$videoid = get_post_meta( $post->ID, 'ct_mb_post_video_file', true );

		if ( !empty($videoid) ) :
			echo '<div class="ct-video-container">';
	    
	    	if ( $video_type == 'youtube' ) {
				echo '<iframe src="http://www.youtube.com/embed/' . $videoid .'?wmode=opaque"></iframe>';
			} else if ( $video_type == 'vimeo' ) {
				echo '<iframe src="http://player.vimeo.com/video/' . $videoid . '"></iframe>';
			} else if ( $video_type == 'dailymotion' ) {
				echo '<iframe src="http://www.dailymotion.com/embed/video/' . $videoid . '"></iframe>';
			}
			echo '</div><!-- .ct-video-container -->';
		elseif ( ($video_type == 'custom-video') and is_single() ) :
			echo '';
		else :
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb');
			echo '<a href="'.get_permalink().'"><img class="img-responsive" src="'.$image[0].'" alt="'.the_title_attribute( 'echo=0' ).'" /></a>';
			ct_get_video_icon();
		endif;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get iframe audio player
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_audio_player' ) ) {
	function ct_get_audio_player() {
		global $post, $ct_is_blogpage;
		$sound_code = get_post_meta( $post->ID, 'ct_mb_sound_code', true );
		$audio_thumb = get_post_meta( $post->ID, 'ct_mb_post_audio_thumb', true);

		if (!isset($ct_is_blogpage)) : $ct_is_blogpage = 1; endif;

		if ( !empty($sound_code) ) :
			echo '<div class="ct-audio-container">';
			echo $sound_code;
			echo '</div><!-- .ct-audio-container -->';
		elseif ( is_category() || is_tag() || is_archive() || $ct_is_blogpage ) :
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb'); ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( the_title_attribute( 'echo=0' ) ) ); ?>"><img class="img-responsive" src="<?php echo $image[0]; ?>" alt="<?php echo esc_attr( sprintf( the_title_attribute( 'echo=0' ) ) ); ?>" /></a>
			<?php ct_get_audio_icon(); ?>
		<?php elseif ( is_single() ):
			echo ''; ?>
		<?php else :
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb');
			echo '<a href="'.get_permalink().'"><img class="img-responsive" src="'.$image[0].'" alt="'.the_title_attribute( 'echo=0' ).'" /></a>';
		endif;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get big thumb
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_big_thumb' ) ) {
	function ct_get_big_thumb() {
		if ( is_single() ) :
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb');
			the_post_thumbnail( 'single-post-thumb', array( 'class' => 'img-responsive' ) );  ?>
		<?php else :
			$image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'single-post-thumb'); ?>
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( the_title_attribute( 'echo=0' ) ) ); ?>"><?php the_post_thumbnail( 'single-post-thumb', array( 'class' => 'img-responsive' ) ); ?></a>
		<?php endif;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Get Gallery (for single post page)
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_gallery' ) ) {
	function ct_get_gallery() {

		global $ct_options, $post, $wpdb;
		$time_id = rand();
		$meta_gallery = get_post_meta(get_the_ID(), 'ct_mb_gallery', false);

		if (!is_array($meta_gallery)) $meta_gallery = (array) $meta_gallery;

		if (!empty($meta_gallery)) :

			if ( !is_admin() ) {
				/* Flex Slider */
				wp_register_script('flex-min-jquery',get_template_directory_uri().'/js/jquery.flexslider-min.js',false, null , true);
				wp_enqueue_script('flex-min-jquery',array('jquery'));
			} ?>

			<script type="text/javascript">
				/* <![CDATA[ */
				jQuery.noConflict()(function($){
					$(window).load(function () {

						$(".slider-preloader").css("display","none");
						$('#slider-<?php echo $post->ID . '-' . $time_id; ?>').flexslider({
								animation: "slide",
								animationLoop: true,
								directionNav: true,
								controlNav: false,
								slideshow: false,
								smoothHeight: true
						});
					});
				});
				/* ]]> */
			</script>

			<!-- Start FlexSlider -->
			<div class="slider-preloader" style="text-align: center;"><img src="<?php echo get_template_directory_uri().'/img/slider_preloader.gif'; ?> " alt="preloader"></div>
			<div id="slider-<?php echo $post->ID . '-' . $time_id; ?>" class="flexslider flex-big-slider">
				<ul class="slides clearfix">

					<?php
					$meta_gallery = implode(',', $meta_gallery);
					$images = $wpdb->get_col("
							SELECT ID FROM $wpdb->posts
							WHERE post_type = 'attachment'
							AND ID in ($meta_gallery)
							ORDER BY menu_order ASC
					");

					foreach ($images as $att) {
						$src = wp_get_attachment_image_src($att, 'single-post-thumb');
						$src_full = wp_get_attachment_image_src($att, 'full');
						$src = $src[0];
						$src_full = $src_full[0];

						//echo get_post($att)->post_excerpt;
						$alt = get_post_meta($att, '_wp_attachment_image_alt', true);
						echo '<li><a href="' . $src_full . '" data-rel="prettyPhoto[gal]">';
						echo '<img src="' . $src . '" alt="' . $alt . '">';
						echo '</a></li>';
					} // end foreach ?>
				</ul><!-- .slides -->
			</div><!-- .flexSlider -->
		<?php endif;
	}
}


/*-----------------------------------------------------------------------------------*/
/* Twitter - convert dates to readable format
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_relative_time' ) ) :
	function ct_relative_time($a) {
		//get current timestampt
		$b = strtotime("now"); 
		//get timestamp when tweet created
		$c = strtotime($a);
		//get difference
		$d = $b - $c;
		//calculate different time values
		$minute = 60;
		$hour = $minute * 60;
		$day = $hour * 24;
		$week = $day * 7;

		if(is_numeric($d) && $d > 0) {
			//if less then 3 seconds
			if($d < 3) return __('right now', 'color-theme-framework');
			//if less then minute
			if($d < $minute) return floor($d) . __(' seconds ago', 'color-theme-framework');
			//if less then 2 minutes
			if($d < $minute * 2) return __('about 1 minute ago', 'color-theme-framework');
			//if less then hour
			if($d < $hour) return floor($d / $minute) . __(' minutes ago', 'color-theme-framework');
			//if less then 2 hours
			if($d < $hour * 2) return __('about 1 hour ago', 'color-theme-framework');
			//if less then day
			if($d < $day) return floor($d / $hour) . __(' hours ago', 'color-theme-framework');
			//if more then day, but less then 2 days
			if($d > $day && $d < $day * 2) return __('yesterday', 'color-theme-framework');
			//if less then year
			if($d < $day * 365) return floor($d / $day) . __(' days ago', 'color-theme-framework');
			//else return more than a year
			return __('over a year ago', 'color-theme-framework');
		}
	}
endif;


/*-----------------------------------------------------------------------------------*/
/* Twitter - convert links to clickable format
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_convert_links' ) ) :
	function ct_convert_links($status,$targetBlank=true,$linkMaxLen=250){
		// the target
		$target=$targetBlank ? " target=\"_blank\" " : "";

		// convert link to url
		$status = preg_replace("/((http:\/\/|https:\/\/)[^ )
]+)/e", "'<a href=\"$1\" title=\"$1\" $target >'. ((strlen('$1')>=$linkMaxLen ? substr('$1',7,$linkMaxLen).'...':substr('$1',7,$linkMaxLen))).'</a>'", $status);

		// convert @ to follow
		$status = preg_replace("/(@([_a-z0-9\-]+))/i","<a href=\"http://twitter.com/$2\" title=\"Follow $2\" $target >$1</a>",$status);

		// convert # to search
		$status = preg_replace("/(#([_a-z0-9\-]+))/i","<a href=\"https://twitter.com/search?q=$2\" title=\"Search $1\" $target >$1</a>",$status);

		// return the status
		return $status;
	}
endif;

/*-----------------------------------------------------------------------------------*/
/* Twitter - get connection with Access Token
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_getConnectionWithAccessToken' ) ) :
	function ct_getConnectionWithAccessToken($cons_key, $cons_secret, $oauth_token, $oauth_token_secret) {
		$connection = new TwitterOAuth($cons_key, $cons_secret, $oauth_token, $oauth_token_secret);
		return $connection;
	}
endif;


/*-----------------------------------------------------------------------------------*/
/* Get post meta views
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_meta_views' ) ) :
	function ct_get_meta_views() {
		global $post;
		$output ='';
		$output .= "<span class=\"meta-views\">\n<i class=\"icon-eye-open\"></i>\n".getPostViews($post->ID).__(' views','color-theme-framework');
		$output .= "</span><!-- .meta-views -->";
		echo stripslashes($output);
	}
endif;


/*-----------------------------------------------------------------------------------*/
/* Get post meta likes
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_meta_likes' ) ) :
	function ct_get_meta_likes() {
		global $post;
		echo "<span class=\"meta-likes\">\n";
		getPostLikeLink($post->ID);
		echo " " . __('likes','color-theme-framework');
		echo "</span><!-- .meta-likes -->";
	}
endif;


/*-----------------------------------------------------------------------------------*/
/* Get post meta date
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_meta_date' ) ) :
	function ct_get_meta_date() {
		$output ='';
		$output .= "<span class=\"meta-date updated\">\n<i class=\"icon-calendar\"></i>\n".esc_attr( get_the_date( 'M j, Y' ) );
		$output .= "</span><!-- .meta-date -->";
		echo stripslashes($output);
	}
endif;


/*-----------------------------------------------------------------------------------*/
/* Get post meta author
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_meta_author' ) ) :
	function ct_get_meta_author() {
		$output ='';
		$author = sprintf( '<span class="author vcard">%4$s<a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'color-theme-framework' ), get_the_author() ) ),
				get_the_author(),
				''
		);
		$output .= "<span class=\"meta-author\">\n<i class=\"icon-user\" title=\"".__('Author','color-theme-framework')."\"></i>\n".$author."\n";
		$output .= "</span><!-- .meta-author -->";
		echo stripslashes($output);
	}
endif;


/*-----------------------------------------------------------------------------------*/
/* Get post meta comments
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_meta_comments' ) ) :
	function ct_get_meta_comments() {
		echo "<span class=\"meta-comments\">\n";
		echo "<i class=\"icon-comment\"></i>\n";
		comments_popup_link(__('no comments','color-theme-framework'),__('1 comment','color-theme-framework'),__('% comments','color-theme-framework'));
		echo "\n</span><!-- .meta-comments -->";
	}
endif;


/*-----------------------------------------------------------------------------------*/
/* Get post meta category
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_meta_category' ) ) :
	function ct_get_meta_category() {
		$output ='';
		$output .= "<span class=\"meta-category\">\n<i class=\"icon-tag\"></i>\n".get_the_category_list(', ')."\n";
		$output .= "</span><!-- .meta-category -->";
		echo stripslashes($output);
	}
endif;


/*-----------------------------------------------------------------------------------*/
/* Get post meta share
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_meta_share' ) ) :
	function ct_get_meta_share() {
		global $post;
		$ct_title = the_title_attribute( 'echo=0' );
		$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large');
		?>

		<span class="meta-share">
			<i class="icon-share"></i>
			<?php _e('Share','color-theme-framework'); ?>
			<span class="entry-share-icons">
				<span class="ct-pinterest" title="<?php _e('Share on Pinterest', 'color-theme-framework'); ?>"><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo $large_image_url[0]; ?>&amp;description=<?php echo str_replace(" ", "%20", $ct_title); ?>" target="_blank"><i class="icon-pinterest"></i></a></span>
				<span class="ct-fb" title="<?php _e('Share on Facebook', 'color-theme-framework'); ?>"><a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="_blank"><i class="icon-facebook"></i></a></span>
				<span class="ct-twitter" title="<?php _e('Share on Twitter', 'color-theme-framework'); ?>"><a href="https://twitter.com/intent/tweet?text=<?php echo str_replace(" ", "%20", $ct_title); ?>&amp;url=<?php the_permalink(); ?>" target="_blank"><i class="icon-twitter"></i></a></span>
				<span class="ct-gplus" title="<?php _e('Share on Google Plus', 'color-theme-framework'); ?>"><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>" target="_blank"><i class="icon-google-plus"></i></a></span>
			</span><!-- .entry-share-icons -->
		</span><!-- .meta-share -->
	<?php }
endif;


/*-----------------------------------------------------------------------------------*/
/* Set up posts per page for Blog widget
/* Only for Home page and Blog page
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'ct_posts_per_page' ) ) {
    function ct_posts_per_page( $query ) {
        global $ct_options;
        $blog_num_posts = stripslashes( $ct_options['ct_blog_num_posts'] );

        //if ( is_home() || is_page_template('template-blog.php') || is_page_template('template-home.php') ) { 
        if ( is_home() ) {
            $query->query_vars['posts_per_page'] = $blog_num_posts;
        }
        return $query;  
    }  

    if ( !is_admin() ) add_filter( 'pre_get_posts', 'ct_posts_per_page' );  
}

	
/*-----------------------------------------------------------------------------------*/
/* Get Comments Author
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_comment_author' ) ) :
	function ct_get_comment_author ($comment) {
	    $author = "";
	    if ( empty($comment->comment_author) )
        	$author = __('Anonymous', 'color-theme-framework');
    	else
	        $author = get_comment_author_link( $comment->comment_ID );
	    return $author;
	}
endif;


/*-----------------------------------------------------------------------------------*/
/* Display "time ago" for Posts or Comments
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_time_ago' ) ) :
	function ct_get_time_ago( $comment ) {
		return ct_human_time_diff(strtotime($comment->comment_date), current_time('timestamp')) . " " . esc_html__('ago', 'color-theme-framework');
	}
endif;


/*-----------------------------------------------------------------------------------*/
/* Get the Excerpt Automatically Using the Post ID Outside of the Loop.
/*-----------------------------------------------------------------------------------*/
function ct_get_excerpt_by_id( $post_id ) {

	$the_post = get_post($post_id); //Gets post ID
	$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
	$excerpt_length = 35; //Sets excerpt length by word count
	$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
	$words = explode(' ', $the_excerpt, $excerpt_length + 1);

	if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, '...');
		$the_excerpt = implode(' ', $words);
	endif;

	return $the_excerpt;
}


/*-----------------------------------------------------------------------------------*/
/* Show Social Icons
/*-----------------------------------------------------------------------------------*/
if ( !function_exists( 'ct_get_social_icons' ) ) {
	function ct_get_social_icons() {

		global $ct_options;
		$ct_android_url = $ct_options['ct_android_url'];
		$ct_apple_url = $ct_options['ct_apple_url'];
		$ct_dribbble_url = $ct_options['ct_dribbble_url'];
		$ct_github_url = $ct_options['ct_github_url'];
		$ct_flickr_url = $ct_options['ct_flickr_url'];
		$ct_youtube_url = $ct_options['ct_youtube_url'];
		$ct_linkedin_url = $ct_options['ct_linkedin_url'];
		$ct_instagram_url = $ct_options['ct_instagram_url'];
		$ct_skype_url = $ct_options['ct_skype_url'];
		$ct_pinterest_url = $ct_options['ct_pinterest_url'];
		$ct_google_url = $ct_options['ct_google_url'];
		$ct_twitter_url = $ct_options['ct_twitter_url'];
		$ct_facebook_url = $ct_options['ct_facebook_url'];
		$ct_rss_url = $ct_options['ct_rss_url']; ?>

		<!-- START SOCIAL BLOCK -->
		<div id="social-icons-block" class="no-translatez">
			<?php if ( !empty($ct_android_url) ) : ?>
				<a href="<?php echo $ct_android_url; ?>" target="_blank" title="Android"><i class="icon-android ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_apple_url) ) : ?>
				<a href="<?php echo $ct_apple_url; ?>" target="_blank" title="Apple"><i class="icon-apple ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_github_url) ) : ?>
				<a href="<?php echo $ct_github_url; ?>" target="_blank" title="Github"><i class="icon-github-alt ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_flickr_url) ) : ?>
				<a href="<?php echo $ct_flickr_url; ?>" target="_blank" title="Flickr"><i class="icon-flickr ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_instagram_url) ) : ?>
				<a href="<?php echo $ct_instagram_url; ?>" target="_blank" title="Instagram"><i class="icon-instagram ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_youtube_url) ) : ?>
				<a href="<?php echo $ct_youtube_url; ?>" target="_blank" title="Youtube"><i class="icon-youtube ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_linkedin_url) ) : ?>
				<a href="<?php echo $ct_linkedin_url; ?>" target="_blank" title="Linkedin"><i class="icon-linkedin ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_skype_url) ) : ?>
				<a href="<?php echo $ct_skype_url; ?>" target="_blank" title="Skype"><i class="icon-skype ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_pinterest_url) ) : ?>
				<a href="<?php echo $ct_pinterest_url; ?>" target="_blank" title="Pinterest"><i class="icon-pinterest ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_google_url) ) : ?>
				<a href="<?php echo $ct_google_url; ?>" target="_blank" title="Google+"><i class="icon-google-plus ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_twitter_url) ) : ?>
				<a href="<?php echo $ct_twitter_url; ?>" target="_blank" title="Twitter"><i class="icon-twitter ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_facebook_url) ) : ?>
				<a href="<?php echo $ct_facebook_url; ?>" target="_blank" title="Facebook"><i class="icon-facebook ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_dribbble_url) ) : ?>
				<a href="<?php echo $ct_dribbble_url; ?>" target="_blank" title="Dribbble"><i class="icon-dribbble ct-transition"></i></a>
			<?php endif; ?>

			<?php if ( !empty($ct_rss_url) ) : ?>
				<a href="<?php echo $ct_rss_url; ?>" target="_blank" title="RSS"><i class="icon-rss ct-transition"></i></a>
			<?php endif; ?>
		</div> <!-- #social-icons-block -->
		<!-- END SOCIAL BLOCK -->
	<?php }
}


/**
 * Determines the difference between two timestamps.
 *
 * The difference is returned in a human readable format such as "1 hour",
 * "5 mins", "2 days".
 *
 * @since 1.5.0
 *
 * @param int $from Unix timestamp from which the difference begins.
 * @param int $to Optional. Unix timestamp to end the time difference. Default becomes time() if not set.
 * @return string Human readable time difference.
 */
function ct_human_time_diff( $from, $to = '' ) {
	if ( empty( $to ) )
		$to = time();

	$diff = (int) abs( $to - $from );

	if ( $diff < HOUR_IN_SECONDS ) {
		$mins = round( $diff / MINUTE_IN_SECONDS );
		if ( $mins <= 1 )
			$mins = 1;
		/* translators: min=minute */
		$since = sprintf( _n( '%s min', '%s mins', $mins, 'color-theme-framework' ), $mins );
	} elseif ( $diff < DAY_IN_SECONDS && $diff >= HOUR_IN_SECONDS ) {
		$hours = round( $diff / HOUR_IN_SECONDS );
		if ( $hours <= 1 )
			$hours = 1;
		$since = sprintf( _n( '%s hour', '%s hours', $hours, 'color-theme-framework' ), $hours );
	} elseif ( $diff < WEEK_IN_SECONDS && $diff >= DAY_IN_SECONDS ) {
		$days = round( $diff / DAY_IN_SECONDS );
		if ( $days <= 1 )
			$days = 1;
		$since = sprintf( _n( '%s day', '%s days', $days, 'color-theme-framework' ), $days );
	} elseif ( $diff < 30 * DAY_IN_SECONDS && $diff >= WEEK_IN_SECONDS ) {
		$weeks = round( $diff / WEEK_IN_SECONDS );
		if ( $weeks <= 1 )
			$weeks = 1;
		$since = sprintf( _n( '%s week', '%s weeks', $weeks, 'color-theme-framework' ), $weeks );
	} elseif ( $diff < YEAR_IN_SECONDS && $diff >= 30 * DAY_IN_SECONDS ) {
		$months = round( $diff / ( 30 * DAY_IN_SECONDS ) );
		if ( $months <= 1 )
			$months = 1;
		$since = sprintf( _n( '%s month', '%s month', $months, 'color-theme-framework' ), $months );
	} elseif ( $diff >= YEAR_IN_SECONDS ) {
		$years = round( $diff / YEAR_IN_SECONDS );
		if ( $years <= 1 )
			$years = 1;
		$since = sprintf( _n( '%s year', '%s years', $years, 'color-theme-framework' ), $years );
	}

	return $since;
}