<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
 
yit_register_slider_style(  $slider_type, 'slider-thumbnail', 'css/thumbnails.css' );
yit_register_slider_script( $slider_type, 'jquery-thumbnail', 'js/jquery.aw-showcase.js' );  

// set here if the slider is reponsive or not
$this->responsive_sliders[ $slider_type ] = true;

// add image size
yit_add_image_size( 'thumb-slider-thumbnails', 60, 60, true );

// add support to slide
yit_add_slide_support( $slider_type, 'link', array(        
    array(
        'name' => __( 'Caption', 'yit' ),
        'id' => 'caption',
        'type' => 'text',
        'desc' => __( 'Define here the text to use in the caption of the slide.', 'yit' ),
        'std' => ''
    ),   
    array(
        'type' => 'simple-text',
        'desc' => '<b>' . __( 'Add Tooltip', 'yit' ) . '</b>'
    ),   
    array(
        'name' => __( 'Tooltip Text', 'yit' ),
        'id' => 'tooltip_text',
        'type' => 'textarea',
        'desc' => __( 'Select the text to show inside the tooltip.', 'yit' ),
        'std' => ''
    ),   
    array(
        'name' => __( 'Tooltip Image', 'yit' ),
        'id' => 'tooltip_image',
        'type' => 'upload',
        'desc' => __( 'You can add here an image to show above the text inside the tooltip (optional)', 'yit' ),
        'std' => ''
    ),  
    array(
        'name' => __( 'URL', 'yit' ),
        'id' => 'tooltip_url',
        'type' => 'text',
        'desc' => __( 'Define here the URL where the tooltip have to point.', 'yit' ),
        'std' => ''
    ),   
    array(
        'name' => __( 'Coords X', 'yit' ),
        'id' => 'tooltip_x',
        'type' => 'number',
        'desc' => __( 'Define here the position, from the left, where place the tooltip.', 'yit' ),
        'std' => '20'
    ),     
    array(
        'name' => __( 'Coords Y', 'yit' ),
        'id' => 'tooltip_y',
        'type' => 'number',
        'desc' => __( 'Define here the position, from the top, where place the tooltip.', 'yit' ),
        'std' => '20'
    )
) );
 
// add the slider fields for the admin
yit_add_slider_config( $slider_type, array(
    array(
        'name' => __( 'Effect', 'yit' ),
        'id' => 'effect',
        'type' => 'select',
        'desc' => __( 'Select the effect you want for slides transiction.', 'yit' ),
        'options' => array (
			'vslide' => 'vslide',
			'hslide' => 'hslide',
			'fade' => 'fade'
		),
        'std' => 'fade'
    ),   
    array(
        'name' => __( 'How to show the title', 'yit' ),
        'id' => 'show_caption',
        'type' => 'select',        
        'desc' => __( 'Define how to show the title in the slide.', 'yit' ),
        'options' => array (
			'show' => __( 'Show always', 'yit' ),
			'onload' => __( 'Show on load', 'yit' ),
			'onhover' => __( 'Show on hover', 'yit' )
		),
        'std' => 'onload'
    ),
    array(
        'name' => __( 'Pause between slides (s)', 'yit' ),
        'id' => 'interval',
        'type' => 'slider',        
        'desc' => __( 'Select the delay between slides, expressed in seconds.', 'yit' ),
        'min' => 0.1,
        'max' => 20,
        'step' => 0.1,
        'std' => 3
    ),
    array(
        'name' => __( 'Animation speed (s)', 'yit' ),
        'id' => 'speed',
        'type' => 'slider',
        'desc' => __( 'The speed of the animation between two slide, expressed in seconds.', 'yit' ),
        'min' => 0.1,
        'max' => 20,   
        'step' => 0.1,  
        'std' => 0.8
    ),
    array(
        'name' => __( 'Content width', 'yit' ),
        'id' => 'width',
        'type' => 'number',
        'desc' => __( 'Select the width of content (take in mind 22px of padding and border of the slider, so if you want the slider 1200px width, set 1178px as width.).', 'yit' ),
        'min' => 10,
        'max' => 2000,
        'std' => 1148,
    ),
    array(
        'name' => __( 'Content height', 'yit' ),
        'id' => 'height',
        'type' => 'number',
        'desc' => __( 'Select the height of content (take in mind 22px of padding and border of the slider, so if you want the slider 400px height, set 378px as height.).', 'yit' ),
        'min' => 10,
        'max' => 2000,
        'std' => 378,
    ),
	array(
        'type' => 'sep'
    ),
    array(
        'name' => __( 'Header background color', 'yit' ),
        'id' => 'header-background',
        'type' => 'colorpicker',
        'desc' => __( 'The color of background if the slider is set in header (empty if you want transparent)', 'yit' ),
        'std' => ''
    )
// 	array(
//         'id' => 'responsive_mode', 
//         'name' => __('Responsive mode', 'yit'),        
//         'desc' => __('Select some other responsive slider or static image to replace to this slider, when you are in responsive.', 'yit'),
//         'type' => 'responsivesliders'
//     ),
// 	array(
//         'id' => 'responsive_image', 
//         'name' => __('Responsive Image', 'yit'),        
//         'desc' => __('Upload here an image, if you have defined the "Static Image" in the option above.', 'yit'),
//         'type' => 'upload'
//     )
));      
 
// add the slider fields for the admin
yit_slider_typography_options( $slider_type, array(
    array(
        'id'   => 'tooltip-font',
        'type' => 'typography',
        'name' => __( 'Caption font', 'yit' ),
        'desc' => __( 'Configure the tooltip text in hover of the slide.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 13,
            'unit'   => 'px',
            'family' => 'Play',
            'style'  => 'regular',
            'color'  => '#585555' 
        ),
        'style' => array(
			'selectors' => '.slider-%s.slider.thumbnails .showcase-caption p',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    ),
    array(
        'id'   => 'extra-tooltip-font',
        'type' => 'typography',
        'name' => __( 'Tooltip text font', 'yit' ),
        'desc' => __( 'Configure the font of the additional tooltip that you add inside the slide in a custom position.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Muli',
            'style'  => 'regular',
            'color'  => '#000' 
        ),
        'style' => array(
			'selectors' => '.slider-%s.slider.thumbnails div.showcase-tooltip',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    ),
) );           