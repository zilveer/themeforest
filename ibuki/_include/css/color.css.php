<?php header("Content-type: text/css; charset=utf-8"); 

$absolute_path = __FILE__;
$path_to_file = explode( 'wp-content', $absolute_path );
$path_to_wp = $path_to_file[0];

require_once( $path_to_wp . '/wp-load.php' );

$options_ibuki = get_option('ibuki'); 

?>
/* Accent Color */

a:hover,
a:active,
a:focus,
.header-menu.header-left-opened #my-menu > .mm-panel li a:hover,
.header-menu.header-left-opened #my-menu > .mm-panel .sub-menu li.has-ul > a:hover,
.header-menu.header-right-opened #my-menu > .mm-panel li a:hover,
.header-menu.header-right-opened #my-menu > .mm-panel .sub-menu li.has-ul > a:hover,
.header-menu.header-left-button #my-menu > .mm-panel li a:hover,
.header-menu.header-left-button #my-menu > .mm-panel .sub-menu li.has-ul > a:hover,
.header-menu.header-right-button #my-menu > .mm-panel li a:hover,
.header-menu.header-right-button #my-menu > .mm-panel .sub-menu li.has-ul > a:hover,
.header-menu.header-left-opened .copyright-text a,
.header-menu.header-right-opened .copyright-text a,
.header-menu.header-left-button .copyright-text a,
.header-menu.header-right-button .copyright-text a,
.header-menu.header-left-opened .copyright-text a:hover,
.header-menu.header-left-opened .copyright-text a:active,
.header-menu.header-left-opened .copyright-text a:focus,
.header-menu.header-right-opened .copyright-text a:hover,
.header-menu.header-right-opened .copyright-text a:active,
.header-menu.header-right-opened .copyright-text a:focus,
.header-menu.header-left-button .copyright-text a:hover,
.header-menu.header-left-button .copyright-text a:active,
.header-menu.header-left-button .copyright-text a:focus,
.header-menu.header-right-button .copyright-text a:hover,
.header-menu.header-right-button .copyright-text a:active,
.header-menu.header-right-button .copyright-text a:focus,
.header-menu.header-normal #my-menu > .mm-panel li a:hover,
.header-menu.header-fixed #my-menu > .mm-panel li a:hover,
.header-menu.header-sticky #my-menu > .mm-panel li a:hover,
.header-menu.header-sticky.header-transparent-enabled.white-color #logo.logo-text:hover,
.header-menu.header-sticky.header-transparent-enabled.white-color #logo.logo-text:active,
.header-menu.header-sticky.header-transparent-enabled.white-color #logo.logo-text:focus,
#portfolio-filter ul li a.selected,
.portfolio-pagination-wrap ul li a:hover,
.portfolio-pagination-wrap ul li span.current,
.wpcf7 .wpcf7-submit,
.single-item-posts .entry-meta.entry-header a:hover,
#commentform #submit,
.error-caption a:hover,
.error-caption a:focus,
.error-caption a:active,
.tagcloud a,
.social_widget a i,
.footer-widgets a:hover,
a.button-main:hover,
a.button-main:active,
a.button-main:focus,
a.button-main.inverted,
.box.boxed-version .icon-boxed i,
.color-text,
.dropcap-color,
.icons-example ul li a:hover,
.woocommerce .woocommerce-pagination ul.page-numbers li a:hover,
.woocommerce-page .woocommerce-pagination ul.page-numbers li a:hover,
.woocommerce .woocommerce-pagination ul.page-numbers li span.page-numbers.current,
.woocommerce-page .woocommerce-pagination ul.page-numbers li span.page-numbers.current,
.woocommerce-info a:hover,
.portfolio-pagination-wrap.infinite-scroll-enabled ul li a:hover {
  color: <?php echo $options_ibuki['accent-color']; ?>;
}

