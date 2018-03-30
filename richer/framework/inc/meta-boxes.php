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
$prefix = 'richer_';

global $meta_boxes;

$meta_boxes = array();

global $options_data;

/* ----------------------------------------------------- */
$revolutionslider = array();
$revolutionslider[0] = __('No Slider','richer-framework');
$revAliases = '';
if(class_exists('RevSlider')){
    $slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	foreach($arrSliders as $revSlider) { 
		$revAliases .= $revSlider->getAlias().', ';
		$revolutionslider[$revSlider->getAlias()] = $revSlider->getTitle();
	}
}

$types = get_terms('portfolio_filter', 'hide_empty=0');
$types_array[0] = __('All categories','richer-framework');
if(isset($types)) {
	foreach($types as $type) {
		$types_array[$type->term_id] = $type->name;
	}
}


// Image settings
$titlebar_ver = array(
	'titlebar'		=> __('Simple titlebar','richer-framework'),
	'featuredimage'	=> __('Fancy titlebar','richer-framework'),
	'notitlebar'	=> __('No titlebar','richer-framework'),
);

$repeat_options = array(
	'repeat'	=> __('repeat', 'richer-framework'),
	'repeat-x'	=> __('repeat-x', 'richer-framework'),
	'repeat-y'	=> __('repeat-y', 'richer-framework'),
	'no-repeat'	=> __('no-repeat', 'richer-framework'),
);

$position_x_options = array(
	'center'	=> __('center', 'richer-framework'),
	'left'		=> __('left', 'richer-framework'),
	'right'		=> __('right', 'richer-framework'),
);

$position_y_options = array(
	'center'	=> __('center', 'richer-framework'),
	'top'		=> __('top', 'richer-framework'),
	'bottom'	=> __('bottom', 'richer-framework'),
);

