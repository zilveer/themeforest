<?php

/*************************************************************************************
 *	Add MetaBox to Post edit page
 *************************************************************************************/

$om_post_meta_box=array (
	'sidebar' => array (
		'id' => 'om-post-meta-box-sidebar',
		'name' => __('Sidebar', 'om_theme'),
		'callback' => 'om_post_meta_box_sidebar',
		'fields' => array (
			array ( "name" => __('Page template','om_theme'),
					"desc" => '',
					"id" => OM_THEME_SHORT_PREFIX."sidebar_show",
					"type" => "select",
					"std" => '',
					'options' => array(
						'' => __('With sidebar', 'om_theme'),
						'hide' => __('Without sidebar', 'om_theme'),
					)
			),

			array (
				'name' => __('Choose the sidebar','om_theme'),
				'desc' => '',
				'id' => OM_THEME_SHORT_PREFIX.'sidebar',
				'type' => 'sidebar',
				'std' => ''
			),
			
			array ( "name" => __('Page Individual Sidebar Position','om_theme'),
					"desc" => __('Normally sidebar position for all pages can be specified under "Appearance > Theme Options > Sidebars", but you can set sidebar position for current page manually.','om_theme'),
					"id" => OM_THEME_SHORT_PREFIX."sidebar_custom_pos",
					"type" => "select",
					"std" => '',
					'options' => array(
						'' => __('Default (As in "Theme Options")', 'om_theme'),
						'left' => __('Left Side', 'om_theme'),
						'right' => __('Right Side', 'om_theme'),
					)
			),
		),
	),
	
	'quote' => array (
		'id' => 'om-post-meta-box-quote',
		'name' => __('Quote Settings', 'om_theme'),
		'callback' => 'om_post_meta_box_quote',
		'fields' => array (
			array (
				'name' => __('The Quote','om_theme'),
				'desc' => __('Write your quote in this field','om_theme'),
				'id' => OM_THEME_SHORT_PREFIX.'quote',
				'type' => 'textarea',
				'std' => ''
			),
		),
	),
	
	'link' => array(
		'id' => 'om-post-meta-box-link',
		'name' => __('Link Settings', 'om_theme'),
		'callback' => 'om_post_meta_box_link',
		'fields' => array (
			array (
				'name' => __('The URL','om_theme'),
				'desc' => __('Insert the URL you wish to link to','om_theme'),
				'id' => OM_THEME_SHORT_PREFIX.'link_url',
				'type' => 'text',
				'std' => ''
			),
		),
	),
	
	'video' => array (
		'id' => 'om-post-meta-box-video',
		'name' =>  __('Video Settings', 'om_theme'),
		'callback' => 'om_post_meta_box_video',
		'fields' => array (
			array ( "name" => __('Embeded Code','om_theme'),
					"desc" => __('If you have embed code, please, insert it here (best width is 560px).<br/>If you have only link to M4V or OGV file, skip this field and fill the next ','om_theme'),
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
		'id' => 'om-post-meta-box-audio',
		'name' =>  __('Audio Settings', 'om_theme'),
		'callback' => 'om_post_meta_box_audio',
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
	
	'gallery' => array (
		'id' => 'om-post-meta-box-gallery',
		'name' => __('Gallery Settings', 'om_theme'),
		'callback' => 'om_post_meta_box_gallery',
		'fields' => array (
			array ( "name" => __('Gallery mode','om_theme'),
					"desc" => '',
					"id" => OM_THEME_SHORT_PREFIX."gallery_mode",
					"type" => "select",
					"std" => '',
					'options' => array(
						'' => __('Standard', 'om_theme'),
						'masonry' => __('Masonry', 'om_theme'),
					)
			),
			
			array ( "name" => __('Gallery','om_theme'),
					"desc" => '',
					"id" => OM_THEME_SHORT_PREFIX."gallery",
					"type" => "gallery",
					"std" => '',
			),

		),
	),
);
 
function om_add_post_meta_box() {
	global $om_post_meta_box;
	
	foreach($om_post_meta_box as $metabox) {
		add_meta_box(
			$metabox['id'],
			$metabox['name'],
			$metabox['callback'],
			'post',
			'normal',
			'high'
		);
	}
 
}
add_action('add_meta_boxes', 'om_add_post_meta_box');

/*************************************************************************************
 *	MetaBox Callbacks Functions
 *************************************************************************************/

function om_post_meta_box_quote() {
	global $om_post_meta_box;
	
	echo om_generate_meta_box($om_post_meta_box['quote']['fields']);
}

function om_post_meta_box_link() {
	global $om_post_meta_box;

	echo om_generate_meta_box($om_post_meta_box['link']['fields']);
}

function om_post_meta_box_video() {
	global $om_post_meta_box;

	echo om_generate_meta_box($om_post_meta_box['video']['fields']);
}

function om_post_meta_box_audio() {
	global $om_post_meta_box;

	echo om_generate_meta_box($om_post_meta_box['audio']['fields']);
}

function om_post_meta_box_sidebar() {
	global $om_post_meta_box;

	echo om_generate_meta_box($om_post_meta_box['sidebar']['fields']);
}


function om_post_meta_box_gallery() {
	global $om_post_meta_box;

	echo om_generate_meta_box($om_post_meta_box['gallery']['fields']);
}

/*************************************************************************************
 *	Save MetaBox data
 *************************************************************************************/

function om_save_post_metabox($post_id) {
	global $om_post_meta_box;
 
	om_save_metabox($post_id, $om_post_meta_box);

}
add_action('save_post', 'om_save_post_metabox');


/*************************************************************************************
 *	Load JS Scripts and Styles
 *************************************************************************************/
 
function om_post_meta_box_scripts($hook) {
	if( 'post.php' != $hook && 'post-new.php' != $hook )
		return;
	
	wp_enqueue_script('om-admin-post-meta', TEMPLATE_DIR_URI . '/admin/js/post-meta.js', array('jquery'));
}
add_action('admin_enqueue_scripts', 'om_post_meta_box_scripts');
