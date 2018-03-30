<?php

add_filter( 'rwmb_meta_boxes', 'gg_register_meta_boxes' );
/**
 * Register meta boxes
 *
 * @return void
 */

function gg_register_meta_boxes( $meta_boxes ) {
// Get sidebars defined in theme options
$metabox_sidebars = of_get_option('sidebar_list');
// Verify if sidebars are created
if( !$metabox_sidebars )
$metabox_sidebars = array();
array_unshift( $metabox_sidebars, Array( 'id' => 'default_sidebar', 'name' => 'Default sidebar' ) );

if ($metabox_sidebars) {
	$metabox_sidebars_array = array();
	foreach ($metabox_sidebars as $metabox_sidebars_list ) {
		   $metabox_sidebars_array[$metabox_sidebars_list['id']] = $metabox_sidebars_list['name'];
	}
}

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'gg_';

$meta_boxes[] = array(
	'id' => 'info_general',
	'title' => 'Page image dimensions',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => 'The dimension of the header page image is: 970x400px. The image is automatically resized, but you must constrain proportions.</br>To insert a header image please use the "Set featured image" link from the right panel.',
			'id'    => "{$prefix}page_info",
			'type'  => 'description'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'general_sidebar',
	'title' => 'Choose your sidebar',
	'pages' => array( 'post', 'page' ),
	'context' => 'side',
	'priority' => 'low',
	'fields' => array(
		array(
			'name'     => 'Posts Widget Area',
			'id'       => "{$prefix}primary-widget-area",
			'type'     => 'select',
			'class'    => 'posts-widget-area',
			'options'  => $metabox_sidebars_array,
			'multiple' => false,
		),
		array(
			'name'     => 'Pages Widget Area',
			'id'       => "{$prefix}secondary-widget-area",
			'type'     => 'select',
			'class'    => 'pages-widget-area',
			'options'  => $metabox_sidebars_array,
			'multiple' => false,
		),
		array(
			'name'     => 'Portfolio Widget Area',
			'id'       => "{$prefix}portfolio-widget-area",
			'type'     => 'select',
			'class'    => 'portfolio-widget-area',
			'options'  => $metabox_sidebars_array,
			'multiple' => false,
		),
		array(
			'name'     => 'Contact Widget Area',
			'id'       => "{$prefix}contact-widget-area",
			'type'     => 'select',
			'class'    => 'contact-widget-area',
			'options'  => $metabox_sidebars_array,
			'multiple' => false,
		),
		array(
			'name'     => 'First Footer Widget Area',
			'id'       => "{$prefix}first-footer-widget-area",
			'type'     => 'select',
			'class'    => 'first-footer-widget-area',
			'options'  => $metabox_sidebars_array,
			'multiple' => false,
		),
		array(
			'name'     => 'Second Footer Widget Area',
			'id'       => "{$prefix}second-footer-widget-area",
			'type'     => 'select',
			'class'    => 'second-footer-widget-area',
			'options'  => $metabox_sidebars_array,
			'multiple' => false,
		),
		array(
			'name'     => 'Third Footer Widget Area',
			'id'       => "{$prefix}third-footer-widget-area",
			'type'     => 'select',
			'class'    => 'third-footer-widget-area',
			'options'  => $metabox_sidebars_array,
			'multiple' => false,
		),
		array(
			'name'     => 'Fourth Footer Widget Area',
			'id'       => "{$prefix}fourth-footer-widget-area",
			'type'     => 'select',
			'class'    => 'fourth-footer-widget-area',
			'options'  => $metabox_sidebars_array,
			'multiple' => false,
			'desc'     => 'You can create more custom sidebars <a href="themes.php?page=options-framework">here</a>.'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'general_page_meta',
	'title' => 'Page headline',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => 'Enter page headline here',
			'id'    => "{$prefix}page_headline",
			'desc'  => 'Put your page headline here.<br /> Tip: Use the "+" button on the right to add an extra headline.',
			'type'  => 'text',
			'std'   => '',
			'clone' => true,
		)
	)
);

$meta_boxes[] = array(
	'id' => 'portfolio_page_meta',
	'title' => 'Portfolio page options',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'    => 'Select categories to display',
			'id'      => "{$prefix}portfolio_page_categories",
			'type'    => 'taxonomy',
			'options' => array(
				'taxonomy' => 'portfolio_category',
				'type' => 'select_tree',
				'args' => array()
			),
		),
		
		array(
			'name'     => 'Select portfolio page style',
			'id'       => "{$prefix}portfolio_page_style",
			'type'     => 'select',
			'options'  => array(
				'classic' => 'Classic',
				'sidebar' => 'With sidebar',
				'filterable' => 'Filterable',
			),
			'std'   => array( 'classic' ),
			'multiple' => false,
		),

		array(
			'name'     => 'Select portfolio page columns',
			'id'       => "{$prefix}portfolio_page_columns",
			'type'     => 'select',
			'options'  => array(
				'one-col' => 'One column',
				'two-col' => 'Two columns',
				'three-col' => 'Three columns',
				'four-col' => 'Four columns',
			),
			'std'   => array( 'three-col' ),
			'multiple' => false,
		),
		
		array(
			'name'     => 'Select portfolio hover effect',
			'id'       => "{$prefix}portfolio_hover_effect",
			'type'     => 'select',
			'options'  => array(
				'first' => 'Style 1',
				'second' => 'Style 2',
				'third' => 'Style 3',
			),
			'std'   => array( 'first' ),
			'multiple' => false,
		),
		
		array(
			'name'  => 'Enter number of post to show',
			'id'    => "{$prefix}portfolio_page_nr_posts",
			'desc'  => 'Enter number of posts to show. Default: 10',
			'type'  => 'text',
			'std'   => '10',
			'clone' => false,
		)
	)
);

