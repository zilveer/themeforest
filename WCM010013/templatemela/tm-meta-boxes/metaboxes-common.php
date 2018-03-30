<?php

/***********************************************************/
// Common options
/***********************************************************/

$prefix = 'tm_content_';

$TM_META_BOXES[] = array(
	'id'		=> 'tm_content_area',
	'title' 	=> __('TM - Content Options:', 'templatemela'),
	'pages' 	=> array( 'page' ),	
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'local_images' => true,
	'fields' 	=> array(	
		
		// Show page title on post page
		array(
			'name'    		=> __('Display Page title?:', 'templatemela'),
			'id'      		=> "{$prefix}show_page_title",
			'type'    		=> 'checkbox',
			'std'			=> 1
		),
		
		// Show sidebar position on post page
		array(
			'name'    		=> __('Content Position:', 'templatemela'),
			'id'      		=> "{$prefix}position",
			'type'    		=> 'radio',
			'std'			=> 'above',
			'options'		=> array(
				'none'		=> 'None',
				'above'		=> 'Above',
				'below'		=> 'Below',
			),
			'top_divider'	=> true
		),
	),
);

$prefix = 'tm_page_';

$TM_META_BOXES[] = array(
	'id'		=> 'tm_page_width_layout',
	'title' 	=> __('TM - Page Layout:', 'templatemela'),
	'pages' 	=> array( 'page' ),	
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'local_images' => true,
	'fields' 	=> array(	
		
		// Show sidebar position on post page
		array(
			'name'    		=> __('Page Layout:', 'templatemela'),
			'id'      		=> "{$prefix}layout",
			'type'    		=> 'radio',
			'std'			=> 'box',
			'options'		=> array(
				'box'		=> 'Box',
				'wide'		=> 'Wide',
			),
			'top_divider'	=> true
		),
	),
);

$prefix = 'tm_sidebar_';

$TM_META_BOXES[] = array(
	'id'		=> 'tm_posts_other_side',
	'title' 	=> __('TM - Sidebar Options:', 'templatemela'),
	'pages' 	=> array( 'page' ),	
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'local_images' => true,
	'fields' 	=> array(	
		
		// Show sidebar position on post page
		array(
			'name'    		=> __('Sidebar Position:', 'templatemela'),
			'id'      		=> "{$prefix}position",
			'type'    		=> 'radio',
			'std'			=> 'right',
			'options'		=> array(
				'right'		=> 'Right',
				'left'		=> 'Left',
				'disabled'	=> 'Disabled',
			),
			'top_divider'	=> true
		),
	),
);
?>