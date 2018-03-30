<?php
function getMobilePages() {
	$pages = get_pages(array(
		'meta_key' => '_wp_page_template',
		'meta_value' => 'mobilehomepage.php'
	));

	$dropdown = array(0 => __('None', 'BERG'));

	foreach($pages as $page) {
		$dropdown[$page->ID] = $page->post_title;
	}

	return $dropdown; 
}
$mobileHomePage = getMobilePages();

return array(
	'icon'   => 'el el-resize-small',
	'title'  => __( 'Mobile settings', 'BERG' ),
	'subsection' => true,
	'fields' => array(
		array(
			'id'=>'mobile_homepage',
			'type' => 'select',
			'title' => __('Select mobile homepage', 'BERG'),
			'selected' => YSettings::g('mobile_homepage', 0),
			'select2'  => array( 'allowClear' => false ),
			'options' => $mobileHomePage,
			'default' => 0,
			'class' => 'hidden',
		),
		array(
			'id'=>'mobile_homepage_logo_width',
			'type' => 'text',
			'title' => __('Mobile logo width in percent (%)', 'BERG'),
			'default' => '100'
		),
		array(
			'id' => 'mobile_sticky_navigation',
			'type' => 'checkbox',
			'title' => __('Enable sticky navigation', 'BERG'),
			'default' => '0',
			'htmlOptions' => array()
		),
	),
);