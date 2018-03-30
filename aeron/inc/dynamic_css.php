<?php 

if ( ! function_exists( 'ABdev_colors_css_hex2rgb' ) ){
	function ABdev_colors_css_hex2rgb($hex) {
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
		return implode(",", $rgb); 
	} 
}

if ( ! function_exists( 'ABdev_colors_css_adjustBrightness' ) ){
	function ABdev_colors_css_adjustBrightness($hex, $steps) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max(-255, min(255, $steps));
		$hex = str_replace('#', '', $hex);
		if (strlen($hex) == 3) {
			$hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
		}
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
		$r = max(0,min(255,$r + $steps));
		$g = max(0,min(255,$g + $steps));  
		$b = max(0,min(255,$b + $steps));
		$r_hex = str_pad(dechex($r), 2, '0', STR_PAD_LEFT);
		$g_hex = str_pad(dechex($g), 2, '0', STR_PAD_LEFT);
		$b_hex = str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
		return '#'.$r_hex.$g_hex.$b_hex;
	}
}



$header_background = get_theme_mod('header_background', '');
	$custom_css.= '
		header#aeron_header{background:rgba('. ABdev_colors_css_hex2rgb($header_background) .', 0.7);}
	';

$body_text_color = get_theme_mod('body_text_color', '');
	$custom_css.= '
		body, 
		a:hover, 
		h5, 
		nav>ul ul li a, 
		nav>ul ul li:hover a, 
		.latest_portfolio .portfolio_navigation a, 
		.post_main .postmeta-under a:hover, 
		#blog_pagination .page-numbers.prev:hover, 
		#blog_pagination .page-numbers.next:hover, 
		#blog_pagination .page-numbers.dots:hover, 
		.widget_nav_menu ul li a,
		.tcvpb-tabs .ui-tabs-nav li a{
			color:'. $body_text_color.';
		}
	';

$main_color = get_theme_mod('main_color', '');
	$custom_css.= '
		h2,
		h3,
		h4,
		#cs_countdown .cs_text,
		.portfolio_item h4 a,
		.tcvpb-accordion .ui-accordion-header, 
		.tcvpb_service_box .tcvpb_icon_boxed i, 
		.latest_news_shortcode_content h5,
		.latest_news_shortcode_content h5 a,
		.tcvpb-teaser i, 
		.timeline_postmeta a:hover, 
		.timeline_postmeta h2 a,
		.timeline_postmeta h2, 
		.post_content .post_badges .post_type, 
		.widget_nav_menu ul li:hover a, 
		.widget_nav_menu .current-menu-item a, 
		.tcvpb_service_box .tcvpb_icon_boxed i, 
		.tcvpb_pricing-table-2 .tcvpb_pricebox_header, 
		.tcvpb-tabs .ui-tabs-nav li:hover a, 
		.tcvpb-tabs .ui-tabs-nav li.ui-tabs-active a, 
		.tcvpb_stats_excerpt, 
		.tcvpb_team_member .tcvpb_team_member_name, 
		.tcvpb_pricing-table-1 .tcvpb_pricebox_header,
		.tcvpb-tabs-position-left .nav-tabs li.active,
		.tcvpb_latest_news_shortcode_content h5 a,
		.tcvpb_team_member .tcvpb_team_member_name,
		.tcvpb_stats_excerpt,
		.post_content .post_badges .post_comments .text,
		.tab-content .tcvpb_event_content h1 a,
		.tcvpb-event-tabs .nav-tabs li.active a{
			color:'. $main_color.';
		}

		#topbar, 
		.tp-leftarrow.default:hover, 
		.tp-rightarrow.default:hover, 
		.portfolio_item .overlayed .overlay, 
		.tcvpb_service_box:hover .tcvpb_icon_boxed, 
		.ABdev_overlayed .ABdev_overlay, 
		#blog_pagination .page-numbers.current, 
		#blog_pagination .page-numbers:hover, 
		.tcvpb_team_member .ABs_overlayed .ABs_overlay, 
		.tcvpb_service_box:hover .tcvpb_icon_boxed,
		.tcvpb_service_box:hover .tcvpb_icon_boxed{
			background:'. $main_color.';
		}

		.tcvpb_service_box:hover .tcvpb_icon_boxed:after, 
		.tcvpb_service_box .tcvpb_icon_boxed:hover:after,
		.tcvpb_service_box:hover .tcvpb_icon_boxed:after{
			border-top-color:'. $main_color.';
		}

		.portfolio_item:hover .overlayed .overlay, 
		.ABdev_overlayed:hover .ABdev_overlay, 
		.tcvpb_team_member:hover .ABs_overlayed .ABs_overlay{
			background:rgba('. ABdev_colors_css_hex2rgb($main_color) .', 0.75);
		}

		button:hover, 
		input[type="submit"]:hover, 
		.wpcf7-submit:hover{
			background:'. ABdev_colors_css_adjustBrightness($main_color, '-20').';
		}

		button, 
		input[type="submit"], 
		.wpcf7-submit{
			border-color: '. ABdev_colors_css_adjustBrightness($main_color, '-40').';
		}
	';

