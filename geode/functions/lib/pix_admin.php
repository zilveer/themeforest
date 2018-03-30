<?php
$pix_theme = wp_get_theme();
$version = $pix_theme->get( 'Version' );
$first_install_version = get_option('pix_last_version');
if ( is_admin() && $version != get_option('pix_last_version') ){
	update_option('pix_last_version',$version);
	pix_add_general();
	$json = get_google_font_list();
	$decoded = json_decode($json);
	$families = get_option('pix_style_select_fonts');
	$newfam = array();
	foreach ( $decoded->items as $item ) {
		if (is_array($families) && in_array($item->family,$families)) {
			$newfam[$item->family]['variants'] = $item->variants;
			$newfam[$item->family]['subsets'] = $item->subsets;
		}
		update_option('pix_style_fonts_w_variants',$newfam);
	}
}

if ( is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ){
	pix_add_general();
	geode_compile_css();
	update_google_font_list();
}


function pix_add_general() {
	global $options;
	add_options();
	foreach ($options as $value) :
		if(!get_option($value['id'])){
			add_option($value['id'], $value['std']);
		}
	endforeach;
}

function add_options() {
	$pix_theme = wp_get_theme();
	$version = $pix_theme->get( 'Version' );
	$_404_page = !get_page_by_title('Page not found') ? '' : get_page_by_title('Page not found');
	$_404_page = $_404_page!='' ? $_404_page->ID : '';
	$search_page = !get_page_by_title('Search results') ? '' : get_page_by_title('Search results');
	$search_page = $search_page!='' ? $search_page->ID : '';
	$footer = !get_page_by_title('Footer') ? '' : get_page_by_title('Footer');
	$footer = $footer!='' ? $footer->ID : '';
	$top_sliding = !get_page_by_title('Top sliding bar') ? '' : get_page_by_title('Top sliding bar');
	$top_sliding = $top_sliding!='' ? $top_sliding->ID : '';
	$blog = !get_page_by_title('Blog') ? '' : get_page_by_title('Blog');
	$blog = $blog!='' ? $blog->ID : '';
	$portfolio = !get_page_by_title('Portfolio') ? '' : get_page_by_title('Portfolio');
	$portfolio = $portfolio!='' ? $portfolio->ID : '';
	$get_template_directory_safe_uri = str_replace('http:', '', get_template_directory_uri());
	$get_template_directory_safe_uri = str_replace('https:', '', $get_template_directory_safe_uri);

	global $options;
	
	$options = array (

		array( "id" => "pix_last_version",
			"std" => $version),

		array( "id" => "pix_content_geode_user_name",
			"std" => ''),

		array( "id" => "pix_content_geode_license_key",
			"std" => ''),

		array( "id" => "pix_content_admin_page_title",
			"std" => "Geode"),

		array( "id" => "pix_content_login_logo",
			"std" => $get_template_directory_safe_uri."/functions/images/geode_logo_login.png"),

		array( "id" => "pix_content_favicon",
			"std" => ""),

		array( "id" => "pix_content_allow_ajax",
			"std" => "true"),

		array( "id" => "pix_content_css_inline",
			"std" => "true"),

		array( "id" => "pix_style_topbar_display",
			"std" => "true"),

		array( "id" => "pix_style_topbar_color",
			"std" => "#222222"),

		array( "id" => "pix_style_topbar_bgcolor",
			"std" => "#fafafa"),

		array( "id" => "pix_style_topbar_opacity",
			"std" => "1"),

		array( "id" => "pix_style_topbar_border",
			"std" => "#dddddd"),

		array( "id" => "pix_style_layout_style",
			"std" => "fullwidth"),

		array( "id" => "pix_style_body_img",
			"std" => $get_template_directory_safe_uri."/images/def-bg.jpg"),

		array( "id" => "pix_style_body_size",
			"std" => "cover"),

		array( "id" => "pix_style_body_repeat",
			"std" => "0"),

		array( "id" => "pix_style_body_position",
			"std" => "center"),

		array( "id" => "pix_style_query_loader",
			"std" => "true"),

		array( "id" => "pix_style_page_margin_top",
			"std" => "40"),

		array( "id" => "pix_style_page_margin_bottom",
			"std" => "40"),

		array( "id" => "pix_style_page_margin_left",
			"std" => "40"),

		array( "id" => "pix_style_page_margin_right",
			"std" => "40"),

		array( "id" => "pix_style_layout_width",
			"std" => "1320"),

		array( "id" => "pix_style_demo_panel",
			"std" => "0"),

		array( "id" => "pix_style_page_radius",
			"std" => "0"),

		array( "id" => "pix_style_body_bg_color",
			"std" => "#fafafa"),

		array( "id" => "pix_style_page_bg_color",
			"std" => "#ffffff"),

		array( "id" => "pix_style_page_shadow_color",
			"std" => "#000000"),

		array( "id" => "pix_style_body_fontfamily",
			"std" => "Lato"),

		array( "id" => "pix_style_body_fontvariant",
			"std" => "300"),

		array( "id" => "pix_style_body_fontsubset",
			"std" => "latin"),

		array( "id" => "pix_style_body_fontsize",
			"std" => "15"),

		array( "id" => "pix_style_body_color",
			"std" => "#222222"),

		array( "id" => "pix_style_alternative_fontfamily",
			"std" => "Merriweather"),

		array( "id" => "pix_style_alternative_fontvariant",
			"std" => "regular"),

		array( "id" => "pix_style_alternative_fontsubset",
			"std" => "latin"),

		array( "id" => "pix_style_alternative_fontsize",
			"std" => "1.1"),

		array( "id" => "pix_style_page_shadow_size",
			"std" => "0"),

		array( "id" => "pix_style_page_shadow_opacity",
			"std" => "0"),

		array( "id" => "pix_style_scroll_button",
			"std" => "true"),

		array( "id" => "pix_style_fx_title",
			"std" => "pix-fadeIn"),

		array( "id" => "pix_style_fx_onscroll",
			"std" => "pix-fadeIn"),

		array( "id" => "pix_style_topbar_height",
			"std" => "40"),

		array( "id" => "pix_style_topbar_group_break",
			"std" => "800"),

		array( "id" => "pix_style_topbar_fontsize",
			"std" => "0.725"),

		array( "id" => "pix_content_header_logo",
			"std" => $get_template_directory_safe_uri."/images/geode_logo.svg"),

		array( "id" => "pix_style_header_bgcolor",
			"std" => "#ffffff"),

		array( "id" => "pix_style_header_opacity",
			"std" => "1"),

		array( "id" => "pix_style_header_style",
			"std" => "floating"),

		array( "id" => "pix_style_sitedescription_fromleft",
			"std" => "0"),

		array( "id" => "pix_style_sitedescription_frombottom",
			"std" => "0"),

		array( "id" => "pix_style_sticky_header",
			"std" => "true"),

		array( "id" => "pix_style_wide_header",
			"std" => "0"),

		array( "id" => "pix_style_header_scroll",
			"std" => "true"),

		array( "id" => "pix_style_header_hover",
			"std" => "true"),

		array( "id" => "pix_style_header_height",
			"std" => "110"),

		array( "id" => "pix_style_header_height_scrolled",
			"std" => "80"),

		array( "id" => "pix_style_nav_icons",
			"std" => "centered"),

		array( "id" => "pix_style_nav_fontfamily",
			"std" => "Lato"),

		array( "id" => "pix_style_nav_fontvariant",
			"std" => "700"),

		array( "id" => "pix_style_nav_fontsize",
			"std" => "13"),

		array( "id" => "pix_style_nav_lineheight",
			"std" => "50"),

		array( "id" => "pix_style_nav_mobile_size",
			"std" => "800"),

		array( "id" => "pix_style_nav_color",
			"std" => "#222222"),

		array( "id" => "pix_style_nav_color_cta",
			"std" => "#ffffff"),

		array( "id" => "pix_style_border_cta",
			"std" => "#dc795c"),

		array( "id" => "pix_style_bg_cta",
			"std" => "#dc795c"),

		array( "id" => "pix_style_radius_cta",
			"std" => "100"),

		array( "id" => "pix_style_hover_color_cta",
			"std" => "#dc795c"),

		array( "id" => "pix_style_border_hover_cta",
			"std" => "#dc795c"),

		array( "id" => "pix_style_bg_hover_cta",
			"std" => "#ffffff"),

		array( "id" => "pix_style_border_w_cta",
			"std" => "2"),

		array( "id" => "pix_style_current_border",
			"std" => "#dc795c"),

		array( "id" => "pix_style_nav_hover_color",
			"std" => "#222222"),

		array( "id" => "pix_style_nav_hover_bg",
			"std" => "#eeeeee"),

		array( "id" => "pix_style_menu_search_icon",
			"std" => "scicon-awesome-search"),

		array( "id" => "pix_content_menu_search_field",
			"std" => "true"),

		array( "id" => "pix_style_menu_woo_icon",
			"std" => "scicon-ecommerce-247"),

		array( "id" => "pix_content_menu_woo_field",
			"std" => "0"),

		array( "id" => "pix_style_nav_background",
			"std" => "#ffffff"),

		array( "id" => "pix_style_enable_google_fonts",
			"std" => "true"),

		array( "id" => "pix_content_google_api_key",
			"std" => ""),

		array( "id" => "pix_style_post_type_search",
			"std" => ""),

		array( "id" => "pix_style_nav_border",
			"std" => "#dddddd"),

		array( "id" => "pix_style_sitetitle_fontfamily",
			"std" => "Montserrat"),

		array( "id" => "pix_style_sitetitle_fontvariant",
			"std" => "regular"),

		array( "id" => "pix_style_sitetitle_fontsize",
			"std" => "26"),

		array( "id" => "pix_style_sitedescription_fontfamily",
			"std" => "Lato"),

		array( "id" => "pix_style_sitedescription_fontvariant",
			"std" => "700"),

		array( "id" => "pix_style_sitedescription_fontsize",
			"std" => "12"),

		array( "id" => "pix_style_sitetitle_color",
			"std" => "#222222"),

		array( "id" => "pix_style_sitetitle_padding",
			"std" => "0"),

		array( "id" => "pix_style_sitedescription_color",
			"std" => "#222222"),

		array( "id" => "pix_style_logo_bg",
			"std" => "transparent"),

		array( "id" => "pix_style_nav2nd_color",
			"std" => "#222222"),

		array( "id" => "pix_style_nav2nd_border",
			"std" => "#dc795c"),

		array( "id" => "pix_style_nav2nd_border2",
			"std" => "#dddddd"),

		array( "id" => "pix_style_nav2nd_bg",
			"std" => "#ffffff"),

		array( "id" => "pix_style_nav2nd_hover_color",
			"std" => "#dc795c"),

		array( "id" => "pix_style_nav2nd_hover_bg",
			"std" => "#eeeeee"),

		array( "id" => "pix_style_nav2nd_fontfamily",
			"std" => "Lato"),

		array( "id" => "pix_style_nav2nd_fontvariant",
			"std" => "700"),

		array( "id" => "pix_style_nav2nd_fontsize",
			"std" => "13"),

		array( "id" => "pix_content_footer_page",
			"std" => $footer),

		array( "id" => "pix_content_top_sliding_page",
			"std" => $top_sliding),

		array( "id" => "pix_style_button_default_color",
			"std" => "#464646"),

		array( "id" => "pix_style_button_default_bordercolor",
			"std" => "#afafaf"),

		array( "id" => "pix_style_button_default_bg",
			"std" => "transparent"),

		array( "id" => "pix_style_button_default_borderwidth",
			"std" => "2"),

		array( "id" => "pix_style_button_default_texthover",
			"std" => "#ffffff"),

		array( "id" => "pix_style_button_default_bordercolorhover",
			"std" => "#464646"),

		array( "id" => "pix_style_button_default_bghover",
			"std" => "#464646"),

		array( "id" => "pix_style_button_default_borderradius",
			"std" => "50"),

		array( "id" => "pix_style_button_default_fx",
			"std" => ""),

		array( "id" => "pix_style_button_default_icon",
			"std" => ""),

		array( "id" => "pix_style_button_default2_color",
			"std" => "#ffffff"),

		array( "id" => "pix_style_button_default2_bordercolor",
			"std" => "#222222"),

		array( "id" => "pix_style_button_default2_bg",
			"std" => "#222222"),

		array( "id" => "pix_style_button_default2_borderwidth",
			"std" => "2"),

		array( "id" => "pix_style_button_default2_texthover",
			"std" => "#222222"),

		array( "id" => "pix_style_button_default2_bordercolorhover",
			"std" => "#cccccc"),

		array( "id" => "pix_style_button_default2_bghover",
			"std" => "#ffffff"),

		array( "id" => "pix_style_button_default2_borderradius",
			"std" => "50"),

		array( "id" => "pix_style_button_default2_fx",
			"std" => ""),

		array( "id" => "pix_style_button_default2_icon",
			"std" => ""),

		array( "id" => "pix_style_button_footer_color",
			"std" => "#aaaaaa"),

		array( "id" => "pix_style_button_footer_bordercolor",
			"std" => "#5e5e5e"),

		array( "id" => "pix_style_button_footer_bg",
			"std" => "transparent"),

		array( "id" => "pix_style_button_footer_borderwidth",
			"std" => "2"),

		array( "id" => "pix_style_button_footer_texthover",
			"std" => "#404040"),

		array( "id" => "pix_style_button_footer_bordercolorhover",
			"std" => "#dddddd"),

		array( "id" => "pix_style_button_footer_bghover",
			"std" => "#dddddd"),

		array( "id" => "pix_style_button_footer_fx",
			"std" => ""),

		array( "id" => "pix_style_button_footer_borderradius",
			"std" => "50"),

		array( "id" => "pix_style_button_footer_icon",
			"std" => ""),

		array( "id" => "pix_style_button_footer2_color",
			"std" => "#353535"),

		array( "id" => "pix_style_button_footer2_bordercolor",
			"std" => "#cccccc"),

		array( "id" => "pix_style_button_footer2_bg",
			"std" => "#cccccc"),

		array( "id" => "pix_style_button_footer2_borderwidth",
			"std" => "2"),

		array( "id" => "pix_style_button_footer2_texthover",
			"std" => "#353535"),

		array( "id" => "pix_style_button_footer2_bordercolorhover",
			"std" => "#555555"),

		array( "id" => "pix_style_button_footer2_bghover",
			"std" => "#353535"),

		array( "id" => "pix_style_button_footer2_fx",
			"std" => ""),

		array( "id" => "pix_style_button_footer2_borderradius",
			"std" => "50"),

		array( "id" => "pix_style_button_footer2_icon",
			"std" => ""),

		array( "id" => "pix_style_button_top_sliding_color",
			"std" => "#aaaaaa"),

		array( "id" => "pix_style_button_top_sliding_bordercolor",
			"std" => "#5e5e5e"),

		array( "id" => "pix_style_button_top_sliding_bg",
			"std" => "transparent"),

		array( "id" => "pix_style_button_top_sliding_borderwidth",
			"std" => "2"),

		array( "id" => "pix_style_button_top_sliding_texthover",
			"std" => "#404040"),

		array( "id" => "pix_style_button_top_sliding_bordercolorhover",
			"std" => "#dddddd"),

		array( "id" => "pix_style_button_top_sliding_bghover",
			"std" => "#dddddd"),

		array( "id" => "pix_style_button_top_sliding_fx",
			"std" => ""),

		array( "id" => "pix_style_button_top_sliding_borderradius",
			"std" => "50"),

		array( "id" => "pix_style_button_top_sliding_icon",
			"std" => ""),

		array( "id" => "pix_style_button_top_sliding2_color",
			"std" => "#353535"),

		array( "id" => "pix_style_button_top_sliding2_bordercolor",
			"std" => "#cccccc"),

		array( "id" => "pix_style_button_top_sliding2_bg",
			"std" => "#cccccc"),

		array( "id" => "pix_style_button_top_sliding2_borderwidth",
			"std" => "2"),

		array( "id" => "pix_style_button_top_sliding2_texthover",
			"std" => "#353535"),

		array( "id" => "pix_style_button_top_sliding2_bordercolorhover",
			"std" => "#555555"),

		array( "id" => "pix_style_button_top_sliding2_bghover",
			"std" => "#353535"),

		array( "id" => "pix_style_button_top_sliding2_fx",
			"std" => ""),

		array( "id" => "pix_style_button_top_sliding2_borderradius",
			"std" => "50"),

		array( "id" => "pix_style_button_top_sliding2_icon",
			"std" => ""),

		array( "id" => "pix_style_single_fontfamily",
			"std" => "Merriweather"),

		array( "id" => "pix_style_single_fontvariant",
			"std" => "300"),

		array( "id" => "pix_style_single_fontsize",
			"std" => "1.05"),

		array( "id" => "pix_style_h1_fontfamily",
			"std" => "Montserrat"),

		array( "id" => "pix_style_h1_fontvariant",
			"std" => "regular"),

		array( "id" => "pix_style_h1_fontsize",
			"std" => "2.4"),

		array( "id" => "pix_style_h1_color",
			"std" => ""),

		array( "id" => "pix_style_h1_css",
			"std" => "text-transform: uppercase;"),

		array( "id" => "pix_style_h2_fontfamily",
			"std" => "Montserrat"),

		array( "id" => "pix_style_h2_fontvariant",
			"std" => "regular"),

		array( "id" => "pix_style_h2_fontsize",
			"std" => "2"),

		array( "id" => "pix_style_h2_color",
			"std" => ""),

		array( "id" => "pix_style_h2_css",
			"std" => "text-transform: uppercase;"),

		array( "id" => "pix_style_h3_fontfamily",
			"std" => "Montserrat"),

		array( "id" => "pix_style_h3_fontvariant",
			"std" => "regular"),

		array( "id" => "pix_style_h3_fontsize",
			"std" => "1.7"),

		array( "id" => "pix_style_h3_color",
			"std" => ""),

		array( "id" => "pix_style_h3_css",
			"std" => "text-transform: uppercase;"),

		array( "id" => "pix_style_h4_css",
			"std" => "text-transform: uppercase;"),

		array( "id" => "pix_style_h4_fontfamily",
			"std" => "Montserrat"),

		array( "id" => "pix_style_h4_fontvariant",
			"std" => "regular"),

		array( "id" => "pix_style_h4_fontsize",
			"std" => "1.35"),

		array( "id" => "pix_style_h4_color",
			"std" => ""),

		array( "id" => "pix_style_h4_css",
			"std" => "text-transform: uppercase;"),

		array( "id" => "pix_style_h5_fontfamily",
			"std" => "Montserrat"),

		array( "id" => "pix_style_h5_fontvariant",
			"std" => "regular"),

		array( "id" => "pix_style_h5_fontsize",
			"std" => "1.2"),

		array( "id" => "pix_style_h5_color",
			"std" => ""),

		array( "id" => "pix_style_h5_css",
			"std" => "text-transform: uppercase;"),

		array( "id" => "pix_style_h6_fontfamily",
			"std" => "Montserrat"),

		array( "id" => "pix_style_h6_fontvariant",
			"std" => "regular"),

		array( "id" => "pix_style_h6_fontsize",
			"std" => "1"),

		array( "id" => "pix_style_h6_color",
			"std" => ""),

		array( "id" => "pix_style_h6_css",
			"std" => "text-transform: uppercase;"),

		array( "id" => "pix_content_latest_post_page",
			"std" => $blog),

		array( "id" => "pix_style_latest_post_page_layout",
			"std" => 'masonry'),

		array( "id" => "pix_style_latest_post_page_gutter",
			"std" => '0'),

		array( "id" => "pix_style_latest_post_page_columns",
			"std" => '3'),

		array( "id" => "pix_style_latest_post_page_pagination",
			"std" => 'infinite'),

		array( "id" => "pix_style_latest_post_page_order",
			"std" => ''),

		array( "id" => "pix_style_latest_post_page_order_by",
			"std" => ''),

		array( "id" => "pix_style_woo_quick_view",
			"std" => 'true'),

		array( "id" => "pix_style_woo_list_layout",
			"std" => "#above_header .top_bar {
  text-transform: uppercase;
}"),

		array( "id" => "pix_style_woo_list_layout",
			"std" => ""),

		array( "id" => "pix_style_woo_ppp",
			"std" => "12"),

		array( "id" => "pix_style_woo_list_columns",
			"std" => "3"),

		array( "id" => "pix_content_woo_list_sidebar",
			"std" => ""),

		array( "id" => "pix_content_woo_list_sidebar_2",
			"std" => ""),

		array( "id" => "pix_style_woo_list_bg",
			"std" => ""),

		array( "id" => "pix_style_woo_list_bg_title",
			"std" => ""),

		array( "id" => "pix_style_woo_list_bg_img",
			"std" => ""),

		array( "id" => "pix_style_woo_list_bg_title_img",
			"std" => ""),

		array( "id" => "pix_style_woo_title_color",
			"std" => ""),

		array( "id" => "pix_style_woo_template",
			"std" => "default"),

		array( "id" => "pix_style_main_sidebar_position",
			"std" => "right"),

		array( "id" => "pix_style_product_template",
			"std" => "default"),

		array( "id" => "pix_content_product_sidebar_2",
			"std" => ""),

		array( "id" => "pix_content_product_sidebar",
			"std" => ""),

		array( "id" => "pix_style_related_products",
			"std" => "0"),

		array( "id" => "pix_style_disable_product_zoom",
			"std" => "0"),

		array( "id" => "pix_style_product_bg",
			"std" => ""),

		array( "id" => "pix_style_product_bg_img",
			"std" => ""),

		array( "id" => "pix_style_product_color",
			"std" => ""),

		array( "id" => "pix_style_product_bg_title",
			"std" => ""),

		array( "id" => "pix_style_product_bg_title_img",
			"std" => ""),

		array( "id" => "pix_style_shop_list_template",
			"std" => ""),

		array( "id" => "pix_style_shop_list_columns",
			"std" => ""),

		array( "id" => "pix_style_shop_onsale_color",
			"std" => "#ffffff"),

		array( "id" => "pix_style_shop_onsale_bg",
			"std" => "#353535"),

		array( "id" => "pix_style_title_color",
			"std" => "#353535"),

		array( "id" => "pix_style_title_bgcolor",
			"std" => "#eeeeee"),

		array( "id" => "pix_style_bg_title_img",
			"std" => ""),

		array( "id" => "pix_content_primary_sidebar",
			"std" => "Geode_default_sidebar"),

		array( "id" => "pix_content_secondary_sidebar",
			"std" => "Geode_default_sidebar_2"),
 
		array( "id" => "pix_style_portfolio_page_base",
			"std" => ""),

		array( "id" => "pix_style_portfolio_list_layout",
			"std" => "1:1"),

		array( "id" => "pix_style_portfolio_list_columns",
			"std" => "3"),

		array( "id" => "pix_content_portfolio_list_sidebar",
			"std" => ""),

		array( "id" => "pix_content_portfolio_list_sidebar_2",
			"std" => ""),

		array( "id" => "pix_style_portfolio_template",
			"std" => "templates/wide-page.php"),

		array( "id" => "pix_style_portfolio_title_color",
			"std" => ""),

		array( "id" => "pix_style_portfolio_list_bg",
			"std" => ""),

		array( "id" => "pix_style_portfolio_list_bg_title",
			"std" => ""),

		array( "id" => "pix_style_portfolio_list_bg_title",
			"std" => ""),

		array( "id" => "pix_style_portfolio_list_bg_title_img",
			"std" => ""),

		array( "id" => "pix_style_single_portfolio_template",
			"std" => ""),

		array( "id" => "pix_content_single_portfolio_sidebar",
			"std" => ""),

		array( "id" => "pix_content_single_portfolio_sidebar_2",
			"std" => ""),

		array( "id" => "pix_style_single_portfolio_color",
			"std" => ""),

		array( "id" => "pix_style_single_portfolio_bg",
			"std" => ""),

		array( "id" => "pix_style_single_portfolio_bg_img",
			"std" => ""),

		array( "id" => "pix_style_single_portfolio_bg_title_img",
			"std" => ""),

		array( "id" => "pix_style_disable_colorbox_portfolio_items",
			"std" => ""),

		array( "id" => "pix_style_portfolio_list_gutter",
			"std" => "0"),

		array( "id" => "pix_style_portfolio_text_position",
			"std" => "fancy"),

		array( "id" => "pix_style_archive_layout",
			"std" => "masonry"),

		array( "id" => "pix_style_archive_columns",
			"std" => "3"),

		array( "id" => "pix_style_archive_gutter",
			"std" => "0"),

		array( "id" => "pix_style_archive_template",
			"std" => "default"),

		array( "id" => "pix_style_archive_bg",
			"std" => ""),

		array( "id" => "pix_style_archive_bg_img",
			"std" => ""),

		array( "id" => "pix_style_archive_title_color",
			"std" => ""),

		array( "id" => "pix_style_archive_bg_title",
			"std" => ""),

		array( "id" => "pix_style_archive_bg_title_img",
			"std" => ""),

		array( "id" => "pix_style_archive_order",
			"std" => ""),

		array( "id" => "pix_style_archive_order_by",
			"std" => ""),

		array( "id" => "pix_style_portfolio_list_link",
			"std" => "both"),

		array( "id" => "pix_style_portfolio_list_pagination",
			"std" => "infinite"),

		array( "id" => "pix_style_portfolio_list_order",
			"std" => ""),

		array( "id" => "pix_style_portfolio_list_orderby",
			"std" => ""),

		array( "id" => "pix_style_single_template",
			"std" => "default"),

		array( "id" => "pix_content_single_sidebar",
			"std" => ""),

		array( "id" => "pix_content_single_sidebar_2",
			"std" => ""),

		array( "id" => "pix_style_single_color",
			"std" => ""),

		array( "id" => "pix_style_single_bg",
			"std" => ""),

		array( "id" => "pix_style_single_bg_title",
			"std" => ""),

		array( "id" => "pix_style_single_bg_img",
			"std" => ""),

		array( "id" => "pix_style_single_bg_title_img",
			"std" => ""),

		array( "id" => "pix_content_404_page",
			"std" => $_404_page),

		array( "id" => "pix_content_search_page",
			"std" => $search_page),

		array( "id" => "pix_style_enable_colorbox",
			"std" => "true"),

		array( "id" => "pix_style_enable_filestyle",
			"std" => "true"),

		array( "id" => "pix_style_enable_customselect",
			"std" => "true"),

		array( "id" => "pix_style_link_color",
			"std" => "#dc795c"),

		array( "id" => "pix_style_link_hover",
			"std" => "#ab8478"),

		array( "id" => "pix_style_tiny_color",
			"std" => "#999999"),

		array( "id" => "pix_style_error_color",
			"std" => "#f04d06"),

		array( "id" => "pix_style_border_color",
			"std" => "#dddddd"),

		array( "id" => "pix_style_alternative_border",
			"std" => "#bbbbbb"),

		array( "id" => "pix_style_input_bg",
			"std" => "#fafafa"),

		array( "id" => "pix_style_scroll_bg",
			"std" => "#000000"),

		array( "id" => "pix_style_scroll_bg_opacity",
			"std" => "0.75"),

		array( "id" => "pix_style_scroll_color",
			"std" => "#eeeeee"),

		array( "id" => "pix_style_featured_color",
			"std" => "#dc795c"),

		array( "id" => "pix_style_featured_color_alt",
			"std" => "#6d9fa3"),

		array( "id" => "pix_style_colorbox_overlay",
			"std" => "#000000"),

		array( "id" => "pix_style_colorbox_content_bg",
			"std" => "#353535"),

		array( "id" => "pix_style_colorbox_color",
			"std" => "#ffffff"),

		array( "id" => "pix_style_colorbox_button",
			"std" => "#ffffff"),

		array( "id" => "pix_style_footer_bg",
			"std" => "#222222"),

		array( "id" => "pix_style_footer_color",
			"std" => "#aeaeae"),

		array( "id" => "pix_style_footer_link",
			"std" => "#dc795c"),

		array( "id" => "pix_style_footer_hover",
			"std" => "#ab8478"),

		array( "id" => "pix_style_featured_footer",
			"std" => "#dc795c"),

		array( "id" => "pix_style_featured_footer_alt",
			"std" => "#3ec7c2"),

		array( "id" => "pix_style_footer_error",
			"std" => "#f04d06"),

		array( "id" => "pix_style_footer_border",
			"std" => "#4b4b4b"),

		array( "id" => "pix_style_footer_alternative_border",
			"std" => "#999999"),

		array( "id" => "pix_style_footer_tiny",
			"std" => "#555555"),

		array( "id" => "pix_style_footer_input",
			"std" => "#000000"),

        array( "id" => "pix_style_top_sliding_bg",
            "std" => "#151515"),

        array( "id" => "pix_style_top_sliding_bg_opacity",
            "std" => "0.95"),

        array( "id" => "pix_style_top_sliding_color",
            "std" => "#aeaeae"),

        array( "id" => "pix_style_top_sliding_link",
            "std" => "#dc795c"),

        array( "id" => "pix_style_top_sliding_hover",
            "std" => "#b07c6d"),

        array( "id" => "pix_style_featured_top_sliding",
            "std" => "#dc795c"),

        array( "id" => "pix_style_featured_top_sliding_alt",
            "std" => "#3ec7c2"),

        array( "id" => "pix_style_top_sliding_error",
            "std" => "#f04d06"),

        array( "id" => "pix_style_top_sliding_border",
            "std" => "#4b4b4b"),

        array( "id" => "pix_style_top_sliding_alternative_border",
            "std" => "#999999"),

        array( "id" => "pix_style_top_sliding_tiny",
            "std" => "#555555"),

        array( "id" => "pix_style_top_sliding_input",
            "std" => "#000000"),

        array( "id" => "pix_style_box_default_color",
			"std" => "#222222"),

        array( "id" => "pix_style_box_default_background",
			"std" => "transparent"),

        array( "id" => "pix_style_box_default_borderradius",
			"std" => "2"),

        array( "id" => "pix_style_box_default_bordercolor",
			"std" => "#dddddd"),

        array( "id" => "pix_style_box_default_borderwidth",
			"std" => "1"),

        array( "id" => "pix_style_box_default_style",
			"std" => ""),

        array( "id" => "pix_style_box_success_color",
			"std" => "#222222"),

        array( "id" => "pix_style_box_success_background",
			"std" => "transparent"),

        array( "id" => "pix_style_box_success_borderradius",
			"std" => "2"),

        array( "id" => "pix_style_box_success_bordercolor",
			"std" => "#4aad8e"),

        array( "id" => "pix_style_box_success_borderwidth",
			"std" => "1"),

        array( "id" => "pix_style_box_success_style",
			"std" => "border-left-width: 6px;"),

        array( "id" => "pix_style_box_error_color",
			"std" => "#222222"),

        array( "id" => "pix_style_box_error_background",
			"std" => "transparent"),

        array( "id" => "pix_style_box_error_borderradius",
			"std" => "2"),

        array( "id" => "pix_style_box_error_bordercolor",
			"std" => "#a30000"),

        array( "id" => "pix_style_box_error_borderwidth",
			"std" => "1"),

        array( "id" => "pix_style_box_error_style",
			"std" => "border-left-width: 6px;"),

        array( "id" => "pix_style_footer_box_default_color",
			"std" => "#ffffff"),

        array( "id" => "pix_style_footer_box_default_background",
			"std" => "transparent"),

        array( "id" => "pix_style_footer_box_default_borderradius",
			"std" => "2"),

        array( "id" => "pix_style_footer_box_default_bordercolor",
			"std" => "#666666"),

        array( "id" => "pix_style_footer_box_default_borderwidth",
			"std" => "1"),

        array( "id" => "pix_style_footer_box_default_style",
			"std" => ""),

        array( "id" => "pix_style_footer_box_success_color",
			"std" => "#ffffff"),

        array( "id" => "pix_style_footer_box_success_background",
			"std" => "transparent"),

        array( "id" => "pix_style_footer_box_success_borderradius",
			"std" => "2"),

        array( "id" => "pix_style_footer_box_success_bordercolor",
			"std" => "#05a300"),

        array( "id" => "pix_style_footer_box_success_borderwidth",
			"std" => "1"),

        array( "id" => "pix_style_footer_box_success_style",
			"std" => "border-left-width: 6px;"),

        array( "id" => "pix_style_footer_box_error_color",
			"std" => "#ffffff"),

        array( "id" => "pix_style_footer_box_error_background",
			"std" => "transparent"),

        array( "id" => "pix_style_footer_box_error_borderradius",
			"std" => "2"),

        array( "id" => "pix_style_footer_box_error_bordercolor",
			"std" => "#a30000"),

        array( "id" => "pix_style_footer_box_error_borderwidth",
			"std" => "1"),

        array( "id" => "pix_style_footer_box_error_style",
			"std" => "border-left-width: 6px;"),

        array( "id" => "pix_style_topsliding_box_default_color",
			"std" => "#ffffff"),

        array( "id" => "pix_style_topsliding_box_default_background",
			"std" => "transparent"),

        array( "id" => "pix_style_topsliding_box_default_borderradius",
			"std" => "2"),

        array( "id" => "pix_style_topsliding_box_default_bordercolor",
			"std" => "#666666"),

        array( "id" => "pix_style_topsliding_box_default_borderwidth",
			"std" => "1"),

        array( "id" => "pix_style_topsliding_box_default_style",
			"std" => ""),

        array( "id" => "pix_style_topsliding_box_success_color",
			"std" => "#ffffff"),

        array( "id" => "pix_style_topsliding_box_success_background",
			"std" => "transparent"),

        array( "id" => "pix_style_topsliding_box_success_borderradius",
			"std" => "2"),

        array( "id" => "pix_style_topsliding_box_success_bordercolor",
			"std" => "#05a300"),

        array( "id" => "pix_style_topsliding_box_success_borderwidth",
			"std" => "1"),

        array( "id" => "pix_style_topsliding_box_success_style",
			"std" => "border-left-width: 6px;"),

        array( "id" => "pix_style_topsliding_box_error_color",
			"std" => "#ffffff"),

        array( "id" => "pix_style_topsliding_box_error_background",
			"std" => "transparent"),

        array( "id" => "pix_style_topsliding_box_error_borderradius",
			"std" => "2"),

        array( "id" => "pix_style_topsliding_box_error_bordercolor",
			"std" => "#a30000"),

        array( "id" => "pix_style_topsliding_box_error_borderwidth",
			"std" => "1"),

        array( "id" => "pix_style_topsliding_box_error_style",
			"std" => "border-left-width: 6px;"),

        array( "id" => "pix_style_sitetitle_display",
			"std" => "0"),

        array( "id" => "pix_style_header",
			"std" => "/*jQuery(document).ready(function(){
  alert('Hello world');
}*/"),

        array( "id" => "pix_style_footer",
			"std" => "/*jQuery(document).ready(function(){
  alert('Hello world');
}*/"),

		array( "id" => "pix_style_select_fonts",
			"std" => array(
				'Lato',
				'Merriweather',
				'Merriweather')),

		array( "id" => "pix_style_fonts_w_variants",
			"std" => array(
				'Lato' => array(),
				'Merriweather' => array(),
				'Merriweather' => array())),

	);

    update_option("pixgridder_info_addon","close");
    update_option("shortcodelic_info_update","close");
    update_option("pixgridder_fx","available");
    update_option("pixgridder_post_type", array('page' => 'page', 'team' => 'team'));
    update_option("pixgridder_page_template",array(
		'default' => 'default',
		'templates/double-side-page.php' => 'templates/double-side-page.php',
		'templates/front-page.php' => 'templates/front-page.php',
		'templates/wide-page.php' => 'templates/wide-page.php',
	));
    update_option("pixgridder_min_cols","1");
    update_option("pixgridder_max_cols","12");
    update_option("pixgridder_exclude_cols","");
    update_option("pixgridder_row_open",'<div class="row" data-cols="$1"><div class="row-inside">');
    update_option("pixgridder_row_close",'</div><!--.row-inside--></div><!--.row[data-cols="$1"]-->');
    update_option("pixgridder_column_open",'<div class="column" data-col="$1">');
    update_option("pixgridder_column_close",'</div><!--.column[data-col="$1"]-->');
    update_option("pixgridder_css_selector",".row .column");
    update_option("pixgridder_css_padding","0");

	if (function_exists('admin_interface')){
		admin_interface('add_options');
	}
	if (function_exists('admin_panel')){
		admin_panel('add_options');
	}
	if (function_exists('register_theme')){
		register_theme('add_options');
	}
	if (function_exists('import_export')){
		import_export('add_options');
	}
	if (function_exists('frame_borders')){
		frame_borders('add_options');
	}
	if (function_exists('layout_panel')){
		layout_panel('add_options');
	}
	if (function_exists('top_bar')){
		top_bar('add_options');
	}
	if (function_exists('header_panel')){
		header_panel('add_options');
	}
	if (function_exists('nav_panel')){
		nav_panel('add_options');
	}
	if (function_exists('title_section_panel')){
		title_section_panel('add_options');
	}
	if (function_exists('footer_panel')){
		footer_panel('add_options');
	}
	if (function_exists('sidebar_panel')){
		sidebar_panel('add_options');
	}
	if (function_exists('append_scripts')){
		append_scripts('add_options');
	}
	if (function_exists('sidebar_generator')){
		sidebar_generator('add_options');
	}
	if (function_exists('latest_posts_page_panel')){
		latest_posts_page_panel('add_options');
	}
	if (function_exists('blog_pages_panel')){
		blog_pages_panel('add_options');
	}
	if (function_exists('categories_panel')){
		categories_panel('add_options');
	}
	if (function_exists('posts_panel')){
		posts_panel('add_options');
	}
	if (function_exists('google_fonts')){
		google_fonts('add_options');
	}
	if (function_exists('main_typography')){
		main_typography('add_options');
	}
	if (function_exists('portfolio_panel')){
		portfolio_panel('add_options');
	}
	if (function_exists('portfolio_items')){
		portfolio_items('add_options');
	}
	if (function_exists('woo_panel')){
		woo_panel('add_options');
	}
	if (function_exists('shop_panel')){
		shop_panel('add_options');
	}
	if (function_exists('products_panel')){
		products_panel('add_options');
	}
	if (function_exists('custom_css_admin')){
		custom_css_admin('add_options');
	}
	if (function_exists('colorbox_panel')){
		colorbox_panel('add_options');
	}
	if (function_exists('layout_colors_panel')){
		layout_colors_panel('add_options');
	}
	if (function_exists('main_elements_colors')){
		main_elements_colors('add_options');
	}
	if (function_exists('footer_colors')){
		footer_colors('add_options');
	}
	if (function_exists('top_sliding_colors')){
		top_sliding_colors('add_options');
	}
	if (function_exists('top_bar_colors')){
		top_bar_colors('add_options');
	}
}

