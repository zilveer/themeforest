<?php

return array(
	'icon'   => 'el el-minus',
	'title'  => __( 'Footer', 'BERG' ),
	'fields' => array(
		array(
			'id' => 'berg_footer_settings',
			'type' => 'checkbox',
			'title' => __('Enable footer', 'BERG'),
			'default' => 1
		),
		array(
			'id' => 'show_go_to_top_arrow',
			'type' => 'checkbox',
			'title' => __('Show "back to top" icon in footer', 'BERG'),
			'default' => '1',
			'htmlOptions' => array()
		)

	)
);