<?php

add_action( 'admin_init', 'stag_site_settings' );

function stag_site_settings(){
	$settings['description'] = __( 'Customize your site settings.', 'stag' );

	$settings[] = array(
	    'title' => __( 'Blog Page Background', 'stag' ),
	    'desc'  => __( 'Upload the background image for blog page.', 'stag' ),
	    'type'  => 'file',
	    'id'    => 'blog_page_background'
	);

	$settings[] = array(
	    'title' => __( 'Show Search box in Main Menu', 'stag' ),
	    'desc'  => __( 'Display a search box in main navigation.', 'stag' ),
	    'type'  => 'checkbox',
	    'id'    => 'site_show_searchbar_in_nav',
	    'val'	=> 'on'
	);

	$settings[] = array(
	    'title' => __( 'Disable Comments on Pages', 'stag' ),
	    'desc'  => __( 'This will globally turn off the comments on pages.', 'stag' ),
	    'type'  => 'checkbox',
	    'id'    => 'site_comments_on_pages',
	    'val'	=> 'off'
	);

	stag_add_framework_page( __( 'Site Settings', 'stag' ), $settings, 15 );
}
