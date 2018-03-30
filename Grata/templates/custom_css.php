<?php
global $smof_data, $output_styles_to_file;

if ($smof_data['body_text_font'] == '' OR $smof_data['body_text_font'] == 'none') {
	$smof_data['body_text_font'] = 'PT Sans';
}
if ($smof_data['navigation_font'] == '' OR $smof_data['navigation_font'] == 'none') {
	$smof_data['navigation_font'] = 'Open Sans';
}
if ($smof_data['heading_font'] == '' OR $smof_data['heading_font'] == 'none') {
	$smof_data['heading_font'] = 'Open Sans';
}

if ($smof_data['heading_weight'] == 'Light (300) font weight') {
	$smof_data['heading_weight'] = '300';
} elseif ($smof_data['heading_weight'] == 'Bold (700) font weight') {
	$smof_data['heading_weight'] = '700';
} elseif ($smof_data['heading_weight'] == 'Semi-bold (600) font weight') {
	$smof_data['heading_weight'] = '600';
} else {
    $smof_data['heading_weight'] = '400';
}

if ($smof_data['body_text_weight'] == 'Light (300) font weight') {
	$smof_data['body_text_weight'] = '300';
} elseif ($smof_data['body_text_weight'] == 'Bold (700) font weight') {
	$smof_data['body_text_weight'] = '700';
} elseif ($smof_data['body_text_weight'] == 'Semi-bold (600) font weight') {
	$smof_data['body_text_weight'] = '600';
} else {
    $smof_data['body_text_weight'] = '400';
}

if ($smof_data['navigation_weight'] == 'Light (300) font weight') {
	$smof_data['navigation_weight'] = '300';
} elseif ($smof_data['navigation_weight'] == 'Bold (700) font weight') {
	$smof_data['navigation_weight'] = '700';
} elseif ($smof_data['navigation_weight'] == 'Semi-bold (600) font weight') {
	$smof_data['navigation_weight'] = '600';
} else {
    $smof_data['navigation_weight'] = '400';
}

if (empty($smof_data['nav_fontsize'])) {
    $smof_data['nav_fontsize'] = 18;
}
if (empty($smof_data['subnav_fontsize'])) {
    $smof_data['subnav_fontsize'] = 16;
}
if (empty($smof_data['nav_fontsize_mobile'])) {
    $smof_data['nav_fontsize_mobile'] = 18;
}
if (empty($smof_data['subnav_fontsize_mobile'])) {
    $smof_data['subnav_fontsize_mobile'] = 16;
}

if (empty($smof_data['regular_lineheight'])) {
    $smof_data['regular_lineheight'] = 26;
}
if (empty($smof_data['regular_fontsize'])) {
    $smof_data['regular_fontsize'] = 16;
}
if (empty($smof_data['regular_lineheight_mobile'])) {
    $smof_data['regular_lineheight_mobile'] = 22;
}
if (empty($smof_data['regular_fontsize_mobile'])) {
    $smof_data['regular_fontsize_mobile'] = 14;
}

if (empty($smof_data['mega_fontsize'])) {
    $smof_data['mega_fontsize'] = 80;
}
if (empty($smof_data['h1_fontsize'])) {
    $smof_data['h1_fontsize'] = 46;
}
if (empty($smof_data['h2_fontsize'])) {
    $smof_data['h2_fontsize'] = 40;
}
if (empty($smof_data['h3_fontsize'])) {
    $smof_data['h3_fontsize'] = 32;
}
if (empty($smof_data['h4_fontsize'])) {
    $smof_data['h4_fontsize'] = 26;
}
if (empty($smof_data['h5_fontsize'])) {
    $smof_data['h5_fontsize'] = 22;
}
if (empty($smof_data['h6_fontsize'])) {
    $smof_data['h6_fontsize'] = 18;
}
if (empty($smof_data['mega_fontsize_mobile'])) {
    $smof_data['mega_fontsize_mobile'] = 40;
}
if (empty($smof_data['h1_fontsize_mobile'])) {
    $smof_data['h1_fontsize_mobile'] = 30;
}
if (empty($smof_data['h2_fontsize_mobile'])) {
    $smof_data['h2_fontsize_mobile'] = 26;
}
if (empty($smof_data['h3_fontsize_mobile'])) {
    $smof_data['h3_fontsize_mobile'] = 22;
}
if (empty($smof_data['h4_fontsize_mobile'])) {
    $smof_data['h4_fontsize_mobile'] = 20;
}
if (empty($smof_data['h5_fontsize_mobile'])) {
    $smof_data['h5_fontsize_mobile'] = 18;
}
if (empty($smof_data['h6_fontsize_mobile'])) {
    $smof_data['h6_fontsize_mobile'] = 16;
}
?>
<?php if (empty($output_styles_to_file) OR $output_styles_to_file == FALSE): ?>
<style id="us_fonts_inline">
<?php endif; ?>
.l-header .w-nav-item {
	font-family: '<?php echo $smof_data['navigation_font']; ?>';
	font-weight: <?php echo $smof_data['navigation_weight'] ?>;
	}
