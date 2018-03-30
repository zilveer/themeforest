<?php
/**
 * Active callback functions for the customizer
 *
 * @package Total WordPress Theme
 * @subpackage Customizer
 * @version 3.4.0
 */

/*-------------------------------------------------------------------------------*/
/* [ Table of contents ]
/*-------------------------------------------------------------------------------*

	# Core
	# Background
	# Togglebar
	# Topbar
	# Header
	# Logo
	# Menu
	# Blog
	# Portfolio
	# Staff
	# WooCommerce
	# Callout

/*-------------------------------------------------------------------------------*/
/* [ Core ]
/*-------------------------------------------------------------------------------*/

function wpex_cac_responsive() {
	if ( get_theme_mod( 'responsive', true ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_container_layout_supports_max_width() {
	if ( 'full-width' == get_theme_mod( 'main_layout_style', 'full-width' ) &&
		get_theme_mod( 'responsive', true ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_boxed_layout() {
	if ( 'boxed' == get_theme_mod( 'main_layout_style', 'full-width' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_hasnt_boxed_layout() {
	if ( 'boxed' == get_theme_mod( 'main_layout_style', 'full-width' ) ) {
		return false;
	} else {
		return true;
	}
}

function wpex_cac_has_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		return true;
	} else {
		return get_theme_mod( 'breadcrumbs', true );
	}
}

function wpex_cac_has_page_header() {
	if ( 'hidden' != get_theme_mod( 'page_header_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_scrolltop() {
	return get_theme_mod( 'scroll_top', true );
}

function wpex_cac_has_footer_widgets() {
	return get_theme_mod( 'footer_widgets', true );
}

function wpex_cac_supports_reveal() {
	if ( wpex_cac_has_footer_widgets() && ! wpex_cac_has_vertical_header() ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_footer_bottom() {
	return get_theme_mod( 'footer_bottom', true );
}

function wpex_cac_page_header_has_bg_image() {
	if ( get_theme_mod( 'page_header_background_img', null ) ) {
		return 'true';
	} else {
		return false;
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Background ]
/*-------------------------------------------------------------------------------*/

function wpex_cac_has_background_image() {
	return get_theme_mod( 'background_image' );
}

function wpex_cac_hasnt_background_image() {
	if ( get_theme_mod( 'background_image' ) ) {
		return false;
	} else {
		return true;
	}
}

function wpex_cac_hasnt_background_pattern() {
	if ( get_theme_mod( 'background_pattern' ) ) {
		return false;
	} else {
		return true;
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Togglebar ]
/*-------------------------------------------------------------------------------*/

function wpex_cac_has_togglebar() {
	return get_theme_mod( 'toggle_bar', true );
}

function wpex_cac_has_togglebar_animation() {
	if ( get_theme_mod( 'toggle_bar', true ) && 'overlay' == get_theme_mod( 'toggle_bar_display', 'overlay' ) ) {
		return true;
	} else {
		return false;
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Topbar ]
/*-------------------------------------------------------------------------------*/

function wpex_cac_has_topbar() {
	return get_theme_mod( 'top_bar', true );
}

function wpex_cac_has_topbar_social() {
	if ( wpex_cac_has_topbar()
		&& get_theme_mod( 'top_bar_social' )
		&& ! get_theme_mod( 'top_bar_social_alt' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_topbar_social_style_is_none() {
	if ( wpex_cac_has_topbar_social() && 'none' == get_theme_mod( 'top_bar_social_style' ) ) {
		return true;
	} else {
		return false;
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Header ]
/*-------------------------------------------------------------------------------*/

function wpex_cac_header_supports_fixed_header() {
	$header_style = get_theme_mod( 'header_style' );
	$header_style = $header_style ? $header_style : 'one';
	if ( 'one' == $header_style || 'five' == $header_style ) {
		return true;
	} else {
		return false;
	}
}


function wpex_cac_has_fixed_header() {
	if ( wpex_cac_header_supports_fixed_header() && 'disabled' != get_theme_mod( 'fixed_header_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_fixed_header_logo() {
	if ( wpex_cac_has_fixed_header() && get_theme_mod( 'fixed_header_logo' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_fixed_header_shrink() {
	$style = get_theme_mod( 'fixed_header_style' );
	if ( wpex_cac_header_supports_fixed_header()
		&& ( 'shrink' == $style || 'shrink_animated' == $style )
	) {
		return true;
	} else {
		return false;
	}
}

function wpex_supports_fixed_header_logo_retina_height() {
	if ( wpex_cac_has_fixed_header_logo() && ! wpex_cac_has_fixed_header_shrink() ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_vertical_header() {
	if ( 'six' == get_theme_mod( 'header_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_hasnt_vertical_header() {
	if ( 'six' == get_theme_mod( 'header_style' ) ) {
		return false;
	} else {
		return true;
	}
}

function wpex_cac_header_has_aside() {
	$style = get_theme_mod( 'header_style', 'one' );
	if ( 'two' == $style || 'three' == $style || 'four' == $style ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_header_has_aside_search() {
	if ( 'two' == get_theme_mod( 'header_style', 'one'  ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_header_supports_fixed_menu() {
	$header_style = get_theme_mod( 'header_style' );
	$header_style = $header_style ? $header_style : 'one';
	if ( 'two' == $header_style
		|| 'three' == $header_style
		|| 'four' == $header_style
	) {
		return true;
	} else {
		return false;
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Logo ]
/*-------------------------------------------------------------------------------*/

function wpex_cac_has_image_logo() {
	if ( get_theme_mod( 'custom_logo' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_supports_fixed_header_logo() {
	if ( wpex_cac_has_fixed_header() && wpex_cac_has_image_logo() ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_hasnt_custom_logo() {
	if ( get_theme_mod( 'custom_logo' ) ) {
		return false;
	} else {
		return true;
	}
}

function wpex_cac_has_retina_logo() {
	if ( get_theme_mod( 'custom_logo' ) && get_theme_mod( 'retina_logo' ) ) {
		return true;
	} else {
		return false;
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Menu ]
/*-------------------------------------------------------------------------------*/

function wpex_cac_has_mobile_menu() {
	if ( 'disabled' != get_theme_mod( 'mobile_menu_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_is_mobile_toggle_fixed_top() {
	if ( 'fixed_top' == get_theme_mod( 'mobile_menu_toggle_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_is_mobile_fixed_or_navbar() {
	$style = get_theme_mod( 'mobile_menu_toggle_style' );
	if ( 'fixed_top' == $style || 'navbar' == $style ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_mobile_menu_is_sidr() {
	if ( 'sidr' == get_theme_mod( 'mobile_menu_style', 'sidr' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_mobile_menu_is_full_screen() {
	if ( 'full_screen' == get_theme_mod( 'mobile_menu_style', 'sidr' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_mobile_menu_is_toggle() {
	if ( 'toggle' == get_theme_mod( 'mobile_menu_style', 'sidr' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_mobile_menu_icons() {
	$style = get_theme_mod( 'mobile_menu_toggle_style', 'icon_buttons' );
	if ( 'disabled' != get_theme_mod( 'mobile_menu_style' )
		&& ( 'icon_buttons' == $style || 'icon_buttons_under_logo' == $style )
	) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_navbar_supports_flush_dropdowns() {
	if ( 'one' == get_theme_mod( 'header_style' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_menu_search_dropdown() {
	if ( 'six' == get_theme_mod( 'header_style' )
		|| 'drop_down' != get_theme_mod( 'menu_search_style' )
	) {
		return false;
	} else {
		return true;
	}
}

function wpex_cac_has_menu_dropdown_top_border() {
	return get_theme_mod( 'menu_dropdown_top_border', false );
}

function wpex_cac_has_menu_pointer() {
	if ( get_theme_mod( 'menu_dropdown_style' ) ) {
		return false;
	} elseif ( 'one' != get_theme_mod( 'header_style' ) ) {
		return false;
	} elseif ( get_theme_mod( 'menu_flush_dropdowns' ) ) {
		return false;
	} else {
		return true;
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Blog ]
/*-------------------------------------------------------------------------------*/

function wpex_cac_blog_page_header_custom_text() {
	if ( 'custom_text' == get_theme_mod( 'blog_single_header', 'custom_text' ) ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_grid_blog_style() {
	$style = get_theme_mod( 'blog_style' );
	if ( 'grid-entry-style' == $style || 'grid' == $style ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_blog_supports_equal_heights() {
	if ( wpex_cac_grid_blog_style() && 'masonry' != get_theme_mod( 'blog_grid_style' ) ) {
		return true;
	} else {
		return false;
	}
}


function wpex_cac_has_blog_related() {
	$pos = strpos( get_theme_mod( 'blog_single_composer', 'related_posts' ), 'related_posts' );
	if ( $pos !== false ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_blog_meta() {
	$pos = strpos( get_theme_mod( 'blog_single_composer', 'meta' ), 'meta' );
	if ( $pos !== false ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_blog_entry_meta() {
	$pos = strpos( get_theme_mod( 'blog_entry_composer', 'meta' ), 'meta' );
	if ( $pos !== false ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_blog_single_media() {
	$pos = strpos( get_theme_mod( 'blog_single_composer', 'featured_media' ), 'featured_media' );
	if ( $pos !== false ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_blog_entry_media() {
	$pos = strpos( get_theme_mod( 'blog_entry_composer', 'featured_media' ), 'featured_media' );
	if ( $pos !== false ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_blog_entry_excerpt() {
	$pos = strpos( get_theme_mod( 'blog_entry_composer', 'excerpt_content' ), 'excerpt_content' );
	if ( $pos !== false ) {
		return true;
	} else {
		return false;
	}
}

function wpex_cac_has_blog_entry_readmore() {
	$pos = strpos( get_theme_mod( 'blog_entry_composer', 'readmore' ), 'readmore' );
	if ( $pos !== false ) {
		return true;
	} else {
		return false;
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Portfolio ]
/*-------------------------------------------------------------------------------*/

function wpex_cac_has_portfolio_related() {
	$pos = strpos( get_theme_mod( 'portfolio_post_composer', 'related' ), 'related' );
	if ( $pos !== false ) {
		return true;
	} else {
		return false;
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Staff ]
/*-------------------------------------------------------------------------------*/

function wpex_cac_has_staff_related() {
	$pos = strpos( get_theme_mod( 'staff_post_composer', 'related' ), 'related' );
	if ( $pos !== false ) {
		return true;
	} else {
		return false;
	}
}

/*-------------------------------------------------------------------------------*/
/* [ Callout ]
/*-------------------------------------------------------------------------------*/
function wpex_cac_has_callout() {
	return get_theme_mod( 'callout', true );
}

function wpex_cac_callout_has_button() {
	if ( wpex_cac_has_callout() && get_theme_mod( 'callout_link', true ) ) {
		return true;
	} else {
		return false;
	}
}