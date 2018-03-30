<?php

if( !defined('ABSPATH') ) exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = "videotube";

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
	// TYPICAL -> Change these values as you need/desire
	'opt_name'             => $opt_name,
	// This is where your data is stored in the database and also becomes your global variable name.
	'display_name'         => $theme->get( 'Name' ),
	// Name that appears at the top of your panel
	'display_version'      => $theme->get( 'Version' ),
	// Version that appears at the top of your panel
	'menu_type'            => 'submenu',
	//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
	'allow_sub_menu'       => true,
	// Show the sections below the admin menu item or not
	'menu_title'           => __( 'Theme Options', 'mars' ),
	'page_title'           => __( 'Theme Options', 'mars' ),
	// You will need to generate a Google API key to use this feature.
	// Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
	'google_api_key'       => '',
	// Set it you want google fonts to update weekly. A google_api_key value is required.
	'google_update_weekly' => false,
	// Must be defined to add google fonts to the typography module
	'async_typography'     => true,
	// Use a asynchronous font on the front end or font string
	//'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
	'admin_bar'            => true,
	// Show the panel pages on the admin bar
	'admin_bar_icon'       => 'dashicons-portfolio',
	// Choose an icon for the admin bar menu
	'admin_bar_priority'   => 50,
	// Choose an priority for the admin bar menu
	'global_variable'      => 'videotube',
	// Set a different name for your global variable other than the opt_name
	'dev_mode'             => false,
	// Show the time the page took to load, etc
	'update_notice'        => false,
	// If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
	'customizer'           => true,
	// Enable basic customizer support
	//'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
	//'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
	
	// OPTIONAL -> Give you extra features
	'page_priority'        => null,
	// Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
	'page_parent'          => 'themes.php',
	// For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	'page_permissions'     => 'manage_options',
	// Permissions needed to access the options panel.
	'menu_icon'            => '',
	// Specify a custom URL to an icon
	'last_tab'             => '',
	// Force your panel to always open to a specific tab (by id)
	'page_icon'            => 'icon-themes',
	// Icon displayed in the admin panel next to your menu_title
	'page_slug'            => '_options',
	// Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
	'save_defaults'        => true,
	// On load save the defaults to DB before user clicks save or not
	'default_show'         => false,
	// If true, shows the default value next to each field that is not the default value.
	'default_mark'         => '',
	// What to print by the field's title if the value shown is default. Suggested: *
	'show_import_export'   => true,
	// Shows the Import/Export panel when not used as a field.
	
	// CAREFUL -> These options are for advanced use only
	'transient_time'       => 60 * MINUTE_IN_SECONDS,
	'output'               => true,
	// Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
	'output_tag'           => true,
	// Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
	// 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
	
	// FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
	'database'             => '',
	// possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
	'system_info'          => false
	// REMOVE
);

// Panel Intro text -> before the form
if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
	if ( ! empty( $args['global_variable'] ) ) {
		$v = $args['global_variable'];
	} else {
		$v = str_replace( '-', '_', $args['opt_name'] );
	}
	$args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'mars' ), $v );
} else {
	$args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'mars' );
}

Redux::setArgs( $opt_name, $args );

