<?php


if(!function_exists('pexeto_get_customizer_options')){
	function pexeto_get_customizer_options(){
		return array(

			array(
				'section_id'=>'general',
				'section_name'=>'General Color Settings',
				'controls'=>array(
					array(
						'id'=>'accent_color',
						'name'=>'Accent Color',
						'type'=>'color',
						'rules'=>array(
							'background-color'=>'button, .button , input[type="submit"], input[type="button"], 
								#submit, .left-arrow:hover,.right-arrow:hover, .ps-left-arrow:hover, 
								.ps-right-arrow:hover, .cs-arrows:hover,.nivo-nextNav:hover, .nivo-prevNav:hover,
								.scroll-to-top:hover, .services-icon .img-container, .services-thumbnail h3:after,
								.pg-pagination a.current, .pg-pagination a:hover, #content-container .wp-pagenavi span.current, 
								#content-container .wp-pagenavi a:hover, #blog-pagination a:hover,
								.pg-item h2:after, .pc-item h2:after, .ps-icon, .ps-left-arrow:hover, .ps-right-arrow:hover,
								.pc-next:hover, .pc-prev:hover, .pc-wrapper .icon-circle, .pg-item .icon-circle, .qg-img .icon-circle,
								.ts-arrow:hover, .section-light .section-title:before, .section-light2 .section-title:after,
								.section-light-bg .section-title:after, .section-dark .section-title:after,
								.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
								.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range, 
								.controlArrow.prev:hover,.controlArrow.next:hover, .pex-woo-cart-num,
								.woocommerce span.onsale, .woocommerce-page span.onsale.woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce-page nav.woocommerce-pagination ul li span.current,
								.woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current,
								.woocommerce #content nav.woocommerce-pagination ul li span.current, .woocommerce-page #content nav.woocommerce-pagination ul li span.current,
								.woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce-page nav.woocommerce-pagination ul li a:hover,
								.woocommerce #content nav.woocommerce-pagination ul li a:hover, .woocommerce-page #content nav.woocommerce-pagination ul li a:hover,
								.woocommerce nav.woocommerce-pagination ul li a:focus, .woocommerce-page nav.woocommerce-pagination ul li a:focus,
								.woocommerce #content nav.woocommerce-pagination ul li a:focus, .woocommerce-page #content nav.woocommerce-pagination ul li a:focus,
								.pt-highlight .pt-title',
							'color'=>'a, a:hover, .post-info a:hover, .read-more, .footer-widgets a:hover, .comment-info .reply,
								.comment-info .reply a, .comment-info, .post-title a:hover, .post-tags a, .format-aside aside a:hover,
								.testimonials-details a, .lp-title a:hover, .woocommerce .star-rating, .woocommerce-page .star-rating,
								.woocommerce .star-rating:before, .woocommerce-page .star-rating:before, .tabs .current a,
								#wp-calendar tbody td a, .widget_nav_menu li.current-menu-item > a, .archive-page a:hover, .woocommerce-MyAccount-navigation li.is-active a',
							'border-color'=>'.accordion-title.current, .read-more, .bypostauthor, .sticky,
								.pg-cat-filter a.current',
							'border-top-color'=>'.pg-element-loading .icon-circle:after'
							),
						'default'=>'#fdd200'
						),
					
						array(
							'name' => 'Body Background Color',
							'id' => 'body_bg',
							'type' => 'color',
							'default' => '#f7f7f7',
							'rules'=>array(
								'background-color'=>'body, .page-wrapper, #sidebar input[type="text"], 
									#sidebar input[type="password"], #sidebar textarea, .comment-respond input[type="text"],
									 .comment-respond textarea'
								)
						),

						array(
							'name' => 'Boxed Layout Body Background color',
							'id' => 'boxed_body_bg',
							'type' => 'color',
							'default' => '#cccccc',
							'rules'=>array(
								'background-color'=>'body'
								)
						)
				)
			),

			array(
				'section_id'=>'header',
				'section_name'=>'Header Color Settings',
				'controls'=>array(
					array(
						'id'=>'header_bg',
						'name'=>'Header Background Color',
						'type'=>'color',
						'rules'=>array(
							'background-color'=>'.header-wrapper, .pg-navigation, .mobile.page-template-template-fullscreen-slider-php #header, .mobile.page-template-template-fullscreen-slider-php .header-wrapper'
							),
						'default'=>'#252525'
						),
					array(
						'id'=>'header_text',
						'name'=>'Header Text Color',
						'type'=>'color',
						'rules'=>array(
							'color' => '.page-title h1, #menu>ul>li>a, #menu>div>ul>li>a, .page-subtitle, 
								.icon-basket:before, .pex-woo-cart-btn:before, .pg-cat-filter a,
								.ps-nav-text, .ps-back-text, .mob-nav-btn, .pg-filter-btn',
							'background-color' => '.page-title h1:after, .nav-menu > ul > li > a:after, 
								.nav-menu > div.menu-ul > ul > li > a:after, .ps-new-loading span'
							),
						'default'=>'#ffffff'
						),
					array(
						'id'=>'sticky_header_bg',
						'name'=>'Sticky Header & Header Overlay Background Color',
						'type'=>'color',
						'rules'=>array(
							'rgba-bg'=>array(
								array('selector'=>'.dark-header #header', 'alpha'=>'0.7'),
								array('selector'=>'.fixed-header-scroll #header', 'alpha'=>'0.95')
								)
							),
						'default'=>'#252525'
						),
					array(
						'id'=>'drop_down_bg',
						'name'=>'Drop-down menus background',
						'type'=>'color',
						'rules'=>array(
							'background-color' => '.nav-menu li.mega-menu-item > ul, .nav-menu ul ul li',
							'rgba-bg' => array(array('selector' => '.mob-nav-menu', 'alpha'=>'0.96'))
							),
						'default'=>'#1e1e1e'
					),
					array(
						'id'=>'drop_down_text',
						'name'=>'Drop-down menus text color',
						'type'=>'color',
						'rules'=>array(
							'color' => '.nav-menu ul ul li a, .nav-menu ul .current-menu-item ul a,
							.nav-menu li:hover ul a, .nav-menu .current-menu-parent ul a, .nav-menu .current-menu-ancestor ul a,
							.nav-menu ul ul li:hover a, .nav-menu .mega-menu-item > ul > li > a:hover, .mob-nav-menu ul li a,
							.mob-nav-arrow'
							),
						'default'=>'#ffffff'
					)
				)
			),
			array(
				'section_id'=>'footer',
				'section_name'=>'Footer Color Settings',
				'controls'=>array(
					array(
						'id'=>'footer_heading',
						'name'=>'Main Footer Styles',
						'type'=>'heading'
						),
					
					array(
						'id'=>'footer_bg',
						'name'=>'Footer Background Color',
						'type'=>'color',
						'default'=>'#252525',
						'rules'=>array(
							'background-color'=>'#footer, #footer input[type=text], #footer input[type=password], 
								#footer textarea, #footer input[type=search]'
							)
						),
					array(
						'id'=>'footer_text',
						'name'=>'Footer Text Color',
						'type'=>'color',
						'default'=>'#ffffff',
						'rules' => array(
							'color'=>'#footer, .footer-box, #footer .footer-widgets .lp-post-info a,
							.footer-box ul li a, .footer-box ul li a:hover, .footer-widgets .lp-title a,
							#footer input[type=text], #footer input[type=password], 
								#footer textarea, #footer input[type=search], .footer-widgets a'
							)
						),

					array(
						'name' => 'Headings Color',
						'id' => 'footer_title_color',
						'default' => '#ffffff',
						'type' => 'color',
						'rules' => array(
							'color'=>'.footer-box .title'
							)
					),

					array(
						'id'=>'footer_cta_heading',
						'name'=>'Footer Call To Action Section',
						'type'=>'heading'
					),

					array(
						'name' => 'Background Color',
						'id' => 'cta_bg_color',
						'default' => '#ffffff',
						'type' => 'color',
						'rules'=>array(
							'background-color'=>'#footer-cta'
							)
					),

					array(
						'name' => 'Text Color',
						'id' => 'cta_color',
						'default' => '#333332',
						'type' => 'color',
						'rules'=>array(
							'color'=>'#footer-cta h5, .footer-cta-disc p'
							)
					),

					array(
						'name' => 'Custom Button Color',
						'id' => 'cta_button_color',
						'type' => 'color',
						'rules'=>array(
							'background-color'=>'#footer-cta .button'
							)
					),

					array(
						'id'=>'footer_cp_heading',
						'name'=>'Footer Copyright Section',
						'type'=>'heading'
					),


					array(
						'name' => 'Background Color',
						'id' => 'footer_copyright_bg',
						'default' => '#1F1F1F',
						'type' => 'color',
						'rules'=>array(
							'background-color'=>'.footer-bottom'
							)
					),

					array(
						'name' => 'Text color',
						'id' => 'footer_copyright_text',
						'type' => 'color',
						'default'=>'#ffffff',
						'rules'=>array(
							'color'=>'.copyrights, .footer-nav li a'
							)
					),

					)
			 ),
			array(
				'section_id'=>'content',
				'section_name'=>'Content Color Settings',
				'controls'=>array(
					array(
						'name' => 'Content Background Color',
						'id' => 'content_bg',
						'type' => 'color',
						'rules'=>array(
							'background-color'=>'.post, .blog .portfolio, .archive .portfolio, .tabs .current a, .page-template-template-full-custom-php .page-wrapper,
							.content-box, .avatar, .comment-box, .search-results .post-content,
							.pg-info, .ps-wrapper, .content input[type="text"], 
							.content input[type="password"], .content textarea, .contact-captcha-container,
							.recaptcha-input-wrap, .pg-pagination a, #content-container .wp-pagenavi a, 
							#content-container .wp-pagenavi span, #blog-pagination a, 
							.woocommerce .pexeto-woo-columns-3 ul.products li.product, .woocommerce-page .pexeto-woo-columns-3 ul.products li.product,
							.woocommerce .pexeto-woo-columns-4 ul.products li.product, .woocommerce-page .pexeto-woo-columns-4 ul.products li.product,
							.woocommerce ul.cart_list li img, .woocommerce-page ul.cart_list li img, .woocommerce ul.product_list_widget li img, 
							.woocommerce-page ul.product_list_widget li img'
							),
						'default' => '#ffffff'
					),


					array(
						'name' => 'Content Text Color',
						'id' => 'body_color',
						'type' => 'color',
						'rules'=>array(
							'color'=>'.content, .services-title-box, .post, .tabs .current a, .page-template-template-full-custom-php .page-wrapper,
								.content-box, .avatar, .comment-box, .search-results .post-content,
								.pg-info, .ps-wrapper, .content input[type="text"], .post-info, .comment-date,
								.content input[type="password"], .content textarea, .contact-captcha-container,
								.pg-categories, .pg-pagination a, #content-container .wp-pagenavi a, 
								#content-container .wp-pagenavi span, #blog-pagination a, .woocommerce-page #content-container a.button.add_to_cart_button:before,
								.ps-categories, .archive-page a, .woocommerce-MyAccount-navigation li a',
							'border-color'=>'.woocommerce #content-container a.button.add_to_cart_button, .woocommerce-page #content-container a.button.add_to_cart_button'
							),
						'default' => '#777777'
					),

					array(
						'name' => 'Headings Color',
						'id' => 'heading_color',
						'default' => '#333332',
						'type' => 'color',
						'rules'=>array(
							'color'=>'.content h1,.content h2,.content h3,.content h4,.content h5,
							.content h6, h1.page-heading, .post h1, 
							h2.post-title a, .content-box h2, #portfolio-categories ul li,
							.item-desc h4 a, .item-desc h4, .content table th, 
							.post-title, .archive-page h2, .page-heading, .ps-title,
							.tabs a '
							)),

					array(
						'name' => 'Secondary elements background',
						'id' => 'secondary_color',
						'type' => 'color',
						'rules'=>array(
							'background-color'=>'.tabs-container > ul li a, .accordion-title, .recaptcha-input-wrap,
								.post-tags a, .ps-loading, .woocommerce #payment, .woocommerce-page #payment,
								.pt-price-box, .pexeto-related-posts .rp-no-header',
							'border-color'=>'.widget_nav_menu ul ul, .widget_categories ul ul, .widget_nav_menu ul ul li, 
								.widget_categories ul ul li, .archive-page ul, #not-found h1, .tabs-container > ul li a',
							'color'=>'#not-found h1'
							),
						'default' => '#F7F7F7',
						'desc' => 'This is the secondary content color, used in some elements,
						such as tabs and accordion'
						),

					array(
						'name' => 'Secondary elements text color',
						'id' => 'secondary_text_color',
						'type' => 'color',
						'rules'=>array(
							'color'=>'.pt-price-box, .pt-price, .tabs-container > ul li a, .accordion-title, .recaptcha-input-wrap,
								.post-tags a, .ps-loading, .woocommerce #payment, .woocommerce-page #payment,
								.pt-price-box, .pexeto-related-posts .rp-no-header h3'
							),
						'default' => '#777777',
						'desc' => 'This is the secondary content text color, used in widgets 
							(tabs, accordion), etc.'
					),

					array(
						'name' => 'Lines and borders color',
						'id' => 'border_color',
						'type' => 'color',
						'default' => '#e3e3e3',
						'rules'=>array(
							'border-color'=>'blockquote, .content input[type=text], .content input[type=password], 
							.content textarea, .content input[type=search], .content table th, .content table tr,
							.content table thead, .content .table-bordered, .tabs-container > ul,
							.tabs .current a, .tabs-container .panes, .accordion-title, .avatar,
							.contact-captcha-container, .recaptcha-input-wrap, .pc-header, .rp-list ul, 
							.rp-list li, .archive-page ul, .page-heading, .woocommerce #payment div.form-row, 
							.woocommerce-page #payment div.form-row, .woocommerce #reviews #comments ol.commentlist li .comment-text, 
							.woocommerce-page #reviews #comments ol.commentlist li .comment-text,
							.woocommerce-tabs #commentform textarea, .woocommerce-MyAccount-navigation li'
							)
						)
				 )
			),

			array(
			'section_id'=>'side_content',
			'section_name'=>'Side Content Color Settings',
			'description'=>'These settings are applied to all the side content
			elements that are not located within the boxed content section, such as sidebars
			and comments section.',
			'controls'=>array(
					array(
						'name' => 'Text Color',
						'id' => 'side_color',
						'type' => 'color',
						'rules'=>array(
							'color'=>'.sidebar, .sidebar a, .widget_categories li a, .widget_nav_menu li a, 
								.widget_archive li a, .widget_links li a, .widget_recent_entries li a, 
								.widget_links li a, .widget_pages li a, .widget_recent_entries li a, 
								.recentcomments, .widget_meta li a, .sidebar input[type=text], .sidebar input[type=password], 
								.sidebar textarea, .sidebar input[type=search], .sidebar-box .recentcomments a,
								.comment-form, .comment-form input[type=text], .comment-form textarea,
								.pg-cat-filter a, .pg-cat-filter a.current, .pg-cat-filter li:after,
								.ps-nav-text, .ps-icon, .product-categories li a, .woocommerce ul.cart_list li a, .woocommerce-page ul.cart_list li a, 
								.woocommerce ul.product_list_widget li a, .woocommerce-page ul.product_list_widget li a,
								.woocommerce .woocommerce-result-count, .woocommerce-page .woocommerce-result-count'
							),
						'default' => '#777777'
					),

						array(
						'name' => 'Headings Color',
						'id' => 'side_heading_color',
						'default' => '#333332',
						'rules'=>array(
							'color'=>'.sidebar h1,.sidebar h2,.sidebar h3,.sidebar h4,.sidebar h5,
								.sidebar h6, .sidebar h1 a,.sidebar h2 a,.sidebar h3 a,.sidebar h4 a,.sidebar h5 a,
								.sidebar h6 a, .sidebar-post-wrapper h6 a, #comments h3, #portfolio-slider .pc-header h4,
								#comments h4, #portfolio-gallery .pc-header h4, .tax-product_cat.woocommerce .content-box>h1,
								.tax-product_tag.woocommerce .content-box>h1'
							),
						'type' => 'color'
					),

					array(
						'name' => 'Lines and Borders Color',
						'id' => 'side_border_color',
						'default' => '#e5e5e5',
						'rules'=>array(
							'border-color'=>'.sidebar blockquote, .sidebar input[type=text], .sidebar input[type=password], 
								.sidebar textarea, .sidebar input[type=search], .sidebar table th, .sidebar table tr,
								.sidebar table thead, .sidebar .table-bordered, .lp-wrapper, .widget_categories li, 
								.widget_nav_menu li, .widget_archive li, .widget_links li, .widget_recent_entries li, 
								.widget_pages li, #recentcomments li, .widget_meta li, .widget_rss li,
								.comment-form input[type=text], .comment-form textarea, .comments-titile, #reply-title,
								#portfolio-slider .pc-header, #wp-calendar caption, #portfolio-gallery .pc-header,
								.widget_nav_menu ul ul li, .widget_categories ul ul li, .widget_nav_menu ul ul, 
								.widget_categories ul ul, .sidebar .product-categories li,  .sidebar ul.product_list_widget li'
							),
						'type' => 'color'
					)
				)
			)

		);
	}
}