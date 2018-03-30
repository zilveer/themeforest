<?php

/**
 * @big_grid_large_image is put after @big_grid_small_images so that it will overwrite small posts style
 */

function td_css_generator() {

    $raw_css = "
    <style>

    /* @theme_color */
    .td-header-border:before,
    .td-trending-now-title,
    .td_block_mega_menu .td_mega_menu_sub_cats .cur-sub-cat,
    .td-post-category:hover,
    .td-header-style-2 .td-header-sp-logo,
    .td-next-prev-wrap a:hover i,
    .page-nav .current,
    .widget_calendar tfoot a:hover,
    .td-footer-container .widget_search .wpb_button:hover,
    .td-scroll-up-visible,
    .dropcap,
    .td-category a,
    input[type=\"submit\"]:hover,
    .td-post-small-box a:hover,
    .td-404-sub-sub-title a:hover,
    .td-rating-bar-wrap div,
    .td_top_authors .td-active .td-author-post-count,
    .td_top_authors .td-active .td-author-comments-count,
    .td_smart_list_3 .td-sml3-top-controls i:hover,
    .td_smart_list_3 .td-sml3-bottom-controls i:hover,
    .td_wrapper_video_playlist .td_video_controls_playlist_wrapper,
    .td-read-more a:hover,
    .td-login-wrap .btn,
    .td_display_err,
    .td-header-style-6 .td-top-menu-full,
    #bbpress-forums button:hover,
    #bbpress-forums .bbp-pagination .current,
    .bbp_widget_login .button:hover,
    .header-search-wrap .td-drop-down-search .btn:hover,
    .td-post-text-content .more-link-wrap:hover a,
    #buddypress div.item-list-tabs ul li > a span,
    #buddypress div.item-list-tabs ul li > a:hover span,
    #buddypress input[type=submit]:hover,
    #buddypress a.button:hover span,
    #buddypress div.item-list-tabs ul li.selected a span,
    #buddypress div.item-list-tabs ul li.current a span,
    #buddypress input[type=submit]:focus,
    .td-grid-style-3 .td-big-grid-post .td-module-thumb a:last-child:before,
    .td-grid-style-4 .td-big-grid-post .td-module-thumb a:last-child:before,
    .td-grid-style-5 .td-big-grid-post .td-module-thumb:after,
    .td_category_template_2 .td-category-siblings .td-category a:hover,
    .td-weather-week:before,
    .td-weather-information:before {
        background-color: @theme_color;
    }

    @media (max-width: 767px) {
        .td-category a.td-current-sub-category {
            background-color: @theme_color;
        }
    }

    .woocommerce .onsale,
    .woocommerce .woocommerce a.button:hover,
    .woocommerce-page .woocommerce .button:hover,
    .single-product .product .summary .cart .button:hover,
    .woocommerce .woocommerce .product a.button:hover,
    .woocommerce .product a.button:hover,
    .woocommerce .product #respond input#submit:hover,
    .woocommerce .checkout input#place_order:hover,
    .woocommerce .woocommerce.widget .button:hover,
    .woocommerce .woocommerce-message .button:hover,
    .woocommerce .woocommerce-error .button:hover,
    .woocommerce .woocommerce-info .button:hover,
    .woocommerce.widget .ui-slider .ui-slider-handle,
    .vc_btn-black:hover,
	.wpb_btn-black:hover,
	.item-list-tabs .feed:hover a,
	.td-smart-list-button:hover {
    	background-color: @theme_color !important;
    }

    .td-header-sp-top-menu .top-header-menu > .current-menu-item > a,
    .td-header-sp-top-menu .top-header-menu > .current-menu-ancestor > a,
    .td-header-sp-top-menu .top-header-menu > .current-category-ancestor > a,
    .td-header-sp-top-menu .top-header-menu > li > a:hover,
    .td-header-sp-top-menu .top-header-menu > .sfHover > a,
    .top-header-menu ul .current-menu-item > a,
    .top-header-menu ul .current-menu-ancestor > a,
    .top-header-menu ul .current-category-ancestor > a,
    .top-header-menu ul li > a:hover,
    .top-header-menu ul .sfHover > a,
    .sf-menu ul .td-menu-item > a:hover,
    .sf-menu ul .sfHover > a,
    .sf-menu ul .current-menu-ancestor > a,
    .sf-menu ul .current-category-ancestor > a,
    .sf-menu ul .current-menu-item > a,
    .td_module_wrap:hover .entry-title a,
    .td_mod_mega_menu:hover .entry-title a,
    .footer-email-wrap a,
    .widget a:hover,
    .td-footer-container .widget_calendar #today,
    .td-category-pulldown-filter a.td-pulldown-category-filter-link:hover,
    .td-load-more-wrap a:hover,
    .td-post-next-prev-content a:hover,
    .td-author-name a:hover,
    .td-author-url a:hover,
    .td_mod_related_posts:hover .entry-title a,
    .td-search-query,
    .header-search-wrap .td-drop-down-search .result-msg a:hover,
    .td_top_authors .td-active .td-authors-name a,
    .post blockquote p,
    .td-post-content blockquote p,
    .page blockquote p,
    .comment-list cite a:hover,
    .comment-list cite:hover,
    .comment-list .comment-reply-link:hover,
    a,
    .white-menu #td-header-menu .sf-menu > li > a:hover,
    .white-menu #td-header-menu .sf-menu > .current-menu-ancestor > a,
    .white-menu #td-header-menu .sf-menu > .current-menu-item > a,
    .td-stack-classic-blog .td-post-text-content .more-link-wrap:hover a,
    .td_quote_on_blocks,
    #bbpress-forums .bbp-forum-freshness a:hover,
    #bbpress-forums .bbp-topic-freshness a:hover,
    #bbpress-forums .bbp-forums-list li a:hover,
    #bbpress-forums .bbp-forum-title:hover,
    #bbpress-forums .bbp-topic-permalink:hover,
    #bbpress-forums .bbp-topic-started-by a:hover,
    #bbpress-forums .bbp-topic-started-in a:hover,
    #bbpress-forums .bbp-body .super-sticky li.bbp-topic-title .bbp-topic-permalink,
    #bbpress-forums .bbp-body .sticky li.bbp-topic-title .bbp-topic-permalink,
    #bbpress-forums #subscription-toggle a:hover,
    #bbpress-forums #favorite-toggle a:hover,
    .widget_display_replies .bbp-author-name,
    .widget_display_topics .bbp-author-name,
    .td-subcategory-header .td-category-siblings .td-subcat-dropdown a.td-current-sub-category,
    .td-subcategory-header .td-category-siblings .td-subcat-dropdown a:hover,
    .td-pulldown-filter-display-option:hover,
    .td-pulldown-filter-display-option .td-pulldown-filter-link:hover,
    .td_normal_slide .td-wrapper-pulldown-filter .td-pulldown-filter-list a:hover,
    #buddypress ul.item-list li div.item-title a:hover,
    .td_block_13 .td-pulldown-filter-list a:hover,
    .td_smart_list_8 .td-smart-list-dropdown-wrap .td-smart-list-button:hover,
    .td_smart_list_8 .td-smart-list-dropdown-wrap .td-smart-list-button:hover i,
    .td-sub-footer-container a:hover,
    .td-instagram-user a {
        color: @theme_color;
    }

    .td-stack-classic-blog .td-post-text-content .more-link-wrap:hover a {
        outline-color: @theme_color;
    }

    .td-mega-menu .wpb_content_element li a:hover,
    .td_login_tab_focus {
        color: @theme_color !important;
    }

    .td-next-prev-wrap a:hover i,
    .page-nav .current,
    .widget_tag_cloud a:hover,
    .post .td_quote_box,
    .page .td_quote_box,
    .td-login-panel-title,
    #bbpress-forums .bbp-pagination .current,
    .td_category_template_2 .td-category-siblings .td-category a:hover,
    .page-template-page-pagebuilder-latest .td-instagram-user {
        border-color: @theme_color;
    }

    .td_wrapper_video_playlist .td_video_currently_playing:after,
    .item-list-tabs .feed:hover {
        border-color: @theme_color !important;
    }


    /* @grid_line_color */
    .td-pb-row [class*=\"td-pb-span\"],
    .td-pb-border-top,
    .page-template-page-title-sidebar-php .td-page-content > .wpb_row:first-child,
    .td-post-sharing,
    .td-post-content,
    .td-post-next-prev,
    .author-box-wrap,
    .td-comments-title-wrap,
    .comment-list,
    .comment-respond,
    .td-post-template-5 header,
    .td-container,
    .wpb_content_element,
    .wpb_column,
    .wpb_row,
    .white-menu .td-header-container .td-header-main-menu,
    .td-post-template-1 .td-post-content,
    .td-post-template-4 .td-post-sharing-top,
    .td-header-style-6 .td-header-header .td-make-full,
    #disqus_thread,
    .page-template-page-pagebuilder-title-php .td-page-content > .wpb_row:first-child,
    .td-footer-container:before {
        border-color: @grid_line_color;
    }
    .td-top-border {
        border-color: @grid_line_color !important;
    }
    .td-container-border:after,
    .td-next-prev-separator,
    .td-pb-row .wpb_column:before,
    .td-container-border:before,
    .td-main-content:before,
    .td-main-sidebar:before,
    .td-pb-row .td-pb-span4:nth-of-type(3):after,
    .td-pb-row .td-pb-span4:nth-last-of-type(3):after {
    	background-color: @grid_line_color;
    }
    @media (max-width: 767px) {
    	.white-menu .td-header-main-menu {
      		border-color: @grid_line_color;
      	}
    }



    /* @top_menu_color */
    .td-header-top-menu,
    .td-header-wrap .td-top-menu-full {
        background-color: @top_menu_color;
    }

    .td-header-style-1 .td-header-top-menu,
    .td-header-style-2 .td-top-bar-container,
    .td-header-style-7 .td-header-top-menu {
        padding: 0 12px;
        top: 0;
    }

    /* @top_menu_text_color */
    .td-header-sp-top-menu .top-header-menu > li > a,
    .td-header-sp-top-menu .td_data_time,
    .td-header-sp-top-menu .td-weather-top-widget {
        color: @top_menu_text_color;
    }

    /* @top_menu_text_hover_color */
    .top-header-menu > .current-menu-item > a,
    .top-header-menu > .current-menu-ancestor > a,
    .top-header-menu > .current-category-ancestor > a,
    .top-header-menu > li > a:hover,
    .top-header-menu > .sfHover > a {
        color: @top_menu_text_hover_color !important;
    }

    /* @top_sub_menu_text_color */
    .top-header-menu ul li a {
        color: @top_sub_menu_text_color;
    }

    /* @top_sub_menu_text_hover_color */
    .top-header-menu ul .current-menu-item > a,
    .top-header-menu ul .current-menu-ancestor > a,
    .top-header-menu ul .current-category-ancestor > a,
    .top-header-menu ul li > a:hover,
    .top-header-menu ul .sfHover > a {
        color: @top_sub_menu_text_hover_color;
    }

    /* @top_social_icons_color */
    .td-header-sp-top-widget .td-social-icon-wrap i {
        color: @top_social_icons_color;
    }

    /* @top_social_icons_hover_color */
    .td-header-sp-top-widget .td-social-icon-wrap i:hover {
        color: @top_social_icons_hover_color;
    }

    /* @menu_color */
    .td-header-main-menu {
        background-color: @menu_color;
    }

    /* @menu_text_color */
    .sf-menu > li > a,
    .header-search-wrap .td-icon-search,
    #td-top-mobile-toggle i {
        color: @menu_text_color;
    }

    /* @menu_border_color */
    .td-header-border:before {
        background-color: @menu_border_color;
    }

    /* @header_wrap_color */
    .td-header-row.td-header-header {
        background-color: @header_wrap_color;
    }

    .td-header-style-1 .td-header-top-menu {
        padding: 0 12px;
    	top: 0;
    }

    @media (min-width: 1024px) {
    	.td-header-style-1 .td-header-header {
      		padding: 0 6px;
      	}
    }

    .td-header-style-6 .td-header-header .td-make-full {
    	border-bottom: 0;
    }


    @media (max-height: 768px) {
        .td-header-style-6 .td-header-sp-rec {
            margin-right: 7px;
        }
        .td-header-style-6 .td-header-sp-logo {
        	margin-left: 7px;
    	}
    }

    /* @mobile_menu_color */
    @media (max-width: 767px) {
        body .td-header-wrap .td-header-main-menu {
            background-color: @mobile_menu_color;
        }
    }

    /* @mobile_icons_color */
    @media (max-width: 767px) {
        body #td-top-mobile-toggle i,
        .td-header-wrap .header-search-wrap .td-icon-search {
            color: @mobile_icons_color !important;
        }
    }

    /* @mobile_gradient_one_mob */
    .td-menu-background:before,
    .td-search-background:before {
        background: @mobile_gradient_one_mob;
        background: -moz-linear-gradient(top, @mobile_gradient_one_mob 0%, @mobile_gradient_two_mob 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, @mobile_gradient_one_mob), color-stop(100%, @mobile_gradient_two_mob));
        background: -webkit-linear-gradient(top, @mobile_gradient_one_mob 0%, @mobile_gradient_two_mob 100%);
        background: -o-linear-gradient(top, @mobile_gradient_one_mob 0%, @mobileu_gradient_two_mob 100%);
        background: -ms-linear-gradient(top, @mobile_gradient_one_mob 0%, @mobile_gradient_two_mob 100%);
        background: linear-gradient(to bottom, @mobile_gradient_one_mob 0%, @mobile_gradient_two_mob 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='@mobile_gradient_one_mob', endColorstr='@mobile_gradient_two_mob', GradientType=0 );
    }

    /* @mobile_text_color */
    .td-mobile-content li a,
    .td-mobile-content .td-icon-menu-right,
    .td-mobile-content .sub-menu .td-icon-menu-right,
    #td-mobile-nav .td-menu-login-section a,
    #td-mobile-nav .td-menu-logout a,
    #td-mobile-nav .td-menu-socials-wrap .td-icon-font,
    .td-mobile-close .td-icon-close-mobile,
    #td-mobile-nav .td-register-section,
    #td-mobile-nav .td-register-section .td-login-input,
    #td-mobile-nav label,
    #td-mobile-nav .td-register-section i,
    #td-mobile-nav .td-register-section a,
    #td-mobile-nav .td_display_err {
        color: @mobile_text_color;
    }

    #td-mobile-nav .td-menu-login-section .td-menu-login span {
        background-color: @mobile_text_color;
    }

    #td-mobile-nav .td-register-section .td-login-input {
        border-bottom-color: @mobile_text_color !important;
    }

    /* @mobile_text_active_color */
    .td-mobile-content .current-menu-item > a,
    .td-mobile-content .current-menu-ancestor > a,
    .td-mobile-content .current-category-ancestor > a,
    #td-mobile-nav .td-menu-login-section a:hover,
    #td-mobile-nav .td-register-section a:hover,
    #td-mobile-nav .td-menu-socials-wrap a:hover i {
        color: @mobile_text_active_color;
    }

    /* @mobile_button_background_mob */
    #td-mobile-nav .td-register-section .td-login-button {
        background-color: @mobile_button_background_mob;
    }

    /* @mobile_button_color_mob */
    #td-mobile-nav .td-register-section .td-login-button {
        color: @mobile_button_color_mob;
    }


    /* @login_text_color */
    .white-popup-block,
    .mfp-content .td-login-panel-title,
    .mfp-content .td-login-inputs,
    .mfp-content .td-login-input,
    .mfp-content .td-login-info-text,
    .mfp-content #register-link,
    .mfp-content #login-form .mfp-close:before,
    .mfp-content .td-back-button i {
        color: @login_text_color;
    }
    .mfp-content .td-login-inputs:after {
        background-color: @login_text_color;
    }
    .mfp-content #register-link:before {
        border-color: @login_text_color;
    }
    /* @login_button_background */
    .mfp-content .td-login-button {
        background-color: @login_button_background;
    }
    /* @login_button_color */
    .mfp-content .td-login-button {
        color: @login_button_color;
    }
    /* @login_hover_background */
    .mfp-content .td-login-button:active,
    .mfp-content .td-login-button:hover {
        background-color: @login_hover_background;
    }
    /* @login_hover_color */
    .mfp-content .td-login-button:active,
    .mfp-content .td-login-button:hover {
        color: @login_hover_color;
    }
    /* @login_gradient_one */
    .white-popup-block:after {
        background: @login_gradient_one;
        background: -moz-linear-gradient(45deg, @login_gradient_one 0%, @login_gradient_two 100%);
        background: -webkit-gradient(left bottom, right top, color-stop(0%, @login_gradient_one), color-stop(100%, @login_gradient_two));
        background: -webkit-linear-gradient(45deg, @login_gradient_one 0%, @login_gradient_two 100%);
        background: -o-linear-gradient(45deg, @login_gradient_one 0%, @login_gradient_two 100%);
        background: -ms-linear-gradient(45deg, @login_gradient_one 0%, @login_gradient_two 100%);
        background: linear-gradient(45deg, @login_gradient_one 0%, @login_gradient_two 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='@login_gradient_one', endColorstr='@login_gradient_two', GradientType=0 );
    }


    /* @text_logo_color */
    .td-header-text-logo .td-logo-text-container .td-logo-text {
        color: @text_logo_color;
    }

    /* @text_logo_tagline_color */
    .td-header-text-logo .td-logo-text-container .td-tagline-text {
        color: @text_logo_tagline_color;
    }

    /* @footer_color */
    .td-footer-container,
    .td-footer-container .td_module_mx3 .meta-info,
    .td-footer-container .td_module_14 .meta-info,
    .td-footer-container .td_module_mx1 .td-block14-border {
        background-color: @footer_color;
    }
    .td-footer-container .widget_calendar #today {
    	background-color: transparent;
    }

    /* @footer-white */
    .td-footer-container.td-container {
        border-bottom-width: 1px;
    }
    .td-footer-container:before {
        border-width: 0 1px;
    }

    /* @footer_text_color */
    .td-footer-container,
    .td-footer-container a,
    .td-footer-container li,
    .td-footer-container .footer-text-wrap,
    .td-footer-container .meta-info .entry-date,
    .td-footer-container .td-module-meta-info .entry-date,
    .td-footer-container .td_block_text_with_title,
    .td-footer-container .woocommerce .star-rating::before,
    .td-footer-container .widget_text p,
    .td-footer-container .widget_calendar #today,
    .td-footer-container .td-social-style3 .td_social_type a,
    .td-footer-container .td-social-style3,
    .td-footer-container .td-social-style4 .td_social_type a,
    .td-footer-container .td-social-style4,
    .td-footer-container .td-social-style9,
    .td-footer-container .td-social-style10,
    .td-footer-container .td-social-style2 .td_social_type a,
    .td-footer-container .td-social-style8 .td_social_type a,
    .td-footer-container .td-social-style2 .td_social_type,
    .td-footer-container .td-social-style8 .td_social_type,
    .td-footer-container .td-post-author-name a:hover {
        color: @footer_text_color;
    }
    .td-footer-container .td_module_mx1 .meta-info .entry-date,
    .td-footer-container .td_social_button a,
    .td-footer-container .td-post-category,
    .td-footer-container .td-post-category:hover,
    .td-footer-container .td-module-comments a,
    .td-footer-container .td_module_mx1 .td-post-author-name a:hover,
    .td-footer-container .td-theme-slider .slide-meta a {
    	color: #fff
    }
    .td-footer-container .widget_tag_cloud a {
    	border-color: @footer_text_color;
    }
    .td-footer-container .td-excerpt,
    .td-footer-container .widget_rss .rss-date,
    .td-footer-container .widget_rss cite {
    	color: @footer_text_color;
    	opacity: 0.7;
    }
    .td-footer-container .td-read-more a,
    .td-footer-container .td-read-more a:hover {
    	color: #fff;
    }

    /* @border_opacity */
    .td-footer-container .td_module_14 .meta-info,
    .td-footer-container .td_module_5,
    .td-footer-container .td_module_9 .item-details,
    .td-footer-container .td_module_8 .item-details,
    .td-footer-container .td_module_mx3 .meta-info,
    .td-footer-container .widget_recent_comments li,
    .td-footer-container .widget_recent_entries li,
    .td-footer-container table td,
    .td-footer-container table th,
    .td-footer-container .td-social-style2 .td_social_type .td-social-box,
    .td-footer-container .td-social-style8 .td_social_type .td-social-box,
    .td-footer-container .td-social-style2 .td_social_type .td_social_button,
    .td-footer-container .td-social-style8 .td_social_type .td_social_button {
        border-color: @border_opacity;
    }

    /* @footer_text_hover_color */
    .td-footer-container a:hover,
    .td-footer-container .td-post-author-name a:hover,
    .td-footer-container .td_module_wrap:hover .entry-title a {
    	color: @footer_text_hover_color;
    }
    .td-footer-container .widget_tag_cloud a:hover {
    	border-color: @footer_text_hover_color;
    }
    .td-footer-container .td_module_mx1 .td-post-author-name a:hover,
    .td-footer-container .td-theme-slider .slide-meta a {
    	color: #fff
    }

    /* @footer_widget_bg_color */
	.td-footer-container .block-title > span,
    .td-footer-container .block-title > a,
    .td-footer-container .widgettitle {
    	background-color: @footer_widget_bg_color;
    }

    /* @footer_widget_text_color */
	.td-footer-container .block-title > span,
    .td-footer-container .block-title > a,
    .td-footer-container .widgettitle,
    .td-footer-container .widget_rss .block-title .rsswidget {
    	color: @footer_widget_text_color;
    }


    /* @footer_bottom_color */
    .td-sub-footer-container {
        background-color: @footer_bottom_color;
    }
    .td-sub-footer-container:after {
        background-color: transparent;
    }
    .td-sub-footer-container:before {
        background-color: transparent;
    }
    .td-footer-container.td-container {
        border-bottom-width: 0;
    }

    /* @footer_bottom_text_color */
    .td-sub-footer-container,
    .td-sub-footer-container a {
        color: @footer_bottom_text_color;
    }
    .td-sub-footer-container li a:before {
        background-color: @footer_bottom_text_color;
    }

    /* @footer_bottom_hover_color */
    .td-subfooter-menu li a:hover {
        color: @footer_bottom_hover_color;
    }

    /* @module1_title_color */
    .td_module_1 .td-module-title a {
    	color: @module1_title_color;
    }
    /* @module2_title_color */
    .td_module_2 .td-module-title a {
    	color: @module2_title_color;
    }
    /* @module3_title_color */
    .td_module_3 .td-module-title a {
    	color: @module3_title_color;
    }
    /* @module4_title_color */
    .td_module_4 .td-module-title a {
    	color: @module4_title_color;
    }
    /* @module5_title_color */
    .td_module_5 .td-module-title a {
    	color: @module5_title_color;
    }
    /* @module6_title_color */
    .td_module_6 .td-module-title a {
    	color: @module6_title_color;
    }
    /* @module7_title_color */
    .td_module_7 .td-module-title a {
    	color: @module7_title_color;
    }
    /* @module8_title_color */
    .td_module_8 .td-module-title a {
    	color: @module8_title_color;
    }
    /* @module9_title_color */
    .td_module_9 .td-module-title a {
    	color: @module9_title_color;
    }
    /* @module10_title_color */
    .td_module_10 .td-module-title a {
    	color: @module10_title_color;
    }
    /* @module11_title_color */
    .td_module_11 .td-module-title a {
    	color: @module11_title_color;
    }
    /* @module12_title_color */
    .td_module_12 .td-module-title a {
    	color: @module12_title_color;
    }
    /* @module13_title_color */
    .td_module_13 .td-module-title a {
    	color: @module13_title_color;
    }
    /* @module14_title_color */
    .td_module_14 .td-module-title a {
    	color: @module14_title_color;
    }
    /* @module15_title_color */
    .td_module_15 .entry-title a {
    	color: @module15_title_color;
    }
    /* @module_mx2_title_color */
    .td_module_mx2 .td-module-title a {
    	color: @module_mx2_title_color;
    }
    /* @module_mx4_title_color */
    .td_module_mx4 .td-module-title a {
    	color: @module_mx4_title_color;
    }
    /* @news_ticker_title_color */
    .td_block_trending_now .entry-title a {
    	color: @news_ticker_title_color;
    }
    /* @author_name_title_color */
    .td_module_wrap .td-post-author-name a {
    	color: @author_name_title_color;
    }


    /* @post_title_color */
    .post header h1 {
    	color: @post_title_color;
    }
    /* @post_author_name_color */
    header .td-post-author-name a {
    	color: @post_author_name_color;
    }
    /* @post_content_color */
    .td-post-content,
    .td-post-content p {
    	color: @post_content_color;
    }
    /* @post_h_color */
    .td-post-content h1,
    .td-post-content h2,
    .td-post-content h3,
    .td-post-content h4,
    .td-post-content h5,
    .td-post-content h6 {
    	color: @post_h_color;
    }
    /* @post_blockquote_color */
    .post blockquote p,
    .page blockquote p {
    	color: @post_blockquote_color;
    }
    .post .td_quote_box,
    .page .td_quote_box {
        border-color: @post_blockquote_color;
    }

    /* @page_title_color */
    .td-page-header h1 {
    	color: @page_title_color;
    }
    /* @page_content_color */
    .td-page-content p,
    .td-page-content .td_block_text_with_title {
    	color: @page_content_color;
    }
    /* @page_h_color */
    .td-page-content h1,
    .td-page-content h2,
    .td-page-content h3,
    .td-page-content h4,
    .td-page-content h5,
    .td-page-content h6 {
    	color: @page_h_color;
    }


    /* @mobile_background_image */
    .td-menu-background:after,
    .td-search-background:after {
        background-image: url('@mobile_background_image');
    }

    /* @mobile_background_repeat */
    .td-menu-background:after,
    .td-search-background:after {
        background-repeat: @mobile_background_repeat;
    }

    /* @mobile_background_size */
    .td-menu-background:after,
    .td-search-background:after {
        background-size: @mobile_background_size;
    }

    /* @mobile_background_position */
    .td-menu-background:after,
    .td-search-background:after {
        background-position: @mobile_background_position;
    }


    /* @login_background_image */
    .white-popup-block:before {
        background-image: url('@login_background_image');
    }

    /* @login_background_repeat */
    .white-popup-block:before {
        background-repeat: @login_background_repeat;
    }

    /* @login_background_size */
    .white-popup-block:before {
        background-size: @login_background_size;
    }

    /* @login_background_position */
    .white-popup-block:before {
        background-position: @login_background_position;
    }

    /* @login_background_opacity */
    .white-popup-block:before {
        opacity: @login_background_opacity;
    }


    /* ------------------------------------------------------ */
    /* @top_menu */
    .top-header-menu li a,
    .td-header-sp-top-menu .td_data_time,
    .td-weather-top-widget .td-weather-header .td-weather-city,
    .td-weather-top-widget .td-weather-now {
        @top_menu
    }
    /* @top_sub_menu */
    .top-header-menu ul li a {
    	@top_sub_menu
    }
	/* @main_menu */
    .sf-menu > .td-menu-item > a {
        @main_menu
    }
    /* @main_sub_menu */
    .sf-menu ul .td-menu-item a {
        @main_sub_menu
    }
    /* @mega_menu */
    .td_mod_mega_menu .item-details a {
        @mega_menu
    }
    /* @mega_menu_categ */
    .td_mega_menu_sub_cats .block-mega-child-cats a {
        @mega_menu_categ
    }

    /* mobile_general */
	#td-mobile-nav,
	#td-mobile-nav .wpb_button,
	.td-search-wrap-mob {
		@mobile_general
	}

	/* @mobile_menu */
    .td-mobile-content .td-mobile-main-menu > li > a {
        @mobile_menu
    }

	/* @mobile_sub_menu */
    .td-mobile-content .sub-menu a {
        @mobile_sub_menu
    }

	/* @modules_general */
	.td_module_wrap .entry-title,
	.td-theme-slider .td-module-title,
	.page .td-post-template-6 .td-post-header h1 {
		@modules_general
	}

	/* @news_ticker */
    .td_block_trending_now .entry-title {
    	@news_ticker
    }
    /* @module_1 */
    .td_module_1 .td-module-title {
    	@module_1
    }
    /* @module_2 */
    .td_module_2 .td-module-title {
    	@module_2
    }
    /* @module_3 */
    .td_module_3 .td-module-title {
    	@module_3
    }
    /* @module_4 */
    .td_module_4 .td-module-title {
    	@module_4
    }
    /* @module_5 */
    .td_module_5 .td-module-title {
    	@module_5
    }
    /* @module_6 */
    .td_module_6 .td-module-title {
    	@module_6
    }
    /* @module_7 */
    .td_module_7 .td-module-title {
    	@module_7
    }
    /* @module_8 */
    .td_module_8 .td-module-title {
    	@module_8
    }
    /* @module_9 */
    .td_module_9 .td-module-title {
    	@module_9
    }
    /* @module_10 */
    .td_module_10 .td-module-title {
    	@module_10
    }
    /* @module_11 */
    .td_module_11 .td-module-title {
    	@module_11
    }
    /* @module_12 */
    .td_module_12 .td-module-title {
    	@module_12
    }
    /* @module_13 */
    .td_module_13 .td-module-title {
    	@module_13
    }
    /* @module_14 */
    .td_module_14 .td-module-title {
    	@module_14
    }
    /* @module_15 */
    .td_module_15 .entry-title {
    	@module_15
    }
    /* @module_mx1 */
    .td_module_mx1 .td-module-title {
    	@module_mx1
    }
    /* @module_mx2 */
    .td_module_mx2 .td-module-title {
    	@module_mx2
    }
    /* @module_mx3 */
    .td_module_mx3 .td-module-title {
    	@module_mx3
    }
    /* @module_mx4 */
    .td_module_mx4 .td-module-title {
    	@module_mx4
    }
    /* @slider_1column */
    .td-theme-slider.iosSlider-col-3 .td-module-title a {
        @slider_1column
    }
    /* @slider_2columns */
    .td-theme-slider.iosSlider-col-2 .td-module-title a {
        @slider_2columns
    }
    /* @slider_3columns */
    .td-theme-slider.iosSlider-col-1 .td-module-title a {
        @slider_3columns
    }
    /* @homepage_post */
    .page .td-post-template-6 .td-post-header h1 {
        @homepage_post
    }

    /* @blocks_title */
    .block-title > span,
    .block-title > a,
    .widgettitle,
    .td-trending-now-title,
    .wpb_tabs li a,
    .vc_tta-container .vc_tta-color-grey.vc_tta-tabs-position-top.vc_tta-style-classic .vc_tta-tabs-container .vc_tta-tab > a,
    .td-related-title .td-related-left,
    .td-related-title .td-related-right,
    .category .entry-title span,
    .td-author-counters span,
    .woocommerce-tabs h2,
    .woocommerce .product .products h2 {
        @blocks_title
    }
    /* @blocks_author */
    .td-module-meta-info .td-post-author-name a,
    .td_module_wrap .td-post-author-name a {
        @blocks_author
    }
    /* @blocks_date */
    .td-module-meta-info .td-post-date .entry-date,
    .td_module_wrap .td-post-date .entry-date {
        @blocks_date
    }
    /* @blocks_comment */
    .td-module-meta-info .td-module-comments a,
    .td_module_wrap .td-module-comments a {
        @blocks_comment
    }
    /* @blocks_category */
    .td-big-grid-meta .td-post-category,
    .td_module_wrap .td-post-category,
    .td-module-image .td-post-category {
        @blocks_category
    }
    /* @blocks_filter */
    .td-pulldown-filter-display-option,
    a.td-pulldown-filter-link,
    .td-category-pulldown-filter a.td-pulldown-category-filter-link {
        @blocks_filter
    }
    /* @blocks_excerpt */
    .td-excerpt,
    .td-module-excerpt {
        @blocks_excerpt
    }


    /* @big_grid_general */
    .td-big-grid-post .entry-title {
        @big_grid_general
    }
    /* @big_grid_large_image */
    .td_block_big_grid .td-big-thumb .entry-title,
    .td_block_big_grid_2 .td-big-thumb .entry-title,
    .td_block_big_grid_3 .td-big-thumb .entry-title,
    .td_block_big_grid_4 .td-big-thumb .entry-title,
    .td_block_big_grid_5 .td-big-thumb .entry-title,
    .td_block_big_grid_6 .td-big-thumb .entry-title,
    .td_block_big_grid_7 .td-big-thumb .entry-title {
        @big_grid_large_image
    }
    /* @big_grid_medium_image */
    .td_block_big_grid .td-medium-thumb .entry-title,
    .td_block_big_grid_2 .td-medium-thumb .entry-title,
    .td_block_big_grid_3 .td-medium-thumb .entry-title,
    .td_block_big_grid_4 .td-medium-thumb .entry-title,
    .td_block_big_grid_5 .td-medium-thumb .entry-title,
    .td_block_big_grid_6 .td-medium-thumb .entry-title,
    .td_block_big_grid_7 .td-medium-thumb .entry-title {
        @big_grid_medium_image
    }
    /* @big_grid_smalls_image */
    .td_block_big_grid .td-small-thumb .entry-title,
    .td_block_big_grid_2 .td-small-thumb .entry-title,
    .td_block_big_grid_3 .td-small-thumb .entry-title,
    .td_block_big_grid_4 .td-small-thumb .entry-title,
    .td_block_big_grid_5 .td-small-thumb .entry-title,
    .td_block_big_grid_6 .td-small-thumb .entry-title,
    .td_block_big_grid_7 .td-small-thumb .entry-title {
        @big_grid_smalls_image
    }
    /* @big_grid_small_images */
    .td_block_big_grid .td-tiny-thumb .entry-title,
    .td_block_big_grid_2 .td-tiny-thumb .entry-title,
    .td_block_big_grid_3 .td-tiny-thumb .entry-title,
    .td_block_big_grid_4 .td-tiny-thumb .entry-title,
    .td_block_big_grid_5 .td-tiny-thumb .entry-title,
    .td_block_big_grid_6 .td-tiny-thumb .entry-title,
    .td_block_big_grid_7 .td-tiny-thumb .entry-title {
        @big_grid_small_images
    }








	/* @post_general */
	.post header .entry-title {
		@post_general
	}

	/* @post_title */
    .td-post-template-default header .entry-title {
        @post_title
    }
    /* @post_title_style1 */
    .td-post-template-1 header .entry-title {
        @post_title_style1
    }
    /* @post_title_style2 */
    .td-post-template-2 header .entry-title {
        @post_title_style2
    }
    /* @post_title_style3 */
    .td-post-template-3 header .entry-title {
        @post_title_style3
    }
    /* @post_title_style4 */
    .td-post-template-4 header .entry-title {
        @post_title_style4
    }
    /* @post_title_style5 */
    .td-post-template-5 header .entry-title {
        @post_title_style5
    }
    /* @post_title_style6 */
    .td-post-template-6 header .entry-title {
        @post_title_style6
    }
    /* @post_title_style7 */
    .td-post-template-7 header .entry-title {
        @post_title_style7
    }
    /* @post_title_style8 */
    .td-post-template-8 header .entry-title {
        @post_title_style8
    }




    /* @post_content */
    .td-post-content p,
    .td-post-content {
        @post_content
    }
    /* @post_blockquote */
    .post blockquote p,
    .page blockquote p,
    .td-post-text-content blockquote p {
        @post_blockquote
    }
    /* @post_box_quote */
    .post .td_quote_box p,
    .page .td_quote_box p {
        @post_box_quote
    }
    /* @post_pull_quote */
    .post .td_pull_quote p,
    .page .td_pull_quote p {
        @post_pull_quote
    }
    /* @post_lists */
    .td-post-content li {
        @post_lists
    }
    /* @post_h1 */
    .td-post-content h1 {
        @post_h1
    }
    /* @post_h2 */
    .td-post-content h2 {
        @post_h2
    }
    /* @post_h3 */
    .td-post-content h3 {
        @post_h3
    }
    /* @post_h4 */
    .td-post-content h4 {
        @post_h4
    }
    /* @post_h5 */
    .td-post-content h5 {
        @post_h5
    }
    /* @post_h6 */
    .td-post-content h6 {
        @post_h6
    }





    /* @post_category */
    .post .td-category a {
        @post_category
    }
    /* @post_author */
    .post header .td-post-author-name,
    .post header .td-post-author-name a {
        @post_author
    }
    /* @post_date */
    .post header .td-post-date .entry-date {
        @post_date
    }
    /* @post_comment */
    .post header .td-post-views span,
    .post header .td-post-comments {
        @post_comment
    }
    /* @via_source_tag */
    .post .td-post-source-tags a,
    .post .td-post-source-tags span {
        @via_source_tag
    }
    /* @post_next_prev_text */
    .post .td-post-next-prev-content span {
        @post_next_prev_text
    }
    /* @post_next_prev */
    .post .td-post-next-prev-content a {
        @post_next_prev
    }
    /* @box_author_name */
    .post .author-box-wrap .td-author-name a {
        @box_author_name
    }
    /* @box_author_url */
    .post .author-box-wrap .td-author-url a {
        @box_author_url
    }
    /* @box_author_description */
    .post .author-box-wrap .td-author-description {
        @box_author_description
    }
    /* @post_related */
    .td_block_related_posts .entry-title {
        @post_related
    }
    /* @post_share */
    .post .td-post-share-title,
    .td-comments-title-wrap h4,
    .comment-reply-title {
        @post_share
    }
    /* @post_image_caption */
	.wp-caption-text,
	.wp-caption-dd {
		@post_image_caption
	}
    /* @post_subtitle_small */
    .td-post-template-default .td-post-sub-title,
    .td-post-template-1 .td-post-sub-title,
    .td-post-template-5 .td-post-sub-title,
    .td-post-template-7 .td-post-sub-title,
    .td-post-template-8 .td-post-sub-title {
        @post_subtitle_small
    }
    /* @post_subtitle_large */
    .td-post-template-2 .td-post-sub-title,
    .td-post-template-3 .td-post-sub-title,
    .td-post-template-4 .td-post-sub-title,
    .td-post-template-6 .td-post-sub-title {
        @post_subtitle_large
    }








	/* @page_title */
    .td-page-header h1,
    .woocommerce-page .page-title {
    	@page_title
    }
    /* @page_content */
    .td-page-content p,
    .td-page-content .td_block_text_with_title,
    .woocommerce-page .page-description > p,
    .wpb_text_column p {
    	@page_content
    }
    /* @page_h1 */
    .td-page-content h1,
    .wpb_text_column h1 {
    	@page_h1
    }
    /* @page_h2 */
    .td-page-content h2,
    .wpb_text_column h2 {
    	@page_h2
    }
    /* @page_h3 */
    .td-page-content h3,
    .wpb_text_column h3 {
    	@page_h3
    }
    /* @page_h4 */
    .td-page-content h4,
    .wpb_text_column h4 {
    	@page_h4
    }
    /* @page_h5 */
    .td-page-content h5,
    .wpb_text_column h5 {
    	@page_h5
    }
    /* @page_h6 */
    .td-page-content h6,
    .wpb_text_column h6 {
    	@page_h6
    }



    /* @footer_text_about */
	.footer-text-wrap {
		@footer_text_about
	}
	/* @footer_copyright_text */
	.td-sub-footer-copy {
		@footer_copyright_text
	}
	/* @footer_menu_text */
	.td-sub-footer-menu ul li a {
		@footer_menu_text
	}



    /* @category_tag */
    .category .td-category a {
    	@category_tag
    }
    /* @news_ticker_title */
    .td-trending-now-title {
    	@news_ticker_title
    }
    /* @pagination */
    .page-nav a,
    .page-nav span,
    .page-nav i {
    	@pagination
    }


    /* @dropcap */
    .td-page-content .dropcap,
    .td-post-content .dropcap,
    .comment-content .dropcap {
    	@dropcap
    }
    /* @breadcrumb */
    .entry-crumbs a,
    .entry-crumbs span,
    #bbpress-forums .bbp-breadcrumb a,
    #bbpress-forums .bbp-breadcrumb .bbp-breadcrumb-current {
    	@breadcrumb
    }

    /* @default_widgets */
    .widget_archive a,
    .widget_calendar,
    .widget_categories a,
    .widget_nav_menu a,
    .widget_meta a,
    .widget_pages a,
    .widget_recent_comments a,
    .widget_recent_entries a,
    .widget_text .textwidget,
    .widget_tag_cloud a,
    .widget_search input,
    .woocommerce .product-categories a,
    .widget_display_forums a,
    .widget_display_replies a,
    .widget_display_topics a,
    .widget_display_views a,
    .widget_display_stats
     {
    	@default_widgets
    }

    /* @default_buttons */
	input[type=\"submit\"],
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce #respond input#submit {
		@default_buttons
	}

    /* @woocommerce_products */
	.woocommerce .product a h3,
	.woocommerce .widget.woocommerce .product_list_widget a,
	.woocommerce-cart .woocommerce .product-name a {
		@woocommerce_products
	}


    /* @woocommerce_product_title */
	.woocommerce .product .summary .product_title {
		@woocommerce_product_title
	}


    /* @login_general */
	.white-popup-block,
	.white-popup-block .wpb_button {
		@login_general
	}


	/* @body_text */
    body, p {
    	@body_text
    }



    /* @bbpress_header */
    #bbpress-forums .bbp-header .bbp-forums,
    #bbpress-forums .bbp-header .bbp-topics,
    #bbpress-forums .bbp-header {
    	@bbpress_header
    }
    /* @bbpress_titles */
    #bbpress-forums .hentry .bbp-forum-title,
    #bbpress-forums .hentry .bbp-topic-permalink {
    	@bbpress_titles
    }
    /* @bbpress_subcategories */
    #bbpress-forums .bbp-forums-list li {
    	@bbpress_subcategories
    }
    /* @bbpress_description */
    #bbpress-forums .bbp-forum-info .bbp-forum-content {
    	@bbpress_description
    }
    /* @bbpress_author */
    #bbpress-forums div.bbp-forum-author a.bbp-author-name,
    #bbpress-forums div.bbp-topic-author a.bbp-author-name,
    #bbpress-forums div.bbp-reply-author a.bbp-author-name,
    #bbpress-forums div.bbp-search-author a.bbp-author-name,
    #bbpress-forums .bbp-forum-freshness .bbp-author-name,
    #bbpress-forums .bbp-topic-freshness a:last-child {
    	@bbpress_author
    }
    /* @bbpress_replies */
    #bbpress-forums .hentry .bbp-topic-content p,
    #bbpress-forums .hentry .bbp-reply-content p {
    	@bbpress_replies
    }
    /* @bbpress_notices */
    #bbpress-forums div.bbp-template-notice p {
    	@bbpress_notices
    }
    /* @bbpress_pagination */
    #bbpress-forums .bbp-pagination-count,
    #bbpress-forums .page-numbers {
    	@bbpress_pagination
    }
    /* @bbpress_topic */
    #bbpress-forums .bbp-topic-started-by,
    #bbpress-forums .bbp-topic-started-by a,
    #bbpress-forums .bbp-topic-started-in,
    #bbpress-forums .bbp-topic-started-in a {
    	@bbpress_topic
    }


    /* @top-menu-height */
    .td-header-sp-top-widget {
        line-height: @top-menu-height;
    }





    /* ------------------------------------------------------ */
    /* @style_1_block_background_color */
    body .td-block-color-style-1,
    .td-block-color-style-1.td_block_13 .meta-info {
        background-color: @style_1_block_background_color;
    }
    /* @style_1_block_drop_down_background_color */
    body .td-block-color-style-1 .td-pulldown-filter-display-option,
    body .td-block-color-style-1 .td-pulldown-filter-list {
        background-color: @style_1_block_drop_down_background_color_ie8;
        background-color: @style_1_block_drop_down_background_color;
    }
    /* @style_1_block_drop_down_border_color */
    body .td-block-color-style-1 .td-pulldown-filter-display-option,
    body .td-block-color-style-1 .td-pulldown-filter-list {
        border-color: @style_1_block_drop_down_border_color;
    }
    /* @style_1_block_drop_down_text_color */
    body .td-block-color-style-1 .td-pulldown-filter-display-option,
    body .td-block-color-style-1 .td-pulldown-filter-display-option .td-icon-menu-down,
    body .td-block-color-style-1 .td-pulldown-filter-link {
        color: @style_1_block_drop_down_text_color !important;
    }
    /* @style_1_block_module_post_title_color */
    body .td-block-color-style-1 .td-module-title a ,
    body .td-block-color-style-1 i {
        color: @style_1_block_module_post_title_color;
    }
    /* @style_1_block_module_post_excerpt_color */
    body .td-block-color-style-1 .td-excerpt {
        color: @style_1_block_module_post_excerpt_color;
    }
    /* @style_1_block_module_post_author_color */
    body .td-block-color-style-1 .td-post-author-name a,
    body .td-block-color-style-1 .td-post-author-name span {
        color: @style_1_block_module_post_author_color;
    }
    /* @style_1_block_module_post_date_color */
    body .td-block-color-style-1 .td-module-date {
        color: @style_1_block_module_post_date_color;
    }
    /* @style_1_block_module_post_comments_box_background_color */
    body .td-block-color-style-1 .td-module-comments{
        background-color: @style_1_block_module_post_comments_box_background_color;
    }
    .td-block-color-style-1 .td-next-prev-wrap a:hover i {
    	background-color: @style_1_block_module_post_comments_box_background_color;
    	border-color: @style_1_block_module_post_comments_box_background_color;
    }
    /* @style_1_block_module_post_comments_box_background_color_after */
    body .td-block-color-style-1 .td-module-comments a:after{
        border-color: hsl(@style_1_block_module_post_comments_box_background_color_after, 50%, 35%) transparent transparent transparent;
    }
    /* @style_1_block_module_post_comments_color */
    body .td-block-color-style-1 .td-module-comments a {
        color: @style_1_block_module_post_comments_color;
    }
     /* @style_1_block_module_post_divider_color */
    body .td-block-color-style-1 .item-details,
    body .td-block-color-style-1 .td_module_5 {
        border-bottom-color: @style_1_block_module_post_divider_color;
    }
    /* @style_1_block_navigation_background_color */
    body .td-block-color-style-1 .td-next-prev-wrap .td-icon-font {
        background-color: @style_1_block_navigation_background_color;
    }
    /* @style_1_block_navigation_text_color */
    body .td-block-color-style-1 .td-icon-font,
    body .td-block-color-style-1 .td_ajax_load_more {
    	border-color: @style_1_block_navigation_text_color;
        color: @style_1_block_navigation_text_color;
    }
     /* @style_1_block_hover_style */
    .td-block-color-style-1 .td_module_wrap:hover .entry-title a,
    body .td-block-color-style-1 .td-pulldown-filter-display-option:hover,
    body .td-block-color-style-1 .td-pulldown-filter-display-option .td-pulldown-filter-link:hover,
    body .td-block-color-style-1 .td_ajax_load_more:hover,
    body .td-block-color-style-1 .td_ajax_load_more:hover i {
        color: @style_1_block_hover_style !important;
     }
    .td-block-color-style-1 .td-next-prev-wrap a:hover i {
        background-color: @style_1_block_hover_style !important;
        border-color: @style_1_block_hover_style !important;
    }
    .td-block-color-style-1 .td-next-prev-wrap a:hover i {
	  color: #ffffff !important;
	}


	/* ------------------------------------------------------ */
    /* @style_2_block_background_color */
    body .td-block-color-style-2,
    .td-block-color-style-2.td_block_13 .meta-info {
        background-color: @style_2_block_background_color;
    }
    /* @style_2_block_drop_down_background_color */
    body .td-block-color-style-2 .td-pulldown-filter-display-option,
    body .td-block-color-style-2 .td-pulldown-filter-list {
        background-color: @style_2_block_drop_down_background_color_ie8;
        background-color: @style_2_block_drop_down_background_color;
    }
    /* @style_2_block_drop_down_border_color */
    body .td-block-color-style-2 .td-pulldown-filter-display-option,
    body .td-block-color-style-2 .td-pulldown-filter-list {
        border-color: @style_2_block_drop_down_border_color;
    }
    /* @style_2_block_drop_down_text_color */
    body .td-block-color-style-2 .td-pulldown-filter-display-option,
    body .td-block-color-style-2 .td-pulldown-filter-display-option .td-icon-menu-down,
    body .td-block-color-style-2 .td-pulldown-filter-link {
        color: @style_2_block_drop_down_text_color;
    }
    /* @style_2_block_module_post_title_color */
    body .td-block-color-style-2 .td-module-title a,
    body .td-block-color-style-2 i {
        color: @style_2_block_module_post_title_color;
    }
    /* @style_2_block_module_post_excerpt_color */
    body .td-block-color-style-2 .td-excerpt {
        color: @style_2_block_module_post_excerpt_color;
    }
    /* @style_2_block_module_post_author_color */
    body .td-block-color-style-2 .td-post-author-name a,
    body .td-block-color-style-2 .td-post-author-name span {
        color: @style_2_block_module_post_author_color;
    }
    /* @style_2_block_module_post_date_color */
    body .td-block-color-style-2 .td-module-date {
        color: @style_2_block_module_post_date_color;
    }
    /* @style_2_block_module_post_comments_box_background_color */
    body .td-block-color-style-2 .td-module-comments{
        background-color: @style_2_block_module_post_comments_box_background_color;
    }
    .td-block-color-style-2 .td-next-prev-wrap a:hover i {
    	background-color: @style_2_block_module_post_comments_box_background_color;
    	border-color: @style_2_block_module_post_comments_box_background_color;
    }
    /* @style_2_block_module_post_comments_box_background_color_after */
    body .td-block-color-style-2 .td-module-comments a:after{
        border-color: hsl(@style_2_block_module_post_comments_box_background_color_after, 50%, 35%) transparent transparent transparent;
    }
    /* @style_2_block_module_post_comments_color */
    body .td-block-color-style-2 .td-module-comments a {
        color: @style_2_block_module_post_comments_color;
    }
     /* @style_2_block_module_post_divider_color */
    body .td-block-color-style-2 .item-details,
    body .td-block-color-style-2 .td_module_5 {
        border-bottom-color: @style_2_block_module_post_divider_color;
    }
    /* @style_2_block_navigation_background_color */
    body .td-block-color-style-2 .td-next-prev-wrap .td-icon-font {
        background-color: @style_2_block_navigation_background_color;
    }
    /* @style_2_block_navigation_text_color */
    body .td-block-color-style-2 .td-icon-font,
    body .td-block-color-style-2 .td_ajax_load_more {
    	border-color: @style_2_block_navigation_text_color;
        color: @style_2_block_navigation_text_color;
    }
     /* @style_2_block_hover_style */
    .td-block-color-style-2 .td_module_wrap:hover .entry-title a,
    body .td-block-color-style-2 .td-pulldown-filter-display-option:hover,
    body .td-block-color-style-2 .td-pulldown-filter-display-option .td-pulldown-filter-link:hover,
    body .td-block-color-style-2 .td_ajax_load_more:hover,
    body .td-block-color-style-2 .td_ajax_load_more:hover i {
        color: @style_2_block_hover_style !important;
     }
    .td-block-color-style-2 .td-next-prev-wrap a:hover i {
        background-color: @style_2_block_hover_style !important;
        border-color: @style_2_block_hover_style !important;
    }
    .td-block-color-style-2 .td-next-prev-wrap a:hover i {
	  color: #ffffff !important;
	}


	/* ------------------------------------------------------ */
    /* @style_3_block_background_color */
    body .td-block-color-style-3,
    .td-block-color-style-3.td_block_13 .meta-info {
        background-color: @style_3_block_background_color;
    }
    /* @style_3_block_drop_down_background_color */
    body .td-block-color-style-3 .td-pulldown-filter-display-option,
    body .td-block-color-style-3 .td-pulldown-filter-list {
        background-color: @style_3_block_drop_down_background_color_ie8;
        background-color: @style_3_block_drop_down_background_color;
    }
    /* @style_3_block_drop_down_border_color */
    body .td-block-color-style-3 .td-pulldown-filter-display-option,
    body .td-block-color-style-3 .td-pulldown-filter-list {
        border-color: @style_3_block_drop_down_border_color;
    }
    /* @style_3_block_drop_down_text_color */
    body .td-block-color-style-3 .td-pulldown-filter-display-option,
    body .td-block-color-style-3 .td-pulldown-filter-display-option .td-icon-menu-down,
    body .td-block-color-style-3 .td-pulldown-filter-link {
        color: @style_3_block_drop_down_text_color;
    }
    /* @style_3_block_module_post_title_color */
    body .td-block-color-style-3 .td-module-title a,
    body .td-block-color-style-3 i {
        color: @style_3_block_module_post_title_color;
    }
    /* @style_3_block_module_post_excerpt_color */
    body .td-block-color-style-3 .td-excerpt {
        color: @style_3_block_module_post_excerpt_color;
    }
    /* @style_3_block_module_post_author_color */
    body .td-block-color-style-3 .td-post-author-name a,
    body .td-block-color-style-3 .td-post-author-name span {
        color: @style_3_block_module_post_author_color;
    }
    /* @style_3_block_module_post_date_color */
    body .td-block-color-style-3 .td-module-date {
        color: @style_3_block_module_post_date_color;
    }
    /* @style_3_block_module_post_comments_box_background_color */
    body .td-block-color-style-3 .td-module-comments{
        background-color: @style_3_block_module_post_comments_box_background_color;
    }
    .td-block-color-style-3 .td-next-prev-wrap a:hover i {
    	background-color: @style_3_block_module_post_comments_box_background_color;
    	border-color: @style_3_block_module_post_comments_box_background_color;
    }
    /* @style_3_block_module_post_comments_box_background_color_after */
    body .td-block-color-style-3 .td-module-comments a:after{
        border-color: hsl(@style_3_block_module_post_comments_box_background_color_after, 50%, 35%) transparent transparent transparent;
    }
    /* @style_3_block_module_post_comments_color */
    body .td-block-color-style-3 .td-module-comments a {
        color: @style_3_block_module_post_comments_color;
    }
     /* @style_3_block_module_post_divider_color */
    body .td-block-color-style-3 .item-details,
    body .td-block-color-style-3 .td_module_5 {
        border-bottom-color: @style_3_block_module_post_divider_color;
    }
    /* @style_3_block_navigation_background_color */
    body .td-block-color-style-3 .td-next-prev-wrap .td-icon-font {
        background-color: @style_3_block_navigation_background_color;
    }
    /* @style_3_block_navigation_text_color */
    body .td-block-color-style-3 .td-icon-font,
    body .td-block-color-style-3 .td_ajax_load_more {
    	border-color: @style_3_block_navigation_text_color;
        color: @style_3_block_navigation_text_color;
    }
     /* @style_3_block_hover_style */
    .td-block-color-style-3 .td_module_wrap:hover .entry-title a,
    body .td-block-color-style-3 .td-pulldown-filter-display-option:hover,
    body .td-block-color-style-3 .td-pulldown-filter-display-option .td-pulldown-filter-link:hover,
    body .td-block-color-style-3 .td_ajax_load_more:hover,
    body .td-block-color-style-3 .td_ajax_load_more:hover i {
        color: @style_3_block_hover_style !important;
     }
    .td-block-color-style-3 .td-next-prev-wrap a:hover i {
        background-color: @style_3_block_hover_style !important;
        border-color: @style_3_block_hover_style !important;
    }
    .td-block-color-style-3 .td-next-prev-wrap a:hover i {
	  color: #ffffff !important;
	}



	/* ------------------------------------------------------ */
    /* @style_4_block_background_color */
    body .td-block-color-style-4,
    .td-block-color-style-4.td_block_13 .meta-info {
        background-color: @style_4_block_background_color;
    }
    /* @style_4_block_drop_down_background_color */
    body .td-block-color-style-4 .td-pulldown-filter-display-option,
    body .td-block-color-style-4 .td-pulldown-filter-list {
        background-color: @style_4_block_drop_down_background_color_ie8;
        background-color: @style_4_block_drop_down_background_color;
    }
    /* @style_4_block_drop_down_border_color */
    body .td-block-color-style-4 .td-pulldown-filter-display-option,
    body .td-block-color-style-4 .td-pulldown-filter-list {
        border-color: @style_4_block_drop_down_border_color;
    }
    /* @style_4_block_drop_down_text_color */
    body .td-block-color-style-4 .td-pulldown-filter-display-option,
    body .td-block-color-style-4 .td-pulldown-filter-display-option .td-icon-menu-down,
    body .td-block-color-style-4 .td-pulldown-filter-link {
        color: @style_4_block_drop_down_text_color;
    }
    /* @style_4_block_module_post_title_color */
    body .td-block-color-style-4 .td-module-title a,
    body .td-block-color-style-4 i {
        color: @style_4_block_module_post_title_color;
    }
    /* @style_4_block_module_post_excerpt_color */
    body .td-block-color-style-4 .td-excerpt {
        color: @style_4_block_module_post_excerpt_color;
    }
    /* @style_4_block_module_post_author_color */
    body .td-block-color-style-4 .td-post-author-name a,
    body .td-block-color-style-4 .td-post-author-name span {
        color: @style_4_block_module_post_author_color;
    }
    /* @style_4_block_module_post_date_color */
    body .td-block-color-style-4 .td-module-date {
        color: @style_4_block_module_post_date_color;
    }
    /* @style_4_block_module_post_comments_box_background_color */
    body .td-block-color-style-4 .td-module-comments {
        background-color: @style_4_block_module_post_comments_box_background_color;
    }
    .td-block-color-style-4 .td-next-prev-wrap a:hover i {
    	background-color: @style_4_block_module_post_comments_box_background_color;
    	border-color: @style_4_block_module_post_comments_box_background_color;
    }
    /* @style_4_block_module_post_comments_box_background_color_after */
    body .td-block-color-style-4 .td-module-comments a:after {
        border-color: hsl(@style_4_block_module_post_comments_box_background_color_after, 50%, 35%) transparent transparent transparent;
    }
    /* @style_4_block_module_post_comments_color */
    body .td-block-color-style-4 .td-module-comments a {
        color: @style_4_block_module_post_comments_color;
    }
     /* @style_4_block_module_post_divider_color */
    body .td-block-color-style-4 .item-details,
    body .td-block-color-style-4 .td_module_5 {
        border-bottom-color: @style_4_block_module_post_divider_color;
    }
    /* @style_4_block_navigation_background_color */
    body .td-block-color-style-4 .td-next-prev-wrap .td-icon-font {
        background-color: @style_4_block_navigation_background_color;
    }
    /* @style_4_block_navigation_text_color */
    body .td-block-color-style-4 .td-icon-font,
    body .td-block-color-style-4 .td_ajax_load_more {
    	border-color: @style_4_block_navigation_text_color;
        color: @style_4_block_navigation_text_color;
    }
     /* @style_4_block_hover_style */
    .td-block-color-style-4 .td_module_wrap:hover .entry-title a,
    body .td-block-color-style-4 .td-pulldown-filter-display-option:hover,
    body .td-block-color-style-4 .td-pulldown-filter-display-option .td-pulldown-filter-link:hover,
    body .td-block-color-style-4 .td_ajax_load_more:hover,
    body .td-block-color-style-4 .td_ajax_load_more:hover i {
        color: @style_4_block_hover_style !important;
     }
    .td-block-color-style-4 .td-next-prev-wrap a:hover i {
        background-color: @style_4_block_hover_style !important;
        border-color: @style_4_block_hover_style !important;
    }
    .td-block-color-style-4 .td-next-prev-wrap a:hover i {
	  color: #ffffff !important;
	}




	/* ------------------------------------------------------ */
    /* @style_5_block_background_color */
    body .td-block-color-style-5,
    .td-block-color-style-5.td_block_13 .meta-info {
        background-color: @style_5_block_background_color;
    }
    /* @style_5_block_drop_down_background_color */
    body .td-block-color-style-5 .td-pulldown-filter-display-option,
    body .td-block-color-style-5 .td-pulldown-filter-list {
        background-color: @style_5_block_drop_down_background_color_ie8;
        background-color: @style_5_block_drop_down_background_color;
    }
    /* @style_5_block_drop_down_border_color */
    body .td-block-color-style-5 .td-pulldown-filter-display-option,
    body .td-block-color-style-5 .td-pulldown-filter-list {
        border-color: @style_5_block_drop_down_border_color;
    }
    /* @style_5_block_drop_down_text_color */
    body .td-block-color-style-5 .td-pulldown-filter-display-option,
    body .td-block-color-style-5 .td-pulldown-filter-display-option .td-icon-menu-down,
    body .td-block-color-style-5 .td-pulldown-filter-link {
        color: @style_5_block_drop_down_text_color;
    }
    /* @style_5_block_module_post_title_color */
    body .td-block-color-style-5 .td-module-title a,
    body .td-block-color-style-5 i {
        color: @style_5_block_module_post_title_color;
    }
    /* @style_5_block_module_post_excerpt_color */
    body .td-block-color-style-5 .td-excerpt {
        color: @style_5_block_module_post_excerpt_color;
    }
    /* @style_5_block_module_post_author_color */
    body .td-block-color-style-5 .td-post-author-name a,
    body .td-block-color-style-5 .td-post-author-name span {
        color: @style_5_block_module_post_author_color;
    }
    /* @style_5_block_module_post_date_color */
    body .td-block-color-style-5 .td-module-date {
        color: @style_5_block_module_post_date_color;
    }
    /* @style_5_block_module_post_comments_box_background_color */
    body .td-block-color-style-5 .td-module-comments {
        background-color: @style_5_block_module_post_comments_box_background_color;
    }
    .td-block-color-style-5 .td-next-prev-wrap a:hover i {
    	background-color: @style_5_block_module_post_comments_box_background_color;
    	border-color: @style_5_block_module_post_comments_box_background_color;
    }
    /* @style_5_block_module_post_comments_box_background_color_after */
    body .td-block-color-style-5 .td-module-comments a:after {
        border-color: hsl(@style_5_block_module_post_comments_box_background_color_after, 50%, 35%) transparent transparent transparent;
    }
    /* @style_5_block_module_post_comments_color */
    body .td-block-color-style-5 .td-module-comments a {
        color: @style_5_block_module_post_comments_color;
    }
     /* @style_5_block_module_post_divider_color */
    body .td-block-color-style-5 .item-details,
    body .td-block-color-style-5 .td_module_5 {
        border-bottom-color: @style_5_block_module_post_divider_color;
    }
    /* @style_5_block_navigation_background_color */
    body .td-block-color-style-5 .td-next-prev-wrap .td-icon-font {
        background-color: @style_5_block_navigation_background_color;
    }
    /* @style_5_block_navigation_text_color */
    body .td-block-color-style-5 .td-icon-font,
    body .td-block-color-style-5 .td_ajax_load_more {
    	border-color: @style_5_block_navigation_text_color;
        color: @style_5_block_navigation_text_color;
    }
     /* @style_5_block_hover_style */
    .td-block-color-style-5 .td_module_wrap:hover .entry-title a,
    body .td-block-color-style-5 .td-pulldown-filter-display-option:hover,
    body .td-block-color-style-5 .td-pulldown-filter-display-option .td-pulldown-filter-link:hover,
    body .td-block-color-style-5 .td_ajax_load_more:hover,
    body .td-block-color-style-5 .td_ajax_load_more:hover i {
        color: @style_5_block_hover_style !important;
     }
    .td-block-color-style-5 .td-next-prev-wrap a:hover i {
        background-color: @style_5_block_hover_style !important;
        border-color: @style_5_block_hover_style !important;
    }
    .td-block-color-style-5 .td-next-prev-wrap a:hover i {
	  color: #ffffff !important;
	}



	/* ------------------------------------------------------ */
    /* @style_6_block_background_color */
    body .td-block-color-style-6,
    .td-block-color-style-6.td_block_13 .meta-info {
        background-color: @style_6_block_background_color;
    }
    /* @style_6_block_drop_down_background_color */
    body .td-block-color-style-6 .td-pulldown-filter-display-option,
    body .td-block-color-style-6 .td-pulldown-filter-list {
        background-color: @style_6_block_drop_down_background_color_ie8;
        background-color: @style_6_block_drop_down_background_color;
    }
    /* @style_6_block_drop_down_border_color */
    body .td-block-color-style-6 .td-pulldown-filter-display-option,
    body .td-block-color-style-6 .td-pulldown-filter-list {
        border-color: @style_6_block_drop_down_border_color;
    }
    /* @style_6_block_drop_down_text_color */
    body .td-block-color-style-6 .td-pulldown-filter-display-option,
    body .td-block-color-style-6 .td-pulldown-filter-display-option .td-icon-menu-down,
    body .td-block-color-style-6 .td-pulldown-filter-link {
        color: @style_6_block_drop_down_text_color;
    }
    /* @style_6_block_module_post_title_color */
    body .td-block-color-style-6 .td-module-title a,
    body .td-block-color-style-6 i {
        color: @style_6_block_module_post_title_color;
    }
    /* @style_6_block_module_post_excerpt_color */
    body .td-block-color-style-6 .td-excerpt {
        color: @style_6_block_module_post_excerpt_color;
    }
    /* @style_6_block_module_post_author_color */
    body .td-block-color-style-6 .td-post-author-name a,
    body .td-block-color-style-6 .td-post-author-name span {
        color: @style_6_block_module_post_author_color;
    }
    /* @style_6_block_module_post_date_color */
    body .td-block-color-style-6 .td-module-date {
        color: @style_6_block_module_post_date_color;
    }
    /* @style_6_block_module_post_comments_box_background_color */
    body .td-block-color-style-6 .td-module-comments {
        background-color: @style_6_block_module_post_comments_box_background_color;
    }
    .td-block-color-style-6 .td-next-prev-wrap a:hover i {
    	background-color: @style_6_block_module_post_comments_box_background_color;
    	border-color: @style_6_block_module_post_comments_box_background_color;
    }
    /* @style_6_block_module_post_comments_box_background_color_after */
    body .td-block-color-style-6 .td-module-comments a:after {
        border-color: hsl(@style_6_block_module_post_comments_box_background_color_after, 50%, 35%) transparent transparent transparent;
    }
    /* @style_6_block_module_post_comments_color */
    body .td-block-color-style-6 .td-module-comments a {
        color: @style_6_block_module_post_comments_color;
    }
     /* @style_6_block_module_post_divider_color */
    body .td-block-color-style-6 .item-details,
    body .td-block-color-style-6 .td_module_5 {
        border-bottom-color: @style_6_block_module_post_divider_color;
    }
    /* @style_6_block_navigation_background_color */
    body .td-block-color-style-6 .td-next-prev-wrap .td-icon-font {
        background-color: @style_6_block_navigation_background_color;
    }
    /* @style_6_block_navigation_text_color */
    body .td-block-color-style-6 .td-icon-font,
    body .td-block-color-style-6 .td_ajax_load_more {
    	border-color: @style_6_block_navigation_text_color;
        color: @style_6_block_navigation_text_color;
    }
     /* @style_6_block_hover_style */
    .td-block-color-style-6 .td_module_wrap:hover .entry-title a,
    body .td-block-color-style-6 .td-pulldown-filter-display-option:hover,
    body .td-block-color-style-6 .td-pulldown-filter-display-option .td-pulldown-filter-link:hover,
    body .td-block-color-style-6 .td_ajax_load_more:hover,
    body .td-block-color-style-6 .td_ajax_load_more:hover i {
        color: @style_6_block_hover_style !important;
     }
    .td-block-color-style-6 .td-next-prev-wrap a:hover i {
        background-color: @style_6_block_hover_style !important;
        border-color: @style_6_block_hover_style !important;
    }
    .td-block-color-style-6 .td-next-prev-wrap a:hover i {
	  color: #ffffff !important;
	}


	/* @main-menu-height */
	@media (min-width: 768px) {
        .td-main-menu-logo img,
        .sf-menu > .td-menu-item > a > img {
            max-height: @main-menu-height;
        }
        #td-header-menu,
        .td-header-menu-wrap {
            min-height: @main-menu-height;
        }
        .td-main-menu-logo a {
            line-height: @main-menu-height;
        }
	}
	.td-main-menu-logo {
	    height: @main-menu-height;
	}


	/* @footer_background_image */
    .td-footer-container::before {
        background-image: url('@footer_background_image');
    }

    /* @footer_background_repeat */
    .td-footer-container::before {
        background-repeat: @footer_background_repeat;
    }

    /* @footer_background_size */
    .td-footer-container::before {
        background-size: @footer_background_size;
    }

    /* @footer_background_position */
    .td-footer-container::before {
        background-position: @footer_background_position;
    }

    /* @footer_background_opacity */
    .td-footer-container::before {
        opacity: @footer_background_opacity;
    }

    </style>
    ";



    $td_css_compiler = new td_css_compiler($raw_css);
    //the template directory uri
    $td_css_compiler->load_setting_raw('get_template_directory_uri', get_template_directory_uri());


    //get $typography array from db and added to generated css
    $td_typography_array = td_fonts::td_get_typography_sections_from_db();
    if(is_array($td_typography_array) and !empty($td_typography_array)) {

        foreach ($td_typography_array as $section_id => $section_css_array) {
            $td_css_compiler->load_setting_array(array($section_id => $section_css_array));
        }
    }

	// read line-height for the main-menu to align the logo in menu
	$td_menu_height = td_util::get_option('td_fonts');
	if (!empty($td_menu_height['main_menu']['line_height'])) {
		$td_css_compiler->load_setting_raw('main-menu-height', $td_menu_height['main_menu']['line_height']);
	}

    // read line-height for the top-menu to align the social icons in top menu
    $td_top_menu_height = td_util::get_option('td_fonts');
    if (!empty($td_top_menu_height['top_menu']['line_height'])) {
        $td_css_compiler->load_setting_raw('top-menu-height', $td_top_menu_height['top_menu']['line_height']);
    }

    // read footer color if is white
    $td_footer_color = td_util::get_option('tds_footer_color');
    if ($td_footer_color == '#ffffff' or $td_footer_color == 'ffffff' or $td_footer_color == '#fff') {
        $td_css_compiler->load_setting_raw('footer-white', $td_footer_color);
    }

    //load the user settings
    // general
    $td_css_compiler->load_setting('theme_color');
    $td_css_compiler->load_setting('grid_line_color');


    // header ---------
    $td_css_compiler->load_setting('top_menu_color');
    $td_css_compiler->load_setting('top_menu_text_color');
    $td_css_compiler->load_setting('top_menu_text_hover_color');
	$td_css_compiler->load_setting('top_sub_menu_text_color');
	$td_css_compiler->load_setting('top_sub_menu_text_hover_color');
    $td_css_compiler->load_setting('top_social_icons_color');
    $td_css_compiler->load_setting('top_social_icons_hover_color');
    $td_css_compiler->load_setting('menu_color');
    $td_css_compiler->load_setting('menu_text_color');
	$td_css_compiler->load_setting('menu_border_color');
    $td_css_compiler->load_setting('header_wrap_color');
    $td_css_compiler->load_setting('text_logo_color');
    $td_css_compiler->load_setting('text_logo_tagline_color');

    // mobile menu
    $td_css_compiler->load_setting('mobile_menu_color');
    $td_css_compiler->load_setting('mobile_icons_color');
    $td_css_compiler->load_setting('mobile_text_color');
    $td_css_compiler->load_setting('mobile_text_active_color');

    // menu gradient color
    $td_css_compiler->load_setting('mobile_gradient_one_mob');
    $td_css_compiler->load_setting('mobile_gradient_two_mob');
    //color one is empty
    if (empty($td_css_compiler->settings['mobile_gradient_one_mob']) && !empty($td_css_compiler->settings['mobile_gradient_two_mob'])) {
        $td_css_compiler->load_setting_raw('mobile_gradient_one_mob', '#333145');
    }
    //color two is empty
    if (!empty($td_css_compiler->settings['mobile_gradient_one_mob']) && empty($td_css_compiler->settings['mobile_gradient_two_mob'])) {
        $td_css_compiler->load_setting_raw('mobile_gradient_two_mob', '#b8333e');
    }


    // sign in/join color
    $td_css_compiler->load_setting('login_text_color');
    $td_css_compiler->load_setting('login_button_background');
    $td_css_compiler->load_setting('login_button_color');
    $td_css_compiler->load_setting('login_hover_background');
    $td_css_compiler->load_setting('login_hover_color');
    // login gradient color
    $td_css_compiler->load_setting('login_gradient_one');
    $td_css_compiler->load_setting('login_gradient_two');
    //color one is empty
    if (empty($td_css_compiler->settings['login_gradient_one']) && !empty($td_css_compiler->settings['login_gradient_two'])) {
        $td_css_compiler->load_setting_raw('login_gradient_one', 'rgba(0, 0, 0, 0.8)');
    }
    //color two is empty
    if (!empty($td_css_compiler->settings['login_gradient_one']) && empty($td_css_compiler->settings['login_gradient_two'])) {
        $td_css_compiler->load_setting_raw('login_gradient_two', 'rgba(0, 0, 0, 0.8)');
    }


    $td_css_compiler->load_setting('mobile_button_background_mob');
    $td_css_compiler->load_setting('mobile_button_color_mob');

    // footer background
    $td_css_compiler->load_setting('footer_background_image');
    $td_css_compiler->load_setting('footer_background_repeat');
    $td_css_compiler->load_setting('footer_background_size');
    $td_css_compiler->load_setting('footer_background_position');
    $td_css_compiler->load_setting('footer_background_opacity');

    // mobile menu/search background
    $td_css_compiler->load_setting('mobile_background_image');
    $td_css_compiler->load_setting('mobile_background_repeat');
    $td_css_compiler->load_setting('mobile_background_size');
    $td_css_compiler->load_setting('mobile_background_position');

    // sign in/join background
    $td_css_compiler->load_setting('login_background_image');
    $td_css_compiler->load_setting('login_background_repeat');
    $td_css_compiler->load_setting('login_background_size');
    $td_css_compiler->load_setting('login_background_position');
    $td_css_compiler->load_setting('login_background_opacity');

    // footer ---------
    $td_css_compiler->load_setting('footer_color');
    $td_css_compiler->load_setting('footer_text_color');
    $td_css_compiler->load_setting('footer_text_hover_color');
    $td_css_compiler->load_setting('footer_widget_bg_color');
    $td_css_compiler->load_setting('footer_widget_text_color');
    $td_css_compiler->load_setting('footer_text_hover_color');
    $td_css_compiler->load_setting('footer_bottom_color');
    $td_css_compiler->load_setting('footer_bottom_text_color');
    $td_css_compiler->load_setting('footer_bottom_hover_color');

	// posts
	$td_css_compiler->load_setting('post_title_color');
	$td_css_compiler->load_setting('post_author_name_color');
	$td_css_compiler->load_setting('post_content_color');
	$td_css_compiler->load_setting('post_h_color');
	$td_css_compiler->load_setting('post_blockquote_color');

	// pages
	$td_css_compiler->load_setting('page_title_color');
	$td_css_compiler->load_setting('page_content_color');
	$td_css_compiler->load_setting('page_h_color');


	// modules and blocks
	$td_css_compiler->load_setting('module1_title_color');
	$td_css_compiler->load_setting('module2_title_color');
	$td_css_compiler->load_setting('module3_title_color');
	$td_css_compiler->load_setting('module4_title_color');
	$td_css_compiler->load_setting('module5_title_color');
	$td_css_compiler->load_setting('module6_title_color');
	$td_css_compiler->load_setting('module7_title_color');
	$td_css_compiler->load_setting('module8_title_color');
	$td_css_compiler->load_setting('module9_title_color');
	$td_css_compiler->load_setting('module10_title_color');
	$td_css_compiler->load_setting('module11_title_color');
	$td_css_compiler->load_setting('module12_title_color');
	$td_css_compiler->load_setting('module13_title_color');
	$td_css_compiler->load_setting('module14_title_color');
	$td_css_compiler->load_setting('module15_title_color');
	$td_css_compiler->load_setting('module_mx2_title_color');
	$td_css_compiler->load_setting('module_mx4_title_color');
	$td_css_compiler->load_setting('news_ticker_title_color');
	$td_css_compiler->load_setting('author_name_title_color');




    //load the selection color
    $tds_theme_color = td_util::get_option('tds_theme_color');
    if (!empty($tds_theme_color)) {
        //the select
        $td_css_compiler->load_setting_raw('select_color', td_util::adjustBrightness($tds_theme_color, 50));

        //the sliders text
        $td_css_compiler->load_setting_raw('slider_text', td_util::hex2rgba($tds_theme_color, 0.7));
    }


    // footer text color used for borders with opacity
    $tds_footer_text_color = td_util::get_option('tds_footer_text_color');
    if (!empty($tds_footer_text_color)) {
        $td_css_compiler->load_setting_raw('border_opacity', td_util::hex2rgba($tds_footer_text_color, 0.1));
    }


    /**
     * add td_fonts_css_buffer from database into the source of the page
     * td_fonts_css_buffer : used to store the css generated for custom font files in the database
     */
    $td_fonts_css_buffer = td_fonts::td_add_fonts_css_buffer();

    /* add block styles */
    $td_block_styles = td_util::get_option('td_block_styles');

    //check if we have something set by the user
    if(!empty($td_block_styles)) {
        foreach($td_block_styles as $style_name => $array_style_options) {
            foreach($array_style_options as $option_key => $option_val){
                if(!empty($td_block_styles[$style_name][$option_key])) {

                    $option_name_generator = str_replace('tds_', $style_name . '_', $option_key);

                    switch ($option_key) {
                        case 'tds_block_drop_down_background_color':
                            $td_css_compiler->load_setting_raw($option_name_generator, td_util::hex2rgba($td_block_styles[$style_name][$option_key], 0.95));
                            $td_css_compiler->load_setting_raw($option_name_generator . '_ie8' , $td_block_styles[$style_name][$option_key]);
                            break;

                        case 'tds_block_module_post_comments_box_background_color':
                            $td_css_compiler->load_setting_raw($option_name_generator , $td_block_styles[$style_name][$option_key]);

                            //converting hex color to rgb
                            $rgb_color = td_util::html2rgb($td_block_styles[$style_name][$option_key]);

                            //converting rgb to hsl
                            $hsl_color = td_util::rgb2Hsl($rgb_color[0], $rgb_color[1], $rgb_color[2]);

                            //this is a hack for HLS color: red is 0 in HLS and no output is generated
                            if(intval($hsl_color[0] == 0)) {
                                $hsl_color[0] = 1;
                            }

                            $td_css_compiler->load_setting_raw($option_name_generator . '_after' , $hsl_color[0]);
                            break;

                        default:
                            $td_css_compiler->load_setting_raw($option_name_generator, $td_block_styles[$style_name][$option_key]);
                    }
                }
            }
        }
    }


    //return the style
    return $td_fonts_css_buffer . $td_css_compiler->compile_css();
}


