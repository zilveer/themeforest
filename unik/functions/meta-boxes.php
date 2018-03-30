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
$prefix = THEMENAME.'_';

global $wp_registered_sidebars;  

$sidebars = array();

foreach($wp_registered_sidebars as $sidebar_id => $sidebar){
	$sidebars[] = $sidebar['name'];
}


$products ='';

//Access the WordPress Pages via an Array
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	$args = array(
	'post_type'        => 'product',
	'post_status'      => 'publish',
	'suppress_filters' => true );
	
		$products 	= array();
		$products[0] = "Select a product to link";
		$of_pages_obj 	= get_posts( $args );    
		foreach ($of_pages_obj as $of_product) {
		    $products[$of_product->ID] = $of_product->post_title; }
}			
			
/* Common options
-----------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'common_options',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Common Options',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('page', 'post', 'event'),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',


	// List of meta fields
	'fields' => array(
		// Caoursel images
		array(
			'name'  => __('Carousel Images',THEMENAME),
			'id'    => "{$prefix}post_carousel",
			'type'  => 'image_advanced',
		),
		
		// Hide breadcrumb
		array(
			'name' => __('Hide Breadcrumb',THEMENAME),
			'id'   => "{$prefix}hide_breadcrumb",
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),	
			
				
		
	),
);

/* meta box for page options
-----------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'page_options',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Page Options',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('page'),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',


	// List of meta fields
	'fields' => array(
		
		// page title
		array(
			'name'  => __('Custom Page Title',THEMENAME),
			'id'    => "{$prefix}custom_title",
			'type'  => 'text',
			'desc'  => __('Keep blank if you do not want to modify page title',THEMENAME),
		),
		
		// page title
		array(
			'name'  => __('Secondary Title',THEMENAME),
			'id'    => "{$prefix}secondary_title",
			'type'  => 'text',
			'desc'  => __('Enter secondary title if you want',THEMENAME),
		),
		
		// Hide page title
		array(
			'name' => __('Hide Page Title',THEMENAME),
			'id'   => "{$prefix}hide_title",
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),
		
		// Disable page background, use background block instead
		array(
			'name' => __('Disable page background',THEMENAME),
			'id'   => "{$prefix}disable_page_bg",
			'type' => 'checkbox',
			'desc' => 'Disable page background color, use block_bg shortcode instead',
			// Value can be 0 or 1
			'std'  => 0,
		),
		
		
		// page layout
		array(
			'name'    => __('Select Page layout',THEMENAME),
			'id'      => "{$prefix}page_layout",
			'type'    => 'radio',
			'options' => array(
				'nosidebar' => 'no sidebar &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ',
				'left' => 'Sidebar on left &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;',
				'right' => 'Sidebar on right ',
			),
			'std'  => 'nosidebar',
		),

		// Slider shortcode
		array(
			'name' => __('Enter Any Slider Shortcode',THEMENAME),
			'id'   => "{$prefix}slider_shortcode",
			'type' => 'text',
			// Value can be 0 or 1
			'desc'  => __('It will appear just below header section',THEMENAME),
		),
	
		// background image upload
		array(
			'name'    => __('Background Image',THEMENAME),
			'id'      => "{$prefix}page_bg",
			'type'    => 'image_advanced',
			'desc'	  => __('Upload background image',THEMENAME),
			'max_file_uploads' => 1,
		),	
		
		array(
			'name'    => __('Page css',THEMENAME),
			'id'      => "{$prefix}page_css",
			'type'    => 'textarea',
			'desc'	  => __('css for this page only',THEMENAME),
		),	

		
	),
);




/* meta box for post options
-----------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'post_options',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Posts options',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('post'),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',


	// List of meta fields
	'fields' => array(
		

		//Featured audio file
		array(
			'name' => __( 'Upload Audio', THEMENAME ),
			'id'   => "{$prefix}featured_audio",
			'type' => 'file_advanced',
			'max_file_uploads' => 1,
			'mime_type' => 'audio', // Leave blank for all file types
		),
		
		//Featured audio url
		array(
			'name' => __( 'External Audio URL', THEMENAME ),
			'id'   => "{$prefix}featured_audio_url",
			'type' => 'text',
			'desc' => '',
		),
		
		//Featured audio url Title
		array(
			'name' => __( 'Audio Title', THEMENAME ),
			'id'   => "{$prefix}featured_audio_url_title",
			'type' => 'text',
			'desc' => '',
		),		
		array(
			'name' => __( 'Artist Name', THEMENAME ),
			'id'   => "{$prefix}featured_audio_artist",
			'type' => 'text',
			'desc' => '',
		),	
		array(
			'name' => __( 'Poster/Cover Image', THEMENAME ),
			'id'   => "{$prefix}featured_audio_poster",
			'type' => 'image_advanced',
			'desc' => '',
		),					
	),		
);




/* meta box for product
-----------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'product_options',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Product options',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('product'),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',


	// List of meta fields
	'fields' => array(
		

		array(
			'name' => __( 'Preview Audio File URL', THEMENAME ),
			'id'   => "{$prefix}preview_audio_url",
			'type' => 'text',
		),
		array(
			'name' => __( 'Preview Audio Title', THEMENAME ),
			'id'   => "{$prefix}preview_audio_title",
			'type' => 'text',
		),
		array(
			'name' => __( 'Preview Audio Artist', THEMENAME ),
			'id'   => "{$prefix}preview_audio_artist",
			'type' => 'text',
		),
		array(
			'name' => __( 'Upload Preview Audio Thumbnail', THEMENAME ),
			'id'   => "{$prefix}preview_audio_thumb",
			'type' => 'file_advanced',
			'max_file_uploads' => 1,
			'mime_type' => 'image', 
		),
		
						
	),		
);


/* meta box for post options
-----------------------------------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'event_options',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Event options',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('event'),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',


	// List of meta fields
	'fields' => array(
		// place
		array(
			'name'  => __('Event Place',THEMENAME),
			'id'    => "{$prefix}event_place",
			'type'  => 'text',
			'desc'  => 'Place of event',
		),
		// date
		array(
			'name'  => __('Event Date',THEMENAME),
			'id'    => "{$prefix}event_date",
			'type'  => 'date',
			'desc'  => 'Date of event. Y-M-D',
		),	
		array(
				'name'     => __( 'Link product', 'rwmb' ),
				'id'       => "{$prefix}linked_product",
				'type'     => 'select',
				// Array of 'value' => 'Label' pairs for select box
				'options'  => $products,
				// Select multiple values, optional. Default is false.
				'multiple'    => false,
			),	
		array(
			'name'  => __('Product link text',THEMENAME),
			'id'    => "{$prefix}product_link_text",
			'type'  => 'text',
			'desc'  => 'Enter your link text, such as buy ticket. Applicable only if a product page is chosen in the above option',
		),			
	),
		
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function register_meta_boxes()
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
add_action( 'admin_init', 'register_meta_boxes' );
