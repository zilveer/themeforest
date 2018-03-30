/* Mango Config Styles */
/* Created at <?php echo date("Y-m-d H:i:s") ?> */
<?php 
global $mango_settings;
$s =   get_option('mango_settings');
?>

/* theme general color customization todo:tahir code start here*/
<?php
if ( !empty( $s[ 'mango_body_typography' ] ) ) {
$a = $s[ 'mango_body_typography' ]; ?>
body{
<?php if ( $a[ 'font-family' ] ) { ?>
	font-family : <?php echo $a[ 'font-family' ] . ( ( $a[ 'font-backup' ] ) ? ',' . $a[ 'font-backup' ] : '' ); ?>;
<?php } ?>
<?php if ( $a[ 'font-weight' ] ) { ?>
	font-weight :<?php echo $a[ 'font-weight' ] ?>;
<?php } ?>
<?php if ( $a[ 'font-style' ] ) { ?>
	font-style :<?php echo $a[ 'font-style' ] ?>;
<?php } ?>
<?php if ( $a[ 'color' ] ) { ?>
	color :<?php echo $a[ 'color' ] ?>;
<?php } ?>
	<?php if ( $a[ 'line-height' ] ) { ?>
		line-height :<?php echo $a[ 'line-height' ] ?>;
	<?php } ?>
	<?php if ( $a[ 'font-size' ] ) { ?>
		font-size :<?php echo $a[ 'font-size' ] ?>;
	<?php } ?>
}
<?php } ?>

<?php if($s[ 'breadcrumbs-separator' ]=='<'){
	$con = "\\f104";
}elseif($s[ 'breadcrumbs-separator' ]=='>'){
	$con = "\\f105";
}elseif($s[ 'breadcrumbs-separator' ]=='/'){
	$con = "/\\00a0";
}elseif($s[ 'breadcrumbs-separator' ]=='|'){
	$con = '|';
} ?>

.breadcrumb > li + li:before {
	content: "<?php echo $con; ?>";
}
<?php
echo "/*Color Customization*/";
if($s['mango_site_color'] && $s['mango_site_color'] != '#ca1515'){
	$theme_color = $s['mango_site_color'];
	$theme_shade_1 = mango_generate_theme_color_shades($theme_color,1);
	$theme_shade_2 = mango_generate_theme_color_shades($theme_color,2);
	$theme_shade_3 = mango_generate_theme_color_shades($theme_color,3);
	$theme_shade_4 = mango_generate_theme_color_shades($theme_color,4);
	$theme_shade_5 = mango_generate_theme_color_shades($theme_color,5);
	$theme_shade_6 = mango_generate_theme_color_shades($theme_color,6);
	$theme_shade_7 = mango_generate_theme_color_shades($theme_color,7);
	?>
	/*for theme color*/

	::-moz-selection{
		background-color : <?php echo $theme_color ?>;
	}

	::selection{
		background-color : <?php echo $theme_color ?>;
	}

	a,
	.blockquote-icon:before,
	.first-color,
	.dropcap.first-color,
	.btn.btn-border.btn-custom,
	.panel-heading a:hover,
	.panel-icon:hover,
	.confirm-box h4 > a:hover,
	.header-search-container.header-simple-search .btn:hover,
	.header-search-container.header-simple-search .btn:focus,
	.cart-dropdown .dropdown-toggle:hover > i,
	.cart-dropdown:hover .dropdown-toggle > i,
	.cart-dropdown.open .dropdown-toggle > i,
	.cart-dropdown .remove-btn:hover,
	#mobile-menu-btn:hover,
	#mobile-menu-btn.opened,
	.megamenu .menu-quick-tags a:hover,
	.megamenu-alert,
	.menu li li a:hover,
	.menu li li a:hover i,
	.side-menu .cart-link:hover,
	.side-menu .cart-link:hover > i,
	.side-menu .smenu li a:hover,
	.side-menu.dark .smenu  li a:hover,
	#side-menu-footer .social-icon:hover,
	#side-menu-footer .copyright a,
	.side-menu2 #side-menu-footer .copyright a:hover,
	.side-menu.dark #mobile-menu-btn:hover,
	.side-menu.dark .header-search-container.header-simple-search .btn:hover,
	.side-menu.dark .header-search-container.header-simple-search .btn:focus,
	.side-menu.dark .cart-text-price,
	.breadcrumb > li > a:hover,
	.breadcrumb > li > a:focus,
	.banner-classy .banner-content a:hover,
	.banner-classy .banner-content a:focus,
	.widget-category-menu ul li a >  i,
	.widget-category-menu ul li a:hover,
	.informations-widget a:hover,
	.informations-widget a:focus,
	.banner.banner-tech h3 > span,
	.banner .banner-price,
	.producents-widget .more-link,
	.banner-category-list li > a:hover,
	.banner-category-list li > a:hover > i,
	.banner.banner-box .banner-content  a,
	.product.product-lger .product-title a:hover,
	.product.product-lger .product-title a:focus,
	.lookbook-carousel .product-meta-box .product-price,
	.company-info a:hover,
	.company-info a:focus,
	.banner.banner-vine h3,
	.newsletter-box-form .btn:hover,
	.newsletter-box-form .btn:focus,
	.presentation-content footer a:hover,
	.presentation-content footer a:focus,
	.category-list li a > i,
	.category-list li a:hover,
	.category-list li a:focus,
	#category-widget a:hover,
	.checkout .helper-link,
	.shop-continue-box .multiple-link:hover,
	.shop-continue-box .multiple-link:focus,
	.side-menu-widget ul li a:hover,
	.side-menu-widget ul li a:focus,
	.entry-title a:hover,
	.entry-readmore:hover,
	.entry-cats a:hover,
	.sidebar .widget .links li:hover a,
	.entry-tags a:hover,
	.product-title a:hover,
	.product-title a:focus,
	.product-btn:hover,
	.product-btn:focus,
	.product-price, .product-price-container ins>.amount,.product-price-container >.amount,
	.rating-amount,
	.list-btn.list-btn-wishlist:hover,
	.list-btn.list-btn-wishlist:focus,
	.product-details .product-cats a:hover,
	.product-details .product-cats a:focus,
	.product-details .product-ratings-count,
	.product-details .product-tags a:hover,
	.product-details .product-tags a:focus,
	.widget-banner h5 a,
	.portfolio-tags a:hover,
	.portfolio-tags a:focus,
	.portfolio-comment-link,
	.portfolio-details-list li a:hover>span,
	#footer .widget .products-list .product-title a:hover,
	#footer .widget .products-list .product-title a:focus,
	#footer a:hover,
	#footer a:focus,
	#footer.footer-minimal2 a:hover,
	#footer.footer-minimal2 a:focus,
	#footer.footer-minimal3 a:hover,
	#footer.footer-minimal3 a:focus,
	#footer.footer-minimal4 a:hover,
	#footer.footer-minimal4 a:focus,
	#footer.footer-dark .widget .contact-list li a:hover,
	#footer.footer-dark .widget .contact-list li a:focus,
	#footer .copyright a,
	#footer.footer-dark .copyright a:hover,
	#footer.footer-dark .copyright a:focus,
	#footer.footer-minimal .copyright a,
	#footer .footer-menu li a:hover,
	#footer .footer-menu li a:focus,
	#footer.footer-minimal .footer-menu li a:hover,
	#footer.footer-minimal .footer-menu li a:focus,
	.social-icon:hover,
	.social-icon:focus,
	.error-content p > a,
	aside>.page-sidebar ul li a:hover,
	.widget_product_categories ul li a > i,
	.yith-woocompare-widget>ul.products-list a.remove,
	.yith-woocompare-widget>ul.products-list a.remove:hover,
	code,.entry-author,span.markplace-num {
	color: <?php echo $theme_color ?>;
	}

	.btn-custom2:hover,
	.btn-custom2:focus,
	.btn-custom2.focus,
	.btn-custom2:active,
	.btn-custom2.active,
	.open > .dropdown-toggle.btn-custom2,
	blockquote:after,
	.dropcap-bg.first-color,
	.btn-custom,
	.blt-circle > li:before,
	.btn-custom2:hover,
	.btn-custom2:focus,
	.btn-custom2.focus,
	.btn-custom2:active,
	.btn-custom2.active,
	.open > .dropdown-toggle.btn-custom2,
	.btn-custom4:hover,
	.btn-custom4:focus,
	.btn-custom4.focus,
	.btn-custom4:active,
	.btn-custom4.active,
	.open > .dropdown-toggle.btn-custom4,
	.btn-white:hover,
	.btn-white:focus,
	.btn-white.focus,
	.btn-white:active,
	.btn-white.active,
	.open > .dropdown-toggle.btn-white,
	.btn.btn-border.btn-default:hover,
	.btn.btn-border.btn-default:focus,
	.btn.btn-border.btn-custom:hover,
	.btn.btn-border.btn-custom:focus,
	.btn.btn-border.btn-white:hover,
	.btn.btn-border.btn-white:focus,
	.btn.btn-border.btn-white.dark:hover,
	.btn.btn-border.btn-white.dark:focus,
	.custom-radio-container .custom-radio-icon,
	.nav-tabs > li.active > a,
	.nav-tabs > li.active > a:hover,
	.nav-tabs > li.active > a:focus,
	.nav-lava .lavalamp-object,
	.progress-bar-custom,
	.progress-bar-custom .progress-tooltip,
	.list-group-item.active,
	.list-group-item.active:hover,
	.list-group-item.active:focus,
	.tooltip-inner,
	.popover-title,
	.carousel-control:hover,
	.carousel-control:focus,
	.dropdown-menu > li > a:hover,
	.dropdown-menu > li > a:focus,
	.header1 .header-search-container .btn:hover,
	#header #header-top.custom .cart-dropdown .dropdown-toggle,
	#header #header-top.dark .cart-dropdown:hover .dropdown-toggle,
	#header #header-top.dark .cart-dropdown .dropdown-toggle:hover,
	#header #header-top.dark .cart-dropdown.open .dropdown-toggle,
	#header-top.dark .cart-dropdown .dropdown-toggle:hover > i,
	#header-top.dark .cart-dropdown:hover .dropdown-toggle > i,
	#header-top.dark .cart-dropdown.open .dropdown-toggle > i,
	#header.header10 .header-box-icon,
	#header.header10 #menu-container,
	#header.header11 #menu-container,
	#menu-container.custom,
	.banner-info.custom,
	.title-underblock  > span:after,
	.widget-category-menu h3,
	.services-container li > span,
	.label.label-hot,
	.noUi-connect,
	.noUi-handle,
	.cart-product-list .product-action .btn.btn-custom2:hover,
	.cart-product-list .product-action .btn.btn-custom2:focus,
	.sidebar .tagcloud a:hover,
	.product-btn.dark:hover,
	.product-btn.dark:focus,
	.product-action-container .product-btn.product-add-btn:hover,
	.product-action-container .product-btn.product-add-btn:focus,
	.list-btn.list-btn-add:hover,
	.list-btn.list-btn-add:focus,
	.owl-dot.active,
	.widget_product_categories h3,
	.price_slider_wrapper .button:hover,
	.ui-slider-range.ui-widget-header.ui-corner-all,
	.ui-slider-handle.ui-state-default.ui-corner-all,
	.ui-slider-handle,
	.sbOptions a:hover, .sbOptions a:focus, .sbOptions a.sbFocus,.vendor-profile-bg
	.page >form input[type="submit"]:hover,.page>center>p>a.button:hover,
	table.table.table-condensed.table-vendor-sales-report th,.footer-newsletter-box p input[type="submit"] {
	background-color: <?php echo $theme_color; ?>;
}

	blockquote,
	.tooltip.left .tooltip-arrow,
	.popover.left > .arrow{
	border-left-color : <?php echo $theme_color; ?>;
	}

	blockquote.blockquote-reverse,
	.highlight.first-color,
	.tooltip.top .tooltip-arrow,
	.popover.right > .arrow{
	border-right-color : <?php echo $theme_color; ?>;
	}

	.btn-custom,
	.btn-custom4:hover,
	.btn-custom4:focus,
	.btn-custom4.focus,
	.btn-custom4:active,
	.btn-custom4.active,
	.open > .dropdown-toggle.btn-custom4,
	.btn-white:hover,
	.btn-white:focus,
	.btn-white.focus,
	.btn-white:active,
	.btn-white.active,
	.open > .dropdown-toggle.btn-white,
	.btn.btn-border.btn-default:hover,
	.btn.btn-border.btn-default:focus,
	.btn.btn-border.btn-custom:hover,
	.btn.btn-border.btn-custom:focus,
	.btn.btn-border.btn-white:hover,
	.btn.btn-border.btn-white:focus,
	.btn.btn-border.btn-white.dark:hover,
	.btn.btn-border.btn-white.dark:focus,
	.custom-radio-container .custom-radio-icon,
	.list-group-item.active,
	.list-group-item.active:hover,
	.list-group-item.active:focus,
	.carousel-control:hover,
	.carousel-control:focus,
	.header1 .header-search-container .btn:hover,
	#header.header10 .header-box-icon,
	.widget-category-menu,
	#newsletter-section .btn-white:hover,
	#newsletter-section .btn-white:focus,
	.cart-product-list .product-action .btn.btn-custom2:hover,
	.cart-product-list .product-action .btn.btn-custom2:focus,
	.widget_product_categories,
	.price_slider_wrapper .button:hover,
	.nav-tabs > li.active > a,
	.nav-tabs > li.active > a:hover,
	.nav-tabs > li.active > a:focus,
	.vertical-tab.left .nav-tabs > li.active > a,
	.vertical-tab.left .nav-tabs > li.active > a:hover,
	.vertical-tab.left .nav-tabs > li.active > a:focus,
	.vertical-tab.right .nav-tabs.nav-tabs-inverse > li.active > a,
	.vertical-tab.right .nav-tabs.nav-tabs-inverse > li.active > a:hover,
	.vertical-tab.right .nav-tabs.nav-tabs-inverse > li.active > a:focus,
	.nav-tabs.nav-justified > .active > a,
	.nav-tabs.nav-justified > .active > a:hover,
	.nav-tabs.nav-justified > .active > a:focus,
	.popover,
	.btn-custom2:hover,
	.btn-custom2:focus,
	.btn-custom2.focus,
	.btn-custom2:active,
	.btn-custom2.active,
	.open > .dropdown-toggle.btn-custom2 {
	border-color : <?php echo $theme_color ?>;
	}

	.nav-tabs.nav-tabs-inverse > li.active > a,
	.nav-tabs.nav-tabs-inverse > li.active > a:hover,
	.nav-tabs.nav-tabs-inverse > li.active > a:focus,
	.progress-bar-custom .progress-tooltip:after,
	.popover.top > .arrow{
	border-top-color:<?php echo $theme_color ?>;
	}

	.nav-tabs.nav-tabs-inverse > li.active > a,
	.nav-tabs.nav-tabs-inverse > li.active > a:hover,
	.nav-tabs.nav-tabs-inverse > li.active > a:focus,
	.tooltip.right .tooltip-arrow,
	.tooltip.bottom .tooltip-arrow,
	.popover-title,
	.popover.bottom > .arrow,
	.popover.bottom > .arrow:after{
	border-bottom-color: <?php echo $theme_color ?>;
	}


	.progress-tooltip:after {
	border-color: <?php echo $theme_color ?> transparent transparent transparent;
	}


	#header .header-link:hover,
	#header .header-link:focus,
	#header .dropdown:hover >.dropdown-toggle,
	#header .open > .dropdown-toggle {
	color:<?php echo $theme_color ?> !important;
	}





	/*for theme color shade 1*/
	.product-box.new-box{
	background-color : <?php echo $theme_shade_1; ?>;
	}

	/*for theme color shade 2*/
	.mango_newsletter_popup form input[type="submit"],
	.progress-bar-custom2,
	.progress-bar-custom2 .progress-tooltip,
	#newsletter-section form  p input[type="submit"]:hover{
		background-color : <?php echo $theme_shade_2; ?>;
	}

	#footer .widget .contact-list li a,
	a:active,
	a:hover,
	a:focus,
	#footer .widget .contact-list li a,
	#header-top.custom .dropdown .dropdown-toggle .fa-caret-down{
		color : <?php echo $theme_shade_2; ?>;
	}
	.progress-bar-custom2 .progress-tooltip:after {
		border-top-color: <?php echo $theme_shade_2; ?>;
	}

	#newsletter-section form  p input[type="submit"]:hover{
		border-color : <?php echo $theme_shade_2; ?>;
	}

	/*for theme color shade 3*/

	.pagination > .active > a,
	.pagination > .active > span,
	.pagination > .active > a:hover,
	.pagination > .active > span:hover,
	.pagination > .active > a:focus,
	.pagination > .active > span:focus,
	.tip.tip-hot,
	#portfolio-filter li:hover > a,
	#portfolio-filter li.active > a{
	background-color : <?php echo $theme_shade_3; ?>;
	}

	.pagination > .active > a,
	.pagination > .active > span,
	.pagination > .active > a:hover,
	.pagination > .active > span:hover,
	.pagination > .active > a:focus,
	.pagination > .active > span:focus{
		border-color : <?php echo $theme_shade_3; ?>;
	}

	.tip.tip-hot:after{
		border-top-color : <?php echo $theme_shade_3; ?>;
	}

	#portfolio-filter li:hover > a,
	#portfolio-filter li.active > a{
		border-color : <?php echo $theme_shade_3; ?>;
	}

	/*for theme color shade 4*/

	.about-company h4 i{
		color : <?php echo $theme_shade_4; ?>;
	}

	.entry-date > span{
		background-color : <?php echo $theme_shade_4; ?>;
	}


	/*for theme color shade 5*/

	.dropcap-bg.second-color,
	#header.header10,
	#header .header-box-icon:hover,
	.highlight.second-color,
	#header-top.custom{
	background-color : <?php echo $theme_shade_5 ?>;
	}

	.dropcap.second-color,
	.banner-long .banner-price,
	.discount-box-value,
	.second-color,
	.portfolio-tags a:hover,
	.portfolio-tags a:focus,
	.portfolio-comment-link{
	color : <?php echo $theme_shade_5 ?>;
	}

	/*for theme color shade 6*/

	.btn-custom5{
	background-color : <?php echo $theme_shade_6  ?>;
	}

	.btn-custom5{
	border-color: <?php echo $theme_shade_6  ?>;
	}

	.cart-dropdown .dropdown-total{
	color : <?php echo $theme_shade_6  ?>;
	}

	/*for theme color shade 7*/

	#header.header10 .dropdown-toggle,
	#header.header10 .header-link,
	#header.header10 .nav-text,
	.header10 .dropdown .dropdown-toggle .fa-caret-down,
	#header.header10 #header-top label,
	.header10 #header-top .social-icon,
	.header10 .cart-dropdown .dropdown-toggle > i,
	.header10 .header-box-content p,
	#header.header10 .menu > li > a > i,
	#menu-display-btn:hover,
	#header.header11 .menu > li > a > i,
	#menu-container.custom .menu > li > a > i,
	.banner-info.custom p,
	#header #header-top.custom .header-link:hover,
	#header #header-top.custom .header-link:focus,
	#header #header-top.custom .dropdown:hover >.dropdown-toggle,
	#header #header-top.custom .open > .dropdown-toggle,
	#header #header-top.custom .nav-text .header-text,
	#header #header-top.custom .nav-text i,
	#header #header-top.custom .cart-dropdown .dropdown-toggle,
	#header.header10 #menu-container .search-dropdown.open > .dropdown-toggle,
	#header.header10 #menu-container .search-dropdown:hover > .dropdown-toggle{
	color : <?php echo $theme_shade_7 ?>;
	}

	#header.header11 #menu-container .nav-left{
	border-right-color : <?php echo $theme_shade_7 ?>;
	}

	#menu-display-btn{
	border-left-color : <?php echo $theme_shade_7 ?>;
	}

	#header.header10 #menu-container .search-dropdown.open > .dropdown-toggle,
	#header.header10 #menu-container .search-dropdown:hover > .dropdown-toggle {
	color:  <?php echo $theme_shade_7 ?> !important;
	}
	code{
	background-color : <?php echo $theme_shade_7 ?>;
	}



