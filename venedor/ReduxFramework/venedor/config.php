/* Venedor Config Styles */
/* Created at <?php echo date("Y-m-d H:i:s") ?> */
<?php 
global $venedor_design, $venedor_settings;
$c = $venedor_design; $b = $venedor_settings;
?>

/*========== Common Styles ==========*/

body {
    <?php venedor_print_typo('body') ?>
    <?php venedor_print_bg('body') ?>
<?php if (isset($c['body-bg-mode']) && $c['body-bg-mode'] == 'texture' && $c['body-bg-texture']) : ?>
    background-attachment: fixed;
<?php endif; ?>
}

#main {
    <?php venedor_print_bg('wrapper') ?>
}

h1, h2, h3, h4, h5 {
    <?php venedor_print_typo('heading') ?>
}

h1 .line,
h2 .line { 
    background-color: <?php echo $c['arrow-border']['border-color'] ?>;
}

h1.page-title:before, h1.entry-title:before,
h2.page-title:before, h2.entry-title:before,
h1.content-title:before, h2.content-title:before,
h1.wpb_heading:before, h2.wpb_heading:before {
    background: <?php echo $c['link-color']['regular'] ?>;
}

#main .title-desc,
#main .slider-desc {
    <?php venedor_print_typo('heading-desc') ?>
}

h1 a, h2 a, h3 a, h4 a, h5 a {
    color: <?php echo $c['heading-font']['color'] ?>;
}

.testimonials-line {
    background-color: <?php echo $c['btn-sbg-color'] ?>;
}

a,
h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover,
h1 a:focus, h2 a:focus, h3 a:focus, h4 a:focus, h5 a:focus,
.yith-woocompare-widget ul.products-list a.remove:hover,
.yith-woocompare-widget ul.products-list a.remove:focus,
.product-topslider a:hover .product-name,
.product-featured-slider a:hover .product-name,
.content-box-percentage,
.header-block .fa {
    color: <?php echo $c['link-color']['regular'] ?>;
}
a:hover, a:focus,
.yith-woocompare-widget ul.products-list a.remove {
    color: <?php echo $c['link-color']['hover'] ?>;
}
.woocommerce-MyAccount-navigation li a {
    color: <?php echo $c['link-color']['hover'] ?>;
}
.woocommerce-MyAccount-navigation li:hover a,
.woocommerce-MyAccount-navigation li.is-active a {
    color: <?php echo $c['link-color']['regular'] ?>;
}
<?php if (!$c['btn-shadow']) : ?>
button,
.btn,
.button,
.btn-arrow,
.yith-wcwl-add-to-wishlist > div > a,
.added_to_cart,
a.compare.button,
.elastislide-wrapper nav span,
.dropdown-toggle,
#submit,
.owl-theme .owl-controls .owl-buttons div,
.single-nav a span,
.arrow,
.navigation a,
.person .person-social a,
.contact-item .contact-icon,
input[type="submit"],
input[type="submit"],
.wpcf7-submit,
.widget-title .toggle,
.social-links .social-link,
.yith-wcwl-share li a,
body .flex-direction-nav a,
.widget_layered_nav_filters li a,
.tagcloud a,
.yith-wcan-label li a,
.yith-wcan-label li span,
.pagination > a,
.pagination > span,
.page-numbers {
    -webkit-box-shadow: none !important;
            box-shadow: none !important;
}
<?php endif; ?>

button, .btn, .btn-inverse, .button, input[type="submit"][name="subscribe"], input[type="submit"][name="unsubscribe"], 
.footer button, .footer .btn, .footer .btn-inverse, .footer .button,
.minicart-actions .buttons .checkout-link,
.yith-wcwl-add-to-wishlist > div > a,
a.compare.button,
.added_to_cart,
#submit,
.person .person-social a,
.yith-wcwl-share li a,
.btn.dropdown-toggle,
.contact-icon, .faq-icon,
.icon-box,
.wpcf7-submit,
.wpb_toggle:before,
.yith-woo-ajax-navigation .yith-wcan .yith-wcan-reset-navigation {
    <?php venedor_print_typo('btn') ?>
    <?php venedor_print_border('btn') ?>
    <?php venedor_print_bg('btn') ?>
    <?php venedor_print_border_radius('btn') ?>
    color: <?php echo $c['btn-text-color'] ?>;
}
<?php if ($c['btn-border']['border-top'] != '1px') : ?>
.contact-icon,
.icon-box,
.cart-links {
    <?php venedor_print_line_height(36, 'btn') ?>
}
<?php endif; ?>
.woocommerce-pagination li > .page-numbers.current,
.pagination > span.current,
.ui-slider {
    background-color: <?php echo $c['arrow-border']['border-color'] ?>;
}
.btn-arrow,
.footer .btn-arrow, 
.view-mode a,
.woocommerce-pagination li > .page-numbers,
.pagination > a, 
.elastislide-wrapper nav span,
.quantity .minus,
.quantity .plus,
.navigation a,
.single-nav a span, 
.accordion-menu .arrow,
.widget .arrow,
.widget_layered_nav .widget-title .toggle, .widget_layered_nav_filters .widget-title .toggle, .widget_price_filter .widget-title .toggle, .widget_product_categories .widget-title .toggle,
.owl-theme .owl-controls .owl-buttons div,
.tagcloud a,
body .flex-direction-nav a,
.woocommerce .widget_layered_nav ul.yith-wcan-label li a,
.woocommerce-page .widget_layered_nav ul.yith-wcan-label li a,
.woocommerce .widget_layered_nav ul.yith-wcan-label li span,
.woocommerce-page .widget_layered_nav ul.yith-wcan-label li span,
.woocommerce #content table.wishlist_table.cart a.remove {
    <?php venedor_print_typo('arrow') ?>
    <?php venedor_print_border('arrow') ?>
    <?php venedor_print_bg('arrow') ?>
    <?php venedor_print_border_radius('arrow') ?>
    color: <?php echo $c['arrow-text-color'] ?>;
}
<?php if ($c['arrow-border']['border-top'] != '1px') : ?>
.owl-theme .owl-controls .owl-buttons div,
.toolbar .view-mode a,
.toolbar .btn-arrow,
.pagination > a,
.pagination > span,
.woocommerce-pagination li > .page-numbers {
    <?php venedor_print_line_height(30, 'arrow') ?>
}
.single-portfolio .portfolio-slideshow.owl-theme .owl-controls .owl-buttons div,
.post-slideshow-wrap.large-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div,
.post-slideshow-wrap.medium-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div,
.sw-slider.owl-theme .owl-controls .owl-buttons div,
body .flex-direction-nav a,
.product-slider .owl-theme .owl-controls .owl-buttons div,
.related-slider .owl-theme .owl-controls .owl-buttons div,
.content-slider.owl-theme .owl-controls .owl-buttons div,
.single-nav a span {
    <?php venedor_print_line_height(40, 'arrow') ?>
}
.sidebar .single-portfolio .portfolio-slideshow.owl-theme .owl-controls .owl-buttons div,
.sidebar .post-slideshow-wrap.large-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div,
.sidebar .post-slideshow-wrap.medium-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div,
.sidebar .sw-slider.owl-theme .owl-controls .owl-buttons div,
.sidebar body .flex-direction-nav a {
    <?php venedor_print_line_height(40, 'arrow') ?>
}
.sidebar .content-slider.owl-theme .owl-controls .owl-buttons div {
    <?php venedor_print_line_height(25, 'arrow') ?>
}
.product-topslider.owl-theme .owl-controls .owl-buttons div,
.product-featured-slider .product-image .btn-arrow {
    <?php venedor_print_line_height(45, 'arrow') ?>
}
.widget_layered_nav .widget-title .toggle,
.widget_layered_nav_filters .widget-title .toggle,
.widget_price_filter .widget-title .toggle,
.widget_product_categories .widget-title .toggle {
    <?php venedor_print_line_height(26, 'arrow') ?>
}
.accordion-menu .arrow,
.widget .arrow {
    <?php venedor_print_line_height(19, 'arrow') ?>
}
.shop_table.cart tbody .product-remove .remove {
    <?php venedor_print_line_height(23, 'arrow') ?>
}
@media (max-width: 991px) {
    .single-portfolio .portfolio-slideshow.owl-theme .owl-controls .owl-buttons div,
    .post-slideshow-wrap.large-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div,
    .post-slideshow-wrap.medium-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div,
    .sw-slider.owl-theme .owl-controls .owl-buttons div,
    body .flex-direction-nav a,
    .product-slider .owl-theme .owl-controls .owl-buttons div,
    .related-slider .owl-theme .owl-controls .owl-buttons div,
    .content-slider.owl-theme .owl-controls .owl-buttons div,
    .single-nav a span {
        <?php venedor_print_line_height(35, 'arrow') ?>
    }
}
@media (max-width: 767px) {
    .single-portfolio .portfolio-slideshow.owl-theme .owl-controls .owl-buttons div,
    .post-slideshow-wrap.large-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div,
    .post-slideshow-wrap.medium-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div,
    .sw-slider.owl-theme .owl-controls .owl-buttons div,
    body .flex-direction-nav a,
    .product-slider .owl-theme .owl-controls .owl-buttons div,
    .related-slider .owl-theme .owl-controls .owl-buttons div,
    .content-slider.owl-theme .owl-controls .owl-buttons div,
    .single-nav a span {
        <?php venedor_print_line_height(30, 'arrow') ?>
    }
    .product-topslider.owl-theme .owl-controls .owl-buttons div {
        <?php venedor_print_line_height(28, 'arrow') ?>
    }
    .product-featured-slider .product-image .btn-arrow {
        <?php venedor_print_line_height(35, 'arrow') ?>
    }
}
<?php endif; ?>
.woocommerce-pagination li > .page-numbers,
.pagination > a,
.navigation a,
.single-nav a span {
    color: <?php venedor_print_rgb($c['arrow-text-color'], -40) ?>;
}
button:hover, button:focus, 
.btn:hover, .btn:focus,
.btn-special.btn-inverse:hover, .btn-special.btn-inverse:focus,
.button:hover, .button:focus, 
#submit:hover, #submit:focus, 
input[type="submit"][name="subscribe"],
.footer button:hover, .footer button:focus, 
.footer .btn:hover, .footer .btn:focus,
.footer .button:hover, .footer .button:focus, 
.btn-inverse, .btn-special,
.footer .btn-inverse, .footer .btn-special, 
.yith-wcwl-add-to-wishlist > div > a,
a.compare.button,
.added_to_cart,
#mini-cart .dropdown-toggle,
.minicart-actions .buttons .cart-link,
.minicart-actions .buttons .checkout-link:hover, .minicart-actions .buttons .checkout-link:focus
.person .person-social a:hover, .person .person-social a:focus,
.btn.dropdown-toggle:hover, .btn.dropdown-toggle:focus,
.btn-group.open .dropdown-toggle,
.faq-icon,
.wpcf7-submit:hover, .wpcf7-submit:focus,
.wpb_toggle:before,
.yith-woo-ajax-navigation .yith-wcan .yith-wcan-reset-navigation:hover,
.yith-woo-ajax-navigation .yith-wcan .yith-wcan-reset-navigation:focus {
    <?php venedor_print_hborder('btn') ?>
    <?php venedor_print_hbg('btn') ?>
    color: <?php echo $c['btn-hcolor'] ?>;
}
<?php if ($c['btn-hborder']['border-top'] != '1px') : ?>
.cart-links:hover, .cart-links:focus,
.yith-wcwl-add-to-wishlist > div > a,
a.compare.button,
.added_to_cart {
    <?php venedor_print_hline_height(36, 'btn') ?>
}
#mini-cart .dropdown-toggle {
    <?php venedor_print_hline_height(22, 'btn') ?>
    padding-left: <?php echo 11 - (int)($c['btn-hborder']['border-top']) ?>px;
    padding-right: <?php echo 11 - (int)($c['btn-hborder']['border-top']) ?>px;
}
<?php endif; ?>
.yith-wcwl-add-to-wishlist span.ajax-loading {
    <?php venedor_print_hborder('btn') ?>
    <?php venedor_print_border_radius('btn') ?>
}
.btn-arrow:hover, .btn-arrow:focus,
.footer .btn-arrow:hover, .footer .btn-arrow:focus {
    <?php venedor_print_border_radius('arrow') ?>
}
.btn-arrow:hover, .btn-arrow:focus,
.footer .btn-arrow:hover, .footer .btn-arrow:focus,
.view-mode a:hover, .view-mode a:focus, .view-mode a.active,
.toolbar .btn-arrow:hover, .toolbar .btn-arrow:focus,
.woocommerce-pagination li > a.page-numbers:hover, .woocommerce-pagination li > a.page-numbers:focus,
.pagination > a:hover, .pagination > a:focus,
.dropdown.open .dropdown-toggle .arrow,
.elastislide-wrapper nav span:hover, .elastislide-wrapper nav span:focus,
.quantity .minus:hover, .quantity .minus:focus,
.quantity .plus:hover, .quantity .plus:focus,
.navigation a:hover, .navigation a:focus,
.single-nav a:hover span, .single-nav a:focus span,
.accordion-menu .arrow:hover, .accordion-menu .arrow:focus,
.widget .arrow:hover, .widget.arrow:focus,
.widget_layered_nav .widget-title .toggle:hover, .widget_layered_nav_filters .widget-title .toggle:hover, .widget_price_filter .widget-title .toggle:hover, .widget_product_categories .widget-title .toggle:hover,
.accordion-menu .active > .arrow,
.widget [class*="current-"] > .arrow,
.owl-theme .owl-controls .owl-buttons div:hover,
.tagcloud a:hover, .tagcloud a:focus,
body .flex-direction-nav a:hover, body .flex-direction-nav a:focus,
.woocommerce .widget_layered_nav ul.yith-wcan-label li a:hover, .woocommerce .widget_layered_nav ul.yith-wcan-label li a:focus,
.woocommerce-page .widget_layered_nav ul.yith-wcan-label li a:hover, .woocommerce-page .widget_layered_nav ul.yith-wcan-label li a:focus,
.woocommerce .widget_layered_nav ul.yith-wcan-label li.chosen a,
.woocommerce-page .widget_layered_nav ul.yith-wcan-label li.chosen a,
.woocommerce #content table.wishlist_table.cart a.remove:hover, .woocommerce #content table.wishlist_table.cart a.remove:focus {
    <?php venedor_print_hborder('arrow') ?>
    <?php venedor_print_hbg('arrow') ?>
    <?php venedor_print_border_radius('arrow') ?>
    color: <?php echo $c['arrow-hcolor'] ?>;
}
<?php if ($c['arrow-hborder']['border-top'] != '1px') : ?>
.owl-theme .owl-controls .owl-buttons div:hover,
.toolbar .view-mode a:hover, .toolbar .view-mode a:focus,
.toolbar .btn-arrow:hover, .toolbar .btn-arrow:focus,
.pagination > a:hover, .pagination > a:focus,
.woocommerce-pagination li > a.page-numbers:hover, .woocommerce-pagination li > a.page-numbers:focus {
    <?php venedor_print_hline_height(30, 'arrow') ?>
}
.single-portfolio .portfolio-slideshow.owl-theme .owl-controls .owl-buttons div:hover,
.post-slideshow-wrap.large-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div:hover,
.post-slideshow-wrap.medium-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div:hover,
.sw-slider.owl-theme .owl-controls .owl-buttons div:hover,
body .flex-direction-nav a:hover,
body .flex-direction-nav a:focus,
.product-slider .owl-theme .owl-controls .owl-buttons div:hover,
.related-slider .owl-theme .owl-controls .owl-buttons div:hover,
.content-slider.owl-theme .owl-controls .owl-buttons div:hover,
.single-nav a:hover span, .single-nav a:focus span {
    <?php venedor_print_hline_height(40, 'arrow') ?>
}
.sidebar .single-portfolio .portfolio-slideshow.owl-theme .owl-controls .owl-buttons div:hover,
.sidebar .post-slideshow-wrap.large-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div:hover,
.sidebar .post-slideshow-wrap.medium-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div:hover,
.sidebar .sw-slider.owl-theme .owl-controls .owl-buttons div:hover,
.sidebar body .flex-direction-nav a:hover,
.sidebar body .flex-direction-nav a:focus {
    <?php venedor_print_hline_height(25, 'arrow') ?>
}
.sidebar .content-slider.owl-theme .owl-controls .owl-buttons div:hover {
    <?php venedor_print_hline_height(25, 'arrow') ?>
}
.product-topslider.owl-theme .owl-controls .owl-buttons div:hover,
.product-featured-slider .product-image .btn-arrow:hover, .product-featured-slider .product-image .btn-arrow:focus {
    <?php venedor_print_hline_height(45, 'arrow') ?>
}
.accordion-menu .arrow:hover, .accordion-menu .arrow:focus,
.widget .arrow:hover, .widget.arrow:focus {
    <?php venedor_print_hline_height(19, 'arrow') ?>
}
.widget_layered_nav .widget-title .toggle:hover, .widget_layered_nav_filters .widget-title .toggle:hover, .widget_price_filter .widget-title .toggle:hover, .widget_product_categories .widget-title .toggle:hover {
    <?php venedor_print_hline_height(26, 'arrow') ?>
}
.shop_table.cart tbody .product-remove .remove:hover, .shop_table.cart tbody .product-remove .remove:focus {
    <?php venedor_print_hline_height(23, 'arrow') ?>
}
@media (max-width: 991px) {
    .single-portfolio .portfolio-slideshow.owl-theme .owl-controls .owl-buttons div:hover,
    .post-slideshow-wrap.large-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div:hover,
    .post-slideshow-wrap.medium-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div:hover,
    .sw-slider.owl-theme .owl-controls .owl-buttons div:hover,
    body .flex-direction-nav a:hover,
    body .flex-direction-nav a:focus,
    .product-slider .owl-theme .owl-controls .owl-buttons div:hover,
    .related-slider .owl-theme .owl-controls .owl-buttons div:hover,
    .content-slider.owl-theme .owl-controls .owl-buttons div:hover,
    .single-nav a:hover span, .single-nav a:focus span {
        <?php venedor_print_hline_height(35, 'arrow') ?>
    }
}
@media (max-width: 767px) {
    .single-portfolio .portfolio-slideshow.owl-theme .owl-controls .owl-buttons div:hover,
    .post-slideshow-wrap.large-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div:hover,
    .post-slideshow-wrap.medium-alt .post-slideshow.owl-theme .owl-controls .owl-buttons div:hover,
    .sw-slider.owl-theme .owl-controls .owl-buttons div:hover,
    body .flex-direction-nav a:hover,
    body .flex-direction-nav a:focus,
    .product-slider .owl-theme .owl-controls .owl-buttons div:hover,
    .related-slider .owl-theme .owl-controls .owl-buttons div:hover,
    .content-slider.owl-theme .owl-controls .owl-buttons div:hover,
    .single-nav a:hover span, .single-nav a:focus span {
        <?php venedor_print_hline_height(30, 'arrow') ?>
    }
    .product-topslider.owl-theme .owl-controls .owl-buttons div:hover {
        <?php venedor_print_hline_height(28, 'arrow') ?>
    }
    .product-featured-slider .product-image .btn-arrow:hover, .product-featured-slider .product-image .btn-arrow:focus {
        <?php venedor_print_hline_height(35, 'arrow') ?>
    }
}
<?php endif; ?>
.btn-inverse:hover, .btn-inverse:focus, 
input[type="submit"][name="subscribe"]:hover, input[type="submit"][name="subscribe"]:focus,
.footer .btn-inverse:hover, .footer .btn-inverse:focus, 
#main-mobile-toggle:hover .btn, #main-mobile-toggle:focus .btn {
    <?php venedor_print_border('btn') ?>
    <?php venedor_print_bg('btn') ?>
    color: <?php echo $c['btn-text-color'] ?>;
}
.btn-special.btn-inverse,
.btn-special:hover, .btn-special:focus, 
input[type="submit"][name="unsubscribe"]:hover, input[type="submit"][name="unsubscribe"]:focus,
.footer .btn-special:hover, .footer .btn-special:focus,
.yith-wcwl-add-to-wishlist > div > a:hover, .yith-wcwl-add-to-wishlist > div > a:focus,
a.compare.button:hover, a.compare.button:focus,
.added_to_cart:hover, .added_to_cart:focus,
#mini-cart.open .dropdown-toggle, #mini-cart .dropdown-toggle:hover, #mini-cart .dropdown-toggle:focus,
.contact-icon, a:hover .faq-icon, a:focus .faq-icon,
.icon-box:hover, .icon-box:focus,
.wpb_toggle_title_active:before,
.minicart-actions .buttons .cart-link:hover, .minicart-actions .buttons .cart-link:focus {
    <?php venedor_print_shborder('btn') ?>
    <?php venedor_print_shbg('btn') ?>
    color: <?php echo $c['btn-shcolor'] ?>;
}
<?php if ($c['btn-hborder']['border-top'] != '1px') : ?>
#topcontrol .fa {
    <?php venedor_print_hline_height(36, 'btn') ?>
}
<?php endif; ?>
<?php if ($c['btn-sborder']['border-top'] != '1px') : ?>
.yith-wcwl-add-to-wishlist > div > a:hover, .yith-wcwl-add-to-wishlist > div > a:focus,
a.compare.button:hover, a.compare.button:focus,
.added_to_cart:hover, .added_to_cart:focus,
.contact-icon,
.icon-box:hover, .icon-box:focus,
#topcontrol .btn:hover .fa, #topcontrol .btn:focus .fa {
    <?php venedor_print_sline_height(36, 'btn') ?>
}
#mini-cart.open .dropdown-toggle, #mini-cart .dropdown-toggle:hover, #mini-cart .dropdown-toggle:focus {
    <?php venedor_print_sline_height(22, 'btn') ?>
    padding-left: <?php echo 11 - (int)($c['btn-sborder']['border-top']) ?>px;
    padding-right: <?php echo 11 - (int)($c['btn-sborder']['border-top']) ?>px;
}
<?php endif; ?>

