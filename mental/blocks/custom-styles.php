<?php
/**
 * Custom generated theme styles
 *
 * @author Vedmant <vedmant@gmail.com>
 * @package Mental WP
 * @link http://azelab.com
 */
?>

<style>

/*!========================================================================= *\
	Theme Custom Settings styles
\* ========================================================================= */

<?php
$color_primary = '';
$color_background_primary = '';
$color_text_primary = '';
$color_secondary = '';
$color_tertiary = '';
$color_quaternary = '';
$color_menubar_background = '';
$color_menubar_handle = '';
$color_topmenu ='';
$color_menu ='';
$color_active_menu ='';
$color_menu_hover ='';
$bg_submenu ='';
$color_active_menu = '';
$color_submenu ='';
$color_submenu_hover ='';
$color_topmenu_sticky ='';
$color_topmenu_transparent ='';
$color_footer = '';
$color_footer_copyright = '';
$cart_color = '';


$skin_preset = get_mental_option( 'skin_preset' );
if( $skin_preset  && 'default' !== $skin_preset ) {
	$skin = Azl_Settings_Machine::instance()->get_skin( $skin_preset );
   extract($skin);
}
if( get_mental_option( 'color_active_menu' ) ) { $color_active_menu = get_mental_option( 'color_active_menu' ); }
if( get_mental_option( 'bg_sbmenu' ) ) { $bg_submenu = get_mental_option( 'bg_sbmenu' ); }
if( get_mental_option( 'color_sbmenu_item' ) ) { $color_submenu = get_mental_option( 'color_sbmenu_item' ); }
if( get_mental_option( 'color_sbmenuh_item' ) ) { $color_submenu_hover = get_mental_option( 'color_sbmenuh_item' ); }
if( get_mental_option( 'color_menu_hover' ) ) { $color_menu_hover = get_mental_option( 'color_menu_hover' ); }
if( get_mental_option( 'color_menu_item' ) ) { $color_menu = get_mental_option( 'color_menu_item' ); }
if( get_mental_option( 'color_primary' ) ) { $color_primary = get_mental_option( 'color_primary' ); }
if( get_mental_option( 'color_text_primary' ) ) { $color_text_primary = get_mental_option( 'color_text_primary' ); }
if( get_mental_option( 'color_background_primary' ) ) { $color_background_primary = get_mental_option( 'color_background_primary' ); }
if( get_mental_option( 'color_secondary' ) ) { $color_secondary = get_mental_option( 'color_secondary' ); }
if( get_mental_option( 'color_tertiary' ) ) { $color_tertiary = get_mental_option( 'color_tertiary' ); }
if( get_mental_option( 'color_quaternary' ) ) { $color_quaternary = get_mental_option( 'color_quaternary' ); }
if( get_mental_option( 'color_menubar_background' ) ) { $color_menubar_background = get_mental_option( 'color_menubar_background' ); }
if( get_mental_option( 'color_menubar_handle' ) ) { $color_menubar_handle = get_mental_option( 'color_menubar_handle' ); }
if( get_mental_option( 'color_topmenu' ) ) { $color_topmenu = get_mental_option( 'color_topmenu' ); }
if( get_mental_option( 'color_topmenu_sticky' ) ) { $color_topmenu_sticky = get_mental_option( 'color_topmenu_sticky' ); }
if( get_mental_option( 'color_topmenu_transparent' ) ) { $color_topmenu_transparent = get_mental_option( 'color_topmenu_transparent' ); }
if( get_mental_option( 'color_footer' ) ) { $color_footer = get_mental_option( 'color_footer' ); }
if( get_mental_option( 'color_footer_copyright' ) ) { $color_footer_copyright = get_mental_option( 'color_footer_copyright' ); }
if( get_mental_option( 'border_color' ) ) { $border_color = get_mental_option( 'border_color' ); }
if( get_mental_option( 'border_w' ) ) { $border_w = get_mental_option( 'border_w' ); }
if ( class_exists( 'WooCommerce' ) ) {if( get_mental_option( 'cart_color' ) ) { $cart_color = get_mental_option( 'cart_color' );}}

?>

<?php if($color_primary): // #76d898 ?>



/*!========================================================================= *\
	Border setting
\* ========================================================================= */

<?php if(!empty($border_w)) { ?>
.footer.widget-footer, body {
    border: <?php echo ($border_w); ?>px solid <?php echo mental_hex_color($border_color); ?>;
}

.footer.widget-footer {
    border-top: none;
}

<?php } ?>


/*!========================================================================= *\
	Menu Color
\* ========================================================================= */
.top-main-menu li > a {
    color: <?php echo mental_hex_color($color_menu); ?>;
}

.top-main-menu li > a:hover {
    color: <?php echo mental_hex_color($color_menu_hover); ?> !important;
}

.mtmenu ul.dropdown li a {
    color: <?php echo mental_hex_color($color_submenu); ?>;
}

.mtmenu ul.dropdown li a:hover {
    color: <?php echo mental_hex_color($color_submenu_hover); ?> !important;
}

.mtmenu ul.dropdown {
    background-color: <?php echo mental_hex_color($bg_submenu); ?> ;
}

.top-main-menu li.current_page_item > a {
    color: <?php echo mental_hex_color($color_active_menu); ?>;
}


/*!========================================================================= *\
	Shopping cart olor
\* ========================================================================= */

.card-icon  i {
    color: <?php echo mental_hex_color($cart_color); ?>;
}


/*!========================================================================= *\
	Primary Color
\* ========================================================================= */

