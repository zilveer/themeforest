<?php

/*** Video Post Format ***/

$video_post_format_meta_box = flow_elated_add_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => 'Video Post Format',
		'name' 	=> 'post_format_video_meta'
	)
);

flow_elated_add_meta_box_field(
	array(
		'name'        => 'eltd_video_type_meta',
		'type'        => 'select',
		'label'       => 'Video Type',
		'description' => 'Choose video type',
		'parent'      => $video_post_format_meta_box,
		'default_value' => 'youtube',
		'options'     => array(
			'social' => 'Youtube or Vimeo',
			'self' => 'Self Hosted'
		),
		'args' => array(
		'dependence' => true,
		'hide' => array(
			'social' => '#eltd_eltd_video_self_hosted_container',
			'self' => '#eltd_eltd_video_embedded_container'
		),
		'show' => array(
			'social' => '#eltd_eltd_video_embedded_container',
			'self' => '#eltd_eltd_video_self_hosted_container')
	)
	)
);

$eltd_video_embedded_container = flow_elated_add_admin_container(
	array(
		'parent' => $video_post_format_meta_box,
		'name' => 'eltd_video_embedded_container',
		'hidden_property' => 'eltd_video_type_meta',
		'hidden_value' => 'self'
	)
);

$eltd_video_self_hosted_container = flow_elated_add_admin_container(
	array(
		'parent' => $video_post_format_meta_box,
		'name' => 'eltd_video_self_hosted_container',
		'hidden_property' => 'eltd_video_type_meta',
		'hidden_values' => array('youtube', 'vimeo')
	)
);



flow_elated_add_meta_box_field(
	array(
		'name'        => 'eltd_post_video_link_meta',
		'type'        => 'text',
		'label'       => 'Video Link',
		'description' => 'Enter Video Link',
		'parent'      => $eltd_video_embedded_container,

	)
);


flow_elated_add_meta_box_field(
	array(
		'name'        => 'eltd_post_video_image_meta',
		'type'        => 'image',
		'label'       => 'Video Image',
		'description' => 'Upload video image',
		'parent'      => $eltd_video_self_hosted_container,

	)
);

flow_elated_add_meta_box_field(
	array(
		'name'        => 'eltd_post_video_webm_link_meta',
		'type'        => 'text',
		'label'       => 'Video WEBM',
		'description' => 'Enter video URL for WEBM format',
		'parent'      => $eltd_video_self_hosted_container,

	)
);

flow_elated_add_meta_box_field(
	array(
		'name'        => 'eltd_post_video_mp4_link_meta',
		'type'        => 'text',
		'label'       => 'Video MP4',
		'description' => 'Enter video URL for MP4 format',
		'parent'      => $eltd_video_self_hosted_container,

	)
);

flow_elated_add_meta_box_field(
	array(
		'name'        => 'eltd_post_video_ogv_link_meta',
		'type'        => 'text',
		'label'       => 'Video OGV',
		'description' => 'Enter video URL for OGV format',
		'parent'      => $eltd_video_self_hosted_container,

	)
);