select, 
textarea, 
input[type="text"], 
input[type="password"], 
input[type="datetime"], 
input[type="datetime-local"], 
input[type="date"], 
input[type="month"], 
input[type="time"], 
input[type="week"], 
input[type="number"], 
input[type="email"], 
input[type="url"], 
input[type="search"], 
input[type="tel"], 
input[type="color"],
.input-field.comment-form-rating,
.woocommerce .chosen-container-single .chosen-single,
.woocommerce .chosen-container-active.chosen-with-drop .chosen-single,
.woocommerce .chosen-container .chosen-drop,
.woocommerce .select2-container .select2-choice,
.woocommerce .select2-container-active .select2-choice,
.woocommerce-page .select2-drop,
.address-field > strong {
    <?php venedor_print_bg('input') ?>
    <?php venedor_print_border('input') ?>
    <?php venedor_print_border_radius('input') ?>
    color: <?php echo $c['input-text-color'] ?>;
}
<?php if ($c['input-border']['border-top'] != '1px') : ?>
#main .woocommerce .chosen-container-single .chosen-single div,
#main .woocommerce .select2-container .select2-choice span {
    top: -<?php echo (int)$c['input-border']['border-top'] - 1 ?>px;
}
<?php endif; ?>
.input-field label,
.address-field label,
.textarea-field label { 
    color: <?php echo $c['link-color']['regular'] ?>;
    <?php venedor_print_bg('block-title') ?>
    border-radius: <?php echo venedor_config_value($venedor_design['input-border-radius']['right']) ?>px 0 0 <?php echo venedor_config_value($venedor_design['input-border-radius']['bottom']) ?>px;
    <?php venedor_print_border('input') ?>
    border-top-width: 0;
    border-bottom-width: 0;
    border-left-width: 0;
}
.input-field label, .address-field label, .textarea-field label {
    top: <?php echo $c['input-border']['border-top'] ?>;
    left: <?php echo $c['input-border']['border-left'] ?>;
    bottom: <?php echo $c['input-border']['border-bottom'] ?>;
    <?php if ($c['input-border']['border-top'] != '1px') : ?>
    <?php venedor_print_line_height(46, 'input') ?>
    <?php endif; ?>
}
.textarea-field label {
    border-bottom-width: <?php echo $c['input-border']['border-bottom'] ?>;
    border-right-width: 0;
    right: <?php echo $c['input-border']['border-right'] ?>;
    height: <?php echo 46 - (int)$c['input-border']['border-bottom'] ?>px;
}

.input-field .chzn-container-single .chzn-single,
.input-field .chzn-container .chzn-drop,
.input-field .chzn-container-single .chzn-search input,
.address-field .chzn-container-single .chzn-single,
.address-field .chzn-container .chzn-drop,
.address-field .chzn-container-single .chzn-search input{
    <?php venedor_print_bg('input') ?>
    <?php venedor_print_border('input') ?>
    <?php venedor_print_border_radius('input') ?>
    color: <?php echo $c['input-text-color'] ?> !important;
}

.ui-slider .ui-slider-range,
.ui-slider .ui-slider-handle {
    background-color: <?php echo $c['btn-hbg-color'] ?>;
}

/*========== Visual Composer ==========*/
.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab {
    border-top: 1px solid <?php echo $c['arrow-border']['border-color'] ?>;
}
body .wpb_content_element .wpb_tabs_nav li,
body .wpb_content_element .wpb_accordion_wrapper .wpb_accordion_header,
.nav-tabs > li > a {
    <?php venedor_print_bg('arrow') ?>
    <?php venedor_print_border('arrow') ?>
    color: <?php echo $c['arrow-text-color'] ?>;
    <?php venedor_print_typo('table-heading') ?>
}
body .wpb_content_element .wpb_tabs_nav li.ui-tabs-active,
body .wpb_content_element .wpb_tabs_nav li:hover,
.nav-tabs > li > a:hover, .nav-tabs > li > a:focus,
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    <?php venedor_print_bg('arrow') ?>
    <?php venedor_print_border('arrow') ?>
    border-bottom: 2px solid <?php echo $c['btn-hbg-color'] ?>;
}
body .wpb_content_element.wpb_tour .wpb_tabs_nav li.ui-tabs-active,
body .wpb_content_element.wpb_tour .wpb_tabs_nav li:hover {
    <?php venedor_print_border('arrow') ?>
    border-right: 2px solid <?php echo $c['btn-hbg-color'] ?>;
}
body .wpb_content_element .wpb_tabs_nav li a,
.nav-tabs > li > a {
    <?php venedor_print_typo('heading-desc') ?>
    color: <?php venedor_print_rgb($c['arrow-text-color'], -32) ?>;
}
body .wpb_content_element .wpb_tabs_nav li.ui-tabs-active a,
body .wpb_content_element .wpb_tabs_nav li:hover a,
.nav-tabs > li > a:hover, .nav-tabs > li > a:focus,
.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
    <?php venedor_print_typo('heading-desc') ?>
    color: <?php venedor_print_rgb($c['arrow-text-color'], -96) ?>;
}
body .wpb_content_element .custom-tabs .wpb_tabs_nav li a,
body .wpb_content_element .custom-tabs .wpb_tabs_nav li.ui-tabs-active a,
body .wpb_content_element .custom-tabs .wpb_tabs_nav li:hover a {
    font-family: <?php echo $c['table-heading-font']['font-family'] ?>;
}

/*========== Header Styles ========== */
.header-top {
    <?php venedor_print_typo('header') ?>
    <?php venedor_print_bg('header-top') ?>
    <?php venedor_print_border('header-top') ?>
    color: <?php echo $c['header-top-link-color']['regular'] ?>;
}
.header {
    <?php venedor_print_typo('header') ?>
    <?php venedor_print_bg('header') ?>
    <?php venedor_print_padding('header') ?>
}
.sticky-header {
    background-color: <?php echo $c['menu-bg-color'] ?>;
    /*background-color: <?php venedor_print_rgba($c['menu-bg-color'], 0.95) ?>;*/
}
.header .logo {
    <?php venedor_print_margin('header-logo') ?>
}
.topnav a {
    color: <?php echo $c['header-top-link-color']['regular'] ?>;
}
.topnav a .menu-icon {
    color: <?php echo $c['header-top-icon-color']['regular'] ?>;
}
.topnav a:hover,
.topnav a:focus {
    color: <?php echo $c['header-top-link-color']['hover'] ?>;
}
.login-links a {
    color: <?php echo $c['header-top-link-color']['hover'] ?>;
}
.login-links a:hover,
.login-links a:focus {
    color: <?php echo $c['header-top-link-color']['regular'] ?>;
}
.topnav a:hover .menu-icon,
.topnav a:focus .menu-icon {
    color: <?php echo $c['header-top-icon-color']['hover'] ?>;
}
.login-links.pos2,
.login-links.pos2 a {
    color: <?php echo $c['header-link-color']['regular'] ?>;
}
.login-links.pos2 a:hover,
.login-links.pos2 a:focus {
    color: <?php echo $c['header-link-color']['hover'] ?>;
}

