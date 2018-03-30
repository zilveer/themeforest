<?php

return array(
	'icon'   => 'el el-file-new',
	'title'  => __( 'Custom CSS', 'BERG' ),
	'subsection' => true,
	'fields' => array(
		array(
			'id' => 'theme_custom_css',
			'type' => 'textarea',
			'title' => __('Custom CSS', 'BERG'),
			'default' => '',
			'htmlOptions' => array('style'=>'height:400px;')
		)
	)
);