.text-primary,
.btn:hover, .btn:focus,
.btn-default, .btn-default:hover, .btn-default:focus, .btn-default:active, .btn-default.active, .open > .btn-default.dropdown-toggle,
.btn-primary, .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open > .btn-primary.dropdown-toggle,
.btn-link,
.pagination > li > a, .pagination > li > span,
.progress-bar,
.mtmenu ul.dropdown li:hover > a,
a, a:hover, a:focus, a:active,
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover,
#mental_lang_sel a:hover,
div.wpcf7-mail-sent-ok,
.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price,
.woocommerce .woocommerce-product-rating, .woocommerce-page .woocommerce-product-rating,
.button, .woocommerce #review_form #respond .form-submit input, .woocommerce-page #review_form #respond .form-submit input, .woocommerce a.added_to_cart, .woocommerce-page a.added_to_cart, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce-page .widget_price_filter .price_slider_amount .button,
.button:hover, .button:focus, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce #review_form #respond .form-submit input:focus, .woocommerce-page #review_form #respond .form-submit input:hover, .woocommerce-page #review_form #respond .form-submit input:focus, .woocommerce a.added_to_cart:hover, .woocommerce a.added_to_cart:focus, .woocommerce-page a.added_to_cart:hover, .woocommerce-page a.added_to_cart:focus, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce .widget_price_filter .price_slider_amount .button:focus, .woocommerce-page .widget_price_filter .price_slider_amount .button:hover, .woocommerce-page .widget_price_filter .price_slider_amount .button:focus,
.button.alt, .woocommerce a.added_to_cart, .woocommerce-page a.added_to_cart, .woocommerce #review_form #respond .form-submit input, .woocommerce-page #review_form #respond .form-submit input,
.button.alt:hover, .button.alt:focus, .button.alt:active, .button.alt.active, .open > .button.alt.dropdown-toggle, .woocommerce a.added_to_cart:hover, .woocommerce a.added_to_cart:focus, .woocommerce a.added_to_cart:active, .woocommerce a.added_to_cart.active, .open > .woocommerce a.added_to_cart.dropdown-toggle, .woocommerce-page a.added_to_cart:hover, .woocommerce-page a.added_to_cart:focus, .woocommerce-page a.added_to_cart:active, .woocommerce-page a.added_to_cart.active, .open > .woocommerce-page a.added_to_cart.dropdown-toggle, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce #review_form #respond .form-submit input:focus, .woocommerce #review_form #respond .form-submit input:active, .woocommerce #review_form #respond .form-submit input.active, .open > .woocommerce #review_form #respond .form-submit input.dropdown-toggle, .woocommerce-page #review_form #respond .form-submit input:hover, .woocommerce-page #review_form #respond .form-submit input:focus, .woocommerce-page #review_form #respond .form-submit input:active, .woocommerce-page #review_form #respond .form-submit input.active, .open > .woocommerce-page #review_form #respond .form-submit input.dropdown-toggle,
.woocommerce .woocommerce-message:before, .woocommerce-page .woocommerce-message:before, .woocommerce .woocommerce-error:before, .woocommerce-page .woocommerce-error:before, .woocommerce .woocommerce-info:before, .woocommerce-page .woocommerce-info:before,
.woocommerce .woocommerce-message .button.wc-forward, .woocommerce-page .woocommerce-message .button.wc-forward, .woocommerce .woocommerce-error .button.wc-forward, .woocommerce-page .woocommerce-error .button.wc-forward, .woocommerce .woocommerce-info .button.wc-forward, .woocommerce-page .woocommerce-info .button.wc-forward,
.woocommerce .cart-collaterals .shipping_calculator .shipping-calculator-button:before, .woocommerce-page .cart-collaterals .shipping_calculator .shipping-calculator-button:before,
#menu-bar a.mb-toggler,
.mb-social > a:hover,
ul#mb-main-menu li a:hover, ul#mb-main-menu li.active > a, ul#mb-main-menu li.current_page_item > a, nav#mb-main-menu > ul li a:hover, nav#mb-main-menu > ul li.active > a, nav#mb-main-menu > ul li.current_page_item > a, nav#mb-main-menu > div > ul li a:hover, nav#mb-main-menu > div > ul li.active > a, nav#mb-main-menu > div > ul li.current_page_item > a, .widget ul.menu li a:hover, .widget ul.menu li.active > a, .widget ul.menu li.current_page_item > a,
.social-block > a,
.some-ff-block .smm-icon,
.services-item .sws-icon,
.price-table:hover .price-header h3, .price-table.active .price-header h3,
.ft-single-post a:hover,
.ft-single-post .ft-prev-post:hover, .ft-single-post .ft-next-post:hover,
.widget .wg-popular-posts li .wg-pp-title a:hover,
.widget .wpp-list .wpp-comments a:hover, .widget .wpp-list .wpp-views a:hover,
.btn-tag:hover, .tagcloud > a:hover,
.ls-mental-title-onepage,
.ls-mental-back2gallery a,
.top-main-menu li > a:hover,
.top-main-menu li.active > a,
#preloader i,
ul.gallery-filters > li.active > a, ul.gallery-filters > li a:hover,
.gallery .gl-item.gl-loading:after,
.cssanimations .loading-spinner, .glp-product-buttons a.button, .glp-product-buttons a.button:hover, .woocommerce div.product form.cart .single_add_to_cart_button, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #review_form #respond .form-submit input, .woocommerce-page #review_form #respond .form-submit input, .woocommerce a.added_to_cart, .woocommerce-page a.added_to_cart, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce-page .widget_price_filter .price_slider_amount .button, .shipping-calculator-button, .wc-proceed-to-checkout a.checkout-button.button, .wc-proceed-to-checkout a.checkout-button.button:hover, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.added_to_cart, .woocommerce-page a.added_to_cart, .woocommerce #review_form #respond .form-submit input, .woocommerce-page #review_form #respond .form-submit input, .woocommerce a.button.add_to_cart_button, .woocommerce input.button[name="save_account_details"], .woocommerce input.button[name="save_address"], .woocommerce input.button[name="login"], .woocommerce input.button[name="register"], .woocommerce .lost_reset_password input.button[type="submit"], .woocommerce a.button.alt:hover, .woocommerce a.button.alt:focus, .woocommerce a.button.alt:active, .woocommerce a.button.alt.active, .open > .woocommerce a.button.alt.dropdown-toggle, .woocommerce button.button.alt:hover, .woocommerce button.button.alt:focus, .woocommerce button.button.alt:active, .woocommerce button.button.alt.active, .open > .woocommerce button.button.alt.dropdown-toggle, .woocommerce input.button.alt:hover, .woocommerce input.button.alt:focus, .woocommerce input.button.alt:active, .woocommerce input.button.alt.active, .open > .woocommerce input.button.alt.dropdown-toggle, .woocommerce #respond input#submit:hover, .woocommerce #respond input#submit:focus, .woocommerce #respond input#submit:active, .woocommerce #respond input#submit.active, .open > .woocommerce #respond input#submit.dropdown-toggle, .woocommerce a.added_to_cart:hover, .woocommerce a.added_to_cart:focus, .woocommerce a.added_to_cart:active, .woocommerce a.added_to_cart.active, .open > .woocommerce a.added_to_cart.dropdown-toggle, .woocommerce-page a.added_to_cart:hover, .woocommerce-page a.added_to_cart:focus, .woocommerce-page a.added_to_cart:active, .woocommerce-page a.added_to_cart.active, .open > .woocommerce-page a.added_to_cart.dropdown-toggle, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce #review_form #respond .form-submit input:focus, .woocommerce #review_form #respond .form-submit input:active, .woocommerce #review_form #respond .form-submit input.active, .open > .woocommerce #review_form #respond .form-submit input.dropdown-toggle, .woocommerce-page #review_form #respond .form-submit input:hover, .woocommerce-page #review_form #respond .form-submit input:focus, .woocommerce-page #review_form #respond .form-submit input:active, .woocommerce-page #review_form #respond .form-submit input.active, .open > .woocommerce-page #review_form #respond .form-submit input.dropdown-toggle, .woocommerce a.button.add_to_cart_button:hover, .woocommerce a.button.add_to_cart_button:focus, .woocommerce a.button.add_to_cart_button:active, .woocommerce a.button.add_to_cart_button.active, .open > .woocommerce a.button.add_to_cart_button.dropdown-toggle, .woocommerce input.button[name="save_account_details"]:hover, .woocommerce input.button[name="save_account_details"]:focus, .woocommerce input.button[name="save_account_details"]:active, .woocommerce input.button[name="save_account_details"].active, .open > .woocommerce input.button[name="save_account_details"].dropdown-toggle, .woocommerce input.button[name="save_address"]:hover, .woocommerce input.button[name="save_address"]:focus, .woocommerce input.button[name="save_address"]:active, .woocommerce input.button[name="save_address"].active, .open > .woocommerce input.button[name="save_address"].dropdown-toggle, .woocommerce input.button[name="login"]:hover, .woocommerce input.button[name="login"]:focus, .woocommerce input.button[name="login"]:active, .woocommerce input.button[name="login"].active, .open > .woocommerce input.button[name="login"].dropdown-toggle, .woocommerce input.button[name="register"]:hover, .woocommerce input.button[name="register"]:focus, .woocommerce input.button[name="register"]:active, .woocommerce input.button[name="register"].active, .open > .woocommerce input.button[name="register"].dropdown-toggle, .woocommerce .lost_reset_password input.button[type="submit"]:hover, .woocommerce .lost_reset_password input.button[type="submit"]:focus, .woocommerce .lost_reset_password input.button[type="submit"]:active, .woocommerce .lost_reset_password input.button[type="submit"].active, .open > .woocommerce .lost_reset_password input.button[type="submit"].dropdown-toggle, .woocommerce a.button:hover, .woocommerce a.button:focus, .woocommerce button.button:hover, .woocommerce button.button:focus, .woocommerce input.button:hover, .woocommerce input.button:focus, .woocommerce #respond input#submit:hover, .woocommerce #respond input#submit:focus, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce #review_form #respond .form-submit input:focus, .woocommerce-page #review_form #respond .form-submit input:hover, .woocommerce-page #review_form #respond .form-submit input:focus, .woocommerce a.added_to_cart:hover, .woocommerce a.added_to_cart:focus, .woocommerce-page a.added_to_cart:hover, .woocommerce-page a.added_to_cart:focus, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce .widget_price_filter .price_slider_amount .button:focus, .woocommerce-page .widget_price_filter .price_slider_amount .button:hover, .woocommerce-page .widget_price_filter .price_slider_amount .button:focus, .shipping-calculator-button:hover, .shipping-calculator-button:focus
{
	color: <?php echo mental_hex_color($color_primary); ?>;
}

