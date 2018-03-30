<?php

return array(
	'icon'   => 'el el-list',
	'title'  => __( 'Archive', 'BERG' ),
	'fields' => array(
		array(
			'id' => 'berg_archive_template',
			'type' => 'select',
			'title' => __('Archive template', 'BERG'),
			'options' => array(
				1 => __('Classic archive', 'BERG'),
				2 => __('Fullscreen squares', 'BERG'),
			),
			'select2'  => array( 'allowClear' => false ),
		),
		array(
			'id' => 'berg_archive_footer',
			'type' => 'checkbox',
			'title' => __('Enable footer', 'BERG'),
			'default' => 1
		)
	)
);