/* ----------------------------------------------------- */
// Page Settings
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id' => 'titlebarsettings',
	'title' => __('Titlebar Settings','richer-framework'),
	'pages' => array( 'page','post','portfolio', 'product'),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
				'name'		=> __('Title Bar','richer-framework'),
				'id'		=> $prefix . "titlebar",
				'type'		=> 'select',
				'options'	=> $titlebar_ver,
				'multiple'	=> false,
				'std'		=> array( 'titlebar' )
		)
	)
);
$meta_boxes[] = array(
	'id'		=> 'fancy_titlebar_options',
	'title' 	=> __('Fancy TitleBar Options', 'richer-framework'),
	'pages' 	=> array( 'page', 'portfolio', 'post', 'product'),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(

		// Title alignment
		array(
			'name'    	=> __('Titlebar alignment:', 'richer-framework'),
			'id'      	=> "{$prefix}title_aligment",
			'type'    	=> 'radio',
			'std'		=> 'left',
			'options'	=> array(
				'left'		=> __('Title left', 'richer-framework'),
				'left_crumbs'		=> __('Title&Breadcrumbs left', 'richer-framework'),
				'center'	=> __('Centered', 'richer-framework'),
				'right'		=> __('Title right', 'richer-framework'),
				'right_crumbs'		=> __('Title&Breadcrumbs right', 'richer-framework'),
			),
		),

		// Title
		array(
			'name'    	=> __('Title:', 'richer-framework'),
			'id'      	=> "{$prefix}title",
			'type'    	=> 'text',
			'std'		=> ''
		),

		// Title color
		array(
			'name'    		=> __('Title color:', 'richer-framework'),
			'id'      		=> "{$prefix}title_color",
			'type'    		=> 'color',
			'std'			=> '#ffffff',
		),

		// Title background color
		array(
			'name'    		=> __('Title background color:', 'richer-framework'),
			'id'      		=> "{$prefix}title_bg_color",
			'type'    		=> 'color',
			'std'			=> '',
		),
		// Subtitle
		array(
			'name'    	=> __('Subtitle:', 'richer-framework'),
			'id'      	=> "{$prefix}subtitle",
			'type'    	=> 'text',
			'std'		=> '',
		),

		// Subtitle color
		array(
			'name'    		=> __('Subtitle/breadcrumbs color:', 'richer-framework'),
			'id'      		=> "{$prefix}subtitle_color",
			'type'    		=> 'color',
			'std'			=> '#ffffff',
		),
		// Sub-Title background color
		array(
			'name'    		=> __('Subtitle/breadcrumbs background color:', 'richer-framework'),
			'id'      		=> "{$prefix}subtitle_bg_color",
			'type'    		=> 'color',
			'std'			=> '',
		),
		// Background color
		array(
			'name'    		=> __('Background color:', 'richer-framework'),
			'id'      		=> "{$prefix}bg_color",
			'type'    		=> 'color',
			'std'			=> '#43b4f9'
		),

		// Background opacity
		array(
			'name'    		=> __('Background overlay opacity:', 'richer-framework'),
			'id'      		=> "{$prefix}bg_opacity",
			'type'    		=> 'text',
			'std'			=> '0.8'
		),
		// Background image
		array(
			'name'             	=> __('Background image:', 'richer-framework'),
			'id'               	=> "{$prefix}bg_image",
			'type'             	=> 'image_advanced',
			'max_file_uploads'	=> 1,
		),

		// Repeat options
		array(
			'name'     	=> __('Repeat options:', 'richer-framework'),
			'id'       	=> "{$prefix}bg_repeat",
			'type'     	=> 'select',
			'options'  	=> $repeat_options,
			'std'		=> 'no-repeat'
		),

		// Position x
		array(
			'name'     	=> __('Position x:', 'richer-framework'),
			'id'       	=> "{$prefix}bg_position_x",
			'type'     	=> 'select',
			'options'  	=> $position_x_options,
			'std'		=> 'center'
		),

		// Position y
		array(
			'name'     	=> __('Position y:', 'richer-framework'),
			'id'       	=> "{$prefix}bg_position_y",
			'type'     	=> 'select',
			'options'  	=> $position_y_options,
			'std'		=> 'center'
		),

		// Fullscreen
		array(
			'name'    		=> __('Fullscreen:', 'richer-framework'),
			'id'      		=> "{$prefix}bg_fullscreen",
			'type'    		=> 'checkbox',
			'std'			=> 1,
		),

		// Fixed background
		array(
			'name'    		=> __('Fixed background:', 'richer-framework'),
			'id'      		=> "{$prefix}bg_fixed_titlebar",
			'type'    		=> 'checkbox',
			'std'			=> 0
		),

		// Border color
		array(
			'name'    		=> __('Border color:', 'richer-framework'),
			'id'      		=> "{$prefix}border_color",
			'type'    		=> 'color',
			'std'			=> '#d8d8d8'
		),
		// titlebar padding outter
		array(
			'name'    		=> __('Outer padding:', 'richer-framework'),
			'desc'			=> __('You need to input padding parameter, this value used for both parameters top and bottom. To use different values divide values by vertical slash (|).','richer-framework'),
			'id'      		=> "{$prefix}titlebar_outer_padding",
			'type'    		=> 'text',
			'std'			=> ''
		),
		// titlebar padding inner
		array(
			'name'    		=> __('Inner padding:', 'richer-framework'),
			'desc'			=> __('You need to input padding parameter, this value used for both parameters top and bottom. To use different values divide values by vertical slash (|).','richer-framework'),
			'id'      		=> "{$prefix}titlebar_inner_padding",
			'type'    		=> 'text',
			'std'			=> ''
		),
		// Fullscreen
		array(
			'name'    		=> __('Show breadcrumbs?', 'richer-framework'),
			'id'      		=> "{$prefix}crumbs_check",
			'type'    		=> 'checkbox',
			'std'			=> 1
		)
	)
);
$meta_boxes[] = array(
	'id' => 'portfoliosettings',
	'title' => __('Portfolio Settings','richer-framework'),
	'pages' => array( 'page'),
	'context' => 'side',
	'priority' => 'core',

	// List of meta fields
	'fields' => array(
		array(
			'name' => __('Select Portfolio Filters','richer-framework'),
			'id' => $prefix . "portfoliofilter",
			'type' => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options' => $types_array,
			// Select multiple values, optional. Default is false.
			'multiple' => true,
			'desc' => __('Optional: Choose what portfolio category you want to display on this page (If Portfolio Template chosen).','richer-framework')
		),
		array(
			'name'		=> __('Show portfolio filters?','richer-framework'),
			'id'		=> $prefix . "show-portfolio-filter",
			'type'		=> 'checkbox',
			'std'		=> 1
		)
	)
);

