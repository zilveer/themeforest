<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.1.0
 * 
 * Theme Primary Color Schemes Rules
 * Created by CMSMasters
 * 
 */


function cmsms_theme_colors_primary() {
	$cmsms_option = cmsms_get_global_options();
	
	
	$cmsms_color_schemes = cmsms_color_schemes_list();
	
	
	unset($cmsms_color_schemes['header']);
	
	unset($cmsms_color_schemes['header_top']);
	
	
	$custom_css = "/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.1.0
 * 
 * Theme Primary Color Schemes Rules
 * Created by CMSMasters
 * 
 */

";
	
	
	foreach ($cmsms_color_schemes as $scheme => $title) {
		$rule = (($scheme != 'default') ? "html .cmsms_color_scheme_{$scheme} " : '');
		
		
		$cmsms_link = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']);
		
		$cmsms_bg = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']);
		
		$cmsms_alt = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']);
		
		$cmsms_bd = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']);
		
		
		$custom_css .= "
/***************** Start {$title} Color Scheme Rules ******************/

	/* Start Main Content Font Color */
	" . (($scheme == 'default') ? "body," : '') . (($scheme != 'default') ? ".cmsms_color_scheme_{$scheme}," : '') . "
	{$rule}.footer_inner, 
	{$rule}.tweet_time:before,
	{$rule}input[type=text],
	{$rule}input[type=number],
	{$rule}input[type=email],
	{$rule}input[type=password],
	{$rule}input[type=submit],
	{$rule}textarea,
	{$rule}select,
	{$rule}option,
	{$rule}.contact_widget_email:before,
	{$rule}.contact_widget_phone:before,
	{$rule}.adress_wrap:before,
	{$rule}.profiles.opened-article .profile .cmsms_profile_header .cmsms_profile_subtitle, 
	{$rule}.cmsms_pricing_table .cmsms_period, 
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner .cmsms_stat_title, 
	{$rule}.cmsms_breadcrumbs .cmsms_breadcrumbs_inner, 
	{$rule}.cmsms_breadcrumbs .cmsms_breadcrumbs_inner a, 
	{$rule}.widget_nav_menu li a:before, 
	{$rule}.about_author .about_author_inner .social_wrap .social_wrap_inner ul li a, 
	{$rule}.cmsms_button, 
	{$rule}.button,
	{$rule}.cmsms_paypal_donations > form:hover + span, 
	{$rule}input[type=submit],
	{$rule}input[type=button],
	{$rule}button,
	{$rule}.comment-reply-link,
	{$rule}#cancel-comment-reply-link {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	
	{$rule}input::-webkit-input-placeholder {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	{$rule}input:-moz-placeholder {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title > .cmsms_toggle_plus .cmsms_toggle_plus_hor,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title > .cmsms_toggle_plus .cmsms_toggle_plus_vert {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_color']) . "
	}
	/* Finish Main Content Font Color */
	
	
	/* Start Primary Color */
	{$rule}a,
	{$rule}h1 a:hover,
	{$rule}h2 a:hover,
	{$rule}h3 a:hover,
	{$rule}h4 a:hover,
	{$rule}h5 a:hover,
	{$rule}h6 a:hover,
	{$rule}.color_2,
	{$rule}.footer_inner a,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_icon .cmsms_icon_list_icon:before,
	{$rule}.cmsmsLike:hover:before,
	{$rule}.cmsmsLike.active:before,
	{$rule}.project .cmsms_project_comments:hover:before, 
	{$rule}.cmsms_posts_slider .project .cmsms_slider_project_comments:hover:before, 
	{$rule}.profile .cmsms_profile_comments:hover:before, 
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsmsLike:hover:before,
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsmsLike.active:before,
	{$rule}.post .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_comments:hover:before,
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_comments:hover:before,
	{$rule}.post.cmsms_masonry_type.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_comments:hover:before,
	{$rule}.post.cmsms_masonry_type.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info a.cmsmsLike:hover:before,
	{$rule}.post.cmsms_masonry_type.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info a.cmsmsLike.active:before,
	{$rule}.cmsms_post_comments:hover:before, 
	{$rule}.cmsms_search_post_comments:hover:before, 
	{$rule}.post.format-link .cmsms_post_header .cmsms_post_title a,
	{$rule}.post_nav a:hover,
	{$rule}.img_placeholder_small:hover,
	{$rule}.related_posts .related_posts_content .related_posts_content_tab .rel_post_content figure.alignleft .img_placeholder:hover, 
	{$rule}.profiles.opened-article .profile .profile_sidebar .profile_social_icons .profile_social_icons_list li a:hover, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsmsLike:hover:before, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsmsLike.active:before,
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsms_slider_post_comments:hover:before, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_header .cmsms_slider_post_title a:hover, 
	{$rule}.pl_social_list li a:hover,
	{$rule}q:before,
	{$rule}blockquote:before,
	{$rule}.cmsms_breadcrumbs .cmsms_breadcrumbs_inner a:hover, 
	{$rule}.post_comments .commentlist > li.bypostauthor .fn:before, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap > li > a:hover, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap > li > ul > li > a:hover, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap_category > li > a:hover, 
	{$rule}.about_author .about_author_inner .social_wrap .social_wrap_inner ul li a:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsms_table tr.cmsms_table_row_header td,
	{$rule}.cmsms_table tr.cmsms_table_row_header th,
	{$rule}.cmsms_icon_box.cmsms_box_colored,
	{$rule}.cmsms_icon_box.cmsms_box_lefticon:before,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title:hover > .cmsms_toggle_plus,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap.current_toggle .cmsms_toggle_title .cmsms_toggle_plus,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item.current_tab > a,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a:hover,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_bg .cmsms_icon_list_item .cmsms_icon_list_icon,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_icon .cmsms_icon_list_item:hover .cmsms_icon_list_icon,
	{$rule}.cmsms_stats.stats_mode_bars .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner,
	{$rule}.post.cmsms_default_type.format-aside .cmsms_post_cont,
	{$rule}.post.cmsms_timeline_type.format-aside .cmsms_post_cont,
	{$rule}.opened-article .post.format-aside .cmsms_post_cont,
	{$rule}.related_posts > ul li > a:hover,
	{$rule}.related_posts > ul li > a.current,
	{$rule}.post.cmsms_masonry_type.format-aside .cmsms_post_cont .cmsms_post_content, 
	{$rule}.cmsms_posts_slider .post.format-aside .cmsms_slider_post_cont .cmsms_slider_post_content,  
	{$rule}.cmsms_wrap_pagination ul li .page-numbers:hover, 
	{$rule}.cmsms_dropcap.type2, 
	{$rule}.cmsms_wrap_pagination ul li .page-numbers.current, 
	{$rule}.cmsms_post_format_img, 
	{$rule}.responsive_nav, 
	{$rule}.cmsms_button:hover, 
	{$rule}.button:hover, 
	{$rule}.cmsms_paypal_donations > span, 
	{$rule}.current > .button,
	{$rule}.button.current,
	{$rule}input[type=submit]:hover,
	{$rule}input[type=button]:hover,
	{$rule}button:hover,
	{$rule}.comment-reply-link:hover,
	{$rule}#cancel-comment-reply-link:hover, 
	{$rule}.cmsms_slider_post_format_img {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	
	{$rule}.cmsms_table tr.cmsms_table_row_header td,
	{$rule}.cmsms_table tr.cmsms_table_row_header th,
	{$rule}.cmsms_table tr.cmsms_table_row_header td:first-child,
	{$rule}.cmsms_table tr.cmsms_table_row_header th:first-child,
	{$rule}.cmsms_table tr.cmsms_table_row_header td:last-child,
	{$rule}.cmsms_table tr.cmsms_table_row_header th:last-child,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title:hover > .cmsms_toggle_plus,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap.current_toggle .cmsms_toggle_title .cmsms_toggle_plus,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item.current_tab > a,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a:hover,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item.current_tab:first-child > a,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item:first-child > a:hover,
	{$rule}.cmsms_tabs.tabs_mode_tour .cmsms_tabs_list .cmsms_tabs_list_item.current_tab > a,
	{$rule}.cmsms_tabs.tabs_mode_tour .cmsms_tabs_list .cmsms_tabs_list_item > a:hover,
	{$rule}.cmsms_tabs.tabs_mode_tour .cmsms_tabs_list .cmsms_tabs_list_item.current_tab:first-child > a,
	{$rule}.cmsms_tabs.tabs_mode_tour .cmsms_tabs_list .cmsms_tabs_list_item:first-child > a:hover,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_border .cmsms_icon_list_item .cmsms_icon_list_icon,
	{$rule}.related_posts > ul li > a:hover,
	{$rule}.related_posts > ul li > a.current,
	{$rule}.related_posts > ul li:first-child > a:hover,
	{$rule}.related_posts > ul li:first-child > a.current, 
	{$rule}.cmsms_button:hover, 
	{$rule}.button:hover, 
	{$rule}.cmsms_paypal_donations > span, 
	{$rule}.current > .button,
	{$rule}.button.current,
	{$rule}input[type=submit]:hover,
	{$rule}input[type=button]:hover,
	{$rule}button:hover,
	{$rule}.comment-reply-link:hover,
	{$rule}#cancel-comment-reply-link:hover {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
	}
	
	@media only screen and (max-width: 540px) {
		{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item.current_tab > a, 
		{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a:hover, 
		{$rule}.related_posts > ul li > a.current, 
		{$rule}.related_posts > ul li > a:hover {
			" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
		}
	}
	/* Finish Primary Color */
	
	
	/* Start Highlight Color */
	{$rule}a:hover,
	{$rule}.footer_inner a:hover,
	{$rule}.footer_inner nav > div > ul > li:hover > a,
	{$rule}.footer_inner nav > div > ul > li.current-menu-item > a,
	{$rule}.footer_inner nav > div > ul > li.current-menu-ancestor > a,
	{$rule}.cmsms_toggles .cmsms_toggles_filter > a.current_filter,
	{$rule}.widget_nav_menu ul li.current-menu-item a,
	{$rule}.img_placeholder_small,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=\"checkbox\"] + span.wpcf7-list-item-label:after,
	{$rule}.cmsms-form-builder .check_parent input[type=\"checkbox\"]+label:after, 
	{$rule}.pl_social_list li a, 
	{$rule}.post_nav a {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_hover']) . "
	}
	
	{$rule}.owl-buttons .owl-prev:hover,
	{$rule}.owl-buttons .owl-next:hover,
	{$rule}.owl-page:hover, 
	{$rule}.owl-page.active, 
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover .cmsms_next_arrow, 
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover .cmsms_prev_arrow, 
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover .cmsms_next_arrow,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover .cmsms_next_arrow,
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover .cmsms_prev_arrow,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover .cmsms_prev_arrow,
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover .cmsms_next_arrow,
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover .cmsms_prev_arrow,
	{$rule}.cmsms-form-builder .check_parent input[type=\"radio\"]+label:after,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=\"radio\"] + span.wpcf7-list-item-label:after {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_hover']) . "
	}
	
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover .cmsms_next_arrow:after,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover .cmsms_next_arrow:after,
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover .cmsms_prev_arrow:after,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover .cmsms_prev_arrow:after,
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover .cmsms_next_arrow:before,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover .cmsms_next_arrow:before,
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover .cmsms_prev_arrow:before,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover .cmsms_prev_arrow:before,
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover .cmsms_next_arrow:after,
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover .cmsms_prev_arrow:after,
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover .cmsms_next_arrow:before,
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover .cmsms_prev_arrow:before,
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover .cmsms_next_arrow:after,
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover .cmsms_prev_arrow:after,
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover .cmsms_next_arrow:before,
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover .cmsms_prev_arrow:before {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_hover']) . "
	}
	/* Finish Highlight Color */
	
	
	/* Start Headings Color */
	{$rule}h1,
	{$rule}h2,
	{$rule}h3,
	{$rule}h4,
	{$rule}h5,
	{$rule}h6,
	{$rule}h1 a,
	{$rule}h2 a,
	{$rule}h3 a,
	{$rule}h4 a,
	{$rule}h5 a,
	{$rule}h6 a,
	{$rule}.search_bar_wrap button[type=submit][class^=\"cmsms-icon-\"],
	{$rule}.search_bar_wrap button[type=submit][class*=\" cmsms-icon-\"],
	" . (($scheme == 'default') ? "#slide_top:hover," : '') . "
	{$rule}.cmsms_notice .notice_close,
	{$rule}.cmsms_icon_box.cmsms_box_colored .icon_box_button,
	{$rule}.cmsms_icon_box.cmsms_box_colored .icon_box_button:hover,
	{$rule}.cmsms_icon_box.cmsms_box_centered:before,
	{$rule}.cmsms_featured_block .featured_block_inner .featured_block_button,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title > a,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a,
	{$rule}.post .cmsms_post_date,
	{$rule}.post .cmsms_post_cont_info,
	{$rule}.cmsms_search_post_cont_info,
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont_info,
	{$rule}.cmsmsLike,
	{$rule}.cmsmsLike:hover,
	{$rule}.opened-article .post .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	{$rule}.cmsms_search_post_date,
	{$rule}.cmsms_post_comments,
	{$rule}.cmsms_post_comments:hover,
	{$rule}.cmsms_search_post_comments,
	{$rule}.post.format-chat .cmsms_post_cont .cmsms_chat .cmsms_chat_item .cmsms_chat_author_time .cmsms_chat_author,
	{$rule}.cmsms_posts_slider .post.format-chat .cmsms_slider_post_cont .cmsms_slider_post_chat .cmsms_chat_item .cmsms_chat_author_time .cmsms_chat_author,
	{$rule}.related_posts > ul li > a,
	{$rule}.related_posts .related_posts_content .related_posts_content_tab .rel_post_content figure.alignleft .img_placeholder,
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	{$rule}.post.cmsms_masonry_type.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	{$rule}.post.cmsms_masonry_type.format-status .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsmsLike,
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_comments, 
	{$rule}.post.format-link .cmsms_post_header .cmsms_post_title a:hover,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_cont_info a,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info a.cmsmsLike:hover:before,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info a.cmsmsLike.active:before,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_comments:hover:before,
	{$rule}.project .cmsms_project_cont_info, 
	{$rule}.project .cmsmsLike, 
	{$rule}.project .cmsms_project_comments, 
	{$rule}.cmsms_posts_slider .project .cmsms_slider_project_cont_info, 
	{$rule}.cmsms_posts_slider .project .cmsmsLike, 
	{$rule}.cmsms_posts_slider .project .cmsms_slider_project_comments, 
	{$rule}.profile .cmsms_profile_comments, 
	{$rule}.cmsms_img_rollover_wrap .img_placeholder:before, 
	{$rule}#wp-calendar thead th,
	{$rule}.profiles.opened-article .profile .profile_sidebar .profile_social_icons .profile_social_icons_list li a, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsms_slider_post_date, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsmsLike, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsms_slider_post_comments, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_header .cmsms_slider_post_title, 
	{$rule}.cmsms_pricing_table .cmsms_pricing_item .cmsms_price_wrap .cmsms_currency, 
	{$rule}.cmsms_pricing_table .cmsms_pricing_item .cmsms_price_wrap .cmsms_price, 
	{$rule}.cmsms_pricing_table .cmsms_pricing_item .cmsms_price_wrap .cmsms_coins,
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_header .cmsms_slider_post_title a, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap > li > a, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap > li > ul > li > a, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap > li > ul > li > ul li a:before, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap_category > li > a, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap_category > li > ul li a:before, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap_archive > li a:before {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.cmsms_icon_list_items .cmsms_icon_list_item .cmsms_icon_list_icon,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_circles .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner,
	{$rule}.cmsms_search .cmsms_search_post .cmsms_search_post_number, 
	{$rule}.post.format-quote .cmsms_quote_content,
	{$rule}.post.cmsms_default_type.format-status .cmsms_post_cont,
	{$rule}.post.cmsms_timeline_type.format-status .cmsms_post_cont,
	{$rule}.opened-article .post.format-status .cmsms_post_cont,
	{$rule}.cmsms_prev_arrow,
	{$rule}.cmsms_next_arrow,
	{$rule}.post.cmsms_masonry_type.format-status .cmsms_post_cont .cmsms_post_content, 
	{$rule}.cmsms_posts_slider .post.format-status .cmsms_slider_post_cont .cmsms_slider_post_content, 
	{$rule}.cmsms_wrap_pagination ul li .page-numbers, 
	{$rule}.owl-carousel .owl-controls .owl-pagination .owl-page:hover, 
	{$rule}.owl-carousel .owl-controls .owl-pagination .owl-page.active, 
	{$rule}.cmsms_posts_slider .post.format-quote .cmsms_slider_post_cont .cmsms_slider_post_quote_content, 
	{$rule}.responsive_nav:hover, 
	{$rule}.responsive_nav.active {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}input[type=text]:focus,
	{$rule}input[type=email]:focus,
	{$rule}input[type=password]:focus,
	{$rule}textarea:focus,
	{$rule}select:focus,
	{$rule}.cmsms_prev_arrow:before,
	{$rule}.cmsms_next_arrow:before,
	{$rule}.cmsms_prev_arrow:after,
	{$rule}.cmsms_next_arrow:after,
	{$rule}.cmsms_prev_arrow span:before,
	{$rule}.cmsms_next_arrow span:before,
	{$rule}.cmsms_prev_arrow span:after,
	{$rule}.cmsms_next_arrow span:after, 
	{$rule}.cmsms_posts_slider .owl-controls .owl-buttons .owl-prev:hover, 
	{$rule}.cmsms_posts_slider .owl-controls .owl-buttons .owl-next:hover {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	
	{$rule}.post.format-quote .cmsms_quote_content:before, 
	{$rule}.cmsms_posts_slider .post.format-quote .cmsms_slider_post_cont .cmsms_slider_post_quote_content:before {
		" . cmsms_color_css('border-' . (is_rtl() ? 'left' : 'right') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']) . "
	}
	/* Finish Headings Color */
	
	
	/* Start Main Background Color */
	{$rule}.cmsms_table tr.cmsms_table_row_header td,
	{$rule}.cmsms_table tr.cmsms_table_row_header th,
	" . (($scheme == 'default') ? "#slide_top," : '') . "
	{$rule}.cmsms_icon_box.cmsms_box_lefticon:before,
	{$rule}.cmsms_icon_box.cmsms_box_colored,
	{$rule}.cmsms_icon_box.cmsms_box_colored a:hover,
	{$rule}.cmsms_icon_box.cmsms_box_colored h1,
	{$rule}.cmsms_icon_box.cmsms_box_colored h2,
	{$rule}.cmsms_icon_box.cmsms_box_colored h3,
	{$rule}.cmsms_icon_box.cmsms_box_colored h4,
	{$rule}.cmsms_icon_box.cmsms_box_colored h5,
	{$rule}.cmsms_icon_box.cmsms_box_colored h6,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item.current_tab > a,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a:hover,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_border .cmsms_icon_list_item .cmsms_icon_list_icon:before,
	{$rule}.cmsms_stats.stats_mode_bars .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_circles .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner,
	{$rule}.cmsms_post_format_img,
	{$rule}.cmsms_search .cmsms_search_post .cmsms_search_post_number, 
	{$rule}.cmsms_slider_post_format_img,
	{$rule}.post.format-quote .cmsms_quote_content,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_content,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_cont_info,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_cont_info a:hover,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info a,
	{$rule}.post.format-aside .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	{$rule}.post.format-status .cmsms_post_cont .cmsms_post_content,
	{$rule}.post.format-status .cmsms_post_cont .cmsms_post_footer .cmsms_post_cont_info,
	{$rule}.post.format-status .cmsms_post_cont .cmsms_post_footer .cmsms_post_cont_info a:hover,
	{$rule}.post.format-status .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info a,
	{$rule}.post.format-status .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	{$rule}.related_posts > ul li > a:hover,
	{$rule}.related_posts > ul li > a.current, 
	{$rule}.cmsms_wrap_pagination ul li .page-numbers, 
	{$rule}.cmsms_posts_slider .post.format-quote .cmsms_slider_post_cont .cmsms_slider_post_quote_content,
	{$rule}.cmsms_posts_slider .post.format-status .cmsms_slider_post_cont .cmsms_slider_post_content,
	{$rule}.cmsms_posts_slider .post.format-aside .cmsms_slider_post_cont .cmsms_slider_post_content, 
	{$rule}.cmsms_dropcap.type2, 
	{$rule}.responsive_nav:before,
	{$rule}.cmsms_button:hover, 
	{$rule}.button:hover, 
	{$rule}.cmsms_paypal_donations > span, 
	{$rule}.current > .button,
	{$rule}.button.current,
	{$rule}input[type=submit]:hover,
	{$rule}input[type=button]:hover,
	{$rule}button:hover,
	{$rule}.comment-reply-link:hover,
	{$rule}#cancel-comment-reply-link:hover {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	" . (($scheme == 'default') ? "body," : '') . (($scheme != 'default') ? ".cmsms_color_scheme_{$scheme}," : '') . "
	{$rule}input[type=text]:focus,
	{$rule}input[type=number]:focus,
	{$rule}input[type=email]:focus,
	{$rule}input[type=password]:focus,
	{$rule}textarea:focus,
	{$rule}select:focus,
	" . (($scheme == 'default') ? ".middle_inner," : '') . "
	" . (($scheme != 'default') ? "{$rule}.bottom_bg," : '') . "
	{$rule}.footer_bg,
	" . (($scheme == 'default') ? "#slide_top:hover," : '') . "
	" . (($scheme != 'default') ? "{$rule}.headline_outer," : '') . "
	{$rule}.cmsms_notice .notice_close,
	{$rule}.cmsms_icon_box.cmsms_box_colored .icon_box_button,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title > .cmsms_toggle_plus,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title:hover > .cmsms_toggle_plus .cmsms_toggle_plus_hor,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title:hover > .cmsms_toggle_plus .cmsms_toggle_plus_vert,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap.current_toggle .cmsms_toggle_title .cmsms_toggle_plus .cmsms_toggle_plus_hor,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap.current_toggle .cmsms_toggle_title .cmsms_toggle_plus .cmsms_toggle_plus_vert,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_prev_arrow, 
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_next_arrow, 
	{$rule}.post.cmsms_timeline_type .cmsms_post_info .cmsms_post_date, 
	{$rule}.portfolio .project .project_outer, 
	{$rule}.cmsms_posts_slider .project .slider_project_outer, 
	{$rule}.cmsms_img_rollover_wrap .cmsms_img_rollover .cmsms_image_link, 
	{$rule}.cmsms_img_rollover_wrap .cmsms_img_rollover .cmsms_open_link, 
	{$rule}.owl-buttons .owl-prev, 
	{$rule}.owl-buttons .owl-next, 
	{$rule}.owl-prev:hover .cmsms_prev_arrow, 
	{$rule}.owl-next:hover .cmsms_next_arrow, 
	{$rule}.owl-page, 
	{$rule}.cmsms_quotes_slider .owl-buttons > div:hover, 
	{$rule}.cmsms_pricing_table .cmsms_pricing_item.pricing_best, 
	{$rule}.cmsms_clients_slider .owl-buttons > div:hover,
	{$rule}.cmsms_clients_item:hover,
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div:hover,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div:hover,
	{$rule}.cmsms_toggles.toggles_mode_accordion .cmsms_toggle_wrap.current_toggle,
	{$rule}.owl-carousel .owl-controls .owl-pagination .owl-page, 
	{$rule}.cmsms_breadcrumbs, 
	{$rule}.cmsms_button, 
	{$rule}.button,
	{$rule}.cmsms_paypal_donations > form:hover + span, 
	{$rule}input[type=submit],
	{$rule}input[type=button],
	{$rule}button,
	{$rule}.comment-reply-link,
	{$rule}#cancel-comment-reply-link {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.owl-prev:hover .cmsms_prev_arrow:after,
	{$rule}.owl-next:hover .cmsms_next_arrow:after,
	{$rule}.owl-prev:hover .cmsms_prev_arrow:before,
	{$rule}.owl-next:hover .cmsms_next_arrow:before,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_prev_arrow:before,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_next_arrow:before,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_prev_arrow:after,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_next_arrow:after,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_prev_arrow span:before,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_next_arrow span:before,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_prev_arrow span:after,
	{$rule}.cmsms_wrap_pagination ul li .page-numbers .cmsms_next_arrow span:after {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	/* Finish Main Background Color */
	
	
	/* Start Alternate Background Color */
	{$rule}.cmsms_icon_box.cmsms_box_colored a,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_icon .cmsms_icon_list_icon_wrap {
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
	}
	
	{$rule}input[type=text],
	{$rule}input[type=number],
	{$rule}input[type=email],
	{$rule}input[type=password],
	{$rule}textarea,
	{$rule}select,
	{$rule}option,
	{$rule}.cmsms_table tr.cmsms_table_row_footer td,
	{$rule}.cmsms_table tr.cmsms_table_row_footer th,
	{$rule}.search_bar_wrap,
	{$rule}.search_bar_wrap input[type=text],
	{$rule}.search_bar_wrap input[type=text]:focus,
	" . (($scheme == 'default') ? "{$rule}.headline_outer," : '') . "
	" . (($scheme == 'default') ? "{$rule}.bottom_bg," : '') . "
	{$rule}.cmsms_featured_block,
	{$rule}.widget_nav_menu ul li a:hover,
	{$rule}.widget_nav_menu ul li.current-menu-item > a,
	{$rule}.quote_grid,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_icon .cmsms_icon_list_icon,
	{$rule}.cmsms_pricing_item,
	{$rule}.cmsms_clients_item,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=\"checkbox\"] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsms-form-builder .check_parent input[type=\"checkbox\"]+label:before,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=\"radio\"] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsms-form-builder .check_parent input[type=\"radio\"]+label:before,
	{$rule}.post .cmsms_post_cont, 
	{$rule}.post.cmsms_default_type.format-chat .cmsms_post_cont, 
	{$rule}.post.cmsms_default_type.format-audio .cmsms_post_cont, 
	{$rule}.post.cmsms_default_type.format-link .cmsms_post_cont, 
	{$rule}.post.cmsms_default_type.format-quote .cmsms_quote_info, 
	{$rule}.post .wp-caption, 
	{$rule}.related_posts_content, 
	{$rule}.about_author .about_author_inner,
	{$rule}.post_nav, 
	{$rule}.post_comments .commentlist .comment-body, 
	{$rule}.portfolio .project .project_outer .project_inner, 
	{$rule}.cmsms_posts_slider .project .slider_project_outer .slider_project_inner, 
	{$rule}.cmsms_img.with_caption,
	{$rule}.related_posts > ul li > a,
	{$rule}.cmsms_tabs.tabs_mode_tab .cmsms_tabs_wrap,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a,
	{$rule}.cmsms_toggles.toggles_mode_accordion .cmsms_toggle_wrap,
	{$rule}.cmsms_profile.vertical .format-profile .pl_img .pl_noimg,
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont, 
	{$rule}.tweet_list li,
	{$rule}.quote_content, 
	{$rule}code {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
	}
	
	{$rule}.post.cmsms_default_type .cmsms_post_cont {
		background-color:transparent;
	}
	
	{$rule}.quote_content:after {
		" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_alternate']) . "
	}
	/* Finish Alternate Background Color */
	
	
	/* Start Borders Color */
	{$rule}.content_wrap:before,
	{$rule}.cmsms_featured_block .featured_block_inner .featured_block_button,
	{$rule}.post.format-chat .cmsms_post_cont .cmsms_chat .cmsms_chat_item:before,
	{$rule}.cmsms_posts_slider .post.format-chat .cmsms_slider_post_cont .cmsms_slider_post_chat .cmsms_chat_item:before,
	{$rule}.post_comments .commentlist .comment-body:before, 
	{$rule}.blog.timeline:before, 
	{$rule}.cmsms_profile.vertical .format-profile:before,
	{$rule}.cmsms_icon_list_items.cmsms_icon_list_type_block .cmsms_icon_list_item:before,
	{$rule}.post.cmsms_timeline_type:before, 
	{$rule}.cmsms_sitemap_wrap .cmsms_sitemap > li:before {
		" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	@media only screen and (max-width: 950px) {
		{$rule}.content_wrap .sidebar:before {
			" . cmsms_color_css('background-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
	}
	
	{$rule}input[type=text],
	{$rule}input[type=email],
	{$rule}input[type=password],
	{$rule}textarea,
	{$rule}select,
	{$rule}option,
	{$rule}.search_bar_wrap,
	" . (($scheme == 'default') ? "#slide_top:hover," : '') . "
	{$rule}.headline_outer,
	{$rule}.cmsms_notice .notice_close,
	{$rule}.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title > .cmsms_toggle_plus,
	{$rule}.cmsms_toggles.toggles_mode_accordion .cmsms_toggle_wrap,
	{$rule}.cmsms_tabs.tabs_mode_tab .cmsms_tabs_wrap,
	{$rule}.cmsms_tabs.tabs_mode_tour .cmsms_tabs_list .cmsms_tabs_list_item > a,
	{$rule}.cmsms_icon_list_items.cmsms_icon_list_type_block .cmsms_icon_list_item,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_bg .cmsms_icon_list_icon,
	{$rule}.cmsms_icon_list_items.cmsms_color_type_icon .cmsms_icon_list_icon,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap .cmsms_stat,
	{$rule}.post.format-quote .cmsms_quote_info,
	{$rule}.post.cmsms_default_type.format-audio .cmsms_post_cont,
	{$rule}.post.cmsms_default_type.format-link .cmsms_post_cont,
	{$rule}.post.cmsms_default_type.format-chat .cmsms_post_cont,
	{$rule}.post.cmsms_timeline_type .cmsms_post_cont,
	{$rule}.opened-article .post.format-chat .cmsms_post_cont,
	{$rule}.post_nav,
	{$rule}.about_author .about_author_inner,
	{$rule}.related_posts > ul li > a,
	{$rule}.related_posts > ul li:first-child > a,
	{$rule}.related_posts .related_posts_content,
	{$rule}.related_posts .related_posts_content .related_posts_content_tab .rel_post_content figure.alignleft,
	{$rule}.post_comments .commentlist .comment-body,
	{$rule}.comment-body + .comment-respond,
	{$rule}.post.cmsms_masonry_type .cmsms_post_cont, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont, 
	{$rule}.quote_content, 
	{$rule}.quote_grid, 
	{$rule}.portfolio.large_gap .project .project_outer,
	{$rule}.cmsms_posts_slider .project .slider_project_outer,
	{$rule}.cmsms_img.with_caption,
	{$rule}.cmsms_quotes_slider .owl-buttons > div,
	{$rule}.cmsms_clients_slider .owl-page,
	{$rule}.cmsms_clients_slider .owl-wrapper-outer,
	{$rule}.cmsms_pricing_table .cmsms_pricing_item,
	{$rule}.cmsms_clients_slider .owl-buttons > div,
	{$rule}.tweet_list li,
	{$rule}.cmsms_tabs.lpr .cmsms_tabs_wrap,
	{$rule}.img_placeholder_small,
	{$rule}.widget_custom_popular_projects_entries .img_placeholder,
	{$rule}.widget_custom_latest_projects_entries .img_placeholder,
	{$rule}.widget_custom_latest_projects_entries .owl-buttons > div,
	{$rule}.widget_custom_popular_projects_entries .owl-buttons > div,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=\"checkbox\"] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsms-form-builder .check_parent input[type=\"checkbox\"]+label:before,
	{$rule}.wpcf7 form.wpcf7-form span.wpcf7-list-item input[type=\"radio\"] + span.wpcf7-list-item-label:before, 
	{$rule}.cmsms-form-builder .check_parent input[type=\"radio\"]+label:before,
	{$rule}.cmsms_quotes_slider .quote_content, 
	{$rule}.wp-caption, 
	{$rule}.cmsms_profile.vertical .format-profile .pl_img .pl_noimg, 
	{$rule}.cmsms_posts_slider .owl-controls .owl-buttons .owl-prev, 
	{$rule}.cmsms_posts_slider .owl-controls .owl-buttons .owl-next, 
	{$rule}code, 
	{$rule}.cmsms_button, 
	{$rule}.button,
	{$rule}input[type=submit],
	{$rule}input[type=button],
	{$rule}button,
	{$rule}.comment-reply-link,
	{$rule}#cancel-comment-reply-link {
		" . cmsms_color_css('border-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.cmsms_table tr:first-child td,
	{$rule}.bottom_bg,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a,
	{$rule}.cmsms_tabs.tabs_mode_tour .cmsms_tabs_list .cmsms_tabs_list_item:first-child > a,
	{$rule}.widget_nav_menu ul li a,
	{$rule}.post .cmsms_post_cont .cmsms_post_footer,
	{$rule}.cmsms_search .cmsms_search_post .cmsms_search_post_cont .cmsms_search_post_footer, 
	{$rule}.opened-article .post .cmsms_post_footer, 
	{$rule}.post.cmsms_timeline_type.format-chat .cmsms_post_cont .cmsms_post_footer, 
	{$rule}.post.cmsms_timeline_type.format-quote .cmsms_post_cont .cmsms_post_footer, 
	{$rule}.portfolio .project .project_outer .project_inner, 
	{$rule}.cmsms_posts_slider .project .slider_project_outer .slider_project_inner, 
	{$rule}.portfolio.opened-article .project .project_sidebar .project_details .project_details_item, 
	{$rule}.portfolio.opened-article .project .project_sidebar .project_features .project_features_item, 
	{$rule}.profiles.opened-article .profile .profile_sidebar .profile_details .profile_details_item,
	{$rule}.profiles.opened-article .profile .profile_sidebar .profile_features .profile_features_item,
	{$rule}.cmsms_pricing_item .cmsms_price_wrap:after, 
	{$rule}.cmsms_pricing_item .cmsms_price_wrap:before, 
	{$rule}.cmsms_profile.horizontal .pl_social_list, 
	{$rule}.tweet_list li:first-child, 
	{$rule}.quote_content:before, 
	{$rule}.cmsms_clients_grid .cmsms_clients_item, 
	{$rule}.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer {
		" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		{$rule}.quote_grid.quote_four .quotes_list .cmsms_quote {
			" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
	}
	
	@media only screen and (max-width: 767px) {
		{$rule}.cmsms_clients_grid .cmsms_clients_item:first-child, 
		{$rule}.quote_grid.quote_four .quotes_list .cmsms_quote, 
		{$rule}.quote_grid.quote_three .quotes_list .cmsms_quote, 
		{$rule}.quote_grid.quote_two .quotes_list .cmsms_quote {
			" . cmsms_color_css('border-top-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
		
		{$rule}.cmsms_clients_grid .cmsms_clients_item {
			" . cmsms_color_css('border-left-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
		
		{$rule}.cmsms_clients_grid .cmsms_clients_item {
			" . cmsms_color_css('border-right-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
	}
	
	{$rule}.cmsms_table tr td,
	{$rule}.cmsms_table tr th,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a,
	{$rule}hr,
	{$rule}.cmsms_divider,
	{$rule}.post.cmsms_default_type .cmsms_post_cont,
	{$rule}.post.cmsms_default_type.format-link .cmsms_post_cont .cmsms_post_header,
	{$rule}.opened-article .post, 
	{$rule}.cmsms_post_filter_wrap, 
	{$rule}.cmsms_project_filter_wrap, 
	{$rule}.sidebar .widget,
	{$rule}.quote_grid .quotes_list,
	{$rule}.portfolio.opened-article .project .cmsms_project_header, 
	{$rule}.profiles.opened-article .profile .cmsms_profile_header, 
	{$rule}.cmsms_widget_divider, 
	{$rule}.cmsms_clients_grid .cmsms_clients_item, 
	{$rule}.cmsms_breadcrumbs, 
	{$rule}.cmsms_search .cmsms_search_post .cmsms_search_post_cont {
		" . cmsms_color_css('border-bottom-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.cmsms_pricing_table .cmsms_pricing_item:first-child, 
	{$rule}.cmsms_pricing_table .cmsms_pricing_item.pricing_best, 
	{$rule}.quote_grid.quote_three:before, 
	{$rule}.quote_grid.quote_four:after, 
	{$rule}.quote_grid.quote_four:before, 
	{$rule}.quote_grid.quote_three:before, 
	{$rule}.quote_vert, 
	{$rule}.cmsms_table tr td:first-child, 
	{$rule}.cmsms_table tr th:first-child, 
	{$rule}.footer_inner nav > div > ul > li,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item:first-child > a,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap.one_fourth:nth-child(4n+1) .cmsms_stat,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap.one_third:nth-child(3n+1) .cmsms_stat,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap.one_half:nth-child(2n+1) .cmsms_stat,
	{$rule}.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap.one_first .cmsms_stat {
		" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	@media only screen and (max-width: 1024px) {
		{$rule}.cmsms_stats.stats_type_numbers .cmsms_stat_wrap.one_fourth:nth-child(2n+1) .cmsms_stat {
			" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
	}
	
	@media only screen and (max-width: 767px) {
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_third .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_third.one_third:nth-child(3n+1) .cmsms_stat,
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_third.one_third:nth-child(3n) .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_third.one_third:last-child .cmsms_stat {
			" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
	}
	
	@media only screen and (max-width: 540px) {
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_fourth .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_fourth:nth-child(n) .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_third .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_fourth:nth-child(n) .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_half .cmsms_stat, 
		{$rule}.cmsms_stats.stats_type_numbers.stats_mode_counters .cmsms_stat_wrap.one_half:nth-child(n) .cmsms_stat, 
		{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a, 
		{$rule}.related_posts > ul li > a {
			" . cmsms_color_css('border-' . (is_rtl() ? 'right' : 'left') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
		}
	}
	
	{$rule}.cmsms_clients_grid .cmsms_clients_item:last-child,
	{$rule}.cmsms_clients_grid.clients_two .cmsms_clients_item:nth-child(2n),
	{$rule}.cmsms_clients_grid.clients_three .cmsms_clients_item:nth-child(3n),
	{$rule}.cmsms_clients_grid.clients_four .cmsms_clients_item:nth-child(4n),
	{$rule}.cmsms_clients_grid.clients_five .cmsms_clients_item:nth-child(5n),
	{$rule}.cmsms_clients_grid.clients_one .cmsms_clients_item:last-child,
	{$rule}.cmsms_clients_grid.clients_one .cmsms_clients_item,
	{$rule}.cmsms_table tr td:last-child,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a,
	{$rule}.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item:first-child > a,
	{$rule}.cmsms_table tr th:last-child {
		" . cmsms_color_css('border-' . (is_rtl() ? 'left' : 'right') . '-color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_border']) . "
	}
	
	{$rule}.cmsms_clients_item {
		-webkit-box-shadow:-1px 0 0 rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
		-moz-box-shadow:-1px 0 0 rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
		box-shadow:-1px 0 0 rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
	}
	/* Finish Borders Color */
	
	
	/* Start Custom Rules */
	{$rule}::selection {
		" . cmsms_color_css('background', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . ";
	}
	
	{$rule}::-moz-selection {
		" . cmsms_color_css('background', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_link']) . "
		" . cmsms_color_css('color', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']) . "
	}
	
	{$rule}.cmsms_img_rollover_wrap:hover .cmsms_img_rollover {
		background-color:rgba(" . hex2rgb($cmsms_link[0]) . ", 0.8);
	}
	
	{$rule}.cmsms_notice .notice_close:hover {
		color:#dd0000;
	}
	
	{$rule}.portfolio.small_gap .project .project_outer {
		-webkit-box-shadow:0 0 0 1px rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
		-moz-box-shadow:0 0 0 1px rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
		box-shadow:0 0 0 1px rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
	}
	";
	
	
	if ($scheme == 'default') {
	$cmsms_def_heading = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_heading']);
	
	$cmsms_def_bg = explode('|', $cmsms_option[CMSMS_SHORTNAME . '_' . $scheme . '_bg']);
	
	
	$custom_css .= "
	#slide_top {
		background-color:rgba(" . hex2rgb($cmsms_def_heading[0]) . ", 0.5);
		border-color:rgba(" . hex2rgb($cmsms_def_bg[0]) . ", 0.15);
	}
	";
	}
	
	
	$custom_css .= "
	{$rule}.footer_bg {
		-webkit-box-shadow:inset 0 1px 0 0 rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
		-moz-box-shadow:inset 0 1px 0 0 rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
		box-shadow:inset 0 1px 0 0 rgba(" . hex2rgb($cmsms_bd[0]) . ", " . ((int) $cmsms_bd[1] / 100) . ");
	}
	/* Finish Custom Rules */

/***************** Finish {$title} Color Scheme Rules ******************/


";
	}
	
	
	return $custom_css;
}

