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
 * @use $this \YIT_CPT_Unlimited The object
 */

$this->enqueue_style( 'slider-flexslider', 'css/flexslider.css' );
$this->enqueue_style( 'slider-flexslider-slider', 'css/slider.css' );
$this->enqueue_script( 'jquery-flexslider', 'js/jquery.flexslider-min.js' );

// remove description field for the slide configuration
$this->add_description_field( 'no' );

$this->add_layout_fields( array(

    'width'      => array(
        'label' => __( 'Width content', 'yit' ),
        'type'  => 'number',
        'desc'  => __( 'Select the width of container (select 0 if you want to have the same width of site container).', 'yit' ),
        'min'   => 0,
        'max'   => 2000,
        'std'   => 0
    ),



    'effect'     => array(
        'label'   => __( 'Effect', 'yit' ),
        'type'    => 'select',
        'options' => array(
            'fade'  => 'Fade',
            'slide' => 'Slide'
        ),
        'desc'    => __( 'The effect used to change slide.', 'yit' ),
        'std'     => 'fade',
    ),

    'interval'   => array(
        'label' => __( 'Pause between slides (s)', 'yit' ),
        'type'  => 'slider',
        'desc'  => __( 'Select the delay between slides, expressed in seconds.', 'yit' ),
        'min'   => 0.1,
        'max'   => 20,
        'step'  => 0.1,
        'std'   => 3
    ),

    'speed'      => array(
        'label' => __( 'Animation speed (s)', 'yit' ),
        'type'  => 'slider',
        'desc'  => __( 'The speed of the animation between two slide, expressed in seconds.', 'yit' ),
        'min'   => 0.1,
        'max'   => 20,
        'step'  => 0.1,
        'std'   => 0.8
    ),

    'controlnav' => array(
        'label' => __( 'Control Nav', 'yit' ),
        'type'  => 'onoff',
        'desc'  => __( 'Show slides control nav', 'yit' ),
        'std'   => false
    )

) );

$this->add_item_fields( array(

    'link' => array(
        'label' => __( 'Link', 'yit' ),
        'type'  => 'text',
        'desc'  => '',
        'std'   => ''
    ),

) );