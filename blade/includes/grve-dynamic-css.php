<?php
/**
 *  Dynamic css style
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */

$css = "";


/* =========================================================================== */

/* Body
/* Container Size
/* Boxed Size
/* Single Post Content Width
/* Top Bar

/* Default Header
	/* - Default Header Colors
	/* - Default Header Menu Colors
	/* - Default Header Sub Menu Colors
	/* - Default Header Layout
	/* - Default Header Overlaping

/* Logo On Top Header
	/* - Logo On Top Header Colors
	/* - Logo On Top Header Menu Colors
	/* - Logo On Top Header Sub Menu Colors
	/* - Logo On Top Header Layout
	/* - Logo On Top Header Overlaping

/* Light Header
/* Dark Header

/* Sticky Header
	/* - Sticky Default Header
	/* - Sticky Logo On Top Header
	/* - Sticky Header Colors

/* Side Area Colors
/* Modals Colors

/* Responsive Header
	/* - Header Layout
	/* - Responsive Menu
	/* - Responsive Header Elements

/* Spinner
/* Primary Text Color
/* Primary Bg Color
/* Anchor Menu
/* Breadcrumbs
/* Main Content
	/* - Main Content Borders
	/* - Widget Colors
/* Footer
	/* - Widget Area
	/* - Footer Widget Colors
	/* - Footer Bar Colors

/* Post Bar ( Socials & Navigations )



/* =========================================================================== */


/* Body
============================================================================= */
$css .= "
a {
	color: " . blade_grve_option( 'body_text_link_color' ) . ";

}

a:hover {
	color: " . blade_grve_option( 'body_text_link_hover_color' ) . ";
}
";

/* Container Size
============================================================================= */
$css .= "

.grve-container,
#disqus_thread,
#grve-content.grve-left-sidebar .grve-content-wrapper,
#grve-content.grve-right-sidebar .grve-content-wrapper {
	max-width: " . blade_grve_option( 'container_size', 1170 ) . "px;
}

@media only screen and (min-width: 960px) {

	#grve-theme-wrapper.grve-header-side .grve-container,
	#grve-theme-wrapper.grve-header-side #grve-content.grve-left-sidebar .grve-content-wrapper,
	#grve-theme-wrapper.grve-header-side #grve-content.grve-right-sidebar .grve-content-wrapper {
		width: 90%;
		max-width: " . blade_grve_option( 'container_size', 1170 ) . "px;
	}

}

";

/* Boxed Size
============================================================================= */
$css .= "

body.grve-boxed #grve-theme-wrapper {
	width: " . blade_grve_option( 'boxed_size', 1220 ) . "px;
}

#grve-body.grve-boxed #grve-header.grve-fixed #grve-main-header,
#grve-body.grve-boxed .grve-anchor-menu .grve-anchor-wrapper.grve-sticky,
#grve-body.grve-boxed #grve-footer.grve-fixed-footer {
	max-width: " . blade_grve_option( 'boxed_size', 1220 ) . "px;
}

";


/* Single Post Content Width
============================================================================= */
if ( is_singular( 'post' ) ) {
	$grve_post_content_width = blade_grve_post_meta( 'grve_post_content_width', blade_grve_option( 'post_content_width', 990 ) );

$css .= "

.single-post #grve-content:not(.grve-right-sidebar):not(.grve-left-sidebar) .grve-container {
	max-width: " . esc_attr( $grve_post_content_width ) . "px;
}

";

}


/* Top Bar
============================================================================= */
$css .= "

#grve-top-bar,
#grve-top-bar .grve-language > li > ul,
#grve-top-bar .grve-top-bar-menu ul.sub-menu {
	background-color: " . blade_grve_option( 'top_bar_bg_color' ) . ";
	color: " . blade_grve_option( 'top_bar_font_color' ) . ";
}

#grve-top-bar a {
	color: " . blade_grve_option( 'top_bar_link_color' ) . ";
}

#grve-top-bar a:hover {
	color: " . blade_grve_option( 'top_bar_hover_color' ) . ";
}

";


/* Default Header
============================================================================= */
$grve_header_mode = blade_grve_option( 'header_mode', 'default' );
if ( 'default' == $grve_header_mode ) {

	/* - Default Header Colors
	============================================================================= */

	$grve_default_header_background_color = blade_grve_option( 'default_header_background_color', '#ffffff' );
	$grve_default_header_border_color = blade_grve_option( 'default_header_border_color', '#000000' );
	$css .= "

	#grve-main-header {
		background-color: rgba(" . blade_grve_hex2rgb( $grve_default_header_background_color ) . "," . blade_grve_option( 'default_header_background_color_opacity', '1') . ");
	}

	#grve-main-header.grve-transparent,
	#grve-main-header.grve-light,
	#grve-main-header.grve-dark {
		background-color: transparent;
	}

	#grve-main-header.grve-header-default .grve-header-elements-wrapper:before {
		background: -moz-linear-gradient(top,  rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . ",0) 5%, rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . "," . blade_grve_option( 'default_header_border_color_opacity', '1') . ") 30%, rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . "," . blade_grve_option( 'default_header_border_color_opacity', '1') . ") 70%, rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . ",0) 95%);
		background: -webkit-linear-gradient(top,  rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . ",0) 5%, rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . "," . blade_grve_option( 'default_header_border_color_opacity', '1') . ") 30%, rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . "," . blade_grve_option( 'default_header_border_color_opacity', '1') . ") 70%, rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . ",0) 95%);
		background: linear-gradient(to bottom,  rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . ",0) 5%, rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . "," . blade_grve_option( 'default_header_border_color_opacity', '1') . ") 30%, rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . "," . blade_grve_option( 'default_header_border_color_opacity', '1') . ") 70%, rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . ",0) 95%);
	}

	#grve-main-header.grve-header-default {
		border-color: rgba(" . blade_grve_hex2rgb( $grve_default_header_border_color ) . "," . blade_grve_option( 'default_header_border_color_opacity', '1') . ");
	}

	";

	/* - Default Header Menu Colors
	========================================================================= */
	$css .= "
	#grve-main-menu .grve-wrapper > ul > li > a,
	.grve-header-element > a,
	.grve-header-element .grve-purchased-items {
		color: " . blade_grve_option( 'default_header_menu_text_color' ) . ";

	}

	#grve-main-menu .grve-wrapper > ul > li.grve-current > a,
	#grve-main-menu .grve-wrapper > ul > li.current-menu-item > a,
	#grve-main-menu .grve-wrapper > ul > li.current-menu-ancestor > a,
	#grve-main-menu .grve-wrapper > ul > li:hover > a,
	.grve-header-element > a:hover {
		color: " . blade_grve_option( 'default_header_menu_text_hover_color' ) . ";
	}

	#grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li.current-menu-item > a span,
	#grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li.current-menu-ancestor > a span {
		border-color: " . blade_grve_option( 'default_header_menu_type_color' ) . ";
	}

	#grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li:hover > a span,
	#grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li.active > a span {
		border-color: " . blade_grve_option( 'default_header_menu_type_color_hover' ) . ";
	}

	#grve-main-menu.grve-menu-type-underline .grve-wrapper > ul > li > a span:after {
		background-color: " . blade_grve_option( 'default_header_menu_type_color' ) . ";
	}

	#grve-main-menu.grve-menu-type-underline .grve-wrapper > ul > li:hover > a span:after,
	#grve-main-menu.grve-menu-type-underline .grve-wrapper > ul > li.active > a span:after {
		background-color: " . blade_grve_option( 'default_header_menu_type_color_hover' ) . ";
	}

	";


	/* - Default Header Sub Menu Colors
	========================================================================= */
	$css .= "
	#grve-main-menu .grve-wrapper > ul > li ul  {
		background-color: " . blade_grve_option( 'default_header_submenu_bg_color' ) . ";
	}

	#grve-main-menu .grve-wrapper > ul > li ul li a,
	#grve-main-header.grve-light #grve-main-menu .grve-wrapper > ul > li.megamenu > ul > li:hover > a {
		color: " . blade_grve_option( 'default_header_submenu_text_color' ) . ";
	}

	#grve-main-menu .grve-wrapper > ul > li ul li a:hover,
	#grve-main-menu .grve-wrapper > ul > li ul li.current-menu-item > a,
	#grve-main-menu .grve-wrapper > ul li li.current-menu-ancestor > a {
		color: " . blade_grve_option( 'default_header_submenu_text_hover_color' ) . ";
		background-color: " . blade_grve_option( 'default_header_submenu_text_bg_hover_color' ) . ";
	}

	#grve-main-menu .grve-wrapper > ul > li.megamenu > ul > li > a {
		color: " . blade_grve_option( 'default_header_submenu_column_text_color' ) . ";
		background-color: transparent;
	}

	#grve-main-menu .grve-wrapper > ul > li.megamenu > ul > li:hover > a {
		color: " . blade_grve_option( 'default_header_submenu_column_text_hover_color' ) . ";
	}

	#grve-main-menu.grve-horizontal-menu .grve-wrapper > ul > li.megamenu > ul > li {
		border-color: " . blade_grve_option( 'default_header_submenu_border_color' ) . ";
	}

	#grve-main-menu .grve-wrapper > ul > li ul li.grve-menu-type-button a {
		background-color: transparent;
	}

	";

	/* - Default Header Layout
	========================================================================= */
	$css .= "
	#grve-main-header,
	.grve-logo {
		height: " . blade_grve_option( 'header_height', 120 ) . "px;
	}

	.grve-logo a {
		height: " . blade_grve_option( 'logo_height', 20 ) . "px;
	}

	#grve-main-menu .grve-wrapper > ul > li > a,
	.grve-header-element > a,
	.grve-no-assigned-menu {
		line-height: " . blade_grve_option( 'header_height', 120 ) . "px;
	}

	.grve-logo .grve-wrapper img {
		padding-top: 0;
		padding-bottom: 0;
	}

	";

	/* Go to section Position */
	$css .= "
	#grve-theme-wrapper.grve-feature-below #grve-goto-section-wrapper {
		margin-bottom: " . blade_grve_option( 'header_height', 120 ) . "px;
	}
	";

	/* - Default Header Overlaping
	========================================================================= */
	$css .= "
	@media only screen and (min-width: 1024px) {
		#grve-header.grve-overlapping + .grve-page-title,
		#grve-header.grve-overlapping + #grve-feature-section,
		#grve-header.grve-overlapping + #grve-content,
		#grve-header.grve-overlapping + #grve-breadcrumbs,
		#grve-header.grve-overlapping + .grve-single-wrapper {
			top: -" . blade_grve_option( 'header_height', 120 ) . "px;
			margin-bottom: -" . blade_grve_option( 'header_height', 120 ) . "px;
		}

		#grve-feature-section + #grve-header.grve-overlapping {
			top: -" . blade_grve_option( 'header_height', 120 ) . "px;
		}

		#grve-header.grve-overlapping + .grve-page-title .grve-wrapper,
		#grve-header.grve-overlapping + #grve-feature-section .grve-wrapper {
			padding-top: " . intval( blade_grve_option( 'header_height', 120 ) / 2 ) . "px;
		}

		#grve-header.grve-overlapping + #grve-breadcrumbs .grve-wrapper {
			padding-top: " . blade_grve_option( 'header_height', 120 ) . "px;
		}

		#grve-header {
			height: " . blade_grve_option( 'header_height', 120 ) . "px;
		}

	}

	";
	/* Sticky Sidebar with header overlaping */
	$css .= "
	@media only screen and (min-width: 1024px) {
		#grve-header.grve-overlapping + #grve-content .grve-sidebar.grve-fixed-sidebar,
		#grve-header.grve-overlapping + .grve-single-wrapper .grve-sidebar.grve-fixed-sidebar {
			top: " . blade_grve_option( 'header_height', 120 ) . "px;
		}

	}
	";

