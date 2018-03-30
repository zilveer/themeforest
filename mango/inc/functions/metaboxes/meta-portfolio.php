<?php
$meta_boxes[] = array(
    // Meta box id, UNIQUE per meta box. Optional since 4.1.5
    'id' => 'portfolio_options',
    // Meta box title - Will appear at the drag and drop handle bar. Required.
    'title' => __( 'Portfolio Options', 'mango' ),
    // Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
    'pages' => array( 'portfolio' ),
    // Where the meta box appear: normal (default), advanced, side. Optional.
    'context' => 'advanced',
    // Order of meta box: high (default), low. Optional.
    'priority' => 'high',
    // Auto save: true, false (default). Optional.
    'autosave' => true,
    // List of meta fields
    'fields' => array(
        array(
            'type' => 'heading',
            'name' => __( 'Portfolio Meta Options', 'mango' ),
            'id'   => 'format_banner_heading', // Not used but needed for plugin
        ),
        array(
            'name'             => __( 'Portfolio Type', 'mango' ),
            'id'               => "{$prefix}portfolio_single_type",
            'type'             => 'select_advanced',
            'options'          =>array(
                ''          =>  'Use Default',
                'boxed'     =>  'Boxed',
                'full-width'   =>  'Full Width',
            )
        ),
        array(
            'type' => 'url',
            'name' => __( 'Portfolio Link', 'mango' ),
            'id'   => "{$prefix}portfolio_link", // Not used but needed for plugin
            'placeholder'   =>__('Portfolio Link',"mango")
        ),
        array(
            'type' => 'text',
            'name' => __( 'Client', 'mango' ),
            'id'   => "{$prefix}portfolio_client", // Not used but needed for plugin
            'placeholder'   =>__('Client Name',"mango")
        ),
        array(
            'type' => 'text',
            'name' => __( 'Author', 'mango' ),
            'id'   => "{$prefix}portfolio_author", // Not used but needed for plugin
            'placeholder'   =>__('Author Name',"mango")
        ),
        array(
            'name'             => __( 'Portfolio Banner Type', 'mango' ),
            'id'               => "{$prefix}banner_portfolio",
            'type'             => 'select_advanced',
            'options'          =>array(
                ''          =>  'No Banner',
                'video'     =>  'Video',
                'gallery'   =>  'Gallery',
            )
        ),
        array(
            'name'             => __( 'Slider Images', 'mango' ),
            'id'               => "{$prefix}portfolio_option_image",
            'type'             => 'image_advanced',
            'max_file_uploads' => 6,
        ),
        array(
            'name' => __( 'Video URL', 'mango' ),
            'id'   => "{$prefix}portfolio_video_embed",
            'type' => 'oembed',
            'desc' => 'Paste the URL of the Flash (YouTube or Vimeo etc). Only necessary when the Banner Type is video.',
            //class="embed-responsive-item"
        ),
    )
);
?>