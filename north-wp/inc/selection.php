<?php function thb_selection() {
	$id = get_queried_object_id();
	ob_start();
?>
/* Options set in the admin page */
body { 
	<?php thb_typeecho(ot_get_option('body_type'), false, 'Hind'); ?>
	color: <?php echo ot_get_option('text_color'); ?>;
}
@media all and (min-width: 40.063em) {
	.header {
		height: <?php thb_measurementecho(ot_get_option('header_height')); ?>;
		<?php thb_paddingecho(ot_get_option('header_spacing')); ?>
	}
	#searchpopup .searchform fieldset input {
		height: <?php thb_measurementecho(ot_get_option('header_height')); ?>;
	}
	.page-padding {
		padding-top: <?php thb_measurementecho(ot_get_option('header_height')); ?>;
	}
}

.header .logo .logoimg {
	max-height: <?php thb_measurementecho(ot_get_option('logo_height')); ?>;
}
.header:hover,
.header.hover,
.header.style2  {
	<?php thb_bgecho(ot_get_option('header_bg')); ?>
}
#my-account-main .account-icon-box.image {
	<?php thb_bgecho(ot_get_option('myaccount-ad-bg')); ?>
}
#footer:hover,
#footer.hover,
#footer.active,
#footer.style2 {
	<?php thb_bgecho(ot_get_option('footer_bg')); ?>
}
<?php if(ot_get_option('title_type')) { ?>
h1,h2,h3,h4,h5,h6,
.thb_tabs .tabs li a, .woocommerce-tabs .tabs li a,
.btn, .button, input[type=submit],
.badge,
.woocommerce-tabs ul.accordion > li > div.title,
.shop_bar,
label,
.smalltitle,
.header.style2 .account-holder,
#shippingsteps,
.post .post-meta ul li,
#post-prevnext .post-navi a,
.product_meta,
.price,
.product-page.style2 .style2-container .woocommerce-breadcrumb,
.woocommerce-pagination,
#footer.style2,
#my-account-main .account-icon-box,
#comments ol.commentlist .meta,
.more-link,
.tabs,
.product.product-category a div span,
#side-cart ul li,
#side-cart .item,
.shop_table,
table,
.style1 .account-holder .float_count {
	<?php thb_typeecho(ot_get_option('title_type'), false, 'Hind'); ?>	
}
<?php } ?>

/* Accent Color */
<?php if ($accent_color = ot_get_option('accent_color')) { ?>
a:hover, #nav .sf-menu > li > a:hover, .post .post-meta ul li a, .post .post-title a:not(.button):hover, .lookbook-container .look .info a .amount, #comments ol.commentlist .comment-reply-link, .product.product-category a div span, .products .product .product_after_title .button:hover, .lost_password, .payment_methods li .about_paypal, #my-account-main .account-icon-box:hover, .shop_table tbody tr td.order-status.approved, .shop_table tbody tr td.product-name .posted_in a, .shop_table tbody tr td.product-quantity .wishlist-in-stock, .product-information .price .amount, .product-information .back_to_shop span, .product_meta > span a, .product_meta > span span, .thb_tabs .tabs li.active a, .woocommerce-tabs .tabs li.active a, #prdctfltr_woocommerce.pf_default .prdctfltr_sale label.prdctfltr_active, .rp_wcdpd_product_page .rp_wcdpd_pricing_table .amount {
  color: <?php echo esc_attr($accent_color); ?>;
}

.post.sticky .post-title h2 a {
  border-color: <?php echo esc_attr($accent_color); ?>;
}