/* Logo On Top Header
============================================================================= */
} else if ( 'logo-top' == $grve_header_mode ) {


	/* - Logo On Top Header Colors
	============================================================================= */
	$grve_logo_top_logo_area_background_color = blade_grve_option( 'logo_top_header_logo_area_background_color', '#ffffff' );
	$grve_logo_top_menu_area_background_color = blade_grve_option( 'logo_top_header_menu_area_background_color', '#ffffff' );
	$css .= "

	#grve-main-header #grve-top-header {
		background-color: rgba(" . blade_grve_hex2rgb( $grve_logo_top_logo_area_background_color ) . "," . blade_grve_option( 'logo_top_header_logo_area_background_color_opacity', '1') . ");
	}

	#grve-main-header #grve-bottom-header {
		background-color: rgba(" . blade_grve_hex2rgb( $grve_logo_top_menu_area_background_color ) . "," . blade_grve_option( 'logo_top_header_menu_area_background_color_opacity', '1') . ");
	}

	#grve-main-header.grve-transparent #grve-top-header,
	#grve-main-header.grve-light #grve-top-header,
	#grve-main-header.grve-dark #grve-top-header,

	#grve-main-header.grve-transparent #grve-bottom-header,
	#grve-main-header.grve-light #grve-bottom-header,
	#grve-main-header.grve-dark #grve-bottom-header {
		background-color: transparent;
	}

	";

	/* - Logo On Top Header Menu Colors
	========================================================================= */
	$css .= "
	#grve-main-menu .grve-wrapper > ul > li > a,
	.grve-header-element > a,
	.grve-header-element .grve-purchased-items {
		color: " . blade_grve_option( 'logo_top_header_menu_text_color' ) . ";

	}

	#grve-main-menu .grve-wrapper > ul > li.grve-current > a,
	#grve-main-menu .grve-wrapper > ul > li.current-menu-item > a,
	#grve-main-menu .grve-wrapper > ul > li.current-menu-ancestor > a,
	#grve-main-menu .grve-wrapper > ul > li:hover > a,
	.grve-header-element > a:hover {
		color: " . blade_grve_option( 'logo_top_header_menu_text_hover_color' ) . ";
	}

	#grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li.current-menu-item > a span,
	#grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li.current-menu-ancestor > a span {
		border-color: " . blade_grve_option( 'logo_top_header_menu_type_color' ) . ";
	}

	#grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li:hover > a span,
	#grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li.active > a span {
		border-color: " . blade_grve_option( 'logo_top_header_menu_type_color_hover' ) . ";
	}

	#grve-main-menu.grve-menu-type-underline .grve-wrapper > ul > li > a span:after {
		background-color: " . blade_grve_option( 'logo_top_header_menu_type_color' ) . ";
	}

	#grve-main-menu.grve-menu-type-underline .grve-wrapper > ul > li:hover > a span:after,
	#grve-main-menu.grve-menu-type-underline .grve-wrapper > ul > li.active > a span:after {
		background-color: " . blade_grve_option( 'logo_top_header_menu_type_color_hover' ) . ";
	}


	";


	/* - Logo On Top Header Sub Menu Colors
	========================================================================= */
	$css .= "
	#grve-main-menu .grve-wrapper > ul > li ul  {
		background-color: " . blade_grve_option( 'logo_top_header_submenu_bg_color' ) . ";
	}

	#grve-main-menu .grve-wrapper > ul > li ul li a,
	#grve-main-header.grve-light #grve-main-menu .grve-wrapper > ul > li.megamenu > ul > li:hover > a {
		color: " . blade_grve_option( 'logo_top_header_submenu_text_color' ) . ";
	}

	#grve-main-menu .grve-wrapper > ul > li ul li a:hover,
	#grve-main-menu .grve-wrapper > ul > li ul li.current-menu-item > a,
	#grve-main-menu .grve-wrapper > ul li li.current-menu-ancestor > a {
		color: " . blade_grve_option( 'logo_top_header_submenu_text_hover_color' ) . ";
		background-color: " . blade_grve_option( 'logo_top_header_submenu_text_bg_hover_color' ) . ";
	}

	#grve-main-menu .grve-wrapper > ul > li.megamenu > ul > li > a {
		color: " . blade_grve_option( 'logo_top_header_submenu_column_text_color' ) . ";
		background-color: transparent;
	}

	#grve-main-menu .grve-wrapper > ul > li.megamenu > ul > li:hover > a {
		color: " . blade_grve_option( 'logo_top_header_submenu_column_text_hover_color' ) . ";
	}

	#grve-main-menu.grve-horizontal-menu .grve-wrapper > ul > li.megamenu > ul > li {
		border-color: " . blade_grve_option( 'logo_top_header_submenu_border_color' ) . ";
	}

	";

	/* - Logo On Top Header Layout
	========================================================================= */
	$grve_header_height = intval( blade_grve_option( 'header_top_height', 120 ) ) + intval( blade_grve_option( 'header_bottom_height', 50 ) );
	$css .= "

	#grve-top-header,
	.grve-logo {
		height: " . blade_grve_option( 'header_top_height', 120 ) . "px;
	}

	@media only screen and (min-width: 1024px) {
		#grve-header {
			height: " . $grve_header_height . "px;
		}
	}

	.grve-logo a {
		height: " . blade_grve_option( 'header_top_logo_height', 30 ) . "px;
	}

	#grve-bottom-header,
	#grve-main-menu {
		height: " . blade_grve_option( 'header_bottom_height', 50 ) . "px;
	}

	#grve-main-menu .grve-wrapper > ul > li > a,
	.grve-header-element > a,
	.grve-no-assigned-menu {
		line-height: " . blade_grve_option( 'header_bottom_height', 50 ) . "px;
	}

	";

	/* Go to section Position */
	$css .= "
	#grve-theme-wrapper.grve-feature-below #grve-goto-section-wrapper {
		margin-bottom: " . $grve_header_height . "px;
	}
	";

	/* - Logo On Top Header Overlaping
	========================================================================= */
	$css .= "

	@media only screen and (min-width: 1024px) {
		#grve-header.grve-overlapping + * {
			top: -" . $grve_header_height . "px;
			margin-bottom: -" . $grve_header_height . "px;
		}

		#grve-feature-section + #grve-header.grve-overlapping {
			top: -" . $grve_header_height . "px;
		}

		#grve-header.grve-overlapping + .grve-page-title .grve-wrapper,
		#grve-header.grve-overlapping + #grve-feature-section .grve-wrapper {

		}

		#grve-header.grve-overlapping + * .grve-wrapper {
			padding-top: " . $grve_header_height . "px;
		}

	}
	";

	/* Sticky Sidebar with header overlaping */
	$css .= "
	@media only screen and (min-width: 1024px) {
		#grve-header.grve-overlapping + #grve-content .grve-sidebar.grve-fixed-sidebar,
		#grve-header.grve-overlapping + .grve-single-wrapper .grve-sidebar.grve-fixed-sidebar {
			top: " . blade_grve_option( 'header_height', 120 ) . "px;
		}

	}
	";

} else {

	/* - Side Header Colors
	============================================================================= */
	$grve_side_header_background_color = blade_grve_option( 'side_header_background_color', '#ffffff' );
	$css .= "

	#grve-main-header {
		background-color: rgba(" . blade_grve_hex2rgb( $grve_side_header_background_color ) . "," . blade_grve_option( 'side_header_background_color_opacity', '1') . ");
	}

	#grve-main-header.grve-transparent,
	#grve-main-header.grve-light,
	#grve-main-header.grve-dark {
		background-color: transparent;
	}

	";

	/* - Side Header Menu Colors
	========================================================================= */
	$css .= "
	#grve-main-menu .grve-wrapper > ul > li > a,
	.grve-header-element > a,
	.grve-header-element .grve-purchased-items {
		color: " . blade_grve_option( 'side_header_menu_text_color' ) . ";

	}

	#grve-main-menu .grve-wrapper > ul > li.current-menu-item > a,
	#grve-main-menu .grve-wrapper > ul > li.current-menu-ancestor > a,
	#grve-main-menu .grve-wrapper > ul > li:hover > a,
	.grve-header-element > a:hover ,
	#grve-main-menu .grve-wrapper > ul > li ul li.grve-goback a {
		color: " . blade_grve_option( 'side_header_menu_text_hover_color' ) . ";
	}

	";


	/* - Side Header Sub Menu Colors
	========================================================================= */
	$grve_side_header_border_color = blade_grve_option( 'side_header_border_color', '#ffffff' );
	$css .= "

	#grve-main-menu .grve-wrapper > ul > li ul li a,
	#grve-main-header.grve-light #grve-main-menu .grve-wrapper > ul > li.megamenu > ul > li:hover > a {
		color: " . blade_grve_option( 'side_header_submenu_text_color' ) . ";
	}

	#grve-main-menu .grve-wrapper > ul > li ul li a:hover,
	#grve-main-menu .grve-wrapper > ul > li ul li.current-menu-item > a {
		color: " . blade_grve_option( 'side_header_submenu_text_hover_color' ) . ";
	}

	#grve-main-menu.grve-vertical-menu  ul li a,
	#grve-main-header.grve-header-side .grve-header-elements {
		border-color: rgba(" . blade_grve_hex2rgb( $grve_side_header_border_color ) . "," . blade_grve_option( 'side_header_border_opacity', '1') . ");
	}

	";

	/* - Side Header Layout
	========================================================================= */
	$css .= "

	.grve-logo a {
		height: " . blade_grve_option( 'header_side_logo_height', 30 ) . "px;
	}

	@media only screen and (min-width: 1024px) {
		#grve-theme-wrapper.grve-header-side,
		#grve-footer.grve-fixed-footer {
			padding-left: " . blade_grve_option( 'header_side_width', 120 ) . "px;
		}

		#grve-main-header.grve-header-side {
			width: " . blade_grve_option( 'header_side_width', 120 ) . "px;
		}

		body.grve-boxed #grve-theme-wrapper.grve-header-side #grve-main-header.grve-header-side,
		#grve-footer.grve-fixed-footer {
			margin-left: -" . blade_grve_option( 'header_side_width', 120 ) . "px;
		}
		#grve-main-header.grve-header-side .grve-main-header-wrapper {
			width: " . intval( blade_grve_option( 'header_side_width', 120 ) + 30 ) . "px;
		}
	}

	";
}