/*========== Bootstrap Dropdown Styles ==========*/
.dropdown-menu {
    border-color: <?php echo $c['block-border']['border-color'] ?>;
}
.dropdown-menu > li a,
.dropdown-submenu:focus a {
    color: <?php echo $c['body-font']['color'] ?>;
}
.dropdown-menu > li a:hover,
.dropdown-menu > li a:focus,
.dropdown-menu > .active a,
.dropdown-menu > .active a:hover,
.dropdown-menu > .active a:focus,
.dropdown-submenu:hover > a {
    background-color: <?php echo $c['btn-hbg-color'] ?>;
    background-image: none;
    color: <?php echo $c['btn-hcolor'] ?>;
}
.dropdown-toggle {
    <?php venedor_print_border_radius('arrow') ?>
    <?php venedor_print_border('arrow') ?>
    color: <?php echo $c['arrow-text-color'] ?>;
}
.dropdown-toggle .arrow {
    <?php venedor_print_border('arrow') ?>
    background-color: <?php echo $c['arrow-bg-color'] ?>;
    border-radius: 0 <?php echo venedor_config_value($venedor_design['arrow-border-radius']['right']) ?>px <?php echo venedor_config_value($venedor_design['arrow-border-radius']['bottom']) ?>px 0;
}
<?php if ($c['arrow-border']['border-top'] != '1px') : ?>
.dropdown .dropdown-toggle .arrow {
    <?php venedor_print_line_height(30, 'arrow') ?>
}
<?php endif; ?>
.progress {
    background-color: <?php echo venedor_print_rgb($c['block-bg-color'], -10) ?>;
}
.progress-bar {
    background-color: <?php echo $c['btn-hbg-color'] ?>;
}
.progress-bar:before {
    border-left-color: <?php echo venedor_print_rgb($c['btn-hbg-color'], -20) ?>;
}
.progress-bar:after {
    border-top-color: <?php echo $c['btn-hbg-color'] ?>;
    border-right-color: <?php echo $c['btn-hbg-color'] ?>;
}

/*========== Store Switcher ==========*/
.view-switcher .dropdown,
#lang_sel > ul > li {
    <?php venedor_print_hbg('btn') ?>
}
.view-switcher .dropdown.open,
#lang_sel > ul > li:hover {
    <?php venedor_print_shbg('btn') ?>
}
.view-switcher .dropdown-toggle,
#lang_sel a.lang_sel_sel {
    color: <?php echo $c['btn-hcolor'] ?>;
}
.view-switcher .open .dropdown-toggle,
#lang_sel > ul > li:hover a.lang_sel_sel {
    color: <?php echo $c['btn-shcolor'] ?>;
}

<?php if ($c['view-switcher-width']) : ?>
.view-switcher .dropdown-toggle,
.view-switcher .dropdown-menu,
#lang_sel a,
#lang_sel ul ul {
    width: <?php echo $c['view-switcher-width'] ?>
}
<?php endif; ?>

.view-switcher .dropdown-menu > li a,
#lang_sel ul ul a, 
#lang_sel ul ul a:visited {
    color: <?php echo $c['body-font']['color'] ?>;
    border-bottom-width: 0;
    border-top: 1px solid <?php echo $c['btn-hcolor'] ?>;
    background-color: <?php echo $c['view-switcher-pbg-color'] ?>;
}
.view-switcher .dropdown-menu > li a:hover,
.view-switcher .dropdown-menu > li a:focus {
    color: <?php echo $c['btn-shcolor'] ?>;
    background-color: <?php echo $c['btn-sbg-color'] ?>;
}
#lang_sel ul ul *:hover > a:hover,
#lang_sel ul ul *:hover > a:focus {
    color: <?php echo $c['btn-shcolor'] ?> !important;
    background-color: <?php echo $c['btn-sbg-color'] ?>;
}

<?php if ($c['view-switcher-customize']) : ?>
.view-switcher .dropdown,
#lang_sel > ul > li {
    background-color: <?php echo $c['view-switcher-bg-color'] ?>;
}
.view-switcher .dropdown.open,
#lang_sel > ul > li:hover {
    background-color: <?php echo $c['view-switcher-hbg-color'] ?>;
}
.view-switcher .dropdown-toggle,
#lang_sel a.lang_sel_sel {
    color: <?php echo $c['view-switcher-link-color']['regular'] ?>;
}
.view-switcher .open .dropdown-toggle,
#lang_sel > ul > li:hover a.lang_sel_sel {
    color: <?php echo $c['view-switcher-link-color']['hover'] ?>;
}
.view-switcher .dropdown-menu > li a,
#lang_sel > ul > li:hover a.lang_sel_sel {
    color: <?php echo $c['view-switcher-plink-color']['regular'] ?>;
}
.view-switcher .dropdown-menu > li a:hover,
.view-switcher .dropdown-menu > li a:focus,
#lang_sel ul ul *:hover > a:hover,
#lang_sel ul ul *:hover > a:focus {
    background-color: <?php echo $c['view-switcher-phbg-color'] ?>;
    color: <?php echo $c['view-switcher-plink-color']['hover'] ?>;
}
<?php endif; ?>

#mini-cart .dropdown-menu {
    color: <?php echo $c['body-font']['color'] ?>;
    <?php venedor_print_border('mini-cart-popup') ?>
}

<?php if ($c['mini-cart-customize']) : ?>
#mini-cart .dropdown-toggle {
    <?php venedor_print_bg('mini-cart') ?>
    <?php venedor_print_border('mini-cart') ?>
    color: <?php echo $c['mini-cart-text-color'] ?>;
}
<?php if ($c['mini-cart-border']['border-top'] != '1px') : ?>
#mini-cart .dropdown-toggle {
    <?php venedor_print_line_height(22, 'mini-cart') ?>
    padding-left: <?php echo 11 - (int)($c['mini-cart-border']['border-top']) ?>px;
    padding-right: <?php echo 11 - (int)($c['mini-cart-border']['border-top']) ?>px;
}
<?php endif; ?>
#mini-cart.open .dropdown-toggle, #mini-cart .dropdown-toggle:hover, #mini-cart .dropdown-toggle:focus {
    <?php venedor_print_hbg('mini-cart') ?>
    <?php venedor_print_hborder('mini-cart') ?>
    color: <?php echo $c['mini-cart-hcolor'] ?>;
}
<?php if ($c['mini-cart-hborder']['border-top'] != '1px') : ?>
#mini-cart.open .dropdown-toggle, #mini-cart .dropdown-toggle:hover, #mini-cart .dropdown-toggle:focus {
    <?php venedor_print_hline_height(22, 'mini-cart') ?>
    padding-left: <?php echo 11 - (int)($c['mini-cart-hborder']['border-top']) ?>px;
    padding-right: <?php echo 11 - (int)($c['mini-cart-hborder']['border-top']) ?>px;
}
<?php endif; ?>
<?php if ($c['mini-cart-separate']) : ?>
#mini-cart .dropdown-toggle {
    border-width: 0 !important;
    padding: 0 !important;
    background: transparent !important;
    -webkit-box-shadow: none !important;
            box-shadow: none !important;
}
#mini-cart .dropdown-toggle .cart-icon,
#mini-cart .dropdown-toggle .cart-details {
    <?php venedor_print_bg('mini-cart') ?>
    <?php venedor_print_border('mini-cart') ?>
    color: <?php echo $c['mini-cart-text-color'] ?>;
    display: inline-block;
    padding: 8px 12px;
    height: 36px;
}
#mini-cart .dropdown-toggle .cart-icon {
    color: <?php echo $c['mini-cart-icon-color'] ?>;
}
#mini-cart .dropdown-toggle .cart-icon {
    width: 36px;
    margin-right: 1px;
}
#mini-cart.open .dropdown-toggle .cart-icon, #mini-cart .dropdown-toggle:hover .cart-icon, #mini-cart .dropdown-toggle:focus .cart-icon {
    <?php venedor_print_hbg('mini-cart') ?>
    <?php venedor_print_hborder('mini-cart') ?>
    color: <?php echo $c['mini-cart-hcolor'] ?>;
}
<?php endif; ?>
<?php endif; ?>

<?php if ($c['search-form-customize']) : ?>
.header-wrapper .searchform .text input,
.sticky-header .searchform .text input {
    <?php venedor_print_bg('search-form-textbox') ?>
    <?php venedor_print_border('search-form-textbox') ?>
    color: <?php echo $c['search-form-textbox-color'] ?>;
}
.header-wrapper .searchform button,
.sticky-header .searchform button {
    <?php venedor_print_bg('search-form-btn') ?>
    <?php venedor_print_border('search-form-btn') ?>
    color: <?php echo $c['search-form-btn-color'] ?>;
}
.header-wrapper .searchform button:hover, .header-wrapper .searchform button:focus,
.sticky-header .searchform button:hover, .sticky-header .searchform button:focus {
    <?php venedor_print_hbg('search-form-btn') ?>
    <?php venedor_print_hborder('search-form-btn') ?>
    color: <?php echo $c['search-form-btn-hcolor'] ?>;
}
<?php endif; ?>

/*=========== Block, Sidebar, Table, Form Styles ==========*/
.well,
.feature-box .feature-image,
.feature-box:hover,
.feature-box.hover,
.person .person-photo img,
.s2_form_widget {
    -webkit-box-shadow: none;
            box-shadow: none;
    <?php venedor_print_bg('block') ?>
    <?php venedor_print_border('block') ?>
}
.s2_form_widget {
    background-color: transparent;
    background-image: none;
}
.well {
    <?php venedor_print_border_radius('block') ?>
}
.sidebar-banner,
.autocomplete-suggestions {
    <?php venedor_print_border('block') ?>
}
.autocomplete-suggestion:hover {
    <?php venedor_print_bg('block') ?>
}
.resp-tabs-list li,
.panel-default > .panel-heading {
    border-color: <?php echo $c['block-border']['border-color'] ?>;
    <?php venedor_print_bg('block') ?>
}
.faq-wrapper .post-item {
    border-color: <?php echo $c['block-border']['border-color'] ?>;
}
.resp-tab-content,
.resp-vtabs .resp-tabs-container,
h2.resp-accordion {
    border-color: <?php echo $c['block-border']['border-color'] ?>;
}
.resp-tab-content {
    border-radius: 0 <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px;
}
.resp-easy-accordion .resp-tab-content {
    border-radius: 0;
}
.resp-vtabs {
    <?php venedor_print_border('block') ?>
    <?php venedor_print_bg('block') ?>
    <?php venedor_print_border_radius('block') ?>
}
.resp-tabs-list li:first-child {
    border-radius: <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px 0 0 0;
}
.resp-tabs-list li:last-child {
    border-radius: 0 <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px 0 0;
}
.resp-tabs-list li.last-child {
    border-radius: 0 <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px 0 0;
}
.resp-vtabs .resp-tabs-list li:last-child {
    border-radius: 0 0 0 <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px;
}
.resp-vtabs .resp-tabs-list li.last-child {
    border-radius: 0 0 0 <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px;
}
.resp-tabs-list li:first-child:last-child {
    border-radius: <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px 0 0;
}
.resp-tabs-list li:first-child.last-child,
h2.resp-accordion:first-child {
    border-radius: <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px 0 0;
}
.resp-vtabs .resp-tabs-list li:first-child:last-child {
    border-radius: <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px 0 0 <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px;
}
.resp-vtabs .resp-tabs-list li:first-child.last-child {
    border-radius: <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px 0 0 <?php echo venedor_config_value($venedor_design['block-border-radius']['top']) ?>px;
}
.resp-easy-accordion .resp-tabs-container {
    <?php venedor_print_border('block') ?>
    <?php venedor_print_border_radius('block') ?>
}
h2.resp-accordion {
    <?php venedor_print_bg('block') ?>
}
.resp-tab-active {
    color: <?php echo $c['block-title-color'] ?>;
}
.comment-list .comment-body {
    border-bottom: 1px solid <?php venedor_print_rgb($c['block-border']['border-color'], 16) ?>;
}