.bg-primary,
.btn-primary .badge,
.btn-default .badge,
.pagination > .active > a, .pagination > .active > a:hover, .pagination > .active > a:focus, .pagination > .active > span, .pagination > .active > span:hover, .pagination > .active > span:focus,
.progress-bar,
.button .badge, .woocommerce #review_form #respond .form-submit input .badge, .woocommerce-page #review_form #respond .form-submit input .badge, .woocommerce a.added_to_cart .badge, .woocommerce-page a.added_to_cart .badge, .woocommerce .widget_price_filter .price_slider_amount .button .badge, .woocommerce-page .widget_price_filter .price_slider_amount .button .badge,
.button.alt .badge, .woocommerce a.added_to_cart .badge, .woocommerce-page a.added_to_cart .badge, .woocommerce #review_form #respond .form-submit input .badge, .woocommerce-page #review_form #respond .form-submit input .badge,
.woocommerce span.onsale, .woocommerce-page span.onsale,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle,
.accordion-group a.accordion-header:hover,
ul.nav-tabs li.highlight a,
.carousel-testimonials .carousel-indicators li.active,
ul.gallery-filters > li.gf-underline
{
	background-color: <?php echo mental_hex_color($color_primary); ?>;
}

.nav .open > a, .nav .open > a:hover, .nav .open > a:focus,
.pagination > .active > a, .pagination > .active > a:hover, .pagination > .active > a:focus, .pagination > .active > span, .pagination > .active > span:hover, .pagination > .active > span:focus,
.carousel-testimonials .carousel-control.left span, .carousel-testimonials .carousel-control.right span,
.ft-single-post .ft-prev-post:before, .ft-single-post .ft-next-post:before,
.ls-mental-nav .ls-mn-prev:hover:after, .ls-mental-nav .ls-mn-next:hover:after
{
	border-color: <?php echo mental_hex_color($color_primary); ?>;
}