/* Light Header
============================================================================= */
$grve_light_header_border_color = blade_grve_option( 'light_header_border_color', '#ffffff' );
$css .= "
#grve-main-header.grve-light #grve-main-menu .grve-wrapper > ul > li > a,
#grve-main-header.grve-light .grve-header-element > a,
#grve-main-header.grve-light .grve-header-element .grve-purchased-items {
	color: #ffffff;
}

#grve-main-header.grve-light #grve-main-menu .grve-wrapper > ul > li.grve-current > a,
#grve-main-header.grve-light #grve-main-menu .grve-wrapper > ul > li.current-menu-item > a,
#grve-main-header.grve-light #grve-main-menu .grve-wrapper > ul > li:hover > a,
#grve-main-header.grve-light #grve-main-menu .grve-wrapper > ul > li.current-menu-item > a,
#grve-main-header.grve-light #grve-main-menu .grve-wrapper > ul > li.current-menu-ancestor > a,
#grve-main-header.grve-light .grve-header-element > a:hover {
	color: " . blade_grve_option( 'light_menu_text_hover_color' ) . ";
}

#grve-main-header.grve-light #grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li.current-menu-item > a span,
#grve-main-header.grve-light #grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li.current-menu-ancestor > a span,
#grve-main-header.grve-light #grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li:hover > a span {
	border-color: " . blade_grve_option( 'light_menu_type_color_hover' ) . ";
}

#grve-main-header.grve-light #grve-main-menu.grve-menu-type-underline .grve-wrapper > ul > li > a span:after,
#grve-main-header.grve-light #grve-main-menu.grve-menu-type-underline .grve-wrapper > ul > li:hover > a span:after {
	background-color: " . blade_grve_option( 'light_menu_type_color_hover' ) . ";
}

#grve-main-header.grve-header-default.grve-light .grve-header-elements-wrapper:before {
	background: -moz-linear-gradient(top,  rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . ",0) 5%, rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . "," . blade_grve_option( 'light_header_border_color_opacity', '1') . ") 30%, rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . "," . blade_grve_option( 'light_header_border_color_opacity', '1') . ") 70%, rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . ",0) 95%);
	background: -webkit-linear-gradient(top,  rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . ",0) 5%, rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . "," . blade_grve_option( 'light_header_border_color_opacity', '1') . ") 30%, rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . "," . blade_grve_option( 'light_header_border_color_opacity', '1') . ") 70%, rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . ",0) 95%);
	background: linear-gradient(to bottom,  rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . ",0) 5%, rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . "," . blade_grve_option( 'light_header_border_color_opacity', '1') . ") 30%, rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . "," . blade_grve_option( 'light_header_border_color_opacity', '1') . ") 70%, rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . ",0) 95%);
}

#grve-main-header.grve-header-default.grve-light {
	border-color: rgba(" . blade_grve_hex2rgb( $grve_light_header_border_color ) . "," . blade_grve_option( 'light_header_border_color_opacity', '1') . ");
}

";

/* Dark Header
============================================================================= */
$grve_dark_header_border_color = blade_grve_option( 'dark_header_border_color', '#ffffff' );
$css .= "
#grve-main-header.grve-dark #grve-main-menu .grve-wrapper > ul > li > a,
#grve-main-header.grve-dark .grve-header-element > a,
#grve-main-header.grve-dark .grve-header-element .grve-purchased-items {
	color: #000000;
}

#grve-main-header.grve-dark #grve-main-menu .grve-wrapper > ul > li.grve-current > a,
#grve-main-header.grve-dark #grve-main-menu .grve-wrapper > ul > li.current-menu-item > a,
#grve-main-header.grve-dark #grve-main-menu .grve-wrapper > ul > li:hover > a,
#grve-main-header.grve-dark #grve-main-menu .grve-wrapper > ul > li.current-menu-item > a,
#grve-main-header.grve-dark #grve-main-menu .grve-wrapper > ul > li.current-menu-ancestor > a,
#grve-main-header.grve-dark .grve-header-element > a:hover {
	color: " . blade_grve_option( 'dark_menu_text_hover_color' ) . ";
}

#grve-main-header.grve-dark #grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li.current-menu-item > a span,
#grve-main-header.grve-dark #grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li.current-menu-ancestor > a span,
#grve-main-header.grve-dark #grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li:hover > a span {
	border-color: " . blade_grve_option( 'dark_menu_type_color_hover' ) . ";
}

#grve-main-header.grve-dark #grve-main-menu.grve-menu-type-underline .grve-wrapper > ul > li > a span:after,
#grve-main-header.grve-dark #grve-main-menu.grve-menu-type-underline .grve-wrapper > ul > li:hover > a span:after {
	background-color: " . blade_grve_option( 'dark_menu_type_color_hover' ) . ";
}

#grve-main-header.grve-header-default.grve-dark .grve-header-elements-wrapper:before {
	background: -moz-linear-gradient(top,  rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . ",0) 5%, rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . "," . blade_grve_option( 'dark_header_border_color_opacity', '1') . ") 30%, rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . "," . blade_grve_option( 'dark_header_border_color_opacity', '1') . ") 70%, rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . ",0) 95%);
	background: -webkit-linear-gradient(top,  rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . ",0) 5%, rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . "," . blade_grve_option( 'dark_header_border_color_opacity', '1') . ") 30%, rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . "," . blade_grve_option( 'dark_header_border_color_opacity', '1') . ") 70%, rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . ",0) 95%);
	background: linear-gradient(to bottom,  rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . ",0) 5%, rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . "," . blade_grve_option( 'dark_header_border_color_opacity', '1') . ") 30%, rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . "," . blade_grve_option( 'dark_header_border_color_opacity', '1') . ") 70%, rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . ",0) 95%);
}

#grve-main-header.grve-header-default.grve-dark {
	border-color: rgba(" . blade_grve_hex2rgb( $grve_dark_header_border_color ) . "," . blade_grve_option( 'dark_header_border_color_opacity', '1') . ");
}

";