$highlight_color = get_theme_mod('highlight_color', '');
	$custom_css.= '
		.section_color_background,
		nav>ul ul li:hover, 
		.portfolio_item .overlayed:after, 
		.tcvpb-accordion .ui-icon-triangle-1-e, 
		.tcvpb_service_box .tcvpb_icon_boxed, 
		.tcvpb-teaser, 
		.timeline_postmeta, 
		.post_content .post_badges .post_type, 
		.post_content .post_badges .post_comments .text, 
		#post_pagination, 
		#blog_pagination, 
		.tagcloud a:hover, 
		.widget_nav_menu ul li:hover, 
		.widget_nav_menu .current-menu-item,
		.tcvpb-tabs-position-left .ui-tabs-nav li.ui-tabs-active,
		.tcvpb-tabs-position-right .ui-tabs-nav li.ui-tabs-active,
		.tcvpb_pricing-table-1 .tcvpb_pricebox_header,
		.tcvpb_pricing-table-2 .tcvpb_pricebox_header,
		.tcvpb_service_box .tcvpb_icon_boxed,
		.tcvpb_service_box .tcvpb_icon_boxed,
		.overlayed_animated_highlight .overlayed_after,
		.tcvpb-tabs-position-left .nav-tabs li.active,
		.title_with_after header h3:after,
		.leading_line:after, 
		.leading_line_bottom:after,
		.tcvpb_alert_info, .tcvpb_alert_info .tcvpb_alert_box_close,
		.single-tribe_events #tribe-events-footer,
		#tribe-events .tribe-events-button, .tribe-events-button{
			background:'. $highlight_color.';
		}

		.tagcloud a:hover{
			border-color:'. $highlight_color.';
		}

		.section_border_top:before, 
		.section_border_top_pattern:before, 
		.tcvpb_service_box .tcvpb_icon_boxed:after, 
		.post_content .post_badges .post_type:after, 
		.post_content .post_badges .post_comments .text:after, 
		footer,
		.tcvpb_service_box .tcvpb_icon_boxed:after,
		.tcvpb-tabs.tcvpb-tabs-style1 .nav-tabs li.active:after{
			border-top-color:'. $highlight_color.';
		}

		.timeline_post_left:after, 
		.widget_nav_menu ul li:hover:after, 
		.widget_nav_menu .current-menu-item:after{
			border-right-color:'. $highlight_color.';
		}

		header, 
		nav>ul ul, 
		#magic-line, 
		#topbar.announcement_bar_style_3, 
		#topbar.announcement_bar_style_2, 
		#topbar.announcement_bar_style_1, 
		.testimonial_small p,
		.tcvpb_pricing-table-2 .tcvpb_pricebox_feature:last-of-type{
			border-bottom-color:'. $highlight_color.';
		}

		nav>ul ul li.has_children:hover:after, 
		.tcvpb-accordion .ui-icon-triangle-1-e:after, 
		.timeline_post_right:after, 
		.testimonial_small p:after, 
		.sidebar_left .widget_nav_menu ul li:hover:after, 
		.sidebar_left .widget_nav_menu .current-menu-item:after,
		.tcvpb-tabs-position-left .nav-tabs li.active:after,
		.tcvpb-accordion .ui-icon-triangle-1-e:after{
			border-left-color:'. $highlight_color.';
		}

		.portfolio_item .overlayed .overlay p a:hover, 
		.ABdev_overlayed .ABdev_overlay p a:hover, 
		#topbar_menu li a:hover, 
		#page404 .big_404, 
		#under_maintenance i,
		.tcvpb_team_member .ABs_overlayed .ABs_overlay p a:hover{
			color:'. $highlight_color.';
		}
	';


