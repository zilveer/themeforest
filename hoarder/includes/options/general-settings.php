<?php

/**
 * Create the General Settings section
 */
add_action('admin_init', 'zilla_general_settings');
function zilla_general_settings() {
    
    if( is_plugin_active( 'zilla-likes/zilla-likes.php' ) ) {
        $notice = '';
    } elseif( is_plugin_inactive( 'zilla-likes/zilla-likes.php' ) ) {
        $notice = '<div class="error"><p>' . sprintf( __('Please activate %s to display likes', 'zilla'), '<a href="plugins.php#zillalikes">ZillaLikes</a>' ) . '</p></div>';
    } else {
        $notice = '<div class="error"><p>' . sprintf( __('This theme requires %s to display likes', 'zilla'), '<a href="http://www.themezilla.com/plugins/zillalikes?page=hoarder-theme-options">ZillaLikes</a>' ) . '</p></div>';
    }
        
    $general_settings['description'] = __('Control and configure the general setup of your theme. Upload your preferred logo, setup your feeds and insert your analytics tracking code.', 'zilla') . $notice;
                                
	$general_settings[] = array('title' => __('Plain Text Logo', 'zilla'),
                                'desc' => __('Check this box to enable a plain text logo rather than upload an image. Will use your site name.', 'zilla'),
                                'type' => 'checkbox',
                                'id' => 'general_text_logo');
                                
	$general_settings[] = array('title' => __('Custom Logo Upload', 'zilla'),
                                'desc' => __('Upload a logo for your theme.', 'zilla'),
                                'type' => 'file',
                                'id' => 'general_custom_logo',
                                'val' => 'Upload Image');
								
    $general_settings[] = array('title' => __('Custom Favicon Upload', 'zilla'),
                                'desc' => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.', 'zilla'),
                                'type' => 'file',
                                'id' => 'general_custom_favicon',
                                'val' => 'Upload Image');
                                
    $general_settings[] = array('title' => __('Contact Form Email Address', 'zilla'),
                                'desc' => __('Enter the email address where you\'d like to receive emails from the contact form, or leave blank to use admin email.', 'zilla'),
                                'type' => 'text',
                                'id' => 'general_contact_email');
                                
    $general_settings[] = array('title' => __('FeedBurner URL', 'zilla'),
                                'desc' => __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress feed e.g. http://feeds.feedburner.com/yoururlhere', 'zilla'),
                                'type' => 'text',
                                'id' => 'general_feedburner_url');
                                
    $general_settings[] = array('title' => __('Tracking Code', 'zilla'),
                                'desc' => __('Paste your Google Analytics (or other) tracking code here. It will be inserted before the closing body tag of your theme.', 'zilla'),
                                'type' => 'textarea',
                                'id' => 'general_tracking_code');
                                
    zilla_add_framework_page( 'General Settings', $general_settings, 5 );
}


/**
 * Output the favicon
 */
function zilla_custom_favicon(){
    $zilla_values = get_option( 'zilla_framework_values' );
    if( array_key_exists( 'general_custom_favicon', $zilla_values ) && $zilla_values['general_custom_favicon'] != '' )
        echo '<link rel="shortcut icon" href="'. $zilla_values['general_custom_favicon'] .'" />' . "\n";
}
add_action( 'wp_head', 'zilla_custom_favicon' );

/**
 * Redirect the RSS feed
 * Credit: Feedburner Feedsmith Plugin
 */
if( !preg_match("/feedburner|feedvalidator/i", $_SERVER['HTTP_USER_AGENT']) ){
	add_action( 'template_redirect', 'zilla_feed_redirect' );
	add_action( 'init', 'zilla_check_url' );
}
function zilla_feed_redirect() {
	global $wp, $feed, $withcomments;
    
    $zilla_values = get_option( 'zilla_framework_values' );
    if( array_key_exists( 'general_feedburner_url', $zilla_values ) && $zilla_values['general_feedburner_url'] != '' ){
        if( is_feed() && $feed != 'comments-rss2' && !is_single() && $wp->query_vars['category_name'] == '' && ($withcomments != 1) ){
            if( function_exists('status_header') ) status_header( 302 );
            header("Location:" . trim($zilla_values['general_feedburner_url']));
            header("HTTP/1.1 302 Temporary Redirect");
            exit();
        }
    }
}
function zilla_check_url() {
	$zilla_values = get_option( 'zilla_framework_values' );
    if( array_key_exists( 'general_feedburner_url', $zilla_values ) && $zilla_values['general_feedburner_url'] != '' ){
        switch( basename($_SERVER['PHP_SELF']) ){
            case 'wp-rss.php':
            case 'wp-rss2.php':
            case 'wp-atom.php':
            case 'wp-rdf.php':
                if( function_exists('status_header') ) status_header( 302 );
                header("Location:" . trim($zilla_values['general_feedburner_url']));
                header("HTTP/1.1 302 Temporary Redirect");
                exit();
                break;
        }
    }
}

/**
 * Output the tracking code
 */
function zilla_tracking_code(){
    $zilla_values = get_option( 'zilla_framework_values' );
    if( array_key_exists( 'general_tracking_code', $zilla_values ) && $zilla_values['general_tracking_code'] != '' )
        echo stripslashes($zilla_values['general_tracking_code']);
}
add_action( 'wp_footer', 'zilla_tracking_code' );

?>