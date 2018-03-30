<?php
namespace Handyman\Core;

/**
 * Class Customizer
 * @package Handyman\Core
 */
class Customizer
{

    static public $instance;


    public function __construct()
    {
        self::$instance =& $this;

        // Register the customizer object
        global $wp_customize;
        $this->customizer = $wp_customize;

        // Register new control
        add_action('customize_register', array($this, 'registerTLControls'), 100);

        // This hook allows you to set custom defaults for each customizer control
        // added by Layers such as the header layout, fonts and colors.
        add_filter('layers_customizer_defaults', array($this, 'customizerControlDefaults'), 99);

        // Filter/Change defaults just before appling these values to controls. Only for controls defined
        // by layers
        add_filter('layers_customizer_control_defaults', array($this, 'customizerControlDefaults'), 99);

        // Filter Panels, Section and Controls
        add_filter('layers_customizer_controls', array($this, 'addCustomizerControls'), 100);
        add_filter('layers_customizer_sections', array($this, 'addCustomizerSections'), 100);
        add_filter('layers_customizer_panels', array($this, 'addCustomizerPanels'), 100);

        add_action('customize_controls_enqueue_scripts', array($this, 'enqueueAdminScripts'));

        // Filter default customizer controls
        add_action('customize_register', array($this, 'filterDefaultWpControls'), 99);
    }


    public function registerTLControls($wp_customize)
    {
        $wp_customize->add_setting('test_color_scheme', array('default' => 'y-b'));

        $wp_customize->add_control(new \Handyman\Core\Color_Scheme_Picker($wp_customize, 'test_color_scheme', array(
            'label' => 'Color Shemes',
            'section' => 'layers-site-colors',
            'settings' => 'test_color_scheme',
            'priority' => 150
        )));
    }


    /**
     * @param $wp_customize
     */
    public function filterDefaultWpControls($wp_customize)
    {
        //$wp_customize->remove_control('nav_menu_locations[layers-secondary-left]');
        //$wp_customize->remove_control('nav_menu_locations[layers-secondary-right]');
        //$wp_customize->remove_control('nav_menu_locations[layers-primary-right]');
        $wp_customize->remove_control('nav_menu_locations[layers-footer]');
    }


    /**
     * Enqueue CSS for customizer
     */
    public function enqueueAdminScripts()
    {
        if (is_admin()) {
            wp_enqueue_style(TL_THEME_SLUG . '-customize', Assets::assetPath('css/customize.css'), array(), TL_THEME_VER);
        }
    }


