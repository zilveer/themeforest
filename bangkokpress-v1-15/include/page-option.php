<?php

	/*	
	*	Goodlayers Page Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file create and contains the page post_type meta elements
	*	---------------------------------------------------------------------
	*/
	
	// a type that each element can be ( also set in page-dragging.js )
	$div_size = array(
			
		'Accordion' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
					
		'Blog' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',			
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',			
			'element1-1'=>'1/1'),
		
		'Contact-Form' => array(
			'element1-1'=>'1/1'
		),
		
		'Content' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'			
		),		
		
		'Column' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),

		'Column-Service' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
		
		'Divider' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),

		'Gallery' => array(
			'element1-1'=>'1/1'),	
			
		'Message-Box' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),

		'Page' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
			
		'Portfolio' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
		
		'Post-Slider' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
		
		'Price-Item' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),			
			
		'Slider' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
		
		'Stunning-Text' => array(
			'element1-1'=>'1/1',
		),
		
		'Tab' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
			
		'Testimonial' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
			
		'Toggle-Box' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),

	);
	
	// the element in page options
	$page_meta_boxes = array(
		"Page Item" => array(
			'item'=>'page-option-item-type' ,
			'size'=>'page-option-item-size', 
			'xml'=>'page-option-item-xml', 
			'type'=>'page-option-item',
			'name'=>array(
				
				'Accordion' =>array(
					'header'=>array(
						'title'=> __('HEADER TITLE', 'gdl_back_office'),
						'name'=> 'page-option-item-accordion-header-title',
						'type'=> 'inputtext'),
					'tab-item'=>array(
						'tab-num'=>'page-option-item-accordion-num',
						'title'=>'page-option-item-accordion-title',
						'caption'=>'page-option-item-accordion-content',
						'active'=>'',
						'hr'=>'none')
				),
				
				'Blog'=>array(
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-blog-header-title',
						'type'=> 'inputtext'),			
					'item-size'=>array(
						'title'=>'BLOG SIZE',
						'name'=>'page-option-item-blog-size',
						'options'=>array('1/4 Blog Grid Style', '1/3 Blog Grid Style', '1/2 Blog Grid Style', '1/1 Blog Grid Style',
							'1/1 Blog Full Style', '1/4 Blog List Style', '1/3 Blog List Style', '1/2 Blog List Style', 
							'1/4 Blog Grid List Style', '1/3 Blog Grid List Style', '1/2 Blog Grid List Style',
							'1/1 Blog Slide Show'),
						'type'=>'combobox',
						'hr'=>'none',
						'description'=>'This is the actual size of the blog thumbnail. Outside size is the size of wrapper. The full-blog will appear only when the wrapper size equals to 1/1/.'),
					'slideshow-title'=>array(
						'title'=>'ENABLE SLIDE SHOW TITLE',
						'name'=>'page-option-item-blog-slideshow-title',
						'options'=>array('Yes', 'No'),
						'type'=>'combobox',
						'hr'=>'none'),
					'slideshow-type'=>array(
						'title'=>'SLIDE SHOW IMAGE TYPE',
						'name'=>'page-option-item-blog-slideshow-image-type',
						'options'=>array('Link to Post', 'Lightbox'),
						'type'=>'combobox'),
					'category'=>array(
						'title'=>'CHOOSE CATEGORY',
						'name'=>'page-option-item-blog-category',
						'options'=>array(),
						'type'=>'combobox',
						'description'=>'Choose the post category you want to fetch the post.'),
					'num-fetch'=>array(					
						'title'=> 'BLOG NUM FETCH',
						'name'=> 'page-option-item-blog-num-fetch',
						'type'=> 'inputtext',
						'default'=> 9,
						'description'=>'This is the number of fetched item in one page.'),
					'num-excerpt'=>array(					
						'title'=> 'LENGHT OF EXCERPT',
						'name'=> 'page-option-item-blog-num-excerpt',
						'type'=> 'inputtext',
						'default'=> 180,
						'description'=>'This is the number of thumbnail content character.'),
					'show-full-blog-post'=>array(					
						'title'=> 'SHOW FULL BLOG CONTENT',
						'name'=> 'page-option-item-show-full-blog',
						'type'=> 'combobox',
						'options'=> array('No','Yes'),
						'description'=>'Select this to yes will fetch the full posts to show ( only use for the 1/1 full thumbnail blog grid style. ).'),							
					'pagination'=>array(
						'title'=>'ENABLE PAGINATION',
						'name'=>'page-option-item-blog-pagination',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'hr'=> 'none',
						'description'=>'Pagination will only appear when the number of blog post is greater than the number of fetched item in one page.'),
				),
				
				'Contact-Form'=>array(
					'email'=>array(
						'title'=>'E-MAIL',
						'name'=>'page-option-item-contat-email',
						'type'=>'inputtext',
						'hr'=>'none',
						'description'=>'Place the destination of the email when user submit the contact form here.')
				),
				
				'Content' => array(
					'description'=>array(
						'title'=> 'DESCRIPTION',
						'name'=> 'no-name',
						'type'=> 'description',
						'description'=> 'This item will get the content in the editor(wordpress visual/html editor) to show as a page item. ' .
							'Don\'t forget to hide the page content in page options, otherwise there will be a duplicated content in the page.',
						'hr'=> 'none'
					),
				),				
				
				'Column'=>array(
					'column-text'=>array(
						'title'=> 'Column Text',
						'name'=> 'page-option-item-column-text',
						'type'=> 'textarea',
						'hr'=> 'none')
				),	
								
				'Divider' =>array(
					'margin-top'=>array(
						'title'=> 'MARGIN TOP',
						'name'=> 'page-option-item-divider-margin-top',
						'type'=> 'inputtext',
						'default'=> 0,
						'description'=>'This is the additional space over the divider line( from the initial value ). The initial value is 20px.'),	
					'margin-bottom'=>array(
						'title'=> 'MARGIN BOTTOM',
						'name'=> 'page-option-item-divider-margin-bottom',
						'type'=> 'inputtext',
						'default'=> 0,
						'description'=>'This is the additional space below the divider line( from the initial value ). The initial value is 20px.',
						'hr'=>'none'),				
				),

				'Gallery' => array(
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-gallery-header-title',
						'type'=> 'inputtext'),	
					'item-size'=>array(
						'title'=> 'ITEM SIZE',
						'name'=> 'page-option-item-gallery-item-size',
						'type'=> 'combobox',
						'options'=> array('1/4', '1/3', '1/2')
					),
					'page'=> array(
						'title'=> 'CHOOSE GALLERY PAGE',
						'name'=> 'page-option-item-gallery-page',
						'type'=> 'combobox',
						'options'=> array(),
						'hr'=>'none'
					),
				),
				
				'Message-Box'=>array(
					'color'=>array(
						'title'=>'BOX COLOR',
						'name'=>'page-option-item-message-color',
						'options'=>array('0'=>'red', '1'=>'green', '2'=>'yellow', '3'=>'blue'),
						'type'=>'combobox'),
					'title'=>array(
						'title'=> 'MESSAGE TITLE',
						'name'=> 'page-option-item-message-title',
						'type'=> 'inputtext'),		
					'content'=>array(
						'title'=> 'MESSAGE CONTENT',
						'name'=> 'page-option-item-message-content',
						'type'=> 'textarea',
						'hr'=> 'none'),				
				),

				'Page'=>array(
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-page-header-title',
						'type'=> 'inputtext',
						'description'=>'This "Page Item" will fetch the child page of this page( instead of category like portfolio ).'),			
					'item-size'=>array(
						'title'=>'PAGE ITEM SIZE',
						'name'=>'page-option-item-page-size',
						'options'=>array('0'=>'1/4', '1'=>'1/3', '2'=>'1/2', '3'=>'1/1'),
						'type'=>'combobox',
						'description'=>'This is the actual size of the page thumbnail. Outside size is the size of wrapper. If you choose the wrapper size to be 1/1 and item size to be 1/4, you will get up to 4 page thumbnails in one row.'),
					'num-fetch'=>array(					
						'title'=> 'PAGE NUM FETCH',
						'name'=> 'page-option-item-page-num-fetch',
						'type'=> 'inputtext',
						'default'=> 9,
						'description'=>'This is the number of fetched item in one page.'),
					'show-title'=>array(
						'title'=>'SHOW TITLE',
						'name'=>'page-option-item-page-show-header',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'description'=>'Enable to show the thumbnail title.'),
					'show-excerpt'=>array(
						'title'=>'SHOW EXCERPT',
						'name'=>'page-option-item-page-show-excerpt',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'hr'=> 'none',
						'description'=>'Enable to show the thumbnail excerpt.'),
					'num-excerpt'=>array(					
						'title'=> 'LENGHT OF EXCERPT',
						'name'=> 'page-option-item-page-num-excerpt',
						'type'=> 'inputtext',
						'default'=> 180,
						'description'=>'The number of thumbnail content character.'),
					'pagination'=>array(
						'title'=>'ENABLE PAGINATION',
						'name'=>'page-option-item-page-pagination',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'hr'=> 'none',
						'description'=>'Pagination will only appear when the number of selected page is greater than the number of fetched item in one page.'),
				),
				
				'Portfolio'=>array(
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-portfolio-header-title',
						'type'=> 'inputtext'),			
					'item-size'=>array(
						'title'=>'PORTFOLIO SIZE',
						'name'=>'page-option-item-portfolio-size',
						'options'=>array('0'=>'1/4', '1'=>'1/3', '2'=>'1/2'),
						'type'=>'combobox',
						'description'=>'This is the actual size of the portfolio thumbnail. Outside size is the size of wrapper. If you choose the wrapper size to be 1/1 and item size to be 1/4, you will get up to 4 portfolio thumbnails in one row.'),
					'category'=>array(
						'title'=>'CHOOSE CATEGORY',
						'name'=>'page-option-item-portfolio-category',
						'options'=>array(),
						'type'=>'combobox',
						'hr'=> 'none',
						'description'=>'Choose the portfolio category you want the item to be fetched.'),
					'filterable'=>array(
						'title'=>'ENABLE FILTERABLE',
						'name'=>'page-option-item-portfolio-filterable',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'description'=>'This option enable the JQuery filterable plugin that helps you filter the portfolio in each category.'),
					'num-fetch'=>array(					
						'title'=> 'PORTFOLIO NUM FETCH',
						'name'=> 'page-option-item-portfolio-num-fetch',
						'type'=> 'inputtext',
						'default'=> 9,
						'description'=> 'This is the number of portfolio thumbnail you want to fetch in one page.'),
					'show-title'=>array(
						'title'=>'SHOW TITLE',
						'name'=>'page-option-item-portfolio-show-header',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'description'=>'Disable this option to hide the portfolio thumbnail title.'),
					'show-excerpt'=>array(
						'title'=>'SHOW EXCERPT',
						'name'=>'page-option-item-portfolio-show-excerpt',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'hr'=> 'none',
						'description'=>'Enable to show the portfolio thumbnail excerpt'),
					'num-excerpt'=>array(					
						'title'=> 'LENGHT OF EXCERPT',
						'name'=> 'page-option-item-portfolio-num-excerpt',
						'type'=> 'inputtext',
						'default'=> 180,
						'description'=>'Set the portfolio thumbnail content character length.'),
					'pagination'=>array(
						'title'=>'ENABLE PAGINATION',
						'name'=>'page-option-item-portfolio-pagination',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'hr'=> 'none',
						'description'=>'Pagination will only appear when the number of selected page is greater than the number of fetched item in one page.'),
				),				

				'Post-Slider'=>array(
					'slider-type'=>array(
						'title'=>'SLIDER TYPE',
						'name'=>'page-option-item-post-slider-type',
						'options'=>array('0'=>'Flex Slider', '1'=>'Carousel Slider'),
						'type'=>'combobox'),
					'height'=>array(
						'title'=>'SLIDER HEIGHT',
						'name'=>'page-option-item-post-slider-height',
						'type'=>'inputtext',
						'default'=>'330'),		
					'category'=>array(
						'title'=>'CHOOSE POST CATEGORY',
						'name'=>'page-option-item-post-slider-category',
						'options'=>array(),
						'type'=>'combobox'),	
					'show-caption'=>array(
						'title'=>'SHOW SLIDER CAPTION',
						'name'=>'page-option-item-post-slider-caption',
						'type'=>'combobox',
						'options'=>array('Yes','No')),							
					'num-excerpt'=>array(
						'title'=>'EXCERPT NUMBER',
						'name'=>'page-option-item-post-slider-excerpt',
						'type'=>'inputtext',
						'default'=>120),						
					'num-fetch'=>array(					
						'title'=> 'POST NUM FETCH',
						'name'=> 'page-option-item-post-slider-num-fetch',
						'type'=> 'inputtext',
						'default'=> 4,
						'hr'=>'none'),						
					),
				
				'Price-Item'=>array(
					'item-number'=>array(
						'title'=>'Item Number',
						'name'=>'page-option-item-price-item-size',
						'options'=>array('0'=>'1', '1'=>'2', '2'=>'3', '3'=>'4', '4'=>'5', '5'=>'6'),
						'type'=>'combobox',
						'description'=>'The number of items you want to fetch from each price category'),
					'category'=>array(
						'title'=>'CHOOSE PRICE CATEGORY',
						'name'=>'page-option-item-price-item-category',
						'options'=>array(),
						'type'=>'combobox',
						'hr'=> 'none',
						'description'=>'Choose the category you want item to be fetched.'),
				),
					
				'Slider' =>array(
					'slider-type'=>array(
						'title'=>'SLIDER TYPE',
						'name'=>'page-option-item-slider-type',
						'options'=>array('0'=>'Flex Slider', '1'=>'Carousel Slider'),
						'type'=>'combobox',
						'hr'=>'none'),
					'height'=>array(
						'title'=>'SLIDER HEIGHT',
						'name'=>'page-option-item-slider-height',
						'type'=>'inputtext',
						'hr'=>'none',
						'default'=>'330'),
					'slider-item'=>array(
						'slider-num'=>'page-option-item-slider-num',
						'image'=>'page-option-item-slider-image',
						'title'=>'page-option-item-slider-title',
						'link'=>'page-option-item-slider-link',
						'caption'=>'page-optin-item-slider-caption',
						'linktype'=>'page-option-item-slider-linktype',
						'hr'=>'none')
				),
				
				'Stunning-Text'=>array(
					'title'=>array(
						'title'=> 'TITLE',
						'name'=> 'page-option-item-stunning-text-title',
						'type'=> 'inputtext'),
					'caption'=>array(
						'title'=> 'CAPTION',
						'name'=> 'page-option-item-stunning-text-caption',
						'type'=> 'textarea'),
					'button-title'=>array(
						'title'=> 'BUTTON TITLE',
						'name'=> 'page-option-item-stunning-text-button-title',
						'type'=> 'inputtext',
						'description'=> 'The stunning text button will appear if this field is not a blank.'),
					'button-link'=>array(
						'title'=> 'BUTTON LINK',
						'name'=> 'page-option-item-stunning-text-button-link',
						'type'=> 'inputtext',
						'description'=> 'This is a stunning text button link url. This field will be ignored when button title equals to blank.'),
					'button-top-margin'=>array(
						'title'=> 'BUTTON TOP MARGIN',
						'name'=> 'page-option-item-stunning-text-button-top-margin',
						'type'=> 'inputtext',
						'default'=> '20',
						'hr'=> 'none',
						'description'=> 'This is the space over the stunning text. You can change it based on the stunning text content.'),
				),
				
				'Tab' =>array(
					'tab-item'=>array(
						'tab-num'=>'page-option-item-tab-num',
						'title'=>'page-option-item-tab-title',
						'caption'=>'page-option-item-tab-content',
						'active'=>'',
						'hr'=>'none')
				),
						
				'Testimonial' =>array(
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-testimonial-header-title',
						'type'=> 'inputtext'),
					'item-size'=>array(
						'title'=>'TESTIMONIAL SIZE',
						'name'=>'page-option-item-testimonial-size',
						'options'=>array('0'=>'1/4', '1'=>'1/3', '2'=>'1/2', '3'=>'2/3', '4'=>'3/4', '5'=>'1/1'),
						'type'=>'combobox',
						'description'=>'This is the actual size of the testimonial. Outside size is the size of wrapper. If you choose the wrapper size to be 1/1 and item size to be 1/4, you will get up to 4 testimonial in one row.'),
					'display-type'=>array(
						'title'=>'CHOOSE THE DISPLAY TYPE',
						'name'=>'page-option-item-testimonial-display-type',
						'options'=>array('0'=>'Testimonial Category', '1'=>'Specific Testimonial'),
						'type'=>'combobox'),
					'category'=>array(
						'title'=>'CHOOSE CATEGORY',
						'name'=>'page-option-item-testimonial-category',
						'options'=>array(),
						'type'=>'combobox',
						'hr'=>'none',
						'description'=>'Choose the category you want testimonial to be fetched. This theme will display testimonail using the jquery carousel.'),
					'specific'=>array(
						'title'=>'SPECIFIC TESTIMONIAL',
						'name'=>'page-option-item-testimonial-specific',
						'options'=>array(),
						'type'=>'combobox',
						'hr'=>'none',
						'description' => 'If you choose Specific Testimonial option, it will ignores the testimonial size above and' . 
							' use the wrapper size ( outside ) instead.'),

			
				),
				
				'Toggle-Box' =>array(
					'header'=>array(
						'title'=> __('HEADER TITLE', 'gdl_back_office'),
						'name'=> 'page-option-item-toggle-box-header-title',
						'type'=> 'inputtext'),
					'tab-item'=>array(
						'tab-num'=>'page-option-item-toggle-box-num',
						'title'=>'page-option-item-toggle-box-title',
						'caption'=>'page-option-item-toggle-box-content',
						'active'=>'page-option-item-toggle-box-active',
						'hr'=>'none')
				),

			)
		),

		"Page Background Type" => array(
			'title'=> __('ENABLE PAGE BACKGROUND', 'gdl_back_office'),
			'type'=>'radioimage',
			'name'=>'page-option-enable-background',
			'options'=> array(
				'1'=> array('value'=>'Yes', 'image'=>'/include/images/full-background.png'),
				'2'=> array('value'=>'No', 'image'=>'/include/images/grid-background.png')),
			'default'=>'Yes',		
		),
		
		"Page Sidebar Template" => array(
			'title'=> __('SELECT LAYOUT', 'gdl_back_office'), 
			'name'=>'page-option-sidebar-template', 
			'type'=>'radioimage', 
			'default'=>'no-sidebar',
			'hr'=>'none',
			'options'=>array(
				'1'=>array('value'=>'right-sidebar','image'=>'/include/images/right-sidebar.png'),
				'2'=>array('value'=>'left-sidebar','image'=>'/include/images/left-sidebar.png'),
				'3'=>array('value'=>'both-sidebar','image'=>'/include/images/both-sidebar.png'),
				'4'=>array('value'=>'no-sidebar','image'=>'/include/images/no-sidebar.png','default'=>'selected')
			)
		),
		
		"Choose Left Sidebar" => array(
			'title'=> __('CHOOSE LEFT SIDEBAR', 'gdl_back_office'),
			'name'=>'page-option-choose-left-sidebar',
			'type'=>'combobox',
			'hr'=>'none'
		),		
		
		"Choose Right Sidebar" => array(
			'title'=> __('CHOOSE RIGHT SIDEBAR', 'gdl_back_office'),
			'name'=>'page-option-choose-right-sidebar',
			'type'=>'combobox',
		),
		
		"Page Title" => array(
			'type'=>'combobox',
			'name'=>'page-option-show-title',
			'options'=> array('Yes', 'No'),
			'title'=> __('SHOW PAGE TITLE', 'gdl_back_office'),
			'description' => 'Show/Hide Page title at the top of the page.'
		),	

		"Page Content" => array(
			'type'=>'combobox',
			'name'=>'page-option-show-content',
			'options'=> array('Yes', 'No'),
			'title'=> __('SHOW PAGE CONTENT', 'gdl_back_office'),
			'description'=>'Show/Hide page content below the page title.',
			'hr'=>'none'
		),	

	);
	
	// create Page Option Meta
	add_action('add_meta_boxes', 'add_page_option');
	function add_page_option(){
	
		add_meta_box('page-option', __('Page Option','gdl_back_office'), 'add_page_option_element',
			'page', 'normal', 'high');
			
	}
	function add_page_option_element(){
	
		global $post, $page_meta_boxes;
		
		//init array
		$page_meta_boxes['Page Item']['name']['Blog']['category']['options'] = get_category_list( 'category' );
		$page_meta_boxes['Page Item']['name']['Gallery']['page']['options'] = get_title_list( 'gallery' );		
		$page_meta_boxes['Page Item']['name']['Portfolio']['category']['options'] = get_category_list( 'portfolio-category' );
		$page_meta_boxes['Page Item']['name']['Price-Item']['category']['options'] = get_category_list( 'price-table-category' );
		$page_meta_boxes['Page Item']['name']['Post-Slider']['category']['options'] = get_category_list( 'category' );
		$page_meta_boxes['Page Item']['name']['Testimonial']['category']['options'] = get_category_list( 'testimonial-category' );
		$page_meta_boxes['Page Item']['name']['Testimonial']['specific']['options'] = get_title_list( 'testimonial' );
		$page_meta_boxes['Choose Left Sidebar']['options'] = get_sidebar_name();
		$page_meta_boxes['Choose Right Sidebar']['options'] = $page_meta_boxes['Choose Left Sidebar']['options'];
		
		echo '<div id="gdl-overlay-wrapper">';
		echo '<div id="gdl-overlay-content">';
		
		set_nonce();
		
		//get value
		foreach( $page_meta_boxes as $page_meta_box ){
		
			if( $page_meta_box['type'] == 'page-option-item' ){
			
				$page_meta_box['value'] = get_post_meta($post->ID, $page_meta_box['xml'], true);
				print_page_default_elements($page_meta_box);
				print_page_selected_elements($page_meta_box);
			
			}else if( $page_meta_box['type'] == 'imagepicker' ){
			
				$slider_xml_string = get_post_meta($post->ID, $page_meta_box['xml'], true);
				if(!empty($slider_xml_string)){
				
					$slider_xml_val = new DOMDocument();
					$slider_xml_val->loadXML( $slider_xml_string );
					$page_meta_box['value'] = $slider_xml_val->documentElement;
					
				}
				print_meta( $page_meta_box );
			
			}else{
			
				$page_meta_box['value'] = get_post_meta($post->ID, $page_meta_box['name'], true);
				print_meta( $page_meta_box );
			
			}
			echo "<div class='clear'></div>";
			echo empty($page_meta_box['hr'])? '<hr class="separator mt20">': '';
		
		}
		
		
		
		echo '</div>';
		echo '</div>';
		
	}
	
	// call when update page with save_post action 
	function save_page_option_meta($post_id){
	
		global $page_meta_boxes;
		$edit_meta_boxes = $page_meta_boxes;
		
		foreach ($edit_meta_boxes as $edit_meta_box){
		
			if( $edit_meta_box['type'] == 'page-option-item' ){
			
				if(isset($_POST[$edit_meta_box['size']])){
				
					$num = sizeof($_POST[$edit_meta_box['size']]);
					
				}else{
				
					$num = 0;
					
				}
				
				$item_xml = '<item-tag>';
				$item_content_num = array();
				
				for($i=0; $i<$num; $i++){
				
					$item_type_new = $_POST[$edit_meta_box['item']][$i];
					$item_xml = $item_xml . '<' . $item_type_new . '>';
					$item_size_new = $_POST[$edit_meta_box['size']][$i];
					$item_xml = $item_xml . create_xml_tag('size',$item_size_new);
					$item_content = $edit_meta_box['name'][$item_type_new];
				
					if(!isset($item_content_num[$item_type_new])){
					
						$item_content_num[$item_type_new] = 1 ;
						
						if($item_type_new == 'Slider'){
						
							$item_content_num['slider-item'] = 0;
							
						}else if($item_type_new == 'Accordion'){
						
							$item_content_num['accordion-item'] = 0;
							
						}else if($item_type_new == 'Tab'){
						
							$item_content_num['tab-item'] = 0;
							
						}else if($item_type_new == 'Toggle-Box'){
						
							$item_content_num['toggle-box-item'] = 0;
							
						}
					}
					
					foreach($item_content as $key => $value){
					
						if($key == 'slider-item'){
					
							$item_xml = $item_xml . '<' . $key . '>';
							$slider_num = $_POST[$value['slider-num']][$item_content_num[$item_type_new]];
							
							for($j=0; $j<$slider_num; $j++){
							
								$item_xml = $item_xml . '<slider>';
								$temp = isset( $_POST[$value['image']][$item_content_num['slider-item']] )? $_POST[$value['image']][$item_content_num['slider-item']] : '';
								$item_xml = $item_xml . create_xml_tag('image', $temp);
								$temp = isset( $_POST[$value['title']][$item_content_num['slider-item']] )? htmlspecialchars($_POST[$value['title']][$item_content_num['slider-item']]) : '';
								$item_xml = $item_xml . create_xml_tag('title', $temp);
								$temp = isset( $_POST[$value['linktype']][$item_content_num['slider-item']] )? $_POST[$value['linktype']][$item_content_num['slider-item']] : '';
								$item_xml = $item_xml . create_xml_tag('linktype', $temp);
								$temp = isset( $_POST[$value['link']][$item_content_num['slider-item']] )? htmlspecialchars($_POST[$value['link']][$item_content_num['slider-item']]) : '';
								$item_xml = $item_xml . create_xml_tag('link', $temp);
								$temp = isset( $_POST[$value['caption']][$item_content_num['slider-item']] )? htmlspecialchars($_POST[$value['caption']][$item_content_num['slider-item']]) : '';
								$item_xml = $item_xml . create_xml_tag('caption', $temp);
								$item_xml = $item_xml . '</slider>';
								$item_content_num['slider-item']++; 
								
							}
							
							$item_xml = $item_xml . '</' . $key . '>';
							
						}else if($key == "tab-item"){
							
							$item_xml = $item_xml . '<' . $key . '>';
							
							if($item_type_new == "Accordion"){
								$tab_type = 'accordion-item';
							}else if($item_type_new == "Toggle-Box"){
								$tab_type = 'toggle-box-item';
							}else{
								$tab_type = 'tab-item';
							}

							$tab_num = $_POST[$value['tab-num']][$item_content_num[$item_type_new]];
							
							for($j=0; $j<$tab_num; $j++){
								$item_xml = $item_xml . '<tab>';
								$temp = isset( $_POST[$value['title']][$item_content_num[$tab_type]] )? htmlspecialchars($_POST[$value['title']][$item_content_num[$tab_type]]) : '';
								$item_xml = $item_xml . create_xml_tag('title', $temp);
								$temp = isset( $_POST[$value['caption']][$item_content_num[$tab_type]] )? htmlspecialchars($_POST[$value['caption']][$item_content_num[$tab_type]]) : '';
								$item_xml = $item_xml . create_xml_tag('caption', $temp);
								$temp = isset( $_POST[$value['active']][$item_content_num[$tab_type]] )? $_POST[$value['active']][$item_content_num[$tab_type]] : '';
								$item_xml = $item_xml . create_xml_tag('active', $temp);
								$item_xml = $item_xml . '</tab>';
								$item_content_num[$tab_type]++;
							}
							
							$item_xml = $item_xml . '</' . $key . '>';
							
						}else{
						
							if(isset($_POST[$value['name']][$item_content_num[$item_type_new]])){
							
								$item_value = htmlspecialchars($_POST[$value['name']][$item_content_num[$item_type_new]]);
								$item_xml = $item_xml .  create_xml_tag($key, $item_value);
							
							}else{
							
								$item_xml = $item_xml .  create_xml_tag($key, '');
								
							}

						}
						
					}
					
					$item_xml = $item_xml . '</' . $item_type_new . '>';
					$item_content_num[$item_type_new]++;
					
				}
				
				$item_xml = $item_xml . '</item-tag>';
				$item_xml_old = get_post_meta($post_id, $edit_meta_box['xml'], true);
				save_meta_data($post_id, $item_xml, $item_xml_old, $edit_meta_box['xml']);
				
			}else if( $edit_meta_box['type'] == 'imagepicker' ){
				
				if(isset($_POST[$edit_meta_box['name']['image']])){
				
					$num = sizeof($_POST[$edit_meta_box['name']['image']]) - 1;
					
				}else{
				
					$num = -1;
					
				}
				
				$slider_xml_old = get_post_meta($post_id,$edit_meta_box['xml'],true);
				$slider_xml = "<slider-item>";
				
				for($i=0; $i<=$num; $i++){
				
					$slider_xml = $slider_xml. "<slider>";
					$image_new = stripslashes($_POST[$edit_meta_box['name']['image']][$i]);
					$slider_xml = $slider_xml. create_xml_tag('image',$image_new);
					$title_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['title']][$i]));
					$slider_xml = $slider_xml. create_xml_tag('title',$title_new);
					$caption_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['caption']][$i]));
					$slider_xml = $slider_xml. create_xml_tag('caption',$caption_new);
					$linktype_new = stripslashes($_POST[$edit_meta_box['name']['linktype']][$i]);
					$slider_xml = $slider_xml. create_xml_tag('linktype',$linktype_new);
					$link_new = stripslashes(htmlspecialchars($_POST[$edit_meta_box['name']['link']][$i]));
					$slider_xml = $slider_xml. create_xml_tag('link',$link_new);
					$slider_xml = $slider_xml . "</slider>";
					
				}
				
				$slider_xml = $slider_xml . "</slider-item>";
				save_meta_data($post_id, $slider_xml, $slider_xml_old, $edit_meta_box['xml']);
					
			}else{
			
				if(isset($_POST[$edit_meta_box['name']])){
				
					$new_data = stripslashes($_POST[$edit_meta_box['name']]);
					
				}else{
				
					$new_data = '';
					
				}
				
				$old_data = get_post_meta($post_id, $edit_meta_box['name'],true);
				save_meta_data($post_id, $new_data, $old_data, $edit_meta_box['name']);				
			}
		}
	}
	
	
	// print all elements that can be added to selected elements
	function print_page_default_elements($args){
	
		extract($args);
		
		?>	

			<div class="meta-body">
				<div class="meta-title">
					<label><?php _e('ADD ITEMS', 'gdl_back_office'); ?></label>
				</div>
				<!-- Select Item List -->
				<div class="meta-input">
					<div class="page-select-element-list-wrapper combobox">
						<select id="page-select-element-list">
							<option> Please select item </option>
							
							<?php
							
								foreach( $name as $key => $value ){
							
									echo '<option>' . $key . '</option>';
							
								}
								
							?>
							
						</select>
					</div>
					<input type="button" id="page-add-item-button" class="page-add-item-button" value="Add item" />
					<br class="clear">
				</div>
				<br class="clear">
			</div>
			<!-- Default Item to Clone to-->
			<div class="page-element-lists" id="page-element-lists">
			
				<?php
				
					foreach( $name as $key => $value ){
					
						print_page_elements($args, '', $key);
					
					}
					
				?>
				
				<br class="clear">
			</div>
		<?php
	}
	
	// chosen elements
	function print_page_selected_elements($args){
	
		extract($args);
		
		?>	
		
			<div class="page-methodology" id="page-methodology">
				<div class="page-selected-elements-wrapper">
					<div class="page-selected-elements page-no-sidebar" id="page-selected-elements">
					
					<?php
					
						if($value != ''){
						
							$xml = new DOMDocument();
							$xml->loadXML($value);
							
							foreach($xml->documentElement->childNodes as $item){
							
								print_page_elements($args, $item, $item->nodeName);
								
							}
							
						}
						
					?>
					
					</div>
					<br class="clear">
				</div>
			</div>
			
		<?php
		
	}
	
	// function that manage to print each elements from receiving arguments
	function print_page_elements($args, $xml_val, $item_type){
		
		extract($args);
		$head_type = $item_type;
		
		if(empty($xml_val)){
		
			$head_size = '';
			$head_name = array('item'=>$item,'size'=>$size,'itemname'=>'','sizename'=>'');
		
		}else{
		
			$head_size = find_xml_value($xml_val, 'size');
			$head_name = array('item'=>$item,'size'=>$size,'itemname'=>$item.'[]','sizename'=>$size.'[]');
		
		}
		
		print_page_item_identical($head_name, $head_size, $head_type);
		
		?>
			
			<div class="page-element-edit-box" id="page-element-edit-box">
			
			<?php
				
				foreach( $name[$item_type] as $input_key => $input_value ){
				
					if( $input_key == 'slider-item' ){
					
						$slider_value = find_xml_node($xml_val, 'slider-item');
						print_image_picker( array('name'=>$input_value, 'value'=>$slider_value ) );
					
					}else if( $input_key == 'tab-item' ){

						print_box_tab($input_value, find_xml_node($xml_val, 'tab-item'));
					
					}else{
					
						$input_value['value'] = find_xml_value($xml_val, $input_key);
						$input_value['name'] = $input_value['name'] . '[]';
						print_meta( $input_value );
						
					}
					
					if( ( $input_key!= 'open' && $input_key != 'close') ){
					
						echo ( empty($input_value['hr']) )? '<hr class="separator mt20">': '';
					
					}
				}

			?>
			
			</div>
		</div>
		
		<?php
		
	}
	
	// print the identical part of Page Item 
	function print_page_item_identical($item, $size, $text){
	
		global $div_size;
		
		if(empty( $size )) { 
			
			foreach( $div_size[$text] as $key => $val ){
			
				$size = $key; 
				break;
				
			}
			
		} 
						
		?>	
		
			<div class="page-element <?php echo $size; ?>" id="page-element" rel="<?php echo $text; ?>">
				<div class="page-element-item" id="page-element-item" > 
					<div class="item-bar-left">
						<div class="change-element-size-temp">
							<div class="add-element-size" id="add-element-size" ></div>
							<div class="sub-element-size" id="sub-element-size" ></div>
						</div>
					</div>
					<span class="page-element-item-text"> <?php echo $text; ?> </span>
					<input type="hidden" id="<?php echo $item['item'];?>" class="<?php echo $item['item'];?>" value="<?php echo $text; ?>" name="<?php echo $item['itemname'];?>">
					<input type="hidden" id="<?php echo $item['size'];?>" class="<?php echo $item['size'];?>" value="<?php echo $size; ?>" name="<?php echo $item['sizename'];?>">
					<div class="item-bar-right">
						<div class="element-size-text" id="element-size-text"><?php echo $div_size[$text][$size]; ?></div>
						<div class="change-element-property">
						<a title="Edit"><div rel="gdl-edit-box" id="page-element-edit-box" class="edit-element"></div></a>
						<a title="Delete"><div class="delete-element" id="delete-element"></div></a>
						</div>
					</div>
				</div>
				
		<?php
		
	}
	
	//Print exceptional input element ( from meta-template )
	function print_box_tab($name, $values){
	
		?>
		
		<div class="meta-body">
			<div class="meta-title meta-tab">ADD MORE TABS</div>
			<div id="page-tab-add-more" class="page-tab-add-more" /></div>
			<br class="clear">
			<div class="meta-input">
				<input type='hidden' class="tab-num" id="tab-num" name='<?php echo $name['tab-num']; ?>[]' value=<?php 
					
					echo empty($values)? 0: $values->childNodes->length;

				?> />
				<div class="added-tab" id="added-tab">
					<ul>
						<li id="page-item-tab" class="default">	
							<div class="meta-title meta-tab-title">TABS TITLE</div><input type="text"  id='<?php echo $name['title']; ?>' /> <br>
							<div class="meta-title meta-tab-title">TABS TEXT</div><textarea id='<?php echo $name['caption']; ?>' ></textarea> <br>
							<?php if(!empty($name['active'])){ ?>
								<div class="meta-title meta-tab-title">Tabs Active</div>
								<div class="combobox">
									<select id='<?php echo $name['active']; ?>' >
										<option>Yes</option>
										<option selected>No</option>	
									</select>
								</div>
							<?php } ?>
							<div id="unpick-tab" class="unpick-tab"></div>
						</li>
						
						<?php
							
							if(!empty($values)){
							
								foreach ($values->childNodes as $tab){ 
								
							?>
								<li id="page-item-tab" class="page-item-tab">	
									<div class="meta-title meta-tab-title">TABS TITLE</div><input type="text" name='<?php echo $name['title']; ?>[]' id='<?php echo $name['title']; ?>' value="<?php echo find_xml_value($tab, 'title'); ?>" /> <br>
									<div class="meta-title meta-tab-title">TABS TEXT</div><textarea name='<?php echo $name['caption']; ?>[]' id='<?php echo $name['caption']; ?>' ><?php echo find_xml_value($tab, 'caption'); ?></textarea> <br>
									<div id="unpick-tab" class="unpick-tab"></div>
									<?php if(!empty($name['active'])){ ?>
										<?php $is_active = find_xml_value($tab, 'active'); ?>
										<div class="meta-title meta-tab-title">Tabs Active</div>
										<div class="combobox">
											<select id='<?php echo $name['active']; ?>' name='<?php echo $name['active']; ?>[]' >
												<option <?php if($is_active=='Yes'){ echo 'selected'; } ?>>Yes</option>
												<option <?php if($is_active!='Yes'){ echo 'selected'; } ?>>No</option>	
											</select>
										</div>
									<?php } ?>
								</li>			
							<?php
							
								}
								
							}
							
						?>
					</ul>
					<br class=clear>
				</div>
			</div>
			<br class=clear>
		</div>
		<?php
	}
?>