/* Sticky Header
============================================================================= */

	/* - Sticky Default Header
	========================================================================= */
	if ( 'default' == $grve_header_mode ) {
		$css .= "
			#grve-header.grve-sticky-header.grve-shrink #grve-main-header,
			#grve-header.grve-sticky-header.grve-advanced #grve-main-header {
				height: " . blade_grve_option( 'header_sticky_shrink_height', 60 ) . "px;
			}
			#grve-header.grve-sticky-header.grve-shrink .grve-logo,
			#grve-header.grve-sticky-header.grve-advanced .grve-logo {
				height: " . blade_grve_option( 'header_sticky_shrink_height', 60 ) . "px;
			}

			#grve-header.grve-sticky-header.grve-shrink .grve-logo a,
			#grve-header.grve-sticky-header.grve-advanced .grve-logo a {
				height: " . blade_grve_option( 'header_sticky_shrink_logo_height', 20 ) . "px;
			}

			#grve-header.grve-sticky-header.grve-shrink #grve-main-menu .grve-wrapper > ul > li > a,
			#grve-header.grve-sticky-header.grve-shrink .grve-header-element > a,
			#grve-header.grve-sticky-header.grve-advanced #grve-main-menu .grve-wrapper > ul > li > a,
			#grve-header.grve-sticky-header.grve-advanced .grve-header-element > a,
			#grve-header.grve-sticky-header.grve-shrink .grve-no-assigned-menu,
			#grve-header.grve-sticky-header.grve-advanced .grve-no-assigned-menu {
				line-height: " . blade_grve_option( 'header_sticky_shrink_height', 60 ) . "px;
			}

			#grve-header.grve-sticky-header.grve-advanced.hide #grve-main-header {
				-webkit-transform: translateY(-" . blade_grve_option( 'header_height', 120 ) . "px);
				-moz-transform: translateY(-" . blade_grve_option( 'header_height', 120 ) . "px);
				transform: translateY(-" . blade_grve_option( 'header_height', 120 ) . "px);
			}

		";

	/* - Sticky Logo On Top Header
	========================================================================= */
	} else if ( 'logo-top' == $grve_header_mode ) {
		$grve_header_height = intval( blade_grve_option( 'header_sticky_shrink_height', 120 ) ) + intval( blade_grve_option( 'header_bottom_height', 50 ) );
		$css .= "
			#grve-header.grve-sticky-header.grve-shrink #grve-top-header,
			#grve-header.grve-sticky-header.grve-shrink .grve-logo,
			#grve-header.grve-sticky-header.grve-advanced #grve-top-header,
			#grve-header.grve-sticky-header.grve-advanced .grve-logo {
				height: " . blade_grve_option( 'header_sticky_shrink_height', 60 ) . "px;
			}

			#grve-header.grve-sticky-header.grve-shrink .grve-logo a,
			#grve-header.grve-sticky-header.grve-advanced .grve-logo a {
				height: " . blade_grve_option( 'header_sticky_shrink_logo_height', 20 ) . "px;
			}

			#grve-header.grve-sticky-header.grve-advanced.hide #grve-main-header {
				-webkit-transform: translateY(-" . $grve_header_height . "px);
				-moz-transform: translateY(-" . $grve_header_height . "px);
				transform: translateY(-" . $grve_header_height . "px);
			}
		";
	}


	/* - Sticky Header Colors
	========================================================================= */
	$grve_header_sticky_border_color = blade_grve_option( 'header_sticky_border_color', '#ffffff' );
	$grve_header_sticky_background_color = blade_grve_option( 'header_sticky_background_color', '#ffffff' );
	$css .= "

	#grve-header.grve-sticky-header #grve-main-header {
		background-color: rgba(" . blade_grve_hex2rgb( $grve_header_sticky_background_color ) . "," . blade_grve_option( 'header_sticky_background_color_opacity', '1') . ");
	}

	#grve-header.grve-sticky-header #grve-top-header,
	#grve-header.grve-sticky-header #grve-bottom-header {
		background-color: transparent;
	}

	#grve-header.grve-sticky-header #grve-main-header #grve-main-menu .grve-wrapper > ul > li > a,
	#grve-header.grve-sticky-header #grve-main-header .grve-header-element > a,
	#grve-header.grve-sticky-header .grve-header-element .grve-purchased-items {
		color: " . blade_grve_option( 'sticky_menu_text_color' ) . ";
	}

	#grve-header.grve-sticky-header #grve-main-header #grve-main-menu .grve-wrapper > ul > li.grve-current > a,
	#grve-header.grve-sticky-header #grve-main-header #grve-main-menu .grve-wrapper > ul > li.current-menu-item > a,
	#grve-header.grve-sticky-header #grve-main-header #grve-main-menu .grve-wrapper > ul > li:hover > a,
	#grve-header.grve-sticky-header #grve-main-header #grve-main-menu .grve-wrapper > ul > li.current-menu-item > a,
	#grve-header.grve-sticky-header #grve-main-header #grve-main-menu .grve-wrapper > ul > li.current-menu-ancestor > a,
	#grve-header.grve-sticky-header #grve-main-header #grve-main-menu .grve-wrapper > ul > li.active > a,
	#grve-header.grve-sticky-header #grve-main-header .grve-header-element > a:hover {
		color: " . blade_grve_option( 'sticky_menu_text_hover_color' ) . ";
	}

	#grve-header.grve-sticky-header #grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li.current-menu-item > a span,
	#grve-header.grve-sticky-header #grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li.current-menu-ancestor > a span {
		border-color: " . blade_grve_option( 'header_sticky_menu_type_color' ) . ";
	}

	#grve-header.grve-sticky-header #grve-main-menu.grve-menu-type-button .grve-wrapper > ul > li:hover > a span {
		border-color: " . blade_grve_option( 'header_sticky_menu_type_color_hover' ) . ";
	}

	#grve-header.grve-sticky-header #grve-main-menu.grve-menu-type-underline .grve-wrapper > ul > li > a span:after {
		background-color: " . blade_grve_option( 'header_sticky_menu_type_color' ) . ";
	}

	#grve-header.grve-sticky-header #grve-main-menu.grve-menu-type-underline .grve-wrapper > ul > li:hover > a span:after {
		background-color: " . blade_grve_option( 'header_sticky_menu_type_color_hover' ) . ";
	}

	#grve-header.grve-sticky-header #grve-main-header.grve-header-default .grve-header-elements-wrapper:before {
		background: -moz-linear-gradient(top,  rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . ",0) 5%, rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . "," . blade_grve_option( 'header_sticky_border_color_opacity', '1') . ") 30%, rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . "," . blade_grve_option( 'header_sticky_border_color_opacity', '1') . ") 70%, rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . ",0) 95%);
		background: -webkit-linear-gradient(top,  rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . ",0) 5%, rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . "," . blade_grve_option( 'header_sticky_border_color_opacity', '1') . ") 30%, rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . "," . blade_grve_option( 'header_sticky_border_color_opacity', '1') . ") 70%, rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . ",0) 95%);
		background: linear-gradient(to bottom,  rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . ",0) 5%, rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . "," . blade_grve_option( 'header_sticky_border_color_opacity', '1') . ") 30%, rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . "," . blade_grve_option( 'header_sticky_border_color_opacity', '1') . ") 70%, rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . ",0) 95%);
	}

	#grve-header.grve-sticky-header #grve-main-header.grve-header-default {
		border-color: rgba(" . blade_grve_hex2rgb( $grve_header_sticky_border_color ) . "," . blade_grve_option( 'header_sticky_border_color_opacity', '1') . ");
	}

	";


/* Side Area Colors
============================================================================= */
$grve_sliding_area_overflow_background_color = blade_grve_option( 'sliding_area_overflow_background_color', '#000000' );
$css .= "
#grve-sidearea {
	background-color: " . blade_grve_option( 'sliding_area_background_color' ) . ";
	color: " . blade_grve_option( 'sliding_area_text_color' ) . ";
}

#grve-sidearea .widget,
#grve-sidearea form,
#grve-sidearea form p,
#grve-sidearea form div,
#grve-sidearea form span {
	color: " . blade_grve_option( 'sliding_area_text_color' ) . ";
}

#grve-sidearea h1,
#grve-sidearea h2,
#grve-sidearea h3,
#grve-sidearea h4,
#grve-sidearea h5,
#grve-sidearea h6,
#grve-sidearea .widget .grve-widget-title {
	color: " . blade_grve_option( 'sliding_area_title_color' ) . ";
}

#grve-sidearea a {
	color: " . blade_grve_option( 'sliding_area_link_color' ) . ";
}

#grve-sidearea .widget li a .grve-arrow:after,
#grve-sidearea .widget li a .grve-arrow:before {
	color: " . blade_grve_option( 'sliding_area_link_color' ) . ";
}

#grve-sidearea a:hover {
	color: " . blade_grve_option( 'sliding_area_link_hover_color' ) . ";
}

#grve-sidearea .grve-close-btn:after,
#grve-sidearea .grve-close-btn:before,
#grve-sidearea .grve-close-btn span {
	background-color: " . blade_grve_option( 'sliding_area_close_btn_color' ) . ";
}

#grve-sidearea .grve-border,
#grve-sidearea form,
#grve-sidearea form p,
#grve-sidearea form div,
#grve-sidearea form span,
#grve-sidearea .widget a,
#grve-sidearea .widget ul,
#grve-sidearea .widget li,
#grve-sidearea .widget table,
#grve-sidearea .widget table td,
#grve-sidearea .widget table th,
#grve-sidearea .widget table tr {
	border-color: " . blade_grve_option( 'sliding_area_border_color' ) . ";
}

#grve-sidearea-overlay {
	background-color: rgba(" . blade_grve_hex2rgb( $grve_sliding_area_overflow_background_color ) . "," . blade_grve_option( 'sliding_area_overflow_background_color_opacity', '0.9') . ");
}
";


/* Modals Colors
============================================================================= */
$grve_modal_overflow_background_color = blade_grve_option( 'modal_overflow_background_color', '#000000' );
$css .= "

#grve-modal-overlay,
.mfp-bg,
#grve-loader-overflow {
	background-color: rgba(" . blade_grve_hex2rgb( $grve_modal_overflow_background_color ) . "," . blade_grve_option( 'modal_overflow_background_color_opacity', '0.9') . ");
}

#grve-theme-wrapper .grve-modal-content .grve-form-style-1:not(.grve-white-bg) h1,
#grve-theme-wrapper .grve-modal-content .grve-form-style-1:not(.grve-white-bg) h2,
#grve-theme-wrapper .grve-modal-content .grve-form-style-1:not(.grve-white-bg) h3,
#grve-theme-wrapper .grve-modal-content .grve-form-style-1:not(.grve-white-bg) h4,
#grve-theme-wrapper .grve-modal-content .grve-form-style-1:not(.grve-white-bg) h5,
#grve-theme-wrapper .grve-modal-content .grve-form-style-1:not(.grve-white-bg) h6,
#grve-theme-wrapper .grve-modal-content .grve-form-style-1:not(.grve-white-bg) .grve-modal-title,
.mfp-title,
.mfp-counter {
	color: " . blade_grve_option( 'modal_title_color' ) . ";
}

.grve-close-modal:before,
.grve-close-modal:after,
.mfp-wrap .grve-loader {
	background-color: " . blade_grve_option( 'modal_close_btn_color' ) . ";
}

button.mfp-arrow {
	color: " . blade_grve_option( 'modal_close_btn_color' ) . ";
}

#grve-theme-wrapper .grve-modal form,
#grve-theme-wrapper .grve-modal form p,
#grve-theme-wrapper .grve-modal form div,
#grve-theme-wrapper .grve-modal form span,
#grve-socials-modal ul li a,
#grve-language-modal ul li a {
	color: " . blade_grve_option( 'modal_text_color' ) . ";
	border-color: " . blade_grve_option( 'modal_border_color' ) . ";
}


";

