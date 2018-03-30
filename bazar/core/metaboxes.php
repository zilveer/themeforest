<?php
/**
 * Your Inspiration Themes
 *
 * In this files the framework register default metaboxes.
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

yit_register_metabox( 'yit-page-settings', __( 'Page settings', 'yit' ), 'page' );
yit_register_metabox( 'yit-post-settings', __( 'Post settings', 'yit' ), 'post' );
yit_register_metabox( 'yit-testimonial-site', __( 'Other Testimonial info', 'yit' ), 'testimonial' );
yit_register_metabox( 'yit-page-extra-content', __( 'Extra content', 'yit' ), 'page' );
/**
 * SETTINGS TAB
 */
$options = array(
    'title' => __( 'Show title', 'yit' ),
    'desc' =>  __( 'Show or not the title of the page.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Settings', 'yit' ), '_show-title', 'checkbox', $options );
yit_metaboxes_sep( 'yit-page-settings', __( 'Settings', 'yit' ) );

$options = array(
    'title' => __( 'Show breadcrumb', 'yit' ),
    'desc' =>  __( 'Show or not the breadcrumb.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Settings', 'yit' ), '_show-breadcrumb', 'checkbox', $options );
yit_metaboxes_sep( 'yit-page-settings', __( 'Settings', 'yit' ) );

$options = array(
    'title' => __( 'Slogan', 'yit' ),
    'desc' =>  __( 'Show a slogan before the page content.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Settings', 'yit' ), '_slogan', 'text', $options );
yit_metaboxes_sep( 'yit-page-settings', __( 'Settings', 'yit' ) );

$options = array(
    'title' => __( 'Sub slogan', 'yit' ),
    'desc' =>  __( 'Show a sub slogan before the page content.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Settings', 'yit' ), '_sub-slogan', 'text', $options );
yit_metaboxes_sep( 'yit-page-settings', __( 'Settings', 'yit' ) );

$options = array(
    'title' => __( 'Sidebar', 'yit' ),
    'desc' =>  __( 'Select the sidebar layout and the sidebar to use.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Settings', 'yit' ), '_sidebar-layout', 'sidebar-layout', $options );
yit_add_option_metabox( 'yit-post-settings', __( 'Settings', 'yit' ), '_sidebar-layout', 'sidebar-layout', $options );

/**
 * SEO TAB
 */
