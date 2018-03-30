<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'rnr_';

global $meta_boxes;

$meta_boxes = array();

global $smof_data;


/* ----------------------------------------------------- */
// Page Sections Metaboxes
/* ----------------------------------------------------- */


/* ----------------------------------------------------- */
// Revolution Slider
/* ----------------------------------------------------- */

$revolutionslider = array();
$revolutionslider[0] = 'No Slider';

if(class_exists('RevSlider')){
    $slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	foreach($arrSliders as $revSlider) { 
		$revolutionslider[$revSlider->getAlias()] = $revSlider->getTitle();
	}
}

//$types = get_terms('portfolio_filter', 'hide_empty=0');
$types = get_categories('taxonomy=portfolio_filter');
$types_array[0] = 'All categories';
if($types) {
	foreach($types as $type) {
		$types_array[$type->cat_ID] = $type->cat_name;
	}
}

/* Page Section Background Settings */

$grid_array = array('Select a size','2 Columns','3 Columns','4 Columns', '5 columns', '6 columns');

$pagebg_type_array = array(
	'image' => 'Image',
	'gradient' => 'Gradient',
	'color' => 'Color'
);


/* ----------------------------------------------------- */
// portfolio Settings
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id' => 'portfoliosettings',
	'title' => 'Page Settings',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'		=> 'Open as a Separate Page',
			'id'		=> $prefix . 'separate_page',
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),
	
		array(
			'name' => 'Disable Page Title',
			'id'   => $prefix . "disable_title",
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),

		array(
			'name'		=> 'Alternate Page Title',
			'id'		=> $prefix . "alt_title",
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),

		array(
			'name'		=> 'Page Subtitle',
			'id'		=> $prefix . "subtitle",
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),	
		
		array(
			'name'		=> 'Disable section from menu',
			'id'		=> $prefix . 'disable_section_from_menu',
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),			
			
		array(
			'name'		=> 'Assign current page as',
			'id'		=> $prefix . "assign_type",
			'type'		=> 'select',
			'options'	=> array(
			    'select'		=> 'Select a Section',
				'home-section'		=> 'Home Section',
				'portfolio-section'	=> 'Portfolio Section',
				'grid-portfolio-section'	=> 'Grid Portfolio Section',
				'portfolio-gallery'	=> 'Portfolio Gallery Section',								
				'parallax-section'	=> 'Parallax Section',
				'contact-section'		=> 'Contact Section',
				'revolutionslider-section'		=> 'Revolution Slider Section'
			),
			'multiple'	=> false,
			'std'		=> 'Select Custom Section'
		),	

		array(
			'name'		=> 'Home Revolution Slider/ Revolution Section Slider',
			'id'		=> $prefix . "revolutionslider",
			'type'		=> 'select',
			'options'	=> $revolutionslider,
			'multiple'	=> false,
			'desc'		=> 'Select any one of the revolution sliders you created.',
		)	,	

		array(
			'name'		=> 'Portfolio Column Sizes',
			'id'		=> $prefix . "portfolio_grid",
			'type'		=> 'select',
			'options'	=> $grid_array,
			'multiple'	=> false,
			'desc'		=> 'Select any one of the grid sizes to showcase your portfolio.',
		),
		array(
			'name' => 'Select Portfolio Filters',
			'id' => $prefix . "portfoliofilter",
			'type' => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options' => $types_array,
			// Select multiple values, optional. Default is false.
			'multiple' => true,
			'desc' => 'Optional: Choose what portfolio category you want to display on this page (If Portfolio Template chosen).'
		)
	)
);




/* ----------------------------------------------------- */
// Blog Post Metaboxes
/* ----------------------------------------------------- */


/*  Blog Post Slides Metabox */
$meta_boxes[] = array(
	'id'		=> 'rnr-blogmeta-gallery',
	'title'		=> 'Blog Post Image Slides',
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> 'Blog Post Slider Images',
			'desc'	=> 'Upload up to 20 images for a slideshow - or only one to display a single image. <br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.',
			'id'	=> $prefix . 'blogitemslides',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 20,
		)
		
	)
);

/*  Blog Link Post Settings */

