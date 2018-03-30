<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$button = fw()->extensions->get( 'shortcodes' )->get_shortcode( 'button' );
$options = array(
	'title'       => array(
		'type'  => 'text',
		'label' => __( 'Title', 'fw' ),
		'desc'  => __( 'Add pricing title', 'fw' )
	),

    'price'       => array(
        'type'  => 'text',
        'label' => __( 'Price', 'fw' ),
        'desc'  => __( 'Add price', 'fw' )
    ),

    'list'          => array(
        'type'  => 'addable-option',
        'label' => __( 'Rows', 'fw' ),
        'desc'  => __( 'Add Rows', 'fw' ),
        'option' => array( 'type' => 'text' ),
    ),

    'featured' => array(
        'type'  => 'multi-picker',
        'label' => false,
        'desc'  => false,
        'picker' => array(
            'enable-featured' => array(
                'type'  => 'switch',
                'value' => 'no',
                'label' => __('Is Featured', 'fw'),
                'desc'  => __('Enable featured for this table', 'fw'),
                'left-choice' => array(
                    'value' => 'no',
                    'label' => __('No', 'fw'),
                ),
                'right-choice' => array(
                    'value' => 'yes',
                    'label' => __('Yes', 'fw'),
                ),
            ),
        ),
        'choices' => array(
            'yes' => array(
                'title'       => array(
                    'type'  => 'text',
                    'value' => 'Featured',
                    'label' => __( '', 'fw' ),
                    'desc'  => __( 'Add featured tag title', 'fw' )
                ),
            )
        )
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

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),
);