<?php }

if($s['mango_site_alternate_color'] && $s['mango_site_alternate_color'] != '#000000' ){
	$theme_alternate_color= $s['mango_site_alternate_color'];
	$theme_alternate_shade_1= mango_generate_theme_alter_color_shades($theme_alternate_color,1);
	$theme_alternate_shade_2= mango_generate_theme_alter_color_shades($theme_alternate_color,2);
	$theme_alternate_shade_3= mango_generate_theme_alter_color_shades($theme_alternate_color,3);
	$theme_alternate_shade_4= mango_generate_theme_alter_color_shades($theme_alternate_color,4);
	$theme_alternate_shade_5= mango_generate_theme_alter_color_shades($theme_alternate_color,5);
	$theme_alternate_shade_6= mango_generate_theme_alter_color_shades($theme_alternate_color,6);
	$theme_alternate_shade_7= mango_generate_theme_alter_color_shades($theme_alternate_color,7); ?>


	.checkout h3,
	.nav-text-big,
	.cart-text-price,
	.megamenu .megamenu-footer,
	#side-menu-footer .copyright a:hover,
	.side-menu2 #side-menu-footer .social-icon:hover,
	.side-menu2 #side-menu-footer .copyright a,
	ul.yith-wcan-label.yith-wcan.yith-wcan-group li a:hover,
	ul.yith-wcan-label.yith-wcan.yith-wcan-group li.chosen a{
	color : <?php echo $theme_alternate_color; ?>;
	}

	.owl-carousel .owl-video-wrapper,
	.price_slider_wrapper .button{
	background-color : <?php echo $theme_alternate_color; ?>;
	}

	.side-menu.dark,
	ul.yith-wcan-label.yith-wcan.yith-wcan-group li.chosen a,
	.price_slider_wrapper .button{
	border-color  :<?php echo $theme_alternate_color; ?>;
	}
	.portfolio-custom .portfolio-meta {
	background: -moz-linear-gradient(top, <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0) ?> 12%, <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.17) ?> 58%, <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.34) ?> 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(12%,<?php echo mango_generate_alternate_color_levels($theme_alternate_color,0) ?>), color-stop(58%,<?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.17) ?>), color-stop(100%,<?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.4) ?>));
	background: -webkit-linear-gradient(top,  <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0) ?> 12%,<?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.17) ?> 58%,<?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.4) ?> 100%);
	background: -o-linear-gradient(top,  <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0) ?> 12%,<?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.17) ?> 58%,<?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.4) ?> 100%);
	background: -ms-linear-gradient(top,  <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0) ?> 12%,<?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.17) ?> 58%,<?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.4) ?> 100%);
	background: linear-gradient(to bottom,  <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0) ?> 12%,<?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.17) ?> 58%,<?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.4) ?> 100%);
	}

	.menu ul,
	.menu .megamenu {
	box-shadow:0 2px 7px <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.1) ?>;
	-webkit-box-shadow:0 2px 7px <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.1) ?>;
	}

	.mobile-menu li a:hover,
	#mobile-menu .social-icon:hover,
	.portfolio-btn{
	background-color : <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.2) ?>;
	}

	#mobile-menu-overlay{
	background-color : <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.4) ?>;
	}

	.portfolio-meta{
	background-color : <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.5) ?>;
	}

	.owl-carousel.product-slider .owl-prev:hover,
	.owl-carousel.product-slider .owl-next:hover{
	background-color : <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.05) ?>;
	}

	.portfolio-btn:hover,
	.portfolio-btn:focus{
	background-color : <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.6) ?>;
	}
	.gallery .gallery-caption{
	background-color : <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.7) ?>;
	}

	.dropdown-menu {
	-webkit-box-shadow: 0 4px 9px <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.15) ?>;
	box-shadow: 0 4px 9px <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.15) ?>;
	}

	.sticky-menu.fixed,
	#header.sticky-menu.fixed,
	#header.header-absolute.sticky-menu.fixed,
	#header.header13 #header-top.sticky-menu.fixed {
	box-shadow:0 3px 10px <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.22) ?>;
	-webkit-box-shadow:0 3px 10px <?php echo mango_generate_alternate_color_levels($theme_alternate_color,0.22) ?>;
	}

	/*alter shade 1*/

	.dropcap,
	.dropcap-bg,
	.btn.btn-border.btn-custom2,
	.nav-tabs > li > a,
	.nav-pills > li > a,
	.panel-heading a,
	.panel-default > .panel-heading,
	.banner-info:hover h4,
	.banner-info:hover p,
	.banner.banner-box .banner-content h2,
	.banner.banner-box .banner-content  a:hover,
	.banner.banner-box .banner-content  a:focus,
	.filter-row .btn:hover,
	.filter-row .btn:focus,
	.filter-row .btn.active,
	.about-text h2,
	.about-text .continue-reading:hover,
	.about-text .continue-reading:focus,
	.about-company h3,
	.about-section h3,
	.entry-tags > span,
	.comments-list .media-heading,
	.address-box h3,
	.list-btn.list-btn-wishlist,
	.product-details .product-tags > span,
	.widget-banner h5 a:hover,
	#footer.footer-minimal .copyright a:hover,
	#footer.footer-minimal .copyright a:focus,
	.owl-prev:hover,
	.owl-next:hover,
	.nav-animate .owl-prev:hover,
	.nav-animate .owl-next:hover,
	#coming-soon #coming-soon-wrapper h2,
	#coming-soon #coming-soon-wrapper .countdown-amount,
	#coming-soon  footer a:hover,
	.mfp-close-btn-in .newsletter-popup .mfp-close,
	.product-details .product-price,
	.product-details .product-price-container ins>.amount,
	.product-details .product-price-container .price>.amount{
		color : <?php echo $theme_alternate_shade_1; ?>;
	}


	.dropcap-bg,
	.btn-custom:hover,
	.btn-custom:focus,
	.btn-custom.focus,
	.btn-custom:active,
	.btn-custom.active,
	.open > .dropdown-toggle.btn-custom,
	.btn-custom2,
	.btn-custom3:hover,
	.btn-custom3:focus,
	.btn-custom3.focus,
	.btn-custom3:active,
	.btn-custom3.active,
	.open > .dropdown-toggle.btn-custom3,
	.btn-custom5:hover,
	.btn-custom5:focus,
	.btn-custom5.focus,
	.btn-custom5:active,
	.btn-custom5.active,
	.open > .dropdown-toggle.btn-custom5,
	.btn.btn-border.btn-custom2:hover,
	.btn.btn-border.btn-custom2:focus,
	.progress-bar-dark,
	.progress-bar-dark .progress-tooltip,
	#mobile-menu,
	#header #header-top.dark .cart-dropdown .dropdown-toggle,
	#header #header-top.custom .cart-dropdown:hover .dropdown-toggle,
	#header #header-top.custom .cart-dropdown .dropdown-toggle:hover,
	#header #header-top.custom .cart-dropdown.open > .dropdown-toggle,
	#header-top.custom .cart-dropdown .dropdown-toggle:hover > i,
	#header-top.custom .cart-dropdown:hover .dropdown-toggle > i,
	#header-top.custom .cart-dropdown.open .dropdown-toggle > i,
	#header.header-absolute.sticky-menu.fixed,
	.highlight.reverse,
	.list-btn.list-btn-add,
	#footer.footer-minimal.dark,
	#coming-soon .btn.btn-custom:hover,
	#coming-soon .btn.btn-custom:focus,
	.mango_newsletter_popup form input[type="submit"]:hover,
	header#header.mango_header17.no_banner_bg,
	header#header.mango_header9.no_banner_bg{
		background-color : <?php echo $theme_alternate_shade_1; ?>;
	}


	.btn-custom:hover,
	.btn-custom:focus,
	.btn-custom.focus,
	.btn-custom:active,
	.btn-custom.active,
	.open > .dropdown-toggle.btn-custom,
	.btn-custom2,
	.btn-custom3:hover,
	.btn-custom3:focus,
	.btn-custom3.focus,
	.btn-custom3:active,
	.btn-custom3.active,
	.open > .dropdown-toggle.btn-custom3,
	.btn-custom5:hover,
	.btn-custom5:focus,
	.btn-custom5.focus,
	.btn-custom5:active,
	.btn-custom5.active,
	.open > .dropdown-toggle.btn-custom5,
	.btn.btn-border.btn-custom2:hover,
	.btn.btn-border.btn-custom2:focus,
	.banner-info:hover  .banner-info-wrapper,
	.filter-row .btn:hover,
	.filter-row .btn:focus,
	.filter-row .btn.active,
	.filter-size-box.active,
	.filter-size-box:hover,
	.filter-size-box:focus,
	.checkout .helper-link:hover,
	.checkout .helper-link:focus,
	#coming-soon .btn.btn-custom:hover,
	#coming-soon .btn.btn-custom:focus,
	.mango_newsletter_popup form input[type="submit"]:hover{
		border-color : <?php echo $theme_alternate_shade_1; ?>;
	}

	.panel-icon {
		color:<?php echo $theme_alternate_shade_1; ?> !important;
	}

	/*alter shade 2*/

	#header-top.dark,
	.btn-dark:hover,
	.btn-dark:focus,
	.btn-dark.focus,
	.btn-dark:active,
	.btn-dark.active,
	.open > .dropdown-toggle.btn-dark{
		background-color : <?php echo $theme_alternate_shade_2; ?>;
	}

	.btn-dark:hover,
	.btn-dark:focus,
	.btn-dark.focus,
	.btn-dark:active,
	.btn-dark.active,
	.open > .dropdown-toggle.btn-dark{
		border-color : <?php echo $theme_alternate_shade_2; ?>;
	}



	/*alter shade 3*/

	h1,.h1,
	h2,.h2,
	h3,.h3,
	h4,.h4,
	h5,.h5,
	h6,.h6,
	.btn.btn-border.btn-default,
	.nav-lava > li.active > a,
	.nav-lava > li > a:hover,
	.nav-lava > li > a:focus,
	.close:hover,
	.close:focus,
	.alert-success,
	.alert-success .alert-link,
	.alert-info,
	.alert-info .alert-link,
	.alert-warning,
	.alert-warning .alert-link,
	.alert-danger,
	.alert-danger .alert-link,
	.confirm-box h4 > a ,
	.dropdown-menu > li > a,
	.header1 .header-search-container .form-control,
	.header .header-search-container .form-control::-moz-placeholder,
	.header .header-search-container .form-control:-ms-input-placeholder,
	.header .header-search-container .form-control::-webkit-input-placeholder,
	.header .header-search-container .form-control::placeholder,
	.header1 .header-search-container .input-group-addon:before,
	.header1 .header-search-container .btn ,
	.cart-dropdown .dropdown-menu,
	#header.header13 .department-dropdown .dropdown-menu li a,
	.menu li li a,
	.megamenu-title,
	.menu .megamenu-list li a,
	.widget-category-menu ul li a ,
	.testimonials-slider blockquote cite  > span,
	.informations-widget a,
	.producents-widget .more-link:hover,
	.producents-widget .more-link:focus,
	.banner-category-list li > a,
	.discount-title,
	.company-info a,
	.banner.banner-vine h2,
	.presentation-content footer,
	.presentation-content footer a,
	.category-list li a,
	#newsletter-section .form-control,
	.cart-table .price-col,
	.cart-table .price-total-col,
	.cart-product-list .product-action .btn.btn-custom2,
	.about-section .about-text p:first-child,
	.entry-title,
	.entry-title a,
	.entry-readmore,
	.entry-date,
	.product-title a,
	.product-btn,
	.product-cats a:hover,
	.product-cats a:focus,
	.portfolio-comment-link:hover,
	.portfolio-comment-link:focus,
	.portfolio-details-list li span,
	#footer.footer-minimal2 .widget a,
	#footer.footer-minimal3 .widget a,
	#footer.footer-minimal4 .widget a,
	.footer-minimal2 .widget .widget-title ,
	.footer-minimal3 .widget .widget-title,
	.footer-minimal4 .widget .widget-title,
	.footer-dark #footer-bottom,
	.error-content p > a:hover,
	.error-content p > a:focus,
	#scroll-top.mini:hover,
	#scroll-top.mini:hover,
	.widget_product_categories ul li a,
	#newsletter-section form  p input[type="text"],
	label.control-label,
	label.input-desc,
	.input-group-addon,
	.checkout .radio *,
	.checkout .checkbox *,
	.cart-product-list label,
	.compare-table.table > tbody > tr > td.table-title,
	.product-details .product-ratings .star,
	#coming-soon .input-desc,
	.newsletter-popup-content p label,
	#header.header13 .department-dropdown .dropdown-toggle,
	#header.header13 .cart-dropdown .dropdown-toggle i,
	.banner.banner-box h3,
	#mobile-menu-btn,
	.btn.btn-border.btn-white.dark,
	a.list-group-item .list-group-item-heading,
	.portfolio-title a,
	label.control-label,
	label.input-desc,
	.input-group-addon,
	.checkout .radio *,
	.checkout .checkbox *,
	.cart-product-list label,
	.compare-table.table > tbody > tr > td.table-title,
	.product-details .product-ratings .star,
	#coming-soon .input-desc,
	.newsletter-popup-content p label,
	.btn-custom4,
	.custom-checkbox-container .custom-checkbox-icon,
	#category-widget a,
	#category-widget > li > a,
	.filter-brands .checkbox label,
	.sidebar.checkout-sidebar .widget .widget-title,
	.title-border-tb,
	.cart2-total-container p,
	.cart2-subtotal,
	.sidebar .widget .links li a,
	aside>.page-sidebar ul li,
	aside>.page-sidebar ul li a,
	.btn-custom3,
	.cart-dropdown .dropdown-total > span,
	.filter-row-label,
	.checkout-widget ul li,
	.cart-table thead > tr > th,
	.wishlist-table thead > tr > th,
	.shop-continue-box .grandtotal-row,
	.side-menu-widget ul li a,
	.sidebar .widget .widget-title,
	.footer-dark #footer-top .widget .widget-title,
	.widget .widget-title,
	.error-title,
	.widget-title{
		color : <?php echo $theme_alternate_shade_3; ?>;
	}



	.nav-tabs > li > a:hover,
	.nav-tabs > li > a:focus,
	.nav-pills > li > a:hover,
	.nav-pills > li > a:focus
	.tip:after,
	.tip .tip-arrow,
	.tip .tip-arrow,
	.btn-dark{
		border-color : <?php echo $theme_alternate_shade_3; ?>;
	}



	.banner-info.dark,
	#footer.footer-dark,
	.btn-dark,
	.nav-tabs > li > a:hover,
	.nav-tabs > li > a:focus,
	.nav-pills > li > a:hover,
	.nav-pills > li > a:focus,
	.header7 #header-top.dark,
	.tip,#menu-container.dark,
	.side-menu.dark,
	.side-menu.dark #side-menu-footer,
	#scroll-top,
	#scroll-top:hover{
		background-color : <?php echo $theme_alternate_shade_3; ?>;
	}


	#scroll-top:hover{
		box-shadow:0 0 0 2px <?php echo $theme_alternate_shade_3; ?>;
		-webkit-box-shadow:0 0 0 2px <?php echo $theme_alternate_shade_3; ?>;
	}

	/*alter shade 4*/

	#header.header7 #header-top.dark .cart-dropdown .dropdown-toggle,
	.mobile-menu ul,
	.page-header.dark,
	#header.header8 .custom .header-box-icon{
		background-color : <?php echo $theme_alternate_shade_4; ?>;
	}

	.product-mini .product-price,
	.widget .hours-list li > span,
	#footer.footer-minimal .footer-menu li a,
	.newsletter-popup h2,
	.newsletter-popup p > span,
	#header-top .social-icon:hover,
	#menu-container .menu > li.active > a,
	#menu-container .menu > li > a,
	.menu > li.active > a,
	.menu > li > a,
	.side-menu .menu > li > a,
	.side-menu .smenu li a,
	.side-menu .smenu li.open > a,
	.side-menu .smenu li.active > a,
	.regular-title,
	.product-details .product-title,
	.widget-category-menu.category-menu-parted  h3,
	#header.header12 #header-inner .nav-text > span,
	.header-box-content h6{
		color : <?php echo $theme_alternate_shade_4; ?>;
	}

	/*alter shade 5*/

	.mobile-menu ul ul,
	.banner-info.banner-info-icon:hover{
		background-color : <?php echo $theme_alternate_shade_5; ?>;
	}

	.filter-size-box,
	.filter-size-box.active,
	.filter-size-box:hover,
	.filter-size-box:focus,
	.filter-slider-action .filter-slider-value,
	#footer.footer-minimal.dark .footer-menu li:after,
	#footer .widget .contact-list li a:hover,
	#footer .widget .contact-list li a:focus,
	#footer .copyright a:hover,
	#footer .copyright a:focus,
	#footer .footer-menu li a,
	.bootstrap-touchspin .input-group-btn-vertical > .btn{
		color : <?php echo $theme_alternate_shade_5; ?>;
	}

	/*alter shade 6*/

	.banner.banner-long .banner-content h3,
	.megamenu .menu-quick-tags a{
		color : <?php echo $theme_alternate_shade_5; ?>;
	}