$meta_boxes[] = array(
	'id' => 'blog_page_meta',
	'title' => 'Blog page options',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => 'Enter number of post to show',
			'id'    => "{$prefix}blog_page_nr_posts",
			'desc'  => 'Enter number of posts to show. Default: 5',
			'type'  => 'text',
			'std'   => '5',
			'clone' => false,
		)
	)
);

$meta_boxes[] = array(
	'id' => 'blogpost_post_meta_info',
	'title' => 'Blog post - Image dimensions',
	'pages' => array('post'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => 'The images are automatically resized, but you must constrain proportions.</br>To insert an image please use the "Set featured image" link from the bottom right panel. For perfect display please use the following image size: 620x310px </br>',
			'id'    => "{$prefix}blog_post_info",
			'type'  => 'description'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'contact_page_meta',
	'title' => 'Contact page options',
	'pages' => array('page'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => 'Enter your email address',
			'id'    => "{$prefix}contact_page_email",
			'desc'  => 'Enter your email address.',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		array(
			'name'  => 'Enter success text',
			'id'    => "{$prefix}contact_page_success_msg",
			'desc'  => 'Enter the success text',
			'type'  => 'text',
			'std'   => 'Your email was successfully sent.',
			'clone' => false,
		),
		array(
			'name'  => 'Enter error text',
			'id'    => "{$prefix}contact_page_error_msg",
			'desc'  => 'Enter the error text',
			'type'  => 'text',
			'std'   => 'There was an error submitting the form.',
			'clone' => false,
		),
		array(
			'name'  => 'Address or Lat/Lon values',
			'id'    => "{$prefix}map_config_address",
			'desc'  => 'Address or Lat/Lon values in this format <pre>51.13456, -1.34333</pre>',
			'type'  => 'text',
			'std'   => '51.13456, -1.34333',
			'clone' => false,
		),
		array(
			'name'  => 'Map InfoWindow',
			'id'    => "{$prefix}map_config_infobox",
			'desc'  => '',
			'type'  => 'textarea',
			'std'   => '',
			'clone' => false,
		),
		array(
			'name'  => 'Map Zoom Level',
			'id'    => "{$prefix}map_config_zoom",
			'desc'  => 'Default: 10',
			'type'  => 'text',
			'std'   => '10',
			'clone' => false,
		)
		,
		array(
			'name'  => 'Disable map directions',
			'id'    => "{$prefix}disable_map_directions",
			'desc'  => 'Check this box if you want to disable the map directions and remove the message about user location.',
			'type'  => 'checkbox',
			'clone' => false,
		)
	)
);

$meta_boxes[] = array(
	'id' => 'slideshow_post_meta_info',
	'title' => 'Slideshow post - Image dimensions',
	'pages' => array('slideshow'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => 'The images are automatically resized, but you must constrain proportions.</br>To insert an image please use the "Set featured image" link from the bottom right panel. For perfect display please use the following image sizes.',
			'id'    => "{$prefix}slideshow_post_info",
			'type'  => 'description'
		),
		array(
			'name'  => 'Classic Slideshow </br> 970x400px </br>
						The height can by as big as you need but the width must remain 970px.',
			'id'    => "{$prefix}slideshow_post_info_classic_slideshow",
			'type'  => 'description'
		),
		array(
			'name'  => 'Sequence Slideshow </br> This slideshow is element based, this means you must upload an image with fixed dimensions </br>
						266x568px </br>
						Note: For maximum effect please use images with transparent background.(.png)',
			'id'    => "{$prefix}slideshow_post_info_sequence_slideshow",
			'type'  => 'description'
		),
		array(
			'name'  => 'Camera Slideshow </br> 1200x500px </br>
						The height can by as big as you need but the width must remain 1200px.',
			'id'    => "{$prefix}slideshow_post_info_camera_slideshow",
			'type'  => 'description'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'slideshow_post_meta',
	'title' => 'Slideshow post options',
	'pages' => array('slideshow'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => 'Enter external link',
			'id'    => "{$prefix}slideshow_external_link",
			'desc'  => 'Enter external link',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		array(
			'name'  => 'Enter slide caption',
			'id'    => "{$prefix}slideshow_caption",
			'desc'  => 'Enter slide caption',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		)
	)
);

$meta_boxes[] = array(
	'id' => 'sponsors_post_meta_info',
	'title' => 'Sponsors post - Image dimensions',
	'pages' => array('sponsors'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => 'The images are automatically resized, but you must constrain proportions.</br>To insert an image please use the "Set featured image" link from the bottom right panel. 
			For perfect display please use the following image size: 150x50px </br>
			You can upload an image with a bigger width, but you must always keep the same height: 50px.',
			'id'    => "{$prefix}sponsors_post_info",
			'type'  => 'description'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'sponsors_post_meta',
	'title' => 'Sponsors post options',
	'pages' => array('sponsors'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => 'Enter external link',
			'id'    => "{$prefix}sponsors_external_link",
			'desc'  => 'Enter external link',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		)
	)
);

$meta_boxes[] = array(
	'id' => 'portfolio_post_meta_info',
	'title' => 'Portfolio post - Image dimensions',
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => 'The images are automatically resized, but you must constrain proportions.</br>To insert an image please use the "Set featured image" link from the right panel. For perfect display please use the following image sizes.',
			'id'    => "{$prefix}portfolio_post_info",
			'type'  => 'description'
		),
		array(
			'name'  => 'Classic &amp; Filterable layout </br> One column - 970x1000px </br>
				Two columns - 470x641px </br>
				Three columns - 300x413px </br>
				Four columns - 220x300px </br>',
			'id'    => "{$prefix}portfolio_post_info_classic_filterable",
			'type'  => 'description'
		),
		array(
			'name'  => 'Sidebar layout </br> One column - 720x641px </br>
				Two columns - 345x471px </br>
				Three columns - 300x413px </br>
				Four columns - 220x300px </br>',
			'id'    => "{$prefix}portfolio_post_info_sidebar",
			'type'  => 'description'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'portfolio_post_meta',
	'title' => 'Portfolio post options',
	'pages' => array('portfolio'),
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array(
		array(
			'name'  => 'Project date',
			'id'    => "{$prefix}portfolio_project_date",
			'desc'  => 'Enter the project date',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		array(
			'name'  => 'Project URL',
			'id'    => "{$prefix}portfolio_project_url",
			'desc'  => 'Enter the project URL. Please include "http://"',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		array(
			'name'  => 'Project details',
			'id'    => "{$prefix}portfolio_project_details",
			'desc'  => 'Insert here details worth mentioning',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		array(
			'name'  => 'Enter video link or external link',
			'id'    => "{$prefix}portfolio_post_video_link",
			'desc'  => '
			
			Enter video URL (Vimeo, Youtube), Flash content URL(SWF), QuickTime Movies URL<br><br>

			For Youtube, Vimeo videos just insert the link, like this:<br>
			http://vimeo.com/17120260<br>
			http://www.youtube.com/watch?v=qqXi8WmQ_WM<br><br>
			
			For SWF and Quicktime you must specify the dimensions too, like this:<br>
			http://trailers.apple.com/movies/universal/despicableme/despicableme-tlr1_r640s.mov?width=640&height=360<br>
			http://www.adobe.com/jp/events/cs3_web_edition_tour/swfs/perform.swf?width=792&height=294 <br>
			
			',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		array(
            'name'              => __( 'Upload lightbox image','okthemes' ),
            'id'                => "{$prefix}portfolio_lightbox_image",
            'desc'              => 'Upload the image used in lightbox.',
            'type'              => 'image_advanced',
            'max_file_uploads'  => 1,
        ),
		array(
			'name'             => 'Portfolio slideshow upload (only for portfolio single post)',
			'id'               => "{$prefix}portfolio_slideshow_upload",
			'type'             => 'plupload_image',
			'max_file_uploads' => 50,
			'desc'  => 'The images are automatically resized, but you must constrain proportions. </br> The width of the image must be 970px; the height as much as you want. Recommended: 600px',
			'force_delete' => true,
		),
	)
);

return $meta_boxes;

}