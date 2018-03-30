<?php
/**
 *  Dynamic css style for WooCommerce
 * 	@author		Greatives Team
 * 	@URI		http://greatives.eu
 */

$css = "";


/* Container Size
============================================================================= */
$css .= "

.grve-woo-error,
.grve-woo-info,
.grve-woo-message,
.grve-woo-tabs #tab-reviews.panel,
.grve-woo-tabs #tab-additional_information.panel {
	max-width: " . blade_grve_option( 'container_size', 1170 ) . "px;
}

";

/* Default Header Shopping Cart
============================================================================= */
$grve_header_mode = blade_grve_option( 'header_mode', 'default' );
if ( 'default' == $grve_header_mode ) {

	$css .= "
	#grve-header .grve-shoppin-cart-content {
		background-color: " . blade_grve_option( 'default_header_submenu_bg_color' ) . ";
	}

	#grve-header .grve-shoppin-cart-content ul li,
	#grve-header .grve-shoppin-cart-content ul li a,
	#grve-header .grve-shoppin-cart-content .total {
		color: " . blade_grve_option( 'default_header_submenu_text_color' ) . ";
	}

	#grve-header .grve-shoppin-cart-content ul li a:hover {
		color: " . blade_grve_option( 'default_header_submenu_text_hover_color' ) . ";
	}

	#grve-header .grve-shoppin-cart-content ul li {
		border-color: " . blade_grve_option( 'default_header_submenu_border_color' ) . ";
	}

	";

/* Logo On Top Header Shopping Cart
============================================================================= */
} else if ( 'logo-top' == $grve_header_mode ) {

	$css .= "
	#grve-header .grve-shoppin-cart-content {
		background-color: " . blade_grve_option( 'logo_top_header_submenu_bg_color' ) . ";
	}

	#grve-header .grve-shoppin-cart-content ul li,
	#grve-header .grve-shoppin-cart-content ul li a,
	#grve-header .grve-shoppin-cart-content .total {
		color: " . blade_grve_option( 'logo_top_header_submenu_text_color' ) . ";
	}

	#grve-header .grve-shoppin-cart-content ul li a:hover {
		color: " . blade_grve_option( 'logo_top_header_submenu_text_bg_hover_color' ) . ";
	}

	#grve-header .grve-shoppin-cart-content ul li {
		border-color: " . blade_grve_option( 'logo_top_header_submenu_border_color' ) . ";
	}

	";

}


/* Cart Area Colors
============================================================================= */
$grve_sliding_area_overflow_background_color = blade_grve_option( 'sliding_area_overflow_background_color', '#000000' );
$css .= "
#grve-cart-area {
	background-color: " . blade_grve_option( 'sliding_area_background_color' ) . ";
	color: " . blade_grve_option( 'sliding_area_text_color' ) . ";
}

.grve-cart-total {
	color: " . blade_grve_option( 'sliding_area_title_color' ) . ";
}

#grve-cart-area .cart-item-content a,
#grve-cart-area .grve-empty-cart .grve-h6 {
	color: " . blade_grve_option( 'sliding_area_title_color' ) . ";
}

#grve-cart-area .grve-empty-cart a {
	color: " . blade_grve_option( 'sliding_area_link_color' ) . ";
}

#grve-cart-area .cart-item-content a:hover,
#grve-cart-area .grve-empty-cart a:hover {
	color: " . blade_grve_option( 'sliding_area_link_hover_color' ) . ";
}

#grve-cart-area .grve-close-btn:after,
#grve-cart-area .grve-close-btn:before,
#grve-cart-area .grve-close-btn span {
	background-color: " . blade_grve_option( 'sliding_area_close_btn_color' ) . ";
}

#grve-cart-area .grve-border {
	border-color: " . blade_grve_option( 'sliding_area_border_color' ) . ";
}

#grve-cart-area-overlay {
	background-color: rgba(" . blade_grve_hex2rgb( $grve_sliding_area_overflow_background_color ) . "," . blade_grve_option( 'sliding_area_overflow_background_color_opacity', '0.9') . ");
}

";


/* Primary Background */
$css .= "

