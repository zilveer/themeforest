<?php

add_ux_builder_shortcode( 'page_title', array(
  'name' => __( 'Page Title' ),
  'type' => 'container',
  'category' => __( 'Layout' ),
  'wrap' => false,
  'thumbnail' =>  flatsome_ux_builder_thumbnail( 'page_title' ),
  'allow' => array('ux_the_title','ux_excerpt','ux_subnav','ux_breadcrumbs','ux_play','divider','button','text','ux_image','follow','share'),
  'presets' => array(
    array(
      'name' => __( 'Simple' ),
      'thumbnail' =>  $presets . 'page_title/simple-left.svg',
      'content' => '[page_title][/page_title]',
    ),
    array(
      'name' => __( 'Simple Left'),
      'thumbnail' =>  $presets . 'page_title/simple-left.svg',
      'content' => '[page_title layout="center"][/page_title]',
    ),
    array(
      'name' => __( 'Simple Center'),
      'thumbnail' =>  $presets . 'page_title/simple-center.svg',
      'content' => '[page_title layout="center"][/page_title]',
    )
  ),
  'options' => array(

    'layout_options' => array(
      'type' => 'group',
      'heading' => __( 'Layout' ),
      'options' => array(
        'layout' => array(
            'type' => 'radio-buttons',
            'heading' => 'Layout',
            'default' => 'left',
            'full_width' => true,
            'options' => array(
              'left'  => array( 'title' => 'Left'),
              'center'   => array( 'title' => 'Center'),
              'stretch'  => array( 'title' => 'Stretch'),
            ),
        ),
        'align' => array(
            'type' => 'radio-buttons',
            'heading' => 'Align',
            'default' => 'middle',
            'full_width' => true,
            'options' => array(
              'top'  => array( 'title' => 'Top'),
              'middle'   => array( 'title' => 'Middle'),
              'bottom'  => array( 'title' => 'Bottom'),
            ),
        ),
        'height' => array(
          'type' => 'scrubfield',
          'heading' => __('Height'),
          'default' => '100px',
          'min' => 0,
          'max' => 1000,
          'step' => 1,
        ),
        'color' => array(
            'type' => 'radio-buttons',
            'heading' => 'Color',
            'default' => '',
            'options' => array(
                'light'   => array( 'title' => 'Light'),
                ''  => array( 'title' => 'Dark'),
            ),
        ),
        'margin' => array(
          'type' => 'scrubfield',
          'heading' => __('Margin'),
          'default' => '0px',
          'min' => 0,
          'max' => 300,
          'step' => 1,
        ),
        'padding' => array(
          'type' => 'scrubfield',
          'heading' => __('Padding'),
          'default' => '',
          'min' => 0,
          'max' => 100,
          'step' => 1,
        ),
      ),
    ),// Layout

    'background_options' => array(
      'type' => 'group',
      'heading' => __( 'Background' ),
      'options' => array(
        'bg_type' => array(
            'type' => 'radio-buttons',
            'heading' => 'Bg Type',
            'default' => 'blank',
            'options' => array(
              'blank'  => array( 'title' => 'Blank'),
              'featured'  => array( 'title' => 'Featured'),
              'image'  => array( 'title' => 'Custom Image'),
            ),
        ),
        'bg' => array(
          'type' => 'image',
          'heading' => __( 'Image' ),
          'conditions' => 'bg_type == "image"',
        ),
        'bg_color' => array(
          'type' => 'colorpicker',
          'heading' => __('Color'),
          'format' => 'rgb',
          'position' => 'bottom right',
          'helpers' => require( __DIR__ . '/helpers/colors.php' ),
        ),
        'bg_overlay' => array(
          'type' => 'colorpicker',
          'heading' => __('Overlay'),
          'default' => 'rgba(0, 0, 0, 0.3)',
          'alpha' => true,
          'format' => 'rgb',
          'conditions' => 'bg_type == "featured" || bg_type == "image"',
          'position' => 'bottom right',
          'helpers' => require( __DIR__ . '/helpers/colors-overlay.php' ),
        ),
        'parallax' => array(
            'type' => 'slider',
            'heading' => 'Parallax',
            'param_name' => 'parallax',
            'group' => 'Parallax',
            'unit' => '+',
            'default' => 0,
            'max' => 10,
            'min' => 0,
        ),
      ),
    ), //background

    'title_options' => array(
      'type' => 'group',
      'heading' => __( 'Title' ),
      'options' => array(
        'title' => array(
            'type' => 'textfield',
            'heading' => 'Title',
            'description' => 'Leave blank to use default Page Title'
        ),
        'title_size' => array(
          'type' => 'scrubfield',
          'heading' => __('Title Size'),
          'description' => 'F.ex 3em or 42px',
          'default' => '',
          'min' => 0,
          'max' => 300,
          'step' => 1,
        ),
        'subtitle' => array(
            'type' => 'textfield',
            'heading' => 'Sub Title',
            'description' => 'Leave blank to use default Sub Title'
        ),
        'subtitle_size' => array(
          'type' => 'scrubfield',
          'heading' => __('Sub Title Size'),
          'description' => 'F.ex 3em or 42px',
          'default' => '',
          'min' => 0,
          'max' => 300,
          'step' => 1,
        ),
      ),
    ),// Title
  )
) );
