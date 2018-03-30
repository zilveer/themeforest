<?php
//Get all galleries
$args = array(
    'numberposts' => -1,
    'post_type' => array('galleries'),
);

$galleries_arr = get_posts($args);
$galleries_select = array();
$galleries_select[''] = '';

foreach($galleries_arr as $gallery)
{
    $galleries_select[$gallery->ID] = $gallery->post_title;
}

//Get all categories
$categories_arr = get_categories();
$categories_select = array();
$categories_select[''] = '';

foreach ($categories_arr as $cat) {
	$categories_select[$cat->cat_ID] = $cat->cat_name;
}

//Get all sets
$sets_arr = get_terms('portfoliosets', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
$sets_select = array();
$sets_select[''] = '';

foreach ($sets_arr as $set) {
	$sets_select[$set->slug] = $set->name;
}

//Get all service categories
$service_cats_arr = get_terms('servicecats', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
$service_cats_select = array();
$service_cats_select[''] = '';

foreach ($service_cats_arr as $service_cat) {
	$service_cats_select[$service_cat->slug] = $service_cat->name;
}

//Get all team categories
$team_cats_arr = get_terms('teamcats', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
$team_cats_select = array();
$team_cats_select[''] = '';

foreach ($team_cats_arr as $team_cat) {
	$team_cats_select[$team_cat->slug] = $team_cat->name;
}

//Get order options
$order_select = array(
	'default' 	=> 'By Default',
	'newest'	=> 'By Newest',
	'oldest'	=> 'By Oldest',
	'title'		=> 'By Title',
	'random'	=> 'By Random',
);

//Get column options
$column_select = array(
	'1' => '1 Column',
	'2' => '2 Columns',
	'3'	=> '3 Columns',
	'4'	=> '4 Columns',
);

//Get column options
$team_column_select = array(
	'2' => '2 Columns',
	'3'	=> '3 Columns',
	'4'	=> '4 Columns',
);

//Get service alignment options
$service_align_select = array(
	'left' => 'Align Left',
	'center' => 'Align Center',
);

$ppb_shortcodes = array(
    'ppb_text' => array(
    	'title' =>  'Text Block',
    	'attr' => array(
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload background image you want to display for this content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only)',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_divider' => array(
    	'title' =>  'Divider',
    	'attr' => array(),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_portfolio' => array(
    	'title' =>  'Portfolio',
    	'attr' => array(
    		'set' => array(
    			'title' => 'Filter by portfolio category',
    			'type' => 'select',
    			'options' => $sets_select,
    			'desc' => 'You can choose to display only some portfolio items from selected set',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order portfolio items',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			'from' => 1,
    			'to' => 50,
    			'desc' => 'Enter number of posts to display (number value only)',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload background image you want to display for this content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only)',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_gallery' => array(
    	'title' =>  'Gallery',
    	'attr' => array(
    		'gallery' => array(
    			'title' => 'Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery you want to display',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload background image you want to display for this content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only)',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_blog' => array(
    	'title' =>  'Blog',
    	'attr' => array(
    		'category' => array(
    			'title' => 'Filter by category',
    			'type' => 'select',
    			'options' => $categories_select,
    			'desc' => 'You can choose to display only some posts from selected category',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			'from' => 1,
    			'to' => 50,
    			'desc' => 'Enter number of posts to display (number value only)',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload background image you want to display for this content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only)',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_service' => array(
    	'title' =>  'Service',
    	'attr' => array(
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => $column_select,
    			'desc' => 'Select how many columns you want to display service items in a row',
    		),
    		'align' => array(
    			'title' => 'Content Alignment',
    			'type' => 'select',
    			'options' => $service_align_select,
    			'desc' => 'Select what\'s alignment you want to display service items',
    		),
    		'category' => array(
    			'title' => 'Filter by service category',
    			'type' => 'select',
    			'options' => $service_cats_select,
    			'desc' => 'You can choose to display only some service items from selected category',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order service items',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			'from' => 1,
    			'to' => 50,
    			'desc' => 'Enter number of posts to display (number value only)',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only)',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_transparent_video_bg' => array(
    	'title' =>  'Transparent Video Background',
    	'attr' => array(
    		'description' => array(
    			'type' => 'textarea',
    			'desc' => 'Enter short description. It displays under the title',
    		),
    		'mp4_video_url' => array(
    			'title' => 'MP4 Video URL',
    			'type' => 'file',
    			'desc' => 'Upload .mp4 video file you want to display for this content',
    		),
    		'webm_video_url' => array(
    			'title' => 'WebM Video URL',
    			'type' => 'file',
    			'desc' => 'Upload .webm video file you want to display for this content',
    		),
    		'preview_img' => array(
    			'title' => 'Preview Image URL',
    			'type' => 'file',
    			'desc' => 'Upload preview image for this video',
    		),
    		'height' => array(
    			'type' => 'text',
    			'desc' => 'Enter number of height for background image (in pixel)',
    		),
    		'link_text' => array(
    			'type' => 'text',
    			'desc' => 'Enter video link text (For example "Read Full Story")',
    		),
    		'link_url' => array(
    			'type' => 'text',
    			'desc' => 'Enter video link URL',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_fullwidth_button' => array(
    	'title' =>  'Full Width Button',
    	'attr' => array(
    		'link_url' => array(
    			'type' => 'text',
    			'desc' => 'Enter redirected link URL when button is clicked',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_team' => array(
    	'title' =>  'Team',
    	'attr' => array(
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => $team_column_select,
    			'desc' => 'Select how many columns you want to display service items in a row',
    		),
    		'cat' => array(
    			'title' => 'Filter by team category',
    			'type' => 'select',
    			'options' => $team_cats_select,
    			'desc' => 'You can choose to display only some team members from selected team category',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order team members',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			'from' => 1,
    			'to' => 50,
    			'desc' => 'Enter number of posts to display (number value only)',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload background image you want to display for this content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only)',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_client' => array(
    	'title' =>  'Client',
    	'attr' => array(
    		'items' => array(
    			'type' => 'jslider',
    			'from' => 1,
    			'to' => 50,
    			'desc' => 'Enter number of posts to display (number value only)',
    		),    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_promo_box' => array(
    	'title' =>  'Promo Box',
    	'attr' => array(
    		'button_text' => array(
    			'type' => 'text',
    			'desc' => 'Enter promo box button text',
    		),
    		'button_url' => array(
    			'type' => 'text',
    			'desc' => 'Enter redirected link URL when button is clicked',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
);

ksort($ppb_shortcodes);
?>