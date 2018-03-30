<?php

/* ************************************************************************************** 
Social Media
************************************************************************************** */

$wp_customize->add_section( 'swm_customizer_sm_icons', array(
    'title'    => __( 'Social Media Icons', 'swmtranslate' ),
    'priority' => 110
));

$wp_customize->add_setting( 'swm_open_sm_new_window', array(
    'default' => 1
));

$wp_customize->add_control( 'swm_open_sm_new_window', array(
    'type'     => 'checkbox',
    'label'    => __( 'Open media websites in new window', 'swmtranslate' ),
    'section'  => 'swm_customizer_sm_icons',
    'priority' => 1   
));

$swm_sm_icons = array( __('Twitter', 'swmtranslate' ), __('Facebook', 'swmtranslate' ), __('YouTube', 'swmtranslate' ), __('Delicious', 'swmtranslate' ), __('Vimeo', 'swmtranslate' ), __('Flickr', 'swmtranslate' ), __('Digg', 'swmtranslate' ), __('StumbleUpon', 'swmtranslate' ), __('LinkedIn', 'swmtranslate' ), __('Blogger', 'swmtranslate' ), __('Technorati', 'swmtranslate' ), __('Pinterest', 'swmtranslate' ), __('Apple', 'swmtranslate' ), __('Dropbox', 'swmtranslate' ), __('Amazon', 'swmtranslate' ), __('Picasa', 'swmtranslate' ), __('Skype', 'swmtranslate' ), __('deviantART', 'swmtranslate' ), __('Windows', 'swmtranslate' ), __('Tumblr', 'swmtranslate' ), __('Lastfm', 'swmtranslate' ),
__('Yahoo', 'swmtranslate' ), __('Wordpress', 'swmtranslate' ), __('Dribble', 'swmtranslate' ), __('Forest', 'swmtranslate' ), __('Google', 'swmtranslate' ), __('GooglePlus', 'swmtranslate' ), __('AppleStore', 'swmtranslate' ), __('Instagram', 'swmtranslate' ), __('Myspace', 'swmtranslate' ), __('SoundCloud', 'swmtranslate' ), __('RSS', 'swmtranslate' ) );

$sm_sites_number = 2;

foreach ($swm_sm_icons as $swm_sm_icon) {

    $sm_sites_number++;

    $sm_icon = 'swm_' . strtolower($swm_sm_icon);

    $wp_customize->add_setting( $sm_icon, array(
        'default' => ''
    ));

    $wp_customize->add_control( $sm_icon, array(
        'type'     => 'text',
        'label'    => $swm_sm_icon,
        'section'  => 'swm_customizer_sm_icons',
        'priority' => $sm_sites_number
    ));
        
}