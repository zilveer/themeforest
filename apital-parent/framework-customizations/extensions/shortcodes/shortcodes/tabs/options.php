<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$template_directory = get_template_directory_uri();
$options            = array(
    'tabs_type'  => array(
        'type'  => 'select',
        'value' => '',
        'label' => __('Tabs Type', 'fw'),
        'desc'  => __('Select tabs type', 'fw'),
        'choices' => array(
            'horizontal' => __('Horizontal', 'fw'),
            'vertical' => __('Vertical', 'fw')
        ),
    ),

	'tabs'                 => array(
		'type'          => 'addable-popup',
		'label'         => __( 'Tabs', 'fw' ),
		'popup-title'   => __( 'Add/Edit Tab', 'fw' ),
		'desc'          => __( 'Add tabs', 'fw' ),
		'template'      => '{{=tab_title}}',
		'popup-options' => array(
            'tab_title' => array(
                'type'  => 'text',
                'label' => __( 'Title', 'fw' ),
                'desc'  => __( 'Enter tab title', 'fw' )
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
            'tab_content'       => array(
                'type'   => 'textarea',
                'label'  => __( 'Tab Content', 'fw' ),
                'desc'   => __( 'Enter tab content', 'fw' )
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