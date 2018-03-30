<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$button = fw()->extensions->get( 'shortcodes' )->get_shortcode( 'button' );
$options = array(
    'heading' => array(
        'type'    => 'short-select',
        'label'   => 'Size',
        'desc'    => 'Choose the heading size',
        'value'   => 'h2',
        'choices' => array(
            'h1' => 'H1',
            'h2' => 'H2',
            'h3' => 'H3',
            'h4' => 'H4',
            'h5' => 'H5',
            'h6' => 'H6',
        )
    ),

    'title'   => array(
        'type'  => 'text',
        'label' => __( 'Title', 'fw' ),
        'desc'  => __( 'Enter the heading title', 'fw' ),
    ),

    'color'   => array(
        'label'   => __( 'Heading Color', 'fw' ),
        'desc'    => __( 'Choose heading color', 'fw' ),
        'value'   => '',
        'type'    => 'color-picker'
    ),

    'special_heading_type' => array(
        'type'  => 'multi-picker',
        'label' => false,
        'desc'  => false,
        'picker' => array(
            'heading_type'  => array(
                'type'  => 'select',
                'value' => '',
                'label' => __('Heading Type', 'fw'),
                'desc'  => __('Select special heading type', 'fw'),
                'choices' => array(
                    '1' => __('Default Heading', 'fw'),
                    '2' => __('Shortocode Heading', 'fw'),
                    '3' => __('Section Heading', 'fw')
                ),
            )
        ),
        'choices' => array(
            '3' => array(
                'subtitle'       => array(
                    'type'   => 'textarea',
                    'label' => __( 'Subtitle', 'fw' ),
                    'desc'  => __( 'Enter the heading subtitle', 'fw' ),
                ),

                'button' => array(
                    'type'  => 'multi-picker',
                    'label' => false,
                    'desc'  => false,
                    'picker' => array(
                        'enable-btn' => array(
                            'type'  => 'switch',
                            'value' => 'no',
                            'label' => __('Button', 'fw'),
                            'desc'  => __('Enable title button', 'fw'),
                            'left-choice' => array(
                                'value' => 'no',
                                'label' => __('No', 'fw'),
                            ),
                            'right-choice' => array(
                                'value' => 'yes',
                                'label' => __('Yes', 'fw'),
                            ),
                        )
                    ),
                    'choices' => array(
                        'yes' => array(
                            'btn_link_group' => array(
                                'type'    => 'group',
                                'options' => array(
                                    $button->get_options()
                                )
                            )
                        )
                    )
                ),
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