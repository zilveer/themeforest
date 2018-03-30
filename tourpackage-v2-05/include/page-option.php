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

		'Color-Open' => array(
			'element1-1'=>'1/1'
		),
		
		'Color-Close' => array(
			'element1-1'=>'1/1'
		),
			
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

		'Feature-Media' => array(
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

		'Message-Box' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),

		'Package' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),		

		'Package-Search' => array(
			'element1-4'=>'1/4',
			'element1-3'=>'1/3',
			'element1-2'=>'1/2',
			'element2-3'=>'2/3',
			'element3-4'=>'3/4',
			'element1-1'=>'1/1'),				
			
		'Personnal' => array(
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

		'Title' => array(
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
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-accordion-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),						
					'header'=>array(
						'title'=> __('HEADER TITLE', 'gdl_back_office'),
						'name'=> 'page-option-item-accordion-header-title',
						'type'=> 'inputtext'),
					'tab-item'=>array(
						'tab-num'=>'page-option-item-accordion-num',
						'title'=>'page-option-item-accordion-title',
						'caption'=>'page-option-item-accordion-content',
						'active'=>''),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-accordion-item-margin',
						'default'=>'40',
						'hr'=>'none',
						'type'=> 'inputtext'),
				),
				
				'Blog'=>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-blog-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),						
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-blog-header-title',
						'type'=> 'inputtext'),
					'read-the-blog'=>array(
						'title'=> 'READ THE BLOG PAGE',
						'name'=> 'page-option-item-blog-view-all',
						'type'=> 'combobox',
						'description' => 'You can change Read The Blog text at the admin panel > translator > blog / portfolio'),							
					'item-size'=>array(
						'title'=>'BLOG SIZE',
						'name'=>'page-option-item-blog-size',
						'options'=>array('0'=>'1/4 Blog Widget', '2'=>'1/3 Blog Widget', 
							'3'=>'1/2 Blog Widget', '4'=>'1/1 Blog Widget', '5'=>'1/1 Blog List',
							'6'=>'1/1 Medium Thumbnail', '7'=>'1/1 Full Thumbnail'),
						'type'=>'combobox', 
						'hr'=>'none',
						'description'=>'This is the actual size of the blog thumbnail. Outside size is the size of wrapper. The full-blog will appear only when the wrapper size equals to 1/1/.'),
					'blog-type'=>array(
						'title'=>'BLOG TYPE',
						'name'=>'page-option-item-blog-type',
						'meta_body'=>'page-option-item-blog-type-wrapper',
						'options'=>array('Normal', 'Carousel'),
						'type'=>'combobox'),	
					'category'=>array(
						'title'=>'CHOOSE CATEGORY',
						'name'=>'page-option-item-blog-category',
						'options'=>array(),
						'type'=>'combobox',
						'description'=>'Choose the post category you want to fetch the post.'),					
					'show-thumbnail'=>array(					
						'title'=> 'SHOW BLOG THUMBNAIL',
						'name'=> 'page-option-item-blog-thumbnail',
						'type'=> 'combobox',
						'options'=> array('Yes', 'No')),
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
					'offset'=>array(
						'title'=>'BLOG OFFSET',
						'name'=>'page-option-item-blog-offset',
						'type'=>'inputtext',
						'description'=>'Choose the number of posts to skip from fetching, leave it blank to set it to 0.' .
							'<br><br> **** Please noted that, offset option and pagination will not work well together ****'),							
					'orderby'=>array(
						'title'=>'ORDER BY',
						'options'=> array('date', 'title', 'rand', 'comment_count'),
						'name'=>'page-option-item-blog-orderby',
						'type'=>'combobox' ),
					'order'=>array(
						'title'=>'ORDER',
						'options'=> array('asc', 'desc'),
						'default'=> 'desc',
						'name'=>'page-option-item-blog-order',
						'type'=>'combobox' ),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-blog-item-margin',
						'default'=>'40',
						'hr'=>'none',
						'type'=> 'inputtext'),						
				),
				
				'Color-Open'=>array(
					'color-code'=>array(
						'title'=>'COLOR CODE',
						'type'=>'inputtext',
						'name'=>'page-option-item-color-open-color-code',
						'description'=>'Ex. #f3f3f3, #3389d7'
					),
					'border-color'=>array(
						'title'=>'BORDER COLOR',
						'type'=>'inputtext',
						'name'=>'page-option-item-color-open-border-color',
						'description'=>'Ex. #f3f3f3, #3389d7'
					),					
					'top-padding'=>array(
						'title'=>'TOP PADDING',
						'type'=>'inputtext',
						'name'=>'page-option-item-color-open-top-padding',
						'hr'=>'none',
						'default'=>'45',
						'description'=>'This is the space before the content in color section'
					),
					'bottom-margin'=>array(
						'title'=>'BOTTOM MARGIN',
						'type'=>'inputtext',
						'name'=>'page-option-item-color-open-bottom-margin',
						'hr'=>'none',
						'default'=>'45',
						'description'=>'Speace after the color section is closed'
					),
				),
				
				'Color-Close'=>array(
					'description'=>array(
						'title'=> 'DESCRIPTION',
						'name'=> 'no-name',
						'type'=> 'description',
						'description'=> 'No option available. Just a closing element of the color-open item.',
						'hr'=>'none'
					),					
				),
				
				'Contact-Form'=>array(
					'email'=>array(
						'title'=>'E-MAIL',
						'name'=>'page-option-item-contat-email',
						'type'=>'inputtext',
						'description'=>'Place the destination of the email when user submit the contact form here.'),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-contact-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),
				),
				
				'Column'=>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-column-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),	
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-column-header-title',
						'type'=> 'inputtext'),					
					'column-text'=>array(
						'title'=> 'COLUMN TEXT',
						'name'=> 'page-option-item-column-text',
						'type'=> 'textarea'),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-column-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),
				),

				'Column-Service'=>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-column-service-icon-class',
						'type'=> 'inputtext',
						'description'=> 'Input some class to use the predefined icon, uploading the image to below field will ignore this value.<br><br>' .
							'You can see the list of all item class here http://themes.goodlayers2.com/tourpackage/icon/' ),					
					'icon'=>array(
						'title'=> 'ICON',
						'name'=> 'page-option-item-column-service-icon',
						'type'=> 'upload'),		
					'center-icon'=>array(
						'title'=> 'CENTER CONTENT',
						'name'=> 'page-option-item-column-service-center-icon',
						'options'=> array('No', 'Yes'),
						'type'=> 'combobox'),						
					'title'=>array(
						'title'=> __('TITLE', 'gdl_back_office'),
						'name'=> 'page-option-item-column-service-title',
						'type'=> 'inputtext'),
					'caption'=>array(
						'title'=> __('CAPTION', 'gdl_back_office'),
						'name'=> 'page-option-item-column-service-caption',
						'type'=> 'textarea'),		
					'button-text'=>array(
						'title'=> __('BUTTON TEXT', 'gdl_back_office'),
						'name'=> 'page-option-item-column-service-button-text',
						'default'=> 'Read More',
						'type'=> 'inputtext'),	
					'button-link'=>array(
						'title'=> __('BUTTON LINK', 'gdl_back_office'),
						'name'=> 'page-option-item-column-service-button-link',
						'type'=> 'inputtext'),							
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-column-service-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),							
				),
				
				'Content' => array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-content-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),						
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-content-header-title',
						'type'=> 'inputtext'),								
					'description'=>array(
						'title'=> 'DESCRIPTION',
						'name'=> 'no-name',
						'type'=> 'description',
						'description'=> 'This item will get the content in the editor(wordpress visual/html editor) to show as a page item. ' .
							'Don\'t forget to hide the page content in page options, otherwise there will be a duplicated content in the page.',
					),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-content-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),
				),
				
				'Divider' =>array(
					'text'=>array(
						'title'=> 'BACK TO TOP TEXT',
						'name'=> 'page-option-item-divider-text',
						'type'=> 'inputtext',
						'description'=> "This text will appear at the top right of divider line. It helps user to scroll page to the top. Leave it blank if you don't want it to be shown."),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-divider-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),			
				),			
				
				'Feature-Media' =>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-feature-media-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),	
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-feature-media-header',
						'type'=> 'inputtext'),			
					'type'=>array(
						'title'=>'MEDIA TYPE',
						'name'=>'page-option-item-feature-media-type',
						'type'=>'combobox',
						'options'=>array('Image','Video'),
						'hr'=>'none'),
					'image'=>array(
						'title'=>'IMAGE',
						'name'=>'page-option-item-feature-media-image',
						'type'=>'upload',
						'hr'=>'none'),	
					'video'=>array(
						'title'=>'VIDEO',
						'name'=>'page-option-item-feature-media-video',
						'type'=>'inputtext'),
					'title'=>array(
						'title'=> __('TITLE', 'gdl_back_office'),
						'name'=> 'page-option-item-feature-media-title',
						'type'=> 'inputtext'),						
					'content'=>array(
						'title'=> __('CONTENT', 'gdl_back_office'),
						'name'=> 'page-option-item-feature-media-content',
						'type'=> 'textarea'),	
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-feature-media-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),						
				),								
				
				'Gallery' =>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-gallery-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),
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
						'options'=> array()
					),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-gallery-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),				
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
						'type'=> 'textarea'),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-message-box-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),				
				),

				'Personnal'=>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-personnel-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-personnal-header-title',
						'type'=> 'inputtext'),	
					'item-size'=>array(
						'title'=> 'ITEM SIZE',
						'name'=> 'page-option-item-personnal-item-size',
						'type'=> 'combobox',
						'options'=> array( '1/4','1/3','1/2' )),		
					'num-fetch'=>array(
						'title'=> 'NUM FETCH',
						'name'=> 'page-option-item-personnal-num-fetch',
						'type'=> 'inputtext'),							
					'category'=>array(
						'title'=> 'PERSONNAL CATEGORY',
						'name'=> 'page-option-item-personnal-category',
						'type'=> 'combobox',
						'options'=> array()),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-personnal-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),				
				),				

				'Package'=>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-package-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-package-header-title',
						'type'=> 'inputtext'),						
					'item-size'=>array(
						'title'=>'PACKAGE STYLE',
						'name'=>'page-option-item-package-size',
						'options'=>array('0'=>'1/4 Grid Style', '1'=>'1/3 Grid Style', '2'=>'1/2 Grid Style',
							'3'=>'1/4 Grid 2nd Style', '4'=>'1/3 Grid 2nd Style', '5'=>'1/2 Grid 2nd Style',
							'6'=>'1/1 Medium Thumbnail'),
						'type'=>'combobox'),
					'category'=>array(
						'title'=>'CHOOSE CATEGORY',
						'name'=>'page-option-item-package-category',
						'options'=>array(),
						'type'=>'combobox',
						'hr'=> 'none'),				
					'num-fetch'=>array(					
						'title'=> 'NUM FETCH',
						'name'=> 'page-option-item-package-num-fetch',
						'type'=> 'inputtext',
						'default'=> 6,
						'description'=> 'This is the number of package you want to fetch in one page.'),
					'num-excerpt'=>array(					
						'title'=> 'NUM EXCERPT',
						'name'=> 'page-option-item-package-num-excerpt',
						'type'=> 'inputtext',
						'default'=> 150,
						'description'=> 'This field will be ignored when the manual excerpt is available'),						
					'pagination'=>array(
						'title'=>'ENABLE PAGINATION',
						'name'=>'page-option-item-package-pagination',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'description'=>'Pagination will only appear when the number of selected page is greater than the number of fetched item in one page.'),
					'orderby'=>array(
						'title'=>'ORDER BY',
						'options'=> array('date', 'title', 'rand'),
						'name'=>'page-option-item-package-orderby',
						'type'=>'combobox' ),
					'order'=>array(
						'title'=>'ORDER',
						'options'=> array('asc', 'desc'),
						'default'=> 'desc',
						'name'=>'page-option-item-package-order',
						'type'=>'combobox' ),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-package-item-margin',
						'default'=>'40',
						'hr'=>'none',
						'type'=> 'inputtext'),						
				),
				
				'Package-Search'=>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-package-search-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-package-search-header-title',
						'type'=> 'inputtext'),						
				),
				
				'Page'=>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-page-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-page-header-title',
						'type'=> 'inputtext',
						'description'=>'This "Page Item" will fetch the child page of this page( instead of category like portfolio ).'),			
					'item-size'=>array(
						'title'=>'PAGE ITEM SIZE',
						'name'=>'page-option-item-page-size',
						'options'=>array('0'=>'1/4', '1'=>'1/3', '2'=>'1/2'),
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
						'default'=> 100,
						'description'=>'The number of thumbnail content character.'),
					'pagination'=>array(
						'title'=>'ENABLE PAGINATION',
						'name'=>'page-option-item-page-pagination',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'description'=>'Pagination will only appear when the number of selected page is greater than the number of fetched item in one page.'),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-page-item-margin',
						'default'=>'40',
						'hr'=>'none',
						'type'=> 'inputtext'),
				),
				
				'Portfolio'=>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-portfolio-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-portfolio-header-title',
						'type'=> 'inputtext'),
					'view-all-portfolio'=>array(
						'title'=> 'VIEW PORTFOLIO PAGE',
						'name'=> 'page-option-item-portfolio-view-all',
						'type'=> 'combobox',
						'description' => 'You can change this text at the admin panel > translator > blog / portfolio'),						
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
					'portfolio-type'=>array(
						'title'=>'PORTFOLIO TYPE',
						'name'=>'page-option-item-portfolio-type',
						'type'=> 'combobox',
						'options'=>array('0'=>'Portfolio', '1'=>'Filter Portfolio', '2'=>'jQuery Filter Portfolio', 
							'3'=>'Carousel Portfolio', '4'=>'Carousel Description Portfolio'),
						'description'=>'jQuery filter can only filter portfolio item that show in the current page.',
						'hr'=>'none'),
					'column-description'=>array(
						'title'=>'FIRST COLUMN DESCRIPTION',
						'name'=>'page-option-item-portfolio-first-column-description',
						'type'=> 'textarea'),						
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
						'hr'=>'none'),
					'show-tag'=>array(
						'title'=>'SHOW TAG',
						'name'=>'page-option-item-portfolio-show-tag',
						'type'=> 'combobox',
						'hr'=>'none',
						'options'=>array('0'=>'Yes', '1'=>'No')),
					'num-excerpt'=>array(
						'title'=>'NUM EXCERPT',
						'name'=>'page-option-item-portfolio-num-excerpt',
						'type'=> 'inputtext',
						'description'=> 'Set it to 0 or leave it blank to hide the excerpt out'),						
					'pagination'=>array(
						'title'=>'ENABLE PAGINATION',
						'name'=>'page-option-item-portfolio-pagination',
						'type'=> 'combobox',
						'options'=>array('0'=>'Yes', '1'=>'No'),
						'description'=>'Pagination will only appear when the number of selected page is greater than the number of fetched item in one page.'),
					'orderby'=>array(
						'title'=>'ORDER BY',
						'options'=> array('date', 'title', 'rand'),
						'name'=>'page-option-item-portfolio-orderby',
						'type'=>'combobox' ),
					'order'=>array(
						'title'=>'ORDER',
						'options'=> array('asc', 'desc'),
						'default'=> 'desc',
						'name'=>'page-option-item-portfolio-order',
						'type'=>'combobox' ),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-portfolio-item-margin',
						'default'=>'40',
						'hr'=>'none',
						'type'=> 'inputtext'),						
				),

				'Post-Slider' =>array(
					'slider-type'=>array(
						'title'=>'SLIDER TYPE',
						'name'=>'page-option-item-post-slider-type',
						'options'=>array('0'=>'Nivo Slider', '1'=>'Flex Slider', '2'=>'Carousel Slider'),
						'type'=>'combobox',
						'hr'=>'none'),
					'width'=>array(
						'title'=>'SLIDER WIDTH',
						'name'=>'page-option-item-post-slider-width',
						'type'=>'inputtext',
						'default'=>'940',
						'hr'=>'none'),
					'height'=>array(
						'title'=>'SLIDER HEIGHT',
						'name'=>'page-option-item-post-slider-height',
						'type'=>'inputtext',
						'default'=>'360',
						'hr'=>'none'),
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
						'default'=> 4),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-post-slider-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),
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
						'description'=>'Choose the category you want item to be fetched.'),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-price-table-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),
				),
					
				'Slider' =>array(
					'slider-type'=>array(
						'title'=>'SLIDER TYPE',
						'name'=>'page-option-item-slider-type',
						'options'=>array('0'=>'Nivo Slider', '1'=>'Flex Slider', '2'=>'Anything Slider', '3'=>'Carousel Slider'),
						'type'=>'combobox',
						'hr'=>'none',
						'description'=>	'Anything slider is the only one that support the video, but it will' . 
							'not support the responsive option.'),
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
						'linktype'=>'page-option-item-slider-linktype'),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-slider-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),
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
					'button-text'=>array(
						'title'=> 'BUTTON TEXT',
						'name'=> 'page-option-item-stunning-text-button-text',
						'type'=> 'inputtext',
						'default'=>'Buy Now',
						'hr'=>'none'),	
					'button-link'=>array(
						'title'=> 'BUTTON LINK',
						'name'=> 'page-option-item-stunning-text-button-link',
						'type'=> 'inputtext'),							
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-stunning-text-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),					
				),
				
				'Tab' =>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-tab-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-tab-header-title',
						'type'=> 'inputtext'),					
					'tab-item'=>array(
						'tab-num'=>'page-option-item-tab-num',
						'title'=>'page-option-item-tab-title',
						'caption'=>'page-option-item-tab-content',
						'active'=>''),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-tab-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),
				),
						
				'Testimonial' =>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-testimonial-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),
					'header'=>array(
						'title'=> 'HEADER TITLE',
						'name'=> 'page-option-item-testimonial-header-title',
						'type'=> 'inputtext'),
					'display-type'=>array(
						'title'=>'CHOOSE TESTIMONIAL DISPLAY TYPE',
						'name'=>'page-option-item-testimonial-display-type',
						'hr'=>'none',
						'options'=>array('0'=>'Static Testimonial', '1'=>'Carousel Testimonial'),
						'type'=>'combobox'),						
					'item-size'=>array(
						'title'=>'TESTIMONIAL SIZE',
						'name'=>'page-option-item-testimonial-size',
						'options'=>array('0'=>'1/4', '1'=>'1/3', '2'=>'1/2', '3'=>'1/1'),
						'meta_body'=>'testimonial-item-size-wrapper',
						'type'=>'combobox',
						'description'=>'This is the actual size of the testimonial. Outside size is the size of wrapper. If you choose the wrapper size to be 1/1 and item size to be 1/4, you will get up to 4 testimonial in one row.'),
					'category'=>array(
						'title'=>'CHOOSE CATEGORY',
						'name'=>'page-option-item-testimonial-category',
						'options'=>array(),
						'type'=>'combobox',
						'description'=>'Choose the category you want testimonial to be fetched. This theme will display testimonail using the jquery carousel.'),
					'num-fetch'=>array(
						'title'=>'NUM FETCH',
						'name'=>'page-option-item-testimonial-num-fetch',
						'type'=>'inputtext',
						'default'=>'4'),		
					'orderby'=>array(
						'title'=>'ORDER BY',
						'options'=> array('date', 'title', 'rand'),
						'name'=>'page-option-item-testimonial-orderby',
						'type'=>'combobox' ),
					'order'=>array(
						'title'=>'ORDER',
						'options'=> array('asc', 'desc'),
						'default'=> 'desc',
						'name'=>'page-option-item-testimonial-order',
						'type'=>'combobox' ),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-testimonial-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),
				),

				'Title' =>array(
					'title'=>array(
						'title'=> 'TITLE',
						'name'=> 'page-option-item-title-title',
						'type'=> 'inputtext'
					),
					'read-more-text'=>array(
						'title'=> 'READ MORE TEXT',
						'name'=> 'page-option-item-title-read-more',
						'type'=> 'inputtext',
						'default'=> 'View All Destinations'
					),
					'read-more-link'=>array(
						'title'=> 'READ MORE LINK',
						'name'=> 'page-option-item-title-read-more-link',
						'type'=> 'inputtext'
					),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-title-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),
				),
				
				'Toggle-Box' =>array(
					'icon-class'=>array(
						'title'=> 'ICON CLASS',
						'name'=> 'page-option-item-toggle-box-header-icon',
						'type'=> 'inputtext',
						'description'=> 'You can see the list of all icon here http://themes.goodlayers2.com/tourpackage/icon/'),
					'header'=>array(
						'title'=> __('HEADER TITLE', 'gdl_back_office'),
						'name'=> 'page-option-item-toggle-box-header-title',
						'type'=> 'inputtext'),
					'tab-item'=>array(
						'tab-num'=>'page-option-item-toggle-box-num',
						'title'=>'page-option-item-toggle-box-title',
						'caption'=>'page-option-item-toggle-box-content',
						'active'=>'page-option-item-toggle-box-active'),
					'item-margin'=>array(
						'title'=> __('BOTTOM MARGIN', 'gdl_back_office'),
						'name'=> 'page-option-item-toggle-box-item-margin',
						'default'=>'45',
						'hr'=>'none',
						'type'=> 'inputtext'),
				),

			)
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
				'3'=>array('value'=>'both-sidebar','image'=>'/include/images/both-sidebar.png','default'=>'selected'),
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
		
		"Page Caption" => array(
			'type'=>'textarea',
			'name'=>'page-option-caption',
			'title'=> __('PAGE CAPTION', 'gdl_back_office')
		),			

		"Page Content" => array(
			'type'=>'combobox',
			'name'=>'page-option-show-content',
			'options'=> array('Yes', 'No'),
			'title'=> __('SHOW PAGE CONTENT', 'gdl_back_office'),
			'hr'=>'none'
		),	
		
		"Top Slider Type" => array(
			'title'=> __('TOP SLIDER TYPE', 'gdl_back_office'),
			'name'=>'page-option-top-slider-types',
			'options'=>array('0'=>'Title', '1'=>'None', '2'=>'Nivo Slider', '3'=>'Flex Slider', '4'=>'Layer Slider', '5'=>'Master Slider'),
			'type'=>'combobox',
			'hr'=>'none',
			'description' => 'Top slider is the slider under the main navigation menu and above the page template( so it will always be full width ).'
		),	
		
		"Layer Slider Open" => array( 'type'=>'open', 'id'=>'gdl-layer-slider-wrapper'),

		"Layer Slider ID" => array(
			'title'=> __('LAYER SLIDER ID', 'gdl_back_office'),
			'name'=>'page-option-layer-slider-id',
			'type'=>'inputtext',
			'default'=> '1',
			'hr'=>'none',
			'description'=>'You have to create the layer slider ( by installing the plugin we provided within the zip file you downloaded from theme forest. )' .
						   ' and follows the instruction on the slider documentation before inputting this. <br><br><strong> Only Integer Number is allowed in this field</strong>.'
		),			
		
		"Layer Slider Close" => array( 'type'=>'close' ),	
		
		"Master Slider Open" => array( 'type'=>'open', 'id'=>'gdl-master-slider-wrapper'),

		"Master Slider Shortcode" => array(
			'title'=> __('MASTER SLIDER SHORTCODE', 'gdl_back_office'),
			'name'=>'page-option-master-slider-id',
			'type'=>'inputtext',
			'hr'=>'none',
			'description'=>'You have to create the master slider ( plugin not included within the theme )'
		),			
		
		"Master Slider Close" => array( 'type'=>'close' ),		
		
		"Top Slider Open" => array( 'type'=>'open', 'id'=>'gdl-top-slider-wrapper'),		
		
		"Top Slider" => array(
			'type'=>'imagepicker',
			'title'=> __('SELECT IMAGES', 'gdl_back_office'),
			'xml'=>'page-option-top-slider-xml',
			'hr'=>'none',
			'name'=>array(
				'image'=>'page-option-top-slider-image',
				'title'=>'page-option-top-slider-title',
				'caption'=>'page-option-top-slider-caption',
				'link'=>'page-option-top-slider-link',
				'linktype'=>'page-option-top-slider-linktype'),
		),
		
		"Top Slider Close" => array( 'type'=>'close' ),
		
		"Enable Bottom Slider" => array(
			'title'=> __('ENABLE UNDER SLIDER AREA', 'gdl_back_office'),
			'name'=>'page-option-enable-bottom-slider',
			'type'=>'combobox',
			'options'=>array('No','Yes'),
			'hr'=>'none'
		),					
		
		"Bottom Slider Open" => array( 'type'=>'open', 'id'=>'bottom-slider-option', 'hr'=>'none' ),
		
		"Bottom Slider 1" => array(
			'title'=> __('UNDER SLIDER TITLE', 'gdl_back_office'),
			'name'=>'page-option-under-slider-title',
			'type'=>'inputtext',
			'hr'=>'none'
		),		

		"Bottom Slider 2" => array(
			'title'=> __('UNDER SLIDER CAPTION', 'gdl_back_office'),
			'name'=>'page-option-under-slider-caption',
			'type'=>'textarea',
			'hr'=>'none'
		),			

		"Bottom Slider 3" => array(
			'title'=> __('UNDER SLIDER BUTTON TEXT', 'gdl_back_office'),
			'name'=>'page-option-under-slider-button-text',
			'type'=>'inputtext',
			'hr'=>'none'
		),		
		
		"Bottom Slider 4" => array(
			'title'=> __('UNDER SLIDER BUTTON LINK', 'gdl_back_office'),
			'name'=>'page-option-under-slider-button-link',
			'type'=>'inputtext',
			'hr'=>'none'
		),			

		"Bottom Slider Close" => array( 'type'=>'close', 'hr'=>'none' ),
		
	);
	
	// Page Excerpt
	add_action( 'init', 'my_add_excerpts_to_pages' );
	function my_add_excerpts_to_pages() {
		 add_post_type_support( 'page', 'excerpt' );
	}	
	
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
		$page_meta_boxes['Page Item']['name']['Blog']['read-the-blog']['options'] = array_merge( array('None'), get_post_slug_list('page'));
		$page_meta_boxes['Page Item']['name']['Gallery']['page']['options'] = get_post_slug_list( 'gdl-gallery' );			
		$page_meta_boxes['Page Item']['name']['Personnal']['category']['options'] = get_category_list( 'personnal-category' );
		$page_meta_boxes['Page Item']['name']['Package']['category']['options'] = get_category_list( 'package-category' );
		$page_meta_boxes['Page Item']['name']['Portfolio']['category']['options'] = get_category_list( 'portfolio-category' );
		$page_meta_boxes['Page Item']['name']['Portfolio']['view-all-portfolio']['options'] = array_merge( array('None'), get_post_slug_list('page'));
		$page_meta_boxes['Page Item']['name']['Post-Slider']['category']['options'] = get_category_list( 'category' );
		$page_meta_boxes['Page Item']['name']['Price-Item']['category']['options'] = get_category_list( 'price-table-category' );
		$page_meta_boxes['Page Item']['name']['Testimonial']['category']['options'] = get_category_list( 'testimonial-category' );
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
				
				if( empty( $page_meta_box['name'] ) ){ $page_meta_box['name'] = ''; }
				$page_meta_box['value'] = get_post_meta($post->ID, $page_meta_box['name'], true);
				print_meta( $page_meta_box );
			
			}
			echo "<div class='clear'></div>";
			
			if (empty($page_meta_box['hr'])){
				if( $page_meta_box['type'] != 'open' && $page_meta_box['type'] != 'close'){
					echo '<hr class="separator mt20">';
				}
			}
		
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