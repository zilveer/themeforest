<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}



$options = array(
    'section_type' => array(
        'type'  => 'multi-picker',
        'label' => false,
        'desc'  => false,
        'picker' => array(
            'section'  => array(
                'type'  => 'select',
                'value' => '',
                'label' => __('Section Type', 'fw'),
                'desc'  => __('Select section type', 'fw'),
                'choices' => array(
                    'section1' => __('Default Section', 'fw'),
                    'section2' => __('Less Padding', 'fw'),
                    'section3' => __('More Padding', 'fw'),
                    'section4' => __('Video Section', 'fw'),
                    'section5' => __('Logo Section', 'fw'),
                    'section6' => __('Hero Section', 'fw'),
                    'section7' => __('Parallax Section', 'fw')
                ),
            )
        ),
        'choices' => array(
            'section4' => array(
                'video_type' => array(
                    'type'  => 'multi-picker',
                    'label' => false,
                    'desc'  => false,
                    'picker' => array(
                        'video'       => array(
                            'label'   => __( 'Video Type', 'fw' ),
                            'desc'    => __( 'Choose video type', 'fw' ),
                            'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
                            'type'    => 'radio',
                            'value'   => 'uploaded',
                            'choices' => array(
                                'uploaded' => __( 'Upload', 'fw' ),
                                'link' => __( 'Link', 'fw' )
                            )
                        ),
                    ),
                    'choices' => array(
                        'uploaded' => array(
                            'video' => array(
                                'label' => __( 'Video', 'fw' ),
                                'desc'  => __( 'Upload section background video', 'fw' ),
                                'type'  => 'upload',
                                'value' => '',
                                'images_only' => false,
                            ),
                        ),
                        'link' => array(
                            'video' => array(
                                'label' => __( 'Video', 'fw' ),
                                'desc'  => __( 'Add video link (ex: http://3nacu.com/video-background.mp4)', 'fw' ),
                                'type'  => 'text',
                                'value' => ''
                            ),
                        )
                    )
                ),
            )
        )
    ),

    'bg_color' => array(
        'type'  => 'rgba-color-picker',
        'label' => __( 'Bg Color', 'fw' ),
        'desc'  => __( 'Choose section background color', 'fw' ),
    ),

    'bg_image' => array(
        'label' => __( 'Bg Image', 'fw' ),
        'desc'  => __( 'Upload section background image', 'fw' ),
        'type'  => 'upload',
        'value' => ''
    ),

	'class'              => array(
		'label' => __( 'Custom Class', 'fw' ),
		'desc'  => __( 'Enter custom CSS class', 'fw' ),
		'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS.', 'fw' ),
		'type'  => 'text',
		'value' => '',
	),
);