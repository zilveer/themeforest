<?php

//======================================================================
// Social Connect
//======================================================================
        $wp_manager->add_section( 'df_customizer_social_section', array(
            'title'    => __( 'Connect', 'woothemes' ),
            'priority' => 30
        ));

        $wp_manager->add_setting( 'df_options[connect_facebook]', array(
          'default' => ''
        ));

        $wp_manager->add_control( 'df_options[connect_facebook]', array(
          'type'     => 'text',
          'label'    => __('Facebook URL', 'woothemes' ),
          'section'  => 'df_customizer_social_section',
          'priority' => 20
        ));

        $wp_manager->add_setting( 'df_options[connect_twitter]', array(
          'default' => ''
        ));

        $wp_manager->add_control( 'df_options[connect_twitter]', array(
          'type'     => 'text',
          'label'    => __( 'Twitter URL', 'woothemes' ),
          'section'  => 'df_customizer_social_section',
          'priority' => 30
        ));

        $wp_manager->add_setting( 'df_options[connect_googleplus]', array(
          'default' => ''
        ));

        $wp_manager->add_control( 'df_options[connect_googleplus]', array(
          'type'     => 'text',
          'label'    => __( 'Google+ URL',  'woothemes' ),
          'section'  => 'df_customizer_social_section',
          'priority' => 40
        ));

        $wp_manager->add_setting( 'df_options[connect_youtube]', array(
          'default' => ''
        ));

        $wp_manager->add_control( 'df_options[connect_youtube]', array(
          'type'     => 'text',
          'label'    => __( 'YouTube URL',  'woothemes' ),
          'section'  => 'df_customizer_social_section',
          'priority' => 50
        ));

        $wp_manager->add_setting( 'df_options[connect_instagram]', array(
          'default' => ''
        ));

        $wp_manager->add_control( 'df_options[connect_instagram]', array(
          'type'     => 'text',
          'label'    => __( 'Instagram URL',  'woothemes' ),
          'section'  => 'df_customizer_social_section',
          'priority' => 70
        ));

        $wp_manager->add_setting( 'df_options[connect_pinterest]', array(
          'default' => ''
        ));

        $wp_manager->add_control( 'df_options[connect_pinterest]', array(
          'type'     => 'text',
          'label'    => __( 'Pinterest URL', 'woothemes' ),
          'section'  => 'df_customizer_social_section',
          'priority' => 80
        ));

        $wp_manager->add_setting( 'df_options[connect_flickr]', array(
          'default' => ''
        ));

        $wp_manager->add_control( 'df_options[connect_flickr]', array(
          'type'     => 'text',
          'label'    => __( 'Flickr URL', 'woothemes' ),
          'section'  => 'df_customizer_social_section',
          'priority' => 90
        ));

        $wp_manager->add_setting( 'df_options[connect_linkedin]', array(
          'default' => ''
        ));

        $wp_manager->add_control( 'df_options[connect_linkedin]', array(
          'type'     => 'text',
          'label'    => __( 'LinkedIn URL',  'woothemes' ),
          'section'  => 'df_customizer_social_section',
          'priority' => 100
        ));

        $wp_manager->add_setting( 'df_options[connect_rss]');

        $wp_manager->add_control( 'df_options[connect_rss]', array(
          'type'     => 'checkbox',
          'label'    => __( 'Enable RSS',  'woothemes' ),
          'section'  => 'df_customizer_social_section',
          'priority' => 10
        ));

