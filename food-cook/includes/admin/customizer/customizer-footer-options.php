<?php
/**==========================================================
* Footer Options Sections
*==========================================================**/
    	$wp_manager->add_section( 'df_customizer_footer_section', array(
         'title'    => __('Footer', 'woothemes'),
         'priority' => 15,
         ));

    	$wp_manager->add_setting( 'df_footer_widget_areas_description' );
   
        $wp_manager->add_control( new Text_Description_Custom_Control( $wp_manager, 'df_footer_widget_areas_description', array(
              'label'    => __( 'Select how many footer widget areas you want to display.',  'woothemes' ),
              'section'  => 'df_customizer_footer_section',
              'settings' => 'df_footer_widget_areas_description',
              'priority' => 5
            ))
          ); 

    	 $wp_manager->add_setting( 'df_options[footer_sidebars]', array(
          'default' => '4'
          ) );

        $wp_manager->add_control( new Layout_Picker_Custom_Control( $wp_manager, 'df_options[footer_sidebars]', array(
          'label'    => __('Footer Widget Areas', 'woothemes'),
          'section'  => 'df_customizer_footer_section',
          'settings' => 'df_options[footer_sidebars]',
          'type'     => 'images_radio',
          'choices'  => array(
                        '0' => $url . 'layout-off.png',
                        '1' => $url . 'footer-widgets-1.png',
                        '2' => $url . 'footer-widgets-2.png',
                        '3' => $url . 'footer-widgets-3.png',
                        '4' => $url . 'footer-widgets-4.png'),
          'priority' => 10
          ))
        );
        
        $wp_manager->add_setting( 'df_options[footer_left]', array(
            'default'        => 0,
        ) );

        $wp_manager->add_control( 'df_options[footer_left]', array(
            'label'   => __('Enable Custom Footer (Left)', 'woothemes'),
            'section' => 'df_customizer_footer_section',
            'type'    => 'checkbox',
            'priority' => 15
        ) );

        $wp_manager->add_setting( 'df_options[footer_left_text]', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( 'df_options[footer_left_text]', array(
            'label'   => __('Footer Custom Text (Left)', 'woothemes'),
            'section' => 'df_customizer_footer_section',
            'type'    => 'text',
            'priority' => 20
        ) );

        $wp_manager->add_setting( 'df_options[footer_right]', array(
            'default'        => 0,
        ) );

        $wp_manager->add_control( 'df_options[footer_right]', array(
            'label'   => __('Enable Custom Footer (Right)', 'woothemes'),
            'section' => 'df_customizer_footer_section',
            'type'    => 'checkbox',
            'priority' => 25
        ) );

        $wp_manager->add_setting( 'df_options[footer_right_text]', array(
            'default'        => '',
        ) );

        $wp_manager->add_control( 'df_options[footer_right_text]', array(
            'label'   => __('Footer Custom Text (Right)', 'woothemes'),
            'section' => 'df_customizer_footer_section',
            'type'    => 'text',
            'priority' => 30
        ) );