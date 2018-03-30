<?php

return array(
	'icon'   => 'el el-download',
	'title'  => __( 'Theme update', 'BERG' ),
	'fields' => array(
		array(
			'id'       => 'themeforest_username',
			'type'     => 'text',
			'title'    => __( 'Themeforest username', 'BERG' ),
			'desc'     => __( 'Your themeforest username', 'BERG'),
			'default'  => ''
		),
		array(
			'id'       => 'themeforest_api_key',
			'type'     => 'text',
			'title'    => __( 'Themeforest API Key', 'BERG' ),
			'desc'     => __( 'API key which can be found on themeforest.net in My Account > Settings > API Keys', 'BERG' ),
			'default'  => ''
		),
	)
);