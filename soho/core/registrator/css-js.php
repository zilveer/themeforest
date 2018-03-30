<?php

#Frontend
if (!function_exists('css_js_register')) {
    function css_js_register()
    {
        $wp_upload_dir = wp_upload_dir();

        #CSS
        wp_enqueue_style('gt3_default_style', get_bloginfo('stylesheet_url'));
        wp_enqueue_style("gt3_theme", get_template_directory_uri() . '/css/theme.css');
        wp_enqueue_style("gt3_responsive", get_template_directory_uri() . '/css/responsive.css');
        if (gt3_get_theme_option("default_skin") == 'skin_light') {
            wp_enqueue_style('gt3_skin', get_template_directory_uri() . '/css/light.css');
        }
        wp_enqueue_style("gt3_custom", $wp_upload_dir['baseurl'] . "/" . "custom.css");

        #JS
        wp_enqueue_script("jquery");
		wp_enqueue_script('gt3_mousewheel_js', get_template_directory_uri() . '/js/jquery.mousewheel.js', array(), false, true);
        wp_enqueue_script('gt3_theme_js', get_template_directory_uri() . '/js/theme.js', array(), false, true);
    }
}
add_action('wp_enqueue_scripts', 'css_js_register');

/*#Additional files for plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('nextgen-gallery/nggallery.php')) {
    if (!function_exists('nextgen_files')) {
        function nextgen_files()
        {
            wp_enqueue_style("gt3_nextgen", get_template_directory_uri() . '/css/nextgen.css');
            wp_enqueue_script('gt3_nextgen_js', get_template_directory_uri() . '/js/nextgen.js', array(), false, true);
        }
    }
    add_action('wp_enqueue_scripts', 'nextgen_files');
}*/

#Additional files for plugin
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if (is_plugin_active('woocommerce/woocommerce.php')) {
    if (!function_exists('woo_files')) {
        function woo_files()
        {
			$wp_upload_dir = wp_upload_dir();
			
            wp_enqueue_style('css_woo', get_template_directory_uri() . '/css/woo.css');
            wp_enqueue_script('js_woo', get_template_directory_uri() . '/js/woo.js', array(), false, true);
        }
    }
    add_action('wp_print_styles', 'woo_files');
}

#Admin
add_action('admin_enqueue_scripts', 'admin_css_js_register');
function admin_css_js_register()
{
    #CSS (MAIN)
    wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/core/admin/css/jquery-ui.css');
    wp_enqueue_style('colorpicker_css', get_template_directory_uri() . '/core/admin/css/colorpicker.css');
    wp_enqueue_style('gallery_css', get_template_directory_uri() . '/core/admin/css/gallery.css');
    wp_enqueue_style('colorbox_css', get_template_directory_uri() . '/core/admin/css/colorbox.css');
    wp_enqueue_style('selectBox_css', get_template_directory_uri() . '/core/admin/css/jquery.selectBox.css');
    wp_enqueue_style('admin_css', get_template_directory_uri() . '/core/admin/css/admin.css');
    #CSS OTHER

    #JS (MAIN)
    wp_enqueue_script('admin_js', get_template_directory_uri() . '/core/admin/js/admin.js');
    wp_enqueue_script('ajaxupload_js', get_template_directory_uri() . '/core/admin/js/ajaxupload.js');
    wp_enqueue_script('colorpicker_js', get_template_directory_uri() . '/core/admin/js/colorpicker.js');
    wp_enqueue_script('selectBox_js', get_template_directory_uri() . '/core/admin/js/jquery.selectBox.js');
    wp_enqueue_script('backgroundPosition_js', get_template_directory_uri() . '/core/admin/js/jquery.backgroundPosition.js');
    wp_enqueue_script(array("jquery-ui-core", "jquery-ui-dialog", "jquery-ui-sortable"));
    wp_enqueue_media();
}

#Data for creating static css/js files.
$text_headers_font = gt3_get_theme_option("text_headers_font");

$main_menu_size = gt3_get_theme_option("menu_font_size");
$main_menu_height = substr(gt3_get_theme_option("menu_font_size"), 0, -2);
$main_menu_height = (int)$main_menu_height + 2;
$main_menu_height = $main_menu_height . "px";

