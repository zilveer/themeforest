<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
                              
yit_register_portfolio_style(  $portfolio_type, 'portfolio-' . $portfolio_type, 'css/style.css' );
yit_register_portfolio_style(  $portfolio_type, 'portfolio-elastislide', get_template_directory_uri() .'/theme/assets/css/elastislide.css' );
yit_register_portfolio_script(  $portfolio_type, 'jquery-elastislider', get_template_directory_uri() .'/theme/assets/js/jquery.elastislide.js' );

// add the image size
// add_image_size( 'thumb_portfolio_3cols', 365, 192, true );
 
// add the slider fields for the admin
yit_add_portfolio_config( $portfolio_type, array(


	array(
        'name' => __( 'Enable lightbox icon', 'yit' ),
        'id' => 'event_lightbox',
        'type' => 'onoff',
        'desc' => __( 'Enable lightbox icon on projects image.', 'yit' ),
	),
	
	array(
        'name' => __( 'Enable project details icon', 'yit' ),
        'id' => 'event_details',
        'type' => 'onoff',
        'desc' => __( 'Enable project details icon on projects image.', 'yit' ),
	),
	
	array(
        'name' => __( 'Project title on hover', 'yit' ),
        'id' => 'event_title',
        'type' => 'onoff',
        'desc' => __( 'Show the project name on image hover.', 'yit' ),
	),
	
	array(
		'type' => 'sep'
	),
	array(
		'type' => 'simple-text',
		'id'   => 'simple_text',
		'desc' => '<h4>' . __('Page detail settings', 'yit') . '</h4>'
	),
	array(
        'name' => __( 'Select detail layout', 'yit' ),
        'id' => 'layout',
        'type' => 'select',
        'desc' => __( 'Show the selected layout in detail page.', 'yit' ),
        'options' => array(
			'small' => __('Small', 'yit'),
			'big' => __('Big', 'yit')			
		),
		'std' => 'small'
	),
    array(
        'name' => __( 'Display Other Projects', 'yit' ),
        'id' => 'display_related',
        'type' => 'onoff',
        'desc' => __( 'Select if you want to show other projects below the item.', 'yit' )
    ),
    array(
        'name' => __( 'Items', 'yit' ),
        'id' => 'detail_nitems',
        'type' => 'number',
        'min' => 0,
        'max' => 200,
        'desc' => __( 'Select the number of items to show below the item. Leave 0 to show all.', 'yit' ),
        'std' => 0
    ),
    array(
        'name' => __( 'Enable lightbox icon', 'yit' ),
        'id' => 'event_project_lightbox',
        'type' => 'onoff',
        'desc' => __( 'Enable lightbox icon for detail images.', 'yit' ),
	),
    array(
        'name' => __( 'Other Projects label', 'yit' ),
        'id' => 'other_projects_label',
        'type' => 'text',
        'std' =>  __( 'Other Projects', 'yit' ),
        'desc' => __( 'Customize the Other Projects label', 'yit' )
    )
) );