    /**
     * Set Theme defaults related to the customizer
     *
     * @param $defaults
     * @return mixed
     */
    public function customizerControlDefaults($defaults)
    {
        $theme = array(
            'body-fonts' => 'Lato',
            'body-secondaty-fonts' => 'Roboto Slab',
            'form-fonts' => 'Roboto Slab',
            'heading-fonts' => 'Roboto Slab',
            'menu-fonts' => 'Roboto Slab',
            'button-secondary-fonts' => 'Lato',
            'social-fb' => 'http://facebook.com',
            'social-yt' => 'http://youtube.com',
            'social-tw' => 'http://twitter.com',
            'header-menu-layout' => 'header-logo-left',
            'header-show-socialicons' => true,
            'header-show-contact' => true,
            'header-show-slogans' => true,
            'header-show-primary-navigation' => false,
            'header-background-color' => '',
            'site-accent-color' => '',
            'footer-background-color' => '',
            'header-sticky' => true,
            'header-overlay' => true,
            'header-width' => 'layout-boxed',
            'footer-sidebar-count' => '0',
            'footer-copyright-text' => '&copy; 2015 Handyman. All Rights Reserved.',

            // Colors
            'theme-primary-color' => '#f2a61f',
            'theme-secondary-color' => '#003668',
            'theme-mobile-menu-bg-color' => '#00284c',
            'theme-mobile-submenu-bg-color' => '#042240',

            'slider-btn-bg' => '#f2a61f',
            'slider-btn-bg-hover' => '#003668',
            'slider-btn-text' => '#003668',
            'slider-btn-text-hover' => '#ffffff',

            'form-btn-bg' => '#f2a61f',
            'form-btn-bg-hover' => '#003668',
            'form-btn-text' => '#003668',
            'form-btn-text-hover' => '#ffffff',

            'comment_avatar_color' => '#003368',

            'layers-site_favicon' => TL_BASE_URL_CHILD . '/assets/preset-images/favicon.ico',

            // Contact info
            'contact-phone' => '0800 123 456',
            'contact-txt1' => 'Contact Us Today',
            'contact-txt2' => 'We Answer Our Phones 24/7',
            'contact-company' => 'Company Name Inc.',
            'contact-email' => 'office@example.com',
            'contact-find-us' => 'How to find us?',
            'contact-address' => '123 Cesar Cahavez St, San Francisko, CA 94110, United States ',
            'contact-map-lat' => '37.7505268',
            'contact-map-long' => '-122.3832541',
            'min-js' => true,
            'min-css' => true,

            // Partners
            'partner-logo1' => \Handyman\Core\Assets::assetPath('preset-images/partner-logo3.png'),
            'partner-logo2' => \Handyman\Core\Assets::assetPath('preset-images/partner-logo1.png'),
            'partner-logo3' => \Handyman\Core\Assets::assetPath('preset-images/partner-logo4.png'),
            'partner-logo4' => \Handyman\Core\Assets::assetPath('preset-images/partner-logo2.png'),
            'partner-logo5' => \Handyman\Core\Assets::assetPath('preset-images/partner-logo1.png'),

            // Header Blog
            'header-archive-bg-image' => '',
            'header-archive-bg-color' => '#191e23',
            'header-archive-bg-darken' => true,
            'header-archive-height' => 400,
            'header-archive-teaser-size' => 'medium',
            'header-archive-teaser-title' => 'TIPS FROM BLOG',
            'header-archive-teaser-excerpt' => 'Nostra ridiculus tellus maecenas eleifend at, conubia sollicitudin repudiandae sit, nostrud debitis dicta. Quasi praesent porttitor tellus',

            // Custom page footer
            'footer-cpage-form7-show' => false,
            'footer-cpage-map-show' => false,
            'footer-cpage-map-height' => 550,
            'footer-cpage-map-zoom' => 16,
            'footer-cpage-form7-title' => __('REQUEST A HANDYMAN', TL_DOMAIN),
            'footer-cpage-form7-excerpt' => __('No obligation contact form. Let\'s talk about your "to do" list!', TL_DOMAIN),

            // Inner pages footer
            'footer-form7-show' => false,
            'footer-map-show' => false,
            'footer-map-height' => 550,
            'footer-map-zoom' => 16,
            'footer-form7-title' => __('REQUEST A HANDYMAN', TL_DOMAIN),
            'footer-form7-excerpt' => __('No obligation contact form. Let\'s talk about your "to do" list!', TL_DOMAIN),

            // Popup
            'btn-label' => __('REQUEST A HANDYMAN', TL_DOMAIN),
            'btn-link' => '#',
            'hide-btn' => false,
            'popup-hide-footer' => false,

            //Teaser
            'teaser-align' => 'text-center',
        );

        $defaults = wp_parse_args($theme, $defaults);
        return $defaults;
    }


