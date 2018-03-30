<?php
	/*	
	*	Goodlayers Framework File
	*	---------------------------------------------------------------------
	*	This file contains the admin option setting 
	*	---------------------------------------------------------------------
	*/
	
	// save the style-custom.css file when the admin option is saved
	add_action('gdlr_save_' . THEME_SLUG, 'gdlr_generate_style_custom');
	if( !function_exists('gdlr_generate_style_custom') ){
		function gdlr_generate_style_custom( $options ){

			// for multisite
			$file_url = get_template_directory() . '/stylesheet/style-custom.css';
			if( is_multisite() && get_current_blog_id() > 1 ){
				$file_url = get_template_directory() . '/stylesheet/style-custom' . get_current_blog_id() . '.css';
			}
			
			// open file
			$file_stream = @fopen($file_url, 'w');
			if( !$file_stream ){
				$ret = array(
					'status'=>'failed', 
					'message'=> '<span class="head">' . __('Cannot Generate Custom File', 'gdlr_translate') . '</span> ' .
						__('Please try changing the style-custom.css file permission to 775 or 777 for this.' ,'gdlr_translate')
				);	
				
				die(json_encode($ret));				
			}
			
			// write file content
			$theme_option = get_option(THEME_SHORT_NAME . '_admin_option', array());
			
			// for updating google font list to use on front end
			global $gdlr_font_controller; $google_font_list = array(); 
			
			foreach( $options as $menu_key => $menu ){
				foreach( $menu['options'] as $submenu_key => $submenu ){
					if( !empty($submenu['options']) ){
						foreach( $submenu['options'] as $option_slug => $option ){
							if( !empty($option['selector']) ){
								// prevents warning message
								$option['data-type'] = (empty($option['data-type']))? 'color': $option['data-type'];
								
								if( !empty($theme_option[$option_slug]) ){
									$value = gdlr_check_option_data_type($theme_option[$option_slug], $option['data-type']);
								}else{
									$value = '';
								}
								if($value){
									fwrite( $file_stream, str_replace('#gdlr#', $value, $option['selector']) . "\r\n" );
								}
								
								// updating google font list
								if( $menu_key == 'font-settings' && $submenu_key == 'font-family' ){
									if( !empty($gdlr_font_controller->google_font_list[$theme_option[$option_slug]]) ){
										$google_font_list[$theme_option[$option_slug]] = $gdlr_font_controller->google_font_list[$theme_option[$option_slug]];
									}
								}
							}
						}
					}
				}
			}
			
			// update google font list
			update_option(THEME_SHORT_NAME . '_google_font_list', $google_font_list);			
			
			$skins = json_decode($theme_option['skin-settings'], true);
			$skins = empty($skins)? array(): $skins;
			foreach($skins as $skin){
				$class = '.' . gdlr_string_to_class($skin['skin-title']);

				$style  = '#class#, #class# .gdlr-skin-content{ color: ' . $skin['content'] . '; }' . "\r\n"; 
				$style .= '#class# i, #class# .nav-container.style-1 .flex-direction-nav i{ color: ' . $skin['icon'] . '; }' . "\r\n"; 
				$style .= '#class# h1, #class# h2, #class# h3, #class# h4, #class# h5, #class# h6, ';
				$style .= '#class# .gdlr-skin-title, #class# .gdlr-skin-title a{ color: ' . $skin['title'] . '; }' . "\r\n"; 
				$style .= '#class# .gdlr-skin-title a:hover{ color: ' . $skin['title-hover'] . '; }' . "\r\n"; 
				$style .= '#class# .gdlr-skin-info, #class# .gdlr-skin-info a, #class# .gdlr-skin-info a:hover{ color: ' . $skin['info'] . '; }' . "\r\n"; 
				$style .= '#class# a, #class# .gdlr-skin-link, #class# .gdlr-skin-link-color{ color: ' . $skin['link'] . '; }' . "\r\n"; 
				$style .= '#class# a:hover, #class# .gdlr-skin-link:hover{ color: ' . $skin['link-hover'] . '; }' . "\r\n"; 
				$style .= '#class# .gdlr-skin-box, #class# .nav-container.style-1 .flex-direction-nav a{ background-color: ' . $skin['element-background'] . '; }' . "\r\n"; 
				/**/ $style .= '#class# .gdlr-item-title .icon-quote-left, #class# .gdlr-item-title .gdlr-flex-prev, ';
				/**/ $style .= '#class# .gdlr-item-title .gdlr-flex-next{ color: ' . $skin['element-background'] . '; }' . "\r\n"; 
				/**/ $style .= '#class# .gdlr-item-title-gimmick{ background-color: ' . $skin['border'] . '; }' . "\r\n"; 
				$style .= '#class# *, #class# .gdlr-skin-border{ border-color: ' . $skin['border'] . '; }' . "\r\n"; 
				$style .= '#class# .gdlr-button, #class# .gdlr-button:hover, #class# input[type="button"], #class# input[type="submit"]{ ';
				$style .= 'color: ' . $skin['button-text'] . '; background-color: ' . $skin['button-background'] . ';  }';
				$style = str_replace('#class#', $class, $style);
				fwrite($file_stream, $style);
			}

			$end_of_file = apply_filters('gdlr_style_custom_end', '', $theme_option);
			if(!empty($end_of_file)){
				fwrite($file_stream, $end_of_file);
			}
			
			if( !empty($theme_option['additional-style']) ){
				fwrite($file_stream, $theme_option['additional-style']);
			}

			// close file after finish writing
			fclose($file_stream);
		}
	}	
	
	// create the main admin option
	if( is_admin() ){ add_action('after_setup_theme', 'gdlr_create_admin_option'); }
	if( !function_exists('gdlr_create_admin_option') ){
	
		function gdlr_create_admin_option(){
			global $theme_option, $gdlr_sidebar_controller;
		
			new gdlr_admin_option( 
				
				// admin option attribute
				array(
					'page_title' => THEME_FULL_NAME . ' ' . __('Option', 'gdlr_translate'),
					'menu_title' => THEME_FULL_NAME,
					'menu_slug' => THEME_SLUG,
					'save_option' => THEME_SHORT_NAME . '_admin_option',
					'role' => 'edit_theme_options'
				),
					  
				// admin option setting
				apply_filters('gdlr_admin_option',
					array(
					
						// general menu
						'general' => array(
							'title' => __('General', 'gdlr_translate'),
							'icon' => GDLR_PATH . '/include/images/icon-general.png',
							'options' => array(
								
								'page-style' => array(
									'title' => __('Page Style', 'gdlr_translate'),
									'options' => array(
										'enable-boxed-style' => array(
											'title' => __('Container Style', 'gdlr_translate'),
											'type' => 'combobox',	
											'options' => array(
												'full-style' => __('Full Style', 'gdlr_translate'),
												'boxed-style' => __('Boxed Style', 'gdlr_translate')
											)
										),
										'boxed-background-image' => array(
											'title' => __('Background Image', 'gdlr_translate'),
											'type' => 'upload',
											'wrapper-class'=> 'enable-boxed-style-wrapper boxed-style-wrapper'
										),	
										'container-width' => array(
											'title' => __('Container Width', 'gdlr_translate'),
											'type' => 'text',	
											'default' => '1140', 
											'data-type' => 'pixel',
											'selector' => 'html.ltie9 body, body{ min-width: #gdlr#; } .container{ max-width: #gdlr#; } ' .
												'.gdlr-caption-wrapper .gdlr-caption-inner{ max-width: #gdlr#; }'
										),
										'boxed-style-frame' => array(
											'title' => __('Boxed Style Frame Width', 'gdlr_translate'),
											'type' => 'text',	
											'data-type' => 'pixel',
											'default' => '1200',
											'selector' => '.body-wrapper.gdlr-boxed-style { max-width: #gdlr#; }', 
											'description' => __('Default value is container width + 80', 'gdlr_translate')
										),
										'enable-responsive-mode' => array(
											'title' => __('Enable Responsive', 'gdlr_translate'),
											'type' => 'checkbox',	
											'default' => 'enable'
										),
										'sidebar-size' => array(
											'title' => __('Sidebar Size', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'2'=>__('16 Percent', 'gdlr_translate'),
												'3'=>__('25 Percent', 'gdlr_translate'),
												'4'=>__('33 Percent', 'gdlr_translate'),
												'5'=>__('41 Percent', 'gdlr_translate'),
												'6'=>__('50 Percent', 'gdlr_translate')
											),
											'default' => '4',
											'descripton' => '1 column equals to around 80px',
										),		
										'both-sidebar-size' => array(
											'title' => __('Both Sidebar Size', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'3'=>__('25 Percent', 'gdlr_translate'),
												'4'=>__('33 Percent', 'gdlr_translate')
											),
											'default' => '3',
											'descripton' => '1 column equals to around 80px',
										),	
										'date-format' => array(
											'title' => __('Date Format', 'gdlr_translate'),
											'type' => 'text',				
											'default'=>'d M Y',
											'description'=>__('See more details about the date format here. http://codex.wordpress.org/Formatting_Date_and_Time', 'gdlr_translate')
										),	
										'video-ratio' => array(
											'title' => __('Default Video Ratio', 'gdlr_translate'),
											'type' => 'text',				
											'default'=>'16/9',
											'description'=>__('Please only fill number/number as default video ratio', 'gdlr_translate')
										),		
										'additional-style' => array(
											'title' => __('Additional Style', 'gdlr_translate'),
											'type' => 'textarea',	
											'class' => 'full-width',
										),	
										'additional-script' => array(
											'title' => __('Additional Script ( no &lt;script> tag ) ', 'gdlr_translate'),
											'type' => 'textarea',	
											'class' => 'full-width',
										),											
									)
								),
								
								'analytics-favicon' => array(
									'title' => __('Analytics / Favicon', 'gdlr_translate'),
									'options' => array(			
										'favicon-id' => array(
											'title' => __('Upload Favicon ( .ico file )', 'gdlr_translate'),
											'button' => __('Select Icon', 'gdlr_translate'),
											'type' => 'upload'
										),	
										'google-analytics' => array(
											'title' => __('Analytic Script ( with the &lt;script> tag )', 'gdlr_translate'),
											'type' => 'textarea',	
											'class' => 'full-width',
										),		
									)
								),
								
								'blog-style' => array(),	
								
								'portfolio-style' => array(),	
								
								'cause-style' => array(),		

								'search-archive-style' => array(
									'title' => __('Search - Archive Style', 'gdlr_translate'),
									'options' => array(
										'archive-sidebar-template' => array(
											'title' => __('Search - Archive Sidebar Template', 'gdlr_translate'),
											'type' => 'radioimage',
											'options' => array(
												'no-sidebar'=>GDLR_PATH . '/include/images/no-sidebar.png',
												'both-sidebar'=>GDLR_PATH . '/include/images/both-sidebar.png', 
												'right-sidebar'=>GDLR_PATH . '/include/images/right-sidebar.png',
												'left-sidebar'=>GDLR_PATH . '/include/images/left-sidebar.png'
											),
											'default' => 'no-sidebar'							
										),
										'archive-sidebar-left' => array(
											'title' => __('Search - Archive Sidebar Left', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => $gdlr_sidebar_controller->get_sidebar_array(),		
											'wrapper-class'=>'left-sidebar-wrapper both-sidebar-wrapper archive-sidebar-template-wrapper',											
										),
										'archive-sidebar-right' => array(
											'title' => __('Search - Archive Sidebar Right', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => $gdlr_sidebar_controller->get_sidebar_array(),
											'wrapper-class'=>'right-sidebar-wrapper both-sidebar-wrapper archive-sidebar-template-wrapper',
										),		
										'archive-blog-style' => array(
											'title' => __('Search - Archive Blog Style', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'blog-1-4' => '1/4 ' . __('Blog Grid', 'gdlr_translate'),
												'blog-1-3' => '1/3 ' . __('Blog Grid', 'gdlr_translate'),
												'blog-1-2' => '1/2 ' . __('Blog Grid', 'gdlr_translate'),
												'blog-1-1' => '1/1 ' . __('Blog Grid', 'gdlr_translate'),
												'blog-medium' => __('Blog Medium', 'gdlr_translate'),
												'blog-full' => __('Blog Full', 'gdlr_translate'),
											),
											'default' => 'blog-1-3'							
										),			
										'archive-num-excerpt'=> array(
											'title'=> __('Search - Archive Num Excerpt (Word)' ,'gdlr_translate'),
											'type'=> 'text',	
											'default'=> '25',
											'description'=> __('This is a number of word (decided by spaces) that you want to show on the post excerpt. <strong>Use 0 to hide the excerpt, -1 to show full posts and use the wordpress more tag</strong>.', 'gdlr_translate')
										),
										'archive-thumbnail-size'=> array(
											'title'=> __('Thumbnail Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_thumbnail_list(),
											'default'=> 'small-grid-size',
											'description'=> __('Only effects to <strong>standard and gallery post format</strong>','gdlr_translate')
										),		
										'archive-portfolio-style'=> array(
											'title'=> __('Archive Portfolio Style' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'classic-portfolio' => __('Portfolio Classic Style', 'gdlr_translate'),
												'modern-portfolio' => __('Portfolio Modern Style', 'gdlr_translate'),
												'detail-portfolio' => __('Portfolio With Detail', 'gdlr_translate'),
											),
										),							
										'archive-portfolio-size'=> array(
											'title'=> __('Portfolio Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'1/4'=>'1/4',
												'1/3'=>'1/3',
												'1/2'=>'1/2',
												'1/1'=>'1/1'
											),
											'default'=>'1/3',
											'wrapper-class'=> 'classic-portfolio-wrapper modern-portfolio-wrapper archive-portfolio-style-wrapper'
										),	
										'archive-portfolio-num-excerpt'=> array(
											'title'=> __('Num Excerpt (Word)' ,'gdlr_translate'),
											'type'=> 'text',	
											'default'=> '25',
											'wrapper-class'=> 'detail-portfolio-wrapper archive-portfolio-style-wrapper',
											'description'=> __('This is a number of word (decided by spaces) that you want to show on the post excerpt. <strong>Use 0 to hide the excerpt, -1 to show full posts and use the wordpress more tag</strong>.', 'gdlr_translate')
										),
										'archive-portfolio-thumbnail-size'=> array(
											'title'=> __('Thumbnail Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_thumbnail_list(),
											'default'=> 'small-grid-size',
											'description'=> __('Only effects to <strong>standard and gallery post format</strong>','gdlr_translate')
										),	
										'archive-cause-style'=> array(
											'title'=> __('Archive Cause Style' ,'gdlr_translate'),
											'type'=> 'combobox',	
											'options'=> array(
												'1/4'=> __('1/4 Grid' ,'gdlr_translate'),
												'1/3'=> __('1/3 Grid' ,'gdlr_translate'),
												'1/2'=> __('1/2 Grid' ,'gdlr_translate'),
												'1/1'=> __('1/4 Grid' ,'gdlr_translate'),
												'medium'=> __('Medium' ,'gdlr_translate'),
												'full'=> __('Full' ,'gdlr_translate'),
											)
										),
										'archive-cause-num-excerpt'=> array(
											'title'=> __('Archive Cause Num Excerpt (Word)' ,'gdlr_translate'),
											'type'=> 'text',	
											'default'=> '25'
										),
										'archive-cause-thumbnail-size'=> array(
											'title'=> __('Archive Cause Thumbnail Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_thumbnail_list(),
											'default'=> 'small-grid-size',
											'description'=> __('Only effects to <strong>standard and gallery post format</strong>','gdlr_translate')
										),
									)
								),			

								'woocommerce-style' => array(
									'title' => __('Woocommerce Style', 'gdlr_translate'),
									'options' => array(	
										'all-products-per-row' => array(
											'title' => __('Products Per Row', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'1'=> '1',
												'2'=> '2',
												'3'=> '3',
												'4'=> '4',
												'5'=> '5'
											),
											'default' => '3'							
										),
										'all-products-sidebar' => array(
											'title' => __('All Products Sidebar', 'gdlr_translate'),
											'type' => 'radioimage',
											'options' => array(
												'no-sidebar'=>GDLR_PATH . '/include/images/no-sidebar.png',
												'both-sidebar'=>GDLR_PATH . '/include/images/both-sidebar.png', 
												'right-sidebar'=>GDLR_PATH . '/include/images/right-sidebar.png',
												'left-sidebar'=>GDLR_PATH . '/include/images/left-sidebar.png'
											),
											'default' => 'no-sidebar'							
										),
										'all-products-sidebar-left' => array(
											'title' => __('All Products Sidebar Left', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => $gdlr_sidebar_controller->get_sidebar_array(),		
											'wrapper-class'=>'left-sidebar-wrapper both-sidebar-wrapper all-products-sidebar-wrapper',											
										),
										'all-products-sidebar-right' => array(
											'title' => __('All Products Sidebar Right', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => $gdlr_sidebar_controller->get_sidebar_array(),
											'wrapper-class'=>'right-sidebar-wrapper both-sidebar-wrapper all-products-sidebar-wrapper',
										),		
										'single-products-sidebar' => array(
											'title' => __('Single Products Sidebar', 'gdlr_translate'),
											'type' => 'radioimage',
											'options' => array(
												'no-sidebar'=>GDLR_PATH . '/include/images/no-sidebar.png',
												'both-sidebar'=>GDLR_PATH . '/include/images/both-sidebar.png', 
												'right-sidebar'=>GDLR_PATH . '/include/images/right-sidebar.png',
												'left-sidebar'=>GDLR_PATH . '/include/images/left-sidebar.png'
											),
											'default' => 'no-sidebar'							
										),
										'single-products-sidebar-left' => array(
											'title' => __('Single Products Sidebar Left', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => $gdlr_sidebar_controller->get_sidebar_array(),		
											'wrapper-class'=>'left-sidebar-wrapper both-sidebar-wrapper single-products-sidebar-wrapper',											
										),
										'single-products-sidebar-right' => array(
											'title' => __('Single products Sidebar Right', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => $gdlr_sidebar_controller->get_sidebar_array(),
											'wrapper-class'=>'right-sidebar-wrapper both-sidebar-wrapper single-products-sidebar-wrapper',
										),											
									)
								),									
								
								'footer-style' => array(
									'title' => __('Footer - Copyright Style', 'gdlr_translate'),
									'options' => array(
										'show-footer' => array(
											'title' => __('Show Footer', 'gdlr_translate'),
											'type' => 'checkbox',
											'default' => 'enable'
										),											
										'footer-layout' => array(
											'title' => __('Footer Layout', 'gdlr_translate'),
											'type' => 'radioimage',
											'options' => array(
												'1'=>GDLR_PATH . '/include/images/footer-style1.png',
												'2'=>GDLR_PATH . '/include/images/footer-style2.png', 
												'3'=>GDLR_PATH . '/include/images/footer-style3.png',
												'4'=>GDLR_PATH . '/include/images/footer-style4.png',
												'5'=>GDLR_PATH . '/include/images/footer-style5.png',
												'6'=>GDLR_PATH . '/include/images/footer-style6.png'
											),
											'default' => '2'
										),
										'show-copyright' => array(
											'title' => __('Show Copyright', 'gdlr_translate'),
											'type' => 'checkbox',
											'default' => 'enable'
										),
									)
								),		

								'import-export-option' => array(
									'title' => __('Import/Export Option', 'gdlr_translate'),
									'options' => array(
										'export-option' => array(
											'title' => __('Export Option', 'gdlr_translate'),
											'type' => 'custom',
											'option' => 
												'<input type="button" id="gdlr-export" class="gdl-button" value="' . __('Export', 'gdlr_translate') . '" />' .
												'<textarea class="full-width"></textarea>'
										),
										'import-option' => array(
											'title' => __('Import Option', 'gdlr_translate'),
											'type' => 'custom',
											'option' => 
												'<input type="button" id="gdlr-import" class="gdl-button" value="' . __('Import', 'gdlr_translate') . '" />' .
												'<textarea class="full-width"></textarea>'
										),										
									)
								),									
							
							)
						),

						// overall elements menu
						'overall-elements' => array(
							'title' => __('Overall Elements', 'gdlr_translate'),
							'icon' => GDLR_PATH . '/include/images/icon-overall-elements.png',
							'options' => array(
	
								'top-bar' => array(
									'title' => __('Top Bar', 'gdlr_translate'),
									'options' => array(
										'enable-top-bar' => array(
											'title' => __('Enable Top Bar', 'gdlr_translate'),
											'type' => 'checkbox',									
										),
										'top-bar-left-text' => array(
											'title' => __('Top Bar Left Text', 'gdlr_translate'),
											'type' => 'textarea',									
										),
										'top-bar-right-text' => array(
											'title' => __('Top Bar Right Text', 'gdlr_translate'),
											'type' => 'textarea',									
										),
									)
								),
	
								'header-logo' => array(
									'title' => __('Header - Logo', 'gdlr_translate'),
									'options' => array(
										'menu-alignment' => array(
											'title' => __('Menu Alignment', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'center'=> __('Center', 'gdlr_translate'),
												'left'=> __('Left', 'gdlr_translate'),
												'right'=> __('Right', 'gdlr_translate'),
											),
											'default' => 'right',
											'data-type' => 'text',
										),										
										'enable-float-menu' => array(
											'title' => __('Enable Float Menu', 'gdlr_translate'),
											'type' => 'checkbox'
										),
										'logo-id' => array(
											'title' => __('Upload Logo', 'gdlr_translate'),
											'button' => __('Set As Logo', 'gdlr_translate'),
											'type' => 'upload'
										),	
										'logo-max-width' => array(
											'title' => __('Logo Width', 'gdlr_translate'),
											'type' => 'text',
											'default' => '237',
											'data-type' => 'pixel',
											'selector' => '.gdlr-logo{ max-width: #gdlr#; }',
											'description' => __('You may upload 2x size image and limit the logo width for retina display', 'gdlr_translate')
										),											
										'logo-top-margin' => array(
											'title' => __('Logo Top Margin', 'gdlr_translate'),
											'type' => 'text',
											'default' => '40',
											'selector' => '.gdlr-logo{ margin-top: #gdlr#; }',
											'data-type' => 'pixel'
										),
										'logo-bottom-margin' => array(
											'title' => __('Logo Bottom Margin', 'gdlr_translate'),
											'type' => 'text',
											'default' => '40',
											'selector' => '.gdlr-logo{ margin-bottom: #gdlr#; }',
											'data-type' => 'pixel'
										),
										'logo-right-text' => array(
											'title' => __('Logo Right/Left Text', 'gdlr_translate'),
											'type' => 'textarea',
											'wrapper-class' => 'logo-alignment-wrapper left-wrapper right-wrapper',
											'description' => __('Only when you select first header style with left or right logo alignment', 'gdlr_translate')
										),		
										'right-text-top-margin' => array(
											'title' => __('Right Text Top Margin', 'gdlr_translate'),
											'type' => 'text',
											'default' => '15',
											'selector' => '.gdlr-logo-right-text{ margin-top: #gdlr#; }',
											'data-type' => 'pixel',
										),		
										'right-text-bottom-margin' => array(
											'title' => __('Right Text Bottom Margin', 'gdlr_translate'),
											'type' => 'text',
											'default' => '50',
											'selector' => '.gdlr-logo-right-text{ margin-bottom: #gdlr#; }',
											'data-type' => 'pixel',
										),
										'enable-top-search' => array(
											'title' => __('Enable Top Search', 'gdlr_translate'),
											'type' => 'checkbox'
										),
									)
								),	

								'page-title-background' => array(
									'title' => __('Page Title Background', 'gdlr_translate'),
									'options' => array(		
									
										'default-page-title' => array(
											'title' => __('Default Page Title Background', 'gdlr_translate'),
											'type' => 'upload',	
											'selector' => '.gdlr-page-title-wrapper { background-image: url(\'#gdlr#\'); }',
											'data-type' => 'upload'
										),	
										'default-post-title-background' => array(
											'title' => __('Default Post Title Background', 'gdlr_translate'),
											'type' => 'upload',	
											'selector' => 'body.single .gdlr-page-title-wrapper { background-image: url(\'#gdlr#\'); }',
											'data-type' => 'upload'
										),
										'default-portfolio-title-background' => array(
											'title' => __('Default Portfolio Title Background', 'gdlr_translate'),
											'type' => 'upload',	
											'selector' => 'body.single-portfolio .gdlr-page-title-wrapper { background-image: url(\'#gdlr#\'); }',
											'data-type' => 'upload'
										),
										'default-cause-title-background' => array(
											'title' => __('Default Cause Title Background', 'gdlr_translate'),
											'type' => 'upload',	
											'selector' => 'body.single-cause .gdlr-page-title-wrapper { background-image: url(\'#gdlr#\'); }',
											'data-type' => 'upload'
										),
										'default-search-archive-title-background' => array(
											'title' => __('Default Search Archive Title Background', 'gdlr_translate'),
											'type' => 'upload',	
											'selector' => 'body.archive .gdlr-page-title-wrapper, body.search .gdlr-page-title-wrapper { background-image: url(\'#gdlr#\'); }',
											'data-type' => 'upload'
										),
										'default-404-title-background' => array(
											'title' => __('Default 404 Title Background', 'gdlr_translate'),
											'type' => 'upload',	
											'selector' => 'body.error404 .gdlr-page-title-wrapper { background-image: url(\'#gdlr#\'); }',
											'data-type' => 'upload'
										),
									)					
								),																
								
								'header-social' => array(),
								
								'social-shares' => array(),
								
								'copyright' => array(
									'title' => __('Copyright', 'gdlr_translate'),
									'options' => array(		
									
										'copyright-left-text' => array(
											'title' => __('Copyright Left Text', 'gdlr_translate'),
											'type' => 'textarea',	
											'class' => 'full-width',
										),		
										'copyright-right-text' => array(
											'title' => __('Copyright Right Text', 'gdlr_translate'),
											'type' => 'textarea',	
											'class' => 'full-width',
										),											
									)					
								)
							)				
						),
						
						// font setting menu
						'font-settings' => array(
							'title' => __('Font Setting', 'gdlr_translate'),
							'icon' => GDLR_PATH . '/include/images/icon-font-settings.png',
							'options' => array(

								'font-family' => array(),								

								'font-size' => array(
									'title' => __('Font Size', 'gdlr_translate'),
									'options' => array(
										
										'content-font-size' => array(
											'title' => __('Content Size', 'gdlr_translate'),
											'type' => 'sliderbar',
											'default' => '14',
											'selector' => 'body{ font-size: #gdlr#; }',
											'data-type' => 'pixel'											
										),				
										'h1-font-size' => array(
											'title' => __('H1 Size', 'gdlr_translate'),
											'type' => 'sliderbar',
											'default' => '30',
											'selector' => 'h1{ font-size: #gdlr#; }',
											'data-type' => 'pixel'											
										),
										'h2-font-size' => array(
											'title' => __('H2 Size', 'gdlr_translate'),
											'type' => 'sliderbar',
											'default' => '25',
											'selector' => 'h2{ font-size: #gdlr#; }',
											'data-type' => 'pixel'											
										),
										'h3-font-size' => array(
											'title' => __('H3 Size', 'gdlr_translate'),
											'type' => 'sliderbar',
											'default' => '20',
											'selector' => 'h3{ font-size: #gdlr#; }',
											'data-type' => 'pixel'											
										),
										'h4-font-size' => array(
											'title' => __('H4 Size', 'gdlr_translate'),
											'type' => 'sliderbar',
											'default' => '18',
											'selector' => 'h4{ font-size: #gdlr#; }',
											'data-type' => 'pixel'											
										),
										'h5-font-size' => array(
											'title' => __('H5 Size', 'gdlr_translate'),
											'type' => 'sliderbar',
											'default' => '16',
											'selector' => 'h5{ font-size: #gdlr#; }',
											'data-type' => 'pixel'											
										),
										'h6-font-size' => array(
											'title' => __('H6 Size', 'gdlr_translate'),
											'type' => 'sliderbar',
											'default' => '15',
											'selector' => 'h6{ font-size: #gdlr#; }',
											'data-type' => 'pixel'											
										),
										
									)
								),								

								'upload-font' => array(
									'title' => __('Upload Font', 'gdlr_translate'),
									'options' => array(
										'upload-font' => array(
											'type' => 'uploadfont'
										)
									)
								),									
								
							)					
						),
							
						// elements color menu
						'elements-color' => array(
							'title' => __('Elements Color', 'gdlr_translate'),
							'icon' => GDLR_PATH . '/include/images/icon-elements-color.png',
							'options' => array(
							
								'skin-settings' => array(
									'title' => __('Cutom Skin', 'gdlr_translate'),
									'options' => array(
											'skin-settings' => array(
											'title' => __('Skin Settings', 'gdlr_translate'),
											'type' => 'skin-settings',
											'options' => array(
												'title'=>__('Title Color', 'gdlr_translate'),
												'title-hover'=>__('Title (Link) Hover Color', 'gdlr_translate'),
												'info'=>__('Caption / Info Color', 'gdlr_translate'),
												'link'=>__('Link Color', 'gdlr_translate'),
												'link-hover'=>__('Link Hover Color', 'gdlr_translate'),
												'element-background'=>__('Element Background', 'gdlr_translate'),
												'content'=>__('Content Color', 'gdlr_translate'),
												'icon'=>__('Icon Color', 'gdlr_translate'),
												'border'=>__('Border Color', 'gdlr_translate'),
												'button-text'=>__('Button Text Color', 'gdlr_translate'),
												'button-background'=>__('Button Background', 'gdlr_translate'),
											)
										),	
									)
								),							

								'main-navigation-color' => array(
									'title' => __('Header / Main Menu', 'gdlr_translate'),
									'options' => array(
										'header-text-color' => array(
											'title' => __('Header Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.top-navigation-wrapper, .gdlr-logo-right-text{ color: #gdlr#; }'
										),
										'header-link-color' => array(
											'title' => __('Header Link Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.top-navigation-wrapper a, .gdlr-logo-right-text a{ color: #gdlr#; }'
										),
										'header-link-hover-color' => array(
											'title' => __('Header Link Hover Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#B2E6FF',
											'selector'=> '.top-navigation-wrapper a:hover, .gdlr-logo-right-text a:hover{ color: #gdlr#; }'
										),
										'header-background-color' => array(
											'title' => __('Header Background Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-header-wrapper{ background-color: #gdlr#; }'
										),									
										'main-navigation-text' => array(
											'title' => __('Main Navigation Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-main-menu > li > a{ color: #gdlr#; }'
										),	
										'main-navigation-text-hover' => array(
											'title' => __('Main Navigation Text Hover/Current', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#b7b7b7',
											'selector'=> '.gdlr-main-menu > li:hover > a, .gdlr-main-menu > li.current-menu-item > a, ' .
												'.gdlr-main-menu > li.current-menu-ancestor > a{ color: #gdlr#; }'
										),
										'main-navigation2-background' => array(
											'title' => __('Main Navigation Background ', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#575757',
											'selector'=> '.gdlr-navigation, .gdlr-navigation-wrapper.gdlr-fixed-menu{ background-color: #gdlr#; }'
										),
										'main-navigation-text-background-hover' => array(
											'title' => __('Main Navigation Text Background Hover/Current', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#474747',
											'selector'=> '.gdlr-main-menu > li:hover > a, .gdlr-main-menu > li.current-menu-item > a, ' .
												'.gdlr-main-menu > li.current-menu-ancestor > a{ background-color: #gdlr#; }' .
												'#gdlr-main-navigation, .gdlr-header-style-2.gdlr-centered .gdlr-navigation-wrapper.gdlr-fixed-menu{ border-bottom-color: #gdlr#; }'
										),
										'sub-menu-top-border' => array(
											'title' => __('Sub Menu Top Border', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#444444',
											'selector'=> '.gdlr-main-menu > .gdlr-normal-menu .sub-menu, .gdlr-main-menu > .gdlr-mega-menu ' . 
												'.sf-mega{ border-top-color: #gdlr#; }'
										),			
										'sub-menu-background' => array(
											'title' => __('Sub Menu Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#444444',
											'selector'=> '.gdlr-main-menu > .gdlr-normal-menu li , .gdlr-main-menu > .gdlr-mega-menu .sf-mega{ background-color: #gdlr#; }'
										),		
										'sub-menu-text' => array(
											'title' => __('Sub Menu Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#bebebe',
											'selector'=> '.gdlr-main-menu > li > .sub-menu a, .gdlr-main-menu > li > .sf-mega a{ color: #gdlr#; }'
										),
										'sub-menu-text-hover' => array(
											'title' => __('Sub Menu Text Hover/Current', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-main-menu > li > .sub-menu a:hover, .gdlr-main-menu > li > .sub-menu .current-menu-item > a, ' .
												'.gdlr-main-menu > li > .sub-menu .current-menu-ancestor > a, .gdlr-main-menu > li > .sf-mega a:hover, ' .
												'.gdlr-main-menu > li > .sf-mega .current-menu-item > a, .gdlr-main-menu > li > .sf-mega .current-menu-ancestor > a{ color: #gdlr#; } ' .
												'.gdlr-main-menu .gdlr-normal-menu li > a.sf-with-ul:after { border-left-color: #gdlr#; } '
										),		
										'sub-mega-menu-text-hover' => array(
											'title' => __('Sub Mega Menu Background Hover', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#272727',
											'selector'=> '.gdlr-main-menu .sf-mega-section-inner > ul > li > a:hover, ' . 
												'.gdlr-main-menu .sf-mega-section-inner > ul > li.current-menu-item > a { background-color: #gdlr#; } '
										),										
										'sub-menu-divider' => array(
											'title' => __('Sub Menu Divider', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#555555',
											'selector'=> '.gdlr-main-menu > li > .sub-menu *, .gdlr-main-menu > li > .sf-mega *{ border-color: #gdlr#; }'
										),				
										'sub-menu-mega-title' => array(
											'title' => __('Sub (Mega) Menu Title', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-main-menu > li > .sf-mega .sf-mega-section-inner > a { color: #gdlr#; }'
										),			
										'sub-menu-mega-title-hover' => array(
											'title' => __('Sub (Mega) Menu Title Hover/Current', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-main-menu > li > .sf-mega .sf-mega-section-inner > a:hover, ' . 
												'.gdlr-main-menu > li > .sf-mega .sf-mega-section-inner.current-menu-item > a, ' .
												'.gdlr-main-menu > li > .sf-mega .sf-mega-section-inner.current-menu-ancestor > a { color: #gdlr#; }'
										),			
										'mobile-menu-background' => array(
											'title' => __('Mobile Menu Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#303030',
											'selector'=> '#gdlr-responsive-navigation.dl-menuwrapper button { background-color: #gdlr#; }'
										),
										'mobile-menu-background-hover' => array(
											'title' => __('Mobile Menu Background Hover', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#1e1e1e',
											'selector'=> '#gdlr-responsive-navigation.dl-menuwrapper button:hover, ' .
												'#gdlr-responsive-navigation.dl-menuwrapper button.dl-active, ' . 
												'#gdlr-responsive-navigation.dl-menuwrapper ul{ background-color: #gdlr#; }'
										),
									)
								),
								
								'body-color' => array(
									'title' => __('Body', 'gdlr_translate'),
									'options' => array(
										'body-background' => array(
											'title' => __('Body Background ( for boxed style )', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#dddddd',
											'selector'=> 'body{ background-color: #gdlr#; }'
										),	
										'container-backgrond' => array(
											'title' => __('Container Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.body-wrapper, .gdlr-single-lightbox-container{ background-color: #gdlr#; }' . 
												'.gdlr-button.without-border, input[type="button"], input[type="submit"]{ color: #gdlr#; }'
											
										),
										'page-title-color' => array(
											'title' => __('Page Title Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-page-title{ color: #gdlr#; }'
										),		
										'page-caption-color' => array(
											'title' => __('Page Caption Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-page-caption{ color: #gdlr#; }'
										),	
										'heading-color' => array(
											'title' => __('Heading Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#454545',
											'selector'=> 'h1, h2, h3, h4, h5, h6, .gdlr-title, .gdlr-title a{ color: #gdlr#; }'
										),		
										'item-title-color' => array(
											'title' => __('Item Title Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#494949',
											'selector'=> '.gdlr-item-title-wrapper{ color: #gdlr#; }'
										),
										'item-title-caption-color' => array(
											'title' => __('Item Title Caption Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#9b9b9b',
											'selector'=> '.gdlr-item-title-wrapper .gdlr-item-caption{ color: #gdlr#; }'
										),	
										'body-text-color' => array(
											'title' => __('Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#808080',
											'selector'=> 'body{ color: #gdlr#; }'
										),		
										'body-link-color' => array(
											'title' => __('Link Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#50bbf4',
											'selector'=> 'a{ color: #gdlr#; }'
										),			
										'body-link-hover-color' => array(
											'title' => __('Link Hover Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#87d9ff',
											'selector'=> 'a:hover{ color: #gdlr#; }'
										),			
										'border-color' => array(
											'title' => __('Border Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f3f3f3',
											'selector'=> 'body *{ border-color: #gdlr#; }'
										),		
										'404-box-background' => array(
											'title' => __('404 Box Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#d65938',
											'selector'=> '.page-not-found-block{ background-color: #gdlr#; }'
										),		
										'404-box-text' => array(
											'title' => __('404 Box Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.page-not-found-block{ color: #gdlr#; }'
										),		
										'404-search-background' => array(
											'title' => __('404 Search Box Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#963a20',
											'selector'=> '.page-not-found-search  .gdl-search-form input[type="text"]{ background-color: #gdlr#; }'
										),		
										'404-search-text' => array(
											'title' => __('404 Search Box Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#d57f5c',
											'selector'=> '.page-not-found-search  .gdl-search-form input[type="text"]{ color: #gdlr#; }'
										),	
										'top-search-background' => array(
											'title' => __('Header Search Box Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#7ed6ff',
											'selector'=> '.gdlr-header-search .gdl-search-form input[type="text"]{ background-color: #gdlr#; }'
										),
										'top-search-text' => array(
											'title' => __('Header Search Box Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-header-search .gdl-search-form input[type="text"]{ color: #gdlr#; }'
										),										
									)	
								),	
								
								'sidebar-color' => array(
									'title' => __('Sidebar Color', 'gdlr_translate'),
									'options' => array(
										'sidebar-title-color' => array(
											'title' => __('Sidebar Title Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#383838',
											'selector'=> '.gdlr-sidebar .gdlr-widget-title{ color: #gdlr#; }'
										),	
										'sidebar-border-color' => array(
											'title' => __('Sidebar Border Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#eeeeee',
											'selector'=> '.gdlr-sidebar *{ border-color: #gdlr#; }'
										),
										'sidebar-list-circle' => array(
											'title' => __('Sidebar List Circle', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#bdbdbd',
											'selector'=> '.gdlr-sidebar ul li:before { border-color: #gdlr#; }'
										),
										'search-form-background' => array(
											'title' => __('Search Form Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f7f7f7',
											'selector'=> '.gdl-search-form input{ background-color: #gdlr#; }'
										),
										'search-form-text-color' => array(
											'title' => __('Search Form Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#9d9d9d',
											'selector'=> '.gdl-search-form input{ color: #gdlr#; }'
										),
										'search-form-border-color' => array(
											'title' => __('Search Form Border Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ebebeb',
											'selector'=> '.gdl-search-form input{ border-color: #gdlr#; }'
										),
										'tag-cloud-background' => array(
											'title' => __('Tagcloud Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.tagcloud a{ background-color: #gdlr#; }'
										),
										'tag-cloud-text' => array(
											'title' => __('Tagcloud Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.tagcloud a, .tagcloud a:hover{ color: #gdlr#; }'
										),
									)
								),

								'content-item-1' => array(
									'title' => __('Content Elements', 'gdlr_translate'),
									'options' => array(
										'accordion-background' => array(
											'title' => __('Accordion (Style 1) Title Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f5f5f5',
											'selector'=> '.gdlr-accordion-item.style-1 .accordion-title{ background-color: #gdlr#; }'
										),			
										'accordion-text' => array(
											'title' => __('Accordion (Style 1) Title Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#3c3c3c',
											'selector'=> '.gdlr-accordion-item.style-1 .accordion-title{ color: #gdlr#; }'
										),			
										'accordion-icon-background' => array(
											'title' => __('Accordion (Style 1) Icon Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-accordion-item.style-1 .accordion-title i{ background-color: #gdlr#; }'
										),			
										'accordion-icon-color' => array(
											'title' => __('Accordion (Style 1) Icon Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-accordion-item.style-1 .accordion-title i{ color: #gdlr#; }'
										),											
										'box-with-icon-background' => array(
											'title' => __('Box With Icon Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f5f5f5',
											'selector'=> '.gdlr-box-with-icon-item{ background-color: #gdlr#; }'
										),	
										'box-with-icon-title' => array(
											'title' => __('Box With Icon Title Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#585858',
											'selector'=> '.gdlr-box-with-icon-item > i, ' . 
												'.gdlr-box-with-icon-item .box-with-icon-title{ color: #gdlr#; }'
										),											
										'box-with-icon-text' => array(
											'title' => __('Box With Icon Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#929292',
											'selector'=> '.gdlr-box-with-icon-item{ color: #gdlr#; }'
										),			
										'button-text-color' => array(
											'title' => __('Button Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-button, .gdlr-button:hover, .gdlr-amount-button, .gdlr-amount-button:hover{ color: #gdlr#; }'
										),	
										'button-background-color' => array(
											'title' => __('Button Background Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-button, input[type="button"], input[type="submit"], .gdlr-amount-button.active, .gdlr-amount-button:hover{ background-color: #gdlr#; }'  .
												'.gdlr-payment-method img.gdlr-active{ border-color: #gdlr#; }'
										),										
										'button-border-color' => array(
											'title' => __('Button Border Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#6ba4be',
											'selector'=> '.gdlr-button.with-border, .gdlr-paypal-form-wrapper input[type="submit"]{ border-color: #gdlr#; }'
										),										
										'column-service-title-color' => array(
											'title' => __('Column Service Title Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#333333',
											'selector'=> '.column-service-title{ color: #gdlr#; }'
										),										
										'column-service-content-color' => array(
											'title' => __('Column Service Content Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#909090',
											'selector'=> '.column-service-content{ color: #gdlr#; }'
										),										
										'column-service-icon-color' => array(
											'title' => __('Column Service Icon Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.column-service-icon i{ color: #gdlr#; }'
										),										
										'column-service-icon-background-color' => array(
											'title' => __('Column Service Icon Background (Style 2) Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#3e3e3e',
											'selector'=> '.gdlr-column-service-item.gdlr-type-2 .column-service-icon{ background-color: #gdlr#; }'
										),										
										'feature-media-title-color' => array(
											'title' => __('Feature Media Title Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#616161',
											'selector'=> '.gdlr-feature-media-item .feature-media-title{ color: #gdlr#; }'
										),										
										'feature-media-caption-color' => array(
											'title' => __('Feature Media Caption Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#969696',
											'selector'=> '.gdlr-feature-media-item .feature-media-caption{ color: #gdlr#; }'
										),
										'list-with-icon-title-color' => array(
											'title' => __('List With Icon Title Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#333333',
											'selector'=> '.list-with-icon .list-with-icon-title{ color: #gdlr#; }'
										),
										'pie-chart-title-color' => array(
											'title' => __('Pie Chart Title Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#313131',
											'selector'=> '.gdlr-pie-chart-item .pie-chart-title{ color: #gdlr#; }'
										),	
										'price-background' => array(
											'title' => __('Price Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f9f9f9',
											'selector'=> '.gdlr-price-inner-item{ background-color: #gdlr#; }'
										),
										'price-title-background' => array(
											'title' => __('Price Title Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#454545',
											'selector'=> '.gdlr-price-item .price-title-wrapper{ background-color: #gdlr#; }'
										),
										'price-title-text' => array(
											'title' => __('Price Title Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-price-item .price-title{ color: #gdlr#; }'
										),
										'price-tag-background' => array(
											'title' => __('Price Tag Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#838383',
											'selector'=> '.gdlr-price-item .price-tag{ background-color: #gdlr#; }'
										),
										'active-price-tag-background' => array(
											'title' => __('Active Price Tag Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-price-item .best-price .price-tag{ background-color: #gdlr#; }'
										),
										'price-tag-text' => array(
											'title' => __('Price Tag Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-price-item .price-tag{ color: #gdlr#; }'
										),							
									)	
								),								

								'content-item-2' => array(
									'title' => __('Content Elements 2', 'gdlr_translate'),
									'options' => array(		
										'process-icon-background' => array(
											'title' => __('Process Icon Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f3f3f3',
											'selector'=> '.gdlr-process-tab .gdlr-process-icon{ background-color: #gdlr#; }'
										),
										'process-icon-border' => array(
											'title' => __('Process Icon Border', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#e3e3e3',
											'selector'=> '.gdlr-process-tab .gdlr-process-icon{ border-color: #gdlr#; }'
										),
										'process-icon-color' => array(
											'title' => __('Process Icon Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#aaaaaa',
											'selector'=> '.gdlr-process-tab .gdlr-process-icon i{ color: #gdlr#; }'
										),
										'process-line-color' => array(
											'title' => __('Process Line Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#e3e3e3',
											'selector'=> '.gdlr-process-tab .process-line .process-line-divider{ border-color: #gdlr#; } ' .
												'.gdlr-process-tab .process-line .icon-chevron-down, ' .
												'.gdlr-process-tab .process-line .icon-chevron-right{ color: #gdlr#; }'
										),
										'process-title-color' => array(
											'title' => __('Process Title', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#454545',
											'selector'=> '.gdlr-process-wrapper .gdlr-process-tab .gdlr-process-title{ color: #gdlr#; }'
										),
										'stunning-text-title-color' => array(
											'title' => __('Stunning Text Title Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#414141',
											'selector'=> '.stunning-text-title{ color: #gdlr#; }'
										),
										'stunning-text-caption-color' => array(
											'title' => __('Stunning Text Caption Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#949494',
											'selector'=> '.stunning-text-caption{ color: #gdlr#; }'
										),
										'stunning-text-background' => array(
											'title' => __('Stunning Text Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f3f3f3',
											'selector'=> '.gdlr-stunning-text-item.with-padding{ background-color: #gdlr#; }'
										),
										'stunning-text-border' => array(
											'title' => __('Stunning Text Border', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f3f3f3',
											'selector'=> '.gdlr-stunning-text-item.with-border{ border-color: #gdlr#; }'
										),
										'tab-title-background' => array(
											'title' => __('Tab Title Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f9f9f9',
											'selector'=> '.tab-title-wrapper .tab-title{ background-color: #gdlr#; }'
										),			
										'tab-title-color' => array(
											'title' => __('Tab Title Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#3b3b3b',
											'selector'=> '.tab-title-wrapper .tab-title{ color: #gdlr#; }'
										),	
										'tab-title-content' => array(
											'title' => __('Tab Title Content Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.tab-title-wrapper .tab-title.active, .tab-content-wrapper{ background-color: #gdlr#; }'
										),										
										'table-head-background' => array(
											'title' => __('Table Head Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> 'table tr th{ background-color: #gdlr#; }'
										),			
										'table-head-text' => array(
											'title' => __('Table Head Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> 'table tr th{ color: #gdlr#; }'
										),	
										'table-style2-odd-background' => array(
											'title' => __('Table (Style2) Odd Row Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f9f9f9',
											'selector'=> 'table.style-2 tr:nth-child(odd){ background-color: #gdlr#; }'
										),			
										'table-style2-odd-text' => array(
											'title' => __('Table (Style2) Odd Row Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#949494',
											'selector'=> 'table.style-2 tr:nth-child(odd){ color: #gdlr#; }'
										),
										'table-style2-even-background' => array(
											'title' => __('Table (Style2) Even Row Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f3f3f3',
											'selector'=> 'table.style-2 tr:nth-child(even){ background-color: #gdlr#; }'
										),			
										'table-style2-even-text' => array(
											'title' => __('Table (Style2) Even Row Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#949494',
											'selector'=> 'table.style-2 tr:nth-child(even){ color: #gdlr#; }'
										),		
									)
								),
								
								'blog-color' => array(
									'title' => __('Blog Color', 'gdlr_translate'),
									'options' => array(
										'blog-title-color' => array(
											'title' => __('Blog Title Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#545454',
											'selector'=> '.gdlr-blog-title, .gdlr-blog-title a{ color: #gdlr#; }'
										),		
										'blog-title-hover-color' => array(
											'title' => __('Blog Title Hover Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-blog-title a:hover{ color: #gdlr#; }'
										),	
										'blog-info-color' => array(
											'title' => __('Blog Info Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#c2c2c2',
											'selector'=> '.blog-info, .blog-info a, .blog-info i{ color: #gdlr#; }'
										),
										'blog-full-date-color' => array(
											'title' => __('Blog Full Day Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#121212',
											'selector'=> '.gdlr-blog-full .blog-date-wrapper .blog-date-day{ color: #gdlr#; }'
										),
										'blog-full-month-color' => array(
											'title' => __('Blog Full Month/Year Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#5c5c5c',
											'selector'=> '.gdlr-blog-full .blog-date-wrapper .blog-date-month, ' .
												'.gdlr-blog-full .blog-date-wrapper .blog-date-year{ color: #gdlr#; }'
										),
										'blog-full-date-bottom-border-color' => array(
											'title' => __('Blog Full Date Bottom Border Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-blog-full .blog-date-wrapper .blog-date-year{ border-bottom-color: #gdlr#; }'
										),
										'blog-sticky-background' => array(
											'title' => __('Blog Sticky Bar Backgrond', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-blog-thumbnail .gdlr-sticky-banner{ background-color: #gdlr#; }'
										),
										'blog-sticky-text' => array(
											'title' => __('Blog Sticky Bar Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-blog-thumbnail .gdlr-sticky-banner{ color: #gdlr#; }'
										),
										'blog-share-background' => array(
											'title' => __('Blog Social Share Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f3f3f3',
											'selector'=> '.gdlr-social-share, .gdlr-social-share a{ background-color: #gdlr#; }'
										),			
										'blog-share-title' => array(
											'title' => __('Blog Social Share Title', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#353535',
											'selector'=> '.gdlr-social-share .social-share-title{ color: #gdlr#; }'
										),										
										'blog-tag-background' => array(
											'title' => __('Blog Tag Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-standard-style .gdlr-single-blog-tag a{ background-color: #gdlr#; }'
										),			
										'blog-tag-text-color' => array(
											'title' => __('Blog Tag Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-standard-style .gdlr-single-blog-tag a{ color: #gdlr#; }'
										),			
										'blog-aside-background' => array(
											'title' => __('Blog Aside Format Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.format-aside .gdlr-blog-content{ background-color: #gdlr#; }'
										),			
										'blog-aside-text' => array(
											'title' => __('Blog Aside Format Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.format-aside .gdlr-blog-content{ color: #gdlr#; }'
										),	
										'blog-quote-text-color' => array(
											'title' => __('Blog Quote Format Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#8d8d8d',
											'selector'=> '.format-quote .gdlr-top-quote blockquote{ color: #gdlr#; }'
										),
										'blog-quote-author-color' => array(
											'title' => __('Blog Quote Format Author', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.format-quote .gdlr-quote-author{ color: #gdlr#; }'
										),
										'blog-navigation-background' => array(
											'title' => __('Blog Navigation Background ( Prev / Next )', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f3f3f3',
											'selector'=> '.gdlr-single-nav > div i{ background-color: #gdlr#; }'
										),		
										'blog-navigation-text' => array(
											'title' => __('Blog Navigation Icon ( Prev / Next )', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#8d8d8d',
											'selector'=> '.gdlr-single-nav > div i{ color: #gdlr#; }'
										),																				
									)
								),			

								'cause-color' => array(
									'title' => __('Cause Color', 'gdlr_translate'),
									'options' => array(
										'cause-title-color' => array(
											'title' => __('Cause Title Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#353535',
											'selector'=> '.cause-title a{ color: #gdlr#; }'
										),
										'cause-title-hover-color' => array(
											'title' => __('Cause Title Hover Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#969696',
											'selector'=> '.cause-title a:hover{ color: #gdlr#; }'
										),
										'donation-bar-background' => array(
											'title' => __('Donation Bar Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#eeeeee',
											'selector'=> '.gdlr-donation-bar-wrapper{ background-color: #gdlr#; }'
										),
										'donation-bar-progress-background' => array(
											'title' => __('Donation Bar Progress Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f37936',
											'selector'=> '.gdlr-donation-bar-wrapper .gdlr-donation-bar{ background-color: #gdlr#; }'
										),
										'cause-donation-goal-text' => array(
											'title' => __('Cause Donation Goal Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f37936',
											'selector'=> '.gdlr-donation-goal-text{ color: #gdlr#; }'
										),
										'cause-donation-goal-text-amount' => array(
											'title' => __('Cause Donation Goal Amount', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-donation-goal-text .goal{ color: #gdlr#; }'
										),
										'cause-info-color' => array(
											'title' => __('Cause Info Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#c2c2c2',
											'selector'=> '.gdlr-cause-info .cause-info, .gdlr-cause-info .cause-info a{ color: #gdlr#; }'
										),
										'cause-pdf-text-color' => array(
											'title' => __('Cause PDF Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#484848',
											'selector'=> '.cause-info.cause-pdf, .cause-info.cause-pdf a{ color: #gdlr#; }'
										),
										'urgent-cause-overlay-color' => array(
											'title' => __('Urgent Cause Overlay', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#000000',
											'selector'=> '.urgent-cause-wrapper .urgent-cause-overlay{ background-color: #gdlr#; }'
										),
										'urgent-cause-text-color' => array(
											'title' => __('Urgent Cause Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.urgent-cause-wrapper, .urgent-cause-wrapper a, ' .
												'.urgent-cause-wrapper .gdlr-donation-goal-text{ color: #gdlr#; }'
										),
										'cause-search-background' => array(
											'title' => __('Cause Search Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#3f3f3f',
											'selector'=> '.gdlr-cause-search-wrapper{ background-color: #gdlr#; }'
										),
										'cause-search-text' => array(
											'title' => __('Cause Search Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-cause-search-wrapper .cause-search-title, ' .
												'.gdlr-cause-search-wrapper .cause-search-caption{ color: #gdlr#; }'
										),
										'cause-search-input-background' => array(
											'title' => __('Cause Search Input Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-cause-search-wrapper .gdlr-combobox, ' . 
												'.gdlr-cause-search-wrapper input[type="text"]{ background-color: #gdlr#; }'
										),
										'cause-search-input-text' => array(
											'title' => __('Cause Search Input Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#a5a5a5',
											'selector'=> '.gdlr-cause-search-wrapper .gdlr-combobox select, ' . 
												'.gdlr-cause-search-wrapper input[type="text"]{ color: #gdlr#; }'
										),
									)
								),

								'portfolio-color' => array(
									'title' => __('Portfolio / Pagination', 'gdlr_translate'),
									'options' => array(				
										'portfolio-filter-text' => array(
											'title' => __('Portfolio Filter Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#e5e5e5',
											'selector'=> '.portfolio-item-filter a{ color: #gdlr#; }'
										),	
										'portfolio-filter-text-hover' => array(
											'title' => __('Portfolio Filter Text Hover', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#474747',
											'selector'=> '.portfolio-item-filter a:hover, .portfolio-item-filter a.active, ' . 
												'.portfolio-item-filter .sep{ color: #gdlr#; }'
										),										
										'portfolio-thumbnail-hover-background' => array(
											'title' => __('Portfolio Thumbnail Hover Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#000000',
											'selector'=> '.gdlr-image-link-shortcode .gdlr-image-link-overlay, ' .
												'.portfolio-thumbnail .portfolio-overlay{ background-color: #gdlr#; }'
										),
										'portfolio-thumbnail-hover-icon' => array(
											'title' => __('Portfolio Thumbnail Hover Icon Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-image-link-shortcode .gdlr-image-link-icon, ' . 
												'.portfolio-thumbnail .portfolio-icon i{ color: #gdlr#; }'
										),										
										'portfolio-title-color' => array(
											'title' => __('Portfolio Title', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#4e4e4e',
											'selector'=> '.portfolio-title a{ color: #gdlr#; }'
										),
										'portfolio-title-hover-color' => array(
											'title' => __('Portfolio Title Hover', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#7f7f7f',
											'selector'=> '.portfolio-title a:hover{ color: #gdlr#; }'
										),
										'portfolio-info-color' => array(
											'title' => __('Portfolio Info', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#949494',
											'selector'=> '.portfolio-info, ' .
												'.portfolio-info a{ color: #gdlr#; }'
										),			
										'modern-portfolio-title-color' => array(
											'title' => __('Modern Portfolio Title Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.portfolio-item-holder .gdlr-modern-portfolio .portfolio-title a{ color: #gdlr#; }'
										),
										'pagination-background' => array(
											'title' => __('Pagination Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f3f3f3',
											'selector'=> '.gdlr-pagination .page-numbers{ background-color: #gdlr#; }'
										),		
										'pagination-text-color' => array(
											'title' => __('Pagination Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#979797',
											'selector'=> '.gdlr-pagination .page-numbers{ color: #gdlr#; }'
										),
										'pagination-background-hover' => array(
											'title' => __('Pagination Background-hover', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-pagination .page-numbers:hover, ' . 
												'.gdlr-pagination .page-numbers.current{ background-color: #gdlr#; }'
										),		
										'pagination-text-color-hover' => array(
											'title' => __('Pagination Text Color Hover', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-pagination .page-numbers:hover, ' . 
												'.gdlr-pagination .page-numbers.current{ color: #gdlr#; }'
										),									
									)
								),
								
								'personnel-testimonial-color' => array(
									'title' => __('Personnel / Testimonial', 'gdlr_translate'),
									'options' => array(
										'personnel-box-background' => array(
											'title' => __('Personnel Box Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f5f5f5',
											'selector'=> '.gdlr-personnel-item .personnel-item-inner{ background-color: #gdlr#; }'
										),	
										'round-personnel-hover-background' => array(
											'title' => __('Round Personnel Hover Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-personnel-item.round-style .personnel-item{ background-color: #gdlr#; }'
										),										
										'personnel-author-text' => array(
											'title' => __('Personnel Author Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#3b3b3b',
											'selector'=> '.gdlr-personnel-item .personnel-author{ color: #gdlr#; }'
										),			
										'personnel-author-border' => array(
											'title' => __('Personnel Author Image Border', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-personnel-item .personnel-author-image{ border-color: #gdlr#; }'
										),		
										'personnel-position-color' => array(
											'title' => __('Personnel Position Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#acacac',
											'selector'=> '.gdlr-personnel-item .personnel-position{ color: #gdlr#; }'
										),		
										'personnel-content-color' => array(
											'title' => __('Personnel Content Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#959595',
											'selector'=> '.gdlr-personnel-item .personnel-content{ color: #gdlr#; }'
										),		
										'personnel-social-icon-color' => array(
											'title' => __('Personnel Social Icon Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#3b3b3b',
											'selector'=> '.gdlr-personnel-item .personnel-social i{ color: #gdlr#; }'
										),			
										'testimonial-box-background' => array(
											'title' => __('Testimonial Box Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f5f5f5',
											'selector'=> '.gdlr-testimonial-item .testimonial-item-inner, ' . 
												'.gdlr-testimonial-item .testimonial-author-image{ background-color: #gdlr#; }'
										),			
										'testimonial-content-color' => array(
											'title' => __('Testimonial Content Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#9b9b9b',
											'selector'=> '.gdlr-testimonial-item .testimonial-content{ color: #gdlr#; }'
										),
										'testimonial-author-text' => array(
											'title' => __('Testimonial Author Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-testimonial-item .testimonial-author{ color: #gdlr#; }'
										),		
										'testimonial-author-position' => array(
											'title' => __('Testimonial Author Position', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#4d4d4d',
											'selector'=> '.gdlr-testimonial-item .testimonial-position{ color: #gdlr#; }'
										),	
										'testimonial-author-image-border' => array(
											'title' => __('Testimonial Author Image Border', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-testimonial-item .testimonial-author-image{ border-color: #gdlr#; }'
										),				
										'testimonial-boxed-style-shadow' => array(
											'title' => __('Testimonial Shadow ( Box Style )', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#dddddd',
											'selector'=> '.gdlr-testimonial-item.box-style .testimonial-item-inner:after' . 
												'{ border-top-color: #gdlr#; border-left-color: #gdlr#; }'
										),										
									)
								),

								'slider-input-color' => array(
									'title' => __('Slider / Gallery / Input', 'gdlr_translate'),
									'options' => array(
										'gallery-thumbnail-frame' => array(
											'title' => __('Gallery ( Thumbnail ) Frame', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#e5e5e5',
											'selector'=> '.gdlr-gallery-thumbnail .gallery-item{ background-color: #gdlr#; }'
										),
										'gallery-caption-background' => array(
											'title' => __('Gallery ( Thumbnail ) Caption Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#000000',
											'selector'=> '.gdlr-gallery-thumbnail-container .gallery-caption{ background-color: #gdlr#; }'
										),	
										'gallery-caption-text' => array(
											'title' => __('Gallery ( Thumbnail ) Caption Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-gallery-thumbnail-container .gallery-caption{ color: #gdlr#; }'
										),		
										'slider-bullet-background-hover' => array(
											'title' => __('Slider Bullet Background Hover', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.nivo-controlNav a:hover, .nivo-controlNav a.active, ' . 
												'.flex-control-paging li a:hover, .flex-control-paging li a.flex-active,' . 
												'.ls-flawless .ls-bottom-slidebuttons a.ls-nav-active, ' .
												'.ls-flawless .ls-bottom-slidebuttons a:hover { background-color: #gdlr#; }'
										),										
										'slider-bullet-border' => array(
											'title' => __('Slider Bullet Border Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.nivo-controlNav a, .flex-control-paging li a, ' . 
												'.ls-flawless .ls-bottom-slidebuttons a{ border-color: #gdlr# !important; }'
										),	
										'slider-navigation-background' => array(
											'title' => __('Slider Navigation Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#000000',
											'selector'=> '.nivo-directionNav a, .flex-direction-nav a, .ls-flawless .ls-nav-prev, ' .
												'.ls-flawless .ls-nav-next{ background-color: #gdlr#; }'
										),
										'slider-navigation-icon' => array(
											'title' => __('Slider Navigation Icon', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> 'body .nivo-directionNav a, body .flex-direction-nav a, body .flex-direction-nav a:hover, ' .
												'.ls-flawless .ls-nav-prev, .ls-flawless .ls-nav-next{ color: #gdlr#; }'
										),
										'slider-caption-background' => array(
											'title' => __('Slider Caption Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#000000',
											'selector'=> '.gdlr-caption{ background-color: #gdlr#; }'
										),
										'slider-caption-title' => array(
											'title' => __('Slider Caption Title', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-caption-title, .gdlr-caption-title{ color: #gdlr#; }'
										),
										'slider-caption-text' => array(
											'title' => __('Slider Caption Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-caption-text{ color: #gdlr#; }'
										),
										'post-slider-caption-background' => array(
											'title' => __('Post Slider Caption Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.gdlr-caption-wrapper.post-slider .post-slider-caption-overlay{ background-color: #gdlr#; }'
										),
										'post-slider-caption-title' => array(
											'title' => __('Post Slider Caption Title', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-caption-wrapper.post-slider .gdlr-caption-title, ' . 
												'.gdlr-caption-wrapper.post-slider .gdlr-caption-title a{ color: #gdlr#; }'
										),
										'post-slider-caption-text' => array(
											'title' => __('Post Slider Caption Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#dddddd',
											'selector'=> '.gdlr-caption-wrapper.post-slider .gdlr-caption-text, ' . 
												'.gdlr-caption-wrapper.post-slider .gdlr-caption-text a, ' . 
												'.gdlr-caption-wrapper.post-slider .blog-info, ' . 
												'.gdlr-caption-wrapper.post-slider .blog-info a, ' . 
												'.gdlr-caption-wrapper.post-slider .blog-info i{ color: #gdlr#; }'
										),		
										'post-slider-caption-button-background' => array(
											'title' => __('Post Slider Caption Button Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#566b79',
											'selector'=> '.gdlr-post-slider-item .gdlr-donate-button{ background-color: #gdlr#; }'
										),
										'post-slider-caption-button-text' => array(
											'title' => __('Post Slider Caption Button text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.gdlr-post-slider-item .gdlr-donate-button{ color: #gdlr#; }'
										),
										'input-box-background' => array(
											'title' => __('Input Box Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f7f7f7',
											'selector'=> 'input[type="text"], input[type="email"], input[type="password"], textarea{ background-color: #gdlr#; }'
										),
										'input-box-text' => array(
											'title' => __('Input Box Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#b5b5b5',
											'selector'=> 'input[type="text"], input[type="email"], input[type="password"], textarea{ color: #gdlr#; }' .
												'input::input-placeholder{ color:#gdlr#; } input::-webkit-input-placeholder{ color:#gdlr#; }' .
												'input::-moz-placeholder{ color:#gdlr#; } input:-moz-placeholder{ color:#gdlr#; }' .
												'input:-ms-input-placeholder{ color:#gdlr#; }' .
												'textarea::input-placeholder{ color:#gdlr#; } textarea::-webkit-input-placeholder{ color:#gdlr#; }' .
												'textarea::-moz-placeholder{ color:#gdlr#; } textarea:-moz-placeholder{ color:#gdlr#; }' .
												'textarea:-ms-input-placeholder{ color:#gdlr#; }'
										),
										
									)
								),
								
								'footer-color' => array(
									'title' => __('Footer', 'gdlr_translate'),
									'options' => array(
										'footer-background-color' => array(
											'title' => __('Footer Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#262626',
											'selector'=> '.footer-wrapper{ background-color: #gdlr#; }'
										),	
										'footer-title-color' => array(
											'title' => __('Footer Title Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#dddddd',
											'selector'=> '.footer-wrapper .gdlr-widget-title, .footer-wrapper .gdlr-widget-title a{ color: #gdlr#; }'
										),
										'footer-text-color' => array(
											'title' => __('Footer Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#919191',
											'selector'=> '.footer-wrapper{ color: #gdlr#; }'
										),	
										'footer-link-color' => array(
											'title' => __('Footer Text Link Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#d6d6d6',
											'selector'=> '.footer-wrapper a{ color: #gdlr#; }'
										),
										'footer-link-hover-color' => array(
											'title' => __('Footer Text Link Hover Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#969696',
											'selector'=> '.footer-wrapper a:hover{ color: #gdlr#; }'
										),
										'footer-border-color' => array(
											'title' => __('Footer Border Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#363636',
											'selector'=> '.footer-wrapper *{ border-color: #gdlr#; }'
										),
										'footer-input-box-background' => array(
											'title' => __('Footer Input Box Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#383838',
											'selector'=> '.footer-wrapper input[type="text"], .footer-wrapper input[type="email"], ' . 
												'.footer-wrapper input[type="password"], .footer-wrapper textarea{ background-color: #gdlr#; }'
										),
										'footer-input-box-text' => array(
											'title' => __('Footer Input Box Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#aaaaaa',
											'selector'=> '.footer-wrapper input[type="text"], .footer-wrapper input[type="email"], ' . 
												'.footer-wrapper input[type="password"], .footer-wrapper textarea{ color: #gdlr#; }'
										),						
										'footer-tag-cloud-background' => array(
											'title' => __('Footer Tagcloud Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> '.footer-wrapper .tagcloud a{ background-color: #gdlr#; }'
										),
										'footer-tag-cloud-text' => array(
											'title' => __('Footer Tagcloud Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> '.footer-wrapper .tagcloud a, .footer-wrapper .tagcloud a:hover{ color: #gdlr#; }'
										),
										'gdlr-copyright-background' => array(
											'title' => __('Copyright Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#111111',
											'selector'=> '.copyright-wrapper{ background-color: #gdlr#; }'
										),
										'gdlr-copyright-text-color' => array(
											'title' => __('Copyright Text Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#919191',
											'selector'=> '.copyright-wrapper{ color: #gdlr#; }'
										),
										'gdlr-copyright-top-border' => array(
											'title' => __('Copyright Top Border', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#111111',
											'selector'=> '.footer-wrapper .copyright-wrapper{ border-color: #gdlr#; }'
										),
									)	
								),
								
								'woocommerce-color' => array(
									'title' => __('Woocommerce Color', 'gdlr_translate'),
									'options' => array(
										'woo-theme-color' => array(
											'title' => __('Woocommerce Theme Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'description'=> __('This color effects following elements : sales tag, stars, table, tab, woo message, price color(pruduct single)', 'gdlr_translate'),
											'selector'=> 'html  .woocommerce span.onsale, html  .woocommerce-page span.onsale, html .woocommerce-message,' .
												'html .woocommerce div.product .woocommerce-tabs ul.tabs li.active, html .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active,' .
												'html .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, html .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active {  background: #gdlr#; }' .
												'html .woocommerce .star-rating, html .woocommerce-page .star-rating, html .woocommerce .star-rating:before, ' .
												'html .woocommerce-page .star-rating:before, html .woocommerce div.product span.price, html .woocommerce div.product p.price, ' .
												'html .woocommerce #content div.product span.price, html .woocommerce #content div.product p.price, html .woocommerce-page div.product span.price, ' .
												'html .woocommerce-page div.product p.price, html .woocommerce-page #content div.product span.price, html .woocommerce-page #content div.product p.price {color: #gdlr#; }'
										),	
										'woo-text-in-element-color' => array(
											'title' => __('Woocommerce Text In Element Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'description'=> __('This color effects following elements : active tab, sale tag, th in table, message, notification, error, active pagination', 'gdlr_translate'),
											'selector'=> 'html .woocommerce-message  a.button, html .woocommerce-error  a.button, html .woocommerce-info  a.button, ' .
												'html .woocommerce-info a.showcoupon, html .woocommerce-message, html .woocommerce-error, html .woocommerce-info, ' .
												'html  .woocommerce span.onsale, html  .woocommerce-page span.onsale, html .woocommerce div.product .woocommerce-tabs ul.tabs li.active,' .
												'html .woocommerce #content div.product .woocommerce-tabs ul.tabs li.active, html .woocommerce-page div.product .woocommerce-tabs ul.tabs li.active, ' . 
												'html .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li.active, html .woocommerce nav.woocommerce-pagination ul li span.current, ' . 
												'html .woocommerce-page nav.woocommerce-pagination ul li span.current, html .woocommercenav.woocommerce-pagination ul li a:hover, ' . 
												'html .woocommerce-page nav.woocommerce-pagination ul li a:hover{ color: #gdlr#; }'
										),	
										'woo-notification-background' => array(
											'title' => __('Woocommerce Notification Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#389EC5',
											'selector'=> 'html .woocommerce-info{ background: #gdlr#; }'
										),
										'woo-error-background' => array(
											'title' => __('Woocommerce Error Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#C23030',
											'selector'=> 'html .woocommerce-error{ background: #gdlr#; }'
										),
										'woo-button-background' => array(
											'title' => __('Woocommerce Button Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> 'html .woocommerce a.button.alt:hover, html .woocommerce button.button.alt:hover, html .woocommerce input.button.alt:hover, ' .
												'html .woocommerce #respond input#submit.alt:hover, html .woocommerce #content input.button.alt:hover, html .woocommerce-page a.button.alt:hover, ' .
												'html .woocommerce-page button.button.alt:hover, html .woocommerce-page input.button.alt:hover, html .woocommerce-page #respond input#submit.alt:hover, ' . 
												'html .woocommerce-page #content input.button.alt:hover, html .woocommerce a.button.alt, html .woocommerce button.button.alt, html .woocommerce input.button.alt, ' . 
												'html .woocommerce #respond input#submit.alt, html .woocommerce #content input.button.alt, html .woocommerce-page a.button.alt, html .woocommerce-page button.button.alt, ' . 
												'html .woocommerce-page input.button.alt, html .woocommerce-page #respond input#submit.alt, html .woocommerce-page #content input.button.alt, ' .
												'html .woocommerce a.button, html .woocommerce button.button, html .woocommerce input.button, html .woocommerce #respond input#submit, ' .
												'html .woocommerce #content input.button, html .woocommerce-page a.button, html .woocommerce-page button.button, html .woocommerce-page input.button, ' .
												'html .woocommerce-page #respond input#submit, html .woocommerce-page #content input.button, html .woocommerce a.button:hover, html .woocommerce button.button:hover, ' .
												'html .woocommerce input.button:hover, html .woocommerce #respond input#submit:hover, html .woocommerce #content input.button:hover, ' .
												'html .woocommerce-page a.button:hover, html .woocommerce-page button.button:hover, html .woocommerce-page input.button:hover, ' .
												'html .woocommerce-page #respond input#submit:hover, html .woocommerce-page #content input.button:hover, html .woocommerce ul.products li.product a.loading, ' .
												'html .woocommerce div.product form.cart .button, html .woocommerce #content div.product form.cart .button, html .woocommerce-page div.product form.cart .button, ' .
												'html .woocommerce-page #content div.product form.cart .button{ background: #gdlr#; }'
										),
										'woo-button-text' => array(
											'title' => __('Woocommerce Button Text', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> 'html .woocommerce a.button.alt:hover, html .woocommerce button.button.alt:hover, html .woocommerce input.button.alt:hover, ' . 
												'html .woocommerce #respond input#submit.alt:hover, html .woocommerce #content input.button.alt:hover, html .woocommerce-page a.button.alt:hover, ' .  
												'html .woocommerce-page button.button.alt:hover, html .woocommerce-page input.button.alt:hover, html .woocommerce-page #respond input#submit.alt:hover, ' .  
												'html .woocommerce-page #content input.button.alt:hover, html .woocommerce a.button.alt, html .woocommerce button.button.alt, html .woocommerce input.button.alt, ' .  
												'html .woocommerce #respond input#submit.alt, html .woocommerce #content input.button.alt, html .woocommerce-page a.button.alt, html .woocommerce-page button.button.alt, ' . 
												'html .woocommerce-page input.button.alt, html .woocommerce-page #respond input#submit.alt, html .woocommerce-page #content input.button.alt, ' . 
												'html .woocommerce a.button, html .woocommerce button.button, html .woocommerce input.button, html .woocommerce #respond input#submit, ' .  
												'html .woocommerce #content input.button, html .woocommerce-page a.button, html .woocommerce-page button.button, html .woocommerce-page input.button, ' . 
												'html .woocommerce-page #respond input#submit, html .woocommerce-page #content input.button, html .woocommerce a.button:hover, html .woocommerce button.button:hover, ' . 
												'html .woocommerce input.button:hover, html .woocommerce #respond input#submit:hover, html .woocommerce #content input.button:hover, ' . 
												'html .woocommerce-page a.button:hover, html .woocommerce-page button.button:hover, html .woocommerce-page input.button:hover, ' . 
												'html .woocommerce-page #respond input#submit:hover, html .woocommerce-page #content input.button:hover, html .woocommerce ul.products li.product a.loading, ' . 
												'html .woocommerce div.product form.cart .button, html .woocommerce #content div.product form.cart .button, html .woocommerce-page div.product form.cart .button, ' . 
												'html .woocommerce-page #content div.product form.cart .button{ color: #gdlr#; }'
										),
										'woo-button-bottom-border' => array(
											'title' => __('Woocommerce Button Bottom Border', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#62cdff',
											'selector'=> 'html .woocommerce a.button.alt:hover, html .woocommerce button.button.alt:hover, html .woocommerce input.button.alt:hover, ' .
												'html .woocommerce #respond input#submit.alt:hover, html .woocommerce #content input.button.alt:hover, html .woocommerce-page a.button.alt:hover, ' .
												'html .woocommerce-page button.button.alt:hover, html .woocommerce-page input.button.alt:hover, html .woocommerce-page #respond input#submit.alt:hover, ' .
												'html .woocommerce-page #content input.button.alt:hover, html .woocommerce a.button.alt, html .woocommerce button.button.alt, html .woocommerce input.button.alt, ' .
												'html .woocommerce #respond input#submit.alt, html .woocommerce #content input.button.alt, html .woocommerce-page a.button.alt, html .woocommerce-page button.button.alt, ' .
												'html .woocommerce-page input.button.alt, html .woocommerce-page #respond input#submit.alt, html .woocommerce-page #content input.button.alt, ' .
												'html .woocommerce a.button, html .woocommerce button.button, html .woocommerce input.button, html .woocommerce #respond input#submit, ' .
												'html .woocommerce #content input.button, html .woocommerce-page a.button, html .woocommerce-page button.button, html .woocommerce-page input.button, ' .
												'html .woocommerce-page #respond input#submit, html .woocommerce-page #content input.button, html .woocommerce a.button:hover, html .woocommerce button.button:hover, ' .
												'html .woocommerce input.button:hover, html .woocommerce #respond input#submit:hover, html .woocommerce #content input.button:hover, ' .
												'html .woocommerce-page a.button:hover, html .woocommerce-page button.button:hover, html .woocommerce-page input.button:hover, ' .
												'html .woocommerce-page #respond input#submit:hover, html .woocommerce-page #content input.button:hover, html .woocommerce ul.products li.product a.loading, ' .
												'html .woocommerce div.product form.cart .button, html .woocommerce #content div.product form.cart .button, html .woocommerce-page div.product form.cart .button, ' .
												'html .woocommerce-page #content div.product form.cart .button{ border-bottom: 3px solid #gdlr#; }'
										),
										'woo-border-color' => array(
											'title' => __('Woocommerce Border Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ebebeb',
											'selector'=> 'html .woocommerce #reviews #comments ol.commentlist li img.avatar, html .woocommerce-page #reviews #comments ol.commentlist li img.avatar { background: #gdlr#; }' . 
												'html .woocommerce #reviews #comments ol.commentlist li img.avatar, html .woocommerce-page #reviews #comments ol.commentlist li img.avatar,' . 
												'html .woocommerce #reviews #comments ol.commentlist li .comment-text, html .woocommerce-page #reviews #comments ol.commentlist li .comment-text,' . 
												'html .woocommerce ul.products li.product a img, html .woocommerce-page ul.products li.product a img, html .woocommerce ul.products li.product a img:hover ,' .  
												'html .woocommerce-page ul.products li.product a img:hover, html .woocommerce-page div.product div.images img, html .woocommerce-page #content div.product div.images img,' . 
												'html .woocommerce form.login, html .woocommerce form.checkout_coupon, html .woocommerce form.register, html .woocommerce-page form.login,' .  
												'html .woocommerce-page form.checkout_coupon, html .woocommerce-page form.register, html .woocommerce table.cart td.actions .coupon .input-text,' .  
												'html .woocommerce #content table.cart td.actions .coupon .input-text, html .woocommerce-page table.cart td.actions .coupon .input-text,' .  
												'html .woocommerce-page #content table.cart td.actions .coupon .input-text { border: 1px solid #gdlr#; }' . 
												'html .woocommerce div.product .woocommerce-tabs ul.tabs:before, html .woocommerce #content div.product .woocommerce-tabs ul.tabs:before,' .  
												'html .woocommerce-page div.product .woocommerce-tabs ul.tabs:before, html .woocommerce-page #content div.product .woocommerce-tabs ul.tabs:before,' . 
												'html .woocommerce table.shop_table tfoot td, html .woocommerce table.shop_table tfoot th, html .woocommerce-page table.shop_table tfoot td,' .  
												'html .woocommerce-page table.shop_table tfoot th, html .woocommerce table.shop_table tfoot td, html .woocommerce table.shop_table tfoot th,' .  
												'html .woocommerce-page table.shop_table tfoot td, html .woocommerce-page table.shop_table tfoot th { border-bottom: 1px solid #gdlr#; }' . 
												'html .woocommerce .cart-collaterals .cart_totals table tr:first-child th, html .woocommerce .cart-collaterals .cart_totals table tr:first-child td,' .  
												'html .woocommerce-page .cart-collaterals .cart_totals table tr:first-child th, html .woocommerce-page .cart-collaterals .cart_totals table tr:first-child td { border-top: 3px #gdlr# solid; }' . 
												'html .woocommerce .cart-collaterals .cart_totals tr td, html .woocommerce .cart-collaterals .cart_totals tr th,' .  
												'html .woocommerce-page .cart-collaterals .cart_totals tr td, html .woocommerce-page .cart-collaterals .cart_totals tr th { border-bottom: 2px solid #gdlr#; }'
										),
										'woo-secondary-elements' => array(
											'title' => __('Woocommerce Secondary Element', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#f3f3f3',
											'description'=> __('This color effects following elements : inactive tab, input, textarea,romving product button, payment option box, inactive pagination', 'gdlr_translate'),
											'selector'=> 'html .woocommerce div.product .woocommerce-tabs ul.tabs li, html .woocommerce #content div.product .woocommerce-tabs ul.tabs li, ' . 
												'html .woocommerce-page div.product .woocommerce-tabs ul.tabs li, html .woocommerce-page #content div.product .woocommerce-tabs ul.tabs li ,' . 
												'html .woocommerce table.cart a.remove, html .woocommerce #content table.cart a.remove, html .woocommerce-page table.cart a.remove, ' . 
												'html .woocommerce-page #content table.cart a.remove, html .woocommerce #payment, html .woocommerce-page #payment, html .woocommerce .customer_details,' . 
												'html .woocommerce ul.order_details, html .woocommerce nav.woocommerce-pagination ul li a, html .woocommerce-page nav.woocommerce-pagination ul li a,' . 
												'html .woocommerce form .form-row input.input-text, html .woocommerce form .form-row textarea, html .woocommerce-page form .form-row input.input-text, ' . 
												'html .woocommerce-page form .form-row textarea, html .woocommerce .quantity input.qty, html .woocommerce #content .quantity input.qty, ' . 
												'html .woocommerce-page .quantity input.qty, html .woocommerce-page #content .quantity input.qty,' . 
												'html .woocommerce .widget_shopping_cart .total, html .woocommerce-page .widget_shopping_cart .total { background: #gdlr#; }' . 
												'html .woocommerce .quantity input.qty, html .woocommerce #content .quantity input.qty, html .woocommerce-page .quantity input.qty, ' . 
												'html .woocommerce-page #content .quantity input.qty { border: 1px solid #gdlr#; }'
										),	
										'woo-secondary-elements-border' => array(
											'title' => __('Woocommerce Secondary Element Border', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#e5e5e5',
											'selector'=> 'html .woocommerce .widget_shopping_cart .total, html .woocommerce-page .widget_shopping_cart .total { border-top: 2px solid #gdlr#; }' .
												'html .woocommerce table.cart a.remove:hover, html .woocommerce #content table.cart a.remove:hover, html .woocommerce-page table.cart a.remove:hover,' . 
												'html .woocommerce-page #content table.cart a.remove:hover, html #payment div.payment_box, html .woocommerce-page #payment div.payment_box { background: #gdlr#; }'
										),
										'woo-cart-summary-price' => array(
											'title' => __('Woocommerce Cart Summary Text / Price', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#333333',
											'selector'=> 'html .woocommerce table.shop_table tfoot td, html .woocommerce table.shop_table tfoot th, html .woocommerce-page table.shop_table tfoot td,' .
												'html .woocommerce-page table.shop_table tfoot th, .cart-subtotal th, .shipping th , .total th, html .woocommerce table.shop_attributes .alt th,' .
												'html .woocommerce-page table.shop_attributes .alt th, html .woocommerce ul.products li.product .price, html.woocommerce-page ul.products li.product .price { color: #gdlr#; }'
										),
										'woo-discount-price' => array(
											'title' => __('Discount Price / Product Arrow', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#888888',
											'selector'=> 'html .woocommerce ul.products li.product .price del, html .woocommerce-page ul.products li.product .price del,' .
												'html .woocommerce table.cart a.remove, html .woocommerce #content table.cart a.remove, html .woocommerce-page table.cart a.remove,' .
												'html .woocommerce-page #content table.cart a.remove { color: #gdlr#; }'
										),
										'woo-plus-minus-product-border' => array(
											'title' => __('Plus / Minus Product Border', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#a0a0a0',
											'selector'=> 'html .woocommerce .quantity .plus, html .woocommerce .quantity .minus, html .woocommerce #content .quantity .plus, html .woocommerce #content .quantity .minus, 
												html .woocommerce-page .quantity .plus, html .woocommerce-page .quantity .minus, html .woocommerce-page #content .quantity .plus, 
												html .woocommerce-page #content .quantity .minus { border: 1px solid #gdlr#; }'
										),
										'woo-plus-minus-product-sign' => array(
											'title' => __('Plus / Minus Product Sign', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#ffffff',
											'selector'=> 'html .woocommerce .quantity .plus, html .woocommerce .quantity .minus, html .woocommerce #content .quantity .plus, html .woocommerce #content .quantity .minus, 
												html .woocommerce-page .quantity .plus, html .woocommerce-page .quantity .minus, html .woocommerce-page #content .quantity .plus, 
												html .woocommerce-page #content .quantity .minus { color: #gdlr#; }'
										),
										'woo-plus-product-background' => array(
											'title' => __('Plus Product Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#9a9a9a',
											'selector'=> 'html .woocommerce .quantity .plus, html .woocommerce #content .quantity .plus,  html .woocommerce-page .quantity .plus,' .
												'html .woocommerce-page #content .quantity .plus, html .woocommerce .quantity .plus:hover, html .woocommerce #content .quantity .plus:hover,' .
												'html .woocommerce-page .quantity .plus:hover,  html .woocommerce-page #content .quantity .plus:hover{ background: #gdlr#; }'
										),
										'woo-minus-product-background' => array(
											'title' => __('Minus Product Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#b6b6b6',
											'selector'=> 'html .woocommerce .quantity .minus, html .woocommerce #content .quantity .minus,  html .woocommerce-page .quantity .minus,' .  
												'html .woocommerce-page #content .quantity .minus, html .woocommerce .quantity .minus:hover, html .woocommerce #content .quantity .minus:hover,' . 
												'html .woocommerce-page .quantity .minus:hover,  html .woocommerce-page #content .quantity .minus:hover{ background: #gdlr#; }'
										),
									)
								)
							
							)					
						),
						
						// plugin setting menu
						'plugin-settings' => array(
							'title' => __('Plugin / Slider', 'gdlr_translate'),
							'icon' => GDLR_PATH . '/include/images/icon-plugin-settings.png',
							'options' => array(
								'general-plugins' => array(
									'title' => __('General Plugins', 'gdlr_translate'),
									'options' => array(			
										'enable-plugin-recommendation' => array(
											'title' => __('Enable Plugin Recommendation', 'gdlr_translate'),
											'type' => 'checkbox',
											'default' => 'enable'
										),
										'enable-goodlayers-navigation' => array(
											'title' => __('Enable Goodlayers Navigation', 'gdlr_translate'),
											'type' => 'checkbox',
											'default' => 'enable',
											'description' => '<strong>*** ' . __('Do not turn this off, it can breaks both top and main menu.', 'gdlr_translate') . '</strong>'
										),
										'enable-goodlayers-mobile-navigation' => array(
											'title' => __('Enable Mobile Navigation', 'gdlr_translate'),
											'type' => 'checkbox',
											'default' => 'enable',
											'description' => __('Turn this menu off when you use 3rd party menu plugin like Uber Menu', 'gdlr_translate')
										),
										'enable-flex-slider' => array(
											'title' => __('Enable Flex Slider', 'gdlr_translate'),
											'type' => 'checkbox',
											'default' => 'enable',
											'description' => '<strong>*** ' . __('Turn this option off will make slider shortcode / post slider widget unavailable', 'gdlr_translate') . '</strong>'
										),		
										'enable-fancybox' => array(
											'title' => __('Enable Fancybox', 'gdlr_translate'),
											'type' => 'checkbox',
											'default' => 'enable',
											'description' => '<strong>*** ' . __('Turn this option off can make all lightbox option breaks', 'gdlr_translate') . '</strong>'
										),		
										'enable-fancybox-thumbs' => array(
											'title' => __('Enable Fancybox Thumbnail ( Gallery Mode )', 'gdlr_translate'),
											'type' => 'checkbox',
											'default' => 'enable'
										),
										'new-fontawesome' => array(
											'title' => __('Enable New Font Awesome Version', 'gdlr_translate'),
											'type' => 'checkbox',
											'default' => 'disable'
										)																			
									)
								),
								'flex-slider' => array(
									'title' => __('Flex Slider', 'gdlr_translate'),
									'options' => array(		
										'flex-slider-effects' => array(
											'title' => __('Flex Slider Effect', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'fade' => __('Fade', 'gdlr_translate'),
												'slide'	=> __('Slide', 'gdlr_translate')
											)
										),
										'flex-pause-time' => array(
											'title' => __('Flex Slider Pause Time', 'gdlr_translate'),
											'type' => 'text',
											'default' => '7000'
										),
										'flex-slide-speed' => array(
											'title' => __('Flex Slider Animation Speed', 'gdlr_translate'),
											'type' => 'text',
											'default' => '600'
										),	
									)
								),
								'nivo-slider' => array(
									'title' => __('Nivo Slider', 'gdlr_translate'),
									'options' => array(		
										'nivo-slider-effects' => array(
											'title' => __('Nivo Slider Effect', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'sliceDownRight'	=> __('sliceDownRight', 'gdlr_translate'),
												'sliceDownLeft'		=> __('sliceDownLeft', 'gdlr_translate'),
												'sliceUpRight'		=> __('sliceUpRight', 'gdlr_translate'),
												'sliceUpLeft'		=> __('sliceUpLeft', 'gdlr_translate'),
												'sliceUpDown'		=> __('sliceUpDown', 'gdlr_translate'),
												'sliceUpDownLeft'	=> __('sliceUpDownLeft', 'gdlr_translate'),
												'fold'				=> __('fold', 'gdlr_translate'),
												'fade'				=> __('fade', 'gdlr_translate'),
												'boxRandom'			=> __('boxRandom', 'gdlr_translate'),
												'boxRain'			=> __('boxRain', 'gdlr_translate'),
												'boxRainReverse'	=> __('boxRainReverse', 'gdlr_translate'),
												'boxRainGrow'		=> __('boxRainGrow', 'gdlr_translate'),
												'boxRainGrowReverse'=> __('boxRainGrowReverse', 'gdlr_translate')
											)
										),
										'nivo-pause-time' => array(
											'title' => __('Nivo Slider Pause Time', 'gdlr_translate'),
											'type' => 'text',
											'default' => '7000'
										),
										'nivo-slide-speed' => array(
											'title' => __('Nivo Slider Animation Speed', 'gdlr_translate'),
											'type' => 'text',
											'default' => '600'
										),	
									)
								),
							)					
						),
						
					)
				), 
				
				$theme_option
			);
			
		}
		
	}

?>