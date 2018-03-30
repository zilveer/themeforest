<?php

function espresso_custom_styling(){
	
	global $template_dir, $woocommerce;
	
	?><style type="text/css"><?php
	
		$color_style = ot_get_option('color_style','light');
		
		$main_color = ot_get_option('main_color','#085bc1');
		$main_color_rgb = espresso_hex2rgb($main_color);
		
		$dark_color = ot_get_option('dark_color','#222222');
		$dark_color_rgb = espresso_hex2rgb($dark_color);
		
		$content_color = ot_get_option('content_color','#ffffff');
		$content_color_rgb = espresso_hex2rgb($content_color);
		
		if ($woocommerce):
			$woo_button_color = get_option( 'woocommerce_frontend_css_colors', $main_color );
			if (isset($woo_button_color['primary'])): $woo_button_color = $woo_button_color['primary']; else : $woo_button_color = $main_color; endif;
		else :
			$woo_button_color = $main_color;
		endif;
		
		$boxed_style = ot_get_option('boxed_style','');
		
		if ($boxed_style){
			$background_color = ot_get_option('background_color','#fff');
			$background_image = ot_get_option('background_image','#');
			$background_repeat = ot_get_option('background_image_repeat','no-repeat');
			$background_position = ot_get_option('background_image_position','top center');
			$background_attachment = ot_get_option('background_image_attachment','static');
		} else {
			$background_color = '#fff';
			$background_image = '#';
			$background_repeat = 'no-repeat';
			$background_position = 'top center';
			$background_attachment = 'static';
		}

		$font = ot_get_option('custom_font');
		if (!$font){ $font = 'Raleway'; }
		if ($font != 'sans-serif'){ $font = "'".str_replace('+',' ',$font)."', sans-serif"; }
		
		?>
		/* WOOCOMMERCE */
		.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #review_form #submit, .woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
		.woocommerce div.product form.cart .button, .woocommerce #content div.product form.cart .button, .woocommerce-page div.product form.cart .button, .woocommerce-page #content div.product form.cart .button,
		.woocommerce #review_form #respond .form-submit input, .woocommerce-page #review_form #respond .form-submit input {
		background:<?php echo $woo_button_color; ?>; color:#fff; }
		
		.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #review_form #submit:hover, .woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover,
		.woocommerce div.product form.cart .button:hover, .woocommerce #content div.product form.cart .button:hover, .woocommerce-page div.product form.cart .button:hover, .woocommerce-page #content div.product form.cart .button:hover,
		.woocommerce #review_form #respond .form-submit input:hover, .woocommerce-page #review_form #respond .form-submit input:hover {
		background:#333; color:#fff; }
		
		.woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page #content input.button.alt {
		background:<?php echo $woo_button_color; ?>; color:#fff; }
		
		.woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page #content input.button.alt:hover {
		background:#333; color:#fff; }
	
		
		/* CONTENT COLOR */
		body, h2.centered span, h1.page-title span { background:<?php echo $content_color; ?>; }
		
		header#header,
		a.es-button,
		#ctas article h3,
		.colored-block,
		#searchform input.es-button,
		#wp-calendar caption,
		.widget-button,
		p.tribe-events-widget-link a,
		#respond input#submit,
		input.wpcf7-submit,
		ol.commentlist li.comment div.reply a,
		nav#main-nav .dropdown,
		#cancel-comment-reply-link,
		.slicknav_nav .slicknav_item:hover,
		.slicknav_nav a:hover,
		.slicknav_btn,
		#pagination ul li a,
		.gform_wrapper .gform_footer input.button,
		.gform_wrapper .gform_footer input[type=submit], button[type=submit] { background:<?php echo $main_color; ?> !important; }
		a, #homepage-events article small span, #footer-widgets article.hours-block p.right, #respond span.required, #page-post article.page-content h3, section.social-search .search form input[type=submit] { color:<?php echo $main_color; ?>; }
		nav#main-nav.full ul li a:hover { background:rgba(<?php echo $main_color_rgb[0]; ?>, <?php echo $main_color_rgb[1]; ?>, <?php echo $main_color_rgb[2]; ?>, 0.25); }
		#footer-widgets .overlay, #mobile-slider .colored-wrap { background:rgba(<?php echo $main_color_rgb[0]; ?>, <?php echo $main_color_rgb[1]; ?>, <?php echo $main_color_rgb[2]; ?>, 0.40) !important; }
		.gform_wrapper .gsection { border-bottom:5px solid <?php echo $main_color; ?> !important; }
		.gform_wrapper input, .gform_wrapper select { color:<?php echo $main_color; ?> !important; }
		
		#recent-tweets h3, #recent-tweets .tweet p, #recent-tweets .tweet small, #recent-tweets .tweet p a, #recent-tweets .tweet small a, #recent-tweets .btn-prev, #recent-tweets .btn-next { color:#fff; }
		
		a.es-button:hover,
		a.es-button.black,
		input[type=button]:hover, input[type=submit]:hover,
		#footer-widgets,
		.widget-button:hover,
		button[type=submit]:hover { background:#000 !important; }
		
		/* Dark Color */
		nav#main-nav.full,
		section#ctas,
		#top,
		.slicknav_menu,
		footer { background:<?php echo $dark_color; ?> !important; }
		
		/* Tribe Events - Main Color */
		#tribe_events_filters_wrapper input[type=submit],
		.tribe-events-button,
		.entry-content .tribe-events-button,
		.tribe-events-button.tribe-inactive,
		.entry-content .tribe-events-button:hover,
		.tribe-events-button:hover,
		.tribe-events-button.tribe-active:hover,
		.tribe-events-read-more,
		.tribe-events-calendar thead th,
		.tribe-events-grid .tribe-grid-header .tribe-grid-content-wrap .column,
		.tribe-grid-header { background:<?php echo $main_color; ?> !important; color:#fff; }
		
		.tribe-events-calendar thead th,
		.tribe-events-grid .tribe-grid-header .tribe-grid-content-wrap .column,
		.tribe-grid-header,
		.es-views-list ul li.tribe-bar-active a { border-color:<?php echo $main_color; ?> !important; }
		
		#tribe-events-content .tribe-events-tooltip h4,
		#tribe_events_filters_wrapper .tribe_events_slider_val,
		.single-tribe_events a.tribe-events-ical,
		.single-tribe_events a.tribe-events-gcal { color:<?php echo $main_color; ?>; }
		
		/* Tribe Events - Dark Color */
		#tribe-bar-form #tribe-bar-views,
		#tribe-bar-views.tribe-bar-views-open .tribe-bar-views-list,
		#tribe-bar-form #tribe-bar-views .tribe-bar-views-inner,
		#tribe-bar-views .tribe-bar-views-list .tribe-bar-views-option a { background:<?php echo $dark_color; ?> !important; border-color:<?php echo $dark_color; ?> !important; }
		
		.tribe-mini-calendar-nav td { background:<?php echo $main_color; ?> !important; border-color:<?php echo $main_color; ?> !important; }
		.tribe-mini-calendar th, .tribe-mini-calendar-event .list-date { background:<?php echo $dark_color; ?> !important; border-color:<?php echo $dark_color; ?> !important; }
		.tribe-mini-calendar td.tribe-events-has-events { background:<?php echo $main_color; ?> !important; }
		
		/* Tribe Events - Black */
		a.tribe-events-read-more:hover,
		p.tribe-events-widget-link a:hover { background:#000 !important; }
		
		.tribe-grid-allday .hentry.vevent > div,
		.tribe-grid-body div[id*="tribe-events-event-"] .hentry.vevent { border:1px solid <?php echo $dark_color; ?> !important; background:rgba(<?php echo $dark_color_rgb[0]; ?>, <?php echo $dark_color_rgb[1]; ?>, <?php echo $dark_color_rgb[2]; ?>, 0.75) !important; }
		
		.tribe-grid-allday .hentry.vevent > div:hover,
		.tribe-grid-body div[id*="tribe-events-event-"] .hentry.vevent:hover { background:<?php echo $dark_color; ?> !important; color:#fff; }
		
		.tribe-mini-calendar td.tribe-events-has-events a:hover { background:rgba(<?php echo $dark_color_rgb[0]; ?>, <?php echo $dark_color_rgb[1]; ?>, <?php echo $dark_color_rgb[2]; ?>, 0.40) !important; }
		.tribe-mini-calendar td.tribe-events-has-events.tribe-mini-calendar-today a:hover { background:<?php echo $dark_color; ?> !important; }
		
		.tribe-mini-calendar td.tribe-events-has-events.tribe-events-present a { border: 4px solid <?php echo $dark_color; ?>; padding: 1px 5px 11px 5px; }
		.tribe-mini-calendar td.tribe-events-has-events.tribe-mini-calendar-today a { background:<?php echo $dark_color; ?> !important; border:none; padding: 5px 5px 15px 5px; }
		
		@media only screen and (max-width: 767px) {
		
			.tribe-events-sub-nav li a { background:<?php echo $main_color; ?> !important; color:#fff; }
			
		}
		
		a.es-button.black:hover { background:rgba(0,0,0,0.5); }
		
		/* FONT */
		body, input, select, textarea { font-family:<?php echo $font; ?>; }
		
		
		/* Responsive Coloring */
		@media only screen and (max-width: 723px) {
		
			.carousel { background:#000; }
		
			.secondary-wrap {
				background:rgba(<?php echo $main_color_rgb[0]; ?>, <?php echo $main_color_rgb[1]; ?>, <?php echo $main_color_rgb[2]; ?>, 0.40);
			}
			
		}
		
		body { background:<?php echo $background_color; ?> url('<?php echo $background_image; ?>'); background-repeat: <?php echo $background_repeat; ?>; background-position: <?php echo $background_position; ?>; background-attachment: <?php echo $background_attachment; ?>; }

		<?php
	
		$hide_on_mobile = ot_get_option('hide_on_mobile',array());
			
		if (!empty($hide_on_mobile)):
			$hide_on_mobile_width = ot_get_option('hide_on_mobile_width',600);
			echo '@media only screen and (max-width: '.$hide_on_mobile_width.'px) { ';
			
				echo implode(', ',$hide_on_mobile).', .hide-spacer-on-mobile { display:none; }';
				
				// Top Bar Adjustments
				if (in_array('#top .shell section.left',$hide_on_mobile) && !in_array('#top .shell section.right',$hide_on_mobile)){
					echo '#top { height:70px; }';
				}
				if (!in_array('#top .shell section.left',$hide_on_mobile) && in_array('#top .shell section.right',$hide_on_mobile)){
					echo '#top { height:88px; }';
				}
				if (in_array('#top .shell section.left',$hide_on_mobile) && in_array('#top .shell section.right',$hide_on_mobile)){
					echo '#top { display:none; }';
				}
				
				// Footer Adjustments
				if (in_array('footer section.left',$hide_on_mobile) && !in_array('footer section.right',$hide_on_mobile)){
					echo 'footer { height:70px; } footer section.right { padding-top:18px !important; } section.social-search a.social { margin-bottom:0; }';
				}
				if (!in_array('footer section.left',$hide_on_mobile) && in_array('footer section.right',$hide_on_mobile)){
					echo 'footer section.left { padding-bottom:13px !important; }';
				}
				if (in_array('footer section.left',$hide_on_mobile) && in_array('footer section.right',$hide_on_mobile)){
					echo 'footer { display:none; }';
				}
				
			echo ' }';
		endif;
		
		// Main Font Color
		if (ot_get_option('main_font_color')) : $color_overrides['main_font_color'] = ot_get_option('main_font_color'); endif;
		if (ot_get_option('page_h1_color')) : $color_overrides['page_h1_color'] = ot_get_option('page_h1_color'); endif;
		if (ot_get_option('page_h2_color')) : $color_overrides['page_h2_color'] = ot_get_option('page_h2_color'); endif;
		if (ot_get_option('page_h3_color')) : $color_overrides['page_h3_color'] = ot_get_option('page_h3_color'); endif;
		if (ot_get_option('page_h4_color')) : $color_overrides['page_h4_color'] = ot_get_option('page_h4_color'); endif;
		if (ot_get_option('page_h5_color')) : $color_overrides['page_h5_color'] = ot_get_option('page_h5_color'); endif;
		if (ot_get_option('page_h6_color')) : $color_overrides['page_h6_color'] = ot_get_option('page_h6_color'); endif;
		if (ot_get_option('page_blockquote_color')) : $color_overrides['page_blockquote_color'] = ot_get_option('page_blockquote_color'); endif;
		
		// Navigation
		if (ot_get_option('custom_nav_color')) : $color_overrides['custom_nav_color'] = ot_get_option('custom_nav_color'); endif;
		if (ot_get_option('custom_nav_hover')) : $color_overrides['custom_nav_hover'] = ot_get_option('custom_nav_hover'); endif;
		if (ot_get_option('custom_nav_text_hover')) : $color_overrides['custom_nav_text_hover'] = ot_get_option('custom_nav_text_hover'); endif;
		if (ot_get_option('custom_nav_dropdown')) : $color_overrides['custom_nav_dropdown'] = ot_get_option('custom_nav_dropdown'); endif;
		if (ot_get_option('custom_nav_dropdown_text')) : $color_overrides['custom_nav_dropdown_text'] = ot_get_option('custom_nav_dropdown_text'); endif;
		if (ot_get_option('custom_nav_dropdown_hover')) : $color_overrides['custom_nav_dropdown_hover'] = ot_get_option('custom_nav_dropdown_hover'); endif;
		if (ot_get_option('custom_nav_dropdown_text_hover')) : $color_overrides['custom_nav_dropdown_text_hover'] = ot_get_option('custom_nav_dropdown_text_hover'); endif;
		if (ot_get_option('custom_nav_text')) : $color_overrides['custom_nav_text'] = ot_get_option('custom_nav_text'); endif;
		
		// Header, Top
		if (ot_get_option('custom_header_color')) : $color_overrides['custom_header_color'] = ot_get_option('custom_header_color'); endif;
		if (ot_get_option('custom_header_text')) : $color_overrides['custom_header_text'] = ot_get_option('custom_header_text'); endif;
		if (ot_get_option('custom_header_background_image')) : $color_overrides['custom_header_background_image'] = ot_get_option('custom_header_background_image'); endif;
		if (ot_get_option('custom_topbar_color')) : $color_overrides['custom_topbar_color'] = ot_get_option('custom_topbar_color'); endif;
		
		// Feature Blocks
		$disable_fb_bw = ot_get_option('disable_fb_black_white');
		$disable_fb_bw = is_array($disable_fb_bw) ? $disable_fb_bw[0] : false;
		if ($disable_fb_bw == true) : $color_overrides['disable_fb_black_white'] = true; else : $color_overrides['disable_fb_black_white'] = false; endif;
		if (ot_get_option('custom_fb_container_bg_color')) : $color_overrides['custom_fb_container_bg_color'] = ot_get_option('custom_fb_container_bg_color'); endif;
		if (ot_get_option('custom_fb_background_image')) : $color_overrides['custom_fb_background_image'] = ot_get_option('custom_fb_background_image'); endif;
		if (ot_get_option('custom_fb_title_bg_color')) : $color_overrides['custom_fb_title_bg_color'] = ot_get_option('custom_fb_title_bg_color'); endif;
		if (ot_get_option('custom_fb_title_text_color')) : $color_overrides['custom_fb_title_text_color'] = ot_get_option('custom_fb_title_text_color'); endif;
		if (ot_get_option('custom_fb_button_bg_color')) : $color_overrides['custom_fb_button_bg_color'] = ot_get_option('custom_fb_button_bg_color'); endif;
		if (ot_get_option('custom_fb_button_text_color')) : $color_overrides['custom_fb_button_text_color'] = ot_get_option('custom_fb_button_text_color'); endif;
		if (ot_get_option('custom_fb_button_bg_color_hover')) : $color_overrides['custom_fb_button_bg_color_hover'] = ot_get_option('custom_fb_button_bg_color_hover'); endif;
		if (ot_get_option('custom_fb_button_text_color_hover')) : $color_overrides['custom_fb_button_text_color_hover'] = ot_get_option('custom_fb_button_text_color_hover'); endif;
		if (ot_get_option('custom_fb_block_bg_color')) : $color_overrides['custom_fb_block_bg_color'] = ot_get_option('custom_fb_block_bg_color'); endif;
		if (ot_get_option('custom_fb_block_text_color')) : $color_overrides['custom_fb_block_text_color'] = ot_get_option('custom_fb_block_text_color'); endif;
		
		// Blog Posts
		$disable_blog_bw = ot_get_option('disable_blog_black_white');
		$disable_blog_bw = is_array($disable_blog_bw) ? $disable_blog_bw[0] : false;
		if ($disable_blog_bw == true) : $color_overrides['disable_blog_black_white'] = true; else : $color_overrides['disable_blog_black_white'] = false; endif;
		
		// Title Lines
		$disable_title_lines = ot_get_option('disable_title_lines');
		$disable_title_lines = is_array($disable_title_lines) ? $disable_title_lines[0] : false;
		if ($disable_title_lines == true) : $color_overrides['disable_title_lines'] = true; else : $color_overrides['disable_title_lines'] = false; endif;
		
		// Recent Tweets
		if (ot_get_option('custom_tweets_bg_color')) : $color_overrides['custom_tweets_bg_color'] = ot_get_option('custom_tweets_bg_color'); endif;
		if (ot_get_option('custom_tweets_text_color')) : $color_overrides['custom_tweets_text_color'] = ot_get_option('custom_tweets_text_color'); endif;
		
		// Footer Widgets
		if (ot_get_option('footer_widget_bg_image')) : $color_overrides['footer_widget_bg_image'] = ot_get_option('footer_widget_bg_image'); endif;
		if (ot_get_option('footer_widget_bg_color')) : $color_overrides['footer_widget_bg_color'] = ot_get_option('footer_widget_bg_color'); endif;
		if (ot_get_option('footer_widget_text_color')) : $color_overrides['footer_widget_text_color'] = ot_get_option('footer_widget_text_color'); endif;
		if (ot_get_option('footer_widget_link_color')) : $color_overrides['footer_widget_link_color'] = ot_get_option('footer_widget_link_color'); endif;
		
		// Bottom Bar
		if (ot_get_option('custom_bottom_bg_color')) : $color_overrides['custom_bottom_bg_color'] = ot_get_option('custom_bottom_bg_color'); endif;
		if (ot_get_option('custom_bottom_text_color')) : $color_overrides['custom_bottom_text_color'] = ot_get_option('custom_bottom_text_color'); endif;
		
		// Color Overrides Loop
		if (!empty($color_overrides)) {
			foreach($color_overrides as $key => $co):
				switch($key){
				
					// Page Text Colors
					case 'main_font_color' :
						echo 'article.page-content { color:'.$co.' !important; }';
					break;
					case 'page_h1_color' :
						echo 'article.page-content h1 { color:'.$co.' !important; }';
					break;
					case 'page_h2_color' :
						echo 'article.page-content h2 { color:'.$co.' !important; }';
					break;
					case 'page_h3_color' :
						echo 'article.page-content h3 { color:'.$co.'; }';
					break;
					case 'page_h4_color' :
						echo 'article.page-content h4 { color:'.$co.' !important; }';
					break;
					case 'page_h5_color' :
						echo 'article.page-content h5 { color:'.$co.' !important; }';
					break;
					case 'page_h6_color' :
						echo 'article.page-content h6 { color:'.$co.' !important; }';
					break;
					case 'page_blockquote_color' :
						echo 'article.page-content blockquote p { color:'.$co.' !important; }';
					break;
				
					// Navigation
					case 'custom_nav_color' :
						echo 'nav#main-nav.full { background:'.$co.' !important; }';
					break;
					case 'custom_nav_hover' :
						echo 'nav#main-nav.full .shell > ul > li:hover > a,
						nav#main-nav.full .shell > ul > li > a:hover,
						nav#main-nav.right > ul .dropdown li > a:hover,
						nav#main-nav.right > ul > li:hover > a,
						nav#main-nav.right > ul > li > a:hover { background:'.$co.' !important; }';
					break;
					case 'custom_nav_text' :
						echo 'nav#main-nav.full .shell > ul > li > a { color:'.$co.' !important; }';
					break;
					case 'custom_nav_text_hover' :
						echo 'nav#main-nav.full .shell > ul > li:hover > a,
						nav#main-nav.full .shell > ul > li > a:hover,
						nav#main-nav.right > ul > li:hover > a,
						nav#main-nav.right > ul > li > a:hover { color:'.$co.' !important; }';
					break;
					case 'custom_nav_dropdown' :
						echo 'nav#main-nav.full .shell > ul .dropdown, nav#main-nav.right > ul .dropdown { background:'.$co.' !important; }';
					break;
					case 'custom_nav_dropdown_text' :
						echo 'nav#main-nav.full .shell > ul .dropdown li > a, nav#main-nav.right > ul .dropdown li > a { color:'.$co.' !important; }';
					break;				
					case 'custom_nav_dropdown_hover' :
						echo 'nav#main-nav.full .shell > ul .dropdown li > a:hover, nav#main-nav.right > ul .dropdown li > a:hover { background:'.$co.' !important; }';
					break;
					case 'custom_nav_dropdown_text_hover' :
						echo 'nav#main-nav.full .shell > ul .dropdown li > a:hover, nav#main-nav.right > ul .dropdown li > a:hover { color:'.$co.' !important; }';
					break;
					
					// Header, Top
					case 'custom_header_color' :
						echo 'header#header { background-color:'.$co.' !important; }';
						echo 'section.social-search .search form input[type=submit], section.social-search .search form input[type=submit]:hover { color:'.$co.' !important; }';
					break;
					case 'custom_header_background_image' :
						echo 'header#header { background-image:url("'.$co.'") !important; background-repeat:repeat !important; background-position:top center !important; }';
					break;
					case 'custom_header_text' :
						echo 'header#header, header#header span, header#header a, header#header span a, section.social-search .search form input[type=text] { color:'.$co.' !important; }';
						echo 'section.social-search .search, section.social-search .search.active { border-color:'.$co.' !important; }';
						echo 'section.social-search .search form input[type=submit], section.social-search .search form input[type=submit]:hover { background-color:'.$co.' !important; }';
						echo 'section.social-search .search:after { color:'.$co.' !important; }';
					break;
					case 'custom_topbar_color' :
						echo '#top { background:'.$co.' !important; }';
					break;
					
					// Feature Blocks
					case 'disable_fb_black_white' :
						if ($co == true):
						echo '#ctas article img { -webkit-filter: grayscale(0%) !important; }';
						endif;
					break;
					case 'custom_fb_container_bg_color' :
						echo 'section#ctas { background-color:'.$co.' !important; }';
					break;
					case 'custom_fb_background_image' :
						echo 'section#ctas { background-image:url("'.$co.'") !important; background-repeat:repeat !important; background-position:top center !important; }';
					break;
					case 'custom_fb_title_bg_color' :
						echo '#ctas article h3 { background:'.$co.' !important; }';
					break;
					case 'custom_fb_title_text_color' :
						echo '#ctas article h3 { color:'.$co.' !important; }';
					break;
					case 'custom_fb_button_bg_color' :
						echo 'section#ctas a.es-button { background:'.$co.' !important; }';
					break;
					case 'custom_fb_button_text_color' :
						echo 'section#ctas a.es-button { color:'.$co.' !important; }';
					break;
					case 'custom_fb_button_bg_color_hover' :
						echo 'section#ctas a.es-button:hover { background:'.$co.' !important; }';
					break;
					case 'custom_fb_button_text_color_hover' :
						echo 'section#ctas a.es-button:hover { color:'.$co.' !important; }';
					break;
					case 'custom_fb_block_bg_color' :
						echo '#ctas article { background:'.$co.' !important; }';
					break;
					case 'custom_fb_block_text_color' :
						echo '#ctas article p { color:'.$co.' !important; }';
					break;
					
					// Blog Posts
					case 'disable_blog_black_white' :
						if ($co == true):
						echo 'article.recent-post-block img { -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=100)"; filter: alpha(opacity=100); -moz-opacity: 1; -khtml-opacity: 1; opacity: 1; -webkit-filter: grayscale(0%) !important; }';
						endif;
					break;
					
					// Title Lines
					case 'disable_title_lines' :
						if ($co == true):
						echo 'h2.centered, h1.page-title, h2.centered:before, h1.page-title:before { border:none; background:none; }';
						endif;
					break;
					
					// Recent Tweets Row
					case 'custom_tweets_bg_color' :
						echo '#recent-tweets { background:'.$co.' !important; }';
					break;
					case 'custom_tweets_text_color' :
						echo '#recent-tweets h3, #recent-tweets .tweet p, #recent-tweets .tweet small, #recent-tweets .tweet p a, #recent-tweets .tweet small a, #recent-tweets .btn-prev, #recent-tweets .btn-next { color:'.$co.' !important; }';
					break;
					
					// Footer Widgets Row
					case 'footer_widget_bg_color' :
						echo '#footer-widgets .overlay, #mobile-slider .colored-wrap { background-color:'.$co.' !important; }';
					break;
					case 'footer_widget_bg_image' :
						echo '#footer-widgets .overlay { background-image:url("'.$co.'") !important; background-repeat:repeat !important; background-position:top center !important; }';
					break;
					case 'footer_widget_text_color' :
						echo '#footer-widgets { color:'.$co.' !important; }';
					break;
					case 'footer_widget_link_color' :
						echo '#footer-widgets a, #footer-widgets article.hours-block p.right { color:'.$co.' !important; }';
					break;
					
					// Bottom Bar
					case 'custom_bottom_bg_color' :
						echo 'footer { background:'.$co.' !important; }';
					break;
					case 'custom_bottom_text_color' :
						echo 'footer, footer a { color:'.$co.' !important; }';
					break;
					
				}
			endforeach;
		}		
		
	?></style><?php
}

add_action('wp_head', 'espresso_custom_styling');

function espresso_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}