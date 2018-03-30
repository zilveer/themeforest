<?php
/**
 * @package WordPress
 * @subpackage Smartbox
 */


add_action( 'after_setup_theme', 'designare_smartbox_setup' );

function designare_smartbox_setup(){

	/* Add theme-supported features. */
	/** 
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/**
	 * This theme uses post thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	/**
	 *	This theme supports woocommerce
	 */
	add_theme_support( 'woocommerce' );
		
	/**
	 *	This theme supports editor styles
	 */
	add_editor_style("/css/layout-style.css");
	
	/* Add custom actions. */
	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 */
	load_theme_textdomain( 'smartbox', get_template_directory() . '/languages' );
	
	$locale = get_locale();
	$locale_file = get_template_directory() . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
	/*

	/**
	 * Set the content width based on the theme's design and stylesheet.
	 */
	if ( ! isset( $content_width ) )
		$content_width = 900;
	
	
	/**
	 * Functions
	 * 
	 * This is the main functions file that can add some additional functionality to the theme.
	 * It calls an object from a manager class that inits all the needed functionality.
	 */
	
	//declare some global variables that will be used everywhere
	global $designare_new_meta_boxes,
		$designare_new_meta_post_boxes,
		$designare_new_meta_portfolio_boxes,
		$designare_buttons,
		$designare_data;
		$_designare_new_meta_box_des_templater;
	$_designare_new_meta_box_des_templater = array();
	$designare_new_meta_boxes=array();
	$designare_new_meta_post_boxes=array();
	$designare_new_meta_portfolio_boxes=array();
	$designare_buttons=array();
	$designare_data=new stdClass();
	
	/*----------------------------------------------------------------
	 *  DEFINE THE MAIN CONSTANTS
	 *---------------------------------------------------------------*/
	
	//main theme info constants
	define("DESIGNARE_THEMENAME", 'Smartbox');
	define("DESIGNARE_SHORTNAME", 'smartbox');
	$my_theme = wp_get_theme();
	define("DESIGNARE_VERSION", $my_theme->Version);
	
	global $des_theme_prefix; $des_theme_prefix = "smartbox_";
	
	//define the main paths and URLs
	define("DESIGNARE_LIB_PATH", get_template_directory() . '/lib/');
	define("DESIGNARE_LIB_URL", get_template_directory_uri().'/lib/');
	define("DESIGNARE_JS_PATH", get_template_directory_uri().'/js/');
	define("DESIGNARE_CSS_PATH", get_template_directory_uri().'/css/');
	
	define("DESIGNARE_FUNCTIONS_PATH", DESIGNARE_LIB_PATH . 'functions/');
	define("DESIGNARE_FUNCTIONS_URL", DESIGNARE_LIB_URL.'functions/');
	define("DESIGNARE_CLASSES_PATH", DESIGNARE_LIB_PATH.'classes/');
	define("DESIGNARE_OPTIONS_PATH", DESIGNARE_LIB_PATH.'options/');
	define("DESIGNARE_WIDGETS_PATH", DESIGNARE_LIB_PATH.'widgets/');
	define("DESIGNARE_SHORTCODES_PATH", DESIGNARE_LIB_PATH.'shortcodes/');
	define("DESIGNARE_PLUGINS_PATH", DESIGNARE_LIB_PATH.'plugins/');
	define("DESIGNARE_UTILS_URL", DESIGNARE_LIB_URL.'utils/');
	
	define("DESIGNARE_IMAGES_URL", DESIGNARE_LIB_URL.'images/');
	define("DESIGNARE_CSS_URL", DESIGNARE_LIB_URL.'css/');
	define("DESIGNARE_SCRIPT_URL", DESIGNARE_LIB_URL.'script/');
	define("DESIGNARE_PATTERNS_URL", get_template_directory_uri().'/images/smartbox_patterns/');
	$uploadsdir=wp_upload_dir();
	define("DESIGNARE_UPLOADS_URL", $uploadsdir['url']);
	
	//other constants
	$portfolio_permalink = is_string(get_option(DESIGNARE_SHORTNAME."_portfolio_permalink")) && get_option(DESIGNARE_SHORTNAME."_portfolio_permalink") != "" ? get_option(DESIGNARE_SHORTNAME."_portfolio_permalink") : 'portfolio';
	if (!defined('DESIGNARE_PORTFOLIO_POST_TYPE')){
		if (is_string(get_option(DESIGNARE_SHORTNAME."_portfolio_permalink")) && get_option(DESIGNARE_SHORTNAME."_portfolio_permalink") != ""){
			define('DESIGNARE_PORTFOLIO_POST_TYPE',get_option(DESIGNARE_SHORTNAME."_portfolio_permalink"));
		} else {
			define('DESIGNARE_PORTFOLIO_POST_TYPE','portfolio');
		}
	}
	define("DESIGNARE_TESTIMONIALS_POST_TYPE", 'testimonials');
	define("DESIGNARE_PARTNERS_POST_TYPE", 'partners');
	define("DESIGNARE_TEAM_POST_TYPE", 'team');
	define("DESIGNARE_SEPARATOR", '|*|');
	define("DESIGNARE_OPTIONS_PAGE", 'designare_options');
	define("DESIGNARE_GOOGLE_FONTS", "http://fonts.googleapis.com/css?family=Open+Sans".DESIGNARE_SEPARATOR."http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700".DESIGNARE_SEPARATOR."http://fonts.googleapis.com/css?family=Open+Sans:600".DESIGNARE_SEPARATOR);
	
	
	/*----------------------------------------------------------------
	 *  INCLUDE THE FUNCTIONS FILES
	 *---------------------------------------------------------------*/
			
	require_once (DESIGNARE_FUNCTIONS_PATH.'general.php');  //some main common functions
	add_action('wp_enqueue_scripts', 'designare_smartbox_style', 1);
	add_action('wp_enqueue_scripts','designare_smartbox_custom_head', 2);
	add_action('wp_enqueue_scripts', 'designare_scripts', 10);
	add_action('wp_head', 'designare_responsive_options', 11);
	add_action('wp_head','designare_css_options', 13);
	add_action('wp_enqueue_scripts','designare_load_fonts');

	require_once (DESIGNARE_FUNCTIONS_PATH.'stylesheet.php');  //some main common functions
	require_once (DESIGNARE_FUNCTIONS_PATH.'sidebars.php');  //the sidebar functionality
	if ( isset($_GET['page']) && $_GET['page'] == DESIGNARE_OPTIONS_PAGE ){
		require_once (DESIGNARE_CLASSES_PATH.'designare-options-manager.php');  //the theme options manager functionality
	}
	
	require_once (DESIGNARE_CLASSES_PATH.'designare-templater.php');  
	require_once (DESIGNARE_CLASSES_PATH.'designare-custom-data-manager.php');  
	require_once (DESIGNARE_CLASSES_PATH.'designare-custom-page.php');  
	require_once (DESIGNARE_CLASSES_PATH.'designare-custom-page-manager.php');  
	require_once (DESIGNARE_FUNCTIONS_PATH.'custom-pages.php');  //the comments functionality
	require_once (DESIGNARE_FUNCTIONS_PATH.'ajax.php');  //AJAX handler functions
	require_once (DESIGNARE_FUNCTIONS_PATH.'portfolio.php');  //portfolio functionality
	require_once (DESIGNARE_FUNCTIONS_PATH.'testimonials.php');  //testimonials functionality
	require_once (DESIGNARE_FUNCTIONS_PATH.'partners.php');  //partners functionality
	require_once (DESIGNARE_FUNCTIONS_PATH.'team.php');  //team functionality
	require_once (DESIGNARE_FUNCTIONS_PATH.'comments.php');  //the comments functionality
	require_once (DESIGNARE_WIDGETS_PATH.'widgets.php');  //the widgets functionality
	require_once (DESIGNARE_FUNCTIONS_PATH.'options.php');  //the theme options functionality
	require_once (DESIGNARE_FUNCTIONS_PATH.'mdetect.php');  //the mobile detection functionality
	require_once (DESIGNARE_LIB_PATH.'classes/Mobile_Detect.php');
	
	
	if (is_admin()){
		require_once (DESIGNARE_FUNCTIONS_PATH. 'meta.php');  //adds the custom meta fields to the posts and pages
		add_action('admin_enqueue_scripts','designare_smartbox_admin_style');
		
		if (function_exists('vc_remove_element')){
			vc_remove_element('vc_carousel');
			vc_remove_element('vc_posts_slider');
			vc_remove_element('vc_posts_grid');
			vc_remove_element('vc_gallery');
			vc_remove_element('vc_images_carousel');
			vc_disable_frontend();
			vc_set_as_theme( $disable_updater = false );
		}
		
	}
	$functions_path = get_template_directory() . '/functions/';
	
	require_once ($functions_path . 'admin-init.php' );
	
	add_filter('add_to_cart_fragments' , 'woocommerce_header_add_to_cart_fragment' );
	
	// Declare sidebar widget zone
	if (function_exists('register_sidebar')) {
		register_sidebar(array(
			'name' => 'Blog Sidebar',
			'id'   => 'sidebar-widgets',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2>',
			'after_title'   => '</h2>'
		));
	}
	
	if (!function_exists('wp_pagenavi')){ 
		$including = $functions_path. 'wp-pagenavi.php';
	    require_once($including);
	}

	/* tgm plugin activator */
	
	/**
	 * This file represents an example of the code that themes would use to register
	 * the required plugins.
	 *
	 * It is expected that theme authors would copy and paste this code into their
	 * functions.php file, and amend to suit.
	 *
	 * @package	   TGM-Plugin-Activation
	 * @subpackage Example
	 * @version	   2.3.6
	 * @author	   Thomas Griffin <thomas@thomasgriffinmedia.com>
	 * @author	   Gary Jones <gamajo@gamajo.com>
	 * @copyright  Copyright (c) 2012, Thomas Griffin
	 * @license	   http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
	 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
	 */
	
	/**
	 * Include the TGM_Plugin_Activation class.
	 */
	require_once DESIGNARE_FUNCTIONS_PATH . 'class-tgm-plugin-activation.php';
	
	add_action( 'tgmpa_register', 'my_theme_register_required_plugins' );
	
}


function woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
	ob_start();
	?>
	<div class="smartbox_dynamic_shopping_bag">
        <div class="smartbox_little_shopping_bag_wrapper">
            <div class="smartbox_little_shopping_bag">
                <div class="title">
                	<i class="icon-shopping-cart"></i>
                </div>
                <div class="overview"><?php echo $woocommerce->cart->get_cart_total(); ?> <span class="minicart_items">/ <?php echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'smartbox'), $woocommerce->cart->cart_contents_count); ?></span></div>
            </div>
            <div class="smartbox_minicart_wrapper">
                <div class="smartbox_minicart">
                <?php
                echo '<ul class="cart_list">';
                    if (sizeof($woocommerce->cart->cart_contents)>0) : foreach ($woocommerce->cart->cart_contents as $cart_item_key => $cart_item) :
                        $_product = $cart_item['data'];
                        if ($_product->exists() && $cart_item['quantity']>0) :                                            
                            echo '<li class="cart_list_product">';
                                echo '<a class="cart_list_product_img" href="'.get_permalink($cart_item['product_id']).'">' . $_product->get_image().'</a>';
                                echo '<div class="cart_list_product_title">';
                                    $smartbox_product_title = $_product->get_title();
                                    $smartbox_short_product_title = (strlen($smartbox_product_title) > 28) ? substr($smartbox_product_title, 0, 25) . '...' : $smartbox_product_title;
                                    echo '<a href="'.get_permalink($cart_item['product_id']).'">' . apply_filters('woocommerce_cart_widget_product_title', $smartbox_short_product_title, $_product) . '</a>';
                                    echo '<div class="cart_list_product_quantity">'.__('Quantity:', 'smartbox').' '.$cart_item['quantity'].'</div>';
                                echo '</div>';
                                echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove" title="%s">&times;</a>', esc_url( $woocommerce->cart->get_remove_url( $cart_item_key ) ), __('Remove this item', 'smartbox') ), $cart_item_key );
                                echo '<div class="cart_list_product_price">'.woocommerce_price($_product->get_price()).'</div>';
                                echo '<div class="clr"></div>';
                            echo '</li>';
                        endif;
                    endforeach;
                    ?>
                    <div class="minicart_total_checkout">
                        <?php _e('Cart subtotal', 'smartbox'); ?><span><?php echo $woocommerce->cart->get_cart_total(); ?></span>
                    </div>
                    <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="button smartbox_minicart_cart_but"><?php _e('View Shopping Bag', 'smartbox'); ?></a>
                    <a href="<?php echo esc_url( $woocommerce->cart->get_checkout_url() ); ?>" class="button smartbox_minicart_checkout_but"><?php _e('Proceed to Checkout', 'smartbox'); ?></a>
                    <?php                                    
                    else: echo '<li class="empty">'.__('No products in the cart.','woothemes').'</li>'; endif;
                echo '</ul>';
                ?>
                </div>
            </div>
        </div>
        <a href="<?php echo esc_url( $woocommerce->cart->get_cart_url() ); ?>" class="smartbox_little_shopping_bag_wrapper_mobiles"><span><?php echo $woocommerce->cart->cart_contents_count; ?></span></a>
        <script type="text/javascript">
	        $(".smartbox_little_shopping_bag_wrapper").on("mouseenter mouseover", function() {
				console.log('over');
				if(!$(this).data('init')){
		            $(this).data('init', true);
		            $(this).hover(
		                function(){
							$('.smartbox_minicart_wrapper').fadeIn(200);
							$('.smartbox_little_shopping_bag').css("background","none");
		                },
		                function(){
		                    $('.smartbox_minicart_wrapper').fadeOut(200);
							$('.smartbox_little_shopping_bag').css("background","#fff");
		                }
		            );
		            $(this).trigger('mouseenter');
		        }
			});
			$("ul.cart_list li").mouseenter(function(){
				$(this).children('.remove').fadeIn(0);
			}).mouseleave(function(){
				$(this).children('.remove').fadeOut(0);
			});	
        </script>
    </div>
	<?php
	$fragments['div.smartbox_dynamic_shopping_bag' ] = ob_get_clean();
	return $fragments;
}