/*========== Main Menu ==========*/
.menu-wrapper {
    <?php venedor_print_bg('menu') ?>
    <?php venedor_print_margin('menu') ?>
    <?php venedor_print_padding('menu') ?>
    <?php venedor_print_border('menu') ?>
    padding-bottom: 0;
}
<?php if ($c['menu-in-container']) : ?>
.menu-wrapper {
    margin-left: auto;
    margin-right: auto;
    max-width: 1140px;
}
@media (max-width: 1199px) {
    .menu-wrapper {
    max-width: 940px;
    }
}
@media (max-width: 991px) {
    .menu-wrapper {
        max-width: 720px;
    }
}
@media (max-width: 767px) {
    .menu-wrapper {
        max-width: 100%;
    }
}
.sticky-header .menu-wrapper {
    max-width: 100%;
}
<?php endif; ?>
.mega-menu > ul > li > a, .mega-menu > ul > li > h5,
.mega-menu > ul > li li > a, .mega-menu > ul > li li > h5,
.accordion-menu > ul > li > a, .accordion-menu > ul > li > h5,
.accordion-menu > ul > li li > a, .accordion-menu > ul > li li > h5 {
    <?php venedor_print_typo('menu') ?>
    color: <?php echo $c['menu-link-color']['regular'] ?>;
}
<?php if ($c['menu-link-border']) : ?>
.mega-menu > ul > li {
    border-left: 1px solid <?php echo $c['menu-link-right-border-color'] ?>;
}
.mega-menu > ul > li > a, .mega-menu > ul > li > h5 {
    border-left: 1px solid <?php echo $c['menu-link-left-border-color'] ?>;
}
.mega-menu > ul > li:last-child {
    border-right: 1px solid <?php echo $c['menu-link-left-border-color'] ?>;
}
.mega-menu > ul > li.last-child {
    border-right: 1px solid <?php echo $c['menu-link-left-border-color'] ?>;
}
.mega-menu > ul > li:last-child > a, .mega-menu > ul > li:last-child > h5 {
    border-right: 1px solid <?php echo $c['menu-link-right-border-color'] ?>;
}
.mega-menu > ul > li.last-child > a, .mega-menu > ul > li.last-child > h5 {
    border-right: 1px solid <?php echo $c['menu-link-right-border-color'] ?>;
}
<?php if ($c['menu-link-hover-bg-color'] != $c['menu-link-bg-color']) : ?>
.mega-menu > ul > li:hover,
.mega-menu > ul > li > a:hover, .mega-menu > ul > li > a:focus,
.mega-menu > ul > li > h5:hover, .mega-menu > ul > li > h5:focus,
.mega-menu > ul > li:last-child:hover > a, .mega-menu > ul > li:last-child:hover > h5,
.mega-menu > ul > li.last-child:hover > a, .mega-menu > ul > li.last-child:hover > h5{
    border-color: <?php echo $c['menu-link-hover-bg-color']; ?>;
}
.mega-menu > ul > li:hover + li {
    border-left-color: <?php echo $c['menu-link-hover-bg-color']; ?>;
}
<?php endif; ?>
<?php endif; ?>
.mega-menu > ul > li > a,
.mega-menu > ul > li > h5 {
    color: <?php echo $c['menu-link-color']['regular'] ?>;
    <?php venedor_print_bg('menu-link') ?>
    text-transform: <?php echo $c['menu-text-transform'] ?>;
}
.header-wrapper .mega-menu > ul > li > a,
.header-wrapper .mega-menu > ul > li > h5 {
    <?php venedor_print_typo('menu') ?>
    color: <?php echo $c['menu-link-color']['regular'] ?>;
    padding-bottom: <?php echo 13 + $c['menu-padding']['padding-bottom'] ?>px;
}
<?php if ($b['menu-item-padding'] == 'static' && $c['menu-link-bg-color'] == 'transparent' && $c['menu-link-hover-bg-color'] == 'transparent') : ?>
.mega-menu > ul > li > a,
.mega-menu > ul > li > h5 {
    padding-left: 0;
    padding-right: 50px;
}
.mega-menu > ul > li:last-child > a,
.mega-menu > ul > li:last-child > h5 {
    padding-right: 25px;
}
.mega-menu > ul > li.last-child > a,
.mega-menu > ul > li.last-child > h5 {
    padding-right: 25px;
}
.mega-menu .pos-right .popup {
    right: 50px;
}
.mega-menu .pos-right:last-child .popup {
    right: 25px;
}
.mega-menu .pos-right.last-child .popup {
    right: 25px;
}
.menu-arrow .mega-menu > ul > li > a,
.menu-arrow .mega-menu > ul > li > h5 {
    padding-left: 0;
    padding-right: 40px;
}
.menu-arrow .mega-menu > ul > li:last-child > a,
.menu-arrow .mega-menu > ul > li:last-child > h5 {
    padding-right: 20px;
}
.menu-arrow .mega-menu > ul > li.last-child > a,
.menu-arrow .mega-menu > ul > li.last-child > h5 {
padding-right: 20px;
}
.menu-arrow .mega-menu .pos-right .popup {
    right: 40px;
}
.menu-arrow .mega-menu .pos-right:last-child .popup {
    right: 20px;
}
.menu-arrow .mega-menu .pos-right.last-child .popup {
    right: 20px;
}
.mega-menu > ul > li > a .tip, .mega-menu > ul > li li > a .tip, .mega-menu > ul > li > h5 .tip, .mega-menu > ul > li li > h5 .tip {
    margin-left: -45px;
}
<?php endif; ?>
.mega-menu > ul > li > a:hover,
.mega-menu > ul > li > a:focus,
.mega-menu > ul > li.active > a, .mega-menu > ul > li.active > h5,
.mega-menu > ul > li:hover > a,
.mega-menu > ul > li:hover > h5 {
    color: <?php echo $c['menu-link-color']['hover'] ?>;
    <?php venedor_print_bg('menu-link-hover') ?>
}
.header-wrapper .mega-menu > ul > li > a:hover,
.header-wrapper .mega-menu > ul > li > a:focus,
.header-wrapper .mega-menu > ul > li.active > a, .mega-menu > ul > li.active > h5,
.header-wrapper .mega-menu > ul > li:hover > a,
.header-wrapper .mega-menu > ul > li:hover > h5 {
    color: <?php echo $c['menu-link-color']['hover'] ?>;
}
<?php if ($c['menu-link-hover-bg-color'] != $c['menu-link-bg-color']) : ?>
.mega-menu > ul > li.active,
.mega-menu > ul > li.active > a, .mega-menu > ul > li.active > h5 {
    border-color: <?php echo $c['menu-link-hover-bg-color']; ?>;
}
.mega-menu > ul > li.active + li {
    border-left-color: <?php echo $c['menu-link-hover-bg-color']; ?>;
}
<?php endif; ?>
.accordion-menu > ul > li > a,
.accordion-menu > ul > li > h5 {
    color: <?php echo $c['submenu-link-color']['regular'] ?>;
    text-transform: <?php echo $c['menu-text-transform'] ?>;
}
.accordion-menu > ul > li > a:hover,
.accordion-menu > ul > li > a:focus,
.accordion-menu > ul > li.active > a, .accordion-menu > ul > li.active > h5 {
    color: <?php echo $c['submenu-link-color']['hover'] ?>;
}
.mega-menu .wide .popup > .inner,
.mega-menu .narrow .popup > .inner ul,
.sidebar-menu .wide .popup > .inner,
.sidebar-menu .narrow .popup > .inner ul,
#main-mobile-menu .accordion-menu {
    <?php venedor_print_bg('submenu') ?>
    <?php venedor_print_border('submenu') ?>
}
.mega-menu .popup ul li > a,
.mega-menu .popup ul li > h5,
.sidebar-menu .popup ul li > a,
.sidebar-menu .popup ul li > h5,
.accordion-menu > ul > li > ul > li > a,
.accordion-menu > ul > li > ul > li > h5,
.mega-menu .entry-title,
.mega-menu .page-title,
.sidebar-menu .entry-title,
.sidebar-menu .page-title,
.accordion-menu .entry-title,
.accordion-menu .page-title {
    <?php venedor_print_typo('submenu') ?>
    color: <?php echo $c['submenu-link-color']['regular'] ?>;
    text-transform: <?php echo $c['submenu-text-transform'] ?>;
}
.mega-menu .popup ul li > a,
.mega-menu .popup ul li > h5,
.sidebar-menu .popup ul li > a,
.sidebar-menu .popup ul li > h5,
.accordion-menu ul ul li > a,
.mega-menu .entry-title,
.mega-menu .page-title,
.sidebar-menu .entry-title,
.sidebar-menu .page-title,
.accordion-menu .entry-title,
.accordion-menu .page-title {
    color: <?php echo $c['submenu-link-color']['regular'] ?>;
}
.mega-menu .popup ul li > a:hover,
.mega-menu .popup ul li > a:focus,
.mega-menu .popup ul .active > a, .mega-menu .popup ul .active > h5,
.mega-menu .narrow .popup ul li > a:hover, .mega-menu .narrow .popup ul li > a:focus,
.mega-menu .narrow .popup ul li > h5:hover, .mega-menu .narrow .popup ul li > h5:focus,
.sidebar-menu .popup ul li > a:hover,
.sidebar-menu .popup ul li > a:focus,
.sidebar-menu .popup ul .active > a, .sidebar-menu .popup ul .active > h5,
.sidebar-menu .narrow .popup ul li > a:hover, .sidebar-menu .narrow .popup ul li > a:focus,
.sidebar-menu .narrow .popup ul li > h5:hover, .sidebar-menu .narrow .popup ul li > h5:focus,
.accordion-menu ul ul li > a:hover,
.accordion-menu ul ul li > a:focus,
.accordion-menu ul ul .active a, .accordion-menu ul ul .active > h5 {
    color: <?php echo $c['submenu-link-color']['hover'] ?>;
}
.mega-menu .wide .popup ul ul li > a, .mega-menu .wide .popup ul ul li > h5,
.sidebar-menu .wide .popup ul ul li > a, .sidebar-menu .wide .popup ul ul li > h5,
.accordion-menu ul ul ul li > a, .accordion-menu ul ul ul li > h5,
.menu-block {
    <?php venedor_print_typo('body') ?>
    color: <?php echo $c['submenu-link-color']['regular'] ?>;
    text-transform: none;
}
.mega-menu .wide .popup ul ul li > a:hover, .mega-menu .wide .popup ul ul li > a:focus,
.sidebar-menu .wide .popup ul ul li > a:hover, .sidebar-menu .wide .popup ul ul li > a:focus,
.accordion-menu ul ul ul li > a:hover, .accordion-menu ul ul ul li > a:focus {
    color: <?php echo $c['submenu-link-color']['hover'] ?>;
}
.mega-menu .wide .popup > .inner > ul > li > ul > li > a:before,
.mega-menu .wide .popup > .inner > ul > li > ul > li > h5:before,
.sidebar-menu .wide .popup > .inner > ul > li > ul > li > a:before,
.sidebar-menu .wide .popup > .inner > ul > li > ul > li > h5:before,
.accordion-menu > ul > li > ul > li > ul > li > a:before,
.accordion-menu > ul > li > ul > li > ul > li > h5:before {
    color: <?php echo $c['submenu-link-color']['hover'] ?>;
}
#main-mobile-toggle {
    <?php venedor_print_typo('menu') ?>
    color: <?php echo $c['menu-link-color']['regular'] ?>;
    font-size: 20px;
    text-transform: <?php echo $c['menu-text-transform'] ?>;
}
#main-mobile-toggle .icon-bar {
    background-color: <?php echo $c['btn-hcolor'] ?>;
}
#main-mobile-toggle:hover .icon-bar,
#main-mobile-toggle:focus .icon-bar {
    background-color: <?php echo $c['btn-text-color'] ?>;
}
#main-mobile-menu {
    <?php venedor_print_margin('menu') ?>
}
#main-mobile-menu .accordion-menu {
    border-top-width: <?php echo 2 + (int)$c['submenu-border']['border-top'] ?>px;
}
.accordion-menu ul ul {
    <?php venedor_print_bg('submenu2') ?>
}
.accordion-menu ul ul ul {
    <?php venedor_print_bg('submenu3') ?>
}
.mega-menu .tip,
.sidebar-menu .tip,
.accordion-menu .tip {
    color: <?php echo $c['btn-hcolor'] ?>;
    background: <?php echo $c['btn-hbg-color'] ?>;
}
.accordion-menu ul > li.has-sub > span.arrow {
    color: <?php echo $c['submenu-link-color']['regular'] ?>;
}
.sidebar-menu,
.widget .accordion-menu {
    <?php venedor_print_bg('submenu') ?>
    <?php venedor_print_border('block') ?>
}
.widget_sidebar_menu .widget-title {
    <?php venedor_print_typo('product-name') ?>
    <?php venedor_print_hbg('btn') ?>
    color: <?php echo $c['btn-hcolor'] ?>;
}
.sidebar-menu > ul > li {
    border-top: 1px solid <?php echo $c['block-border']['border-color'] ?>;
}
.sidebar-menu > ul > li:first-child {
    border-top: 0;
}
.widget .sidebar-menu > ul > li .arrow {
    color: <?php echo $c['arrow-text-color'] ?>;
}
.widget .sidebar-menu > ul > li.open .arrow,
.widget .sidebar-menu > ul > li .arrow:hover,
.widget .sidebar-menu > ul > li .arrow:focus {
    color: <?php echo $c['btn-sbg-color'] ?>;
}

/*========== Breadcrumbs ==========*/
.breadcrumbs {
    <?php venedor_print_typo('breadcrumbs') ?>
    <?php venedor_print_bg('breadcrumbs') ?>
    <?php venedor_print_border('breadcrumbs') ?>
    color: <?php echo $c['breadcrumbs-link-color']['regular'] ?>;
<?php if ($c['breadcrumbs-bg-color'] == 'transparent' && !$c['breadcrumbs-bg-mode']) : ?>
    padding-bottom: 0;
<?php endif; ?>
}
.breadcrumbs a {
    color: <?php echo $c['breadcrumbs-link-color']['regular'] ?>;
}
.breadcrumbs a:hover,
.breadcrumbs a:focus {
    color: <?php echo $c['breadcrumbs-link-color']['hover'] ?>;
}

/*========== Banner ==========*/
.banner-container {
    <?php venedor_print_bg('banner') ?>
    border-top: <?php echo venedor_config_value($c['banner-border-top']['border-top']) ?> <?php echo $c['banner-border-top']['border-style'] ?> <?php echo $c['banner-border-top']['border-color'] ?>;
    border-bottom: <?php echo venedor_config_value($c['banner-border-bottom']['border-bottom']) ?> <?php echo $c['banner-border-bottom']['border-style'] ?> <?php echo $c['banner-border-bottom']['border-color'] ?>;
}
<?php if ($c['banner-nav-customize']) : ?>
#wrapper .ls-container .ls-nav-prev,
#wrapper .ls-container .ls-nav-next,
#wrapper .rev_slider_wrapper .tparrows,
.product-topslider.owl-theme .owl-controls .owl-buttons div {
    <?php venedor_print_bg('banner-nav') ?>
    <?php venedor_print_border('banner-nav') ?>
    color: <?php echo $c['banner-nav-color'] ?>;
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}
#wrapper .rev_slider_wrapper .tparrows:before {
    color: <?php echo $c['banner-nav-color'] ?>;
}
#wrapper .ls-container .ls-nav-prev {
    <?php venedor_print_left_border_radius('banner-nav') ?>
}
#wrapper .ls-container .ls-nav-next {
    <?php venedor_print_right_border_radius('banner-nav') ?>
}
#wrapper .rev_slider_wrapper .tp-leftarrow,
#wrapper .rev_slider_wrapper .tp-rightarrow {
    <?php venedor_print_border_radius('banner-nav') ?>
}
#wrapper .container .ls-container .ls-nav-prev,
#wrapper .container .rev_slider_wrapper .tp-leftarrow,
#wrapper .container .ls-container .ls-nav-next,
#wrapper .container .rev_slider_wrapper .tp-rightarrow {
    <?php venedor_print_border_radius('banner-nav') ?>
}
#wrapper .ls-container .ls-nav-prev:hover, #wrapper .ls-container .ls-nav-prev:focus,
#wrapper .ls-container .ls-nav-next:hover, #wrapper .ls-container .ls-nav-next:focus,
#wrapper .rev_slider_wrapper .tparrows:hover, #wrapper .rev_slider_wrapper .tparrows:focus,
.product-topslider.owl-theme .owl-controls .owl-buttons div:hover {
    <?php venedor_print_hbg('banner-nav') ?>
    <?php venedor_print_hborder('banner-nav') ?>
    color: <?php echo $c['banner-nav-hcolor'] ?>;
}
#wrapper .rev_slider_wrapper .tparrows:hover:before, #wrapper .rev_slider_wrapper .tparrows:focus:before {
    color: <?php echo $c['banner-nav-hcolor'] ?>;
}
#wrapper .ls-container .ls-nav-prev,
#wrapper .ls-container .ls-nav-next,
#wrapper .rev_slider_wrapper .tparrows,
.product-topslider.owl-theme .owl-controls .owl-buttons div {
    width: 60px;
    height: 45px;
    line-height: 43px;
    text-align: center;
    font-family: "FontAwesome";
    font-size: 28px;
}
<?php if ($c['banner-nav-border']['border-top'] != '1px') : ?>
.product-topslider.owl-theme .owl-controls .owl-buttons div {
    <?php venedor_print_line_height(45, 'banner-nav') ?>
}
<?php endif; ?>
<?php if ($c['banner-nav-hborder']['border-top'] != '1px') : ?>
.product-topslider.owl-theme .owl-controls .owl-buttons div:hover {
    <?php venedor_print_hline_height(45, 'banner-nav') ?>
}
<?php endif; ?>
#wrapper .ls-container .ls-nav-prev,
#wrapper .rev_slider_wrapper .tp-leftarrow {
    left: 0;
}
#wrapper .ls-container .ls-nav-next,
#wrapper .rev_slider_wrapper .tp-rightarrow {
    right: 0;
}
#wrapper .container .ls-container .ls-nav-prev,
#wrapper .container .rev_slider_wrapper .tp-leftarrow {
    left: 10px;
}
#wrapper .container .ls-container .ls-nav-next,
#wrapper .container .rev_slider_wrapper .tp-rightarrow {
    right: 10px;
}
#wrapper .ls-container .ls-nav-prev:before,
#wrapper .rev_slider_wrapper .tp-leftarrow:before {
    content: "\f104";
}
#wrapper .ls-container .ls-nav-next:before,
#wrapper .rev_slider_wrapper .tp-rightarrow:before {
    content: "\f105";
}
#wrapper .rev_slider_wrapper .tp-bullets .bullet,
#wrapper .rev_slider_wrapper .tp-bullets .tp-bullet,
.product-topslider.owl-theme .owl-controls .owl-page span,
#wrapper .ls-container .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a {
    display: inline-block;
    margin: 10px 5px;
    <?php venedor_print_bg('banner-bullet') ?>
    <?php venedor_print_border('banner-bullet') ?>
    background-image: none;
    width: 10px; height: 10px; border-radius: 5px;
}
#wrapper .rev_slider_wrapper .tp-bullets .bullet:hover,
#wrapper .rev_slider_wrapper .tp-bullets .bullet.selected,
#wrapper .rev_slider_wrapper .tp-bullets .tp-bullet:hover,
#wrapper .rev_slider_wrapper .tp-bullets .tp-bullet.selected,
.product-topslider.owl-theme .owl-controls .owl-page.active span,
.product-topslider.owl-theme .owl-controls .owl-page:hover span,
#wrapper .ls-container .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a:hover,
#wrapper .ls-container .ls-bottom-nav-wrapper .ls-bottom-slidebuttons a.ls-nav-active {
    <?php venedor_print_hbg('banner-bullet') ?>
    <?php venedor_print_hborder('banner-bullet') ?>
}
#wrapper .ls-container .ls-bottom-nav-wrapper .ls-nav-start,
#wrapper .ls-container .ls-bottom-nav-wrapper .ls-nav-stop {
    background-image: none;
    color: <?php echo $c['banner-bullet-bg-color'] ?>;
    <?php if ($c['banner-bullet-bg-color'] == 'transparent') : ?>
    color: <?php echo $c['banner-bullet-border-color'] ?>;
    <?php endif; ?>
    font-family: "FontAwesome";
    display: inline-block;
    top: -40px;
}
#wrapper .ls-container .ls-bottom-nav-wrapper .ls-nav-start-active,
#wrapper .ls-container .ls-bottom-nav-wrapper .ls-nav-stop-active {
    color: <?php echo $c['banner-bullet-hbg-color'] ?>;
    <?php if ($c['banner-bullet-hbg-color'] == 'transparent') : ?>
    color: <?php echo $c['banner-bullet-hborder-color'] ?>;
    <?php endif; ?>
}
#wrapper .ls-container .ls-bottom-nav-wrapper .ls-nav-start:before {
    content: "\f04b";
}
#wrapper .ls-container .ls-bottom-nav-wrapper .ls-nav-stop:before {
    content: "\f04c";
}
<?php endif; ?>
#banner-wrapper .cat-title,
#banner-wrapper .cat-desc {
    color: <?php echo $c['banner-text-color'] ?>;
}