    /**
     * Add controls related to child theme
     *
     * @param $controls
     */
    public function addCustomizerControls($controls)
    {
        unset($controls['title_tagline']['logo-upsell-layers-pro']);

        // Remove unsupported color controls
        unset($controls['site-colors']['site-color-heading']);
        unset($controls['site-colors']['upsell-colorkit-heading']);
        unset($controls['site-colors']['colors-upsell-layers-pro']);

        unset($controls['footer-layout']['show-layers-badge']);
        unset($controls['footer-layout']['footer-upsell-layers-pro']);


        /* Header Layout */

        // Unset unsupported logo/menu layouts
        unset($controls['header-layout']['header-upsell-layers-pro']);
        //unset($controls['header-layout']['header-menu-layout']['choices']['header-logo-top']);
        //unset($controls['header-layout']['header-menu-layout']['choices']['header-logo-center']);
        unset($controls['css']['upsell-devkit-heading']);


        /* -- Header Content -- */

        $controls['header-layout']['header-navigation-separator'] = array(
            'type' => 'layers-seperator'
        );
        $controls['header-layout']['header-primary-navigation-heading'] = array(
            'type' => 'layers-heading',
            'label' => __('Header Content', TL_DOMAIN),
        );
        $controls['header-layout']['header-show-primary-navigation'] = array(
            'type' => 'layers-checkbox',
            'label' => __('Show Primary Navigation in header', TL_DOMAIN),
        );
        $controls['header-layout']['header-show-socialicons'] = array(
            'type' => 'layers-checkbox',
            'label' => __('Show Social Icons in Header', TL_DOMAIN),
            'active_callback' => '\Handyman\Extras\tl_primary_navigation_off',
        );
        $controls['header-layout']['header-show-contact'] = array(
            'type' => 'layers-checkbox',
            'label' => __('Show Contact info in Header', TL_DOMAIN),
            'active_callback' => '\Handyman\Extras\tl_primary_navigation_off',
        );
        $controls['header-layout']['header-show-slogans'] = array(
            'type' => 'layers-checkbox',
            'label' => __('Show text under the contact Info/Social Icons', TL_DOMAIN),
            'active_callback' => '\Handyman\Extras\tl_primary_navigation_off',
        );



        $forms = array('0' => __('None', TL_DOMAIN)) + \Handyman\Extras\tl_get_forms();

        // Fonts
        $controls['fonts']['heading-fonts']['selectors'] .= ',.slide .section-title .excerpt';

        // spoiler headings in the list should have the same font as body
        $controls['fonts']['body-fonts']['selectors'] .= ',.tl-spoiler > h6';

        //
        $controls['fonts']['button-secondary-fonts'] = array(
            'type' => 'layers-font',
            'label' => __('Secondary Buttons', TL_DOMAIN),
            'choices' => layers_get_google_font_options(),
            'selectors' => '.button.button-secondary-style'
        );


        // Menu items
        $controls['fonts']['menu-fonts'] = array(
            'type' => 'layers-font',
            'label' => __('Menu Items', TL_DOMAIN),
            'choices' => layers_get_google_font_options(),
            'selectors' => '.menu li,.menu li a,.sidebar .widget a,.filters-wrapper ul.filters li a'
        );


        // Pricing table
        $controls['fonts']['body-secondaty-fonts'] = array(
            'type' => 'layers-font',
            'label' => __('Body Secondary', TL_DOMAIN),
            'choices' => layers_get_google_font_options(),
            'selectors' => '.pricetable-body .pricing-plan-number,.header-contact,.tl-contactinfo,.tl-blockquote.swiper-slide span,.tweet-meta a.twitter-time',
        );


        // Header layout additions
        $controls['header-layout']['teaser-align-sep'] = array(
            'type' => 'layers-seperator'
        );
        $controls['header-layout']['teaser-align-heading'] = array(
            'type' => 'layers-heading',
            'label' => __('Teaser Alignment', TL_DOMAIN),
            'active_callback' => '\Handyman\Extras\is_not_layers_page'
        );
        $controls['header-layout']['teaser-align'] = array(
            'type' => 'layers-select-icons',
            'choices' => array(
                'text-left' => __('Left', TL_DOMAIN),
                'text-center' => __('Center', TL_DOMAIN),
                'text-right' => __('Right', TL_DOMAIN),
            ),
            'wrapper' => 'div',
            'wrapper-class' => 'layers-icon-group',
            'default' => 'text-center',
            'active_callback' => '\Handyman\Extras\is_not_layers_page',
        );


        // Colors controls
        $theme_color_schemes = array(
            'site-color-heading' => array(
                'type' => 'layers-heading',
                'label' => __('Site Wide Colors', TL_DOMAIN),
                'description' => __('These options allow you to change the key colors of your Layers website.', TL_DOMAIN),
            ),
            'theme-color-scheme1' => array(
                'type' => 'layers-seperator'
            ),
            'theme-primary-color' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Theme\'s Primary Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#f2a61f',
            ),
            'theme-secondary-color' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Theme\'s Secondary Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#003668',
            ),
            'slider-btns-separator1' => array(
                'type' => 'layers-seperator'
            ),
            'slider-btns-heading' => array(
                'type' => 'layers-heading',
                'label' => __('SLIDER BUTTONS', TL_DOMAIN),
            ),
            'slider-btn-bg' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Slider Button Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#f2a61f',
            ),
            'slider-btn-bg-hover' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Slider Button Hover Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#003668',
            ),
            'slider-btn-text' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Slider Button Text Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#003668',
            ),
            'slider-btn-text-hover' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Slider Button Text Hover Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#ffffff',
            ),
            'form-btns-separator1' => array(
                'type' => 'layers-seperator'
            ),
            'form-btns-heading' => array(
                'type' => 'layers-heading',
                'label' => __('FORM BUTTONS', TL_DOMAIN),
            ),
            'form-btn-bg' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Form Button Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#f2a61f',
            ),
            'form-btn-bg-hover' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Form Button Hover Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#003668',
            ),
            'form-btn-text' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Form Button Text Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#003668',
            ),
            'form-btn-text-hover' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Form Button Text Hover Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#ffffff',
            ),
            'inner-separator1' => array(
                'type' => 'layers-seperator'
            ),
            'inner-heading' => array(
                'type' => 'layers-heading',
                'label' => __('INNER PAGES', TL_DOMAIN),
            ),
            'comment_avatar_color' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Comments - Avatar Name Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#003368',
            ),
            'menu-btns-separator1' => array(
                'type' => 'layers-seperator'
            ),
            'menu-heading' => array(
                'type' => 'layers-heading',
                'label' => __('NAVIGATION', TL_DOMAIN),
            ),
            'theme-mobile-menu-bg-color' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Mobile Menu Background Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#00284c',
            ),
            'theme-mobile-submenu-bg-color' => array(
                'type' => 'layers-color',
                'label' => '',
                'subtitle' => __('Mobile Submenu Background Color', TL_DOMAIN),
                'description' => __('This affects following elements:(....).', TL_DOMAIN),
                'default' => '#042240',
            ),
        );
        $controls['site-colors'] = array_merge($theme_color_schemes, $controls['site-colors']);


        // Header Content for inner pages

        $header_archive = array(
            'header-heading1' => array(
                'type' => 'layers-heading',
                'label' => '',
                'description' => __('This header appears at Single Post, Post List, Category, Tag and Attachment pages', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog',
            ),
            'h_archive_sep1' => array(
                'type' => 'layers-seperator',
                'active_callback' => '\Handyman\Extras\is_blog',
            ),
            'header-archive-bg-color' => array(
                'type' => 'layers-color',
                'subtitle' => __('Header Background Color', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog',
            ),
            'header-archive-bg-image' => array(
                'type' => 'layers-select-images',
                'subtitle' => __('Background Image', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog',
            ),
            'header-archive-bg-darken' => array(
                'type' => 'layers-checkbox',
                'label' => __('Make Background Image Darken', TL_DOMAIN),
                'description' => __('Check option to make image darken.', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog',
            ),
            'header-archive-height' => array(
                'type' => 'layers-number',
                'subtitle' => __('Header Height', TL_DOMAIN),
                'description' => __('Set Header height. If set to "0" Auto Height is enabled.', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog',
            ),
            'header-archive-teaser-title' => array(
                'type' => 'layers-text',
                'subtitle' => __('Header Title', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog',
            ),
            'header-archive-teaser-excerpt' => array(
                'type' => 'layers-textarea',
                'subtitle' => __('Header Excerpt', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog',
            ),
            'header-archive-teaser-size' => array(
                'type' => 'layers-select',
                'subtitle' => __('Teaser text size', TL_DOMAIN),
                'choices' => array(
                    'small' => 'Small',
                    'medium' => 'Medium',
                    'large' => 'Large',
                ),
                'active_callback' => '\Handyman\Extras\is_blog',
            ),
        );
        $controls['header-content-archive'] = $header_archive;


        // Contact and Map Content for blog pages
        $controls['footer-content'] = array(
            'footer-sep3' => array(
                'type' => 'layers-seperator',
                'active_callback' => '\Handyman\Extras\is_blog_or_404_search',

            ),
            'footer-heading1' => array(
                'type' => 'layers-heading',
                'label' => __('FORM CONTAINER', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog_or_404_search',
            ),
            'footer-form7-title' => array(
                'type' => 'layers-text',
                'subtitle' => __('Section title', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog_or_404_search',
            ),
            'footer-form7-excerpt' => array(
                'type' => 'layers-textarea',
                'subtitle' => __('Section excerpt', TL_DOMAIN),
                'description' => __('Set short excerpt', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog_or_404_search',
            ),
            'footer-form7-show' => array(
                'type' => 'layers-checkbox',
                'label' => __('Show contact form container', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog_or_404_search',
            ),
            'footer-form7-id' => array(
                'type' => 'layers-select',
                'subtitle' => __('Select contact form', TL_DOMAIN),
                'choices' => $forms,
                'active_callback' => '\Handyman\Extras\is_blog_or_404_search',
            ),
            'footer-sep2' => array(
                'type' => 'layers-seperator',
                'active_callback' => '\Handyman\Extras\is_blog_or_404_search',
            ),
            'footer-heading2' => array(
                'type' => 'layers-heading',
                'label' => __('MAP CONTAINER', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog_or_404_search',
            ),
            'footer-map-show' => array(
                'type' => 'layers-checkbox',
                'label' => __('Show google map', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog_or_404_search',
                'description' => __('Marker position is determinated by info entered in contact info section.', TL_DOMAIN),
            ),
            'footer-map-height' => array(
                'type' => 'layers-number',
                'subtitle' => __('Map Height', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog_or_404_search',
            ),
            'footer-map-zoom' => array(
                'type' => 'layers-select',
                'choices' => array('16' => __('Close', TL_DOMAIN), '14' => __('Default', TL_DOMAIN), '12' => __('Far', TL_DOMAIN)),
                'subtitle' => __('Map Zoom Level', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_blog_or_404_search',
            )
        );


        // Contact and Map Content for custom pages
        $controls['footer-content-cpage'] = array(
            'footer-cpage-sep3' => array(
                'type' => 'layers-seperator',
                'active_callback' => '\Handyman\Extras\is_custom_template',
            ),
            'footer-cpage-heading1' => array(
                'type' => 'layers-heading',
                'label' => __('FORM CONTAINER', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_custom_template',
            ),
            'footer-cpage-form7-title' => array(
                'type' => 'layers-text',
                'subtitle' => __('Section title', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_custom_template',
            ),
            'footer-cpage-form7-excerpt' => array(
                'type' => 'layers-textarea',
                'subtitle' => __('Section excerpt', TL_DOMAIN),
                'description' => __('Set short excerpt', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_custom_template',
            ),
            'footer-cpage-form7-show' => array(
                'type' => 'layers-checkbox',
                'label' => __('Show contact form container', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_custom_template',
            ),
            'footer-cpage-form7-id' => array(
                'type' => 'layers-select',
                'subtitle' => __('Select contact form', TL_DOMAIN),
                'choices' => $forms,
                'active_callback' => '\Handyman\Extras\is_custom_template',
            ),
            'footer-cpage-sep2' => array(
                'type' => 'layers-seperator',
                'active_callback' => '\Handyman\Extras\is_custom_template',
            ),
            'footer-cpage-heading2' => array(
                'type' => 'layers-heading',
                'label' => __('MAP CONTAINER', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_custom_template',
            ),
            'footer-cpage-map-show' => array(
                'type' => 'layers-checkbox',
                'label' => __('Show google map', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_custom_template',
                'description' => __('Marker position is determinated by info entered in contact info section.', TL_DOMAIN)
            ),
            'footer-cpage-map-height' => array(
                'type' => 'layers-number',
                'subtitle' => __('Map Height', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_custom_template',
            ),
            'footer-cpage-map-zoom' => array(
                'type' => 'layers-select',
                'choices' => array('16' => __('Close', TL_DOMAIN), '14' => __('Default', TL_DOMAIN), '12' => __('Far', TL_DOMAIN)),
                'subtitle' => __('Map Zoom Level', TL_DOMAIN),
                'active_callback' => '\Handyman\Extras\is_custom_template',
            )
        );


        // Social media controls
        $social_media = array(
            'social-media-heading' => array(
                'type' => 'layers-heading',
                'label' => __('Social links', 'layerswp'),
                'description' => __('These options allow you to change link to your social channels. Leave field empty in order to remove icon from the website.', 'layerswp'),
            ),
            'social-fb' => array(
                'type' => 'layers-text',
                'subtitle' => __('Facebook Link', TL_DOMAIN),
                'description' => __('Link to the facebook profile.', TL_DOMAIN),
            ),
            'social-yt' => array(
                'type' => 'layers-text',
                'subtitle' => __('Youtube Link', TL_DOMAIN),
                'description' => __('Link to the your youtube channel.', TL_DOMAIN),
            ),
            'social-tw' => array(
                'type' => 'layers-text',
                'subtitle' => __('Twitter Link', TL_DOMAIN),
                'description' => __('Link to the your twitter channel', TL_DOMAIN),
            ),
            'social-glplus' => array(
                'type' => 'layers-text',
                'subtitle' => __('Google+ Link', TL_DOMAIN),
                'description' => __('Link to the your Google+', TL_DOMAIN),
            ),
            'social-linkin' => array(
                'type' => 'layers-text',
                'subtitle' => __('LinkedIn Link', TL_DOMAIN),
                'description' => __('Link to the your LinedIn Profile', TL_DOMAIN),
            ),
            'social-instagram' => array(
                'type' => 'layers-text',
                'subtitle' => __('Instagram Link', TL_DOMAIN),
                'description' => __('Link to the your Instagram profile', TL_DOMAIN),
            ),
            'social-tumblr' => array(
                'type' => 'layers-text',
                'subtitle' => __('Tumblr Link', TL_DOMAIN),
                'description' => __('Link to the your Tumblr profile', TL_DOMAIN),
            ),
            'social-flickr' => array(
                'type' => 'layers-text',
                'subtitle' => __('Flickr Link', TL_DOMAIN),
                'description' => __('Link to the your Flickr profile', TL_DOMAIN),
            ),
            'social-reddit' => array(
                'type' => 'layers-text',
                'subtitle' => __('Reddit Link', TL_DOMAIN),
                'description' => __('Link to the your Reddit profile', TL_DOMAIN),
            ),
            'social-hide-in-mobile-menu' => array(
                'type' => 'layers-checkbox',
                'label' => __('Hide Social Icons in the mobile menu', TL_DOMAIN),
            )
        );
        $controls['social-media'] = $social_media;


        // -- Extras panel --

        // Partners
        $controls['partners'] = array(
            'partner-logo1' => array(
                'type' => 'layers-select-images',
                'label' => __('Partner 1 Logo', TL_DOMAIN),
                'class' => 'partner-logo-image layers-visuals-item',
            ),
            'partner-logo2' => array(
                'type' => 'layers-select-images',
                'label' => __('Partner 2 Logo', TL_DOMAIN),
                'class' => 'partner-logo-image'
            ),
            'partner-logo3' => array(
                'type' => 'layers-select-images',
                'label' => __('Partner 3 Logo', TL_DOMAIN),
                'class' => 'partner-logo-image'
            ),
            'partner-logo4' => array(
                'type' => 'layers-select-images',
                'label' => __('Partner 4 Logo', TL_DOMAIN),
                'class' => 'partner-logo-image'
            ),
            'partner-logo5' => array(
                'type' => 'layers-select-images',
                'label' => __('Partner 5 Logo', TL_DOMAIN),
                'class' => 'partner-logo-image'
            )
        );


        $controls['contact-info'] = array(
            'contact-info-heading' => array(
                'type' => 'layers-heading',
                'label' => '',
                'description' => __('This data is used in header and widgets wiht contact info.', TL_DOMAIN),
            ),
            'contact-company' => array(
                'type' => 'layers-text',
                'label' => __('Company name', TL_DOMAIN),
                'description' => __('Used on Google Map marker', TL_DOMAIN)
            ),
            'contact-address' => array(
                'type' => 'layers-text',
                'label' => __('Company Address', TL_DOMAIN),
                'description' => __('Used on Google Map marker', TL_DOMAIN)
            ),
            'contact-map-lat' => array(
                'type' => 'layers-text',
                'label' => __('Google Map Latitude', TL_DOMAIN),
                'description' => __('Used on Google Map marker(inner pages.)', TL_DOMAIN)
            ),
            'contact-map-long' => array(
                'type' => 'layers-text',
                'label' => __('Google Map Longitude', TL_DOMAIN),
                'description' => __('Used on Google Map marker(inner pages)', TL_DOMAIN)
            ),
            'contact-email' => array(
                'type' => 'layers-text',
                'label' => __('Email address', TL_THEME_SLUG),
                'description' => __('Used on Google Map marker', TL_DOMAIN)
            ),
            'contact-find-us' => array(
                'type' => 'layers-text',
                'label' => __('Google Marker text', TL_DOMAIN),
                'description' => __('Used on Google Map marker', TL_DOMAIN)
            ),
            'contact-phone' => array(
                'type' => 'layers-text',
                'label' => __('Phone number', TL_DOMAIN),
                'description' => __('Used on Google Map marker', TL_DOMAIN)
            ),
            'contact-txt1' => array(
                'type' => 'layers-text',
                'label' => __('Text 1', TL_DOMAIN)
            ),
            'contact-txt2' => array(
                'type' => 'layers-text',
                'label' => __('Text 2', TL_DOMAIN)
            ),
        );


        $controls['popup'] = array(
            'popup-heading' => array(
                'type' => 'layers-heading',
                'label' => '',
                'description' => __('Settings related to the popup window', TL_DOMAIN),
            ),
            'btn-label' => array(
                'type' => 'layers-text',
                'subtitle' => __('Button Label', TL_DOMAIN)
            ),
            'btn-link' => array(
                'type' => 'layers-text',
                'subtitle' => __('Link', TL_DOMAIN),
                'placeholder' => 'http://... or #el_id',
                'description' => __('Enter a full page URL or element ID( including # tag. E.g. #section_id ).', TL_DOMAIN)
            ),
            'hide-btn' => array(
                'type' => 'layers-checkbox',
                'label' => __('Hide Button', TL_DOMAIN),
                'description' => __('Check this option to hide button.', TL_DOMAIN),
            ),
            'popup-hide-footer' => array(
                'type' => 'layers-checkbox',
                'label' => __('Hide Popup Footer', TL_DOMAIN),
                'description' => __('Check this option to hide entire footer section.', TL_DOMAIN),
            )
        );


        $controls['min-files'] = array(
            'min-files-heading' => array(
                'type' => 'layers-heading',
                'label' => '',
                'description' => __('Static file minimization', TL_DOMAIN),
            ),
            'min-css' => array(
                'type' => 'layers-checkbox',
                'label' => __('Minimize CSS files', TL_DOMAIN)
            ),
            'min-js' => array(
                'type' => 'layers-checkbox',
                'label' => __('Minimize JS files', TL_DOMAIN)
            )
        );


        $controls['footer-layout']['footer-hide-social-icons'] = array(
            'type' => 'layers-checkbox',
            'label' => __('Hide Social Icons in the footer sections.', TL_DOMAIN),
        );


        $controls['footer-layout']['footer-copyright-text2'] = array(
            'type' => 'layers-rte',
            'label' => __('Copyright Text 2', TL_DOMAIN),
            'sanitize_callback' => null,
            'default' => 'Created with <i class="fa fa-heart-o"></i> by <a href="' . TL_COMPANY_URL . '">ThemeLaboratory</a>'
        );
        return $controls;
    }


    /**
     * Add custom section
     *
     * @param $sections
     * @return array
     */
    public function addCustomizerSections($sections)
    {
        // Section for social icons
        $sections['social-media'] = array(
            'title' => __('Social Icons', TL_DOMAIN),
            'panel' => 'header',
        );

        $sections['header-content-archive'] = array(
            'title' => __('Header Content (Blog)', TL_DOMAIN),
            'panel' => 'header'
        );

        $sections['footer-content-cpage'] = array(
            'title' => __('Contact & Map (Custom Page)', TL_DOMAIN),
            'panel' => 'tl-contact-map',
            'description' => __('It appears on all custom pages except pages created with "Blank Template". Also it appears on 404 & Search pages.', TL_DOMAIN)
        );

        $sections['footer-content'] = array(
            'title' => __('Contact & Map (Blog)', TL_DOMAIN),
            'panel' => 'tl-contact-map',
            'description' => __('It appears on Blog pages, 404 and Search(Single Post, Post List, Category, Tag, ...)', TL_DOMAIN),
        );

        // partners - SECTION!!!!
        $sections['partners'] = array(
            'title' => __('Partner\'s Logos', TL_DOMAIN),
            'panel' => 'tl-extras',
        );

        $sections['contact-info'] = array(
            'title' => __('Contact Info', TL_DOMAIN),
            'panel' => 'tl-extras',
        );

        $sections['popup'] = array(
            'title' => __('Popup Window Settings', TL_DOMAIN),
            'panel' => 'tl-extras',
        );

        $sections['min-files'] = array(
            'title' => __('File Minimization', TL_DOMAIN),
            'panel' => 'tl-extras',
        );

        return $sections;
    }


    /**
     * @param $panels
     */
    public function addCustomizerPanels($panels)
    {
        $panels['tl-contact-map'] = array(
            'title' => __('Contact & Map', TL_DOMAIN),
            'description' => __('Contact & Map options for static pages and blog.', TL_DOMAIN),
            'priority' => 70
        );

        $panels['tl-extras'] = array(
            'title' => __('Extras', TL_DOMAIN),
            'description' => __('Additional options', TL_DOMAIN),
            'priority' => 90
        );

        return $panels;
    }


    /**
     * Get Options saved with customizer
     *
     * @param $name
     * @param bool $allow_empty
     * @param bool $echo
     * @return bool|string
     */
    public static function opt($name, $allow_empty = true, $echo = false)
    {
        global $layers_customizer_defaults;

        // Add the theme prefix to our layers option
        $name = 'layers-' . $name;

        // Set theme option default

        if (isset($layers_customizer_defaults[$name]['value'])) {
            $default = $layers_customizer_defaults[$name]['value'];
        } elseif (isset($layers_customizer_defaults[$name])) { // fix. for adding custom controls to default sections
            $default = $layers_customizer_defaults[$name];
        } else {
            $default = false;
        }

        // Get theme option
        $theme_mod = get_theme_mod($name, $default);

        // Template can choose whether to allow empty
        if (false != $default && '' == $theme_mod && false == $allow_empty) {
            $theme_mod = $default;
        }

        // Return theme option
        return $theme_mod;
    }
}