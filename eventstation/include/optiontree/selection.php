<?php function eventstation_selection() {?>
	<?php echo eventstation_google_webfont(); ?>
	<style id='eventstation-selection' type='text/css'>
		/*----- CUSTOM TYPOGRAPHY START -----*/
		<?php if( ot_get_option('theme_one_font') !== "" ) { ?>
			body, .speakers-widget .speaker-item-header .speaker-item-topic-wrapper h4.speaker-item-topic-title, .speakers-widget .speaker-item-body h3, .counter-box .DateCountdown .time_circles > div h4, .footer-newsletter input[type="email"], .footer-newsletter input[type="submit"], .page404 .content404 .content404-bottom input[type="text"] {
				<?php eventstation_type_echo( ot_get_option('theme_one_font'), false, 'Roboto' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('theme_two_font') !== "" ) { ?>
			h1, h2, h3, h4, h5, h6, .eventstation-pagination, .content-heading .heading-navigation ul, .service-box.service-box-image-style .service-box-image-style-image .service-box-image-style-more, .event-box .event-box-image .event-box-image-wrapper .event-box-image-content-wrapper .event-box-image-content .event-box-image-content-top, .event-box .event-box-image .event-box-image-wrapper .event-box-image-content-wrapper .event-box-image-content .event-box-image-content-date, .counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-general-content-top, .counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-general-content-date, .counter-box .DateCountdown .time_circles > div, .schedule-widget .tab-content .tab-content-schedule-list li .hour, .widget_categories ul li, .widget_pages ul li, .widget_recent_comments ul li, .widget_recent_entries ul li, .widget_archive ul li, .widget_nav_menu ul li, .widget_rss ul li, .widget_meta ul li, .footer, .page404 .content404 .content404-bottom .icon404 {
				<?php eventstation_type_echo( ot_get_option('theme_two_font'), false, 'Roboto Slab' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('body_text') !== "" ) { ?>
			body {
				<?php eventstation_type_echo( ot_get_option('body_text'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('h1_font') !== "" ) { ?>
			h1 {
				<?php eventstation_type_echo( ot_get_option('h1_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('h2_font') !== "" ) { ?>
			h2 {
				<?php eventstation_type_echo( ot_get_option('h2_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('h3_font') !== "" ) { ?>
			h3 {
				<?php eventstation_type_echo( ot_get_option('h3_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('h4_font') !== "" ) { ?>
			h4 {
				<?php eventstation_type_echo( ot_get_option('h4_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('h5_font') !== "" ) { ?>
			h5 {
				<?php eventstation_type_echo( ot_get_option('h5_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('h6_font') !== "" ) { ?>
			h6 {
				<?php eventstation_type_echo( ot_get_option('h6_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('input_font') !== "" ) { ?>
			input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], input[type="time"], input[type="week"], input[type="search"], input[type="month"], input[type="datetime"], input[type="date"], textarea, textarea.form-control, select, .woocommerce form .form-row .select2-container .select2-choice, .form-control {
				<?php eventstation_type_echo( ot_get_option('input_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('input_placeholder_font') !== "" ) { ?>
			input::-webkit-input-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			input::-moz-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			input:-ms-input-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			input:-moz-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			
			.form-control::-webkit-input-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			.form-control::-moz-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			.form-control:-ms-input-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			.form-control:-moz-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }

			textarea::-webkit-input-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			textarea::-moz-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			textarea:-ms-input-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			textarea:-moz-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }

			select::-webkit-input-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			select::-moz-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			select:-ms-input-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }
			select:-moz-placeholder { <?php eventstation_type_echo( ot_get_option('input_placeholder_font'), false, '' ); ?> }	
		<?php } ?>
		<?php if( ot_get_option('button_font') !== "" ) { ?>
			button, input[type="submit"], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
				<?php eventstation_type_echo( ot_get_option('button_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('header_default_menu_font') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-default .menu-area .navbar-nav>li>a,
				.header-wrapper.header-default .menu-area .navbar-nav>li>a:visited {
					<?php eventstation_type_echo( ot_get_option('header_default_menu_font'), false, '' ); ?>
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_default_submenu_font') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-default .header .menu-area .navbar-nav li .dropdown-menu li a,
				.header-wrapper.header-default .header .menu-area .navbar-nav li .dropdown-menu li a:visited {
					<?php eventstation_type_echo( ot_get_option('header_default_submenu_font'), false, '' ); ?>
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_alternative_menu_font') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-alternative .menu-area .navbar-nav>li>a,
				.header-wrapper.header-alternative .menu-area .navbar-nav>li>a:visited {
					<?php eventstation_type_echo( ot_get_option('header_alternative_menu_font'), false, '' ); ?>
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_alternative_submenu_font') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-alternative .header .menu-area .navbar-nav li .dropdown-menu li a,
				.header-wrapper.header-alternative .header .menu-area .navbar-nav li .dropdown-menu li a:visited {
					<?php eventstation_type_echo( ot_get_option('header_alternative_submenu_font'), false, '' ); ?>
				}
			}
		<?php } ?>
		<?php if( ot_get_option('blog_posts_title_font') !== "" ) { ?>
			.category-post-list.category-item-list article .post-wrapper .post-header h2 a,
			.category-post-list.category-item-list article .post-wrapper .post-header h2 a:visited{
				<?php eventstation_type_echo( ot_get_option('blog_posts_title_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('blog_posts_title_hover_font') !== "" ) { ?>
			.category-post-list.category-item-list article .post-wrapper .post-header h2 a:hover,
			.category-post-list.category-item-list article .post-wrapper .post-header h2 a:focus{
				<?php eventstation_type_echo( ot_get_option('blog_posts_title_hover_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('blog_posts_content_font') !== "" ) { ?>
			.category-post-list.category-item-list .post-excerpt {
				<?php eventstation_type_echo( ot_get_option('blog_posts_content_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('blog_page_title_excerpt_font') !== "" ) { ?>
			.category-post-list.category-item-list article .post-wrapper .post-header .post-excerpt-two {
				<?php eventstation_type_echo( ot_get_option('blog_page_title_excerpt_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('single_posts_title_font') !== "" ) { ?>
			.category-post-list.post-list.single-list article .post-wrapper .post-header h2 {
				<?php eventstation_type_echo( ot_get_option('single_posts_title_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('single_posts_content_font') !== "" ) { ?>
			.category-post-list.post-list.single-list .post-content {
				<?php eventstation_type_echo( ot_get_option('single_posts_content_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('single_page_title_excerpt_font') !== "" ) { ?>
			.category-post-list.post-list.single-list .post-wrapper .post-header .post-excerpt-two {
				<?php eventstation_type_echo( ot_get_option('single_page_title_excerpt_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('single_posts_bottom_element_title_font') !== "" ) { ?>
			body .comments-area .comment-reply-title h2,
			body .comments-area .comment-respond .comment-reply-title h2 {
				<?php eventstation_type_echo( ot_get_option('single_posts_bottom_element_title_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('page_title_font') !== "" ) { ?>
			.page-content.page-list article .page-header h2 {
				<?php eventstation_type_echo( ot_get_option('page_title_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('page_content_font') !== "" ) { ?>
			.page-content.page-list article .page-content-bottom {
				<?php eventstation_type_echo( ot_get_option('page_content_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('page_title_excerpt_font') !== "" ) { ?>
			.page-content.page-list article .page-header .post-excerpt-two {
				<?php eventstation_type_echo( ot_get_option('page_title_excerpt_font'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('404_page_title') !== "" ) { ?>
			body .page404 .content404 h2 {
				<?php eventstation_type_echo( ot_get_option('404_page_title'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('404_page_text') !== "" ) { ?>
			.page404 .content404 p {
				<?php eventstation_type_echo( ot_get_option('404_page_text'), false, '' ); ?>
			}
		<?php } ?>
		<?php if( ot_get_option('404_page_icon') !== "" ) { ?>
			.page404 .content404 .content404-bottom .icon404 {
				<?php eventstation_type_echo( ot_get_option('404_page_icon'), false, '' ); ?>
			}
		<?php } ?>
		/*----- CUSTOM TYPOGRAPHY END -----*/
		
		/*----- CUSTOM COLOR START -----*/
		<?php if( ot_get_option('body_background') !== "" ) { ?>
			body {
				background-color:<?php echo ot_get_option('body_background'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('wrapper_background') !== "" ) { ?>
			.eventstation-wrapper {
				background-color:<?php echo ot_get_option('wrapper_background'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('theme_color_one') !== "" ) { ?>
			.category-post-list article .post-wrapper .post-bottom .post-related .item .desc, .category-post-list article .post-wrapper .post-bottom .post-navigation nav ul li a, .category-post-list article .post-wrapper .post-bottom .post-navigation nav ul li a:visited, .category-post-list article .post-wrapper .post-bottom .page-links span, .category-post-list article .post-wrapper .post-bottom .single-tag-list span, .category-post-list article .post-wrapper .post-bottom .more i, .category-post-list article .post-wrapper .post-bottom .more span, .category-post-list article .post-wrapper .post-image .category, .page404 .content404 .content404-bottom button, .page404 .content404 .content404-bottom .icon404, .eventstation-latest-posts-widget ul li .desc, .widget_tag_cloud a:hover, .widget_tag_cloud a:focus, .widget-box .widget-title h4:before, .post-related h4:before, .comments-area .comment-reply-title h2:before, .comments-area .comment-respond .comment-reply-title h2:before, .schedule-widget .nav-tabs li.active a:after, .schedule-widget .nav-tabs li.active a:visited:after, .schedule-widget .nav-tabs li a:hover:after, .schedule-widget .nav-tabs li a:focus:after, .schedule-widget .nav-tabs li.active a, .schedule-widget .nav-tabs li.active a:visited, .schedule-widget .nav-tabs li a:hover, .schedule-widget .nav-tabs li a:focus, .blog-posts-widget ul li h2:after, .counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-button a i, .counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-button a span, .event-box .event-box-image .event-box-image-wrapper .event-box-image-content-wrapper .event-box-image-content .event-box-button a i, .event-box .event-box-image .event-box-image-wrapper .event-box-image-content-wrapper .event-box-image-content .event-box-button a span, .info-box.info-box-alternative-style .info-box-alternative-style-hover-content-wrapper, .info-box.info-box-alternative-style .info-box-alternative-style-image .info-box-icon i, .info-box.info-box-default-style .info-box-default-style-hover-content-wrapper, .info-box.info-box-default-style .info-box-default-style-image .info-box-default-style-content .readmore i, .info-box.info-box-default-style .info-box-default-style-image .info-box-default-style-content .readmore span, .info-box.info-box-default-style .info-box-default-style-image .info-box-icon i, .pricing-table.pricing-table-modern .pricing-table-bottom .pricing-table-button a i, .pricing-table.pricing-table-modern .pricing-table-bottom .pricing-table-button a span, .pricing-table.pricing-table-modern .pricing-table-body ul li .pricing-list-icon i, .pricing-table.pricing-table-modern .pricing-table-header .pricing-table-header-left:before, .map-3d-tour .map-3d-tour-iframe .map-3d-tour-music-button i:hover, .map-3d-tour .map-3d-tour-iframe .map-3d-tour-music-button i:focus, .map-3d-tour .map-3d-tour-iframe .close:hover, .map-3d-tour .map-3d-tour-iframe .close:focus, .map-3d-tour .map-3d-tour-content .map-3d-tour-button i, .map-3d-tour .map-3d-tour-content .map-3d-tour-button span, .map-3d-tour .map-3d-tour-content .map-3d-tour-icon, .content-widget-title i, .content-heading, .edit-link a, .edit-link a:visited, .eventstation-pagination>li.eventstation-pagination-nav, .eventstation-pagination>li>a, .eventstation-pagination>li>a:visited, button.alternative-button:hover, input[type="submit"].alternative-button:hover, button.alternative-button:focus, input[type="submit"].alternative-button:focus, button.alternative-button:active, input[type="submit"].alternative-button:active, button.alternative-button:active:hover, input[type="submit"].alternative-button:active:hover, button.alternative-button:active:focus, input[type="submit"].alternative-button:active:focus, button.alternative-button:active:visited, input[type="submit"].alternative-button:active:visited, button, input[type="submit"], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
				background:<?php echo ot_get_option('theme_color_one'); ?>;
			}
			
			.event-box .event-box-image .event-box-image-wrapper .event-box-image-content-wrapper .event-box-image-content .event-box-image-content-date .event-box-image-content-date-center .event-box-image-content-date-days, .counter-box .DateCountdown .time_circles > div h4, .counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-general-content-date .counter-box-general-content-date-center .counter-box-general-content-date-days, .counter-box .DateCountdown .time_circles > div, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce ul.products li.product .price, .post-social-share ul li a:hover i, .post-social-share ul li a:focus i, .category-post-list article .post-wrapper .post-bottom .post-navigation nav ul li a:hover, .category-post-list article .post-wrapper .post-bottom .post-navigation nav ul li a:focus, .category-post-list article .post-wrapper .post-bottom .page-links span:hover a, .category-post-list article .post-wrapper .post-bottom .page-links span:hover a:visited, .category-post-list article .post-wrapper .post-bottom .page-links span:focus a, .category-post-list article .post-wrapper .post-bottom .page-links span:focus a:visited, .category-post-list article .post-wrapper .post-bottom .page-links span:hover, .category-post-list article .post-wrapper .post-bottom .single-tag-list span:hover a, .category-post-list article .post-wrapper .post-bottom .single-tag-list span:hover a:visited, .category-post-list article .post-wrapper .post-bottom .single-tag-list span:focus a, .category-post-list article .post-wrapper .post-bottom .single-tag-list span:focus a:visited, .category-post-list article .post-wrapper .post-header h2 a, .category-post-list article .post-wrapper .post-header h2 a:visited, .category-post-list article .post-wrapper .post-header h2, .page-content article .page-header h2, .page404 .content404 .content404-bottom button:hover, .page404 .content404 .content404-bottom button:focus, .page404 .content404 h2, .footer.footer-alternative .footer-newsletter input[type="submit"]:hover, .footer.footer-alternative .footer-newsletter input[type="submit"]:focus, .widget_pages ul li a:focus, .widget_pages ul li a:hover, .widget_categories ul li a:focus, .widget_categories ul li a:hover, .widget_recent_comments ul li a:focus, .widget_recent_comments ul li a:hover, .widget_archive ul li a:focus, .widget_archive ul li a:hover, .widget_recent_entries ul li a:focus, .widget_recent_entries ul li a:hover, .widget_nav_menu ul li a:focus, .widget_nav_menu ul li a:hover, .widget_rss ul li a:focus, .widget_rss ul li a:hover, .widget_meta ul li a:focus, .widget_meta ul li a:hover, .widget-title h4, .post-related h4, .comments-area .comment-reply-title h2, .comments-area .comment-respond .comment-reply-title h2, .eventstation-tab.vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active>a, .vc_tta-color-white.vc_tta-style-modern.eventstation-tab .vc_tta-tab>a:hover, .vc_tta-color-white.vc_tta-style-modern.eventstation-tab .vc_tta-tab>a:focus, .schedule-widget.style2 .nav-tabs li.active a span, .schedule-widget.style2 .nav-tabs li.active a:visited span, .schedule-widget.style2 .nav-tabs li a:hover span, .schedule-widget.style2 .nav-tabs li a:focus span, .schedule-widget.style2 .nav-tabs li.active a h3, .schedule-widget.style2 .nav-tabs li.active a:visited h3, .schedule-widget.style2 .nav-tabs li a:hover h3, .schedule-widget.style2 .nav-tabs li a:focus h3, .schedule-widget.style2 .nav-tabs li.active a, .schedule-widget.style2 .nav-tabs li.active a:visited, .schedule-widget.style2 .nav-tabs li a:hover, .schedule-widget.style2 .nav-tabs li a:focus, .schedule-widget.style3 .tab-content .tab-content-schedule-list li .hour, .schedule-widget.style3 .nav-tabs li.active a span, .schedule-widget.style3 .nav-tabs li.active a:visited span, .schedule-widget.style3 .nav-tabs li a:hover span, .schedule-widget.style3 .nav-tabs li a:focus span, .schedule-widget.style3 .nav-tabs li.active a h3, .schedule-widget.style3 .nav-tabs li.active a:visited h3, .schedule-widget.style3 .nav-tabs li a:hover h3, .schedule-widget.style3 .nav-tabs li a:focus h3, .blog-posts-widget ul li a.more, .blog-posts-widget ul li a.more:visited, .blog-posts-widget ul li h2 a, .blog-posts-widget ul li h2 a:visited, .counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-button a:hover span, .counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-button a:focus span, .counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-button a:hover i, .counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-button a:focus i, .event-box .event-box-image .event-box-image-wrapper .event-box-image-content-wrapper .event-box-image-content .event-box-button a:hover, .event-box .event-box-image .event-box-image-wrapper .event-box-image-content-wrapper .event-box-image-content .event-box-button a:focus, .info-box.info-box-alternative-style .info-box-alternative-style-hover-content-wrapper .info-box-alternative-style-hover-content .info-box-close-icon, .info-box.info-box-alternative-style .info-box-alternative-style-hover-content-wrapper .info-box-alternative-style-hover-content i, .info-box.info-box-alternative-style .info-box-alternative-style-content .readmore, .info-box.info-box-default-style .info-box-default-style-hover-content-wrapper .info-box-default-style-hover-content .info-box-close-icon, .info-box.info-box-default-style .info-box-default-style-hover-content-wrapper .info-box-default-style-hover-content i, .service-box.service-box-icon-style h2, .speakers-widget .speaker-item-body .speaker-item-social-links li a:hover, .speakers-widget .speaker-item-body .speaker-item-social-links li a:focus, .pricing-table.pricing-table-classic .pricing-table-bottom .pricing-table-button a:hover, .pricing-table.pricing-table-classic .pricing-table-bottom .pricing-table-button a:focus, .pricing-table.pricing-table-classic .pricing-table-body ul li .pricing-list-icon i, .pricing-table.pricing-table-classic .pricing-table-header-wrapper .pricing-table-header, .map-3d-tour .map-3d-tour-iframe .map-3d-tour-music-button i, .map-3d-tour .map-3d-tour-iframe .close, .social-media-widget.social-media-white ul li a:hover, .social-media-widget.social-media-white ul li a:focus, .content-widget-title.small i, .content-heading .heading-navigation i, .edit-link a:focus,  .edit-link a:hover, .eventstation-pagination>li>a:hover, .eventstation-pagination>li>a:focus, button:hover, input[type="submit"]:hover, button:active, input[type="submit"]:active, button:active:hover, input[type="submit"]:active:hover, button:active:focus, input[type="submit"]:active:focus, button:active:visited, input[type="submit"]:active:visited, button:focus, input[type="submit"]:focus, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, a:hover, a:focus {
				color:<?php echo ot_get_option('theme_color_one'); ?>;
			}
			
			.post-social-share ul li a:hover, .post-social-share ul li a:focus, .category-post-list article .post-wrapper .post-bottom .post-navigation nav ul li a:hover, .category-post-list article .post-wrapper .post-bottom .post-navigation nav ul li a:focus, .category-post-list article .post-wrapper .post-bottom .page-links span:hover, .category-post-list article .post-wrapper .post-bottom .single-tag-list span:hover, .page404 .content404 .content404-bottom button:hover, .page404 .content404 .content404-bottom button:focus, .page404 .content404 .content404-bottom button, .widget_tag_cloud a:hover, .widget_tag_cloud a:focus, .eventstation-tab.vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-top .vc_tta-tab.vc_active>a, .vc_tta-color-white.vc_tta-style-modern.eventstation-tab .vc_tta-tab>a:hover, .vc_tta-color-white.vc_tta-style-modern.eventstation-tab .vc_tta-tab>a:focus, .schedule-widget.style3 .tab-content .tab-content-schedule-list li .hour, .pricing-table.pricing-table-classic .pricing-table-bottom .pricing-table-button a:hover .separator, .pricing-table.pricing-table-classic .pricing-table-bottom .pricing-table-button a:focus .separator, .edit-link a:focus,  .edit-link a:hover, .eventstation-pagination>li>a:hover, .eventstation-pagination>li>a:focus, button.alternative-button:hover, input[type="submit"].alternative-button:hover, button.alternative-button:focus, input[type="submit"].alternative-button:focus, button.alternative-button:active, input[type="submit"].alternative-button:active, button.alternative-button:active:hover, input[type="submit"].alternative-button:active:hover, button.alternative-button:active:focus, input[type="submit"].alternative-button:active:focus, button.alternative-button:active:visited, input[type="submit"].alternative-button:active:visited, button:hover, input[type="submit"]:hover, button:active, input[type="submit"]:active, button:active:hover, input[type="submit"]:active:hover, button:active:focus, input[type="submit"]:active:focus, button:active:visited, input[type="submit"]:active:visited, button:focus, input[type="submit"]:focus, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, button, input[type="submit"], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
				border-color:<?php echo ot_get_option('theme_color_one'); ?>;
			}
			
			.counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-button a:hover span, .counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-button a:focus span, .counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-button a:hover i, .counter-box .counter-box-general-wrapper .counter-box-general-content-wrapper .counter-box-general-content .counter-box-button a:focus i {
				border-left-color:<?php echo ot_get_option('theme_color_one'); ?>;
			}
			
			.counter-box .DateCountdown .time_circles > div:after,.pricing-table.pricing-table-classic .pricing-table-header-wrapper .pricing-table-header .separator {
				border-right-color:<?php echo ot_get_option('theme_color_one'); ?>;
			}
			
			.header-wrapper .header .dropdown-menu {
				border-top-color:<?php echo ot_get_option('theme_color_one'); ?>;
			}
			
			.woocommerce span.onsale, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce .widget_price_filter .ui-slider .ui-slider-range {
				background-color:<?php echo ot_get_option('theme_color_one'); ?>;
			}
			
			@media (min-width: 768px) {
				.header-wrapper .header .menu-area .navbar-nav li .dropdown-menu li a:focus, .header-wrapper .header .menu-area .navbar-nav li .dropdown-menu li a:hover, .header-wrapper.header-alternative.fixed-header .menu-area .navbar-nav>li>a:focus, .header-wrapper.header-alternative.fixed-header .menu-area .navbar-nav>li>a:hover {
					color:<?php echo ot_get_option('theme_color_one'); ?>;
				}
				
				.header-wrapper.header-default .header .navbar-toggle .icon-bar, .header-wrapper.fixed-header .header .navbar-toggle .icon-bar {
					background:<?php echo ot_get_option('theme_color_one'); ?>;
				}
			}

			.schedule-widget.style3 .nav-tabs li a, .schedule-widget.style3 .nav-tabs li a:visited {
				background: transparent;
				color: #FFFFFF;
			}
			
			.eventstation-pagination>li>a:hover, .eventstation-pagination>li>a:focus {
				background: #FFFFFF;
			}

			.edit-link a:focus, .edit-link a:hover {
				background: #FFF;
			}
		<?php } ?>
		<?php if( ot_get_option('theme_color_two') !== "" ) { ?>
			.info-box.info-box-default-style .info-box-default-style-image .info-box-default-style-content .readmore:hover span, .info-box.info-box-default-style .info-box-default-style-image .info-box-default-style-content .readmore:focus span, .info-box.info-box-default-style .info-box-default-style-image .info-box-default-style-content .readmore:hover i:after, .info-box.info-box-default-style .info-box-default-style-image .info-box-default-style-content .readmore:focus i:after, .pricing-table.pricing-table-modern .pricing-table-bottom .pricing-table-button a:hover span, .pricing-table.pricing-table-modern .pricing-table-bottom .pricing-table-button a:focus span, .pricing-table.pricing-table-modern .pricing-table-bottom .pricing-table-button a:hover i:after, .pricing-table.pricing-table-modern .pricing-table-bottom .pricing-table-button a:focus i:after, .map-3d-tour .map-3d-tour-content .map-3d-tour-button:hover i:after, .map-3d-tour .map-3d-tour-content .map-3d-tour-button:focus i:after, .map-3d-tour .map-3d-tour-content .map-3d-tour-button:hover span, .map-3d-tour .map-3d-tour-content .map-3d-tour-button:focus span {
				border-top-color:<?php echo ot_get_option('theme_color_two'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('theme_color_three') !== "" ) { ?>
			.info-box.info-box-default-style .info-box-default-style-image .info-box-default-style-content .readmore:hover span, .info-box.info-box-default-style .info-box-default-style-image .info-box-default-style-content .readmore:focus span, .info-box.info-box-default-style .info-box-default-style-image .info-box-default-style-content .readmore:hover i, .info-box.info-box-default-style .info-box-default-style-image .info-box-default-style-content .readmore:focus i, .pricing-table.pricing-table-modern .pricing-table-bottom .pricing-table-button a:hover span, .pricing-table.pricing-table-modern .pricing-table-bottom .pricing-table-button a:focus span, .pricing-table.pricing-table-modern .pricing-table-bottom .pricing-table-button a:hover i, .pricing-table.pricing-table-modern .pricing-table-bottom .pricing-table-button a:focus i, .map-3d-tour .map-3d-tour-content .map-3d-tour-button:hover i, .map-3d-tour .map-3d-tour-content .map-3d-tour-button:focus i, .map-3d-tour .map-3d-tour-content .map-3d-tour-button:hover span, .map-3d-tour .map-3d-tour-content .map-3d-tour-button:focus span {
				background:<?php echo ot_get_option('theme_color_three'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('theme_color_four') !== "" ) { ?>
			.service-box.service-box-image-style .service-box-image-style-hover-content-wrapper , .service-box.service-box-image-style .service-box-image-style-image .service-box-image-style-more, .service-box.service-box-image-style .service-box-image-style-content i  {
				background:<?php echo ot_get_option('theme_color_four'); ?>;
			}
			
			.service-box.service-box-image-style .service-box-image-style-hover-content-wrapper .service-box-image-style-hover-content .service-box-close-icon, .service-box.service-box-image-style .service-box-image-style-hover-content-wrapper .service-box-image-style-hover-content i, .service-box.service-box-image-style .service-box-image-style-image .service-box-image-style-more:hover, .service-box.service-box-image-style .service-box-image-style-image .service-box-image-style-more:focus, .service-box.service-box-icon-style .service-box-icon {
				color:<?php echo ot_get_option('theme_color_four'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('link_color') !== "" ) { ?>
			a, a:visited {
				color:<?php echo ot_get_option('link_color'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('link_hover_color') !== "" ) { ?>
			a:hover, a:focus {
				color:<?php echo ot_get_option('link_hover_color'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('heading_color') !== "" ) { ?>
			h1, h2, h3, h4, h5, h6 {
				color:<?php echo ot_get_option('heading_color'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('input_border_color') !== "" ) { ?>
			input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], input[type="time"], input[type="week"], input[type="search"], input[type="month"], input[type="datetime"], input[type="date"], textarea, textarea.form-control, select, .woocommerce form .form-row .select2-container .select2-choice, .form-control {
				border-color:<?php echo ot_get_option('input_border_color'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('input_background_color') !== "" ) { ?>
			input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], input[type="time"], input[type="week"], input[type="search"], input[type="month"], input[type="datetime"], input[type="date"], textarea, textarea.form-control, select, .woocommerce form .form-row .select2-container .select2-choice, .form-control {
				background:<?php echo ot_get_option('input_background_color'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('button_background_color') !== "" ) { ?>
			button, input[type="submit"], .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button {
				background:<?php echo ot_get_option('button_background_color'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('button_hover_background_color') !== "" ) { ?>
			button:hover, input[type="submit"]:hover, button:active, input[type="submit"]:active, button:active:hover, input[type="submit"]:active:hover, button:active:focus, input[type="submit"]:active:focus, button:active:visited, input[type="submit"]:active:visited, button:focus, input[type="submit"]:focus, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
				background:<?php echo ot_get_option('button_hover_background_color'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('button_hover_text_color') !== "" ) { ?>
			button:hover, input[type="submit"]:hover, button:active, input[type="submit"]:active, button:active:hover, input[type="submit"]:active:hover, button:active:focus, input[type="submit"]:active:focus, button:active:visited, input[type="submit"]:active:visited, button:focus, input[type="submit"]:focus, .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover {
				color:<?php echo ot_get_option('button_hover_text_color'); ?>;
			}
		<?php } ?>
		<?php if( ot_get_option('header_default_style_background') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-default,
				.header-wrapper.header-alternative.fixed-header {
					background:<?php echo ot_get_option('header_default_style_background'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_default_style_menu_link_color') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-default .menu-area .navbar-nav>li>a, .header-wrapper.header-default .menu-area .navbar-nav>li>a:visited,
				.header-wrapper.header-alternative.fixed-header .menu-area .navbar-nav>li>a, .header-wrapper.header-alternative.fixed-header .menu-area .navbar-nav>li>a:visited {
					color:<?php echo ot_get_option('header_default_style_menu_link_color'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_default_style_menu_link_hover_color') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-default .menu-area .navbar-nav>li>a:hover, .header-wrapper.header-default .menu-area .navbar-nav>li>a:focus,
				.header-wrapper.header-alternative.fixed-header .menu-area .navbar-nav>li>a:hover, .header-wrapper.header-alternative.fixed-header .menu-area .navbar-nav>li>a:focus {
					color:<?php echo ot_get_option('header_default_style_menu_link_hover_color'); ?>;
					border-bottom-color:<?php echo ot_get_option('header_default_style_menu_link_hover_color'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_default_style_submenu_link_color') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-default .header .menu-area .navbar-nav li .dropdown-menu li a, .header-wrapper.header-default .header .menu-area .navbar-nav li .dropdown-menu li a:visited,
				.header-wrapper.header-alternative.fixed-header .header .menu-area .navbar-nav li .dropdown-menu li a, .header-wrapper.header-alternative.fixed-header .header .menu-area .navbar-nav li .dropdown-menu li a:visited {
					color:<?php echo ot_get_option('header_default_style_submenu_link_color'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_default_style_submenu_link_hover_color') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-default .header .menu-area .navbar-nav li .dropdown-menu li a:hover, .header-wrapper.header-default .header .menu-area .navbar-nav li .dropdown-menu li a:focus,
				.header-wrapper.header-alternative.fixed-header .header .menu-area .navbar-nav li .dropdown-menu li a:hover, .header-wrapper.header-alternative.fixed-header .header .menu-area .navbar-nav li .dropdown-menu li a:focus {
					color:<?php echo ot_get_option('header_default_style_submenu_link_hover_color'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_default_style_submenu_background') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-default .header .dropdown-menu,
				.header-wrapper.header-alternative.fixed-header .header .dropdown-menu {
					background:<?php echo ot_get_option('header_default_style_submenu_background'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_alternative_style_background') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-alternative {
					background:<?php echo ot_get_option('header_alternative_style_background'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_alternative_style_menu_link_color') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-alternative .menu-area .navbar-nav>li>a, .header-wrapper.header-alternative .menu-area .navbar-nav>li>a:visited {
					color:<?php echo ot_get_option('header_alternative_style_menu_link_color'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_alternative_style_menu_link_hover_color') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-alternative .menu-area .navbar-nav>li>a:hover, .header-wrapper.header-alternative .menu-area .navbar-nav>li>a:focus {
					color:<?php echo ot_get_option('header_alternative_style_menu_link_hover_color'); ?>;
					border-bottom-color:<?php echo ot_get_option('header_alternative_style_menu_link_hover_color'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_alternative_style_submenu_link_color') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-alternative .menu-area .navbar-nav li .dropdown-menu li a, .header-wrapper.header-alternative .menu-area .navbar-nav li .dropdown-menu li a:visited {
					color:<?php echo ot_get_option('header_alternative_style_submenu_link_color'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_alternative_style_submenu_link_hover_color') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-alternative .menu-area .navbar-nav li .dropdown-menu li a:focus, .header-wrapper.header-alternative .menu-area .navbar-nav li .dropdown-menu li a:hover {
					color:<?php echo ot_get_option('header_alternative_style_submenu_link_hover_color'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_alternative_style_submenu_background') !== "" ) { ?>
			@media (min-width: 768px) {
				.header-wrapper.header-alternative .header .dropdown-menu {
					background:<?php echo ot_get_option('header_alternative_style_submenu_background'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('mobile_menu_default_style_background') !== "" ) { ?>
			@media (max-width: 767px) {
				.header-wrapper.header-default .header .menu-area .navbar-nav li .dropdown-menu,
				.header-wrapper.header-alternative .header .menu-area .navbar-nav li .dropdown-menu,
				.header-wrapper.header-default,
				.header-wrapper.header-default .navbar-collapse,
				.header-wrapper.header-alternative.fixed-header,
				.header-wrapper.header-alternative.fixed-header .navbar-collapse {
					background:<?php echo ot_get_option('mobile_menu_default_style_background'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_default_mobile_menu_menu_link_color') !== "" ) { ?>
			@media (max-width: 767px) {
				.header-wrapper.header-default .header .navbar-nav li .fa.fa-angle-down,
				.header-wrapper.header-default .menu-area .navbar-nav li a,
				.header-wrapper.header-default .menu-area .navbar-nav li a:visited {
					color:<?php echo ot_get_option('header_default_mobile_menu_menu_link_color'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_default_mobile_menu_menu_link_hover_color') !== "" ) { ?>
			@media (max-width: 767px) {
				.header-wrapper.header-default .header .navbar-nav li:hover .fa.fa-angle-down,
				.header-wrapper.header-default .menu-area .navbar-nav li:hover a,
				.header-wrapper.header-default .menu-area .navbar-nav li a:hover,
				.header-wrapper.header-default .menu-area .navbar-nav li a:focus {
					color:<?php echo ot_get_option('header_default_mobile_menu_menu_link_hover_color'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('mobile_menu_alternative_style_background') !== "" ) { ?>
			@media (max-width: 767px) {
				.header-wrapper.header-alternative,
				.header-wrapper.header-alternative .navbar-collapse {
					background:<?php echo ot_get_option('mobile_menu_alternative_style_background'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_default_mobile_menu_menu_link_color') !== "" ) { ?>
			@media (max-width: 767px) {
				.header-wrapper.header-alternative .header .navbar-nav li .fa.fa-angle-down,
				.header-wrapper.header-alternative .menu-area .navbar-nav li a,
				.header-wrapper.header-alternative .menu-area .navbar-nav li a:visited {
					color:<?php echo ot_get_option('header_default_mobile_menu_menu_link_color'); ?>;
				}
			}
		<?php } ?>
		<?php if( ot_get_option('header_default_mobile_menu_menu_link_hover_color') !== "" ) { ?>
			@media (max-width: 767px) {
				.header-wrapper.header-alternative .header .navbar-nav li:hover .fa.fa-angle-down,
				.header-wrapper.header-alternative .menu-area .navbar-nav li:hover a,
				.header-wrapper.header-alternative .menu-area .navbar-nav li a:hover,
				.header-wrapper.header-alternative .menu-area .navbar-nav li a:focus {
					color:<?php echo ot_get_option('header_default_mobile_menu_menu_link_hover_color'); ?>;
				}
			}
		<?php } ?>
		/*----- CUSTOM COLOR END -----*/

		<?php if( ot_get_option('custom_css') !== "" ) { ?>
			/*----- CUSTOM CSS START -----*/
				<?php echo ot_get_option('custom_css'); ?>
			/*----- CUSTOM CSS END -----*/
		<?php } ?>
	</style>
	
	<?php if( ot_get_option('custom_js') !== "" ) { ?>
		<script type="text/javascript">
			<?php echo ot_get_option('custom_js'); ?>
		</script>
	<?php } ?>
<?php 
}
add_action('wp_head', 'eventstation_selection'); ?>