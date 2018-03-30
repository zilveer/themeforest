<?php

return array(
	'title'  => __( 'Single menu', 'BERG' ),
	'icon'   => 'el el-edit',
	'fields' => array(
		array(
			'id' => 'menu_single',
			'type' => 'gallery',
			'title' => __('Menu item gallery', 'BERG'),
		),

		array(
			'id' => 'icon_food',
			'type' => 'gallery',
			'title' => __('Food icon', 'BERG'),
			// 'args' => array('teeny'=>false),
		),

		array(
			'id' => 'menu_badge',
			'type' => 'editor',
			'title' => __('Badges', 'BERG'),
			'args' => array('teeny'=>false, 'media_buttons' => false, 'textarea_rows' => '1', 'tinymce' => array('toolbar1' => 'yopress', 'toolbar2' => ''), 'editor_css' => '<style>.mce-menu:not(.mce-menu-sub) .mce-menu-item:nth-child(1), .mce-menu:not(.mce-menu-sub) .mce-menu-item:nth-child(2), .mce-menu:not(.mce-menu-sub) .mce-menu-item:nth-child(4), .mce-menu:not(.mce-menu-sub) .mce-menu-item:nth-child(6) { display: none; }</style>' ),
		),

		array(
			'id' => 'menu_details',
			'type' => 'editor',
			'title' => __('Price / additional info', 'BERG'),
			'args' => array('teeny'=>false),
		),
	),
);