/*========== Post ==========*/
.post-content-wrap .post-date {
    <?php venedor_print_typo('product-name') ?>
    <?php venedor_print_bg('btn') ?>
    color: <?php echo $c['btn-text-color'] ?>;
}
.post-content-wrap .post-info a:hover .post-date,
.post-content-wrap .post-info a:focus .post-date {
    <?php venedor_print_hbg('btn') ?>
    color: <?php echo $c['btn-hcolor'] ?>;
}
.post-content-wrap .post-format {
    <?php venedor_print_hbg('btn') ?>
    color: <?php echo $c['btn-hcolor'] ?>;
}
.post-content-wrap .post-format.link {
    <?php venedor_print_shbg('btn') ?>
    color: <?php echo $c['btn-shcolor'] ?>;
}
.post-content-wrap .post-info a:hover .post-format.link,
.post-content-wrap .post-info a:hover .post-format.link {
    <?php venedor_print_hbg('btn') ?>
    color: <?php echo $c['btn-hcolor'] ?>;
}
.portfolio-content .entry-meta, .portfolio-content .entry-meta a, .portfolio-cats a,
.faq-content .entry-meta, .faq-content .entry-meta a, .faq-cats a,
.posted_in a {
    color: <?php echo $c['link-color']['hover'] ?>;
}
.product_meta a {
    color: <?php echo $c['body-font']['color'] ?>;
}
.entry-meta,
.post-title a:hover, .post-title a:focus,
.post-content .entry-title a:hover, .post-content .entry-title a:focus,
.portfolio-content .entry-meta a:hover, .portfolio-content .entry-meta a:focus,
.faq-content .entry-meta a:hover, .faq-content .entry-meta a:focus,
.portfolio-title a:hover, .portfolio-title a:focus,
.portfolio-cats a:hover, .portfolio-cats a:focus,
.posted_in a:hover, .posted_in a:focus,
.product_meta a:hover, .product_meta a:focus {
    color: <?php echo $c['link-color']['regular'] ?>;
}
.more-links.inline,
.read-more {
    color: <?php echo $c['btn-hbg-color'] ?>;
}
.more-links.inline:hover, .more-links.inline:focus,
.read-more:hover, .read-more:focus {
    color: <?php echo $c['btn-sbg-color'] ?>;
}
.title-gap-wrap .title-gap {
    border-bottom: 1px solid <?php echo $c['arrow-border']['border-color'] ?>;
}

/*========== Blog ==========*/
.timeline-icon { 
    color: <?php echo $c['arrow-border']['border-color'] ?>;
}
.timeline-date .timeline-title,
#infscr-loading { 
    font-family: <?php echo $c['btn-font']['font-family'] ?>;
    <?php venedor_print_border('arrow') ?>
    <?php venedor_print_bg('arrow') ?>
    color: <?php echo $c['arrow-text-color'] ?>
}
.timeline-content-gap,
.timeline-circle { 
    background: <?php echo $c['arrow-border']['border-color'] ?>;
}

/*========== Portfolio / FAQ / Testimonial ==========*/
.portfolio-filter a, .faq-filter a, .categories_filter a, .wpb_categories_filter a,
.product-tabs .nav-tabs > li > a,
.wpb_content_element .custom-tabs .wpb_tabs_nav li {
    <?php venedor_print_typo('table-heading') ?>
    <?php venedor_print_bg('btn') ?>
    color: <?php echo $c['btn-text-color'] ?>;
}
.wpb_content_element .custom-tabs .wpb_tabs_nav li a {
    color: <?php echo $c['btn-text-color'] ?>;
}
.portfolio-filter a:hover, .portfolio-filter a:focus, .portfolio-filter a.active,
.faq-filter a:hover, .faq-filter a:focus, .faq-filter a.active,
.categories_filter a:hover, .categories_filter a:focus, .categories_filter .active > a,
.wpb_categories_filter a:hover, .wpb_categories_filter a:focus, .wpb_categories_filter .active > a,
.product-tabs .nav-tabs > li.active > a, .product-tabs .nav-tabs > li.active > a:hover, .product-tabs .nav-tabs > li.active > a:focus,
.product-tabs .nav-tabs > li > a:hover, .product-tabs .nav-tabs > li > a:focus,
.wpb_content_element .custom-tabs .wpb_tabs_nav li.ui-tabs-active,
.wpb_content_element .custom-tabs .wpb_tabs_nav li:hover {
    <?php venedor_print_typo('table-heading') ?>
    <?php venedor_print_hbg('btn') ?>
    color: <?php echo $c['btn-hcolor'] ?>; 
}
.wpb_content_element .custom-tabs .wpb_tabs_nav li.ui-tabs-active a,
.wpb_content_element .custom-tabs .wpb_tabs_nav li:hover a {
    color: <?php echo $c['btn-hcolor'] ?>;
}
.testimonial .testimonial-details:before,
.quote:before,
blockquote:before {
    color: <?php echo $c['testimonial-quote-color'] ?>;
}
.testimonial .testimonial-details {
    border: 1px solid <?php echo $c['testimonial-border-color'] ?>;
    background: <?php echo $c['testimonial-bg-color'] ?>;
    color: <?php echo $c['testimonial-text-color'] ?>;
}
.quote,
blockquote {
    color: <?php echo $c['testimonial-text-color'] ?>;
}
.testimonial .testimonial-details:after {
    background: url(<?php echo str_replace( array( 'http:', 'https:' ), '', $c['testimonial-arrow']['url'] ) ?>) no-repeat center center;
}
.testimonial .testimonial-title {
    color: <?php echo $c['testimonial-title-color'] ?>;
}
.testimonial .meta-name,
.testimonial a .meta-name {
    color: <?php echo $c['testimonial-name-color'] ?> !important;
}
.testimonial a:hover .meta-name,
.testimonial a:focus .meta-name {
    color: <?php echo $c['testimonial-link-color'] ?> !important;
}
.testimonial .meta-date {
    color: <?php echo $c['testimonial-date-color'] ?>;
}

/*========== Category ==========*/
.toolbar {
    border-bottom-color: <?php echo $c['arrow-border']['border-color'] ?>;
}
.pager {
    border-top-color: <?php echo $c['arrow-border']['border-color'] ?>;
}
.toolbar .dropdown-toggle .arrow, 
.pager .dropdown-toggle .arrow {
    background-color: <?php echo $c['toolbar-btn-bg-color'] ?>;
}
.toolbar .view-mode a#grid {
    border-radius: <?php echo venedor_config_value($venedor_design['arrow-border-radius']['right']) ?>px 0 0 <?php echo venedor_config_value($venedor_design['arrow-border-radius']['bottom']) ?>px;
}
.toolbar .view-mode a#list {
    border-radius: 0 <?php echo venedor_config_value($venedor_design['arrow-border-radius']['right']) ?>px <?php echo venedor_config_value($venedor_design['arrow-border-radius']['bottom']) ?>px 0;
}
.toolbar .btn-arrow,
.view-mode a,
.woocommerce-pagination li > .page-numbers,
.pagination > a,
.tagcloud a,
.woocommerce .widget_layered_nav ul.yith-wcan-label li a,
.woocommerce-page .widget_layered_nav ul.yith-wcan-label li a,
.woocommerce .widget_layered_nav ul.yith-wcan-label li span,
.woocommerce-page .widget_layered_nav ul.yith-wcan-label li span {
    background-color: <?php echo $c['toolbar-btn-bg-color'] ?>;
}
.woocommerce .widget_layered_nav ul.yith-wcan-color li a,
.woocommerce-page .widget_layered_nav ul.yith-wcan-color li a,
.woocommerce .widget_layered_nav ul.yith-wcan-color li span,
.woocommerce-page .widget_layered_nav ul.yith-wcan-color li span {
    <?php venedor_print_border_radius('arrow') ?>
}
.woocommerce .widget_layered_nav ul.yith-wcan-color li a:hover, .woocommerce .widget_layered_nav ul.yith-wcan-color li a:focus,
.woocommerce-page .widget_layered_nav ul.yith-wcan-color li a:hover, .woocommerce-page .widget_layered_nav ul.yith-wcan-color li a:focus,
.woocommerce .widget_layered_nav ul.yith-wcan-color li.chosen a,
.woocommerce-page .widget_layered_nav ul.yith-wcan-color li.chosen a,
.woocommerce .widget_layered_nav ul.yith-wcan-color li span:hover, .woocommerce .widget_layered_nav ul.yith-wcan-color li span:focus,
.woocommerce-page .widget_layered_nav ul.yith-wcan-color li span:hover, .woocommerce-page .widget_layered_nav ul.yith-wcan-color li span:hover,
.woocommerce .widget_layered_nav ul.yith-wcan-color li.chosen span,
.woocommerce-page .widget_layered_nav ul.yith-wcan-color li.chosen span {
    <?php venedor_print_border_radius('arrow') ?>
    border: 2px solid <?php echo $c['btn-bg-color'] ?>;
}
input[type="radio"] + a {
    <?php venedor_print_border_radius('arrow') ?>
}
input[type="radio"]:checked + a {
    border: 2px solid <?php echo $c['btn-bg-color'] ?>;
}
.products .product > .inner {
    <?php venedor_print_bg('category-item') ?>
    <?php venedor_print_border('category-item') ?>
}
.products .product > .inner.hover {
    <?php venedor_print_bg('category-hitem') ?>
    <?php venedor_print_border('category-hitem') ?>
}
.grid-layout .post-item > .inner,
.teaser_grid_container .post-item > .inner,
.timeline-layout .post-item > .inner {
<?php venedor_print_bg('category-item') ?>
    <?php venedor_print_border('block') ?>
}
.align-right .timeline-arrow:before { 
    border-right-color: <?php echo $c['block-border']['border-color'] ?>;
}
.align-left .timeline-arrow:before { 
    border-left-color: <?php echo $c['block-border']['border-color'] ?>;
}
.align-right .timeline-arrow:after { 
    border-right-color: <?php echo $c['category-item-bg-color'] ?>;
}
.align-left .timeline-arrow:after { 
    border-left-color: <?php echo $c['category-item-bg-color'] ?>;
}
.post-title, 
.product h3,
.product-category h3,
.product-name,
.post-content .entry-title,
h1.product_title,
.resp-tabs-list li,
h2.resp-accordion,
#comments h2,
.product_list_widget a,
.entry-related h3,
.entry-comments h3,
.commentlist .meta, 
.comment-list .meta,
.post-title a,
.post-content .entry-title a,
.portfolio-title, .portfolio-title a,
.panel-title, .panel-title h4,
.panel > .panel-heading,
.testimonial .testimonial-title, 
.testimonial .meta-name,
#yith-wcwl-popup-message,
.osc-progressbar-label,
.feature-box h4,
.person .person-name,
.no-content-comment h3,
.counter-box-content h3,
.popover-title,
.counter-circle-wrapper .desc,
.wpb_toggle, #content h4.wpb_toggle,
.wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header a {
    <?php venedor_print_typo('product-name') ?>
}
.shop_table dl dd {
    color: <?php echo $c['product-name-font']['color'] ?>;
}
.product-name a {
    color: <?php echo $c['link-color']['hover'] ?>;
}
.product-name a:hover, .product-name a:focus,
.product a:hover h3, .product a:focus h3,
a:hover h1.product_title, a:focus h1.product_title {
    color: <?php echo $c['link-color']['regular'] ?>;
}
.product .onhot,
.product .onsale {
    <?php venedor_print_typo('product-sales') ?>
}
.product .price,
.product-price .amount,
.product-subtotal .amount,
.cart-subtotal .amount,
.total .amount,
.order-total .amount,
.no-content-comment h2,
.ls-inner .price-box {
    <?php venedor_print_typo('product-price') ?>
    color: <?php echo $c['product-price-color'] ?>;
}
.product-image .price-box,
.ls-inner .price-box {
    <?php venedor_print_bg('product-price') ?>
    color: <?php echo $c['product-sprice-color'] ?>;
}
.product-image .price-box .price {
    color: <?php echo $c['product-sprice-color'] ?>;
}
.product .price del {
    color: <?php echo $c['product-oprice-color'] ?>;
}
.product-subtotal .amount,
.total .amount,
.order-total .amount, 
.single_variation_wrap .price {
    color: <?php echo $c['product-price-color'] ?>;
}
.product_list_widget a,
.header-on-banner #mini-cart .product_list_widget a,
.comment-list .meta a {
    color: <?php echo $c['link-color']['hover'] ?>;
}
.product_list_widget a:hover, .product_list_widget a:focus,
.header-on-banner #mini-cart .product_list_widget a:hover, 
.header-on-banner #mini-cart .product_list_widget a:focus,
.comment-list .meta a:hover, .comment-list .meta a:focus {
    color: <?php echo $c['link-color']['regular'] ?>;
}
.product .price,
.product_list_widget .amount,
#mini-cart .subtotal {
    color: <?php echo $c['product-price-color'] ?>;
}
.product .onhot {
    <?php venedor_print_bg('product-hot') ?>
    color: <?php echo $c['product-hot-color'] ?>;
}
.product .onsale {
    <?php venedor_print_bg('product-sale') ?>
    color: <?php echo $c['product-sale-color'] ?>;
}