$meta_boxes[] = array(
	'id' => 'slidersettings',
	'title' => __('Slider Settings','richer-framework'),
	'pages' => array( 'page','post','portfolio'),
	'context' => 'side',
	'priority' => 'low',

	// List of meta fields
	'fields' => array(
		array(
			'name'		=> __('Slider','richer-framework'),
			'id'		=> $prefix . "revolutionslider",
			'type'		=> 'select',
			'options'	=> $revolutionslider,
			'multiple'	=> false
		)
	)
);
/* ----------------------------------------------------- */
// Background Styling
/* ----------------------------------------------------- */
if(!isset($options_data['select_layoutstyle'])) $options_data['select_layoutstyle'] = 'wide';
if($options_data['select_layoutstyle'] == 'boxed' || $options_data['select_layoutstyle'] == 'framed' || $options_data['select_layoutstyle'] == 'rounded') {

	$meta_boxes[] = array(
		'id' => 'styling',
		'title' => __('Background Styling Options','richer-framework'),
		'pages' => array( 'post', 'page', 'portfolio' ),
		'context' => 'side',
		'priority' => 'low',
	
		// List of meta fields
		'fields' => array(
			array(
				'name'		=> __('Background Image URL','richer-framework'),
				'id'		=> $prefix . 'bgurl',
				'desc'		=> '',
				'type' => 'image_advanced',
				'max_file_uploads' => 1
			),
			array(
				'name'		=> __('Style','richer-framework'),
				'id'		=> $prefix . "bgstyle",
				'type'		=> 'select',
				'options'	=> array(
					'stretch'		=> __('Stretch Image','richer-framework'),
					'repeat'		=> __('Repeat','richer-framework'),
					'no-repeat'		=> __('No-Repeat','richer-framework'),
					'repeat-x'		=> __('Repeat-X','richer-framework'),
					'repeat-y'		=> __('Repeat-Y','richer-framework')
				),
				'multiple'	=> false,
				'std'		=> array( 'stretch' )
			),
			array(
				'name'		=> __('Background Color','richer-framework'),
				'id'		=> $prefix . "bgcolor",
				'type'		=> 'color'
			),
			// Position x
			array(
				'name'     	=> __('Position x:', 'richer-framework'),
				'id'       	=> "{$prefix}bg_position_x",
				'type'     	=> 'select',
				'options'  	=> $position_x_options,
				'std'		=> 'center'
			),

			// Position y
			array(
				'name'     	=> __('Position y:', 'richer-framework'),
				'id'       	=> "{$prefix}bg_position_y",
				'type'     	=> 'select',
				'options'  	=> $position_y_options,
				'std'		=> 'center'
			),
			// Fixed background
			array(
				'name'    		=> __('Fixed background:', 'richer-framework'),
				'id'      		=> "{$prefix}bg_fixed",
				'desc'  		=> __('Check to fixed your background image','richer-framework'),
				'type'    		=> 'checkbox',
				'std'			=> 1
			),
		)
	);

}