$secondary_color = get_theme_mod('secondary_color', '');
	$custom_css.= '
	    a{
			color:'. $secondary_color.';
		}

		.tcvpb-accordion .ui-icon-triangle-1-e, 
		.latest_portfolio .portfolio_navigation a:hover, 
		.tcvpb-teaser, 
		.tcvpb-teaser_title, 
		.title_bar .breadcrumbs a:hover, 
		.timeline_postmeta, 
		.timeline_postmeta a, 
		.timeline_postmeta h2 a:hover, 
		.comment .reply a:hover, 
		.comment .edit-link a:hover, 
		#post_pagination a, 
		#blog_pagination a, 
		.widget ul li:before, 
		.tagcloud a:hover,
		.tcvpb_stats_excerpt .ABs_stats_number,
		.tcvpb_stats_excerpt .ABs_stats_number_sign,
		.ABt_testimonials_slide .testimonial_small .source a,
		.ABt_testimonials_slide .testimonial_big .source a,
		.tcvpb-teaser,
		.tcvpb-teaser .tcvpb_teaser_title,
		.tcvpb-accordion .ui-icon-triangle-1-e,
		.tcvpb_alert_info, .tcvpb_alert_info .tcvpb_alert_box_close,
		.tcvpb-event-tabs i{
			color:'. $secondary_color.';
		}

		button, 
		input[type="submit"], 
		.tcvpb-accordion .ui-icon-triangle-1-s, 
		.wpcf7-submit, 
		.tcvpb_dropcap, 
		.tcvpb_pricing-table-2 .tcvpb_popular-plan .tcvpb_pricebox_name, 
		.tcvpb_meter > span,
		.tcvpb-accordion .ui-icon-triangle-1-s,
		.tcvpb_meter .tcvpb_meter_percentage{
			background:'. $secondary_color.';
		}

		.tcvpb-accordion .ui-icon-triangle-1-s:after,
		.tcvpb-accordion .ui-icon-triangle-1-s:after{
			border-top-color: '. $secondary_color.';
		}
	';


$lighter_text_color = get_theme_mod('lighter_text_color', '');
	$custom_css.= '
		h6, 
		.placeholder, 
		::-webkit-input-placeholder, 
		:-moz-placeholder, 
		::-moz-placeholder, 
		:-ms-input-placeholder, 
		.portfolio_item, 
		.single_portfolio_meta, 
		.latest_news_shortcode_content p, 
		.title_bar .breadcrumbs, 
		.title_bar .breadcrumbs a, 
		.post_main .postmeta-under, 
		.post_main .postmeta-under a, 
		.comment .comment-author, 
		.comment time, 
		.comment .reply, 
		.comment .edit-link, 
		.comment .reply a, 
		.comment .edit-link a, 
		.tagcloud a, 
		footer, 
		footer #footer_copyright .footer_social_links a,
		.tcvpb_team_member .tcvpb_team_member_position,
		.tcvpb-teaser i{
			color:'. $lighter_text_color.';
		}
		footer .tagcloud a:hover{
			border-color:'. $lighter_text_color.';
		}
	';


$borders_color = get_theme_mod('borders_color', '');
	$custom_css.= '
		input[type="text"], 
		input[type="password"], 
		input[type="email"], 
		textarea, 
		hr, 
		.timeline_post, 
		.post_content .post_badges .post_comments .number, 
		#blog_pagination .page-numbers, 
		.tagcloud a{
			border-color: '. $borders_color.';
		}

		.section_border_top, 
		.section_border_top_pattern, 
		nav>ul ul, 
		#under_maintenance .section_border_top_pattern,
		.tcvpb_divider,
		.tcvpb_divider_dashed,
		.tcvpb_divider_dotted,
		.tcvpb-tabs-position-bottom .ui-tabs-nav,
		.tcvpb-table-hover table tr,
		.tcvpb-table-striped table tr,
		.tcvpb-table-condensed table tr{
			border-top-color: '. $borders_color.';
		}

		nav>ul ul, 
		.widget_nav_menu,
		.tcvpb-tabs-position-right .ui-tabs-nav{
			border-left-color: '. $borders_color.';
		}

		nav>ul ul, 
		.sidebar_left .widget_nav_menu,
		.tcvpb-tabs-position-left .ui-tabs-nav{
			border-right-color: '. $borders_color.';
		}

		#portfolio_item_meta p, 
		#under_maintenance .section_border_top_pattern,
		.tcvpb-tabs .ui-tabs-nav,
		.tcvpb-accordion .ui-accordion-header,
		.tcvpb-accordion .ui-accordion-content,
		.tcvpb_pricing-table-1 .tcvpb_pricebox_feature{
			border-bottom-color: '. $borders_color.';
		}

		hr{
			background-color:'. $borders_color.';
		}
	';


