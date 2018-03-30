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
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'jellywp_';

global $meta_boxes;

$meta_boxes = array();

// post metabox
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'standard',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => esc_attr__( 'Review and Post option', 'nanomag' ),

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'post' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// Auto save: true, false (default). Optional.
	'autosave' => true,

	
	
	
	// HTML5 Audio 
	'fields' => array(

			array(
			'name' => esc_attr__( 'Audio MP3 URL', 'nanomag' ),
			'id' => "html5_audio_mp3_{$prefix}text",
			'desc' => esc_attr__( '', 'nanomag' ),
			'type' => 'text',
			'std' => esc_attr__( '', 'nanomag' )
		),
		
// Embed Audio
			array(
				'name' => esc_attr__( 'Embed Audio', 'nanomag' ),
				'desc' => esc_attr__( '', 'nanomag' ),
				'id'   => "embed_audio_{$prefix}textarea",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 5,
			),

	// Embed Video
			array(
				'name' => esc_attr__( 'Embed Video', 'nanomag' ),
				'desc' => esc_attr__( '', 'nanomag' ),
				'id'   => "embed_video_{$prefix}textarea",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 5,
			),
			
			// Quote
			array(
				'name' => esc_attr__( 'Quote', 'nanomag' ),
				'desc' => esc_attr__( '', 'nanomag' ),
				'id'   => "quote_{$prefix}textarea",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 5,
			),
			
			
			// IMAGE ADVANCED (WP 3.5+)
			array(
				'name'             => esc_attr__( 'Gallery Image', 'nanomag' ),
				'id'               => "image_upload_slider_{$prefix}imgadv",
				'type'             => 'image_advanced',
				'max_file_uploads' => 10,
			),
			
		
		array(
			'name' => '',
			'id'   => "devide{$prefix}checkbox",
			'type' => 'divider',
			// Value can be 0 or 1
			//'std'  => 0,
		),
	
	array(
			'name' => 'Enable full width post',
			'id'   => "full_width{$prefix}checkbox",
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),
		
		// WYSIWYG/RICH TEXT EDITOR

	array(
				'name' => esc_attr__( 'Review Description', 'nanomag' ),
				'desc' => esc_attr__( '', 'nanomag' ),
				'id'   => "review_{$prefix}wysiwyg",
				'type' => 'textarea',
				'cols' => 20,
				'rows' => 5,
			),

		// review 1
		array(
			'name' => esc_attr__( 'Review Title 1', 'nanomag' ),
			'id' => "review_option1{$prefix}text",
			'desc' => esc_attr__( '', 'nanomag' ),
			'type' => 'text',
			'std' => esc_attr__( ' ', 'nanomag' )
		),
		array(
			'name' => esc_attr__( 'Review Score 1', 'nanomag' ),
			'id'   => "review_option1{$prefix}slider",
			'type' => 'slider',

			// Text labels displayed before and after
			'prefix' => esc_attr__( '', 'nanomag' ),
			'suffix' => esc_attr__( '', 'nanomag' ),

			// jQuery UI slider options. See here http://api.jqueryui.com/slider/
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 1,
			),
		),
		
		//review 2
		array(
			'name' => esc_attr__( 'Review Title 2', 'nanomag' ),
			'id' => "review_option2{$prefix}text",
			'desc' => esc_attr__( '', 'nanomag' ),
			'type' => 'text',
			'std' => esc_attr__( ' ', 'nanomag' )
		),
		
		array(
			'name' => esc_attr__( 'Review Score 2', 'nanomag' ),
			'id'   => "review_option2{$prefix}slider",
			'type' => 'slider',

			// Text labels displayed before and after
			'prefix' => esc_attr__( '', 'nanomag' ),
			'suffix' => esc_attr__( '', 'nanomag' ),

			// jQuery UI slider options. See here http://api.jqueryui.com/slider/
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 1,
			),
		),
		
		//review 3
		array(
			'name' => esc_attr__( 'Review Title 3', 'nanomag' ),
			'id' => "review_option3{$prefix}text",
			'desc' => esc_attr__( '', 'nanomag' ),
			'type' => 'text',
			'std' => esc_attr__( ' ', 'nanomag' )
		),
		
		array(
			'name' => esc_attr__( 'Review Score 3', 'nanomag' ),
			'id'   => "review_option3{$prefix}slider",
			'type' => 'slider',

			// Text labels displayed before and after
			'prefix' => esc_attr__( '', 'nanomag' ),
			'suffix' => esc_attr__( '', 'nanomag' ),

			// jQuery UI slider options. See here http://api.jqueryui.com/slider/
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 1,
			),
		),
		
		//review 4
		
			array(
			'name' => esc_attr__( 'Review Title 4', 'nanomag' ),
			'id' => "review_option4{$prefix}text",
			'desc' => esc_attr__( '', 'nanomag' ),
			'type' => 'text',
			'std' => esc_attr__( ' ', 'nanomag' )
		),
		
		array(
			'name' => esc_attr__( 'Review Score 4', 'nanomag' ),
			'id'   => "review_option4{$prefix}slider",
			'type' => 'slider',

			// Text labels displayed before and after
			'prefix' => esc_attr__( '', 'nanomag' ),
			'suffix' => esc_attr__( '', 'nanomag' ),

			// jQuery UI slider options. See here http://api.jqueryui.com/slider/
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 1,
			),
		),
		
		//review 5
		array(
			'name' => esc_attr__( 'Review Title 5', 'nanomag' ),
			'id' => "review_option5{$prefix}text",
			'desc' => esc_attr__( '', 'nanomag' ),
			'type' => 'text',
			'std' => esc_attr__( ' ', 'nanomag' )
		),
		
		array(
			'name' => __( 'Review Score 5', 'nanomag' ),
			'id'   => "review_option5{$prefix}slider",
			'type' => 'slider',

			// Text labels displayed before and after
			'prefix' => esc_attr__( '', 'nanomag' ),
			'suffix' => esc_attr__( '', 'nanomag' ),

			// jQuery UI slider options. See here http://api.jqueryui.com/slider/
			'js_options' => array(
				'min'   => 0,
				'max'   => 10,
				'step'  => 1,
			),
		),
			

	)
);

// end post metabox

// page metabox
$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'standard',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => esc_attr__( 'Slider Type', 'nanomag' ),

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'page' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// Auto save: true, false (default). Optional.
	'autosave' => true,
	
	// List of meta fields
	'fields' => array(
	

	// SELECT BOX SLIDER
			array(
				'name'     => esc_attr__( 'Slider Type (Home page)', 'nanomag' ),
				'id'       => "{$prefix}slider_type",
				'type'     => 'radio',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => array(
					'slider1' => esc_attr__( 'Slider with right list', 'nanomag' ),
					'slider_grid' => esc_attr__( 'Grid post header', 'nanomag' ),
					'slider2' => esc_attr__( 'Large slider caption bottom', 'nanomag' ),
					'slider_personal' => esc_attr__( 'Large slider caption center', 'nanomag' ),
					'slider_full_width' => esc_attr__( 'Slider full screen', 'nanomag' ),
					'noslider' => esc_attr__( 'No slider', 'nanomag' ),
				),
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
				'std'         => 'slider1',				
			),
	)
);

//end page metabox

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function jellywp_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'jellywp_register_meta_boxes' );