.l-header .touch_disabled .w-nav-item.level_1 {
	font-size: <?php echo $smof_data['nav_fontsize']; ?>px;
	}
.l-header .touch_disabled .w-nav-item.level_2,
.l-header .touch_disabled .w-nav-item.level_3 {
	font-size: <?php echo $smof_data['subnav_fontsize']; ?>px;
	}
.l-header .touch_enabled .w-nav-item.level_1 {
	font-size: <?php echo $smof_data['nav_fontsize_mobile']; ?>px;
	}
.l-header .touch_enabled .w-nav-item.level_2,
.l-header .touch_enabled .w-nav-item.level_3 {
	font-size: <?php echo $smof_data['subnav_fontsize_mobile']; ?>px;
	}
	
body {
	font-family: '<?php echo $smof_data['body_text_font']; ?>';
	font-size: <?php echo $smof_data['regular_fontsize']; ?>px;
	line-height: <?php echo $smof_data['regular_lineheight']; ?>px;
	font-weight: <?php echo $smof_data['body_text_weight'] ?>;
	}
h1, h2, h3, h4, h5, h6,
.w-counter-number,
.w-pricing-item-price,
.w-tabs-item-title {
	font-family: '<?php echo $smof_data['heading_font']; ?>';
	font-weight: <?php echo $smof_data['heading_weight']; ?>;
	}
.w-logo-title {
	font-family: '<?php echo $smof_data['heading_font']; ?>';
	}
h1.mega-heading {
	font-size: <?php echo $smof_data['mega_fontsize']; ?>px;
	}
h1 {
	font-size: <?php echo $smof_data['h1_fontsize']; ?>px;
	}
h2 {
	font-size: <?php echo $smof_data['h2_fontsize']; ?>px;
	}
h3 {
	font-size: <?php echo $smof_data['h3_fontsize']; ?>px;
	}
h4, .w-portfolio-item-title, .w-blog-entry-title, .widgettitle {
	font-size: <?php echo $smof_data['h4_fontsize']; ?>px;
	}
h5 {
	font-size: <?php echo $smof_data['h5_fontsize']; ?>px;
	}
h6 {
	font-size: <?php echo $smof_data['h6_fontsize']; ?>px;
	}
@media only screen and (max-width: 767px) {
body {
	font-size: <?php echo $smof_data['regular_fontsize_mobile']; ?>px;
	line-height: <?php echo $smof_data['regular_lineheight_mobile']; ?>px;
	}
h1.mega-heading {
	font-size: <?php echo $smof_data['mega_fontsize_mobile']; ?>px;
	}
h1 {
	font-size: <?php echo $smof_data['h1_fontsize_mobile']; ?>px;
	}
h2 {
	font-size: <?php echo $smof_data['h2_fontsize_mobile']; ?>px;
	}
h3 {
	font-size: <?php echo $smof_data['h3_fontsize_mobile']; ?>px;
	}
h4, .w-portfolio-item-title, .w-blog-entry-title, .widgettitle {
	font-size: <?php echo $smof_data['h4_fontsize_mobile']; ?>px;
	}
h5 {
	font-size: <?php echo $smof_data['h5_fontsize_mobile']; ?>px;
	}
h6 {
	font-size: <?php echo $smof_data['h6_fontsize_mobile']; ?>px;
	}
}
<?php if (empty($output_styles_to_file) OR $output_styles_to_file == FALSE): ?>
</style>
<style id="us_colors_inline">
<?php endif; ?>
/*************************** HEADER ***************************/

