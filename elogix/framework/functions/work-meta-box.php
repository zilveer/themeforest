<?php
/********************* META BOX DEFINITIONS ***********************/

// Better has an underscore as last sign
$prefix = 'minti_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	'id' => 'styling',
	'title' => 'Styling Options',
	'pages' => array( 'post', 'page', 'work' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		// Subtitle
		array(
			'name'		=> 'Subtitle',
			'id'		=> $prefix . 'subtitle',
			'desc'		=> 'The Subtitle that appears next to the Page-Name',
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'	=> 'Background Image',
			'id'	=> "{$prefix}bgimage",
			'desc'		=> 'Only the first uploaded image will be taken as background-image',
			'type'	=> 'image'
		),
		array(
			'name'		=> 'Background Repeat',
			'id'		=> "{$prefix}bgrepeat",
			'type'		=> 'select',
			'options'	=> array(
				'stretch'		=> 'stretch',
				'repeat'		=> 'repeat',
				'no-repeat'		=> 'no-repeat',
				'repeat-x'		=> 'repeat-x',
				'repeat-y'		=> 'repeat-y'
			),
			'multiple'	=> false,
			'std'		=> array( 'stretch' )
		),
		array(
			'name'		=> 'Background Position',
			'id'		=> "{$prefix}bgposition",
			'desc'		=> 'Choose background position (only if background gets repeated not stretched.)',
			'type'		=> 'select',
			'options'	=> array(
				'top left'		=> 'top left',
				'top center'		=> 'top center',
				'top right'		=> 'top right',
				'center center'			=> 'center center',
				'bottom left'			=> 'bottom left',
				'bottom center'		=> 'bottom center',
				'bottom right'		=> 'bottom right'
			),
			'multiple'	=> false,
			'std'		=> array( 'top left' )
		)
	)
);

// 2nd meta box
$meta_boxes[] = array(
	'id'		=> 'portfolio_info',
	'title'		=> 'Portfolio Information',
	'pages'		=> array( 'work' ),

	'fields'	=> array(
		// WYSIWYG/RICH TEXT EDITOR
		array(
			'name'	=> 'Short Project Description',
			'id'	=> "{$prefix}description",
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "3"
		),
		array(
			'name'	=> 'Project Link',
			'id'	=> "{$prefix}link",
			'type' 	=> 'text',
			'std' 	=> ""
		),
		array(
			'name'		=> 'Enable Lightbox',
			'id'		=> "{$prefix}lightbox",
			'type'		=> 'select',
			'options'	=> array(
				'no'		=> 'No',
				'yes'		=> 'Yes'
			),
			'multiple'	=> false,
			'std'		=> array( 'no' )
		)
	)
);

// 3nd meta box
$meta_boxes[] = array(
	'id'		=> 'portfolio_slides',
	'title'		=> 'Portfolio Slides',
	'pages'		=> array( 'work' ),

	'fields'	=> array(
		array(
			'name'	=> 'Portfolio Slider Images',
			'desc'	=> 'Upload as many portfolio items as you like for a Slideshow - or only one to display a single image.',
			'id'	=> "{$prefix}screenshot",
			'type'	=> 'image'
		)
	)
);


// 3nd meta box
$meta_boxes[] = array(
	'id'		=> 'portfolio_video',
	'title'		=> 'Portfolio Video',
	'pages'		=> array( 'work' ),

	'fields'	=> array(
		array(
			'name'		=> 'Video Source',
			'id'		=> "{$prefix}source",
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> 'Youtube',
				'vimeo'			=> 'Vimeo',
				'own'			=> 'Own Embedd Code'
			),
			'multiple'	=> false,
			'std'		=> array( 'no' )
		),
		array(
			'name'	=> 'Video URL or own Embedd Code',
			'id'	=> "{$prefix}embed",
			'desc'	=> 'Just paste the ID of the video you want to show, or insert own Embedd Code. <br />This will show the Video INSTEAD of the Image Slider.<br />E.g. http://www.youtube.com/watch?v=<strong>GUEZCxBcM78</strong> Make Sure the width is about 610px',
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "8"
		)
	)
);

/*
// 3rd meta box
$meta_boxes[] = array(
	'id'		=> 'survey',
	'title'		=> 'Survey',
	'pages'		=> array( 'post', 'work', 'page' ),

	'fields'	=> array(
		// COLOR
		array(
			'name'		=> 'Your favorite color',
			'id'		=> "{$prefix}color",
			'type'		=> 'color'
		),
		// CHECKBOX LIST
		array(
			'name'		=> 'Your hobby',
			'id'		=> "{$prefix}hobby",
			'type'		=> 'checkbox_list',
			// Options of checkboxes, in format 'key' => 'value'
			'options'	=> array(
				'reading'	=> 'Books',
				'sport'		=> 'Gym, Boxing'
			),
			'desc'		=> 'What do you do in free time?'
		),
		// TIME
		array(
			'name'		=> 'When do you get up?',
			'id'		=> "{$prefix}getdown",
			'type'		=> 'time',
			// Time format, default hh:mm. Optional. @link See: http://goo.gl/hXHWz
			'format'	=> 'hh:mm:ss'
		),
		// DATETIME
		array(
			'name'		=> 'When were you born?',
			'id'		=> "{$prefix}born_time",
			'type'		=> 'datetime',
			// Time format, default hh:mm. Optional. @link See: http://goo.gl/hXHWz
			'format'	=> 'hh:mm:ss'
		)
	)
);

*/

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes()
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
// Hook to 'admin_init' to make sure the meta box class is loaded
//  before (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );