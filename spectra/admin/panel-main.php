<?php

/* Panel Options
------------------------------------------------------------------------*/

/* Options array */
$spectra_main_options = array( 


	/* General Settings
	-------------------------------------------------------- */
	array( 
		'type' => 'open',
		'tab_name' => _x( 'General Settings', 'Admin Panel', SPECTRA_THEME ),
		'tab_id' => 'general-settings',
		'icon' => 'gears'
	),

		array( 
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'General Settings', 'Admin Panel', SPECTRA_THEME ),
			'sub_tab_id' => 'sub-general-basics'
		),

			// Custom Date 
			array(
				'name' => _x( 'Date Format', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'custom_date',
				'type' => 'text',
				'std' => 'd/m/Y',
				'desc' => _x( 'Enter your custom date. More information: http://codex.wordpress.org/Formatting_Date_and_Time', 'Admin Panel', SPECTRA_THEME )
			),

			// Custom Comments Date
			array(
				'name' => _x( 'Comment Date Format', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'custom_comment_date',
				'type' => 'text',
				'std' => 'F j, Y (H:i)',
				'desc' => _x( 'Enter your custom comment date. More information: http://codex.wordpress.org/Formatting_Date_and_Time', 'Admin Panel', SPECTRA_THEME )
			),

			// Custom Event Date
			array(
				'name' => _x( 'Event Date Format', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'event_date',
				'type' => 'text',
				'std' => 'd/m',
				'desc' => _x( 'Enter your custom event date. More information: http://codex.wordpress.org/Formatting_Date_and_Time', 'Admin Panel', SPECTRA_THEME )
			),

			// Custom Time
			array(
				'name' => _x( 'Event Time Format', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'event_time',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Enter your custom event time e.g: H:i. If time field isn\'t empty the then the time is displayed after event date. More information: http://codex.wordpress.org/Formatting_Date_and_Time', 'Admin Panel', SPECTRA_THEME )
			),

			// Retina Displays
			array( 
				'name' => _x( 'Retina Displays', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'retina',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'To make this work you need to specify the width and the height of the image directly and provide the same image twice the size withe the @2x selector added at the end of the image name. For instance if you want your "logo.png" file to be retina compatible just include it in the markup with specified width and height ( the width and height of the original image in pixels ) and create a "logo@2x.png" file in the same directory that is twice the resolution.', 'Admin Panel', SPECTRA_THEME ),
			),

			// Smoothscroll
			array( 
				'name' => _x( 'Smoothscroll', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'smoothscroll',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x( 'Smoothscroll plugin.', 'Admin Panel', SPECTRA_THEME ),
			),

			// Content Animations
			array( 
				'name' => _x( 'Content Animations', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'content_animations',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x( 'Enable CSS3 animation.', 'Admin Panel', SPECTRA_THEME ),
			),

			// Content Animations Mobile
			array( 
				'name' => _x( 'Content Animations (Touch Devices)', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'mobile_animations',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x( 'Enable CSS3 animation on touch devices.', 'Admin Panel', SPECTRA_THEME ),
			),

			// Google MAPS API Key
			array(
				'name' => _x( 'Google Maps API Key', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'google_maps_key',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Insert your Google Maps API key.', 'Admin Panel', SPECTRA_THEME ),
			),

			// Google Map Marker
			array(
				'name' => _x( 'Google Maps Marker', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'map_marker',
				'type' => 'add_image',
				'plugins' => array( 'add_image' ),
				'by_id' => true,
				'width' => '48',
				'height' => '56',
				'crop' => 'c',
				'std' => '',
				'button_title' => _x( 'Add Image', 'Admin Panel', SPECTRA_THEME ),
				'msg' => _x( 'Currently you don\'t have image, you can add one by clicking on the button below.', 'Admin Panel', SPECTRA_THEME ),
				'desc' => _x( 'Add Google Map Marker (48px x 56px).', 'Admin Panel', SPECTRA_THEME )
			),

			// Favicon
			array(
				'name' => _x( 'Custom Favicon', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'favicon',
				'type' => 'add_image',
				'plugins' => array( 'add_image' ),
				'by_id' => true,
				'width' => '16',
				'height' => '16',
				'crop' => 'c',
				'std' => '',
				'button_title' => _x( 'Add Image', 'Admin Panel', SPECTRA_THEME ),
				'desc' => _x( 'Upload a 16px x 16px .ico image for your theme, or specify the image address. http://favicon-generator.org', 'Admin Panel', SPECTRA_THEME )
			),

			// Slide Panel
			array( 
				'name' => _x( 'Slide Sidebar', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'slide_sidebar',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x( 'Enable slide sidebar.', 'Admin Panel', SPECTRA_THEME ),
			),

			// Default Layout
			array( 
				'name' => _x( 'Default Page Layout', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'default_layout',
				'type' => 'select',
				'std' => 'wide',
				'desc' => _x( 'Select default page/post layout.', 'Admin Panel', SPECTRA_THEME ),
				'options' => array( 
					array( 'name' => 'Wide', 'value' => 'wide'),
					array( 'name' => 'Left Sidebar', 'value' => 'main-right'),
					array( 'name' => 'Right Sidebar', 'value' => 'main-left')
				)
			),

			// Google Stuff
			array(
				'name' => _x( 'Google Analytics Code', 'Admin Panel', SPECTRA_THEME),
				'id' => 'google_analytics',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Insert your Google Analytics code here (UA-XXXXX-X).', 'Admin Panel', SPECTRA_THEME)
			),
			
		array( 
			'type' => 'sub_close'
		),
	

		/* Header / Navigation
		 -------------------------------------------------------- */
		array( 
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Header', 'Admin Panel', SPECTRA_THEME ),
			'sub_tab_id' => 'sub-header'
		),	
			// Show header on intro section?
			array( 
				'name' => _x( 'Show Header on Intro Section', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'show_navigation',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Show header on intro section.', 'Admin Panel', SPECTRA_THEME ),
			),

			// Logo
			array(
				'name' => _x( 'Logo Image', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'logo',
				'type' => 'add_image',
				'plugins' => array( 'add_image' ),
				'by_id' => true,
				'width' => '100',
				'height' => '100',
				'crop' => 'c',
				'std' => '',
				'button_title' => _x( 'Add Image', 'Admin Panel', SPECTRA_THEME ),
				'msg' => _x( 'Currently you don\'t have image, you can add one by clicking on the button below.', 'Admin Panel', SPECTRA_THEME ),
				'desc' => _x( 'Add a logo image to the theme header.', 'Admin Panel', SPECTRA_THEME )
			),
			
		array( 
			'type' => 'sub_close'
		),


		/* Footer
		 -------------------------------------------------------- */
		array( 
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Footer', 'Admin Panel', SPECTRA_THEME ),
			'sub_tab_id' => 'sub-footer'
		),

			// Footer Content
			array( 
				'name' => _x( 'Footer Content', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'footer_content',
				'type' => 'textarea',
				'tinymce' => 'true',
				'std' => '<p>&copy; 2013 by YOUR NAME. All Rights Reserved. Powered by <a href="#">Themeforest</a>.</p>',
				'height' => '200',
				'desc' => _x( 'Add footer content.', 'Admin Panel', SPECTRA_THEME )
			),

			// Show Social icons?
			array( 
				'name' => _x( 'Show Social Icons', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_icons',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Show or hide social icons.', 'Admin Panel', SPECTRA_THEME ),
				'group' => 'show_socials'
			),

			// Social Columns
			array( 
				'name' => _x( 'Select Social Icons Layout', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_layout',
				'type' => 'select',
				'std' => '4',
				'desc' => _x( 'Select social column layout', 'Admin Panel', SPECTRA_THEME ),
				'options' => array( 
					array( 'name' => '1 Column', 'value' => '1'),
					array( 'name' => '2 Columns', 'value' => '2'),
					array( 'name' => '3 Columns', 'value' => '3'),
					array( 'name' => '4 Columns', 'value' => '4')
				),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),

			// Socials icons
			array(
				'name' => _x( 'RSS', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_rss',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Enter "rss". Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'Twitter', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_twitter',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Twitter URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'Facebook', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_facebook',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Facebook URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'Google+', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_gplus',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Google+ URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'Soundcloud', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_soundcloud',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Soundcloud URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'Vimeo', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_vimeo',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Vimeo URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'Youtube', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_youtube',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Youtube URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'Dribbble', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_dribbble',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'YouTube URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'Flickr', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_flickr',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Flickr URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'Delicious', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_delicious',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Delicious URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'Pinterest', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_pinterest',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Pinterest URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'Instagram', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_instagram',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Instagram URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'VK', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_vk',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'VK URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),
			array(
				'name' => _x( 'WhatsApp', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'social_whats_app',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'WhatsApp URL (http://...). Note: Blank field hides the icon.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'show_socials',
				'group_name' => array('social_icons')
			),

		array( 
			'type' => 'sub_close'
		),

	
	array( 
		'type' => 'close'
	),


	/* Fonts
	-------------------------------------------------------- */
	array( 
		'type' => 'open',
		'tab_name' => _x( 'Fonts', 'Admin Panel', SPECTRA_THEME ),
		'tab_id' => 'fonts',
		'icon' => 'font'
	),

		/* Google fonts
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Google Web Fonts', 'Admin Panel', SPECTRA_THEME ),
			'sub_tab_id' => 'sub-google-fonts',
		),
			array(
				'name' => _x( 'Google Fonts', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'use_google_fonts',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'group' => 'google_fonts',
				'desc' => _x( 'When this option is enabled, the text elements will be automatically replaced with the Google Web Fonts.', 'Admin Panel', SPECTRA_THEME ),
			),
			array(
				'name' => _x( 'Google Fonts', 'Admin Panel', SPECTRA_THEME ),
				'sortable' => false,
				'array_name' => 'google_fonts',
				'id' => array(
							  array( 'type' => 'textarea', 'name' => 'font_link', 'id' => 'font_link', 'label' => 'Font Link:' )
							  ),
				'type' => 'sortable_list',
				'main_group' => 'google_fonts',
				'group_name' => array( 'use_google_fonts' ),
				'button_text' => _x( 'Add Font', 'Admin Panel', SPECTRA_THEME ),
				'desc' => _x( '1. Go to ', 'Admin Panel', SPECTRA_THEME ) . '<a href="http://www.google.com/webfonts" target="_blank">Google Fonts</a><br/>'._x( '2. Select your font and click on "Quick-use"', 'Admin Panel', SPECTRA_THEME ).'<br/>'._x( '3. Choose the styles you want (bold, italic...)', 'Admin Panel', SPECTRA_THEME ).'<br/>'._x( '4. Choose the character sets you want', 'Admin Panel', SPECTRA_THEME ).'<br/>'._x( '5. Copy code from "blue box" and paste. For example:', 'Admin Panel', SPECTRA_THEME ).'<br/><code> &lt;link href=\'http://fonts.googleapis.com/css?family=Roboto:400,400italic,700,700italic,900,900italic,300,300italic&subset=latin,latin-ext\' rel=\'stylesheet\' type=\'text/css\'&gt;</code>',
			),
			array(
				'name' => _x( 'Integrate The Fonts Into Your CSS', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'google_code',
				'type' => 'textarea',
				'height' => '100',
				'std' => '',
				'main_group' => 'google_fonts',
				'group_name' => array( 'use_google_fonts' ),
				'desc' => _x( '
							The Google Web Fonts API will generate the necessary browser-specific CSS to use the fonts. All you need to do is add the font name to your CSS styles. For example:', 'Admin Panel', SPECTRA_THEME ). '<br/> <code>
							h1,h2,h3,h4,h5,h6,body { font-family : "Roboto", sans-serif; }
							</code>
							',
			),
		array(
			'type' => 'sub_close'
		),
		

	array( 
		'type' => 'close'
	),


	/* Sections
	-------------------------------------------------------- */
	array( 
		'type' => 'open',
		'tab_name' => _x( 'Sections', 'Admin Panel', SPECTRA_THEME ),
		'tab_id' => 'sections',
		'icon' => 'th-large'
	),

		/* DISQUS
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'DISQUS Comments', 'Admin Panel', SPECTRA_THEME ),
			'sub_tab_id' => 'sub-plugins-disqus'
		),

			// Enable Disqus comments
			array(
				'name' => _x( 'DISQUS Comments', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'disqus_comments',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Enable DISQUS comments. Replace default Wordpress comments.', 'Admin Panel', SPECTRA_THEME ),
				'group' => 'disqus'
			),

			// Disqus ID
			array(
				'name' => _x( 'DISQUS Website\'s Shortname', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'disqus_shortname',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Enter DISQUS Website\'s Shortname.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'disqus',
				'group_name' => array( 'disqus_comments' )
			),
			
		array(
			'type' => 'sub_close'
		),
		

		/* Tracks
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Music', 'Admin Panel', SPECTRA_THEME ),
			'sub_tab_id' => 'sub-plugins-music',
		),

			// Enable Scamp Player
			array(
				'name' => _x( 'Music Player', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'scamp_player',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x( 'Enable music player. NOTE: Spectra Plugin must be instaled and activated.', 'Admin Panel', SPECTRA_THEME ),
				'group' => 'player',
			),

			// Autoplay
			array(
				'name' => _x( 'Autoplay', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'player_autoplay',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Autoplay tracklist. NOTE: Autoplay does not work on mobile devices.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'player',
				'group_name' => array( 'scamp_player' )
			),
			// Autoplay
			array(
				'name' => _x( 'Load First Track', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'load_first_track',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Load first track from tracklist after load list.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'player',
				'group_name' => array( 'scamp_player' )
			),

			// Startup Tracklist
			array( 
				'name' => _x( 'Startup Tracklist', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'startup_tracklist',
				'type' => 'posts',
				'post_type' => 'spectra_tracks',
				'std' => 'none',
				'options' => array(
				   	array( 'name' => '', 'value' => 'none' )
				),
				'desc' => _x( 'Select startup tracklist.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'player',
				'group_name' => array( 'scamp_player' )
			),

			// Show Player
			array(
				'name' => _x( 'Show Player on Startup', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'show_player',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Show player on startup.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'player',
				'group_name' => array( 'scamp_player' )
			),

			// Show Tracklist
			array(
				'name' => _x( 'Show Tracklist on Startup', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'show_tracklist',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Show playlist on startup.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'player',
				'group_name' => array( 'scamp_player' )
			),

			// Random Tracks
			array(
				'name' => _x( 'Random Play', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'player_random',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Random play tracks.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'player',
				'group_name' => array( 'scamp_player' )
			),

			// Loop Tracks
			array(
				'name' => _x( 'Loop Tracklist', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'player_loop',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Loop tracklist.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'player',
				'group_name' => array( 'scamp_player' )
			),

			// Titlebar
			array(
				'name' => _x( 'Change Titlebar', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'player_titlebar',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'Replace browser titlebar on track title.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'player',
				'group_name' => array( 'scamp_player' )
			),

			// Player Skin
			array( 
				'name' => _x( 'Player Skin', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'player_skin',
				'type' => 'select',
				'std' => 'dark',
				'desc' => _x( 'Select player skin.', 'Admin Panel', SPECTRA_THEME ),
				'options' => array( 
					array( 'name' => 'Light', 'value' => 'light'),
					array( 'name' => 'Dark', 'value' => 'dark')
				),
				'main_group' => 'player',
				'group_name' => array( 'scamp_player' )
			),

			// Soundcloud Client ID
			array(
				'name' => _x( 'Soundcloud Client ID', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'soundcloud_id',
				'type' => 'text',
				'std' => '',
				'desc' => _x( 'Add your Soundcloud ID', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'player',
				'group_name' => array( 'scamp_player' )
			),

			// Startup Volume
			array( 
				'name' => _x( 'Startup Volume', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'player_volume',
				'type' => 'range',
				'plugins' => array( 'range' ),
				'min' => 0,
				'max' => 100,
				'unit' => '',
				'std' => '70',
				'desc' => _x( 'Set startup volume.', 'Admin Panel', SPECTRA_THEME ),
				'main_group' => 'player',
				'group_name' => array( 'scamp_player' )
			),
			
		array(
			'type' => 'sub_close'
		),


		/* Permalinks
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Permalinks', 'Admin Panel', SPECTRA_THEME ),
			'sub_tab_id' => 'sub-section-permalinks',
		),	
			
			// Portfolio
			array(
				'name' => _x( 'Portfolio Slug', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'portfolio_slug',
				'type' => 'text',
				'std' => 'portfolio',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SPECTRA_THEME )
			),
			array(
				'name' => _x( 'Portfolio Category Slug', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'portfolio_cat_slug',
				'type' => 'text',
				'std' => 'portfolio-categories',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SPECTRA_THEME )
			),

			// Events
			array(
				'name' => _x( 'Events Slug', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'events_slug',
				'type' => 'text',
				'std' => 'events',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SPECTRA_THEME )
			),
			array(
				'name' => _x( 'Events Category Slug', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'events_cat_slug',
				'type' => 'text',
				'std' => 'event-categories',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SPECTRA_THEME )
			),

			// Gallery
			array(
				'name' => _x( 'Gallery Slug', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'gallery_slug',
				'type' => 'text',
				'std' => 'photos',
				'desc' => _x( 'Enter post slug name. No special characters. No spaces. IMPORTANT: When you change post slug name, you have to go to: WordPress Settings > Permalinks and save settings.', 'Admin Panel', SPECTRA_THEME )
			),
			
			
		array(
			'type' => 'sub_close'
		),
		

	array( 
		'type' => 'close'
	),


	/* Sidebars
	 ------------------------------------------------------------------------------------------ */
	array(
		'type' => 'open',
		'tab_name' => _x( 'Sidebars', 'Admin Panel', SPECTRA_THEME ),
		'tab_id' => 'sidebars',
		'icon' => 'bars'
	),
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Sidebars', 'Admin Panel', SPECTRA_THEME ),
			'sub_tab_id' => 'sub-sidebars'
		),
			array(
				'name' => _x( 'Sidebars', 'Admin Panel', SPECTRA_THEME ),
				'sortable' => false,
				'array_name' => 'custom_sidebars',
				'id' => array(
							  array( 'name' => 'name', 'id' => 'sidebar', 'label' => 'Name:' )
							  ),
				'type' => 'sortable_list',
				'button_text' => _x( 'Add Sidebar', 'Admin Panel', SPECTRA_THEME ),
				'desc' => _x( 'Add your custom sidebars.', 'Admin Panel', SPECTRA_THEME )
			),
		array(
			'type' => 'sub_close'
		),
	array(
		'type' => 'close'
	),

	
	/* Quick Edit
	 ------------------------------------------------------------------------------------------ */
	array(
		'type'     => 'open',
		'tab_name' => _x( 'Quick Edit', 'Admin Panel', SPECTRA_THEME ),
		'tab_id'   => 'editing',
		'icon' => 'code'
	),
	
		/* Custom CSS */
		array(
			'type'         => 'sub_open',
			'sub_tab_name' => _x( 'CSS', 'Admin Panel', SPECTRA_THEME ),
			'sub_tab_id'   => 'sub-custom-css'
		),
			array(
				'type'   => 'code_editor',
				'plugins' => array( 'code_editor' ),
				'lang' => 'css',
				'std'    => '',
				'height' => '200',
				'desc'   => _x( 'Add your custom CSS rules here. Every main CSS rule can be adjusted. Whenever you want to change theme style always use this field. When you do that you\'ll have assurance that whenever you upgrade the theme, your code will stay untouched. Avoid making changes to "style.css" file directly. Whenever you change something, you can always export your data using Advanced > Import/Export.', 'Admin Panel', SPECTRA_THEME ),
				'id'     => 'custom_css'
			),
		array(
			'type' => 'sub_close'
		),
	
		/* Custom Javascript */
		array(
			'type'         => 'sub_open',
			'sub_tab_name' => _x( 'Javascript', 'Admin Panel', SPECTRA_THEME ),
			'sub_tab_id'   => 'sub-custom-js'
		),
			array(
				'type'   => 'code_editor',
				'plugins' => array( 'code_editor' ),
				'lang' => 'js',
				'std'    => '',
				'height' => '200',
				'desc'   => _x( 'Add your custom Javascript code.  Below you have simple example of jQuery script:', 'Admin Panel', SPECTRA_THEME ) . '<br/><code>jQuery.noConflict(); <br/>jQuery(document).ready(function () { <br/>alert(\'Hello World!\' );<br/>});</code>',
				'id'     => 'custom_js'
			),
		array(
			'type' => 'sub_close'
		),
	
	array(
		'type' => 'close'
	),

	/* Advanced
	-------------------------------------------------------- */
	array( 
		'type' => 'open',
		'tab_name' => _x( 'Advanced', 'Admin Panel', SPECTRA_THEME ),
		'tab_id' => 'advanced',
		'icon' => 'wrench'
	),

		/* Ajax
		 -------------------------------------------------------- */
		array(
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Ajax', 'Admin Panel', SPECTRA_THEME ),
			'sub_tab_id' => 'sub-ajax'
		),


			// Ajax
			array( 
				'name' => _x( 'Ajax Load', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'ajaxed',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x( 'Enable if you want ajax loading.', 'Admin Panel', SPECTRA_THEME ),
			),

			// Ajax classes
			array( 
				'name' => _x( 'AJAX Filter', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'ajax_elements',
				'type' => 'textarea',
				'tinymce' => 'false',
				'std' => '.sp-play-list,.sp-add-list,.sp-play-track,.sp-add-track,.smooth-scroll,.ui-tabs-nav li a, .wpb_tour_next_prev_nav span a,.wpb_accordion_header a,.vc_tta-tab,.vc_tta-tab a',
				'height' => '60',
				'desc' => _x( 'Add selectors separated by commas. These elements will not be processed by AJAX. NOTE: Don\'t remove default elements.', 'Admin Panel', SPECTRA_THEME )
			),

			// Ajax events
			array( 
				'name' => _x( 'AJAX Events', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'ajax_events',
				'type' => 'textarea',
				'tinymce' => 'false',
				'std' => 'YTAPIReady,getVideoInfo_bgndVideo',
				'height' => '60',
				'desc' => _x( 'Add events separated by commas. These events will be removed after page page by AJAX. NOTE: Don\'t remove default events.', 'Admin Panel', SPECTRA_THEME )
			),

			// Ajax reload scripts
			array( 
				'name' => _x( 'AJAX Reload Scripts', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'ajax_reload_scripts',
				'type' => 'textarea',
				'tinymce' => 'false',
				'std' => '/js/custom.js,shortcodes/assets/js/shortcodes.js,contact-form-7/includes/js/scripts.js,js_composer_front.min.js,/dist/skrollr.min.js',
				'height' => '60',
				'desc' => _x( 'Add strings for reloaded scripts separated by commas. These scripts will be reloaded after page page by AJAX. NOTE: Don\'t remove default scripts.', 'Admin Panel', SPECTRA_THEME )
			),

			// Ajax Async
			array(
				'name' => _x( 'Asynchronous', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'ajax_async',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'on',
				'desc' => _x( 'Asynchronous AJAX.', 'Admin Panel', SPECTRA_THEME )
			),

			// Ajax Cache
			array(
				'name' => _x( 'Ajax Cache', 'Admin Panel', SPECTRA_THEME ),
				'id' => 'ajax_cache',
				'type' => 'switch_button',
				'plugins' => array( 'switch_button' ),
				'std' => 'off',
				'desc' => _x( 'AJAX Cache.', 'Admin Panel', SPECTRA_THEME )
			),
			
		array(
			'type' => 'sub_close'
		),


		/* Import and export
		 -------------------------------------------------------- */
		array( 
			'type' => 'sub_open',
			'sub_tab_name' => _x( 'Import/Export', 'Admin Panel', SPECTRA_THEME ),
			'sub_tab_id' => 'sub-import'
		),
			array( 
				'type' => 'export'
			),
			array( 
				'type' => 'import'
			),
		array( 
			'type' => 'sub_close'
		),

	array( 
		'type' => 'close'
	),


	/* Hidden fields
	 -------------------------------------------------------- */
	array( 
		'type' => 'hidden_field',
		'id' => 'theme_name',
		'value' => SPECTRA_THEME
	),
	
);


/* Dummy data
 ------------------------------------------------------------------------*/
$dummy_data = 'YTozODp7czo2OiJhamF4ZWQiO3M6Mjoib24iO3M6MTE6ImN1c3RvbV9kYXRlIjtzOjQ6IkYsIGoiO3M6MTk6ImN1c3RvbV9jb21tZW50X2RhdGUiO3M6MTI6IkYgaiwgWSAoSDppKSI7czoxMDoiZXZlbnRfZGF0ZSI7czozOiJkL20iO3M6NjoicmV0aW5hIjtzOjM6Im9mZiI7czoxMjoic21vb3Roc2Nyb2xsIjtzOjI6Im9uIjtzOjE4OiJjb250ZW50X2FuaW1hdGlvbnMiO3M6Mzoib2ZmIjtzOjE3OiJtb2JpbGVfYW5pbWF0aW9ucyI7czozOiJvZmYiO3M6MTM6InNsaWRlX3NpZGViYXIiO3M6Mjoib24iO3M6MTQ6ImRlZmF1bHRfbGF5b3V0IjtzOjQ6IndpZGUiO3M6MTU6InNob3dfbmF2aWdhdGlvbiI7czozOiJvZmYiO3M6MTQ6ImZvb3Rlcl9jb250ZW50IjtzOjE2OToiPHAgc3R5bGU9InRleHQtYWxpZ246IGNlbnRlcjsiIGRhdGEtbWNlLXN0eWxlPSJ0ZXh0LWFsaWduOiBjZW50ZXI7Ij4yMDEzIGJ5IFlPVVIgTkFNRS4gQWxsIFJpZ2h0cyBSZXNlcnZlZC4gUG93ZXJlZCBieSA8YSBocmVmPSIjIiBkYXRhLW1jZS1ocmVmPSIjIj5UaGVtZWZvcmVzdDwvYT4uPC9wPiI7czoxMjoic29jaWFsX2ljb25zIjtzOjI6Im9uIjtzOjEzOiJzb2NpYWxfbGF5b3V0IjtzOjE6IjMiO3M6MTQ6InNvY2lhbF90d2l0dGVyIjtzOjE6IiMiO3M6MTU6InNvY2lhbF9mYWNlYm9vayI7czoxOiIjIjtzOjEyOiJzb2NpYWxfZ3BsdXMiO3M6MToiIyI7czoxNjoidXNlX2dvb2dsZV9mb250cyI7czoyOiJvbiI7czoxMjoiZ29vZ2xlX2ZvbnRzIjthOjE6e2k6MDthOjE6e3M6OToiZm9udF9saW5rIjtzOjE0ODoiPGxpbmsgaHJlZj0naHR0cDovL2ZvbnRzLmdvb2dsZWFwaXMuY29tL2Nzcz9mYW1pbHk9Um9ib3RvOjQwMCw0MDBpdGFsaWMsNzAwLDcwMGl0YWxpYyw5MDAsOTAwaXRhbGljLDMwMCwzMDBpdGFsaWMnIHJlbD0nc3R5bGVzaGVldCcgdHlwZT0ndGV4dC9jc3MnPiI7fX1zOjE1OiJkaXNxdXNfY29tbWVudHMiO3M6Mzoib2ZmIjtzOjEyOiJzY2FtcF9wbGF5ZXIiO3M6Mjoib24iO3M6MTU6InBsYXllcl9hdXRvcGxheSI7czozOiJvZmYiO3M6MTY6ImxvYWRfZmlyc3RfdHJhY2siO3M6Mjoib24iO3M6MTc6InN0YXJ0dXBfdHJhY2tsaXN0IjtzOjQ6Im5vbmUiO3M6MTE6InNob3dfcGxheWVyIjtzOjI6Im9uIjtzOjE0OiJzaG93X3RyYWNrbGlzdCI7czozOiJvZmYiO3M6MTM6InBsYXllcl9yYW5kb20iO3M6Mzoib2ZmIjtzOjExOiJwbGF5ZXJfbG9vcCI7czozOiJvZmYiO3M6MTU6InBsYXllcl90aXRsZWJhciI7czozOiJvZmYiO3M6MTE6InBsYXllcl9za2luIjtzOjQ6ImRhcmsiO3M6MTM6InBsYXllcl92b2x1bWUiO3M6MjoiNzAiO3M6MTU6ImN1c3RvbV9zaWRlYmFycyI7YToxOntpOjA7YToxOntzOjQ6Im5hbWUiO3M6MTQ6IkN1c3RvbSBTaWRlYmFyIjt9fXM6MTM6ImFqYXhfZWxlbWVudHMiO3M6MTcwOiIuc3AtcGxheS1saXN0LC5zcC1hZGQtbGlzdCwuc3AtcGxheS10cmFjaywuc3AtYWRkLXRyYWNrLC5zbW9vdGgtc2Nyb2xsLC51aS10YWJzLW5hdiBsaSBhLCAud3BiX3RvdXJfbmV4dF9wcmV2X25hdiBzcGFuIGEsLndwYl9hY2NvcmRpb25faGVhZGVyIGEsLnZjX3R0YS10YWIsLnZjX3R0YS10YWIgYSI7czoxMToiYWpheF9ldmVudHMiO3M6MzM6IllUQVBJUmVhZHksZ2V0VmlkZW9JbmZvX2JnbmRWaWRlbyI7czoxOToiYWpheF9yZWxvYWRfc2NyaXB0cyI7czoxMTE6Ii9qcy9jdXN0b20uanMsc2hvcnRjb2Rlcy9hc3NldHMvanMvc2hvcnRjb2Rlcy5qcyxjb250YWN0LWZvcm0tNy9pbmNsdWRlcy9qcy9zY3JpcHRzLmpzLGpzX2NvbXBvc2VyX2Zyb250Lm1pbi5qcyI7czoxMDoiYWpheF9hc3luYyI7czoyOiJvbiI7czoxMDoiYWpheF9jYWNoZSI7czozOiJvZmYiO3M6MTA6InRoZW1lX25hbWUiO3M6Nzoic3BlY3RyYSI7fQ==';


/* init Panel
 ------------------------------------------------------------------------*/

global $spectra_opts;

/* Class arguments */
$args = array(
	'admin_path'  => '',
	'admin_uri'	 => '',
	'panel_logo' => '',
	'menu_name' => _x( 'Options', 'Admin Panel', SPECTRA_THEME ), 
	'page_name' => 'panel-main',
	'option_name' => 'spectra_panel_opts',
	'admin_dir' => '/admin',
	'menu_icon' => '',
	'dummy_data' => $dummy_data,
	'textdomain' => SPECTRA_THEME
	);

/* Add class instance */
$spectra_opts = new MuttleyPanel( $args, $spectra_main_options );

/* Remove variables */
unset( $args );
?>