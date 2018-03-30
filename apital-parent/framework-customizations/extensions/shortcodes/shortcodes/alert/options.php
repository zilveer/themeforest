<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'message_type'  => array(
        'type'  => 'select',
        'value' => '',
        'label' => __('Alert Type', 'fw'),
        'desc'  => __('Select alert box type', 'fw'),
        'choices' => array(
            'notice' => __('Notice', 'fw'),
            'info' => __('Info', 'fw'),
            'success' => __('Success', 'fw'),
            'error' => __('Error', 'fw')
        ),
    ),

    'message'  => array(
        'type'   => 'textarea',
        'value' => '',
        'label' => __('Message', 'fw'),
        'desc'  => __('Add message', 'fw')
    ),

    'icon_box' => array(
        'type'  => 'multi-picker',
        'label' => false,
        'desc'  => false,
        'picker' => array(
            'icon_type'       => array(
                'label'   => __( 'Icon', 'fw' ),
                'desc'    => __( 'Choose icon type', 'fw' ),
                'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
                'type'    => 'radio',
                'value'   => 'awesome',
                'choices' => array(
                    'awesome' => __( 'Font Awesome', 'fw' ),
                    'custom' => __( 'Custom Icon Class', 'fw' )
                )
            ),
        ),
        'choices' => array(
            'awesome' => array(
                'icon'          => array(
                    'type'  => 'icon',
                    'label' => __( '', 'fw' ),
                    'desc'  => __( 'Choose box icon', 'fw' )
                ),
            ),
            'custom' => array(
                'icon'          => array(
                    'type'  => 'text',
                    'label' => __( '', 'fw' ),
                    'desc'  => __( 'Add custom icon class', 'fw' )
                ),
            )
        )
    ),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),

);