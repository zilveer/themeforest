<?php

add_ux_builder_shortcode( 'title', array(
    'name' => __( 'Title' ),
    'category' => __( 'Content' ),
    'thumbnail' =>  flatsome_ux_builder_thumbnail( 'title' ),
    'template' => flatsome_ux_builder_template( 'title.html' ),
    'info' => '{{ text }}',
    'wrap' => false,

    'options' => array(

        'style' => array(
            'type' => 'select',
            'heading' => 'Style',
            'default' => 'normal',
            'options' => array(
                'normal' => 'Normal',
                'center' => 'Center',
                'bold' => 'Left Bold',
                'bold-center' => 'Center Bold',
            )
        ),

        'text' => array(
            'type' => 'textfield',
            'heading' => 'Title',
            'default' => 'Lorem ipsum dolor sit amet...',
            'auto_focus' => true,
        ),

        'icon' => array(
            'type' => 'select',
            'heading' => 'Icon',
            'options' => require( __DIR__ . '/values/icons.php' ),
        ),
        
        'margin_top' => array(
          'type' => 'scrubfield',
          'heading' => __('Margin Top'),
          'default' => '',
          'placeholder' => __('0px'),
          'min' => -100,
          'max' => 300,
          'step' => 1,
        ),

        'margin_bottom' => array(
          'type' => 'scrubfield',
          'heading' => __('Margin Bottom'),
          'default' => '',
          'placeholder' => __('0px'),
          'min' => -100,
          'max' => 300,
          'step' => 1,
        ),

        'size' => array(
          'type' => 'slider',
          'heading' => __('Size'),
          'default' => 100,
          'unit' => '%',
          'min' => 20,
          'max' => 300,
          'step' => 1,
        ),

        'link_text' => array(
            'type' => 'textfield',
            'heading' => 'Link Text',
            'default' => '',
        ),

        'link' => array(
            'type' => 'textfield',
            'heading' => 'Link',
            'default' => '',
        ),
    ),
) );