<?php }
/*todo:tahir code end here*/


/*Menu Customization*/
if( $s['mango_customize_menu'] ) {
	/*************************** header 1 and header 2 background color ****************************/
	if ( !empty( $s[ 'header_background_one_two' ] ) ) { ?>
		.header1 div#menu-container{
		background-color:<?php echo $s[ 'header_background_one_two' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_background_one_two' ] ) ) {
		?>
		.header2 div#menu-container{
		background-color:<?php echo $s[ 'header_background_one_two' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_one_two' ] ) ) { ?>
		.header1 #menu-container.dark .menu > li.active > a,
		.header1 #menu-container.dark .menu > li > a,
		.header1 #menu-container.custom .menu > li.active > a,
		.header1 #menu-container.custom .menu > li > a {
		color: <?php echo $s[ 'header_font_one_two' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_one_two' ] ) ) { ?>
		.header2 #menu-container.dark .menu > li.active > a,
		.header2 #menu-container.dark .menu > li > a,
		.header2 #menu-container.custom .menu > li.active > a,
		.header2 #menu-container.custom .menu > li > a {
		color: <?php echo $s[ 'header_font_one_two' ]; ?>;
		}
	<?php } ?>

	/**************** header 1 and header 2 hover link color ***********/

	<?php
	if ( !empty( $s[ 'hover_font_color_h_1_2' ] ) ) {
		?>
		.header1 #menu-container.dark .menu > li.active > a:hover,
		.header1 #menu-container.dark .menu > li > a:hover,
		.header1 #menu-container.custom .menu > li.active > a:hover,
		.header1 #menu-container.custom .menu > li > a:hover {
		color: <?php echo $s[ 'hover_font_color_h_1_2' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_color_h_1_2' ] ) ) {
		?>
		.header2 #menu-container.dark .menu > li.active > a:hover,
		.header2 #menu-container.dark .menu > li > a:hover,
		.header2 #menu-container.custom .menu > li.active > a:hover,
		.header2 #menu-container.custom .menu > li > a:hover {
		color: <?php echo $s[ 'hover_font_color_h_1_2' ]; ?>;
		}
	<?php } ?>
	<?php
	if ( !empty( $s[ 'header_background_chil_one_two' ] ) ) { ?>
		.header1 nav.menu-main-menu-container  ul.sub-menu{
		background-color: <?php echo $s[ 'header_background_chil_one_two' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_background_chil_one_two' ] ) ) {
		?>
		.header2 nav.menu-main-menu-container  ul.sub-menu{
		background-color: <?php echo $s[ 'header_background_chil_one_two' ]; ?>;
		}
	<?php } ?>
	<?php
	if ( !empty( $s[ 'header_font_chil_one_two' ] ) ) { ?>
		.header1 nav.menu-main-menu-container ul.sub-menu li a{
		color:<?php echo $s[ 'header_font_chil_one_two' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_chil_one_two' ] ) ) { ?>
		.header2 nav.menu-main-menu-container ul.sub-menu li a{
		color:<?php echo $s[ 'header_font_chil_one_two' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_1_2' ] ) ) {
		?>
		.header1 nav.menu-main-menu-container ul.sub-menu li a:hover{
		color:<?php echo $s[ 'hover_font_submenu_color_h_1_2' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_1_2' ] ) ) {
		?>
		.header2 nav.menu-main-menu-container ul.sub-menu li a:hover{
		color:<?php echo $s[ 'hover_font_submenu_color_h_1_2' ]; ?>;
		}
	<?php } ?>

	/* Header 3 menu settings*/
	<?php
	if ( !empty( $s[ 'header_background_three' ] ) ) { ?>
		.header3 div#menu-container{
		background-color:<?php echo $s[ 'header_background_three' ]; ?>;
		}
	<?php } ?>

	/*Header 3 font color */

	<?php
	if ( !empty( $s[ 'header_font_three' ] ) ) { ?>
		.header3 #menu-container .menu > li.active > a,
		.header3 #menu-container .menu > li > a,
		.header3 .menu > li.active > a,
		.header3 .menu > li > a {
		color: <?php echo $s[ 'header_font_three' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_color_h_3' ] ) ) { ?>
		.header3 #menu-container .menu > li.active > a:hover,
		.header3 #menu-container .menu > li > a:hover,
		.header3 .menu > li.active > a:hover,
		.header3 .menu > li > a:hover {
		color: <?php echo $s[ 'hover_font_color_h_3' ]; ?>;
		}
	<?php } ?>
	<?php
	if ( !empty( $s[ 'header_background_chil_three' ] ) ) { ?>
		.header3 nav.menu-main-menu-container  ul.sub-menu{
		background-color: <?php echo $s[ 'header_background_chil_three' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_chil_three' ] ) ) {
		?>
		.header3 nav.menu-main-menu-container ul.sub-menu li a{
		color:<?php echo $s[ 'header_font_chil_three' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_3' ] ) ) {
		?>
		.header3 nav.menu-main-menu-container ul.sub-menu li a:hover{
		color:<?php echo $s[ 'hover_font_submenu_color_h_3' ]; ?>;
		}

	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_color_h_3' ] ) ) {
		?>
		.header3 #menu-container .menu > li.active > a:hover,
		.header3 #menu-container .menu > li > a:hover,
		.header3 .menu > li.active > a:hover,
		.header3 .menu > li > a:hover {
		color: <?php echo $s[ 'hover_font_color_h_3' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_background_chil_three' ] ) ) {
		?>
		.header3 nav.menu-main-menu-container  ul.sub-menu{
		background-color: <?php echo $s[ 'header_background_chil_three' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_chil_three' ] ) ) {
		?>
		.header3 nav.menu-main-menu-container ul.sub-menu li a{
		color:<?php echo $s[ 'header_font_chil_three' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_3' ] ) ) {
		?>
		.header3 nav.menu-main-menu-container ul.sub-menu li a:hover{
		color:<?php echo $s[ 'hover_font_submenu_color_h_3' ]; ?>;
		}

	<?php } ?>

	/* Header 4 menu settings */
	<?php
	if ( !empty( $s[ 'header_background_four' ] ) ) { ?>
		.header4 div#menu-container{
		background-color:<?php echo $s[ 'header_background_four' ]; ?>;
		}
	<?php } ?>

	/*Header 4 font color */

	<?php
	if ( !empty( $s[ 'header_font_four' ] ) ) { ?>
		.header4 #menu-container .menu > li.active > a,
		.header4 #menu-container .menu > li > a,
		.header4 .menu > li.active > a,
		.header4 .menu > li > a {
		color: <?php echo $s[ 'header_font_four' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_color_h_4' ] ) ) { ?>
		.header4 #menu-container .menu > li.active > a:hover,
		.header4 #menu-container .menu > li > a:hover,
		.header4 .menu > li.active > a:hover,
		.header4 .menu > li > a:hover {
		color: <?php echo $s[ 'hover_font_color_h_4' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_background_chil_four' ] ) ) { ?>
		.header4 nav.menu-main-menu-container  ul.sub-menu{
		background-color: <?php echo $s[ 'header_background_chil_four' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_chil_four' ] ) ) { ?>
		.header4 nav.menu-main-menu-container ul.sub-menu li a{
		color:<?php echo $s[ 'header_font_chil_four' ]; ?>;
		}
	<?php } ?>


	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_4' ] ) ) { ?>
		.header4 nav.menu-main-menu-container ul.sub-menu li a:hover{
		color:<?php echo $s[ 'hover_font_submenu_color_h_4' ]; ?>;
		}
	<?php } ?>


	/* Header 5  and 6 menu settings */

	<?php
	if ( !empty( $s[ 'header_background_five_six' ] ) ) { ?>
		.header5 div#menu-container{
		background-color:<?php echo $s[ 'header_background_five_six' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_background_five_six' ] ) ) { ?>
		.header6 div#menu-container{
		background-color:<?php echo $s[ 'header_background_five_six' ]; ?>;
		}
	<?php } ?>
	/*Header 5 and 6 font color */


	<?php
	if ( !empty( $s[ 'header_font_five_six' ] ) ) { ?>
		.header5 #menu-container .menu > li.active > a,
		.header5 #menu-container .menu > li > a,
		.header5 .menu > li.active > a,
		.header5 .menu > li > a {
		color: <?php echo $s[ 'header_font_five_six' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_color_h_5_6' ] ) ) { ?>

		.header5 #menu-container .menu > li.active > a:hover,
		.header5 #menu-container .menu > li > a:hover,
		.header5 .menu > li.active > a:hover,
		.header5 .menu > li > a:hover {
		color: <?php echo $s[ 'hover_font_color_h_5_6' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_background_chil_five_six' ] ) ) { ?>
		.header5 nav.menu-main-menu-container  ul.sub-menu{
		background-color: <?php echo $s[ 'header_background_chil_five_six' ]; ?>;
		}
	<?php } ?>
	<?php
	if ( !empty( $s[ 'header_font_chil_five_six' ] ) ) { ?>
		.header5 nav.menu-main-menu-container ul.sub-menu li a{
		color:<?php echo $s[ 'header_font_chil_five_six' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_5_6' ] ) ) { ?>
		.header5 nav.menu-main-menu-container ul.sub-menu li a:hover{
		color:<?php echo $s[ 'hover_font_submenu_color_h_5_6' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_five_six' ] ) ) { ?>
		.header6 #menu-container .menu > li.active > a,
		.header6 #menu-container .menu > li > a,
		.header6 .menu > li.active > a,
		.header6 .menu > li > a {
		color: <?php echo $s[ 'header_font_five_six' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_color_h_5_6' ] ) ) { ?>
		.header6 #menu-container .menu > li.active > a:hover,
		.header6 #menu-container .menu > li > a:hover,
		.header6 .menu > li.active > a:hover,
		.header6 .menu > li > a:hover {
		color: <?php echo $s[ 'hover_font_color_h_5_6' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_background_chil_five_six' ] ) ) { ?>
		.header6 nav.menu-main-menu-container  ul.sub-menu{
		background-color: <?php echo $s[ 'header_background_chil_five_six' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_chil_five_six' ] ) ) { ?>
		.header6 nav.menu-main-menu-container ul.sub-menu li a{
		color:<?php echo $s[ 'header_font_chil_five_six' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_5_6' ] ) ) { ?>
		.header6 nav.menu-main-menu-container ul.sub-menu li a:hover{
		color:<?php echo $s[ 'hover_font_submenu_color_h_5_6' ]; ?>;
		}
	<?php } ?>

	/* Header 7  and 8 menu settings */
	<?php
	if ( !empty( $s[ 'header_background_7_8' ] ) ) { ?>
		.header7 div#menu-container{
		background-color:<?php echo $s[ 'header_background_7_8' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_background_7_8' ] ) ) { ?>
		.header8 div#menu-container{
		background-color:<?php echo $s[ 'header_background_7_8' ]; ?>;
		}
	<?php } ?>

	/*Header 7 and 8 font color */
	<?php
	if ( !empty( $s[ 'header_font_7_8' ] ) ) { ?>
		.header7 #menu-container .menu > li.active > a,
		.header7 #menu-container .menu > li > a,
		.header7 .menu > li.active > a,
		.header7 .menu > li > a {
		color: <?php echo $s[ 'header_font_7_8' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_color_h_7_8' ] ) ) { ?>
		.header7 #menu-container .menu > li.active > a:hover,
		.header7 #menu-container .menu > li > a:hover,
		.header7 .menu > li.active > a:hover,
		.header7 .menu > li > a:hover {
		color: <?php echo $s[ 'hover_font_color_h_7_8' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_background_chil_7_8' ] ) ) { ?>
		.header7 #menu-container nav.pull-left .menu >li ul.sub-menu {
		background-color: <?php echo $s[ 'header_background_chil_7_8' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_chil_7_8' ] ) ) { ?>
		.header7 #menu-container nav.pull-left .menu >li ul.sub-menu  li a{
		color:<?php echo $s[ 'header_font_chil_7_8' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_7_8' ] ) ) { ?>
		.header7 #menu-container nav.pull-left .menu >li ul.sub-menu li a:hover{
		color:<?php echo $s[ 'hover_font_submenu_color_h_7_8' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_7_8' ] ) ) { ?>
		.header8 #menu-container .menu > li.active > a,
		.header8 #menu-container .menu > li > a,
		.header8 .menu > li.active > a,
		.header8 .menu > li > a {
		color: <?php echo $s[ 'header_font_7_8' ]; ?>;
		}
	<?php } ?>
	<?php
	if ( !empty( $s[ 'hover_font_color_h_7_8' ] ) ) { ?>
		.header8 #menu-container .menu > li.active > a:hover,
		.header8 #menu-container .menu > li > a:hover,
		.header8 .menu > li.active > a:hover,
		.header8 .menu > li > a:hover {
		color: <?php echo $s[ 'hover_font_color_h_7_8' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_background_chil_7_8' ] ) ) { ?>
		.header8 #menu-container nav.pull-left .menu >li ul.sub-menu{
		background-color: <?php echo $s[ 'header_background_chil_7_8' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_chil_7_8' ] ) ) { ?>
		.header8 #menu-container nav.pull-left .menu >li ul.sub-menu  li a{
		color:<?php echo $s[ 'header_font_chil_7_8' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_7_8' ] ) ) { ?>
		.header8 #menu-container nav.pull-left .menu >li ul.sub-menu li a:hover{
		color:<?php echo $s[ 'hover_font_submenu_color_h_7_8' ]; ?>;
		}
	<?php } ?>

	/*header 9 and 10 menu setting*/

	<?php
	if ( !empty( $s[ 'header_font_9' ] ) ) { ?>
		.header-absolute .menu > li.active > a,
		.header-absolute .menu > li > a,
		.header-absolute div#menu-container.dark .menu > li.active > a,
		.header-absolute  div#menu-container.dark .menu > li > a,
		.header-absolute  div#menu-container.custom .menu > li.active > a,
		.header-absolute div#menu-container.custom .menu > li > a {
		color: <?php echo $s[ 'header_font_9' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_color_h_9' ] ) ) { ?>
		.header-absolute .menu > li.active > a:hover,
		.header-absolute .menu > li > a:hover,
		.header-absolute div#menu-container.dark .menu > li.active > a:hover,
		.header-absolute  div#menu-container.dark .menu > li > a:hover,
		.header-absolute  div#menu-container.custom .menu > li.active > a:hover,
		.header-absolute  div#menu-container.custom .menu > li > a:hover {
		color: <?php echo $s[ 'hover_font_color_h_9' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_background_chil_9' ] ) ) { ?>
		.header-absolute .menu > li ul.sub-menu,
		.header-absolute .menu > li ul.sub-menu,
		.header-absolute  div#menu-container.dark .menu li ul.sub-menu,
		.header-absolute  div#menu-container.dark .menu  li ul.sub-menu,
		.header-absolute  div#menu-container.custom .menu  li ul.sub-menu,
		.header-absolute  div#menu-container.custom .menu  li ul.sub-menu {
		background-color: <?php echo $s[ 'header_background_chil_9' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_chil_9' ] ) ) { ?>
		.header-absolute .menu > li ul.sub-menu li a,
		.header-absolute .menu > li ul.sub-menu li a,
		.header-absolute  div#menu-container.dark .menu li ul.sub-menu li a,
		.header-absolute  div#menu-container.dark .menu  li ul.sub-menu li a,
		.header-absolute  div#menu-container.custom .menu  li ul.sub-menu li a,
		.header-absolute  div#menu-container.custom .menu  li ul.sub-menu li a {
		color: <?php echo $s[ 'header_font_chil_9' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_9' ] ) ) { ?>
		.header-absolute .menu > li ul.sub-menu li a:hover,
		.header-absolute .menu > li ul.sub-menu li a:hover,
		.header-absolute  div#menu-container.dark .menu li ul.sub-menu li a:hover,
		.header-absolute  div#menu-container.dark .menu  li ul.sub-menu li a:hover,
		.header-absolute  div#menu-container.custom .menu  li ul.sub-menu li a:hover,
		.header-absolute div#menu-container.custom .menu  li ul.sub-menu li a:hover {
		color: <?php echo $s[ 'hover_font_submenu_color_h_9' ]; ?>;
		}
	<?php } ?>

	/* Header 11 settings*/

	<?php
	if ( !empty( $s[ 'header_background_11' ] ) ) { ?>
		#header.header10 #menu-container{
		background-color:<?php echo $s[ 'header_background_11' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_11' ] ) ) { ?>
		#header.header10 .menu > li.active > a, #header.header10 .menu > li > a  {
		color:<?php echo $s[ 'header_font_11' ]; ?> ;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_color_h_11' ] ) ) { ?>
		#header.header10 .menu > li.active > a:hover, #header.header10 .menu > li > a:hover  {
		color:<?php echo $s[ 'hover_font_color_h_11' ]; ?> ;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_background_chil_11' ] ) ) { ?>
		#header.header10 .menu > li  ul.sub-menu  {
		background-color:<?php echo $s[ 'header_background_chil_11' ]; ?> ;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_chil_11' ] ) ) { ?>
		#header.header10 .menu > li  ul.sub-menu  {
		color:<?php echo $s[ 'header_font_chil_11' ]; ?> ;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_11' ] ) ) { ?>
		#header.header10 .menu > li  ul.sub-menu li a:hover {
		color: <?php echo $s[ 'hover_font_submenu_color_h_11' ]; ?> ;
		}
	<?php } ?>
	/*css for header 12,18,20*/

	<?php
	if ( !empty( $s[ 'header_font_12_18_20' ] ) ) { ?>
		.side-menu .menu > li > a, .side-menu .smenu > li > a{
		color:<?php echo $s[ 'header_font_12_18_20' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_color_h_12_18_20' ] ) ) { ?>
		.side-menu .menu > li > a, .side-menu .smenu > li > a:hover{
		color:<?php echo $s[ 'hover_font_color_h_12_18_20' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_chil_12_18_20' ] ) ) { ?>
		.side-menu .smenu li li a {
		color:<?php echo $s[ 'header_font_chil_12_18_20' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_12_18_20' ] ) ) { ?>
		.side-menu .smenu li li a:hover {
		color:<?php echo $s[ 'hover_font_submenu_color_h_12_18_20' ]; ?>;
		}
	<?php } ?>

	/* Header 13 Menu Setting*/
	<?php
	if ( !empty( $s[ 'header_background_13' ] ) ) { ?>
		#header.header11 #menu-container .container{
		background-color:<?php echo $s[ 'header_background_13' ]; ?>;    }
	<?php } ?>
	<?php
	if ( !empty( $s[ 'header_font_13' ] ) ) { ?>
		.menu-cat-top-title, #menu-display-btn{
		color:<?php echo $s[ 'header_font_13' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_13' ] ) ) { ?>
		#header.header11 .menu > li.active > a, #header.header11 .menu > li > a{
		color:<?php echo $s[ 'header_font_13' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_color_h_13' ] ) ) { ?>
		#header.header11 .menu > li.active > a:hover, #header.header11 .menu > li > a:hover{
		color:<?php echo $s[ 'hover_font_color_h_13' ]; ?>;
		}
	<?php } ?>
	<?php
	if ( !empty( $s[ 'header_background_chil_13' ] ) ) { ?>
		#header.header11 .menu > li  ul.sub-menu{
		background-color:<?php echo $s[ 'header_background_chil_13' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'header_font_chil_13' ] ) ) { ?>
		#header.header11 .menu > li  ul.sub-menu li a{
		color:<?php echo $s[ 'header_font_chil_13' ]; ?>;
		}
	<?php } ?>

	<?php
	if ( !empty( $s[ 'hover_font_submenu_color_h_13' ] ) ) { ?>
		#header.header11 .menu > li  ul.sub-menu li a:hover{
		color:<?php echo $s[ 'hover_font_submenu_color_h_13' ]; ?>;
		}
	<?php } ?>

	/*header 14 menu setting*/

	<?php if ( !empty( $s[ 'header_background_14' ] ) ) { ?>
		#header.header13  #header-top .nav-right{
		background-color:<?php echo $s[ 'header_background_14' ]; ?>;

		}
	<?php } ?>
	<?php if ( !empty( $s[ 'header_font_14' ] ) ) { ?>
		#header.header13 #header-top .menu > li > a{
		color:<?php echo $s[ 'header_font_14' ]; ?>;
		}
	<?php } ?>


	<?php if ( !empty( $s[ 'hover_font_color_h_14' ] ) ) { ?>
		#header.header13 #header-top .menu > li > a:hover{
		color:<?php echo $s[ 'hover_font_color_h_14' ]; ?>;
		}
	<?php } ?>
	<?php if ( !empty( $s[ 'header_background_chil_14' ] ) ) { ?>
		#header.header13 #header-top .menu > li ul.sub-menu{
		background-color:<?php echo $s[ 'header_background_chil_14' ]; ?>;
		}
	<?php } ?>

	<?php if ( !empty( $s[ 'header_font_chil_14' ] ) ) { ?>
		#header.header13 #header-top .menu > li ul.sub-menu li a{
		color:<?php echo $s[ 'header_font_chil_14' ]; ?>;
		}
	<?php } ?>

	<?php if ( !empty( $s[ 'hover_font_submenu_color_h_14' ] ) ) { ?>
		#header.header13 #header-top .menu > li ul.sub-menu li a:hover{
		color:<?php echo $s[ 'hover_font_submenu_color_h_14' ]; ?>;
		}
	<?php } ?>


	/*Header 16 Menu Settings*/
	<?php if ( !empty( $s[ 'header_background_16' ] ) ) { ?>
		#header.header12 nav{
		background-color:<?php echo $s[ 'header_background_16' ]; ?>;

		}
	<?php } ?>


	<?php if ( !empty( $s[ 'header_font_16' ] ) ) { ?>
		.header12 #menu-container .menu > li.active > a,
		.header12 #menu-container .menu > li > a,
		.header12 .menu > li.active > a,
		.header12 .menu > li > a{

		color:<?php echo $s[ 'header_font_16' ]; ?>;
		}
	<?php } ?>

	<?php if ( !empty( $s[ 'hover_font_color_h_16' ] ) ) { ?>
		.header12 #menu-container .menu > li.active > a:hover,
		.header12 #menu-container .menu > li > a:hover,
		.header12 .menu > li.active > a:hover,
		.header12 .menu > li > a:hover{

		color:<?php echo $s[ 'hover_font_color_h_16' ]; ?>;
		}
	<?php } ?>


	<?php if ( !empty( $s[ 'header_background_chil_16' ] ) ) { ?>
		.header12 #menu-container .menu > li  ul.sub-menu,
		.header12 #menu-container .menu > li ul.sub-menu,
		.header12 .menu > li ul.sub-menu,
		.header12 .menu > li ul.sub-menu{

		background-color:<?php echo $s[ 'header_background_chil_16' ]; ?>;
		}
	<?php } ?>


	<?php if ( !empty( $s[ 'header_font_chil_16' ] ) ) { ?>
		.header12 #menu-container .menu > li  ul.sub-menu li a,
		.header12 #menu-container .menu > li ul.sub-menu li a,
		.header12 .menu > li ul.sub-menu li a,
		.header12 .menu > li ul.sub-menu li a{

		color:<?php echo $s[ 'header_font_chil_16' ]; ?>;
		}
	<?php } ?>


	<?php if ( !empty( $s[ 'hover_font_submenu_color_h_16' ] ) ) { ?>
		.header12 #menu-container .menu > li  ul.sub-menu li a:hover,
		.header12 #menu-container .menu > li ul.sub-menu li a:hover,
		.header12 .menu > li ul.sub-menu li a:hover,
		.header12 .menu > li ul.sub-menu li a:hover{

		color:<?php echo $s[ 'hover_font_submenu_color_h_16' ]; ?>;
		}
	<?php } ?>

	/*Header menu 19 and 21 settings*/

	<?php if ( !empty( $s[ 'header_font_19_21' ] ) ) { ?>
		.side-menu.dark .smenu li a, .side-menu.dark .menu > li > a{
		color:<?php echo $s[ 'header_font_19_21' ]; ?>;

		}

	<?php } ?>
	<?php if ( !empty( $s[ 'hover_font_color_h_19_21' ] ) ) { ?>
		.side-menu.dark .smenu li a:hover,
		.side-menu.dark .menu > li > a:hover{
		color:<?php echo $s[ 'hover_font_color_h_19_21' ]; ?>;

		}
	<?php } ?>

	<?php if ( !empty( $s[ 'header_font_chil_19_21' ] ) ) { ?>
		.side-menu.dark .smenu li li a,
		.side-menu.dark .menu > li li a{
		color:<?php echo $s[ 'header_font_chil_19_21' ]; ?>;

		}

	<?php } ?>

	<?php if ( !empty( $s[ 'hover_font_submenu_color_h_19_21' ] ) ) { ?>
		.side-menu.dark .smenu li li a:hover,
		.side-menu.dark .menu > li li a:hover{
		color:<?php echo $s[ 'hover_font_submenu_color_h_19_21' ]; ?>;

		}
	<?php }
}
?>

/************ Mobile Menu Setting ******/
<?php if ( $s[ 'mango_customize_mobile_menu' ] ) { ?>
<?php if(!empty($s['mobile_text_menu_color'])){?>
	.mobile-menu a{
	color:<?php echo $s['mobile_text_menu_color'];?>;

	}
<?php } ?>

<?php if(!empty($s['Mobile_Back_menu_color'])){?>
	ul.mobile-menu{

	background-color: <?php echo $s['Mobile_Back_menu_color'];?>;
	}

<?php } ?>


<?php if(!empty($s['mobile_link_menu_color'])){?>

	.mobile-menu > li > a:hover{
	color:<?php echo $s['mobile_link_menu_color'];?>;

	}
<?php } ?>

<?php if(!empty($s['Mobile_Back_menu_color'])){?>
	#mobile-menu .mobile-menu li ul{

	background-color:<?php echo $s['Mobile_Back_menu_color'];?>;
	}

<?php } ?>

<?php if(!empty($s['mobile_link_menu_color'])){?>
	#mobile-menu .mobile-menu li li a:hover,
	#mobile-menu .mobile-menu li li a:focus,
	#mobile-menu a:hover,
	#mobile-menu a:focus{
	color:<?php echo $s['mobile_link_menu_color'];?>;

	}
<?php } ?>

<?php if(!empty($s['mobile_text_menu_color'])){?>
	#mobile-menu .mobile-menu li li a {
	color: <?php echo $s['mobile_text_menu_color'];?>;
	}
<?php }
} ?>
<?php $mobile_menu_size = ( $s[ 'mobile_menu_enable_size' ] ) ? $s[ 'mobile_menu_enable_size' ] : 992; ?>
@media (min-width:<?php echo $mobile_menu_size; ?>px) {
	.menu,
	#menu-container {
		display:block;
	}

	#mobile-menu-btn {
		display:none;
	}
	.side-menu .header-search-container.header-simple-search, .side-menu .smenu, #side-menu-footer {
		display: block;
	}
	.side-menu {
		position: fixed;
		top: 0;
		bottom: 0;
		width: 300px;
		z-index: 1040;
		padding: 0 5px 0 0;
	}
	#header.header12 #header-inner {
		position: fixed;
		left: 0;
		right: 0;
		bottom: 0;
		z-index: 1030;
		background-color: #fff;
	}
	#header.header12 #header-inner .mango_nav_header_16{
		display : block;
	}
}

/* Header  Color Customization */
<?php
if($s['mango_customize_header']){

	if( ! empty( $s['header_background_light'] ) ) {
		$a = $s['header_background_light'];

		echo "#header.mango_header1,
		#header.mango_header2,
		#header.mango_header3,
		#header.mango_header4,
		#header.mango_header5,
		#header.mango_header10,
		header.side-menu.left.mango_header12,
		#header.mango_header13,#header.mango_header14,
		#header.mango_header15,
		#header.mango_header18,
		header.side-menu.right.mango_header18,
		header.side-menu.left.mango_header20{";
		if ( $a['background-color'] ) {
			echo "background-color :" . $a['background-color'] . ";";
		}

		if ( $a['background-image'] ) {

			echo "background-image :url('" . $a['background-image'] . "');";
			echo "-moz-background-image :url('" . $a['background-image'] . "');";
			echo "-o-background-image :url('" . $a['background-image'] . "');";
			echo "-webkit-background-image :url('" . $a['background-image'] . "');";
		}


		if ( $a['background-repeat'] ) {
			echo "background-repeat:" . $a['background-repeat'] . ";";
		}


		if ( $a['background-size'] ) {
			echo "background-size: " . $a['background-size'] . ";";
			echo "-moz-background-size: " . $a['background-size'] . ";";
			echo "-o-background-size : " . $a['background-size'] . ";";
			echo "-webkit-background-size : " . $a['background-size'] . ";";
		}
		if ( $a['background-position'] ) {
			echo "background-position:" . $a['background-position'] . ";";
		}

		if ( $a['background-attachment'] ) {
			echo "background-attachment:" . $a['background-attachment'] . ";";
		}
		echo "}";
	}


	?>


	<?php if( !empty($s['header_text_light'])){ ?>

		#header.mango_header1 .dropdown-toggle,#header.mango_header2 .dropdown-toggle,#header.mango_header3 .dropdown-toggle,
		#header.mango_header4 .dropdown-toggle,#header.mango_header5 .dropdown-toggle,#header.mango_header10 .dropdown-toggle,
		#header.mango_header13 .dropdown-toggle,#header.mango_header14 .dropdown-toggle,#header.mango_header15 .dropdown-toggle{

		color:<?php echo $s['header_text_light']?>;
		}

		#header.mango_header1 .header-link,#header.mango_header2 .header-link,#header.mango_header3 .header-link,
		#header.mango_header4 .header-link,#header.mango_header5 .header-link,#header.mango_header13 .header-link,#header.mango_header14 .header-link,#header.mango_header15 .header-link{

		color:<?php echo $s['header_text_light']?>;
		}

		#header.header2 #header-top .nav-text,#header.header3 #header-top .nav-text,#header.header4 #header-top .nav-text,
		#header.header5 #header-top .nav-text,#header.header11 #header-top .nav-text{

		color:<?php echo $s['header_text_light']?>;
		}
		.mango_header12.side-menu .cart-link,.mango_header18.side-menu .cart-link,.mango_header20.side-menu .cart-link{
		color:<?php echo $s['header_text_light']?>;
		}

		#header.mango_header1 .cart-text-price,#header.mango_header2 .cart-text-price,#header.mango_header3 .cart-text-price,
		#header.mango_header4 .cart-text-price,#header.mango_header5 .cart-text-price,header.side-menu.left.mango_header12 .cart-text-price,
		#header.mango_header13 .cart-text-price,#header.mango_header14 .cart-text-price,#header.mango_header15 .cart-text-price,header.side-menu.right.mango_header18 .cart-text-price,header.side-menu.left.mango_header20 .cart-text-price{
		color:<?php echo $s['header_text_light']?>;
		}
		header.side-menu.right.mango_header18.side-menu .cart-link > i,header.side-menu.left.mango_header20.side-menu .cart-link > i{
		color:<?php echo $s['header_text_light']?>;
		}

		#header.mango_header15 .cart-dropdown .dropdown-toggle > i ,#header.mango_header14 .cart-dropdown .dropdown-toggle > i,#header.mango_header13 .cart-dropdown .dropdown-toggle > i,
		#header.mango_header10 .cart-dropdown .dropdown-toggle > i ,#header.mango_header5 .cart-dropdown .dropdown-toggle > i ,#header.mango_header4 .cart-dropdown .dropdown-toggle > i,
		#header.mango_header3 .cart-dropdown .dropdown-toggle > i,#header.mango_header2 .cart-dropdown .dropdown-toggle > i  ,#header.mango_header1 .cart-dropdown .dropdown-toggle > i  {
		color:<?php echo $s['header_text_light']?>;
		}


	<?php } ?>


	<?php if(!empty($s['header_hover_light'])) {?>

		#header.mango_header1 .header-link:hover,
		#header.mango_header1 .header-link:focus,
		#header.mango_header1 .dropdown:hover >.dropdown-toggle,
		#header.mango_header1 .open > .dropdown-toggle,
		#header.mango_header1 .cart-dropdown .dropdown-toggle > i:hover,
		#header.mango_header2 .header-link:hover,
		#header.mango_header2 .header-link:focus,
		#header.mango_header2 .dropdown:hover >.dropdown-toggle,
		#header.mango_header2 .open > .dropdown-toggle,
		#header.mango_header2 .cart-dropdown .dropdown-toggle > i:hover,
		#header.mango_header3 .header-link:hover,
		#header.mango_header3 .header-link:focus,
		#header.mango_header3 .dropdown:hover >.dropdown-toggle,
		#header.mango_header3 .open > .dropdown-toggle,
		#header.mango_header3 .cart-dropdown .dropdown-toggle > i:hover,
		#header.mango_header4 .header-link:hover,
		#header.mango_header4 .header-link:focus,
		#header.mango_header4 .dropdown:hover >.dropdown-toggle,
		#header.mango_header4 .open > .dropdown-toggle,
		#header.mango_header4 .cart-dropdown .dropdown-toggle > i:hover,
		#header.mango_header5 .header-link:hover,
		#header.mango_header5 .header-link:focus,
		#header.mango_header5 .dropdown:hover >.dropdown-toggle,
		#header.mango_header5 .open > .dropdown-toggle,
		#header.mango_header5 .cart-dropdown .dropdown-toggle > i:hover,
		#header.mango_header10 .header-link:hover,
		#header.mango_header10 .header-link:focus,
		#header.mango_header10 .dropdown:hover >.dropdown-toggle,
		#header.mango_header10 .open > .dropdown-toggle,
		#header.mango_header10 .cart-dropdown .dropdown-toggle > i:hover,
		#header.mango_header13 .header-link:hover,
		#header.mango_header13 .header-link:focus,
		#header.mango_header13 .dropdown:hover >.dropdown-toggle,
		#header.mango_header13 .open > .dropdown-toggle,
		#header.mango_header13 .cart-dropdown .dropdown-toggle > i:hover,
		#header.mango_header14 .header-link:hover,
		#header.mango_header14 .header-link:focus,
		#header.mango_header14 .dropdown:hover >.dropdown-toggle,
		#header.mango_header14 .open > .dropdown-toggle,
		#header.mango_header14 .cart-dropdown .dropdown-toggle > i:hover,
		#header.mango_header15 .header-link:hover,
		#header.mango_header15 .header-link:focus,
		#header.mango_header15 .dropdown:hover >.dropdown-toggle,
		#header.mango_header15 .open > .dropdown-toggle,
		#header.mango_header15 .cart-dropdown .dropdown-toggle > i:hover
		{

		color:<?php echo  $s['header_hover_light']?>;
		}


		header.side-menu.right.mango_header18.side-menu .cart-link > i:hover,header.side-menu.left.mango_header20.side-menu .cart-link > i:hover{
		color:<?php echo $s['header_hover_light']?>;
		}

		.mango_header18.side-menu .cart-link:hover,.mango_header20.side-menu .cart-link:hover{
		color:<?php echo $s['header_hover_light']?>;
		}
	<?php } ?>

	<?php if(!empty($s['header_box_light'])){?>

		#header.header11 .header-box-icon{
		background-color: <?php echo $s['header_box_light']?>;

		}
	<?php } ?>

	/*** header 6 & 7 ***/


	<?php
	if( ! empty( $s['header_background_dark'] ) ) {
		$a = $s['header_background_dark'];
		echo "#header.mango_header6 #header-top.dark,#header.mango_header7 #header-top.dark{";
		if ( $a['background-color'] ) {
			echo "background-color :" . $a['background-color'] . ";";
		}

		if ( $a['background-image'] ) {

			echo "background-image :url('" . $a['background-image'] . "');";
			echo "-moz-background-image :url('" . $a['background-image'] . "');";
			echo "-o-background-image :url('" . $a['background-image'] . "');";
			echo "-webkit-background-image :url('" . $a['background-image'] . "');";
		}


		if ( $a['background-repeat'] ) {
			echo "background-repeat:" . $a['background-repeat'] . ";";
		}


		if ( $a['background-size'] ) {
			echo "background-size: " . $a['background-size'] . ";";
			echo "-moz-background-size: " . $a['background-size'] . ";";
			echo "-o-background-size : " . $a['background-size'] . ";";
			echo "-webkit-background-size : " . $a['background-size'] . ";";
		}
		if ( $a['background-position'] ) {
			echo "background-position:" . $a['background-position'] . ";";
		}

		if ( $a['background-attachment'] ) {
			echo "background-attachment:" . $a['background-attachment'] . ";";
		}
		echo "}";
	}


	?>



	<?php
	if( ! empty( $s['header_background_dark_bottom'] ) ) {
		$a = $s['header_background_dark_bottom'];
		echo "#header.header6,#header.header7{";
		if ( $a['background-color'] ) {
			echo "background-color :" . $a['background-color'] . ";";
		}

		if ( $a['background-image'] ) {

			echo "background-image :url('" . $a['background-image'] . "');";
			echo "-moz-background-image :url('" . $a['background-image'] . "');";
			echo "-o-background-image :url('" . $a['background-image'] . "');";
			echo "-webkit-background-image :url('" . $a['background-image'] . "');";
		}


		if ( $a['background-repeat'] ) {
			echo "background-repeat:" . $a['background-repeat'] . ";";
		}


		if ( $a['background-size'] ) {
			echo "background-size: " . $a['background-size'] . ";";
			echo "-moz-background-size: " . $a['background-size'] . ";";
			echo "-o-background-size : " . $a['background-size'] . ";";
			echo "-webkit-background-size : " . $a['background-size'] . ";";
		}
		if ( $a['background-position'] ) {
			echo "background-position:" . $a['background-position'] . ";";
		}

		if ( $a['background-attachment'] ) {
			echo "background-attachment:" . $a['background-attachment'] . ";";
		}
		echo "}";
	}


	?>






	<?php if(!empty($s['header_text_dark'])){?>

		#header.mango_header6 #header-top.dark .nav-text,#header.mango_header7 #header-top.dark .nav-text{
		color:<?php echo $s['header_text_dark']?>;
		}

		#header.mango_header7 .cart-text-price,#header.mango_header6 .cart-text-price{
		color:<?php echo $s['header_text_dark']?>;
		}

		#header.mango_header7 #header-top.dark .nav-text i ,#header.mango_header6 #header-top.dark .nav-text i {
		color:<?php echo $s['header_text_dark']?>;
		}


		#header.mango_header7 #header-top.dark .nav-text .header-text,#header.mango_header6 #header-top.dark .nav-text .header-text{
		color:<?php echo $s['header_text_dark']?>;
		}


		#header.mango_header7 #header-top.dark .header-link,#header.mango_header6 #header-top.dark .header-link{
		color:<?php echo $s['header_text_dark']?>;
		}



	<?php } ?>

	<?php if(!empty($s['header_text_dark_hover'])){?>

		#header.mango_header7 #header-top.dark .header-link:hover,#header.mango_header6 #header-top.dark .header-link:hover{
		color:<?php echo $s['header_text_dark_hover']?>;
		}

	<?php } ?>

	<?php if(!empty($s['header_cart_text_dark_hover']) || $s['header_cart_bg_dark_hover']){?>

		#header.mango_header6 #header-top.dark .cart-dropdown .dropdown-toggle:hover > i,#header.mango_header6 #header-top.dark .cart-dropdown:hover .dropdown-toggle > i,#header.mango_header6 #header-top.dark .cart-dropdown:hover .dropdown-toggle,
		#header.mango_header7 #header-top.dark .cart-dropdown .dropdown-toggle:hover > i,#header.mango_header7 #header-top.dark .cart-dropdown:hover .dropdown-toggle > i,#header.mango_header7 #header-top.dark .cart-dropdown:hover .dropdown-toggle
		{

		background-color: <?php echo $s['header_cart_bg_dark_hover']?>;
		color: <?php echo $s['header_cart_text_dark_hover'] ?>;

		}

	<?php } ?>


	<?php if(!empty($s['header_cart_text_dark']) || $s['header_cart_bg_dark']){?>

		#header.mango_header6 #header-top.dark .cart-dropdown .dropdown-toggle > i,#header.mango_header6 #header-top.dark .cart-dropdown .dropdown-toggle > i,#header.mango_header6 #header-top.dark .cart-dropdown .dropdown-toggle,
		#header.mango_header7 #header-top.dark .cart-dropdown .dropdown-toggle > i,#header.mango_header7 #header-top.dark .cart-dropdown .dropdown-toggle > i,#header.mango_header7 #header-top.dark .cart-dropdown .dropdown-toggle
		{

		background-color: <?php echo $s['header_cart_bg_dark']?>;
		color: <?php echo  $s['header_cart_text_dark']?>;

		}

	<?php } ?>

	/** Header 8 & 16 **/




	<?php
	if( ! empty( $s['header_background_custom'] ) ) {
		$a = $s['header_background_custom'];
		echo "#header.mango_header8 #header-top.custom,#header.mango_header16 #header-top.custom {";
		if ( $a['background-color'] ) {
			echo "background-color :" . $a['background-color'] . ";";
		}

		if ( $a['background-image'] ) {

			echo "background-image :url('" . $a['background-image'] . "');";
			echo "-moz-background-image :url('" . $a['background-image'] . "');";
			echo "-o-background-image :url('" . $a['background-image'] . "');";
			echo "-webkit-background-image :url('" . $a['background-image'] . "');";
		}


		if ( $a['background-repeat'] ) {
			echo "background-repeat:" . $a['background-repeat'] . ";";
		}


		if ( $a['background-size'] ) {
			echo "background-size: " . $a['background-size'] . ";";
			echo "-moz-background-size: " . $a['background-size'] . ";";
			echo "-o-background-size : " . $a['background-size'] . ";";
			echo "-webkit-background-size : " . $a['background-size'] . ";";
		}
		if ( $a['background-position'] ) {
			echo "background-position:" . $a['background-position'] . ";";
		}

		if ( $a['background-attachment'] ) {
			echo "background-attachment:" . $a['background-attachment'] . ";";
		}
		echo "}";
	}


	?>






	<?php
	if( ! empty( $s['header_background_custom_bottom'] ) ) {
		$a = $s['header_background_custom_bottom'];
		echo "#header.mango_header8,#header.mango_header16 #header-inner {";
		if ( $a['background-color'] ) {
			echo "background-color :" . $a['background-color'] . ";";
		}

		if ( $a['background-image'] ) {

			echo "background-image :url('" . $a['background-image'] . "');";
			echo "-moz-background-image :url('" . $a['background-image'] . "');";
			echo "-o-background-image :url('" . $a['background-image'] . "');";
			echo "-webkit-background-image :url('" . $a['background-image'] . "');";
		}


		if ( $a['background-repeat'] ) {
			echo "background-repeat:" . $a['background-repeat'] . ";";
		}


		if ( $a['background-size'] ) {
			echo "background-size: " . $a['background-size'] . ";";
			echo "-moz-background-size: " . $a['background-size'] . ";";
			echo "-o-background-size : " . $a['background-size'] . ";";
			echo "-webkit-background-size : " . $a['background-size'] . ";";
		}
		if ( $a['background-position'] ) {
			echo "background-position:" . $a['background-position'] . ";";
		}

		if ( $a['background-attachment'] ) {
			echo "background-attachment:" . $a['background-attachment'] . ";";
		}
		echo "}";
	}


	?>


	<?php if(!empty($s['header_box_custom'])){?>

		#header.mango_header8 .header-box-icon {
		background-color:<?php echo $s['header_box_custom']?>;
		}

	<?php } ?>

	<?php
	if(!empty($s['header_text_custom'])){
		?>
		#header.mango_header8 #header-top.custom .header-link,#header.mango_header16 #header-top.custom .header-link{
		color:<?php echo  $s['header_text_custom']?>;
		}

		#header.mango_header8 #header-top.custom .cart-text-price,#header.mango_header16 #header-top.custom .cart-text-price{
		color:<?php echo  $s['header_text_custom']?>;
		}


		#header.mango_header8 #header-top.custom .nav-text, #header.mango_header16 #header-top.custom .nav-text{
		color:<?php echo  $s['header_text_custom']?>;
		}

	<?php } ?>

	<?php
	if(!empty($s['header_text_custom_hover'])){
		?>
		#header.mango_header8 #header-top.custom .header-link:hover,#header.mango_header16 #header-top.custom .header-link:hover{
		color:<?php echo  $s['header_text_custom_hover']?>;
		}

	<?php } ?>



	<?php
	if(!empty($s['header_cart_bg_custom']) || $s['header_cart_text_custom'] ){
		?>

		#header.mango_header8 #header-top.custom .cart-dropdown .dropdown-toggle > i,#header.mango_header8 #header-top.custom .cart-dropdown .dropdown-toggle > i,#header.mango_header8 #header-top.custom .cart-dropdown .dropdown-toggle,
		#header.mango_header16 #header-top.custom .cart-dropdown .dropdown-toggle > i,#header.mango_header16 #header-top.custom .cart-dropdown .dropdown-toggle > i,#header.mango_header16 #header-top.custom .cart-dropdown .dropdown-toggle{
		color:<?php echo $s['header_cart_text_custom']?>;
		background:<?php echo $s['header_cart_bg_custom']?>;
		}

	<?php } ?>


	<?php
	if(!empty($s['header_cart_bg_custom_hover']) || $s['header_cart_text_custom_hover'] ){
		?>
		#header.mango_header8 #header-top.custom .cart-dropdown .dropdown-toggle:hover > i,#header.mango_header8 #header-top.custom .cart-dropdown:hover .dropdown-toggle > i,#header.mango_header8 #header-top.custom .cart-dropdown:hover .dropdown-toggle,
		#header.mango_header16 #header-top.custom .cart-dropdown .dropdown-toggle:hover > i,#header.mango_header16 #header-top.custom .cart-dropdown:hover .dropdown-toggle > i,#header.mango_header16 #header-top.custom .cart-dropdown:hover .dropdown-toggle{
		color:<?php echo $s['header_cart_text_custom_hover']?>;
		background:<?php echo $s['header_cart_bg_custom_hover']?>;
		}

	<?php } ?>

	<?php
	if(!empty($s['header_cart_text_custom'])){
		?>
		#header.mango_header8 #header-top.custom .nav-text .header-text,#header.mango_header16 #header-top.custom .nav-text .header-text {
		color:<?php echo  $s['header_cart_text_custom']?> ;
		}

		#header.mango_header8  #header-top.custom .nav-text i,#header.mango_header16  #header-top.custom .nav-text i {
		color:<?php echo  $s['header_cart_text_custom']?> ;
		}

	<?php } ?>


	/** Header 19 & 20 **/

	<?php
	if( ! empty( $s['header_background_side_header'] ) ) {
		$a = $s['header_background_side_header'];
		echo "header.side-menu.left.dark.mango_header19 {";
		if ( $a['background-color'] ) {
			echo "background-color :" . $a['background-color'] . ";";
		}

		if ( $a['background-image'] ) {

			echo "background-image :url('" . $a['background-image'] . "');";
			echo "-moz-background-image :url('" . $a['background-image'] . "');";
			echo "-o-background-image :url('" . $a['background-image'] . "');";
			echo "-webkit-background-image :url('" . $a['background-image'] . "');";
		}


		if ( $a['background-repeat'] ) {
			echo "background-repeat:" . $a['background-repeat'] . ";";
		}


		if ( $a['background-size'] ) {
			echo "background-size: " . $a['background-size'] . ";";
			echo "-moz-background-size: " . $a['background-size'] . ";";
			echo "-o-background-size : " . $a['background-size'] . ";";
			echo "-webkit-background-size : " . $a['background-size'] . ";";
		}
		if ( $a['background-position'] ) {
			echo "background-position:" . $a['background-position'] . ";";
		}

		if ( $a['background-attachment'] ) {
			echo "background-attachment:" . $a['background-attachment'] . ";";
		}
		echo "}";
	}


	?>





	<?php
	if(!empty($s['header_text_side_header'])){
		?>

		header.side-menu.left.dark.mango_header19.side-menu.dark .cart-link {
		color: <?php echo $s['header_text_side_header']?>;
		}


		header.side-menu.left.dark.mango_header19.side-menu.dark .cart-link > i{
		color: <?php echo $s['header_text_side_header']?>;
		}



		header.side-menu.left.dark.mango_header19.side-menu.dark .header-search-container.header-simple-search .btn{
		color: <?php echo $s['header_text_side_header']?>;

		}
	<?php } ?>


	<?php
	if(!empty($s['header_hover_side_header'])){
		?>

		header.side-menu.left.dark.mango_header19.side-menu.dark .cart-link:hover {
		color: <?php echo $s['header_hover_side_header']?>;
		}




		header.side-menu.left.dark.mango_header19.side-menu.dark .cart-link > i:hover{
		color: <?php echo $s['header_hover_side_header']?>;
		}


		header.side-menu.left.dark.mango_header19.side-menu.dark .header-search-container.header-simple-search .btn:hover{
		color: <?php echo $s['header_hover_side_header']?>;

		}

	<?php } ?>


	<?php
	if(!empty($s['header_prize_side_header'])){
		?>

		header.side-menu.left.dark.mango_header19  .cart-text-price{
		color:<?php echo  $s['header_prize_side_header']?> ;
		}

	<?php } ?>



	/* Header 11 */



	<?php
	if( ! empty( $s['header_background_red'] ) ) {
		$a = $s['header_background_red'];
		echo "#header.mango_header11 {";
		if ( $a['background-color'] ) {
			echo "background-color :" . $a['background-color'] . ";";
		}

		if ( $a['background-image'] ) {

			echo "background-image :url('" . $a['background-image'] . "');";
			echo "-moz-background-image :url('" . $a['background-image'] . "');";
			echo "-o-background-image :url('" . $a['background-image'] . "');";
			echo "-webkit-background-image :url('" . $a['background-image'] . "');";
		}


		if ( $a['background-repeat'] ) {
			echo "background-repeat:" . $a['background-repeat'] . ";";
		}


		if ( $a['background-size'] ) {
			echo "background-size: " . $a['background-size'] . ";";
			echo "-moz-background-size: " . $a['background-size'] . ";";
			echo "-o-background-size : " . $a['background-size'] . ";";
			echo "-webkit-background-size : " . $a['background-size'] . ";";
		}
		if ( $a['background-position'] ) {
			echo "background-position:" . $a['background-position'] . ";";
		}

		if ( $a['background-attachment'] ) {
			echo "background-attachment:" . $a['background-attachment'] . ";";
		}
		echo "}";
	}


	?>


	<?php
	if(!empty($s['header_text_red'])){
		?>

		#header.mango_header11 .nav-text{
		color:<?php echo $s['header_text_red']?>;
		}


		#header.mango_header11 .header-link{
		color:<?php echo $s['header_text_red']?>;
		}

		#header.mango_header11 .dropdown-toggle,#header.mango_header11 .cart-dropdown .dropdown-toggle > i{
		color:<?php echo $s['header_text_red']?>;
		}

	<?php } ?>


	<?php
	if(!empty($s['header_prize_red'])){
		?>

		#header.mango_header11 .cart-text-price{
		color:<?php echo $s['header_prize_red']?>;
		}

	<?php } ?>



	<?php
	if(!empty($s['header_hover_red'])){
		?>

		#header.mango_header11 .header-link:hover{
		color:<?php echo $s['header_hover_red']?>;
		}

		#header.mango_header11 .dropdown:hover >.dropdown-toggle,#header.mango_header11 .cart-dropdown .dropdown-toggle > i:hover{
		color:<?php echo $s['header_hover_red']?>;
		}


	<?php } ?>




	<?php
	if(!empty($s['header_box_red'])){
		?>
		#header.mango_header11 .header-box-icon {
		background-color:<?php echo $s['header_box_red']?>;
		}
	<?php }
}
?>
<?php
echo "/************ page color Content Setting ******/";

if ( !empty( $s[ 'mango_content_background' ] ) ) {
	$a = $s[ 'mango_content_background' ];
	echo "section#content{";

	if ( $a[ 'background-color' ] ) {
		echo "background-color :" . $a[ 'background-color' ] . ";";
	}

	if ( $a[ 'background-image' ] ) {
		echo "background-image :url('" . $a[ 'background-image' ] . "');";
		echo "-moz-background-image :url('" . $a[ 'background-image' ] . "');";
		echo "-o-background-image :url('" . $a[ 'background-image' ] . "');";
		echo "-webkit-background-image :url('" . $a[ 'background-image' ] . "');";
	}

	if ( $a[ 'background-repeat' ] ) {
		echo "background-repeat:" . $a[ 'background-repeat' ] . ";";
	}

	if ( $a[ 'background-size' ] ) {
		echo "background-size: " . $a[ 'background-size' ] . ";";
		echo "-moz-background-size: " . $a[ 'background-size' ] . ";";
		echo "-o-background-size : " . $a[ 'background-size' ] . ";";
		echo "-webkit-background-size : " . $a[ 'background-size' ] . ";";
	}

	if ( $a[ 'background-position' ] ) {
		echo "background-position:" . $a[ 'background-position' ] . ";";
	}

	if ( $a[ 'background-attachment' ] ) {
		echo "background-attachment:" . $a[ 'background-attachment' ] . ";";
	}
	echo "}";
} ?>

/* Footer  Color Customization */

<?php if($s['mango_enable_footer_customization']) { ?>


<?php
if ( !empty( $s[ 'mango_footer_typography' ] ) ) {
$b = $s[ 'mango_footer_typography' ]; ?>
#footer, footer .widget .widget-title,#footer .product-title{
<?php if ( $b[ 'font-family' ] ) { ?>
	font-family : <?php echo $b[ 'font-family' ] . ( ( $b[ 'font-backup' ] ) ? ',' . $b[ 'font-backup' ] : '' ); ?>;
<?php } ?>
<?php if ( $b[ 'font-weight' ] ) { ?>
	font-weight :<?php echo $b[ 'font-weight' ] ?>;
<?php } ?>
<?php if ( $b[ 'font-style' ] ) { ?>
	font-style :<?php echo $b[ 'font-style' ] ?>;
<?php } ?>
<?php if ( $b[ 'color' ] ) { ?>
	color :<?php echo $b[ 'color' ] ?>;
<?php } ?>
	<?php if ( $b[ 'line-height' ] ) { ?>
		line-height :<?php echo $b[ 'line-height' ] ?>;
	<?php } ?>
	<?php if ( $b[ 'font-size' ] ) { ?>
		font-size :<?php echo $b[ 'font-size' ] ?>;
	<?php } ?>
}
<?php } ?>






	<?php
	if ( ! empty( $s['footer_heading_color'] ) ) {
		?>
		#footer.mango_footer_1 #footer-inner .widget-title,
		footer.mango_footer_6 #footer-inner .widget .widget-title,
		footer.mango_footer_7 #footer-inner .widget .widget-title,
		footer.mango_footer_8 #footer-inner .widget .widget-title,
		footer.mango_footer_9 #footer-inner .widget .widget-title,
		footer.mango_footer_10 #footer-inner .widget .widget-title,
		footer.mango_footer_11 #footer-inner .widget .widget-title{
		color:<?php echo $s['footer_heading_color']; ?>;
		}


	<?php } ?>

	<?php
	if ( ! empty( $s['footer_heading_color'] ) ) {
		?>
		footer.mango_footer_1 .footer-bg .widget .hours-list li > span,
		footer.mango_footer_6 #footer-inner .widget .hours-list li > span,
		footer.mango_footer_7 #footer-inner .widget .hours-list li > span,
		footer.mango_footer_8 #footer-inner .widget .hours-list li > span,
		footer.mango_footer_9 #footer-inner .widget .hours-list li > span,
		footer.mango_footer_10 #footer-inner .widget .hours-list li > span,
		footer.mango_footer_11 #footer-inner .widget .hours-list li > span
		{
		color:<?php echo $s['footer_heading_color']; ?>;
		}
	<?php } ?>

	/*desciption font color */
	<?php
	if ( ! empty( $s['footer_text_color'] ) ) {
		?>
		footer.mango_footer_1 .footer-bg .widget,
		footer.mango_footer_6 #footer-inner .widget,
		footer.mango_footer_7 #footer-inner .widget,
		footer.mango_footer_8 #footer-inner .widget,
		footer.mango_footer_9 #footer-inner .widget,
		footer.mango_footer_10 #footer-inner .widget,
		footer.mango_footer_11 #footer-inner .widget{
		color: <?php echo $s['footer_text_color']; ?>;
		}
	<?php } ?>
	<?php
	if ( ! empty( $s['footer_text_color'] ) ) {
		?>
		footer.mango_footer_1 .footer-bg .widget .hours-widget p,
		footer.mango_footer_6 #footer-inner .hours-widget p,
		footer.mango_footer_7 #footer-inner .hours-widget p,
		footer.mango_footer_8 #footer-inner .hours-widget p,
		footer.mango_footer_9 #footer-inner .hours-widget p,
		footer.mango_footer_10 #footer-inner .hours-widget p,
		footer.mango_footer_11 #footer-inner .hours-widget p
		{
		color: <?php echo $s['footer_text_color']; ?>;
		}
	<?php } ?>



	/*menu color links*/
	<?php
	if ( ! empty( $s['footer_link_color'] ) ) {
		?>
		#footer a,

		#footer.mango_footer_9 .widget a,
		#footer.mango_footer_10 .widget a,
		#footer.mango_footer_11 .widget a{
		color:<?php echo $s['footer_link_color']; ?>;

		}
	<?php } ?>

	<?php
	if ( ! empty( $s['footer_link_hover_color'] ) ) {
		?>
		#footer a:hover,
		#footer.mango_footer_9 .widget a:hover,
		#footer.mango_footer_10 .widget a:hover,
		#footer.mango_footer_11 .widget a:hover{
		color:<?php echo $s['footer_link_hover_color']; ?>;
		}
	<?php } ?>



	<?php
		if( ! empty( $s['mango_bg_custom_footer_light'] ) ) {
			$a = $s['mango_bg_custom_footer_light'];
				echo "footer.mango_footer_1 .footer-bg:before,footer.mango_footer_6 div#footer-inner,
					footer.mango_footer_7 div#footer-inner,
					footer.mango_footer_8 div#footer-inner,
					footer.mango_footer_9 div#footer-inner,
					footer.mango_footer_10 div#footer-inner,
					footer.mango_footer_11 div#footer-inner{";
						if ( $a['background-color'] ) {
							echo "background-color :" . $a['background-color'] . ";";
						}

						if ( $a['background-image'] ) {

			echo "background-image :url('" . $a['background-image'] . "');";
			echo "-moz-background-image :url('" . $a['background-image'] . "');";
			echo "-o-background-image :url('" . $a['background-image'] . "');";
			echo "-webkit-background-image :url('" . $a['background-image'] . "');";
		}


		if ( $a['background-repeat'] ) {
			echo "background-repeat:" . $a['background-repeat'] . ";";
		}


		if ( $a['background-size'] ) {
			echo "background-size: " . $a['background-size'] . ";";
			echo "-moz-background-size: " . $a['background-size'] . ";";
			echo "-o-background-size : " . $a['background-size'] . ";";
			echo "-webkit-background-size : " . $a['background-size'] . ";";
		}
		if ( $a['background-position'] ) {
			echo "background-position:" . $a['background-position'] . ";";
		}

		if ( $a['background-attachment'] ) {
			echo "background-attachment:" . $a['background-attachment'] . ";";
		}
		echo "}";
	}


	?>


	/*footer bottom links*/

	<?php
	if ( ! empty( $s['footer_bottom_link_color'] ) ) {
		?>
		#footer .footer-menu li a{
		color:<?php echo $s['footer_bottom_link_color']; ?>;
		}
	<?php } ?>
	<?php
	if ( ! empty( $s['footer_bottom_link_hover_color'] ) ) {
		?>
		#footer .footer-menu li a:hover{
		color:<?php echo $s['footer_bottom_link_hover_color']; ?>;

		}
	<?php } ?>

	/*copy right section */
	<?php
	if ( ! empty( $s['footer_copyright_text_color'] ) ) {
		?>
		footer.mango_footer_1 .copyright,
		footer.mango_footer_6 .copyright,
		footer.mango_footer_7 .copyright,
		footer.mango_footer_8 .copyright,
		footer.mango_footer_9 .copyright,
		footer.mango_footer_10 .copyright,
		footer.mango_footer_11 .copyright{
		color:<?php echo $s['footer_copyright_text_color']; ?>;
		}
	<?php } ?>
	
	<?php
	if ( ! empty( $s['footer_copyright_background_color_1_3'] ) ) {
		?>
		footer.mango_footer_1 p.copyright,
		footer.mango_footer_6 p.copyright,
		footer.mango_footer_7 p.copyright,
		footer.mango_footer_8 p.copyright,
		footer.mango_footer_9 p.copyright,
		footer.mango_footer_10 p.copyright,
		footer.mango_footer_11 p.copyright
		{
		background-color:<?php echo $s['footer_copyright_background_color_1_3']; ?>;
		}
	<?php } ?>
	
	<?php
	if ( ! empty( $s['footer_copyright_link_color'] ) ) {
		?>
		#footer .copyright a{
		color:<?php echo $s['footer_copyright_link_color']; ?>;

		}
	<?php } ?>

	<?php
	if ( ! empty( $s['footer_copyright_link_hover_color'] ) ) {
		?>
		#footer .copyright a:hover{
		color:<?php echo $s['footer_copyright_link_hover_color']; ?>;

		}
	<?php
	}
?>


	<?php
	if ( ! empty( $s['mango_bg_custom_footer_dark'] ) ) {
		$a = $s['mango_bg_custom_footer_dark'];
		echo "footer.mango_footer_2 div#footer-inner,
		#footer.footer-minimal.dark{";

		if ( $a['background-color'] ) {
			echo "background-color :" . $a['background-color'] . ";";
		}

		if ( $a['background-image'] ) {
			echo "background-image :url('" . $a['background-image'] . "');";
			echo "-moz-background-image :url('" . $a['background-image'] . "');";
			echo "-o-background-image :url('" . $a['background-image'] . "');";
			echo "-webkit-background-image :url('" . $a['background-image'] . "');";
		}


		if ( $a['background-repeat'] ) {
			echo "background-repeat:" . $a['background-repeat'] . ";";
		}


		if ( $a['background-size'] ) {
			echo "background-size: " . $a['background-size'] . ";";
			echo "-moz-background-size: " . $a['background-size'] . ";";
			echo "-o-background-size : " . $a['background-size'] . ";";
			echo "-webkit-background-size : " . $a['background-size'] . ";";
		}
		if ( $a['background-position'] ) {
			echo "background-position:" . $a['background-position'] . ";";
		}

		if ( $a['background-attachment'] ) {
			echo "background-attachment:" . $a['background-attachment'] . ";";
		}
		echo "}";

	}

	?>


/*********************** title ***************************/
		<?php
			if(!empty($s['footer_heading_dark_color'])){ ?>
				#footer.mango_footer_2 #footer-inner .widget .widget-title{
					color:<?php echo $s['footer_heading_dark_color'];?>;
				}
		<?php } ?>

		<?php
			if(!empty($s['footer_heading_dark_color'])){ ?>
				#footer.mango_footer_2 #footer-inner .widget .hours-list li > span{
				color:<?php echo $s['footer_heading_dark_color'];?>;
				}
		<?php } ?>

		/*********************** text color **************/
		<?php
			if(!empty($s['footer_text_dark_color'])){ ?>
				#footer.mango_footer_2 #footer-inner .widget{
					color:<?php echo $s['footer_text_dark_color']; ?>;
				}
		<?php } ?>
		<?php
			if(!empty($s['footer_text_dark_color'])){ ?>
				footer.mango_footer_2 #footer-inner .hours-widget p{
					color:<?php echo $s['footer_text_dark_color']; ?>;
			}
		<?php } ?>

		/************** link color *************/
		<?php
			if(!empty($s['footer_link_dark_color'])){ ?>
				#footer.footer-dark a{
					color:<?php echo $s['footer_link_dark_color'];?>;
				}
		<?php } ?>

		<?php
			if(!empty($s['footer_link_hover_dark_color'])){ ?>
				#footer.footer-dark a:hover{
					color:<?php echo $s['footer_link_hover_dark_color'];?>;
				}
		<?php } ?>

		<?php
			if(!empty($s['footer_bottom_link_dark_color'])){?>
				/*fooooter link color*/
				#footer.footer-dark .footer-menu li a,
				#footer.mango_footer_4.dark .footer-menu li a,
				#footer.mango_footer_5.dark .footer-menu li a{
					color:<?php echo $s['footer_bottom_link_dark_color'];?>;
				}
		<?php } ?>
		<?php
			if(!empty($s['footer_bottom_link_hover_dark__color'])){ ?>
				#footer.footer-dark .footer-menu li a:hover,
				#footer.mango_footer_4.dark .footer-menu li a:hover,
				#footer.mango_footer_5.dark .footer-menu li a:hover{
					color:<?php echo $s['footer_bottom_link_hover_dark__color'];?>;
				}
		<?php } ?>
		/*copy right */
		<?php
			if(!empty($s['footer_copyright_text_dark_color'])){ ?>
				#footer.mango_footer_2 .copyright,
				#footer.dark.mango_footer_4 .copyright,
				#footer.dark.mango_footer_5 .copyright,
				{
					background-color:<?php echo $s['footer_copyright_text_dark_color'];?>;
				}
		<?php } ?>
		
		
		<?php
			if(!empty($s['footer_copyright_background_dark_color'])){ ?>
				#footer.mango_footer_2 p.copyright,
				#footer.mango_footer_4 p.copyright,
				#footer.mango_footer_5 p.copyright{
				background-color:<?php echo $s['footer_copyright_background_dark_color'];?>;
				}	<?php } ?>
		
		

		<?php
				if(!empty($s['footer_copyright_link_dark_color'])){
		?>
		/*copyright link color*/
					#footer.mango_footer_2 .copyright a,
					#footer.mango_footer_4.dark .copyright a,
					#footer.mango_footer_5.dark .copyright a{
						color:<?php echo $s['footer_copyright_link_dark_color'];?>;
					}
		<?php } ?>
		<?php
			if(!empty($s['footer_copyright_link_hover_dark_color'])){ ?>
					#footer.mango_footer_2 .copyright a:hover,
				#footer.mango_footer_4.dark .copyright a:hover,
				#footer.mango_footer_5.dark .copyright a:hover{

						color:<?php echo $s['footer_copyright_link_hover_dark_color'];?>;
}

