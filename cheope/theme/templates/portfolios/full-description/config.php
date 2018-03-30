<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */ 
                              
yit_register_portfolio_style(  $portfolio_type, 'portfolio-' . $portfolio_type, 'css/style.css' );

// add the image size
//add_image_size( 'thumb_portfolio_fulldesc', 700, 345, true );
//add_image_size( 'thumb_portfolio_fulldesc_related', 175, 175, true );
 
// add the slider fields for the admin
yit_add_portfolio_config( $portfolio_type, array(
	array(
        'name' => __( 'Enable lightbox icon', 'yit' ),
        'id' => 'event_project_lightbox',
        'type' => 'onoff',
        'desc' => __( 'Enable lightbox icon for portfolio images.', 'yit' ),
	),
	array(
		'type' => 'sep'
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
        'name' => __( 'Other Projects label', 'yit' ),
        'id' => 'other_projects_label',
        'type' => 'text',
        'std' =>  __( 'Other Projects', 'yit' ),
        'desc' => __( 'Customize the Other Projects label', 'yit' )
    ),       
    
	array(
        'name' => __( 'Enable lightbox icon in related projects', 'yit' ),
        'id' => 'event_lightbox',
        'type' => 'onoff',
        'desc' => __( 'Enable lightbox icon on related projects image.', 'yit' ),
	),
	
	array(
        'name' => __( 'Enable project details icon', 'yit' ),
        'id' => 'event_details',
        'type' => 'onoff',
        'desc' => __( 'Enable project details icon on related projects image.', 'yit' ),
	),
	
	array(
        'name' => __( 'Project title on hover', 'yit' ),
        'id' => 'event_title',
        'type' => 'onoff',
        'desc' => __( 'Show the project name on image hover.', 'yit' ),
	),   
) );
