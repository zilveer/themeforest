<?php
function multipurpose_customize_register_sidebar($wp_customize) {
	$wp_customize->add_section('sidebars', array(
		'title' => esc_attr__('Sidebar', 'multipurpose'),
		'priority' => 25
	));
	$wp_customize->add_setting('sidebar_pos_archive', array('default' => 0));
	$wp_customize->add_control('sidebar_pos_archive', array(
		'label' => esc_attr__('Sidebar on Archive Pages', 'multipurpose'),
		'section' => 'sidebars',
		'settings' => 'sidebar_pos_archive', 
		'type' => 'select',
		'choices' => array(
			0 => esc_attr__('Right (default)', 'multipurpose'),
			1 => esc_attr__('Left', 'multipurpose'),
			2 => esc_attr__('No sidebar', 'multipurpose')
		)
	));
	$wp_customize->add_setting('sidebar_pos_blog', array('default' => 0));
	$wp_customize->add_control('sidebar_pos_blog', array(
		'label' => esc_attr__('Sidebar on Blog Page', 'multipurpose'),
		'section' => 'sidebars',
		'settings' => 'sidebar_pos_blog', 
		'type' => 'select',
		'choices' => array(
			0 => esc_attr__('Right (default)', 'multipurpose'),
			1 => esc_attr__('Left', 'multipurpose'),
			2 => esc_attr__('No sidebar', 'multipurpose')
		)
	));
	$wp_customize->add_setting('sidebar_pos_post', array('default' => 0));
	$wp_customize->add_control('sidebar_pos_post', array(
		'label' => esc_attr__('Sidebar on Single Post Pages', 'multipurpose'),
		'section' => 'sidebars',
		'settings' => 'sidebar_pos_post', 
		'type' => 'select',
		'choices' => array(
			0 => esc_attr__('Right (default)', 'multipurpose'),
			1 => esc_attr__('Left', 'multipurpose'),
			2 => esc_attr__('No sidebar', 'multipurpose')
		)
	));
	$wp_customize->add_setting('sidebar_pos_page', array('default' => 0));
	$wp_customize->add_control('sidebar_pos_page', array(
		'label' => esc_attr__('Sidebar on Pages', 'multipurpose'),
		'section' => 'sidebars',
		'settings' => 'sidebar_pos_page', 
		'type' => 'select',
		'choices' => array(
			0 => esc_attr__('Right (default)', 'multipurpose'),
			1 => esc_attr__('Left', 'multipurpose'),
			2 => esc_attr__('No sidebar', 'multipurpose')
		)
	));
	$wp_customize->add_setting('sidebar_pos_search', array('default' => 0));
	$wp_customize->add_control('sidebar_pos_search', array(
		'label' => esc_attr__('Sidebar on Search Results Page', 'multipurpose'),
		'section' => 'sidebars',
		'settings' => 'sidebar_pos_search', 
		'type' => 'select',
		'choices' => array(
			0 => esc_attr__('Right (default)', 'multipurpose'),
			1 => esc_attr__('Left', 'multipurpose'),
			2 => esc_attr__('No sidebar', 'multipurpose')
		)
	));
}

add_action('customize_register', 'multipurpose_customize_register_sidebar');