<?php
$prefix = 'met_';

global $meta_boxes;

$meta_boxes = array();
$bool_options = array('true' => 'True','false' => 'False');

$meta_boxes[] = array(
	'id' => 'portfolio_detail',
	'title' => 'Portfolio Settings',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
			'name'  => 'Portfolio Detail Header Text',
			'id'    => "{$prefix}portfolio_header_text",
			'desc'  => '',
			'type'  => 'text',
			'std'   => 'PORTFOLIO DETAIL',
			'clone' => false,
		),
		array(
			'name'    => 'Show Categories On Sidebar',
			'id'      => "{$prefix}show_categories",
			'type'    => 'radio',
			'std'		=> 'true',
			'options' => $bool_options,
		),
		array(
			'name'  => 'Category List Title',
			'id'    => "{$prefix}category_list_title",
			'desc'  => '',
			'type'  => 'text',
			'std'   => 'SERVICES GIVEN',
			'clone' => false,
		),
		array(
			'name'    	=> 'Show Tags On Sidebar',
			'id'      	=> "{$prefix}show_tags",
			'type'   	=> 'radio',
			'std'		=> 'true',
			'options' 	=> $bool_options,
		),
		array(
			'name'  => 'Tag List Title',
			'id'    => "{$prefix}tag_list_title",
			'desc'  => '',
			'type'  => 'text',
			'std'   => 'TAGS',
			'clone' => false,
		),
		array(
			'name'    	=> 'Show Socials On Sidebar',
			'id'      	=> "{$prefix}show_socials",
			'type'   	=> 'radio',
			'std'		=> 'true',
			'options' 	=> $bool_options,
		),
		array(
			'name'  => 'Socials Title',
			'id'    => "{$prefix}socials_title",
			'desc'  => '',
			'type'  => 'text',
			'std'   => 'SHARE',
			'clone' => false,
		)
	)
);

$meta_boxes[] = array(
	'id' => 'media',
	'title' => 'Media Settings',
	'pages' => array( 'post', 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',

	'fields' => array(
		array(
			'name'    => 'Content Media?',
			'id'      => "{$prefix}content_media",
			'type'    => 'radio',
			'std'		=> 'thumbnail',
			'options' => array(
				'thumbnail' 	=> 'Featured Image ',
				'gallery' 		=> 'Slider Gallery',
				'video' 		=> 'Video',
				'html5a' 		=> 'HTML5 Audio',
				'html5v' 		=> 'HTML5 Video'
			),
		),
		array(
			'name'  => 'Youtube OR Vimeo Link',
			'id'    => "{$prefix}video_link",
			'desc'  => 'Insert your video link. Ex: http://www.youtube.com/watch?v=hNZE2zo7cpQ OR http://vimeo.com/63898090',
			'type'  => 'text',
			'std'   => '',
			'clone' => false,
		),
		array(
			'name'  => 'Media File',
			'id'    => "{$prefix}media_url",
			'desc'  => 'only HTML5 video(mp4) or HTML5 audio(mp3) file',
			'type'  => 'file_advanced',
			'std'   => '',
			'clone' => false,
			'max_file_uploads'	=> 1,
			'mime_type' 		=> 'audio,video',
		),
		array(
			'name'             => 'Gallery Images',
			'id'               => "{$prefix}gallery_images",
			'desc'				=> "Only for 'Image Gallery' content media option.",
			'type'             => 'plupload_image',
			'max_file_uploads' => 20,
		),
		array(
			'name'    => 'Slider Auto-Play?',
			'id'      => "{$prefix}slider_auto_play",
			'type'    => 'radio',
			'std'		=> 'true',
			'options' => $bool_options,
		),
		array(
			'name'  => 'Slider Auto-Play Duration',
			'id'    => "{$prefix}slider_auto_play_duration",
			'desc'  => 'Milisecond, ex: 2000 = 2 seconds',
			'type'  => 'text',
			'std'   => '2000',
			'clone' => false,
		),
		array(
			'name'    => 'Slider Circular?',
			'id'      => "{$prefix}slider_circular",
			'type'    => 'radio',
			'std'		=> 'true',
			'options' => $bool_options,
		),
		array(
			'name'    => 'Slider Infinite?',
			'id'      => "{$prefix}slider_infinite",
			'type'    => 'radio',
			'std'		=> 'true',
			'options' => $bool_options,
		)
	)
);



/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function metcreative_register_meta_boxes(){
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}add_action( 'admin_init', 'metcreative_register_meta_boxes' );