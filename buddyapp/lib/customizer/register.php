<?php

// =============================================================================
// register.php
// -----------------------------------------------------------------------------
// Sets up the options to be used in the Customizer.
// =============================================================================

// =============================================================================
// TABLE OF CONTENTS
// -----------------------------------------------------------------------------
//   01. Register Options
// =============================================================================

// Register Options
// =============================================================================

function kleo_customizer_options_register( $wp_customize ) {


    //
    // Prepare all the data
    //

    $kleo = apply_filters( 'kleo_theme_settings', array() );


    //
    // Output - Panels.
    //


    if (isset($kleo['panels'])) {

        foreach ($kleo['panels'] as $key => $panel) {

            $wp_customize->add_panel( $key, array(
                'title' => $panel['title'],
                'description' => isset($panel['description']) ? $panel['description'] : "", // Include html tags such as <p>.
                'priority' => $panel['priority'], // Mixed with top-level-section hierarchy.
            ));

        }

    }



    //
    // Output - Sections.
    //

    foreach ( $kleo['sec'] as $key => $section ) {

        $wp_customize->add_section( $key, array(
            'title' => $section['title'],
            'priority' => $section['priority'],
            'panel' => isset($section['panel']) ? $section['panel'] : null
        ));

    }

    //
    // Output - Settings & Controls.
    //

    foreach ( $kleo['set'] as $control ) {

        // go to next options if this is not for the customizer
        if ( ! isset( $control['customizer'] ) || $control['customizer'] === false ) {
            continue;
        }

        static $i = 1;

        //add setting
        $wp_customize->add_setting( $control['id'], array(
            'default' => $control['default'],
            'transport' => $control['transport'],
            'sanitize_callback' => isset($control['sanitize_callback']) ? $control['sanitize_callback'] : null
        ));


        //add control
        if ($control['type'] == 'radio') {

            $wp_customize->add_control($control['id'], array(
                'type' => $control['type'],
                'label' => $control['title'],
                'section' => $control['section'],
                'priority' => $i,
                'choices' => $control['choices']
            ));

        } elseif ($control['type'] == 'select') {

            $wp_customize->add_control(
                new KLEO_Customize_Select($wp_customize, $control['id'], array(
                'type' => $control['type'],
                'label' => $control['title'],
                'section' => $control['section'],
                'priority' => $i,
                'choices' => $control['choices'],
                'description' => isset( $control['description'] ) ? $control['description']: NULL,
                'condition' => isset( $control['condition'] ) ? $control['condition']: NULL,
                ))
            );

        } elseif ($control['type'] == 'multi-select') {

            $wp_customize->add_control(
                new KLEO_Customize_MultiSelect($wp_customize, $control['id'], array(
                    'label' => $control['title'],
                    'section' => $control['section'],
                    'priority' => $i,
                    'choices' => $control['choices'],
                    'description' => isset( $control['description'] ) ? $control['description']: NULL,
                    'condition' => isset( $control['condition'] ) ? $control['condition']: NULL,
                ))
            );
        } elseif ($control['type'] == 'slider') {

            $wp_customize->add_control(
                new KLEO_Customize_Control_Slider($wp_customize, $control['id'], array(
                    'label' => $control['title'],
                    'section' => $control['section'],
                    'settings' => $control['id'],
                    'priority' => $i,
                    'choices' => $control['choices'],
                    'description' => isset( $control['description'] ) ? $control['description']: NULL,
                    'condition' => isset( $control['condition'] ) ? $control['condition']: NULL,
                ))
            );

        } elseif ($control['type'] == 'switch') {

            $wp_customize->add_control(
                new KLEO_Customize_Control_Switch($wp_customize, $control['id'], array(
                    'type' => $control['type'],
                    'label' => $control['title'],
                    'section' => $control['section'],
                    'priority' => $i,
                    'description' => isset( $control['description'] ) ? $control['description']: NULL,
                    'condition' => isset( $control['condition'] ) ? $control['condition']: NULL,
                ))
            );

        } elseif ($control['type'] == 'radio-image') {

            $wp_customize->add_control(
                new KLEO_Customize_Control_Radio_Image($wp_customize, $control['id'], array(
                    'type' => $control['type'],
                    'label' => $control['label'],
                    'section' => $control['section'],
                    'priority' => $i,
                    'choices' => $control['choices'],
                    'description' => isset( $control['description'] ) ? $control['description']: NULL,
                    'condition' => isset( $control['condition'] ) ? $control['condition']: NULL
                ))
            );

        } elseif ($control['type'] == 'textarea') {

            $wp_customize->add_control(
                new KLEO_Customize_Control_Textarea($wp_customize, $control['id'], array(
                    'label' => $control['title'],
                    'section' => $control['section'],
                    'priority' => $i,
                    'description' => isset( $control['description'] ) ? $control['description']: NULL,
                    'condition' => isset( $control['condition'] ) ? $control['condition']: NULL
                ))
            );

        } elseif ($control['type'] == 'checkbox') {

            $wp_customize->add_control($control['id'], array(
                'type' => $control['type'],
                'label' => $control['title'],
                'section' => $control['section'],
                'priority' => $i
            ));

        } elseif ($control['type'] == 'color') {

            $wp_customize->add_control(
                new WP_Customize_Color_Control($wp_customize, $control['id'], array(
                    'label' => $control['title'],
                    'section' => $control['section'],
                    'priority' => $i
                ))
            );

        } elseif ($control['type'] == 'image') {

            $wp_customize->add_control(
                new WP_Customize_Image_Control($wp_customize, $control['id'], array(
                    'label' => $control['title'],
                    'section' => $control['section'],
                    'priority' => $i,
                    'description' => isset( $control['description'] ) ? $control['description']: NULL,
                ))
            );
        } elseif ($control['type'] == 'media') {

            $wp_customize->add_control(
                new WP_Customize_Media_Control($wp_customize, $control['id'], array(
                    'label' => $control['title'],
                    'section' => $control['section'],
                    'settings' => $control['id'],
                    'priority' => $i,
                    'description' => isset( $control['description'] ) ? $control['description']: NULL,
                ))
            );
        } elseif ($control['type'] == 'upload') {

            $wp_customize->add_control(
                new WP_Customize_Upload_Control($wp_customize, $control['id'], array(
                    'label' => $control['title'],
                    'section' => $control['section'],
                    'priority' => $i,
                    'description' => isset( $control['description'] ) ? $control['description']: NULL,
                ))
            );

        } elseif ($control['type'] == 'text') {

            $wp_customize->add_control(
                new KLEO_Customize_Control_Text($wp_customize, $control['id'], array(
                    'label' => $control['title'],
                    'section' => $control['section'],
                    'priority' => $i,
                    'description' => isset( $control['description'] ) ? $control['description']: NULL,
                    'condition' => isset( $control['condition'] ) ? $control['condition']: NULL,
                ))
            );
        }
        elseif ($control['type'] == 'gfont') {

            $wp_customize->add_control(
                new KLEO_Customize_Google_Font_Select($wp_customize, $control['id'], array(
                    'label' => $control['title'],
                    'section' => $control['section'],
                    'priority' => $i,
                    'description' => isset( $control['description'] ) ? $control['description']: NULL,
                    'condition' => isset( $control['condition'] ) ? $control['condition']: NULL,
                ))
            );
        }

        $i++;

    }

}

add_action( 'customize_register', 'kleo_customizer_options_register' );