/* Header Background Color */
.l-preloader,
.l-header,
.l-border,
.l-header .touch_enabled .w-nav-list.level_1 {
	background-color: <?php echo ($smof_data['header_bg'] != '')?$smof_data['header_bg']:'#fff'; ?>;
	}
.touch_disabled .btn .w-nav-anchor.level_1 {
	color: <?php echo ($smof_data['header_bg'] != '')?$smof_data['header_bg']:'#fff'; ?>;
	}
	
/* Menu Color */
.l-preloader,
.l-header {
	color: <?php echo ($smof_data['menu_text'] != '')?$smof_data['menu_text']:'#444'; ?>;
	}

/* Menu Hover Color */
.no-touch .w-logo-link:hover,
.no-touch .w-cart-link:hover,
.no-touch .w-cart-link:hover .w-cart-quantity,
.no-touch .l-header .w-socials-item-link:hover,
.no-touch .l-header .w-nav-item.level_1:hover .w-nav-anchor.level_1,
.no-touch .l-header .w-nav-item.level_1.active:hover .w-nav-anchor.level_1,
.no-touch .l-header .w-nav-item.level_1.current-menu-item:hover .w-nav-anchor.level_1,
.no-touch .l-header .w-nav-item.level_1.current-menu-ancestor:hover .w-nav-anchor.level_1 {
	border-color: <?php echo ($smof_data['menu_hover_text'] != '')?$smof_data['menu_hover_text']:'#fda527'; ?>;
	color: <?php echo ($smof_data['menu_hover_text'] != '')?$smof_data['menu_hover_text']:'#fda527'; ?>;
	}
.touch_disabled .btn .w-nav-anchor.level_1 {
	background-color: <?php echo ($smof_data['menu_hover_text'] != '')?$smof_data['menu_hover_text']:'#fda527'; ?>;
	}

/* Menu Active Color */
.w-cart-quantity,
.w-nav.open .w-nav-control,
.l-header .w-nav-item.level_1.active .w-nav-anchor.level_1,
.l-header .w-nav-item.level_1.current-menu-item .w-nav-anchor.level_1,
.l-header .w-nav-item.level_1.current-menu-ancestor .w-nav-anchor.level_1 {
	border-color: <?php echo ($smof_data['menu_active_text'] != '')?$smof_data['menu_active_text']:'#fe4641'; ?>;
	color: <?php echo ($smof_data['menu_active_text'] != '')?$smof_data['menu_active_text']:'#fe4641'; ?>;
	}
	
/* Dropdown Background Color */
.l-header .w-nav-list.level_2,
.l-header .w-nav-list.level_3 {
	background-color: <?php echo ($smof_data['drop_bg'] != '')?$smof_data['drop_bg']:'#fff'; ?>;
	}
	
/* Dropdown Text Color */
.l-header .w-nav-anchor.level_2,
.l-header .w-nav-anchor.level_3,
.touch_disabled [class*="columns"] .w-nav-item.has_sublevel.active .w-nav-anchor.level_2,
.touch_disabled [class*="columns"] .w-nav-item.has_sublevel.current-menu-item .w-nav-anchor.level_2,
.touch_disabled [class*="columns"] .w-nav-item.has_sublevel.current-menu-ancestor .w-nav-anchor.level_2,
.no-touch .touch_disabled [class*="columns"] .w-nav-item.has_sublevel:hover .w-nav-anchor.level_2 {
	color: <?php echo ($smof_data['drop_text'] != '')?$smof_data['drop_text']:'#444'; ?>;
	}
	