function designare_smartbox_admin_style(){
	wp_enqueue_style('css19', DESIGNARE_CSS_PATH .'font-awesome-painel.min.css');
}

function des_get_value($values, $key = null, $array = null){
	global $des_templater;
	if ($array === null) $array = $des_templater;
	if ($key === null) $key = "id";
    $results = array();
    if (is_array($array)){
        if (isset($array[$key]) && $array[$key] == $values)
            $results[] = $array;
        foreach ($array as $subarray){
	        $results = array_merge($results, des_search_value($values, $key, $subarray));
        }
    }
    if (isset($results[0]['value'])){
	    return $results[0]['value'];
    } else {
	    return false;
    }
}

function des_search_value($values, $key, $array){
    $results = array();
    if (is_array($array)){
        if (isset($array[$key]) && $array[$key] == $values)
            $results[] = $array;
        foreach ($array as $subarray){
	        $results = array_merge($results, des_search_value($values, $key, $subarray));
        }
    }
    return $results;
}

function designare_css_options(){
	global $smartbox_custom, $smartbox_styleColor, $post, $des_templater;
	$des_templater = array();
	$styleTabs = array("general","body","header","menu","pagetitle","footer","text");
	$options = array();
	foreach($styleTabs as $tab){
		$options = get_option("des_template_[".$tab."]_".get_post_meta(get_the_ID(), "load_".$tab."_template_value", true));
		if (gettype($options) != "array"){
			$options = unserialize(trim($options));
			if (gettype($options) === "string") {
				$options = unserialize($options);
			}
		}
		if (get_post_meta(get_the_ID(), "enable_".$tab."_template_value", true) === "yes" && count($options) > 0){
			$panel_options_values = array();
			for ($i=0; $i<count($options); $i++){
				if (isset($options[$i][0]))	$id = $options[$i][0];
				if (isset($options[$i][1])) $value = $options[$i][1];
				$aux = array("id"=>"$id", "value"=>"$value");
				array_push($panel_options_values, $aux);
			}			
			array_push($des_templater,$panel_options_values);
		} else {
			$des = DESIGNARE_SHORTNAME;
			switch ($tab){
				case "general":
					$panel_options_list = array($des."_style_defcolor", $des."_style_color");
				break;
				case "body":
					$panel_options_list = array($des."_body_layout_type", $des."_body_type", $des."_body_image", $des."_body_color", $des."_body_pattern", $des."_header_body_pattern", $des."_body_shadow", $des."_body_shadow_color", $des."_contentbg_type", $des."_contentbg_image", $des."_contentbg_color", $des."_contentbg_pattern", $des."_contentbg_custom_pattern", $des."_globalborders_bg_color");
				break;
				case "header":
					$panel_options_list = array($des."_enable_top_panel", $des."_toppanelbg_type", $des."_toppanelbg_image", $des."_toppanelbg_color", $des."_toppanelbg_pattern", $des."_toppanelbg_custom_pattern", $des."_toppanel_borderscolor", $des."_toppanel_linkscolor", $des."_toppanel_paragraphscolor", $des."_toppanel_headingscolor", $des."_info_above_menu", $des."_wpml_menu_widget", $des."_woocommerce_menu", $des."_woocommerce_shopping_cart", $des."_top_bar_menu", $des."_topbar_text_color", $des."_topbar_links_color", $des."_topbar_links_hover_color", $des."_topbar_bg_color", $des."_topbarborders_bg_color", $des."_social_icons_style", $des."_headerbg_type", $des."_headerbg_image", $des."_headerbg_color", $des."_headerbg_pattern", $des."_headerbg_custom_pattern", $des."_header_bordertopcolor", $des."_header_borderbottomcolor", $des."_header_bordersearchcolor", $des."_hide_headershadow", $des."_social_icons_style_four", $des."_search_menu_widget");
				break;
				case "menu":
					$panel_options_list = array($des."_menu_font", $des."_menu_font_size", $des."_menu_color", $des."_menu_uppercase", $des."_menu_background_color", $des."_menu_side_margin", $des."_big_menu_margin_top", $des."_big_menu_padding_bottom", $des."_small_menu_margin_top", $des."_small_menu_padding_bottom");
				break;
				case "pagetitle":
					$panel_options_list = array($des."_header_type", $des."_page_title_shadow", $des."_page_title_shadow_color", $des."_header_image", $des."_header_color", $des."_header_pattern", $des."_header_custom_pattern", $des."_banner_slider", $des."_header_height", $des."_hide_pagetitle", $des."_header_text_font", $des."_header_text_color", $des."_header_text_size", $des."_header_text_margin_top", $des."_hide_sec_pagetitle", $des."_secondary_title_font", $des."_secondary_title_text_color", $des."_secondary_title_text_size", $des."_breadcrumbs_text_margin_top", $des."_breadcrumbs");
				break;
				case "footer":
					$panel_options_list = array($des."_show_twitter_newsletter_footer", $des."_show_twitter_scroller", $des."_newsletter_enabled", $des."_twitter_newsletter_type", $des."_twitter_newsletter_image", $des."_twitter_newsletter_color", $des."_twitter_newsletter_pattern", $des."_twitter_newsletter_pattern", $des."_twitter_newsletter_borderscolor", $des."_show_primary_footer", $des."_footerbg_type", $des."_footerbg_image", $des."_footerbg_color", $des."_footerbg_pattern", $des."_footerbg_custom_pattern", $des."_footerbg_borderscolor", $des."_footerbg_linkscolor", $des."_footerbg_paragraphscolor", $des."_footerbg_headingscolor", $des."_show_sec_footer", $des."_sec_footerbg_type", $des."_sec_footerbg_image", $des."_sec_footerbg_color", $des."_sec_footerbg_pattern", $des."_sec_footerbg_custom_pattern", $des."_sec_footerbg_borderscolor", $des."_sec_footerbg_linkscolor", $des."_sec_footerbg_paragraphscolor");
				break;
				case "text":
					$panel_options_list = array($des."_links_font", $des."_links_size", $des."_links_color", $des."_links_color_hover", $des."_links_bg_color_hover", $des."_p_font", $des."_p_size", $des."_p_color", $des."_st_font", $des."_st_size", $des."_st_color", $des."_h1_font", $des."_h1_size", $des."_h1_color", $des."_h2_font", $des."_h2_size", $des."_h2_color", $des."_h3_font", $des."_h3_size", $des."_h3_color", $des."_h4_font", $des."_h4_size", $des."_h4_color", $des."_h5_font", $des."_h5_size", $des."_h5_color", $des."_h6_font", $des."_h6_size", $des."_h6_color");
				break;
			}
			$idx = 0;
			$panel_options_values = array();
			foreach($panel_options_list as $op){
				array_push($panel_options_values, array("id"=>$panel_options_list[$idx], "value"=>(string)get_option($op)));
				$idx++;
			}
			array_push($des_templater,$panel_options_values);
		}
	}
	$smartbox_styleColor = "#".des_get_value(DESIGNARE_SHORTNAME."_style_defcolor");
	if ("#".des_get_value(DESIGNARE_SHORTNAME."_style_color") != $smartbox_styleColor) $smartbox_styleColor = "#".des_get_value(DESIGNARE_SHORTNAME."_style_color");
	$bodyLayoutType = des_get_value(DESIGNARE_SHORTNAME."_body_layout_type");
	if (empty($bodyLayoutType)) $bodyLayoutType = des_get_value(DESIGNARE_SHORTNAME."_body_layout_type option:selected");
	$headerType = des_get_value(DESIGNARE_SHORTNAME."_header_type");
	if (empty($headerType)) $headerType = des_get_value(DESIGNARE_SHORTNAME."_header_type option:selected");
	global $post;
	if (!is_404() && get_post_meta($post->ID, 'des_custom_header_style_value', true) == "on"){
		$headerStyleType = get_post_meta($post->ID, 'headerStyleType_value', true);
	} else {
		$headerStyleType = get_option(DESIGNARE_SHORTNAME."_header_style_type");
	}
	$msie = strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE') ? "true" : "false";
	?>
	<!-- Style Options -->
	<style type="text/css">
		a:not(.sf-with-ul){
 			<?php 
		 		$font = des_get_value(DESIGNARE_SHORTNAME."_links_font");
		 		if (empty($font)) $font = des_get_value(DESIGNARE_SHORTNAME."_links_font option:selected");
		 		if ($font == "Helvetica" || $font == "Helvetica Neue"){
			 		if ($msie === "true"){
				 		echo 'font-family: Arial !important;';
			 		} else {
				 		echo 'font-family: "'.$font.'", Arial, sans-serif;';
			 		}
		 		}
		 		else echo 'font-family: "'.$font.'";';
			 ?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_links_size")) echo "font-size: " . str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME."_links_size")) . ";"; ?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_links_color")) echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_links_color") . ";"; ?>
 		}
 		
 		table, dl, ol li, ul li{
	 		<?php
	 		$font = des_get_value(DESIGNARE_SHORTNAME."_p_font");
	 		if (empty($font)) $font = des_get_value(DESIGNARE_SHORTNAME."_p_font option:selected");
	 		if($font){
	 			$font = des_get_value(DESIGNARE_SHORTNAME."_p_font");
		 		if ($font == "Helvetica" || $font == "Helvetica Neue"){
			 		if ($msie === "true"){
				 		echo 'font-family: Arial !important;';
			 		} else {
				 		echo 'font-family: "'.$font.'", Arial, sans-serif;';
			 		}
		 		}
		 		else echo 'font-family: "'.$font.'";';
 			} ?>
 		}
 		
 		p, #testimonials2 .testi-text p, .special_tabs .label span.tab_title, .the_content{
 			<?php 
	 		$font = des_get_value(DESIGNARE_SHORTNAME."_p_font");
	 		if (empty($font)) $font = des_get_value(DESIGNARE_SHORTNAME."_p_font option:selected");
 			if($font){
		 		if ($font == "Helvetica" || $font == "Helvetica Neue"){
			 		if ($msie === "true"){
				 		echo 'font-family: Arial !important;';
			 		} else {
				 		echo 'font-family: "'.$font.'", Arial, sans-serif;';
			 		}
		 		}
		 		else echo 'font-family: "'.$font.'";';
 			}
 			?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_p_size")) echo "font-size: " . str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME."_p_size")) . ";"; ?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_p_color")) echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_p_color") . ";"; ?>
 			word-wrap: break-word;
 		}
 		
 		h1{
 			<?php 
	 		$font = des_get_value(DESIGNARE_SHORTNAME."_h1_font");
	 		if (empty($font)) $font = des_get_value(DESIGNARE_SHORTNAME."_h1_font option:selected");
	 		if($font){
		 		if ($font == "Helvetica" || $font == "Helvetica Neue"){
			 		if ($msie === "true"){
				 		echo 'font-family: Arial !important;';
			 		} else {
				 		echo 'font-family: "'.$font.'", Arial, sans-serif;';
			 		}
		 		}
		 		else echo 'font-family: "'.$font.'";';
 			}
 			?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_h1_size")) echo "font-size: " . str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME."_h1_size")) . ";"; ?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_h1_color")) echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_h1_color") . ";"; ?>
 		}
 		
 		h2{
 			<?php 
 			$font = des_get_value(DESIGNARE_SHORTNAME."_h2_font");
 			if (empty($font)) $font = des_get_value(DESIGNARE_SHORTNAME."_h2_font option:selected");
 			if($font){
		 		if ($font == "Helvetica" || $font == "Helvetica Neue"){
			 		if ($msie === "true"){
				 		echo 'font-family: Arial !important;';
			 		} else {
				 		echo 'font-family: "'.$font.'", Arial, sans-serif;';
			 		}
		 		}
		 		else echo 'font-family: "'.$font.'";';
 			}
 			?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_h2_size")) echo "font-size: " . str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME."_h2_size")) . ";"; ?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_h2_color")) echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_h2_color") . ";"; ?>
 		}
 		
 		h3{
 			<?php 
	 		$font = des_get_value(DESIGNARE_SHORTNAME."_h3_font");
	 		if (empty($font)) $font = des_get_value(DESIGNARE_SHORTNAME."_h3_font option:selected");	
	 		if($font){
		 		if ($font == "Helvetica" || $font == "Helvetica Neue"){
			 		if ($msie === "true"){
				 		echo 'font-family: Arial !important;';
			 		} else {
				 		echo 'font-family: "'.$font.'", Arial, sans-serif;';
			 		}
		 		}
		 		else echo 'font-family: "'.$font.'";';
 			}
 			?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_h3_size")) echo "font-size: " . str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_h3_size")) . ";"; ?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_h3_color")) echo "color: #" . get_option(DESIGNARE_SHORTNAME."_h3_color") . ";"; ?>
 		}
 		
 		h4{
 			<?php 
 			$font = des_get_value(DESIGNARE_SHORTNAME."_h4_font");
 			if (empty($font)) $font = des_get_value(DESIGNARE_SHORTNAME."_h4_font option:selected");
	 		if($font){
		 		if ($font == "Helvetica" || $font == "Helvetica Neue"){
			 		if ($msie === "true"){
				 		echo 'font-family: Arial !important;';
			 		} else {
				 		echo 'font-family: "'.$font.'", Arial, sans-serif;';
			 		}
		 		}
		 		else echo 'font-family: "'.$font.'";';
 			}
 			?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_h4_size")) echo "font-size: " . str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME."_h4_size")) . ";"; ?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_h4_color")) echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_h4_color") . ";"; ?>
 		}
 		
 		h5{
 			<?php 
 			$font = des_get_value(DESIGNARE_SHORTNAME."_h5_font");
 			if (empty($font)) $font = des_get_value(DESIGNARE_SHORTNAME."_h5_font option:selected");
 			if($font){
		 		if ($font == "Helvetica" || $font == "Helvetica Neue"){
			 		if ($msie === "true"){
				 		echo 'font-family: Arial !important;';
			 		} else {
				 		echo 'font-family: "'.$font.'", Arial, sans-serif;';
			 		}
		 		}
		 		else echo 'font-family: "'.$font.'";';
 			}
 			?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_h5_size")) echo "font-size: " . str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME."_h5_size")) . ";"; ?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_h5_color")) echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_h5_color") . ";"; ?>
 		}
 		
 		h6{
 			<?php 
 			$font = des_get_value(DESIGNARE_SHORTNAME."_h6_font");
 			if (empty($font)) $font = des_get_value(DESIGNARE_SHORTNAME."_h6_font option:selected");
 			if($font){
		 		if ($font == "Helvetica" || $font == "Helvetica Neue"){
			 		if ($msie === "true"){
				 		echo 'font-family: Arial !important;';
			 		} else {
				 		echo 'font-family: "'.$font.'", Arial, sans-serif;';
			 		}
		 		}
		 		else echo 'font-family: "'.$font.'";';
 			}
 			?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_h6_size")) echo "font-size: " . str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME."_h6_size")) . ";"; ?>
 			<?php if(des_get_value(DESIGNARE_SHORTNAME."_h6_color")) echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_h6_color") . ";"; ?>
 		}
 				
		body{
			<?php 
			if ($bodyLayoutType == "boxed"){?>
				visibility:hidden;		
				<?php 
				$bodytype = des_get_value(DESIGNARE_SHORTNAME.'_body_type option:selected');
				if (empty($bodytype)) $bodytype = des_get_value(DESIGNARE_SHORTNAME.'_body_type');
				if ($bodytype == "none") echo "background: none;";
				if ($bodytype == "color") echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_body_color") . ";";
	 			if ($bodytype == "pattern")
					echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_body_pattern") . "') 0 0 repeat fixed;";
				if ($bodytype == "custom_pattern")
					echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_header_body_pattern") . "') 0 0 repeat fixed;";
				if ($bodytype == "image"){
					echo "background-repeat:no-repeat; background-position:center center; -o-background-size: 100% 100%, auto; -moz-background-size: 100% 100%, auto; -webkit-background-size: 100% 100%, auto; background-size: 100% 100%, auto;";
					echo "background: url(" . des_get_value(DESIGNARE_SHORTNAME."_body_image") . ") no-repeat fixed; background-size: 100% 100%";  
				}
			} 
			if ($bodyLayoutType == "full") { 
				$contentbgtype = des_get_value(DESIGNARE_SHORTNAME.'_contentbg_type');
				if (empty($contentbgtype)) $contentbgtype = des_get_value(DESIGNARE_SHORTNAME.'_contentbg_type option:selected');
				if ($contentbgtype == "color") echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_contentbg_color") . " !important;";
				if ($contentbgtype == "pattern") echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_contentbg_pattern") . "') 0 0 repeat fixed !important;";
				if ($contentbgtype == "custom_pattern") echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_contentbg_custom_pattern") . "') 0 0 repeat fixed !important;";
				if ($contentbgtype == "image"){
					echo "background-repeat:no-repeat; background-position:center center; -o-background-size: 100% 100%, auto; -moz-background-size: 100% 100%, auto; -webkit-background-size: 100% 100%, auto; background-size: 100% 100%, auto !important;";
					echo "background: url(" . des_get_value(DESIGNARE_SHORTNAME."_contentbg_image") . ") no-repeat fixed; background-size: 100% 100% !important;";
				}
			} 
			?>
		}
		
		.copys{
		<?php
			if (des_get_value(DESIGNARE_SHORTNAME."_show_sec_footer") == "off"){
				echo "display: none;";
			} else {
				$secfooterbgtype = des_get_value(DESIGNARE_SHORTNAME."_sec_footerbg_type");
				if (empty($secfooterbgtype)) $secfooterbgtype = des_get_value(DESIGNARE_SHORTNAME."_sec_footerbg_type option:selected");
				if ($secfooterbgtype == "color") echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_sec_footerbg_color") . ";";
				if ($secfooterbgtype == "pattern") echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_sec_footerbg_pattern") . "') 0 0 repeat;";
				if ($secfooterbgtype == "custom_pattern") echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_sec_footerbg_custom_pattern") . "') 0 0 repeat;";
				if ($secfooterbgtype == "image"){
					echo "background-repeat:no-repeat; background-position:center center; -o-background-size: 100% 100%, auto; -moz-background-size: 100% 100%, auto; -webkit-background-size: 100% 100%, auto; background-size: 100% 100%, auto;";
					echo "background: url(" . des_get_value(DESIGNARE_SHORTNAME."_sec_footerbg_image") . ") no-repeat fixed; background-size: 100% 100%";  
				}	
			}
		?>
		}
		
		#toppanel, #toppanel h4, #toppanel h4, #toppanel h4.page_title_testimonials, #toppanel .title h4, #toppanel .h-widget-test{
		<?php
			$toppanelbgtype = des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_type");
			if (empty($toppanelbgtype)) $toppanelbgtype = des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_type option:selected");
			if ($toppanelbgtype == "color") echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_color") . ";";
			if ($toppanelbgtype == "pattern") echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_pattern") . "') 0 0 repeat fixed;";
			if ($toppanelbgtype == "custom_pattern") echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_custom_pattern") . "') 0 0 repeat fixed;";
			if ($toppanelbgtype == "image"){
				echo "background-repeat:no-repeat; background-position:center center; -o-background-size: 100% 100%, auto; -moz-background-size: 100% 100%, auto; -webkit-background-size: 100% 100%, auto; background-size: 100% 100%, auto;";
				echo "background: url(" . des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_image") . ") no-repeat fixed;";  
			}
		?>
		}
		
		#toppanel .contact-form textarea, #toppanel .contact-form input, #toppanel .socialdiv ul li a{
			<?php echo "border: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_borderscolor") . " !important;" ?>
		}
		#toppanel .recentPosts .post_type, #toppanel .post-listing .post_type{
			<?php echo "border-right: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_borderscolor") . " !important;" ?>
			<?php echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_borderscolor") . " !important;" ?>
			<?php echo "border-left: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_borderscolor") . " !important;" ?>
		}
		#toppanel hr{
			<?php echo "border-top: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_borderscolor") . " !important;" ?>
			<?php echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_borderscolor") . " !important;" ?>
		}
		#toppanel .posts_row, #toppanel .tests_row{
			<?php echo "border-bottom: 1px dashed #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_borderscolor") . " !important;" ?>

		}
		#toppanel .menu li:first-child{
			<?php echo "border-top: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_borderscolor") . " !important;" ?>
		}
		
		#toppanel .textwidget, #toppanel .post-date, #toppanel .textwidget p, #toppanel .contact-form input, #toppanel .contact-form textarea, #toppanel p, #toppanel #testimonials2 .testi-text p, #toppanel .special_tabs .label span.tab_title{
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_paragraphscolor") . " !important;" ?>
		}
		
		#toppanel a{
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_linkscolor") . " !important;" ?>
		}
		
		#toppanel h4, #toppanel h4, #toppanel h4.page_title_testimonials, #toppanel .title h4, #toppanel .h-widget-test, #toppanel .home_widget .page_info_title_s3, #toppanel .home_widget .page_info_title_s4, #toppanel page_info_title_testimonials, #toppanel .smartboxtitle span{
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_headingscolor") . " !important;" ?>
		}
		
		.fullwidth_container.style-top-bar{
			<?php echo "background-color: #" . des_get_value(DESIGNARE_SHORTNAME."_topbar_bg_color") . " !important;" ?>
		}
		
		.header_container, #toppanel_trigger, .smartbox_minicart{
		<?php
			$headerbgtype = des_get_value(DESIGNARE_SHORTNAME."_headerbg_type");
			if (empty($headerbgtype)) $headerbgtype = des_get_value(DESIGNARE_SHORTNAME."_headerbg_type option:selected");
			if ($headerbgtype == "color") echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_color") . " !important;";
			if ($headerbgtype == "pattern") echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_pattern") . "') 0 0 repeat !important;";
			if ($headerbgtype == "custom_pattern") echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_custom_pattern") . "') 0 0 repeat !important;";
			if ($headerbgtype == "image"){
				echo "background-repeat:no-repeat; background-position:center center; -o-background-size: cover !important; -moz-background-size: cover !important; -webkit-background-size: cover !important; background-size: cover !important;";
				echo "background: url(" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_image") . ") no-repeat fixed; background-size: cover !important;";  
			}
			echo "border-top: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_header_bordertopcolor") . " !important;";
			echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_header_borderbottomcolor") . " !important;"; ?>
			-webkit-transition: background 0 linear;
		    -moz-transition: background 0 linear;
		    -o-transition: background 0 linear;
		    transition: background 0 linear;
		}
		 .dl-menuwrapper ul{
			 <?php
			$headerbgtype = des_get_value(DESIGNARE_SHORTNAME."_headerbg_type");
			if (empty($headerbgtype)) $headerbgtype = des_get_value(DESIGNARE_SHORTNAME."_headerbg_type option:selected");
			if ($headerbgtype == "color") echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_color") . " !important;";
			if ($headerbgtype == "pattern") echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_pattern") . "') 0 0 repeat !important;";
			if ($headerbgtype == "custom_pattern") echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_custom_pattern") . "') 0 0 repeat !important;";
			if ($headerbgtype == "image"){
				echo "background-repeat:no-repeat; background-position:center center; -o-background-size: cover !important; -moz-background-size: cover !important; -webkit-background-size: cover !important; background-size: cover !important;";
				echo "background: url(" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_image") . ") no-repeat fixed; background-size: cover !important;";  
			}
			?>
		 }
		.sf-menu li li a{
			<?php echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_color") . ";" ?>
		}
		.n-hc{
			<?php
				if ($headerbgtype == "image"){
					echo "background-attachment: scroll; background-size: cover !important;";  
				}
			?>
		}

		.fullwidth_container_menu{ 
		<?php
			$headerbgtype = des_get_value(DESIGNARE_SHORTNAME."_headerbg_type");
			if (empty($headerbgtype)) $headerbgtype = des_get_value(DESIGNARE_SHORTNAME."_headerbg_type option:selected");
			if ($headerbgtype == "color") echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_color") . " !important;";
			if ($headerbgtype == "pattern") echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_pattern") . "') 0 0 repeat !important;";
			if ($headerbgtype == "custom_pattern") echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_custom_pattern") . "') 0 0 repeat !important;";
			echo "border-top: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_header_borderbottomcolor") . " !important;";
			echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_header_borderbottomcolor") . " !important;"; ?>
			-webkit-transition: background 0 linear;
		    -moz-transition: background 0 linear;
		    -o-transition: background 0 linear;
		    transition: background 0 linear;
		}
		
		.sub-menu a, .headerstyle-style3 #menulava .sub-menu{
			<?php
				$headerbgtype = des_get_value(DESIGNARE_SHORTNAME."_headerbg_type");
				if (empty($headerbgtype)) $headerbgtype = des_get_value(DESIGNARE_SHORTNAME."_headerbg_type option:selected");
				if ($headerbgtype == "color") echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_color") . " !important;";
				if ($headerbgtype == "pattern") echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_pattern") . "') 0 0 repeat !important;";
				if ($headerbgtype == "custom_pattern") echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_custom_pattern") . "') 0 0 repeat !important;";
				if ($headerbgtype == "image"){
					echo "background-attachment: fixed !important; background-size: cover !important;background: url(" . des_get_value(DESIGNARE_SHORTNAME."_headerbg_image") . ") no-repeat ;";  
				}
				echo "border-color:#".des_get_value(DESIGNARE_SHORTNAME."_header_borderbottomcolor")." !important;";
			?>
		}
		.dl-menuwrapper li a{
			<?php echo "border-bottom:1px solid #".des_get_value(DESIGNARE_SHORTNAME."_header_borderbottomcolor").";";
			?>

		}
		.headerstyle-style4 #menulava > li.current-menu-ancestor{
			border-top: 1px solid <?php echo $smartbox_styleColor; ?> !important;
			top: -1px;
		}
		.headerstyle-style4 #menulava > li:hover{
			border-top: 1px solid <?php echo $smartbox_styleColor; ?> !important;
			top: -1px;
		}
		
		.headerstyle-style4 #menulava > li:hover{border-top: 1px solid red;top: -1px;}
		
		#searchform_top, #toppanel_trigger, .trigger_toppanel_closer{
			<?php echo "border: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_header_bordersearchcolor") . " !important;" ?>
		}
		
		#s_top:focus{
			<?php echo "border: 5px solid #" . des_get_value(DESIGNARE_SHORTNAME."_header_bordersearchcolor") . " !important;" ?>
		}
		
		#white_content, #wrapper, .home_widget .page_info_title_s3, .home_widget .page_info_title_s4, page_info_title_testimonials, .smartboxtitle span, .pag-proj2_s3,.recentPosts .post_type, .post-listing .post_type, #tabs .panes, #tabs ul.tabs li a.current, .page_title_s4 .pag-proj2_s4, .page_title_s2 .pag-proj2_s2, .team_header .pag-proj_team, .shortcode-partners .pag-proj_partners, .pag-testimonials, .wpb_heading, .entry-content .wpb_heading, .contact-form textarea, .contact-form input, #accordion .acc-title h2.current, .acc-substitute .acc-title h2.current, #accordion .acc-title h2, .acc-substitute .acc-title h2{
		<?php
			$contentbgtype = des_get_value(DESIGNARE_SHORTNAME.'_contentbg_type');
			if (empty($contentbgtype)) $contentbgtype = des_get_value(DESIGNARE_SHORTNAME.'_contentbg_type option:selected');
			if ($contentbgtype == "color") echo "background-color: #" . des_get_value(DESIGNARE_SHORTNAME."_contentbg_color") . " !important;";
			if ($contentbgtype == "pattern") echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_contentbg_pattern") . "') 0 0 repeat fixed !important;";
			if ($contentbgtype == "custom_pattern") echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_contentbg_custom_pattern") . "') 0 0 repeat fixed !important;";
			if ($contentbgtype == "image"){
				echo "background-repeat:no-repeat; background-position:center center; -o-background-size: 100% 100%, auto; -moz-background-size: 100% 100%, auto; -webkit-background-size: 100% 100%, auto; background-size: 100% 100%, auto !important;";
				echo "background: url(" . des_get_value(DESIGNARE_SHORTNAME."_contentbg_image") . ") no-repeat fixed; background-size: 100% 100% !important;";  
			}
		?>
		}
		#big_footer .home_widget .page_info_title_s3, #big_footer .home_widget .page_info_title_s4, #big_footer page_info_title_testimonials, #big_footer .smartboxtitle span, #big_footer .pag-proj2_s3,.recentPosts .post_type, #big_footer .post-listing .post_type, #big_footer #tabs .panes, #big_footer #tabs ul.tabs li a.current, #big_footer .page_title_s4 .pag-proj2_s4, #big_footer .page_title_s2 .pag-proj2_s2, #big_footer .team_header .pag-proj_team, #big_footer .shortcode-partners .pag-proj_partners, #big_footer .pag-testimonials{
		<?php
			$bigfootertype = des_get_value(DESIGNARE_SHORTNAME."_footerbg_type");
			if (empty($bigfootertype)) $bigfootertype = des_get_value(DESIGNARE_SHORTNAME."_footerbg_type option:selected");
			if ($bigfootertype == "color") echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_color") . " !important;";
			if ($bigfootertype == "pattern") echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_pattern") . "') 0 0 repeat fixed !important;";
			if ($bigfootertype == "custom_pattern") echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_custom_pattern") . "') 0 0 repeat fixed !important;";
			if ($bigfootertype == "image"){
				echo "background-repeat:no-repeat; background-position:center center; -o-background-size: 100% 100%, auto; -moz-background-size: 100% 100%, auto; -webkit-background-size: 100% 100%, auto; background-size: 100% 100%, auto !important;";
				echo "background: url(" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_image") . ") no-repeat fixed; background-size: 100% 100% !important;";  
			}
		?>
		}
		#toppanel .page_info_title_s3, #toppanel .page_info_title_s4, #toppanel page_info_title_testimonials, #toppanel .smartboxtitle span, #toppanel .pag-proj2_s3,.recentPosts .post_type, #toppanel .post-listing .post_type, #toppanel #tabs .panes, #toppanel #tabs ul.tabs li a.current, #toppanel .page_title_s4 .pag-proj2_s4, #toppanel .page_title_s2 .pag-proj2_s2, #toppanel .team_header .pag-proj_team, #toppanel .shortcode-partners .pag-proj_partners, #toppanel .pag-testimonials{
		<?php
			$toppanelbgtype = des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_type");
			if (empty($toppanelbgtype)) $toppanelbgtype = des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_type option:selected");
			if ($toppanelbgtype == "color") echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_color") . " !important;";
			if ($toppanelbgtype == "pattern") echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_pattern") . "') 0 0 repeat fixed !important;";
			if ($toppanelbgtype == "custom_pattern") echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_custom_pattern") . "') 0 0 repeat fixed !important;";
			if ($toppanelbgtype == "image"){
				echo "background-repeat:no-repeat; background-position:center center; -o-background-size: 100% 100%, auto; -moz-background-size: 100% 100%, auto; -webkit-background-size: 100% 100%, auto; background-size: 100% 100%, auto !important;";
				echo "background: url(" . des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_image") . ") no-repeat fixed; background-size: 100% 100% !important;";  
			}
		?>
		}
		.fullwidth-section .smartboxtitle span{background: none !important;}
		
		.smartbox_little_shopping_bag{
			<?php echo "background-color: #" . des_get_value(DESIGNARE_SHORTNAME."_topbarborders_bg_color") . " !important;" ?>
		}
		.style-top-bar .info_above_menu .telephone, .style-top-bar .info_above_menu .email, .style-top-bar .info_above_menu .address, .style-top-bar .info_above_menu .textfield, .style-top-bar #lang_sel a, .top-bar-menu, .style-top-bar .socialdiv ul li, .style-top-bar .socialdiv-dark ul li{
			<?php echo "border-left: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_topbarborders_bg_color") . ";" ?>
			<?php echo "color:#".des_get_value(DESIGNARE_SHORTNAME."_topbar_text_color").";"; ?>
		}
		.info_above_menu .socialdiv, .info_above_menu .socialdiv-dark{
			<?php echo "border-right: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_topbarborders_bg_color") . ";" ?>
			<?php echo "border-left: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_topbarborders_bg_color") . ";" ?>
			right:-1px;
		}
		#menu_top_bar .sub-menu li a:hover{color:<?php echo $smartbox_styleColor; ?> !important;}
		.info_above_menu .email{
			<?php echo "border-right: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_topbarborders_bg_color") . ";" ?>
		}
		.style-top-bar a, .top-bar-menu ul li > a{
			<?php echo "color:#".des_get_value(DESIGNARE_SHORTNAME."_topbar_text_color").";"; ?>

		}
		.style-top-bar a:hover, .top-bar-menu ul li a:hover{
			<?php echo "color:#".des_get_value(DESIGNARE_SHORTNAME."_links_color_hover")." !important;"; ?>
		}
		
		.posts_row, .tests_row{
			<?php echo "border-bottom: 1px dashed #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>			
		}
		.fullwidth_container.style-top-bar{
			<?php echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_topbarborders_bg_color") . " !important;" ?>				
		}
		#toppanel .recentPosts .post_type i, #toppanel .post-listing .post_type i{
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_headingscolor") . " !important;" ?>

		}
		.des-sc-dots-divider, .special_tabs .label, .wpb_wrapper hr, .smartboxtitle hr{
			<?php echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>			
			<?php echo "border-top: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>
		}
	
		.simpleborder, .contact-form input, .contact-form textarea, #accordion .acc-title h2.current, .acc-substitute .acc-title h2.current, #accordion .acc-title h2, .acc-substitute .acc-title h2{
			<?php echo "border: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>
		}
		.recentPosts .data_type .data, .post .data_type .data, .project_list_s2_style2 .date{
			<?php echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_st_color") . " !important;" ?>
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_contentbg_color") . " !important;" ?>
		}
		.the_title a{
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_st_color") . " !important;" ?>
		}
		#toppanel .recentPosts .data_type .data, #toppanel .post .data_type .data{
			<?php echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_headingscolor") . " !important;" ?>
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_color") . " !important;" ?>
		}
		#big_footer .recentPosts .data_type .data, #big_footer .post .data_type .data{
			<?php echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_headingscolor") . " !important;" ?>
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_color") . " !important;" ?>
		}
		.recentPosts .post_type, .post-listing .post_type{
			<?php echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_contentbg_color") . " !important;" ?>
		}
		#toppanel .recentPosts .post_type, #toppanel .post-listing .post_type{
			<?php echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_toppanelbg_color") . " !important;" ?>
		}
		#big_footer .recentPosts .post_type, #big_footer .post-listing .post_type{
			<?php echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_color") . " !important;" ?>
		}
		#tabs .panes, .special_tabs .label{
			<?php echo "border: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>
		}
		 .special_tabs .label{
			<?php echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_contentbg_color") . " !important;" ?>
		 }
		#tabs ul.tabs li a{
			<?php echo "border-top: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>			
			<?php echo "border-left: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>
			<?php echo "border-right: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>			
		}
		.recentPosts .post_type, .post-listing .post_type{
			<?php echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>			
			<?php echo "border-left: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>
			<?php echo "border-right: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>			
		}
		#footer_content .more-chitem{color: #fff !important;}
		#footer_content .project_list_s3 .proj-title-tags, #footer_content #projects-1 .proj-title-tags, .ch-item, #toppanel .project_list_s3 .proj-title-tags, #toppanel #projects-1 .proj-title-tags, .ch-item{border: none !important;}
		.project_list_s3 .proj-title-tags, #projects-1 .proj-title-tags, .ch-item{
			<?php echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>
			<?php echo "border-right: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>
			<?php echo "border-left: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_globalborders_bg_color") . " !important;" ?>			
		}
		#footer_content .project_list_s3 .proj-title-tags, #footer_content #projects-1 .proj-title-tags, .ch-item, #toppanel .project_list_s3 .proj-title-tags, #toppanel #projects-1 .proj-title-tags, .ch-item{border: none !important;}
		#footer_content{
		<?php
			if (des_get_value(DESIGNARE_SHORTNAME."_show_primary_footer") == "off" && des_get_value(DESIGNARE_SHORTNAME."_show_twitter_newsletter_footer") == "off" && des_get_value(DESIGNARE_SHORTNAME."_show_secondary_footer") == "off"){
				echo "display: none;";
			}
		?>
		}
		
		/* Footer styles */

		.mail_chimp_form_container{
			<?php
				$twitternewslettertype = des_get_value(DESIGNARE_SHORTNAME."_twitter_newsletter_type");
				if (empty($twitternewslettertype)) $twitternewslettertype = des_get_value(DESIGNARE_SHORTNAME."_twitter_newsletter_type option:selected");
				if ($twitternewslettertype == "color") echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_twitter_newsletter_color") . " !important;";
				if ($twitternewslettertype == "pattern") echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_twitter_newsletter_pattern") . "') 0 0 repeat !important;";
				if ($twitternewslettertype == "custom_pattern") echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_twitter_newsletter_pattern") . "') 0 0 repeat !important;";
				if ($twitternewslettertype == "image"){
					echo "background-repeat:no-repeat; background-position:center center; -o-background-size: 100% 100%, auto; -moz-background-size: 100% 100%, auto; -webkit-background-size: 100% 100%, auto; background-size: 100% 100%, auto !important;";
					echo "background: url(" . des_get_value(DESIGNARE_SHORTNAME."_twitter_newsletter_image") . ") no-repeat; background-size: 100% 100%, auto !important;";  
				}
			?>
			<?php echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_twitter_newsletter_borderscolor") . " !important;" ?>
		}
		
		#footer_content .menu li{
			<?php echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_borderscolor") . " !important;" ?>
		}
		#footer_content .posts_row, #footer_content .tests_row{
			<?php echo "border-bottom: 1px dashed #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_borderscolor") . " !important;" ?>
		}
		.cutcorner_bottom{
			<?php echo "border-color: transparent #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_borderscolor") ." transparent transparent;" ?>
		}
		.cutcorner_top{
			<?php echo "border-color: #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_borderscolor") ." transparent transparent transparent;" ?>
		}
		#footer_content .contact-form textarea, #footer_content .contact-form input, .mail_chimp_form_container input, #footer_content .socialdiv ul li a{
			<?php echo "border: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_borderscolor") . " !important;" ?>
		}
		#footer_content hr{
			<?php echo "border-top: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_borderscolor") . " !important;" ?>
			<?php echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_borderscolor") . " !important;" ?>
		}
		#footer_content .recentPosts .post_type, #footer_content .post-listing .post_type{
			<?php echo "border-left: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_borderscolor") . " !important;" ?>
			<?php echo "border-bottom: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_borderscolor") . " !important;" ?>
			<?php echo "border-right: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_borderscolor") . " !important;" ?>
		}
		#footer_content .recentPosts .post_type i, #footer_content .post-listing .post_type i{
			
		}
		#footer_content .menu li:first-child{
			<?php echo "border-top: 1px solid #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_borderscolor") . " !important;" ?>
		}
		.mail_chimp_form_container .banner p, #big_footer .textwidget, #big_footer .textwidget p, #footer_content .contact-form input, #footer_content .contact-form textarea, .mail_chimp_form_container input#mce-EMAIL, #footer_content p, #footer_content #testimonials2 .testi-text p, #footer_content .special_tabs .label span.tab_title, .tweet_text{
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_paragraphscolor") . " !important;" ?>
		}
		
		#footer_content a{
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_linkscolor") . " !important;" ?>
		}
		#footer_content h4, .footer-widget h4, .footer-widget h4.page_title_testimonials, #footer_content .title h4, .mail_chimp_form_container .banner h3, .mail_chimp_form_container input.button, #footer_content .recentPosts .post_type i, #footer_content .post-listing .post_type i{
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_headingscolor") . " !important;" ?>
		}
		
		.copys_left{
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_sec_footerbg_paragraphscolor") . " !important;" ?>
		}
		
		.footer_right_content .footer_menu li a{
			<?php echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_sec_footerbg_linkscolor") . ";" ?>
		}
		
		<?php 
			if (des_get_value(DESIGNARE_SHORTNAME."_page_title_shadow") == "on"){ 
				$colorshadow = "#".des_get_value(DESIGNARE_SHORTNAME."_page_title_shadow_color");
				echo ".fullwidth-container{
					box-shadow: inset 0px 0px 6px 0px ".$colorshadow." !important;
					-moz-box-shadow: inset 0px 0px 6px 0px ".$colorshadow." !important;
					-webkit-box-shadow: inset 0px 0px 6px 0px ".$colorshadow." !important;
					-o-box-shadow: inset 0px 0px 6px 0px ".$colorshadow." !important;
					-ms-box-shadow: inset 0px 0px 6px 0px ".$colorshadow." !important;
				}";
			}
		?>
		
		h1.page_title{
		<?php
			if (des_get_value(DESIGNARE_SHORTNAME."_hide_pagetitle") == "off"){
				echo "display: none;";
		}
		?>
		}
		.header-shadow{
			<?php
			if (des_get_value(DESIGNARE_SHORTNAME."_hide_headershadow") == "off"){
				echo "display: none;";
		}
		?>
		}
		h2.secondaryTitle{
		<?php
			if (des_get_value(DESIGNARE_SHORTNAME."_hide_sec_pagetitle") == "off"){
				echo "display: none;";
		}
		?>
		}
		
		.breadcrumbs-container{
			<?php echo "margin-top: " . des_get_value(DESIGNARE_SHORTNAME."_breadcrumbs_text_margin_top") .";" ?>
		}
		
		h2.wpb_heading, .home_widget .page_info_title_s3, .home_widget .page_info_title_s4, page_info_title_testimonials, .smartboxtitle span, .vc_text_separator div, #accordion .acc-title h2, .acc-substitute .acc-title h2{
			<?php 
			$stfont = des_get_value(DESIGNARE_SHORTNAME."_st_font");
			if (empty($stfont)) $stfont = des_get_value(DESIGNARE_SHORTNAME."_st_font option:selected");
			if ($stfont == "Helvetica" || $stfont == "Helvetica Neue"){
		 		if ($msie === "true"){
			 		echo 'font-family: Arial !important;';
		 		} else {
			 		echo 'font-family: "'.$stfont.'", Arial, sans-serif !important;';
		 		}
	 		}
	 		else echo 'font-family: "'.$stfont.'";';

			echo "font-size:" .preg_replace( '/\s+/', '', des_get_value(DESIGNARE_SHORTNAME."_st_size")) ." !important;"; 
			echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_st_color") . " !important;";
			echo "font-style: " . des_get_value(DESIGNARE_SHORTNAME."_st_font_style") . " !important;"; 
			?>
		}
		.shortcode-services.default ul.service-items .item-title{
			<?php 
			$stfont = des_get_value(DESIGNARE_SHORTNAME."_st_font");
			if (empty($stfont)) $stfont = des_get_value(DESIGNARE_SHORTNAME."_st_font option:selected");
			if ($stfont == "Helvetica" || $stfont == "Helvetica Neue"){
		 		if ($msie === "true"){
			 		echo 'font-family: Arial !important;';
		 		} else {
			 		echo 'font-family: "'.$stfont.'", Arial, sans-serif !important;';
		 		}
	 		}
	 		else echo 'font-family: "'.$stfont.'";';
			echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_st_color") . " !important;";
			echo "font-style: " . des_get_value(DESIGNARE_SHORTNAME."_st_font_style") . " !important;"; 
			?>
		}
		#footer_content .home_widget .page_info_title_s3, #footer_content .home_widget .page_info_title_s4, #footer_content page_info_title_testimonials, #footer_content .smartboxtitle span{
			<?php 
			echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_headingscolor") . " !important;";
			?>
			text-transform: uppercase;
			font-family: Arial !important;
			font-size: 12px !important;
		}
		#toppanel .home_widget .page_info_title_s3, #toppanel .home_widget .page_info_title_s4, #toppanel page_info_title_testimonials, #toppanel .smartboxtitle span{
			<?php 
			echo "color: #" . des_get_value(DESIGNARE_SHORTNAME."_toppanel_headingscolor") . " !important;";
			?>
			text-transform: uppercase;
			font-family: Arial !important;
			font-size: 12px !important;
		}
		.trigger_toppanel_closer .clicker{
			border-color: transparent <?php echo $smartbox_styleColor; ?> transparent transparent; 
		}
		
		.post-thumb .mask .more:hover i, .post-thumb .mask .link:hover i, .featured-image-thumb .mask .more:hover i, .flexslider .mask .more:hover i, .image_container .mask .more:hover i, .dl-menuwrapper li a:hover{
			color: <?php echo $smartbox_styleColor; ?> !important;
		}
		
		.jcarousel-prev, .jcarousel-next, .jcarousel-prev-horizontal, .jcarousel-next-horizontal{
			background-color: white !important;
		}
		
		.jcarousel-prev:hover, .jcarousel-next:hover, .jcarousel-prev-horizontal:hover, .jcarousel-next-horizontal:hover, .flex-direction-nav a.prev:hover, .flex-direction-nav a.next:hover, .woocommerce table.cart a.remove:hover, .woocommerce #content table.cart a.remove:hover, .woocommerce-page table.cart a.remove:hover, .woocommerce-page #content table.cart a.remove:hover, .camera_prev > span:hover, .camera_next > span:hover, #wrapper .cameracontrols .camera-controls-toggler{
			<?php echo "background-color: " . $smartbox_styleColor . " !important;"; ?>
		}
		.style-top-bar #lang_sel{
			<?php echo "border-left: 1px solid #". des_get_value(DESIGNARE_SHORTNAME."_topbarborders_bg_color")." !important;" ?>
			<?php echo "border-right: 1px solid #". des_get_value(DESIGNARE_SHORTNAME."_topbarborders_bg_color")." !important;" ?>			
		}
		@media only screen and (max-width: 767px) and (min-width: 480px){
 			.style-top-bar #lang_sel{
	 		<?php echo "border: 1px solid #". des_get_value(DESIGNARE_SHORTNAME."_topbarborders_bg_color")." !important;" ?>
 		}
 			.style-top-bar .socialdiv ul li{border: none !important;}
 			.style-top-bar .socialdiv-dark ul li{border: none !important;}
 		}
		
		@media only screen and (max-width: 479px) {
 			.style-top-bar #lang_sel{
	 		<?php echo "border: 1px solid #". des_get_value(DESIGNARE_SHORTNAME."_topbarborders_bg_color")." !important;" ?>
 		}
 			.style-top-bar .socialdiv ul li{border: none !important;}
 			.style-top-bar .socialdiv-dark ul li{border: none !important;}
 			
 		}
		
		
		.camera_prev:hover > span, .camera_next:hover > span, .jcarousel-prev-horizontal:hover, .jcarousel-next-horizontal:hover, #send-comment, .wpcf7-submit, .flex-direction-nav a.prev:hover, .flex-direction-nav a.next:hover, #back-to-top a:hover, .smartbox_little_shopping_bag .title a, .shop_topbar_middle, .shop_topbar_rightcorner, .shop_bottombar_leftcorner, .shop_bottombar_middle, .trigger_toppanel_closer .clicker .signal, ul.products li.hentry:hover .added_to_cart, ul.products li.hentry .added_to_cart, .tp-bullets.simplebullets.round .bullet:hover, .tp-bullets.simplebullets.round .bullet.selected, .tp-bullets.simplebullets.navbar .bullet:hover, .tp-bullets.simplebullets.navbar .bullet.selected, .widget-area #searchform input#searchsubmit, #searchform input#searchsubmit, .pop-menu{
 			<?php echo "background-color: " . $smartbox_styleColor . " !important;"; ?>
 		}
 		
 		.tagcloud a:hover, .da-thumbs li.four a div .overlay_sep, .da-animate .overlay_sep,  .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover, ul.products li.hentry a.product_type_simple:hover, ul.products .hentry a.product_type_variable:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce-page input.button:hover{
	 		<?php echo "background-color: " . $smartbox_styleColor . " !important;"; ?>
 		}
 		
 		.cameraholder, .services-graph li span, .socialdiv a[title]:hover:after, span.shortcode-highlight, .smartbox_minicart_cart_but:hover, .smartbox_minicart_checkout_but:hover, .woocommerce div.product .woocommerce-tabs ul.tabs li.active, .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, .dl-menuwrapper li.dl-back > a, .headerstyle-style3 header #menulava > li.current-menu-item > a, .headerstyle-style3 header #menulava > li.current-menu-ancestor > a{
	 		<?php echo "background: " . $smartbox_styleColor . " !important;"; ?>
 		}
 		
 		.settings-open{
	 		<?php echo "background: " . $smartbox_styleColor . " url(".get_template_directory_uri()."/img/close.png) no-repeat center center;"; ?>
 		}
 		
 		<?php if ($headerStyleType === "style1" || $headerStyleType === "style2"){
	 		echo "header #menulava > li.current-menu-item > a, header #menulava > li.current-menu-ancestor > a{ color: " . $smartbox_styleColor . " !important;}";
 		} ?>
 		
 		.shortcode-team .team-box h5, .color_logo, #recentcomments a:hover, .recentcomments_listing a.the_title:hover, #accordion .acc-title h2.current, .acc-substitute .acc-title h2.current, .text_color, .woocommerce form .form-row .required, .woocommerce-page form .form-row .required, .cart_list_product_title a:hover, .mail_chimp_form_container input.button:hover,#footer_content .contact-form .submit:hover, #toppanel .contact-form .submit:hover, #footer_menu li a:hover, .wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a:hover, .wpb_content_element .wpb_accordion_header a:hover, h3.ui-state-active a, .wpb_tabs_nav .ui-state-active a, .wpb_toggle_title_active, #content h4.wpb_toggle_title_active, .widget_nav_menu .menu li a:hover{
	 		<?php echo "color: " . $smartbox_styleColor . " !important;"; ?>
 		}
 		.woocommerce a.button.added:before, .woocommerce button.button.added:before, .woocommerce input.button.added:before, .woocommerce #respond input#submit.added:before, .woocommerce #content input.button.added:before, .woocommerce-page a.button.added:before, .woocommerce-page button.button.added:before, .woocommerce-page input.button.added:before, .woocommerce-page #respond input#submit.added:before, .woocommerce-page #content input.button.added:before, .woocommerce span.onsale, .woocommerce-page span.onsale, .woocommerce button.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce button.button:hover, .woocommerce-page button.button:hover, .nav-next-nav1 a:hover, .nav-previous-nav1 a:hover{
	 		<?php echo "background-color: " . $smartbox_styleColor . " !important;"; ?>
 		}
 		
 		header #menulava > li > a, .sf-menu li a, .sf-menu li li a, .dl-menuwrapper li a {
	 		<?php 
	 		$font = des_get_value(DESIGNARE_SHORTNAME."_menu_font");
	 		if (empty($font)) $font = des_get_value(DESIGNARE_SHORTNAME."_menu_font option:selected");
	 		if (!strstr($font, "---")) {
			 	if ($font == "Helvetica" || $font == "Helvetica Neue"){
			 		if ($msie === "true"){
				 		echo 'font-family: Arial !important;';
			 		} else {
				 		echo 'font-family: "'.$font.'", Arial, sans-serif;';
			 		}
		 		}
		 		else echo 'font-family: "'.$font.'";';
	 		} ?>
	 		font-size: <?php echo preg_replace( '/\s+/', '', des_get_value(DESIGNARE_SHORTNAME."_menu_font_size")) ." !important"; ?>;
	 		color: #<?php echo des_get_value(DESIGNARE_SHORTNAME."_menu_color"); ?>;
 		}
 		
 		.dl-menuwrapper .gosubmenu{
	 		color: #<?php echo des_get_value(DESIGNARE_SHORTNAME."_menu_color"); ?>;
	 		border-color: #<?php echo des_get_value(DESIGNARE_SHORTNAME."_header_bordersearchcolor"); ?>;
 		}
 		
 		header #menulava > li > a{
	 		<?php if (des_get_value(DESIGNARE_SHORTNAME."_menu_uppercase") == "on") echo "text-transform: uppercase;"; ?>
 		}
 		
 		<?php if ($headerStyleType !== "style3"){
	 		?>
	 		header #menulava > li > a:hover, .sf-menu li li a:hover, .footer_right_content .footer_menu li a:hover, .sf-menu > li li.sfHover > a, .sfHover > a{
		 		<?php 
		 			if (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false) {
					    echo "color: " . $smartbox_styleColor . ";";
					} else echo "color: " . $smartbox_styleColor . " !important;"; ?>
	 		}
	 		<?php 
	 	}
 		?>
 		
 		header #menulava > li{
	 		margin-left: <?php echo preg_replace( '/\s+/', '', des_get_value(DESIGNARE_SHORTNAME."_menu_side_margin") );?>;
	 		margin-right: <?php echo preg_replace( '/\s+/', '', des_get_value(DESIGNARE_SHORTNAME."_menu_side_margin") );?>;
 		}
 		.woocommerce-message a.button:hover{background-color: transparent !important;}
 		.blogarchive .post .the_title a:hover, #footer_content .widget_links li a:hover, #footer_content .widget_categories li a:hover, #secondary .widget_links li a:hover, #secondary .widget_categories li a:hover, .recentposts_listing a.the_title:hover, #footer_content #recentPostsSidebar_widget .recentposts_listing a.the_title:hover, #footer_content #recentPostsSidebar_widget .recentposts_listing a.the_title:hover, #twitter_update_list li a:hover, .recentPosts .post .title_date .title a:hover, a.button.none:hover, .blogarchive .post a.readmore:hover, .widget_pages li a:hover, #tabs ul.tabs li a.current, .shortcode-toggle h4 a, .text_color, ul.splitter li:hover a, .filterby .projectCategories li a:hover, .filterby .projectCategories li.active a, #secondary a:hover, .amount, .woocommerce ul.cart_list li a:hover, .woocommerce ul.product_list_widget li a:hover, .woocommerce-page ul.cart_list li a:hover, .woocommerce-page ul.product_list_widget li a:hover, .product-categories li a:hover, .tp-caption.big_bluee, .special_tabs .label.current span.tab_title, .post-listing .post_type i, .comments_number, .comments_number i, .overlay_categories, .tp-button:hover.lightgrey, .widget_nav_menu .current-menu-item, #lang_sel ul li ul li:hover a, .smartbox_little_shopping_bag .title i, .widget h2, .widget h4, #secondary #recentPostsSidebar_widget h2, .custom-widget h4, .widget-flexslider h4, #recentPostsSidebar_widget h2, .entry.sidebar-right .four.columns .page_title_testimonials, .entry.sidebar-right .four.columns .smartboxtitle span, .entry.sidebar-left .four.columns .page_title_testimonials, .entry.sidebar-left .four.columns .smartboxtitle span, .entry.sidebar-left .four.columns h4.h-widget-test, .entry.sidebar-right .four.columns h4.h-widget-test, #secondary .menu-smartbox-menu-container .widget_nav_menu ul li a:hover{
	 		<?php echo "color: " . $smartbox_styleColor . " !important;"; ?>
 		}
 		.flex-control-nav li a:hover, .flex-control-nav li a.active, .special_tabs .label.current .designare_icon_special_tabs, div.wpcf7-validation-errors, .blogarchive .post .readmore, .dl-menuwrapper button{
	 		<?php echo "background: " . $smartbox_styleColor . " !important;"; ?>
 		}
 		#tabs ul.tabs li a.current{
	 		<?php echo "border-top: 1px solid " . $smartbox_styleColor . ";"; ?>
 		}
 		
 		.page_title .arrows-proj2 .next2:hover, .nav-next-nav1 a:hover, .nav-previous-nav1 a:hover, .special_tabs .label.current .designare_icon_special_tabs, .smartboxtitle .carousel-control:hover{
	 		<?php echo "border: 1px solid " . $smartbox_styleColor . ";"; ?>
 		}
 		
 		input:focus, textarea:focus{
	 		<?php echo "border-left: 1px solid #ddd !important;"; ?>
	 		<?php echo "border-bottom: 1px solid #ddd !important;"; ?>
	 		<?php echo "border-top: 1px solid #ddd !important;"; ?>
	 		<?php echo "border-right: 1px solid #ddd !important;"; ?>
	 	}
 		
 		
 		#flickr li:hover{
 			<?php echo "border: 3px solid ".$smartbox_styleColor .";"; ?>
 		}
 		
 		<?php 
	 		if ($headerStyleType === "style1" || $headerStyleType === "style2"){
		 		echo "header #menulava > li:hover > a{ color:".$smartbox_styleColor." !important;}";
	 		}
 		?>
 		
 		.project_list_s3 .p_title a:hover, .testi-info .company, .the_title a:hover, .numerical-container .value, .numerical-container .unit, .tooltiper span, .tp-caption .df-color-font, .des-sc-button.button.custom:hover, .tweet_time{
	 		<?php echo "color: " . $smartbox_styleColor . " !important;"; ?>
 		}
 		 		
 		.pricing_tab.highlight{
 			<?php echo "border: 1px solid " . $smartbox_styleColor . " !important;"; ?>
 		}
 		.pricing_tab.highlight .title{
 			<?php echo "background: " . $smartbox_styleColor . " !important;"; ?>
 		}
 		
		h1.page_title{
			<?php
				$font = des_get_value(DESIGNARE_SHORTNAME."_header_text_font");
				if (empty($font)) $font = des_get_value(DESIGNARE_SHORTNAME."_header_text_font option:selected");
				if ($font){
			 		if ($font == "Helvetica" || $font == "Helvetica Neue"){
				 		if ($msie === "true"){
					 		echo 'font-family: Arial, sans-serif;';
				 		} else {
					 		echo 'font-family: "'.$font.'", Arial, sans-serif;';
				 		}
			 		}
			 		else echo 'font-family: "'.$font.'";';
			 	}
			?>
		}
		ul.cart_list li a, .woocommerce ul.cart_list li a:hover{font-size: 12px !important;}
		h2.secondaryTitle{
			<?php
			 	$font = des_get_value(DESIGNARE_SHORTNAME."_secondary_title_font");
	 			if (empty($font)) $font = des_get_value(DESIGNARE_SHORTNAME."_secondary_title_font option:selected");
		 		if ($font == "Helvetica" || $font == "Helvetica Neue"){
			 		if ($msie === "true"){
				 		echo 'font-family: Arial !important;';
			 		} else {
				 		echo 'font-family: "'.$font.'", Arial, sans-serif;';
			 		}
		 		}
		 		else echo 'font-family: "'.$font.'";';
			?>
		}

		#wp-calendar tbody td a{ background-color: <?php echo $smartbox_styleColor; ?>;}

		.woocommerce .star-rating span, .woocommerce-page .star-rating span{
			color: <?php echo $smartbox_styleColor; ?>;
		}
		
		#footer_content .contact-form textarea, #footer_content .contact-form input{
			
		}
		#big_footer, #footer_content h4, .footer-widget h4, .footer-widget h4.page_title_testimonials, #footer_content .title h4, #footer_content .contact-form textarea, #footer_content .contact-form input{
			<?php
				$bigfootertype = des_get_value(DESIGNARE_SHORTNAME."_footerbg_type");
				if (empty($bigfootertype)) $bigfootertype = des_get_value(DESIGNARE_SHORTNAME."_footerbg_type option:selected");
				if ($bigfootertype == "color") echo "background: #" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_color") . " !important;";
				if ($bigfootertype == "pattern") echo "background: url('" . get_template_directory_uri() . "/images/smartbox_patterns/" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_pattern") . "') 0 0 repeat !important;";
				if ($bigfootertype == "custom_pattern") echo "background: url('" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_custom_pattern") . "') 0 0 repeat !important;";
				if ($bigfootertype == "image"){
					echo "background-repeat:no-repeat; background-position:center center; -o-background-size: 100% 100%, auto; -moz-background-size: 100% 100%, auto; -webkit-background-size: 100% 100%, auto; background-size: 100% 100%, auto !important;";
					echo "background: url(" . des_get_value(DESIGNARE_SHORTNAME."_footerbg_image") . ") no-repeat fixed; background-size: 100% 100% !important;";  
				}
			?>
		}
		.dl-menuwrapper li.dl-back > a, .dl-menuwrapper li.dl-back > a:hover{
			color: #fff !important;
		}
		#toppanel h2.wpb_heading, #toppanel .home_widget .page_info_title_s3, #toppanel .home_widget .page_info_title_s4, #toppanel page_info_title_testimonials, #toppanel .smartboxtitle span, #toppanel .vc_text_separator div, #big_footer h2.wpb_heading, #big_footer .home_widget .page_info_title_s3, #big_footer .home_widget .page_info_title_s4, #big_footer page_info_title_testimonials, #big_footer .smartboxtitle span, #big_footer .vc_text_separator div{
			font-family: Arial !important;
			font-size: 12px !important;
		}
		<?php
			if(get_option(DESIGNARE_SHORTNAME."_logo_type") == "image" && get_option(DESIGNARE_SHORTNAME."_logo_height") && get_option(DESIGNARE_SHORTNAME."_fixed_menu") == "on") {
				$value = intval(str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_margin_top")))*3 + intval(str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_height"))) + 2;
				if ($headerStyleType !== "style1") {
					if (des_get_value(DESIGNARE_SHORTNAME."_top_bar_menu") == "on"){
						$value = $value+63;
					}
				}
				
				if ($headerType === "without"){
					echo "#slider_container{ padding-top: ".intval($value+53)."px;}";
					echo ".flexslider_container{ padding-top: ".intval($value+53)."px;}";
					echo ".cameracontrols{top: -53px !important;}";
				} else {
					echo "#slider_container{ padding-top: ".$value."px;}";
					echo ".flexslider_container{ padding-top: ".$value."px;}";	
				}
				if ($bodyLayoutType != "boxed"){
					echo ".fullwidth-container{ margin-top: ".$value."px;}";
				} else {
					if (des_get_value(DESIGNARE_SHORTNAME."_info_above_menu") == "on"){
						if ($headerStyleType === "style4" || $headerStyleType === "style1"){
							echo ".fullwidth-container{ margin-top: ". intval($value+45) ."px;}";
						} else {
							echo ".fullwidth-container{ margin-top: ". intval($value+55) ."px;}";
						}
					} else {
						if ($headerStyleType === "style4"){
							echo ".fullwidth-container{ margin-top: ". intval($value+13) ."px;}";
						} else {
							echo ".fullwidth-container{ margin-top: ". intval($value+13) ."px;}";
						}
					}
				} 
				echo ".home-no-slider{ padding-top: ".$value."px;}";
				echo ".everything > .fullwidth-container{ margin-top: ".$value."px;}";
				if ($bodyLayoutType != "boxed")
					echo ".page-template-template-contacts-php #map.originalposition{margin-top:".($value-5)."px !important;}";
				else
					echo ".page-template-template-contacts-php #map.originalposition{margin-top:18px !important;}";
				?>
				.page-template-template-contacts-php #map{-webkit-transition: linear .3s;-moz-transition: linear .3s;-ms-transition: linear .3s;-o-transition: linear .3s;transition: linear .3s;}
				<?php
			}
			
			if ($headerStyleType === "style3"){
				echo "
					#menulava > li {margin-right:0px !important;}
					#menulava > li > a{padding:8px !important;}
					#menulava > li.current-menu-item, #menulava > li.current-menu-ancestor, #menulava > li.current-menu-ancestor > a{background:".$smartbox_styleColor." !important;}
					
					#menulava > li.current-menu-item > a, #menulava > li.current-menu-ancestor > a{color: white !important;}
				";
			}
			
			if ($headerStyleType === "style4"){
				if (des_get_value(DESIGNARE_SHORTNAME."_menu_background_color")){
					echo ".fullwidth_container_menu, .fullwidth_container_menu #menulava li { background:#".des_get_value(DESIGNARE_SHORTNAME."_menu_background_color")." !important;}";
				}

				if (des_get_value(DESIGNARE_SHORTNAME."_menu_uppercase")){
					if (des_get_value(DESIGNARE_SHORTNAME."_menu_uppercase") === "on" ){
						echo "#menulava > li > a{text-transform:uppercase;}";
					}
				}
				echo "
					.woocommerce-menu #menulava_top > li > ul{margin-top: -10px;}
					.fullwidth_container_menu #menulava{position:relative;float:left;}
					.fullwidth_container_menu .container{padding-left:20px;}
					#menulava > li {margin-right:0px !important;}
					#menulava > li.current-menu-item, #menulava > li.current-menu-ancestor, #menulava > li.current-menu-ancestor > a{color:".$smartbox_styleColor." !important;}
					
					#menulava > li:hover{border-top:1px solid ".$smartbox_styleColor." !important;}
					#menulava > li a:hover{color:".$smartbox_styleColor." !important;}
				";
			}
		
			if (get_option(DESIGNARE_SHORTNAME."_logo_reduced_height")){
				echo ".n-li{max-height: ". str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_reduced_height")) . " !important;}";
				$halfheight = intval(str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_reduced_height")))/2 - 10;
				echo ".n-slogan{ margin-top: ".$halfheight."px !important; }";
				echo ".n-hm .style4{margin-top: ".$halfheight."px !important; }";
				$value = intval(str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_margin_top")))*2 + intval(str_replace(" ", "", get_option(DESIGNARE_SHORTNAME."_logo_reduced_height")));
				if ($headerStyleType === "style3"){
					echo ".n-menu #menulava{margin-top:".$halfheight."px !important;}";
				}
			}
			
			if (des_get_value(DESIGNARE_SHORTNAME."_big_menu_margin_top")){
				echo "header #menu{margin-top:".str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME."_big_menu_margin_top")).";}";
			}
			if (des_get_value(DESIGNARE_SHORTNAME."_big_menu_padding_bottom")){
				echo "header #menu #menulava > li > a{padding-bottom:".str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME."_big_menu_padding_bottom")).";}";
			}
			if (des_get_value(DESIGNARE_SHORTNAME."_small_menu_margin_top")){
				echo "header #menu.n-menu{margin-top:".str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME."_small_menu_margin_top")).";}";
			}
			if (des_get_value(DESIGNARE_SHORTNAME."_small_menu_padding_bottom")){
				echo "header #menu.n-menu #menulava > li > a{padding-bottom:".str_replace(" ", "", des_get_value(DESIGNARE_SHORTNAME."_small_menu_padding_bottom")).";}";
			}
					
			if (get_option(DESIGNARE_SHORTNAME."_disable_responsive") === "on"){
				echo "
				@media only screen and (min-width: 768px) and (max-width: 959px) {
					.everything{width: auto !important;margin: 0; padding: 0;max-width: 100%;min-width: 980px;}
					img { max-width: 100%;}
				}
				@media only screen and (min-width: 480px) and (max-width: 767px) {
					.everything{width: auto !important;margin: 0; padding: 0;max-width: 100%;min-width: 980px;}
					img { max-width: 100%;}
				}
				@media only screen and (max-width: 479px) {
					.everything{width: auto !important;margin: 0; padding: 0;max-width: 100%;min-width: 980px;}
					img { max-width: 100%;}
				}
				@media only screen and (max-width: 960px) {
					.everything{width: auto !important;margin: 0; padding: 0;max-width: 100%;min-width: 980px;}
					img { max-width: 100%;}
				}
				@media only screen and (min-width: 960px) and (max-width: 985px) {
					.everything{width: auto !important;margin: 0; padding: 0;max-width: 100%;min-width: 980px;}
					img { max-width: 100%;}
				}
				@media only screen and (min-width: 768px) and (max-width: 793px) {
					.everything{width: auto !important;margin: 0; padding: 0;max-width: 100%;min-width: 980px;}
					img { max-width: 100%;}
				}
				";
			}
			
			if ($headerType === "without") {
				echo ".fullwidth-container{display:none !important;opacity:0;visibility:hidden;} #wrapper{margin-top:20px;}";
			}
			
			if (get_option("enable_custom_css") == "on"){
				$smartbox_customcss = get_option(DESIGNARE_SHORTNAME."_custom_css");
				if (gettype($smartbox_customcss) === "string" && $smartbox_customcss != "") {
					echo strip_tags($smartbox_customcss);
				}
			}
		?>
		
 		.style-top-bar a, .top-bar-menu > li > a{color:#<?php echo des_get_value(DESIGNARE_SHORTNAME."_topbar_links_color"); ?> !important;}
 		.style-top-bar a:hover, .top-bar-menu a:hover{color:#<?php echo des_get_value(DESIGNARE_SHORTNAME."_topbar_links_hover_color"); ?> !important;}
 		
 		#lang_sel ul li ul li a{color: #<?php echo des_get_value(DESIGNARE_SHORTNAME."_menu_color"); ?> !important; } 
 		.smartbox_minicart{
	 		<?php echo "border-top: 1px solid " . $smartbox_styleColor . " !important;"; ?>
 		}
 		a.smartbox_minicart_cart_but, a.smartbox_minicart_checkout_but{padding: 6px 0 !important;font-size: .8em !important;letter-spacing: .5px;}
		.style-top-bar .info_above_menu a.smartbox_minicart_cart_but, .style-top-bar .info_above_menu a.smartbox_minicart_cart_but:hover, .style-top-bar .info_above_menu a.smartbox_minicart_checkout_but:hover, a.smartbox_minicart_cart_but, a.smartbox_minicart_checkout_but{color: #fff !important;letter-spacing: .2px !important;}
		.mail_chimp_form_container input.button{
			background-color: <?php echo $smartbox_styleColor; ?> !important;
			padding: 14px 0px;font-size: 13px;width: 30%;-webkit-box-shadow: none;box-shadow: none;-webkit-border-radius: 0;-moz-border-radius: 0;border-radius: 0;-o-border-radius: 0;-ms-border-radius: 0;position: relative;top: 2px;font-weight: 600;margin-left: 10px;
		}
		.mail_chimp_form_container input.button:hover{
			color: <?php echo $smartbox_styleColor; ?> !important;
		}
		.mail_chimp_form_container input.button:hover{background: white !important;}
	</style>
	<?php
}

function designare_responsive_options(){
	if (get_option(DESIGNARE_SHORTNAME."_fixed_menu") == "on"){
		?>
			<script type="text/javascript">
				function updateFullwidths(){
					$('body > .fullwidth-section').each(function(){
						var thisClass = $(this).attr('class');
							thisClass = thisClass.split('fullwidth-section ');	
							thisClass = thisClass[1];
						$('body > .'+thisClass).css({'top': Math.round($('.'+thisClass).eq(1).offset().top), 'position':'absolute', 'margin-bottom':'50px'});
				    });
				}
				jQuery(document).ready(function(){
					var newHeight = Math.floor(jQuery('.header_container').height())-1;
					var menuHeight = jQuery('#menulava').height()-3;
					if ($('#headerStyleType').html() === "style4"){
						menuHeight += 3;
					}
					var output = ".sf-menu li:hover ul, .sf-menu li.sfHover ul {top: "+menuHeight+"px !important;}";
					window.fullwidths_updated = false;
					window.smallmenuadded = false;
					if (jQuery('#menu.n-menu').length){
						var menuSmallHeight = jQuery('#menu.n-menu #menulava').height();
						output += "#menu.n-menu .sf-menu > li:hover ul, #menu.n-menu .sf-menu > li.sfHover ul {top: "+menuSmallHeight+"px !important;} #menu.n-menu .sf-menu > li:hover > ul ul, #menu.n-menu .sf-menu > li.sfHover ul ul {top: 0px !important;}";
						window.smallmenuadded = true;
					}
					if (window.BrowserDetect.browser === "Explorer" && window.BrowserDetect.version === 8){
						/**/
					} else {
						var styleNode = document.createElement('style');
						styleNode.setAttribute("type", "text/css");
						var textNode = document.createTextNode(output);
						styleNode.appendChild(textNode);
						document.getElementsByTagName('head')[0].appendChild(styleNode);						
					}
					
					var styleNode = document.createElement('style');
					styleNode.setAttribute("type", "text/css");
					var textNode = document.createTextNode(output);
					styleNode.appendChild(textNode);
					document.getElementsByTagName('head')[0].appendChild(styleNode);

					window.smallfullwidthcontainer = jQuery('.fullwidth_container').height();
					jQuery('.fullwidth_container').css('max-height', window.smallfullwidthcontainer +"px");
					
					jQuery(window).scroll(function(){
						if (jQuery(this).scrollTop() > 10){
						    //make CSS changes here
						    if (!jQuery('.header_container.n-hc').length) {
						    	$('.fullwidth_container.style-top-bar').css('overflow','hidden');
						    	if (jQuery('.fullwidth-container').css('display') == "none"){
							    	if (!$('body').hasClass('boxedpage'))
								    	jQuery('.page-template-template-contacts-php #map').removeClass('originalposition').css('margin-top','20px');
								    else 
								    	jQuery('.page-template-template-contacts-php #map').removeClass('originalposition').css('top','-50px');
						    	}

							    jQuery('.slogan').addClass("n-slogan");
							    jQuery('.header_container').addClass("n-hc");
							    jQuery('.logo_and_menu').addClass("n-hm");
							    jQuery('.logo a').addClass("n-la");
							    jQuery('#toppanel').addClass("test-top-closed-panel");
							    jQuery('.logo img').addClass("n-li");
								jQuery('#menulava > li > a').addClass("n-ma");							
							    jQuery('#menu').addClass("n-menu");
							    if ($('.fullscreen-container').length && $('.fullscreen-container').parent('#slider_container').length){
									/**/
								} else jQuery('#slider_container').addClass("n-slider-container");
							    jQuery('.home-no-slider').addClass("n-home-no-slider");
							    jQuery('.flexslider_container').addClass("n-slider-flex");
							    jQuery('.fullwidth-container').addClass("n-fullwidthcontainer");
							    
							    setTimeout(function(){
								    if (!window.smallmenuadded){
								    	var menuSmallHeight = jQuery('#menu.n-menu #menulava').height()+8;
										var output = "#menu.n-menu .sf-menu > li:hover ul, #menu.n-menu .sf-menu > li.sfHover ul {top: "+menuSmallHeight+"px !important;} #menu.n-menu .sf-menu > li:hover > ul ul, #menu.n-menu .sf-menu > li.sfHover ul ul {top: 0px !important;}";
										window.smallmenuadded = true;
									    var styleNode = document.createElement('style');
										styleNode.setAttribute("type", "text/css");
										var textNode = document.createTextNode(output);
										styleNode.appendChild(textNode);
										document.getElementsByTagName('head')[0].appendChild(styleNode);
								    }
							    }, 500);
							    
	    						if (jQuery('#headerStyleType').html() !== "style1"){
							    	jQuery('.fullwidth_container').not('.fullwidth_container_menu').animate({"max-height":"0px"}, 500);
							    }

						    } 
						} else {
						    //back to default styles
						    if (jQuery('.header_container').hasClass('n-hc')){

							    if (jQuery('.fullwidth-container').css('display') == "none")
							    	if (!$('body').hasClass('boxedpage'))
								    	jQuery('.page-template-template-contacts-php #map').addClass('originalposition');
								    else 
								    	jQuery('.page-template-template-contacts-php #map').removeClass('originalposition').css('top','18px');
							    	
							    jQuery('.header_container').removeClass("n-hc");
								jQuery('#menulava > li > a').removeClass("n-ma");							
							    jQuery('.logo_and_menu').removeClass("n-hm");
							    jQuery('.logo a').removeClass("n-la");
							    jQuery('.logo img').removeClass("n-li");						    
							    jQuery('#toppanel').removeClass("test-top-closed-panel");
							    jQuery('#menu').removeClass("n-menu");
							    if ($('.fullscreen-container').length && $('.fullscreen-container').parent('#slider_container').length){
									/**/
								} else jQuery('#slider_container').removeClass("n-slider-container");
							    jQuery('.home-no-slider').removeClass("n-home-no-slider");
							    jQuery('.flexslider_container').removeClass("n-slider-flex");
							    jQuery('.slogan').removeClass("n-slogan");
							    jQuery('.fullwidth-container').removeClass("n-fullwidthcontainer");

							    if (jQuery('#headerStyleType').html() !== "style1"){
							    	jQuery('.fullwidth_container').animate({'max-height': window.smallfullwidthcontainer +"px"}, 500, function() { $('.fullwidth_container.style-top-bar').css('overflow','visible'); });
							    }
						    }
						}
					});
				});
				
				jQuery(document).ready(function(){
					if (jQuery('#mc-embedded-subscribe').length){
						jQuery('#mce-EMAIL').after(jQuery('#mc-embedded-subscribe'));
						jQuery('#mce-EMAIL').val('<?php echo get_option(DESIGNARE_SHORTNAME."_newsletter_input_text"); ?>');
						jQuery('#mce-EMAIL').focus(function(){
							if (jQuery(this).val() == '<?php echo get_option(DESIGNARE_SHORTNAME."_newsletter_input_text"); ?>')
								jQuery(this).val('');
						});
						jQuery('#mce-EMAIL').blur(function(){
							if (jQuery(this).val() == ''){
								jQuery(this).val('<?php echo get_option(DESIGNARE_SHORTNAME."_newsletter_input_text"); ?>');
							}
						});
						jQuery('#mc-embedded-subscribe').parents('.form').find('label').remove();
					}					
					
					if (jQuery('.tweet_scroll_text:not(.not_filled)').length){
						<?php wp_enqueue_script( 'destweet', DESIGNARE_JS_PATH .'twitter/jquery.tweet.js', array(), '1',$in_footer = true);	?>
						jQuery('.tweet_scroll_text').destweet({
							modpath: jQuery('#templatepath').html()+'js/twitter/index.php',
					        username: "<?php echo get_option(DESIGNARE_SHORTNAME . "_twitter_username"); ?>",
					        page: 1,
					        avatar_size: 0,
				            count: <?php echo get_option(DESIGNARE_SHORTNAME . "_twitter_number_tweets"); ?>
					    });
				    
					    var ul = jQuery(".tweet_scroll_text .tweet_list");
				        var ticker = function() {
				        	setTimeout(function() {
				            	ul.find('li:first').animate( {marginTop: '-5.5em'}, 500, function() {
				                	jQuery(this).detach().appendTo(ul).removeAttr('style');
				                });
				                ticker();
				            }, 5000);
				        };
				        ticker();
				    }
				});
			</script>
			<style>
				#menulava.sf-menu > li > ul > li > ul{
					margin-top: 0px !important;top: 0px !important;
				}
			</style>
		<?php
	} else {
		?>
		<style>
			.header_container{position: relative;}
			<?php 
				global $post;
				if (get_post_meta($post->ID, 'des_custom_header_style_value', true) == "on"){
					$headerStyleType = get_post_meta($post->ID, 'headerStyleType_value', true);
				} else {
					$headerStyleType = get_option(DESIGNARE_SHORTNAME."_header_style_type");
				}
				if ($headerStyleType !== "style3" && $headerStyleType !== "style4"){ 
				?>
					#menulava.sf-menu li:hover ul,
					#menulava.sf-menu li.sfHover ul {
						left:			0;
						top:			72px; /* match top ul list item height */
						z-index:		99;
						margin-top: 9px;
						background-color: white;
					}
					#menulava.sf-menu > li > ul > li ul{
						left:			5px;
						top:			0px !important; /* match top ul list item height */
						z-index:		99;
						margin-top: 0px !important;
					}
				<?php } 
				
				if ($headerStyleType === "style2"){ 
					?>
					#menulava.sf-menu > li > ul > li > ul{
						left:			0px;
						top:			0px !important; /* match top ul list item height */
						z-index:		99;
						margin-top: 0px !important;
					}
				<?php }
				
				if ($headerStyleType === "style3"){ 
					?>
					#menulava.sf-menu > li:hover > ul,
					#menulava.sf-menu > li.sfHover > ul {
						left:			0px;
						top:			29px !important; /* match top ul list item height */
						z-index:		99;
						margin-top: 9px !important;
					}
					#menulava.sf-menu > li > ul > li > ul{
						left:			0px;
						top:			5px !important; /* match top ul list item height */
						z-index:		99;
						margin-top: 0px !important;
					}
					.headerstyle-style3 #menulava .sub-menu .sub-menu{ top: -3px !important;}
				<?php } 
				
				if ($headerStyleType === "style4"){ 
					?> #nothere{}
					#menulava.sf-menu > li:hover > ul,
					#menulava.sf-menu > li.sfHover > ul {
						left:			0px;
						top:			36px !important; /* match top ul list item height */
						z-index:		99;
						margin-top: 9px !important;
					}
					#menulava.sf-menu > li > ul > li > ul{
						left:			0px;
						top:			0px !important; /* match top ul list item height */
						z-index:		99;
						margin-top: 0px !important;
					}
				<?php } 
				?>
		</style>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				if (jQuery('#mc-embedded-subscribe').length){
					jQuery('#mce-EMAIL').after(jQuery('#mc-embedded-subscribe'));
					jQuery('#mce-EMAIL').val('<?php echo get_option(DESIGNARE_SHORTNAME."_newsletter_input_text"); ?>');
					jQuery('#mce-EMAIL').focus(function(){
						if (jQuery(this).val() == '<?php echo get_option(DESIGNARE_SHORTNAME."_newsletter_input_text"); ?>')
							jQuery(this).val('');
					});
					jQuery('#mce-EMAIL').blur(function(){
						if (jQuery(this).val() == ''){
							jQuery(this).val('<?php echo get_option(DESIGNARE_SHORTNAME."_newsletter_input_text"); ?>');
						}
					});
					jQuery('#mc-embedded-subscribe').parents('.form').find('label').remove();
				}
				if (jQuery('.tweet_scroll_text').length){
					<?php wp_enqueue_script( 'destweet', DESIGNARE_JS_PATH .'twitter/jquery.tweet.js', array(), '1',$in_footer = true);	?>
					jQuery('.tweet_scroll_text').destweet({
						modpath: jQuery('#templatepath').html()+'js/twitter/index.php',
				        username: "<?php echo get_option(DESIGNARE_SHORTNAME . "_twitter_username"); ?>",
				        page: 1,
				        avatar_size: 0,
			            count: <?php echo get_option(DESIGNARE_SHORTNAME . "_twitter_number_tweets"); ?>
				    });
			    
				    var ul = jQuery(".tweet_scroll_text .tweet_list");
			        var ticker = function() {
			        	setTimeout(function() {
			            	ul.find('li:first').animate( {marginTop: '-5.5em'}, 500, function() {
			                	jQuery(this).detach().appendTo(ul).removeAttr('style');
			                });
			                ticker();
			            }, 5000);
			        };
			        ticker();
			    }
			});
		</script>
		<?php 
	}
}

