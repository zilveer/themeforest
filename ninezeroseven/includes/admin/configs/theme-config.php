<?php
if (!class_exists('WBC907_Options_Framework')) {

    class WBC907_Options_Framework {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }
            // This is needed. Bah WordPress bugs.  ;)
            if (  true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                $this->initSettings();
                // add_action('init', array($this, 'initSettings'), 10);
            }
        }

        public function initSettings() {

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            // $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }


            add_action('admin_enqueue_scripts', array($this ,'wbc907_admin_scripts'));


            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);

        }

        public function wbc907_admin_scripts(){
            wp_register_style( 'font-awesome', get_template_directory_uri().'/assets/css/font-icons/font-awesome/css/font-awesome.min.css');
            wp_enqueue_style( 'font-awesome');
        }



        public function setSections() {

            /************************************************************************
            * Home Section
            *************************************************************************/

            /**
             * Gets FontAwesome Array
             * $sort   = true   // Sorts the Icons
             * $w_name = true   // Adds named array like array(fa-cogs => Cogs)
             * $no_fa  = true   // Removes 'fa' from 'fa fa-cogs'
             */
            $iconArray = wbc_fontawesome_array( true, true, true );


            /************************************************************************
            * General Settings
            *************************************************************************/
            $this->sections[] = array(
                'title'     => esc_html__('General Settings', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'el-icon-cogs',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    ///BOXED
                    array(
                        'id'        => 'opts-boxed-layout',
                        'type'      => 'switch',
                        'title'     => esc_html__('Boxed Layout', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Enables boxed layout site wide', 'ninezeroseven'),
                        // 'desc'      => esc_html__('This will allow you to update your theme from within the admin area like how default WordPress themes update.', 'ninezeroseven'),
                        'default' => 0,
                        'on'        => esc_html__('Enable', 'ninezeroseven'),
                        'off'       => esc_html__('Disable', 'ninezeroseven'),
                        // 'hint' => array(
                        //     'title' => 'Hint Title',
                        //     'content' => 'This is a <b>hint</b> for the media field with a Title.',
                        // )
                    ),
                    array(
                        'id'       => 'opts-boxed-bg',
                        'type'     => 'background',
                        'title'    => esc_html__('Body Background', 'ninezeroseven'),
                        'output'    => array('body'),
                        'required'  => array('opts-boxed-layout', "=", 1),
                        'subtitle' => esc_html__('Body background with image, color, etc.', 'ninezeroseven'),
                        // 'desc'     => esc_html__('This is the description field, again good for additional info.', 'ninezeroseven'),
                    ),
                    array(
                        'id'        => 'opts-boxed-width',
                        'type'      => 'slider',
                        'required'  => array('opts-boxed-layout', "=", 1),
                        'title'     => esc_html__('Boxed Width', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Changes width of boxed area, default is 1240px', 'ninezeroseven'),
                        "default"   => 1240,
                        "min"       => 500,
                        "step"      => 1,
                        "max"       => 2000,
                        'display_value' => 'text'
                    ),
                    /// END BOXED
                    /// Retina
                    array(
                        'id'        => 'opts-retina-enable',
                        'type'      => 'switch',
                        'title'     => esc_html__('Retina Images', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Enables Retina Images', 'ninezeroseven'),
                        'desc'      => esc_html__('You must upload images you want retina with @2x before the file extension i.e image@2x.jpg. Or use WP Retina 2x Plugin which will generate retina images for you from your uploaded images. If you use WP Retina 2x Plugin, leave this option disabled.', 'ninezeroseven'),
                        'default' => 0,
                        'on'        => esc_html__('Enable', 'ninezeroseven'),
                        'off'       => esc_html__('Disable', 'ninezeroseven'),
                        // 'hint' => array(
                        //     'title' => 'Hint Title',
                        //     'content' => 'This is a <b>hint</b> for the media field with a Title.',
                        // )
                    ),
                    array(
                        'id'          => 'opts-primary-color',
                        'type'        => 'color',
                        'title'       => esc_html__('Primary Color', 'ninezeroseven'),
                        'subtitle'    => esc_html__('Change the main colors(links,buttons,etc)', 'ninezeroseven'),
                        'transparent' => false,
                        'default'     => '',
                        'output'      => apply_filters( 'opts-primary-color', array() )
                    ),
                    array(
                        'id'        => 'opts-page-bg-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Page BG Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the page background color', 'ninezeroseven'),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'background-color' => '.page-wrapper'
                            )
                    ),
                    array(
                        'id'        => 'opts-page-content-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Page Content Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the primary color.(boxes,borders,etc)', 'ninezeroseven'),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => apply_filters('opts-page-content-color', array())
                    ),
                    array(
                        'id'        => 'opts-page-forms-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Form Field BG color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change Form Field background color.(textarea,inputs,etc)', 'ninezeroseven'),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'background-color' => 'input[type="text"], input[type="password"], input[type="email"], input[type="search"], select,textarea',
                            )
                    ),
                    array(
                        'id'        => 'opts-custom-css',
                        'type'      => 'ace_editor',
                        'title'     => esc_html__('CSS Code', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Add your CSS code here.', 'ninezeroseven'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                        'validate' => 'css',
                        'default'   => ""
                    ),
                    array(
                        'id'        => 'opts-custom-js',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Custom JS Code', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Add custom JS code here, which will get added into the footer.', 'ninezeroseven'),
                        'desc'      => '',
                    ),

                    ),
                );



            /************************************************************************
            * Nav Bar Settings
            *************************************************************************/
            
             $this->sections[] = array(
                'title'     => esc_html__('Header', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'fa fa-sliders',
                //'subsection' => true,
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'        => 'logo-enabled',
                        'type'      => 'switch',
                        'title'     => esc_html__('Logo Type', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Select logo type you\'d like in nav bar', 'ninezeroseven'),
                        'default' => 0,
                        'on'        => 'Image',
                        'off'       => 'Text',

                    ),
                    array(
                        'id'        => 'opts-nav-text',
                        'type'      => 'text',
                        'title'     => esc_html__('Site Name', 'ninezeroseven'),
                        'subtitle'  => esc_html__('If you\'d like your site name different in nav bar then what you\'ve set on settings page.', 'ninezeroseven'),
                        'validate'  => 'no_html',
                        'required'  => array('logo-enabled', "=", 0),
                        'default'   => get_bloginfo( 'name' )
                    ),
                    array(
                        'id'        => 'opts-nav-logo',
                        'type'      => 'media',
                        'title'     => esc_html__('Main Logo', 'ninezeroseven'),
                        'mode'      => 'image', // Can be set to false to allow any media type, or can also be set to any mime type.
                        //'desc'      => esc_html__('Basic media uploader with disabled URL input field.', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Upload logo', 'ninezeroseven'),
                        'required'  => array('logo-enabled', "=", 1),
                        'default' => '',
                    ),
                    array(
                        'id'        => 'opts-nav-transparent-logo',
                        'type'      => 'media',
                        'title'     => esc_html__('Transparent Logo', 'ninezeroseven'),
                        'mode'      => 'image', // Can be set to false to allow any media type, or can also be set to any mime type.
                        //'desc'      => esc_html__('Basic media uploader with disabled URL input field.', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Upload logo', 'ninezeroseven'),
                        'required'  => array('logo-enabled', "=", 1),
                        'default' => '',
                    ),
                    array(
                        'id'                => 'opts-menu-height',
                        'type'              => 'dimensions',
                        // 'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                        'width' => false,
                        'title'             => esc_html__('Menu Bar Height', 'ninezeroseven'),
                        'subtitle'          => esc_html__('If you\'d like to change the height of the menu bar, enter value here', 'ninezeroseven'),
                        // 'desc'              => esc_html__('You can enable or disable any piece of this field. Width, Height, or Units.', 'ninezeroseven'),

                    ),
                    array(
                        'id'        => 'opts-sticky-menu',
                        'type'      => 'switch',
                        'title'     => esc_html__('Sticky Menu', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Here you can choose to enable/disable the sticky menu(menu follows on scroll)', 'ninezeroseven'),
                        'default' => 0,
                        'on'        => 'Enabled',
                        'off'       => 'Disabled',

                    ),array(
                        'id'       => 'opts-elastic-menu',
                        'type'     => 'switch',
                        'title'    => esc_html__('Elastic Menu', 'ninezeroseven'),
                        'subtitle' => esc_html__('Here you can choose to enable/disable the shrinking menu feature.', 'ninezeroseven'),
                        'default'  => 0,
                        'required' => array('opts-sticky-menu', "=", 1),
                        'on'       => 'Enabled',
                        'off'      => 'Disabled',

                    ),
                    array(
                        'id'                => 'opts-elastic-height',
                        'type'              => 'dimensions',
                        // 'units'             => 'px',    // You can specify a unit value. Possible: px, em, %
                        'width' => false,
                        'title'             => esc_html__('Menu Bar Shrink To', 'ninezeroseven'),
                        'subtitle'          => esc_html__('If you\'d like to change the small menu height, do so here', 'ninezeroseven'),
                        // 'desc'              => esc_html__('You can enable or disable any piece of this field. Width, Height, or Units.', 'ninezeroseven'),
                        'required' => array('opts-elastic-menu', "=", 1),

                    ),

                    /************************************************************************
                    * Top Bar Options
                    *************************************************************************/
                    array(
                        'id'        => 'opts-topbar',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show/Hide Topbar', 'ninezeroseven'),
                        'subtitle'  => esc_html__('You can choose to show/hide the top bar here.', 'ninezeroseven'),
                        'default' => 0,
                        'on'        => 'Enabled',
                        'off'       => 'Disabled',

                    ),array(
                        'id'           => 'opts-topbar-left',
                        'type'         => 'repeater',
                        'title'        => 'Left Topbar Items',
                        'subtitle'     => 'Select a social icon to append a link to.',
                        'group_values' => true,
                        'item_name' => 'Item',
                        'required'  => array('opts-topbar', "=", 1),
                        'fields'    => array(
                            array(
                                'id'       => 'field-icon',
                                'type'     => 'select',
                                'select2'  => array( 'containerCssClass' => ' el' ),
                                'title'    => esc_html__('Icon', 'ninezeroseven'),
                                'subtitle' => esc_html__('Select a icon to appear before.', 'ninezeroseven'),
                                'class'    => ' font-icons ef',
                                'options'  => $iconArray
                            ),
                            array(
                                'id'          => 'field-info',
                                'type'        => 'text',
                                'class'       => ' large-text',
                                'title'       => esc_html__('Text','ninezeroseven'),
                                'subtitle'    => esc_html__('Text you would like displayed.','ninezeroseven'),
                                'default'     => '',
                            )
                        )
                    ),array(
                        'id'           => 'opts-topbar-right',
                        'type'         => 'repeater',
                        'title'        => esc_html__('Right Topbar Social', 'ninezeroseven'),
                        'subtitle'     => esc_html__('Select a social icon to append a link to.', 'ninezeroseven'),
                        'group_values' => true,
                        'item_name' => 'Social Icons',
                        'required'  => array('opts-topbar', "=", 1),
                        'fields'    => array(
                            array(
                                'id'       => 'field-icon',
                                'type'     => 'select',
                                'select2'  => array( 'containerCssClass' => ' el' ),
                                'title'    => esc_html__('Social Icon', 'ninezeroseven'),
                                'subtitle' => esc_html__('Select a social icon to append a link to.', 'ninezeroseven'),
                                'class'    => ' font-icons ef',
                                'options'  => $iconArray
                            ),
                            array(
                                'id'        => 'field-info',
                                'type'      => 'text',
                                'title'     => esc_html__('Link URL', 'ninezeroseven'),
                                'subtitle'  => esc_html__('This must be a valid URL i.e http://www.twitter.com/username', 'ninezeroseven'),
                                'desc'      => esc_html__('This will make the icon linked.', 'ninezeroseven'),
                                'validate'  => 'url',
                                'default'   => '',
                            )
                        )
                    ),
                    array(
                        'id'        => 'opts-enable-topmenu-color',
                        'type'      => 'checkbox',
                        'title'     => esc_html__('Top Bar Coloring', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Check to enable color fields for top bar.', 'ninezeroseven'),
                        'required'  => array('opts-topbar', "=", 1),
                        'default'   => '0'// 1 = on | 0 = off
                    ),
                    array(
                        'id'        => 'opts-topmenu-link-color-border',
                        'type'      => 'color',
                        'title'     => esc_html__('Top Bar Background Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-topmenu-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'background-color' => '.top-extra-bar',
                                'border-color' => '.top-extra-bar'
                            )
                    ),
                    array(
                        'id'          => 'opts-topmenu-color',
                        'type'        => 'color',
                        'title'       => esc_html__('Top Bar Text Color', 'ninezeroseven'),
                        'subtitle'    => esc_html__('Change the text color.', 'ninezeroseven'),
                        'required'    => array('opts-enable-topmenu-color', "=", 1),
                        'transparent' => false,
                        'default'     => '',
                        'output'      => array(
                                'color' => '.top-extra-bar'
                            )
                    ),
                    array(
                        'id'        => 'opts-topmenu-link-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Top Bar Link Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the link color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-topmenu-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.top-extra-bar a,.header-bar .social-links a'
                            )
                    ),
                    array(
                        'id'        => 'opts-topmenu-link-color-hover',
                        'type'      => 'color',
                        'title'     => esc_html__('Top Bar Link Hover Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the link hover color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-topmenu-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.top-extra-bar a:hover,.header-bar .social-links a:hover'
                            )
                    ),

                    /************************************************************************
                    * Main Nav Colors
                    *************************************************************************/
                    array(
                        'id'        => 'opts-enable-menu-color',
                        'type'      => 'checkbox',
                        'title'     => esc_html__('Nav Bar Coloring', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Check to enable color fields for menu', 'ninezeroseven'),
                        'default'   => '0'// 1 = on | 0 = off
                    ),
                    array(
                        'id'        => 'opts-nav-background',
                        'type'      => 'color',
                        // 'output'    => array('.header-bar'),
                        'title'     => esc_html__('Main Nav Background Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the main navigation background color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-menu-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'background-color' => '.menu-bar-wrapper,.menu-bar-wrapper.is-sticky'
                            )
                    ),
                    array(
                        'id'        => 'opts-nav-link-color',
                        'type'      => 'color',
                        'output'    => array('.header-inner'),
                        'title'     => esc_html__('Main Nav Link Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the main navigation link color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-menu-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.header-inner a','.wbc_menu > li > a,.mobile-menu .primary-menu .wbc_menu a'
                            )
                    ),
                    array(
                        'id'        => 'opts-nav-link-color-hover',
                        'type'      => 'color',
                        'output'    => array('.header-inner'),
                        'title'     => esc_html__('Main Nav Hover Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the main navigation hover color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-menu-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.header-inner a:hover','.wbc_menu > li > a:hover,.mobile-menu .primary-menu .wbc_menu a:hover'
                            )
                    ),
                    array(
                        'id'        => 'opts-nav-link-color-active',
                        'type'      => 'color',
                        'output'    => array('.header-bar'),
                        'title'     => esc_html__('Main Nav Active Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the main navigation active color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-menu-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.wbc_menu li.active > a,.mobile-menu .primary-menu .wbc_menu li.active a'
                            )
                    ),

                    /************************************************************************
                    * Sub Nav Colors
                    *************************************************************************/
                    array(
                        'id'        => 'opts-subnav-background',
                        'type'      => 'color',
                        'title'     => esc_html__('Sub Nav Background Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the sub navigation background color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-menu-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'background-color' => '.wbc_menu li > ul, .primary-menu.mobile-show, .primary-menu.mobile-show a'
                            )
                    ),
                    array(
                        'id'        => 'opts-subnav-link-color-border',
                        'type'      => 'color',
                        'title'     => esc_html__('Sub Nav border Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the sub navigation border color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-menu-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'border-color' => '.wbc_menu ul li a, .mobile-show .wbc_menu li a,.mobile-show ul li:last-child > a'
                            )
                    ),
                    array(
                        'id'        => 'opts-subnav-link-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Sub Nav Link Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the sub navigation link color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-menu-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.primary-menu .wbc_menu ul.sub-menu li a'
                            )
                    ),
                    array(
                        'id'        => 'opts-subnav-link-color-hover',
                        'type'      => 'color',
                        'title'     => esc_html__('Sub Nav Hover Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the sub navigation hover color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-menu-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.primary-menu .wbc_menu ul.sub-menu li a:hover'
                            )
                    ),

                    array(
                        'id'        => 'opts-bread-crumb',
                        'type'      => 'switch',
                        'title'     => esc_html__('Show/Hide Breadcrumb', 'ninezeroseven'),
                        'subtitle'  => esc_html__('You can choose to show/hide the breadcrumb here.', 'ninezeroseven'),
                        'default' => 1,
                        'on'        => 'Enabled',
                        'off'       => 'Disabled',

                    ),array(
                        'id'        => 'opts-breadcrumb-background',
                        'type'      => 'background',
                        'required'  => array('opts-bread-crumb', "=", 1),
                        'output'    => array('.page-title-wrap'),
                        'transparent' => false,
                        'title'     => esc_html__('Bread Crumb Background', 'ninezeroseven'),
                        'subtitle'  => esc_html__('You can set background here for breadcrumb area.', 'ninezeroseven'),
                        'default'   => array(
                            'background-color'      => '',
                            'background-repeat'     => '',
                            'background-attachment' => '',
                            'background-position'   => '',
                            'background-image'      => '',
                            'background-clip'       => '',
                            'background-origin'     => '',
                            'background-size'       => '',
                            )
                        ,
                    ),
                    array(
                        'id'             => 'opts-breadcrumb-title-font',
                        'type'           => 'typography',
                        'title'          => esc_html__('Page Title Font', 'ninezeroseven'),
                        'subtitle'       => esc_html__('Changes the font for the page title within the breadcrumb bar', 'ninezeroseven'),
                        'google'         => true,
                        'required'  => array('opts-bread-crumb', "=", 1),
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'         => array('.page-title-wrap .entry-title')
                
                    ),
                    array(
                        'id'        => 'opts-breadcrumb-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Bread Crumb Font Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the breadcrumb color.', 'ninezeroseven'),
                        'required'  => array('opts-bread-crumb', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.page-title-wrap'
                            )
                    )
                    ,
                    array(
                        'id'        => 'opts-breadcrumb-link-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Bread Crumb Link Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the breadcrumb link color.', 'ninezeroseven'),
                        'required'  => array('opts-bread-crumb', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.page-title-wrap a'
                            )
                    )
                    ,
                    array(
                        'id'        => 'opts-breadcrumb-hover-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Bread Crumb Hover Link Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the breadcrumb hover color.', 'ninezeroseven'),
                        'required'  => array('opts-bread-crumb', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.page-title-wrap a:hover'
                            )
                    ),
                    array(
                        'id'             => 'opts-spacing',
                        'type'           => 'spacing',
                        'output'         => array('.page-title-wrap'),
                        'required'       => array('opts-bread-crumb', "=", 1),
                        'units'          => 'px',
                        'left'           => false,
                        'right'          => false,
                        'units_extended' => false,
                        'title'          => esc_html__('Bread Crumb Padding', 'ninezeroseven'),
                        'subtitle'       => esc_html__('Set breadcrumb padding top/bottom :)', 'ninezeroseven'),
                        'desc'           => esc_html__('Please enter a pixel value without the \'px\'', 'ninezeroseven'),
                        'default'        => array(
                            'padding-top'     => '',
                            'padding-bottom'  => '',
                        )
                    ),



                    ),
                );

            /************************************************************************
            * Footer Settings
            *************************************************************************/
            $this->sections[] = array(
                'title'     => esc_html__('Footer', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'fa fa-th-large',
                //'subsection' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'       => 'opts-footer-disable',
                        'type'     => 'switch',
                        'title'    => esc_html__('Show/Hide Footer', 'ninezeroseven'),
                        'on'       => 'Enabled',
                        'off'      => 'Disabled',
                        'default'  => 1,

                    ),
                    array(
                        'id'       => 'opts-footer-widget-area-disable',
                        'type'     => 'switch',
                        'required'  => array('opts-footer-disable', "=", 1),
                        'title'    => esc_html__('Show/Hide Footer Widget Area', 'ninezeroseven'),
                        'on'       => 'Enabled',
                        'off'      => 'Disabled',
                        'default'  => 1,

                    ),
                    array(
                        'id'       => 'opts-footer-copyright-disable',
                        'type'     => 'switch',
                        'required'  => array('opts-footer-disable', "=", 1),
                        'title'    => esc_html__('Show/Hide Footer Copyright area.', 'ninezeroseven'),
                        'on'       => 'Enabled',
                        'off'      => 'Disabled',
                        'default'  => 1,

                    ),
                    array(
                        'id'        => 'opts-footer',
                        'type'      => 'select',
                        'title'     => esc_html__('Footer Columns', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Select how many columns you\'d like in the footer', 'ninezeroseven'),
                        
                        //Must provide key => value pairs for select options
                        'options'   => array(
                            '3' => '3 Columns', 
                            '4' => '4 Columns'
                        ),
                        'default'   => '4'
                    ),
                    array(
                        'id'        => 'opts-footer-credit',
                        'type'      => 'textarea',
                        'title'     => esc_html__('Footer Credit Area', 'ninezeroseven'),
                        'subtitle'  => esc_html__('This is the credit area in the footer area', 'ninezeroseven'),
                        'validate'  => 'html',
                        'desc'      => '',
                    ),
                    array(
                        'id'        => 'opts-enable-footer-color',
                        'type'      => 'checkbox',
                        'title'     => esc_html__('Footer Coloring', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Check to enable color fields for footer.', 'ninezeroseven'),
                        'default'   => '0'// 1 = on | 0 = off
                    ),
                    array(
                        'id'        => 'opts-footer-background-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Background Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-footer-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'background-color' => '.main-footer'
                            )
                    ),
                    array(
                        'id'        => 'opts-footer-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Text Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-footer-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.main-footer'
                            )
                    ),
                    array(
                        'id'        => 'opts-footer-heading-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Heading Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-footer-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.main-footer .widgets-area h4'
                            )
                    ),
                    array(
                        'id'        => 'opts-footer-link-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Link Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-footer-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.main-footer a'
                            )
                    ),
                    array(
                        'id'        => 'opts-footer-link-color-hover',
                        'type'      => 'color',
                        'title'     => esc_html__('Footer Hover Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-footer-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.main-footer a:hover'
                            )
                    ),

                    /************************************************************************
                    * Second Footer
                    *************************************************************************/
                    array(
                        'id'        => 'opts-enable-footer2-color',
                        'type'      => 'checkbox',
                        'title'     => esc_html__('Bottom Footer Coloring', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Check to enable color fields for bottom footer, this is the band at the bottom of the page.', 'ninezeroseven'),
                        'default'   => '0'// 1 = on | 0 = off
                    ),
                    array(
                        'id'        => 'opts-footer2-background-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Bottom Footer Background Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-footer2-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'background-color' => '.bottom-band,body'
                            )
                    ),
                    array(
                        'id'        => 'opts-footer2-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Bottom Footer Text Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-footer2-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.bottom-band'
                            )
                    ),
                    array(
                        'id'        => 'opts-footer2-link-color',
                        'type'      => 'color',
                        'title'     => esc_html__('Bottom Footer Link Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-footer2-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.bottom-band a'
                            )
                    ),
                    array(
                        'id'        => 'opts-footer2-link-color-hover',
                        'type'      => 'color',
                        'title'     => esc_html__('Bottom Footer Hover Color', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Change the background color.', 'ninezeroseven'),
                        'required'  => array('opts-enable-footer2-color', "=", 1),
                        'transparent' => false,
                        'default'   => '',
                        'output'    => array(
                                'color' => '.bottom-band a:hover'
                            )
                    ),////

                    ),
                );


            /************************************************************************
            * Blog/Page Layout Options
            *************************************************************************/

            $this->sections[] = array(
                'title'     => esc_html__('Blog', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'fa fa-pencil',
                //'subsection' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'        => 'opts-author-box',
                        'type'      => 'checkbox',
                        'title'     => esc_html__('Author Box', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Uncheck to hide author box on single post pages', 'ninezeroseven'),
                        'default'   => '1'// 1 = on | 0 = off
                    ),

                    array(
                        'id'        => 'opts-blog-style',
                        'type'      => 'select',
                        'title'     => esc_html__('Blog Post Style', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Can select your default blog style here', 'ninezeroseven'),
                        
                        //Must provide key => value pairs for select options
                        'options'   => array(
                            'blog-style-1' => 'Big Image', 
                            'blog-style-2' => 'Small Image', 
                            'blog-style-3' => 'Masonry'
                        ),
                        'default'   => 'blog-style-1'
                    ),

                    array(
                        'id'        => 'opts-default-layout',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Main Blog/Index Layout', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Select layout for blog/index page', 'ninezeroseven'),
                        
                        //Must provide key => value(array:title|img) pairs for radio options
                        'options'   => array(
                            'no-sidebar' => array('alt' => 'Full Width',        'img' => get_template_directory_uri() . '/includes/admin/configs/img/1col.png' ),
                            'sidebar-left' => array('alt' => 'Left Sidebar',   'img' => get_template_directory_uri() . '/includes/admin/configs/img/2cl.png' ),
                            'default' => array('alt' => 'Right Sidebar',  'img' => get_template_directory_uri() . '/includes/admin/configs/img/2cr.png' ),
                        ), 
                        'default' => 'default'
                    ),
                    array(
                        'id'        => 'opts-main-sidebar-global',
                        'type'      => 'select',
                        'required'  => array('opts-default-layout', "!=", 'no-sidebar'),
                        'title'     => esc_html__('Main Pages Sidebar', 'ninezeroseven'),
                        'subtitle'  => esc_html__('This option is for sidebar on main pages.', 'ninezeroseven'),
                        'desc'      => esc_html__('You can create additional sidebars on <strong>Appearance > Widgets</strong>', 'ninezeroseven'),
                        'data'      => 'sidebars'
                    ),
                    array(
                        'id'        => 'opts-blog-layout',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Single Page Blog Layout', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Select layout for single blog page', 'ninezeroseven'),
                        
                        //Must provide key => value(array:title|img) pairs for radio options
                        'options'   => array(
                            'no-sidebar' => array('alt' => 'Full Width',        'img' => get_template_directory_uri() . '/includes/admin/configs/img/1col.png' ),
                            'sidebar-left' => array('alt' => 'Left Sidebar',   'img' => get_template_directory_uri() . '/includes/admin/configs/img/2cl.png' ),
                            'default' => array('alt' => 'Right Sidebar',  'img' => get_template_directory_uri() . '/includes/admin/configs/img/2cr.png' ),
                        ), 
                        'default' => 'default'
                    ),
                    array(
                        'id'        => 'opts-single-page-sidebar-global',
                        'type'      => 'select',
                        'required'  => array('opts-blog-layout', "!=", 'no-sidebar'),
                        'title'     => esc_html__('Single Pages Sidebar', 'ninezeroseven'),
                        'subtitle'  => esc_html__('This option is for sidebar on single pages/posts.', 'ninezeroseven'),
                        'desc'      => esc_html__('You can create additional sidebars on <strong>Appearance > Widgets</strong>', 'ninezeroseven'),
                        'data'      => 'sidebars'
                    ),


                ));

            $this->sections[] = array(
                'title'     => esc_html__('Portfolio', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'fa fa-picture-o',
                //'subsection' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'                => 'opts-portfolio-slug',
                        'type'              => 'text',
                        'title'             => esc_html__('Portfolio Slug', 'ninezeroseven'),
                        'subtitle'          => esc_html__('Change the /portfolio/ url slug.', 'ninezeroseven'),
                        'desc'              => esc_html__('Slug should be named lowercase with hypens inplace of spaces. ie \'your-slug\'', 'ninezeroseven'),
                        'validate_callback' => 'wbc907_sanitize_slug',
                        'default'           => 'portfolio'
                    ),
                    array(
                        'id'        => 'opts-portfolio-layout',
                        'type'      => 'image_select',
                        'title'     => esc_html__('Portfolio Layout', 'ninezeroseven'),
                        'subtitle'  => esc_html__('This is for Portfolio single page layout.', 'ninezeroseven'),
                        
                        //Must provide key => value(array:title|img) pairs for radio options
                        'options'   => array(
                            'full-width'   => array('alt' => 'Full Screen Width',     'img' => get_template_directory_uri() . '/includes/admin/configs/img/full-width.png' ),
                            'no-sidebar'   => array('alt' => 'Full Width',        'img' => get_template_directory_uri() . '/includes/admin/configs/img/1col.png' ),
                            'sidebar-left' => array('alt' => 'Left Sidebar',   'img' => get_template_directory_uri() . '/includes/admin/configs/img/2cl.png' ),
                            'default'      => array('alt' => 'Right Sidebar',  'img' => get_template_directory_uri() . '/includes/admin/configs/img/2cr.png' ),
                        ), 
                        'default' => 'default'
                    ),array(
                        'id'       => 'opts-single-portfolio-sidebar-global',
                        'subtitle'  => esc_html__('Set a default sidebar for portfolio pages', 'ninezeroseven'),
                        'title'    => esc_html__( 'Sidebar', 'ninezeroseven' ),
                        'desc'     => esc_html__('You can create additional sidebars under Appearance > Widgets.','ninezeroseven'),
                        'type'     => 'select',
                        'data'     => 'sidebars',
                        'required' => array('opts-portfolio-layout', '=', array('sidebar-left','default'))
                    ),


                ));

            /************************************************************************
            * WBC Reusables
            *************************************************************************/
            $this->sections[] = array(
                'title'     => esc_html__('Reusables', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'dashicons-before dashicons-chart-pie',
                //'subsection' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    //GLOBAL
                    array(
                        'id'       => 'opts-global-reuse-before',
                        'multi'    => true,
                        'title'    => esc_html__( 'Global Before', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all pages,posts, etc','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),
                    array(
                        'id'       => 'opts-global-reuse-after',
                        'multi'    => true,
                        'title'    => esc_html__( 'Global After', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all pages,posts, etc','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),
                ));

            //Portfolio
            $this->sections[] = array(
                'title'     => esc_html__('Portfolio', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'fa fa-caret-right',
                'subsection' => true,
                // 'subsection' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'       => 'opts-wbc-portfolio-reuse-before',
                        'multi'    => true,
                        'title'    => esc_html__( 'Portfolio Before', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all portfolio pages','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),
                    array(
                        'id'       => 'opts-wbc-portfolio-reuse-after',
                        'multi'    => true,
                        'title'    => esc_html__( 'Portfolio After', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all portfolio pages','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),


                ));
            //posts
            $this->sections[] = array(
                'title'     => esc_html__('Posts', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'fa fa-caret-right',
                'subsection' => true,
                // 'subsection' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'       => 'opts-post-reuse-before',
                        'multi'    => true,
                        'title'    => esc_html__( 'Posts Before', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all post pages','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),
                    array(
                        'id'       => 'opts-post-reuse-after',
                        'multi'    => true,
                        'title'    => esc_html__( 'Posts After', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all post pages','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),


                ));
            //page
            $this->sections[] = array(
                'title'     => esc_html__('Pages', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'fa fa-caret-right',
                'subsection' => true,
                // 'subsection' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'       => 'opts-page-reuse-before',
                        'multi'    => true,
                        'title'    => esc_html__( 'Pages Before', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all page pages','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),
                    array(
                        'id'       => 'opts-page-reuse-after',
                        'multi'    => true,
                        'title'    => esc_html__( 'Pages After', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all page pages','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),

            ));
            
            //page
            $this->sections[] = array(
                'title'     => esc_html__('MISC', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'fa fa-caret-right',
                'subsection' => true,
                // 'subsection' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'       => 'opts-category-reuse-before',
                        'multi'    => true,
                        'title'    => esc_html__( 'Category Before', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all category pages','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),
                    array(
                        'id'       => 'opts-category-reuse-after',
                        'multi'    => true,
                        'title'    => esc_html__( 'Category After', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all category pages','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),
                    array(
                        'id'       => 'opts-search-reuse-before',
                        'multi'    => true,
                        'title'    => esc_html__( 'Search Before', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all search pages','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),
                    array(
                        'id'       => 'opts-search-reuse-after',
                        'multi'    => true,
                        'title'    => esc_html__( 'Search After', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all search pages','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),

                    array(
                        'id'       => 'opts-404-reuse-before',
                        'multi'    => true,
                        'title'    => esc_html__( '404 Before', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all 404','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),
                    array(
                        'id'       => 'opts-404-reuse-after',
                        'multi'    => true,
                        'title'    => esc_html__( '404 After', 'ninezeroseven' ),
                        'desc'     => esc_html__('Sets default reuseable section to all 404','ninezeroseven'),
                        'args'     => array('post_type' => array('wbc-reuseables'),'posts_per_page' => -1),
                        'type'     => 'select',
                        'sortable' => true,
                        'data'     => 'posts',
                    ),


                ));

            /************************************************************************
            * Typography Settings
            *************************************************************************/
            $this->sections[] = array(
                'title'     => esc_html__('Typography', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'fa fa-font',
                // 'subsection' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'             => 'opts-typography-body',
                        'type'           => 'typography',
                        'title'          => esc_html__('Body Font', 'ninezeroseven'),
                        'subtitle'       => esc_html__('Specify the body font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'font-backup'    => true,
                        'output'         => array('body')
                
                    ),
                    array(
                        'id'             => 'opts-typography-menu',
                        'type'           => 'typography',
                        'title'          => esc_html__('Main Menu Font', 'ninezeroseven'),
                        'subtitle'       => esc_html__('Specify the main menu font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'color'          => false,
                        'line-height'    => false,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('.wbc_menu > li > a')
                
                    ),
                    array(
                        'id'             => 'opts-typography-submenu',
                        'type'           => 'typography',
                        'title'          => esc_html__('Sub Menu Font', 'ninezeroseven'),
                        'subtitle'       => esc_html__('Specify the Sub menu font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'color'          => false,
                        'line-height'    => false,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('.wbc_menu ul li a')
                
                    ),

                    /************************************************************************
                    * HEADINGS
                    *************************************************************************/
                    array(
                        'id'        => 'opts-enable-heading-advance',
                        'type'      => 'checkbox',
                        'title'     => esc_html__('Advanced Headings (H tags)', 'ninezeroseven'),
                        'subtitle'  => esc_html__('Check to enable advanced headings/control', 'ninezeroseven'),
                        'default'   => '0'// 1 = on | 0 = off
                    ),
                    array(
                        'id'             => 'opts-typography-heading',
                        'type'           => 'typography',
                        'required'       => array('opts-enable-heading-advance', "=", 0),
                        'title'          => esc_html__('Headings Font (H1-H6 tags)', 'ninezeroseven'),
                        'subtitle'       => esc_html__('Specify the heading tags font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => false,
                        'font-size'      => false,
                        'line-height'    =>false,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('h1,h2,h3,h4,h5,h6')
                
                    ),

                    array(
                        'id'             => 'opts-typography-h1',
                        'type'           => 'typography',
                        'required'       => array('opts-enable-heading-advance', "=", 1),
                        'title'          => esc_html__('H1 Font', 'ninezeroseven'),
                        'subtitle'       => esc_html__('Specify the H1 font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('h1')
                
                    ),
                    array(
                        'id'             => 'opts-typography-h2',
                        'type'           => 'typography',
                        'required'       => array('opts-enable-heading-advance', "=", 1),
                        'title'          => esc_html__('H2 Font', 'ninezeroseven'),
                        'subtitle'       => esc_html__('Specify the h2 font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('h2')
                
                    ),
                    array(
                        'id'             => 'opts-typography-h3',
                        'type'           => 'typography',
                        'required'       => array('opts-enable-heading-advance', "=", 1),
                        'title'          => esc_html__('H3 Font', 'ninezeroseven'),
                        'subtitle'       => esc_html__('Specify the h3 font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('h3')
                
                    ),
                    array(
                        'id'             => 'opts-typography-h4',
                        'type'           => 'typography',
                        'required'       => array('opts-enable-heading-advance', "=", 1),
                        'title'          => esc_html__('H4 Font', 'ninezeroseven'),
                        'subtitle'       => esc_html__('Specify the h4 font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('h4')
                
                    ),
                    array(
                        'id'             => 'opts-typography-h5',
                        'type'           => 'typography',
                        'required'       => array('opts-enable-heading-advance', "=", 1),
                        'title'          => esc_html__('H5 Font', 'ninezeroseven'),
                        'subtitle'       => esc_html__('Specify the H5 font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'customCSS'      => '.chicken',
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('h5')
                
                    ),
                    array(
                        'id'             => 'opts-typography-h6',
                        'type'           => 'typography',
                        'required'       => array('opts-enable-heading-advance', "=", 1),
                        'title'          => esc_html__('H6 Font', 'ninezeroseven'),
                        'subtitle'       => esc_html__('Specify the H6 font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('h6')
                
                    ),





                    )
                );

                /************************************************************************
                * Extra Heading Options
                *************************************************************************/
            $this->sections[] = array(
                'title'     => esc_html__('Extra Headings', 'ninezeroseven'),
                //'desc'      => esc_html__('Redux Framework was created with the developer in mind. It allows for any theme developer to have an advanced theme panel with most of the features a developer would need. For more information check out the Github repo at: <a href="https://github.com/ReduxFramework/Redux-Framework">https://github.com/ReduxFramework/Redux-Framework</a>', 'ninezeroseven'),
                'icon'      => 'fa fa-caret-right',
                'subsection' => true,
                // 'subsection' => true, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    array(
                        'id'             => 'opts-special-heading1',
                        'type'           => 'typography',
                        'title'          => esc_html__('Heading Styling 1, used in shortcodes.', 'ninezeroseven'),
                        // 'subtitle'       => esc_html__('Specify the Sub menu font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'color'          => false,
                        'line-height'    => false,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('.special-heading-1')
                
                    ),
                    array(
                        'id'             => 'opts-special-heading2',
                        'type'           => 'typography',
                        'title'          => esc_html__('Heading Styling 2, used in shortcodes.', 'ninezeroseven'),
                        // 'subtitle'       => esc_html__('Specify the Sub menu font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'color'          => false,
                        'line-height'    => false,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('.special-heading-2')
                
                    ),
                    array(
                        'id'             => 'opts-special-heading3',
                        'type'           => 'typography',
                        'title'          => esc_html__('Heading Styling 3, used in shortcodes.', 'ninezeroseven'),
                        // 'subtitle'       => esc_html__('Specify the Sub menu font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'color'          => false,
                        'line-height'    => false,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('.special-heading-3')
                
                    ),
                    array(
                        'id'             => 'opts-special-heading4',
                        'type'           => 'typography',
                        'title'          => esc_html__('Heading Styling 4, used in shortcodes.', 'ninezeroseven'),
                        // 'subtitle'       => esc_html__('Specify the Sub menu font properties.', 'ninezeroseven'),
                        'google'         => true,
                        'text-align'     => false,
                        'letter-spacing' => true,
                        'color'          => false,
                        'line-height'    => false,
                        'font-backup'    => true,
                        'default'        => array(
                            'font-size'     => '',
                            'font-family'   => '',
                            'font-weight'   => ''
                        ),
                        'output'    => array('.special-heading-4')
                
                    ),

                    





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
                'opt_name'          => 'wbc907_data',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => esc_html__('Theme Options', 'ninezeroseven'),
                'page_title'        => esc_html__('Theme Options', 'ninezeroseven'),
                'disable_tracking'  => 'true',
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'xxxxxx', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,
                'ajax_save'         => false,                   // Enable basic customizer support
                
                // OPTIONAL -> Give you extra features
                'page_priority'     => 43,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => '',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
                'hints' => array(
                    'icon' => 'el el-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'small',
                    'tip_style' => array(
                        'color' => 'dark',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => 'bootstrap',
                    ),
                    'tip_position' => array(
                        'my' => 'top right',
                        'at' => 'bottom left',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                        'effect' => 'slide',
                        'duration' => '500',
                        'event' => 'mouseover',
                    ),
                    'hide' => array(
                        'effect' => 'slide',
                        'duration' => '500',
                        'event' => 'click mouseleave',
                        ),
                    ),
                    )
            );
            
            $wbc907_support_url = join('',array(
                    'http',
                    '://',
                    'support',
                    '.webcreations907',
                    '.com/'
                ));
            
            //messages
            $wbc907_config_message = '<p>Need Support? Check out the <a href="'.esc_attr( $wbc907_support_url ).'">Theme\'s Support Form</a></p>';
            
            $this->args['intro_text'] = $wbc907_config_message;
            // Add content after the form.
            $this->args['footer_text'] = $wbc907_config_message;
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new WBC907_Options_Framework();
}


if (!function_exists('wbc907_sanitize_slug')){
    function wbc907_sanitize_slug($field, $value, $existing_value) {
        $error = false;
        $value = $value;

        if(empty($value)){

            $return['value'] = 'portfolio';

        }elseif($value != $existing_value){

            $return['value'] = trim( sanitize_title( $value ) );
        }else{
            $return['value'] = $value;
        }

        return $return;
    }
}