<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'team' => array(
        'type'  => 'multi-picker',
        'label' => false,
        'desc'  => false,
        'picker' => array(
            'type'  => array(
                'type'  => 'select',
                'value' => '',
                'label' => __('View Type', 'fw'),
                'desc'  => __('Select team view type', 'fw'),
                'choices' => array(
                    'grid' => __('Grid', 'fw'),
                    'single' => __('Single', 'fw')
                ),
            ),
        ),
        'choices' => array(
            'grid' => array(
                'filter' => array(
                    'type'         => 'switch',
                    'label'        => __( '', 'fw' ),
                    'desc'         => __( 'Enable top filter?', 'fw' ),
                    'value'        => 'yes',
                    'right-choice' => array(
                        'value' => 'yes',
                        'label' => __( 'Yes', 'fw' ),
                    ),
                    'left-choice'  => array(
                        'value' => 'no',
                        'label' => __( 'No', 'fw' ),
                    ),
                ),
            ),
            'single' => array(
                'post'  => array(
                    'type'  => 'select',
                    'value' => '',
                    'label' => __('', 'fw'),
                    'desc'  => __('Select team member to display', 'fw'),
                    'choices' => fw_get_members_list(),
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