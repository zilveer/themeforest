<?php
	
	function sama_hide_ads_in_reduxframework() {
	?>
	<style type="text/css">
	.rAds {
		display: none !important;
	}
	</style>
	<?php
	}
	add_action('admin_head', 'sama_hide_ads_in_reduxframework');

    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

	global $majesty_allowed_tags;
	
    // This is your option name where all the Redux data is stored.
    $opt_name = "majesty";

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => 'majesty',
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'submenu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => false,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Majesty Options', 'theme-majesty' ),
        'page_title'           => esc_html__( 'Majesty Options', 'theme-majesty' ),

        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => true,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => false,
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
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
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
	//Redux::setExtensions( $opt_name, esc_url(SAMA_INC_DIR. 'theme-options/redux-vendor-support-master/redux-vendor-support.php') );
	
	// Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( esc_html__( 'Imagine what You can do with: Majesty easy to edit', 'theme-majesty' ), $v );
    }
    // Add content after the form.
    $args['footer_text'] = '<p>'. esc_html__( 'Thanks to sell majesty themes.', 'theme-majesty' ). '</p>';

    Redux::setArgs( $opt_name, $args );


    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General Settings', 'theme-majesty' ),
        'id'               => 'general-settings',
        'subsection'       => false,
        'fields'           => array(
			array(
				'id'       => 'theme_layout',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Theme Layout', 'theme-majesty' ),
				'options'  => array(
					'default' 	=> esc_html__('Default', 'theme-majesty'),
					'boxed' 	=> esc_html__('Boxed', 'theme-majesty'),
				),
				'default'  => 'default'
			),
			array(
				'id'       => 'boxed_type',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Boxed Type', 'theme-majesty' ),
				'options'  => array(
					'boxedbgcolor' 		=> esc_html__('Color', 'theme-majesty'),
					'boxedbgrepeat' 	=> esc_html__('Background Repeat', 'theme-majesty'),
					'boxedbgnorepeat' 	=> esc_html__('Background no Repeat', 'theme-majesty'),
				),
				'required' => array( 'theme_layout', '=', 'boxed' ),
				'default'  => 'boxedbgcolor'
			),
			
			array(
				'id'       		=> 'boxed_bg_color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Boxed Background Color', 'theme-majesty' ),
				'default'  		=> '#2a2a2a',
				'validate' 		=> 'color',
				'transparent'	=> false,
				'required' => array( 'boxed_type', '=', 'boxedbgcolor' ),
			),
			
			array(
				'id'       => 'boxed_bg_img',
				'type'     => 'media',
				'title'    => esc_html__( 'Boxed Background Image', 'theme-majesty' ),
				'required' => array(
					array( 'boxed_type', '!=', 'boxedbgcolor' ),
				)
			),
			array(
				'id'       => 'display_breadcrumb',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Breadcrumb', 'theme-majesty' ),
				'default'  => true,
			),
			array(
				'id'       => 'display_loader',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enable Page Loader', 'theme-majesty' ),
				'default'  => true,
			),
			array(
				'id'       => 'loader_style',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Loader Style', 'theme-majesty' ),
				'options'  => array(
					'loader' 		=> esc_html__('Style 1 Dark BG', 'theme-majesty'),
					'loader2' 		=> esc_html__('Style 2 White BG', 'theme-majesty'),
					'loader3' 		=> esc_html__('Style 3 Theme COLOR BG', 'theme-majesty'),
				),
				'required' => array( 'display_loader', '=', true ),
				'default'  => 'loader'
			),
			array(
				'id'       => 'loader_logo',
				'type'     => 'media',
				'title'    => esc_html__( 'Loader Logo', 'theme-majesty' ),
				'required' => array(
					array( 'display_loader', '=', true ),
				)
			),
			array(
				'id'       => 'gmaps_api',
				'type'     => 'text',
				'title'    => esc_html__( 'Google Maps API', 'theme-majesty' ),
				'default'  => '',
			),
        )
    ));
   
	Redux::setSection( $opt_name, array(
		'icon'   			=> 'el-icon-eye-open',
        'title'            => esc_html__( 'Logo and Favicons', 'theme-majesty' ),
        'id'               => 'logo-favicons',
        'fields'           => array(
			array(
				'id'       	=> 'logo-light-trans',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Logo 1', 'theme-majesty' ),
				'desc'		=> esc_html__('This Logo used inside transparent slider, custom Background for page & DARK Solid Background 204* 54 px.', 'theme-majesty')
			),
			array(
				'id'       	=> 'logo-light-small',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Logo small 1', 'theme-majesty' ),
				'desc'		=> esc_html__('This Logo used used for white background in stacky header when scroll page 151* 40 px.', 'theme-majesty')
			),
			array(
				'id'       	=> 'logo-white-bg',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Logo 2', 'theme-majesty' ),
				'desc'		=> esc_html__('This Logo used used for sloid white header background 204* 54 px.', 'theme-majesty')
			),
			array(
				'id'       	=> 'logo-dark-small',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Logo small 2', 'theme-majesty' ),
				'desc'		=> esc_html__('This Logo used for dark background stacky header when scroll page 151* 40 px.', 'theme-majesty')
			),
			array(
				'id'       	=> 'vertical-logo',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'vertical Menu logo', 'theme-majesty' ),
				'desc'		=> esc_html__('This logo display in page have vertical Menu.', 'theme-majesty')
			),
			
			
        )
    ));
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Favicons', 'theme-majesty' ),
        'id'               => 'favicons',
        'subsection'       => true,
        'fields'           => array(
			array(
				'id'       	=> 'favicon',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Favicon', 'theme-majesty' ),
				'desc'		=> esc_html__('A favicon is a 16x16 pixel icon that represents your site.', 'theme-majesty')
			),
			array(
				'id'       	=> 'apple_touch_icon_57',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Apple Custom Icon (57x57)', 'theme-majesty' ),
				'desc'		=> esc_html__('Upload your Apple Touch Icon (57x57px png).', 'theme-majesty')
			),
			array(
				'id'       	=> 'apple_touch_icon_72',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Apple Custom Icon (72x72)', 'theme-majesty' ),
				'desc'		=> esc_html__('Upload your Apple Touch Icon (72x72px png).', 'theme-majesty')
			),
			array(
				'id'       	=> 'apple_touch_icon_114',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Apple Custom Icon (114x114)', 'theme-majesty' ),
				'desc'		=> esc_html__('Upload your Apple Touch Icon (114x114px png).', 'theme-majesty')
			),
			
        )
    ));
	
	Redux::setSection( $opt_name, array(
		'icon'   			=> 'el-icon-th',
        'title'            => esc_html__( 'Menu', 'theme-majesty' ),
        'id'               => 'majesty-menu',
        'fields'           => array(
			 array(
                'id'   => 'majesty-menu-info',
                'type' => 'info',
                'desc' => wp_kses(__('This Menu is with solid color used for pages, posts not have custom heading if page have custom background by default display menu with transparent and when scroll page display light or dark color.<br/> For Site Have One Page used second menu to home page and default first menu for othere posts and pages in you website.<br/> to create external link in scroll menu add class external to this item in menu.', 'theme-majesty'), $majesty_allowed_tags)
            ),
			array(
				'id'       => 'menu_color',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Menu Color', 'theme-majesty' ),
				'options'  => array(
					'light' 	=> esc_html__('Light', 'theme-majesty'),
					'dark' 		=> esc_html__('Dark', 'theme-majesty'),
				),
				'default'  => 'light'
			),
			array(
				'id'       => 'logo_position',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Logo Position', 'theme-majesty' ),
				'options'  => array(
					'default' 	=> esc_html__('Default', 'theme-majesty'),
					'center' 		=> esc_html__('Center', 'theme-majesty'),
				),
				'default'  => 'default'
			),
			array(
				'id'       => 'pages_second_menu',
				'type'     => 'select',
				'data'     => 'pages',
				'multi'    => true,
				'title'    => esc_html__( 'Second Menu Pages', 'theme-majesty' ),
				'desc'     => esc_html__( 'Select pages to display Second menu at top usefull for one page and other posts or page used first menu.', 'theme-majesty' ),
			),
			array(
				'id'       => 'pages_scroll_menu',
				'type'     => 'select',
				'data'     => 'pages',
				'multi'    => true,
				'title'    => esc_html__( 'Scroll Menu', 'theme-majesty' ),
				'desc'     => esc_html__( 'Display Scroll Menu Usefull for website one page.', 'theme-majesty' ),
			),
        )
    ));
	
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Menu Slider', 'theme-majesty' ),
        'id'               => 'majesty-menu-silder',
		'subsection'       => true,
        'fields'           => array(
			 array(
                'id'   => 'majesty-menu-info',
                'type' => 'info',
                'desc' => wp_kses( __('Create Slider for Mega menu, after create slider go to admin > Appearance > widget > and drop <strong>widget Menu Carousel</strong> inside widegt area name <strong>Mega Menu Widgets</strong> and go to  admin > Appearance > menu and edit menu and select menu iten to display mega menu widget.', 'theme-majesty'), $majesty_allowed_tags)
            ),
			array(
				'id'          => 'menu_silder',
				'type'        => 'slides',
				'title'       => esc_html__('Slides Options', 'theme-majesty'),
				'subtitle'    => esc_html__('Unlimited slides with drag and drop sortings.', 'theme-majesty'),
				'placeholder' => array(
					'title'           => esc_html__('Title', 'theme-majesty'),
					'description'     => esc_html__('Make This Field Empty', 'theme-majesty'),
					'url'             => esc_html__('Slide Link', 'theme-majesty'),
				),
			
			)
		)
    ));
    
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Top Small Slider', 'theme-majesty' ),
        'id'               => 'majesty-top-small-silder',
		'subsection'       => true,
        'fields'           => array(
			array(
				'id'       => 'enable_small_hedaer',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Top Small Header', 'theme-majesty' ),
				'default'  => false,
				'on'	   => 'Enabled',
				'off'	   => 'Disabled',
			),
			array(
				'id'       => 'pages_display_small_header',
				'type'     => 'select',
				'data'     => 'pages',
				'multi'    => true,
				'title'    => esc_html__( 'Pages Display Small Header', 'theme-majesty' ),
				'desc'     => esc_html__( 'Select Pages to display small header at top of page.', 'theme-majesty' ),
				'required' => array('enable_small_hedaer','equals',false),
			),
			array(
				'id'       => 'phone_number',
				'type'     => 'text',
				'title'    => esc_html__( 'Phone Number', 'theme-majesty' ),
				'default'  => 'Hot Line +022 0100 843',
			),
			array(
                'id'       => 'booking_page',
                'type'     => 'select',
                'data'     => 'pages',
                'title'    => esc_html__( 'Select Booking Page', 'theme-majesty' ),
            ),
			array(
                'id'       => 'header_more_links',
                'type'     => 'multi_text',
                'title'    => esc_html__( 'Add More Links', 'theme-majesty' ),
                'desc'     => esc_html__( 'Add more links beside phone number and booking page you can use validate html, and fortawesome.', 'theme-majesty' ),
				'validate' => 'html',
            ),
			array(
				'id'       => 'small_hedaer_social_target',
				'type'     => 'select',
				'title'    => esc_html__( 'Social links target', 'theme-majesty' ),
				'desc'	   => esc_html__('When click social icon open link in same window or new window.', 'theme-majesty'),
				'options'  => array(
					'_blank' 		=> esc_html__('Blank', 'theme-majesty'),
					'_self' 		=> esc_html__('Self', 'theme-majesty'),
				),
				'default'  => '_self'
			),
			array(
				'id'       => 'head_facebook',
				'type'     => 'text',
				'title'    => esc_html__( 'Facebook URL', 'theme-majesty' ),
				'default'  => 'https://www.facebook.com/',
				'validate' => 'url',
			),
			array(
				'id'       => 'head_twitter',
				'type'     => 'text',
				'title'    => esc_html__( 'Twitter URL', 'theme-majesty' ),
				'default'  => 'https://twitter.com/',
				'validate' => 'url',
			),
			array(
				'id'       => 'head_gplus',
				'type'     => 'text',
				'title'    => esc_html__( 'Google Plus URL', 'theme-majesty' ),
				'default'  => 'https://plus.google.com/',
				'validate' => 'url',
			),
			array(
				'id'       => 'head_vimeo',
				'type'     => 'text',
				'title'    => esc_html__( 'Vimeo URL', 'theme-majesty' ),
				'validate' => 'url',
			),
			array(
				'id'       => 'head_youtube',
				'type'     => 'text',
				'title'    => esc_html__( 'Youtube URL', 'theme-majesty' ),
				'validate' => 'url',
			),
			array(
				'id'       => 'head_instagram',
				'type'     => 'text',
				'title'    => esc_html__( 'Instagram URL', 'theme-majesty' ),
				'validate' => 'url',
			),
			array(
				'id'       => 'head_pinterest',
				'type'     => 'text',
				'title'    => esc_html__( 'Pinterest URL', 'theme-majesty' ),
				'validate' => 'url',
			),
			array(
				'id'       => 'head_tripadvisor',
				'type'     => 'text',
				'title'    => esc_html__( 'Tripadvisor URL', 'theme-majesty' ),
				'validate' => 'url',
				'default'  => 'http://www.tripadvisor.com/',
			),
			array(
				'id'       => 'head_foursquare',
				'type'     => 'text',
				'title'    => esc_html__( 'Foursquare URL', 'theme-majesty' ),
				'validate' => 'url',
				'default'  => 'https://foursquare.com/',
			),
		)
    ));
	
	Redux::setSection( $opt_name, array(
		'icon'   			=> 'el-icon-bold',
        'title'            => esc_html__( 'Blog', 'theme-majesty' ),
        'id'               => 'majesty-blog',
        'fields'           => array(
			array(
				'id'       => 'blog_type',
				'type'     => 'select',
				'title'    => esc_html__( 'Blog Type', 'theme-majesty' ),
				'desc'	   => esc_html__('Blog Type Masonry and Grid Full Width not have sidebar.', 'theme-majesty'),
				'options'  => array(
					'blog-gird-4-col' 			=> esc_html__('Blog Grid 4 Columns', 'theme-majesty'),
					'blog-gird-full-width' 		=> esc_html__('Blog Grid Full Width', 'theme-majesty'),
					'blog-gird-3-col' 			=> esc_html__('Blog Grid 3 Columns', 'theme-majesty'),
					'blog-gird-2-col' 			=> esc_html__('Blog Grid 2 Columns', 'theme-majesty'),
					'blog-list-small-thumb' 	=> esc_html__('Blog List Image beside Title', 'theme-majesty'),
					'blog-list-big-thumb' 		=> esc_html__('Blog List Image above Title', 'theme-majesty'),
					'blog-masonry-4-col' 		=> esc_html__('Blog Masonry 4 Columns', 'theme-majesty'),
					'blog-masonry-3-col' 		=> esc_html__('Blog Masonry 3 Columns', 'theme-majesty'),
					'blog-masonry-2-col' 		=> esc_html__('Blog Masonry 2 Columns', 'theme-majesty'),
					'blog-masonry-full-width' 	=> esc_html__('Blog Masonry Full Width', 'theme-majesty'),
					'wpdefault' 				=> esc_html__('Default Wordpress', 'theme-majesty')
				),
				'default'  => 'wpdefault'
			),
			array(
				'id'       => 'blog_with_sidebar',
				'type'     => 'switch',
				'title'    => esc_html__( 'Blog Sidebar', 'theme-majesty' ),
				'default'  => true,
				'required' => array( 
					array('blog_type','!=','blog-gird-full-width'),
					array('blog_type','!=','blog-masonry-4-col'),
					array('blog_type','!=','blog-masonry-3-col'),
					array('blog_type','!=','blog-masonry-2-col'),
					array('blog_type','!=','blog-masonry-full-width')
				)
			),
			array(
				'id'       => 'blog_archive_type',
				'type'     => 'select',
				'title'    => esc_html__( 'Blog Archive Type', 'theme-majesty' ),
				'desc'	   => esc_html__('Blog Archive page display tag, category, date', 'theme-majesty'),
				'options'  => array(
					'blog-gird-4-col' 			=> esc_html__('Blog Grid 4 Columns', 'theme-majesty'),
					'blog-gird-full-width' 		=> esc_html__('Blog Grid Full Width', 'theme-majesty'),
					'blog-gird-3-col' 			=> esc_html__('Blog Grid 3 Columns', 'theme-majesty'),
					'blog-gird-2-col' 			=> esc_html__('Blog Grid 2 Columns', 'theme-majesty'),
					'blog-list-small-thumb' 	=> esc_html__('Blog List Image beside Title', 'theme-majesty'),
					'blog-list-big-thumb' 		=> esc_html__('Blog List Image above Title', 'theme-majesty'),
					'blog-masonry-4-col' 		=> esc_html__('Blog Masonry 4 Columns', 'theme-majesty'),
					'blog-masonry-3-col' 		=> esc_html__('Blog Masonry 3 Columns', 'theme-majesty'),
					'blog-masonry-2-col' 		=> esc_html__('Blog Masonry 2 Columns', 'theme-majesty'),
					'blog-masonry-full-width' 	=> esc_html__('Blog Masonry Full Width', 'theme-majesty'),
					'wpdefault' 				=> esc_html__('Default Wordpress', 'theme-majesty')
				),
				'default'  => 'wpdefault'
			),
			array(
				'id'       => 'archive_with_sidebar',
				'type'     => 'switch',
				'title'    => esc_html__( 'Blog Sidebar', 'theme-majesty' ),
				'default'  => true,
				'required' => array( 
					array('blog_type','!=','blog-gird-full-width'),
					array('blog_type','!=','blog-masonry-4-col'),
					array('blog_type','!=','blog-masonry-3-col'),
					array('blog_type','!=','blog-masonry-2-col'),
					array('blog_type','!=','blog-masonry-full-width')
				)
			),
			array(
				'id'       => 'blog_mas_thumb',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Blog Masonry Image', 'theme-majesty' ),
				'desc'	   => esc_html__('If you make blog type masonry for large image you can display full size or thumbnail', 'theme-majesty'),
				'options'  => array(
					'full' 			=> esc_html__('Full Image', 'theme-majesty'),
					'masonrythumb' 	=> esc_html__('Use Thumbnail Size', 'theme-majesty'),
				),
				'default'  => 'masonrythumb'
			),
			array(
				'id'       => 'btn_more_as',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Display More Button As', 'theme-majesty' ),
				'desc'	   => esc_html__('Button more display in blog list or wordpres default', 'theme-majesty'),
				'options'  => array(
					'icon' 	=> esc_html__('Icon', 'theme-majesty'),
					'text' 	=> esc_html__('Center', 'theme-majesty'),
				),
				'default'  => 'icon'
			),
			array(
				'id'       => 'blog_excerpt',
				'type'     => 'text',
				'title'    => esc_html__( 'Excerpt Length', 'theme-majesty' ),
				'validate' => 'numeric',
				'default'  => '16',
			),
        )
    ));
	
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Post', 'theme-majesty' ),
		'subsection'       => true,
        'id'               => 'majesty-post',
        'fields'           => array(
			array(
				'id'       => 'single_gallery_at_top',
				'type'     => 'switch',
				'title'    => esc_html__( 'Gallery Post Display Slider', 'theme-majesty' ),
				'desc'	   => esc_html__('For post gallery display slider at top if you choose no mean display thumbnail.', 'theme-majesty'),
				'default'  => true,
			),
			array(
				'id'       => 'single_display_share_icon',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Share icon', 'theme-majesty' ),
				'desc'	   => esc_html__('For post gallery display slider at top if you choose no mean display thumbnail.', 'theme-majesty'),
				'default'  => true,
			),
			
			array(
				'id'       => 'single_share_facebook',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Facebook', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display Facebook Share icon in post', 'theme-majesty' ),
				'default'  => true,
				'required' => array('single_display_share_icon','equals', true)
			),
			array(
				'id'       => 'single_share_twitter',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Twitter', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display Twitter Share icon in post', 'theme-majesty' ),
				'default'  => true,
				'required' => array('single_display_share_icon','equals', true)
			),
			array(
				'id'       => 'single_share_pinterest',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Pinterest', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display Pinterest Share icon in post', 'theme-majesty' ),
				'default'  => false,
				'required' => array('single_display_share_icon','equals', true)
			),
			array(
				'id'       => 'single_share_gplus',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Google Plus', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display Google Plus Share icon in post', 'theme-majesty' ),
				'default'  => true,
				'required' => array('single_display_share_icon','equals', true)
			),
			array(
				'id'       => 'single_share_linkedin',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Linkedin', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display Linkedin Share icon in post', 'theme-majesty' ),
				'default'  => false,
				'required' => array('single_display_share_icon','equals', true)
			)
		
        )
    ));
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Post Backgroud Header', 'theme-majesty' ),
		'subsection'       => true,
        'id'               => 'majesty-post-bg',
        'fields'           => array(
			array(
				'id'       => 'blog_single_post_bg',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Custom Background', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display custom background for all single post', 'theme-majesty' ),
				'default'  => false,
			),
			array(
				'id'       => 'blog_single_subtitle',
				'type'     => 'text',
				'title'    => esc_html__( 'Subtitle', 'theme-majesty' ),
				'desc'    => esc_html__( 'This sub title display under Blog.', 'theme-majesty' ),
				'default'  => 'All About Majesty',
				'required' => array('blog_single_post_bg','=', true)
			),
			array(
				'id'       	=> 'blog_single_bg',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Upload Background', 'theme-majesty' ),
				'required' => array('blog_single_post_bg','=', true)
			)
			
        )
    ));
	
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Blog Archive Backgroud Header', 'theme-majesty' ),
		'subsection'       => true,
        'id'               => 'majesty-archive-bg',
        'fields'           => array(
			array(
                'id'   => 'majesty-archive-bg-info',
                'type' => 'info',
                'desc' => esc_html__('Display Custom Background at top of this page, to do that please go to blog page and edit it and selct header with custom background.', 'theme-majesty')
            ),
			array(
				'id'       => 'blog_cat_bg',
				'type'     => 'switch',
				'title'    => esc_html__( 'Category', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display custom background for Category', 'theme-majesty' ),
				'default'  => false,
			),
			array(
				'id'       => 'blog_tag_bg',
				'type'     => 'switch',
				'title'    => esc_html__( 'Tag', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display custom background for Tag', 'theme-majesty' ),
				'default'  => false,
			),
			array(
				'id'       => 'blog_author_bg',
				'type'     => 'switch',
				'title'    => esc_html__( 'Author', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display custom background for Author Page', 'theme-majesty' ),
				'default'  => false,
			),
        )
    ));
	
	Redux::setSection( $opt_name, array(
		'icon'			   => 'el-icon-user',
        'title'            => esc_html__( 'Team Member', 'theme-majesty' ),
        'id'               => 'team-member-archive',
        'fields'           => array(
			array(
				'id'       	=> 'team_mem_head_bg',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Custom Background team memeber', 'theme-majesty' ),
				'desc'	    => esc_html__('Dispaly Custom Background For Archive Team memeber page.', 'theme-majesty'),
			),
			array(
				'id'       => 'team_cat_bg',
				'type'     => 'switch',
				'title'    => esc_html__( 'Custom Background', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display custom background for team memeber category used image ', 'theme-majesty' ),
				'default'  => false,
			),
			array(
				'id'       => 'team_mem_subtitle',
				'type'     => 'text',
				'title'    => esc_html__( 'Subtitle', 'theme-majesty' ),
				'desc'     => esc_html__( 'This sub title display under team member archive page and category.', 'theme-majesty' ),
				'default'  => 'Every Thing You Know About Majesty',
			),
			array(
				'id'       => 'display_email_at_team_archive',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Email', 'theme-majesty' ),
				'desc'	   => esc_html__('Display Email for memeber in Archive Page.', 'theme-majesty'),
				'default'  => false,
			),
        )
    ));
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Single Team Memeber', 'theme-majesty' ),
		'subsection'       => true,
        'id'               => 'team-member-single',
        'fields'           => array(
			array(
				'id'       => 'team_single_post_bg',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Custom Background', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display custom background for all team memeber post', 'theme-majesty' ),
				'default'  => false,
			),
			array(
				'id'       	=> 'team_single_bg',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Upload Background', 'theme-majesty' ),
				'required' => array('team_single_post_bg','=', true)
			)
        )
    ));
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Related Team Memeber', 'theme-majesty' ),
		'subsection'       => true,
        'id'               => 'team-member-related',
        'fields'           => array(
			array(
				'id'       => 'display_related_members',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Related Team Memeber', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display Realted Team member At botton of single memeber', 'theme-majesty' ),
				'default'  => true,
			),
			array(
				'id'       => 'related_member_title',
				'type'     => 'text',
				'title'    => esc_html__( 'Title Of Related', 'theme-majesty' ),
				'default'  => 'OUR TEAM',
				'required' => array('display_related_members','=', true)
			),
			array(
				'id'       	=> 'related_member_sub_title',
				'type'    	=> 'text',
				'title'    	=> esc_html__( 'SubTitle', 'theme-majesty' ),
				'desc'    	=> esc_html__( 'This is subtitle display under title for realted team memeber.', 'theme-majesty' ),
				'default'  	=> 'The Friendlist Professional Chef',
				'required' => array('display_related_members','=', true)
			),
			array(
				'id'       => 'related_member_num',
				'type'     => 'text',
				'title'    => esc_html__( 'Number Of Realted Team memeber', 'theme-majesty' ),
				'validate' => 'numeric',
				'default'  => '9',
				'required' => array('display_related_members','=', true)
			),
			array(
				'id'       => 'related_member_order',
				'type'     => 'select',
				'title'    => esc_html__( 'ORDER', 'theme-majesty' ),
				'options'  => array(
					'ASC' 			=> esc_html__('ASC', 'theme-majesty'),
					'DESC' 			=> esc_html__('DESC', 'theme-majesty'),
				),
				'default'  => 'DESC',
				'required' => array('display_related_members','=', true)
			),
			array(
				'id'       => 'related_member_orderby',
				'type'     => 'select',
				'title'    => esc_html__( 'ORDER BY', 'theme-majesty' ),
				'options'  => array(
					'ID' 			=> esc_html__('ID', 'theme-majesty'),
					'author' 		=> esc_html__('Author', 'theme-majesty'),
					'title' 		=> esc_html__('title', 'theme-majesty'),
					'name' 			=> esc_html__('Name', 'theme-majesty'),
					'date' 			=> esc_html__('Date', 'theme-majesty'),
					'rand' 			=> esc_html__('Rand', 'theme-majesty'),
					'menu_order' 	=> esc_html__('Menu Order', 'theme-majesty'),
				),
				'default'  => 'date',
				'required' => array('display_related_members','=', true)
			),
			array(
				'id'       => 'related_member_display_email',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Email', 'theme-majesty' ),
				'desc'	   => esc_html__('Display Email for memeber in related.', 'theme-majesty'),
				'default'  => false,
				'required' => array('display_related_members','=', true)
			),
			array(
				'id'       => 'related_member_bg',
				'type'     => 'select',
				'title'    => esc_html__( 'Related Background', 'theme-majesty' ),
				'options'  => array(
					'white' 		=> esc_html__('white', 'theme-majesty'),
					'gray' 			=> esc_html__('Gray', 'theme-majesty'),
					'background' 	=> esc_html__('Background', 'theme-majesty'),
				),
				'default'  => 'white',
				'required' => array('display_related_members','=', true)
			),
			array(
				'id'       	=> 'related_bg_url',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Upload Background', 'theme-majesty' ),
				'required' => array(
					array('display_related_members','=', true),
					array('related_member_bg','=', 'background'),
				)
			),
			array(
				'id'       => 'related_bg_parallax',
				'type'     => 'select',
				'title'    => esc_html__( 'Enable Parallax', 'theme-majesty' ),
				'options'  => array(
					'yes' 		=> esc_html__('Yes', 'theme-majesty'),
					'no' 		=> esc_html__('No', 'theme-majesty'),
				),
				'default'  => 'yes',
				'required' => array(
					array('display_related_members','=', true),
					array('related_member_bg','=', 'background'),
				)
			),
			array(
				'id'       => 'related_bg_trans',
				'type'     => 'select',
				'title'    => esc_html__( 'Overlay', 'theme-majesty' ),
				'options'  => array(
					'' 				=> esc_html__('No','theme-majesty'),
					'bg-pattern' 	=> esc_html__('Pattern','theme-majesty'),
					'transparent-bg-1' 	=> esc_html__('Transparent 0.1','theme-majesty'),
					'transparent-bg-2'	=> esc_html__('Transparent 0.2','theme-majesty'),
					'transparent-bg-3'	=> esc_html__('Transparent 0.3','theme-majesty'),
					'transparent-bg-4'	=> esc_html__('Transparent 0.4','theme-majesty'),
					'transparent-bg-5'	=> esc_html__('Transparent 0.5', 'theme-majesty'),
					'transparent-bg-6'	=> esc_html__('Transparent 0.6', 'theme-majesty'),
					'transparent-bg-7'	=> esc_html__('Transparent 0.7','theme-majesty'),
					'transparent-bg-8'	=> esc_html__('Transparent 0.8', 'theme-majesty'),
					'transparent-bg-9'		=> esc_html__('Transparent 0.9', 'theme-majesty'),
				),
				'default'  => 'transparent-bg-3',
				'required' => array(
					array('display_related_members','=', true),
					array('related_member_bg','=', 'background'),
				)
			),
        )
    ));
	
   Redux::setSection( $opt_name, array(
		'icon'   			=> 'el-icon-shopping-cart',
        'title'            => esc_html__( 'Shop', 'theme-majesty' ),
        'id'               => 'majesty-shop',
        'fields'           => array(
			array(
				'id'       => 'shop_type',
				'type'     => 'select',
				'title'    => esc_html__( 'Shop Type', 'theme-majesty' ),
				'desc'	   => esc_html__('Select Shop Layout.', 'theme-majesty'),
				'options'  => array(
					'fullwidth' 			=> esc_html__('Grid Full Width', 'theme-majesty'),
					'shopwithsidebar' 		=> esc_html__('Grid 3 Column With Sidebar', 'theme-majesty'),
					'shop-2col-withsidebar' => esc_html__('Grid 2 Column With Sidebar', 'theme-majesty'),
					'list2' 				=> esc_html__('List Full Width', 'theme-majesty'),
					'list2sidebar' 			=> esc_html__('List With Sidebar', 'theme-majesty'),
					'4col' 					=> esc_html__('4 Columns', 'theme-majesty'),
					'3col' 					=> esc_html__('3 Columns', 'theme-majesty'),
					'3colwithsidebar' 		=> esc_html__('3 Columns With Sidebar', 'theme-majesty'),
				),
				'default'  => 'fullwidth'
			),
			array(
				'id'       => 'shop_sid_pos',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Sidebar Position', 'theme-majesty' ),
				'options'  => array(
					'left' 	=> esc_html__('Left', 'theme-majesty'),
					'right' => esc_html__('Right', 'theme-majesty'),
				),
				'default'  => 'left',
				'required' => array(
					array('shop_type','!=', 'fullwidth'),
					array('shop_type','!=', 'list2'),
					array('shop_type','!=', '4col'),
					array('shop_type','!=', '3col')
				)
			),
			array(
				'id'       => 'shop_display_ordering_result_count',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display catalog ordering', 'theme-majesty' ),
				'desc'	   => esc_html__('Display number of result count and catalog order in shop page.', 'theme-majesty'),
				'default'  => true,
			),
			array(
				'id'       => 'shop_display_categories',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Shop Categories', 'theme-majesty' ),
				'desc'	   => esc_html__('Display all shop categories at top of shop page.', 'theme-majesty'),
				'default'  => false,
			),
			array(
				'id'       => 'shop_txt_link',
				'type'     => 'text',
				'title'    => esc_html__( 'All Products Text', 'theme-majesty' ),
				'desc'	   => esc_html__('this text display inside link to shop page.', 'theme-majesty'),
				'default'  => 'All Menu',
				'required' => array('shop_display_categories','equals', true)
			),
			array(
				'id'       => 'shop_display_rate_in_list2',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Product Rating in list', 'theme-majesty' ),
				'desc'	   => esc_html__('This used for shop list layout and shortcode display product as list with add cart button under image.', 'theme-majesty'),
				'default'  => true,
			),
			array(
				'id'       => 'shop_display_excerpt_in_list2',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Product Excerpt in list', 'theme-majesty' ),
				'desc'	   => esc_html__('This used for shop list layout and shortcode display product as list with add cart button under image.', 'theme-majesty'),
				'default'  => true,
			),
			array(
				'id'       => 'shop_display_thumbnail_in_list2',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Product Thumbnails in list', 'theme-majesty' ),
				'desc'	   => esc_html__('This used for shop list layout and shortcode display product as list with add cart button under image.', 'theme-majesty'),
				'default'  => true,
			),
			array(
				'id'       => 'products_per_page',
				'type'     => 'text',
				'title'    => esc_html__( 'Number Of Products in Shop Page', 'theme-majesty' ),
				'validate' => 'numeric',
				'default'  => '12',
			),
			array(
				'id'       => 'display_top_cart',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Top Cart', 'theme-majesty' ),
				'default'  => true,
			),
			array(
                'id'   => 'majesty-product-bg-info',
                'type' => 'info',
                'desc' => esc_html__('Display Custom Background at top For Product Category and Tags usign image you asigned in shop page.', 'theme-majesty')
            ),
			array(
				'id'       => 'shop_cat_bg',
				'type'     => 'switch',
				'title'    => esc_html__( 'Category', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display custom background for shop category', 'theme-majesty' ),
				'default'  => false,
			),
			array(
				'id'       => 'shop_tag_bg',
				'type'     => 'switch',
				'title'    => esc_html__( 'Tag', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display custom background for shop tag', 'theme-majesty' ),
				'default'  => false,
			),

        )
    ));
	
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Product', 'theme-majesty' ),
		'subsection'       => true,
        'id'               => 'majesty-shop-product',
        'fields'           => array(
			array(
				'id'       => 'shop_display_single_images',
				'type'     => 'button_set',
				'title'    => esc_html__( 'Thumbnails in Single Product', 'theme-majesty' ),
				'desc'    => esc_html__( 'By Default in single product theme using OWL Carousel To display image and thumbnails you can choose default to return to default woocommerce.', 'theme-majesty' ),
				'options'  => array(
					'default' 		=> esc_html__('Default', 'theme-majesty'),
					'owlcarousel' 	=> esc_html__('owlcarousel', 'theme-majesty'),
				),
				'default'  => 'owlcarousel'
			),
			array(
				'id'       => 'shop_display_share_icon',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Share icon', 'theme-majesty' ),
				'desc'	   => esc_html__('For post gallery display slider at top if you choose no mean display thumbnail.', 'theme-majesty'),
				'default'  => true,
			),
			array(
				'id'       => 'shop_share_facebook',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Facebook', 'theme-majesty' ),
				'default'  => true,
				'required' => array('shop_display_share_icon','equals', true)
			),
			array(
				'id'       => 'shop_share_twitter',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Twitter', 'theme-majesty' ),
				'default'  => true,
				'required' => array('shop_display_share_icon','equals', true)
			),
			array(
				'id'       => 'shop_share_pinterest',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Pinterest', 'theme-majesty' ),
				'default'  => false,
				'required' => array('shop_display_share_icon','equals', true)
			),
			array(
				'id'       => 'shop_share_gplus',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Google Plus', 'theme-majesty' ),
				'default'  => true,
				'required' => array('shop_display_share_icon','equals', true)
			),
			array(
				'id'       => 'shop_share_linkedin',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Linkedin', 'theme-majesty' ),
				'default'  => false,
				'required' => array('shop_display_share_icon','equals', true)
			)
		
        )
    ));
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Product Backgroud Header', 'theme-majesty' ),
		'subsection'       => true,
        'id'               => 'majesty-shop-product-bg',
        'fields'           => array(
			array(
				'id'       => 'shop_single_product_bg',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Custom Background For Single Product', 'theme-majesty' ),
				'desc'    => esc_html__( 'Display custom background for all single products', 'theme-majesty' ),
				'default'  => false,
			),
			array(
				'id'       => 'shop_single_subtitle',
				'type'     => 'text',
				'title'    => esc_html__( 'Subtitle', 'theme-majesty' ),
				'desc'    => esc_html__( 'This sub title display under shop.', 'theme-majesty' ),
				'default'  => 'Come & Taste',
				'required' => array('shop_single_product_bg','=', true)
			),
			array(
				'id'       	=> 'shop_single_bg',
				'type'     	=> 'media',
				'title'    	=> esc_html__( 'Upload Background', 'theme-majesty' ),
				'required'  => array('shop_single_product_bg','=', true)
			)
			
        )
    ));
	
	Redux::setSection( $opt_name, array(
		'icon'				=> 'el-icon-chevron-down',
        'title'            => esc_html__( 'Footer', 'theme-majesty' ),
        'id'               => 'majesty-footer',
        'fields'           => array(
			array(
                'id'       => 'footer_type',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Footer Widgets Type', 'theme-majesty' ),
                'options'  => array(
                    '1col' => array(
                        'alt' => '1 Column',
                        'img' => SAMA_THEME_URI . '/img/admin/options/footer-1c.png'
                    ),
                    '2col' => array(
                        'alt' => '2 Column',
                        'img' => SAMA_THEME_URI . '/img/admin/options/footer-2c.png'
                    ),
                    '2col-3-9' => array(
                        'alt' => '2 Column Right wide',
                        'img' => SAMA_THEME_URI . '/img/admin/options/footer-2c-narrow-wide.png'
                    ),
                    '2col-9-3' => array(
                        'alt' => '3 Column Middle',
                        'img' => SAMA_THEME_URI . '/img/admin/options/footer-2c-wide-narrow.png'
                    ),
                    '3col' => array(
                        'alt' => '3 Column',
                        'img' => SAMA_THEME_URI . '/img/admin/options/footer-3c.png'
                    ),
					'3col-6-3' => array(
                        'alt' => '3 Column Left Wide',
                        'img' => SAMA_THEME_URI . '/img/admin/options/footer-3c-wide-left.png'
                    ),
					'3col-3-6' => array(
                        'alt' => '3 Column Right Wide',
                        'img' => SAMA_THEME_URI . '/img/admin/options/footer-3c-wide-right.png'
                    ),
					'4col' => array(
                        'alt' => '3 Column Left',
                        'img' => SAMA_THEME_URI . '/img/admin/options/footer-4c.png'
                    ),
                ),
                'default'  => '4col'
            ),
			array(
				'id'       => 'display_foot_bottom',
				'type'     => 'switch',
				'title'    => esc_html__( 'Display Bottom Footer After Widgets', 'theme-majesty' ),
				'default'  => true,
			),
			array(
				'id'       => 'bottom_content',
				'type'     => 'editor',
				'title'    => esc_html__( 'Copy right content', 'theme-majesty' ),
				'required' => array('display_foot_bottom','=', true)
			),
			
        )
    ));
	
	Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Footer JS Code', 'theme-majesty' ),
		'subsection'       => true,
        'id'               => 'majesty-footer-js-code',
        'fields'           => array(
			array(
				'id'     => 'custom-js-code',
				'type'   => 'info',
				'notice' => true,
				'style'  => 'critical',
				'title'  => esc_html__( 'Add Footer CODE.', 'theme-majesty' ),
				'desc'   => wp_kses_post(__( 'Ex: like Google Analytics Code. Please to add you js code using this theme or child theme you need to <strong>create</strong> file name <strong>theme-custom-js.js</strong> inside <strong>js</strong> folder. you need to create this file because if i create it you lose this file in any update so i don\'t include it.', 'theme-majesty' )),
			),
			array(
				'id'       => 'enable_custom_js',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enable JS Code', 'theme-majesty' ),
				'default'  => false,
				'on'	   => 'Enabled',
				'off'	   => 'Disabled',
			),
			
        )
    ));
	
	Redux::setSection( $opt_name, array(
		'icon'   => 'el-icon-brush',
		'title'  => esc_html__( 'Style Options', 'theme-majesty' ),
		'fields' => array(
			array(
				'id'       => 'enable_theme_color_style',
				'type'     => 'switch',
				'title'    => esc_html__( 'Select Custom Color', 'theme-majesty' ),
				'default'  => false,
				'on'	   => 'Enabled',
				'off'	   => 'Disabled',
			),
			array(
				'id'       => 'themecolorstyle',
				'type'     => 'image_select',
				'compiler' => true,
				'title'    => esc_html__( 'Slect Color', 'theme-majesty' ),
				'options'  => array(
					'asian' => array(
						'alt' => 'Asian',
						'img' => SAMA_THEME_URI . '/img/admin/options/asian.jpg'
					),
					'bakery' => array(
						'alt' => 'Bakery',
						'img' => SAMA_THEME_URI . '/img/admin/options/bakery.jpg'
					),
					'burger' => array(
						'alt' => 'Burger',
						'img' => SAMA_THEME_URI . '/img/admin/options/burger.jpg'
					),
					'cafe' => array(
						'alt' => 'Cafe',
						'img' => SAMA_THEME_URI . '/img/admin/options/cafe.jpg'
					),
					'grill' => array(
						'alt' => 'Grill',
						'img' => SAMA_THEME_URI . '/img/admin/options/grill.jpg'
					),
					'pizza' => array(
						'alt' => 'Pizza',
						'img' => SAMA_THEME_URI . '/img/admin/options/pizza.jpg'
					),
				),
				'required' => array('enable_theme_color_style','=', true)
			),
			array(
				'id'       => 'enable_advanced_custom_color',
				'type'     => 'switch',
				'title'    => esc_html__( 'Advanced Custom Color', 'theme-majesty' ),
				'default'  => false,
				'on'	   => 'Enabled',
				'off'	   => 'Disabled',
			),
			array(
				'id'       		=> 'majesty_main_color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Main Color', 'theme-majesty' ),
				'default'  		=> '#c59d5f',
				'validate' 		=> 'color',
				'transparent'	=> false,
				'required' => array('enable_advanced_custom_color','equals',true),
			),
			array(
				'id'       		=> 'majesty_body_color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Body Color', 'theme-majesty' ),
				'default'  		=> '#515151',
				'validate' 		=> 'color',
				'transparent'	=> false,
				'required' => array('enable_advanced_custom_color','equals',true),
			),
			array(
				'id'       		=> 'majesty_head_color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Heading Color', 'theme-majesty' ),
				'default'  		=> '#262626',
				'validate' 		=> 'color',
				'transparent'	=> false,
				'required' => array('enable_advanced_custom_color','equals',true),
			),
			array(
				'id'       		=> 'majesty_icon_color',
				'type'     		=> 'color',
				'title'    		=> esc_html__('Icon For Custom Title', 'theme-majesty' ),
				'desc'			=> esc_html__('Icon Display when using visual composer or shortcode custom title.', 'theme-majesty'),
				'default'  		=> '#e8e8e8',
				'validate' 		=> 'color',
				'transparent'	=> false,
				'required' => array('enable_advanced_custom_color','equals',true),
			),
			array(
				'id'       		=> 'majesty_calendar_color',
				'type'     		=> 'color',
				'title'    		=> esc_html__( 'Calendar Color', 'theme-majesty' ),
				'desc'			=> esc_html__('This color used if you active plugin full calendar this color for field today perfrer color for this field is light version for main color.', 'theme-majesty'),
				'default'  		=> '#fcf8e3',
				'validate' 		=> 'color',
				'transparent'	=> false,
				'required' => array('enable_advanced_custom_color','equals',true),
			),
		)
	));
	
	Redux::setSection( $opt_name, array(
		'icon'   => 'el-icon-font',
		'subsection' => true,
		'title'  => esc_html__( 'Fonts', 'theme-majesty' ),
		'fields' => array(
			array(
				'id'     => 'custom-font-info',
				'type'   => 'info',
				'notice' => true,
				'style'  => 'info',
				'title'  => esc_html__( 'Google Fonts used in Theme', 'theme-majesty' ),
				'desc'   => esc_html__( 'Majesty themes used 3 fonts Open Sans, Fjalla One, Courgette so you can easy replace any font used in theme with another font.', 'theme-majesty' ),
			),
			array(
				'id'     => 'custom-font-info-weight',
				'type'   => 'info',
				'notice' => true,
				'style'  => 'info',
				'title'  => esc_html__( 'Font Weight', 'theme-majesty' ),
				'desc'   => esc_html__( 'Open Sans: 300,400,600.', 'theme-majesty' ),
			),
			array(
				'id'     => 'custom-font-success',
				'type'   => 'info',
				'notice' => true,
				'style'  => 'critical',
				'title'  => esc_html__( 'Add new google fonts.', 'theme-majesty' ),
				'desc'   => esc_html__( 'EX: theme use open sans font with different weight like 300, 400,300,600 <br /> So when you choose to replace this font with anothere you need to add more weight but theme options have one dropdown menu to select only one weight so there is another field called Add additional style so you can add more weight.', 'theme-majesty' ),
			),
			array(
				'id'     => 'custom-font-weight',
				'type'   => 'info',
				'notice' => true,
				'style'  => 'success',
				'title'  => esc_html__( 'Why i need to add font weight.', 'theme-majesty' ),
				'desc'   => esc_html__( 'Theme appearance be good.', 'theme-majesty' ),
			),
			array(
				'id'     => 'custom-font-weight-lineheight',
				'type'   => 'info',
				'notice' => true,
				'style'  => 'critical',
				'title'  => esc_html__( 'Font weight and line height.', 'theme-majesty' ),
				'desc'   => esc_html__( 'This fields for preview only.', 'theme-majesty' ),
			),
			array(
				'id'       => 'enable_custom_fonts',
				'type'     => 'switch',
				'title'    => esc_html__( 'Custom Fonts', 'theme-majesty' ),
				'default'  => false,
				'on'	   => 'Enabled',
				'off'	   => 'Disabled',
			),
			array(
				'id'       => 'enable-font-opensans',
				'type'     => 'switch',
				'title'    => esc_html__( 'Font 1', 'theme-majesty' ),
				'subtitle'    => esc_html__( 'By default Open Sans', 'theme-majesty' ),
				'desc'    => esc_html__('usingt for body and h5 and some html elments.', 'theme-majesty'),
				'default'  => false,
				'on'	   => 'Enabled',
				'off'	   => 'Disabled',
				'required' => array('enable_custom_fonts','=',true),
			),
			array(
				'id'          => 'font-opensans',
				'type'        => 'typography', 
				'title'       => esc_html__('Font 1', 'theme-majesty'),
				'google'      => true, 
				'font-backup' => true,
				'color'         => false,
				'font-style'    => true,
				'subsets'       => true,
				'font-size'     => true, // for preview only
				'line-height'   => true, // for preview only
				'preview'       => true,
				'text-align'	=> false,				
				'units'       =>'px',
				'all_styles'  => true,
				'default'     => array(
					'font-style'  => '600',
					'font-family' => 'Open Sans',
					'google'      => true,
					'font-size'   => '33px',
					'line-height' => '40px',
					'font-backup'	=> true,
				),
				'required' => array('enable-font-opensans','=',true),
			),
			array(
				'id'       => 'font-opensans-style',
				'type'     => 'text',
				'title'    => esc_html__( 'Font 1 Add additional style', 'theme-majesty' ),
				'desc'	   => esc_html__( '[Optional] EX: 700,900,400italic,700italic,900italic', 'theme-majesty' ),
				'required' => array('enable-font-opensans','=',true),
			),
			array(
				'id'       => 'font-opensans-subsets',
				'type'     => 'text',
				'title'    => esc_html__( 'Font 1 Add additional Font Subsets', 'theme-majesty' ),
				'desc'	   => esc_html__( '[Optional] EX: latin,greek-ext,greek', 'theme-majesty' ),
				'required' => array('enable-font-opensans','=',true),
			),
			// Fjalla One   oswald
			array(
				'id'       => 'enable-font-fjallaone',
				'type'     => 'switch',
				'title'    => esc_html__( 'Font 2', 'theme-majesty' ),
				'subtitle'    => esc_html__( 'By default Fjalla One', 'theme-majesty' ),
				'desc'    => esc_html__('using for heading h1, h2, and some html elments.', 'theme-majesty'),
				'default'  => false,
				'on'	   => 'Enabled',
				'off'	   => 'Disabled',
				'required' => array('enable_custom_fonts','equals',true),
			),
			array(
				'id'          => 'font-fjallaone',
				'type'        => 'typography', 
				'title'       => esc_html__('Typography', 'theme-majesty'),
				'google'      => true, 
				'font-backup' => true,
				'color'         => false,
				'font-style'    => true,
				'subsets'       => true,
				'font-size'     => true, // for preview only
				'line-height'   => true, // for preview only
				'preview'       => true,
				'text-align'	=> false,				
				'units'       =>'px',
				'all_styles'  => true,
				'default'     => array(
					'font-style'  => '700',
					'font-family' => 'Fjalla One',
					'google'      => true,
					'font-size'   => '33px',
					'line-height' => '40px',
					'font-backup'	=> true,
				),
				'required' => array('enable-font-fjallaone','equals',true),
			),
			array(
				'id'       => 'font-fjallaone-style',
				'type'     => 'text',
				'title'    => esc_html__( 'Font 2 Add additional style', 'theme-majesty' ),
				'desc'	   => esc_html__( '[Optional] EX: 700,900,400italic,700italic,900italic', 'theme-majesty' ),
				'required' => array('enable-font-fjallaone','equals',true),
			),
			array(
				'id'       => 'font-fjallaone-subsets',
				'type'     => 'text',
				'title'    => esc_html__( 'Font 2 Add additional Font Subsets', 'theme-majesty' ),
				'desc'	   => esc_html__( '[Optional] EX: latin,greek-ext,greek', 'theme-majesty' ),
				'required' => array('enable-font-fjallaone','equals',true),
			),
			
			// Courgette courgette opensans-condensed
			array(
				'id'       => 'enable-font-courgette',
				'type'     => 'switch',
				'title'    => esc_html__( 'Font 3', 'theme-majesty' ),
				'subtitle'    => esc_html__( 'By default courgette', 'theme-majesty' ),
				'desc'    => esc_html__('Slogans and others.', 'theme-majesty'),
				'default'  => false,
				'on'	   => 'Enabled',
				'off'	   => 'Disabled',
				'required' => array('enable_custom_fonts','=',true),
			),
			array(
				'id'          => 'font-courgette',
				'type'        => 'typography', 
				'title'       => esc_html__('Typography', 'theme-majesty'),
				'google'      => true, 
				'font-backup' => true,
				'color'         => false,
				'font-style'    => true,
				'subsets'       => true,
				'font-size'     => true, // for preview only
				'line-height'   => true, // for preview only
				'preview'       => true,
				'text-align'	=> false,				
				'units'       =>'px',
				'all_styles'  => true,
				'desc'    => esc_html__('By default majesty theme using Courgette font for Slogans and others.', 'theme-majesty'),
				'default'     => array(
					'font-style'  => '700',
					'font-family' => 'Courgette',
					'google'      => true,
					'font-size'   => '33px',
					'line-height' => '40px',
					'font-backup'	=> true,
				),
				'required' => array('enable-font-courgette','=',true),
			),
			array(
				'id'       => 'font-courgette-style',
				'type'     => 'text',
				'title'    => esc_html__( 'Font 3 Add additional style', 'theme-majesty' ),
				'desc'	   => esc_html__( '[Optional] EX: 700,900,400italic,700italic,900italic', 'theme-majesty' ),
				'required' => array('enable-font-courgette','=',true),
			),
			array(
				'id'       => 'font-courgette-subsets',
				'type'     => 'text',
				'title'    => esc_html__( 'Font 3 Add additional Font Subsets', 'theme-majesty' ),
				'desc'	   => esc_html__( '[Optional] EX: latin,greek-ext,greek', 'theme-majesty' ),
				'required' => array('enable-font-courgette','=',true),
			),
		)
	));
	
	Redux::setSection( $opt_name, array(
		'icon'   => 'el-icon-fontsize',
		'subsection' => true,
		'title'  => esc_html__( 'Typography', 'theme-majesty' ),
		'fields' => array(
			array(
				'id'       => 'enable_typography',
				'type'     => 'switch',
				'title'    => esc_html__( 'Font Size', 'theme-majesty' ),
				'default'  => false,
				'on'	   => 'Enabled',
				'off'	   => 'Disabled',
			),
			array(
				'id'     => 'custom-font-info',
				'type'   => 'info',
				'notice' => true,
				'style'  => 'info',
				'title'  => esc_html__( 'Font Size', 'theme-majesty' ),
				'desc'   => esc_html__( 'Field For font Size using PX, For line height using VALUE Ex line-height: 1.8;', 'theme-majesty' ),
				'required' => array('enable_typography','=',true),
			),
			array(
				'id'            => 'body_font_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'Body Font Size', 'theme-majesty' ),
				'default'       => 14,
				'min'           => 8,
				'step'          => 1,
				'max'           => 60,
				'display_value' => 'label',
				'required' => array('enable_typography','=',true),
			),
			array(
				'id'            => 'body_line_height',
				'type'          => 'slider',
				'title'         => esc_html__( 'Body Line Height', 'theme-majesty' ),
				'default'       => 1.5,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'par_font_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'paragraph Font Size', 'theme-majesty' ),
				'desc'          => esc_html__( 'For every paragraph not inside in post, product, team member post', 'theme-majesty' ),
				'default'       => 15,
				'min'           => 8,
				'step'          => 1,
				'max'           => 60,
				'display_value' => 'label',
				'required' => array('enable_typography','=',true),
			),
			array(
				'id'            => 'par_line_height',
				'type'          => 'slider',
				'title'         => esc_html__( 'paragraph Line Height', 'theme-majesty' ),
				'default'       => 2,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'post_font_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'Post paragraph Font Size', 'theme-majesty' ),
				'subtitle'      => esc_html__( 'For Single Post', 'theme-majesty' ),
				'default'       => 14,
				'min'           => 8,
				'step'          => 1,
				'max'           => 60,
				'display_value' => 'label',
				'required' => array('enable_typography','=',true),
			),
			array(
				'id'            => 'post_line_height',
				'type'          => 'slider',
				'title'         => esc_html__( 'Post paragraph Line Height', 'theme-majesty' ),
				'subtitle'      => esc_html__( 'For Single Post, page', 'theme-majesty' ),
				'default'       => 1.8,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'member_font_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'Team paragraph Font Size', 'theme-majesty' ),
				'subtitle'      => esc_html__( 'For Team memeber Post', 'theme-majesty' ),
				'default'       => 15,
				'min'           => 8,
				'step'          => 1,
				'max'           => 60,
				'display_value' => 'label',
				'required' => array('enable_typography','=',true),
			),
			array(
				'id'            => 'member_line_height',
				'type'          => 'slider',
				'title'         => esc_html__( 'Team paragraph Line Height', 'theme-majesty' ),
				'subtitle'      => esc_html__( 'For Team memeber Post', 'theme-majesty' ),
				'default'       => 2,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'product_font_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'Product paragraph Font Size', 'theme-majesty' ),
				'subtitle'      => esc_html__( 'For single product', 'theme-majesty' ),
				'desc'          => esc_html__( 'This Paragraph display under title for product in single product.', 'theme-majesty' ),
				'default'       => 14,
				'min'           => 8,
				'step'          => 1,
				'max'           => 60,
				'display_value' => 'label',
				'required' => array('enable_typography','=',true),
			),
			array(
				'id'            => 'product_line_height',
				'type'          => 'slider',
				'title'         => esc_html__( 'Product paragraph Line Height', 'theme-majesty' ),
				'subtitle'      => esc_html__( 'For single product', 'theme-majesty' ),
				'default'       => 1.8,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'custom_head_f_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'Custom Heading', 'theme-majesty' ),
				'desc'          => esc_html__( 'This heading used in visual composer element add custom heading or shortcode.', 'theme-majesty' ),
				'default'       => 48,
				'min'           => 8,
				'step'          => 1,
				'max'           => 80,
				'display_value' => 'label',
				'required' => array('enable_typography','=',true),
			),
			array(
				'id'            => 'custom_head_f_height',
				'type'          => 'slider',
				'title'         => esc_html__( 'Custom Heading Line Height', 'theme-majesty' ),
				'default'       => 1.1,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			
			array(
				'id'            => 'title_head_f_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'Post Title', 'theme-majesty' ),
				'desc'          => esc_html__( 'This title display in single post, product , team memeber.', 'theme-majesty' ),
				'default'       => 30,
				'min'           => 8,
				'step'          => 1,
				'max'           => 80,
				'display_value' => 'label',
				'required' => array('enable_typography','=',true),
			),
			array(
				'id'            => 'title_head_f_height',
				'type'          => 'slider',
				'title'         => esc_html__( 'Custom Heading Line Height', 'theme-majesty' ),
				'default'       => 1.1,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			
			array(
				'id'            => 'h_1_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header H1 Font Size', 'theme-majesty' ),
				'default'       => 48,
				'min'           => 8,
				'step'          => 1,
				'max'           => 80,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'h_1_lineheight',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header H1 Line Height', 'theme-majesty' ),
				'default'       => 1.1,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'h_2_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header H2 Font Size', 'theme-majesty' ),
				'default'       => 30,
				'min'           => 8,
				'step'          => 1,
				'max'           => 80,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'h_2_lineheight',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header H2', 'theme-majesty' ),
				'default'       => 1.1,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'h_3_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header H3 Font Size', 'theme-majesty' ),
				'default'       => 24,
				'min'           => 8,
				'step'          => 1,
				'max'           => 80,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'h_3_lineheight',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header H3 Line Height', 'theme-majesty' ),
				'default'       => 1.1,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'h_4_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header H4 Font Size', 'theme-majesty' ),
				'default'       => 18,
				'min'           => 8,
				'step'          => 1,
				'max'           => 80,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'h_4_lineheight',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header H4', 'theme-majesty' ),
				'default'       => 1.1,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'h_5_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header H5 Font Size', 'theme-majesty' ),
				'default'       => 14,
				'min'           => 8,
				'step'          => 1,
				'max'           => 80,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'h_5_lineheight',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header H5', 'theme-majesty' ),
				'default'       => 1.1,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'h_6_size',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header H6 Font Size', 'theme-majesty' ),
				'default'       => 12,
				'min'           => 8,
				'step'          => 1,
				'max'           => 80,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
			array(
				'id'            => 'h_6_lineheight',
				'type'          => 'slider',
				'title'         => esc_html__( 'Header H6', 'theme-majesty' ),
				'default'       => 1.1,
				'min'           => 0.1,
				'step'          => 0.1,
				'max'           => 5,
				'resolution'    => 0.1,
				'display_value' => 'label',
				'required' => array('enable_typography','equals',true),
			),
		)
	));
	
	Redux::setSection( $opt_name, array(
		'icon'   => 'el-icon-css',
		'title'  => esc_html__( 'Custom CSS', 'theme-majesty' ),
		'fields' => array(
			array(
				'id'     => 'custom-css-code',
				'type'   => 'info',
				'notice' => true,
				'style'  => 'critical',
				'title'  => esc_html__( 'Add CSS CODE.', 'theme-majesty' ),
				'desc'   => wp_kses_post(__( 'Please to add you css code using this theme or child theme you need to <strong>create</strong> file name <strong>theme-custom-css.css</strong> inside <strong>css</strong> folder. you need to create this file because if i create it you lose this file in any update so i don\'t include it.', 'theme-majesty' )),
			),
			array(
				'id'       => 'enable_custom_css',
				'type'     => 'switch',
				'title'    => esc_html__( 'Enable Css Code', 'theme-majesty' ),
				'default'  => false,
				'on'	   => 'Enabled',
				'off'	   => 'Disabled',
			),
		)
	));

	Redux::setSection( $opt_name, array(
		'icon'   			=> 'el-icon-th',
        'title'            => esc_html__( 'Advanced jQuery', 'theme-majesty' ),
        'id'               => 'majesty-advanced-jquery-options',
        'fields'           => array(
			array(
                'id'   => 'advanced-jquery-options-info',
                'type' => 'info',
                'desc' => esc_html__('Her you can to enable or disabled some jquery from loading by default.', 'theme-majesty')
            ),
			array(
				'id'       => 'owl-carousel-pages',
				'type'     => 'select',
				'data'     => 'pages',
				'multi'    => true,
				'title'    => esc_html__( 'OWL Carousel Jquery', 'theme-majesty' ),
				'desc'     => esc_html__( 'Select pages to load OWL carousel jQuery if you used this slider in post meta ex: home style 2 in demo used owl carousel inside top slider as html for visual composer and shortoce its load by default.', 'theme-majesty' ),
			),
			array(
				'id'       => 'countdow-pages',
				'type'     => 'select',
				'data'     => 'pages',
				'multi'    => true,
				'title'    => esc_html__( 'Countdown Jquery', 'theme-majesty' ),
				'desc'     => esc_html__( 'Select pages to load Countdown jQuery if you used countdown timer in post meta ex: all coming soon pages in demo.', 'theme-majesty' ),
			),
			
			array(
				'id'       => 'prettyphoto-pages',
				'type'     => 'select',
				'data'     => 'pages',
				'multi'    => true,
				'title'    => esc_html__( 'prettyphoto Jquery', 'theme-majesty' ),
				'desc'     => esc_html__( 'Select pages to load prettyphoto jQuery if you used it as html, for visual composer and shortcode its load by default you don\'t assign pages for this.', 'theme-majesty' ),
			),
			array(
				'id'     => 'contactform7',
				'type'   => 'info',
				'notice' => true,
				'style'  => 'critical',
				'title'  => esc_html__( 'Contact Form 7.', 'theme-majesty' ),
				'desc'   => esc_html__( 'By Default Contact Form 7 jQuery and Css load in all pages, but if you need to load it in some pages select it this is good to load only css & js files when you need it.', 'theme-majesty' ),
			),
			array(
				'id'       => 'contactform7-pages',
				'type'     => 'select',
				'data'     => 'pages',
				'multi'    => true,
				'title'    => esc_html__( 'Contact Form 7 Pages', 'theme-majesty' ),
				'desc'     => esc_html__( 'Select pages to load CSS & JS For this plugin if you not select any pages jQuery and CSS for this plugin load in all pages.', 'theme-majesty' ),
			),
        )
    ));
	
	
	function sama_removeDemoModeLink() { // Be sure to rename this function to something more unique
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
		}
		if ( class_exists('ReduxFrameworkPlugin') ) {
			remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
		}
	}
	add_action('init', 'sama_removeDemoModeLink');
 