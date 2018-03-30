<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options            = array(
    'type'  => array(
        'type'  => 'select',
        'value' => '',
        'label' => __('Drop Cap Type', 'fw'),
        'desc'  => __('Select drop cap type', 'fw'),
        'choices' => array(
            'dropcap-default' => __('Default', 'fw'),
            'dc-circile' => __('Circle', 'fw'),
            'dc-square' => __('Square', 'fw')
        ),
    ),

    'letter'  => array(
        'type'   => 'text',
        'value' => 'V',
        'label' => __('Drop Cap', 'fw'),
        'desc'  => __('Enter dropcast content', 'fw')
    ),

    'text'  => array(
        'type'   => 'textarea',
        'teeny'  => true,
        'value' => '',
        'label' => __('Content', 'fw'),
        'desc'  => __('Enter shortcode content', 'fw')
    ),

    'bg_color' => array(
        'type'  => 'color-picker',
        'label' => __( 'Bg Color', 'fw' ),
        'desc'  => __( 'Choose background color', 'fw' ),
    ),

    'textcolor' => array(
        'type'  => 'color-picker',
        'label' => __( 'Color', 'fw' ),
        'desc'  => __( 'Choose text color', 'fw' ),
    ),


    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),
);