/* Responsive Header
============================================================================= */
$grve_responsive_header_background_color = blade_grve_option( 'responsive_header_background_color', '#000000' );
$css .= "
#grve-responsive-header > .grve-wrapper {
	background-color: rgba(" . blade_grve_hex2rgb( $grve_responsive_header_background_color ) . "," . blade_grve_option( 'responsive_header_background_opacity', '1') . ");
}
";
	/* - Header Layout
	========================================================================= */
	$css .= "
	#grve-responsive-header {
		height: " . blade_grve_option( 'responsive_header_height' ) . "px;
	}

	#grve-responsive-header .grve-logo {
		height: " . blade_grve_option( 'responsive_header_height' ) . "px;
	}

	#grve-responsive-header .grve-header-element > a {
		line-height: " . blade_grve_option( 'responsive_header_height' ) . "px;
	}

	#grve-responsive-header .grve-logo a {
		height: " . blade_grve_option( 'responsive_logo_height' ) . "px;
	}

	#grve-responsive-header .grve-logo .grve-wrapper img {
		padding-top: 0;
		padding-bottom: 0;
	}
	";

	/* - Responsive Header Overlaping
	========================================================================= */
	$css .= "

	@media only screen and (max-width: 1023px) {
		#grve-header.grve-responsive-overlapping + * {
			top: -" . blade_grve_option( 'responsive_header_height' ) . "px;
			margin-bottom: -" . blade_grve_option( 'responsive_header_height' ) . "px;
		}

		#grve-feature-section + #grve-header.grve-responsive-overlapping {
			top: -" . blade_grve_option( 'responsive_header_height' ) . "px;
		}

		#grve-header.grve-responsive-overlapping + * .grve-wrapper {
			padding-top: " . blade_grve_option( 'responsive_header_height' ) . "px;
		}

	}
	";

	/* - Responsive Menu
	========================================================================= */
	$grve_responsive_menu_overflow_background_color = blade_grve_option( 'responsive_menu_overflow_background_color', '#000000' );
	$css .= "

	#grve-hidden-menu {
		background-color: " . blade_grve_option( 'responsive_menu_background_color' ) . ";
	}

	#grve-hidden-menu a {
		color: " . blade_grve_option( 'responsive_menu_link_color' ) . ";
	}

	#grve-hidden-menu:not(.grve-slide-menu) ul.grve-menu li a .grve-arrow:after,
	#grve-hidden-menu:not(.grve-slide-menu) ul.grve-menu li a .grve-arrow:before {
		background-color: " . blade_grve_option( 'responsive_menu_link_color' ) . ";
	}

	#grve-hidden-menu ul.grve-menu li.open > a .grve-arrow:after,
	#grve-hidden-menu ul.grve-menu li.open > a .grve-arrow:before {
		background-color: " . blade_grve_option( 'responsive_menu_link_hover_color' ) . ";
	}

	#grve-theme-wrapper .grve-header-responsive-elements form,
	#grve-theme-wrapper .grve-header-responsive-elements form p,
	#grve-theme-wrapper .grve-header-responsive-elements form div,
	#grve-theme-wrapper .grve-header-responsive-elements form span {
		color: " . blade_grve_option( 'responsive_menu_link_color' ) . ";
	}

	#grve-hidden-menu a:hover,
	#grve-hidden-menu ul.grve-menu > li.current-menu-item > a,
	#grve-hidden-menu ul.grve-menu > li.current-menu-ancestor > a,
	#grve-hidden-menu ul.grve-menu li.current-menu-item > a,
	#grve-hidden-menu ul.grve-menu li.open > a {
		color: " . blade_grve_option( 'responsive_menu_link_hover_color' ) . ";
	}

	#grve-hidden-menu .grve-close-btn:after,
	#grve-hidden-menu .grve-close-btn:before,
	#grve-hidden-menu .grve-close-btn span {
		background-color: " . blade_grve_option( 'responsive_menu_close_btn_color' ) . ";
	}

	#grve-hidden-menu ul.grve-menu li a,
	#grve-theme-wrapper .grve-header-responsive-elements form,
	#grve-theme-wrapper .grve-header-responsive-elements form p,
	#grve-theme-wrapper .grve-header-responsive-elements form div,
	#grve-theme-wrapper .grve-header-responsive-elements form span {
		border-color: " . blade_grve_option( 'responsive_menu_border_color' ) . ";
	}

	#grve-hidden-menu-overlay {
		background-color: rgba(" . blade_grve_hex2rgb( $grve_responsive_menu_overflow_background_color ) . "," . blade_grve_option( 'responsive_menu_overflow_background_color_opacity', '0.9') . ");
	}

	";

	/* - Responsive Header Elements
	========================================================================= */
	$css .= "
	#grve-responsive-header .grve-header-element > a,
	#grve-responsive-header .grve-header-element .grve-purchased-items {
		color: " . blade_grve_option( 'responsive_header_elements_color' ) . ";
	}

	#grve-responsive-header .grve-header-element > a:hover {
		color: " . blade_grve_option( 'responsive_header_elements_hover_color' ) . ";
	}

	";


/* Spinner
============================================================================= */


$spinner_image_id = blade_grve_option( 'spinner_image', '', 'id' );
if ( empty( $spinner_image_id ) ) {
	$css .= "
	.grve-spinner {
		display: inline-block;
		position: absolute !important;
		top: 50%;
		left: 50%;
		margin-top: -1.500em;
		margin-left: -1.500em;
		text-indent: -9999em;
		-webkit-transform: translateZ(0);
		-ms-transform: translateZ(0);
		transform: translateZ(0);
	}
	.grve-spinner:not(.custom) {
		font-size: 14px;
		border-top: 0.200em solid rgba(127, 127, 127, 0.3);
		border-right: 0.200em solid rgba(127, 127, 127, 0.3);
		border-bottom: 0.200em solid rgba(127, 127, 127, 0.3);
		border-left: 0.200em solid;
		-webkit-animation: spinnerAnim 1.1s infinite linear;
		animation: spinnerAnim 1.1s infinite linear;
	}

	.grve-spinner:not(.custom) {
		border-left-color: " . blade_grve_option( 'body_primary_1_color' ) . ";
	}

	.grve-spinner:not(.custom),
	.grve-spinner:not(.custom):after {
		border-radius: 50%;
		width: 3.000em;
		height: 3.000em;
	}

	@-webkit-keyframes spinnerAnim {
		0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
		100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
	}

	@keyframes spinnerAnim {
		0% { -webkit-transform: rotate(0deg); transform: rotate(0deg); }
		100% { -webkit-transform: rotate(360deg); transform: rotate(360deg); }
	}
	";
} else {

	$spinner_src = wp_get_attachment_image_src( $spinner_image_id, 'full' );
	$spinner_image_url = $spinner_src[0];
	$spinner_width = $spinner_src[1];
	$spinner_height = $spinner_src[2];

	$css .= "

	.grve-spinner:not(.custom) {
		width: " . intval( $spinner_width ) . "px;
		height: " . intval( $spinner_height ) . "px;
		background-image: url(" . esc_url( $spinner_image_url ) . ");
		background-position: center center;
		display: inline-block;
		position: absolute;
		top: 50%;
		left: 50%;
		margin-top: -" . intval( $spinner_height / 2 ) . "px;
		margin-left: -" . intval( $spinner_width / 2 ) . "px;
	}

	";
}

/* Primary Text Color
============================================================================= */
$css .= "
::-moz-selection {
    color: #ffffff;
    background: " . blade_grve_option( 'body_primary_1_color' ) . ";
}

::selection {
    color: #ffffff;
    background: " . blade_grve_option( 'body_primary_1_color' ) . ";
}
";

/* Headings Colors */
$css .= "

h1,h2,h3,h4,h5,h6,
.grve-h1,
.grve-h2,
.grve-h3,
.grve-h4,
.grve-h5,
.grve-h6,
.grve-heading-color,
.grve-blog.grve-with-shadow .grve-post-title {
	color: " . blade_grve_option( 'body_heading_color' ) . ";
}

.grve-headings-primary-1 h1,
.grve-headings-primary-1 h2,
.grve-headings-primary-1 h3,
.grve-headings-primary-1 h4,
.grve-headings-primary-1 h5,
.grve-headings-primary-1 h6,
.grve-headings-primary-1 .grve-heading-color,
.wpb_column.grve-headings-primary-1 h1,
.wpb_column.grve-headings-primary-1 h2,
.wpb_column.grve-headings-primary-1 h3,
.wpb_column.grve-headings-primary-1 h4,
.wpb_column.grve-headings-primary-1 h5,
.wpb_column.grve-headings-primary-1 h6,
.wpb_column.grve-headings-primary-1 .grve-heading-color ,
.grve-blog ul.grve-post-meta a:hover,
.grve-blog a.grve-read-more {
	color: " . blade_grve_option( 'body_primary_1_color' ) . ";
}

.grve-headings-primary-2 h1,
.grve-headings-primary-2 h2,
.grve-headings-primary-2 h3,
.grve-headings-primary-2 h4,
.grve-headings-primary-2 h5,
.grve-headings-primary-2 h6,
.grve-headings-primary-2 .grve-heading-color,
.wpb_column.grve-headings-primary-2 h1,
.wpb_column.grve-headings-primary-2 h2,
.wpb_column.grve-headings-primary-2 h3,
.wpb_column.grve-headings-primary-2 h4,
.wpb_column.grve-headings-primary-2 h5,
.wpb_column.grve-headings-primary-2 h6,
.wpb_column.grve-headings-primary-2 .grve-heading-color {
	color: " . blade_grve_option( 'body_primary_2_color' ) . ";
}

.grve-headings-primary-3 h1,
.grve-headings-primary-3 h2,
.grve-headings-primary-3 h3,
.grve-headings-primary-3 h4,
.grve-headings-primary-3 h5,
.grve-headings-primary-3 h6,
.grve-headings-primary-3 .grve-heading-color,
.wpb_column.grve-headings-primary-3 h1,
.wpb_column.grve-headings-primary-3 h2,
.wpb_column.grve-headings-primary-3 h3,
.wpb_column.grve-headings-primary-3 h4,
.wpb_column.grve-headings-primary-3 h5,
.wpb_column.grve-headings-primary-3 h6,
.wpb_column.grve-headings-primary-3 .grve-heading-color {
	color: " . blade_grve_option( 'body_primary_3_color' ) . ";
}

.grve-headings-primary-4 h1,
.grve-headings-primary-4 h2,
.grve-headings-primary-4 h3,
.grve-headings-primary-4 h4,
.grve-headings-primary-4 h5,
.grve-headings-primary-4 h6,
.grve-headings-primary-4 .grve-heading-color,
.wpb_column.grve-headings-primary-4 h1,
.wpb_column.grve-headings-primary-4 h2,
.wpb_column.grve-headings-primary-4 h3,
.wpb_column.grve-headings-primary-4 h4,
.wpb_column.grve-headings-primary-4 h5,
.wpb_column.grve-headings-primary-4 h6,
.wpb_column.grve-headings-primary-4 .grve-heading-color {
	color: " . blade_grve_option( 'body_primary_4_color' ) . ";
}

.grve-headings-primary-5 h1,
.grve-headings-primary-5 h2,
.grve-headings-primary-5 h3,
.grve-headings-primary-5 h4,
.grve-headings-primary-5 h5,
.grve-headings-primary-5 h6,
.grve-headings-primary-5 .grve-heading-color,
.wpb_column.grve-headings-primary-5 h1,
.wpb_column.grve-headings-primary-5 h2,
.wpb_column.grve-headings-primary-5 h3,
.wpb_column.grve-headings-primary-5 h4,
.wpb_column.grve-headings-primary-5 h5,
.wpb_column.grve-headings-primary-5 h6,
.wpb_column.grve-headings-primary-5 .grve-heading-color {
	color: " . blade_grve_option( 'body_primary_5_color' ) . ";
}

