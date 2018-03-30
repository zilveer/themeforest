<?php if ( ! defined( 'ABSPATH' ) ) die( 'Direct access forbidden.' );
/**
 * Include static files: javascript and css
 */

$template_directory_uri = get_template_directory_uri();

/**
 * Enqueue scripts and styles for the front end.
 */

wp_deregister_style( 'fw-main' );
wp_deregister_style( 'fw-font-awesome' );
wp_deregister_style( 'fw-shortcode-testimonials' );
wp_deregister_style( 'fw-shortcode-section' );
wp_deregister_style( 'fw-shortcode-section-backround-video' );
wp_deregister_style( 'fw-ext-builder-frontend-grid' );
wp_deregister_style( 'fw-ext-forms-default-styles' );

// Load our main stylesheet.
wp_enqueue_style(
    'normalize',
    esc_url($template_directory_uri . '/css/normalize.css'),
    array(),
    ''
);

wp_enqueue_style(
    'base',
    esc_url($template_directory_uri . '/css/base.css'),
    array(),
    ''
);



if(defined('FW'))
{
    $skin = fw_get_db_settings_option('skin');

    if($skin == 'dark') {
        wp_enqueue_style(
            'style',
            esc_url($template_directory_uri . '/css/dark.css'),
            array(),
            ''
        );
    }
    else{
        wp_enqueue_style(
            'style',
            esc_url(get_stylesheet_uri()),
            array(),
            ''
        );
    }
}
else
{
    wp_enqueue_style(
        'style',
        esc_url(get_stylesheet_uri()),
        array(),
        ''
    );
}

wp_enqueue_style(
    'font-awesome.min',
    esc_url($template_directory_uri . '/css/font-awesome.min.css'),
    array(),
    ''
);

wp_enqueue_style(
    'animate',
    esc_url($template_directory_uri . '/css/animate.css'),
    array(),
    ''
);

wp_enqueue_style(
    'fontastic',
    esc_url($template_directory_uri . '/css/fontastic.css'),
    array(),
    ''
);

wp_enqueue_style(
    'moutheme-icon',
    esc_url($template_directory_uri . '/css/moutheme-icon.css'),
    array(),
    ''
);

if(defined('FW'))
{
    $color = fw_get_db_settings_option('color-scheme');

    //enque predefined css styles
    if($color['scheme'] != 'custom' && !empty($color['scheme']))
    {
        wp_enqueue_style(
            'fw-colors',
            esc_url($template_directory_uri . '/css/colors/'.$color['scheme'].'.css'),
            array(),
            ''
        );
    }

    //if custom color is empty include blue  style by default
    if($color['scheme'] == 'custom' || empty($color['scheme'])) {
            wp_enqueue_style(
                'fw-colors',
                esc_url($template_directory_uri . '/css/colors/blue.css'),
                array(),
                ''
            );
    }
}
else
{
    wp_enqueue_style(
        'fw-colors-css',
        esc_url($template_directory_uri . '/css/colors/blue.css'),
        array(),
        ''
    );
}

wp_enqueue_script( 'jquery', true );

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
}

wp_enqueue_script(
    'modernizr',
    esc_url($template_directory_uri . '/js/modernizr.js'),
    array( 'jquery' ),
    '',
    false
);

wp_enqueue_script(
    'webfont',
    esc_url($template_directory_uri . '/js/webfont.js'),
    array( 'jquery' ),
    '',
    false
);

wp_enqueue_script(
    'jquery.xdomainrequest.min',
    esc_url($template_directory_uri . '/js/jquery.xdomainrequest.min.js'),
    array( 'jquery' ),
    '',
    true
);

wp_enqueue_script(
    'jquery.moutheme',
    esc_url($template_directory_uri . '/js/jquery.moutheme.js'),
    array( 'jquery' ),
    '',
    true
);

wp_enqueue_script(
    'jquery.mixitup.min',
    esc_url($template_directory_uri . '/js/jquery.mixitup.min.js'),
    array( 'jquery' ),
    '',
    true
);

wp_enqueue_script(
    'wow.min',
    esc_url($template_directory_uri . '/js/wow.min.js'),
    array( 'jquery' ),
    '',
    true
);

wp_enqueue_script(
    'affix',
    esc_url($template_directory_uri . '/js/affix.js'),
    array( 'jquery' ),
    '',
    true
);

wp_enqueue_script(
    'jquery.stellar',
    esc_url($template_directory_uri . '/js/jquery.stellar.js'),
    array( 'jquery' ),
    '',
    true
);

wp_enqueue_script(
    'default',
    esc_url($template_directory_uri . '/js/default.js'),
    array( 'jquery' ),
    '',
    true
);

wp_enqueue_script(
    'placeholders.min',
    esc_url($template_directory_uri . '/js/placeholders.min.js'),
    array( 'jquery' ),
    '',
    true
);