function designare_smartbox_custom_head(){
	if(preg_match('/(?i)msie [2-9]/',$_SERVER['HTTP_USER_AGENT']))
		wp_enqueue_script( 'html5trunk', 'http://html5shiv.googlecode.com/svn/trunk/html5.js', array('jquery'), '1');
			
	if (get_option(DESIGNARE_SHORTNAME."_disable_responsive") === "on"){
		?>
		<style type="text/css">
			#big_footer, .mail_chimp_form_container, .fullwidth-section, #slider_container{
				min-width: 1024px;
			}
		</style>
		<?php
	}

}

function get_twitter_consumer_key(){
	return get_option('twitter_consumer_key');
}

function designare_smartbox_style() {
	wp_enqueue_style( 'designare-smartbox-style', get_bloginfo( 'stylesheet_url' ), array(), '1' );
	wp_enqueue_style( 'des-googlefont-opensans', 'http'. ( is_ssl() ? 's' : '' ) .'://fonts.googleapis.com/css?family=Open+Sans:300,400,700', array(), '1', 'screen' );
}

function designare_scripts(){

	if (!is_admin()){
	    wp_enqueue_script( 'jquery' );
	    wp_enqueue_script( 'easing' , DESIGNARE_JS_PATH.'jquery.easing.1.3.min.js', array(), '1', $in_footer = false);
	    wp_enqueue_script( 'tools', DESIGNARE_JS_PATH .'jQuerytools.js', array(), '1',$in_footer = true); 
   	    wp_enqueue_script( 'des_utils', DESIGNARE_JS_PATH .'utils.js', array(),'1.0',$in_footer = true);
	    wp_enqueue_script( 'des_waypoints', DESIGNARE_JS_PATH .'waypoints.min.js', array(),'1.0',$in_footer = true);
	    wp_enqueue_script( 'animated-contents', DESIGNARE_JS_PATH .'animated-contents.js', array(),'1.0',$in_footer = true);
  	    wp_enqueue_script( 'jquery.fitvids', DESIGNARE_JS_PATH .'jquery.fitvids.js', array(), '1.0',$in_footer = true);
   	    wp_enqueue_script( 'flex', DESIGNARE_JS_PATH .'jquery.flexslider-min.js', array(), '1',$in_footer = true);
  	    wp_enqueue_script( 'smartbox', DESIGNARE_JS_PATH .'smartbox.js', array(), '1',$in_footer = true);
  	    
  	   
   	    global $post;
   	    if (is_archive() || is_search() || is_home() || is_front_page()){
	   	    wp_enqueue_script('blog', get_template_directory_uri().'/js/blog.js', array(), '1');
	   	    wp_enqueue_style('load-posts', DESIGNARE_CSS_PATH.'load-posts.css');
   	    } else {
	   	    if (!is_404()){
				$template = get_post_meta( $post->ID, '_wp_page_template' ,true );
		   	    if (isset($template)){
				    switch($template){
					    case 'blog-template.php': case 'blog-template-fullwidth.php': case 'blog-template-leftsidebar.php': case 'index.php': case 'post-archive.php': case 'post-single.php': case 'search.php':
					    	wp_enqueue_script( 'flex', DESIGNARE_JS_PATH .'jquery.flexslider-min.js', array(), '1',$in_footer = true);
							wp_enqueue_script('blog', get_template_directory_uri().'/js/blog.js', array(), '1',$in_footer = true);
					   	    if (get_option('smartbox_blog_reading_type') === "scroll" || get_option('smartbox_blog_reading_type') == "scrollauto"){
						   	 	wp_enqueue_style('load-posts', DESIGNARE_CSS_PATH.'load-posts.css');   
					   	    }
						    break;
						default:
							if (is_single())
								wp_enqueue_script( 'flex', DESIGNARE_JS_PATH .'jquery.flexslider-min.js', array(), '1',$in_footer = true);
								wp_enqueue_script('blog', get_template_directory_uri().'/js/blog.js', array(), '1',$in_footer = true);
							break;
				    }
		   	    }
		   	    
	   	    }
   	    }
	    if (strpos($_SERVER["HTTP_USER_AGENT"], 'MSIE')){
		    wp_enqueue_script('IE', DESIGNARE_JS_PATH.'IE.js', array(), '1',$in_footer = true);
	    }
	}
}

