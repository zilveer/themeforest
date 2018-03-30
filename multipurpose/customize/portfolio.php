<?php
function multipurpose_customize_register_portfolio($wp_customize) {
	$wp_customize->add_section('portfolio', array(
		'title' => esc_attr__('Portfolio', 'multipurpose'),
		'priority' => 40
	));

	$wp_customize->add_setting('portfolio_layout', array('default' => 4));
	$wp_customize->add_control('portfolio_layout', array(
    'priority' => 0,
		'label' => esc_attr__('Portfolio layout', 'multipurpose'),
		'section' => 'portfolio',
		'settings' => 'portfolio_layout', 
		'type' => 'radio',
		'choices' => array(
			1 => esc_attr__('One column', 'multipurpose'),
			2 => esc_attr__('Two columns', 'multipurpose'),
			3 => esc_attr__('Three columns', 'multipurpose'),
			4 => esc_attr__('Four columns', 'multipurpose'),
      5 => esc_attr__('Four columns masonry', 'multipurpose')
		)
	));

	$wp_customize->add_setting('project_layout', array('default' => 'project_decide'));
	$wp_customize->add_control('project_layout', array(
    'priority' => 5,
		'label' => esc_attr__('Project layout', 'multipurpose'),
		'section' => 'portfolio',
		'settings' => 'project_layout', 
		'type' => 'radio',
		'choices' => array(
			'full' => esc_attr__('Full width project image', 'multipurpose'),
			'half' => esc_attr__('Half page project image', 'multipurpose'),
			'project_decide' => esc_attr__('As set in each project', 'multipurpose')
		)
	));

  
	$wp_customize->add_setting('projects_per_page4', array('default' => 12));
	$wp_customize->add_control(
       new WP_Customize_Control($wp_customize, 'projects_per_page4', array(
              'priority' => 10,
              'label'          => esc_attr__( 'Projects per page (4 columns)', 'multipurpose' ),
              'section'        => 'portfolio',
              'settings'       => 'projects_per_page4'
           )
       )
   	);
  $wp_customize->add_setting('projects_per_page3', array('default' => 12));
	$wp_customize->add_control(
       new WP_Customize_Control($wp_customize, 'projects_per_page3', array(
              'priority' => 15,
               'label'          => esc_attr__( 'Projects per page (3 columns)', 'multipurpose' ),
               'section'        => 'portfolio',
               'settings'       => 'projects_per_page3'
           )
       )
   	);
   	$wp_customize->add_setting('projects_per_page2', array('default' => 10));
	$wp_customize->add_control(
       new WP_Customize_Control($wp_customize, 'projects_per_page2', array(
               'priority' => 20,
               'label'          => esc_attr__( 'Projects per page (2 columns)', 'multipurpose' ),
               'section'        => 'portfolio',
               'settings'       => 'projects_per_page2'
           )
       )
   	);
   	$wp_customize->add_setting('projects_per_page1', array('default' => 10));
	$wp_customize->add_control(
       new WP_Customize_Control($wp_customize, 'projects_per_page1', array(
               'priority' => 25,
               'label'          => esc_attr__( 'Projects per page (1 column)', 'multipurpose' ),
               'section'        => 'portfolio',
               'settings'       => 'projects_per_page1'
           )
       )
   	);
  $wp_customize->add_setting('projects_per_page_masonry', array('default' => 12));
  $wp_customize->add_control(
       new WP_Customize_Control($wp_customize, 'projects_per_page_masonry', array(
               'priority' => 30,
               'label'          => esc_attr__( 'Projects per page (4 columns masonry)', 'multipurpose' ),
               'section'        => 'portfolio',
               'settings'       => 'projects_per_page_masonry'
           )
       )
    );

   	$wp_customize->add_setting('project_slug', array('default' => 'portfolio'));
	$wp_customize->add_control(
       new WP_Customize_Control($wp_customize, 'project_slug', array(
               'priority' => 35,
               'label'          => esc_attr__( 'Project page slug', 'multipurpose' ),
               'section'        => 'portfolio',
               'settings'       => 'project_slug'
           )
       )
   	);

}

add_action('customize_register', 'multipurpose_customize_register_portfolio');