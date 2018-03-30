<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$options = array(
    'type'  => array(
        'type'  => 'select',
        'value' => '',
        'label' => __('View Type', 'fw'),
        'desc'  => __('Select testimonials view type', 'fw'),
        'choices' => array(
            'type1' => __('Type 1', 'fw'),
            'type2' => __('Type 2', 'fw')
        ),
    ),

    'number'          => array(
        'type'  => 'text',
        'label' => __( 'Number', 'fw' ),
        'desc'  => __( 'Number of testimonials to display', 'fw' ),
        'value' => 3
    ),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),
);