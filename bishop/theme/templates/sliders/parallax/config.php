<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Configuration of this portfolio layout
 *
 * @var $this \YIT_CPT_Unlimited The object
 */

//if ( ! YIT_Mobile()->isMobile() ) $this->enqueue_style( 'animate', 'css/animate.css' );
$this->enqueue_style( 'prettyPhoto', 'css/prettyPhoto.css' );
$this->enqueue_script( 'owl-carousel');
$this->enqueue_script( 'jquery-parallax', 'js/jquery.parallax.js', array('jquery') );
$this->enqueue_script( 'prettyPhoto', 'js/jquery.prettyPhoto.min.js', array('jquery') );

// remove description field for the slide configuration
$this->add_description_field( 'yes' );

$this->add_layout_fields( array(

    'width'      => array(
        'label' => __( 'Width content', 'yit' ),
        'type'  => 'number',
        'desc'  => __( 'Select the width of container (select 0 if you want to have the same width of site container).', 'yit' ),
        'min'   => 0,
        'max'   => 2000,
        'std'   => 0
    ),

    'height'     => array(
        'label' => __( 'Height content', 'yit' ),
        'type'  => 'number',
        'desc'  => __( 'Select the height of container.', 'yit' ),
        'min'   => 10,
        'max'   => 2000,
        'std'   => 400
    ),


    'autoplay' => array(
        'label' => __( 'Autoplay', 'yit' ),
        'type'  => 'onoff',
        'desc'  => __( 'Enable autoplay of slides.', 'yit' ),
        'std'   => true
    ),


    'autoplay_speed'     => array(
        'label'   => __( 'Autoplay speed', 'yit' ),
        'type'  => 'slider',
        'desc'  => __( 'Autoplay speed in seconds', 'yit' ),
        'min'   => 0.1,
        'max'   => 20,
        'step'  => 0.1,
        'std'   => 0.8
    )

) );

$this->add_item_fields( array(


    'valign' => array(
        'label' => __('Vertical Align', 'yit'),
        'type'  => 'select',
        'options' => array(
            'top'  => 'Top',
            'center' => 'Center',
            'bottom' => 'Bottom'
        ),
        'desc'    => __( 'Select the vertical position of image', 'yit' ),
        'std'     => 'top',
    ),

    'halign' => array(
        'label' => __('Horizontal Align', 'yit'),
        'type'  => 'select',
        'options' => array(
            'left'  => 'Left',
            'center' => 'Center',
            'right' => 'Right'
        ),
        'desc'    => __( 'Select the horizontal position of image', 'yit' ),
        'std'     => 'center',
    ),

    'font_p' => array(
        'label' => __('Paragraph Font Size', 'yit'),
        'desc'  => __( 'Select the size for the content', 'yit' ),
        'type'  => 'number',
        'min'   => 0,
        'max'   => 100,
        'std'   => 24
    ),

    'color_content' => array(
        'label' => __('Color content', 'yit'),
        'type'  => 'colorpicker',
        'desc'  => __( 'Select the color for the content', 'yit' ),
        'std'   => '#000000',
    ),

    'effect' => array(
        'label' => __('Effect', 'yit'),
        'desc' => __( 'Select the effect of image', 'yit' ),
        'type' => 'select',
        'options'  => array(
            'fadeIn' => __('fadeIn', 'yit'),
            'fadeInUp' => __('fadeInUp', 'yit'),
            'fadeInDown' => __('fadeInDown', 'yit'),
            'fadeInLeft' => __('fadeInLeft', 'yit'),
            'fadeInRight' => __('fadeInRight', 'yit'),
            'fadeInUpBig' => __('fadeInUpBig', 'yit'),
            'fadeInDownBig' => __('fadeInDownBig', 'yit'),
            'fadeInLeftBig' => __('fadeInLeftBig', 'yit'),
            'fadeInRightBig' => __('fadeInRightBig', 'yit'),
            'bounceIn' => __('bounceIn', 'yit'),
            'bounceInDown' => __('bounceInDown', 'yit'),
            'bounceInUp' => __('bounceInUp', 'yit'),
            'bounceInLeft' => __('bounceInLeft', 'yit'),
            'bounceInRight' => __('bounceInRight', 'yit'),
            'rotateIn' => __('rotateIn', 'yit'),
            'rotateInDownLeft' => __('rotateInDownLeft', 'yit'),
            'rotateInDownRight' => __('rotateInDownRight', 'yit'),
            'rotateInUpLeft' => __('rotateInUpLeft', 'yit'),
            'rotateInUpRight' => __('rotateInUpRight', 'yit'),
            'lightSpeedIn' => __('lightSpeedIn', 'yit'),
            'hinge' => __('hinge', 'yit'),
            'rollIn' => __('rollIn', 'yit'),
        ),
        'std' => 'fadeIn'
    ),


    'overlay_opacity' => array(
        'label' => __('Overlay', 'yit'),
        'type'  => 'slider',
        'desc'  => __( 'Set an opacity of overlay', 'yit' ),
        'min'   => 0,
        'max'   => 100,
        'step'  => 10,
        'std'   => 50
    ),

    'sep'                 => array(
        'type' => 'sep'
    ),

    'video_upload_mp4'           => array(
        'label' => __( 'Video Mp4', 'yit' ),
        'desc'  => __( 'Upload here the video Mp4 to use as background', 'yit' ),
        'type'  => 'upload',
        'std'   => ''
    ),
    'video_upload_ogg'           => array(
        'label' => __( 'Video Ogg', 'yit' ),
        'desc'  => __( 'Upload here the video Ogg to use as background', 'yit' ),
        'type'  => 'upload',
        'std'   => ''
    ),
    'video_upload_webm'           => array(
        'label' => __( 'Video Webm', 'yit' ),
        'desc'  => __( 'Upload here the video Webm to use as background', 'yit' ),
        'type'  => 'upload',
        'std'   => ''
    ),

    'sep2'                 => array(
        'type' => 'sep'
    ),
    'video_button' => array(
        'label' => __( 'Video Button', 'yit' ),
        'type'  => 'onoff',
        'desc'  => __( 'Add a button to see a video in a lightbox', 'yit' ),
        'std'   => true
    ),
    'video_button_style' => array(
        'label' => __('Video button style', 'yit'),
        'desc' => __('Choose a style for video button', 'yit'),
        'type' => 'select',
        'options' => array(
            'flat' => __('Flat','yit'),
            'white' => __('White','yit'),
            'alternative' => __('Alternative','yit'),

        ),
        'std' => 'white'
    ),
    'video_url'           => array(
        'label' => __( 'Video Url', 'yit' ),
        'desc'  => __( 'Add the url of the video that will be opened in the lightbox', 'yit' ),
        'type'  => 'text',
        'std'   => '',
    ),

    'label_button_video'           => array(
        'label' => __( 'Label button', 'yit' ),
        'desc'  => __( 'Add the label of the button', 'yit' ),
        'type'  => 'text',
        'std'   => __('See the video', 'yit'),

    )
) );