<?php
add_action('admin_init', 'stag_general_settings');
function stag_general_settings(){
    $general_settings['description'] = 'Configure general settings of your theme. Upload your preferred logo, favicon, and insert your analytics tracking code.';

    $general_settings[] = array(
        'title' => __('Plain Text Logo', 'stag'),
        'desc'  => __('Check this box to enable a plain text logo rather than an image logo. Will use your site title.', 'stag'),
        'type'  => 'checkbox',
        'id'    => 'general_text_logo',
        'val'   => 'on'
    );

  $general_settings[] = array(
        'title' => __('Custom Logo Upload', 'stag'),
        'desc'  => __('Upload a logo for your theme.', 'stag'),
        'type'  => 'file',
        'id'    => 'general_custom_logo',
        'val'   => __('Upload Image', 'stag')
    );

    $general_settings[] = array(
        'title' => __('Custom Favicon Upload', 'stag'),
        'desc'  => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon. Use <a href="http://www.xiconeditor.com/" target="_blank" rel="nofollow">X-Icon Editor</a> to easily create a favicon.', 'stag'),
        'type'  => 'file',
        'id'    => 'general_custom_favicon',
        'val'   => __('Upload Image', 'stag')
    );

    $general_settings[] = array(
        'title' => __('Contact Form Email Address', 'stag'),
        'desc'  => __('Enter the <code>email address</code> where you\'d like to receive emails from the contact form, or leave blank to use admin email.', 'stag'),
        'type'  => 'text',
        'id'    => 'general_contact_email'
    );

    $general_settings[] = array(
        'title' => __('Tracking Code', 'stag'),
        'desc'  => __('Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.', 'stag'),
        'type'  => 'textarea',
        'id'    => 'general_tracking_code'
    );

    $general_settings[] = array(
        'title' => __('Footer Copyright Text', 'stag'),
        'desc'  => __('Enter the text to display in footer copyright area.', 'stag'),
        'type'  => 'wysiwyg',
        'id'    => 'general_footer_text',
        'val'   => 'Copyright '.date('Y').' - '.get_bloginfo('title')
    );

    $general_settings[] = array(
        'title' => __('Disable Admin Bar', 'stag'),
        'desc'  => __('Enable/Disable WordPress Admin Bar for all users.', 'stag'),
        'type'  => 'checkbox',
        'id'    => 'general_disable_admin_bar',
        'val'   => 'off'
    );

    $general_settings[] = array(
        'title' => __('Disable SEO Settings', 'stag'),
        'desc'  => __('Enable/Disable SEO Settings on single posts and pages.', 'stag'),
        'type'  => 'checkbox',
        'id'    => 'general_disable_seo_settings',
        'val'   => 'off'
    );

    stag_add_framework_page( 'General Settings', $general_settings, 5 );
}

// OUTPUT THE FAVICON
function stag_show_favicon(){
    $stag_values =  get_option('stag_framework_values');
    if(stag_get_option('general_custom_favicon') != ''){
        echo '<link rel="shortcut icon" href="'.$stag_values['general_custom_favicon'].'" type="image/x-icon" />';
    }else{
        echo '<link rel="shortcut icon" href="'.get_template_directory_uri().'/assets/img/favicon.ico" type="image/x-icon" />';
    }
}
add_action('wp_head', 'stag_show_favicon');


if(stag_get_option('general_disable_admin_bar') === 'on'){
    show_admin_bar(false);
}

/**
* Output the tracking code
*/
function stag_tracking_code(){
    $stag_values = get_option( 'stag_framework_values' );
    if( array_key_exists( 'general_tracking_code', $stag_values ) && $stag_values['general_tracking_code'] != '' )
        echo stripslashes($stag_values['general_tracking_code']);
}
add_action( 'wp_footer', 'stag_tracking_code' );
