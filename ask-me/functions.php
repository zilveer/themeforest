<?php
if (is_admin() and isset($_GET['activated']) and $pagenow == "themes.php")
wp_redirect('admin.php?page=options');
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');

/* Load lang languages */
load_theme_textdomain('vbegy',dirname(__FILE__).'/languages');
/* add title-tag */
add_theme_support('title-tag');

/* Theme name */
$themename = wp_get_theme();
$themename = preg_replace("/\W/", "_", strtolower($themename) );
define("vpanel_name","ask_me");
define("vpanel_options","vpanel_ask_me");
define("theme_name","Ask Me");

/* require files */
require_once get_template_directory() . '/admin/options-framework.php';
require_once get_template_directory() . '/admin/meta-box/meta-box.php';
require_once get_template_directory() . '/admin/meta-box/meta_box.php';
require_once get_template_directory() . '/admin/functions/aq_resizer.php';
require_once get_template_directory() . '/admin/functions/main_functions.php';
require_once get_template_directory() . '/admin/functions/widget_functions.php';
require_once get_template_directory() . '/admin/functions/nav_menu.php';
require_once get_template_directory() . '/admin/functions/register_post.php';
require_once get_template_directory() . '/admin/functions/page_builder.php';
require_once get_template_directory() . '/functions/shortcode_ask.php';
require_once get_template_directory() . '/functions/functions_ask.php';
if (!class_exists('TwitterOAuth',false)) {
	require_once (get_template_directory() . '/includes/twitteroauth/twitteroauth.php');
}

/* Woocommerce */
include get_template_directory() . '/admin/woocommerce/woocommerce.php';

/* Widgets */
include get_template_directory() . '/admin/widgets/stats.php';
include get_template_directory() . '/admin/widgets/signup.php';
include get_template_directory() . '/admin/widgets/questions_categories.php';
include get_template_directory() . '/admin/widgets/counter.php';
include get_template_directory() . '/admin/widgets/contact.php';
include get_template_directory() . '/admin/widgets/login.php';
include get_template_directory() . '/admin/widgets/profile_links.php';
include get_template_directory() . '/admin/widgets/highest_points.php';
include get_template_directory() . '/admin/widgets/questions.php';
include get_template_directory() . '/admin/widgets/twitter.php';
include get_template_directory() . '/admin/widgets/flickr.php';
include get_template_directory() . '/admin/widgets/video.php';
include get_template_directory() . '/admin/widgets/subscribe.php';
include get_template_directory() . '/admin/widgets/comments.php';
include get_template_directory() . '/admin/widgets/tabs.php';
include get_template_directory() . '/admin/widgets/adv-120x600.php';
include get_template_directory() . '/admin/widgets/adv-234x60.php';
include get_template_directory() . '/admin/widgets/adv-250x250.php';
include get_template_directory() . '/admin/widgets/adv-120x240.php';
include get_template_directory() . '/admin/widgets/adv-125x125.php';

