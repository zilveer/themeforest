<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "sd_data";

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }
	
	// Default RSS URL
	$sd_default_feed = get_bloginfo( 'rss2_url' );
	
	// SD Assets
	$sd_assets_url  = ReduxFramework::$_url . '../sd-admin-options/';

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name'             => 'sd_data',
        'display_name'         => __('Theme Options', 'sd-framework'),
        'display_version'      => $theme->get( 'Version' ),
        'menu_type'            => 'menu',
        'allow_sub_menu'       => true,
        'menu_title'           => __( 'Theme Options', 'sd-framework' ),
        'page_title'           => __( 'Theme Options', 'sd-framework' ),
        'google_api_key'       => 'AIzaSyDcvn0X3xtwZHuohdAJs0pOCno6PUMl6B0',
        'google_update_weekly' => false,
        'async_typography'     => true,
        'admin_bar'            => true,
        'admin_bar_icon'       => 'dashicons-portfolio',
        'admin_bar_priority'   => 50,
        'global_variable'      => '',
        'dev_mode'             => false,
        'update_notice'        => false,
        'customizer'           => true,
        'open_expanded'        => false,
        //'disable_save_warn' => true,
        'page_priority'        => 63,
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
        'footer_credit'        => ' ',
        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        // HINTS
        'hints'                => array(
            'icon'          => 'el el-exclamation-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'blue',
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

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/skatdesign',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/skatdesign',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.youtube.com/user/skatdesigntv/',
        'title' => 'Subscribe on Youtube',
        'icon'  => 'el el-youtube'
    );

    Redux::setArgs( $opt_name, $args );

    Redux::setSection( $opt_name, array(
				'icon'      => 'el-icon-cogs',
				'title'     => __( 'General', 'sd-framework' ),
				'fields'    => array(
					array(
						'id'        => 'sd_maintenance',
						'type'      => 'switch',
						'title'     => __( 'Maintenance Mode', 'sd-framework' ),
						'subtitle'  => __( 'Enable or disable maintenance mode.', 'sd-framework' ),
						'default'   => false,
						'on'        => __( 'Enabled', 'sd-framework' ),
						'off'       => __( 'Disabled', 'sd-framework' ),
					),
					array(
						'id'       => 'sd_boxed',
						'type'     => 'select',
						'title'    => __( 'Website Layout', 'sd-framework' ),
						'subtitle' => __( 'Select the layout of the website.', 'sd-framework' ),
						'options'  => array(
							'1' => __( 'Full Width', 'sd-framework' ),
							'2' => __( 'Boxed', 'sd-framework' )
						),
						'default'  => '1',
					),
					array(
						'id'       => 'sd_boxed_bg',
						'type'     => 'background',
						'title'    => __( 'Body Background', 'sd-framework' ),
						'subtitle' => __( 'Body background with image, color, etc.', 'sd-framework' ),
						'compiler'   => array( 'body' ),
						'required' => array( 'sd_boxed', "=", 2 ),
						'hint'     => array(
							'title'   => __( 'Boxed Layout', 'sd-framework' ),
							'content' => __( 'Available for boxed layout only.', 'sd-framework' ),
						),
					),
					array(
						'id'       => 'sd_sidebar_location',
						'type'     => 'image_select',
						'title'    => __( 'Sidebar Location', 'sd-framework' ),
						'subtitle' => __( 'Select the location of the sidebar.', 'sd-framework' ),
						'options'  => array(
							'1' => array(
								'alt' => __( 'Right', 'sd-framework' ),
								'img' => $sd_assets_url . 'img/2cr.png'
							),
							'2' => array(
								'alt' => __( 'Left', 'sd-framework' ),
								'img' => $sd_assets_url . 'img/2cl.png'
							),
						),
						'default'  => '1',
					),
					array(
						'id'       => 'sd_pagination_type',
						'type'     => 'image_select',
						'title'    => __( 'Pagination Type', 'sd-framework' ),
						'subtitle' => __( 'Select the type of pagination.', 'sd-framework' ),
						'desc'     => __( 'Pagination appears on blog, course, event pages and also on their archive pages.', 'sd-framework' ),
						'options'  => array(
							'1' => array(
								'alt' => __( 'Default WordPress Pagination', 'sd-framework' ),
								'img' => $sd_assets_url . 'img/sd-pagination-default.png'
							),
							'2' => array(
								'alt' => __( 'Page Numbers', 'sd-framework' ),
								'img' => $sd_assets_url . 'img/sd-pagination-numbers.png'
							),
                        ),
						'default'  => '2',
					),
					array(
						'id'       => 'sd_blog_next',
						'type'     => 'text',
						'title'    => __( 'Next Posts', 'sd-framework' ),
						'subtitle' => __( 'Next posts button text.', 'sd-framework' ),
						'default'  => __( 'Next Posts', 'sd-framework' ),
						'required' => array( 'sd_pagination_type', "=", 1 ),
					),
					array(
						'id'       => 'sd_blog_prev',
						'type'     => 'text',
						'title'    => __( 'Previous Posts', 'sd-framework' ),
						'subtitle' => __( 'Previous posts button text.', 'sd-framework' ),
						'default'  => __( 'Previous Posts', 'sd-framework' ),
						'required' => array( 'sd_pagination_type', "=", 1 ),
					),
					array(
						'id'       => 'sd_staff_slug',
						'type'     => 'text',
						'title'    => __( 'Staff Slug', 'sd-framework' ),
						'subtitle' => __( 'Insert the staff page slug (eg. staff-page)', 'sd-framework' ),
						'default'  => '',
						'hint'     => array(
							'title'   => __( 'Flush Permalinks', 'sd-framework' ),
							'content' => __( 'After changing the slug make sure you flush your permalink settings. WP dashboard > Settings > Permalinks and click "Save changes"', 'sd-framework' ),
						),
					),
					array(
						'id'       => 'sd_events_slug',
						'type'     => 'text',
						'title'    => __( 'Events Slug', 'sd-framework' ),
						'subtitle' => __( 'Insert the events page slug (eg. case-studies-page)', 'sd-framework' ),
						'default'  => '',
						'hint'     => array(
							'title'   => __( 'Flush Permalinks', 'sd-framework' ),
							'content' => __( 'After changing the slug make sure you flush your permalink settings. WP dashboard > Settings > Permalinks and click "Save changes"', 'sd-framework' ),
						),
					),
				),
			) );

			Redux::setSection( $opt_name, array(
                'title'     => __('Header', 'sd-framework'),
                'desc'      => '',
                'icon'      => 'el-icon-minus',
                'fields'    => array(
					
					array(
						'id'       => 'sd_header_style',
						'type'     => 'image_select',
						'title'    => __( 'Header Style', 'sd-framework' ),
						'subtitle' => __( 'Select the style of the header.', 'sd-framework' ),
						'options'  => array(
							'1' => array(
								'alt' => 'Style 1',
								'img' => $sd_assets_url . '/img/header-style-1.jpg'
							),
							'2' => array(
								'alt' => 'Style 2',
								'img' => $sd_assets_url . '/img/header-style-2.jpg'
							),
							'3' => array(
								'alt' => 'Style 3',
								'img' => $sd_assets_url . '/img/header-style-3.jpg'
							),
						),
						'default'  => '1'
					),
					array(
						'id'        => 'sd_header_email',
						'type'      => 'text',
						'title'     => __( 'Header Email', 'sd-framework' ),
						'subtitle'  => __( 'Insert the email that will be displayed in the header.', 'sd-framework' ),
						'desc'      => __( ' Leave blank if you don\'t want to display it.', 'sd-framework' ),
						'validate' => 'email',
						'required'  => array( 
							array( 'sd_header_style', '=', array( '2', '3' ) ),
						),
					),
					array(
						'id'        => 'sd_header_phone',
						'type'      => 'text',
						'title'     => __( 'Header Phone', 'sd-framework' ),
						'subtitle'  => __( 'Insert the phone number that will be displayed in the header.', 'sd-framework' ),
						'desc'      => __( ' Leave blank if you don\'t want to display it.', 'sd-framework' ),
						'required'  => array( 
							array( 'sd_header_style', '=', array( '2', '3' ) ),
						),
					),
					array(
						'id'        => 'sd_extra_button',
						'type'      => 'text',
						'title'     => __( 'Header Button Url', 'sd-framework' ),
						'subtitle'  => __( 'Insert the url of the header button.', 'sd-framework' ),
						'desc'      => __( ' Leave blank if you don\'t want to display the button.', 'sd-framework' ),
						'validate'  => 'url',
						'required'  => array( 
							array( 'sd_header_style', '=', array( '2', '3' ) ),
						),
					),
					array(
						'id'        => 'sd_extra_button_text',
						'type'      => 'text',
						'title'     => __( 'Header Button Text', 'sd-framework' ),
						'subtitle'  => __( 'Insert the text of the header button.', 'sd-framework' ),
						'desc'      => __( ' Leave blank if you don\'t want to display the button.', 'sd-framework' ),
						'required'  => array( 
							array( 'sd_header_style', '=', array( '2', '3' ) ),
						),
					),
					array(
						'id'       => 'sd_header_height',
						'type'     => 'dimensions',
						'title'    => __( 'Header Height', 'sd-framework' ),
						'subtitle' => __( 'Insert the height of the header.', 'sd-framework' ),
						'desc'     => __( 'Default: 100px', 'sd-framework' ),
						'compiler'    => array( 'height' => '.sd-logo-menu' ),
						'width'	   => false,
						'units'    => array('px'),
					),
					array(
						'id'        => 'sd_top_bar',
						'type'      => 'switch',
						'title'     => __( 'Top Bar', 'sd-framework' ),
						'subtitle'  => __( 'Enable or disable the top header bar.', 'sd-framework' ),
						'on'        => __( 'Enabled', 'sd-framework' ),
						'off'       => __( 'Disabled', 'sd-framework' ),
						'default'      => true,
					),
					array(
						'id'       => 'sd_top_bar_style',
						'type'     => 'select',
						'title'    => __( 'Top Bar Style', 'sd-framework' ),
						'subtitle' => __( 'Select the type of the header top bar.', 'sd-framework' ),
						'options'  => array(
							'1' => 'Text + Social Icons',
							'2' => 'Menu + Social Icons',
						),
						'default'  => '1',
						'required' => array( 'sd_top_bar', '=', 1 ),
		            ),
					array(
						'id'        => 'sd_top_text',
						'type'      => 'text',
						'title'     => __( 'Top Bar Text', 'sd-framework' ),
						'subtitle'  => __( 'Insert a short text that will appear on the top bar.', 'sd-framework' ),
						'desc'      => __( ' Leave blank if you don\'t want to display it.', 'sd-framework' ),
						'default'   => __( 'WELCOME TO HELPING HANDS', 'sd-framework' ),
						'required'  => array( 
							array( 'sd_top_bar', '=', 1 ),
							array( 'sd_top_bar_style', '=', 1 ), 
						),
					),
					array(
						'id'       => 'sd_menu_top_margin',
						'type'     => 'spacing',
						'title'    => __( 'Menu Top Margin', 'sd-framework' ),
						'subtitle' => __( 'Adjust the top margin of the menu.', 'sd-framework' ),
						'desc'     => __( 'Default: 27px', 'sd-framework' ),
						'compiler' => array( '.sd-menu-wrapper' ),
						'top'      => true,
						'right'    => false,
						'bottom'   => false,
						'left'     => false,
						'mode'     => 'margin',
						'units'    => array( 'px' ),
					),

					array(
						'id'        => 'sd_sticky_menu',
						'type'      => 'switch',
						'title'     => __( 'Sticky Menu', 'sd-framework' ),
						'subtitle'  => __( 'Enable or disable the sticky menu.', 'sd-framework' ),
						'on'        => __( 'Enabled', 'sd-framework' ),
						'off'       => __( 'Disabled', 'sd-framework' ),
						'default'      => false,
					),
					array(
						'id'        => 'sd_top_bar_search_icon',
						'type'      => 'switch',
						'title'     => __( 'Top Bar Menu Search Icon', 'sd-framework' ),
						'subtitle'  => __( 'Enable or disable the top bar menu search icon.', 'sd-framework' ),
						'on'        => __( 'Enabled', 'sd-framework' ),
						'off'       => __( 'Disabled', 'sd-framework' ),
						'default'      => false,
					),
					array(
						'id'        => 'sd_main_menu_search_icon',
						'type'      => 'switch',
						'title'     => __( 'Main Menu Search Icon', 'sd-framework' ),
						'subtitle'  => __( 'Enable or disable the main menu search icon.', 'sd-framework' ),
						'on'        => __( 'Enabled', 'sd-framework' ),
						'off'       => __( 'Disabled', 'sd-framework' ),
						'default'      => true,
					),
				),
			) );
			
			Redux::setSection( $opt_name, array(
				'icon'       => 'el-icon-podcast',
				'title'      => __( 'Social Icons', 'sd-framework' ),
				'subsection' => true,
				'fields'     => array(
					array(
						'id'        => 'sd_social_icons',
						'type'      => 'switch',
						'title'     => __('Header Social Icons', 'sd-framework'),
						'subtitle'  => __('Enable or disable the header social icons.', 'sd-framework'),
						'default'   => 1,
						'on'        => __('Enabled', 'sd-framework'),
						'off'       => __('Disabled', 'sd-framework')
					),
					array(
						'id'       => 'sd_social_icons_data',
						'type'     => 'sortable',
						'title'    => __( 'Header Social Icons', 'sd-framework' ),
						'subtitle' => __( 'Define and reorder the social icons however you want.', 'sd-framework' ),
						'desc'     => __( 'Leave any field blank if you don\'t want to display it .', 'sd-framework' ),
						'label'    => true,
						'options'  => array(
							'email'        => 'info@yoursite.com',
							'facebook'     => 'https://facebook.com/skatdesign',
							'twitter'      => 'http://twitter.com/skatdesign',
							'linkedin'     => 'https://www.linkedin.com/in/skatdesign',
							'google-plus'  => 'http://google.com/+skatdesign',
							'youtube-play' => 'http://www.youtube.com/user/skatdesigntv',
							'vimeo-square' => '',
							'pinterest'    => 'http://www.pinterest.com/skatdesign/',
							'instagram'    => '',
							'flickr'       => '',
							'rss'          => $sd_default_feed,
							'phone'        => '',
						),
						'default' => array(
							'email'        => 'info@yoursite.com',
							'facebook'     => 'https://facebook.com/skatdesign',
							'twitter'      => 'http://twitter.com/skatdesign',
							'linkedin'     => 'https://www.linkedin.com/in/skatdesign',
							'google-plus'  => 'http://google.com/+skatdesign',
							'youtube-play' => 'http://www.youtube.com/user/skatdesigntv',
							'vimeo-square' => '',
							'pinterest'    => 'http://www.pinterest.com/skatdesign/',
							'instagram'    => '',
							'flickr'       => '',
							'phone'        => '',
						),
						'required'  => array( 'sd_social_icons', "=", 1 ),
					),
				),
			) );
			
			Redux::setSection( $opt_name, array(
				'icon'       => 'el-icon-star-alt',
				'title'      => __( 'Logo', 'sd-framework' ),
				'subsection' => true,
				'fields'     => array(
					array(
						'id'        => 'sd_logo_upload',
						'type'      => 'media',
						'url'       => false,
						'title'     => __( 'Custom Logo', 'sd-framework' ),
						'desc'      => __( 'Upload your custom logo image.', 'sd-framework' ),
						'subtitle'  => '',
						'default'  	=> array(
							'url' => get_template_directory_uri() . '/framework/images/sd-logo.png',
						),
					),
					array(
						'id'       => 'sd_logo_margin_top',
						'type'     => 'spacing',
						'title'    => __( 'Logo Top Margin', 'sd-framework' ),
						'subtitle' => __( 'Adjust the top margin of the logo.', 'sd-framework' ),
						'desc'     => __( 'Default: 25px', 'sd-framework' ),
						'compiler' => array( '.sd-logo' ),
						'top'      => true,
						'right'    => false,
						'bottom'   => false,
						'left'     => false,
						'mode'     => 'margin',
						'units'    => array( 'px' ),
					),
				),
			) );
			
			Redux::setSection( $opt_name, array(
				'title'     => __( 'Blog', 'sd-framework' ),
				'desc'      => '',
				'icon'      => 'el-icon-pencil',
				'fields'    => array(
					array(
						'id'       => 'sd_blog_layout',
						'type'     => 'select',
						'title'    => __( 'Blog Layout', 'sd-framework' ),
						'subtitle' => __( 'Select the layout for the blog pages.', 'sd-framework' ),
						'desc'     => __( 'This includes blog page, single posts, archive pages, category pages, tags and search results pages.', 'sd-framework' ),
						'options'  => array(
							'1' => __( 'With Sidebar', 'sd-framework' ),
							'2' => __( 'Full Width', 'sd-framework' )
						),
						'default'  => '1',
					),
					array(
						'id'        => 'sd_blog_post_meta_enable',
						'type'      => 'switch',
						'title'     => __( 'Blog Post Meta', 'sd-framework' ),
						'subtitle'  => __( 'Enable or disable the blog post meta.', 'sd-framework' ),
						'default'   => true,
						'on'        => __( 'Enabled', 'sd-framework' ),
						'off'       => __( 'Disabled', 'sd-framework' )
					),
					array(
						'id'       => 'sd_blog_post_meta',
						'type'     => 'checkbox',
						'title'    => __( 'Blog Post Meta Options', 'sd-framework' ),
						'subtitle' => __( 'Select what info do you want to display for the blog meta.', 'sd-framework' ),
						'desc'     => __( 'This info appears right under the post title.', 'sd-framework' ),
						'options'  => array(
							'1' => __( 'Post date', 'sd-framework' ),
							'2' => __( 'Post author', 'sd-framework' ),
							'3' => __( 'Categories', 'sd-framework' ),
							'4' => __( 'Tags', 'sd-framework' ),
							'5' => __( 'Number of comments', 'sd-framework' ),
						),
						'default'  => array(
							'1' => '1',
							'2' => '1',
							'3' => '1',
							'4' => '1',
							'5' => '1',
						),
						'required'  => array( 'sd_blog_post_meta_enable', "=", 1 ),
					),
					array(
						'id'        => 'sd_blog_related',
						'type'      => 'switch',
						'title'     => __( 'Related Posts', 'sd-framework' ),
						'subtitle'  => __( 'Enable or disable the related posts section.', 'sd-framework' ),
						'default'   => true,
						'on'        => __( 'Enabled', 'sd-framework' ),
						'off'       => __( 'Disabled', 'sd-framework' ),
					),
					array(
						'id'        => 'sd_blog_single_prev_next',
						'type'      => 'switch',
						'title'     => __( 'Next/Previous Post Links', 'sd-framework' ),
						'subtitle'  => __( 'Enable or disable the next/previous links at the bottom of the single post.', 'sd-framework' ),
						'default'   => true,
						'on'        => __( 'Enabled', 'sd-framework' ),
						'off'       => __( 'Disabled', 'sd-framework' ),
					),
					array(
						'id'       => 'sd_blog_single_next',
						'type'     => 'text',
						'title'    => __( 'Next Post', 'sd-framework' ),
						'subtitle' => __( 'Next post button text.', 'sd-framework' ),
						'default'  => __( 'Next Post', 'sd-framework' ),
						'required' => array( 'sd_blog_single_prev_next', "=", 1 ),
					),
					array(
						'id'       => 'sd_blog_single_prev',
						'type'     => 'text',
						'title'    => __( 'Previous Post', 'sd-framework' ),
						'subtitle' => __( 'Previous post button text.', 'sd-framework' ),
						'default'  => __( 'Previous Post', 'sd-framework' ),
						'required'  => array( 'sd_blog_single_prev_next', "=", 1 ),
					),
					array(
						'id'        => 'sd_blog_author_box',
						'type'      => 'switch',
						'title'     => __( 'Author Box', 'sd-framework' ),
						'subtitle'  => __( 'Enable or disable the author box at the bottom of the post.', 'sd-framework' ),
						'default'   => true,
						'on'        => __( 'Enabled', 'sd-framework' ),
						'off'       => __( 'Disabled', 'sd-framework' ),
					),
					array(
						'id'        => 'sd_blog_comments',
						'type'      => 'switch',
						'title'     => __( 'Blog Comments', 'sd-framework' ),
						'subtitle'  => __( 'Enable or disable the comments on the blog posts.', 'sd-framework' ),
						'desc'  => __( 'While enabled this option can be overrided by the option in the WordPress editor.', 'sd-framework' ),
						'default'   => true,
						'on'        => __( 'Enabled', 'sd-framework' ),
						'off'       => __( 'Disabled', 'sd-framework' ),
					),
				),
			) );
			
			Redux::setSection( $opt_name, array(
				'title'  => __( 'Footer', 'sd-framework' ),
				'desc'   => '',
				'icon'   => 'el-icon-download-alt',
				'fields' => array(
					array(
						'id'       => 'sd_boxed_footer',
						'type'     => 'switch',
						'title'    => __( 'Boxed Footer', 'sd-framework' ),
						'subtitle' => __( 'Enable or disable the boxed style of the footer.', 'sd-framework' ),
						'default'  => false,
						'on'       => __( 'Enabled', 'sd-framework' ),
						'off'      => __( 'Disabled', 'sd-framework' ),
						'required' => array( 'sd_boxed', "!=", 2 ),
					),
					array(
						'id'       => 'sd_widgetized_footer',
						'type'     => 'switch',
						'title'    => __( 'Widgetized Footer', 'sd-framework' ),
						'subtitle' => __( 'Enable or disable the footer widgets section.', 'sd-framework' ),
						'default'  => true,
						'on'       => __( 'Enabled', 'sd-framework' ),
						'off'      => __( 'Disabled', 'sd-framework' )
					),
					array(
						'id'       => 'sd_footer_sidebars',
						'type'     => 'select',
						'title'    => __( 'Number of Sidebars', 'sd-framework' ),
						'subtitle' => __( 'Select the number of sidebars to display in the footer.', 'sd-framework' ),
						'options'  => array( 
										'3' => '3',
										'4' => '4',
									  ),
						'default'  => '4',
						'required' => array( 'sd_widgetized_footer', "=", 1 ),
					),
					array(
						'id'        => 'sd_copyright',
						'type'      => 'switch',
						'title'     => __( 'Copyright Box', 'sd-framework' ),
						'subtitle'  => __( 'Enable or disable the footer copyright section.', 'sd-framework' ),
						'default'   => true,
						'on'        => __( 'Enabled', 'sd-framework' ),
						'off'       => __( 'Disabled', 'sd-framework' ),
					),
					array(
						'id'        => 'sd_copyright_text',
						'type'      => 'editor',
						'title'     => __( 'Custom Copyright Text', 'sd-framework' ),
						'subtitle'  => __( 'Insert your custom copyright text.', 'sd-framework' ),
						'args'      => array(
							'media_buttons' => false,
						),
						'required'  => array( 'sd_copyright', "=", 1 ),
					),
				),
			) );
			
			Redux::setSection( $opt_name, array(
				'icon'       => 'el-icon-envelope',
				'title'      => __( 'Newsletter', 'sd-framework' ),
				'subsection' => true,
				'fields'     => array(
					array(
						'id'        => 'sd_newsletter',
						'type'      => 'switch',
						'title'     => __('Footer Newsletter', 'sd-framework'),
						'subtitle'  => __('Enable or disable the footer newsletter section.', 'sd-framework'),
						'default'   => false,
						'on'        => __('Enabled', 'sd-framework'),
						'off'       => __('Disabled', 'sd-framework')
					),
					array(
						'id'       => 'sd_newsletter_title',
						'type'     => 'text',
						'title'    => __( 'Newsleter Title', 'sd-framework' ),
						'subtitle' => __( 'Insert the newsletter title.', 'sd-framework' ),
						'default'  => __( 'NEWSLETTER SIGN-UP', 'sd-framework' ),
						'required' => array( 'sd_newsletter', "=", 1 ),
					),
					array(
						'id'       => 'sd_newsletter_subtitle',
						'type'     => 'text',
						'title'    => __( 'Newsleter Sub Title', 'sd-framework' ),
						'subtitle' => __( 'Insert a short newsletter sub title.', 'sd-framework' ),
						'default'  => __( 'Praesent diam massa, interdum quis ex id. ', 'sd-framework' ),
						'required' => array( 'sd_newsletter', "=", 1 ),
					),
					array(
						'id'       => 'sd_newsletter_code',
						'type'     => 'ace_editor',
						'title'    => __( 'Newsletter Code', 'sd-framework' ),
						'subtitle' => __( 'Insert your custom newsletter code here (i.e Naked MailChimp code).', 'sd-framework' ),
						'mode'     => 'html',
						'theme'    => 'chrome',
						'options'  => array( 'minLines'=> 50 ),
						'required' => array( 'sd_newsletter', "=", 1 ),
					),
				),
			) );
			
			Redux::setSection( $opt_name, array(
				'title'     => __( 'Typography', 'sd-framework' ),
				'desc'      => '',
				'icon'      => 'el-icon-font',
				'fields'    => array(
					array(
						'id'          => 'sd_body_typography',
						'type'        => 'typography',
						'title'       => __( 'Body', 'sd-framework' ),
						'subtitle'    => __( 'Specify the body font properties.', 'sd-framework' ),
						'google'      => true,
						'font-backup' => true,
						'font-style'  => false,
						'font-weight' => false,
						'text-align'  => false,
						'text-align'  => false,
						'compiler'    => array( 'body' ),
					),
					array(
						'id'          => 'sd_headings',
						'type'        => 'typography',
						'title'       => __( 'Headings', 'sd-framework' ),
						'subtitle'    => __( 'Specify the headings font properties.', 'sd-framework' ),
						'desc'        => __( '(h1, h2, h3, h4, h5, h6 headings)', 'sd-framework' ),
						'google'      => true,
						'font-backup' => true,
						'font-style'  => false,
						'text-align'  => false,
						'font-size'   => false,
						'line-height' => false,
						'font-weight' => true,
						'compiler'    => array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' ),
					),
					array(
						'id'          => 'sd_menu_typography',
						'type'        => 'typography',
						'title'       => __( 'Menu', 'sd-framework' ),
						'subtitle'    => __( 'Specify the menu font properties.', 'sd-framework' ),
						'google'      => true,
						'font-backup' => true,
						'font-style'  => false,
						'text-align'  => false,
						'line-height' => false,
						'font-weight' => false,
						'font-size'   => false,
						'color'       => false,
						'compiler'    => array( '.sd-menu-nav', '.sd-top-bar-nav' ),
					),
					array(
						'id'          => 'sd_page_title_typography',
						'type'        => 'typography',
						'title'       => __( 'Page Titles', 'sd-framework' ),
						'subtitle'    => __( 'Specify the page titles font properties.', 'sd-framework' ),
						'google'      => true,
						'font-backup' => true,
						'font-style'  => false,
						'text-align'  => false,
						'font-weight' => true,
						'compiler'    => array( '.sd-page-top h2' ),
					),
				),
			) );
			
			Redux::setSection( $opt_name, array(
				'title'  => __( 'Styling', 'sd-framework' ),
				'desc'   => '',
				'icon'   => 'el-icon-brush',
				'fields' => array(
					array(
						'id'          => 'sd_theme_overall',
						'type'        => 'color',
						'title'       => __( 'Theme Main Color', 'sd-framework' ), 
						'subtitle'    => __( 'Select the main color of the theme.', 'sd-framework' ),
						'desc'        => __( 'Default is #29af8a', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array(
											'color'               => 'a, a:hover, .sd-single-shortcode-campaign .sd-raised, .sd-campaign-list-content .sd-raised, .sd-carousel-item-content h3 a:hover, .sd-slider-item-content h3 a:hover, .sd-event-upcoming h3 a:hover, .sd-later-events h3 a:hover, .sd-product-content h3 a:hover, .sd-woo .star-rating, .sd-woo-shortcode .star-rating, .woocommerce .star-rating, .sd-latest-blog-short .sd-entry-title a:hover, .sd-footer-widgets .sd-more, .sd-entry-title a:hover, .sd-entry-meta a:hover, .ev-listing-item .sd-more, .ev-widget .ev-listing-content h3 a:hover, .sd-sidebar-widget a:hover, .sd-right-col .widget a:hover, .sd-sidebar-widget a:hover, .sd-right-col .widget a:hover, .sd-right-col .widget_pages .current_page_item a, .sd-right-col .widget_nav_menu .current_menu_item a, .sd-right-col .widget_nav_menu .current-menu-item a, .sd-option-price, .sd-recent-posts-content h4 a:hover, .sd_tweets_widget .sd-tweet-content a, .sd-recent-posts-content h4 a:hover, .sd-event-btn-bottom .sd-event-button a, .sd-share-icons ul li a:hover, .sd-campaign-list-content .sd-donate-button, .sd-listing-list h3 a:hover, .sd-campaign-filters a:hover, .sd-staff-content h3 a:hover, .sd-campaign-slider .sd-raised, .sd-campaign-slider .sd-raised, .sd-single-campaign-featured h3 a:hover, .widget_products .product_list_widget a:hover .product-title, .widget_recently_viewed_products .product_list_widget a:hover .product-title, .widget_top_rated_products .product_list_widget a:hover .product-title, .widget_recent_reviews .product_list_widget a:hover, .sd-woo .woocommerce-pagination span.current, .sd-woo .woocommerce-pagination a.page-numbers:hover, .sd-single-product-price ins, .sd-woo .single_variation ins, .sd-woo .single_variation .price, .sd-cart .product-name a:hover, .sd-cart .product-subtotal, .sd-coupon-button:hover, .shipping-calculator-form button:hover, .sd-cart-totals .order-total .amount, .sd-update-cart:hover, .sd-woo-login input[type="submit"]:hover, .sd-coupon-form input[type="submit"]:hover, .sd-edit-address input[type="submit"]:hover, .sd-edit-account input[type="submit"]:hover, .sd-form-login input[type="submit"]:hover, .sd-lost-pwd input[type="submit"]:hover, .sd-order-tracking input[type="submit"]:hover, .sd-form-checkout .order-total .amount, .sd-form-checkout .product-total .amount, .sd-form-checkout .cart-subtotal .amount, .sd-order-details-table .order-total .amount, .sd-order-details-table .product-total .amount, .sd-order-details-table tfoot .amount, .sd-order-details .total .amount, .sd-theme .edd_cart_amount, #edd-anon-wrap [type="checkbox"]:checked + span::before, .sd-agree-terms [type="checkbox"]:checked + span::before, .sd-theme .edd_terms_links, .sd-theme .edd_cart_amount, .sd-header-cart-list h4 a:hover, .sd-header-cart-content h5 a:hover, .sd-sidebar-widget .widget_shopping_cart_content .wc-forward:hover, .sd-sidebar-widget .widget_shopping_cart_content .total .amount, .sd-prev-post i, .sd-prev-post a:hover, .sd-next-post a:hover, .sd-related-posts h4 a:hover, .sd-next-post i, .sd-author-bio h4, .sd-author-box ul li a:hover, .sd-comment-author cite, #mega-menu-wrap-main-header-menu #mega-menu-main-header-menu > li.mega-sd-menu-button > a, .sd-extra-button, .sd-header-extra-email a:hover, .sd-list-style li:before, .sd-latest-blog-wide .sd-more',
											'background-color'    => '.sd-donate-button, .sd-custom-url-donate, .sd-funded, .sd-funded-line, .sd-event-upcoming .sd-event-data, .sd-add-cart a, .sd-entry-gallery .flexslider:hover .flex-next, .sd-entry-gallery .flexslider:hover .flex-prev, .sd-campaign-slider-wrap .flexslider:hover .flex-next, .sd-campaign-slider-wrap .flexslider:hover .flex-prev, .sd-single-images .flexslider:hover .flex-next, .sd-single-images .flexslider:hover .flex-prev, .sd-footer-sidebar-widget .textwidget input[type="submit"], .sd-current-page, #wp-calendar tbody td:hover, .sd-sidebar-widget .sd-search-button, .tagcloud a:hover, .sd-radio-trick input[type="radio"]:checked ~ div::after, .sd-campaign-modal a.edd-add-to-cart, .sd-campaign-modal a.edd_go_to_checkout, .sd-sidebar-widget a.edd-add-to-cart, .sd-sidebar-widget a.edd_go_to_checkout, .sd-sidebar-widget .edd-submit.button.blue, .sd-campaign-ended h3, .sd-single-event .sd-event-data, .sd-campaign-filters .sd-active, .sd-campaign-filters .sd-active:hover, .sd-single-campaign-featured .sd-funded-line, .sd-campaign-single .sd-funded-line, .sd-staff-featured .sd-staff-content, .sd-volunteer .wpcf7-submit, .sd-sidebar-widget .price_slider_amount button, .sd-sidebar-widget .widget_shopping_cart_content .checkout, .sd-woo #respond .form-submit input, .sd-woo .sd-add-to-cart, .sd-cart-totals .checkout-button, .sd-checkout-payment input[type="submit"], .sd-theme #edd-purchase-button, .sd-theme .edd-submit, .sd-theme input.edd-submit[type="submit"], .atcf-login .login-submit input[type="submit"], .atcf-register-submit input[type="submit"], .atcf-submit-campaign-submit input[type="submit"], .sd-theme .login-submit input[type="submit"], .sd-header-checkout, .sd-sidebar-widget .price_slider, .sd-submit-comments, .wpcf7-submit, .sd-question-widget i, .sd-woo .single_add_to_cart_button, .widget_edd_cart_widget .edd_checkout a',
											'border-color'        => '.sd-more:hover, .sd-footer-widgets .sd-more, .container .sticky, .ev-listing-item .sd-more, .sd-event-btn-bottom .sd-event-button a, .sd-campaign-list-content .sd-donate-button, .sd-volunteer input:focus, .sd-volunteer textarea:focus, .sd-volunteer select:focus, .sd-minus-button, .sd-plus-button, .sd-theme #edd_checkout_form_wrap input.edd-input:focus, .sd-theme #edd_checkout_form_wrap textarea.edd-input:focus, .wpcf7-text:focus, .wpcf7-textarea:focus, .wpcf7-captchar:focus, .sd-extra-button, .sd-theme #edd_checkout_cart a.edd-cart-saving-button:hover, .sd-latest-blog-wide .sd-more',
											'border-bottom-color' => '',
											'border-left-color'   => '',
											'border-top-color'   => '.sd-funded:after',
										 ),
					),
					array(
						'id'   => 'sd_general_styling_info',
						'type' => 'info',
						'desc' => __( 'General Styling', 'sd-framework' ),
					),
					array(
						'id'          => 'sd_text_bg',
						'type'        => 'color_rgba',
						'title'       => __( 'Title Text Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select the "titles with background" background color.', 'sd-framework' ),
						'desc'        => __( 'Default is #91a1b4', 'sd-framework' ),
						'transparent' => true,
						'customizer'  => true,
						'compiler'    => array( 'background-color' => '.sd-text-background' ),
					),
					array(
						'id'          => 'sd_misc_grey',
						'type'        => 'color',
						'title'       => __( 'Miscellaneous Grey Color', 'sd-framework' ), 
						'subtitle'    => __( 'Select the grey misc. sections background color (eg. blog sidebar, comments box, etc).', 'sd-framework' ),
						'desc'        => __( 'Default is #f1f4f8', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-sidebar-widget, .sd-right-col .widget, .sd-author-box, #respond' ),
					),
					array(
						'id'   => 'sd_header_styling_info',
						'type' => 'info',
						'desc' => __( 'Header Styling', 'sd-framework' ),
					),
					array(
						'id'          => 'sd_header_bg',
						'type'        => 'color_rgba',
						'title'       => __( 'Header Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select the header background color.', 'sd-framework' ),
						'desc'        => __( 'Default is #ffffff', 'sd-framework' ),
						'transparent' => true,
						'customizer'  => true,
						'compiler'    => array( 'background-color' => '#sd-header, .is-sticky .sd-stick, .sd-transparent-bg-mobile' ),
					),
					array(
						'id'          => 'sd_top_bar_bg',
						'type'        => 'color',
						'title'       => __( 'Top Bar Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select the header top bar background color.', 'sd-framework' ),
						'desc'        => __( 'Default is #ffffff', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-header-top'),
					),
					array(
						'id'          => 'sd_top_bar_text',
						'type'        => 'color',
						'title'       => __( 'Top Bar Text', 'sd-framework' ), 
						'subtitle'    => __( 'Select the header top bar text color.', 'sd-framework' ),
						'desc'        => __( 'Default is #9dedd7', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( '.sd-header-top, .sd-header-top a, .sd-header-social a i' ),
					),
					array(
						'id'          => 'sd_top_bar_links',
						'type'        => 'color',
						'title'       => __( 'Top Bar Links Hover Color', 'sd-framework' ), 
						'subtitle'    => __( 'Select the header top bar links hover color.', 'sd-framework' ),
						'desc'        => __( 'Default is #ffffff', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'color' => '.sd-header-social a:hover, .sd-header-social a:hover i' ),
					),
					array(
						'id'          => 'sd_search_icon_color',
						'type'        => 'color',
						'title'       => __( 'Menu Search Icon', 'sd-framework' ), 
						'subtitle'    => __( 'Select the color of the menu search icon.', 'sd-framework' ),
						'desc'        => __( 'Default is #ffffff', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'color' => '.sd-top-bar-nav .sd-search .sd-search-button, .sd-header-style3 #mega-menu-wrap-main-header-menu .sd-search-button'),
					),
					array(
						'id'          => 'sd_search_icon_bg_color',
						'type'        => 'color',
						'title'       => __( 'Menu Search Icon Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select the color of the menu search icon background.', 'sd-framework' ),
						'desc'        => __( 'Default is #27a481', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-top-bar-nav .sd-search .sd-search-button, .sd-header-style3 #mega-menu-wrap-main-header-menu .sd-search-button'),
					),
					array(
						'id'          => 'sd_search_input_color',
						'type'        => 'color',
						'title'       => __( 'Menu Search Input', 'sd-framework' ), 
						'subtitle'    => __( 'Select the color of the menu search input.', 'sd-framework' ),
						'desc'        => __( 'Default is #27a481', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-top-bar-nav .sd-search input, .sd-header-style3 .sd-search-input'),
					),
					array(
						'id'          => 'sd_search_text_color',
						'type'        => 'color',
						'title'       => __( 'Menu Search Input Text', 'sd-framework' ), 
						'subtitle'    => __( 'Select the color of the menu search input text.', 'sd-framework' ),
						'desc'        => __( 'Default is #ffffff', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'color' => '.sd-top-bar-nav .sd-search input, .sd-header-style3 .sd-search-input'),
					),
					array(
						'id'          => 'sd_sticky_bg',
						'type'        => 'color',
						'title'       => __( 'Sticky Section Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select the color of the sticky menu background.', 'sd-framework' ),
						'desc'        => __( 'Default is #ffffff', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.is-sticky .sd-header-style1' ),
						'required'  => array( 'sd_sticky_menu', "=", 1 ),
					),
					array(
						'id'          => 'sd_responsive_menu_bg',
						'type'        => 'color',
						'title'       => __( 'Responsive Menu Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select the responsive menu background color.', 'sd-framework' ),
						'desc'        => __( 'Default is #2a2e30', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sidr'),
					),
					array(
						'id'          => 'sd_responsive_menu_text',
						'type'        => 'color',
						'title'       => __( 'Responsive Menu Text', 'sd-framework' ), 
						'subtitle'    => __( 'Select the responsive menu text color.', 'sd-framework' ),
						'desc'        => __( 'Default is #ffffff', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'color' => '.sidr li a, .sidr li a:hover, .sidr li .sidr-chevron, .sidr input[type="text"]'),
					),
					array(
						'id'          => 'sd_responsive_menu_hover',
						'type'        => 'color',
						'title'       => __( 'Responsive Menu Hover', 'sd-framework' ), 
						'subtitle'    => __( 'Select the responsive menu hover color.', 'sd-framework' ),
						'desc'        => __( 'Default is #29af8a', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sidr ul li:hover > a, .sidr ul li:hover > span, .sidr ul li.active > a, .sidr ul li.active > span, .sidr ul li.sidr-class-active > a, .sidr ul li.sidr-class-active > span',
												'color' => '.sd-responsive-menu-close i' ),
					),
					array(
						'id'          => 'sd_responsive_menu_border',
						'type'        => 'color',
						'title'       => __( 'Responsive Menu Border', 'sd-framework' ), 
						'subtitle'    => __( 'Select the responsive menu border color.', 'sd-framework' ),
						'desc'        => __( 'Default is #2f3336', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'border-color' => '.sidr ul, .sidr ul li'),
					),
					array(
						'id'   => 'sd_footer_styling_info',
						'type' => 'info',
						'desc' => __( 'Footer Styling', 'sd-framework' ),
					),
					array(
						'id'          => 'sd_footer_bg',
						'type'        => 'color',
						'title'       => __( 'Footer Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select the footer background color.', 'sd-framework' ),
						'desc'        => __( 'Default is #485158', 'sd-framework' ),
						'transparent' => false,
						'compiler' 				=> array( 'background-color' => '#sd-footer' ),
					),
					array(
						'id'          => 'sd_boxed_footer_bg',
						'type'        => 'color',
						'title'       => __( 'Boxed Footer Wrapper Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select the boxed footer wrapper background color.', 'sd-framework' ),
						'transparent' => false,
						'compiler' 				=> array( 'background-color' => '.sd-boxed-footer' ),
					),
					array(
						'id'          => 'sd_footer_titles',
						'type'        => 'color',
						'title'       => __( 'Footer Widget Titles', 'sd-framework' ), 
						'subtitle'    => __( 'Select the footer widget titles color.', 'sd-framework' ),
						'desc'        => __( 'Default is #ffffff', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( '.sd-footer-widget-title' ),
					),
					array(
						'id'          => 'sd_footer_titles_bg',
						'type'        => 'color',
						'title'       => __( 'Footer Titles Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select the footer widget titles background color.', 'sd-framework' ),
						'desc'        => __( 'Default is #91a1b4', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-footer-widget-title' ),
					),
					array(
						'id'          => 'sd_footer_subtitles',
						'type'        => 'color',
						'title'       => __( 'Footer Widget Subtitles', 'sd-framework' ), 
						'subtitle'    => __( 'Select the footer widget subtitles color.', 'sd-framework' ),
						'desc'        => __( 'Default is #91a1b4', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( '.sd-footer-sidebar-widget .sd-recent-date, .sd-footer-sidebar-widget .sd-twitter-widget i, .sd-footer-sidebar-widget .sd-tweet-content .sd-time-ago' ),
					),
					array(
						'id'          => 'sd_footer_borders',
						'type'        => 'color',
						'title'       => __( 'Footer Sections Border', 'sd-framework' ), 
						'subtitle'    => __( 'Select the footer sections border color.', 'sd-framework' ),
						'desc'        => __( 'Default is #e8ecf2', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'border-color' => '.sd-footer-widgets .widget_recent_entries li, .sd-footer-sidebar-widget .sd-recent-posts-widget li' ),
					),
					array(
						'id'          => 'sd_footer_text',
						'type'        => 'color',
						'title'       => __( 'Footer Text', 'sd-framework' ), 
						'subtitle'    => __( 'Select the footer text color.', 'sd-framework' ),
						'desc'        => __( 'Default is #a6b1ba', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( '.sd-footer-widgets', '.sd-social-icons-widget li' ),
					),
					array(
						'id'          => 'sd_footer_link',
						'type'        => 'link_color',
						'title'       => __( 'Footer Links', 'sd-framework' ), 
						'subtitle'    => __( 'Select the footer link colors.', 'sd-framework' ),
						'desc'        => __( 'Default is #29af8a and #29af8a', 'sd-framework' ),
						'regular'     => true,
                        'hover'       => true,
                        'active'      => false,
                        'visited'     => false,
						'compiler'    => array( '.sd-footer-widgets a', '.sd-footer-widgets .sd-social-icons-widget a', '.sd-footer-sidebar-widget .sd-recent-posts-content h4 a', '.sd-footer-sidebar-widget .sd-tweet-content a' ),
					),
					array(
						'id'          => 'sd_footer_btn',
						'type'        => 'color',
						'title'       => __( 'Footer Buttons', 'sd-framework' ), 
						'subtitle'    => __( 'Select the footer buttons color.', 'sd-framework' ),
						'desc'        => __( 'Default is #29af8a', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 
							'background-color' => '.sd-footer-sidebar-widget .textwidget input[type="submit"]',
							'border-color'     => '.sd-footer-widgets .sd-more',
							'color'            => '.sd-footer-widgets .sd-more',
						),
					),
					array(
						'id'       => 'sd_newsletter_bg',
						'type'     => 'background',
						'title'    => __( 'Newsletter Background', 'sd-framework' ),
						'subtitle' => __( 'Select the background image or color of the newsletter section.', 'sd-framework' ),
						'compiler' => array( '.sd-newsletter' ),
						'required' => array( 'sd_newsletter', "=", 1 ),
					),
					array(
						'id'       => 'sd_newsletter_title_color',
						'type'     => 'color',
						'title'    => __( 'Newsletter Section Title', 'sd-framework' ),
						'subtitle' => __( 'Select the color of the newsletter title.', 'sd-framework' ),
						'compiler' => array( 'color' => '.sd-newsletter-desc h4' ),
						'required' => array( 'sd_newsletter', "=", 1 ),
					),
					array(
						'id'       => 'sd_newsletter_desc',
						'type'     => 'color',
						'title'    => __( 'Newsletter Subtitle Description', 'sd-framework' ),
						'subtitle' => __( 'Select the color of the newsletter subtitle description.', 'sd-framework' ),
						'compiler' => array( 'color' => '.sd-newsletter-desc p' ),
						'required' => array( 'sd_newsletter', "=", 1 ),
					),
					array(
						'id'       => 'sd_newsletter_input',
						'type'     => 'color',
						'title'    => __( 'Newsletter Input Background', 'sd-framework' ),
						'subtitle' => __( 'Select the background color of the newsletter inputs.', 'sd-framework' ),
						'compiler' => array( 'background-color' => '.sd-newsletter input[type="text"], .sd-newsletter input[type="email"]' ),
						'required' => array( 'sd_newsletter', "=", 1 ),
					),
					array(
						'id'       => 'sd_newsletter_input_text',
						'type'     => 'color',
						'title'    => __( 'Newsletter Input Text', 'sd-framework' ),
						'subtitle' => __( 'Select the color of the newsletter inputs text.', 'sd-framework' ),
						'compiler' => array( 'color' => '.sd-newsletter input[type="text"], .sd-newsletter input[type="email"]' ),
						'required' => array( 'sd_newsletter', "=", 1 ),
					),
					array(
						'id'       => 'sd_newsletter_submit',
						'type'     => 'color',
						'title'    => __( 'Newsletter Button', 'sd-framework' ),
						'subtitle' => __( 'Select the background color of the newsletter button.', 'sd-framework' ),
						'compiler' => array( 'background-color' => '.sd-newsletter input[type="submit"]' ),
						'required' => array( 'sd_newsletter', "=", 1 ),
					),
					array(
						'id'       => 'sd_newsletter_submit_text',
						'type'     => 'color',
						'title'    => __( 'Newsletter Button Text', 'sd-framework' ),
						'subtitle' => __( 'Select the color of the newsletter button text.', 'sd-framework' ),
						'compiler' => array( 'color' => '.sd-newsletter input[type="submit"]' ),
						'required' => array( 'sd_newsletter', "=", 1 ),
					),
					array(
						'id'          => 'sd_copyright_bg',
						'type'        => 'color',
						'title'       => __( 'Copyright Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select the copyright background color.', 'sd-framework' ),
						'desc'        => __( 'Default is #ffffff', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-copyright-wrapper' ),
					),
					array(
						'id'          => 'sd_copyright_border',
						'type'        => 'color',
						'title'       => __( 'Copyright Border', 'sd-framework' ), 
						'subtitle'    => __( 'Select the copyright border color.', 'sd-framework' ),
						'desc'        => __( 'Default is #e8ecf2', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'border-color' => '.sd-copyright' ),
					),
					array(
						'id'          => 'sd_footer_copyright_text',
						'type'        => 'color',
						'title'       => __( 'Copyright Text', 'sd-framework' ), 
						'subtitle'    => __( 'Select the copyright text color.', 'sd-framework' ),
						'desc'        => __( 'Default is #a6b1ba', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( '.sd-copyright' ),
					),
					array(
						'id'       => 'sd_footer_copyright_link',
						'type'     => 'link_color',
						'title'    => __( 'Copyright Links', 'sd-framework' ), 
						'subtitle' => __( 'Select the copyright link colors.', 'sd-framework' ),
						'desc'     => __( 'Default is #ffffff and #2197d7', 'sd-framework' ),
						'regular'  => true,
                        'hover'    => true,
                        'active'   => false,
                        'visited'  => false,
						'compiler' => array( '.sd-copyright a' ),
					),
					array(
						'id'   => 'sd_page_top_styling_info',
						'type' => 'info',
						'desc' => __( 'Page Top Titles Styling', 'sd-framework' ),
                     ),
					array(
						'id'             => 'sd_page_top_padding',
						'type'           => 'spacing',
						'title'          => __( 'Page Title Padding', 'sd-framework' ),
						'subtitle'       => __( 'Insert your custom page title paddings.', 'sd-framework' ),
						'desc'           => __( 'Defaults are: Top = 25px and Bottom = 25px', 'sd-framework' ),
						'top'            => true,     
						'right'          => false,    
						'bottom'         => true,     
						'left'           => false,    
						'units'          => array( 'px' ),
						'units_extended' => false,  
						'display_units'  => true,  
						'default'        => '',
						'mode'           => 'padding',
						'compiler'       => array( '.sd-page-top' ),
					),
					array(
						'id'          => 'sd_page_top_bg',
						'type'        => 'color',
						'title'       => __( 'Page Top Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select the page top titles background color.', 'sd-framework' ),
						'desc'        => __( 'Default is #f9fafb', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-page-top' ),
					),
					array(
						'id'          => 'sd_page_top_border',
						'type'        => 'color',
						'title'       => __( 'Page Top Border Color', 'sd-framework' ), 
						'subtitle'    => __( 'Select the page top border color.', 'sd-framework' ),
						'desc'        => __( 'Default is #e6e8ea', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'border-color' => '.sd-page-top' ),
					),
					array(
						'id'   => 'sd_woo_styling_info',
						'type' => 'info',
						'desc' => __( 'WooCommerce Sections Styling', 'sd-framework' ),
                     ),
					 array(
						'id'          => 'sd_shop_sidebar_bg',
						'type'        => 'color',
						'title'       => __( 'Shop Sidebar Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select background color of the shop sidebar.', 'sd-framework' ),
						'desc'        => __( 'Default is #f5f7fb', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-sidebar-shop .sd-sidebar-widget' ),
					),
					array(
						'id'          => 'sd_prod_content_bg',
						'type'        => 'color',
						'title'       => __( 'Product Content Box Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select background color of product item content box.', 'sd-framework' ),
						'desc'        => __( 'Default is #f1f4f8', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-product-content' ),
					),
					array(
						'id'          => 'sd_single_prod_desc_tabs',
						'type'        => 'color',
						'title'       => __( 'Product Description Tabs', 'sd-framework' ), 
						'subtitle'    => __( 'Select background color of the product description tabs.', 'sd-framework' ),
						'desc'        => __( 'Default is #f1f4f8', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-woo .woocommerce-tabs .tabs li a, .sd-woo .woocommerce-tabs .panel' ),
					),
					array(
						'id'          => 'sd_single_prod_desc_tabs_active',
						'type'        => 'color',
						'title'       => __( 'Product Description Active Tab', 'sd-framework' ), 
						'subtitle'    => __( 'Select background color of active product description tab.', 'sd-framework' ),
						'desc'        => __( 'Default is #91a1b4', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-woo .woocommerce-tabs .tabs li.active a' ),
					),
					array(
						'id'   => 'sd_campaigns_styling_info',
						'type' => 'info',
						'desc' => __( 'Campaigns Styling', 'sd-framework' ),
					),
					array(
						'id'          => 'sd_campaign_content_bg',
						'type'        => 'color',
						'title'       => __( 'Campaign Content Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select background color for the campaign content.', 'sd-framework' ),
						'desc'        => __( 'Default is #f1f4f8', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-campaign-listing .sd-carousel-item-content' ),
					),
					array(
						'id'   => 'sd_events_styling_info',
						'type' => 'info',
						'desc' => __( 'Events Styling', 'sd-framework' ),
					),
					array(
						'id'          => 'sd_event_content_bg',
						'type'        => 'color',
						'title'       => __( 'Event Content Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select background color for the event content.', 'sd-framework' ),
						'desc'        => __( 'Default is #f1f4f8', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.ev-listing-content' ),
					),
					array(
						'id'          => 'sd_event_content_date_bg',
						'type'        => 'color',
						'title'       => __( 'Event Content Date Bar Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select background color for the event date bar.', 'sd-framework' ),
						'desc'        => __( 'Default is #f8fafc', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.ev-listing-date' ),
					),
					array(
						'id'          => 'sd_event_countdown_bg',
						'type'        => 'color',
						'title'       => __( 'Single Event Countdown Background', 'sd-framework' ), 
						'subtitle'    => __( 'Select background color for the event countdown.', 'sd-framework' ),
						'desc'        => __( 'Default is #435061', 'sd-framework' ),
						'transparent' => false,
						'compiler'    => array( 'background-color' => '.sd-count-wrap' ),
					),
					array(
						'id'   => 'sd_custom_css_styling_info',
						'type' => 'info',
						'desc' => __( 'Custom CSS Styling', 'sd-framework' ),
					),
					array(
						'id'       => 'sd_custom_css',
						'type'     => 'ace_editor',
						'title'    => __( 'Custom Styling', 'sd-framework' ),
						'subtitle' => __( 'Insert your custom CSS code here.', 'sd-framework' ),
						'mode'     => 'css',
						'theme'    => 'chrome',
						'options'  => array( 'minLines'=> 50 ),
					),
				),
			) );

			Redux::setSection( $opt_name, array(
				'title'     => __('404 Page', 'sd-framework'),
				'desc'      => '',
				'icon'      => 'el-icon-error',
				'fields'    => array(
					array(
						'id'       => 'sd_404_layout',
						'type'     => 'select',
						'title'    => __( '404 Page Layout', 'sd-framework' ),
						'subtitle' => __( 'Select the layout for the 404 error page.', 'sd-framework' ),
						'options'  => array(
										'1' => __( 'With Sidebar', 'sd-framework' ),
										'2' => __( 'Full Width', 'sd-framework' ),
                                      ),
						'default'  => '2',
					),
					array(
						'id'       => 'sd_404_style',
						'type'     => 'select',
						'title'    => __( '404 Page Style', 'sd-framework' ),
						'subtitle' => __( 'Select the layout for the 404 error page.', 'sd-framework' ),
						'options'  => array(
										'1' => __( 'Default', 'sd-framework' ),
										'2' => __( 'Custom Content', 'sd-framework' ),
                                      ),
						'default'  => '1',
					),
					array(
						'id'       => 'sd_404_sidebars',
						'type'     => 'select',
						'title'    => __( '404 Page Sidebars', 'sd-framework' ),
						'subtitle' => __( 'Select the sidebar layout of the 404 page.', 'sd-framework' ),
						'options'  => array(
										'1' => __( 'No Sidebar', 'sd-framework' ),
										'2' => __( '1 Column', 'sd-framework' ),
										'3' => __( '2 Columns', 'sd-framework' ),
										'4' => __( '3 Columns', 'sd-framework' ),
                                      ),
						'default'  => '2',
					),
					array(
						'id'       => 'sd_404_button1_text',
						'type'     => 'text',
						'title'    => __( '404 Page Button 1 Text', 'sd-framework' ),
						'subtitle' => __( 'Insert the text of button 1 on the 404 page.', 'sd-framework' ),
						'default'  => __( 'GO TO CAUSES PAGE', 'sd-framework' ),
						'required' => array( 'sd_404_style', "=", 1 ),
					),
					array(
						'id'       => 'sd_404_button1_url',
						'type'     => 'text',
						'title'    => __( '404 Page Button 1 Url', 'sd-framework' ),
						'subtitle' => __( 'Insert the url of button 1 on the 404 page.', 'sd-framework' ),
						'desc'     => __( 'Leave empty to hide button.', 'sd-framework' ),
						'default'  => '',
						'validate' => 'url',
						'required' => array( 'sd_404_style', "=", 1 ),
					),
					array(
						'id'       => 'sd_404_button2_text',
						'type'     => 'text',
						'title'    => __( '404 Page Button 2 Text', 'sd-framework' ),
						'subtitle' => __( 'Insert the text of button 2 on the 404 page.', 'sd-framework' ),
						'default'  => __( 'GO TO HOMEPAGE', 'sd-framework' ),
						'required' => array( 'sd_404_style', "=", 1 ),
					),
					array(
						'id'       => 'sd_404_button2_url',
						'type'     => 'text',
						'title'    => __( '404 Page Button 2 Url', 'sd-framework' ),
						'subtitle' => __( 'Insert the url of button 2 on the 404 page.', 'sd-framework' ),
						'desc'     => __( 'Leave empty to hide button.', 'sd-framework' ),
						'default'  => '',
						'validate' => 'url',
						'required' => array( 'sd_404_style', "=", 1 ),
					),
					array(
						'id'       => 'sd_404_title',
						'type'     => 'text',
						'title'    => __( '404 Page Title', 'sd-framework' ),
						'subtitle' => __( 'Insert a custom 404 error page title.', 'sd-framework' ),
						'default'  => __( 'Ooops, 404 Not Found!', 'sd-framework' ),
					),
					
					array(
						'id'        => 'sd_404_content',
						'type'      => 'editor',
						'title'     => __( '404 Page Content', 'sd-framework' ),
						'subtitle' => __( 'Insert your custom content for the 404 error page.', 'sd-framework' ),
						'args'     => array(
                                        'teeny' => false,
                         ),
						 'required' => array( 'sd_404_style', "=", 2 ),
					),
				),
			) );
			
			Redux::setSection( $opt_name, array(
				'title'     => __('Admin Page', 'sd-framework'),
				'desc'      => '',
				'icon'      => 'el-icon-lock',
				'fields'    => array(
					array(
						'id'       => 'sd_admin_logo_upload',
						'type'     => 'media',
						'url'      => false,
						'title'    => __( 'Custom Admin Logo', 'sd-framework' ),
						'compiler' => 'true',
						'desc'     => __( 'Upload your custom admin logo image.', 'sd-framework' ),
						'default'  => array( 'url'	=> get_template_directory_uri() . '/framework/images/sd-logo.png' ),
					),
					array(
						'id'       => 'sd_admin_logo_height',
						'type'     => 'dimensions',
						'title'    => __( 'Logo Height', 'sd-framework' ),
						'subtitle' => __( 'Insert the height of your logo.', 'sd-framework' ),
						'width'	   => false,
						'units'    => array('px'),
					),
					array(
						'id'        => 'sd_admin_url',
						'type'      => 'text',
						'title'     => __('Admin logo URL', 'sd-framework'),
						'subtitle'  => __('Insert your custom admin logo URL.', 'sd-framework'),
						'desc'      => __('Always start with http://', 'sd-framework')
					),
				),
			) );
			Redux::setSection( $opt_name, array(
				'title'      => __( 'Campaign', 'sd-framework' ),
				'desc'      => '',
				'icon'       => 'el-icon-heart',
				'fields'     => array(
					array(
						'id'       => 'sd_donors',
						'type'     => 'text',
						'title'    => __( 'Number of Latest Donors', 'sd-framework' ),
						'subtitle' => __( 'Number of latest donors to be displayed on the campaign page.', 'sd-framework' ),
						'default'  => __( '4', 'sd-framework' ),
					),
					array(
                    	'id'        => 'sd_campaign_share',
                        'type'      => 'switch',
	                    'title'     => __( 'Campaign Share Icons', 'sd-framework' ),
    	                'subtitle'  => __( 'Enable or disable campaign share icons.', 'sd-framework' ),
						'on'        => __( 'Enabled', 'sd-framework' ),
	                    'off'       => __( 'Disabled', 'sd-framework' ),
						'default'   => true,
					),
					array(
						'id'       => 'sd_campaign_share_icons',
						'type'     => 'checkbox',
						'title'    => __( 'Campaign Share Icons Options', 'sd-framework' ),
						'subtitle' => __( 'Select which share icons you want to display.', 'sd-framework' ),
						'desc'     => __( 'Share icons are displayed just under the campaign content.', 'sd-framework' ),
						'options'  => array(
							'1' => __( 'Facebook', 'sd-framework' ),
							'2' => __( 'Twitter', 'sd-framework' ),
							'3' => __( 'Google+', 'sd-framework' ),
							'4' => __( 'Delicious', 'sd-framework' ),
							'5' => __( 'Stumble Upon', 'sd-framework' ),
							'6' => __( 'Digg', 'sd-framework' ),
							'7' => __( 'Reddit', 'sd-framework' ),
							'8' => __( 'E-Mail', 'sd-framework' ),
						),
						'default'  => array(
							'1' => '1',
							'2' => '1',
							'3' => '1',
							'4' => '0',
							'5' => '0',
							'6' => '0',
							'7' => '0',
							'8' => '1',
						),
						'required'  => array( 'sd_campaign_share', "=", 1 ),
					),
				),
			) );
			
			if ( class_exists( 'WooCommerce' ) ) {
			
				Redux::setSection( $opt_name, array(
					'title'     => __('WooCommerce', 'sd-framework'),
					'desc'      => '',
					'icon'      => 'el-icon-shopping-cart',
					'fields'    => array(
						
						array(
							'id'       => 'sd_shop_page_sidebar',
							'type'     => 'select',
							'title'    => __( 'Shop Page Sidebar', 'sd-framework' ),
							'subtitle' => __( 'Select the sidebar layout for the shop page.', 'sd-framework' ),
							'options'  => array(
								'1' => __( 'With Sidebar', 'sd-framework' ),
								'2' => __( 'Full Width', 'sd-framework' )
							 ),
							'default'  => '1',
						),
						array(
							'id'       => 'sd_shop_sidebar_location',
							'type'     => 'image_select',
							'title'    => __( 'Shop Sidebar Location', 'sd-framework' ),
							'subtitle' => __( 'Select the location of the shop sidebar.', 'sd-framework' ),
							'options'  => array(
								'1' => array(
									'alt' => __( 'Right', 'sd-framework' ),
									'img' => $sd_assets_url . 'img/2cr.png'
								),
								'2' => array(
									'alt' => __( 'Left', 'sd-framework' ),
									'img' => $sd_assets_url . 'img/2cl.png'
								),
							),
							'default'  => '1',
							'required'  => array( 'sd_shop_page_sidebar', "=", 1 ),
						),
						array(
							'id'       => 'sd_products_nr',
							'type'     => 'text',
							'title'    => __( 'Number of Products', 'sd-framework' ),
							'subtitle' => __( 'Number of products to display on the shop page.', 'sd-framework' ),
							'default'  => '9',
						),
						array(
							'id'        => 'sd_minicart_top',
							'type'      => 'switch',
							'title'     => __( 'Top Bar Menu WooCommerce Mini Cart', 'sd-framework' ),
							'subtitle'  => __( 'Enable or disable header top bar menu WooCommerce mini cart.', 'sd-framework' ),
							'on'        => __( 'Enabled', 'sd-framework' ),
							'off'       => __( 'Disabled', 'sd-framework' ),
							'default'   => false,
						),
						array(
							'id'        => 'sd_minicart_main',
							'type'      => 'switch',
							'title'     => __( 'Main Menu WooCommerce Mini Cart', 'sd-framework' ),
							'subtitle'  => __( 'Enable or disable header main menu WooCommerce mini cart.', 'sd-framework' ),
							'on'        => __( 'Enabled', 'sd-framework' ),
							'off'       => __( 'Disabled', 'sd-framework' ),
							'default'   => true,
						),
					),
				) );
			
			}
			
    /*
     * <--- END SECTIONS
     */
	 
	 function compiler_action($options, $css) {
            //echo '<h1>The compiler hook has run!';
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            
              // Custom static CSS file
              if ( is_multisite() ) {
				  $filename = dirname(__FILE__) . '/custom-styles-' . get_current_blog_id() . '.css';
			  } else {
				  $filename = dirname(__FILE__) . '/custom-styles' . '.css';
			  }
              global $wp_filesystem;
              
			  if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
              	WP_Filesystem();
              }

              if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
              }
            
        }
		
		add_filter('redux/options/sd_data/compiler', 'compiler_action', 10, 2);
		
		function sd_redux_styles() {
			wp_register_style( 'sd-redux-styles', get_template_directory_uri() . '/admin/sd-admin-options/sd-redux-styles.css', array( 'redux-css' ), '', 'all' );
			wp_enqueue_style( 'sd-redux-styles' );
		}
		
		add_action('redux/page/sd_data/enqueue', 'sd_redux_styles' ) ;

	// add font awesome to redux
	if (!function_exists('sd_redux_admin_css')) {
		function sd_redux_admin_css() {
    		// Uncomment this to remove elusive icon from the panel completely
		    //wp_deregister_style( 'redux-elusive-icon' );
		    //wp_deregister_style( 'redux-elusive-icon-ie7' );
 
    		wp_register_style(
	        	'sd-redux-font-awesome',
		        get_template_directory_uri() . '/framework/css/font-awesome.css',
        		array(),
			    time(),
        		'all'
		    ); 
		    wp_enqueue_style( 'sd-redux-font-awesome' );

			wp_register_style(
	        	'sd-redux-admin-styles',
		        get_template_directory_uri() . '/framework/admin/sd-admin-options/sd-redux-styles.css',
        		array(),
			    time(),
        		'all'
		    ); 
		    wp_enqueue_style( 'sd-redux-admin-styles' );
		}
	}
		
	add_action( 'redux/page/sd_data/enqueue', 'sd_redux_admin_css' );
   
   
    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    function change_arguments( $args ) {
        //$args['dev_mode'] = true;

        return $args;
    }

    // Remove the demo link and the notice of integrated demo from the redux-framework plugin
    function remove_demo() {

        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
