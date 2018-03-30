<?php
add_action('admin_init', 'stag_site_settings');
function stag_site_settings(){
    $site_settings['description'] = 'Configure site settings of your theme.';

    $site_settings[] = array(
        'title' => __('Site Title', 'stag'),
        'desc'  => __('Enter the default title for the site header section.', 'stag'),
        'type'  => 'text',
        'id'    => 'site_title',
        'val'   => 'Blog Posts'
    );

    $site_settings[] = array(
        'title' => __('Site Subtitle', 'stag'),
        'desc'  => __('Enter the default subtitle for the site header section.', 'stag'),
        'type'  => 'text',
        'id'    => 'site_subtitle',
        'val'   => 'Blogging about everything web'
    );

    $site_settings[] = array(
        'title' => __('Blog Background Image', 'stag'),
        'desc'  => __('Upload a default background image for the site header section.', 'stag'),
        'type'  => 'files',
        'id'    => 'site_background',
        'val'   => __('Upload Background', 'stag')
    );

    $site_settings[] = array(
        'title' => __('Blog Background Color', 'stag'),
        'desc'  => __('Choose a default background color for the site header section.', 'stag'),
        'type'  => 'color',
        'id'    => 'site_background_color',
        'val'   => '#2b373c'
    );

    $site_settings[] = array(
        'title' => __('Blog Background Opacity', 'stag'),
        'desc'  => __('Choose a default value for background image at the site header section. For no opacity give a value of 100.', 'stag'),
        'type'  => 'text',
        'id'    => 'site_background_opacity',
        'val'   => '50'
    );

    $site_settings[] = array(
        'title' => __('Slideshow Duration', 'stag'),
        'desc'  => __('Enter the duration between slideshows.<br>1000 is equal to 1 second.', 'stag'),
        'type'  => 'text',
        'id'    => 'site_slide_duration',
        'val'   => '4000',
    );

    $site_settings[] = array(
        'title' => __('Fade Duration', 'stag'),
        'desc'  => __('Enter the duration between slideshows fade animation.<br>1000 is equal to 1 second.', 'stag'),
        'type'  => 'text',
        'id'    => 'site_fade_duration',
        'val'   => '750',
    );

    stag_add_framework_page( 'Site Settings', $site_settings, 15 );
}


function stag_theme_background_styles($content){
  $output = "/* Custom Styles Output for background */\n";
  $opacity = intval(stag_get_option('site_background_opacity'));
  $opacityVal = intval($opacity)/100;

  $output .= ".custom-background.universal{ ";
  $output .= "background-color: ". stag_get_option('site_background_color') ."!important;";
  $output .= "  }\n";

  $output .= ".custom-background.universal .backstretch{ opacity: {$opacityVal}; filter: progid:DXImageTransform.Microsoft.Alpha(Opacity={$opacity}); }\n\n";

  $content .= $output;
  return $content;
}
add_action('stag_custom_styles', 'stag_theme_background_styles');