/* Dropdown Hover Background Color */
.no-touch .l-header .w-nav-item.level_2:hover .w-nav-anchor.level_2,
.no-touch .l-header .w-nav-item.level_3:hover .w-nav-anchor.level_3 {
	background-color: <?php echo ($smof_data['drop_hover_bg'] != '')?$smof_data['drop_hover_bg']:'#fff'; ?>;
	}
	
/* Dropdown Hover Text Color */
.no-touch .l-header .w-nav-item.level_2:hover .w-nav-anchor.level_2,
.no-touch .l-header .w-nav-item.level_3:hover .w-nav-anchor.level_3 {
	color: <?php echo ($smof_data['drop_hover_text'] != '')?$smof_data['drop_hover_text']:'#fda527'; ?>;
	}
	
/* Dropdown Active Background Color */
.l-header .w-nav-item.level_2.active .w-nav-anchor.level_2,
.l-header .w-nav-item.level_2.current-menu-item .w-nav-anchor.level_2,
.l-header .w-nav-item.level_2.current-menu-ancestor .w-nav-anchor.level_2,
.l-header .w-nav-item.level_3.active .w-nav-anchor.level_3,
.l-header .w-nav-item.level_3.current-menu-item .w-nav-anchor.level_3,
.l-header .w-nav-item.level_3.current-menu-ancestor .w-nav-anchor.level_3 {
	background-color: <?php echo ($smof_data['drop_active_bg'] != '')?$smof_data['drop_active_bg']:'#fff'; ?>;
	}
	
/* Dropdown Active Text Color */
.l-header .w-nav-item.level_2.active .w-nav-anchor.level_2,
.l-header .w-nav-item.level_2.current-menu-item .w-nav-anchor.level_2,
.l-header .w-nav-item.level_2.current-menu-ancestor .w-nav-anchor.level_2,
.l-header .w-nav-item.level_3.active .w-nav-anchor.level_3,
.l-header .w-nav-item.level_3.current-menu-item .w-nav-anchor.level_3,
.l-header .w-nav-item.level_3.current-menu-ancestor .w-nav-anchor.level_3 {
	color: <?php echo ($smof_data['drop_active_text'] != '')?$smof_data['drop_active_text']:'#fe4641'; ?>;
	}
	
/*************************** MAIN CONTENT ***************************/

/* Background Color */
.l-section,
.l-portfolio,
.w-cart-dropdown,
.w-blog.imgpos_atleft.circle .w-blog-meta-date,
.w-tabs-item-h:after,
.woocommerce.widget_price_filter .ui-slider .ui-slider-handle,
.woocommerce .star-rating span:before,
.woocommerce .stars span a:after {
	background-color: <?php echo ($smof_data['main_bg'] != '')?$smof_data['main_bg']:'#fff'; ?>;
	}
button.g-btn.color_text,
a.g-btn.color_text,
.no-touch button.g-btn.color_text.outlined:hover,
.no-touch a.g-btn.color_text.outlined:hover,
.no-touch .woocommerce .button:hover {
	color: <?php echo ($smof_data['main_bg'] != '')?$smof_data['main_bg']:'#fff'; ?>;
	}

/* Border Color */
input[type="text"],
input[type="password"],
input[type="email"],
input[type="url"],
input[type="tel"],
input[type="number"],
input[type="date"],
textarea,
select,
.w-comments,
.w-comments-list,
.w-tabs.layout_accordion .w-tabs-section,
.w-testimonial,
#wp-calendar thead th,
#wp-calendar tbody td,
#wp-calendar tfoot td,
.widget.widget_nav_menu .menu,
.widget.widget_nav_menu .menu-item a,
.woocommerce form.login,
.woocommerce form.checkout_coupon,
.woocommerce form.register,
.woocommerce div.product .cart.variations_form,
.woocommerce div.product .cart table.group_table,
.woocommerce div.product .cart table.group_table td,
.woocommerce table.shop_attributes th,
.woocommerce table.shop_attributes td,
.woocommerce #reviews #comments .commentlist li,
.woocommerce .comment-respond,
.woocommerce .related,
.woocommerce .upsells,
.woocommerce .cross-sells,
.woocommerce table.shop_table td,
.woocommerce table.shop_table tfoot th,
.woocommerce .cart-collaterals .cart_totals td,
.woocommerce .cart-collaterals .cart_totals th,
.woocommerce .checkout #order_review,
.woocommerce .checkout table.shop_table,
.woocommerce ul.order_details li,
.woocommerce table.shop_table.order_details,
.woocommerce table.shop_table.my_account_orders,
.woocommerce.widget.widget_layered_nav ul,
.woocommerce.widget.widget_layered_nav ul li {
	border-color: <?php echo ($smof_data['main_border'] != '')?$smof_data['main_border']:'#e5e5e5'; ?>;
	}