.woocommerce span.onsale,
.grve-woo-tabs ul.tabs li a span:after,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
	background-color: " . blade_grve_option( 'body_primary_1_color' ) . ";
	color: #ffffff;
}

";


/* Primary Color */
$css .= "

.woocommerce nav.woocommerce-pagination ul li span.current,
nav.woocommerce-pagination ul li a:hover,
.woocommerce .widget_layered_nav ul li.chosen a:before,
.woocommerce .widget_layered_nav_filters ul li a:before,
.grve-product-item .grve-add-to-cart-btn a:hover,
.grve-product-item .grve-add-to-cart-btn a.add_to_cart_button:before,
.woocommerce-MyAccount-navigation ul li a:hover {
	color: " . blade_grve_option( 'body_primary_1_color' ) . "!important;
}

";


/* Content Color
============================================================================= */
$css .= "

nav.woocommerce-pagination ul li a {
	color: " . blade_grve_option( 'body_text_color' ) . ";
}

";


/* Headers Color
============================================================================= */
$css .= "

.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
.grve-product-item .grve-add-to-cart-btn a.add_to_cart_button:before,
.woocommerce form .form-row label {
	color: " . blade_grve_option( 'body_heading_color' ) . ";
}

";


/* Borders
============================================================================= */
$css .= "

.woocommerce-tabs,
.woocommerce #reviews #review_form_wrapper,
.woocommerce-page #reviews #review_form_wrapper,
#grve-theme-wrapper .woocommerce table,
#grve-theme-wrapper .woocommerce table tr,
#grve-theme-wrapper .woocommerce table th,
#grve-theme-wrapper .woocommerce table td,
.woocommerce table.shop_attributes,
.woocommerce table.shop_attributes tr,
.woocommerce table.shop_attributes th,
.woocommerce table.shop_attributes td,
.woocommerce-MyAccount-navigation ul li,
#grve-theme-wrapper .dropdown_product_cat {
	border-color: " . blade_grve_option( 'body_border_color' ) . ";
}

";

/* H6 */
$css .= "

.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta {
	font-family: " . blade_grve_option( 'h6_font', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'h6_font', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'h6_font', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'h6_font', '56px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'h6_font', 'uppercase', 'text-transform'  ) . ";
	line-height: " . blade_grve_option( 'h6_font', '60px', 'line-height'  ) . ";
	" . blade_grve_css_option( 'h6_font', '0px', 'letter-spacing'  ) . "
}

";


/* Special Text */
$css .= "



";


/* Small Text */
$css .= "

.woocommerce span.onsale,
.widget.woocommerce .chosen,
.widget.woocommerce .price_label  {
	font-family: " . blade_grve_option( 'small_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'small_text', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'small_text', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'small_text', '34px', 'font-size'  ) . ";
	text-transform: " . blade_grve_option( 'small_text', 'none', 'text-transform'  ) . ";
	" . blade_grve_css_option( 'small_text', '0px', 'letter-spacing'  ) . "
}


";

/* Link Text */
$css .= "

.woocommerce-pagination,
.woocommerce form .grve-billing-content .form-row label,
.grve-woo-error a.button,
.grve-woo-info a.button,
.grve-woo-message a.button,
.woocommerce-MyAccount-content a.button,
.woocommerce .woocommerce-error a.button,
.woocommerce .woocommerce-info a.button,
.woocommerce .woocommerce-message a.button {
	font-family: " . blade_grve_option( 'link_text', 'Arial, Helvetica, sans-serif', 'font-family'  ) . ";
	font-weight: " . blade_grve_option( 'link_text', 'normal', 'font-weight'  ) . ";
	font-style: " . blade_grve_option( 'link_text', 'normal', 'font-style'  ) . ";
	font-size: " . blade_grve_option( 'link_text', '13px', 'font-size'  ) . " !important;
	text-transform: " . blade_grve_option( 'link_text', 'uppercase', 'text-transform'  ) . ";
	" . blade_grve_css_option( 'link_text', '0px', 'letter-spacing'  ) . "
}

";


echo blade_grve_get_css_output( $css );

//Omit closing PHP tag to avoid accidental whitespace output errors.
