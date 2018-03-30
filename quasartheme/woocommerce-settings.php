<?php

/*
**	Rockthemes Default WooCommerce Setting
**
**	
*/

//Activate WooCommerce Settings for WooCommerce Notification
add_theme_support( 'woocommerce' );

//define( 'WOOCOMMERCE_USE_CSS', false );

//Disabled to activate WooCommerce colors
if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
	add_filter( 'woocommerce_enqueue_styles', '__return_false' );
} else {
	define( 'WOOCOMMERCE_USE_CSS', false );
}


function rockthemes_enqueue_woocommerce_css(){
	wp_register_style( 'woocommerce', get_template_directory_uri() . '/css/woocommerce.css' );
	if ( class_exists( 'woocommerce' ) ) {
		wp_enqueue_style( 'woocommerce' );
	}
}
add_action( 'wp_enqueue_scripts', 'rockthemes_enqueue_woocommerce_css' );



//Get Main Font Details
$site_default_font_details = xr_get_option('site_default_font_details',array());
$main_font = 'font-family: "Open Sans", sans-serif;';
if(!empty($site_default_font_details)){
	$main_font = $site_default_font_details['font_family'];
}
$shop_header_font = $main_font;

//Get Main Colors
$main_color = xr_get_option('site_general_color','#00aae8');
$main_font_color = xr_get_option('general_font_color', '#666666');


$rockthemes_woocommerce_settings = array(
	'style'		=>	array(
		'shop_columns'				=>	xr_get_option('woo_shop_product_blocks',2),
		
		'cross_up_sells_total_cart'		=>	((int)xr_get_option('cross_up_sells_total_cart',2)),
		'cross_up_sells_blocks_cart'	=>	((int)xr_get_option('cross_up_sells_blocks_cart',2)),
		
		'cross_up_sells_total_item'		=>	((int)xr_get_option('cross_up_sells_total_item',4)),
		'cross_up_sells_blocks_item'	=>	((int)xr_get_option('cross_up_sells_blocks_item',4)),
		
		'shop_header_font'			=>	$shop_header_font,
		'main_color'				=>	$main_color,
		'main_default_font'			=>	$main_font,
		'main_font_color'			=>	$main_font_color,
		'search_box_color'			=>	xr_get_option('search_box_color', '#FAFAFA'),
		'cart_icon_margin_top'		=>	xr_get_option('cart_icon_margin_top','13px'),
		'cart_icon_margin_bottom'	=>	xr_get_option('cart_icon_margin_bottom','13px'),
		'woo_shop_product_blocks_ipad_portrait' => xr_get_option('woo_shop_product_blocks_ipad_portrait', 2),
		'disable_responsivity'		=> xr_get_option('disable_responsivity',false),

	)

);





function rockthemes_woocommerce_get_columns(){
	global $post, $rockthemes_woocommerce_settings;
	$content = $post->post_content;
	
	if(strpos($content, "recent_products") !== false){
		$dump_content = preg_match("/\[recent_products\s*.*?\]/",$content, $match);
		
		if($match && !empty($match)){
			extract(shortcode_parse_atts($match[0]));
			
			$rockthemes_woocommerce_settings['style']['shop_columns'] = $columns;
		}
	}
	
	if(strpos($content, "featured_products") !== false){
		$dump_content = preg_match("/\[featured_products\s*.*?\]/",$content, $match);
		
		if($match && !empty($match)){
			extract(shortcode_parse_atts($match[0]));
			
			$rockthemes_woocommerce_settings['style']['shop_columns'] = $columns;
		}
	}
	
	return $rockthemes_woocommerce_settings['style']['shop_columns'];
}



//Remove default WooCommerce Hooks
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);



function rockthemes_woocommerce_page_wrapper_before() {

	do_action('rockthemes_pb_frontend_before_page');

	if(function_exists('rockthemes_pb_frontend_sidebar_before_content')) rockthemes_pb_frontend_sidebar_before_content();
	echo '<div id="primary" class="content-area large-'.rockthemes_pb_frontend_get_content_columns_after_sidebars().' column">';

}

function rockthemes_woocommerce_page_wrapper_after() { 
	echo '</div>';
	if(function_exists('rockthemes_pb_frontend_sidebar_after_content')) rockthemes_pb_frontend_sidebar_after_content();
	else get_sidebar();
	
	do_action('rockthemes_pb_frontend_after_page');
	echo '<div class="vertical-space"></div>';
}

add_action('woocommerce_before_main_content', 'rockthemes_woocommerce_page_wrapper_before', 10);
add_action('woocommerce_after_main_content', 'rockthemes_woocommerce_page_wrapper_after', 10);


//WooCommerce Breadcrumb

function rockthemes_woocommerce_breadcrumb($args){
	$args['delimiter']		=	'<li> | </li>';
	$args['wrap_before']	=	'<ul class="quasar-breadcrumbs">';
	$args['wrap_after']		=	'</ul><div class="clear"></div>';
	$args['before']			=	'<li>';
	$args['after']			=	'</li>';
	
	return $args;
	
}
add_filter('woocommerce_breadcrumb_defaults', 'rockthemes_woocommerce_breadcrumb', 1);


function rockthemes_woocommerce_scripts(){

}

add_action('wp_enqueue_script', 'rockthemes_woocommerce_scripts');



