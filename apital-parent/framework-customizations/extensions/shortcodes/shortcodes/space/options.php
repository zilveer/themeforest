<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$template_directory = get_template_directory_uri();
$options            = array(
	'height' => array(
		'label'   => __( 'Height', 'fw' ),
		'desc'    => __( 'Select the space height in px', 'fw' ),
		'type'    => 'short-text',
		'value'   => '200'
	),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),
);