function designare_the_breadcrumb(){
    $delimiter = '<span class="delimiter"> &raquo; </span>'; 
    $delimiter1 = '<span class="delimiter1"> &bull; </span>';
    $main = __('Home', 'smartbox');
    $maxLength= 30;
    $arc_year = get_the_time('Y');
    $arc_month = get_the_time('F');
    $arc_day = get_the_time('d');
    $arc_day_full = get_the_time('l');
    $url_year = get_year_link($arc_year);
    $url_month = get_month_link($arc_year,$arc_month);
 
    if (!is_front_page()) {         
        global $post, $cat;         
        $homeLink = home_url();
        echo '<a href="' . $homeLink . '">' . $main . '</a>' . $delimiter;    
        if (is_single()) { 
    		$terms2 = get_the_terms($post->ID, 'portfolio_type');
			$first = true;
			if ( $terms2 && ! is_wp_error( $terms2 ) ) { 
				$cat_type = "";
				foreach ( $terms2 as $t2 ) {
					if ($first){
						$cat_type .= "<a href='".home_url() . "/portfolio_type/" . $t2->slug."'>".$t2->name . "</a>";
						$first = false;	
					} else {
						$cat_type .= ", <a href='".home_url() . "/portfolio_type/" . $t2->slug."'>".$t2->name . "</a>";
					}
				} 
			}
			if(!empty($cat_type)) echo $cat_type . " &raquo; ";
            if (is_single()) {
                the_title();
            }
        } 
        elseif (is_category()) { 
            echo get_category_parents($cat, true,' ' . $delimiter . ' ') . '"' ;
        }       
        elseif ( is_tag() ) { 
            echo single_tag_title("", false) ;
        }        
        elseif ( is_day()) { 
            echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . ' ';
            echo '<a href="' . $url_month . '">' . $arc_month . '</a> ' . $delimiter . $arc_day . ' (' . $arc_day_full . ')';
        } 
        elseif ( is_month() ) {  
            echo '<a href="' . $url_year . '">' . $arc_year . '</a> ' . $delimiter . $arc_month;
        } 
        elseif ( is_year() ) {  
            echo $arc_year;
        }       
        elseif ( is_search() ) {  
            echo __('Search Results for "', 'smartbox') . get_search_query() . '"';
        }       
        elseif ( is_page() && !$post->post_parent ) { 
            echo get_the_title(); 
        }           
        elseif ( is_page() && $post->post_parent ) { 
            $post_array = get_post_ancestors($post);
             
            krsort($post_array); 
            foreach($post_array as $key=>$postid){
                $post_ids = get_post($postid);
                $title = $post_ids->post_title; 
                echo '<a href="' . get_permalink($post_ids) . '">' . $title . '</a>' . $delimiter;
            }
            the_title(); 
        }           
        elseif ( is_author() ) {
            global $author;
            $user_info = get_userdata($author);
            echo  __('Author&#39;s Article(s) &raquo; ', 'smartbox') . $user_info->display_name ;
        }       
        elseif ( is_404() ) {
            //echo  'Error 404 - Not Found.';
        }       
        else {
           	global $wpdb;
           	$bc = get_body_class();
           	if (isset($bc[3])){
	           	$aidee = substr($bc[3], 5);
	            $q = "SELECT name FROM ".$wpdb->prefix."terms WHERE term_id=".$aidee;
	            $res = $wpdb->get_results($q, OBJECT);
	            if (isset($res[0]))
	            echo $res[0]->name;
           	} else {
	           	if (isset($bc[0])) echo $bc[0];
           	}
        }
    } else {
	    $homeLink = home_url();
        echo '<a href="' . $homeLink . '">' . $main . '</a>';
    }
}


