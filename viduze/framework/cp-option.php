<?php

	/*	
	*	CrunchPress Options File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file contains the CrunchPress panel elements and create the 
	*	CrunchPress panel at the back-end of the framework
	*	---------------------------------------------------------------------
	*/
	
		
	// CrunchPress panel navigation elements
	
         $crunchpress_menu = array(				
		    'General' => array(
		    'Logo'=>'cp_panel_logo',
			'Favicon'=>'cp_panel_favicon',
			'Google Analytics'=>'cp_panel_google_analytics',
			'SEO'=>'cp_panel_seo',
			'RTL'=>'cp_panel_rtl',
			'Twitter'=>'cp_panel_twitter',
			'Copyright Area'=>'cp_panel_copyright_area',
			),
		'Layout' => array(
			'Page Style'=>'cp_panel_page_style',
			'Footer Options'=>'cp_panel_footer_style',
			),
		'Styling' => array(
			'Colors'=>'cp_panel_load_other_color',
			'Background'=>'cp_panel_background',
			'Custom Styling'=>'cp_panel_custom_style',
			),	
		'Sidebar'=> array(
			'Sidebar Generator'=>'cp_panel_sidebar',
			),	
		'Typography' => array(
			'Font Family'=>'cp_panel_font',
			'Font Size'=>'cp_panel_font_size',
			'Upload Font'=>'cp_panel_upload_font'),
//		'Sliders' => array(
//			'Nivo Slider'=>'cp_panel_nivo_slider',
//			'Flex Slider'=>'cp_panel_flex_slider'),
		    'Dummy Content' => array(
			'Dummy Content'=>'cp_panel_dummy_content'),
		__('Buddypress', 'crunchpress') => array(
		__('BP Page Options', 'crunchpress')=>'cp_panel_bg_page',
		),	
	);
	
	$woo_options_arr= array(	
		 __('WooCommerce', 'crunchpress') => array(
			__('Products Page Style', 'crunchpress')=>'cp_panel_products_page',
			__('Products Page Title', 'crunchpress')=>'cp_panel_products_page_title',
			__('Install', 'crunchpress')=>'cp_panel_products_page_hmk',
			),
 	 );	
	
	// WooCommerce Options Array
    $woo_options_arr= array(	
		 __('WooCommerce', 'crunchpress') => array(
			__('Shop Page Options', 'crunchpress')=>'cp_panel_products_page',
		),
 	);	
	
	// WooCommerce Options Array when not installed
    $woo_options_arr_not_installed= array(	
		 __('WooCommerce', 'crunchpress') => array(
		 __('Install', 'crunchpress')=>'cp_panel_products_page_hmk',
		),
 	);	
	
	// WooCommerce Options Array
	$woo_elements_arr= array(
		'cp_panel_products_page' => array(
		  __('Products Archive/Category Page Sidebar', 'crunchpress')=>array(
				'type'=>'radioimage',
				'name'=>THEME_NAME_S.'_products_page_sidebar',
				'default'=>'post-no-sidebar',
				'options'=>array(
					'1'=>array('value'=>'product-right-sidebar','default'=>'selected','image'=>'/framework/assets/images/right-sidebar.png'),
					'2'=>array('value'=>'product-left-sidebar','image'=>'/framework/assets/images/left-sidebar.png'),
					'3'=>array('value'=>'product-no-sidebar','image'=>'/framework/assets/images/no-sidebar.png'),
					)),
			 __('Products Single Page Sidebar', 'crunchpress')=>array(
				'type'=>'radioimage',
				'name'=>THEME_NAME_S.'_products_single_page_sidebar',
				'default'=>'no-sidebar',
				'options'=>array(
					'1'=>array('value'=>'single-product-right-sidebar','default'=>'selected','image'=>'/framework/assets/images/right-sidebar.png'),
					'2'=>array('value'=>'single-product-left-sidebar','image'=>'/framework/assets/images/left-sidebar.png'),
					'3'=>array('value'=>'single-product-no-sidebar','image'=>'/framework/assets/images/no-sidebar.png'),
					)),
		__('Thumbnail Size', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_products_page_thumb_size',
				'default'=>'230x180',
				'description'=>'Width x Height. Recommed size for sidebar page (230x180) and without (270x230) '),
		   __('ITEM FETCH', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_products_item_fetch',
				'default'=>'12',
				'description'=>'Input the number of item you want to display at shop page'),
			__('PAGINATION', 'crunchpress')=>array(
				'type'=>'combobox',
				'name'=>THEME_NAME_S.'_products_navi',
				'options'=>array('No', 'Yes'),
				'description'=>'Display pagination on product page'),
				),
		'cp_panel_products_page_hmk' => array(		
	      	    __('Please Activate the Woocommerce to see thoese options', 'crunchpress')=>array(
				'type'=>'notice'
				)),
	);	
			
			
	// CrunchPress panel elements ( the head of array links to the menu of navigation elements )
	$crunchpress_element = array(
		//General
		'cp_panel_page_style' => array(
		   __('SEARCH/ARCHIVE SIDEBAR', 'crunchpress')=>array(
				'type'=>'radioimage',
				'name'=>THEME_NAME_S.'_search_archive_sidebar',
				'default'=>'no-sidebar',
				'options'=>array(
					'1'=>array('value'=>'right-sidebar','default'=>'selected','image'=>'/framework/assets/images/right-sidebar.png'),
					'2'=>array('value'=>'left-sidebar','image'=>'/framework/assets/images/left-sidebar.png'),
					/*'3'=>array('value'=>'both-sidebar','image'=>'/framework/assets/images/both-sidebar.png'),*/
					'4'=>array('value'=>'no-sidebar','image'=>'/framework/assets/images/no-sidebar.png'))),
			__('SEARCH/ARCHIVE FULL BLOG CONTENT', 'crunchpress')=>array(
				'type'=>'combobox',
				'name'=>THEME_NAME_S.'_search_archive_full_blog_content',
				'options'=>array('No', 'Yes'),
				'description'=>'Use this to show full content of the blog in search/archive page. Only use with 1/1 Full Thumbnail'),
			__('SEARCH/ARCHIVE EXCERPT NUM', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_search_archive_num_excerpt',
				'default'=>'285',
				'description'=>'Input the number of characters you want for the length of excerpt of search and archive page.'),
				),
				'cp_panel_sidebar' => array(
					__('CREATE SIDEBAR', 'crunchpress')=>array('type'=>'sidebar','name'=>THEME_NAME_S.'_create_sidebar')
				),
				'cp_panel_rtl' => array(
				__('RIGHT TO LEFT TEXT SUPPORT', 'crunchpress')=>array('type'=>'radioenabled', 'name'=> THEME_NAME_S.'_rtl','default'=>'disable','description'=>'Enable Right-to-Left Language Support (Support for Arabic, Urdu, Persion etc).'),
		),
		
		'cp_panel_twitter' => array(
			__('TWITTER USER NAME', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_twitter_user',
				'default'=>'',
				'description'=>'Enter Twitter User Name Here.'),
		    __('CONSUMER KEY', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_twitter_consumer_key',
				'default'=>'',
				'description'=>'Enter Twitter Consumer key here.'),
			__('CONSUMER SECRETE', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_twitter_consumer_sec',
				'default'=>'',
				'description'=>'Enter Twitter Consumer secrete here.'),
			__('ACCESS TOKEN', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_twitter_access_token',
				'default'=>'',
				'description'=>'Enter Twitter Access Token here.'),
			__('ACCESS TOKEN SECRETE', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_twitter_access_secrete',
				'default'=>'',
				'description'=>'Enter Twitter Access Secrete here.'),
			__('NUMBER OF ITEM', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_twitter_number_item',
				'default'=>'',
				'description'=>'Enter Twitter Number of Item.'),	
				),		

		'cp_panel_footer_style' => array(
			__('CHOOSE FOOTER STYLE', 'crunchpress')=>array(
				'type'=>'radioimage',
				'name'=>THEME_NAME_S.'_footer_style', 
				'default'=>'footer-style1',
				'options'=>array(
					'1'=>array('value'=>'footer-style1','image'=>'/framework/assets/images/footer-style1.png'),
					'4'=>array('value'=>'footer-style4','image'=>'/framework/assets/images/footer-style6.png'),
					
			)),
		    /*__('TOP FOOTER WIDGETS', 'crunchpress')=>array('defualt','enable', 'type'=>'radioenabled', 'name'=> THEME_NAME_S.'_top_footer'),*/
			/*__('FOOTER SOCIAL BAR', 'crunchpress')=>array('defualt','enable', 'type'=>'radioenabled', 'name'=> THEME_NAME_S.'_social_footer'),*/
			__('SHOW FOOTER', 'crunchpress')=>array('type'=>'radioenabled', 'name'=> THEME_NAME_S.'_show_footer'),
			__('SHOW FOOTER SLIDER', 'crunchpress')=>array('type'=>'radioenabled', 'name'=> THEME_NAME_S.'_show_footer_slider'),
			__('FOOTER SLIDER HEADING', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_footer_slider_heading',
				'default'=>'FEATURED VIDEO GALLERY',
				'description'=>'Put footer slider heading here.'),
			__('ITEM FETCH', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_footer_slider_item_fetch',
				'default'=>'6',
				'description'=>'Input the number of item you want to display at shop page'),
		),
		'cp_panel_google_analytics' => array(
			__('ENABLE / DISABLE GOOGLE ANALYTICS', 'crunchpress')=>array('type'=>'radioenabled', 'name'=> THEME_NAME_S.'_enable_analytics', 'default'=>'disable'),
			__('GOOGLE ANALYTICS CODE', 'crunchpress')=>array('type'=>'textarea', 'name'=> THEME_NAME_S.'_analytics_code',
				'description'=>'Place your google analytics code here. This should be something like <br>' . 
				htmlspecialchars('<script type="text/javascript">') . '<br> ... <br>' .
				htmlspecialchars('</script>'))
		),
		'cp_panel_favicon' => array(
			__('UPLOAD FAVICON ICON', 'crunchpress')=>array('type'=>'upload','name'=> THEME_NAME_S.'_favicon_image'),
		),
		'cp_panel_seo' => array(
			__('ENABLE / DISABLE BUILTIN SEO MODULE', 'crunchpress')=>array('type'=>'radioenabled','name'=> THEME_NAME_S.'_seo', 'default'=>'disable', 'description'=>'You enable built-in SEO medule from here' ),
		),
		//Theme Style
		'cp_panel_font_size' => array(
			__('H1 SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_h1_size','default'=>'30'),
			__('H2 SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_h2_size','default'=>'25'),
			__('H3 SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_h3_size','default'=>'20'),
			__('H4 SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_h4_size','default'=>'18'),
			__('H5 SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_h5_size','default'=>'16'),
			__('H6 SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_h6_size','default'=>'15'),
			__('CONTENT SIZE', 'crunchpress')=>array('type'=>'sliderbar','name'=>THEME_NAME_S.'_content_size','default'=>'14')
		),
		'cp_panel_font' => array(
			__('HEADER FONT', 'crunchpress')=>array('type'=>'font-combobox','name'=>THEME_NAME_S.'_header_font', 'default'=>'- Droid Serif',
				'description'=>'Choose the header font of this theme. This font will be used in all title and header elements including the slider title.'),
			__('MENU FONT', 'crunchpress')=>array('type'=>'font-combobox','name'=>THEME_NAME_S.'_menu_font',
				'description'=>'Choose the font to be used within content. We highly recommended NOT to use CUFON as a content font.'),
			__('CONTENT FONT', 'crunchpress')=>array('type'=>'font-combobox','name'=>THEME_NAME_S.'_content_font',
				'description'=>'Choose the font to be used within content. We highly recommended NOT to use CUFON as a content font.'),
		),
		'cp_panel_upload_font' => array(
			__('UPLOAD FONT', 'crunchpress')=>array(
				'type'=>'uploadfont',
				'name'=>THEME_NAME_S.'_upload_font',
				'file'=>THEME_NAME_S.'_upload_font_file')
		),
		
		//Overall Elements
		'cp_panel_logo' => array( 
			__('LOGO', 'crunchpress')=>array('type'=>'upload','name'=>THEME_NAME_S.'_logo', 'description'=>'You can upload custom logo image. To remove logo just remove url from logo input field.' ),
			__('LOGO MARGIN', 'crunchpress')=>array(
				'type'=>'inputtext',
				'name'=>THEME_NAME_S.'_logo_margin',
				'default'=>'0px 0px 0px 0px',
				'description'=>'You set logo margin e.g (Top,Right,Bottom,Left)'),
		),
		
		'cp_header_search' => array( 
			__('HEADER SEARCH TYPE', 'crunchpress')=>array(
				'type'=>'combobox',
				'name'=>THEME_NAME_S.'_header_search',
				'options'=>array('Product', 'Standrad'),
				'description'=>'You can specify header search for products or standrad blog search'),
			
		),

		'cp_panel_background' => array(
				
			__('BACKGROUND TYPE', 'crunchpress')=>array('type'=>'combobox', 'id'=>'cp_background_style','default'=>'0','name'=>THEME_NAME_S.'_background_style','options'=>array('0'=>'Pattern','1'=>'Custom Image','2'=>'Color','3'=>'None'),
				'description'=>'You can choose the background you want between our pre-provided petterns and your custom image.'),
			__('Background Color', 'crunchpress')=>array('body_class'=>'cp_background_color', 'type'=>'colorpicker','name'=>THEME_NAME_S.'_default_background_color','color_scheme_1'=>'#ffffff','description'=>'It will change solid background color'),
			__('CHOOSE PATTERN','crunchpress')=>array(
				'type'=>'radioimage',
				'body_class'=>'cp_background_pattern',
				'name'=>THEME_NAME_S.'_background_pattern',
				'default'=>'1',
				'options'=>array(
					'1'=>array('value'=>'1', 'image'=>'/framework/assets/images/pattern/pattern-1.png'),
					'2'=>array('value'=>'2','image'=>'/framework/assets/images/pattern/pattern-2.png'),
					'3'=>array('value'=>'3','image'=>'/framework/assets/images/pattern/pattern-3.png'),
					'4'=>array('value'=>'4','image'=>'/framework/assets/images/pattern/pattern-4.png'),
					'5'=>array('value'=>'5','image'=>'/framework/assets/images/pattern/pattern-5.png'),
					'6'=>array('value'=>'6','image'=>'/framework/assets/images/pattern/pattern-6.png'),
					'7'=>array('value'=>'7','image'=>'/framework/assets/images/pattern/pattern-7.png'),
					'8'=>array('value'=>'8','image'=>'/framework/assets/images/pattern/pattern-8.png'),
					'9'=>array('value'=>'9','image'=>'/framework/assets/images/pattern/pattern-9.png'),
					'10'=>array('value'=>'10','image'=>'/framework/assets/images/pattern/pattern-10.png'),
					'11'=>array('value'=>'11','image'=>'/framework/assets/images/pattern/pattern-11.png'),
					'12'=>array('value'=>'12','image'=>'/framework/assets/images/pattern/pattern-12.png'),
					'13'=>array('value'=>'13','image'=>'/framework/assets/images/pattern/pattern-13.png'),
					'14'=>array('value'=>'14','image'=>'/framework/assets/images/pattern/pattern-14.png'),
					'15'=>array('value'=>'15','image'=>'/framework/assets/images/pattern/pattern-15.png'),
					'16'=>array('value'=>'16','image'=>'/framework/assets/images/pattern/pattern-16.png'),
					'17'=>array('value'=>'17','image'=>'/framework/assets/images/pattern/pattern-17.png'),
					'18'=>array('value'=>'18','image'=>'/framework/assets/images/pattern/pattern-18.png'),
					'19'=>array('value'=>'19','image'=>'/framework/assets/images/pattern/pattern-19.png'),
					'20'=>array('value'=>'20','image'=>'/framework/assets/images/pattern/pattern-20.png'),
					'21'=>array('value'=>'21','image'=>'/framework/assets/images/pattern/pattern-21.png'),
					'22'=>array('value'=>'22','image'=>'/framework/assets/images/pattern/pattern-22.png'),
				)
			),
		__('CUSTOM BACKGROUND', 'crunchpress')=>array(
		'type'=>'upload',
		'name'=>THEME_NAME_S.'_background_custom',
		'body_class'=>'cp_background_custom'), 
		),
		
		'cp_panel_load_color_scheme' => array(
		 __('LOAD DEFAULT COLOR','crunchpress')=>array('type'=>'button','text'=>'Load Default','id'=>'cp_load_default_color_button',
		 		'description'=>'Click this button to load the default elements color of this theme. Then click save changes to save the default value. <br><br> ' .
				'WARNING : All of settings cannot be undo after you click save changes button.'),
	/*	__('PREDEFINED COLOR SCHEMES','crunchpress')=>array(
		'type'=>'radioimage',
		'body_class'=>'cp_color_scheme',
		'name'=>THEME_NAME_S.'_color_scheme',
		'default'=>'default',
		'options'=>array(
			'1'=>array('value'=>'color_scheme_1','image'=>'/framework/assets/images/color-schemes/scheme-1.png'),
			'2'=>array('value'=>'color_scheme_2','image'=>'/framework/assets/images/color-schemes/scheme-2.png'),
			'3'=>array('value'=>'color_scheme_3','image'=>'/framework/assets/images/color-schemes/scheme-3.png'),
			'4'=>array('value'=>'color_scheme_4','image'=>'/framework/assets/images/color-schemes/scheme-4.png'),
			'5'=>array('value'=>'color_scheme_5','image'=>'/framework/assets/images/color-schemes/scheme-5.png'),
			'6'=>array('value'=>'color_scheme_6','image'=>'/framework/assets/images/color-schemes/scheme-6.png'),
		)
		),*/
		),	
		
		
		
		// Load other elements colors
		'cp_panel_load_other_color' => array(
	__('Master Color', 'crunchpress')=>array('body_class'=>'cp_background_solid', 'type'=>'colorpicker','name'=>THEME_NAME_S.'master_color',
		'color_scheme_1'=>'#00d8ff',
		'color_scheme_2'=>'#65ECFC',
		'color_scheme_3'=>'#BB00F8',
		'color_scheme_4'=>'#9FFC66',
		'color_scheme_5'=>'#809F14',
		'color_scheme_6'=>'#809F14',
		'description'=>'It will change overall color scheme of theme.'),
	
		//__('Button Text Color', 'crunchpress')=>array('body_class'=>'cp_background_solid', 'type'=>'colorpicker','name'=>THEME_NAME_S.'button_text_color',
//		'color_scheme_1'=>'#000000',
//		'color_scheme_2'=>'#65ECFC',
//		'description'=>'It will change text color of button in normal state.',
//		),	
//		
//		__('Button Normal Color', 'crunchpress')=>array('body_class'=>'cp_background_solid', 'type'=>'colorpicker','name'=>THEME_NAME_S.'button_bg_color',
//		'color_scheme_1'=>'#00D8FF',
//		'color_scheme_2'=>'#65ECFC',
//		'description'=>'It will change button color in normal state.',
//		),
//		
//		__('Button Hover Text Color', 'crunchpress')=>array('body_class'=>'cp_background_solid', 'type'=>'colorpicker','name'=>THEME_NAME_S.'button_text_hover_color',
//		'color_scheme_1'=>'#FFFFFF',
//		'color_scheme_2'=>'#65ECFC',
//		'description'=>'It will change button text color in hover state.',
//		),	
//		
//		__('Button Hover Color', 'crunchpress')=>array('body_class'=>'cp_background_solid', 'type'=>'colorpicker','name'=>THEME_NAME_S.'button_bg_hover_color',
//		'color_scheme_1'=>'#006c7f',
//		'color_scheme_2'=>'#65ECFC',
//		'description'=>'It will change button color in hover state.',
//		),	
		), 
		
		//Load Custom CSS
		'cp_panel_custom_style' => array(
		__('CUSTOM STYLING', 'crunchpress')=>array('type'=>'textarea','name'=>THEME_NAME_S.'_custom_styling'), 
		),			
		
		
		'cp_panel_social_shares' => array(
		__('FACEBOOK', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_facebook_share',
		'description'=>'Toggle to enable/disable the facebook shares in blog and portfolio page.'),
		__('TWITTER', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_twitter_share',
		'description'=>'Toggle to enable/disable the twitter shares in blog and portfolio page.'),
		__('GOOGLE', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_google_share',
		'description'=>'Toggle to enable/disable the google shares in blog and portfolio page.'),
		__('STUMBLE UPON', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_stumble_upon_share',
		'description'=>'Toggle to enable/disable the stumble upon shares in blog and portfolio page.'),
		__('MY SPACE', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_my_space_share',
		'description'=>'Toggle to enable/disable the my spce shares in blog and portfolio page.'),
		__('DELICIOUS', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_delicious_share',
		'description'=>'Toggle to enable/disable the delicious shares in blog and portfolio page.'),
		__('DIGG', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_digg_share',
		'description'=>'Toggle to enable/disable the digg shares in blog and portfolio page.'),
		__('LINKEDIN', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_linkedin_share',
		'description'=>'Toggle to enable/disable the linkedin shares in blog and portfolio page.'),
		__('GOOGLE PLUS', 'crunchpress')=>array('type'=>'radioenabled','name'=>THEME_NAME_S.'_google_plus_share',
		'description'=>'Toggle to enable/disable the linkedin shares in blog and portfolio page.'),				
		
		),
		
		'cp_panel_copyright_area' => array( 
		__('SHOW COPYRIGHT', 'crunchpress')=>array('type'=>'radioenabled', 'name'=> THEME_NAME_S.'_show_copyright'),
		__('COPYRIGHT LEFT AREA', 'crunchpress')=>array('type'=>'textarea','name'=>THEME_NAME_S.'_copyright_left_area','default'=>'Copyright &copy; 2012. Designed by
		<a href="http://crunchpress.com/">CrunchPress.com</a>'), 
		),
		
		
		// Slider Setting
		'cp_panel_nivo_slider' => array(
		__('SLIDER EFFECTS', 'crunchpress')=>array(
		'type'=>'combobox',
		'oldname'=>'effect',
		'name'=>THEME_NAME_S.'_nivo_slider_effect',
		'options'=>array(
			'0'=>'sliceDown', '1'=>'sliceDownLeft', '2'=>'sliceUp',
			'3'=>'sliceUpLeft', '4'=>'sliceUpDown', '5'=>'sliceUpDownLeft',
			'6'=>'fold', '7'=>'fade', '8'=>'random',
			'9'=>'slideInRight', '10'=>'slideInLeft', '11'=>'boxRandom',
			'12'=>'boxRain', '13'=>'boxRainReverse', '14'=>'boxRainGrow',
			'15'=>'boxRainGrowReverse')),
		__('PAUSE ON HOVER', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_NAME_S.'_nivo_slider_pause_on_hover',
		'description'=>'Pause the nivo slider when user hover at the slider.'),
		__('SHOW BULLETS', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'controlNav','name'=>THEME_NAME_S.'_nivo_slider_show_bullets',
		'description'=>'Enable to show the nivo slider navigation bullets.'),
		__('SHOW LEFT/RIGHT NAVIGATION', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'directionNav','name'=>THEME_NAME_S.'_nivo_slider_show_navigation',
		'description'=>'Enable left/right navigation of the nivo slider.'),
		__('ONLY SHOW NAVIGATION WHEN HOVER', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'directionNavHide','name'=>THEME_NAME_S.'_nivo_slider_hover_navigation',
		'description'=>'If the left/right navigation is enabled, enabling this option will hide the left/right navigation when the mouse cursor is outside of the slider frame.'),
		__('ANIMATION SPEED', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'animSpeed','name'=>THEME_NAME_S.'_nivo_slider_animation_speed','default'=>'500',
		'description'=>'This is the animation speed during the change of each slide.'),
		__('PAUSE TIME', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'pauseTime','name'=>THEME_NAME_S.'_nivo_slider_pause_time','default'=>'3000',
		'description'=>'This option is the pause time of each slider.'),
		__('CAPTION OPACITY', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'captionOpacity','name'=>THEME_NAME_S.'_nivo_slider_caption_opacity','default'=>'1'),
		
		),
		
		'cp_panel_flex_slider' => array(
		__('SLIDER EFFECTS', 'crunchpress')=>array('type'=>'combobox','oldname'=>'animation'
		,'name'=>THEME_NAME_S.'_flex_slider_effect', 'options'=>array('0'=>'fade', '1'=>'slide')),
		__('PAUSE ON HOVER', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'pauseOnHover','name'=>THEME_NAME_S.'_flex_slider_pause_on_hover','default'=>'disable',
		'description'=>'Pause the flex slider when user hover at the slider.'),
		__('SHOW BULLETS', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'controlNav','name'=>THEME_NAME_S.'_flex_slider_show_bullets',
		'description'=>'Enable to show the flex slider navigation bullets.'),
		__('SHOW NAVIGATION', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'directionNav','name'=>THEME_NAME_S.'_flex_slider_show_navigation',
		'description'=>'Enable left/right navigation of the flex slider.'),
		__('ANIMATION SPEED', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'animationDuration','name'=>THEME_NAME_S.'_flex_slider_animation_speed','default'=>'600',
		'description'=>'This is the animation speed during the change of each slide.'),
		__('PAUSE TIME', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'slideshowSpeed','name'=>THEME_NAME_S.'_flex_slider_pause_time','default'=>'7000',
		'description'=>'This option is the pause time of each slider.'),
		__('PAUSE ON ACTION', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'pauseOnAction','name'=>THEME_NAME_S.'_flex_slider_pause_on_action','default'=>'false'),
		),
		
		 
		'cp_panel_refine_slider' => array(
		__('SLIDER EFFECTS', 'crunchpress')=>array(
		'type'=>'combobox',
		'oldname'=>'transition',
		'name'=>THEME_NAME_S.'_refine_slider_effect',
		'options'=>array(
			'0'=>'fade', '1'=>'random', '2'=>'sliceH',
			'3'=>'sliceV', '4'=>'slideH', '5'=>'slideV',
			'6'=>'scale', '7'=>'fan', '8'=>'blockScale',
			'9'=>'kaleidoscope', '10'=>'blindH', '11'=>'blindV',
			'12'=>'cubeH', '13'=>'cubeV')),
		__('AUTOPLAY', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'autoPlay','name'=>THEME_NAME_S.'_refine_slider_autoplay',
		'description'=>'Autoplay refine slider.'),			
		__('SHOW LEFT/RIGHT NAVIGATION', 'crunchpress')=>array(
		'type'=>'combobox',
		'oldname'=>'controls',
		'name'=>THEME_NAME_S.'_refine_slider_show_navigation',
		'options'=>array(
			'0'=>'null', '1'=>'arrows', '2'=>'thumbs'),
		'description'=>'Enable left/right navigation of the refine slider.'),				
		__('KEYBOARD NAVIGATION', 'crunchpress')=>array('type'=>'radioenabled','oldname'=>'keyNav','name'=>THEME_NAME_S.'_refine_slider_key_navigation',
		'description'=>'Use left/right arrow keys to switch slide.'),
		__('ANIMATION SPEED', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'transitionDuration','name'=>THEME_NAME_S.'_refine_slider_animation_speed','default'=>'500',
		'description'=>'This is the animation speed during the change of each slide.'),
		__('PAUSE TIME', 'crunchpress')=>array('type'=>'inputtext','oldname'=>'delay','name'=>THEME_NAME_S.'_refine_slider_pause_time','default'=>'3000',
		'description'=>'This option is the pause time of each slider.'),
		),
		
		'cp_panel_dummy_content' => array(
		__('Dummy Content', 'crunchpress')=>array('type'=>'dummy','name'=>THEME_NAME_S.'_create_sidebar')
		),
		
		// Buddypress Sidebars
		'cp_panel_bg_page' => array(
		  __('Buddypress Page Sidebar', 'crunchpress')=>array(
				'type'=>'radioimage',
				'name'=>THEME_NAME_S.'bp_page_sidebars',
				'default'=>'post-no-sidebar',
				'options'=>array(
					'1'=>array('value'=>'bp-right-sidebar','default'=>'selected','image'=>'/framework/assets/images/right-sidebar.png'),
					'2'=>array('value'=>'bp-left-sidebar','image'=>'/framework/assets/images/left-sidebar.png'),
					'3'=>array('value'=>'bp-no-sidebar','image'=>'/framework/assets/images/no-sidebar.png'),
					)),
				),
		);
	
	// add WooCommerce Options if Plugin is Activated
	if( function_exists('woocommerce_get_template_part')) {
	$crunchpress_menu= array_merge( $crunchpress_menu, (array)$woo_options_arr );	
	$crunchpress_element= array_merge( $crunchpress_element, (array)$woo_elements_arr );
	}else {
	$crunchpress_menu= array_merge( $crunchpress_menu, (array)$woo_options_arr_not_installed );	
	$crunchpress_element= array_merge( $crunchpress_element, (array)$woo_elements_arr );
	
	}
	
	// add action to embeded the panel in to dashboard
	add_action('admin_menu','add_crunchpress_panel');
	function add_crunchpress_panel(){
		$page = add_menu_page('CrunchPress Option', THEME_NAME , 'manage_options', 'options', 'create_crunchpress_panel'); 
		add_action('admin_enqueue_scripts','register_crunchpress_panel_scripts');
	}
	
	// add ajax action to hook the functions when save button is pressed 
	add_action('wp_ajax_save_crunchpress_panel','save_crunchpress_panel');
	function save_crunchpress_panel(){
	
		check_ajax_referer(plugin_basename(__FILE__),'security');
		
		global $crunchpress_element;
		$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');
		foreach($crunchpress_element as $elements){
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
		cp_generate_style_custom();
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
	
	// start creating the CrunchPress panel ( by calling function to create menu and elements )
	function create_crunchpress_panel(){
	
		global $crunchpress_menu;
		global $crunchpress_element;
		
		?>
		
		<form name="goodlayer-panel-form" id="goodlayer-panel-form">
			<div class="crunchpress-panel-wrapper">
			<?php
				$my_theme = wp_get_theme();
				echo '<div class="panel-menu">';
				echo '<div class="panel-menu-header"><div class="panel-menu-header-strap"></div>';
				echo '<img src="' . CP_THEME_PATH_URL . '/framework/assets/images/admin-panel-logo.png" width="180px;" alt="crunchpress"/>';
				echo '</div>';			
					create_crunchpress_menu($crunchpress_menu);
				echo '</div>';
				echo '<div class="panel-elements" id="panel-elements">';
				echo '<div class="panel-element-head"><div class="panel-element-header-strap"></div>';
				echo '<div class="panel-header-left-text">';
				echo '<div class="panel-crunchpress-text">'.$my_theme->get( 'Name' ).'</div>';
				echo '<div class="panel-admin-panel-text">'.__('Version','cp_back_end') . $my_theme->get( 'Version' ).'</div>';
				echo '</div>';
				/*echo '<div class="panel-admin-panel-text fw-version">'.__('Framework Ver','cp_back_end') , '</div>';*/
				echo '</div>';	
				echo '<div class="panel-element" id="panel-element-save-complete">';
				echo '<div class="panel-element-save-text">Save Options Complete.</div>';
				echo '<div class="panel-element-save-arrow"></div></div>';
					create_crunchpress_elements($crunchpress_element);
				echo '<div class="panel-element-tail">';
				echo '<div class="tail-save-changes"><div class="loading-save-changes"></div>';
				echo '<input type="submit" value="' . __('Save Changes','crunchpress') . '">';
				echo '</div>';						
				echo '</div>';						
				echo '<input type="hidden" name="action" value="save_crunchpress_panel">';
				echo '<input type="hidden" name="security" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '">';
				echo '</div>';	
			?>
			</div>
		</form>
		<?php
	}
	// Create accordion menu
	function create_crunchpress_menu($menu){
		echo '<div id="panel-nav"><ul>';	
		foreach($menu as $title=>$sub_menu){ 
			echo '<li>';
			echo '<a id="parent" href="#" >';
			echo '<div class="top-menu-bar"></div>';
			echo '<div class="top-menu-image"><img src="' . CP_THEME_PATH_URL . '/framework/assets/images/admin-panel/' . str_replace(' ', '', $title) . '.png"/></div>';
			echo '<span class="top-menu-text">' . sprintf(__('%s','crunchpress'),$title ) . '</span>';
			echo '</a>';
			echo '<ul>';
			foreach($sub_menu as $sub_title=>$name){
				echo '<li>';
				echo '<a id="children" href="#" rel=' . $name . '>';
				echo '<div class="child-menu-image"></div>';
				echo '<span class="child-menu-text">' . sprintf(__('%s','crunchpress'),$sub_title ) . '</span>';
				echo '</a>';
				echo '</li>';
			}
			echo '</ul>';
			echo '</li>';
		}
		echo '</ul></div>';
	}
	// decide to create each input element base on the receiving key of elements
	function create_crunchpress_elements($elements){
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
						case 'notice': print_panel_notice(); break;
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
					<label for="<?php echo $name; ?>" > <?php printf(__('%s','crunchpress'),$title ); ?> </label>
				</div>
				<div class="panel-input">	
					<div class="input-example-image" id="input-example-image">
					<?php 
					
						$image_src = '';
						
						if(!empty($value)){ 
						
							$image_src = wp_get_attachment_image_src( $value, 'full' );
							$image_src = (empty($image_src))? '': $image_src[0];
							$thumb_src_preview = wp_get_attachment_image_src( $value, '150x150');
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
					<label for="<?php echo $name; ?>" > <?php printf(__('%s','crunchpress'),$title ); ?> </label>
				</div>
				<div class="panel-input">
					<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php 
						
						echo ($value == '')? esc_html($default): esc_html($value);
						
						 ?>" />
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php printf(__('%s','crunchpress'),$description ); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
	
	}
	
	// textarea => name, value, default
	function print_panel_input_textarea($title, $values){
	
		extract($values);
		
		?>
		
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>"><?php printf(__('%s','crunchpress'),$title ); ?></label>
				</div>
				<div class="panel-input">
					<textarea cols="10" rows="5" name="<?php echo $name; ?>" id="<?php echo $name; ?>" ><?php
						
						echo ($value == '')? esc_html($default): esc_html($value);
						
					?></textarea>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php printf(__('%s','crunchpress'),$description ); ?></div>
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
					<label for="<?php echo $name; ?>"><?php printf(__('%s','crunchpress'),$title ); ?></label>
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
				
					<div class="panel-description"><?php printf(__('%s','crunchpress'),$description ); ?></div>
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
					<label for="<?php echo $name; ?>"><?php printf(__('%s','crunchpress'),$title ); ?></label>
				</div>
				<div class="panel-radioimage">
					<?php foreach( $options as $option ){ ?>
						<div class='radio-image-wrapper'>
							<label for="<?php echo $option['value']; ?>">
								<img src=<?php echo CP_THEME_PATH_URL.$option['image']?> class="<?php echo $name; ?>" alt=<?php echo $name;?>>
								<div id="check-list"></div>                                
							</label>
							<input type="radio" name="<?php echo $name; ?>" value="<?php echo $option['value']; ?>" <?php 
								if($value == $option['value']){
									echo 'checked';
								}else if($value == '' && $default == $option['value']){
									echo 'checked';
								}
							?> id="<?php echo $option['value']; ?>" class="<?php echo $name; ?>"
                            >                            
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
					<label for="<?php echo $name; ?>"><?php printf(__('%s','crunchpress'),$title ); ?></label>
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
				
					<div class="panel-description"><?php printf(__('%s','crunchpress'),$description ); ?></div>
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
					<label for="<?php echo $name; ?>"><?php printf(__('%s','crunchpress'),$title ); ?></label>
				</div>
				<div class="panel-input">	
					<div class="panel-font-sample" id="panel-font-sample"><?php echo FONT_SAMPLE_TEXT; ?></div> 
					<div class="combobox" id="combobox-font-sample">
						<select name="<?php echo $name; ?>" id="<?php echo $name; ?>" class="cp-panel-select-font-family">
						
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
				
					<div class="panel-description"><?php printf(__('%s','crunchpress'),$description ); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}	
	
	// colorpicker => name, value, default
	function print_panel_color_picker($title, $values){
	
		extract($values);
		
		
		if( empty( $body_class ) ){ $body_class = $name; }
		
		?>
			<div class="panel-body body-<?php echo $body_class; ?>">
            
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label for="<?php echo $name; ?>" > <?php printf(__('%s','crunchpress'),$title ); ?> </label>
				</div>
				<div class="panel-input">
					<input type="text" name="<?php echo $name; ?>" class="color-picker" value="<?php 
												
						echo ($value == '')? esc_html( $color_scheme_1): esc_html($value);
						
						?>" color_scheme_1="<?php echo $color_scheme_1; ?>"<?php /*?> color_scheme_2="<?php echo $color_scheme_2; ?>" color_scheme_3="<?php echo $color_scheme_3; ?>" color_scheme_4="<?php echo $color_scheme_4; ?>" <?php */?>/>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php printf(__('%s','crunchpress'),$description ); ?></div>
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
					<label for="<?php echo $name; ?>" > <?php printf(__('%s','crunchpress'),$title ); ?> </label>
				</div>
				<div class="panel-input">
					<div id="<?php echo $name; ?>" class="sliderbar" rel="sliderbar"></div>
					<input type="hidden" name="<?php echo $name; ?>" value="<?php echo ($value == '')? esc_html($default): esc_html($value); ?>" >
					<div id="slidertext"><?php echo ($value == '')? esc_html($default): esc_html($value); ?> px</div>
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php printf(__('%s','crunchpress'),$description ); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>
			
		<?php
		
	}
	
	// sidebar => name, value
	function print_panel_sidebar2($title, $values){
	
		extract($values);
		
		?>
		
		<div class="panel-body" id="panel-body">
			<div class="panel-body-gimmick"></div>
			<div class="panel-title">
				<label> <?php printf(__('%s','crunchpress'),$title ); ?> </label>
			</div>
			<div class="panel-input">
				<input type="text" id="add-more-sidebar" value="type title here" rel="type title here">
				<div id="add-more-sidebar" class="add-more-sidebar"></div>
			</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php printf(__('%s','crunchpress'),$description ); ?></div>
					
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
				<?php printf(__('%s','crunchpress'),$title ); ?>
			</div>
			<div id="add-more-font" class="add-more-font"></div>
			<br class="clear">
			<div id="added-font" class="added-font">
				<div class="default-font-item" id="font-item">
					<div class="inner-font-item">
						<div class="panel-font-title"><?php _e('Font Name','crunchpress'); ?></div>
						<input type="text" id="<?php echo $name; ?>" class="cp_upload_font_name" readonly>
					</div>
					<div class="inner-font-item">
						<div class="panel-font-title"><?php _e('Font File','crunchpress'); ?></div>
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
							<div class="panel-font-title"><?php _e('Font Name','crunchpress'); ?></div>
							<input type="text" name="<?php echo $name; ?>[]" id="<?php echo $name; ?>" value="<?php echo find_xml_value($each_font, 'name'); ?>" class="cp_upload_font_name" readonly>
						</div>
						<div class="inner-font-item">
							<div class="panel-font-title"><?php _e('Font File','crunchpress'); ?></div>
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
					<label> <?php printf(__('%s','crunchpress'),$title ); ?> </label>
				</div>
				<div class="panel-input">
					<input type="button" value="<?php echo $text; ?>" id="<?php echo $id; ?>" />
				</div>
				<?php if(isset($description)){ ?>
				
					<div class="panel-description"><?php printf(__('%s','crunchpress'),$description ); ?></div>
					<div class="panel-description-info-img"></div>
					
				<?php } ?>
				<br class="clear">
			</div>		
		
		<?php	
	}
	
	// upload dummy data (from xml file)
	function print_panel_dummy(){
		foreach ($_REQUEST as $keys=>$values) {
		$$keys = trim($values);
	}
	
	$return_data = array('success'=>'-1', 'alert'=>'Save option failed, please try contacting your host provider to increase the post_max_size and suhosin.post.max_vars varialble on the server.');
		?>

			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
				<div class="panel-title">
					<label> DUMMIES DATA </label>
				</div>
				<div class="panel-input">
					   <div class="wrapper_right themeple_container">
	                            	<input type="hidden" value="<?php echo wp_create_nonce ('themeple_nonce_import_dummy_data');?>" name="themeple-nonce-dummy">
                                    <?php  if(defined('WOOCOMMERCE_VERSION')){  ?>
								        <a class="themeple_btn themeple_btn_active themeple_dummy_data"><input type="button" value="<?php _e('Import Dummy Data', 'crunchpress'); ?>" id="importcontent" /></a>
                                    <?php } else {  ?>
                                       <a class="noplugin"><input type="button" value="<?php _e('Import Dummy Data', 'crunchpress'); ?>" id="noplugin" /></a>
                                    <?php } ?>
								    <div class="js_data" id="themeple_js_data">
									<input type="hidden" value="<?php echo admin_url("admin-ajax.php");?>" name="admin_ajax_url">						
								    </div>
                     		<div id="import-now-loading" class="now-loading"></div>
		     	</div>
            
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
	
	
	function print_panel_notice(){
		?>
            <style>
			
			</style>
			<div class="panel-body">
				<div class="panel-body-gimmick"></div>
								
				<div class="panel-notice" >
				<div class="warning"><h3>	Please install Woocommerce Plugin to see the options for Products Page. </h3></div>
				 
				</div>
				
				<br class="clear">
			</div>		
		
		<?php
	}
?>