.products .product .product_after_title .button:hover:after, .badge.onsale, .price_slider .ui-slider-range, .btn:hover, .button:hover, input[type=submit]:hover, .btn.accent, .btn.alt, .button.accent, .button.alt, input[type=submit].accent, input[type=submit].alt, .thb_tabs .tabs li a:after, .woocommerce-tabs .tabs li a:after {
	background: <?php echo esc_attr($accent_color); ?>;	
}
.btn.accent:hover, .btn.alt:hover, .button.accent:hover, .button.alt:hover, input[type=submit].accent:hover, input[type=submit].alt:hover {
	background: <?php echo thb_adjustColorLightenDarken($accent_color, 5); ?>;
}
#my-account-main .account-icon-box:hover .account_icon path {
	fill: <?php echo esc_attr($accent_color); ?>;
}
<?php } ?>

/* Menu */
<?php if ($menu_margin = ot_get_option('menu_margin')) { ?>
#nav .sf-menu > li > a {
	margin-right: <?php echo esc_attr($menu_margin[0].$menu_margin[1]); ?>;
}
<?php } ?>
<?php if ($menu_left = ot_get_option('menu_left_type')) { ?>
#nav .sf-menu > li > a {
	<?php thb_typeecho($menu_left); ?>	
}
<?php } ?>
<?php if ($submenu_left = ot_get_option('menu_left_submenu_type')) { ?>
#nav ul.sub-menu li a {
	<?php thb_typeecho($submenu_left); ?>	
}
<?php } ?>
<?php if ($menu_right = ot_get_option('menu_right_type')) { ?>
.account-holder ul li a {
	<?php thb_typeecho($menu_right); ?>	
}
<?php } ?>
/* Mobile Menu */
<?php if ($menu_mobile = ot_get_option('menu_mobile_type')) { ?>
.mobile-menu li a {
	<?php thb_typeecho($menu_mobile); ?>	
}
<?php } ?>
<?php if ($submenu_mobile = ot_get_option('menu_mobile_submenu_type')) { ?>
.mobile-menu .sub-menu li a {
	<?php thb_typeecho($submenu_mobile); ?>	
}
<?php } ?>
<?php if ($menu_secondary_mobile = ot_get_option('menu_mobile_secondary_type')) { ?>
.mobile-secondary-menu a {
	<?php thb_typeecho($menu_secondary_mobile); ?>	
}
<?php } ?>

/* Newsletter */
<?php if ($newsletter_bg = ot_get_option('newsletter_bg')) { ?>
#newsletter-popup {
	<?php thb_bgecho($newsletter_bg); ?>
}
<?php } ?>
/* Shop Badges */
<?php if ($badge_sale = ot_get_option('badge_sale')) { ?>
.badge.onsale {
	background: <?php echo esc_attr($badge_sale);?>;
}
<?php } ?>
<?php if ($badge_outofstock = ot_get_option('badge_outofstock')) { ?>
.badge.out-of-stock {
	background: <?php echo esc_attr($badge_outofstock);?>;
}
<?php } ?>
<?php if ($badge_justarrived= ot_get_option('badge_justarrived')) { ?>
.badge.new{
	background: <?php echo esc_attr($badge_justarrived);?>;
}
<?php } ?>
/* 404 Page */
<?php if ($bg404 = ot_get_option('404-bg')) { ?>
.content404 {
	background-image: url('<?php echo esc_attr($bg404);?>)');
}
<?php } ?>
<?php
	$shop_header_bg = '';
	if (is_shop() || is_product_tag()) {
		$shop_header_bg = ot_get_option('shop_header_bg');
	} else if (is_product_category()) {
		$cat = get_queried_object();
		$cat_id = $cat->term_id;
		$header_id = get_term_meta( $cat_id, 'header_id', true );
		$shop_header_bg = wp_get_attachment_url( $header_id );
	}
?>
.shop-header {
	background-image: url(<?php echo esc_url($shop_header_bg); ?>);
}
/* Extra CSS */
<?php 
echo ot_get_option('extra_css');
?>
<?php 
	$out = ob_get_contents();
	if (ob_get_contents()) ob_end_clean();
	// Remove comments
	$out = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $out);
	// Remove space after colons
	$out = str_replace(': ', ':', $out);
	// Remove whitespace
	$out = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $out);
	
	return $out;
}