<?php
        $wp_manager->add_section( 'df_customizer_favicon_section', array(
         'title'    => __('Favicon', 'woothemes'),
         'priority' => 40,
         ));

        $wp_manager->add_setting( 'df_retina_favicon_description' );
   
        $wp_manager->add_control( new Text_Description_Custom_Control( $wp_manager, 'df_retina_favicon_description', array(
              'label'    => __( 'A favicon is a 16x16 pixel icon that represents your site; upload your custom Favicon here.', 'woothemes' ),
              'section'  => 'df_customizer_favicon_section',
              'settings' => 'df_retina_favicon_description',
              'priority' => 5
            ))
          ); 

        /* Favicon */
        $wp_manager->add_setting( 'df_options[custom_favicon]', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'df_options[custom_favicon]', array(
            'label'   => __('Favicon (16x16 pixel)', 'woothemes'),
            'section' => 'df_customizer_favicon_section',
            'settings'   => 'df_options[custom_favicon]',
            'priority' => 10
        ) ) );
        
        /* iPhone */
        $wp_manager->add_setting( 'df_options[custom_favicon_iphone]', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'df_options[custom_favicon_iphone]', array(
            'label'   => __('Favicon iPhone (57x57 pixel)', 'woothemes'),
            'section' => 'df_customizer_favicon_section',
            'settings'   => 'df_options[custom_favicon_iphone]',
            'priority' => 15
        ) ) );

        /* iPhone Retina*/
        $wp_manager->add_setting( 'df_options[custom_favicon_iphone_retina]', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'df_options[custom_favicon_iphone_retina]', array(
            'label'   => __('Favicon iPhone Retina (144x144 pixel)', 'woothemes'),
            'section' => 'df_customizer_favicon_section',
            'settings'   => 'df_options[custom_favicon_iphone_retina]',
            'priority' => 20
        ) ) );

        /* iPad */
        $wp_manager->add_setting( 'df_options[custom_favicon_ipad]', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'df_options[custom_favicon_ipad]', array(
            'label'   => __('Favicon iPad (72x72 pixel)', 'woothemes'),
            'section' => 'df_customizer_favicon_section',
            'settings'   => 'df_options[custom_favicon_ipad]',
            'priority' => 25
        ) ) );

        /* iPad Retina */
        $wp_manager->add_setting( 'df_options[custom_favicon_ipad_retina]', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( new WP_Customize_Image_Control( $wp_manager, 'df_options[custom_favicon_ipad_retina]', array(
            'label'   => __('Favicon iPad Retina (144x144 pixel)', 'woothemes'),
            'section' => 'df_customizer_favicon_section',
            'settings'   => 'df_options[custom_favicon_ipad_retina]',
            'priority' => 30
        ) ) );