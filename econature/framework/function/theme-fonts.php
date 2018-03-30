<?php
/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.2.2
 * 
 * Theme Fonts Rules
 * Created by CMSMasters
 * 
 */


function cmsms_theme_fonts() {
	$cmsms_option = cmsms_get_global_options();
	
	
	$custom_css = "/**
 * @package 	WordPress
 * @subpackage 	EcoNature
 * @version 	1.2.1
 * 
 * Theme Fonts Rules
 * Created by CMSMasters
 * 
 */


/***************** Start Theme Font Styles ******************/

	/* Start Content Font */
	body, 
	.cmsms_breadcrumbs .cmsms_breadcrumbs_inner, 
	.cmsms_breadcrumbs .cmsms_breadcrumbs_inner a {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_content_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_content_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_style'] . ";
	}
	
	.cmsms_posts_slider .post .cmsms_slider_post_content, 
	.cmsms_posts_slider .post .cmsms_slider_post_quote_author, 
	.post.cmsms_timeline_type .cmsms_post_info .cmsms_post_date .cmsms_year {
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_size'] . "px;
	}
	
	.wp-caption .wp-caption-text {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_size'] + 1) . "px;
	}
	/* Finish Content Font */


	/* Start Link Font */
	a,
	#cancel-comment-reply-link {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_link_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_link_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_link_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_link_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_link_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_link_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_link_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_link_font_text_decoration'] . ";
	}

	.cmsms_post_filter_wrap .cmsms_post_filter .cmsms_post_filter_block .cmsms_post_filter_but:before {
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_link_font_font_size'] . "px;
	}

	a:hover {
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_link_hover_decoration'] . ";
	}
	/* Finish Link Font */


	/* Start Navigation Title Font */
	#navigation > li > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li:hover > a {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_text_transform'] . ";
	}

	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li > a,
	#navigation > li.menu-item-mega > div.menu-item-mega-container > ul > li:hover > a {
		font-weight:700; // static
	}
	
	@media only screen and (max-width: 1024px) {
		html #page #header nav #navigation li a {
			font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_font_size'] - 1) . "px;
			font-weight:400; // static
		}
		
		html #page #header nav #navigation > li > a {
			font-weight:500; // static
		}
		
		html #page #header nav #navigation li li li a {
			font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_nav_title_font_font_size'] - 3) . "px;
		}
	}
	/* Finish Navigation Title Font */


	/* Start Navigation Dropdown Font */
	#navigation ul li a {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_nav_dropdown_font_text_transform'] . ";
	}
	/* Finish Navigation Dropdown Font */


	/* Start H1 Font */
	h1,
	h1 a,
	.pricing_title,
	#header .logo .title,
	.error_subtitle,
	.cmsms_pricing_table .cmsms_currency,
	.cmsms_pricing_table .cmsms_price,
	.cmsms_pricing_table .cmsms_coins,
	.post.format-quote .cmsms_quote_content,
	.post.format-aside .cmsms_post_cont .cmsms_post_content,
	.post.format-status .cmsms_post_cont .cmsms_post_content,
	.share_posts > h3,
	.about_author > h3,
	.related_posts > h3,
	.comment-respond .comment-reply-title, 
	.cmsms_search_post_number {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h1_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_text_decoration'] . ";
	}
	
	.headline_outer .headline_inner .headline_icon[class^=\"cmsms-icon-\"]:before,
	.headline_outer .headline_inner .headline_icon[class*=\" cmsms-icon-\"]:before {
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_line_height'] . "px;
	}
	
	.headline_outer .headline_inner.align_center .headline_icon[class^=\"cmsms-icon-\"]:before,
	.headline_outer .headline_inner.align_center .headline_icon[class*=\" cmsms-icon-\"]:before {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h1_font_line_height'] + 20) . "px;
	}
	
	.cmsms_dropcap {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h1_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_system_font'] . ";
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_text_decoration'] . ";
	}
	
	.cmsms_dropcap {
		font-size:40px; // static
	}
	
	.cmsms_dropcap.type2 {
		font-size:30px; // static
	}
	
	.headline_outer .headline_inner.align_left .headline_icon {
		padding-left:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h1_font_line_height'] + 15) . "px;
	}
	
	.headline_outer .headline_inner.align_right .headline_icon {
		padding-right:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h1_font_line_height'] + 15) . "px;
	}
	
	.headline_outer .headline_inner.align_center .headline_icon {
		padding-top:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h1_font_line_height'] + 20) . "px;
	}
	
	.cmsms_pricing_table .cmsms_currency,
	.cmsms_pricing_table .cmsms_price,
	.cmsms_pricing_table .cmsms_coins {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_size'] + 20) . "px;
		line-height:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h1_font_line_height'] + 20) . "px;
	}
	
	.cmsms_icon_box.cmsms_box_heading h1:before {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_size'] + 5) . "px;
	}
	/* Finish H1 Font */


	/* Start H2 Font */
	h2,
	h2 a,
	.cmsms_twitter .cmsms_twitter_item_content,
	.cmsms_twitter .cmsms_twitter_item_content a, 
	.post.cmsms_masonry_type.format-quote .cmsms_post_cont .cmsms_quote_content,
	.post.cmsms_masonry_type.format-status .cmsms_post_cont .cmsms_post_content,
	.post.cmsms_masonry_type.format-aside .cmsms_post_cont .cmsms_post_content, 
	.cmsms_sitemap_wrap .cmsms_sitemap > li > a {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h2_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_text_decoration'] . ";
	}
	
	.post_comments .commentlist > li.bypostauthor .fn:before {
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_size'] . "px;
	}
	
	.cmsms_icon_box.cmsms_box_heading h2:before {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_size'] + 5) . "px;
	}
	
	.cmsms_twitter .cmsms_twitter_item_content,
	.cmsms_twitter .cmsms_twitter_item_content a {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h2_font_line_height'] - 8) . "px;
	}
	/* Finish H2 Font */


	/* Start H3 Font */
	h3,
	h3 a,
	.header_mid_inner .search_wrap .search_bar_wrap input[type=text],
	.post .cmsms_post_date .cmsms_day_mon, 
	.cmsms_posts_slider .post.format-quote .cmsms_slider_post_cont .cmsms_slider_post_quote_content,
	.cmsms_posts_slider .post.format-status .cmsms_slider_post_cont .cmsms_slider_post_content,
	.cmsms_posts_slider .post.format-aside .cmsms_slider_post_cont .cmsms_slider_post_content, 
	.cmsms_sitemap_wrap .cmsms_sitemap > li > ul > li > a, 
	.cmsms_sitemap_wrap .cmsms_sitemap_category > li > a {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h3_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_text_decoration'] . ";
	}
	
	.post .cmsms_post_date .cmsms_day_mon {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_size'] - 2) . "px;
	}
	
	.portfolio .project .project_outer .project_inner .cmsms_project_header .cmsms_project_title, 
	.cmsms_posts_slider .project .slider_project_outer .slider_project_inner .cmsms_slider_project_header .cmsms_slider_project_title {
		line-height:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h3_font_line_height'] - 2) . "px;
	}
	
	.cmsms_icon_box.cmsms_box_heading h3:before {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_size'] + 5) . "px;
	}
	/* Finish H3 Font */


	/* Start H4 Font */
	h4, 
	h4 a {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h4_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_text_decoration'] . ";
	}

	.cmsms_stats .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner .cmsms_stat_title,
	.cmsms_stats.stats_mode_bars .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner .cmsms_stat_counter_wrap,
	.cmsms_stats.stats_mode_counters.stats_type_numbers .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner .cmsms_stat_title {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h4_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_font_size'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_text_decoration'] . ";
	}
	
	.profiles.opened-article .profile .cmsms_profile_header .cmsms_profile_subtitle {
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_font_style'] . ";
	}
	/* Finish H4 Font */


	/* Start H5 Font */
	h5,
	h5 a,
	.cmsms_twitter .published,
	.cmsmsLike, 
	.blog .post.cmsms_default_type .cmsmsLike, 
	.cmsms_pricing_table .cmsms_period,
	.cmsms_post_comments, 
	.cmsms_search_post_comments, 
	.cmsms_search_post_date, 
	.post.cmsms_timeline_type .cmsms_post_info .cmsms_post_date .cmsms_day_mon, 
	.post .cmsms_post_date .cmsms_year, 
	.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date, 
	.opened-article .post .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date, 
	.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsms_slider_post_date, 
	.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsmsLike, 
	.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsms_slider_post_comments, 
	.project .cmsmsLike, 
	.project .cmsms_project_comments, 
	.cmsms_posts_slider .project .cmsmsLike, 
	.cmsms_posts_slider .project .cmsms_slider_project_comments, 
	.profile .cmsms_profile_comments {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_text_decoration'] . ";
	}
	
	.post .cmsms_post_date .cmsms_year {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] - 2) . "px;
	}

	.cmsmsLike:before,
	.blog .post.cmsms_default_type .cmsmsLike:before, 
	.cmsms_post_comments:before,
	.cmsms_search_post_comments:before,
	.cmsms_search_post_date:before,
	.cmsms_post_date:before {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] + 2) . "px;
	}
	
	.cmsmsLike,
	.blog .post.cmsms_default_type .cmsmsLike, 
	.cmsms_post_comments,
	.cmsms_search_post_comments,
	.cmsms_search_post_date,
	.cmsms_post_date {
		margin-right:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] + 3) . "px;
	}
	
	.cmsms_twitter .published {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] - 1) . "px;
		line-height:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] - 1) . "px;
	}
	
	.cmsms_pricing_table .cmsms_period {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] - 1) . "px;
		line-height:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h5_font_line_height'] - 4) . "px;
	}
	
	.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date,
	.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsmsLike,
	.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_comments,
	.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsms_slider_post_date, 
	.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsmsLike, 
	.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsms_slider_post_comments, 
	.project .cmsmsLike, 
	.project .cmsms_project_comments, 
	.cmsms_posts_slider .project .cmsmsLike, 
	.cmsms_posts_slider .project .cmsms_slider_project_comments, 
	.profile .cmsms_profile_comments {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] - 2) . "px;
		margin-right:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] + 2) . "px;
	}

	.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_date:before,
	.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsmsLike:before,
	.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_footer .cmsms_post_meta_info .cmsms_post_comments:before, 
	.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsms_slider_post_date:before, 
	.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsmsLike:before, 
	.cmsms_posts_slider .post .cmsms_slider_post_cont .cmsms_slider_post_footer .cmsms_slider_post_meta_info .cmsms_slider_post_comments:before, 
	.project .cmsmsLike:before, 
	.project .cmsms_project_comments:before, 
	.cmsms_posts_slider .project .cmsmsLike:before, 
	.cmsms_posts_slider .project .cmsms_slider_project_comments:before, 
	.profile .cmsms_profile_comments:before {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] + 2) . "px;
	}
	/* Finish H5 Font */


	/* Start H6 Font */
	h6,
	h6 a,
	.post.format-chat .cmsms_post_cont .cmsms_chat .cmsms_chat_item .cmsms_chat_author_time .cmsms_chat_author, 
	.cmsms_posts_slider .post.format-chat .cmsms_slider_post_cont .cmsms_slider_post_chat .cmsms_chat_item .cmsms_chat_author_time .cmsms_chat_author {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h6_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_text_decoration'] . ";
	}
	/* Finish H6 Font */


	/* Start Button Font */
	.cmsms_button,
	.post .cmsms_post_header .cmsms_post_subtitle,
	.cmsms_posts_slider .cmsms_slider_post_header .cmsms_slider_post_subtitle,
	.post .cmsms_post_cont_info,
	.post .cmsms_post_cont_info a,
	.cmsms_search_post_cont_info, 
	.cmsms_search_post_cont_info a, 
	.project .cmsms_project_cont_info, 
	.project .cmsms_project_cont_info a,
	.cmsms_posts_slider .cmsms_slider_post_cont_info,
	.cmsms_posts_slider .cmsms_slider_post_cont_info a,
	.cmsms_posts_slider .cmsms_slider_project_cont_info,
	.cmsms_posts_slider .cmsms_slider_project_cont_info a,	
	.post_nav > span a, 
	.related_posts > ul li > a,
	.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title > a, 
	.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a,
	.cmsms_stats.stats_mode_counters .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner .cmsms_stat_counter_wrap {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_button_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_button_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_button_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_button_font_text_transform'] . ";
	}
	
	.gform_wrapper .gform_footer input.button, 
	.gform_wrapper .gform_footer input[type=submit] {
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_size'] . "px !important;
	}
	
	.post .cmsms_post_header .cmsms_post_subtitle,
	.cmsms_posts_slider .cmsms_slider_post_header .cmsms_slider_post_subtitle,
	.post .cmsms_post_cont_info,
	.post .cmsms_post_cont_info a,
	.cmsms_search_post_cont_info, 
	.cmsms_search_post_cont_info a, 
	.post_nav > span a {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_size'] - 2) . "px;
		line-height:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_size'] + 4) . "px;
	}
	
	.post.cmsms_timeline_type .cmsms_post_cont_info,
	.post.cmsms_timeline_type .cmsms_post_cont_info a {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_size'] - 4) . "px;
		line-height:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_size'] + 4) . "px;
	}
	
	.post.cmsms_timeline_type .cmsms_post_meta_info, 
	.post.cmsms_timeline_type .cmsms_post_meta_info a {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_size'] - 3) . "px;
		line-height:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_size'] + 4) . "px;
	}
	
	.post.cmsms_timeline_type .cmsms_post_meta_info a:before {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_size'] - 1) . "px;
	}

	.related_posts > ul li > a {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_size'] - 1) . "px;
	}
	
	.related_posts > ul li > a,
	.cmsms_toggles .cmsms_toggle_wrap .cmsms_toggle_title > a,
	.cmsms_tabs .cmsms_tabs_list .cmsms_tabs_list_item > a {
		line-height:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_size'] + 8) . "px;
	}

	.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_cont_info,
	.post.cmsms_masonry_type .cmsms_post_cont .cmsms_post_cont_info a {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_size'] - 4) . "px;
	}

	.cmsms_stats.stats_mode_counters .cmsms_stat_wrap .cmsms_stat .cmsms_stat_inner .cmsms_stat_counter_wrap {
		line-height:60px; // static
	}
	/* Finish Button Font */


	/* Start Small Text Font */
	small,
	.meta_wrap,
	.meta_wrap a,
	.header_top_inner nav > div > ul > li a {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_small_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_small_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_small_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_small_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_small_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_small_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_small_font_text_transform'] . ";
	}

	#navigation > li.menu-item-mega > div.menu-item-mega-container ul ul li.menu-item-mega-description span.menu-item-mega-description-container, 
	.project .cmsms_project_cont_info, 
	.project .cmsms_project_cont_info a, 
	.cmsms_posts_slider .cmsms_slider_post_cont_info,
	.cmsms_posts_slider .cmsms_slider_post_cont_info a,
	.cmsms_posts_slider .cmsms_slider_project_cont_info,
	.cmsms_posts_slider .cmsms_slider_project_cont_info a {
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_small_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_small_font_line_height'] . "px;
	}
	
	.gform_wrapper .description, 
	.gform_wrapper .gfield_description, 
	.gform_wrapper .gsection_description, 
	.gform_wrapper .instruction {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_small_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_small_font_system_font'] . " !important;
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_small_font_font_size'] . "px !important;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_small_font_line_height'] . "px !important;
	}
	
	.meta_wrap > div[class^=\"cmsms-icon-\"]:before,
	.meta_wrap > p[class^=\"cmsms-icon-\"]:before,
	.meta_wrap > span[class^=\"cmsms-icon-\"]:before,
	.meta_wrap > strong[class^=\"cmsms-icon-\"]:before,
	.meta_wrap > div[class*=\" cmsms-icon-\"]:before,
	.meta_wrap > p[class*=\" cmsms-icon-\"]:before,
	.meta_wrap > span[class*=\" cmsms-icon-\"]:before,
	.meta_wrap > strong[class*=\" cmsms-icon-\"]:before {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_small_font_line_height'] - 2) . "px;
	}

	.post.format-chat .cmsms_post_cont .cmsms_chat .cmsms_chat_item .cmsms_chat_author_time .cmsms_chat_time, 
	.cmsms_posts_slider .post.format-chat .cmsms_slider_post_cont .cmsms_slider_post_chat .cmsms_chat_item .cmsms_chat_author_time .cmsms_chat_time {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_small_font_font_size'] - 1) . "px;
		font-weight:bold; // static
		text-transform:uppercase; // static
	}
	
	@media only screen and (max-width: 1024px) {
		html #page #header .header_top .header_top_outer .header_top_inner .header_top_right .nav_wrap nav #top_line_nav > li > a {
			font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_small_font_font_size'] + 1) . "px;
			font-weight:bold; // static
		}
	}
	/* Finish Small Text Font */


	/* Start Text Fields Font */
	input[type=text],
	input[type=email],
	input[type=password],
	input[type=number],
	input[type=url],
	input[type=tel],
	textarea,
	select,
	option, 
	code {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_input_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_input_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_input_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_input_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_input_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_input_font_font_style'] . ";
	}
	
	.gform_wrapper input[type=text], 
	.gform_wrapper input[type=url], 
	.gform_wrapper input[type=email], 
	.gform_wrapper input[type=tel], 
	.gform_wrapper input[type=number], 
	.gform_wrapper input[type=password], 
	.gform_wrapper textarea, 
	.gform_wrapper select {
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_input_font_font_size'] . "px !important;
	}
	/* Finish Text Fields Font */


	/* Start Blockquote Font */
	q,
	blockquote {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_quote_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_quote_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_quote_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_quote_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_quote_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_quote_font_font_style'] . ";
	}
	
	q:before,
	blockquote:before {
		font:50px/50px Georgia, Times, 'Century Schoolbook L', serif; // static
	}
	/* Finish Blockquote Font */

/***************** Finish Theme Font Styles ******************/


";


if (class_exists('woocommerce')) {

	$custom_css .= "
/***************** Start Theme Font Styles ******************/

	/* Start Content Font */
	.checkout #order_review .shop_table th, 
	.checkout #order_review .shop_table td, 
	.checkout #order_review .shop_table th *, 
	.checkout #order_review .shop_table td *, 
	.shop_table.order_details th, 
	.shop_table.order_details td, 
	.shop_table.order_details th *, 
	.shop_table.order_details td *, 
	.shop_table.order_details td.product-name, 
	.shop_table.order_details td.product-name * {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_content_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_content_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_style'] . ";
	}
	
	.cmsms_single_product .cmsms_woo_tabs #reviews #comments .commentlist .comment .comment_container .comment-text .meta, 
	.product_list_widget li del .amount {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_size'] - 1) . "px;
	}
	/* Finish Content Font */
	
	
	/* Start Link Font */
	.cmsms_products .product .product_outer .product_inner .cmsms_product_footer > a {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_link_font_font_size'] - 1) . "px;
	}
	/* Finish Link Font */
	
	
	/* Start H1 Font */
	/* Finish H1 Font */
	
	
	/* Start H2 Font */
		.cmsms_single_product .cmsms_product_right_column .product_title {
			font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h2_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_system_font'] . ";
			font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_size'] . "px;
			line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_line_height'] . "px;
			font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_weight'] . ";
			font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_style'] . ";
			text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_text_transform'] . ";
			text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_text_decoration'] . ";
		}
	/* Finish H2 Font */
	
	
	/* Start H3 Font */
	.cmsms_single_product .cmsms_product_right_column .price, 
	.cmsms_single_product .cmsms_woo_tabs h2, 
	.cart_totals > h2 {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h3_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_text_decoration'] . ";
	}
	
	.cmsms_products .product .product_outer .product_inner .cmsms_product_info .price {
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_line_height'] . "px;
	}
	/* Finish H3 Font */
	
	
	/* Start H4 Font */
	.widget_shopping_cart_content .total strong {
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h4_font_font_weight'] . ";
	}
	/* Finish H4 Font */
	
	
	/* Start H5 Font */
	.shop_table thead th {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_text_decoration'] . ";
	}
	
	.shop_table td.product-price, 
	.shop_table td.product-subtotal, 
	.cart_totals table tr.cart-subtotal td, 
	.cart_totals table tr.order-total td, 
	.widget_shopping_cart_content .cart_list li .quantity, 
	.widget_shopping_cart_content .total strong, 
	.widget_shopping_cart_content .total .amount, 
	.product_list_widget li .amount {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_system_font'] . ";
	}
	/* Finish H5 Font */
	
	
	/* Start H6 Font */
	.cmsms_products .product .product_outer .product_inner .cmsms_product_info .price del, 
	.cmsms_single_product .cmsms_product_right_column .price del {
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_line_height'] . "px;
	}
	/* Finish H6 Font */
	
	
	/* Start Button Font */
	.onsale, 
	.out-of-stock, 
	.cmsms_products .product .product_outer .product_inner .cmsms_product_header .cmsms_product_title, 
	.cmsms_products .product .product_outer .product_inner .cmsms_product_header .cmsms_product_title a, 
	.cmsms_products .product .product_outer .product_inner .cmsms_product_info .price, 
	.shop_table td.product-name, 
	.shop_table td.product-name a, 
	.widget_shopping_cart_content .cart_list li a, 
	.cmsms_added_product_info .cmsms_added_product_info_text, 
	.product_list_widget li > a {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_button_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_button_font_system_font'] . ";
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_button_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_button_font_text_transform'] . ";
	}
	/* Finish Button Font */
	
	
	/* Start Small Text Font */
	/* Finish Small Text Font */

/***************** Finish Theme Font Styles ******************/


";

}


if (class_exists('Tribe__Events__Main')) {

	$custom_css .= "
/***************** Start Events Font Styles ******************/

	/* Start Content Font */
	.widget.tribe-this-week-events-widget .tribe-events-viewmore a,
	.recurringinfo, 
	.recurringinfo *, 
	.widget.tribe-this-week-events-widget .duration, 
	.widget.tribe-this-week-events-widget .tribe-venue a, 
	.tribe-this-week-events-widget .tribe-this-week-widget-wrapper .tribe-this-week-widget-header-date,
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-event-\"] .tribe-events-month-event-title, 
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-event-\"] .tribe-events-month-event-title a, 
	#tribe-events-content.tribe-events-photo #tribe-events-photo-events .tribe-events-photo-event .tribe-events-photo-event-wrap .tribe-events-event-details .tribe-events-event-meta .time-details, 
	#tribe-events-content.tribe-events-photo #tribe-events-photo-events .tribe-events-photo-event .tribe-events-photo-event-wrap .tribe-events-event-details .tribe-events-event-meta .time-details *, 
	#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-allday .column.first, 
	#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-grid-wrapper .tribe-grid-body .tribe-week-grid-hours, 
	#tribe-mobile-container .tribe-mobile-day .tribe-events-mobile .tribe-events-event-body .time-details, 
	.widget .vevent .cmsms_widget_event_info *, 
	.widget.tribe-events-list-widget .tribe-event-duration, 
	.widget .tribe-events-widget-link a, 
	.widget .vevent .cmsms_widget_event_venue_info_loc, 
	.widget .vevent .cmsms_widget_event_venue_info_loc *, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td *, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .vevent .tribe-mini-calendar-event .list-info, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .vevent .tribe-mini-calendar-event .list-info .tribe-mini-calendar-event-venue a, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .vevent .tribe-mini-calendar-event .list-info .recurringinfo * {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_content_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_content_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_style'] . ";
	}
	
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-event-\"] .tribe-events-month-event-title, 
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-event-\"] .tribe-events-month-event-title a, 
	#tribe-events-content.tribe-events-single .cmsms_single_event_meta .tribe-events-meta-group .cmsms_event_meta_info .cmsms_event_meta_info_item .cmsms_event_meta_info_item_title, 
	#tribe-events-content.tribe-events-single .cmsms_single_event_meta .tribe-events-meta-group .cmsms_event_meta_info .cmsms_event_meta_info_item dt {
		text-transform:uppercase;
	}
	
	.tribe-events-event-body .tribe-events-abbr,
	.widget.tribe-this-week-events-widget .tribe-events-viewmore a,
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-event-\"] .tribe-events-month-event-title, 
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-event-\"] .tribe-events-month-event-title a, 
	#tribe-events-content.tribe-events-list .vevent .cmsms_events_list_event_wrap .tribe-events-event-meta .time-details, 
	#tribe-events-content.tribe-events-list .vevent .cmsms_events_list_event_wrap .tribe-events-event-meta .time-details *, 
	#tribe-events-content.tribe-events-list .vevent .cmsms_events_list_event_wrap .tribe-events-event-meta .tribe-events-venue-details, 
	#tribe-events-content.tribe-events-list .vevent .cmsms_events_list_event_wrap .tribe-events-event-meta .tribe-events-venue-details *, 
	#tribe-events-content.tribe-events-photo #tribe-events-photo-events .tribe-events-photo-event .tribe-events-photo-event-wrap .tribe-events-event-details .tribe-events-event-meta .time-details, 
	#tribe-events-content.tribe-events-photo #tribe-events-photo-events .tribe-events-photo-event .tribe-events-photo-event-wrap .tribe-events-event-details .tribe-events-event-meta .time-details *, 
	#tribe-mobile-container .tribe-mobile-day .tribe-events-mobile .tribe-events-event-body .time-details, 
	.tribe-this-week-events-widget .tribe-this-week-widget-wrapper .tribe-this-week-widget-header-date,
	.widget .vevent .cmsms_widget_event_info *, 
	.widget.tribe-events-list-widget .tribe-event-duration, 
	.widget.tribe-this-week-events-widget .duration,
	.widget.tribe-this-week-events-widget .tribe-venue a,
	.widget .tribe-events-widget-link a, 
	.widget .vevent .cmsms_widget_event_venue_info_loc, 
	.widget .vevent .cmsms_widget_event_venue_info_loc * {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_size'] - 1) . "px;
	}
	
	.tribe-this-week-events-widget .tribe-this-week-widget-wrapper .tribe-this-week-widget-header-date,
	.tribe-events-event-body .tribe-events-abbr {
		line-height:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_content_font_line_height'] - 2) . "px;
	}
	
	#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-allday .column.first, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar tbody td *, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .vevent .tribe-mini-calendar-event .list-info, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .vevent .tribe-mini-calendar-event .list-info .tribe-mini-calendar-event-venue a, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .vevent .tribe-mini-calendar-event .list-info .recurringinfo * {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_size'] - 2) . "px;
	}
	
	#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-allday .column.first span {
		height:" . $cmsms_option[CMSMS_SHORTNAME . '_content_font_line_height'] . "px;
	}
	
	#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-grid-wrapper .tribe-grid-body .tribe-week-grid-hours {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_content_font_font_size'] - 3) . "px;
	}
	/* Finish Content Font */
	
	
	/* Start Link Font */
	/* Finish Link Font */
	
	
	/* Start H1 Font */
	.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-timer .tribe-countdown-number, 
	.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-timer .tribe-countdown-colon {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h1_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h1_font_text_decoration'] . ";
	}
	
	.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-timer .tribe-countdown-number, 
	.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-timer .tribe-countdown-colon {
		font-size:40px;
		line-height:1em;
	}
	/* Finish H1 Font */
	
	
	/* Start H2 Font */
	#tribe-events-content.tribe-events-single .cmsms_single_event_meta .tribe-events-meta-group .tribe-events-single-section-title, 
	#tribe-events-content.tribe-events-list .vevent .cmsms_events_list_event_wrap .cmsms_events_list_event_header .tribe-events-event-cost, 
	#tribe-mobile-container .tribe-mobile-day .tribe-mobile-day-heading, 
	#tribe-mobile-container .tribe-mobile-day .tribe-mobile-day-date {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h2_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h2_font_text_decoration'] . ";
	}
	
	#tribe-mobile-container .tribe-mobile-day .tribe-mobile-day-heading, 
	#tribe-mobile-container .tribe-mobile-day .tribe-mobile-day-date {
		text-transform:uppercase;
	}
	/* Finish H2 Font */
	
	
	/* Start H3 Font */
	#tribe-events-content.tribe-events-day .tribe-events-day-time-slot > h5, 
	#tribe-events-content.tribe-events-list .tribe-events-list-separator-month, 
	#tribe-events-bar .tribe-bar-filters .tribe-bar-filters-inner .tribe-bar-date-filter .label-tribe-bar-date, 
	#tribe-events-bar .tribe-bar-filters .tribe-bar-filters-inner .tribe-bar-search-filter label, 
	#tribe-events-bar .tribe-bar-filters .tribe-bar-filters-inner .tribe-bar-geoloc-filter label, 
	#tribe-events-bar .tribe-bar-filters .tribe-bar-filters-inner .tribe-bar-submit label, 
	#tribe-events-content.tribe-events-month table.tribe-events-calendar thead th, 
	.widget.tribe-events-list-widget .tribe-event-title,
	.widget.tribe-events-list-widget .tribe-event-title a,
	.widget .vevent .entry-title, 
	.widget .vevent .entry-title a {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h3_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h3_font_text_decoration'] . ";
	}
	/* Finish H3 Font */
	
	
	/* Start H4 Font */
	/* Finish H4 Font */
	
	
	/* Start H5 Font */
	.tribe-events-tooltip .entry-title, 
	.tribe-events-tooltip .entry-title a, 
	.tribe-events-tooltip .tribe-event-title, 
	.tribe-events-tooltip .tribe-event-title a, 
	.tribe-this-week-events-widget .tribe-this-week-widget-wrapper .entry-title,
	.tribe-this-week-events-widget .tribe-this-week-widget-wrapper .entry-title a,
	#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-header .tribe-grid-content-wrap .column, 
	#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-header .tribe-grid-content-wrap .column *, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar .tribe-mini-calendar-nav div, 
	.widget .list-date span.list-daynumber, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .entry-title, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .entry-title a {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h5_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h5_font_text_decoration'] . ";
	}
	
	#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-header .tribe-grid-content-wrap .column, 
	#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-grid-header .tribe-grid-content-wrap .column *, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar .tribe-mini-calendar-nav div, 
	.widget .list-date span.list-daynumber, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .entry-title, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-list-wrapper .tribe-events-loop .entry-title a {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h5_font_font_size'] - 1) . "px;
	}
	/* Finish H5 Font */
	
	
	/* Start H6 Font */
	.tribe-this-week-events-widget .tribe-this-week-widget-wrapper .tribe-events-page-title,
	.tribe-events-countdown-widget .tribe-countdown-text a, 
	#tribe-events-content.tribe-events-single .cmsms_single_event_header .cmsms_single_event_header_right .tribe-events-cal-links a, 
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-daynum-\"], 
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-daynum-\"] a, 
	#tribe-events-footer > a, 
	#tribe-events-content.tribe-events-list .vevent .cmsms_events_list_event_wrap .tribe-events-list-event-description .tribe-events-read-more, 
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td .tribe-events-viewmore, 
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td .tribe-events-viewmore a, 
	.tribe-events-venue .cmsms_events_venue_header .cmsms_events_venue_header_left .tribe-events-event-meta .venue-address span, 
	.tribe-events-venue .cmsms_events_venue_header .cmsms_events_venue_header_left .tribe-events-event-meta .venue-address span a, 
	.tribe-events-venue .cmsms_events_venue_header .cmsms_events_venue_header_right a, 
	.tribe-events-organizer .cmsms_events_organizer_header .cmsms_events_organizer_header_left .tribe-events-event-meta .organizer-address span, 
	.tribe-events-organizer .cmsms_events_organizer_header .cmsms_events_organizer_header_left .tribe-events-event-meta .organizer-address span a, 
	.tribe-events-organizer .cmsms_events_organizer_header .cmsms_events_organizer_header_right a, 
	#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-event > div:first-child > .entry-title, 
	#tribe-events-content.tribe-events-week-grid .tribe-events-grid .tribe-week-event > div:first-child > .entry-title a, 
	#tribe-mobile-container .tribe-mobile-day .tribe-events-mobile .tribe-events-event-body .tribe-events-read-more, 
	.tribe-events-viewmore a, 
	.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-timer .tribe-countdown-number .tribe-countdown-under, 
	.tribe-events-venue-widget .tribe-venue-widget-wrapper .tribe-venue-widget-venue .tribe-venue-widget-venue-name, 
	.tribe-events-venue-widget .tribe-venue-widget-wrapper .tribe-venue-widget-venue .tribe-venue-widget-venue-name a, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar th.tribe-mini-calendar-dayofweek, 
	.widget .list-date span.list-dayname {
		font-family:" . cmsms_get_google_font($cmsms_option[CMSMS_SHORTNAME . '_h6_font_google_font']) . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_system_font'] . ";
		font-size:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_size'] . "px;
		line-height:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_line_height'] . "px;
		font-weight:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_weight'] . ";
		font-style:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_style'] . ";
		text-transform:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_text_transform'] . ";
		text-decoration:" . $cmsms_option[CMSMS_SHORTNAME . '_h6_font_text_decoration'] . ";
	}
	
	#tribe-events-content.tribe-events-single .cmsms_single_event_header .cmsms_single_event_header_right .tribe-events-back a, 
	#tribe-events-content.tribe-events-single .cmsms_single_event_header .cmsms_single_event_header_right .tribe-events-cal-links a, 
	#tribe-events-footer > a, 
	#tribe-events-content.tribe-events-list .vevent .cmsms_events_list_event_wrap .tribe-events-list-event-description .tribe-events-read-more, 
	.tribe-events-venue .cmsms_events_venue_header .cmsms_events_venue_header_right a, 
	.tribe-events-organizer .cmsms_events_organizer_header .cmsms_events_organizer_header_right a, 
	#tribe-mobile-container .tribe-mobile-day .tribe-events-mobile .tribe-events-event-body .tribe-events-read-more {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_size'] - 2) . "px;
	}
	
	#tribe-events-content.tribe-events-single .cmsms_single_event_header .cmsms_single_event_header_right .tribe-events-back a:before, 
	.tribe-events-venue .cmsms_events_venue_header .cmsms_events_venue_header_right a:before, 
	.tribe-events-organizer .cmsms_events_organizer_header .cmsms_events_organizer_header_right a:before {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_size'] + 3) . "px;
	}
	
	
	.tribe-this-week-events-widget .tribe-this-week-widget-wrapper .tribe-events-page-title,
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-daynum-\"], 
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td div[id*=\"tribe-events-daynum-\"] a, 
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td .tribe-events-viewmore, 
	#tribe-events-content.tribe-events-month table.tribe-events-calendar tbody td .tribe-events-viewmore a, 
	.tribe-events-venue-widget .tribe-venue-widget-wrapper .tribe-venue-widget-venue .tribe-venue-widget-venue-name, 
	.tribe-events-venue-widget .tribe-venue-widget-wrapper .tribe-venue-widget-venue .tribe-venue-widget-venue-name a {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_size'] - 1) . "px;
	}
	
	.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-timer .tribe-countdown-number .tribe-countdown-under, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar th.tribe-mini-calendar-dayofweek, 
	.widget .list-date span.list-dayname {
		font-size:" . ((int) $cmsms_option[CMSMS_SHORTNAME . '_h6_font_font_size'] - 3) . "px;
	}
	
	#tribe-events-content.tribe-events-single .cmsms_single_event_header .cmsms_single_event_header_right .tribe-events-cal-links a, 
	#tribe-events-footer > a, 
	.tribe-events-venue .cmsms_events_venue_header .cmsms_events_venue_header_right a, 
	.tribe-events-organizer .cmsms_events_organizer_header .cmsms_events_organizer_header_right a, 
	.tribe-events-countdown-widget .tribe-countdown-time .tribe-countdown-timer .tribe-countdown-number .tribe-countdown-under, 
	.tribe-events-venue-widget .tribe-venue-widget-wrapper .tribe-venue-widget-venue .tribe-venue-widget-venue-name, 
	.tribe-events-venue-widget .tribe-venue-widget-wrapper .tribe-venue-widget-venue .tribe-venue-widget-venue-name a, 
	.widget.tribe_mini_calendar_widget .tribe-mini-calendar-wrapper .tribe-mini-calendar-grid-wrapper .tribe-mini-calendar th.tribe-mini-calendar-dayofweek, 
	.widget .list-date span.list-dayname {
		text-transform:uppercase;
	}
	/* Finish H6 Font */
	

/***************** Finish Events Font Styles ******************/


";

}
	return $custom_css;
}



function cmsms_get_google_font($font) {
	if ($font != '') {
		if (strpos($font, ':')) {
			$google_font_array = explode(':', $font);
			
			
			$google_font = "'" . str_replace('+', ' ', $google_font_array[0]) . "', ";
		} elseif (strpos($font, '&')) {
			$google_font_array = explode('&', $font);
			
			
			$google_font = "'" . str_replace('+', ' ', $google_font_array[0]) . "', ";
		} else {
			$google_font = "'" . str_replace('+', ' ', $font) . "', ";
		}
	} else {
		$google_font = '';
	}
	
	
	return $google_font;
}

