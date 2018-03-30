<?php
header('Content-type: text/css');

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

global $themeum_options;

$output = '';


	$link_color = $themeum_options['link-color'];

	if(isset($link_color)){
		$output .= 'input[type="submit"],
		button,
		.single-post .post-navigation,
		.widget .nav,
		.book_wrapper a.btn-download,
		.btn-common,
		.profile-tab ul.nav-tabs>li>a:hover,
		.profile-tab ul.nav-tabs>li.active>a,
		.profile-tab ul.nav-tabs>li.active>a:hover,
		.profile-tab ul.nav-tabs>li.active>a:focus,
		.pagination>.active>a, .pagination>.active>span,
		.pagination>.active>a:hover,
		.pagination>.active>span:hover,
		.pagination>.active>a:focus,
		.pagination>.active>span:focus,
		.pagination>li>a:hover,
		.pagination>li>span:hover,
		.pagination>li>a:focus,
		.pagination>li>span:focus,
		.single-post .post-navigation .post-controller .previous-post a,
		.single-post .post-navigation .post-controller .next-post a,
		.post-content.media .post-format i,
		#searchform .btn-search,
		#blog-gallery-slider .carousel-control.left,
		#blog-gallery-slider .carousel-control.right, 
		.featured-image .entry-date ,
		.entry-header .no-image,
		.format-no-image .entry-date,
		.woocommerce span.onsale,
		.woocommerce-page span.onsale,
		.product-thumbnail-outer .addtocart-btn,
		.woocommerce .quantity .minus, 
		.woocommerce-page .quantity .minus, 
		.woocommerce #content .quantity .minus, 
		.woocommerce-page #content .quantity .minus,
		.woocommerce .quantity .plus, 
		.woocommerce-page .quantity .plus, 
		.woocommerce #content .quantity .plus, 
		.woocommerce-page #content .quantity .plus,
		.woocommerce-tabs .nav-tabs>li.active>a, 
		.woocommerce-tabs .nav-tabs>li.active>a:hover, 
		.woocommerce-tabs .nav-tabs>li.active>a:focus,
		.woocommerce-tabs .nav>li>a:hover, 
		.woocommerce-tabs .nav>li>a:focus,
		.woocommerce .woocommerce-message,
		.woocommerce-page .woocommerce-message,
		.woocommerce .woocommerce-info,
		.woocommerce-page .woocommerce-info,
		.features-list,
		.feature-img-wrapper, 
		.map-content, 
		.pricing-plan .plan-price, 
		.page-template-homepage-php .header #main-menu .nav>li>a:before,
		.page-template-homepage-php .header #main-menu .nav>li.active>a:before,		
		#main-menu .nav>li>ul li a:before,
		#main-menu .nav>li>ul li.active a:before,
		.review-image-wrapper .comments a,
		.testimonial-carousel-control:hover,
		.themeum_button_shortcode:hover,
		.span-title2:before,
		.portfolio-filter li a:before,
		.thumb-overlay a,
		.portfolio-title:after,
		.box-content .box-btn:hover,
		.list.list-number-background li:before,
		.drop-cap:first-letter,
		.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a:hover, 
		.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav .ui-tabs-active a,
		.subtitle h2::after,
		.tribe-events-page-title::after,
		.tribe-events-calendar th,
		.tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-],
		#tribe-events .tribe-events-button, .tribe-events-button,
		.wpb_wrapper .wpb_accordion .wpb_accordion_wrapper .wpb_accordion_header.ui-accordion-header-active,
		.load-more,
		.product-thumbnail-outer:after, .product-thumbnail-outer:before, .product-thumbnail-outer-inner:after, .product-thumbnail-outer-inner:before,
		.btn-pricing, .calender-date,.home-search,#single-portfolio .previous-post a:hover, #single-portfolio .next-post a:hover,
		.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
		.woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content { background-color: '. $link_color .'!important; }';

		$output .= '.style-title1:after,.review-item-text .entry-title a,.testimonial-carousel-control,.box-content .box-btn:hover,
		.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav a:hover, 
		.wpb_content_element .wpb_tour_tabs_wrapper .wpb_tabs_nav .ui-tabs-active a,
		.widget h3.widget_title,
		.entry-title.blog-entry-title,
		.bottom-widget .widget h3.widget_title:after,.widget .tagcloud a:hover,.themeum_button_shortcode:hover,
		#single-portfolio .previous-post a, #single-portfolio .next-post a,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle{ border-color: '. $link_color .' !important; }';		

		$output .= '.title-variation1 .style-title1{ background-color: rgba('.themeum_hex2rgb($link_color).',.8); }';

		$output .= 'a, #mobile-menu ul li:hover > a,
		#mobile-menu ul li.active > a, span.badge,
		.comingsoon .social-share ul li a:hover,
		#comingsoon-countdown .countdown-period,
		.widget .nav > li.active > a, .widget .nav > li:hover > a,
		.widget.widget_mc4wp_widget .button i,
		.navbar-main .dropdown-menu>li>a:hover,
		.navbar-main .dropdown-menu>li>a:focus,
		.widget.widget_mc4wp_widget h3:before,
		.widget .tagcloud a:hover,
		.widget caption, .widget thead th,
		.footer-menu >li >a:hover,
		.entry-link h4,
		.post-content.media h2.entry-title a:hover,
		.widget.widget_rss ul li a,
		.widget.widget_recent_comments ul li a,
		.subtitle h2,
		h2.tribe-events-page-title,
		.entry-qoute blockquote small,
		.format-link .entry-link h4,
		.comments-title,
		#respond .comment-reply-title,
		.comment-list .comment-body .comment-author,
		.entry-meta ul li a,
		.widget-blog-posts .entry-title a:hover,
		.widget ul li a:hover,
		.organic-testimonial .testimonial-desc i,
		.woocommerce .star-rating,
		#main-menu .sub-menu li.active > a,
		.testimonial-carousel-control,
		.list-circle ul li:before,
		.list-star ul li:before,
		.author-company,
		.themeum-feature-box.feature-box-shop,
		#main-menu .sub-menu li:hover > a, .entry-link h4, a, .comingsoon .social-share ul li a:hover, .format-link .entry-header, 
		#comingsoon-countdown .countdown-period, .widget .nav > li.active > a, .widget .nav > li:hover > a, .widget.widget_mc4wp_widget .button i, 
		.navbar-main .dropdown-menu>li>a:hover, .navbar-main .dropdown-menu>li>a:focus, .widget.widget_mc4wp_widget h3:before, 
		.widget .tagcloud a:hover, .widget caption, .widget thead th, .footer-menu >li >a:hover,.woocommerce-page #content div.product p.price{ color: '. $link_color .'; }';
		
		$output .= '.progress-bar, input[type="submit"], .single-post .post-navigation, .widget .nav, .book_wrapper a.btn-download, .btn-commom, .profile-tab ul.nav-tabs>li>a:hover, .profile-tab ul.nav-tabs>li.active>a, .profile-tab ul.nav-tabs>li.active>a:hover, .profile-tab ul.nav-tabs>li.active>a:focus, .pagination>.active>a, .pagination>.active>span, .pagination>.active>a:hover, .pagination>.active>span:hover, .pagination>.active>a:focus, .pagination>.active>span:focus, .pagination>li>a:hover, .pagination>li>span:hover, .pagination>li>a:focus, .pagination>li>span:focus, .single-post .post-navigation .post-controller .previous-post a, .single-post .post-navigation .post-controller .next-post a, .post-content.media .post-format i, #searchform .btn-search, #blog-gallery-slider .carousel-control.left, #blog-gallery-slider .carousel-control.right{ background: '. $link_color .'; }';
	}

	if(isset($themeum_options['hover-color'])){
		$output .= 'a:hover,.post-content.media h2.entry-title a:hover,.review-item-text .entry-title a:hover{ color: '.$themeum_options['hover-color'] .'; }';
		$output .= '.wpb_wrapper .wpb_accordion .wpb_accordion_wrapper .ui-state-active .ui-icon,.btn-commom:hover,.product-thumbnail-outer .addtocart-btn:before, a.load-more:hover,.featured .pricing-plan .plan-title{ background-color: '.$themeum_options['hover-color'] .' !important; }';
	}


