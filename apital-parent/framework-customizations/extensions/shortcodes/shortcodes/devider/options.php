<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'divider' => array(
        'type'  => 'multi-picker',
        'label' => false,
        'desc'  => false,
        'picker' => array(
            'divider_type'  => array(
                'type'  => 'select',
                'value' => '',
                'label' => __('Divider Type', 'fw'),
                'desc'  => __('Select divider type', 'fw'),
                'choices' => array(
                    'line' => __('Divider With Line', 'fw'),
                    'shadow' => __('Divider With Shadow', 'fw'),
                    'pattern' => __('Divider With Pattern', 'fw')
                ),
            )
        ),
        'choices' => array(
            'line' => array(
                'divider_type'  => array(
                    'type'  => 'select',
                    'value' => '',
                    'label' => __('Line Type', 'fw'),
                    'desc'  => __('Select line type', 'fw'),
                    'choices' => array(
                        '' => __('Default', 'fw'),
                        'dvd-dots' => __('Dotted', 'fw'),
                        'dvd-dash' => __('Dashed', 'fw')
                    ),
                ),
                'color'   => array(
                    'label'   => __( 'Divider Color', 'fw' ),
                    'desc'    => __( 'Choose divider color', 'fw' ),
                    'value'   => '',
                    'type'    => 'color-picker'
                ),
            ),
            'shadow' => array(
                'divider_type'  => array(
                    'type'  => 'select',
                    'value' => '',
                    'label' => __('Shadow Type', 'fw'),
                    'desc'  => __('Select shadow type', 'fw'),
                    'choices' => array(
                        'type1' => __('Type 1', 'fw'),
                        'type2' => __('Type 2', 'fw'),
                        'type3' => __('Type 3', 'fw')
                    ),
                ),
            ),
            'pattern' => array(
                'divider_type'  => array(
                    'type'  => 'select',
                    'value' => '',
                    'label' => __('Pattern Type', 'fw'),
                    'desc'  => __('Select pattern type', 'fw'),
                    'choices' => array(
                        '' => __('Type 1', 'fw'),
                        '_2' => __('Type 2', 'fw'),
                        '_3' => __('Type 3', 'fw')
                    ),
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