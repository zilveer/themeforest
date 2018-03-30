<?php

// DEFINING THEME CONSTANTS
define( 'HOME_URI', home_url() );
define( 'THEME_FILES', get_stylesheet_directory() );
define( 'THEME_URI', get_stylesheet_directory_uri() );
define( 'THEME_DIR', get_template_directory_uri() );
global $uni_carousel_id;
$uni_carousel_id = 1;


// IMPORTING IMPORTANT FILES
require_once (THEME_FILES . '/functions/slider-manager/flex-slider-manager.php');
require_once (THEME_FILES . '/functions/theme-functions.php');
require_once (THEME_FILES . '/functions/mywidgets.php');
require_once (THEME_FILES . '/functions/myshortcodes.php');
require_once (THEME_FILES . '/functions/tinymce/shortcode_button.php');
require_once (THEME_FILES . '/functions/custom-posts.php');
if ( !function_exists( 'optionsframework_init' ) ) {
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/functions/theme-admin/' );
	require_once dirname( __FILE__ ) . '/functions/theme-admin/options-framework.php';
}
// THEME UPDATES
if (of_get_option('updates_switch', true)) { require_once (TEMPLATEPATH . '/functions/updates.php'); }


// CREATING MENU LOCATION
add_action( 'init', 'add_menus' );
function add_menus() {
	register_nav_menus(
		array(
			'main_nav' => 'Main Menu'
		)
	);
}
// adding required classes to menu items
add_filter( 'wp_nav_menu_objects', 'add_menu_parent_class' );
function add_menu_parent_class( $items ) {
	
	$parents = array();
	foreach ( $items as $item ) {
		if ( $item->menu_item_parent && $item->menu_item_parent > 0 ) {
			$parents[] = $item->menu_item_parent;
		}
	}
	
	foreach ( $items as $item ) {
		if ( in_array( $item->ID, $parents ) ) {
			$item->classes[] = 'sfish-navgiation-item'; 
		}
	}
	
	return $items;    
}


// DECLARING WOOCOMMERCE SUPPORT
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}
add_filter('loop_shop_per_page', create_function('$cols', 'return ' . of_get_option('number_of_products', '9') . ';'));
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25);
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );


// THEME LOCALIZATION
add_action('after_setup_theme', 'circolare_theme_setup');
function circolare_theme_setup(){
    load_theme_textdomain('circolare', get_template_directory() . '/languages');
}



// SMART JAVASCRIPT INCLUSION
function load_my_scripts() {
   	if (!is_admin()) {
		
		wp_enqueue_style( 'main', get_stylesheet_directory_uri().'/style.css', array(), '1', 'all' );
		wp_enqueue_style( 'b-theme', THEME_DIR . '/css/main.css', array(), '1', 'all' );
		
		if (of_get_option('color_scheme', 'green') != "") {
			wp_enqueue_style( 'b-skin', THEME_DIR . '/css/' . of_get_option('color_scheme', 'green') . '.css', array(), '1', 'all' );
			wp_enqueue_style( 'b-uiskin', THEME_DIR . '/jqueryui/css/redmond-' . of_get_option('color_scheme', 'green') . '/style.css', array(), '1', 'all' );
		} else {
			wp_enqueue_style( 'b-skin', THEME_DIR . '/css/green.css', array(), '1', 'all' );
			wp_enqueue_style( 'b-uiskin', THEME_DIR . '/jqueryui/css/redmond-green/style.css', array(), '1', 'all' );
		}
		wp_enqueue_style( 'b-uislider', THEME_DIR . '/jqueryui/css/extras.css', array(), '1', 'all' );
		
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-tabs' );		
		wp_enqueue_script( 'jquery-ui-accordion' );
		if ( is_singular() ) wp_enqueue_script( "comment-reply" );
		wp_enqueue_script( 'b-plugins', THEME_DIR . '/js/plugins.js', array( 'jquery' ), '1', true );
		wp_enqueue_script( 'b-caroufredsel', THEME_DIR . '/js/caroufredsel.js', array( 'jquery' ), '1', true );
		wp_enqueue_script( 'b-custom', THEME_DIR . '/js/custom.js', array( 'jquery' ), '1', true );
		
		if(is_page_template( 'homepage.php' )) {
			wp_enqueue_style( 'b-flexi', THEME_DIR . '/flexi/flexslider.css', array(), '1', 'all' );
			wp_enqueue_script( 'b-flexi', THEME_DIR . '/flexi/flexslider.js', array( 'jquery' ), '1', true );
		}
		
		if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { 
			wp_enqueue_style( 'woocommerce_frontend_styles', THEME_DIR . '/woocommerce/style.css', array(), '1', 'all' );
			if (is_woocommerce()){
				add_action( 'wp_footer', 'product_scripts' );
			}
		}
		
		if(of_get_option('mobile_switch', true)) { wp_enqueue_style( 'b-mediaqueries', THEME_DIR . '/css/media-queries.css', array(), '1', 'all' ); }
		wp_enqueue_style( 'b-updates', THEME_DIR . '/css/updates.css', array(), '1', 'all' );
		add_action( 'wp_footer', 'inner_inline_script' );
	}
}
add_action('wp_enqueue_scripts', 'load_my_scripts');


