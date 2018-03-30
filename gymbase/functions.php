<?php
$themename = "gymbase";

//plugins activator
require_once("plugins_activator.php");

if(function_exists("vc_remove_element"))
{
	vc_remove_element("vc_gmaps");
	vc_remove_element("vc_tour");
}

//theme options
gb_get_theme_file("/theme-options.php");

//menu walker
gb_get_theme_file("/mobile-menu-walker.php");

//custom meta box
gb_get_theme_file("/meta-box.php");

//dropdown menu
gb_get_theme_file("/nav-menu-dropdown-walker.php");

//weekdays
gb_get_theme_file("/post-type-weekdays.php");

if(function_exists("vc_map"))
{
	//classes
	gb_get_theme_file("/post-type-classes.php");
	//trainers
	gb_get_theme_file("/post-type-trainers.php");
	//gallery
	gb_get_theme_file("/post-type-gallery.php");
	//contact_form
	gb_get_theme_file("/contact_form.php");
}

//comments
gb_get_theme_file("/comments-functions.php");

//widgets
gb_get_theme_file("/widgets/widget-cart-icon.php");
gb_get_theme_file("/widgets/widget-upcoming-classes.php");
gb_get_theme_file("/widgets/widget-home-box.php");
gb_get_theme_file("/widgets/widget-classes.php");
gb_get_theme_file("/widgets/widget-twitter.php");
gb_get_theme_file("/widgets/widget-footer-box.php");
gb_get_theme_file("/widgets/widget-contact-details.php");
gb_get_theme_file("/widgets/widget-scrolling-recent-posts.php");
gb_get_theme_file("/widgets/widget-scrolling-most-commented.php");
gb_get_theme_file("/widgets/widget-scrolling-most-viewed.php");
gb_get_theme_file("/widgets/widget-social-icons.php");

//shortcodes
if(function_exists("vc_map"))
	gb_get_theme_file("/shortcodes/shortcodes.php");

//admin functions
gb_get_theme_file("/admin/functions.php");