function rockthemes_woocommerce_style(){
	global $rockthemes_woocommerce_settings;
?>
	<!-- Rockthemes WooCommerce Style -->
    <style type="text/css">
		/*Sale icon on the products in Shop*/
    	.onsale{z-index:9;}
		
		.payment_methods label,
		.place-order label {
			display: inline-block;
		}		
		/*Plus and Minus icons on the Quantity*/
		.woocommerce .quantity input[type=number].input-text.qty.text{margin-bottom:0px;}
		
		/*General Box Sizing For WooCommerce Elements*/
		.onsale, .woocommerce-message:before,.woocommerce-error:before,.woocommerce-info:before {
			box-sizing:content-box; -moz-box-sizing:content-box; -webkit-box-sizing:content-box;
		}
		
		.onsale, .woocommerce-message,.woocommerce-error,.woocommerce-info {
			font-size:13px !important;	
			box-shadow:inset 0 -2px 6px rgba(0, 0, 0, 0.05), inset 0 -2px 30px rgba(0, 0, 0, 0.015), inset 0 1px 0 #FFF, 0 1px 2px rgba(0, 0, 0, 0.05);
			-webkit-box-shadow:inset 0 -2px 6px rgba(0, 0, 0, 0.05), inset 0 -2px 30px rgba(0, 0, 0, 0.015), inset 0 1px 0 #FFF, 0 1px 2px rgba(0, 0, 0, 0.05);
		}
		
		/*WooCommerce Single Product*/
		.woocommerce .posted_in{font-size:13px; font-weight:600;}
		
				
		.woocommerce .products ul, .woocommerce ul.products, .woocommerce-page .products ul, .woocommerce-page ul.products{
			margin-left:-5px;
			margin-right:-5px;	
		}
		
		.widget.woocommerce li a:hover img{
			transition:all .3s;
			-webkit-transition: all .3s;
			-moz-transition:all .3s;
		}
		
		.woocommerce ul.products li.product:hover, .woocommerce-page ul.products li.product:hover,
		.widget.woocommerce li a:hover img{
			box-shadow:0 0 3px <?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?>;
			-webkit-box-shadow:0 0 3px <?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?>;
			-moz-box-shadow:0 0 3px <?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?>;
			border-radius:4px;
		}
		
		.rockthemes-woo-buttons-container{
			width:100%;
			position:relative;
			/*display:inline-block;	*/
		}
		
		.rockthemes-woo-buttons-container .rockthemes-woo-shop-buttons{
			width:48%;
			margin:0px;
			float:left;	
			display:block;
			position:relative;
			text-align: center;
			padding: 5px;
			border: 1px solid #b4b4b4;
			border-radius: 4px;
		}
		
		.rockthemes-woo-buttons-container .rockthemes-woo-shop-buttons-full{
			margin:0px;
			display:block;
			position:relative;
			text-align: center;
			padding: 5px;
			border: 1px solid #b4b4b4;
			border-radius: 4px;
			float:none;
			width:48%;
			margin:0px auto;
		}
		
		.rockthemes-woo-shop-buttons a{
			background:none !important;
			box-shadow:none !important;
			border:none !important;
			padding:0px !important;
			margin:0px !important;
			font-weight:normal !important;
			vertical-align:baseline !important;
		}
		
		.rockthemes-woo-buttons-container .rockthemes-woo-shop-buttons,
		.rockthemes-woo-buttons-container .rockthemes-woo-shop-buttons a,
		.rockthemes-woo-buttons-container .rockthemes-woo-shop-buttons-full,
		.rockthemes-woo-buttons-container .rockthemes-woo-shop-buttons-full a{
			transition:all .3s;
			-webkit-transition:all .3s;
			-moz-transition:all .3s;
		}
		
		.rockthemes-woo-shop-buttons.right-text{float:right;}
		
		.rockthemes-woo-buttons-container .rockthemes-woo-shop-buttons:hover,
		.rockthemes-woo-buttons-container .rockthemes-woo-shop-buttons-full:hover{
			border-color: <?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?>;
		}
		
		.rockthemes-woo-buttons-container .rockthemes-woo-shop-buttons:hover a,
		.rockthemes-woo-buttons-container .rockthemes-woo-shop-buttons-full:hover a{
			color: <?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?>;
		}
		
		/*Remove WooCommerce Columns*/
		.woocommerce ul.products li.first, .woocommerce-page ul.products li.first{
			clear:none !important;	
		}
		
		.woocommerce ul.products li.product-category.first, .woocommerce-page ul.products li.product-category.first{
			/*Category Display Fix. Only seen once so not activated yet*/
			/*clear:both !important;*/ 
		}	
			
		/*
		.rockthemes-woo-buttons-container .rockthemes-woo-shop-buttons-full{
			width:100%;
			margin:0px;
			float:left;	
			display:block;
			position:relative;
		}
		*/
		
		.woocommerce-rating-overlay{
			position:absolute;
			display:inline-block;	
			bottom:10px;
			left:50%;
			z-index:99;
			margin-left:-43px;
			padding:6px 8px 0px;
			opacity:0;
			filter:alpha(opacity=0);
			transition:all .3s;
			-webkit-transition:all .3s;
			-moz-transition:all .3s;
		}
		
		.woocommerce .star-rating span:before, .woocommerce-page .star-rating span:before{
			color:<?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?>;	
		}
		
		.woocommerce ul.products li.product:hover .woocommerce-rating-overlay, 
		.woocommerce-page ul.products li.product:hover .woocommerce-rating-overlay{
			opacity:0.9;
			filter:alpha(opacity=90);	
		}
		
		.rockthemes-woo-buttons-container .rockthemes-woo-shop-buttons .button,
		.rockthemes-woo-buttons-container .show_details_button,
		.rockthemes-woo-buttons-container .product_type_variable{
			height:auto !important;	
			line-height:20px !important;
			white-space:normal !important;
			display:inline !important;
		}	
				
		.woocommerce ul.products li.product .onsale, .woocommerce-page ul.products li.product .onsale{
			position: absolute;
			right: 18px;
			top: 18px;
			width: 40px;
			height: 40px;
			border-radius: 40px;
			background: <?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?>;
			line-height: 40px;
			text-align: center;
			color:#fff;
		}
		
		.woocommerce ul.products li.product a img, .woocommerce-page ul.products li.product a img{
			margin-bottom:0px;	
		}
		
		.woocommerce ul.products li.product h3, .woocommerce-page ul.products li.product h3{
			<?php echo $rockthemes_woocommerce_settings['style']['shop_header_font']; ?>
			font-size:13px; 
			font-weight:600;
			margin-bottom:0px;
			padding-bottom:15px; 
		}
		
		.woocommerce ul.products li.product a:hover img, .woocommerce-page ul.products li.product a:hover img,
		.woocommerce ul.products li.product a img, .woocommerce-page ul.products li.product a img,
		.woocommerce ul.cart_list li img, .woocommerce ul.product_list_widget li img, .woocommerce-page ul.cart_list li img, 
		.woocommerce-page ul.product_list_widget li img{
			box-shadow:none;
			-webkit-box-shadow:none;
			-moz-box-shadow:none;	
		}
		
		
		.woocommerce ul.products li.product .price, .woocommerce-page ul.products li.product .price{
			margin-bottom:15px;	
			display:inline-block;
		}
		
		.woocommerce ul.products li.product .price del .amount{
			font-size:13px;
			margin-right:5px;	
		}
		
		.woocommerce ul.products li.product .price ins .amount, .woocommerce ul.products li.product span.price > span.amount,
		.woocommerce ul.products li.product .price ins .woocommerce-Price-currencySymbol, 
		.woocommerce ul.products li.product .boxed-layout.boxed-colors .price ins span.woocommerce-Price-currencySymbol,
		.product.woocommerce span.price > span.amount .woocommerce-Price-currencySymbol, 
		.woocommerce ul.products li.product .boxed-layout.boxed-colors span.price > span.amount .woocommerce-Price-currencySymbol, 
		.product.woocommerce ins .amount, .product.woocommerce span.price > span.amount{
			font-size:16px;
			color:<?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?>;
			background:transparent;
		}
		
		/*Price Filter Widget*/
		.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content, .woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content{
			height:5px;
		}
		
		.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range, .woocommerce-page .widget_price_filter .ui-slider-horizontal .ui-slider-range{
			border:none;
			background:<?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?>;
		}
		
		/*Single Product upsells, related, cross selss*/
		.woocommerce div.product span.price, .woocommerce div.product p.price, .woocommerce #content div.product span.price, 
		.woocommerce #content div.product p.price, .woocommerce-page div.product span.price, .woocommerce-page div.product p.price, 
		.woocommerce-page #content div.product span.price, .woocommerce-page #content div.product p.price{
			color:<?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?>;
			font-size:1.25em;
		}
		
		<?php
			$custom_button_color_1 = xr_get_option('custom_button_color_1', '');
			$custom_button_color_2 = xr_get_option('custom_button_color_2', '');
			$custom_button_color_3 = xr_get_option('custom_button_color_3', '');
			$custom_button_color_4 = xr_get_option('custom_button_color_4', '');
			$custom_button_color_5 = xr_get_option('custom_button_color_5', '');
	
			echo '
			.woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, 
			.woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, 
			.woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, 
			.woocommerce-page #content input.button.alt{
				background: '.$custom_button_color_3.'; 
			
				background: -moz-linear-gradient(top,  '.$custom_button_color_2.' 0%, '.$custom_button_color_3.' 82%, '.$custom_button_color_4.' 100%); 
				background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,'.$custom_button_color_2.'), color-stop(82%,'.$custom_button_color_3.'), color-stop(100%,'.$custom_button_color_4.'));
				background: -webkit-linear-gradient(top,  '.$custom_button_color_2.' 0%,'.$custom_button_color_3.' 82%,'.$custom_button_color_4.' 100%);
				background: -o-linear-gradient(top,  '.$custom_button_color_2.' 0%,'.$custom_button_color_3.' 82%,'.$custom_button_color_4.' 100%); 
				background: linear-gradient(to bottom,  '.$custom_button_color_2.' 0%,'.$custom_button_color_3.' 82%,'.$custom_button_color_4.' 100%); 
			  
				border-color: '.$custom_button_color_1.';
				color: white;
				text-shadow: 0 -1px 1px rgba(0, 40, 50, 0.35);
			}
		
			.woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, 
			.woocommerce #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover, .woocommerce-page a.button.alt:hover, 
			.woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, 
			.woocommerce-page #content input.button.alt:hover{
				background-color: '.$custom_button_color_4.';
				background: -webkit-gradient(linear, 50% 0%, 50% 100%, color-stop(0%, '.$custom_button_color_4.'), color-stop(100%, '.$custom_button_color_1.'));
				background: -webkit-linear-gradient(top, '.$custom_button_color_4.', '.$custom_button_color_1.');
				background: -moz-linear-gradient(top, '.$custom_button_color_4.', '.$custom_button_color_1.');
				background: -o-linear-gradient(top, '.$custom_button_color_4.', '.$custom_button_color_1.');
				background: linear-gradient(top, '.$custom_button_color_4.', '.$custom_button_color_1.');
			}
		
			.woocommerce a.button.alt:active, .woocommerce button.button.alt:active, .woocommerce input.button.alt:active, 
			.woocommerce #respond input#submit.alt:active, .woocommerce #content input.button.alt:active, .woocommerce-page a.button.alt:active, 
			.woocommerce-page button.button.alt:active, .woocommerce-page input.button.alt:active, .woocommerce-page #respond input#submit.alt:active, 
			.woocommerce-page #content input.button.alt:active{
				background: '.$custom_button_color_5.';
				color: #EEE;
				text-shadow:none;
			}';
		?>

		.related h2, .upsells h2, .crosssells h2, .cross-sells h2{
			font-size:19px;	
		}
		
		/*Add to cart loader*/
		.woocommerce a.button.loading:before, .woocommerce button.button.loading:before, 
		.woocommerce input.button.loading:before, .woocommerce #respond input#submit.loading:before, 
		.woocommerce #content input.button.loading:before, .woocommerce-page a.button.loading:before, 
		.woocommerce-page button.button.loading:before, .woocommerce-page input.button.loading:before, 
		.woocommerce-page #respond input#submit.loading:before, .woocommerce-page #content input.button.loading:before{
			background-color:transparent !important;
		}
		
		.woocommerce a.button.added:before, .woocommerce button.button.added:before, .woocommerce input.button.added:before, 
		.woocommerce #respond input#submit.added:before, .woocommerce #content input.button.added:before, 
		.woocommerce-page a.button.added:before, .woocommerce-page button.button.added:before, 
		.woocommerce-page input.button.added:before, .woocommerce-page #respond input#submit.added:before, 
		.woocommerce-page #content input.button.added:before{
			display:none !important;	
		}
		
		.woocommerce a.added_to_cart, .woocommerce-page a.added_to_cart{display:none !important;}
		
		/*Menu Cart Widget*/
		.rockthemes-woocommerce-menu-cart{
			width:250px; 
			float:right;
			border-top-right-radius:0px !important;
			border-top-left-radius:0px !important;
			border-bottom-right-radius:0px !important;
			cursor:pointer;
			color:<?php echo $rockthemes_woocommerce_settings['style']['main_font_color']; ?> !important;
		}
		
		.rockthemes-woocommerce-menu-cart *{
			color:<?php echo $rockthemes_woocommerce_settings['style']['main_font_color']; ?>;
		}
		
		.rockthemes-woocommerce-menu-cart, .rockthemes-woocommerce-menu-cart *:not(.widgettitle){
			<?php echo str_replace(";","" ,$rockthemes_woocommerce_settings['style']['main_default_font']); ?> !important;
		}
		
		.woocommerce ul.cart_list li img, .woocommerce ul.product_list_widget li img, 
		.woocommerce-page ul.cart_list li img, .woocommerce-page ul.product_list_widget li img {
			width:64px;
			height:auto;
			max-height:64px;
		}
		
		.woocommerce ul.cart_list li a, .woocommerce ul.product_list_widget li a, 
		.woocommerce-page ul.cart_list li a, .woocommerce-page ul.product_list_widget li a{
			/*margin:15px 0px;*/
		}
		
		.rockthemes-woocommerce-cart-icon:before{
			font-family:'icomoon'; 
			content:"\e037"; 
			display:block;
			line-height:1em; 
			font-size:16px; 
			font-weight:normal;
			speak: none;
			font-style: normal;
			font-weight: normal !important;
			font-variant: normal;
			text-transform: none;
			line-height: 1;
			-webkit-font-smoothing: antialiased;
			margin-left:9px;
 		}
		
		.rockthemes-woocommerce-cart-icon{
			float:left; 
			display:block;
			width:50px;
			margin-left:-20px;
			padding:10px;
			border-top-right-radius:0px !important;
			border-bottom-right-radius:0px !important;
			border-top-left-radius:0px !important;
			border-bottom-left-radius:50px !important;
			height:50px;

			background:<?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?> !important;
			color:#fff !important;
		}
		
		.rockthemes-woocommerce-cart-widget:hover{
			right:0px;
			
		}
		
		.rockthemes-woocommerce-cart-widget:hover .rockthemes-woocommerce-menu-cart{
			box-shadow: 1px 1px 2px rgba(0,0,0, 0.4);
			-moz-box-shadow: 1px 1px 2px rgba(0,0,0, 0.4);
			-webkit-box-shadow: 1px 1px 2px rgba(0,0,0, 0.4);	
		}
		
		.rockthemes-woocommerce-cart-widget{
			position:fixed; 
			width:260px; 
			right:-230px; 
			top:0px; 
			z-index:999;
			transition:all .5s;
			-moz-transition:all .5s;
			-webkit-transition:all .5s;
		}
		
		.rockthemes-woocommerce-menu-cart h2.widgettitle{/*font-size:20px;*/ display:none;}
		
		.woocommerce ul.cart_list li, .woocommerce ul.product_list_widget li, 
		.woocommerce-page ul.cart_list li, .woocommerce-page ul.product_list_widget li{
			border-bottom:1px dashed #dedede;
			padding:15px 0px !important;
		}
		
		.rockthemes-woocommerce-menu-cart .woocommerce ul.cart_list li:hover, 
		.rockthemes-woocommerce-menu-cart .woocommerce ul.product_list_widget li:hover, 
		.rockthemes-woocommerce-menu-cart .woocommerce-page ul.cart_list li:hover, 
		.rockthemes-woocommerce-menu-cart .woocommerce-page ul.product_list_widget li:hover{
			background:#fff;
			background:rgba(255,255,255,0.48);
			margin-left: -15px !important;
			margin-right: -15px !important;
			padding-left: 15px !important;
			padding-right: 15px !important;
		}
		
		/*Menu Cart Icon*/
		.special-cart-container{
			position:relative; 
			margin-top:<?php echo $rockthemes_woocommerce_settings['style']['cart_icon_margin_top']; ?>;
			margin-bottom:<?php echo $rockthemes_woocommerce_settings['style']['cart_icon_margin_bottom']; ?>;
			line-height:16px;
			margin-left:15px !important;
			margin-right:15px !important;
		}
		.special-cart-icon{
			position:relative;
		}
		
		.special-cart-icon .fa-shopping-cart{
			cursor:pointer;
		}
		
		.nav-right-desktop .special-cart-container{margin-left:15px;}
		.special-cart-overlay-box{
			background:<?php echo $rockthemes_woocommerce_settings['style']['search_box_color']; ?> !important;
			position:absolute; 
			right:0px; 
			z-index:99; 
			display:none; 
			margin:0px; padding:0px;
			margin-top:<?php echo $rockthemes_woocommerce_settings['style']['cart_icon_margin_bottom']; ?>;
			border-top-left-radius:0px !important;
			border-top-right-radius:0px !important;
			box-shadow:0px 4px 4px rgba(50, 50, 50, 0.11);
			-moz-box-shadow:0px 4px 4px rgba(50, 50, 50, 0.11);
			-webkit-box-shadow:0px 4px 4px rgba(50, 50, 50, 0.11);
			border:1px solid #d0d0d0;
			border-top:none;
		}
		.special-cart-overlay-box, .special-cart-overlay-box *{
			box-sizing:border-box !important; -webkit-box-sizing:border-box !important; -moz-box-sizing:border-box !important;
		}
		.special-cart-counter{
			background:<?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?>;
			width: 26px;
			height: 26px;
			border-radius: 26px;
			position:relative;
			padding:0px !important;
			position:absolute;
			top:-4px;
			right:-15px;
			text-align:center;
		}
		
		.special-cart-counter .quasar_cart_count{
			line-height:26px;
			font-size: 11px;
			color: #F0F0F0;
		}
		
		.special-cart-container i{
			font-size:26px; 
			display: inline-block;
			position: relative;
			padding-top:9px !important;
		}

		/*Remove any applied menu style to WooCommerce Product List Widget*/
		.special-cart-overlay-box .product_list_widget {
			opacity:1 !important;
			filter:alpha(opacity=100) !important;
			position:relative !important;
			padding:0px !important;
			float:none !important;
			background:none !important;
			border-radius:none !important;
			box-shadow:none !important;
			-webkit-box-shadow:none !important;
			-moz-box-shadow:none !important;
		}
		
		.special-cart-overlay-box .product_list_widget li a{
			font-size:13px !important;
			font-weight:600 !important;
			border:none !important; 
			padding:0px !important;
			color:<?php echo $rockthemes_woocommerce_settings['style']['main_font_color']; ?> !important;
		}
		
		.special-cart-overlay-box .product_list_widget li a:hover{
			color:<?php echo $rockthemes_woocommerce_settings['style']['main_font_color']; ?> !important;
		}
		
		.special-cart-overlay-box .buttons a{
			padding: 3px 10px !important;
			text-align: inherit !important;
			text-transform: none !important;
			display: inline !important;
			font-size: inherit !important;
		}
		
		.special-cart-overlay-box .widget_shopping_cart .total, 
		.special-cart-overlay-box .widget_shopping_cart .total{
			border-top:none !important;	
		}
		
		/*Added to Cart*/
		.rockthemes-woocommerce-added-icon{
			width: 48px;
			height: 48px;
			position: absolute;
			top: 50%;
			left: 50%;
			margin-top: -24px;
			margin-left: -24px;
			background: #FFFFFF;
			border-radius: 4px;	
			opacity:0;
			filter:alpha(opacity=0);
			transition:all .3s;
			-webkit-transition:all .3s;
			-moz-transition:all .3s;
			padding:14px 16px 16px;
		}
				
		.rockthemes-woocommerce-added-icon > img{
			width: 16px !important;
			height: 16px !important;
			margin: auto !important;
			box-shadow:none !important;
			-webkit-box-shadow:none !important;
			-moz-box-shadow: none !important;	
			filter:alpha(opacity=0);/*IE 8 FIX*/
		}
		
		.woocommerce-added-to-cart:hover .rockthemes-woocommerce-added-icon{
			opacity:0.9;
			filter:alpha(opacity=90);
		}
		
		.woocommerce-added-to-cart:hover .rockthemes-woocommerce-added-icon > img{
			opacity:1;
			filter:alpha(opacity=100);
		}
		
		/*Single Product*/
		.woocommerce .content-area .summary.entry-summary > form{
			margin-top:2em;	
		}
		
		.single_add_to_cart_button{
			line-height:100% !important;
			height:28px !important;
		}
		
		.woocommerce .product_meta .posted_in{font-size:13px; font-weight:600; margin-right:15px;}		
		
		.woocommerce .product_meta .posted_in:before{
			font-family: 'icomoon';
			content: "\e02f";
			margin-right: 8px;
			position: relative;
			top: 1px;
			font-weight:normal;
			color:<?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?> !important;
			text-decoration:none !important;
		}
		
		.woocommerce .product_meta .tagged_as{font-size:13px; font-weight:600;}
		
		.woocommerce .product_meta .tagged_as:before{
			font-family: 'icomoon';
			content: "\e031";
			position: relative;
			margin-right: 8px;
			top:1px;
			font-weight:normal;
			color:<?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?> !important;
			text-decoration:none !important;
		}
		
		.woocommerce .product_meta .sku_wrapper{font-size:13px; font-weight:600;}
		
		/*Add Comment to the single product*/
		div.pp_woocommerce .pp_content_container{padding:15px 0px;}
		div.pp_woocommerce .pp_content_container .pp_left {padding:0px 30px;}
		
		#pp_full_res .pp_inline .comment-respond p.form-submit{margin-left:0px; padding:0px;}
		#pp_full_res .pp_inline .comment-respond p.form-submit #comments-submit{margin:0px;}
		
		.pp_pic_holder.pp_woocommerce{max-width:100%;}
		
		/*Variations Table*/
		.woocommerce div.product form.cart .variations td.label, .woocommerce #content div.product form.cart .variations td.label, 
		.woocommerce-page div.product form.cart .variations td.label, 
		.woocommerce-page #content div.product form.cart .variations td.label,
		.woocommerce div.product form.cart .variations td, .woocommerce #content div.product form.cart .variations td, 
		.woocommerce-page div.product form.cart .variations td, .woocommerce-page #content div.product form.cart .variations td{
			padding:15px !important;
		}
		
		.woocommerce div.product form.cart .variations td.label label, 
		.woocommerce #content div.product form.cart .variations td.label label, 
		.woocommerce-page div.product form.cart .variations td.label label, 
		.woocommerce-page #content div.product form.cart .variations td.label label{
			font-weight:600 !important;	
			font-size:13px !important;
		}
		
		.single_variation > *:last-child{margin-bottom:1.25em; display:block;}
		
		/*Product Single Page extra thumbnails*/
		.woocommerce div.product div.images div.thumbnails a, 
		.woocommerce #content div.product div.images div.thumbnails a, 
		.woocommerce-page div.product div.images div.thumbnails a, 
		.woocommerce-page #content div.product div.images div.thumbnails a{
			margin:0px;
			padding:0px 10px;
		}
		
		.woocommerce-page a.button.alt{
			padding:4px 25px !important;
			display:inline;	
		}
		

		/*Cart*/
		.woocommerce .actions .button{height:28px !important; padding-top:3px !important; padding-bottom:3px !important;}
		.cart table{background:transparent;}
		.cart .button{float:none !important;}
		.woocommerce table.shop_table td, .woocommerce-page table.shop_table td,
		.woocommerce .cart-collaterals .cart_totals tr td, .woocommerce .cart-collaterals .cart_totals tr th, 
		.woocommerce-page .cart-collaterals .cart_totals tr td, .woocommerce-page .cart-collaterals .cart_totals tr th{
			padding:15px 12px;
		}
		
		/*Checkout*/
		.woocommerce table.shop_table, .woocommerce-page table.shop_table{border-collapse:collapse !important;}
		.woocommerce #payment ul.payment_methods li img, .woocommerce-page #payment ul.payment_methods li img{display:inline !important;}
		
		/*Special cart add to cart effect*/
		.add_to_cart_motion_img_shadow{
			box-shadow:0px 8px 14px rgba(102, 102, 102, 0.5);	
			-webkit-box-shadow:0px 8px 14px rgba(102, 102, 102, 0.5);	
			-moz-box-shadow:0px 8px 14px rgba(102, 102, 102, 0.5);
		}
		
		.add_to_cart_motion_img_transition{
			transition:all .3s;
			-webkit-transition:all .3s;
			-moz-transition:all .3s;
		}
		
		/*Main Navigation IE fix breaks WooCommerce Cart. This Fix it*/
		#nav ul .widget_shopping_cart_content ul{display:block;}
		
		/*WooCommerce Pagination*/
		.woocommerce-pagination .page-numbers{border-radius:4px;}

		
		/*Widgets*/
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle{
			box-shadow: none;
			width: 14px;
			height: 14px;
			top: -5px;	
		}
				
		/*Shortcodes*/
		p.product.woocommerce a{
			float:right;	
		}
		
		p.product.woocommerce{
			clear:both;
			border:none !important;
			padding:0px !important;	
		}
		
		p.product.woocommerce del, p.product.woocommerce ins{
			display:block;
			margin:5px 0px;	
		}
		
		/*
		**	WooCommerce 2.6 Changes
		*/
		.woocommerce-MyAccount-navigation{
			width:30%;
			float:left;
		}
		.woocommerce-MyAccount-content{
			width:70%;
			float:left;
		}
		.woocommerce-MyAccount-navigation > ul > li.is-active a:not(.escapea):not(.button){
			color: <?php echo $rockthemes_woocommerce_settings['style']['main_color']; ?>;
		}

		<?php
				
		if(!$rockthemes_woocommerce_settings['style']['disable_responsivity']){
			echo '
				@media only screen and (min-width: 540px) and (max-width:768px){	
					.woocommerce ul.products li.product, .woocommerce-page ul.products li.product{
						width: '.(100 / (int) $rockthemes_woocommerce_settings['style']['woo_shop_product_blocks_ipad_portrait']).'%;
					}
				}
				@media only screen and (max-width:768px){
					.woocommerce-MyAccount-navigation,
					.woocommerce-MyAccount-content{
						width:100%;
						float:none;
					}
				}		
				
			';
			
			?>
			
			@media only screen and (min-width: 768px){	
				.woocommerce #content div.product div.images, .woocommerce div.product div.images, 
				.woocommerce-page #content div.product div.images, .woocommerce-page div.product div.images{
					float: left;
					width: 48%;
				}
			
				.woocommerce #content div.product div.summary, .woocommerce div.product div.summary, 
				.woocommerce-page #content div.product div.summary, .woocommerce-page div.product div.summary{
					float: right;
					width: 48%;
				}
			}
			
			<?php
		}
		
		?>
		
	</style>
