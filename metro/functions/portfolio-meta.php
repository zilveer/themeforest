<?php

/*************************************************************************************
 *	Add MetaBox to Portfolio edit page
 *************************************************************************************/

$om_portfolio_meta_box=array (
	'type' => array (
		'id' => 'om-portfolio-meta-box-type',
		'name' =>  __('Portfolio Details', 'om_theme'),
		'callback' => 'om_portfolio_meta_box_type',
		'fields' => array (
			array ( "name" => __('Portfolio type','om_theme'),
					"desc" => __('Choose the type of portfolio you wish to display.<br/>Don\'t forget to set a featured image that will be displayed on the main portfolio page.','om_theme'),
					"id" => OM_THEME_SHORT_PREFIX."portfolio_type",
					"type" => "select",
					"std" => 'image',
					'options' => array(
						'image' => __('Image', 'om_theme'),
						'slideshow' => __('Gallery', 'om_theme'),
						'slideshow-m' => __('Gallery (Masonry Layout)', 'om_theme'),
						'video' => __('Video', 'om_theme'),
						'audio' => __('Audio', 'om_theme'),
						'custom' => __('Full-width custom page', 'om_theme')
					)
			),
			array ( "name" => __('Size of media block (images/video/audio) on the page','om_theme'),
					"desc" => '',
					"id" => OM_THEME_SHORT_PREFIX."portfolio_media_size",
					"type" => "select",
					"std" => 'd1m2',
					'options' => array(
						'd1m2' => __('Description 1/3 of width, Media Block 2/3 of width', 'om_theme'),
						'd2m1' => __('Description 2/3 of width, Media Block 1/3 of width', 'om_theme'),
					)
			),
			array ( "name" => __('Custom link from preview thumbnail','om_theme'),
					"desc" => __('Specify custom link from item preview if you don\'t want the link to the portfolio item page','om_theme'),
					"id" => OM_THEME_SHORT_PREFIX."portfolio_custom_link",
					"type" => "text",
					"std" => '',
			),
		),
	),
	
	'imageblock' => array (
		'id' => 'om-portfolio-meta-box-images',
		'name' =>  __('Portfolio Images', 'om_theme'),
		'callback' => 'om_portfolio_meta_box_images',
		'fields' => array (
			array ( "name" => __('Gallery','om_theme'),
					"desc" => '',
					"id" => OM_THEME_SHORT_PREFIX."gallery",
					"type" => "gallery",
					"std" => '',
			),
		),
	),

	'video' => array (
		'id' => 'om-portfolio-meta-box-video',
		'name' =>  __('Video Settings', 'om_theme'),
		'callback' => 'om_portfolio_meta_box_video',
		'fields' => array (
			array ( "name" => __('Embeded Code','om_theme'),
					"desc" => __('If you have embed code, please, insert it here (best width is 700px).<br/>If you have only link to M4V or OGV file, skip this field and fill the next ','om_theme'),
					"id" => OM_THEME_SHORT_PREFIX."video_embed",
					"type" => "textarea",
					"std" => ''
			),
			array ( "name" => __('M4V File URL','om_theme'),
					"desc" => __('The URL to the .m4v video file','om_theme'),
					"id" => OM_THEME_SHORT_PREFIX."video_m4v",
					"type" => "text_browse",
					"std" => '',
					"library" => 'video',
			),
			array ( "name" => __('OGV File URL','om_theme'),
					"desc" => __('The URL to the .ogv video file','om_theme'),
					"id" => OM_THEME_SHORT_PREFIX."video_ogv",
					"type" => "text_browse",
					"std" => '',
					"library" => 'video',
			),
			array ( "name" => __('Poster Image to M4V or OGV video ','om_theme'),
					"desc" => __('The preivew image.','om_theme'),
					"id" => OM_THEME_SHORT_PREFIX."video_poster",
					"type" => "text_browse",
					"std" => '',
					"library" => 'image',
			),
		),
	),
	
	'audio' => array (
		'id' => 'om-portfolio-meta-box-audio',
		'name' =>  __('Audio Settings', 'om_theme'),
		'callback' => 'om_portfolio_meta_box_audio',
		'fields' => array (
			array( "name" => __('MP3 File URL','om_theme'),
				"desc" => __('The URL to the .mp3 audio file','om_theme'),
				"id" => OM_THEME_SHORT_PREFIX."audio_mp3",
				"type" => "text_browse",
				"std" => '',
				"library" => 'audio',
			),
			array( "name" => __('OGA File URL','om_theme'),
				"desc" => __('The URL to the .oga, .ogg audio file','om_theme'),
				"id" => OM_THEME_SHORT_PREFIX."audio_ogg",
				"type" => "text_browse",
				"std" => '',
				"library" => 'audio',
			),
			array( 
				"name" => __('Audio Poster Image', 'om_theme'),
				"desc" => __('If you would like a poster image for the audio', 'om_theme'),
				"id" => OM_THEME_SHORT_PREFIX."audio_poster",
				"type" => "text_browse",
				"std" => '',
				"library" => 'image',
		  ),
		),
	),
	
	'size' => array (
		'id' => 'om-portfolio-meta-box-size',
		'name' =>  __('Preview Size', 'om_theme'),
		'callback' => 'om_portfolio_meta_box_size',
		'fields' => array (
			array ( "name" => __('Preview Size','om_theme'),
					"desc" => __('Choose the size of preview thumbnail for Mansory Portfolio Template','om_theme'),
					"id" => OM_THEME_SHORT_PREFIX."portfolio_size",
					"type" => "select",
					"std" => '1',
					'options' => array(
						'1' => __('1x&nbsp;&nbsp;&nbsp;', 'om_theme'),
						'2' => __('2x&nbsp;&nbsp;&nbsp;', 'om_theme'),
						'3' => __('3x&nbsp;&nbsp;&nbsp;', 'om_theme'),
					)
			),
		),
	),
);
 
