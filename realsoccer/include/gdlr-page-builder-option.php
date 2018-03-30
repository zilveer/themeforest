<?php
	/*	
	*	Goodlayers Framework File
	*	---------------------------------------------------------------------
	*	This file contains the admin option setting 
	*	---------------------------------------------------------------------
	*/
	
	// add ability to search through page builder
	add_filter( 'posts_where', 'gdlr_search_page_builder_meta');
	if( !function_exists('gdlr_search_page_builder_meta') ){
		function gdlr_search_page_builder_meta( $where ) {
			if( is_search() && empty($_GET['post_type']) && !is_admin() ) {
				global $wpdb;
				$query = get_search_query();
				$query = like_escape( $query );

				$where .= " OR {$wpdb->posts}.ID IN (";
				$where .= "SELECT {$wpdb->postmeta}.post_id ";
				$where .= "FROM {$wpdb->posts}, {$wpdb->postmeta} ";
				$where .= "WHERE {$wpdb->posts}.post_type = 'page' ";
				$where .= "AND {$wpdb->posts}.ID = {$wpdb->postmeta}.post_id ";
				$where .= "AND {$wpdb->postmeta}.meta_key IN('above-sidebar', 'content-with-sidebar', 'below-sidebar') ";
				$where .= "AND {$wpdb->postmeta}.meta_value LIKE '%$query%' )";
			}
			return $where;
		}
	}
	
	// returns array of options for title of each item
	if( !function_exists('gdlr_page_builder_title_option') ){
		function gdlr_page_builder_title_option( $read_more = false ) {
			$title = array(
				'title-type'=> array(	
					'title'=> __('Title Type' ,'gdlr_translate'),
					'type'=> 'combobox',
					'options'=> array(
						'none'=> __('None' ,'gdlr_translate'),
						'left'=> __('Left Align' ,'gdlr_translate'),
						'center'=> __('Center Align' ,'gdlr_translate'),
						'center-divider'=> __('Center Align With Divider' ,'gdlr_translate')
					)
				),										
				'title'=> array(	
					'title'=> __('Title' ,'gdlr_translate'),
					'type'=> 'text',
					'wrapper-class'=>'title-type-wrapper left-wrapper center-wrapper left-divider-wrapper center-divider-wrapper'
				),			
				'caption'=> array(	
					'title'=> __('Caption' ,'gdlr_translate'),
					'type'=> 'textarea',
					'wrapper-class'=>'title-type-wrapper left-wrapper center-wrapper left-divider-wrapper center-divider-wrapper'
				)			
			);
			
			if( $read_more ){
				$title['right-text'] = array(	
					'title'=> __('Titlte Link Text' ,'gdlr_translate'),
					'type'=> 'text',
					'default'=> __('Read All News', 'gdlr_translate'),
					'wrapper-class'=>'title-type-wrapper left-wrapper center-wrapper left-divider-wrapper center-divider-wrapper'
				);	
				$title['right-text-link'] = array(	
					'title'=> __('Title Link URL' ,'gdlr_translate'),
					'type'=> 'text',
					'wrapper-class'=>'title-type-wrapper left-wrapper center-wrapper left-divider-wrapper center-divider-wrapper'
				);			
			}
			
			return $title;
		}
	}

	// create the page builder
	if( is_admin() ){ add_action('init', 'gdlr_create_page_builder_option'); }
	if( !function_exists('gdlr_create_page_builder_option') ){
	
		function gdlr_create_page_builder_option(){
			global $gdlr_spaces;
		
			new gdlr_page_builder( 
				
				// page builder option attribute
				array(
					'post_type' => array('page'),
					'meta_title' => __('Page Builder Options', 'gdlr_translate'),
				),
					  
				// page builder option setting
				apply_filters('gdlr_page_builder_option',
					array(
						'column-wrapper-item' => array(
							'title' => __('Column Wrapper Item', 'gdlr_translate'),
							'blank_option' => __('- Select Column Item -', 'gdlr_translate'),
							'options' => array(
								'column1-5' => array('title'=> __('Column Item', 'gdlr_translate'), 'type'=>'wrapper', 'size'=>'1/5'), 
								'column1-4' => array('title'=> __('Column Item', 'gdlr_translate'), 'type'=>'wrapper', 'size'=>'1/4'), 
								'column2-5' => array('title'=> __('Column Item', 'gdlr_translate'), 'type'=>'wrapper', 'size'=>'2/5'), 
								'column1-3' => array('title'=> __('Column Item', 'gdlr_translate'), 'type'=>'wrapper', 'size'=>'1/3'), 
								'column1-2' => array('title'=> __('Column Item', 'gdlr_translate'), 'type'=>'wrapper', 'size'=>'1/2'), 
								'column3-5' => array('title'=> __('Column Item', 'gdlr_translate'), 'type'=>'wrapper', 'size'=>'3/5'), 
								'column2-3' => array('title'=> __('Column Item', 'gdlr_translate'), 'type'=>'wrapper', 'size'=>'2/3'), 
								'column3-4' => array('title'=> __('Column Item', 'gdlr_translate'), 'type'=>'wrapper', 'size'=>'3/4'), 
								'column4-5' => array('title'=> __('Column Item', 'gdlr_translate'), 'type'=>'wrapper', 'size'=>'4/5'), 
								'column1-1' => array('title'=> __('Column Item', 'gdlr_translate'), 'type'=>'wrapper', 'size'=>'1/1'),
								
								'color-wrapper' => array(
									'title'=> __('Color Wrapper', 'gdlr_translate'), 
									'type'=>'wrapper',
									'options'=>array(
										'background-type' => array(
											'title' => __('Background Type', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'color'=>__('Color', 'gdlr_translate'),
												'transparent'=>__('Transparent', 'gdlr_translate'),
											)
										),
										'background' => array(
											'title' => __('Background Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default'=> '#ffffff',
											'wrapper-class'=>'color-wrapper background-type-wrapper'
										),		
										'skin' => array(
											'title' => __('Skin', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => gdlr_get_skin_list(),
											'description' => __('Can be created at the Theme Options > Elements Color > Custom Skin section', 'gdlr_translate')
										),
										'show-section'=> array(
											'title' => __('Show This Section In', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'gdlr-show-all' => __('All Devices', 'gdlr_translate'),
												'gdlr-hide-in-tablet' => __('Hide This Section In Tablet', 'gdlr_translate'),
												'gdlr-hide-in-mobile' => __('Hide This Section In Mobile', 'gdlr_translate'),
												'gdlr-hide-in-tablet-mobile' => __('Hide This Section In Tablet and Mobile', 'gdlr_translate'),
											),
										),										
										'border'=> array(
											'title' => __('Border', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'none' => __('None', 'gdlr_translate'),
												'top' => __('Border Top', 'gdlr_translate'),
												'bottom' => __('Border Bottom', 'gdlr_translate'),
												'both' => __('Both Border', 'gdlr_translate'),
											),
										),
										'border-top-color' => array(
											'title' => __('Border Top Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default'=> '#e9e9e9',
											'wrapper-class'=> 'border-wrapper top-wrapper both-wrapper'
										),
										'border-bottom-color' => array(
											'title' => __('Border Bottom Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default'=> '#e9e9e9',
											'wrapper-class'=> 'border-wrapper bottom-wrapper both-wrapper'
										),
										'padding-top' => array(
											'title' => __('Padding Top', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['top-wrapper'],
											'description' => __('Spaces before starting any content in this section', 'gdlr_translate')
										),	
										'padding-bottom' => array(
											'title' => __('Padding Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-wrapper'],
											'description' => __('Spaces after ending of the content in this section', 'gdlr_translate')
										),
									)
								),
								
								'parallax-bg-wrapper' => array(
									'title'=> __('Background/Parallax Wrapper', 'gdlr_translate'), 
									'type'=>'wrapper',
									'options'=>array(
										'type' => array(
											'title' => __('Type', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'image'=> __('Background Image', 'gdlr_translate'),
												'pattern'=> __('Predefined Pattern', 'gdlr_translate'),
												'video'=> __('Video Background', 'gdlr_translate'),
											),
											'default'=>'image'
										),								
										'background' => array(
											'title' => __('Background Image', 'gdlr_translate'),
											'button' => __('Upload', 'gdlr_translate'),
											'type' => 'upload',
											'wrapper-class' => 'type-wrapper image-wrapper'
										),								
										'background-mobile' => array(
											'title' => __('Background Mobile', 'gdlr_translate'),
											'button' => __('Upload', 'gdlr_translate'),
											'type' => 'upload',
											'wrapper-class' => 'type-wrapper image-wrapper'
										),	
										'background-speed' => array(
											'title' => __('Background Speed', 'gdlr_translate'),
											'type' => 'text',
											'default' => '0',
											'wrapper-class' => 'type-wrapper image-wrapper',
											'description' => __('Fill 0 if you don\'t want the background to scroll and 1 when you want the background to have the same speed as the scroll bar', 'gdlr_translate') .
												'<br><br><strong>' . __('*** only allow the number between -1 to 1', 'gdlr_translate') . '</strong>'
										),		
										'pattern' => array(
											'title' => __('Pattern', 'gdlr_translate'),
											'type' => 'radioimage',
											'options' => array(
												'1'=>GDLR_PATH . '/include/images/pattern/pattern-1.png',
												'2'=>GDLR_PATH . '/include/images/pattern/pattern-2.png', 
												'3'=>GDLR_PATH . '/include/images/pattern/pattern-3.png',
												'4'=>GDLR_PATH . '/include/images/pattern/pattern-4.png',
												'5'=>GDLR_PATH . '/include/images/pattern/pattern-5.png',
												'6'=>GDLR_PATH . '/include/images/pattern/pattern-6.png',
												'7'=>GDLR_PATH . '/include/images/pattern/pattern-7.png',
												'8'=>GDLR_PATH . '/include/images/pattern/pattern-8.png'
											),
											'wrapper-class' => 'type-wrapper pattern-wrapper',
											'default' => '1'
										),		
										'video' => array(
											'title' => __('Youtube URL', 'gdlr_translate'),
											'type' => 'text',
											'wrapper-class' => 'type-wrapper video-wrapper'
										),
										'video-overlay' => array(
											'title' => __('Video Overlay Opacity', 'gdlr_translate'),
											'type' => 'text',
											'default' => '0.5',
											'wrapper-class' => 'type-wrapper video-wrapper'
										),
										'video-player' => array(
											'title' => __('Video Control Bar', 'gdlr_translate'),
											'type' => 'checkbox',
											'default' => 'enable',
											'wrapper-class' => 'type-wrapper video-wrapper'
										),
										'skin' => array(
											'title' => __('Skin', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => gdlr_get_skin_list(),
											'description' => __('Can be created at the Theme Options > Elements Color > Custom Skin section', 'gdlr_translate')
										),
										'show-section'=> array(
											'title' => __('Show This Section In', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'gdlr-show-all' => __('All Devices', 'gdlr_translate'),
												'gdlr-hide-in-tablet' => __('Hide This Section In Tablet', 'gdlr_translate'),
												'gdlr-hide-in-mobile' => __('Hide This Section In Mobile', 'gdlr_translate'),
												'gdlr-hide-in-tablet-mobile' => __('Hide This Section In Tablet and Mobile', 'gdlr_translate'),
											),
										),										
										'border'=> array(
											'title' => __('Border', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'none' => __('None', 'gdlr_translate'),
												'top' => __('Border Top', 'gdlr_translate'),
												'bottom' => __('Border Bottom', 'gdlr_translate'),
												'both' => __('Both Border', 'gdlr_translate'),
											),
										),
										'border-top-color' => array(
											'title' => __('Border Top Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default'=> '#e9e9e9',
											'wrapper-class'=> 'border-wrapper top-wrapper both-wrapper'
										),
										'border-bottom-color' => array(
											'title' => __('Border Bottom Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default'=> '#e9e9e9',
											'wrapper-class'=> 'border-wrapper bottom-wrapper both-wrapper'
										),	
										'padding-top' => array(
											'title' => __('Padding Top', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['top-wrapper'],
											'description' => __('Spaces before starting any content in this section', 'gdlr_translate')
										),	
										'padding-bottom' => array(
											'title' => __('Padding Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-wrapper'],
											'description' => __('Spaces after ending of the content in this section', 'gdlr_translate')
										),
									)
								),
								
								'full-size-wrapper' => array(
									'title'=> __('Full Size Wrapper', 'gdlr_translate'), 
									'type'=>'wrapper',
									'options'=>array(
										'background' => array(
											'title' => __('Background Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default'=> '#ffffff'
										),
										'show-section'=> array(
											'title' => __('Show This Section In', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'gdlr-show-all' => __('All Devices', 'gdlr_translate'),
												'gdlr-hide-in-tablet' => __('Hide This Section In Tablet', 'gdlr_translate'),
												'gdlr-hide-in-mobile' => __('Hide This Section In Mobile', 'gdlr_translate'),
												'gdlr-hide-in-tablet-mobile' => __('Hide This Section In Tablet and Mobile', 'gdlr_translate'),
											),
										),	
										'border'=> array(
											'title' => __('Border', 'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'none' => __('None', 'gdlr_translate'),
												'top' => __('Border Top', 'gdlr_translate'),
												'bottom' => __('Border Bottom', 'gdlr_translate'),
												'both' => __('Both Border', 'gdlr_translate'),
											),
										),
										'border-top-color' => array(
											'title' => __('Border Top Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default'=> '#e9e9e9',
											'wrapper-class'=> 'border-wrapper top-wrapper both-wrapper'
										),
										'border-bottom-color' => array(
											'title' => __('Border Bottom Color', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default'=> '#e9e9e9',
											'wrapper-class'=> 'border-wrapper bottom-wrapper both-wrapper'
										),
										'padding-top' => array(
											'title' => __('Padding Top', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['top-full-wrapper'],
											'description' => __('Spaces before starting any content in this section', 'gdlr_translate')
										),	
										'padding-bottom' => array(
											'title' => __('Padding Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-wrapper'],
											'description' => __('Spaces after ending of the content in this section', 'gdlr_translate')
										),
									)
								)
							)
						),
						
						'content-item' => array(
							'title' => __('Content/Post Type Item', 'gdlr_translate'),
							'blank_option' => __('- Select Content Item -', 'gdlr_translate'),
							'options' => array(
							
								'accordion' => array(
									'title'=> __('Accordion', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(array(
										'accordion'=> array(
											'type'=> 'tab',
											'default-title'=> __('Accordion' ,'gdlr_translate')											
										)
									), gdlr_page_builder_title_option(), array(
										'initial-state'=> array(
											'title'=> __('Initial Open', 'gdlr_translate'),
											'type'=> 'text',
											'default'=> 1,
											'description'=> __('0 will close all tab as an initial state, 1 will open the first tab and so on.', 'gdlr_translate')						
										),		
										'style'=> array(
											'title'=> __('Accordion Style' ,'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'style-1' => __('Style 1 ( Colored Background )', 'gdlr_translate'),
												'style-2' => __('Style 2 ( Transparent Background )', 'gdlr_translate')
											)
										),
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),
									))
								), 					
								
								'blog' => array(
									'title'=> __('Blog', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(gdlr_page_builder_title_option(true), array(										
										'category'=> array(
											'title'=> __('Category' ,'gdlr_translate'),
											'type'=> 'multi-combobox',
											'options'=> gdlr_get_term_list('category'),
											'description'=> __('You can use Ctrl/Command button to select multiple categories or remove the selected category. <br><br> Leave this field blank to select all categories.', 'gdlr_translate')
										),	
										'tag'=> array(
											'title'=> __('Tag' ,'gdlr_translate'),
											'type'=> 'multi-combobox',
											'options'=> gdlr_get_term_list('post_tag'),
											'description'=> __('You can use Ctrl/Command button to select multiple categories or remove the selected category. <br><br> Leave this field blank to select all categories.', 'gdlr_translate')
										),	
										'num-excerpt'=> array(
											'title'=> __('Num Excerpt (Word)' ,'gdlr_translate'),
											'type'=> 'text',	
											'default'=> '25',
											'description'=> __('This is a number of word (decided by spaces) that you want to show on the post excerpt. <strong>Use 0 to hide the excerpt, -1 to show full posts and use the wordpress more tag</strong>.', 'gdlr_translate')
										),	
										'num-fetch'=> array(
											'title'=> __('Num Fetch' ,'gdlr_translate'),
											'type'=> 'text',	
											'default'=> '8',
											'description'=> __('Specify the number of posts you want to pull out.', 'gdlr_translate')
										),										
										'blog-style'=> array(
											'title'=> __('Blog Style' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												//'blog-widget-1-4' => '1/4 ' . __('Blog Widget', 'gdlr_translate'),
												//'blog-widget-1-3' => '1/3 ' . __('Blog Widget', 'gdlr_translate'),
												//'blog-widget-1-2' => '1/2 ' . __('Blog Widget', 'gdlr_translate'),
												//'blog-widget-1-1' => '1/1 ' . __('Blog Widget', 'gdlr_translate'),
												'blog-1-4' => '1/4 ' . __('Blog Grid', 'gdlr_translate'),
												'blog-1-3' => '1/3 ' . __('Blog Grid', 'gdlr_translate'),
												'blog-1-2' => '1/2 ' . __('Blog Grid', 'gdlr_translate'),
												'blog-1-1' => '1/1 ' . __('Blog Grid', 'gdlr_translate'),
												'blog-medium' => __('Blog Medium', 'gdlr_translate'),
												'blog-full' => __('Blog Full', 'gdlr_translate'),
											),
											'default'=>'blog-1-1'
										),		
										'blog-layout'=> array(
											'title'=> __('Blog Layout Order' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'fitRows' =>  __('FitRows ( Order items by row )', 'gdlr_translate'),
												'masonry' => __('Masonry ( Order items by spaces )', 'gdlr_translate'),
												'carousel' => __('Carousel ( Only For Blog Grid )', 'gdlr_translate'),
											),
											'wrapper-class'=> 'blog-1-4-wrapper blog-1-3-wrapper blog-1-2-wrapper blog-style-wrapper',
											'description'=> __('You can see an example of these two layout here', 'gdlr_translate') . 
												'<br>http://isotope.metafizzy.co/demos/layout-modes.html'
										),
										'thumbnail-size'=> array(
											'title'=> __('Thumbnail Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_thumbnail_list(),
											'description'=> __('Only effects to <strong>standard and gallery post format</strong>.','gdlr_translate')
										),	
										'orderby'=> array(
											'title'=> __('Order By' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'date' => __('Publish Date', 'gdlr_translate'), 
												'title' => __('Title', 'gdlr_translate'), 
												'rand' => __('Random', 'gdlr_translate'), 
											)
										),
										'order'=> array(
											'title'=> __('Order' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'desc'=>__('Descending Order', 'gdlr_translate'), 
												'asc'=> __('Ascending Order', 'gdlr_translate'), 
											)
										),	
										'offset'=> array(
											'title'=> __('Offset' ,'gdlr_translate'),
											'type'=> 'text',
											'description'=> __('Fill in number of the posts you want to skip. Please noted that this will not works well with pagination', 'gdlr_translate')
										),										
										'pagination'=> array(
											'title'=> __('Enable Pagination' ,'gdlr_translate'),
											'type'=> 'checkbox'
										),	
										'enable-sticky'=> array(
											'title'=> __('Prepend Sticky Post' ,'gdlr_translate'),
											'type'=> 'checkbox',
											'default'=> 'disable'
										),											
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-blog-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),										
									))
								),								

								'box-icon-item' => array(
									'title'=> __('Box Icon', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'icon'=> array(
											'title'=> __('Icon Class' ,'gdlr_translate'),
											'type'=> 'text',						
										),		
										'icon-position'=> array(
											'title'=> __('Icon Position' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'left'=> __('Left', 'gdlr_translate'),
												'top'=> __('Top', 'gdlr_translate')
											)
										),			
										'icon-type'=> array(
											'title'=> __('Icon Type' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'normal'=> __('Normal', 'gdlr_translate'),
												'circle'=> __('Circle Background', 'gdlr_translate')
											)					
										),	
										'icon-color'=> array(
											'title'=> __('Icon Color' ,'gdlr_translate'),
											'type'=> 'colorpicker',		
											'default'=> '#5e5e5e'
										),	
										'icon-background'=> array(
											'title'=> __('Icon Background' ,'gdlr_translate'),
											'type'=> 'colorpicker',		
											'default'=> '#91d549',
											'wrapper-class'=> 'icon-type-wrapper circle-wrapper'
										),
										'title'=> array(
											'title'=> __('Title' ,'gdlr_translate'),
											'type'=> 'text',						
										),										
										'content'=> array(
											'title'=> __('Content Text' ,'gdlr_translate'),
											'type'=> 'tinymce',						
										),	
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	 
									)
								),								
								
								'column-service' => array(
									'title'=> __('Column Service', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'icon'=> array(
											'title'=> __('Icon Class' ,'gdlr_translate'),
											'type'=> 'text',						
										),		
										'title'=> array(
											'title'=> __('Title' ,'gdlr_translate'),
											'type'=> 'text',						
										),	
										'style'=> array(
											'title'=> __('Item Style' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'type-1'=> __('Style 1' ,'gdlr_translate'),	
												'type-2'=> __('Style 2' ,'gdlr_translate'),	
											)
										),										
										'content'=> array(
											'title'=> __('Content Text' ,'gdlr_translate'),
											'type'=> 'tinymce',						
										),	
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	 
									)
								),								
								
								'content' => array(
									'title'=> __('Content', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(gdlr_page_builder_title_option(true), array(	
										'content'=> array(
											'title'=> __('Content Text' ,'gdlr_translate'),
											'type'=> 'tinymce',						
										),	
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),														
									))
								), 	

								'divider' => array(
									'title'=> __('Divider', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'type'=> array(
											'title'=> __('Divider', 'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'solid' => __('Solid', 'gdlr_translate'),
												'double' => __('Double', 'gdlr_translate'),
												'dotted' => __('Dotted', 'gdlr_translate'),
												'double-dotted' => __('Double Dotted', 'gdlr_translate'),
												'thick' => __('Thick', 'gdlr_translate'),
											)
										),	
										'size'=> array(	
											'title'=> __('Divider Width' ,'gdlr_translate'),
											'type'=> 'text',
											'description'=> __('Specify the divider size. Ex. 50%, 200px', 'gdlr_translate')
										),	
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-divider-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),										
									)
								),

								'feature-media' => array(
									'title'=> __('Feature Media', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(gdlr_page_builder_title_option(), array(								
										'type'=> array(
											'title'=> __('Media Type' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'image'=> __('Image' ,'gdlr_translate'),
												'video'=> __('Video' ,'gdlr_translate')
											)
										),
										'video-url'=> array(
											'title'=> __('Video URL' ,'gdlr_translate'),
											'type'=> 'text',
											'wrapper-class'=> 'type-wrapper video-wrapper'
										),
										'image'=> array(
											'title'=> __('Service Image' ,'gdlr_translate'),
											'type'=> 'upload',						
											'button'=> __('upload' ,'gdlr_translate'),	
											'wrapper-class'=> 'type-wrapper image-wrapper'
										),		
										'image-link'=> array(
											'title'=> __('Service Image Link' ,'gdlr_translate'),
											'type'=> 'text',	
											'wrapper-class'=> 'type-wrapper image-wrapper'
										),									
										'feature-media-caption'=> array(
											'title'=> __('Feature Media Caption' ,'gdlr_translate'),
											'type'=> 'text',						
										),
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	 
									))
								),
								
								'fixture-result' => array(),

								'league-table' => array(),
								
								'icon-with-list' => array(
									'title'=> __('List With Icon', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(array(
										'icon-with-list'=> array(
											'type'=> 'icon-with-list',
											'default-title'=> __('Icon With List' ,'gdlr_translate')
										),	
									), gdlr_page_builder_title_option(), array(
										'align'=> array(	
											'title'=> __('Text Align' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'left'=> __('Left Aligned' ,'gdlr_translate'),
												'right'=> __('Right Aligned' ,'gdlr_translate')
											)
										),
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),										
									))
								), 		

								'notification' => array(
									'title'=> __('Notification', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'icon'=> array(	
											'title'=> __('Icon Class', 'gdlr_translate'),
											'type'=> 'text'										
										),
										'type'=> array(	
											'title'=> __('Type', 'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'color-background'=> __('Color Background', 'gdlr_translate'),
												'color-border'=> __('Color Border', 'gdlr_translate'),
											)											
										),
										'content'=> array(	
											'title'=> __('Content', 'gdlr_translate'),
											'type'=> 'textarea'										
										),
										'color'=> array(	
											'title'=> __('Text Color', 'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#000000'											
										),
										'background'=> array(	
											'title'=> __('Background Color', 'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#99d15e',
											'wrapper-class'=> 'type-wrapper color-background-wrapper'
										),
										'border'=> array(	
											'title'=> __('Border Color', 'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#99d15e',
											'wrapper-class'=> 'type-wrapper color-border-wrapper'											
										),
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),
									)
								),

							'page'=> array(
									'title'=> __('Page', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(gdlr_page_builder_title_option(true), array(
										'category'=> array(
											'title'=> __('Category' ,'gdlr_translate'),
											'type'=> 'multi-combobox',
											'options'=> gdlr_get_term_list('page_category'),
											'description'=> __('You can use Ctrl/Command button to select multiple categories or remove the selected category. <br><br> Leave this field blank to select all categories.', 'gdlr_translate')
										),	
										'page-style'=> array(
											'title'=> __('Item Style' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'classic' => __('Classic Style', 'gdlr_translate'),
												'modern' => __('Modern Style', 'gdlr_translate'),
											),
										),	
										'item-size'=> array(
											'title'=> __('Item Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'1/4'=>'1/4',
												'1/3'=>'1/3',
												'1/2'=>'1/2',
												'1/1'=>'1/1'
											),
											'default'=>'1/3'
										),	
										'num-fetch'=> array(
											'title'=> __('Num Fetch' ,'gdlr_translate'),
											'type'=> 'text',	
											'default'=> '8',
											'description'=> __('Specify the number of page you want to pull out.', 'gdlr_translate')
										),																			
										'page-layout'=> array(
											'title'=> __('Page Layout Order' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'fitRows' =>  __('FitRows ( Order items by row )', 'gdlr_translate'),
												'masonry' => __('Masonry ( Order items by spaces )', 'gdlr_translate'),
											),
											'description'=> __('You can see an example of these two layout here', 'gdlr_translate') . 
												'<br><br> http://isotope.metafizzy.co/demos/layout-modes.html'
										),					
										'thumbnail-size'=> array(
											'title'=> __('Thumbnail Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_thumbnail_list(),
											'description'=> __('Only effects to <strong>standard and gallery post format</strong>','gdlr_translate')
										),		
										'pagination'=> array(
											'title'=> __('Enable Pagination' ,'gdlr_translate'),
											'type'=> 'checkbox'
										),					
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-blog-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),				
									))
								),	
								
								'personnel' => array(
									'title'=> __('Personnel', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(array(
										'personnel'=> array(	
											'type'=> 'authorinfo',
											'default-title'=> __('Personnel' ,'gdlr_translate')											
										)
									), gdlr_page_builder_title_option(), array(											
										'personnel-columns'=> array(
											'title'=> __('Personnel Columns' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'),
											'default'=> '3'
										),				
										'personnel-type'=> array(
											'title'=> __('Personnel Type' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'static'=>__('Static Personnel', 'gdlr_translate'),
												'carousel'=>__('Carousel Personnel', 'gdlr_translate'),
											)
										),		
										'personnel-style'=> array(
											'title'=> __('Personnel Style' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'box-style'=>__('Box Style', 'gdlr_translate'),
												'plain-style'=>__('Plain Style', 'gdlr_translate'),
												'round-style'=>__('Round Style', 'gdlr_translate'),
											)
										),	
										'thumbnail-size'=> array(
											'title'=> __('Author Thumbnail Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_thumbnail_list(),
											'wrapper-class'=> 'personnel-style-wrapper plain-style-wrapper round-style-wrapper'
										),
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),												
									))
								),		

								'pie-chart' => array(
									'title'=> __('Pie Chart', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'progress'=> array(
											'title'=> __('Progress (Percent)' ,'gdlr_translate'),
											'type'=> 'text',
											'default'=> '50',
											'description'=> __('Accept integer value between 0 - 100', 'gdlr_translate')
										),		
										'color'=> array(
											'title'=> __('Progress Color' ,'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#f5be3b'
										),
										'bg-color'=> array(
											'title'=> __('Progress Track Color' ,'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#f2f2f2'						
										),										
										'icon'=> array(
											'title'=> __('Icon Class' ,'gdlr_translate'),
											'type'=> 'text',						
										),	
										'title'=> array(
											'title'=> __('Title' ,'gdlr_translate'),
											'type'=> 'text',						
										),			
										'learn-more-link'=> array(
											'title'=> __('Learn More Link' ,'gdlr_translate'),
											'type'=> 'text',						
										),											
										'content'=> array(
											'title'=> __('Content Text' ,'gdlr_translate'),
											'type'=> 'tinymce',						
										),
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),											
									)
								),		
								
								'player' => array(),
								
								'portfolio' => array(),
								
								'price-table' => array(
									'title'=> __('Price Table', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'price-table'=> array(	
											'type'=> 'price-table',
											'default-title'=> __('Price Table' ,'gdlr_translate')											
										),
										'columns'=> array(	
											'title' => __('Columns', 'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6),
											'default'=> 3
										),
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	
									)
								),
								
								'service-with-image' => array(
									'title'=> __('Service With Image', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'image'=> array(
											'title'=> __('Service Image' ,'gdlr_translate'),
											'type'=> 'upload',						
											'button'=> __('upload' ,'gdlr_translate'),				
										),	
										'thumbnail-size'=> array(
											'title'=> __('Thumbnail Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_thumbnail_list()
										),		
										'align'=> array(
											'title'=> __('Item Alignment' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'left'=> __('Left Aligned' ,'gdlr_translate'),
												'right'=> __('Right Aligned' ,'gdlr_translate')
											)
										),
										'title'=> array(
											'title'=> __('Title' ,'gdlr_translate'),
											'type'=> 'text',						
										),													
										'content'=> array(
											'title'=> __('Content Text' ,'gdlr_translate'),
											'type'=> 'tinymce',						
										),	
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	 
									)
								),
								
								'stunning-text' => array(
									'title'=> __('Stunning Text', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'title'=> array(
											'title'=> __('Stunning Text title', 'gdlr_translate'),
											'type'=> 'text'
										),		
										'caption'=> array(
											'title'=> __('Stunning Text Caption' ,'gdlr_translate'),
											'type'=> 'textarea'
										),	
										'button-text'=> array(
											'title'=> __('Stunning Button Text' ,'gdlr_translate'),
											'type'=> 'text',
											'default'=> __('Buy Now', 'gdlr_translate')
										),		
										'button-link'=> array(
											'title'=> __('Stunning Button Link' ,'gdlr_translate'),
											'type'=> 'text'
										),	
										'style'=> array(
											'title'=> __('Stunning Text Style' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'normal' => __('Normal', 'gdlr_translate'),
												'normal with-padding with-border' => __('Normal With Background', 'gdlr_translate'),
												'center' => __('Center', 'gdlr_translate'),
											)
										),	
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),										
									)
								),			

								'skill-bar' => array(
									'title'=> __('Skill Bar', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'content'=> array(
											'title'=> __('Title' ,'gdlr_translate'),
											'type'=> 'text',
										),
										'percent'=> array(
											'title'=> __('Percent' ,'gdlr_translate'),
											'type'=> 'text',
											'default'=> '0',
											'description'=> __('Fill only number here', 'gdlr_translate')
										),	
										'size'=> array(
											'title'=> __('Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'small'=> __('Small' ,'gdlr_translate'),
												'medium'=> __('Medium' ,'gdlr_translate'),
												'large'=> __('Large' ,'gdlr_translate'),
											)
										),	
										'icon'=> array(
											'title'=> __('Icon Class' ,'gdlr_translate'),
											'type'=> 'text',
											'wrapper-class'=> 'size-wrapper medium-wrapper large-wrapper'
										),	
										'text-color'=> array(
											'title'=> __('Text Color' ,'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#ffffff'
										),
										'background-color'=> array(
											'title'=> __('Background Color' ,'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#e9e9e9'
										),												
										'progress-color'=> array(
											'title'=> __('Progress Color' ,'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#f5be3b'
										),			
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	
									)
								),
								
								'skill-item' => array(
									'title'=> __('Skill Item', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'style'=> array(
											'title'=> __('Item Style' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'normal'=> __('Normal' ,'gdlr_translate'),
												'colored'=> __('Color Background' ,'gdlr_translate'),
											)
										),
										'background'=> array(
											'title'=> __('Background Color' ,'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#39dde3',
											'wrapper-class'=> 'style-wrapper colored-wrapper'
										),
										'text-color'=> array(
											'title'=> __('Text Color' ,'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#ffffff',
											'wrapper-class'=> 'style-wrapper colored-wrapper'
										),
										'title'=> array(
											'title'=> __('Title' ,'gdlr_translate'),
											'type'=> 'text',
										),
										'caption'=> array(
											'title'=> __('Caption' ,'gdlr_translate'),
											'type'=> 'text',
										),			
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),
									)
								),
								
								'styled-box' => array(
									'title'=> __('Styled Box', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'type'=> array(
											'title'=> __('Background Type', 'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'color'=> __('Color Background' ,'gdlr_translate'),
												'image'=> __('Image Background' ,'gdlr_translate'),
											)
										),	
										'flip-corner'=> array(
											'title'=> __('Flip Corner' ,'gdlr_translate'),
											'type'=> 'checkbox',
											'wrapper-class'=> 'type-wrapper color-wrapper'
										),										
										'background-color'=> array(
											'title'=> __('Background Color' ,'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#9ada55',
											'wrapper-class'=> 'type-wrapper color-wrapper'
										),												
										'corner-color'=> array(
											'title'=> __('Corner Color' ,'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#3d6817',
											'wrapper-class'=> 'type-wrapper color-wrapper'
										),		
										'content-color'=> array(
											'title'=> __('Content Color' ,'gdlr_translate'),
											'type'=> 'colorpicker',
											'default'=> '#dddddd'
										),											
										'background-image'=> array(
											'title'=> __('Image URL' ,'gdlr_translate'),
											'type'=> 'upload',
											'button' => __('Upload', 'gdlr_translate'),
											'wrapper-class'=> 'type-wrapper image-wrapper'
										),										
										'content'=> array(
											'title'=> __('Content' ,'gdlr_translate'),
											'type'=> 'tinymce'
										),			
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),										
									)
								),									
								
								'testimonial' => array(
									'title'=> __('Testimonial', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(array(
										'testimonial'=> array(	
											'type'=> 'authorinfo',
											'enable-social'=> 'false',
											'default-title'=> __('Testimonial' ,'gdlr_translate')											
										),
									), gdlr_page_builder_title_option(), array(													
										'testimonial-columns'=> array(
											'title'=> __('Testimonial Columns' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5'),
											'default'=> '3'
										),				
										'testimonial-type'=> array(
											'title'=> __('Testimonial Type' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'static'=>__('Static Testimonial', 'gdlr_translate'),
												'carousel'=>__('Carousel Testimonial', 'gdlr_translate'),
											)
										),		
										'testimonial-style'=> array(
											'title'=> __('Testimonial Style' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'box-style'=>__('Box Style', 'gdlr_translate'),
												'round-style'=>__('Round Style', 'gdlr_translate'),
												'plain-style'=>__('Plain Style', 'gdlr_translate'),
												'large plain-style'=>__('Large Plain Style', 'gdlr_translate'),
											)
										),		
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),											
									))
								),								
								
								'tab' => array(
									'title'=> __('Tab', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(array(
										'tab'=> array(
											'type'=> 'tab',
											'default-title'=> __('Tab' ,'gdlr_translate')
										),					
										'initial-state'=> array(
											'title'=> __('Initial Tab', 'gdlr_translate'),
											'type'=> 'text',
											'default'=> 1,
											'description'=> __('1 will open the first tab, 2 for second tab and so on.', 'gdlr_translate')						
										),		
										'style'=> array(
											'title'=> __('Tab Style' ,'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'horizontal' => __('Horizontal Tab', 'gdlr_translate'),
												'vertical' => __('Vertical Tab', 'gdlr_translate'),
												'vertical right' => __('Vertical Right Tab', 'gdlr_translate')
											)
										)	
									), gdlr_page_builder_title_option(), array(											
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	
									))
								), 								

								'title' => array(
									'title'=> __('Title', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(gdlr_page_builder_title_option(true), array(						
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	
									))
								),
								
								'toggle-box' => array(
									'title'=> __('Toggle Box', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(array(
										'toggle-box'=> array(
											'type'=> 'toggle-box',
											'default-title'=> __('Toggle Box' ,'gdlr_translate')							
										),
									), gdlr_page_builder_title_option(), array(										
										'style'=> array(
											'title'=> __('Accordion Style' ,'gdlr_translate'),
											'type' => 'combobox',
											'options' => array(
												'style-1' => __('Style 1 ( Colored Background )', 'gdlr_translate'),
												'style-2' => __('Style 2 ( Transparent Background )', 'gdlr_translate')
											)
										),	
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),										
									))
								), 	

								'upcoming-match' => array()
								 					
							)
						),
						
						'media-item' => array(
							'title' => __('Media Item', 'gdlr_translate'),
							'blank_option' => __('- Select Media Item -', 'gdlr_translate'),
							'options' => array(
							
								'banner' => array(
									'title'=> __('Banner', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(									
										'slider'=> array(	
											'overlay'=> 'false',
											'caption'=> 'false',
											'type'=> 'slider',
										),										
										'thumbnail-size'=> array(
											'title'=> __('Thumbnail Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_thumbnail_list()
										),
										'banner-columns'=> array(
											'title'=> __('Banner Image Columns' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6'),
											'default'=> '4'
										),			
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),										
									)	
								),		

								'banner-with-divider' => array(
									'title'=> __('Banner With Divider', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'column-no' =>  array(
											'title'=> __('Column Number', 'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'one'=>1,
												'two'=>2,
												'three'=>3,
											)
										),
										'image-1'=> array(
											'title'=> __('Image 1', 'gdlr_translate'),
											'type'=> 'upload',
											'button'=> __('Upload', 'gdlr_translate'),
											'wrapper-class'=>'column-no-wrapper one-wrapper two-wrapper three-wrapper',
											'description'=> __('Recommend Width : 365px','gdlr_translate')
										),		
										'link-1'=> array(
											'title'=> __('Link 1', 'gdlr_translate'),
											'type'=> 'text',
											'wrapper-class'=>'column-no-wrapper one-wrapper two-wrapper three-wrapper'
										),
										'image-2'=> array(
											'title'=> __('Image 2', 'gdlr_translate'),
											'type'=> 'upload',
											'button'=> __('Upload', 'gdlr_translate'),
											'wrapper-class'=>'column-no-wrapper two-wrapper three-wrapper',
											'description'=> __('Recommend Width : 364px with the same height','gdlr_translate')
										),		
										'link-2'=> array(
											'title'=> __('Link 2', 'gdlr_translate'),
											'type'=> 'text',
											'wrapper-class'=>'column-no-wrapper two-wrapper three-wrapper'
										),
										'image-3'=> array(
											'title'=> __('Image 3', 'gdlr_translate'),
											'type'=> 'upload',
											'button'=> __('Upload', 'gdlr_translate'),
											'wrapper-class'=>'column-no-wrapper three-wrapper',
											'description'=> __('Recommend Width : 364px with the same height','gdlr_translate')
										),		
										'link-3'=> array(
											'title'=> __('Link 3', 'gdlr_translate'),
											'type'=> 'text',
											'wrapper-class'=>'column-no-wrapper three-wrapper'
										),
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	
									)
								),

								'gallery' => array(
									'title'=> __('Gallery', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(array(								
										'slider'=> array(	
											'overlay'=> 'false',
											'caption'=> 'false',
											'type'=> 'slider',
										),				
									), gdlr_page_builder_title_option(), array(												
										'thumbnail-size'=> array(
											'title'=> __('Thumbnail Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_thumbnail_list()
										),
										'gallery-style'=> array(
											'title'=> __('Gallery Style' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'grid' => __('Grid Gallery', 'gdlr_translate'),
												'thumbnail' => __('Thumbnail Gallery', 'gdlr_translate')
											)
										),
										'gallery-columns'=> array(
											'title'=> __('Gallery Image Columns' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array('1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5', '6'=>'6'),
											'default'=> '4'
										),	
										'num-fetch'=> array(
											'title'=> __('Num Fetch (Per Page)' ,'gdlr_translate'),
											'type'=> 'text',
											'description'=> __('Leave this field blank to fetch all image without pagination.', 'gdlr_translate'),
											'wrapper-class'=>'gallery-style-wrapper grid-wrapper'
										),
										'show-caption'=> array(
											'title'=> __('Show Caption' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array('yes'=>'Yes', 'no'=>'No')
										),			
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	
									))	
								),		
								
								'image-frame' => array(
									'title'=> __('Image / Frame', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'image-id'=> array(
											'title'=> __('Upload Image', 'gdlr_translate'),
											'type'=> 'upload',
											'button'=> __('Upload', 'gdlr_translate')
										),	
										'thumbnail-size'=> array(
											'title'=> __('Thumbnail Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_thumbnail_list()
										),
										'link-type'=> array(
											'title'=> __('Image Link', 'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'none'=> __('None', 'gdlr_translate'),
												'url'=> __('Link to Url', 'gdlr_translate'),
												'current'=> __('Lightbox to Current Image', 'gdlr_translate'),
												'image'=> __('Lightbox to Image', 'gdlr_translate'),
												'video'=> __('Lightbox to Video', 'gdlr_translate'),
											)
										),
										'url' => array(
											'title' => __('URL', 'gdlr_translate'),
											'type' => 'text',
											'wrapper-class' => 'link-type-wrapper image-wrapper video-wrapper url-wrapper'
										),
										'frame-type'=> array(
											'title'=> __('Frame Type', 'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'none'=> __('none', 'gdlr_translate'),
												'border'=> __('Border', 'gdlr_translate'),
												'solid'=> __('Solid', 'gdlr_translate'),
												'rounded'=> __('Round', 'gdlr_translate'),
												'circle'=> __('Circle', 'gdlr_translate')
											)
										),
										'frame-background' => array(
											'title' => __('Frame Background', 'gdlr_translate'),
											'type' => 'colorpicker',
											'default' => '#dddddd',
											'wrapper-class' => 'frame-type-wrapper solid-wrapper'
										),
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),
									)
								),
								
								'layer-slider' => array(
									'title'=> __('Layer Slider', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'id'=> array(
											'title'=> __('Slider Type', 'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_layerslider_list(),
											'description'=> __('Please update layerslider to latest version to make this item work properly too', 'gdlr_translate')
										),			
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	
									)
								),

								'master-slider' => array(
									'title'=> __('Master Slider', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'id'=> array(
											'title'=> __('Slider Type', 'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_masterslider_list(),
											'description'=> __('Please update layerslider to latest version to make this item work properly too', 'gdlr_translate')
										),			
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	
									)
								),								

								'post-slider' => array(
									'title'=> __('Post Slider', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(	
										'category'=> array(
											'title'=> __('Category' ,'gdlr_translate'),
											'type'=> 'multi-combobox',
											'options'=> gdlr_get_term_list('category'),
											'description'=> __('You can use Ctrl/Command button to select multiple categories or remove the selected category. <br><br> Leave this field blank to select all categories.', 'gdlr_translate')
										),	
										'num-excerpt'=> array(
											'title'=> __('Num Excerpt (Word)' ,'gdlr_translate'),
											'type'=> 'text',	
											'default'=> '25',
											'description'=> __('This is a number of word (decided by spaces) that you want to show on the post excerpt. <strong>Use 0 to hide the excerpt, -1 to show full posts and use the wordpress more tag</strong>.', 'gdlr_translate')
										),	
										'num-fetch'=> array(
											'title'=> __('Num Fetch' ,'gdlr_translate'),
											'type'=> 'text',	
											'default'=> '8',
											'description'=> __('Specify the number of posts you want to pull out.', 'gdlr_translate')
										),										
										'thumbnail-size'=> array(
											'title'=> __('Thumbnail Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_thumbnail_list()
										),	
										'style'=> array(
											'title'=> __('Style' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'no-excerpt'=>__('No Excerpt', 'gdlr_translate'),
												'with-excerpt'=>__('With Excerpt', 'gdlr_translate'),
											)
										),
										'caption-style'=> array(
											'title'=> __('Caption Style' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'post-bottom post-slider'=>__('Bottom Caption', 'gdlr_translate'),
												'post-right post-slider'=>__('Right Caption', 'gdlr_translate'),
												'post-left post-slider'=>__('Left Caption', 'gdlr_translate')
											),
											'wrapper-class' => 'style-wrapper with-excerpt-wrapper'
										),											
										'orderby'=> array(
											'title'=> __('Order By' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'date' => __('Publish Date', 'gdlr_translate'), 
												'title' => __('Title', 'gdlr_translate'), 
												'rand' => __('Random', 'gdlr_translate'), 
											)
										),
										'order'=> array(
											'title'=> __('Order' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'desc'=>__('Descending Order', 'gdlr_translate'), 
												'asc'=> __('Ascending Order', 'gdlr_translate'), 
											)
										),			
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),											
									)
								),
								
								'slider' => array(
									'title'=> __('Slider', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'slider'=> array(	
											'overlay'=> 'false',
											'caption'=> 'true',
											'type'=> 'slider'						
										),	
										'slider-type'=> array(
											'title'=> __('Slider Type', 'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> array(
												'flexslider' => __('Flex slider', 'gdlr_translate'),
												'nivoslider' => __('Nivo Slider', 'gdlr_translate')
											)
										),		
										'thumbnail-size'=> array(
											'title'=> __('Thumbnail Size' ,'gdlr_translate'),
											'type'=> 'combobox',
											'options'=> gdlr_get_thumbnail_list()
										),			
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),											
									)
								),

								'twitter' => array(
									'title'=> __('Twitter', 'gdlr_translate'), 
									'type'=>'item',
									'options'=> array_merge(gdlr_page_builder_title_option(true), array(
										'twitter-name'=> array(	
											'title'=> __('Twitter Name' ,'gdlr_translate'),
											'type'=> 'text'
										),
										'show-num'=> array(	
											'title'=> __('Show Num' ,'gdlr_translate'),
											'type'=> 'text',
											'default'=> '3'
										),
										'consumer-key'=> array(	
											'title'=> __('Consumer Key' ,'gdlr_translate'),
											'type'=> 'text'
										),
										'consumer-secret'=> array(	
											'title'=> __('Consumer Secret' ,'gdlr_translate'),
											'type'=> 'text'
										),
										'access-token'=> array(	
											'title'=> __('Access Token' ,'gdlr_translate'),
											'type'=> 'text'
										),
										'access-token-secret'=> array(	
											'title'=> __('Access Token Secret' ,'gdlr_translate'),
											'type'=> 'text'
										),
										'cache-time'=> array(	
											'title'=> __('Cache Time ( Hours )' ,'gdlr_translate'),
											'type'=> 'text',
											'default'=> '1'
										),
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	
									))
								),	
								
								'video' => array(
									'title'=> __('Video', 'gdlr_translate'), 
									'type'=>'item',
									'options'=>array(
										'url'=> array(	
											'title'=> __('Video Url', 'gdlr_translate'),
											'type'=> 'text',
											'descirption'=> __('Youtube / Vimeo / Self Hosted Video Is allowed Here', 'gdlr_translate')
										),
										'margin-bottom' => array(
											'title' => __('Margin Bottom', 'gdlr_translate'),
											'type' => 'text',
											'default' => $gdlr_spaces['bottom-item'],
											'description' => __('Spaces after ending of this item', 'gdlr_translate')
										),	
									)
								),															
								
							)
						)
					)
				)
			);
			
		}
		
	}
	
?>