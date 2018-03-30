<?php

/*** Video Post Format ***/

$video_post_format_meta_box = hashmag_mikado_add_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => 'Video Post Format',
		'name' 	=> 'post_format_video_meta'
	)
);

hashmag_mikado_add_meta_box_field(
	array(
		'name'        => 'mkdf_video_type_meta',
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
			'youtube' => '#mkdf_mkdf_video_self_hosted_container',
			'vimeo' => '#mkdf_mkdf_video_self_hosted_container',
			'self' => '#mkdf_mkdf_video_embedded_container'
		),
		'show' => array(
			'youtube' => '#mkdf_mkdf_video_embedded_container',
			'vimeo' => '#mkdf_mkdf_video_embedded_container',
			'self' => '#mkdf_mkdf_video_self_hosted_container')
	)
	)
);

$mkdf_video_embedded_container = hashmag_mikado_add_admin_container(
	array(
		'parent' => $video_post_format_meta_box,
		'name' => 'mkdf_video_embedded_container',
		'hidden_property' => 'mkdf_video_type_meta',
		'hidden_value' => 'self'
	)
);

$mkdf_video_self_hosted_container = hashmag_mikado_add_admin_container(
	array(
		'parent' => $video_post_format_meta_box,
		'name' => 'mkdf_video_self_hosted_container',
		'hidden_property' => 'mkdf_video_type_meta',
		'hidden_values' => array('youtube', 'vimeo')
	)
);



hashmag_mikado_add_meta_box_field(
	array(
		'name'        => 'mkdf_post_video_id_meta',
		'type'        => 'text',
		'label'       => 'Video ID',
		'description' => 'Enter Video ID',
		'parent'      => $mkdf_video_embedded_container,

	)
);


hashmag_mikado_add_meta_box_field(
	array(
		'name'        => 'mkdf_post_video_image_meta',
		'type'        => 'image',
		'label'       => 'Video Image',
		'description' => 'Upload video image',
		'parent'      => $mkdf_video_self_hosted_container,

	)
);

hashmag_mikado_add_meta_box_field(
	array(
		'name'        => 'mkdf_post_video_webm_link_meta',
		'type'        => 'text',
		'label'       => 'Video WEBM',
		'description' => 'Enter video URL for WEBM format',
		'parent'      => $mkdf_video_self_hosted_container,

	)
);

hashmag_mikado_add_meta_box_field(
	array(
		'name'        => 'mkdf_post_video_mp4_link_meta',
		'type'        => 'text',
		'label'       => 'Video MP4',
		'description' => 'Enter video URL for MP4 format',
		'parent'      => $mkdf_video_self_hosted_container,

	)
);

hashmag_mikado_add_meta_box_field(
	array(
		'name'        => 'mkdf_post_video_ogv_link_meta',
		'type'        => 'text',
		'label'       => 'Video OGV',
		'description' => 'Enter video URL for OGV format',
		'parent'      => $mkdf_video_self_hosted_container,

	)
);