<?php } ?>
	<?php
	if ( ! empty( $s['mango_bg_custom_footer_three'] ) ) {
		$a = $s['mango_bg_custom_footer_three'];
		echo "#footer.footer-minimal{";

		if ( $a['background-color'] ) {
			echo "background-color :" . $a['background-color'] . ";";
		}

		if ( $a['background-image'] ) {
			echo "background-image :url('" . $a['background-image'] . "');";
			echo "-moz-background-image :url('" . $a['background-image'] . "');";
			echo "-o-background-image :url('" . $a['background-image'] . "');";
			echo "-webkit-background-image :url('" . $a['background-image'] . "');";
		}


		if ( $a['background-repeat'] ) {
			echo "background-repeat:" . $a['background-repeat'] . ";";
		}


		if ( $a['background-size'] ) {
			echo "background-size: " . $a['background-size'] . ";";
			echo "-moz-background-size: " . $a['background-size'] . ";";
			echo "-o-background-size : " . $a['background-size'] . ";";
			echo "-webkit-background-size : " . $a['background-size'] . ";";
		}
		if ( $a['background-position'] ) {
			echo "background-position:" . $a['background-position'] . ";";
		}

		if ( $a['background-attachment'] ) {
			echo "background-attachment:" . $a['background-attachment'] . ";";
		}
		echo "}";

	}


	?>

	<?php if(!empty($s['footer_bottom_link_three_colors'])){?>
	#footer.mango_footer_3 .footer-menu li a{
	color:<?php echo $s['footer_bottom_link_three_color'];?>;
	}
	<?php } ?>

	<?php  if(!empty($s['footer_bottom_link_hover_three__color'])){?>
	#footer.mango_footer_3 .footer-menu li a:hover{
	color:<?php echo $s['footer_bottom_link_hover_three__color'];?>;
	}
		<?php } ?>

	<?php if(!empty($s['footer_copyright_text_three_color'])){?>
	#footer.mango_footer_3 .copyright{

	color:<?php echo $s['footer_copyright_text_three_color'];?>;
	}
