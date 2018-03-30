<?php
$themename = "medicenter";

//plugins activator
require_once("plugins_activator.php");

//vc_remove_element("vc_row_inner");
if(function_exists("vc_remove_element"))
{
	vc_remove_element("vc_gmaps");
	vc_remove_element("vc_tour");
}

//theme options
mc_get_theme_file("/theme-options.php");

//custom meta box
mc_get_theme_file("/meta-box.php");

//dropdown menu
mc_get_theme_file("/nav-menu-dropdown-walker.php");
//mobile menu
mc_get_theme_file("/mobile-menu-walker.php");

//gallery functions
mc_get_theme_file("/gallery-functions.php");
//weekdays
mc_get_theme_file("/post-type-weekdays.php");
//departments
mc_get_theme_file("/post-type-departments.php");
if(function_exists("vc_map"))
{
	//doctors
	mc_get_theme_file("/post-type-doctors.php");
	//gallery
	mc_get_theme_file("/post-type-gallery.php");
	//features
	mc_get_theme_file("/post-type-features.php");
	//contact_form
	mc_get_theme_file("/contact_form.php");
}

//comments
mc_get_theme_file("/comments-functions.php");

//sidebars
mc_get_theme_file("/sidebars.php");

//widgets
mc_get_theme_file("/widgets/widget-cart-icon.php");
mc_get_theme_file("/widgets/widget-home-box.php");
mc_get_theme_file("/widgets/widget-departments.php");
mc_get_theme_file("/widgets/widget-appointment.php");
mc_get_theme_file("/widgets/widget-twitter.php");
mc_get_theme_file("/widgets/widget-footer-box.php");
mc_get_theme_file("/widgets/widget-contact-details.php");
mc_get_theme_file("/widgets/widget-scrolling-recent-posts.php");
mc_get_theme_file("/widgets/widget-scrolling-most-commented.php");
mc_get_theme_file("/widgets/widget-scrolling-most-viewed.php");

//shortcodes
if(function_exists("vc_map"))
	mc_get_theme_file("/shortcodes/shortcodes.php");

//admin functions
mc_get_theme_file("/admin/functions.php");

