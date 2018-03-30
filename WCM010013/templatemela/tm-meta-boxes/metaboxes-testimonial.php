<?php

/***********************************************************/
// Testimonial Template options
/***********************************************************/

$prefix = 'tm_testimonial_list_';

$TM_META_BOXES[] = array(
	'id'		=> 'tm_testimonial_list_columns',
	'title' 	=> __('TM - List Options', 'templatemela'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'local_images' => true,
	'fields' 	=> array(	
			
		// Show number of posts per page
		array(
			'name'			=> __('Number of posts per page:', 'templatemela'),
			'id'    		=> "{$prefix}posts_per_page",
			'type'  		=> 'text',
			'std'   		=> '5',
		),
	),
	'display_on'	=> array( 'template' => array(
		'page-templates/testimonial-list.php',
	) ),
);

$prefix = 'tm_testimonial_box_';

$TM_META_BOXES[] = array(
	'id'		=> 'tm_testimonial_box_columns',
	'title' 	=> __('TM - Box Options', 'templatemela'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'local_images' => true,
	'fields' 	=> array(	
		// Show posts per column
		array(
			'name'    		=> __('Columns Options:', 'templatemela'),
			'id'      		=> "{$prefix}columns",
			'type'    		=> 'radio',
			'std'			=> 'two',
			'options'		=> array(
				'two'		=> 'Two',
				'three'		=> 'Three',
				'four'		=> 'Four', 
			)
		),
		
		// Show number of posts per page
		array(
			'name'			=> __('Number of posts per page:', 'templatemela'),
			'id'    		=> "{$prefix}posts_per_page",
			'type'  		=> 'text',
			'std'   		=> '5',
		),
	),
	'display_on'	=> array( 'template' => array(
		'page-templates/testimonial-box.php'
	) ),
);
?>