// General
Redux::setSection( $opt_name, array(
	'title' => __( 'General', 'marstheme' ),
	'id'    => 'general',
	'icon'  => 'el el-home',
	'fields'	=>	array(
		array(
			'id'	=>	'logo',
			'type'	=>	'media',
			'url' => true,
			'subtitle' => __('Upload any media using the WordPress native uploader', 'mars'),
			'default' => array('url' => get_template_directory_uri() . '/img/logo.png'),					
			'title'	=>	__('Logo (194*31px)','mars')
		),
		array(
			'id' => 'custom_css',
			'type' => 'ace_editor',
			'title' => __('Custom CSS', 'mars'),
			'subtitle' => __('Paste your CSS code here, no style tag.', 'mars'),
			'mode' => 'css',
			'theme' => 'monokai'
		),
		array(
			'id' => 'custom_css_mobile',
			'type' => 'ace_editor',
			'title' => __('Mobile Custom CSS', 'mars'),
			'subtitle' => __('Paste your CSS code here, no style tag, this CSS will effect to the site on Mobile.', 'mars'),
			'mode' => 'css',
			'theme' => 'monokai'
		),		
		array(
			'id' => 'custom_js',
			'type' => 'ace_editor',
			'title' => __('Custom JS', 'mars'),
			'subtitle' => __('Paste your JS code here, no script tag, eg: alert(\'hello world\');', 'mars'),
			'mode' => 'javascript',
			'theme' => 'chrome'
		),
		array(
			'id' => 'custom_js_mobile',
			'type' => 'ace_editor',
			'title' => __('Mobile Custom JS', 'mars'),
			'subtitle' => __('Paste your JS code here, no script tag, this JS will effect to the site on Mobile eg: alert(\'hello world\');', 'mars'),
			'mode' => 'javascript',
			'theme' => 'chrome'
		)		
	)
));

// Footer
Redux::setSection( $opt_name, array(
	'title' => __( 'Styling', 'marstheme' ),
	'id'    => 'styling',
	'icon'  => 'el-icon-brush',
	'fields'	=>	array(
		array(
			'id'	=>	'style',
			'type'	=>	'select',
			'url' => true,
			'title'	=>	__('Style','mars'),
			'subtitle'	=>	__('Choose the Style.','mars'),
			'options'   => apply_filters( 'mars_get_styles' , null),
			'default'   => 'default'
		),
		array(
			'id' => 'style_custom',
			'type' => 'ace_editor',
			'title' => __('Custom CSS', 'copper'),
			'subtitle' => __('Write your CSS code here, no style tag, this will override to the default style.', 'mars'),
			'desc'	=>	__('This style will be lose if you reset the settings.','mars'),
			'mode' => 'css',
			'theme' => 'monokai',
			'indent'    => false,
			'required'  => array('style', "=", 'custom'),
		),
		array(
			'id' => 'color-header',
			'type' => 'color',
			'title' => __('Header Background Color', 'mars'),
			'subtitle' => __('Pick a background color for the header (default: #ffffff).', 'mars'),
			'default' => '#ffffff',
			'validate' => 'color',
		),
		array(
			'id' => 'body-background',
			'type' => 'background',
			'output' => array('body'),
			'title' => __('Body Background', 'mars'),
			'subtitle' => __('Body background with image, color, etc.', 'mars'),
			'default' => '#FFFFFF',
		),
		array(
			'id'        => 'typography-body',
			'type'      => 'typography',
			'title'     => __('Body Text', 'mars'),
			'google'    => true,
			'font-style'	=>	false,
			'subsets'	=>	false,
			'font-weight'	=> false,
			'font-size'	=>	false,
			'line-height'	=>	false,
			'text-align'	=>	false,
			'color'		=>	false
		),
		array(
			'id'        => 'typography-headings',
			'type'      => 'typography',
			'title'     => __('Headings', 'mars'),
			'google'    => true,
			'font-style'	=>	false,
			'subsets'	=>	false,
			'font-weight'	=> false,
			'font-size'	=>	false,
			'line-height'	=>	false,
			'text-align'	=>	false,
			'color'		=>	false
		),
		array(
			'id'        => 'typography-menu',
			'type'      => 'typography',
			'title'     => __('Menu', 'mars'),
			'google'    => true,
			'font-style'	=>	false,
			'subsets'	=>	false,
			'font-weight'	=> false,
			'font-size'	=>	false,
			'line-height'	=>	false,
			'text-align'	=>	false,
			'color'		=>	false
		),
		array(
			'id' => 'color-widget',
			'type' => 'color',
			'title' => __('Widget Title Background', 'mars'),
			'subtitle' => __('Pick a background color for the Widget title (default: #e73737), only for Right Widget.', 'mars'),
			'default' => '#e73737',
			'validate' => 'color',
		),
		array(
			'id' => 'color-text-widget',
			'type' => 'color',
			'title' => __('Widget Title Color', 'mars'),
			'subtitle' => __('Pick a color for the Widget title (default: #e73737), only for Right Widget', 'mars'),
			'default' => 'hsl(0, 100%, 100%)',
			'validate' => 'color',
		),
		array(
			'id' => 'color-header-navigation',
			'type' => 'color',
			'title' => __('Header Navigation Background', 'mars'),
			'subtitle' => __('Pick a background color for the Header Navigation (Header Menu) (default: #4c5358).', 'mars'),
			'default' => '#4c5358',
			'validate' => 'color',
		),
		array(
			'id' => 'color-text-header-navigation',
			'type' => 'color',
			'title' => __('Header Navigation Color', 'mars'),
			'subtitle' => __('Pick a color for the Header Navigation (Header Menu) (default: #4c5358).', 'mars'),
			'default' => 'hsl(0, 100%, 100%)',
			'validate' => 'color',
		),
		array(
			'id' => 'color-footer',
			'type' => 'color',
			'title' => __('Footer Background', 'mars'),
			'subtitle' => __('Pick a background color for the footer (default: #111111).', 'mars'),
			'default' => '#111111',
			'validate' => 'color',
		),
		array(
			'id' => 'color-footer-text',
			'type' => 'color',
			'title' => __('Footer Text Color', 'mars'),
			'subtitle' => __('Pick a color for Text in the footer (default: #ffffff).', 'mars'),
			'default' => '#ffffff',
			'validate' => 'color',
		)		
	)
));


