<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}
$template_directory = get_template_directory_uri();
$options = array(
    'type'  => array(
        'type'  => 'select',
        'value' => '',
        'label' => __('Type', 'fw'),
        'desc'  => __('Select type to display', 'fw'),
        'choices' => array(
            'recent' => __('Recent Posts', 'fw'),
            'popular' => __('Popular Posts', 'fw'),
            'commented' => __('Most Commented Posts', 'fw')
        ),
    ),

    'posts_number'   => array(
        'label' => __( 'Number of Posts', 'fw' ),
        'desc'  => __( 'Enter the number of posts to display.', 'fw' ),
        'type'  => 'short-text',
        'value' => get_option('posts_per_page')
    ),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),
);