function theme_after_setup_theme()
{
	global $themename;
	if(!get_option($themename . "_installed") || !get_option("wpb_js_content_types"))
	{
		$theme_options = array(
			"favicon_url" => get_template_directory_uri() . "/images/favicon.ico",
			"logo_url" => get_template_directory_uri() . "/images/logo/blue/header_logo.png",
			"logo_text" => "medicenter",
			"footer_text_left" => "© Copyright - <a href='http://themeforest.net/user/QuanticaLabs/portfolio?ref=QuanticaLabs' target='_blank'>MediCenter Theme</a> by <a href='http://quanticalabs.com' title='QuanticaLabs' target='_blank'>QuanticaLabs</a>",
			"footer_text_right" => "[scroll_top]",
			//"home_page_top_hint" => "Give us a call: +123 356 123 124",
			"sticky_menu" => 0,
			"responsive" => 1,
			"direction" => "default",
			"animations" => 1,
			"layout" => "wide",
			"layout_picker" => 0,
			"home_page_top_hint" => "",
			"collapsible_mobile_submenus" => 1,
			"google_api_code" => "",
			"ga_tracking_code" => "",
			"color_scheme" => "",
			"header_top_sidebar" => "",
			"accordion_tab_color" => "",
			"body_background_color" => "",
			"body_button_border_color" => "",
			"body_button_border_hover_color" => "",
			"body_button_color" => "",
			"body_button_hover_color" => "",
			"body_headers_border_color" => "",
			"body_headers_color" => "",
			"body_text_color" => "",
			"bread_crumb_border_color" => "",
			"comment_reply_button_color" => "",
			"contact_details_box_background_color" => "",
			"copyright_area_border_color" => "",
			"date_box_color" => "",
			"date_box_comments_number_color" => "",
			"date_box_comments_number_text_color" => "",
			"date_box_text_color" => "",
			"divider_background_color" => "",
			"dropdownmenu_background_color" => "",
			"dropdownmenu_border_color" => "",
			"dropdownmenu_hover_background_color" => "",
			"footer_background_color" => "",
			"footer_button_border_color" => "",
			"footer_button_border_hover_color" => "",
			"footer_button_color" => "",
			"footer_button_hover_color" => "",
			"footer_headers_border_color" => "",
			"footer_headers_color" => "",
			"footer_link_color" => "",
			"footer_link_hover_color" => "",
			"footer_text_color" => "",
			"footer_timeago_label_color" => "",
			"form_button_background_color" => "",
			"form_button_hover_background_color" => "",
			"form_button_hover_text_color" => "",
			"form_button_text_color" => "",
			"form_field_active_border_color" => "",
			"form_field_border_color" => "",
			"form_field_text_color" => "",
			"gallery_box_border_color" => "",
			"gallery_box_color" => "",
			"gallery_box_hover_border_color" => "",
			"gallery_box_hover_color" => "",
			"gallery_box_hover_text_first_line_color" => "",
			"gallery_box_hover_text_second_line_color" => "",
			"gallery_box_text_first_line_color" => "",
			"gallery_box_text_second_line_color" => "",
			"gallery_details_box_border_color" => "",
			"header_background_color" => "",
			"header_font" => "",
			"header_font_subset" => "",
			"header_layout_type" => "1",
			"header_top_right_sidebar" => "",
			"link_color" => "",
			"link_hover_color" => "",
			"logo_text_color" => "",
			"main-menu" => "",
			"menu_position_background_color" => "",
			"menu_position_hover_background_color" => "",
			"menu_position_hover_text_color" => "",
			"menu_position_text_color" => "",
			"page_top_border_color" => "",
			"post_author_link_color" => "",
			"quote_color" => "",
			"sentence_color" => "",
			"site_background_color" => "",
			"subheader_font" => "",
			"subheader_font_subset" => "",
			"submenu_position_border_color" => "",
			"submenu_position_hover_border_color" => "",
			"submenu_position_hover_text_color" => "",
			"submenu_position_text_color" => "",
			"timeago_label_color" => "",
			"timetable_box_color" => "",
			"timetable_box_hours_text_color" => "",
			"timetable_box_hover_color" => "",
			"timetable_box_hover_hours_text_color" => "",
			"timetable_box_hover_text_color" => "",
			"timetable_box_text_color" => "",
			"timetable_tip_box_color" => "",
			"top_hint_background_color" => "",
			"top_hint_text_color" => "",
			"cf_admin_name" => get_option("admin_email"),
			"cf_admin_email" => get_option("admin_email"),
			"cf_smtp_host" => "",
			"cf_smtp_username" => "",
			"cf_smtp_password" => "",
			"cf_smtp_port" => "",
			"cf_smtp_secure" => "",
			"cf_email_subject" => "MediCenter WP: Contact from WWW",
			"cf_template" => "<html>
	<head>
	</head>
	<body>
		<div><b>First and last name</b>: [first_name] [last_name]</div>
		<div><b>E-mail</b>: [email]</div>
		<div><b>Department</b>: [department]</div>
		<div><b>Date of Birth (mm/dd/yyyy)</b>: [date]</div>
		<div><b>Social Security Number</b>: [social_security_number]</div>
		<div><b>Reason of Appointment</b>: [message]</div>
	</body>
</html>"
		);
		add_option($themename . "_options", $theme_options);
		
		add_option($themename . "_slider_settings_home-slider", array('slider_image_url' => array (0 => get_template_directory_uri() . "/images/slider/img1.jpg", 1 => get_template_directory_uri() . "/images/slider/img2.jpg", 2 => get_template_directory_uri() . "/images/slider/img3.jpg"), 'slider_image_title' => array(0 => 'Top notch<br>experience', 1 => 'Show your<br>schedule', 2 => 'Build it<br>your way'), 'slider_image_subtitle' => array (0 => 'Medicenter is a responsive template<br>perfect for all screen sizes', 1 => 'Organize and visualize your week<br>with build-in timetable', 2 => 'Limitless possibilities with multiple<br>page layouts and different shortcodes'), 'slider_image_link' => array (), 'slider_autoplay' => '1', 'slider_navigation' => '1', 'slider_pause_on_hover' => NULL, 'slider_height' => 670, 'slide_interval' => 5000, 'slider_effect' => 'scroll', 'slider_transition' => 'easeInOutQuint', 'slider_transition_speed' => 750));
		update_option("blogdescription", "Responsive Medical Health WordPress Theme");
		
		add_option("wpb_js_content_types", array(
			"page",
			"doctors", 
			"medicenter_gallery", 
			"features")
		);
		
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
		add_option($themename . "_installed", 1);
	}
	//Make theme available for translation
	//Translations can be filed in the /languages/ directory
	load_theme_textdomain('medicenter', get_template_directory() . '/languages');
	
	//register blog post thumbnail & portfolio thumbnail
	add_theme_support("post-thumbnails");
	add_image_size("blog-post-thumb", 540, 280, true);
	add_image_size($themename . "-gallery-image", 480, 300, true);
	add_image_size($themename . "-gallery-thumb-type-1", 310, 200, true);
	add_image_size($themename . "-gallery-thumb-type-2", 225, 150, true);
	add_image_size($themename . "-small-thumb", 96, 96, true);
	
	//posts order
	add_post_type_support('post', 'page-attributes');
	
	//woocommerce
	add_theme_support("woocommerce");
	//enable custom background
	add_theme_support("custom-background"); //3.4
	//add_custom_background(); //deprecated
	//title tag
	add_theme_support("title-tag");
	//register menu
	add_theme_support("menus");
	
	if(function_exists("register_nav_menu"))
	{
		register_nav_menu("main-menu", "Main Menu");
	}
	
	//custom theme filters
	add_filter('wp_title', 'cs_wp_title_filter', 10, 2);
	add_filter("image_size_names_choose", "theme_image_sizes");
	add_filter('upload_mimes', 'custom_upload_files');
	add_filter('excerpt_more', 'theme_excerpt_more', 99);
	add_filter('site_transient_update_plugins', 'medicenter_filter_update_vc_plugin', 10, 2);
	//using shortcodes in sidebar
	add_filter("widget_text", "do_shortcode");
	
	//custom theme woocommerce filters
	add_filter('woocommerce_pagination_args' , 'mc_woo_custom_override_pagination_args');
	add_filter('woocommerce_product_single_add_to_cart_text', 'mc_woo_custom_cart_button_text');
	add_filter('woocommerce_product_add_to_cart_text', 'mc_woo_custom_cart_button_text');
	add_filter('loop_shop_columns', 'mc_woo_custom_loop_columns');
	add_filter('woocommerce_product_description_heading', 'mc_woo_custom_product_description_heading');
	add_filter('woocommerce_checkout_fields' , 'mc_woo_custom_override_checkout_fields');
	add_filter('woocommerce_show_page_title', 'mc_woo_custom_show_page_title');
	add_filter('loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20);
	add_filter('woocommerce_review_gravatar_size', 'mc_woo_custom_review_gravatar_size');
	
	//custom theme actions
	if(!function_exists('_wp_render_title_tag')) 
		add_action('wp_head', 'cs_theme_slug_render_title');
	
	//custom theme woocommerce actions
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
	//remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5);
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 10);
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	
	//register sidebars
	if(function_exists("register_sidebar"))
	{
		//register custom sidebars
		query_posts(array( 
			'post_type' => $themename . '_sidebars',
			'posts_per_page' => '-1',
			'post_status' => 'publish',
			'orderby' => 'menu_order',
			'order' => 'ASC'
		));
		if(have_posts()) : while (have_posts()) : the_post();
			global $post;
			$before_widget = get_post_meta($post->ID, "before_widget", true);
			$after_widget = get_post_meta($post->ID, "after_widget", true);
			$before_title = get_post_meta($post->ID, "before_title", true);
			$after_title = get_post_meta($post->ID, "after_title", true);
			register_sidebar(array(
				"id" => $post->post_name,
				"name" => get_the_title(),
				'before_widget' => ($before_widget!='' && $before_widget!='empty' ? $before_widget : ''),
				'after_widget' => ($after_widget!='' && $after_widget!='empty' ? $after_widget : ''),
				'before_title' => ($before_title!='' && $before_title!='empty' ? $before_title : ''),
				'after_title' => ($after_title!='' && $after_title!='empty' ? $after_title : '')
			));
		endwhile; endif;
		//Reset Query
		wp_reset_query();
	}
}
add_action("after_setup_theme", "theme_after_setup_theme");
function theme_switch_theme($theme_template)
{
	global $themename;
	delete_option($themename . "_installed");
}
add_action("switch_theme", "theme_switch_theme");