// Socials
Redux::setSection( $opt_name, array(
	'title' => __( 'Socials', 'marstheme' ),
	'id'    => 'socials',
	'icon'  => 'el-icon-share',
	'fields'	=>	array(
		array(
			'id' => 'guestlike',
			'type' => 'switch',
			'title' => __('Allow Guest to Like', 'mars'),
			"default" => 0,
			'on' => __('Yes','mars'),
			'off' => __('No','mars'),
		),					
		array(
			'id'	=>	'facebook',
			'title'	=>	__('Facebook','mars'),
			'type'	=>	'text',
			'desc'	=>	__('Facebook Profile or Fanpage URL','mars')
		),
		array(
			'id'	=>	'twitter',
			'title'	=>	__('Twitter','mars'),
			'type'	=>	'text',
			'desc'	=>	__('Twitter URL','mars')
		),
		array(
			'id'	=>	'google-plus',
			'title'	=>	__('Google Plus','mars'),
			'type'	=>	'text',
			'desc'	=>	__('Google Plus URL','mars')
		),
		array(
			'id'	=>	'instagram',
			'title'	=>	__('Instagram','mars'),
			'type'	=>	'text',
			'desc'	=>	__('Instagram URL','mars')
		),
		array(
			'id'	=>	'linkedin',
			'title'	=>	__('Linkedin','mars'),
			'type'	=>	'text',
			'desc'	=>	__('Linkedin URL','mars')
		),
		array(
			'id'	=>	'tumblr',
			'title'	=>	__('Tumblr','mars'),
			'type'	=>	'text',
			'desc'	=>	__('Tumblr URL','mars')
		),
		array(
			'id'	=>	'youtube',
			'title'	=>	__('Youtube','mars'),
			'type'	=>	'text',
			'desc'	=>	__('Youtube URL','mars')
		),
		array(
			'id'	=>	'vimeo',
			'title'	=>	__('Vimeo','mars'),
			'type'	=>	'text',
			'desc'	=>	__('Vimeo URL','mars')
		),
		array(
			'id'	=>	'soundcloud',
			'title'	=>	__('Soundcloud','mars'),
			'type'	=>	'text',
			'desc'	=>	__('Soundcloud URL','mars')
		),
		array(
			'id'	=>	'pinterest',
			'title'	=>	__('Pinterest','mars'),
			'type'	=>	'text',
			'desc'	=>	__('Pinterest URL','mars')
		),
		array(
			'id'	=>	'snapchat',
			'title'	=>	__('Snapchat','mars'),
			'type'	=>	'text',
			'desc'	=>	__('Snapchat URL','mars')
		)		
	)
));

