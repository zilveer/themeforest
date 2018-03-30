<?php
// function drawSystemInfo() {
// 	require_once THEME_INCLUDES . '/sys-info.php';

	

// 	echo '<div id="system_info_default_section_group' . '">';

// 	echo '<div id="redux-system-info">';
// 	echo $system_info->get( true );
// 	echo '</div>';

// 	echo '</div>';
// }
return array(
	'icon'   => 'el el-question',
	'title'  => __( 'System info', 'BERG' ),
	'fields' => array(
		array(
			'id' => 'system_info',
			'type' => 'system_info',
			'class' => 'system-info',
		),
	)
);