<?php } ?>

<?php if(!empty($s['footer_copyright_link_three_color'])){?>
	#footer.mango_footer_3 .copyright a{

	color:<?php echo $s['footer_copyright_link_three_color'];?>;
	}
<?php } ?>

<?php if(!empty($s['footer_copyright_link_hover_three_color'])){?>
	#footer.mango_footer_3 .copyright a:hover{

	color:<?php echo $s['footer_copyright_link_hover_three_color'];?>;
	}
	<?php } ?>

	<?php
	if ( ! empty( $s['mango_bg_custom_footer_top'] ) ) {
		$a = $s['mango_bg_custom_footer_top'];
		echo "#footer.mango_footer_1 div#footer-top,
	#footer.mango_footer_2 div#footer-top,
	#footer.mango_footer_6 div#footer-top,
	#footer.mango_footer_7 div#footer-top{";

		if ( $a['background-color'] ) {
			echo "background-color :" . $a['background-color'] . ";";
		}

		if ( $a['background-image'] ) {
			echo "background-image :url('" . $a['background-image'] . "');";
			echo "-moz-background-image :url('" . $a['background-image'] . "');";
			echo "-o-background-image :url('" . $a['background-image'] . "');";
			echo "-webkit-background-image :url('" . $a['background-image'] . "');";
		}


		if ( $a['background-repeat'] ) {
			echo "background-repeat:" . $a['background-repeat'] . ";";
		}


		if ( $a['background-size'] ) {
			echo "background-size: " . $a['background-size'] . ";";
			echo "-moz-background-size: " . $a['background-size'] . ";";
			echo "-o-background-size : " . $a['background-size'] . ";";
			echo "-webkit-background-size : " . $a['background-size'] . ";";
		}
		if ( $a['background-position'] ) {
			echo "background-position:" . $a['background-position'] . ";";
		}

		if ( $a['background-attachment'] ) {
			echo "background-attachment:" . $a['background-attachment'] . ";";
		}
		echo "}";

	}
	?>
	
	
	<?php if(!empty($s['footer_copyright_background_three_color'])){ ?>
	#footer.mango_footer_3 p.copyright{
		background-color:<?php echo $s['footer_copyright_background_three_color'];?>;
	}