/* ----------------------------------------------------- */
// Project Info Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'portfolio_info',
	'title' => __('Project Information','richer-framework'),
	'pages' => array( 'portfolio' ),
	'context' => 'normal',
	
	

	'fields' => array(
		array(
			'name'		=> __('Client','richer-framework'),
			'id'		=> $prefix . 'portfolio-client',
			'desc'		=> __('Leave empty if you do not want to show this.','richer-framework'),
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> 'Themeforest'
		),
		array(
			'name'		=> __('Detail Layout','richer-framework'),
			'id'		=> $prefix . 'portfolio-detaillayout',
			'desc'		=> __('Choose Layout for Detailpage','richer-framework'),
			'type'		=> 'select',
			'options'	=> array(
				'wide'			=> __('Full Width','richer-framework'),
				'sidebyside'	=> __('Side by Side','richer-framework')
			),
			'multiple'	=> false,
			'std'		=> array( 'no' )
		),
		array(
			'name'		=> __('Show Project Details?','richer-framework'),
			'id'		=> $prefix . "portfolio-details",
			'type'		=> 'checkbox',
			'std'		=> true
		),
		array(
			'name'		=> __('Show Related Projects?','richer-framework'),
			'id'		=> $prefix . "portfolio-relatedposts",
			'type'		=> 'checkbox',
			'desc'		=> ""
		),
		array(
				'name'		=> __('Link to Lightbox','richer-framework'),
				'id'		=> $prefix . "portfolio-lightbox",
				'type'		=> 'select',
				'options'	=> array(
					'false'		=> __('false','richer-framework'),
					'true'		=> __('true','richer-framework')
				),
				'multiple'	=> false,
				'std'		=> array( 'false' ),
				'desc'		=> __('Open Image in a Lightbox (on Overview, Homepage & Related Posts)','richer-framework')
		)
	)
);
/* ----------------------------------------------------- */
// Project Description Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'portfolio_desc',
	'title'		=> __('Extra description','richer-framework'),
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',
	'fields'	=> array(
		array(
			'name' => __( 'Extra portfolio item description', 'richer-framework' ),
			'id'   => $prefix."wysiwyg",
			'type' => 'wysiwyg',
			// Set the 'raw' parameter to TRUE to prevent data being passed through wpautop() on save
			'raw'  => false,
			'std'  => '',
			// Editor settings, see wp_editor() function: look4wp.com/wp_editor
			'options' => array(
				'textarea_rows' => 10,
				'teeny'         => false,
				'tinymce'		=> true,
				'media_buttons' => true,
			),
		)
	)
);
/* ----------------------------------------------------- */
// Project Slides Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'portfolio_slides',
	'title'		=> __('Project Slides','richer-framework'),
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> __('Project Slider Images','richer-framework'),
			'desc'	=> __('Upload up to 20 project images for a slideshow - or only one to display a single image. <br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.','richer-framework'),
			'id'	=> $prefix . 'screenshot',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 20
		),
		array(
			'name'		=> __('Display items as Grid Folio Layout?','richer-framework'),
			'desc'		=> __('Your images will be shown as thumbnails with link to big image','richer-framework'),
			'id'		=> $prefix . "gridlayout",
			'type'		=> 'select',
			'options'	=> array(
				'false'		=> __('false','richer-framework'),
				'true'		=> __('true','richer-framework')
			)
		),
		array(
			'name'		=> __('Display thumbnails for slider?','richer-framework'),
			'desc'		=> __('Your images will be shown as thumbnails after big image','richer-framework'),
			'id'		=> $prefix . "slider_thumb",
			'type'		=> 'select',
			'options'	=> array(
				'false'		=> __('false','richer-framework'),
				'true'		=> __('true','richer-framework')
			)
		)

	)
);

/* ----------------------------------------------------- */
// Project Video Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'portfolio_video',
	'title'		=> __('Project Video','richer-framework'),
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',
	'fields'	=> array(
		array(
			'name'		=> __('Video Source','richer-framework'),
			'id'		=> $prefix . 'source',
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> __('Youtube','richer-framework'),
				'vimeo'			=> __('Vimeo','richer-framework'),
				'own'			=> __('Own Embed Code','richer-framework')
			),
			'multiple'	=> false,
			'std'		=> array( 'no' )
		),
		array(
			'name'	=> __('Video URL or own Embedd Code<br />(Audio Embedd Code is possible, too)','richer-framework'),
			'id'	=> $prefix . 'embed',
			'desc'	=> __('Just paste the ID of the video (E.g. http://www.youtube.com/watch?v=<strong>GUEZCxBcM78</strong>) you want to show, or insert own Embed Code. <br />This will show the Video <strong>INSTEAD</strong> of the Image Slider.<br /><strong>Of course you can also insert your Audio Embedd Code!</strong><br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image, but you can use your video on preview, you need not to use featured image in this case.','richer-framework'),
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "8"
		)
	)
);

/* ----------------------------------------------------- */

/* ----------------------------------------------------- */
// Post Slides Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'post_slides',
	'title'		=> __('Post Gallery','richer-framework'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(

		array(
			'name'	=> __('Post Slider Images','richer-framework'),
			'desc'	=> __('Upload up to 20 project images for a slideshow - or only one to display a single image. <br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.','richer-framework'),
			'id'	=> $prefix . 'screenshot',
			'type'	=> 'image_advanced',
			'max_file_uploads' => 20
		),
		array(
			'name'		=> __('Display items as Grid Folio Layout?','richer-framework'),
			'desc'		=> __('Your images will be shown one by one.','richer-framework'),
			'id'		=> $prefix . "gridlayout",
			'type'		=> 'select',
			'options'	=> array(
				'false'		=> __('false','richer-framework'),
				'true'		=> __('true','richer-framework')
			)
		)
	)
);

