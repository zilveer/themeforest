<?php function ocmx_theme_options(){
	global $obox_meta, $theme_options, $obox_themeid, $customizer_options;

	$theme_options = array();
	$theme_options["general_site_options"] =
			array(
				array(
					"label" => "Custom Logo",
					"description" => "Full URL or folder path to your custom logo.",
					"name" => "ocmx_custom_logo",
					"default" => "",
					"id" => "upload_button",
					"input_type" => "file",
					"args" => array(
							"width" => 90,
							"height" => 75
						)
					),
				array(
					"label" => "Favicon",
					"description" => "Select a favicon for your site",
					"name" => "ocmx_custom_favicon",
					"default" => "",
					"id" => "upload_button_favicon",
					"input_type" => "file",
					"sub_title" => "favicon",
					"args" => array(
							"width" => 16,
							"height" => 16
						)
					),
				array(
					"main_section" => "Site Header",
					"main_description" => "",
					"sub_elements" => array(
							array(
								"label" => "Display Title",
								"description" => "To modify your title and tagline go to the <a href=\"".admin_url('options-general.php')."\" target=\"_blank\">Settings &rarr; General</a> area in WordPress.",
								"name" => "ocmx_display_site_title",
								"default" => "yes",
								"id" => "ocmx_display_site_title",
								"input_type" => 'select', 'options' => array('Yes' => 'yes', 'No' => 'no')
							),
							array(
								"label" => "Display Tagline",
								"description" => "To modify your title and tagline go to the <a href=\"".admin_url('options-general.php')."\" target=\"_blank\">Settings &rarr; General</a> area in WordPress.",
								"name" => "ocmx_display_site_tagline",
								"default" => "yes",
								"id" => "ocmx_display_site_tagline",
								"input_type" => 'select', 'options' => array('Yes' => 'yes', 'No' => 'no')
							),
							array(
								"label" => "Menu Style",
								"description" => "Select whether to display an expanded or compact menu.",
								"name" => "ocmx_menu_style",
								"default" => "yes",
								"id" => "ocmx_menu_style",
								"input_type" => 'select', 'options' => array('Compact' => 'compact', 'Expanded' => 'expanded')
							),
							array(
								"label" => "Menu Label",
								"description" => "","name" => "ocmx_menu_button_label",
								"default" => "Menu",
								"id" => "ocmx_menu_button_label",
								"input_type" => "text"
							)
						)
					),
				array(
					"main_section" => "Show Excerpts?",
					"main_description" => "Select whether to show post excerpts in your archives/ blog list.",
					"sub_elements" => array(
							array(
								"label" => "Content Length",
								"description" => "Choose whether to show your Excerpt or teaser text in the post blocks.",
								"name" => "ocmx_show_excerpts",
								"default" => "yes",
								"id" => "ocmx_show_excerpts",
								"input_type" => 'select', 'options' => array('Show Excerpts' => 'yes', 'Hide Excerpts' => 'no')
							)
						 )
				),
				array(
					"main_section" => "Post Meta",
					"main_description" => "These settings control which post meta is displayed in posts.",
					"sub_elements" => array(
							array(
								"label" => "Date",
								"description" => "Uncheck to hide the dates in posts.","name" => "ocmx_meta_date",
								"name" => "ocmx_meta_date",
								"default" => "true",
								"id" => "ocmx_meta_date",
								"input_type" => "checkbox"
							),
							array(
								"label" => "Tags",
								"description" => "Uncheck to hide the tags in posts",
								"name" => "ocmx_meta_tags",
								"default" => "false",
								"id" => "ocmx_meta_tags",
								"input_type" => "checkbox"
							),
							array(
								"label" => "Category Link",
								"description" => "Uncheck to hide the category link in posts.",
								"name" => "ocmx_meta_category",
								"default" => "true",
								"id" => "ocmx_meta_category",
								"input_type" => "checkbox"
							),
							array(
								"label" => "Author Link",
								"description" => "Uncheck to hide the author link in posts.",
								"name" => "ocmx_meta_author",
								"default" => "true",
								"id" => "ocmx_meta_author",
								"input_type" => "checkbox"
							),
							array(
								"label" => "Author Info",
								"description" => "Uncheck to hide the author info at the bottom of posts.",
								"name" => "ocmx_meta_author_block",
								"default" => "true",
								"id" => "ocmx_meta_author_block",
								"input_type" => "checkbox"
							),
							array(
								"label" => "Next &amp; Previous Links",
								"description" => "Uncheck to hide the post navigation in posts.",
								"name" => "ocmx_meta_post_links",
								"default" => "true",
								"id" => "ocmx_meta_post_links",
								"input_type" => "checkbox"
							),
							array(
								"label" => "Related Posts",
								"description" => "Uncheck to hide the related posts in posts.",
								"name" => "ocmx_meta_further_reading",
								"default" => "true",
								"id" => "ocmx_meta_further_reading",
								"input_type" => "checkbox"
							),
						)
					),
				array(
					"main_section" => "Page Meta",
					"main_description" => "These settings control which meta is displayed in pages.",
					"sub_elements" => array(
							array(
								"label" => "Date",
								"description" => "Uncheck to hide the dates in pages.","name" => "ocmx_meta_date",
								"name" => "ocmx_meta_date_page",
								"default" => "true",
								"id" => "ocmx_meta_date_page",
								"input_type" => "checkbox"
							),
							array(
								"label" => "Author Link",
								"description" => "Uncheck to hide the author link in pages.",
								"name" => "ocmx_meta_author_page",
								"default" => "true",
								"id" => "ocmx_page_meta_author_page",
								"input_type" => "checkbox"
							),
							array(
								"label" => "Author Info",
								"description" => "Uncheck to hide the author info at the bottom of pages.",
								"name" => "ocmx_meta_author_block_page",
								"default" => "true",
								"id" => "ocmx_meta_author_block_page",
								"input_type" => "checkbox"
							),
						)
					),
					array(
					"main_section" => "Press Trends Analytics",
					"main_description" => "Select Yes Opt out. No personal data is collected.",
					"sub_elements" => array(
							array(
								"label" => "Disable Press Trends?",
								"description" => "PressTrends helps Obox build better themes and provide awesome support by retrieving aggregated stats. PressTrends also provides a <a href='http://wordpress.org/extend/plugins/presstrends/' title='PressTrends Plugin for WordPress' target='_blank'>plugin for you</a> that delivers stats on how your site is performing against similar sites like yours. <a href='http://www.presstrends.me' title='PressTrends' target='_blank'>Learn more…</a>","name" => "ocmx_disable_press_trends",
								"default" => "no",
								"id" => "ocmx_disable_press_trends",
								"input_type" => 'select', 'options' => array('Yes' => 'yes', 'No' => 'no')
							)
						 )
					 ),
			);

	$theme_options["custom_options"] = array(
				array(
					"label" => "Custom RSS URL",
					"description" => "Paste the URL to your custom RSS feed, such as Feedburner.",
					"name" => "ocmx_rss_url",
					"default" => "",
					"id" => "",
					"input_type" => "text"
					),
				array(
					"main_section" => "Custom Styling",
					"main_description" => "Use these fields to store custom styling for fonts and elements.",
					"sub_elements" => array(
							array(
								"label" => "Custom CSS",
								"description" => "Enter changed classes from the theme stylesheet, or any custom CSS here.",
								"name" => "ocmx_custom_css",
								"default" => ".example { color: #F00; } //Add your own below this line",
								"id" => "ocmx_custom_css",
								"input_type" => "memo"
							),
							array(
								"label" => "Custom Typekit Scripts",
								"description" => "Add Typekit fonts to your theme by copy/pasting the typekit script here, then add the CSS to the above Custom CSS box.",
								"name" => "ocmx_typekit",
								"default" => "",
								"id" => "ocmx_typekit"	,
								"input_type" => "memo"
							),
						)
					)
			);

	$theme_options["footer_options"] = array(
				array(
					"label" => "Show Footer?",
					"description" => "Show the footer by default.",
					"name" => "ocmx_show_footer",
					"default" => "yes",
					"id" => "ocmx_show_footer",
					"input_type" => 'select',
					"options" => array('Yes' => 'true', 'No' => 'false')
				),
				array(
					"label" => "Custom Footer Text",
					"description" => "",
					"name" => "ocmx_custom_footer",
					"default" => "Copyright ".date("Y")." The Writer was created in WordPress by Obox Themes."	, "id" => "ocmx_custom_footer",
					"input_type" => "memo"
				),
				array(
					"label" => "Hide Obox Logo",
					"description" => "Hide the Obox Logo from the footer.",
					"name" => "ocmx_logo_hide", "default" => "false",
					"id" => "ocmx_logo_hide",
					"input_type" => 'select',
					"options" => array('Yes' => 'true', 'No' => 'false')
				),

				array(
					"label" => "Site Analytics",
					"description" => "Enter in the Google Analytics Script here.",
					"name" => "ocmx_google_analytics",
					"default" => "",
					"id" => "ocmx_google_analytics",
					"input_type" => "memo"
				)
			);

	$theme_options["post_social_options"] = array(
				array(
					"main_section" => "Social Sharing",
					"main_description" => "Toggle social sharing to Facebook, Twitter and Google+.",
					"sub_elements" => array(
							array(
								"label" => "Show Social Sharing on Posts?",
								"description" => "",
								"name" => "ocmx_meta_social",
								"default" => "true",
								"id" => "ocmx_meta_social",
								"input_type" => 'select',
								"options" => array('Yes' => 'true', 'No' => 'false')
							),
							array(
								"label" => "Show Social Sharing on Pages?",
								"description" => "",
								"name" => "ocmx_meta_social_page",
								"default" => "true",
								"id" => "ocmx_meta_social_page",
								"input_type" => 'select',
								"options" => array('Yes' => 'true', 'No' => 'false')
							),
							array(
								"label" => "Social Widget Code",
								"description" => "Paste the template tag or code for your social sharing plugin here.",
								"name" => "ocmx_social_tag",
								"default" => "",
								"id" => "",
								"input_type" => "memo"),
						)
					),
				array(
					"main_section" => "Facebook Sharing Options",
					"main_description" => "Set a default image URL to appear on Facebook shares if no featured image is found. Recommended size 200x200.",
					"sub_elements" => array(
							array(
								"label" => "Disable OpenGraph?",
								"description" => "Select No if you want to disable the theme's OpenGraph support(do this only if using a conflicting plugin)",
								"name" => "ocmx_open_graph",
								"default" => "no",
								"id" => "ocmx_open_graph",
								"input_type" => 'select', 'options' => array('Yes' => 'yes', 'No' => 'no')
							),
							array(
								"label" => "Image URL",
								"description" => "",
								"name" => "ocmx_site_thumbnail",
								"sub_title" => "Open Graph image",
								"default" => "",
								"id" => "upload_button_ocmx_site_thumbnail",
								"input_type" => "file",
								"args" => array( "width" => 80, "height" => 200)
							)
						)
				)
			);

	$customizer_options[] = array(
			'section_title' => 'Header Color Scheme',
			'section_slug' => 'header_color_scheme',
			'elements' => array(
					array(
						'slug' => 'ocmx_header_container_background_color',
						'label' => 'Header Container',
						'default' => '#000',
						'selectors' => '#header-container',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_header_title_color',
						'label' => 'Header Title',
						'default' => '#fff',
						'selectors' => '.logo, .logo a',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_header_tagline_color',
						'label' => 'Header Tagline',
						'default' => '#777',
						'selectors' => '.logo .tagline',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_sidebar_toggle',
						'label' => 'Menu Switch',
						'default' => '#777',
						'selectors' => '#menu-drop-button',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),

				),
		);

	$customizer_options[] = array(
			'section_title' => 'Sidebar Color Scheme',
			'section_slug' => 'sidebar_color_scheme',
			'elements' => array(
					array(
						'slug' => 'ocmx_sidebar_container_background_color',
						'label' => 'Sidebar Container',
						'default' => '#000',
						'selectors' => '#sidebar-container',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_menu_font_color',
						'label' => 'Menu Links',
						'default' => '#888',
						'selectors' => 'ul#nav li a',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_menu_font_hover_color',
						'label' => 'Menu Links Hover',
						'default' => '#fff',
						'selectors' => 'ul#nav li a:hover, ul#nav ul.sub-menu li a:hover, ul#nav .children li a:hover',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_sidebar_header_font_color',
						'label' => 'Widget Titles',
						'default' => '#ccc',
						'selectors' => '.widgettitle, .widgettitle a, .section-title, .section-title a',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_sidebar_content_font_color',
						'label' => 'Widget Content',
						'default' => '#777',
						'selectors' => '.widget .content',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_sidebar_link_font_color',
						'label' => 'Links',
						'default' => '#888',
						'selectors' => '#sidebar-container .widget a, ul#nav ul.sub-menu li a, ul#nav .children li a',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_sidebar_link_font_hover_color',
						'label' => 'Links Hover',
						'default' => '#fff',
						'selectors' => '#sidebar-container .widget a:hover',
						'css'	=> 'color',
						'jquery'	=> 'color'
					)
				),
		);

	$customizer_options[] = array(
			'section_title' => 'List Pages Color Scheme',
			'section_slug' => 'list_pages_color_scheme',
			'elements' => array(
					array(
						'slug' => 'ocmx_content_container_background_color',
						'label' => 'Content Container Background',
						'default' => '#f0f0f0',
						'selectors' => '.post-list, .home #content-container, .archive #content-container',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_section_title_background_color',
						'label' => 'Section Title Background',
						'default' => '#e74c3c',
						'selectors' => '.category-title-container, .author-title-container',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_section_title_fot_color',
						'label' => 'Section Title Text',
						'default' => '#fff',
						'selectors' => '.author-title-container .author-body .author-name, .category-title-container .category-title, .category-title-container p',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_post_list_background',
						'label' => 'Block Backgrounds',
						'default' => '#fff',
						'selectors' => '.post-list .book-cover',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_post_list_title_font_color',
						'label' => 'Post Titles &amp; Meta',
						'default' => '#595959',
						'selectors' => '.post-list .book-cover .post-title a, .post-list .book-cover .post-author',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_post_list_excerpt_font_color',
						'label' => 'Post Excerpts',
						'default' => '#fff',
						'selectors' => '.post-list .book-cover .excerpt',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_pagination_buttons_background_color',
						'label' => 'Pagination Background',
						'default' => '#f0f0f0',
						'selectors' => '.pagination a',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_pagination_buttons_hover_background_color',
						'label' => 'Pagination Background Hover',
						'default' => '#333',
						'selectors' => '.pagination a:hover',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_pagination_buttons_font_color',
						'label' => 'Pagination Text Color',
						'default' => '#000',
						'selectors' => '.pagination a',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_pagination_label_font_color',
						'label' => 'Pagination Label Color',
						'default' => '#99',
						'selectors' => '.page-count',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
			)
		);

	$customizer_options[] = array(
			'section_title' => 'Single Pages Color Scheme',
			'section_slug' => 'single_pages_color_scheme',
			'elements' => array(
					array(
						'slug' => 'ocmx_post_single_title_background_color',
						'label' => 'Title Background',
						'default' => '#e74c3c',
						'selectors' => '.title-container',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_post_single_title_font_color',
						'label' => 'Post Titles &amp; Meta Text',
						'default' => '#fff',
						'selectors' => '.title-container .post-title a, .title-container .post-author',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_post_single_copy_background_color',
						'label' => 'Content Background',
						'default' => '#fff',
						'selectors' => '.single #content-container, .page #content-container, .single .copy, .page .copy',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_post_single_copy_font_color',
						'label' => 'Content Text',
						'default' => '#000',
						'selectors' => '.single .copy, .page .copy',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_post_single_links_font_color',
						'label' => 'Content Links',
						'default' => '#790101',
						'selectors' => '.single .copy a, .page .copy a',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_post_single_links_hover_font_color',
						'label' => 'Content Links Hover',
						'default' => '#999',
						'selectors' => '.single .copy a:hover, .page .copy  a:hover',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_post_single_footer_meta_font_color',
						'label' => 'Footer Meta',
						'default' => '#999',
						'selectors' => '.copy .post-date, .next-prev-post-nav small',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_post_single_footer_meta_links_font_color',
						'label' => 'Footer Meta Links',
						'default' => '#790101',
						'selectors' => '.single .post-date a, .page .post-date a',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_post_single_pagination_font_color',
						'label' => 'Next/Previous Post Links',
						'default' => '#000',
						'selectors' => '.next-prev-post-nav a',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_post_single_pagination_font_hover_color',
						'label' => 'Next/Previous Post Links Hover',
						'default' => '#790101',
						'selectors' => '.next-prev-post-nav a:hover',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_post_single_tags_background_color',
						'label' => 'Tags Backround',
						'default' => '#f0f0f0',
						'selectors' => '.tags a',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_post_single_tags_font_color',
						'label' => 'Tags Link Color',
						'default' => '#000',
						'selectors' => '.tags a',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_post_author_block_background_color',
						'label' => 'Author Block Background',
						'default' => '#e74c3c',
						'selectors' => '.author-container',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_post_author_block_font_color',
						'label' => 'Author Block Text',
						'default' => '#fff',
						'selectors' => '.author-content .author-name, .author-content .author-bio',
						'css'	=> 'color',
						'jquery'	=> 'color'
					)
				),
		);

	$customizer_options[] = array(
			'section_title' => 'Comment Section Color Scheme',
			'section_slug' => 'comments_color_scheme',
			'elements' => array(
					array(
						'slug' => 'ocmx_comment_container_background_color',
						'label' => 'Comments Container',
						'default' => '#f0f0f0',
						'selectors' => '#comments',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_comment_list_background_color',
						'label' => 'Comment List Background',
						'default' => '#e5e5e5',
						'selectors' => '.comment',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_comment_title_font_color',
						'label' => 'Titles & Author Names',
						'default' => '#000',
						'selectors' => '.comments-title, .comment .fn, .comment .fn a, .comment-reply-title',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_comment_body_font_color',
						'label' => 'Comments Body',
						'default' => '#595959',
						'selectors' => '.comment',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_comment_meta_font_color',
						'label' => 'Meta',
						'default' => '#999',
						'selectors' => '.comment .date, .comment .date a, #respond .logged-in-as, #respond .logged-in-as a, #respond .form-allowed-tags code, #respond .form-allowed-tags',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_comment_link_font_color',
						'label' => 'Links',
						'default' => '#790101',
						'selectors' => '.comment a, .comment .comment-edit-link, .comment-reply-title a',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_comment_form_label_font_color',
						'label' => 'Form Labels',
						'default' => '#000',
						'selectors' => '#respond label',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_comment_form_submit_font_color',
						'label' => 'Submit Button Text',
						'default' => '#333',
						'selectors' => '#respond input[type=submit]',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_comment_form_submit_background_color',
						'label' => 'Submit Button Background',
						'default' => '#333',
						'selectors' => '#respond input[type=submit]',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_comment_form_submit_background_hover_color',
						'label' => 'Submit Button Background Hover',
						'default' => '#790101',
						'selectors' => '#respond input[type=submit]:hover',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					)
				),
		);

	$customizer_options[] = array(
			'section_title' => 'Footer Color Scheme',
			'section_slug' => 'footer_color_scheme',
			'elements' => array(
					array(
						'slug' => 'ocmx_footer_container_background_color',
						'label' => 'Container Background',
						'default' => '#fff',
						'selectors' => '#footer-container',
						'css'	=> 'background-color',
						'jquery'	=> 'backgroundColor'
					),
					array(
						'slug' => 'ocmx_footer_container_border_color',
						'label' => 'Container Border',
						'default' => '#fff',
						'selectors' => '#footer-container',
						'css'	=> 'border-top-color',
						'jquery'	=> 'border-top-color'
					),
					array(
						'slug' => 'ocmx_footer_font_color',
						'label' => 'Text Color',
						'default' => '#777',
						'selectors' => '.footer-text',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_footer_links_font_color',
						'label' => 'Links',
						'default' => '#777',
						'selectors' => '.footer-text a',
						'css'	=> 'color',
						'jquery'	=> 'color'
					),
					array(
						'slug' => 'ocmx_footer_links_hover_font_color',
						'label' => 'Links Hover',
						'default' => '#000',
						'selectors' => '.footer-text a:hover',
						'css'	=> 'color',
						'jquery'	=> 'color'
					)
				),
		);

	/***************************************************************************/
	/* Setup Defaults for this theme for options which aren't set in this page */
	if(is_admin() && !get_option($obox_themeid."-defaults")) :
		update_option("ocmx_general_font_style_default",
						"'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
		update_option("ocmx_navigation_font_style_default",
						"'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
		update_option("ocmx_sub_navigation_font_style_default",
						"'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
		update_option("ocmx_post_font_titles_style_default",
						"'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
		update_option("ocmx_post_font_meta_style_default",
						"'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
		update_option("ocmx_post_font_copy_font_style_default",
						"'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
		update_option("ocmx_widget_font_titles_font_style_default",
						"'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");
		update_option("ocmx_widget_footer_titles_font_size_default",
						"'proxima-nova', 'Proxima Nova', 'Helvetica Neue'");


		update_option("ocmx_general_font_color_default",
						"#333");
		update_option("ocmx_navigation_font_color_default",
						"#777");
		update_option("ocmx_sub_navigation_font_color_default",
						"#333");
		update_option("ocmx_post_titles_font_color_default",
						"#333");
		update_option("ocmx_post_meta_font_color_default",
						"#999");
		update_option("ocmx_post_copy_font_color_default",
						"#333");
		update_option("ocmx_widget_titles_font_color_default",
						"#999");
		update_option("ocmx_widget_footer_titles_font_color_default",
						"#999");

		update_option("ocmx_general_font_size_default",
						"17");
		update_option("ocmx_navigation_font_size_default",
						"12");
		update_option("ocmx_sub_navigation_font_size_default",
						"12");
		update_option("ocmx_post_titles_font_size_default",
						"10");
		update_option("ocmx_post_meta_font_size_default",
						"13");
		update_option("ocmx_post_copy_font_size_default",
						"17");
		update_option("ocmx_widget_titles_font_size_default",
						"15");
		update_option("ocmx_widget_footer_titles_font_size_default",
						"15");
		update_option($obox_themeid."-defaults", 1);
	endif;
}
add_action ( 'init' , 'ocmx_theme_options' );