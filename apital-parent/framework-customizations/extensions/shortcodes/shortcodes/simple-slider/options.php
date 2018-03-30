<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'slide'          => array(
        'type'  => 'multi-upload',
        'label' => __( 'Slides', 'fw' ),
        'desc'  => __( 'Add Slides', 'fw' ),
        'option' => array( 'type' => 'upload' ),
    ),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),
);