.ip-loader svg path.ip-loader-circle{
	stroke: <?php echo mental_hex_color($color_primary); ?>;
}

<?php endif ?>

<?php if($color_background_primary): // #1a1a1a ?>

/*!========================================================================= *\
	Primary Background Color
\* ========================================================================= */

@media (max-width: 991px) {
	ul.mtmenu > li,
	ul.mtmenu ul.dropdown li
	{
		background-color: <?php echo mental_hex_color($color_background_primary); ?>;
	}
}

.variations label,
.woocommerce table.cart a.remove, .woocommerce #content table.cart a.remove, .woocommerce-page table.cart a.remove, .woocommerce-page #content table.cart a.remove,
.ls-mental-desrc
{
	color: <?php echo mental_hex_color($color_background_primary); ?>;
}

.mtmenu.expanded > li.showhide,
.black-body,
#header,
.footer,
.footer .btn,
#menu-bar,
.price-table:hover .price-header, .price-table.active .price-header,
.price-table:hover .price-footer .btn-default, .price-table.active .price-footer .btn-default,
.st-invert .comment-form .btn,
.ls-mental-title,
.ls-mental-title-onepage,
ul.gallery-filters,
.gallery,
.gallery .gl-item.gl-preview,
.load-more-block.dark
{
	background-color: <?php echo mental_hex_color($color_background_primary); ?>;
}

.gallery .gl-item.gl-preview .glp-arrow {
	border-bottom-color: <?php echo mental_hex_color($color_background_primary); ?>;
}

#preloader{
	background-color: <?php echo mental_hex_color($color_background_primary); ?>;
}

<?php endif ?>


<?php if($color_text_primary): // #8e9095?>

/*!========================================================================= *\
	Primary Text Color
\* ========================================================================= */

.form-control::-moz-placeholder{color: <?php echo mental_hex_color($color_text_primary );?>;}
.form-control:-ms-input-placeholder{color: <?php echo mental_hex_color($color_text_primary );?>;}
.form-control::-webkit-input-placeholder{color: <?php echo mental_hex_color($color_text_primary );?>;}

.nav > li.disabled > a,
.nav > li.disabled > a:hover, .nav > li.disabled > a:focus,
.pagination > .disabled > span, .pagination > .disabled > span:hover, .pagination > .disabled > span:focus, .pagination > .disabled > a, .pagination > .disabled > a:hover, .pagination > .disabled > a:focus,
.progress-bar[aria-valuenow="0"],
.accordion-group a.accordion-header,
ul.nav-tabs li a,
.table > tbody > tr > td,
p,
.gallery .glp-product-price,
.gallery .glp-product-rating .star-rating span,
#header,
#header h1,
.footer,
.footer h2,
.footer .ft-copyright p span,
.section.st-invert,
.section.st-invert .section-title,
.section.st-invert h1, .section.st-invert h2, .section.st-invert h3, .section.st-invert h4, .section.st-invert h5, .section.st-invert h6,
#menu-bar h3.mb-site-title,
#menu-bar h4,
ul.price-descr li,
.testimonial .author-big,
blockquote:before,
.st-invert .comment-form .form-control,
.ft-single-post .ft-back2blog,
.ft-single-post .ft-back2gallery,
.ft-single-post .ft-prev-post, .ft-single-post .ft-next-post,
.ft-single-post .disabled,
.widget .wg-categories > li ul li, .widget .product-categories > li ul li, .widget > ul > li ul li,
.widget .wg-categories > li ul li > a, .widget .product-categories > li ul li > a, .widget > ul > li ul li > a,
.widget .wg-popular-posts li .wg-pp-title a, .widget .product_list_widget li .wg-pp-title a,
.widget .wpp-list .wpp-comments, .widget .wpp-list .wpp-views,
.widget .wpp-list .wpp-comments a, .widget .wpp-list .wpp-views a,
.btn-tag, .tagcloud > a,
.widget-footer .widget .wg-title,
.widget-footer p.phone-block, .widget-footer p.email-block, .widget-footer p.address-block,
.widget-footer .form-control,
.ls-mental-title,
.ls-mental-bottombar .mb-social span,
.ls-mental-bottombar2 span,
.ls-mental-nav .ls-mn-counter em,
.gallery .gl-item.gl-preview .glp-close,
.gallery .gl-item.gl-preview .glp-zoom i,
.gallery .gl-item-category
{
	color: <?php echo mental_hex_color($color_text_primary); ?>;
}

.chosen-container .chosen-results li.highlighted,
.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content, .woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content,
.price-footer .btn-default:hover
{
	background-color: <?php echo mental_hex_color($color_text_primary); ?>;
}

.footer .btn
{
	border-color: <?php echo mental_hex_color($color_text_primary); ?>;
}

<?php endif ?>

<?php if($color_secondary): // #444649 ?>

/*!========================================================================= *\
	Secondary Color
\* ========================================================================= */

legend,
output,
.form-control,
.btn-primary .badge,
.input-group-addon,
.mtmenu ul.dropdown li a,
.mtmenu > li.showhide,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a,
h1, h2, h3, h4, h5, h6,
#mental_lang_sel > li > a:after,
#mental_lang_sel > li > a:hover,
#mental_lang_sel a,
#calc_shipping_state, #billing_state,
.chosen-container .chosen-single,
.chosen-container-active.chosen-with-drop .chosen-single,
#header.top-menu,
#header.top-menu h1,
.footer .ft-copyright p,
#menu-bar .mb-footer p,
ul#mb-main-menu li a, nav#mb-main-menu > ul li a, nav#mb-main-menu > div > ul li a, .widget ul.menu li a,
.social-block > a:hover,
.testimonial .citation,
.testimonial .citation-big,
.address-block:before, .phone-block:before, .email-block:before,
blockquote p,
.cm-invert .comments p,
.cm-invert .comments .cm-title-line time,
.ft-single-post .ft-back2blog:before,
.ft-single-post .ft-back2gallery:before,
.search-form .glyphicon,
.widget-footer,
.widget-footer .widget .wg-info a,
.widget-footer .widget p,
.ls-mental-nav .ls-mn-counter,
.top-main-menu li > a,
ul.gallery-filters > li > a,
.gallery.gl-pinterest .gl-item-title,
.single-work p
{
	color: <?php echo mental_hex_color($color_secondary); ?>;
}