function inner_inline_script() {
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('body').bind('added_to_cart', function(){
			$('.add_to_cart_button.added').text(<?php _e("'Added'", "circolare"); ?>);			
			$('.add_to_cart_button.added').parent().parent().siblings(".float-left").children(".star-rating").hide()
		});
		
		$(".sidebar-title").click(function() {
			$(this).find(".collapsible").toggleClass("closed");
			$(this).next(".sidebar-block").slideToggle(500);
		});	
	});
</script>
<?php
}

function product_scripts() {
	function products_cookie() {
		if (!isset($_COOKIE['products_cookie'])) {
			setcookie('products_cookie', 'grid', time()+1209600, COOKIEPATH, COOKIE_DOMAIN, false);
		}
	}
	add_action( 'init', 'products_cookie');
?>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		
		// List or grid View
		var type;
		var delaySpeed = 500;
		var animateSpeed = 500;	
		$("a#switch-to-grid").click(function(){
			if(!$(this).hasClass("active-view")) {
				$('ul#woo-product-items').fadeOut(animateSpeed,function(){
					$('ul#woo-product-items').removeClass('list-view',animateSpeed);
					$('ul#woo-product-items').addClass('grid-view',animateSpeed);
				}).fadeIn(animateSpeed);
				$.cookie('products_cookie', 'grid');
			}
			$("a#switch-to-list").removeClass('active-view');
			$(this).addClass('active-view');
			return false;		
		});
		
		$("a#switch-to-list").click(function(){
			if(!$(this).hasClass("active-view")) {
				$('ul#woo-product-items').fadeOut(animateSpeed,function(){
					$('ul#woo-product-items').removeClass('grid-view',animateSpeed);
					$('ul#woo-product-items').addClass('list-view',animateSpeed);
				}).fadeIn(animateSpeed);
				$.cookie('products_cookie', 'list');
			}
			$(this).addClass('active-view');
			$("a#switch-to-grid").removeClass('active-view');		
			return false;		
		});
	
	});
</script>
<?php
}


// register an action (can be any suitable action)
if(of_get_option('envato_id') != "" && of_get_option('envato_api') != "")
add_action('admin_init', 'themeforest_updates');

function themeforest_updates()
{
    // include the library
    include_once('envato-wordpress-toolkit-library/class-envato-wordpress-theme-upgrader.php');
    $upgrader = new Envato_WordPress_Theme_Upgrader( of_get_option('envato_id'), of_get_option('envato_api') );
    /*
     *  Uncomment to check if the current theme has been updated
     */
    // $upgrader->check_for_theme_update(); 
    /*
     *  Uncomment to update the current theme
     */
    // $upgrader->upgrade_theme();
}


/* ADDING STYLES FROM THEME OPTIONS */
if (!function_exists('optionsframework_wp_head')) {
	function optionsframework_wp_head() { 
		of_head_css();
	}
}
add_action('wp_head', 'optionsframework_wp_head');

function fontface_selector($face, $facerepeat, $target) {
	
	switch($face) {
		case "sansita" : 
			if($facerepeat == false) { $output['script'] = '<link href="//fonts.googleapis.com/css?family=Sansita+One" rel="stylesheet" type="text/css">' . "\n"; } else {$output['script'] = "";}
			$output['style'] = '"Sansita One", serif';
			return $output; break;
		case "droid" : 
			if($facerepeat == false) { $output['script'] = '<link href="//fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet" type="text/css">' . "\n"; } else {$output['script'] = "";}
			$output['style'] = '"Droid Sans",serif';
			return $output; break;
		case "kaushan" : 
			if($facerepeat == false) { $output['script'] = '<link href="//fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet" type="text/css">' . "\n"; } else {$output['script'] = "";}
			$output['style'] = '"Kaushan Script",serif';
			return $output; break;
		case "droidserif" : 
			if($facerepeat == false) { $output['script'] = '<link href="//fonts.googleapis.com/css?family=Droid+Serif:400,700,700italic" rel="stylesheet" type="text/css">' . "\n"; } else {$output['script'] = "";}
			$output['style'] = '"Droid Serif",serif';
			return $output; break;
		case "oswald" : 
			if($facerepeat == false) { $output['script'] = '<link href="//fonts.googleapis.com/css?family=Oswald:400,700" rel="stylesheet" type="text/css">' . "\n"; } else {$output['script'] = "";}
			$output['style'] = '"Oswald",serif';
			return $output; break;
		case "merriweather" : 
			if($facerepeat == false) { $output['script'] = '<link href="//fonts.googleapis.com/css?family=Merriweather:400,700" rel="stylesheet" type="text/css">' . "\n"; } else {$output['script'] = "";}
			$output['style'] = '"Merriweather",serif';
			return $output; break;
		case "mavenpro" : 
			if($facerepeat == false) { $output['script'] = '<link href="//fonts.googleapis.com/css?family=Maven+Pro:400,700" rel="stylesheet" type="text/css">' . "\n"; } else {$output['script'] = "";}
			$output['style'] = '"Maven Pro",serif';
			return $output; break;
		case "custom" : 
			if ($target == "heading") {
				if($facerepeat == false) { $output['script'] = of_get_option('custom_heading_font_url') . "\n"; } else {$output['script'] = "";}
				$output['style'] = '"' . of_get_option('custom_heading_font') . '",serif';
			}
			else {
				if($facerepeat == false) { $output['script'] = of_get_option('custom_content_font_url') . "\n"; } else {$output['script'] = "";}
				$output['style'] = '"' . of_get_option('custom_content_font') . '",serif';
			}
			return $output; break;
		default :
			$output['script'] = "";
			$output['style'] = '"' . $face . '",sans-serif';
			return $output;
	}
}

