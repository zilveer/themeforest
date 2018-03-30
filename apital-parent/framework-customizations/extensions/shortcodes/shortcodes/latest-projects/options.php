<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$options = array(
    'view_type' => array(
        'type'  => 'multi-picker',
        'label' => false,
        'desc'  => false,
        'picker' => array(
            'view'  => array(
                'label'   => __( 'Projects View', 'fw' ),
                'desc'    => __( 'Select the latest projects view', 'fw' ),
                'type'  => 'select',
                'value' => '',
                'choices' => array(
                    'full' => __('Full','fw'),
                    'desc' => __('With Description', 'fw')
                ),
            ),
        ),
        'choices' => array(
            'desc' => array(
                'desc'          => array(
                    'type'  => 'textarea',
                    'label' => __( 'Description', 'fw' ),
                    'desc'  => __( 'Enter a short description', 'fw' ),
                ),
                'link-text' => array(
                    'type'  => 'text',
                    'label' => __( 'Link Text', 'fw' ),
                    'desc'  => __( 'Add link text', 'fw' ),
                ),
                'url' => array(
                    'type'  => 'text',
                    'label' => __( 'URL', 'fw' ),
                    'desc'  => __( 'Add link URL', 'fw' ),
                ),
            ),
        )
    ),

    'posts_per_page' => array(
        'type'   => 'text',
        'value' => get_option('posts_per_page'),
        'label'  => __( 'Projects Number', 'fw' ),
        'desc'   => __( 'Projects number to display', 'fw' )
    ),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),

);