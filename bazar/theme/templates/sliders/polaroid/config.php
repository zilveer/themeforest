<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
 
yit_register_slider_style(  $slider_type, 'slider-polaroid', 'css/polaroid.css' );
yit_register_slider_script( $slider_type, 'jquery-transform', 'js/jquery.transform-0.8.0.min.js' );
yit_register_slider_script( $slider_type, 'jquery-preloader', 'js/jquery.preloader.js' );
yit_register_slider_script( $slider_type, 'jquery-polaroid', 'js/jquery.polaroid.js' ); 

// set here if the slider is reponsive or not
$this->responsive_sliders[ $slider_type ] = false;

// add support to slide
yit_add_slide_support( $slider_type, 'title, content', array(
    array(
        'name' => __( 'Content alignment', 'yit' ),
        'id' => 'content_align',
        'type' => 'select',
        'options' => array(
            'left'  => __( 'Left', 'yit' ),
            'right' => __( 'Right', 'yit' ),
        ),
        'desc' => __( 'Select where you want the content. The image automatically will be aligned in the opposite side.', 'yit' ),
        'std' => 'right',
    ), 
    array(
        'name' => __( 'Full background', 'yit' ),
        'id' => 'is_full',
        'type' => 'onoff',
        'desc' => __( 'Set YES here if you want the background in full width, when you have a content inside the slide.', 'yit' ),
        'std' => 0,
    ),         
) );

// thumbnails image size
add_image_size( 'slider-polaroid-thumb', 150, 150, true );
 
// add the slider fields for the admin
yit_add_slider_config( $slider_type, array(
    array(
        'name' => __( 'Width content', 'yit' ),
        'id' => 'width',
        'type' => 'number',        
        'desc' => __( 'Select the width of container (select 0 if you want to have the same width of site container).', 'yit' ),
        'min' => 0,
        'max' => 2000,
        'std' => 0
    ),
    array(
        'name' => __( 'Height content', 'yit' ),
        'id' => 'height',
        'type' => 'number',        
        'desc' => __( 'Select the height of container.', 'yit' ),
        'min' => 10,
        'max' => 2000,
        'std' => 400
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
        'type' => 'sep'
    ),
	array(
        'id' => 'responsive_mode', 
        'name' => __('Responsive mode', 'yit'),        
        'desc' => __('Select some other responsive slider or static image to replace to this slider, when you are in responsive.', 'yit'),
        'type' => 'responsivesliders'
    ),
	array(
        'id' => 'responsive_image', 
        'name' => __('Responsive Image', 'yit'),        
        'desc' => __('Upload here an image, if you have defined the "Static Image" in the option above.', 'yit'),
        'type' => 'upload'
    )
) );           
 
// add the slider fields for the admin
yit_slider_typography_options( $slider_type, array(
    array(
        'id'   => 'title-font',
        'type' => 'typography',
        'name' => __( 'Title', 'yit' ),
        'desc' => __( 'Configure the title.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 24,
            'unit'   => 'px',
            'family' => 'Open Sans',
            'style'  => 'extra-bold',
            'color'  => '#e5f99a' 
        ),
        'style' => array(
			'selectors' => '.slider-%s.slider .slide-content h2, .slider-%s.slider .slide-content h2, .text-polaroid h2',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    ),
    array(
        'id'   => 'paragraphs-font',
        'type' => 'typography',
        'name' => __( 'Paragraphs', 'yit' ),
        'desc' => __( 'Configure the paragraphs.', 'yit' ),
        'min'  => 1,
        'max'  => 72,
        'std'  => array(
            'size'   => 12,
            'unit'   => 'px',
            'family' => 'Open Sans',
            'style'  => 'regular',
            'color'  => '#ffffff' 
        ),
        'style' => array(
			'selectors' => '.slider-%s.slider .slide-content p, .slider-%s.slider .slide-content p, .text-polaroid p',
			'properties' => 'font-size, font-family, color, font-style, font-weight'
		)
    )
) );        