.product .ratings .star,
.comment-form-rating .stars,
.comment-form-rating .stars a,
.product_list_widget .star-rating {
    color: <?php echo $c['product-rating-star-color'] ?>;
}
.comment-form-rating .stars {
    margin-top: -<?php echo $c['input-border']['border-top'] ?>;
}
.product .ratings .amount,
.product .ratings .amount a,
.commentlist .meta,
.comment-list .meta,
.content-slider .post-item .meta-date,
.product-slider .post-item .meta-date,
.related-slider .post-item .meta-date{
    color: <?php echo $c['product-rating-color'] ?>;
}
.commentlist strong[itemprop="author"],
.comment-list .meta strong {
    color: <?php echo $c['link-color']['regular'] ?>;
}
.product .ratings .amount a:hover,
.product .ratings .amount a:focus {
    color: <?php echo $c['body-font']['color'] ?>;
}
#comments h2,
.commentlist li {
    border-bottom: 1px solid <?php echo $c['block-border']['border-color'] ?>;
}

#yith-wcwl-popup-message {
<?php if ($c['btn-bg-color'] == 'transparent') : ?>
    background: #fff;
<?php else : ?>
    <?php venedor_print_bg('btn') ?>
<?php endif; ?>
    <?php venedor_print_border('btn') ?>
    color: <?php echo $c['btn-text-color'] ?>;
}
.osc-progressbar-label,
.sr-only {
    color: <?php echo $c['heading-font']['color'] ?>;
}

<?php if ($c['addcart-customize']) : ?>
.add_to_cart_button, .cart-links,
.single_add_to_cart_button,
.added_to_cart:hover, .added_to_cart:focus {
    <?php venedor_print_bg('addcart') ?>
    <?php venedor_print_border('addcart') ?>
    color: <?php echo $c['addcart-color'] ?>;
    <?php if ($c['addcart-border']['border-top'] != '1px') : ?>
    <?php venedor_print_line_height(36, 'addcart') ?>
    <?php endif; ?>
}
.add_to_cart_button:hover, .add_to_cart_button:focus, 
.cart-links:hover, .cart-links:focus,
.single_add_to_cart_button:hover, .single_add_to_cart_button:focus,
.added_to_cart {
    <?php venedor_print_hbg('addcart') ?>
    <?php venedor_print_hborder('addcart') ?>
    color: <?php echo $c['addcart-hcolor'] ?>;
    <?php if ($c['addcart-hborder']['border-top'] != '1px') : ?>
    <?php venedor_print_hline_height(36, 'addcart') ?>
    <?php endif; ?>
}
<?php endif; ?>

<?php if ($c['addto-customize']) : ?>
.yith-wcwl-add-to-wishlist > div > a,
a.compare.button {
    <?php venedor_print_bg('addto') ?>
    <?php venedor_print_border('addto') ?>
    color: <?php echo $c['addto-color'] ?>;
    <?php if ($c['addto-border']['border-top'] != '1px') : ?>
    <?php venedor_print_line_height(36, 'addto') ?>
    <?php endif; ?>
}
.yith-wcwl-add-to-wishlist > div > a:hover, .yith-wcwl-add-to-wishlist > div > a:focus,
a.compare.button:hover, a.compare.button:focus {
    <?php venedor_print_hbg('addto') ?>
    <?php venedor_print_hborder('addto') ?>
    color: <?php echo $c['addto-hcolor'] ?>;
    <?php if ($c['addto-hborder']['border-top'] != '1px') : ?>
    <?php venedor_print_hline_height(36, 'addto') ?>
    <?php endif; ?>
}
<?php endif; ?>

.product .summary .description {
    border-bottom: 1px solid <?php venedor_print_rgb($c['block-border']['border-color'], 12) ?>;
}
.product .summary .product_meta {
    border-top: 1px solid <?php venedor_print_rgb($c['block-border']['border-color'], 12) ?>;
}
<?php if ($c['btn-border']['border-top'] != '1px') : ?>
.post-slideshow-wrap .figcaption .zoom-button, .post-slideshow-wrap .figcaption .link-button,
.portfolio-slideshow-wrap .figcaption .zoom-button, .portfolio-slideshow-wrap .figcaption .link-button,
.post-image .figcaption .zoom-button, .post-image .figcaption .link-button,
.product-image .figcaption  .zoom-button, .product-image .figcaption  .zoom-button {
    <?php venedor_print_line_height(36, 'btn') ?>
}
<?php endif; ?>
<?php if ($c['btn-hborder']['border-top'] != '1px') : ?>
.post-slideshow-wrap .figcaption .zoom-button:hover, .post-slideshow-wrap .figcaption .link-button:hover,
.portfolio-slideshow-wrap .figcaption .zoom-button:hover, .portfolio-slideshow-wrap .figcaption .link-button:hover,
.post-image .figcaption .zoom-button:hover, .post-image .figcaption .link-button:hover,
.product-image .figcaption  .zoom-button:hover, .product-image .figcaption  .zoom-button:hover,
.post-slideshow-wrap .figcaption .zoom-button:focus, .post-slideshow-wrap .figcaption .link-button:focus,
.portfolio-slideshow-wrap .figcaption .zoom-button:focus, .portfolio-slideshow-wrap .figcaption .link-button:focus,
.post-image .figcaption .zoom-button:focus, .post-image .figcaption .link-button:focus,
.product-image .figcaption  .zoom-button:focus, .product-image .figcaption  .zoom-button:focus {
    <?php venedor_print_hline_height(36, 'btn') ?>
}
<?php endif; ?>
@media (max-width: 767px) {
    <?php if ($c['btn-border']['border-top'] != '1px') : ?>
    .post-slideshow-wrap .figcaption .zoom-button, .post-slideshow-wrap .figcaption .link-button,
    .portfolio-slideshow-wrap .figcaption .zoom-button, .portfolio-slideshow-wrap .figcaption .link-button,
    .post-image .figcaption .zoom-button, .post-image .figcaption .link-button,
    .product-image .figcaption  .zoom-button, .product-image .figcaption  .zoom-button {
        <?php venedor_print_line_height(26, 'btn') ?>
    }
    <?php endif; ?>
    <?php if ($c['btn-hborder']['border-top'] != '1px') : ?>
    .post-slideshow-wrap .figcaption .zoom-button:hover, .post-slideshow-wrap .figcaption .link-button:hover,
    .portfolio-slideshow-wrap .figcaption .zoom-button:hover, .portfolio-slideshow-wrap .figcaption .link-button:hover,
    .post-image .figcaption .zoom-button:hover, .post-image .figcaption .link-button:hover,
    .product-image .figcaption  .zoom-button:hover, .product-image .figcaption  .zoom-button:hover,
    .post-slideshow-wrap .figcaption .zoom-button:focus, .post-slideshow-wrap .figcaption .link-button:focus,
    .portfolio-slideshow-wrap .figcaption .zoom-button:focus, .portfolio-slideshow-wrap .figcaption .link-button:focus,
    .post-image .figcaption .zoom-button:focus, .post-image .figcaption .link-button:focus,
    .product-image .figcaption  .zoom-button:focus, .product-image .figcaption  .zoom-button:focus {
        <?php venedor_print_hline_height(26, 'btn') ?>
    }
    <?php endif; ?>
}
<?php if ($c['btn-border']['border-top'] != '1px') : ?>
.post-slideshow-wrap.small-alt .figcaption .zoom-button,
.post-slideshow-wrap.small-alt .figcaption .link-button, .post-slideshow-wrap.grid .figcaption .zoom-button,
.post-slideshow-wrap.grid .figcaption .link-button, .post-slideshow-wrap.timeline .figcaption .zoom-button,
.post-slideshow-wrap.timeline .figcaption .link-button,
.portfolio-slideshow-wrap.small-alt .figcaption .zoom-button,
.portfolio-slideshow-wrap.small-alt .figcaption .link-button,
.portfolio-slideshow-wrap.grid .figcaption .zoom-button,
.portfolio-slideshow-wrap.grid .figcaption .link-button,
.portfolio-slideshow-wrap.timeline .figcaption .zoom-button,
.portfolio-slideshow-wrap.timeline .figcaption .link-button {
    <?php venedor_print_line_height(26, 'btn') ?>
}
<?php endif; ?>
<?php if ($c['btn-hborder']['border-top'] != '1px') : ?>
.post-slideshow-wrap.small-alt .figcaption .zoom-button:hover,
.post-slideshow-wrap.small-alt .figcaption .link-button:hover, .post-slideshow-wrap.grid .figcaption .zoom-button:hover,
.post-slideshow-wrap.grid .figcaption .link-button:hover, .post-slideshow-wrap.timeline .figcaption .zoom-button:hover,
.post-slideshow-wrap.timeline .figcaption .link-button:hover,
.portfolio-slideshow-wrap.small-alt .figcaption .zoom-button:hover,
.portfolio-slideshow-wrap.small-alt .figcaption .link-button:hover,
.portfolio-slideshow-wrap.grid .figcaption .zoom-button:hover,
.portfolio-slideshow-wrap.grid .figcaption .link-button:hover,
.portfolio-slideshow-wrap.timeline .figcaption .zoom-button:hover,
.portfolio-slideshow-wrap.timeline .figcaption .link-button:hover,
.post-slideshow-wrap.small-alt .figcaption .zoom-button:focus,
.post-slideshow-wrap.small-alt .figcaption .link-button:focus, .post-slideshow-wrap.grid .figcaption .zoom-button:focus,
.post-slideshow-wrap.grid .figcaption .link-button:focus, .post-slideshow-wrap.timeline .figcaption .zoom-button:focus,
.post-slideshow-wrap.timeline .figcaption .link-button:focus,
.portfolio-slideshow-wrap.small-alt .figcaption .zoom-button:focus,
.portfolio-slideshow-wrap.small-alt .figcaption .link-button:focus,
.portfolio-slideshow-wrap.grid .figcaption .zoom-button:focus,
.portfolio-slideshow-wrap.grid .figcaption .link-button:focus,
.portfolio-slideshow-wrap.timeline .figcaption .zoom-button:focus,
.portfolio-slideshow-wrap.timeline .figcaption .link-button:focus {
    <?php venedor_print_hline_height(26, 'btn') ?>
}
<?php endif; ?>
.product-image .figcaption .quickview-button {
    <?php venedor_print_border('arrow') ?>
    <?php venedor_print_bg('arrow') ?>
    <?php venedor_print_border_radius('arrow') ?>
    color: <?php venedor_print_rgb($c['arrow-text-color'], -35) ?>;
    background-color: <?php echo $c['arrow-border']['border-color'] ?>;
    <?php if ($c['btn-border']['border-top'] != '1px') : ?>
    <?php venedor_print_line_height(36, 'btn') ?>
    <?php endif; ?>
}
.product-image:hover .figcaption .quickview-button:hover {
    <?php venedor_print_hborder('arrow') ?>
    <?php venedor_print_hbg('arrow') ?>
    color: <?php echo $c['arrow-hcolor'] ?>;
    <?php if ($c['arrow-hborder']['border-top'] != '1px') : ?>
    <?php venedor_print_hline_height(36, 'arrow') ?>
    <?php endif; ?>
}

/*========== Checkout, Cart ==========*/
.shop_table {
    <?php venedor_print_border('block') ?>
    border-right-width: 0;
    border-bottom-width: 0;
    <?php venedor_print_typo('table-heading') ?>
    color: inherit;
    font-weight: normal;
}
.shop_table thead,
.shop_table tfoot,
.shop_table thead .product-name {
    <?php venedor_print_typo('table-heading') ?>
}
.shop_table thead tr,
.shop_table tfoot tr,
.shop_table .total,
.cart_totals .shop_table .order-total,
#order_review .shop_table tfoot tr.order-total {
    <?php venedor_print_bg('block') ?>
    <?php venedor_print_typo('table-heading') ?>
}
#order_review .shop_table tfoot tr {
    background: transparent;
    color: inherit;
}
.shop_table thead th,
.shop_table thead td,
.shop_table tfoot th,
.shop_table tfoot td {
    color: <?php echo $c['block-title-color'] ?>;
    border-right: 1px solid <?php echo $c['block-border']['border-color'] ?>;
    border-bottom: 1px solid <?php echo $c['block-border']['border-color'] ?>;
}
.cart_totals .shop_table {
    color: <?php echo $c['block-title-color'] ?>;
}
#order_review .shop_table tfoot th,
#order_review .shop_table tfoot td {
    color: inherit;
}
.shop_table tbody th,
.shop_table tbody td {
    border-right: 1px solid <?php echo $c['block-border']['border-color'] ?>;
    border-bottom: 1px solid <?php echo $c['block-border']['border-color'] ?>;
}
.shop_table tbody th:last-child,
.shop_table tbody td:last-child {
    border-right: 1px solid <?php echo $c['block-border']['border-color'] ?>;
}
.shop_table tbody th.last-child,
.shop_table tbody td.last-child {
    border-right: 1px solid <?php echo $c['block-border']['border-color'] ?>;
}
.shop_table tbody tr:last-child th,
.shop_table tbody tr:last-child td {
    border-bottom: 1px solid <?php echo $c['block-border']['border-color'] ?>;
}
.shop_table tbody tr.last-child th,
.shop_table tbody tr.last-child td {
    border-bottom: 1px solid <?php echo $c['block-border']['border-color'] ?>;
}
.shop_table.cart tbody .product-price .amount {
    color: <?php echo $c['link-color']['hover'] ?>;
}

