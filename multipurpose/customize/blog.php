<?php
function multipurpose_customize_register_blog($wp_customize) {
	$wp_customize->add_section('blog', array(
		'title' => esc_attr__('Blog', 'multipurpose'),
		'priority' => 35
	));
	$wp_customize->add_setting('archive_layout', array(
		'default' => 0
	));
	$wp_customize->add_control('archive_layout', array(
		'label' => esc_attr__('Archive page layout', 'multipurpose'),
		'section' => 'blog',
		'settings' => 'archive_layout', 
		'type' => 'select',
		'choices' => array(
			0 => esc_attr__('Post list with large images (default)', 'multipurpose'),
			1 => esc_attr__('Full width post list', 'multipurpose'),
			2 => esc_attr__('Post list with medium images', 'multipurpose'),
			3 => esc_attr__('Post list with exposed date', 'multipurpose'),
			4 => esc_attr__('3 columns', 'multipurpose'),
			5 => esc_attr__('2 columns', 'multipurpose'),
			6 => esc_attr__('Full width masonry', 'multipurpose'),
			7 => esc_attr__('Masonry with sidebar', 'multipurpose')
		)
	));

	$wp_customize->add_setting('show_post_author', array(
		'default' => 0
	));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'show_post_author',
        array(
            'label'     => esc_attr__('Disable post author on post page', 'multipurpose'),
            'section'   => 'blog',
            'settings'  => 'show_post_author',
            'type'      => 'checkbox'
        )
	));
	$wp_customize->add_setting('show_related', array(
		'default' => 0
	));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'show_related',
        array(
            'label'     => esc_attr__('Disable related posts on post page', 'multipurpose'),
            'section'   => 'blog',
            'settings'  => 'show_related',
            'type'      => 'checkbox'
        )
	));

	$wp_customize->add_setting('share_links', array('default' => 2));
	$wp_customize->add_control('share_links', array(
		'label' => esc_attr__('Disable default sharing links', 'multipurpose'),
		'section' => 'blog',
		'settings' => 'share_links', 
		'type' => 'select',
		'choices' => array(
			1 => esc_attr__('Yes', 'multipurpose'),
			2 => esc_attr__('No', 'multipurpose')
		)
	));

	$wp_customize->add_setting('share_links_facebook', array('default' => 0));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'share_links_facebook',
        array(
            'label'     => esc_attr__('Disable Facebook', 'multipurpose'),
            'section'   => 'blog',
            'settings'  => 'share_links_facebook',
            'type'      => 'checkbox'
        )
	));
	$wp_customize->add_setting('share_links_twitter', array('default' => 0));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'share_links_twitter',
        array(
            'label'     => esc_attr__('Disable Twitter', 'multipurpose'),
            'section'   => 'blog',
            'settings'  => 'share_links_twitter',
            'type'      => 'checkbox'
        )
	));
	$wp_customize->add_setting('share_links_googleplus', array('default' => 0));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'share_links_googleplus',
        array(
            'label'     => esc_attr__('Disable Google +', 'multipurpose'),
            'section'   => 'blog',
            'settings'  => 'share_links_googleplus',
            'type'      => 'checkbox'
        )
	));
	$wp_customize->add_setting('share_links_pinterest', array('default' => 0));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'share_links_pinterest',
        array(
            'label'     => esc_attr__('Disable Pinterest', 'multipurpose'),
            'section'   => 'blog',
            'settings'  => 'share_links_pinterest',
            'type'      => 'checkbox'
        )
	));
}

add_action('customize_register', 'multipurpose_customize_register_blog');