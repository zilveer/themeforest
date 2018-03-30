<?php

return array(
	'icon'   => 'el el-cog',
	'title'  => __( 'General', 'BERG' ),
	'fields' => array(

		array(
			'id' => 'theme_google_analytics',
			'type' => 'textarea',
			'title' => __('Google Analytics script code', 'BERG'),
			'default' => '',
			'htmlOptions' => array('style'=>'height:100px;')
		),
		array(
			'id' => 'remove_wp_version',
			'type' => 'checkbox',
			'title' => __('Hide WP version', 'BERG'),
			'default' => '',
			'htmlOptions' => array()
		),
		array(
			'id' => 'disable_smooth_scroll',
			'type' => 'checkbox',
			'title' => __('Disable Smooth Scroll', 'BERG'),
			'default' => '0',
			'htmlOptions' => array()
		),

		array(
		    'id'   =>'berg_permalinks_divide',
		    'title' => __('Permalinks', 'BERG'),
		    'type' => 'divide'
		),

		array(
			'id' => 'theme_permalink_berg_menu',
			'type' => 'text',
			'title' => __('Food menu permalink slug', 'BERG'),
			'default' => 'menu',
			'subtitle' => __('Only a-z 0-9 _- characters allowed. Need permalinks to be re-generated', 'BERG'),
			'regexp' => 'a-Z0-9_\-',
			'htmlOptions' => array()
		),
		array(
			'id' => 'theme_permalink_berg_menu_category',
			'type' => 'text',
			'title' => __('Food menu category permalink slug', 'BERG'),
			'subtitle' => __('Only a-z 0-9 _- characters allowed. Need permalinks to be re-generated', 'BERG'),
			'default' => 'menu-category',
			'regexp' => 'a-Z0-9_\-',
			'htmlOptions' => array()
		),
		array(
			'id' => 'theme_permalink_berg_restaurant',
			'type' => 'text',
			'title' => __('Vertical slider permalink slug', 'BERG'),
			'default' => 'slider',
			'subtitle' => __('Only a-z 0-9 _- characters allowed. Need permalinks to be re-generated', 'BERG'),
			'regexp' => 'a-Z0-9_\-',
			'htmlOptions' => array()
		),
		array(
			'id' => 'theme_permalink_berg_portfolio',
			'type' => 'text',
			'title' => __('Portfolio permalink slug', 'BERG'),
			'subtitle' => __('Only a-z 0-9 _- characters allowed. Need permalinks to be re-generated', 'BERG'),
			'default' => 'portfolios',
			'regexp' => 'a-Z0-9_\-',
			'htmlOptions' => array()
		)
	),
);
