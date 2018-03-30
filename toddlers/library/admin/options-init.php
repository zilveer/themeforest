<?php

    /**
     * ReduxFramework Barebones Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     *
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     *
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "unf_options";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        'opt_name' => 'unf_options',
        'display_name' => 'Toddlers Options',
        'page_slug' => 'toddlers_options',
        'page_title' => 'Toddlers Options',
        'update_notice' => TRUE,
        'intro_text' => "<p>Thank you for purchasing Toddlers! <a href='http://unfamo.us/documentation/toddlers'>Click here for Documentation</a></p>",
        'footer_text' => '<p>Fun is good - Dr. Seuss</p>',
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'Toddlers Options',
        'allow_sub_menu' => TRUE,
        'page_parent_post_type' => 'your_post_type',
        'customizer' => TRUE,
        'default_mark' => '*',
        'google_api_key' => 'AIzaSyAcOhnbQuyxlkdkDgqxGSkdJWW5OxVyFW0',
        'hints' => array(
            'icon_position' => 'right',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'compiler' => TRUE,
        'page_permissions' => 'manage_options',
        'save_defaults' => TRUE,
        'show_import_export' => TRUE,
        'transient_time' => '3600',
        'network_sites' => TRUE,
        'dev_mode' => FALSE,
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'admin_folder' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'admin_folder' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'admin_folder' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'admin_folder' );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    // Header

			Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-hand-up',
				'title' => __('Header', UNF_THEME_NAME),
				'fields' => array (


					array (
						'id' => 'unf_searchheader',
						'type' => 'switch',
						'title' => __('Search in Header', UNF_THEME_NAME),
						'default' => 1,
					),

					array (
						'id' => 'unf_showtopnav',
						'type' => 'switch',
						'title' => __('Show Top Nav in Header', UNF_THEME_NAME),
						'default' => 1,
					),

					array (
						'id' => 'unf_shopbutton',
						'type' => 'switch',
						'title' => __('Show MiniCart / Cart Button in Header', UNF_THEME_NAME),
						'default' => 1,
					),

					array(
						'id'=>'unf_reg_logo',
						'type' => 'media',
						'url'=> true,
						'title' => __('Regular Sized Header Logo', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Upload your logo', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
					array(
						'id'=>'unf_ret_logo',
						'type' => 'media',
						'url'=> true,
						'title' => __('Retina(x2) Sized Header Logo', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Upload your logo', UNF_THEME_NAME),
						'subtitle' => __('Regular Sized Logo Required First!', UNF_THEME_NAME),
						),
					array(
						'id'=>'unf_mobile_logo',
						'type' => 'media',
						'url'=> true,
						'title' => __('Mobile Logo', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Upload a transparent PNG', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
					 array(
                        'id' => 'unf_logo_top_margin',
                        'type' => 'slider',
                        'title' => __('Top Margin for Logo', UNF_THEME_NAME),
                        'subtitle' => __('Space above the logo', UNF_THEME_NAME),
                        'desc' => __('In Pixels', UNF_THEME_NAME),
                        "default" => "30",
                        "min" => "10",
                        "step" => "1",
                        "max" => "200",
						),

						array(
                        'id' => 'unf_logo_bottom_margin',
                        'type' => 'slider',
                        'title' => __('Bottom Margin for Logo', UNF_THEME_NAME),
                        'subtitle' => __('Space below the logo', UNF_THEME_NAME),
                        'desc' => __('In Pixels', UNF_THEME_NAME),
                        "default" => "60",
                        "min" => "15",
                        "step" => "1",
                        "max" => "200",
						),


					array(
						'id'=>'unf_favicon',
						'type' => 'media',
						'url'=> true,
						'title' => __('Fav Icon', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Image should be an ICO, PNG or GIF.', UNF_THEME_NAME),
						'subtitle' => __('Upload a Fav icon for your site.', UNF_THEME_NAME),
						'default'  => array(
						        'url'=> get_template_directory_uri() . '/library/img/favicon.png'
						    ),
						),

					array (
						'id' => 'unf_rays_rotate',
						'type' => 'switch',
						'title' => __('Make the rays of light rotate?', UNF_THEME_NAME),
						'subtitle' => __('Only works in Safari and Chrome.', UNF_THEME_NAME),
						'default' => 1,
					),
					array (
						'id' => 'unf_mainmenu_dropdown_hover',
						'type' => 'switch',
						'title' => __('Make Main Menu dropdowns work on hover?', UNF_THEME_NAME),
						'subtitle' => __('Warning: Not the standard Bootstrap UI method.', UNF_THEME_NAME),
						'default' => 0,
					),
					array(
						'id'=>'unf_reg_leftimage',
						'type' => 'media',
						'url'=> true,
						'title' => __('Regular Left Header Image', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Best Max size: 310px wide by 150px high', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
					array(
						'id'=>'unf_ret_leftimage',
						'type' => 'media',
						'url'=> true,
						'title' => __('Retina(x2) Left Header Image', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Best Max size: 620px wide by 300px high', UNF_THEME_NAME),
						'subtitle' => __('Regular Sized Image Required First!', UNF_THEME_NAME),
						),
					array(
						'id'=>'unf_reg_rightimage',
						'type' => 'media',
						'url'=> true,
						'title' => __('Regular Right Header Image', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Best Max size: 310px wide by 150px high', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
					array(
						'id'=>'unf_ret_rightimage',
						'type' => 'media',
						'url'=> true,
						'title' => __('Retina(x2) Right Header Image', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Best Max size: 620px wide by 300px high', UNF_THEME_NAME),
						'subtitle' => __('Regular Sized Image Required First!', UNF_THEME_NAME),
						),
					array(
						'id'=>'unf_reg_grassimage',
						'type' => 'media',
						'url'=> true,
						'title' => __('Regular Header Grass Image', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Best Max size: 982px wide by 81px high', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
					array(
						'id'=>'unf_ret_grassimage',
						'type' => 'media',
						'url'=> true,
						'title' => __('Retina(x2) Header Grass Image', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Best Max size: 1964px wide by 162px high', UNF_THEME_NAME),
						'subtitle' => __('Regular Sized Image Required First!', UNF_THEME_NAME),
						),

				),
			) );



			// FOOTER

			Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-hand-down',
				'title' => __('Footer', UNF_THEME_NAME),
				'fields' => array (

					array(
					    'id'=>'unf_copyrighttext',
					    'type' => 'textarea',
					    'title' => __('Footer Text Left', UNF_THEME_NAME),
					    'subtitle' => __('Leave blank for default copyright, HTML Links Allowed.', UNF_THEME_NAME),
					    'validate' => 'html_custom',
					    'default' => '',
					    'allowed_html' => array(
					        'a' => array(
					            'href' => array(),
					            'title' => array(),
					            'target' => array(),
					        ),
					        'em' => array(),
					        'strong' => array()
					    )
					),

					array (
						'id' => 'unf_showfootnav',
						'type' => 'switch',
						'title' => __('Show Nav in Footer', UNF_THEME_NAME),
						'default' => 1,
					),

					array(
						'id'=>'unf_reg_footerleftimage',
						'type' => 'media',
						'url'=> true,
						'title' => __('Regular Left Footer Image', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Best Max size: 310px wide by 150px high', UNF_THEME_NAME),
						'subtitle' => __('Behind Billboard', UNF_THEME_NAME),
						),
					array(
						'id'=>'unf_ret_footerleftimage',
						'type' => 'media',
						'url'=> true,
						'title' => __('Retina(x2) Left Footer Image', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Best Max size: 620px wide by 300px high', UNF_THEME_NAME),
						'subtitle' => __('Regular Sized Image Required First!', UNF_THEME_NAME),
						),
					array(
						'id'=>'unf_reg_footerrightimage',
						'type' => 'media',
						'url'=> true,
						'title' => __('Regular Right Footer Image', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Best Max size: 310px wide by 150px high', UNF_THEME_NAME),
						'subtitle' => __('With Girl &amp; Rainbow', UNF_THEME_NAME),
						),
					array(
						'id'=>'unf_ret_footerrightimage',
						'type' => 'media',
						'url'=> true,
						'title' => __('Retina(x2) Right Footer Image', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Best Max size: 620px wide by 300px high', UNF_THEME_NAME),
						'subtitle' => __('Regular Sized Image Required First!', UNF_THEME_NAME),
						),


					array(
					    'id'   =>'billboard_divider',
					    'desc' => __('<h3>Billboard Options</h3>', UNF_THEME_NAME),
					    'type' => 'info'
					),
					array (
						'id' => 'unf_hidebillboard',
						'type' => 'switch',
						'title' => __('Hide Billboard?', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						'default' => 0,
					),
					array (
						'id'=>'unf_billboardcontent',
						'type' => 'select',
						'title' => __('Billboard Content', UNF_THEME_NAME),
						'options' => array(
							'1' => 'MailChimp subscription form shortcode',
							'2' => 'HTML',
							),
						'default' => '1'
					),
					array(
					    'id'=>'unf_mcsubscribetitle',
					    'type' => 'text',
					    'title' => __('Subscribe Title', UNF_THEME_NAME),
					    'subtitle' => __('Leave blank to remove title.', UNF_THEME_NAME),
					    'default' => 'Subscribe to Our Newsletter',
					    'required'  => array('unf_billboardcontent', 'equals', array('1')),
					),

					array(
					    'id'               => 'unf_billboardhtml',
					    'type'             => 'editor',
					    'title'            => __('Billboard HTML', UNF_THEME_NAME),
					    'subtitle'         => __('', UNF_THEME_NAME),
					    'default'          => 'Your content here.',
					    'required'  => array('unf_billboardcontent', 'equals', array('2')),
					    'args'   => array(
					        'teeny'            => true,
					        'textarea_rows'    => 5
					    )
					),

				),
			) );

			// Mobile

			Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-phone',
				'title' => __('Mobile', UNF_THEME_NAME),
				'fields' => array (

				array(
					    'id'=>'unf_contactnumber',
					    'type' => 'text',
					    'title' => __('Contact Phone Number', UNF_THEME_NAME),
					    'subtitle' => __('Leave blank to remove button.', UNF_THEME_NAME),
					    'default' => '',
					),
				array(
					    'id'=>'unf_googlemapsaddress',
					    'type' => 'text',
					    'title' => __('Quick Link to Map', UNF_THEME_NAME),
					    'subtitle' => __('Copy / paste Google map URL', UNF_THEME_NAME),
					    'default' => '',
					    'validate' => 'url',
					),
					array (
						'id' => 'unf_raylightmobile',
						'type' => 'switch',
						'title' => __('Show Rays of light on Mobile?', UNF_THEME_NAME),
						'desc' => __('', UNF_THEME_NAME),
						'default' => 1,
					),

				),
			) );
			//
			Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-font',
				'title' => __('Font Settings', UNF_THEME_NAME),
				'desc' => __('Google "Beautiful Web Type" for some fantastic combinations of Google Web Fonts.', UNF_THEME_NAME),
				'fields' => array (

					array(
					    'id'          => 'unf_default_font',
					    'type'        => 'typography',
					    'title'       => __('Content', UNF_THEME_NAME),
					    'google'      => true,
					    'font-backup' => true,
					    'font-weight' => false,
					    'font-style'  => false,
					    'font-size'   => false,
					    'line-height' => false,
					    'color'       => false,
					    'text-align'  => false,
					    'all_styles'  => true,
					    'output'      => array('body,.unf-recent-posts .recent-post-title,blockquote p em,.woocommerce-page .woocommerce-message a.button'),
					    'subtitle'    => __('The default font for everything other than titles.', UNF_THEME_NAME),
					    'default'     => array(
					        'font-family' => 'Lato',)
					    ),
					array(
					    'id'          => 'unf_titles_font',
					    'type'        => 'typography',
					    'title'       => __('Titles / Nav Font', UNF_THEME_NAME),
					    'google'      => true,
					    'font-backup' => true,
					    'font-weight' => true,
					    'all_styles'  => true,
					    'font-style'  => false,
					    'font-size'   => false,
					    'line-height' => false,
					    'color'       => false,
					    'text-align'  => false,
					    'output'      => array('h1,.h1, h2,.h2, h3,.h3, h4,.h4,.main-menu > li > a,.slide_banner_text,.rpost-title,.shopbuttons,blockquote:before,.woocommerce-billing-fields h3, h3#ship-to-different-address label,.gallery-seemore,.wpcf7 input.wpcf7-submit,.tribe-bar-collapse #tribe-bar-collapse-toggle'),
					    'units'       =>'px',
					    'default'     => array(
					        'font-family' => 'Rancho',
					        'font-weight' => '400',
					        )
					    ),

					array(
					    'id'          => 'unf_buttons_font',
					    'type'        => 'typography',
					    'title'       => __('Buttons Font', UNF_THEME_NAME),
					    'google'      => true,
					    'font-backup' => true,
					    'font-weight' => true,
					    'all_styles'  => true,
					    'font-style'  => false,
					    'font-size'   => false,
					    'line-height' => false,
					    'color'       => false,
					    'text-align'  => false,
					    'output'      => array('.btn-primary, #respond #commentform input#submit,.btn-info,.btn-success,.btn-warning,.btn-default,.btn-danger, .woocommerce #content input.button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce-page #content input.button, .woocommerce-page #respond input#submit, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button'),
					    'units'       =>'px',
					    'default'     => array(
					        'font-family' => 'Rancho',
					        'font-weight' => '400',
					        )
					    ),

					array(
					    'id'          => 'unf_blockquote_font',
					    'type'        => 'typography',
					    'title'       => __('Blockquote Font', UNF_THEME_NAME),
					    'google'      => true,
					    'font-backup' => true,
					    'font-weight' => true,
					    'all_styles'  => true,
					    'font-style'  => false,
					    'font-size'   => true,
					    'line-height' => true,
					    'color'       => false,
					    'text-align'  => false,
					    'output'      => array('blockquote p'),
					    'units'       =>'px',
					    'default'     => array(
					        'font-family' => 'Rancho',
					        'font-weight' => '400',
					        'font-size' => '25px',
					        'line-height' => '35px',
					        )
					    ),

					    array(
                        'id' => 'unf_navtextsize_large',
                        'type' => 'slider',
                        'title' => __('Navbar Text Size', UNF_THEME_NAME),
                        'subtitle' => __('For Large Screens', UNF_THEME_NAME),
                        'desc' => __('In Pixels', UNF_THEME_NAME),
                        "default" => "36",
                        "min" => "15",
                        "step" => "1",
                        "max" => "40",
						),
					    array(
                        'id' => 'unf_navtextsize_medium',
                        'type' => 'slider',
                        'title' => __('Navbar Text Size', UNF_THEME_NAME),
                        'subtitle' => __('For Medium Screens', UNF_THEME_NAME),
                        'desc' => __('In Pixels', UNF_THEME_NAME),
                        "default" => "30",
                        "min" => "15",
                        "step" => "1",
                        "max" => "40",
						),
					    array(
                        'id' => 'unf_navtextsize_small',
                        'type' => 'slider',
                        'title' => __('Navbar Text Size', UNF_THEME_NAME),
                        'subtitle' => __('For Small Screens', UNF_THEME_NAME),
                        'desc' => __('In Pixels', UNF_THEME_NAME),
                        "default" => "24",
                        "min" => "15",
                        "step" => "1",
                        "max" => "40",
						),
						array(
                        'id' => 'unf_articletitlesize_large',
                        'type' => 'slider',
                        'title' => __('Page Title Size', UNF_THEME_NAME),
                        'subtitle' => __('For Large Screens', UNF_THEME_NAME),
                        'desc' => __('In Pixels', UNF_THEME_NAME),
                        "default" => "56",
                        "min" => "15",
                        "step" => "1",
                        "max" => "70",
						),
						array(
                        'id' => 'unf_articletitlesize_medium',
                        'type' => 'slider',
                        'title' => __('Page Title Size', UNF_THEME_NAME),
                        'subtitle' => __('For Medium Screens', UNF_THEME_NAME),
                        'desc' => __('In Pixels', UNF_THEME_NAME),
                        "default" => "46",
                        "min" => "15",
                        "step" => "1",
                        "max" => "70",
						),
						array(
                        'id' => 'unf_articletitlesize_small',
                        'type' => 'slider',
                        'title' => __('Page Title Size', UNF_THEME_NAME),
                        'subtitle' => __('For Small Screens', UNF_THEME_NAME),
                        'desc' => __('In Pixels', UNF_THEME_NAME),
                        "default" => "42",
                        "min" => "15",
                        "step" => "1",
                        "max" => "70",
						),
						array(
                        'id' => 'unf_articletitlesize_extrasmall',
                        'type' => 'slider',
                        'title' => __('Page Title Size', UNF_THEME_NAME),
                        'subtitle' => __('For Mobile Screens', UNF_THEME_NAME),
                        'desc' => __('In Pixels', UNF_THEME_NAME),
                        "default" => "32",
                        "min" => "15",
                        "step" => "1",
                        "max" => "70",
						),
				),
			) );

			//Contact Page

			Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-envelope',
				'title' => __('Contact Page', UNF_THEME_NAME),
				'fields' => array (

					array(
                        'id' => 'unf_contactformemail',
                        'type'     => 'text',
                        'title' => __('Contact Form Email', UNF_THEME_NAME),
                        "default" => get_option('admin_email'),
                        'validate' => 'email'
						),
					array(
                        'id' => 'unf_contactsuccess',
                        'type'     => 'text',
                        'title' => __('Form Success Message', UNF_THEME_NAME),
                        "default" => '<strong>Thanks!</strong> Your message was successfully sent.',
						),
					array(
                        'id' => 'unf_contactforgot',
                        'type'     => 'text',
                        'title' => __('Form Forgot Message', UNF_THEME_NAME),
                        "default" => 'You forgot to enter your',
						),
					array(
                        'id' => 'unf_contactinvalid',
                        'type'     => 'text',
                        'title' => __('Form Invalid Message', UNF_THEME_NAME),
                        "default" => 'You entered an invalid',
						),
					array(
                        'id' => 'unf_contact-name-label',
                        'type'     => 'text',
                        'title' => __('Contact Name field label', UNF_THEME_NAME),
                        "default" => "Name",
                        'validate' => 'not_empty'
						),
					array(
                        'id' => 'unf_contact-email-label',
                        'type'     => 'text',
                        'title' => __('Contact Email field label', UNF_THEME_NAME),
                        "default" => "Email",
                        'validate' => 'not_empty'
						),
					array(
                        'id' => 'unf_contact-email-placeholder',
                        'type'     => 'text',
                        'title' => __('Contact Field Email Placeholder', UNF_THEME_NAME),
                        "default" => "your@email.com",
                        'validate' => 'not_empty'
						),
					array(
                        'id' => 'unf_contact-message-label',
                        'type'     => 'text',
                        'title' => __('Contact Message field label', UNF_THEME_NAME),
                        "default" => "Message",
                        'validate' => 'not_empty'
						),
					array(
						'id' => 'unf_contact-send-a-copy',
                        'type'     => 'text',
                        'title' => __('Send a copy to yourself', UNF_THEME_NAME),
                        "default" => "Send a copy of this email to yourself",
                        'validate' => 'not_empty'
						),
					array(
						'id' => 'unf_contact-send-message',
                        'type'     => 'text',
                        'title' => __('Send Message text', UNF_THEME_NAME),
                        "default" => "Send Message",
                        'validate' => 'not_empty'
						),

					array(
                        'id'        => 'unf_switch_sendselfcopy',
                        'type'      => 'switch',
                        'title'     => __('Send Self Copy Option', UNF_THEME_NAME),
                        'on' => __('Show', UNF_THEME_NAME),
                        'off' => __('Hide', UNF_THEME_NAME),
                        'default'  => '1'// 1 = on | 0 = off
					),


					array(
					    'id'=>'unf_contact_addressdetails',
					    'type' => 'textarea',
					    'title' => __('Contact Details - Address Column', UNF_THEME_NAME),
					    'validate' => 'html_custom',
					    'default' => 'Toddlers Day Care,<br/>
3 Hasslehoff Rd,<br/>
Troncity MH 1984',
					    'allowed_html' => array(
					        'a' => array(
					            'href' => array(),
					            'title' => array()
					        ),
					        'br' => array(),
					        'em' => array(),
					        'strong' => array()
					    )
					),

					array(
					    'id'=>'unf_contact_phonedetails',
					    'type' => 'textarea',
					    'title' => __('Contact Details - Phone Column', UNF_THEME_NAME),
					    'validate' => 'html_custom',
					    'default' => '<strong>For Bookings</strong><br/>
Call 1234 5678',
					    'allowed_html' => array(
					        'a' => array(
					            'href' => array(),
					            'title' => array()
					        ),
					        'br' => array(),
					        'em' => array(),
					        'strong' => array()
					    )
					),

					array(
                        'id' => 'unf_map_address',
                        'type'     => 'text',
                        'title' => __('Address for Google Map', UNF_THEME_NAME),
                        "default" => "New York City",
                        'validate' => 'not_empty'
						),

					array(
                        'id' => 'unf_mapzoom',
                        'type' => 'slider',
                        'title' => __('Map Zoom', UNF_THEME_NAME),
                        "default" => "13",
                        "min" => "1",
                        "step" => "1",
                        "max" => "23",
						),

					array(
                        'id'        => 'unf_map_mode',
                        'type'      => 'switch',
                        'title'     => __('Map Mode', UNF_THEME_NAME),
                        'on' => __('Map', UNF_THEME_NAME),
                        'off' => __('Satellite', UNF_THEME_NAME),
                        'default'  => '1'// 1 = on | 0 = off
					),

					array(
					    'id'      => 'unf_contact-blocks',
					    'type'    => 'sorter',
					    'title'   => 'Contact Page Layout',
					    'options' => array(
						        'enabled'  => array(
						        	'pagecontent'   => 'Page Content',
						        	'contactdetails' => 'Contact Details',
						            'googlemap' => 'Google Map',
						            'contactform' => 'Contact Form'
						        ),
						        'disabled' => array(
						        )
							),
						),
					),
			) );



			// DropDown Images

			Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-picture',
				'title' => __('Drop Down Images', UNF_THEME_NAME),
				'desc' => __('Add the class name to the parent item of your menu.',UNF_THEME_NAME),
				'fields' => array (

				array(
					    'id'=>'unf_dropdown_image_1',
					    'type' => 'media',
						'url'=> true,
						'title' => __('.dropdown1', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Before uploading, resize this image to the size you want it.', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
					),
				array(
                        'id' => 'unf_dropdown_image_1_width',
                        'type' => 'slider',
                        'title' => __('Width of .dropdown1 Image', UNF_THEME_NAME),
                        'subtitle' => __('In pixels. For retina support, half the width of your uploaded image.', UNF_THEME_NAME),
                        "default" => "152",
                        "min" => "1",
                        "step" => "1",
                        "max" => "400",
						),
				array(
					    'id'=>'unf_dropdown_image_2',
					    'type' => 'media',
						'url'=> true,
						'title' => __('.dropdown2', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Before uploading, resize this image to the size you want it.', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
				array(
                        'id' => 'unf_dropdown_image_2_width',
                        'type' => 'slider',
                        'title' => __('Width of .dropdown2 Image', UNF_THEME_NAME),
                        'subtitle' => __('In pixels. For retina support, half the width of your uploaded image.', UNF_THEME_NAME),
                        "default" => "152",
                        "min" => "1",
                        "step" => "1",
                        "max" => "400",
						),
				array(
					    'id'=>'unf_dropdown_image_3',
					    'type' => 'media',
						'url'=> true,
						'title' => __('.dropdown3', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Before uploading, resize this image to the size you want it.', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
				array(
                        'id' => 'unf_dropdown_image_3_width',
                        'type' => 'slider',
                        'title' => __('Width of .dropdown3 Image', UNF_THEME_NAME),
                        'subtitle' => __('In pixels. For retina support, half the width of your uploaded image.', UNF_THEME_NAME),
                        "default" => "152",
                        "min" => "1",
                        "step" => "1",
                        "max" => "400",
						),
				array(
					    'id'=>'unf_dropdown_image_4',
					    'type' => 'media',
						'url'=> true,
						'title' => __('.dropdown4', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Before uploading, resize this image to the size you want it.', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
				array(
                        'id' => 'unf_dropdown_image_4_width',
                        'type' => 'slider',
                        'title' => __('Width of .dropdown3 Image', UNF_THEME_NAME),
                        'subtitle' => __('In pixels. For retina support, half the width of your uploaded image.', UNF_THEME_NAME),
                        "default" => "152",
                        "min" => "1",
                        "step" => "1",
                        "max" => "400",
						),
				array(
					    'id'=>'unf_dropdown_image_5',
					    'type' => 'media',
						'url'=> true,
						'title' => __('.dropdown5', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Before uploading, resize this image to the size you want it.', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
				array(
                        'id' => 'unf_dropdown_image_5_width',
                        'type' => 'slider',
                        'title' => __('Width of .dropdown5 Image', UNF_THEME_NAME),
                        'subtitle' => __('In pixels. For retina support, half the width of your uploaded image.', UNF_THEME_NAME),
                        "default" => "152",
                        "min" => "1",
                        "step" => "1",
                        "max" => "400",
						),
				array(
					    'id'=>'unf_dropdown_image_6',
					    'type' => 'media',
						'url'=> true,
						'title' => __('.dropdown6', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Before uploading, resize this image to the size you want it.', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
				array(
                        'id' => 'unf_dropdown_image_6_width',
                        'type' => 'slider',
                        'title' => __('Width of .dropdown6 Image', UNF_THEME_NAME),
                        'subtitle' => __('In pixels. For retina support, half the width of your uploaded image.', UNF_THEME_NAME),
                        "default" => "152",
                        "min" => "1",
                        "step" => "1",
                        "max" => "400",
						),
				array(
					    'id'=>'unf_dropdown_image_7',
					    'type' => 'media',
						'url'=> true,
						'title' => __('.dropdown7', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Before uploading, resize this image to the size you want it.', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
				array(
                        'id' => 'unf_dropdown_image_7_width',
                        'type' => 'slider',
                        'title' => __('Width of .dropdown7 Image', UNF_THEME_NAME),
                        'subtitle' => __('In pixels. For retina support, half the width of your uploaded image.', UNF_THEME_NAME),
                        "default" => "152",
                        "min" => "1",
                        "step" => "1",
                        "max" => "400",
						),
				array(
					    'id'=>'unf_dropdown_image_8',
					    'type' => 'media',
						'url'=> true,
						'title' => __('.dropdown8', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Before uploading, resize this image to the size you want it.', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
				array(
                        'id' => 'unf_dropdown_image_8_width',
                        'type' => 'slider',
                        'title' => __('Width of .dropdown8 Image', UNF_THEME_NAME),
                        'subtitle' => __('In pixels. For retina support, half the width of your uploaded image.', UNF_THEME_NAME),
                        "default" => "152",
                        "min" => "1",
                        "step" => "1",
                        "max" => "400",
						),
				array(
					    'id'=>'unf_dropdown_image_9',
					    'type' => 'media',
						'url'=> true,
						'title' => __('.dropdown9', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Before uploading, resize this image to the size you want it.', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
				array(
                        'id' => 'unf_dropdown_image_9_width',
                        'type' => 'slider',
                        'title' => __('Width of .dropdown9 Image', UNF_THEME_NAME),
                        'subtitle' => __('In pixels. For retina support, half the width of your uploaded image.', UNF_THEME_NAME),
                        "default" => "152",
                        "min" => "1",
                        "step" => "1",
                        "max" => "400",
						),
				array(
					    'id'=>'unf_dropdown_image_10',
					    'type' => 'media',
						'url'=> true,
						'title' => __('.dropdown10', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Before uploading, resize this image to the size you want it.', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
						),
				array(
                        'id' => 'unf_dropdown_image_10_width',
                        'type' => 'slider',
                        'title' => __('Width of .dropdown10 Image', UNF_THEME_NAME),
                        'subtitle' => __('In pixels. For retina support, half the width of your uploaded image.', UNF_THEME_NAME),
                        "default" => "152",
                        "min" => "1",
                        "step" => "1",
                        "max" => "400",
						),


				),
			) );


// Blog
			Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-website',
				'title' => __('Blog Settings', UNF_THEME_NAME),
				'fields' => array (
					array (
						'id' => 'breadcrumb',
						'type' => 'switch',
						'title' => __('Show Breadcrumbs?', UNF_THEME_NAME),
						'desc' => __('Turn breadcrumbs on or off (site-wide)', UNF_THEME_NAME),
						'default' => 1,
					),

					array (
						'id'=>'unf_post_layout',
						'type' => 'image_select',
						'title' => __('Blog Post Layout', UNF_THEME_NAME),
						'options' => array(
							'1'      => array(
					            'alt'   => 'Large Post Layout',
					            'img'   => get_template_directory_uri() .'/library/img/largepostloop.png'
					        ),
					        '2'      => array(
					            'alt'   => 'Compact Post Layout',
					            'img'   => get_template_directory_uri() .'/library/img/compactpostloop.png'
					        )
							),
						'default' => '2'
					),

					array (
						'id' => 'featured',
						'type' => 'switch',
						'title' => __('Show Featured Images on Posts?', UNF_THEME_NAME),
						'default' => 1,
					),

					array (
						'id' => 'unf_showtags',
						'type' => 'switch',
						'title' => __('Show Tags (After Posts)', UNF_THEME_NAME),
						'desc' => '',
						'default' => 1,
					),
					array (
						'id' => 'unf_author_profile',
						'type' => 'switch',
						'title' => __('Author Profiles (After Posts)', UNF_THEME_NAME),
						'desc' => 'Display an author profile after a post',
						'default' => 1,
					),

					array (
						'id' => 'unf_author_info',
						'type' => 'switch',
						'title' => __('Show Author in Blog Loop', UNF_THEME_NAME),
						'desc' => '',
						'default' => 1,
					),

					array (
						'id' => 'unf_blogtitle',
						'type' => 'text',
						'title' => __('Blog Page Title', UNF_THEME_NAME),
						'desc' => 'Leave this blank to disable the blog title.',
						'default' => 'Blog',
					),

					array (
						'id' => 'unf_limitslidesingallery',
						'type' => 'switch',
						'title' => __('Limit Slides in Gallery Posts', UNF_THEME_NAME),
						'desc' => 'On blog page, to help with page load times.',
						'default' => 1,
					),

					array (
						'id' => 'unf_galleryseemore',
						'type' => 'text',
						'title' => __('See the Gallery Text', UNF_THEME_NAME),
						'default' => "See the full Gallery <i class='icon icon-right-circled'></i>",
					),


				),
			) );

			// SHARE BUTTONS

			Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-twitter',
				'title' => __('Post Share Buttons', UNF_THEME_NAME),
				'subsection' => true,
				'fields' => array (

				array (
					'id' => 'unf_sharethis',
					'type' => 'switch',
					'title' => __('Share Buttons (After Posts)', UNF_THEME_NAME),
					'desc' => '',
					'default' => 1,
				),

				array(
				    'id'       => 'unf_sharelinks',
				    'type'     => 'checkbox',
				    'title'    => __('Post Share Links', UNF_THEME_NAME),
				    'subtitle' => __('Tick to enable share links', UNF_THEME_NAME),

				    //Must provide key => value pairs for multi checkbox options
				    'options'  => array(
				        'fb' => 'Facebook',
				        'tw' => 'Twitter',
				        'rd' => 'Reddit',
				        'pn' => 'Pinterest',
				        'dl' => 'Delicious',
				        'dg' => 'Digg',
				        'su' => 'StumbleUpon',
				        'li' => 'LinkedIn',
				        'gb' => 'Google Bookmarks',
				        'ff' => 'FriendFeed',
				        'ms' => 'MySpace',
				        'wl' => 'WindowsLive'
				    ),

				    //See how default has changed? you also don't need to specify opts that are 0.
				    'default' => array(
				        'fb' => '1',
				        'tw' => '1',
				        'pn' => '1',
				        'li' => '1',
				    )
				)


				),
			) );


			// WooCommerce

			Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-shopping-cart',
				'title' => __('WooCommerce', UNF_THEME_NAME),
				'desc' => __('<p class="description">Extra settings for the WooCommerce Plugin</p>', UNF_THEME_NAME),
				'fields' => array (

				array(
                        'id'        => 'unf_shopsiderbar_home',
                        'type'      => 'switch',
                        'title'     => __('Sidebar on Homepage', UNF_THEME_NAME),
                        'on' => __('On', UNF_THEME_NAME),
                        'off' => __('OFF', UNF_THEME_NAME),
                        'default'  => '1'// 1 = on | 0 = off
						),

				array(
                        'id'        => 'unf_shopsiderbar_archive',
                        'type'      => 'switch',
                        'title'     => __('Sidebar on Archive Pages', UNF_THEME_NAME),
                        'on' => __('On', UNF_THEME_NAME),
                        'off' => __('OFF', UNF_THEME_NAME),
                        'default'  => '1'// 1 = on | 0 = off
						),

				array(
                        'id'        => 'unf_shopsiderbar_productpage',
                        'type'      => 'switch',
                        'title'     => __('Sidebar on Product Pages', UNF_THEME_NAME),
                        'on' => __('On', UNF_THEME_NAME),
                        'off' => __('OFF', UNF_THEME_NAME),
                        'default'  => '1'// 1 = on | 0 = off
						),

				array (
						'id' => 'unf_hidereviewstab',
						'type' => 'switch',
						'title' => __('Hide Reviews Tab on Product Page', UNF_THEME_NAME),
						'default' => 0,
					),
				array(
                        'id' => 'unf_woo_products_per_row',
                        'type' => 'slider',
                        'title' => __('Products Per Row', UNF_THEME_NAME),
                        'subtitle' => __('', UNF_THEME_NAME),
                        "default" => "3",
                        "min" => "1",
                        "step" => "1",
                        "max" => "6",
						),
				array(
                        'id' => 'unf_woo_products_per_page',
                        'type' => 'slider',
                        'title' => __('Products Per Page', UNF_THEME_NAME),
                        'desc' => __('If you change the products per row, you may want to change this too.', UNF_THEME_NAME),
                        "default" => "12",
                        "min" => "2",
                        "step" => "1",
                        "max" => "50",
						),

				array(
                        'id'        => 'unf_showshophead',
                        'type'      => 'switch',
                        'title'     => __('Special Header on Shop Homepage', UNF_THEME_NAME),
                        'on' => __('On', UNF_THEME_NAME),
                        'off' => __('Off', UNF_THEME_NAME),
                        'default'  => '1'// 1 = on | 0 = off
						),
				array(
                        'id'        => 'unf_showshopslider',
                        'type'      => 'switch',
                        'required'  => array('unf_showshophead', 'equals', array('1')),
                        'title'     => __('Image Slider in Special Header', UNF_THEME_NAME),
                        'on' => __('On', UNF_THEME_NAME),
                        'off' => __('Off', UNF_THEME_NAME),
                        'default'  => '1'// 1 = on | 0 = off
						),

				array(
                        'id' => 'unf_shophomeslider',
                        'type'     => 'slides',
                        'title' => __('Shop Home Slider', UNF_THEME_NAME),
                        'required'  => array('unf_showshopslider', 'equals', array('1')),
                        'desc'        => __('Image will be automatically resized to 720px x 300px', UNF_THEME_NAME),
						),


				array(
                        'id' => 'unf_shophomesliderdelay',
                        'type'     => 'text',
                        'title' => __('Shop Slider Delay', UNF_THEME_NAME),
                        'required'  => array('unf_showshopslider', 'equals', array('1')),
                        'default' => "7000",
						),
				array(
                        'id' => 'unf_shophomesliderspeed',
                        'type'     => 'text',
                        'title' => __('Shop Slider Speed', UNF_THEME_NAME),
                        'required'  => array('unf_showshopslider', 'equals', array('1')),
                        'default' => "300",
						),

				array(
                        'id' => 'unf_shoplink1',
                        'type'     => 'text',
                        'title' => __('Shop Link One Text', UNF_THEME_NAME),
                        'required'  => array('unf_showshophead', 'equals', array('1')),
                        'default' => "<i class='icon icon-right-circle'></i> On Sale",
						),
				array(
                        'id' => 'unf_shoplink1url',
                        'type'     => 'text',
                        'title' => __('Shop Link One URL', UNF_THEME_NAME),
                        'required'  => array('unf_showshophead', 'equals', array('1')),
                        'default' => "#",
						),
				array(
                        'id' => 'unf_shoplink2',
                        'type'     => 'text',
                        'title' => __('Shop Link Two Text', UNF_THEME_NAME),
                        'required'  => array('unf_showshophead', 'equals', array('1')),
                        'default' => "<i class='icon icon-right-circle'></i> Most Popular",
						),
				array(
                        'id' => 'unf_shoplink2url',
                        'type'     => 'text',
                        'title' => __('Shop Link Two URL', UNF_THEME_NAME),
                        'required'  => array('unf_showshophead', 'equals', array('1')),
                        'default' => "#",
						),
				array(
                        'id' => 'unf_shoplink3',
                        'type'     => 'text',
                        'title' => __('Shop Link Three Text', UNF_THEME_NAME),
                        'required'  => array('unf_showshophead', 'equals', array('1')),
                        'default' => "<i class='icon icon-right-circle'></i> New Products",
						),
				array(
                        'id' => 'unf_shoplink3url',
                        'type'     => 'text',
                        'title' => __('Shop Link Three URL', UNF_THEME_NAME),
                        'required'  => array('unf_showshophead', 'equals', array('1')),
                        'default' => "#",
						),
				array(
                        'id' => 'unf_shophometitle',
                        'type'     => 'text',
                        'title' => __('Shop Homepage Heading', UNF_THEME_NAME),
                        'default' => "The Store",
						),

				array(
					    'id' => 'unf_shophomepagecontent',
					    'type' => 'editor',
					    'title' => __('Shop Homepage Content', UNF_THEME_NAME),
					    'default' => '',
						),


				),
			) );


			// EVENTS

			Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-calendar',
				'title' => __('Events', UNF_THEME_NAME),
				'desc' => __('', UNF_THEME_NAME),
				'fields' => array (

			array(
					    'id'=>'unf_eventshomepageimage',
					    'type' => 'media',
						'url'=> true,
						'title' => __('Events Homepage Image', UNF_THEME_NAME),
						'compiler' => 'true',
						'desc'=> __('Before uploading, resize your image to 630px wide or 1260px wide for HD support.', UNF_THEME_NAME),
						'subtitle' => __('', UNF_THEME_NAME),
					),

				),
			) );



            // SOCIAL LINKS

            Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-facebook',
				'title' => __('Social Links', UNF_THEME_NAME),
				'fields' => array (

					array (
						'id' => 'unf_socialheader',
						'type' => 'switch',
						'title' => __('Social Icons in Header', UNF_THEME_NAME),
						'default' => 0,
					),

					array(
                        'id' => 'unf-facebook-link',
                        'type' => 'text',
                        'title' => __('Facebook Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-gplus-link',
                        'type' => 'text',
                        'title' => __('Google Plus Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-twitter-link',
                        'type' => 'text',
                        'title' => __('Twitter Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-linkedin-link',
                        'type' => 'text',
                        'title' => __('LinkedIn Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-dribbble-link',
                        'type' => 'text',
                        'title' => __('Dribbble Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-youtube-link',
                        'type' => 'text',
                        'title' => __('Youtube Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-vimeo-link',
                        'type' => 'text',
                        'title' => __('Vimeo Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-instagram-link',
                        'type' => 'text',
                        'title' => __('Instagram Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-flickr-link',
                        'type' => 'text',
                        'title' => __('Flickr Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-github-link',
                        'type' => 'text',
                        'title' => __('Github URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-wordpress-link',
                        'type' => 'text',
                        'title' => __('WordPress.com URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-behance-link',
                        'type' => 'text',
                        'title' => __('Behance Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-tumblr-link',
                        'type' => 'text',
                        'title' => __('Tumblr Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-stumbleupon-link',
                        'type' => 'text',
                        'title' => __('StumbleUpon Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-blogger-link',
                        'type' => 'text',
                        'title' => __('Blogger URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-lastfm-link',
                        'type' => 'text',
                        'title' => __('Lastfm Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-pinterest-link',
                        'type' => 'text',
                        'title' => __('Pinterest Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-skype-link',
                        'type' => 'text',
                        'title' => __('Skype Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-dropbox-link',
                        'type' => 'text',
                        'title' => __('Dropbox URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-deviantart-link',
                        'type' => 'text',
                        'title' => __('deviantART Profile URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
					array(
                        'id' => 'unf-rss-link',
                        'type' => 'text',
                        'title' => __('RSS URL', UNF_THEME_NAME),
                        'subtitle' => __('Remember to include http:// or https:// at the start of your url.', UNF_THEME_NAME),
                        'desc' => __('', UNF_THEME_NAME),
                        'required'  => array('unf_socialheader', 'equals', array('1')),
                        'validate' => 'url',
						),
				),
			) );


			Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-time',
				'title' => __('Open Times', UNF_THEME_NAME),
				'desc' => __('You can use this for your tour times also.', UNF_THEME_NAME),
				'fields' => array (
					array(
                        'id'        => 'unf_showrow1',
                        'type'      => 'switch',
                        'title'     => __('Show Row 1', UNF_THEME_NAME),
                        'on' => __('Yes', UNF_THEME_NAME),
                        'off' => __('No', UNF_THEME_NAME),
                        'default'  => '1'// 1 = on | 0 = off
						),
					array(
					    'id'          => 'unf_ot_row1title',
					    'type'        => 'text',
					    'required'  => array('unf_showrow1', 'equals', array('1')),
					    'title'       => __('Day 1 Title', UNF_THEME_NAME),
					    'default'     => 'Moday to Friday',
					    ),
					array(
					    'id'          => 'unf_ot_row1times',
					    'type'        => 'text',
					    'required'  => array('unf_showrow1', 'equals', array('1')),
					    'title'       => __('Day 1 Times', UNF_THEME_NAME),
					    'default'     => '<strong>9:00am</strong> to <strong>5:00pm</strong>',
					    ),
					array(
                        'id'        => 'unf_showrow2',
                        'type'      => 'switch',
                        'title'     => __('Show Row 2', UNF_THEME_NAME),
                        'on' => __('Yes', UNF_THEME_NAME),
                        'off' => __('No', UNF_THEME_NAME),
                        'default'  => '0'// 1 = on | 0 = off
						),
					array(
					    'id'          => 'unf_ot_row2title',
					    'type'        => 'text',
					    'required'  => array('unf_showrow2', 'equals', array('1')),
					    'title'       => __('Day 2 Title', UNF_THEME_NAME),
					    'default'     => 'Saturday',
					    ),
					array(
					    'id'          => 'unf_ot_row2times',
					    'type'        => 'text',
					    'required'  => array('unf_showrow2', 'equals', array('1')),
					    'title'       => __('Day 2 Times', UNF_THEME_NAME),
					    'default'     => '<strong>9:00am</strong> to <strong>5:00pm</strong>',
					    ),
					array(
                        'id'        => 'unf_showrow3',
                        'type'      => 'switch',
                        'title'     => __('Show Row 3', UNF_THEME_NAME),
                        'on' => __('Yes', UNF_THEME_NAME),
                        'off' => __('No', UNF_THEME_NAME),
                        'default'  => '0'// 1 = on | 0 = off
						),
					array(
					    'id'          => 'unf_ot_row3title',
					    'type'        => 'text',
					    'required'  => array('unf_showrow3', 'equals', array('1')),
					    'title'       => __('Day 3 Title', UNF_THEME_NAME),
					    'default'     => 'Sunday',
					    ),
					array(
					    'id'          => 'unf_ot_row3times',
					    'type'        => 'text',
					    'required'  => array('unf_showrow3', 'equals', array('1')),
					    'title'       => __('Day 3 Times', UNF_THEME_NAME),
					    'default'     => '<strong>9:00am</strong> to <strong>5:00pm</strong>',
					    ),
					array(
                        'id'        => 'unf_showrow4',
                        'type'      => 'switch',
                        'title'     => __('Show Row 4', UNF_THEME_NAME),
                        'on' => __('Yes', UNF_THEME_NAME),
                        'off' => __('No', UNF_THEME_NAME),
                        'default'  => '0'// 1 = on | 0 = off
						),
					array(
					    'id'          => 'unf_ot_row4title',
					    'type'        => 'text',
					    'required'  => array('unf_showrow4', 'equals', array('1')),
					    'title'       => __('Day 4 Title', UNF_THEME_NAME),
					    'default'     => 'Public Holidays',
					    ),
					array(
					    'id'          => 'unf_ot_row4times',
					    'type'        => 'text',
					    'required'  => array('unf_showrow4', 'equals', array('1')),
					    'title'       => __('Day 4 Times', UNF_THEME_NAME),
					    'default'     => '<strong>9:00am</strong> to <strong>5:00pm</strong>',
					    ),
					array(
                        'id'        => 'unf_showrow5',
                        'type'      => 'switch',
                        'title'     => __('Show Row 5', UNF_THEME_NAME),
                        'on' => __('Yes', UNF_THEME_NAME),
                        'off' => __('No', UNF_THEME_NAME),
                        'default'  => '0'// 1 = on | 0 = off
						),
					array(
					    'id'          => 'unf_ot_row5title',
					    'type'        => 'text',
					    'required'  => array('unf_showrow5', 'equals', array('1')),
					    'title'       => __('Day 5 Title', UNF_THEME_NAME),
					    'default'     => 'Weekdays',
					    ),
					array(
					    'id'          => 'unf_ot_row5times',
					    'type'        => 'text',
					    'required'  => array('unf_showrow5', 'equals', array('1')),
					    'title'       => __('Day 1 Times', UNF_THEME_NAME),
					    'default'     => '<strong>9:00am</strong> to <strong>5:00pm</strong>',
					    ),
					array(
                        'id'        => 'unf_showrow6',
                        'type'      => 'switch',
                        'title'     => __('Show Row 6', UNF_THEME_NAME),
                        'on' => __('Yes', UNF_THEME_NAME),
                        'off' => __('No', UNF_THEME_NAME),
                        'default'  => '0'// 1 = on | 0 = off
						),
					array(
					    'id'          => 'unf_ot_row6title',
					    'type'        => 'text',
					    'required'  => array('unf_showrow6', 'equals', array('1')),
					    'title'       => __('Row 6 Title', UNF_THEME_NAME),
					    'default'     => 'Weekdays',
					    ),
					array(
					    'id'          => 'unf_ot_row6times',
					    'type'        => 'text',
					    'required'  => array('unf_showrow6', 'equals', array('1')),
					    'title'       => __('Row 6 Times', UNF_THEME_NAME),
					    'default'     => '<strong>9:00am</strong> to <strong>5:00pm</strong>',
					    ),
					array(
                        'id'        => 'unf_showrow7',
                        'type'      => 'switch',
                        'title'     => __('Row Row 7', UNF_THEME_NAME),
                        'on' => __('Yes', UNF_THEME_NAME),
                        'off' => __('No', UNF_THEME_NAME),
                        'default'  => '0'// 1 = on | 0 = off
						),
					array(
					    'id'          => 'unf_ot_row7title',
					    'type'        => 'text',
					    'required'  => array('unf_showrow7', 'equals', array('1')),
					    'title'       => __('Row 7 Title', UNF_THEME_NAME),
					    'default'     => 'Weekdays',
					    ),
					array(
					    'id'          => 'unf_ot_row7times',
					    'type'        => 'text',
					    'required'  => array('unf_showrow7', 'equals', array('1')),
					    'title'       => __('Row 7 Times', UNF_THEME_NAME),
					    'default'     => '<strong>9:00am</strong> to <strong>5:00pm</strong>',
					    ),

				),
			) );

			Redux::setSection( $opt_name, array(
				'icon' => 'el-icon-css',
				'title' => __('Custom CSS', UNF_THEME_NAME),
				'fields' => array (

					array(
					    'id'       => 'unf_custom_css',
					    'type'     => 'ace_editor',
					    'title'    => __('Custom CSS', UNF_THEME_NAME),
					    'subtitle' => __('Paste your CSS code here.', UNF_THEME_NAME),
					    'mode'     => 'css',
					    'theme'    => 'monokai',
					    'desc'     => '',
					    'default'  => ""
					)
				),
			) );

            Redux::setSection( $opt_name, array(
                'title'     => __('Import / Export', UNF_THEME_NAME),
                'desc'      => __('Import and Export your settings from file, text or URL.', UNF_THEME_NAME),
                'icon'      => 'el-icon-refresh',
                'fields'    => array(
                    array(
                        'id'            => 'opt-import-export',
                        'type'          => 'import_export',
                        'title'         => 'Import Export',
                        'subtitle'      => 'Save and restore your Redux options',
                        'full_width'    => false,
                    ),
                ),
            ) );

    /*
     * <--- END SECTIONS
     */