$options = array(
    'title' => __( 'Title', 'yit' ),
    'desc' =>  __( 'This title will be used when a user visit the page.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'SEO', 'yit' ), '_seo-title', 'text', $options );
yit_add_option_metabox( 'yit-post-settings', __( 'SEO', 'yit' ), '_seo-title', 'text', $options );

if( is_shop_installed() ) {
    yit_add_option_metabox( 'yit-custom-product-settings', __( 'SEO', 'yit' ), '_seo-title', 'text', $options );
}

yit_metaboxes_sep( 'yit-page-settings', __( 'SEO', 'yit' ) );

$options = array(
    'title' => __( 'Keywords', 'yit' ),
    'desc' =>  __( 'Keywords for this page.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'SEO', 'yit' ), '_seo-keywords', 'text', $options );
yit_add_option_metabox( 'yit-post-settings', __( 'SEO', 'yit' ), '_seo-keywords', 'text', $options );

if( is_shop_installed() ) {
    yit_add_option_metabox( 'yit-custom-product-settings', __( 'SEO', 'yit' ), '_seo-keywords', 'text', $options );
}
yit_metaboxes_sep( 'yit-page-settings', __( 'SEO', 'yit' ) );

$options = array(
    'title' => __( 'Description', 'yit' ),
    'desc' =>  __( 'Description for this page.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'SEO', 'yit' ), '_seo-description', 'text', $options );
yit_add_option_metabox( 'yit-post-settings', __( 'SEO', 'yit' ), '_seo-description', 'text', $options );

if( is_shop_installed() ) {
    yit_add_option_metabox( 'yit-custom-product-settings', __( 'SEO', 'yit' ), '_seo-description', 'text', $options );
}
yit_metaboxes_sep( 'yit-page-settings', __( 'SEO', 'yit' ) );

/**
 * HEADER TAB
 */
$options = array(
    'title' => __( 'Slider', 'yit' ),
    'options' => array( '' => __( 'Default', 'yit' ), 'none' => __( 'None', 'yit' ) ) + yit_get_sliders(),
    'desc' =>  __( 'Select the slider that you want to use in the page.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_slider_name', 'select', $options );

yit_metaboxes_sep( 'yit-page-settings', __( 'Header', 'yit' ) );

$options = array(
    'title' => __( 'Use static image', 'yit' ),
    'desc'  =>  __( 'Set YES if you want a static header, instead of the slider.', 'yit' ),
    'std'   => 0
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_use_static_image', 'onoff', $options );

$options = array(
    'title' => __( 'Static image', 'yit' ),
    'desc'  =>  __( 'Upload here the image to use for the static header, only if you have set to YES the option above.', 'yit' ),
    'std'   => ''
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_static_image', 'upload', $options );

$options = array(
    'title' => __( 'Static image Link', 'yit' ),
    'desc'  =>  __( 'The URL where the fixed image will link.', 'yit' ),
    'std'   => ''
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_static_image_link', 'text', $options );

$options = array(
    'title' => __( 'Static image target', 'yit' ),
    'desc' =>  __( 'How to open the link of the static image.', 'yit' ),
    'options' => array(
        '_self' => __( 'Default', 'yit' ),
        '_parent' => __( 'Parent frameset', 'yit' ),
        '_top' => __( 'Full body of the window', 'yit' ),
        '_blank' => __( 'In a new window', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Header', 'yit' ), '_static_image_target', 'select', $options );

/**
 * BACKGROUND TAB
 */
$options = array(
    'title' => __( 'Background color', 'yit' ),
    'desc' =>  __( 'Select the background color of the body (leave empty to use default, defined in Theme Options -> Colors -> General).', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Body Background', 'yit' ), '_bg_color', 'colorpicker', $options );

yit_metaboxes_sep( 'yit-page-settings', __( 'Body Background', 'yit' ) );

$options = array(
    'title' => __( 'Background image', 'yit' ),
    'desc' =>  __( 'Select the background image (leave empty to use default, defined in Theme Options -> Colors -> General).', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Body Background', 'yit' ), '_bg_image', 'upload', $options );

$options = array(
    'title' => __( 'Background repeat', 'yit' ),
    'desc' =>  __( 'Select the repeat mode for the background image (default is defined in Theme Options -> Colors -> General).', 'yit' ),
    'options' => array(
        '' => __( 'Default', 'yit' ),
        'repeat' => __( 'Repeat', 'yit' ),
        'repeat-x' => __( 'Repeat Horizontally', 'yit' ),
        'repeat-y' => __( 'Repeat Vertically', 'yit' ),
        'no-repeat' => __( 'No Repeat', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Body Background', 'yit' ), '_bg_image_repeat', 'select', $options );

$options = array(
    'title' => __( 'Background position', 'yit' ),
    'desc' =>  __( 'Select the position for the background image (default is defined in Theme Options -> Colors -> General).', 'yit' ),
    'options' => array(
        '' => __( 'Default', 'yit' ),
        'center' => __( 'Center', 'yit' ),
        'top left' => __( 'Top left', 'yit' ),
        'top center' => __( 'Top center', 'yit' ),
        'top right' => __( 'Top right', 'yit' ),
        'bottom left' => __( 'Bottom left', 'yit' ),
        'bottom center' => __( 'Bottom center', 'yit' ),
        'bottom right' => __( 'Bottom right', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Body Background', 'yit' ), '_bg_image_position', 'select', $options );

$options = array(
    'title' => __( 'Background attachment', 'yit' ),
    'desc' =>  __( 'Select the attachment for the background image (default is defined in Theme Options -> Colors -> General).', 'yit' ),
    'options' => array(
        '' => __( 'Default', 'yit' ),
        'scroll' => __( 'Scroll', 'yit' ),
        'fixed' => __( 'Fixed', 'yit' ),
    ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Body Background', 'yit' ), '_bg_image_attachment', 'select', $options );

$options = array(
    'title' => __( 'URL', 'yit' ),
    'desc' =>  __( '<a href="http://maps.google.com/" title="Google Maps">Google Maps</a> map URL.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-settings', __( 'Google Map', 'yit' ), '_google-map', 'text', $options );

/**
 * TESTIMONIAL
 */
$options = array(
    'title' => __( 'Label', 'yit' ),
    'desc' =>  __( 'Insert the label used for testimonial if Website Url is set.', 'yit' ),
);
yit_add_option_metabox( 'yit-testimonial-site', __( 'Settings', 'yit' ), '_site-label', 'text', $options );
yit_metaboxes_sep( 'yit-testimonial-site', __( 'Settings', 'yit' ) );

$options = array(
    'title' => __( 'Web Site URL', 'yit' ),
    'desc' =>  __( 'Insert the url referred to Testimonial.', 'yit' ),
);
yit_add_option_metabox( 'yit-testimonial-site', __( 'Settings', 'yit' ), '_site-url', 'text', $options );


/**
 * POST FORMATS
 */
$options = array(
    'title' => __( 'Audio URL', 'yit' ),
    'desc' => __( 'Insert the <a href="http://soundcloud.com" title="SoundCloud">SoundCloud.com</a> song URL.', 'yit' )
);
yit_add_option_metabox( 'yit-post-settings', __( 'Post formats', 'yit' ), '_format_audio', 'text', $options );

$options = array(
    'title' => __( 'Use iFrame', 'yit' ),
    'desc' => __( 'Use iFrame instead of Flash.', 'yit' )
);
yit_add_option_metabox( 'yit-post-settings', __( 'Post formats', 'yit' ), '_format_audio_iframe', 'onoff', $options );

$options = array(
    'title' => __( 'Show artwork', 'yit' ),
    'desc' => __( 'Show the artwork of the song.', 'yit' )
);
yit_add_option_metabox( 'yit-post-settings', __( 'Post formats', 'yit' ), '_format_audio_artwork', 'onoff', $options );

$options = array(
    'title' => __( 'Show comments', 'yit' ),
    'desc' => __( 'Show comments of the song.', 'yit' )
);
yit_add_option_metabox( 'yit-post-settings', __( 'Post formats', 'yit' ), '_format_audio_comments', 'onoff', $options );

$options = array(
    'title' => __( 'Auto play', 'yit' ),
    'desc' => __( 'Automatically play the sond.', 'yit' )
);
yit_add_option_metabox( 'yit-post-settings', __( 'Post formats', 'yit' ), '_format_audio_autoplay', 'onoff', $options );

$options = array(
    'title' => __( 'Color', 'yit' ),
    'desc' => __( 'Template color.', 'yit' )
);
yit_add_option_metabox( 'yit-post-settings', __( 'Post formats', 'yit' ), '_format_audio_color', 'colorpicker', $options );
yit_metaboxes_sep( 'yit-post-settings', __( 'Post formats', 'yit' ) );

$options = array(
    'title' => __( 'Video ID', 'yit' ),
    'desc' => __( 'Insert the video URL.', 'yit' )
);
yit_add_option_metabox( 'yit-post-settings', __( 'Post formats', 'yit' ), '_format_video', 'text', $options );

$options = array(
    'title' => __( 'Host', 'yit' ),
    'desc' => __( 'Select where is the video hosted.', 'yit' ),
    'options' => array(
        'youtube' => __( 'YouTube', 'yit' ),
        'vimeo' => __( 'Vimeo', 'yit' ),
        'dailymotion' => __( 'DailyMotion', 'yit' ),
        'yahoo' => __( 'Yahoo!', 'yit' ),
        'bliptv' => __( 'Blip TV', 'yit' ),
        'viddler' => __( 'Viddler', 'yit' ),
        'veoh' => __( 'Veoh', 'yit' )
    )
);
yit_add_option_metabox( 'yit-post-settings', __( 'Post formats', 'yit' ), '_format_video_host', 'select', $options );

/**
 * EXTRA CONTENT
 */
$options = array(
    'desc' =>  __( 'Put here the content you want to show after content and sidebar.', 'yit' ),
);
yit_add_option_metabox( 'yit-page-extra-content', __( 'Extra content', 'yit' ), '_extra-content', 'textarea-editor', $options );

include_once YIT_THEME_FUNC_DIR . '/metaboxes.php';