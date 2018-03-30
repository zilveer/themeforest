<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     **/

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }	
	
    // This is your option name where all the Redux data is stored.
    $opt_name = "experience_theme_settings";
	
	
	/**
     * --> SET ACTION HOOKS
     **/
	
	function removeDemoModeLink() { // Be sure to rename this function to something more unique
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
		}
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
		}
	}
	add_action( 'init', 'removeDemoModeLink' );

	/**
     * ---> END ACTION HOOKS
     **/
	 
	
	/**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     **/
	
	$theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,			        		// This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),       		 	// Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),     		// Version that appears at the top of your panel
        'menu_type'            => 'menu',					    		//Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,							        // Show the sections below the admin menu item or not
        'menu_title' 	       => esc_html__( "Theme Options", 'experience' ),
        'page_title'    	   => esc_html__( "Theme Options", 'experience' ),
        
		// You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'	   => '',							        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,					      		// Must be defined to add google fonts to the typography module
        'async_typography'     => true,							        // Use a asynchronous font on the front end or font string
        'disable_google_fonts_link' => false,							// Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,							        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',		        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,							        // Choose an priority for the admin bar menu
        'global_variable'      => '',							        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,						        // Show the time the page took to load, etc
        'update_notice'        => false,						        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,							        // Enable basic customizer support
        'open_expanded'	 	   => false,                   				// Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                  			    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,							        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',					        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',				        // Permissions needed to access the options panel.
        'menu_icon'            => '',							        // Specify a custom URL to an icon
        'last_tab'             => '',							        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',				        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => 'experience-options',			        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,							        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,						        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',							        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,							        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        "output"               => true,							        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,							        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   				// Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',								    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'system_info'          => false,						        // REMOVE
        'compiler'             => true,
		
		// HINTS
        'hints'                => array(
            "icon"          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'light',
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
	
	
    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    /* None */
	
	
	// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
	/* None */
	
	
	// Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = '';
    } else {
        $args['intro_text'] = '';
    }

    // Add content after the form.
    $args['footer_text'] = '';

    Redux::setArgs( $opt_name, $args );
	
	
	/**
     * ---> END ARGUMENTS
     **/
	
	
	/**
     * ---> START SECTIONS
     **/
	
	// ---------- GENERAL	---------- //
	Redux::setSection( $opt_name, array(
        "title" 	=> esc_html__( "General", 'experience' ),
        "id"    	=> "section-general",
        "desc"  	=> "",
        "icon"  	=> "el el-cogs",
		"fields"	=> array(
			
			// Site Image Logo
			array(
				"id"        => "logo-header",
				"title"     => esc_html__( "Site Image Logo", 'experience' ),
				"desc"  	=> esc_html__( "A custom site logo image to be shown in the header.", 'experience' ),
				"type"      => "media",
			),
			
			// Site Text Logo
			array(
				"id"        => "logo-text",
				"title"     => esc_html__( "Site Text Logo", 'experience' ),
				"desc"		=> esc_html__( "Enter the site title as it should appear in the header. If left blank the site title set on the Settings > General screen will be used.", 'experience' ),
				"type"      => "text",
				"required"	=> array( "logo-header", "=", false )
			),
		
			// Custom CSS (Desktop & Mobile)
			array(
				"id"        => "custom-css",
				"title"     => esc_html__( "Desktop & Mobile", 'experience' ),
				"desc"		=> esc_html__( "Custom CSS to be applied to all layouts.", 'experience' ),
				"type"      => "ace_editor",
				'mode'		=> 'css',
				'theme'    	=> 'chrome'
			),
			
			// Custom CSS (Desktop)
			array(
				"id"        => "custom-css-desktop",
				"title"     => esc_html__( "Desktop Only", 'experience' ),
				"desc"		=> esc_html__( "Custom CSS to be applied to desktop layouts.", 'experience' ),
				"type"      => "ace_editor",
				'mode'		=> 'css',
				'theme'    	=> 'chrome'
			),
			
			// Custom CSS (Mobile)
			array(
				"id"        => "custom-css-mobile",
				"title"     => esc_html__( "Mobile Only", 'experience' ),
				"desc"		=> esc_html__( "Custom CSS to be applied to mobile layouts.", 'experience' ),
				"type"      => "ace_editor",
				'mode'		=> 'css',
				'theme'    	=> 'chrome'
			)
			
		)
	
	));
		
	// ---------- STYLE	---------- //
	Redux::setSection( $opt_name, array(
        "title" 	=> esc_html__( "Style", 'experience' ),
        "id"    	=> "section-style",
        "desc"  	=> "",
        "icon"  	=> "el el-tint",
		"fields"	=> array(
		
		)
		
    ) );
		
		// ----- PRESETS ----- //
		
		require_once( get_template_directory() .'/inc/redux-framework/presets/nature.php' );
		require_once( get_template_directory() .'/inc/redux-framework/presets/earth.php' );
		require_once( get_template_directory() .'/inc/redux-framework/presets/funky.php' );
		require_once( get_template_directory() .'/inc/redux-framework/presets/athletic.php' );
		require_once( get_template_directory() .'/inc/redux-framework/presets/adventure.php' );
		require_once( get_template_directory() .'/inc/redux-framework/presets/cloud.php' );
		require_once( get_template_directory() .'/inc/redux-framework/presets/blanc.php' );
		require_once( get_template_directory() .'/inc/redux-framework/presets/mocha.php' );
		
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Presets", 'experience' ),
			"id"         => "style-presets",
			"subsection" => true,
			"fields"     => array(
			
				// Presets					
				array(
					"id"		=> "color-scheme-presets",
					"type"     	=> "image_select",
					"title"    	=> esc_html__( "Colour Presets", 'experience') ,
					"subtitle"  => esc_html__( "Select a colour preset to quickly style your site. Selecting a colour presets will overwrite your existing site colour settings and cannot be undone. ", 'experience' ),
					"presets"  	=> true,
					"default"  	=> 0,
					"options"  	=> array(
						$nature,			
						$earth,
						$funky,
						$athletic,
						$adventure,
						$cloud,
						$blanc,
						$mocha
					)
				
				)
				
			)
			
		) );
		
		// ----- PRELOADER ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Preloader", 'experience' ),
			"id"         => "style-preloader",
			"subsection" => true,
			"desc"       => esc_html__( "Use the options below to style the page preloader.", 'experience' ),
			"fields"     => array(
				
				// Preloader Background
				array(
					"id"        => "preloader-bg-color",
					"title"     => esc_html__( "Preloader Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of the preloader background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"background-color"	=> "body, #page-preloader"
					)
				),
				
				// Preloader
				array(
					"id"        => "preloader-color",
					"title"     => esc_html__( "Preloader Animation", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of the preloader animation.", 'experience' ),
					"type"      => "color",
					"default"	=> "#0cb4ce",
					"compiler"	=> array(
						"background-color"	=> ".loader-inner",
						"border-color"		=> ".loader"
					)
				)
				
			)
		) );
		
		
		// ----- LIGHTBOX ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Lightbox", 'experience' ),
			"id"         => "style-lightbox",
			"subsection" => true,
			"desc"       => esc_html__( "Use the options below to style the lightbox gallery.", 'experience' ),
			"fields"     => array(
			
				// Lightbox Background
				array(
					"id"        => "lightbox-background-color",
					"title"     => esc_html__( "Lightbox Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour for the lightbox.", 'experience' ),
					"type"      => "color",
					"default"	=> "#f7f7f7",
					"compiler"	=> array(
						"background-color"	=> "body .fancybox-overlay, .fancybox-overlay .mejs-mediaelement"
					)
				),
				
				
				// Lightbox Arrow
				array(
					"id"        => "lightbox-arrow-color",
					"title"     => esc_html__( "Lightbox Arrow", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for the lightbox arrow icons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#0cb4ce",
					"compiler"	=> array(
						"color" => ".fancybox-overlay .fancybox-prev, .fancybox-overlay .fancybox-next"
					)
				),
				
				// Media Player Time Bar
				array(
					"id"        => "media-player-time-bar",
					"title"     => esc_html__( "Media Player Time Bar", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for the filled section of the media player time bar.", 'experience' ),
					"type"      => "color",
					"default"	=> "#0cb4ce",
					"compiler"	=> array(
						"background-color" => ".mejs-inner .mejs-controls .mejs-time-rail .mejs-time-current, .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current"
					)
				),
				
			
			)
		) );
		
		
		// ----- NAVIGATION ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Navigation", 'experience' ),
			"id"         => "style-navigation",
			"subsection" => true,
			"desc"       => esc_html__( "Use the options below to style the page navigation bar.", 'experience' ),
			"fields"     => array(				
				
				// Header Width
				array(
					"id"        => "nav-width",
					"title"     => esc_html__( "Navigation Bar Width", 'experience' ),
					"desc"		=> esc_html__( "Select navigation bar content width.", 'experience' ),
					"type"      => "select",                					
					"options"  	=> array(
						"narrow-width" 	=> esc_html__( "Narrow", 'experience' ),
						"site-width" 	=> esc_html__( "Boxed", 'experience' ),
						"fluid-width"	=> esc_html__( "Full Width", 'experience' )
					)
				),
		
				// Navigation Bar Background Color
				array(
					"id"				        => "nav-bg-color",
					"title"     				=> esc_html__( "Navigation Background", 'experience' ),
					"desc"						=> esc_html__( "Select the navigation bar background colour.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#141618",
						"alpha"     => "1",
						"rgba" 		=> "rgba(20,22,24,1)"
					),
					"compiler"					=> array(
						"background-color" => ".site-header:after"
					)
				),
				
				// Navigation Text
				array(
					"id"        => "nav-text-color",
					"title"     => esc_html__( "Navigation Text", 'experience' ),
					"desc"		=> esc_html__( "Select the navigation bar text and icon colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"background-color"	=> ".menu-icon .line, .header-nav-wrapper ul > li::before",
						"color"				=> ".logo, .header-nav"
					)
				),
				
				// Navigation Text Hover
				array(
					"id"        => "nav-text-hover-color",
					"title"     => esc_html__( "Navigation Text Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the navigation text and icon hover state colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#777777",
					"compiler"	=> array(
						"background-color"	=> ".unscrolled .menu-icon:hover .line, .menu-icon:hover .line",
						"color"				=> "a.logo:hover, .header-nav > li > span:hover, .unscrolled a.logo:hover, .unscrolled .header-nav > li > span:hover"
					)
				),
				
				// Navigation Search			
				array(
					"id"        => "panel-search",
					"title"     => esc_html__( "Navigation Search", 'experience' ),
					"desc"		=> esc_html__( "Enable to display the search button in the site header.", 'experience' ),
					"type"      => "switch",
					"default"	=> true
				)
				
			)
		) );
		
		
		// ----- PANEL ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Panel", 'experience' ),
			"id"         => "style-panel",
			"subsection" => true,
			"desc"       => esc_html__( "Use the options below to style the pop-up navigation panel.", 'experience' ),
			"fields"     => array(
				
				// Navigation Panel Background Color
				array(
					"id"		=>	"panel-bg-color",
					"title"		=> esc_html__( "Navigation Panel Background", 'experience' ),
					"desc"		=> esc_html__( "Set the navigation panel background colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color" => ".panel-nav"
					)
				),

				// Navigation Panel Link
				array(
					"id"        => "panel-link-color",
					"title"     => esc_html__( "Navigation Panel Link", 'experience' ),
					"desc"		=> esc_html__( "Select the navigation panel item colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color"			=> ".panel-nav .menu a, .panel-nav .searchform .s, .panel-nav .searchsubmit, .panel-nav .searchsubmit:hover, .panel-nav .social-button, .panel-nav .social-button:hover, .panel-nav .funky-icon-close, .panel-nav .panel-toggle-icons",
						"background-color" => ".panel-toggle-icons .menu-icon .line, .panel-toggle-icons .menu-icon:hover .line"
					)
				),
				
				// Navigation Panel Link Hover
				array(
					"id"        => "panel-link-hover-color",
					"title"     => esc_html__( "Navigation Panel Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the navigation panel item hover state colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"color" => ".panel-nav .menu a:hover"
					)
				),
				
				// Navigation Panel Link Hover Background
				array(
					"id"        => "panel-link-bg-hover-color",
					"title"     => esc_html__( "Navigation Panel Link Hover Background", 'experience' ),
					"desc"		=> esc_html__( "Select the navigation panel item hover state background colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"background-color" => ".panel-nav .menu a:hover"
					)
				),				
				
				// Navigation Panel Submenu Background
				array(
					"id"        => "panel-submenu-bg-color",
					"title"     => esc_html__( "Navigation Panel Submenu Background", 'experience' ),
					"desc"		=> esc_html__( "Select the navigation panel sub menu background colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"background-color" => ".panel-nav:after, .panel-nav:before"
					)
				),		
				
				// Navigation Panel Submenu Link
				array(
					"id"        => "panel-submenu-link-color",
					"title"     => esc_html__( "Navigation Panel Submenu Link", 'experience' ),
					"desc"		=> esc_html__( "Select the navigation panel sub menu item colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"color" => ".panel-nav .sub-menu a, .panel-nav .sub-menu .back, .panel-nav.active-submenu .funky-icon-close"
					)
				),
				
				// Navigation Panel Submenu Link Hover
				array(
					"id"        => "panel-submenu-link-hover-color",
					"title"     => esc_html__( "Navigation Panel Submenu Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the navigation panel sub menu item hover state colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".panel-nav .sub-menu a:hover, .panel-nav .sub-menu .back:hover"
					)
				),
				
				// Navigation Panel Submenu Hover Background
				array(
					"id"        => "panel-submenu-link-bg-hover-color",
					"title"     => esc_html__( "Navigation Panel Submenu Hover Background", 'experience' ),
					"desc"		=> esc_html__( "Select the navigation panel sub menu item hover state background colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color" => ".panel-nav .sub-menu a:hover, .panel-nav .sub-menu .back:hover"
					)
				)				
				
			)
		) );
		
		
		// ----- PAGE SECTIONS PAGINATION ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Section Scroll Buttons", 'experience' ),
			"id"         => "style-pagination",
			"subsection" => true,
			"desc"       => esc_html__( "Use the options below to style the page section scroll buttons.", 'experience' ),
			"fields"     => array(
				
				// Section Scroll Button Border
				array(
					"id"        => "pagination-border-color",
					"title"     => esc_html__( "Section Scroll Button Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of the page section scroll buttons border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#09879b",
						"alpha"     => "1",
						"rgba" 		=> "rgba(9,135,155,1)"
					),
					"compiler"	=> array(
						"border-color"		=> ".section-pagination a",
						"background-color"	=> ".section-pagination li:before"					
					)
				),
				
				// Section Scroll Button Fill
				array(
					"id"        => "pagination-fill-color",
					"title"     => esc_html__( "Section Scroll Button Fill", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of the page section scroll buttons fill.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".section-pagination a:after"
					)
				),
				
				// Section Scroll Button Text
				array(
					"id"        => "pagination-text-color",
					"title"     => esc_html__( "Section Scroll Button Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of the page section scroll buttons text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"color"				=> ".section-pagination span"
					)
				)
				
			)
		) );
		
		
		// ----- COLOUR SCHEME 1 ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Colour Scheme 1", 'experience' ),
			"id"         => "style-color-1",
			"subsection" => true,
			"desc"       => esc_html__( "Colour schemes can be applied to page headers, page sections, visual composer sections and columns.", 'experience' ),
			"fields"     => array(			
				
				// Colour Scheme 1 Label
				array(
					"id"        => "scheme-1-label",
					"title"     => esc_html__( "Colour Scheme 1 Label", 'experience' ),
					"desc"		=> esc_html__( "Make this colour scheme easier to identify with a descriptive label.", 'experience' ),
					"type"      => "text"
				),
				
				// Accent
				array(
					"id"        => "scheme-1-accent-color",
					"title"     => esc_html__( "Accent", 'experience' ),
					"desc"		=> esc_html__( "Select the accent colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#0cb4ce",
					"compiler"	=>	array(
						"background-color"	=> ".heading-label:after, .boxed_content h1:after, .boxed_content h2:after, .boxed_content h3:after, .boxed_content h4:after, .boxed_content h5:after, .boxed_content h6:after",
						"border-color"		=> "blockquote",
						"color"				=> ".flexslider-small .slide-subtitle"
					)
				),
				
				// Background
				array(
					"id"        => "scheme-1-background-color",
					"title"     => esc_html__( "Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for the content area background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"background-color"	=> ".section-wrapper > .section-header, .section-wrapper > .section-content-wrapper, .post-content > .vc_row"
					)
				),
				
				// Page Label
				array(
					"id"        => "scheme-1-page-label-color",
					"title"     => esc_html__( "Label", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page labels (appears above page titles).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#303133",
						"alpha"     => "1",
						"rgba" 		=> "rgba(48,49,51,1)"
					),
					"compiler"	=>	array(
						"color" => ".heading-label"
					)
				),
				
				// Page Title
				array(
					"id"        => "scheme-1-page-title-color",
					"title"     => esc_html__( "Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page titles.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".heading-title, .flexslider-small p, .post-grid-item-content h1, .post-grid-item-content h2, .post-grid-item-content h3"
					)
				),
				
				// Page Intro
				array(
					"id"        => "scheme-1-page-subtitle-color",
					"title"     => esc_html__( "Subtitle", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page subtitles.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#a4a4a4",
						"alpha"     => "1",
						"rgba" 		=> "rgba(164,164,164,1)"
					),
					"compiler"	=> array(
						"color" => ".heading-subtitle, .post-meta, .post-meta a, .post-meta a:hover"
					)
				),			

				// h1
				array(
					"id"        => "scheme-1-h1-color",
					"title"     => esc_html__( "Header 1", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H1 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=>	array(
						"color" => "h1"
					)
				),
				
				// h2
				array(
					"id"        => "scheme-1-h2-color",
					"title"     => esc_html__( "Header 2", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H2 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=>	array(
						"color" => "h2"
					)
				),
				
				// h3
				array(
					"id"        => "scheme-1-h3-color",
					"title"     => esc_html__( "Header 3", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H3 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=>	array(
						"color" => "h3"
					)
				),
				
				// h4
				array(
					"id"        => "scheme-1-h4-color",
					"title"     => esc_html__( "Header 4", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H4 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=>	array(
						"color" => "h4"
					)
				),
				
				// h5
				array(
					"id"        => "scheme-1-h5-color",
					"title"     => esc_html__( "Header 5", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H5 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=>	array(
						"color" => "h5, .wpb_accordion_header a, .vc_toggle_title a"
					)
				),
				
				// h6
				array(
					"id"        => "scheme-1-h6-color",
					"title"     => esc_html__( "Header 6", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H6 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=>	array(
						"color" => "h6"
					)
				),					
				
				// Text
				array(
					"id"        => "scheme-1-text-color",
					"title"     => esc_html__( "Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for body text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#a4a4a4",
						"alpha"     => "1",
						"rgba" 		=> "rgba(164,164,164,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-1, .section-header, .section-content-wrapper, label"
					)
				),					
				
				// Subtext
				array(
					"id"        => "scheme-1-subtext-color",
					"title"     => esc_html__( "Subtext", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for subtext (cite, captions etc).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#a4a4a4",
						"alpha"     => "1",
						"rgba" 		=> "rgba(164,164,164,1)"
					),
					"compiler"	=> array(
						"color" => ".wp-caption .wp-caption-text, blockquote cite, .comment-date a, body.search .post-permalink"
					)
				),
				
				// Link
				array(
					"id"        => "scheme-1-link-color",
					"title"     => esc_html__( "Link", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#0cb4ce",
					"compiler"	=> array(
						"color" => "a"
					)
				),
				
				// Link Hover
				array(
					"id"        => "scheme-1-link-hover-color",
					"title"     => esc_html__( "Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text hover state.", 'experience' ),
					"type"      => "color",
					"default"	=> "#a4a4a4",
					"compiler"	=> array(
						"color" => "a:hover, .comment-date a:hover"
					)
				),
				
				// Slider Arrows
				array(
					"id"        => "scheme-1-slider-arrow-color",
					"title"     => esc_html__( "Slider Arrows", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "1",
						"rgba" 		=> "rgba(0,0,0,1)"
					),
					"compiler"	=> array(
						"color" => ".flex-direction-nav a"
					)
				),
				
				// Slider Arrows Border
				array(
					"id"        => "scheme-1-slider-arrow-border-color",
					"title"     => esc_html__( "Slider Arrow Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "0.5",
						"rgba" 		=> "rgba(0,0,0,0.5)"
					),
					"compiler"	=> array(
						"border-color" => ".flex-direction-nav li, .flex-direction-nav li + li"
					)
				),
				
				// Slider Pagination Border
				array(
					"id"        => "scheme-1-slider-pagination-border-color",
					"title"     => esc_html__( "Slider Pagination Border", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button border colour.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#09879b",
						"alpha"     => "1",
						"rgba" 		=> "rgba(9,135,155,1)"
					),
					"compiler"	=>	array(
						"border-color"		=> ".vc_slide.vc_images_carousel .vc_carousel-indicators li, .wp-link-pages .pagination-button, .flexslider-big .flex-control-paging li a",
						"background-color"	=> ".flexslider-big .flex-control-paging li:before, .wp-link-pages .pagination-separator"
					)
				),				
				
				// Slider Pagination Fill
				array(
					"id"        => "scheme-1-slider-pagination-fill-color",
					"title"     => esc_html__( "Slider Pagination Fill", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button fill colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=>	array(
						"background-color"	=> ".vc_slide.vc_images_carousel .vc_carousel-indicators li:hover, .vc_slide.vc_images_carousel .vc_carousel-indicators li.vc_active, .flexslider-big .flex-control-paging li a:after, .wp-link-pages .pagination-button:after"
					)
				),
				
				// Table Header Background
				array(
					"id"        => "scheme-1-table-header-color",
					"title"     => esc_html__( "Table Header Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#F4F4F4",
					"compiler"	=> array(
						"background-color"	=> "th"
					)
				),
				
				// Table Header Text
				array(
					"id"        => "scheme-1-table-header-text-color",
					"title"     => esc_html__( "Table Header Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => "th"
					)
				),
				
				// Table background
				array(
					"id"        => "scheme-1-table-bg-color",
					"title"     => esc_html__( "Table Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#F4F4F4",
					"compiler"	=> array(
						"background-color"	=> "td"
					)
				),
				
				// Table Text
				array(
					"id"        => "scheme-1-table-text-color",
					"title"     => esc_html__( "Table Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#a4a4a4",
					"compiler"	=> array(
						"color" => "table"
					)
				),
				
				// Form fields text
				array(
					"id"        => "scheme-1-input-text-color",
					"title"     => esc_html__( "Input Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of input field text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#a4a4a4",
						"alpha"     => "1",
						"rgba" 		=> "rgba(164,164,164,1)"
					),
					"compiler"	=> array(
						"color" => ".wrapper input, .wrapper input[type='text'], .wrapper input[type='email'], .wrapper input[type='search'], .wrapper input[type='url'], .wrapper input[type='tel'], .wrapper input[type='password'], .wrapper input[type='datetime'], .wrapper input[type='date'], .wrapper input[type='month'], .wrapper input[type='week'], .wrapper input[type='time'], .wrapper input[type='datetime-local'], .wrapper input[type='number'], .wrapper textarea, .wrapper select"
					)
				),
				
				// Form fields border
				array(
					"id"        => "scheme-1-input-border-color",
					"title"     => esc_html__( "Input Field Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(0,0,0,0.2)"
					),
					"compiler"	=> array(
						"border-color" => ".wrapper input, .wrapper input[type='text'], .wrapper input[type='email'], .wrapper input[type='search'], .wrapper input[type='url'], .wrapper input[type='tel'], .wrapper input[type='password'], .wrapper input[type='datetime'], .wrapper input[type='date'], .wrapper input[type='month'], .wrapper input[type='week'], .wrapper input[type='time'], .wrapper input[type='datetime-local'], .wrapper input[type='number'], .wrapper textarea, .wrapper select"
					)
				),
				
				// Form fields focused border
				array(
					"id"        => "scheme-1-input-border-focused-color",
					"title"     => esc_html__( "Input Field Border Focused", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders when focused.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#0cb4ce",
						"alpha"     => "1",
						"rgba" 		=> "rgba(12,180,206,1)"
					),
					"compiler"	=> array(
						"border-color" => ".wrapper input:focus, .wrapper input[type='text']:focus, .wrapper input[type='email']:focus, .wrapper input[type='search']:focus, .wrapper input[type='url']:focus, .wrapper input[type='tel']:focus, .wrapper input[type='password']:focus, .wrapper input[type='datetime']:focus, .wrapper input[type='date']:focus, .wrapper input[type='month']:focus, .wrapper input[type='week']:focus, .wrapper input[type='time']:focus, .wrapper input[type='datetime-local']:focus, .wrapper input[type='number']:focus, .wrapper textarea:focus, .wrapper select:focus"
					)
				),
				
				// Separators / Borders
				array(
					"id"        => "scheme-1-divider-color",
					"title"     => esc_html__( "Separator", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separators and borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(0,0,0,0.2)"
					),
					"compiler"	=> array(						
						"border-color"		=> "pre, body.search .section-wrapper article + article, .boxed_content, .single-post-navigation .blog-link, .single-post-navigation a"												
					)
				),
				
				// Separators Text
				array(
					"id"        => "scheme-1-divider-text-color",
					"title"     => esc_html__( "Separator Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separator text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#303133",
						"alpha"     => "1",
						"rgba" 		=> "rgba(48,49,51,1)"
					),
					"compiler"	=> array(
						"color" => ".vc_separator h4"
					)
				),
				
				// Gallery Hover 
				array(
					"id"        => "scheme-1-gallery-caption-bg-color",
					"title"     => esc_html__( "Gallery Caption Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour for gallery image captions.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".gallery-caption, .post-grid-item-content-bg"
					)
				),
				
				// Gallery Icon 
				array(
					"id"        => "scheme-1-gallery-caption-icon-color",
					"title"     => esc_html__( "Gallery Caption Icon", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption icons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color"	=> ".wp-caption-content span:before"
					)
				),
				
				// Gallery Text
				array(
					"id"        => "scheme-1-gallery-caption-text-color",
					"title"     => esc_html__( "Gallery Caption Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color"	=> ".wp-caption-content, .wp-caption-content h3"
					)
				),
				
				// Button
				array(
					"id"        => "scheme-1-button-color",
					"title"     => esc_html__( "Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for buttons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".video_lightbox .play:after, .wrapper input[type='button']:hover, .wrapper input[type='submit']:hover, .wrapper button:hover, .wrapper button[type='submit']:hover, .wrapper input[type='reset']:hover, .tagcloud a:hover, .vc_btn3:after, .posts-list article:hover, .wpb_text_column ul li:before",
						"border-color"		=> ".video_lightbox .play, .vc_btn3, .post-meta .vc_btn3, .wrapper .vc_custom_heading .vc_btn3, .wrapper .vc_custom_heading .vc_btn3:hover, .wrapper input[type='button'], .wrapper input[type='submit'], .wrapper button, .wrapper button[type='submit'], .wrapper input[type='reset'], .tagcloud a, .wrapper input[type='button']:disabled, .wrapper input[type='submit']:disabled, .wrapper button:disabled, .wrapper input[type='button']:disabled:hover, .wrapper input[type='submit']:disabled:hover, .wrapper button:disabled:hover",
						"color"				=> ".video_lightbox .play, .vc_btn3, .post-meta .vc_btn3, .wrapper .vc_custom_heading .vc_btn3, .tagcloud a, .wrapper input[type='button'], .wrapper input[type='button']:disabled, .wrapper input[type='button']:disabled:hover, .wrapper input[type='submit'], .wrapper input[type='submit']:disabled, .wrapper input[type='submit']:disabled:hover, .wrapper button, .wrapper button:disabled, .wrapper button:disabled:hover",
					)
				),
				
				// Button hover text
				array(
					"id"        => "scheme-1-button-text-hover-color",
					"title"     => esc_html__( "Button Text Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of button text when hovered over.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".vc_btn3:hover, .post-meta .vc_btn3:hover, .video_lightbox .play:hover, .wrapper .vc_custom_heading .vc_btn3:hover, .posts-list article:hover, .posts-list article:hover a, .tagcloud a:hover, .wrapper input[type='button']:hover, .wrapper input[type='submit']:hover, .wrapper button:hover, .wrapper button[type='submit']:hover, .wrapper input[type='reset']:hover, .wpb_text_column ul li:before"
					)
				),
				
				// Secondary Button
				array(
					"id"        => "scheme-1-secondary-button-color",
					"title"     => esc_html__( "Secondary Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for secondary buttons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"background-color"	=> ".vc_btn3.btn-color-secondary:after",
						"border-color"		=> ".vc_btn3.btn-color-secondary",
						"color"				=> ".vc_btn3.btn-color-secondary",
					)
				),
				
				// Secondary button hover text
				array(
					"id"        => "scheme-1-secondary-button-text-hover-color",
					"title"     => esc_html__( "Secondary Button Hover Text", 'experience' ),
					"desc"		=> esc_html__( "Select the secondary button hover text color.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color" => ".vc_btn3.btn-color-secondary:hover"
					)
				),
				
				// Quote text
				array(
					"id"        => "scheme-1-quote-color",
					"title"     => esc_html__( "Quote", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for quote text", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#a4a4a4",
						"alpha"     => "1",
						"rgba" 		=> "rgba(164,164,164,1)"
					),
					"compiler"	=> array(
						"color" => "blockquote p"
					)
				),
				
				// Scroll Buttons
				array(
					"id"        => "scheme-1-scroll-button-color",
					"title"     => esc_html__( "Scroll Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of header scroll arrow button.", 'experience' ),
					"type"      => "color",
					"default"	=> "#242424",
					"compiler"	=> array(
						"color" => ".section-scroll-link"
					)
				),				
				
				// Toggle content background
				array(
					"id"        => "scheme-1-tta-background-color",
					"title"     => esc_html__( "Toggle Content Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content backgrounds.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ededed",
					"compiler"	=> array(
						"background-color"	=> ".wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading, .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading:hover, .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading, .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel .vc_tta-panel-body, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels, .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-list, .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tabs-list, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active, .wpb_wrapper .vc_toggle_title, .vc_toggle .vc_toggle_content, .posts-list article"
					)
				),
				
				// Toggle content title
				array(
					"id"        => "scheme-1-tta-title-color",
					"title"     => esc_html__( "Toggle Content Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content titles.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a, .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a, .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a:hover, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a:hover, .vc_toggle_title a, .posts-list article a"
					)
				),
				
				// Toggle content title hover
				array(
					"id"        => "scheme-1-tta-title-hover-color",
					"title"     => esc_html__( "Toggle Content Title Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content titles when hovered over.", 'experience' ),
					"type"      => "color",
					"default"	=> "#a4a4a4",
					"compiler"	=> array(
						"color" => ".wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a:hover, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a:hover, .vc_toggle .vc_toggle_title a:hover"
					)
				),
				
				// Toggle content text
				array(
					"id"        => "scheme-1-tta-text-color",
					"title"     => esc_html__( "Toggle Content Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#a4a4a4",
					"compiler"	=> array(
						"color" => ".vc_toggle_content, .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-body, .posts-list"
					)
				),
				
				// Comment Navigation arrow
				array(
					"id"        => "scheme-1-comments-navigation-arrow-color",
					"title"     => esc_html__( "Comments Navigation Arrow", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "0.3",
						"rgba" 		=> "rgba(0,0,0,0.3)"
					),
					"compiler"	=> array(
						"color" => ".comments-navigation a"
					)
				),				
				
				// Comment navigation border
				array(
					"id"        => "scheme-1-comments-navigation-border-color",
					"title"     => esc_html__( "Comments Navigation Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(0,0,0,0.2)"
					),
					"compiler"	=> array(
						"border-color"		=> ".comments-navigation div",	
						"background-color"	=> ".comments-navigation div span:after"						
					)
				),	
				
				// Comment navigation arrow hover
				array(
					"id"        => "scheme-1-comments-navigation-arrow-hover-color",
					"title"     => esc_html__( "Comments Navigation Arrow Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrow when hovered.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".comments-navigation a:hover"
					)
				),	
				
				
				// Comment navigation background hover
				array(
					"id"        => "scheme-1-comments-navigation-background-color",
					"title"     => esc_html__( "Comments Navigation Background Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for comment navigation arrow background when hovered.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(						
						"background-color"	=> ".comments-navigation a:hover span:after"					
					)
				),
				
				// Comment alternate background
				array(
					"id"        => "scheme-1-comments-alt-background",
					"title"     => esc_html__( "Comment Alternate Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour of alternate post comments.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#f7f7f7",
						"alpha"     => "1",
						"rgba" 		=> "rgba(247,247,247,1)"
					),
					"compiler"	=> array(						
						"background-color"	=> ".comment.odd > .comment-holder, .comment.odd > #respond"
					)
				)
				
			)
		) );
		
		
		// ----- COLOUR SCHEME 2 ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Colour Scheme 2", 'experience' ),
			"id"         => "style-color-2",
			"subsection" => true,
			"desc"       => esc_html__( "Colour schemes can be applied to page headers, page sections, visual composer sections and columns.", 'experience' ),
			"fields"     => array(
				
				// Colour Scheme 2 Label
				array(
					"id"        => "scheme-2-label",
					"title"     => esc_html__( "Colour Scheme 2 Label", 'experience' ),
					"desc"		=> esc_html__( "Make this colour scheme easier to identify with a descriptive label.", 'experience' ),
					"type"      => "text"
				),
				
				// Accent
				array(
					"id"        => "scheme-2-accent-color",
					"title"     => esc_html__( "Accent", 'experience' ),
					"desc"		=> esc_html__( "Select the accent colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#0cb4ce",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-2 .heading-label:after, .color-scheme-2 .boxed_content h1:after, .color-scheme-2 .boxed_content h2:after, .color-scheme-2 .boxed_content h3:after, .color-scheme-2 .boxed_content h4:after, .color-scheme-2 .boxed_content h5:after, .color-scheme-2 .boxed_content h6:after",
						"border-color"		=> ".color-scheme-2 blockquote",
						"color"				=> ".color-scheme-2 .flexslider-small .slide-subtitle"
					)
				),
				
				// Background
				array(
					"id"        => "scheme-2-background-color",
					"title"     => esc_html__( "Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for the content area background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#f7f7f7",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-2.section-header, .color-scheme-2.section-content-wrapper, .color-scheme-2.vc_row, .vc_row .color-scheme-2.vc_column_container, .color-scheme-2.portfolio-meta"
					)
				),
				
				// Page Label
				array(
					"id"        => "scheme-2-page-label-color",
					"title"     => esc_html__( "Label", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page labels (appears above page titles).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#303133",
						"alpha"     => "1",
						"rgba" 		=> "rgba(48,49,51,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-2 .heading-label"
					)
				),
				
				// Page Title
				array(
					"id"        => "scheme-2-page-title-color",
					"title"     => esc_html__( "Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page titles.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".color-scheme-2 .heading-title, .color-scheme-2 .flexslider-small p, .color-scheme-2 .post-grid-item-content h1, .color-scheme-2 .post-grid-item-content h2, .color-scheme-2 .post-grid-item-content h3"
					)
				),
				
				// Page Intro
				array(
					"id"        => "scheme-2-page-subtitle-color",
					"title"     => esc_html__( "Subtitle", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page subtitles.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#a4a4a4",
						"alpha"     => "1",
						"rgba" 		=> "rgba(164,164,164,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-2 .heading-subtitle, .color-scheme-2 .post-meta, .color-scheme-2 .post-meta a, .color-scheme-2 .post-meta a:hover"
					)
				),			

				// h1
				array(
					"id"        => "scheme-2-h1-color",
					"title"     => esc_html__( "Header 1", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H1 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".color-scheme-2 h1"
					)
				),
				
				// h2
				array(
					"id"        => "scheme-2-h2-color",
					"title"     => esc_html__( "Header 2", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H2 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".color-scheme-2 h2"
					)
				),
				
				// h3
				array(
					"id"        => "scheme-2-h3-color",
					"title"     => esc_html__( "Header 3", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H3 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".color-scheme-2 h3"
					)
				),
				
				// h4
				array(
					"id"        => "scheme-2-h4-color",
					"title"     => esc_html__( "Header 4", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H4 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".color-scheme-2 h4"
					)
				),
				
				// h5
				array(
					"id"        => "scheme-2-h5-color",
					"title"     => esc_html__( "Header 5", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H5 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".color-scheme-2 h5, .color-scheme-2 .wpb_accordion_header a, .color-scheme-2 .vc_toggle_title a"
					)
				),
				
				// h6
				array(
					"id"        => "scheme-2-h6-color",
					"title"     => esc_html__( "Header 6", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H6 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".color-scheme-2 h6"
					)
				),					
				
				// Text
				array(
					"id"        => "scheme-2-text-color",
					"title"     => esc_html__( "Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for body text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#a4a4a4",
						"alpha"     => "1",
						"rgba" 		=>  "rgba(164,164,164,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-2, .color-scheme-2.section-header, .color-scheme-2.section-content-wrapper, .color-scheme-2 label"
					)
				),					
				
				// Subtext
				array(
					"id"        => "scheme-2-subtext-color",
					"title"     => esc_html__( "Subtext", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for subtext (cite, captions etc).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#a4a4a4",
						"alpha"     => "1",
						"rgba" 		=>  "rgba(164,164,164,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-2 .wp-caption .wp-caption-text, .color-scheme-2 blockquote cite, .color-scheme-2 .comment-date a, body.search .color-scheme-2 .post-permalink"
					)
				),
				
				// Link
				array(
					"id"        => "scheme-2-link-color",
					"title"     => esc_html__( "Link", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#0cb4ce",
					"compiler"	=> array(
						"color" => ".color-scheme-2 a"
					)
				),
				
				// Link Hover
				array(
					"id"        => "scheme-2-link-hover-color",
					"title"     => esc_html__( "Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text hover state.", 'experience' ),
					"type"      => "color",
					"default"	=> "#a4a4a4",
					"compiler"	=> array(
						"color" => ".color-scheme-2 a:hover, .color-scheme-2 .comment-date a:hover"
					)
				),
				
				// Slider Arrows
				array(
					"id"        => "scheme-2-slider-arrow-color",
					"title"     => esc_html__( "Slider Arrows", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "0.1",
						"rgba" 		=> "rgba(0,0,0,0.1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-2 .flex-direction-nav a"
					)
				),
				
				// Slider Arrows Border
				array(
					"id"        => "scheme-2-slider-arrow-border-color",
					"title"     => esc_html__( "Slider Arrow Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "0.5",
						"rgba" 		=> "rgba(0,0,0,0.5)"
					),
					"compiler"	=> array(
						"border-color" => ".color-scheme-2 .flex-direction-nav li, .color-scheme-2 .flex-direction-nav li + li"
					)
				),				
				
				// Slider Pagination Border
				array(
					"id"        => "scheme-2-slider-pagination-border-color",
					"title"     => esc_html__( "Slider Pagination Border", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button border colour.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#09879b",
						"alpha"     => "1",
						"rgba" 		=> "rgba(9,135,155,1)"
					),
					"compiler"	=>	array(
						"border-color"		=> ".color-scheme-2 .vc_slide.vc_images_carousel .vc_carousel-indicators li, .color-scheme-2 .wp-link-pages .pagination-button, .color-scheme-2 .flexslider-big .flex-control-paging li a",
						"background-color"	=> ".color-scheme-2 .flexslider-big .flex-control-paging li:before, .color-scheme-2 .wp-link-pages .pagination-separator"
					)
				),				
				
				// Slider Pagination Fill
				array(
					"id"        => "scheme-2-slider-pagination-fill-color",
					"title"     => esc_html__( "Slider Pagination Fill", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button fill colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-2 .vc_slide.vc_images_carousel .vc_carousel-indicators li:hover, .color-scheme-2 .vc_slide.vc_images_carousel .vc_carousel-indicators li.vc_active, .color-scheme-2 .flexslider-big .flex-control-paging li a:after, .color-scheme-2 .wp-link-pages .pagination-button:after"
					)
				),
				
				// Table Header Background
				array(
					"id"        => "scheme-2-table-header-color",
					"title"     => esc_html__( "Table Header Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#e4e4e4",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-2 th"
					)
				),
				
				// Table Header Text
				array(
					"id"        => "scheme-2-table-header-text-color",
					"title"     => esc_html__( "Table Header Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".color-scheme-2 th"
					)
				),
				
				// Table background
				array(
					"id"        => "scheme-2-table-bg-color",
					"title"     => esc_html__( "Table Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#e4e4e4",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-2 td"
					)
				),
				
				// Table Text
				array(
					"id"        => "scheme-2-table-text-color",
					"title"     => esc_html__( "Table Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table text.", 'experience' ),
					"type"		=> "color",
					"default"	=> "#a4a4a4",
					"compiler"	=> array(
						"color" => ".color-scheme-2 table"
					)
				),
				
				// Form fields text
				array(
					"id"        => "scheme-2-input-text-color",
					"title"     => esc_html__( "Input Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of input field text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#a4a4a4",
						"alpha"     => "1",
						"rgba" 		=> "rgba(164,164,164,1)"
					),
					"compiler"	=> array(
						"color" => ".wrapper .color-scheme-2 input, .wrapper .color-scheme-2 input[type='text'], .wrapper .color-scheme-2 input[type='email'], .wrapper .color-scheme-2 input[type='search'], .wrapper .color-scheme-2 input[type='url'], .wrapper .color-scheme-2 input[type='tel'], .wrapper .color-scheme-2 input[type='password'], .wrapper .color-scheme-2 input[type='datetime'], .wrapper .color-scheme-2 input[type='date'], .wrapper .color-scheme-2 input[type='month'], .wrapper .color-scheme-2 input[type='week'], .wrapper .color-scheme-2 input[type='time'], .wrapper .color-scheme-2 input[type='datetime-local'], .wrapper .color-scheme-2 input[type='number'], .wrapper .color-scheme-2 textarea, .wrapper .color-scheme-2 select"
					)
				),
				
				// Form fields border
				array(
					"id"        => "scheme-2-input-border-color",
					"title"     => esc_html__( "Input Field Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(0,0,0,0.2)"
					),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-2 input, .wrapper .color-scheme-2 input[type='text'], .wrapper .color-scheme-2 input[type='email'], .wrapper .color-scheme-2 input[type='search'], .wrapper .color-scheme-2 input[type='url'], .wrapper .color-scheme-2 input[type='tel'], .wrapper .color-scheme-2 input[type='password'], .wrapper .color-scheme-2 input[type='datetime'], .wrapper .color-scheme-2 input[type='date'], .wrapper .color-scheme-2 input[type='month'], .wrapper .color-scheme-2 input[type='week'], .wrapper .color-scheme-2 input[type='time'], .wrapper .color-scheme-2 input[type='datetime-local'], .wrapper .color-scheme-2 input[type='number'], .wrapper .color-scheme-2 textarea, .wrapper .color-scheme-2 select"
					)
				),
				
				// Form fields focused border
				array(
					"id"        => "scheme-2-input-border-focused-color",
					"title"     => esc_html__( "Input Field Border Focused", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders when focused.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#0cb4ce",
						"alpha"     => "1",
						"rgba" 		=> "rgba(12,180,206,1)"
					),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-2 input:focus, .wrapper .color-scheme-2 input[type='text']:focus, .wrapper .color-scheme-2 input[type='email']:focus, .wrapper .color-scheme-2 input[type='search']:focus, .wrapper .color-scheme-2 input[type='url']:focus, .wrapper .color-scheme-2 input[type='tel']:focus, .wrapper .color-scheme-2 input[type='password']:focus, .wrapper .color-scheme-2 input[type='datetime']:focus, .wrapper .color-scheme-2 input[type='date']:focus, .wrapper .color-scheme-2 input[type='month']:focus, .wrapper .color-scheme-2 input[type='week']:focus, .wrapper .color-scheme-2 input[type='time']:focus, .wrapper .color-scheme-2 input[type='datetime-local']:focus, .wrapper .color-scheme-2 input[type='number']:focus, .wrapper .color-scheme-2 textarea:focus, .wrapper .color-scheme-2 select:focus"
					)
				),
				
				// Separators / Borders
				array(
					"id"        => "scheme-2-divider-color",
					"title"     => esc_html__( "Separator", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separators and borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(0,0,0,0.2)"
					),
					"compiler"	=> array(						
						"border-color"		=> ".color-scheme-2 pre, body.search .color-scheme-2 .section-wrapper article + article, .color-scheme-2 .boxed_content, .color-scheme-2.single-post-navigation .blog-link, .color-scheme-2.single-post-navigation a"
					)
				),
				
				// Separators Text
				array(
					"id"        => "scheme-2-divider-text-color",
					"title"     => esc_html__( "Separator Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separator text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#303133",
						"alpha"     => "1",
						"rgba" 		=> "rgba(48,49,51,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-2 .vc_separator h4"
					)
				),
				
				// Gallery Hover 
				array(
					"id"        => "scheme-2-gallery-caption-bg-color",
					"title"     => esc_html__( "Gallery Caption Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour for gallery image captions.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-2 .gallery-caption, .color-scheme-2 .post-grid-item-content-bg"
					)
				),
				
				// Gallery Icon 
				array(
					"id"        => "scheme-2-gallery-caption-icon-color",
					"title"     => esc_html__( "Gallery Caption Icon", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption icons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color"	=> ".color-scheme-2 .wp-caption-content span:before"
					)
				),
				
				// Gallery Text
				array(
					"id"        => "scheme-2-gallery-caption-text-color",
					"title"     => esc_html__( "Gallery Caption Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color"	=> ".color-scheme-2 .wp-caption-content, .color-scheme-2 .wp-caption-content h3"
					)
				),
				
				// Button
				array(
					"id"        => "scheme-2-button-color",
					"title"     => esc_html__( "Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for buttons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-2 .video_lightbox .play:after, .wrapper .color-scheme-2 input[type='button']:hover, .wrapper .color-scheme-2 input[type='submit']:hover, .wrapper .color-scheme-2 button:hover, .wrapper .color-scheme-2 button[type='submit']:hover, .wrapper .color-scheme-2 input[type='reset']:hover, .color-scheme-2 .tagcloud a:hover, .color-scheme-2 .vc_btn3:after, .color-scheme-2 .posts-list article:hover, .color-scheme-2 .wpb_text_column ul li:before, .color-scheme-2 .wpb_text_column ul li:before",
						"border-color"		=> ".color-scheme-2 .video_lightbox .play, .color-scheme-2 .vc_btn3, .color-scheme-2 .post-meta .vc_btn3, .color-scheme-2 .post-meta .vc_btn3:hover, .wrapper .color-scheme-2 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-2 input[type='button'], .wrapper .color-scheme-2 input[type='submit'], .wrapper .color-scheme-2 button, .wrapper .color-scheme-2 button[type='submit'], .wrapper .color-scheme-2 input[type='reset'], .color-scheme-2 .tagcloud a, .wrapper .color-scheme-2 input[type='button']:disabled, .wrapper .color-scheme-2 input[type='submit']:disabled, .wrapper .color-scheme-2 button:disabled, .wrapper .color-scheme-2 input[type='button']:disabled:hover, .wrapper .color-scheme-2 input[type='submit']:disabled:hover, .wrapper .color-scheme-2 button:disabled:hover",
						"color"				=> ".color-scheme-2 .video_lightbox .play, .color-scheme-2 .vc_btn3, .color-scheme-2 .post-meta .vc_btn3, .wrapper .color-scheme-2 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-2 input[type='button'], .wrapper .color-scheme-2 input[type='submit'], .wrapper .color-scheme-2 button, .wrapper .color-scheme-2 button[type='submit'], .wrapper .color-scheme-2 input[type='reset'], .color-scheme-2 .tagcloud a, .wrapper .color-scheme-2 input[type='button']:disabled, .wrapper .color-scheme-2 input[type='submit']:disabled, .wrapper .color-scheme-2 button:disabled, .wrapper .color-scheme-2 input[type='button']:disabled:hover, .wrapper .color-scheme-2 input[type='submit']:disabled:hover, .wrapper .color-scheme-2 button:disabled:hover, .color-scheme-2 .wpb_text_column ul li:before",
					)
				),
				
				// Button hover text
				array(
					"id"        => "scheme-2-button-text-hover-color",
					"title"     => esc_html__( "Button Text Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of button text when hovered over.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-2 .vc_btn3:hover, .color-scheme-2 .post-meta .vc_btn3:hover, .color-scheme-2 .video_lightbox .play:hover, .wrapper .color-scheme-2 .vc_custom_heading .vc_btn3:hover, .color-scheme-2 .posts-list article:hover, .color-scheme-2 .posts-list article:hover a, .color-scheme-2 .tagcloud a:hover, .wrapper .color-scheme-2 input[type='button']:hover, .wrapper .color-scheme-2 input[type='submit']:hover, .wrapper .color-scheme-2 button:hover, .wrapper .color-scheme-2 button[type='submit']:hover, .wrapper .color-scheme-2 input[type='reset']:hover, .color-scheme-2 .wpb_text_column ul li:before"
					)
				),
				
				// Secondary Button
				array(
					"id"        => "scheme-2-secondary-button-color",
					"title"     => esc_html__( "Secondary Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for secondary buttons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-2 .vc_btn3.btn-color-secondary:after",
						"border-color"		=> ".color-scheme-2 .vc_btn3.btn-color-secondary",
						"color"				=> ".color-scheme-2 .vc_btn3.btn-color-secondary",
					)
				),
				
				// Secondary button hover text
				array(
					"id"        => "scheme-2-secondary-button-text-hover-color",
					"title"     => esc_html__( "Secondary Button Hover Text", 'experience' ),
					"desc"		=> esc_html__( "Select the secondary button hover text color.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color" => ".color-scheme-2 .vc_btn3.btn-color-secondary:hover"
					)
				),
				
				// Quote text
				array(
					"id"        => "scheme-2-quote-color",
					"title"     => esc_html__( "Quote", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for quote text", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#a4a4a4",
						"alpha"     => "1",
						"rgba" 		=> "rgba(164,164,164,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-2 blockquote p"
					)
				),
				
				// Scroll Buttons
				array(
					"id"        => "scheme-2-scroll-button-color",
					"title"     => esc_html__( "Scroll Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of header scroll arrow button.", 'experience' ),
					"type"      => "color",
					"default"	=> "#0cb4ce",
					"compiler"	=> array(
						"color" => ".color-scheme-2 .section-scroll-link"
					)
				),				
				
				// Toggle content background
				array(
					"id"        => "scheme-2-tta-background-color",
					"title"     => esc_html__( "Toggle Content Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content backgrounds.", 'experience' ),
					"type"      => "color",
					"default"	=> "#e4e4e4",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading:hover, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel .vc_tta-panel-body, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-list, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tabs-list, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active, .color-scheme-2 .wpb_wrapper .vc_toggle_title, .color-scheme-2 .vc_toggle .vc_toggle_content, .color-scheme-2 .posts-list article"
					)
				),
				
				// Toggle content title
				array(
					"id"        => "scheme-2-tta-title-color",
					"title"     => esc_html__( "Toggle Content Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for toggle content ttiles", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a:hover, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a:hover, .color-scheme-2 .vc_toggle_title a, .color-scheme-2 .posts-list article a"
					)
				),
				
				// Toggle content title hover
				array(
					"id"        => "scheme-2-tta-title-hover-color",
					"title"     => esc_html__( "Toggle Content Title Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content titles when hovered over.", 'experience' ),
					"type"      => "color",
					"default"	=> "#a4a4a4",
					"compiler"	=> array(
						"color" => ".color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a:hover, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a:hover, .color-scheme-2 .vc_toggle .vc_toggle_title a:hover"
					)
				),
				
				// Toggle content text
				array(
					"id"        => "scheme-2-tta-text-color",
					"title"     => esc_html__( "Toggle Content Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#848484",
					"compiler"	=> array(
						"color" => ".color-scheme-2 .vc_toggle_content, .color-scheme-2 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-body, .color-scheme-2 .posts-list"
					)
				),
				
				// Comment Navigation arrow
				array(
					"id"        => "scheme-2-comments-navigation-arrow-color",
					"title"     => esc_html__( "Comments Navigation Arrow", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "0.3",
						"rgba" 		=> "rgba(0,0,0,0.3)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-2 .comments-navigation a"
					)
				),				
				
				// Comment navigation border
				array(
					"id"        => "scheme-2-comments-navigation-border-color",
					"title"     => esc_html__( "Comments Navigation Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(0,0,0,0.2)"
					),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-2 .comments-navigation div",	
						"background-color"	=> ".color-scheme-2 .comments-navigation div span:after"						
					)
				),	
				
				// Comment navigation arrow hover
				array(
					"id"        => "scheme-2-comments-navigation-arrow-hover-color",
					"title"     => esc_html__( "Comments Navigation Arrow Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrow when hovered.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-2 .comments-navigation a:hover"
					)
				),	
				
				
				// Comment navigation background hover
				array(
					"id"        => "scheme-2-comments-navigation-background-color",
					"title"     => esc_html__( "Comments-Navigation Background Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for comment navigation arrow background when hovered.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-2 .comments-navigation a:hover span:after"					
					)
				),
				
				// Comment alternate background
				array(
					"id"        => "scheme-2-comments-alt-background",
					"title"     => esc_html__( "Comment Alternate Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour of alternate post comments.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#e7e7e7",
						"alpha"     => "1",
						"rgba" 		=> "rgba(231,231,231,1)"
					),
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-2 .comment.odd > .comment-holder, .color-scheme-2 .comment.odd > #respond"
					)
				)
				
			)
		) );
		
		
		// ----- COLOUR SCHEME 3 ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Colour Scheme 3", 'experience' ),
			"id"         => "style-color-3",
			"subsection" => true,
			"desc"       => esc_html__( "Colour schemes can be applied to page headers, page sections, visual composer sections and columns.", 'experience' ),
			"fields"     => array(			
				
				// Colour Scheme 3 Label
				array(
					"id"        => "scheme-3-label",
					"title"     => esc_html__( "Colour Scheme 3 Label", 'experience' ),
					"desc"		=> esc_html__( "Make this colour scheme easier to identify with a descriptive label.", 'experience' ),
					"type"      => "text"
				),
				
				// Accent
				array(
					"id"        => "scheme-3-accent-color",
					"title"     => esc_html__( "Accent", 'experience' ),
					"desc"		=> esc_html__( "Select the accent colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-3 .heading-label:after, .color-scheme-3 .boxed_content h1:after, .color-scheme-3 .boxed_content h2:after, .color-scheme-3 .boxed_content h3:after, .color-scheme-3 .boxed_content h4:after, .color-scheme-3 .boxed_content h5:after, .color-scheme-3 .boxed_content h6:after",
						"border-color"		=> ".color-scheme-3 blockquote",
						"color"				=> ".color-scheme-3 .flexslider-small .slide-subtitle"
					)
				),
				
				// Background
				array(
					"id"        => "scheme-3-background-color",
					"title"     => esc_html__( "Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for the content area background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#0cb4ce",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-3.section-header, .color-scheme-3.section-content-wrapper, .color-scheme-3.vc_row, .vc_row .color-scheme-3.vc_column_container, .color-scheme-3.portfolio-meta"
					)
				),
				
				// Page Label
				array(
					"id"        => "scheme-3-page-label-color",
					"title"     => esc_html__( "Label", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page labels (appears above page titles).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#FFFFFF",
						"alpha"     => "1",
						"rgba" 		=> Redux_Helpers::hex2rgba ( '#FFFFFF', '1' )
					),
					"compiler"	=> array(
						"color" => ".color-scheme-3 .heading-label"
					)
				),
				
				// Page Title
				array(
					"id"        => "scheme-3-page-title-color",
					"title"     => esc_html__( "Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page titles.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-3 .heading-title, .color-scheme-3 .flexslider-small p, .color-scheme-3 .post-grid-item-content h1, .color-scheme-3 .post-grid-item-content h2, .color-scheme-3 .post-grid-item-content h3"
					)
				),
				
				// Page Intro
				array(
					"id"        => "scheme-3-page-subtitle-color",
					"title"     => esc_html__( "Subtitle", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page subtitles.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#FFFFFF",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-3 .heading-subtitle, .color-scheme-3 .post-meta, .color-scheme-3 .post-meta a, .color-scheme-3 .post-meta a:hover"
					)
				),			

				// h1
				array(
					"id"        => "scheme-3-h1-color",
					"title"     => esc_html__( "Header 1", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H1 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-3 h1"
					)
				),
				
				// h2
				array(
					"id"        => "scheme-3-h2-color",
					"title"     => esc_html__( "Header 2", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H2 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-3 h2"					
					)
				),
				
				// h3
				array(
					"id"        => "scheme-3-h3-color",
					"title"     => esc_html__( "Header 3", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H3 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-3 h3"
					)
				),
				
				// h4
				array(
					"id"        => "scheme-3-h4-color",
					"title"     => esc_html__( "Header 4", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H4 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-3 h4"
					)
				),
				
				// h5
				array(
					"id"        => "scheme-3-h5-color",
					"title"     => esc_html__( "Header 5", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H5 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-3 h5, .color-scheme-3 .wpb_accordion_header a, .color-scheme-3 .vc_toggle_title a"
					)
				),
				
				// h6
				array(
					"id"        => "scheme-3-h6-color",
					"title"     => esc_html__( "Header 6", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H6 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-3 h6"
					)
				),					
				
				// Text
				array(
					"id"        => "scheme-3-text-color",
					"title"     => esc_html__( "Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for body text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#FFFFFF",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-3, .color-scheme-3.section-header, .color-scheme-3.section-content-wrapper, .color-scheme-3 label"
					)
				),					
				
				// Subtext
				array(
					"id"        => "scheme-3-subtext-color",
					"title"     => esc_html__( "Subtext", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for subtext (cite, captions etc).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#FFFFFF",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-3 .wp-caption .wp-caption-text, .color-scheme-3 blockquote cite, .color-scheme-3 .comment-date a, body.search .color-scheme-3 .post-permalink"
					)
				),
				
				// Link
				array(
					"id"        => "scheme-3-link-color",
					"title"     => esc_html__( "Link", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color" => ".color-scheme-3 a"
					)
				),
				
				// Link Hover
				array(
					"id"        => "scheme-3-link-hover-color",
					"title"     => esc_html__( "Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text hover state.", 'experience' ),
					"type"      => "color",
					"default"	=> "#333333",
					"compiler"	=> array(
						"color" => ".color-scheme-3 a:hover, .color-scheme-3 .comment-date a:hover"
					)
				),
				
				// Slider Arrows
				array(
					"id"        => "scheme-3-slider-arrow-color",
					"title"     => esc_html__( "Slider Arrows", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-3 .flex-direction-nav a"
					)
				),
				
				// Slider Arrows Border
				array(
					"id"        => "scheme-3-slider-arrow-border-color",
					"title"     => esc_html__( "Slider Arrow Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.5",
						"rgba" 		=> "rgba(255,255,255,0.5)"
					),
					"compiler"	=> array(
						"border-color" => ".color-scheme-3 .flex-direction-nav li, .color-scheme-3 .flex-direction-nav li + li"
					)
				),
				
				// Slider Pagination Border
				array(
					"id"        => "scheme-3-slider-pagination-border-color",
					"title"     => esc_html__( "Slider Pagination Border", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button border colour.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#09879b",
						"alpha"     => "1",
						"rgba" 		=> "rgba(9,135,155,1)"
					),
					"compiler"	=>	array(
						"border-color"		=> ".color-scheme-3 .vc_slide.vc_images_carousel .vc_carousel-indicators li, .color-scheme-3 .wp-link-pages .pagination-button, .color-scheme-3 .flexslider-big .flex-control-paging li a",
						"background-color"	=> ".color-scheme-3 .flexslider-big .flex-control-paging li:before, .color-scheme-3 .wp-link-pages .pagination-separator"
					)
				),				
				
				// Slider Pagination Fill
				array(
					"id"        => "scheme-3-slider-pagination-fill-color",
					"title"     => esc_html__( "Slider Pagination Fill", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button fill colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-3 .vc_slide.vc_images_carousel .vc_carousel-indicators li:hover, .color-scheme-3 .vc_slide.vc_images_carousel .vc_carousel-indicators li.vc_active, .color-scheme-3 .flexslider-big .flex-control-paging li a:after, .color-scheme-3 .wp-link-pages .pagination-button:after"
					)
				),
				
				// Table Header Background
				array(
					"id"        => "scheme-3-table-header-color",
					"title"     => esc_html__( "Table Header Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-3 th"
					)
				),
				
				// Table Header Text
				array(
					"id"        => "scheme-3-table-header-text-color",
					"title"     => esc_html__( "Table Header Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-3 th"
					)
				),
				
				// Table background
				array(
					"id"        => "scheme-3-table-bg-color",
					"title"     => esc_html__( "Table Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-3 td"
					)
				),
				
				// Table Text
				array(
					"id"        => "scheme-3-table-text-color",
					"title"     => esc_html__( "Table Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table text.", 'experience' ),
					"type"     	=> "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color" => ".color-scheme-3 table"
					)
				),
				
				// Form fields text
				array(
					"id"        => "scheme-3-input-text-color",
					"title"     => esc_html__( "Input Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of input field text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "1",
						"rgba" => "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"color" => ".wrapper .color-scheme-3 input, .wrapper .color-scheme-3 input[type='text'], .wrapper .color-scheme-3 input[type='email'], .wrapper .color-scheme-3 input[type='search'], .wrapper .color-scheme-3 input[type='url'], .wrapper .color-scheme-3 input[type='tel'], .wrapper .color-scheme-3 input[type='password'], .wrapper .color-scheme-3 input[type='datetime'], .wrapper .color-scheme-3 input[type='date'], .wrapper .color-scheme-3 input[type='month'], .wrapper .color-scheme-3 input[type='week'], .wrapper .color-scheme-3 input[type='time'], .wrapper .color-scheme-3 input[type='datetime-local'], .wrapper .color-scheme-3 input[type='number'], .wrapper .color-scheme-3 textarea, .wrapper .color-scheme-3 select"
					)
				),
				
				// Form fields border
				array(
					"id"        => "scheme-3-input-border-color",
					"title"     => esc_html__( "Input Field Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(255,255,255,0.2)"
					),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-3 input, .wrapper .color-scheme-3 input[type='text'], .wrapper .color-scheme-3 input[type='email'], .wrapper .color-scheme-3 input[type='search'], .wrapper .color-scheme-3 input[type='url'], .wrapper .color-scheme-3 input[type='tel'], .wrapper .color-scheme-3 input[type='password'], .wrapper .color-scheme-3 input[type='datetime'], .wrapper .color-scheme-3 input[type='date'], .wrapper .color-scheme-3 input[type='month'], .wrapper .color-scheme-3 input[type='week'], .wrapper .color-scheme-3 input[type='time'], .wrapper .color-scheme-3 input[type='datetime-local'], .wrapper .color-scheme-3 input[type='number'], .wrapper .color-scheme-3 textarea, .wrapper .color-scheme-3 select"
					)
				),
				
				// Form fields focused border
				array(
					"id"        => "scheme-3-input-border-focused-color",
					"title"     => esc_html__( "Input Field Border Focused", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders when focused.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-3 input:focus, .wrapper .color-scheme-3 input[type='text']:focus, .wrapper .color-scheme-3 input[type='email']:focus, .wrapper .color-scheme-3 input[type='search']:focus, .wrapper .color-scheme-3 input[type='url']:focus, .wrapper .color-scheme-3 input[type='tel']:focus, .wrapper .color-scheme-3 input[type='password']:focus, .wrapper .color-scheme-3 input[type='datetime']:focus, .wrapper .color-scheme-3 input[type='date']:focus, .wrapper .color-scheme-3 input[type='month']:focus, .wrapper .color-scheme-3 input[type='week']:focus, .wrapper .color-scheme-3 input[type='time']:focus, .wrapper .color-scheme-3 input[type='datetime-local']:focus, .wrapper .color-scheme-3 input[type='number']:focus, .wrapper .color-scheme-3 textarea:focus, .wrapper .color-scheme-3 select:focus"
					)
				),
				
				// Separators / Borders
				array(
					"id"        => "scheme-3-divider-color",
					"title"     => esc_html__( "Separator", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separators and borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(255,255,255,0.2)"
					),
					"compiler"	=> array(						
						"border-color"		=> ".color-scheme-3 pre, body.search .color-scheme-3 .section-wrapper article + article, .color-scheme-3 .boxed_content, .color-scheme-3.single-post-navigation .blog-link, .color-scheme-3.single-post-navigation a"
					)
				),
				
				// Separators Text
				array(
					"id"        => "scheme-3-divider-text-color",
					"title"     => esc_html__( "Separator Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separator text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-3 .vc_separator h4"
					)
				),
				
				// Gallery Hover 
				array(
					"id"        => "scheme-3-gallery-caption-bg-color",
					"title"     => esc_html__( "Gallery Caption Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour for gallery image captions.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-3 .gallery-caption, .color-scheme-3 .post-grid-item-content-bg"
					)
				),
				
				// Gallery Icon 
				array(
					"id"        => "scheme-3-gallery-caption-icon-color",
					"title"     => esc_html__( "Gallery Caption Icon", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption icons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color"	=> ".color-scheme-3 .wp-caption-content span:before"
					)
				),
				
				// Gallery Text
				array(
					"id"        => "scheme-3-gallery-caption-text-color",
					"title"     => esc_html__( "Gallery Caption Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color"	=> ".color-scheme-3 .wp-caption-content, .color-scheme-3 .wp-caption-content h3"
					)
				),
				
				// Button
				array(
					"id"        => "scheme-3-button-color",
					"title"     => esc_html__( "Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for buttons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-3 .video_lightbox .play:after, .wrapper .color-scheme-3 input[type='button']:hover, .wrapper .color-scheme-3 input[type='submit']:hover, .wrapper .color-scheme-3 button:hover, .wrapper .color-scheme-3 button[type='submit']:hover, .wrapper .color-scheme-3 input[type='reset']:hover, .color-scheme-3 .tagcloud a:hover, .color-scheme-3 .vc_btn3:after, .color-scheme-3 .posts-list article:hover, .color-scheme-3 .wpb_text_column ul li:before",
						"border-color"		=> ".color-scheme-3 .video_lightbox .play, .color-scheme-3 .vc_btn3, .color-scheme-3 .post-meta .vc_btn3, .wrapper .color-scheme-3 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-3 .vc_custom_heading .vc_btn3:hover, .wrapper .color-scheme-3 input[type='button'], .wrapper .color-scheme-3 input[type='submit'], .wrapper .color-scheme-3 button, .wrapper .color-scheme-3 button[type='submit'], .wrapper .color-scheme-3 input[type='reset'], .color-scheme-3 .tagcloud a, .wrapper .color-scheme-3 input[type='button']:disabled, .wrapper .color-scheme-3 input[type='submit']:disabled, .wrapper .color-scheme-3 button:disabled, .wrapper .color-scheme-3 input[type='button']:disabled:hover, .wrapper .color-scheme-3 input[type='submit']:disabled:hover, .wrapper .color-scheme-3 button:disabled:hover",
						"color"				=> ".color-scheme-3 .video_lightbox .play, .color-scheme-3 .vc_btn3, .color-scheme-3 .post-meta .vc_btn3, .wrapper .color-scheme-3 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-3 input[type='button'], .wrapper .color-scheme-3 input[type='submit'], .wrapper .color-scheme-3 button, .wrapper .color-scheme-3 button[type='submit'], .wrapper .color-scheme-3 input[type='reset'], .color-scheme-3 .tagcloud a, .wrapper .color-scheme-3 input[type='button']:disabled, .wrapper .color-scheme-3 input[type='submit']:disabled, .wrapper .color-scheme-3 button:disabled, .wrapper .color-scheme-3 input[type='button']:disabled:hover, .wrapper .color-scheme-3 input[type='submit']:disabled:hover, .wrapper .color-scheme-3 button:disabled:hover",
					)
				),
				
				// Button hover text
				array(
					"id"        => "scheme-3-button-text-hover-color",
					"title"     => esc_html__( "Button Text Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of button text when hovered over.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".color-scheme-3 .vc_btn3:hover, .color-scheme-3 .post-meta .vc_btn3:hover, .color-scheme-3 .video_lightbox .play:hover, .wrapper .color-scheme-3 .vc_custom_heading .vc_btn3:hover, .color-scheme-3 .posts-list article:hover, .color-scheme-3 .posts-list article:hover a, .color-scheme-3 .tagcloud a:hover, .wrapper .color-scheme-3 input[type='button']:hover, .wrapper .color-scheme-3 input[type='submit']:hover, .wrapper .color-scheme-3 button:hover, .wrapper .color-scheme-3 button[type='submit']:hover, .wrapper .color-scheme-3 input[type='reset']:hover, .color-scheme-3 .wpb_text_column ul li:before"
					)
				),
				
				// Secondary Button
				array(
					"id"        => "scheme-3-secondary-button-color",
					"title"     => esc_html__( "Secondary Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for secondary buttons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-3 .vc_btn3.btn-color-secondary:after",
						"border-color"		=> ".color-scheme-3 .vc_btn3.btn-color-secondary",
						"color"				=> ".color-scheme-3 .vc_btn3.btn-color-secondary",
					)
				),
				
				// Secondary button hover text
				array(
					"id"        => "scheme-3-secondary-button-text-hover-color",
					"title"     => esc_html__( "Secondary Button Hover Text", 'experience' ),
					"desc"		=> esc_html__( "Select the secondary button hover text color.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color" => ".color-scheme-3 .vc_btn3.btn-color-secondary:hover"
					)
				),
				
				// Quote text
				array(
					"id"        => "scheme-3-quote-color",
					"title"     => esc_html__( "Quote", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for quote text", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-3 blockquote p"
					)
				),
				
				// Scroll Buttons
				array(
					"id"        => "scheme-3-scroll-button-color",
					"title"     => esc_html__( "Scroll Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of header scroll arrow button.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"color" => ".color-scheme-3 .section-scroll-link"
					)
				),				
				
				// Toggle content background
				array(
					"id"        => "scheme-3-tta-background-color",
					"title"     => esc_html__( "Toggle Content Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content backgrounds.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading:hover, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel .vc_tta-panel-body, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-list, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tabs-list, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active, .color-scheme-3 .wpb_wrapper .vc_toggle_title, .color-scheme-3 .vc_toggle .vc_toggle_content, .color-scheme-3 .posts-list article"
					)
				),
				
				// Toggle content title
				array(
					"id"        => "scheme-3-tta-title-color",
					"title"     => esc_html__( "Toggle Content Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for toggle content ttiles", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a:hover, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a:hover, .color-scheme-3 .vc_toggle_title a, .color-scheme-3 .posts-list article a"
					)
				),
				
				// Toggle content title hover
				array(
					"id"        => "scheme-3-tta-title-hover-color",
					"title"     => esc_html__( "Toggle Content Title Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content titles when hovered over.", 'experience' ),
					"type"      => "color",
					"default"	=> "#a4a4a4",
					"compiler"	=> array(
						"color" => ".color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a:hover, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a:hover, .color-scheme-3 .vc_toggle .vc_toggle_title a:hover"
					)
				),
				
				// Toggle content text
				array(
					"id"        => "scheme-3-tta-text-color",
					"title"     => esc_html__( "Toggle Content Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color" => ".color-scheme-3 .vc_toggle_content, .color-scheme-3 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-body, .color-scheme-3 .posts-list"
					)
				),
				
				// Comment Navigation arrow
				array(
					"id"        => "scheme-3-comments-navigation-arrow-color",
					"title"     => esc_html__( "Comments Navigation Arrow", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-3 .comments-navigation a"
					)
				),				
				
				// Comment navigation border
				array(
					"id"        => "scheme-3-comments-navigation-border-color",
					"title"     => esc_html__( "Comments Navigation Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(255,255,255,0.2)"
					),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-3 .comments-navigation div",	
						"background-color"	=> ".color-scheme-3 .comments-navigation div span:after"						
					)
				),	
				
				// Comment navigation arrow hover
				array(
					"id"        => "scheme-3-comments-navigation-arrow-hover-color",
					"title"     => esc_html__( "Comments Navigation Arrow Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrow when hovered.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-3 .comments-navigation a:hover"
					)
				),	
				
				
				// Comment navigation background hover
				array(
					"id"        => "scheme-3-comments-navigation-background-color",
					"title"     => esc_html__( "Comments-Navigation Background Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for comment navigation arrow background when hovered.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-3 .comments-navigation a:hover span:after"					
					)
				),
				
				// Comment alternate background
				array(
					"id"        => "scheme-3-comments-alt-background",
					"title"     => esc_html__( "Comment Alternate Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour of alternate post comments.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.1",
						"rgba" 		=> "rgba(255,255,255,0.1)"
					),
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-3 .comment.odd > .comment-holder, .color-scheme-3 .comment.odd > #respond"
					)
				)
				
			)
		) );
		
		
		// ----- COLOUR SCHEME 4 ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Colour Scheme 4", 'experience' ),
			"id"         => "style-color-4",
			"subsection" => true,
			"desc"       => esc_html__( "Colour schemes can be applied to page headers, page sections, visual composer sections and columns.", 'experience' ),
			"fields"     => array(
				
				// Colour Scheme 4 Label
				array(
					"id"        => "scheme-4-label",
					"title"     => esc_html__( "Colour Scheme 2 Label", 'experience' ),
					"desc"		=> esc_html__( "Make this colour scheme easier to identify with a descriptive label.", 'experience' ),
					"type"      => "text"
				),
				
				// Accent
				array(
					"id"        => "scheme-4-accent-color",
					"title"     => esc_html__( "Accent", 'experience' ),
					"desc"		=> esc_html__( "Select the accent colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-4 .heading-label:after, .color-scheme-4 .boxed_content h1:after, .color-scheme-4 .boxed_content h2:after, .color-scheme-4 .boxed_content h3:after, .color-scheme-4 .boxed_content h4:after, .color-scheme-4 .boxed_content h5:after, .color-scheme-4 .boxed_content h6:after",
						"border-color"		=> ".color-scheme-4 blockquote",
						"color"				=> ".color-scheme-4 .flexslider-small .slide-subtitle"
					)
				),
				
				// Background
				array(
					"id"        => "scheme-4-background-color",
					"title"     => esc_html__( "Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for the content area background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#0cb4ce",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-4.section-header, .color-scheme-4.section-content-wrapper, .color-scheme-4.vc_row, .vc_row .color-scheme-4.vc_column_container, .color-scheme-4.portfolio-meta"
					)
				),
				
				// Page Label
				array(
					"id"        => "scheme-4-page-label-color",
					"title"     => esc_html__( "Label", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page labels (appears above page titles).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#FFFFFF",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,15,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-4 .heading-label"
					)
				),
				
				// Page Title
				array(
					"id"        => "scheme-4-page-title-color",
					"title"     => esc_html__( "Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page titles.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-4 .heading-title, .color-scheme-4 .flexslider-small p, .color-scheme-4 .post-grid-item-content h1, .color-scheme-4 .post-grid-item-content h2, .color-scheme-4 .post-grid-item-content h3"
					)
				),
				
				// Page Intro
				array(
					"id"        => "scheme-4-page-subtitle-color",
					"title"     => esc_html__( "Subtitle", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page subtitles.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#FFFFFF",
						"alpha"     => "0.7",
						"rgba" 		=> "rgba(255,255,255,0.7)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-4 .heading-subtitle, .color-scheme-4 .post-meta, .color-scheme-4 .post-meta a, .color-scheme-4 .post-meta a:hover"
					)
				),			

				// h1
				array(
					"id"        => "scheme-4-h1-color",
					"title"     => esc_html__( "Header 1", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H1 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-4 h1"
					)
				),
				
				// h2
				array(
					"id"        => "scheme-4-h2-color",
					"title"     => esc_html__( "Header 2", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H2 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-4 h2"
					)
				),
				
				// h3
				array(
					"id"        => "scheme-4-h3-color",
					"title"     => esc_html__( "Header 3", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H3 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-4 h3"
					)
				),
				
				// h4
				array(
					"id"        => "scheme-4-h4-color",
					"title"     => esc_html__( "Header 4", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H4 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-4 h4"
					)
				),
				
				// h5
				array(
					"id"        => "scheme-4-h5-color",
					"title"     => esc_html__( "Header 5", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H5 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-4 h5, .color-scheme-4 .wpb_accordion_header a, .color-scheme-4 .vc_toggle_title a"
					)
				),
				
				// h6
				array(
					"id"        => "scheme-4-h6-color",
					"title"     => esc_html__( "Header 6", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H6 elements.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-4 h6"
					)
				),					
				
				// Text
				array(
					"id"        => "scheme-4-text-color",
					"title"     => esc_html__( "Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for body text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.7",
						"rgba" 		=> "rgba(255,255,255,0.7)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-4, .color-scheme-4.section-header, .color-scheme-4.section-content-wrapper, .color-scheme-4 label"
					)
				),					
				
				// Subtext
				array(
					"id"        => "scheme-4-subtext-color",
					"title"     => esc_html__( "Subtext", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for subtext (cite, captions etc).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.7",
						"rgba" 		=> "rgba(255,255,255,0.7)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-4 .wp-caption .wp-caption-text, .color-scheme-4 blockquote cite, .color-scheme-4 .comment-date a, body.search .color-scheme-4 .post-permalink"
					)
				),
				
				// Link
				array(
					"id"        => "scheme-4-link-color",
					"title"     => esc_html__( "Link", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color" => ".color-scheme-4 a"
					)
				),
				
				// Link Hover
				array(
					"id"        => "scheme-4-link-hover-color",
					"title"     => esc_html__( "Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text hover state.", 'experience' ),
					"type"      => "color",
					"default"	=> "#333333",
					"compiler"	=> array(
						"color" => ".color-scheme-4 a:hover, .color-scheme-4 .comment-date a:hover"
					)
				),
				
				// Slider Arrows
				array(
					"id"        => "scheme-4-slider-arrow-color",
					"title"     => esc_html__( "Slider Arrows", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-4 .flex-direction-nav a"
					)
				),
				
				// Slider Arrows Border
				array(
					"id"        => "scheme-4-slider-arrow-border-color",
					"title"     => esc_html__( "Slider Arrow Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.5",
						"rgba" 		=> "rgba(255,255,255,0.5)"
					),
					"compiler"	=> array(
						"border-color" => ".color-scheme-4 .flex-direction-nav li, .color-scheme-4 .flex-direction-nav li + li"
					)
				),
				
				// Slider Pagination Border
				array(
					"id"        => "scheme-4-slider-pagination-border-color",
					"title"     => esc_html__( "Slider Pagination Border", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button border colour.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#09879b",
						"alpha"     => "1",
						"rgba" 		=> "rgba(9,135,155,1)"
					),
					"compiler"	=>	array(
						"border-color"		=> ".color-scheme-4 .vc_slide.vc_images_carousel .vc_carousel-indicators li, .color-scheme-4 .wp-link-pages .pagination-button, .color-scheme-4 .flexslider-big .flex-control-paging li a",
						"background-color"	=> ".color-scheme-4 .flexslider-big .flex-control-paging li:before, .color-scheme-4 .wp-link-pages .pagination-separator"
					)
				),				
				
				// Slider Pagination Fill
				array(
					"id"        => "scheme-4-slider-pagination-fill-color",
					"title"     => esc_html__( "Slider Pagination Fill", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button fill colour.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-4 .vc_slide.vc_images_carousel .vc_carousel-indicators li:hover, .color-scheme-4 .vc_slide.vc_images_carousel .vc_carousel-indicators li.vc_active, .color-scheme-4 .flexslider-big .flex-control-paging li a:after, .color-scheme-4 .wp-link-pages .pagination-button:after"
					)
				),
				
				// Table Header Background
				array(
					"id"        => "scheme-4-table-header-color",
					"title"     => esc_html__( "Table Header Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-4 th"
					)
				),
				
				// Table Header Text
				array(
					"id"        => "scheme-4-table-header-text-color",
					"title"     => esc_html__( "Table Header Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-4 th"
					)
				),
				
				// Table background
				array(
					"id"        => "scheme-4-table-bg-color",
					"title"     => esc_html__( "Table Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table background.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-4 td"
					)
				),
				
				// Table Text
				array(
					"id"        => "scheme-4-table-text-color",
					"title"     => esc_html__( "Table Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-4 table"
					)
				),
				
				// Form fields text
				array(
					"id"        => "scheme-4-input-text-color",
					"title"     => esc_html__( "Input Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of input field text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"color" => ".wrapper .color-scheme-4 input, .wrapper .color-scheme-4 input[type='text'], .wrapper .color-scheme-4 input[type='email'], .wrapper .color-scheme-4 input[type='search'], .wrapper .color-scheme-4 input[type='url'], .wrapper .color-scheme-4 input[type='tel'], .wrapper .color-scheme-4 input[type='password'], .wrapper .color-scheme-4 input[type='datetime'], .wrapper .color-scheme-4 input[type='date'], .wrapper .color-scheme-4 input[type='month'], .wrapper .color-scheme-4 input[type='week'], .wrapper .color-scheme-4 input[type='time'], .wrapper .color-scheme-4 input[type='datetime-local'], .wrapper .color-scheme-4 input[type='number'], .wrapper .color-scheme-4 textarea, .wrapper .color-scheme-4 select"
					)
				),
				
				// Form fields border
				array(
					"id"        => "scheme-4-input-border-color",
					"title"     => esc_html__( "Input Field Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(255,255,255,0.2)"
					),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-4 input, .wrapper .color-scheme-4 input[type='text'], .wrapper .color-scheme-4 input[type='email'], .wrapper .color-scheme-4 input[type='search'], .wrapper .color-scheme-4 input[type='url'], .wrapper .color-scheme-4 input[type='tel'], .wrapper .color-scheme-4 input[type='password'], .wrapper .color-scheme-4 input[type='datetime'], .wrapper .color-scheme-4 input[type='date'], .wrapper .color-scheme-4 input[type='month'], .wrapper .color-scheme-4 input[type='week'], .wrapper .color-scheme-4 input[type='time'], .wrapper .color-scheme-4 input[type='datetime-local'], .wrapper .color-scheme-4 input[type='number'], .wrapper .color-scheme-4 textarea, .wrapper .color-scheme-4 select"
					)
				),
				
				// Form fields focused border
				array(
					"id"        => "scheme-4-input-border-focused-color",
					"title"     => esc_html__( "Input Field Border Focused", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders when focused.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-4 input:focus, .wrapper .color-scheme-4 input[type='text']:focus, .wrapper .color-scheme-4 input[type='email']:focus, .wrapper .color-scheme-4 input[type='search']:focus, .wrapper .color-scheme-4 input[type='url']:focus, .wrapper .color-scheme-4 input[type='tel']:focus, .wrapper .color-scheme-4 input[type='password']:focus, .wrapper .color-scheme-4 input[type='datetime']:focus, .wrapper .color-scheme-4 input[type='date']:focus, .wrapper .color-scheme-4 input[type='month']:focus, .wrapper .color-scheme-4 input[type='week']:focus, .wrapper .color-scheme-4 input[type='time']:focus, .wrapper .color-scheme-4 input[type='datetime-local']:focus, .wrapper .color-scheme-4 input[type='number']:focus, .wrapper .color-scheme-4 textarea:focus, .wrapper .color-scheme-4 select:focus"
					)
				),
				
				// Separators / Borders
				array(
					"id"        => "scheme-4-divider-color",
					"title"     => esc_html__( "Separator", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separators and borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(255,255,255,0.2)"
					),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-4 pre, body.search .color-scheme-4 .section-wrapper article + article, .color-scheme-4 .boxed_content, .color-scheme-4.single-post-navigation .blog-link, .color-scheme-4.single-post-navigation a"
					)
				),
				
				// Separators Text
				array(
					"id"        => "scheme-4-divider-text-color",
					"title"     => esc_html__( "Separator Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separator text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-4 .vc_separator h4"
					)
				),
				
				// Gallery Hover 
				array(
					"id"        => "scheme-4-gallery-caption-bg-color",
					"title"     => esc_html__( "Gallery Caption Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour for gallery image captions.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-4 .gallery-caption, .color-scheme-4 .post-grid-item-content-bg"
					)
				),
				
				// Gallery Icon 
				array(
					"id"        => "scheme-4-gallery-caption-icon-color",
					"title"     => esc_html__( "Gallery Caption Icon", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption icons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color"	=> ".color-scheme-4 .wp-caption-content span:before"
					)
				),
				
				// Gallery Text
				array(
					"id"        => "scheme-4-gallery-caption-text-color",
					"title"     => esc_html__( "Gallery Caption Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color"	=> ".color-scheme-4 .wp-caption-content, .color-scheme-4 .wp-caption-content h3"
					)
				),
				
				// Button
				array(
					"id"        => "scheme-4-button-color",
					"title"     => esc_html__( "Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for buttons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-4 .video_lightbox .play:after, .wrapper .color-scheme-4 input[type='button']:hover, .wrapper .color-scheme-4 input[type='submit']:hover, .wrapper .color-scheme-4 button:hover, .wrapper .color-scheme-4 button[type='submit']:hover, .wrapper .color-scheme-4 input[type='reset']:hover, .color-scheme-4 .tagcloud a:hover, .color-scheme-4 .vc_btn3:after, .color-scheme-4 .posts-list article:hover, .color-scheme-4 .wpb_text_column ul li:before",
						"border-color"		=> ".color-scheme-4 .video_lightbox .play, .color-scheme-4 .vc_btn3, .color-scheme-4 .post-meta .vc_btn3, .wrapper .color-scheme-4 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-4 .vc_custom_heading .vc_btn3:hover, .wrapper .color-scheme-4 input[type='button'], .wrapper .color-scheme-4 input[type='submit'], .wrapper .color-scheme-4 button, .wrapper .color-scheme-4 button[type='submit'], .wrapper .color-scheme-4 input[type='reset'], .color-scheme-4 .tagcloud a, .wrapper .color-scheme-4 input[type='button']:disabled, .wrapper .color-scheme-4 input[type='submit']:disabled, .wrapper .color-scheme-4 button:disabled, .wrapper .color-scheme-4 input[type='button']:disabled:hover, .wrapper .color-scheme-4 input[type='submit']:disabled:hover, .wrapper .color-scheme-4 button:disabled:hover",
						"color"				=> ".color-scheme-4 .video_lightbox .play, .color-scheme-4 .vc_btn3, .color-scheme-4 .post-meta .vc_btn3, .wrapper .color-scheme-4 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-4 input[type='button'], .wrapper .color-scheme-4 input[type='submit'], .wrapper .color-scheme-4 button, .wrapper .color-scheme-4 button[type='submit'], .wrapper .color-scheme-4 input[type='reset'], .color-scheme-4 .tagcloud a, .wrapper .color-scheme-4 input[type='button']:disabled, .wrapper .color-scheme-4 input[type='submit']:disabled, .wrapper .color-scheme-4 button:disabled, .wrapper .color-scheme-4 input[type='button']:disabled:hover, .wrapper .color-scheme-4 input[type='submit']:disabled:hover, .wrapper .color-scheme-4 button:disabled:hover",
					)
				),
				
				// Button hover text
				array(
					"id"        => "scheme-4-button-text-hover-color",
					"title"     => esc_html__( "Button Text Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of button text when hovered over.", 'experience' ),
					"type"      => "color",
					"default"	=> "#303133",
					"compiler"	=> array(
						"color" => ".color-scheme-4 .vc_btn3:hover, .color-scheme-4 .post-meta .vc_btn3:hover, .color-scheme-4 .video_lightbox .play:hover, .wrapper .color-scheme-4 .vc_custom_heading .vc_btn3:hover, .color-scheme-4 .posts-list article:hover, .color-scheme-4 .posts-list article:hover a, .color-scheme-4 .tagcloud a:hover, .wrapper .color-scheme-4 input[type='button']:hover, .wrapper .color-scheme-4 input[type='submit']:hover, .wrapper .color-scheme-4 button:hover, .wrapper .color-scheme-4 button[type='submit']:hover, .wrapper .color-scheme-4 input[type='reset']:hover, .color-scheme-4 .wpb_text_column ul li:before"
					)
				),
				
				// Secondary Button
				array(
					"id"        => "scheme-4-secondary-button-color",
					"title"     => esc_html__( "Secondary Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for secondary buttons.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-4 .vc_btn3.btn-color-secondary:after",
						"border-color"		=> ".color-scheme-4 .vc_btn3.btn-color-secondary",
						"color"				=> ".color-scheme-4 .vc_btn3.btn-color-secondary",
					)
				),
				
				// Secondary button hover text
				array(
					"id"        => "scheme-4-secondary-button-text-hover-color",
					"title"     => esc_html__( "Secondary Button Hover Text", 'experience' ),
					"desc"		=> esc_html__( "Select the secondary button hover text color.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color" => ".color-scheme-4 .vc_btn3.btn-color-secondary:hover"
					)
				),
				
				// Quote text
				array(
					"id"        => "scheme-4-quote-color",
					"title"     => esc_html__( "Quote", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for quote text", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.7",
						"rgba" 		=> "rgba(255,255,255,0.7)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-4 blockquote p"
					)
				),
				
				// Scroll Buttons
				array(
					"id"        => "scheme-4-scroll-button-color",
					"title"     => esc_html__( "Scroll Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of header scroll arrow button.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"color" => ".color-scheme-4 .section-scroll-link"
					)
				),				
				
				// Toggle content background
				array(
					"id"        => "scheme-4-tta-background-color",
					"title"     => esc_html__( "Toggle Content Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content backgrounds.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading:hover, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel .vc_tta-panel-body, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-list, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tabs-list, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active, .color-scheme-4 .wpb_wrapper .vc_toggle_title, .color-scheme-4 .vc_toggle .vc_toggle_content, .color-scheme-4 .posts-list article"
					)
				),
				
				// Toggle content title
				array(
					"id"        => "scheme-4-tta-title-color",
					"title"     => esc_html__( "Toggle Content Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for toggle content ttiles", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a:hover, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a:hover, .color-scheme-4 .vc_toggle_title a, .color-scheme-4 .posts-list article a"
					)
				),
				
				// Toggle content title hover
				array(
					"id"        => "scheme-4-tta-title-hover-color",
					"title"     => esc_html__( "Toggle Content Title Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content titles when hovered over.", 'experience' ),
					"type"      => "color",
					"default"	=> "#A4A4A4",
					"compiler"	=> array(
						"color" => ".color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a:hover, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a:hover, .color-scheme-4 .vc_toggle .vc_toggle_title a:hover"
					)
				),
				
				// Toggle content text
				array(
					"id"        => "scheme-4-tta-text-color",
					"title"     => esc_html__( "Toggle Content Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content text.", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color" => ".color-scheme-4 .vc_toggle_content, .color-scheme-4 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-body, .color-scheme-4 .posts-list"
					)
				),
				
				// Comment Navigation arrow
				array(
					"id"        => "scheme-4-comments-navigation-arrow-color",
					"title"     => esc_html__( "Comments Navigation Arrow", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"color" => ".color-scheme-4 .comments-navigation a"
					)
				),				
				
				// Comment navigation border
				array(
					"id"        => "scheme-4-comments-navigation-border-color",
					"title"     => esc_html__( "Comments Navigation Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(255,255,255,0..2)"
					),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-4 .comments-navigation div",	
						"background-color"	=> ".color-scheme-4 .comments-navigation div span:after"						
					)
				),	
				
				// Comment navigation arrow hover
				array(
					"id"        => "scheme-4-comments-navigation-arrow-hover-color",
					"title"     => esc_html__( "Comments Navigation Arrow Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrow when hovered.", 'experience' ),
					"type"      => "color",
					"default"	=> "#FFFFFF",
					"compiler"	=> array(
						"color" => ".color-scheme-4 .comments-navigation a:hover"
					)
				),	
				
				
				// Comment navigation background hover
				array(
					"id"        => "scheme-4-comments-navigation-background-color",
					"title"     => esc_html__( "Comments-Navigation Background Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for comment navigation arrow background when hovered.", 'experience' ),
					"type"      => "color",
					"default"	=> "#09879b",
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-4 .comments-navigation a:hover span:after"					
					)
				),
				
				// Comment alternate background
				array(
					"id"        => "scheme-4-comments-alt-background",
					"title"     => esc_html__( "Comment Alternate Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour of alternate post comments.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.1",
						"rgba" 		=> "rgba(255,255,255,0.1)"
					),
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-4 .comment.odd > .comment-holder, .color-scheme-4 .comment.odd > #respond"
					)
				)
				
			)
		) );
		
		
		// ----- COLOUR SCHEME 5 ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Colour Scheme 5", 'experience' ),
			"id"         => "style-color-5",
			"subsection" => true,
			"desc"       => esc_html__( "Colour schemes can be applied to page headers, page sections, visual composer sections and columns.", 'experience' ),
			"fields"     => array(
				
				// Colour scheme 5 Label
				array(
					"id"        => "scheme-5-label",
					"title"     => esc_html__( "Colour Scheme 5 Label", 'experience' ),
					"desc"		=> esc_html__( "Make this colour scheme easier to identify with a descriptive label.", 'experience' ),
					"type"      => "text"
				),
				
				// Accent
				array(
					"id"        => "scheme-5-accent-color",
					"title"     => esc_html__( "Accent", 'experience' ),
					"desc"		=> esc_html__( "Select the accent colour.", 'experience' ),
					"type"      => "color",					
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-5 .heading-label:after, .color-scheme-5 .boxed_content h1:after, .color-scheme-5 .boxed_content h2:after, .color-scheme-5 .boxed_content h3:after, .color-scheme-5 .boxed_content h4:after, .color-scheme-5 .boxed_content h5:after, .color-scheme-5 .boxed_content h6:after",
						"border-color"		=> ".color-scheme-5 blockquote",
						"color"				=> ".color-scheme-5 .flexslider-small .slide-subtitle"
					)
				),
				
				// Background
				array(
					"id"        => "scheme-5-background-color",
					"title"     => esc_html__( "Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for the content area background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-5.section-header, .color-scheme-5.section-content-wrapper, .color-scheme-5.vc_row, .vc_row .color-scheme-5.vc_column_container, .color-scheme-5.portfolio-meta"
					)
				),
				
				// Page Label
				array(
					"id"        => "scheme-5-page-label-color",
					"title"     => esc_html__( "Label", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page labels (appears above page titles).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-5 .heading-label"
					)
				),
				
				// Page Title
				array(
					"id"        => "scheme-5-page-title-color",
					"title"     => esc_html__( "Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page titles.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 .heading-title, .color-scheme-5 .flexslider-small p, .color-scheme-5 .post-grid-item-content h1, .color-scheme-5 .post-grid-item-content h2, .color-scheme-5 .post-grid-item-content h3"
					)
				),
				
				// Page Intro
				array(
					"id"        => "scheme-5-page-subtitle-color",
					"title"     => esc_html__( "Subtitle", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page subtitles.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-5 .heading-subtitle, .color-scheme-5 .post-meta, .color-scheme-5 .post-meta a, .color-scheme-5 .post-meta a:hover"
					)
				),			

				// h1
				array(
					"id"        => "scheme-5-h1-color",
					"title"     => esc_html__( "Header 1", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H1 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 h1"
					)
				),
				
				// h2
				array(
					"id"        => "scheme-5-h2-color",
					"title"     => esc_html__( "Header 2", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H2 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 h2"
					)
				),
				
				// h3
				array(
					"id"        => "scheme-5-h3-color",
					"title"     => esc_html__( "Header 3", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H3 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 h3"
					)
				),
				
				// h4
				array(
					"id"        => "scheme-5-h4-color",
					"title"     => esc_html__( "Header 4", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H4 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 h4"
					)
				),
				
				// h5
				array(
					"id"        => "scheme-5-h5-color",
					"title"     => esc_html__( "Header 5", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H5 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 h5, .color-scheme-5 .wpb_accordion_header a, .color-scheme-5 .vc_toggle_title a"
					)
				),
				
				// h6
				array(
					"id"        => "scheme-5-h6-color",
					"title"     => esc_html__( "Header 6", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H6 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 h6"
					)
				),					
				
				// Text
				array(
					"id"        => "scheme-5-text-color",
					"title"     => esc_html__( "Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for body text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-5, .color-scheme-5.section-header, .color-scheme-5.section-content-wrapper, .color-scheme-5 label"
					)
				),					
				
				// Subtext
				array(
					"id"        => "scheme-5-subtext-color",
					"title"     => esc_html__( "Subtext", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for subtext (cite, captions etc).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-5 .wp-caption .wp-caption-text, .color-scheme-5 blockquote cite, .color-scheme-5 .comment-date a, body.search .color-scheme-5 .post-permalink"
					)
				),
				
				// Link
				array(
					"id"        => "scheme-5-link-color",
					"title"     => esc_html__( "Link", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 a"
					)
				),
				
				// Link Hover
				array(
					"id"        => "scheme-5-link-hover-color",
					"title"     => esc_html__( "Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text hover state.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 a:hover, .color-scheme-5 .comment-date a:hover"
					)
				),
				
				// Slider Arrows
				array(
					"id"        => "scheme-5-slider-arrow-color",
					"title"     => esc_html__( "Slider Arrows", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-5 .flex-direction-nav a"
					)
				),
				
				// Slider Arrows Border
				array(
					"id"        => "scheme-5-slider-arrow-border-color",
					"title"     => esc_html__( "Slider Arrow Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".color-scheme-5 .flex-direction-nav li, .color-scheme-5 .flex-direction-nav li + li"
					)
				),
				
				// Slider Pagination Border
				array(
					"id"        => "scheme-5-slider-pagination-border-color",
					"title"     => esc_html__( "Slider Pagination Border", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button border colour.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=>	array(
						"border-color"		=> ".color-scheme-5 .vc_slide.vc_images_carousel .vc_carousel-indicators li, .color-scheme-5 .wp-link-pages .pagination-button, .color-scheme-5 .flexslider-big .flex-control-paging li a",
						"background-color"	=> ".color-scheme-5 .flexslider-big .flex-control-paging li:before, .color-scheme-5 .wp-link-pages .pagination-separator"
					)
				),				
				
				// Slider Pagination Fill
				array(
					"id"        => "scheme-5-slider-pagination-fill-color",
					"title"     => esc_html__( "Slider Pagination Fill", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button fill colour.", 'experience' ),
					"type"      => "color",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-5 .vc_slide.vc_images_carousel .vc_carousel-indicators li:hover, .color-scheme-5 .vc_slide.vc_images_carousel .vc_carousel-indicators li.vc_active, .color-scheme-5 .flexslider-big .flex-control-paging li a:after, .color-scheme-5 .wp-link-pages .pagination-button:after"
					)
				),
				
				// Table Header Background
				array(
					"id"        => "scheme-5-table-header-color",
					"title"     => esc_html__( "Table Header Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-5 th"
					)
				),
				
				// Table Header Text
				array(
					"id"        => "scheme-5-table-header-text-color",
					"title"     => esc_html__( "Table Header Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 th"
					)
				),
				
				// Table background
				array(
					"id"        => "scheme-5-table-bg-color",
					"title"     => esc_html__( "Table Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-5 td"
					)
				),
				
				// Table Text
				array(
					"id"        => "scheme-5-table-text-color",
					"title"     => esc_html__( "Table Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 table"
					)
				),
				
				// Form fields text
				array(
					"id"        => "scheme-5-input-text-color",
					"title"     => esc_html__( "Input Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of input field text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".wrapper .color-scheme-5 input, .wrapper .color-scheme-5 input[type='text'], .wrapper .color-scheme-5 input[type='email'], .wrapper .color-scheme-5 input[type='search'], .wrapper .color-scheme-5 input[type='url'], .wrapper .color-scheme-5 input[type='tel'], .wrapper .color-scheme-5 input[type='password'], .wrapper .color-scheme-5 input[type='datetime'], .wrapper .color-scheme-5 input[type='date'], .wrapper .color-scheme-5 input[type='month'], .wrapper .color-scheme-5 input[type='week'], .wrapper .color-scheme-5 input[type='time'], .wrapper .color-scheme-5 input[type='datetime-local'], .wrapper .color-scheme-5 input[type='number'], .wrapper .color-scheme-5 textarea, .wrapper .color-scheme-5 select"
					)
				),
				
				// Form fields border
				array(
					"id"        => "scheme-5-input-border-color",
					"title"     => esc_html__( "Input Field Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-5 input, .wrapper .color-scheme-5 input[type='text'], .wrapper .color-scheme-5 input[type='email'], .wrapper .color-scheme-5 input[type='search'], .wrapper .color-scheme-5 input[type='url'], .wrapper .color-scheme-5 input[type='tel'], .wrapper .color-scheme-5 input[type='password'], .wrapper .color-scheme-5 input[type='datetime'], .wrapper .color-scheme-5 input[type='date'], .wrapper .color-scheme-5 input[type='month'], .wrapper .color-scheme-5 input[type='week'], .wrapper .color-scheme-5 input[type='time'], .wrapper .color-scheme-5 input[type='datetime-local'], .wrapper .color-scheme-5 input[type='number'], .wrapper .color-scheme-5 textarea, .wrapper .color-scheme-5 select"
					)
				),
				
				// Form fields focused border
				array(
					"id"        => "scheme-5-input-border-focused-color",
					"title"     => esc_html__( "Input Field Border Focused", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders when focused.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-5 input:focus, .wrapper .color-scheme-5 input[type='text']:focus, .wrapper .color-scheme-5 input[type='email']:focus, .wrapper .color-scheme-5 input[type='search']:focus, .wrapper .color-scheme-5 input[type='url']:focus, .wrapper .color-scheme-5 input[type='tel']:focus, .wrapper .color-scheme-5 input[type='password']:focus, .wrapper .color-scheme-5 input[type='datetime']:focus, .wrapper .color-scheme-5 input[type='date']:focus, .wrapper .color-scheme-5 input[type='month']:focus, .wrapper .color-scheme-5 input[type='week']:focus, .wrapper .color-scheme-5 input[type='time']:focus, .wrapper .color-scheme-5 input[type='datetime-local']:focus, .wrapper .color-scheme-5 input[type='number']:focus, .wrapper .color-scheme-5 textarea:focus, .wrapper .color-scheme-5 select:focus"
					)
				),
				
				// Separators / Borders
				array(
					"id"        => "scheme-5-divider-color",
					"title"     => esc_html__( "Separator", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separators and borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-5 pre, body.search .color-scheme-5 .section-wrapper article + article, .color-scheme-5 .boxed_content, .color-scheme-5.single-post-navigation .blog-link, .color-scheme-5.single-post-navigation a"
					)
				),
				
				// Separators Text
				array(
					"id"        => "scheme-5-divider-text-color",
					"title"     => esc_html__( "Separator Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separator text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-5 .vc_separator h4"
					)
				),
				
				// Gallery Hover 
				array(
					"id"        => "scheme-5-gallery-caption-bg-color",
					"title"     => esc_html__( "Gallery Caption Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour for gallery image captions.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-5 .gallery-caption, .color-scheme-5 .post-grid-item-content-bg"
					)
				),
				
				// Gallery Icon 
				array(
					"id"        => "scheme-5-gallery-caption-icon-color",
					"title"     => esc_html__( "Gallery Caption Icon", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption icons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color"	=> ".color-scheme-5 .wp-caption-content span:before"
					)
				),
				
				// Gallery Text
				array(
					"id"        => "scheme-5-gallery-caption-text-color",
					"title"     => esc_html__( "Gallery Caption Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color"	=> ".color-scheme-5 .wp-caption-content, .color-scheme-5 .wp-caption-content h3"
					)
				),
				
				// Button
				array(
					"id"        => "scheme-5-button-color",
					"title"     => esc_html__( "Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for buttons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-5 .video_lightbox .play:after, .wrapper .color-scheme-5 input[type='button']:hover, .wrapper .color-scheme-5 input[type='submit']:hover, .wrapper .color-scheme-5 button:hover, .wrapper .color-scheme-5 button[type='submit']:hover, .wrapper .color-scheme-5 input[type='reset']:hover, .color-scheme-5 .tagcloud a:hover, .color-scheme-5 .vc_btn3:after, .color-scheme-5 .posts-list article:hover, .color-scheme-5 .wpb_text_column ul li:before",
						"border-color"		=> ".color-scheme-5 .video_lightbox .play, .color-scheme-5 .vc_btn3, .color-scheme-5 .post-meta .vc_btn3, .wrapper .color-scheme-5 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-5 .vc_custom_heading .vc_btn3:hover, .wrapper .color-scheme-5 input[type='button'], .wrapper .color-scheme-5 input[type='submit'], .wrapper .color-scheme-5 button, .wrapper .color-scheme-5 button[type='submit'], .wrapper .color-scheme-5 input[type='reset'], .color-scheme-5 .tagcloud a, .wrapper .color-scheme-5 input[type='button']:disabled, .wrapper .color-scheme-5 input[type='submit']:disabled, .wrapper .color-scheme-5 button:disabled, .wrapper .color-scheme-5 input[type='button']:disabled:hover, .wrapper .color-scheme-5 input[type='submit']:disabled:hover, .wrapper .color-scheme-5 button:disabled:hover",
						"color"				=> ".color-scheme-5 .video_lightbox .play, .color-scheme-5 .vc_btn3, .color-scheme-5 .post-meta .vc_btn3, .wrapper .color-scheme-5 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-5 input[type='button'], .wrapper .color-scheme-5 input[type='submit'], .wrapper .color-scheme-5 button, .wrapper .color-scheme-5 button[type='submit'], .wrapper .color-scheme-5 input[type='reset'], .color-scheme-5 .tagcloud a, .wrapper .color-scheme-5 input[type='button']:disabled, .wrapper .color-scheme-5 input[type='submit']:disabled, .wrapper .color-scheme-5 button:disabled, .wrapper .color-scheme-5 input[type='button']:disabled:hover, .wrapper .color-scheme-5 input[type='submit']:disabled:hover, .wrapper .color-scheme-5 button:disabled:hover",
					)
				),
				
				// Button hover text
				array(
					"id"        => "scheme-5-button-text-hover-color",
					"title"     => esc_html__( "Button Text Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of button text when hovered over.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 .vc_btn3:hover, .color-scheme-5 .post-meta .vc_btn3:hover, .color-scheme-5 .video_lightbox .play:hover, .wrapper .color-scheme-5 .vc_custom_heading .vc_btn3:hover, .color-scheme-5 .posts-list article:hover, .color-scheme-5 .posts-list article:hover a, .color-scheme-5 .tagcloud a:hover, .wrapper .color-scheme-5 input[type='button']:hover, .wrapper .color-scheme-5 input[type='submit']:hover, .wrapper .color-scheme-5 button:hover, .wrapper .color-scheme-5 button[type='submit']:hover, .wrapper .color-scheme-5 input[type='reset']:hover, .color-scheme-5 .wpb_text_column ul li:before"
					)
				),
				
				// Secondary Button
				array(
					"id"        => "scheme-5-secondary-button-color",
					"title"     => esc_html__( "Secondary Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for secondary buttons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-5 .vc_btn3.btn-color-secondary:after",
						"border-color"		=> ".color-scheme-5 .vc_btn3.btn-color-secondary",
						"color"				=> ".color-scheme-5 .vc_btn3.btn-color-secondary",
					)
				),
				
				// Secondary button hover text
				array(
					"id"        => "scheme-5-secondary-button-text-hover-color",
					"title"     => esc_html__( "Secondary Button Hover Text", 'experience' ),
					"desc"		=> esc_html__( "Select the secondary button hover text color.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 .vc_btn3.btn-color-secondary:hover"
					)
				),
				
				// Quote text
				array(
					"id"        => "scheme-5-quote-color",
					"title"     => esc_html__( "Quote", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for quote text", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-5 blockquote p"
					)
				),
				
				// Scroll Buttons
				array(
					"id"        => "scheme-5-scroll-button-color",
					"title"     => esc_html__( "Scroll Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of header scroll arrow button.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 .section-scroll-link"
					)
				),				
				
				// Toggle content background
				array(
					"id"        => "scheme-5-tta-background-color",
					"title"     => esc_html__( "Toggle Content Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content backgrounds.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading:hover, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel .vc_tta-panel-body, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-list, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tabs-list, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active, .color-scheme-5 .wpb_wrapper .vc_toggle_title, .color-scheme-5 .vc_toggle .vc_toggle_content, .color-scheme-5 .posts-list article"
					)
				),
				
				// Toggle content title
				array(
					"id"        => "scheme-5-tta-title-color",
					"title"     => esc_html__( "Toggle Content Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for toggle content ttiles", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a:hover, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a:hover, .color-scheme-5 .vc_toggle_title a, .color-scheme-5 .posts-list article a"
					)
				),
				
				// Toggle content title hover
				array(
					"id"        => "scheme-5-tta-title-hover-color",
					"title"     => esc_html__( "Toggle Content Title Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content titles when hovered over.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a:hover, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a:hover, .color-scheme-5 .vc_toggle .vc_toggle_title a:hover"
					)
				),
				
				// Toggle content text
				array(
					"id"        => "scheme-5-tta-text-color",
					"title"     => esc_html__( "Toggle Content Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 .vc_toggle_content, .color-scheme-5 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-body, .color-scheme-5 .posts-list"
					)
				),
				
				// Comment Navigation arrow
				array(
					"id"        => "scheme-5-comments-navigation-arrow-color",
					"title"     => esc_html__( "Comments Navigation Arrow", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-5 .comments-navigation a"
					)
				),				
				
				// Comment navigation border
				array(
					"id"        => "scheme-5-comments-navigation-border-color",
					"title"     => esc_html__( "Comments Navigation Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-5 .comments-navigation div",	
						"background-color"	=> ".color-scheme-5 .comments-navigation div span:after"						
					)
				),	
				
				// Comment navigation arrow hover
				array(
					"id"        => "scheme-5-comments-navigation-arrow-hover-color",
					"title"     => esc_html__( "Comments Navigation Arrow Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrow when hovered.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-5 .comments-navigation a:hover"
					)
				),	
				
				
				// Comment navigation background hover
				array(
					"id"        => "scheme-5-comments-navigation-background-color",
					"title"     => esc_html__( "Comments-Navigation Background Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for comment navigation arrow background when hovered.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-5 .comments-navigation a:hover span:after"					
					)
				),
				
				// Comment alternate background
				array(
					"id"        => "scheme-5-comments-alt-background",
					"title"     => esc_html__( "Comment Alternate Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour of alternate post comments.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-5 .comment.odd > .comment-holder, .color-scheme-5 .comment.odd > #respond"
					)
				)
				
			)
		) );
		
		
		// ----- COLOUR SCHEME 6 ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Colour Scheme 6", 'experience' ),
			"id"         => "style-color-6",
			"subsection" => true,
			"desc"       => esc_html__( "Colour schemes can be applied to page headers, page sections, visual composer sections and columns.", 'experience' ),
			"fields"     => array(
				
				// Colour Scheme 6 Label
				array(
					"id"        => "scheme-6-label",
					"title"     => esc_html__( "Colour Scheme 6 Label", 'experience' ),
					"desc"		=> esc_html__( "Make this colour scheme easier to identify with a descriptive label.", 'experience' ),
					"type"      => "text"
				),
				
				// Accent
				array(
					"id"        => "scheme-6-accent-color",
					"title"     => esc_html__( "Accent", 'experience' ),
					"desc"		=> esc_html__( "Select the accent colour.", 'experience' ),
					"type"      => "color",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-6 .heading-label:after, .color-scheme-6 .boxed_content h1:after, .color-scheme-6 .boxed_content h2:after, .color-scheme-6 .boxed_content h3:after, .color-scheme-6 .boxed_content h4:after, .color-scheme-6 .boxed_content h5:after, .color-scheme-6 .boxed_content h6:after",
						"border-color"		=> ".color-scheme-6 blockquote",
						"color"				=> ".color-scheme-6 .flexslider-small .slide-subtitle"
					)
				),
				
				// Background
				array(
					"id"        => "scheme-6-background-color",
					"title"     => esc_html__( "Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for the content area background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-6.section-header, .color-scheme-6.section-content-wrapper, .color-scheme-6.vc_row, .vc_row .color-scheme-6.vc_column_container, .color-scheme-6.portfolio-meta"
					)
				),
				
				// Page Label
				array(
					"id"        => "scheme-6-page-label-color",
					"title"     => esc_html__( "Label", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page labels (appears above page titles).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-6 .heading-label"
					)
				),
				
				// Page Title
				array(
					"id"        => "scheme-6-page-title-color",
					"title"     => esc_html__( "Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page titles.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 .heading-title, .color-scheme-6 .flexslider-small p, .color-scheme-6 .post-grid-item-content h1, .color-scheme-6 .post-grid-item-content h2, .color-scheme-6 .post-grid-item-content h3"
					)
				),
				
				// Page Intro
				array(
					"id"        => "scheme-6-page-subtitle-color",
					"title"     => esc_html__( "Subtitle", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page subtitles.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-6 .heading-subtitle, .color-scheme-6 .post-meta, .color-scheme-6 .post-meta a, .color-scheme-6 .post-meta a:hover"
					)
				),			

				// h1
				array(
					"id"        => "scheme-6-h1-color",
					"title"     => esc_html__( "Header 1", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H1 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 h1"
					)
				),
				
				// h2
				array(
					"id"        => "scheme-6-h2-color",
					"title"     => esc_html__( "Header 2", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H2 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 h2"
					)
				),
				
				// h3
				array(
					"id"        => "scheme-6-h3-color",
					"title"     => esc_html__( "Header 3", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H3 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 h3"
					)
				),
				
				// h4
				array(
					"id"        => "scheme-6-h4-color",
					"title"     => esc_html__( "Header 4", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H4 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 h4"
					)
				),
				
				// h5
				array(
					"id"        => "scheme-6-h5-color",
					"title"     => esc_html__( "Header 5", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H5 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 h5, .color-scheme-6 .wpb_accordion_header a, .color-scheme-6 .vc_toggle_title a"
					)
				),
				
				// h6
				array(
					"id"        => "scheme-6-h6-color",
					"title"     => esc_html__( "Header 6", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H6 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 h6"
					)
				),					
				
				// Text
				array(
					"id"        => "scheme-6-text-color",
					"title"     => esc_html__( "Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for body text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-6, .color-scheme-6.section-header, .color-scheme-6.section-content-wrapper, .color-scheme-6 label"
					)
				),					
				
				// Subtext
				array(
					"id"        => "scheme-6-subtext-color",
					"title"     => esc_html__( "Subtext", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for subtext (cite, captions etc).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-6 .wp-caption .wp-caption-text, .color-scheme-6 blockquote cite, .color-scheme-6 .comment-date a, body.search .color-scheme-6 .post-permalink"
					)
				),
				
				// Link
				array(
					"id"        => "scheme-6-link-color",
					"title"     => esc_html__( "Link", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 a"
					)
				),
				
				// Link Hover
				array(
					"id"        => "scheme-6-link-hover-color",
					"title"     => esc_html__( "Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text hover state.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 a:hover, .color-scheme-6 .comment-date a:hover"
					)
				),
				
				// Slider Arrows
				array(
					"id"        => "scheme-6-slider-arrow-color",
					"title"     => esc_html__( "Slider Arrows", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-6 .flex-direction-nav a"
					)
				),
				
				// Slider Arrows Border
				array(
					"id"        => "scheme-6-slider-arrow-border-color",
					"title"     => esc_html__( "Slider Arrow Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".color-scheme-6 .flex-direction-nav li, .color-scheme-6 .flex-direction-nav li + li"
					)
				),
				
				// Slider Pagination Border
				array(
					"id"        => "scheme-6-slider-pagination-border-color",
					"title"     => esc_html__( "Slider Pagination Border", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button border colour.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=>	array(
						"border-color"		=> ".color-scheme-6 .vc_slide.vc_images_carousel .vc_carousel-indicators li, .color-scheme-6 .wp-link-pages .pagination-button, .color-scheme-6 .flexslider-big .flex-control-paging li a",
						"background-color"	=> ".color-scheme-6 .flexslider-big .flex-control-paging li:before, .color-scheme-6 .wp-link-pages .pagination-separator"
					)
				),				
				
				// Slider Pagination Fill
				array(
					"id"        => "scheme-6-slider-pagination-fill-color",
					"title"     => esc_html__( "Slider Pagination Fill", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button fill colour.", 'experience' ),
					"type"      => "color",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-6 .vc_slide.vc_images_carousel .vc_carousel-indicators li:hover, .color-scheme-6 .vc_slide.vc_images_carousel .vc_carousel-indicators li.vc_active, .color-scheme-6 .flexslider-big .flex-control-paging li a:after, .color-scheme-6 .wp-link-pages .pagination-button:after"
					)
				),
				
				// Table Header Background
				array(
					"id"        => "scheme-6-table-header-color",
					"title"     => esc_html__( "Table Header Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-6 th"
					)
				),
				
				// Table Header Text
				array(
					"id"        => "scheme-6-table-header-text-color",
					"title"     => esc_html__( "Table Header Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 th"
					)
				),
				
				// Table background
				array(
					"id"        => "scheme-6-table-bg-color",
					"title"     => esc_html__( "Table Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-6 td"
					)
				),
				
				// Table Text
				array(
					"id"        => "scheme-6-table-text-color",
					"title"     => esc_html__( "Table Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 table"
					)
				),
				
				// Form fields text
				array(
					"id"        => "scheme-6-input-text-color",
					"title"     => esc_html__( "Input Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of input field text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".wrapper .color-scheme-6 input, .wrapper .color-scheme-6 input[type='text'], .wrapper .color-scheme-6 input[type='email'], .wrapper .color-scheme-6 input[type='search'], .wrapper .color-scheme-6 input[type='url'], .wrapper .color-scheme-6 input[type='tel'], .wrapper .color-scheme-6 input[type='password'], .wrapper .color-scheme-6 input[type='datetime'], .wrapper .color-scheme-6 input[type='date'], .wrapper .color-scheme-6 input[type='month'], .wrapper .color-scheme-6 input[type='week'], .wrapper .color-scheme-6 input[type='time'], .wrapper .color-scheme-6 input[type='datetime-local'], .wrapper .color-scheme-6 input[type='number'], .wrapper .color-scheme-6 textarea, .wrapper .color-scheme-6 select"
					)
				),
				
				// Form fields border
				array(
					"id"        => "scheme-6-input-border-color",
					"title"     => esc_html__( "Input Field Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-6 input, .wrapper .color-scheme-6 input[type='text'], .wrapper .color-scheme-6 input[type='email'], .wrapper .color-scheme-6 input[type='search'], .wrapper .color-scheme-6 input[type='url'], .wrapper .color-scheme-6 input[type='tel'], .wrapper .color-scheme-6 input[type='password'], .wrapper .color-scheme-6 input[type='datetime'], .wrapper .color-scheme-6 input[type='date'], .wrapper .color-scheme-6 input[type='month'], .wrapper .color-scheme-6 input[type='week'], .wrapper .color-scheme-6 input[type='time'], .wrapper .color-scheme-6 input[type='datetime-local'], .wrapper .color-scheme-6 input[type='number'], .wrapper .color-scheme-6 textarea, .wrapper .color-scheme-6 select"
					)
				),
				
				// Form fields focused border
				array(
					"id"        => "scheme-6-input-border-focused-color",
					"title"     => esc_html__( "Input Field Border Focused", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders when focused.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-6 input:focus, .wrapper .color-scheme-6 input[type='text']:focus, .wrapper .color-scheme-6 input[type='email']:focus, .wrapper .color-scheme-6 input[type='search']:focus, .wrapper .color-scheme-6 input[type='url']:focus, .wrapper .color-scheme-6 input[type='tel']:focus, .wrapper .color-scheme-6 input[type='password']:focus, .wrapper .color-scheme-6 input[type='datetime']:focus, .wrapper .color-scheme-6 input[type='date']:focus, .wrapper .color-scheme-6 input[type='month']:focus, .wrapper .color-scheme-6 input[type='week']:focus, .wrapper .color-scheme-6 input[type='time']:focus, .wrapper .color-scheme-6 input[type='datetime-local']:focus, .wrapper .color-scheme-6 input[type='number']:focus, .wrapper .color-scheme-6 textarea:focus, .wrapper .color-scheme-6 select:focus"
					)
				),
				
				// Separators / Borders
				array(
					"id"        => "scheme-6-divider-color",
					"title"     => esc_html__( "Separator", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separators and borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-6 pre, body.search .color-scheme-6 .section-wrapper article + article, .color-scheme-6 .boxed_content, .color-scheme-6.single-post-navigation .blog-link, .color-scheme-6.single-post-navigation a"
					)
				),
				
				// Separators Text
				array(
					"id"        => "scheme-6-divider-text-color",
					"title"     => esc_html__( "Separator Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separator text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-6 .vc_separator h4"
					)
				),
				
				// Gallery Hover 
				array(
					"id"        => "scheme-6-gallery-caption-bg-color",
					"title"     => esc_html__( "Gallery Caption Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour for gallery image captions.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-6 .gallery-caption, .color-scheme-6 .post-grid-item-content-bg"
					)
				),
				
				// Gallery Icon 
				array(
					"id"        => "scheme-6-gallery-caption-icon-color",
					"title"     => esc_html__( "Gallery Caption Icon", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption icons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color"	=> ".color-scheme-6 .wp-caption-content span:before"
					)
				),
				
				// Gallery Text
				array(
					"id"        => "scheme-6-gallery-caption-text-color",
					"title"     => esc_html__( "Gallery Caption Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color"	=> ".color-scheme-6 .wp-caption-content, .color-scheme-6 .wp-caption-content h3"
					)
				),
				
				// Button
				array(
					"id"        => "scheme-6-button-color",
					"title"     => esc_html__( "Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for buttons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-6 .video_lightbox .play:after, .wrapper .color-scheme-6 input[type='button']:hover, .wrapper .color-scheme-6 input[type='submit']:hover, .wrapper .color-scheme-6 button:hover, .wrapper .color-scheme-6 button[type='submit']:hover, .wrapper .color-scheme-6 input[type='reset']:hover, .color-scheme-6 .tagcloud a:hover, .color-scheme-6 .vc_btn3:after, .color-scheme-6 .posts-list article:hover, .color-scheme-6 .wpb_text_column ul li:before",
						"border-color"		=> ".color-scheme-6 .video_lightbox .play, .color-scheme-6 .vc_btn3, .color-scheme-6 .post-meta .vc_btn3, .wrapper .color-scheme-6 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-6 .vc_custom_heading .vc_btn3:hover, .wrapper .color-scheme-6 input[type='button'], .wrapper .color-scheme-6 input[type='submit'], .wrapper .color-scheme-6 button, .wrapper .color-scheme-6 button[type='submit'], .wrapper .color-scheme-6 input[type='reset'], .color-scheme-6 .tagcloud a, .wrapper .color-scheme-6 input[type='button']:disabled, .wrapper .color-scheme-6 input[type='submit']:disabled, .wrapper .color-scheme-6 button:disabled, .wrapper .color-scheme-6 input[type='button']:disabled:hover, .wrapper .color-scheme-6 input[type='submit']:disabled:hover, .wrapper .color-scheme-6 button:disabled:hover",
						"color"				=> ".color-scheme-6 .video_lightbox .play, .color-scheme-6 .vc_btn3, .color-scheme-6 .post-meta .vc_btn3, .wrapper .color-scheme-6 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-6 input[type='button'], .wrapper .color-scheme-6 input[type='submit'], .wrapper .color-scheme-6 button, .wrapper .color-scheme-6 button[type='submit'], .wrapper .color-scheme-6 input[type='reset'], .color-scheme-6 .tagcloud a, .wrapper .color-scheme-6 input[type='button']:disabled, .wrapper .color-scheme-6 input[type='submit']:disabled, .wrapper .color-scheme-6 button:disabled, .wrapper .color-scheme-6 input[type='button']:disabled:hover, .wrapper .color-scheme-6 input[type='submit']:disabled:hover, .wrapper .color-scheme-6 button:disabled:hover",
					)
				),
				
				// Button hover text
				array(
					"id"        => "scheme-6-button-text-hover-color",
					"title"     => esc_html__( "Button Text Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of button text when hovered over.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 .vc_btn3:hover, .color-scheme-6 .post-meta .vc_btn3:hover, .color-scheme-6 .video_lightbox .play:hover, .wrapper .color-scheme-6 .vc_custom_heading .vc_btn3:hover, .color-scheme-6 .posts-list article:hover, .color-scheme-6 .posts-list article:hover a, .color-scheme-6 .tagcloud a:hover, .wrapper .color-scheme-6 input[type='button']:hover, .wrapper .color-scheme-6 input[type='submit']:hover, .wrapper .color-scheme-6 button:hover, .wrapper .color-scheme-6 button[type='submit']:hover, .wrapper .color-scheme-6 input[type='reset']:hover, .color-scheme-6 .wpb_text_column ul li:before"
					)
				),
				
				// Secondary Button
				array(
					"id"        => "scheme-6-secondary-button-color",
					"title"     => esc_html__( "Secondary Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for secondary buttons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-6 .vc_btn3.btn-color-secondary:after",
						"border-color"		=> ".color-scheme-6 .vc_btn3.btn-color-secondary",
						"color"				=> ".color-scheme-6 .vc_btn3.btn-color-secondary",
					)
				),
				
				// Secondary button hover text
				array(
					"id"        => "scheme-6-secondary-button-text-hover-color",
					"title"     => esc_html__( "Secondary Button Hover Text", 'experience' ),
					"desc"		=> esc_html__( "Select the secondary button hover text color.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 .vc_btn3.btn-color-secondary:hover"
					)
				),
				
				// Quote text
				array(
					"id"        => "scheme-6-quote-color",
					"title"     => esc_html__( "Quote", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for quote text", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-6 blockquote p"
					)
				),
				
				// Scroll Buttons
				array(
					"id"        => "scheme-6-scroll-button-color",
					"title"     => esc_html__( "Scroll Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of header scroll arrow button.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 .section-scroll-link"
					)
				),				
				
				// Toggle content background
				array(
					"id"        => "scheme-6-tta-background-color",
					"title"     => esc_html__( "Toggle Content Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content backgrounds.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading:hover, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel .vc_tta-panel-body, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-list, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tabs-list, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active, .color-scheme-6 .wpb_wrapper .vc_toggle_title, .color-scheme-6 .vc_toggle .vc_toggle_content, .color-scheme-6 .posts-list article"
					)
				),
				
				// Toggle content title
				array(
					"id"        => "scheme-6-tta-title-color",
					"title"     => esc_html__( "Toggle Content Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for toggle content ttiles", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a:hover, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a:hover, .color-scheme-6 .vc_toggle_title a, .color-scheme-6 .posts-list article a"
					)
				),
				
				// Toggle content title hover
				array(
					"id"        => "scheme-6-tta-title-hover-color",
					"title"     => esc_html__( "Toggle Content Title Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content titles when hovered over.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a:hover, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a:hover, .color-scheme-6 .vc_toggle .vc_toggle_title a:hover"
					)
				),
				
				// Toggle content text
				array(
					"id"        => "scheme-6-tta-text-color",
					"title"     => esc_html__( "Toggle Content Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 .vc_toggle_content, .color-scheme-6 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-body, .color-scheme-6 .posts-list"
					)
				),
				
				// Comment Navigation arrow
				array(
					"id"        => "scheme-6-comments-navigation-arrow-color",
					"title"     => esc_html__( "Comments Navigation Arrow", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-6 .comments-navigation a"
					)
				),				
				
				// Comment navigation border
				array(
					"id"        => "scheme-6-comments-navigation-border-color",
					"title"     => esc_html__( "Comments Navigation Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-6 .comments-navigation div",	
						"background-color"	=> ".color-scheme-6 .comments-navigation div span:after"						
					)
				),	
				
				// Comment navigation arrow hover
				array(
					"id"        => "scheme-6-comments-navigation-arrow-hover-color",
					"title"     => esc_html__( "Comments Navigation Arrow Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrow when hovered.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-6 .comments-navigation a:hover"
					)
				),	
				
				
				// Comment navigation background hover
				array(
					"id"        => "scheme-6-comments-navigation-background-color",
					"title"     => esc_html__( "Comments-Navigation Background Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for comment navigation arrow background when hovered.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-6 .comments-navigation a:hover span:after"					
					)
				),
				
				// Comment alternate background
				array(
					"id"        => "scheme-6-comments-alt-background",
					"title"     => esc_html__( "Comment Alternate Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour of alternate post comments.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-6 .comment.odd > .comment-holder, .color-scheme-6 .comment.odd > #respond"
					)
				)
				
			)
		) );
		
		
		// ----- COLOUR SCHEME 7 ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Colour Scheme 7", 'experience' ),
			"id"         => "style-color-7",
			"subsection" => true,
			"desc"       => esc_html__( "Colour schemes can be applied to page headers, page sections, visual composer sections and columns.", 'experience' ),
			"fields"     => array(
				
				// Colour Scheme 7 Label
				array(
					"id"        => "scheme-7-label",
					"title"     => esc_html__( "Colour Scheme 7 Label", 'experience' ),
					"desc"		=> esc_html__( "Make this colour scheme easier to identify with a descriptive label.", 'experience' ),
					"type"      => "text"
				),
				
				// Accent
				array(
					"id"        => "scheme-7-accent-color",
					"title"     => esc_html__( "Accent", 'experience' ),
					"desc"		=> esc_html__( "Select the accent colour.", 'experience' ),
					"type"      => "color",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-7 .heading-label:after, .color-scheme-7 .boxed_content h1:after, .color-scheme-7 .boxed_content h2:after, .color-scheme-7 .boxed_content h3:after, .color-scheme-7 .boxed_content h4:after, .color-scheme-7 .boxed_content h5:after, .color-scheme-7 .boxed_content h6:after",
						"border-color"		=> ".color-scheme-7 blockquote",
						"color"				=> ".color-scheme-7 .flexslider-small .slide-subtitle"
					)
				),
				
				// Background
				array(
					"id"        => "scheme-7-background-color",
					"title"     => esc_html__( "Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for the content area background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-7.section-header, .color-scheme-7.section-content-wrapper, .color-scheme-7.vc_row, .vc_row .color-scheme-7.vc_column_container, .color-scheme-7.portfolio-meta"
					)
				),
				
				// Page Label
				array(
					"id"        => "scheme-7-page-label-color",
					"title"     => esc_html__( "Label", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page labels (appears above page titles).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-7 .heading-label"
					)
				),
				
				// Page Title
				array(
					"id"        => "scheme-7-page-title-color",
					"title"     => esc_html__( "Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page titles.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 .heading-title, .color-scheme-7 .flexslider-small p, .color-scheme-7 .post-grid-item-content h1, .color-scheme-7 .post-grid-item-content h2, .color-scheme-7 .post-grid-item-content h3"
					)
				),
				
				// Page Intro
				array(
					"id"        => "scheme-7-page-subtitle-color",
					"title"     => esc_html__( "Subtitle", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page subtitles.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-7 .heading-subtitle, .color-scheme-7 .post-meta, .color-scheme-7 .post-meta a, .color-scheme-7 .post-meta a:hover"
					)
				),			

				// h1
				array(
					"id"        => "scheme-7-h1-color",
					"title"     => esc_html__( "Header 1", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H1 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 h1"
					)
				),
				
				// h2
				array(
					"id"        => "scheme-7-h2-color",
					"title"     => esc_html__( "Header 2", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H2 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 h2"
					)
				),
				
				// h3
				array(
					"id"        => "scheme-7-h3-color",
					"title"     => esc_html__( "Header 3", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H3 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 h3"
					)
				),
				
				// h4
				array(
					"id"        => "scheme-7-h4-color",
					"title"     => esc_html__( "Header 4", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H4 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 h4"
					)
				),
				
				// h5
				array(
					"id"        => "scheme-7-h5-color",
					"title"     => esc_html__( "Header 5", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H5 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 h5, .color-scheme-7 .wpb_accordion_header a, .color-scheme-7 .vc_toggle_title a"
					)
				),
				
				// h6
				array(
					"id"        => "scheme-7-h6-color",
					"title"     => esc_html__( "Header 6", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H6 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 h6"
					)
				),					
				
				// Text
				array(
					"id"        => "scheme-7-text-color",
					"title"     => esc_html__( "Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for body text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-7, .color-scheme-7.section-header, .color-scheme-7.section-content-wrapper, .color-scheme-7 label"
					)
				),					
				
				// Subtext
				array(
					"id"        => "scheme-7-subtext-color",
					"title"     => esc_html__( "Subtext", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for subtext (cite, captions etc).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-7 .wp-caption .wp-caption-text, .color-scheme-7 blockquote cite, .color-scheme-7 .comment-date a, body.search .color-scheme-7 .post-permalink"
					)
				),
				
				// Link
				array(
					"id"        => "scheme-7-link-color",
					"title"     => esc_html__( "Link", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 a"
					)
				),
				
				// Link Hover
				array(
					"id"        => "scheme-7-link-hover-color",
					"title"     => esc_html__( "Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text hover state.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 a:hover, .color-scheme-7 .comment-date a:hover"
					)
				),
				
				// Slider Arrows
				array(
					"id"        => "scheme-7-slider-arrow-color",
					"title"     => esc_html__( "Slider Arrows", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-7 .flex-direction-nav a"
					)
				),
				
				// Slider Arrows Border
				array(
					"id"        => "scheme-7-slider-arrow-border-color",
					"title"     => esc_html__( "Slider Arrow Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".color-scheme-7 .flex-direction-nav li, .color-scheme-7 .flex-direction-nav li + li"
					)
				),
				
				// Slider Pagination Border
				array(
					"id"        => "scheme-7-slider-pagination-border-color",
					"title"     => esc_html__( "Slider Pagination Border", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button border colour.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=>	array(
						"border-color"		=> ".color-scheme-7 .vc_slide.vc_images_carousel .vc_carousel-indicators li, .color-scheme-7 .wp-link-pages .pagination-button, .color-scheme-7 .flexslider-big .flex-control-paging li a",
						"background-color"	=> ".color-scheme-7 .flexslider-big .flex-control-paging li:before, .color-scheme-7 .wp-link-pages .pagination-separator"
					)
				),				
				
				// Slider Pagination Fill
				array(
					"id"        => "scheme-7-slider-pagination-fill-color",
					"title"     => esc_html__( "Slider Pagination Fill", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button fill colour.", 'experience' ),
					"type"      => "color",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-7 .vc_slide.vc_images_carousel .vc_carousel-indicators li:hover, .color-scheme-7 .vc_slide.vc_images_carousel .vc_carousel-indicators li.vc_active, .color-scheme-7 .flexslider-big .flex-control-paging li a:after, .color-scheme-7 .wp-link-pages .pagination-button:after"
					)
				),
				
				// Table Header Background
				array(
					"id"        => "scheme-7-table-header-color",
					"title"     => esc_html__( "Table Header Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-7 th"
					)
				),
				
				// Table Header Text
				array(
					"id"        => "scheme-7-table-header-text-color",
					"title"     => esc_html__( "Table Header Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 th"
					)
				),
				
				// Table background
				array(
					"id"        => "scheme-7-table-bg-color",
					"title"     => esc_html__( "Table Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-7 td"
					)
				),
				
				// Table Text
				array(
					"id"        => "scheme-7-table-text-color",
					"title"     => esc_html__( "Table Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 table"
					)
				),
				
				// Form fields text
				array(
					"id"        => "scheme-7-input-text-color",
					"title"     => esc_html__( "Input Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of input field text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".wrapper .color-scheme-7 input, .wrapper .color-scheme-7 input[type='text'], .wrapper .color-scheme-7 input[type='email'], .wrapper .color-scheme-7 input[type='search'], .wrapper .color-scheme-7 input[type='url'], .wrapper .color-scheme-7 input[type='tel'], .wrapper .color-scheme-7 input[type='password'], .wrapper .color-scheme-7 input[type='datetime'], .wrapper .color-scheme-7 input[type='date'], .wrapper .color-scheme-7 input[type='month'], .wrapper .color-scheme-7 input[type='week'], .wrapper .color-scheme-7 input[type='time'], .wrapper .color-scheme-7 input[type='datetime-local'], .wrapper .color-scheme-7 input[type='number'], .wrapper .color-scheme-7 textarea, .wrapper .color-scheme-7 select"
					)
				),
				
				// Form fields border
				array(
					"id"        => "scheme-7-input-border-color",
					"title"     => esc_html__( "Input Field Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-7 input, .wrapper .color-scheme-7 input[type='text'], .wrapper .color-scheme-7 input[type='email'], .wrapper .color-scheme-7 input[type='search'], .wrapper .color-scheme-7 input[type='url'], .wrapper .color-scheme-7 input[type='tel'], .wrapper .color-scheme-7 input[type='password'], .wrapper .color-scheme-7 input[type='datetime'], .wrapper .color-scheme-7 input[type='date'], .wrapper .color-scheme-7 input[type='month'], .wrapper .color-scheme-7 input[type='week'], .wrapper .color-scheme-7 input[type='time'], .wrapper .color-scheme-7 input[type='datetime-local'], .wrapper .color-scheme-7 input[type='number'], .wrapper .color-scheme-7 textarea, .wrapper .color-scheme-7 select"
					)
				),
				
				// Form fields focused border
				array(
					"id"        => "scheme-7-input-border-focused-color",
					"title"     => esc_html__( "Input Field Border Focused", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders when focused.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-7 input:focus, .wrapper .color-scheme-7 input[type='text']:focus, .wrapper .color-scheme-7 input[type='email']:focus, .wrapper .color-scheme-7 input[type='search']:focus, .wrapper .color-scheme-7 input[type='url']:focus, .wrapper .color-scheme-7 input[type='tel']:focus, .wrapper .color-scheme-7 input[type='password']:focus, .wrapper .color-scheme-7 input[type='datetime']:focus, .wrapper .color-scheme-7 input[type='date']:focus, .wrapper .color-scheme-7 input[type='month']:focus, .wrapper .color-scheme-7 input[type='week']:focus, .wrapper .color-scheme-7 input[type='time']:focus, .wrapper .color-scheme-7 input[type='datetime-local']:focus, .wrapper .color-scheme-7 input[type='number']:focus, .wrapper .color-scheme-7 textarea:focus, .wrapper .color-scheme-7 select:focus"
					)
				),
				
				// Separators / Borders
				array(
					"id"        => "scheme-7-divider-color",
					"title"     => esc_html__( "Separator", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separators and borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-7 pre, body.search .color-scheme-7 .section-wrapper article + article, .color-scheme-7 .boxed_content, .color-scheme-7.single-post-navigation .blog-link, .color-scheme-7.single-post-navigation a"
					)
				),
				
				// Separators Text
				array(
					"id"        => "scheme-7-divider-text-color",
					"title"     => esc_html__( "Separator Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separator text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-7 .vc_separator h4"
					)
				),
				
				// Gallery Hover 
				array(
					"id"        => "scheme-7-gallery-caption-bg-color",
					"title"     => esc_html__( "Gallery Caption Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour for gallery image captions.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-7 .gallery-caption, .color-scheme-7 .post-grid-item-content-bg"
					)
				),
				
				// Gallery Icon 
				array(
					"id"        => "scheme-7-gallery-caption-icon-color",
					"title"     => esc_html__( "Gallery Caption Icon", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption icons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color"	=> ".color-scheme-7 .wp-caption-content span:before"
					)
				),
				
				// Gallery Text
				array(
					"id"        => "scheme-7-gallery-caption-text-color",
					"title"     => esc_html__( "Gallery Caption Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color"	=> ".color-scheme-7 .wp-caption-content, .color-scheme-7 .wp-caption-content h3"
					)
				),
				
				// Button
				array(
					"id"        => "scheme-7-button-color",
					"title"     => esc_html__( "Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for buttons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-7 .video_lightbox .play:after, .wrapper .color-scheme-7 input[type='button']:hover, .wrapper .color-scheme-7 input[type='submit']:hover, .wrapper .color-scheme-7 button:hover, .wrapper .color-scheme-7 button[type='submit']:hover, .wrapper .color-scheme-7 input[type='reset']:hover, .color-scheme-7 .tagcloud a:hover, .color-scheme-7 .vc_btn3:after, .color-scheme-7 .posts-list article:hover, .color-scheme-7 .wpb_text_column ul li:before",
						"border-color"		=> ".color-scheme-7 .video_lightbox .play, .color-scheme-7 .vc_btn3, .color-scheme-7 .post-meta .vc_btn3, .wrapper .color-scheme-7 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-7 .vc_custom_heading .vc_btn3:hover, .wrapper .color-scheme-7 input[type='button'], .wrapper .color-scheme-7 input[type='submit'], .wrapper .color-scheme-7 button, .wrapper .color-scheme-7 button[type='submit'], .wrapper .color-scheme-7 input[type='reset'], .color-scheme-7 .tagcloud a, .wrapper .color-scheme-7 input[type='button']:disabled, .wrapper .color-scheme-7 input[type='submit']:disabled, .wrapper .color-scheme-7 button:disabled, .wrapper .color-scheme-7 input[type='button']:disabled:hover, .wrapper .color-scheme-7 input[type='submit']:disabled:hover, .wrapper .color-scheme-7 button:disabled:hover",
						"color"				=> ".color-scheme-7 .video_lightbox .play, .color-scheme-7 .vc_btn3, .color-scheme-7 .post-meta .vc_btn3, .wrapper .color-scheme-7 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-7 input[type='button'], .wrapper .color-scheme-7 input[type='submit'], .wrapper .color-scheme-7 button, .wrapper .color-scheme-7 button[type='submit'], .wrapper .color-scheme-7 input[type='reset'], .color-scheme-7 .tagcloud a, .wrapper .color-scheme-7 input[type='button']:disabled, .wrapper .color-scheme-7 input[type='submit']:disabled, .wrapper .color-scheme-7 button:disabled, .wrapper .color-scheme-7 input[type='button']:disabled:hover, .wrapper .color-scheme-7 input[type='submit']:disabled:hover, .wrapper .color-scheme-7 button:disabled:hover",
					)
				),
				
				// Button hover text
				array(
					"id"        => "scheme-7-button-text-hover-color",
					"title"     => esc_html__( "Button Text Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of button text when hovered over.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 .vc_btn3:hover, .color-scheme-7 .post-meta .vc_btn3:hover, .color-scheme-7 .video_lightbox .play:hover, .wrapper .color-scheme-7 .vc_custom_heading .vc_btn3:hover, .color-scheme-7 .posts-list article:hover, .color-scheme-7 .posts-list article:hover a, .color-scheme-7 .tagcloud a:hover, .wrapper .color-scheme-7 input[type='button']:hover, .wrapper .color-scheme-7 input[type='submit']:hover, .wrapper .color-scheme-7 button:hover, .wrapper .color-scheme-7 button[type='submit']:hover, .wrapper .color-scheme-7 input[type='reset']:hover, .color-scheme-7 .wpb_text_column ul li:before"
					)
				),
				
				// Secondary Button
				array(
					"id"        => "scheme-7-secondary-button-color",
					"title"     => esc_html__( "Secondary Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for secondary buttons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-7 .vc_btn3.btn-color-secondary:after",
						"border-color"		=> ".color-scheme-7 .vc_btn3.btn-color-secondary",
						"color"				=> ".color-scheme-7 .vc_btn3.btn-color-secondary",
					)
				),
				
				// Secondary button hover text
				array(
					"id"        => "scheme-7-secondary-button-text-hover-color",
					"title"     => esc_html__( "Secondary Button Hover Text", 'experience' ),
					"desc"		=> esc_html__( "Select the secondary button hover text color.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 .vc_btn3.btn-color-secondary:hover"
					)
				),
				
				// Quote text
				array(
					"id"        => "scheme-7-quote-color",
					"title"     => esc_html__( "Quote", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for quote text", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-7 blockquote p"
					)
				),
				
				// Scroll Buttons
				array(
					"id"        => "scheme-7-scroll-button-color",
					"title"     => esc_html__( "Scroll Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of header scroll arrow button.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 .section-scroll-link"
					)
				),				
				
				// Toggle content background
				array(
					"id"        => "scheme-7-tta-background-color",
					"title"     => esc_html__( "Toggle Content Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content backgrounds.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading:hover, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel .vc_tta-panel-body, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-list, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tabs-list, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active, .color-scheme-7 .wpb_wrapper .vc_toggle_title, .color-scheme-7 .vc_toggle .vc_toggle_content, .color-scheme-7 .posts-list article"
					)
				),
				
				// Toggle content title
				array(
					"id"        => "scheme-7-tta-title-color",
					"title"     => esc_html__( "Toggle Content Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for toggle content ttiles", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a:hover, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a:hover, .color-scheme-7 .vc_toggle_title a, .color-scheme-7 .posts-list article a"
					)
				),
				
				// Toggle content title hover
				array(
					"id"        => "scheme-7-tta-title-hover-color",
					"title"     => esc_html__( "Toggle Content Title Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content titles when hovered over.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a:hover, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a:hover, .color-scheme-7 .vc_toggle .vc_toggle_title a:hover"
					)
				),
				
				// Toggle content text
				array(
					"id"        => "scheme-7-tta-text-color",
					"title"     => esc_html__( "Toggle Content Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 .vc_toggle_content, .color-scheme-7 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-body, .color-scheme-7 .posts-list"
					)
				),
				
				// Comment Navigation arrow
				array(
					"id"        => "scheme-7-comments-navigation-arrow-color",
					"title"     => esc_html__( "Comments Navigation Arrow", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-7 .comments-navigation a"
					)
				),				
				
				// Comment navigation border
				array(
					"id"        => "scheme-7-comments-navigation-border-color",
					"title"     => esc_html__( "Comments Navigation Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-7 .comments-navigation div",	
						"background-color"	=> ".color-scheme-7 .comments-navigation div span:after"						
					)
				),	
				
				// Comment navigation arrow hover
				array(
					"id"        => "scheme-7-comments-navigation-arrow-hover-color",
					"title"     => esc_html__( "Comments Navigation Arrow Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrow when hovered.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-7 .comments-navigation a:hover"
					)
				),	
				
				
				// Comment navigation background hover
				array(
					"id"        => "scheme-7-comments-navigation-background-color",
					"title"     => esc_html__( "Comments-Navigation Background Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for comment navigation arrow background when hovered.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-7 .comments-navigation a:hover span:after"					
					)
				),
				
				// Comment alternate background
				array(
					"id"        => "scheme-7-comments-alt-background",
					"title"     => esc_html__( "Comment Alternate Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour of alternate post comments.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-7 .comment.odd > .comment-holder, .color-scheme-7 .comment.odd > #respond"
					)
				)
				
			)
		) );
		
		
		// ----- COLOUR SCHEME 8 ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Colour Scheme 8", 'experience' ),
			"id"         => "style-color-8",
			"subsection" => true,
			"desc"       => esc_html__( "Colour schemes can be applied to page headers, page sections, visual composer sections and columns.", 'experience' ),
			"fields"     => array(
				
				// Colour Scheme 8 Label
				array(
					"id"        => "scheme-8-label",
					"title"     => esc_html__( "Colour Scheme 8 Label", 'experience' ),
					"desc"		=> esc_html__( "Make this colour scheme easier to identify with a descriptive label.", 'experience' ),
					"type"      => "text"
				),
				
				// Accent
				array(
					"id"        => "scheme-8-accent-color",
					"title"     => esc_html__( "Accent", 'experience' ),
					"desc"		=> esc_html__( "Select the accent colour.", 'experience' ),
					"type"      => "color",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-8 .heading-label:after, .color-scheme-8 .boxed_content h1:after, .color-scheme-8 .boxed_content h2:after, .color-scheme-8 .boxed_content h3:after, .color-scheme-8 .boxed_content h4:after, .color-scheme-8 .boxed_content h5:after, .color-scheme-8 .boxed_content h6:after",
						"border-color"		=> ".color-scheme-8 blockquote",
						"color"				=> ".color-scheme-8 .flexslider-small .slide-subtitle"
					)
				),
				
				// Background
				array(
					"id"        => "scheme-8-background-color",
					"title"     => esc_html__( "Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for the content area background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-8.section-header, .color-scheme-8.section-content-wrapper, .color-scheme-8.vc_row, .vc_row .color-scheme-8.vc_column_container, .color-scheme-8.portfolio-meta"
					)
				),
				
				// Page Label
				array(
					"id"        => "scheme-8-page-label-color",
					"title"     => esc_html__( "Label", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page labels (appears above page titles).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-8 .heading-label"
					)
				),
				
				// Page Title
				array(
					"id"        => "scheme-8-page-title-color",
					"title"     => esc_html__( "Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page titles.", 'experience' ),
					"type"      => "color",					
					"compiler"	=> array(
						"color" => ".color-scheme-8 .heading-title, .color-scheme-8 .flexslider-small p, .color-scheme-8 .post-grid-item-content h1, .color-scheme-8 .post-grid-item-content h2, .color-scheme-8 .post-grid-item-content h3"
					)
				),
				
				// Page Intro
				array(
					"id"        => "scheme-8-page-subtitle-color",
					"title"     => esc_html__( "Subtitle", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page subtitles.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-8 .heading-subtitle, .color-scheme-8 .post-meta, .color-scheme-8 .post-meta a, .color-scheme-8 .post-meta a:hover"
					)
				),			

				// h1
				array(
					"id"        => "scheme-8-h1-color",
					"title"     => esc_html__( "Header 1", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H1 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 h1"
					)
				),
				
				// h2
				array(
					"id"        => "scheme-8-h2-color",
					"title"     => esc_html__( "Header 2", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H2 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 h2"
					)
				),
				
				// h3
				array(
					"id"        => "scheme-8-h3-color",
					"title"     => esc_html__( "Header 3", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H3 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 h3"
					)
				),
				
				// h4
				array(
					"id"        => "scheme-8-h4-color",
					"title"     => esc_html__( "Header 4", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H4 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 h4"
					)
				),
				
				// h5
				array(
					"id"        => "scheme-8-h5-color",
					"title"     => esc_html__( "Header 5", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H5 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 h5, .color-scheme-8 .wpb_accordion_header a, .color-scheme-8 .vc_toggle_title a"
					)
				),
				
				// h6
				array(
					"id"        => "scheme-8-h6-color",
					"title"     => esc_html__( "Header 6", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H6 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 h6"
					)
				),					
				
				// Text
				array(
					"id"        => "scheme-8-text-color",
					"title"     => esc_html__( "Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for body text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-8, .color-scheme-8.section-header, .color-scheme-8.section-content-wrapper, .color-scheme-8 label"
					)
				),					
				
				// Subtext
				array(
					"id"        => "scheme-8-subtext-color",
					"title"     => esc_html__( "Subtext", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for subtext (cite, captions etc).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-8 .wp-caption .wp-caption-text, .color-scheme-8 blockquote cite, .color-scheme-8 .comment-date a, body.search .color-scheme-8 .post-permalink"
					)
				),
				
				// Link
				array(
					"id"        => "scheme-8-link-color",
					"title"     => esc_html__( "Link", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 a"
					)
				),
				
				// Link Hover
				array(
					"id"        => "scheme-8-link-hover-color",
					"title"     => esc_html__( "Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text hover state.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 a:hover, .color-scheme-8 .comment-date a:hover"
					)
				),
				
				// Slider Arrows
				array(
					"id"        => "scheme-8-slider-arrow-color",
					"title"     => esc_html__( "Slider Arrows", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-8 .flex-direction-nav a"
					)
				),
				
				// Slider Arrows Border
				array(
					"id"        => "scheme-8-slider-arrow-border-color",
					"title"     => esc_html__( "Slider Arrow Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".color-scheme-8 .flex-direction-nav li, .color-scheme-8 .flex-direction-nav li + li"
					)
				),
				
				// Slider Pagination Border
				array(
					"id"        => "scheme-8-slider-pagination-border-color",
					"title"     => esc_html__( "Slider Pagination Border", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button border colour.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=>	array(
						"border-color"		=> ".color-scheme-8 .vc_slide.vc_images_carousel .vc_carousel-indicators li, .color-scheme-8 .wp-link-pages .pagination-button, .color-scheme-8 .flexslider-big .flex-control-paging li a",
						"background-color"	=> ".color-scheme-8 .flexslider-big .flex-control-paging li:before, .color-scheme-8 .wp-link-pages .pagination-separator"
					)
				),				
				
				// Slider Pagination Fill
				array(
					"id"        => "scheme-8-slider-pagination-fill-color",
					"title"     => esc_html__( "Slider Pagination Fill", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button fill colour.", 'experience' ),
					"type"      => "color",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-8 .vc_slide.vc_images_carousel .vc_carousel-indicators li:hover, .color-scheme-8 .vc_slide.vc_images_carousel .vc_carousel-indicators li.vc_active, .color-scheme-8 .flexslider-big .flex-control-paging li a:after, .color-scheme-8 .wp-link-pages .pagination-button:after"
					)
				),
				
				// Table Header Background
				array(
					"id"        => "scheme-8-table-header-color",
					"title"     => esc_html__( "Table Header Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-8 th"
					)
				),
				
				// Table Header Text
				array(
					"id"        => "scheme-8-table-header-text-color",
					"title"     => esc_html__( "Table Header Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 th"
					)
				),
				
				// Table background
				array(
					"id"        => "scheme-8-table-bg-color",
					"title"     => esc_html__( "Table Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-8 td"
					)
				),
				
				// Table Text
				array(
					"id"        => "scheme-8-table-text-color",
					"title"     => esc_html__( "Table Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 table"
					)
				),
				
				// Form fields text
				array(
					"id"        => "scheme-8-input-text-color",
					"title"     => esc_html__( "Input Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of input field text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".wrapper .color-scheme-8 input, .wrapper .color-scheme-8 input[type='text'], .wrapper .color-scheme-8 input[type='email'], .wrapper .color-scheme-8 input[type='search'], .wrapper .color-scheme-8 input[type='url'], .wrapper .color-scheme-8 input[type='tel'], .wrapper .color-scheme-8 input[type='password'], .wrapper .color-scheme-8 input[type='datetime'], .wrapper .color-scheme-8 input[type='date'], .wrapper .color-scheme-8 input[type='month'], .wrapper .color-scheme-8 input[type='week'], .wrapper .color-scheme-8 input[type='time'], .wrapper .color-scheme-8 input[type='datetime-local'], .wrapper .color-scheme-8 input[type='number'], .wrapper .color-scheme-8 textarea, .wrapper .color-scheme-8 select"
					)
				),
				
				// Form fields border
				array(
					"id"        => "scheme-8-input-border-color",
					"title"     => esc_html__( "Input Field Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-8 input, .wrapper .color-scheme-8 input[type='text'], .wrapper .color-scheme-8 input[type='email'], .wrapper .color-scheme-8 input[type='search'], .wrapper .color-scheme-8 input[type='url'], .wrapper .color-scheme-8 input[type='tel'], .wrapper .color-scheme-8 input[type='password'], .wrapper .color-scheme-8 input[type='datetime'], .wrapper .color-scheme-8 input[type='date'], .wrapper .color-scheme-8 input[type='month'], .wrapper .color-scheme-8 input[type='week'], .wrapper .color-scheme-8 input[type='time'], .wrapper .color-scheme-8 input[type='datetime-local'], .wrapper .color-scheme-8 input[type='number'], .wrapper .color-scheme-8 textarea, .wrapper .color-scheme-8 select"
					)
				),
				
				// Form fields focused border
				array(
					"id"        => "scheme-8-input-border-focused-color",
					"title"     => esc_html__( "Input Field Border Focused", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders when focused.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-8 input:focus, .wrapper .color-scheme-8 input[type='text']:focus, .wrapper .color-scheme-8 input[type='email']:focus, .wrapper .color-scheme-8 input[type='search']:focus, .wrapper .color-scheme-8 input[type='url']:focus, .wrapper .color-scheme-8 input[type='tel']:focus, .wrapper .color-scheme-8 input[type='password']:focus, .wrapper .color-scheme-8 input[type='datetime']:focus, .wrapper .color-scheme-8 input[type='date']:focus, .wrapper .color-scheme-8 input[type='month']:focus, .wrapper .color-scheme-8 input[type='week']:focus, .wrapper .color-scheme-8 input[type='time']:focus, .wrapper .color-scheme-8 input[type='datetime-local']:focus, .wrapper .color-scheme-8 input[type='number']:focus, .wrapper .color-scheme-8 textarea:focus, .wrapper .color-scheme-8 select:focus"
					)
				),
				
				// Separators / Borders
				array(
					"id"        => "scheme-8-divider-color",
					"title"     => esc_html__( "Separator", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separators and borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-8 pre, body.search .color-scheme-8 .section-wrapper article + article, .color-scheme-8 .boxed_content, .color-scheme-8.single-post-navigation .blog-link, .color-scheme-8.single-post-navigation a"
					)
				),
				
				// Separators Text
				array(
					"id"        => "scheme-8-divider-text-color",
					"title"     => esc_html__( "Separator Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separator text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-8 .vc_separator h4"
					)
				),
				
				// Gallery Hover 
				array(
					"id"        => "scheme-8-gallery-caption-bg-color",
					"title"     => esc_html__( "Gallery Caption Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour for gallery image captions.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-8 .gallery-caption, .color-scheme-8 .post-grid-item-content-bg"
					)
				),
				
				// Gallery Icon 
				array(
					"id"        => "scheme-8-gallery-caption-icon-color",
					"title"     => esc_html__( "Gallery Caption Icon", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption icons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color"	=> ".color-scheme-8 .wp-caption-content span:before"
					)
				),
				
				// Gallery Text
				array(
					"id"        => "scheme-8-gallery-caption-text-color",
					"title"     => esc_html__( "Gallery Caption Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color"	=> ".color-scheme-8 .wp-caption-content, .color-scheme-8 .wp-caption-content h3"
					)
				),
				
				// Button
				array(
					"id"        => "scheme-8-button-color",
					"title"     => esc_html__( "Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for buttons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-8 .video_lightbox .play:after, .wrapper .color-scheme-8 input[type='button']:hover, .wrapper .color-scheme-8 input[type='submit']:hover, .wrapper .color-scheme-8 button:hover, .wrapper .color-scheme-8 button[type='submit']:hover, .wrapper .color-scheme-8 input[type='reset']:hover, .color-scheme-8 .tagcloud a:hover, .color-scheme-8 .vc_btn3:after, .color-scheme-8 .posts-list article:hover, .color-scheme-8 .wpb_text_column ul li:before",
						"border-color"		=> ".color-scheme-8 .video_lightbox .play, .color-scheme-8 .vc_btn3, .color-scheme-8 .post-meta .vc_btn3, .wrapper .color-scheme-8 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-8 .vc_custom_heading .vc_btn3:hover, .wrapper .color-scheme-8 input[type='button'], .wrapper .color-scheme-8 input[type='submit'], .wrapper .color-scheme-8 button, .wrapper .color-scheme-8 button[type='submit'], .wrapper .color-scheme-8 input[type='reset'], .color-scheme-8 .tagcloud a, .wrapper .color-scheme-8 input[type='button']:disabled, .wrapper .color-scheme-8 input[type='submit']:disabled, .wrapper .color-scheme-8 button:disabled, .wrapper .color-scheme-8 input[type='button']:disabled:hover, .wrapper .color-scheme-8 input[type='submit']:disabled:hover, .wrapper .color-scheme-8 button:disabled:hover",
						"color"				=> ".color-scheme-8 .video_lightbox .play, .color-scheme-8 .vc_btn3, .color-scheme-8 .post-meta .vc_btn3, .wrapper .color-scheme-8 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-8 input[type='button'], .wrapper .color-scheme-8 input[type='submit'], .wrapper .color-scheme-8 button, .wrapper .color-scheme-8 button[type='submit'], .wrapper .color-scheme-8 input[type='reset'], .color-scheme-8 .tagcloud a, .wrapper .color-scheme-8 input[type='button']:disabled, .wrapper .color-scheme-8 input[type='submit']:disabled, .wrapper .color-scheme-8 button:disabled, .wrapper .color-scheme-8 input[type='button']:disabled:hover, .wrapper .color-scheme-8 input[type='submit']:disabled:hover, .wrapper .color-scheme-8 button:disabled:hover",
					)
				),
				
				// Button hover text
				array(
					"id"        => "scheme-8-button-text-hover-color",
					"title"     => esc_html__( "Button Text Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of button text when hovered over.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 .vc_btn3:hover, .color-scheme-8 .post-meta .vc_btn3:hover, .color-scheme-8 .video_lightbox .play:hover, .wrapper .color-scheme-8 .vc_custom_heading .vc_btn3:hover, .color-scheme-8 .posts-list article:hover, .color-scheme-8 .posts-list article:hover a, .color-scheme-8 .tagcloud a:hover, .wrapper .color-scheme-8 input[type='button']:hover, .wrapper .color-scheme-8 input[type='submit']:hover, .wrapper .color-scheme-8 button:hover, .wrapper .color-scheme-8 button[type='submit']:hover, .wrapper .color-scheme-8 input[type='reset']:hover, .color-scheme-8 .wpb_text_column ul li:before"
					)
				),
				
				// Secondary Button
				array(
					"id"        => "scheme-8-secondary-button-color",
					"title"     => esc_html__( "Secondary Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for secondary buttons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-8 .vc_btn3.btn-color-secondary:after",
						"border-color"		=> ".color-scheme-8 .vc_btn3.btn-color-secondary",
						"color"				=> ".color-scheme-8 .vc_btn3.btn-color-secondary",
					)
				),
				
				// Secondary button hover text
				array(
					"id"        => "scheme-8-secondary-button-text-hover-color",
					"title"     => esc_html__( "Secondary Button Hover Text", 'experience' ),
					"desc"		=> esc_html__( "Select the secondary button hover text color.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 .vc_btn3.btn-color-secondary:hover"
					)
				),
				
				// Quote text
				array(
					"id"        => "scheme-8-quote-color",
					"title"     => esc_html__( "Quote", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for quote text", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-8 blockquote p"
					)
				),
				
				// Scroll Buttons
				array(
					"id"        => "scheme-8-scroll-button-color",
					"title"     => esc_html__( "Scroll Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of header scroll arrow button.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 .section-scroll-link"
					)
				),				
				
				// Toggle content background
				array(
					"id"        => "scheme-8-tta-background-color",
					"title"     => esc_html__( "Toggle Content Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content backgrounds.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading:hover, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel .vc_tta-panel-body, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-list, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tabs-list, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active, .color-scheme-8 .wpb_wrapper .vc_toggle_title, .color-scheme-8 .vc_toggle .vc_toggle_content, .color-scheme-8 .posts-list article"
					)
				),
				
				// Toggle content title
				array(
					"id"        => "scheme-8-tta-title-color",
					"title"     => esc_html__( "Toggle Content Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for toggle content ttiles", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a:hover, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a:hover, .color-scheme-8 .vc_toggle_title a, .color-scheme-8 .posts-list article a"
					)
				),
				
				// Toggle content title hover
				array(
					"id"        => "scheme-8-tta-title-hover-color",
					"title"     => esc_html__( "Toggle Content Title Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content titles when hovered over.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a:hover, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a:hover, .color-scheme-8 .vc_toggle .vc_toggle_title a:hover"
					)
				),
				
				// Toggle content text
				array(
					"id"        => "scheme-8-tta-text-color",
					"title"     => esc_html__( "Toggle Content Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 .vc_toggle_content, .color-scheme-8 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-body, .color-scheme-8 .posts-list"
					)
				),
				
				// Comment Navigation arrow
				array(
					"id"        => "scheme-8-comments-navigation-arrow-color",
					"title"     => esc_html__( "Comments Navigation Arrow", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-8 .comments-navigation a"
					)
				),				
				
				// Comment navigation border
				array(
					"id"        => "scheme-8-comments-navigation-border-color",
					"title"     => esc_html__( "Comments Navigation Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-8 .comments-navigation div",	
						"background-color"	=> ".color-scheme-8 .comments-navigation div span:after"						
					)
				),	
				
				// Comment navigation arrow hover
				array(
					"id"        => "scheme-8-comments-navigation-arrow-hover-color",
					"title"     => esc_html__( "Comments Navigation Arrow Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrow when hovered.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-8 .comments-navigation a:hover"
					)
				),	
				
				
				// Comment navigation background hover
				array(
					"id"        => "scheme-8-comments-navigation-background-color",
					"title"     => esc_html__( "Comments-Navigation Background Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for comment navigation arrow background when hovered.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-8 .comments-navigation a:hover span:after"					
					)
				),
				
				// Comment alternate background
				array(
					"id"        => "scheme-8-comments-alt-background",
					"title"     => esc_html__( "Comment Alternate Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour of alternate post comments.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-8 .comment.odd > .comment-holder, .color-scheme-8 .comment.odd > #respond"
					)
				)
				
			)
		) );
		
		
		// ----- COLOUR SCHEME 9 ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Colour Scheme 9", 'experience' ),
			"id"         => "style-color-9",
			"subsection" => true,
			"desc"       => esc_html__( "Colour schemes can be applied to page headers, page sections, visual composer sections and columns.", 'experience' ),
			"fields"     => array(
				
				// Colour Scheme 9 Label
				array(
					"id"        => "scheme-9-label",
					"title"     => esc_html__( "Colour Scheme 9 Label", 'experience' ),
					"desc"		=> esc_html__( "Make this colour scheme easier to identify with a descriptive label.", 'experience' ),
					"type"      => "text"
				),
				
				// Accent
				array(
					"id"        => "scheme-9-accent-color",
					"title"     => esc_html__( "Accent", 'experience' ),
					"desc"		=> esc_html__( "Select the accent colour.", 'experience' ),
					"type"      => "color",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-9 .heading-label:after, .color-scheme-9 .boxed_content h1:after, .color-scheme-9 .boxed_content h2:after, .color-scheme-9 .boxed_content h3:after, .color-scheme-9 .boxed_content h4:after, .color-scheme-9 .boxed_content h5:after, .color-scheme-9 .boxed_content h6:after",
						"border-color"		=> ".color-scheme-9 blockquote",
						"color"				=> ".color-scheme-9 .flexslider-small .slide-subtitle"
					)
				),
				
				// Background
				array(
					"id"        => "scheme-9-background-color",
					"title"     => esc_html__( "Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for the content area background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-9.section-header, .color-scheme-9.section-content-wrapper, .color-scheme-9.vc_row, .vc_row .color-scheme-9.vc_column_container, .color-scheme-9.portfolio-meta"
					)
				),
				
				// Page Label
				array(
					"id"        => "scheme-9-page-label-color",
					"title"     => esc_html__( "Label", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page labels (appears above page titles).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-9 .heading-label"
					)
				),
				
				// Page Title
				array(
					"id"        => "scheme-9-page-title-color",
					"title"     => esc_html__( "Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page titles.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 .heading-title, .color-scheme-9 .flexslider-small p, .color-scheme-9 .post-grid-item-content h1, .color-scheme-9 .post-grid-item-content h2, .color-scheme-9 .post-grid-item-content h3"
					)
				),
				
				// Page Intro
				array(
					"id"        => "scheme-9-page-subtitle-color",
					"title"     => esc_html__( "Subtitle", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page subtitles.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-9 .heading-subtitle, .color-scheme-9 .post-meta, .color-scheme-9 .post-meta a, .color-scheme-9 .post-meta a:hover"
					)
				),			

				// h1
				array(
					"id"        => "scheme-9-h1-color",
					"title"     => esc_html__( "Header 1", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H1 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 h1"
					)
				),
				
				// h2
				array(
					"id"        => "scheme-9-h2-color",
					"title"     => esc_html__( "Header 2", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H2 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 h2"
					)
				),
				
				// h3
				array(
					"id"        => "scheme-9-h3-color",
					"title"     => esc_html__( "Header 3", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H3 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 h3"
					)
				),
				
				// h4
				array(
					"id"        => "scheme-9-h4-color",
					"title"     => esc_html__( "Header 4", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H4 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 h4"
					)
				),
				
				// h5
				array(
					"id"        => "scheme-9-h5-color",
					"title"     => esc_html__( "Header 5", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H5 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 h5, .color-scheme-9 .wpb_accordion_header a, .color-scheme-9 .vc_toggle_title a"
					)
				),
				
				// h6
				array(
					"id"        => "scheme-9-h6-color",
					"title"     => esc_html__( "Header 6", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H6 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 h6"
					)
				),					
				
				// Text
				array(
					"id"        => "scheme-9-text-color",
					"title"     => esc_html__( "Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for body text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-9, .color-scheme-9.section-header, .color-scheme-9.section-content-wrapper, .color-scheme-9 label"
					)
				),					
				
				// Subtext
				array(
					"id"        => "scheme-9-subtext-color",
					"title"     => esc_html__( "Subtext", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for subtext (cite, captions etc).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-9 .wp-caption .wp-caption-text, .color-scheme-9 blockquote cite, .color-scheme-9 .comment-date a, body.search .color-scheme-9 .post-permalink"
					)
				),
				
				// Link
				array(
					"id"        => "scheme-9-link-color",
					"title"     => esc_html__( "Link", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 a"
					)
				),
				
				// Link Hover
				array(
					"id"        => "scheme-9-link-hover-color",
					"title"     => esc_html__( "Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text hover state.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 a:hover, .color-scheme-9 .comment-date a:hover"
					)
				),
				
				// Slider Arrows
				array(
					"id"        => "scheme-9-slider-arrow-color",
					"title"     => esc_html__( "Slider Arrows", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-9 .flex-direction-nav a"
					)
				),
				
				// Slider Arrows Border
				array(
					"id"        => "scheme-9-slider-arrow-border-color",
					"title"     => esc_html__( "Slider Arrow Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".color-scheme-9 .flex-direction-nav li, .color-scheme-9 .flex-direction-nav li + li"
					)
				),
				
				// Slider Pagination Border
				array(
					"id"        => "scheme-9-slider-pagination-border-color",
					"title"     => esc_html__( "Slider Pagination Border", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button border colour.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=>	array(
						"border-color"		=> ".color-scheme-9 .vc_slide.vc_images_carousel .vc_carousel-indicators li, .color-scheme-9 .wp-link-pages .pagination-button, .color-scheme-9 .flexslider-big .flex-control-paging li a",
						"background-color"	=> ".color-scheme-9 .flexslider-big .flex-control-paging li:before, .color-scheme-9 .wp-link-pages .pagination-separator"
					)
				),				
				
				// Slider Pagination Fill
				array(
					"id"        => "scheme-9-slider-pagination-fill-color",
					"title"     => esc_html__( "Slider Pagination Fill", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button fill colour.", 'experience' ),
					"type"      => "color",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-9 .vc_slide.vc_images_carousel .vc_carousel-indicators li:hover, .color-scheme-9 .vc_slide.vc_images_carousel .vc_carousel-indicators li.vc_active, .color-scheme-9 .flexslider-big .flex-control-paging li a:after, .color-scheme-9 .wp-link-pages .pagination-button:after"
					)
				),
				
				// Table Header Background
				array(
					"id"        => "scheme-9-table-header-color",
					"title"     => esc_html__( "Table Header Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-9 th"
					)
				),
				
				// Table Header Text
				array(
					"id"        => "scheme-9-table-header-text-color",
					"title"     => esc_html__( "Table Header Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 th"
					)
				),
				
				// Table background
				array(
					"id"        => "scheme-9-table-bg-color",
					"title"     => esc_html__( "Table Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-9 td"
					)
				),
				
				// Table Text
				array(
					"id"        => "scheme-9-table-text-color",
					"title"     => esc_html__( "Table Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 table"
					)
				),
				
				// Form fields text
				array(
					"id"        => "scheme-9-input-text-color",
					"title"     => esc_html__( "Input Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of input field text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".wrapper .color-scheme-9 input, .wrapper .color-scheme-9 input[type='text'], .wrapper .color-scheme-9 input[type='email'], .wrapper .color-scheme-9 input[type='search'], .wrapper .color-scheme-9 input[type='url'], .wrapper .color-scheme-9 input[type='tel'], .wrapper .color-scheme-9 input[type='password'], .wrapper .color-scheme-9 input[type='datetime'], .wrapper .color-scheme-9 input[type='date'], .wrapper .color-scheme-9 input[type='month'], .wrapper .color-scheme-9 input[type='week'], .wrapper .color-scheme-9 input[type='time'], .wrapper .color-scheme-9 input[type='datetime-local'], .wrapper .color-scheme-9 input[type='number'], .wrapper .color-scheme-9 textarea, .wrapper .color-scheme-9 select"
					)
				),
				
				// Form fields border
				array(
					"id"        => "scheme-9-input-border-color",
					"title"     => esc_html__( "Input Field Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-9 input, .wrapper .color-scheme-9 input[type='text'], .wrapper .color-scheme-9 input[type='email'], .wrapper .color-scheme-9 input[type='search'], .wrapper .color-scheme-9 input[type='url'], .wrapper .color-scheme-9 input[type='tel'], .wrapper .color-scheme-9 input[type='password'], .wrapper .color-scheme-9 input[type='datetime'], .wrapper .color-scheme-9 input[type='date'], .wrapper .color-scheme-9 input[type='month'], .wrapper .color-scheme-9 input[type='week'], .wrapper .color-scheme-9 input[type='time'], .wrapper .color-scheme-9 input[type='datetime-local'], .wrapper .color-scheme-9 input[type='number'], .wrapper .color-scheme-9 textarea, .wrapper .color-scheme-9 select"
					)
				),
				
				// Form fields focused border
				array(
					"id"        => "scheme-9-input-border-focused-color",
					"title"     => esc_html__( "Input Field Border Focused", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders when focused.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-9 input:focus, .wrapper .color-scheme-9 input[type='text']:focus, .wrapper .color-scheme-9 input[type='email']:focus, .wrapper .color-scheme-9 input[type='search']:focus, .wrapper .color-scheme-9 input[type='url']:focus, .wrapper .color-scheme-9 input[type='tel']:focus, .wrapper .color-scheme-9 input[type='password']:focus, .wrapper .color-scheme-9 input[type='datetime']:focus, .wrapper .color-scheme-9 input[type='date']:focus, .wrapper .color-scheme-9 input[type='month']:focus, .wrapper .color-scheme-9 input[type='week']:focus, .wrapper .color-scheme-9 input[type='time']:focus, .wrapper .color-scheme-9 input[type='datetime-local']:focus, .wrapper .color-scheme-9 input[type='number']:focus, .wrapper .color-scheme-9 textarea:focus, .wrapper .color-scheme-9 select:focus"
					)
				),
				
				// Separators / Borders
				array(
					"id"        => "scheme-9-divider-color",
					"title"     => esc_html__( "Separator", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separators and borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-9 pre, body.search .color-scheme-9 .section-wrapper article + article, .color-scheme-9 .boxed_content, .color-scheme-9.single-post-navigation .blog-link, .color-scheme-9.single-post-navigation a"
					)
				),
				
				// Separators Text
				array(
					"id"        => "scheme-9-divider-text-color",
					"title"     => esc_html__( "Separator Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separator text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-9 .vc_separator h4"
					)
				),
				
				// Gallery Hover 
				array(
					"id"        => "scheme-9-gallery-caption-bg-color",
					"title"     => esc_html__( "Gallery Caption Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour for gallery image captions.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-9 .gallery-caption, .color-scheme-9 .post-grid-item-content-bg"
					)
				),
				
				// Gallery Icon 
				array(
					"id"        => "scheme-9-gallery-caption-icon-color",
					"title"     => esc_html__( "Gallery Caption Icon", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption icons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color"	=> ".color-scheme-9 .wp-caption-content span:before"
					)
				),
				
				// Gallery Text
				array(
					"id"        => "scheme-9-gallery-caption-text-color",
					"title"     => esc_html__( "Gallery Caption Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color"	=> ".color-scheme-9 .wp-caption-content, .color-scheme-9 .wp-caption-content h3"
					)
				),
				
				// Button
				array(
					"id"        => "scheme-9-button-color",
					"title"     => esc_html__( "Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for buttons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-9 .video_lightbox .play:after, .wrapper .color-scheme-9 input[type='button']:hover, .wrapper .color-scheme-9 input[type='submit']:hover, .wrapper .color-scheme-9 button:hover, .wrapper .color-scheme-9 button[type='submit']:hover, .wrapper .color-scheme-9 input[type='reset']:hover, .color-scheme-9 .tagcloud a:hover, .color-scheme-9 .vc_btn3:after, .color-scheme-9 .posts-list article:hover, .color-scheme-9 .wpb_text_column ul li:before",
						"border-color"		=> ".color-scheme-9 .video_lightbox .play, .color-scheme-9 .vc_btn3, .color-scheme-9 .post-meta .vc_btn3, .wrapper .color-scheme-9 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-9 .vc_custom_heading .vc_btn3:hover, .wrapper .color-scheme-9 input[type='button'], .wrapper .color-scheme-9 input[type='submit'], .wrapper .color-scheme-9 button, .wrapper .color-scheme-9 button[type='submit'], .wrapper .color-scheme-9 input[type='reset'], .color-scheme-9 .tagcloud a, .wrapper .color-scheme-9 input[type='button']:disabled, .wrapper .color-scheme-9 input[type='submit']:disabled, .wrapper .color-scheme-9 button:disabled, .wrapper .color-scheme-9 input[type='button']:disabled:hover, .wrapper .color-scheme-9 input[type='submit']:disabled:hover, .wrapper .color-scheme-9 button:disabled:hover",
						"color"				=> ".color-scheme-9 .video_lightbox .play, .color-scheme-9 .vc_btn3, .color-scheme-9 .post-meta .vc_btn3, .wrapper .color-scheme-9 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-9 input[type='button'], .wrapper .color-scheme-9 input[type='submit'], .wrapper .color-scheme-9 button, .wrapper .color-scheme-9 button[type='submit'], .wrapper .color-scheme-9 input[type='reset'], .color-scheme-9 .tagcloud a, .wrapper .color-scheme-9 input[type='button']:disabled, .wrapper .color-scheme-9 input[type='submit']:disabled, .wrapper .color-scheme-9 button:disabled, .wrapper .color-scheme-9 input[type='button']:disabled:hover, .wrapper .color-scheme-9 input[type='submit']:disabled:hover, .wrapper .color-scheme-9 button:disabled:hover",
					)
				),
				
				// Button hover text
				array(
					"id"        => "scheme-9-button-text-hover-color",
					"title"     => esc_html__( "Button Text Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of button text when hovered over.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 .vc_btn3:hover, .color-scheme-9 .post-meta .vc_btn3:hover, .color-scheme-9 .video_lightbox .play:hover, .wrapper .color-scheme-9 .vc_custom_heading .vc_btn3:hover, .color-scheme-9 .posts-list article:hover, .color-scheme-9 .posts-list article:hover a, .color-scheme-9 .tagcloud a:hover, .wrapper .color-scheme-9 input[type='button']:hover, .wrapper .color-scheme-9 input[type='submit']:hover, .wrapper .color-scheme-9 button:hover, .wrapper .color-scheme-9 button[type='submit']:hover, .wrapper .color-scheme-9 input[type='reset']:hover, .color-scheme-9 .wpb_text_column ul li:before"
					)
				),
				
				// Secondary Button
				array(
					"id"        => "scheme-9-secondary-button-color",
					"title"     => esc_html__( "Secondary Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for secondary buttons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-9 .vc_btn3.btn-color-secondary:after",
						"border-color"		=> ".color-scheme-9 .vc_btn3.btn-color-secondary",
						"color"				=> ".color-scheme-9 .vc_btn3.btn-color-secondary",
					)
				),
				
				// Secondary button hover text
				array(
					"id"        => "scheme-9-secondary-button-text-hover-color",
					"title"     => esc_html__( "Secondary Button Hover Text", 'experience' ),
					"desc"		=> esc_html__( "Select the secondary button hover text color.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 .vc_btn3.btn-color-secondary:hover"
					)
				),
				
				// Quote text
				array(
					"id"        => "scheme-9-quote-color",
					"title"     => esc_html__( "Quote", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for quote text", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-9 blockquote p"
					)
				),
				
				// Scroll Buttons
				array(
					"id"        => "scheme-9-scroll-button-color",
					"title"     => esc_html__( "Scroll Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of header scroll arrow button.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 .section-scroll-link"
					)
				),				
				
				// Toggle content background
				array(
					"id"        => "scheme-9-tta-background-color",
					"title"     => esc_html__( "Toggle Content Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content backgrounds.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading:hover, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel .vc_tta-panel-body, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-list, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tabs-list, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active, .color-scheme-9 .wpb_wrapper .vc_toggle_title, .color-scheme-9 .vc_toggle .vc_toggle_content, .color-scheme-9 .posts-list article"
					)
				),
				
				// Toggle content title
				array(
					"id"        => "scheme-9-tta-title-color",
					"title"     => esc_html__( "Toggle Content Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for toggle content ttiles", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a:hover, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a:hover, .color-scheme-9 .vc_toggle_title a, .color-scheme-9 .posts-list article a"
					)
				),
				
				// Toggle content title hover
				array(
					"id"        => "scheme-9-tta-title-hover-color",
					"title"     => esc_html__( "Toggle Content Title Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content titles when hovered over.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a:hover, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a:hover, .color-scheme-9 .vc_toggle .vc_toggle_title a:hover"
					)
				),
				
				// Toggle content text
				array(
					"id"        => "scheme-9-tta-text-color",
					"title"     => esc_html__( "Toggle Content Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 .vc_toggle_content, .color-scheme-9 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-body, .color-scheme-9 .posts-list"
					)
				),
				
				// Comment Navigation arrow
				array(
					"id"        => "scheme-9-comments-navigation-arrow-color",
					"title"     => esc_html__( "Comments Navigation Arrow", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-9 .comments-navigation a"
					)
				),				
				
				// Comment navigation border
				array(
					"id"        => "scheme-9-comments-navigation-border-color",
					"title"     => esc_html__( "Comments Navigation Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-9 .comments-navigation div",	
						"background-color"	=> ".color-scheme-9 .comments-navigation div span:after"						
					)
				),	
				
				// Comment navigation arrow hover
				array(
					"id"        => "scheme-9-comments-navigation-arrow-hover-color",
					"title"     => esc_html__( "Comments Navigation Arrow Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrow when hovered.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-9 .comments-navigation a:hover"
					)
				),	
				
				
				// Comment navigation background hover
				array(
					"id"        => "scheme-9-comments-navigation-background-color",
					"title"     => esc_html__( "Comments-Navigation Background Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for comment navigation arrow background when hovered.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-9 .comments-navigation a:hover span:after"					
					)
				),
				
				// Comment alternate background
				array(
					"id"        => "scheme-9-comments-alt-background",
					"title"     => esc_html__( "Comment Alternate Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour of alternate post comments.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-9 .comment.odd > .comment-holder, .color-scheme-9 .comment.odd > #respond"
					)
				)
				
			)
		) );
		
		
		// ----- COLOUR SCHEME 10 ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Colour Scheme 10", 'experience' ),
			"id"         => "style-color-10",
			"subsection" => true,
			"desc"       => esc_html__( "Colour schemes can be applied to page headers, page sections, visual composer sections and columns.", 'experience' ),
			"fields"     => array(
				
				// Colour Scheme 10 Label
				array(
					"id"        => "scheme-10-label",
					"title"     => esc_html__( "Colour Scheme 10 Label", 'experience' ),
					"desc"		=> esc_html__( "Make this colour scheme easier to identify with a descriptive label.", 'experience' ),
					"type"      => "text"
				),
				
				// Accent
				array(
					"id"        => "scheme-10-accent-color",
					"title"     => esc_html__( "Accent", 'experience' ),
					"desc"		=> esc_html__( "Select the accent colour.", 'experience' ),
					"type"      => "color",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-10 .heading-label:after, .color-scheme-10 .boxed_content h1:after, .color-scheme-10 .boxed_content h2:after, .color-scheme-10 .boxed_content h3:after, .color-scheme-10 .boxed_content h4:after, .color-scheme-10 .boxed_content h5:after, .color-scheme-10 .boxed_content h6:after",
						"border-color"		=> ".color-scheme-10 blockquote",
						"color"				=> ".color-scheme-10 .flexslider-small .slide-subtitle"
					)
				),
				
				// Background
				array(
					"id"        => "scheme-10-background-color",
					"title"     => esc_html__( "Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for the content area background.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-10.section-header, .color-scheme-10.section-content-wrapper, .color-scheme-10.vc_row, .vc_row .color-scheme-10.vc_column_container, .color-scheme-10.portfolio-meta"
					)
				),
				
				// Page Label
				array(
					"id"        => "scheme-10-page-label-color",
					"title"     => esc_html__( "Label", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page labels (appears above page titles).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-10 .heading-label"
					)
				),
				
				// Page Title
				array(
					"id"        => "scheme-10-page-title-color",
					"title"     => esc_html__( "Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page titles.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 .heading-title, .color-scheme-10 .flexslider-small p, .color-scheme-10 .post-grid-item-content h1, .color-scheme-10 .post-grid-item-content h2, .color-scheme-10 .post-grid-item-content h3"
					)
				),
				
				// Page Intro
				array(
					"id"        => "scheme-10-page-subtitle-color",
					"title"     => esc_html__( "Subtitle", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for page subtitles.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-10 .heading-subtitle, .color-scheme-10 .post-meta, .color-scheme-10 .post-meta a, .color-scheme-10 .post-meta a:hover"
					)
				),			

				// h1
				array(
					"id"        => "scheme-10-h1-color",
					"title"     => esc_html__( "Header 1", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H1 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 h1"
					)
				),
				
				// h2
				array(
					"id"        => "scheme-10-h2-color",
					"title"     => esc_html__( "Header 2", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H2 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 h2"
					)
				),
				
				// h3
				array(
					"id"        => "scheme-10-h3-color",
					"title"     => esc_html__( "Header 3", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H3 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 h3"
					)
				),
				
				// h4
				array(
					"id"        => "scheme-10-h4-color",
					"title"     => esc_html__( "Header 4", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H4 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 h4"
					)
				),
				
				// h5
				array(
					"id"        => "scheme-10-h5-color",
					"title"     => esc_html__( "Header 5", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H5 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 h5, .color-scheme-10 .wpb_accordion_header a, .color-scheme-10 .vc_toggle_title a"
					)
				),
				
				// h6
				array(
					"id"        => "scheme-10-h6-color",
					"title"     => esc_html__( "Header 6", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of H6 elements.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 h6"
					)
				),					
				
				// Text
				array(
					"id"        => "scheme-10-text-color",
					"title"     => esc_html__( "Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for body text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-10, .color-scheme-10.section-header, .color-scheme-10.section-content-wrapper, .color-scheme-10 label"
					)
				),					
				
				// Subtext
				array(
					"id"        => "scheme-10-subtext-color",
					"title"     => esc_html__( "Subtext", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for subtext (cite, captions etc).", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-10 .wp-caption .wp-caption-text, .color-scheme-10 blockquote cite, .color-scheme-10 .comment-date a, body.search .color-scheme-10 .post-permalink"
					)
				),
				
				// Link
				array(
					"id"        => "scheme-10-link-color",
					"title"     => esc_html__( "Link", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 a"
					)
				),
				
				// Link Hover
				array(
					"id"        => "scheme-10-link-hover-color",
					"title"     => esc_html__( "Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for link text hover state.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 a:hover, .color-scheme-10 .comment-date a:hover"
					)
				),
				
				// Slider Arrows
				array(
					"id"        => "scheme-10-slider-arrow-color",
					"title"     => esc_html__( "Slider Arrows", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-10 .flex-direction-nav a"
					)
				),
				
				// Slider Arrows Border
				array(
					"id"        => "scheme-10-slider-arrow-border-color",
					"title"     => esc_html__( "Slider Arrow Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for next/prev slide arrows border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".color-scheme-10 .flex-direction-nav li, .color-scheme-10 .flex-direction-nav li + li"
					)
				),
				
				// Slider Pagination Border
				array(
					"id"        => "scheme-10-slider-pagination-border-color",
					"title"     => esc_html__( "Slider Pagination Border", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button border colour.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=>	array(
						"border-color"		=> ".color-scheme-10 .vc_slide.vc_images_carousel .vc_carousel-indicators li, .color-scheme-10 .wp-link-pages .pagination-button, .color-scheme-10 .flexslider-big .flex-control-paging li a",
						"background-color"	=> ".color-scheme-10 .flexslider-big .flex-control-paging li:before, .color-scheme-10 .wp-link-pages .pagination-separator"
					)
				),				
				
				// Slider Pagination Fill
				array(
					"id"        => "scheme-10-slider-pagination-fill-color",
					"title"     => esc_html__( "Slider Pagination Fill", 'experience' ),
					"desc"		=> esc_html__( "Select the slider pagination button fill colour.", 'experience' ),
					"type"      => "color",
					"compiler"	=>	array(
						"background-color"	=> ".color-scheme-10 .vc_slide.vc_images_carousel .vc_carousel-indicators li:hover, .color-scheme-10 .vc_slide.vc_images_carousel .vc_carousel-indicators li.vc_active, .color-scheme-10 .flexslider-big .flex-control-paging li a:after, .color-scheme-10 .wp-link-pages .pagination-button:after"
					)
				),
				
				// Table Header Background
				array(
					"id"        => "scheme-10-table-header-color",
					"title"     => esc_html__( "Table Header Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header background.", 'experience' ),
					"type"      => "color",
					
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-10 th"
					)
				),
				
				// Table Header Text
				array(
					"id"        => "scheme-10-table-header-text-color",
					"title"     => esc_html__( "Table Header Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table header text.", 'experience' ),
					"type"      => "color",
					
					"compiler"	=> array(
						"color" => ".color-scheme-10 th"
					)
				),
				
				// Table background
				array(
					"id"        => "scheme-10-table-bg-color",
					"title"     => esc_html__( "Table Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table background.", 'experience' ),
					"type"      => "color",					
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-10 td"
					)
				),
				
				// Table Text
				array(
					"id"        => "scheme-10-table-text-color",
					"title"     => esc_html__( "Table Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for table text.", 'experience' ),
					"type"      => "color",					
					"compiler"	=> array(
						"color" => ".color-scheme-10 table"
					)
				),
				
				// Form fields text
				array(
					"id"        => "scheme-10-input-text-color",
					"title"     => esc_html__( "Input Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of input field text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".wrapper .color-scheme-10 input, .wrapper .color-scheme-10 input[type='text'], .wrapper .color-scheme-10 input[type='email'], .wrapper .color-scheme-10 input[type='search'], .wrapper .color-scheme-10 input[type='url'], .wrapper .color-scheme-10 input[type='tel'], .wrapper .color-scheme-10 input[type='password'], .wrapper .color-scheme-10 input[type='datetime'], .wrapper .color-scheme-10 input[type='date'], .wrapper .color-scheme-10 input[type='month'], .wrapper .color-scheme-10 input[type='week'], .wrapper .color-scheme-10 input[type='time'], .wrapper .color-scheme-10 input[type='datetime-local'], .wrapper .color-scheme-10 input[type='number'], .wrapper .color-scheme-10 textarea, .wrapper .color-scheme-10 select"
					)
				),
				
				// Form fields border
				array(
					"id"        => "scheme-10-input-border-color",
					"title"     => esc_html__( "Input Field Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-10 input, .wrapper .color-scheme-10 input[type='text'], .wrapper .color-scheme-10 input[type='email'], .wrapper .color-scheme-10 input[type='search'], .wrapper .color-scheme-10 input[type='url'], .wrapper .color-scheme-10 input[type='tel'], .wrapper .color-scheme-10 input[type='password'], .wrapper .color-scheme-10 input[type='datetime'], .wrapper .color-scheme-10 input[type='date'], .wrapper .color-scheme-10 input[type='month'], .wrapper .color-scheme-10 input[type='week'], .wrapper .color-scheme-10 input[type='time'], .wrapper .color-scheme-10 input[type='datetime-local'], .wrapper .color-scheme-10 input[type='number'], .wrapper .color-scheme-10 textarea, .wrapper .color-scheme-10 select"
					)
				),
				
				// Form fields focused border
				array(
					"id"        => "scheme-10-input-border-focused-color",
					"title"     => esc_html__( "Input Field Border Focused", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for input field borders when focused.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color" => ".wrapper .color-scheme-10 input:focus, .wrapper .color-scheme-10 input[type='text']:focus, .wrapper .color-scheme-10 input[type='email']:focus, .wrapper .color-scheme-10 input[type='search']:focus, .wrapper .color-scheme-10 input[type='url']:focus, .wrapper .color-scheme-10 input[type='tel']:focus, .wrapper .color-scheme-10 input[type='password']:focus, .wrapper .color-scheme-10 input[type='datetime']:focus, .wrapper .color-scheme-10 input[type='date']:focus, .wrapper .color-scheme-10 input[type='month']:focus, .wrapper .color-scheme-10 input[type='week']:focus, .wrapper .color-scheme-10 input[type='time']:focus, .wrapper .color-scheme-10 input[type='datetime-local']:focus, .wrapper .color-scheme-10 input[type='number']:focus, .wrapper .color-scheme-10 textarea:focus, .wrapper .color-scheme-10 select:focus"
					)
				),
				
				// Separators / Borders
				array(
					"id"        => "scheme-10-divider-color",
					"title"     => esc_html__( "Separator", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separators and borders.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-10 pre, body.search .color-scheme-10 .section-wrapper article + article, .color-scheme-10 .boxed_content, .color-scheme-10.single-post-navigation .blog-link, .color-scheme-10.single-post-navigation a"
					)
				),
				
				// Separators Text
				array(
					"id"        => "scheme-10-divider-text-color",
					"title"     => esc_html__( "Separator Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for separator text.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-10 .vc_separator h4"
					)
				),
				
				// Gallery Hover 
				array(
					"id"        => "scheme-10-gallery-caption-bg-color",
					"title"     => esc_html__( "Gallery Caption Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour for gallery image captions.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-10 .gallery-caption, .color-scheme-10 .post-grid-item-content-bg"
					)
				),
				
				// Gallery Icon 
				array(
					"id"        => "scheme-10-gallery-caption-icon-color",
					"title"     => esc_html__( "Gallery Caption Icon", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption icons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color"	=> ".color-scheme-10 .wp-caption-content span:before"
					)
				),
				
				// Gallery Text
				array(
					"id"        => "scheme-10-gallery-caption-text-color",
					"title"     => esc_html__( "Gallery Caption Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for gallery images caption text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color"	=> ".color-scheme-10 .wp-caption-content, .color-scheme-10 .wp-caption-content h3"
					)
				),
				
				// Button
				array(
					"id"        => "scheme-10-button-color",
					"title"     => esc_html__( "Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for buttons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-10 .video_lightbox .play:after, .wrapper .color-scheme-10 input[type='button']:hover, .wrapper .color-scheme-10 input[type='submit']:hover, .wrapper .color-scheme-10 button:hover, .wrapper .color-scheme-10 button[type='submit']:hover, .wrapper .color-scheme-10 input[type='reset']:hover, .color-scheme-10 .tagcloud a:hover, .color-scheme-10 .vc_btn3:after, .color-scheme-10 .posts-list article:hover, .color-scheme-10 .wpb_text_column ul li:before",
						"border-color"		=> ".color-scheme-10 .video_lightbox .play, .color-scheme-10 .vc_btn3, .color-scheme-10 .post-meta .vc_btn3, .wrapper .color-scheme-10 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-10 .vc_custom_heading .vc_btn3:hover, .wrapper .color-scheme-10 input[type='button'], .wrapper .color-scheme-10 input[type='submit'], .wrapper .color-scheme-10 button, .wrapper .color-scheme-10 button[type='submit'], .wrapper .color-scheme-10 input[type='reset'], .color-scheme-10 .tagcloud a, .wrapper .color-scheme-10 input[type='button']:disabled, .wrapper .color-scheme-10 input[type='submit']:disabled, .wrapper .color-scheme-10 button:disabled, .wrapper .color-scheme-10 input[type='button']:disabled:hover, .wrapper .color-scheme-10 input[type='submit']:disabled:hover, .wrapper .color-scheme-10 button:disabled:hover",
						"color"				=> ".color-scheme-10 .video_lightbox .play, .color-scheme-10 .vc_btn3, .color-scheme-10 .post-meta .vc_btn3, .wrapper .color-scheme-10 .vc_custom_heading .vc_btn3, .wrapper .color-scheme-10 input[type='button'], .wrapper .color-scheme-10 input[type='submit'], .wrapper .color-scheme-10 button, .wrapper .color-scheme-10 button[type='submit'], .wrapper .color-scheme-10 input[type='reset'], .color-scheme-10 .tagcloud a, .wrapper .color-scheme-10 input[type='button']:disabled, .wrapper .color-scheme-10 input[type='submit']:disabled, .wrapper .color-scheme-10 button:disabled, .wrapper .color-scheme-10 input[type='button']:disabled:hover, .wrapper .color-scheme-10 input[type='submit']:disabled:hover, .wrapper .color-scheme-10 button:disabled:hover",
					)
				),
				
				// Button hover text
				array(
					"id"        => "scheme-10-button-text-hover-color",
					"title"     => esc_html__( "Button Text Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of button text when hovered over.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 .vc_btn3:hover, .color-scheme-10 .post-meta .vc_btn3:hover, .color-scheme-10 .video_lightbox .play:hover, .wrapper .color-scheme-10 .vc_custom_heading .vc_btn3:hover, .color-scheme-10 .posts-list article:hover, .color-scheme-10 .posts-list article:hover a, .color-scheme-10 .tagcloud a:hover, .wrapper .color-scheme-10 input[type='button']:hover, .wrapper .color-scheme-10 input[type='submit']:hover, .wrapper .color-scheme-10 button:hover, .wrapper .color-scheme-10 button[type='submit']:hover, .wrapper .color-scheme-10 input[type='reset']:hover, .color-scheme-10 .wpb_text_column ul li:before"
					)
				),
				
				// Secondary Button
				array(
					"id"        => "scheme-10-secondary-button-color",
					"title"     => esc_html__( "Secondary Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for secondary buttons.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-10 .vc_btn3.btn-color-secondary:after",
						"border-color"		=> ".color-scheme-10 .vc_btn3.btn-color-secondary",
						"color"				=> ".color-scheme-10 .vc_btn3.btn-color-secondary",
					)
				),
				
				// Secondary button hover text
				array(
					"id"        => "scheme-10-secondary-button-text-hover-color",
					"title"     => esc_html__( "Secondary Button Hover Text", 'experience' ),
					"desc"		=> esc_html__( "Select the secondary button hover text color.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 .vc_btn3.btn-color-secondary:hover"
					)
				),
				
				// Quote text
				array(
					"id"        => "scheme-10-quote-color",
					"title"     => esc_html__( "Quote", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for quote text", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-10 blockquote p"
					)
				),
				
				// Scroll Buttons
				array(
					"id"        => "scheme-10-scroll-button-color",
					"title"     => esc_html__( "Scroll Button", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of header scroll arrow button.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 .section-scroll-link"
					)
				),				
				
				// Toggle content background
				array(
					"id"        => "scheme-10-tta-background-color",
					"title"     => esc_html__( "Toggle Content Background", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content backgrounds.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"background-color"	=> ".color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_tta-panel-heading:hover, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panels .vc_active .vc_tta-panel-heading, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta-accordion .vc_tta-panels-container .vc_tta-panel .vc_tta-panel-body, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-panels-container .vc_tta-panels, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tabs-list, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-tabs-list, .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active, .color-scheme-10 .wpb_wrapper .vc_toggle_title, .color-scheme-10 .vc_toggle .vc_toggle_content, .color-scheme-10 .posts-list article"
					)
				),
				
				// Toggle content title
				array(
					"id"        => "scheme-10-tta-title-color",
					"title"     => esc_html__( "Toggle Content Title", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for toggle content ttiles", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_active .vc_tta-panel-title > a:hover, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab.vc_active > a:hover, .color-scheme-10 .vc_toggle_title a, .color-scheme-10 .posts-list article a"
					)
				),
				
				// Toggle content title hover
				array(
					"id"        => "scheme-10-tta-title-hover-color",
					"title"     => esc_html__( "Toggle Content Title Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content titles when hovered over.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-title > a:hover, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta-tabs .vc_tta-tab > a:hover, .color-scheme-10 .vc_toggle .vc_toggle_title a:hover"
					)
				),
				
				// Toggle content text
				array(
					"id"        => "scheme-10-tta-text-color",
					"title"     => esc_html__( "Toggle Content Text", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of toggle content text.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 .vc_toggle_content, .color-scheme-10 .wpb_wrapper .vc_tta-container .vc_tta .vc_tta-panels-container .vc_tta-panel-body, .color-scheme-10 .posts-list"
					)
				),
				
				// Comment Navigation arrow
				array(
					"id"        => "scheme-10-comments-navigation-arrow-color",
					"title"     => esc_html__( "Comments Navigation Arrow", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrows.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"color" => ".color-scheme-10 .comments-navigation a"
					)
				),				
				
				// Comment navigation border
				array(
					"id"        => "scheme-10-comments-navigation-border-color",
					"title"     => esc_html__( "Comments Navigation Border", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation border.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"compiler"	=> array(
						"border-color"		=> ".color-scheme-10 .comments-navigation div",	
						"background-color"	=> ".color-scheme-10 .comments-navigation div span:after"						
					)
				),	
				
				// Comment navigation arrow hover
				array(
					"id"        => "scheme-10-comments-navigation-arrow-hover-color",
					"title"     => esc_html__( "Comments Navigation Arrow Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour of comment navigation arrow when hovered.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(
						"color" => ".color-scheme-10 .comments-navigation a:hover"
					)
				),	
				
				
				// Comment navigation background hover
				array(
					"id"        => "scheme-10-comments-navigation-background-color",
					"title"     => esc_html__( "Comments-Navigation Background Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the colour for comment navigation arrow background when hovered.", 'experience' ),
					"type"      => "color",
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-10 .comments-navigation a:hover span:after"					
					)
				),
				
				// Comment alternate background
				array(
					"id"        => "scheme-10-comments-alt-background",
					"title"     => esc_html__( "Comment Alternate Background", 'experience' ),
					"desc"		=> esc_html__( "Select the background colour of alternate post comments.", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.1",
						"rgba" 		=> Redux_Helpers::hex2rgba ( '#ffffff', '0.1' )
					),
					"compiler"	=> array(						
						"background-color"	=> ".color-scheme-10 .comment.odd > .comment-holder, .color-scheme-10 .comment.odd > #respond"
					)
				)
				
			)
		) );
		
		
		// ----- FOOTER ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Footer", 'experience' ),
			"id"         => "style-footer",
			"subsection" => true,
			"desc"       => esc_html__( "Use the options below to style the site footer. The site footer must be enabled on each page's edit screen.", 'experience' ),
			"fields"     => array(
				
				// Footer Background
				array(
					"id"        => "footer-bg-color",
					"title"     => esc_html__( "Footer Background", 'experience' ),
					"desc"		=> esc_html__( "Select the footer background colour", 'experience' ),
					"type"      => "color",
					"default"	=> "#141618",
					"compiler"	=> array(
						"background" => ".site-footer"
					)
				),
				
				// Footer Top Border
				array(
					"id"        => "footer-border-color",
					"title"     => esc_html__( "Footer Border", 'experience' ),
					"desc"		=> esc_html__( "Select the footer top border colour", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#000000",
						"alpha"     => "0",
						"rgba" 		=> Redux_Helpers::hex2rgba ( '#000000', '0' )
					),
					"compiler"	=> array(
						"border-color" => ".site-footer"
					)
				),
				
				// Footer Widget Title
				array(
					"id"        => "footer-widget-title-color",
					"title"     => esc_html__( "Footer Widget Title", 'experience' ),
					"desc"		=> esc_html__( "Select the footer widget title colour", 'experience' ),
					"type"      => "color",
					"default"	=> "#ffffff",
					"compiler"	=> array(
						"color" => ".site-footer .widget-title"
					)
				),
				
				// Footer Text
				array(
					"id"        => "footer-text-color",
					"title"     => esc_html__( "Footer Text", 'experience' ),
					"desc"		=> esc_html__( "Select the footer text colour", 'experience' ),
					"type"      => "color",
					"default"	=> "#747474",
					"compiler"	=> array(
						"color" => ".site-footer"
					)
				),
				
				// Footer Links
				array(
					"id"        => "footer-link-color",
					"title"     => esc_html__( "Footer Link", 'experience' ),
					"desc"		=> esc_html__( "Select the footer link colour", 'experience' ),
					"type"      => "color",
					"default"	=> "#A4A4A4",
					"compiler"	=> array(
						"color" => ".site-footer a"
					)
				),
				
				// Footer Links Hover					
				array(
					"id"        => "footer-link-hover-color",
					"title"     => esc_html__( "Footer Link Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the footer link hover colour", 'experience' ),
					"type"      => "color",
					"default"	=> "#747474",
					"compiler"	=> array(
						"color" => ".site-footer a:hover"
					)
				),
				
				// Back to top link
				array(
					"id"        => "footer-top-link-color",
					"title"     => esc_html__( "Back To Top Link", 'experience' ),
					"desc"		=> esc_html__( "Select the back to top link arrow colour", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#303133",
						"alpha"     => "1",
						"rgba" 		=> "rgba(48,49,51,1)"
					),
					"compiler"	=> array(
						"color" => ".site-footer .back-to-top-link"
					)
				),
				
				// Back to top border
				array(
					"id"        => "footer-top-link-border-color",
					"title"     => esc_html__( "Back To Top Border", 'experience' ),
					"desc"		=> esc_html__( "Select the back to top link border colour", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#303133",
						"alpha"     => "1",
						"rgba" 		=> "rgba(48,49,51,1)"
					),
					"compiler"	=> array(
						"background-color" => ".back-to-top-link span:after"
					)
				),
				
				// Back to top link hover
				array(
					"id"        => "footer-top-link-hover-color",
					"title"     => esc_html__( "Back To Top Link Icon Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the back to top link border hover colour", 'experience' ),
					"type"      => "color",
					"default"	=> "#141618",
					"compiler"	=> array(
						"color" => ".site-footer .back-to-top-link:hover"
					)
				),
				
				// Back to top bg hover
				array(
					"id"        => "footer-top-link-background-hover-color",
					"title"     => esc_html__( "Back To Top Link Background Hover", 'experience' ),
					"desc"		=> esc_html__( "Select the back to top link background hover colour", 'experience' ),
					"type"      => "color",
					"default"	=> "#0cb4ce",
					"compiler"	=> array(
						"background-color" => ".site-footer .back-to-top-link:hover span:after"
					)
				),
				
				// Footer input text colour
				array(
					"id"        => "footer-input-text-color",
					"title"     => esc_html__( "Footer Input Text", 'experience' ),
					"desc"		=> esc_html__( "Select the text colour of input fields that appear in the site footer", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#747474",
						"alpha"     => "1",
						"rgba" 		=> "rgba(68,68,68,1)"
					),
					"compiler"	=> array(
						"color" => ".wrapper .site-footer input, .wrapper .site-footer input[type='text'], .wrapper .site-footer input[type='email'], .wrapper .site-footer input[type='search'], .wrapper .site-footer input[type='url'], .wrapper .site-footer input[type='tel'], .wrapper .site-footer input[type='password'], .wrapper .site-footer input[type='datetime'], .wrapper .site-footer input[type='date'], .wrapper .site-footer input[type='month'], .wrapper .site-footer input[type='week'], .wrapper .site-footer input[type='time'], .wrapper .site-footer input[type='datetime-local'], .wrapper .site-footer input[type='number'], .wrapper .site-footer textarea, .wrapper .site-footer select"
					)
				),
				
				// Footer input border colour
				array(
					"id"        => "footer-input-border-color",
					"title"     => esc_html__( "Footer Input Border", 'experience' ),
					"desc"		=> esc_html__( "Select the border colour of input fields that appear in the site footer", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "0.2",
						"rgba" 		=> "rgba(255,255,255,0.2)"
					),
					"compiler"	=> array(
						"border-color" => ".wrapper .site-footer input, .wrapper .site-footer input[type='text'], .wrapper .site-footer input[type='email'], .wrapper .site-footer input[type='search'], .wrapper .site-footer input[type='url'], .wrapper .site-footer input[type='tel'], .wrapper .site-footer input[type='password'], .wrapper .site-footer input[type='datetime'], .wrapper .site-footer input[type='date'], .wrapper .site-footer input[type='month'], .wrapper .site-footer input[type='week'], .wrapper .site-footer input[type='time'], .wrapper .site-footer input[type='datetime-local'], .wrapper .site-footer input[type='number'], .wrapper .site-footer textarea, .wrapper .site-footer select"
					)
				),
				
				// Footer input border focus colour
				array(
					"id"        => "footer-input-border-focus-color",
					"title"     => esc_html__( "Footer Input Border Focused", 'experience' ),
					"desc"		=> esc_html__( "Select the border focus colour of input fields that appear in the site footer", 'experience' ),
					"type"      				=> "color_rgba",
					"show_input"    			=> true,
					"show_selection_palette"	=> true,
					"choose_text"				=> esc_html__( "Select", 'experience' ),
					"default"					=> array(
						"color"     => "#ffffff",
						"alpha"     => "1",
						"rgba" 		=> "rgba(255,255,255,1)"
					),
					"compiler"	=> array(
						"border-color" => ".wrapper .site-footer input:focus, .wrapper .site-footer input[type='text']:focus, .wrapper .site-footer input[type='email']:focus, .wrapper .site-footer input[type='search']:focus, .wrapper .site-footer input[type='url']:focus, .wrapper .site-footer input[type='tel']:focus, .wrapper .site-footer input[type='password']:focus, .wrapper .site-footer input[type='datetime']:focus, .wrapper .site-footer input[type='date']:focus, .wrapper .site-footer input[type='month']:focus, .wrapper .site-footer input[type='week']:focus, .wrapper .site-footer input[type='time']:focus, .wrapper .site-footer input[type='datetime-local']:focus, .wrapper .site-footer input[type='number']:focus, .wrapper .site-footer textarea:focus, .wrapper .site-footer select:focus"
					)
				),				
			
				// Footer Text
				array(
					"id"        => "footer-text",
					"title"     => esc_html__( "Footer Text", 'experience' ),
					"desc"		=> esc_html__( "Enter the site footer text", 'experience' ),
					"type"      => "editor",
					"args"		=> array(
						"media_buttons"	=> false
					)
				)
			
			)
		) );
	
	// ---------- BLOG ---------- //
	Redux::setSection( $opt_name, array(
        "title" => esc_html__( "Blog", 'experience' ),
        "id"    => "section-blog",
        "desc"  => "",
        "icon"  => "el el-pencil"
    ) );
		
		// ----- POST ARCHIVE ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Posts Archives", 'experience' ),
			"id"         => "blog-archive",
			"subsection" => true,
			"desc"       => esc_html__( "Use the options below to style post archives (blog, post category and post tag pages).", 'experience' ),
			"fields"     => array(
				
				// Post Archive Header
				array(
					"id"     	=> "post-archive-header",
					"title"		=> esc_html__( "Post Archive Header", 'experience' ),
					"subtitle"	=> "",
					"type"   	=> "section",
					"indent" 	=> false,
				),
					
					// Transparent Nav
					array(
						"id"        => "blog-transparent-nav",
						"title"     => esc_html__( "Transparent Navigation Bar", 'experience' ),
						"desc"		=> esc_html__( "Enable transparent navigation bar (when page has not been scrolled)", 'experience' ),
						"type"      => "switch",
						"default"   => true
					),
					
					// Transparent Nav Logo
					array(
						"id"        => "blog-transparent-nav-logo",
						"title"     => esc_html__( "Transparent Navigation Bar Logo", 'experience' ),
						"desc"		=> esc_html__( "Upload / select the site logo to display on this page. If left blank the default site logo will be displayed", 'experience' ),
						"type"      => "media",
						"required"	=> array( "blog-transparent-nav", "equals", "1" )
					),
					
					// Transparent Nav Text
					array(
						"id"        => "blog-transparent-nav-text-color",
						"title"     => esc_html__( "Transparent Navigation Bar Text", 'experience' ),
						"desc"		=> esc_html__( "Select the colour of the navigation bar text (when page has not been scrolled)", 'experience' ),
						"type"      => "color",
						"default"	=> "#FFFFFF",
						"required"	=> array( "blog-transparent-nav", "equals", "1" )
					),	
					
					// Post Archive Header Type
					array(
						"id"   		=> "blog-header-type",
						"title" 	=> esc_html__( "Header Type", 'experience' ),
						"desc"		=> esc_html__( "Select the type of header shown on this page", 'experience' ),
						"type"		=> "select",
						"options" 	=> array (
							"small"		=> esc_html__( "Small", 'experience' ),
							"fill"		=> esc_html__( "Fill screen", 'experience' )
						),
						"default"   => "small"
						
					),					
					
					// Post Archive Header Colour Scheme
					array(
						"id"		=> "blog-header-color-scheme",
						"title"		=> esc_html__( "Header Colour Scheme", 'experience' ),
						"desc" 		=> esc_html__( "Select the colour scheme used for post archive header sections", 'experience' ),
						"type" 		=> "select",
						"options" 	=> array (
							"1"		=> esc_html__( "Colour Scheme 1", 'experience' ),
							"2"		=> esc_html__( "Colour Scheme 2", 'experience' ),
							"3"		=> esc_html__( "Colour Scheme 3", 'experience' ),
							"4"		=> esc_html__( "Colour Scheme 4", 'experience' ),
							"5"		=> esc_html__( "Colour Scheme 5", 'experience' ),
							"6"		=> esc_html__( "Colour Scheme 6", 'experience' ),
							"7"		=> esc_html__( "Colour Scheme 7", 'experience' ),
							"8"		=> esc_html__( "Colour Scheme 8", 'experience' ),
							"9"		=> esc_html__( "Colour Scheme 9", 'experience' ),
							"10"	=> esc_html__( "Colour Scheme 10", 'experience' )
						)				
					),
					
					// Post Archive Header Parallax
					array(
						"id"		=> "blog-header-parallax",
						"title"		=> esc_html__( "Header Background Parallax", 'experience' ),
						"desc" 		=> wp_kses( __( "Enable header background scrolling effect.<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
						"type"      => "switch",
						"default"   => false
					),
					
					// Post Archive Header Parallax
					array(
						"id"		=> "blog-header-parallax-speed",
						"title"		=> esc_html__( "Header Background Parallax Speed", 'experience' ),
						"desc" 		=> wp_kses( __( "Enter parallax speed ratio (Note: Default value is 1.5, min value is 1).<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
						"type"      => "text",
						"required"	=> array( "blog-header-parallax", "=" , "1" )
					),
					
					// Post Archive Header Background Image
					array(
						"id"        => "blog-header-background-image",
						"title"     => esc_html__( "Header Background Image", 'experience' ),
						"desc"			=> esc_html__( "Upload / select an image to use as the post archive header background", 'experience' ),
						"type"      => "media"
					),
					
					// Post Archive Header Background Video
					array(
						"id"        		=> "blog-header-background-video",
						"title"     		=> esc_html__( "Header Background Video", 'experience' ),
						"desc"				=> wp_kses( __( "Enter the page URL to a YouTube video to use as the header background<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
						"type"      		=> "text",
						"required"	=> array( "blog-header-parallax", "=" , "1" )
					),
					
					// Post Archive Header Scroll Link
					array(
						"id"        => "blog-header-scroll-link",
						"title"     => esc_html__( "Scroll Link", 'experience' ),
						"desc"		=> esc_html__( "Enable the header scroll link", 'experience' ),
						"type"      => "switch",
						"default"   => true
					),
				
				// Post Archive Post List
				array(
					"id"     	=> "post-archive-post-list",
					"title"		=> esc_html__( "Post Archive Post List", 'experience' ),
					"desc"		=> "",
					"type"   	=> "section",
					"indent" 	=> false,
				),
				
					// Post Archive Colour Scheme
					array(
						"id"		=> "post-archive-color-scheme",
						"title"		=> esc_html__( "Post Archive Colour Scheme", 'experience' ),
						"desc" 		=> esc_html__( "Select the colour scheme used for post archives", 'experience' ),
						"type" 		=> "select",
						"options" 	=> array (
							"1"		=> esc_html__( "Colour Scheme 1", 'experience' ),
							"2"		=> esc_html__( "Colour Scheme 2", 'experience' ),
							"3"		=> esc_html__( "Colour Scheme 3", 'experience' ),
							"4"		=> esc_html__( "Colour Scheme 4", 'experience' ),
							"5"		=> esc_html__( "Colour Scheme 5", 'experience' ),
							"6"		=> esc_html__( "Colour Scheme 6", 'experience' ),
							"7"		=> esc_html__( "Colour Scheme 7", 'experience' ),
							"8"		=> esc_html__( "Colour Scheme 8", 'experience' ),
							"9"		=> esc_html__( "Colour Scheme 9", 'experience' ),
							"10"	=> esc_html__( "Colour Scheme 10", 'experience' )
						)				
					),
					
					// Post Archive Grid Width
					array(
						"id"        => "blog-alt-color",
						"title"     => esc_html__( "Post Archive Alternate Color", 'experience' ),
						"desc"		=> esc_html__( "Select whether the post grid boxes should be made lighter or darker than the post grid background", 'experience' ),
						"type"      => "select",
						"options"  	=> array(
							"dark" 			=> esc_html__( "Dark", 'experience' ),
							"light" 		=> esc_html__( "Light", 'experience' )
						)
					),

					// Post Archive Grid Width
					array(
						"id"        => "blog-grid-width",
						"title"     => esc_html__( "Post Archive Grid Width", 'experience' ),
						"desc"		=> esc_html__( "Select the width of the post archive grid.", 'experience' ),
						"type"      => "select",
						"options"  	=> array(
							"narrow-width" 	=> esc_html__( "Narrow", 'experience' ),
							"site-width" 	=> esc_html__( "Boxed", 'experience' ),
							"fluid-width"	=> esc_html__( "Full Width", 'experience' )
						)
					),		
					
					// Post Archive Default post image
					array(
						"id"        => "blog-default-post-image",
						"title"     => esc_html__( "Post Archive Default Post Image", 'experience' ),
						"desc"		=> esc_html__( "Upload / select an image to use as the default image for posts that appear in the post grid. This image will be used when no feautre image is set on the post's edit screen", 'experience' ),
						"type"      => "media"
					),
					
					// Post Author
					array(
						"id"        => "post-archive-meta-author",
						"title"     => esc_html__( "Post Author", 'experience' ),
						"desc"		=> esc_html__( "Enable author meta on post archives", 'experience' ),
						"type"      => "select",
						"type"      => "switch",
						"default"   => true
					),
					
					// Post Date
					array(
						"id"        => "post-archive-meta-date",
						"title"     => esc_html__( "Post Date", 'experience' ),
						"desc"		=> esc_html__( "Enable date meta on post archives", 'experience' ),
						"type"      => "switch",
						"default"   => true
					),
					
					// Post Category
					array(
						"id"        => "post-archive-meta-category",
						"title"     => esc_html__( "Post Category", 'experience' ),
						"desc"		=> esc_html__( "Enable category meta on post archives", 'experience' ),
						"type"      => "switch",
						"default"   => true
					)
				
			)
		) );
		
		// ----- POSTS ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Posts", 'experience' ),
			"id"         => "blog-posts",
			"subsection" => true,
			"desc"       => esc_html__( "Use the options below to style posts.", 'experience' ),
			"fields"     => array(
				
				// Post Content Colour Scheme
				array(
					"id"		=> "post-content-color-scheme",
					"title"		=> esc_html__( "Post Content Colour Scheme", 'experience' ),
					"desc" 		=> esc_html__( "Select the colour scheme used for post content area", 'experience' ),
					"type" 		=> "select",
					"options" 	=> array (
						"1"		=> esc_html__( "Colour Scheme 1", 'experience' ),
						"2"		=> esc_html__( "Colour Scheme 2", 'experience' ),
						"3"		=> esc_html__( "Colour Scheme 3", 'experience' ),
						"4"		=> esc_html__( "Colour Scheme 4", 'experience' ),
						"5"		=> esc_html__( "Colour Scheme 5", 'experience' ),
						"6"		=> esc_html__( "Colour Scheme 6", 'experience' ),
						"7"		=> esc_html__( "Colour Scheme 7", 'experience' ),
						"8"		=> esc_html__( "Colour Scheme 8", 'experience' ),
						"9"		=> esc_html__( "Colour Scheme 9", 'experience' ),
						"10"	=> esc_html__( "Colour Scheme 10", 'experience' )
					)				
				),				
				
				// Post Author
				array(
					"id"        => "post-meta-author",
					"title"     => esc_html__( "Post Author", 'experience' ),
					"desc"		=> esc_html__( "Show post author on posts", 'experience' ),
					"type"      => "select",
					"type"      => "switch",
					"default"   => true
				),
				
				// Post Date
				array(
					"id"        => "post-meta-date",
					"title"     => esc_html__( "Post Date", 'experience' ),
					"desc"		=> esc_html__( "Show post publish date on posts", 'experience' ),
					"type"      => "switch",
					"default"   => true
				),
				
				// Post Category
				array(
					"id"        => "post-meta-category",
					"title"     => esc_html__( "Post Category", 'experience' ),
					"desc"		=> esc_html__( "Show post category links on posts", 'experience' ),
					"type"      => "switch",
					"default"   => true
				),
				
				// Post Tags
				array(
					"id"        => "post-meta-tags",
					"title"     => esc_html__( "Post Tags", 'experience' ),
					"desc"		=> esc_html__( "Show post tags on posts", 'experience' ),
					"type"      => "switch",
					"default"   => true
				),
				
				// Post Comments Colour Scheme
				array(
					"id"		=> "post-comments-color-scheme",
					"title"		=> __( "Comments Section Colour Scheme", 'experience' ),
					"desc" 		=> __( "Select the colour scheme used for the comments section on blog posts.", 'experience' ),
					"type" 		=> "select",
					"options" 	=> array (
						"1"		=> __( "Colour Scheme 1", 'experience' ),
						"2"		=> __( "Colour Scheme 2", 'experience' ),
						"3"		=> __( "Colour Scheme 3", 'experience' ),
						"4"		=> __( "Colour Scheme 4", 'experience' ),
						"5"		=> __( "Colour Scheme 5", 'experience' ),
						"6"		=> __( "Colour Scheme 6", 'experience' ),
						"7"		=> __( "Colour Scheme 7", 'experience' ),
						"8"		=> __( "Colour Scheme 8", 'experience' ),
						"9"		=> __( "Colour Scheme 9", 'experience' ),
						"10"	=> __( "Colour Scheme 10", 'experience' )
					)				
				),
				
				// Post Navigation Colour Scheme
				array(
					"id"		=> "post-navigation-color-scheme",
					"title"		=> esc_html__( "Post Navigation Colour Scheme", 'experience' ),
					"desc" 		=> esc_html__( "Select the colour scheme used for the next/prev post links shown at the bottom of posts.", 'experience' ),
					"type" 		=> "select",
					"options" 	=> array (
						"1"		=> esc_html__( "Colour Scheme 1", 'experience' ),
						"2"		=> esc_html__( "Colour Scheme 2", 'experience' ),
						"3"		=> esc_html__( "Colour Scheme 3", 'experience' ),
						"4"		=> esc_html__( "Colour Scheme 4", 'experience' ),
						"5"		=> esc_html__( "Colour Scheme 5", 'experience' ),
						"6"		=> esc_html__( "Colour Scheme 6", 'experience' ),
						"7"		=> esc_html__( "Colour Scheme 7", 'experience' ),
						"8"		=> esc_html__( "Colour Scheme 8", 'experience' ),
						"9"		=> esc_html__( "Colour Scheme 9", 'experience' ),
						"10"	=> esc_html__( "Colour Scheme 10", 'experience' )
					)				
				),
				
			)
		) );
	
	
	// ---------- SEARCH ---------- //
	Redux::setSection( $opt_name, array(
        "title" 	=> esc_html__( "Search", 'experience' ),
        "id"    	=> "section-search",
        "desc"      => esc_html__( "Use the options below to style the search results page.", 'experience' ),
		"icon"		=> "el el-search",	
		"fields"    => array(
			
			// Search Transparent Nav
			array(
				"id"        => "search-transparent-nav",
				"title"     => esc_html__( "Transparent Navigation Bar", 'experience' ),
				"desc"		=> esc_html__( "Enable transparent navigation bar (when page has not been scrolled).", 'experience' ),
				"type"      => "switch",
				"default"   => true
			),
			
			// Search Transparent Nav Logo
			array(
				"id"        => "search-transparent-nav-logo",
				"title"     => esc_html__( "Transparent Navigation Bar Logo", 'experience' ),
				"desc"		=> esc_html__( "Upload / select the site logo to display on this page. If left blank the default site logo will be displayed.", 'experience' ),
				"type"      => "media",
				"required"	=> array( "search-transparent-nav", "equals", "1" )
			),
			
			// Search Transparent Nav Text
			array(
				"id"        => "search-transparent-nav-text-color",
				"title"     => esc_html__( "Transparent Navigation Bar Text", 'experience' ),
				"desc"		=> esc_html__( "Select the colour of the navigation bar text (when page has not been scrolled).", 'experience' ),
				"type"      => "color",
				"default"	=> "#FFFFFF",
				"required"	=> array( "search-transparent-nav", "equals", "1" )
			),
			
			// Search Header Type
			array(
				"id"   		=> "search-header-type",
				"title" 	=> esc_html__( "Header Type", 'experience' ),
				"desc"		=> esc_html__( "Select the type of header shown on this page.", 'experience' ),
				"type"		=> "select",
				"options" 	=> array (
					"small"		=> esc_html__( "Small", 'experience' ),
					"fill"		=> esc_html__( "Fill screen", 'experience' )
				),
				"default"   => "small"
				
			),	
			
			// Search Header Colour Scheme
			array(
				"id"		=> "search-header-color-scheme",
				"title"		=> esc_html__( "Header Colour Scheme", 'experience' ),
				"desc" 		=> esc_html__( "Select the colour scheme used for post archive header sections.", 'experience' ),
				"type" 		=> "select",
				"options" 	=> array (
					"1"		=> esc_html__( "Colour Scheme 1", 'experience' ),
					"2"		=> esc_html__( "Colour Scheme 2", 'experience' ),
					"3"		=> esc_html__( "Colour Scheme 3", 'experience' ),
					"4"		=> esc_html__( "Colour Scheme 4", 'experience' ),
					"5"		=> esc_html__( "Colour Scheme 5", 'experience' ),
					"6"		=> esc_html__( "Colour Scheme 6", 'experience' ),
					"7"		=> esc_html__( "Colour Scheme 7", 'experience' ),
					"8"		=> esc_html__( "Colour Scheme 8", 'experience' ),
					"9"		=> esc_html__( "Colour Scheme 9", 'experience' ),
					"10"	=> esc_html__( "Colour Scheme 10", 'experience' )
				)				
			),
			
			// Search Header Parallax
			array(
				"id"		=> "search-header-parallax",
				"title"		=> esc_html__( "Header Background Parallax", 'experience' ),
				"desc" 		=> wp_kses( __( "Enable header background scrolling effect.<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
				"type"      => "switch",
				"default"   => false
			),
			
			// Search Header Parallax
			array(
				"id"		=> "search-header-parallax-speed",
				"title"		=> esc_html__( "Header Background Parallax Speed", 'experience' ),
				"desc" 		=> wp_kses( __( "Enter parallax speed ratio (Note: Default value is 1.5, min value is 1).<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
				"type"      => "text",
				"required"	=> array( "search-header-parallax", "=" , "1" )
			),

			// Search Header Background Image
			array(
				"id"        => "search-header-background-image",
				"title"     => esc_html__( "Header Background Image", 'experience' ),
				"desc"		=> esc_html__( "Upload / select an image to use as the post archive header background.", 'experience' ),
				"type"      => "media"
			),
			
			// Search Archive Header Background Video
			array(
				"id"        		=> "search-header-background-video",
				"title"     		=> esc_html__( "Header Background Video", 'experience' ),
				"desc"				=> wp_kses( __( "Enter the page URL to a YouTube video to use as the header background.<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
				"type"      		=> "text",
				"required"	=> array( "search-header-parallax", "=" , "1" )
			),
			
			// Search Header Scroll Link
			array(
				"id"        => "search-header-scroll-link",
				"title"     => esc_html__( "Scroll Link", 'experience' ),
				"desc"		=> esc_html__( "Enable the header scroll link.", 'experience' ),
				"type"      => "switch",
				"default"   => true
			),
			
			// Search Posts Colour Scheme
			array(
				"id"		=> "search-posts-color-scheme",
				"title"		=> esc_html__( "Search Posts Colour Scheme", 'experience' ),
				"desc" 		=> esc_html__( "Select the colour scheme used for search posts archives.", 'experience' ),
				"type" 		=> "select",
				"options" 	=> array (
					"1"		=> esc_html__( "Colour Scheme 1", 'experience' ),
					"2"		=> esc_html__( "Colour Scheme 2", 'experience' ),
					"3"		=> esc_html__( "Colour Scheme 3", 'experience' ),
					"4"		=> esc_html__( "Colour Scheme 4", 'experience' ),
					"5"		=> esc_html__( "Colour Scheme 5", 'experience' ),
					"6"		=> esc_html__( "Colour Scheme 6", 'experience' ),
					"7"		=> esc_html__( "Colour Scheme 7", 'experience' ),
					"8"		=> esc_html__( "Colour Scheme 8", 'experience' ),
					"9"		=> esc_html__( "Colour Scheme 9", 'experience' ),
					"10"	=> esc_html__( "Colour Scheme 10", 'experience' )
				)				
			)
			
		)
		
    ) );
	
	
	// ---------- PORTFOLIO ---------- //
	Redux::setSection( $opt_name, array(
        "title" => esc_html__( "Portfolio", 'experience' ),
        "id"    => "section-portfolio",        
        "icon"  => "el el-picture"
    ) );
	
		// ----- PORTFOLIO ARCHIVE ----- //
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Portfolio Archives", 'experience' ),
			"id"         => "portfolio-archive",
			"subsection" => true,
			"desc"       => esc_html__( "Use the options below to style the portfolio archive pages (latest portfolio items, portfolio categories and portfolio tags).", 'experience' ),
			"fields"     => array(
				
				// Portfolio Archive Header
				array(
					"id"     	=> "portfolio-archive-header",
					"title"		=> esc_html__( "Post Archive Header", 'experience' ),
					"desc"		=> "",
					"type"   	=> "section",
					"indent" 	=> false,
				),
					
					// Transparent Nav
					array(
						"id"        => "portfolio-transparent-nav",
						"title"     => esc_html__( "Transparent Navigation Bar", 'experience' ),
						"desc"		=> esc_html__( "Enable transparent navigation bar (when page has not been scrolled).", 'experience' ),
						"type"      => "switch",
						"default"   => true
					),
					
					// Transparent Nav Logo
					array(
						"id"        => "portfolio-transparent-nav-logo",
						"title"     => esc_html__( "Transparent Navigation Bar Logo", 'experience' ),
						"desc"		=> esc_html__( "Upload / select the site logo to display on this page. If left blank the default site logo will be displayed.", 'experience' ),
						"type"      => "media",
						"required"	=> array( "portfolio-transparent-nav", "equals", "1" )
					),
					
					// Transparent Nav Text
					array(
						"id"        => "portfolio-transparent-nav-text-color",
						"title"     => esc_html__( "Transparent Navigation Bar Text", 'experience' ),
						"desc"		=> esc_html__( "Select the colour of the navigation bar text (when page has not been scrolled).", 'experience' ),
						"type"      => "color",
						"default"	=> "#FFFFFF",
						"required"	=> array( "portfolio-transparent-nav", "equals", "1" )
					),
					
					// Portfolio Header Type
					array(
						"id"   		=> "portfolio-header-type",
						"title" 	=> esc_html__( "Portfolio Archive Header Type", 'experience' ),
						"desc"		=> esc_html__( "Select the type of header shown on portfolio archive pages.", 'experience' ),
						"type"		=> "select",
						"options"  	=> array(
							"small"		=> esc_html__( "Small", 'experience' ),
							"fill"		=> esc_html__( "Fill screen", 'experience' )
						),
						"default"   => "small"
					),	
					
					// Portfolio Header Parallax
					array(
						"id"		=> "portfolio-header-parallax",
						"title"		=> esc_html__( "Header Background Parallax", 'experience' ),
						"desc" 		=> wp_kses( __( "Enable header background scrolling effect.<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
						"type"      => "switch",
						"default"   => false
					),
					
					// Portfolio Header Parallax
					array(
						"id"		=> "portfolio-header-parallax-speed",
						"title"		=> esc_html__( "Header Background Parallax Speed", 'experience' ),
						"desc" 		=> wp_kses( __( "Enter parallax speed ratio (Note: Default value is 1.5, min value is 1).<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
						"type"      => "text",
						"required"	=> array( "portfolio-header-parallax", "=" , "1" )
					),
			
					// Portfolio Archive Header Background Image
					array(
						"id"        => "portfolio-header-background-image",
						"title"     => esc_html__( "Header Background Image", 'experience' ),
						"desc"		=> esc_html__( "Upload an image to display in the portfolio header.", 'experience' ),
						"type"      => "media"
					),
					
					// Portfolio Archive Header Background Video
					array(
						"id"        		=> "portfolio-header-background-video",
						"title"     		=> esc_html__( "Header Background Video", 'experience' ),
						"desc"				=> wp_kses( __( "Enter the page URL to a YouTube video to use as the header background<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
						"type"      		=> "text",
						"required"	=> array( "portfolio-header-parallax", "=" , "1" )
					),
					
					// Portfolio Archive Header Colour Scheme
					array(
						"id"		=> "portfolio-header-color-scheme",
						"title"		=> esc_html__( "Portfolio Archive Header Colour Scheme", 'experience' ),
						"desc" 		=> esc_html__( "Select the colour scheme used for portfolio archive header.", 'experience' ),
						"type" 		=> "select",
						"options" 	=> array (
							"1"		=> esc_html__( "Colour Scheme 1", 'experience' ),
							"2"		=> esc_html__( "Colour Scheme 2", 'experience' ),
							"3"		=> esc_html__( "Colour Scheme 3", 'experience' ),
							"4"		=> esc_html__( "Colour Scheme 4", 'experience' ),
							"5"		=> esc_html__( "Colour Scheme 5", 'experience' ),
							"6"		=> esc_html__( "Colour Scheme 6", 'experience' ),
							"7"		=> esc_html__( "Colour Scheme 7", 'experience' ),
							"8"		=> esc_html__( "Colour Scheme 8", 'experience' ),
							"9"		=> esc_html__( "Colour Scheme 9", 'experience' ),
							"10"	=> esc_html__( "Colour Scheme 10", 'experience' )
						)				
					),					
					
					// Portfolio Archive Header Header Scroll Link
					array(
						"id"        => "portfolio-header-scroll-link",
						"title"     => esc_html__( "Header Scroll Link", 'experience' ),
						"desc"		=> esc_html__( "Enable the header scroll link.", 'experience' ),
						"type"      => "switch",
						"default"   => true
					),
					
				
				// Portfolio Archive Post List
				array(
					"id"     	=> "portfolio-archive-post-list",
					"title"		=> esc_html__( "Post Archive Post List", 'experience' ),
					"desc"		=> "",
					"type"   	=> "section",
					"indent" 	=> false,
				),
					
					// Portfolio Layout
					array(
						"id"        => "portfolio-layout",
						"title"     => esc_html__( "Portfolio Layout", 'experience' ),
						"desc"		=> esc_html__( "Select the layout used on portfolio archive pages.", 'experience' ),
						"type"      => "select",
						"options"  	=> array(
							"grid" 			=> "Grid",
							"vertical"		=> "Full Width"
						)
					),
					
					// Portfolio Item Fill Screen
					array(
						"id"        => "portfolio-fill-screen",
						"title"     => esc_html__( "Portfolio Item Fill Screen", 'experience' ),
						"desc"		=> esc_html__( "Enable this option to fit the portfolio item to the screen height.", 'experience' ),
						"type"      => "switch",
						"required"	=> array( "portfolio-layout", "=" , "vertical" )
					),
					
					// Portfolio Parallax
					array(
						"id"		=> "portfolio-parallax",
						"title"		=> esc_html__( "Background Parallax", 'experience' ),
						"desc" 		=> wp_kses( __( "Enable background scrolling effect.<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
						"type"      => "switch",
						"default"   => false,
						"required"	=> array( "portfolio-layout", "=" , "vertical" )
					),
					
					// Portfolio Parallax
					array(
						"id"		=> "portfolio-parallax-speed",
						"title"		=> esc_html__( "Parallax Speed", 'experience' ),
						"desc" 		=> wp_kses( __( "Enter parallax speed ratio (Note: Default value is 1.5, min value is 1).<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
						"type"      => "text",
						"required"	=> array( 
							array( "portfolio-layout", "=" , "vertical" ),
							array( "portfolio-parallax", "=" , "1" ),
						)
					),
					
					// Portfolio Archive Grid Width
					array(
						"id"        => "portfolio-grid-width",
						"title"     => esc_html__( "Portfolio Archive Grid Width", 'experience' ),
						"desc"		=> esc_html__( "Select the width of the portfolio archive grid.", 'experience' ),
						"type"      => "select",
						"options"  	=> array(
							"narrow-width" 	=> esc_html__( "Narrow", 'experience' ),
							"site-width" 	=> esc_html__( "Boxed", 'experience' ),
							"fluid-width"	=> esc_html__( "Full Width", 'experience' )
						),
						"required"	=> array( "portfolio-layout", "=", "grid" )
					),
					
					// Portfolio Archive Colour Scheme
					array(
						"id"		=> "portfolio-archive-color-scheme",
						"title"		=> esc_html__( "Portfolio Archive Colour Scheme", 'experience' ),
						"desc" 		=> esc_html__( "Select the colour scheme used for portfolio archive.", 'experience' ),
						"type" 		=> "select",
						"options" 	=> array (
							"1"		=> esc_html__( "Colour Scheme 1", 'experience' ),
							"2"		=> esc_html__( "Colour Scheme 2", 'experience' ),
							"3"		=> esc_html__( "Colour Scheme 3", 'experience' ),
							"4"		=> esc_html__( "Colour Scheme 4", 'experience' ),
							"5"		=> esc_html__( "Colour Scheme 5", 'experience' ),
							"6"		=> esc_html__( "Colour Scheme 6", 'experience' ),
							"7"		=> esc_html__( "Colour Scheme 7", 'experience' ),
							"8"		=> esc_html__( "Colour Scheme 8", 'experience' ),
							"9"		=> esc_html__( "Colour Scheme 9", 'experience' ),
							"10"	=> esc_html__( "Colour Scheme 10", 'experience' )
						)	
					),
				
					// Hide Title
					array(
						"id"        => "portfolio-grid-hide-title",
						"title"     => esc_html__( "Portfolio Grid Hide Titles", 'experience' ),
						"desc"		=> esc_html__( "Enable this option to hide portfolio item titles in the grid.", 'experience' ),
						"type"      => "switch",
						"required"	=> array( "portfolio-layout", "=" , "grid" )
					),
					
					// Link Type
					array(
						"id"        => "portfolio-grid-link-type",
						"title"     => esc_html__( "Portfolio Archive Grid Link Type", 'experience' ),
						"desc"		=> esc_html__( "Select the style of links used on portfolio archive grid.", 'experience' ),
						"type"      => "select",
						"options"  	=> array(
							"button" 	=> esc_html__( "Button", 'experience' ),
							"title" 	=> esc_html__( "Portfolio item title", 'experience' )
						),
						"required"	=> array( "portfolio-layout", "=", "grid" ),
						"default"	=> "button"
					)
					
			)
		) );
		
		// ----- PORTFOLIO ITEMS ----- //		
		Redux::setSection( $opt_name, array(
			"title"      => esc_html__( "Portfolio Items", 'experience' ),
			"id"         => "portfolio-portfolio-item",
			"subsection" => true,
			"desc"       => esc_html__( "Use the options below to style the portfolio item pages.", 'experience' ),
			"fields"     => array(
				
				// Portfolio Tags
				array(
					"id"        => "portfolio-item-meta-tags",
					"title"     => esc_html__( "Portfolio Tags", 'experience' ),
					"desc"		=> esc_html__( "Show portfolio tags on portfolio items.", 'experience' ),
					"type"      => "switch",
					"default"   => true
				),
				
				// Portfolio Item Meta Colour Scheme
				array(
					"id"		=> "portfolio-meta-color-scheme",
					"title"		=> esc_html__( "Portfolio Meta Colour Scheme", 'experience' ),
					"desc" 		=> esc_html__( "Select the colour scheme used for portfolio item meta data.", 'experience' ),
					"type" 		=> "select",
					"options" 	=> array (
						"1"		=> esc_html__( "Colour Scheme 1", 'experience' ),
						"2"		=> esc_html__( "Colour Scheme 2", 'experience' ),
						"3"		=> esc_html__( "Colour Scheme 3", 'experience' ),
						"4"		=> esc_html__( "Colour Scheme 4", 'experience' ),
						"5"		=> esc_html__( "Colour Scheme 5", 'experience' ),
						"6"		=> esc_html__( "Colour Scheme 6", 'experience' ),
						"7"		=> esc_html__( "Colour Scheme 7", 'experience' ),
						"8"		=> esc_html__( "Colour Scheme 8", 'experience' ),
						"9"		=> esc_html__( "Colour Scheme 9", 'experience' ),
						"10"	=> esc_html__( "Colour Scheme 10", 'experience' )
					)	
				),
				
				// Related Portfolio Items Grid Width
				array(
					"id"        => "portfolio-related-posts-grid-width",
					"title"     => esc_html__( "Related Portfolio Items Grid Width", 'experience' ),
					"desc"		=> esc_html__( "Select the width of the related portfolio items section.", 'experience' ),
					"type"      => "select",
					"options"  	=> array(
						"none"			=> esc_html__( "None", 'experience' ),
						"narrow-width" 	=> esc_html__( "Narrow", 'experience' ),
						"site-width" 	=> esc_html__( "Boxed", 'experience' ),
						"fluid-width"	=> esc_html__( "Full Width", 'experience' )
					)
				)
				
			)
		) );
		
		
	// ---------- 404 PAGE ---------- //
	Redux::setSection( $opt_name, array(
        "title" 	=> esc_html__( "404 Page", 'experience' ),
        "id"    	=> "section-404",
        "desc"       => esc_html__( "Use the options below to style the 404 error page.", 'experience' ),
        "icon"  	=> "el el-remove",
		"fields"	=> array(
			
			// 404 Transparent Nav
			array(
				"id"        => "404-transparent-nav",
				"title"     => esc_html__( "Transparent Navigation Bar", 'experience' ),
				"desc"		=> esc_html__( "Enable transparent navigation bar (when page has not been scrolled).", 'experience' ),
				"type"      => "switch",
				"default"   => true
			),
			
			// 404 Transparent Nav Logo
			array(
				"id"        => "404-transparent-nav-logo",
				"title"     => esc_html__( "Transparent Navigation Bar Logo", 'experience' ),
				"desc"		=> esc_html__( "Upload / select the site logo to display on this page. If left blank the default site logo will be displayed.", 'experience' ),
				"type"      => "media",
				"required" 	=> array( "404-transparent-nav", "equals", "1" )
			),
			
			// 404 Transparent Nav Text
			array(
				"id"        => "404-transparent-nav-text-color",
				"title"     => esc_html__( "Transparent Navigation Bar Text", 'experience' ),
				"desc"		=> esc_html__( "Select the colour of the navigation bar text (when page has not been scrolled).", 'experience' ),
				"type"      => "color",
				"default"	=> "#FFFFFF",
				"required"	 => array( "404-transparent-nav", "equals", "1" )
			),
			
			// 404 Title
			array(
				"id"        => "404-title",
				"title"     => esc_html__( "404 Page Title", 'experience' ),
				"desc"		=> esc_html__( "Enter the title shown on the 404 error page.", 'experience' ),
				"type"      => "text"
			),
			
			// 404 Content
			array(
				"id"        => "404-content",
				"title"     => esc_html__( "404 Page Content", 'experience' ),
				"desc"		=> esc_html__( "Enter the content shown on the 404 error page.", 'experience' ),
				"type"      => "editor"
			),
		
			// 404 Content Text Alignment
			array(
				"id"        => "404-text-alignment",
				"title"     => esc_html__( "Text Alignment", 'experience' ),
				"desc"		=> esc_html__( "Select the text alignment of the 404 page text.", 'experience' ),
				"type"      => "select",
				"options"  	=> array(
					"left" 		=> "Left",
					"center"=> "Centre",
					"right"	=> "Right"
				)
			),
			
			// 404 Colour Scheme
			array(
				"id"		=> "404-color-scheme",
				"title"		=> esc_html__( "404 Page Colour Scheme", 'experience' ),
				"desc" 		=> esc_html__( "Select the colour scheme used for the 404 page.", 'experience' ),
				"type" 		=> "select",
				"options" 	=> array (
						"1"		=> esc_html__( "Colour Scheme 1", 'experience' ),
						"2"		=> esc_html__( "Colour Scheme 2", 'experience' ),
						"3"		=> esc_html__( "Colour Scheme 3", 'experience' ),
						"4"		=> esc_html__( "Colour Scheme 4", 'experience' ),
						"5"		=> esc_html__( "Colour Scheme 5", 'experience' ),
						"6"		=> esc_html__( "Colour Scheme 6", 'experience' ),
						"7"		=> esc_html__( "Colour Scheme 7", 'experience' ),
						"8"		=> esc_html__( "Colour Scheme 8", 'experience' ),
						"9"		=> esc_html__( "Colour Scheme 9", 'experience' ),
						"10"	=> esc_html__( "Colour Scheme 10", 'experience' )
					)				
			),
			
			// 404 Parallax
			array(
				"id"		=> "404-parallax",
				"title"		=> esc_html__( "Background Parallax", 'experience' ),
				"desc" 		=> wp_kses( __( "Enable background scrolling effect.<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
				"type"      => "switch",
				"default"   => false
			),
			
			// 404 Parallax Speed
			array(
				"id"		=> "404-parallax-speed",
				"title"		=> esc_html__( "Background Parallax Speed", 'experience' ),
				"desc" 		=> wp_kses( __( "Enter parallax speed ratio (Note: Default value is 1.5, min value is 1).<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
				"type"      => "text",
				"required"	=> array( "404-parallax", "=" , "1" )
			),
			
			// 404 Background Image
			array(
				"id"        => "404-background-image",
				"title"     => esc_html__( "Background Image", 'experience' ),
				"desc"		=> esc_html__( "Upload an image to display in the page background.", 'experience' ),
				"type"      => "media"
			),
			
			// 404 Archive Background Video
			array(
				"id"        		=> "404-background-video",
				"title"     		=> esc_html__( "Background Video", 'experience' ),
				"desc"				=> wp_kses( __( "Enter the page URL to a YouTube video to use as the background<br/> <strong>NOTICE: Requires Visual Composer Plugin</strong>", 'experience' ), array( 'br' => array(), 'strong' => array() ) ),
				"type"      		=> "text",
				"required"	=> array( "404-parallax", "=" , "1" )
			)		
			
		)
    ) );
	
	
	// ---------- SOCIAL NETWORKS ---------- //
	Redux::setSection( $opt_name, array(
        "title" 	=> esc_html__( "Social Networks", 'experience' ),
        "id"    	=> "section-social",
        "desc"       => esc_html__( "Use the options below to specify social network profile links. These links will be used in the social tab of the navigation panel.", 'experience' ),
        "icon"  	=> "el el-share",
		"fields"	=> array(
			
			// Facebook
			array(
				"id"        => "facebook-url",
				"title"     => esc_html__( "Facebook", 'experience' ),
				"type"      => "text",
			),
			
			// Twitter
			array(
				"id"        => "twitter-url",
				"title"     => esc_html__( "Twitter", 'experience' ),
				"type"      => "text",
			),
			
			// Google Plus
			array(
				"id"        => "google-plus-url",
				"title"     => esc_html__( "Google+", 'experience' ),
				"type"      => "text",
			),
			
			// YouTube
			array(
				"id"        => "youtube-url",
				"title"     => esc_html__( "YouTube", 'experience' ),
				"type"      => "text",
			),
			
			// Vimeo
			array(
				"id"        => "vimeo-url",
				"title"     => esc_html__( "Vimeo", 'experience' ),
				"type"      => "text",
			),
			
			// Flickr
			array(
				"id"        => "flickr-url",
				"title"     => esc_html__( "Flickr", 'experience' ),
				"type"      => "text",
			),
			
			// Dribbble
			array(
				"id"        => "dribbble-url",
				"title"     => esc_html__( "Dribbble", 'experience' ),
				"type"      => "text",
			),
			
			// Instagram
			array(
				"id"        => "instagram-url",
				"title"     => esc_html__( "Instagram", 'experience' ),
				"type"      => "text",
			),
			
			// Pinterest
			array(
				"id"        => "pinterest-url",
				"title"     => esc_html__( "Pinterest", 'experience' ),
				"type"      => "text",
			),
			
			// Behance
			array(
				"id"        => "behance-url",
				"title"     => esc_html__( "Behance", 'experience' ),
				"type"      => "text",
			),
			
			// Foursquare
			array(
				"id"        => "foursquare-url",
				"title"     => esc_html__( "Foursquare", 'experience' ),
				"type"      => "text",
			),
			
			// Github
			array(
				"id"        => "github-url",
				"title"     => esc_html__( "Github", 'experience' ),
				"type"      => "text",
			),
			
			// linkedin
			array(
				"id"        => "linkedin-url",
				"title"     => esc_html__( "LinkedIn", 'experience' ),
				"type"      => "text",
			),
			
			// Tumblr
			array(
				"id"        => "tumblr-url",
				"title"     => esc_html__( "Tumblr", 'experience' ),
				"type"      => "text",
			),
			
			// Apple
			array(
				"id"        => "apple-url",
				"title"     => esc_html__( "Apple", 'experience' ),
				"type"      => "text",
			),
			
			// Android
			array(
				"id"        => "android-url",
				"title"     => esc_html__( "Android", 'experience' ),
				"type"      => "text",
			),
			
			// skype
			array(
				"id"        => "skype-url",
				"title"     => esc_html__( "Skype", 'experience' ),
				"type"      => "text",
			),
			
			// vk
			array(
				"id"        => "vk-url",
				"title"     => esc_html__( "VK", 'experience' ),
				"type"      => "text",
			),	
			
			// Stack Overflow
			array(
				"id"        => "stackoverflow-url",
				"title"     => esc_html__( "Stack Overflow", 'experience' ),
				"type"      => "text",
			),	
			
			// Steam
			array(
				"id"        => "steam-url",
				"title"     => esc_html__( "Steam", 'experience' ),
				"type"      => "text",
			),
			
			// Twitch
			array(
				"id"        => "twitch-url",
				"title"     => esc_html__( "Twitch", 'experience' ),
				"type"      => "text",
			),
			
			// Trip Advisor
			array(
				"id"        => "tripadvisor-url",
				"title"     => esc_html__( "Trip Advisor", 'experience' ),
				"type"      => "text",
			),
			
			// Yelp
			array(
				"id"        => "yelp-url",
				"title"     => esc_html__( "Yelp", 'experience' ),
				"type"      => "text",
			),
			
			// SoundCloud
			array(
				"id"        => "soundcloud-url",
				"title"     => esc_html__( "SoundCloud", 'experience' ),
				"type"      => "text",
			),
			
		)
    ) );

	
	/**
     * ---> END SECTIONS
     **/


	/**
     * --> Action hook examples
     **/
	 
	
	/**
	 * Save theme options CSS to dynamic CSS file.
	 **/
	 
    add_filter( 'redux/options/' . $opt_name . '/compiler', 'generate_compiler_css', 10, 3 );
	
    function generate_compiler_css( $options, $css, $changed_values ) {
		
		global $experience_theme_settings;
		
		
		// ----- Panel Inputs ----- //
		
		$css .= '.panel-nav .searchform ::-webkit-input-placeholder { color: '. $experience_theme_settings['panel-link-color'] .'; opacity: 1; }
				.panel-nav .searchform ::-moz-placeholder { color: '. $experience_theme_settings['panel-link-color'] .'; opacity: 1; }
				.panel-nav .searchform :-ms-input-placeholder { color: '. $experience_theme_settings['panel-link-color'] .'; opacity: 1; }
				
				.panel-nav .searchform input:-webkit-autofill {
					-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['panel-bg-color'] .' inset;
					-webkit-text-fill-color: '. $experience_theme_settings['panel-link-color'] .';
				}
				
				.panel-nav .searchform input:-webkit-autofill:focus {
					-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['panel-bg-color'] .' inset;
					-webkit-text-fill-color: '. $experience_theme_settings['panel-link-color'] .';
				}';
		
		
		// ----- Site Footer Inputs ----- //
		
		if ( isset( $experience_theme_settings['footer-input-text-color']['rgba'] ) ) {
			
			$css .= '.site-footer :-webkit-autofill {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['footer-bg-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['footer-input-text-color']['rgba'] .';
					}
					.site-footer :-webkit-autofill:focus {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['footer-bg-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['footer-input-text-color']['rgba'] .';
					}';
		
			$css .= '.site-footer ::-webkit-input-placeholder { 
						color: '. $experience_theme_settings['footer-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.site-footer ::-moz-placeholder {
						color: '. $experience_theme_settings['footer-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.site-footer :-ms-input-placeholder {
						color: '. $experience_theme_settings['footer-input-text-color']['rgba'] .';
						opacity: 0.6;
					}';
		
		}

		
		// ----- Colour Scheme Placeholders ----- //
		
		if ( isset( $experience_theme_settings['scheme-1-input-text-color']['rgba'] ) ) {
			$css .= '::-webkit-input-placeholder { 
						color: '. $experience_theme_settings['scheme-1-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					::-moz-placeholder {
						color: '. $experience_theme_settings['scheme-1-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					:-ms-input-placeholder {
						color: '. $experience_theme_settings['scheme-1-input-text-color']['rgba'] .';
						opacity: 0.6;
					}					
					:-webkit-autofill {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-1-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-1-input-text-color']['rgba'] .';
					}
					:-webkit-autofill:focus {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-1-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-1-input-text-color']['rgba'] .';
					}';
		}
		
		if ( isset( $experience_theme_settings['scheme-2-input-text-color']['rgba'] ) ) {
			$css .= '.color-scheme-2 ::-webkit-input-placeholder {
						color: '. $experience_theme_settings['scheme-2-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-2 ::-moz-placeholder {
						color: '. $experience_theme_settings['scheme-2-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-2 :-ms-input-placeholder {
						color: '. $experience_theme_settings['scheme-2-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-2 :-webkit-autofill {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-2-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-2-input-text-color']['rgba'] .';
					}
					.color-scheme-2 :-webkit-autofill:focus {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-2-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-2-input-text-color']['rgba'] .';
					}';
		}
		
		if ( isset( $experience_theme_settings['scheme-3-input-text-color']['rgba'] ) ) {
			$css .= '.color-scheme-3 ::-webkit-input-placeholder {
						color: '. $experience_theme_settings['scheme-3-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-3 ::-moz-placeholder {
						color: '. $experience_theme_settings['scheme-3-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-3 :-ms-input-placeholder {
						color: '. $experience_theme_settings['scheme-3-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-3 :-webkit-autofill {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-3-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-3-input-text-color']['rgba'] .';
					}
					.color-scheme-3 :-webkit-autofill:focus {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-3-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-3-input-text-color']['rgba'] .';
					}';
		}
		
		if ( isset( $experience_theme_settings['scheme-4-input-text-color']['rgba'] ) ) {
			$css .= '.color-scheme-4 ::-webkit-input-placeholder {
						color: '. $experience_theme_settings['scheme-4-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-4 ::-moz-placeholder {
						color: '. $experience_theme_settings['scheme-4-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-4 :-ms-input-placeholder {
						color: '. $experience_theme_settings['scheme-4-input-text-color']['rgba'] .';
						opacity: 0.6;
					}.color-scheme-4 :-webkit-autofill {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-4-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-4-input-text-color']['rgba'] .';
					}
					.color-scheme-4 :-webkit-autofill:focus {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-4-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-4-input-text-color']['rgba'] .';
					}';
		}
		
		if ( isset( $experience_theme_settings['scheme-5-input-text-color']['rgba'] ) ) {
			$css .= '.color-scheme-5 ::-webkit-input-placeholder {
						color: '. $experience_theme_settings['scheme-5-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-5 ::-moz-placeholder {
						color: '. $experience_theme_settings['scheme-5-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-5 :-ms-input-placeholder {
						color: '. $experience_theme_settings['scheme-5-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-5 :-webkit-autofill {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-5-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-5-input-text-color']['rgba'] .';
					}
					.color-scheme-5 :-webkit-autofill:focus {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-5-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-5-input-text-color']['rgba'] .';
					}';
		}
		
		if ( isset( $experience_theme_settings['scheme-6-input-text-color']['rgba'] ) ) {
			$css .= '.color-scheme-6 ::-webkit-input-placeholder {
						color: '. $experience_theme_settings['scheme-6-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-6 ::-moz-placeholder {
						color: '. $experience_theme_settings['scheme-6-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-6 :-ms-input-placeholder {
						color: '. $experience_theme_settings['scheme-6-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-6 :-webkit-autofill {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-6-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-6-input-text-color']['rgba'] .';
					}
					.color-scheme-6 :-webkit-autofill:focus {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-6-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-6-input-text-color']['rgba'] .';
					}';
		}
		
		if ( isset( $experience_theme_settings['scheme-7-input-text-color']['rgba'] ) ) {
			$css .= '.color-scheme-7 ::-webkit-input-placeholder {
						color: '. $experience_theme_settings['scheme-7-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-7 ::-moz-placeholder {
						color: '. $experience_theme_settings['scheme-7-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-7 :-ms-input-placeholder {
						color: '. $experience_theme_settings['scheme-7-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-7 :-webkit-autofill {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-7-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-7-input-text-color']['rgba'] .';
					}
					.color-scheme-7 :-webkit-autofill:focus {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-7-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-7-input-text-color']['rgba'] .';
					}';
		}
		
		if ( isset( $experience_theme_settings['scheme-8-input-text-color']['rgba'] ) ) {
			$css .= '.color-scheme-8 ::-webkit-input-placeholder {
						color: '. $experience_theme_settings['scheme-8-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-8 ::-moz-placeholder {
						color: '. $experience_theme_settings['scheme-8-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-8 :-ms-input-placeholder {
						color: '. $experience_theme_settings['scheme-8-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-8 :-webkit-autofill {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-8-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-8-input-text-color']['rgba'] .';
					}
					.color-scheme-8 :-webkit-autofill:focus {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-8-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-8-input-text-color']['rgba'] .';
					}';
		}
		
		if ( isset( $experience_theme_settings['scheme-9-input-text-color']['rgba'] ) ) {
			$css .= '.color-scheme-9 ::-webkit-input-placeholder {
						color: '. $experience_theme_settings['scheme-9-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-9 ::-moz-placeholder {
						color: '. $experience_theme_settings['scheme-9-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-9 :-ms-input-placeholder {
						color: '. $experience_theme_settings['scheme-9-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-9 :-webkit-autofill {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-9-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-9-input-text-color']['rgba'] .';
					}
					.color-scheme-9 :-webkit-autofill:focus {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-9-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-9-input-text-color']['rgba'] .';
					}';
		}
		
		if ( isset( $experience_theme_settings['scheme-10-input-text-color']['rgba'] ) ) {
			$css .= '.color-scheme-10 ::-webkit-input-placeholder {
						color: '. $experience_theme_settings['scheme-10-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-10 ::-moz-placeholder {
						color: '. $experience_theme_settings['scheme-10-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-10 :-ms-input-placeholder {
						color: '. $experience_theme_settings['scheme-10-input-text-color']['rgba'] .';
						opacity: 0.6;
					}
					.color-scheme-10 :-webkit-autofill {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-10-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-10-input-text-color']['rgba'] .';
					}
					.color-scheme-10 :-webkit-autofill:focus {
						-webkit-box-shadow: 0 0 0 74px '. $experience_theme_settings['scheme-10-background-color'] .' inset;
						-webkit-text-fill-color: '. $experience_theme_settings['scheme-10-input-text-color']['rgba'] .';
					}';
		}
		
		// Compress the CSS
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		$css = str_replace( ': ', ':', $css );
		$css = str_replace( array( "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ), '', $css );	
		
		$url = 'themes.php?page=experience-options';
		
		global $wp_filesystem;
		
		$creds = request_filesystem_credentials( $url, '', false, false, null );
		
		if ( false === $creds ) {
			return; // stop processing here
		}
		
		if ( ! WP_Filesystem( $creds ) ) {
			request_filesystem_credentials( $url, '', true, false, null );
			return;
		}		
		
		$upload_dir =  wp_upload_dir();
		$dir = trailingslashit( $upload_dir['basedir'] ) .'experience/'; 
		$wp_filesystem->mkdir( $dir );
		
		//$filename =  dirname(__FILE__) .'../../../style-dynamic-'. get_current_blog_id() .'.css';
		$file = $dir .'style-dynamic-'. get_current_blog_id() .'.css';		
		
		if ( !$wp_filesystem->put_contents( $file, $css, FS_CHMOD_FILE ) ) { 
			echo 'Error: CSS file could not be modified.';
		}
		
	}