if(isset($themeum_options['header-bg'])){
	$output .= '.header{ background: '.$themeum_options['header-bg'] .'; }';
}

if ($themeum_options['header-fixed']){
	$stickybg = $themeum_options['sticky-bg'];
	if(isset($stickybg)){
		$output .= '#masthead.sticky{ background-color: rgba('.themeum_hex2rgb($stickybg).',.85); }';
	}

	$output .= '#masthead.sticky{ position:fixed; z-index:99999;margin:0 auto 30px; width:100%;}';
	$output .= '#masthead.sticky .navbar.navbar-default{ background: rgba(255,255,255,.95); border-bottom:1px solid #f5f5f5}';

	$output .= "header.sticky {
	  position: fixed;
	  top: -165px;
	  left: 0;
	  right: 0;
	  z-index: 999;
	  -webkit-transition: 0.2s top cubic-bezier(.3,.73,.3,.74);
	  -moz-transition: 0.2s top cubic-bezier(.3,.73,.3,.74);
	  -ms-transition: 0.2s top cubic-bezier(.3,.73,.3,.74);
	  -o-transition: 0.2s top cubic-bezier(.3,.73,.3,.74);
	  transition: 0.2s top cubic-bezier(.3,.73,.3,.74);
	}
	body.down header.sticky { top: 0; }body.down.admin-bar header.sticky{ top: 32px; }";


}

if(isset($themeum_options['header-margin-top'])){
	$output .= '.header{ margin-top: '. (int) $themeum_options['header-margin-top'] .'px; }';
}

if(isset($themeum_options['header-margin-bottom'])){
	$output .= '.header{ margin-bottom: '. (int) $themeum_options['header-margin-bottom'] .'px; }';
}

if(isset($themeum_options['footer-bg'])){
	$output .= '#footer{ background: '.$themeum_options['footer-bg'] .'; }';
}

if (isset($themeum_options['comingsoon-en']) && $themeum_options['comingsoon-en']) {
	$output .= "body {
		background: #fff;
		display: table;
		width: 100%;
		height: 100%;
		min-height: 100%;
	}";
}

if(isset($themeum_options['custom-css'])){
	$output .= $themeum_options['custom-css'];
}


echo $output;