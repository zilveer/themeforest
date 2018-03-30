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

//$this->enqueue_style(  'idangerous-swiper', 'css/idangerous.swiper.css' );
//$this->enqueue_script( 'idangerous-swiper', 'js/idangerous.swiper.min.js' );
$this->enqueue_style(  'idangerous-swiper', 'css/swiper.css' );
$this->enqueue_script( 'idangerous-swiper', 'js/swiper.min.js' );
$this->enqueue_style(  'slider-banners', 'css/slider.css' );
$this->enqueue_script( 'slider-banners', 'js/slider.banners.js' );

// remove description field for the slide configuration
$this->add_description_field( 'no' );

$this->add_layout_fields( array(

    'height'     => array(
        'label' => __( 'Height content', 'yit' ),
        'type'  => 'number',
        'desc'  => __( 'Select the height of container.', 'yit' ),
        'min'   => 10,
        'max'   => 2000,
        'std'   => 400
    ),

    'autoplay'     => array(
        'label'   => __( 'Autoplay', 'yit' ),
        'type'    => 'onoff',
        'desc'    => __( 'Set the autoplay for the slider', 'yit' ),
        'std'     => 'yes',
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

    'controlnav' => array(
        'label' => __( 'Control Nav', 'yit' ),
        'type'  => 'onoff',
        'desc'  => __( 'Show slides control nav', 'yit' ),
        'std'   => 'on'
    )

) );

$this->add_item_fields( array(

	'link' => array(
		'label' => __( 'Link', 'yit' ),
		'type'  => 'text',
		'desc'  => '',
		'std'   => ''
	),

	'size' => array(
		'label' => __( 'Size of image', 'yit' ),
		'type'  => 'select',
		'options' => array(
			'big'   => __( 'Big',   'yit' ),
			'small' => __( 'Small', 'yit' ),
		),
		'desc'  => __( 'Set the size of small. If "small", the slide will be merge with the next or previous, if they are "small" too.', 'yit' ),
		'std'   => 'big'
	),

	'sep' => array(
		'type'  => 'sep'
	),

	'small-text' => array(
		'label' => __( 'Small text (on top)', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'The small text appears inside the slide', 'yit' ),
		'std'   => ''
	),

	'big-text' => array(
		'label' => __( 'Big text (on bottom)', 'yit' ),
		'type'  => 'text',
		'desc'  => __( 'The big text appears inside the slide', 'yit' ),
		'std'   => ''
	),

	'border-text' => array(
		'label' => __( 'Border text', 'yit' ),
		'type'  => 'onoff',
		'desc'  => __( 'Set if add borders around the text', 'yit' ),
		'std'   => 'no'
	),

	'position-text' => array(
		'label' => __( 'Position of text', 'yit' ),
		'type'  => 'select',
		'options' => array(
			'top'    => __( 'Top', 'yit' ),
			'center' => __( 'Center', 'yit' ),
			'bottom' => __( 'Bottom', 'yit' ),
		),
		'desc'  => __( 'Set the position of text within the slide', 'yit' ),
		'std'   => 'center'
	),

) );

$this->add_table_columns( array(
	__( 'Size', 'yit' ) => '%size%',
	__( 'Small text', 'yit' ) => '%small-text%',
	__( 'Big text', 'yit' ) => '%big-text%',
) );