<?php
}

add_action('wp_head', 'rockthemes_woocommerce_style', 99);


function rockthemes_woocommerce_script(){
?>
<script type="text/javascript">
jQuery(document).ready(function(){
	
	//Remove any columns settings like "first" and "last" from columns
	/*
	if(jQuery(".woocommerce ul.products li.product.last")){
		jQuery(".woocommerce ul.products li.product.last").removeClass("last");
	}
	
	if(jQuery(".woocommerce-page ul.products li.product.last").length){
		jQuery(".woocommerce-page ul.products li.product.last").removeClass("last");
	}
	
	if(jQuery(".woocommerce ul.products li.product.first")){
		jQuery(".woocommerce ul.products li.product.first").removeClass("first");
	}
	
	if(jQuery(".woocommerce-page ul.products li.product.first").length){
		jQuery(".woocommerce-page ul.products li.product.first").removeClass("first");
	}
	*/
	
	jQuery(".special-cart-container").append(jQuery(".special-cart-overlay-box"));
	
	jQuery(document).on("click", ".special-cart-icon .fa-shopping-cart", function(e){
		e.preventDefault();
		
		if(jQuery(".rockthemes-woocommerce-menu-cart").children().length < 1) return;
		
		var overlay_box = jQuery(this).parents(".special-cart-container").find(".special-cart-overlay-box");
		if(overlay_box.hasClass("cart-overlay-open")){
			overlay_box.removeClass("cart-overlay-open").slideUp(100);
		}else{
			overlay_box.addClass("cart-overlay-open").slideDown(300);
		}

	});
		
	jQuery(document).on("mouseup", function (e)
	{
		var container = jQuery(".cart-overlay-open");
	
		if (!container.is(e.target) 
			&& container.has(e.target).length === 0 
			&& !jQuery(".fa.fa-shopping-cart").is(e.target) 
			&& jQuery(".fa.fa-shopping-cart").has(e.target).length === 0)
		{
			if(jQuery(".special-cart-overlay-box").hasClass("cart-overlay-open")){
				jQuery(".special-cart-overlay-box").removeClass("cart-overlay-open").slideUp(100);
			}
		}
	});	
	
	

	jQuery(document).on("click", ".add_to_cart_button", function()
	{
		var product = jQuery(this).parents(".product:eq(0)").addClass("woocommerce-adding-to-cart-ajax").removeClass("woocommerce-added-to-cart");
	})
	
	jQuery(document).on("added_to_cart", function()
	{
		var that = jQuery(".woocommerce-adding-to-cart-ajax");
		that.removeClass("woocommerce-adding-to-cart-ajax").addClass("woocommerce-added-to-cart");
		that.find(" .rockthemes-woocommerce-added-icon").css("opacity","1");
		that.find(" .rockthemes-woocommerce-added-icon > img").css("opacity","1");
		setTimeout(function(){
			that.find(" .rockthemes-woocommerce-added-icon > img").animate({"opacity":"0"},100);
			that.find(" .rockthemes-woocommerce-added-icon").animate({"opacity":"0"}, 180, function(){
				that.find(" .rockthemes-woocommerce-added-icon").attr("style","");
				that.find(" .rockthemes-woocommerce-added-icon > img").attr("style","");
			});
		},1800);
		rockthemes_woo_add_to_cart_motion(that);
	});
	
	function rockthemes_woo_add_to_cart_motion(that){
		var old_img = that.find(".rockthemes-woocommerce-thumbnail > img");
		if(old_img.length < 1){
			//Add to cart used somewhere elser than shop with image
			update_special_cart_icon_count();
			return;
		}
		var effect_img = old_img.clone();
		var old_img_x = parseInt(parseInt(old_img.offset().left));
		var old_img_y = parseInt(parseInt(old_img.offset().top) - jQuery(window).scrollTop());
		
		var cart = jQuery(".special-cart-container .special-cart-icon");
		var cart_x = parseInt(parseInt(cart.offset().left));
		var cart_y = parseInt(parseInt(cart.offset().top) - jQuery(window).scrollTop());
		effect_img.css({"width":old_img.width(),"height":old_img.height(), "position":"fixed", "zIndex":9999, "left":old_img_x, "top":old_img_y , "opacity":"1"}).addClass("add_to_cart_motion_img_shadow add_to_cart_motion_img_transition");
		jQuery("body").append(effect_img);
		
		var scale_diff_x = (parseInt(old_img.width() * 1.1) - parseInt(old_img.width())) / 2
		var scale_diff_y = (parseInt(old_img.height() * 1.1) - parseInt(old_img.height())) / 2

		
		effect_img.css({"opacity":"1", "width":old_img.width() * 1.1,"height":old_img.height() * 1.1, "position":"fixed", "zIndex":9999, "left":old_img_x - scale_diff_x, "top":old_img_y - scale_diff_y });
		if(Modernizr.csstransitions){
			effect_img.on("transitionend webkitTransitionEnd oTransitionEnd MSTransitionEnd", function(){
				setTimeout(function(){
				effect_img.removeClass("add_to_cart_motion_img_transition")
				.animate({"left":cart_x, "top":cart_y, "width":effect_img.width()/ 10, 
								"height":effect_img.height()/10, "opacity":"0.14"},800, "easeInOutCubic", function(){
									effect_img.remove();	
									update_special_cart_icon_count();
								});
				},100);
			});
		}else{
			setTimeout(function(){
			effect_img.removeClass("add_to_cart_motion_img_transition")
			.animate({"left":cart_x, "top":cart_y, "width":effect_img.width()/ 10, 
							"height":effect_img.height()/10, "opacity":"0.14"},800, "easeInOutCubic", function(){
									effect_img.remove();	
									update_special_cart_icon_count();
							});
			},100);
		}
	}
	
	function update_special_cart_icon_count(){
		var cart = jQuery(".special-cart-counter .quasar_cart_count");
		cart.find(".display-cart-count").html(cart.find(".new_value").html());
			jQuery(".special-cart-counter").addClass("animated shake");
		setTimeout(function(){
			jQuery(".special-cart-counter").removeClass("animated shake");
		}, 450);
	}
	
	
	//WooCommerce Review Tab - Open from the link above title
	jQuery(document).on("click", ".woocommerce-review-link", function(){
		var tab_id = jQuery(this).attr("href");
		var content = jQuery(tab_id).parents(".tabs-motion-content");
		if(typeof content == "undefined") return;
				
		content = content.attr("class").split(" ");
		
		var content_id = "";
		for (var i = 0; i<content.length; i++){
			if(content[i].toString().indexOf("content-") > -1){
				content_id = content[i].toString();
				break;	
			}
		}
		
		if(content_id == "") return;
		
		jQuery(".rock-tab-header[content-ref='"+content_id+"']").trigger("click");
	});
	
});

jQuery(window).load(function(){
	if(typeof update_special_cart_icon_count == "function"){
		update_special_cart_icon_count();	
	}

});
</script>
<?php
}

