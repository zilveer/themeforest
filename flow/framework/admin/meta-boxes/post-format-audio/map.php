<?php

/*** Audio Post Format ***/

$audio_post_format_meta_box = flow_elated_add_meta_box(
	array(
		'scope' =>	array('post'),
		'title' => 'Audio Post Format',
		'name' 	=> 'post_format_audio_meta'
	)
);

flow_elated_add_meta_box_field(
	array(
		'name'        => 'eltd_post_audio_link_meta',
		'type'        => 'text',
		'label'       => 'Self Hosted Link',
		'description' => 'Enter audio link',
		'parent'      => $audio_post_format_meta_box,

	)
);

flow_elated_add_meta_box_field(
	array(
		'name'        => 'eltd_post_soundcloud_link_meta',
		'type'        => 'text',
		'label'       => 'Soundcloud Link',
		'description' => 'Enter Soundcloud link',
		'parent'      => $audio_post_format_meta_box,

	)
);