.woocommerce-shipping-calculator section {
    <?php venedor_print_typo('body') ?>
}

/*========== Border Radius ==========*/
.addthis_toolbox.addthis_32x32_style span {
    <?php venedor_print_border_radius('btn') ?>
}
.quantity .plus {
    border-radius: <?php echo venedor_config_value($venedor_design['arrow-border-radius']['top']) ?>px <?php echo venedor_config_value($venedor_design['arrow-border-radius']['top']) ?>px 0 0 !important;
}
.quantity .minus {
    border-radius: 0 0 <?php echo venedor_config_value($venedor_design['arrow-border-radius']['top']) ?>px <?php echo venedor_config_value($venedor_design['arrow-border-radius']['top']) ?>px !important;
}
.product-featured-slider .product-image .btn-arrow.prev {
    border-radius: 0 <?php echo venedor_config_value($venedor_design['arrow-border-radius']['top']) ?>px <?php echo venedor_config_value($venedor_design['arrow-border-radius']['top']) ?>px 0;
}
.product-featured-slider .product-image .btn-arrow.next {
    border-radius: <?php echo venedor_config_value($venedor_design['arrow-border-radius']['top']) ?>px 0 0 <?php echo venedor_config_value($venedor_design['arrow-border-radius']['top']) ?>px;
}

/*========== Widgets ==========*/
.fb-likebox a,
.footer .fb-likebox a, 
.twitter-box .tweet-text a {
    color: <?php echo $c['btn-hbg-color'] ?>;
}
.fb-likebox a:hover,
.fb-likebox a:focus,
.twitter-box .tweet-text a:hover,
.twitter-box .tweet-text a:focus {
    color: <?php echo $c['btn-sbg-color'] ?>;
}
.accordion-menu > ul > li > a, .accordion-menu > ul > li > h5,
.widget > ul > li > a,
.widget .scrollwrap > ul > li > a,
.widget_nav_menu > div > ul > li > a, 
#wp-calendar caption
.yith-wcan-select-wrapper ul.yith-wcan-select.yith-wcan li a,
.widget_layered_nav ul.yith-wcan-select li a,
.widget .yit-wcan-select-open {
<?php if (isset($venedor_design['menu-font']['font-family'])) : ?>
    font-family: <?php echo $venedor_design['menu-font']['font-family'] ?>;
<?php endif; ?>
}
.accordion-menu li > a, .accordion-menu li > h5,
.widget li > a, .widget li > h5 {
    color: <?php echo $c['link-color']['hover'] ?>;
}
.accordion-menu li > a:hover, .accordion-menu li > a:focus,
.widget li > a:hover, .widget li > a:focus,
.widget li[class*="current-"] > a,
.widget li.chosen > a {
    color: <?php echo $c['link-color']['regular'] ?>;
}

.feature-box .line,
.shortcode-title .line { 
    background-color: <?php echo $c['btn-sbg-color'] ?>;
}
.feature-box:hover .feature-image {
    border-color: <?php echo $c['link-color']['regular'] ?>;
}
.feature-box.noborder .fa,
.feature-box:hover .fa {
    color: <?php echo $c['btn-hbg-color'] ?>;
}
.feature-box a:hover h4 {
    color: <?php echo $c['link-color']['regular'] ?>;
}

.widget_layered_nav,
.widget_layered_nav_filters,
.widget_price_filter,
.widget_product_categories,
.yith-wcan-select-wrapper {
    background-color: <?php venedor_print_rgb($c['block-bg-color'], 5) ?>;
    <?php venedor_print_border('block') ?>
    color: <?php echo $c['filter-text-color'] ?>;
}
.scrollwrap > .scroll-element {
    background-color: <?php venedor_print_rgb($c['block-bg-color'], 5) ?>;
}
.widget_layered_nav .widget-title,
.widget_layered_nav_filters .widget-title,
.widget_price_filter .widget-title,
.widget_product_categories .widget-title {
    <?php venedor_print_typo('table-heading') ?>
    color: <?php echo $c['filter-title-color'] ?>;
    background-color: <?php venedor_print_rgb($c['block-bg-color'], -3) ?>;
    border-bottom: 1px solid <?php echo $c['block-border']['border-color'] ?>;
}
.widget_layered_nav a, .widget_layered_nav ul a,
.widget_layered_nav_filters a, .widget_layered_nav_filters ul a,
.widget_price_filter a, .widget_price_filter ul a,
.widget_product_categories a, .widget_product_categories ul a,
.yith-wcan-select-wrapper ul.yith-wcan-select.yith-wcan li a,
.widget .yit-wcan-select-open {
    color: <?php echo $c['filter-text-color'] ?>;
}
.yith-wcan-select-wrapper ul.yith-wcan-select.yith-wcan li a:hover,
.widget .yit-wcan-select-open:hover {
    color: <?php echo $c['link-color']['regular'] ?>;
}

<?php if ($c['sidebar-style'] == 'background') : ?>
.left-sidebar .widget-title,
.right-sidebar .widget-title {
    <?php venedor_print_typo('product-name') ?>
    color: <?php echo $c['sidebar-heading1-text-color'] ?>;
    <?php venedor_print_bg('sidebar-heading1') ?>
    font-size: 17px;
    font-weight: bold;
    line-height: 20px;
    padding: 12px 18px;
    margin-bottom: 15px;
}
.left-sidebar .s2_form_widget h3.widget-title,
.right-sidebar .s2_form_widget h3.widget-title {
    <?php venedor_print_typo('heading') ?>
}
.left-sidebar .s2_form_widget,
.right-sidebar .s2_form_widget {
    background: <?php echo $c['sidebar-content-bg-color'] ?>;
}
.left-sidebar .widget_layered_nav,
.left-sidebar .widget_layered_nav_filters,
.left-sidebar .widget_price_filter,
.left-sidebar .widget_product_categories,
.right-sidebar .widget_layered_nav,
.right-sidebar .widget_layered_nav_filters,
.right-sidebar .widget_price_filter,
.right-sidebar .widget_product_categories {
    background-color: transparent;
    border-width: 0;
    margin-top: 67px;
}
.left-sidebar .widget_layered_nav .widget-title,
.left-sidebar .widget_layered_nav_filters .widget-title,
.left-sidebar .widget_price_filter .widget-title,
.left-sidebar .widget_product_categories .widget-title,
.right-sidebar .widget_layered_nav .widget-title,
.right-sidebar .widget_layered_nav_filters .widget-title,
.right-sidebar .widget_price_filter .widget-title,
.right-sidebar .widget_product_categories .widget-title,
.left-sidebar .widget_sidebar_menu .widget-title,
.right-sidebar .widget_sidebar_menu .widget-title {
    <?php venedor_print_typo('product-name') ?>
    color: <?php echo $c['sidebar-heading2-text-color'] ?>;
    <?php venedor_print_bg('sidebar-heading2') ?>
    border-width: 0;
}
.left-sidebar .content-slider.owl-theme .owl-controls .owl-buttons div,
.right-sidebar .content-slider.owl-theme .owl-controls .owl-buttons div {
    top: -49px;
}
.left-sidebar .content-slider.owl-theme .owl-controls .owl-buttons .owl-next,
.right-sidebar .content-slider.owl-theme .owl-controls .owl-buttons .owl-next {
    right: 12px;
}
.left-sidebar .content-slider.owl-theme .owl-controls .owl-buttons .owl-prev,
.right-sidebar .content-slider.owl-theme .owl-controls .owl-buttons .owl-prev {
    right: 49px;
}
body.archive.woocommerce .left-sidebar, body.archive.woocommerce .right-sidebar {
    margin-top: 0;
}
.widget_layered_nav > div, .widget_layered_nav > ul, .widget_layered_nav > form,
.widget_layered_nav_filters > div, .widget_layered_nav_filters > ul, .widget_layered_nav_filters > form,
.widget_price_filter > div, .widget_price_filter > ul, .widget_price_filter > form,
.widget_product_categories > div, .widget_product_categories > ul, .widget_product_categories > form,
.widget_categories > div, .widget_categories > ul, .widget_categories > form,
.widget .yit-wcan-select-open {
    padding: 0;
    background-color: <?php echo $c['sidebar-content-bg-color']; ?>;
    <?php venedor_print_border('block') ?>
    color: <?php echo $c['filter-text-color'] ?>;
}
.scrollwrap > .scroll-element {
    background-color: <?php echo $c['sidebar-content-bg-color']; ?>;
}
.widget_price_filter > div, .widget_price_filter > ul, .widget_price_filter > form {
    padding: 21px 20px 30px;
}
.widget_layered_nav_filters > div, .widget_layered_nav_filters > ul, .widget_layered_nav_filters > form {
    padding: 20px 20px 15px;
}
.widget_layered_nav > select {
    margin: 0;
}
.widget_product_categories > ul .arrow,
.widget_product_categories .scrollwrap > *:first-child .arrow,
.widget_categories > ul .arrow,
.widget_brand_nav.widget_layered_nav > ul .arrow,
.widget_brand_nav.widget_layered_nav .scrollwrap > *:first-child .arrow {
    left: auto;
    right: 0;
}
.widget_layered_nav .widget-title .toggle:hover, .widget_layered_nav .widget-title .toggle:focus,
.widget_layered_nav_filters .widget-title .toggle:hover, .widget_layered_nav_filters .widget-title .toggle:focus,
.widget_price_filter .widget-title .toggle:hover, .widget_price_filter .widget-title .toggle:focus,
.widget_product_categories .widget-title .toggle:hover, .widget_product_categories .widget-title .toggle:focus,
.widget_categories .widget-title .toggle:hover, .widget_categories .widget-title .toggle:focus {
    <?php venedor_print_hbg('btn') ?>
    <?php venedor_print_hborder('btn') ?>
}
.widget_product_categories > ul > li,
.widget_product_categories .scrollwrap > *:first-child > li,
.widget_categories > ul > li,
.widget_layered_nav > ul > li,
.widget_layered_nav .scrollwrap > *:first-child > li {
    padding-right: 0;
    padding-left: 0;
    border-bottom: 1px solid <?php echo $c['block-border']['border-color'] ?>;
}
.widget_product_categories > ul > li > ul,
.widget_product_categories .scrollwrap > *:first-child > li > ul,
.widget_categories > ul > li > ul,
.widget_layered_nav > ul > li > ul,
.widget_layered_nav .scrollwrap > *:first-child > li > ul {
    border-top: 1px solid <?php echo $c['block-border']['border-color'] ?>;
}
.widget_product_categories > ul > li:last-child,
.widget_product_categories .scrollwrap > *:first-child > li:last-child,
.widget_categories > ul > li:last-child,
.widget_layered_nav > ul > li:last-child,
.widget_layered_nav .scrollwrap > *:first-child > li:last-child {
    border-width: 0;
}
.widget_product_categories > ul > li > a,
.widget_product_categories .scrollwrap > *:first-child > li > a,
.widget_categories > ul > li > a,
.widget_layered_nav > ul > li > a,
.widget_layered_nav .scrollwrap > *:first-child > li > a{
    padding: 12px 0 12px 18px;
}
.widget_product_categories ul ul,
.widget_categories ul ul,
.widget_brand_nav.widget_layered_nav ul ul {
    padding-left: 35px;
    margin-left: 0;
    padding-top: 12px;
    padding-bottom: 12px;
}
.widget_product_categories ul ul ul,
.widget_categories ul ul ul,
.widget_brand_nav.widget_layered_nav ul ul ul {
    padding-left: 0;
    padding-top: 0;
    padding-bottom: 0;
}
.widget_product_categories > ul .arrow,
.widget_product_categories .scrollwrap > *:first-child .arrow,
.widget_categories > ul .arrow,
.widget_brand_nav.widget_layered_nav > ul .arrow,
.widget_brand_nav.widget_layered_nav .scrollwrap > *:first-child .arrow {
    border-radius: 0 !important;
    border-width: 0 !important;
    background: transparent !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    color: <?php echo $c['arrow-text-color'] ?> !important;
    width: 45px;
    height: 45px;
    line-height: 45px;
    font-size: 20px;
    top: 0;
    right: 0;
}
.widget_product_categories > ul .arrow:hover, .widget_product_categories > ul .arrow:focus,
.widget_product_categories .scrollwrap > *:first-child .arrow:hover, .widget_product_categories .scrollwrap > *:first-child .arrow:focus,
.widget_categories > ul .arrow:hover, .widget_categories > ul .arrow:focus,
.widget_brand_nav.widget_layered_nav > ul .arrow:hover, .widget_product_categories > ul .arrow:focus,
.widget_brand_nav.widget_layered_nav .scrollwrap > *:first-child .arrow:hover, .widget_product_categories .scrollwrap > *:first-child .arrow:focus {
    color: <?php echo $c['btn-sbg-color'] ?> !important;
}
.widget_product_categories > ul .arrow:before,
.widget_product_categories .scrollwrap > *:first-child .arrow:before,
.widget_categories > ul .arrow:before,
.widget_brand_nav.widget_layered_nav > ul .arrow:before,
.widget_brand_nav.widget_layered_nav .scrollwrap > *:first-child .arrow:before {
    content: "\f107";
}
.widget_product_categories > ul .open .arrow:before,
.widget_product_categories .scrollwrap > *:first-child .open .arrow:before,
.widget_categories > ul .open .arrow:before,
.widget_brand_nav.widget_layered_nav > ul .open .arrow:before,
.widget_brand_nav.widget_layered_nav .scrollwrap > *:first-child .open .arrow:before {
    content: "\f106";
}
.widget_layered_nav .count {
    padding: 12px 12px 12px 5px;
}
.widget_layered_nav ul.yith-wcan-color,
.widget_layered_nav ul.yith-wcan-label {
    margin-right: 0;
    padding: 20px 10px 10px 20px;
}
.widget_layered_nav > ul.yith-wcan-color > li,
.widget_layered_nav > ul.yith-wcan-label > li,
.widget_layered_nav .scrollwrap > *.yith-wcan-color:first-child > li,
.widget_layered_nav .scrollwrap > *.yith-wcan-label:first-child > li {
    border-width: 0;
}
.yith-woo-ajax-reset-navigation .yith-wcan {
    padding: 20px;
}
.widget .yit-wcan-select-open {
    padding: 20px;
    margin: 0;
}
.yit-wcan-select-open {
    background-position: right 10px top 25px;
}
.yit-wcan-select-open.active {
    background-position: right 10px bottom 25px;
}
.yith-wcan-select-wrapper {
    left: 0;
    right: 0;
}
.widget_categories > ul > li > a,
.widget_categories > ul > li > h5 {
    font-weight: normal;
    text-transform: none !important;
    font-size: 15px;
}
<?php endif; ?>