$user_db = NULL;
$users = get_users(array('role'=>null));
foreach ( $users as $user ){
	$user_db[ $user->ID ] = $user->user_login;
}

// Submit Form
Redux::setSection( $opt_name, array(
	'title' => __( 'Submit Form', 'marstheme' ),
	'id'    => 'submit-form',
	'icon'  => 'el-icon-cloud',
	'fields'	=>	array(
		array(
			'id' => 'submit_permission',
			'type' => 'switch',
			'title' => __('Allow Guest submit the video.', 'mars'),
			'subtitle' => __('By default, Only register can submit the video, you can limit the role in below selectbox', 'mars'),
			"default" => 0,
			'on' => __('Yes','mars'),
			'off' => __('No','mars'),
		),
		array(
			'id' => 'video-type',
			'type' => 'select',
			'multi' => true,
			'title' => __('Video Type', 'mars'),
			'subtitle' => __('Choose the Video Type, which is available in Submit Form at Frontend.', 'mars'),
			'options' => array('videolink' => __('Link','mars'), 'embedcode' => __('Embed Code','mars'), 'videofile' => __('File','mars')), //Must provide key => value pairs for select options
			'default' => 'videolink'
		),   
		array(
			'id'	=>	'videosize',
			'title'	=>	__('Video File Size','mars'),
			'type'	=>	'text',
			'desc'	=>	__('The maximum video file size allowed, 10MB is default size, -1 is no limit.','mars'),
			'default'	=>	10
		),
		array(
			'id'	=>	'imagesize',
			'title'	=>	__('Preview Image Size','mars'),
			'type'	=>	'text',
			'desc'	=>	__('The maximum Preview Image size allowed, 10MB is default size, -1 is no limit.','mars'),
			'default'	=>	2
		),					
		array(
			'id' => 'submit_redirect_to',
			'type' => 'select',
			'data' => 'pages',
			'title' => __('Redirect to', 'mars'),
			'desc' => __('Redirect the user to this page when successfully submitted the video.', 'mars'),
		),                    
		array(
			'id' => 'submit_assigned_user',
			'type' => 'select',
			'title' => __('Assignment User', 'mars'),
			'subtitle' => __('The video will be assigned for this user if you allow Guest Submit The Video.', 'mars'),
			'options' => $user_db,
			'default' => '1'
		),
		array(
			'id' => 'submit_roles',
			'type' => 'select',
			'multi' => true,
			'data' => 'roles',
			'title' => __('Who can submit the video?', 'mars'),
			'desc' => __('You can choose one or multi-roles to limit the permission.', 'mars'),
		),
		array(
			'id' => 'submit_status',
			'type' => 'button_set',
			'title' => __('Default Video Status', 'mars'),
			'subtitle' => __('The Public status will be shown on Frontend.', 'mars'),
			'options' => array('publish' => __('Publish','mars'), 'pending' => __('Pending','mars'), 'draft' => __('draft','mars')),
			'default' => 'pending'
		),
		array(
			'id' => 'submit_editor',
			'type' => 'switch',
			'title' => __('Use WP Visual Editor', 'mars'),
			"default" => 0,
			'on' => __('Yes','mars'),
			'off' => __('No','mars'),
		),
		array(
			'id' => 'videolayout',
			'type' => 'button_set',
			'title'	=>	__('Show the Layout dropdown','mars'),
			'options' => array('yes' => __('Yes','mars'), 'no' => __('No','mars')),
			'default' => 'yes'
		)		
	)
));