.g-hr-h:before,
.g-hr-h:after,
.woocommerce.widget_price_filter .ui-slider {
	background-color: <?php echo ($smof_data['main_border'] != '')?$smof_data['main_border']:'#e5e5e5'; ?>;
	}
.g-hr-h i {
	color: <?php echo ($smof_data['main_border'] != '')?$smof_data['main_border']:'#e5e5e5'; ?>;
	}

/* Text Color */
.l-section,
.l-portfolio,
.no-touch button.g-btn.color_text:hover,
.no-touch a.g-btn.color_text:hover,
.w-blog.imgpos_atleft.circle .w-blog-meta-date,
.w-cart-dropdown,
.w-iconbox.color_text .w-iconbox-icon {
	color: <?php echo ($smof_data['main_text'] != '')?$smof_data['main_text']:'#444'; ?>;
	}
button.g-btn.color_text,
a.g-btn.color_text,
.no-touch button.g-btn.color_text:hover,
.no-touch a.g-btn.color_text:hover,
.no-touch .w-blog.type_masonry .w-blog-entry:hover,
.w-icon.outline .w-icon-link,
.w-iconbox.color_text.outline .w-iconbox-icon,
.woocommerce .button,
.woocommerce.widget_price_filter .ui-slider .ui-slider-handle,
.no-touch .woocommerce .button:hover,
.no-touch .woocommerce .products .product:hover {
	border-color: <?php echo ($smof_data['main_text'] != '')?$smof_data['main_text']:'#444'; ?>;
	}
button.g-btn.color_text,
a.g-btn.color_text,
.no-touch button.g-btn.color_text.outlined:hover,
.no-touch a.g-btn.color_text.outlined:hover,
.no-touch .w-icon.outline a.w-icon-link:hover,
.no-touch .w-iconbox.color_text.outline a:hover .w-iconbox-icon,
.no-touch .woocommerce .button:hover {
	background-color: <?php echo ($smof_data['main_text'] != '')?$smof_data['main_text']:'#444'; ?>;
	}

/* Primary Color */
a,
.highlight_primary,
.no-touch button.g-btn.color_primary:hover,
.no-touch a.g-btn.color_primary:hover,
.no-touch input[type="submit"]:hover,
button.g-btn.color_primary.outlined,
a.g-btn.color_primary.outlined,
.l-section.color_primary button.g-btn.color_white,
.l-section.color_primary a.g-btn.color_white,
.no-touch .l-section.color_primary button.g-btn.color_white.outlined:hover,
.no-touch .l-section.color_primary a.g-btn.color_white.outlined:hover,
.w-actionbox.color_primary .g-btn.color_white,
.w-counter.color_primary .w-counter-number,
.w-icon.color_primary .w-icon-link,
.w-iconbox.color_primary .w-iconbox-icon,
.no-touch .w-icon.color_secondary a.w-icon-link:hover,
.no-touch .w-iconbox.color_secondary a:hover .w-iconbox-icon,
.w-filter-item.active .w-filter-link,
.no-touch .w-filter-item.active .w-filter-link:hover,
.w-form-field > input:focus + i,
.w-form-field > textarea:focus + i,
.pagination .page-numbers.current,
.no-touch .pagination .page-numbers.current:hover,
.w-pricing-item.type_featured .w-pricing-item-title,
.w-pricing-item.type_featured .w-pricing-item-price span,
.w-tabs-item.active,
.w-tabs.layout_accordion .w-tabs-section.active .w-tabs-section-header,
.w-testimonial-person-name,
.woocommerce .button.alt,
.woocommerce .button.checkout,
.woocommerce .products .product .button,
.woocommerce .woocommerce-pagination ul li span.current,
.woocommerce div.product .woocommerce-tabs .tabs li.active,
.woocommerce .cart-collaterals .cart_totals tr.total,
.woocommerce .checkout table.shop_table .total {
	color: <?php echo ($smof_data['main_primary'] != '')?$smof_data['main_primary']:'#fe4641'; ?>;
	}
