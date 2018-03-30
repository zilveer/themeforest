(function($){

	function dynamic_css_targets(){
		var css_styles_targets = '<style id="customizer_dynamic_header_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_body_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_main_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_highlight_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_secondary_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_lighter_text_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_borders_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_title_bar_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_footer_background_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_body_background_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_pullquote_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_footer_borders_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_menu_items_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_menu_items_hover_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_footer_links_color_css" type="text/css"></style>'+
			'<style id="customizer_dynamic_bg_color_css" type="text/css"></style>'+
			'<style id="customizer_custom_css" type="text/css"></style>';
		if(!$('#customizer_dynamic_header_color_css').length){
			$('#main_css-inline-css').after(css_styles_targets);
		}
	}

	wp.customize('custom_css', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			$('#customizer_custom_css').text(newval);
		});
	});

	wp.customize('header_logo', function(value){
		value.bind(function(newval){
			$('#main_logo').attr('src', newval);
		});
	});

	wp.customize('header_retina_logo', function(value){
		value.bind(function(newval){
			$('#retina_logo').attr('src', newval);
		});
	});

	wp.customize('sidebars', function(value){
		value.bind(function(newval){
		});
	});

	wp.customize('header_background', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
			var matches = patt.exec(newval);
			var rgba = "rgba("+parseInt(matches[1], 16)+","+parseInt(matches[2], 16)+","+parseInt(matches[3], 16)+", 0.7)";
			var new_colors = 'header#aeron_header{background:'+rgba+';}';
			$('#customizer_dynamic_header_color_css').text(new_colors);
		});
	});

	wp.customize('body_text_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'body, a:hover, h5, nav>ul ul li a, nav>ul ul li:hover a, .latest_portfolio .portfolio_navigation a, .post_main .postmeta-under a:hover, #blog_pagination .page-numbers.prev:hover, #blog_pagination .page-numbers.next:hover, #blog_pagination .page-numbers.dots:hover, .widget_nav_menu ul li a,.tcvpb-tabs .ui-tabs-nav li a{color:'+newval+';}';
			$('#customizer_dynamic_body_color_css').text(new_colors);
		});
	});

	wp.customize('main_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var patt = /^#([\da-fA-F]{2})([\da-fA-F]{2})([\da-fA-F]{2})$/;
			var matches = patt.exec(newval);
			var rgba = "rgba("+parseInt(matches[1], 16)+","+parseInt(matches[2], 16)+","+parseInt(matches[3], 16)+", 0.75)";
			var new_colors = 'h2,h3,h4,#cs_countdown .cs_text,.portfolio_item h4 a,.tcvpb-accordion .ui-accordion-header, .tcvpb_service_box .tcvpb_icon_boxed i, .latest_news_shortcode_content h5,.latest_news_shortcode_content h5 a, .tcvpb-teaser i, .timeline_postmeta a:hover, .timeline_postmeta h2 a,.timeline_postmeta h2, .post_content .post_badges .post_type, .widget_nav_menu ul li:hover a, .widget_nav_menu .current-menu-item a, .tcvpb_service_box .tcvpb_icon_boxed i, .tcvpb_pricing-table-2 .tcvpb_pricebox_header, .tcvpb-tabs .ui-tabs-nav li:hover a, .tcvpb-tabs .ui-tabs-nav li.ui-tabs-active a, .tcvpb_stats_excerpt, .tcvpb_team_member .tcvpb_team_member_name, .tcvpb_pricing-table-1 .tcvpb_pricebox_header,.tcvpb-tabs-position-left .nav-tabs li.active,.tcvpb_latest_news_shortcode_content h5 a,.tcvpb_team_member .tcvpb_team_member_name,.tcvpb_stats_excerpt,.post_content .post_badges .post_comments .text,.tab-content .tcvpb_event_content h1 a,.tcvpb-event-tabs .nav-tabs li.active a{color:'+newval+';}#topbar, .tp-leftarrow.default:hover, .tp-rightarrow.default:hover, .portfolio_item .overlayed .overlay, .tcvpb_service_box:hover .tcvpb_icon_boxed, .ABdev_overlayed .ABdev_overlay, #blog_pagination .page-numbers.current, #blog_pagination .page-numbers:hover, .tcvpb_team_member .ABs_overlayed .ABs_overlay, .tcvpb_service_box:hover .tcvpb_icon_boxed,.tcvpb_service_box:hover .tcvpb_icon_boxed{background:'+newval+';}.tcvpb_service_box:hover .tcvpb_icon_boxed:after, .tcvpb_service_box .tcvpb_icon_boxed:hover:after,.tcvpb_service_box:hover .tcvpb_icon_boxed:after{border-top-color:'+newval+';}.portfolio_item:hover .overlayed .overlay, .ABdev_overlayed:hover .ABdev_overlay, .tcvpb_team_member:hover .ABs_overlayed .ABs_overlay{background:'+rgba+';}';
			$('#customizer_dynamic_main_color_css').text(new_colors);
		});
	});

	wp.customize('highlight_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = '.section_color_background,nav>ul ul li:hover, .portfolio_item .overlayed:after, .tcvpb-accordion .ui-icon-triangle-1-e, .tcvpb_service_box .tcvpb_icon_boxed, .tcvpb-teaser, .timeline_postmeta, .post_content .post_badges .post_type, .post_content .post_badges .post_comments .text, #post_pagination, #blog_pagination, .tagcloud a:hover, .widget_nav_menu ul li:hover, .widget_nav_menu .current-menu-item,.tcvpb-tabs-position-left .ui-tabs-nav li.ui-tabs-active,.tcvpb-tabs-position-right .ui-tabs-nav li.ui-tabs-active,.tcvpb_pricing-table-1 .tcvpb_pricebox_header,.tcvpb_pricing-table-2 .tcvpb_pricebox_header,.tcvpb_service_box .tcvpb_icon_boxed,.tcvpb_service_box .tcvpb_icon_boxed,.overlayed_animated_highlight .overlayed_after,.tcvpb-tabs-position-left .nav-tabs li.active,.title_with_after header h3:after,.leading_line:after, .leading_line_bottom:after,.tcvpb_alert_info, .tcvpb_alert_info .tcvpb_alert_box_close,.single-tribe_events #tribe-events-footer,#tribe-events .tribe-events-button, .tribe-events-button{background:'+newval+';}.tagcloud a:hover{	border-color:'+newval+';}.section_border_top:before, .section_border_top_pattern:before, .tcvpb_service_box .tcvpb_icon_boxed:after, .post_content .post_badges .post_type:after, .post_content .post_badges .post_comments .text:after, footer,.tcvpb_service_box .tcvpb_icon_boxed:after,.tcvpb-tabs.tcvpb-tabs-style1 .nav-tabs li.active:after{	border-top-color:'+newval+';}.timeline_post_left:after, .widget_nav_menu ul li:hover:after, .widget_nav_menu .current-menu-item:after{	border-right-color:'+newval+';}header, nav>ul ul, #magic-line, #topbar.announcement_bar_style_3, #topbar.announcement_bar_style_2, #topbar.announcement_bar_style_1, .testimonial_small p,.tcvpb_pricing-table-2 .tcvpb_pricebox_feature:last-of-type{	border-bottom-color:'+newval+';}nav>ul ul li.has_children:hover:after, .tcvpb-accordion .ui-icon-triangle-1-e:after, .timeline_post_right:after, .testimonial_small p:after, .sidebar_left .widget_nav_menu ul li:hover:after, .sidebar_left .widget_nav_menu .current-menu-item:after,.tcvpb-tabs-position-left .nav-tabs li.active:after,.tcvpb-accordion .ui-icon-triangle-1-e:after{	border-left-color:'+newval+';}.portfolio_item .overlayed .overlay p a:hover, .ABdev_overlayed .ABdev_overlay p a:hover, #topbar_menu li a:hover, #page404 .big_404, #under_maintenance i,.tcvpb_team_member .ABs_overlayed .ABs_overlay p a:hover{	color:'+newval+';}';
			$('#customizer_dynamic_highlight_color_css').text(new_colors);
		});
	});

	wp.customize('secondary_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'a{color:'+newval+';}.tcvpb-accordion .ui-icon-triangle-1-e, .latest_portfolio .portfolio_navigation a:hover, .tcvpb-teaser, .tcvpb-teaser_title, .title_bar .breadcrumbs a:hover, .timeline_postmeta, .timeline_postmeta a, .timeline_postmeta h2 a:hover, .comment .reply a:hover, .comment .edit-link a:hover, #post_pagination a, #blog_pagination a, .widget ul li:before, .tagcloud a:hover,.tcvpb_stats_excerpt .ABs_stats_number,.tcvpb_stats_excerpt .ABs_stats_number_sign,.ABt_testimonials_slide .testimonial_small .source a,.ABt_testimonials_slide .testimonial_big .source a,.tcvpb-teaser,.tcvpb-teaser .tcvpb_teaser_title,.tcvpb-accordion .ui-icon-triangle-1-e,.tcvpb_alert_info, .tcvpb_alert_info .tcvpb_alert_box_close,.tcvpb-event-tabs i{	color:'+newval+';}button, input[type="submit"], .tcvpb-accordion .ui-icon-triangle-1-s, .wpcf7-submit, .tcvpb_dropcap, .tcvpb_pricing-table-2 .tcvpb_popular-plan .tcvpb_pricebox_name, .tcvpb_meter > span,.tcvpb-accordion .ui-icon-triangle-1-s,.tcvpb_meter .tcvpb_meter_percentage{	background:'+newval+';}.tcvpb-accordion .ui-icon-triangle-1-s:after,.tcvpb-accordion .ui-icon-triangle-1-s:after{	border-top-color: '+newval+';}';
			$('#customizer_dynamic_secondary_color_css').text(new_colors);
		});
	});

	wp.customize('lighter_text_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'h6, .placeholder, ::-webkit-input-placeholder, :-moz-placeholder, ::-moz-placeholder, :-ms-input-placeholder, .portfolio_item, .single_portfolio_meta, .latest_news_shortcode_content p, .title_bar .breadcrumbs, .title_bar .breadcrumbs a, .post_main .postmeta-under, .post_main .postmeta-under a, .comment .comment-author, .comment time, .comment .reply, .comment .edit-link, .comment .reply a, .comment .edit-link a, .tagcloud a, footer, footer #footer_copyright .footer_social_links a,.tcvpb_team_member .tcvpb_team_member_position,.tcvpb-teaser i{color:'+newval+';}footer .tagcloud a:hover{border-color:'+newval+';}';
			$('#customizer_dynamic_lighter_text_color_css').text(new_colors);
		});
	});

	wp.customize('borders_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'input[type="text"], input[type="password"], input[type="email"], textarea, hr, .timeline_post, .post_content .post_badges .post_comments .number, #blog_pagination .page-numbers, .tagcloud a{border-color: '+newval+';}.section_border_top, .section_border_top_pattern, nav>ul ul, #under_maintenance .section_border_top_pattern,.tcvpb_divider,.tcvpb_divider_dashed,.tcvpb_divider_dotted,.tcvpb-tabs-position-bottom .ui-tabs-nav,.tcvpb-table-hover table tr,.tcvpb-table-striped table tr,.tcvpb-table-condensed table tr{border-top-color: '+newval+';}nav>ul ul, .widget_nav_menu,.tcvpb-tabs-position-right .ui-tabs-nav{border-left-color: '+newval+';}nav>ul ul, .sidebar_left .widget_nav_menu,.tcvpb-tabs-position-left .ui-tabs-nav{border-right-color: '+newval+';}#portfolio_item_meta p, #under_maintenance .section_border_top_pattern,.tcvpb-tabs .ui-tabs-nav,.tcvpb-accordion .ui-accordion-header,.tcvpb-accordion .ui-accordion-content,.tcvpb_pricing-table-1 .tcvpb_pricebox_feature{border-bottom-color: '+newval+';}hr{background-color:'+newval+';}';
			$('#customizer_dynamic_borders_color_css').text(new_colors);
		});
	});

	wp.customize('title_bar_background', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = '.title_bar,.tcvpb_pricing-table-2 .tcvpb_pricebox_feature,.tcvpb_meter{background-color:'+newval+';}';
			$('#customizer_dynamic_title_bar_color_css').text(new_colors);
		});
	});

	wp.customize('footer_background', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = '#topbar.announcement_bar_style_3, footer,.tcvpb_pricing-table-1 .tcvpb_popular-plan .tcvpb_pricebox_featured_text{background:'+newval+';}footer .tagcloud a:hover{color:'+newval+';}';
			$('#customizer_dynamic_footer_background_color_css').text(new_colors);
		});
	});

	wp.customize('body_background', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = '#topbar, .sf-arrows ul li:hover .sf-with-ul:after,  nav>ul>.current-menu-ancestor>a, button, input[type="submit"], .tp-leftarrow.default:before, .tp-rightarrow.default:before, #knob_countdown div span, .portfolio_item .overlayed .overlay p a, .tcvpb-accordion .ui-icon-triangle-1-s, .tcvpb_service_box:hover .tcvpb_icon_boxed i, .ABdev_overlayed .ABdev_overlay p a, #topbar_menu li a, #blog_pagination .page-numbers.current, #blog_pagination .page-numbers:hover, .wpcf7-submit, footer a:hover, footer h4, footer #footer_copyright .footer_social_links a:hover, .tcvpb_dropcap, .tcvpb_pricing-table-2 .tcvpb_popular-plan .tcvpb_pricebox_name, .tcvpb_meter > span,.tcvpb-accordion .ui-icon-triangle-1-s,.tcvpb_team_member .ABs_overlayed .ABs_overlay p a,.tcvpb_pricing-table-1 .tcvpb_pricebox_featured_text,.tcvpb_service_box:hover .tcvpb_icon_boxed i{color:'+newval+';}body, #ABdev_sticky_header_content, #blog_pagination .page-numbers{background:'+newval+';}.testimonial_small p:after,.tcvpb_pricing-table-2 .tcvpb_pricebox_name,.tcvpb_pricing-table-2 .tcvpb_pricebox_feature{border-bottom-color: '+newval+';}';
			$('#customizer_dynamic_body_background_color_css').text(new_colors);
		});
	});

	wp.customize('pullquote_text', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = '.tcvpb_blockquote, .tcvpb_pullquote{color:'+newval+';}';
			$('#customizer_dynamic_pullquote_color_css').text(new_colors);
		});
	});

	wp.customize('footer_borders', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'footer .tagcloud a{border-color:'+newval+';}footer #footer_copyright{border-top-color:'+newval+';}';
			$('#customizer_dynamic_footer_borders_color_css').text(new_colors);
		});
	});

	wp.customize('main_menu_items', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'nav>ul>li>a{color:'+newval+';}';
			$('#customizer_dynamic_menu_items_color_css').text(new_colors);
		});
	});

	wp.customize('main_menu_items_hover', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'nav>ul>li a:hover,nav>ul>.current-menu-item>a{color:'+newval+';}';
			$('#customizer_dynamic_menu_items_hover_color_css').text(new_colors);
		});
	});

	wp.customize('footer_links', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'footer a{color:'+newval+';}';
			$('#customizer_dynamic_footer_links_color_css').text(new_colors);
		});
	});

	wp.customize('aeron_title_breadcrumbs_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = '.title_bar{ background: '+newval+';} ';
			$('#customizer_dynamic_bg_color_css').text(new_colors);
		});
	});

	wp.customize('bg_color', function(value){
		value.bind(function(newval){
			dynamic_css_targets();
			var new_colors = 'body{ background: '+newval+';} ';
			$('#customizer_dynamic_bg_color_css').text(new_colors);
		});
	});

	wp.customize('blogname', function(value){
		value.bind(function(newval){
			$('#main_logo_textual').html(newval);
		});
	});

	wp.customize('blogdescription', function(value){
		value.bind(function(newval){
			$('#main_logo_tagline').html(newval);
		});
	});

	wp.customize('copyright', function(value){
		value.bind(function(newval){
			$('.footer_copyright').html(newval);
		});
	});

	wp.customize('social_links_label', function(value){
		value.bind(function(newval){
			$('.footer_social_links').html(newval);
		});
	});


})(jQuery);