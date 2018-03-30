<?php

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "qns_data";

    $theme = wp_get_theme(); // For use with some settings. Not necessary.
	
    $args = array(   
        'opt_name'             => $opt_name,
        'display_name'         => $theme->get( 'Name' ),
        'display_version'      => $theme->get( 'Version' ),
        'menu_type'            => 'menu',
        'allow_sub_menu'       => false,
        'menu_title'           => __( 'Theme Options', 'qns' ),
        'page_title'           => __( 'Theme Options', 'qns' ),
        'google_api_key'       => '',
        'google_update_weekly' => false,
        'async_typography'     => true,
        'admin_bar'            => true,
        'admin_bar_icon'       => 'dashicons-portfolio',
        'admin_bar_priority'   => 50,
        'global_variable'      => '',
        'dev_mode'             => false,
        'update_notice'        => true,
        'customizer'           => true,
        'page_priority'        => null,
        'page_parent'          => 'themes.php',
        'page_permissions'     => 'manage_options',
        'menu_icon'            => '',
        'last_tab'             => '',
        'page_icon'            => 'icon-themes',
        'page_slug'            => '',
        'save_defaults'        => true,
        'default_show'         => false,
        'default_mark'         => '',
        'show_import_export'   => true,
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        'output_tag'           => true,
        'database'             => '',
        'use_cdn'              => true,
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    Redux::setArgs( $opt_name, $args );

    Redux::setSection( $opt_name, array(
        'title'            => __( 'General Settings', 'qns' ),
        'id'               => 'general-settings',
        'desc'             => '',
        'customizer_width' => '400px',
        'icon'             => 'el el-cog',
		
		'fields'           => array(
			array(
                'id'       => 'sidebar_position',
                'type'     => 'radio',
                'title'    => __( 'Main Layout', 'qns' ),
                'subtitle' => __( '', 'qns' ),
                'desc'     => __( 'Select main content and sidebar alignment', 'qns' ),
                'options'  => array(
                    'right' => 'Right Sidebar',
                    'left' => 'Left Sidebar',
                    'none' => 'Full Width'
                ),
                'default'  => 'right'
            ),
			array(
                'id'       => 'text_logo',
                'type'     => 'checkbox',
                'title'    => __( 'Text Logo', 'qns' ),
                'subtitle' => __( '', 'qns' ),
                'desc'     => __( 'Tick this box if you don\'t have an image based logo', 'qns' ),
                'default'  => '0'// 1 = on | 0 = off
            ),
			array(
                'id'       => 'image_logo',
                'type'     => 'media',
                'title'    => __( 'Image Logo', 'qns' ),
                'desc'     => __( 'Upload your logo here', 'qns' ),
                'subtitle' => __( '', 'qns' )
            ),
			array(
                'id'       => 'image_logo_width',
                'type'     => 'text',
                'title'    => __( 'Image Logo Width', 'qns' ),
                'subtitle' => __( '', 'qns' ),
                'desc'     => __( 'Add a numerical value in pixels, do not add "px"', 'qns' ),
                'default'  => '',
            ),
			array(
                'id'       => 'favicon_url',
                'type'     => 'text',
                'title'    => __( 'Favicon URL', 'qns' ),
                'subtitle' => __( '', 'qns' ),
                'desc'     => __( 'Add a URL for a favicon here, e.g. http://website.com/favicon.ico', 'qns' ),
                'default'  => '',
            ),
			array(
                'id'       => 'main_menu_search',
                'type'     => 'checkbox',
                'title'    => __( 'Display Search in Main Menu', 'qns' ),
                'subtitle' => __( '', 'qns' ),
                'desc'     => __( 'Tick this box to display a search field in the main menu', 'qns' ),
                'default'  => '1'// 1 = on | 0 = off
            ),
			array(
                'id'       => 'menu_search_type',
                'type'     => 'radio',
                'title'    => __( 'Main Menu Search Type', 'qns' ),
                'subtitle' => __( '', 'qns' ),
                'desc'     => __( '', 'qns' ),
                'options'  => array(
                    'product-search' => 'Product Search',
					'standard-search' => 'Standard Search'
                ),
                'default'  => 'product-search'
            ),
			array(
                'id'       => 'bottom_image',
                'type'     => 'media',
                'title'    => __( 'Footer Bottom Right Image', 'qns' ),
                'desc'     => __( 'Upload your image here', 'qns' ),
                'subtitle' => __( '', 'qns' )
            ),
			array(
                'id'       => 'footer_msg',
                'type'     => 'textarea',
                'title'    => __( 'Footer Message', 'qns' ),
                'subtitle' => __( '', 'qns' ),
                'desc'     => __( 'Copyright message to be displayed in footer', 'qns' ),
                'default'  => '&copy; Copyright 2016',
            ),
			array(
                'id'       => 'google-analytics',
                'type'     => 'textarea',
                'title'    => __( 'Google Analytics Code', 'qns' ),
                'subtitle' => __( '', 'qns' ),
                'desc'     => __( '', 'qns' ),
                'default'  => '',
            ),
			array(
                'id'       => 'items_per_page',
                'type'     => 'text',
                'title'    => __( 'Number of Items Per Page', 'qns' ),
                'subtitle' => __( '', 'qns' ),
                'desc'     => __( 'For testimonials', 'qns' ),
                'default'  => '10',
            ),

        )

    ) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Styling Options', 'qns' ),
    'id'               => 'styling-options',
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-font',
	
	'fields'           => array(
		array(
            'id'       => 'body_background',
            'type'     => 'color',
            'title'    => __( 'Body Background Colour', 'qns' ),
            'subtitle' => __( 'Pick a colour', 'qns' ),
            'default'  => '',
			'validate' => 'color',
        ),
		array(
            'id'       => 'body_background_image',
            'type'     => 'media',
            'title'    => __( 'Background Image', 'qns' ),
            'desc'     => __( 'Upload your background here', 'qns' ),
            'subtitle' => __( '', 'qns' )
        ),
		array(
            'id'       => 'background_repeat',
            'type'     => 'radio',
            'title'    => __( 'Background Repeat', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( 'Choose how to repeat the background image', 'qns' ),
            'options'  => array(
                'repeat' => 'repeat',
				'repeat-y' => 'repeat-y',
				'repeat-x' => 'repeat-x',
				'no-repeat' => 'no-repeat'
            ),
            'default'  => 'repeat'
        ),
		array(
            'id'       => 'main_color',
            'type'     => 'color',
            'title'    => __( 'Main Colour', 'qns' ),
            'subtitle' => __( 'Pick a colour', 'qns' ),
            'default'  => '',
			'validate' => 'color',
        ),
		array(
            'id'       => 'main_colortext',
            'type'     => 'color',
            'title'    => __( 'Main Colour Text', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'default'  => 'Pick a slightly lighter version of the main colour, this text will be overlayed onto the main colour',
			'validate' => 'color',
        ),
		array(
            'id'       => 'main_colorrgba',
            'type'     => 'text',
            'title'    => __( 'Main Colour in RGBA format', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( 'Note: This is used to change the slideshow text background colour. Use this free online tool to find your colour in RGBA format: http://hex2rgba.devoth.com/ e.g. rgba(106, 166, 138, 0.7)', 'qns' ),
            'default'  => '',
        ),
		array(
            'id'       => 'custom_css',
            'type'     => 'textarea',
            'title'    => __( 'Custom CSS', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( 'Add any custom CSS you wish here', 'qns' ),
            'default'  => '',
        ),
		array(
            'id'       => 'custom_font_code',
            'type'     => 'textarea',
            'title'    => __( 'Google Font', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "Add Google Font Code Here, e.g. <br /><br /> &#60;link href='http://fonts.googleapis.com/css?family=Cardo:400,400italic,700' rel='stylesheet' type='text/css'&#62;", 'qns' ),
            'default'  => "<link href='http://fonts.googleapis.com/css?family=Cardo:400,400italic,700' rel='stylesheet' type='text/css'>",
        ),
		array(
            'id'       => 'custom_font',
            'type'     => 'text',
            'title'    => __( 'Google Font Name', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "Enter the Google Font name / family here without 'font-family', e.g. <br /><br /> 'Cardo', serif", 'qns' ),
            'default'  => "'Cardo', serif",
        ),
		array(
            'id'       => 'default_header_url',
            'type'     => 'text',
            'title'    => __( 'Default Header Image URL', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "Displayed on all inner pages, don't forget the http://", 'qns' ),
            'default'  => "",
        ),
    )

) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Home Settings', 'qns' ),
    'id'               => 'home-settings',
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-home',
	
	'fields'           => array(
		array(
            'id'       => 'slideshow_display',
            'type'     => 'checkbox',
            'title'    => __( 'Display Slideshow', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( 'Tick to display slideshow on homepage', 'qns' ),
            'default'  => '1'// 1 = on | 0 = off
        ),
		array(
            'id'       => 'featured_products_display',
            'type'     => 'checkbox',
            'title'    => __( 'Display Featured Products', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( 'Tick to display featured products on homepage', 'qns' ),
            'default'  => '0'// 1 = on | 0 = off
        ),
		array(
            'id'       => 'featured_products_display_number',
            'type'     => 'text',
            'title'    => __( 'Number of Featured Products', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "To be displayed on the homepage", 'qns' ),
            'default'  => "4",
        ),
		array(
            'id'       => 'slideshow_autoplay',
            'type'     => 'checkbox',
            'title'    => __( 'Autoplay Slideshow', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( 'Tick to autoplay', 'qns' ),
            'default'  => '0'// 1 = on | 0 = off
        ),
		array(
            'id'       => 'slideshow_speed',
            'type'     => 'text',
            'title'    => __( 'Slideshow Speed', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "Amount of time each slide displays for in milliseconds, e.g. 7000 = 7 seconds", 'qns' ),
            'default'  => "7000",
        ),
		array(
            'id'       => 'slideshow_video',
            'type'     => 'checkbox',
            'title'    => __( 'Does your slideshow contain a video?', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( 'Tick this if it does to load additional JS required to display video', 'qns' ),
            'default'  => '0'// 1 = on | 0 = off
        ),
		array(
            'id'       => 'homepage_announcement',
            'type'     => 'textarea',
            'title'    => __( 'Announcement Message', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "Leave this blank to display no announcement", 'qns' ),
            'default'  => "This is an example announcement, go and change it in the theme options!",
        ),
		array(
            'id'       => 'homepage_testimonial_ids',
            'type'     => 'text',
            'title'    => __( 'Testimonial IDs to Display on Homepage', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "Post IDs of testimonials to display separated by a comma. e.g. 1,10,8", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'homepage_text_block',
            'type'     => 'textarea',
            'title'    => __( 'Homepage Text Block', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "Add additional HTML content to the homepage", 'qns' ),
            'default'  => "[columns]
			[one_third]
			[title]Example Title #1[/title]
			<p>Nulla facilisi. Cras eget enim eu ante mollis elementum. Vestibulum venenatis tempor dui. Aenean porta lobortis dui eu vestibulum. Suspendisse vel consequat odio. Nam porttitor turpis ut sapien tempus tincidunt. Donec tempor[/one_third]
			[one_third]
			[title]Example Title #2[/title]
			[list]
			[li]This is a list item[/li]
			[li]This is a list item[/li]
			[li]This is a list item[/li]
			[li]This is a list item[/li]
			[li]This is a list item[/li]
			[/list]
			[/one_third]
			[one_third_last]
			[title]Example Title #3[/title]
			<p>Nulla facilisi. Cras eget enim eu ante mollis elementum. Vestibulum venenatis tempor dui. Aenean porta lobortis dui eu vestibulum. Suspendisse vel consequat odio. Nam porttitor turpis ut sapien tempus tincidunt. Donec tempor</p>
			[/one_third_last]
			[/columns]",
			"type" => "textarea",
        ),
		
    )

) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Shop Settings', 'qns' ),
    'id'               => 'shop-settings',
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-shopping-cart',
	
	'fields'     => array(
        array(
            'id'       => 'top-right-chk-acc',
            'type'     => 'checkbox',
            'title'    => __( 'Display "Checkout" and "My Account" links in the top right of page', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( 'Tick to display', 'qns' ),
            'default'  => '1'// 1 = on | 0 = off
        ),
		array(
            'id'       => 'shop_per_page',
            'type'     => 'text',
            'title'    => __( 'Shop Items Per Page', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "Enter a numerical value e.g. 10", 'qns' ),
            'default'  => "9",
        ),

	)

) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Social Settings', 'qns' ),
    'id'               => 'social-settings',
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-facebook',
	
	'fields'     => array(
		array(
            'id'       => 'social_twitter',
            'type'     => 'text',
            'title'    => __( 'Twitter', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "URL with http://", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'social_pinterest',
            'type'     => 'text',
            'title'    => __( 'Pinterest', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "URL with http://", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'social_facebook',
            'type'     => 'text',
            'title'    => __( 'Facebook', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "URL with http://", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'social_googleplus',
            'type'     => 'text',
            'title'    => __( 'Googleplus', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "URL with http://", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'social_skype',
            'type'     => 'text',
            'title'    => __( 'Skype', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "URL with http://", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'social_flickr',
            'type'     => 'text',
            'title'    => __( 'Flickr', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "URL with http://", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'social_linkedin',
            'type'     => 'text',
            'title'    => __( 'Linkedin', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "URL with http://", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'social_vimeo',
            'type'     => 'text',
            'title'    => __( 'Vimeo', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "URL with http://", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'social_youtube',
            'type'     => 'text',
            'title'    => __( 'Youtube', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "URL with http://", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'social_rss',
            'type'     => 'text',
            'title'    => __( 'RSS Feed', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "URL with http://", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'social_instagram',
            'type'     => 'text',
            'title'    => __( 'Instagram', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "URL with http://", 'qns' ),
            'default'  => "",
        ),

	)

) );

Redux::setSection( $opt_name, array(
    'title'            => __( 'Contact Settings', 'qns' ),
    'id'               => 'contact-settings',
    'desc'             => '',
    'customizer_width' => '400px',
    'icon'             => 'el el-envelope',
	
	'fields'     => array(
        array(
            'id'       => 'contact_email',
            'type'     => 'text',
            'title'    => __( 'Contact Form Email', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "Enter the email address you would like the contact form to send emails to", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'street_address',
            'type'     => 'text',
            'title'    => __( 'Street Address', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "To be display in contact details list", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'phone_number',
            'type'     => 'text',
            'title'    => __( 'Phone Number', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "To be display in contact details list", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'email_address',
            'type'     => 'text',
            'title'    => __( 'Email Address', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "To be display in contact details list", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'map_address',
            'type'     => 'checkbox',
            'title'    => __( 'Display Google Map On Contact Page', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( 'Tick to display', 'qns' ),
            'default'  => '1'// 1 = on | 0 = off
        ),
		array(
            'id'       => 'map_latitude',
            'type'     => 'text',
            'title'    => __( 'Google Map Latitude', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'map_longitude',
            'type'     => 'text',
            'title'    => __( 'Google Map Longitude', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( "", 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'gmap-api-key',
            'type'     => 'text',
            'title'    => __( 'Google Map API Key', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( 'The Google Map will not work without this, you can get a key here: <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">https://developers.google.com/maps/documentation/javascript/get-api-key</a>', 'qns' ),
            'default'  => "",
        ),
		array(
            'id'       => 'gmap-content',
            'type'     => 'textarea',
            'title'    => __( 'Google Map Marker Content', 'qns' ),
            'subtitle' => __( '', 'qns' ),
            'desc'     => __( '', 'qns' ),
            'default'  => '<h2>Organic Shop</h2><p>1 Main Road, London, UK</p>',
        ),

	)

) );