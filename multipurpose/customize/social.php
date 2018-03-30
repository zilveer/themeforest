<?php
function multipurpose_customize_register_social($wp_customize) {
	$wp_customize->add_section('social', array(
		'title' => esc_attr__('Social media profiles', 'multipurpose'),
		'priority' => 16
	));

	$socials = array('facebook', 'twitter', 'googleplus', 'pinterest', 'rss', 'instagram', 'skype', 'tumblr', 'linkedin', 'flickr', 'vimeo', 'blogger', 'behance', 'youtube', 'dribble', 'picasa', 'github', 'stumbleupon', 'lastfm', 'email');
    $socials_names = array('Facebook', 'Twitter', 'Google+', 'Pinterest', 'RSS', 'Instagram', 'Skype', 'Tumblr', 'LinkedIn', 'Flickr', 'Vimeo', 'Blogger', 'Behance', 'YouTube', 'Dribble', 'Picasa', 'GitHub', 'StumbleUpon', 'Last.fm', 'E-mail');

    $wp_customize->add_setting('show_rss', array('default' => 0));
	$wp_customize->add_control(new WP_Customize_Control($wp_customize, 'show_rss',
        array(
            'label'     => esc_attr__('Disable RSS link', 'multipurpose'),
            'section'   => 'social',
            'settings'  => 'show_rss',
            'type'      => 'checkbox',
            'priority'  => 0
        )
	));

    foreach($socials as $k=>$v) {
    	if($v == 'rss') continue; 
    	$setting_name = 'social_' . $v;
    	$wp_customize->add_setting($setting_name, array());
		$wp_customize->add_control($setting_name, array(
			'label' => $socials_names[$k],
			'section' => 'social',
			'settings' => $setting_name,
			'priority' => $k + 1
		));	
    }
}

add_action('customize_register', 'multipurpose_customize_register_social');