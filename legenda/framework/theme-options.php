<?php
/**
 * Initialize the options before anything else.
 */
add_action( 'init', 'custom_theme_options', 1 );

/**
 * Build the custom settings & update OptionTree.
 */
if (!function_exists('custom_theme_options')) {
    function custom_theme_options($return = false) {

        /**
       * Get a copy of the saved settings array.
       */
      $saved_settings = get_option( 'option_tree_settings', array() );


      /**
       * Custom settings array that will eventually be
       * passes to the OptionTree Settings API Class.
       */

       $sections = array(
            array(
                'id'       => 'general',
                'title'    => __('General', ETHEME_DOMAIN),
                'icon'     => 'icon-cog'
            ),
            array(
                'id'       => 'color_scheme',
                'title'    => __('Color Scheme', ETHEME_DOMAIN),
                'icon'     => 'icon-picture'
            ),
            array(
                'id'       => 'typography',
                'title'    => __('Typography', ETHEME_DOMAIN),
                'icon'     => 'icon-text-height'
            ),
            array(
                'id'       => 'header',
                'title'    => __('Header', ETHEME_DOMAIN),
                'icon'     => 'icon-cogs'
            ),
            array(
                'id'       => 'footer',
                'title'    => __('Footer', ETHEME_DOMAIN),
                'icon'     => 'icon-cogs'
            ),
            array(
                'id'       => 'shop',
                'title'    => __('Shop', ETHEME_DOMAIN),
                'icon'     => 'icon-shopping-cart'
            ),
            array(
                'id'       => 'product_grid',
                'title'    => __('Products Page Layout', ETHEME_DOMAIN),
                'icon'     => 'icon-th'
            ),
            array(
                'id'       => 'single_product',
                'title'    => __('Single Product Page', ETHEME_DOMAIN),
                'icon'     => 'icon-file-alt'
            ),
            array(
                'id'       => 'quick_view',
                'title'    => __('Quick View', ETHEME_DOMAIN),
                'icon'     => 'icon-rocket'
            ),
            array(
                'id'       => 'search',
                'title'    => __('AJAX Search', ETHEME_DOMAIN),
                'icon'     => 'icon-search'
            ),
            array(
                'id'       => 'promo_popup',
                'title'    => __('Promo Popup', ETHEME_DOMAIN),
                'icon'     => 'icon-gift'
            ),
            array(
                'id'       => 'blog_page',
                'title'    => __('Blog Layout', ETHEME_DOMAIN),
                'icon'     => 'icon-indent-right'
            ),
            array(
                'id'       => 'portfolio',
                'title'    => __('Portfolio', ETHEME_DOMAIN),
                'icon'     => 'icon-briefcase'
            ),
            array(
                'id'       => 'contact_form',
                'title'    => __('Contact Form', ETHEME_DOMAIN),
                'icon'     => 'icon-envelope'
            ),
            array(
                'id'       => 'responsive',
                'title'    => __('Responsive', ETHEME_DOMAIN),
                'icon'     => 'icon-mobile-phone'
            ),
            array(
                'id'       => 'custom_css',
                'title'    => __('Custom CSS', ETHEME_DOMAIN),
                'icon'     => 'icon-paper-clip'
            ),
            array(
                'id'       => 'backup',
                'title'    => __('Import/Export', ETHEME_DOMAIN),
                'icon'     => 'icon-cog'
            )
       );

       $settings = array(
            array(
                'id'          => 'main_layout',
                'label'       => __('Site Layout', ETHEME_DOMAIN),
                'default'     => 'wide',
                'type'        => 'select',
                'section'     => 'general',
                'choices'     => array(
                  array(
                    'value' => 'wide',
                    'label' => __('Wide', ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'boxed',
                    'label' => __('Boxed' , ETHEME_DOMAIN)
                  )
                )
            ),
            array(
                'id'          => 'to_top',
                'label'       => __('"Back To Top" button', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'fixed_nav',
                'label'       => __('Fixed navigation', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'nice_scroll',
                'label'       => __('Nice Scroll', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            /*
            array(
                'id'          => 'fade_animation',
                'label'       => 'Enable fade animation for header and content',
                'default'     => array(
                    0 => 0
                ),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),*/
            array(
                'id'          => 'favicon_badge',
                'label'       => __('Show products in cart count on the favicon', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'mobile_loader',
                'label'       => __('Show loader on mobile', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'general',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'google_code',
                'label'       => __('Google Analytics Code', ETHEME_DOMAIN),
                'default'     => '',
                'type'        => 'textarea_simple',
                'section'     => 'general'
            ),
            // COLOR SCHEME
            array(
                'id'          => 'main_color_scheme',
                'label'       => __('Main color scheme', ETHEME_DOMAIN),
                'default'     => 'light',
                'type'        => 'select',
                'section'     => 'color_scheme',
                'choices'     => array(
                  array(
                    'value' => 'light',
                    'label' => __('Light', ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'dark',
                    'label' => __('Dark', ETHEME_DOMAIN)
                  )
                )
            ),
            array(
                'id'          => 'activecol',
                'label'       => __('Main Color', ETHEME_DOMAIN),
                'default'     => '#ed1c2e',
                'type'        => 'colorpicker',
                'section'     => 'color_scheme',
            ),
            array(
                'id'          => 'pricecolor',
                'label'       => __('Price Color', ETHEME_DOMAIN),
                'default'     => '#EE3B3B',
                'type'        => 'colorpicker',
                'section'     => 'color_scheme',
            ),
            /*
            array(
                'id'          => 'activehovercol',
                'label'       => 'Active button hover Color',
                'default'     => '#e83636',
                'type'        => 'colorpicker',
                'section'     => 'color_scheme',
            ),
            array(
                'id'          => 'footer_bg',
                'label'       => 'Footer Background Color',
                'default'     => '#222222',
                'type'        => 'colorpicker',
                'section'     => 'color_scheme',
            ),*/
            array(
                'id'          => 'background_img',
                'label'       => __('Site Background', ETHEME_DOMAIN),
                'desc'        => '',
                'default'     => '',
                'type'        => 'background',
                'section'     => 'color_scheme',
            ),
            array(
                'id'          => 'background_cover',
                'label'       => __('Background Image Expanding', ETHEME_DOMAIN),
                'default'     => '',
                'type'        => 'select',
                'section'     => 'color_scheme',
                'choices'     => array(
                  array(
                    'value' => 'enable',
                    'label' => 'enable'
                  ),
                  array(
                    'value' => 'disable',
                    'label' => 'disable'
                  )
                )
            ),
            array(
                'id'          => 'header_color_scheme',
                'label'       => __('Header color scheme (Only for transparent header type)', ETHEME_DOMAIN),
                'default'     => 'light',
                'type'        => 'select',
                'section'     => 'color_scheme',
                'choices'     => array(
                  array(
                    'value' => 'light',
                    'label' => __('Light', ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'dark',
                    'label' => __('Dark', ETHEME_DOMAIN)
                  )
                )
            ),
            array(
                'id'          => 'breadcrumb_bg',
                'label'       => 'Breadcrumbs background',
                'default'     => '',
                'type'        => 'background',
                'section'     => 'color_scheme'
            ),
            // TYPOGRAPHY
            array(
                'id'          => 'mainfont',
                'label'       => __('Main Font', ETHEME_DOMAIN),
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'sfont',
                'label'       => __('Body Font', ETHEME_DOMAIN),
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'h1',
                'label'       => 'H1',
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'h2',
                'label'       => 'H2',
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'h3',
                'label'       => 'H3',
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'h4',
                'label'       => 'H4',
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'h5',
                'label'       => 'H5',
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            array(
                'id'          => 'h6',
                'label'       => 'H6',
                'default'     => '',
                'type'        => 'typography',
                'section'     => 'typography',
            ),
            // HEADER
            array(
                'id'          => 'top_bar',
                'label'       => __('Enable top bar', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'top_panel',
                'label'       => __('Enable hidden top panel', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'header_type',
                'label'       => __('Header Type', ETHEME_DOMAIN),
                'default'     => 1,
                'type'        => 'radio-image',
                'section'     => 'header',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => 'Default',
                        'src'     => OT_URL . '/assets/images/header_v1.jpg'
                    ),
                    array(
                        'value'   => 2,
                        'label'   => 'Variant 2',
                        'src'     => OT_URL . '/assets/images/header_v2.jpg'
                    ),
                    array(
                        'value'   => 3,
                        'label'   => 'Variant 3',
                        'src'     => OT_URL . '/assets/images/header_v3.jpg'
                    ),
                    array(
                        'value'   => 4,
                        'label'   => 'Variant 4',
                        'src'     => OT_URL . '/assets/images/header_v4.jpg'
                    ),
                    array(
                        'value'   => 5,
                        'label'   => 'Variant 5',
                        'src'     => OT_URL . '/assets/images/header_v5.jpg'
                    ),
                    array(
                        'value'   => 6,
                        'label'   => 'Variant 6',
                        'src'     => OT_URL . '/assets/images/header_v6.jpg'
                    ),
                    array(
                        'value'   => 7,
                        'label'   => 'Default',
                        'src'     => OT_URL . '/assets/images/header_v7.jpg'
                    ),
                    array(
                        'value'   => 9,
                        'label'   => 'transparent',
                        'src'     => OT_URL . '/assets/images/header_v9.jpg'
                    ),
                    array(
                        'value'   => 8,
                        'label'   => 'Vertical',
                        'src'     => OT_URL . '/assets/images/header_v8.jpg'
                    ),
                )
            ),
    		/*
            array(
                'id'          => 'menu_type',
                'label'       => 'Menu Type',
                'default'     => '2',
                'type'        => 'select',
                'section'     => 'header',
                'choices'     => array(
                  array(
                    'value' => '1',
                    'label' => 'Default Menu'
                  ),
                  array(
                    'value' => '2',
                    'label' => 'Mega Menu'
                  ),
                  array(
                    'value' => '3',
                    'label' => 'Drop Down Menu'
                  ),
                  array(
                    'value' => '4',
                    'label' => 'Combined'
                  )
                )
            ),*/
            array(
                'id'          => 'languages_area',
                'label'       => __('Enable languages area', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'right_panel',
                'label'       => __('Use right side panel', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'logo',
                'label'       => __('Logo image', ETHEME_DOMAIN),
                'default'     => '',
                'desc'        => 'Upload image: png, jpg or gif file',
                'type'        => 'upload',
                'section'     => 'header'
            ),
            array(
                'id'          => 'favicon',
                'label'       => __('Favicon', ETHEME_DOMAIN),
                'default'     => '[template_url]/images/favicon.ico',
                'desc'        => __('Upload image: png, jpg or gif file',ETHEME_DOMAIN),
                'type'        => 'upload',
                'section'     => 'header'
            ),
            array(
                'id'          => 'top_links',
                'label'       => __('Enable top links (Register | Sign In)', ETHEME_DOMAIN),
                'default'     => array(
                	0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'cart_widget',
                'label'       => __('Enable cart widget', ETHEME_DOMAIN),
                'default'     => array(
                	0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'search_form',
                'label'       => __('Enable search form in header', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'wishlist_link',
                'label'       => __('Show wishlist link', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'header',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'breadcrumb_type',
                'label'       => __('Breadcrumb Type', ETHEME_DOMAIN),
                'default'     => 'default',
                'type'        => 'select',
                'section'     => 'header',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => '',
                        'label'   => __('Default', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'variant2',
                        'label'   => __('Wide block', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'without-title',
                        'label'   => __('Without title', ETHEME_DOMAIN)
                    )
                )
            ),
            // FOOTER
            array(
                'id'          => 'footer_type',
                'label'       => __('Footer Type', ETHEME_DOMAIN),
                'default'     => 1,
                'type'        => 'radio-image',
                'section'     => 'footer',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => 'Default',
                        'src'     => OT_URL . '/assets/images/footer_v1.jpg'
                    ),
                    array(
                        'value'   => 2,
                        'label'   => 'Variant 2',
                        'src'     => OT_URL . '/assets/images/footer_v2.jpg'
                    ),
                    array(
                        'value'   => 3,
                        'label'   => 'Variant 3',
                        'src'     => OT_URL . '/assets/images/footer_v3.jpg'
                    )
                )
            ),
            array(
                'id'          => 'footer_demo',
                'label'       => __('Show footer demo blocks',ETHEME_DOMAIN),
                'desc'        => __('Will be shown if footer sidebars are empty', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'footer',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            // CONTACT FORM
            array(
                'id'          => 'google_map_enable',
                'label'       => __('Enable Google Map', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'contact_form',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'contact_page_type',
                'label'       => __('Choose contact page layout', ETHEME_DOMAIN),
                'default'     => 'default',
                'type'        => 'select',
                'section'     => 'contact_form',
                'choices'     => array(
                  array(
                    'value' => 'default',
                    'label' => __('Default Layout' , ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'custom',
                    'label' => __('Custom layout' , ETHEME_DOMAIN)
                  )
                )
            ),
            array(
                'id'          => 'contacts_email',
                'label'       => __('Your email for contact form', ETHEME_DOMAIN),
                'default'     => 'test@gmail.com',
                'type'        => 'text',
                'section'     => 'contact_form'
            ),
            array(
                'id'          => 'google_map',
                'label'       => __('Longitude and Latitude for google map', ETHEME_DOMAIN),
                'desc'        => '<b>Example:</b>  51.507622,-0.1305',
                'default'     => '51.507622,-0.1305',
                'type'        => 'text',
                'section'     => 'contact_form'
            ),
            array(
                'id'          => 'google_map_api',
                'label'       => __('Google Map API', ETHEME_DOMAIN),
                'desc'        => '<b>To find your Google Map API visit <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">documentation</a></b>',
                'default'     => '124537876',
                'type'        => 'text',
                'section'     => 'contact_form'
            ),
            // SHOP
            array(
                'id'          => 'just_catalog',
                'label'       => __('Just Catalog', ETHEME_DOMAIN),
                'desc'        => __('Disable "Add To Cart" button and shopping cart', ETHEME_DOMAIN),
                'default'     => 0,
                'type'        => 'checkbox',
                'section'     => 'shop',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'checkout_page',
                'label'       => __('Checkout page', ETHEME_DOMAIN),
                'type'        => 'select',
                'section'     => 'shop',
                'default'     => 'stepbystep',
                'choices'     => array(
                  array(
                    'value' => 'stepbystep',
                    'label' => __('Step By Step' , ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'default',
                    'label' => __('Default', ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'quick',
                    'label' => __('Quick Checkout', ETHEME_DOMAIN)
                  )
                )
            ),
            array(
                'id'          => 'ajax_filter',
                'label'       => __('Enable Ajax Filter', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'shop',
                'default'     => array(
                    0 => 1
                ),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'cats_accordion',
                'label'       => __('Enable Navigation Accordion', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'shop',
                'default'     => array(
                	0 => 1
                ),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),/*
            array(
                'id'          => 'default_slider_height',
                'label'       => 'Product Sliders Height',
                'desc'        => '<b>Default: </b> 480',
                'type'        => 'text',
                'section'     => 'shop',
                'default'     => 480
            ),*/
            array(
                'id'          => 'out_of_label',
                'label'       => __('Enable "Out Of Stock" label', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'shop',
                'default'     => array(
                	0 => 1
                ),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'new_icon',
                'label'       => __('Enable "NEW" icon', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'shop',
                'default'     => array(
                	0 => 1
                ),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'new_icon_width',
                'label'       => __('"NEW" Icon width', ETHEME_DOMAIN),
                'desc'        => __('<b>Example: </b> 60', ETHEME_DOMAIN),
                'type'        => 'text',
                'section'     => 'shop',
                'default'     => 48
            ),
            array(
                'id'          => 'new_icon_height',
                'label'       => __('"NEW" Icon height', ETHEME_DOMAIN),
                'desc'        => __('<b>Example: </b> 20', ETHEME_DOMAIN),
                'type'        => 'text',
                'section'     => 'shop',
                'default'     => 48
            ),
            array(
                'id'          => 'new_icon_url',
                'label'       => __('"NEW" Icon Image', ETHEME_DOMAIN),
                'default'     => '',
                'desc'        => __('Upload image: png, jpg or gif file', ETHEME_DOMAIN),
                'type'        => 'upload',
                'section'     => 'shop'
            ),
            array(
                'id'          => 'sale_icon',
                'label'       => __('Enable "Sale" icon', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'shop',
                'default'     => array(
                	0 => 1
                ),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'sale_icon_width',
                'label'       => __('"SALE" Icon width', ETHEME_DOMAIN),
                'default'     => '',
                'desc'        => __('<b>Example: </b> 60', ETHEME_DOMAIN),
                'type'        => 'text',
                'section'     => 'shop',
                'default'     => 48
            ),
            array(
                'id'          => 'sale_icon_height',
                'label'       => __('"SALE" Icon height', ETHEME_DOMAIN),
                'default'     => '',
                'desc'        => __('<b>Example: </b> 20', ETHEME_DOMAIN),
                'type'        => 'text',
                'section'     => 'shop',
                'default'     => 48
            ),
            array(
                'id'          => 'sale_icon_url',
                'default'     => '',
                'label'       => __('"SALE" Icon Image', ETHEME_DOMAIN),
                'desc'        => __('Upload image: png, jpg or gif file', ETHEME_DOMAIN),
                'type'        => 'upload',
                'section'     => 'shop'
            ),
            array(
                'id'          => 'product_bage_banner',
                'label'       => __('Product Page Banner', ETHEME_DOMAIN),
                'default'     => '
    <p>
    <img src="[template_url]/images/assets/shop-banner.jpg" />
    </p>
                ',
                'desc'        => __('Upload image: png, jpg or gif file', ETHEME_DOMAIN),
                'type'        => 'textarea',
                'section'     => 'shop'
            ),
            array(
                'id'          => 'empty_cart_content',
                'label'       => __('Text for empty cart', ETHEME_DOMAIN),
                'default'     => __('
    <h2>Your cart is currently empty</h2>
    <p>You have not added any items in your shopping cart</p>
                ', ETHEME_DOMAIN),
                'type'        => 'textarea',
                'section'     => 'shop'
            ),
            array(
                'id'          => 'empty_category_content',
                'label'       => __('Text for empty category', ETHEME_DOMAIN),
                'default'     => __('
    <h2>No products were found</h2>
                ', ETHEME_DOMAIN),
                'type'        => 'textarea',
                'section'     => 'shop'
            ),
            array(
                'id'          => 'account_sidebar',
                'label'       => __('Enable sidebar on "My Account" page', ETHEME_DOMAIN),
                'default'     => array(0=>1),
                'type'        => 'checkbox',
                'section'     => 'shop',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            // Product Grid

            array(
                'id'          => 'view_mode',
                'label'       => __('Products view mode', ETHEME_DOMAIN),
                'type'        => 'select',
                'section'     => 'product_grid',
                'default'     => 'grid_list',
                'class'       => 'prodcuts_per_row',
                'choices'     => array(
                  array(
                    'value' => 'grid_list',
                    'label' => __('Grid/List', ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'list_grid',
                    'label' => __('List/Grid', ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'grid',
                    'label' => __('Only Grid', ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'list',
                    'label' => __('Only List', ETHEME_DOMAIN)
                  )
                )
            ),
            array(
                'id'          => 'prodcuts_per_row',
                'label'       => __('Products per row', ETHEME_DOMAIN),
                'type'        => 'select',
                'section'     => 'product_grid',
                'default'     => 3,
                'class'       => 'prodcuts_per_row',
                'choices'     => array(
                  array(
                    'value' => 3,
                    'label' => '3'
                  ),
                  array(
                    'value' => 4,
                    'label' => '4'
                  ),
                  array(
                    'value' => 5,
                    'label' => '5'
                  ),
                  array(
                    'value' => 6,
                    'label' => '6'
                  ),
                )
            ),
            array(
                'id'          => 'products_per_page',
                'label'       => __('Products per page', ETHEME_DOMAIN),
                'type'        => 'text',
                'default'     => 12,
                'section'     => 'product_grid'
            ),
            array(
                'id'          => 'grid_sidebar',
                'label'       => __('Layout', ETHEME_DOMAIN),
                'desc'        => __('Sidebar position', ETHEME_DOMAIN),
                'default'     => 'left',
                'type'        => 'radio-image',
                'section'     => 'product_grid',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'left',
                        'label'   => __('Left Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
                    ),
                    array(
                        'value'   => 'right',
                        'label'   => __('Right Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
                    ),
                    array(
                        'value'   => 'without',
                        'label'   => __('Without Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/full-width.png'
                    )
                )
            ),
            array(
                'id'          => 'product_img_hover',
                'label'       => __('Product Image Hover', ETHEME_DOMAIN),
                'type'        => 'select',
                'section'     => 'product_grid',
                'default'     => 'slider',
                'choices'     => array(
                  array(
                    'value' => 'disable',
                    'label' => __('Disable', ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'description',
                    'label' => __('Description', ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'swap',
                    'label' => __('Swap', ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'tooltip',
                    'label' => __('Tooltip', ETHEME_DOMAIN)
                  ),
                  array(
                    'value' => 'slider',
                    'label' => __('Images Slider' , ETHEME_DOMAIN)
                  ),
                )
            ),
            array(
                'id'          => 'descr_length',
                'label'       => __('Number of words for description (hover effect)', ETHEME_DOMAIN),
                'default'     => 30,
                'type'        => 'text',
                'section'     => 'product_grid'
            ),
            array(
                'id'          => 'product_page_image_width',
                'label'       => __('Product Images Width', ETHEME_DOMAIN),
                'default'     => 500,
                'type'        => 'text',
                'section'     => 'product_grid'
            ),
            array(
                'id'          => 'product_page_image_height',
                'label'       => __('Product Images Height', ETHEME_DOMAIN),
                'default'     => 700,
                'type'        => 'text',
                'section'     => 'product_grid'
            ),
            array(
                'id'          => 'product_page_image_cropping',
                'label'       => __('Image Cropping', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'default'     => array(
                    0 => 0
                ),
                'section'     => 'product_grid',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'product_page_productname',
                'label'       => __('Show product name', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'product_grid',
                'default'     => array(
                    0 => 1
                ),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'product_page_cats',
                'label'       => __('Show product categories', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'product_grid',
                'default'     => array(
                    0 => 1
                ),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'product_page_price',
                'label'       => __('Show Price', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'product_grid',
                'default'     => array(
                	0 => 1
                ),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'product_page_addtocart',
                'label'       => __('Show "Add to cart" button', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'product_grid',
                'default'     => array(
                	0 => 1
                ),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            // BLOG
            array(
                'id'          => 'blog_layout',
                'label'       => __('Blog Layout', ETHEME_DOMAIN),
                'type'        => 'select',
                'section'     => 'blog_page',
                'default'     => 'default',
                'choices'     => array(
                  array(
                    'value' => 'default',
                    'label' => 'Default'
                  ),
                  array(
                    'value' => 'grid',
                    'label' => 'Grid'
                  ),
                  array(
                    'value' => 'timeline',
                    'label' => 'Timeline'
                  ),
                  array(
                    'value' => 'default_portrait',
                    'label' => 'Small'
                  ),
                )
            ),
            /*
            array(
                'id'          => 'default_blog_slider_height',
                'label'       => 'Posts Sliders Height',
                'desc'        => '<b>Default: </b> 300',
                'type'        => 'text',
                'section'     => 'blog_page',
                'default'     => 300
            ),*/
            array(
                'id'          => 'ajax_posts_loading',
                'label'       => __('AJAX Infinite Posts Loading', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'blog_page',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'blog_lightbox',
                'label'       => __('Enable Lightbox For Blog Posts', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'blog_page',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'blog_slider',
                'label'       => __('Enable Sliders for posts images', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'blog_page',
                'default'     => 1,
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'posts_links',
                'label'       => __('Show Previous and Next posts links', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'blog_page',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'post_share',
                'label'       => __('Show Share buttons', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'blog_page',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array (
              'id' => 'excerpt_length',
              'label' => __('Excerpt length (words)', ETHEME_DOMAIN),
              'type' => 'text',
              'section' => 'blog_page',
              'default' => '50'
            ),
            /*
            array(
                'id'          => 'blog_layout',
                'label'       => 'Blog page layout',
                'default'     => 'default',
                'type'        => 'radio-image',
                'section'     => 'blog_page',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'default',
                        'label'   => 'Default',
                        'src'     => get_template_directory_uri().'/code/css/images/blog_1.jpg'
                    ),
                    array(
                        'value'   => 'portrait',
                        'label'   => 'Portrait Images',
                        'src'     => get_template_directory_uri().'/code/css/images/blog_2.jpg'
                    ),
                    array(
                        'value'   => 'horizontal',
                        'label'   => 'Portrait Images 2',
                        'src'     => get_template_directory_uri().'/code/css/images/blog_3.jpg'
                    )
                )
            ),*/
            array(
                'id'          => 'blog_sidebar',
                'label'       => __('Sidebar position', ETHEME_DOMAIN),
                'default'     => 'left',
                'type'        => 'radio-image',
                'section'     => 'blog_page',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'no_sidebar',
                        'label'   => __('Without Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/full-width.png'
                    ),
                    array(
                        'value'   => 'left',
                        'label'   => __('Left Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
                    ),
                    array(
                        'value'   => 'right',
                        'label'   => __('Right Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
                    )
                )
            ),
            array(
                'id'          => 'blog_sidebar_width',
                'label'       => __('Sidebar width', ETHEME_DOMAIN),
                'default'     => 4,
                'type'        => 'select',
                'section'     => 'blog_page',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 4,
                        'label'   => '1/3'
                    ),
                    array(
                        'value'   => 3,
                        'label'   => '1/4'
                    ),
                    array(
                        'value'   => 2,
                        'label'   => '1/6'
                    ),
                )
            ),
            array(
                'id'          => 'blog_sidebar_responsive',
                'label'       => __('Sidebar position for responsive layout', ETHEME_DOMAIN),
                'default'     => 'bottom',
                'type'        => 'select',
                'section'     => 'blog_page',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'top',
                        'label'   => __('Top', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'bottom',
                        'label'   => __('Bottom', ETHEME_DOMAIN)
                    )
                )
            ),
            // Single Product Page
            array(
                'id'          => 'single_sidebar',
                'label'       => __('Sidebar position', ETHEME_DOMAIN),
                'default'     => 'right',
                'type'        => 'radio-image',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'no_sidebar',
                        'label'   => __('Without Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/full-width.png'
                    ),
                    array(
                        'value'   => 'left',
                        'label'   => __('Left Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
                    ),
                    array(
                        'value'   => 'right',
                        'label'   => __('Right Sidebar', ETHEME_DOMAIN),
                        'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
                    )
                )
            ),
            array(
                'id'          => 'upsell_location',
                'label'       => __('Location of upsell products', ETHEME_DOMAIN),
                'default'     => 'sidebar',
                'type'        => 'select',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'sidebar',
                        'label'   => __('Sidebar', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'after_content',
                        'label'   => __('After content', ETHEME_DOMAIN)
                    )
                )
            ),
            array(
                'id'          => 'show_related',
                'label'       => __('Show related products', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => ''
                    )
                )
            ),
            array(
                'id'          => 'ajax_addtocart',
                'label'       => __('Ajax "Add To Cart" (for simple products only)', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => ''
                    )
                )
            ),
            array(
                'id'          => 'show_name_on_single',
                'label'       => __('Show Product name', ETHEME_DOMAIN),
                'default'     => 0,
                'type'        => 'checkbox',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => ''
                    )
                )
            ),
            /*
            array(
                'id'          => 'product_qr_code',
                'label'       => 'Show QR Code with the product URL',
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => ''
                    )
                )
            ),*/
            array(
                'id'          => 'zoom_effect',
                'label'       => __('Zoom effect', ETHEME_DOMAIN),
                'default'     => 'window',
                'type'        => 'select',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'disable',
                        'label'   => __('Disable', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'slippy',
                        'label'   => __('Slippy', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'window',
                        'label'   => __('Window', ETHEME_DOMAIN)
                    )
                )
            ),
            array(
                'id'          => 'single_product_thumb_width',
                'label'       => __('Product Thumbnails Width', ETHEME_DOMAIN),
                'default'     => 120,
                'type'        => 'text',
                'section'     => 'single_product'
            ),
            array(
                'id'          => 'single_product_thumb_height',
                'label'       => __('Product Thumbnails Height', ETHEME_DOMAIN),
                'default'     => 130,
                'type'        => 'text',
                'section'     => 'single_product'
            ),
            array(
                'id'          => 'gallery_lightbox',
                'label'       => __('Enable Lightbox for Product Images', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => ''
                    )
                )
            ),/*
            array(
                'id'          => 'size_guide_img',
                'label'       => 'Size Guide img',
                'default'     => 'wp-content/themes/theleader/images/assets/sizeguide.jpg',
                'desc'        => 'Upload image: png, jpg or gif file',
                'type'        => 'upload',
                'section'     => 'single_product'
            ),
            array(
                'id'          => 'size_guide_img_mobile',
                'label'       => 'Size Guide img (mobile)',
                'default'     => 'wp-content/themes/idstore/images/assets/size-guide-mobile.jpg',
                'desc'        => 'Upload image: png, jpg or gif file',
                'type'        => 'upload',
                'section'     => 'single_product'
            ),*/
            array(
                'id'          => 'tabs_type',
                'label'       => __('Tabs type', ETHEME_DOMAIN),
                'default'     => 'tabs_default',
                'type'        => 'select',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'tabs-default',
                        'label'   => __('Default', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'left-bar',
                        'label'   => __('Left Bar', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'right-bar',
                        'label'   => __('Right Bar', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'accordion',
                        'label'   => __('Accordion', ETHEME_DOMAIN)
                    )
                )
            ),
            array(
                'id'          => 'share_icons',
                'label'       => __('Show share buttons', ETHEME_DOMAIN),
                'default'     => array(
                    0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'single_product',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 1,
                        'label'   => ''
                    )
                )
            ),
            array(
                'id'          => 'custom_tab_title',
                'label'       => __('Custom Tab Title', ETHEME_DOMAIN),
                'default'     => 'Returns & Delivery',
                'type'        => 'text',
                'section'     => 'single_product'
            ),
            array(
                'id'          => 'custom_tab',
                'label'       => __('Return', ETHEME_DOMAIN),
                'desc'        => __('Enter custom content you would like to output to the product custom tab (for all products)', ETHEME_DOMAIN),
                'default'     => '
    [row][column size="one-half"]<h5>Returns and Exchanges</h5><p>There are a few important things to keep in mind when returning a product you purchased.You can return unwanted items by post within 7 working days of receipt of your goods.</p>[checklist style="arrow"]
    <ul>
    <li>You have 14 calendar days to return an item from the date you received it. </li>
    <li>Only items that have been purchased directly from Us.</li>
    <li>Please ensure that the item you are returning is repackaged with all elements.</li>
    </ul>
    [/checklist] [/column][column size="one-half"]
    <h5>Ship your item back to Us</h5>Firstly Print and return this Returns Form to:<br /> <p>30 South Park Avenue, San Francisco, CA 94108, USA<br /> Please remember to ensure that the item you are returning is repackaged with all elements.</p><br /> <span class="underline">For more information, view our full Returns and Exchanges information.</span>[/column][/row]
                ',
                'type'        => 'textarea',
                'section'     => 'single_product'
            ),
            array(
                'id'          => 'demo_data',
                'label'       => __('Base demo content', ETHEME_DOMAIN),
                'default'     => '',
                'desc'        => '',
                'type'        => 'demo_data',
                'section'     => 'backup',
                'choices'     => array(
                    array(
                        'value'   => 'e-commerce',
                        'label'   => __('E-commerce', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'corporate',
                        'label'   => __('Corporate', ETHEME_DOMAIN)
                    ),
                )
            ),
            array(
                'id'          => 'import_export',
                'label'       => __('Import or Export your theme configuration', ETHEME_DOMAIN),
                'default'     => '',
                'desc'        => '',
                'type'        => 'backup',
                'section'     => 'backup'
            ),
            // QUICK VIEW
            array(
                'id'          => 'quick_view',
                'label'       => __('ENABLE QUICK VIEW', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'quick_images',
                'label'       => __('Product images', ETHEME_DOMAIN),
                'default'     => 'slider',
                'type'        => 'select',
                'section'     => 'quick_view',
                'class'       => '',
                'choices'     => array(
                    array(
                        'value'   => 'none',
                        'label'   => __('None', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'slider',
                        'label'   => __('Slider', ETHEME_DOMAIN)
                    ),
                    array(
                        'value'   => 'single',
                        'label'   => __('Single', ETHEME_DOMAIN)
                    )
                )
            ),
            array(
                'id'          => 'quick_product_name',
                'label'       => __('Product name', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'quick_price',
                'label'       => __('Price', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'quick_rating',
                'label'       => __('Product star rating', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'quick_sku',
                'label'       => __('Product code', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'quick_descr',
                'label'       => __('Short description', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'quick_add_to_cart',
                'label'       => __('Add to cart', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'quick_share',
                'label'       => __('Share icons', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'quick_view',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            // Search
            array(
                'id'          => 'search_products',
                'label'       => __('Search by products', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'search',
                'default'     => 1,
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'search_posts',
                'label'       => __('Search by posts', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'search',
                'default'     => 1,
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'search_projects',
                'label'       => __('Search by projects', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'search',
                'default'     => 1,
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'search_pages',
                'label'       => __('Search by pages', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'search',
                'default'     => 1,
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            // Promo popup
            array(
                'id'          => 'promo_popup',
                'label'       => __('Enable promo popup', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'promo_popup',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'pp_content',
                'label'       => __('Popup content', ETHEME_DOMAIN),
                'type'        => 'textarea',
                'section'     => 'promo_popup',
                'default'     => 'You can add any HTML here (admin -> Theme Options -> Promo Popup).<br> We suggest you create a static block and put it here using shortcode'
            ),
            array(
                'id'          => 'pp_width',
                'label'       => __('Popup width', ETHEME_DOMAIN),
                'default'     => 750,
                'type'        => 'text',
                'section'     => 'promo_popup'
            ),
            array(
                'id'          => 'pp_height',
                'label'       => __('Popup height', ETHEME_DOMAIN),
                'default'     => 350,
                'type'        => 'text',
                'section'     => 'promo_popup'
            ),
            array(
                'id'          => 'pp_bg',
                'label'       => __('Popup background', ETHEME_DOMAIN),
                'default'     => '',
                'type'        => 'background',
                'section'     => 'promo_popup'
            ),
            // Portfolio
            array(
                'id'          => 'portfolio_count',
                'label'       => __('Items per page', ETHEME_DOMAIN),
                'default'     => -1,
                'desc'        => 'Use -1 to show all items',
                'type'        => 'text',
                'section'     => 'portfolio'
            ),
            array(
                'id'          => 'portfolio_columns',
                'label'       => __('Columns', ETHEME_DOMAIN),
                'type'        => 'select',
                'section'     => 'portfolio',
                'default'     => 3,
                'choices'     => array(
                  array(
                    'value' => 2,
                    'label' => 2
                  ),
                  array(
                    'value' => 3,
                    'label' => 3
                  ),
                  array(
                    'value' => 4,
                    'label' => 4
                  ),
                )
            ),
            array(
                'id'          => 'project_name',
                'label'       => __('Show Project names', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'portfolio',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'project_byline',
                'label'       => __('Show ByLine', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'portfolio',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'project_excerpt',
                'label'       => __('Show Excerpt', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'portfolio',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'recent_projects',
                'label'       => __('Show recent projects', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'portfolio',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'portfolio_comments',
                'label'       => __('Enable Comments For Projects', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'portfolio',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'portfolio_lightbox',
                'label'       => __('Enable Lightbox For Projects', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'section'     => 'portfolio',
                'default'     => array(0=>1),
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            array(
                'id'          => 'portfolio_image_width',
                'label'       => __('Project Images Width', ETHEME_DOMAIN),
                'default'     => 720,
                'type'        => 'text',
                'section'     => 'portfolio'
            ),
            array(
                'id'          => 'portfolio_image_height',
                'label'       => __('Project Images Height', ETHEME_DOMAIN),
                'default'     => 550,
                'type'        => 'text',
                'section'     => 'portfolio'
            ),
            array(
                'id'          => 'portfolio_image_cropping',
                'label'       => __('Image Cropping', ETHEME_DOMAIN),
                'type'        => 'checkbox',
                'default'     => array(
                    0 => 1
                ),
                'section'     => 'portfolio',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  ),
                )
            ),
            // Responsive
            array(
                'id'          => 'responsive',
                'label'       => __('Enable Responsive Design', ETHEME_DOMAIN),
                'default'     => array(
                	0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'responsive',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'responsive_from',
                'label'       => __('Large resolution from', ETHEME_DOMAIN),
                'desc'        => 'By default: 1200',
                'default'     => 1200,
                'type'        => 'text',
                'section'     => 'responsive',
            ),
            /*
            array(
                'id'          => 'loader',
                'label'       => 'Show loader icon until site loading on mobile devices',
                'default'     => array(
                	0 => 1
                ),
                'type'        => 'checkbox',
                'section'     => 'responsive',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),
            array(
                'id'          => 'banner_mask',
                'label'       => 'Show banner mask on mobile device',
                'default'     => 'enable',
                'type'        => 'select',
                'section'     => 'responsive',
                'choices'     => array(
                  array(
                    'value' => 'enable',
                    'label' => 'Enable'
                  ),
                  array(
                    'value' => 'disable',
                    'label' => 'Disable'
                  ),
                )
            ),*/
            // Custom CSS
            array(
                'id'          => 'custom_css',
                'label'       => __('Enable Custom CSS file', ETHEME_DOMAIN),
                'desc'        => __('Enable this option to load "custom.css" file in which you can override the default styling of the theme. To create "custom.css" you can use the file "default.custom.css" which is located in theme directory.', ETHEME_DOMAIN),
                'default'     => 0,
                'type'        => 'checkbox',
                'section'     => 'custom_css',
                'choices'     => array(
                  array(
                    'value' => 1,
                    'label' => ''
                  )
                )
            ),



       );

       if($return) {
    	   return $settings;
       }

      $custom_settings = array(
        'contextual_help' => array(
          'content'       => array(
            array(
              'id'        => 'general_help',
              'title'     => __('General', ETHEME_DOMAIN),
              'content'   => ''
            )
          ),
          'sidebar'       => '',
        ),
        'sections'        => $sections,
        'settings'        => $settings
      );

      if(is_array($settings)){
    	  foreach($settings as $key => $value){
    		  $defaults[$value['id']] = $value['default'];
    	  }
      }

      add_option( 'option_tree', $defaults ); // update_option  add_option


      /* settings are not the same update the DB */
      if ( $saved_settings !== $custom_settings ) {
        update_option( 'option_tree_settings', $custom_settings );
      }

    }

    /**
     * Initialize the meta boxes for pages.
     */
    add_action( 'admin_init', 'page_meta_boxes' );


    function page_meta_boxes() {
    global $wpdb;
        $page_options = array(
            array(
                'id'          => 'sidebar_state',
                'label'       => __('Sidebar Position', ETHEME_DOMAIN),
                'type'        => 'select',
                'choices'     => array(
                      array(
                        'value' => '',
                        'label' => __('Default' , ETHEME_DOMAIN)
                      ),
                      array(
                        'value' => 'no_sidebar',
                        'label' => __('Without Sidebar', ETHEME_DOMAIN)
                      ),
                      array(
                        'value' => 'left',
                        'label' => __('Left Sidebar', ETHEME_DOMAIN)
                      ),
                      array(
                        'value' => 'right',
                        'label' => __('Right Sidebar' , ETHEME_DOMAIN)
                      )
                    )
            ),
            array(
                'id'          => 'widget_area',
                'label'       => __('Widget Area', ETHEME_DOMAIN),
                'type'        => 'sidebar_select'
            ),
            array(
                'id'          => 'sidebar_width',
                'label'       => __('Sidebar width', ETHEME_DOMAIN),
                'type'        => 'select',
                'choices'     => array(
                      array(
                        'value' => '',
                        'label' => 'Default'
                      ),
                      array(
                        'value' => 2,
                        'label' => '1/6'
                      ),
                      array(
                        'value' => 3,
                        'label' => '1/4'
                      ),
                      array(
                        'value' => 4,
                        'label' => '1/3'
                      )
                    )
            ),
            array(
                'id'          => 'page_heading',
                'label'       => __('Show Page Heading', ETHEME_DOMAIN),
                'type'        => 'select',
                'choices'     => array(
                      array(
                        'value' => 'enable',
                        'label' => 'Enable'
                      ),
                      array(
                        'value' => 'disable',
                        'label' => 'Disable'
                      )
                    )
            )

        );

        if(class_exists('RevSliderAdmin')) {

        	$rs = $wpdb->get_results(
        		"
        		SELECT id, title, alias
        		FROM ".$wpdb->prefix."revslider_sliders
        		ORDER BY id ASC LIMIT 100
        		"
        	);
        	$revsliders = array(array(
        		'value' => 'no_slider',
        		'label' => 'No Slider'
        	));
        	if ($rs) {
        	$_ri = 1;
        	foreach ( $rs as $slider ) {
        	  	$revsliders[$_ri]['value'] = $slider->alias;
        	  	$revsliders[$_ri]['label'] = $slider->title;
        		$_ri++;
        	}
        	} else {
        		$revsliders["No sliders found"] = 0;
        	}


            if(count($revsliders)>0 ){
        	    array_push($page_options, array(
                    'id'          => 'page_slider',
                    'label'       => 'Show revolution slider instead of breadcrumbs and page title',
                    'type'        => 'select',
                    'choices'     => $revsliders
                ));
            }
        }

      $my_meta_box = array(
        'id'        => 'page_layout',
        'title'     => 'Page Layout',
        'desc'      => '',
        'pages'     => array( 'page', 'post' ),
        'context'   => 'side',//side normal
        'priority'  => 'low',
        'fields'    => $page_options
      );

      ot_register_meta_box( $my_meta_box );

    }


    /**
     * Initialize the meta boxes for products.
     */
    add_action( 'admin_init', 'products_meta_boxes' );


    function products_meta_boxes() {
    	$statick_blocks = array();
    	$statick_blocks[] = array("label"=>"--choose--","value"=>"");
    	$statick_blocks = array_merge($statick_blocks, et_get_static_blocks());

        $page_options = array(
            array(
                'id'          => 'additional_block',
                'label'       => 'Additional information block',
                'type'        => 'select',
                'choices'     => $statick_blocks
            ),
            array(
                'id'          => 'product_new',
                'label'       => 'Mark product as "New"',
                'type'        => 'select',
                'choices'     => array(
                  array(
                    'value' => 'disable',
                    'label' => 'Choose'
                  ),
                  array(
                    'value' => 'disable',
                    'label' => 'No'
                  ),
                  array(
                    'value' => 'enable',
                    'label' => 'Yes'
                  )
                )
            ),

            array(
                'id'          => 'size_guide_img',
                'label'       => 'Size Guide img',
                'desc'        => 'Upload image: png, jpg or gif file',
                'type'        => 'upload'
            ),
            array(
                'id'          => 'hover_img',
                'label'       => 'Upload image for hover effect',
                'type'        => 'upload'
            ),
            array(
                'id'          => 'custom_tab1_title',
                'label'       => 'Title for custom tab',
                'type'        => 'text'
            ),
            array(
                'id'          => 'custom_tab1',
                'label'       => 'Text for custom tab',
                'type'        => 'textarea'
            ),
        );

      $my_meta_box = array(
        'id'        => 'product_options',
        'title'     => 'Additional product options [8theme]',
        'desc'      => '',
        'pages'     => array( 'product' ),
        'context'   => 'normal',//side normal
        'priority'  => 'low',
        'fields'    => $page_options
      );

      ot_register_meta_box( $my_meta_box );

    }

    /**
     * Initialize the meta boxes for portfolio.
     */
    //add_action( 'admin_init', 'portfolio_meta_boxes' );


    function portfolio_meta_boxes() {
        $page_options = array(
            array(
                'id'          => 'project_url',
                'label'       => 'Project Url',
                'type'        => 'text'
            ),
            array(
                'id'          => 'client',
                'label'       => 'Client',
                'type'        => 'text'
            ),
            array(
                'id'          => 'client_url',
                'label'       => 'Client Url',
                'type'        => 'text'
            ),
            array(
                'id'          => 'copyright',
                'label'       => 'Copyright',
                'type'        => 'text'
            ),
            array(
                'id'          => 'copyright_url',
                'label'       => 'Copyright Url',
                'type'        => 'text'
            ),
        );

      $my_meta_box = array(
        'id'        => 'product_options',
        'title'     => 'Additional project information',
        'desc'      => '',
        'pages'     => array( 'etheme_portfolio' ),
        'context'   => 'normal',//side normal
        'priority'  => 'low',
        'fields'    => $page_options
      );

      ot_register_meta_box( $my_meta_box );

    }



    function etheme_theme_settings_defaults() {
    	$defaults = array();
    	return apply_filters('etheme_theme_settings_defaults', $defaults);
    }
}
?>
