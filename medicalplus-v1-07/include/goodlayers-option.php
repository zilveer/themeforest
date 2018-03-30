<?php

	/*	
	*	Goodlayers Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file contains the goodlayers panel elements and create the 
	*	goodlayers panel to the back-end of the framework
	*	---------------------------------------------------------------------
	*/
	
	// goodlayers panel navigation elements
	$goodlayers_menu = array(			
		__('General', 'gdl_back_office') => array(
			__('Page Style', 'gdl_back_office')=>'gdl_panel_page_style',
			__('Blog/Port Style', 'gdl_back_office')=>'gdl_panel_blog_port_style',
			__('Search/Archive Style', 'gdl_back_office')=>'gdl_panel_search_archive_style',
			__('Sidebar', 'gdl_back_office')=>'gdl_panel_sidebar',
			__('Footer Style', 'gdl_back_office')=>'gdl_panel_footer_style',
			__('Google Analytics', 'gdl_back_office')=>'gdl_panel_google_analytics',
			__('Favicon', 'gdl_back_office')=>'gdl_panel_favicon'),
			
		__('Font Style', 'gdl_back_office') => array(
			__('Font Size', 'gdl_back_office')=>'gdl_panel_font_size',
			__('Font Family', 'gdl_back_office')=>'gdl_panel_font',
			__('Upload Font', 'gdl_back_office')=>'gdl_panel_upload_font'),
			
		__('Overall Elements', 'gdl_back_office') => array(
			__('Logo', 'gdl_back_office')=>'gdl_panel_logo',
			__('Header Background', 'gdl_back_office')=>'gdl_panel_background',			
			__('Top Navigation', 'gdl_back_office')=>'gdl_panel_top_navigation',
			__('Icon Style', 'gdl_back_office')=>'gdl_panel_icon_style',
			__('Social Network', 'gdl_back_office')=>'gdl_panel_social_network',
			__('Social Shares', 'gdl_back_office')=>'gdl_panel_social_shares',
			__('Copyright Area', 'gdl_back_office')=>'gdl_panel_copyright_area'),
			//__('Dummy Data', 'gdl_back_office')=>'gdl_panel_dummy_data' ),	
			
		__('Elements Color', 'gdl_back_office') => array(
			__('Header / Navigation', 'gdl_back_office')=>'gdl_panel_header_navigation',
			__('Top Bar', 'gdl_back_office')=>'gdl_panel_top_search',
			__('Body', 'gdl_back_office')=>'gdl_panel_body',
			__('Footer', 'gdl_back_office')=>'gdl_panel_footer',
			__('Slider / Stunning text', 'gdl_back_office')=>'gdl_panel_slider',
			__('Blog / Portfolio', 'gdl_back_office')=>'gdl_panel_blog_port',
			__('Contact / Comments', 'gdl_back_office')=>'gdl_panel_contact_form',
			__('Price / Personnal Item', 'gdl_back_office')=>'gdl_panel_price_personnal_item',			
			__('Additional Elements', 'gdl_back_office')=>'gdl_panel_additional_elements',
			__('Additional Elements 2', 'gdl_back_office')=>'gdl_panel_additional_elements_2',
			__('Load Default Color', 'gdl_back_office')=>'gdl_panel_load_default_color'),
			
		__('Translator','gdl_back_office')=> array(
			__('Enable Admin Translator', 'gdl_back_office')=>'gdl_panel_enable_admin_translator',
			__('Blog/Portfolio', 'gdl_back_office')=>'gdl_panel_blog_port_translator',
			__('Contact Form', 'gdl_back_office')=>'gdl_panel_contact_form_translator',
			__('Additional Elements', 'gdl_back_office')=>'gdl_panel_additional_elements_translator'),
		
		__('Plugin Setting', 'gdl_back_office') => array(
			__('Enable/Disable Plugin', 'gdl_back_office')=>'gdl_panel_plugin_enable',
			__('Nivo Slider', 'gdl_back_office')=>'gdl_panel_nivo_slider',
			__('Flex / Carousel Slider', 'gdl_back_office')=>'gdl_panel_flex_slider',
			__('Anything Slider', 'gdl_back_office')=>'gdl_panel_anything_slider',
			__('Disable Right Click', 'gdl_back_office')=>'gdl_panel_disable_right_click')
	);
	
	// goodlayers panel elements ( the head of array links to the menu of navigation elements )
	$goodlayers_element = array(
		//General
		'gdl_panel_page_style' => array(
			__('ENABLE RESPONSIVE', 'gdl_back_office')=>array(
				'type'=>'radioenabled',
				'name'=>THEME_SHORT_NAME.'_enable_responsive',
				'description'=>'*** Anything slider will not supported with the responsive mode ***'
			),
			__('CUT EXCERPT BY SPACE', 'gdl_back_office')=>array(
				'type'=>'radioenabled',
				'name'=>THEME_SHORT_NAME.'_space_excerpt',
				'description'=>'Enabling this will make the theme cut the end of the excerpt by considering the space.' .
					' ( Only use with language that divides the word by space )'
			),		
			__('DEFAULT DATE FORMAT', 'gdl_back_office')=>array(
				'type'=>'inputtext',
				'name'=>THEME_SHORT_NAME.'_default_date_format',
				'default'=>'F d, Y',
				'description'=>'See more details about the date format here. http://codex.wordpress.org/Formatting_Date_and_Time'),			
			__('DEFAULT WIDGET DATE FORMAT', 'gdl_back_office')=>array(
				'type'=>'inputtext',
				'name'=>THEME_SHORT_NAME.'_default_widget_date_format',
				'default'=>'F d, Y',
				'description'=>'See more details about the date format here. http://codex.wordpress.org/Formatting_Date_and_Time'),												
			__('ADDITIONAL STYLE (CSS)', 'gdl_back_office')=>array(
				'type'=>'textarea',
				'name'=>THEME_SHORT_NAME.'_additional_style',
				'body_class'=>'gdl-additional-style')
		),
		
		'gdl_panel_blog_port_style' => array(
			__('DEFAULT POST HEADER', 'gdl_back_office')=>array(
				'type'=>'inputtext',
				'name'=>THEME_SHORT_NAME.'_default_post_header',
				'default'=>'Blog Post'),
			__('DEFAULT POST SIDEBAR', 'gdl_back_office')=>array(
				'type'=>'radioimage',
				'name'=>THEME_SHORT_NAME.'_default_post_sidebar',
				'default'=>'post-no-sidebar',
				'options'=>array(
					'1'=>array('value'=>'post-right-sidebar','default'=>'selected','image'=>'/include/images/right-sidebar-120.png'),
					'2'=>array('value'=>'post-left-sidebar','image'=>'/include/images/left-sidebar-120.png'),
					'3'=>array('value'=>'post-both-sidebar','image'=>'/include/images/both-sidebar-120.png'),
					'4'=>array('value'=>'post-no-sidebar','image'=>'/include/images/no-sidebar-120.png'))),
			__('DEFAULT POST LEFT SIDEBAR', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_default_post_left_sidebar',
				'options'=> get_sidebar_name(),
				'body'=>'gdl-default-post-left-sidebar'),
			__('DEFAULT POST RIGHT SIDEBAR', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_default_post_right_sidebar',
				'options'=> get_sidebar_name(),
				'body'=>'gdl-default-post-right-sidebar'),	
			__('SHOW POST TAG INFO', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_show_post_tag',
				'options'=> array('Yes','No'),
				'description'=> 'Select this to "No" will hide the post tag in post item out.'
			),
			__('SHOW POST COMMENT INFO', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_show_post_comment_info',
				'options'=> array('Yes','No'),
				'description'=> 'Select this to "No" will hide the post comment info in post item out.'
			),		
			__('SHOW POST AUTHOR INFO', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_show_post_author_info',
				'options'=> array('Yes','No'),
				'description'=> 'Select this to "No" will hide the post author in post item out. ( not the about author section in the post )'
			),				
			__('PORTFOLIO PAGE STYLE', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_use_portfolio_as',
				'options'=>array('1'=>'portfolio style', '2'=>'blog style'),
				'description'=>'You can choose the portfolio page style to be the portfolio style or the same as blog style.'),
			__('PORTFOLIO SLUG', 'gdl_back_office')=>array(
				'type'=>'inputtext',
				'name'=>THEME_SHORT_NAME.'_gdl_portfolio_slug',
				'default'=>'portfolio',
				'description'=>'Change/Rewrite the permalink when you use the permalink type as %postname%.'
			),	
			__('RELATED PORTFOLIO', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_gdl_related_portfolio',
				'default'=>'portfolio',
				'options'=>array('Yes', 'No'),
				'description'=>'Show related portfolio for portfolio post type.'
			),	
			__('RELATED PORTFOLIO SIZE', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_gdl_related_portfolio_size',
				'options'=>array('1/4', '1/3', '1/2')
			),		
			__('RELATED PORTFOLIO NUM FETCH', 'gdl_back_office')=>array(
				'type'=>'inputtext',
				'name'=>THEME_SHORT_NAME.'_gdl_related_portfolio_num_fetch',
				'default'=>'4'
			),			
			__('SHOW RELATED PORTFOLIO TITLE', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_gdl_related_portfolio_title',
				'options'=>array('Yes', 'No')
			),				
			__('SHOW RELATED PORTFOLIO EXCERPT', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_gdl_related_portfolio_tag',
				'options'=>array('Yes', 'No')
			),		
			__('RELATED PORTFOLIO EXCERPT NUM', 'gdl_back_office')=>array(
				'type'=>'inputtext',
				'name'=>THEME_SHORT_NAME.'_gdl_related_portfolio_excerpt_num',
				'default'=>185
			),			
		),
		
		'gdl_panel_search_archive_style' => array(
			__('SEARCH/ARCHIVE SIDEBAR', 'gdl_back_office')=>array(
				'type'=>'radioimage',
				'name'=>THEME_SHORT_NAME.'_search_archive_sidebar',
				'default'=>'no-sidebar',
				'options'=>array(
					'1'=>array('value'=>'right-sidebar','default'=>'selected','image'=>'/include/images/right-sidebar-120.png'),
					'2'=>array('value'=>'left-sidebar','image'=>'/include/images/left-sidebar-120.png'),
					'3'=>array('value'=>'both-sidebar','image'=>'/include/images/both-sidebar-120.png'),
					'4'=>array('value'=>'no-sidebar','image'=>'/include/images/no-sidebar-120.png'))),
			__('SEARCH/ARCHIVE LEFT SIDEBAR', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_search_archive_left_sidebar',
				'options'=> get_sidebar_name(),
				'body'=>'gdl-default-post-left-sidebar'),
			__('SEARCH/ARCHIVE RIGHT SIDEBAR', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_search_archive_right_sidebar',
				'options'=> get_sidebar_name(),
				'body'=>'gdl-default-post-right-sidebar'),						
			__('SEARCH/ARCHIVE EXCERPT NUM', 'gdl_back_office')=>array(
				'type'=>'inputtext',
				'name'=>THEME_SHORT_NAME.'_search_archive_num_excerpt',
				'default'=>'285',
				'description'=>'Input the number of character you want to cut from the content to be the excerpt of search and archive page.'),	
			__('SEARCH/ARCHIVE FULL BLOG CONTENT', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_search_archive_full_blog_content',
				'options'=>array('No', 'Yes')
			),		
			__('PORTFOLIO ARCHIVE SIZE', 'gdl_back_office')=>array(
				'type'=>'combobox', 
				'name'=>THEME_SHORT_NAME.'_portfolio_archive_size',
				'options'=>array('1/4', '1/3', '1/2'),
				'default'=>'1/3'
			),		
			__('PORTFOLIO ARCHIVE SHOW TITLE', 'gdl_back_office')=>array(
				'type'=>'combobox', 
				'name'=>THEME_SHORT_NAME.'_portfolio_archive_show_title',
				'options'=>array('Yes', 'No')
			),			
			__('PORTFOLIO ARCHIVE SHOW EXCERPT', 'gdl_back_office')=>array(
				'type'=>'combobox', 
				'name'=>THEME_SHORT_NAME.'_portfolio_archive_show_tags',
				'options'=>array('Yes', 'No')
			),		
			__('PORTFOLIO ARCHIVE NUM EXCERPT', 'gdl_back_office')=>array(
				'type'=>'inputtext', 
				'name'=>THEME_SHORT_NAME.'_portfolio_archive_num_excerpt',
				'default'=>'185'
			),			
		),
		
		'gdl_panel_sidebar' => array(
			__('CREATE SIDEBAR', 'gdl_back_office')=>array('type'=>'sidebar','name'=>THEME_SHORT_NAME.'_create_sidebar')
		),
		
		'gdl_panel_footer_style' => array(
			__('SHOW FOOTER', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=> THEME_SHORT_NAME.'_show_footer'),		
			__('CHOOSE FOOTER STYLE', 'gdl_back_office')=>array(
				'type'=>'radioimage',
				'name'=>THEME_SHORT_NAME.'_footer_style', 
				'default'=>'footer-style1',
				'options'=>array(
					'1'=>array('value'=>'footer-style1','image'=>'/include/images/footer-style1.png'),
					'2'=>array('value'=>'footer-style2','image'=>'/include/images/footer-style2.png'),
					'3'=>array('value'=>'footer-style3','image'=>'/include/images/footer-style3.png'),
					'4'=>array('value'=>'footer-style4','image'=>'/include/images/footer-style4.png'),
					'5'=>array('value'=>'footer-style5','image'=>'/include/images/footer-style5.png'),
					'6'=>array('value'=>'footer-style6','image'=>'/include/images/footer-style6.png'),
			))
		),
		
		'gdl_panel_google_analytics' => array(
			__('ENABLE GOOGLE ANALYTICS', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=> THEME_SHORT_NAME.'_enable_analytics', 'default'=>'disable'),
			__('GOOGLE ANALYTICS CODE', 'gdl_back_office')=>array('type'=>'textarea', 'name'=> THEME_SHORT_NAME.'_analytics_code',
				'description'=>'Place the code you get from google here. This should be something like <br>' . 
				htmlspecialchars('<script type="text/javascript">') . '<br> ... <br>' .
				htmlspecialchars('</script>'))
		),
		
		'gdl_panel_favicon' => array(
			__('ENABLE FAVICON', 'gdl_back_office')=>array('type'=>'radioenabled','name'=> THEME_SHORT_NAME.'_enable_favicon', 'default'=>'disable',
				'description' => 'Upload the .ICO file type to make the favicon support with all browser.'),
			__('UPLOAD FAVICON ICON', 'gdl_back_office')=>array('type'=>'upload','name'=> THEME_SHORT_NAME.'_favicon_image'),
		),		
		
		//Theme Style
		'gdl_panel_font_size' => array(
			__('NAVIGATION SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_navigation_size','default'=>'12',
				'description'=>'Main menu font size.'),
			__('PAGE TITLE SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_page_title_size','default'=>'30'),
			__('HEADER TITLE SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_header_title_size','default'=>'27',
				'description'=>'This is the font size of the item header title.'),				
			__('CONTENT SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_content_size','default'=>'12'),
			__('WIDGET TITLE SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_widget_title_size','default'=>'16',
				'descriptoin'=>'Size of the widget title ( that resides in sidebar and footer ).'),
			__('H1 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h1_size','default'=>'33',
				'description'=>'H1 to H6 size will only effects to the user content ( the h1 to h6 tag that users add them self ) font size. '),
			__('H2 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h2_size','default'=>'28'),
			__('H3 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h3_size','default'=>'24'),
			__('H4 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h4_size','default'=>'20'),
			__('H5 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h5_size','default'=>'18'),
			__('H6 SIZE', 'gdl_back_office')=>array('type'=>'sliderbar','name'=>THEME_SHORT_NAME.'_h6_size','default'=>'17'),

		),

		'gdl_panel_font' => array(
			__('HEADER FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_header_font', 'default'=>'- Lato',
				'description'=>'Choose the header font of this theme. This font will be used in all title and header elements including the slider title.'),
			__('MAIN NAVIGATION FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_navigation_font', 'default'=>'- Default'),
			__('SLIDER TITLE FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_slider_title_font', 'default'=>'- Lato'),
			__('CONTENT FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_content_font', 'default'=>'- Open Sans',
				'description'=>'Choose the font to use with content. CUFON are not allowed to use with the content font.'),
			__('STUNNING TEXT FONT', 'gdl_back_office')=>array('type'=>'font-combobox','name'=>THEME_SHORT_NAME.'_stunning_text_font', 'default'=>'- Lato',
				'description'=>'Choose the font to use with stunning text title.')
		),

		'gdl_panel_upload_font' => array(
			__('UPLOAD FONT', 'gdl_back_office')=>array(
				'type'=>'uploadfont',
				'name'=>THEME_SHORT_NAME.'_upload_font',
				'file'=>THEME_SHORT_NAME.'_upload_font_file')
		),
		
		//Overall Elements
		'gdl_panel_logo' => array( 
			__('LOGO POSITION', 'gdl_back_office')=>array('type'=>'combobox','name'=>THEME_SHORT_NAME.'_logo_position',
				'options'=>array('Left','Center','Right'), 'default'=>'Left'),	
			__('LOGO', 'gdl_back_office')=>array('type'=>'upload','name'=>THEME_SHORT_NAME.'_logo'), 
			__('LOGO TOP MARGIN', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_logo_top_margin','default'=>'40',
				'description'=>'Input number to set the top space of the logo. Negative value is allowed. Please use -0 instead of 0.'), 
			__('TOP RIGHT TEXT', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_logo_right_text',
				'description'=>'This text will appear at the right side of the logo if you select the left logo position, and opposite for right logo position.'),				
			__('TOP RIGHT TEXT TOP MARGIN', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_logo_right_top_margin','default'=>'45'),
		),

		'gdl_panel_background' => array(	
			__('CONTENT MARGIN', 'gdl_back_office')=>array( 'type'=>'inputtext', 'name'=>THEME_SHORT_NAME.'_content_top_margin', 'default'=>'-317',
				'description'=>'Negative value is allowed. ( use to move the content area to overlap with the header area. )'),
			__('CONTENT SHADOW OPACITY', 'gdl_back_office')=>array( 'type'=>'inputtext', 'name'=>THEME_SHORT_NAME.'_content_shadow_opacity', 'default'=>'0.3', 
				'description'=>'Value can be varied from 0 to 1.'),				
			__('HEADER HEIGHT', 'gdl_back_office')=>array( 'type'=>'inputtext', 'name'=>THEME_SHORT_NAME.'_header_area_height', 'default'=>'450'),
			__('HEADER BACKGROUND TYPE', 'gdl_back_office')=>array('type'=>'combobox', 'id'=>'gdl_background_style','name'=>THEME_SHORT_NAME.'_background_style','options'=>array('0'=>'Pattern','1'=>'Custom Image','2'=>'None'),
				'description'=>'You can choose the background you want between our pre-provided pettern and your custom image.'),
			__('CHOOSE PATTERN','gdl_back_office')=>array(
				'type'=>'radioimage',
				'body_class'=>'gdl_background_pattern',
				'name'=>THEME_SHORT_NAME.'_background_pattern',
				'default'=>'1',
				'options'=>array(
					'1'=>array('value'=>'1','image'=>'/include/images/pattern/pattern-1.png'),
					'2'=>array('value'=>'2','image'=>'/include/images/pattern/pattern-2.png'),
					'3'=>array('value'=>'3','image'=>'/include/images/pattern/pattern-3.png'),
					'4'=>array('value'=>'4','image'=>'/include/images/pattern/pattern-4.png'),
					'5'=>array('value'=>'5','image'=>'/include/images/pattern/pattern-5.png')
				)
			),
			__('CUSTOM BACKGROUND', 'gdl_back_office')=>array(
				'type'=>'upload',
				'name'=>THEME_SHORT_NAME.'_background_custom',
				'body_class'=>'gdl_background_custom'), 
		),

		'gdl_panel_top_navigation' => array( 
			__('ENABLE TOP BAR', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_enable_top_navigation',
				'description'=>'Top navigation is a bar over the logo. You can create a link and caption as you want. '), 
			__('ENABLE TOP SEARCH', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_enable_top_search',
				'description'=>'Toggle to enable/disable search box at the right side of main navigation.'),
			
		),

		'gdl_panel_icon_style' => array(
			__('BODY ICON STYLE','gdl_back_office')=>array(
				'type'=>'combobox',
				'name'=>THEME_SHORT_NAME.'_icon_type',
				'options'=>array('1'=>'dark','2'=>'light'),
				'description'=>'This option will change all of the icon in this theme( except from footer ) to be dark/light version.'),		
			__('TOP SLIDER ICON STYLE', 'gdl_back_office')=>array('type'=>'combobox','name'=>THEME_SHORT_NAME.'_top_slider_icon_type','options'=>array('0'=>'light','1'=>'dark'),'default'=>'light'),
			__('CAROUSEL ICON STYLE', 'gdl_back_office')=>array('type'=>'combobox','name'=>THEME_SHORT_NAME.'_carousel_icon_type','options'=>array('0'=>'light','1'=>'dark'),'default'=>'light',
				'description' =>'This is left and right icon type of the thumbnail in carousel slider.'),
			__('FOOTER ICON STYLE', 'gdl_back_office')=>array('type'=>'combobox','name'=>THEME_SHORT_NAME.'_footer_icon_type','options'=>array('0'=>'dark','1'=>'light'),'default'=>'dark',
				'description' =>'There are two icon types in this theme, dark and light, you can choose it to display on footer as you want.'),
		),
		
		'gdl_panel_social_network' => array( 
			__('DELICIOUS', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_delicious',
				'description'=>'Place the link you want and delicious icon will appear. To remove it, just leave it blank.'),	
			__('DEVIANTART', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_deviantart',
				'description'=>'Place the link you want and deviantart icon will appear. To remove it, just leave it blank.'),	
			__('DIGG', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_digg',
				'description'=>'Place the link you want and digg icon will appear. To remove it, just leave it blank.'),					
			__('FACEBOOK', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_facebook',
				'description'=>'Place the link you want and facebook icon will appear. To remove it, just leave it blank.'),
			__('FLICKR', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_flickr',
				'description'=>'Place the link you want and flickr icon will appear. To remove it, just leave it blank.'),
			__('LASTFM', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_lastfm',
				'description'=>'Place the link you want and lastfm icon will appear. To remove it, just leave it blank.'),
			__('LINKEDIN', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_linkedin',
				'description'=>'Place the link you want and linkedin icon will appear. To remove it, just leave it blank.'),			
			__('PICASA', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_picasa',
				'description'=>'Place the link you want and picasa icon will appear. To remove it, just leave it blank.'),
			__('RSS', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_rss',
				'description'=>'Place the link you want and feed icon will appear. To remove it, just leave it blank.'),
			__('STUMBLE UPON', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_stumble_upon',
				'description'=>'Place the link you want and stumble upon icon will appear. To remove it, just leave it blank.'),
			__('TUMBLR', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_tumblr',
				'description'=>'Place the link you want and tumblr icon will appear. To remove it, just leave it blank.'),	
			__('TWITTER', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_twitter',
				'description'=>'Place the link you want and twitter icon will appear. To remove it, just leave it blank.'),
			__('VIMEO', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_vimeo',
				'description'=>'Place the link you want and vimeo icon will appear. To remove it, just leave it blank.'),
			__('YOUTUBE', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_youtube',
				'description'=>'Place the link you want and youtube icon will appear. To remove it, just leave it blank.'),
			__('GOOGLE PLUS', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_google_plus',
				'description'=>'Place the link you want and google plus icon will appear. To remove it, just leave it blank.'),		
			__('EMAIL', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_email',
				'description'=>'Place the link you want and email icon will appear. To remove it, just leave it blank.'),				
			__('PINTEREST', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_pinterest',
				'description'=>'Place the link you want and pinterest icon will appear. To remove it, just leave it blank.'),	
			),		
		
		'gdl_panel_social_shares' => array(
			__('FACEBOOK', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_facebook_share',
				'description'=>'Toggle to enable/disable the facebook shares in blog and portfolio page.'),
			__('TWITTER', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_twitter_share',
				'description'=>'Toggle to enable/disable the twitter shares in blog and portfolio page.'),
			__('STUMBLE UPON', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_stumble_upon_share',
				'description'=>'Toggle to enable/disable the stumble upon shares in blog and portfolio page.'),
			__('MY SPACE', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_my_space_share',
				'description'=>'Toggle to enable/disable the my spce shares in blog and portfolio page.'),
			__('DELICIOUS', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_delicious_share',
				'description'=>'Toggle to enable/disable the delicious shares in blog and portfolio page.'),
			__('DIGG', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_digg_share',
				'description'=>'Toggle to enable/disable the digg shares in blog and portfolio page.'),
			__('REDDIT', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_reddit_share',
				'description'=>'Toggle to enable/disable the reddit shares in blog and portfolio page.'),
			__('LINKEDIN', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_linkedin_share',
				'description'=>'Toggle to enable/disable the linkedin shares in blog and portfolio page.'),
			__('GOOGLE PLUS', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_google_plus_share',
				'description'=>'Toggle to enable/disable the google plus shares in blog and portfolio page.'),			
			__('PINTEREST', 'gdl_back_office')=>array('type'=>'radioenabled','name'=>THEME_SHORT_NAME.'_pinterest_share',
				'description'=>'Toggle to enable/disable the pinterest shares in blog and portfolio page.'),						
				
		),
			
		'gdl_panel_copyright_area' => array( 
			__('SHOW COPYRIGHT', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=> THEME_SHORT_NAME.'_show_copyright'),		
			__('COPYRIGHT LEFT AREA', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_copyright_left_area'), 
			__('COPYRIGHT RIGHT AREA', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_copyright_right_area')
		),
		
		// 'gdl_panel_dummy_data' => array( 
		// 	__('LOAD DUMMY DATA', 'gdl_back_office')=>array('type'=>'dummy')
		// ),
			
		// Elements Color
		'gdl_panel_header_navigation' => array(
			__('TOP BAR BACKGROUND', 'gdl_back_office')=>array( 'type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_top_bar_background',
				'default'=>'#324a61', 'attr'=> array('background-color'), 'selector'=>'.top-navigation-wrapper' ),
			__('TOP BAR LINK COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_top_bar_link',
				'default'=>'#bac6d1', 'attr'=> array('color'), 'selector'=>'.top-navigation-wrapper a' ),		
			__('TOP BAR LINK HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_top_bar_link_hover',
				'default'=>'#bac6d1', 'attr'=> array('color'), 'selector'=>'.top-navigation-wrapper a:hover' ),	
			__('MAIN NAVIGATION TOP BAR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_top_bar',
				'default'=>'#4b6a88', 'attr'=> array('background-color'), 'selector'=>'div.gdl-navigation-gimmick' ),
			__('MAIN NAVIGATION TOP BAR TOP BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_top_bar_top_border',
				'default'=>'#7594a8', 'attr'=> array('border-top-color'), 'selector'=>'div.gdl-navigation-gimmick' ),				
			__('MAIN NAVIGATION TOP BAR BOTTOM BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_top_bar_border',
				'default'=>'#ffffff', 'attr'=> array('border-bottom-color'), 'selector'=>'div.gdl-navigation-gimmick' ),
			__('MAIN NAVIGATION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_background',
				'default'=>'#f4f4f4', 'attr'=> array('background-color'), 'selector'=>'.navigation-wrapper' ),
			__('MAIN NAVIGATION TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_text',
				'default'=>'#7a7a7a', 'attr'=> array('color'), 'selector'=>'.sf-menu li a',
				'description'=>'This is the text color of the main navigation in the normal state.'),
			__('MAIN NAVIGATION TEXT HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_text_hover',
				'default'=>'#3d3d3d', 'attr'=> array('color'),  'selector'=>'.sf-menu li a:hover',
				'description'=>'This is the text color of the main navigation in "hover" state.'),
			__('MAIN NAVIGATION TEXT CURRENT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_text_current',
				'default'=>'#3d3d3d', 'attr'=> array('color'), 'selector'=>'.sf-menu li.current-menu-ancestor a, .sf-menu li.current-menu-item a',
				'description'=>'This is the text color of the main navigation in "current page" state.'),			
			__('MAIN NAVIGATION LEFT BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_left_border',
				'default'=>'#f8f8f8', 'attr'=> array('border-left-color', 'border-right-color'),  'selector'=>'ul.sf-menu li, #main-superfish-wrapper'),	
			__('MAIN NAVIGATION RIGHT BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_main_navigation_right_border',
				'default'=>'#e4e4e4', 'attr'=> array('border-right-color'),  'selector'=>'ul.sf-menu li'),				
			__('SUB NAVIGATION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_background',
				'default'=>'#fdfdfd', 'attr'=> array('background-color'), 'selector'=>'.sf-menu li li' ),
			__('SUB NAVIGATION BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_border',
				'default'=>'#ececec', 'attr'=> array('border-color'), 'selector'=>'.sf-menu ul, .sf-menu ul li' ),
			__('SUB NAVIGATION TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_text',
				'default'=>'#7a7a7a', 'attr'=> array('color'), 
				'selector'=>'.sf-menu li li a, .sf-menu li.current-menu-item li a, .sf-menu li.current-menu-ancestor li a, .sf-menu li li.current-menu-item li a, .sf-menu li li.current-menu-ancestor li a' ),
			__('SUB NAVIGATION TEXT HOVER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_text_hover',
				'default'=>'#3d3d3d', 'attr'=> array('color'), 
				'selector'=>'.sf-menu li li a:hover, .sf-menu li li.current-menu-item li a:hover, .sf-menu li li.current-menu-ancestor li a:hover' ),
			__('SUB NAVIGATION TEXT CURRENT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sub_navigation_text_current',
				'default'=>'#3d3d3d', 'attr'=> array('color'), 
				'selector'=>'.sf-menu li li.current-menu-item a, .sf-menu li li.current-menu-ancestor a, .sf-menu li li.current-menu-ancestor li.current-menu-item a' ),
			__('TOP RIGHT TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_top_right_text_color',
				'default'=>'#ffffff', 'attr'=> array('color'), 'selector'=>'.logo-right-text' ),
		),		
		
		'gdl_panel_top_search' => array(
			__('SEARCH TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_search_text',
				'default'=>'#ffffff', 'attr'=> array('color'), 'selector'=>'.search-wrapper input[type="text"]' ),
			__('SEARCH TEXT BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_search_background',
				'default'=>'#5c6c78', 'attr'=> array('background-color'), 'selector'=>'.search-wrapper input[type="text"]' ),
			__('SEARCH SUBMIT TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_search_submit_text',
				'default'=>'#ffffff', 'attr'=> array('color'), 'selector'=>'.search-wrapper input[type="submit"]' ),
			__('SEARCH SUBMIT BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_search_submit_background',
				'default'=>'#5c6c78', 'attr'=> array('background'), 'selector'=>'.search-wrapper input[type="submit"]' ),
			__('SEARCH WRAPPER BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_search_wrapper_background',
				'default'=>'#455563', 'attr'=> array('background-color'), 'selector'=>'div.search-wrapper .gdl-search-form' ),
		),
		
		'gdl_panel_body' => array(	
			__('HEADER BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_header_background',
				'default'=>'#476f94', 'attr'=>array('background-color'), 'selector'=>'.header-wrapper',
				'description'=>'Header background will NOT take effects when user use the non transparent pattern as background'),		
			__('PAGE TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_page_title_color',
				'default'=>'#5c5c5c', 'attr'=>array('color'), 'selector'=>'h1.gdl-page-title'),
			__('PAGE CAPTION COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_page_caption_color',
				'default'=>'#b0b0b0', 'attr'=>array('color'), 'selector'=>'div.gdl-page-title-wrapper span'),	
			__('PAGE TITLE BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_page_title_background',
				'default'=>'#f8f8f8', 'attr'=>array('background-color'), 'selector'=>'div.gdl-page-title-wrapper'),					
			__('TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_title_color',
				'default'=>'#41607d', 'attr'=>array('color'), 'selector'=>'h1, h2, h3, h4, h5, h6',
				'description'=>'Change this title color wil effects all title in this theme except footer title, sidebar title, blog thumbnail title and portolio thumbnail title color.'),
			__('CONTENT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_content_color',
				'default'=>'#666666', 'attr'=>array('color'), 'selector'=>'body'),
			__('BODY BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_body_background',
				'default'=>'#eaeaea', 'attr'=>array('background-color'), 'selector'=>'html'),
			__('CONTAINER BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_container_background',
				'default'=>'#ffffff', 'attr'=>array('background-color'), 'selector'=>'.container.main'),
			__('LINK COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_link_color',
				'default'=>'#41607d', 'attr'=>array('color'), 'selector'=>'a',
				'description'=>'This color effects all of the link color in this theme.'),
			__('LINK HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_link_hover_color',
				'default'=>'#8aa2b8', 'attr'=>array('color'), 'selector'=>'a:hover',
				'description'=>'This color effects all of the link color on "hover" state in this theme.'),
			__('SIDEBAR TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sidebar_title_color',
				'default'=>'#494949', 'attr'=>array('color'), 'selector'=>'.custom-sidebar-title, .custom-sidebar-title a' ),
			__('SIDEBAR INFO COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_sidebar_info_color',
				'default'=>'#999999', 'attr'=>array('color'), 'selector'=>'.sidebar-wrapper .recent-post-widget-info, .sidebar-wrapper #twitter_update_list' ),				
			__('TAG CLOUD TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tag_cloud_text_color',
				'default'=>'#5c7fa1', 'attr'=>array('color'), 'selector'=>'.tagcloud a' ),
			__('TAG CLOUD BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tag_cloud_background',
				'default'=>'#f5f5f5', 'attr'=>array('background-color'), 'selector'=>'.tagcloud a' ),				
			__('SELECTION TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_selection_text_clor',
				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'::selection, ::-moz-selection'),
			__('SELECTION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_selection_background',
				'default'=>'#f2594b', 'attr'=>array('background-color'), 'selector'=>'::selection, ::-moz-selection',
				'description'=>'This is the background color when the text is selected ( hightlight ) on your site.'),
		),
		
		'gdl_panel_footer' => array(	
			__('FOOTER LINK COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_link_color',
				'default'=>'#41607d', 'attr'=>array('color'), 'selector'=>'.footer-wrapper a', 
				'description'=>'This color changes all of the link color inside footer in normal state.'),
			__('FOOTER LINK HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_link_hover_color',
				'default'=>'#8aa2b8', 'attr'=>array('color'), 'selector'=>'.footer-wrapper a:hover', 
				'description'=>'This is the link color of footer frame in "hover" state.'),
			__('FOOTER TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_title_color',
				'default'=>'#5a5a5a', 'attr'=>array('color'), 'selector'=>'.footer-wrapper .custom-sidebar-title, .footer-wrapper .custom-sidebar-title a' ),	
			__('FOOTER CONTENT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_content_color',
				'default'=>'#7f7f7f', 'attr'=>array('color'), 'selector'=>'.footer-wrapper, .footer-wrapper table th'),	
			__('FOOTER CONTENT INFO COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_content_info_color',
				'default'=>'#b1b1b1', 'attr'=>array('color'), 'selector'=>'.footer-wrapper .recent-post-widget-info, .footer-wrapper #twitter_update_list',
				'description' =>'The content info is the color of the post date( in post/portfolio widget ) and twitter widget'),	
			__('FOOTER BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_background',
				'default'=>'#f7f7f7', 'attr'=>array('background-color'), 'selector'=>'div.footer-container'),
			__('FOOTER TOP BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_top_border',
				'default'=>'#e1e1e1', 'attr'=>array('border-color'), 'selector'=>'div.footer-container'),				
			__('FOOTER DIVIDER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_divider_color', 
				'default'=>'#c0c0c0', 'attr'=>array('border-color'), 'selector'=>'div.footer-wrapper *'),
			__('FOOTER TAG CLOUD TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_tag_cloud_text_color',
				'default'=>'#41607D', 'attr'=>array('color'), 'selector'=>'.footer-wrapper .tagcloud a' ),
			__('FOOTER TAG CLOUD BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_footer_tag_cloud_background',
				'default'=>'#ebebeb', 'attr'=>array('background-color'), 'selector'=>'.footer-wrapper .tagcloud a' ),					
			__('FOOTER INPUT BOX TEXT', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_input_text', 
				'default'=>'#888888', 'attr'=>array('color'), 
				'selector'=>'div.footer-wrapper div.contact-form-wrapper input[type="text"], div.footer-wrapper div.contact-form-wrapper input[type="password"], ' .
					'div.footer-wrapper div.contact-form-wrapper textarea, div.footer-wrapper div.custom-sidebar #search-text input[type="text"]'),
			__('FOOTER INPUT BOX BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_input_background', 
				'default'=>'#ffffff', 'attr'=>array('background-color'), 
				'selector'=>'div.footer-wrapper div.contact-form-wrapper input[type="text"], div.footer-wrapper div.contact-form-wrapper input[type="password"], ' .
					'div.footer-wrapper div.contact-form-wrapper textarea, div.footer-wrapper div.custom-sidebar #search-text input[type="text"]'),
			__('FOOTER INPUT BOX BORDER', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_input_border', 
				'default'=>'#e8e8e8', 'attr'=>array('border-color'), 
				'selector'=>'div.footer-wrapper div.contact-form-wrapper input[type="text"], div.footer-wrapper div.contact-form-wrapper input[type="password"], ' .
					'div.footer-wrapper div.contact-form-wrapper textarea, div.footer-wrapper div.custom-sidebar #search-text input[type="text"]'),
			__('FOOTER BUTTON TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_button_text', 
				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'.footer-wrapper .contact-form-wrapper button'),
			__('FOOTER BUTTON BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_button_color', 
				'default'=>'#bbbbbb', 'attr'=>array('background-color'), 'selector'=>'.footer-wrapper .contact-form-wrapper button',
				'description' =>'This color is for the submit button of contact widget.'),
			__('FOOTER PERSONNAL INFO', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_footer_personnal_widget_info', 
				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'div.footer-wrapper .personnal-widget-item .personnal-widget-info'),				
			__('COPYRIGHT TEXT', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_copyright_text_color', 
				'default'=>'#b5b5b5', 'attr'=>array('color'), 'selector'=>'div.copyright-wrapper'),	
		),
		
		'gdl_panel_slider' => array(
			__('SLIDER TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_title_color',
				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'h2.gdl-slider-title' ),
			__('SLIDER CAPTION COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_caption_color',
				'default'=>'#c0c9d2', 'attr'=>array('color'), 'selector'=>'div.gdl-slider-caption'),	
			__('SLIDER CAPTION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_caption_background',
				'default'=>'#151f29', 'attr'=>array('background-color'), 'selector'=>'div.flex-caption, div.nivo-caption, div.anything-caption,' .
					'div.gdl-top-slider .flex-direction-nav li a, div.gdl-top-slider .nivo-directionNav a, div.gdl-top-slider .anythingSlider .arrow'),	
			__('SLIDER THUMBNAIL BACKGROUND ( CAROUSEL )', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_slider_thumbnail_background',
				'default'=>'#000000', 'attr'=>array('background-color'), 'selector'=>'.flex-carousel.carousel-included'),					
			__('STUNNING TEXT TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_title_color',
				'default'=>'#555555', 'attr'=>array('color'), 'selector'=>'h1.stunning-text-title' ),
			__('STUNNING TEXT CAPTION COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_caption_color',
				'default'=>'#656565', 'attr'=>array('color'), 'selector'=>'.stunning-text-caption'),
			__('STUNNING TEXT BACKGROUND COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_background_color',
				'default'=>'#f9f9f9', 'attr'=>array('background-color'), 'selector'=>'.stunning-text-wrapper'),
			__('STUNNING TEXT LEFT BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_left_border',
				'default'=>'#6987a2', 'attr'=>array('border-left-color'), 'selector'=>'.stunning-text-wrapper'),	
			__('STUNNING TEXT BUTTON TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_button_text',
				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'.stunning-text-wrapper a.stunning-text-button, .stunning-text-wrapper a.stunning-text-button:hover'),	
			__('STUNNING TEXT BUTTON BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_stunning_text_button_background',
				'default'=>'#5b7d9d', 'attr'=>array('background-color'), 'selector'=>'.stunning-text-wrapper .stunning-text-button'),					
		),
			
		'gdl_panel_blog_port' => array(
			__('BLOG/PORT FRAME BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_frame_border',
				'default'=>'#e9e9e9', 'attr'=>array('border-color'), 
				'selector'=>'div.blog-media-wrapper, div.portfolio-media-wrapper, .gdl-gallery-image'),		
			__('BLOG/PORT FRAME BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_frame_background',
				'default'=>'#f6f6f6', 'attr'=>array('background-color'), 
				'selector'=>'div.blog-media-wrapper, div.portfolio-media-wrapper, .gdl-gallery-image'),		
			__('PORT TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_title_color',
				'default'=>'#41607d', 'attr'=>array('color'), 'selector'=>'.portfolio-title, .portfolio-title a',
				'description'=>'This is the portfolio item title color.'),
			__('PORT TITLE HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_title_hover_color',
				'default'=>'#8002b8', 'attr'=>array('color'), 'selector'=>'.portfolio-title a:hover'),
			__('PORT FILTER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_filter_color',
				'default'=>'#969696', 'attr'=>array('color'), 'selector'=>'ul.portfolio-item-filter li, ul.portfolio-item-filter li a'),
			__('PORT FILTER ACTIVE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_filter_active_color',
				'default'=>'#5c5c5c', 'attr'=>array('color'), 'selector'=>'ul.portfolio-item-filter li a.active, ul.portfolio-item-filter li a:hover'),				
			__('PORT INFO COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_info_color',
				'default'=>'#7a7a7a', 'attr'=>array('color'), 'selector'=>'div.single-portfolio .port-info'),
			__('PORT INFO HEAD COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_port_info_head_color',
				'default'=>'#404040', 'attr'=>array('color'), 'selector'=>'div.single-portfolio .port-info .head'),				
			__('BLOG TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_title_color',
				'default'=>'#41607d', 'attr'=>array('color'), 'selector'=>'h2.blog-title a, h1.blog-title a' ),
			__('BLOG TITLE HOVER COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_title_hover_color',
				'default'=>'#8aa2b8', 'attr'=>array('color'), 'selector'=>'h2.blog-title a:hover, h1.blog-title a:hover',
				'description'=>'This is the blog thumbnail title color in "hover" state.'),
			__('BLOG READ MORE TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_read_more_text',
				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'.blog-continue-reading' ),					
			__('BLOG READ MORE BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_read_more_background',
				'default'=>'#5b7d9d', 'attr'=>array('background-color'), 'selector'=>'.blog-continue-reading' ),				
			__('BLOG ABOUT AUTHOR BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_post_about_author_color',
				'default'=>'#f5f5f5', 'attr'=>array('background-color'), 'selector'=>'.about-author-wrapper',
				'description'=>'The author item is located in the blog page, you can enable/disable it using the post/portfolio options.'),
			__('PAGINATION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_background',
				'default'=>'#f3f3f3', 'attr'=>array('background-color'), 'selector'=>'div.gdl-pagination a'),
			__('PAGINATION TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_text',
				'default'=>'#7b7b7b', 'attr'=>array('color'), 'selector'=>'div.gdl-pagination a'),
			__('PAGINATION HOVER BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_hover_background',
				'default'=>'#41607d', 'attr'=>array('background-color'), 'selector'=>'div.gdl-pagination a:hover'),
			__('PAGINATION HOVER TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_hover_text',
				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'div.gdl-pagination a:hover'),	
			__('PAGINATION CURRENT BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_current_background',
				'default'=>'#41607d', 'attr'=>array('background-color'), 'selector'=>'div.gdl-pagination span'),
			__('PAGINATION CURRENT TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_pagination_current_text',
				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'div.gdl-pagination span'),						
		),			
		
		// ** set default color in both style-custom.php and theme-customizer.php file.
		'gdl_panel_contact_form' => array(
			__('CONTACT/COMMENT BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_background_color','default'=>'#ffffff',
				'description'=>'This is a background color of textbox and textarea in contact form and comments area.'),
			__('CONTACT/COMMENT TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_text_color','default'=>'#888888',
				'description'=>'This is a text color of textbox and textarea in contact form and comments area.'),
			__('CONTACT/COMMENT BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_border_color','default'=>'#e3e3e3'),
			__('CONTACT/COMMENT FRAME', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_frame_color','default'=>'#f7f7f7'),
			__('CONTACT/COMMENT INNER SHADOW', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_contact_form_inner_shadow','default'=>'#ececec',
				'description'=>'An inner shadow of the textbox and textarea in contact form and comments area.'),
		),		

		
		'gdl_panel_price_personnal_item' => array(
			__('PRICE TITLE/BUTTON BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_title_background', 
				'default'=>'#5687ae', 'attr'=>array('background-color'), 
				'selector'=>'div.price-item, div.price-item .price-title, div.price-item .price-button'),
			__('PRICE TITLE/BUTTON TEXT', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_title_text', 
				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'div.price-item .price-title, div.price-item .price-button'),
			__('PRICE TITLE BOTTOM BORDER', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_title_border', 
				'default'=>'#ffffff', 'attr'=>array('border-color'), 'selector'=>'div.price-item .price-title'),
			__('PRICE TAG COLOR', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_tag_color', 
				'default'=>'#353535', 'attr'=>array('color'), 'selector'=>'div.price-item .price-tag'),
			__('PRICE CONTENT COLOR', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_content_color', 
				'default'=>'#868686', 'attr'=>array('color'), 'selector'=>'div.price-item'),
			__('PRICE CONTENT BORDER', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_content_border', 
				'default'=>'#e0e0e0', 'attr'=>array('border-color'), 'selector'=>'div.price-item .price-tag'),
			__('PRICE CONTENT BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_price_content_background', 
				'default'=>'#f3f3f3', 'attr'=>array('background-color'), 'selector'=>'div.price-item'),
			__('PERSONNAL BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_background', 
				'default'=>'#f9f9f9', 'attr'=>array('background-color'), 'selector'=>'div.personnal-item'),
			__('PERSONNAL POSITION TEXT', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_position_text', 
				'default'=>'#212121', 'attr'=>array('color'), 'selector'=>'div.personnal-item .personnal-position'),
			__('PERSONNAL POSITION BACKGROUND', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_position_background', 
				'default'=>'#e8e8e8', 'attr'=>array('background-color'), 'selector'=>'div.personnal-item .personnal-position'),	
			__('PERSONNAL TITLE', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_title', 
				'default'=>'#404040', 'attr'=>array('color'), 'selector'=>'div.personnal-item .personnal-title'),
			__('PERSONNAL CONTENT', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_content', 
				'default'=>'#373737', 'attr'=>array('color'), 'selector'=>'div.personnal-item .personnal-item'),			
			__('PERSONNAL CAROUSEL NAME', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_widget_name', 
				'default'=>'#6e6e6e', 'attr'=>array('color'), 'selector'=>'div.gdl-carousel-personnal .personnal-name, div.gdl-personnal-widget .personnal-name'),		
			__('PERSONNAL CAROUSEL POSITION', 'gdl_back_office') => array('type'=>'colorpicker', 'name'=>THEME_SHORT_NAME.'_personnal_widget_position', 
				'default'=>'#adadad', 'attr'=>array('color'), 'selector'=>'div.gdl-carousel-personnal ..personnal-position, div.gdl-personnal-widget .personnal-position'),					
		),		

		'gdl_panel_additional_elements' => array(				
			__('ACCORDION TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_accordion_text',
				'default'=>'#8b8b8b', 'attr'=>array('color'), 'selector'=>'ul.gdl-accordion li .accordion-content, ul.gdl-toggle-box li .toggle-box-content'),
			__('ACCORDION TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_accordion_title',
				'default'=>'#909090', 'attr'=>array('color'), 'selector'=>'ul.gdl-accordion li .accordion-title, ul.gdl-toggle-box li .toggle-box-title'),
			__('ACCORDION BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_accordion_background',
				'default'=>'#f9f9f9', 'attr'=>array('background-color'), 'selector'=>'ul.gdl-accordion li, ul.gdl-toggle-box li'),
			__('BLOCKQUOTE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_blockquote_color',
				'default'=>'#ababab', 'attr'=>array('color'), 'selector'=>'blockquote'),
			__('BLOCKQUOTE BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_blockquote_border',
				'default'=>'#cfcfcf', 'attr'=>array('border-color'), 'selector'=>'body blockquote'),
			__('BUTTON BACKGROUND COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_button_background_color',
				'default'=>'#698dab', 'attr'=>array('background-color'), 'selector'=>'a.gdl-button, body button, input[type="submit"], input[type="reset"], input[type="button"]'),					
			__('BUTTON TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_button_text_color',
				'default'=>'#ffffff', 'attr'=>array('color'), 'selector'=>'a.gdl-button, body button, input[type="submit"], input[type="reset"], input[type="button"]'),			
			__('COLUMN SERVICE TITLE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_column_service_title_color',
				'default'=>'#525252', 'attr'=>array('color'), 'selector'=>'h2.column-service-title'),					
		),
		
		'gdl_panel_additional_elements_2' => array(
			__('DIVIDER LINE COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_divider_line',
				'default'=>'#dcdcdc', 'attr'=>array('border-color'), 'selector'=>'body *',
				'description'=>'This is the color of all divider inside the container( excluding divider of the footer ).'),
			__('DIVIDER ITEM BACK TO TOP TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_back_to_top_text_color',
				'default'=>'#919191', 'attr'=>array('color'), 'selector'=>'.scroll-top',
				'description'=>'This is the back to top text color of the divider item ( create from page items or shortcode ).'),				
			__('TABLE BORDER (TABLE TAG)', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_table_border',
				'default'=>'#e5e5e5', 'attr'=>array('border-color'), 'selector'=>'table, table tr, table tr td, table tr th' ),
			__('TABLE TITLE TEXT COLOR (TH TAG)', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_table_text_title',
				'default'=>'#666666', 'attr'=>array('color'), 'selector'=>'table th'),
			__('TABLE TITLE BACKGROUND (TH TAG)', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_table_title_background',
				'default'=>'#fdfdfd', 'attr'=>array('background-color'), 'selector'=>'table th'),			
			__('TAB BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_background_color',
				'default'=>'#f5f5f5', 'attr'=>array('background-color'), 
				'selector'=>'div.gdl-tab ul.gdl-tab-content, div.gdl-tab ul.gdl-tab-title a.active',
				'description'=>'This is the tab background and header in active state.'),
			__('TAB TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_text_color',
				'default'=>'#969696', 'attr'=>array('color'), 'selector'=>'div.gdl-tab ul.gdl-tab-content' ),
			__('TAB TITLE TEXT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_title_text',
				'default'=>'#a2a2a2', 'attr'=>array('color'), 'selector'=>'div.gdl-tab ul.gdl-tab-title a' ),	
			__('TAB TITLE BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_title_background',
				'default'=>'#ffffff', 'attr'=>array('background-color'), 'selector'=>'div.gdl-tab ul.gdl-tab-title a' ),	
			__('TAB ACTIVE TEXT COLOR', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_tab_active_text_color',
				'default'=>'#656565', 'attr'=>array('color'), 'selector'=>'div.gdl-tab ul.gdl-tab-title a.active' ),	
			__('TESTIMONIAL (SLIDE) CONTENT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_slide_content',
				'default'=>'#a7a7a7', 'attr'=>array('color'), 'selector'=>'div.gdl-carousel-testimonial .testimonial-content'),
			__('TESTIMONIAL (SLIDE) BACKGROUND', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_slide_background',
				'default'=>'#f9f9f9', 'attr'=>array('background-color'), 'selector'=>'div.gdl-carousel-testimonial div.testimonial-content'),
			__('TESTIMONIAL (SLIDE) INFO NAME', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_slide_info_author',
				'default'=>'#545454', 'attr'=>array('color'), 'selector'=>'div.gdl-carousel-testimonial .testimonial-info span.tetimonial-author'),
			__('TESTIMONIAL (SLIDE) INFO POSITION', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_slide_info_position',
				'default'=>'#939393', 'attr'=>array('color'), 'selector'=>'div.gdl-carousel-testimonial .testimonial-info span.testimonial-position'),
			__('TESTIMONIAL (STATIC) CONTENT', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_static_content',
				'default'=>'#bbbbbb', 'attr'=>array('color'), 'selector'=>'div.gdl-static-testimonial .testimonial-content'),				
			__('TESTIMONIAL (STATIC) BORDER', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_static_border',
				'default'=>'#ebebeb', 'attr'=>array('border-color'), 'selector'=>'div.gdl-static-testimonial .testimonial-item'),
			__('TESTIMONIAL (STATIC) INFO', 'gdl_back_office')=>array('type'=>'colorpicker','name'=>THEME_SHORT_NAME.'_testimonial_static_info',
				'default'=>'#8a8a8a', 'attr'=>array('color'), 'selector'=>'div.gdl-static-testimonial .testimonial-info'),				
		),
		
		'gdl_panel_load_default_color' => array(
			__('LOAD DEFAULT ELEMENTS COLOR','gdl_back_office')=>array('type'=>'button','text'=>'Load Default','id'=>'gdl_load_default_color_button',
				'description'=>'Click this button to load the default elements color of this theme. Then click save changes to save the default value. <br><br> ' .
				'WARNING : All of settings cannot be undo after you click save changes button.')
		),
		
		// Translator
		'gdl_panel_enable_admin_translator' => array(
			__('ENABLE ADMIN TRANSLATOR', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=>THEME_SHORT_NAME.'_enable_admin_translator')
		),
		
		'gdl_panel_blog_port_translator' => array(
			__('SOCIAL SHARE (BLOG/PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_social_shares','default'=>'Social Share'),
			__('LEAVE A REPLY (BLOG)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_leave_reply','default'=>'Leave a Reply'),
			__('ABOUT THE AUTHOR (BLOG)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_about_author','default'=>'About the Author'),
			__('CONTINUE READING (BLOG)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_continue_reading','default'=>'READ MORE'),

			__('ALL (PORTFOLIO FILTER)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_all','default'=>'All'),			
			__('TAG (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_tag','default'=>'Tags: '),
			__('CLIENT (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_client','default'=>'Client: '),
			__('SKILL (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_skill','default'=>'Skill: '),
			__('VISIT WEBSITE (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_visit_website','default'=>'Visit Website: '),
			__('RELATED PORTFOLIO (PORTFOLIO)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_related_portfolio','default'=>'Related Portfolio'),
			
		),
		
		'gdl_panel_contact_form_translator' => array(
			__('NAME (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_name_contact_form','default'=>'Name'),
			__('NAME ERROR (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_name_error_contact_form','default'=>'Please enter your name'),
			__('EMAIL (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_email_contact_form','default'=>'Email'),
			__('EMAIL ERROR (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_email_error_contact_form','default'=>'Please enter a valid email address'),
			__('MESSAGE (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_message_contact_form','default'=>'Message'),
			__('MESSAGE ERROR (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_message_error_contact_form','default'=>'Please enter message'),
			__('SUBMIT BUTTON (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_submit_contact_form','default'=>'Submit'),
			__('SEND ERROR (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_contact_send_error','default'=>'Message cannot be sent to destination'),
			__('SEND COMPLETE (CONTACT FORM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_contact_send_complete','default'=>'The e-mail was sent successfully'),
		),

		'gdl_panel_additional_elements_translator' => array(
			__('READ MORE (PRICE ITEM)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_translator_read_more_price','default'=>'Read More'),
			__('404 TITLE (404 PAGE)', 'gdl_back_office')=>array('type'=>'inputtext','name'=>THEME_SHORT_NAME.'_404_title','default'=>'Page Not Found'),
			__('404 CONTENT (404 PAGE)', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_404_content','default'=>"The page you are looking for doesn't seem to exist."),
			__('SEARCH TITLE (SEARCH PAGE)', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_translator_search_header','default'=>"Search"),
			__('SEARCH NOT FOUND TITLE (SEARCH PAGE)', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_search_not_found_title','default'=>"Search Not Found."),
			__('SEARCH NOT FOUND (SEARCH PAGE)', 'gdl_back_office')=>array('type'=>'textarea','name'=>THEME_SHORT_NAME.'_search_not_found','default'=>"Sorry, but nothing matched your search criteria. Please try again with some different keywords."),
		),
		
		// Slider Setting
		'gdl_panel_nivo_slider' => array(
			__('SLIDER EFFECTS', 'gdl_back_office')=>array(
				'type'=>'combobox',
				'oldname'=>'effect',
				'name'=>THEME_SHORT_NAME.'_nivo_slider_effect',
				'options'=>array(
					'0'=>'sliceDown', '1'=>'sliceDownLeft', '2'=>'sliceUp',
					'3'=>'sliceUpLeft', '4'=>'sliceUpDown', '5'=>'sliceUpDownLeft',
					'6'=>'fold', '7'=>'fade', '8'=>'random',
					'9'=>'slideInRight', '10'=>'slideInLeft', '11'=>'boxRandom',
					'12'=>'boxRain', '13'=>'boxRainReverse', '14'=>'boxRainGrow',
					'15'=>'boxRainGrowReverse')),
			__('PAUSE ON HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_SHORT_NAME.'_nivo_slider_pause_on_hover',
				'description'=>'Pause the nivo slider when user hover at the slider.'),
			__('SHOW BULLETS', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'controlNav','name'=>THEME_SHORT_NAME.'_nivo_slider_show_bullets',
				'description'=>'Enable to show the nivo slider navigation bullets.'),
			__('SHOW LEFT/RIGHT NAVIGATION', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'directionNav','name'=>THEME_SHORT_NAME.'_nivo_slider_show_navigation',
				'description'=>'Enable left/right navigation of the nivo slider.'),
			__('ONLY SHOW NAVIGATION WHEN HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'directionNavHide','name'=>THEME_SHORT_NAME.'_nivo_slider_hover_navigation', 'default'=>'disable',
				'description'=>'If the left/right navigation is enabled, enable this option will hide the left/right navigation when the mouse cursor is outside the nivo slider frame.'),
			__('ANIMATION SPEED', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'animSpeed','name'=>THEME_SHORT_NAME.'_nivo_slider_animation_speed','default'=>'500',
				'description'=>'This is the animation speed during the change of each slide.'),
			__('PAUSE TIME', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'pauseTime','name'=>THEME_SHORT_NAME.'_nivo_slider_pause_time','default'=>'12000',
				'description'=>'This option is the pause time of each slider.'),
		),
		
		'gdl_panel_plugin_enable' => array(
			__('COMMENT CAPTCHA', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=>THEME_SHORT_NAME.'_enable_comment_captcha',
				'description'=>'Disabling this to remove captcha out of the comment.'),
			__('LIGHT BOX THUMBNAIL', 'gdl_back_office')=>array('type'=>'radioenabled', 'name'=>THEME_SHORT_NAME.'_enable_lightbox_thumbnail',
				'description'=>'Enabling the lightbox thumbnail. ( When it\'s gallery mode)'),		
			__('LIGHT BOX THUMBNAIL WIDHT', 'gdl_back_office')=>array('type'=>'inputtext', 'name'=>THEME_SHORT_NAME.'_enable_lightbox_thumbnail_width', 'default'=>'80'),
			__('LIGHT BOX THUMBNAIL HEIGHT', 'gdl_back_office')=>array('type'=>'inputtext', 'name'=>THEME_SHORT_NAME.'_enable_lightbox_thumbnail_height', 'default'=>'45'),
		),
		
		'gdl_panel_flex_slider' => array(
			__('SLIDER EFFECTS', 'gdl_back_office')=>array('type'=>'combobox','oldname'=>'animation'
				,'name'=>THEME_SHORT_NAME.'_flex_slider_effect', 'options'=>array('0'=>'fade', '1'=>'slide')),
			__('PAUSE ON HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_SHORT_NAME.'_flex_slider_pause_on_hover',
				'description'=>'Pause the flex slider when user hover at the slider.'),
			__('SHOW BULLETS', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'controlNav','name'=>THEME_SHORT_NAME.'_flex_slider_show_bullets',
				'description'=>'Enable to show the flex slider navigation bullets.'),
			__('SHOW NAVIGATION', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'directionNav','name'=>THEME_SHORT_NAME.'_flex_slider_show_navigation',
				'description'=>'Enable left/right navigation of the flex slider.'),
			__('ANIMATION SPEED', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'animationSpeed','name'=>THEME_SHORT_NAME.'_flex_slider_animation_speed','default'=>'600',
				'description'=>'This is the animation speed during the change of each slide.'),
			__('PAUSE TIME', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'slideshowSpeed','name'=>THEME_SHORT_NAME.'_flex_slider_pause_time','default'=>'12000',
				'description'=>'This option is the pause time of each slider.'),
			__('PAUSE ON ACTION', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'pauseOnAction','name'=>THEME_SHORT_NAME.'_flex_slider_pause_on_action','default'=>'false'),
			__('CAROUSEL THUMBNAIL WIDTH', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'thumbnail_width','name'=>THEME_SHORT_NAME.'_flex_thumbnail_width','default'=>'75'),			
			__('CAROUSEL THUMBNAIL HEIGHT', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'thumbnail_height','name'=>THEME_SHORT_NAME.'_flex_thumbnail_height','default'=>'50'),			
		),
		
		'gdl_panel_anything_slider' => array(
			__('PAUSE ON HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_SHORT_NAME.'_anything_slider_pause_on_hover',
				'description'=>'Pause the anything slider when user hover at the slider.'),
			__('SHOW BULLETS', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'buildNavigation','name'=>THEME_SHORT_NAME.'_anything_slider_show_bulltes',
				'description'=>'Enable to show the anything slider navigation bullets.'),
			__('ONLY SHOW BULLETS WHEN HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'toggleControls','name'=>THEME_SHORT_NAME.'_anything_slider_hover_bulltes', 'default'=>'disable',
				'description'=>'If the bullets navigation is enabled, enable this option will hide the bullets navigation when the mouse cursor is outside the nivo slider frame.'),
			__('SHOW NAVIGATION', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'buildArrows','name'=>THEME_SHORT_NAME.'_anything_slider_show_navigation',
				'description'=>'Enable left/right navigation of the anything slider.'),
			__('ONLY SHOW NAVIGATION WHEN HOVER', 'gdl_back_office')=>array('type'=>'radioenabled','oldname'=>'toggleArrows','name'=>THEME_SHORT_NAME.'_anything_slider_hover_navigation', 'default'=>'disable',
				'description'=>'If the left/right navigation is enabled, enable this option will hide the left/right navigation when the mouse cursor is outside the nivo slider frame.'),
			__('ANIMATION SPEED', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'animationTime','name'=>THEME_SHORT_NAME.'_anything_slider_animation_speed','default'=>'600',
				'description'=>'This is the animation speed during the change of each slide.'),
			__('PAUSE TIME', 'gdl_back_office')=>array('type'=>'inputtext','oldname'=>'delay','name'=>THEME_SHORT_NAME.'_anything_slider_pause_time','default'=>'12000',
				'description'=>'This option is the pause time of each slider.'),
		),
		
		'gdl_panel_disable_right_click' => array(
			__('DISABLE RIGHT CLICK', 'gdl_back_office')=>array('type'=>'radioenabled','name'=> THEME_SHORT_NAME.'_disable_right_click', 'default'=>'disable'),
			__('ALERT MSG', 'gdl_back_office')=>array('type'=>'textarea','name'=> THEME_SHORT_NAME.'_right_click_alert',
				'description'=>'If this filed is not empty, there\'ll be alert box show up when user using the right click.'),
		),		
		
	);
	
	// add action to embeded the panel in to dashboard
	add_action('admin_menu','add_goodlayers_panel');
	function add_goodlayers_panel(){
	
		$page = add_menu_page('GoodLayers Option', THEME_FULL_NAME, 'administrator', 'goodlayers_admin_panel', 'create_goodlayers_panel' /*,  GOODLAYERS_PATH.'/include/images/portfolio-icon.png' */);
		
		add_action('admin_print_scripts-' . $page,'register_goodlayers_panel_scripts');
		add_action('admin_print_styles-' . $page,'register_goodlayers_panel_styles');
		
	}
	
	// add ajax action to hook the functions when save button is pressed 
	add_action('wp_ajax_save_goodlayers_panel','save_goodlayers_panel');
	function save_goodlayers_panel(){
	
		check_ajax_referer(plugin_basename(__FILE__),'security');
		
		global $goodlayers_element;
		
		$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');
		
		foreach($goodlayers_element as $elements){
		
			foreach($elements as $element){
			
				// when save sidebar
				if($element['type'] == 'sidebar'){
				
					$sidebar_xml = '<sidebar>';
					if( !empty( $_POST[$element['name']] ) ){
						$sidebar = $_POST[$element['name']];     
					}else{
						$sidebar = array();
					}
					
					foreach($sidebar as $sidebar_name){
					
						$sidebar_xml = $sidebar_xml . create_xml_tag('name',$sidebar_name);
						
					}
					
					$sidebar_xml = $sidebar_xml . '</sidebar>';
					
					if(!save_option($element['name'], get_option($element['name']), $sidebar_xml)){
					
						die( json_encode($return_data) );
						
					}
					
				// when save uploaded font
				}else if($element['type'] == 'uploadfont'){
				
					$uploadfont_xml = '<uploadfont>';
					if( !empty($_POST[$element['name']]) && !empty($_POST[$element['file']]) ){
						$uploadfont = $_POST[$element['name']];
						$uploadfont_file = $_POST[$element['file']];
						$num = sizeof($uploadfont);
						
						for($i=0; $i<$num; $i++){
						
							$uploadfont_xml = $uploadfont_xml . '<font>';
							$uploadfont_xml = $uploadfont_xml . create_xml_tag('name', $uploadfont[$i]);
							$uploadfont_xml = $uploadfont_xml . create_xml_tag('file', $uploadfont_file[$i]);
							$uploadfont_xml = $uploadfont_xml . '</font>';
							
						}
					}
					$uploadfont_xml = $uploadfont_xml . '</uploadfont>';
					
					if(!save_option($element['name'], get_option($element['name']), $uploadfont_xml)){
					
						die( json_encode($return_data) );
						
					}
					
				// do nothing with dummy button
				}else if($element['type'] == 'dummy'){
				
				}else if( !empty($element['name']) ){
					if( !empty( $_POST[$element['name']] ) ){
						$new_option_value = str_replace( "\'" , "'", $_POST[$element['name']]);
						$new_option_value = str_replace( '\"' , '"', $new_option_value);
						$new_option_value = str_replace( '\\\\' , '\\' , $new_option_value);
					}else{
						$new_option_value = '';
					}
					
					if(!save_option($element['name'], get_option($element['name']), $new_option_value)){
					
						die( json_encode($return_data) );
						
					}
					
				}
				
			}
			
		}
		
		// call the function to generate the style-custom.css file.
		gdl_generate_style_custom();
		
		die( json_encode( array('success'=>'0') ) );
		
	}
	
	// update the option if new value is exists and not equal to old one 
	function save_option($name, $old_value, $new_value){
	
		if(empty($new_value) && !empty($old_value)){
		
			if(!delete_option($name)){
			
				return false;
				
			}
			
		}else if($old_value != $new_value){
		
			if(!update_option($name, $new_value)){
			
				return false;
				
			}
			
		}
		
		return true;
		
	}
	
	// start creating the goodlayers panel ( by calling function to create menu and elements )
	function create_goodlayers_panel(){
	
		global $goodlayers_menu;
		global $goodlayers_element;		
		
		?>
		
		<form name="goodlayer-panel-form" id="goodlayer-panel-form">
			<div class="goodlayers-panel-wrapper">
			<?php
				
				echo '<div class="panel-menu">';
				echo '<div class="panel-menu-header"><div class="panel-menu-header-strap"></div>';
				echo '<img src="' . GOODLAYERS_PATH . '/include/images/admin-panel-logo.png" alt="goodlayers"/>';
				echo '</div>';
				
					create_goodlayers_menu($goodlayers_menu);
					
				echo '</div>';
				echo '<div class="panel-elements" id="panel-elements">';
				echo '<div class="panel-element-head"><div class="panel-element-header-strap"></div>';
				
				echo '<div class="panel-header-left-text">';
				echo '<div class="panel-goodlayers-text">goodlayers</div>';
				echo '<div class="panel-admin-panel-text">admin panel</div>';
				echo '</div>';
				
				echo '<div class="head-save-changes"><div class="loading-save-changes"></div>';
				echo '<input type="submit" value="' . __('Save Changes','gdl_back_office') . '">';
				echo '</div>';	
				echo '</div>';	
				
				echo '<div class="panel-element" id="panel-element-save-complete">';
				echo '<div class="panel-element-save-text">Save Options Complete.</div>';
				echo '<div class="panel-element-save-arrow"></div></div>';
			
					create_goodlayers_elements($goodlayers_element);
				
				echo '<div class="panel-element-tail">';
				echo '<div class="tail-save-changes"><div class="loading-save-changes"></div>';
				echo '<input type="submit" value="' . __('Save Changes','gdl_back_office') . '">';
				echo '</div>';						
				echo '</div>';						
				echo '<input type="hidden" name="action" value="save_goodlayers_panel">';
				echo '<input type="hidden" name="security" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '">';
				echo '</div>';	
				
			?>

			</div>
		</form>
		
		<?php
	}
	
	// Create accordion menu
	function create_goodlayers_menu($menu){
	
		echo '<div id="panel-nav"><ul>';
		
		foreach($menu as $title=>$sub_menu){ 
		
			echo '<li>';
			echo '<a id="parent" href="#" >';
			echo '<div class="top-menu-bar"></div>';
			echo '<div class="top-menu-image"><img src="' . GOODLAYERS_PATH . '/include/images/admin-panel/' . str_replace(' ', '', $title) . '.png"/></div>';
			echo '<span class="top-menu-text">' . __($title, 'gdl_back_office') . '</span>';
			echo '</a>';
			echo '<ul>';
			
			foreach($sub_menu as $sub_title=>$name){
			
				echo '<li>';
				echo '<a id="children" href="#" rel=' . $name . '>';
				echo '<div class="child-menu-image"></div>';
				echo '<span class="child-menu-text">' . __($sub_title, 'gdl_back_office') . '</span>';
				echo '</a>';
				echo '</li>';
				
			}
			
			echo '</ul>';
			echo '</li>';
			
		}
		
		echo '</ul></div>';
		
	}
	
	// decide to create each input element base on the receiving key of elements
	function create_goodlayers_elements($elements){
	
		foreach($elements as $key => $element){
		
			echo '<div class="panel-element" id=' . $key . '>';

				foreach($element as $key => $values){
				
					if( !empty($values['name']) ){
						$values['value'] = get_option($values['name']);
						$values['default'] = (isset($values['default']))? $values['default']: '';
					}
					
					switch($values['type']){
					
						case 'upload': print_panel_upload($key, $values); break;
						case 'inputtext': print_panel_input_text($key, $values); break;
						case 'textarea': print_panel_input_textarea($key, $values); break;
						case 'radioenabled': print_panel_radio_enabled($key, $values); break;
						case 'radioimage' : print_panel_radioimage($key, $values); break;
						case 'combobox': print_panel_combobox($key, $values); break;
						case 'font-combobox': print_panel_font_combobox($key, $values); break;
						case 'colorpicker': print_panel_color_picker($key, $values); break;
						case 'sliderbar': print_panel_sliderbar($key, $values); break;
						case 'sidebar': print_panel_sidebar($key, $values); break;
						case 'uploadfont': print_panel_upload_font($key, $values); break;
						case 'button': print_panel_button($key, $values); break;
						case 'dummy': print_panel_dummy(); break;
						
					}
					
				}
			
			echo '</div>';
			
		}
		
	}
	
	/*  ---------------------------------------------------------------------
	*	The following section is the template of input elements
	*	---------------------------------------------------------------------
	*/
	
	// Upload => name, value, default
	function print_panel_upload($title, $values){
	
		extract($values);
		if( empty( $body_class ) ){ $body_class = $name; }
		
		?>
			<div class="panel-body body-<?php echo $body_class; ?>">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php _e($title, 'gdl_back_office'); ?> </label>
				</div>
				<div class="panel-input">	
					<div class="input-example-image" id="input-example-image">
					<?php 
					
						$image_src = '';
						
						if(!empty($value)){ 
						
							$image_src = wp_get_attachment_image_src( $value, 'full' );
							$image_src = (empty($image_src))? '': $image_src[0];
							$thumb_src_preview = wp_get_attachment_image_src( $value, 'thumbnail');
							echo '<img src="' . $thumb_src_preview[0] . '" />';
							
						} 
						
					?>			
					</div>
					<input name="<?php echo $name; ?>" type="hidden" id="upload_image_attachment_id" value="<?php 
					
						echo ($value == '')? esc_html($default): esc_html($value);
						
					?>" />
					<input id="upload_image_text" class="upload_image_text" type="text" value="<?php echo $image_src; ?>" />
					<input class="upload_image_button" type="button" value="Upload" />
				</div>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// text => name, value, default
	function print_panel_input_text($title, $values){
	
		extract($values);
		
		?>
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php _e($title, 'gdl_back_office'); ?> </label>
				</div>
				<div class="panel-input">
					<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php 
						
						echo ($value == '')? esc_html($default): esc_html($value);
						
						 ?>" />
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
	
	}
	
	// textarea => name, value, default
	function print_panel_input_textarea($title, $values){
	
		extract($values);
		if( empty( $body_class ) ){ $body_class = ''; }
		
		?>
		
			<div class="panel-body <?php echo $body_class; ?>">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="panel-input">
					<textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" ><?php
						
						echo ($value == '')? esc_html($default): esc_html($value);
						
					?></textarea>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// radioenabled => name, value
	function print_panel_radio_enabled($title, $values){
	
		extract($values);
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="panel-input">
					<label for="<?php echo $name; ?>"><div class="checkbox-switch <?php
						
						echo ($value=='enable' || ($value=='' && empty($default)))? 'checkbox-switch-on': 'checkbox-switch-off'; 

					?>"></div></label>
					<input type="checkbox" name="<?php echo $name; ?>" class="checkbox-switch" value="disable" checked>
					<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="checkbox-switch" value="enable" <?php 
						
						echo ($value=='enable' || ($value=='' && empty($default)))? 'checked': ''; 
					
					?>>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	function print_panel_radioimage($title, $values){
		
		extract($values);
		
		if( empty( $body_class ) ){ $body_class = $name; }
		
		?>
		
			<div class="panel-body body-<?php echo $body_class; ?>">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="panel-radioimage">
				
					<?php foreach( $options as $option ){ ?>
					
						<div class='radio-image-wrapper'>
							<label for="<?php echo $option['value']; ?>">
								<img src=<?php echo GOODLAYERS_PATH.$option['image']?> alt=<?php echo $name;?>>
								<div id="check-list"></div>
							</label>
							<input type="radio" name="<?php echo $name; ?>" value="<?php echo $option['value'];?>" <?php 
								if($value == $option['value']){
									echo 'checked';
								}else if($value == '' && $default == $option['value']){
									echo 'checked';
								}
							?> id="<?php echo $option['value']; ?>" class="<?php echo $name; ?>" > 
						</div>
						
					<?php } ?>
					<br class="clear">	
				</div>
			</div>		
		
		<?php
		
	}
	
	// combobox => name, value, options[]
	function print_panel_combobox($title, $values){
	
		extract($values);
		
		if( empty($body) ) $body = "";
		if( empty($id) ) $id = $name;
		
		?>
		
			<div class="panel-body <?php echo $body; ?>">	
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="panel-input">	
					<div class="combobox">
						<select name="<?php echo $name; ?>" id="<?php echo $id; ?>">
						
							<?php foreach($options as $option){ ?>
							
								<option <?php if( $option == esc_html($value) ){ echo 'selected'; }?>><?php echo $option; ?></option>
							
							<?php } ?>
							
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}	
	
	// font-combobox => name, value, options[]
	function print_panel_font_combobox($title, $values){
	
		extract($values);
		if(empty($value)){ $value = $default; } 
		$elements = get_font_array();
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php _e($title, 'gdl_back_office'); ?></label>
				</div>
				<div class="panel-input">	
					<div class="panel-font-sample" id="panel-font-sample"><?php echo FONT_SAMPLE_TEXT; ?></div> 
					<div class="combobox" id="combobox-font-sample">
						<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="gdl-panel-select-font-family">
						
							<?php foreach($elements as $option_name => $status){ ?>
							
								<option <?php if( $option_name==substr(esc_html($value),2) ){ echo 'selected'; }?> <?php echo $status; ?>><?php 
										
										echo ($status=='enabled')?  '- ':'';
										echo $option_name; 
									
									?></option>
							
							<?php } ?>
							
						</select>
					</div>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}	
	
	// colorpicker => name, value, default
	function print_panel_color_picker($title, $values){
	
		extract($values);
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php _e($title, 'gdl_back_office'); ?> </label>
				</div>
				<div class="panel-input">
					<input type="text" name="<?php echo $name; ?>" class="color-picker" value="<?php 
												
						if($value == '' || $value == 'transparent'){ echo esc_html($default);
						}else{ echo esc_html($value); }
						
						?>" default="<?php echo $default; ?>" />
					<div class="color-transparent-wrapper">
						<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="color-transparent" value="transparent" <?php 
							
							if($value == 'transparent') echo 'checked';
							
						?>/> <span class="color-transparent"><label for="<?php echo $name; ?>"> transparent </label></span>
					</div>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
	}
	
	// sliderbar => name, value, default
	function print_panel_sliderbar($title, $values){
	
		extract($values);
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php _e($title, 'gdl_back_office'); ?> </label>
				</div>
				<div class="panel-input">
					<div id="<?php echo $name; ?>" class="sliderbar" rel="sliderbar"></div>
					<input type="hidden" name="<?php echo $name; ?>" value="<?php echo ($value == '')? esc_html($default): esc_html($value); ?>" >
					<div id="slidertext"><?php echo ($value == '')? esc_html($default): esc_html($value); ?> px</div>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// sidebar => name, value
	function print_panel_sidebar($title, $values){
	
		extract($values);
		
		?>
		
		<div class="panel-body" id="panel-body">
			<div class="panel-body-gimmick"></div>
			<div class="panel-title">
				<label> <?php _e($title, 'gdl_back_office'); ?> </label>
			</div>
			<div class="panel-input">
				<input type="text" id="add-more-sidebar" value="type title here" rel="type title here">
				<div id="add-more-sidebar" class="add-more-sidebar"></div>
			</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					
				<?php } ?>
			<br class="clear">
			<div id="selected-sidebar" class="selected-sidebar">
				<div class="default-sidebar-item" id="sidebar-item">
					<div class="panel-delete-sidebar"></div>
					<div class="slider-item-text"></div>
					<input type="hidden" id="<?php echo $name; ?>">
				</div>
				
				<?php 
				
				if(!empty($value)){
					
					$xml = new DOMDocument();
					$xml->loadXML($value);
					
					foreach( $xml->documentElement->childNodes as $sidebar_name ){
					
				?>
						<div class="sidebar-item" id="sidebar-item">
							<div class="panel-delete-sidebar"></div>
							<div class="slider-item-text"><?php echo $sidebar_name->nodeValue; ?></div>
							<input type="hidden" name="<?php echo $name; ?>[]" id="<?php echo $name; ?>" value="<?php echo $sidebar_name->nodeValue; ?>">
						</div>
					
				<?php 
					} 
					
				} 
				
				?>
				
			</div>
		</div>
		<?php 
		
	}
	
	// uploadfont => name, value
	function print_panel_upload_font($title, $values){
	
		extract($values);
		
		?>
		
		<div class="panel-body" id="panel-body">
			<div class="panel-body-gimmick"></div>
			<div class="panel-title panel-add-more-title">
				<?php _e($title, 'gdl_back_office'); ?>
			</div>
			<div id="add-more-font" class="add-more-font"></div>
			<br class="clear">
			<div id="added-font" class="added-font">
				<div class="default-font-item" id="font-item">
					<div class="inner-font-item">
						<div class="panel-font-title"><?php _e('Font Name','gdl_back_office'); ?></div>
						<input type="text" id="<?php echo $name; ?>" class="gdl_upload_font_name" readonly>
					</div>
					<div class="inner-font-item">
						<div class="panel-font-title"><?php _e('Font File','gdl_back_office'); ?></div>
						<input type="hidden" id="<?php echo $file; ?>"  class="font-attachment-id">
						<input type="text" class="upload-font-text" readonly>
						<input class="upload-font-button" type="button" value="Upload" />
					</div>
					<div class="panel-delete-font"></div>
				</div>
				<?php 
				
					if(!empty($value)){
						
						$xml = new DOMDocument();
						$xml->loadXML($value);
						
						foreach( $xml->documentElement->childNodes as $each_font ){
						
				?>
				
					<div class="font-item" id="font-item">
						<div class="inner-font-item">
							<div class="panel-font-title"><?php _e('Font Name','gdl_back_office'); ?></div>
							<input type="text" name="<?php echo $name; ?>[]" id="<?php echo $name; ?>" value="<?php echo find_xml_value($each_font, 'name'); ?>" class="gdl_upload_font_name" readonly>
						</div>
						<div class="inner-font-item">
							<div class="panel-font-title"><?php _e('Font File','gdl_back_office'); ?></div>
							<input type="hidden" name="<?php echo $file; ?>[]" id="<?php echo $file; ?>" class="font-attachment-id" value="<?php 
									$attachment_id = find_xml_value($each_font, 'file'); 
									echo $attachment_id;
								?>" >
							<input type="text" class="upload-font-text" value="<?php echo (empty($attachment_id))? '': wp_get_attachment_url( $attachment_id ); ?>" readonly>
							<input class="upload-font-button" type="button" value="Upload" />
						</div>
						<div class="panel-delete-font"></div>
					</div>
					
				<?php 
				
						}
						
					}
					
				?>
				
			</div>
		</div>
		<?php
		
	}
	
	// print normal button
	function print_panel_button($title, $values){
	
		extract($values);
	
		?>

			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label> <?php _e($title, 'gdl_back_office'); ?> </label>
				</div>
				<div class="panel-input">
					<input type="button" value="<?php echo $text; ?>" id="<?php echo $id; ?>" />
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php _e($description, 'gdl_back_office'); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>		
		
		<?php	
	}
	
	// upload dummy data (from xml file)
	function print_panel_dummy(){
		?>

			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label> DUMMIES DATA </label>
				</div>
				<div class="panel-input">
					<input type="button" value="Import Dummies Data" id="import-dummies-data" />
					<div id="import-now-loading" class="now-loading"></div>
				</div>
				<div class="panel-description">
					By clicking this button, you can import the dummy post and page to help 
					you create a site that look like theme preview to help you understand the
					function of this theme better. <br><br>
					*** It may takes a while during importing process, make sure not to reload
					the page or make any changes to the database.
				</div>
				<div class="panel-description-info-img"></div>
				<br class="clear">
			</div>		
		
		<?php
	}
?>