/* ----------------------------------------------------- */
// Post Video Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'post_video',
	'title'		=> __('Post Video','richer-framework'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'		=> __('Video Source','richer-framework'),
			'id'		=> $prefix . 'source',
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> __('Youtube','richer-framework'),
				'vimeo'			=> __('Vimeo','richer-framework'),
				'own'			=> __('Own Embed Code','richer-framework')
			),
			'multiple'	=> false,
			'std'		=> array( 'no' )
		),
		array(
			'name'	=> __('Video URL or own Embedd Code','richer-framework'),
			'id'	=> $prefix . 'embed',
			'desc'	=> __('Just paste the ID of the video (E.g. http://www.youtube.com/watch?v=<strong>GUEZCxBcM78</strong>) you want to show, or insert own Embed Code. <br />This will show the Video <strong>INSTEAD</strong> of the Image Slider.<br /><strong>Of course you can also insert your Audio Embedd Code!</strong><br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.','richer-framework'),
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "8"
		)
	)
);

/* ----------------------------------------------------- */
// Post Quote Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'post_quote',
	'title'		=> __('Post Quote','richer-framework'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		array(
			'name'		=> __('Source','richer-framework'),
			'id'		=> $prefix . 'quote_name',
			'type'		=> 'text'
		),
		array(
			'name'	=> __('URL','richer-framework'),
			'id'	=> $prefix . 'quote_url',
			'type' 	=> 'url'
		)
	)
);

/* ----------------------------------------------------- */
// Post Url Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'post_url',
	'title'		=> __('Post Link', 'richer-framework'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',
	'fields'	=> array(
		array(
			'name'	=> __('URL','richer-framework'),
			'id'	=> '{$prefix}post_url',
			'type' 	=> 'url'
		)
	)
);
/* ----------------------------------------------------- */
// Post Audio Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'post_audio',
	'title'		=> __('Post Audio', 'richer-framework'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> __('Embed Code', 'richer-framework'),
			'id'	=> $prefix . 'audio_embed',
			'desc'	=> __('Just insert your <strong>Audio Embed Code!</strong><br /><br /><strong>Notice:</strong> insert embed code from http://soundcloud.com','richer-framework'),
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "8"
		)
	)
);
/*-------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'my-meta-box-testi',
	'title' =>  __('Testimonial options', 'richer-framework'),
	'pages' 	=> array( 'testi'),
	'context' 	=> 'normal',
	'priority' 	=> 'high',
	'fields' 	=> array(
    	array(
    	   'name' => __('Name', 'richer-framework'),
    	   'desc' => __('Input author\'s name. ', 'richer-framework'),
    	   'id' => $prefix . 'testi_caption',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'name' => __('URL', 'richer-framework'),
    	   'desc' => __('Input author\'s URL (full address with http://).', 'richer-framework'),
    	   'id' => $prefix . 'testi_url',
    	   'type' => 'text',
    	   'std' => ''
    	),
			array(
    	   'name' => __('Info', 'richer-framework'),
    	   'desc' => __('Input author\'s additional info.', 'richer-framework'),
    	   'id' => $prefix . 'testi_info',
    	   'type' => 'text',
    	   'std' => ''
    	)
	)
);
/*-------------------------------------------------*/
$meta_boxes[] = array(
	'id' => 'asw_meta',
	'title' =>  __('SEO Settings', 'asw-framework'),
	'pages' 	=> array('page', 'portfolio', 'post', 'testi'),
	'context' 	=> 'side',
	'priority' 	=> 'low',
	'fields' 	=> array(
    	array(
    	   'name' => __('Meta keywords', 'asw-framework'),
    	   'desc' => __('Enter keywords separated by commas.', 'richer-framework'),
    	   'id' => $prefix . 'meta_keywords',
    	   'type' => 'text',
    	   'std' => ''
    	),
    	array(
    	   'name' => __('Meta description', 'asw-framework'),
    	   'desc' => __('Enter meta description for this page.', 'richer-framework'),
    	   'id' => $prefix . 'meta_description',
    	   'type' => 'textarea',
    	   'std' => ''
    	)
	)
);
/*-----------------------------------------------------------*/
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
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );