<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    if(!function_exists('et_redux_init')) {
        function et_redux_init() {
            // This is your option name where all the Redux data is stored.
            $opt_name = "et_options";

            /*
             *
             * --> Action hook examples
             *
             */


            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

            // Dynamically add a section. Can be also used to modify sections/fields
            //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');


            /**
             * ---> SET ARGUMENTS
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'             => $opt_name,
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'         => ET_THEME_NAME . ' <span>' . __('8theme WordPress Theme', ET_DOMAIN) .'</span>',
                // Name that appears at the top of your panel
                'display_version'      => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'            => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'       => true,
                // Show the sections below the admin menu item or not
                'menu_title'           => __( '8Theme Options', 'redux-framework-demo' ),
                'page_title'           => __( '8Theme Options', 'redux-framework-demo' ),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'       => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography'     => false,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'            => false,
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
                'customizer'           => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'        => 63,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'          => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'     => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'            => ET_CODE_IMAGES . 'icon-etheme.png',
                // Specify a custom URL to an icon
                'last_tab'             => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'            => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'            => '_options',
                // Page slug used to denote the panel
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
                'footer_credit'     => '8theme',                   // Disable the footer credit of Redux. Please leave if you can help it.


                'templates_path' => ET_BASE . ET_CODE_3D . 'options-framework/et-templates/',

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'             => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'          => false,
                // REMOVE

                //'compiler'             => true,

                // HINTS
                'hints'                => array(
                    'icon'          => 'el el-question-sign',
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
            $args['admin_bar_links'][] = array(
                'id'    => 'redux-docs',
                'href'  => 'http://docs.reduxframework.com/',
                'title' => __( 'Documentation', 'redux-framework-demo' ),
            );

            $args['admin_bar_links'][] = array(
                //'id'    => 'redux-support',
                'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
                'title' => __( 'Support', 'redux-framework-demo' ),
            );

            $args['admin_bar_links'][] = array(
                'id'    => 'redux-extensions',
                'href'  => 'reduxframework.com/extensions',
                'title' => __( 'Extensions', 'redux-framework-demo' ),
            );

            
            Redux::setArgs( $opt_name, $args );

            /*
             * ---> END ARGUMENTS
             */

            /*
             *
             * ---> START SECTIONS
             *
             */

            /*

                As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


             */

            // -> START Basic Fields

            Redux::setSection( $opt_name, array(
                'title' => 'General',
                'id' => 'general',
                'icon' => 'el-icon-home',
            ) );


            Redux::setSection( $opt_name, array(
                'title' => 'Layout',
                'id' => 'general-layout',
                'subsection' => true,
                'icon' => 'el-icon-home',
                'fields' => array (
                    array (
                        'id' => 'main_layout',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Site Layout',
                        'options' => array (
                            'wide' => 'Wide layout',
                            'boxed' => 'Boxed',
                            'framed' => 'Framed',
                            'bordered' => 'Bordered',
                        ),
                        'default' => 'wide'
                    ),
                    array (
                        'id' => 'responsive',
                        'type' => 'switch',
                        'title' => 'Enable responsive design',
                        'default' => true,
                    ),
                    array (
                        'id' => 'fixed_nav',
                        'type' => 'switch',
                        'title' => 'Fixed navigation',
                        'default' => true,
                    ),
                ),
            ) );

            et_redux_header_types($opt_name);


            Redux::setSection( $opt_name, array(
                'title' => 'Header Settings',
                'id' => 'general-header-settings',
                'icon' => 'el-icon-cog',
                'subsection' => true,
                'fields' => array (
                    array (
                        'id' => 'top_bar',
                        'type' => 'switch',
                        'title' => 'Enable top bar',
                        'default' => true,
                    ),
                    array (
                        'id' => 'header_custom_block',
                        'type' => 'editor',
                        'operator' => 'and',
                        'title' => 'Header custom HTML for some variants',
                        'subtitle' => 'For variants 1, 2, 8, 10'
                    ),
                    array (
                        'id' => 'logo',
                        'type' => 'media',
                        'desc' => 'Upload image: png, jpg or gif file',
                        'operator' => 'and',
                        'title' => 'Logo image',
                    ),
                    array (
                        'id' => 'logo_fixed',
                        'type' => 'media',
                        'desc' => 'Upload image: png, jpg or gif file',
                        'operator' => 'and',
                        'title' => 'Logo image for Fixed and Responsive header',
                    ),
                    array (
                        'id' => 'favicon',
                        'type' => 'media',
                        'desc' => 'Upload image: png, jpg or gif file',
                        'operator' => 'and',
                        'title' => 'Favicon',
                    ),
                    array (
                        'id' => 'top_links',
                        'type' => 'switch',
                        'title' => 'Enable Sign In link',
                        'default' => true,
                    ),
                    array (
                        'id' => 'cart_widget',
                        'type' => 'switch',
                        'title' => 'Enable cart widget',
                        'default' => true,
                    ),
                    array (
                        'id' => 'cart_widget_design',
                        'type' => 'select',
                        'title' => 'Cart widget design',
                        'options' => array (
                            1 => 'Default',
                            2 => 'Animated',
                            3 => 'Animated white',
                        ),
                        'default' => 1
                    ),
                    array (
                        'id' => 'search_form',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Enable search form in header',
                        'default' => true,
                    ),
                    array (
                        'id' => 'search_view',
                        'type' => 'select',
                        'title' => 'Search view',
                        'options' => array (
                            'modal' => 'Modal',
                            'dropdown' => 'Dropdown',
                        ),
                        'default' => 'modal',
                    ),
                    array (
                        'id' => 'breadcrumb_type',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Breadcrumbs Style',
                        'options' => array (
                            'default' => 'Default',
                            2 => 'Default left',
                            3 => 'With title',
                            4 => 'With title left',
                            5 => 'Parallax',
                            6 => 'Parallax left',
                            7 => 'With animation',
                            8 => 'Background large',
                            9 => 'Disable',
                        ),
                        'default' => 'default'
                    ),
                    array (
                        'id' => 'breadcrumb_bg',
                        'type' => 'background',
                        'operator' => 'and',
                        'title' => 'Breadcrumbs background',
                    ),
                ),
            ) );


            Redux::setSection( $opt_name, array(
                'title' => 'Footer',
                'id' => 'general-footer',
                'subsection' => true,
                'icon' => 'el-icon-cog',
                'fields' => array (
                    array (
                        'id' => 'footer_demo',
                        'type' => 'switch',
                        'title' => 'Show footer demo blocks',
                        'desc' => 'Will be shown if footer sidebars are empty',
                        'default' => true,
                    ),
                    array (
                        'id' => 'to_top',
                        'type' => 'switch',
                        'title' => '"Back To Top" button',
                        'default' => true,
                    ),
                    array (
                        'id' => 'to_top_mobile',
                        'type' => 'switch',
                        'title' => '"Back To Top" button on mobile',
                        'default' => true,
                    ),
                ),
            ));


            Redux::setSection( $opt_name, array(
                'title' => 'Contact Form',
                'id' => 'general-contact_form',
                'subsection' => true,
                'icon' => 'el-icon-address-book',
                'fields' => array (
                    array (
                        'id' => 'contacts_email',
                        'type' => 'text',
                        'operator' => 'and',
                        'title' => 'Your email for contact form',
                    ),
                ),
            ));

            Redux::setSection( $opt_name, array(
                'title' => 'Extra Styles',
                'id' => 'extra-styles',
                'subsection' => true,
                'icon' => 'el-icon-home',
                'fields' => array (
                    array (
                        'id' => 'ult_style',
                        'type' => 'switch',
                        'title' => 'Ultimate Addons for VC',
                        'description' => 'Enable this option if you use UA for VC in Footer/Sidebar',
                        'default' => false,
                    ),
                ),
            ) );


            Redux::setSection( $opt_name, array(
                'title' => 'Styling',
                'id' => 'style',
                'icon' => 'el-icon-picture',
            ) );


            et_redux_theme_options($opt_name);

            
            Redux::setSection( $opt_name, array(
                'title' => 'E-Commerce',
                'id' => 'shop',
                'icon' => 'el-icon-shopping-cart',
            ));

            Redux::setSection( $opt_name, array(
                'title' => 'Shop',
                'id' => 'shop-shop',
                'icon' => 'el-icon-shopping-cart',
                'subsection' => true,
                'fields' => array (
                    array (
                        'id' => 'just_catalog',
                        'type' => 'switch',
                        'description' => 'Disable "Add To Cart" button and shopping cart',
                        'operator' => 'and',
                        'title' => 'Just Catalog',
                    ),
                    array (
                        'id' => 'cats_accordion',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Enable Navigation Accordion',
                        'default' => true,
                    ),
                    array (
                        'id' => 'new_icon',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Enable "NEW" icon',
                        'default' => true,
                    ),
                    array (
                        'id' => 'out_of_icon',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Enable "Out of stock" icon',
                        'default' => true,
                    ),
                    array (
                        'id' => 'sale_icon',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Enable "Sale" icon',
                        'default' => true,
                    ),
                    array (
                        'id' => 'product_bage_banner',
                        'type' => 'editor',
                        'desc' => 'Upload image: png, jpg or gif file',
                        'operator' => 'and',
                        'title' => 'Product Page Banner',
                    ),
                    array (
                        'id' => 'empty_cart_content',
                        'type' => 'editor',
                        'operator' => 'and',
                        'title' => 'Text for empty cart',
                    ),
                    array (
                        'id' => 'register_text',
                        'type' => 'editor',
                        'title' => 'Text for registration page',
                        'default' => 'text',
                    ),
                ),
            ));


            Redux::setSection( $opt_name, array(
                'title' => 'Products Page Layout',
                'id' => 'shop-product_grid',
                'icon' => 'el-icon-view-mode',
                'subsection' => true,
                'fields' => array (
                    array (
                        'id' => 'view_mode',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Products view mode',
                        'options' => array (
                            'grid_list' => 'Grid/List',
                            'list_grid' => 'List/Grid',
                            'grid' => 'Only Grid',
                            'list' => 'Only List',
                        ),
                        'default' => 'grid_list'
                    ),
                    array (
                        'id' => 'prodcuts_per_row',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Products per row',
                        'options' => array (
                            2 => '2',
                            3 => '3',
                            4 => '4',
                            5 => '5',
                            6 => '6',
                        ),
                        'default' => 3
                    ),
                    array (
                        'id' => 'products_per_page',
                        'type' => 'text',
                        'title' => 'Products per page',
                    ),
                    array (
                        'id' => 'grid_sidebar',
                        'type' => 'image_select',
                        'desc' => 'Sidebar position',
                        'operator' => 'and',
                        'title' => 'Layout',
                        'options' => array (
                            'without' => array (
                                'alt' => 'Left Sidebar',
                                'img' => ET_CODE_IMAGES . 'layout/full-width.png',
                            ),
                            'left' => array (
                                'alt' => 'Left Sidebar',
                                'img' => ET_CODE_IMAGES . 'layout/left-sidebar.png',
                            ),
                            'right' => array (
                                'alt' => 'Right Sidebar',
                                'img' => ET_CODE_IMAGES . 'layout/right-sidebar.png',
                            ),
                        ),
                        'default' => 'left'
                    ),
                    array (
                        'id' => 'shop_full_width',
                        'type' => 'switch',
                        'title' => 'Full width',
                    ),
                    array (
                        'id' => 'product_img_hover',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Product Image Hover',
                        'options' => array (
                            'disable' => 'Disable',
                            'default-light' => 'Default light',
                            'default-dark' => 'Default dark',
                            'swap' => 'Swap',
                            'slider' => 'Images Slider',
                            'mask' => 'Mask with information',
                        ),
                        'default' => 'default-light',
                    ),
                    array (
                        'id' => 'product_page_productname',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Show product name',
                        'default' => true,
                    ),
                    array (
                        'id' => 'product_page_cats',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Show product categories',
                    ),
                    array (
                        'id' => 'product_page_price',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Show Price',
                        'default' => true,
                    ),
                    array (
                        'id' => 'product_page_addtocart',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Show "Add to cart" button',
                        'default' => true,
                    ),
                ),
            ));


            Redux::setSection( $opt_name, array(
                'title' => 'Single Product Page',
                'id' => 'shop-single_product',
                'subsection' => true,
                'icon' => 'el-icon-indent-left',
                'fields' => array (
                    array (
                        'id' => 'single_sidebar',
                        'type' => 'image_select',
                        'operator' => 'and',
                        'title' => 'Sidebar position',
                        'options' => array (
                            'without' => array (
                                'alt' => 'Without Sidebar',
                                'img' => ET_CODE_IMAGES . 'layout/full-width.png',
                            ),
                            'left' => array (
                                'alt' => 'Left Sidebar',
                                'img' => ET_CODE_IMAGES . 'layout/left-sidebar.png',
                            ),
                            'right' => array (
                                'alt' => 'Right Sidebar',
                                'img' => ET_CODE_IMAGES . 'layout/right-sidebar.png',
                            ),
                        ),
                        'default' => 'right'
                    ),
                    array (
                        'id' => 'single_layout',
                        'type' => 'image_select',
                        'operator' => 'and',
                        'title' => 'Page Layout',
                        'options' => array (
                            'small' => array (
                                'alt' => 'Small',
                                'img' => ET_CODE_IMAGES . 'layout/product-small.png',
                            ),
                            'default' => array (
                                'alt' => 'Default',
                                'img' => ET_CODE_IMAGES . 'layout/product-medium.png',
                            ),
                            'large' => array (
                                'alt' => 'Large',
                                'img' => ET_CODE_IMAGES . 'layout/product-large.png',
                            ),
                            'fixed' => array (
                                'alt' => 'Fixed content',
                                'img' => ET_CODE_IMAGES . 'layout/product-fixed.png',
                            ),
                        ),
                        'default' => 'default'
                    ),
                    array (
                        'id' => 'product_name_signle',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Show product name above the price',
                        'default' => true,
                    ),
                    array (
                        'id' => 'upsell_location',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Location of upsell products',
                        'options' => array (
                            'sidebar' => 'Sidebar',
                            'after_content' => 'After content',
                        ),
                    ),
                    array (
                        'id' => 'show_related',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Display related products',
                        'default' => true,
                    ),
                    array (
                        'id' => 'ajax_addtocart',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'AJAX "Add To Cart"',
                        'default' => true,
                    ),
                    array (
                        'id' => 'gallery_lightbox',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Enable Lightbox for Product Images',
                        'default' => true,
                    ),
                    array (
                        'id' => 'images_slider',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Enable slider for gallery images',
                        'default' => true,
                    ),                    
                    array (
                        'id' => 'share_icons',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Show share buttons',
                        'default' => true,
                    ),
                    array (
                        'id' => 'zoom_effect',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Zoom effect',
                        'options' => array (
                            'disable' => 'Disable',
                            'lens' => 'Lens',
                            'window' => 'Window',
                        ),
                        'default' => 'window'
                    ),
                    array (
                        'id' => 'tabs_location',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Location of product tabs',
                        'options' => array (
                            'after_image' => 'Next to image',
                            'after_content' => 'Under content',
                        ),
                        'default' => 'after_content'
                    ),
                    array (
                        'id' => 'tabs_type',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Tabs type',
                        'options' => array (
                            'tabs-default' => 'Default',
                            'left-bar' => 'Left Bar',
                            'right-bar' => 'Right Bar',
                            'accordion' => 'Accordion',
                            'disable' => 'Disable',
                        ),
                        'default' => 'tabs-default'
                    ),
                    array (
                        'id' => 'reviews_position',
                        'type' => 'select',
                        'title' => 'Reviews position',
                        'options' => array (
                            'tabs' => 'Tabs',
                            'outside' => 'Next to tabs',
                        ),
                        'default' => 'tabs'
                    ),
                    array (
                        'id' => 'custom_tab_title',
                        'type' => 'text',
                        'operator' => 'and',
                        'title' => 'Custom Tab Title',
                    ),
                    array (
                        'id' => 'custom_tab',
                        'type' => 'editor',
                        'desc' => 'Enter custom content you would like to output to the product custom tab (for all products)',
                        'operator' => 'and',
                        'title' => 'Return',
                    ),
                ),
            ));


            Redux::setSection( $opt_name, array(
                'title' => 'Quick View',
                'id' => 'shop-quick_view',
                'subsection' => true,
                'icon' => 'el-icon-zoom-in',
                'fields' => array (
                    array (
                        'id' => 'quick_view',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Enable Quick View',
                        'default' => true,
                    ),
                    array (
                        'id' => 'quick_images',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Product images',
                        'options' => array (
                            'none' => 'None',
                            'slider' => 'Slider',
                            'single' => 'Single',
                        ),
                        'default' => 'slider'
                    ),
                    array (
                        'id' => 'quick_product_name',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Product name',
                        'default' => true,
                    ),
                    array (
                        'id' => 'quick_price',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Price',
                        'default' => true,
                    ),
                    array (
                        'id' => 'quick_rating',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Product star rating',
                        'default' => true,
                    ),
                    array (
                        'id' => 'quick_descr',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Short description',
                        'default' => true,
                    ),
                    array (
                        'id' => 'quick_add_to_cart',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Add to cart',
                        'default' => true,
                    ),
                    array (
                        'id' => 'quick_share',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Share icons',
                        'default' => true,
                    ),
                    array (
                        'id' => 'product_link',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Product link',
                        'default' => true,
                    ),
                    
                ),
            ));



            Redux::setSection( $opt_name, array(
                'title' => 'Promo Popup',
                'id' => 'shop-promo_popup',
                'subsection' => true,
                'icon' => 'el-icon-tag',
                'fields' => array (
                    array (
                        'id' => 'promo_popup',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Enable promo popup',
                        'default' => true,
                    ),
                    array (
                        'id' => 'promo_auto_open',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Open popup on enter',
                    ),
                    array (
                        'id' => 'promo_link',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Show link in the top bar',
                        'default' => true,
                    ),
                    array (
                        'id' => 'promo-link-text',
                        'type' => 'text',
                        'title' => 'Promo link text',
                        'default' => 'Newsletter',
                    ),
                    array (
                        'id' => 'pp_content',
                        'type' => 'editor',
                        'operator' => 'and',
                        'title' => 'Popup content',
                    ),
                    array (
                        'id' => 'pp_width',
                        'type' => 'text',
                        'operator' => 'and',
                        'title' => 'Popup width',
                    ),
                    array (
                        'id' => 'pp_height',
                        'type' => 'text',
                        'operator' => 'and',
                        'title' => 'Popup height',
                    ),
                    array (
                        'id' => 'pp_bg',
                        'type' => 'background',
                        'operator' => 'and',
                        'title' => 'Popup background',
                    ),
                ),
            ));


            
            Redux::setSection( $opt_name, array(
                'title' => 'Blog & Portfolio',
                'id' => 'blog',
                'icon' => 'el-icon-wordpress',
            ));

            Redux::setSection( $opt_name, array(
                'title' => 'Blog Layout',
                'id' => 'blog-blog_page',
                'subsection' => true,
                'icon' => 'el-icon-wordpress',
                'fields' => array (
                    array (
                        'id' => 'blog_layout',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Blog Layout',
                        'options' => array (
                            'default' => 'Default',
                            'grid' => 'Grid',
                            'timeline' => 'Timeline',
                            'small' => 'Small',
                            'mosaic' => 'Mosaic',
                        ),
                        'default' => 'default',
                    ),
                    array (
                        'id' => 'blog_columns',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Columns (for mosaic and grid layouts)',
                        'options' => array (
                            2 => '2',
                            3 => '3',
                            4 => '4',
                        ),
                        'default' => 3,
                    ),
                    array (
                        'id' => 'blog_full_width',
                        'type' => 'switch',
                        'title' => 'Full width',
                        'subtitle' => 'Only for mosaic design',
                    ),
                    array (
                        'id' => 'blog_byline',
                        'type' => 'switch',
                        'title' => 'Show "byline" on the blog',
                        'default' => true,
                    ),
                    array (
                        'id' => 'blog_featured_image',
                        'type' => 'switch',
                        'title' => 'Display featured image on single post',
                        'default' => true,
                    ),
                    array (
                        'id' => 'posts_links',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Show Previous and Next posts links',
                        'default' => true,
                    ),
                    array (
                        'id' => 'post_share',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Show Share buttons',
                        'default' => true,
                    ),
                    array (
                        'id' => 'about_author',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Show About Author block',
                        'default' => true,
                    ),
                    array (
                        'id' => 'post_related',
                        'type' => 'switch',
                        'operator' => 'and',
                        'title' => 'Show Related posts',
                        'default' => true,
                    ),
                    array (
                        'id' => 'excerpt_length',
                        'type' => 'text',
                        'title' => 'Excerpt length (words)',
                        'default' => '55'
                    ),
                    array (
                        'id' => 'blog_sidebar',
                        'type' => 'image_select',
                        'operator' => 'and',
                        'title' => 'Sidebar position',
                        'options' => array (
                            'without' => array (
                                'alt' => 'Without Sidebar',
                                'img' => ET_CODE_IMAGES . 'layout/full-width.png',
                            ),
                            'left' => array (
                                'alt' => 'Left Sidebar',
                                'img' => ET_CODE_IMAGES . 'layout/left-sidebar.png',
                            ),
                            'right' => array (
                                'alt' => 'Right Sidebar',
                                'img' => ET_CODE_IMAGES . 'layout/right-sidebar.png',
                            ),
                        ),
                        'default' => 'right'
                    ),
                ),
            ));



            Redux::setSection( $opt_name, array(
                'title' => 'Portfolio',
                'id' => 'blog-portfolioo',
                'subsection' => true,
                'icon' => 'el-icon-briefcase',
                'fields' => array (
                    array (
                        'id' => 'portfolio_count',
                        'type' => 'text',
                        'desc' => 'Use -1 to show all items',
                        'operator' => 'and',
                        'title' => 'Items per page',
                    ),
                    array (
                        'id' => 'portfolio_columns',
                        'type' => 'select',
                        'operator' => 'and',
                        'title' => 'Columns',
                        'options' => array (
                            2 => '2',
                            3 => '3',
                            4 => '4',
                        ),
                        'default' => 3
                    ),
                ),
            ));
            
            Redux::setSection( $opt_name, array(
                'title' => 'Import / Export',
                'id' => 'import',
                'icon'   => 'el-icon-refresh',
            ));


            et_redux_theme_options_dummy($opt_name);

            Redux::setSection( $opt_name, array(
                'title'  => __( 'Options', 'redux-framework-demo' ),
                'desc'   => __( 'Import and Export your theme settings from file, text or URL.', 'redux-framework-demo' ),
                'id' => 'import-export',
                'subsection' => true,
                'icon'   => 'el-icon-refresh',
                'fields' => array(
                    array(
                        'id'         => 'opt-import-export',
                        'type'       => 'import_export',
                        'title'      => 'Import Export',
                        'subtitle'   => 'Save and restore your theme options',
                        'full_width' => false,
                    ),
                ),
            ));


            /*
             * <--- END SECTIONS
             */
        }

        add_action( 'after_setup_theme', 'et_redux_init', 1 );
    }


    // If Redux is running as a plugin, this will remove the demo notice and links
    add_action( 'redux/loaded', 'remove_demo' );
    
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


    