function om_add_portfolio_meta_box() {
	global $om_portfolio_meta_box;
	
	foreach($om_portfolio_meta_box as $metabox) {
		add_meta_box(
			$metabox['id'],
			$metabox['name'],
			$metabox['callback'],
			'portfolio',
			'normal',
			'high'
		);
	}
 
}
add_action('add_meta_boxes', 'om_add_portfolio_meta_box');

/*************************************************************************************
 *	MetaBox Callbacks Functions
 *************************************************************************************/

function om_portfolio_meta_box_type() {
	global $om_portfolio_meta_box;

	echo om_generate_meta_box($om_portfolio_meta_box['type']['fields']);
}

function om_portfolio_meta_box_images() {
	global $om_portfolio_meta_box;

	echo om_generate_meta_box($om_portfolio_meta_box['imageblock']['fields']);
}

function om_portfolio_meta_box_video() {
	global $om_portfolio_meta_box;

	echo om_generate_meta_box($om_portfolio_meta_box['video']['fields']);
}

function om_portfolio_meta_box_audio() {
	global $om_portfolio_meta_box;

	echo om_generate_meta_box($om_portfolio_meta_box['audio']['fields']);
}

function om_portfolio_meta_box_size() {
	global $om_portfolio_meta_box;

	echo om_generate_meta_box($om_portfolio_meta_box['size']['fields']);
}

/*************************************************************************************
 *	Save MetaBox data
 *************************************************************************************/

function om_save_portfolio_metabox($post_id) {
	global $om_portfolio_meta_box;
 
	om_save_metabox($post_id, $om_portfolio_meta_box);

}
add_action('save_post', 'om_save_portfolio_metabox');


/*************************************************************************************
 *	Load JS Scripts and Styles
 *************************************************************************************/
 
function om_portfolio_meta_box_scripts($hook) {
	if( 'post.php' != $hook && 'post-new.php' != $hook )
		return;
		
	wp_enqueue_script('om-admin-portfolio-meta', TEMPLATE_DIR_URI . '/admin/js/portfolio-meta.js', array('jquery'));
}
add_action('admin_enqueue_scripts', 'om_portfolio_meta_box_scripts');

