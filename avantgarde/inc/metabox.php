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

	
add_filter( 'rwmb_meta_boxes', 'Theme2035_register_meta_boxes' );

function Theme2035_register_meta_boxes( $meta_boxes )
{






$prefix = 'theme2035_';
global $theme_prefix;
global $meta_boxes;

$sidebars = $GLOBALS['wp_registered_sidebars'];
foreach ( $sidebars as $sidebar ) { 
   $sidebar_options[$sidebar['id']] = $sidebar['name'];
}

$meta_boxes = array();


/*-----------------------------------------------------------------------------------*/
/*  Sidebar Position For Post and Page
/*-----------------------------------------------------------------------------------*/

if(empty($theme_prefix['blog_sidebar'])) { $theme_prefix['blog_sidebar'] = "main-sidebar"; }
$blog_post_sidebar = $theme_prefix['blog_sidebar'];
$meta_boxes[] = array(
	'id' => 'sidebar',
	'title' => __( 'Sidebar', 'theme2035' ),
	'pages' => array( 'post', 'page' ),
	'context' => 'side',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'     => __( 'Select Sidebar(Default sidebar selected. You can change it from theme options.)', 'theme2035' ),
			'id'       => "{$prefix}selectpostsidebar",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => $sidebar_options,
			// Select multiple values, optional. Default is false.
			'multiple'    => false,
			'std'         => $blog_post_sidebar,
			'placeholder' => __( 'Select Sidebar', 'theme2035' ),
		),
));


/*-----------------------------------------------------------------------------------*/
/*  Special Post for Post Slider
/*-----------------------------------------------------------------------------------*/


$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	'id' => 'editor-pick',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => __( 'Special Post', 'meta-box' ),

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array('post'),
	'context' => 'side',
	'priority' => 'high',


	// List of meta fields
	'fields' => array(
		array(
			'name'     => __( '<p>Is that Post add in Special Post?</p>', 'meta-box' ),
			'id'       => $prefix."editor_pick",
			'type'     => 'select',
			'options'  => array(
				'Yes' => __( 'Yes, Please!', 'meta-box' ),
				'No' => __( 'No', 'meta-box' ),
			),
			'multiple'    => false,
			'std'         => "No",
		),								
	),
);


/*-----------------------------------------------------------------------------------*/
/*  Photo Credits For Post Feature Image
/*-----------------------------------------------------------------------------------*/

// Photo Credits
$meta_boxes[] = array(
	'id'		=> 'theme2035-photo-credits',
	'title'		=> __('Photo/Video Credits',"theme2035"),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> __('Photo/Video Credits',"theme2035"),
			'id'	=> $prefix . 'photo_credits',
			'desc'	=> __('Write Photo/Video Credits',"theme2035"),
			'type' 	=> 'text',
			'std' 	=> "",
			'cols' 	=> "38",
			'rows' 	=> "10"
		)
	)
);


/*-----------------------------------------------------------------------------------*/
/*  Gallery Post Format
/*-----------------------------------------------------------------------------------*/

$meta_boxes[] = array(
	'id'		=> 'theme2035-blogmeta-gallery',
	'title'		=> __('Blog Post Image Slides',"theme2035"),
	'pages'		=> array( 'post', ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> __('Portfolio Gallery','2035Themes-fm'),
			'desc'	=> __('Max Photo Limit is <b>25</b>','2035Themes-fm'),
			'id'	=> $prefix . 'galleryslides',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 25,
		)
		
	)
);


/*-----------------------------------------------------------------------------------*/
/*  Audio Post Format
/*-----------------------------------------------------------------------------------*/

$meta_boxes[] = array(
	'id' => 'theme2035-blogmeta-audio',
	'title' => __('Audio Settings',"theme2035"),
	'pages' => array( 'post'),
	'context' => 'normal',


	'fields' => array(	
		array(
			'name'		=> __('Audio Code',"theme2035"),
			'id'		=> $prefix . 'audio',
			'desc'		=> __('Enter your Audio URL(Oembed) or Embed Code.',"theme2035"),
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),
		
	)
);


/*-----------------------------------------------------------------------------------*/
/*  Link Post Format
/*-----------------------------------------------------------------------------------*/

$meta_boxes[] = array(
	'id' => 'theme2035-blogmeta-link',
	'title' => __('Link Settings',"theme2035"),
	'pages' => array( 'post'),
	'context' => 'normal',


	'fields' => array(	
		array(
			'name'		=> __('Link Post Type',"theme2035"),
			'id'		=> $prefix . 'link',
			'desc'		=> __('Please Write Url (Example : http://google.com)',"theme2035"),
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		
	)
);


/*-----------------------------------------------------------------------------------*/
/*  Quote Post Format
/*-----------------------------------------------------------------------------------*/

$meta_boxes[] = array(
	'id' => 'theme2035-blogmeta-quote',
	'title' => __('Quote Settings',"theme2035"),
	'pages' => array( 'post'),
	'context' => 'normal',


	'fields' => array(	
		array(
			'name'		=> __('Quote Text',"theme2035"),
			'id'		=> $prefix . 'quote',
			'desc'		=> __('Enter your Quote Text',"theme2035"),
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),
		
	)
);


/*-----------------------------------------------------------------------------------*/
/*  Video Post Format
/*-----------------------------------------------------------------------------------*/

$meta_boxes[] = array(
	'id'		=> 'theme2035-blogmeta-video',
	'title'		=> __('Blog Video Settings',"theme2035"),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> __('Embed Code',"theme2035"),
			'id'	=> $prefix . 'video_embed',
			'desc'	=> __('Insert paste embed code',"theme2035"),
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "38",
			'rows' 	=> "10"
		)
	)
);



	return $meta_boxes;
}