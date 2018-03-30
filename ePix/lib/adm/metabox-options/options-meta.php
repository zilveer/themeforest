<?php
/**
 * Include and setup custom metaboxes (cmb) and fields.
 *
 * @category Themeva
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'nv_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function nv_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	// Sidebar Array
	if( !of_get_option('sidebars_num') ) $sidebars = '2'; else $sidebars = of_get_option('sidebars_num');
	
	for( $i=1; $i<=$sidebars; $i++ )
	{
		$sidebar_array[$i] = array( 'name' => 'Sidebar '.$i, 'value' => 'Sidebar'.$i, );
	}
	
	// Get Menus
	$menus = get_terms('nav_menu');
	
	$menu_array[] = array( 'name' => 'Default', 'value' => '', );
	
	foreach( $menus as $value )
	{
		$menu_array[$value->name] = array( 'name' => $value->name, 'value' => $value->name, );
	} 
	
	$menu_array[] = array( 'name' => 'Disable', 'value' => 'disable', );

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	
	$transition_effect = array(
		array( 'name' => 'linear', 'value' => 'linear' ),
		array( 'name' => 'easeInSine', 'value' => 'easeInSine' ),
		array( 'name' => 'easeOutSine', 'value' => 'easeOutSine' ),
		array( 'name' => 'easeInOutSine', 'value' => 'easeInOutSine' ),
		array( 'name' => 'easeInCubic', 'value' => 'easeInCubic' ),
		array( 'name' => 'easeOutCubic', 'value' => 'easeOutCubic' ),
		array( 'name' => 'easeInOutCubic', 'value' => 'easeInOutCubic' ),
		array( 'name' => 'easeInQuint', 'value' => 'easeInQuint' ),
		array( 'name' => 'easeOutQuint', 'value' => 'easeOutQuint' ),
		array( 'name' => 'easeInOutQuint', 'value' => 'easeInOutQuint' ),
		array( 'name' => 'easeInCirc', 'value' => 'easeInCirc' ),
		array( 'name' => 'easeOutCirc', 'value' => 'easeOutCirc' ),
		array( 'name' => 'easeInOutCirc', 'value' => 'easeInOutCirc' ),
		array( 'name' => 'easeInBack', 'value' => 'easeInBack' ),
		array( 'name' => 'easeOutBack', 'value' => 'easeOutBack' ),
		array( 'name' => 'easeInOutBack', 'value' => 'easeInOutBack' ),
		array( 'name' => 'easeInQuad', 'value' => 'easeInQuad' ),
		array( 'name' => 'easeOutQuad', 'value' => 'easeOutQuad' ),
		array( 'name' => 'easeInOutQuad', 'value' => 'easeInOutQuad' ),
		array( 'name' => 'easeInQuart', 'value' => 'easeInQuart' ),
		array( 'name' => 'easeOutQuart', 'value' => 'easeOutQuart' ),
		array( 'name' => 'easeInOutQuart', 'value' => 'easeInOutQuart' ),
		array( 'name' => 'easeInExpo', 'value' => 'easeInExpo' ),
		array( 'name' => 'easeOutExpo', 'value' => 'easeOutExpo' ),
		array( 'name' => 'easeInOutExpo', 'value' => 'easeInOutExpo' ),
		array( 'name' => 'easeInElastic', 'value' => 'easeInElastic' ),
		array( 'name' => 'easeOutElastic', 'value' => 'easeOutElastic' ),
		array( 'name' => 'easeInOutElastic', 'value' => 'easeInOutElastic' ),
		array( 'name' => 'easeInBounce', 'value' => 'easeInBounce' ),
		array( 'name' => 'easeOutBounce', 'value' => 'easeOutBounce' ),
		array( 'name' => 'easeInOutBounce', 'value' => 'easeInOutBounce' ),
	);

	$title_overlay = array(
		array( 'name' => 'Disabled', 'value' => 'disabled' ),
		array( 'name' => 'Center Left Light', 'value' => 'center left light' ),
		array( 'name' => 'Center Right Light', 'value' => 'center right light' ),
		array( 'name' => 'Center Middle Light', 'value' => 'center middle light' ),
		array( 'name' => 'Center Left Dark', 'value' => 'center left dark' ),
		array( 'name' => 'Center Right Dark', 'value' => 'center right dark' ),
		array( 'name' => 'Center Middle Dark', 'value' => 'center middle dark' ),
		array( 'name' => 'Top Left Light', 'value' => 'top left light' ),
		array( 'name' => 'Top Right Light', 'value' => 'top right light' ),
		array( 'name' => 'Top Middle Light', 'value' => 'top middle light' ),
		array( 'name' => 'Top Left Dark', 'value' => 'top left dark' ),
		array( 'name' => 'Top Right Dark', 'value' => 'top right dark' ),
		array( 'name' => 'Top Middle Dark', 'value' => 'top middle dark' ),
		array( 'name' => 'Bottom Left Light', 'value' => 'bottom left light' ),
		array( 'name' => 'Bottom Right Light', 'value' => 'bottom right light' ),
		array( 'name' => 'Bottom Middle Light', 'value' => 'bottom middle light' ),
		array( 'name' => 'Bottom Left Dark', 'value' => 'bottom left dark' ),
		array( 'name' => 'Bottom Right Dark', 'value' => 'bottom right dark' ),
		array( 'name' => 'Bottom Middle Dark', 'value' => 'bottom middle dark' ),																				
	);

	// Stage Content Array //_nv_mod
	$stage_content = array(
		array( 'name' => 'Image', 'value' => 'image' ),
		array( 'name' => 'Image / Text Overlay (Left)', 'value' => 'textimageleft' ),
		array( 'name' => 'Image / Text Overlay (Right)', 'value' => 'textimageright' ),
		array( 'name' => 'Image / Title Overlay (Hover)', 'value' => 'titleoverlay' ),
		array( 'name' => 'Image / Text Overlay (Hover)', 'value' => 'titletextoverlay' ),
		array( 'name' => 'Image / Text Overlay', 'value' => 'textoverlay' ),
		array( 'name' => 'Text', 'value' => 'textonly' ),
	);	


	// Skin ID's
	$skin_ids = explode(',', rtrim( get_option('skins_epix_ids'), ',' ) );
	
	$skin_id_array[] = array( 'name' => 'Select Skin', 'value' =>'' );
	
	foreach( $skin_ids as $skin_id )
	{
		$skin_id_array[] = array( 'name' => $skin_id, 'value' => $skin_id, );
	}
	

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/lib/adm/images/';	

	$meta_boxes[] = array(
		'id'         => 'x_layout_metabox',
		'title'      => 'Page Config',
		'pages'      => array( 'page', 'post', 'portfolio' ), // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'     => __( 'General Options', 'themeva_admin' ),
				'desc'     => __( 'General page configuration options.', 'themeva_admin' ),
				'id'       => $prefix . 'general_title',
				'type'     => 'title',
			),			
			array(
				'name'    => 'Display Title',
				'id'      => $prefix . 'displaytitle',
				'type'    => 'radio_inline',
				'size'	  => 'medium',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Enable', 'value' => '', ),
					array( 'name' => 'Disable', 'value' => 'disable', ),
				),
			),				
			array(
				'name' => 'Alternative Page Title',
				'desc' => '',
				'desc'     => __( 'Enter the word <em>BLANK</em> to hide the title.', 'themeva_admin' ),
				'id'   => $prefix . 'pagetitle',
				'type' => 'text',
			),	
			array(
				'name' => 'Sub Title',
				'desc' => '',
				'plac' => '',
				'id'   => $prefix . 'pagesubtitle',
				'type' => 'text',
			),	
			array(
				'name'    => 'Site Layout',
				'id'      => $prefix . 'wide_layout',
				'type'    => 'select',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Default', 'value' => '', ),
					array( 'name' => 'Boxed', 'value' => 'disable', ),
					array( 'name' => 'Wide', 'value' => 'enable', ),
					array( 'name' => 'Wide + Boxed Content', 'value' => 'wide_boxed', ),
				),
			),							
			array(
				'name'    => 'Page Layout',
				'desc'    => '',
				'id'      => $prefix . 'layout',
				'type'    => 'select',
				'options' => array(
					'' => array(
						'path' => $imagepath . 'layout-1.png',
						'name' => 'Default'
					 ),
					'layout_one' => array(
						'path' => $imagepath . 'layout-1.png',
						'name' => 'No Sidebar'
					 ),
					'layout_two' => array(
						'path' => $imagepath . 'layout-2.png',
						'name' => '1x Left Sidebar'
					 ),	
					'layout_three' => array(
						'path' => $imagepath . 'layout-3.png',
						'name' => '2x Left Sidebar'
					 ),
					'layout_four' => array(
						'path' => $imagepath . 'layout-4.png',
						'name' => '1x Right Sidebar'
					 ),
					'layout_five' => array(
						'path' => $imagepath . 'layout-5.png',
						'name' => '2x Right Sidebar'
					 ),	
					'layout_six' => array(
						'path' => $imagepath . 'layout-6.png',
						'name' => 'Left + Right Sidebar'
					 ),						 				 					 				 		 
				),
			),	
			array(
				'name'    => 'Column 1 Sidebar',
				'desc'    => '',
				'id'      => $prefix . 'sidebar_one',
				'type'    => 'select',
				'std'	  => 'Sidebar1',
				'options' => $sidebar_array
			),	
			array(
				'name'    => 'Column 2 Sidebar',		
				'desc'    => '',
				'id'      => $prefix . 'sidebar_two',
				'type'    => 'select',
				'std'	  => 'Sidebar2',
				'options' => $sidebar_array
			),
			array(
				'name'     => __( 'Header / Menu', 'themeva_admin' ),
				'desc'     => __( 'These options relate to the Header & Menu areas.', 'themeva_admin' ),
				'id'       => $prefix . 'headermenu_title',
				'type'     => 'title',
			),	
			array(
				'name'    => 'Floating Header',
				'id'      => $prefix . 'header_float',
				'desc' => __( 'Enable the header to float over page content, including the option to set to transparent.', 'themeva_admin' ),
				'type'    => 'radio_inline',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Normal', 'value' => '', ),
					array( 'name' => 'Float', 'value' => 'header_float', ),
					array( 'name' => 'Float + Transparent', 'value' => 'header_float header_transparent', ),
				),
			),				
			array(
				'name'    => 'Collapse Header',
				'id'      => $prefix . 'collapse_menu',
				'type'    => 'radio_inline',
				'std'		  => '',
				'desc'     => __( 'Displays an icon to enable / disable the menu.', 'themeva_admin' ),
				'options' => array(
					array( 'name' => 'Default', 'value' => '', ),
					array( 'name' => 'Off', 'value' => 'disable-callapse-menu', ),
					array( 'name' => 'Desktop & Mobile', 'value' => 'collapse-menu', ),
					array( 'name' => 'Mobile', 'value' => 'collapse-menu-mobile', )
				),
			),								
			array(
				'name'    => 'Menu',
				'desc'    => '',
				'id'      => $prefix . 'menu',
				'type'    => 'select',
				'options' => $menu_array
			),			
			array(
				'name' => __( 'Main / Footer', 'themeva_admin' ),
				'desc' => __( 'These options relate to the Main & Footer areas.', 'themeva_admin' ),
				'id'   => $prefix . 'mainfooter_title',
				'type' => 'title',
			),
			array(
				'name'    => 'Footer',
				'id'      => $prefix . 'disablefooter',
				'type'    => 'radio_inline',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Off', 'value' => 'yes', ),
					array( 'name' => 'On', 'value' => '', ),
				),
			),	
			array(
				'name'     => __( 'Additional Options', 'themeva_admin' ),
				'desc'     => __( 'Aditional page configuration options.', 'themeva_admin' ),
				'id'       => $prefix . 'additional_title',
				'type'     => 'title',
			),		
			array(
				'name'    => 'Breadcrumbs',
				'id'      => $prefix . 'hidebreadcrumbs',
				'type'    => 'radio_inline',
				'size'	  => 'medium',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Default', 'value' => '', ),
					array( 'name' => 'Disable', 'value' => 'yes', ),
				),
			),	
			array(
				'name'    => 'Author Name',
				'id'      => $prefix . 'authorname',
				'type'    => 'radio_inline',
				'size'	  => 'medium',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Default', 'value' => '', ),
					array( 'name' => 'Enable', 'value' => 'yes', ),
					array( 'name' => 'Disable', 'value' => 'disable', ),
				),
			),							
			array(
				'name'    => 'Publish Date',
				'id'      => $prefix . 'postdate',
				'type'    => 'radio_inline',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Off', 'value' => '', ),
					array( 'name' => 'On', 'value' => 'yes', ),
				),
			),																						
		),
	);
	
	$meta_boxes[] = array(
		'id'         => 'x_gallery_metabox',
		'title'      => 'Add Gallery',
		'pages'      => array( 'page','portfolio' ), // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, // Show field names on the left
		'fields'     => array(					
			array(
				'name'    => 'Gallery Type',
				'desc'    => '',
				'id'      => $prefix . 'gallery',
				'type'    => 'radio_inline',
				'std'	  => 'nogallery',
				'data'	  => 'gallery',
				'class'   => 'control', // container class
				'options' => array(
					'nogallery' => array(
						'path' => $imagepath . 'gallery-none.png',
						'name' => 'None',
						'data' => 'none'
					 ),
					'stageslider' => array(
						'path' => $imagepath . 'gallery-a.png',
						'name' => 'Stage',
						'data' => 'a'
					 ),	
					'groupslider' => array(
						'path' => $imagepath . 'gallery-d.png',
						'name' => 'GroupSlider',
						'data' => 'd'
					 ),
					'gridgallery' => array(
						'path' => $imagepath . 'gallery-e.png',
						'name' => 'Grid',
						'data' => 'e'
					 ),
					'carousel' => array(
						'path' => $imagepath . 'gallery-g.png',
						'name' => 'Carousel',
						'data' => 'g'
					 ),			
					'fullslider' => array(
						'path' => $imagepath . 'gallery-a.png',
						'name' => 'Fullscreen Slider',
						'data' => 'i'
					 ),				 		 						 					 					 			 				 					 				 		 
				),
			),
			array(
				'name' => 'Revolution Slider ID',
				'class'	  => 'gallery_section show_h',
				'id'   => $prefix . 'data-7',
				'theme'	  => 'b',
				'type' => 'text',
			),			
			array(
				'name'    => 'Data Source',
				'id'      => $prefix . 'datasource_selector',
				'type'    => 'select',
				'theme'	  => 'b',
				'class'   => 'gallery_section show_all hide_h datasource_select', // container class
				'options' => data_source_list()
			),				
			array(
				'name' => 'Attached Media ID',
				'class'	  => 'data-1 data-source',
				'id'   => $prefix . 'data-1',
				'theme'	  => 'b',
				'type' => 'text',
			),			
			array(
				'name'    => 'Post Category',
				'id'      => $prefix . 'data-2',
				'class'	  => 'data-2 data-source',
				'type'    => 'multicheck',
				'theme'	  => 'b',
				'options' => get_data_source('data-2')
			),
			array(
				'name'    => 'Filter by Format',
				'id'      => $prefix . 'data-2-formats',
				'type'    => 'select',
				'theme'	  => 'b',
				'class'   => 'data-2 data-source', // container class
				'options' => get_data_source('data-2-formats')
			),							
			array(
				'name'    => 'Flickr',
				'id'      => $prefix . 'data-3',
				'class'	  => 'data-3 data-source',
				'type'    => 'multicheck',
				'theme'	  => 'b',
				'options' => get_data_source('data-3')
			),
			array(
				'name'    => 'Slide Manager Sets',
				'id'      => $prefix . 'data-4',
				'class'	  => 'data-4 data-source hide_h',
				'type'    => 'multicheck',
				'theme'	  => 'b',
				'options' => get_data_source('data-4')
			),	
			array(
				'name'    => 'Product Categories',
				'id'      => $prefix . 'data-5',
				'class'	  => 'data-5 data-source',
				'type'    => 'multicheck',
				'theme'	  => 'b',
				'options' => get_data_source('data-5')
			),
			array(
				'name'    => 'Product Tags',
				'id'      => $prefix . 'data-5-tags',
				'class'	  => 'data-5 data-source',
				'type'    => 'multicheck',
				'theme'	  => 'b',
				'options' => get_data_source('data-5-tags')
			),				
			array(
				'name'    => 'Portfolio Category',
				'id'      => $prefix . 'data-6',
				'class'	  => 'data-6 data-source',
				'type'    => 'multicheck',
				'theme'	  => 'b',
				'options' => get_data_source('data-6')
			),			
			array(
				'name'    => 'Page / Post ID',
				'id'      => $prefix . 'data-8',
				'class'	  => 'data-8 data-source',
				'theme'	  => 'b',
				'type' => 'text',
				'plac' => 'Comma separate e.g. 1234,4321',
			),			
			array(
				'name'    => 'Sort Posts by',
				'id'      => $prefix . 'gallerysortby',
				'type'    => 'select',
				'theme'	  => 'b',
				'class'   => 'data-1 data-2 data-5 data-6 data-8 data-source', // container class
				'options' => array(
					array( 'name' => 'Post Order', 'value' => '' ),
					array( 'name' => 'Date', 'value' => 'date' ),
					array( 'name' => 'Random', 'value' => 'rand' ),
					array( 'name' => 'Title', 'value' => 'title' ),
				),
			),
			array(
				'name'    => 'Order Posts by',
				'id'      => $prefix . 'galleryorderby',
				'type'    => 'select',
				'theme'	  => 'b',
				'class'   => 'data-1 data-2 data-5 data-6 data-8 data-source', // container class
				'options' => array(
					array( 'name' => 'Ascending', 'value' => 'ASC' ),
					array( 'name' => 'Descending', 'value' => 'DESC' ),
				),
			),	
			array(
				'name' => 'Excerpt',
				'class'   => 'data-1 data-2 data-5 data-6 data-8 data-source', // container class
				'id'   => $prefix . 'gallerynpostexcerpt',
				'type' => 'text',
			),
			array(
				'name' => 'Posts Limit',
				'class'   => 'data-1 data-2 data-5 data-6 data-8 data-source', // container class
				'id'   => $prefix . 'gallerynumposts',
				'type' => 'text',
			),		
			array(
				'name'    => 'Lazy Load',
				'id'      => $prefix . 'load_ajax',
				'type'    => 'radio_inline',
				'std'		  => '',
				'class'	  => 'data-4 data-source', // container class',
				'options' => array(
					array( 'name' => 'Disabled', 'value' => '', ),
					array( 'name' => 'Enable', 'value' => 'auto_load', ),
				),
			),		
			array(
				'name' => 'Lazy Load Initial Limit',
				'class'	  => 'data-4 data-source',
				'id'   => $prefix . 'load_limit',
				'type' => 'text_small',
				'plac' => '',
			),	
			array(
				'name' => 'Slides Per Lazy Load',
				'class'	  => 'show_e data-4 data-source',
				'desc'     => __( 'For Grid Gallery Only.', 'themeva_admin' ),
				'id'   => $prefix . 'load_value',
				'type' => 'text_small',
				'plac' => '',
			),																				
			array(
				'name'    => 'Slide Content',
				'id'      => $prefix . 'groupgridcontent',
				'type'    => 'select',
				'class'	  => 'gallery_section show_a show_d show_e show_g show_i',
				'options' => array(
					array( 'name' => 'Title & Text + Image', 'value' => 'textimage' ),
					array( 'name' => 'Title + Image', 'value' => 'titleimage' ),
					array( 'name' => 'Title & Text on Hover + Image', 'value' => 'titletextoverlay' ),	
					array( 'name' => 'Title on Hover + Image', 'value' => 'titleoverlay' ),
					array( 'name' => 'Image', 'value' => 'image' ),									
				),
			),
			array(
				'name'    => 'Column Padding',
				'id'      => $prefix . 'columnpadding',
				'type'    => 'radio_inline',
				'std'		  => '',
				'class'   => 'gallery_section show_e', // container class
				'options' => array(
					array( 'name' => 'Off', 'value' => '', ),
					array( 'name' => 'On', 'value' => 'column_padding', ),
				),
			),					
			array(
				'name'    => 'Image Effect',
				'id'      => $prefix . 'imageeffect',
				'type'    => 'select',
				'class'   => 'gallery_section show_all hide_f hide_h  hide_i', // container class
				'options' => array(
					array( 'name' => 'No Effect', 'value' => 'none', ),
					array( 'name' => 'Frame', 'value' => 'frame', ),
					array( 'name' => 'Black & White', 'value' => 'blackwhite', ),
					array( 'name' => 'Frame + Black & White', 'value' => 'frameblackwhite', ),
				),
			),
			array(
				'name'    => 'Image Ratio',
				'id'      => $prefix . 'carousel_ratio',
				'type'    => 'radio_inline',
				'std'		  => '16:9',
				'class'   => 'gallery_section show_g', // container class
				'options' => array(
					array( 'name' => '16:9', 'value' => '16:9', ),
					array( 'name' => '4:3', 'value' => '4:3', ),
					array( 'name' => '1:1', 'value' => '1:1', ),
					array( 'name' => '9:16', 'value' => '9:16', ),
					array( 'name' => '3:4', 'value' => '3:4', ),
					array( 'name' => '3:2', 'value' => '3:2', ),
					array( 'name' => '2:3', 'value' => '2:3', )
				),
			),				
			array(
				'name'    => 'Lightbox',
				'id'      => $prefix . 'lightbox',
				'type'    => 'radio_inline',
				'std'		  => '',
				'class'   => 'gallery_section show_all hide_c hide_f hide_h hide_i', // container class
				'options' => array(
					array( 'name' => 'Off', 'value' => '', ),
					array( 'name' => 'On', 'value' => 'yes', ),
				),
			),
			array(
				'name'    => 'Zoom Hover',
				'id'      => $prefix . 'zoomhover',
				'type'    => 'radio_inline',
				'std'		  => '',
				'class'   => 'gallery_section show_all hide_c hide_f hide_h hide_i hide_g', // container class
				'options' => array(
					array( 'name' => 'Off', 'value' => '', ),
					array( 'name' => 'On', 'value' => 'zoomhover', ),
				),
			),			
			array(
				'name'    => 'Auto-Hide Menu',
				'id'      => $prefix . 'autohide_menu',
				'type'    => 'radio_inline',
				'std'		  => '',
				'class'   => 'gallery_section show_i', // container class
				'options' => array(
					array( 'name' => 'Off', 'value' => '', ),
					array( 'name' => 'On', 'value' => 'auto-hide', ),
				),
			),			
			array(
				'name' => 'Auto-Hide Menu Timeout',
				'class'	  => 'gallery_section show_i',
				'id'   => $prefix . 'autohide_menu_timeout',
				'type' => 'text_small',
				'plac' => 'Default is: 10 ( equals 10 seconds )',
			),	
			array(
				'name' => 'Image Width',
				'class'	  => 'gallery_section show_all hide_h hide_g hide_i',
				'id'   => $prefix . 'imgwidth',
				'desc'     => __( 'pixels', 'themeva_admin' ),
				'type' => 'text_small',
			),	
			array(
				'name' => 'Image Height',
				'class'	  => 'gallery_section show_all hide_h hide_g hide_i',
				'id'   => $prefix . 'imgheight',
				'desc'     => __( 'pixels', 'themeva_admin' ),
				'type' => 'text_small',
			),
			array(
				'name' => 'Gallery Height',
				'class'	  => 'gallery_section show_a',
				'id'   => $prefix . 'galleryheight',
				'desc'     => __( 'pixels', 'themeva_admin' ),
				'type' => 'text_small',
			),			
			array(
				'name' => 'Slide Timeout',
				'class'	  => 'gallery_section show_all hide_e hide_h',
				'id'   => $prefix . 'stagetimeout',
				'type' => 'text_small',
				'desc'     => __( 'seconds', 'themeva_admin' ),
				'plac' => 'In seconds e.g. 10',
			),
			array(
				'name'    => 'Navigation',
				'id'      => $prefix . 'stageplaypause',
				'type'    => 'select',
				'class'	  => 'gallery_section show_a show_c show_i',
				'options' => array(
					array( 'name' => 'Bullet', 'value' => '' ),
					array( 'name' => 'Directional', 'value' => 'leftrightonly' ),
					array( 'name' => 'Bullet + Directional', 'value' => 'enabled' ),
					array( 'name' => 'Bullet + Pause', 'value' => 'bulletpause' ),
					array( 'name' => 'Directional + Pause', 'value' => 'leftrightpause' ),
					array( 'name' => 'Bullet + Directional + Pause', 'value' => 'enabledpause' ),
					array( 'name' => 'Disabled', 'value' => 'disabled' ),
				),
			),
			array(
				'name'    => 'Columns',
				'id'      => $prefix . 'gridcolumns',
				'type'    => 'select',
				'class'	  => 'gallery_section show_d show_e',
				'options' => array(
					array( 'name' => '3 Columns', 'value' => '3' ),
					array( 'name' => '1 Column', 'value' => '1' ),
					array( 'name' => '2 Columns', 'value' => '2' ),
					array( 'name' => '4 Columns', 'value' => '4' ),
					array( 'name' => '5 Columns', 'value' => '5' ),
					array( 'name' => '6 Columns', 'value' => '6' ),
					array( 'name' => '7 Columns', 'value' => '7' ),
					array( 'name' => '8 Columns', 'value' => '8' ),
					array( 'name' => '9 Columns', 'value' => '9' ),
					array( 'name' => '10 Columns', 'value' => '10' ),
					array( 'name' => '11 Columns', 'value' => '11' ),
					array( 'name' => '12 Columns', 'value' => '12' ),
				),
			),
			array(
				'name'    => 'Masonry',
				'id'      => $prefix . 'gridmasonry',
				'type'    => 'radio_inline',
				'std'		  => '',
				'class'	  => 'gallery_section show_e',
				'options' => array(
					array( 'name' => 'Off', 'value' => '', ),
					array( 'name' => 'On', 'value' => 'masonry', ),
				),
			),
			array(
				'name'    => 'Category Filtering',
				'id'      => $prefix . 'gridfilter',
				'type'    => 'radio_inline',
				'std'		  => '',
				'class'   => 'gallery_section show_e', // container class
				'options' => array(
					array( 'name' => 'Off', 'value' => '', ),
					array( 'name' => 'On', 'value' => 'yes', ),
				),
			),
			array(
				'name'    => 'Image Alignment',
				'id'      => $prefix . 'sliderimagealign',
				'type'    => 'radio_inline',
				'class'	  => 'gallery_section show_d',
				'std'		  => 'center',
				'options' => array(
					array( 'name' => 'Left', 'value' => 'left', ),
					array( 'name' => 'Center', 'value' => 'center', ),
					array( 'name' => 'Right', 'value' => 'right', ),
				),
			),
			array(
				'name'    => 'Layout Format',
				'id'      => $prefix . 'sliderlayout',
				'type'    => 'radio_inline',
				'class'	  => 'gallery_section show_d',
				'options' => array(
					array( 'name' => 'Horizontal', 'value' => '', ),
					array( 'name' => 'Vertical', 'value' => 'vertical', ),
				),
			),
			array(
				'name'    => 'Transition Effect',
				'id'      => $prefix . 'stagetransition',
				'type'    => 'select',
				'class'	  => 'gallery_section show_a show_i',
				'options' => array(
					array( 'name' => 'fade + zoom', 'value' => 'fadeZoom' ),
					array( 'name' => 'fade', 'value' => 'fade' ),
					array( 'name' => 'cover', 'value' => 'cover' ),	
					array( 'name' => 'scrollHorz', 'value' => 'scrollHorz' ),
					array( 'name' => 'scrollVert', 'value' => 'scrollVert' ),
					array( 'name' => 'shuffle', 'value' => 'shuffle' ),
					array( 'name' => 'none', 'value' => 'none' ),
				),
			),
			array(
				'name'    => 'Transition Tween',
				'id'      => $prefix . 'stagetween',
				'type'    => 'select',
				'class'	  => 'gallery_section show_a show_i',
				'options' => $transition_effect
			),			
		),
	);

	$meta_boxes[] = array(
		'id'         => 'x_social_metabox',
		'title'      => 'Social',
		'pages'      => array( 'page', 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, // Show field names on the left
		'fields'     => get_social_options(),
	);
	
	$meta_boxes[] = array(
		'id'         => 'x_blog_metabox',
		'title'      => 'Blog',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
			array(
				'name'    => 'Select Categories',
				'id'      => $prefix . 'archivecat',
				'class'	  => '',
				'type'    => 'multicheck',
				'options' => get_data_source('data-2')
			),
			array(
				'name'    => 'Disable Post Format(s)',
				'id'      => $prefix . 'filter_formats',
				'type'    => 'multicheck',
				'class'   => '',
				'options' => get_data_source('data-2-formats', 'blog')
			),			
		),
	);

	$meta_boxes[] = array(
		'id'         => 'x_custom_metabox',
		'title'      => 'Custom',
		'pages'      => array( 'page', ), // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, // Show field names on the left
		'fields'     => array(		
			array(
				'name'    => 'Intro Text',
				'id'      => $prefix . 'introtext',
				'type'    => 'wysiwyg',
				'options' => array(	'textarea_rows' => 5, ),
			),
			array(
				'name' => 'CSS Classes',
				'plac' => 'Intro Text CSS Classes, space separate.',
				'id'   => $prefix . 'intro_classes',
				'type' => 'text',
			),		
			/*array(
				'name'    => 'Exit Text',
				'id'      => $prefix . 'exittext',
				'type'    => 'wysiwyg',
				'options' => array(	'textarea_rows' => 5, ),
			),
			array(
				'name' => 'CSS Classes',
				'plac' => 'Exit Text CSS Classes, space separate.',
				'id'   => $prefix . 'exit_classes',
				'type' => 'text',
			),*/									
		),
	);				

	$meta_boxes[] = array(
		'id'         => 'media_picker',
		'title'      => 'Slide Set Manager',
		'pages'      => array( 'slide-sets', ), // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, // Show field names on the left
		'fields'     => array(					
			array(
				'name'     => 'Select Media',
				'id'       => $prefix . 'media_selector',
				'type'     => 'media_picker',
				'xml'	   => 'slide_manager_xml',
				'xml_name' =>  array(
					'image'					=>	'slide_manager_image',
					'image_url'				=>	'slide_manager_image_url',
					'link_url'				=>	'slide_manager_link',
					'title'					=>	'slide_manager_title',
					'description'			=>	'slide_manager_description',
					'media_url'				=>	'slide_manager_media_url',
					'embed_type'			=>	'slide_manager_embed_type',
					'timeout'				=>	'slide_manager_timeout',
					'autoplay'				=>	'slide_manager_autoplay',
					'stage_content'			=>	'slide_manager_stage_content',
					'title_overlay'			=>	'slide_manager_title_overlay',
					'gallery3d_pieces'		=>	'slide_manager_gallery3d_pieces',
					'gallery3d_depthoffset'	=>	'slide_manager_gallery3d_depthoffset',
					'gallery3d_cubedist'	=>	'slide_manager_gallery3d_cubedist',
					'gallery3d_tween'		=>	'slide_manager_gallery3d_tween',
					'gallery3d_transtime'	=>	'slide_manager_gallery3d_transtime',
					'gallery3d_seconds'		=>	'slide_manager_gallery3d_seconds',
					'css_classes'			=>	'slide_manager_css_classes',
					'filter_tags'			=>	'slide_manager_filter_tags',
					'readmore_link'			=>	'slide_manager_readmore_link'
					
				),				
				'desc'	  => 'Select media and below and drag to arrange order.',
			),										
		),
	);	

	$meta_boxes[] = array(
		'id'         => 'x_gallery_options_metabox',
		'title'      => 'Gallery / Media',
		'pages'      => array( 'post', 'portfolio', ), // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, // Show field names on the left
		'fields'     => array(		
			array(
				'name' => 'Image URL',
				'id'   => $prefix . 'previewimgurl',
				'type' => 'file',
			),
			array(
				'name' => 'Media URL',
				'id'   => $prefix . 'movieurl',
				'type' => 'file',
			),
			array(
				'name'    => 'Embed Media',
				'desc'    => '',
				'id'      => $prefix . 'videotype',
				'type'    => 'select',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Disabled', 'value' => '', ),
					array( 'name' => 'Vimeo', 'value' => 'vimeo', ),
					array( 'name' => 'YouTube', 'value' => 'youtube', ),
					array( 'name' => 'Flash', 'value' => 'swf', ),
					array( 'name' => 'Video ( 3d Gallery )', 'value' => '3dvid', ),
					array( 'name' => 'JW Player', 'value' => 'jwp', ),
					array( 'name' => 'Wistia', 'value' => 'wistia', ),
				),
			),
			array(
				'name'    => 'Video Ratio',
				'desc'    => '',
				'id'      => $prefix . 'videoratio',
				'type'    => 'radio_inline',
				'std'		  => '',
				'options' => array(
					array( 'name' => '16:9', 'value' => '', ),
					array( 'name' => '14:3', 'value' => 'four_by_three', ),
				),
			),
			array(
				'name'    => 'Autoplay Media',
				'id'      => $prefix . 'videoautoplay',
				'type'    => 'radio_inline',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Off', 'value' => '', ),
					array( 'name' => 'On', 'value' => 'yes', ),
				),
			),
			array(
				'name' => 'Stage Gallery',
				'id'   => $prefix . 'stagetitle',
				'type' => 'info',
			),				
			array(
				'name' => 'Slide Timeout',
				'id'   => $prefix . 'slidetimeout',
				'plac' => 'Seconds',
				'type' => 'text',
			),
			array(
				'name'    => 'Gallery Image Content',
				'desc'    => '',
				'id'      => $prefix . 'stagegallery',
				'type'    => 'select',
				'std'		  => '',
				'options' => $stage_content
			),	
			array(
				'name'    => 'Post Title Overlay',
				'desc'    => '',
				'id'      => $prefix . 'displaytitle',
				'type'    => 'select',
				'std'		  => '',
				'options' => $title_overlay
			),																								
		)
	);

	$meta_boxes[] = array(
		'id'         => 'x_skin_options_metabox',
		'title'      => 'Skin',
		'pages'      => array( 'page', 'post', ), // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, // Show field names on the left
		'fields'     => array(		
			array(
				'name'    => 'Skin',
				'id'      => $prefix . 'customskin',
				'type'    => 'select',
				'options' => $skin_id_array
			),		
		)		
	);		

	$meta_boxes[] = array(
		'id'         => 'x_skin_options_metabox',
		'title'      => 'Portfolio',
		'pages'      => array( 'portfolio' ), // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, // Show field names on the left
		'fields'     => array(		
			array(
				'name'    => 'Parent Portfolio Page',
				'id'      => $prefix . 'portfoliopage',
				'desc'    => __( 'Set a Page to link this Portfolio to. Default is set in Appearance > Theme Options > Portfolio > Portfolio Page Link.', 'themeva_admin' ),
				'type'    => 'select',
				'options' => $options_pages	
			),		
		)		
	);			

	$meta_boxes[] = array(
		'id'         => 'x_additional_settings_metabox',
		'title'      => 'Additional',
		'pages'      => array( 'post', 'portfolio', ), // Post type
		'context'    => 'normal',
		'priority'   => 'core',
		'show_names' => true, // Show field names on the left
		'fields'     => array(		
			array(
				'name' => 'Alternative Link',
				'plac' => 'Link post to an alternative URL',
				'id'   => $prefix . 'galexturl',
				'type' => 'text',
			),
			array(
				'name'    => 'Disable Link',
				'id'      => $prefix . 'disablegallink',
				'type'    => 'radio_inline',
				'std'		  => 'off',
				'options' => array(
					array( 'name' => 'Off', 'value' => 'off', ),
					array( 'name' => 'On', 'value' => 'yes', ),
				),
			),
			array(
				'name'    => 'Disable Read More',
				'id'      => $prefix . 'disablereadmore',
				'type'    => 'radio_inline',
				'std'		  => 'off',
				'options' => array(
					array( 'name' => 'Off', 'value' => 'off', ),
					array( 'name' => 'On', 'value' => 'yes', ),
				),
			),
			array(
				'name'    => 'Image in Post / Archive',
				'desc'    => '',
				'id'      => $prefix . 'postshowimage',
				'type'    => 'select',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Default', 'value' => '', ),
					array( 'name' => 'Single', 'value' => 'single', ),
					array( 'name' => 'Archive', 'value' => 'archive', ),
					array( 'name' => 'Single + Archive', 'value' => 'singlearchive', ),
					array( 'name' => 'Disable', 'value' => 'disable', ),
				),
			),
			array(
				'name' => 'CSS Classes',
				'plac' => 'Comma separate classes',
				'id'   => $prefix . 'cssclasses',
				'type' => 'text',
			),			
		)
	);

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {
	//$do_not_save = 'yes';
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';
}