add_action('wp_footer', 'rockthemes_woocommerce_script');


/*
**	Remove the default WooCommerce Tabs Callback
**	Restyle and change the structure of the regular WooCommerce Tabs.
**	
**	Uses woocommerce_product_tabs hook to get the WooCommerce Tabs Data
**
**	@return	:	Echo Rockthemes Tabs element with WooCommerce Tabs Content
*/
function rockthemes_woocommerce_tabs(){
	$tabs = apply_filters( 'woocommerce_product_tabs', array() );
	
	$shortcode = '';
	$single_tab = '';
	
	if ( ! empty( $tabs ) ) :
		$shortcode = '[rockthemes_tabs tab_type="tab-top" use_shadow="true"]';
		foreach ( $tabs as $key => $tab ) :
		
			$content = '';
			ob_start();
			call_user_func( $tab['callback'], $key, $tab);
			$content = ob_get_contents();
			ob_get_clean();
		
			$single_tab .= '[rockthemes_tabs_single
				title="'.apply_filters( 'woocommerce_product_' . $key . '_tab_title', $tab['title'], $key ).'"]
				'.$content.'
				[/rockthemes_tabs_single]
			';
		endforeach;
		$shortcode .= $single_tab.'[/rockthemes_tabs]';
	endif;
	

	echo '<div class="clear"></div>';

	if($shortcode !== ''){
		echo do_shortcode($shortcode).'<div class="vertical-space"></div>';	
	}
	
	return;
}
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
add_action( 'woocommerce_after_single_product_summary', 'rockthemes_woocommerce_tabs', 10 );


