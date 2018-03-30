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
            $title_image_url_404 = G5PLUS_THEME_URL . 'assets/images/title-image-404.png';
            $image_bg_url_404 = G5PLUS_THEME_URL . 'assets/images/background-404.jpg';
            $page_title_bg_url = G5PLUS_THEME_URL . 'assets/images/bg-page-title.jpg';
            $archive_title_bg_url = G5PLUS_THEME_URL . 'assets/images/bg-archive-title.jpg';
            $archive_product_title_bg_url = G5PLUS_THEME_URL . 'assets/images/bg-archive-course-title.jpg';
            $single_product_title_bg_url = G5PLUS_THEME_URL . 'assets/images/bg-course-title.jpg';
            $logo_under_construction = G5PLUS_THEME_URL . 'assets/images/logo_under_construction.png';
            $image_left_under_construction = G5PLUS_THEME_URL . 'assets/images/image_left.png';

            $fonts =array(
                            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                            "Courier, monospace"                                   => "Courier, monospace",
                            "Garamond, serif"                                      => "Garamond, serif",
                            "Georgia, serif"                                       => "Georgia, serif",
                            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                            "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
                        );
            $theme_options = get_option('g5plus_academia_options');

            if(is_array($theme_options)){
                for($i=1;$i<=2;$i++){
                    if(array_key_exists('custom_font_'.$i.'_name', $theme_options)){
                        $custom_font = $theme_options['custom_font_'.$i.'_name'];
                    }
                    if(array_key_exists('custom_font_'.$i.'_ttf', $theme_options)){
                        $ttf = $theme_options['custom_font_'.$i.'_ttf'];
                    }
                    if(array_key_exists('custom_font_'.$i.'_eot', $theme_options)){
                        $eot = $theme_options['custom_font_'.$i.'_eot'];
                    }
                    if(array_key_exists('custom_font_'.$i.'_woff', $theme_options)){
                        $woff = $theme_options['custom_font_'.$i.'_woff'];
                    }
                    if(isset($custom_font) && isset($ttf) && isset($eot) &&  isset($woff) && $custom_font!='' ){
                        $fonts[$custom_font] = 'Custom - '.$custom_font;
                    }
                }
            }
            // General Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'General Setting', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-wrench',
                'fields' => array(
                    array(
                        'id' => 'smooth_scroll',
                        'type' => 'button_set',
                        'title' => esc_html__('Smooth Scroll', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Smooth Scroll', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

                    array(
                        'id' => 'custom_scroll',
                        'type' => 'button_set',
                        'title' => esc_html__('Custom Scroll', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Custom Scroll', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

                    array(
                        'id'        => 'custom_scroll_width',
                        'type'      => 'text',
                        'title'     => esc_html__('Custom Scroll Width', 'g5plus-academia'),
                        'subtitle'  => esc_html__('This must be numeric (no px) or empty.', 'g5plus-academia'),
                        'validate'  => 'numeric',
                        'default'   => '10',
                        'required'  => array('custom_scroll', '=', array('1')),
                    ),

                    array(
                        'id'       => 'custom_scroll_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Custom Scroll Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Custom Scroll Color', 'g5plus-academia'),
                        'default'  => '#19394B',
                        'validate' => 'color',
                        'required'  => array('custom_scroll', '=', array('1')),
                    ),

                    array(
                        'id'       => 'custom_scroll_thumb_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Custom Scroll Thumb Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Custom Scroll Thumb Color', 'g5plus-academia'),
                        'default'  => '#e8aa00',
                        'validate' => 'color',
                        'required'  => array('custom_scroll', '=', array('1')),
                    ),

                    array(
                        'id' => 'back_to_top',
                        'type' => 'button_set',
                        'title' => esc_html__('Back To Top', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Back to top button', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),

	                array(
		                'id' => 'enable_rtl_mode',
		                'type' => 'button_set',
		                'title' => esc_html__('Enable RTL mode', 'g5plus-academia'),
		                'subtitle' => esc_html__('Enable/Disable RTL mode', 'g5plus-academia'),
		                'desc' => '',
		                'options' => array('1' => 'On','0' => 'Off'),
		                'default' => '0'
	                ),


	                array(
                        'id' => 'enable_social_meta',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Social Meta Tags', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable the social meta head tag output.', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

                    array(
                        'id' => 'twitter_author_username',
                        'type' => 'text',
                        'title' => esc_html__('Twitter Publisher Username', 'g5plus-academia'),
                        'subtitle' => esc_html__( 'Enter your twitter username here, to be used for the Twitter Card date. Ensure that you do not include the @ symbol.','g5plus-academia'),
                        'desc' => '',
                        'default' => "",
                        'required'  => array('enable_social_meta', '=', array('1')),
                    ),
                    array(
                        'id' => 'googleplus_author',
                        'type' => 'text',
                        'title' => esc_html__('Google+ Username', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enter your Google+ username here, to be used for the authorship meta.','g5plus-academia'),
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
                        'title' => esc_html__('Layout Style', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select the layout style', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'boxed' => array('title' => 'Boxed', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/layout-boxed.png'),
                            'wide' => array('title' => 'Wide', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/layout-wide.png'),
                            'float' => array('title' => 'Float', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/layout-float.png')
                        ),
                        'default' => 'wide'
                    ),

	                array(
		                'id' => 'search_box_type',
		                'type' => 'button_set',
		                'title' => esc_html__('Search Box Type', 'g5plus-academia'),
		                'subtitle' => esc_html__('Select search box type.', 'g5plus-academia'),
		                'desc' => '',
		                'options' => array('standard' => esc_html__('Standard','g5plus-academia'),'ajax' => esc_html__('Ajax Search','g5plus-academia')),
		                'default' => 'standard'
	                ),
	                array(
		                'id' => 'shopping_cart_button',
		                'type' => 'checkbox',
		                'title' => esc_html__('Shopping Mini Cart Button', 'g5plus-academia'),
		                'subtitle' => esc_html__('Select shopping mini cart button', 'g5plus-academia'),
		                'options' => array(
			                'view-cart' => esc_html__('View Cart','g5plus-academia'),
			                'checkout' => esc_html__('Checkout','g5plus-academia'),
		                ),
		                'default' => array(
			                'view-cart' => '1',
			                'checkout' => '1',
		                ),
	                ),
	                array(
		                'id' => 'search_box_post_type',
		                'type' => 'checkbox',
		                'title' => esc_html__('Post type for Ajax Search', 'g5plus-academia'),
		                'subtitle' => esc_html__('Select post type for ajax search', 'g5plus-academia'),
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
		                'title'     => esc_html__('Amount Of Search Result', 'g5plus-academia'),
		                'subtitle'  => esc_html__('This must be numeric (no px) or empty (default: 8).', 'g5plus-academia'),
		                'desc'      => esc_html__('Set mount of Search Result', 'g5plus-academia'),
		                'validate'  => 'numeric',
		                'default'   => '',
		                'required' => array('search_box_type','=','ajax'),
	                ),

                    array(
                        'id' => 'body_background_mode',
                        'type' => 'button_set',
                        'title' => esc_html__('Body Background Mode', 'g5plus-academia'),
                        'subtitle' => esc_html__('Chose Background Mode', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array('background' => 'Background','pattern' => 'Pattern'),
                        'default' => 'background'
                    ),

                    array(
                        'id'       => 'body_background',
                        'type'     => 'background',
                        'output'   => array( 'body' ),
                        'title'    => esc_html__( 'Body Background', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Body background (Apply for Boxed layout style).', 'g5plus-academia' ),
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
                        'title' => esc_html__('Background Pattern', 'g5plus-academia'),
                        'subtitle' => esc_html__('Body background pattern(Apply for Boxed layout style)', 'g5plus-academia'),
                        'desc' => '',
                        'height' => '40px',
                        'options' => array(
                            'pattern-1.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-1.png'),
                            'pattern-2.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-2.png'),
                            'pattern-3.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-3.png'),
                            'pattern-4.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-4.png'),
                            'pattern-5.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-5.png'),
                            'pattern-6.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-6.png'),
                            'pattern-7.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-7.png'),
                            'pattern-8.png' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/pattern-8.png'),
                        ),
                        'default' => 'pattern-1.png',
                        'required'  => array(
                                array('body_background_mode', '=', array('pattern'))
                            ) ,
                    ),
	                array(
		                'id' => 'general_divide_3',
		                'type' => 'divide'
	                ),
	                array(
		                'id' => 'menu_transition',
		                'type' => 'button_set',
		                'title' => esc_html__('Menu transition', 'g5plus-academia'),
		                'subtitle' => esc_html__('Select menu transition', 'g5plus-academia'),
		                'desc' => '',
		                'options' => array(
			                'none'                  => esc_html__('None','g5plus-academia'),
			                'x-animate-slide-up'    => esc_html__('Slide Up','g5plus-academia'),
			                'x-animate-slide-down'  => esc_html__('Slide Down','g5plus-academia'),
			                'x-animate-slide-left'  => esc_html__('Slide Left','g5plus-academia'),
			                'x-animate-slide-right' => esc_html__('Slide Right','g5plus-academia'),
			                'x-animate-sign-flip'   => esc_html__('Sign Flip','g5plus-academia'),
		                ),
		                'default' => 'x-animate-sign-flip'
	                ),
                )
            );

            $this->sections[] = array(
                'title' => esc_html__('Maintenance Mode', 'g5plus-academia'),
                'desc' => '',
                'subsection' => true,
                'icon' => 'el-icon-eye-close',
                'fields' => array(
                    array(
                        'id' => 'enable_maintenance',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Maintenance', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable the themes maintenance mode.', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array('2' => 'On (Custom Page)', '1' => 'On (Standard)','0' => 'Off',),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'maintenance_mode_page',
                        'type' => 'select',
                        'data' => 'pages',
                        'required'  => array('enable_maintenance', '=', '2'),
                        'title' => esc_html__('Custom Maintenance Mode Page', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select the page that is your maintenace page, if you would like to show a custom page instead of the standard WordPress message. You should use the Holding Page template for this page.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => '',
                        'args' => array()
                    ),
                ),
            );


            // Performance Options
            $this->sections[] = array(
                'title'  => esc_html__( 'Performance', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-fire',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'enable_minifile_js',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Mini File JS', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Mini File JS', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'enable_minifile_css',
                        'type' => 'button_set',
                        'title' => esc_html__('Enable Mini File CSS', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Mini File CSS', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),
                )
            );

            // Page Transition
            $this->sections[] = array(
                'title'  => esc_html__( 'Page Transition', 'g5plus-academia'),
                'desc'   => '',
                'icon'   => 'el el-dashboard',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'page_transition',
                        'type' => 'button_set',
                        'title' => esc_html__('Page Transition', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Page Transition', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '0'
                    ),

                    //Loading Animation
                    array(
                        'id' => 'loading_animation',
                        'type' => 'select',
                        'title' => esc_html__('Loading Animation', 'g5plus-academia'),
                        'subtitle' => esc_html__('Choose type of preload animation', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'none' => esc_html__('No animation','g5plus-academia'),
                            'cube' => esc_html__('Cube','g5plus-academia'),
                            'double-bounce' => esc_html__('Double bounce','g5plus-academia'),
                            'wave' => esc_html__('Wave','g5plus-academia'),
                            'pulse' => esc_html__('Pulse','g5plus-academia'),
                            'chasing-dots' => esc_html__('Chasing dots','g5plus-academia'),
                            'three-bounce' => esc_html__('Three bounce','g5plus-academia'),
                            'circle' => esc_html__('Circle','g5plus-academia'),
                            'fading-circle' => esc_html__('Fading circle','g5plus-academia'),
                            'folding-cube' => esc_html__('Folding cube','g5plus-academia'),
                        ),
                        'default' => 'none'
                    ),

                    array(
                        'id' => 'loading_logo',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Logo Loading', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload logo loading.', 'g5plus-academia'),
                        'desc' => '',
                        'required'  => array('loading_animation', 'not_empty_and', array('none')),
                    ),

                    array(
                        'id'       => 'loading_animation_bg_color',
                        'type'     => 'color_rgba',
                        'title'    => esc_html__('Loading Background Color', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Set loading background color.', 'g5plus-academia' ),
                        'default'   => array(
                            'color'     => '#ffffff',
                            'alpha'     => 1
                        ),
                        'output' => array('background-color' => '.site-loading'),
                        'validate' => 'colorrgba',
                        'required'  => array('loading_animation', 'not_empty_and', array('none')),
                    ),

                    //Spinner Color
                    array(
                        'id'       => 'spinner_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Spinner color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a spinner color', 'g5plus-academia'),
                        'default'  => '',
                        'validate' => 'color',
                        'output' => array('background-color' => '.sk-spinner-pulse,.sk-rotating-plane,.sk-double-bounce .sk-child,.sk-wave .sk-rect,.sk-chasing-dots .sk-child,.sk-three-bounce .sk-child,.sk-circle .sk-child:before,.sk-fading-circle .sk-circle:before,.sk-folding-cube .sk-cube:before'),
                        'required'  => array('loading_animation', 'not_empty_and', array('none')),
                    ),
                )
            );

            // Custom Favicon
            $this->sections[] = array(
                'title'  => esc_html__( 'Custom Favicon', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-eye-open',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'custom_favicon',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom favicon', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload a 16px x 16px Png/Gif/ico image that will represent your website favicon', 'g5plus-academia'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_title',
                        'type' => 'text',
                        'title' => esc_html__('Custom iOS Bookmark Title', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enter a custom title for your site for when it is added as an iOS bookmark.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon57',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 57x57', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload a 57px x 57px Png image that will be your website bookmark on non-retina iOS devices.', 'g5plus-academia'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon72',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 72x72', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload a 72px x 72px Png image that will be your website bookmark on non-retina iOS devices.', 'g5plus-academia'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon114',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 114x114', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload a 114px x 114px Png image that will be your website bookmark on retina iOS devices.', 'g5plus-academia'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'custom_ios_icon144',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Custom iOS 144x144', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload a 144px x 144px Png image that will be your website bookmark on retina iOS devices.', 'g5plus-academia'),
                        'desc' => ''
                    ),
                )
            );


            // 404
            $this->sections[] = array(
                'title'  => esc_html__( '404 Setting', 'g5plus-academia' ),
                'desc'   => '',
                'subsection' => true,
                'icon'   => 'el el-error',
                'fields' => array(
                    array(
                        'id' => 'title_image_404',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Title Image', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload 404 title image.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => array(
                            'url' => $title_image_url_404
                        ),
                    ),
                    array(
                        'id' => 'image_bg_404',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background Image', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload 404 background image.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => array(
                            'url' => $image_bg_url_404
                        ),
                    ),
                    array(
                        'id'        => 'title_404',
                        'type'      => 'text',
                        'title'     => esc_html__('Title 404', 'g5plus-academia'),
                        'default'   => 'This Page Not Be Found',
                    ),
                    array(
                        'id'        => 'subtitle_404',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Subtitle 404', 'g5plus-academia'),
                        'default'   => 'We are really sorry, but page you requested is missing :( Perhaps searching again can help.',
                    ),
                    array(
                        'id' => 'header_404_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Header Layout', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select a header layout option from the examples.', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'header-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-1.jpg'),
                            'header-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-2.jpg'),
                            'header-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-3.jpg'),
                        ),
                        'default' => 'header-1'
                    ),
                    array(
                        'id'        => 'header_404_nav_border_top',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Header navigation border top', 'g5plus-academia'),
                        'options'  => array(
                            'none'              => esc_html__('None','g5plus-academia'),
                            'bottom-bordered'   => esc_html__('Solid','g5plus-academia'),
                        ),
                        'default'  => 'bottom-bordered'
                    ),
                    array(
                        'id'        => 'header_404_nav_border_bottom',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Header navigation border bottom style', 'g5plus-academia'),
                        'options'  => array(
                            'none'                          => esc_html__('None','g5plus-academia'),
                            'bottom-border-solid'           => esc_html__('Solid','g5plus-academia'),
                            'bottom-border-gradient'        => esc_html__('Gradient','g5plus-academia'),
                            'bottom-border-gradient w2p3'   => esc_html__('Gradient 2','g5plus-academia'),
                        ),
                        'default'  => 'bottom-border-solid'
                    )
                )
            );

            // Pages Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'Pages Setting', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-th',
                'fields' => array(
                    array(
                        'id' => 'page_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Layout', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select Page Layout', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'full' => esc_html__('Full Width','g5plus-academia'),
                            'container' => esc_html__('Container','g5plus-academia'),
                            'container-fluid' => esc_html__('Container Fluid','g5plus-academia')
                        ),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'page_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Sidebar', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Sidebar Style', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-right.png'),
                            'both' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-both.png'),
                        ),
                        'default' => 'right'
                    ),
                    array(
                        'id' => 'page_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Sidebar Width', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'small' => esc_html__('Small (1/4)','g5plus-academia'),
                            'large' => esc_html__('Large (1/3)','g5plus-academia')
                        ),
                        'default' => 'small',
                        'required'  => array('page_sidebar', '=', array('left','both','right')),
                    ),
                    array(
                        'id' => 'page_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Left Sidebar', 'g5plus-academia'),
                        'subtitle' => esc_html__('Choose the default left sidebar','g5plus-academia'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-1',
                        'required'  => array('page_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'page_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Right Sidebar', 'g5plus-academia'),
                        'subtitle' => esc_html__('Choose the default right sidebar','g5plus-academia'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-2',
                        'required'  => array('page_sidebar', '=', array('right','both')),
                    ),
                    array(
                        'id' => 'page_comment',
                        'type' => 'button_set',
                        'title' => esc_html__('Page Comment', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable page comment', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id' => 'section-page-title-start',
                        'type' => 'section',
                        'title' => esc_html__('Page Title Options', 'g5plus-academia'),
                        'indent' => true
                    ),
                    array(
                        'id' => 'show_page_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Page Title', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Page Title', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array('1' => 'On','0' => 'Off'),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'style_page_title',
                        'type' => 'select',
                        'title' => esc_html__('Page Title Style', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select page title style', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'pt-bottom' => esc_html__('Bottom','g5plus-academia'),
                            'pt-center' => esc_html__('Center','g5plus-academia'),
                        ),
                        'default' => 'pt-bottom',
                        'required'  => array('show_page_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'page_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Text Align', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Set Page Title Text Align', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            'left' => esc_html__('Left','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'right' => esc_html__('Right','g5plus-academia')
                        ),
                        'default'  => 'center',
                        'required'  => array('style_page_title', '=', array('pt-center')),
                    ),

                    array(
                        'id' => 'page_sub_title',
                        'type' => 'text',
                        'title' => esc_html__('Sub Title', 'g5plus-academia'),
                        'subtitle' => '',
                        'desc' => '',
                        'default' => '',
                        'required'  => array('show_page_title', '=', array('1')),
                    ),
                    array(
                        'id'             => 'page_title_padding',
                        'type'           => 'spacing',
                        'mode'           => 'padding',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Padding', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set page title top/bottom padding.', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'default'            => array(
                            'padding-top'  => '270px',
                            'padding-bottom'  => '0px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_page_title', '=', array('1')),
                    ),
                    array(
                        'id'             => 'page_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Margin Bottom', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set page title bottom margin.', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'top'          => false,
                        'default'            => array(
                            'margin-bottom'  => '60px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_page_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'page_title_color',
                        'type'     => 'color',
                        'title' => esc_html__('Text Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a color for page title.', 'g5plus-academia'),
                        'default'  => '#fff',
                        'validate' => 'color',
                        'required'  => array('show_page_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'page_title_bg_color',
                        'type'     => 'color_rgba',
                        'title' => esc_html__('Background Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a background color for page title.', 'g5plus-academia'),
                        'default'   => array(
                            'color'     => '#000',
                            'alpha'     => 0,
                            'rgba'     => 'rgba(0,0,0,0)'
                        ),
                        'validate' => 'colorrgba',
                        'required'  => array('show_page_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'page_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background Image', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload page title background.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => array(
                            'url' => $page_title_bg_url
                        ),
                        'required'  => array('show_page_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'page_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Page Title Parallax', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Page Title Parallax', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            '1' => esc_html__('Enable','g5plus-academia'),
                            '0' => esc_html__('Disable','g5plus-academia')
                        ),
                        'default'  => '1',
                        'required'  => array(
                            array('show_page_title', '=', array('1')),
                            array('page_title_bg_image', '!=', ''),
                        ),
                    ),

                    array(
                        'id'       => 'page_title_parallax_position',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Parallax Position', 'g5plus-academia' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'top' => esc_html__('Top','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'bottom' => esc_html__('Bottom','g5plus-academia'),
                        ),
                        'default'  => 'center',
                        'required'  => array(
                            array('show_page_title', '=', array('1')),
                            array('page_title_bg_image', '!=', ''),
                            array('page_title_parallax', '=', '1'),
                        ),
                    ),

                    array(
                        'id' => 'section-page-title-end',
                        'type' => 'section',
                        'indent' => false
                    ),


                )
            );

            // Search Setting
            $this->sections[] = array(
                'title'  => esc_html__( 'Search Pages Setting', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-search',
                'fields' => array(
                    array(
                        'id' => 'search_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Layout', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select Page Layout', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'full' => esc_html__('Full Width','g5plus-academia'),
                            'container' => esc_html__('Container','g5plus-academia'),
                            'container-fluid' => esc_html__('Container Fluid','g5plus-academia')
                        ),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'search_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Sidebar', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Sidebar Style', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'none' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-none.png'),
                            'left' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-right.png'),
                            'both' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-both.png'),
                        ),
                        'default' => 'right'
                    ),

                    array(
                        'id' => 'search_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Sidebar Width', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'small' => esc_html__('Small (1/4)','g5plus-academia'),
                            'large' => esc_html__('Large (1/3)','g5plus-academia')
                        ),
                        'default' => 'small',
                        'required'  => array('search_sidebar', '=', array('left','both','right')),
                    ),

                    array(
                        'id' => 'search_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Left Sidebar', 'g5plus-academia'),
                        'subtitle' => esc_html__('Choose the default left sidebar','g5plus-academia'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-1',
                        'required'  => array('search_sidebar', '=', array('left','both')),
                    ),

                    array(
                        'id' => 'search_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Right Sidebar', 'g5plus-academia'),
                        'subtitle' => esc_html__('Choose the default right sidebar','g5plus-academia'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'sidebar-2',
                        'required'  => array('search_sidebar', '=', array('right','both')),
                    ),
                )
            );


	        // Archive Setting
	        $this->sections[] = array(
		        'title'  => esc_html__( 'Archive Setting', 'g5plus-academia' ),
		        'desc'   => '',
		        'icon'   => 'el el-folder-close',
		        'fields' => array(
                    array(
                        'id' => 'archive_display_type',
                        'type' => 'select',
                        'title' => esc_html__('Archive Display Type', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select archive display type', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'grid' => esc_html__('Grid','g5plus-academia'),
                            'list' => esc_html__('List','g5plus-academia'),
                        ),
                        'default' => 'list'
                    ),

                    array(
                        'id' => 'archive_display_columns',
                        'type' => 'select',
                        'title' => esc_html__('Archive Display Columns', 'g5plus-academia'),
                        'subtitle' => esc_html__('Choose the number of columns to display on archive pages.','g5plus-academia'),
                        'options' => array(
                            '2'		=> '2',
                            '3'		=> '3',
                            '4'		=> '4',
                            '5'		=> '5',
                        ),
                        'desc' => '',
                        'default' => '2',
                        'required' => array('archive_display_type','=',array('grid')),
                    ),

                    array(
                        'id' => 'archive_paging_style',
                        'type' => 'button_set',
                        'title' => esc_html__('Paging Style', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select archive paging style', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'default' => esc_html__('Default','g5plus-academia'),
                            'load-more' => esc_html__('Load More','g5plus-academia'),
                            'infinity-scroll' => esc_html__('Infinity Scroll','g5plus-academia')
                        ),
                        'default' => 'default'
                    ),

                    array(
                        'id' => 'section_archive_layout_start',
                        'type' => 'section',
                        'title' => esc_html__('Layout Options', 'g5plus-academia'),
                        'indent' => true
                    ),


			        array(
				        'id' => 'archive_layout',
				        'type' => 'button_set',
				        'title' => esc_html__('Layout', 'g5plus-academia'),
				        'subtitle' => esc_html__('Select Archive Layout', 'g5plus-academia'),
				        'desc' => '',
				        'options' => array(
                            'full' => esc_html__('Full Width','g5plus-academia'),
                            'container' => esc_html__('Container','g5plus-academia'),
                            'container-fluid' => esc_html__('Container Fluid','g5plus-academia')
                        ),
				        'default' => 'container'
			        ),

			        array(
				        'id' => 'archive_sidebar',
				        'type' => 'image_select',
				        'title' => esc_html__('Sidebar', 'g5plus-academia'),
				        'subtitle' => esc_html__('Set Sidebar Style', 'g5plus-academia'),
				        'desc' => '',
				        'options' => array(
					        'none' => array('title' => '', 'img' => G5PLUS_THEME_URL . 'assets/images/theme-options/sidebar-none.png'),
					        'left' => array('title' => '', 'img' => G5PLUS_THEME_URL . 'assets/images/theme-options/sidebar-left.png'),
					        'right' => array('title' => '', 'img' => G5PLUS_THEME_URL . 'assets/images/theme-options/sidebar-right.png'),
					        'both' => array('title' => '', 'img' => G5PLUS_THEME_URL . 'assets/images/theme-options/sidebar-both.png'),
				        ),
				        'default' => 'left'
			        ),


			        array(
				        'id' => 'archive_sidebar_width',
				        'type' => 'button_set',
				        'title' => esc_html__('Sidebar Width', 'g5plus-academia'),
				        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-academia'),
				        'desc' => '',
				        'options' => array(
                            'small' => esc_html__('Small (1/4)','g5plus-academia'),
                            'large' => esc_html__('Large (1/3)','g5plus-academia')
                        ),
				        'default' => 'small',
				        'required'  => array('archive_sidebar', '=', array('left','both','right')),
			        ),

			        array(
				        'id' => 'archive_left_sidebar',
				        'type' => 'select',
				        'title' => esc_html__('Left Sidebar', 'g5plus-academia'),
				        'subtitle' => esc_html__('Choose the default left sidebar','g5plus-academia'),
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'sidebar-1',
				        'required'  => array('archive_sidebar', '=', array('left','both')),
			        ),
			        array(
				        'id' => 'archive_right_sidebar',
				        'type' => 'select',
				        'title' => esc_html__('Right Sidebar', 'g5plus-academia'),
				        'subtitle' => esc_html__('Choose the default right sidebar','g5plus-academia'),
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'sidebar-2',
				        'required'  => array('archive_sidebar', '=', array('right','both')),
			        ),

                    array(
                        'id' => 'section-archive-layout-end',
                        'type' => 'section',
                        'indent' => false
                    ),



                    array(
                        'id' => 'section_archive_title_start',
                        'type' => 'section',
                        'title' => esc_html__('Page Title Options', 'g5plus-academia'),
                        'indent' => true
                    ),
                    //page title
                    array(
                        'id' => 'show_archive_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Archive Title', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Archive Title', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'style_archive_title',
                        'type' => 'select',
                        'title' => esc_html__('Page Title Style', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select page title style', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'pt-bottom' => esc_html__('Bottom','g5plus-academia'),
                            'pt-center' => esc_html__('Center','g5plus-academia'),
                        ),
                        'default' => 'pt-bottom',
                        'required'  => array('show_archive_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'archive_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Text Align', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Set Archive Title Text Align', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            'left' => esc_html__('Left','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'right' => esc_html__('Right','g5plus-academia')
                        ),
                        'default'  => 'center',
                        'required'  => array('style_archive_title', '=', array('pt-center')),
                    ),

                    array(
                        'id' => 'archive_sub_title',
                        'type' => 'text',
                        'title' => esc_html__('Archive Sub Title', 'g5plus-academia'),
                        'subtitle' => '',
                        'desc' => '',
                        'default' => '',
                        'required'  => array('show_archive_title', '=', array('1')),
                    ),
                    array(
                        'id'             => 'archive_title_padding',
                        'type'           => 'spacing',
                        'mode'           => 'padding',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Padding', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set archive title padding.', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'default'            => array(
                            'padding-top'  => '270px',
                            'padding-bottom' => '0',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_archive_title', '=', array('1')),
                    ),


                    array(
                        'id'             => 'archive_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Margin Bottom', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set archive title bottom margin.', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'top'          => false,
                        'default'            => array(
                            'margin-bottom'  => '60px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_archive_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'archive_title_border_bottom',
                        'type' => 'button_set',
                        'title' => esc_html__('Border Bottom', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enabling this option will display bottom border on Title Area', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('Enable','g5plus-academia'),
                            '0' => esc_html__('Disable','g5plus-academia')
                        ),
                        'default' => '0',
                        'required'  => array('show_archive_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'archive_title_color',
                        'type'     => 'color',
                        'title' => esc_html__('Text Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a color for archive title.', 'g5plus-academia'),
                        'default'  => '#fff',
                        'validate' => 'color',
                        'required'  => array('show_archive_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'archive_title_bg_color',
                        'type'     => 'color_rgba',
                        'title' => esc_html__('Background Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a background color for archive title.', 'g5plus-academia'),
                        'default'   => array(
                            'color'     => '#000',
                            'alpha'     => 0,
                            'rgba'     => 'rgba(0,0,0,0)'
                        ),
                        'validate' => 'colorrgba',
                        'required'  => array('show_archive_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'archive_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background Image', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload archive title background.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => array(
                            'url' => $archive_title_bg_url
                        ),
                        'required'  => array('show_archive_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'archive_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Archive Title Parallax', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Archive Title Parallax', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '1',
                        'required'  => array(
                            array('show_archive_title', '=', array('1')),
                            array('archive_title_bg_image', '!=', ''),
                        ),
                    ),

                    array(
                        'id'       => 'archive_title_parallax_position',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Parallax Position', 'g5plus-academia' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'top' => esc_html__('Top','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'bottom' => esc_html__('Bottom','g5plus-academia'),
                        ),
                        'default'  => 'center',
                        'required'  => array(
                            array('show_archive_title', '=', array('1')),
                            array('archive_title_bg_image', '!=', ''),
                            array('archive_title_parallax', '=', '1'),
                        ),
                    ),

                    array(
                        'id' => 'section_archive_title_end',
                        'type' => 'section',
                        'indent' => false
                    ),



		        )
	        );

	        // Single Blog
	        $this->sections[] = array(
		        'title'  => esc_html__( 'Single Blog', 'g5plus-academia' ),
		        'desc'   => '',
		        'icon'   => 'el el-file',
		        'subsection' => true,
		        'fields' => array(

                    array(
                        'id' => 'show_post_navigation',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Post Navigation', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Post Navigation', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id' => 'show_author_info',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Author Info', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Author Info', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id' => 'show_related_post',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Related Post', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Related Post', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id'       => 'related_post_count',
                        'type'     => 'text',
                        'title'    => esc_html__('Related Post Number', 'g5plus-academia'),
                        'subtitle' => esc_html__('Total Record Of Related Post.', 'g5plus-academia'),
                        'validate' => 'number',
                        'default'  => '6',
                        'required'  => array('show_related_post', '=', array('1')),
                    ),

                    array(
                        'id'       => 'related_post_columns',
                        'type'     => 'select',
                        'title'    => esc_html__('Related Post Columns', 'g5plus-academia'),
                        'default'  => '3',
                        'options' => array('2' => '2' ,'3' => '3','4' => '4'),
                        'select2' => array('allowClear' =>  false) ,
                        'required'  => array('show_related_post', '=', array('1')),
                    ),

                    array(
                        'id' => 'related_post_condition',
                        'type' => 'checkbox',
                        'title' => esc_html__('Related Post Condition', 'g5plus-academia'),
                        'options' => array(
                            'category' => esc_html__('Same Category','g5plus-academia'),
                            'tag' => esc_html__('Same Tag','g5plus-academia'),
                        ),
                        'default' => array(
                            'category'      => '1',
                            'tag'      => '1',
                        ),
                        'required'  => array('show_related_post', '=', array('1')),
                    ),


                    array(
                        'id' => 'section_single_blog_layout_start',
                        'type' => 'section',
                        'title' => esc_html__('Layout Options', 'g5plus-academia'),
                        'indent' => true
                    ),


			        array(
				        'id' => 'single_blog_layout',
				        'type' => 'button_set',
				        'title' => esc_html__('Layout', 'g5plus-academia'),
				        'subtitle' => esc_html__('Select Single Blog Layout', 'g5plus-academia'),
				        'desc' => '',
				        'options' => array(
                            'full' => esc_html__('Full Width','g5plus-academia'),
                            'container' => esc_html__('Container','g5plus-academia'),
                            'container-fluid' => esc_html__('Container Fluid','g5plus-academia')
                        ),
				        'default' => 'container'
			        ),

			        array(
				        'id' => 'single_blog_sidebar',
				        'type' => 'image_select',
				        'title' => esc_html__('Sidebar', 'g5plus-academia'),
				        'subtitle' => esc_html__('Set Sidebar Style', 'g5plus-academia'),
				        'desc' => '',
				        'options' => array(
					        'none' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-none.png'),
					        'left' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-left.png'),
					        'right' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-right.png'),
					        'both' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-both.png'),
				        ),
				        'default' => 'right'
			        ),

			        array(
				        'id' => 'single_blog_sidebar_width',
				        'type' => 'button_set',
				        'title' => esc_html__('Sidebar Width', 'g5plus-academia'),
				        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-academia'),
				        'desc' => '',
				        'options' => array(
                            'small' => esc_html__('Small (1/4)','g5plus-academia'),
                            'large' => esc_html__('Large (1/3)','g5plus-academia')
                        ),
				        'default' => 'small',
				        'required'  => array('single_blog_sidebar', '=', array('left','both','right')),
			        ),


			        array(
				        'id' => 'single_blog_left_sidebar',
				        'type' => 'select',
				        'title' => esc_html__('Left Sidebar', 'g5plus-academia'),
				        'subtitle' => esc_html__('Choose the default left sidebar','g5plus-academia'),
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'sidebar-1',
				        'required'  => array('single_blog_sidebar', '=', array('left','both')),
			        ),

			        array(
				        'id' => 'single_blog_right_sidebar',
				        'type' => 'select',
				        'title' => esc_html__('Right Sidebar', 'g5plus-academia'),
				        'subtitle' => esc_html__('Choose the default right sidebar','g5plus-academia'),
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'sidebar-1',
				        'required'  => array('single_blog_sidebar', '=', array('right','both')),
			        ),

                    array(
                        'id' => 'section_single_blog_layout_end',
                        'type' => 'section',
                        'indent' => false
                    ),

                    array(
                        'id' => 'section_single_blog_title_start',
                        'type' => 'section',
                        'title' => esc_html__('Page Title Options', 'g5plus-academia'),
                        'indent' => true
                    ),
                    //page-title
                    array(
                        'id' => 'show_single_blog_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Page Title', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Page Title', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id' => 'style_single_blog_title',
                        'type' => 'select',
                        'title' => esc_html__('Page Title Style', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select page title style', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'pt-bottom' => esc_html__('Bottom','g5plus-academia'),
                            'pt-center' => esc_html__('Center','g5plus-academia'),
                        ),
                        'default' => 'pt-bottom',
                        'required'  => array('show_single_blog_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'single_blog_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Text Align', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Set Page Title Text Align', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            'left' => esc_html__('Left','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'right' => esc_html__('Right','g5plus-academia')
                        ),
                        'default'  => 'center',
                        'required'  => array('style_single_blog_title', '=', array('pt-center')),
                    ),

                    array(
                        'id' => 'single_blog_sub_title',
                        'type' => 'text',
                        'title' => esc_html__('Page Sub Title', 'g5plus-academia'),
                        'subtitle' => '',
                        'desc' => '',
                        'default' => '',
                        'required'  => array('show_single_blog_title', '=', array('1')),
                    ),

                    array(
                        'id'             => 'single_blog_title_padding',
                        'type'           => 'spacing',
                        'mode'           => 'padding',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Padding', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set page title top/bottom padding.', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'default'            => array(
                            'padding-top'  => '270px',
                            'padding-bottom'  => '0px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_single_blog_title', '=', array('1')),
                    ),

                    array(
                        'id'             => 'single_blog_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Margin Bottom', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set page title bottom margin.', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'top'          => false,
                        'default'            => array(
                            'margin-bottom'  => '60px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_single_blog_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'single_blog_title_border_bottom',
                        'type' => 'button_set',
                        'title' => esc_html__('Border Bottom', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enabling this option will display bottom border on Title Area', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('Enable','g5plus-academia'),
                            '0' => esc_html__('Disable','g5plus-academia')
                        ),
                        'default' => '0',
                        'required'  => array('show_single_blog_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'single_blog_title_color',
                        'type'     => 'color',
                        'title' => esc_html__('Text Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a color for archive title.', 'g5plus-academia'),
                        'default'  => '#fff',
                        'validate' => 'color',
                        'required'  => array('show_single_blog_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'single_blog_title_bg_color',
                        'type'     => 'color_rgba',
                        'title' => esc_html__('Background Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a background color for page title.', 'g5plus-academia'),
                        'default'   => array(
                            'color'     => '#000',
                            'alpha'     => 0,
                            'rgba'     => 'rgba(0,0,0,0)'
                        ),
                        'validate' => 'colorrgba',
                        'required'  => array('show_single_blog_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'single_blog_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background Image', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload page title background.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => array(
                            'url' => $archive_title_bg_url
                        ),
                        'required'  => array('show_single_blog_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'single_blog_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Page Title Parallax', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Page Title Parallax', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '1',
                        'required'  => array(
                            array('show_single_blog_title', '=', array('1')),
                            array('single_blog_title_bg_image', '!=', ''),
                        ),
                    ),

                    array(
                        'id'       => 'single_blog_title_parallax_position',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Parallax Position', 'g5plus-academia' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'top' => esc_html__('Top','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'bottom' => esc_html__('Bottom','g5plus-academia'),
                        ),
                        'default'  => 'center',
                        'required'  => array(
                            array('show_single_blog_title', '=', array('1')),
                            array('single_blog_title_bg_image', '!=', ''),
                            array('single_blog_title_parallax', '=', '1'),
                        ),
                    ),

                    array(
                        'id' => 'section_single_blog_title_end',
                        'type' => 'section',
                        'indent' => false
                    ),





		        )
	        );

            // Logo
            $this->sections[] = array(
                'title'  => esc_html__( 'Logo Setting', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-leaf',
                'fields' => array(
	                array(
		                'id' => 'section-logo-desktop',
		                'type' => 'section',
		                'title' => esc_html__('Logo Desktop', 'g5plus-academia'),
		                'indent' => true
	                ),
                    array(
                        'id' => 'logo',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Logo', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload your logo here.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => array(
                            'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo.png'
                        )
                    ),
	                array(
		                'id' => 'logo_retina',
		                'type' => 'media',
		                'url'=> true,
		                'title' => esc_html__('Logo Retina', 'g5plus-academia'),
		                'subtitle' => esc_html__('Upload your logo retina here.', 'g5plus-academia'),
		                'desc' => '',
		                'default' => array(
			                'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo-2x.png'
		                )
	                ),
	                array(
		                'id'        => 'logo_height',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Logo Height', 'g5plus-academia'),
		                'desc'      => esc_html__('You can set a height for the logo here', 'g5plus-academia'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'Height'  => ''
		                )
	                ),
                    array(
                        'id'        => 'logo_max_height',
                        'type'      => 'dimensions',
                        'title'     => esc_html__('Logo Max Height', 'g5plus-academia'),
                        'desc'      => esc_html__('You can set a max height for the logo here', 'g5plus-academia'),
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
		                'title'          => esc_html__('Logo Top/Bottom Padding', 'g5plus-academia'),
		                'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-academia'),
		                'desc'           => esc_html__('If you would like to override the default logo top/bottom padding, then you can do so here.', 'g5plus-academia'),
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
		                'title' => esc_html__('Sticky Logo', 'g5plus-academia'),
		                'subtitle' => esc_html__('Upload a sticky version of your logo here', 'g5plus-academia'),
		                'desc' => '',
		                'default' => array(
			                'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo.png'
		                )
	                ),
	                array(
		                'id' => 'sticky_logo_retina',
		                'type' => 'media',
		                'url'=> true,
		                'title' => esc_html__('Sticky Logo Retina', 'g5plus-academia'),
		                'subtitle' => esc_html__('Upload a sticky version of your logo retina here', 'g5plus-academia'),
		                'desc' => '',
		                'default' => array(
			                'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo-2x.png'
		                )
	                ),

	                array(
		                'id' => 'section-logo-mobile',
		                'type' => 'section',
		                'title' => esc_html__('Logo Mobile', 'g5plus-academia'),
		                'indent' => true
	                ),
	                array(
		                'id' => 'mobile_logo',
		                'type' => 'media',
		                'url'=> true,
		                'title' => esc_html__('Mobile Logo', 'g5plus-academia'),
		                'subtitle' => esc_html__('Upload your logo here.', 'g5plus-academia'),
		                'desc' => '',
		                'default' => array(
			                'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo-mobile.png'
		                )
	                ),
	                array(
		                'id' => 'mobile_logo_retina',
		                'type' => 'media',
		                'url'=> true,
		                'title' => esc_html__('Mobile Logo Retina', 'g5plus-academia'),
		                'subtitle' => esc_html__('Upload your logo retina here.', 'g5plus-academia'),
		                'desc' => '',
		                'default' => array(
			                'url' => G5PLUS_THEME_URL . 'assets/images/theme-options/logo-mobile-2x.png'
		                )
	                ),
	                array(
		                'id'        => 'mobile_logo_height',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Logo Height', 'g5plus-academia'),
		                'desc'      => esc_html__('You can set a height for the logo here', 'g5plus-academia'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'Height'  => ''
		                )
	                ),
	                array(
		                'id'        => 'mobile_logo_max_height',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Mobile Logo Max Height', 'g5plus-academia'),
		                'desc'      => esc_html__('You can set a max height for the logo mobile here', 'g5plus-academia'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'Height'  => ''
		                )
	                ),
	                array(
		                'id'        => 'mobile_logo_padding',
		                'type'      => 'dimensions',
		                'title'     => esc_html__('Logo Top/Bottom Padding', 'g5plus-academia'),
		                'desc'      => esc_html__('If you would like to override the default logo top/bottom padding, then you can do so here', 'g5plus-academia'),
		                'units' => 'px',
		                'width'    =>  false,
		                'default'  => array(
			                'Height'  => ''
		                )
	                ),

                )
            );
	        // Top Drawer
	        $this->sections[] = array(
		        'title'  => esc_html__( 'Top Drawer', 'g5plus-academia' ),
		        'desc'   => '',
		        'icon'   => 'el el-minus',
		        'fields' => array(
			        array(
				        'id'       => 'top_drawer_type',
				        'type'     => 'button_set',
				        'title'    => esc_html__( 'Top Drawer Type', 'g5plus-academia' ),
				        'subtitle' => esc_html__( 'Set top drawer type.', 'g5plus-academia' ),
				        'desc'     => '',
				        'options'  => array( 'none' => 'Disable', 'show' => 'Always Show', 'toggle' => 'Toggle' ),
				        'default'  => 'none'
			        ),
			        array(
				        'id'       => 'top_drawer_sidebar',
				        'type' => 'select',
				        'title' => esc_html__('Top Drawer Sidebar', 'g5plus-academia'),
				        'subtitle' => "Choose the default top drawer sidebar",
				        'data'      => 'sidebars',
				        'desc' => '',
				        'default' => 'top_drawer_sidebar',
				        'required' => array('top_drawer_type','=',array('show','toggle')),
			        ),

			        array(
				        'id' => 'top_drawer_wrapper_layout',
				        'type' => 'button_set',
				        'title' => esc_html__('Top Drawer Wrapper Layout', 'g5plus-academia'),
				        'subtitle' => esc_html__('Select top drawer wrapper layout', 'g5plus-academia'),
				        'desc' => '',
				        'options' => array('full' => 'Full Width','container' => 'Container', 'container-fluid' => 'Container Fluid'),
				        'default' => 'container',
				        'required' => array('top_drawer_type','=',array('show','toggle')),
			        ),

			        array(
				        'id'       => 'top_drawer_hide_mobile',
				        'type'     => 'button_set',
				        'title'    => esc_html__( 'Show/Hide Top Drawer on mobile', 'g5plus-academia' ),
				        'desc'     => '',
				        'options'  => array( '1' => 'On', '0' => 'Off' ),
				        'default'  => '1',
				        'required' => array('top_drawer_type','=',array('show','toggle')),
			        ),

		        )
	        );


            // Header
            $this->sections[] = array(
                'title'  => esc_html__( 'Header', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-credit-card',
                'fields' => array(
	                array(
		                'id' => 'section-header-topbar',
		                'type' => 'section',
		                'title' => esc_html__('Top Bar Options', 'g5plus-academia'),
		                'indent' => true
	                ),
	                array(
		                'id'       => 'top_bar',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show/Hide Top Bar', 'g5plus-academia' ),
		                'subtitle' => esc_html__( 'Show Hide Top Bar.', 'g5plus-academia' ),
		                'desc'     => '',
		                'options'  => array( '1' => 'On', '0' => 'Off' ),
		                'default'  => '0',
	                ),
	                array(
		                'id' => 'top_bar_layout',
		                'type' => 'image_select',
		                'title' => esc_html__('Top bar Layout', 'g5plus-academia'),
		                'subtitle' => esc_html__('Select the top bar column layout.', 'g5plus-academia'),
		                'desc' => '',
		                'options' => array(
			                'top-bar-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-1.jpg'),
			                'top-bar-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-2.jpg'),
			                'top-bar-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-3.jpg'),
			                'top-bar-4' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-4.jpg'),
		                ),
		                'default' => 'top-bar-1',
		                'required' => array('top_bar','=','1'),
	                ),

	                array(
		                'id' => 'top_bar_left_sidebar',
		                'type' => 'select',
		                'title' => esc_html__('Top Left Sidebar', 'g5plus-academia'),
		                'subtitle' => "Choose the default top left sidebar",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'top_bar_left',
		                'required' => array('top_bar','=','1'),
	                ),
	                array(
		                'id' => 'top_bar_right_sidebar',
		                'type' => 'select',
		                'title' => esc_html__('Top Right Sidebar', 'g5plus-academia'),
		                'subtitle' => "Choose the default top right sidebar",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'top_bar_right',
		                'required' => array('top_bar','=','1'),
	                ),

	                array(
		                'id' => 'section-header-options',
		                'type' => 'section',
		                'title' => esc_html__('Header Options', 'g5plus-academia'),
		                'indent' => true
	                ),
                    array(
                        'id' => 'header_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Header Layout', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select a header layout option from the examples.', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'header-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-1.jpg'),
	                        'header-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-2.jpg'),
	                        'header-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-3.jpg'),
                        ),
                        'default' => 'header-1'
                    ),
	                array(
		                'id'        => 'header_boxed',
		                'type'      => 'button_set',
		                'title'     => esc_html__('Header Boxed', 'g5plus-academia'),
		                'options'  => array(
			                '1'     => esc_html__('On','g5plus-academia'),
			                '0'      => esc_html__('Off','g5plus-academia'),
		                ),
		                'default'  => '0'
	                ),
	                array(
		                'id'        => 'header_container_layout',
		                'type'      => 'button_set',
		                'title'     => esc_html__('Header container layout', 'g5plus-academia'),
		                'options'  => array(
			                'container'     => esc_html__('Container','g5plus-academia'),
			                'container-full'      => esc_html__('Container Full','g5plus-academia'),
		                ),
		                'default'  => 'container'
	                ),
                    array(
                        'id'       => 'header_sticky',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show/Hide Header Sticky', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Show Hide header Sticky.', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
	                        '1' => esc_html__('On','g5plus-academia'),
	                        '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default'  => '1'
                    ),
                )
            );

	        // Mobile Header
            $this->sections[] = array(
                'title'  => esc_html__( 'Mobile Header', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-th-list',
                'fields' => array(
	                array(
		                'id' => 'section-mobile-header-top-bar',
		                'type' => 'section',
		                'title' => esc_html__('Top Bar Mobile', 'g5plus-academia'),
		                'indent' => true
	                ),
	                array(
		                'id'       => 'top_bar_mobile',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Show/Hide Top Bar', 'g5plus-academia' ),
		                'subtitle' => esc_html__( 'Show Hide Top Bar.', 'g5plus-academia' ),
		                'desc'     => '',
		                'options'  => array( '1' => 'On', '0' => 'Off' ),
		                'default'  => '0',
	                ),
	                array(
		                'id' => 'top_bar_mobile_layout',
		                'type' => 'image_select',
		                'title' => esc_html__('Top bar Layout', 'g5plus-academia'),
		                'subtitle' => esc_html__('Select the top bar column layout.', 'g5plus-academia'),
		                'desc' => '',
		                'options' => array(
			                'top-bar-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-1.jpg'),
			                'top-bar-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-2.jpg'),
			                'top-bar-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-3.jpg'),
			                'top-bar-4' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/top-bar-layout-4.jpg'),
		                ),
		                'default' => 'top-bar-1',
		                'required' => array('top_bar_mobile','=','1'),
	                ),

	                array(
		                'id' => 'top_bar_mobile_left_sidebar',
		                'type' => 'select',
		                'title' => esc_html__('Top Left Sidebar', 'g5plus-academia'),
		                'subtitle' => "Choose the default top left sidebar",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'top_bar_left',
		                'required' => array('top_bar_mobile','=','1'),
	                ),
	                array(
		                'id' => 'top_bar_mobile_right_sidebar',
		                'type' => 'select',
		                'title' => esc_html__('Top Right Sidebar', 'g5plus-academia'),
		                'subtitle' => "Choose the default top right sidebar",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'top_bar_right',
		                'required' => array('top_bar_mobile','=','1'),
	                ),

	                array(
		                'id' => 'section-mobile-header-options',
		                'type' => 'section',
		                'title' => esc_html__('Header Mobile Options', 'g5plus-academia'),
		                'indent' => true
	                ),
	                array(
		                'id' => 'mobile_header_layout',
		                'type' => 'image_select',
		                'title' => esc_html__('Header Layout', 'g5plus-academia'),
		                'subtitle' => esc_html__('Select header mobile layout', 'g5plus-academia'),
		                'desc' => '',
		                'options' => array(
			                'header-mobile-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-mobile-layout-1.png'),
			                'header-mobile-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-mobile-layout-2.png'),
			                'header-mobile-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-mobile-layout-3.png'),
			                'header-mobile-4' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/header-mobile-layout-4.png'),
		                ),
		                'default' => 'header-mobile-1'
	                ),
	                array(
		                'id'       => 'mobile_header_responsive_breakpoint',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Mobile header responsive breakpoint', 'g5plus-academia' ),
		                'subtitle' => esc_html__( 'Set mobile header responsive breakpoint', 'g5plus-academia' ),
		                'desc'     => '',
		                'options'  => array(
			                '991' => esc_html__('Medium Devices: < 992px','g5plus-academia'),
			                '767' => esc_html__('Tablet Portrait: < 768px','g5plus-academia'),
		                ),
		                'default'  => '991'
	                ),
	                array(
		                'id'       => 'mobile_header_menu_drop',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Menu Drop Type', 'g5plus-academia' ),
		                'subtitle' => esc_html__( 'Set menu drop type for mobile header', 'g5plus-academia' ),
		                'desc'     => '',
		                'options'  => array(
			                'dropdown' => esc_html__('Dropdown Menu','g5plus-academia'),
			                'fly' => esc_html__('Fly Menu','g5plus-academia')
		                ),
		                'default'  => 'fly'
	                ),

	                array(
		                'id'        => 'mobile_header_border_bottom',
		                'type'      => 'button_set',
		                'title'     => esc_html__('Mobile header border bottom', 'g5plus-academia'),
		                'options'  => array(
			                'none'          => esc_html__('None','g5plus-academia'),
			                'bordered'      => esc_html__('Bordered','g5plus-academia'),
			                'container-bordered'      => esc_html__('Container Bordered','g5plus-academia'),
		                ),
		                'default'  => 'none',
	                ),
                    array(
                        'id'       => 'mobile_header_stick',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Stick Mobile Header', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Stick Mobile Header.', 'g5plus-academia' ),
                        'desc'     => '',
	                    'options'  => array( '1' => esc_html__('On','g5plus-academia'), '0' => esc_html__('Off','g5plus-academia') ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'mobile_header_search_box',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Search Box', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Search Box.', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'mobile_header_shopping_cart',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Shopping Cart', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Shopping Cart', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),
                )
            );
	        // Header Customize
	        $this->sections[] = array(
		        'title'  => esc_html__( 'Header Customize', 'g5plus-academia' ),
		        'desc'   => '',
		        'icon'   => 'el el-credit-card',
		        'fields' => array(
			        array(
				        'id'      => 'header_customize_nav',
				        'type'    => 'sorter',
				        'title'   => 'Header customize navigation',
				        'desc'    => 'Organize how you want the layout to appear on the header navigation',
				        'options' => array(
					        'enabled'  => array(
						        'social-profile' => esc_html__('Social Profile','g5plus-academia'),
					        ),
					        'disabled' => array(
						        'shopping-cart'   => esc_html__('Shopping Cart','g5plus-academia'),
						        'search-button' => esc_html__('Search Button','g5plus-academia'),
						        'custom-text' => esc_html__('Custom Text','g5plus-academia'),
						        'my-account' => esc_html__('My Account Button','g5plus-academia'),
					        )
				        )
			        ),
			        array(
				        'id' => 'header_customize_nav_social_profile',
				        'type' => 'select',
				        'multi' => true,
				        'width' => '100%',
				        'title' => esc_html__('Custom social profiles', 'g5plus-academia'),
				        'subtitle' => esc_html__('Select social profile for custom text', 'g5plus-academia'),
				        'options' => array(
					        'twitter'  => esc_html__( 'Twitter', 'g5plus-academia' ),
					        'facebook'  => esc_html__( 'Facebook', 'g5plus-academia' ),
					        'dribbble'  => esc_html__( 'Dribbble', 'g5plus-academia' ),
					        'vimeo'  => esc_html__( 'Vimeo', 'g5plus-academia' ),
					        'tumblr'  => esc_html__( 'Tumblr', 'g5plus-academia' ),
					        'skype'  => esc_html__( 'Skype', 'g5plus-academia' ),
					        'linkedin'  => esc_html__( 'LinkedIn', 'g5plus-academia' ),
					        'googleplus'  => esc_html__( 'Google+', 'g5plus-academia' ),
					        'flickr'  => esc_html__( 'Flickr', 'g5plus-academia' ),
					        'youtube'  => esc_html__( 'YouTube', 'g5plus-academia' ),
					        'pinterest' => esc_html__( 'Pinterest', 'g5plus-academia' ),
					        'foursquare'  => esc_html__( 'Foursquare', 'g5plus-academia' ),
					        'instagram' => esc_html__( 'Instagram', 'g5plus-academia' ),
					        'github'  => esc_html__( 'GitHub', 'g5plus-academia' ),
					        'xing' => esc_html__( 'Xing', 'g5plus-academia' ),
					        'behance'  => esc_html__( 'Behance', 'g5plus-academia' ),
					        'deviantart'  => esc_html__( 'Deviantart', 'g5plus-academia' ),
					        'soundcloud'  => esc_html__( 'SoundCloud', 'g5plus-academia' ),
					        'yelp'  => esc_html__( 'Yelp', 'g5plus-academia' ),
					        'rss'  => esc_html__( 'RSS Feed', 'g5plus-academia' ),
					        'email'  => esc_html__( 'Email address', 'g5plus-academia' ),
				        ),
				        'desc' => '',
				        'default' => ''
			        ),
			        array(
				        'id' => 'header_customize_nav_text',
				        'type' => 'ace_editor',
				        'mode' => 'html',
				        'theme' => 'monokai',
				        'title' => esc_html__('Custom Text Content', 'g5plus-academia'),
				        'subtitle' => esc_html__('Add Content for Custom Text', 'g5plus-academia'),
				        'desc' => '',
				        'default' => '',
				        'options'  => array('minLines'=> 5, 'maxLines' => 60),
			        ),
			        array(
				        'id' => 'header_customize_my_account_text',
				        'type' => 'text',
				        'title' => esc_html__('My Account Text Button', 'g5plus-academia'),
				        'subtitle' => esc_html__('Add text for account button', 'g5plus-academia'),
				        'desc' => '',
				        'default' => esc_html('Register', 'g5plus-academia'),
			        ),
			        array(
				        'id' => 'header_customize_my_account_text_sign_out',
				        'type' => 'text',
				        'title' => esc_html__('My Account Sign Out Text Button', 'g5plus-academia'),
				        'subtitle' => esc_html__('Add text for account sign out button', 'g5plus-academia'),
				        'desc' => '',
				        'default' => esc_html('Sign Out', 'g5plus-academia'),
			        ),
		        )
	        );

	        // Footer
            $this->sections[] = array(
                'title'  => esc_html__( 'Footer', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-website',
                'fields' => array(
	                array(
		                'id' => 'section-footer-settings',
		                'type' => 'section',
		                'title' => esc_html__('Footer Settings', 'g5plus-academia'),
		                'indent' => true
	                ),
	                array(
		                'id' => 'footer_wrapper_layout',
		                'type' => 'button_set',
		                'title' => esc_html__('Footer Wrapper Layout', 'g5plus-academia'),
		                'subtitle' => esc_html__('Select Footer Wrapper Layout', 'g5plus-academia'),
		                'desc' => '',
		                'options' => array(
			                'full'              => esc_html__('Full Width','g5plus-academia'),
			                'container-fluid'   => esc_html__('Container Fluid','g5plus-academia'),
		                ),
		                'default' => 'full'
	                ),
	                array(
		                'id' => 'footer_container_layout',
		                'type' => 'button_set',
		                'title' => esc_html__('Footer Container Layout', 'g5plus-academia'),
		                'subtitle' => esc_html__('Select Footer Container Layout', 'g5plus-academia'),
		                'desc' => '',
		                'options' => array(
                            'full'              => esc_html__('Full Width','g5plus-academia'),
                            'container-fluid'   => esc_html__('Container Fluid','g5plus-academia'),
			                'container'         => esc_html__('Container','g5plus-academia')
                        ),
		                'default' => 'container'
	                ),



                    array(
                        'id' => 'footer_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background image', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload footer background image here', 'g5plus-academia'),
                        'desc' => '',
                    ),


                    array(
                        'id'       => 'footer_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Footer Parallax', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Footer Parallax', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '0'
                    ),
                    array(
                        'id'       => 'collapse_footer',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Collapse footer on mobile device', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable collapse footer', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '0'
                    ),

	                array(
		                'id' => 'footer_scheme',
		                'type' => 'button_set',
		                'title' => esc_html__('Footer Scheme', 'g5plus-academia'),
		                'subtitle' => esc_html__( 'Choose footer scheme', 'g5plus-academia' ),
		                'desc' => '',
		                'options'  => array(
			                'light'         => esc_html__('Light','g5plus-academia'),
			                'dark'          => esc_html__('Dark','g5plus-academia'),
			                'custom'        => esc_html__('Custom','g5plus-academia'),
		                ),
		                'default' => 'dark'
	                ),

	                array(
		                'id'       => 'footer_bg_color',
		                'type'     => 'color_rgba',
		                'title'    => esc_html__('Background Color', 'g5plus-academia'),
		                'subtitle' => esc_html__('Set Footer Background Color.', 'g5plus-academia'),
		                'default'  => array(),
		                'validate' => 'colorrgba',
		                'required' => array('footer_scheme','=','custom'),
	                ),
	                array(
		                'id'       => 'footer_main_overlay',
		                'type'     => 'color_rgba',
		                'title'    => esc_html__('Main Footer Overlay', 'g5plus-academia'),
		                'subtitle' => esc_html__('Set main footer overlay.', 'g5plus-academia'),
		                'default'  => array(),
		                'validate' => 'colorrgba',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'footer_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Text Color', 'g5plus-academia'),
		                'subtitle' => esc_html__('Set Footer Text Color.', 'g5plus-academia'),
		                'default'  => '',
		                'validate' => 'color',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'footer_heading_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Heading Text Color', 'g5plus-academia'),
		                'subtitle' => esc_html__('Set Footer Heading Text Color.', 'g5plus-academia'),
		                'default'  => '',
		                'validate' => 'color',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'footer_above_bg_color',
		                'type'     => 'color_rgba',
		                'title'    => esc_html__('Footer Above Background Color', 'g5plus-academia'),
		                'subtitle' => esc_html__('Set Footer Above Background Color.', 'g5plus-academia'),
		                'default'  => array(),
		                'validate' => 'colorrgba',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'footer_above_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Footer Above Text Color', 'g5plus-academia'),
		                'subtitle' => esc_html__('Set Footer Above Text Color.', 'g5plus-academia'),
		                'default'  => '',
		                'validate' => 'color',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'bottom_bar_bg_color',
		                'type'     => 'color_rgba',
		                'title'    => esc_html__('Bottom Bar Background Color', 'g5plus-academia'),
		                'subtitle' => esc_html__('Set Bottom Bar Background Color.', 'g5plus-academia'),
		                'default'  => array(),
		                'validate' => 'colorrgba',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id'       => 'bottom_bar_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Bottom Bar Text Color', 'g5plus-academia'),
		                'subtitle' => esc_html__('Set Bottom Bar Text Color.', 'g5plus-academia'),
		                'default'  => '',
		                'validate' => 'color',
		                'required' => array('footer_scheme','=','custom'),
	                ),

	                array(
		                'id' => 'section-footer-above-settings',
		                'type' => 'section',
		                'title' => esc_html__('Footer Above Settings', 'g5plus-academia'),
		                'indent' => true
	                ),
                    array(
                        'id'       => 'footer_above',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Footer Above', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Footer Above', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),

                    array(
                        'id' => 'footer_above_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Footer above layout', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select the top bar column layout.', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'footer-above-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/bottom-bar-layout-4.jpg'),
                            'footer-above-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/bottom-bar-layout-1.jpg')
                        ),
                        'default' => 'footer-above-1',
                        'required' => array('footer_above','=','1'),
                    ),

                    array(
                        'id' => 'footer_above_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Footer Above Left Sidebar', 'g5plus-academia'),
                        'subtitle' => "Choose the default top left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'footer_above_left',
                        'required' => array('footer_above','=','1'),
                    ),
                    array(
                        'id' => 'footer_above_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Footer Above Right Sidebar', 'g5plus-academia'),
                        'subtitle' => "Choose the default top right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'footer_above_right',
                        'required' => array('footer_above','=','1'),
                    ),
	                array(
		                'id'             => 'footer_above_padding',
		                'type'           => 'spacing',
		                'mode'           => 'padding',
		                'units'          => 'px',
		                'units_extended' => 'false',
		                'title'          => esc_html__('Footer Above Top/Bottom Padding', 'g5plus-academia'),
		                'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-academia'),
		                'desc'           => esc_html__('If you would like to override the default footer above top/bottom padding, then you can do so here.', 'g5plus-academia'),
		                'left'          => false,
		                'right'         => false,
		                'default'            => array(
			                'padding-top'     => '',
			                'padding-bottom'  => '',
			                'units'          => 'px',
		                ),
		                'required' => array('footer_above','=','1'),
	                ),



	                array(
		                'id' => 'section-main-footer-settings',
		                'type' => 'section',
		                'title' => esc_html__('Main Footer Settings', 'g5plus-academia'),
		                'indent' => true
	                ),
	                array(
		                'id' => 'footer_layout',
		                'type' => 'image_select',
		                'title' => esc_html__('Layout', 'g5plus-academia'),
		                'subtitle' => esc_html__('Select the footer column layout.', 'g5plus-academia'),
		                'desc' => '',
		                'options' => array(
			                'footer-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-1.jpg'),
			                'footer-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-2.jpg'),
			                'footer-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-3.jpg'),
			                'footer-4' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-4.jpg'),
			                'footer-5' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-5.jpg'),
			                'footer-6' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-6.jpg'),
			                'footer-7' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-7.jpg'),
			                'footer-8' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-8.jpg'),
			                'footer-9' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/footer-layout-9.jpg'),
		                ),
		                'default' => 'footer-1'
	                ),

	                array(
		                'id' => 'footer_sidebar_1',
		                'type' => 'select',
		                'title' => esc_html__('Sidebar 1', 'g5plus-academia'),
		                'subtitle' => "Choose the default footer sidebar 1",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-1',
	                ),

	                array(
		                'id' => 'footer_sidebar_2',
		                'type' => 'select',
		                'title' => esc_html__('Sidebar 2', 'g5plus-academia'),
		                'subtitle' => "Choose the default footer sidebar 2",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-2',
	                ),

	                array(
		                'id' => 'footer_sidebar_3',
		                'type' => 'select',
		                'title' => esc_html__('Sidebar 3', 'g5plus-academia'),
		                'subtitle' => "Choose the default footer sidebar 3",
		                'data'      => 'sidebars',
		                'desc' => '',
		                'default' => 'footer-3',
	                ),

	                array(
		                'id' => 'footer_sidebar_4',
		                'type' => 'select',
		                'title' => esc_html__('Sidebar 4', 'g5plus-academia'),
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
		                'title'          => esc_html__('Footer Top/Bottom Padding', 'g5plus-academia'),
		                'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-academia'),
		                'desc'           => esc_html__('If you would like to override the default footer top/bottom padding, then you can do so here.', 'g5plus-academia'),
		                'left'          => false,
		                'right'          => false,
		                'default'            => array(
			                'padding-top'     => '',
			                'padding-bottom'  => '',
			                'units'          => 'px',
		                )
	                ),


	                array(
		                'id' => 'section-bottom-bar-settings',
		                'type' => 'section',
		                'title' => esc_html__('Bottom Bar Settings', 'g5plus-academia'),
		                'indent' => true
	                ),
                    array(
                        'id'       => 'bottom_bar',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Bottom Bar', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Bottom Bar (below Footer)', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'On', '0' => 'Off' ),
                        'default'  => '1'
                    ),
                    array(
                        'id' => 'bottom_bar_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Bottom bar Layout', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select the bottom bar column layout.', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'bottom-bar-1' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/bottom-bar-layout-1.jpg'),
                            'bottom-bar-2' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/bottom-bar-layout-2.jpg'),
                            'bottom-bar-3' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/bottom-bar-layout-3.jpg'),
	                        'bottom-bar-4' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/bottom-bar-layout-4.jpg'),
                        ),
                        'default' => 'bottom-bar-1',
                        'required' => array('bottom_bar','=','1'),
                    ),

                    array(
                        'id' => 'bottom_bar_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Bottom Left Sidebar', 'g5plus-academia'),
                        'subtitle' => "Choose the default bottom left sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'bottom_bar_left',
                        'required' => array('bottom_bar','=','1'),
                    ),
                    array(
                        'id' => 'bottom_bar_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Bottom Right Sidebar', 'g5plus-academia'),
                        'subtitle' => "Choose the default bottom right sidebar",
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'bottom_bar_right',
                        'required' => array('bottom_bar','=','1'),
                    ),
	                array(
		                'id'             => 'bottom_bar_padding',
		                'type'           => 'spacing',
		                'mode'           => 'padding',
		                'units'          => 'px',
		                'units_extended' => 'false',
		                'title'          => esc_html__('Bottom Bar Top/Bottom Padding', 'g5plus-academia'),
		                'subtitle'       => esc_html__('This must be numeric (no px). Leave balnk for default.', 'g5plus-academia'),
		                'desc'           => esc_html__('If you would like to override the default bottom bar top/bottom padding, then you can do so here.', 'g5plus-academia'),
		                'left'          => false,
		                'right'         => false,
		                'default'            => array(
			                'padding-top'     => '',
			                'padding-bottom'  => '',
			                'units'          => 'px',
		                ),
		                'required' => array('bottom_bar','=','1'),
	                ),
                )
            );

	        // Styling Options
            $this->sections[] = array(
                'title'  => esc_html__( 'Styling Options', 'g5plus-academia' ),
                'desc'   => esc_html__( 'If you change value in this section, you must "Save & Generate CSS"', 'g5plus-academia' ),
                'icon'   => 'el el-magic',
                'fields' => array(
                    array(
                        'id'       => 'primary_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Primary Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Primary Color', 'g5plus-academia'),
                        'default'  => '#9261aa',
                        'validate' => 'color',
                    ),

                    array(
                        'id'       => 'secondary_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Secondary Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Secondary Color', 'g5plus-academia'),
                        'default'  => '#ffbd33',
                        'validate' => 'color',
                    ),
	                array(
		                'id'       => 'tertiary_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Tertiary Color', 'g5plus-academia'),
		                'subtitle' => esc_html__('Set Tertiary Color', 'g5plus-academia'),
		                'default'  => '#30a8cc',
		                'validate' => 'color',
	                ),
                    array(
                        'id'       => 'text_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Text Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Text Color.', 'g5plus-academia'),
                        'default'  => '#868686',
                        'validate' => 'color',
                    ),
	                array(
		                'id'       => 'heading_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Heading Color', 'g5plus-academia'),
		                'subtitle' => esc_html__('Set Heading Color.', 'g5plus-academia'),
		                'default'  => '#222222',
		                'validate' => 'color',
	                ),
                    array(
                        'id'       => 'border_color',
                        'type'     => 'color',
                        'title'    => esc_html__('Border Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Border Color.', 'g5plus-academia'),
                        'default'  => '#eeeeee',
                        'validate' => 'color',
                    ),


	                array(
		                'id'       => 'top_drawer_bg_color',
		                'type'     => 'color',
		                'title'    => esc_html__( 'Top drawer background color', 'g5plus-academia' ),
		                'subtitle' => esc_html__( 'Set Top drawer background color.', 'g5plus-academia' ),
		                'default'  => '#2f2f2f',
		                'validate' => 'color',
	                ),

	                array(
		                'id'       => 'top_drawer_text_color',
		                'type'     => 'color',
		                'title'    => esc_html__('Top drawer text color', 'g5plus-academia'),
		                'subtitle' => esc_html__('Pick a text color for the Top drawer', 'g5plus-academia'),
		                'default'  => '#c5c5c5',
		                'validate' => 'color',
	                ),
	                array(
		                'id'       => 'slyling_options_div_01',
		                'type'     => 'divide',
	                ),
	                array(
		                'id'       => 'sub_menu_scheme',
		                'type'     => 'button_set',
		                'title'    => esc_html__( 'Sub Menu Scheme', 'g5plus-academia' ),
		                'subtitle' => esc_html__( 'Select submenu scheme', 'g5plus-academia' ),
		                'desc'     => '',
		                'options'  => array(
			                'sub-menu-dark' => esc_html__('Dark','g5plus-academia'),
			                'sub-menu-light' => esc_html__('Light','g5plus-academia')
		                ),
		                'default'  => 'sub-menu-light'
	                ),
                )
            );

            // Custom font
            $this->sections[] = array(
                'title'  => esc_html__( 'Custom font', 'g5plus-academia' ),
                'desc'   => '<span style="color:red"><strong>After upload font file, please click  "Save changes" and refresh page before go to Font Options</strong></span>',
                'icon'   => 'el el-text-width',
                'fields' => array(
                    array(
                        'id'        => 'section_custom_font_1',
                        'type'      => 'section',
                        'title'     => esc_html__('Custom Font 1', 'g5plus-academia'),
                        'indent'    => true
                    ),
                    array(
                        'id' => 'custom_font_1_name',
                        'type' => 'text',
                        'title' => esc_html__('Custom font Name 1', 'g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'custom_font_1_eot',
                        'type' => 'upload',
                        'url'=> true,
                        'title' => esc_html__('Custom font 1 (.eot)', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload your font .eot here.', 'g5plus-academia'),
                        'desc' => '',
                        'library_filter' => array('eot')
                    ),
                    array(
                        'id' => 'custom_font_1_ttf',
                        'type' => 'upload',
                        'url'=> true,
                        'title' => esc_html__('Custom font 1 (.ttf)', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload your font .ttf here.', 'g5plus-academia'),
                        'desc' => '',
                        'library_filter' => array('ttf')
                    ),
                    array(
                        'id' => 'custom_font_1_woff',
                        'type' => 'upload',
                        'url'=> true,
                        'title' => esc_html__('Custom font 1 (.woff)', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload your font .woff here.', 'g5plus-academia'),
                        'desc' => '',
                        'library_filter' => array('woff')
                    ),
                    array(
                        'id' => 'custom_font_1_svg',
                        'type' => 'upload',
                        'url'=> true,
                        'title' => esc_html__('Custom font 1 (.svg)', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload your font .svg here.', 'g5plus-academia'),
                        'desc' => '',
                        'library_filter' => array('svg')
                    ),
                    array(
                        'id'        => 'section_custom_font_2',
                        'type'      => 'section',
                        'title'     => esc_html__('Custom Font 2', 'g5plus-academia'),
                        'indent'    => true
                    ),
                    array(
                        'id' => 'custom_font_2_name',
                        'type' => 'text',
                        'title' => esc_html__('Custom font Name 2', 'g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'custom_font_2_eot',
                        'type' => 'upload',
                        'url'=> true,
                        'title' => esc_html__('Custom font 2 (.eot)', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload your font .eot here.', 'g5plus-academia'),
                        'desc' => '',
                        'library_filter' => array('eot')
                    ),
                    array(
                        'id' => 'custom_font_2_ttf',
                        'type' => 'upload',
                        'url'=> true,
                        'title' => esc_html__('Custom font 2 (.ttf)', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload your font .ttf here.', 'g5plus-academia'),
                        'desc' => '',
                        'library_filter' => array('ttf')
                    ),
                    array(
                        'id' => 'custom_font_2_woff',
                        'type' => 'upload',
                        'url'=> true,
                        'title' => esc_html__('Custom font 2 (.woff)', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload your font .woff here.', 'g5plus-academia'),
                        'desc' => '',
                        'library_filter' => array('woff')
                    ),
                    array(
                        'id' => 'custom_font_2_svg',
                        'type' => 'upload',
                        'url'=> true,
                        'title' => esc_html__('Custom font 2 (.svg)', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload your font .svg here.', 'g5plus-academia'),
                        'desc' => '',
                        'library_filter' => array('svg')
                    ),
                )
            );

	        // Font Options
            $this->sections[] = array(
                'icon' => 'el el-font',
                'title' => esc_html__('Font Options', 'g5plus-academia'),
                'desc'   => esc_html__( 'If you change value in this section, you must "Save & Generate CSS"', 'g5plus-academia' ),
                'fields' => array(
                    array(
                        'id'=>'body_font',
                        'type' => 'typography',
                        'title' => esc_html__('Body Font', 'g5plus-academia'),
                        'subtitle' => esc_html__('Specify the body font properties.', 'g5plus-academia'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'line-height'=> true,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output'    => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler'  => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        'units'     => 'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'13px',
                            'font-family'=>'Roboto',
                            'font-weight'=>'400',
                            'google'      => true,
	                        'line-height'=>'24px',
                        ),
                    ),
                    array(
                        'id'=>'h1_font',
                        'type' => 'typography',
                        'title' => esc_html__('H1 Font', 'g5plus-academia'),
                        'subtitle' => esc_html__('Specify the H1 font properties.', 'g5plus-academia'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'text-align'=>false,
                        'line-height'=>true,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h1'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h1'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'36px',
                            'font-family' => 'Oswald',
                            'font-weight'=>'700',
	                        'line-height'=>'48px',
                        ),
                    ),
                    array(
                        'id'=>'h2_font',
                        'type' => 'typography',
                        'title' => esc_html__('H2 Font', 'g5plus-academia'),
                        'subtitle' => esc_html__('Specify the H2 font properties.', 'g5plus-academia'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'line-height'=>true,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h2'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'29px',
                            'font-family' => 'Oswald',
                            'font-weight'=>'700',
	                        'line-height'=>'39px',
                        ),
                    ),
                    array(
                        'id'=>'h3_font',
                        'type' => 'typography',
                        'title' => esc_html__('H3 Font', 'g5plus-academia'),
                        'subtitle' => esc_html__('Specify the H3 font properties.', 'g5plus-academia'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'text-align'=>false,
                        'line-height'=>true,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h3'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h3'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'22px',
                            'font-family' => 'Oswald',
                            'font-weight'=>'400',
	                        'line-height'=>'29px',
                        ),
                    ),
                    array(
                        'id'=>'h4_font',
                        'type' => 'typography',
                        'title' => esc_html__('H4 Font', 'g5plus-academia'),
                        'subtitle' => esc_html__('Specify the H4 font properties.', 'g5plus-academia'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'text-align'=>false,
                        'line-height'=>true,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h4'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'17px',
                            'font-family' => 'Oswald',
                            'font-weight'=>'400',
	                        'line-height'=>'23px',
                        ),
                    ),
                    array(
                        'id'=>'h5_font',
                        'type' => 'typography',
                        'title' => esc_html__('H5 Font', 'g5plus-academia'),
                        'subtitle' => esc_html__('Specify the H5 font properties.', 'g5plus-academia'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'line-height'=>true,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h5'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h5'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'=>'13px',
                            'font-family' => 'Oswald',
                            'font-weight'=>'400',
	                        'line-height'=>'17px',
                        ),
                    ),
                    array(
                        'id'=>'h6_font',
                        'type' => 'typography',
                        'title' => esc_html__('H6 Font', 'g5plus-academia'),
                        'subtitle' => esc_html__('Specify the H6 font properties.', 'g5plus-academia'),
                        'google'=> true,
                        'fonts' => $fonts,
                        'line-height'=>true,
                        'text-align'=>false,
                        'color'=>false,
                        'letter-spacing'=>false,
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
                        'compiler' => array('h6'), // An array of CSS selectors to apply this font style to dynamically
                        'units'=>'px', // Defaults to px
                        'default' => array(
                            'font-size'     =>'11px',
                            'font-family'   => 'Oswald',
                            'font-weight'   =>'400',
	                        'line-height'   => '15px'
                        ),
                    ),

	                array(
		                'id'=> 'primary_font',
		                'type' => 'typography',
		                'title' => esc_html__('Primary Font', 'g5plus-academia'),
		                'subtitle' => esc_html__('Specify the Primary Font properties.', 'g5plus-academia'),
		                'google' => true,
                        'fonts' => $fonts,
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
			                'font-family'=>'Oswald',
		                ),
	                ),

                    array(
                        'id'=> 'secondary_font',
                        'type' => 'typography',
                        'title' => esc_html__('Secondary Font', 'g5plus-academia'),
                        'subtitle' => esc_html__('Specify the Secondary font properties.', 'g5plus-academia'),
                        'google' => true,
                        'fonts' => $fonts,
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
                            'font-family'=>'Roboto',
                        ),
                    ),
                    array(
                        'id'=> 'count_down_font',
                        'type' => 'typography',
                        'title' => esc_html__('Countdown Font', 'g5plus-academia'),
                        'subtitle' => esc_html__('Specify the countdown font properties.', 'g5plus-academia'),
                        'google' => true,
                        'all_styles' => false, // Enable all Google Font style/weight variations to be added to the page
                        'line-height'=>false,
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
                            'font-family'=>'Oswald',
                        ),
                    ),
                ),
            );

	        // Social Profiles
            $this->sections[] = array(
                'title'  => esc_html__( 'Social Profiles', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-path',
                'fields' => array(
                    array(
                        'id' => 'twitter_url',
                        'type' => 'text',
                        'title' => esc_html__('Twitter', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Twitter','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'facebook_url',
                        'type' => 'text',
                        'title' => esc_html__('Facebook', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your facebook page/profile url','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'dribbble_url',
                        'type' => 'text',
                        'title' => esc_html__('Dribbble', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Dribbble','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'vimeo_url',
                        'type' => 'text',
                        'title' => esc_html__('Vimeo', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Vimeo','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'tumblr_url',
                        'type' => 'text',
                        'title' => esc_html__('Tumblr', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Tumblr','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'skype_username',
                        'type' => 'text',
                        'title' => esc_html__('Skype', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Skype username','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'linkedin_url',
                        'type' => 'text',
                        'title' => esc_html__('LinkedIn', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your LinkedIn page/profile url','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'googleplus_url',
                        'type' => 'text',
                        'title' => esc_html__('Google+', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Google+ page/profile URL','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'flickr_url',
                        'type' => 'text',
                        'title' => esc_html__('Flickr', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Flickr page url','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'youtube_url',
                        'type' => 'text',
                        'title' => esc_html__('YouTube', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your YouTube URL','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'pinterest_url',
                        'type' => 'text',
                        'title' => esc_html__('Pinterest', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Pinterest','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'foursquare_url',
                        'type' => 'text',
                        'title' => esc_html__('Foursquare', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Foursqaure URL','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'instagram_url',
                        'type' => 'text',
                        'title' => esc_html__('Instagram', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Instagram','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'github_url',
                        'type' => 'text',
                        'title' => esc_html__('GitHub', 'g5plus-academia'),
                    'subtitle' => esc_html__('Your GitHub URL','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'xing_url',
                        'type' => 'text',
                        'title' => esc_html__('Xing', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Xing URL','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'behance_url',
                        'type' => 'text',
                        'title' => esc_html__('Behance', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Behance URL','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'deviantart_url',
                        'type' => 'text',
                        'title' => esc_html__('Deviantart', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Deviantart URL','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'soundcloud_url',
                        'type' => 'text',
                        'title' => esc_html__('SoundCloud', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your SoundCloud URL','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'yelp_url',
                        'type' => 'text',
                        'title' => esc_html__('Yelp', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your Yelp URL','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'rss_url',
                        'type' => 'text',
                        'title' => esc_html__('RSS Feed', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your RSS Feed URL','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id' => 'email_address',
                        'type' => 'text',
                        'title' => esc_html__('Email address', 'g5plus-academia'),
                        'subtitle' => esc_html__('Your email address','g5plus-academia'),
                        'desc' => '',
                        'default' => ''
                    ),
                    array(
                        'id'=>'social-profile-divide-0',
                        'type' => 'divide'
                    ),
                    array(
                        'title'    => esc_html__('Social Share', 'g5plus-academia'),
                        'id'       => 'social_sharing',
                        'type'     => 'checkbox',
                        'subtitle' => esc_html__('Show the social sharing in blog posts', 'g5plus-academia'),

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

	        // Woocommerce
            $this->sections[] = array(
                'title'  =>  esc_html__( 'Course', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-shopping-cart',
                'fields' => array(
                    array(
                        'id'        => 'course_action_enroll',
                        'type'      => 'button_set',
                        'title'     => esc_html__('Action after click enroll', 'g5plus-academia'),
                        'desc'     => '',
                        'options'  => array(
                            '0' => esc_html__('Default','g5plus-academia'),
                            '1' => esc_html__('Go to cart page','g5plus-academia'),
                            '2' => esc_html__('Go to checkout page','g5plus-academia'),
                            '3' => esc_html__('Go to another page','g5plus-academia'),
                        ),
                        'default'  => '0'
                    ),
                    array(
                        'id' => 'course_action_another_page',
                        'type' => 'text',
                        'title' => esc_html__('Go to another page url', 'g5plus-academia'),
                        'default' => '',
                        'required'  => array('course_action_enroll', '=', array('3')),
                    ),
                    array(
                        'id'        => 'course_level',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Course Level', 'g5plus-academia'),
                        'subtitle' => esc_html__( 'level seperating by "|"', 'g5plus-academia' ),
                        'default'   => 'Beginner|Master',
                    ),
                    array(
                        'id'        => 'course_location',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Course Location', 'g5plus-academia'),
                        'subtitle' => esc_html__( 'location seperating by "|"', 'g5plus-academia' ),
                        'default'   => 'London|Watford|Oxford|Dartford',
                    ),
                    array(
                        'id'       => 'product_show_rating',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Rating', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Show/Hide Rating course', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'product_show_count_comment',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Count Comment', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Show/Hide count comment course', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default'  => '1'
                    ),

                    array(
                        'id'       => 'product_sale_flash_mode',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Sale Flash Mode', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Chose Sale Flash Mode', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            'text' => esc_html__('Text','g5plus-academia'),
                            'percent' => esc_html__('Percent','g5plus-academia')
                        ),
                        'default'  => 'percent'
                    ),

                    array(
                        'id'       => 'product_show_result_count',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Result Count', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Show/Hide Result Count In Archive Course', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default'  => '1'
                    ),
                    array(
                        'id'       => 'product_show_catalog_ordering',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Show Catalog Ordering', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Show/Hide Catalog Ordering', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default'  => '1'
                    ),

                    array(
                        'id'       => 'product_add_to_cart',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Add To Cart Button', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable/Disable Add To Cart Button', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            '1' => esc_html__('Enable','g5plus-academia'),
                            '0' => esc_html__('Disable','g5plus-academia')
                        ),
                        'default'  => '1'
                    ),
                )
            );

            // Archive Product
            $this->sections[] = array(
                'title'  => esc_html__( 'Archive Course', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-book',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id'        => 'product_per_page',
                        'type'      => 'text',
                        'title'     => esc_html__('Course Per Page', 'g5plus-academia'),
                        'desc'  => esc_html__('This must be numeric or empty (default 12).', 'g5plus-academia'),
                        'subtitle'      => esc_html__('Set Course Per Page in archive course', 'g5plus-academia'),
                        'validate'  => 'numeric',
                        'default'   => '12',
                    ),
                    array(
                        'id' => 'product_display_columns',
                        'type' => 'select',
                        'title' => esc_html__('Course Display Columns', 'g5plus-academia'),
                        'subtitle' => esc_html__('Choose the number of columns to display on shop/category pages.','g5plus-academia'),
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
                        'id' => 'filter_archive_product_start_date',
                        'type' => 'button_set',
                        'title' => esc_html__('Filter Start Date', 'g5plus-academia'),
                        'subtitle' => esc_html__('Filter course has start date bigger current date', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '0'
                    ),


                    array(
                        'id' => 'section-archive-product-layout-start',
                        'type' => 'section',
                        'title' => esc_html__('Layout Options', 'g5plus-academia'),
                        'indent' => true
                    ),



                    array(
                        'id' => 'archive_product_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Archive Course Layout', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select Archive Course Layout', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'full' => esc_html__('Full Width','g5plus-academia'),
                            'container' => esc_html__('Container','g5plus-academia'),
                            'container-fluid' => esc_html__('Container Fluid','g5plus-academia')
                        ),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'show_archive_product_view_style',
                        'type' => 'button_set',
                        'title' => esc_html__('Show View Style', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '' => esc_html__('Grid style','g5plus-academia'),
                            'view-list' => esc_html__('List Style','g5plus-academia')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id' => 'show_archive_product_start_date',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Start Date', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Start Date', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '0'
                    ),
                    array(
                        'id' => 'show_archive_product_duration',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Duration', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Duration', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'show_archive_product_teacher',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Teacher', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Teacher', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'show_archive_product_level',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Level', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Level', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id' => 'section-archive-product-layout-end',
                        'type' => 'section',
                        'indent' => false
                    ),
                    array(
                        'id' => 'section-archive-product-title-start',
                        'type' => 'section',
                        'title' => esc_html__('Page Title Options', 'g5plus-academia'),
                        'indent' => true
                    ),

                    //page-title
                    array(
                        'id' => 'show_archive_product_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Archive Course Title', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Archive Course Title', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id' => 'style_archive_product_title',
                        'type' => 'select',
                        'title' => esc_html__('Page Title Style', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select page title style', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'pt-bottom' => esc_html__('Bottom','g5plus-academia'),
                            'pt-center' => esc_html__('Center','g5plus-academia'),
                        ),
                        'default' => 'pt-bottom',
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'archive_product_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Text Align', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Set Archive Product Title Text Align', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            'left' => esc_html__('Left','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'right' => esc_html__('Right','g5plus-academia')
                        ),
                        'default'  => 'center',
                        'required'  => array('style_archive_product_title', '=', array('pt-center')),
                    ),

                    array(
                        'id' => 'archive_product_sub_title',
                        'type' => 'text',
                        'title' => esc_html__('Archive Sub Title', 'g5plus-academia'),
                        'subtitle' => '',
                        'desc' => '',
                        'default' => '',
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),

                    array(
                        'id'             => 'archive_product_title_padding',
                        'type'           => 'spacing',
                        'mode'           => 'padding',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Page Title Padding', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set archive course title top/bottom padding.', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'default'            => array(
                            'padding-top'  => '270px',
                            'padding-bottom'  => '0px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),



                    array(
                        'id'             => 'archive_product_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Margin Bottom', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set archive product title bottom margin', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'top'          => false,
                        'default'            => array(
                            'margin-bottom'  => '60px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'archive_product_title_color',
                        'type'     => 'color',
                        'title' => esc_html__('Text Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a color for archive product title.', 'g5plus-academia'),
                        'default'  => '#fff',
                        'validate' => 'color',
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'archive_product_title_bg_color',
                        'type'     => 'color_rgba',
                        'title' => esc_html__('Background Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a background color for archive product title.', 'g5plus-academia'),
                        'default'   => array(
                            'color'     => '#000',
                            'alpha'     => 0,
                            'rgba'     => 'rgba(0,0,0,0)'
                        ),
                        'validate' => 'colorrgba',
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'archive_product_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background Image', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload archive product title background.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => array(
                            'url' => $archive_product_title_bg_url
                        ),
                        'required'  => array('show_archive_product_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'archive_product_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Archive Course Title Parallax', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Archive Course Title Parallax', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            '1' => esc_html__('Enable','g5plus-academia'),
                            '0' => esc_html__('Disable','g5plus-academia')
                        ),
                        'default'  => '1',
                        'required'  => array(
                            array('show_archive_product_title', '=', array('1')),
                            array('archive_product_title_bg_image', '!=', ''),
                        ),
                    ),

                    array(
                        'id'       => 'archive_product_title_parallax_position',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Parallax Position', 'g5plus-academia' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'top' => esc_html__('Top','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'bottom' => esc_html__('Bottom','g5plus-academia'),
                        ),
                        'default'  => 'top',
                        'required'  => array(
                            array('show_archive_product_title', '=', array('1')),
                            array('archive_product_title_bg_image', '!=', ''),
                            array('archive_product_title_parallax', '=', '1'),
                        ),
                    ),

                    array(
                        'id' => 'section-archive-product-title-end',
                        'type' => 'section',
                        'indent' => false
                    ),

                    array(
                        'id' => 'show_page_shop_content',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Page Shop Content', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Shop Page Content', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array('0' => 'Off','before' => 'Show Before Archive','after' => 'Show After Archive'),
                        'default' => '0'
                    ),
                )
            );

            // Single Product
            $this->sections[] = array(
                'title'  => esc_html__( 'Single Course', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-laptop',
                'subsection' => true,
                'fields' => array(
	                array(
		                'id' => 'section-single-product-layout-start',
		                'type' => 'section',
		                'title' => esc_html__('Layout Options', 'g5plus-academia'),
		                'indent' => true
	                ),

                    array(
                        'id' => 'single_product_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Layout', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select Single Course Layout', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'full' => esc_html__('Full Width','g5plus-academia'),
                            'container' => esc_html__('Container','g5plus-academia'),
                            'container-fluid' => esc_html__('Container Fluid','g5plus-academia')
                        ),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'single_product_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Sidebar', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Single Course Sidebar', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'left' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-right.png'),
                        ),
                        'default' => 'right'
                    ),
                    array(
                        'id' => 'single_product_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Sidebar Width', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'small' => esc_html__('Small (1/4)','g5plus-academia'),
                            'large' => esc_html__('Large (1/3)','g5plus-academia')
                        ),
                        'default' => 'large',
                        'required'  => array('single_product_sidebar', '=', array('left','right')),
                    ),
                    array(
                        'id' => 'single_product_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Left Sidebar', 'g5plus-academia'),
                        'subtitle' => esc_html__('Choose the default Single Product left sidebar','g5plus-academia'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'woocommerce',
                        'required'  => array('single_product_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'single_product_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Right Sidebar', 'g5plus-academia'),
                        'subtitle' => esc_html__('Choose the default Single Couse right sidebar','g5plus-academia'),
                        'data'      => 'sidebars',
                        'desc' => '',
                        'default' => 'woocommerce',
                        'required'  => array('single_product_sidebar', '=', array('right','both')),
                    ),

                    array(
                        'id' => 'single_product_seat_title',
                        'type' => 'text',
                        'title' => esc_html__('Seat Title', 'g5plus-academia'),
                        'subtitle' => '',
                        'desc' => '',
                        'default' => 'Seat avaiable'
                    ),

                    array(
                        'id' => 'section-single-product-layout-end',
                        'type' => 'section',
                        'indent' => false
                    ),

                    array(
                        'id' => 'section-single-product-title-start',
                        'type' => 'section',
                        'title' => esc_html__('Page Title Options', 'g5plus-academia'),
                        'indent' => true
                    ),
                    //page-title
                    array(
                        'id' => 'show_single_product_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Page Title', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Page Title', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'style_single_product_title',
                        'type' => 'select',
                        'title' => esc_html__('Page Title Style', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select page title style', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'pt-bottom' => esc_html__('Bottom','g5plus-academia'),
                            'pt-center' => esc_html__('Center','g5plus-academia'),
                        ),
                        'default' => 'pt-bottom',
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'single_product_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Text Align', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Set Page Title Text Align', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            'left' => esc_html__('Left','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'right' => esc_html__('Right','g5plus-academia')
                        ),
                        'default'  => 'center',
                        'required'  => array('style_single_product_title', '=', array('pt-center')),
                    ),

                    array(
                        'id' => 'single_product_sub_title',
                        'type' => 'text',
                        'title' => esc_html__('Page Sub Title', 'g5plus-academia'),
                        'subtitle' => '',
                        'desc' => '',
                        'default' => '',
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),

                    array(
                        'id'             => 'single_product_title_padding',
                        'type'           => 'spacing',
                        'mode'           => 'padding',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Padding', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set page title top/bottom padding.', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'default'            => array(
                            'padding-top'  => '270px',
                            'padding-bottom'  => '0px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),

                    array(
                        'id'             => 'single_product_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Margin Bottom', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set page title bottom margin.', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'top'          => false,
                        'default'            => array(
                            'margin-bottom'  => '60px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'single_product_title_color',
                        'type'     => 'color',
                        'title' => esc_html__('Text Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a color for page title.', 'g5plus-academia'),
                        'default'  => '#fff',
                        'validate' => 'color',
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'single_product_title_bg_color',
                        'type'     => 'color_rgba',
                        'title' => esc_html__('Background Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a background color for page title.', 'g5plus-academia'),
                        'default'   => array(
                            'color'     => '#000',
                            'alpha'     => 0,
                            'rgba'     => 'rgba(0,0,0,0)'
                        ),
                        'validate' => 'colorrgba',
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'single_product_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background Image', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload archive title background.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => array(
                            'url' => $single_product_title_bg_url
                        ),
                        'required'  => array('show_single_product_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'single_product_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Page Title Parallax', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Page Title Parallax', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '1',
                        'required'  => array(
                            array('show_single_product_title', '=', array('1')),
                            array('single_product_title_bg_image', '!=', ''),
                        ),
                    ),

                    array(
                        'id'       => 'single_product_title_parallax_position',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Parallax Position', 'g5plus-academia' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'top' => esc_html__('Top','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'bottom' => esc_html__('Bottom','g5plus-academia'),
                        ),
                        'default'  => 'top',
                        'required'  => array(
                            array('show_single_product_title', '=', array('1')),
                            array('single_product_title_bg_image', '!=', ''),
                            array('single_product_title_parallax', '=', '1'),
                        ),
                    ),
                    array(
                        'id' => 'related_product_condition',
                        'type' => 'checkbox',
                        'title' => esc_html__('Related Course Condition', 'g5plus-academia'),
                        'options' => array(
                            'category' => esc_html__('Same Category','g5plus-academia'),
                            'tag' => esc_html__('Same Tag','g5plus-academia'),
                        ),
                        'default' => array(
                            'category'      => '1',
                            'tag'      => '1',
                        ),
                    ),


                    array(
                        'id' => 'section_single_product_title_end',
                        'type' => 'section',
                        'indent' => false
                    ),
                )
            );
            // Archive Event
            $this->sections[] = array(
                'title'  => esc_html__( 'Archive Event', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-folder-close',
                'fields' => array(
                    array(
                        'id' => 'section-archive-event-layout-start',
                        'type' => 'section',
                        'title' => esc_html__('Layout Options', 'g5plus-academia'),
                        'indent' => true
                    ),
                    array(
                        'id' => 'archive_event_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Archive Event Layout', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select Archive Event Layout', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'full' => esc_html__('Full Width','g5plus-academia'),
                            'container' => esc_html__('Container','g5plus-academia'),
                            'container-fluid' => esc_html__('Container Fluid','g5plus-academia')
                        ),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'section-archive-event-layout-end',
                        'type' => 'section',
                        'indent' => false
                    ),
                    array(
                        'id' => 'section-archive-event-title-start',
                        'type' => 'section',
                        'title' => esc_html__('Page Title Options', 'g5plus-academia'),
                        'indent' => true
                    ),

                    array(
                        'id' => 'show_archive_event_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Archive Event Title', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Archive Event Title', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),

                    array(
                        'id' => 'style_archive_event_title',
                        'type' => 'select',
                        'title' => esc_html__('Page Title Style', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select page title style', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'pt-bottom' => esc_html__('Bottom','g5plus-academia'),
                            'pt-center' => esc_html__('Center','g5plus-academia'),
                        ),
                        'default' => 'pt-bottom',
                        'required'  => array('show_archive_event_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'archive_event_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Text Align', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Set Page Title Text Align', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            'left' => esc_html__('Left','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'right' => esc_html__('Right','g5plus-academia')
                        ),
                        'default'  => 'center',
                        'required'  => array('style_archive_event_title', '=', array('pt-center')),
                    ),

                    array(
                        'id' => 'archive_event_sub_title',
                        'type' => 'text',
                        'title' => esc_html__('Archive Sub Title', 'g5plus-academia'),
                        'subtitle' => '',
                        'desc' => '',
                        'default' => '',
                        'required'  => array('show_archive_event_title', '=', array('1')),
                    ),

                    array(
                        'id'             => 'archive_event_title_padding',
                        'type'           => 'spacing',
                        'mode'           => 'padding',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Page Title Padding Top', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set archive event title top padding.', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'default'            => array(
                            'padding-top'  => '270px',
                            'padidng-bottom' => '0px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_archive_event_title', '=', array('1')),
                    ),



                    array(
                        'id'             => 'archive_event_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Margin Bottom', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set archive event title bottom margin', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'top'          => false,
                        'default'            => array(
                            'margin-bottom'  => '60px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_archive_event_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'archive_event_title_color',
                        'type'     => 'color',
                        'title' => esc_html__('Text Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a color for page title.', 'g5plus-academia'),
                        'default'  => '#fff',
                        'validate' => 'color',
                        'required'  => array('show_archive_event_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'archive_event_title_bg_color',
                        'type'     => 'color_rgba',
                        'title' => esc_html__('Background Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a background color for page title.', 'g5plus-academia'),
                        'default'   => array(
                            'color'     => '#000',
                            'alpha'     => 0,
                            'rgba'     => 'rgba(0,0,0,0)'
                        ),
                        'validate' => 'colorrgba',
                        'required'  => array('show_archive_event_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'archive_event_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background Image', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload archive event title background.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => array(
                            'url' => $archive_title_bg_url
                        ),
                        'required'  => array('show_archive_event_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'archive_event_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Archive Event Title Parallax', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Archive Event Title Parallax', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            '1' => esc_html__('Enable','g5plus-academia'),
                            '0' => esc_html__('Disable','g5plus-academia')
                        ),
                        'default'  => '1',
                        'required'  => array(
                            array('show_archive_event_title', '=', array('1')),
                            array('archive_event_title_bg_image', '!=', ''),
                        ),
                    ),

                    array(
                        'id'       => 'archive_event_title_parallax_position',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Parallax Position', 'g5plus-academia' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'top' => esc_html__('Top','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'bottom' => esc_html__('Bottom','g5plus-academia'),
                        ),
                        'default'  => 'top',
                        'required'  => array(
                            array('show_archive_event_title', '=', array('1')),
                            array('archive_event_title_bg_image', '!=', ''),
                            array('archive_event_title_parallax', '=', '1'),
                        ),
                    ),

                    array(
                        'id' => 'section-archive-event-title-end',
                        'type' => 'section',
                        'indent' => false
                    ),
                )
            );
            // Single Event
            $this->sections[] = array(
                'title'  => esc_html__( 'Single Event', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-file',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'section-single-event-layout-start',
                        'type' => 'section',
                        'title' => esc_html__('Layout Options', 'g5plus-academia'),
                        'indent' => true
                    ),

                    array(
                        'id' => 'single_event_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Layout', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select Single Event Layout', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'full' => esc_html__('Full Width','g5plus-academia'),
                            'container' => esc_html__('Container','g5plus-academia'),
                            'container-fluid' => esc_html__('Container Fluid','g5plus-academia')
                        ),
                        'default' => 'container'
                    ),
                    array(
                        'id' => 'single_event_sidebar',
                        'type' => 'image_select',
                        'title' => esc_html__('Sidebar', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Single Event Sidebar', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'left' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-left.png'),
                            'right' => array('title' => '', 'img' => G5PLUS_THEME_URL.'assets/images/theme-options/sidebar-right.png'),
                        ),
                        'default' => 'right'
                    ),
                    array(
                        'id' => 'single_event_sidebar_width',
                        'type' => 'button_set',
                        'title' => esc_html__('Sidebar Width', 'g5plus-academia'),
                        'subtitle' => esc_html__('Set Sidebar width', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'small' => esc_html__('Small (1/4)','g5plus-academia'),
                            'large' => esc_html__('Large (1/3)','g5plus-academia')
                        ),
                        'default' => 'large',
                        'required'  => array('single_event_sidebar', '=', array('left','right')),
                    ),
                    array(
                        'id' => 'single_event_left_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Left Sidebar', 'g5plus-academia'),
                        'subtitle' => esc_html__('Choose the default Single Event left sidebar','g5plus-academia'),
                        'data'      => 'sidebars',
	                    'default' => '',
                        'desc' => '',
                        'required'  => array('single_event_sidebar', '=', array('left','both')),
                    ),
                    array(
                        'id' => 'single_event_right_sidebar',
                        'type' => 'select',
                        'title' => esc_html__('Right Sidebar', 'g5plus-academia'),
                        'subtitle' => esc_html__('Choose the default Single Event right sidebar','g5plus-academia'),
                        'data'      => 'sidebars',
	                    'default' => '',
                        'desc' => '',
                        'required'  => array('single_event_sidebar', '=', array('right','both')),
                    ),

                    array(
                        'id' => 'section-single-event-layout-end',
                        'type' => 'section',
                        'indent' => false
                    ),

                    array(
                        'id' => 'section-single-event-title-start',
                        'type' => 'section',
                        'title' => esc_html__('Page Title Options', 'g5plus-academia'),
                        'indent' => true
                    ),

                    array(
                        'id' => 'show_single_event_title',
                        'type' => 'button_set',
                        'title' => esc_html__('Show Page Title', 'g5plus-academia'),
                        'subtitle' => esc_html__('Enable/Disable Page Title', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            '1' => esc_html__('On','g5plus-academia'),
                            '0' => esc_html__('Off','g5plus-academia')
                        ),
                        'default' => '1'
                    ),
                    array(
                        'id' => 'style_single_event_title',
                        'type' => 'select',
                        'title' => esc_html__('Page Title Style', 'g5plus-academia'),
                        'subtitle' => esc_html__('Select page title style', 'g5plus-academia'),
                        'desc' => '',
                        'options' => array(
                            'pt-bottom' => esc_html__('Bottom','g5plus-academia'),
                            'pt-center' => esc_html__('Center','g5plus-academia'),
                        ),
                        'default' => 'pt-bottom',
                        'required'  => array('show_single_event_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'single_event_title_text_align',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Text Align', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Set Page Title Text Align', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array(
                            'left' => esc_html__('Left','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'right' => esc_html__('Right','g5plus-academia')
                        ),
                        'default'  => 'center',
                        'required'  => array('style_single_event_title', '=', array('pt-center')),
                    ),

                    array(
                        'id' => 'single_event_sub_title',
                        'type' => 'text',
                        'title' => esc_html__('Page Sub Title', 'g5plus-academia'),
                        'subtitle' => '',
                        'desc' => '',
                        'default' => '',
                        'required'  => array('show_single_event_title', '=', array('1')),
                    ),
                    array(
                        'id'             => 'single_event_title_padding',
                        'type'           => 'spacing',
                        'mode'           => 'padding',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Padding', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set page title top/bottom padding.', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'default'            => array(
                            'padding-top'  => '270px',
                            'padding-bottom'  => '0px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_single_event_title', '=', array('1')),
                    ),

                    array(
                        'id'             => 'single_event_title_margin',
                        'type'           => 'spacing',
                        'mode'           => 'margin',
                        'units'          => 'px',
                        'units_extended' => 'false',
                        'title'          => esc_html__('Margin Bottom', 'g5plus-academia'),
                        'subtitle'       => esc_html__('Set page title bottom margin.', 'g5plus-academia'),
                        'desc'           => '',
                        'left'          => false,
                        'right'          => false,
                        'top'          => false,
                        'default'            => array(
                            'margin-bottom'  => '60px',
                            'units'          => 'px',
                        ),
                        'required'  => array('show_single_event_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'single_event_title_color',
                        'type'     => 'color',
                        'title' => esc_html__('Text Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a color for page title.', 'g5plus-academia'),
                        'default'  => '#fff',
                        'validate' => 'color',
                        'required'  => array('show_single_event_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'single_event_title_bg_color',
                        'type'     => 'color_rgba',
                        'title' => esc_html__('Background Color', 'g5plus-academia'),
                        'subtitle' => esc_html__('Pick a background color for page title.', 'g5plus-academia'),
                        'default'   => array(
                            'color'     => '#000',
                            'alpha'     => 0,
                            'rgba'     => 'rgba(0,0,0,0.0)'
                        ),
                        'validate' => 'colorrgba',
                        'required'  => array('show_single_event_title', '=', array('1')),
                    ),

                    array(
                        'id' => 'single_event_title_bg_image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => esc_html__('Background Image', 'g5plus-academia'),
                        'subtitle' => esc_html__('Upload archive title background.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => array(
                            'url' => $page_title_bg_url
                        ),
                        'required'  => array('show_single_event_title', '=', array('1')),
                    ),

                    array(
                        'id'       => 'single_event_title_parallax',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Page Title Parallax', 'g5plus-academia' ),
                        'subtitle' => esc_html__( 'Enable Page Title Parallax', 'g5plus-academia' ),
                        'desc'     => '',
                        'options'  => array( '1' => 'Enable', '0' => 'Disable' ),
                        'default'  => '1',
                        'required'  => array(
                            array('show_single_event_title', '=', array('1')),
                            array('single_event_title_bg_image', '!=', ''),
                        ),
                    ),

                    array(
                        'id'       => 'single_event_title_parallax_position',
                        'type'     => 'button_set',
                        'title'    => esc_html__( 'Parallax Position', 'g5plus-academia' ),
                        'subtitle' => '',
                        'desc'     => '',
                        'options'  => array(
                            'top' => esc_html__('Top','g5plus-academia'),
                            'center' => esc_html__('Center','g5plus-academia'),
                            'bottom' => esc_html__('Bottom','g5plus-academia'),
                        ),
                        'default'  => 'center',
                        'required'  => array(
                            array('show_single_event_title', '=', array('1')),
                            array('single_event_title_bg_image', '!=', ''),
                            array('single_event_title_parallax', '=', '1'),
                        ),
                    ),
                    array(
                        'id' => 'section_single_event_title_end',
                        'type' => 'section',
                        'indent' => false
                    ),
                )
            );
            $this->sections[] = array(
                'title'  => esc_html__( 'Resources Options', 'g5plus-academia' ),
                'desc'   => '',
                'icon'   => 'el el-th-large',
                'fields' => array(
                    array(
                        'id'        => 'cdn_bootstrap_js',
                        'type'      => 'text',
                        'title'     => esc_html__('CDN Bootstrap Script', 'g5plus-academia'),
                        'subtitle'  => esc_html__('Url CDN Bootstrap Script', 'g5plus-academia'),
                        'desc'      => '',
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'cdn_bootstrap_css',
                        'type'      => 'text',
                        'title'     => esc_html__('CDN Bootstrap Stylesheet', 'g5plus-academia'),
                        'subtitle'  => esc_html__('Url CDN Bootstrap Stylesheet', 'g5plus-academia'),
                        'desc'      => '',
                        'default'   => '',
                    ),

                    array(
                        'id'        => 'cdn_font_awesome',
                        'type'      => 'text',
                        'title'     => esc_html__('CDN Font Awesome', 'g5plus-academia'),
                        'subtitle'  => esc_html__('Url CDN Font Awesome', 'g5plus-academia'),
                        'desc'      => '',
                        'default'   => '',
                    ),

                )
            );
            $this->sections[] = array(
                'title'  => esc_html__( 'Custom CSS & Script', 'g5plus-academia' ),
                'desc'   => esc_html__( 'If you change Custom CSS, you must "Save & Generate CSS"', 'g5plus-academia' ),
                'icon'   => 'el el-edit',
                'fields' => array(
                    array(
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'title' => esc_html__('Custom CSS', 'g5plus-academia'),
                        'subtitle' => esc_html__('Add some CSS to your theme by adding it to this textarea. Please do not include any style tags.', 'g5plus-academia'),
                        'desc' => '',
                        'default' => '',
                        'options'  => array('minLines'=> 20, 'maxLines' => 60)
                    ),
                    array(
                        'id' => 'custom_js',
                        'type' => 'ace_editor',
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'title' => esc_html__('Custom JS', 'g5plus-academia'),
                        'subtitle' => esc_html__('Add some custom JavaScript to your theme by adding it to this textarea. Please do not include any script tags.', 'g5plus-academia'),
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
                'opt_name'           => 'g5plus_academia_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'       => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'    => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'          => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'     => true,
                // Show the sections below the admin menu item or not
                'menu_title'         => esc_html__( 'Theme Options', 'g5plus-academia' ),
                'page_title'         => esc_html__( 'Theme Options', 'g5plus-academia' ),
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

            // Panel Intro text -> before the form
            if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                if ( ! empty( $this->args['global_variable'] ) ) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace( '-', '_', $this->args['opt_name'] );
                }
                $this->args['intro_text'] = sprintf( esc_html__( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'g5plus-academia' ), $v );
            } else {
                $this->args['intro_text'] = esc_html__( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'g5plus-academia' );
            }
        }

    }

    global $reduxConfig;
    $reduxConfig = new Redux_Framework_options_config();
}