if (!function_exists('geode_update_font_variants')) :
add_action('geode_update_font_variants', 'geode_update_font_variants');
function geode_update_font_variants(){
	$json = get_google_font_list();
	$decoded = json_decode($json);
	$families = get_option('pix_style_select_fonts');
	$newfam = array();
	foreach ( $decoded->items as $item ) {
		if (is_array($families) && in_array($item->family,$families)) {
			$newfam[$item->family]['variants'] = $item->variants;
			$newfam[$item->family]['subsets'] = $item->subsets;
		}
		update_option('pix_style_fonts_w_variants',$newfam);
	}
}
endif;


add_action('wp_ajax_data_save', 'pix_save_ajax');
function pix_save_ajax() {
	global $options;
	check_ajax_referer('geode_data', 'geode_security');

	$data = $_POST;
	unset($data['geode_security'], $data['action']);

	foreach ($_REQUEST as $key => $value) {
		$value = geode_remove_protocol($value);
		if ( preg_match("/pix_geode_array/", $key) ) {
			delete_option($key);
			if(!get_option($key)) {
				add_option($key, $value);
			} else {
				update_option($key, $value);
			}
		}
		if ( $key == 'pix_style_select_fonts' )
			do_action('geode_update_font_variants');
	}
	
	foreach ($_REQUEST as $key => $value) {
		$value = geode_remove_protocol($value);
		if( isset($_REQUEST[$key]) ) {
			update_option($key, $value);
			if ( $key == 'pix_style_select_fonts' )
				do_action('geode_update_font_variants');
		}
	}		

}