//theme options
global $theme_options;
$theme_options = array(
	"favicon_url" => '',
	"logo_url" => '',
	"logo_text" => '',
	"footer_text_left" => '',
	"footer_text_right" => '',
	"sticky_menu" => '',
	"responsive" => '',
	"layout" => '',
	"layout_picker" => '',
	"direction" => '',
	"animations" => '',
	"collapsible_mobile_submenus" => '',
	"google_api_code" => '',
	"ga_tracking_code" => '',
	"home_page_top_hint" => '',
	"cf_admin_name" => '',
	"cf_admin_email" => '',
	"cf_smtp_host" => '',
	"cf_smtp_username" => '',
	"cf_smtp_password" => '',
	"cf_smtp_port" => '',
	"cf_smtp_secure" => '',
	"cf_email_subject" => '',
	"cf_template" => '',
	"color_scheme" => '',
	"site_background_color" => '',
	"header_background_color" => '',
	"body_background_color" => '',
	"footer_background_color" => '',
	"link_color" => '',
	"link_hover_color" => '',
	"footer_link_color" => '',
	"footer_link_hover_color" => '',
	"body_headers_color" => '',
	"body_headers_border_color" => '',
	"body_text_color" => '',
	"timeago_label_color" => '',
	"footer_headers_color" => '',
	"footer_headers_border_color" => '',
	"footer_text_color" => '',
	"footer_timeago_label_color" => '',
	"sentence_color" => '',
	"quote_color" => '',
	"logo_text_color" => '',
	"body_button_color" => '',
	"body_button_hover_color" => '',
	"body_button_border_color" => '',
	"body_button_border_hover_color" => '',
	"footer_button_color" => '',
	"footer_button_hover_color" => '',
	"footer_button_border_color" => '',
	"footer_button_border_hover_color" => '',
	"menu_position_text_color" => '',
	"menu_position_hover_text_color" => '',
	"menu_position_background_color" => '',
	"menu_position_hover_background_color" => '',
	"submenu_position_text_color" => '',
	"submenu_position_hover_text_color" => '',
	"submenu_position_border_color" => '',
	"submenu_position_hover_border_color" => '',
	"dropdownmenu_background_color" => '',
	"dropdownmenu_hover_background_color" => '',
	"dropdownmenu_border_color" => '',
	"form_field_text_color" => '',
	"form_field_border_color" => '',
	"form_field_active_border_color" => '',
	"form_button_background_color" => '',
	"form_button_hover_background_color" => '',
	"form_button_text_color" => '',
	"form_button_hover_text_color" => '',
	"top_hint_background_color" => '',
	"top_hint_text_color" => '',
	"page_top_border_color" => '',
	"divider_background_color" => '',
	"date_box_color" => '',
	"date_box_text_color" => '',
	"date_box_comments_number_color" => '',
	"date_box_comments_number_text_color" => '',
	"gallery_box_color" => '',
	"gallery_box_text_first_line_color" => '',
	"gallery_box_text_second_line_color" => '',
	"gallery_box_hover_color" => '',
	"gallery_box_hover_text_first_line_color" => '',
	"gallery_box_hover_text_second_line_color" => '',
	"gallery_box_border_color" => '',
	"gallery_box_hover_border_color" => '',
	"timetable_box_color" => '',
	"timetable_box_hover_color" => '',
	"timetable_box_text_color" => '',
	"timetable_box_hover_text_color" => '',
	"timetable_box_hours_text_color" => '',
	"timetable_box_hover_hours_text_color" => '',
	"timetable_tip_box_color" => '',
	"accordion_tab_color" => '',
	"copyright_area_border_color" => '',
	"header_layout_type" => '',
	"header_top_sidebar" => '',
	"header_top_right_sidebar" => '',
	"header_font" => '',
	"header_font_subset" => '',
	"subheader_font" => '',
	"subheader_font_subset" => ''
);
$theme_options = theme_stripslashes_deep(array_merge($theme_options, get_option($themename . "_options")));

