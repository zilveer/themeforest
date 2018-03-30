<?php

/***********************************************************/
// Post options
/***********************************************************/
$prefix = 'tm_posts_';

$TM_META_BOXES[] = array(
	'id'		=> 'tm_short_description',
	'title' 	=> __('TM - Short Description', 'templatemela'),
	'pages' 	=> array( 'post' ),
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'local_images' => true,
	'fields' 	=> array(

		// Show short description on post page
		array(
			'name'    		=> __('', 'templatemela'),
			'id'      		=> "{$prefix}short_description",
			'type'    		=> 'textarea',
			'std'			=> '',
		),
	),
);

$prefix = 'tm_posts_';

$TM_META_BOXES[] = array(
	'id'		=> 'tm_posts_options',
	'title' 	=> __('TM - Post Options', 'templatemela'),
	'pages' 	=> array( 'post' ),
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'local_images' => true,
	'fields' 	=> array(

		// Show related posts on post page
		array(
			'name'    		=> __('Show Related Posts on single post:', 'templatemela'),
			'id'      		=> "{$prefix}show_related_posts",
			'type'    		=> 'checkbox',
			'std'			=> 1,
		),		
		
		// Show Author Info on post page
		array(
			'name'    		=> __('Show Author Info on single post:', 'templatemela'),
			'id'      		=> "{$prefix}show_author_info",
			'type'    		=> 'checkbox',
			'std'			=> 1,
		),	
	),
);

$prefix = 'tm_blog_list_';

$TM_META_BOXES[] = array(
	'id'		=> 'tm_blog_list_columns',
	'title' 	=> __('TM - List Options', 'templatemela'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'side',
	'priority' 	=> 'low',
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
		'page-templates/blog-list.php',
	) ),
);

$prefix = 'tm_blog_box_';

$TM_META_BOXES[] = array(
	'id'		=> 'tm_blog_box_columns',
	'title' 	=> __('TM - Box Options', 'templatemela'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'local_images' => true,
	'fields' 	=> array(	
		
		// Show grid or masorny 
		array(
			'name'    		=> __('Display Options:', 'templatemela'),
			'id'      		=> "{$prefix}display",
			'type'    		=> 'radio',
			'std'			=> 'grid',
			'options'		=> array(
				'grid'		=> 'Grid',
				'masonry'	=> 'Masonry',
			)
		),
		
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
		'page-templates/blog-box.php'
	) ),
);

$prefix = 'tm_blog_filter_';

$TM_META_BOXES[] = array(
	'id'		=> 'tm_blog_filter_columns',
	'title' 	=> __('TM - Filter Options', 'templatemela'),
	'pages' 	=> array( 'page' ),
	'context' 	=> 'side',
	'priority' 	=> 'low',
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
	),
	'display_on'	=> array( 'template' => array(
		'page-templates/blog-filter.php'
	) ),
);
?>
