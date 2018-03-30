<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'title'  => array(
        'type'   => 'text',
        'value' => '',
        'label' => __('Title', 'fw'),
        'desc'  => __('Add section title', 'fw')
    ),

    'box' => array(
        'type'  => 'addable-box',
        'value' => array(
            array(
                'title' => '',
            )
        ),
        'label' => __('Process', 'fw'),
        'desc'  => __('Add a process', 'fw'),
        'template' => '{{=title}}',
        'box-options' => array(
            'title' => array(
                'label' => __('Title','fw'),
                'desc'  => __( 'Enter the process title', 'fw' ),
                'type' => 'text'
            ),
            'desc' => array(
                'label' => __('Description', 'fw'),
                'type'   => 'textarea',
                'desc' => __('Enter the process content','fw') ),

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
                            'desc'  => __( 'Choose icon', 'fw' )
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

            'box_type' => array(
                'type'  => 'multi-picker',
                'label' => false,
                'desc'  => false,
                'picker' => array(
                    'message_type'  => array(
                        'type'  => 'select',
                        'value' => '',
                        'label' => __('Background', 'fw'),
                        'desc'  => __('Select process background type', 'fw'),
                        'choices' => array(
                            'color-1-default' => __('Type 1', 'fw'),
                            'color-2' => __('Type 2', 'fw'),
                            'color-3' => __('Type 3', 'fw'),
                            'color-4' => __('Type 4', 'fw'),
                            'custom' => __('Custom Type', 'fw'),
                        ),
                    ),
                ),
                'choices' => array(
                    'custom' => array(
                        'bg_color' => array(
                            'type'  => 'rgba-color-picker',
                            'value' => '',
                            'label' => __( 'Bg Color', 'fw' ),
                            'desc'  => __( 'Choose process bg color', 'fw' ),
                        ),
                        'text_color' => array(
                            'type'  => 'color-picker',
                            'value' => '',
                            'label' => __( 'Text Color', 'fw' ),
                            'desc'  => __( 'Choose process text color', 'fw' ),
                        ),
                    )
                )
            ),
        ),
    ),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),

);