.g-html blockquote,
input[type="text"]:focus,
input[type="password"]:focus,
input[type="email"]:focus,
input[type="url"]:focus,
input[type="tel"]:focus,
input[type="number"]:focus,
input[type="date"]:focus,
textarea:focus,
select:focus,
button.g-btn.color_primary,
a.g-btn.color_primary,
input[type="submit"],
.no-touch button.g-btn.color_primary:hover,
.no-touch a.g-btn.color_primary:hover,
.no-touch input[type="submit"]:hover,
.w-icon.color_primary.outline .w-icon-link,
.w-iconbox.color_primary.outline .w-iconbox-icon,
.w-filter-item.active .w-filter-link,
.no-touch .w-filter-item.active .w-filter-link:hover,
.pagination .page-numbers.current,
.no-touch .pagination .page-numbers.current:hover,
.w-pricing-item.type_featured .w-pricing-item-h,
.woocommerce .button.alt,
.woocommerce .button.checkout,
.woocommerce .products .product .button,
.no-touch .woocommerce .button.alt:hover,
.no-touch .woocommerce .button.checkout:hover,
.no-touch .woocommerce .products .product .button:hover,
.woocommerce .quantity input.qty:focus,
.woocommerce .woocommerce-pagination ul li span.current {
	border-color: <?php echo ($smof_data['main_primary'] != '')?$smof_data['main_primary']:'#fe4641'; ?>;
	}
.l-section.color_primary,
.l-section.color_primary .w-portfolio-item-anchor,
.highlight_primary_bg,
button.g-btn.color_primary,
a.g-btn.color_primary,
input[type="submit"],
.no-touch button.g-btn.color_primary.outlined:hover,
.no-touch a.g-btn.color_primary.outlined:hover,
.w-actionbox.color_primary,
.no-touch .w-icon.color_primary.outline a.w-icon-link:hover,
.no-touch .w-iconbox.color_primary.outline a:hover .w-iconbox-icon,
.widget.widget_nav_menu .menu-item.current-menu-item > a,
.no-touch .woocommerce .button.alt:hover,
.no-touch .woocommerce .button.checkout:hover,
.no-touch .woocommerce .products .product .button:hover,
.woocommerce .onsale,
.woocommerce.widget_price_filter .ui-slider .ui-slider-range,
p.demo_store {
	background-color: <?php echo ($smof_data['main_primary'] != '')?$smof_data['main_primary']:'#fe4641'; ?>;
	}

/* Secondary Color */
a:active,
.no-touch a:hover,
.highlight_secondary,
.no-touch button.g-btn.color_secondary:hover,
.no-touch a.g-btn.color_secondary:hover,
button.g-btn.color_secondary.outlined,
a.g-btn.color_secondary.outlined,
.l-section.color_secondary button.g-btn.color_white,
.l-section.color_secondary a.g-btn.color_white,
.no-touch .l-section.color_secondary button.g-btn.color_white.outlined:hover,
.no-touch .l-section.color_secondary a.g-btn.color_white.outlined:hover,
.w-actionbox.color_secondary .g-btn.color_white,
.w-counter.color_secondary .w-counter-number,
.no-touch a.w-icon-link:hover,
.no-touch a:hover .w-iconbox-icon,
.no-touch .slick-prev:hover,
.no-touch .slick-next:hover,
.w-icon.color_secondary .w-icon-link,
.w-iconbox.color_secondary .w-iconbox-icon,
.no-touch .w-filter-link:hover,
.no-touch .pagination .page-numbers:hover,
.no-touch .w-team.type_3 .w-team-links-item:hover,
.no-touch .w-team.type_4 .w-team-links-item:hover,
.no-touch .widget.widget_tag_cloud .tagcloud a:hover,
.woocommerce .star-rating span:before,
.woocommerce .stars span a:after,
.no-touch .woocommerce .woocommerce-pagination ul li a:hover,
.no-touch .woocommerce.widget.widget_product_tag_cloud .tagcloud a:hover,
.no-touch .woocommerce table.shop_table .product-remove a.remove:hover {
	color: <?php echo ($smof_data['main_secondary'] != '')?$smof_data['main_secondary']:'#fda527'; ?>;
	}