/*
**	WooCommerce loop only shows Add to Cart Button. We will add "read more" button
**
**
*/
function rockthemes_woocommerce_add_to_cart(){
	global $product;

	if ($product->product_type === 'bundle' ){
		$product = new WC_Product_Bundle($product->id);
	}

	$return = '';


	ob_start();
	woocommerce_template_loop_add_to_cart();
	$return = ob_get_clean();


	if(!empty($return)){
		$find_close = strpos($return, '>');

		if ($find_close !== false) {
			if($product->product_type == 'grouped'){
				$return = substr_replace($return,'><i class="fa fa-tasks"></i> ', $find_close , strlen(1));
				$return = str_replace(" button ", " button escape_button_style ", $return);
				$return = '<span class="rockthemes-woo-shop-buttons-full center-text centered-text-responsive">'.$return.'</span>';
				
			}elseif($product->product_type == 'simple'){
				$return = substr_replace($return,'><i class="fa fa-shopping-cart"></i> ', $find_close , strlen(1));
				$return = str_replace(" button ", " button escape_button_style ", $return);
				$return = '<span class="rockthemes-woo-shop-buttons left-text centered-text-responsive">'.$return.'</span>';
				
			}elseif($product->product_type == 'external'){
				$return = substr_replace($return,'><i class="fa-angle-double-right"></i> ', $find_close , strlen(1));
				$return = str_replace(" button ", " button escape_button_style ", $return);
				$return = '<span class="rockthemes-woo-shop-buttons-full center-text centered-text-responsive">'.$return.'</span>';
			}
		}
	}


	if($product->product_type == 'variable'){
		$return = '
		<span class="center-text rockthemes-woo-shop-buttons-full">
			<a class="add_to_cart_button product_type_variable center-text" href="'.get_permalink($product->id).'"><i class="fa fa-tasks"></i> '.__('Options','quasar').'</a>
		</span>
		';
	}

	if($product->product_type == 'simple'){
		$return .= '
		<span class="rockthemes-woo-shop-buttons right-text centered-text-responsive">	
			<a class="show_details_button" href="'.get_permalink($product->id).'"><i class="fa-file-text-o"></i> '.__('Details','quasar').'</a>
		</span>	
		';
	}
	
	$return = '<div class="rockthemes-woo-buttons-container">'.$return.'<div class="clear"></div></div>';

	echo $return;
}
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
add_action( 'woocommerce_after_shop_loop_item', 'rockthemes_woocommerce_add_to_cart', 16);