/**
 * Get the google font list.
 */
function get_google_font_list() {
	$path = WP_CONTENT_DIR .'/geode-includes/';
	$check_url = $path.'google-fonts.json';
	$dir = content_url() .'/geode-includes/';
	$request_url = $dir.'google-fonts.json';
	if ( get_option('pix_content_google_api_key')=='' || !file_exists($check_url) ) {
		$request_url = get_template_directory_uri().'/font/google-fonts.json';
	}

	$raw_response = wp_remote_get($request_url);

	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)) {
		$body = $raw_response['body'];
		return apply_filters( 'geode_google_font_list', $body );
	}

}

/**
 * The css compiler.
 */
add_action( 'schortcodelic_css_compiling', 'geode_compile_css_action' );
add_action( 'pixgridder_css_compiling', 'geode_compile_css_action' );
add_action( 'schortcodelic_css_ajax_compiling', 'geode_compile_css_action' );
add_action( 'pixgridder_css_ajax_compiling', 'geode_compile_css_action' );
function geode_compile_css_action() {
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	WP_Filesystem();
	global $wp_filesystem, $blog_id;

	if ( is_multisite() && $blog_id > 1 ) {
		$upload_dir = wp_upload_dir();
		$dir = $upload_dir['basedir'] .'/geode/';
		if (!is_dir($dir))
			@mkdir($dir);
		
		$css_file = $dir . 'css_compiled.css';
	} else {
		$css_file = get_template_directory().'/css/css_compiled.css';
	}

	$target_file = get_template_directory().'/css/css_compiler.php';

	ob_start();
	require($target_file);
	$css = ob_get_clean();

	$wp_filesystem->put_contents( $css_file, $css, FS_CHMOD_FILE );
	
}

