<?php
/**
 * Include and setup custom metaboxes (cmb) and fields.
 *
 * @category NorthVantage
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
	$skin_ids = explode(',', rtrim( get_option('skins_dynamix_ids'), ',' ) );
	
	$skin_outer_array[] = array( 'name' => 'Default', 'value' =>'' );
	
	foreach( $skin_ids as $skin_id )
	{
		$skin_outer_array[] = array( 'name' => $skin_id, 'value' => $skin_id, );
	}	
	
	$skin_inner_array = array( 
		array( 'name' => 'Default', 'value' =>'' ),
		array( 'name' => 'Light', 'value' =>'light' ),
		array( 'name' => 'Dark', 'value' =>'dark' ),
	);	
	

	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/lib/adm/images/';	

	$meta_boxes[] = array(
		'id'         => 'x_layout_metabox',
		'title'      => 'Page Config',
		'pages'      => array( 'page', 'post', 'portfolio', ), // Post type
		'context'    => 'normal',
		'cmb_styles' => true, // Enqueue the CMB stylesheet on the frontend
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
				'name'    => 'Page Layout',
				'desc'    => '',
				'id'      => $prefix . 'layout',
				'type'    => 'radio_inline',
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
				'name'    => 'Column 1 Border',
				'desc'    => '',
				'id'      => $prefix . 'border_config_one',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Border', 'value' => 'sidebarwrap', ),
					array( 'name' => 'Borderless', 'value' => 'borderless', ),
				),
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
				'name'    => 'Column 2 Border',
				'desc'    => '',
				'id'      => $prefix . 'border_config_two',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Border', 'value' => 'sidebarwrap', ),
					array( 'name' => 'Borderless', 'value' => 'borderless', ),
				),
			),		
			array(
				'name'     => __( 'Header / Menu', 'themeva_admin' ),
				'desc'     => __( 'These options relate to the Header & Menu areas.', 'themeva_admin' ),
				'id'       => $prefix . 'headermenu_title',
				'type'     => 'title',
			),							
			array(
				'name'    => 'Header',
				'id'      => $prefix . 'disableheader',
				'type'    => 'radio_inline',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Off', 'value' => 'yes', ),
					array( 'name' => 'On', 'value' => '', ),
				),
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
				'name'    => 'Branding Align',
				'desc'    => '',
				'id'      => $prefix . 'branding_alignment',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Default', 'value' => '', ),
					array( 'name' => 'Left', 'value' => 'left', ),
					array( 'name' => 'Right', 'value' => 'right', ),
					array( 'name' => 'Center', 'value' => 'center', ),
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
				'name'    => 'One-Page Mobile Menu',
				'id'      => $prefix . 'onepage_mobile',
				'type'    => 'radio_inline',
				'desc'     => __( 'This changes the functionality of the menu to suit a "One-Page" style configuration.', 'themeva_admin' ),
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Off', 'value' => '', ),
					array( 'name' => 'On', 'value' => 'yes', ),
				),
			),							
			array(
				'name'    => 'Menu Align',
				'desc'    => '',
				'id'      => $prefix . 'menu_alignment',
				'type'    => 'radio_inline',
				'options' => array(
					array( 'name' => 'Default', 'value' => '', ),
					array( 'name' => 'Left', 'value' => 'left', ),
					array( 'name' => 'Right', 'value' => 'right', ),
					array( 'name' => 'Center', 'value' => 'center', ),
				),
			),	
			array(
				'name' => __( 'Main / Footer', 'themeva_admin' ),
				'desc' => __( 'These options relate to the Main & Footer areas.', 'themeva_admin' ),
				'id'   => $prefix . 'mainfooter_title',
				'type' => 'title',
			),					
			array(
				'name'    => 'Main Content',
				'id'      => $prefix . 'hidecontent',
				'type'    => 'radio_inline',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Off', 'value' => 'yes', ),
					array( 'name' => 'On', 'value' => '', ),
				),
			),	
			array(
				'name'    => 'Main Frame',
				'id'      => $prefix . 'contentborder',
				'type'    => 'radio_inline',
				'size'	  => 'medium',
				'std'		  => '',
				'options' => array(
					array( 'name' => 'Default', 'value' => '', ),
					array( 'name' => 'Disable', 'value' => 'yes', ),
				),
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
			array(
				'name'    => 'Text Resizer',
				'id'      => $prefix . 'textresize',
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
					'revslider' => array(
						'path' => $imagepath . 'gallery-h.png',
						'name' => 'Revolution',
						'data' => 'h'
					 ),					 
					'stageslider' => array(
						'path' => $imagepath . 'gallery-a.png',
						'name' => 'Stage',
						'data' => 'a'
					 ),	
					'islider' => array(
						'path' => $imagepath . 'gallery-b.png',
						'name' => 'iSlider',
						'data' => 'b'
					 ),
					'nivo' => array(
						'path' => $imagepath . 'gallery-c.png',
						'name' => 'Nivo',
						'data' => 'c'
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
					'gallery3d' => array(
						'path' => $imagepath . 'gallery-f.png',
						'name' => '3d',
						'data' => 'f'
					 ),
					'galleryaccordion' => array(
						'path' => $imagepath . 'gallery-g.png',
						'name' => 'Accordion',
						'data' => 'g'
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
				'theme'	   => 'b',
				'class'   => 'gallery_section show_all hide_h datasource_select', // container class
				'options' => data_source_list(),
				'desc'    => __( 'Select which Data Source you wish to obtain images etc from.', 'themeva_admin' ),
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
				'name'    => 'Slide Content',
				'id'      => $prefix . 'groupgridcontent',
				'type'    => 'select',
				'class'	  => 'gallery_section show_d show_e show_g',
				'options' => array(
					array( 'name' => 'Text + Image', 'value' => 'textimage' ),
					array( 'name' => 'Title + Image', 'value' => 'titleimage' ),
					array( 'name' => 'Title Overlay + Image', 'value' => 'titleoverlay' ),
					array( 'name' => 'Text Overlay + Image', 'value' => 'titletextoverlay' ),
					array( 'name' => 'Image', 'value' => 'image' ),
					array( 'name' => 'Text', 'value' => 'text' ),
				),
			),			
			array(
				'name'    => 'Image Effect',
				'id'      => $prefix . 'imageeffect',
				'type'    => 'select',
				'class'   => 'gallery_section show_all hide_f hide_h', // container class
				'options' => array(
					array( 'name' => 'No Effect', 'value' => 'none', ),
					array( 'name' => 'Drop Shadow', 'value' => 'shadow', ),
					array( 'name' => 'Reflection', 'value' => 'reflection', ),
					array( 'name' => 'Shadow &amp; Reflection', 'value' => 'shadowreflection', ),
					array( 'name' => 'Frame', 'value' => 'frame', ),
					array( 'name' => 'Black & White', 'value' => 'blackwhite', ),
					array( 'name' => 'Frame + Black & White', 'value' => 'frameblackwhite', ),
					array( 'name' => 'Shadow + Black & White', 'value' => 'shadowblackwhite', ),					
				),
			),
			array(
				'name'    => 'Lightbox',
				'id'      => $prefix . 'lightbox',
				'type'    => 'radio_inline',
				'std'		  => '',
				'class'   => 'gallery_section show_all hide_c hide_f hide_h', // container class
				'options' => array(
					array( 'name' => 'Off', 'value' => '', ),
					array( 'name' => 'On', 'value' => 'yes', ),
				),
			),
			array(
				'name' => 'Image Width',
				'class'	  => 'gallery_section show_all hide_h',
				'id'   => $prefix . 'imgwidth',
				'type' => 'text',
			),	
			array(
				'name' => 'Image Height',
				'class'	  => 'gallery_section show_all hide_h',
				'id'   => $prefix . 'imgheight',
				'type' => 'text',
			),
			array(
				'name' => 'Gallery / Row Height',
				'class'	  => 'gallery_section show_d show_e show_f',
				'id'   => $prefix . 'galleryheight',
				'type' => 'text',
			),
			array(
				'name' => 'Slide Timeout',
				'class'	  => 'gallery_section show_all hide_e hide_h',
				'id'   => $prefix . 'stagetimeout',
				'type' => 'text',
				'plac' => 'In seconds e.g. 10',
			),
			array(
				'name'    => 'Navigation',
				'id'      => $prefix . 'stageplaypause',
				'type'    => 'select',
				'class'	  => 'gallery_section show_a show_c',
				'options' => array(
					array( 'name' => 'Bullet', 'value' => '' ),
					array( 'name' => 'Bullet + Directional', 'value' => 'enabled' ),
					array( 'name' => 'Directional', 'value' => 'leftrightonly' ),
					array( 'name' => 'Disabled', 'value' => 'disabled' ),
				),
			),
			array(
				'name'    => 'Auto Rotate',
				'id'      => $prefix . 'accordionautoplay',
				'type'    => 'radio_inline',
				'std'		  => '',
				'class'   => 'gallery_section show_g', // container class
				'options' => array(
					array( 'name' => 'Off', 'value' => 'disabled', ),
					array( 'name' => 'On', 'value' => 'enabled', ),
				),
			),
			array(
				'name'    => 'Startup Mini Titles',
				'id'      => $prefix . 'accordiontitles',
				'type'    => 'radio_inline',
				'std'		  => 'enabled',
				'class'   => 'gallery_section show_g', // container class
				'options' => array(
					array( 'name' => 'Off', 'value' => 'disabled', ),
					array( 'name' => 'On', 'value' => 'enabled', ),
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
				'name'    => 'Column Padding',
				'id'      => $prefix . 'columnpadding',
				'type'    => 'select',
				'std'		  => '',
				'class'   => 'gallery_section show_e', // container class
				'options' => array(
					array( 'name' => 'On', 'value' => '', ),
					array( 'name' => 'Off', 'value' => 'disable_padding', ),
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
				'name'    => 'Page Position',
				'id'      => $prefix . 'groupsliderpos',
				'type'    => 'radio_inline',
				'std'		  => 'above',
				'class'	  => 'gallery_section show_d show_e',
				'options' => array(
					array( 'name' => 'Top', 'value' => 'above', ),
					array( 'name' => 'Bottom', 'value' => 'below', ),
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
				'id'      => $prefix . 'nivoeffect',
				'type'    => 'select',
				'class'	  => 'gallery_section show_c',
				'options' => array(
					array( 'name' => 'random', 'value' => 'random' ),
					array( 'name' => 'sliceDown', 'value' => 'sliceDown' ),
					array( 'name' => 'sliceDownLeft', 'value' => 'sliceDownLeft' ),
					array( 'name' => 'sliceUp', 'value' => 'sliceUp' ),
					array( 'name' => 'sliceUpLeft', 'value' => 'sliceUpLeft' ),
					array( 'name' => 'sliceUpDown', 'value' => 'sliceUpDown' ),
					array( 'name' => 'sliceUpDownLeft', 'value' => 'sliceUpDownLeft' ),
					array( 'name' => 'fold', 'value' => 'fold' ),
					array( 'name' => 'fade', 'value' => 'fade' ),
					array( 'name' => 'slideInRight', 'value' => 'slideInRight' ),
					array( 'name' => 'slideInLeft', 'value' => 'slideInLeft' ),
					array( 'name' => 'boxRandom', 'value' => 'boxRandom' ),
					array( 'name' => 'boxRain', 'value' => 'boxRain' ),
					array( 'name' => 'boxRainReverse', 'value' => 'boxRainReverse' ),
					array( 'name' => 'boxRainGrow', 'value' => 'boxRainGrow' ),
					array( 'name' => 'boxRainGrowReverse', 'value' => 'boxRainGrowReverse' ),
				),
			),
			array(
				'name'    => 'Transition Effect',
				'id'      => $prefix . 'stagetransition',
				'type'    => 'select',
				'class'	  => 'gallery_section show_a',
				'options' => array(
					array( 'name' => 'fade', 'value' => 'fade' ),
					array( 'name' => 'blindY', 'value' => 'blindY' ),
					array( 'name' => 'blindZ', 'value' => 'blindZ' ),
					array( 'name' => 'blindX', 'value' => 'blindX' ),
					array( 'name' => 'cover', 'value' => 'cover' ),
					array( 'name' => 'curtainX', 'value' => 'curtainX' ),
					array( 'name' => 'curtainY', 'value' => 'curtainY' ),
					array( 'name' => 'fadeZoom', 'value' => 'fadeZoom' ),
					array( 'name' => 'growX', 'value' => 'growX' ),
					array( 'name' => 'growY', 'value' => 'growY' ),
					array( 'name' => 'scrollUp', 'value' => 'scrollUp' ),
					array( 'name' => 'scrollDown', 'value' => 'scrollDown' ),
					array( 'name' => 'scrollLeft', 'value' => 'scrollLeft' ),
					array( 'name' => 'scrollRight', 'value' => 'scrollRight' ),
					array( 'name' => 'scrollHorz', 'value' => 'scrollHorz' ),
					array( 'name' => 'scrollVert', 'value' => 'scrollVert' ),
					array( 'name' => 'shuffle', 'value' => 'shuffle' ),
					array( 'name' => 'slideX', 'value' => 'slideX' ),
					array( 'name' => 'slideY', 'value' => 'slideY' ),
					array( 'name' => 'toss', 'value' => 'toss' ),
					array( 'name' => 'turnUp', 'value' => 'turnUp' ),
					array( 'name' => 'turnDown', 'value' => 'turnDown' ),
					array( 'name' => 'turnLeft', 'value' => 'turnLeft' ),
					array( 'name' => 'turnRight', 'value' => 'turnRight' ),
					array( 'name' => 'uncover', 'value' => 'uncover' ),
					array( 'name' => 'wipe', 'value' => 'wipe' ),
					array( 'name' => 'zoom', 'value' => 'zoom' ),
					array( 'name' => 'none', 'value' => 'none' ),
				),
			),
			array(
				'name'    => 'Transition Effect',
				'id'      => $prefix . 'stagetween',
				'type'    => 'select',
				'class'	  => 'gallery_section show_a',
				'options' => $transition_effect
			),
			array(
				'name' => 'Pieces',
				'min' => '1',
				'max' => '50',
				'std'  => '15',
				'class'	  => 'gallery_section show_f',				
				'id'   => $prefix . 'gallery3dsegments',
				'type' => 'slider',
			),
			array(
				'name' => 'Depth Offset',
				'min' => '-200',
				'max' => '700',
				'std'  => '300',
				'class'	  => 'gallery_section show_f',				
				'id'   => $prefix . 'gallery3dzdistance',
				'type' => 'slider',
			),
			array(
				'name' => 'Cube Distance',
				'min' => '5',
				'max' => '50',
				'std'  => '20',
				'class'	  => 'gallery_section show_f',				
				'id'   => $prefix . 'gallery3dexpand',
				'type' => 'slider',
			),			
			array(
				'name'    => 'Transition Effect',
				'id'      => $prefix . 'gallery3dtween',
				'type'    => 'select',
				'class'	  => 'gallery_section show_f',
				'options' => $transition_effect
			),
			array(
				'name' => 'Transition Time',
				'class'	  => 'gallery_section show_f',
				'id'   => $prefix . 'gallery3dtweentime',
				'type' => 'text',
				'plac' => 'In seconds, default 1.2',
			),	
			array(
				'name' => 'Delay',
				'class'	  => 'gallery_section show_f',
				'id'   => $prefix . 'gallery3dtweendelay',
				'type' => 'text',
				'plac' => 'In seconds, default 0.1',
			),
			array(
	            'name' => 'Text Color',
				'class'	  => 'gallery_section show_f',				
	            'id'   => $prefix . 'gallery3dincolor',
	            'type' => 'colorpicker',
				'std'  => '#111111'
	        ),	
			array(
	            'name' => 'Text Background Color',
				'class'	  => 'gallery_section show_f',				
	            'id'   => $prefix . 'gallery3dtextcolor',
	            'type' => 'colorpicker',
				'std'  => '#111111'
	        ),
			array(
				'name' => 'Controls X Position',
				'min' => '0',
				'max' => '2000',
				'std'  => '470',
				'class'	  => 'gallery_section show_f',				
				'id'   => $prefix . 'gallery3dxpos',
				'type' => 'slider',
			),
			array(
				'name' => 'Controls Y Position',
				'min' => '0',
				'max' => '2000',
				'std'  => '280',
				'class'	  => 'gallery_section show_f',				
				'id'   => $prefix . 'gallery3dypos',
				'type' => 'slider',
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
				'name'    => 'Header Infobar',
				'id'      => $prefix . 'infobartext',
				'type'    => 'wysiwyg',
				'options' => array(	'textarea_rows' => 5, ),
			),
			array(
				'name' => 'CSS Classes',
				'plac' => 'Infobar CSS Classes, space separate.',
				'id'   => $prefix . 'infobar_classes',
				'type' => 'text',
			),			
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
			array(
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
			),									
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
					array( 'name' => 'HTML5', 'value' => 'oembed', ),
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
				'name' => '3d Gallery',
				'id'   => $prefix . '3dtitle',
				'type' => 'info',
			),			
			array(
				'name' => 'Pieces',
				'id'   => $prefix . 'gallery3dsegments',
				'plac' => 'Default 15',
				'type' => 'text',
			),
			array(
				'name'    => 'Transition',
				'desc'    => '',
				'id'      => $prefix . 'gallery3dtween',
				'type'    => 'select',
				'std'		  => '',
				'options' => $transition_effect
			),
			array(
				'name' => 'Transition Time',
				'id'   => $prefix . 'gallery3dtweentime',
				'plac' => 'Seconds',
				'type' => 'text',
			),
			array(
				'name' => 'Delay',
				'id'   => $prefix . 'gallery3dtweendelay',
				'plac' => 'Seconds',
				'type' => 'text',
			),
			array(
				'name' => 'Depth Offset',
				'id'   => $prefix . 'gallery3dzdistance',
				'plac' => '-200 to 700',
				'type' => 'text',
			),
			array(
				'name' => 'Cube Distance',
				'id'   => $prefix . 'gallery3dexpand',
				'plac' => 'Default 20',
				'type' => 'text',
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
				'name'    => 'Outer Skin',
				'id'      => $prefix . 'customskin',
				'type'    => 'select',
				'options' => $skin_outer_array
			),	
			array(
				'name'    => 'Inner Skin',
				'id'      => $prefix . 'innerskin',
				'type'    => 'select',
				'options' => $skin_inner_array
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