add_filter('add_to_cart_text', 'woo_custom_cart_button_text_single');
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_cart_button_text_single' );
//add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_cart_button_text_single' );

function woo_custom_cart_button_text_single() {
	return __('Add', 'quasar');
}





function rockthemes_woocommerce_alter_thumbnail()
{
	global $product, $post;
	$rating = $product->get_rating_html(); //get rating

	$id = get_the_ID();
	$featured_image_size = 'shop_catalog';
		
	$return = '<div class="relative-container rockthemes-woocommerce-thumbnail">';
	
		$return .= get_the_post_thumbnail($id,$featured_image_size);
		
		$return .= '			
			<div class="rockthemes-woocommerce-added-icon">
				<img src="'.F_WAY.'/images/icomoon/checkmark.svg" class="use_svg" />
			</div>
		';		
		
		if($rating){
			$return .= '<span class="woocommerce-rating-overlay boxed-layout">'.$rating.'</span>';
		}
		
	$return .= '</div>';
	
	echo $return;
}
add_action( 'woocommerce_before_shop_loop_item_title', 'rockthemes_woocommerce_alter_thumbnail', 10);
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);




/*
**	Wrap the description area with boxed layout
*/
add_action( 'woocommerce_before_shop_loop_item_title', 'rockthemes_woocommerce_shop_before_description', 30);
function rockthemes_woocommerce_shop_before_description(){
	echo '<div class="boxed-layout boxed-colors padding no-top-border-radius">';
}