.grve-headings-dark h1,
.grve-headings-dark h2,
.grve-headings-dark h3,
.grve-headings-dark h4,
.grve-headings-dark h5,
.grve-headings-dark h6,
.grve-headings-dark .grve-heading-color,
.wpb_column.grve-headings-dark h1,
.wpb_column.grve-headings-dark h2,
.wpb_column.grve-headings-dark h3,
.wpb_column.grve-headings-dark h4,
.wpb_column.grve-headings-dark h5,
.wpb_column.grve-headings-dark h6,
.wpb_column.grve-headings-dark .grve-heading-color {
	color: #000000;
}

.grve-headings-light h1,
.grve-headings-light h2,
.grve-headings-light h3,
.grve-headings-light h4,
.grve-headings-light h5,
.grve-headings-light h6,
.grve-headings-light .grve-heading-color,
.wpb_column.grve-headings-light h1,
.wpb_column.grve-headings-light h2,
.wpb_column.grve-headings-light h3,
.wpb_column.grve-headings-light h4,
.wpb_column.grve-headings-light h5,
.wpb_column.grve-headings-light h6,
.wpb_column.grve-headings-light .grve-heading-color {
	color: #ffffff;
}


";

/* Primary Text */
$css .= "
.grve-text-primary-1,
.grve-text-hover-primary-1:hover,
a:hover .grve-text-hover-primary-1,
.grve-like-counter.active i,
.grve-list li:before,
#grve-single-post-meta-bar .grve-categories ul li a:hover,
#grve-single-post-meta-bar .grve-tags ul li a:hover,
.vc_tta-panel.vc_active .vc_tta-controls-icon,
.grve-pagination ul li a:hover,
.grve-pagination ul li span.current,
.grve-blog.grve-with-shadow .grve-post-title:hover {
	color: " . blade_grve_option( 'body_primary_1_color' ) . ";
}

.grve-text-primary-2,
.grve-text-hover-primary-2:hover,
a:hover .grve-text-hover-primary-2,
.grve-list li:before  {
	color: " . blade_grve_option( 'body_primary_2_color' ) . ";
}

.grve-text-primary-3,
.grve-text-hover-primary-3:hover,
a:hover .grve-text-hover-primary-3,
.grve-list li:before  {
	color: " . blade_grve_option( 'body_primary_3_color' ) . ";
}

.grve-text-primary-4,
.grve-text-hover-primary-4:hover,
a:hover .grve-text-hover-primary-4,
.grve-list li:before  {
	color: " . blade_grve_option( 'body_primary_4_color' ) . ";
}

.grve-text-primary-5,
.grve-text-hover-primary-5:hover,
a:hover .grve-text-hover-primary-5,
.grve-list li:before  {
	color: " . blade_grve_option( 'body_primary_5_color' ) . ";
}

";

/* Dark */
$css .= "
.grve-text-dark,
#grve-content .grve-text-dark,
a.grve-text-dark,
.grve-text-dark-hover:hover,
a:hover .grve-text-dark-hover {
	color: #000000;
}

";

/* Light */
$css .= "
.grve-text-light,
#grve-content .grve-text-light,
a.grve-text-light,
.grve-text-light-hover:hover,
a:hover .grve-text-light-hover {
	color: #ffffff;
}

";

/* Green Text */
$css .= "

.grve-text-green,
.grve-text-hover-green:hover,
a.grve-text-hover-green:hover,
a:hover .grve-text-hover-green {
	color: #66bb6a;
}

";

/* Red Text */
$css .= "

.grve-text-red,
.grve-text-hover-red:hover,
a.grve-text-hover-red:hover,
a:hover .grve-text-hover-red {
	color: #ff5252;
}

";

/* Orange Text */
$css .= "

.grve-text-orange,
.grve-text-hover-orange:hover,
a.grve-text-hover-orange:hover,
a:hover .grve-text-hover-orange {
	color: #fd7f24;
}

";

/* Aqua Text */
$css .= "

.grve-text-aqua,
.grve-text-hover-aqua:hover,
a.grve-text-hover-aqua:hover,
a:hover .grve-text-hover-aqua {
	color: #1de9b6;
}

";

/* Blue Text */
$css .= "

.grve-text-blue,
.grve-text-hover-blue:hover,
a.grve-text-hover-blue:hover,
a:hover .grve-text-hover-blue {
	color: #00b0ff;
}

";

/* Purple Text */
$css .= "

.grve-text-purple,
.grve-text-hover-purple:hover,
a.grve-text-hover-purple:hover,
a:hover .grve-text-hover-purple {
	color: #b388ff;
}

";

/* Black Text */
$css .= "

.grve-text-black,
.grve-text-hover-black:hover,
a.grve-text-hover-black:hover,
a:hover .grve-text-hover-black {
	color: #000000;
}

";

/* Grey Text */
$css .= "

.grve-text-grey,
.grve-text-hover-grey:hover,
a.grve-text-hover-grey:hover,
a:hover .grve-text-hover-grey {
	color: #bababa;
}

";

/* White Text */
$css .= "

.grve-text-white,
.grve-text-hover-white:hover,
a.grve-text-hover-white:hover,
a:hover .grve-text-hover-white {
	color: #ffffff;
}

";


/* Primary Bg Color
============================================================================= */
/* Primary Background */
$css .= "
.grve-bg-primary-1,
.grve-bg-hover-primary-1:hover,
a.grve-bg-hover-primary-1:hover,
#grve-main-content .vc_tta.vc_general .vc_tta-tab.vc_active > a:after,
blockquote:before,
.grve-no-assigned-menu a:hover,
#grve-theme-wrapper .mejs-controls .mejs-time-rail .mejs-time-current {
	background-color: " . blade_grve_option( 'body_primary_1_color' ) . ";
	color: #ffffff;
}

a.grve-btn-line.grve-bg-primary-1 {
	background-color: transparent;
	border-color: " . blade_grve_option( 'body_primary_1_color' ) . ";
	color: " . blade_grve_option( 'body_primary_1_color' ) . ";
}

a.grve-btn-line.grve-bg-hover-primary-1:hover {
	background-color: " . blade_grve_option( 'body_primary_1_color' ) . ";
	border-color: " . blade_grve_option( 'body_primary_1_color' ) . ";
	color: #ffffff;
}

.grve-menu-type-button.grve-primary-1 > a .grve-item,
.grve-menu-type-button.grve-hover-primary-1 > a:hover .grve-item {
	background-color: " . blade_grve_option( 'body_primary_1_color' ) . ";
	color: #ffffff;
}

.grve-bg-primary-2,
.grve-bg-hover-primary-2:hover,
a.grve-bg-hover-primary-2:hover {
	background-color: " . blade_grve_option( 'body_primary_2_color' ) . ";
	color: #ffffff;
}

a.grve-btn-line.grve-bg-primary-2 {
	background-color: transparent;
	border-color: " . blade_grve_option( 'body_primary_2_color' ) . ";
	color: " . blade_grve_option( 'body_primary_2_color' ) . ";
}

a.grve-btn-line.grve-bg-hover-primary-2:hover {
	background-color: " . blade_grve_option( 'body_primary_2_color' ) . ";
	border-color: " . blade_grve_option( 'body_primary_2_color' ) . ";
	color: #ffffff;
}

.grve-menu-type-button.grve-primary-2 > a .grve-item,
.grve-menu-type-button.grve-hover-primary-2 > a:hover .grve-item {
	background-color: " . blade_grve_option( 'body_primary_2_color' ) . ";
	color: #ffffff;
}

.grve-bg-primary-3,
.grve-bg-hover-primary-3:hover,
a.grve-bg-hover-primary-3:hover {
	background-color: " . blade_grve_option( 'body_primary_3_color' ) . ";
	color: #ffffff;
}

a.grve-btn-line.grve-bg-primary-3 {
	background-color: transparent;
	border-color: " . blade_grve_option( 'body_primary_3_color' ) . ";
	color: " . blade_grve_option( 'body_primary_3_color' ) . ";
}

a.grve-btn-line.grve-bg-hover-primary-3:hover {
	background-color: " . blade_grve_option( 'body_primary_3_color' ) . ";
	border-color: " . blade_grve_option( 'body_primary_3_color' ) . ";
	color: #ffffff;
}

.grve-menu-type-button.grve-primary-3 > a .grve-item,
.grve-menu-type-button.grve-hover-primary-3 > a:hover .grve-item {
	background-color: " . blade_grve_option( 'body_primary_3_color' ) . ";
	color: #ffffff;
}

.grve-bg-primary-4,
.grve-bg-hover-primary-4:hover,
a.grve-bg-hover-primary-4:hover {
	background-color: " . blade_grve_option( 'body_primary_4_color' ) . ";
	color: #ffffff;
}

a.grve-btn-line.grve-bg-primary-4 {
	background-color: transparent;
	border-color: " . blade_grve_option( 'body_primary_4_color' ) . ";
	color: " . blade_grve_option( 'body_primary_4_color' ) . ";
}

a.grve-btn-line.grve-bg-hover-primary-4:hover {
	background-color: " . blade_grve_option( 'body_primary_4_color' ) . ";
	border-color: " . blade_grve_option( 'body_primary_4_color' ) . ";
	color: #ffffff;
}

.grve-menu-type-button.grve-primary-4 > a .grve-item,
.grve-menu-type-button.grve-hover-primary-4 > a:hover .grve-item {
	background-color: " . blade_grve_option( 'body_primary_4_color' ) . ";
	color: #ffffff;
}

.grve-bg-primary-5,
.grve-bg-hover-primary-5:hover,
a.grve-bg-hover-primary-5:hover {
	background-color: " . blade_grve_option( 'body_primary_5_color' ) . ";
	color: #ffffff;
}

a.grve-btn-line.grve-bg-primary-5 {
	background-color: transparent;
	border-color: " . blade_grve_option( 'body_primary_5_color' ) . ";
	color: " . blade_grve_option( 'body_primary_5_color' ) . ";
}

a.grve-btn-line.grve-bg-hover-primary-5:hover {
	background-color: " . blade_grve_option( 'body_primary_5_color' ) . ";
	border-color: " . blade_grve_option( 'body_primary_5_color' ) . ";
	color: #ffffff;
}

.grve-menu-type-button.grve-primary-5 > a .grve-item,
.grve-menu-type-button.grve-hover-primary-5 > a:hover .grve-item {
	background-color: " . blade_grve_option( 'body_primary_5_color' ) . ";
	color: #ffffff;
}