.header-menu.header-left-opened #my-menu > .mm-panel li.current-cat > a:after,
.header-menu.header-left-opened #my-menu > .mm-panel li.current_page_item > a:after,
.header-menu.header-left-opened #my-menu > .mm-panel li.current-menu-item > a:after,
.header-menu.header-left-opened #my-menu > .mm-panel li.current-page-ancestor > a:after,
.header-menu.header-left-opened #my-menu > .mm-panel li.current-menu-ancestor > a:after,
.header-menu.header-right-opened #my-menu > .mm-panel li.current-cat > a:after,
.header-menu.header-right-opened #my-menu > .mm-panel li.current_page_item > a:after,
.header-menu.header-right-opened #my-menu > .mm-panel li.current-menu-item > a:after,
.header-menu.header-right-opened #my-menu > .mm-panel li.current-page-ancestor > a:after,
.header-menu.header-right-opened #my-menu > .mm-panel li.current-menu-ancestor > a:after,
.header-menu.header-left-button #my-menu > .mm-panel li.current-cat > a:after,
.header-menu.header-left-button #my-menu > .mm-panel li.current_page_item > a:after,
.header-menu.header-left-button #my-menu > .mm-panel li.current-menu-item > a:after,
.header-menu.header-left-button #my-menu > .mm-panel li.current-page-ancestor > a:after,
.header-menu.header-left-button #my-menu > .mm-panel li.current-menu-ancestor > a:after,
.header-menu.header-right-button #my-menu > .mm-panel li.current-cat > a:after,
.header-menu.header-right-button #my-menu > .mm-panel li.current_page_item > a:after,
.header-menu.header-right-button #my-menu > .mm-panel li.current-menu-item > a:after,
.header-menu.header-right-button #my-menu > .mm-panel li.current-page-ancestor > a:after,
.header-menu.header-right-button #my-menu > .mm-panel li.current-menu-ancestor > a:after,
.header-menu.header-left-opened .social-menu-nav.desktop:hover,
.header-menu.header-left-opened .social-menu-nav.desktop.open,
.header-menu.header-right-opened .social-menu-nav.desktop:hover,
.header-menu.header-right-opened .social-menu-nav.desktop.open,
.cart-contents span.woocommerce-notification-bubble,
.cart-contents:hover span.woocommerce-notification-bubble,
.wpcf7 .wpcf7-submit:hover,
.wpcf7 .wpcf7-submit:focus,
.wpcf7 .wpcf7-submit:active,
#commentform #submit:hover,
#commentform #submit:focus,
#commentform #submit:active,
#back-to-top:hover,
.tagcloud a:hover,
.tagcloud a:active,
.tagcloud a:focus,
.social_widget a:hover,
.footer-widgets .tagcloud a:hover,
.footer-widgets .social_widget a:hover,
a.button-main.inverted:hover,
a.button-main.inverted:active,
a.button-main.inverted:focus,
.box:hover .icon.circle-mode-box,
.pricing-table.selected .price,
.pricing-table.selected a.confirm,
.mejs-controls .mejs-time-rail .mejs-time-current,
.mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current,
.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
.woocommerce ul.products li.product .onsale,
.woocommerce-page ul.products li.product .onsale,
.woocommerce .product-wrap a.add_to_cart_button.added,
.woocommerce .product-wrap a.add_to_cart_button.loading,
.woocommerce ul.products li.product.outofstock .product-wrap a.add_to_cart_button,
.woocommerce-page ul.products li.product.outofstock .product-wrap a.add_to_cart_button,
.single-product .col-image .onsale,
.woocommerce button.button:hover, 
.woocommerce-page button.button:hover, 
.woocommerce input.button:hover, 
.woocommerce-page input.button:hover, 
.woocommerce #respond input#submit:hover, 
.woocommerce-page #respond input#submit:hover, 
.woocommerce #content input.button:hover, 
.woocommerce-page #content input.button:hover,
.woocommerce a.checkout-button:hover, 
.woocommerce-page a.checkout-button:hover,
.woocommerce .widget_layered_nav_filters ul li a, 
.woocommerce-page .widget_layered_nav_filters ul li a,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, 
.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle {
  background: <?php echo $options_ibuki['accent-color']; ?>;
}

.blog-navigation div a:hover,
.post-type-navi ul li a:hover,
a.button-main,
.highlight-text,
.progress-bar .bar,
.mejs-overlay:hover .mejs-overlay-button,
.woocommerce #content table.cart a.remove:hover, 
.woocommerce table.cart a.remove:hover, 
.woocommerce-page #content table.cart a.remove:hover, 
.woocommerce-page table.cart a.remove:hover,
.portfolio-pagination-wrap.infinite-scroll-enabled ul li a {
  background-color: <?php echo $options_ibuki['accent-color']; ?>;
}

