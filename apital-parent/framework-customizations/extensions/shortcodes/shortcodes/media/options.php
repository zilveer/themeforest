<?php if ( ! defined( 'FW' ) ) {
	die( 'Forbidden' );
}

$options = array(

    'media_type' => array(
        'type'  => 'multi-picker',
        'label' => false,
        'desc'  => false,
        'picker' => array(
            'media'       => array(
                'label'   => __( 'Media', 'fw' ),
                'desc'    => __( 'Choose media type', 'fw' ),
                'attr'    => array( 'class' => 'fw-checkbox-float-left' ),
                'type'    => 'radio',
                'value'   => 'video',
                'choices' => array(
                    'video' => __( 'Video', 'fw' ),
                    'soundcloud' => __( 'Soundcloud', 'fw' ),
                    'img' => __( 'Image', 'fw' )
                )
            ),
        ),
        'choices' => array(
            'video' => array(
                'video' => array(
                    'type'  => 'text',
                    'label' => __( '', 'fw' ),
                    'desc'  => __( 'Video link from youtube or vimeo', 'fw' ),
                ),
            ),
            'soundcloud' => array(
                'souncloud'          => array(
                    'type'  => 'text',
                    'label' => __( '', 'fw' ),
                    'value' => 'https://api.soundcloud.com/tracks/34019569',
                    'desc'  => __( 'Add soundcloud api link', 'fw' )
                ),
            ),
            'img' => array(
                'img' => array(
                    'type'  => 'upload',
                    'label' => __( '', 'fw' ),
                    'desc'  => __( 'Upload Image', 'fw' ),
                ),
            ),
        )
    ),

    'class'          => array(
        'type'  => 'text',
        'label' => __( 'Custom Class', 'fw' ),
        'desc'  => __( 'Enter a custom CSS class', 'fw' ),
        'help'  => __( 'You can use this class to further style this shortcode by adding your custom CSS', 'fw' ),
    ),

);	