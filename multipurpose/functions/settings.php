<?php

add_action('admin_init', 'multipurpose_initialize_theme_options');
function multipurpose_initialize_theme_options() {  

    //social links
    add_settings_section(  
        'social_links_section',         // ID used to identify this section and with which to register options  
        'Social Links',                  // Title to be displayed on the administration page  
        'multipurpose_social_links_callback', // Callback used to render the description of the section  
        'general'                           // Page on which to add this section of options  
    );  
    $socials = array('facebook', 'twitter', 'pinterest', 'linkedin', 'flickr', 'vimeo', 'blogger', 'tumblr', 'skype', 'behance', 'googleplus', 'youtube', 'dribble', 'instagram', 'picasa', 'github', 'stumbleupon', 'lastfm', 'email');
    $socials_names = array('Facebook', 'Twitter', 'Pinterest', 'LinkedIn', 'Flickr', 'Vimeo', 'Blogger', 'Tumblr', 'Skype', 'Behance', 'Google+', 'YouTube', 'Dribble', 'Instagram', 'Picasa', 'GitHub', 'StumbleUpon', 'Last.fm', 'E-mail');

    foreach ($socials as $k=>$v) {
		add_settings_field(   
		    $v.'_link',                     
		    $socials_names[$k],                   
		    'social_links_callback',
		    'general',                 
		    'social_links_section',    
		    array($v)  
		);
		register_setting('general', $v.'_link');
    } 
    add_settings_field(
        'show_rss', 
        esc_attr__('Show RSS feed link', 'multipurpose'),
        'show_rss_link_callback',
        'general',
        'social_links_section',
        'show_rss'
    );
    register_setting('general', 'show_rss');
}

function multipurpose_social_links_callback() {  
    echo '<p>Put your social networks profile links below to make them appear on your site.</p>';  
}

function social_links_callback($args) {  
    $html = '<input type="text" id="'.$args[0].'_link" name="'.$args[0].'_link" value="'.get_option($args[0].'_link').'" />';  
    echo $html;       
}

function show_rss_link_callback($setting) {  
    $checked = get_option($setting) ? 'checked="checked"' : '';
    $html = '<input type="checkbox" id="'.$setting.'" name="'.$setting.'" value="1" '.$checked.' />';  
    echo $html;       
}