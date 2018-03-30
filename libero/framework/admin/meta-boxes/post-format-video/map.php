<?php

/*** Video Post Format ***/

$video_post_format_meta_box = libero_mikado_add_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => 'Video Post Format',
		'name' 	=> 'post_format_video_meta'
	)
);

libero_mikado_add_meta_box_field(
	array(
		'name'        => 'mkd_video_type_meta',
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
			'youtube' => '#mkd_mkd_video_self_hosted_container',
			'vimeo' => '#mkd_mkd_video_self_hosted_container',
			'self' => '#mkd_mkd_video_embedded_container'
		),
		'show' => array(
			'youtube' => '#mkd_mkd_video_embedded_container',
			'vimeo' => '#mkd_mkd_video_embedded_container',
			'self' => '#mkd_mkd_video_self_hosted_container')
	)
	)
);

$mkd_video_embedded_container = libero_mikado_add_admin_container(
	array(
		'parent' => $video_post_format_meta_box,
		'name' => 'mkd_video_embedded_container',
		'hidden_property' => 'mkd_video_type_meta',
		'hidden_value' => 'self'
	)
);

$mkd_video_self_hosted_container = libero_mikado_add_admin_container(
	array(
		'parent' => $video_post_format_meta_box,
		'name' => 'mkd_video_self_hosted_container',
		'hidden_property' => 'mkd_video_type_meta',
		'hidden_values' => array('youtube', 'vimeo')
	)
);



libero_mikado_add_meta_box_field(
	array(
		'name'        => 'mkd_post_video_id_meta',
		'type'        => 'text',
		'label'       => 'Video ID',
		'description' => 'Enter Video ID',
		'parent'      => $mkd_video_embedded_container,

	)
);


libero_mikado_add_meta_box_field(
	array(
		'name'        => 'mkd_post_video_image_meta',
		'type'        => 'image',
		'label'       => 'Video Image',
		'description' => 'Upload video image',
		'parent'      => $mkd_video_self_hosted_container,

	)
);

libero_mikado_add_meta_box_field(
	array(
		'name'        => 'mkd_post_video_webm_link_meta',
		'type'        => 'text',
		'label'       => 'Video WEBM',
		'description' => 'Enter video URL for WEBM format',
		'parent'      => $mkd_video_self_hosted_container,

	)
);

libero_mikado_add_meta_box_field(
	array(
		'name'        => 'mkd_post_video_mp4_link_meta',
		'type'        => 'text',
		'label'       => 'Video MP4',
		'description' => 'Enter video URL for MP4 format',
		'parent'      => $mkd_video_self_hosted_container,

	)
);

libero_mikado_add_meta_box_field(
	array(
		'name'        => 'mkd_post_video_ogv_link_meta',
		'type'        => 'text',
		'label'       => 'Video OGV',
		'description' => 'Enter video URL for OGV format',
		'parent'      => $mkd_video_self_hosted_container,

	)
);