button.g-btn.color_secondary,
a.g-btn.color_secondary,
.no-touch button.g-btn.color_secondary:hover,
.no-touch a.g-btn.color_secondary:hover,
.no-touch .w-clients-item-h:hover,
.no-touch .slick-prev:hover,
.no-touch .slick-next:hover,
.w-icon.color_secondary.outline .w-icon-link,
.w-iconbox.color_secondary.outline .w-iconbox-icon,
.no-touch .w-filter-link:hover,
.no-touch .pagination .page-numbers:hover,
.no-touch .w-testimonial:hover,
.no-touch .woocommerce .woocommerce-pagination ul li a:hover,
.no-touch .woocommerce table.shop_table .product-remove a.remove:hover {
	border-color: <?php echo ($smof_data['main_secondary'] != '')?$smof_data['main_secondary']:'#fda527'; ?>;
	}
.l-section.color_secondary,
.l-section.color_secondary .w-portfolio-item-anchor,
button.g-btn.color_secondary,
a.g-btn.color_secondary,
.no-touch button.g-btn.color_secondary.outlined:hover,
.no-touch a.g-btn.color_secondary.outlined:hover,
.w-actionbox.color_secondary,
.highlight_secondary_bg,
.no-touch .w-icon.color_secondary.outline a.w-icon-link:hover,
.no-touch .w-iconbox.color_secondary.outline a:hover .w-iconbox-icon,
.no-touch .widget.widget_nav_menu .menu-item a:hover,
.no-touch .tp-leftarrow.tparrows:hover,
.no-touch .tp-rightarrow.tparrows:hover,
.no-touch .w-gallery.default .slick-prev:hover,
.no-touch .w-gallery.default .slick-next:hover {
	background-color: <?php echo ($smof_data['main_secondary'] != '')?$smof_data['main_secondary']:'#fda527'; ?>;
	}
	
/* Faded Color */
.highlight_faded,
.no-touch button.g-btn.color_faded:hover,
.no-touch a.g-btn.color_faded:hover,
button.g-btn.color_faded.outlined,
a.g-btn.color_faded.outlined,
.w-blog-meta,
.w-counter.color_faded .w-counter-number,
.w-icon.color_faded .w-icon-link,
.w-iconbox.color_faded .w-iconbox-icon,
.w-socials-item-link,
.w-team-links-item,
.widget.widget_tag_cloud .tagcloud a,
.woocommerce .woocommerce-breadcrumb,
.woocommerce .star-rating:before,
.woocommerce .stars span:after,
.woocommerce table.shop_table .product-remove a.remove,
.woocommerce.widget.widget_product_tag_cloud .tagcloud a {
	color: <?php echo ($smof_data['main_faded'] != '')?$smof_data['main_faded']:'#999'; ?>;
	}
button.g-btn.color_faded,
a.g-btn.color_faded,
.no-touch button.g-btn.color_faded:hover,
.no-touch a.g-btn.color_faded:hover,
.w-icon.color_faded.outline .w-icon-link,
.w-iconbox.color_faded.outline .w-iconbox-icon,
.w-pricing-item-h {
	border-color: <?php echo ($smof_data['main_faded'] != '')?$smof_data['main_faded']:'#999'; ?>;
	}
