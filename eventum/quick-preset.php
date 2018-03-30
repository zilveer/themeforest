<?php
header('Content-type: text/css');

$parse_uri = explode('wp-content', $_SERVER['SCRIPT_FILENAME']);
$wp_load = $parse_uri[0].'wp-load.php';
require_once($wp_load);

global $themeum_options;

$output = '';

$link_color = esc_attr($themeum_options['link-color']);
if(isset($themeum_options['custom-preset-en']) && $themeum_options['custom-preset-en']) {

	if(isset($link_color)){
		$output .= '#main-menu .sub-menu li.active, #main-menu .nav>li>ul li:hover,#main-menu .nav>li.fixed-menu a,#comments .form-submit #submit,
		.themeum-pagination .pagination>li.active >a,.themeum-pagination .pagination>li>a:focus, .themeum-pagination .pagination>li>a:hover, 
		.themeum-pagination .pagination>li>span:focus, .themeum-pagination .pagination>li>span:hover,
		.woocommerce .widget_price_filter .price_slider_amount .button,.woocommerce-page .widget_price_filter .price_slider_amount .button,
		.woocommerce .widget_price_filter .ui-slider .ui-slider-range,.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce-product-search input[type=submit],
		.product-thumbnail-outer-inner span.product-cat a,.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, 
		.woocommerce button.button.alt, .woocommerce input.button.alt,.woocommerce input.button,
		.woocommerce nav.woocommerce-pagination ul li span.current,.woocommerce-page nav.woocommerce-pagination ul li span.current,
		.woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current,
		.woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:hover,
		.woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
		.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:focus,
		.woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus,.woocommerce .woocommerce-info,
		#navigation .woocommerce.widget_shopping_cart .buttons > a.wc-forward,.cart-has-products,.woocommerce-tabs .nav-tabs>li>a:after,.widget .tagcloud a,
		.woocommerce .woocommerce-message,.woocommerce-page .woocommerce-message { background-color: '. esc_attr($link_color) .'; }';

		$output .= 'a,a:focus,.btn-style,.post-icon i,.eventum-schedules .table-hover tr:hover a.speaker,.tp-caption.Gym-Button:hover a.btn-white, 
		.tp-caption.rev-btn:hover a.btn-white,  .Gym-Button:hover a.btn-white,.tp-caption.Gym-Button-Light:hover a.btn-white, 
		.Gym-Button-Light:hover a.btn-white,.tp-caption.Gym-Button-Light:hover a.btn-white,#navigation .woocommerce ul.cart_list li a{ color: '. esc_attr($link_color) .'; }';

		$output .= '.tp-caption.Gym-Button-Light:hover, .Gym-Button-Light:hover,.tp-caption.Gym-Button-Light:hover,
		.woocommerce .woocommerce-message,
		.woocommerce.widget_shopping_cart .total,.woocommerce-page.widget_shopping_cart .total,.woocommerce .widget_shopping_cart .total,
		.woocommerce-page .widget_shopping_cart .total,.woocommerce .widget_shopping_cart .total, .woocommerce.widget_shopping_cart .total,.woocommerce div.product .product-thumbnail-outer-inner{ border-color: '. esc_attr($link_color) .' !important; }';
	
		$output .= '.home-contact-form input[type="text"]:focus,.home-contact-form input[type="email"]:focus,
		.home-contact-form textarea:focus,.select-cfrom:focus{ border: 1px solid '. esc_attr($link_color) .'; }';
	}
}

if(isset($themeum_options['custom-preset-en']) && $themeum_options['custom-preset-en']) {
	
	if(isset($themeum_options['hover-color'])){
		$output .= 'a:hover, .widget.widget_rss ul li a{ color: '.esc_attr($themeum_options['hover-color']) .'; }';
		$output .= '.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,.product-thumbnail-outer-inner span.product-cat a:hover,
		.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
		.woocommerce a.button:hover,.woocommerce input.button:hover{ background: '.esc_attr($themeum_options['hover-color']) .'; }';
	}
}


echo $output;echo $output;