<?php } ?>
	
	/*footer top v1*/
	<?php if(!empty($s['footer_top_title_color'])){ ?>
	footer.mango_footer_1 #footer-top .widget .widget-title,
	footer.mango_footer_2 #footer-top .widget .widget-title,
	footer.mango_footer_6 #footer-top .widget .widget-title,
	footer.mango_footer_7 #footer-top .widget .widget-title{
		color:<?php echo $s['footer_top_title_color'];?>;
	}

<?php } ?>



	<?php if(!empty($s['footer_top_link_color'])){?>
	#footer.mango_footer_1 #footer-top .widget .products-list .product-title a,
	#footer.mango_footer_2 #footer-top .widget .products-list .product-title a,
	#footer.mango_footer_6 #footer-top .widget .products-list .product-title a,
	#footer.mango_footer_7 #footer-top .widget .products-list .product-title a{
		color:<?php echo $s['footer_top_link_color'];?>;
	}
	<?php } ?>

<?php if(!empty($s['footer_top_hover_color'])){?>
	#footer.mango_footer_1 .widget .products-list .product-title a:hover,
	#footer.mango_footer_2 .widget .products-list .product-title a:hover,
	#footer.mango_footer_6 .widget .products-list .product-title a:hover,
	#footer.mango_footer_7 .widget .products-list .product-title a:hover{
		color:<?php echo $s['footer_top_hover_color'];?>;
	}
	<?php } ?>

