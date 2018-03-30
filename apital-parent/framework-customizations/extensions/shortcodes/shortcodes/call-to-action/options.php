<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$button = fw()->extensions->get( 'shortcodes' )->get_shortcode( 'button' );
$options = array(

    'call_type' => array(
        'type'  => 'multi-picker',
        'label' => false,
        'desc'  => false,
        'picker' => array(
            'message_type'  => array(
                'type'  => 'select',
                'value' => '',
                'label' => __('Type', 'fw'),
                'desc'  => __('Select call to action type', 'fw'),
                'choices' => array(
                    'cta-default' => __('Type 1', 'fw'),
                    'cta-v4' => __('Type 2', 'fw'),
                    'cta-v3' => __('Type 3', 'fw'),
                    'cta-v2' => __('Type 4', 'fw'),
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
                    'desc'  => __( 'Choose call to action bg color', 'fw' ),
                ),
                'text_color' => array(
                    'type'  => 'color-picker',
                    'value' => '',
                    'label' => __( 'Text Color', 'fw' ),
                    'desc'  => __( 'Choose call to action text color', 'fw' ),
                ),
            )
        )
    ),

    'text' => array(
        'type'   => 'text',
        'label' => __( 'Title', 'fw' ),
        'desc'  => __( 'Call to action title', 'fw' ),
        'value' => ''
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