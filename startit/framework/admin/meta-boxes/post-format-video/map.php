<?php

/*** Video Post Format ***/

$video_post_format_meta_box = qode_startit_add_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => 'Video Post Format',
		'name' 	=> 'post_format_video_meta'
	)
);

qode_startit_add_meta_box_field(
	array(
		'name'        => 'qodef_video_type_meta',
		'type'        => 'select',
		'label'       => 'Video Type',
		'description' => 'Choose video type',
		'parent'      => $video_post_format_meta_box,
		'default_value' => 'youtube',
		'options'     => array(
			'youtube' => 'Youtube',
			'vimeo' => 'Vimeo',
			'self' => 'Self Hosted'
		),
		'args' => array(
		'dependence' => true,
		'hide' => array(
			'youtube' => '#qodef_qodef_video_self_hosted_container',
			'vimeo' => '#qodef_qodef_video_self_hosted_container',
			'self' => '#qodef_qodef_video_embedded_container'
		),
		'show' => array(
			'youtube' => '#qodef_qodef_video_embedded_container',
			'vimeo' => '#qodef_qodef_video_embedded_container',
			'self' => '#qodef_qodef_video_self_hosted_container')
	)
	)
);

$qodef_video_embedded_container = qode_startit_add_admin_container(
	array(
		'parent' => $video_post_format_meta_box,
		'name' => 'qodef_video_embedded_container',
		'hidden_property' => 'qodef_video_type_meta',
		'hidden_value' => 'self'
	)
);

$qodef_video_self_hosted_container = qode_startit_add_admin_container(
	array(
		'parent' => $video_post_format_meta_box,
		'name' => 'qodef_video_self_hosted_container',
		'hidden_property' => 'qodef_video_type_meta',
		'hidden_values' => array('youtube', 'vimeo')
	)
);



qode_startit_add_meta_box_field(
	array(
		'name'        => 'qodef_post_video_id_meta',
		'type'        => 'text',
		'label'       => 'Video ID',
		'description' => 'Enter Video ID',
		'parent'      => $qodef_video_embedded_container,

	)
);


qode_startit_add_meta_box_field(
	array(
		'name'        => 'qodef_post_video_image_meta',
		'type'        => 'image',
		'label'       => 'Video Image',
		'description' => 'Upload video image',
		'parent'      => $qodef_video_self_hosted_container,

	)
);

qode_startit_add_meta_box_field(
	array(
		'name'        => 'qodef_post_video_webm_link_meta',
		'type'        => 'text',
		'label'       => 'Video WEBM',
		'description' => 'Enter video URL for WEBM format',
		'parent'      => $qodef_video_self_hosted_container,

	)
);

qode_startit_add_meta_box_field(
	array(
		'name'        => 'qodef_post_video_mp4_link_meta',
		'type'        => 'text',
		'label'       => 'Video MP4',
		'description' => 'Enter video URL for MP4 format',
		'parent'      => $qodef_video_self_hosted_container,

	)
);

qode_startit_add_meta_box_field(
	array(
		'name'        => 'qodef_post_video_ogv_link_meta',
		'type'        => 'text',
		'label'       => 'Video OGV',
		'description' => 'Enter video URL for OGV format',
		'parent'      => $qodef_video_self_hosted_container,

	)
);