";
/* Dark Background */
$css .= "
.grve-bg-dark,
a.grve-bg-dark:hover,
.grve-outline-btn a.grve-bg-dark:hover {
	background-color: #000000;
	color: #ffffff;
}

.grve-outline-btn a.grve-bg-dark {
	background-color: transparent;
	border-color: #000000;
	color: #000000;
}

";
/* Light Background */
$css .= "
.grve-bg-light,
a.grve-bg-light:hover {
	background-color: #ffffff;
	color: #000000;
}

.grve-outline-btn a.grve-bg-light:hover {
	background-color: #ffffff;
	color: #000000;
}

.grve-outline-btn a.grve-bg-light {
	background-color: transparent;
	border-color: #ffffff;
	color: #ffffff;
}
";


/* Green Background */
$css .= "
.grve-bg-green,
.grve-bg-hover-green:hover,
a.grve-bg-hover-green:hover {
	background-color: #66bb6a;
	color: #ffffff;
}

a.grve-btn-line.grve-bg-green {
	background-color: transparent;
	border-color: #66bb6a;
	color: #66bb6a;
}

a.grve-btn-line.grve-bg-hover-green:hover {
	background-color: #66bb6a;
	border-color: #66bb6a;
	color: #ffffff;
}

.grve-menu-type-button.grve-green > a .grve-item,
.grve-menu-type-button.grve-hover-green > a:hover .grve-item {
	background-color: #66bb6a;
	color: #ffffff;
}

";


/* Red Background */
$css .= "
.grve-bg-red,
.grve-bg-hover-red:hover,
a.grve-bg-hover-red:hover {
	background-color: #ff5252;
	color: #ffffff;
}

a.grve-btn-line.grve-bg-red {
	background-color: transparent;
	border-color: #ff5252;
	color: #ff5252;
}

a.grve-btn-line.grve-bg-hover-red:hover {
	background-color: #ff5252;
	border-color: #ff5252;
	color: #ffffff;
}

.grve-menu-type-button.grve-red > a .grve-item,
.grve-menu-type-button.grve-hover-red > a:hover .grve-item {
	background-color: #ff5252;
	color: #ffffff;
}

";

/* Orange Background */
$css .= "
.grve-bg-orange,
.grve-bg-hover-orange:hover,
a.grve-bg-hover-orange:hover {
	background-color: #fd7f24;
	color: #ffffff;
}

a.grve-btn-line.grve-bg-orange {
	background-color: transparent;
	border-color: #fd7f24;
	color: #fd7f24;
}

a.grve-btn-line.grve-bg-hover-orange:hover {
	background-color: #fd7f24;
	border-color: #fd7f24;
	color: #ffffff;
}

.grve-menu-type-button.grve-orange > a .grve-item,
.grve-menu-type-button.grve-hover-orange > a:hover .grve-item {
	background-color: #fd7f24;
	color: #ffffff;
}

";

/* Aqua Background */
$css .= "
.grve-bg-aqua,
.grve-bg-hover-aqua:hover,
a.grve-bg-hover-aqua:hover {
	background-color: #1de9b6;
	color: #ffffff;
}

a.grve-btn-line.grve-bg-aqua {
	background-color: transparent;
	border-color: #1de9b6;
	color: #1de9b6;
}

a.grve-btn-line.grve-bg-hover-aqua:hover {
	background-color: #1de9b6;
	border-color: #1de9b6;
	color: #ffffff;
}

.grve-menu-type-button.grve-aqua > a .grve-item,
.grve-menu-type-button.grve-hover-aqua > a:hover .grve-item {
	background-color: #1de9b6;
	color: #ffffff;
}

";


/* Blue Background */
$css .= "
.grve-bg-blue,
.grve-bg-hover-blue:hover,
a.grve-bg-hover-blue:hover {
	background-color: #00b0ff;
	color: #ffffff;
}

a.grve-btn-line.grve-bg-blue {
	background-color: transparent;
	border-color: #00b0ff;
	color: #00b0ff;
}

a.grve-btn-line.grve-bg-hover-blue:hover {
	background-color: #00b0ff;
	border-color: #00b0ff;
	color: #ffffff;
}

.grve-menu-type-button.grve-blue > a .grve-item,
.grve-menu-type-button.grve-hover-blue > a:hover .grve-item {
	background-color: #00b0ff;
	color: #ffffff;
}

";

/* Purple Background */
$css .= "
.grve-bg-purple,
.grve-bg-hover-purple:hover,
a.grve-bg-hover-purple:hover {
	background-color: #b388ff;
	color: #ffffff;
}

a.grve-btn-line.grve-bg-purple {
	background-color: transparent;
	border-color: #b388ff;
	color: #b388ff;
}

a.grve-btn-line.grve-bg-hover-purple:hover {
	background-color: #b388ff;
	border-color: #b388ff;
	color: #ffffff;
}

.grve-menu-type-button.grve-purple > a .grve-item,
.grve-menu-type-button.grve-hover-purple > a:hover .grve-item {
	background-color: #b388ff;
	color: #ffffff;
}

";

/* Black Background */
$css .= "
.grve-bg-black,
.grve-bg-hover-black:hover,
a.grve-bg-hover-black:hover {
	background-color: #000000;
	color: #ffffff;
}

a.grve-btn-line.grve-bg-black {
	background-color: transparent;
	border-color: #000000;
	color: #000000;
}

a.grve-btn-line.grve-bg-hover-black:hover {
	background-color: #000000;
	border-color: #000000;
	color: #ffffff;
}

.grve-menu-type-button.grve-black > a .grve-item,
.grve-menu-type-button.grve-hover-black > a:hover .grve-item {
	background-color: #000000;
	color: #ffffff;
}

";

/* Grey Background */
$css .= "
.grve-bg-grey,
.grve-bg-hover-grey:hover,
a.grve-bg-hover-grey:hover {
	background-color: #bababa;
	color: #ffffff;
}

a.grve-btn-line.grve-bg-grey {
	background-color: transparent;
	border-color: #bababa;
	color: #bababa;
}

a.grve-btn-line.grve-bg-hover-grey:hover {
	background-color: #bababa;
	border-color: #bababa;
	color: #ffffff;
}

.grve-menu-type-button.grve-grey > a .grve-item,
.grve-menu-type-button.grve-hover-grey > a:hover .grve-item {
	background-color: #bababa;
	color: #ffffff;
}

";

/* White Background */
$css .= "
.grve-bg-white,
.grve-bg-hover-white:hover,
a.grve-bg-hover-white:hover {
	background-color: #ffffff;
	color: #bababa;
}

a.grve-btn-line.grve-bg-white {
	background-color: transparent;
	border-color: #ffffff;
	color: #ffffff;
}

a.grve-btn-line.grve-bg-hover-white:hover {
	background-color: #ffffff;
	border-color: #ffffff;
	color: #bababa;
}

.grve-menu-type-button.grve-white > a .grve-item,
.grve-menu-type-button.grve-hover-white > a:hover .grve-item {
	background-color: #ffffff;
	color: #bababa;
}

";

/* Anchor Menu
============================================================================= */

// Anchor Colors
$css .= "

.grve-anchor-menu .grve-anchor-wrapper,
.grve-anchor-menu .grve-container ul {
	background-color: " . blade_grve_option( 'page_anchor_menu_background_color' ) . ";
}

.grve-anchor-menu .grve-container > ul > li > a,
.grve-anchor-menu .grve-container ul li a,
.grve-anchor-menu .grve-container > ul > li:last-child > a {
	border-color: " . blade_grve_option( 'page_anchor_menu_border_color' ) . ";
}

.grve-anchor-menu a {
	color: " . blade_grve_option( 'page_anchor_menu_text_color' ) . ";
	background-color: transparent;
}

.grve-anchor-menu a:hover,
.grve-anchor-menu .grve-container > ul > li.active > a {
	color: " . blade_grve_option( 'page_anchor_menu_text_hover_color' ) . ";
	background-color: " . blade_grve_option( 'page_anchor_menu_background_hover_color' ) . ";
}

.grve-anchor-menu a .grve-arrow:after,
.grve-anchor-menu a .grve-arrow:before {
	background-color: " . blade_grve_option( 'page_anchor_menu_text_hover_color' ) . ";
}

";

// Page Anchor Size
$css .= "

#grve-page-anchor {
	height: " . blade_grve_option( 'page_anchor_menu_height' ) . "px;
}

#grve-page-anchor .grve-anchor-wrapper {
	height: " . blade_grve_option( 'page_anchor_menu_height' ) . "px;
	line-height: " . blade_grve_option( 'page_anchor_menu_height' ) . "px;
}

#grve-page-anchor.grve-anchor-menu .grve-anchor-btn {
	width: " . blade_grve_option( 'page_anchor_menu_height' ) . "px;
}

";

// Post Anchor Size
$css .= "

#grve-post-anchor {
	height: " . blade_grve_option( 'post_anchor_menu_height' ) . "px;
}

#grve-post-anchor .grve-anchor-wrapper {
	height: " . blade_grve_option( 'post_anchor_menu_height' ) . "px;
	line-height: " . blade_grve_option( 'post_anchor_menu_height' ) . "px;
}

#grve-post-anchor.grve-anchor-menu .grve-anchor-btn {
	width: " . blade_grve_option( 'page_anchor_menu_height' ) . "px;
}

";

// Portfolio Anchor Size
$css .= "

#grve-portfolio-anchor {
	height: " . blade_grve_option( 'portfolio_anchor_menu_height' ) . "px;
}

#grve-portfolio-anchor .grve-anchor-wrapper {
	height: " . blade_grve_option( 'portfolio_anchor_menu_height' ) . "px;
	line-height: " . blade_grve_option( 'portfolio_anchor_menu_height' ) . "px;
}

#grve-portfolio-anchor.grve-anchor-menu .grve-anchor-btn {
	width: " . blade_grve_option( 'page_anchor_menu_height' ) . "px;
}

";

// Product Anchor Size
$css .= "

#grve-product-anchor {
	height: " . blade_grve_option( 'product_anchor_menu_height' ) . "px;
}

#grve-product-anchor .grve-anchor-wrapper {
	height: " . blade_grve_option( 'product_anchor_menu_height' ) . "px;
	line-height: " . blade_grve_option( 'product_anchor_menu_height' ) . "px;
}

#grve-product-anchor.grve-anchor-menu .grve-anchor-btn {
	width: " . blade_grve_option( 'page_anchor_menu_height' ) . "px;
}


";

