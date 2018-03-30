<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
                              
yit_register_portfolio_style(  $portfolio_type, 'portfolio-' . $portfolio_type, 'css/style.css' );
yit_register_portfolio_script(  $portfolio_type, 'portfolio-jquery-isotope', 'js/jquery.isotope.min.js' );

// add the image size
// add_image_size( 'thumb_portfolio_3cols', 365, 192, true );
 
// add the slider fields for the admin
yit_add_portfolio_config( $portfolio_type, array(

    array(
        'name' => __( 'Number of columns', 'yit' ),
        'id' => 'columns',
        'type' => 'number',
        'min' => 2,
        'max' => 4,
        'desc' => __( 'Select the number of columns.', 'yit' ),
        'std' => 3
    ),

	array(
		'type' => 'sep'
	),
	
    array(
        'name' => __( 'Items per page', 'yit' ),
        'id' => 'nitems',
        'type' => 'number',
        'min' => 0,
        'max' => 200,
        'desc' => __( 'Select the number of items to show. The option will active a pagination system below the items. Leave 0 to show all.', 'yit' ),
        'std' => 0
    ),
	array(
        'name' => __( 'Enable excerpt', 'yit' ),
        'id' => 'enable_excerpt',
        'type' => 'onoff',
        'desc' => __( 'Enable excerpt below the projects image. (The excerpt lenght can be customized in each single item.)', 'yit' ),
	),

	array(
		'type' => 'sep'
	),
    
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