.wpcf7 .wpcf7-submit,
#commentform #submit,
.tagcloud a,
.social_widget a,
.footer-widgets .tagcloud a:hover,
.footer-widgets .social_widget a:hover,
a.button-main:hover,
a.button-main:active,
a.button-main:focus,
a.button-main.inverted,
.box:hover .icon.circle-mode-box,
blockquote,
.portfolio-pagination-wrap.infinite-scroll-enabled ul li a:hover {
  border-color: <?php echo $options_ibuki['accent-color']; ?>;
}

#blog.center-blog .more-link,
#blog.masonry-blog .more-link {
  border-color: <?php echo $options_ibuki['accent-color']; ?>;
  color: <?php echo $options_ibuki['accent-color']; ?>;
}

#blog.center-blog .more-link:hover,
#blog.center-blog .more-link:focus,
#blog.center-blog .more-link:active,
#blog.masonry-blog .more-link:hover,
#blog.masonry-blog .more-link:focus,
#blog.masonry-blog .more-link:active {
  background-color: <?php echo $options_ibuki['accent-color']; ?>;
}

#blog.standard-blog .more-link {
  color: <?php echo $options_ibuki['accent-color']; ?>;
}

#blog.standard-blog .more-link span {
  background-color: transparent;
  border-color: <?php echo $options_ibuki['accent-color']; ?>;
}

#blog.standard-blog .more-link:hover span,
#blog.standard-blog .more-link:focus span,
#blog.standard-blog .more-link:active span {
  background-color: <?php echo $options_ibuki['accent-color']; ?>;
}

.header-menu.header-normal #my-menu > .mm-panel ul a:hover,
.header-menu.header-normal #my-menu > .mm-panel ul li.current-cat a,
.header-menu.header-normal #my-menu > .mm-panel ul li.current_page_item a,
.header-menu.header-normal #my-menu > .mm-panel ul li.current-menu-item a,
.header-menu.header-normal #my-menu > .mm-panel ul li.current-page-ancestor a,
.header-menu.header-normal #my-menu > .mm-panel ul li.current-menu-ancestor a,
.header-menu.header-fixed #my-menu > .mm-panel ul a:hover,
.header-menu.header-fixed #my-menu > .mm-panel ul li.current-cat a,
.header-menu.header-fixed #my-menu > .mm-panel ul li.current_page_item a,
.header-menu.header-fixed #my-menu > .mm-panel ul li.current-menu-item a,
.header-menu.header-fixed #my-menu > .mm-panel ul li.current-page-ancestor a,
.header-menu.header-fixed #my-menu > .mm-panel ul li.current-menu-ancestor a,
.header-menu.header-sticky #my-menu > .mm-panel ul a:hover,
.header-menu.header-sticky #my-menu > .mm-panel ul li.current-cat a,
.header-menu.header-sticky #my-menu > .mm-panel ul li.current_page_item a,
.header-menu.header-sticky #my-menu > .mm-panel ul li.current-menu-item a,
.header-menu.header-sticky #my-menu > .mm-panel ul li.current-page-ancestor a,
.header-menu.header-sticky #my-menu > .mm-panel ul li.current-menu-ancestor a,
.wc-forward:hover,
.woocommerce button.button, 
.woocommerce-page button.button, 
.woocommerce input.button, 
.woocommerce-page input.button, 
.woocommerce #respond input#submit, 
.woocommerce-page #respond input#submit, 
.woocommerce #content input.button, 
.woocommerce-page #content input.button,
.woocommerce a.checkout-button, 
.woocommerce-page a.checkout-button,
.woocommerce.widget .star-rating span:before,
.content-sidebar .widget.woocommerce.widget_shopping_cart .wc-forward:hover,
.header-menu.header-sticky.nav-small.header-transparent-enabled.white-color #my-menu > .mm-panel ul a:hover, 
.header-menu.header-sticky.nav-small.header-transparent-enabled.white-color #my-menu > .mm-panel ul li.current-cat a, 
.header-menu.header-sticky.nav-small.header-transparent-enabled.white-color #my-menu > .mm-panel ul li.current_page_item a, 
.header-menu.header-sticky.nav-small.header-transparent-enabled.white-color#my-menu > .mm-panel ul li.current-menu-item a, 
.header-menu.header-sticky.nav-small.header-transparent-enabled.white-color #my-menu > .mm-panel ul li.current-page-ancestor a, 
.header-menu.header-sticky.nav-small.header-transparent-enabled.white-color #my-menu > .mm-panel ul li.current-menu-ancestor a {
  color: <?php echo $options_ibuki['accent-color']; ?> !important;
}