.btn-primary,
.btn-primary.disabled, .btn-primary.disabled:hover, .btn-primary.disabled:focus, .btn-primary.disabled:active, .btn-primary.disabled.active, .btn-primary[disabled], .btn-primary[disabled]:hover, .btn-primary[disabled]:focus, .btn-primary[disabled]:active, .btn-primary[disabled].active, fieldset[disabled] .btn-primary, fieldset[disabled] .btn-primary:hover, fieldset[disabled] .btn-primary:focus, fieldset[disabled] .btn-primary:active, fieldset[disabled] .btn-primary.active,
.mtmenu > li.showhide .icon em,
.woocommerce #content div.quantity .plus:hover, .woocommerce #content div.quantity .minus:hover, .woocommerce div.quantity .plus:hover, .woocommerce div.quantity .minus:hover, .woocommerce-page #content div.quantity .plus:hover, .woocommerce-page #content div.quantity .minus:hover, .woocommerce-page div.quantity .plus:hover, .woocommerce-page div.quantity .minus:hover, .woocommerce #content div.product form.cart div.quantity .plus:hover, .woocommerce #content div.product form.cart div.quantity .minus:hover, .woocommerce div.product form.cart div.quantity .plus:hover, .woocommerce div.product form.cart div.quantity .minus:hover, .woocommerce-page #content div.product form.cart div.quantity .plus:hover, .woocommerce-page #content div.product form.cart div.quantity .minus:hover, .woocommerce-page div.product form.cart div.quantity .plus:hover, .woocommerce-page div.product form.cart div.quantity .minus:hover,
.woocommerce .widget_layered_nav_filters ul li a, .woocommerce-page .widget_layered_nav_filters ul li a, .woocommerce .widget_layered_nav ul li.chosen a, .woocommerce-page .widget_layered_nav ul li.chosen a,
.st-invert .progress,
.gallery .gl-item.gl-preview .glp-zoom
{
	background-color: <?php echo mental_hex_color($color_secondary); ?>;
}

.btn-primary,
.cm-invert .comments ul > li,
.cm-invert .comments ul ul li:first-child
{
	border-color: <?php echo mental_hex_color($color_secondary); ?>;
}

<?php endif ?>

<?php if($color_tertiary): // #edeef0?>

/*!========================================================================= *\
	Tertiary Color
\* ========================================================================= */

.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control,
.input-group-addon,
.pagination > li > a:hover, .pagination > li > a:focus, .pagination > li > span:hover, .pagination > li > span:focus,
.progress,
.well,
.accordion-group,
ul.nav-tabs li.active a, ul.nav-tabs li:hover a
ul.nav-tabs li.active a:hover, ul.nav-tabs li:hover a:hover,
.tab-content,
.btn-default:hover,
.table > thead > tr > th,
.table > thead > tr > th:last-child,
.table > tbody > tr > td,
.woocommerce #content div.quantity .plus, .woocommerce #content div.quantity .minus, .woocommerce div.quantity .plus, .woocommerce div.quantity .minus, .woocommerce-page #content div.quantity .plus, .woocommerce-page #content div.quantity .minus, .woocommerce-page div.quantity .plus, .woocommerce-page div.quantity .minus, .woocommerce #content div.product form.cart div.quantity .plus, .woocommerce #content div.product form.cart div.quantity .minus, .woocommerce div.product form.cart div.quantity .plus, .woocommerce div.product form.cart div.quantity .minus, .woocommerce-page #content div.product form.cart div.quantity .plus, .woocommerce-page #content div.product form.cart div.quantity .minus, .woocommerce-page div.product form.cart div.quantity .plus, .woocommerce-page div.product form.cart div.quantity .minus,
.button:hover, .button:focus, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce #review_form #respond .form-submit input:focus, .woocommerce-page #review_form #respond .form-submit input:hover, .woocommerce-page #review_form #respond .form-submit input:focus, .woocommerce a.added_to_cart:hover, .woocommerce a.added_to_cart:focus, .woocommerce-page a.added_to_cart:hover, .woocommerce-page a.added_to_cart:focus, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce .widget_price_filter .price_slider_amount .button:focus, .woocommerce-page .widget_price_filter .price_slider_amount .button:hover, .woocommerce-page .widget_price_filter .price_slider_amount .button:focus,
#calc_shipping_state, #billing_state,
.woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message, .woocommerce .woocommerce-error, .woocommerce-page .woocommerce-error, .woocommerce .woocommerce-info, .woocommerce-page .woocommerce-info,
.chosen-container .chosen-single,
.chosen-container .chosen-drop,
.chosen-container-active.chosen-with-drop .chosen-single,
.woocommerce.widget_shopping_cart .total, .woocommerce .widget_shopping_cart .total, .woocommerce-page.widget_shopping_cart .total, .woocommerce-page .widget_shopping_cart .total,
.section.st-bg-grey-lighter,
.price-table,
.price-footer .btn-default,
blockquote,
.comment-form .btn-default,
.search-form .btn,
.blog-list.blog-masonry .blog-sticky .blog-body,
.form-control
{
	background-color: <?php echo mental_hex_color($color_tertiary); ?>;
}