add_action( 'woocommerce_after_shop_loop_item',  'rockthemes_woocommerce_shop_after_description', 1000);
function rockthemes_woocommerce_shop_after_description(){
	echo '</div>';
}

//remove woo rating from shop loop
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 ); //remove rating


/*
**	Adds WooCommerce Cart Icon to menu. This function will be called from "header-models.php" file
**
**	@params	:	Filter Params
*/

if(!function_exists('rockthemes_add_cart_icon_to_menu')){
	function rockthemes_add_cart_icon_to_menu($items, $args) {
  		if( $args->theme_location !== 'primary' ) return $items;
		global $woocommerce;
		

		
		$cart_icon = '
			<div class="special-cart-container">
				<div class="special-cart-icon">
					<i class="fa fa-shopping-cart"></i>
					<div class="special-cart-counter">
						<div class="cart-contents">
							<div class="quasar_cart_count"><span class="display-cart-count">'.$woocommerce->cart->cart_contents_count.'</span><span class="hide new_value"></span></div>
						</div>
					</div>
				</div>
				'.rockthemes_get_woocommerce_cart_widget().'
			</div>		
		';
  
        $car_menu_item =
                '<li class="right">' .
                $args->before .
				$cart_icon.
                $args->after .
                '</li>';
  
        $items = $items.$car_menu_item;
  
		return $items;
	}
}

