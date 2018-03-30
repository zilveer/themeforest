<?php 



	/*	

	*	CrunchPress Page Option File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		CrunchPress
	* 	@package    Arche
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) CrunchPress
	*	---------------------------------------------------------------------
	*	This file create and contains the page post_type meta elements
	*	---------------------------------------------------------------------
	*/

	// a type that each element can be ( also set in page-dragging.js )

	
 $div_size = array(
	     'Slider' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
		'Blog' => array(
			'element1-1'=>'1/1'),
			
		'Latest-Videos' => array(
			'element1-1'=>'2/3'),
	    'Category-Videos' => array(
			'element1-1'=>'2/3'),
		'Featured-Videos' => array(
			'element1-1'=>'2/3'),
		'Top-Video' => array(
			'element1-1'=>'1/1'),
		'Search-Widget' => array(
			'element1-1'=>'1/4'),		
		'Social-Media-Widget' => array(
			'element1-1'=>'1/4'),
		'Videos-Tab-Widget' => array(
			'element1-1'=>'1/4'),
		'Twitter-Widget' => array(
			'element1-1'=>'1/1'),	
		
	    'Portfolio' => array(
			'element1-1'=>'1/1'),
		 'Testimonial' => array(
			'element1-4'=>'1/4'),
	     /*'Text-Widget' => array(
			'element1-1'=>'1/1'),*/
	    /*'Price-Item' => array(
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),	*/
		'Contact-Form' => array(
			'element1-1'=>'1/1'),
		'Content' => array(
			'element1-2'=>'1/2',
			'element1-1'=>'1/1'),
		'Column' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
		'Divider' => array(
			'element1-1'=>'1/1'),
		'Row-Start' => array(
			'element1-1'=>'1/1'),
		'Row-End' => array(
			'element1-1'=>'1/1'),
        'Message-Box' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
		'Tab' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
		/*'Toggle-Box' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),*/
         'Accordion' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),
			
		'Gallery' => array(
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
				'Blog'=>array(
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-blog-header-title',
						'type'=> 'inputtext'),			
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
						'default'=> 285,
						'description'=>'This is the number of thumbnail content character.'),
					'show-full-blog-post'=>array(					
						'title'=> 'SHOW FULL BLOG CONTENT',
						'name'=> 'page-option-item-show-full-blog',
						'type'=> 'combobox',
						'options'=> array('No','Yes'),
						'description'=>'Select this to yes will fetch the full posts to show ( only use for the 1/1 full thumbnail blog size. ).'),						
					'pagination'=>array(
						'title'=>'ENABLE PAGINATION',
						'name'=>'page-option-item-blog-pagination',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'hr'=> 'none',
						'description'=>'Pagination will only appear when the number of blog post is greater than the number of fetched item in one page.'),
				),
				
		// Video Options Start from here		
		'Latest-Videos' => array(
		'latest-video-header'=>array(
						'title'=> __('HEADER TITLE', 'crunchpress'),
						'name'=> 'page-option-item-latest-video-header',
						'default'=> 'Latest Video',
						'type'=> 'inputtext'),
		'latest-video-fetch'=>array(
						'title'=> __('NUMBERS OF VIDEO TO FETCH', 'crunchpress'),
						'name'=> 'page-option-item-latest-video-fetch',
						'default'=> '6',
						'type'=> 'inputtext'),
		'latest-video-cat'=>array(
						'title'=>'CHOOSE CATEGORY',
						'name'=>'page-option-item-latest-video-cat',
						'options'=>array(),
						'type'=>'combobox',
						'description'=>'Choose the post category you want to fetch the post.'),
		),
	    'Category-Videos' => array(
		'category-video-header-title'=>array(
						'title'=> __('HEADER TITLE', 'crunchpress'),
						'name'=> 'page-option-item-category-video-header-title',
						'default'=> 'Category Video',
						'type'=> 'inputtext'),
		'category-video-cat'=>array(
						'title'=>'CHOOSE CATEGORY',
						'name'=>'page-option-item-category-video-cat',
						'options'=>array(),
						'type'=>'combobox',
						'description'=>'Choose the post category you want to fetch the post.'),
		'category-video-fetch'=>array(
						'title'=> __('NUMBERS OF VIDEO TO FETCH', 'crunchpress'),
						'name'=> 'page-option-item-category-video-fetch',
						'default'=> '6',
						'description'=>'Choose Numbers of Post Dispaly in Slider.',
						'type'=> 'inputtext'),
		'category-video-cat-1'=>array(
						'title'=>'CHOOSE CATEGORY 1',
						'name'=>'page-option-item-category-video-cat-1',
						'options'=>array(),
						'type'=>'combobox',
						'description'=>'Choose the post category you want to fetch the post.'),
		'category-video-cat-2'=>array(
						'title'=>'CHOOSE CATEGORY 2',
						'name'=>'page-option-item-category-video-cat-2',
						'options'=>array(),
						'type'=>'combobox',
						'description'=>'Choose the post category you want to fetch the post.'),
		'category-video-cat-3'=>array(
						'title'=>'CHOOSE CATEGORY 3',
						'name'=>'page-option-item-category-video-cat-3',
						'options'=>array(),
						'type'=>'combobox',
						'description'=>'Choose the post category you want to fetch the post.'),
		'category-video-cat-list-fetch'=>array(
						'title'=> __('NUMBERS OF VIDEO TO FETCH FOR LISTS', 'crunchpress'),
						'name'=> 'page-option-item-cat-list-fetch',
						'default'=> '3',
						'description'=>'Choose Numbers of Post Dispaly in Lists.',
						'type'=> 'inputtext'),				
		
		),
						
		'Featured-Videos' => array(
	    'featured-video-header'=>array(
						'title'=> __('HEADER TITLE', 'crunchpress'),
						'name'=> 'page-option-item-featured-video-header',
						'default'=> 'Latest Video',
						'type'=> 'inputtext'),
		'Featured-Videos-style'=>array(					
						'title'=> 'SHOW FULL BLOG CONTENT',
						'name'=> 'page-option-item-featured-videos-style',
						'type'=> 'combobox',
						'options'=> array('Slider','Widget'),
						'description'=>'Select style of featured views. Display featured videos as slider or as widget..'),					
		'featured-video-cat'=>array(
						'title'=>'CHOOSE VIDEO CATEGORY',
						'name'=>'page-option-item-featured-video-cat',
						'options'=>array(),
						'type'=>'combobox',
						'description'=>'Choose the post category you want to fetch the post.'),	
		'featured-video-fetch'=>array(
						'title'=> __('NUMBERS OF VIDEO TO FETCH', 'crunchpress'),
						'name'=> 'page-option-item-featured-video-fetch',
						'default'=> '5',
						'description'=>'Choose Numbers of Post Dispaly in Slider.',
						'type'=> 'inputtext'),
		),
		'Top-Video' => array(
		'top-video-header-title'=>array(
						'title'=> __('HEADER TITLE', 'crunchpress'),
						'name'=> 'page-option-item-top-video-header-title',
						'default'=> 'Top Video',
						'type'=> 'inputtext'),
		'top-video-name'=>array(
						'title'=>'CHOOSE TOP VIDEO',
						'name'=>'page-option-item-top-video-name',
						'options'=>array(),
						'type'=>'combobox',
						'description'=>'Choose the post category you want to fetch the post.'),					
		),
		'Search-Widget' => array(
		 'search-widget-header-title'=>array(
						'title'=> __('HEADER TITLE', 'crunchpress'),
						'name'=> 'page-option-item-search-widget-header-title',
						'default'=> 'Search',
						'type'=> 'inputtext'),
		),
		'Social-Media-Widget' => array(
	    'social-media-header-title'=>array(
						'title'=> __('HEADER TITLE', 'crunchpress'),
						'name'=> 'page-option-item-social-media-header-title',
						'default'=> 'Stay Connected',
						'type'=> 'inputtext'),
		'social-media-facebook'=>array(
						'title'=> __('FACEBOOK', 'crunchpress'),
						'name'=> 'page-option-item-social-media-facebook',
						'description'=>	'Enter Social Media Profile Link here.',
						'type'=> 'inputtext'),
		'social-media-youtube'=>array(
						'title'=> __('YOUTUBE', 'crunchpress'),
						'name'=> 'page-option-item-social-media-youtube',
						'description'=>	'Enter Social Media Profile Link here.',
						'type'=> 'inputtext'),	
		'social-media-twitter'=>array(
						'title'=> __('TWITTER', 'crunchpress'),
						'name'=> 'page-option-item-social-media-twitter',
						'description'=>	'Enter Social Media Profile Link here.',
						'type'=> 'inputtext'),	
		'social-media-pinterest'=>array(
						'title'=> __('PINTREST', 'crunchpress'),
						'name'=> 'page-option-item-social-media-pintrest',
						'description'=>	'Enter Social Media Profile Link here.',
						'type'=> 'inputtext'),	
		'social-media-rss'=>array(
						'title'=> __('RSS', 'crunchpress'),
						'name'=> 'page-option-item-social-media-rss',
						'description'=>	'Enter RSS feed Link here.',
						'type'=> 'inputtext'),
		'social-media-google-plus'=>array(
						'title'=> __('GOOGLE PLUS', 'crunchpress'),
						'name'=> 'page-option-item-social-media-googeplus',
						'description'=>	'Enter Social Media Profile Link here.',
						'type'=> 'inputtext'),									
		),
		
		'Videos-Tab-Widget' => array(
			'vidoes-tab-limit'=>array(
						'title'=> __('NUMBERS Of POST TO DISPLAY', 'crunchpress'),
						'name'=> 'page-option-item-vidoes-tab-limit',
						'default'=> '4',
						'type'=> 'inputtext'),),				
		
						
		'Twitter-Widget' => array(
			'header'=>array(
						'title'=> __('HEADER TITLE', 'crunchpress'),
						'name'=> 'page-option-item-twitter-widget-header-title',
						'type'=> 'inputtext'),),	
			
			
				'Accordion' =>array(
					'header'=>array(
						'title'=> __('HEADER TITLE', 'crunchpress'),
						'name'=> 'page-option-item-accordion-header-title',
						'type'=> 'inputtext'),
					'tab-item'=>array(
						'tab-num'=>'page-option-item-accordion-num',
						'title'=>'page-option-item-accordion-title',
						'caption'=>'page-option-item-accordion-content',
						'active'=>'',
						'hr'=>'none')

				),

				'Contact-Form'=>array(
					'email'=>array(
						'title'=>'E-MAIL',
						'name'=>'page-option-item-contat-email',
						'type'=>'inputtext',
						'hr'=>'none',
						'description'=>'Place the destination of the email when user submit the contact form here.')
				),

				
      		'Column'=>array(
					'column-text'=>array(
						'title'=> 'Column Text',
						'name'=> 'page-option-item-column-text',
						'type'=> 'textarea',
						'hr'=> 'none')
				),
				
				/*'Price-Item'=>array(
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
				*/
				
               
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
	           'Gallery' =>array(
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-gallery-header-title',
						'type'=> 'inputtext'),
					'subheader'=>array(
						'title'=> 'SUB HEADING',
						'name'=> 'page-option-item-gallery-subheader-title',
						'type'=> 'inputtext'),	
					'item-size'=>array(
						'title'=> 'ELEMENT SIZE',
						'name'=> 'page-option-item-gallery-item-size',
						'type'=> 'combobox',
						'options'=> array('1/4', '1/3', '1/2')
					),
					
					'gallery'=>array(
						'title'=>'CHOOSE A Gallery',
						'name'=>'page-option-item-gallery',
						'options'=>array(),
						'type'=>'combobox',
						'description'=>'Choose the post category you want to fetch the post.'),		
				),
				'Divider' =>array(
					'text'=>array(
						'title'=> 'DIVIDER',
						'name'=> 'page-option-item-divider-text',
						'type'=> 'description',
						'hr'=> 'none',
						'description'=> "Add Divider in page"),				
				),
				
				'Row-Start' =>array(
					'text'=>array(
						'title'=> 'Row Start',
						'name'=> 'page-option-item-row-start',
						'type'=> 'description',
						'hr'=> 'none',
						'description'=> "Row Fluid Start"),				
				),
				
				'Row-End' =>array(
					'text'=>array(
						'title'=> 'Row End',
						'name'=> 'page-option-item-row-end',
						'type'=> 'description',
						'hr'=> 'none',
						'description'=> "Row Fluid End"),				
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
				
			     'Portfolio'=>array(
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-portfolio-header-title',
						'type'=> 'inputtext'),
					'subheader'=>array(
						'title'=> 'SUB HEADER TITLE',
						'name'=> 'page-option-item-portfolio-subheader-title',
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
					/*'show-title'=>array(
						'title'=>'SHOW TITLE',
						'name'=>'page-option-item-portfolio-show-header',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'description'=>'Disable this option to hide the portfolio thumbnail title.'),
					'view-all-portfolio'=>array(
						'title'=>'SHOW VIEW ALL PORTFOLIO',
						'name'=>'page-option-item-portfolio-view-all-project',
						'type'=> 'combobox',
						'options'=>array('0'=>'No'),
						'description'=>'Choose the page you want "view all project" to link to. It will only appear when you have "header title" setted. You can see it at the homepage of our demo site.'),
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
						'default'=> 100,
						'description'=>'Set the portfolio thumbnail content character length.'),
					'read-more'=>array(
						'title'=>'SHOW READ MORE BUTTON',
						'name'=> 'page-option-item-portfolio-read-more',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'description'=>'Show the read more button below the content.'),
					'visit-website'=>array(
						'title'=>'SHOW VISIT WEBSITE BUTTON',
						'name'=> 'page-option-item-portfolio-visit-website',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'description'=>'Show the visit website button if the website url field in portfolio options it not empty.'),*/
					'pagination'=>array(
						'title'=>'ENABLE PAGINATION',
						'name'=>'page-option-item-portfolio-pagination',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'hr'=> 'none',
						'description'=>'Pagination will only appear when the number of selected page is greater than the number of fetched item in one page.'),
				),
				
				
				'Slider' =>array(
					'slider-type'=>array(
						'title'=>'SLIDER TYPE',
						'name'=>'page-option-item-slider-type',
						'options'=>array(/*'0'=>'Nivo Slider', */'1'=>'Flex Slider'),
						'type'=>'combobox',
						'hr'=>'none',
					    ),
					'width'=>array(
						'title'=>'SLIDER WIDTH',
						'name'=>'page-option-item-slider-width',
						'type'=>'inputtext',
						'default'=>'940',
						'hr'=>'none'),
					'height'=>array(
						'title'=>'SLIDER HEIGHT',
						'name'=>'page-option-item-slider-height',

						'type'=>'inputtext',
						'default'=>'360',
						'hr'=>'none'),
					'slider-item'=>array(
						'slider-num'=>'page-option-item-slider-num',
						'image'=>'page-option-item-slider-image',
						'title'=>'page-option-item-slider-title',
						'link'=>'page-option-item-slider-link',
						'caption'=>'page-optin-item-slider-caption',
						'linktype'=>'page-option-item-slider-linktype',
						'hr'=>'none')
				),
				/*'Text-Widget'=>array(
					'title'=>array(
						'title'=> 'TITLE',
						'name'=> 'page-option-item-text-widget-title',
						'type'=> 'inputtext'),
					'caption'=>array(
						'title'=> 'CAPTION',
						'name'=> 'page-option-item-text-widget-caption',
						'type'=> 'textarea'),
					'button-title'=>array(
						'title'=> 'BUTTON TITLE',
						'name'=> 'page-option-item-text-widget-button-title',
						'type'=> 'inputtext',
						'description'=> 'The text widget button will appear if this field is not a blank.'),
					'button-link'=>array(
						'title'=> 'BUTTON LINK',
						'name'=> 'page-option-item-text-widget-button-link',
						'type'=> 'inputtext',
						'description'=> 'This is a text widget button link url. This field will be ignored when button title equals to blank.'),
					'button-top-margin'=>array(
						'title'=> 'BUTTON TOP MARGIN',
						'name'=> 'page-option-item-text-widget-button-top-margin',
						'type'=> 'inputtext',
						'default'=> '15',
						'hr'=> 'none',
						'description'=> 'This is the space over the text widget. You can change it based on the text widget content.'),
				),	*/
				
				'Tab' =>array(
				     'tab-widget'=>array(
						'title'=> __('Tab Widget Title', 'crunchpress'),
						'name'=> 'page-option-item-tab-widget',
						'type'=> 'inputtext'),
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
					/*'display-type'=>array(
						'title'=>'CHOOSE THE DISPLAY TYPE',
						'name'=>'page-option-item-testimonial-display-type',
						'options'=>array('0'=>'Testimonial Category', '1'=>'Specific Testimonial'),
						'type'=>'combobox'),*/
					'category'=>array(
						'title'=>'CHOOSE CATEGORY',
						'name'=>'page-option-item-testimonial-category',
						'options'=>array(),
						'type'=>'combobox',
						'hr'=>'none',
						'description'=>'Choose the category you want testimonial to be fetched. This theme will display testimonail using the jquery carousel.'),
					/*'specific'=>array(
						'title'=>'SPECIFIC TESTIMONIAL',
						'name'=>'page-option-item-testimonial-specific',
						'options'=>array(),
						'type'=>'combobox',
						'hr'=>'none',
						'description' => 'If you choose Specific Testimonial option, it will ignores the testimonial size above and' . 
							' use the wrapper size ( outside ) instead.'),	*/		
				),

              
			 
				/*'Toggle-Box' =>array(
					'header'=>array(
						'title'=> __('HEADER TITLE', 'crunchpress'),
						'name'=> 'page-option-item-toggle-box-header-title',
						'type'=> 'inputtext'),
					'tab-item'=>array(
						'tab-num'=>'page-option-item-toggle-box-num',
						'title'=>'page-option-item-toggle-box-title',
						'caption'=>'page-option-item-toggle-box-content',
						'active'=>'page-option-item-toggle-box-active',
						'hr'=>'none')

				),*/
				
			)

		),

		
		"Page Sidebar Template" => array(
			'title'=> __('SELECT LAYOUT', 'crunchpress'), 
			'name'=>'page-option-sidebar-template', 
			'type'=>'radioimage', 
			'default'=>'no-sidebar',
			'hr'=>'none',
			'options'=>array(
				'1'=>array('value'=>'right-sidebar','image'=>'/framework/assets/images/right-sidebar.png'),
				'2'=>array('value'=>'left-sidebar','image'=>'/framework/assets/images/left-sidebar.png'),
				/*'3'=>array('value'=>'both-sidebar','image'=>'/framework/assets/images/both-sidebar.png'),*/
				'4'=>array('value'=>'no-sidebar','image'=>'/framework/assets/images/no-sidebar.png','default'=>'selected')
			)
		),


		"Choose Left Sidebar" => array(
			'title'=> __('CHOOSE LEFT SIDEBAR', 'crunchpress'),
			'name'=>'page-option-choose-left-sidebar',
			'type'=>'combobox',
			'hr'=>'none'
		),		

		"Choose Right Sidebar" => array(
			'title'=> __('CHOOSE RIGHT SIDEBAR', 'crunchpress'),
			'name'=>'page-option-choose-right-sidebar',
			'type'=>'combobox',
		),


		"Page Title" => array(
			'type'=>'combobox',
			'name'=>'page-option-show-title',
			'options'=> array('Yes', 'No'),
			'default'=> 'Yes',
			'title'=> __('SHOW PAGE TITLE', 'crunchpress'),
			'description' => 'Show Page title at the top of the page( below the main navigation menu and top slider ).'
		),	
       
	   "Page Content" => array(
			'type'=>'combobox',
			'name'=>'page-option-show-content',
			'options'=> array('Yes', 'No'),
			'default'=> 'Yes',
			'title'=> __('SHOW PAGE CONTENT', 'crunchpress'),
		),	
		
       "Top Slider Type" => array(
		'title'=> __('TOP SLIDER TYPE', 'crunchpress'),
			'name'=>'page-option-top-slider-types',
			'options'=>array('0'=>'No Slider', /*'1'=>'Nivo Slider', '2'=>'Flex Slider',*/'3'=>'Layer Slider', '4'=>'Video Slider'),
			'type'=>'combobox',
			'hr'=>'none',
			'description' => 'Top slider is the slider under the main navigation menu and above the page template( so it will always be full width ).'
		),

        
		"Vidoe Slider Open" => array( 'type'=>'open', 'id'=>'video-slider-wrapper'),
		  "video-slider-fetch" => array(
			'title'=> __('ITEM FETCH', 'crunchpress'),
			'name'=>'page-option-video-slider-fetch',
			'type'=>'inputtext',
			'default'=> '5',
			'hr'=>'none',
			'description'=>'Set Numbers of Slides to Fetch.'
         ),			
		"vidoe-slider-type" => array(
		    'title'=> __('VIDEO SLIDER TYPE', 'crunchpress'),
			'name'=>'page-option-video-slider-type',
			'options'=>array('0'=>'Full Slider', '1'=>'Half Slider'),
			'type'=>'combobox',
			'hr'=>'none',
			'description' => 'Set Your Desired Slider Style.'
		),
		
		'video-slider-category'=>array(
						'title'=>'CHOOSE CATEGORY',
						'name'=>'page-option-item-video-slider-category',
						'options'=>array(),
						'type'=>'combobox',
						'description'=>'Choose the post category you want to fetch the post.'),
						
		"Vidoe Slider Close" => array( 'type'=>'close' , 'hr'=>'none',),
		
		  
	    "Layer Slider Open" => array( 'type'=>'open', 'id'=>'cp-layer-slider-wrapper'),
		"Layer Slider ID" => array(
			'title'=> __('LAYER SLIDER ID', 'crunchpress'),
			'name'=>'page-option-layer-slider-id',
			'type'=>'inputtext',
			'default'=> '1',
			'hr'=>'none',
			'description'=>'You have to create the layer slider ( by installing the plugin we provided within the zip file you downloaded from theme forest. )' .
						   ' and follows the instruction on the slider documentation before inputting this. <br><br><strong> Only Integer Number is allowed in this field</strong>.'

		),			
		
		"Layer Slider Close" => array( 'type'=>'close' , 'hr'=>'none',),
		"Top Slider Open" => array( 'type'=>'open', 'id'=>'cp-top-slider-wrapper', 'hr'=>'none'),
		"Top Slider Height" => array(
			'title'=> __('TOP SLIDER HEIGHT', 'crunchpress'),
			'name'=>'page-option-top-slider-height',
			'type'=>'inputtext',
			'default'=> '360',
			'hr'=>'none'
		),		

		"Top Slider" => array(
			'type'=>'imagepicker',
			'title'=> __('SELECT IMAGES', 'crunchpress'),
			'xml'=>'page-option-top-slider-xml',
			'hr'=>'none',
			'name'=>array(
				'image'=>'page-option-top-slider-image',
				'title'=>'page-option-top-slider-title',
				'caption'=>'page-option-top-slider-caption',
				'link'=>'page-option-top-slider-link',
				'linktype'=>'page-option-top-slider-linktype'),
		),
		

		"Top Slider Close" => array( 'type'=>'close','hr'=>'none' )

	);


	// create Page Option Meta

	add_action('add_meta_boxes', 'add_page_option');
	function add_page_option(){

		add_meta_box('page-option', __('Page Option','crunchpress'), 'add_page_option_element',
			'page', 'normal', 'high');

	}

	function add_page_option_element(){	

		global $post, $page_meta_boxes;

		//init array
         
		/*$page_meta_boxes['Page Item']['name']['Featured-Author']['featured-book']['options'] = get_title_list( 'product' );*/
		$page_meta_boxes['Page Item']['name']['Blog']['category']['options'] = get_category_list( 'category' );
		$page_meta_boxes['Page Item']['name']['Latest-Videos']['latest-video-cat']['options'] = get_category_list( 'category' );
		$page_meta_boxes['Page Item']['name']['Category-Videos']['category-video-cat']['options'] = get_category_list( 'category' );
		$page_meta_boxes['Page Item']['name']['Category-Videos']['category-video-cat-1']['options'] = get_category_list( 'category' );
		$page_meta_boxes['Page Item']['name']['Category-Videos']['category-video-cat-2']['options'] = get_category_list( 'category' );
		$page_meta_boxes['Page Item']['name']['Category-Videos']['category-video-cat-3']['options'] = get_category_list( 'category' );
		$page_meta_boxes['Page Item']['name']['Featured-Videos']['featured-video-cat']['options'] = get_category_list( 'category' );
		$page_meta_boxes['video-slider-category']['options'] = get_category_list( 'category' );
		$page_meta_boxes['Page Item']['name']['Top-Video']['top-video-name']['options'] = get_title_list( 'post' );
		
		/*$page_meta_boxes['Page Item']['name']['Blog-Slider']['category-blog']['options'] = get_category_list( 'category' );	*/	
		$page_meta_boxes['Page Item']['name']['Portfolio']['category']['options'] = get_category_list( 'portfolio-category' );
       /* $page_meta_boxes['Page Item']['name']['Featured-Product']['featured-category']['options'] = get_category_list( 'product_cat' );
		$page_meta_boxes['Page Item']['name']['Portfolio']['view-all-portfolio']['options'] = array_merge(array('No'), get_title_list( 'page' ));
	/*	$page_meta_boxes['Page Item']['name']['Price-Item']['category']['options'] = get_category_list( 'price-table-category' );*/
		$page_meta_boxes['Page Item']['name']['Testimonial']['category']['options'] = get_category_list( 'testimonial-category' );
		$page_meta_boxes['Page Item']['name']['Portfolio']['testi-category']['options'] = get_category_list( 'testimonial-category' );
		$page_meta_boxes['Page Item']['name']['Testimonial']['specific']['options'] = get_title_list( 'testimonial' );
		$page_meta_boxes['Page Item']['name']['Gallery']['gallery']['options'] = get_title_list( 'gallery' );	
		$page_meta_boxes['Choose Left Sidebar']['options'] = get_sidebar_name();
		$page_meta_boxes['Choose Right Sidebar']['options'] = $page_meta_boxes['Choose Left Sidebar']['options'];
		
		echo '<div id="cp-overlay-wrapper">';
		echo '<div id="cp-overlay-content">';

		set_nonce();

		//get value

		foreach( $page_meta_boxes as $page_meta_box ){
			if( $page_meta_box['type'] == 'page-option-item' ){
				$page_meta_box['value'] = get_post_meta($post->ID, $page_meta_box['xml'], true);
				print_page_default_elements($page_meta_box);
				print_page_selected_elements($page_meta_box);
			}
			elseif( $page_meta_box['type'] == 'sidebar' ){ echo 'ok'; die;
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

				
				if( empty( $page_meta_box['name'] ) ){ $page_meta_box['name'] = ''; }
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
			}else if($edit_meta_box['type'] == 'open' || $edit_meta_box['type'] == 'close'){
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
    <label>
      <?php _e('ADD ELEMENTS', 'crunchpress'); ?>
    </label>
  </div>
  
  <!-- Select Item List -->
  
  <div class="meta-input">
    <div class="page-select-element-list-wrapper combobox">
      <select id="page-select-element-list">
        <option> Please select element </option>
        <?php

								foreach( $name as $key => $value ){

									echo '<option>' . $key . '</option>';

								}

							?>
      </select>
    </div>
    <input type="button" id="page-add-item-button" class="page-add-item-button" value="Add" />
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
		//echo "<pre>";print_r($name['Widget']);
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
				      }else if( $input_key == 'haji-item' ){
							   print_panel_sidebar('lol',$input_value);
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
      <?php if( 
	 $text == 'Timeline'
	 || $text == 'Portfolio'
	 || $text == 'Team-Widget'
	 || $text == 'Portfolio'
	/* || $text == 'Testimonial'*/
	 || $text == 'Team-Block' 
	 ) {} else {
	 ?>
      <div class="change-element-size-temp">
        <div class="add-element-size" id="add-element-size" ></div>
        <div class="sub-element-size" id="sub-element-size" ></div>
      </div>
      <?php }?>
    </div>
    <span class="page-element-item-text"> <?php echo $text; ?> </span>
    <input type="hidden" id="<?php echo $item['item'];?>" class="<?php echo $item['item'];?>" value="<?php echo $text; ?>" name="<?php echo $item['itemname'];?>">
    <input type="hidden" id="<?php echo $item['size'];?>" class="<?php echo $item['size'];?>" value="<?php echo $size; ?>" name="<?php echo $item['sizename'];?>">
    <div class="item-bar-right">
      <div class="element-size-text" id="element-size-text"><?php echo $div_size[$text][$size]; ?></div>
      <div class="change-element-property"> <a title="Edit">
        <div rel="cp-edit-box" id="page-element-edit-box" class="edit-element"></div>
        </a> <a title="Delete">
        <div class="delete-element" id="delete-element"></div>
        </a> </div>
    </div>
  </div>
  <?php
	}

	

	//Print exceptional input element ( from meta-template )

	function print_box_tab($name, $values){

	

		?>
  <div class="meta-body">
    <div class="meta-title meta-tab">ADD MORE TABS</div>
    <div id="page-tab-add-more" class="page-tab-add-more" />
  </div>
  <br class="clear">
  <div class="meta-input">
    <input type='hidden' class="tab-num" id="tab-num" name='<?php echo $name['tab-num']; ?>[]' value=<?php 

					echo empty($values)? 0: $values->childNodes->length;

				?> />
    <div class="added-tab" id="added-tab">
      <ul>
        <li id="page-item-tab" class="default">
          <div class="meta-title meta-tab-title">TABS TITLE</div>
          <input type="text"  id='<?php echo $name['title']; ?>' />
          <br>
          <div class="meta-title meta-tab-title">TABS TEXT</div>
          <textarea id='<?php echo $name['caption']; ?>' ></textarea>
          <br>
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
          <div class="meta-title meta-tab-title">TABS TITLE</div>
          <input type="text" name='<?php echo $name['title']; ?>[]' id='<?php echo $name['title']; ?>' value="<?php echo find_xml_value($tab, 'title'); ?>" />
          <br>
          <div class="meta-title meta-tab-title">TABS TEXT</div>
          <textarea name='<?php echo $name['caption']; ?>[]' id='<?php echo $name['caption']; ?>' ><?php echo find_xml_value($tab, 'caption'); ?></textarea>
          <br>
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

	// sidebar => name, value

	function print_panel_sidebar($title, $values){
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
  <div class="panel-description"> <?php printf(__('%s','crunchpress'),$description ); ?> </div>
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