function designare_hexDarker($hex,$factor = 30){
    $new_hex = '';
    $base['R'] = hexdec($hex{0}.$hex{1});
    $base['G'] = hexdec($hex{2}.$hex{3});
    $base['B'] = hexdec($hex{4}.$hex{5});
    foreach ($base as $k => $v){
        $amount = $v / 100;
        $amount = round($amount * $factor);
        $new_decimal = $v - $amount;
        $new_hex_component = dechex($new_decimal);
        if(strlen($new_hex_component) < 2){ $new_hex_component = "0".$new_hex_component; }
        $new_hex .= $new_hex_component;
    }        
    return $new_hex;        
}

function designare_hexLighter($hex,$factor = 30){ 
	$new_hex = ''; 
	$base['R'] = hexdec($hex{0}.$hex{1}); 
	$base['G'] = hexdec($hex{2}.$hex{3}); 
	$base['B'] = hexdec($hex{4}.$hex{5}); 
	foreach ($base as $k => $v){ 
	    $amount = 255 - $v; 
	    $amount = $amount / 100; 
	    $amount = round($amount * $factor); 
	    $new_decimal = $v + $amount; 
	    $new_hex_component = dechex($new_decimal); 
	    if(strlen($new_hex_component) < 2){ $new_hex_component = "0".$new_hex_component; } 
	    $new_hex .= $new_hex_component; 
	}    
	return $new_hex;     
} 