$meta_boxes[] = array(
	'id' => 'rnr-blogmeta-link',
	'title' => 'Link Settings',
	'pages' => array( 'post'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(	
		array(
			'name'		=> 'Link Url',
			'id'		=> $prefix . 'bloglinkurl',
			'desc'		=> 'Enter your URL here',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
	)
);
/*  Blog Quote Post Settings */

$meta_boxes[] = array(
	'id' => 'rnr-blogmeta-quote',
	'title' => 'Quote Settings',
	'pages' => array( 'post'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(	
		array(
			'name'		=> 'Quote',
			'id'		=> $prefix . 'blogquote',
			'desc'		=> 'Enter Quote here.',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),
		array(
			'name'		=> 'Quote Author/Source Link',
			'id'		=> $prefix . 'blogquotesource',
			'desc'		=> 'Enter the Quote Source or Quote Author.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
	)
);
/*  Blog Audio Post Settings */

$meta_boxes[] = array(
	'id' => 'rnr-blogmeta-audio',
	'title' => 'Audio Settings',
	'pages' => array( 'post'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(	
		array(
			'name'		=> 'Audio Code',
			'id'		=> $prefix . 'blogaudiourl',
			'desc'		=> 'Enter your Audio URL(Oembed) or Embed Code.',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),
	)
);

/*  Blog Video Metabox */
$meta_boxes[] = array(
	'id'		=> 'rnr-blogmeta-video',
	'title'		=> 'Blog Video Settings',
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'		=> 'Video Type',
			'id'		=> $prefix . 'blog_video_type',
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> 'Youtube',
				'vimeo'			=> 'Vimeo',
				'own'			=> 'Own Embed Code'
			),
			'multiple'	=> false,
			'std'		=> array( 'no' )
		),
		array(
			'name'	=> 'Embed Code<br />(Audio Embed Code is possible, too)',
			'id'	=> $prefix . 'blog_video_embed',
			'desc'	=> 'Just paste the ID of the video (E.g. http://www.youtube.com/watch?v=<strong>GUEZCxBcM78</strong>) you want to show, or insert own Embed Code. <br />This will show the Video <strong>INSTEAD</strong> of the Image Slider.<br /><strong>Of course you can also insert your Audio Embedd Code!</strong><br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image..',
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "8"
		)
	)
);


/* ----------------------------------------------------- */
/* Portfolio Post Type Metaboxes
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'portfolio_info',
	'title' => 'Project Details',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',	

	'fields' => array(
		array(
			'name'		=> 'Client/Company Name',
			'id'		=> $prefix . 'project_client_name',
			'desc'		=> 'Leave empty if you do not want to show this.',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Project link',
			'id'		=> $prefix . 'project_link',
			'desc'		=> 'URL to the Project if available (Do not forget the http://)',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),	
		array(
			'name'		=> 'Show Project Details?',
			'id'		=> $prefix . "project_details",
			'type'		=> 'checkbox',
			'std'		=> true
		)
	)
);

/* ----------------------------------------------------- */
// Project Slides Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'project_slides',
	'title'		=> 'Project Image Slides',
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> 'Project Slider Images',
			'desc'	=> 'Upload up to 20 project images for a slideshow - or only one to display a single image. <br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.',
			'id'	=> $prefix . 'project_item_slides',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 30,
		)
		
	)
);
/* ----------------------------------------------------- */
// Project Video Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'project_video',
	'title'		=> 'Project Video',
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'		=> 'Video Type',
			'id'		=> $prefix . 'project_video_type',
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> 'Youtube',
				'vimeo'			=> 'Vimeo',
			),
			'multiple'	=> false,
			'std'		=> array( 'no' )
		),
		array(
			'name'	=> 'Video ID or own Embedd Code<br />(Audio Embedd Code is possible, too)',
			'id'	=> $prefix . 'project_video_embed',
			'desc'	=> 'Just paste the ID of the video (E.g. http://www.youtube.com/watch?v=<strong>GUEZCxBcM78</strong>) you want to show, or insert own Embed Code. <br />This will show the Video <strong>INSTEAD</strong> of the Image Slider.<br /><strong>Of course you can also insert your Audio Embedd Code!</strong><br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image..',
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "8"
		)
	)
);


/*  Blog Audio Post Settings */

$meta_boxes[] = array(
	'id' => 'project_audio',
	'title' => 'Audio Settings',
	'pages' => array( 'portfolio'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(	
		array(
			'name'		=> 'Audio Embed Code',
			'id'		=> $prefix . 'projectaudiourl',
			'desc'		=> 'Enter your Audio URL(Oembed) or Embed Code.',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),
	)
);



/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function rocknrolla_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}

// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'rocknrolla_register_meta_boxes' );