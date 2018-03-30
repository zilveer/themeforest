<?php
if( !defined('ABSPATH') ) exit;
if (!class_exists("Long_Theme_Options")) {
    class Long_Theme_Options {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
			$this->initSettings();
        }

        public function initSettings() {

            if ( !class_exists("ReduxFramework" ) ) {
                return;
            }       
            
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();
            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        public function setSections() {
			//---- Theme Option Here ----//
			$schedules	=	array();
        	$wp_get_schedules	=	function_exists( 'wp_get_schedules' ) ? wp_get_schedules() : null;
        	if( is_array( $wp_get_schedules ) && !empty( $wp_get_schedules ) ){
        		foreach ($wp_get_schedules as $key=>$value) {
        			$schedules[ $key ]	=	$value['display'];
        		}
        	}

			$this->sections[] 	=	array(
				'title'	=>	__('General','saturn'),
				'icon'	=>	'el-icon-home',
				'desc'	=>	null,
				'fields'	=>	array(						
					array(
						'id'	=>	'favicon',
						'type'	=>	'media',
						'url' => true,
						'subtitle' => __('Upload any media using the WordPress native uploader', 'saturn'),
						'title'	=>	__('Favicon','saturn')
					),
					array(
						'id'        => 'smart_menu',
						'type'      => 'checkbox',
						'title'     => __('Smart Menu', 'saturn'),
						'default'  => true
					),
                   array(
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'title' => __('Custom CSS', 'saturn'),
                        'subtitle' => __('Paste your CSS code here, no style tag.', 'saturn'),
                        'mode' => 'css',
                        'theme' => 'monokai'
                    ),	
                    array(
                        'id' => 'custom_js',
                        'type' => 'ace_editor',
                        'title' => __('Custom JS', 'saturn'),
                        'subtitle' => __('Paste your JS code here, no script tag, eg: alert(\'hello world\');', 'saturn'),
                        'mode' => 'javascript',
                        'theme' => 'chrome'
                    )
				)
			);
			
			$this->sections[]	=	array(
				'title'	=>	__('Cover','saturn'),
				'icon'      => 'el-icon-website',
				'fields'	=>	array(
					array(
						'id'        => 'cover_screen',
						'type'      => 'button_set',
						'title'	=>	__('Cover','saturn'),
						'subtitle'	=>	__('Setup the Cover media.','saturn'),
						'options'   => array(
							'no'		=>	__('No Cover','saturn'),
							'image'	=>	__('Image','saturn'),
							'video'		=>	__('Video','saturn')
						),
						'default'   => 'image'
					),
					array(
						'id'	=>	'cover_background',
						'type'	=>	'media',
						'url' => true,
						'subtitle' => __('Upload any media using the WordPress native uploader', 'saturn'),
						'title'	=>	__('Background','saturn'),
						'required'  => array('cover_screen', "=", 'image'),
					),
					array(
						'id'        => 'cover_video_url',
						'type'      => 'text',
						'title'     => __('Youtube Link', 'saturn'),
						'description'	=>	__('Youtube only, <i>This player doesn’t work as background for devices due to the restriction policy adopted by all on managing multimedia files via javascript. It fallsback to the default Youtube player if used as player</i>','saturn'),
						'required'  => array('cover_screen', "=", 'video'),
					),
					array(
						'id'        => 'cover_video_autoplay',
						'type'      => 'switch',
						'title'     => __('Autoplay', 'saturn'),
						'subtitle'	=>	__('Play the video once ready','saturn'),
						'default'  => true,
						'required'  => array('cover_screen', "=", 'video'),
					),
					array(
						'id'        => 'cover_video_startat',
						'type'      => 'text',
						'title'     => __('Start At', 'saturn'),
						'subtitle'	=>	__('Set the seconds the video should start at','saturn'),
						'validate' => 'numeric',
						'default'  => '0',
						'required'  => array('cover_screen', "=", 'video'),
					),
					array(
						'id'        => 'cover_video_stopat',
						'type'      => 'text',
						'title'     => __('Stop At', 'saturn'),
						'subtitle'	=>	__('Set the seconds the video should stop at. If 0 is ignored','saturn'),
						'validate' => 'numeric',
						'default'  => '0',
						'required'  => array('cover_screen', "=", 'video'),
					),
					array(
						'id'        => 'cover_video_loop',
						'type'      => 'switch',
						'title'     => __('Loop', 'saturn'),
						'subtitle'	=>	__('Loops the movie once ended','saturn'),
						'default'  => true,
						'required'  => array('cover_screen', "=", 'video'),
					),
					array(
						'id'        => 'cover_video_showcontrols',
						'type'      => 'switch',
						'title'     => __('Show controls', 'saturn'),
						'subtitle'	=>	__('Show or hide the player controls','saturn'),
						'default'  => false,
						'required'  => array('cover_screen', "=", 'video'),
					),
					array(
						'id'        => 'cover_video_mute',
						'type'      => 'switch',
						'title'     => __('Mute', 'saturn'),
						'subtitle'	=>	__('Mute the audio','saturn'),
						'default'  => true,
						'required'  => array('cover_screen', "=", 'video'),
					),
					array(
						'id'        => 'cover_video_vol',
						'type'      => 'slider',
						'title'     => __('Vol', 'saturn'),
						'subtitle'	=>	__('Set the volume level of the video','saturn'),
						'default'       => 50,
						'min'           => 1,
						'step'          => 1,
						'max'           => 100,
						'display_value' => 'label',
						'required'  => array('cover_video_mute', "=", false),
					),
					array(
						'id'        => 'cover_video_opacity',
						'type'      => 'slider',
						'title'     => __('Opacity', 'saturn'),
						'subtitle'	=>	__('Define the opacity of the video','saturn'),
						'default'       => .5,
						'min'           => 0,
						'step'          => .1,
						'max'           => 1,
						'resolution'    => 0.1,
						'display_value' => 'label',
						'required'  => array('cover_screen', "=", 'video'),
					),
					array(
						'id'        => 'cover_video_quality',
						'type'      => 'select',
						'title'     => __('Quality', 'saturn'),
						'options'	=>	array(
							'default'	=>	__('Default','saturn'),
							'small'		=>	__('Small','saturn'),
							'medium'	=>	__('Medium','saturn'),
							'large'		=>	__('Large','saturn'),
							'hd720'		=>	__('HD 720','saturn'),
							'hd1080'	=>	__('HD 1080','saturn'),
							'highres'	=>	__('Highres','saturn')
						),
						'default'  => 'default',
						'required'  => array('cover_screen', "=", 'video'),
					),
					array(
						'id'        => 'heading',
						'type'      => 'text',
						'title'     => __('Heading', 'saturn'),
						'default'	=>	get_bloginfo( 'name' ),
						'required'  => array('cover_screen', "!=", 'no'),
					),
					array(
						'id'        => 'subheading',
						'type'      => 'text',
						'title'     => __('Sub Heading', 'saturn'),
						'subtitle'	=>	__('The text below the heading.','saturn'),
						'default'	=>	get_bloginfo( 'description' ),
						'required'  => array('cover_screen', "!=", 'no'),
					)					
				)
			);
			
			$this->sections[]	=	array(
				'title'	=>	__('Blog','saturn'),
				'icon'      => 'el-icon-website',
				'fields'	=>	array(
					array(
						'id'        => 'layout',
						'type'      => 'image_select',
						'title'     => __('Blog Layout', 'saturn'),
						'options'   => array(
							'left-sidebar' => array('alt' => __('Left Sidebar','saturn'),   'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
							'right-sidebar' => array('alt' => __('Right Sidebar','saturn'),  'img' => ReduxFramework::$_url . 'assets/img/2cr.png')
						),
						'default' => 'right-sidebar'
					),						
					array(
						'id'	=>	'infinite-type',
						'type'	=>	'button_set',
						'title'	=>	__('Infinite Type','saturn'),
						'subtitle' => __('infinite scrolling pulls the next posts automatically into view when the reader approaches the bottom of the page', 'saturn'),
						'desc'	=>	sprintf( __('This is an option of %s, make sure you installed <strong>Jetpack</strong> and activated <strong>Infinite Scroll<strong> feature.','saturn'), '<a href="http://jetpack.me/support/infinite-scroll/">'.__('Jetpack Infinite Scroll','saturn').'</a>' ),
						'options'	=>	array(
								'click'	=>	__('Click','saturn'),
								'scroll'	=>	__('Scroll','saturn')
						),
						'default'	=>	'click'
					),
					array(
						'id'        => 'infinite_posts_per_page',
						'type'      => 'text',
						'title'     => __('infinite Posts Per page', 'saturn'),
						'subtitle'	=>	__('This option controls how many posts are loaded each time Infinite Scroll acts.','saturn'),
						'default'	=>	get_option( 'posts_per_page' ),
						'validate' => 'numeric'
					),
					array(
						'id'        => 'authorbox',
						'type'      => 'switch',
						'title'     => __('Author Box', 'saturn'),
						'subtitle'	=>	__('Display the Author Box','saturn'),
						'default'  => true
					)					
				)
			);
			
			$this->sections[]	=	array(
				'title'	=>	__('Related Posts','saturn'),
				'icon'      => 'el-icon-website',
				'desc'	=>	sprintf( __('This configuration require Jetpack Related Posts feature activated, have a look %s if you need more options.','saturn'), '<a href="http://jetpack.me/support/related-posts/customize-related-posts/">here.</a>' ),
				'fields'	=>	array(
					array(
						'id'        => 'jetpack_related_posts_headline',
						'type'      => 'text',
						'title'     => __('Headline', 'saturn'),
						'subtitle'	=>	__('The Widget Headline','saturn'),
						'default'	=>	__('Related','saturn')
					),
					array(
						'id'        => 'jetpack_related_showposts',
						'type'      => 'text',
						'title'     => __('Show Posts', 'saturn'),
						'subtitle'	=>	__('The Related Posts section will include at most 3 posts. You can change this number.','saturn'),
						'default'	=>	'3',
						'validate' => 'numeric'
					),
					array(
						'id'        => 'jetpack_related_exclude_posts',
						'type'      => 'text',
						'title'     => __('Exclude Posts', 'saturn'),
						'subtitle'	=>	__('Exclude specific posts from ever appearing among Related Posts results.','saturn'),
						'desc'		=>	__('Put the Post ID, separated by commas.','saturn')
					),
					array(
						'id'        => 'jetpack_related_exclude_categories',
						'type'     => 'select',
						'data'     => 'categories',
						'title'     => __('Exclude Categories', 'saturn'),
						'subtitle'	=>	__('Exclude a specific Category from ever appearing among Related Posts results.','saturn')
					)
				)
			);			
			
			$this->sections[]	=	array(
				'title'	=>	__('Styling','saturn'),
				'icon'      => 'el-icon-website',
				'fields'	=>	array(
					array(
						'id'          => 'typography',
						'type'        => 'typography',
						'title'       => __( 'Typography', 'saturn' ),
						//'compiler'      => true,  // Use if you want to hook in your own CSS compiler
						'google'      => true,
						// Disable google fonts. Won't work if you haven't defined your google api key
						'subsets'	  => true,
						'font-backup' => true,
						// Select a backup non-google font in addition to a google font
						'all_styles'  => true,
						// Enable all Google Font style/weight variations to be added to the page
						'output'      => array( 'body' ),
						// An array of CSS selectors to apply this font style to dynamically
						'compiler'    => array( 'body' ),
						// An array of CSS selectors to apply this font style to dynamically
						'units'       => 'px',
						// Defaults to px
						'subtitle'    => __( 'Typography option with each property can be called individually.', 'saturn' ),
						'default'     => array(
								'font-family' => 'Lato',
								'google'      => true
						)
					),
					array(
						'id'       => 'body-background',
						'type'     => 'background',
						'output'   => array( 'html' ),
						'title'    => __( 'Body Background Color', 'saturn' ),
						'subtitle' => __( 'Pick a background color for the Body.', 'saturn' )
					),
					array(
						'id'       => 'header-background',
						'type'     => 'background',
						'output'   => array( '.header' ),
						'title'    => __( 'Header Background', 'saturn' ),
						'subtitle' => __( 'Pick a background color for the Header (default: #222).', 'saturn' )
					),
					array(
						'id'       => 'cover-background',
						'type'     => 'background',
						'output'   => array( '.main-content .cover-background' ),
						'title'    => __( 'Cover Background', 'saturn' ),
						'subtitle' => __( 'Pick a background color for the Header (default: #000).', 'saturn' )
					),
					array(
						'id'       => 'heading-color',
						'type'     => 'color',
						'output'   => array( '.site-heading .site-heading-content .site-title' ),
						'title'    => __( 'Heading Color', 'saturn' ),
						'subtitle' => __( 'Pick a color for the Heading (default: #fff).', 'saturn' ),
						'validate' => 'color'
					),
					array(
						'id'       => 'subheading-color',
						'type'     => 'color',
						'output'   => array( '.site-heading .site-heading-content .site-subtitle' ),
						'title'    => __( 'Sub-Heading Color', 'saturn' ),
						'subtitle' => __( 'Pick a color for the Sub-Heading (default: #fff).', 'saturn' ),
						'validate' => 'color'
					),
					array(
						'id'       => 'featured-posts-color',
						'type'     => 'color',
						'output'   => array( '.featured-posts .section-header .block-title' ),
						'title'    => __( 'Featured Post Widget Title Color', 'saturn' ),
						'subtitle' => __( 'Pick a color for the Featured Post Widget Title (default: #FE9C46).', 'saturn' ),
						'validate' => 'color'
					),
					array(
						'id'       => 'post-title-color',
						'type'     => 'color',
						'output'   => array( '.primary-content .page .post-header .post-title a, .primary-content .post .post-header .post-title a,.primary-content .page .post-header .post-title, .primary-content .post .post-header .post-title' ),
						'title'    => __( 'Post Title Color', 'saturn' ),
						'subtitle' => __( 'Pick a color for the post title (default: #333).', 'saturn' ),
						'validate' => 'color'
					),
					array(
						'id'       => 'post-title-hover-color',
						'type'     => 'color',
						'output'   => array( '.primary-content .page .post-header .post-title a:hover, .primary-content .post .post-header .post-title a:hover' ),
						'title'    => __( 'Post Title Hover Color', 'saturn' ),
						'subtitle' => __( 'Pick a color for the post title when hover the mouse (default: #FE9C46).', 'saturn' ),
						'validate' => 'color'
					),
					array(
						'id'       => 'widget-title-color',
						'type'     => 'color',
						'output'   => array( '.sidebar .widget .widget-title' ),
						'title'    => __( 'Widget Title Color', 'saturn' ),
						'subtitle' => __( 'Pick a color for the Widget title (default: #2b2b2b).', 'saturn' ),
						'validate' => 'color'
					),
					array(
						'id'       => 'footer-color',
						'type'     => 'color',
						'output'   => array( '.footer' ),
						'title'    => __( 'Footer Color', 'saturn' ),
						'subtitle' => __( 'Pick a color for the Footer (default: #2f3133).', 'saturn' ),
						'validate' => 'color'
					),
					array(
						'id'       => 'footer-social-icons-color',
						'type'     => 'color',
						'output'   => array( '.footer .socials li a i' ),
						'title'    => __( 'Social Icon Color', 'saturn' ),
						'subtitle' => __( 'Pick a color for the Social Icon at the footer (default: #fff).', 'saturn' ),
						'validate' => 'color'
					)
				)
			);			
			$this->sections[]	=	array(
				'title'	=>	__('Footer','saturn'),
				'icon'      => 'el-icon-website',
				'fields'	=>	array(
					array(
						'id'        => 'footer-text',
						'type'      => 'editor',
						'title'     => __('Footer', 'saturn'),
						'subtitle'		=>	__('The copyright text at the footer.','saturn'),
						'default'	=>	sprintf( __('2014 %s. All Rights Reserved.','saturn'), '<a href="'.home_url().'">'.get_bloginfo('name') .'</a>')
					),						
					array(
						'id'        => 'fa-facebook',
						'type'      => 'text',
						'title'     => __('Facebook', 'saturn')
					),
					array(
						'id'        => 'fa-twitter',
						'type'      => 'text',
						'title'     => __('Twitter', 'saturn')
					),
					array(
						'id'        => 'fa-google-plus',
						'type'      => 'text',
						'title'     => __('Google Plus', 'saturn')
					),
					array(
						'id'        => 'fa-instagram',
						'type'      => 'text',
						'title'     => __('Instagram', 'saturn')
					),
					array(
						'id'        => 'fa-tumblr',
						'type'      => 'text',
						'title'     => __('Tumblr', 'saturn')
					),
					array(
						'id'        => 'fa-linkedin',
						'type'      => 'text',
						'title'     => __('Linkedin', 'saturn')
					),
					array(
						'id'        => 'fa-flickr',
						'type'      => 'text',
						'title'     => __('Flickr', 'saturn')
					),
					array(
						'id'        => 'fa-weibo',
						'type'      => 'text',
						'title'     => __('Weibo', 'saturn')
					),
					array(
						'id'        => 'fa-pinterest',
						'type'      => 'text',
						'title'     => __('Pinterest', 'saturn')
					),
					array(
						'id'        => 'fa-youtube',
						'type'      => 'text',
						'title'     => __('Youtube', 'saturn')
					)						
				)
			);
        }
        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'saturn_global_data', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'submenu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Theme Options', 'saturn'),
                'page' => __('Theme Options', 'saturn'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                'async_typography'  => true,
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'      	=> '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );            
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://twitter.com/marstheme',
                'title' => __('Follow us on Twitter','saturn'),
                'icon' => 'el-icon-twitter'
            );
            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'saturn'), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'saturn');
            }

            // Add content after the form.
            //$this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'saturn');
        }

    }

    new Long_Theme_Options();
}
if( !function_exists( 'saturn_logo_callback' ) ){
	function saturn_logo_callback() {
		printf( __('You may upload your own logo %s or leave blank for displaying the avatar of %s','saturn'), '<a href="themes.php?page=custom-header">'.__('HERE','saturn').'</a>', get_bloginfo( 'admin_email' ) );
	}
}