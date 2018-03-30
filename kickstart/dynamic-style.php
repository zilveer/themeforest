<?php
/*	
*	---------------------------------------------------------------------
*	MNKY Dynamic Style
*	--------------------------------------------------------------------- 
*/

	header("Content-type: text/css;");
	$current_url = dirname(__FILE__);
	$wp_content_pos = strpos($current_url, 'wp-content');
	$wp_content = substr($current_url, 0, $wp_content_pos);
	require_once($wp_content . 'wp-load.php');
?>
		
		<?php /* General Color */ ?>
		<?php $site_gc = ot_get_option('general_color'); ?>
		.quote-start, a:hover, #footer-widget-area a:hover, .entry-utility a:hover, #primary-main-menu li ul li:hover > a, #primary-main-menu li ul > li.current-menu-item > a, #primary-main-menu li ul > li.current-menu-ancestor > a, #primary-main-menu li ul > li.current_page_parent > a, .wp-pagenavi a:hover, .wp-pagenavi span.current, .su-fancy-link:hover, ul.pf-filter li.active a, .su-tabs-nav span.su-tabs-current .su-tab-icon, .su-tabs-nav span:hover .su-tab-icon, .su-tabs .pane-wrapper .pane-title:hover .su-tab-icon, .su-tabs .pane-wrapper .pane-title.su-tabs-current .su-tab-icon, .su-spoiler-title .spoiler-button.spoiler-active, .su-spoiler-title:hover .spoiler-button, .widget_side_menu  ul li.current-menu-item a, #copyright a:hover, #footer-menu a:hover, .person-title, .quote-author, .service-box i, .fp_carousel .jcarousel-prev:hover, .fp_carousel .jcarousel-next:hover, .tp-caption.kickstart_color, .woocommerce-MyAccount-navigation ul li.is-active a{color:<?php echo $site_gc; ?>;}
				
		.su-button, .sidebar-line span, .background-block, .nivo-directionNav a:hover, .nivo-controlNav a.active, .latest-blog-entry .blog-entry-date span, .link-button a, .post-link, #wp-calendar #today, #footer-widget-area #wp-calendar tbody td#today, .skillbar, input[type="submit"], thead th, .tp-caption.kickstart_button, .tp-caption.kickstart_bgcolor, #header-search-wrapper{background-color:<?php echo $site_gc; ?>;}
				
		ul.pf-filter li.active, .su-pullquote-style-1, .wp-pagenavi a:hover, .wp-pagenavi span.current, .staff-wrapper img, #primary-main-menu > li:hover > a, #primary-main-menu li.search-active a{border-color:<?php echo $site_gc; ?>;}
		.su-callout {border-left-color:<?php echo $site_gc; ?>;}
		#primary-main-menu > li.current-menu-item a:after, #primary-main-menu > li.current-menu-ancestor a:after, #primary-main-menu > li.current_page_parent > a:after, #header-search-wrapper:before, .woocommerce-MyAccount-navigation ul li.is-active {border-bottom-color:<?php echo $site_gc; ?>;} 
		
		<?php $rgb = hex2rgb($site_gc); ?>
		.latest-works ul li .pf-title, .filterable-grid li a.pf-info, .filterable-grid li a.pf-zoom, .filterable-grid .pf-title, .fp_carousel li .fp_title{background-color:<?php echo $site_gc; ?>; background-color:rgba(<?php echo $rgb; ?>, 0.8);}
		
		<?php /* WooCommerce */ ?>
		.woocommerce div.product span.price,.woocommerce div.product p.price,.woocommerce #content div.product span.price,.woocommerce #content div.product p.price,.woocommerce-page div.product span.price,.woocommerce-page div.product p.price,.woocommerce-page #content div.product span.price,.woocommerce-page #content div.product p.price, .woocommerce ul.products li.product .price,.woocommerce-page ul.products li.product .price, .woocommerce .cart-collaterals .cart_totals table .total th, .woocommerce .cart-collaterals .cart_totals table .total td, .woocommerce table.shop_table tfoot .total td,.woocommerce table.shop_table tfoot .total th {color:<?php echo $site_gc; ?>;}
		
		.woocommerce a.button,.woocommerce button.button,.woocommerce input.button,.woocommerce #respond input#submit,.woocommerce #content input.button,.woocommerce-page a.button,.woocommerce-page button.button,.woocommerce-page input.button,.woocommerce-page #respond input#submit,.woocommerce-page #content input.button, .woocommerce span.onsale,.woocommerce-page span.onsale, .woocommerce a.button.alt,.woocommerce button.button.alt,.woocommerce input.button.alt,.woocommerce #respond input#submit.alt,.woocommerce #content input.button.alt,.woocommerce-page a.button.alt,.woocommerce-page button.button.alt,.woocommerce-page input.button.alt,.woocommerce-page #respond input#submit.alt,.woocommerce-page #content input.button.alt, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle,.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle {background-color:<?php echo $site_gc; ?>;}

				
		body{
		<?php 
		$body_bg = ot_get_option('body_background');
		echo 'background-color:'. $body_bg['background-color'] .';'; 
		if (ot_get_option('use_background_pattern')) {
			echo 'background-image: url(images/pattern/'. ot_get_option('background_pattern', 'pattern_1') .'.png);';
			echo 'background-attachment:'. $body_bg['background-attachment'] .';'; 			
			echo 'background-repeat:repeat; 
			background-position: center;'; 
		} elseif (ot_get_option('cover_background')) {
			echo 'background-image: url('. $body_bg['background-image'] .');'; 
			echo 'background-repeat:no-repeat; 
			background-position: center; 
			background-attachment:fixed;
			-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;'; 
		} else {
			echo 'background-image: url('. $body_bg['background-image'] .');'; 
			echo 'background-repeat:'. $body_bg['background-repeat'] .';'; 
			echo 'background-position:'. $body_bg['background-position'] .';'; 
			echo 'background-attachment:'. $body_bg['background-attachment'] .';'; 
		}
		?>
		}
		
		body {
		<?php
		$google_body_font = ot_get_option('google_body_font');
		$body_font_family = $google_body_font['font-family'];
		$body_font_family = str_replace("+", " ", $body_font_family);
		echo 'font-family:'. $body_font_family .', sans-serif;';
		echo 'font-weight:'. $google_body_font['font-weight'] .';'; 
		echo 'letter-spacing:'.$google_body_font['letter-spacing'] .';'; 
		echo 'text-transform:'. $google_body_font['text-transform'] .';'; 
		echo 'color:'. ot_get_option('content_text_color') .';'; 
		echo 'font-size:'. ot_get_option('content_text_font_size') .';'; 
		?>
		}
		
		input[type='submit']{
		font-family:<?php echo $body_font_family; ?>, sans-serif;
		}
		
		#primary-main-menu {
		<?php
		$google_menu_font = ot_get_option('google_menu_font');
		$menu_font_family = $google_menu_font['font-family'];
		$menu_font_family = str_replace("+", " ", $menu_font_family);
		echo 'font-family:'. $menu_font_family .', sans-serif;';
		echo 'font-weight:'. $google_menu_font['font-weight'] .';'; 
		echo 'letter-spacing:'. $google_menu_font['letter-spacing'] .';'; 
		echo 'text-transform:'. $google_menu_font['text-transform'] .';'; 
		?>
		}
		
		.page-title h1 {
		<?php
		$google_page_font = ot_get_option('google_page_font');
		$page_font_family = $google_page_font['font-family'];
		$page_font_family = str_replace("+", " ", $page_font_family);
		echo 'font-family:'. $page_font_family .', sans-serif;';
		echo 'font-weight:'. $google_page_font['font-weight'] .';'; 
		echo 'letter-spacing:'. $google_page_font['letter-spacing'] .';'; 
		echo 'text-transform:'. $google_page_font['text-transform'] .';'; 
		?>
		}
		
		#default-widget-area .xoxo li .widget-title, #footer-widget-area .widget-area .widget-title {
		<?php
		$google_widget_font = ot_get_option('widget_font_family');
		$widget_font_family = $google_widget_font['font-family'];
		$widget_font_family = str_replace("+", " ", $widget_font_family);
		echo 'font-family:'. $widget_font_family .', sans-serif;';
		echo 'font-weight:'. $google_widget_font['font-weight'] .';'; 
		echo 'letter-spacing:'. $google_widget_font['letter-spacing'] .';'; 
		echo 'text-transform:'. $google_widget_font['text-transform'] .';'; 
		?>
		}
		
		h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, h2.post-title, .su-tabs .su-tabs-nav span, .su-tabs .pane-title, .su_au_name, .su-pricing-title, .su-pricing-value, .post_slider .info h2, .recent_post_widget_title, .tp-caption.kickstart_heading {
		<?php
		$google_fonts_headings = ot_get_option('google_fonts_headings');
		$headings_font_family = $google_fonts_headings['font-family'];
		$headings_font_family = str_replace("+", " ", $headings_font_family);
		echo 'font-family:'. $headings_font_family .', sans-serif;';
		echo 'font-weight:'. $google_fonts_headings['font-weight'] .';'; 
		echo 'letter-spacing:'. $google_fonts_headings['letter-spacing'] .';'; 
		echo 'text-transform:'. $google_fonts_headings['text-transform'] .';'; 
		?>
		}
		
		.custom-font{
		<?php
		$google_custom_font = ot_get_option('google_custom_font');
		$custom_font_family = $google_custom_font['font-family'];
		$custom_font_family = str_replace("+", " ", $custom_font_family);
		echo 'font-family:'. $custom_font_family .', sans-serif;';
		echo 'font-weight:'. $google_custom_font['font-weight'] .';'; 
		echo 'letter-spacing:'. $google_custom_font['letter-spacing'] .';'; 
		echo 'text-transform:'. $google_custom_font['text-transform'] .';'; 
		?>
		}
				
		body a, ul#filter a {color:<?php echo ot_get_option('link_color'); ?>;}		
		.mnky-breadcrumbs, .mnky-breadcrumbs a{color:<?php echo ot_get_option('breadcrumb_color'); ?>;}
		ul#filter li.current a { color:<?php echo ot_get_option('content_text_color'); ?>;}
		
		h1, h2, h3, h4, h5, h6, h1 a, h2 a, h3 a, h4 a, h5 a, h6 a, .su-service-title, .su-tabs .su-tabs-nav span, .su-tabs .pane-title, .su_au_name, .heading-wrapper h6, .su-spoiler-title {color:<?php echo ot_get_option('heading_color'); ?>;}
		
		h1{font-size:<?php echo ot_get_option('h1_size'); ?>;}
		h2{font-size:<?php echo ot_get_option('h2_size'); ?>;}
		h3{font-size:<?php echo ot_get_option('h3_size'); ?>;}
		h4{font-size:<?php echo ot_get_option('h4_size'); ?>;}
		h5{font-size:<?php echo ot_get_option('h5_size'); ?>;}
		h6{font-size:<?php echo ot_get_option('h6_size'); ?>;}
		
		#header-wrapper{
		<?php 
		$header_bg = ot_get_option('header_background');
		echo 'background-color:'. $header_bg['background-color'] .';'; 
		echo 'background-image: url('. $header_bg['background-image'] .');'; 
		echo 'background-repeat:'. $header_bg['background-repeat'] .';'; 
		echo 'background-position:'. $header_bg['background-position'] .';'; 
		?>
		}
		
		#title-wrapper{
		<?php 
		$title_bg = ot_get_option('title_background');
		echo 'background-color:'. $title_bg['background-color'] .';'; 
		echo 'background-image: url('. $title_bg['background-image'] .');'; 
		echo 'background-repeat:'. $title_bg['background-repeat'] .';'; 
		echo 'background-position:'. $title_bg['background-position'] .';'; 
		echo 'background-attachment:'. $title_bg['background-attachment'] .';'; 
		echo 'border-color:'. ot_get_option('title_area_border') .';'; 
		?>
		-webkit-background-size: <?php echo ot_get_option('title_area_background_size'); ?>;
		-moz-background-size: <?php echo ot_get_option('title_area_background_size'); ?>;
		-o-background-size: <?php echo ot_get_option('title_area_background_size'); ?>;
		background-size: <?php echo ot_get_option('title_area_background_size'); ?>;
		}
		
		<?php if (!ot_get_option('header_shadow')) { 
			echo '#header-wrapper:after {content: ""; background:url(images/header-shadow.png) no-repeat 50% 100%; position:absolute; width:100%; height:47px; margin-top: 1px;}
			.default-header #header-wrapper:after, .no-title-wrapper #header-wrapper:after{display:none;}
			#title-wrapper .header-shadow {background:url(images/header-shadow.png) no-repeat 50% 100%; position:absolute; width:100%; height:47px; top:0;}';
		} ?>
		
		#header {height:<?php echo ot_get_option('horizontal_menu_height'); ?>;}
		#header #logo {margin-left:<?php echo ot_get_option('logo_margin_left'); ?>; margin-bottom:<?php echo ot_get_option('logo_margin_bottom'); ?>;}
		
		#primary-main-menu{font-size:<?php echo ot_get_option('menu_font_size'); ?>;}
		#primary-main-menu li{padding-bottom:<?php echo ot_get_option('menu_margin_bottom'); ?>;}
		<?php if(ot_get_option('menu_margin_bottom')) {
			$menu_margin_bottom = ot_get_option('menu_margin_bottom');
			$menu_margin_bottom = str_replace("px", "", $menu_margin_bottom);
			$menu_margin_bottom = $menu_margin_bottom+2 .'px';
			echo '#primary-main-menu > li.current-menu-item, #primary-main-menu > li.current-menu-ancestor,  #primary-main-menu > li.current_page_parent {padding-bottom:'. $menu_margin_bottom .';}';
		} ?>
		#primary-main-menu li a{color:<?php echo ot_get_option('menu_opt_link_color'); ?>; border-color:<?php echo ot_get_option('menu_bottom_border'); ?>;}
		#primary-main-menu li ul li a{background-color:<?php echo ot_get_option('submenu_bg_color'); ?>;}
		#primary-main-menu li ul li a{color:<?php echo ot_get_option('submenu_link_color'); ?>;}

		#footer-wrapper {background-color:<?php echo ot_get_option('footer_bg_color'); ?>;}				
		#copyright-wrapper {background-color:<?php echo ot_get_option('copyright_bg_color'); ?>;}				
		#footer-widget-area .widget-area .widget-title {color:<?php echo ot_get_option('footer_title_color'); ?>;}				
		#footer-wrapper, #copyright {color:<?php echo ot_get_option('footer_content_text_color'); ?>;}
		#footer-wrapper a, #copyright a, #footer-menu a {color:<?php echo ot_get_option('footer_link_color'); ?>;}
								
		.page-title h1{color:<?php echo ot_get_option('page_title_color'); ?>;}
		.page-title h1 {
		text-shadow: <?php echo ot_get_option('page_title_shadow'); ?>; 
		background: <?php echo ot_get_option('page_title_background'); ?>;
		}
		
		#header-wrapper #header-widget-area ul.xoxo{margin-top:<?php echo ot_get_option('header_widget_area_top'); ?>;}
		#top-bar-wrapper{background-color:<?php echo ot_get_option('top_bar_background_color'); ?>;}
		#top-bar-wrapper #top-bar, #top-bar-wrapper #top-bar a{color:<?php echo ot_get_option('top_bar_text_color', '#8B8B8B'); ?>;}
		
		#orbit-wrapper, #orbit-content{ height: <?php echo ot_get_option('orbit_height', '350px') ?> !important;}
		
		<?php 	
			$orbit_height = ot_get_option('orbit_height', '350px');
			$orbit_height = str_replace("px", "", $orbit_height);

			if (ot_get_option('responsive_layout') == 'responsive_mobile' || ot_get_option('responsive_layout') == 'responsive_all' ) { ?>
			@media only screen and (min-width: 480px) and (max-width: 767px) {
				<?php
				$orbit_height_mobile =  round($orbit_height*0.46+2);
				echo '#orbit-wrapper, #orbit-content{height:'.$orbit_height_mobile.'px !important;}'
				?>
			}
			@media only screen and (max-width: 479px) {
				<?php
				$orbit_height_mobile = round($orbit_height*0.32);
				echo '#orbit-wrapper, #orbit-content{height:'.$orbit_height_mobile.'px !important;}'
				?>
			}
		<?php }
		
			if (ot_get_option('responsive_layout') == 'responsive_all') {?>
			@media only screen and (min-width: 768px) and (max-width: 979px) {
				<?php
				$orbit_height_mobile = round($orbit_height*0.74);
				echo '#orbit-wrapper, #orbit-content{height:'.$orbit_height_mobile.'px !important;}'
				?>				
			}
		<?php } ?>
		
		
		<?php if (ot_get_option('mobile-menu-simple')){ ?>
			@media only screen and (min-width: 768px) and (max-width: 979px) {
				.toggleMenu{display:none !important;}
			}
			
			@media only screen and (max-width: 767px) {
				#header {padding-top:35px !important; height:auto !important;}
				.toggleMenu{display:none !important;}
				#menu-wrapper{position:relative !important;}
			}
		<?php } ?>		

		
		<?php /* Custom CSS from panel */ ?>
		<?php echo ot_get_option('custom_css'); ?>