/*========== Sliders ==========*/
.product-topslider .price,
.product-featured-slider .price {
    color: <?php echo $c['product-price-color'] ?>;
}
.product-topslider .price del,
.product-featured-slider .price del {
    color: <?php echo $c['product-rating-color'] ?>;
}
.product-topslider .product-name, .product-topslider .product-desc,
.product-featured-slider .product-name {
    color: <?php echo $c['banner-text-color'] ?>;
}
.product-featured-slider .product-image {
    border: 1px solid <?php echo $c['arrow-border']['border-color'] ?>;
}
.owl-theme .owl-controls .owl-page span,
body .flex-control-paging li a {
    <?php venedor_print_border('btn') ?>
    <?php venedor_print_bg('btn') ?>
}
.owl-theme .owl-controls .owl-page.active span,
body .flex-control-paging li a.flex-active {
    <?php venedor_print_hborder('btn') ?>
    <?php venedor_print_hbg('btn') ?>
}

/*========== Footer ==========*/
.footer-wrapper {
    <?php venedor_print_bg('footer') ?>
    <?php venedor_print_typo('footer') ?>
}
.footer .widget ul li, 
.footer .widget ul li a,
.footer .widget ul li h5 {
    <?php venedor_print_typo('footer') ?>
}
.footer {
    <?php venedor_print_border('footer-widget') ?>
}
.footer-bottom {
    <?php venedor_print_bg('footer-bottom') ?>
    <?php venedor_print_border('footer-bottom') ?>
    color: <?php echo $c['footer-bottom-text-color'] ?>;
}
.social-links .social-link {
    <?php venedor_print_bg('footer-social') ?>
    <?php venedor_print_border('footer-social') ?>
    color: <?php echo $c['footer-social-color'] ?>;
    <?php if ($c['footer-social-border']['border-top'] != '1px') : ?>
    <?php venedor_print_line_height(38, 'footer-social') ?>
    <?php endif; ?>
}
.footer .widget-title, 
.footer h3 {
    <?php venedor_print_typo('footer-heading') ?>
}
.footer a,
.footer ul a,
.footer .twitter-box .twitter-slider .owl-controls .owl-buttons div {
    color: <?php echo $c['footer-link-color']['regular'] ?>;
}
.footer a:hover,
.footer a:focus,
.footer ul li > a:before,
.footer ul a:hover, .footer ul a:focus,
.footer .widget ul li a:hover, .footer .widget ul li a:focus,
.footer .twitter-box .twitter-slider .owl-controls .owl-buttons div:hover {
    color: <?php echo $c['footer-link-color']['hover'] ?>;
}
.content-bottom-wrapper {
    padding-top: <?php echo $c['content-bottom-padding-top'] ?>;
    <?php venedor_print_bg('content-bottom') ?>
}
.footer-top {
    <?php venedor_print_bg('footer-top') ?>
    color: <?php echo $c['footer-top-color'] ?>;
}
.footer-top h3 {
    color: <?php echo $c['footer-top-color'] ?>;
}
.footer-top a,
.footer-top .fb-likebox a, 
.footer-top .twitter-box .tweet-text a {
    color: <?php echo $c['footer-top-link-color']['regular'] ?>;
}
.footer-top a:hover, .footer-top a:focus,
.footer-top .fb-likebox a:hover, .footer-top .fb-likebox a:focus, 
.footer-top .twitter-box .tweet-text a:hover, .footer-top .twitter-box .tweet-text a:focus {
    color: <?php echo $c['footer-top-link-color']['hover'] ?>;
}
.footer-top input[type="text"] {
    <?php venedor_print_bg('footer-top-textbox') ?>
    <?php venedor_print_border('footer-top-textbox') ?>
    color: <?php echo $c['footer-top-textbox-color'] ?>;
}
.footer-top button,
.footer-top .btn, 
.footer-top .button,
.footer-top input[type="submit"][name="subscribe"],
.footer-top .twitter-box .twitter-slider .owl-controls .owl-buttons div {
    <?php venedor_print_bg('footer-top-btn') ?>
    <?php venedor_print_border('footer-top-btn') ?>
    <?php venedor_print_border_radius('btn') ?>
    color: <?php echo $c['footer-top-btn-color'] ?>;
}
<?php if ($c['footer-top-btn-border']['border-top'] != '1px') : ?>
.footer-top .twitter-box .twitter-slider .owl-controls .owl-buttons div {
    <?php venedor_print_line_height(26, 'footer-top-btn') ?>
}
<?php endif; ?>
.footer-top button:hover, .footer-top button:focus,
.footer-top .btn:hover, .footer-top .btn:focus,
.footer-top .button:hover, .footer-top .button:focus, 
.footer-top input[type="submit"][name="subscribe"]:hover, .footer-top input[type="submit"][name="subscribe"]:focus,
.footer-top .twitter-box .twitter-slider .owl-controls .owl-buttons div:hover {
    <?php venedor_print_hbg('footer-top-btn') ?>
    <?php venedor_print_hborder('footer-top-btn') ?>
    color: <?php echo $c['footer-top-btn-hcolor'] ?>;
}
<?php if ($c['footer-top-btn-hborder']['border-top'] != '1px') : ?>
.footer-top .twitter-box .twitter-slider .owl-controls .owl-buttons div:hover {
    <?php venedor_print_hline_height(26, 'footer-top-btn') ?>
}
<?php endif; ?>
.footer-top .twitter-tweets:after {
    color: <?php echo $c['footer-bg-color'] ?>;
}
.footer-bottom a {
    color: <?php echo $c['footer-bottom-link-color']['regular'] ?>;
}
.footer-bottom a:hover,
.footer-bottom a:focus {
    color: <?php echo $c['footer-bottom-link-color']['hover'] ?>;
}
.social-links .social-link {
    <?php venedor_print_border_radius('btn') ?>
}

/*========== 404 Page ==========*/
#main .no-content-comment h2 {
    color: <?php echo $c['link-color']['regular'] ?>;
}
#main .no-content-comment h3 {
    color: <?php echo $c['heading-font']['color'] ?>;
}

/*========== Other ==========*/
.scrollbar-rail > .scroll-element .scroll-bar {
    background: <?php echo $c['link-color']['regular'] ?>;
}

/*========= Media Styles ==========*/
@media (min-width: 1200px) {

}

@media (min-width: 768px) and (max-width: 991px) {
    /* Menu */
    <?php if ($c['menu-bg-color'] == $c['header-bg-color'] && $c['menu-border']['border-top'] == 0) : ?>
    .searchform-middle #main-mobile-menu {
        padding-top: 0;
    }
    <?php endif; ?>
}

@media (max-width: 767px) {
    /* Header */
    .header { padding-top: <?php echo 15 + (int)$c['header-padding']['padding-top'] ?>px; }

    /* Banner */
    <?php if ($c['banner-nav-customize']) : ?>
    #wrapper .ls-container .ls-nav-prev,
    #wrapper .ls-container .ls-nav-next,
    #wrapper .rev_slider_wrapper .tparrows,
    .product-topslider.owl-theme .owl-controls .owl-buttons div {
        width: 40px;
        height: 30px;
        line-height: 28px;
        font-size: 18px;
    }
    <?php if ($c['banner-nav-border']['border-top'] != '1px') : ?>
    .product-topslider.owl-theme .owl-controls .owl-buttons div {
        <?php venedor_print_line_height(30, 'banner-nav') ?>
    }
    <?php endif; ?>
    <?php if ($c['banner-nav-hborder']['border-top'] != '1px') : ?>
    .product-topslider.owl-theme .owl-controls .owl-buttons div:hover {
        <?php venedor_print_hline_height(30, 'banner-nav') ?>
    }
    <?php endif; ?>
    <?php endif; ?>

    /* Others */
    .resp-tabs-container {
        <?php venedor_print_border('block') ?>
        <?php venedor_print_border_radius('block') ?>
    }

    .resp-tab-content {
        border-radius: 0;
    }
}

@media (max-width: 480px) {
    body .wpb_content_element.wpb_tour .wpb_tabs_nav li.ui-tabs-active,
    body .wpb_content_element.wpb_tour .wpb_tabs_nav li:hover {
        <?php venedor_print_border('arrow') ?>
        border-bottom: 2px solid <?php echo $c['btn-hbg-color'] ?>;
    }
}

@media (min-width: 768px) {
    .header-on-banner .header-top,
    .header-on-banner .header,
    .header-on-banner .header a,
    .header-on-banner .header-block .fa,
    .header-on-banner .login-links.pos2,
    .header-on-banner .login-links.pos2 a,
    .header-on-banner .topnav a .menu-icon,
    .header-on-banner .topnav a,
    .header-on-banner .login-links a:hover,
    .header-on-banner .login-links a:focus,
    .header-on-banner .view-switcher .dropdown-toggle,
    .header-on-banner #lang_sel a.lang_sel_sel,
    .header-on-banner .mega-menu > ul > li > a,
    .header-on-banner .mega-menu > ul > li > h5,
    .header-on-banner.header-wrapper .searchform button,
    .header-on-banner #mini-cart .dropdown-toggle,
    .header-on-banner #main-mobile-toggle {
        color: <?php echo $c['header-on-banner-color'] ?>;
    }
    .header-on-banner .header a:hover, 
	.header-on-banner .header a:focus,
    .header-on-banner .login-links.pos2 a:hover, 
	.header-on-banner .login-links.pos2 a:focus {
        color: <?php echo $c['header-link-color']['hover'] ?>;
    }
    <?php if ($c['mini-cart-customize']) : ?>
    <?php if ($c['mini-cart-separate']) : ?>
    .header-on-banner #mini-cart .dropdown-toggle .cart-icon,
    .header-on-banner #mini-cart .dropdown-toggle .cart-details {
        color: <?php echo $c['header-on-banner-color'] ?>;
    }
    <?php endif; ?>
    <?php endif; ?>

    .header-on-banner .topnav a:hover .menu-icon,
    .header-on-banner .topnav a:focus .menu-icon {
        color: <?php echo $c['header-top-icon-color']['hover'] ?>;
    }

    .header-on-banner .topnav a:hover,
    .header-on-banner .topnav a:focus {
        color: <?php echo $c['header-top-link-color']['hover'] ?>;
    }

    .header-on-banner .view-switcher .dropdown.open,
    .header-on-banner #lang_sel > ul > li:hover {
        <?php venedor_print_shbg('btn') ?>
    }
    .header-on-banner .view-switcher .open .dropdown-toggle,
    .header-on-banner #lang_sel > ul > li:hover a.lang_sel_sel {
        color: <?php echo $c['btn-shcolor'] ?>;
    }

    <?php if ($c['view-switcher-customize']) : ?>
    .header-on-banner .view-switcher .dropdown.open,
    .header-on-banner #lang_sel > ul > li:hover {
        background-color: <?php echo $c['view-switcher-hbg-color'] ?>;
    }
    .header-on-banner .view-switcher .open .dropdown-toggle,
    .header-on-banner #lang_sel > ul > li:hover a.lang_sel_sel {
        color: <?php echo $c['view-switcher-link-color']['hover'] ?>;
    }
    <?php endif; ?>

    .header-on-banner .mega-menu > ul > li > a:hover,
    .header-on-banner .mega-menu > ul > li > a:focus,
    .header-on-banner .mega-menu > ul > li.active > a, 
	.header-on-banner .mega-menu > ul > li.active > h5,
    .header-on-banner .mega-menu > ul > li:hover > a,
    .header-on-banner .mega-menu > ul > li:hover > h5 {
        <?php if ($c['header-on-banner-color'] == $c['menu-link-color']['hover']) : ?>
        color: <?php echo $c['menu-link-hover-bg-color'] ?>;
        <?php else:  ?>
        color: <?php echo $c['menu-link-color']['hover'] ?>;
        <?php endif; ?>
    }

    .header-on-banner.header-wrapper .searchform button:hover,
    .header-on-banner.header-wrapper .searchform button:focus {
        <?php venedor_print_shborder('btn') ?>
        <?php venedor_print_shbg('btn') ?>
        color: <?php echo $c['btn-shcolor'] ?>;
    }
    <?php if ($c['search-form-customize']) : ?>
    .header-on-banner.header-wrapper .searchform button:hover,
    .header-on-banner.header-wrapper .searchform button:focus {
        <?php venedor_print_hbg('search-form-btn') ?>
        <?php venedor_print_hborder('search-form-btn') ?>
        color: <?php echo $c['search-form-btn-hcolor'] ?>;
    }
    <?php endif; ?>

    .header-on-banner #mini-cart.open .dropdown-toggle,
    .header-on-banner #mini-cart .dropdown-toggle:hover,
    .header-on-banner #mini-cart .dropdown-toggle:focus {
        <?php venedor_print_shborder('btn') ?>
        <?php venedor_print_shbg('btn') ?>
        color: <?php echo $c['btn-shcolor'] ?>;
    }
    <?php if ($c['mini-cart-customize']) : ?>
    .header-on-banner #mini-cart.open .dropdown-toggle,
    .header-on-banner #mini-cart .dropdown-toggle:hover,
    .header-on-banner #mini-cart .dropdown-toggle:focus {
        <?php venedor_print_hbg('mini-cart') ?>
        <?php venedor_print_hborder('mini-cart') ?>
        color: <?php echo $c['mini-cart-hcolor'] ?>;
    }
    <?php if ($c['mini-cart-separate']) : ?>
    .header-on-banner #mini-cart.open .dropdown-toggle .cart-icon,
    .header-on-banner #mini-cart .dropdown-toggle:hover .cart-icon,
    .header-on-banner #mini-cart .dropdown-toggle:focus .cart-icon {
        <?php venedor_print_hbg('mini-cart') ?>
        <?php venedor_print_hborder('mini-cart') ?>
        color: <?php echo $c['mini-cart-hcolor'] ?>;
    }
    <?php endif; ?>
    <?php endif; ?>

    .header-on-banner #main-mobile-toggle .btn:hover,
    .header-on-banner #main-mobile-toggle .btn:focus {
        <?php venedor_print_border('btn') ?>
        <?php venedor_print_bg('btn') ?>
        color: <?php echo $c['btn-text-color'] ?>;
    }
}

<?php if (isset($c['css-code'])) : ?>
<?php echo $c['css-code']; ?>
<?php endif; ?>