.woocommerce button.button, 
.woocommerce-page button.button, 
.woocommerce input.button, 
.woocommerce-page input.button, 
.woocommerce #respond input#submit, 
.woocommerce-page #respond input#submit, 
.woocommerce #content input.button, 
.woocommerce-page #content input.button,
.woocommerce a.checkout-button, 
.woocommerce-page a.checkout-button,
.box:hover .icon.circle-mode-box.custom-color {
  border-color: <?php echo $options_ibuki['accent-color']; ?> !important;
}

.header-menu.header-normal #my-menu > .mm-panel ul .sub-menu li a,
.header-menu.header-fixed #my-menu > .mm-panel ul .sub-menu li a,
.header-menu.header-sticky #my-menu > .mm-panel ul .sub-menu li a,
.header-menu.header-sticky.header-transparent-enabled.white-color #my-menu > .mm-panel ul .sub-menu li a,
.header-menu.header-sticky.nav-small.header-transparent-enabled.white-color #my-menu > .mm-panel ul .sub-menu li a {
   color: #C0BDBF !important;
}

.header-menu.header-normal #my-menu > .mm-panel ul .sub-menu li a:hover,
.header-menu.header-normal #my-menu > .mm-panel ul .sub-menu li.current-menu-item a,
.header-menu.header-fixed #my-menu > .mm-panel ul .sub-menu li a:hover,
.header-menu.header-fixed #my-menu > .mm-panel ul .sub-menu li.current-menu-item a,
.header-menu.header-sticky #my-menu > .mm-panel ul .sub-menu li a:hover,
.header-menu.header-sticky #my-menu > .mm-panel ul .sub-menu li.current-menu-item a,
.header-menu.header-sticky.header-transparent-enabled.white-color #my-menu > .mm-panel > ul > li.megamenu > ul > li > a,
.header-menu.header-sticky.header-transparent-enabled.white-color #my-menu > .mm-panel ul .sub-menu li a:hover,
.header-menu.header-sticky.header-transparent-enabled.white-color #my-menu > .mm-panel ul .sub-menu li.current-menu-item a,
.header-menu.header-sticky.nav-small.header-transparent-enabled.white-color #my-menu > .mm-panel > ul > li.megamenu > ul > li > a,
.header-menu.header-sticky.nav-small.header-transparent-enabled.white-color #my-menu > .mm-panel ul .sub-menu li a:hover,
.header-menu.header-sticky.nav-small.header-transparent-enabled.white-color #my-menu > .mm-panel ul .sub-menu li.current-menu-item a {
  color: #FFFFFF !important;
}

/* One Page Navigation */

.header-menu.header-left-button #my-menu > .mm-panel li > a.current-one-page:after,
.header-menu.header-left-opened #my-menu > .mm-panel li > a.current-one-page:after,
.header-menu.header-right-button #my-menu > .mm-panel li > a.current-one-page:after,
.header-menu.header-right-opened #my-menu > .mm-panel li > a.current-one-page:after {
    background: <?php echo $options_ibuki['accent-color']; ?>;
}

.header-menu.header-normal #my-menu > .mm-panel ul li a.current-one-page,
.header-menu.header-fixed #my-menu > .mm-panel ul li a.current-one-page,
.header-menu.header-sticky #my-menu > .mm-panel ul li a.current-one-page {
    color: <?php echo $options_ibuki['accent-color']; ?>;
}

.header-menu.header-sticky.header-transparent-enabled.white-color #my-menu > .mm-panel ul li a.current-one-page {
    color: #FFFFFF;
}

.header-menu.header-sticky.nav-small.header-transparent-enabled.white-color #my-menu > .mm-panel ul li a.current-one-page {
    color: <?php echo $options_ibuki['accent-color']; ?>;
}