function theme_enqueue_scripts()
{
	global $themename;
	global $theme_options;
	//style
	if(!empty($theme_options["header_font"]))
		wp_enqueue_style("google-font-header", "//fonts.googleapis.com/css?family=" . urlencode($theme_options["header_font"]) . (!empty($theme_options["header_font_subset"]) ? "&subset=" . implode(",", $theme_options["header_font_subset"]) : ""));
	else
		wp_enqueue_style("google-font-droid-sans", "//fonts.googleapis.com/css?family=PT+Sans");
	if(!empty($theme_options["subheader_font"]))
		wp_enqueue_style("google-font-subheader", "//fonts.googleapis.com/css?family=" . urlencode($theme_options["subheader_font"]) . (!empty($theme_options["subheader_font_subset"]) ? "&subset=" . implode(",", $theme_options["subheader_font_subset"]) : ""));
	else
		wp_enqueue_style("google-font-droid-serif", "//fonts.googleapis.com/css?family=Volkhov:400italic");
	wp_enqueue_style("reset", get_template_directory_uri() . "/style/reset.css");
	wp_enqueue_style("superfish", get_template_directory_uri() ."/style/superfish.css");
	wp_enqueue_style("jquery-fancybox", get_template_directory_uri() ."/style/fancybox/jquery.fancybox.css");
	wp_enqueue_style("jquery-qtip", get_template_directory_uri() ."/style/jquery.qtip.css");
	wp_enqueue_style("jquery-ui-custom", get_template_directory_uri() ."/style/jquery-ui-1.9.2.custom.css");
	if(((int)$theme_options["animations"] || !isset($theme_options["animations"])) && (isset($_COOKIE["mc_animations"]) && $_COOKIE["mc_animations"]==1 || !isset($_COOKIE["mc_animations"])))
		wp_enqueue_style("animations", get_template_directory_uri() ."/style/animations.css");
	wp_enqueue_style("main-style", get_stylesheet_uri());
	if((int)$theme_options["responsive"])
		wp_enqueue_style("responsive", get_template_directory_uri() ."/style/responsive.css");
	else
		wp_enqueue_style("no-responsive", get_template_directory_uri() ."/style/no_responsive.css");
	
	include_once(ABSPATH . 'wp-admin/includes/plugin.php');
	if(function_exists("is_plugin_active") && is_plugin_active('woocommerce/woocommerce.php'))
	{
		wp_enqueue_style("woocommerce-custom", get_template_directory_uri() ."/woocommerce/style.css");
		if((int)$theme_options["responsive"])
			wp_enqueue_style("woocommerce-responsive", get_template_directory_uri() ."/woocommerce/responsive.css");
		else
			wp_dequeue_style("woocommerce-smallscreen");
		if(is_rtl())
			wp_enqueue_style("woocommerce-rtl", get_template_directory_uri() ."/woocommerce/rtl.css");
	}
	
	wp_enqueue_style("custom", get_template_directory_uri() ."/custom.css");
	//js
	wp_enqueue_script("jquery", false, array(), false, true);
	wp_enqueue_script("jquery-ui-core", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ui-accordion", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ui-tabs", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ui-datepicker", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ba-bqq", get_template_directory_uri() ."/js/jquery.ba-bbq.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-history", get_template_directory_uri() ."/js/jquery.history.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-easing", get_template_directory_uri() ."/js/jquery.easing.1.3.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-carouFredSel", get_template_directory_uri() ."/js/jquery.carouFredSel-6.2.1-packed.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-sliderControl", get_template_directory_uri() ."/js/jquery.sliderControl.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-timeago", get_template_directory_uri() ."/js/jquery.timeago.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-hint", get_template_directory_uri() ."/js/jquery.hint.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-isotope", get_template_directory_uri() ."/js/jquery.isotope.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-isotope-masonry", get_template_directory_uri() ."/js/jquery.isotope.masonry.js", array("jquery", "jquery-isotope"), false, true);
	if(((is_rtl() || (isset($theme_options["direction"]) && $theme_options["direction"]=='rtl')) && (isset($_COOKIE["mc_direction"]) && $_COOKIE["mc_direction"]!="LTR")) || (isset($_COOKIE["mc_direction"]) && $_COOKIE["mc_direction"]=="RTL"))
		wp_enqueue_script("rtl-js", get_template_directory_uri() ."/js/rtl.js", array("jquery", "jquery-isotope"), "jquery-isotope-masonry", false, true);
	wp_enqueue_script("jquery-fancybox", get_template_directory_uri() ."/js/jquery.fancybox-1.3.4.pack.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-qtip", get_template_directory_uri() ."/js/jquery.qtip.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-block-ui", get_template_directory_uri() ."/js/jquery.blockUI.js", array("jquery"), false, true);
	wp_enqueue_script("google-maps-v3", "//maps.google.com/maps/api/js" . ($theme_options["google_api_code"]!="" ? "?key=" . esc_attr($theme_options["google_api_code"]) : ""), false, array(), false, true);

	wp_enqueue_script("theme-main", get_template_directory_uri() ."/js/main.js", array("jquery", "jquery-ui-core", "jquery-ui-accordion", "jquery-ui-tabs"), false, true);
	
	//ajaxurl
	$data["ajaxurl"] = admin_url("admin-ajax.php");
	//themename
	$data["themename"] = $themename;
	//home url
	$data["home_url"] = get_home_url();
	//is_rtl
	$data["is_rtl"] = ((is_rtl() || (isset($theme_options["direction"]) && $theme_options["direction"]=='rtl')) && (isset($_COOKIE["mc_direction"]) && $_COOKIE["mc_direction"]!="LTR")) || (isset($_COOKIE["mc_direction"]) && $_COOKIE["mc_direction"]=="RTL") ? 1 : 0;
	
	//pass data to javascript
	$params = array(
		'l10n_print_after' => 'config = ' . json_encode($data) . ';'
	);
	wp_localize_script("theme-main", "config", $params);
}
add_action("wp_enqueue_scripts", "theme_enqueue_scripts");

