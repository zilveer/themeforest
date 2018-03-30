<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if ( ! class_exists( 'Redux_Framework_options_config' ) ) {

    class Redux_Framework_options_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
            if ( ! class_exists( 'ReduxFramework' ) ) {
                return;
            }

            $this->initSettings();
        }

        public function initSettings() {
            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }

        public function setSections() {

            $page_title_bg_url = THEME_URL . 'assets/images/bg-page-title.jpg';
            $logo_under_construction = THEME_URL . 'assets/images/logo_under_construction.png';
            $image_left_under_construction = THEME_URL . 'assets/images/image_left.png';

            // General Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'General Setting', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-wrench',
                'fields' => array(
                    array(
                        'id' => 'home_preloader',
                        'type' => 'select',
                        'title' => esc_html__('Home Preloader', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Home Preloader', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'square-1'	=> 'Square 01',
                            'square-2'	=> 'Square 02',
                            'square-3'	=> 'Square 03',
                            'square-4'	=> 'Square 04',
                            'square-5'	=> 'Square 05',
                            'square-6'	=> 'Square 06',
                            'square-7'	=> 'Square 07',
                            'square-8'	=> 'Square 08',
                            'square-9'	=> 'Square 09',
                            'round-1'	=> 'Round 01',
                            'round-2'	=> 'Round 02',
                            'round-3'	=> 'Round 03',
                            'round-4'	=> 'Round 04',
                            'round-5'	=> 'Round 05',
                            'round-6'	=> 'Round 06',
                            'round-7'	=> 'Round 07',
                            'round-8'	=> 'Round 08',
                            'round-9'	=> 'Round 09',
                            'various-1'	=> 'Various 01',
                            'various-2'	=> 'Various 02',
                            'various-3'	=> 'Various 03',
                            'various-4'	=> 'Various 04',
                            'various-5'	=> 'Various 05',
                            'various-6'	=> 'Various 06',
                            'various-7'	=> 'Various 07',
                            'various-8'	=> 'Various 08',
                            'various-9'	=> 'Various 09',
                            'various-10'	=> 'Various 10',

                        ),
                        'default' => ''
                    ),


                    array(
                        'id'       => 'home_preloader_bg_color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__( 'Preloader background color', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Set Preloader background color.', 'g5plus-handmade' ),
                        'default'  => array(),
                        'mode'     => 'background',
                        'validate' => 'colorrgba',
	                    'required'  => array('home_preloader', 'not_empty_and', array('none')),
                    ),

                    array(
                        'id'       => 'home_preloader_spinner_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Preloader spinner color', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Pick a preloader spinner color for the Top Bar', 'g5plus-handmade'),
                        'default'  => '',
                        'validate' => 'color',
	                    'required'  => array('home_preloader', 'not_empty_and', array('none')),
                    ),

                    array(
                        'id' => 'smooth_scroll',
                        'type' => 'button_set',
                        'title' => esc_html__('Smooth Scroll', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Smooth Scroll', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

                    array(
                        'id' => 'custom_scroll',
                        'type' => 'button_set',
                        'title' => esc_html__('Custom Scroll', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Custom Scroll', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

                    array(
                        'id'        => 'custom_scroll_width',
                        'type'      => 'text',
                        'title'     => esc_html__('Custom Scroll Width', 'g5plus-handmade'),
                        'subtitle'  => esc_html__('This must be numeric (no px) or empty.', 'g5plus-handmade'),
                        'validate'  => 'numeric',
                        'default'   => '10',
                        'required'  => array('custom_scroll', '=', array('1')),
                    ),

                    array(
                        'id'       => 'custom_scroll_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Custom Scroll Color', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Custom Scroll Color', 'g5plus-handmade'),
                        'default'  => '#19394B',
                        'validate' => 'color',
                        'required'  => array('custom_scroll', '=', array('1')),
                    ),

                    array(
                        'id'       => 'custom_scroll_thumb_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Custom Scroll Thumb Color', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Custom Scroll Thumb Color', 'g5plus-handmade'),
                        'default'  => '#e8aa00',
                        'validate' => 'color',
                        'required'  => array('custom_scroll', '=', array('1')),
                    ),


                    array(
                        'id' => 'panel_selector',
                        'type' => 'button_set',
                        'title' => esc_html__('Panel Selector', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Panel Selector', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'back_to_top',
                        'type' => 'button_set',
                        'title' => esc_html__('Back To Top', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Back to top button', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),

	                array(
		                'id' => 'enable_rtl_mode',
		                'type' => 'button_set',
		                'title' => esc_html__('Enable RTL mode', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Enable/Disable RTL mode', 'g5plus-handmade'),
		                'desc' => '',
		                'options' => array('1' => 'On','0' => 'Off'),
		                'default' => '0'
	                ),


	                array(
                        'id' => 'enable_social_meta',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Social Meta Tags', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable the social meta head tag output.', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

                    array(
                        'id' => 'twitter_author_username',
                        'type' => 'text',
                        'title' => esc_html__('Twitter Publisher Username', 'g5plus-handmade'),
                        'subtitle' => esc_html__( 'Enter your twitter username here, to be used for the Twitter Card date. Ensure that you do not include the @ symbol.','g5plus-handmade'),
                        'desc' => '',
                        'default' => "",
                        'required'  => array('enable_social_meta', '=', array('1')),
                    ),
                    array(
                        'id' => 'googleplus_author',
                        'type' => 'text',
                        'title' => esc_html__('Google+ Username', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enter your Google+ username here, to be used for the authorship meta.','g5plus-handmade'),
                        'desc' => '',
                        'default' => "",
                        'required'  => array('enable_social_meta', '=', array('1')),
                    ),


                    array(
                        'id' => 'general_divide_2',
                        'type' => 'divide'
                    ),
                    array(
                        'id' => 'layout_style',
                        'type' => 'image_select',
                        'title' => esc_html__('Layout Style', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select the layout style', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'boxed' => array('title' => 'Boxed', 'img' => THEME_URL.'assets/images/theme-options/layout-boxed.png'),
                            'wide' => array('title' => 'Wide', 'img' => THEME_URL.'assets/images/theme-options/layout-wide.png'),
                            'float' => array('title' => 'Float', 'img' => THEME_URL.'assets/images/theme-options/layout-float.png')
                        ),
                        'default' => 'wide'
                    ),


                    array(
                        'id' => 'body_background_mode',
                        'type' => 'button_set',
                        'title' => esc_html__('Body Background Mode', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Chose Background Mode', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('background' => 'Background','pattern' => 'Pattern'),
                        'default' => 'background'
                    ),

                    array(
                        'id'       => 'body_background',
                        'type'     => 'background',
                        'output'   => array( 'body' ),
                        'title'    => esc_html__( 'Body Background', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Body background (Apply for Boxed layout style).', 'g5plus-handmade' ),
                        'default'  => array(
                            'background-color' => '',
                            'background-repeat' => 'no-repeat',
                            'background-position' => 'center center',
                            'background-attachment' => 'fixed',
                            'background-size' => 'cover'
                        ),
                        'required'  => array(
                                array('body_background_mode', '=', array('background'))
                        ),
                    ),
                    array(
                        'id' => 'body_background_pattern',
                        'type' => 'image_select',
                        'title' => esc_html__('Background Pattern', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Body background pattern(Apply for Boxed layout style)', 'g5plus-handmade'),
                        'desc' => '',
                        'height' => '40px',
                        'options' => array(
                            'pattern-1.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-1.png'),
                            'pattern-2.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-2.png'),
                            'pattern-3.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-3.png'),
                            'pattern-4.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-4.png'),
                            'pattern-5.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-5.png'),
                            'pattern-6.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-6.png'),
                            'pattern-7.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-7.png'),
                            'pattern-8.png' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/pattern-8.png'),
                        ),
                        'default' => 'pattern-1.png',
                        'required'  => array(
                                array('body_background_mode', '=', array('pattern'))
                            ) ,
                    ),
                )
            );

            $this->sections[] = array(
                'title' => esc_html__('Maintenance Mode', 'g5plus-handmade'),
                'desc' => '',
                'subsection' => true,
                'icon' => 'el-icon-eye-close',
                'fields' => array(
                    array(
                        'id' => 'enable_maintenance',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Maintenance', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable the themes maintenance mode.', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('2' => 'On (Custom Page)', '1' => 'On (Standard)','0' => 'Off',),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'maintenance_mode_page',
                        'type' => 'select',
                        'data' => 'pages',
                        'required'  => array('enable_maintenance', '=', '2'),
                        'title' => esc_html__('Custom Maintenance Mode Page', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select the page that is your maintenace page, if you would like to show a custom page instead of the standard WordPress message. You should use the Holding Page template for this page.', 'g5plus-handmade'),
                        'desc' => '',
                        'default' => '',
                        'args' => array()
                    ),
                ),
            );


            // Performance Options
            $this->sections[] = array(
                'title'  => esc_html__( 'Performance', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-dashboard',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'enable_minifile_js',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Mini File JS', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Mini File JS', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'enable_minifile_css',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Mini File CSS', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Mini File CSS', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),
                )
            );

            // Custom Favicon
            $this->sections[] = array(
                'title'  => esc_html__( 'Custom Favicon', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-eye-open',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'custom_favicon',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom favicon', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Upload a 16px x 16px Png/Gif/ico image that will represent your website favicon', 'g5plus-handmade'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_title',
                        'type' => 'text',
                        'title' => esc_html__('Custom iOS Bookmark Title', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enter a custom title for your site for when it is added as an iOS bookmark.', 'g5plus-handmade'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon57',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 57x57', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Upload a 57px x 57px Png image that will be your website bookmark on non-retina iOS devices.', 'g5plus-handmade'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon72',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 72x72', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Upload a 72px x 72px Png image that will be your website bookmark on non-retina iOS devices.', 'g5plus-handmade'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon114',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 114x114', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Upload a 114px x 114px Png image that will be your website bookmark on retina iOS devices.', 'g5plus-handmade'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon144',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 144x144', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Upload a 144px x 144px Png image that will be your website bookmark on retina iOS devices.', 'g5plus-handmade'),
                        'desc' => ''
                    ),
                )
            );


            // 404
            $this->sections[] = array(
                'title'  => esc_html__( '404 Setting', 'g5plus-handmade' ),
                'desc'   => '',
                'subsection' => true,
                'icon'   => 'el el-error',
                'fields' => array(
                    array(
                        'id'        => 'page_title_404',
                        'type'      => 'text',
                        'title'     => esc_html__('Page Title 404', 'g5plus-handmade'),
                        'default'   => '404 Error',
                    ),
                    array(
                        'id'        => 'sub_page_title_404',
                        'type'      => 'text',
                        'title'     => esc_html__('SubPage Title 404', 'g5plus-handmade'),
                        'default'   => '',
                    ),
                    array(
                        'id' => 'page_404_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background page title', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Upload your background image here.', 'g5plus-handmade'),
                        'desc' => '',
                        'default' =>  array(
                            'url' => $page_title_bg_url
                        )
                    ),
                    array(
                        'id'        => 'title_404',
                        'type'      => 'text',
                        'title'     => esc_html__('Title 404', 'g5plus-handmade'),
                        'default'   => '404 Page',
                    ),
                    array(
                        'id'        => 'subtitle_404',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Subtitle 404', 'g5plus-handmade'),
                        'default'   => 'The page you are looking for does not exist.',
                    ),
                    array(
                        'id'        => 'go_back_404',
                        'type'      => 'text',
                        'title'     => esc_html__('Go back label', 'g5plus-handmade'),
                        'default'   => 'home page',
                    ),
                    array(
                        'id'        => 'go_back_url_404',
                        'type'      => 'text',
                        'title'     => esc_html__('Go back link', 'g5plus-handmade'),
                        'default'   => '',
                    )
                )
            );

            // Pages Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'Pages Setting', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-th',
                'fields' => array(
                    array(
                        'id' => 'page_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select Page Layout', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'page_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Sidebar', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Sidebar Style', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-right.png'),
                            'both' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-both.png'),
                        ),
                        'default' => 'right'
                    ),

                    array(
                        'id' => 'page_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Sidebar Width', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('small' => 'Small (1/4)', 'large' => 'Large (1/3)'),
                        'default' => 'small',
                        'required'  => array('page_sidebar', '=', array('left','both','right')),
                    ),



                    array(
                        'id' => 'page_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Left Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-1',
                        'required'  => array('page_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'page_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Right Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-2',
                        'required'  => array('page_sidebar', '=', array('right','both')),
                    ),


                    array(
                        'id' => 'page_title_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Page Title Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select Page Title Layout', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container',
                    ),

                    array(
                        'id'             => 'page_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Page Title Margin', 'g5plus-handmade'),
                        'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-handmade'),
                        'desc'           => esc_html__('If you would like to override the default page title top/bottom margin, then you can do so here.', 'g5plus-handmade'),
                        'left'          => false,
                        'right'          => false,
                        'output'        => array('.page-title-margin'),
                        'default'            => array(
                            'margin-top'     => '25px',
                            'margin-bottom'  => '55px',
                            'units'          => 'px',
                        )
                    ),

                    array(
                        'id' => 'breadcrumbs_in_page_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Breadcrumbs', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Breadcrumbs In Pages', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'show_page_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Page Title', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Page Title', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),



                    array(
                        'id'       => 'page_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Page Title Text Align', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Set Page Title Text Align', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'default'  => 'center',
                        'required'  => array('show_page_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'page_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Page Title Parallax', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Page Title Parallax', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required'  => array('show_page_title', '=', array('1')),
                    ),





                    array(
                        'id'       => 'page_title_height',
                        'type'     => 'dimensions',
                        'units' => 'px',
                        'width'    =>  false,
                        'title'    => esc_html__('Page Title Height', 'g5plus-handmade'),
                        'desc'      => esc_html__('You can set a height for the page title here', 'g5plus-handmade'),
                        'required'  => array('show_page_title', '=', array('1')),
                        'output' => array('.page-title-height'),
                        'default'  => array(
                            'Height'  => ''
                        )
                    ),


                    array(
                        'id' => 'page_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Page Title Background', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Upload page title background.', 'g5plus-handmade'),
                        'desc' => '',
                        'default' => array(
                            'url' => $page_title_bg_url
                        ),
                        'required'  => array('show_page_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'page_comment',
                        'type' => 'button_set',
                        'title' => esc_html__('Page Comment', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable page comment', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    )
                )
            );

	        // Archive Setting
	        $this->sections[] = array(
		        'title'  => esc_html__( 'Archive Setting', 'g5plus-handmade' ),
		        'desc'   => '',
		        'icon'   => 'el el-folder-close',
		        'fields' => array(

			        array(
				        'id' => 'archive_layout',
				        'type' => 'button_set',
				        'title' => esc_html__('Layout', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Select Archive Layout', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
				        'default' => 'container'
			        ),

			        array(
				        'id' => 'archive_sidebar',
				        'type' => 'image_select',
				        'title' => esc_html__('Sidebar', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Set Sidebar Style', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array(
					        'none' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-none.png'),
					        'left' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-left.png'),
					        'right' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-right.png'),
					        'both' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-both.png'),
				        ),
				        'default' => 'left'
			        ),


			        array(
				        'id' => 'archive_sidebar_width',
				        'type' => 'button_set',
				        'title' => esc_html__('Sidebar Width', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array('small' => 'Small (1/4)', 'large' => 'Large (1/3)'),
				        'default' => 'small',
				        'required'  => array('archive_sidebar', '=', array('left','both','right')),
			        ),

			        array(
				        'id' => 'archive_left_sidebar',
				        'type' => 'select',
				        'title' => esc_html__('Left Sidebar', 'g5plus-handmade'),
				        'subtitle' => "Choose the default left sidebar",
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'sidebar-1',
				        'required'  => array('archive_sidebar', '=', array('left','both')),
			        ),
			        array(
				        'id' => 'archive_right_sidebar',
				        'type' => 'select',
				        'title' => esc_html__('Right Sidebar', 'g5plus-handmade'),
				        'subtitle' => "Choose the default right sidebar",
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'sidebar-2',
				        'required'  => array('archive_sidebar', '=', array('right','both')),
			        ),
			        array(
				        'id' => 'archive_paging_style',
				        'type' => 'button_set',
				        'title' => esc_html__('Paging Style', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Select archive paging style', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array('default' => 'Default', 'load-more' => 'Load More', 'infinity-scroll' => 'Infinity Scroll'),
				        'default' => 'default'
			        ),
                    array(
                        'id' => 'archive_paging_align',
                        'type' => 'button_set',
                        'title' => esc_html__('Paging Align', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select archive paging align', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'left' => esc_html__('Left','g5plus-handmade'),
                            'center' => esc_html__('Center','g5plus-handmade'),
                            'right' => esc_html__('Right','g5plus-handmade')
                        ),
                        'default' => 'right'
                    ),

			        array(
				        'id' => 'archive_display_type',
				        'type' => 'select',
				        'title' => esc_html__('Archive Display Type', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Select archive display type', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array(
                            'large-image' => esc_html__('Large Image','g5plus-handmade'),
                            'medium-image' => esc_html__('Medium Image','g5plus-handmade'),
                            'grid' => esc_html__('Grid','g5plus-handmade'),
                            'masonry' => esc_html__('Masonry','g5plus-handmade'),
				        ),
				        'default' => 'medium-image'
			        ),

			        array(
				        'id' => 'archive_display_columns',
				        'type' => 'select',
				        'title' => esc_html__('Archive Display Columns', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Choose the number of columns to display on archive pages.','g5plus-handmade'),
				        'options' => array(
					        '2'		=> '2',
					        '3'		=> '3',
					        '4'		=> '4',
				        ),
				        'desc' => '',
				        'default' => '2',
				        'required' => array('archive_display_type','=',array('grid','masonry')),
			        ),

                    array(
                        'id' => 'archive_title_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Archive Title Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select Archive Title Layout', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container',
                    ),

                    array(
                        'id'             => 'archive_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Archive Title Margin', 'g5plus-handmade'),
                        'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-handmade'),
                        'desc'           => esc_html__('If you would like to override the default archive title top/bottom margin, then you can do so here.', 'g5plus-handmade'),
                        'left'          => false,
                        'right'          => false,
                        'output'        => array('.archive-title-margin'),
                        'default'            => array(
                            'margin-top'     => '25px',
                            'margin-bottom'  => '55px',
                            'units'          => 'px',
                        )
                    ),

			        array(
				        'id' => 'breadcrumbs_in_archive_title',
				        'type' => 'button_set',
				        'title' => esc_html__('Breadcrumbs', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Enable/Disable Breadcrumbs In Archive', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),

			        array(
				        'id' => 'show_archive_title',
				        'type' => 'button_set',
				        'title' => esc_html__('Show Archive Title', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Enable/Disable Archive Title', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),


                    array(
                        'id'       => 'archive_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Archive Title Text Align', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Set Archive Title Text Align', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'default'  => 'center',
                        'required' => array('show_archive_title','=',array('1')),
                    ),

                    array(
                        'id'       => 'archive_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Archive Title Parallax', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Archive Title Parallax', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required' => array('show_archive_title','=',array('1')),
                    ),


			        array(
				        'id'        => 'archive_title_height',
				        'type'      => 'dimensions',
				        'title'     => esc_html__('Archive Title Height', 'g5plus-handmade'),
				        'desc'      => esc_html__('You can set a height for the archive title here', 'g5plus-handmade'),
				        'required' => array('show_archive_title','=',array('1')),
				        'units' => 'px',
				        'width'    =>  false,
                        'output' => array('.archive-title-height'),
				        'default'  => array(
					        'Height'  => ''
				        )
			        ),

			        array(
				        'id' => 'archive_title_bg_image',
				        'type' => 'media',
				        'url'=> true,
				        'title' => esc_html__('Archive Title Background', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Upload archive title background.', 'g5plus-handmade'),
				        'desc' => '',
				        'default' =>  array(
					        'url' => $page_title_bg_url
				        ),
				        'required' => array('show_archive_title','=',array('1')),
			        ),
		        )
	        );


	        // Search Page Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'Search Page', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-search',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'search_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select Search Layout', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container'
                    ),

                    array(
                        'id' => 'search_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Sidebar', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Sidebar Style', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-right.png'),
                            'both' => array('title' => '', 'img' => THEME_URL . 'assets/images/theme-options/sidebar-both.png'),
                        ),
                        'default' => 'left'
                    ),

                    array(
                        'id' => 'search_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Sidebar Width', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('small' => 'Small (1/4)', 'large' => 'Large (1/3)'),
                        'default' => 'small',
                        'required'  => array('search_sidebar', '=', array('left','both','right')),
                    ),

                    array(
                        'id' => 'search_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Left Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-1',
                        'required'  => array('search_sidebar', '=', array('left','both')),
                    ),

                    array(
                        'id' => 'search_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Right Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-2',
                        'required'  => array('search_sidebar', '=', array('right','both')),
                    ),

                    array(
                        'id' => 'search_paging_style',
                        'type' => 'button_set',
                        'title' => esc_html__('Paging Style', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select search paging style', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('default' => 'Default', 'load-more' => 'Load More', 'infinity-scroll' => 'Infinity Scroll'),
                        'default' => 'default'
                    ),
                    array(
                        'id' => 'search_paging_align',
                        'type' => 'button_set',
                        'title' => esc_html__('Paging Align', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select search paging align', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'left' => esc_html__('Left','g5plus-handmade'),
                            'center' => esc_html__('Center','g5plus-handmade'),
                            'right' => esc_html__('Right','g5plus-handmade')
                        ),
                        'default' => 'right'
                    ),

                )
            );

	        // Single Blog
	        $this->sections[] = array(
		        'title'  => esc_html__( 'Single Blog', 'g5plus-handmade' ),
		        'desc'   => '',
		        'icon'   => 'el el-file',
		        'subsection' => true,
		        'fields' => array(
			        array(
				        'id' => 'single_blog_layout',
				        'type' => 'button_set',
				        'title' => esc_html__('Layout', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Select Single Blog Layout', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
				        'default' => 'container'
			        ),

			        array(
				        'id' => 'single_blog_sidebar',
				        'type' => 'image_select',
				        'title' => esc_html__('Sidebar', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Set Sidebar Style', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array(
					        'none' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-none.png'),
					        'left' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-left.png'),
					        'right' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-right.png'),
					        'both' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-both.png'),
				        ),
				        'default' => 'left'
			        ),

			        array(
				        'id' => 'single_blog_sidebar_width',
				        'type' => 'button_set',
				        'title' => esc_html__('Sidebar Width', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array('small' => 'Small (1/4)', 'large' => 'Large (1/3)'),
				        'default' => 'small',
				        'required'  => array('single_blog_sidebar', '=', array('left','both','right')),
			        ),


			        array(
				        'id' => 'single_blog_left_sidebar',
				        'type' => 'select',
				        'title' => esc_html__('Left Sidebar', 'g5plus-handmade'),
				        'subtitle' => "Choose the default left sidebar",
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'sidebar-1',
				        'required'  => array('single_blog_sidebar', '=', array('left','both')),
			        ),

			        array(
				        'id' => 'single_blog_right_sidebar',
				        'type' => 'select',
				        'title' => esc_html__('Right Sidebar', 'g5plus-handmade'),
				        'subtitle' => "Choose the default right sidebar",
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'sidebar-2',
				        'required'  => array('single_blog_sidebar', '=', array('right','both')),
			        ),




			        array(
				        'id' => 'show_post_navigation',
				        'type' => 'button_set',
				        'title' => esc_html__('Show Post Navigation', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Enable/Disable Post Navigation', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),

			        array(
				        'id' => 'show_author_info',
				        'type' => 'button_set',
				        'title' => esc_html__('Show Author Info', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Enable/Disable Author Info', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),

                    array(
                        'id' => 'single_blog_title_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Single Blog Title Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select Single Blog Title Layout', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container',
                    ),

                    array(
                        'id'             => 'single_blog_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Single Blog Title Margin', 'g5plus-handmade'),
                        'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-handmade'),
                        'desc'           => esc_html__('If you would like to override the default single blog title top/bottom margin, then you can do so here.', 'g5plus-handmade'),
                        'left'          => false,
                        'right'          => false,
                        'output'        => array('.single-blog-title-margin'),
                        'default'            => array(
                            'margin-top'     => '25px',
                            'margin-bottom'  => '55px',
                            'units'          => 'px',
                        )
                    ),


                    array(
                        'id' => 'breadcrumbs_in_single_blog_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Breadcrumbs', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Breadcrumbs In Single Blog', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),

			        array(
				        'id' => 'show_single_blog_title',
				        'type' => 'button_set',
				        'title' => esc_html__('Show Single Blog Title', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Enable/Disable Single Blog Title', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),



                    array(
                        'id'       => 'single_blog_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Single Blog Title Text Align', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Set Single Blog Title Text Align', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'default'  => 'center',
                        'required'  => array('show_single_blog_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'single_blog_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Single Blog Title Parallax', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Single Blog Title Parallax', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required'  => array('show_single_blog_title', '=', array('1')),
                    ),






			        array(
				        'id'        => 'single_blog_title_height',
				        'type'      => 'dimensions',
				        'title'     => esc_html__('Single Blog Title Height', 'g5plus-handmade'),
				        'desc'      => esc_html__('You can set a height for the single blog title here', 'g5plus-handmade'),
				        'required'  => array('show_single_blog_title', '=', array('1')),
				        'units' => 'px',
				        'width'    =>  false,
                        'output' => array('.single-blog-title-height'),
				        'default'  => array(
					        'Height'  => ''
				        )
			        ),

			        array(
				        'id' => 'single_blog_title_bg_image',
				        'type' => 'media',
				        'url'=> true,
				        'title' => esc_html__('Single Blog Title Background', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Upload single blog title background.', 'g5plus-handmade'),
				        'desc' => '',
				        'default' =>  array(
					        'url' => $page_title_bg_url
				        ),
				        'required'  => array('show_single_blog_title', '=', array('1'))
			        ),
		        )
	        );



            // Logo
            $this->sections[] = array(
                'title'  => esc_html__( 'Logo', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-leaf',
                'fields' => array(
                    array(
                        'id' => 'logo',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Logo', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Upload your logo here.', 'g5plus-handmade'),
                        'desc' => '',
                        'default' => array(
                            'url' => THEME_URL . 'assets/images/theme-options/logo.png'
                        )
                    ),

	                array(
		                'id'        => 'logo_height',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Logo Height', 'g5plus-handmade'),
		                'desc'      => esc_html__('You can set a height for the logo here', 'g5plus-handmade'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'Height'  => ''
		                )
	                ),

                    array(
                        'id'        => 'logo_max_height',
                        'type'      => 'dimensions',
                        'title'     => esc_html__('Logo Max Height', 'g5plus-handmade'),
                        'desc'      => esc_html__('You can set a max height for the logo here', 'g5plus-handmade'),
                        'units' => 'px',
                        'width'    =>  false,
                        'default'  => array(
                            'Height'  => ''
                        )
                    ),

	                array(
		                'id'             => 'logo_padding',
		                'type'           => 'spacing',
		                'mode'           => 'padding',
		                'units'          => 'px',
		                'units_extended' => 'false',
		                'title'          => esc_html__('Logo Top/Bottom Padding', 'g5plus-handmade'),
		                'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-handmade'),
		                'desc'           => esc_html__('If you would like to override the default logo top/bottom padding, then you can do so here.', 'g5plus-handmade'),
		                'left'          => false,
		                'right'          => false,
		                'default'            => array(
			                'padding-top'     => '',
			                'padding-bottom'  => '',
			                'units'          => 'px',
		                )
	                ),
	                array(
		                'id' => 'sticky_logo',
		                'type' => 'media',
		                'url'=> true,
		                'title' => esc_html__('Sticky Logo', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Upload a sticky version of your logo here', 'g5plus-handmade'),
		                'desc' => '',
		                'default' => array(
			                'url' => THEME_URL . 'assets/images/theme-options/logo.png'
		                )
	                ),
                )
            );

            // Header
            $this->sections[] = array(
                'title'  => esc_html__( 'Header', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-credit-card',
                'fields' => array(
	                array(
		                'id'       => 'top_drawer_type',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Top Drawer Type', 'g5plus-handmade' ),
		                'subtitle' => esc_html__( 'Set top drawer type.', 'g5plus-handmade' ),
		                'desc'     => '',
		                'options'  => array( 'none' => 'Disable', 'show' => 'Always Show', 'toggle' => 'Toggle' ),
		                'default'  => 'none'
	                ),
	                array(
                        'id'       => 'top_drawer_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Top Drawer Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default top drawer sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'top_drawer_sidebar',
		                'required' => array('top_drawer_type','=',array('show','toggle')),
                    ),

                    array(
                        'id' => 'top_drawer_wrapper_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Top Drawer Wrapper Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select top drawer wrapper layout', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container',
                        'required' => array('top_drawer_type','=',array('show','toggle')),
                    ),

	                array(
		                'id'       => 'top_drawer_hide_mobile',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show/Hide Top Drawer on mobile', 'g5plus-handmade' ),
		                'desc'     => '',
		                'options'  => array( '1' => 'On', '0' => 'Off' ),
		                'default'  => '1',
		                'required' => array('top_drawer_type','=',array('show','toggle')),
	                ),

	                array(
		                'id'             => 'top_drawer_padding',
		                'type'           => 'spacing',
		                'mode'           => 'padding',
		                'units'          => 'px',
		                'units_extended' => 'false',
		                'left'           => false,
		                'right'          => false,
		                'title'          => esc_html__('Top drawer padding', 'g5plus-handmade'),
		                'desc'           => esc_html__('Set top drawer padding (px). Not include units.','g5plus-handmade'),
		                'default'            => array(
			                'padding-top'     => '0',
			                'padding-bottom'  => '0',
			                'units'          => 'px',
		                ),
		                'required' => array('top_drawer_type','=',array('show','toggle')),
	                ),

	                array(
		                'id'       => 'top_bar',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show/Hide Top Bar', 'g5plus-handmade' ),
		                'subtitle' => esc_html__( 'Show Hide Top Bar.', 'g5plus-handmade' ),
		                'desc'     => '',
		                'options'  => array( '1' => 'On', '0' => 'Off' ),
		                'default'  => '0',
	                ),
                    array(
                        'id' => 'top_bar_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Top bar Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select the top bar column layout.', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'top-bar-1' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/top-bar-layout-1.jpg'),
                            'top-bar-2' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/top-bar-layout-2.jpg'),
                            'top-bar-3' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/top-bar-layout-3.jpg'),
	                        'top-bar-4' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/top-bar-layout-4.jpg'),
                        ),
                        'default' => 'top-bar-1',
                        'required' => array('top_bar','=','1'),
                    ),

                    array(
                        'id' => 'top_bar_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Top Left Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default top left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'top_bar_left',
                        'required' => array('top_bar','=','1'),
                    ),
                    array(
                        'id' => 'top_bar_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Top Right Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default top right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'top_bar_right',
                        'required' => array('top_bar','=','1'),
                    ),

                    array(
                        'id' => 'header_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Header Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select a header layout option from the examples.', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'header-1' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-1.jpg'),
	                        'header-2' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-2.jpg'),
	                        'header-3' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-3.jpg'),
	                        'header-4' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-4.jpg'),
	                        'header-5' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-5.jpg'),
	                        'header-6' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-6.jpg'),
	                        'header-7' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-7.jpg'),
	                        'header-8' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-8.jpg'),
	                        'header-9' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-9.jpg'),
                        ),
                        'default' => 'header-1'
                    ),

	                array(
		                'id'        => 'header_scheme',
		                'type'      => 'button_set',
		                'title'     => esc_html__('Header scheme', 'g5plus-handmade'),
		                'options'  => array(
			                'light' => esc_html__('Light','g5plus-handmade'),
			                'transparent' => esc_html__('Transparent','g5plus-handmade'),
			                'customize' => esc_html__('Customize','g5plus-handmade'),
		                ),
		                'default'  => 'light'
	                ),

	                array(
		                'id'       => 'header_background',
		                'type'     => 'background',
		                'title'    => esc_html__('Header background', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Header background with image, color, etc.', 'g5plus-handmade'),
		                'default'  => array(
			                'background-color' => '#fff',
		                ),
		                'required' => array('header_scheme','=','customize'),
	                ),

	                array(
		                'id' => 'header_background_color_opacity',
		                'type'     => 'slider',
		                'title' => esc_html__('Header background color opacity', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Set the opacity level of background color.', 'g5plus-handmade'),
		                'default'  => '100',
		                "min"       => 0,
		                "step"      => 1,
		                "max"       => 100,
		                'required' => array('header_scheme','=','customize'),
	                ),

	                array(
		                'id'       => 'header_border_color',
		                'type'     => 'color_rgba',
		                'title'    => esc_html__('Header border Color', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Set header border Color.', 'g5plus-handmade'),
		                'default'  => array(),
		                'validate' => 'colorrgba',
		                'required' => array('header_scheme','=','customize'),
	                ),
	                array(
		                'id'       => 'header_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Header text color', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Set header text color', 'g5plus-handmade'),
		                'default'  => '#333',
		                'validate' => 'color',
		                'required' => array('header_scheme','=','customize'),
	                ),

	                array(
		                'id'       => 'header_nav_scheme',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Header navigation scheme', 'g5plus-handmade' ),
		                'subtitle' => esc_html__( 'Set header navigation scheme', 'g5plus-handmade' ),
		                'default'  => 'light',
		                'options'  => array(
			                'light' => esc_html__('Light','g5plus-handmade'),
			                'primary-color' => esc_html__('Primary Color','g5plus-handmade'),
			                'transparent' => esc_html__('Transparent','g5plus-handmade'),
			                'customize' => esc_html__('Customize','g5plus-handmade')
		                )
	                ),

	                array(
		                'id'       => 'header_nav_bg_color',
		                'type'     => 'color_rgba',
		                'title'    => esc_html__( 'Header navigation background color', 'g5plus-handmade' ),
		                'subtitle' => esc_html__( 'Set header navigation background color', 'g5plus-handmade' ),
		                'default'  => array(),
		                'mode'     => 'background',
		                'validate' => 'colorrgba',
		                'default'   => array(
			                'color'     => '#f4f4f4',
			                'alpha'     => 1
		                ),
		                'options'       => array(
			                'allow_empty'   => false,
		                ),
		                'required' => array('header_nav_scheme','=','customize'),
	                ),

	                array(
		                'id'       => 'header_nav_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Header navigation text color', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Set header navigation text color', 'g5plus-handmade'),
		                'default'  => '#222',
		                'validate' => 'color',
		                'required' => array('header_nav_scheme','=','customize'),
	                ),

	                array(
		                'id'        => 'header_nav_layout',
		                'type'      => 'button_set',
		                'title'     => esc_html__('Header navigation layout', 'g5plus-handmade'),
		                'options'  => array(
			                'container' => esc_html__('Container','g5plus-handmade'),
			                'nav-fullwith' => esc_html__('Full width','g5plus-handmade'),
		                ),
		                'default'  => 'container'
	                ),

	                array(
		                'id'        => 'header_nav_layout_padding',
		                'type'     => 'slider',
		                'title'     => esc_html__('Header navigation padding left/right (px)', 'g5plus-handmade'),
		                'default'  => '100',
		                "min"       => 0,
		                "step"      => 1,
		                "max"       => 200,
		                'required' => array('header_nav_layout','=','nav-fullwith'),
	                ),

	                array(
		                'id'        => 'header_nav_hover',
		                'type'      => 'button_set',
		                'title'     => esc_html__('Header navigation hover', 'g5plus-handmade'),
		                'options'  => array(
			                'nav-hover-primary' => esc_html__('Primary Color','g5plus-handmade'),
			                'nav-hover-primary-base' => esc_html__('Base Primary Color','g5plus-handmade'),
		                ),
		                'default'  => 'nav-hover-primary'
	                ),

	                array(
		                'id'        => 'header_nav_distance',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Header navigation distance', 'g5plus-handmade'),
		                'desc'      => esc_html__('You can set distance between navigation items. Empty value to default', 'g5plus-handmade'),
		                'units' => 'px',
		                'height'    =>  false,
		                'default'  => array(
			                'Width'  => ''
		                )
	                ),

	                array(
		                'id'       => 'header_layout_float',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Header Float', 'g5plus-handmade' ),
		                'subtitle' => esc_html__( 'Enable/Disable Header Float.', 'g5plus-handmade' ),
		                'desc'     => '',
		                'options'  => array( '1' => 'On', '0' => 'Off' ),
		                'default'  => '0',
	                ),

                    array(
                        'id'       => 'header_sticky',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show/Hide Header Sticky', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Show Hide header Sticky.', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),

	                array(
		                'id'       => 'header_sticky_scheme',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Header sticky scheme', 'g5plus-handmade' ),
		                'subtitle' => esc_html__( 'Choose header sticky scheme', 'g5plus-handmade' ),
		                'desc'     => '',
		                'options'  => array(
			                'inherit'   => esc_html__('Inherit','g5plus-handmade'),
			                'gray'      => esc_html__('Gray','g5plus-handmade'),
			                'light'     => esc_html__('Light','g5plus-handmade'),
			                'dark'     => esc_html__('Dark','g5plus-handmade')
		                ),
		                'default'  => 'inherit'
	                ),

	                array(
		                'id' => 'header_shopping_cart_button',
		                'type' => 'checkbox',
		                'title' => esc_html__('Shopping Cart Button', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Select header shopping cart button', 'g5plus-handmade'),
		                'options' => array(
			                'view-cart' => 'View Cart',
			                'checkout' => 'Checkout',
		                ),
		                'default' => array(
			                'view-cart' => '1',
			                'checkout' => '1',
		                ),
		                'required' => array('header_shopping_cart','=','1'),
	                ),

                    array(
                        'id' => 'search_box_type',
                        'type' => 'button_set',
                        'title' => esc_html__('Search Box Type', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select search box type.', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('standard' => esc_html__('Standard','g5plus-handmade'),'ajax' => esc_html__('Ajax Search','g5plus-handmade')),
                        'default' => 'standard'
                    ),

                    array(
                        'id' => 'search_box_post_type',
                        'type' => 'checkbox',
                        'title' => esc_html__('Post type for Ajax Search', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select post type for ajax search', 'g5plus-handmade'),
                        'options' => array(
                            'post' => 'Post',
	                        'page' => 'Page',
                            'product' => 'Product',
                            'portfolio' => 'Portfolio',
                            'service' => 'Our Services',
                        ),
                        'default' => array(
                            'post'      => '1',
	                        'page'      => '0',
                            'product'   => '1',
                            'portfolio' => '1',
	                        'service'   => '1',
                        ),
                        'required' => array('search_box_type','=','ajax'),
                    ),

                    array(
                        'id'        => 'search_box_result_amount',
                        'type'      => 'text',
                        'title'     => esc_html__('Amount Of Search Result', 'g5plus-handmade'),
                        'subtitle'  => esc_html__('This must be numeric (no px) or empty (default: 8).', 'g5plus-handmade'),
                        'desc'      => esc_html__('Set mount of Search Result', 'g5plus-handmade'),
                        'validate'  => 'numeric',
                        'default'   => '',
                        'required' => array('search_box_type','=','ajax'),
                    ),
                )
            );

	        // Header Customize
	        $this->sections[] = array(
		        'title'  => esc_html__( 'Header Customize', 'g5plus-handmade' ),
		        'desc'   => '',
		        'icon'   => 'el el-credit-card',
		        'fields' => array(
			        array(
				        'id' => 'section-header-customize-nav',
				        'type' => 'section',
				        'title' => esc_html__('Header Customize Navigation', 'g5plus-handmade'),
				        'indent' => true
			        ),
			        array(
				        'id'      => 'header_customize_nav',
				        'type'    => 'sorter',
				        'title'   => 'Header customize navigation',
				        'desc'    => 'Organize how you want the layout to appear on the header navigation',
				        'options' => array(
					        'enabled'  => array(
						        'social-profile' => esc_html__('Social Profile','g5plus-handmade'),
					        ),
					        'disabled' => array(
						        'shopping-cart'   => esc_html__('Shopping Cart','g5plus-handmade'),
						        'shopping-cart-price'   => esc_html__('Shopping Cart With Price','g5plus-handmade'),
						        'search-button' => esc_html__('Search Button','g5plus-handmade'),
						        'search-box' => esc_html__('Search Box','g5plus-handmade'),
						        'search-with-category' => esc_html__('Search Box With Shop Category','g5plus-handmade'),
						        'custom-text' => esc_html__('Custom Text','g5plus-handmade'),
					        )
				        )
			        ),
			        array(
				        'id'       => 'header_customize_nav_search_button_style',
				        'type'     => 'button_set',
				        'title'    => esc_html__( 'Search Button Style', 'g5plus-handmade' ),
				        'subtitle' => esc_html__( 'Select style for search button', 'g5plus-handmade' ),
				        'desc'     => '',
				        'options'  => array(
					        'default'   => esc_html__('Default','g5plus-handmade'),
					        'round'     => esc_html__('Round','g5plus-handmade'),
					        'bordered'   => esc_html__('Bordered','g5plus-handmade'),
				        ),
				        'default'  => 'default',
			        ),

			        array(
				        'id'       => 'header_customize_nav_shopping_cart_style',
				        'type'     => 'button_set',
				        'title'    => esc_html__( 'Shopping cart Style', 'g5plus-handmade' ),
				        'subtitle' => esc_html__( 'Select style for shopping cart', 'g5plus-handmade' ),
				        'desc'     => '',
				        'options'  => array(
					        'default'   => esc_html__('Default','g5plus-handmade'),
					        'round'     => esc_html__('Round','g5plus-handmade'),
					        'bordered'   => esc_html__('Bordered','g5plus-handmade'),
				        ),
				        'default'  => 'default',
			        ),

			        array(
				        'id' => 'header_customize_nav_social_profile',
				        'type' => 'select',
				        'multi' => true,
				        'width' => '100%',
				        'title' => esc_html__('Custom social profiles', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Select social profile for custom text', 'g5plus-handmade'),
				        'options' => array(
					        'twitter'  => esc_html__( 'Twitter', 'g5plus-handmade' ),
					        'facebook'  => esc_html__( 'Facebook', 'g5plus-handmade' ),
					        'dribbble'  => esc_html__( 'Dribbble', 'g5plus-handmade' ),
					        'vimeo'  => esc_html__( 'Vimeo', 'g5plus-handmade' ),
					        'tumblr'  => esc_html__( 'Tumblr', 'g5plus-handmade' ),
					        'skype'  => esc_html__( 'Skype', 'g5plus-handmade' ),
					        'linkedin'  => esc_html__( 'LinkedIn', 'g5plus-handmade' ),
					        'googleplus'  => esc_html__( 'Google+', 'g5plus-handmade' ),
					        'flickr'  => esc_html__( 'Flickr', 'g5plus-handmade' ),
					        'youtube'  => esc_html__( 'YouTube', 'g5plus-handmade' ),
					        'pinterest' => esc_html__( 'Pinterest', 'g5plus-handmade' ),
					        'foursquare'  => esc_html__( 'Foursquare', 'g5plus-handmade' ),
					        'instagram' => esc_html__( 'Instagram', 'g5plus-handmade' ),
					        'github'  => esc_html__( 'GitHub', 'g5plus-handmade' ),
					        'xing' => esc_html__( 'Xing', 'g5plus-handmade' ),
					        'behance'  => esc_html__( 'Behance', 'g5plus-handmade' ),
					        'deviantart'  => esc_html__( 'Deviantart', 'g5plus-handmade' ),
					        'soundcloud'  => esc_html__( 'SoundCloud', 'g5plus-handmade' ),
					        'yelp'  => esc_html__( 'Yelp', 'g5plus-handmade' ),
					        'rss'  => esc_html__( 'RSS Feed', 'g5plus-handmade' ),
					        'email'  => esc_html__( 'Email address', 'g5plus-handmade' ),
				        ),
				        'desc' => '',
				        'default' => ''
			        ),
			        array(
				        'id' => 'header_customize_nav_text',
				        'type' => 'ace_editor',
				        'mode' => 'html',
				        'theme' => 'monokai',
				        'title' => esc_html__('Custom Text Content', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Add Content for Custom Text', 'g5plus-handmade'),
				        'desc' => '',
				        'default' => '',
				        'options'  => array('minLines'=> 5, 'maxLines' => 60),
			        ),
			        array(
				        'id' => 'header_customize_nav_separate',
				        'title' => esc_html__('Header customize separate','g5plus-handmade'),
				        'type'  => 'button_set',
				        'options' => array(
					        '0'   => esc_html__('Off','g5plus-handmade'),
					        '1'   => esc_html__('On','g5plus-handmade'),
				        ),
				        'default'  => '0',
			        ),

			        array(
				        'id' => 'section-header-customize-left',
				        'type' => 'section',
				        'title' => esc_html__('Header Customize Left', 'g5plus-handmade'),
				        'indent' => true
			        ),
			        array(
				        'id'      => 'header_customize_left',
				        'type'    => 'sorter',
				        'title'   => 'Header customize left',
				        'desc'    => 'Organize how you want the layout to appear on the header left',
				        'options' => array(
					        'enabled'  => array(
					        ),
					        'disabled' => array(
						        'shopping-cart'   => esc_html__('Shopping Cart','g5plus-handmade'),
						        'shopping-cart-price'   => esc_html__('Shopping Cart With Price','g5plus-handmade'),
						        'search-button' => esc_html__('Search Button','g5plus-handmade'),
						        'search-box' => esc_html__('Search Box','g5plus-handmade'),
						        'search-with-category' => esc_html__('Search Box With Shop Category','g5plus-handmade'),
						        'social-profile' => esc_html__('Social Profile','g5plus-handmade'),
						        'custom-text' => esc_html__('Custom Text','g5plus-handmade'),
					        )
				        )
			        ),
			        array(
				        'id'       => 'header_customize_left_search_button_style',
				        'type'     => 'button_set',
				        'title'    => esc_html__( 'Search Button Style', 'g5plus-handmade' ),
				        'subtitle' => esc_html__( 'Select style for search button', 'g5plus-handmade' ),
				        'desc'     => '',
				        'options'  => array(
					        'default'   => esc_html__('Default','g5plus-handmade'),
					        'round'     => esc_html__('Round','g5plus-handmade'),
					        'bordered'   => esc_html__('Bordered','g5plus-handmade'),
				        ),
				        'default'  => 'default',
			        ),
			        array(
				        'id'       => 'header_customize_left_shopping_cart_style',
				        'type'     => 'button_set',
				        'title'    => esc_html__( 'Shopping cart Style', 'g5plus-handmade' ),
				        'subtitle' => esc_html__( 'Select style for shopping cart', 'g5plus-handmade' ),
				        'desc'     => '',
				        'options'  => array(
					        'default'   => esc_html__('Default','g5plus-handmade'),
					        'round'     => esc_html__('Round','g5plus-handmade'),
					        'bordered'   => esc_html__('Bordered','g5plus-handmade'),
				        ),
				        'default'  => 'default',
			        ),
			        array(
				        'id' => 'header_customize_left_social_profile',
				        'type' => 'select',
				        'multi' => true,
				        'width' => '100%',
				        'title' => esc_html__('Custom social profiles', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Select social profile for custom text', 'g5plus-handmade'),
				        'options' => array(
					        'twitter'  => esc_html__( 'Twitter', 'g5plus-handmade' ),
					        'facebook'  => esc_html__( 'Facebook', 'g5plus-handmade' ),
					        'dribbble'  => esc_html__( 'Dribbble', 'g5plus-handmade' ),
					        'vimeo'  => esc_html__( 'Vimeo', 'g5plus-handmade' ),
					        'tumblr'  => esc_html__( 'Tumblr', 'g5plus-handmade' ),
					        'skype'  => esc_html__( 'Skype', 'g5plus-handmade' ),
					        'linkedin'  => esc_html__( 'LinkedIn', 'g5plus-handmade' ),
					        'googleplus'  => esc_html__( 'Google+', 'g5plus-handmade' ),
					        'flickr'  => esc_html__( 'Flickr', 'g5plus-handmade' ),
					        'youtube'  => esc_html__( 'YouTube', 'g5plus-handmade' ),
					        'pinterest' => esc_html__( 'Pinterest', 'g5plus-handmade' ),
					        'foursquare'  => esc_html__( 'Foursquare', 'g5plus-handmade' ),
					        'instagram' => esc_html__( 'Instagram', 'g5plus-handmade' ),
					        'github'  => esc_html__( 'GitHub', 'g5plus-handmade' ),
					        'xing' => esc_html__( 'Xing', 'g5plus-handmade' ),
					        'behance'  => esc_html__( 'Behance', 'g5plus-handmade' ),
					        'deviantart'  => esc_html__( 'Deviantart', 'g5plus-handmade' ),
					        'soundcloud'  => esc_html__( 'SoundCloud', 'g5plus-handmade' ),
					        'yelp'  => esc_html__( 'Yelp', 'g5plus-handmade' ),
					        'rss'  => esc_html__( 'RSS Feed', 'g5plus-handmade' ),
					        'email'  => esc_html__( 'Email address', 'g5plus-handmade' ),
				        ),
				        'desc' => '',
				        'default' => ''
			        ),
			        array(
				        'id' => 'header_customize_left_text',
				        'type' => 'ace_editor',
				        'mode' => 'html',
				        'theme' => 'monokai',
				        'title' => esc_html__('Custom Text Content', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Add Content for Custom Text', 'g5plus-handmade'),
				        'desc' => '',
				        'default' => '',
				        'options'  => array('minLines'=> 5, 'maxLines' => 60),
			        ),
			        array(
				        'id' => 'header_customize_left_separate',
				        'title' => esc_html__('Header customize separate','g5plus-handmade'),
				        'type'  => 'button_set',
				        'options' => array(
					        '0'   => esc_html__('Off','g5plus-handmade'),
					        '1'   => esc_html__('On','g5plus-handmade'),
				        ),
				        'default'  => '0',
			        ),

			        array(
				        'id' => 'section-header-customize-right',
				        'type' => 'section',
				        'title' => esc_html__('Header Customize Right', 'g5plus-handmade'),
				        'indent' => true
			        ),
			        array(
				        'id'      => 'header_customize_right',
				        'type'    => 'sorter',
				        'title'   => 'Header customize right',
				        'desc'    => 'Organize how you want the layout to appear on the header right',
				        'options' => array(
					        'enabled'  => array(
						        'search-with-category' => esc_html__('Search Box With Shop Category','g5plus-handmade'),
						        'shopping-cart-price'   => esc_html__('Shopping Cart With Price','g5plus-handmade'),
					        ),
					        'disabled' => array(
						        'shopping-cart'   => esc_html__('Shopping Cart','g5plus-handmade'),
						        'search-button' => esc_html__('Search Button','g5plus-handmade'),
						        'search-box' => esc_html__('Search Box','g5plus-handmade'),
						        'social-profile' => esc_html__('Social Profile','g5plus-handmade'),
						        'custom-text' => esc_html__('Custom Text','g5plus-handmade'),
					        )
				        )
			        ),
			        array(
				        'id'       => 'header_customize_right_search_button_style',
				        'type'     => 'button_set',
				        'title'    => esc_html__( 'Search Button Style', 'g5plus-handmade' ),
				        'subtitle' => esc_html__( 'Select style for search button', 'g5plus-handmade' ),
				        'desc'     => '',
				        'options'  => array(
					        'default'   => esc_html__('Default','g5plus-handmade'),
					        'round'     => esc_html__('Round','g5plus-handmade'),
					        'bordered'   => esc_html__('Bordered','g5plus-handmade'),
				        ),
				        'default'  => 'default',
			        ),
			        array(
				        'id'       => 'header_customize_right_shopping_cart_style',
				        'type'     => 'button_set',
				        'title'    => esc_html__( 'Shopping cart Style', 'g5plus-handmade' ),
				        'subtitle' => esc_html__( 'Select style for shopping cart', 'g5plus-handmade' ),
				        'desc'     => '',
				        'options'  => array(
					        'default'   => esc_html__('Default','g5plus-handmade'),
					        'round'     => esc_html__('Round','g5plus-handmade'),
					        'bordered'   => esc_html__('Bordered','g5plus-handmade'),
				        ),
				        'default'  => 'default',
			        ),
			        array(
				        'id' => 'header_customize_right_social_profile',
				        'type' => 'select',
				        'multi' => true,
				        'width' => '100%',
				        'title' => esc_html__('Custom social profiles', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Select social profile for custom text', 'g5plus-handmade'),
				        'options' => array(
					        'twitter'  => esc_html__( 'Twitter', 'g5plus-handmade' ),
					        'facebook'  => esc_html__( 'Facebook', 'g5plus-handmade' ),
					        'dribbble'  => esc_html__( 'Dribbble', 'g5plus-handmade' ),
					        'vimeo'  => esc_html__( 'Vimeo', 'g5plus-handmade' ),
					        'tumblr'  => esc_html__( 'Tumblr', 'g5plus-handmade' ),
					        'skype'  => esc_html__( 'Skype', 'g5plus-handmade' ),
					        'linkedin'  => esc_html__( 'LinkedIn', 'g5plus-handmade' ),
					        'googleplus'  => esc_html__( 'Google+', 'g5plus-handmade' ),
					        'flickr'  => esc_html__( 'Flickr', 'g5plus-handmade' ),
					        'youtube'  => esc_html__( 'YouTube', 'g5plus-handmade' ),
					        'pinterest' => esc_html__( 'Pinterest', 'g5plus-handmade' ),
					        'foursquare'  => esc_html__( 'Foursquare', 'g5plus-handmade' ),
					        'instagram' => esc_html__( 'Instagram', 'g5plus-handmade' ),
					        'github'  => esc_html__( 'GitHub', 'g5plus-handmade' ),
					        'xing' => esc_html__( 'Xing', 'g5plus-handmade' ),
					        'behance'  => esc_html__( 'Behance', 'g5plus-handmade' ),
					        'deviantart'  => esc_html__( 'Deviantart', 'g5plus-handmade' ),
					        'soundcloud'  => esc_html__( 'SoundCloud', 'g5plus-handmade' ),
					        'yelp'  => esc_html__( 'Yelp', 'g5plus-handmade' ),
					        'rss'  => esc_html__( 'RSS Feed', 'g5plus-handmade' ),
					        'email'  => esc_html__( 'Email address', 'g5plus-handmade' ),
				        ),
				        'desc' => '',
				        'default' => ''
			        ),
			        array(
				        'id' => 'header_customize_right_text',
				        'type' => 'ace_editor',
				        'mode' => 'html',
				        'theme' => 'monokai',
				        'title' => esc_html__('Custom Text Content', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Add Content for Custom Text', 'g5plus-handmade'),
				        'desc' => '',
				        'default' => '',
				        'options'  => array('minLines'=> 5, 'maxLines' => 60),
			        ),
			        array(
				        'id' => 'header_customize_right_separate',
				        'title' => esc_html__('Header customize separate','g5plus-handmade'),
				        'type'  => 'button_set',
				        'options' => array(
					        '0'   => esc_html__('Off','g5plus-handmade'),
					        '1'   => esc_html__('On','g5plus-handmade'),
				        ),
				        'default'  => '0',
			        ),
		        )
	        );

            $this->sections[] = array(
                'title'  => esc_html__( 'Mobile Header', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-th-list',
                'fields' => array(
	                array(
		                'id' => 'mobile_header_layout',
		                'type' => 'image_select',
		                'title' => esc_html__('Header Layout', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Select header mobile layout', 'g5plus-handmade'),
		                'desc' => '',
		                'options' => array(
			                'header-mobile-1' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-mobile-layout-1.png'),
			                'header-mobile-2' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-mobile-layout-2.png'),
			                'header-mobile-3' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-mobile-layout-3.png'),
			                'header-mobile-4' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-mobile-layout-4.png'),
			                'header-mobile-5' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/header-mobile-layout-5.jpg'),
		                ),
		                'default' => 'header-mobile-2'
	                ),

	                array(
		                'id'       => 'mobile_header_menu_drop',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Menu Drop Type', 'g5plus-handmade' ),
		                'subtitle' => esc_html__( 'Set menu drop type for mobile header', 'g5plus-handmade' ),
		                'desc'     => '',
		                'options'  => array(
			                'dropdown' => esc_html__('Dropdown Menu','g5plus-handmade'),
			                'fly' => esc_html__('Fly Menu','g5plus-handmade')
		                ),
		                'default'  => 'fly'
	                ),

	                array(
                        'id' => 'mobile_header_logo',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Mobile Logo', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Upload your logo here.', 'g5plus-handmade'),
                        'desc' => '',
                        'default' => array(
                            'url' => THEME_URL . 'assets/images/theme-options/logo.png'
                        )
                    ),

	                array(
		                'id'        => 'logo_mobile_height',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Logo Height', 'g5plus-handmade'),
		                'desc'      => esc_html__('You can set a height for the logo here', 'g5plus-handmade'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'Height'  => ''
		                )
	                ),

	                array(
		                'id'        => 'logo_mobile_max_height',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Logo Mobile Max Height', 'g5plus-handmade'),
		                'desc'      => esc_html__('You can set a max height for the logo mobile here', 'g5plus-handmade'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'Height'  => ''
		                )
	                ),

	                array(
		                'id'        => 'logo_mobile_padding',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Logo Top/Bottom Padding', 'g5plus-handmade'),
		                'desc'      => esc_html__('If you would like to override the default logo top/bottom padding, then you can do so here', 'g5plus-handmade'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'Height'  => ''
		                )
	                ),

                    array(
                        'id'       => 'mobile_header_top_bar',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Top Bar', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Top bar.', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '0'
                    ),
                    array(
                        'id'       => 'mobile_header_stick',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Stick Mobile Header', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Stick Mobile Header.', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'mobile_header_search_box',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Search Box', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Search Box.', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'mobile_header_shopping_cart',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Shopping Cart', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Shopping Cart', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),
                )
            );

            $this->sections[] = array(
                'title'  => esc_html__( 'Footer', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-website',
                'fields' => array(
	                array(
		                'id' => 'footer_wrap_layout',
		                'type' => 'button_set',
		                'title' => esc_html__('Wrapper Layout', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Select Footer Wrapper Layout', 'g5plus-handmade'),
		                'desc' => '',
		                'options' => array(
                            'full' => esc_html__('Full Width','g5plus-handmade'),
                            'container-fluid' => esc_html__('Container Fluid','g5plus-handmade')
                        ),
		                'default' => 'full'
	                ),


                    array(
                        'id' => 'footer_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select the footer column layout.', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'footer-1' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-1.jpg'),
                            'footer-2' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-2.jpg'),
                            'footer-3' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-3.jpg'),
                            'footer-4' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-4.jpg'),
                            'footer-5' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-5.jpg'),
                            'footer-6' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-6.jpg'),
                            'footer-7' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-7.jpg'),
                            'footer-8' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-8.jpg'),
                            'footer-9' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-9.jpg'),
                        ),
                        'default' => 'footer-1'
                    ),

	                array(
		                'id' => 'footer_sidebar_1',
		                'type' => 'select',
		                'title' => esc_html__('Sidebar 1', 'g5plus-handmade'),
		                'subtitle' => "Choose the default footer sidebar 1",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-1',
	                ),

	                array(
		                'id' => 'footer_sidebar_2',
		                'type' => 'select',
		                'title' => esc_html__('Sidebar 2', 'g5plus-handmade'),
		                'subtitle' => "Choose the default footer sidebar 2",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-2',
	                ),

	                array(
		                'id' => 'footer_sidebar_3',
		                'type' => 'select',
		                'title' => esc_html__('Sidebar 3', 'g5plus-handmade'),
		                'subtitle' => "Choose the default footer sidebar 3",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-3',
	                ),

	                array(
		                'id' => 'footer_sidebar_4',
		                'type' => 'select',
		                'title' => esc_html__('Sidebar 4', 'g5plus-handmade'),
		                'subtitle' => "Choose the default footer sidebar 4",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-4',
	                ),

                    array(
                        'id'             => 'footer_padding',
                        'type'           => 'spacing',
                        'mode'           => 'padding',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Footer Top/Bottom Padding', 'g5plus-handmade'),
                        'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-handmade'),
                        'desc'           => esc_html__('If you would like to override the default footer top/bottom padding, then you can do so here.', 'g5plus-handmade'),
                        'left'          => false,
                        'right'          => false,
                        'default'            => array(
                            'padding-top'     => '',
                            'padding-bottom'  => '',
                            'units'          => 'px',
                        )
                    ),


                    array(
                        'id' => 'footer_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background image', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Upload footer background image here', 'g5plus-handmade'),
                        'desc' => '',
                    ),


	                array(
		                'id' => 'footer_scheme',
		                'type' => 'button_set',
		                'title' => esc_html__('Scheme', 'g5plus-handmade'),
		                'subtitle' => esc_html__( 'Choose footer scheme', 'g5plus-handmade' ),
		                'desc' => '',
		                'options'  => array(
			                'gray'      => esc_html__('Gray','g5plus-handmade'),
			                'light'     => esc_html__('Light','g5plus-handmade'),
			                'dark'     => esc_html__('Dark','g5plus-handmade'),
			                'custom'   => esc_html__('Custom','g5plus-handmade'),
		                ),
		                'default' => 'light'
	                ),





	                array(
		                'id'       => 'footer_bg_color',
		                'type'     => 'color_rgba',
		                'title'    => esc_html__('Background Color', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Set Footer Background Color.', 'g5plus-handmade'),
		                'default'  => array(),
		                'validate' => 'colorrgba',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'footer_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Text Color', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Set Footer Text Color.', 'g5plus-handmade'),
		                'default'  => '',
		                'validate' => 'color',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'footer_heading_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Heading Text Color', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Set Footer Heading Text Color.', 'g5plus-handmade'),
		                'default'  => '',
		                'validate' => 'color',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'bottom_bar_bg_color',
		                'type'     => 'color_rgba',
		                'title'    => esc_html__('Bottom Bar Background Color', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Set Bottom Bar Background Color.', 'g5plus-handmade'),
		                'default'  => array(),
		                'validate' => 'colorrgba',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'bottom_bar_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Bottom Bar Text Color', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Set Bottom Bar Text Color.', 'g5plus-handmade'),
		                'default'  => '',
		                'validate' => 'color',
		                'required' => array('footer_scheme','=','custom'),
	                ),

                    array(
                        'id'       => 'footer_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Footer Parallax', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Footer Parallax', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0'
                    ),
                    array(
                        'id'       => 'collapse_footer',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Collapse footer on mobile device', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable collapse footer', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '0'
                    ),
                    array(
                        'id'       => 'footer_top_bar',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Top Bar', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Top Bar (above Footer)', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),

                    array(
                        'id' => 'footer_top_bar_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Top bar layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select the top bar column layout.', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'footer-top-bar-1' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/bottom-bar-layout-4.jpg'),
                            'footer-top-bar-2' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/bottom-bar-layout-1.jpg')
                        ),
                        'default' => 'footer-top-bar-4',
                        'required' => array('footer_top_bar','=','1'),
                    ),

                    array(
                        'id' => 'footer_top_bar_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Top Left Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default top left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'footer_top_bar_left',
                        'required' => array('footer_top_bar','=','1'),
                    ),
                    array(
                        'id' => 'footer_top_bar_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Top Right Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default top right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'footer_top_bar_right',
                        'required' => array('footer_top_bar','=','1'),
                    ),
                    array(
                        'id'       => 'bottom_bar',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Bottom Bar', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Bottom Bar (below Footer)', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),

                    array(
                        'id' => 'bottom_bar_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Bottom bar Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select the bottom bar column layout.', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'bottom-bar-1' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/bottom-bar-layout-1.jpg'),
                            'bottom-bar-2' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/bottom-bar-layout-2.jpg'),
                            'bottom-bar-3' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/bottom-bar-layout-3.jpg'),
	                        'bottom-bar-4' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/bottom-bar-layout-4.jpg'),
                        ),
                        'default' => 'bottom-bar-1',
                        'required' => array('bottom_bar','=','1'),
                    ),

                    array(
                        'id' => 'bottom_bar_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Bottom Left Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default bottom left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'bottom_bar_left',
                        'required' => array('bottom_bar','=','1'),
                    ),
                    array(
                        'id' => 'bottom_bar_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Bottom Right Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default bottom right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'bottom_bar_right',
                        'required' => array('bottom_bar','=','1'),
                    ),
                )
            );

            $this->sections[] = array(
                'title'  => esc_html__( 'Styling Options', 'g5plus-handmade' ),
                'desc'   => esc_html__( 'If you change value in this section, you must "Save & Generate CSS"', 'g5plus-handmade' ),
                'icon'   => 'el el-magic',
                'fields' => array(
                    array(
                        'id'       => 'primary_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Primary Color', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Primary Color', 'g5plus-handmade'),
                        'default'  => '#DEC18C',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'secondary_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Secondary Color', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Secondary Color', 'g5plus-handmade'),
                        'default'  => '#333',
                        'validate' => 'color',
                    ),


                    array(
                        'id'       => 'text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Text Color', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Text Color.', 'g5plus-handmade'),
                        'default'  => '#777',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'heading_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Heading Color', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Heading Color.', 'g5plus-handmade'),
                        'default'  => '#333333',
                        'validate' => 'color',
                    ),



                    array(
                        'id'       => 'link_color',
                        'type'     => 'link_color',
                        'title'    => esc_html__( 'Link Color', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Link Color.', 'g5plus-handmade' ),
                        'default'  => array(
                            'regular'  => '#DEC18C', // blue
                            'hover'    => '#DEC18C', // red
                            'active'   => '#DEC18C',  // purple
                        ),
                    ),



	                array(
		                'id'       => 'top_drawer_bg_color',
		                'type'     => 'color',
		                'title'    => esc_html__( 'Top drawer background color', 'g5plus-handmade' ),
		                'subtitle' => esc_html__( 'Set Top drawer background color.', 'g5plus-handmade' ),
		                'default'  => '#2f2f2f',
		                'validate' => 'color',
	                ),

	                array(
		                'id'       => 'top_drawer_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Top drawer text color', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Pick a text color for the Top drawer', 'g5plus-handmade'),
		                'default'  => '#c5c5c5',
		                'validate' => 'color',
	                ),

	                array(
		                'id'       => 'top_bar_bg_color',
		                'type'     => 'color_rgba',
		                'title'    => esc_html__( 'Top Bar background color', 'g5plus-handmade' ),
		                'subtitle' => esc_html__( 'Set Top Bar background color.', 'g5plus-handmade' ),
		                'default'  => array(
			                'color' => '#f9f9f9',
			                'alpha' => '1'
		                ),
		                'mode'     => 'background',
		                'validate' => 'colorrgba',
	                ),

	                array(
		                'id'       => 'top_bar_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Top Bar text color', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Pick a text color for the Top Bar', 'g5plus-handmade'),
		                'default'  => '#878787',
		                'validate' => 'color',
	                ),




                    array(
                        'id'=>'styling-color-divide-0',
                        'type' => 'divide'
                    ),

	                array(
		                'id'       => 'menu_sub_scheme',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Sub menu scheme', 'g5plus-handmade' ),
		                'subtitle' => esc_html__( 'Set sub menu scheme', 'g5plus-handmade' ),
		                'default'  => 'light',
		                'options'  => array(
			                'gray' => esc_html__('Gray','g5plus-handmade'),
			                'light' => esc_html__('Light','g5plus-handmade'),
			                'dark' => esc_html__('Dark','g5plus-handmade'),
			                'customize' => esc_html__('Customize','g5plus-handmade')
		                )
	                ),

                    array(
                        'id'       => 'menu_sub_bg_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Sub Menu Background Color', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Sub Menu Background Color.', 'g5plus-handmade'),
                        'default'  => '#fff',
                        'validate' => 'color',
	                    'required'  => array('menu_sub_scheme', '=', 'customize'),
                    ),

                    array(
                        'id'       => 'menu_sub_text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Sub Menu Text Color', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Sub Menu Text Color.', 'g5plus-handmade'),
                        'default'  => '#888',
                        'validate' => 'color',
	                    'required'  => array('menu_sub_scheme', '=', 'customize'),
                    ),

                    array(
                        'id'=>'styling-color-divide-1',
                        'type' => 'divide'
                    ),

                    array(
                        'id' => 'page_title_bg_color',
                        'type'     => 'color',
                        'title' => esc_html__('Page Title Background Color', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Pick a background color for page title.', 'g5plus-handmade'),
                        'default'  => '#FFFFFF',
                        'validate' => 'color'
                    ),
                    array(
                        'id' => 'page_title_overlay_color',
                        'type'     => 'color',
                        'title' => esc_html__('Page Title Background Overlay Color', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Pick a background overlay color for page title.', 'g5plus-handmade'),
                        'default'  => '#fff',
                        'validate' => 'color',
                    ),

                    array(
		                'id' => 'page_title_overlay_opacity',
		                'type'     => 'slider',
		                'title' => esc_html__('Page Title Background Overlay Opacity', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Set the opacity level of the overlay.', 'g5plus-handmade'),
		                'default'  => '30',
		                "min"       => 0,
		                "step"      => 1,
		                "max"       => 100
	                ),
                )
            );

            $this->sections[] = array(
                'icon' => 'el el-font',
                'title' => esc_html__('Font Options', 'g5plus-handmade'),
                'desc'   => esc_html__( 'If you change value in this section, you must "Save & Generate CSS"', 'g5plus-handmade' ),
                'fields' => array(
                    array(
                        'id'=>'body_font',
                        'type' => 'typography',
                        'title' => esc_html__('Body Font', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Specify the body font properties.', 'g5plus-handmade'),
                        'google'=> true,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'line-height'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'14px',
                            'font-family'=>'Varela Round',
                            'font-weight'=>'400',
                            'google'      => true,
                        ),
                    ),
                    array(
                        'id'=>'h1_font',
                        'type' => 'typography',
                        'title' => esc_html__('H1 Font', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Specify the H1 font properties.', 'g5plus-handmade'),
                        'google'=> true,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h1'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h1'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'36px',
                            'font-family' => 'Playfair Display',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h2_font',
                        'type' => 'typography',
                        'title' => esc_html__('H2 Font', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Specify the H2 font properties.', 'g5plus-handmade'),
                        'google'=> true,
                        'line-height'=>false,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'28px',
                            'font-family' => 'Playfair Display',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h3_font',
                        'type' => 'typography',
                        'title' => esc_html__('H3 Font', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Specify the H3 font properties.', 'g5plus-handmade'),
                        'google'=> true,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h3'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h3'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'24px',
                            'font-family' => 'Playfair Display',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h4_font',
                        'type' => 'typography',
                        'title' => esc_html__('H4 Font', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Specify the H4 font properties.', 'g5plus-handmade'),
                        'google'=> true,
                        'text-align'=>false,
                        'line-height'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'21px',
                            'font-family' => 'Playfair Display',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h5_font',
                        'type' => 'typography',
                        'title' => esc_html__('H5 Font', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Specify the H5 font properties.', 'g5plus-handmade'),
                        'google'=> true,
                        'line-height'=>false,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h5'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h5'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'18px',
                            'font-family' => 'Playfair Display',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=>'h6_font',
                        'type' => 'typography',
                        'title' => esc_html__('H6 Font', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Specify the H6 font properties.', 'g5plus-handmade'),
                        'google'=> true,
                        'line-height'=>false,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'14px',
                            'font-family' => 'Playfair Display',
                            'font-weight'=>'400',
                        ),
                    ),
                    array(
                        'id'=> 'menu_font',
                        'type' => 'typography',
                        'title' => esc_html__('Menu Font', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Specify the Menu font properties.', 'g5plus-handmade'),
                        'google' => true,
                        'line-height'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'color'=>false,
                        'text-align'=>false,
                        'font-style' => false,
                        'subsets' => false,
                        'font-size' => false,
                        'font-weight' => false,
                        'output' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Varela Round',
                        ),
                    ),

                    array(
                        'id'=> 'secondary_font',
                        'type' => 'typography',
                        'title' => esc_html__('Secondary Font', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Specify the Secondary font properties.', 'g5plus-handmade'),
                        'google' => true,
                        'line-height'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'color'=>false,
                        'text-align'=>false,
                        'font-style' => false,
                        'subsets' => false,
                        'font-size' => false,
                        'font-weight' => false,
                        'output' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(''), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Playfair Display',
                        ),
                    ),

                    array(
                        'id'=> 'page_title_font',
                        'type' => 'typography',
                        'title' => esc_html__('Page Title Font', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Specify the page title font properties.', 'g5plus-handmade'),
                        'google' => true,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'=>false,
                        'color'=>true,
                        'text-align'=>false,
                        'font-style' => true,
                        'subsets' => false,
                        'font-size' => true,
                        'font-weight' => true,
                        'text-transform' => true,
                        'output' => array('.page-title-inner h1'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Playfair Display',
                            'font-size'=>'35px',
                            'font-weight'=>'400',
                            'text-transform' => 'none',
                            'color' => '#333333'
                        ),
                    ),

                    array(
                        'id'=> 'page_sub_title_font',
                        'type' => 'typography',
                        'title' => esc_html__('Page Sub Title Font', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Specify the page sub title font properties.', 'g5plus-handmade'),
                        'google' => true,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'=>false,
                        'color'=>true,
                        'text-align'=>false,
                        'font-style' => true,
                        'subsets' => false,
                        'font-size' => true,
                        'font-weight' => true,
                        'text-transform' => true,
                        'output' => array('.page-title-inner .page-sub-title'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array(), // An array of CSS selectors to apply this font style to dynamically
                        'units'=> 'px', // Defaults to px
                        'default' => array(
                            'font-family'=>'Playfair Display',
                            'font-size'=>'14px',
                            'font-weight'=>'400italic',
                            'text-transform' => 'none',
                            'color' => '#333333'
                        ),
                    ),


                ),
            );

            $this->sections[] = array(
                'title'  => esc_html__( 'Social Profiles', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-path',
                'fields' => array(
                    array(
                        'id' => 'twitter_url',
                        'type' => 'text',
                        'title' => esc_html__('Twitter', 'g5plus-handmade'),
                        'subtitle' => "Your Twitter",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'facebook_url',
                        'type' => 'text',
                        'title' => esc_html__('Facebook', 'g5plus-handmade'),
                        'subtitle' => "Your facebook page/profile url",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'dribbble_url',
                        'type' => 'text',
                        'title' => esc_html__('Dribbble', 'g5plus-handmade'),
                        'subtitle' => "Your Dribbble",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'vimeo_url',
                        'type' => 'text',
                        'title' => esc_html__('Vimeo', 'g5plus-handmade'),
                        'subtitle' => "Your Vimeo",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'tumblr_url',
                        'type' => 'text',
                        'title' => esc_html__('Tumblr', 'g5plus-handmade'),
                        'subtitle' => "Your Tumblr",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'skype_username',
                        'type' => 'text',
                        'title' => esc_html__('Skype', 'g5plus-handmade'),
                        'subtitle' => "Your Skype username",
                        'desc' => 'Your Skype username',
                        'default' => ''
                    ),
                    array(
                        'id' => 'linkedin_url',
                        'type' => 'text',
                        'title' => esc_html__('LinkedIn', 'g5plus-handmade'),
                        'subtitle' => "Your LinkedIn page/profile url",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'googleplus_url',
                        'type' => 'text',
                        'title' => esc_html__('Google+', 'g5plus-handmade'),
                        'subtitle' => "Your Google+ page/profile URL",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'flickr_url',
                        'type' => 'text',
                        'title' => esc_html__('Flickr', 'g5plus-handmade'),
                        'subtitle' => "Your Flickr page url",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'youtube_url',
                        'type' => 'text',
                        'title' => esc_html__('YouTube', 'g5plus-handmade'),
                        'subtitle' => "Your YouTube URL",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'pinterest_url',
                        'type' => 'text',
                        'title' => esc_html__('Pinterest', 'g5plus-handmade'),
                        'subtitle' => "Your Pinterest",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'foursquare_url',
                        'type' => 'text',
                        'title' => esc_html__('Foursquare', 'g5plus-handmade'),
                        'subtitle' => "Your Foursqaure URL",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'instagram_url',
                        'type' => 'text',
                        'title' => esc_html__('Instagram', 'g5plus-handmade'),
                        'subtitle' => "Your Instagram",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'github_url',
                        'type' => 'text',
                        'title' => esc_html__('GitHub', 'g5plus-handmade'),
                        'subtitle' => "Your GitHub URL",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'xing_url',
                        'type' => 'text',
                        'title' => esc_html__('Xing', 'g5plus-handmade'),
                        'subtitle' => "Your Xing URL",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'behance_url',
                        'type' => 'text',
                        'title' => esc_html__('Behance', 'g5plus-handmade'),
                        'subtitle' => "Your Behance URL",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'deviantart_url',
                        'type' => 'text',
                        'title' => esc_html__('Deviantart', 'g5plus-handmade'),
                        'subtitle' => "Your Deviantart URL",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'soundcloud_url',
                        'type' => 'text',
                        'title' => esc_html__('SoundCloud', 'g5plus-handmade'),
                        'subtitle' => "Your SoundCloud URL",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'yelp_url',
                        'type' => 'text',
                        'title' => esc_html__('Yelp', 'g5plus-handmade'),
                        'subtitle' => "Your Yelp URL",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'rss_url',
                        'type' => 'text',
                        'title' => esc_html__('RSS Feed', 'g5plus-handmade'),
                        'subtitle' => "Your RSS Feed URL",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'email_address',
                        'type' => 'text',
                        'title' => esc_html__('Email address', 'g5plus-handmade'),
                        'subtitle' => "Your email address",
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id'=>'social-profile-divide-0',
                        'type' => 'divide'
                    ),
                    array(
                        'title'    => esc_html__('Social Share', 'g5plus-handmade'),
                        'id'       => 'social_sharing',
                        'type'     => 'checkbox',
                        'subtitle' => esc_html__('Show the social sharing in blog posts', 'g5plus-handmade'),

                        //Must provide key => value pairs for multi checkbox options
                        'options'  => array(
                            'facebook' => 'Facebook',
                            'twitter' => 'Twitter',
                            'google' => 'Google',
                            'linkedin' => 'Linkedin',
                            'tumblr' => 'Tumblr',
                            'pinterest' => 'Pinterest'
                        ),

                        //See how default has changed? you also don't need to specify opts that are 0.
                        'default' => array(
                            'facebook' => '1',
                            'twitter' => '1',
                            'google' => '1',
                            'linkedin' => '1',
                            'tumblr' => '1',
                            'pinterest' => '1'
                        )
                    )
                )
            );

            $this->sections[] = array(
                'title'  => esc_html__( 'Woocommerce', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-shopping-cart',
                'fields' => array(
                    array(
                        'id'       => 'product_show_rating',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Rating', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Show/Hide Rating product', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),


                    array(
                        'id'       => 'product_sale_flash_mode',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Sale Flash Mode', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Chose Sale Flash Mode', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( 'text' => 'Text', 'percent' => 'Percent' ),
                        'default'  => 'percent'
                    ),

                    array(
                        'id'       => 'product_show_result_count',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Result Count', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Show/Hide Result Count In Archive Product', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'product_show_catalog_ordering',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Catalog Ordering', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Show/Hide Catalog Ordering', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'product_show_catalog_page_size',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Catalog Page Size', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Show/Hide Catalog Page Size', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '0'
                    ),
	                array(
		                'id'       => 'product_quick_view',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Quick View', 'g5plus-handmade' ),
		                'subtitle' => esc_html__( 'Enable/Disable Quick View', 'g5plus-handmade' ),
		                'desc'     => '',
		                'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
		                'default'  => '1'
	                ),
                    array(
                        'id'       => 'product_add_to_cart',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Add To Cart Button', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable/Disable Add To Cart Button', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '1'
                    ),
                )
            );


            // Archive Product
            $this->sections[] = array(
                'title'  => esc_html__( 'Archive Product', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-book',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id'        => 'product_per_page',
                        'type'      => 'text',
                        'title'     => esc_html__('Products Per Page', 'g5plus-handmade'),
                        'desc'  => esc_html__('This must be numeric or empty (default 12).', 'g5plus-handmade'),
                        'subtitle'      => esc_html__('Set Products Per Page in archive product', 'g5plus-handmade'),
                        'validate'  => 'numeric',
                        'default'   => '12',
                    ),
                    array(
                        'id' => 'product_display_columns',
                        'type' => 'select',
                        'title' => esc_html__('Product Display Columns', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Choose the number of columns to display on shop/category pages.','g5plus-handmade'),
                        'options' => array(
                            '2'		=> '2',
                            '3'		=> '3',
                            '4'		=> '4'
                        ),
                        'desc' => '',
                        'default' => '3',
                        'select2' => array('allowClear' =>  false) ,
                    ),


                    array(
                        'id' => 'section-archive-product-layout-start',
                        'type' => 'section',
                        'title' => esc_html__('Layout Options', 'g5plus-handmade'),
                        'indent' => true
                    ),



                    array(
                        'id' => 'archive_product_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Archive Product Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select Archive Product Layout', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'archive_product_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Archive Product Sidebar', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Archive Product Sidebar', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-right.png'),
                        ),
                        'default' => 'left'
                    ),
                    array(
                        'id' => 'archive_product_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Sidebar Width', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('small' => 'Small (1/4)', 'large' => 'Large (1/3)'),
                        'default' => 'small',
                        'required'  => array('archive_product_sidebar', '=', array('left','both','right')),
                    ),
                    array(
                        'id' => 'archive_product_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Product Left Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default Archive Product left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'woocommerce',
                        'required'  => array('archive_product_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'archive_product_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Archive Product Right Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default Archive Product right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'woocommerce',
                        'required'  => array('archive_product_sidebar', '=', array('right','both')),
                    ),

                    array(
                        'id' => 'section-archive-product-layout-end',
                        'type' => 'section',
                        'indent' => false
                    ),


                    array(
                        'id' => 'section-archive-product-title-start',
                        'type' => 'section',
                        'title' => esc_html__('Page Title Options', 'g5plus-handmade'),
                        'indent' => true
                    ),

                    array(
                        'id' => 'archive_product_title_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Archive Product Title Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select Archive Product Title Layout', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container',
                    ),

                    array(
                        'id'             => 'archive_product_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Archive Product Title Margin', 'g5plus-handmade'),
                        'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-handmade'),
                        'desc'           => esc_html__('If you would like to override the default archive product title top/bottom margin, then you can do so here.', 'g5plus-handmade'),
                        'left'          => false,
                        'right'          => false,
                        'output'        => array('.archive-product-title-margin'),
                        'default'            => array(
                            'margin-top'     => '25px',
                            'margin-bottom'  => '55px',
                            'units'          => 'px',
                        )
                    ),

                    array(
                        'id' => 'breadcrumbs_in_archive_product_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Breadcrumbs in Archive Product', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Breadcrumbs in Archive Product', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

                    array(
                        'id' => 'show_archive_product_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Archive Title', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Archive Product Title', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),


                    array(
                        'id'       => 'archive_product_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Archive Product Title Text Align', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Set Archive Product Title Text Align', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'default'  => 'center',
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'archive_product_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Archive Product Title Parallax', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Archive Product Title Parallax', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),


                    array(
                        'id'        => 'archive_product_title_height',
                        'type'      => 'dimensions',
                        'title'     => esc_html__('Archive Product Title Height', 'g5plus-handmade'),
                        'desc'      => esc_html__('You can set a height for the archive product title here', 'g5plus-handmade'),
                        'required'  => array('show_archive_product_title', '=', array('1')),
                        'units' => 'px',
                        'output' => array('.archive-product-title-height'),
                        'width'    =>  false,
                        'default'  => array(
                            'Height'  => ''
                        )
                    ),

                    array(
                        'id' => 'archive_product_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Archive Product Title Background', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Upload archive product title background.', 'g5plus-handmade'),
                        'desc' => '',
                        'default' => array(
                            'url' => $page_title_bg_url
                        ),
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),


                    array(
                        'id' => 'section-archive-product-title-end',
                        'type' => 'section',
                        'indent' => false
                    ),

                    array(
                        'id' => 'show_page_shop_content',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Page Shop Content', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Shop Page Content', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('0' => 'Off','before' => 'Show Before Archive','after' => 'Show After Archive'),
                        'default' => '0'
                    ),
                )
            );

            // Single Product
            $this->sections[] = array(
                'title'  => esc_html__( 'Single Product', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-laptop',
                'subsection' => true,
                'fields' => array(
	                array(
		                'id'       => 'single_product_show_image_thumb',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show Image Thumb', 'g5plus-handmade' ),
		                'subtitle' => esc_html__( 'Show/Hide Image Thumb product', 'g5plus-handmade' ),
		                'desc'     => '',
		                'options'  => array( '1' => 'On', '0' => 'Off' ),
		                'default'  => '1'
	                ),

	                array(
		                'id' => 'section-single-product-layout-start',
		                'type' => 'section',
		                'title' => esc_html__('Layout Options', 'g5plus-handmade'),
		                'indent' => true
	                ),

                    array(
                        'id' => 'single_product_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Single Product Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select Single Product Layout', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'single_product_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Single Product Sidebar', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Single Product Sidebar', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/sidebar-right.png'),
                        ),
                        'default' => 'none'
                    ),
                    array(
                        'id' => 'single_product_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Single Product Sidebar Width', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('small' => 'Small (1/4)', 'large' => 'Large (1/3)'),
                        'default' => 'small',
                        'required'  => array('single_product_sidebar', '=', array('left','both','right')),
                    ),
                    array(
                        'id' => 'single_product_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Left Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default Single Product left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'woocommerce',
                        'required'  => array('single_product_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'single_product_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Single Product Right Sidebar', 'g5plus-handmade'),
                        'subtitle' => "Choose the default Single Product right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'woocommerce',
                        'required'  => array('single_product_sidebar', '=', array('right','both')),
                    ),


                    array(
                        'id' => 'section-single-product-layout-end',
                        'type' => 'section',
                        'indent' => false
                    ),


                    array(
                        'id' => 'section-single-product-title-start',
                        'type' => 'section',
                        'title' => esc_html__('Page Title Options', 'g5plus-handmade'),
                        'indent' => true
                    ),


                    array(
                        'id' => 'single_product_title_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Single Product Title Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select Single Product Title Layout', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container',
                    ),


                    array(
                        'id'             => 'single_product_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Single Product Title Margin', 'g5plus-handmade'),
                        'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-handmade'),
                        'desc'           => esc_html__('If you would like to override the default single product title top/bottom margin, then you can do so here.', 'g5plus-handmade'),
                        'left'          => false,
                        'right'          => false,
                        'output'        => array('.single-product-title-margin'),
                        'default'            => array(
                            'margin-top'     => '25px',
                            'margin-bottom'  => '55px',
                            'units'          => 'px',
                        )
                    ),

                    array(
                        'id' => 'breadcrumbs_in_single_product_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Breadcrumbs in Single Product', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Breadcrumbs in Single Product', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),

                    array(
                        'id' => 'show_single_product_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Single Title', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Single Product Title', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),


                    array(
                        'id'       => 'single_product_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Single Product Title Text Align', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Set Single Product Title Text Align', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'default'  => 'center',
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'single_product_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Single Product Title Parallax', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Single Product Title Parallax', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),





                    array(
                        'id'        => 'single_product_title_height',
                        'type'      => 'dimensions',
                        'title'     => esc_html__('Single Product Title Height', 'g5plus-handmade'),
                        'subtitle'  => esc_html__('This must be numeric (no px) or empty.', 'g5plus-handmade'),
                        'desc'      => esc_html__('You can set a height for the single product title here', 'g5plus-handmade'),
                        'required'  => array('show_single_product_title', '=', array('1')),
                        'units' => 'px',
                        'width'    =>  false,
                        'output' => array('.single-product-title-height'),
                        'default'  => array(
                            'Height'  => ''
                        )
                    ),

                    array(
                        'id' => 'single_product_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Single Product Title Background', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Upload single product title background.', 'g5plus-handmade'),
                        'desc' => '',
                        'default' => array(
                            'url' => $page_title_bg_url
                        ),
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),


                    array(
                        'id' => 'section-single-product-title-end',
                        'type' => 'section',
                        'indent' => false
                    ),


	                array(
		                'id' => 'section-single-product-related-start',
		                'type' => 'section',
		                'title' => esc_html__('Product Related Options', 'g5plus-handmade'),
		                'indent' => true
	                ),
	                array(
		                'id'       => 'related_product_count',
		                'type'     => 'text',
		                'title'    => esc_html__('Related Product Total Record', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Total Record Of Related Product.', 'g5plus-handmade'),
		                'validate' => 'number',
		                'default'  => '6',
	                ),

	                array(
		                'id' => 'related_product_display_columns',
		                'type' => 'select',
		                'title' => esc_html__('Related Product Display Columns', 'g5plus-handmade'),
		                'subtitle' => esc_html__('Choose the number of columns to display on related product.','g5plus-handmade'),
		                'options' => array(
			                '3'		=> '3',
			                '4'		=> '4',
		                ),
		                'desc' => '',
		                'default' => '4'
	                ),

	                array(
		                'id' => 'related_product_condition',
		                'type' => 'checkbox',
		                'title' => esc_html__('Related Product Condition', 'g5plus-handmade'),
		                'options' => array(
			                'category' => esc_html__('Same Category','g5plus-handmade'),
			                'tag' => esc_html__('Same Tag','g5plus-handmade'),
		                ),
		                'default' => array(
			                'category'      => '1',
			                'tag'      => '1',
		                ),
	                ),


	                array(
		                'id' => 'section-single-product-related-end',
		                'type' => 'section',
		                'indent' => false
	                ),



                )
            );



            $this->sections[] = array(
                'title'  => esc_html__( 'Custom Post Type', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-screenshot',
                'fields' => array(
                    array(
                        'id' => 'cpt-disable',
                        'type' => 'checkbox',
                        'title' => esc_html__('Disable Custom Post Types', 'g5plus-handmade'),
                        'subtitle' => esc_html__('You can disable the custom post types used within the theme here, by checking the corresponding box. NOTE: If you do not want to disable any, then make sure none of the boxes are checked.', 'g5plus-handmade'),
                        'options' => array(
                            'portfolio' => 'Portfolio',
                            'ourteam' => 'Our Team',
                            'countdown' => 'CountDown',
                            'pricingtable' => 'Pricing Table'
                        ),
                        'default' => array(
                            'portfolio' => '0',
                            'ourteam' => '0',
                            'countdown' => '0',
                            'pricingtable' => '0'
                        )
                    ),


                )
            );

	        $this->sections[] = array(
		        'title'  => esc_html__( 'Portfolio Settings', 'g5plus-handmade' ),
		        'desc'   => '',
		        'icon'   => 'el el-th-large',
		        'subsection' => true,
		        'fields' => array(

                    array(
                        'id' => 'portfolio_title_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Portfolio Title Layout', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select Portfolio Title Layout', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
                        'default' => 'container',
                    ),

                    array(
                        'id'             => 'portfolio_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Portfolio Title Margin', 'g5plus-handmade'),
                        'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-handmade'),
                        'desc'           => esc_html__('If you would like to override the default portfolio title top/bottom margin, then you can do so here.', 'g5plus-handmade'),
                        'left'          => false,
                        'right'          => false,
                        'output'        => array('.portfolio-title-margin'),
                        'default'            => array(
                            'margin-top'     => '25px',
                            'margin-bottom'  => '55px',
                            'units'          => 'px',
                        )
                    ),
                    array(
                        'id' => 'breadcrumbs_in_portfolio_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Breadcrumbs in Portfolio', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable Breadcrumbs in Portfolio', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'portfolio_disable_link_detail',
                        'type' => 'button_set',
                        'title' => esc_html__('Disable link to detail', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Enable/Disable link to detail in Portfolio', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

			        array(
				        'id' => 'show_portfolio_title',
				        'type' => 'button_set',
				        'title' => esc_html__('Show Portfolio Title', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Enable/Disable Portfolio Title', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array('1' => 'On','0' => 'Off'),
				        'default' => '1'
			        ),

                    array(
                        'id'       => 'portfolio_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Portfolio Title Text Align', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Set Portfolio Title Text Align', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( 'left' => 'Left', 'center' => 'Center', 'right' => 'Right' ),
                        'default'  => 'center',
                        'required'  => array('show_portfolio_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'portfolio_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Portfolio Title Parallax', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Enable Portfolio Title Parallax', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0',
                        'required'  => array('show_portfolio_title', '=', array('1')),
                    ),

			        array(
				        'id'        => 'portfolio_title_height',
				        'type'      => 'dimensions',
				        'title'     => esc_html__('Portfolio Title Height', 'g5plus-handmade'),
				        'subtitle'  => esc_html__('This must be numeric (no px) or empty.', 'g5plus-handmade'),
				        'desc'      => esc_html__('You can set a height for the Portfolio title here', 'g5plus-handmade'),
				        'units' => 'px',
				        'width'    =>  false,
                        'output' => array('.portfolio-title-height'),
				        'default'  => array(
					        'Height'  => ''
				        ),
                        'required'  => array('show_portfolio_title', '=', array('1')),
			        ),

			        array(
				        'id' => 'portfolio_title_bg_image',
				        'type' => 'media',
				        'url'=> true,
				        'title' => esc_html__('Portfolio Title Background', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Upload portfolio title background.', 'g5plus-handmade'),
				        'desc' => '',
				        'default' => array(
					        'url' => $page_title_bg_url
				        ),
                        'required'  => array('show_portfolio_title', '=', array('1')),
			        ),






			        array(
				        'id' => 'portfolio-single-style',
				        'type' => 'image_select',
				        'title' => esc_html__('Single Portfolio Layout', 'g5plus-handmade'),
				        'subtitle' => esc_html__('Select Single Portfolio Layout', 'g5plus-handmade'),
				        'desc' => '',
				        'options' => array(
					        'detail-01' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-detail-01.jpg'),
					        'detail-02' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-detail-02.jpg'),
					        'detail-03' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-detail-03.jpg'),
					        'detail-04' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-detail-04.jpg'),
				        ),
				        'default' => 'detail-01'
			        ),
                    array(
                        'id'       => 'show_portfolio_related',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show/Hide Related', 'g5plus-handmade' ),
                        'subtitle' => esc_html__( 'Show or hide related in single portfolio', 'g5plus-handmade' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Show', '0' => 'Hide' ),
                        'default'  => '1',

                    ),
                    array(
                        'id' => 'portfolio_related_style',
                        'type' => 'select',
                        'multi' => false,
                        'width' => '200px',
                        'title' => esc_html__('Select portfolio related style', 'g5plus-handmade'),
                        'options' => array(
                            'grid' => esc_html__('Grid', 'g5plus-handmade'),
                            'title' => esc_html__('Title & category', 'g5plus-handmade')
                        ),
                        'desc' => '',
                        'default' => '',
                        'required'  => array('show_portfolio_related', '=', array('1'))
                    ),
                    array(
                        'id' => 'portfolio-related-column',
                        'type' => 'image_select',
                        'title' => esc_html__('Portfolio Related Column', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select Portfolio Related Column.', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            '2' => array('title' => 'Two Column', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-4.jpg'),
                            '3' => array('title' => 'Three Column', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-5.jpg'),
                            '4' => array('title' => 'Four Column', 'img' => THEME_URL.'assets/images/theme-options/footer-layout-1.jpg'),
                        ),
                        'default' => '4',
                        'required'  => array('show_portfolio_related', '=', array('1'))
                    ),
                    array(
                        'id' => 'portfolio-related-overlay',
                        'type' => 'image_select',
                        'title' => esc_html__('Portfolio Related Orverlay Style', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Select Portfolio Related Orverlay Style.  Only apply for Portfolio related style is grid', 'g5plus-handmade'),
                        'desc' => '',
                        'options' => array(
                            'icon' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-icon.png'),
                            'title' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-title.png'),
                            'title-category' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-title-category.png'),
                            'title-category-link' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-title-category-link.png'),
                            'title-excerpt' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-title-excerpt.png'),
                            'left-title-excerpt-link' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/potfolio-title-excerpt-link_left.png'),
                            'title-excerpt-link' => array('title' => '', 'img' => THEME_URL.'assets/images/theme-options/portfolio-title-excerpt-link.png'),
                        ),
                        'default' => 'icon',
                        'required'  => array('show_portfolio_related', '=', array('1'))
                    ),
		        )
	        );

            $this->sections[] = array(
                'title'  => esc_html__( 'Resources Options', 'g5plus-handmade' ),
                'desc'   => '',
                'icon'   => 'el el-th-large',
                'fields' => array(
                    array(
                        'id'        => 'cdn_bootstrap_js',
                        'type'      => 'text',
                        'title'     => esc_html__('CDN Bootstrap Script', 'g5plus-handmade'),
                        'subtitle'  => esc_html__('Url CDN Bootstrap Script', 'g5plus-handmade'),
                        'desc'      => '',
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'cdn_bootstrap_css',
                        'type'      => 'text',
                        'title'     => esc_html__('CDN Bootstrap Stylesheet', 'g5plus-handmade'),
                        'subtitle'  => esc_html__('Url CDN Bootstrap Stylesheet', 'g5plus-handmade'),
                        'desc'      => '',
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'cdn_font_awesome',
                        'type'      => 'text',
                        'title'     => esc_html__('CDN Font Awesome', 'g5plus-handmade'),
                        'subtitle'  => esc_html__('Url CDN Font Awesome', 'g5plus-handmade'),
                        'desc'      => '',
                        'default'   => '',
                    ),

                )
            );
            $this->sections[] = array(
                'title'  => esc_html__( 'Custom CSS & Script', 'g5plus-handmade' ),
                'desc'   => esc_html__( 'If you change Custom CSS, you must "Save & Generate CSS"', 'g5plus-handmade' ),
                'icon'   => 'el el-edit',
                'fields' => array(
                    array(
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'title' => esc_html__('Custom CSS', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Add some CSS to your theme by adding it to this textarea. Please do not include any style tags.', 'g5plus-handmade'),
                        'desc' => '',
                        'default' => '',
                        'options'  => array('minLines'=> 20, 'maxLines' => 60)
                    ),
                    array(
                        'id' => 'custom_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'title' => esc_html__('Custom JS', 'g5plus-handmade'),
                        'subtitle' => esc_html__('Add some custom JavaScript to your theme by adding it to this textarea. Please do not include any script tags.', 'g5plus-handmade'),
                        'desc' => '',
                        'default' => '',
                        'options'  => array('minLines'=> 20, 'maxLines' => 60)
                    ),

                )
            );
        }

        public function setHelpTabs() {
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'           => 'g5plus_handmade_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'       => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'    => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'          => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'     => true,
                // Show the sections below the admin menu item or not
                'menu_title'         => esc_html__( 'Theme Options', 'g5plus-handmade' ),
                'page_title'         => esc_html__( 'Theme Options', 'g5plus-handmade' ),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'     => '',
                // Must be defined to add google fonts to the typography module

                'async_typography'   => false,
                // Use a asynchronous font on the front end or font string
                'admin_bar'          => true,
                // Show the panel pages on the admin bar
                'global_variable'    => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode'           => false,
                // Show the time the page took to load, etc
                'customizer'         => true,
                // Enable basic customizer support

                // OPTIONAL -> Give you extra features
                'page_priority'      => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'        => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_theme_page#Parameters
                'page_permissions'   => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'          => '',
                // Specify a custom URL to an icon
                'last_tab'           => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'          => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'          => '_options',
                // Page slug used to denote the panel
                'save_defaults'      => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'       => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'       => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time'     => 60 * MINUTE_IN_SECONDS,
                'output'             => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'         => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'           => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'        => false,
                // REMOVE

                // HINTS
                'hints'              => array(
                    'icon'          => 'icon-question-sign',
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


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon'  => 'el el-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon'  => 'el el-facebook'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el el-twitter'
            );
            $this->args['share_icons'][] = array(
                'url'   => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon'  => 'el el-linkedin'
            );

            // Panel Intro text -> before the form
            if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                if ( ! empty( $this->args['global_variable'] ) ) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace( '-', '_', $this->args['opt_name'] );
                }
                $this->args['intro_text'] = sprintf( wp_kses_post(__( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'g5plus-handmade' )) , $v );
            } else {
                $this->args['intro_text'] = wp_kses_post(__( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'g5plus-handmade' ));
            }

            // Add content after the form.
            $this->args['footer_text'] = wp_kses_post(__( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'g5plus-handmade' ))  ;
        }

    }

    global $reduxConfig;
    $reduxConfig = new Redux_Framework_options_config();
}