$title_bar_background = get_theme_mod('title_bar_background', '');
	$custom_css.= '
		.title_bar,
		.tcvpb_pricing-table-2 .tcvpb_pricebox_feature,
		.tcvpb_meter{
			background-color:'. $title_bar_background.';
		}
	';


$footer_background = get_theme_mod('footer_background', '');
	$custom_css.= '
		#topbar.announcement_bar_style_3, 
		footer,
		.tcvpb_pricing-table-1 .tcvpb_popular-plan .tcvpb_pricebox_featured_text{
			background:'. $footer_background.';
		}

		footer .tagcloud a:hover{
			color:'. $footer_background.';
		}
	';


$body_background = get_theme_mod('body_background', '');
	$custom_css.= '
		#topbar, 
		.sf-arrows ul li:hover .sf-with-ul:after,  
		nav>ul>.current-menu-ancestor>a, 
		button, 
		input[type="submit"], 
		.tp-leftarrow.default:before, 
		.tp-rightarrow.default:before, 
		#knob_countdown div span, 
		.portfolio_item .overlayed .overlay p a, 
		.tcvpb-accordion .ui-icon-triangle-1-s, 
		.tcvpb_service_box:hover .tcvpb_icon_boxed i, 
		.ABdev_overlayed .ABdev_overlay p a, 
		#topbar_menu li a, 
		#blog_pagination .page-numbers.current, 
		#blog_pagination .page-numbers:hover, 
		.wpcf7-submit, 
		footer a:hover, 
		footer h4, 
		footer #footer_copyright .footer_social_links a:hover, 
		.tcvpb_dropcap, 
		.tcvpb_pricing-table-2 .tcvpb_popular-plan .tcvpb_pricebox_name, 
		.tcvpb_meter > span,
		.tcvpb-accordion .ui-icon-triangle-1-s,
		.tcvpb_team_member .ABs_overlayed .ABs_overlay p a,
		.tcvpb_pricing-table-1 .tcvpb_pricebox_featured_text,
		.tcvpb_service_box:hover .tcvpb_icon_boxed i{
			color:'. $body_background.';
		}

		body, 
		#ABdev_sticky_header_content, 
		#blog_pagination .page-numbers{
			background:'. $body_background.';
		}

		.tcvpb-table-striped table tr:nth-child(2n+1){
			background: '. ABdev_colors_css_adjustBrightness($body_background, '-6').';
		}

		.testimonial_small p:after,
		.tcvpb_pricing-table-2 .tcvpb_pricebox_name,
		.tcvpb_pricing-table-2 .tcvpb_pricebox_feature{
			border-bottom-color: '. $body_background.';
		}
	';


$pullquote_text = get_theme_mod('pullquote_text', '');
	$custom_css.= '
		.tcvpb_blockquote, 
		.tcvpb_pullquote{
			color:'. $pullquote_text.';
		}
	';


$footer_borders = get_theme_mod('footer_borders', '');
	$custom_css.= '
		footer .tagcloud a{
			border-color:'. $footer_borders.';
		}
	
		footer #footer_copyright{
			border-top-color:'. $footer_borders.';
		}
	';


$main_menu_items = get_theme_mod('main_menu_items', '');
	$custom_css.= '
		nav>ul>li>a{
			color:'. $main_menu_items.';
		}
	';


$main_menu_items_hover = get_theme_mod('main_menu_items_hover', '');
	$custom_css.= '
		nav>ul>li a:hover,
		nav>ul>.current-menu-item>a{
			color:'. $main_menu_items_hover.';
		}
	';


$footer_links = get_theme_mod('footer_links', '');
	$custom_css.= '
		footer a{
			color:'. $footer_links.';
		}
	';

if(get_theme_mod('header_retina_logo', '') !='' ){
	$custom_css.= '
	#aeron_header #main_logo{display:inline;}
	#aeron_header #retina_logo{display:none;}
	@media only screen and (-webkit-min-device-pixel-ratio: 1.3), 
	only screen and (-o-min-device-pixel-ratio: 13/10), 
	only screen and (min-resolution: 120dpi) {
		#aeron_header #main_logo{display:none;}
		#aeron_header #retina_logo{display:inline;}
	}';
}