function geode_compile_css() {
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	WP_Filesystem();
	global $wp_filesystem, $blog_id;

	if ( is_multisite() && $blog_id > 1 ) {
		$upload_dir = wp_upload_dir();
		$dir = $upload_dir['basedir'] .'/geode/';
		if (!is_dir($dir))
			@mkdir($dir);
		
		$css_file = $dir . 'css_compiled.css';
	} else {
		$css_file = get_template_directory().'/css/css_compiled.css';
	}

	$target_file = get_template_directory().'/css/css_compiler.php';

	ob_start();
	require($target_file);
	$css = ob_get_clean();

	$wp_filesystem->put_contents( $css_file, $css, FS_CHMOD_FILE );
	
	if ( class_exists( 'ShortCodelic' ) ) {
		$shortcodelic = new ShortCodelic();
		$shortcodelic->compile_css();
	}
	if ( class_exists( 'PixGridder' ) ) {
		$pixgridder = new PixGridder();
		$pixgridder->compile_css();
	}
}

/**
 * Font list updater.
 */
function update_google_font_list() {
	$dir = WP_CONTENT_DIR .'/geode-includes/';
	if (!is_dir($dir))
		@mkdir($dir);
	
	require_once(ABSPATH . 'wp-admin/includes/file.php');
	WP_Filesystem();
	global $wp_filesystem;

	if ( ! WP_Filesystem($wp_filesystem) ) {
		request_filesystem_credentials($url, '', true, false, null);
		return;
	}		

	$font_list = get_template_directory().'/font/google-fonts.json';

	if ( get_option('pix_content_google_api_key')!='' ) {
		$request_url = 'https://www.googleapis.com/webfonts/v1/webfonts?key='.get_option('pix_content_google_api_key');
	} else {
		$request_url = 'http://www.pixedelic.com/api/google-fonts.php';
	}

	if (is_dir($dir))
		$font_list = $dir.'/google-fonts.php';
	else
		$font_list = 'http://www.pixedelic.com/api/google-fonts.php';

	$raw_response = wp_remote_get($request_url);

	if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200)) {
		$body = $raw_response['body'];
		$wp_filesystem->put_contents( $font_list, $body, FS_CHMOD_FILE );
	}

}