function font_style_selector($style) {
	switch($style) {
		case "italic":
			return "font-style: italic;"; break;
		case "bold":
			return "font-weight: bold;"; break;
		case "bold italic":
			return "font-style: italic; font-weight: bold;";
		default:
			return "font-style: normal; font-weight: normal;";			
	}
}

function of_head_css() {
	// Font face Selection
	$heading = of_get_option('heading_typography');	
	$content = of_get_option('content_typography');
	$theme_skin = of_get_option('color_scheme');
	$background_image = '';
	
	if(of_get_option('hide_custombg', false))
	$background_image .= 'body { background: transparent; }';
	
	// Content Background Image
	$background = of_get_option('theme_background');		
	if ($background['image']) {
		$background_image .= '#container {background: ' . $background['color'] . ' url(' . $background['image'] . ') ' . $background['repeat'] . ' ' . $background['position'] . ' ' . $background['attachment'] . ';}' . "\n";
	}
	elseif ($background['color']) {
		$background_image .= '#container {background: ' . $background['color'] . ';}' . "\n";
	}
	
	
	// Footer Background Image
	$foo_background_image = '';
	$foo_background = of_get_option('footer_background');	
	if ($foo_background['image']) {
		$foo_background_image .= '#footer {background: ' . $foo_background['color'] . ' url(' . $foo_background['image'] . ') ' . $foo_background['repeat'] . ' ' . $foo_background['position'] . ' ' . $foo_background['attachment'] . ';}' . "\n";
	}
	elseif ($foo_background['color']) {
		$foo_background_image .= '#footer {background: ' . $foo_background['color'] . ';}' . "\n";
	}
	
	
	// Typography
	$default = of_get_option('default_typography', 1);	
	$facerepeat = ($heading['face'] == $content['face'])? true : false;	
	$content_face = fontface_selector($content['face'], false, "content");
	$heading_face = fontface_selector($heading['face'], $facerepeat, "heading");
	$heading_style = $heading["style"];
	
	if($default) {
		$content = 'html, body {font-size: ' . $content["size"] . '; ' . font_style_selector($content['style']) . ' font-family: ' . $content_face["style"] . '; }' . "\n";
		$heading = 'h1,h2,h3,h4,h5,h6, #container .heading-style, #container .price { ' . font_style_selector($heading['style']) . ' font-family: ' . $heading_face['style'] . '; }' . "\n";
	} else {	
		$content = 'html, body {font-size: ' . $content["size"] . '; color: ' . $content["color"] . '; ' . font_style_selector($content['style']) . ' font-family: ' . $content_face["style"] . '; }' . "\n";
		$heading = 'h1,h2,h3,h4,h5,h6, #container .heading-style, #container .price { color: ' . $heading["color"] . '; ' . font_style_selector($heading['style']) . ' font-family: ' . $heading_face['style'] . '; }' . "\n";
	}
	
	echo $content_face['script'] . $heading_face['script'];
	
	// WooCommerce Styles
	$woocommerce_styles = '';
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		if(of_get_option('catalog_switch', false)) {
			global $woocommerce;
			$woocommerce_styles = '#container ul.products .button-small, #container form.cart, #container .login-block .icon-cart, div.info a.button.add_to_cart_button { display: none; } ' . "\n";
		}
	}
	
	// Adding All Custom Styles to Markup
	echo "\n<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $content . $heading . $background_image . $foo_background_image . $woocommerce_styles . of_get_option('add_styles') . "</style>\n";
}