//function to display number of posts
function getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='')
	{
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }
    return (int)$count;
}

//function to count views
function setPostViews($postID) 
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='')
	{
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, 1);
    }
	else
	{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
//add new mimes for upload dummy content files (code can be removed after dummy content import)
function custom_upload_files($mimes) 
{
    $mimes = array_merge($mimes, array('xml' => 'application/xml'), array('json' => 'application/json'), array('zip' => 'application/zip'), array('gz' => 'application/x-gzip'), array('ico' => 'image/x-icon'));
    return $mimes;
}
function theme_image_sizes($sizes)
{
	global $themename;
	$addsizes = array(
		"blog-post-thumb" => __("Blog post thumbnail", 'medicenter'),
		$themename . "-gallery-image" => __("Gallery image", 'medicenter'),
		$themename . "-gallery-thumb" => __("Gallery thumbnail", 'medicenter'),
		$themename . "-small-thumb" => __("Small thumbnail", 'medicenter')
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}
if(!function_exists('_wp_render_title_tag')) 
{
    function cs_theme_slug_render_title() 
	{
		echo '<title>'. wp_title('-', true, 'right') . '</title>';
    }
}
function cs_wp_title_filter($title, $sep)
{
	//$title = get_bloginfo('name') . " | " . (is_home() || is_front_page() ? get_bloginfo('description') : $title);
	return $title;
}
//excerpt
function theme_excerpt_more($more) 
{
	return '';
}
function medicenter_filter_update_vc_plugin($date) 
{
    if(!empty($date->checked["js_composer/js_composer.php"]))
        unset($date->checked["js_composer/js_composer.php"]);
    if(!empty($date->response["js_composer/js_composer.php"]))
        unset($date->response["js_composer/js_composer.php"]);
    return $date;
}

/* --- Theme WooCommerce Custom Filters Functions --- */
function mc_woo_custom_override_pagination_args($args) 
{
	$args['prev_text'] = __('&lsaquo;', 'medicenter');
	$args['next_text'] = __('&rsaquo;', 'medicenter');
	return $args;
}
function mc_woo_custom_cart_button_text() 
{
	return __('Add to cart', 'woocommerce');
}
if(!function_exists('loop_columns')) 
{
	function mc_woo_custom_loop_columns() 
	{
		return 3; // 3 products per row
	}
}
function mc_woo_custom_product_description_heading() 
{
    return '';
}
function mc_woo_custom_show_page_title()
{
	return false;
}
function mc_woo_custom_override_checkout_fields($fields) 
{
	$fields['billing']['billing_first_name']['placeholder'] = 'First Name';
	$fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
	$fields['billing']['billing_company']['placeholder'] = 'Company Name';
	$fields['billing']['billing_email']['placeholder'] = 'Email Address';
	$fields['billing']['billing_phone']['placeholder'] = 'Phone';
	return $fields;
}
function mc_woo_custom_review_gravatar_size()
{
	return 100;
}

function get_time_iso8601() 
{
	$offset = get_option('gmt_offset');
	$timezone = ($offset < 0 ? '-' : '+') . (abs($offset)<10 ? '0'.abs($offset) : abs($offset)) . '00' ;
	return get_the_time('Y-m-d\TH:i:s') . $timezone;					
}

function theme_direction() 
{
	global $wp_locale, $theme_options;
	if(isset($theme_options['direction']) || (isset($_COOKIE["mc_direction"]) && ($_COOKIE["mc_direction"]=="LTR" || $_COOKIE["mc_direction"]=="RTL")))
	{
		if($theme_options['direction']=='default' && empty($_COOKIE["mc_direction"]))
			return;
		$wp_locale->text_direction = ((!empty($theme_options['direction']) && $theme_options['direction']=='rtl') && (empty($_COOKIE["mc_direction"]) || $_COOKIE["mc_direction"]!="LTR")) || (!empty($_COOKIE["mc_direction"]) && $_COOKIE["mc_direction"]=="RTL") ? 'rtl' : 'ltr';
	}
}
add_action("after_setup_theme", "theme_direction");

// default locate_template() method returns file PATH, we need file URL for javascript and css
//function locate_template_uri($file)
//{
//    $website_path = str_replace("\\", "/", realpath(dirname($_SERVER["SCRIPT_FILENAME"])));
//    $site_url = site_url();
//    $file_path = str_replace("\\", "/", locate_template(ltrim($file, "/")));
//    $file_url = str_replace($website_path, $site_url, $file_path);
//    return $file_url;
//}
function mc_get_theme_file($file)
{
	if(file_exists(get_stylesheet_directory() . $file))
        require_once(get_stylesheet_directory() . $file);
    else
        require_once(get_template_directory() . $file);
}

//medicenter get_font_subsets
function mc_ajax_get_font_subsets()
{
	if($_POST["font"]!="")
	{
		$subsets = '';
		$fontExplode = explode(":", $_POST["font"]);
		$subsets_array = mc_get_google_font_subset($fontExplode[0]);
		
		foreach($subsets_array as $subset)
			$subsets .= '<option value="' . $subset . '">' . $subset . '</option>';
		
		echo "mc_start" . $subsets . "mc_end";
	}
	exit();
}
add_action('wp_ajax_medicenter_get_font_subsets', 'mc_ajax_get_font_subsets');

/**
 * Returns array of Google Fonts
 * @return array of Google Fonts
 */
function mc_get_google_fonts()
{
	//get google fonts
	$fontsArray = get_option("medicenter_google_fonts");
	//update if option doesn't exist or it was modified more than 2 weeks ago
	if($fontsArray===FALSE || (time()-$fontsArray->last_update>2*7*24*60*60))
	{
		$google_api_url = 'http://quanticalabs.com/.tools/GoogleFont/font.txt';
		$fontsJson = wp_remote_retrieve_body(wp_remote_get($google_api_url, array('sslverify' => false )));
		$fontsArray = json_decode($fontsJson);
		$fontsArray->last_update = time();		
		update_option("medicenter_google_fonts", $fontsArray);
	}
	return $fontsArray;
}

/**
 * Returns array of subsets for provided Google Font
 * @param type $font - Google font
 * @return array of subsets for provided Google Font
 */
function mc_get_google_font_subset($font)
{
	$subsets = array();
	//get google fonts
	$fontsArray = mc_get_google_fonts();		
	$fontsCount = count($fontsArray->items);
	for($i=0; $i<$fontsCount; $i++)
	{
		if($fontsArray->items[$i]->family==$font)
		{
			for($j=0, $max=count($fontsArray->items[$i]->subsets); $j<$max; $j++)
			{
				$subsets[] = $fontsArray->items[$i]->subsets[$j];
			}
			break;
		}
	}
	return $subsets;
}
?>