/* vbegy_scripts_styles */
function vbegy_scripts_styles() {
	global $post;
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style('open-sans', $protocol.'://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700');
	wp_enqueue_style('droidarabickufi', $protocol.'://fonts.googleapis.com/earlyaccess/droidarabickufi.css');
	wp_enqueue_style('v_base', get_template_directory_uri( __FILE__ ).'/css/base.css');
	wp_enqueue_style('v_lists', get_template_directory_uri( __FILE__ ).'/css/lists.css');
	wp_enqueue_style('v_bootstrap', get_template_directory_uri( __FILE__ ).'/css/bootstrap.min.css');
	wp_enqueue_style('v_prettyPhoto', get_template_directory_uri( __FILE__ ).'/css/prettyPhoto.css');
	wp_enqueue_style('v_font_awesome_old', get_template_directory_uri( __FILE__ ).'/css/font-awesome-old/css/font-awesome.min.css');
	wp_enqueue_style('v_font_awesome', get_template_directory_uri( __FILE__ ).'/css/font-awesome/css/font-awesome.min.css');
	wp_enqueue_style('v_fontello', get_template_directory_uri( __FILE__ ).'/css/fontello/css/fontello.css');
	wp_enqueue_style('v_enotype', get_template_directory_uri( __FILE__ ).'/woocommerce/enotype/enotype.css');
	wp_enqueue_style('v_css', get_template_directory_uri().'/style.css','',null,'all');
	if (is_rtl()) {
		wp_enqueue_style('v_bootstrap_ar', get_template_directory_uri( __FILE__ ) . '/css/bootstrap.min-ar.css');
	}
	wp_enqueue_style('v_responsive', get_template_directory_uri( __FILE__ )."/css/responsive.css");
	if (is_category()) {
		$category_id = get_query_var('cat');
		$categories = get_option("categories_$category_id");
	}
	$site_skin_all = vpanel_options("site_skin_l");
	if (is_author()) {
		$author_skin_l = vpanel_options("author_skin_l");
		if ($author_skin_l == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}else if (is_category()) {
		$cat_skin_l = (isset($categories["cat_skin_l"])?$categories["cat_skin_l"]:"default");
		if ($cat_skin_l == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}else if (is_tax("product_cat")) {
		$tax_id = get_term_by('slug',get_query_var('term'),"product_cat");
		$tax_id = $tax_id->term_id;
		$categories = get_option("categories_$tax_id");
		$cat_skin_l = (isset($categories["cat_skin_l"])?$categories["cat_skin_l"]:"default");
		if ($cat_skin_l == "" || $cat_skin_l == "default") {
			$cat_skin_l = vpanel_options("products_skin_l");
		}
		if ($cat_skin_l == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}else if (is_tax("product_tag") || is_post_type_archive("product")) {
		$products_skin_l = vpanel_options("products_skin_l");
		if ($products_skin_l == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}else if (is_tax("question-category")) {
		$tax_id = get_term_by('slug',get_query_var('term'),"question-category");
		$tax_id = $tax_id->term_id;
		$categories = get_option("categories_$tax_id");
		$cat_skin_l = (isset($categories["cat_skin_l"])?$categories["cat_skin_l"]:"default");
		if ($cat_skin_l == "" || $cat_skin_l == "default") {
			$cat_skin_l = vpanel_options("questions_skin_l");
		}
		if ($cat_skin_l == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}else if (is_tax("question_tags") || is_post_type_archive("question")) {
		$questions_skin_l = vpanel_options("questions_skin_l");
		if ($questions_skin_l == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}else if (is_single() || is_page()) {
		$vbegy_site_skin_l = rwmb_meta('vbegy_site_skin_l','radio',$post->ID);
		if (is_singular("product") && ($vbegy_site_skin_l == "" || $vbegy_site_skin_l == "default")) {
			$vbegy_site_skin_l = vpanel_options("products_skin_l");
		}
		if (is_singular("question") && ($vbegy_site_skin_l == "" || $vbegy_site_skin_l == "default")) {
			$vbegy_site_skin_l = vpanel_options("questions_skin_l");
		}
		if ($vbegy_site_skin_l == "" || $vbegy_site_skin_l == "default") {
			$vbegy_site_skin_l = $site_skin_all;
		}
		if ($vbegy_site_skin_l == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}else {
		if ($site_skin_all == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}
	
	if ((is_author() && ($author_skin_l == "" || $author_skin_l == "default")) || ((is_single() || is_page()) && ($vbegy_site_skin_l == "" || $vbegy_site_skin_l == "default")) || (is_category() && ($cat_skin_l == "" || $cat_skin_l == "default")) || (is_tax("product_cat") && ($cat_skin_l == "" || $cat_skin_l == "default")) || (is_tax("product_tag") && ($products_skin_l == "" || $products_skin_l == "default")) || ((is_post_type_archive("product")) && ($products_skin_l == "" || $products_skin_l == "default")) || (is_tax("question-category") && ($cat_skin_l == "" || $cat_skin_l == "default")) || (is_tax("question_tags") && ($questions_skin_l == "" || $questions_skin_l == "default")) || ((is_post_type_archive("question")) && ($questions_skin_l == "" || $questions_skin_l == "default"))) {
		if ($site_skin_all == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}
	
	$site_skin = vpanel_options('site_skin');
	if ($site_skin != "default" && $site_skin != "default_color") {
		wp_enqueue_style('skin-'.$site_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$site_skin.".css");
	}else {
		wp_enqueue_style('v-skins', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
	}
	
	wp_enqueue_style('vpanel_custom', get_template_directory_uri( __FILE__ )."/css/custom.css");
	
	$custom_css = '';
	$vbegy_layout = "";
	$cat_layout = "";
	$products_layout = "";
	$questions_layout = "";
	$author_layout = "";
	if (is_category()) {
		$category_id = get_query_var('cat');
		$categories = get_option("categories_$category_id");
		$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
		$background_img = (isset($categories["background_img"])?$categories["background_img"]:"");
		$background_color = (isset($categories["background_color"])?$categories["background_color"]:"");
		$background_repeat = (isset($categories["background_repeat"])?$categories["background_repeat"]:"");
		$background_fixed = (isset($categories["background_fixed"])?$categories["background_fixed"]:"");
		$background_position_x = (isset($categories["background_position_x"])?$categories["background_position_x"]:"");
		$background_position_y = (isset($categories["background_position_y"])?$categories["background_position_y"]:"");
		$cat_full_screen_background = (isset($categories["background_full"])?$categories["background_full"]:"");
		$cat_skin = (isset($categories["cat_skin"])?$categories["cat_skin"]:"default");
		$primary_color_c = (isset($categories["primary_color"])?$categories["primary_color"]:"");
		$secondary_color_c = (isset($categories["secondary_color"])?$categories["secondary_color"]:"");
	}else if (is_tax("product_cat")) {
		$tax_id = get_term_by('slug',get_query_var('term'),"product_cat");
		$tax_id = $tax_id->term_id;
		$categories = get_option("categories_$tax_id");
		$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
		$background_img = (isset($categories["background_img"])?$categories["background_img"]:"");
		$background_color = (isset($categories["background_color"])?$categories["background_color"]:"");
		$background_repeat = (isset($categories["background_repeat"])?$categories["background_repeat"]:"");
		$background_fixed = (isset($categories["background_fixed"])?$categories["background_fixed"]:"");
		$background_position_x = (isset($categories["background_position_x"])?$categories["background_position_x"]:"");
		$background_position_y = (isset($categories["background_position_y"])?$categories["background_position_y"]:"");
		$cat_full_screen_background = (isset($categories["background_full"])?$categories["background_full"]:"");
		$cat_skin = (isset($categories["cat_skin"])?$categories["cat_skin"]:"default");
		$primary_color_c = (isset($categories["primary_color"])?$categories["primary_color"]:"");
		$secondary_color_c = (isset($categories["secondary_color"])?$categories["secondary_color"]:"");
		if ($primary_color_c == "" && $secondary_color_c == "") {
			$primary_color_c = vpanel_options('products_primary_color');
			$secondary_color_c = vpanel_options('products_secondary_color');
		}
		if ($cat_skin == "" || $cat_skin == "default") {
			$cat_skin = vpanel_options('products_skin');
		}
		$background_position = $background_position_x." ".$background_position_y;
		$background_type = "";
		$background_pattern = "";
		$custom_background = "";
		if ($cat_layout == "" || $cat_layout == "default") {
			$cat_layout = vpanel_options("products_layout");
			if ($cat_layout == "fixed" || $cat_layout == "fixed_2"):
				$background_type = vpanel_options("products_background_type");
				$custom_background = vpanel_options("products_custom_background");
				$background_pattern = vpanel_options("products_background_pattern");
				$background_img = $custom_background["image"];
				$background_color = $custom_background["color"];
				$background_repeat = $custom_background["repeat"];
				$background_fixed = $custom_background["attachment"];
				$background_position = $custom_background["position"];
				$cat_full_screen_background = vpanel_options("products_full_screen_background");
			endif;
		}
	}else if (is_tax("product_tag") || is_post_type_archive("product")) {
		$products_layout = vpanel_options('products_layout');
		$products_background_type = vpanel_options('products_background_type');
		$products_background_color = vpanel_options('products_background_color');
		$products_background_pattern = vpanel_options('products_background_pattern');
		$products_custom_background = vpanel_options('products_custom_background');
		$products_full_screen_background = vpanel_options('products_full_screen_background');
		$vbegy_skin = vpanel_options('products_skin');
		$primary_color_c = vpanel_options('products_primary_color');
		$secondary_color_c = vpanel_options('products_secondary_color');
	}else if (is_tax("question-category")) {
		$tax_id = get_term_by('slug',get_query_var('term'),"question-category");
		$tax_id = $tax_id->term_id;
		$categories = get_option("categories_$tax_id");
		$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
		$background_img = (isset($categories["background_img"])?$categories["background_img"]:"");
		$background_color = (isset($categories["background_color"])?$categories["background_color"]:"");
		$background_repeat = (isset($categories["background_repeat"])?$categories["background_repeat"]:"");
		$background_fixed = (isset($categories["background_fixed"])?$categories["background_fixed"]:"");
		$background_position_x = (isset($categories["background_position_x"])?$categories["background_position_x"]:"");
		$background_position_y = (isset($categories["background_position_y"])?$categories["background_position_y"]:"");
		$cat_full_screen_background = (isset($categories["background_full"])?$categories["background_full"]:"");
		$cat_skin = (isset($categories["cat_skin"])?$categories["cat_skin"]:"default");
		$primary_color_c = (isset($categories["primary_color"])?$categories["primary_color"]:"");
		$secondary_color_c = (isset($categories["secondary_color"])?$categories["secondary_color"]:"");
		if ($primary_color_c == "" && $secondary_color_c == "") {
			$primary_color_c = vpanel_options('questions_primary_color');
			$secondary_color_c = vpanel_options('questions_secondary_color');
		}
		if ($cat_skin == "" || $cat_skin == "default") {
			$cat_skin = vpanel_options('questions_skin');
		}
		$background_position = $background_position_x." ".$background_position_y;
		$background_type = "";
		$background_pattern = "";
		$custom_background = "";
		if ($cat_layout == "" || $cat_layout == "default") {
			$cat_layout = vpanel_options("questions_layout");
			if ($cat_layout == "fixed" || $cat_layout == "fixed_2"):
				$background_type = vpanel_options("questions_background_type");
				$custom_background = vpanel_options("questions_custom_background");
				$background_pattern = vpanel_options("questions_background_pattern");
				$background_img = $custom_background["image"];
				$background_color = $custom_background["color"];
				$background_repeat = $custom_background["repeat"];
				$background_fixed = $custom_background["attachment"];
				$background_position = $custom_background["position"];
				$cat_full_screen_background = vpanel_options("questions_full_screen_background");
			endif;
		}
	}else if (is_tax("question_tags") || is_post_type_archive("question")) {
		$questions_layout = vpanel_options('questions_layout');
		$questions_background_type = vpanel_options('questions_background_type');
		$questions_background_color = vpanel_options('questions_background_color');
		$questions_background_pattern = vpanel_options('questions_background_pattern');
		$questions_custom_background = vpanel_options('questions_custom_background');
		$questions_full_screen_background = vpanel_options('questions_full_screen_background');
		$vbegy_skin = vpanel_options('questions_skin');
		$primary_color_c = vpanel_options('questions_primary_color');
		$secondary_color_c = vpanel_options('questions_secondary_color');
	}else if (is_author()) {
		$author_layout = vpanel_options('author_layout');
		$author_background_type = vpanel_options('author_background_type');
		$author_background_color = vpanel_options('author_background_color');
		$author_background_pattern = vpanel_options('author_background_pattern');
		$author_custom_background = vpanel_options('author_custom_background');
		$author_full_screen_background = vpanel_options('author_full_screen_background');
		$vbegy_skin = vpanel_options('author_skin');
		$primary_color_a = vpanel_options('author_primary_color');
		$secondary_color_a = vpanel_options('author_secondary_color');
	}else if (is_single() || is_page()) {
		global $post;
		$vbegy_layout = rwmb_meta('vbegy_layout','radio',$post->ID);
		$primary_color_p = rwmb_meta('vbegy_primary_color','color',$post->ID);
		$secondary_color_p = rwmb_meta('vbegy_secondary_color','color',$post->ID);
		$vbegy_skin = rwmb_meta('vbegy_skin','radio',$post->ID);
		if (is_singular("product")) {
			if ($vbegy_layout == "" || $vbegy_layout == "default") {
				$vbegy_layout = vpanel_options("products_layout");
			}
			if ($vbegy_skin == "" || $vbegy_skin == "default") {
				$vbegy_skin = vpanel_options("products_skin");
			}
			if ($primary_color_p == "" && $secondary_color_p == "") {
				$primary_color_p = vpanel_options("products_primary_color");
				$secondary_color_p = vpanel_options("products_secondary_color");
			}
		}
		if (is_singular("question")) {
			if ($vbegy_layout == "" || $vbegy_layout == "default") {
				$vbegy_layout = vpanel_options("questions_layout");
			}
			if ($vbegy_skin == "" || $vbegy_skin == "default") {
				$vbegy_skin = vpanel_options("questions_skin");
			}
			if ($primary_color_p == "" && $secondary_color_p == "") {
				$primary_color_p = vpanel_options("questions_primary_color");
				$secondary_color_p = vpanel_options("questions_secondary_color");
			}
		}
		if ($vbegy_skin == "" || $vbegy_skin == "default") {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}
	
	if (is_category() && $cat_layout != "default") {
		if ($cat_layout != "full") {
			if ($cat_full_screen_background == "on") {
				$custom_css .= '.background-cover {';
					if (!empty($background_color)) {
						$custom_css .= 'background-color: '.esc_attr($background_color);
					}
					$custom_css .= 'background-image : url("'.esc_attr($background_img).'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.esc_attr($background_img).'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.esc_attr($background_img).'\',sizingMethod=\'scale\')";';
				$custom_css .= '}';
			}else {
				if (!empty($background_img)) {
					$custom_css .= 'body {
						background:';
						if ($cat_full_screen_background != "on") {
							$custom_css .= esc_attr($background_color).' url('.esc_attr($background_img).') '.esc_attr($background_repeat).' '.esc_attr($background_position_x).' '.esc_attr($background_position_y).' '.esc_attr($background_fixed).';';
						}
					$custom_css .= '}';
				}
			}
		}
	}else if (is_tax("product_cat") && $cat_layout != "default") {
		if ($cat_layout != "full") {
			if ($cat_full_screen_background == "on") {
				$custom_css .= '.background-cover {';
					if (!empty($background_color)) {
						$custom_css .= 'background-color: '.$background_color.';';
					}
					$custom_css .= 'background-image : url("'.$background_img.'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.$background_img.'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.$background_img.'\',sizingMethod=\'scale\')";
				}';
			}else {
				if ($background_type == "patterns" || !empty($custom_background)) {
					$custom_css .= 'body {
						background:';
						if ($background_type == "patterns") {
							if ($background_pattern != "default") {
								$custom_css .= esc_attr($background_color).' url('.esc_attr(get_template_directory_uri()).'/images/patterns/'.esc_attr($background_pattern).'.png) repeat;';
							}
						}
						if (!empty($custom_background)) {
							if ($cat_full_screen_background != "on") {
								$custom_css .= esc_attr($background_color).' url("'.esc_attr($background_img).'") '.esc_attr($background_repeat).' '.esc_attr($background_fixed).' '.esc_attr($background_position).';';
							}
						}
					$custom_css .= '}';
				}
			}
		}
	}else if ((is_tax("product_tag") && $products_layout != "default") || ((is_post_type_archive("product")) && $products_layout != "default")) {
		if ($products_layout != "full") {
			$custom_background = $products_custom_background;
			if ($products_full_screen_background == "on" && $products_background_type != "patterns") {
				$custom_css .= '.background-cover {';
					if (!empty($products_background_color)) {
						$custom_css .= 'background-color: '.esc_attr($products_background_color) .';';
					}
					$custom_css .= 'background-image : url("'.esc_attr($custom_background["image"]).'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.esc_attr($custom_background["image"]).'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.($custom_background["image"]).'\',sizingMethod=\'scale\')";
				}';
			}else {
				if ($products_background_type == "patterns" || !empty($custom_background)) {
					$custom_css .= 'body {
						background:';
						if ($products_background_type == "patterns") {
							if ($products_background_pattern != "default") {
								$custom_css .= esc_attr($products_background_color).' url('.esc_attr(get_template_directory_uri()).'/images/patterns/'.esc_attr($products_background_pattern).'.png) repeat;';
							}
						}
						if (!empty($custom_background)) {
							if ($products_full_screen_background != "on") {
								$custom_css .= esc_attr($custom_background["color"]).' url('.esc_attr($custom_background["image"]).') '.esc_attr($custom_background["repeat"]).' '.esc_attr($custom_background["position"]).' '.esc_attr($custom_background["attachment"]).';';
							}
						}
					$custom_css .= '}';
				}
			}
		}
	}else if (is_tax("question-category") && $cat_layout != "default") {
		if ($cat_layout != "full") {
			if ($cat_full_screen_background == "on") {
				$custom_css .= '.background-cover {';
					if (!empty($background_color)) {
						$custom_css .= 'background-color: '.$background_color.';';
					}
					$custom_css .= 'background-image : url("'.$background_img.'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.$background_img.'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.$background_img.'\',sizingMethod=\'scale\')";
				}';
			}else {
				if ($background_type == "patterns" || !empty($custom_background)) {
					$custom_css .= 'body {
						background:';
						if ($background_type == "patterns") {
							if ($background_pattern != "default") {
								$custom_css .= esc_attr($background_color).' url('.esc_attr(get_template_directory_uri()).'/images/patterns/'.esc_attr($background_pattern).'.png) repeat;';
							}
						}
						if (!empty($custom_background)) {
							if ($cat_full_screen_background != "on") {
								$custom_css .= esc_attr($background_color).' url("'.esc_attr($background_img).'") '.esc_attr($background_repeat).' '.esc_attr($background_fixed).' '.esc_attr($background_position).';';
							}
						}
					$custom_css .= '}';
				}
			}
		}
	}else if ((is_tax("question_tags") && $questions_layout != "default") || ((is_post_type_archive("question")) && $questions_layout != "default")) {
		if ($questions_layout != "full") {
			$custom_background = $questions_custom_background;
			if ($questions_full_screen_background == "on" && $questions_background_type != "patterns") {
				$custom_css .= '.background-cover {';
					if (!empty($questions_background_color)) {
						$custom_css .= 'background-color: '.esc_attr($questions_background_color) .';';
					}
					$custom_css .= 'background-image : url("'.esc_attr($custom_background["image"]).'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.esc_attr($custom_background["image"]).'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.($custom_background["image"]).'\',sizingMethod=\'scale\')";
				}';
			}else {
				if ($questions_background_type == "patterns" || !empty($custom_background)) {
					$custom_css .= 'body {
						background:';
						if ($questions_background_type == "patterns") {
							if ($questions_background_pattern != "default") {
								$custom_css .= esc_attr($questions_background_color).' url('.esc_attr(get_template_directory_uri()).'/images/patterns/'.esc_attr($questions_background_pattern).'.png) repeat;';
							}
						}
						if (!empty($custom_background)) {
							if ($questions_full_screen_background != "on") {
								$custom_css .= esc_attr($custom_background["color"]).' url('.esc_attr($custom_background["image"]).') '.esc_attr($custom_background["repeat"]).' '.esc_attr($custom_background["position"]).' '.esc_attr($custom_background["attachment"]).';';
							}
						}
					$custom_css .= '}';
				}
			}
		}
	}else if (is_author() && $author_layout != "default") {
		if ($author_layout != "full") {
			$custom_background = $author_custom_background;
			if ($author_full_screen_background == "on" && $author_background_type != "patterns") {
				$custom_css .= '.background-cover {';
					if (!empty($author_background_color)) {
						$custom_css .= 'background-color:'.esc_attr($author_background_color) .';';
					}
					$custom_css .= 'background-image : url("'.esc_attr($custom_background["image"]).'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.esc_attr($custom_background["image"]).'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.($custom_background["image"]).'\',sizingMethod=\'scale\')";
				}';
			}else {
				if ($author_background_type == "patterns" || !empty($custom_background)) {
					$custom_css .= 'body {
						background:';
						if ($author_background_type == "patterns") {
							if ($author_background_pattern != "default") {
								$custom_css .= esc_attr($author_background_color).' url('.esc_attr(get_template_directory_uri()).'/images/patterns/'.esc_attr($author_background_pattern).'.png) repeat;';
							}
						}
						if (!empty($custom_background)) {
							if ($author_full_screen_background != "on") {
								$custom_css .= esc_attr($custom_background["color"]).' url('.esc_attr($custom_background["image"]).') '.esc_attr($custom_background["repeat"]).' '.esc_attr($custom_background["position"]).' '.esc_attr($custom_background["attachment"]).';';
							}
						}
					$custom_css .= '}';
				}
			}
		}
	}else if ((is_single() || is_page()) && $vbegy_layout != "" && $vbegy_layout != "default"):
		if ($vbegy_layout == "fixed" || $vbegy_layout == "fixed_2"):
			$background_img = rwmb_meta('vbegy_background_img','upload',$post->ID);
			$background_color = rwmb_meta('vbegy_background_color','color',$post->ID);
			$background_repeat = rwmb_meta('vbegy_background_repeat','select',$post->ID);
			$background_fixed = rwmb_meta('vbegy_background_fixed','select',$post->ID);
			$background_position_x = rwmb_meta('vbegy_background_position_x','select',$post->ID);
			$background_position_y = rwmb_meta('vbegy_background_position_y','select',$post->ID);
			$background_full = rwmb_meta('vbegy_background_full','checkbox',$post->ID);
			$background_position = $background_position_x." ".$background_position_y;
			$background_type = "";
			$background_pattern = "";
			$custom_background = "";
			$vbegy_layout = rwmb_meta('vbegy_layout','radio',$post->ID);
			if (is_singular("product")) {
				$vbegy_layout = vpanel_options("products_layout");
				if ($vbegy_layout == "fixed" || $vbegy_layout == "fixed_2"):
					$background_type = vpanel_options("products_background_type");
					$custom_background = vpanel_options("products_custom_background");
					$background_pattern = vpanel_options("products_background_pattern");
					$background_img = $custom_background["image"];
					$background_color = $custom_background["color"];
					$background_repeat = $custom_background["repeat"];
					$background_fixed = $custom_background["attachment"];
					$background_position = $custom_background["position"];
					$background_full = vpanel_options("products_full_screen_background");
				endif;
			}
			if (is_singular("question")) {
				$vbegy_layout = vpanel_options("questions_layout");
				if ($vbegy_layout == "fixed" || $vbegy_layout == "fixed_2"):
					$background_type = vpanel_options("questions_background_type");
					$custom_background = vpanel_options("questions_custom_background");
					$background_pattern = vpanel_options("questions_background_pattern");
					$background_img = $custom_background["image"];
					$background_color = $custom_background["color"];
					$background_repeat = $custom_background["repeat"];
					$background_fixed = $custom_background["attachment"];
					$background_position = $custom_background["position"];
					$background_full = vpanel_options("questions_full_screen_background");
				endif;
			}
			if ($background_full == 1 && $background_type != "patterns"):
				$custom_css .= '.background-cover {';
					if (!empty($background_color)) {
						$custom_css .= 'background-color: '.esc_attr($background_color).';';
					}
					$custom_css .= 'background-image : url("'.esc_attr($background_img).'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.esc_attr($background_img).'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.esc_attr($background_img).'\',sizingMethod=\'scale\')";
				}';
			else:
				if ($background_type == "patterns" || $background_color || $background_img) {
					$custom_css .= 'body {
						background:';
						if ($background_type == "patterns") {
							if ($background_pattern != "default") {
								$custom_css .= esc_attr($background_color).' url('.esc_attr(get_template_directory_uri()).'/images/patterns/'.esc_attr($background_pattern).'.png) repeat;';
							}
						}
						if ($background_color || $background_img) {
							if ($background_full != 1) {
								$custom_css .= esc_attr($background_color).' url("'.esc_attr($background_img).'") '.esc_attr($background_repeat).' '.esc_attr($background_fixed).' '.esc_attr($background_position).';';
							}
						}
					$custom_css .= '}';
				}
			endif;
		endif;
	else:
		if (vpanel_options("home_layout") != "full") {
			$custom_background = vpanel_options("custom_background");
			$full_screen_background = vpanel_options("full_screen_background");
			if ($full_screen_background == 1 && vpanel_options("background_type") != "patterns") {
				$custom_css .= '.background-cover {';
					$background_color_s = vpanel_options("background_color");
					if (!empty($background_color_s)) {
						$custom_css .= 'background-color: '.esc_attr($background_color_s) .';';
					}
					$custom_css .= 'background-image : url("'.esc_attr($custom_background["image"]).'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.esc_attr($custom_background["image"]).'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.esc_attr($custom_background["image"]).'\',sizingMethod=\'scale\')";
				}';
			}else {
				if (vpanel_options("background_type") == "patterns" || !empty($custom_background)) {
					$custom_css .= 'body {
						background:';
						if (vpanel_options("background_type") == "patterns") {
							if (vpanel_options("background_pattern") != "default") {
								$custom_css .= vpanel_options("background_color").' url('.get_template_directory_uri().'/images/patterns/'.vpanel_options("background_pattern").'.png) repeat;';
							}
						}
						if (!empty($custom_background)) {
							if ($full_screen_background != 1) {
								$custom_css .= esc_attr($custom_background["color"]).' url('.esc_attr($custom_background["image"]).') '.esc_attr($custom_background["repeat"]).' '.esc_attr($custom_background["position"]).' '.esc_attr($custom_background["attachment"]).';';
							}
						}
					$custom_css .= '}';
				}
			}
		}
	endif;
	
	if (is_category() && ($primary_color_c == "" && $secondary_color_c == "")) {
		if ($cat_skin != "default" && $cat_skin != "default_color") {
			if ($cat_skin == "skins") {
				wp_enqueue_style('v-skins', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
			}else if (!empty($cat_skin)) {
				wp_enqueue_style('skin-'.$cat_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$cat_skin.".css");
			}
		}else {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}else if (is_category() && ($primary_color_c != "" && $secondary_color_c != "")) {
		$custom_css .= all_css_color($primary_color_c,$secondary_color_c);
	}else if (is_tax("product_cat") && ($primary_color_c == "" && $secondary_color_c == "")) {
		if ($cat_skin != "default" && $cat_skin != "default_color") {
			if ($cat_skin == "skins") {
				wp_enqueue_style('v-skins', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
			}else if (!empty($cat_skin)) {
				wp_enqueue_style('skin-'.$cat_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$cat_skin.".css");
			}
		}else {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}else if (is_tax("product_cat") && ($primary_color_c != "" && $secondary_color_c != "")) {
		$custom_css .= all_css_color($primary_color_c,$secondary_color_c);
	}else if ((is_tax("product_tag") && ($primary_color_c == "" && $secondary_color_c == "")) || ((is_post_type_archive("product")) && ($primary_color_c == "" && $secondary_color_c == ""))) {
		if ($vbegy_skin != "default" && $vbegy_skin != "default_color") {
			if ($vbegy_skin == "skins") {
				wp_enqueue_style('v-skins', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
			}else if (!empty($vbegy_skin)) {
				wp_enqueue_style('skin-'.$vbegy_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$vbegy_skin.".css");
			}
		}else {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}else if ((is_tax("product_tag") && ($primary_color_c != "" && $secondary_color_c != "")) || (is_post_type_archive("product")) && ($primary_color_c != "" && $secondary_color_c != "")) {
		$custom_css .= all_css_color($primary_color_c,$secondary_color_c);
	}else if (is_tax("question-category") && ($primary_color_c == "" && $secondary_color_c == "")) {
		if ($cat_skin != "default" && $cat_skin != "default_color") {
			if ($cat_skin == "skins") {
				wp_enqueue_style('v-skins', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
			}else if (!empty($cat_skin)) {
				wp_enqueue_style('skin-'.$cat_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$cat_skin.".css");
			}
		}else {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}else if (is_tax("question-category") && ($primary_color_c != "" && $secondary_color_c != "")) {
		$custom_css .= all_css_color($primary_color_c,$secondary_color_c);
	}else if ((is_tax("question_tags") && ($primary_color_c == "" && $secondary_color_c == "")) || ((is_post_type_archive("question")) && ($primary_color_c == "" && $secondary_color_c == ""))) {
		if ($vbegy_skin != "default" && $vbegy_skin != "default_color") {
			if ($vbegy_skin == "skins") {
				wp_enqueue_style('v-skins', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
			}else if (!empty($vbegy_skin)) {
				wp_enqueue_style('skin-'.$vbegy_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$vbegy_skin.".css");
			}
		}else {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}else if ((is_tax("question_tags") && ($primary_color_c != "" && $secondary_color_c != "")) || (is_post_type_archive("question")) && ($primary_color_c != "" && $secondary_color_c != "")) {
		$custom_css .= all_css_color($primary_color_c,$secondary_color_c);
	}else if (is_author() && ($primary_color_a == "" && $secondary_color_a == "")) {
		if ($vbegy_skin != "default" && $vbegy_skin != "default_color") {
			if ($vbegy_skin == "skins") {
				wp_enqueue_style('v-skins', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
			}else if (!empty($vbegy_skin)) {
				wp_enqueue_style('skin-'.$vbegy_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$vbegy_skin.".css");
			}
		}else {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}else if (is_author() && ($primary_color_a != "" && $secondary_color_a != "")) {
		$custom_css .= all_css_color($primary_color_a,$secondary_color_a);
	}else if ((is_single() || is_page()) && ($primary_color_p == "" && $secondary_color_p == "")) {
		if ($vbegy_skin != "default" && $vbegy_skin != "default_color") {
			if ($vbegy_skin == "skins") {
				wp_enqueue_style('v-skins', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
			}else if (!empty($vbegy_skin)) {
				wp_enqueue_style('skin-'.$vbegy_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$vbegy_skin.".css");
			}
		}else {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}else if ((is_single() || is_page()) && ($primary_color_p != "" && $secondary_color_p != "")) {
		$custom_css .= all_css_color($primary_color_p,$secondary_color_p);
	}else {
		$primary_color = vpanel_options("primary_color");
		$secondary_color = vpanel_options("secondary_color");
		if ($primary_color != "" && $secondary_color != "") :
			$custom_css .= all_css_color($primary_color,$secondary_color);
		endif;
	}
	
	/* custom_css */
	if(vpanel_options("custom_css")) {
		$custom_css .= vpanel_options("custom_css");
	}
	if (is_single() || is_page()) {
		$custom_css .= rwmb_meta('vbegy_footer_css','textarea',$post->ID);
	}
	
	wp_add_inline_style('vpanel_custom',$custom_css);
	
	wp_enqueue_script("v_easing", get_template_directory_uri( __FILE__ )."/js/jquery.easing.1.3.min.js",array("jquery"));
	wp_enqueue_script("v_html5", get_template_directory_uri( __FILE__ )."/js/html5.js",array("jquery"));
	wp_enqueue_script("v_modernizr", get_template_directory_uri( __FILE__ )."/js/modernizr.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_jflickrfeed", get_template_directory_uri( __FILE__ )."/js/jflickrfeed.min.js",array("jquery"));
	wp_enqueue_script("v_inview", get_template_directory_uri( __FILE__ )."/js/jquery.inview.min.js",array("jquery"));
	wp_enqueue_script("v_tipsy", get_template_directory_uri( __FILE__ )."/js/jquery.tipsy.js",array("jquery"));
	wp_enqueue_script("v_tabs", get_template_directory_uri( __FILE__ )."/js/tabs.js",array("jquery"));
	wp_enqueue_script("v_flexslider", get_template_directory_uri( __FILE__ )."/js/jquery.flexslider.js",array("jquery"));
	wp_enqueue_script("v_prettyphoto", get_template_directory_uri( __FILE__ )."/js/jquery.prettyPhoto.js",array("jquery"));
	wp_enqueue_script("v_carouFredSel", get_template_directory_uri( __FILE__ )."/js/jquery.carouFredSel-6.2.1-packed.js",array("jquery"));
	wp_enqueue_script("v_scrollTo", get_template_directory_uri( __FILE__ )."/js/jquery.scrollTo.js",array("jquery"));
	wp_enqueue_script("v_nav", get_template_directory_uri( __FILE__ )."/js/jquery.nav.js",array("jquery"));
	wp_enqueue_script("v_tags", get_template_directory_uri( __FILE__ )."/js/tags.js",array("jquery"));
	wp_enqueue_script("v_nicescroll", get_template_directory_uri( __FILE__ )."/js/jquery.nicescroll.min.js",array("jquery"));
	if (is_rtl()) {
		wp_enqueue_script("v_bxslider", get_template_directory_uri( __FILE__ )."/js/jquery.bxslider.min-ar.js",array("jquery"));
	}else {
		wp_enqueue_script("v_bxslider", get_template_directory_uri( __FILE__ )."/js/jquery.bxslider.min.js",array("jquery"));
	}
	wp_enqueue_script("v_custom", get_template_directory_uri( __FILE__ )."/js/custom.js",array("jquery","jquery-ui-core","jquery-ui-sortable"));
	wp_localize_script("v_custom","template_url",get_template_directory_uri( __FILE__ ));
	$products_excerpt_title = vpanel_options("products_excerpt_title");
	$products_excerpt_title = (isset($products_excerpt_title)?$products_excerpt_title:40);
	wp_localize_script("v_custom","products_excerpt_title",$products_excerpt_title);
	wp_localize_script("v_custom","go_to",__("Go to...","vbegy"));
	wp_localize_script("v_custom","ask_error_text",__("Please fill the required field.","vbegy"));
	wp_localize_script("v_custom","ask_error_captcha",__("The captcha is incorrect, please try again.","vbegy"));
	$captcha_answer = vpanel_options("captcha_answer");
	wp_localize_script("v_custom","captcha_answer",$captcha_answer);
	wp_localize_script("v_custom","add_question",get_page_link(vpanel_options('add_question')));
	wp_localize_script("v_custom","ask_error_empty",__("Fill out all the required fields.","vbegy"));
	wp_localize_script("v_custom","no_vote_question",__("Sorry, you cannot vote your question.","vbegy"));
	wp_localize_script("v_custom","no_vote_more",__("Sorry, you cannot vote on the same question more than once.","vbegy"));
	wp_localize_script("v_custom","no_vote_user",__("Rating is available to members only.","vbegy"));
	wp_localize_script("v_custom","no_vote_answer",__("Sorry, you cannot vote your answer.","vbegy"));
	wp_localize_script("v_custom","no_vote_more_answer",__("Sorry, you cannot vote on the same answer more than once.","vbegy"));
	wp_localize_script("v_custom","v_get_template_directory_uri",get_template_directory_uri());
	wp_localize_script("v_custom","sure_report",__("Are you sure you want to Report?","vbegy"));
	wp_localize_script("v_custom","sure_delete",__("Are you sure you want to delete the question?","vbegy"));
	wp_localize_script("v_custom","sure_delete_post",__("Are you sure you want to delete the post?","vbegy"));
	wp_localize_script("v_custom","reported_question",__("Were reported for the question!","vbegy"));
	wp_localize_script("v_custom","choose_best_answer",__("Select as best answer","vbegy"));
	wp_localize_script("v_custom","cancel_best_answer",__("Cancel the best answer","vbegy"));
	wp_localize_script("v_custom","best_answer",__("Best answer","vbegy"));
	wp_localize_script("v_custom","follow_question_attr",__("Follow the question","vbegy"));
	wp_localize_script("v_custom","unfollow_question_attr",__("Unfollow the question","vbegy"));
	wp_localize_script("v_custom","follow_question",__("Follow","vbegy"));
	wp_localize_script("v_custom","unfollow_question",__("Unfollow","vbegy"));
	wp_localize_script("v_custom","admin_url",admin_url("admin-ajax.php"));
	wp_localize_script("v_custom","select_file",__("Select file","vbegy"));
	wp_localize_script("v_custom","browse",__("Browse","vbegy"));
	wp_localize_script("v_custom","question_tab",wp_unslash($_SERVER['HTTP_HOST']));
	if (is_rtl()) {
		wp_enqueue_script("v_custom_ar", get_template_directory_uri( __FILE__ )."/js/custom-ar.js",array("jquery"));
	}
	
	if (is_singular() && vpanel_options("comment_editor") != 1 && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
add_action('wp_enqueue_scripts','vbegy_scripts_styles');
/* vbegy_load_theme */
function vbegy_load_theme() {
    /* Default RSS feed links */
    add_theme_support('automatic-feed-links');

    /* Post Thumbnails */
    if (function_exists('add_theme_support')) {
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size( 50, 50, true );
        set_post_thumbnail_size( 60, 60, true );
        set_post_thumbnail_size( 80, 80, true );
        set_post_thumbnail_size( 250,160, true );
        set_post_thumbnail_size( 250,190, true );
        set_post_thumbnail_size( 1100,600, true );
        set_post_thumbnail_size( 810,450, true );
        set_post_thumbnail_size( 660,330, true );
    }
    if (function_exists('add_image_size')) {
        add_image_size('vbegy_img_1', 50, 50, true );
		add_image_size('vbegy_img_2', 60, 60, true );
		add_image_size('vbegy_img_3', 80, 80, true );
		add_image_size('vbegy_img_4', 250,160, true );
		add_image_size('vbegy_img_5', 250,190, true );
		add_image_size('vbegy_img_6', 1100,600, true );
		add_image_size('vbegy_img_7', 810,450, true );
		add_image_size('vbegy_img_8', 660,330, true );
    }
    
    /* Valid HTML5 */
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list') );
    /* This theme uses its own gallery styles */
    add_filter('use_default_gallery_style', '__return_false');
}
add_action('after_setup_theme', 'vbegy_load_theme');

/* wp head */
function vbegy_head() {
	global $post;
    $default_favicon = get_template_directory_uri()."/images/favicon.png";
    if (vpanel_options("favicon")) {
    	echo '<link rel="shortcut icon" href="'.vpanel_options("favicon").'" type="image/x-icon">' ."\n";
    }

    /* Favicon iPhone */
    if (vpanel_options("iphone_icon")) {
        echo '<link rel="apple-touch-icon-precomposed" href="'.vpanel_options("iphone_icon").'">' ."\n";
    }

    /* Favicon iPhone 4 Retina display */
    if (vpanel_options("iphone_icon_retina")) {
        echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="'.vpanel_options("iphone_icon_retina").'">' ."\n";
    }

    /* Favicon iPad */
    if (vpanel_options("ipad_icon")) {
        echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'.vpanel_options("ipad_icon").'">' ."\n";
    }

    /* Favicon iPad Retina display */
    if (vpanel_options("ipad_icon_retina")) {
        echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="'.vpanel_options("ipad_icon_retina").'">' ."\n";
    }

    /* Seo */
    $the_seo = stripslashes(vpanel_options("the_keywords"));

    if (vpanel_options("seo_active") == 1) {
    	$fbShareImage = get_option('fb_share_image');
    	
    	echo '<meta property="og:site_name" content="'.htmlspecialchars(get_bloginfo('name')).'" />'."\n";
    	echo '<meta property="og:type" content="website" />'."\n";
    	
        if (is_single() || is_page()) {
        	wp_reset_query();
        	if ( have_posts() ) : while ( have_posts() ) : the_post();
        		$vpanel_image = vpanel_image();
        		if ((function_exists("has_post_thumbnail") && has_post_thumbnail()) || !empty($vpanel_image)) {
        			if (has_post_thumbnail()) {
						$image_id = get_post_thumbnail_id($post->ID);
						$image_url = wp_get_attachment_image_src($image_id,"vbegy_img_8");
    		        	$post_thumb = $image_url[0];
    		        }else {
    		        	$post_thumb = $vpanel_image;
    		        }
    		    }else {
    		        $protocol = is_ssl() ? 'https' : 'http';
    		        
    		        $video_id = rwmb_meta('vbegy_video_post_id',"select",$post->ID);
    		        $video_type = rwmb_meta('vbegy_video_post_type',"text",$post->ID);
    		        if (is_singular("question")) {
    		        	$video_id = get_post_meta($post->ID,'video_id',true);
    		        	$video_type = get_post_meta($post->ID,'video_type',true);
    		        }
    		
    				if (!empty($video_id)) {
			            if ($video_type == 'youtube') {
			                $post_thumb = $protocol.'://img.youtube.com/vi/'.$video_id.'/0.jpg';
			            }else if ($video_type == 'vimeo') {
			                $url = $protocol.'://vimeo.com/api/v2/video/'.$video_id.'.php';
			                $contents = @file_get_contents($url);
			                $thumb = @unserialize(trim($contents));
			                $post_thumb = $thumb[0]['thumbnail_large'];
			            }elseif ($video_type == 'daily') {
			                $post_thumb = 'http://www.dailymotion.com/thumbnail/video/'.$video_id;
			            }
		            }
    		    }
    		    
    		    if (!empty($post_thumb)) {
    		        echo '<meta property="og:image" content="' . $post_thumb . '" />' . "\n";
    		    }else {
    		    	$fb_share_image = vpanel_options("fb_share_image");
		    		$logo_display = vpanel_options("logo_display");
		    		$logo_img = vpanel_options("logo_img");
    		    	if (!empty($fb_share_image)) {
    		        	echo '<meta property="og:image" content="' . $fb_share_image . '" />' . "\n";
    		        }else if ($logo_display == "custom_image" && isset($logo_img) && $logo_img != "") {
    		        	echo '<meta property="og:image" content="' . $logo_img . '" />' . "\n";?>
    		        <?php }
    		    }
        			
        		$title = the_title('', '', false);
        		$php_version = explode('.', phpversion());
        		if(count($php_version) && $php_version[0]>=5)
        			$title = html_entity_decode($title,ENT_QUOTES,'UTF-8');
        		else
        			$title = html_entity_decode($title,ENT_QUOTES);
        			echo '<meta property="og:title" content="'.htmlspecialchars($title).'" />'."\n";
        			echo '<meta property="og:url" content="'.get_permalink().'" />'."\n";
        				$description = trim(get_the_excerpt());
        			if ($description != '')
        			    	echo '<meta property="og:description" content="'.htmlspecialchars($description).'" />'."\n";
        			    	
        	    if (is_singular("question")) {
        	    	if ($terms = wp_get_object_terms( $post->ID, 'question_tags')) :
        	    		$the_tags_post = '';
        	    			$terms_array = array();
        	    			foreach ($terms as $term) :
        	    				$the_tags_post .= $term->name . ',';
        	    			endforeach;
        	    			echo '<meta name="keywords" content="' . trim($the_tags_post, ',') . '">' ."\n";
        	    	endif;
        		}else {
        	    	$posttags = get_the_tags();
        		    if ($posttags) {
        		        $the_tags_post = '';
        		        foreach ($posttags as $tag) {
        		            $the_tags_post .= $tag->name . ',';
        		        }
        		        echo '<meta name="keywords" content="' . trim($the_tags_post, ',') . '">' ."\n";
        		    }
        	    }
        	endwhile;endif;wp_reset_query();
        }else {
        	$fb_share_image = vpanel_options("fb_share_image");
        	$logo_display = vpanel_options("logo_display");
        	$logo_img = vpanel_options("logo_img");
        	if (!empty($fb_share_image)) {
        		echo '<meta property="og:image" content="' . $fb_share_image . '" />' . "\n";
        	}else if ($logo_display == "custom_image" && isset($logo_img) && $logo_img != "") {
        		echo '<meta property="og:image" content="' . $logo_img . '" />' . "\n";
        	}
        	echo '<meta property="og:title" content="'.get_bloginfo('name').'" />' . "\n";
        	echo '<meta property="og:url" content="'.home_url().'" />' . "\n";
        	echo '<meta property="og:description" content="'.get_bloginfo('description').'" />' . "\n";
	        echo "<meta name='keywords' content='".$the_seo."'>" ."\n";
        }
    }
    
    /* head_code */
    if(vpanel_options("head_code")) {
        echo stripslashes(vpanel_options("head_code"));
    }
}
add_action('wp_head', 'vbegy_head');

function vbegy_footer() {
    /* footer_code */
    if(vpanel_options("footer_code")) {
        echo stripslashes(vpanel_options("footer_code"));
    }
}
add_action('wp_footer', 'vbegy_footer');
/* wp login head */
function vbegy_login_logo() {
	$login_logo        = vpanel_options("login_logo");
	$login_logo_height = vpanel_options("login_logo_height");
	$login_logo_width  = vpanel_options("login_logo_width");
	if (isset($login_logo) && $login_logo != "") {
		echo '<style type="text/css">
		.login h1 a {
			background-image:url('.$login_logo.')  !important;
			background-size: auto !important;
			'.(isset($login_logo_height) && $login_logo_height != ""?"height: ".$login_logo_height."px !important;":"").'
			'.(isset($login_logo_width) && $login_logo_width != ""?"width: ".$login_logo_width."px !important;":"").'
		}
		</style>';
	}
}
add_action('login_head',  'vbegy_login_logo');

/* all_css_color */
function all_css_color($color_1,$color_2) {
	$all_css_color = '
	::-moz-selection {
	    background: '.esc_attr($color_1).';
	}
	::selection {
	    background: '.esc_attr($color_1).';
	}
	.more:hover,.button.color,.button.black:hover,.go-up,.widget_portfolio .portfolio-widget-item:hover .portfolio_img:before,.popular_posts .popular_img:hover a:before,.widget_flickr a:hover:before,.widget_highest_points .author-img a:hover:before,.question-author-img:hover span,.pagination a:hover,.pagination span:hover,.pagination span.current,.about-author .author-image a:hover:before,.question-comments a,.flex-direction-nav li a:hover,.button.dark_button.color:hover,.table-style-2 thead th,.progressbar-percent,.carousel-arrow a:hover,.box_icon:hover .icon_circle,.box_icon:hover .icon_soft_r,.box_icon:hover .icon_square,.bg_default,.box_warp_colored,.box_warp_hover:hover,.post .boxedtitle i,.single-question-title i,.question-type,.post-type,.social_icon a,.page-content .boxedtitle,.main-content .boxedtitle,.flex-caption h2,.flex-control-nav li a.flex-active,.bxslider-overlay:before,.navigation .header-menu ul li ul li:hover > a,.navigation .header-menu ul li ul li.current_page_item > a,#header-top,.navigation > .header-menu > ul > li:hover > a,.navigation > .header-menu > ul > li.current_page_item > a,.ask-me,.breadcrumbs,#footer-bottom .social_icons ul li a:hover,.tagcloud a:hover,input[type="checkbox"],.login-password a:hover,.tab a.current,.question-type-main,.question-report:hover,.load-questions,.del-poll-li:hover,.styled-select::before,.fileinputs span,.post .post-type,.divider span,.widget_menu li.current_page_item a,.accordion .accordion-title.active a,.tab-inner-warp,.navigation_mobile_click:before,.user-profile-img a:hover:before,.post-pagination > span,#footer.footer_dark .tagcloud a:hover,input[type="submit"],.post-delete a,.post-edit a,.woocommerce input[type="submit"][name="update_cart"]:hover,.buttons .button.wc-forward:hover,.button.checkout.wc-forward,.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,.woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content,ul.products li .woocommerce_product_thumbnail .woocommerce_woo_cart_bt .button,ul.products li .woocommerce_product_thumbnail .yith-wcwl-add-button .add_to_wishlist,.cart_list .remove,.wc-proceed-to-checkout .button.wc-forward,.single_add_to_cart_button,.return-to-shop a,.button-default.empty-cart,.wc-proceed-to-checkout a,.button[name="calc_shipping"],.price_slider_amount button.button[type="submit"],.button.checkout.wc-forward,.button.view,#footer.footer_dark .buttons .button.wc-forward,#footer.footer_dark .buttons .button.wc-forward:first-child:hover {
		 background-color: '.esc_attr($color_1).';
	}
	p a,li a, a:hover,.button.normal:hover,span.color,#footer a:hover,.widget a:hover,.question h3 a:hover,.boxedtitle h1 a:hover,.boxedtitle h2 a:hover,.boxedtitle h3 a:hover,.boxedtitle h4 a:hover,.boxedtitle h5 a:hover,.boxedtitle h6 a:hover,.box_icon:hover span i,.color_default,.navigation_mobile > ul a:hover,.navigation_mobile > ul li ul li:hover:before,.post .post-meta .meta-author a:hover,.post .post-meta .meta-categories a:hover,.post .post-meta .meta-comment a:hover,.question h2 a:hover,.question-category a:hover,.question-reply:hover i,.question-category a:hover i,.question-comment a:hover,.question-comment a:hover i,.question-reply:hover,.post .post-meta .meta-author:hover a,.post .post-meta .meta-author:hover i,.post .post-meta .meta-categories:hover i,.post .post-meta .meta-comment:hover a,.post .post-meta .meta-comment:hover i,.post-title a:hover,.question-tags a,.question .question-type,.comment-author a:hover,.comment-reply:hover,.user-profile-widget li a:hover,.taglist .tag a.delete:before,.form-style p span.color,.post-tags,.post-tags a,.related-posts li a:hover,.related-posts li a:hover i,#footer.footer_light_top .related-posts li a:hover,.related-posts li a:hover i,.share-inside,.share-inside-warp ul li a:hover,.user-points .question-vote-result,.navigation > .header-menu > ul > li > a > .menu-nav-arrow,#footer-bottom a,.widget h3.widget_title,#footer .related-item span,.widget_twitter ul li:before,#footer .widget_twitter .tweet_time a,.widget_highest_points li h6 a,#footer .widget_contact ul li span,.rememberme label,.ask_login .ask_captcha_p i,.login-text i,.subscribe-text i,.widget_search .search-submit,.login-password i,.question-tags,.question-tags i,.panel-pop h2,input[type="text"],input[type="password"],input[type="email"],textarea,select,.panel-pop p,.main-content .page-content .boxedtitle.page-title h2,.fakefile button,.login p,.login h2,.contact-us h2,.share-inside i,#related-posts h2,.comment-reply,.post-title,.post-title a,.user-profile h2,.user-profile h2 a,.stats-head,.block-stats-1,.block-stats-2,.block-stats-3,.block-stats-4,.user-question h3 a,.icon_shortcode .ul_icons li,.testimonial-client span,.box_icon h1,.box_icon h2,.box_icon h3,.box_icon h4,.box_icon h5,.box_icon h6,.widget_contact ul li i,#footer.footer_light_top .widget a:hover,#header .logo h2 a:hover,.widget_tabs.tabs-warp .tabs li a,#footer .widget .widget_highest_points a,#footer .related-item h3 a:hover,#footer.footer_dark .widget .widget_comments a:hover,#footer .widget_tabs.tabs-warp .tabs li a,.dark_skin .sidebar .widget a:hover,.user-points h3,.woocommerce mark,.woocommerce .product_list_widget ins span,.woocommerce-page .product_list_widget ins span,ul.products li .product-details h3 a:hover,ul.products li .product-details .price,ul.products li .product-details h3 a:hover,ul.products li .product-details > a:hover,.widget.woocommerce:not(.widget_product_categories):not(.widget_layered_nav) ul li a:hover,.price > .amount,.woocommerce-page .product .woocommerce-woo-price ins span,.cart_wrapper .widget_shopping_cart_content ul li a:hover,.woocommerce-billing-fields > h3,#order_review_heading,.woocommerce .sections h2,.yith-wcwl-share > h4,.woocommerce .sections h3,.woocommerce header.title h3,.main-title > h4,.woocommerce h2,.post-content .woocommerce h3,.box-default.woocommerce-message .button,.woocommerce .cart .product-name a:hover,header.title a,.widget_search label:before,.post .post-meta .post-view a:hover,.post .post-meta .post-view:hover a,.post .post-meta .post-view:hover i,.question-author-meta a:hover,.question-author-meta a:hover i {
		 color: '.esc_attr($color_1).';
	}
	.loader_html,input[type="text"]:focus,input[type="password"]:focus,input[type="email"]:focus,textarea:focus,.box_icon .form-style textarea:focus,.social_icon a,#footer-bottom .social_icons ul li a:hover,.widget_login input[type="text"],.widget_search input[type="text"],.widget_search input[type="search"],.widget_product_search input[type="search"],.subscribe_widget input[type="text"],.widget_login input[type="password"],.panel_light.login-panel input[type="text"],.panel_light.login-panel input[type="password"],#footer.footer_dark .tagcloud a:hover,#footer.footer_dark .widget_search input[type="text"],.widget_search input[type="search"]:focus,#footer.footer_dark .subscribe_widget input[type="text"]:focus,#footer.footer_dark .widget_login input[type="text"]:focus,#footer.footer_dark .widget_login input[type="password"]:focus,.dark_skin .sidebar .widget_search input[type="text"],.widget_search input[type="search"]:focus,.dark_skin .sidebar .subscribe_widget input[type="text"]:focus,.dark_skin .sidebar .widget_login input[type="text"]:focus,.dark_skin .sidebar .widget_login input[type="password"]:focus {
		border-color: '.esc_attr($color_1).';
	}
	.tabs {
		border-bottom-color: '.esc_attr($color_1).';
	}
	.tab a.current {
		border-top-color: '.esc_attr($color_1).';
	}
	.tabs-vertical .tab a.current,blockquote {
		border-right-color: '.esc_attr($color_1).';
	}
	blockquote {
		border-left-color: '.esc_attr($color_1).';
	}
	.box_warp_hover:hover,.box_warp_colored {
		border-color: '.esc_attr($color_2).';
	}
	#header .logo span {
		color: '.esc_attr($color_2).';
	}';
	$color_1_rgb = hex2rgb($color_1);
	if (isset($color_1_rgb) && is_array($color_1_rgb)) {
		$all_css_color .= '
		.ask-me .col-md-9 p textarea,.widget_login input[type="text"],.widget_search input[type="text"],.widget_search input[type="search"],.widget_product_search input[type="search"],.subscribe_widget input[type="text"],.widget_login input[type="password"],.panel_light.login-panel input[type="text"],.panel_light.login-panel input[type="password"],blockquote,.qoute {
			background: rgba('.implode(",",$color_1_rgb).',0.20);
		}';
	}
	return $all_css_color;
}

/* Content Width */
if (!isset( $content_width )) {
	$content_width = 785;
}
/* vpanel_feed_request */
function vpanel_feed_request ($qv) {
	if (isset($qv['feed']) && !isset($qv['post_type'])) {
		$qv['post_type'] = array('post', 'question', 'product');
	}
	return $qv;
}
add_filter('request', 'vpanel_feed_request');
/* top_bar_wordpress */
$top_bar_wordpress = vpanel_options("top_bar_wordpress");
if ($top_bar_wordpress == 1) {
	add_action('after_setup_theme', 'remove_admin_bar');
		function remove_admin_bar() {
		if (!current_user_can('administrator') && !is_admin()) {
			show_admin_bar(false);
		}
	}
}