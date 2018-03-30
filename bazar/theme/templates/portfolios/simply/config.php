<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
                              
yit_register_portfolio_style(  $portfolio_type, 'portfolio-' . $portfolio_type, 'css/style.css' );

// add the image size
yit_add_image_size( 'thumb_portfolio_simply', 770, 0, false );
 
// add the slider fields for the admin
yit_add_portfolio_config( $portfolio_type, array(
    array(
        'name' => __( 'Items', 'yit' ),
        'id' => 'nitems',
        'type' => 'number',
        'min' => 0,
        'max' => 200,
        'desc' => __( 'Select the number of items to show (Only if the filters are disabled). Leave 0 to show all.', 'yit' ),
        'std' => 0
    ),
    array(
        'name' => __( 'Project detail label', 'yit' ),
        'id' => 'project-label',
        'type' => 'text',
        'desc' => __( 'Select the label for project details', 'yit' ),
        'std' => __('Project Info', 'yit')
    ),
    
) );


// add support to slide
yit_add_work_support( $portfolio_type, array(        
    array(
        'name' => __( 'Background', 'yit' ),
        'id' => 'background-container',
        'type' => 'colorpicker',
        'desc' => __( 'Define the container background color.', 'yit' ),
        'std' => ''
    ),
    
    array(
        'name' => __( 'Background image', 'yit' ),
        'id' => 'background-image-container',
        'type' => 'upload',
        'desc' => __( 'Define the container background image.', 'yit' )
    ),
    
    array(
        'name' => __( 'Background image position', 'yit' ),
        'id' => 'background-image-container-position',
        'type' => 'select',
        'options' => array(
			'left top' => __('Left Top', 'yit'),
			'left center' => __('Left Center', 'yit'),
			'left bottom' => __('Left Bottom', 'yit'),
			'right top' => __('Right Top', 'yit'),
			'right center' => __('Right Center', 'yit'),
			'right bottom' => __('Right Bottom', 'yit'),
			'center top' => __('Center Top', 'yit'),
			'center center' => __('Center Center', 'yit'),
			'center bottom' => __('Center Bottom', 'yit'),
		),
        'desc' => __( 'Define the background image position.', 'yit' )
    ),
    
    array(
        'name' => __( 'Background image repeat', 'yit' ),
        'id' => 'background-image-container-repeat',
        'type' => 'select',
        'options' => array(
			'no-repeat' => __('No Repeat', 'yit'),
			'repeat' => __('Repeat', 'yit'),
			'repeat-x' => __('Repeat X', 'yit'),
			'repeat-y' => __('Repeat Y', 'yit'),
		),
        'desc' => __( 'Define the container background image.', 'yit' )
    ),
    
    array(
        'name' => __( 'Image position', 'yit' ),
        'id' => 'image-position',
        'type' => 'select',
        'desc' => __( 'Define the image position. Leave empty for transparent background', 'yit' ),
        'std' => 'left',
        'options' => array(
			'left' => __( 'Left', 'yit' ),
			'right' => __( 'Right', 'yit' ),
			'top' => __( 'Top', 'yit' )
		)
    ),
) );