//Woocommerce dynamic cart
//add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
if ( version_compare( WOOCOMMERCE_VERSION, "2.3" ) >= 0 ) {
	add_filter('woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
}else{
	add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');
}

 
function woocommerce_header_add_to_cart_fragment( $fragments ) {

	global $woocommerce;
	ob_start();
	?>
	<span class="hide new_value"><?php echo $woocommerce->cart->cart_contents_count; ?></span>
	<?php
	$fragments['.quasar_cart_count span.new_value'] = ob_get_clean();
	return $fragments;
}


function rockthemes_get_woocommerce_cart_widget(){
	global $woocommerce;
	$wooCommerceWidget;

	echo '
	<div class="special-cart-overlay-box boxed-layout" style="display:none;">
		<div class="rockthemes-woocommerce-menu-cart padding">';

	if ( version_compare( WOOCOMMERCE_VERSION, "2.0.0" ) >= 0 ) {
		the_widget( 'WC_Widget_Cart', 'title=' );
	} else {
		the_widget( 'WooCommerce_Widget_Cart', 'title=' );
	}
			
	echo '
		</div>
	</div>';
}


function rockthemes_get_woocommerce_cart_fragments($fragments){
	global $woocommerce;
	ob_start();
	rockthemes_get_woocommerce_cart_widget();
	$fragments['a.cart-parent'] = ob_get_clean();
	return $fragments;
}
add_filter( 'add_to_cart_fragments',  'rockthemes_get_woocommerce_cart_fragments' ); // The cart fragment


function rockthemes_woocommerce_ajax_added_to_cart($atts){
	return '';
}
add_filter('woocommerce_ajax_added_to_cart', 'rockthemes_woocommerce_ajax_added_to_cart',1);



/*
**	Related Products and Upsells
*/


// Change number or products per row to 3
if (!function_exists('rockthemes_woocommerce_loop_columns')) {
	function rockthemes_woocommerce_loop_columns() {
		return function_exists('xr_get_option') ? xr_get_option('woo_shop_blocks_large','3') : 3;
		// 3 products per row
	}
}
add_filter('loop_shop_columns', 'rockthemes_woocommerce_loop_columns');



remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);
remove_action( 'woocommerce_after_single_product', 'woocommerce_output_related_products',10);
add_action( 'woocommerce_after_single_product_summary', 'rockthemes_woocommerce_related', 20);

function rockthemes_woocommerce_related(){
	global $rockthemes_woocommerce_settings;
	
	$total = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_total_cart'];;
	$blocks = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_blocks_cart'];
	if(is_product()){
		//TO DO : Bind to an option
		//$total = 4;	
		$total = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_total_item'];;
		$blocks = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_blocks_item'];
	}
	
	if ( version_compare( WOOCOMMERCE_VERSION, "2.1" ) >= 0 ) {
		$args = array(
			'posts_per_page'	=>	$total,
			'columns'			=>	$blocks,
			'orderby'			=>	'rand'
		);
		woocommerce_related_products($args); 
	} else {
		woocommerce_related_products($total, $blocks); 
	}
}


remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product', 'woocommerce_upsell_display',10);
add_action( 'woocommerce_after_single_product_summary', 'rockthemes_woocommerce_upsells', 21);

function rockthemes_woocommerce_upsells(){
	global $rockthemes_woocommerce_settings;

	$total = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_total_cart'];;
	$blocks = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_blocks_cart'];

	if(is_product()){
		$total = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_total_item'];;
		$blocks = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_blocks_item'];
	}

	woocommerce_upsell_display($total, $blocks); 
}



add_filter('woocommerce_cross_sells_total', 'rockthemes_woocommerce_cross_total');
function rockthemes_woocommerce_cross_total($count)
{
	global $rockthemes_woocommerce_settings;
	
	$total = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_total_cart'];
	if(is_product()){
		$total = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_total_item'];
	}

	return $total;
}

add_filter('woocommerce_cross_sells_columns', 'rockthemes_woocommerce_cross_columns');
function rockthemes_woocommerce_cross_columns($count)
{
	global $rockthemes_woocommerce_settings;
	
	$blocks = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_blocks_cart'];
	if(is_product()){
		$blocks = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_blocks_item'];
	}

	return $blocks;
}



/*
**	We use WooCommerce template file to add our shop columns templates/loop/loop-start.php
**
*/
function rockthemes_woo_shop_columns_class(){
	global $woocommerce_loop, $rockthemes_woocommerce_settings;
	
	
	$return = '';
	
	if(is_product()){
		$woocommerce_loop['columns'] = (int)$rockthemes_woocommerce_settings['style']['cross_up_sells_blocks_item'];
	}
		
	if(isset($woocommerce_loop['columns']) && $woocommerce_loop['columns'] && $woocommerce_loop['columns'] !== '' && function_exists('xr_get_option')){
		//For cross-sells, up-sell, related
		$return = 'large-block-grid-'.$woocommerce_loop['columns'].' ';
		$return .= 'medium-block-grid-'.xr_get_option('woo_shop_blocks_medium', '3').' ';
		$return .= 'small-block-grid-'.xr_get_option('woo_shop_blocks_small', '1').' ';
	}elseif(function_exists('xr_get_option')){
		$return = 'large-block-grid-'.xr_get_option('woo_shop_blocks_large','4').' ';
		$return .= 'medium-block-grid-'.xr_get_option('woo_shop_blocks_medium', '3').' ';
		$return .= 'small-block-grid-'.xr_get_option('woo_shop_blocks_small', '1').' ';
	}else{
		$return = 'large-block-grid-4 medium-block-grid-3 small-block-grid-1';	
	}
	
	if(xr_get_option('woo_wall_mode', true)){
		$return .= 'block-collapse ';
	}
	
	$return .= 'woo-remove-ul-space';
	
	return $return;
}




?>