<?php } //end footer condition?>
<?php
 /***********HEADER 9 & 17**************/
if(!empty($s['header_text_nine17'])){

?>

 #header.header-absolute.mango_header9 .header-link,
 #header.header-absolute.mango_header9 .dropdown-toggle,
 .header-absolute.mango_header9 .cart-dropdown .dropdown-toggle > i,
 #header.header-absolute.mango_header17 .header-link,
 #header.header-absolute.mango_header17 .dropdown-toggle,
 .header-absolute.mango_header17 .cart-dropdown .dropdown-toggle > i,
 #header.header-absolute.absolute-fullwidth.mango_header17 .nav-text,
 #header.header-absolute.absolute-fullwidth .nav-text > span:last-child
{
	
	color:<?php echo $s['header_text_nine17']?> 
 
 }
 <?php
}
if(!empty($s['header_text_nine17_hover'])){

 ?>
 #header.header-absolute.mango_header9 .header-link:hover,
#header.header-absolute.mango_header9 .dropdown-toggle:hover,
.header-absolute.mango_header9 .cart-dropdown .dropdown-toggle > i:hover,
#header.header-absolute.mango_header17 .header-link:hover,
#header.header-absolute.mango_header17 .dropdown-toggle:hover,
.header-absolute.mango_header17 .cart-dropdown .dropdown-toggle > i:hover,
#header.header-absolute.absolute-fullwidth.mango_header17 .nav-text:hover,
#header.header-absolute.absolute-fullwidth.mango_header17 .nav-text > span:last-child:hover
{

	color:<?php echo $s['header_text_nine17_hover'];?>	

	}
<?php 
}
if(!empty($s['header_cart_bg_nine17'])){
?>
#header.header-absolute.mango_header9 #cart-dropdown,
#header.header-absolute.mango_header17 #cart-dropdown{
	
	background-color:<?php echo $s['header_cart_bg_nine17'];?>

	}