function designare_load_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	$fonts = explode('|*|',get_option('des_google_fonts_names'));
	$fontlist = "";
	$first = true;
	if (count($fonts) > 1){
		for ($i = 0; $i < count($fonts)-1; $i++){
	    	$fontname = explode("family=", $fonts[$i]);
	    	if (isset($fontname[1])){
	    		$fontNameClean = explode("&ver=", $fontname[1]);
	    		if (isset($fontNameClean[0])){
		    		if ($first){
				    	$fontlist = $fontNameClean[0];
				    	$first = false;
			    	} else {
				    	$fontlist .= "|".$fontNameClean[0];
			    	}
	    		} else {
		    		$fontlist .= $fontname[1];
	    		}
	    	}
		}
	    wp_register_style('googleFonts', $protocol.'://fonts.googleapis.com/css?family='.$fontlist);
	    wp_enqueue_style( 'googleFonts');	
	 }
}

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register two plugins - one included with the TGMPA library
 * and one from the .org repo.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function my_theme_register_required_plugins() {

	/**
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin pre-packaged with a theme
		array(
			'name'     				=> 'Revolution Slider', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/lib/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'WPBakery Visual Composer', // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/lib/plugins/js_composer.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
			'name'     				=> 'CSS3 Responsive Web Pricing Tables Grids', // The plugin name
			'slug'     				=> 'css3_web_pricing_tables_grids', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/lib/plugins/css3_web_pricing_tables_grids.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		
		array(
        	'name'      		=> 'Contact Form 7',
        	'slug'      		=> 'contact-form-7',
        	'required'  		=> false,
        	'force_activation'	=> false,
        ),
        array(
        	'name'      		=> 'Really Simple CAPTCHA',
        	'slug'      		=> 'really-simple-captcha',
        	'required'  		=> false,
        	'force_activation'	=> false,
        )

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'smartbox';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> get_template_directory_uri() . '/lib/plugins/',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
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
add_filter( 'woocommerce_enqueue_styles', '__return_false' );
?>