$submenu_font_size = gt3_get_theme_option("submenu_font_size");
$submenu_font_height = substr(gt3_get_theme_option("submenu_font_size"), 0, -2);
$submenu_font_height = (int)$submenu_font_height + 2;
$submenu_font_height = $submenu_font_height . "px";

$h1_font_size = gt3_get_theme_option("h1_font_size");
$h1_line_height = substr(gt3_get_theme_option("h1_font_size"), 0, -2);
$h1_line_height = (int)$h1_line_height + 2;
$h1_line_height = $h1_line_height . "px";

$h2_font_size = gt3_get_theme_option("h2_font_size");
$h2_line_height = substr(gt3_get_theme_option("h2_font_size"), 0, -2);
$h2_line_height = (int)$h2_line_height + 2;
$h2_line_height = $h2_line_height . "px";

$h3_font_size = gt3_get_theme_option("h3_font_size");
$h3_line_height = substr(gt3_get_theme_option("h3_font_size"), 0, -2);
$h3_line_height = (int)$h3_line_height + 2;
$h3_line_height = $h3_line_height . "px";

$h4_font_size = gt3_get_theme_option("h4_font_size");
$h4_line_height = substr(gt3_get_theme_option("h4_font_size"), 0, -2);
$h4_line_height = (int)$h4_line_height + 2;
$h4_line_height = $h4_line_height . "px";

$h5_font_size = gt3_get_theme_option("h5_font_size");
$h5_line_height = substr(gt3_get_theme_option("h5_font_size"), 0, -2);
$h5_line_height = (int)$h5_line_height + 2;
$h5_line_height = $h5_line_height . "px";

$h6_font_size = gt3_get_theme_option("h6_font_size");
$h6_line_height = substr(gt3_get_theme_option("h6_font_size"), 0, -2);
$h6_line_height = (int)$h6_line_height + 2;
$h6_line_height = $h6_line_height . "px";

$content_color = gt3_get_theme_option("content_color");
$heading_color = gt3_get_theme_option("heading_color");
$body_bg = gt3_get_theme_option("body_bg");

$logo_bg = gt3_get_theme_option("logo_bg");
$header_bg = gt3_get_theme_option("header_bg");
$menu_color = gt3_get_theme_option("menu_color");
$active_menu_color = gt3_get_theme_option("active_menu_color");
$submenu1_bg = gt3_get_theme_option("submenu1_bg");
$submenu2_bg = gt3_get_theme_option("submenu2_bg");
$submenu1_color = gt3_get_theme_option("submenu1_color");
$submenu2_color = gt3_get_theme_option("submenu2_color");
$submenu_border = gt3_get_theme_option("submenu_border");
$submenu2_border = gt3_get_theme_option("submenu2_border");
$sidebar_border = gt3_get_theme_option("sidebar_border");
$footer_bg = gt3_get_theme_option("footer_bg");
$footer_color = gt3_get_theme_option("footer_color");

$hover_menu_color = gt3_get_theme_option("hover_menu_color");
$submenu_act_color = gt3_get_theme_option("submenu_act_color");

//background:rgba(' . gt3_HexToRGB(gt3_get_theme_option("theme_color1")) . ',0);