if (get_theme_mod('boxed_body', false)) {
	$bg_color = get_theme_mod('bg_color', '#ff503f');
	$bg_color = ($bg_color!='') ? ' background-color:'.$bg_color : '';

	$custom_bg_image = get_theme_mod('custom_bg_image', '');
	$custom_bg_image = ($custom_bg_image!='') ? ' background-image:url("'.$custom_bg_image.'")' : '';

	$revelance_background_repeat = get_theme_mod('revelance_background_repeat', 'no-repeat');
	$revelance_background_repeat = ($revelance_background_repeat!='' && get_theme_mod('custom_bg_image', '') != '') ? ' background-repeat:'.$revelance_background_repeat : '';

	$revelance_background_size = get_theme_mod('revelance_background_size', 'cover');
	$revelance_background_size = ($revelance_background_size!='' && get_theme_mod('custom_bg_image', '') != '') ? ' background-size:'.$revelance_background_size : '';

	$revelance_background_position = get_theme_mod('revelance_background_position', 'center center');
	$revelance_background_position = ($revelance_background_position!='' && get_theme_mod('custom_bg_image', '') != '') ? ' background-position:'.$revelance_background_position : '';

	$revelance_background_attachment = get_theme_mod('revelance_background_attachment', 'fixed');
	$revelance_background_attachment = ($revelance_background_attachment!='' && get_theme_mod('custom_bg_image', '') != '') ? ' background-attachment:'.$revelance_background_attachment : '';

	$custom_css.= 'body{'.$bg_color.'; '.$custom_bg_image.'; '.$revelance_background_repeat.'; '.$revelance_background_size.'; '.$revelance_background_position.'; '.$revelance_background_attachment.';}';

}


/* Title Breadcrumbs Bar Background */
	$aeron_title_breadcrumbs_color = get_theme_mod('aeron_title_breadcrumbs_color', '#d9d9d9');
	$aeron_title_breadcrumbs_color = ($aeron_title_breadcrumbs_color != '') ? ' background-color:'.$aeron_title_breadcrumbs_color : '';

	$aeron_title_breadcrumbs_image = get_theme_mod('aeron_title_breadcrumbs_image', '');
	$featured_image = wp_get_attachment_url(get_post_thumbnail_id(get_the_ID()));
	
	if($featured_image!='' && is_page()){
		$aeron_title_breadcrumbs_image = ($featured_image != '') ? ' background-image:url("'.$featured_image.'")' : '';
	}
	else{
		$aeron_title_breadcrumbs_image = ($aeron_title_breadcrumbs_image != '') ? ' background-image:url("'.$aeron_title_breadcrumbs_image.'")' : '';
	}


	$aeron_background_repeat_breadcrumbs_image = get_theme_mod('aeron_title_breadcrumbs_bar_background_repeat', 'no-repeat');
	$aeron_background_repeat_breadcrumbs_image = ($aeron_background_repeat_breadcrumbs_image!='' && $aeron_title_breadcrumbs_image!= '') ? ' background-repeat:'.$aeron_background_repeat_breadcrumbs_image : '';
	$aeron_background_size_breadcrumbs_image = get_theme_mod('aeron_title_breadcrumbs_bar_background_size', 'cover');
	$aeron_background_size_breadcrumbs_image = ($aeron_background_size_breadcrumbs_image!='' && $aeron_title_breadcrumbs_image!= '') ? ' background-size:'.$aeron_background_size_breadcrumbs_image : '';

	$aeron_background_position_breadcrumbs_image = get_theme_mod('aeron_title_breadcrumbs_bar_background_position', 'center center');
	$aeron_background_position_breadcrumbs_image = ($aeron_background_position_breadcrumbs_image!='' && $aeron_title_breadcrumbs_image!= '') ? ' background-position:'.$aeron_background_position_breadcrumbs_image : '';

	$custom_css.= '.title_bar{'.$aeron_title_breadcrumbs_color.'; '.$aeron_title_breadcrumbs_image.'; '.$aeron_background_repeat_breadcrumbs_image.'; '.$aeron_background_size_breadcrumbs_image.'; '.$aeron_background_position_breadcrumbs_image.';}';