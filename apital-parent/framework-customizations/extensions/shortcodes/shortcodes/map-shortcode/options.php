<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

    'title'   => array(
        'label' => __( 'Title', 'fw' ),
        'desc'  => __( 'Type map title here.', 'fw' ),
        'type'  => 'text',
        'value' => ''
    ),

    'latitude' => array(
        'type' => 'text',
        'label' =>__('Latitude','fw'),
        'desc'  => __( 'Add map latitude', 'fw' ),
    ),

    'longitude' => array(
        'type' => 'text',
        'label' =>__('Longitude','fw'),
        'desc'  => __( 'Add map longitude', 'fw' ),
    ),

    'zoom' => array(
        'type'  => 'text',
        'value' => 13,
        'label' => __( 'Map Zoom', 'fw' ),
        'desc'  => __( 'Type map zoom', 'fw' ),
    ),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),


);	