<?php	}

if(!empty($s['header_cart_bg_nine17_hover'])){
	?>

#header.header-absolute.mango_header9 #cart-dropdown:hover,
#header.header-absolute.mango_header17 #cart-dropdown:hover{
	
	background-color:<?php echo $s['header_cart_bg_nine17_hover'];?>
	
}
<?php	
}
if(!empty($s['header_menu_btn_color'])){
?>
	#header.header-absolute.mango_header9 #mobile-menu-btn,
	#header.header-absolute.mango_header17 #mobile-menu-btn{
		color:<?php echo $s['header_menu_btn_color'] ;?>
	}
<?php
}
?>

<?php	

if(!empty($s['header_menu_btn_hover_color'])){
?>
	#header.header-absolute.mango_header9 #mobile-menu-btn:hover,
	#header.header-absolute.mango_header17 #mobile-menu-btn:hover{
		color:<?php echo $s['header_menu_btn_hover_color'] ;?>
	}
<?php
}
if(!empty($s['header_bag_color_nine17'])){
 ?>
	body header#header.mango_header17.no_banner_bg,
	{
		background-color:<?php echo $s['header_bag_color_nine17'];?>
}
body header#header.mango_header17.no_banner_bg.fixed,
	{
		background-color:<?php echo $s['header_bag_color_nine17'];?>
}
	 <?php
 }
?>

/*Custom CSS Here*/

<?php echo $s['css_editor']; ?>

<?php if(!empty($s['mango_cart_color'])){ ?>
#header.mango_header1 .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header2 .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header3 .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header4 .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header5 .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header6 #header-top.dark .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header7 #header-top.dark .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header8 #header-top.custom .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header9.header-absolute .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header10 .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header11 .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header13 .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header14 .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header15 .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header17.header-absolute .cart-dropdown .dropdown-toggle > i.icon-fo-color,
.header-absolute .cart-dropdown .dropdown-toggle > i.icon-fo-color,
#header.mango_header16 #header-top.custom .cart-dropdown .dropdown-toggle > i.icon-fo-color,
.mango_header12.side-menu .cart-link > i.icon-fo-color,
header.side-menu.right.mango_header18.side-menu .cart-link > i.icon-fo-color,
header.side-menu.left.dark.mango_header19.side-menu.dark .cart-link > i.icon-fo-color,
header.side-menu.left.mango_header20.side-menu .cart-link > i.icon-fo-color,
header.side-menu.left.dark.mango_header21.side-menu.dark .cart-link > i.icon-fo-color {
 color:<?php echo $s['mango_cart_color']?>;
}
<?php } ?>
.tbl-flt.active {
  border-right: 4px solid <?php echo $theme_color ?>;
}
li.custom_tab1-flt.active{
  border-right: 4px solid <?php echo $theme_color ?>;
}
li.custom_tab2-flt.active{
  border-right: 4px solid <?php echo $theme_color ?>;
}