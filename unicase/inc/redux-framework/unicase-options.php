<?php
if ( !class_exists( 'ReduxFramework' ) ) {
    return;
}

if ( !class_exists( 'Unicase_Options' ) ) {

	class Unicase_Options {
		
		
        public function __construct() {
			add_action( 'after_setup_theme', array( $this, 'load_config') );
		}

		public function load_config() {

            $entrance_animations = array(
                'none'              => esc_html__( 'No Animation', 'unicase' ),
                'bounceIn'          => esc_html__( 'BounceIn', 'unicase' ),
                'bounceInDown'      => esc_html__( 'BounceInDown', 'unicase' ),
                'bounceInLeft'      => esc_html__( 'BounceInLeft', 'unicase' ),
                'bounceInRight'     => esc_html__( 'BounceInRight', 'unicase' ),
                'bounceInUp'        => esc_html__( 'BounceInUp', 'unicase' ),
                'fadeIn'            => esc_html__( 'FadeIn', 'unicase' ),
                'fadeInDown'        => esc_html__( 'FadeInDown', 'unicase' ),
                'fadeInDownBig'     => esc_html__( 'FadeInDown Big', 'unicase' ),
                'fadeInLeft'        => esc_html__( 'FadeInLeft', 'unicase' ),
                'fadeInLeftBig'     => esc_html__( 'FadeInLeft Big', 'unicase' ),
                'fadeInRight'       => esc_html__( 'FadeInRight', 'unicase' ),
                'fadeInRightBig'    => esc_html__( 'FadeInRight Big', 'unicase' ),
                'fadeInUp'          => esc_html__( 'FadeInUp', 'unicase' ),
                'fadeInUpBig'       => esc_html__( 'FadeInUp Big', 'unicase' ),
                'flipInX'           => esc_html__( 'FlipInX', 'unicase' ),
                'flipInY'           => esc_html__( 'FlipInY', 'unicase' ),
                'lightSpeedIn'      => esc_html__( 'LightSpeedIn', 'unicase' ),
                'rotateIn'          => esc_html__( 'RotateIn', 'unicase' ),
                'rotateInDownLeft'  => esc_html__( 'RotateInDown Left', 'unicase' ),
                'rotateInDownRight' => esc_html__( 'RotateInDown Right', 'unicase' ),
                'rotateInUpLeft'    => esc_html__( 'RotateInUp Left', 'unicase' ),
                'rotateInUpRight'   => esc_html__( 'RotateInUp Right', 'unicase' ),
                'zoomIn'            => esc_html__( 'ZoomIn', 'unicase' ),
                'zoomInDown'        => esc_html__( 'ZoomInDown', 'unicase' ),
                'zoomInLeft'        => esc_html__( 'ZoomInLeft', 'unicase' ),
                'zoomInRight'       => esc_html__( 'ZoomInRight', 'unicase' ),
                'zoomInUp'          => esc_html__( 'ZoomInUp', 'unicase' ),
            );
			
			$sections = array(

				array(
					'title'        => esc_html__( 'General', 'unicase' ),
					'icon'         => 'fa fa-dot-circle-o',
					'fields'       => array(
						array(
							'title'      => esc_html__( 'Use text instead of logo ?', 'unicase'),
							'id'         => 'use_text_logo',
							'type'       => 'checkbox',
							'default'    => '0',
						),

						array(
							'title'      => esc_html__( 'Logo Text', 'unicase'),
							'subtitle'   => esc_html__( 'Will be displayed only if use text logo is checked.', 'unicase'),
							'id'         => 'logo_text',
							'type'       => 'text',
							'default'    => 'unicase',
							'required' => array(
								0 => 'use_text_logo',
								1 => '=',
								2 => 1,
							),
						),

                        array(
                            'title'          => esc_html__( 'Automatic Page Loader', 'unicase' ),
                            'subtitle'       => esc_html__( 'Enable/Disable Youtube like Page loader', 'unicase' ), 
                            'id'             => 'enable_pace',
                            'on'             => esc_html__( 'Enabled', 'unicase' ),
                            'off'            => esc_html__( 'Disabled', 'unicase' ),
                            'type'           => 'switch',
                            'default'        => 1,
                        ),
						
                        array(
							'title'          => esc_html__( 'Scroll to Top', 'unicase' ),
							'id'             => 'enable_scroll_to_top',
							'on'             => esc_html__( 'Enabled', 'unicase' ),
							'off'            => esc_html__( 'Disabled', 'unicase' ),
							'type'           => 'switch',
							'default'        => 1,
						),
					),
				),

                array(
                    'title'     => esc_html__( 'Layout', 'unicase' ),
                    'icon'      => 'fa fa-th-list',
                    'fields'    => array(

                        array(
                            'title'         => esc_html__( 'Layout Style', 'unicase' ),
                            'id'            => 'layout_style',
                            'type'          => 'select',
                            'default'       => 'stretched',
                            'options'       => array(
                                'stretched'         => esc_html__( 'Stretched', 'unicase' ),
                                'boxed'             => esc_html__( 'Boxed', 'unicase' ),
                                'boxed-attached'    => esc_html__( 'Boxed - Attached', 'unicase' ),
                            )
                        ),

                        array(
                            'title'         => esc_html__( 'Body Background', 'unicase' ),
                            'id'            => 'body_background',
                            'type'          => 'background',
                            'output'        => array( '.boxed', '.boxed-attached' ),
                            'subtitle'      => esc_html__( 'Only visible if layout style is Boxed or Boxed attached', 'unicase' ),
                            'required'      => array( 0 => 'layout_style', 1 => '!=', 2 => 'stretched' ),
                        ),
                    ),
                ),

                array(
                    'title'     => esc_html__( 'Header', 'unicase' ),
                    'icon'      => 'fa fa-arrow-circle-o-up',
                    'fields'    => array(

                        array(
                            'title'      => esc_html__( 'Your Logo', 'unicase' ),
                            'subtitle'   => esc_html__( 'Upload your logo image. Recommended dimension : 152x51 pixels', 'unicase' ),
                            'id'         => 'site_logo',
                            'type'       => 'media',
                        ),

                        array(
                            'title'     => esc_html__( 'Header Style', 'unicase' ),
                            'id'        => 'header_style',
                            'type'      => 'select',
                            'options'   => array(
                                'header-1'    => esc_html__( 'Header Style 1', 'unicase' ),
                                'header-2'    => esc_html__( 'Header Style 2', 'unicase' ),
                                'header-3'    => esc_html__( 'Header Style 3', 'unicase' ),
                                'header-4'    => esc_html__( 'Header Style 4', 'unicase' ),
                                'header-5'    => esc_html__( 'Header Style 5', 'unicase' ),
                            ),
                            'default'   => 'header-1',
                        ),

                        array(
                            'title' => esc_html__('Sticky Header', 'unicase'),
                            'subtitle' => esc_html__('Enable / Disable the Sticky Header.', 'unicase'),
                            'id' => 'sticky_header',
                            'on' => esc_html__('Enabled', 'unicase'),
                            'off' => esc_html__('Disabled', 'unicase'),
                            'type' => 'switch',
                            'default' => 0,
                        ),

                        array(
                            'title'     => esc_html__( 'Header Background', 'unicase' ),
                            'id'        => 'header_bg',
                            'type'      => 'select',
                            'options'   => array(
                                'default-bg'    => esc_html__( 'Default BG', 'unicase' ),
                                'custom'        => esc_html__( 'Custom', 'unicase' ),
                            ),
                            'default'   => 'default',
                        ),

                        array(         
                            'id'       => 'header_background',
                            'type'     => 'background',
                            'title'    => esc_html__('Header Background', 'unicase'),
                            'subtitle' => esc_html__('Header background with image, color, etc.', 'unicase'),
                            'required' => array(
                                array('header_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'background-color'      => '.site-header, .main-navigation ul ul, .secondary-navigation ul ul, .main-navigation ul.menu > li.menu-item-has-children:after, .secondary-navigation ul.menu ul, .main-navigation ul.menu ul, .main-navigation ul.nav-menu ul, .main-navigation.yamm .dropdown-menu, .main-navigation.yamm .yamm-content',
                                'background-image'      => '.site-header',
                                'background-repeat'     => '.site-header',
                                'background-size'       => '.site-header',
                                'background-attachment' => '.site-header',
                                'background-position'   => '.site-header',
                            )
                        ),

                        array(         
                            'id'       => 'header_text_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Header Text Color', 'unicase'),
                            'required' => array(
                                array('header_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'color' => '.site-header, .top-bar, .main-navigation, .site-description, ul.menu li.current-menu-item > a'
                            )
                        ),

                        array(         
                            'id'       => 'header_link_color',
                            'type'     => 'link_color',
                            'title'    => esc_html__('Header Link Color', 'unicase'),
                            'required' => array(
                                array('header_bg','equals','custom'),
                            ),
                            'output'   => array(
                                'color' => '.site-header a, .main-navigation ul li a, .main-navigation.yamm .yamm-content ul li a, .site-title a, ul.menu li a, .site-branding h1 a, .top-bar a, .top-bar ul li a'
                            )
                        ),

                        array(
                            'title'     => esc_html__( 'Live Search', 'unicase' ),
                            'id'        => 'live_search',
                            'type'      => 'switch',
                            'default'   => 1,
                            'on'        => esc_html__( 'Enabled', 'unicase' ),
                            'off'       => esc_html__( 'Disabled', 'unicase' )
                        ),

                        array(
                            'title'     => esc_html__( 'Search Result Template', 'unicase' ),
                            'id'        => 'live_search_template',
                            'type'      => 'ace_editor',
                            'mode'      => 'html',
                            'required'  => array( 'live_search', 'equals', 1 ),
                            'default'   => '<a href="{{url}}" class="media live-search-media"><img src="{{image}}" class="pull-left flip" height="60" width="60"><div class="media-body"><p>{{{value}}}</p></div></a>',
                            'desc'      => esc_html__( 'Available parameters : {{value}}, {{url}}, {{image}}, {{brand}} and {{{price}}}', 'unicase')
                        ),

                        array(
                            'title'     => esc_html__( 'Search Result Empty Message', 'unicase' ),
                            'id'        => 'live_search_empty_msg',
                            'type'      => 'text',
                            'required'  => array( 'live_search', 'equals', 1 ),
                            'default'   => esc_html__( 'Unable to find any products that match the currenty query', 'unicase' ),
                        ),

                        array(
                            'title'     => esc_html__( 'Show Categories Filter', 'unicase' ),
                            'id'        => 'display_search_categories_filter',
                            'type'      => 'switch',
                            'default'   => 1,
                            'on'        => esc_html__( 'Yes', 'unicase' ),
                            'off'       => esc_html__( 'No', 'unicase' )
                        ),

                        array(
                            'title'     => esc_html__( 'Search Category Dropdown', 'unicase' ),
                            'id'        => 'header_search_dropdown',
                            'type'      => 'radio',
                            'options'   => array(
                                'hsd0'  => esc_html__( 'Include only top level categories', 'unicase' ),
                                'hsd1'  => esc_html__( 'Include all categories', 'unicase' )
                            ),
                            'default'   => 'hsd0',
                            'required'  => array( 'display_search_categories_filter', 'equals', 1 )
                        ),

                        array(
                            'title'     => esc_html__( 'Contact Mail', 'unicase' ),
                            'id'        => 'header_support_email',
                            'type'      => 'text',
                            'default'   => '',
                        ),

                        array(
                            'title'     => esc_html__( 'Contact Phone', 'unicase' ),
                            'id'        => 'header_support_phone',
                            'type'      => 'text',
                            'default'   => '',
                        ),

                        array(
                            'title'     => esc_html__( 'Top Cart Text', 'unicase' ),
                            'id'        => 'top_cart_text',
                            'type'      => 'text',
                            'default'   => esc_html__( 'Shopping Cart', 'unicase' ),
                        ),

                        array(
                            'title'     => esc_html__( 'Mini Cart Dropdown Trigger', 'unicase' ),
                            'id'        => 'cart_dropdown_trigger',
                            'type'      => 'select',
                            'options'   => array(
                                'click'     => esc_html__( 'Click', 'unicase' ),
                                'hover'     => esc_html__( 'Hover', 'unicase' ),
                            ),
                            'default'   => 'click',
                        ),

                        array(
                            'title'     => esc_html__( 'Mini Cart Dropdown Animation', 'unicase' ),
                            'id'        => 'cart_dropdown_animation',
                            'type'      => 'select',
                            'options'   => $entrance_animations,
                            'default'   => 'fadeInUp',
                        ),
                    ),
                ),

                array(
                    'title'             => esc_html__( 'Footer', 'unicase' ),
                    'icon'              => 'fa fa-arrow-circle-o-down',
                    'fields'            => array(
                        
                        array(
                            'id'        => 'footer_style',
                            'type'      => 'select',
                            'title'     => esc_html__( 'Footer Style', 'unicase' ),
                            'options'   => array(
                                'default-bg'    => esc_html__( 'Default BG', 'unicase' ),
                                'custom'        => esc_html__( 'Custom', 'unicase' ),
                            ),
                            'default'   => 'default-bg',
                        ),

                        array(         
                            'id'       => 'footer_background',
                            'type'     => 'background',
                            'title'    => esc_html__('Footer Background', 'unicase'),
                            'subtitle' => esc_html__('Footer background with image, color, etc.', 'unicase'),
                            'required' => array(
                                array('footer_style','equals','custom'),
                            ),
                            'output'   => array(
                                'background-color'      => '.site-footer',
                                'background-image'      => '.site-footer',
                                'background-repeat'     => '.site-footer',
                                'background-size'       => '.site-footer',
                                'background-attachment' => '.site-footer',
                                'background-position'   => '.site-footer',
                            )
                        ),

                        array(         
                            'id'       => 'footer_text_color',
                            'type'     => 'color',
                            'title'    => esc_html__('Footer Text Color', 'unicase'),
                            'required' => array(
                                array('footer_style','equals','custom'),
                            ),
                            'output'   => array(
                                'color' => '.site-footer, .site-footer label, .footer-widgets, .footer-widgets .footer-widget .widgettitle, .footer-widgets .footer-widget ul li, .footer-widgets .footer-widget .widget-title, .site-info .copyright, .site-info ul li'
                            )
                        ),

                        array(         
                            'id'       => 'footer_link_color',
                            'type'     => 'link_color',
                            'title'    => esc_html__('Footer Link Color', 'unicase'),
                            'required' => array(
                                array('footer_style','equals','custom'),
                            ),
                            'output'   => array(
                                'color' => '.site-footer a, .footer-widgets a, .footer-widgets .footer-widget a, .footer-widgets .footer-widget ul li a, .footer-widgets .footer-widget .menu > li > a, .footer-widgets .footer-widget .widgettitle + ul > li > a, .footer-widgets .footer-widget .mail-to, .footer-widgets .footer-widget .tel-to, .footer-widgets .footer-widget address, .site-info a, .site-info .copyright a, .site-info ul li a'
                            )
                        ),

                        array(
                            'id'        => 'footer_contact_info',
                            'type'      => 'textarea',
                            'title'     => esc_html__( 'Footer Contact Info', 'unicase' ),
                            'default'   => '',
                        ),

                        array(
                            'id'        => 'footer_credit',
                            'type'      => 'textarea',
                            'title'     => esc_html__( 'Footer Credit', 'unicase' ),
                            'default'   => '&copy; ' . date( 'Y' ). ' <a href="' . esc_url( home_url( '/' ) ) . '">' .  get_bloginfo( 'name' ) . '</a>',
                        ),

                        array(
                            'id'        => 'footer_credit_card_icons_gallery',
                            'type'      => 'gallery',
                            'title'     => esc_html__( 'Footer Payment Images', 'unicase' ),
                        ),
                    ),
                ),

                array(
                    'title'     => esc_html__( 'Navigation', 'unicase' ),
                    'icon'      => 'fa fa-navicon',
                    'fields'    => array(                        
                        array(
                            'id'        => 'primary-navigation-start',
                            'type'      => 'section',
                            'title'     => esc_html__( 'Primary Navigation', 'unicase' ),
                            'subtitle'  => esc_html__( 'Options for primary navigation of the theme', 'unicase' ),
                            'indent'    => false,
                        ),

                        array(
                            'title'     => esc_html__( 'Dropdown Style', 'unicase' ),
                            'id'        => 'primary_dropdown_style',
                            'type'      => 'select',
                            'options'   => array(
                                'default'   => esc_html__( 'Default', 'unicase' ),
                                'inverse'   => esc_html__( 'Inverse', 'unicase' ),
                            ),
                            'default'   => 'inverse',
                        ),

                        array(
                            'title'     => esc_html__( 'Dropdown Trigger', 'unicase' ),
                            'id'        => 'primary_dropdown_trigger',
                            'type'      => 'select',
                            'options'   => array(
                                'click'     => esc_html__( 'Click', 'unicase' ),
                                'hover'     => esc_html__( 'Hover', 'unicase' ),
                            ),
                            'default'   => 'click',
                        ),

                        array(
                            'title'     => esc_html__( 'Dropdown Animation', 'unicase' ),
                            'id'        => 'primary_dropdown_animation',
                            'type'      => 'select',
                            'options'   => $entrance_animations,
                            'default'   => 'fadeInUp',
                        ),

                        array(
                            'title'     => esc_html__( 'Show Dropdown Indicator', 'unicase' ),
                            'id'        => 'primary_show_dropdown_indicator',
                            'type'      => 'switch',
                            'on'        => esc_html__( 'Yes', 'unicase' ),
                            'off'       => esc_html__( 'No', 'unicase' ),
                            'default'   => 1
                        ),

                        array(
                            'id'        => 'primary-navigation-end',
                            'type'      => 'section',
                            'indent'    => false,
                        ),

                        array(
                            'id'        => 'topbar-left-navigation-start',
                            'type'      => 'section',
                            'title'     => esc_html__( 'Top Bar Left Navigation', 'unicase' ),
                            'subtitle'  => esc_html__( 'Options for top bar left navigation of the theme', 'unicase' ),
                            'indent'    => FALSE,
                        ),

                        array(
                            'title'     => esc_html__( 'Dropdown Trigger', 'unicase' ),
                            'id'        => 'topbar-left_dropdown_trigger',
                            'type'      => 'select',
                            'options'   => array(
                                'click'     => esc_html__( 'Click', 'unicase' ),
                                'hover'     => esc_html__( 'Hover', 'unicase' ),
                            ),
                            'default'   => 'click',
                        ),

                        array(
                            'title'     => esc_html__( 'Dropdown Animation', 'unicase' ),
                            'id'        => 'topbar-left_dropdown_animation',
                            'type'      => 'select',
                            'options'   => $entrance_animations,
                            'default'   => 'fadeInUp',
                        ),

                        array(
                            'title'     => esc_html__( 'Show Dropdown Indicator', 'unicase' ),
                            'id'        => 'topbar-left_show_dropdown_indicator',
                            'type'      => 'switch',
                            'on'        => esc_html__( 'Yes', 'unicase' ),
                            'off'       => esc_html__( 'No', 'unicase' ),
                            'default'   => 1
                        ),

                        array(
                            'id'        => 'topbar-left-navigation-end',
                            'type'      => 'section',
                            'indent'    => FALSE,
                        ),

                        array(
                            'id'        => 'topbar-right-navigation-start',
                            'type'      => 'section',
                            'title'     => esc_html__( 'Top Bar Right Navigation', 'unicase' ),
                            'subtitle'  => esc_html__( 'Options for top bar right navigation of the theme', 'unicase' ),
                            'indent'    => FALSE
                        ),

                        array(
                            'title'     => esc_html__( 'Dropdown Trigger', 'unicase' ),
                            'id'        => 'topbar-right_dropdown_trigger',
                            'type'      => 'select',
                            'options'   => array(
                                'click'     => esc_html__( 'Click', 'unicase' ),
                                'hover'     => esc_html__( 'Hover', 'unicase' ),
                            ),
                            'default'   => 'click',
                        ),

                        array(
                            'title'     => esc_html__( 'Dropdown Animation', 'unicase' ),
                            'id'        => 'topbar-right_dropdown_animation',
                            'type'      => 'select',
                            'options'   => $entrance_animations,
                            'default'   => 'fadeInUp',
                        ),

                        array(
                            'title'     => esc_html__( 'Show Dropdown Indicator', 'unicase' ),
                            'id'        => 'topbar-right_show_dropdown_indicator',
                            'type'      => 'switch',
                            'on'        => esc_html__( 'Yes', 'unicase' ),
                            'off'       => esc_html__( 'No', 'unicase' ),
                            'default'   => 1
                        ),

                        array(
                            'id'        => 'topbar-right-navigation-end',
                            'type'      => 'section',
                            'indent'    => FALSE,
                        ),

                        array(
                            'id'        => 'custom-menu-widget-navigation-start',
                            'type'      => 'section',
                            'title'     => esc_html__( 'Custom Menu Widget Navigation', 'unicase' ),
                            'subtitle'  => esc_html__( 'Options for custom menu widget navigation of the theme', 'unicase' ),
                            'indent'    => FALSE
                        ),

                        array(
                            'title'     => esc_html__( 'Dropdown Trigger', 'unicase' ),
                            'id'        => 'custom-menu-widget_dropdown_trigger',
                            'type'      => 'select',
                            'options'   => array(
                                'click'     => esc_html__( 'Click', 'unicase' ),
                                'hover'     => esc_html__( 'Hover', 'unicase' ),
                            ),
                            'default'   => 'click',
                        ),

                        array(
                            'title'     => esc_html__( 'Dropdown Animation', 'unicase' ),
                            'id'        => 'custom-menu-widget_dropdown_animation',
                            'type'      => 'select',
                            'options'   => $entrance_animations,
                            'default'   => 'fadeInUp',
                        ),

                        array(
                            'title'     => esc_html__( 'Show Dropdown Indicator', 'unicase' ),
                            'id'        => 'custom-menu-widget_show_dropdown_indicator',
                            'type'      => 'switch',
                            'on'        => esc_html__( 'Yes', 'unicase' ),
                            'off'       => esc_html__( 'No', 'unicase' ),
                            'default'   => 1
                        ),

                        array(
                            'id'        => 'custom-menu-widget-navigation-end',
                            'type'      => 'section',
                            'indent'    => FALSE,
                        ),
                    )
                ),
				
				array(
                    'title'     => esc_html__('Shop', 'unicase'),
                    'icon'      => 'fa fa-shopping-cart',
                    'fields'    => array(
                        
                        array(
                            'id'                => 'shop-general-info-start',
                            'type'              => 'section',
                            'title'             => esc_html__( 'General', 'unicase' ),
                            'subtitle'          => esc_html__( 'General Shop Settings', 'unicase' ),
                            'indent'            => TRUE,
                        ),

                        array(
                            'title'             => esc_html__('Catalog Mode', 'unicase'),
                            'subtitle'          => esc_html__('Enable / Disable the Catalog Mode.', 'unicase'),
                            'desc'              => esc_html__('When enabled, the feature Turns Off the shopping functionality of WooCommerce. However you will have to delete the Cart and Checkout pages manually.', 'unicase'),
                            'id'                => 'catalog_mode',
                            'on'                => esc_html__('Enabled', 'unicase'),
                            'off'               => esc_html__('Disabled', 'unicase'),
                            'type'              => 'switch',
                            'default'           => '0',
                        ),

                        array(
                            'title'             => esc_html__( 'Brand Attribute', 'unicase' ),
                            'subtitle'          => esc_html__( 'Choose a product attribute that will be used as brands', 'unicase' ),
                            'desc'              => esc_html__( 'Once you choose a brand attribute, you will be able to add brand images to the attributes', 'unicase' ),
                            'id'                => 'product_brand_taxonomy',
                            'type'              => 'select',
                            'options'           => redux_get_product_attr_taxonomies()
                        ),

                        array(
                            'title'             => esc_html__('Brand Carousel', 'unicase' ),
                            'subtitle'          => esc_html__( 'Enable for display brands carousel on before footer', 'unicase' ),
                            'id'                => 'enable_product_brands_carousel',
                            'type'              => 'switch',
                            'on'                => esc_html__( 'Enabled', 'unicase' ),
                            'off'               => esc_html__( 'Disabled', 'unicase' ),
                            'default'           => 1
                        ),

                        array(
                            'title'             => esc_html__( 'Product Comparison Page', 'unicase' ),
                            'id'                => 'product_comparison_page',
                            'type'              => 'select',
                            'data'              => 'pages',
                        ),

                        array(
                            'id'                => 'shop-general-info-end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),

                        array(
                            'id'                => 'product-archive-start',
                            'type'              => 'section',
                            'title'             => esc_html__( 'Shop/Catalog Pages', 'unicase' ),
                            'subtitle'          => esc_html__( 'Settings related to product archive page and loop', 'unicase' ),
                            'indent'            => TRUE,
                        ),

                        array(
                            'id'                => 'shop_page_layout',
                            'title'             => esc_html__( 'Shop/Catalog Pages Layout', 'unicase' ),
                            'type'              => 'select',
                            'options'           => array(
                                'full-width'    => esc_html__( 'Full Width', 'unicase' ),
                                'left-sidebar'  => esc_html__( 'Left Sidebar', 'unicase' ),
                                'right-sidebar' => esc_html__( 'Right Sidebar', 'unicase' ),
                            ),
                            'default'           => 'left-sidebar'
                        ),

                        array(
                            'id'                => 'shop_jumbotron',
                            'title'             => esc_html__( 'Shop Page Jumbotron', 'unicase' ),
                            'subtitle'          => esc_html__( 'Choose a static block that will be the jumbotron element for shop page', 'unicase' ),
                            'type'              => 'select',
                            'data'              => 'posts',
                            'args'              => array(
                                'post_type'     => 'static_block',
                            )
                        ),

                        array(
                            'id'                => 'product_columns',
                            'type'              => 'slider',
                            'title'             => esc_html__( 'No of Product Columns', 'unicase' ),
                            'subtitle'          => esc_html__('Drag the slider to set the number of columns for displaying products in shop and catalog pages.', 'unicase'),
                            'min'               => '1',
                            'max'               => '6',
                            'step'              => '1',
                            'default'           => '3',
                            'display_value'     => 'label',
                        ),

                        array(
                            'title'             => esc_html__('Default View', 'unicase'),
                            'subtitle'          => esc_html__('Choose a default view between grid and list views.', 'unicase'),
                            'id'                => 'shop_default_view',
                            'type'              => 'select',
                            'options'           => array(
                                'grid'          => esc_html__( 'Grid View', 'unicase' ),
                                'list'          => esc_html__( 'List View', 'unicase' ),
                            ),
                            'default'           => 'grid',
                        ),

                        array(
                            'title'             => esc_html__('Remember User View ?', 'unicase' ),
                            'subtitle'          => esc_html__( 'When user switches a view, should we maintain the view in all pages ?', 'unicase' ),
                            'id'                => 'remember_user_view',
                            'type'              => 'switch',
                            'on'                => esc_html__( 'Yes', 'unicase' ),
                            'off'               => esc_html__( 'No', 'unicase' ),
                            'default'           => 0
                        ),

                        array(
                            'title'             => esc_html__('Number of Products per Page', 'unicase'),
                            'subtitle'          => esc_html__('Drag the slider to set the number of products per page <br />to be listed on the shop page and catalog pages.', 'unicase'),
                            'id'                => 'products_per_page',
                            'min'               => '3',
                            'step'              => '1',
                            'max'               => '48',
                            'type'              => 'slider',
                            'default'           => '15',
                            'display_value'     => 'label'
                        ),
                        
                        array(
                            'id'                => 'product-archive-end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),

                        array(
                            'id'                => 'product-item-start',
                            'type'              => 'section',
                            'indent'            => TRUE,
                            'title'             => esc_html__( 'Product Item Settings', 'unicase' ),
                            'subtitle'          => esc_html__( 'All options related to product items appearing in the loop', 'unicase' ),
                        ),

                        array(
                            'title'             => esc_html__( 'Product Item Animation', 'unicase' ),
                            'id'                => 'product_item_animation',
                            'type'              => 'select',
                            'options'           => $entrance_animations,
                            'default'           => 'fadeInUp',
                        ),

                        array(
                            'title'             => esc_html__( 'Should Delay Animation', 'unicase' ),
                            'id'                => 'should_product_animation_delay',
                            'type'              => 'switch',
                            'on'                => esc_html__( 'Yes', 'unicase' ),
                            'off'               => esc_html__( 'No', 'unicase' ),
                            'default'           => TRUE,
                        ),

                        array(
                            'title'             => esc_html__( 'Thumbnail Lazy loading', 'unicase' ),
                            'id'                => 'enable_lazy_loading',
                            'on'                => esc_html__( 'Enabled', 'unicase' ),
                            'off'               => esc_html__( 'Disabled', 'unicase' ),
                            'type'              => 'switch',
                            'default'           => TRUE,
                        ),

                        array(
                            'title'             => esc_html__( 'Quick View', 'unicase' ),
                            'id'                => 'enable_quick_view',
                            'on'                => esc_html__( 'Enabled', 'unicase' ),
                            'off'               => esc_html__( 'Disabled', 'unicase' ),
                            'type'              => 'switch',
                            'default'           => TRUE,
                        ),

                        array(
                            'id'                => 'product-item-end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),

                        array(
                            'id'                => 'single-product-start',
                            'title'             => esc_html__( 'Single Product Page', 'unicase' ),
                            'subtitle'          => esc_html__( 'Settings for Single Product Page', 'unicase' ),
                            'indent'            => TRUE,
                            'type'              => 'section',
                        ),

                        array(
                            'id'                => 'shop_single_product_style',
                            'title'             => esc_html__( 'Single Product Item Style', 'unicase' ),
                            'type'              => 'select',
                            'options'           => array(
                                'style-1'       => esc_html__( 'Style 1', 'unicase' ),
                                'style-2'       => esc_html__( 'Style 2', 'unicase' ),
                            ),
                            'default'           => 'style-1'
                        ),

                        array(
                            'id'                => 'enable_single_product_share',
                            'title'             => esc_html__( 'Share Block', 'unicase' ),
                            'type'              => 'switch',
                            'on'                => esc_html__( 'Enabled', 'unicase' ),
                            'off'               => esc_html__( 'Disabled', 'unicase' ),
                            'default'           => TRUE
                        ),

                        array(
                            'id'                => 'single-product-end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                    ),
                ),

				array(
                    'title'     => esc_html__('Blog', 'unicase'),
                    'icon'      => 'fa fa-list-alt',
                    'fields'    => array(
                        
                        array(
                            'title'     => esc_html__('Blog Page Layout', 'unicase'),
                            'subtitle'  => __('Select the layout for the Blog Listing. <br />The second option will enable the Blog Listing Sidebar.', 'unicase'),
                            'id'        => 'blog_layout',
                            'type'      => 'select',
                            'options'   => array(
                                'full-width'  	      => esc_html__( 'Full Width', 'unicase' ),
                                'left-sidebar'        => esc_html__( 'Left Sidebar', 'unicase' ),
                                'right-sidebar'       => esc_html__( 'Right Sidebar', 'unicase' ),
                            ),
                            'default'   => 'right-sidebar',
                        ),

                        array(
                            'title'     => esc_html__( 'Force Excerpt', 'unicase' ),
                            'subtitle'  => esc_html__( 'Show only excerpt instead of blog content in archive pages', 'unicase' ),
                            'id'        => 'force_excerpt',
                            'on'        => esc_html__('Yes', 'unicase'),
                            'off'       => esc_html__('No', 'unicase'),
                            'type'      => 'switch',
                            'default'   => TRUE,       
                        ),
                        
                        array(
                            'title'     => esc_html__( 'Enable Placeholder Image', 'unicase' ),
                            'id'        => 'post_placeholder_img',
                            'on'        => esc_html__('Yes', 'unicase'),
                            'off'       => esc_html__('No', 'unicase'),
                            'type'      => 'switch',
                            'default'   => TRUE,       
                        ),

                        array(
                            'id'        => 'post_item_animation',
                            'title'     => esc_html__( 'Post Item Animation', 'unicase' ),
                            'type'      => 'select',
                            'options'   => $entrance_animations,
                            'default'   => 'fadeInUp',
                        ),

                        array(
                            'id'        => 'enable_post_item_share',
                            'title'     => esc_html__( 'Single Post Share Block', 'unicase' ),
                            'type'      => 'switch',
                            'on'        => esc_html__( 'Enabled', 'unicase' ),
                            'off'       => esc_html__( 'Disabled', 'unicase' ),
                            'default'   => TRUE,
                        ),
                    ),
                ),

                array(
                    'title' => esc_html__('Styling', 'unicase'),
                    'icon'  => 'fa fa-pencil-square-o',
                    'fields' => array(
                        array(
                            'id'                => 'styling_general_info_start',
                            'type'              => 'section',
                            'title'             => esc_html__( 'General', 'unicase' ),
                            'subtitle'          => esc_html__( 'General Theme Style Settings', 'unicase' ),
                            'indent'            => TRUE,
                        ),

                        array(
                            'id'                => 'unicase_display_style',
                            'title'             => esc_html__( 'Style', 'unicase' ),
                            'type'              => 'select',
                            'options'           => array(
                                'unicase-style-1'       => esc_html__( 'Style 1', 'unicase' ),
                                'unicase-style-2'       => esc_html__( 'Style 2', 'unicase' ),
                            ),
                            'default'           => 'unicase-style-1'
                        ),
                        
                        array(
                            'title'     => esc_html__( 'Use a predefined color scheme', 'unicase' ),
                            'on'        => esc_html__('Yes', 'unicase'),
                            'off'       => esc_html__('No', 'unicase'),
                            'type'      => 'switch',
                            'default'   => 1,
                            'id'        => 'use_predefined_color'
                        ),

                        array(
                            'title'     => esc_html__('Main Theme Color', 'unicase'),
                            'subtitle'  => esc_html__('The main color of the site.', 'unicase'),
                            'id'        => 'main_color',
                            'type'      => 'select',
                            'options'   => array(
                                'green'      => esc_html__( 'Green', 'unicase' ) ,
                                'blue'       => esc_html__( 'Blue', 'unicase' ) ,
                                'red'        => esc_html__( 'Red', 'unicase' ) ,
                                'orange'     => esc_html__( 'Orange', 'unicase' ) ,
                                'dark-green' => esc_html__( 'Dark Green', 'unicase' ) ,
                                'light-green' => esc_html__( 'Light Green', 'unicase' ) ,
                            ),
                            'default'   => 'green',
                            'required'  => array( 'use_predefined_color', 'equals', 1 ),
                        ),

                        array(
                            'id'        => 'main_custom_color',
                            'icon'      => true,
                            'type'      => 'info',
                            'raw'       => '<h3>'. esc_html__( 'Using a Custom theme Color', 'unicase' ). '</h3>' .
                                           '<p>' . esc_html__( 'Using a custom color is simple but it requires a few extra steps.', 'unicase' ) . '</p>' .
                                           '<p>' . esc_html__( 'Method 1 (Recommended) : Using SASS', 'unicase' ) . '</p>' .
                                           '<ol>' .
                                           '<li>'. esc_html__( 'Navigate to assets/sass/_color.scss file.', 'unicase' ) . '</li>'.
                                           '<li>'. esc_html__( 'On line 4, add $primary-color: to the color of your choice.', 'unicase' ) . '</li>'.
                                           '<li>'. esc_html__( 'Compile assets/sass/_color.scss file to assets/css/custom-color.css', 'unicase' ) . '</li>'.
                                           '<li>'. esc_html__( 'You can also use online sass compiler (http://sassmeister.com/) to compile the SCSS file and copy the output to assets/css/custom-color.css', 'unicase' ) . '</li>'.
                                           '</ol>'.
                                           '<p>' . esc_html__( 'Method 2 : Using CSS and Find and Replace', 'unicase' ) . '</p>' .
                                           '<ol>' .
                                           '<li>'. esc_html__( 'Navigate to assets/css/custom-color.css file.', 'unicase' ) . '</li>'.
                                           '<li>'. esc_html__( 'Do a find and replace of yellow color which is #ffb400 with your choice of color.', 'unicase' ) . '</li>'.
                                           '<li>'. esc_html__( 'We have also used darken and lighten version of the primary color. Replace them as well.', 'unicase' ) . '</li>'.
                                           '</ol>'.
                                           '</ol>',
                            'required'  => array( 'use_predefined_color', 'equals', 0 )
                        ),

                        array(
                            'id'                => 'styling_general_info_end',
                            'type'              => 'section',
                            'indent'            => FALSE,
                        ),
                    ),
                ),

				array(
                    'title' => esc_html__('Typography', 'unicase'),
                    'icon'  => 'fa fa-font',
                    'fields' => array(
                        array(
                            'title'         => esc_html__( 'Use default font scheme ?', 'unicase' ),
                            'on'            => esc_html__('Yes', 'unicase'),
                            'off'           => esc_html__('No', 'unicase'),
                            'type'          => 'switch',
                            'default'       => TRUE,
                            'id'            => 'use_predefined_font',
                        ),

                        array(
                            'title'         => esc_html__( 'Title Font Family', 'unicase' ),
                            'type'          => 'typography',
                            'id'            => 'unicase_title_font',
                            'text-align'    => FALSE,
                            'font-style'    => FALSE,
                            'font-size'     => FALSE,
                            'line-height'   => FALSE,
                            'color'         => FALSE,
                            'default'       => array(
                                'font-family'   => 'Oswald',
                                'subsets'       => 'latin',
                                'style'         => '300',
                            ),
                            'required'      => array( 'use_predefined_font', 'equals', FALSE ),
                        ),

                        array(
                            'title'         => esc_html__( 'Content Font Family', 'unicase' ),
                            'type'          => 'typography',
                            'id'            => 'unicase_content_font',
                            'text-align'    => FALSE,
                            'font-style'    => FALSE,
                            'font-size'     => FALSE,
                            'line-height'   => FALSE,
                            'color'         => FALSE,
                            'font-weight'   => FALSE,
                            'default'       => array(
                                'font-family'   => 'Open Sans',
                                'subsets'       => 'latin',
                            ),
                            'required'      => array( 'use_predefined_font', 'equals', FALSE ),
                        ),
                    ),
                ),

				array(
                    'title'     => esc_html__('Social Media', 'unicase'),
                    'icon'      => 'fa fa-share-square-o',
                    'desc'      => esc_html__('Please type in your complete social network URL', 'unicase' ),
                    'fields'    => array(
                        array(
                            'title'     => esc_html__('Facebook', 'unicase'),
                            'id'        => 'facebook',
                            'type'      => 'text',
                            'icon'      => 'fa fa-facebook',
                        ),
                        
                        array(
                            'title'     => esc_html__('Twitter', 'unicase'),
                            'id'        => 'twitter',
                            'type'      => 'text',
                            'icon'      => 'fa fa-twitter',
                        ),

                        array(
                            'title'     => esc_html__('Google+', 'unicase'),
                            'id'        => 'google-plus',
                            'type'      => 'text',
                            'icon'      => 'fa fa-google-plus',
                        ),
                        
                        array(
                            'title'     => esc_html__('Pinterest', 'unicase'),
                            'id'        => 'pinterest',
                            'type'      => 'text',
                            'icon'      => 'fa fa-pinterest',
                        ),
                        
                        array(
                            'title'     => esc_html__('LinkedIn', 'unicase'),
                            'id'        => 'linkedin',
                            'type'      => 'text',
                            'icon'      => 'fa fa-linkedin',
                        ),

                        array(
                            'title'     => esc_html__('Tumblr', 'unicase'),
                            'id'        => 'tumblr',
                            'type'      => 'text',
                            'icon'      => 'fa fa-tumblr',
                        ),

                        array(
                            'title'     => esc_html__('Instagram', 'unicase'),
                            'id'        => 'instagram',
                            'type'      => 'text',
                            'icon'      => 'fa fa-instagram',
                        ),

                        array(
                            'title'     => esc_html__('Youtube', 'unicase'),
                            'id'        => 'youtube',
                            'type'      => 'text',
                            'icon'      => 'fa fa-youtube',
                        ),

                        array(
                            'title'     => esc_html__('Vimeo', 'unicase'),
                            'id'        => 'vimeo',
                            'type'      => 'text',
                            'icon'      => 'fa fa-vimeo-square',
                        ),

                        array(
                            'title'     => esc_html__('Dribbble', 'unicase'),
                            'id'        => 'dribbble',
                            'type'      => 'text',
                            'icon'      => 'fa fa-dribbble',
                        ),

                        array(
                            'title'     => esc_html__('Stumble Upon', 'unicase'),
                            'id'        => 'stumbleupon',
                            'type'      => 'text',
                            'icon'      => 'fa fa-stumpleupon',
                        ),

                        array(
                            'title'     => esc_html__('Sound Cloud', 'unicase'),
                            'id'        => 'soundcloud',
                            'type'      => 'text',
                            'icon'      => 'fa fa-soundcloud',
                        ),

                        array(
                            'title'     => esc_html__('Vine', 'unicase'),
                            'id'        => 'vine',
                            'type'      => 'text',
                            'icon'      => 'fa fa-vine',
                        ),
                    ),
                ),

                array(
                    'title'         => esc_html__('Custom Code', 'unicase'),
                    'icon'          => 'fa fa-code',
                    'fields'        => array(
                        array(
                            'title'         => esc_html__('Custom CSS', 'unicase'),
                            'subtitle'      => esc_html__('Paste your custom CSS code here.', 'unicase'),
                            'id'            => 'custom_css',
                            'type'          => 'ace_editor',
                            'mode'          => 'css',
                        ),
                    ),
                ),
			);

			$theme = wp_get_theme();

			$args = array(
				'opt_name'          => 'unicase_options',
				'display_name'      => $theme->get('Name'),
				'display_version'   => $theme->get('Version'),
				'allow_sub_menu'    => FALSE,
				'menu_title'        => esc_html__( 'Unicase', 'unicase' ),
				'google_api_key'    => 'AIzaSyDDZJO4F0d17RnFoi1F2qtw4wn6Wcaqxao',
				'page_priority'     => 3,
				'page_slug'         => 'theme_options',
				'intro_text'        => '',
				'dev_mode'          => FALSE,
                'customizer'        => TRUE,
				'footer_credit'     => '&nbsp;',
			);

			$ReduxFramework = new ReduxFramework( $sections, $args );
		}
	}

	new Unicase_Options();
}