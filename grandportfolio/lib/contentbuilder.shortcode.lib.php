<?php
//Get all categories
$categories_arr = get_categories();
$categories_select = array();
$categories_select[''] = '';

foreach ($categories_arr as $cat) {
	$categories_select[$cat->cat_ID] = $cat->cat_name;
}

$galleries_select = array();
$gallery_cats_select = array();
$portfolio_cats_select = array();
$team_cats_select = array();
$testimonial_cats_select = array();
$client_cats_select = array();
$pricing_cat_select = array();
$event_cat_select = array();

//Check if theme custom post type is installed	
$grandportfolio_custom_post = ABSPATH . '/wp-content/plugins/grandportfolio-custom-post/grandportfolio-custom-post.php';

// Check if the file is available to prevent warnings
$is_grandportfolio_custom_post_activated = file_exists($grandportfolio_custom_post);

if($is_grandportfolio_custom_post_activated)
{
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
	
	//Get all gallery categories
	$gallery_cats_arr = get_terms('gallerycat', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	$gallery_cats_select = array();
	$gallery_cats_select[''] = '';
	
	foreach ($gallery_cats_arr as $gallery_cat) {
		$gallery_cats_select[$gallery_cat->slug] = $gallery_cat->name;
	}
	
	//Get all portfolio categories
	$portfolio_cats_arr = get_terms('portfoliosets', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	$portfolio_cats_select = array();
	$portfolio_cats_select[''] = '';
	
	foreach ($portfolio_cats_arr as $portfolio_cat) {
		$portfolio_cats_select[$portfolio_cat->slug] = $portfolio_cat->name;
	}
	
	//Get all team categories
	$team_cats_arr = get_terms('teamcats', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	$team_cats_select = array();
	$team_cats_select[''] = '';
	
	foreach ($team_cats_arr as $team_cat) {
		$team_cats_select[$team_cat->slug] = $team_cat->name;
	}
	
	//Get all testimonials categories
	$testimonial_cats_arr = get_terms('testimonialcats', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	$testimonial_cats_select = array();
	$testimonial_cats_select[''] = '';
	
	foreach ($testimonial_cats_arr as $testimonial_cat) {
		$testimonial_cats_select[$testimonial_cat->slug] = $testimonial_cat->name;
	}
	
	//Get all client categories
	$client_cats_arr = get_terms('clientcats', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	$client_cats_select = array();
	$client_cats_select[''] = '';
	
	foreach ($client_cats_arr as $client_cats) {
		$client_cats_select[$client_cats->slug] = $client_cats->name;
	}
	
	//Get all pricing categories
	$pricing_cat_arr = get_terms('pricingcats', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	$pricing_cat_select = array();
	$pricing_cat_select[''] = '';
	
	foreach($pricing_cat_arr as $pricing_cat)
	{
	    $pricing_cat_select[$pricing_cat->slug] = $pricing_cat->name;
	}
	
	//Get all Event categories
	$event_cat_arr = get_terms('eventscats', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	$event_cat_select = array();
	$event_cat_select[''] = '';
	
	foreach($event_cat_arr as $event_cat)
	{
	    $event_cat_select[$event_cat->slug] = $event_cat->name;
	}
	
	//Get all avaiable menu items
	$menus_arr = get_terms('nav_menu', array( 'hide_empty' => true ));
	$menus_arr_select = array();
	$menus_arr_select[''] = '';
	
	foreach($menus_arr as $menu)
	{
	    $menus_arr_select[$menu->slug] = $menu->name;
	}
}

//Get all sidebars
$theme_sidebar = array(
	'' => '',
	'Page Sidebar' => 'Page Sidebar', 
	'Blog Sidebar' => 'Blog Sidebar', 
	'Contact Sidebar' => 'Contact Sidebar', 
	'Single Post Sidebar' => 'Single Post Sidebar',
	'Single Image Page Sidebar' => 'Single Image Page Sidebar',
	'Archive Sidebar' => 'Archive Sidebar',
	'Category Sidebar' => 'Category Sidebar',
	'Search Sidebar' => 'Search Sidebar',
	'Tag Sidebar' => 'Tag Sidebar', 
	'Footer Sidebar' => 'Footer Sidebar',
);
$dynamic_sidebar = get_option('pp_sidebar');

if(!empty($dynamic_sidebar))
{
	foreach($dynamic_sidebar as $sidebar)
	{
		$theme_sidebar[$sidebar] = $sidebar;
	}
}

$theme_sidebar_layout = array(
	'left' 	=> 'Left Sidebar',
	'right'	=> 'Right Sidebar',
);

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
$blog_column_select = array(
	'3'	=> '3 Columns',
	'4'	=> '4 Columns',
	'5' => '5 Columns',
);

//Get column options
$team_column_select = array(
	'2'	=> '2 Columns',
	'3'	=> '3 Columns',
	'4'	=> '4 Columns',
	'5' => '5 Columns',
);

$testimonial_column_select = array(
	'2' => '2 Columns',
	'3'	=> '3 Columns',
	'4'	=> '4 Columns',
);

$gallery_column_select = array(
	'3'	=> '3 Columns',
	'4'	=> '4 Columns',
);

$text_block_layout_select = array(
	'fixedwidth'=> 'Fixed Width',
	'fullwidth'	=> 'Fullwidth',
);

$portfolio_column_select = array(
	'3'	=> '3 Columns',
	'4'	=> '4 Columns',
);

$portfolio_layout_select = array(
	'fullwidth'	=> 'Fullwidth',
	'fixedwidth'=> 'Fixed Width',
);

$gallery_layout_select = array(
	'fullwidth'	=> 'Fullwidth',
	'fixedwidth'=> 'Fixed Width',
);

$team_layout_select = array(
	'fullwidth'	=> 'Fullwidth',
	'fixedwidth'=> 'Fixed Width',
);

$client_layout_select = array(
	'fullwidth'	=> 'Fullwidth',
	'fixedwidth'=> 'Fixed Width',
);

$blog_slider_column_select = array(
	'1'	=> 'Fullwidth',
	'2' => '2 Columns',
	'3'	=> '3 Columns',
);

$ppb_shortcodes = array(
	1 => array(
		'title' => 'Text',
	),
    'ppb_divider' => array(
    	'title' =>  'Paragraph Break',
    	'icon' => 'divider.png',
    	'attr' => array(),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_header_inline' => array(
    	'title' =>  'Header',
    	'icon' => 'header_inline.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter short description for this header',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this this block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_header' => array(
    	'title' =>  'Header',
    	'icon' => 'header.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter short description for this header',
    		),
    		'width' => array(
    			'title' => 'Content Width',
    			'type' => 'select',
    			'options' => array(
    				'100%' 	=> '100%',
    				'90%' 	=> '90%',
    				'80%' 	=> '80%',
    				'70%' 	=> '70%',
    				'60%' 	=> '60%',
    				'50%' 	=> '50%',
    			),
    			'desc' => 'Select width in percentage for this content',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' 	=> 'Left',
    				'center' => 'center',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this this block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_header_image' => array(
    	'title' =>  'Header With Background Image',
    	'icon' => 'header_image.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter short description for this header',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' 	=> 'Left',
    				'center' => 'center',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as background',
    		),
    		'background_position' => array(
    			'title' => 'Background Position (Optional)',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_header_video' => array(
    	'title' =>  'Header With Video Background',
    	'icon' => 'header_video.png',
    	'attr' => array(
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter short description for this header',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' 	=> 'Left',
    				'center' => 'center',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'poster' => array(
    			'title' => 'Video Poster Image',
    			'type' => 'file',
    			'desc' => 'Upload post image you want to display for this video',
    		),
    		'mp4' => array(
    			'title' => 'Video File (.mp4 format)',
    			'type' => 'video',
    			'desc' => 'Upload video file in MP4 format',
    		),
    		'webm' => array(
    			'title' => 'Video File (.webm format)',
    			'type' => 'video',
    			'desc' => 'Upload video file in WEBM format',
    		),
    		'ogv' => array(
    			'title' => 'Video File (.ogv format)',
    			'type' => 'video',
    			'desc' => 'Upload video file in OGV format',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Overlay Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select background color for overlay content',
    		),
    		'opacity' => array(
    			'title' => 'Background Overlay Opacity',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background overlay opacity for this content block',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "75",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in %)',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_text' => array(
    	'title' =>  'Text Contained Content',
    	'icon' => 'text.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'width' => array(
    			'title' => 'Content Width',
    			'type' => 'select',
    			'options' => array(
    				'100%' 	=> '100%',
    				'90%' 	=> '90%',
    				'80%' 	=> '80%',
    				'70%' 	=> '70%',
    				'60%' 	=> '60%',
    				'50%' 	=> '50%',
    			),
    			'desc' => 'Select width in percentage for this content',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_text_fullwidth' => array(
    	'title' =>  'Text Fullwidth Content',
    	'icon' => 'text.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_text_image' => array(
    	'title' =>  'Text With Background Image',
    	'icon' => 'text_image.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as background',
    		),
    		'background_position' => array(
    			'title' => 'Background Position (Optional)',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Overlay Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select background color for overlay content',
    		),
    		'opacity' => array(
    			'title' => 'Background Overlay Opacity',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background overlay opacity for this content block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    'ppb_text_sidebar' => array(
    	'title' =>  'Text With Sidebar',
    	'icon' => 'contact_sidebar.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'sidebar' => array(
    			'Title' => 'Content Sidebar',
    			'type' => 'select',
    			'options' => $theme_sidebar,
    			'desc' => 'You can select sidebar to display next to classic blog content',
    		),
    		'padding' => array(
	    	    'title' => 'Content Padding',
	    	    'type' => 'jslider',
	    	    "std" => "30",
			    "min" => 0,
			    "max" => 200,
			    "step" => 5,
	    	    'desc' => 'Select padding top and bottom value for this header block',
	    	),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    'ppb_gradient_image' => array(
    	'title' =>  'Text With Gradient Background Image',
    	'icon' => 'text_gradient_image.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' 	=> 'Left',
    				'center' => 'center',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as background',
    		),
    		'background_position' => array(
    			'title' => 'Background Position (Optional)',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'padding_top' => array(
    			'title' => 'Content Padding Top (in%)',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select padding top value for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for content on this block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Overlay Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select background color for overlay content',
    		),
    		'opacity' => array(
    			'title' => 'Background Overlay Opacity',
    			'type' => 'jslider',
    			"std" => "40",
				"min" => 10,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background overlay opacity for this content block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    'ppb_fullwidth_button' => array(
    	'title' =>  'Full Width Button',
    	'icon' => 'fullwidth_button.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'padding' => array(
    			'title' => 'Button Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this content block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title and subtitle',
    		),
    		'button_text' => array(
    			'title' => 'Button Text (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter text for button',
    		),
    		'link_url' => array(
    			'title' => 'Button Link URL (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter redirected link URL when button is clicked',
    		),
    		'button_bgcolor' => array(
    			'title' => 'Button Background Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select background color for button',
    		),
    		'button_fontcolor' => array(
    			'title' => 'Button Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for button',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    
    2 => array(
		'title' => 'Close',
	),
    
    3 => array(
		'title' => 'Images',
	),
    
    'ppb_image_fullwidth' => array(
    	'title' =>  'Image Fullwidth',
    	'icon' => 'image_full.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in pixel)',
    		),
    		'background_position' => array(
    			'title' => 'Background Position',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_image_parallax' => array(
    	'title' =>  'Image Parallax',
    	'icon' => 'image_parallax.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in pixel)',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_image_fixed_width' => array(
    	'title' =>  'Image Fixed Width',
    	'icon' => 'image_fixed.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption and description',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_image_poppup' => array(
    	'title' =>  'Image Fullwidth with Popup',
    	'icon' => 'image_full_popup.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter short description for this header',
    		),
    		'layout' => array(
    			'title' => 'Layout',
    			'type' => 'select',
    			'options' => array(
    				'contain' => 'Contain',
					'wide' => 'Wide',
    			),
    			'desc' => 'Select gallery layout',
    		),
    		'background' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'background_position' => array(
    			'title' => 'Background Position',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'textalign' => array(
    			'title' => 'Text Alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' 	=> 'Left',
    				'center' => 'center',
    				'right'	=> 'Right',
    			),
    			'desc' => 'Select content alignment for this content',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "60",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this background block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select background color for this this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#222222",
    			'desc' => 'Select font color for content on this content block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_fullscreen_image' => array(
    	'title' =>  'Image Fullscreen with Content',
    	'icon' => 'fullscreen_title.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter short description for this header',
    		),
    		'width' => array(
    			'title' => 'Content Width',
    			'type' => 'select',
    			'options' => array(
    				'100%' 	=> '100%',
    				'90%' 	=> '90%',
    				'80%' 	=> '80%',
    				'70%' 	=> '70%',
    				'60%' 	=> '60%',
    			),
    			'desc' => 'Select width in percentage for this content',
    		),
    		'background' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'background_position' => array(
    			'title' => 'Background Position',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for content on this content block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_fullwidth_image' => array(
    	'title' =>  'Image Fullwidth with Content',
    	'icon' => 'fullwidth_title.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter short description for this header',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in pixel)',
    		),
    		'background' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'background_position' => array(
    			'title' => 'Background Position',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select font color for content on this content block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_content_half_bg' => array(
    	'title' =>  'One Half Content with Background',
    	'icon' => 'half_content_bg.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter short description for this header',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as background',
    		),
    		'background_position' => array(
    			'title' => 'Background Position (Optional)',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 400,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Content Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'opacity' => array(
    			'title' => 'Content Background Opacity',
    			'type' => 'jslider',
    			"std" => "100",
				"min" => 10,
				"max" => 100,
				"step" => 5,
    			'desc' => 'Select background opacity for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'align' => array(
    			'title' => 'Content Box alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for content box',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_image_half_fixed_width' => array(
    	'title' =>  'Image One Half Width',
    	'icon' => 'image_half_fixed.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'align' => array(
    			'title' => 'Image alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for image',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_image_half_fullwidth' => array(
    	'title' =>  'Image One Half Fullwidth',
    	'icon' => 'image_half_full.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter short description for this header',
    		),
    		'image' => array(
    			'title' => 'Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in pixel)',
    		),
    		'align' => array(
    			'title' => 'Image alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for image',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for title and subtitle',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_two_cols_images' => array(
    	'title' =>  'Images Two Columns',
    	'icon' => 'images_two_cols.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image1' => array(
    			'title' => 'Image 1',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image2' => array(
    			'title' => 'Image 2',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption and description',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_two_cols_images_no_space' => array(
    	'title' =>  'Images Two Columns No Space',
    	'icon' => 'images_two_cols_no_space.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens.',
    		),
    		'image1' => array(
    			'title' => 'Image 1',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image2' => array(
    			'title' => 'Image 2',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 30,
				"max" => 1000,
				"step" => 5,
    			'desc' => 'Select number of height for this content (in pixel)',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption and description',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_three_cols_images' => array(
    	'title' =>  'Images Three Columns',
    	'icon' => 'images_three_cols.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image1' => array(
    			'title' => 'Image 1',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image2' => array(
    			'title' => 'Image 2',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image3' => array(
    			'title' => 'Image 3',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption and description',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_three_images_block' => array(
    	'title' =>  'Images Three blocks',
    	'icon' => 'images_three_block.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image_portrait' => array(
    			'title' => 'Image Portrait',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content (Portrait image size)',
    		),
    		'image_portrait_align' => array(
    			'title' => 'Image Portrait alignment',
    			'type' => 'select',
    			'options' => array(
    				'left' => 'Left',
    				'right' => 'Right'
    			),
    			'desc' => 'Select the alignment for image portrait size',
    		),
    		'image2' => array(
    			'title' => 'Image 2',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image3' => array(
    			'title' => 'Image 3',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption and description',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_four_images_block' => array(
    	'title' =>  'Images Four blocks',
    	'icon' => 'images_four_block.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'image1' => array(
    			'title' => 'Image 1',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image2' => array(
    			'title' => 'Image 2',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image3' => array(
    			'title' => 'Image 3',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'image4' => array(
    			'title' => 'Image 4',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display for this content',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption and description',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    
    4 => array(
		'title' => 'Close',
	),
    
    5 => array(
		'title' => 'Gallery',
	),
    
    'ppb_gallery_slider' => array(
    	'title' =>  'Gallery Slider Fullwidth',
    	'icon' => 'gallery_slider_full.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'gallery' => array(
    			'title' => 'Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery you want to display',
    		),
    		'autoplay' => array(
    			'title' => 'Auto Play',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => 'Auto play gallery image slider',
    		),
    		'timer' => array(
    			'title' => 'Timer',
    			'type' => 'jslider',
    			"std" => "5",
				"min" => 1,
				"max" => 60,
				"step" => 1,
    			'desc' => 'Select number of seconds for slider timer',
    		),
    		'caption' => array(
    			'title' => 'Display Image Caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => 'Display gallery image caption',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_gallery_slider_fixed_width' => array(
    	'title' =>  'Gallery Slider Fixed Width',
    	'icon' => 'gallery_slider_fixed.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'gallery' => array(
    			'title' => 'Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery you want to display',
    		),
    		'autoplay' => array(
    			'title' => 'Auto Play',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => 'Auto play gallery image slider',
    		),
    		'timer' => array(
    			'title' => 'Timer',
    			'type' => 'jslider',
    			"std" => "5",
				"min" => 1,
				"max" => 60,
				"step" => 1,
    			'desc' => 'Select number of seconds for slider timer',
    		),
    		'caption' => array(
    			'title' => 'Display Image Caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => 'Display gallery image caption',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_gallery_grid' => array(
    	'title' =>  'Gallery Grid',
    	'icon' => 'gallery_grid.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'gallery_id' => array(
    			'title' => 'Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery you want to display',
    		),
    		'layout' => array(
    			'title' => 'Layout',
    			'type' => 'select',
    			'options' => array(
    				'contain' => 'Contain',
					'wide' => 'Wide',
    			),
    			'desc' => 'Select gallery layout',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Colmuns',
					3 => '3 Colmuns',
					4 => '4 Colmuns',
					5 => '5 Colmuns',
    			),
    			'desc' => 'Select gallery columns',
    		),
    		'items' => array(
    			'title' => 'Infinite Scroll Initial Items',
    			'type' => 'jslider',
    			"std" => "0",
				"min" => 0,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Select number of items when load gallery initially. Use number which is more than zero will activate infinite scroll feature',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_gallery_masonry' => array(
    	'title' =>  'Gallery Masonry',
    	'icon' => 'gallery_masonry.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'gallery_id' => array(
    			'title' => 'Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery you want to display',
    		),
    		'layout' => array(
    			'title' => 'Layout',
    			'type' => 'select',
    			'options' => array(
    				'contain' => 'Contain',
					'wide' => 'Wide',
    			),
    			'desc' => 'Select gallery layout',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Colmuns',
					3 => '3 Colmuns',
					4 => '4 Colmuns',
					5 => '5 Colmuns',
    			),
    			'desc' => 'Select gallery columns',
    		),
    		'items' => array(
    			'title' => 'Infinite Scroll Initial Items',
    			'type' => 'jslider',
    			"std" => "0",
				"min" => 0,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Select number of items when load gallery initially. Use number which is more than zero will activate infinite scroll feature',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_gallery_horizontal' => array(
    	'title' =>  'Gallery Horizontal',
    	'icon' => 'horizontal.png',
    	'attr' => array(
    		'gallery' => array(
    			'title' => 'Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery you want to display',
    		),
    		'layout' => array(
    			'title' => 'Layout',
    			'type' => 'select',
    			'options' => array(
    				'wide' => 'Wide',
    				'contain' => 'Contain',
    			),
    			'desc' => 'Select gallery horizontal layout',
    		),
    		'items' => array(
    			'title' => 'Items',
    			'type' => 'jslider',
    			"std" => "0",
				"min" => 30,
				"max" => 200,
				"step" => 1,
    			'desc' => 'Enter number of items to display (number only)',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_gallery_striped' => array(
    	'title' =>  'Gallery Striped',
    	'icon' => 'images_three_cols.png',
    	'attr' => array(
    		'gallery' => array(
    			'title' => 'Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery you want to display',
    		),
    		'items' => array(
    			'title' => 'Items',
    			'type' => 'jslider',
    			"std" => "0",
				"min" => 30,
				"max" => 200,
				"step" => 1,
    			'desc' => 'Enter number of items to display (number only)',
    		),
    		'display_caption' => array(
    			'title' => 'Display caption',
    			'type' => 'select',
    			'options' => array(
    				1 => 'Yes',
    				0 => 'No'
    			),
    			'desc' => '',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_animated_gallery_grid' => array(
    	'title' =>  'Animated Gallery Grid',
    	'icon' => 'animated_grid.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens.',
    		),
    		'gallery_id' => array(
    			'title' => 'Gallery',
    			'type' => 'select',
    			'options' => $galleries_select,
    			'desc' => 'Select the gallery you want to display',
    		),
    		'rows' => array(
    			'type' => 'jslider',
    			"std" => "3",
				"min" => 1,
				"max" => 20,
				"step" => 1,
    			'desc' => 'Select number of rows to display',
    		),
    		
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_gallery_archive' => array(
    	'title' =>  'Gallery Archive',
    	'icon' => 'galleries.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Gallery Category',
    			'type' => 'select',
    			'options' => $gallery_cats_select,
    			'desc' => 'Select the gallery category (optional)',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "12",
				"min" => 1,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'layout' => array(
    			'title' => 'Layout',
    			'type' => 'select',
    			'options' => array(
    				'contain' => 'Contain',
					'wide' => 'Wide',
    			),
    			'desc' => 'Select gallery layout',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Colmuns',
					3 => '3 Colmuns',
					4 => '4 Colmuns',
    			),
    			'desc' => 'Select gallery columns',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    
    6 => array(
		'title' => 'Close',
	),
    
    7 => array(
		'title' => 'Portfolio',
	),
    
    'ppb_portfolio_slider' => array(
    	'title' =>  'Portfolio Slider',
    	'icon' => 'portfolio_slider.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Filter by portfolio category (Optional)',
    			'type' => 'select',
    			'options' => $portfolio_cats_select,
    			'desc' => 'You can choose to display only some portfolio items from selected portfolio category',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order portfolio items',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "9",
				"min" => 0,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_portfolio_classic' => array(
    	'title' =>  'Portfolio Classic',
    	'icon' => 'portfolio_classic.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'filterable' => array(
    			'title' => 'Display Filterable Portfolio Categories',
    			'type' => 'select',
    			'options' => array(
    				'hide' => 'Hide',
    				'display' => 'Display',
    			),
    			'desc' => 'Select to display filterable portfolio categories links',
    		),
    		'cat' => array(
    			'title' => 'Filter by portfolio category (Optional)',
    			'type' => 'select',
    			'options' => $portfolio_cats_select,
    			'desc' => 'You can choose to display only some portfolio items from selected portfolio category',
    		),
    		'layout' => array(
    			'title' => 'Layout',
    			'type' => 'select',
    			'options' => array(
    				'contain' => 'Contain',
					'wide' => 'Wide',
    			),
    			'desc' => 'Select portfolio layout',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Colmuns',
					3 => '3 Colmuns',
					4 => '4 Colmuns',
    			),
    			'desc' => 'Select portfolio columns',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order portfolio items',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "9",
				"min" => 0,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'items_ini' => array(
    			'title' => 'Infinite Scroll Initial Items',
    			'type' => 'jslider',
    			"std" => "0",
				"min" => 0,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Select number of items when load portfolio initially. Use number which is more than zero will activate infinite scroll feature',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_portfolio_classic_masonry' => array(
    	'title' =>  'Portfolio Classic Masonry',
    	'icon' => 'portfolio_classic_masonry.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'filterable' => array(
    			'title' => 'Display Filterable Portfolio Categories',
    			'type' => 'select',
    			'options' => array(
    				'hide' => 'Hide',
    				'display' => 'Display',
    			),
    			'desc' => 'Select to display filterable portfolio categories links',
    		),
    		'cat' => array(
    			'title' => 'Filter by portfolio category (Optional)',
    			'type' => 'select',
    			'options' => $portfolio_cats_select,
    			'desc' => 'You can choose to display only some portfolio items from selected portfolio category',
    		),
    		'layout' => array(
    			'title' => 'Layout',
    			'type' => 'select',
    			'options' => array(
    				'contain' => 'Contain',
					'wide' => 'Wide',
    			),
    			'desc' => 'Select portfolio layout',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Colmuns',
					3 => '3 Colmuns',
					4 => '4 Colmuns',
    			),
    			'desc' => 'Select portfolio columns',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order portfolio items',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "9",
				"min" => 0,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'items_ini' => array(
    			'title' => 'Infinite Scroll Initial Items',
    			'type' => 'jslider',
    			"std" => "0",
				"min" => 0,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Select number of items when load portfolio initially. Use number which is more than zero will activate infinite scroll feature',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_portfolio_grid' => array(
    	'title' =>  'Portfolio Grid',
    	'icon' => 'gallery_grid.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'filterable' => array(
    			'title' => 'Display Filterable Portfolio Categories',
    			'type' => 'select',
    			'options' => array(
    				'hide' => 'Hide',
    				'display' => 'Display',
    			),
    			'desc' => 'Select to display filterable portfolio categories links',
    		),
    		'cat' => array(
    			'title' => 'Filter by portfolio category (Optional)',
    			'type' => 'select',
    			'options' => $portfolio_cats_select,
    			'desc' => 'You can choose to display only some portfolio items from selected portfolio category',
    		),
    		'layout' => array(
    			'title' => 'Layout',
    			'type' => 'select',
    			'options' => array(
    				'contain' => 'Contain',
					'wide' => 'Wide',
    			),
    			'desc' => 'Select portfolio layout',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Colmuns',
					3 => '3 Colmuns',
					4 => '4 Colmuns',
    			),
    			'desc' => 'Select portfolio columns',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order portfolio items',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "9",
				"min" => 0,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'items_ini' => array(
    			'title' => 'Infinite Scroll Initial Items',
    			'type' => 'jslider',
    			"std" => "0",
				"min" => 0,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Select number of items when load portfolio initially. Use number which is more than zero will activate infinite scroll feature',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_portfolio_grid_masonry' => array(
    	'title' =>  'Portfolio Grid Masonry',
    	'icon' => 'gallery_masonry.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'filterable' => array(
    			'title' => 'Display Filterable Portfolio Categories',
    			'type' => 'select',
    			'options' => array(
    				'hide' => 'Hide',
    				'display' => 'Display',
    			),
    			'desc' => 'Select to display filterable portfolio categories links',
    		),
    		'cat' => array(
    			'title' => 'Filter by portfolio category (Optional)',
    			'type' => 'select',
    			'options' => $portfolio_cats_select,
    			'desc' => 'You can choose to display only some portfolio items from selected portfolio category',
    		),
    		'layout' => array(
    			'title' => 'Layout',
    			'type' => 'select',
    			'options' => array(
    				'contain' => 'Contain',
					'wide' => 'Wide',
    			),
    			'desc' => 'Select portfolio layout',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Colmuns',
					3 => '3 Colmuns',
					4 => '4 Colmuns',
    			),
    			'desc' => 'Select portfolio columns',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order portfolio items',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "9",
				"min" => 0,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'items_ini' => array(
    			'title' => 'Infinite Scroll Initial Items',
    			'type' => 'jslider',
    			"std" => "0",
				"min" => 0,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Select number of items when load portfolio initially. Use number which is more than zero will activate infinite scroll feature',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_portfolio_mixed_grid' => array(
    	'title' =>  'Portfolio Mixed Grid',
    	'icon' => 'portfolio_mixed_grid.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'filterable' => array(
    			'title' => 'Display Filterable Portfolio Categories',
    			'type' => 'select',
    			'options' => array(
    				'hide' => 'Hide',
    				'display' => 'Display',
    			),
    			'desc' => 'Select to display filterable portfolio categories links',
    		),
    		'cat' => array(
    			'title' => 'Filter by portfolio category (Optional)',
    			'type' => 'select',
    			'options' => $portfolio_cats_select,
    			'desc' => 'You can choose to display only some portfolio items from selected portfolio category',
    		),
    		'layout' => array(
    			'title' => 'Layout',
    			'type' => 'select',
    			'options' => array(
    				'contain' => 'Contain',
					'wide' => 'Wide',
    			),
    			'desc' => 'Select portfolio layout',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order portfolio items',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "9",
				"min" => 0,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		/*'items_ini' => array(
    			'title' => 'Infinite Scroll Initial Items',
    			'type' => 'jslider',
    			"std" => "0",
				"min" => 0,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Select number of items when load portfolio initially. Use number which is more than zero will activate infinite scroll feature',
    		),*/
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_portfolio_track' => array(
    	'title' =>  'Portfolio Track',
    	'icon' => 'portfolio_track.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter short description for this header',
    		),
    		'featured_image' => array(
    			'title' => 'Featured Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as content featured image',
    		),
    		'cat' => array(
    			'title' => 'Filter by portfolio category (Optional)',
    			'type' => 'select',
    			'options' => $portfolio_cats_select,
    			'desc' => 'You can choose to display only some portfolio items from selected portfolio category',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order portfolio items',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "9",
				"min" => 0,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as background',
    		),
    		'background_position' => array(
    			'title' => 'Background Position (Optional)',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    
    8 => array(
		'title' => 'Close',
	),
    
    9 => array(
		'title' => 'Blog',
	),
    
    'ppb_blog_slider' => array(
    	'title' =>  'Blog Slider',
    	'icon' => 'portfolio_slider.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Filter by category (Optional)',
    			'type' => 'select',
    			'options' => $categories_select,
    			'desc' => 'You can choose to display only some posts from selected category',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "9",
				"min" => 0,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => $blog_slider_column_select,
    			'desc' => 'You can choose to display blog post slider in fullwidth, 2 or 3 columns',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_blog_grid' => array(
    	'title' =>  'Blog Grid',
    	'icon' => 'blog.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Filter by category',
    			'type' => 'select',
    			'options' => $categories_select,
    			'desc' => 'You can choose to display only some posts from selected category',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Colmuns',
					3 => '3 Colmuns',
    			),
    			'desc' => 'Select gallery columns',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'link_title' => array(
    			'title' => 'Enter button title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter link button to display link to your blog page for example. Read more',
    		),
    		'link_url' => array(
    			'title' => 'Button Link URL (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter redirected link URL when button is clicked',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "9",
				"min" => 1,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'items_ini' => array(
    			'title' => 'Infinite Scroll Initial Items',
    			'type' => 'jslider',
    			"std" => "0",
				"min" => 0,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Select number of items when load portfolio initially. Use number which is more than zero will activate infinite scroll feature',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_blog_masonry' => array(
    	'title' =>  'Blog Masonry',
    	'icon' => 'blog_masonry.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Filter by category',
    			'type' => 'select',
    			'options' => $categories_select,
    			'desc' => 'You can choose to display only some posts from selected category',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Colmuns',
					3 => '3 Colmuns',
    			),
    			'desc' => 'Select gallery columns',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'link_title' => array(
    			'title' => 'Enter button title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter link button to display link to your blog page for example. Read more',
    		),
    		'link_url' => array(
    			'title' => 'Button Link URL (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter redirected link URL when button is clicked',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "9",
				"min" => 1,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'items_ini' => array(
    			'title' => 'Infinite Scroll Initial Items',
    			'type' => 'jslider',
    			"std" => "0",
				"min" => 0,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Select number of items when load portfolio initially. Use number which is more than zero will activate infinite scroll feature',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_blog_minimal' => array(
    	'title' =>  'Blog Minimal',
    	'icon' => 'blog_minimal.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Filter by category',
    			'type' => 'select',
    			'options' => $categories_select,
    			'desc' => 'You can choose to display only some posts from selected category',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "3",
				"min" => 1,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'link_title' => array(
    			'title' => 'Enter button title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter link button to display link to your blog page for example. Read more',
    		),
    		'link_url' => array(
    			'title' => 'Button Link URL (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter redirected link URL when button is clicked',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    
    10 => array(
		'title' => 'Close',
	),
    
    11 => array(
		'title' => 'Other Posts',
	),
    
    'ppb_team_column' => array(
    	'title' =>  'Team Column Classic',
    	'icon' => 'images_three_cols.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Filter by team category',
    			'type' => 'select',
    			'options' => $team_cats_select,
    			'desc' => 'You can choose to display only some team members from selected team category',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => $team_column_select,
    			'desc' => 'Select how many columns you want to display service items in a row',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order team members',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "5",
				"min" => 1,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_team_grid' => array(
    	'title' =>  'Team Grid',
    	'icon' => 'team_grid.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Filter by team category',
    			'type' => 'select',
    			'options' => $team_cats_select,
    			'desc' => 'You can choose to display only some team members from selected team category',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => $team_column_select,
    			'desc' => 'Select how many columns you want to display service items in a row',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order team members',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "5",
				"min" => 1,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_team_card' => array(
    	'title' =>  'Team Card',
    	'icon' => 'team_card.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
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
    			"std" => "5",
				"min" => 1,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'card_bgcolor' => array(
    			'title' => 'Card Background Color',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this header block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select font color for content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_client_slider' => array(
    	'title' =>  'Client Slider',
    	'icon' => 'client_slider.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'layout' => array(
    			'title' => 'Layout',
    			'type' => 'select',
    			'options' => $client_layout_select,
    			'desc' => 'Select layout you want to display client wrapper',
    		),
    		'cat' => array(
    			'title' => 'Filter by client category',
    			'type' => 'select',
    			'options' => $client_cats_select,
    			'desc' => 'You can choose to display only some clients from selected client category',
    		),
    		'items' => array(
    			'title' => 'Items',
    			'type' => 'jslider',
    			"std" => "5",
				"min" => 1,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_testimonial_slider' => array(
    	'title' =>  'Testimonials Slider',
    	'icon' => 'testimonial_slider.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Filter by testimonials category',
    			'type' => 'select',
    			'options' => $testimonial_cats_select,
    			'desc' => 'You can choose to display only some testimonials from selected testimonial category',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "3",
				"min" => 1,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'background' => array(
    			'title' => 'Background Image (Optional)',
    			'type' => 'file',
    			'desc' => 'Upload background image you want to display for this content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_testimonial_column' => array(
    	'title' =>  'Testimonials Column',
    	'icon' => 'testimonial_column.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => $testimonial_column_select,
    			'desc' => 'Select how many columns you want to display service items in a row',
    		),
    		'cat' => array(
    			'title' => 'Filter by testimonials category',
    			'type' => 'select',
    			'options' => $testimonial_cats_select,
    			'desc' => 'You can choose to display only some testimonials from selected testimonial category',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "4",
				"min" => 1,
				"max" => 50,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_pricing' => array(
			'title' => 'Pricing Table',
			'icon' => 'pricing_table.png',
			'attr' => array(
				'slug' => array(
	    			'title' => 'Slug (Optional)',
	    			'type' => 'text',
	    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
	    		),
	    		'skin' => array(
	    			'title' => 'Skin',
	    			'type' => 'select',
	    			'options' => array(
						'light' => 'Light',
						'normal' => 'Normal',
					),
	    			'desc' => 'Select skin for this content',
	    		),
	    		'cat' => array(
	    			'title' => 'Filter by prciing category',
	    			'type' => 'select',
	    			'options' => $pricing_cat_select,
	    			'desc' => 'You can choose to display only some items from selected pricing category',
	    		),
	    		'columns' => array(
	    			'title' => 'Columns',
	    			'type' => 'select',
	    			'options' => array(
						2 => '2 Columns',
						3 => '3 Columns',
						4 => '4 Columns',
					),
	    			'desc' => 'Select Number of Pricing Columns',
	    		),
	    		'items' => array(
	    			'type' => 'jslider',
	    			"std" => "4",
					"min" => 1,
					"max" => 50,
					"step" => 1,
	    			'desc' => 'Enter number of items to display',
	    		),
	    		'padding' => array(
	    			'title' => 'Content Padding',
	    			'type' => 'jslider',
	    			"std" => "30",
					"min" => 0,
					"max" => 200,
					"step" => 5,
	    			'desc' => 'Select padding top and bottom value for this header block',
	    		),
	    		'highlightcolor' => array(
	    			'title' => 'Highlight Color',
	    			'type' => 'colorpicker',
	    			"std" => "#001d2c",
	    			'desc' => 'Select hightlight color for this content',
	    		),
	    		'bgcolor' => array(
	    			'title' => 'Background Color (Optional)',
	    			'type' => 'colorpicker',
	    			"std" => "#f9f9f9",
	    			'desc' => 'Select background color for this content block',
	    		),
	    		'custom_css' => array(
	    			'title' => 'Custom CSS',
	    			'type' => 'text',
	    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
	    		),
	    	),
	    	'desc' => array(),
	    	'content' => FALSE
		),
    'ppb_contact_map' => array(
    	'title' =>  'Contact Form With Map',
    	'icon' => 'contact_map.png',
    	'attr' => array(
    		'slug' => array(
	    	    'title' => 'Slug (Optional)',
	    	    'type' => 'text',
	    	    'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
	    	),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter short description for this header',
    		),
    		'type' => array(
    			'title' => 'Map Type',
    			'type' => 'select',
    			'options' => array(
    				'' => 'Default Style',
					'ROADMAP' => 'Roadmap',
					'SATELLITE' => 'Satellite',
					'HYBRID' => 'Hybrid',
					'TERRAIN' => 'Terrain',
				),
    			'desc' => 'Select google map type',
    		),
    		'lat' => array(
    			'title' => 'Latitude',
    			'type' => 'text',
    			'desc' => 'Map latitude <a href="http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/">Find here</a>',
    		),
    		'long' => array(
    			'title' => 'Longtitude',
    			'type' => 'text',
    			'desc' => 'Map longitude <a href="http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/">Find here</a>',
    		),
    		'zoom' => array(
    			'title' => 'Zoom Level',
    			'type' => 'jslider',
    			"std" => "8",
				"min" => 1,
				"max" => 18,
				"step" => 1,
    			'desc' => 'Enter zoom level',
    		),
    		'popup' => array(
    			'title' => 'Popup Text',
    			'type' => 'text',
    			'desc' => 'Enter text to display as popup above location on map for example. your company name',
    		),
    		'marker' => array(
    			'title' => 'Custom Marker Icon (Optional)',
    			'type' => 'file',
    			'desc' => 'Enter custom marker image URL',
    		),
    		'bgcolor' => array(
    			'title' => 'Background Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#f9f9f9",
    			'desc' => 'Select background color for this content block',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'buttonbgcolor' => array(
    			'title' => 'Button Background Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#000000",
    			'desc' => 'Select background color for contact form button',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_contact_sidebar' => array(
    	'title' =>  'Contact Form With Sidebar',
    	'icon' => 'contact_sidebar.png',
    	'attr' => array(
    		'slug' => array(
	    	    'title' => 'Slug (Optional)',
	    	    'type' => 'text',
	    	    'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
	    	),
    		'subtitle' => array(
    			'title' => 'Sub Title (Optional)',
    			'type' => 'text',
    			'desc' => 'Enter short description for this header',
    		),
    		'sidebar' => array(
    			'Title' => 'Content Sidebar',
    			'type' => 'select',
    			'options' => $theme_sidebar,
    			'desc' => 'You can select sidebar to display next to classic blog content',
    		),
    		'sidebar_layout' => array(
    			'Title' => 'Sidebar Layout',
    			'type' => 'select',
    			'options' => $theme_sidebar_layout,
    			'desc' => 'You can select sidebar layout between left or right sidebar',
    		),
    		'padding' => array(
	    	    'title' => 'Content Padding',
	    	    'type' => 'jslider',
	    	    "std" => "30",
			    "min" => 0,
			    "max" => 200,
			    "step" => 5,
	    	    'desc' => 'Select padding top and bottom value for this header block',
	    	),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_contact_fullwidth' => array(
    	'title' =>  'Contact Form Fullwidth',
    	'icon' => 'contact_fullwidth.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'width' => array(
    			'title' => 'Content Width',
    			'type' => 'select',
    			'options' => array(
    				'100%' 	=> '100%',
    				'90%' 	=> '90%',
    				'80%' 	=> '80%',
    				'70%' 	=> '70%',
    				'60%' 	=> '60%',
    			),
    			'desc' => 'Select width in percentage for this content',
    		),
    		'padding' => array(
    			'title' => 'Content Padding',
    			'type' => 'jslider',
    			"std" => "30",
				"min" => 0,
				"max" => 200,
				"step" => 5,
    			'desc' => 'Select padding top and bottom value for this header block',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => TRUE
    ),
    'ppb_map' => array(
    	'title' =>  'Fullwidth Map',
    	'icon' => 'googlemap.png',
    	'attr' => array(
    		'slug' => array(
	    	    'title' => 'Slug (Optional)',
	    	    'type' => 'text',
	    	    'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
	    	),
    		'type' => array(
    			'title' => 'Map Type',
    			'type' => 'select',
    			'options' => array(
    				'' => 'Default Style',
					'ROADMAP' => 'Roadmap',
					'SATELLITE' => 'Satellite',
					'HYBRID' => 'Hybrid',
					'TERRAIN' => 'Terrain',
				),
    			'desc' => 'Select google map type',
    		),
    		'height' => array(
    			'title' => 'Height',
    			'type' => 'jslider',
    			"std" => "600",
				"min" => 10,
				"max" => 1000,
				"step" => 10,
    			'desc' => 'Select map height (in px)',
    		),
    		'lat' => array(
    			'title' => 'Latitude',
    			'type' => 'text',
    			'desc' => 'Map latitude <a href="http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/">Find here</a>',
    		),
    		'long' => array(
    			'title' => 'Longtitude',
    			'type' => 'text',
    			'desc' => 'Map longitude <a href="http://www.tech-recipes.com/rx/5519/the-easy-way-to-find-latitude-and-longitude-values-in-google-maps/">Find here</a>',
    		),
    		'zoom' => array(
    			'title' => 'Zoom Level',
    			'type' => 'jslider',
    			"std" => "8",
				"min" => 1,
				"max" => 18,
				"step" => 1,
    			'desc' => 'Enter zoom level',
    		),
    		'popup' => array(
    			'title' => 'Popup Text',
    			'type' => 'text',
    			'desc' => 'Enter text to display as popup above location on map for example. your company name',
    		),
    		'marker' => array(
    			'title' => 'Custom Marker Icon (Optional)',
    			'type' => 'file',
    			'desc' => 'Enter custom marker image URL',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_event_list' => array(
    	'title' =>  'Event List',
    	'icon' => 'event_list.png',
    	'attr' => array(
    		'slug' => array(
    			'title' => 'Slug (Optional)',
    			'type' => 'text',
    			'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
    		),
    		'cat' => array(
    			'title' => 'Filter by event category (Optional)',
    			'type' => 'select',
    			'options' => $event_cat_select,
    			'desc' => 'You can choose to display only some event items from selected event category',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "9",
				"min" => 0,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'background' => array(
    			'title' => 'Background Image',
    			'type' => 'file',
    			'desc' => 'Upload image you want to display as background',
    		),
    		'background_position' => array(
    			'title' => 'Background Position (Optional)',
    			'type' => 'select',
    			'options' => array(
    				'top' => 'Top',
    				'center' => 'Center',
    				'bottom' => 'Bottom',
    			),
    			'desc' => 'Select image background position option',
    		),
    		'fontcolor' => array(
    			'title' => 'Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#444444",
    			'desc' => 'Select font color for this content',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
    'ppb_sticky_menu' => array(
    	'title' =>  'Sticky Menu',
    	'icon' => 'sticky_menu.png',
    	'attr' => array(
    		'menu' => array(
    			'title' => 'Select Menu',
    			'type' => 'select',
    			'options' => $menus_arr_select,
    			'desc' => 'You can choose to display selected menu',
    		),
    		'bgcolor' => array(
    			'title' => 'background Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#ffffff",
    			'desc' => 'Select background color for menu',
    		),
    		'bordercolor' => array(
    			'title' => 'Border Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#e1e1e1",
    			'desc' => 'Select border color for menu',
    		),
    		'fontcolor' => array(
    			'title' => 'Menu Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#666666",
    			'desc' => 'Select font color for this menu',
    		),
    		'active_fontcolor' => array(
    			'title' => 'Active Menu Font Color (Optional)',
    			'type' => 'colorpicker',
    			"std" => "#222222",
    			'desc' => 'Select active font color for this menu',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    ),
);

//Check if Rev slider is installed	
$revslider = ABSPATH . '/wp-content/plugins/revslider/revslider.php';

// Check if the file is available to prevent warnings
$pp_revslider_activated = file_exists($revslider);

if($pp_revslider_activated)
{
	// Get Rev Sliders
	require_once ABSPATH . 'wp-admin/includes/plugin.php' ;
	$is_revslider_active = is_plugin_active('revslider/revslider.php');
	$wp_revsliders = array();
	
	if($is_revslider_active)
	{
		$wp_revsliders = array(
			-1		=> "Choose a slide",
		);
		$revslider_objs = new RevSlider();
		$revslider_obj_arr = $revslider_objs->getArrSliders();
		
		foreach($revslider_obj_arr as $revslider_obj)
		{
			$wp_revsliders[$revslider_obj->getAlias()] = $revslider_obj->getTitle();
		}
	}
	
	$ppb_shortcodes['ppb_revslider'] = array(
    	'title' =>  'Revolution Slider',
    	'icon' => 'revslider.png',
    	'attr' => array(
    		'slug' => array(
	    	    'title' => 'Slug (Optional)',
	    	    'type' => 'text',
	    	    'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
	    	),
    		'slider_id' => array(
    			'title' => 'Select Slider to display',
    			'type' => 'select',
    			'options' => $wp_revsliders,
    			'desc' => 'Choose which revolution slider to display (if it\'s empty. You need to create a revolution slider first.)',
    		),
    		'display' => array(
    			'title' => 'Slider Display Options',
    			'type' => 'select',
    			'options' => array(
    				'normal' => 'Display Normal Slider',
    				'force' => 'Display Only Slider for this page'
    			),
    			'desc' => 'Select slider display options',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    );
}

//Check if Woocommerce is installed
if(class_exists('Woocommerce'))
{
	//Get all product categories
	$product_cats_arr = get_terms('product_cat', 'hide_empty=0&hierarchical=0&parent=0&orderby=menu_order');
	$product_cats_select = array();
	$product_cats_select[''] = '';
	
	foreach ($product_cats_arr as $product_cat) {
		$product_cats_select[$product_cat->slug] = $product_cat->name;
	}

	$ppb_shortcodes['ppb_product_grid'] = array(
    	'title' =>  'Woocommerce Product Grid',
    	'icon' => 'portfolio_classic.png',
    	'attr' => array(
    		'slug' => array(
	    	    'title' => 'Slug (Optional)',
	    	    'type' => 'text',
	    	    'desc' => 'The "slug" is the URL-friendly version of this content. It is usually all lowercase and contains only letters, numbers, and hyphens. This option is used for one page template',
	    	),
    		'cat' => array(
    			'title' => 'Filter by product category (Optional)',
    			'type' => 'select',
    			'options' => $product_cats_select,
    			'desc' => 'You can choose to display only some products from selected category',
    		),
    		'columns' => array(
    			'title' => 'Columns',
    			'type' => 'select',
    			'options' => array(
    				2 => '2 Colmuns',
					3 => '3 Colmuns',
					4 => '4 Colmuns',
    			),
    			'desc' => 'Select product columns',
    		),
    		'order' => array(
    			'title' => 'Order By',
    			'type' => 'select',
    			'options' => $order_select,
    			'desc' => 'Select how you want to order product items',
    		),
    		'items' => array(
    			'type' => 'jslider',
    			"std" => "9",
				"min" => 0,
				"max" => 100,
				"step" => 1,
    			'desc' => 'Enter number of items to display',
    		),
    		'image_size' => array(
    			'title' => 'Product Image Size',
    			'type' => 'select',
    			'options' => array(
    				'original' => 'Original',
					'grandportfolio-gallery-grid' => 'Gallery Grid',
    			),
    			'desc' => 'Select product columns',
    		),
    		'custom_css' => array(
    			'title' => 'Custom CSS',
    			'type' => 'text',
    			'desc' => 'You can add custom CSS style for this block (advanced user only). For example text-align:center;',
    		),
    	),
    	'desc' => array(),
    	'content' => FALSE
    );
}

$ppb_shortcodes[12] = array(
    'title' => 'Close',
);

//Add demo pages layout to import
$ppb_shortcodes[13] = array(
    'title' => 'Sample Pages',
);

$ppb_shortcodes['landing-home'] = array(
	'title' =>  'Landing - Home',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagehome_export_01-15-2016_0913am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/landing/',
);

$ppb_shortcodes['landing-about-me-1'] = array(
	'title' =>  'Landing - About Me 1',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageabout-me-1_export_01-15-2016_0916am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/landing/pages/about-me-1/',
);

$ppb_shortcodes['landing-about-me-2'] = array(
	'title' =>  'Landing - About Me 2',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageabout-me-2_export_01-15-2016_0918am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/landing/pages/about-me-2/',
);

$ppb_shortcodes['landing-about-us-1'] = array(
	'title' =>  'Landing - About Us 1',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageabout-us-1_export_01-15-2016_0919am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/landing/pages/about-us-1/',
);

$ppb_shortcodes['landing-about-us-2'] = array(
	'title' =>  'Landing - About Us 2',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageabout-us-2_export_01-15-2016_0924am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/landing/pages/about-us-2/',
);

$ppb_shortcodes['landing-about-us-3'] = array(
	'title' =>  'Landing - About Us 3',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageabout-us-3_export_01-15-2016_0925am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/landing/pages/about-us-3/',
);

$ppb_shortcodes['landing-pricing'] = array(
	'title' =>  'Landing - Pricing',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagepricing_export_01-15-2016_0928am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/landing/pages/pricing/',
);

$ppb_shortcodes['landing-contact-us-1'] = array(
	'title' =>  'Landing - Contact Us 1',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagecontact-us-1_export_01-15-2016_0930am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/landing/pages/contact-1/',
);

$ppb_shortcodes['landing-contact-us-2'] = array(
	'title' =>  'Landing - Contact Us 2',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagecontact-us-2_export_01-15-2016_0931am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/landing/pages/contact-us-2/',
);

$ppb_shortcodes['landing-contact-us-3'] = array(
	'title' =>  'Landing - Contact Us 3',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagecontact-us_export_01-15-2016_0931am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/landing/pages/contact-us-3/',
);

$ppb_shortcodes['landing-services'] = array(
	'title' =>  'Landing - Services',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageservices_export_01-15-2016_0932am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/landing/pages/services/',
);

$ppb_shortcodes['landing-single-portfolio'] = array(
	'title' =>  'Landing - Single Portfolio',
	'type' => 'demo_page',
	'file' => 'grand portfolio-page-the-different-export-01-15-2016_0938am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/landing/portfolios/the-different/',
);

$ppb_shortcodes['architect-projects'] = array(
	'title' =>  'Architect - Projects',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageprojects_export_01-15-2016_1107am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo1/projects/',
);

$ppb_shortcodes['architect-about-us'] = array(
	'title' =>  'Architect - About Us',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageabout-us_export_01-15-2016_1108am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo1/about-us/',
);

$ppb_shortcodes['architect-contact-us'] = array(
	'title' =>  'Architect - Contact Us',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagecontact_export_01-15-2016_1108am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo1/contact/',
);

$ppb_shortcodes['blogger-home'] = array(
	'title' =>  'Blogger - Home',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagehome_export_01-15-2016_1111am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo2/',
);

$ppb_shortcodes['blogger-about'] = array(
	'title' =>  'Blogger - About',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageabout_export_01-15-2016_1112am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo2/about/',
);

$ppb_shortcodes['blogger-contact'] = array(
	'title' =>  'Blogger - Contact',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagecontact-us-1_export_01-15-2016_0930am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo2/contact/',
);

$ppb_shortcodes['creative-home'] = array(
	'title' =>  'Creative - Home',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagehome_export_01-15-2016_1144am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo3',
);

$ppb_shortcodes['creative-about'] = array(
	'title' =>  'Creative - About',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageabout_export_01-15-2016_1230pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo3/about/',
);

$ppb_shortcodes['creative-contact'] = array(
	'title' =>  'Creative - Contact',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagecontact_export_01-15-2016_1231pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo3/contact/',
);

$ppb_shortcodes['creative-portfolio'] = array(
	'title' =>  'Creative - Portfolio',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageportfolio_export_01-15-2016_1232pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo3/portfolio/',
);

$ppb_shortcodes['fashion-home'] = array(
	'title' =>  'Fashion - Home',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagehome_export_01-15-2016_0107pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo4/',
);

$ppb_shortcodes['fashion-about'] = array(
	'title' =>  'Fashion - About',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageabout_export_01-15-2016_0108pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo4/about/',
);

$ppb_shortcodes['fashion-contact'] = array(
	'title' =>  'Fashion - Contact',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagecontact_export_01-15-2016_0108pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo4/contact/',
);

$ppb_shortcodes['fashion-portfolio'] = array(
	'title' =>  'Fashion - Portfolio',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageportfolio_export_01-15-2016_0109pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo4/portfolio/',
);

$ppb_shortcodes['music-home'] = array(
	'title' =>  'Music - Home',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagehome_export_01-15-2016_0110pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo5',
);

$ppb_shortcodes['photographer-about'] = array(
	'title' =>  'Photographer - About',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageabout_export_01-15-2016_0111pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo6/about/',
);

$ppb_shortcodes['photographer-contact'] = array(
	'title' =>  'Photographer - Contact',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagecontact_export_01-15-2016_0111pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo6/contact/',
);

$ppb_shortcodes['photographer-gallery'] = array(
	'title' =>  'Photographer - Gallery',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagegallery_export_01-15-2016_0112pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo6/gallery/',
);

$ppb_shortcodes['photographer-shop'] = array(
	'title' =>  'Photographer - Shop',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageshop_export_01-15-2016_0113pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo6/shop-2/',
);

$ppb_shortcodes['publisher-home'] = array(
	'title' =>  'Publisher - Home',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagehome_export_01-15-2016_0114pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo7',
);

$ppb_shortcodes['publisher-about'] = array(
	'title' =>  'Publisher - About',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopageabout_export_01-15-2016_0114pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo7/about/',
);

$ppb_shortcodes['publisher-contact'] = array(
	'title' =>  'Publisher - Contact',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagecontact_export_01-15-2016_0115pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo7/contact/',
);

$ppb_shortcodes['publisher-magazine'] = array(
	'title' =>  'Publisher - Magazine',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagemagazine_export_01-15-2016_0115pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo7/magazine/',
);

$ppb_shortcodes['publisher-videos'] = array(
	'title' =>  'Publisher - Videos',
	'type' => 'demo_page',
	'file' => 'grand-portfoliopagevideos_export_01-15-2016_0116pm.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo7/videos/',
);

$ppb_shortcodes['agency-home'] = array(
	'title' =>  'Agency - Home',
	'type' => 'demo_page',
	'file' => 'grandportfoliopagehome_export_02-23-2016_1108am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo8',
);

$ppb_shortcodes['agency-about'] = array(
	'title' =>  'Agency - About',
	'type' => 'demo_page',
	'file' => 'grandportfoliopagemake-a-winning-team-everybody-are-important_export_02-23-2016_1109am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo8/make-a-winning-team-everybody-are-important/',
);

$ppb_shortcodes['agency-portfolio'] = array(
	'title' =>  'Agency - Portfolio',
	'type' => 'demo_page',
	'file' => 'grandportfoliopagecase-studies_export_02-23-2016_1110am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo8/case-studies/',
);

$ppb_shortcodes['agency-contact'] = array(
	'title' =>  'Agency - Contact',
	'type' => 'demo_page',
	'file' => 'grandportfoliopagecontact_export_02-23-2016_1111am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo8/contact/',
);

$ppb_shortcodes['company-home'] = array(
	'title' =>  'Company - Home',
	'type' => 'demo_page',
	'file' => 'grandportfoliopagehome_export_06-23-2016_1122am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo9',
);

$ppb_shortcodes['company-about'] = array(
	'title' =>  'Company - About',
	'type' => 'demo_page',
	'file' => 'grandportfoliopagemake-a-winning-team-everybody-are-important_export_06-23-2016_1123am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo9/make-a-winning-team-everybody-are-important/',
);

$ppb_shortcodes['company-portfolio'] = array(
	'title' =>  'Company - Portfolio',
	'type' => 'demo_page',
	'file' => 'grandportfoliopagewe-are-a-team-of-creative-digital-folks_export_06-23-2016_1124am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo9/works/',
);

$ppb_shortcodes['company-contact'] = array(
	'title' =>  'Company - Contact',
	'type' => 'demo_page',
	'file' => 'grandportfoliopagewe-would-love-to-hear-from-you_export_06-23-2016_1125am.json',
	'url' => 'http://themes.themegoods2.com/grandportfolio/demo9/contact/',
);

$ppb_shortcodes[14] = array(
    'title' => 'Close',
);
?>