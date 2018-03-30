<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'type'  => array(
        'type'  => 'select',
        'value' => '',
        'label' => __('Blockquote Type', 'fw'),
        'desc'  => __('Select blockquote type', 'fw'),
        'choices' => array(
            'bq-v1' => __('Light', 'fw'),
            'bq-v2' => __('Dark', 'fw')
        ),
    ),

    'text'  => array(
        'type'   => 'textarea',
        'value' => '',
        'label' => __('Content', 'fw'),
        'desc'  => __('Add blockquote content', 'fw')
    ),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),

);