function theme_after_setup_theme()
{
	global $themename;
	if(!get_option($themename . "_installed") || !get_option("wpb_js_content_types"))
	{		
		$theme_options = array(
			"favicon_url" => "",
			"logo_url" => get_template_directory_uri() . "/images/header_logo.png",
			"logo_first_part_text" => "GYM",
			"logo_second_part_text" => "BASE",
			"footer_text_left" => "© Copyright - GymBase Template by <a href='http://quanticalabs.com' title='QuanticaLabs' target='_blank'>QuanticaLabs</a>",
			"footer_text_right" => "[scroll_top]",
			"home_page_top_hint" => "Give us a call: +123 356 123 124",
			"responsive" => 1,
			"slider_image_url" => array(
				get_template_directory_uri() . "/images/slider/img1.jpg",
				get_template_directory_uri() . "/images/slider/img2.jpg",
				get_template_directory_uri() . "/images/slider/img3.jpg"
			),
			"slider_image_title" => array(
				"INDOOR CYCLING",
				"GYM FITNESS",
				"CARDIO FITNESS"
			),
			"slider_image_subtitle" => array(
				"strength, stamina, power",
				"strength, speed, stamina",
				"cardiovascular fitness"
			),
			"slider_image_link" => array(
				"classes#indoor-cycling",
				"classes#gym-fitness",
				"classes#cardio-fitness"
			),
			"slider_autoplay" => "true",
			"slide_interval" => 5000,
			"slider_effect" => "slide",
			"slider_transition" => "swing",
			"slider_transition_speed" => 500,
			"show_share_box" => "true",
			"social_icon_type" => array(
				"facebook",
				"twitter",
				"google",
			),
			"social_icon_url" => array(
				"https://www.facebook.com/sharer/sharer.php?u={URL}",
				"https://twitter.com/home?status={URL}",
				"https://plus.google.com/share?url={URL}",
			),
			"social_icon_target"=> array(
				"new_window",
				"new_window",
				"new_window",
			),
			"header_font" => "",
			"header_font_subset" => "",
			"subheader_font" => "",
			"subheader_font_subset" => "",
			"google_api_code" => "",
			"collapsible_mobile_submenus" => 1,
			"ga_tracking_code" => "",
			"header_background_color" => "",
			"body_background_color" => "",
			"footer_background_color" => "",
			"slider_title_color" => "",
			"slider_subtitle_color" => "",
			"slider_text_border_color" => "",
			"body_headers_color" => "",
			"body_headers_border_color" => "",
			"body_text_color" => "",
			"body_text2_color" => "",
			"footer_headers_color" => "",
			"footer_headers_border_color" => "",
			"footer_text_color" => "",
			"timeago_label_color" => "",
			"sentence_color" => "",
			"logo_first_part_text_color" => "",
			"logo_second_part_text_color" => "",
			"body_button_color" => "",
			"body_button_hover_color" => "",
			"body_button_border_hover_color" => "",
			"body_button_border_color" => "",
			"footer_button_color" => "",
			"footer_button_hover_color" => "",
			"footer_button_border_hover_color" => "",
			"footer_button_border_color" => "",
			"menu_link_color" => "",
			"menu_link_border_color" => "",
			"menu_active_color" => "",
			"menu_active_border_color" => "",
			"menu_hover_color" => "",
			"menu_hover_border_color" => "",
			"submenu_background_color" => "",
			"submenu_hover_background_color" => "",
			"submenu_color" => "",
			"submenu_hover_color" => "",
			"mobile_menu_link_color" => "",
			"mobile_menu_position_background_color" => "",
			"mobile_menu_active_link_color" => "",
			"mobile_menu_active_position_background_color" => "",
			"form_hint_color" => "",
			"form_field_text_color" => "",
			"form_field_border_color" => "",
			"form_field_active_border_color" => "",
			"link_color" => "",
			"link_hover_color" => "",
			"date_box_color" => "",
			"date_box_text_color" => "",
			"date_box_comments_number_text_color" => "",
			"date_box_comments_number_border_color" => "",
			"date_box_comments_number_hover_border_color" => "",
			"gallery_box_color" => "",
			"gallery_box_text_first_line_color" => "",
			"gallery_box_text_second_line_color" => "",
			"gallery_box_hover_color" => "",
			"gallery_box_hover_text_first_line_color" => "",
			"gallery_box_hover_text_second_line_color" => "",
			"timetable_box_color" => "",
			"timetable_box_hover_color" => "",
			"gallery_details_box_border_color" => "",
			"bread_crumb_border_color" => "",
			"accordion_item_border_color" => "",
			"accordion_item_border_hover_color" => "",
			"accordion_item_border_active_color" => "",
			"copyright_area_border_color" => "",
			"top_hint_background_color" => "",
			"top_hint_text_color" => "",
			"comment_reply_button_color" => "",
			"post_author_link_color" => "",
			"contact_details_box_background_color" => "",
			"cf_admin_name" => get_option("admin_email"),
			"cf_admin_email" => get_option("admin_email"),
			"cf_smtp_host" => "",
			"cf_smtp_username" => "",
			"cf_smtp_password" => "",
			"cf_smtp_port" => "",
			"cf_smtp_secure" => "",
			"cf_email_subject" => "GymBase WP: Contact from WWW",
			"cf_template" => "<html>
	<head>
	</head>
	<body>
		<div><b>First and last name</b>: [name]</div>
		<div><b>E-mail</b>: [email]</div>
		<div><b>Website</b>: [website]</div>
		<div><b>Message</b>: [message]</div>
	</body>
</html>",
			"contact_logo_first_part_text" => "GYM",
			"contact_logo_second_part_text" => "BASE",
			"contact_phone" => "+123 655 655",
			"contact_fax" => "+123 755 755",
			"contact_email" => "gymbase@mail.com"
		);
		add_option($themename . "_options", $theme_options);
		
		add_option("wpb_js_content_types", array(
			"page",
			"classes",
			"trainers",
			"gymbase_gallery",)
		);
		
		update_option("blogdescription", "Responsive WordPress Gym Fitness Theme");
		
		add_option($themename . "_installed", 1);
	}
	//Make theme available for translation
	//Translations can be filed in the /languages/ directory
	load_theme_textdomain('gymbase', get_template_directory() . '/languages');
	
	//register blog post thumbnail & portfolio thumbnail
	add_theme_support("post-thumbnails");
	add_image_size("blog-post-thumb", 500, 220, true);
	add_image_size($themename . "-gallery-image", 480, 360, true);
	add_image_size($themename . "-gallery-thumb", 240, 180, true);
	add_image_size($themename . "-small-thumb", 80, 80, true);
	
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
	add_filter('upload_mimes', 'custom_upload_files');
	add_filter('site_transient_update_plugins', 'gymbase_filter_update_vc_plugin', 10, 2);
	add_filter("image_size_names_choose", "theme_image_sizes");
	add_filter('excerpt_more', 'theme_excerpt_more', 99);
	//using shortcodes in sidebar
	add_filter("widget_text", "do_shortcode");
		
	//custom theme woocommerce filters
	add_filter('woocommerce_pagination_args' , 'gb_woo_custom_override_pagination_args');
	add_filter('woocommerce_product_single_add_to_cart_text', 'gb_woo_custom_cart_button_text');
	add_filter('woocommerce_product_add_to_cart_text', 'gb_woo_custom_cart_button_text');
	add_filter('loop_shop_columns', 'gb_woo_custom_loop_columns');
	add_filter('woocommerce_product_description_heading', 'gb_woo_custom_product_description_heading');
	add_filter('woocommerce_checkout_fields' , 'gb_woo_custom_override_checkout_fields');
	add_filter('woocommerce_show_page_title', 'gb_woo_custom_show_page_title');
	add_filter('loop_shop_per_page', create_function( '$cols', 'return 6;' ), 20);
	add_filter('woocommerce_review_gravatar_size', 'gb_woo_custom_review_gravatar_size');
	
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
		register_sidebar(array(
			"id" => "home-top",
			"name" => "Sidebar Home Top",
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
		));
		register_sidebar(array(
			"id" => "home-right",
			"name" => "Sidebar Home Right",
			'before_widget' => '<div id="%1$s" class="widget %2$s sidebar_box">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="box_header">',
			'after_title' => '</h3>'
		));
		register_sidebar(array(
			"id" => "header-top",
			"name" => "Sidebar Header Top",
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => ''
		));
		register_sidebar(array(
			"id" => "header-top-right",
			"name" => "Sidebar Header Top Right",
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => ''
		));
		register_sidebar(array(
			"id" => "header",
			"name" => "Sidebar Header",
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '',
			'after_title' => ''
		));
		register_sidebar(array(
			"id" => "right",
			"name" => "Sidebar Right",
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
		));
		register_sidebar(array(
			"id" => "blog",
			"name" => "Sidebar Blog",
			'before_widget' => '<div id="%1$s" class="widget %2$s sidebar_box">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="box_header">',
			'after_title' => '</h3>'
		));
		register_sidebar(array(
			"id" => "footer-top",
			"name" => "Sidebar Footer Top",
			'before_widget' => '',
			'after_widget' => '',
			'before_title' => '<h2>',
			'after_title' => '</h2>'
		));
		register_sidebar(array(
			"id" => "footer-bottom",
			"name" => "Sidebar Footer Bottom",
			'before_widget' => '<div id="%1$s" class="widget %2$s footer_box">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="box_header">',
			'after_title' => '</h3>'
		));
		register_sidebar(array(
			"id" => "sidebar-shop",
			"name" => "Sidebar Shop",
			'before_widget' => '<div id="%1$s" class="widget %2$s sidebar_box">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="box_header">',
			'after_title' => '</h3>'
		));
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
	"logo_first_part_text" => '',
	"logo_second_part_text" => '',
	"footer_text_left" => '',
	"footer_text_right" => '',
	"home_page_top_hint" => '',
	"responsive" => '',
	"google_api_code" => '',
	"collapsible_mobile_submenus" => '',
	"ga_tracking_code" => '',
	"slider_image_url" => '',
	"slider_image_title" => '',
	"slider_image_subtitle" => '',
	"slider_image_link" => '',
	"slider_autoplay" => '',
	"slide_interval" => '',
	"slider_effect" => '',
	"slider_transition" => '',
	"slider_transition_speed" => '',
	"show_share_box" => '',
	"social_icon_type" => '',
	"social_icon_url" => '',
	"social_icon_target" => '',
	"footer_text_left" => '',
	"footer_text_right" => '',
	"cf_admin_name" => '',
	"cf_admin_email" => '',
	"cf_smtp_host" => '',
	"cf_smtp_username" => '',
	"cf_smtp_password" => '',
	"cf_smtp_port" => '',
	"cf_smtp_secure" => '',
	"cf_email_subject" => '',
	"cf_template" => '',
	"contact_logo_first_part_text" => '',
	"contact_logo_second_part_text" => '',
	"contact_phone" => '',
	"contact_fax" => '',
	"contact_email" => '',
	"header_background_color" => '',
	"body_background_color" => '',
	"footer_background_color" => '',
	"link_color" => '',
	"link_hover_color" => '',
	"slider_title_color" => '',
	"slider_subtitle_color" => '',
	"slider_text_border_color" => '',
	"body_headers_color" => '',
	"body_headers_border_color" => '',
	"body_text_color" => '',
	"body_text2_color" => '',
	"footer_headers_color" => '',
	"footer_headers_border_color" => '',
	"footer_text_color" => '',
	"timeago_label_color" => '',
	"sentence_color" => '',
	"logo_first_part_text_color" => '',
	"logo_second_part_text_color" => '',
	"body_button_color" => '',
	"body_button_hover_color" => '',
	"body_button_border_color" => '',
	"body_button_border_hover_color" => '',
	"footer_button_color" => '',
	"footer_button_hover_color" => '',
	"footer_button_border_color" => '',
	"footer_button_border_hover_color" => '',
	"menu_link_color" => '',
	"menu_link_border_color" => '',
	"menu_active_color" => '',
	"menu_active_border_color" => '',
	"menu_hover_color" => '',
	"menu_hover_border_color" => '',
	"submenu_background_color" => '',
	"submenu_hover_background_color" => '',
	"submenu_color" => '',
	"submenu_hover_color" => '',
	"mobile_menu_link_color" => '',
	"mobile_menu_position_background_color" => '',
	"mobile_menu_active_link_color" => '',
	"mobile_menu_active_position_background_color" => '',
	"form_hint_color" => '',
	"form_field_text_color" => '',
	"form_field_border_color" => '',
	"form_field_active_border_color" => '',
	"date_box_color" => '',
	"date_box_text_color" => '',
	"date_box_comments_number_text_color" => '',
	"date_box_comments_number_border_color" => '',
	"date_box_comments_number_hover_border_color" => '',
	"gallery_box_color" => '',
	"gallery_box_text_first_line_color" => '',
	"gallery_box_text_second_line_color" => '',
	"gallery_box_hover_color" => '',
	"gallery_box_hover_text_first_line_color" => '',
	"gallery_box_hover_text_second_line_color" => '',
	"timetable_box_color" => '',
	"timetable_box_hover_color" => '',
	"gallery_details_box_border_color" => '',
	"bread_crumb_border_color" => '',
	"accordion_item_border_color" => '',
	"accordion_item_border_hover_color" => '',
	"accordion_item_border_active_color" => '',
	"copyright_area_border_color" => '',
	"top_hint_background_color" => '',
	"top_hint_text_color" => '',
	"comment_reply_button_color" => '',
	"post_author_link_color" => '',
	"contact_details_box_background_color" => '',
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
		wp_enqueue_style("google-font-droid-sans", "//fonts.googleapis.com/css?family=Droid+Sans");
	if(!empty($theme_options["subheader_font"]))
		wp_enqueue_style("google-font-subheader", "//fonts.googleapis.com/css?family=" . urlencode($theme_options["subheader_font"]) . (!empty($theme_options["subheader_font_subset"]) ? "&subset=" . implode(",", $theme_options["subheader_font_subset"]) : ""));
	else
		wp_enqueue_style("google-font-droid-serif", "//fonts.googleapis.com/css?family=Droid+Serif:400italic");
	wp_enqueue_style("reset", get_template_directory_uri() . "/style/reset.css");
	wp_enqueue_style("superfish", get_template_directory_uri() . "/style/superfish.css");
	wp_enqueue_style("jquery-fancybox", get_template_directory_uri() . "/style/fancybox/jquery.fancybox.css");
	wp_enqueue_style("jquery-qtip", get_template_directory_uri() . "/style/jquery.qtip.css");
	wp_enqueue_style("main", get_stylesheet_uri());
	if((int)$theme_options["responsive"])
		wp_enqueue_style("responsive", get_template_directory_uri() . "/style/responsive.css");
	else
		wp_enqueue_style("no-responsive", get_template_directory_uri() . "/style/no_responsive.css");
	
	include_once(ABSPATH . 'wp-admin/includes/plugin.php');
	if(is_plugin_active('woocommerce/woocommerce.php'))
	{
		wp_enqueue_style("woocommerce-custom", get_template_directory_uri() ."/woocommerce/style.css");
		if((int)$theme_options["responsive"])
			wp_enqueue_style("woocommerce-responsive", get_template_directory_uri() ."/woocommerce/responsive.css");
		else
			wp_dequeue_style("woocommerce-smallscreen");		
	}
	
	wp_enqueue_style("custom", get_template_directory_uri() . "/custom.css");
	
	//js
	wp_enqueue_script("jquery");
	wp_enqueue_script("jquery-ui-core", array("jquery"));
	wp_enqueue_script("jquery-ui-accordion", array("jquery"));
	wp_enqueue_script("jquery-ui-tabs", array("jquery"));
	wp_enqueue_script("jquery-ba-bqq", get_template_directory_uri() . "/js/jquery.ba-bbq.min.js", array("jquery"));
	wp_enqueue_script("jquery-easing", get_template_directory_uri() . "/js/jquery.easing.1.3.js", array("jquery"));
	wp_enqueue_script("jquery-carouFredSel", get_template_directory_uri() . "/js/jquery.carouFredSel-6.2.1-packed.js", array("jquery"));
	wp_enqueue_script("jquery-timeago", get_template_directory_uri() . "/js/jquery.timeago.js", array("jquery"));
	wp_enqueue_script("jquery-hint", get_template_directory_uri() . "/js/jquery.hint.js", array("jquery"));
	wp_enqueue_script("jquery-isotope", get_template_directory_uri() . "/js/jquery.isotope.min.js", array("jquery"));
	wp_enqueue_script("jquery-fancybox", get_template_directory_uri() . "/js/jquery.fancybox-1.3.4.pack.js", array("jquery"));
	wp_enqueue_script("jquery-qtip", get_template_directory_uri() . "/js/jquery.qtip.min.js", array("jquery"));
	wp_enqueue_script("jquery-block-ui", get_template_directory_uri() . "/js/jquery.blockUI.js", array("jquery"));
	wp_enqueue_script("google-maps-v3", "//maps.google.com/maps/api/js" . ($theme_options["google_api_code"]!="" ? "?key=" . esc_attr($theme_options["google_api_code"]) : ""), false, array(), false, true);
	wp_enqueue_script("theme-main", get_template_directory_uri() . "/js/main.js", array("jquery", "jquery-ui-core", "jquery-ui-accordion", "jquery-ui-tabs"));
	
	//ajaxurl
	$data["ajaxurl"] = admin_url("admin-ajax.php");
	//themename
	$data["themename"] = $themename;
	//slider
	$data["slider_autoplay"] = $theme_options["slider_autoplay"];
	$data["slide_interval"] = $theme_options["slide_interval"];
	$data["slider_effect"] = $theme_options["slider_effect"];
	$data["slider_transition"] = $theme_options["slider_transition"];
	$data["slider_transition_speed"] = $theme_options["slider_transition_speed"];
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
//add new mimes for upload dummy content files (code can be removed after dummy content import)
function custom_upload_files($mimes) 
{
	$mimes = array_merge($mimes, array('xml' => 'application/xml'), array('json' => 'application/json'), array('zip' => 'application/zip'), array('gz' => 'application/x-gzip'), array('ico' => 'image/x-icon'));
    return $mimes;
}
function gymbase_filter_update_vc_plugin($date) 
{
    if(!empty($date->checked["js_composer/js_composer.php"]))
        unset($date->checked["js_composer/js_composer.php"]);
    if(!empty($date->response["js_composer/js_composer.php"]))
        unset($date->response["js_composer/js_composer.php"]);
    return $date;
}
function theme_image_sizes($sizes)
{
	global $themename;
	$addsizes = array(
		"blog-post-thumb" => __("Blog post thumbnail", 'gymbase'),
		$themename . "-gallery-image" => __("Gallery image", 'gymbase'),
		$themename . "-gallery-thumb" => __("Gallery thumbnail", 'gymbase'),
		$themename . "-small-thumb" => __("Small thumbnail", 'gymbase')
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}
//excerpt
function theme_excerpt_more($more) 
{
	return '';
}

/* --- Theme WooCommerce Custom Filters Functions --- */
function gb_woo_custom_override_pagination_args($args) 
{
	$args['prev_text'] = __('&lsaquo;', 'gymbase');
	$args['next_text'] = __('&rsaquo;', 'gymbase');
	return $args;
}

function gb_woo_custom_cart_button_text() 
{
	return __('Add to cart', 'woocommerce');
}

if(!function_exists('loop_columns')) 
{
	function gb_woo_custom_loop_columns() 
	{
		return 3; // 3 products per row
	}
}

function gb_woo_custom_product_description_heading() 
{
    return '';
}

function gb_woo_custom_show_page_title()
{
	return false;
}

function gb_woo_custom_override_checkout_fields($fields) 
{
	$fields['billing']['billing_first_name']['placeholder'] = 'First Name';
	$fields['billing']['billing_last_name']['placeholder'] = 'Last Name';
	$fields['billing']['billing_company']['placeholder'] = 'Company Name';
	$fields['billing']['billing_email']['placeholder'] = 'Email Address';
	$fields['billing']['billing_phone']['placeholder'] = 'Phone';
	return $fields;
}

function gb_woo_custom_review_gravatar_size()
{
	return 100;
}

// default locate_template() method returns file PATH, we need file URL for javascript and css
//function locate_template_uri($file)
//{
//	$website_path = str_replace("\\", "/", realpath(ABSPATH));
//	$site_url = site_url();
//	$file_path = str_replace("\\", "/", locate_template(ltrim($file, "/")));
//	$file_url = str_replace($website_path, $site_url, $file_path);
//	return $file_url;
//}
function gb_get_theme_file($file)
{
	if(file_exists(get_stylesheet_directory() . $file))
        require_once(get_stylesheet_directory() . $file);
    else
        require_once(get_template_directory() . $file);
}

//gymbase get_font_subsets
function gb_ajax_get_font_subsets()
{
	if($_POST["font"]!="")
	{
		$subsets = '';
		$fontExplode = explode(":", $_POST["font"]);
		$subsets_array = gb_get_google_font_subset($fontExplode[0]);
		
		foreach($subsets_array as $subset)
			$subsets .= '<option value="' . $subset . '">' . $subset . '</option>';
		
		echo "gb_start" . $subsets . "gb_end";
	}
	exit();
}
add_action('wp_ajax_gymbase_get_font_subsets', 'gb_ajax_get_font_subsets');

/**
 * Returns array of Google Fonts
 * @return array of Google Fonts
 */
function gb_get_google_fonts()
{
	//get google fonts
	$fontsArray = get_option("gymbase_google_fonts");
	//update if option doesn't exist or it was modified more than 2 weeks ago
	if($fontsArray===FALSE || (time()-$fontsArray->last_update>2*7*24*60*60))
	{
		$google_api_url = 'http://quanticalabs.com/.tools/GoogleFont/font.txt';
		$fontsJson = wp_remote_retrieve_body(wp_remote_get($google_api_url, array('sslverify' => false )));
		$fontsArray = json_decode($fontsJson);
		$fontsArray->last_update = time();		
		update_option("gymbase_google_fonts", $fontsArray);
	}
	return $fontsArray;
}

/**
 * Returns array of subsets for provided Google Font
 * @param type $font - Google font
 * @return array of subsets for provided Google Font
 */
function gb_get_google_font_subset($font)
{
	$subsets = array();
	//get google fonts
	$fontsArray = gb_get_google_fonts();		
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