.highlight_faded_bg,
button.g-btn.color_faded,
a.g-btn.color_faded,
.no-touch button.g-btn.color_faded.outlined:hover,
.no-touch a.g-btn.color_faded.outlined:hover,
.no-touch .w-icon.color_faded.outline a.w-icon-link:hover,
.no-touch .w-iconbox.color_faded.outline a:hover .w-iconbox-icon {
	background-color: <?php echo ($smof_data['main_faded'] != '')?$smof_data['main_faded']:'#999'; ?>;
	}

/*************************** FOOTER ***************************/

/* Background Color */
.l-footer {
	background-color: <?php echo ($smof_data['footer_bg'] != '')?$smof_data['footer_bg']:'#252525'; ?>;
	}
.no-touch .l-footer .widget.widget_nav_menu .menu-item a:hover {
	color: <?php echo ($smof_data['footer_bg'] != '')?$smof_data['footer_bg']:'#252525'; ?>;
	}

/* Border Color */
.l-subfooter.at_top,
.l-footer input[type="text"],
.l-footer input[type="password"],
.l-footer input[type="email"],
.l-footer input[type="url"],
.l-footer input[type="tel"],
.l-footer input[type="number"],
.l-footer input[type="date"],
.l-footer textarea,
.l-footer select,
.l-footer #wp-calendar thead th,
.l-footer #wp-calendar tbody td,
.l-footer #wp-calendar tfoot td,
.l-footer .widget.widget_nav_menu .menu,
.l-footer .widget.widget_nav_menu .menu-item a {
	border-color: <?php echo ($smof_data['footer_border'] != '')?$smof_data['footer_border']:'#333'; ?>;
	}

/* Text Color */
.l-footer {
	color: <?php echo ($smof_data['footer_text'] != '')?$smof_data['footer_text']:'#999'; ?>;
	}

/* Link Color */
.l-footer a,
.l-footer .w-form-field > input:focus + i,
.l-footer .w-form-field > textarea:focus + i {
	color: <?php echo ($smof_data['footer_link'] != '')?$smof_data['footer_link']:'#fe4641'; ?>;
	}
.l-footer input[type="text"]:focus,
.l-footer input[type="password"]:focus,
.l-footer input[type="email"]:focus,
.l-footer input[type="url"]:focus,
.l-footer input[type="tel"]:focus,
.l-footer input[type="number"]:focus,
.l-footer input[type="date"]:focus,
.l-footer textarea:focus,
.l-footer select:focus {
	border-color: <?php echo ($smof_data['footer_link'] != '')?$smof_data['footer_link']:'#fe4641'; ?>;
	}
.no-touch .l-footer .widget.widget_nav_menu .menu-item a:hover {
	background-color: <?php echo ($smof_data['footer_link'] != '')?$smof_data['footer_link']:'#fe4641'; ?>;
	}

/* Link Hover Color */
.no-touch .l-footer a:hover,
.l-footer a:active,
.l-footer .widget.widget_nav_menu .menu-item.current-menu-item a,
.no-touch .l-footer .w-tags-item-link:hover,
.no-touch .l-footer .widget.widget_tag_cloud .tagcloud a:hover {
	color: <?php echo ($smof_data['footer_link_hover'] != '')?$smof_data['footer_link_hover']:'#fda527'; ?>;
	}
.no-touch .l-footer .w-socials-item .w-socials-item-link:hover {
	border-color: <?php echo ($smof_data['footer_link_hover'] != '')?$smof_data['footer_link_hover']:'#fda527'; ?>;
	}

<?php if (empty($output_styles_to_file) OR $output_styles_to_file == FALSE): ?>
</style>
<?php endif; ?>
<?php if ($smof_data['custom_css'] != ''): ?>
	<?php if (empty($output_styles_to_file) OR $output_styles_to_file == FALSE): ?><style><?php endif; ?>

	<?php echo $smof_data['custom_css']; ?>

	<?php if (empty($output_styles_to_file) OR $output_styles_to_file == FALSE): ?></style><?php endif; ?>
<?php endif; ?>