$gt3_custom_css = new cssJsGenerator(
    $filename = "custom.css",
    $filetype = "css",
    $output = '
	/* SKIN COLORS */
	body,
	.preloader {
		background:#' . $body_bg . ';
	}
	* {
		font-family:' . gt3_get_theme_option("main_font") . ';		
	}	
	p, td, div,
	input, textarea,
	.no_bg a,
	.widget_nav_menu ul li a,
	.widget_archive ul li a,
	.widget_pages ul li a,
	.widget_categories ul li a,
	.widget_recent_entries ul li a,
	.widget_meta ul li a,
	.widget_posts .post_title {
		color:#' . $content_color . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';	
	}
	.shortcode_iconbox p {
		color:#' . $content_color . '!important;
	}
	h1, h2, h3, h4, h5, h6,
	h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
	h1 small, h2 small, h3 small, h4 small, h5 small, h6 small,
	h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
	.shortcode_iconbox a:hover .iconbox_title,
	.pp_title {
		color:#'. $heading_color .';
	}
	.iconbox_title {
		color:#'. $heading_color .'!important;
	}
	.logo {
		background-color:#'. gt3_get_theme_option("logo_bg") .';
	}
	header.main_header {
		background-color:#'. gt3_get_theme_option("header_bg") .';
	}
	ul.mobile_menu a,
	ul.mobile_menu a span,
	.mobile_menu li.menu-item-has-children > a:after {
		color:#'. gt3_get_theme_option("menu_color") .';	
	}
	header.main_header ul.menu > li > a {
		color:#'. gt3_get_theme_option("menu_color") .';
		font-weight: '. gt3_get_theme_option("menu_weight").';
		font-size: '. $main_menu_size .'px;
		line-height: '. $main_menu_height.'px;
	}
	.main_header nav ul.menu > li.current-menu-ancestor > a,
	.main_header nav ul.menu > li.current-menu-item > a,
	.main_header nav ul.menu > li.current-menu-parent > a,
	ul.mobile_menu li.current-menu-ancestor > a,
	ul.mobile_menu li.current-menu-item > a,
	ul.mobile_menu li.current-menu-parent > a,
	ul.mobile_menu li.current-menu-ancestor > a span,
	ul.mobile_menu li.current-menu-item > a span,
	ul.mobile_menu li.current-menu-parent > a span,
	.mobile_menu li.current-menu-parent.menu-item-has-children > a:after,
	.mobile_menu li.current-menu-item.menu-item-has-children > a:after,
	.mobile_menu li.current-menu-ancestor.menu-item-has-children > a:after {
		color:#'. gt3_get_theme_option("active_menu_color") .';
	}
	.main_header nav ul.sub-menu,
	.main_header nav ul.sub-menu li ul.sub-menu li ul.sub-menu {
		background-color:#'. gt3_get_theme_option("submenu1_bg") .';
	}
	.main_header nav ul.sub-menu li ul.sub-menu {
		background-color:#'. gt3_get_theme_option("submenu2_bg") .';
	}
	.main_header nav ul.sub-menu li > a,
	.main_header nav ul.sub-menu li ul.sub-menu li ul.sub-menu li > a {
		color:#'. gt3_get_theme_option("submenu1_color") .';
		font-size: '.$submenu_font_size .'px;
		line-height: '.$submenu_font_height .'px;
		
	}
	.main_header nav ul.sub-menu li ul.sub-menu li > a {
		color:#'. gt3_get_theme_option("submenu2_color") .';
	}
	.main_header nav ul.sub-menu li > a:before,
	.main_header nav ul.sub-menu li ul.sub-menu li ul.sub-menu li > a:before {
		background-color:#'. gt3_get_theme_option("submenu_border") .';
	}
	.main_header nav ul.sub-menu li ul.sub-menu li > a:before {
		background-color:#'. gt3_get_theme_option("submenu2_border") .';
	}
	footer.main_footer {
		background-color:#'. gt3_get_theme_option("footer_bg") .';
	}
	.phone,
	.copyright,
	.back404 a,
	.back404 a:hover {
		color:#'. gt3_get_theme_option("footer_color") .';
	}
	.left-sidebar-block:before,
	.right-sidebar-block:before {
		background:#' . $sidebar_border . ';
	}	

	/*Fonts Families and Sizes*/
	p, td, div,
	input {
		font-family:' . gt3_get_theme_option("main_font") . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}
	.fs_descr {
		font-family:' . gt3_get_theme_option("main_font") . '!important;
	}
	a:hover {
		color:#' . $content_color . ';
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}

	.main_header nav ul.menu li a,
	.main_header nav ul.menu li span,
	ul.mobile_menu li a,
	ul.mobile_menu li span,
	.filter_toggler {
		font-family: ' . gt3_get_theme_option("main_menu_font") . ';
		font-size: ' . $main_menu_size . ';
		line-height: ' . $main_menu_height . ';
	}
	
	p, td, div,
	blockquote p,
	input,	
	input[type="text"],
	input[type="email"],
	input[type="password"],
	textarea {
		font-size:' . gt3_get_theme_option("main_content_font_size") . ';
		line-height:' . gt3_get_theme_option("main_content_line_height") . ';
	}
	.main_header nav ul.menu > li > a,
	ul.mobile_menu > li > a {
		font-size:'.$main_menu_size.';
		line-height: '.$main_menu_height.';
	}
	.main_header nav ul.menu > li > a:before,
	ul.mobile_menu > li > a:before {
		line-height: '.$main_menu_height.';
	}
	h1, h2, h3, h4, h5, h6,
	h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
	h1 small, h2 small, h3 small, h4 small, h5 small, h6 small,
	h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
		font-family: ' . $text_headers_font . ';
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;
		padding:0;
	}
	blockquote.shortcode_blockquote.type3:before,
	blockquote.shortcode_blockquote.type4:before,
	blockquote.shortcode_blockquote.type5:before,	
	.shortcode_tab_item_title,
	input[type="button"], 
	input[type="reset"], 
	input[type="submit"],
	.search404.search_form .search_button {
		font-family: ' . $text_headers_font . ';
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;
	}
	.dropcap,
	.easyPieChart,
	.easyPieChart span,
	.shortcode_button,
	.shortcode_button:hover,
	.load_more_works,
	.load_more_works:hover,
	.share_toggle,
	.share_toggle:hover,
	.countdown-amount,
	.countdown-period,
	.notify_shortcode input[type="submit"] {
		font-family: ' . $text_headers_font . ';
		font-weight:' . gt3_get_theme_option("headings_weight") . ';
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;
	}
	.sidebar_header {
		font-family:' . gt3_get_theme_option("main_content_font") . ';
	}	
	.box_date span,
	.countdown-row .countdown-section:before,
	.countdown-amount,
	.countdown-period {
		font-family: ' . $text_headers_font . ';
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;		
	}
	a.shortcode_button,
	.chart.easyPieChart,
	.chart.easyPieChart span,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.search404 .search_button {
		font-family: ' . $text_headers_font . ';		
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;		
	}
	h1, h2, h3, h4, h5, h6,
	h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
	h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
	h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover {
		font-weight:' . gt3_get_theme_option("headings_weight") . ';
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;		
	}
	input[type="button"], 
	input[type="reset"], 
	input[type="submit"],
	.search404 .search_button {
		font-weight:' . gt3_get_theme_option("headings_weight") . ';
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;		
	}
	
	input[type="button"],
	input[type="reset"],
	input[type="submit"] {
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased; 		
	}
	h1, h1 span, h1 a, h3.promo_title {
		font-size:' . $h1_font_size . ';
		line-height:' . $h1_line_height . ';
	}
	h2, h2 span, h2 a {
		font-size:' . $h2_font_size . ';
		line-height:' . $h2_line_height . ';
	}
	h3, h3 span, h3 a {
		font-size:' . $h3_font_size . ';
		line-height:' . $h3_line_height . ';
	}
	h4, h4 span, h4 a, 
	h3.comment-reply-title,
	h3.comment-reply-title a {
		font-size:' . $h4_font_size . ';
		line-height:' . $h4_line_height . ';
	}
	h5, h5 span, h5 a {
		font-size:' . $h5_font_size . ';
		line-height:' . $h5_line_height . ';
	}
	h6, h6 span, h6 a,
	.comment_info h6:after {
		font-size:' . $h6_font_size . ';
		line-height:' . $h6_line_height . ';
	}
	
    /* CSS HERE */
	::selection {background:#' . gt3_get_theme_option("theme_color1") . ';}
	::-moz-selection {background:#' . gt3_get_theme_option("theme_color1") . ';}

	.main_header nav ul.sub-menu li.current-menu-item > a,
	.main_header nav ul.sub-menu li.current-menu-parent > a,
	.main_header nav ul.sub-menu li.current-menu-ancestor > a,
	.main_header nav ul.sub-menu li.current_page_item > a  {
		color:#'. $submenu_act_color .'!important;
	}
	.main_header nav ul li:hover > a,
	.main_header nav ul.sub-menu li.current-menu-item:hover > a,
	.main_header nav ul.sub-menu li.current-menu-parent:hover > a,
	.main_header nav ul.sub-menu li.current-menu-ancestor:hover > a,
	.main_header nav ul.sub-menu li.current_page_item:hover > a  {
		color:#'. $hover_menu_color .'!important;
	}
		
	a,
	blockquote.shortcode_blockquote.type5:before,
	.dropcap.type2,
	.dropcap.type5,
	.widget_nav_menu ul li a:hover,
	.widget_archive ul li a:hover,
	.widget_pages ul li a:hover,
	.widget_categories ul li a:hover,
	.widget_recent_entries ul li a:hover,
	.widget_meta ul li a:hover,
	.widget_posts .post_title:hover,
	.shortcode_iconbox a:hover .iconbox_title,
	.shortcode_iconbox a:hover .iconbox_body,
	.shortcode_iconbox a:hover .iconbox_body p,
	.shortcode_iconbox a:hover .ico i,
	.featured_items_title h5 a:hover,
	.optionset li a:hover,
	.portfolio_dscr_top h3 a:hover,
	.portfolio_block h5 a:hover,
	.blogpost_title a:hover,
	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="password"]:focus,
	textarea:focus,
	.author_name a:hover,
	.header_filter .optionset li.selected a,
	.filter_toggler:hover,
	ol li:before,
	ul li:before,
	.count_title,
	.count_title h1,
	.no_bg a:hover,
	.pp_title span {	
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}

	input[type="text"]:focus::-webkit-input-placeholder,
	input[type="email"]:focus::-webkit-input-placeholder,
	input[type="password"]:focus::-webkit-input-placeholder,
	textarea:focus::-webkit-input-placeholder {
		color:#' . gt3_get_theme_option("theme_color1") . ';
		-webkit-font-smoothing: antialiased;
	}
	
	input[type="text"]:focus::-moz-placeholder,
	input[type="email"]:focus::-moz-placeholder,
	input[type="password"]:focus::-moz-placeholder,
	textarea:focus::-moz-placeholder {
		color:#' . gt3_get_theme_option("theme_color1") . ';
		opacity: 1;
		-moz-osx-font-smoothing: grayscale;
	}
	
	input[type="text"]:focus:-ms-input-placeholder {
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	input[type="email"]:focus:-ms-input-placeholder {
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	input[type="password"]:focus:-ms-input-placeholder {
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}	
	textarea:focus:-ms-input-placeholder {
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	
	.widget_posts .post_title:hover,
	.shortcode_iconbox a:hover .ico i,
	.module_team .team_title a:hover,
	.price_item.most_popular .item_cost_wrapper h3,
	.price_item.most_popular .item_cost_wrapper h5,
	.wrapper404 h1 span,
	.optionset li.selected a,
	.bc_title a:hover,
	.widget_nav_menu ul li a:hover,
	.widget_archive ul li a:hover,
	.widget_pages ul li a:hover,
	.widget_categories ul li a:hover,
	.widget_recent_entries ul li a:hover,
	.widget_meta ul li a:hover,
	.widget_posts .post_title:hover {
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	.featured_item_footer .gallery_likes:hover span,
	.featured_item_footer .gallery_likes:hover i,
	.featured_item_footer .morelink:hover,
	.module_team a.teamlink:hover,
	.preview_likes,
	.preview_likes i {
		color:#' . gt3_get_theme_option("theme_color1") . '!important;
	}
	.highlighted_colored,
	.shortcode_button.btn_type5,
	.box_date .box_month,
	.preloader:after,
	.price_item .price_item_btn a:hover,
	.shortcode_button.btn_type1:hover,
	.title:before,
	#reply-title:before,
	.postcomment:before,
	.featured_items_title h5:before,
	.module_team h5:before,
	.price_item.most_popular .price_item_title,
	.search404 .search_button,
	.portfolio_dscr_top h3:before,
	.bc_likes:hover,
	.pagerblock li a:hover,
	input[type="button"],
	input[type="reset"],
	input[type="submit"],
	.share_toggle:hover,
	.notify_shortcode input[type="submit"],
	.title_square h1:before,
	.title_square h2:before,
	.title_square h3:before,
	.title_square h4:before,
	.title_square h5:before,
	.title_square h6:before,
	.blogpost_user_meta h5:before {
		background-color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	#mc_signup_submit:hover,
	.pp_wrapper input[type="submit"]:hover,
	.search_button:hover,
	.blog_post_preview .blogpost_title:before {
		background-color:#' . gt3_get_theme_option("theme_color1") . '!important;
	}
	blockquote.shortcode_blockquote.type5 .blockquote_wrapper,
	.widget_tag_cloud a:hover,
	.fs_blog_top,
	.simple-post-top,
	.widget_search .search_form,
	.module_cont hr.type3,
	blockquote.shortcode_blockquote.type2,
	.iconbox_wrapper .ico,
	.promoblock_wrapper {
		border-color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	.bc_likes:hover:after {
		border-color: transparent transparent transparent #' . gt3_get_theme_option("theme_color1") .';
	}
	
	/* Woocommerce CSS */
	nav.woocommerce-pagination ul.page-numbers li a:hover {
		background:#' . gt3_get_theme_option("theme_color1") .';
	}
	.woocommerce select {
		font-family:"' . gt3_get_theme_option("main_font") . '";
	}
	.woocommerce_container ul.products li.product h3,
	.woocommerce ul.products li.product h3,
	.woocommerce-result-count {
		color:#'. $heading_color .';
	}	
	.woocommerce_container ul.products li.product h3:hover,
	.woocommerce ul.products li.product h3:hover {
		color: #' . gt3_get_theme_option("theme_color1") . ' !important;
	}
	.woocommerce_container ul.products li.product h3:before,
	.woocommerce ul.products li.product h3:before {
		background:#' . gt3_get_theme_option("theme_color1") . ';
	}
	.woocommerce .woocommerce_container ul.products li.product .product_meta .posted_in a:hover,
	.woocommerce .woocommerce_container .upsells.products ul li.product .product_meta .posted_in a:hover,
	.woocommerce ul.products li.product .product_meta .posted_in a:hover,
	.woocommerce .upsells.products ul li.product .product_meta .posted_in a:hover,
	.woocommerce_container ul.products li.product a.button:hover,
	.woocommerce ul.products li.product a.button:hover {
		color: #' . gt3_get_theme_option("theme_color1") . ' !important;
	}
	.woo_wrap .widget_shopping_cart .total span,
	.main_container .widget_shopping_cart .total span {color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	.woo_wrap ul.cart_list li a:hover, .woo_wrap ul.product_list_widget li a:hover,
	.woocommerce ul.product_list_widget li a:hover {
		color: #' . gt3_get_theme_option("theme_color1") . ' !important;
	}
	.widget_product_categories a:hover,
	.widget_product_categories li.current-cat a,
	.widget_login .pagenav a:hover,
	.woocommerce-page .widget_nav_menu ul li a:hover,
	.widget_layered_nav li:hover, .widget_layered_nav li.chosen,
	.widget_layered_nav li:hover a, .widget_layered_nav li.chosen a,
	.woocommerce .widget_layered_nav ul li.chosen a,
	.woocommerce-page .widget_layered_nav ul li.chosen a {
		color:#' . gt3_get_theme_option("theme_color1") . ' !important;
	}	
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce #respond input#submit,
	.woocommerce #content input.button,
	.woocommerce a.edit,
	.woocommerce #commentform #submit,
	.woocommerce-page input.button,
	.woocommerce .wrapper input[type="reset"],
	.woocommerce .wrapper input[type="submit"] {
		font-family: "' . gt3_get_theme_option("main_font") . '";
		-moz-osx-font-smoothing:grayscale;
		-webkit-font-smoothing:antialiased;
	}
	.woocommerce #commentform #submit,
	.woocommerce #respond input#submit,
	.woocommerce form.login input.button,
	.woocommerce form.lost_reset_password input.button,
	.return-to-shop a.button,
	#payment input.button,
	.woocommerce p input.button,
	.woocommerce p button.button,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce #content input.button,
	.woocommerce a.edit,
	.woocommerce-page input.button,
	.woocommerce .wrapper input[type="reset"],
	.woocommerce .wrapper input[type="submit"],
	.woocommerce .checkout_coupon p input.button,
	.woocommerce .checkout_coupon p button.button,
	.woocommerce .woocommerce-shipping-calculator p button.button {
		background:#' . gt3_get_theme_option("theme_color1") . ' !important;
	}	
	.woo_wrap .price_label span {color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	.woo_wrap .price_label span.to:before {
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}	
	.woocommerce-review-link:hover {color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	.woocommerce_container h1.product_title:before {
		background:#' . gt3_get_theme_option("theme_color1") . ';
	}
	.summary del,
	.summary del .amount,
	.woocommerce .summary .price span.from {
		color:#'. $heading_color .' !important;
	}
	div.product .summary .amount,
	div.product .summary ins,
	div.product .summary ins .amount {
		color:#' . gt3_get_theme_option("theme_color1") . ';


	}	
	.summary .product_meta span a:hover {color:#' . gt3_get_theme_option("theme_color1") . ' !important;
	}
	.woocommerce_container ul.products li.product a.add_to_cart_button.loading,
	.woocommerce ul.products li.product a.add_to_cart_button.loading {
		color:#' . gt3_get_theme_option("theme_color1") . ' !important;
	}
	.woocommerce div.product .woocommerce-tabs .panel,
	.woocommerce #content div.product .woocommerce-tabs .panel,
	.woocommerce div.product .woocommerce-tabs .panel p,
	.woocommerce #content div.product .woocommerce-tabs .panel p,
	.woocommerce .chosen-container .chosen-drop {
		color:#' . $content_color . ';
	}
	.woocommerce div.product .woocommerce-tabs .panel a:hover,
	.woocommerce #content div.product .woocommerce-tabs .panel a:hover {
		color:#' . $content_color . ' !important;
	}
	.woocommerce div.product .woocommerce-tabs .panel h2,
	.woocommerce #content div.product .woocommerce-tabs .panel h2,
	.woocommerce .woocommerce-tabs #reviews #reply-title,
	.woocommerce .chosen-container-single .chosen-search input[type="text"] {
		color:#'. $heading_color .' !important;
	}
	.woocommerce-page .widget_shopping_cart .empty {
		color:#' . $content_color . ' !important;
	}
	.woocommerce-page .related.products h2:before,
	.woocommerce-page .upsells.products h2:before,
	.woocommerce-page .contentarea h2:before,
	.woocommerce-page .contentarea h3:before,
	.woocommerce header.title h2:before,
	.woocommerce header.title h3:before {
		background:#' . gt3_get_theme_option("theme_color1") . ';
	}
	.woocommerce #payment div.payment_box,
	.woocommerce .chzn-container-single .chzn-single,
	.woocommerce .chosen-container-single .chosen-single {
		color:#' . $content_color . ' !important;
	}
	.woocommerce select,
	.shop_table .product-name,
	.shop_table .product-name a,
	.shop_table .product-price .amount {
		color:#' . $content_color . ';
	}
	.shop_table .product-name a:hover,
	.shop_table .product-subtotal .amount {
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	mark {background:#' . gt3_get_theme_option("theme_color1") . ';
	}
	.woocommerce-result-count,
	.woocommerce .woocommerce_container ul.products li.product .product_meta .posted_in a,
	.woocommerce .woocommerce_container .upsells.products ul li.product .product_meta .posted_in a,
	.woocommerce ul.products li.product .product_meta .posted_in a,
	.woocommerce .upsells.products ul li.product .product_meta .posted_in a,
	.woocommerce .woocommerce_container ul.products li.product .price,
	.woocommerce .woocommerce_container .upsells.products ul li.product .price,
	.woocommerce ul.products li.product .price,
	.woocommerce .upsells.products ul li.product .price,
	.woocommerce .woocommerce_container ul.products li.product .price ins,
	.woocommerce .woocommerce_container .upsells.products ul li.product .price ins,
	.woocommerce ul.products li.product .price ins,
	.woocommerce .upsells.products ul li.product .price ins,
	.widget_product_tag_cloud a,
	.woo_wrap ul.cart_list li a, .woo_wrap ul.product_list_widget li a,
	.main_container ul.cart_list li a, .woo_wrap ul.product_list_widget li a,
	.woocommerce ul.product_list_widget li a,
	.woocommerce-page .widget_shopping_cart .empty,
	.woo_wrap .widget_shopping_cart .total
	.main_container .widget_shopping_cart .total,
	.woocommerce ul.cart_list li dl dt,
	.woocommerce ul.product_list_widget li dl dt,
	.woocommerce ul.cart_list li dl dd,
	.woocommerce ul.product_list_widget li dl dd,
	.widget_product_categories a,
	.widget_login .pagenav a,
	.widget_product_categories a,
	.widget_login .pagenav a,
	.woo_wrap .price_label span.to:before,
	.widget_price_filter .ui-slider .ui-slider-handle:before,
	.woocommerce .woocommerce_message, .woocommerce .woocommerce_error, .woocommerce .woocommerce_info,
	.woocommerce .woocommerce-message, .woocommerce .woocommerce-error, .woocommerce .woocommerce-info,
	.woocommerce .quantity input.qty,
	.woocommerce #content .quantity input.qty,
	.summary .product_meta span a,
	.summary .product_meta span.tagged_as a,
	.woocommerce table.shop_attributes th,
	.woocommerce table.shop_attributes td,
	.woocommerce form .form-row input.input-text,
	.woocommerce form .form-row textarea,
	.woocommerce #coupon_code,
	.woocommerce strong span.amount,
	.woocommerce table.shop_table th,
	.woocommerce table.shop_table td,
	.order_table_item strong,
	.woocommerce .order_details li strong,
	.woocommerce-page .order_details li strong,
	.woocommerce .cart_totals th,
	.woocommerce .cart_totals th strong,
	.woocommerce select,
	.woo_wrap .quantity,
	.woo_wrap .quantity .amount,
	.main_container .quantity,
	.main_container .quantity .amount,
	.woo_wrap .widget_shopping_cart .total strong,
	.main_container .widget_shopping_cart .total strong,
	.widget_layered_nav li,
	.widget_layered_nav li a,
	.woocommerce .woocommerce_message a,
	.woocommerce .woocommerce_error a,
	.woocommerce .woocommerce_info a,
	.woocommerce .woocommerce-message a,
	.woocommerce .woocommerce-error a,
	.woocommerce .woocommerce-info a,
	.woocommerce-review-link,
	.woocommerce table.shop_attributes th,
	.woocommerce .lost_password,
	.woocommerce .cart_totals tr th, .woocommerce .cart_totals tr td {
		font-weight:' . gt3_get_theme_option("content_weight") . ';
	}
	.woocommerce_container ul.products li.product a.button,
	.woocommerce ul.products li.product a.button,
	.variations td label,
	.woocommerce .right-sidebar-block a.button,
	.woocommerce .right-sidebar-block button.button,
	.woocommerce .left-sidebar-block a.button,
	.woocommerce .left-sidebar-block button.button,
	.woocommerce-page .right-sidebar-block a.button,
	.woocommerce-page .right-sidebar-block button.button,
	.woocommerce-page .left-sidebar-block a.button,
	.woocommerce-page .left-sidebar-block button.button,
	.widget_shopping_cart a.button,
	.woocommerce label.checkbox,
	.calculated_shipping .order-total th,
	.calculated_shipping .order-total td .amount,
	.shop_table .product-name,
	.shop_table .product-name a,
	.shop_table .product-subtotal .amount,
	.shop_table .product-price .amount,
	.shop_table .product-name dl.variation dt,
	.shop_table .product-name dl.variation dd,
	.woocommerce .woocommerce-tabs #reviews #comments ol.commentlist li .comment-text .meta strong,
	.woocommerce .woocommerce-tabs #reviews #comments ol.commentlist li .comment-text .meta time,
	.woocommerce .shop_table.cart .actions .button,
	.woocommerce table.shop_table tfoot td,
	.woocommerce table.shop_table th,
	.product-name strong,
	.shipping-calculator-button {
		font-weight:' . gt3_get_theme_option("content_weight") . ' !important;
	}
	.woocommerce .cart-collaterals .order-total .amount {
		color:#'. $heading_color .';
	}
	input[type="search"]:focus,
	input[type="number"]:focus {	
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	input[type="search"]:focus::-webkit-input-placeholder,
	input[type="number"]:focus::-webkit-input-placeholder {
		color:#' . gt3_get_theme_option("theme_color1") . ';
		-webkit-font-smoothing: antialiased;
	}
	input[type="search"]:focus::-moz-placeholder,
	input[type="number"]:focus::-moz-placeholder,
	textarea:focus::-moz-placeholder {
		color:#' . gt3_get_theme_option("theme_color1") . ';
		opacity: 1;
		-moz-osx-font-smoothing: grayscale;
	}
	input[type="search"]:focus:-ms-input-placeholder {
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}	
	input[type="number"]:focus:-ms-input-placeholder {
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}
	.woocommerce .order_details li strong,
	.woocommerce-page .order_details li strong,
	.woocommerce table.shop_table thead th {
		color:#'. $heading_color .' !important;
	}
	#ship-to-different-address {
		color:#' . $content_color . ';
	}	
	.select2-container .select2-choice,
	.select2-container .select2-choice:hover,
	.select2-container .select2-choice span,
	.select2-container .select2-choice:hover span {
		color:#' . $content_color . ' !important;
		font-weight:' . gt3_get_theme_option("content_weight") . ' !important;
	}
	.header_cart_content a:hover {
		color:#' . gt3_get_theme_option("theme_color1") . ';
	}
    '
);

?>