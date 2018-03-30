<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(
    'toggle_type'  => array(
        'type'  => 'select',
        'value' => '',
        'label' => __('Toggle Type', 'fw'),
        'desc'  => __('Select the toggle type', 'fw'),
        'choices' => array(
            'first-style' => __('First Style', 'fw'),
            'second-style' => __('Second Style', 'fw'),
            'third-style' => __('Third Style', 'fw'),
            'fourth-style' => __('Fourth Style', 'fw')
        ),
    ),

    'toggle' => array(
        'type'  => 'addable-box',
        'value' => array(
            array(
                'title' => '',
            )
        ),
        'label' => __('Toggle', 'fw'),
        'desc'  => __('Add content', 'fw'),
        'template' => '{{=title}}',
        'box-options' => array(
            'title' => array( 'label' => __('Title','fw'),'desc'  => __( 'Enter the toggle title', 'fw' ), 'type' => 'text'),
            'desc' => array(
                'label' => __('Description', 'fw'),
                'type'   => 'textarea',
                'desc' => __('Enter the toggle content','fw') ),
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
            )
        ),
    ),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),

);