.well,
.btn-default:hover,
.table > tbody > tr > td,
.woocommerce #content div.quantity .input-text.qty.text, .woocommerce div.quantity .input-text.qty.text, .woocommerce-page #content div.quantity .input-text.qty.text, .woocommerce-page div.quantity .input-text.qty.text, .woocommerce #content div.product form.cart div.quantity .input-text.qty.text, .woocommerce div.product form.cart div.quantity .input-text.qty.text, .woocommerce-page #content div.product form.cart div.quantity .input-text.qty.text, .woocommerce-page div.product form.cart div.quantity .input-text.qty.text,
.button:hover, .button:focus, .woocommerce #review_form #respond .form-submit input:hover, .woocommerce #review_form #respond .form-submit input:focus, .woocommerce-page #review_form #respond .form-submit input:hover, .woocommerce-page #review_form #respond .form-submit input:focus, .woocommerce a.added_to_cart:hover, .woocommerce a.added_to_cart:focus, .woocommerce-page a.added_to_cart:hover, .woocommerce-page a.added_to_cart:focus, .woocommerce .widget_price_filter .price_slider_amount .button:hover, .woocommerce .widget_price_filter .price_slider_amount .button:focus, .woocommerce-page .widget_price_filter .price_slider_amount .button:hover, .woocommerce-page .widget_price_filter .price_slider_amount .button:focus,
#calc_shipping_state, #billing_state,
.chosen-container .chosen-single,
.chosen-container-active.chosen-with-drop .chosen-single,
.search-form .btn,
blockquote,
.form-control,
.input-group-addon
{
	border-color: <?php echo mental_hex_color($color_tertiary); ?>;
}

<?php endif ?>

<?php if($color_quaternary): // #d5d8dd ?>

/*!========================================================================= *\
	Quaternary Color
\* ========================================================================= */

.form-control:focus,
.comment-form .form-control,
.comment-form .btn-default:hover,
.form-control:focus
{
	background-color: <?php echo mental_hex_color($color_quaternary); ?>;
}

.btn-default,
.btn-default.disabled, .btn-default.disabled:hover, .btn-default.disabled:focus, .btn-default.disabled:active, .btn-default.disabled.active, .btn-default[disabled], .btn-default[disabled]:hover, .btn-default[disabled]:focus, .btn-default[disabled]:active, .btn-default[disabled].active, fieldset[disabled] .btn-default, fieldset[disabled] .btn-default:hover, fieldset[disabled] .btn-default:focus, fieldset[disabled] .btn-default:active, fieldset[disabled] .btn-default.active,
.form-control:focus,
.button, .woocommerce #review_form #respond .form-submit input, .woocommerce-page #review_form #respond .form-submit input, .woocommerce a.added_to_cart, .woocommerce-page a.added_to_cart, .woocommerce .widget_price_filter .price_slider_amount .button, .woocommerce-page .widget_price_filter .price_slider_amount .button,
.button.disabled, .button.disabled:hover, .button.disabled:focus, .button.disabled:active, .button.disabled.active, .button[disabled], .button[disabled]:hover, .button[disabled]:focus, .button[disabled]:active, .button[disabled].active, fieldset[disabled] .button, fieldset[disabled] .button:hover, fieldset[disabled] .button:focus, fieldset[disabled] .button:active, fieldset[disabled] .button.active, .woocommerce #review_form #respond .form-submit input.disabled, .woocommerce #review_form #respond .form-submit input.disabled:hover, .woocommerce #review_form #respond .form-submit input.disabled:focus, .woocommerce #review_form #respond .form-submit input.disabled:active, .woocommerce #review_form #respond .form-submit input.disabled.active, .woocommerce #review_form #respond .form-submit input[disabled], .woocommerce #review_form #respond .form-submit input[disabled]:hover, .woocommerce #review_form #respond .form-submit input[disabled]:focus, .woocommerce #review_form #respond .form-submit input[disabled]:active, .woocommerce #review_form #respond .form-submit input[disabled].active, fieldset[disabled] .woocommerce #review_form #respond .form-submit input, fieldset[disabled] .woocommerce #review_form #respond .form-submit input:hover, fieldset[disabled] .woocommerce #review_form #respond .form-submit input:focus, fieldset[disabled] .woocommerce #review_form #respond .form-submit input:active, fieldset[disabled] .woocommerce #review_form #respond .form-submit input.active, .woocommerce-page #review_form #respond .form-submit input.disabled, .woocommerce-page #review_form #respond .form-submit input.disabled:hover, .woocommerce-page #review_form #respond .form-submit input.disabled:focus, .woocommerce-page #review_form #respond .form-submit input.disabled:active, .woocommerce-page #review_form #respond .form-submit input.disabled.active, .woocommerce-page #review_form #respond .form-submit input[disabled], .woocommerce-page #review_form #respond .form-submit input[disabled]:hover, .woocommerce-page #review_form #respond .form-submit input[disabled]:focus, .woocommerce-page #review_form #respond .form-submit input[disabled]:active, .woocommerce-page #review_form #respond .form-submit input[disabled].active, fieldset[disabled] .woocommerce-page #review_form #respond .form-submit input, fieldset[disabled] .woocommerce-page #review_form #respond .form-submit input:hover, fieldset[disabled] .woocommerce-page #review_form #respond .form-submit input:focus, fieldset[disabled] .woocommerce-page #review_form #respond .form-submit input:active, fieldset[disabled] .woocommerce-page #review_form #respond .form-submit input.active, .woocommerce a.added_to_cart.disabled, .woocommerce a.added_to_cart.disabled:hover, .woocommerce a.added_to_cart.disabled:focus, .woocommerce a.added_to_cart.disabled:active, .woocommerce a.added_to_cart.disabled.active, .woocommerce a.added_to_cart[disabled], .woocommerce a.added_to_cart[disabled]:hover, .woocommerce a.added_to_cart[disabled]:focus, .woocommerce a.added_to_cart[disabled]:active, .woocommerce a.added_to_cart[disabled].active, fieldset[disabled] .woocommerce a.added_to_cart, fieldset[disabled] .woocommerce a.added_to_cart:hover, fieldset[disabled] .woocommerce a.added_to_cart:focus, fieldset[disabled] .woocommerce a.added_to_cart:active, fieldset[disabled] .woocommerce a.added_to_cart.active, .woocommerce-page a.added_to_cart.disabled, .woocommerce-page a.added_to_cart.disabled:hover, .woocommerce-page a.added_to_cart.disabled:focus, .woocommerce-page a.added_to_cart.disabled:active, .woocommerce-page a.added_to_cart.disabled.active, .woocommerce-page a.added_to_cart[disabled], .woocommerce-page a.added_to_cart[disabled]:hover, .woocommerce-page a.added_to_cart[disabled]:focus, .woocommerce-page a.added_to_cart[disabled]:active, .woocommerce-page a.added_to_cart[disabled].active, fieldset[disabled] .woocommerce-page a.added_to_cart, fieldset[disabled] .woocommerce-page a.added_to_cart:hover, fieldset[disabled] .woocommerce-page a.added_to_cart:focus, fieldset[disabled] .woocommerce-page a.added_to_cart:active, fieldset[disabled] .woocommerce-page a.added_to_cart.active, .woocommerce .widget_price_filter .price_slider_amount .button.disabled, .woocommerce .widget_price_filter .price_slider_amount .button.disabled:hover, .woocommerce .widget_price_filter .price_slider_amount .button.disabled:focus, .woocommerce .widget_price_filter .price_slider_amount .button.disabled:active, .woocommerce .widget_price_filter .price_slider_amount .button.disabled.active, .woocommerce .widget_price_filter .price_slider_amount .button[disabled], .woocommerce .widget_price_filter .price_slider_amount .button[disabled]:hover, .woocommerce .widget_price_filter .price_slider_amount .button[disabled]:focus, .woocommerce .widget_price_filter .price_slider_amount .button[disabled]:active, .woocommerce .widget_price_filter .price_slider_amount .button[disabled].active, fieldset[disabled] .woocommerce .widget_price_filter .price_slider_amount .button, fieldset[disabled] .woocommerce .widget_price_filter .price_slider_amount .button:hover, fieldset[disabled] .woocommerce .widget_price_filter .price_slider_amount .button:focus, fieldset[disabled] .woocommerce .widget_price_filter .price_slider_amount .button:active, fieldset[disabled] .woocommerce .widget_price_filter .price_slider_amount .button.active, .woocommerce-page .widget_price_filter .price_slider_amount .button.disabled, .woocommerce-page .widget_price_filter .price_slider_amount .button.disabled:hover, .woocommerce-page .widget_price_filter .price_slider_amount .button.disabled:focus, .woocommerce-page .widget_price_filter .price_slider_amount .button.disabled:active, .woocommerce-page .widget_price_filter .price_slider_amount .button.disabled.active, .woocommerce-page .widget_price_filter .price_slider_amount .button[disabled], .woocommerce-page .widget_price_filter .price_slider_amount .button[disabled]:hover, .woocommerce-page .widget_price_filter .price_slider_amount .button[disabled]:focus, .woocommerce-page .widget_price_filter .price_slider_amount .button[disabled]:active, .woocommerce-page .widget_price_filter .price_slider_amount .button[disabled].active, fieldset[disabled] .woocommerce-page .widget_price_filter .price_slider_amount .button, fieldset[disabled] .woocommerce-page .widget_price_filter .price_slider_amount .button:hover, fieldset[disabled] .woocommerce-page .widget_price_filter .price_slider_amount .button:focus, fieldset[disabled] .woocommerce-page .widget_price_filter .price_slider_amount .button:active, fieldset[disabled] .woocommerce-page .widget_price_filter .price_slider_amount .button.active,
.services-item,
.comment-form .form-control,
.btn-tag, .tagcloud > a,
.blog-list .blog-item-quotation .blog-info,
.blog-masonry .blog-body
{
	border-color: <?php echo mental_hex_color($color_quaternary); ?>;
}