// Miscellaneous
Redux::setSection( $opt_name, array(
	'title' => __( 'Misc', 'marstheme' ),
	'id'    => 'miscellaneous',
	'icon'  => 'el-icon-wrench',
	'fields'	=>	array(
		array(
			'id' => 'rewrite_slug',
			'type'	=>	'text',
			'title'	=>	__('Video Slug','mars'),
			'default'	=>	'video',
			'subtitle'	=>	sprintf('This option will change the default slug of the video post type, if you change this key, you must go to %s and click on Save Changes button','<a href="'.admin_url('options-permalink.php').'">'.__('Settings/Permalink','mars').'</a>')
		),
		array(
			'id' => 'rewrite_slug_category',
			'type'	=>	'text',
			'title'	=>	__('Video Category Slug','mars'),
			'default'	=>	'categories',
			'subtitle'	=>	sprintf('This option will change the default slug of the video category taxonomy, if you change this key, you must go to %s and click on Save Changes button','<a href="'.admin_url('options-permalink.php').'">'.__('Settings/Permalink','mars').'</a>')
		),
		array(
			'id' => 'rewrite_slug_tag',
			'type'	=>	'text',
			'title'	=>	__('Video Tag Slug','mars'),
			'default'	=>	'video_tag',
			'subtitle'	=>	sprintf('This option will change the default slug of the video tag taxonomy, if you change this key, you must go to %s and click on Save Changes button','<a href="'.admin_url('options-permalink.php').'">'.__('Settings/Permalink','mars').'</a>')
		),
		array(
			'id' => 'loginpage',
			'type' => 'select',
			'data' => 'pages',
			'title' => __('Login/Register page', 'mars'),
			'desc'	=>	__('Using [videotube_login] shortcode in the page to display the Login/Register form.','mars')
		),		
		array(
			'id' => 'video_feed',
			'type' => 'checkbox',
			'title'	=>	__('Feeds','mars'),
			'description'	=>	__('Including the Video in Feed Page.','mars')
		),
		array(
			'id' => 'datetime_format',
			'type' => 'button_set',
			'title'	=>	__('Time format','mars'),
			'options' => array('default' => __('Default','mars'), 'videotube' => __('VT Format','mars')),
			'default' => 'videotube'
		),
		
		array(
			'id' => 'aspect_ratio',
			'type' => 'button_set',
			'title'	=>	__('Aspect Ratio','mars'),
			'options' => array('16by9' => __('16by9','mars'), '4by3' => __('4by3','mars')),
			'default' => '16by9'
		),		
		
		array(
			'id' => 'autoplay',
			'type' => 'switch',
			'title' => __('AutoPlay', 'mars'),
			'subtitle'	=>	__('Works for youtube and video self-hosted file.','mars'),
			"default" => 1,
			'on' => __('Yes','mars'),
			'off' => __('No','mars'),
		),
		array(
			'id' => 'enable_channelpage',
			'type' => 'switch',
			'title' => __('User Channel', 'mars'),
			'desc'	=>	__('Activate the channel page.','mars'),
			"default" => 0,
			'on' => __('Yes','mars'),
			'off' => __('No','mars'),
		)		
	)
));

// Footer
Redux::setSection( $opt_name, array(
	'title' => __( 'Footer', 'marstheme' ),
	'id'    => 'footer',
	'icon'  => 'el-icon-wrench',
	'fields'	=>	array(
		array(
			'id'	=>	'copyright_text',
			'title'	=>	__('Copyright Text','mars'),
			'type'	=>	'editor',
			'default'	=>	'<p>Copyright 2015 By MarsTheme All rights reserved. Powered by WordPress &amp; MarsTheme</p>'
		)	
	)
));
// Update
Redux::setSection( $opt_name, array(
	'title' => __( 'Update', 'marstheme' ),
	'id'    => 'update',
	'icon'  => 'el el-refresh',
	'fields'	=>	array(
		array(
			'id'	=>	'purchase_code',
			'title'	=>	__('Purchase Code','mars'),
			'type'	=>	'text'
		),
		array(
			'id'	=>	'access_token',
			'title'	=>	esc_html__('Personal Access Token','mars'),
			'desc'	=>	sprintf( esc_html__('Get one key %s','mars'), '<a target="_blank" href="https://build.envato.com/create-token/">'. esc_html__( 'here', 'mars' ) .'</a>' ),
			'type'	=>	'text'
		)		
	)
));