<?php
/*Theme Configuration*/
$config = array (
	
	/*Theme Modules*/
	'modules' => array(
		'MthemeInterface',
		'MthemeForm',
		'MthemeStyle',
		'MthemeSidebar',
		'MthemeShortcode',
		'MthemeTexameta',
		'MthemeMailchimp'		
	),
	
	/*Theme Components*/
	'components' => array(
		
		/*Supports*/
		'supports' => array (
			'title-tag',
			'automatic-feed-links',
			'post-thumbnails', 
			'custom-header',
			'custom-background'			
		),
		//Rewrite Rules
		'rewrite_rules' => array (
			'profile' => array(
				'name' => 'profile',
				'rule' => 'author_base',
				'rewrite' => 'profile',
				'position' => 'top',
				'replace' => true,
				'dynamic' => true,
			),
			
			'redirect' => array(
				'name' => 'redirect',
				'rule' => 'redirect/([^/]+)',
				'rewrite' => 'index.php?redirect=$matches[1]',
				'position' => 'top',
				'dynamic' => true,
			),
		),
	
		/*User Roles*/
		'user_roles' => array (
			array(
				'role' => 'inactive',
				'name' => __('Inactive', 'mtheme'),
				'capabilities' => array(),
			),
		),
		
		/*Custom Menus*/
		'custom_menus' => array (
			array(
				'slug' => 'main_menu',
				'name' => __('Main Menu', 'mtheme'),
			),
		),
		
		/*Editor styles*/
		'editor_styles' => array(
			'bordered'=>__('Bordered List', 'mtheme'),
			'checked'=>__('Checked List', 'mtheme'),
		),
		
		/*Image Sizes*/
		'image_sizes' => array (
		
			array(
				'name' => 'normal',
				'width' => 420,
				'height' => 420,
				'crop' => false,
			),
			
			array(
				'name' => 'extended',
				'width' => 1170,
				'height' => 520,
				'crop' => false,
			),	
			array(
				'name' => 'gallery',
				'width' => 620,
				'height' => 410,
				'crop' => false,
			),
		),
		
		/*Admin Styles*/
		'admin_styles' => array(			
			/*colorpicker*/
			array(
				'name' => 'wp-color-picker',
			),
			/*thickbox*/
			array(	
				'name' => 'thickbox',
			),
						
			/*interface*/
			array(	
				'name' => 'mtheme-style',
				'uri' => MTHEME_URI.'assets/css/style.css'
			),	
			/*jquery for datepicker*/
			array(
				'name' => 'mtheme-jquery-css',
				'uri' => '//code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css',
			),
			/*icon_picker*/
			array(
				'name' => 'icon_picker',
				'uri' => MTHEME_URI.'assets/css/icon_picker.css',
			),
			array(	
				'name' => 'font-awesome.min-style',
				'uri' => CHILD_URI.'site/css/font-awesome.min.css',	
			),
			array(	
				'name' => 'genericons-style',
				'uri' => MTHEME_URI.'assets/css/genericons.css',	
			),			
		),
		
		/*Admin Scripts*/
		'admin_scripts' => array(
			
			/*colorpicker*/
			array(
				'name' => 'wp-color-picker',
			),
			
			/*thickbox*/
			array(	
				'name' => 'thickbox',
			),
			
			/*uploader*/
			array(	
				'name' => 'media-upload',
			),
				
			/*popup*/
			array(
				'name' => 'mtheme-popup',
				'uri' => MTHEME_URI.'assets/js/mtheme.popup.js',
			),
			
			/*interface*/
			array(
				'name' => 'mtheme-interface',
				'uri' => MTHEME_URI.'assets/js/mtheme.interface.js',
			),
			/*jquery*/
			array(
				'name' => 'mtheme-jquery',
				'uri' => MTHEME_URI.'assets/js/jquery-ui.js',
			),
			/*timepicker*/
			array(
				'name' => 'mtheme-timepicker-jquery',
				'uri' => MTHEME_URI.'assets/js/jquery-ui-timepicker-addon.min.js',
			),
			/*icon_picker*/
			array(
				'name' => 'icon_picker',
				'uri' => MTHEME_URI.'assets/js/icon_picker.js',
			),
			/*onkeypressvalidation*/
			array(	
				'name' => 'onkeypressvalidation-js',
				'uri' => CHILD_URI.'site/js/onkeypressvalidation.js'
			),
		),
		
		/*User Styles*/
		'user_styles' => array(
				
			/*general*/
			array(	
				'name' => 'bootstrap-style',
				'uri' => CHILD_URI.'site/css/bootstrap.min.css',				
			),
			array(	
				'name' => 'font-awesome.min-style',
				'uri' => CHILD_URI.'site/css/font-awesome.min.css',	
			),			
			array(	
				'name' => 'genericons-style',
				'uri' => MTHEME_URI.'assets/css/genericons.css',	
			),
			array(	
				'name' => 'flexslider-style',
				'uri' => CHILD_URI.'site/css/flexslider.css',				
			),
			array(	
				'name' => 'animate-style',
				'uri' => CHILD_URI.'site/css/animate.css',				
			),
			array(	
				'name' => 'schedule-style',
				'uri' => CHILD_URI.'site/css/schedule.css',				
			),			
			array(	
				'name' => 'gridgallery-style',
				'uri' => CHILD_URI.'site/css/gridgallery.css',				
			),
			array(	
				'name' => 'venobox-style',
				'uri' => CHILD_URI.'site/css/venobox.css',				
			),
			array(	
				'name' => 'jquery.countdown-style',
				'uri' => CHILD_URI.'site/css/jquery.countdown.css',				
			),	
			/*theme-css*/
			array(	
				'name' => 'mtheme-style',
				'uri' => CHILD_URI.'style.css',				
			),
			/*array(	
				'name' => 'mievent-style',
				'uri' => CHILD_URI.'site/css/mtheme.css',				
			),
			array(	
				'name' => 'queries-style',
				'uri' => CHILD_URI.'site/css/queries.css',				
			),*/
		),
		
		/*User Header Scripts*/
		'user_header_scripts' => array(					
			
		),
		/*User Footer Scripts*/
		'user_footer_scripts' => array(
			/*jquery*/
			array(	
				'name' => 'jquery-js',
				'uri' => CHILD_URI.'site/js/jquery-1.11.0.min.js'
			),
			array(	
				'name' => 'jquery-min-js',
				'uri' => CHILD_URI.'site/js/jquery-ui-1.10.4.min.js'
			),
			array(	
				'name' => 'classie-js',
				'uri' => CHILD_URI.'site/js/classie.js'
			),	
			array(	
				'name' => 'hammer.min-js',
				'uri' => CHILD_URI.'site/js/hammer.min.js'
			),			
			array(	
				'name' => 'venobox-js',
				'uri' => CHILD_URI.'site/js/venobox.js'
			),			
			array(	
				'name' => 'html5shiv-js',
				'uri' => CHILD_URI.'site/js/html5shiv.js'
			),
			array(	
				'name' => 'respond.min-js',
				'uri' => CHILD_URI.'site/js/respond.min.js'
			),
			array(	
				'name' => 'modalEffects-js',
				'uri' => CHILD_URI.'site/js/modalEffects.js'
			),
			array(	
				'name' => 'bootstrap.min-js',
				'uri' => CHILD_URI.'site/js/bootstrap.min.js'
			),
			array(	
				'name' => 'jquery.flexslider-js',
				'uri' => CHILD_URI.'site/js/jquery.flexslider.js'
			),
			array(	
				'name' => 'modernizr-js',
				'uri' => CHILD_URI.'site/js/modernizr.js'
			),
			array(	
				'name' => 'smooth-scroll-js',
				'uri' => CHILD_URI.'site/js/smooth-scroll.js'
			),array(	
				'name' => 'jquery.nicescroll-js',
				'uri' => CHILD_URI.'site/js/jquery.nicescroll.js'
			),
			array(	
				'name' => 'notifyMe-js',
				'uri' => CHILD_URI.'site/js/notifyMe.js'
			),
			array(	
				'name' => 'jquery.placeholder-js',
				'uri' => CHILD_URI.'site/js/jquery.placeholder.js'
			),
			array(	
				'name' => 'jquery.plugin-js',
				'uri' => CHILD_URI.'site/js/jquery.plugin.js'
			),
			array(	
				'name' => 'jquery.countdown-js',
				'uri' => CHILD_URI.'site/js/jquery.countdown.js'
			),			
			array(	
				'name' => 'wow.min-js',
				'uri' => CHILD_URI.'site/js/wow.min.js'
			),
			array(	
				'name' => 'init-js',
				'uri' => CHILD_URI.'site/js/init.js'
			),
			array(	
				'name' => 'onkeypressvalidation-js',
				'uri' => CHILD_URI.'site/js/onkeypressvalidation.js'
			),
		),
		
		/*Widget Settings*/
		'widget_settings' => array (
			'before_widget' => '<div class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title"><h3 class="nomargin">',
			'after_title' => '</h3></div>',
		),
		
		/*Widget Areas*/
		'widget_areas' => array (
			array(
				'id' => 'default',
				'name' => __('Default', 'mtheme'),
				'before_widget' => '<div class="widget %2$s">',
				'after_widget' => '</div>',
				'before_title' => '<div class="widget-title"><h3 class="nomargin">',
				'after_title' => '</h3></div>',				
			),
			
		),
		
		/*Widgets*/
		'widgets' => array (
			'MthemeAuthors',
			'MthemeComments',
			'WP_Widget_Search',
			'WP_Widget_Recent_Comments',
		),
		/*Post Types*/
		'post_types' => array (
		),
		
		/*Taxonomies*/
		'taxonomies' => array (
			/*event Category*/
			array(
				'taxonomy' => 'event_cat',
				'object_type' => array('event'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,			
					'labels' => array(
	                    'name' => __( 'Categories', 'mtheme'),
	                    'singular_name' => __( 'Categories', 'mtheme'),
						'menu_name' => __( 'Categories', 'mtheme' ),
	                    'search_items' => __( 'Search Event Category', 'mtheme'),
	                    'all_items' => __( 'All Events Categories', 'mtheme'),
	                    'edit_item' => __( 'Edit Event Category', 'mtheme'),
	                    'update_item' => __( 'Update Event Category', 'mtheme'),
	                    'add_new_item' => __( 'Add New Event Category', 'mtheme'),
	                    'new_item_name' => __( 'New Event Category Name', 'mtheme'),
	            	),
					'rewrite' => array(
						'slug' => __('events', 'mtheme'),
						'hierarchical' => false,
					),
				),
			),
			/*slide Category*/
			array(
				'taxonomy' => 'slide_cat',
				'object_type' => array('slide'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,			
					'labels' => array(
	                    'name' => __( 'Categories', 'mtheme'),
	                    'singular_name' => __( 'Categories', 'mtheme'),
						'menu_name' => __( 'Categories', 'mtheme' ),
	                    'search_items' => __( 'Search Slides', 'mtheme'),
	                    'all_items' => __( 'All Slides Categories', 'mtheme'),
	                    'edit_item' => __( 'Edit Slides Category', 'mtheme'),
	                    'update_item' => __( 'Update Slides Category', 'mtheme'),
	                    'add_new_item' => __( 'Add New Slides Category', 'mtheme'),
	                    'new_item_name' => __( 'New Slides Category Name', 'mtheme'),
	            	),
					'rewrite' => array(
						'slug' => __('slides', 'mtheme'),
						'hierarchical' => false,
					),
				),
			),
			/*Gallery Category*/
			array(
				'taxonomy' => 'gallery_cat',
				'object_type' => array('gallery_slide'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,			
					'labels' => array(
	                    'name' => __( 'Categories', 'mtheme'),
	                    'singular_name' => __( 'Categories', 'mtheme'),
						'menu_name' => __( 'Categories', 'mtheme' ),
	                    'search_items' => __( 'Search Gallery', 'mtheme'),
	                    'all_items' => __( 'All Gallery Categories', 'mtheme'),
	                    'edit_item' => __( 'Edit Gallery Category', 'mtheme'),
	                    'update_item' => __( 'Update Gallery Category', 'mtheme'),
	                    'add_new_item' => __( 'Add New Gallery Category', 'mtheme'),
	                    'new_item_name' => __( 'New Gallery Category Name', 'mtheme'),
	            	),
					'rewrite' => array(
						'slug' => __('gallery_slides', 'mtheme'),
						'hierarchical' => false,
					),
				),
			),
			
			/*Gallery Category*/
			array(
				'taxonomy' => 'carousel_cat',
				'object_type' => array('carousel_slide'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,			
					'labels' => array(
	                    'name' => __( 'Categories', 'mtheme'),
	                    'singular_name' => __( 'Carousel Categories', 'mtheme'),
						'menu_name' => __( 'Categories', 'mtheme' ),
	                    'search_items' => __( 'Search Category', 'mtheme'),
	                    'all_items' => __( 'All Carousel Categories', 'mtheme'),
	                    'edit_item' => __( 'Edit Carousel Category', 'mtheme'),
	                    'update_item' => __( 'Update Carousel Category', 'mtheme'),
	                    'add_new_item' => __( 'Add New Carousel Category', 'mtheme'),
	                    'new_item_name' => __( 'New Carousel Category Name', 'mtheme'),
	            	),
					'rewrite' => array(
						'slug' => __('Carousel_slides', 'mtheme'),
						'hierarchical' => false,
					),
				),
			),
			/*Schedule Category*/
			array(
				'taxonomy' => 'schedule_cat',
				'object_type' => array('schedule'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,			
					'labels' => array(
	                    'name' => __( 'Schedule Categories', 'mtheme'),
	                    'singular_name' => __( 'Schedule Category', 'mtheme'),
						'menu_name' => __( 'Categories', 'mtheme' ),
	                    'search_items' => __( 'Search Schedule Category', 'mtheme'),
	                    'all_items' => __( 'All Schedule Categories', 'mtheme'),
	                    'parent_item' => __( 'Parent Schedule Category', 'mtheme'),
	                    'parent_item_colon' => __( 'Parent Schedule Category', 'mtheme'),
	                    'edit_item' => __( 'Edit Schedule Category', 'mtheme'),
	                    'update_item' => __( 'Update Schedule Category', 'mtheme'),
	                    'add_new_item' => __( 'Add New Schedule Category', 'mtheme'),
	                    'new_item_name' => __( 'New Schedule Category Name', 'mtheme'),
	            	),
					'rewrite' => array(
						'slug' => __('schedules', 'mtheme'),
						'hierarchical' => true,
					),
				),				
				
			),
			/*Speaker Category*/
			array(
				'taxonomy' => 'speaker_cat',
				'object_type' => array('speaker'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,			
					'labels' => array(
	                    'name' => __( 'Speaker Categories', 'mtheme'),
	                    'singular_name' => __( 'Speaker Category', 'mtheme'),
						'menu_name' => __( 'Categories', 'mtheme' ),
	                    'search_items' => __( 'Search Speaker Category', 'mtheme'),
	                    'all_items' => __( 'All Speaker Categories', 'mtheme'),
	                    'parent_item' => __( 'Parent Speaker Category', 'mtheme'),
	                    'parent_item_colon' => __( 'Parent Speaker Category', 'mtheme'),
	                    'edit_item' => __( 'Edit Speaker Category', 'mtheme'),
	                    'update_item' => __( 'Update Speaker Category', 'mtheme'),
	                    'add_new_item' => __( 'Add New Speaker Category', 'mtheme'),
	                    'new_item_name' => __( 'New Speaker Category Name', 'mtheme'),
	            	),
					'rewrite' => array(
						'slug' => __('speakers', 'mtheme'),
						'hierarchical' => true,
					),
				),				
				
			),
			
			/*Package Category*/
			array(
				'taxonomy' => 'package_cat',
				'object_type' => array('package'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,			
					'labels' => array(
	                    'name' => __( 'Package Categories', 'mtheme'),
	                    'singular_name' => __( 'Package Category', 'mtheme'),
						'menu_name' => __( 'Categories', 'mtheme' ),
	                    'search_items' => __( 'Search Package Category', 'mtheme'),
	                    'all_items' => __( 'All Package Categories', 'mtheme'),
	                    'parent_item' => __( 'Parent Package Category', 'mtheme'),
	                    'parent_item_colon' => __( 'Parent Package Category', 'mtheme'),
	                    'edit_item' => __( 'Edit Package Category', 'mtheme'),
	                    'update_item' => __( 'Update Package Category', 'mtheme'),
	                    'add_new_item' => __( 'Add New Package Category', 'mtheme'),
	                    'new_item_name' => __( 'New Package Category Name', 'mtheme'),
	            	),
					'rewrite' => array(
						'slug' => __('packages', 'mtheme'),
						'hierarchical' => true,
					),
				),				
				
			),
			
			/*Sponsor Category*/
			array(
				'taxonomy' => 'sponsor_cat',
				'object_type' => array('sponsor'),
				'settings' => array(
					'hierarchical' => true,
					'show_in_nav_menus' => true,			
					'labels' => array(
	                    'name' => __( 'Sponsor Categories', 'mtheme'),
	                    'singular_name' => __( 'Sponsor Category', 'mtheme'),
						'menu_name' => __( 'Categories', 'mtheme' ),
	                    'search_items' => __( 'Search Sponsor Category', 'mtheme'),
	                    'all_items' => __( 'All Sponsor Categories', 'mtheme'),
	                    'parent_item' => __( 'Parent Sponsor Category', 'mtheme'),
	                    'parent_item_colon' => __( 'Parent Sponsor Category', 'mtheme'),
	                    'edit_item' => __( 'Edit Sponsor Category', 'mtheme'),
	                    'update_item' => __( 'Update Sponsor Category', 'mtheme'),
	                    'add_new_item' => __( 'Add New Sponsor Category', 'mtheme'),
	                    'new_item_name' => __( 'New Sponsor Category Name', 'mtheme'),
	            	),
					'rewrite' => array(
						'slug' => __('sponsors', 'mtheme'),
						'hierarchical' => true,
					),
				),				
				
			),			
		),
		
		/*Meta Boxes*/
		'meta_boxes' => array(
			/*page_event*/
			array(
				'id' => 'page_event',
				'title' =>  __('Page Options', 'mtheme'),
				'page' => 'page',
				'template' => 'default',				
				'context' => 'normal',
				'priority' => 'low',
				'options' => array(	
					array(	
						'name' => __('Hero Background', 'mtheme'),
						'id' => 'event_slider',
						'type' => 'select_post',
						'post_type' => 'event_slider',
						'description' => __('Select Hero Background', 'mtheme'),
					),
					array(	
						'name' => __('Show Page Title', 'mtheme'),
						'id' => 'title',
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'description' => __('Show Page Title', 'mtheme'),
					),
				),			
			),
			/*page_slider*/
			array(
				'id' => 'tel_page_slider',
				'title' =>  __('Page Options', 'mtheme'),
				'page' => 'page',
				'template' => 'template-event-landing.php',				
				'context' => 'normal',
				'priority' => 'low',
				'options' => array(	
					array(	
						'name' => __('Event', 'mtheme'),
						'id' => 'event',
						'type' => 'select_post',
						'post_type' => 'event',
						'description' => __('Select event', 'mtheme'),
					),
				),			
			),
			/*page_event*/
			array(
				'id' => 'fullwidth_page_event',
				'title' =>  __('Page Options', 'mtheme'),
				'page' => 'page',
				'template' => 'template-fullwidth.php',				
				'context' => 'normal',
				'priority' => 'low',
				'options' => array(	
					array(	
						'name' => __('Hero Background', 'mtheme'),
						'id' => 'event_slider',
						'type' => 'select_post',
						'post_type' => 'event_slider',
						'description' => __('Select Hero Background', 'mtheme'),
					),
					array(	
						'name' => __('Show Page Title', 'mtheme'),
						'id' => 'title',
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'description' => __('Show Page Title', 'mtheme'),
					),
				),			
			),
			/*page_event*/
			array(
				'id' => 'te_page_event',
				'title' =>  __('Page Options', 'mtheme'),
				'page' => 'page',
				'template' => 'template-events.php',				
				'context' => 'normal',
				'priority' => 'low',
				'options' => array(	
					array(	
						'name' => __('Hero Background', 'mtheme'),
						'id' => 'event_slider',
						'type' => 'select_post',
						'post_type' => 'event_slider',
						'description' => __('Select Hero Background', 'mtheme'),
					),
				),			
			),
			/*post*/
			array(
				'id' => 'post',
				'title' =>  __('Post Options', 'mtheme'),
				'page' => 'post',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(			
										
					array(
						'name' => __('Post overview', 'mtheme'),
						'id' => 'overview',
						'type' => 'textarea',
						'description' => __('Enter Post overview which displayed on post landing page', 'mtheme'),
					),
					array(	
						'name' => __('Post Type', 'mtheme'),
						'id' => 'type',
						'type' => 'select',
						'default'=> 'image',
						'options' => array(
							'image' => __('Image (Thumbnail)', 'mtheme'),
							'slider' => __('Carousel Slider', 'mtheme'),
							'audio' => __('Audio', 'mtheme'),
							'vimeo' => __('Vimeo', 'mtheme'),
							'html5video' => __('HTML-5-video', 'mtheme'),
							'youtube' => __('Youtube-video', 'mtheme'),
						),
						'defendency-set' => 'on',
					),					
					array(	
						'name' => __('Select Slider Category', 'mtheme'),
						'id' => 'gallery_cat',
						'description' => __('Choose Gallery Slider category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'carousel_cat',
						'defendency' => array('base'=>'_post','parent'=>'tr','id'=>'type','value'=>'slider','show'=>'off'),
						'wrap' => false,
						'group' => 'group',
					),
					array(	
						'name' => __('Audio url', 'mtheme'),
						'id' => 'audio_url',
						'description' => __('Enter Audio url', 'mtheme'),
						'type' => 'uploader',
						'defendency' => array('base'=>'_post','parent'=>'tr','id'=>'type','value'=>'audio','show'=>'off'),
						'wrap' => false,
						'group' => 'group',
					),
					array(	
						'name' => __('HTML-5-Video Url', 'mtheme'),
						'id' => 'html_5_url',
						'description' => __('Please select HTML-5 video url', 'mtheme'),
						'type' => 'uploader',
						'defendency' => array('base'=>'_post','parent'=>'tr','id'=>'type','value'=>'html5video','show'=>'off'),
						'wrap' => false,
						'group' => 'group',
					),					
					array(	
						'name' => __('Youtube Video ID', 'mtheme'),
						'id' => 'youtube_url',
						'description' => __('Please enter Youtube video ID i.e. 9bZkp7q19f0', 'mtheme'),
						'type' => 'text',
						'defendency' => array('base'=>'_post','parent'=>'tr','id'=>'type','value'=>'youtube','show'=>'off'),
						'wrap' => false,
						'group' => 'group',
					),
					array(	
						'name' => __('Vimeo Video ID', 'mtheme'),
						'id' => 'vimeo_url',
						'description' => __('Please enter Vimeo Video ID  i.e. 14663047', 'mtheme'),
						'type' => 'text',
						'defendency' => array('base'=>'_post','parent'=>'tr','id'=>'type','value'=>'vimeo','show'=>'off'),
						'wrap' => false,
						'group' => 'group',
					),
				),			
			),
			/*event_slider*/
			array(
				'id' => 'event_slider',
				'title' =>  __('Hero Background Basic Options', 'mtheme'),
				'page' => 'event_slider',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(	
					
					array(	
						'name' => __('Background Height', 'mtheme'),
						'id' => 'height_type',
						'type' => 'select',
						'default'=> 'auto',
						'options' => array(
							'auto' => __('Auto Height', 'mtheme'),
							'custom' => __('Custom Height', 'mtheme')
						),
						'defendency-set' => 'on',
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Background height(PX)', 'mtheme'),
						'id' => 'height',
						'description' => __('Please enter background height in PX. i.e. 20', 'mtheme'),
						'type' => 'number',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'height_type','value'=>'custom','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Background Type', 'mtheme'),
						'id' => 'type',
						'type' => 'select',
						'default'=> 'image',
						'options' => array(
							'image' => __('Image', 'mtheme'),
							'slider' => __('Gallery Slider', 'mtheme'),
							'html5video' => __('HTML-5-video', 'mtheme'),
							'youtube' => __('Youtube-video', 'mtheme'),
							'vimeo' => __('Vimeo-video', 'mtheme'),
						),
						'defendency-set' => 'on',
						'wrap' => true,
						'group' => 'group',
					),				
					array(	
						'name' => __('Upload Image', 'mtheme'),
						'id' => 'image_url',
						'description' => __('Please Upload Image', 'mtheme'),
						'type' => 'uploader',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'image','show'=>'on'),
						'wrap' => true,
						'group' => 'group',
					),								
					array(	
						'name' => __('Background Zoom effect', 'mtheme'),
						'id' => 'image_url_zoom',
						'description' => __('ON/OFF Background Zoom effect', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'on' => __('ON', 'mtheme'),
							'off' => __('OFF', 'mtheme')
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'image','show'=>'on'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Select Hero Slider Category', 'mtheme'),
						'id' => 'slide_cat',
						'description' => __('Choose Hero Slider category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'slide_cat',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'slider','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Slider Auto Play', 'mtheme'),
						'id' => 'slider_autoplay',
						'description' => __('Is Slider Auto Play', 'mtheme'),
						'type' => 'checkbox',
						'default' => 'true',						
						'defendency-set' => 'on',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'slider','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Hide Navigation Arrow', 'mtheme'),
						'id' => 'slides_nav',
						'description' => __('Is Hide Navigation Arrow', 'mtheme'),
						'type' => 'checkbox',
						'default' => 'true',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'slider','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),					
					array(	
						'name' => __('Slider speed', 'mtheme'),
						'id' => 'slider_speed',
						'description' => __('Slider speed in MS i.e. 5000 (1 Sec)', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1000' => __('1 Second', 'mtheme'),
							'2000' => __('2 Seconds', 'mtheme'),
							'3000' => __('3 Seconds', 'mtheme'),
							'4000' => __('4 Seconds', 'mtheme'),
							'5000' => __('5 Seconds', 'mtheme'),
							'6000' => __('6 Seconds', 'mtheme'),
							'7000' => __('7 Seconds', 'mtheme'),
							'8000' => __('8 Seconds', 'mtheme'),
							'9000' => __('9 Seconds', 'mtheme'),
							'10000' => __('10 Seconds', 'mtheme'),
							'15000' => __('15 Seconds', 'mtheme'),
							'20000' => __('20 Seconds', 'mtheme'),
							'50000' => __('30 Seconds', 'mtheme'),
							'100000' => __('1 Minute', 'mtheme'),
						),
						'default' => '5000',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'slider','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('HTML-5-Video Url', 'mtheme'),
						'id' => 'html_5_url',
						'description' => __('Please select HTML-5 video url', 'mtheme'),
						'type' => 'uploader',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'html5video','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Upload Background Image( for video unsupported browsers)', 'mtheme'),
						'id' => 'html_5_bg_image',
						'description' => __('Please Background Image unsupported browsers', 'mtheme'),
						'type' => 'uploader',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'html5video','show'=>'on'),
						'wrap' => true,
						'group' => 'group',
					),					
					array(	
						'name' => __('Youtube Video ID', 'mtheme'),
						'id' => 'youtube_url',
						'description' => __('Please enter Youtube video ID i.e. 9bZkp7q19f0', 'mtheme'),
						'type' => 'text',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'youtube','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Upload Background Image( for video unsupported browsers)', 'mtheme'),
						'id' => 'youtube_bg_image',
						'description' => __('Please Background Image unsupported browsers', 'mtheme'),
						'type' => 'uploader',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'youtube','show'=>'on'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Vimeo Video ID', 'mtheme'),
						'id' => 'vimeo_url',
						'description' => __('Please enter Vimeo Video ID  i.e. 14663047', 'mtheme'),
						'type' => 'uploader',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'vimeo','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Upload Background Image( for video unsupported browsers)', 'mtheme'),
						'id' => 'vimeo_bg_image',
						'description' => __('Please Background Image unsupported browsers', 'mtheme'),
						'type' => 'uploader',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'vimeo','show'=>'on'),
						'wrap' => true,
						'group' => 'group',
					),					
					array(	
						'name' => __('HTML-5 Video Audio', 'mtheme'),
						'description' => __('Select HTML-5 Video Audio', 'mtheme'),
						'id' => 'html5_video_audio',
						'type' => 'select',
						'options' => array(							
							'play' => __('Paly', 'mtheme'),
							'muted' => __('Mute', 'mtheme')
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'html5video','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Sound Icon ON/OFF', 'mtheme'),
						'description' => __('Select Sound Icon ON/OFF', 'mtheme'),
						'id' => 'html5_sound_icon',
						'type' => 'select',
						'options' => array(		
							'no' => __('No', 'mtheme'),				
							'yes' => __('Yes', 'mtheme')
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'html5video','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),						
					array(	
						'name' => __('Youtube Video Audio', 'mtheme'),
						'description' => __('Select Youtube Video Audio', 'mtheme'),
						'id' => 'youtube_video_audio',
						'type' => 'select',
						'options' => array(							
							'play' => __('Paly', 'mtheme'),
							'muted' => __('Mute', 'mtheme')
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'youtube','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Sound Icon ON/OFF', 'mtheme'),
						'description' => __('Select Sound Icon On/Off', 'mtheme'),
						'id' => 'youtube_sound_icon',
						'type' => 'select',
						'options' => array(		
							'no' => __('No', 'mtheme'),				
							'yes' => __('Yes', 'mtheme')
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'youtube','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Vimeo Video Audio', 'mtheme'),
						'description' => __('Select Youtube Video Audio', 'mtheme'),
						'id' => 'vimeo_video_audio',
						'type' => 'select',
						'options' => array(							
							'play' => __('Paly', 'mtheme'),
							'muted' => __('Mute', 'mtheme')
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'vimeo','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Sound Icon ON/OFF', 'mtheme'),
						'description' => __('Select Sound Icon On/Off', 'mtheme'),
						'id' => 'vimeo_sound_icon',
						'type' => 'select',
						'options' => array(		
							'no' => __('No', 'mtheme'),				
							'yes' => __('Yes', 'mtheme')
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'type','value'=>'vimeo','show'=>'off'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Header Transparent Active', 'mtheme'),
						'description' => __('Header transparent active', 'mtheme'),
						'id' => 'header_transparent',
						'type' => 'checkbox',
						'default' => 'true',
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Image Overlay Active', 'mtheme'),
						'description' => __('Image overlay active', 'mtheme'),
						'id' => 'overlay_active',
						'type' => 'checkbox',
						'default' => 'true',
						'defendency-set' => 'on',
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Overlay Image', 'mtheme'),
						'id' => 'overlay_image',
						'description' => __('Choose Overlay Image', 'mtheme'),
						'type' => 'uploader',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'overlay_active','value'=>'true','show'=>'on'),
						'wrap' => true,
						'default'=> CHILD_URI.'site/img/backgrounds/bg_pattern.png',
						'group' => 'group',
					),
					array(	
						'name' => __('Background Effect', 'mtheme'),
						'description' => __('Select Background effect', 'mtheme'),
						'id' => 'effect',
						'type' => 'select',
						'options' => array(							
							'none' => __('None', 'mtheme'),
							'astronomy' => __('Astronomy', 'mtheme'),
							'rain' => __('Rainy Days', 'mtheme'),
							'snow' => __('Snow Fall', 'mtheme'),
							'triangle' => __('Triangle', 'mtheme'),
						),
						'defendency-set' => 'on',
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('Snow Fall Effect Image', 'mtheme'),
						'description' => __('Browse Snow Fall Effect Image', 'mtheme'),
						'id' => 'snow_img',
						'type' => 'uploader',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'effect','value'=>'snow','show'=>'off'),
						'wrap' => true,
						'group' => 'group'
					),			
					array(	
						'name' => __('Astronomy Effect dot color', 'mtheme'),
						'default' => '#919191',
						'id' => 'dotColor',
						'type' => 'color',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'effect','value'=>'astronomy','show'=>'off'),
						'wrap' => true,
						'group' => 'group'
					),
					array(	
						'name' => __('Astronomy Effect line color', 'mtheme'),
						'default' => '#919191',
						'id' => 'lineColor',
						'type' => 'color',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'effect','value'=>'astronomy','show'=>'off'),
						'wrap' => true,
						'group' => 'group'
					),
					array(	
						'name' => __('Astronomy Effect line width', 'mtheme'),
						'description' => __('Enter Astronomy Effect line width i.e. 0.51 OR 1.2', 'mtheme'),
						'id' => 'lineWidth',
						'type' => 'text',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'effect','value'=>'astronomy','show'=>'off'),
						'wrap' => true,
						'group' => 'group'
					),
					array(	
						'name' => __('Astronomy Effect particle radius', 'mtheme'),
						'description' => __('Enter Astronomy Effect particle radius in number ex: 3', 'mtheme'),
						'id' => 'particleRadius',
						'type' => 'text',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'effect','value'=>'astronomy','show'=>'off')
					)
				)
			),
			/*event_slider*/
			array(
				'id' => 'event_slider_content',
				'title' =>  __('Hero Background Content Options', 'mtheme'),
				'page' => 'event_slider',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(	
					array(	
						'name' => __('Landing Text Position Padding Top', 'mtheme'),
						'description' => __('Select Landing Text Padding Top', 'mtheme'),
						'id' => 'landing_text_padding_top',
						'type' => 'select',
						'options' => array(							
							'5' => __('5%', 'mtheme'),
							'6' => __('6%', 'mtheme'),
							'7' => __('7%', 'mtheme'),
							'8' => __('8%', 'mtheme'),
							'9' => __('9%', 'mtheme'),
							'10' => __('10%', 'mtheme'),
							'11' => __('11%', 'mtheme'),
							'12' => __('12%', 'mtheme'),
							'13' => __('13%', 'mtheme'),
							'14' => __('14%', 'mtheme'),
							'15' => __('15%', 'mtheme'),
							'16' => __('16%', 'mtheme'),
							'17' => __('17%', 'mtheme'),
							'18' => __('18%', 'mtheme'),
							'19' => __('19%', 'mtheme'),
							'20' => __('20%', 'mtheme'),
							'21' => __('21%', 'mtheme'),
							'22' => __('22%', 'mtheme'),
							'23' => __('23%', 'mtheme'),
							'24' => __('24%', 'mtheme'),
							'25' => __('25%', 'mtheme'),
							'26' => __('26%', 'mtheme'),
							'27' => __('27%', 'mtheme'),
							'28' => __('28%', 'mtheme'),
							'29' => __('29%', 'mtheme'),
							'30' => __('30%', 'mtheme'),
							'31' => __('31%', 'mtheme'),
							'32' => __('32%', 'mtheme'),
							'33' => __('33%', 'mtheme'),
							'34' => __('34%', 'mtheme'),
							'35' => __('35%', 'mtheme'),
							'36' => __('36%', 'mtheme'),
							'37' => __('37%', 'mtheme'),
							'38' => __('38%', 'mtheme'),
							'39' => __('39%', 'mtheme'),
							'40' => __('40%', 'mtheme')
						),
						'default' => '35'
					),  
					array(
						'name' => __('Content Alignment', 'mtheme'),
						'description' => __('Select Alignment', 'mtheme'),
						'id' => 'alignment',
						'type' => 'select',
						'options' => array(		
							'align-left' => __('Left', 'mtheme'),
							'align-center' => __('Center', 'mtheme')
						),
						'default' => 'align-center'
					),
					array(
						'name' => __('Icon Option', 'mtheme'),
						'id' => 'slider_icon_option',
						'type' => 'checkbox',
						'description' => __('Select Icon Option Yes/No', 'mtheme'),
						'default' => 'false',
						'defendency-set' => 'on'
					),
					array(	
						'name' => __('Icon Padding Top', 'mtheme'),
						'description' => __('Select Icon Padding Top', 'mtheme'),
						'id' => 'icon_padding_top',
						'type' => 'select',
						'options' => array(			
							'0' => __('0px', 'mtheme'),					
							'5' => __('5px', 'mtheme'),
							'10' => __('10px', 'mtheme'),
							'15' => __('15px', 'mtheme'),
							'20' => __('20px', 'mtheme'),
							'25' => __('25px', 'mtheme'),
							'30' => __('30px', 'mtheme'),
							'35' => __('35px', 'mtheme'),
							'40' => __('40px', 'mtheme'),
							'45' => __('45px', 'mtheme'),
							'50' => __('50px', 'mtheme'),
							'55' => __('55px', 'mtheme'),
							'60' => __('60px', 'mtheme'),
							'65' => __('65px', 'mtheme'),
							'70' => __('70px', 'mtheme')
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_icon_option','value'=>'true','show'=>'on'),
						'default' => '15'
					), 
					array(	
						'name' => __('Select Icon', 'mtheme'),
						'description' => __('Select Icon Option', 'mtheme'),
						'id' => 'icon_title',
						'type' => 'icon_picker',
						'wrap' => true,
						'group' => 'group',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_icon_option','value'=>'true','show'=>'on')
					),
					array(
						'name' => __('Icon Background Option', 'mtheme'),
						'id' => 'icon_bg_option',
						'type' => 'select',
						'description' => __('Select Icon Background Option', 'mtheme'),
						'options' => array(			
							'icon-bg-none' => __('None', 'mtheme'),
							'icon-bg-circle' => __('Circle', 'mtheme'),
							'icon-bg-square' => __('Square', 'mtheme')
							
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_icon_option','value'=>'true','show'=>'on')
					),
					array(
						'name' => __('Icon Background Color', 'mtheme'),
						'id' => 'icon_bg_color',
						'type' => 'color',
						'description' => __('Select Icon Background Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_icon_option','value'=>'true','show'=>'on')
					),
					array(
						'name' => __('Icon Font Color', 'mtheme'),
						'id' => 'icon_font_color',
						'type' => 'color',
						'description' => __('Select Icon Font Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_icon_option','value'=>'true','show'=>'on')
					),
					array(
						'name' => __('Heading Option', 'mtheme'),
						'id' => 'slider_heading_option',
						'type' => 'checkbox',
						'default' => 'true',
						'description' => __('Select Heading Option', 'mtheme'),
						'defendency-set' => 'on'
					),
					array(	
						'name' => __('Heading Padding Top', 'mtheme'),
						'description' => __('Select Heading Padding Top', 'mtheme'),
						'id' => 'heading_padding_top',
						'type' => 'select',
						'options' => array(			
							'0' => __('0px', 'mtheme'),					
							'5' => __('5px', 'mtheme'),
							'10' => __('10px', 'mtheme'),
							'15' => __('15px', 'mtheme'),
							'20' => __('20px', 'mtheme'),
							'25' => __('25px', 'mtheme'),
							'30' => __('30px', 'mtheme'),
							'35' => __('35px', 'mtheme'),
							'40' => __('40px', 'mtheme'),
							'45' => __('45px', 'mtheme'),
							'50' => __('50px', 'mtheme'),
							'55' => __('55px', 'mtheme'),
							'60' => __('60px', 'mtheme'),
							'65' => __('65px', 'mtheme'),
							'70' => __('70px', 'mtheme')
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_heading_option','value'=>'true','show'=>'on'),
						'default' => '15'
					),
					array(
						'name' => __('Heading Font Size', 'mtheme'),
						'id' => 'heading_font_style',
						'type' => 'select',
						'description' => __('Select Heading Font Size', 'mtheme'),
						'options' => array(							
							'h1' => __('H1', 'mtheme'),
							'h2' => __('H2', 'mtheme'),
							'h3' => __('H3', 'mtheme'),
							'h4' => __('H4', 'mtheme'),
							'h5' => __('H5', 'mtheme'),
							'h6' => __('H6', 'mtheme')
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_heading_option','value'=>'true','show'=>'on')
					),
					array(
						'name' => __('Heading Text Transform', 'mtheme'),
						'description' => __('Select Heading Text Transform', 'mtheme'),
						'id' => 'heading_text_transform',
						'type' => 'select',
						'options' => array(		
							'capitalize' => __('Capitalize', 'mtheme'),
							'uppercase' => __('Uppercase', 'mtheme'),
							'lowercase' => __('Lowercase', 'mtheme')							
						),
						'default'=>'uppercase',						
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_heading_option','value'=>'true','show'=>'on')
					),
					array(
						'name' => __('Heading Font Style', 'mtheme'),
						'id' => 'heading_font_type',
						'type' => 'select',
						'description' => __('Select Heading Font Style', 'mtheme'),
						'options' => array(		
							'normal' => __('Normal', 'mtheme'),
							'italic' => __('Italic', 'mtheme'),
							'oblique' => __('Oblique', 'mtheme')
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_heading_option','value'=>'true','show'=>'on')
					),					
					array(
						'name' => __('Heading Font Color', 'mtheme'),
						'id' => 'heading_font_color',
						'type' => 'color',
						'default' => 'true',
						'description' => __('Select Heading Font Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_heading_option','value'=>'true','show'=>'on')
					),
					array(	
						'name' => __('Enter Heading', 'mtheme'),
						'description' => __('Enter Slider Heading', 'mtheme'),
						'id' => 'title',
						'type' => 'text',
						'default' => 'Welcome To Multia',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_heading_option','value'=>'true','show'=>'on'),
						'wrap' => true,
						'group' => 'group',
					),
					array(
						'name' => __('HR Option', 'mtheme'),
						'id' => 'hr_option',
						'type' => 'checkbox',
						'default' => 'true',
						'description' => __('Select Hr option Yes/No', 'mtheme'),
						'defendency-set' => 'on'
					),
					array(	
						'name' => __('HR Width Size (%)', 'mtheme'),
						'description' => __('Enter HR Width Size (%)', 'mtheme'),
						'id' => 'hr_width',
						'type' => 'number',
						'default' => '3',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'hr_option','value'=>'true','show'=>'on'),
						'wrap' => true,
						'group' => 'group',
					),
					array(
						'name' => __('HR Color', 'mtheme'),
						'id' => 'hr_color',
						'type' => 'color',
						'description' => __('Select Hr Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'hr_option','value'=>'true','show'=>'on')
					),
					array(	
						'name' => __('HR Border Width (PX)', 'mtheme'),
						'description' => __('Enter HR Border Width (PX)', 'mtheme'),
						'id' => 'hr_border_width',
						'type' => 'number',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'hr_option','value'=>'true','show'=>'on'),
						'wrap' => true,
						'group' => 'group',
					),
					array(	
						'name' => __('HR Border Type', 'mtheme'),
						'id' => 'hr_border_type',
						'type' => 'select',
						'options' => array(			
							'solid' => __('Solid', 'mtheme'),
							'ridge' => __('Ridge', 'mtheme'),				
							'groove' => __('Groove', 'mtheme'),
							'double' => __('Double', 'mtheme'),
							'dashed' => __('Dashed', 'mtheme'),
						),
						'description' => __('Select HR Border Type', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'hr_option','value'=>'true','show'=>'on')
					),
					array(
						'name' => __('Content Option', 'mtheme'),
						'id' => 'slider_content_option',
						'type' => 'checkbox',
						'default' => 'true',
						'description' => __('Select Content Option', 'mtheme'),
						'defendency-set' => 'on'
					),
					array(	
						'name' => __('Content Padding Top', 'mtheme'),
						'description' => __('Select Content Padding Top', 'mtheme'),
						'id' => 'content_padding_top',
						'type' => 'select',
						'options' => array(	
							'0' => __('0px', 'mtheme'),
							'5' => __('5px', 'mtheme'),
							'10' => __('10px', 'mtheme'),
							'15' => __('15px', 'mtheme'),
							'20' => __('20px', 'mtheme'),
							'25' => __('25px', 'mtheme'),
							'30' => __('30px', 'mtheme'),
							'35' => __('35px', 'mtheme'),
							'40' => __('40px', 'mtheme'),
							'45' => __('45px', 'mtheme'),
							'50' => __('50px', 'mtheme'),
							'55' => __('55px', 'mtheme'),
							'60' => __('60px', 'mtheme'),
							'65' => __('65px', 'mtheme'),
							'70' => __('70px', 'mtheme')
						),
						'default' => '15',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_content_option','value'=>'true','show'=>'on')
					),
					array(
						'name' => __('Content Font Size', 'mtheme'),
						'id' => 'content_font_style',
						'type' => 'select',
						'description' => __('Select Content Font Size', 'mtheme'),
						'options' => array(							
							'h1' => __('H1', 'mtheme'),
							'h2' => __('H2', 'mtheme'),
							'h3' => __('H3', 'mtheme'),
							'h4' => __('H4', 'mtheme'),
							'h5' => __('H5', 'mtheme'),
							'h6' => __('H6', 'mtheme')
						),
						'default' => 'h2',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_content_option','value'=>'true','show'=>'on')
					),
					array(
						'name' => __('Content Text Transform', 'mtheme'),
						'description' => __('Select Content Text Transform', 'mtheme'),
						'id' => 'content_text_transform',
						'type' => 'select',
						'options' => array(		
							'capitalize' => __('Capitalize', 'mtheme'),
							'uppercase' => __('Uppercase', 'mtheme'),
							'lowercase' => __('Lowercase', 'mtheme')							
						),
						'default'=>'uppercase',						
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_content_option','value'=>'true','show'=>'on')
					),
					array(
						'name' => __('Content Font Style', 'mtheme'),
						'id' => 'content_font_type',
						'type' => 'select',
						'description' => __('Select Content Font Style', 'mtheme'),
						'options' => array(		
						'normal' => __('Normal', 'mtheme'),
						'italic' => __('Italic', 'mtheme'),
						'oblique' => __('Oblique', 'mtheme')
						),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_content_option','value'=>'true','show'=>'on')
					),
					array(
						'name' => __('Content Font Color', 'mtheme'),
						'id' => 'content_font_color',
						'type' => 'color',
						'description' => __('Select Content Font Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_content_option','value'=>'true','show'=>'on')
					),
					array(	
						'name' => __('Enter Content', 'mtheme'),
						'description' => __('Enter Slider Content', 'mtheme'),
						'id' => 'content',
						'type' => 'textarea',
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'slider_content_option','value'=>'true','show'=>'on'),						
						'default' => 'We Design for Tomorrow.'
					)	
					
				)
			),
			/*event_slider*/
			array(
				'id' => 'event_slider_coming',
				'title' =>  __('Hero Background Coming-Soon Options', 'mtheme'),
				'page' => 'event_slider',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(	
					array(	
						'name' => __('Slider Date Option', 'mtheme'),
						'description' => __('Select Slider Date Option', 'mtheme'),
						'id' => 'coming_soon',
						'type' => 'checkbox'
					),
					array(	
						'name' => __('Slider Date Padding Top', 'mtheme'),
						'description' => __('Select Slider Date Padding Top', 'mtheme'),
						'id' => 'slider_date_padding_top',
						'type' => 'select',
						'options' => array(		
							'0' => __('0px', 'mtheme'),						
							'5' => __('5px', 'mtheme'),
							'10' => __('10px', 'mtheme'),
							'15' => __('15px', 'mtheme'),
							'20' => __('20px', 'mtheme'),
							'25' => __('25px', 'mtheme'),
							'30' => __('30px', 'mtheme'),
							'35' => __('35px', 'mtheme'),
							'40' => __('40px', 'mtheme'),
							'45' => __('45px', 'mtheme'),
							'50' => __('50px', 'mtheme'),
							'55' => __('55px', 'mtheme'),
							'60' => __('60px', 'mtheme'),
							'65' => __('65px', 'mtheme'),
							'70' => __('70px', 'mtheme')
						),
						'default' => '15'
					),  
					array(	
						'name' => __('Slider Date', 'mtheme'),
						'description' => __('Enter Slider Date', 'mtheme'),
						'id' => 'date',
						'type' => 'text',						
						'class' => 'select_date',
						'wrap' => true,
						'group' => 'group'
					),
					array(	
						'name' => __('Slider Date Background Transparent', 'mtheme'),
						'description' => __('Select Slider Date Background Transparent Yes/No', 'mtheme'),
						'id' => 'date_background_transparent',
						'type' => 'checkbox',
						'default' => 'true',
						'defendency-set' => 'on'
					),
					array(
						'name' => __('Slider Date Background Color', 'mtheme'),
						'id' => 'event_date_background_color',
						'type' => 'color',
						'description' => __('Select Slider Date Background Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'date_background_transparent','value'=>'false','show'=>'off')
					),
					array(
						'name' => __('Slider Date Text Color', 'mtheme'),
						'id' => 'event_date_text_color',
						'type' => 'color',
						'description' => __('Select Slider Date Text Color', 'mtheme')
					),
					array(
						'name' => __('Slider Date Text Transform', 'mtheme'),
						'description' => __('Select Slider Date Text Transform', 'mtheme'),
						'id' => 'event_date_text_transform',
						'type' => 'select',
						'options' => array(		
							'capitalize' => __('Capitalize', 'mtheme'),
							'uppercase' => __('Uppercase', 'mtheme'),
							'lowercase' => __('Lowercase', 'mtheme')							
						),				
						'default'=>'uppercase'						
					),
					array(
						'name' => __('Slider Date Number Color', 'mtheme'),
						'id' => 'event_date_font_color',
						'type' => 'color',
						'description' => __('Select Slider Date Number Color', 'mtheme')
					),
					array(	
						'name' => __('Slider Date Background Style', 'mtheme'),
						'description' => __('Select Slider Date Background Style', 'mtheme'),
						'id' => 'event_date_border_radius',
						'type' => 'select',
						'options' => array(		
							'simple' => __('Transparent', 'mtheme'),
							'50%' => __('Circle', 'mtheme'),
							'0%' => __('Square', 'mtheme')
						),
						
					),
					array(	
						'name' => __('Slider Date Border', 'mtheme'),
						'id' => 'event_date_border',
						'type' => 'select',
						'options' => array(			
							'none' => __('None', 'mtheme'),
							'1px' => __('Small', 'mtheme'),				
							'2px' => __('Normal', 'mtheme'),
							'3px' => __('Large', 'mtheme'),
							'4px' => __('Ex-Large', 'mtheme'),
						),
						'description' => __('Select Slider Date Border Width', 'mtheme')
					),
					array(	
						'name' => __('Slider Date Border Type', 'mtheme'),
						'id' => 'event_date_border_type',
						'type' => 'select',
						'options' => array(			
							'solid' => __('Solid', 'mtheme'),
							'ridge' => __('Ridge', 'mtheme'),				
							'groove' => __('Groove', 'mtheme'),
							'double' => __('Double', 'mtheme'),
							'dashed' => __('Dashed', 'mtheme'),
						),
						'description' => __('Select Slider Date Border Type', 'mtheme')
					),
					array(
						'name' => __('Slider Date Border Color', 'mtheme'),
						'id' => 'event_date_border_color',
						'type' => 'color',
						'description' => __('Select Slider Date Border Color', 'mtheme')
					)
				)
			),
			/*event_slider*/
			array(
				'id' => 'event_slider_notify_form',
				'title' =>  __('Hero Background Notify-form Options', 'mtheme'),
				'page' => 'event_slider',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(	
					array(	
						'name' => __('Notify Form Style', 'mtheme'),
						'description' => __('Select Notify Form Yes/No', 'mtheme'),
						'id' => 'notify_form_option',
						'type' => 'checkbox',
						'default' => 'false'
					),
					array(	
						'name' => __('Notify Form Padding Top', 'mtheme'),
						'description' => __('Select Notify Form Padding Top', 'mtheme'),
						'id' => 'notify_form_padding_top',
						'type' => 'select',
						'options' => array(		
							'0' => __('0px', 'mtheme'),						
							'5' => __('5px', 'mtheme'),
							'10' => __('10px', 'mtheme'),
							'15' => __('15px', 'mtheme'),
							'20' => __('20px', 'mtheme'),
							'25' => __('25px', 'mtheme'),
							'30' => __('30px', 'mtheme'),
							'35' => __('35px', 'mtheme'),
							'40' => __('40px', 'mtheme'),
							'45' => __('45px', 'mtheme'),
							'50' => __('50px', 'mtheme'),
							'55' => __('55px', 'mtheme'),
							'60' => __('60px', 'mtheme'),
							'65' => __('65px', 'mtheme'),
							'70' => __('70px', 'mtheme')
						),
						'default' => '15'
					),
					array(	
						'name' => __('Notify Form Style', 'mtheme'),
						'description' => __('Select Notify Form Style', 'mtheme'),
						'id' => 'notify_style',
						'type' => 'select',
						'options' => array(							
							'style1' => __('Style1', 'mtheme'),
							'style2' => __('Style2', 'mtheme')
						),
						
					),
					array(	
						'name' => __('Notify Form No Of Column', 'mtheme'),
						'description' => __('Select Notify Form No of Column', 'mtheme'),
						'id' => 'notify_form_column',
						'type' => 'select',
						'options' => array(							
							'1' => __('Column1', 'mtheme'),
							'2' => __('Column2', 'mtheme'),
							'3' => __('Column3', 'mtheme'),
							'4' => __('Column4', 'mtheme'),
							'5' => __('Column5', 'mtheme'),
							'6' => __('Column6', 'mtheme'),
							'7' => __('Column7', 'mtheme'),
							'8' => __('Column8', 'mtheme'),
							'9' => __('Column9', 'mtheme'),
							'10' => __('Column10', 'mtheme'),
							'11' => __('Column11', 'mtheme'),
							'12' => __('Column12', 'mtheme')
						),
						'default' => '6'
					),
					array(
						'name' => __('Notify Form Heading', 'mtheme'),
						'id' => 'notify_form_heading',
						'type' => 'text',
						'description' => __('Pleae Enter Notify Form Heading', 'mtheme'),
						'default' => 'For Updates get notified'
					),
					array(
						'name' => __('Notify Form Text Color', 'mtheme'),
						'id' => 'notify_font_color',
						'type' => 'color',
						'description' => __('Select Notify Form Text Color', 'mtheme')
					),
					array(	
						'name' => __('Notify Button Title', 'mtheme'),
						'description' => __('Enter Notify Button title', 'mtheme'),
						'id' => 'notify_button_heading',
						'type' => 'text',
						'default' => 'Subscribe'
					),
					array(	
						'name' => __('Notify Form Button Background Color', 'mtheme'),
						'id' => 'notify_button_background_color',
						'type' => 'color',
						'description' => __('Select Notify Form Button Background Color', 'mtheme')
					)
				)
			),	
			/*event_slider*/
			array(
				'id' => 'event_slider_button',
				'title' =>  __('Hero Background Button Options', 'mtheme'),
				'page' => 'event_slider',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(	
					array(	
						'name' => __('Show Button', 'mtheme'),
						'description' => __('Select Button Option Yes/No', 'mtheme'),
						'id' => 'first_button_option',
						'type' => 'checkbox',
						'default' => 'true',
					),
					array(	
						'name' => __('Button Padding Top', 'mtheme'),
						'description' => __('Select Button Padding Top', 'mtheme'),
						'id' => 'button_padding_top',
						'type' => 'select',
						'options' => array(			
							'0' => __('0px', 'mtheme'),					
							'5' => __('5px', 'mtheme'),
							'10' => __('10px', 'mtheme'),
							'15' => __('15px', 'mtheme'),
							'20' => __('20px', 'mtheme'),
							'25' => __('25px', 'mtheme'),
							'30' => __('30px', 'mtheme'),
							'35' => __('35px', 'mtheme'),
							'40' => __('40px', 'mtheme'),
							'45' => __('45px', 'mtheme'),
							'50' => __('50px', 'mtheme'),
							'55' => __('55px', 'mtheme'),
							'60' => __('60px', 'mtheme'),
							'65' => __('65px', 'mtheme'),
							'70' => __('70px', 'mtheme')
						),
						'default' => '30'
					),  
					array(	
						'name' => __('Button Title', 'mtheme'),
						'description' => __('Enter Button Title', 'mtheme'),
						'id' => 'event_link_title',
						'type' => 'text',
						'default' => 'Register'
					),
					array(
						'name' => __('Button Size', 'mtheme'),
						'description' => __('Select Button Size Type', 'mtheme'),
						'id' => 'button_size',
						'type' => 'select',
						'options' => array(							
							'large' => __('Large Button', 'mtheme'),
							'xlarge' => __('Extra Large Button', 'mtheme'),
							'mini' => __('Mini Button', 'mtheme'),
							'small' => __('Small Button', 'mtheme'),
							'medium' => __('Medium Button', 'mtheme')
						),
						'default' => 'large',
					),
					array(
						'name' => __('Button Text Transform', 'mtheme'),
						'description' => __('Select Button Text Transform', 'mtheme'),
						'id' => 'button_text_transform',
						'type' => 'select',
						'options' => array(		
						'capitalize' => __('Capitalize', 'mtheme'),
							'uppercase' => __('Uppercase', 'mtheme'),
							'lowercase' => __('Lowercase', 'mtheme')
						),
						'default'=>'uppercase'
					),
					array(	
						'name' => __('Button Background Transparent', 'mtheme'),
						'description' => __('Is Button Background Transparent', 'mtheme'),
						'id' => 'first_button_transpermt_option',
						'type' => 'checkbox',
						'default' => 'false',
						'defendency-set' => 'on'
					),
					array(	
						'name' => __('Button Background Color', 'mtheme'),
						'id' => 'button_color',
						'type' => 'color',
						'description' => __('Select Button Background Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'first_button_transpermt_option','value'=>'false','show'=>'off') 
					),
					array(
						'name' => __('Button Font Color', 'mtheme'),
						'id' => 'button_font_color',
						'type' => 'color',
						'description' => __('Select Button Font Color', 'mtheme')
					),
					array(	
						'name' => __('Button Border', 'mtheme'),
						'id' => 'button_border',
						'type' => 'select',
						'options' => array(			
							'none' => __('None', 'mtheme'),
							'1px' => __('Small', 'mtheme'),				
							'2px' => __('Normal', 'mtheme'),
							'3px' => __('Large', 'mtheme'),
							'4px' => __('Ex-Large', 'mtheme'),
						),
						'description' => __('Select Button Border Size', 'mtheme')
					),
					array(	
						'name' => __('Button Border Type', 'mtheme'),
						'id' => 'button_border_type',
						'type' => 'select',
						'options' => array(			
							'solid' => __('Solid', 'mtheme'),
							'ridge' => __('Ridge', 'mtheme'),				
							'groove' => __('Groove', 'mtheme'),
							'double' => __('Double', 'mtheme'),
							'dashed' => __('Dashed', 'mtheme'),
						),
						'description' => __('Select Button Border Type', 'mtheme')
					),
					array(	
						'name' => __('Button Border Radius', 'mtheme'),
						'id' => 'button_border_radius',
						'type' => 'select',
						'options' => array(								
							'none' => __('None', 'mtheme'),
							'small' => __('Small', 'mtheme'),				
							'normal' => __('Normal', 'mtheme'),
							'large' => __('Large', 'mtheme')				
						),
						'description' => __('Select Button Border Radius Type', 'mtheme'),
						'default' => 'none'
					),
					array(
						'name' => __('Button Border Color', 'mtheme'),
						'id' => 'button_border_color',
						'type' => 'color',
						'description' => __('Select Button Border Color', 'mtheme')
					),
					array(	
						'name' => __('Button Hover Active', 'mtheme'),
						'description' => __('Select Button Hover Background Transparent Option', 'mtheme'),
						'id' => 'first_button_hover_transpermt_option',
						'type' => 'checkbox',
						'default' => 'true',
						'defendency-set' => 'on'
					),
					array(
						'name' => __('Button Hover Background Color', 'mtheme'),
						'id' => 'button_hover_bg_color',
						'type' => 'color',
						'description' => __('Select Button Hover Background Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'first_button_hover_transpermt_option','value'=>'true','show'=>'on') 
					),
					array(
						'name' => __('Button Hover Font Color', 'mtheme'),
						'id' => 'button_hover_font_color',
						'type' => 'color',
						'description' => __('Select Button Hover Font Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'first_button_hover_transpermt_option','value'=>'true','show'=>'on') 
					),
					array(
						'name' => __('Button Hover Border Color', 'mtheme'),
						'id' => 'button_hover_border_color',
						'type' => 'color',
						'description' => __('Select Button Hover Border Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'first_button_hover_transpermt_option','value'=>'true','show'=>'on') 
					),
					array(	
						'name' => __('Button Href Link', 'mtheme'),
						'description' => __('Enter Button Href Link', 'mtheme'),
						'id' => 'event_link',
						'type' => 'text',				
						'default' => 'http://multiathemes.com/'
					),
				)
			),
			/*event_slider*/
			array(
				'id' => 'event_slider_second_button',
				'title' =>  __('Hero Background Second Button Options', 'mtheme'),
				'page' => 'event_slider',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(	
					array(
						'name' => __('Show Button', 'mtheme'),
						'id' => 'second_button_option',
						'description' => __('Select Button Option Yes/No', 'mtheme'),
						'type' => 'checkbox',
						'default' => 'false'
					),	
					array(	
						'name' => __('Title', 'mtheme'),
						'description' => __('Enter Title', 'mtheme'),
						'id' => 'second_event_link_title',
						'type' => 'text',
						'default' => 'Register'
					),
					array(
						'name' => __('Type', 'mtheme'),
						'description' => __('Select Type', 'mtheme'),
						'id' => 'second_button_size',
						'type' => 'select',
						'options' => array(							
							'large' => __('Large Button', 'mtheme'),
							'xlarge' => __('Extra Large Button', 'mtheme'),
							'mini' => __('Mini Button', 'mtheme'),
							'small' => __('Small Button', 'mtheme'),
							'medium' => __('Medium Button', 'mtheme')
						),
					),
					array(
						'name' => __('Text Transform', 'mtheme'),
						'description' => __('Select Text Transform Option', 'mtheme'),
						'id' => 'second_button_text_transform',
						'type' => 'select',
						'options' => array(		
						'capitalize' => __('Capitalize', 'mtheme'),
							'uppercase' => __('Uppercase', 'mtheme'),
							'lowercase' => __('Lowercase', 'mtheme')
						),			
						'default'=>'uppercase'
					),
					array(	
						'name' => __('Background Transparent Option', 'mtheme'),
						'description' => __('Select Button Background Transparent Option', 'mtheme'),
						'id' => 'second_button_transpermt_option',
						'type' => 'checkbox',
						'default' => 'false',
						'defendency-set' => 'on'
					),
					array(	
						'name' => __('Background Color', 'mtheme'),
						'id' => 'second_button_color',
						'type' => 'color',
						'description' => __('Select Background Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'second_button_transpermt_option','value'=>'false','show'=>'off')
					),
					array(
						'name' => __('Font Color', 'mtheme'),
						'id' => 'second_button_font_color',
						'type' => 'color',
						'description' => __('Select Font Color', 'mtheme')
					),
					array(	
						'name' => __('Border', 'mtheme'),
						'id' => 'second_button_border',
						'type' => 'select',
						'options' => array(			
							'none' => __('None', 'mtheme'),
							'1px' => __('Small', 'mtheme'),				
							'2px' => __('Normal', 'mtheme'),
							'3px' => __('Large', 'mtheme'),
							'4px' => __('Ex-Large', 'mtheme'),
						),
						'default' => "none",
						'description' => __('Select Border Size', 'mtheme')
					),
					array(	
						'name' => __('Border Type', 'mtheme'),
						'id' => 'second_button_border_type',
						'type' => 'select',
						'options' => array(			
							'solid' => __('Solid', 'mtheme'),
							'ridge' => __('Ridge', 'mtheme'),				
							'groove' => __('Groove', 'mtheme'),
							'double' => __('Double', 'mtheme'),
							'dashed' => __('Dashed', 'mtheme'),
						),
						'description' => __('Select Border Type', 'mtheme')
					),
					array(	
						'name' => __('Border Radius', 'mtheme'),
						'id' => 'second_button_border_radius',
						'type' => 'select',
						'options' => array(	
							'none' => __('None', 'mtheme'),
							'small' => __('Small', 'mtheme'),				
							'normal' => __('Normal', 'mtheme'),
							'large' => __('Large', 'mtheme')				
						),
						'description' => __('Select Border Radius', 'mtheme')
					),
					array(
						'name' => __('Border Color', 'mtheme'),
						'id' => 'second_button_border_color',
						'type' => 'color',
						'description' => __('Select Border Color', 'mtheme')
					),
					array(	
						'name' => __('Hover Active', 'mtheme'),
						'description' => __('Select Hover Background Transparent Option', 'mtheme'),
						'id' => 'second_button_hover_transpermt_option',
						'type' => 'checkbox',
						'default' => 'true',
						'defendency-set' => 'on'
					),
					array(
						'name' => __('Hover Background Color', 'mtheme'),
						'id' => 'second_button_hover_bg_color',
						'type' => 'color',
						'description' => __('Select Hover Background Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'second_button_hover_transpermt_option','value'=>'true','show'=>'on') 
					),
					array(
						'name' => __('Hover Font Color', 'mtheme'),
						'id' => 'second_button_hover_font_color',
						'type' => 'color',
						'description' => __('Select Hover Font Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'second_button_hover_transpermt_option','value'=>'true','show'=>'on') 
					),
					array(
						'name' => __('Hover Border Color', 'mtheme'),
						'id' => 'second_button_hover_border_color',
						'type' => 'color',
						'description' => __('Select Hover Border Color', 'mtheme'),
						'defendency' => array('base'=>'_event_slider','parent'=>'tr','id'=>'second_button_hover_transpermt_option','value'=>'true','show'=>'on') 
					),
					array(	
						'name' => __('Href Link', 'mtheme'),
						'description' => __('Enter Href Link', 'mtheme'),
						'id' => 'second_event_link',
						'type' => 'text',				
						'default' => 'http://multiathemes.com/'
					)
				)	
			),
			/*event*/
			array(
				'id' => 'event',
				'title' =>  __('About Event', 'mtheme'),
				'page' => 'event',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(	
					array(	
						'name' => __('Background Image', 'mtheme'),
						'description' => __('Choose an background image or color', 'mtheme'),
						'id' => 'event_bg_img',
						'type' => 'uploader'
					),
					array(	
						'name' => __('Background color', 'mtheme'),
						'description' => __('Choose an background color or image', 'mtheme'),
						'id' => 'bg_color',
						'type' => 'color',
						'default' => '#ffffff',
					),
					array(	
						'name' => __('Event Heading', 'mtheme'),
						'description' => __('Enter Event Heading', 'mtheme'),
						'id' => 'event_title',
						'type' => 'text',
					),
					array(	
						'name' => __('Heading color', 'mtheme'),
						'description' => __('Choose an Heading color', 'mtheme'),
						'id' => 'heading_color',
						'type' => 'color',
						'default' => '#363738',
					),					
					
					array(	
						'name' => __('Event content', 'mtheme'),
						'description' => __('Enter Event content', 'mtheme'),
						'id' => 'event_content',
						'type' => 'textarea',
					),	
					array(	
						'name' => __('Content color', 'mtheme'),
						'description' => __('Choose an Content color', 'mtheme'),
						'id' => 'content_color',
						'type' => 'color',
						'default' => '#5f6061',
					),					
				)		
			),		
			/*event_features*/
			array(
				'id' => 'event_features',
				'title' =>  __('Event Features', 'mtheme'),
				'page' => 'event',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(	
					
					array(	
						'name' => __('Background color', 'mtheme'),
						'description' => __('Choose an background color or image', 'mtheme'),
						'id' => 'event_f_bg_color',
						'type' => 'color',
						'default' => '#212739',
						'wrap' => true,
						'group' => 'group',	
					),
					array(	
						'name' => __('Event duration', 'mtheme'),
						'description' => __('Enter Event duration', 'mtheme'),
						'id' => 'event_duration',
						'type' => 'text',
					),
					array(	
						'name' => __('Event duration title', 'mtheme'),
						'description' => __('Please enter duration title', 'mtheme'),
						'id' => 'event_duration_title',
						'type' => 'text',
						'default' => 'Hours'
					),
					array(	
						'name' => __('Event duration brief', 'mtheme'),
						'description' => __('Enter Event duration brief', 'mtheme'),
						'id' => 'event_duration_brief',
						'type' => 'textarea',
						'wrap' => true,
						'group' => 'group',	
					),
					array(	
						'name' => __('Event Number of Speakers', 'mtheme'),
						'description' => __('Enter Event Number of Speakers', 'mtheme'),
						'id' => 'event_no_speakers',
						'type' => 'text',
					),
					array(	
						'name' => __('Event Speakers title', 'mtheme'),
						'description' => __('Please enter Speakers title', 'mtheme'),
						'id' => 'event_speakers_title',
						'type' => 'text',
						'default' => 'Hours'
					),
					array(	
						'name' => __('Event Speakers brief', 'mtheme'),
						'description' => __('Enter Event Speakers brief', 'mtheme'),
						'id' => 'event_speakers_brief',
						'type' => 'textarea',
						'wrap' => true,
						'group' => 'group',	
					),
					array(	
						'name' => __('Event Number of Technologies', 'mtheme'),
						'description' => __('Enter Event Number of Technologies', 'mtheme'),
						'id' => 'event_no_tech',
						'type' => 'text',
					),
					array(	
						'name' => __('Event Technologies title', 'mtheme'),
						'description' => __('Please enter Technologies title', 'mtheme'),
						'id' => 'event_tech_title',
						'type' => 'text',
						'default' => 'Hours'
					),
					array(	
						'name' => __('Event Technologies brief', 'mtheme'),
						'description' => __('Enter Event Technologies brief', 'mtheme'),
						'id' => 'event_tech_brief',
						'type' => 'textarea',
						'wrap' => true,
						'group' => 'group',	
					),
					
					array(	
						'name' => __('Show 3D Image Gallery', 'mtheme'),
						'description' => __('Show Image Gallery in Event Landing Page', 'mtheme'),
						'id' => 'img_gal_active',
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),				
						'default' => 'true'
					),
					array(	
						'name' => __('3D Image Gallery category', 'mtheme'),
						'id' => 'gal_cat',
						'description' => __('Choose Gallery slider category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'gallery_cat',
						'wrap' => true,
						'group' => 'group',	
					),
					array(	
						'name' => __('Show Video', 'mtheme'),
						'description' => __('Show Video in Event Landing Page', 'mtheme'),
						'id' => 'video_active',
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'					
					),
					array(	
						'name' => __('Choose video background image', 'mtheme'),
						'description' => __('Choose video background image', 'mtheme'),
						'id' => 'video_bg_img',
						'type' => 'uploader',
					),
					
					array(	
						'name' => __('Choose video background color', 'mtheme'),
						'description' => __('Choose video background color', 'mtheme'),
						'id' => 'video_bg_color',
						'type' => 'color',
					),
					array(	
						'name' => __('Event features video type', 'mtheme'),
						'description' => __('Select features video type', 'mtheme'),
						'id' => 'video_type',
						'type' => 'select',
						'options' => array(							
							'vimeo' => __('Vimeo', 'mtheme'),
							'youtube' => __('Youtube', 'mtheme')
						),
					),
					array(	
						'name' => __('Features video URL', 'mtheme'),
						'description' => __('Event features video Youtube or Vimeo URL', 'mtheme'),
						'id' => 'event_video',
						'type' => 'text',
					),
					array(	
						'name' => __('Video hover active', 'mtheme'),
						'description' => __('Video hover active', 'mtheme'),
						'id' => 'video_hover_active',
						'type' => 'select',
						'options' => array(							
							'yes' => __('Yes', 'mtheme'),
							'no' => __('No', 'mtheme')
						),
						'default' => 'yes'					
					),
					array(	
						'name' => __('Choose video hover color', 'mtheme'),
						'description' => __('Choose video hover color', 'mtheme'),
						'id' => 'video_hover_color',
						'type' => 'color',
					),					
				)		
			),
			/*event*/
			array(
				'id' => 'event_brochure',
				'title' =>  __('Event Download Options', 'mtheme'),
				'page' => 'event',
				'context' => 'normal',
				'priority' => 'low',
				'options' => array(
					array(	
						'name' => __('Background color', 'mtheme'),
						'description' => __('Choose an background color or image', 'mtheme'),
						'id' => 'sl_bg_color',
						'type' => 'color',
						'default' => '#ffffff',
					),
					array(	
						'name' => __('Event Download Schedule Heading', 'mtheme'),
						'description' => __('Please Event Download Schedule Heading', 'mtheme'),
						'id' => 'download_schedule_title',
						'type' => 'text',
					),
					array(	
						'name' => __('Event Schedule PDF', 'mtheme'),
						'description' => __('Please select Event PDF', 'mtheme'),
						'id' => 'event_pdf',
						'type' => 'uploader',
					),
					array(	
						'name' => __('Event Connect via Facebook Heading', 'mtheme'),
						'description' => __('Please Event Connect via Facebook Heading', 'mtheme'),
						'id' => 'fb_connect_title',
						'type' => 'text',
					),
					array(	
						'name' => __('Event facebook share link', 'mtheme'),
						'description' => __('Enter Event facebook share link', 'mtheme'),
						'id' => 'event_fb_share_link',
						'type' => 'text',
					),	
						
				)		
			),
			
			/*event_section_menu*/
			array(
				'id' => 'event_section_menu',
				'title' =>  __('Event General Page Options', 'mtheme'),
				'page' => 'event',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(	
					array(	
						'name' => __('Logo Position', 'mtheme'),
						'description' => __('Logo Position', 'mtheme'),
						'id' => 'logo_position',
						'type' => 'select',
						'options' => array(							
							'header' => __('Header', 'mtheme'),
							'banner' => __('On Banner', 'mtheme'),
							'both' => __('Both', 'mtheme')
						),
						'wrap' => true,
						'group' => 'group',
					),
					
					array(	
						'name' => __('Hero Background', 'mtheme'),
						'id' => 'slider',
						'type' => 'select_post',
						'post_type' => 'event_slider',
						'description' => __('Select Hero Background', 'mtheme'),
						'wrap' => true,
						'group' => 'group',
					),
					/*about*/
					array(
						'name' => __('About - Display in landing page', 'mtheme'),
						'id' => 'about_display',
						'description' => __('About - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('About order Event Landing Page', 'mtheme'),
						'id' => 'about_order',
						'description' => __('About order Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '1',
					),
					array(
						'name' => __('About Menu Active', 'mtheme'),
						'id' => 'about_menu_active',
						'description' => __('About Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true',
					),
					array(	
						'name' => __('About Menu Title', 'mtheme'),
						'description' => __('About Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'about_head',
						'type' => 'text',
						'wrap' => true,
						'group' => 'group',				
					),
					/*features*/					
					array(
						'name' => __('Features - Display in landing page', 'mtheme'),
						'id' => 'features_display',
						'description' => __('Features - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Features order Event Landing Page', 'mtheme'),
						'id' => 'features_order',
						'description' => __('Features order Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '2',
					),
					array(
						'name' => __('Features Menu Active', 'mtheme'),
						'id' => 'features_menu_active',
						'description' => __('Features Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'false'	
					),
					array(	
						'name' => __('Features Menu Title', 'mtheme'),
						'description' => __('Features Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'features_head',
						'type' => 'text',
						'default' => 'features',
						'wrap' => true,
						'group' => 'group',				
					),
					/*schedule*/
					array(
						'name' => __('Schedule - Display in landing page', 'mtheme'),
						'id' => 'schedule_display',
						'description' => __('Schedule - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Schedule order Event Landing Page', 'mtheme'),
						'id' => 'schedule_order',
						'description' => __('Schedule order Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '3',
					),
					array(
						'name' => __('Schedule Menu Active', 'mtheme'),
						'id' => 'schedule_menu_active',
						'description' => __('Schedule Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Schedule Menu Title', 'mtheme'),
						'description' => __('Schedule Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'schedule_head',
						'type' => 'text',
						'default' => 'schedule',		
					),
					array(	
						'name' => __('Schedules category', 'mtheme'),
						'id' => 'schedule_cat',
						'description' => __('Choose Schedules category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'schedule_cat',	
						'wrap' => true,
						'group' => 'group',	
					),
					/*download*/
					array(
						'name' => __('Download - Display in landing page', 'mtheme'),
						'id' => 'download_display',
						'description' => __('Download - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Download order Event Landing Page', 'mtheme'),
						'id' => 'download_order',
						'description' => __('Download order Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '4',
					),
					array(
						'name' => __('Download Menu Active', 'mtheme'),
						'id' => 'download_menu_active',
						'description' => __('Download Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'false'	
					),
					array(	
						'name' => __('Download Menu Title', 'mtheme'),
						'description' => __('Download Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'download_head',
						'type' => 'text',
						'default' => 'download',
						'wrap' => true,
						'group' => 'group',				
					),
					/*speaker*/
					array(
						'name' => __('Speakers - Display in landing page', 'mtheme'),
						'id' => 'speaker_display',
						'description' => __('Speakers - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Speakers order Event Landing Page', 'mtheme'),
						'id' => 'speaker_order',
						'description' => __('Speakers order Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '5',
					),
					array(
						'name' => __('Speakers Menu Active', 'mtheme'),
						'id' => 'speaker_menu_active',
						'description' => __('Speakers Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Speakers Menu Title', 'mtheme'),
						'description' => __('Speakers Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'speaker_head',
						'type' => 'text',
						'default' => 'speakers',	
					),
					array(	
						'name' => __('Speakers category', 'mtheme'),
						'id' => 'speaker_cat',
						'description' => __('Choose Speakers category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'speaker_cat',
						'wrap' => true,
						'group' => 'group',			
					),
					/*package*/
					array(
						'name' => __('Packages - Display in landing page', 'mtheme'),
						'id' => 'package_display',
						'description' => __('Package - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Packages order Event Landing Page', 'mtheme'),
						'id' => 'package_order',
						'description' => __('Packages order Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '6',
					),
					array(
						'name' => __('Packages Menu Active', 'mtheme'),
						'id' => 'package_menu_active',
						'description' => __('Packages Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Packages Menu Title', 'mtheme'),
						'description' => __('Package Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'package_head',
						'type' => 'text',
						'default' => 'pricing',		
					),
					array(	
						'name' => __('Packages category', 'mtheme'),
						'id' => 'package_cat',
						'description' => __('Choose Packages category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'package_cat',
						'wrap' => true,
						'group' => 'group',		
					),
					/*contact_form*/
					array(
						'name' => __('Contact Form - Display in landing page', 'mtheme'),
						'id' => 'contact_form_display',
						'description' => __('Contact Form - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Contact Form order Event Landing Page', 'mtheme'),
						'id' => 'contact_form_order',
						'description' => __('Contact Form order Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '7',
					),					
					array(
						'name' => __('Contact Form Type', 'mtheme'),
						'id' => 'contact_type',
						'description' => __('Contact Form Type in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'natural' => __('Natural Language Form', 'mtheme'),
							'contact' => __('Contact Form 7', 'mtheme')
						),
						'default' => 'natural',
						'defendency-set' => 'on'
					),
					array(
						'name' => __('Contact Form 7', 'mtheme'),
						'id' => 'contact_contact7_post',
						'description' => __('Select Contact Form 7', 'mtheme'),
						'type' => 'select_post',
						'post_type' => 'wpcf7_contact_form',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'contact_type','value'=>'contact','show'=>'off')
					),
					array(
						'name' => __('Contact Form Menu Active', 'mtheme'),
						'id' => 'contact_form_menu_active',
						'description' => __('Contact Form Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'false'	
					),
					array(	
						'name' => __('Contact Form Menu Title', 'mtheme'),
						'description' => __('Contact Form Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'contact_form_head',
						'type' => 'text',
						'default' => 'register',
						'wrap' => true,
						'group' => 'group',				
					),
					/*sponsor*/
					array(
						'name' => __('Sponsors - Display in landing page', 'mtheme'),
						'id' => 'sponsor_display',
						'description' => __('Sponsors - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Sponsors order Event Landing Page', 'mtheme'),
						'id' => 'sponsor_order',
						'description' => __('Sponsors order Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '8',
					),
					array(
						'name' => __('Sponsors Menu Active', 'mtheme'),
						'id' => 'sponsor_menu_active',
						'description' => __('Sponsors Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Sponsors Menu Title', 'mtheme'),
						'description' => __('Sponsors Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'sponsor_head',
						'type' => 'text',
						'default' => 'sponsors',			
					),
					array(	
						'name' => __('Sponsors category', 'mtheme'),
						'id' => 'sponsor_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'sponsor_cat',
						'wrap' => true,
						'group' => 'group',	
					),
					/*notify*/
					array(
						'name' => __('Notify - Display in landing page', 'mtheme'),
						'id' => 'notify_display',
						'description' => __('Notify - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Notify order Event Landing Page', 'mtheme'),
						'id' => 'notify_order',
						'description' => __('Notify order Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '9',
					),
					array(
						'name' => __('Notify Menu Active', 'mtheme'),
						'id' => 'notify_menu_active',
						'description' => __('Notify Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'false'	
					),
					array(	
						'name' => __('Notify Menu Title', 'mtheme'),
						'description' => __('Notify Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'notify_head',
						'type' => 'text',
						'default' => 'notify me',
						'wrap' => true,
						'group' => 'group',				
					),
					/*More Event Entity 1*/
					array(
						'name' => __('More Event Entity 1 - Display', 'mtheme'),
						'id' => 'ext_link_1_display',
						'description' => __('More Event Entity 1 - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'false'	
					),
					array(	
						'name' => __('More Event Entity 1 order Event Landing Page', 'mtheme'),
						'id' => 'ext_link_1_order',
						'description' => __('More Event Entity 1 Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '11',
					),
					array(	
						'name' => __('More Event Entity 1', 'mtheme'),
						'id' => 'more_1_entity',
						'description' => __('More Event Entity 1', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'Schedules',
							'2' => 'Speakers',
							'3' => 'Packages',
							'4' => 'Sponsors'
						),
						'default' => '1',
						'defendency-set' => 'on'
					),
					array(	
						'name' => __('Schedules category', 'mtheme'),
						'id' => 'more_1_schedule_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'schedule_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_1_entity','value'=>'1','show'=>'on')
					),
					array(	
						'name' => __('Speakers category', 'mtheme'),
						'id' => 'more_1_speaker_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'speaker_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_1_entity','value'=>'2','show'=>'on')
					),
					array(	
						'name' => __('Packages category', 'mtheme'),
						'id' => 'more_1_package_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'package_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_1_entity','value'=>'3','show'=>'on')
					),
					array(	
						'name' => __('Sponsors category', 'mtheme'),
						'id' => 'more_1_sponsor_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'sponsor_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_1_entity','value'=>'4','show'=>'on')
					),
					array(
						'name' => __('More Event Entity 1 Menu Active', 'mtheme'),
						'id' => 'ext_link_1_active',
						'description' => __('More Event Entity 1 Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('More Event Entity 1 Menu Title', 'mtheme'),
						'description' => __('More Event Entity 1 Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'ext_link_1_head',
						'type' => 'text',
						'default' => 'Link 1',
						'wrap' => true,
						'group' => 'group',	
					),
					/*More Event Entity 2*/
					array(
						'name' => __('More Event Entity 2 - Display', 'mtheme'),
						'id' => 'ext_link_2_display',
						'description' => __('More Event Entity 2 - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'false'	
					),
					array(	
						'name' => __('More Event Entity 2 order Event Landing Page', 'mtheme'),
						'id' => 'ext_link_2_order',
						'description' => __('More Event Entity 2 Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '12',
					),
					array(	
						'name' => __('More Event Entity 2', 'mtheme'),
						'id' => 'more_2_entity',
						'description' => __('More Event Entity 2', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'Schedules',
							'2' => 'Speakers',
							'3' => 'Packages',
							'4' => 'Sponsors'
						),
						'default' => '1',
						'defendency-set' => 'on'
					),
					array(	
						'name' => __('Schedules category', 'mtheme'),
						'id' => 'more_2_schedule_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'schedule_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_2_entity','value'=>'1','show'=>'on')
					),
					array(	
						'name' => __('Speakers category', 'mtheme'),
						'id' => 'more_2_speaker_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'speaker_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_2_entity','value'=>'2','show'=>'on')
					),
					array(	
						'name' => __('Packages category', 'mtheme'),
						'id' => 'more_2_package_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'package_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_2_entity','value'=>'3','show'=>'on')
					),
					array(	
						'name' => __('Sponsors category', 'mtheme'),
						'id' => 'more_2_sponsor_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'sponsor_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_2_entity','value'=>'4','show'=>'on')
					),
					array(
						'name' => __('More Event Entity 2 Menu Active', 'mtheme'),
						'id' => 'ext_link_2_active',
						'description' => __('More Event Entity 2 Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('More Event Entity 2 Menu Title', 'mtheme'),
						'description' => __('More Event Entity 2 Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'ext_link_2_head',
						'type' => 'text',
						'default' => 'Link 2',
						'wrap' => true,
						'group' => 'group',	
					),
					/*More Event Entity 3*/
					array(
						'name' => __('More Event Entity 3 - Display', 'mtheme'),
						'id' => 'ext_link_3_display',
						'description' => __('More Event Entity 3 - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'false'	
					),
					array(	
						'name' => __('More Event Entity 3 order Event Landing Page', 'mtheme'),
						'id' => 'ext_link_3_order',
						'description' => __('More Event Entity 3 Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '13',
					),
					array(	
						'name' => __('More Event Entity 3', 'mtheme'),
						'id' => 'more_3_entity',
						'description' => __('More Event Entity 3', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'Schedules',
							'2' => 'Speakers',
							'3' => 'Packages',
							'4' => 'Sponsors'
						),
						'default' => '1',
						'defendency-set' => 'on'
					),
					array(	
						'name' => __('Schedules category', 'mtheme'),
						'id' => 'more_3_schedule_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'schedule_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_3_entity','value'=>'1','show'=>'on')
					),
					array(	
						'name' => __('Speakers category', 'mtheme'),
						'id' => 'more_3_speaker_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'speaker_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_3_entity','value'=>'2','show'=>'on')
					),
					array(	
						'name' => __('Packages category', 'mtheme'),
						'id' => 'more_3_package_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'package_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_3_entity','value'=>'3','show'=>'on')
					),
					array(	
						'name' => __('Sponsors category', 'mtheme'),
						'id' => 'more_3_sponsor_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'sponsor_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_3_entity','value'=>'4','show'=>'on')
					),
					array(
						'name' => __('More Event Entity 3 Menu Active', 'mtheme'),
						'id' => 'ext_link_3_active',
						'description' => __('More Event Entity 3 Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('More Event Entity 3 Menu Title', 'mtheme'),
						'description' => __('More Event Entity 3 Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'ext_link_3_head',
						'type' => 'text',
						'default' => 'Link 3',
						'wrap' => true,
						'group' => 'group',	
					),
					/*More Event Entity 4*/
					array(
						'name' => __('More Event Entity 4 - Display', 'mtheme'),
						'id' => 'ext_link_4_display',
						'description' => __('More Event Entity 4 - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'false'	
					),
					array(	
						'name' => __('More Event Entity 4 order Event Landing Page', 'mtheme'),
						'id' => 'ext_link_4_order',
						'description' => __('More Event Entity 4 Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '14',
					),
					array(	
						'name' => __('More Event Entity 4', 'mtheme'),
						'id' => 'more_4_entity',
						'description' => __('More Event Entity 4', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'Schedules',
							'2' => 'Speakers',
							'3' => 'Packages',
							'4' => 'Sponsors'
						),
						'default' => '1',
						'defendency-set' => 'on'
					),
					array(	
						'name' => __('Schedules category', 'mtheme'),
						'id' => 'more_4_schedule_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'schedule_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_4_entity','value'=>'1','show'=>'on')
					),
					array(	
						'name' => __('Speakers category', 'mtheme'),
						'id' => 'more_4_speaker_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'speaker_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_4_entity','value'=>'2','show'=>'on')
					),
					array(	
						'name' => __('Packages category', 'mtheme'),
						'id' => 'more_4_package_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'package_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_4_entity','value'=>'3','show'=>'on')
					),
					array(	
						'name' => __('Sponsors category', 'mtheme'),
						'id' => 'more_4_sponsor_cat',
						'description' => __('Choose Sponsors category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'sponsor_cat',
						'defendency' => array('base'=>'_event','parent'=>'tr','id'=>'more_4_entity','value'=>'4','show'=>'on')
					),
					array(
						'name' => __('More Event Entity 4 Menu Active', 'mtheme'),
						'id' => 'ext_link_4_active',
						'description' => __('More Event Entity 4 Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('More Event Entity 4 Menu Title', 'mtheme'),
						'description' => __('More Event Entity 4 Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'ext_link_4_head',
						'type' => 'text',
						'default' => 'Link 4',
						'wrap' => true,
						'group' => 'group',	
					),
					/*Blog*/
					array(
						'name' => __('Blog - Display in landing page', 'mtheme'),
						'id' => 'blog_display',
						'description' => __('Blog - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Blog order Event Landing Page', 'mtheme'),
						'id' => 'blog_order',
						'description' => __('Blog Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '10',
					),
					array(	
						'name' => __('Blog Menu Title', 'mtheme'),
						'description' => __('Blog Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'blog_head',
						'type' => 'text',
						'default' => 'blog'
					),
					array(	
						'name' => __('Blog Section Title', 'mtheme'),
						'description' => __('Blog Section Title', 'mtheme'),
						'id' => 'blog_section_head',
						'type' => 'text',
						'default' => 'blog'
					),
					array(	
						'name' => __('Blog Section Description', 'mtheme'),
						'description' => __('Blog Section Description', 'mtheme'),
						'id' => 'blog_section_description',
						'type' => 'textarea',
						'default' => ''
					),
					array(	
						'name' => __('Blog Section Background', 'mtheme'),
						'description' => __('Blog Section Background', 'mtheme'),
						'id' => 'blog_section_bg',
						'type' => 'color',
						'default' => '#fff'
					),
					array(	
						'name' => __('Blog category', 'mtheme'),
						'id' => 'blog_cat',
						'description' => __('Choose Blog category', 'mtheme'),
						'type' => 'select_category',
						'taxonomy' => 'category',
						'wrap' => true,
						'group' => 'group',	
					),
					/*Footer Contact*/
					array(
						'name' => __('Footer Contact - Display in landing page', 'mtheme'),
						'id' => 'contact_display',
						'description' => __('Footer Contact - Display in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Footer Contact order Event Landing Page', 'mtheme'),
						'id' => 'contact_order',
						'description' => __('Footer Contact order Event Landing Page', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'1' => 'One',
							'2' => 'Two',
							'3' => 'Three',
							'4' => 'Four',
							'5' => 'Five',
							'6' => 'Six',
							'7' => 'Seven',
							'8' => 'Eight',
							'9' => 'Nine',
							'10' => 'Ten',
							'11' => 'Eleven',
							'12' => 'Twelve',
							'13' => 'Thirteen',
							'14' => 'Fourteen',
							'15' => 'Fifteen'
						),
						'default' => '15',
					),
					array(
						'name' => __('Footer Contact Menu Active', 'mtheme'),
						'id' => 'contact_menu_active',
						'description' => __('Footer Contact Menu Active in landing page', 'mtheme'),
						'type' => 'select',
						'options' => array(							
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme')
						),
						'default' => 'true'	
					),
					array(	
						'name' => __('Footer Contact Menu Title', 'mtheme'),
						'description' => __('Footer Contact Menu Title in Event Landing Page', 'mtheme'),
						'id' => 'contact_head',
						'type' => 'text',
						'default' => 'contact',		
						'wrap' => true,
						'group' => 'group',		
					),
					/*External links*/
					array(	
						'name' => __('More External links', 'mtheme'),
						'description' => __('More External links in Event Landing Page', 'mtheme'),
						'id' => 'external_link',
						'type' => 'external_link'				
					),
					
				),			
			),
			/*speaker*/
			array(
				'id' => 'speaker',
				'title' =>  __('Speaker Options', 'mtheme'),
				'page' => 'speaker',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(					
					
					array(
						'name' => __('Designation', 'mtheme'),
						'id' => 'designation',
						'type' => 'textarea',
						'description' => __('Enter Speaker Designation', 'mtheme'),
					),
					array(
						'name' => __('Twitter URL', 'mtheme'),
						'id' => 'twitter',
						'type' => 'text',
						'description' => __('Enter Speaker Twitter URL', 'mtheme'),
					),
					array(
						'name' => __('Facebook URL', 'mtheme'),
						'id' => 'facebook',
						'type' => 'text',
						'description' => __('Enter Speaker Facebook URL', 'mtheme'),
					),					
					array(
						'name' => __('Dribbble URL', 'mtheme'),
						'id' => 'dribbble',
						'type' => 'text',
						'description' => __('Enter Speaker Dribbble URL', 'mtheme'),
					),
					
					
				),			
			),
			/*packages*/
			array(
				'id' => 'package',
				'title' =>  __('Package Options', 'mtheme'),
				'page' => 'package',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(
					
					array(
						'name' => __('Price', 'mtheme'),
						'id' => 'price',
						'type' => 'text',
						'description' => __('Enter Package Price', 'mtheme'),
					),
					array(
						'name' => __('Register link title', 'mtheme'),
						'id' => 'register_title',
						'type' => 'text',
						'description' => __('Please enter register link title', 'mtheme'),
					),
					array(
						'name' => __('Register link', 'mtheme'),
						'id' => 'register_link',
						'type' => 'text',
						'description' => __('Please enter register link', 'mtheme'),
					),
					array(
						'name' => __('Primary heading background color', 'mtheme'),
						'id' => 'primary_heading_background_color',
						'type' => 'color',
						'description' => __('Please select primary heading background color', 'mtheme'),
					),
					array(
						'name' => __('Secondary heading background color', 'mtheme'),
						'id' => 'secondary_heading_background_color',
						'type' => 'color',
						'description' => __('Please select secondary heading background color', 'mtheme'),
					),					
					array(
						'name' => __('Heading color', 'mtheme'),
						'id' => 'heading_color',
						'type' => 'color',
						'description' => __('Please select heading color', 'mtheme'),
					),					
					array(
						'name' => __('Content Background color', 'mtheme'),
						'id' => 'content_background_color',
						'type' => 'color',
						'description' => __('Please select content background color', 'mtheme'),
					),
					array(
						'name' => __('Content color', 'mtheme'),
						'id' => 'content_color',
						'type' => 'color',
						'description' => __('Please select content color', 'mtheme'),
					),
					array(
						'name' => __('Button background color', 'mtheme'),
						'id' => 'button_background_color',
						'type' => 'color',
						'description' => __('Please select button background color', 'mtheme'),
					),
					array(
						'name' => __('Button heading color', 'mtheme'),
						'id' => 'button_heading_color',
						'type' => 'color',
						'description' => __('Please select button heading color', 'mtheme'),
					),
					
				),			
			),
			/*Schedule*/
			array(
				'id' => 'schedule',
				'title' =>  __('Schedule Options', 'mtheme'),
				'page' => 'schedule',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(
					
					array(
						'name' => __('Date', 'mtheme'),
						'id' => 'date',
						'type' => 'text',
						'description' => __('Enter Schedule date', 'mtheme'),
					),
					array(
						'name' => __('Schedule', 'mtheme'),
						'id' => 'event',
						'type' => 'schedule',
					),
					
				),			
			),
			/*sponsor*/
			array(
				'id' => 'sponsor',
				'title' =>  __('Sponsors Options', 'mtheme'),
				'page' => 'sponsor',
				'context' => 'normal',
				'priority' => 'high',
				'options' => array(
					
					array(
						'name' => __('URL', 'mtheme'),
						'id' => 'url',
						'type' => 'text',
						'description' => __('Enter Sponsor URL', 'mtheme'),
					),
					
				),			
			),
		),
		/*Taxonomies Meta*/
		'texa_meta' => array(
			array(
				'cat_type' => 'gallery_cat',
				'context' => 'normal',
				'shortcode_name' => 'ThreeDImageSlider',
				'options' => array(
					array(
						'name' => __('Background Image', 'mtheme'),
						'id' => 'background_img',
						'type' => 'image',
						'prefix' => MTHEME_PREFIX.'gal_',
					),
					array(
						'name' => __('Background color', 'mtheme'),
						'id' => 'background_color',
						'type' => 'color',
						'prefix' => MTHEME_PREFIX.'gal_',
					),
					array(
						'name' => __('Heading Color', 'mtheme'),
						'id' => 'heading_color',
						'type' => 'color',
						'prefix' => MTHEME_PREFIX.'gal_',
					),
					array(
						'name' => __('Content color', 'mtheme'),
						'id' => 'content_color',
						'type' => 'color',
						'prefix' => MTHEME_PREFIX.'gal_',
					),
					array(
						'name' => __('Slide Title', 'mtheme'),
						'id' => 'slide_title',
						'type' => 'select',
						'prefix' => MTHEME_PREFIX.'gal_',
						'select_options'=>
						array(
							'show' => __('Show', 'mtheme'),
							'hide' => __('Hide', 'mtheme'),
						)
					),
					
					array(
						'name' => __('Slide Title Position', 'mtheme'),
						'id' => 'slide_title_position',
						'type' => 'select',
						'prefix' => MTHEME_PREFIX.'gal_',
						'select_options'=>
						array(
							'top' => __('Top', 'mtheme'),
							'bottom' => __('Bottom', 'mtheme'),
						)
					),
					
					array(
						'name' => __('Slide Description', 'mtheme'),
						'id' => 'slide_description',
						'type' => 'select',
						'prefix' => MTHEME_PREFIX.'gal_',
						'select_options'=>
						array(
							'show' => __('Show', 'mtheme'),
							'hide' => __('Hide', 'mtheme'),
						)
					),
					
					array(
						'name' => __('Slide Description Position', 'mtheme'),
						'id' => 'slide_description_position',
						'type' => 'select',
						'prefix' => MTHEME_PREFIX.'gal_',
						'select_options'=>
						array(
							'top' => __('Top', 'mtheme'),
							'bottom' => __('Bottom', 'mtheme'),
						)
					),
					array(
						'name' => __('Hover Active', 'mtheme'),
						'id' => 'hover_active',
						'type' => 'select',
						'prefix' => MTHEME_PREFIX.'gal_',
						'select_options'=>
						array(
							'yes' => __('Yes', 'mtheme'),
							'no' => __('No', 'mtheme'),
						)
					),
					
					array(
						'name' => __('Hover Background Color', 'mtheme'),
						'id' => 'hover_background_color',
						'type' => 'color',
						'prefix' => MTHEME_PREFIX.'gal_',
					),				
					
				),
				'shortcode' => array(
					array(
						'field' => MTHEME_PREFIX.'gal_'.'slide_title',
						'title' => 'slide_title',
						'default' => 'show'
					),
					array(
						'field' => MTHEME_PREFIX.'gal_'.'slide_title_position',
						'title' => 'slide_title_position',
						'default' => 'top'
					),
					array(
						'field' => MTHEME_PREFIX.'gal_'.'slide_description',
						'title' => 'slide_description',
						'default' => 'show'
					),
					array(
						'field' => MTHEME_PREFIX.'gal_'.'slide_description_position',
						'title' => 'slide_description_position',
						'default' => 'top'
					),
					array(
						'field' => MTHEME_PREFIX.'gal_'.'hover_active',
						'title' => 'hover_active',
						'default' => 'yes'
					),
					array(
						'field' => MTHEME_PREFIX.'gal_'.'hover_background_color',
						'title' => 'hover_background_color',
						'default' => '#1bd982'
					),
				),				
			),
			/*Speaker_cat*/
			array(
				'cat_type' => 'speaker_cat',
				'context' => 'normal',
				'shortcode_name' => 'speakers',
				'options' => array(
					array(
						'name' => __('Speaker Slider Active', 'mtheme'),
						'id' => 'slider',
						'type' => 'select',
						'prefix' => MTHEME_PREFIX.'spk_',
						'select_options'=>
						array(
							'yes' => __('Yes', 'mtheme'),
							'no' => __('No', 'mtheme'),
						)
					),
					array(
						'name' => __('Speaker Slider IS Autoplay', 'mtheme'),
						'id' => 'isautoplay',
						'type' => 'select',
						'prefix' => MTHEME_PREFIX.'spk_',
						'select_options'=>
						array(
							'true' => __('Yes', 'mtheme'),
							'false' => __('No', 'mtheme'),
						)
					),
					array(	
						'name' => __('Background Image', 'mtheme'),
						'description' => __('Choose an background image or color', 'mtheme'),
						'id' => 'bg_img',
						'prefix' => MTHEME_PREFIX.'spk_',
						'type' => 'image'
					),
					array(	
						'name' => __('Background color', 'mtheme'),
						'description' => __('Choose an background color or image', 'mtheme'),
						'id' => 'bg_color',
						'prefix' => MTHEME_PREFIX.'spk_',
						'type' => 'color',
						'default' => '#212739',
					),
					array(	
						'name' => __('Heading color', 'mtheme'),
						'description' => __('Choose an Heading color', 'mtheme'),
						'id' => 'p_color',
						'prefix' => MTHEME_PREFIX.'spk_',
						'type' => 'color',
						'default' => '#1bce7c',
					),
					array(	
						'name' => __('Content color', 'mtheme'),
						'description' => __('Choose an Content color', 'mtheme'),
						'id' => 's_color',
						'prefix' => MTHEME_PREFIX.'spk_',
						'type' => 'color',
						'default' => '#FFFFFF',
					),
					
					array(
						'name' => __('Speaker Title', 'mtheme'),
						'id' => 'title',
						'type' => 'select',
						'prefix' => MTHEME_PREFIX.'spk_',
						'select_options'=>
						array(
							'show' => __('Show', 'mtheme'),
							'hide' => __('Hide', 'mtheme'),
						)
					),
					
					array(
						'name' => __('Speaker Title Position', 'mtheme'),
						'id' => 'title_position',
						'type' => 'select',
						'prefix' => MTHEME_PREFIX.'spk_',
						'select_options'=>
						array(
							'bottom' => __('Bottom', 'mtheme'),
							'top' => __('Top', 'mtheme'),
						)
					),
					
					array(
						'name' => __('Speaker Designation', 'mtheme'),
						'id' => 'designation',
						'type' => 'select',
						'prefix' => MTHEME_PREFIX.'spk_',
						'select_options'=>
						array(
							'show' => __('Show', 'mtheme'),
							'hide' => __('Hide', 'mtheme'),
						)
					),
					
					array(
						'name' => __('Speaker Designation Position', 'mtheme'),
						'id' => 'designation_position',
						'type' => 'select',
						'prefix' => MTHEME_PREFIX.'spk_',
						'select_options'=>
						array(
							'bottom' => __('Bottom', 'mtheme'),
							'top' => __('Top', 'mtheme'),
						)
					),
					array(
						'name' => __('Detailed Popup', 'mtheme'),
						'id' => 'detailed_popup',
						'type' => 'select',
						'prefix' => MTHEME_PREFIX.'spk_',
						'select_options'=>
						array(
							'yes' => __('Yes', 'mtheme'),
							'no' => __('No', 'mtheme'),
						)
					),
					
					array(
						'name' => __('Hover Background Color', 'mtheme'),
						'id' => 'hover_background_color',
						'type' => 'color',
						'prefix' => MTHEME_PREFIX.'spk_',
					),
				),
				'shortcode' => array(
					array(
						'field' => MTHEME_PREFIX.'spk_'.'title',
						'title' => 'title',
						'default' => 'show'
					),
					array(
						'field' => MTHEME_PREFIX.'spk_'.'title_position',
						'title' => 'title_position',
						'default' => 'top'
					),
					array(
						'field' => MTHEME_PREFIX.'spk_'.'designation',
						'title' => 'designation',
						'default' => 'show'
					),
					array(
						'field' => MTHEME_PREFIX.'spk_'.'designation_position',
						'title' => 'designation_position',
						'default' => 'top'
					),
					array(
						'field' => MTHEME_PREFIX.'spk_'.'detailed_popup',
						'title' => 'detailed_popup',
						'default' => 'yes'
					),
					array(
						'field' => MTHEME_PREFIX.'spk_'.'hover_background_color',
						'title' => 'hover_background_color',
						'default' => '#1bd982'
					),
				),				
			),
			/*schedule_cat*/
			array(
				'cat_type' => 'schedule_cat',
				'context' => 'normal',
				'shortcode_name' => 'schedule',
				'options' => array(
					
					array(	
						'name' => __('Background Image', 'mtheme'),
						'description' => __('Choose an background image or color', 'mtheme'),
						'id' => 'bg_img',
						'prefix' => MTHEME_PREFIX.'sch_',
						'type' => 'image'
					),
					array(	
						'name' => __('Background color', 'mtheme'),
						'description' => __('Choose an background color or image', 'mtheme'),
						'id' => 'bg_color',
						'prefix' => MTHEME_PREFIX.'sch_',
						'type' => 'color',
						'default' => '#212739',
					),
					array(	
						'name' => __('Heading color', 'mtheme'),
						'description' => __('Choose an heading color', 'mtheme'),
						'id' => 'p_color',
						'prefix' => MTHEME_PREFIX.'sch_',
						'type' => 'color',
						'default' => '#1bce7c',
					),
					array(	
						'name' => __('Content color', 'mtheme'),
						'description' => __('Choose an content color', 'mtheme'),
						'id' => 's_color',
						'prefix' => MTHEME_PREFIX.'sch_',
						'type' => 'color',
						'default' => '#FFFFFF',
					),
					
					array(	
						'name' => __('Time Heading color', 'mtheme'),
						'description' => __('Choose an time heading color', 'mtheme'),
						'id' => 't_color',
						'prefix' => MTHEME_PREFIX.'sch_',
						'type' => 'color',
						'default' => '#1bce7c',
					),
					array(	
						'name' => __('Accordions Content color', 'mtheme'),
						'description' => __('Choose an accordions content color', 'mtheme'),
						'id' => 'a_color',
						'prefix' => MTHEME_PREFIX.'sch_',
						'type' => 'color',
						'default' => '#FFFFFF',
					),
				),
				'shortcode' => array(
					
				),				
			),
			/*sponsor_cat*/
			array(
				'cat_type' => 'sponsor_cat',
				'context' => 'normal',
				'shortcode_name' => 'sponsor',
				'options' => array(
					
					array(	
						'name' => __('Background Image', 'mtheme'),
						'description' => __('Choose an background image or color', 'mtheme'),
						'id' => 'bg_img',
						'prefix' => MTHEME_PREFIX.'spr_',
						'type' => 'image'
					),
					array(	
						'name' => __('Background color', 'mtheme'),
						'description' => __('Choose an background color or image', 'mtheme'),
						'id' => 'bg_color',
						'prefix' => MTHEME_PREFIX.'spr_',
						'type' => 'color',
						'default' => '#212739',
					),
					array(	
						'name' => __('Heading color', 'mtheme'),
						'description' => __('Choose an heading color', 'mtheme'),
						'id' => 'p_color',
						'prefix' => MTHEME_PREFIX.'spr_',
						'type' => 'color',
						'default' => '#1bce7c',
					),
					array(	
						'name' => __('Content color', 'mtheme'),
						'description' => __('Choose an content color', 'mtheme'),
						'id' => 's_color',
						'prefix' => MTHEME_PREFIX.'spr_',
						'type' => 'color',
						'default' => '#FFFFFF',
					),
					array(	
						'name' => __('Slide width in px ex. 200', 'mtheme'),
						'description' => __('Slide width in px ex. 200', 'mtheme'),
						'id' => 'slide_width',
						'prefix' => MTHEME_PREFIX.'spr_',
						'type' => 'text',
						'default' => '200',
					),
					array(	
						'name' => __('Slide height in px ex. 56', 'mtheme'),
						'description' => __('Slide height in px ex. 56', 'mtheme'),
						'id' => 'slide_height',
						'prefix' => MTHEME_PREFIX.'spr_',
						'type' => 'text',
						'default' => '56',
					),
					array(	
						'name' => __('Thumbnail width in px ex. 200', 'mtheme'),
						'description' => __('Thumbnail width in px ex. 200', 'mtheme'),
						'id' => 'thumbnail_width',
						'prefix' => MTHEME_PREFIX.'spr_',
						'type' => 'text',
						'default' => '160',
					),
					array(	
						'name' => __('Thumbnail height in px ex. 56', 'mtheme'),
						'description' => __('Thumbnail height in px ex. 56', 'mtheme'),
						'id' => 'thumbnail_height',
						'prefix' => MTHEME_PREFIX.'spr_',
						'type' => 'text',
						'default' => '56',
					),
				),
				'shortcode' => array(
					
				),				
			),
			/*package_cat*/
			array(
				'cat_type' => 'package_cat',
				'context' => 'normal',
				'shortcode_name' => 'package',
				'options' => array(
					
					array(	
						'name' => __('Background Image', 'mtheme'),
						'description' => __('Choose an background image or color', 'mtheme'),
						'id' => 'bg_img',
						'prefix' => MTHEME_PREFIX.'pck_',
						'type' => 'image'
					),
					array(	
						'name' => __('Background color', 'mtheme'),
						'description' => __('Choose an background color or image', 'mtheme'),
						'id' => 'bg_color',
						'prefix' => MTHEME_PREFIX.'pck_',
						'type' => 'color',
						'default' => '#212739',
					),
					array(	
						'name' => __('Heading color', 'mtheme'),
						'description' => __('Choose an Heading color', 'mtheme'),
						'id' => 'p_color',
						'prefix' => MTHEME_PREFIX.'pck_',
						'type' => 'color',
						'default' => '#1bce7c',
					),
					array(	
						'name' => __('Content color', 'mtheme'),
						'description' => __('Choose an content color', 'mtheme'),
						'id' => 's_color',
						'prefix' => MTHEME_PREFIX.'pck_',
						'type' => 'color',
						'default' => '#FFFFFF',
					),
					
				),
				'shortcode' => array(
					
				),				
			),
		),
		
		/*Taxonomies Column*/
		'texa_column' => array(
			'cb' => '<input type="checkbox" />',
			'name' => __('Name', 'mtheme'),
			'shortcode' => __('Shortcode', 'mtheme'),
			'slug' => __('Slug', 'mtheme'),
			'posts' => __('Posts', 'mtheme'),
		),
		
		/*Shortcodes*/
		'shortcodes' => array(
			array(
				'id' => 'section',
				'name' => __('section', 'mtheme'),
				'shortcode' => '[section][/section]',
				'options' => array(		
				),
			),
			array(
				'id' => 'container',
				'name' => __('container', 'mtheme'),
				'shortcode' => '[container][/container]',
				'options' => array(		
				),
			),
			array(
				'id' => 'row',
				'name' => __('row', 'mtheme'),
				'shortcode' => '[row][/row]',
				'options' => array(		
				),
			),
			/*Columns*/
			array(
				'id' => 'column',
				'name' => __('Columns', 'mtheme'),
				'shortcode' => '{{clone}}',
				'clone' => array(
					'shortcode' => '[{{column}} align="{{align}}" ]{{content}}[/{{column}}]',
					'options' => array(
						array(
							'id' => 'column',
							'name' => __('Width', 'mtheme'),
							'type' => 'select',
							'options' => array(
								'one_col' => __('One Column', 'mtheme'),
								'two_col' => __('Two Columns', 'mtheme'),
								'three_col' => __('Three Columns', 'mtheme'),
								'four_col' => __('Four Columns', 'mtheme'),
								'five_col' => __('Five Columns', 'mtheme'),
								'six_col' => __('Six Columns', 'mtheme'),
								'seven_col' => __('Seven Columns', 'mtheme'),
								'eight_col' => __('Eight Columns', 'mtheme'),
								'nine_col' => __('Nine Columns', 'mtheme'),
								'ten_col' => __('Ten Columns', 'mtheme'),
								'eleven_col' => __('Eleven Columns', 'mtheme'),
								'fullwidth' => __('Full Width', 'mtheme'),
							),
						),
						
						array(					
							'id' => 'content',
							'name' => __('Content', 'mtheme'),						
							'type' => 'textarea',
							'default' => 'content',
						),
						array(					
							'id' => 'align',
							'name' => __('Align', 'mtheme'),						
							'type' => 'select',
							'options' => array(
								'left' => __('Left Align', 'mtheme'),
								'center' => __('Center Align', 'mtheme'),
								'right' => __('Right Align', 'mtheme'),
							),
						),
					),
				),
			),
			
			array(
				'id' => 'button',
				'name' => __('Button', 'mtheme'),
				'shortcode' => '{{clone}}',
				'clone' => array(
					'shortcode' => '[button type="{{type}}" ]{{content}}[/button]',
					'options' => array(	
						array(					
							'id' => 'type',
							'name' => __('Type', 'mtheme'),						
							'type' => 'select',
							'options' => array(
								'primary' => __('Primary', 'mtheme'),
								'success' => __('Success', 'mtheme'),
								'info' => __('Info', 'mtheme'),
								'warning' => __('Warning', 'mtheme'),
								'dancer' => __('Dancer', 'mtheme'),
								'link' => __('Link', 'mtheme'),
							),
						),						
						array(					
							'id' => 'content',
							'name' => __('Content', 'mtheme'),						
							'type' => 'textarea',
							'default' => 'Button',
						),
					),
				),
			),
			array(
				'id' => 'alert',
				'name' => __('Alert', 'mtheme'),
				'shortcode' => '{{clone}}',
				'clone' => array(
					'shortcode' => '[alert type="{{type}}" closable="{{closable}}"]{{content}}[/alert]',
					'options' => array(	
						array(					
							'id' => 'type',
							'name' => __('Type', 'mtheme'),						
							'type' => 'select',
							'options' => array(
								'success' => __('Success', 'mtheme'),
								'info' => __('Info', 'mtheme'),
								'warning' => __('Warning', 'mtheme'),
								'dancer' => __('Dancer', 'mtheme'),
							),
						),
						array(					
							'id' => 'closable',
							'name' => __('Closable', 'mtheme'),						
							'type' => 'select',
							'options' => array(
								'yes' => __('Yes', 'mtheme'),
								'no' => __('No', 'mtheme'),
							),
						),
						array(					
							'id' => 'icon',
							'name' => __('Icon', 'mtheme'),						
							'type' => 'select',
							'options' => array(
								'Success' => __('Success', 'mtheme'),
								'important' => __('Important', 'mtheme'),
								'warning' => __('Warning', 'mtheme'),
								'dancer' => __('Dancer', 'mtheme'),
							),
						),						
						array(					
							'id' => 'content',
							'name' => __('Content', 'mtheme'),						
							'type' => 'textarea',
							'default' => 'alert',
						),
					),
				),
			),
			
			/*Toggles*/
			array(
				'id' => 'toggles',
				'name' => __('Toggles', 'mtheme'),
				'shortcode' => '[toggles type="{{type}}"]{{clone}}[/toggles]',
				'options' => array(
					array(
						'id' => 'type',
						'name' => __('Type', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'bg' => __('With Background', 'mtheme'),
							'border' => __('With Border', 'mtheme'),
						),
					),			
				),
				'clone' => array(
					'shortcode' => '[toggle title="{{title}}"]{{content}}[/toggle]',
					'options' => array(
						array(
							'id' => 'title',
							'name' => __('Title', 'mtheme'),
							'type' => 'text',
						),		
						
						array(
							'id' => 'content',
							'name' => __('Content', 'mtheme'),							
							'type' => 'textarea',					
						),
					),
				),
			),
			
			/*Accordions*/
			array(
				'id' => 'accordions',
				'name' => __('Accordions', 'mtheme'),
				'shortcode' => '[accordions type="{{type}}"]{{clone}}[/accordions]',
				'options' => array(
					array(
						'id' => 'type',
						'name' => __('Type', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'bg' => __('With Background', 'mtheme'),
							'border' => __('With Border', 'mtheme'),
						),
					),			
				),
				'clone' => array(
					'shortcode' => '[toggle title="{{title}}"]{{content}}[/toggle]',
					'options' => array(
						array(
							'id' => 'title',
							'name' => __('Title', 'mtheme'),
							'type' => 'text',
						),		
						
						array(
							'id' => 'content',
							'name' => __('Content', 'mtheme'),							
							'type' => 'textarea',					
						),
					),
				),
			),
			/*Tabs*/
			array(
				'id' => 'tabs',
				'name' => __('Tabs', 'mtheme'),
				'shortcode' => '[tabs type="{{type}}"]{{clone}}[/tabs]',
				'options' => array(
					array(			
						'id' => 'type',
						'name' => __('Type', 'mtheme'),			
						'type' => 'select',
						'options' => array(
							'horizontal' => __('Horizontal', 'mtheme'),
							'vertical' => __('Vertical', 'mtheme'),
						),
					),
				),
				'clone' => array(
					'shortcode' => '[tab title="{{title}}"]{{content}}[/tab]',
					'options' => array(
						array(
							'id' => 'title',
							'name' => __('Title', 'mtheme'),
							'type' => 'text',
						),
						
						array(					
							'id' => 'content',
							'name' => __('Content', 'mtheme'),							
							'type' => 'textarea',						
						),
					),
				),
			),
			/*list*/
			array(
				'id' => 'list',
				'name' => __('List', 'mtheme'),
				'shortcode' => '[list type="{{type}}"]{{clone}}[/list]',
				'options' => array(
					array(
						'id' => 'type',
						'name' => __('Type', 'mtheme'),
						'type' => 'select',
						'options' => array(
							'unordered' => __('Unordered', 'mtheme'),
							'ordered' => __('Ordered', 'mtheme'),
						),
					),			
				),
				'clone' => array(
					'shortcode' => '[item type="{{item_type}}"]{{content}}[/item]',
					'options' => array(
						array(
							'id' => 'item_type',
							'name' => __('Style Type', 'mtheme'),
							'type' => 'select',
							'options' => array(
								'' => __('None', 'mtheme'),
								'circle' => __('circle', 'mtheme'),
								'arrow-circle-right' => __('arrow-circle-right', 'mtheme'),
								'arrow-circle-right' => __('arrow-circle-right', 'mtheme'),
								'square' => __('square', 'mtheme'),								
								'check-square' => __('check-square', 'mtheme'),
								'spinner' => __('spinner with spin', 'mtheme'),
								'spinner fa-spin' => __('spinner with spin', 'mtheme'),
							),
						),		
						
						array(
							'id' => 'content',
							'name' => __('Content', 'mtheme'),							
							'type' => 'textarea',					
						),
					),
				),
			),
			
			array(
				'id' => 'fancy',
				'name' => __('Fancy-title', 'mtheme'),
				'shortcode' => '{{clone}}',
				'clone' => array(
					'shortcode' => '[fancy-title align="{{align}}" border="{{border}}" heading="{{heading}}" ]{{content}}[/fancy-title]',
					'options' => array(	
						array(					
							'id' => 'align',
							'name' => __('Align', 'mtheme'),						
							'type' => 'select',
							'options' => array(
								'left' => __('Left Align', 'mtheme'),
								'center' => __('Center Align', 'mtheme'),
								'right' => __('Right Align', 'mtheme'),
							),
						),
						array(					
							'id' => 'border',
							'name' => __('Border', 'mtheme'),						
							'type' => 'select',
							'options' => array(
								'bottom' => __('Bottom', 'mtheme'),
								'title' => __('Title', 'mtheme'),
							),
						),
						array(					
							'id' => 'heading',
							'name' => __('Heading', 'mtheme'),						
							'type' => 'select',
							'options' => array(
								'h1' => __('H1', 'mtheme'),
								'h2' => __('H2', 'mtheme'),
								'h3' => __('H3', 'mtheme'),
								'h4' => __('H4', 'mtheme'),
								'h5' => __('H5', 'mtheme'),
								'h6' => __('H6', 'mtheme'),
							),
							'default' => 'h3'
						), 						
						array(					
							'id' => 'content',
							'name' => __('Content', 'mtheme'),						
							'type' => 'textarea',
							'default' => 'Fancy-title'
						),
					),
				),
			),
			array(
				'id' => 'event_intro',
				'name' => __('About Event', 'mtheme'),
				'shortcode' => '[event_intro event_id="{{event}}"]',
				'options' => array(
					array(
						'id' => 'event',
						'name' => __('Event', 'mtheme'),			
						'type' => 'select_post',
						'post_type' => 'event',
					),
				),
			),
			array(
				'id' => 'event_features',
				'name' => __('Event Features', 'mtheme'),
				'shortcode' => '[event_features event_id="{{event}}"]',
				'options' => array(
					array(
						'id' => 'event',
						'name' => __('Event', 'mtheme'),			
						'type' => 'select_post',
						'post_type' => 'event',
					),
				),
			),
			array(
				'id' => 'event_schedules',
				'name' => __('Event Schedules', 'mtheme'),
				'shortcode' => '[event_schedules category="{{category}}"]',
				'options' => array(
					array(
						'id' => 'category',
						'name' => __('Category', 'mtheme'),			
						'type' => 'select_category',
						'taxonomy' => 'schedule_cat',
					),
				),
			),
			array(
				'id' => 'event_brochure',
				'name' => __('Event Downloads', 'mtheme'),
				'shortcode' => '[event_brochure event_id="{{event}}"]',
				'options' => array(
					array(
						'id' => 'event',
						'name' => __('Event', 'mtheme'),			
						'type' => 'select_post',
						'post_type' => 'event',
					),
				),
			),
			array(
				'id' => 'event_speakers',
				'name' => __('Event Speakers', 'mtheme'),
				'shortcode' => '[event_speakers category="{{category}}" slider="{{slider}}"]',
				'options' => array(
					array(
						'id' => 'category',
						'name' => __('Category', 'mtheme'),			
						'type' => 'select_category',
						'taxonomy' => 'speaker_cat',
					),
					array(
						'id' => 'slider',
						'name' => __('Slider', 'mtheme'),			
						'type' => 'select',
						'options' => array(
							'yes' => __('Yes', 'mtheme'),
							'no' => __('No', 'mtheme')
						),
						'default' => 'yes'
					),
				),
			),
			array(
				'id' => 'event_packages',
				'name' => __('Event Packages', 'mtheme'),
				'shortcode' => '[event_packages category="{{category}}"]',
				'options' => array(
					array(
						'id' => 'category',
						'name' => __('Category', 'mtheme'),			
						'type' => 'select_category',
						'taxonomy' => 'package_cat',
					),
				),
			),
			array(
				'id' => 'event_sponsors',
				'name' => __('Event Sponsors', 'mtheme'),
				'shortcode' => '[event_sponsors category="{{category}}"]',
				'options' => array(
					array(
						'id' => 'category',
						'name' => __('Category', 'mtheme'),			
						'type' => 'select_category',
						'taxonomy' => 'sponsor_cat',
					),
				),
			),
			array(
				'id' => 'ThreeDImageSlider',
				'name' => __('Event ThreeDImage Slider', 'mtheme'),
				'shortcode' => '[ThreeDImageSlider category="{{category}}"]',
				'options' => array(
					array(
						'id' => 'category',
						'name' => __('Category', 'mtheme'),			
						'type' => 'select_category',
						'taxonomy' => 'gal_cat',
					),
				),
			),
			array(
				'id' => 'event_video',
				'name' => __('Event Video', 'mtheme'),
				'shortcode' => '[event_video event_id="{{event_id}}" title="{{title}}" video_url="{{video_url}}" video_type="{{video_type}}"]',
				'options' => array(	
					array(
						'id' => 'event_id',
						'name' => __('Event', 'mtheme'),			
						'type' => 'select_post',
						'post_type' => 'event',
					),
					array(					
						'id' => 'title',
						'name' => __('Title', 'mtheme'),						
						'type' => 'text',
						'default' => 'Video'
					),
					array(					
						'id' => 'video_url',
						'name' => __('Video Url', 'mtheme'),						
						'type' => 'text',
						'default' => ''
					),
					array(					
						'id' => 'video_type',
						'name' => __('Video type', 'mtheme'),						
						'type' => 'select',
						'options' => array(
							'vimeo' => __('Vimeo', 'mtheme'),
							'youtube' => __('Youtube', 'mtheme')
						),
						'default' => 'vimeo'
					),
				),
			),
			array(
				'id' => 'event_registration_form',
				'name' => __('Event Contact Form', 'mtheme'),
				'shortcode' => '[event_registration_form]',
				'options' => array(		
				),
			),
			array(
				'id' => 'event_notify_form',
				'name' => __('Event Notify Form', 'mtheme'),
				'shortcode' => '[event_notify_form]',
				'options' => array(		
				),
			),
			array(
				'id' => 'footer_contact',
				'name' => __('Contact Section', 'mtheme'),
				'shortcode' => '[footer_contact]',
				'options' => array(		
				),
			),
		),
		
		//Custom Styles
		'custom_styles' => array(
			
			array(
				'elements' => '.status',
				'attributes' => array(
					array(
						'name' => 'background-image',
						'option' => 'loading_image',
						'default' => THEME_URI.'site/img/loading.gif',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.header',
				'attributes' => array(
					array(
						'name' => 'background-color',
						'option' => 'header_color',
						'default' => '#0f1726',
						'important' => false,
					),
				),
			),			
			array(
				'elements' => '.blog-listing h1,.blog-listing h2,.blog-listing h3,.blog-listing h4,.blog-listing h5,.blog-listing h6,.posts-listing h1,.posts-listing h2,.posts-listing h3,.posts-listing h4,.posts-listing h5,.posts-listing h6,.page-heading h1,.sidebar .page_item a,.widget-title h3,.widget ul li a,td,caption,.tagcloud a,.post-content h1,.blog-listing h2,.post-content h3,.post-content h4,.post-content h5,.post-content h6',
				'attributes' => array(
					array(
						'name' => 'color',
						'option' => 'post_heading_color',
						'default' => '#0f1726',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.profile-name-discussion,.read-comment-head span,.nav-close fa',
				'attributes' => array(
					array(
						'name' => 'color',
						'option' => 'post_heading_color',
						'default' => '#0f1726',
						'important' => true,
					),
				),
			),
			array(
				'elements' => '.blog-listing div,.blog-listing p,.blog-listing span,.posts-listing div,.posts-listing p,.posts-listing span,.content,post-content div,.post-content p,.post-content span,.post-content .main-content .post-detail p',
				'attributes' => array(
					array(
						'name' => 'color',
						'option' => 'post_content_color',
						'default' => '#0f1726',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.scroll-header,.dropdown-menu',
				'attributes' => array(
					array(
						'name' => 'background-color',
						'option' => 'header_color',
						'default' => '#0f1726',
						'important' => true,
					),
				),
			),	
			array(
				'elements' => 'h1,h2,h3,h4,h5,h6',
				'attributes' => array(
					array(
						'name' => 'font-family',
						'option' => 'heading_font',
						'default' => 'Raleway',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '#wp-calendar thead tr th, #wp-calendar tbody tr td',
				'attributes' => array(
					array(
						'name' => 'border-color',
						'option' => 'post_heading_color',
						'default' => '#363738',
						'important' => false,
					),
				),
			),
			array(
				'elements' => 'h1,h2,h3,h4,h5,h6,.accordion .item .heading',
				'attributes' => array(
					array(
						'name' => 'color',
						'option' => 'heading_color',
						'default' => '#363738',
						'important' => false,
					),
				),
			),		
			array(
				'elements' => '.border_left,.border_bottom',
				'attributes' => array(
					array(
						'name' => 'border-color',
						'option' => 'heading_color',
						'default' => '#363738',
						'important' => false,
					),
				),
			),
			array(
				'elements' => 'html, body, div, span, applet, object, iframe, p, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video',
				'attributes' => array(
					array(
						'name' => 'font-family',
						'option' => 'content_font',
						'default' => 'Raleway',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.d-sch i,.fb i',
				'attributes' => array(
					array(
						'name' => 'color',
						'option' => 'content_color',
						'default' => '#5f6061',
						'important' => true,
					),
				),
			),
			array(
				'elements' => 'body, input, select, textarea, p, .accordion .item .heading .e-title,.accordion .item .content',
				'attributes' => array(
					array(
						'name' => 'color',
						'option' => 'content_color',
						'default' => '#5f6061',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.tagcloud a',
				'attributes' => array(
					array(
						'name' => 'border-color',
						'option' => 'post_content_color',
						'default' => '#5f6061',
						'important' => false,
					),
				),
			),			
			
			array(
				'elements' => 'a.btn-effect:hover, a.btn-effect:focus,.tabs nav a,.tc',
				'attributes' => array(
					array(
						'name' => 'color',
						'option' => 'primary_color',
						'default' => '#FFFFFF',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.social-btn i:hover, .social-btn i:focus,.social-btn:hover i,.md-trigger .fa,.nl-form.ajax-form a:hover,.md-trigger:hover,.page-numbers:hover,.page-numbers:focus,.page-numbers i:hover, .page-numbers i:focus,.page-numbers:hover i',
				'attributes' => array(
					array(
						'name' => 'color',
						'option' => 'primary_color',
						'default' => '#FFFFFF',
						'important' => true,
					),
				),
			),
			
			 
			array(
				'elements' => 'a.fb:hover,a.d-sch:hover,.active span,.widget li,.d-sch i:hover,.d-sch i:focus,.fb i:hover,.fb i:focus,.d-sch:hover i,.d-sch:focus i,.fb:hover i,.fb:focus i,.author-title,.nl-field-toggle,.nl-form.ajax-form input,.nl-form.ajax-form select,.nl-dd ul li.nl-dd-checked::before,.nl-submit::before,.nl-dd ul li.nl-dd-checked,.nl-dd ul li.nl-dd-checked::before,.nl-submit::before, .nl-field-go::before',
				'attributes' => array(
					array(
						'name' => 'color',
						'option' => 'secondary_color',
						'default' => '#1bd982',
						'important' => true,
					),
				),
			),
			array(
				'elements' => '.tabs nav ul li *:hover,.btn-effect,.tabs nav li.tab-current,#submit,.learn-more-btn,.flex-control-paging li a.flex-active,.flex-control-paging li a:hover,.social-btn:hover, .social-btn:focus,.form-notify button.submit-button,.input-group-btn > .btn:hover, .input-group-btn > .btn:focus, .input-group-btn > .btn:active,
				.fancy-title.bottom-border h1:after,.fancy-title.bottom-border h2:after,.fancy-title.bottom-border h3:after,
				.fancy-title.bottom-border h4:after,.fancy-title.bottom-border h5:after,.fancy-title.bottom-border h6:after,.social-ftp a',
				'attributes' => array(
					array(
						'name' => 'background-color',
						'option' => 'secondary_color',
						'default' => '#1bd982',
						'important' => false,
					),
				),
			),
			array(
				'elements' => 'a, a:hover, a:focus,.accordion .item.open .e-title,.navbar-default .navbar-nav > .active > a, .navbar-default .navbar-nav > .active > a:hover, .navbar-default .navbar-nav > .active > a:focus,.navbar-default .navbar-nav > li.active > a,.navbar-default .navbar-nav > li > a:hover, .navbar-default .navbar-nav > li > a:focus,.md-trigger,.sp-name,.contact-details h2 span,.form-notify  h2,.social-btn,.page-numbers,.page-numbers i,.dropdown-menu > li > a:hover, .dropdown-menu > li > a:focus,.fa,.post-date,.post-cat',
				'attributes' => array(
					array(
						'name' => 'color',
						'option' => 'secondary_color',
						'default' => '#1bd982',
						'important' => false,
					),
				),
			),
			array(
				'elements' => 'blockquote,#title_hr,.flex-control-paging li a,hr',
				'attributes' => array(
					array(
						'name' => 'border-color',
						'option' => 'secondary_color',
						'default' => '#1bd982',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.button.dark, .jp-gui, .header-wrap, .header-navigation ul ul, .select-menu, .search-form, .mobile-search-form, .login-button .tooltip-text, .footer-wrap, .site-footer:after, .site-header:after,.tabs nav ul li,.social-btn,.page-numbers,.flex-control-paging li a',
				'attributes' => array(
					array(
						'name' => 'background-color',
						'option' => 'background_color',
						'default' => '#212739',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.author-img img',
				'attributes' => array(
					array(
						'name' => 'border-color',
						'option' => 'background_color',
						'default' => '#212739',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.accordion .day,.light-box,.light-box:hover, .light-box:focus',
				'attributes' => array(
					array(
						'name' => 'color',
						'option' => 'tertiary_color',
						'default' => '#1bd982',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.accordion .item .heading .time,.nl-ti-text ul li.nl-ti-example',
				'attributes' => array(
					array(
						'name' => 'border-color',
						'option' => 'tertiary_color',
						'default' => '#1bd982',
						'important' => false,
					),
				),
			),			
			array(
				'elements' => '.page-numbers:hover, .page-numbers:focus',
				'attributes' => array(
					array(
						'name' => 'background-color',
						'option' => 'tertiary_color',
						'default' => '#212739',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.navbar-default .navbar-nav > li > a',
				'attributes' => array(
					array(
						'name' => 'font-size',
						'option' => 'menu_font_size',
						'default' => '0.91em',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.navbar-default .navbar-nav > li > a',
				'attributes' => array(
					array(
						'name' => 'color',
						'option' => 'menu_font_color',
						'default' => '#FFF',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.navbar-nav > li > a',
				'attributes' => array(
					array(
						'name' => 'padding-top',
						'option' => 'menu_padding_top',
						'default' => '30px',
						'important' => false,
					),
				),
			),
			array(
				'elements' => '.navbar-nav > li > a',
				'attributes' => array(
					array(
						'name' => 'padding-bottom',
						'option' => 'menu_padding_bottom',
						'default' => '30px',
						'important' => false,
					),
				),
			),
		),
		
		
		/*Fonts*/
		'fonts' => array(
			'ABeeZee' => 'ABeeZee',
			'Abel' => 'Abel',
			'Abril Fatface' => 'Abril Fatface',
			'Aclonica' => 'Aclonica',
			'Acme' => 'Acme',
			'Actor' => 'Actor',
			'Adamina' => 'Adamina',
			'Advent Pro' => 'Advent Pro',
			'Aguafina Script' => 'Aguafina Script',
			'Aladin' => 'Aladin',
			'Aldrich' => 'Aldrich',
			'Alegreya' => 'Alegreya',
			'Alegreya SC' => 'Alegreya SC',
			'Alex Brush' => 'Alex Brush',
			'Alfa Slab One' => 'Alfa Slab One',
			'Alice' => 'Alice',
			'Alike' => 'Alike',
			'Alike Angular' => 'Alike Angular',
			'Allan' => 'Allan',
			'Allerta' => 'Allerta',
			'Allerta Stencil' => 'Allerta Stencil',
			'Allura' => 'Allura',
			'Almendra' => 'Almendra',
			'Almendra SC' => 'Almendra SC',
			'Amaranth' => 'Amaranth',
			'Amatic SC' => 'Amatic SC',
			'Amethysta' => 'Amethysta',
			'Andada' => 'Andada',
			'Andika' => 'Andika',
			'Angkor' => 'Angkor',
			'Annie Use Your Telescope' => 'Annie Use Your Telescope',
			'Anonymous Pro' => 'Anonymous Pro',
			'Antic' => 'Antic',
			'Antic Didone' => 'Antic Didone',
			'Antic Slab' => 'Antic Slab',
			'Anton' => 'Anton',
			'Arapey' => 'Arapey',
			'Arbutus' => 'Arbutus',
			'Architects Daughter' => 'Architects Daughter',
			'Arimo' => 'Arimo',
			'Arizonia' => 'Arizonia',
			'Armata' => 'Armata',
			'Artifika' => 'Artifika',
			'Arvo' => 'Arvo',
			'Asap' => 'Asap',
			'Asset' => 'Asset',
			'Astloch' => 'Astloch',
			'Asul' => 'Asul',
			'Atomic Age' => 'Atomic Age',
			'Aubrey' => 'Aubrey',
			'Audiowide' => 'Audiowide',
			'Average' => 'Average',
			'Averia Gruesa Libre' => 'Averia Gruesa Libre',
			'Averia Libre' => 'Averia Libre',
			'Averia Sans Libre' => 'Averia Sans Libre',
			'Averia Serif Libre' => 'Averia Serif Libre',
			'Bad Script' => 'Bad Script',
			'Balthazar' => 'Balthazar',
			'Bangers' => 'Bangers',
			'Basic' => 'Basic',
			'Battambang' => 'Battambang',
			'Baumans' => 'Baumans',
			'Bayon' => 'Bayon',
			'Belgrano' => 'Belgrano',
			'Belleza' => 'Belleza',
			'Bentham' => 'Bentham',
			'Berkshire Swash' => 'Berkshire Swash',
			'Bevan' => 'Bevan',
			'Bigshot One' => 'Bigshot One',
			'Bilbo' => 'Bilbo',
			'Bilbo Swash Caps' => 'Bilbo Swash Caps',
			'Bitter' => 'Bitter',
			'Black Ops One' => 'Black Ops One',
			'Bokor' => 'Bokor',
			'Bonbon' => 'Bonbon',
			'Boogaloo' => 'Boogaloo',
			'Bowlby One' => 'Bowlby One',
			'Bowlby One SC' => 'Bowlby One SC',
			'Brawler' => 'Brawler',
			'Bree Serif' => 'Bree Serif',
			'Bubblegum Sans' => 'Bubblegum Sans',
			'Buda' => 'Buda',
			'Buenard' => 'Buenard',
			'Butcherman' => 'Butcherman',
			'Butterfly Kids' => 'Butterfly Kids',
			'Cabin' => 'Cabin',
			'Cabin Condensed' => 'Cabin Condensed',
			'Cabin Sketch' => 'Cabin Sketch',
			'Caesar Dressing' => 'Caesar Dressing',
			'Cagliostro' => 'Cagliostro',
			'Calligraffitti' => 'Calligraffitti',
			'Cambo' => 'Cambo',
			'Candal' => 'Candal',
			'Cantarell' => 'Cantarell',
			'Cantata One' => 'Cantata One',
			'Cardo' => 'Cardo',
			'Carme' => 'Carme',
			'Carter One' => 'Carter One',
			'Caudex' => 'Caudex',
			'Cedarville Cursive' => 'Cedarville Cursive',
			'Ceviche One' => 'Ceviche One',
			'Changa One' => 'Changa One',
			'Chango' => 'Chango',
			'Chau Philomene One' => 'Chau Philomene One',
			'Chelsea Market' => 'Chelsea Market',
			'Chenla' => 'Chenla',
			'Cherry Cream Soda' => 'Cherry Cream Soda',
			'Chewy' => 'Chewy',
			'Chicle' => 'Chicle',
			'Chivo' => 'Chivo',
			'Coda' => 'Coda',
			'Coda Caption' => 'Coda Caption',
			'Codystar' => 'Codystar',
			'Comfortaa' => 'Comfortaa',
			'Coming Soon' => 'Coming Soon',
			'Concert One' => 'Concert One',
			'Condiment' => 'Condiment',
			'Content' => 'Content',
			'Contrail One' => 'Contrail One',
			'Convergence' => 'Convergence',
			'Cookie' => 'Cookie',
			'Copse' => 'Copse',
			'Corben' => 'Corben',
			'Cousine' => 'Cousine',
			'Coustard' => 'Coustard',
			'Covered By Your Grace' => 'Covered By Your Grace',
			'Crafty Girls' => 'Crafty Girls',
			'Creepster' => 'Creepster',
			'Crete Round' => 'Crete Round',
			'Crimson Text' => 'Crimson Text',
			'Crushed' => 'Crushed',
			'Cuprum' => 'Cuprum',
			'Cutive' => 'Cutive',
			'Damion' => 'Damion',
			'Dancing Script' => 'Dancing Script',
			'Dangrek' => 'Dangrek',
			'Dawning of a New Day' => 'Dawning of a New Day',
			'Days One' => 'Days One',
			'Delius' => 'Delius',
			'Delius Swash Caps' => 'Delius Swash Caps',
			'Delius Unicase' => 'Delius Unicase',
			'Della Respira' => 'Della Respira',
			'Devonshire' => 'Devonshire',
			'Didact Gothic' => 'Didact Gothic',
			'Diplomata' => 'Diplomata',
			'Diplomata SC' => 'Diplomata SC',
			'Doppio One' => 'Doppio One',
			'Dorsa' => 'Dorsa',
			'Dosis' => 'Dosis',
			'Dr Sugiyama' => 'Dr Sugiyama',
			'Droid Sans' => 'Droid Sans',
			'Droid Sans Mono' => 'Droid Sans Mono',
			'Droid Serif' => 'Droid Serif',
			'Duru Sans' => 'Duru Sans',
			'Dynalight' => 'Dynalight',
			'EB Garamond' => 'EB Garamond',
			'Eater' => 'Eater',
			'Economica' => 'Economica',
			'Electrolize' => 'Electrolize',
			'Emblema One' => 'Emblema One',
			'Emilys Candy' => 'Emilys Candy',
			'Engagement' => 'Engagement',
			'Enriqueta' => 'Enriqueta',
			'Erica One' => 'Erica One',
			'Esteban' => 'Esteban',
			'Euphoria Script' => 'Euphoria Script',
			'Ewert' => 'Ewert',
			'Exo' => 'Exo',
			'Expletus Sans' => 'Expletus Sans',
			'Fanwood Text' => 'Fanwood Text',
			'Fascinate' => 'Fascinate',
			'Fascinate Inline' => 'Fascinate Inline',
			'Federant' => 'Federant',
			'Federo' => 'Federo',
			'Felipa' => 'Felipa',
			'Fjord One' => 'Fjord One',
			'Flamenco' => 'Flamenco',
			'Flavors' => 'Flavors',
			'Fondamento' => 'Fondamento',
			'Fontdiner Swanky' => 'Fontdiner Swanky',
			'Forum' => 'Forum',
			'Francois One' => 'Francois One',
			'Fredericka the Great' => 'Fredericka the Great',
			'Fredoka One' => 'Fredoka One',
			'Freehand' => 'Freehand',
			'Fresca' => 'Fresca',
			'Frijole' => 'Frijole',
			'Fugaz One' => 'Fugaz One',
			'GFS Didot' => 'GFS Didot',
			'GFS Neohellenic' => 'GFS Neohellenic',
			'Galdeano' => 'Galdeano',
			'Gentium Basic' => 'Gentium Basic',
			'Gentium Book Basic' => 'Gentium Book Basic',
			'Geo' => 'Geo',
			'Geostar' => 'Geostar',
			'Geostar Fill' => 'Geostar Fill',
			'Germania One' => 'Germania One',
			'Give You Glory' => 'Give You Glory',
			'Glass Antiqua' => 'Glass Antiqua',
			'Glegoo' => 'Glegoo',
			'Gloria Hallelujah' => 'Gloria Hallelujah',
			'Goblin One' => 'Goblin One',
			'Gochi Hand' => 'Gochi Hand',
			'Gorditas' => 'Gorditas',
			'Goudy Bookletter 1911' => 'Goudy Bookletter 1911',
			'Graduate' => 'Graduate',
			'Gravitas One' => 'Gravitas One',
			'Great Vibes' => 'Great Vibes',
			'Gruppo' => 'Gruppo',
			'Gudea' => 'Gudea',
			'Habibi' => 'Habibi',
			'Hammersmith One' => 'Hammersmith One',
			'Handlee' => 'Handlee',
			'Hanuman' => 'Hanuman',
			'Happy Monkey' => 'Happy Monkey',
			'Henny Penny' => 'Henny Penny',
			'Herr Von Muellerhoff' => 'Herr Von Muellerhoff',
			'Holtwood One SC' => 'Holtwood One SC',
			'Homemade Apple' => 'Homemade Apple',
			'Homenaje' => 'Homenaje',
			'IM Fell DW Pica' => 'IM Fell DW Pica',
			'IM Fell DW Pica SC' => 'IM Fell DW Pica SC',
			'IM Fell Double Pica' => 'IM Fell Double Pica',
			'IM Fell Double Pica SC' => 'IM Fell Double Pica SC',
			'IM Fell English' => 'IM Fell English',
			'IM Fell English SC' => 'IM Fell English SC',
			'IM Fell French Canon' => 'IM Fell French Canon',
			'IM Fell French Canon SC' => 'IM Fell French Canon SC',
			'IM Fell Great Primer' => 'IM Fell Great Primer',
			'IM Fell Great Primer SC' => 'IM Fell Great Primer SC',
			'Iceberg' => 'Iceberg',
			'Iceland' => 'Iceland',
			'Imprima' => 'Imprima',
			'Inconsolata' => 'Inconsolata',
			'Inder' => 'Inder',
			'Indie Flower' => 'Indie Flower',
			'Inika' => 'Inika',
			'Irish Grover' => 'Irish Grover',
			'Istok Web' => 'Istok Web',
			'Italiana' => 'Italiana',
			'Italianno' => 'Italianno',
			'Jim Nightshade' => 'Jim Nightshade',
			'Jockey One' => 'Jockey One',
			'Jolly Lodger' => 'Jolly Lodger',
			'Josefin Sans' => 'Josefin Sans',
			'Josefin Slab' => 'Josefin Slab',
			'Judson' => 'Judson',
			'Julee' => 'Julee',
			'Junge' => 'Junge',
			'Jura' => 'Jura',
			'Just Another Hand' => 'Just Another Hand',
			'Just Me Again Down Here' => 'Just Me Again Down Here',
			'Kameron' => 'Kameron',
			'Karla' => 'Karla',
			'Kaushan Script' => 'Kaushan Script',
			'Kelly Slab' => 'Kelly Slab',
			'Kenia' => 'Kenia',
			'Khmer' => 'Khmer',
			'Knewave' => 'Knewave',
			'Kotta One' => 'Kotta One',
			'Koulen' => 'Koulen',
			'Kranky' => 'Kranky',
			'Kreon' => 'Kreon',
			'Kristi' => 'Kristi',
			'Krona One' => 'Krona One',
			'La Belle Aurore' => 'La Belle Aurore',
			'Lancelot' => 'Lancelot',
			'Lato' => 'Lato',
			'League Script' => 'League Script',
			'Leckerli One' => 'Leckerli One',
			'Ledger' => 'Ledger',
			'Lekton' => 'Lekton',
			'Lemon' => 'Lemon',
			'Lilita One' => 'Lilita One',
			'Limelight' => 'Limelight',
			'Linden Hill' => 'Linden Hill',
			'Lobster' => 'Lobster',
			'Lobster Two' => 'Lobster Two',
			'Londrina Outline' => 'Londrina Outline',
			'Londrina Shadow' => 'Londrina Shadow',
			'Londrina Sketch' => 'Londrina Sketch',
			'Londrina Solid' => 'Londrina Solid',
			'Lora' => 'Lora',
			'Love Ya Like A Sister' => 'Love Ya Like A Sister',
			'Loved by the King' => 'Loved by the King',
			'Lovers Quarrel' => 'Lovers Quarrel',
			'Luckiest Guy' => 'Luckiest Guy',
			'Lusitana' => 'Lusitana',
			'Lustria' => 'Lustria',
			'Macondo' => 'Macondo',
			'Macondo Swash Caps' => 'Macondo Swash Caps',
			'Magra' => 'Magra',
			'Maiden Orange' => 'Maiden Orange',
			'Mako' => 'Mako',
			'Marck Script' => 'Marck Script',
			'Marko One' => 'Marko One',
			'Marmelad' => 'Marmelad',
			'Marvel' => 'Marvel',
			'Mate' => 'Mate',
			'Mate SC' => 'Mate SC',
			'Maven Pro' => 'Maven Pro',
			'Meddon' => 'Meddon',
			'MedievalSharp' => 'MedievalSharp',
			'Medula One' => 'Medula One',
			'Megrim' => 'Megrim',
			'Merienda One' => 'Merienda One',
			'Merriweather' => 'Merriweather',
			'Metal' => 'Metal',
			'Metamorphous' => 'Metamorphous',
			'Metrophobic' => 'Metrophobic',
			'Michroma' => 'Michroma',
			'Miltonian' => 'Miltonian',
			'Miltonian Tattoo' => 'Miltonian Tattoo',
			'Miniver' => 'Miniver',
			'Miss Fajardose' => 'Miss Fajardose',
			'Modern Antiqua' => 'Modern Antiqua',
			'Molengo' => 'Molengo',
			'Monofett' => 'Monofett',
			'Monoton' => 'Monoton',
			'Monsieur La Doulaise' => 'Monsieur La Doulaise',
			'Montaga' => 'Montaga',
			'Montez' => 'Montez',
			'Montserrat' => 'Montserrat',
			'Moul' => 'Moul',
			'Moulpali' => 'Moulpali',
			'Mountains of Christmas' => 'Mountains of Christmas',
			'Mr Bedfort' => 'Mr Bedfort',
			'Mr Dafoe' => 'Mr Dafoe',
			'Mr De Haviland' => 'Mr De Haviland',
			'Mrs Saint Delafield' => 'Mrs Saint Delafield',
			'Mrs Sheppards' => 'Mrs Sheppards',
			'Muli' => 'Muli',
			'Mystery Quest' => 'Mystery Quest',
			'Neucha' => 'Neucha',
			'Neuton' => 'Neuton',
			'News Cycle' => 'News Cycle',
			'Niconne' => 'Niconne',
			'Nixie One' => 'Nixie One',
			'Nobile' => 'Nobile',
			'Nokora' => 'Nokora',
			'Norican' => 'Norican',
			'Nosifer' => 'Nosifer',
			'Nothing You Could Do' => 'Nothing You Could Do',
			'Noticia Text' => 'Noticia Text',
			'Nova Cut' => 'Nova Cut',
			'Nova Flat' => 'Nova Flat',
			'Nova Mono' => 'Nova Mono',
			'Nova Oval' => 'Nova Oval',
			'Nova Round' => 'Nova Round',
			'Nova Script' => 'Nova Script',
			'Nova Slim' => 'Nova Slim',
			'Nova Square' => 'Nova Square',
			'Numans' => 'Numans',
			'Nunito' => 'Nunito',
			'Odor Mean Chey' => 'Odor Mean Chey',
			'Old Standard TT' => 'Old Standard TT',
			'Oldenburg' => 'Oldenburg',
			'Oleo Script' => 'Oleo Script',
			'Open Sans' => 'Open Sans',
			'Open Sans Condensed' => 'Open Sans Condensed',
			'Orbitron' => 'Orbitron',
			'Original Surfer' => 'Original Surfer',
			'Oswald' => 'Oswald',
			'Over the Rainbow' => 'Over the Rainbow',
			'Overlock' => 'Overlock',
			'Overlock SC' => 'Overlock SC',
			'Ovo' => 'Ovo',
			'Oxygen' => 'Oxygen',
			'PT Mono' => 'PT Mono',
			'PT Sans' => 'PT Sans',
			'PT Sans Caption' => 'PT Sans Caption',
			'PT Sans Narrow' => 'PT Sans Narrow',
			'PT Serif' => 'PT Serif',
			'PT Serif Caption' => 'PT Serif Caption',
			'Pacifico' => 'Pacifico',
			'Parisienne' => 'Parisienne',
			'Passero One' => 'Passero One',
			'Passion One' => 'Passion One',
			'Patrick Hand' => 'Patrick Hand',
			'Patua One' => 'Patua One',
			'Paytone One' => 'Paytone One',
			'Permanent Marker' => 'Permanent Marker',
			'Petrona' => 'Petrona',
			'Philosopher' => 'Philosopher',
			'Piedra' => 'Piedra',
			'Pinyon Script' => 'Pinyon Script',
			'Plaster' => 'Plaster',
			'Play' => 'Play',
			'Playball' => 'Playball',
			'Playfair Display' => 'Playfair Display',
			'Podkova' => 'Podkova',
			'Poiret One' => 'Poiret One',
			'Poller One' => 'Poller One',
			'Poly' => 'Poly',
			'Pompiere' => 'Pompiere',
			'Pontano Sans' => 'Pontano Sans',
			'Port Lligat Sans' => 'Port Lligat Sans',
			'Port Lligat Slab' => 'Port Lligat Slab',
			'Prata' => 'Prata',
			'Preahvihear' => 'Preahvihear',
			'Press Start 2P' => 'Press Start 2P',
			'Princess Sofia' => 'Princess Sofia',
			'Prociono' => 'Prociono',
			'Prosto One' => 'Prosto One',
			'Puritan' => 'Puritan',
			'Quantico' => 'Quantico',
			'Quattrocento' => 'Quattrocento',
			'Quattrocento Sans' => 'Quattrocento Sans',
			'Questrial' => 'Questrial',
			'Quicksand' => 'Quicksand',
			'Qwigley' => 'Qwigley',
			'Radley' => 'Radley',
			'Raleway' => 'Raleway',
			'Rammetto One' => 'Rammetto One',
			'Rancho' => 'Rancho',
			'Rationale' => 'Rationale',
			'Redressed' => 'Redressed',
			'Reenie Beanie' => 'Reenie Beanie',
			'Revalia' => 'Revalia',
			'Ribeye' => 'Ribeye',
			'Ribeye Marrow' => 'Ribeye Marrow',
			'Righteous' => 'Righteous',
			'Roboto' => 'Roboto',
			'Roboto Condensed' => 'Roboto Condensed',
			'Rochester' => 'Rochester',
			'Rock Salt' => 'Rock Salt',
			'Rokkitt' => 'Rokkitt',
			'Ropa Sans' => 'Ropa Sans',
			'Rosario' => 'Rosario',
			'Rosarivo' => 'Rosarivo',
			'Rouge Script' => 'Rouge Script',
			'Ruda' => 'Ruda',
			'Ruge Boogie' => 'Ruge Boogie',
			'Ruluko' => 'Ruluko',
			'Ruslan Display' => 'Ruslan Display',
			'Russo One' => 'Russo One',
			'Ruthie' => 'Ruthie',
			'Sail' => 'Sail',
			'Salsa' => 'Salsa',
			'Sanchez' => 'Sanchez',
			'Sancreek' => 'Sancreek',
			'Sansita One' => 'Sansita One',
			'Sarina' => 'Sarina',
			'Satisfy' => 'Satisfy',
			'Schoolbell' => 'Schoolbell',
			'Seaweed Script' => 'Seaweed Script',
			'Sevillana' => 'Sevillana',
			'Shadows Into Light' => 'Shadows Into Light',
			'Shadows Into Light Two' => 'Shadows Into Light Two',
			'Shanti' => 'Shanti',
			'Share' => 'Share',
			'Shojumaru' => 'Shojumaru',
			'Short Stack' => 'Short Stack',
			'Siemreap' => 'Siemreap',
			'Sigmar One' => 'Sigmar One',
			'Signika' => 'Signika',
			'Signika Negative' => 'Signika Negative',
			'Simonetta' => 'Simonetta',
			'Sirin Stencil' => 'Sirin Stencil',
			'Six Caps' => 'Six Caps',
			'Slackey' => 'Slackey',
			'Smokum' => 'Smokum',
			'Smythe' => 'Smythe',
			'Sniglet' => 'Sniglet',
			'Snippet' => 'Snippet',
			'Sofia' => 'Sofia',
			'Sonsie One' => 'Sonsie One',
			'Sorts Mill Goudy' => 'Sorts Mill Goudy',
			'Special Elite' => 'Special Elite',
			'Spicy Rice' => 'Spicy Rice',
			'Spinnaker' => 'Spinnaker',
			'Spirax' => 'Spirax',
			'Squada One' => 'Squada One',
			'Stardos Stencil' => 'Stardos Stencil',
			'Stint Ultra Condensed' => 'Stint Ultra Condensed',
			'Stint Ultra Expanded' => 'Stint Ultra Expanded',
			'Stoke' => 'Stoke',
			'Sue Ellen Francisco' => 'Sue Ellen Francisco',
			'Sunshiney' => 'Sunshiney',
			'Supermercado One' => 'Supermercado One',
			'Suwannaphum' => 'Suwannaphum',
			'Swanky and Moo Moo' => 'Swanky and Moo Moo',
			'Syncopate' => 'Syncopate',
			'Tangerine' => 'Tangerine',
			'Taprom' => 'Taprom',
			'Telex' => 'Telex',
			'Tenor Sans' => 'Tenor Sans',
			'The Girl Next Door' => 'The Girl Next Door',
			'Tienne' => 'Tienne',
			'Tinos' => 'Tinos',
			'Titan One' => 'Titan One',
			'Trade Winds' => 'Trade Winds',
			'Trocchi' => 'Trocchi',
			'Trochut' => 'Trochut',
			'Trykker' => 'Trykker',
			'Tulpen One' => 'Tulpen One',
			'Ubuntu' => 'Ubuntu',
			'Ubuntu Condensed' => 'Ubuntu Condensed',
			'Ubuntu Mono' => 'Ubuntu Mono',
			'Ultra' => 'Ultra',
			'Uncial Antiqua' => 'Uncial Antiqua',
			'UnifrakturCook' => 'UnifrakturCook',
			'UnifrakturMaguntia' => 'UnifrakturMaguntia',
			'Unkempt' => 'Unkempt',
			'Unlock' => 'Unlock',
			'Unna' => 'Unna',
			'VT323' => 'VT323',
			'Varela' => 'Varela',
			'Varela Round' => 'Varela Round',
			'Vast Shadow' => 'Vast Shadow',
			'Vibur' => 'Vibur',
			'Vidaloka' => 'Vidaloka',
			'Viga' => 'Viga',
			'Voces' => 'Voces',
			'Volkhov' => 'Volkhov',
			'Vollkorn' => 'Vollkorn',
			'Voltaire' => 'Voltaire',
			'Waiting for the Sunrise' => 'Waiting for the Sunrise',
			'Wallpoet' => 'Wallpoet',
			'Walter Turncoat' => 'Walter Turncoat',
			'Wellfleet' => 'Wellfleet',
			'Wire One' => 'Wire One',
			'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
			'Yellowtail' => 'Yellowtail',
			'Yeseva One' => 'Yeseva One',
			'Yesteryear' => 'Yesteryear',
			'Zeyada' => 'Zeyada',
		),		
	),
	
	/*Theme Options*/
	'options' => array(
	
		/*General*/
		array(	
			'name' => __('General', 'mtheme'),
			'title' => 'General Options',
			'type' => 'section'
		),
			array(	
				'name' => __('Site Favicon', 'mtheme'),
				'description' => __('Choose an image to replace the default site favicon', 'mtheme'),
				'id' => 'favicon',
				'type' => 'uploader',
			),
			array(	
				'name' => __('Site Logo', 'mtheme'),
				'description' => __('Choose an image to replace the default theme logo', 'mtheme'),
				'id' => 'site_logo',
				'type' => 'uploader',
			),
			array(	
				'name' => __('Logo Alt Text', 'mtheme'),
				'description' => __('Provide text Alt for Logo', 'mtheme'),
				'id' => 'logo_text',
				'type' => 'text',
			),
			array(	
				'name' => __('Loading Image', 'mtheme'),
				'description' => __('Choose an loading image to replace the default loading image', 'mtheme'),
				'id' => 'loading_image',
				'type' => 'uploader',
			),			
			array(	
				'name' => __('Nice Scrool Active', 'mtheme'),
				'description' => __('Nice Scrool Active', 'mtheme'),
				'id' => 'nice_scrool',
				'type' => 'checkbox',
				'default' => 'true',				
			),
			array(	
				'name' => __('Snow Fall Effect Image', 'mtheme'),
				'description' => __('Browse Snow Fall Effect Image', 'mtheme'),
				'id' => 'snow_img',
				'type' => 'uploader',
			),			
			array(	
				'name' => __('Astronomy Effect dot color', 'mtheme'),
				'default' => '#919191',
				'id' => 'dotColor',
				'type' => 'color',
			),
			array(	
				'name' => __('Astronomy Effect line color', 'mtheme'),
				'default' => '#919191',
				'id' => 'lineColor',
				'type' => 'color',
			),
			array(	
				'name' => __('Astronomy Effect line width', 'mtheme'),
				'description' => __('Enter Astronomy Effect line width', 'mtheme'),
				'id' => 'lineWidth',
				'type' => 'text',
				'default' => '1',
			),
			array(	
				'name' => __('Astronomy Effect particle radius', 'mtheme'),
				'description' => __('Enter Astronomy Effect particle radius in number ex: 3', 'mtheme'),
				'id' => 'particleRadius',
				'type' => 'text',
				'default' => '5',
			),
		/*Styling*/
		array(	
			'name' => __('General Styling', 'mtheme'),
			'title' => 'Styling Options',
			'type' => 'section'
		),		
			array(	
				'name' => __('Background Color', 'mtheme'),
				'default' => '#212739',
				'id' => 'background_color',
				'type' => 'color',
			),
			array(	
				'name' => __('Primary Color', 'mtheme'),
				'default' => '#ffffff',
				'id' => 'primary_color',
				'type' => 'color',
			),

			array(	
				'name' => __('Secondary Color', 'mtheme'),
				'default' => '#1bd982',
				'id' => 'secondary_color',
				'type' => 'color',
			),
			array(	
				'name' => __('Tertiary Color', 'mtheme'),
				'default' => '#1bd982',
				'id' => 'tertiary_color',
				'type' => 'color',
			),					
			array(	
				'name' => __('Heading Font' ,'mtheme'),					
				'id' => 'heading_font',
				'default' => 'Raleway',
				'type' => 'select_font',
			),
			array(	
				'name' => __('Heading Color', 'mtheme'),
				'default' => '#363738',
				'id' => 'heading_color',
				'type' => 'color',
				'description' => __('paragraph, td tag color', 'mtheme'),
			),
			
			array(	
				'name' => __('Content Font', 'mtheme'),
				'id' => 'content_font',
				'default' => 'Raleway',
				'type' => 'select_font',
			),
			array(	
				'name' => __('Content Color', 'mtheme'),
				'default' => '#5f6061',
				'id' => 'content_color',
				'type' => 'color',
				'description' => __('paragraph, span, td tag color', 'mtheme'),
			),
			array(	
				'name' => __('Custom CSS', 'mtheme'),
				'description' => __('Enter custom CSS code to overwrite the default theme styles', 'mtheme'),
				'id' => 'css',
				'type' => 'textarea',
				'default' => '',
			),	
			array(	
				'name' => __('Custom JS', 'mtheme'),
				'description' => __('Enter custom js code to add functinality like google analytics', 'mtheme'),
				'id' => 'js',
				'type' => 'textarea',
				'default' => '',
			),
		/*Styling*/
		array(	
			'name' => __('Header Styling', 'mtheme'),
			'title' => 'Styling Options',
			'type' => 'section'
		),
			array(	
				'name' => __('Header/Footer Background Color', 'mtheme'),
				'default' => '#0f1726',
				'id' => 'header_color',
				'type' => 'color',
			),
			array(	
				'name' => __('Menu Item font color', 'mtheme'),
				'default' => '#FFF',
				'id' => 'menu_font_color',
				'type' => 'color',
			),
			array(	
				'name' => __('Menu Item font size', 'mtheme'),
				'default' => '0.91em',
				'description' => __('Enter Menu Item font size( Ex: 1em)', 'mtheme'),
				'id' => 'menu_font_size',
				'type' => 'text',
			),
			array(	
				'name' => __('Menu Item padding top', 'mtheme'),
				'default' => '30px',
				'id' => 'menu_padding_top',
				'description' => __('Enter Menu Item padding top( Ex: 30px)', 'mtheme'),
				'type' => 'text',
			),
			array(	
				'name' => __('Menu Item padding bottom', 'mtheme'),
				'default' => '30px',
				'description' => __('Enter Menu Item padding bottom( Ex: 30px)', 'mtheme'),
				'id' => 'menu_padding_bottom',
				'type' => 'text',
			),
		/*SEO*/
		array(	
			'name' => __('SEO Setting', 'mtheme'),
			'title' => 'SEO Setting Options',
			'type' => 'section'
		),
			array(	
				'name' => __('Meta Author', 'mtheme'),
				'default' => 'multia.in',
				'id' => 'meta_author',
				'type' => 'text',
				'description' => __('Type your meta author', 'mtheme'),
			),
			array(	
				'name' => __('Meta Author', 'mtheme'),
				'default' => 'multia.in',
				'id' => 'meta_author',
				'type' => 'text',
				'description' => __('Type your meta author', 'mtheme'),
			),
			array(	
				'name' => __('Meta Description', 'mtheme'),
				'default' => '',
				'id' => 'meta_description',
				'type' => 'textarea',
				'description' => __("Type your meta description. Googlebot loves it if it's not exceeding 160 characters or 20 words", 'mtheme'),
			),
			array(	
				'name' => __('Meta Keyword', 'mtheme'),
				'default' => 'multia.in',
				'id' => 'meta_keywords',
				'type' => 'text',
				'description' => __("Type your meta keyword separed by comma. Googlebot loves it if it's not exceeding 160 characters or 20 words", 'mtheme'),
			),
		/*Post Styling*/
		array(	
			'name' => __('Post Styling', 'mtheme'),
			'title' => 'Post Styling Options',
			'type' => 'section'
		),
			array(	
				'name' => __('Heading Color', 'mtheme'),
				'default' => '#363738',
				'id' => 'post_heading_color',
				'type' => 'color',
				'description' => __('Heading color', 'mtheme'),
			),			
			array(	
				'name' => __('Content Color', 'mtheme'),
				'default' => '#5f6061',
				'id' => 'post_content_color',
				'type' => 'color',
				'description' => __('Content color', 'mtheme'),
			),
			array(	
				'name' => __('Header Transparent Active', 'mtheme'),
				'description' => __('Header transparent active', 'mtheme'),
				'id' => 'post_header_transparent',
				'type' => 'checkbox',
				'default' => 'true',
				'wrap' => true,
			),
			array(	
				'name' => __('Post Layout', 'mtheme'),
				'id' => 'posts_layout',
				'default' => 'right',
				'type' => 'select_image',
				'options' => array(
					'fullwidth' => MTHEME_URI.'assets/images/layouts/layout-full.png',
					'left' => MTHEME_URI.'assets/images/layouts/layout-left.png',
					'right' => MTHEME_URI.'assets/images/layouts/layout-right.png',				
				),				
			),	
			array(	
				'name' => __('Background Zoom Effect', 'mtheme'),
				'id' => 'image_url_zoom',
				'description' => __('ON/OFF Background Zoom Effect', 'mtheme'),
				'type' => 'select',
				'options' => array(
					'on' => __('ON', 'mtheme'),
					'off' => __('OFF', 'mtheme')
				),
				'wrap' => true,
			),
			array(	
				'name' => __('Post Background', 'mtheme'),
				'id' => 'post_height_type',
				'type' => 'select',
				'options' => array(					
					'auto' => __('Fullwidth', 'mtheme'),	
					'custom' => __('Custom Height', 'mtheme')	
				),
				'description' => __('Post Background Height', 'mtheme'),
				'defendency-set' => 'on'
			),
			array(	
				'name' => __('Post Background Height', 'mtheme'),
				'description' => __('Enter Post Background Height', 'mtheme'),
				'id' => 'post_bg_height',
				'type' => 'text',
				'defendency' => array('base'=>'mtheme','parent'=>'.mtheme-option','id'=>'post_height_type','value'=>'custom','show'=>'off')
			),
			array(	
				'name' => __('Overlay Active Option', 'mtheme'),
				'description' => __('Overlay Active Option', 'mtheme'),
				'id' => 'post_overlay_active',
				'type' => 'checkbox',
				'default' => 'true',
				'defendency-set' => 'on',
				'wrap' => true,
			),
			array(	
				'name' => __('Overlay Image', 'mtheme'),
				'id' => 'post_overlay_image',
				'description' => __('Choose overlay image', 'mtheme'),
				'type' => 'uploader',
				'defendency' => array('base'=>'mtheme','parent'=>'.mtheme-option','id'=>'post_overlay_active','value'=>'true','show'=>'off'),
				'wrap' => true,
				'default'=> CHILD_URI.'site/img/backgrounds/bg_pattern.png',
			),
			array(	
				'name' => __('Youtube/HTML-5/Vimeo Audio Option', 'mtheme'),
				'description' => __('Youtube/HTML-5/Vimeo Audio Option', 'mtheme'),
				'id' => 'post_video_audio',
				'type' => 'select',
				'options' => array(							
					'play' => __('Paly', 'mtheme'),
					'muted' => __('Mute', 'mtheme')
				),
			),
			array(	
				'name' => __('Youtube/HTML-5/Vimeo Sound Icon Option', 'mtheme'),
				'id' => 'post_sound_icon',
				'type' => 'select',
				'options' => array(					
					'yes' => __('Yes', 'mtheme'),	
					'no' => __('No', 'mtheme')	
				),
				'description' => __('Youtube/HTML-5/Vimeo Sound Icon Option', 'mtheme')
			),
			array(	
				'name' => __('Slider Auto Play', 'mtheme'),
				'description' => __('Is Slider Auto Play', 'mtheme'),
				'id' => 'post_slider_autoplay',
				'type' => 'checkbox',
				'default' => 'true',
				'defendency-set' => 'on',
				'wrap' => true,
			),
			array(	
				'name' => __('Hide Navigation Arrow', 'mtheme'),
				'id' => 'post_slides_nav',
				'description' => __('Is Hide Navigation Arrow', 'mtheme'),
				'type' => 'checkbox',
				'default' => 'true',
				'wrap' => true,
			),
			array(	
				'name' => __('Slider Speed', 'mtheme'),
				'id' => 'post_slider_speed',
				'description' => __('Slider speed in MS i.e. 5000 (1 Sec)', 'mtheme'),
				'type' => 'select',
				'options' => array(
					'1000' => __('1 Second', 'mtheme'),
					'2000' => __('2 Seconds', 'mtheme'),
					'3000' => __('3 Seconds', 'mtheme'),
					'4000' => __('4 Seconds', 'mtheme'),
					'5000' => __('5 Seconds', 'mtheme'),
					'6000' => __('6 Seconds', 'mtheme'),
					'7000' => __('7 Seconds', 'mtheme'),
					'8000' => __('8 Seconds', 'mtheme'),
					'9000' => __('9 Seconds', 'mtheme'),
					'10000' => __('10 Seconds', 'mtheme'),
					'15000' => __('15 Seconds', 'mtheme'),
					'20000' => __('20 Seconds', 'mtheme'),
					'50000' => __('30 Seconds', 'mtheme'),
					'100000' => __('1 Minute', 'mtheme'),
				),
				'default' => '5000',
				'defendency' => array('base'=>'mtheme','parent'=>'.mtheme-option','id'=>'post_slider_autoplay','value'=>'true','show'=>'off'),
				'wrap' => true,
			),
			
		/*Contact Form*/
		array(
			'name' => __('Registration Form', 'mtheme'),
			'title' => 'Registration Option',
			'type' => 'section',
		),
			
			array(	
				'name' => __('Background Image', 'mtheme'),
				'description' => __('Choose an background image or color', 'mtheme'),
				'id' => 'contact_form_bg_img',
				'type' => 'uploader'
			),
			array(	
				'name' => __('Background color', 'mtheme'),
				'description' => __('Choose an background color or image', 'mtheme'),
				'id' => 'contact_form_bg_color',
				'type' => 'color',
				'default' => '#212739',
			),
			array(	
				'name' => __('Primary color', 'mtheme'),
				'description' => __('Choose an primary color', 'mtheme'),
				'id' => 'contact_form_p_color',
				'type' => 'color',
				'default' => '#FFF',
			),
			array(	
				'name' => __('Secondary color', 'mtheme'),
				'description' => __('Choose an secondary color', 'mtheme'),
				'id' => 'contact_form_s_color',
				'type' => 'color',
				'default' => '#1bce7c',
			),			
			array(	
				'name' => __('Registration title', 'mtheme'),
				'description' => __('Enter Registration title', 'mtheme'),
				'id' => 'registration_title',
				'type' => 'text',
				'default' => '',
			),
			array(	
				'name' => __('Registration content', 'mtheme'),
				'description' => __('Enter Registration content', 'mtheme'),
				'id' => 'registration_content',
				'type' => 'textarea',
				'default' => '',
			),
			array(	
				'name' => __('Receiving Email Id', 'mtheme'),
				'description' => __('Enter Receiving Email Id If empty we use admin', 'mtheme'),
				'id' => 'reg_admin_email',
				'type' => 'text',
				'default' => '',
			),			
			array(
				'id' => 'MthemeForm',
				'slug' => 'contact',
				'type' => 'module',
			),	
			array(	
				'name' => __('Registration Terms Active', 'mtheme'),
				'description' => __('Registration Terms Active', 'mtheme'),
				'id' => 'terms_active',
				'type' => 'checkbox',
				'default' => 'false',
			),				
			array(	
				'name' => __('Terms title before text', 'mtheme'),
				'description' => __('Enter Terms title before text', 'mtheme'),
				'id' => 'terms_title_pre',
				'type' => 'text',
				'default' => '',
			),
			array(	
				'name' => __('Terms title', 'mtheme'),
				'description' => __('Enter Terms title', 'mtheme'),
				'id' => 'terms_title',
				'type' => 'text',
				'default' => 'Terms',
			),
			array(	
				'name' => __('Terms title after text', 'mtheme'),
				'description' => __('Enter Terms title after text', 'mtheme'),
				'id' => 'terms_title_suf',
				'type' => 'text',
				'default' => '',
			),
			array(	
				'name' => __('Terms content', 'mtheme'),
				'description' => __('Enter Terms content', 'mtheme'),
				'id' => 'terms_content',
				'type' => 'textarea',
				'default' => '',
			),
		
		/*Notify Me*/
		array(
			'name' => __('Notification Setting', 'mtheme'),
			'title' => 'Notification Setting',
			'type' => 'section',
		),	
			array(	
				'name' => __('Background Image', 'mtheme'),
				'description' => __('Choose an background image or color', 'mtheme'),
				'id' => 'notify_bg_img',
				'type' => 'uploader'
			),
			array(	
				'name' => __('Background color', 'mtheme'),
				'description' => __('Choose an background color or image', 'mtheme'),
				'id' => 'notify_bg_color',
				'type' => 'color',
				'default' => '#212739',
			),
			array(	
				'name' => __('Primary color', 'mtheme'),
				'description' => __('Choose an primary color', 'mtheme'),
				'id' => 'notify_p_color',
				'type' => 'color',
				'default' => '#FFF',
			),
			array(	
				'name' => __('Secondary color', 'mtheme'),
				'description' => __('Choose an secondary color', 'mtheme'),
				'id' => 'notify_s_title',
				'type' => 'color',
				'default' => '#1bce7c',
			),	
			array(	
				'name' => __('Notify Button Title', 'mtheme'),
				'description' => __('Enter Notify Button title', 'mtheme'),
				'id' => 'notify_button_heading',
				'type' => 'text',
				'default' => 'Subscribe'
			),		
			array(	
				'name' => __('MailChimp API Key', 'mtheme'),
				'description' => __('Provide MailChimp API Key', 'mtheme'),
				'id' => 'api_key',
				'type' => 'text',
				'default' => 'cb6a20c0676b26b78e8f18f047b619a2-us8'
			),
			array(	
				'name' => __('MailChimp List Id', 'mtheme'),
				'description' => __('Provide MailChimp List Id', 'mtheme'),
				'id' => 'list_id',
				'type' => 'text',
				'default' => '6ffa2b9330'
			),			
			array(	
				'name' => __('Notification Email Id', 'mtheme'),
				'description' => __('Enter Notification Email Id If empty we use admin', 'mtheme'),
				'id' => 'notify_admin_email',
				'type' => 'text',
				'default' => '',
			),
			array(	
				'name' => __('Notification title', 'mtheme'),
				'description' => __('Enter Notification title', 'mtheme'),
				'id' => 'notify_title',
				'type' => 'text',
				'default' => 'Notification',
			),
			array(	
				'name' => __('Notification content', 'mtheme'),
				'description' => __('Enter Notification content', 'mtheme'),
				'id' => 'notify_content',
				'type' => 'textarea',
				'default' => '',
			),
		/*Contact*/
		array(
			'name' => __('Contact Section', 'mtheme'),
			'title' => 'Contact Options',
			'type' => 'section',
		),
			array(
				'name' => __('Show Contact In Footer', 'mtheme'),
				'description' => __('Show Contact In Footer', 'mtheme'),
				'id' => 'contact_active',
				'type' => 'checkbox',
				'default' => 'true',
			),
			array(	
				'name' => __('Background Image', 'mtheme'),
				'description' => __('Choose an background image or color', 'mtheme'),
				'id' => 'contact_bg_img',
				'type' => 'uploader'
			),
			array(	
				'name' => __('Background color', 'mtheme'),
				'description' => __('Choose an background color or image', 'mtheme'),
				'id' => 'contact_bg_color',
				'type' => 'color',
				'default' => '#FFF',
			),
			array(	
				'name' => __('Heading color', 'mtheme'),
				'description' => __('Choose an Heading color', 'mtheme'),
				'id' => 'contact_p_color',
				'type' => 'color',
				'default' => '#212739',
			),
			array(	
				'name' => __('Content color', 'mtheme'),
				'description' => __('Choose an Content color', 'mtheme'),
				'id' => 'contact_s_color',
				'type' => 'color',
				'default' => '#1bce7c',
			),
			
			array(	
				'name' => __('Contact title', 'mtheme'),
				'description' => __('Enter Contact title', 'mtheme'),
				'id' => 'contact_title',
				'type' => 'text',
				'default' => 'Conatct',
			),
			array(	
				'name' => __('Contact description', 'mtheme'),
				'description' => __('Enter Contact description', 'mtheme'),
				'id' => 'contact_desc',
				'type' => 'textarea',
				'default' => '',
			),
			array(	
				'name' => __('Address Title', 'mtheme'),
				'description' => __('Enter Contact Address Title', 'mtheme'),
				'id' => 'contact_address_heading',
				'type' => 'text',
				'default' => 'Address',				
			),
			array(	
				'name' => __('Address', 'mtheme'),
				'description' => __('Enter Contact address', 'mtheme'),
				'id' => 'contact_add',
				'type' => 'textarea',
				'default' => '',
			),
			array(	
				'name' => __('Phone Title', 'mtheme'),
				'description' => __('Enter Contact Phone Title', 'mtheme'),
				'id' => 'contact_phone_heading',
				'type' => 'text',
				'default' => 'Phone',
			),
			array(	
				'name' => __('Phone', 'mtheme'),
				'description' => __('Enter Contact phone', 'mtheme'),
				'id' => 'contact_phone',
				'type' => 'textarea',
				'default' => '',
			),
			array(	
				'name' => __('Email Title', 'mtheme'),
				'description' => __('Enter Contact Email Title', 'mtheme'),
				'id' => 'contact_email_heading',
				'type' => 'text',
				'default' => 'Email',
			),
			array(	
				'name' => __('Email', 'mtheme'),
				'description' => __('Enter Contact Email', 'mtheme'),
				'id' => 'contact_email',
				'type' => 'textarea',
				'default' => '',
			),
			array(	
				'name' => __('Google Map Title', 'mtheme'),
				'description' => __('Enter Google Map Title', 'mtheme'),
				'id' => 'contact_gmap_heading',
				'type' => 'text',
				'default' => 'Location',
			),
			array(	
				'name' => __('Google Map', 'mtheme'),
				'description' => __('Enter Google Map', 'mtheme'),
				'id' => 'contact_gmap',
				'type' => 'text',
				'default' => '#',
			),
		
		/*Social Media*/
		array(
			'name' => __('Social Media', 'mtheme'),
			'title' => 'Social Media Options',
			'type' => 'section',
		),
			array(	
				'name' => __('Show Social Media Icons', 'mtheme'),
				'description' => __('Show Social Media Icons', 'mtheme'),
				'id' => 'social_active',
				'type' => 'checkbox',
				'default' => 'true',				
			),
			array(	
				'name' => __('Social Icon Background', 'mtheme'),
				'id' => 'social_background',
				'type' => 'select',
				'options' => array(			
					'circle' => __('Circle', 'mtheme'),				
					'rounded' => __('Rounded', 'mtheme'),
					'no' => __('Transparent', 'mtheme')
				),
				'description' => __('Show Type', 'mtheme'),
			),
			array(	
				'name' => __('Dribbble', 'mtheme'),
				'description' => __('Enter Dribbble', 'mtheme'),
				'id' => 'contact_dribble',
				'type' => 'text',
			),
			array(	
				'name' => __('Twitter', 'mtheme'),
				'description' => __('Enter Twitter', 'mtheme'),
				'id' => 'contact_twitter',
				'type' => 'text',
			),
			array(	
				'name' => __('Facebook', 'mtheme'),
				'description' => __('Enter Facebook', 'mtheme'),
				'id' => 'contact_fb',
				'type' => 'text',
			),
			array(	
				'name' => __('Skype', 'mtheme'),
				'description' => __('Enter Skype', 'mtheme'),
				'id' => 'contact_skype',
				'type' => 'text',
			),
			array(	
				'name' => __('Soundcloud', 'mtheme'),
				'description' => __('Enter Soundcloud', 'mtheme'),
				'id' => 'contact_soundcloud',
				'type' => 'text',
			),			
			array(	
				'name' => __('You Tube', 'mtheme'),
				'description' => __('Enter You Tube', 'mtheme'),
				'id' => 'contact_tube',
				'type' => 'text',
			),
			array(	
				'name' => __('Instagram', 'mtheme'),
				'description' => __('Enter instagram', 'mtheme'),
				'id' => 'contact_instagram',
				'type' => 'text',
			),
			array(	
				'name' => __('Google Plus', 'mtheme'),
				'description' => __('Enter Google Plus', 'mtheme'),
				'id' => 'contact_google',
				'type' => 'text',
			),
			array(	
				'name' => __('Linked In', 'mtheme'),
				'description' => __('Enter Linked In', 'mtheme'),
				'id' => 'contact_linked',
				'type' => 'text',
			),
			array(	
				'name' => __('Whats App', 'mtheme'),
				'description' => __('Enter Whats App', 'mtheme'),
				'id' => 'contact_whatsapp',
				'type' => 'text',
			),
			array(	
				'name' => __('Pinterest', 'mtheme'),
				'description' => __('Enter Pinterest', 'mtheme'),
				'id' => 'contact_pinterest',
				'type' => 'text',
			),
			array(	
				'name' => __('Flickr', 'mtheme'),
				'description' => __('Enter Flickr', 'mtheme'),
				'id' => 'contact_flickr',
				'type' => 'text',
			), 
			array(	
				'name' => __('Behance', 'mtheme'),
				'description' => __('Enter Behance', 'mtheme'),
				'id' => 'contact_behance',
				'type' => 'text',
			),
			array(	
				'name' => __('Rss', 'mtheme'),
				'description' => __('Enter Rss', 'mtheme'),
				'id' => 'contact_rss',
				'type' => 'text',
			),
			array(	
				'name' => __('Blogger', 'mtheme'),
				'description' => __('Enter Blogger', 'mtheme'),
				'id' => 'contact_btc',
				'type' => 'text',
			),
			array(	
				'name' => __('Email Id', 'mtheme'),
				'description' => __('Enter Mail Id', 'mtheme'),
				'id' => 'contact_mail',
				'type' => 'text',
			),
		/*Footer*/
		array(
			'name' => __('Footer', 'mtheme'),
			'title' => 'Footer Options',
			'type' => 'section',
		),			
			array(	
				'name' => __('Show footer', 'mtheme'),
				'description' => __('Show footer', 'mtheme'),
				'id' => 'footer_active',
				'type' => 'checkbox',
				'default' => 'true',				
			),
			array(	
				'name' => __('Disclaimer title', 'mtheme'),
				'description' => __('Enter Disclaimer title', 'mtheme'),
				'id' => 'declaration_title',
				'type' => 'text',
				'default' => 'Disclaimer',				
			),
			array(	
				'name' => __('Disclaimer content', 'mtheme'),
				'description' => __('Enter Disclaimer content', 'mtheme'),
				'id' => 'declaration_content',
				'type' => 'textarea',
				'default' => '',
			),
			array(	
				'name' => __('Enter Made in title', 'mtheme'),
				'description' => __('Enter Made in title', 'mtheme'),
				'id' => 'made_in_title',
				'type' => 'text',
				'default' => 'Made in Multia',
			),
			array(	
				'name' => __('Enter Made in link', 'mtheme'),
				'description' => __('Enter Made in link', 'mtheme'),
				'id' => 'made_in_link',
				'type' => 'text',
				'default' => '#',
			),
	),
	
);