<?php endif ?>

/*!========================================================================= *\
	Blocks colors
\* ========================================================================= */

<?php if($color_topmenu): ?>
/* Top menu Color */
.top-menu > header{ background-color: <?php echo esc_attr( $color_topmenu ); ?>; }
<?php endif ?>

<?php if($color_topmenu_transparent): ?>
/* Top menu Color */
#header.top-menu{ background-color: transparent; }
<?php endif ?>

<?php if($color_topmenu_sticky): ?>
/* Top menu cticky Color */
.top-menu.tm-fixed > header{ background-color: <?php echo esc_attr( $color_topmenu_sticky ); ?>; }
<?php endif ?>

<?php if($color_menubar_background): // #76d898 ?>
/* Menubar Background Color */
#menu-bar { background-color: <?php echo mental_hex_color( $color_menubar_background ); ?>; }
<?php endif ?>

<?php if($color_menubar_handle): // #76d898 ?>
/* Menubar Handle Color */
#menu-bar a.mb-toggler{ background-color: <?php echo mental_hex_color( $color_menubar_handle ); ?>; }
<?php endif ?>

<?php if($color_footer): // #161616 ?>
/* Footer background Color */
.footer.widget-footer{ background-color: <?php echo mental_hex_color( $color_footer ); ?>; }
<?php endif ?>

<?php if($color_footer_copyright): // #161616 ?>
/* Footer copyright background Color */
.footer .ft-copyright{ background-color: <?php echo mental_hex_color( $color_footer_copyright ); ?>; }
<?php endif ?>

<?php if( $preloader_background_color = get_mental_option( 'preloader_background_color' ) ): ?>
/* Preloader background color */
#preloader{ background-color: <?php echo mental_hex_color( $preloader_background_color ); ?>; }
<?php endif; ?>

/*!========================================================================= *\
	Typography Settings Styles
\* ========================================================================= */

<?php
$font_primary = get_mental_option('font_primary');
if(strtolower($font_primary['font']) != 'default'):
?>
body {
	font-family: '<?php echo sanitize_text_field($font_primary['font']) ?>', sans-serif;
	font-size: <?php echo sanitize_text_field($font_primary['size']) ?>;
	font-style: <?php echo sanitize_text_field($font_primary['style']) ?>;
	font-weight: <?php echo sanitize_text_field($font_primary['weight']) ?>;
}
<?php endif ?>

<?php
$font_h1 = get_mental_option('font_h1');
if(strtolower($font_h1['font']) != 'default'):
?>
h1 {
	font-family: '<?php echo sanitize_text_field($font_h1['font']) ?>', sans-serif;
	font-size: <?php echo sanitize_text_field($font_h1['size']) ?>;
	font-style: <?php echo sanitize_text_field($font_h1['style']) ?>;
	font-weight: <?php echo sanitize_text_field($font_h1['weight']) ?>;
}
<?php endif ?>

