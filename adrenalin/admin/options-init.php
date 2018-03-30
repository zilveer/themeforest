<?php

/**
 * ReduxFramework Config
 * */
if ( !class_exists( 'redux_theme_Redux_Framework_config' ) ) {

    class redux_theme_Redux_Framework_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if ( !class_exists( 'ReduxFramework' ) ) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
            }
        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if ( !isset( $this->args['opt_name'] ) ) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }

        /**
         * This is a test function that will let you see when the compiler hook occurs.
         * It only runs if a field   set with compiler=>true is changed.
         * */
        function compiler_action( $options, $css ) {
            //echo '<h1>The compiler hook has run!';
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
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
             */
        }

        /**
         * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
         * Simply include this function in the child themes functions.php file.
         * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
         * so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title' => __( 'Section via hook', 'redux-framework-demo' ),
                'desc' => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**
         * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**
         * Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::instance(), 'plugin_metalinks' ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }

        public function setSections() {

            /**
             * Theme Options sections
             * */
            $this->sections[] = array(
                'title' => __( 'Global Settings', 'commercegurus' ),
                'desc' => __( 'Changes to major global elements.', 'commercegurus' ),
                'icon' => 'el-icon-home',
                'fields' => array(
                    array(
                        'desc' => __( 'Select a container layout style', 'commercegurus' ),
                        'id' => 'container_style',
                        'type' => 'select',
                        'options' => array(
                            'full-width' => 'Full Width Layout',
                            'boxed' => 'Boxed Layout',
                        ),
                        'title' => __( 'Container layout style', 'commercegurus' ),
                        'default' => 'boxed',
                    ),
                    array(
                        'desc' => __( 'Enable or disable responsiveness on smartphones', 'commercegurus' ),
                        'id' => 'cg_responsive',
                        'type' => 'select',
                        'options' => array(
                            'enabled' => 'Enabled',
                            'disabled' => 'Disabled',
                        ),
                        'title' => __( 'Responsive', 'commercegurus' ),
                        'default' => 'enabled',
                    ),
                    array(
                        'desc' => __( 'Display comments on pages?', 'commercegurus' ),
                        'id' => 'cg_page_comments',
                        'type' => 'select',
                        'options' => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'title' => __( 'Comments on pages?', 'commercegurus' ),
                        'default' => 'no',
                    ),
                    array(
                        'desc' => __( 'Display enhanced dropdown styling using chosenjs?', 'commercegurus' ),
                        'id' => 'cg_chosen_js',
                        'type' => 'select',
                        'options' => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'title' => __( 'Enhanced Dropdown Styling?', 'commercegurus' ),
                        'default' => 'yes',
                    ),
                    array(
                        'id' => 'cg_background',
                        'type' => 'background',
                        'title' => __( 'Body Background - Color and image', 'commercegurus' ),
                        'subtitle' => __( 'Configure your theme background - use this option if you would like to use a full size image like a photo as your background.', 'commercegurus' ),
                        'background-position' => false,
                        'background-size' => false,
                        'background-attachment' => false,
                        'default' => array(
                            'background-color' => '#444444',
                        ),
                    ),
                    array(
                        'id' => 'cg_pattern_background',
                        'type' => 'background',
                        'title' => __( 'Body Background - Pattern', 'commercegurus' ),
                        'subtitle' => __( 'Use this option if you want to use a repeating pattern for your background. Note: Do not try to use both a pattern background and a full size image background! ', 'commercegurus' ),
                        'background-position' => false,
                        'background-size' => false,
                        'background-attachment' => false,
                        'default' => array(
                            'background-color' => '#efefef',
                        ),
                    ),
                    array(
                        'id' => 'cg_page_wrapper_color',
                        'type' => 'color',
                        'title' => __( 'Main body wrapper color', 'commercegurus' ),
                        'subtitle' => __( 'Configure your theme wrapper.', 'commercegurus' ),
                        'default' => '#fff',
                    ),
                ),
            );

            $this->sections[] = array(
                'title' => __( 'Colors', 'commercegurus' ),
                'desc' => __( 'Customize your theme color palette.', 'commercegurus' ),
                'icon' => 'el-icon-tint',
                'fields' => array(
                    array(
                        'desc' => __( 'Select from one of the predefined color skins, or select your own colors below.', 'commercegurus' ),
                        'id' => 'cg_skin_color',
                        'type' => 'select',
                        'options' => array(
                            'none' => 'No skin - use custom',
                            '#d54800' => 'Red',
                            '#1e73be' => 'Blue',
                            '#208e3c' => 'Green',
                            '#9b3b85' => 'Purple',
                        ),
                        'title' => __( 'Color Skin', 'commercegurus' ),
                        'default' => '#d54800',
                    ),
                    array(
                        'id' => 'cg_primary_color',
                        'type' => 'color',
                        'title' => __( 'Primary theme color', 'commercegurus' ),
                        'subtitle' => __( 'This should be something unique about your site.', 'commercegurus' ),
                        'default' => '#d54800',
                    ),
                    array(
                        'id' => 'cg_active_link_color',
                        'type' => 'color',
                        'title' => __( 'Active link color', 'commercegurus' ),
                        'subtitle' => __( 'The color of active links.', 'commercegurus' ),
                        'default' => '#d54800',
                    ),
                    array(
                        'id' => 'cg_link_hover_color',
                        'type' => 'color',
                        'title' => __( 'Link hover color', 'commercegurus' ),
                        'subtitle' => __( 'The color of your links in the hover state.', 'commercegurus' ),
                        'default' => '#d54800',
                    ),
                    array(
                        'id' => 'cg_header_bg_color',
                        'type' => 'color',
                        'title' => __( 'Header Background Color', 'commercegurus' ),
                        'subtitle' => __( 'The color of the header background.', 'commercegurus' ),
                        'default' => '#fff',
                    ),
                    array(
                        'id' => 'cg_header_fixed_bg_color',
                        'type' => 'color',
                        'title' => __( 'Fixed Header Background Color', 'commercegurus' ),
                        'subtitle' => __( 'The color of the fixed header background.', 'commercegurus' ),
                        'default' => '#fff',
                    ),
                    array(
                        'id' => 'cg_header_cart_text_color',
                        'type' => 'color',
                        'title' => __( 'Header Cart Text Color', 'commercegurus' ),
                        'subtitle' => __( 'The color of the header cart text.', 'commercegurus' ),
                        'default' => '#111',
                    ),
                    array(
                        'id' => 'cg_first_footer_bg',
                        'type' => 'color',
                        'title' => __( 'First footer background color', 'commercegurus' ),
                        'subtitle' => __( 'The background color of the first (top) footer.', 'commercegurus' ),
                        'default' => '#f4f4f4',
                    ),
                    array(
                        'id' => 'cg_second_footer_bg',
                        'type' => 'color',
                        'title' => __( 'Second footer background color', 'commercegurus' ),
                        'subtitle' => __( 'The background color of the second (bottom) footer.', 'commercegurus' ),
                        'default' => '#111',
                    ),
                    array(
                        'id' => 'cg_last_footer_bg',
                        'type' => 'color',
                        'title' => __( 'Last footer background color', 'commercegurus' ),
                        'subtitle' => __( 'The background color of the last footer (where the Copyright notice normally appears.', 'commercegurus' ),
                        'default' => '#111',
                    ),
                    array(
                        'id' => 'cg_first_footer_text',
                        'type' => 'color',
                        'title' => __( 'First footer text color', 'commercegurus' ),
                        'subtitle' => __( 'The text color of the first (top) footer.', 'commercegurus' ),
                        'default' => '#222',
                    ),
                    array(
                        'id' => 'cg_second_footer_text',
                        'type' => 'color',
                        'title' => __( 'Second footer text color', 'commercegurus' ),
                        'subtitle' => __( 'The text color of the second (bottom) footer.', 'commercegurus' ),
                        'default' => '#fff',
                    ),
                    array(
                        'id' => 'cg_last_footer_text',
                        'type' => 'color',
                        'title' => __( 'Last footer text color', 'commercegurus' ),
                        'subtitle' => __( 'The text color of the last footer (where the Copyright notice normally appears.', 'commercegurus' ),
                        'default' => '#777',
                    ),
                ),
            );

            $this->sections[] = array(
                'title' => __( 'Logos and icons', 'commercegurus' ),
                'desc' => __( 'Update your logos and icons.', 'commercegurus' ),
                'icon' => 'el-icon-photo',
                'fields' => array(
                    array(
                        'desc' => __( 'Upload logo here.', 'commercegurus' ),
                         'id' => 'site_logo',
                        'type' => 'media',
                        'title' => 'Logo',
                        'url' => true,
                    ),
                    array(
                        'desc' => __( 'Add your custom Favicon image. 16x16px .ico or .png.', 'commercegurus' ),
                        'id' => 'cg_favicon',
                        'type' => 'media',
                        'title' => 'Favicon',
                        'url' => true,
                    ),
                    array(
                        'desc' => __( 'The Retina/iOS version of your Favicon. 144x144px .png.', 'commercegurus' ),
                        'id' => 'cg_retina_favicon',
                        'type' => 'media',
                        'title' => __( 'Favicon retina', 'commercegurus' ),
                        'url' => true,
                    ),
                ),
            );

            $this->sections[] = array(
                'title' => __( 'Header settings', 'commercegurus' ),
                'desc' => __( 'Manage your header.', 'commercegurus' ),
                'icon' => 'el-icon-hand-up',
                'fields' => array(
                    array(
                        'desc' => __( 'Select where you would like to position your logo', 'commercegurus' ),
                        'id' => 'cg_logo_position',
                        'type' => 'select',
                        'title' => __( 'Header Logo Position', 'commercegurus' ),
                        'options' => array(
                            'left' => 'Left',
                            'center' => 'Center',
                        ),
                        'default' => 'left',
                    ),                    
                    array(
                        'desc' => __( 'Set height of header in px.', 'commercegurus' ),
                        'id' => 'cg_header_height',
                        'min' => '50',
                        'step' => '1',
                        'max' => '500',
                        'type' => 'slider',
                        'title' => 'Header height',
                        'default' => '80',
                    ),
                    array(
                        'desc' => __( 'Set height of the fixed header in px.', 'commercegurus' ),
                        'id' => 'cg_fixed_header_height',
                        'min' => '50',
                        'step' => '1',
                        'max' => '500',
                        'type' => 'slider',
                        'title' => __( 'Sticky/Fixed header height', 'commercegurus' ),
                        'default' => '60',
                    ),
                    array(
                        'desc' => __( 'Set height of header in px for display on smartphones.', 'commercegurus' ),
                        'id' => 'cg_header_height_mobile',
                        'min' => '40',
                        'step' => '1',
                        'max' => '500',
                        'type' => 'slider',
                        'title' => __( 'Mobile device header height', 'commercegurus' ),
                        'default' => '60',
                    ),
                    array(
                        'desc' => __( 'Show cart in header?', 'commercegurus' ),
                        'id' => 'cg_show_cart',
                        'type' => 'select',
                        'title' => __( 'Show cart?', 'commercegurus' ),
                        'options' => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'default' => 'yes',
                    ),
                    array(
                        'desc' => __( 'Choose between a Cart, Basket or Bag', 'commercegurus' ),
                        'id' => 'cg_cart_icon_type',
                        'type' => 'select',
                        'title' => __( 'Select your preferred cart icon style', 'commercegurus' ),
                        'options' => array(
                            'cart' => 'Cart',
                            'basket' => 'Basket',
                            'bag' => 'Bag',
                        ),
                        'default' => 'cart',
                    ),
                ),
            );

            $this->sections[] = array(
                'title' => __( 'Main menu settings', 'commercegurus' ),
                'desc' => __( 'Manage your main menu.', 'commercegurus' ),
                'icon' => 'el-icon-cog-alt',
                'fields' => array(
                    array(
                        'id' => 'cg_level1_font',
                        'type' => 'typography',
                        'title' => __( 'Level 1 Typeface', 'commercegurus' ),
                        'text-transform' => true,
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        'line-height' => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( '.cg-primary-menu .menu > li > a, .cart_subtotal .amount' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px', // Defaults to px
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#333',
                            'font-weight' => '400',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '16px',
                            'text-transform' => 'uppercase',
                        ),
                    ),
                    array(
                        'id' => 'cg_level2_heading_font',
                        'type' => 'typography',
                        'title' => __( 'Level 2 Heading Typeface', 'commercegurus' ),
                        'text-transform' => true,
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        'line-height' => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( '.cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a, .cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown .container > ul > li > a, .menu-full-width .cg-menu-title' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px', // Defaults to px
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#fff',
                            'font-weight' => '400',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '17px',
                            'text-transform' => 'uppercase',
                        ),
                    ),
                    array(
                        'id' => 'cg_level2_font',
                        'type' => 'typography',
                        'title' => __( 'Level 2 Typeface', 'commercegurus' ),
                        'text-transform' => true,
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        'line-height' => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( '.cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a, .cg-submenu-ddown .container > ul > li > a' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px', // Defaults to px
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#f2f2f2',
                            'font-weight' => '400',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '14px',
                            'text-transform' => 'uppercase',
                        ),
                    ),
                    array(
                        'id' => 'cg_main_menu_dropdown_bg',
                        'type' => 'color_rgba',
                        'title' => __( 'Dropdown menu background color.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#181a19',
                            'alpha' => '1.0',
                        ),
                        'output' => array(
                            '.cg-header-fixed .menu > li .cg-submenu-ddown, .cg-primary-menu .menu > li .cg-submenu-ddown, .cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown, .cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown, .cg-header-fixed .menu > li .cg-submenu-ddown .container > ul .menu-item-has-children .cg-submenu li, .cg-primary-menu .menu > li .cg-submenu-ddown .container > ul .menu-item-has-children .cg-submenu li,.cg-header-fixed .menu > li.menu-full-width .cg-submenu-ddown,.cg-primary-menu .menu > li.menu-full-width .cg-submenu-ddown, .menu-full-width .cg-menu-title'
                        ),
                        'mode' => 'background',
                    ),
                    array(
                        'id' => 'cg_submenu_border',
                        'type' => 'border',
                        'title' => __( 'Dropdown menu border color', 'commercegurus' ),
                        'subtitle' => __( 'Change the color of borders applied to menu items in the main menu dropdown', 'commercegurus' ),
                        'output' => array( '.cg-primary-menu .menu > li .cg-submenu-ddown .container > ul > li a, .cg-submenu-ddown .container > ul > li > a' ),
                        'desc' => __( 'Please bear in mind this border color should complement your dropdown background color.', 'commercegurus' ),
                        'default' => array(
                            'border-color' => '#383838',
                            'border-style' => 'solid',
                            'border-top' => '0px',
                            'border-right' => '1px',
                            'border-bottom' => '1px',
                            'border-left' => '1px'
                        )
                    ),
                    array(
                        'desc' => 'Do you want to display the sticky menu? A sticky menu is a menu which fixes itself to the top of your screen as your scroll further down the page.',
                        'id' => 'cg_sticky_menu',
                        'type' => 'select',
                        'options' => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'title' => 'Display sticky menu?',
                        'default' => 'yes',
                    ),
                    array(
                        'desc' => __( 'Set Primary Menu Mega Dropdown banner image height', 'commercegurus' ),
                        'id' => 'cg_primary_menu_img_height',
                        'min' => '100',
                        'step' => '1',
                        'max' => '500',
                        'type' => 'slider',
                        'title' => __( 'Mega Menu Banner Image Height', 'commercegurus' ),
                        'default' => '200',
                    ),
                ),
            );

            // Main menu image uploads

            $cg_menu_fields = array();
            $cg_menu_id = get_nav_menu_locations();
            if ( isset( $cg_menu_id['primary'] ) ) {
                $cg_primary_menuitems = wp_get_nav_menu_items( $cg_menu_id['primary'] );

                if ( $cg_primary_menuitems ) {
                    foreach ( $cg_primary_menuitems as $item ) {
                        if ( $item->menu_item_parent === '0' ) {
                            $cg_menu_item_obj_id = 'cg_primary_' . $item->ID;
                            $cg_menu_item_name = $item->title;
                            $cg_menu_fields[] = array(
                                'desc' => 'Upload your menu image',
                                'id' => $cg_menu_item_obj_id,
                                'type' => 'media',
                                'title' => $cg_menu_item_name,
                                'url' => true,
                            );
                        }
                    }
                }

                $this->sections[] = array(
                    'title' => __( 'Main menu images ', 'commercegurus' ),
                    'desc' => __( 'Assign images to your main/primary menu items. Remember! These images only show up when a mega menu is active. Your top level menu item should have a class of menu-full-width.', 'commercegurus' ),
                    'icon' => 'el-icon-photo',
                    'fields' => $cg_menu_fields,
                );
            }

            // End Main/Primary menu image uploads
            $this->sections[] = array(
                'title' => __( 'Footer settings', 'commercegurus' ),
                'desc' => __( 'Manage your footer.', 'commercegurus' ),
                'icon' => 'el-icon-hand-down',
                'fields' => array(
                    array(
                        'id' => 'cg_footer_message',
                        'type' => 'text',
                        'title' => 'Footer text',
                        'default' => '<p>&copy; 2015 Copyright CommerceGurus</p>',
                    ),
                    array(
                        'desc' => __( 'Show widget area just under body (and just before the footer?', 'commercegurus' ),
                        'id' => 'cg_below_body_widget',
                        'type' => 'select',
                        'title' => __( 'Show widget below body?', 'commercegurus' ),
                        'options' => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'default' => 'no',
                    ),
                    array(
                        'desc' => __( 'Show top footer?', 'commercegurus' ),
                        'id' => 'cg_footer_top_active',
                        'type' => 'select',
                        'title' => __( 'Show top footer', 'commercegurus'),
                        'options' => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'default' => 'yes',
                    ),
                    array(
                        'desc' => __( 'Show bottom footer?', 'commercegurus' ),
                        'id' => 'cg_footer_bottom_active',
                        'type' => 'select',
                        'title' => __( 'Show bottom footer', 'commercegurus' ),
                        'options' => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'default' => 'yes',
                    ),
                    array(
                        'desc' => __( 'Show back to top?', 'commercegurus' ),
                        'id' => 'cg_back_to_top',
                        'type' => 'select',
                        'title' => __( 'Show back to top?', 'commercegurus' ),
                        'options' => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'default' => 'yes',
                    ),
                ),
            );

            $this->sections[] = array(
                'title' => __( 'Typography', 'commercegurus' ),
                'desc' => __( 'Manage your fonts and typefaces.', 'commercegurus' ),
                'icon' => 'el-icon-fontsize',
                'fields' => array(
                    array(
                        'id' => 'opt-typography-body',
                        'type' => 'typography',
                        'title' => __( 'Body/Main text font', 'commercegurus' ),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( 'body', 'select', 'input', 'textarea', 'button',
                        '.widget ul li a' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px', // Defaults to px
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#444',
                            'font-weight' => '400',
                            'font-family' => 'Roboto',
                            'google' => true,
                            'font-size' => '15px',
                            'line-height' => '23px'
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-secondary',
                        'type' => 'typography',
                        'title' => __( 'Secondary font', 'commercegurus' ),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size' => false,
                        //'line-height' => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color' => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array(
                            'a.btn', '.content-area a.btn', '.content-area a.btn:hover', '#respond input#submit', '.wpcf7 input.wpcf7-submit',
                            'ul.navbar-nav li .nav-dropdown > ul > li.menu-parent-item > a', 'ul.tiny-cart li ul.cart_list li.buttons .button', '#get-started .main h6', '.content-area .see-through', '.testimonials-wrap  span', '.faqs-reviews ul li h6', '.cg-product-info .category', '.products .onsale', '.woocommerce span.onsale', '.products .woocommerce-page span.onsale', '.onsale', '.woocommerce .container span.onsale', '.woocommerce-page .container span.onsale', '.cart .quantity', '.woocommerce .button',
                            '.woocommerce .container a.button', '.cg-product-cta',
                            '.mc4wp-form input[type="submit"]',
                            '.woocommerce .container button.button',
                            '.woocommerce .container input.button',
                            '.woocommerce .container #respond input#submit',
                            '.woocommerce .container #content input.button',
                            '.woocommerce-page .container .cg-product-cta a.button',
                            '.cg-product-cta .button',
                            '.woocommerce-page .container a.button',
                            '.defaultloop .button',
                            '.woocommerce-page .container button.button',
                            '.woocommerce-page .container input.button',
                            '.woocommerce-page .container #respond input#submit',
                            '.woocommerce-page .container #content input.button', '.added_to_cart', '.woocommerce .container div.product form.cart .button',
                            '.woocommerce .container #content div.product form.cart .button',
                            '.woocommerce-page .container div.product form.cart .button',
                            '.woocommerce-page .container #content div.product form.cart .button',
                            '.woocommerce-page .container p.cart a.button',
                            '.cg-quickview-product-pop .single-product-details .button',
                            '.content-area .woocommerce .summary .button', '.woocommerce .container span.onsale', '.woocommerce-page .container span.onsale', '.woocommerce-page .container a.button.small',
                            '.content-area .woocommerce a.button.small', '.widget_product_search input#searchsubmit', '.widget h1', '.post-password-form input[type="submit"]', '.content-area .comments-area h2', '.content-area article a.more-link', '.blog-pagination ul li a', '.content-area table.cart tr th', '.content-area .coupon h3', '.woocommerce-page .container form.login input.button', '.subfooter #mc_signup_submit', '.container .wpb_row .wpb_call_to_action a .wpb_button', '.container .vc_btn',
                            '.wpb_button', '.top-bar-right', '.cg-shopping-toolbar .wpml', 'body .wpb_teaser_grid .categories_filter li a', '#filters button', '.cg-product-wrap a .category', '.lightwrapper h4', '.cg-back-to-prev a', '.summary .price', '.cg-product-detail .product_title', '.cg-quickview-product-pop .product_title', '.cg-strip-wrap h1', '.yith-wcwl-add-to-wishlist a', 'table.variations label', '.woocommerce-tabs .tabs li a', '.cg-size-guide a', '.woocommerce-page .content-area form fieldset legend', '.subfooter ul.simple-links li a',
                        ),
                        'compiler' => array( 'h2.site-description-compiler' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px', // Defaults to px
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'font-weight' => '400',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '13px',
                            'line-height' => '23px',
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-h1',
                        'type' => 'typography',
                        'title' => __( 'Heading 1 Style', 'commercegurus' ),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( 'h1.cg-page-title', '.content-area h1', '.product-page-title h1' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px', // Defaults to px
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '700',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '32px',
                            'line-height' => '45px'
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-h2',
                        'type' => 'typography',
                        'title' => __( 'Heading 2 Style', 'commercegurus' ),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( 'h2', '.content-area h2' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px', // Defaults to px
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '700',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '34px',
                            'line-height' => '40px'
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-h3',
                        'type' => 'typography',
                        'title' => __( 'Heading 3 Style', 'commercegurus' ),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( 'h3', '.content-area h3' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px', // Defaults to px
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '700',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '26px',
                            'line-height' => '30px'
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-h4',
                        'type' => 'typography',
                        'title' => __( 'Heading 4 Style', 'commercegurus' ),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( 'h4', '.content-area h4' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px', // Defaults to px
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '400',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '22px',
                            'line-height' => '24px'
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-h5',
                        'type' => 'typography',
                        'title' => __( 'Heading 5 Style', 'commercegurus' ),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( 'h5', '.content-area h5' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px', // Defaults to px
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '700',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '19px',
                            'line-height' => '22px'
                        ),
                    ),
                    array(
                        'id' => 'opt-typography-h6',
                        'type' => 'typography',
                        'title' => __( 'Heading 6 Style', 'commercegurus' ),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( 'h6', '.content-area h6' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px',
                        //'units'         => array('px', 'em'), // Defaults to px
                        //'units_extended' => true,
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#222',
                            'font-weight' => '600',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '16px',
                            'line-height' => '20px'
                        ),
                    ),
                    array(
                        'id' => 'cg-type-widget-title',
                        'type' => 'typography',
                        'title' => __( 'Widget Title Typeface', 'commercegurus' ),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        'text-transform' => true,
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( 'h4.widget-title' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px',
                        //'units'         => array('px', 'em'), // Defaults to px
                        //'units_extended' => true,
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#333',
                            'font-weight' => '400',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '16px',
                            'line-height' => '20px',
                            'text-transform' => 'uppercase',
                        ),
                    ),
                ),
            );

            $this->sections[] = array(
                'title' => __( 'Blog settings', 'commercegurus' ),
                'desc' => __( 'Manage your blog settings.', 'commercegurus' ),
                'icon' => 'el-icon-file-edit',
                'fields' => array(
                    array(
                        'id' => 'cg_blog_page_title',
                        'type' => 'text',
                        'title' => 'Blog Page Title',
                        'default' => 'Blog',
                    ),
                    array(
                        'desc' => 'Blog thumbnails',
                        'id' => 'cg_blog_images',
                        'type' => 'select',
                        'options' => array(
                            'default' => 'Default - above blog post',
                            'right' => 'Right Thumbnail',
                            'left' => 'Left Thumbnail',
                        ),
                        'title' => __( 'Which layout would like for your blog thumbnails?', 'commercegurus' ),
                        'default' => 'default',
                    ),
                    array(
                        'desc' => __( 'Blog sidebar', 'commercegurus' ),
                        'id' => 'cg_blog_sidebar',
                        'type' => 'select',
                        'options' => array(
                            'default' => 'Default - left sidebar',
                            'right' => 'Right sidebar',
                            'none' => 'No sidebar',
                        ),
                        'title' => __( 'Where would you like your blog sidebar to appear?', 'commercegurus' ),
                        'default' => 'default',
                    ),
                ),
            );

            $this->sections[] = array(
                'title' => __( 'WooCommerce General Settings', 'commercegurus' ),
                'desc' => __( 'Global shop settings.', 'commercegurus' ),
                'icon' => ' el-icon-shopping-cart',
                'fields' => array(
                    array(
                        'title' => __( 'Catalog Mode', 'commercegurus' ),
                        'desc' => __( 'Enabling catalog mode will hide the shopping cart and add to cart options.', 'commercegurus' ),
                        'id' => 'cg_catalog_mode',
                        'type' => 'select',
                        'options' => array(
                            'enabled' => 'Enable',
                            'disabled' => 'Disable',
                        ),
                        'default' => 'disabled',
                    ),
                    array(
                        'title' => __( 'Hide Prices?', 'commercegurus' ),
                        'desc' => __( 'Select if you would like to hide prices? Note: Catalog mode must also be enabled if you wish to hide prices.', 'commercegurus' ),
                        'id' => 'cg_hide_prices',
                        'type' => 'select',
                        'options' => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'default' => 'no',
                    ),
                    array(
                        'title' => __( 'Hide Categories?', 'commercegurus' ),
                        'desc' => __( 'Select if you would like to hide categories from the main product display loop?', 'commercegurus' ),
                        'id' => 'cg_hide_categories',
                        'type' => 'select',
                        'options' => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'default' => 'no',
                    ),
                    array(
                        'id' => 'cg_show_credit_cards',
                        'type' => 'button_set',
                        'title' => __( 'Show/hide credit cards?', 'commercegurus' ),
                        'subtitle' => __( 'Do you wish to show images of credit cards you accept?', 'commercegurus' ),
                        'desc' => __( 'This credit card images will appear in your bottom footer in the right hand side.', 'commercegurus' ),
                        //Must provide key => value pairs for radio options
                        'options' => array(
                            'show' => 'Show',
                            'hide' => 'Hide',
                        ),
                        'default' => 'show'
                    ),
                    array(
                        'title' => __( 'Select credit cards to display', 'commercegurus' ),
                        'desc' => __( 'You can show/hide any of the 4 card types below. You can also change the order using drag and drop.', 'commercegurus' ),
                        'id' => 'cg_show_credit_card_values',
                        'type' => 'sortable',
                        'mode' => 'checkbox',
                        'options' => array(
                            '1' => 'Visa',
                            '2' => 'Mastercard',
                            '3' => 'Paypal',
                            '4' => 'Amex',
                        ),
                        'default' => array(
                            '1' => true,
                            '2' => true,
                            '3' => true,
                            '4' => true,
                        ),
                    ),
                ),
            );

            $this->sections[] = array(
                'title' => __( 'WooCommerce Product Details', 'commercegurus' ),
                'desc' => __( 'Manage product details page settings.', 'commercegurus' ),
                'icon' => ' el-icon-shopping-cart-sign',
                'fields' => array(
                    array(
                        'id' => 'upsell_title',
                        'type' => 'text',
                        'title' => __( 'Up-sell title', 'commercegurus' ),
                        'default' => __( 'Complete the collection', 'commercegurus' ),
                    ),
                    array(
                        'id' => 'cg_wc_lightbox',
                        'type' => 'select',
                        'options' => array(
                            'yes' => __( 'Yes', 'commercegurus' ),
                            'no' => __( 'No', 'commercegurus' ),
                        ),
                        'title' => __( 'Enable custom lightbox', 'commercegurus' ),
                        'default' => 'yes',
                    ), 
                    array(
                        'id' => 'wc_product_sidebar',
                        'type' => 'select',
                        'options' => array(
                            'wc_product_no_sidebar' => 'None',
                            'wc_product_left_sidebar' => 'Sidebar on the left',
                            'wc_product_right_sidebar' => 'Sidebar on the right',
                        ),
                        'title' => __( 'Product Sidebar Position', 'commercegurus' ),
                        'default' => 'no_sidebar',
                    ),
                    array(
                        'id' => 'wc_chosen_variation',
                        'type' => 'select',
                        'options' => array(
                            'wc_chosen_variation_disabled' => 'Disabled',
                            'wc_chosen_variation_enabled' => 'Enabled',
                        ),
                        'title' => __( 'Enhanced Variation Dropdown styling enabled?', 'commercegurus' ),
                        'default' => 'wc_chosen_variation_enabled',
                    ),            
                    array(
                        'id' => 'wc_product_sku',
                        'type' => 'select',
                        'options' => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'title' => __( 'Display the Product SKU?', 'commercegurus' ),
                        'default' => 'yes',
                    ),
                    array(
                        'id' => 'product_size_guide_title',
                        'type' => 'text',
                        'title' => __( 'Size Guide Title', 'commercegurus' ),
                    ),
                    array(
                        'desc' => __( 'Upload your size guide images here.', 'commercegurus' ),
                        'id' => 'product_size_guide',
                        'type' => 'media',
                        'title' => __( 'Size Guide', 'commercegurus' ),
                        'url' => true,
                    ),
                    array(
                        'id' => 'product_share_icons',
                        'type' => 'select',
                        'options' => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'title' => __( 'Display social sharing icons?', 'commercegurus' ),
                        'default' => 'yes',
                    ),
                    array(
                        'id' => 'returns_tab_title',
                        'type' => 'text',
                        'title' => __( 'Delivery and Returns tab title', 'commercegurus' ),
                        'default' => 'Delivery and Returns Information',
                    ),
                    array(
                        'id' => 'returns_tab_content',
                        'type' => 'textarea',
                        'desc' => __( 'Add your delivery and returns content here.', 'commercegurus' ),
                        'title' => __( 'Delivery and Returns tab content', 'commercegurus' ),
                        'default' => 'Delivery and Returns Content description.',
                    ),
                ),
            );

            $this->sections[] = array(
                'title' => __( 'WooCommerce Product Listings', 'commercegurus' ),
                'desc' => __( 'Manage product listing page settings.', 'commercegurus' ),
                'icon' => '  el-icon-list-alt',
                'fields' => array(
                    array(
                        'desc' => __( 'Select sidebar position for product listing pages.', 'commercegurus' ),
                        'id' => 'product_listing_sidebar',
                        'type' => 'select',
                        'options' => array(
                            'none' => 'No sidebar',
                            'left-sidebar' => 'Sidebar on the left',
                            'right-sidebar' => 'Sidebar on the right',
                        ),
                        'title' => __( 'Product listing sidebar position', 'commercegurus' ),
                        'default' => 'left-sidebar',
                    ),
                    array(
                        'desc'       => __( 'Select product loop', 'commercegurus' ),
                        'id'         => 'cg_product_loop_type',
                        'type'       => 'select',
                        'options'    => array(
                            'adrenalin'       => __( 'Adrenalin product loop', 'commercegurus' ),
                            'default'       => __( 'Default WooCommerce product loop', 'commercegurus' ),
                        ),
                        'title'      => __( 'Product listing product loop', 'commercegurus' ),
                        'default'    => 'adrenalin',
                    ),
                    array(
                        'desc' => __( 'Select which type of layout you prefer for your product listings.', 'commercegurus' ),
                        'id' => 'product_layout',
                        'type' => 'select',
                        'options' => array(
                            'grid-layout' => 'Grid Layout',
                            'list-layout' => 'List Layout',
                        ),
                        'title' => __( 'Grid or List Layout', 'commercegurus' ),
                        'default' => 'grid-layout',
                    ),
                    array(
                        'desc' => __( 'Change the number of products per row for product listing pages.', 'commercegurus' ),
                        'id' => 'product_grid_count',
                        'type' => 'select',
                        'options' => array(
                            2 => '2',
                            3 => '3',
                            4 => '4',
                            5 => '5',
                            6 => '6',
                            7 => '7',
                            8 => '8',
                            9 => '9',
                        ),
                        'title' => __( 'Number of products per row', 'commercegurus' ),
                        'default' => '4',
                    ),
                    array(
                        'id' => 'products_page_count',
                        'desc' => __( 'Number of products per page on product listings pages.', 'commercegurus' ),
                        'type' => 'text',
                        'title' => __( 'Products per page', 'commercegurus' ),
                        'default' => '12',
                    ),
                    array(
                        'desc' => __( 'Enable or disable product thumbnail flip.', 'commercegurus' ),
                        'id' => 'cg_product_thumb_flip',
                        'type' => 'select',
                        'options' => array(
                            'enabled' => 'Enabled',
                            'disabled' => 'Disabled',
                        ),
                        'title' => __( 'Product Thumbnail Flip', 'commercegurus' ),
                        'default' => 'enabled',
                    ),
                    array(
                        'desc' => __( 'Enable or disable product quick view.', 'commercegurus' ),
                        'id' => 'cg_product_quick_view',
                        'type' => 'select',
                        'options' => array(
                            'enabled' => 'Enabled',
                            'disabled' => 'Disabled',
                        ),
                        'title' => __( 'Product Quick View', 'commercegurus' ),
                        'default' => 'enabled',
                    ),
                    array(
                        'desc' => __( 'Enable or disable shop announcements that appear at the top of your product listings pages.', 'commercegurus' ),
                        'id' => 'cg_shop_announcements',
                        'type' => 'select',
                        'options' => array(
                            'enabled' => 'Enabled',
                            'disabled' => 'Disabled',
                        ),
                        'title' => __( 'Shop Announcements', 'commercegurus' ),
                        'default' => 'enabled',
                    ),
                    array(
                        'id' => 'cg_product_loop_price_font',
                        'type' => 'typography',
                        'title' => __( 'Price Typeface', 'commercegurus' ),
                        'text-transform' => true,
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        'line-height' => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        'color' => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( '.cg-product-info .amount' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px', // Defaults to px
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            //    'color' => '#DF440B',
                            'font-weight' => '400',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '16px',
                            'text-transform' => 'uppercase',
                        ),
                    ),
                    array(
                        'id' => 'cg_product_loop_price_sale_font',
                        'type' => 'typography',
                        'title' => __( 'Price Sale Typeface', 'commercegurus' ),
                        'text-transform' => true,
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup' => true, // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        //'subsets'       => false, // Only appears if google is true and subsets not set to false
                        //'font-size'     => false,
                        'line-height' => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles' => true, // Enable all Google Font style/weight variations to be added to the page
                        'output' => array( '.cg-product-info .price del span.amount' ), // An array of CSS selectors to apply this font style to dynamically
                        'units' => 'px', // Defaults to px
                        'subtitle' => __( 'Typography option with each property can be called individually.', 'commercegurus' ),
                        'default' => array(
                            'color' => '#999',
                            'font-weight' => '400',
                            'font-family' => 'Roboto Condensed',
                            'google' => true,
                            'font-size' => '14px',
                            'text-transform' => 'uppercase',
                        ),
                    ),
                    array(
                        'id' => 'cg_product_loop_cart_button_color',
                        'type' => 'color',
                        'title' => __( 'Add to cart button color', 'commercegurus' ),
                        'subtitle' => __( 'Select the color for your Add to Cart button.', 'commercegurus' ),
                        'default' => '#FFFFFF',
                    ),
                    array(
                        'id' => 'cg_product_loop_cart_button_text_color',
                        'type' => 'color',
                        'title' => __( 'Add to cart button text color', 'commercegurus' ),
                        'subtitle' => __( 'Select the color for your Add to Cart button text.', 'commercegurus' ),
                        'default' => '#B2B2B2',
                    ),
                ),
            );

            $this->sections[] = array(
                'title' => __( 'Custom code', 'commercegurus' ),
                'desc' => __( 'Add some custom code.', 'commercegurus' ),
                'fields' => array(
                    array(
                        'title' => __( 'Custom CSS', 'commercegurus' ),
                        'desc' => __( 'Add some custom css to your site?', 'commercegurus' ),
                        'id' => 'cg_custom_css',
                        'type' => 'ace_editor',
                        'mode' => 'css',
                        'theme' => 'monokai'
                    ),
                ),
            );
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-help-tab-1',
                'title' => __( 'Theme Information 1', 'commercegurus' ),
                'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
            );

            $this->args['help_tabs'][] = array(
                'id' => 'redux-help-tab-2',
                'title' => __( 'Theme Information 2', 'redux-framework-demo' ),
                'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
        }

        /**
         * Redux config
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire

                'opt_name' => 'cg_reduxopt', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get( 'Name' ), // Name that appears at the top of your panel
                'display_version' => $theme->get( 'Version' ), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __( 'Theme Options', 'commercegurus' ),
                'page_title' => __( 'Theme Options', 'commercegurus' ),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyB9TDy0IOriQpR8gt2TmoaZ070oWgIhvcs', // Must be defined to add google fonts to the typography module
                'async_typography' => false, // Use a asynchronous font on the front end or font string
                'admin_bar' => true, // Show the panel pages on the admin bar
                'global_variable' => 'cg_options', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => 'cg_reduxopt', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '*', // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true, // Shows the Import/Export panel when not used as a field.
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                'footer_credit' => false, // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false, // REMOVE
                // HINTS
                'hints' => array(
                    'icon' => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'light',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => '',
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
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


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            //$this->args[ 'share_icons' ][] = array(
            //    'url' => 'https://github.com/ReduxFramework/ReduxFramework',
            //    'title' => 'Visit us on GitHub',
            //    'icon' => 'el-icon-github'
            //    //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            //);
            //$this->args[ 'share_icons' ][] = array(
            //    'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
            //    'title' => 'Like us on Facebook',
            //    'icon' => 'el-icon-facebook'
            //);
            $this->args['share_icons'][] = array(
                'url' => 'http://twitter.com/commercegurus',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );
            //$this->args[ 'share_icons' ][] = array(
            //    'url' => 'http://www.linkedin.com/company/redux-framework',
            //    'title' => 'Find us on LinkedIn',
            //    'icon' => 'el-icon-linkedin'
            //);
            // Panel Intro text -> before the form
            if ( !isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                if ( !empty( $this->args['global_variable'] ) ) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace( '-', '_', $this->args['opt_name'] );
                }
                //$this->args[ 'intro_text' ] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
            } else {
                //$this->args[ 'intro_text' ] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
            }

            // Add content after the form.
            //$this->args[ 'footer_text' ] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );
        }

    }

    global $reduxConfig;
    $reduxConfig = new redux_theme_Redux_Framework_config();
}

/**
 * Custom function for the callback referenced above
 */
if ( !function_exists( 'redux_theme_my_custom_field' ) ):

    function redux_theme_my_custom_field( $field, $value ) {
        print_r( $field );
        echo '<br/>';
        print_r( $value );
    }

endif;

/**
 * Custom function for the callback validation referenced above
 * */
if ( !function_exists( 'redux_theme_validate_callback_function' ) ):

    function redux_theme_validate_callback_function( $field, $value, $existing_value ) {
        $error = false;
        $value = 'just testing';

        /*
          do your validation

          if(something) {
          $value = $value;
          } elseif(something else) {
          $error = true;
          $value = $existing_value;
          $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ( $error == true ) {
            $return['error'] = $field;
        }
        return $return;
    }



endif;