/* Breadcrumbs
============================================================================= */
$css .= "
.grve-breadcrumbs {
	background-color: " . blade_grve_option( 'page_breadcrumbs_background_color' ) . ";
	border-color: " . blade_grve_option( 'page_breadcrumbs_border_color' ) . ";
}

.grve-breadcrumbs ul li {
	color: " . blade_grve_option( 'page_breadcrumbs_divider_color' ) . ";
}

.grve-breadcrumbs ul li a {
	color: " . blade_grve_option( 'page_breadcrumbs_text_color' ) . ";
}

.grve-breadcrumbs ul li a:hover {
	color: " . blade_grve_option( 'page_breadcrumbs_text_hover_color' ) . ";
}

";

// Page Breadcrumbs Size
$css .= "

#grve-page-breadcrumbs {
	line-height: " . blade_grve_option( 'page_breadcrumbs_height' ) . "px;
}

";

// Post Breadcrumbs Size
$css .= "

#grve-post-breadcrumbs {
	line-height: " . blade_grve_option( 'post_breadcrumbs_height' ) . "px;
}

";

// Portfolio Breadcrumbs Size
$css .= "

#grve-portfolio-breadcrumbs {
	line-height: " . blade_grve_option( 'portfolio_breadcrumbs_height' ) . "px;
}

";

// Product Breadcrumbs Size
$css .= "

#grve-product-breadcrumbs {
	line-height: " . blade_grve_option( 'product_breadcrumbs_height' ) . "px;
}

";

/* Main Content
============================================================================= */
$css .= "

#grve-content,
.grve-single-wrapper,
#grve-main-content .grve-section {
	background-color: " . blade_grve_option( 'main_content_background_color' ) . ";
	color: " . blade_grve_option( 'body_text_color' ) . ";
}

body,
.grve-text-content,
.grve-text-content a,
#grve-single-post-meta-bar .grve-categories ul li a,
#grve-single-post-meta-bar .grve-tags ul li a,
#grve-content form,
#grve-content form p,
#grve-content form div,
#grve-content form span,
table,
.grve-blog.grve-with-shadow .grve-post-content {
	color: " . blade_grve_option( 'body_text_color' ) . ";
}

";
	/* - Main Content Borders
	========================================================================= */
	$css .= "
	.grve-border,
	#grve-content .grve-border,
	#grve-content form,
	#grve-content form p,
	#grve-content form div,
	#grve-content form span,
	hr,
	.grve-hr.grve-element div,
	.grve-title-double-line span:before,
	.grve-title-double-line span:after,
	.grve-title-double-bottom-line span:after,
	.vc_tta-tabs-position-top .vc_tta-tabs-list,
	table,tr,th,td {
		border-color: " . blade_grve_option( 'body_border_color' ) . ";
	}
	";

	/* Primary Border */
	$css .= "
	#grve-content .grve-blog-large .grve-blog-item.sticky ul.grve-post-meta,
	.grve-carousel-pagination-2 .grve-carousel .owl-controls .owl-page.active span,
	.grve-carousel-pagination-2 .grve-carousel .owl-controls.clickable .owl-page:hover span,
	.grve-carousel-pagination-2.grve-testimonial .owl-controls .owl-page.active span,
	.grve-carousel-pagination-2.grve-testimonial .owl-controls.clickable .owl-page:hover span,
	.grve-carousel-pagination-2 .grve-flexible-carousel .owl-controls .owl-page.active span,
	.grve-carousel-pagination-2 .grve-flexible-carousel .owl-controls.clickable .owl-page:hover span {
		border-color: " . blade_grve_option( 'body_primary_1_color' ) . ";
	}
	";

	/* - Widget Colors
	========================================================================= */
	$css .= "
	.widget .grve-widget-title {
		color: " . blade_grve_option( 'body_heading_color' ) . ";
	}

	.widget {
		color: " . blade_grve_option( 'body_text_color' ) . ";
	}

	#grve-sidebar .widget a:not(.grve-outline):not(.grve-btn),
	#grve-sidebar .widget ul,
	#grve-sidebar .widget li,
	#grve-sidebar .widget table,
	#grve-sidebar .widget table td,
	#grve-sidebar .widget table th,
	#grve-sidebar .widget table tr {
		border-color: " . blade_grve_option( 'body_border_color' ) . ";
	}

	.widget a:not(.grve-outline):not(.grve-btn) {
		color: " . blade_grve_option( 'body_text_color' ) . ";
	}

	.widget a:not(.grve-outline):not(.grve-btn):hover,
	.widget.widget_nav_menu li.open > a {
		color: " . blade_grve_option( 'body_primary_1_color' ) . ";
	}
	";

/* Footer
============================================================================= */

	/* - Widget Area
	========================================================================= */
	$css .= "
	#grve-footer .grve-widget-area {
		background-color: " . blade_grve_option( 'footer_widgets_bg_color' ) . ";
	}
	";
	/* - Footer Widget Colors
	========================================================================= */
	$css .= "
	#grve-footer .widget .grve-widget-title,
	#grve-footer h1,
	#grve-footer h2,
	#grve-footer h3,
	#grve-footer h4,
	#grve-footer h5,
	#grve-footer h6 {
		color: " . blade_grve_option( 'footer_widgets_headings_color' ) . ";
	}

	#grve-footer .widget,
	#grve-footer form,
	#grve-footer form p,
	#grve-footer form div,
	#grve-footer form span {
		color: " . blade_grve_option( 'footer_widgets_font_color' ) . ";
	}

	#grve-footer .widget a:not(.grve-outline):not(.grve-btn),
	#grve-footer .widget ul,
	#grve-footer .widget li,
	#grve-footer .widget table,
	#grve-footer .widget table td,
	#grve-footer .widget table th,
	#grve-footer .widget table tr,
	#grve-footer .grve-border,
	#grve-footer form,
	#grve-footer form p,
	#grve-footer form div,
	#grve-footer form span {
		border-color: " . blade_grve_option( 'footer_widgets_border_color' ) . ";
	}

	#grve-footer .widget a:not(.grve-outline):not(.grve-btn) {
		color: " . blade_grve_option( 'footer_widgets_link_color' ) . ";
	}

	#grve-footer .widget a:not(.grve-outline):not(.grve-btn):hover,
	#grve-footer .widget.widget_nav_menu li.open > a {
		color: " . blade_grve_option( 'footer_widgets_hover_color' ) . ";
	}
	";
	/* - Footer Bar Colors
	========================================================================= */
	$grve_footer_bar_background_color = blade_grve_option( 'footer_bar_bg_color', '#000000' );
	$css .= "
	#grve-footer .grve-footer-bar {
		color: " . blade_grve_option( 'footer_bar_font_color' ) . ";
		background-color: rgba(" . blade_grve_hex2rgb( $grve_footer_bar_background_color ) . "," . blade_grve_option( 'footer_bar_bg_color_opacity', '1') . ");
	}

	#grve-footer .grve-footer-bar a {
		color: " . blade_grve_option( 'footer_bar_link_color' ) . ";
	}

	#grve-footer .grve-footer-bar a:hover {
		color: " . blade_grve_option( 'footer_bar_hover_color' ) . ";
	}
	";



/* Post Bar ( Socials & Navigations )
============================================================================= */
$css .= "
#grve-post-bar {
	background-color: " . blade_grve_option( 'post_bar_background_color' ) . ";
	border-color: " . blade_grve_option( 'post_bar_border_color' ) . ";
}

#grve-post-bar .grve-post-socials a {
	color: " . blade_grve_option( 'post_bar_socials_color' ) . ";
}

#grve-post-bar .grve-post-socials a:hover,
#grve-post-bar .grve-backlink a:hover,
#grve-post-bar a.active i {
	color: " . blade_grve_option( 'post_bar_socials_color_hover' ) . ";
}

#grve-post-bar .grve-title {
	color: " . blade_grve_option( 'post_bar_nav_title_color' ) . ";
}

#grve-post-bar .grve-nav-title {
	color: " . blade_grve_option( 'post_bar_nav_subheading_color' ) . ";
}

#grve-post-bar .grve-arrow {
	color: " . blade_grve_option( 'post_bar_arrow_color' ) . ";
}

";

/* Portfolio Bar ( Socials & Navigations )
============================================================================= */
$css .= "
#grve-portfolio-bar {
	background-color: " . blade_grve_option( 'portfolio_bar_background_color' ) . ";
	border-color: " . blade_grve_option( 'portfolio_bar_border_color' ) . ";
}

#grve-portfolio-bar .grve-post-socials a {
	color: " . blade_grve_option( 'portfolio_bar_socials_color' ) . ";
}

#grve-portfolio-bar .grve-post-socials a:hover,
#grve-portfolio-bar .grve-backlink a:hover,
#grve-portfolio-bar a.active i {
	color: " . blade_grve_option( 'portfolio_bar_socials_color_hover' ) . ";
}

#grve-portfolio-bar .grve-title {
	color: " . blade_grve_option( 'portfolio_bar_nav_title_color' ) . ";
}

#grve-portfolio-bar .grve-nav-title {
	color: " . blade_grve_option( 'portfolio_bar_nav_subheading_color' ) . ";
}

#grve-portfolio-bar .grve-arrow {
	color: " . blade_grve_option( 'portfolio_bar_arrow_color' ) . ";
}

";

/* Composer Front End Fix*/
$css .= "

.compose-mode .vc_element .grve-row {
    margin-top: 30px;
}

.compose-mode .vc_vc_column .wpb_column {
    width: 100% !important;
    margin-bottom: 30px;
    border: 1px dashed rgba(125, 125, 125, 0.4);
}

.compose-mode .vc_controls > .vc_controls-out-tl {
    left: 15px;
}

.compose-mode .vc_controls > .vc_controls-bc {
    bottom: 15px;
}

.compose-mode .vc_welcome .vc_buttons {
    margin-top: 60px;
}

.compose-mode .grve-image img {
    opacity: 1;
}

.compose-mode .vc_controls > div {
    z-index: 9;
}
.compose-mode .grve-bg-image {
    opacity: 1;
}

.compose-mode #grve-theme-wrapper .grve-section.grve-fullwidth-background,
.compose-mode #grve-theme-wrapper .grve-section.grve-fullwidth-element {
	visibility: visible;
}

.compose-mode .grve-animated-item {
	opacity: 1;
}

";

echo blade_grve_get_css_output( $css );

//Omit closing PHP tag to avoid accidental whitespace output errors.