<?php
$font_h2 = get_mental_option('font_h2');
if(strtolower($font_h2['font']) != 'default'):
?>
h2 {
	font-family: '<?php echo sanitize_text_field($font_h2['font']) ?>', sans-serif;
	font-size: <?php echo sanitize_text_field($font_h2['size']) ?>;
	font-style: <?php echo sanitize_text_field($font_h2['style']) ?>;
	font-weight: <?php echo sanitize_text_field($font_h2['weight']) ?>;
}
<?php endif ?>

<?php
$font_h3 = get_mental_option('font_h3');
if(strtolower($font_h3['font']) != 'default'):
?>
h3 {
	font-family: '<?php echo sanitize_text_field($font_h3['font']) ?>', sans-serif;
	font-size: <?php echo sanitize_text_field($font_h3['size']) ?>;
	font-style: <?php echo sanitize_text_field($font_h3['style']) ?>;
	font-weight: <?php echo sanitize_text_field($font_h3['weight']) ?>;
}
<?php endif ?>

<?php
$font_h4 = get_mental_option('font_h4');
if(strtolower($font_h4['font']) != 'default'):
?>
h4 {
	font-family: '<?php echo sanitize_text_field($font_h4['font']) ?>', sans-serif;
	font-size: <?php echo sanitize_text_field($font_h4['size']) ?>;
	font-style: <?php echo sanitize_text_field($font_h4['style']) ?>;
	font-weight: <?php echo sanitize_text_field($font_h4['weight']) ?>;
}
<?php endif ?>

<?php
$font_h5 = get_mental_option('font_h5');
if(strtolower($font_h5['font']) != 'default'):
?>
h5 {
	font-family: '<?php echo sanitize_text_field($font_h5['font']) ?>', sans-serif;
	font-size: <?php echo sanitize_text_field($font_h5['size']) ?>;
	font-style: <?php echo sanitize_text_field($font_h5['style']) ?>;
	font-weight: <?php echo sanitize_text_field($font_h5['weight']) ?>;
}
<?php endif ?>

<?php
$font_h6 = get_mental_option('font_h6');
if(strtolower($font_h6['font']) != 'default'):
?>
h6 {
	font-family: '<?php echo sanitize_text_field($font_h6['font']) ?>', sans-serif;
	font-size: <?php echo sanitize_text_field($font_h6['size']) ?>;
	font-style: <?php echo sanitize_text_field($font_h6['style']) ?>;
	font-weight: <?php echo sanitize_text_field($font_h6['weight']) ?>;
}
<?php endif ?>

<?php
$font_topmenu = get_mental_option('font_topmenu');
if(strtolower($font_topmenu['font']) != 'default'):
?>
.top-main-menu {
	font-family: '<?php echo sanitize_text_field($font_topmenu['font']) ?>', sans-serif;
	font-size: <?php echo sanitize_text_field($font_topmenu['size']) ?>;
	font-style: <?php echo sanitize_text_field($font_topmenu['style']) ?>;
	font-weight: <?php echo sanitize_text_field($font_topmenu['weight']) ?>;
}
<?php endif ?>

<?php
$font_menubar_menu = get_mental_option('font_menubar_menu');
if(strtolower($font_menubar_menu['font']) != 'default'):
?>
ul#mb-main-menu {
	font-family: '<?php echo sanitize_text_field($font_menubar_menu['font']) ?>', sans-serif;
	font-size: <?php echo sanitize_text_field($font_menubar_menu['size']) ?>;
	font-style: <?php echo sanitize_text_field($font_menubar_menu['style']) ?>;
	font-weight: <?php echo sanitize_text_field($font_menubar_menu['weight']) ?>;
}
<?php endif ?>

/*!========================================================================= *\
	Custom Fonts
\* ========================================================================= */

<?php
	$font_loader_data = get_mental_option('font_loader');
	$custom_fonts = array();
	foreach($font_loader_data as $font)
	{
		if($font['type'] == 'custom') $custom_fonts[] = $font;
	}
?>

<?php foreach($custom_fonts as $font): ?>

	<?php
		$srcs = array();
		if(!empty($font['upload_eot'])) {$srcs[] = "url('" . esc_url($font['upload_eot']) . "?#iefix') format('embedded-opentype')";}
		if(!empty($font['upload_woff'])) {$srcs[] = "url('" . esc_url($font['upload_woff']) . "') format('woff')";}
		if(!empty($font['upload_ttf'])) {$srcs[] = "url('" . esc_url($font['upload_ttf']) . "') format('truetype')";}
		if(!empty($font['upload_svg'])) {$srcs[] = "url('" . esc_url($font['upload_svg']) . "#" . esc_attr($font['name'])."') format('svg')";}
	?>

	@font-face {
		font-family: '<?php echo esc_attr($font['name']) ?>';
		font-style: '<?php echo esc_attr($font['style']) ?>';
		font-weight: '<?php echo esc_attr($font['weight']) ?>';
		<?php if(!empty($font['upload_eot'])) echo "src: url('" . esc_url($font['upload_eot']) . "');" ?>

		src: <?php echo implode(",\n", $srcs); ?>;
	}

<?php endforeach ?>

<?php if(($gallery_fixed_items_ratio = get_mental_option('gallery_fixed_items_ratio')) != '67' && (int) $gallery_fixed_items_ratio): ?>
/* Gallery items ratio */
.gallery .gl-item.gl-fixed-ratio-item > a{padding-top: <?php echo (int) $gallery_fixed_items_ratio; ?>%;}
<?php endif; ?>

/*!========================================================================= *\
	Custom Effects
\* ========================================================================= */
<?php if ( get_mental_option( 'footer_parallax' ) && get_mental_option( 'footer_show' ) ): ?>
@media (min-width: 1200px) { .footer.widget-footer {position: fixed;width: 100%;bottom: 0;left: 0;z-index: 0;}}
<?php endif; ?>

/*!========================================================================= *\
	Custom CSS
\* ========================================================================= */

<?php echo get_mental_option('css_custom') ?>

</style>