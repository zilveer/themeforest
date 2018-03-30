<?php
/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: https://docs.reduxframework.com
 * */

global $couponxl_opts;

if (!class_exists('CouponXL_Options')) {

    class CouponXL_Options
    {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct()
        {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array(
                    $this,
                    'initSettings'
                ), 10);
            }

        }

        public function initSettings()
        {

            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo()
        {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2);

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action('admin_notices', array(
                    ReduxFrameworkPlugin::instance(),
                    'admin_notices'
                ));
            }
        }

        public function setSections()
        {

            /**
             * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns      = array();

            if (is_dir($sample_patterns_path)):
                if ($sample_patterns_dir = opendir($sample_patterns_path)):
                    $sample_patterns = array();
                    while (($sample_patterns_file = readdir($sample_patterns_dir)) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name              = explode('.', $sample_patterns_file);
                            $name              = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array(
                                'alt' => $name,
                                'img' => $sample_patterns_url . $sample_patterns_file
                            );
                        }
                    }
                endif;
            endif;

            /////////////////////////////////////////////////////////////////////////////// 1. OVERALL //

            $this->sections[] = array(
                'title' => __('Overall Setup', 'couponxl'),
                'desc' => __('Here in overall setup section you can edit basic settings related to overall website.', 'couponxl'),
                'icon' => 'el-icon-cogs',
                'indent' => true,
                'fields' => array(
              

                )
            );

            // Theme Usage //
            $this->sections[] = array(
                'title' => __('Notification Bar', 'couponxl'),
                'desc' => __('Choose will you use notification bar.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'show_notification_bar',
                        'type' => 'select',
                        'options' => array(
                            'no' => __('No', 'couponxl'),
                            'yes' => __('Yes', 'couponxl')
                        ),
                        'title' => __('Enable Notification Bar', 'couponxl'),
                        'desc' => __('Choose will you use notification bar or not.', 'couponxl'),
                        'default' => 'no'
                    ),
                    array(
                        'id' => 'notification_txt',
                        'type' => 'text',
                        'title' => __('Notification Text', 'couponxl'),
                        'desc' => __('Input notification text which will be disaplyed in the notification bar.', 'couponxl'),
                    ),
                   
                    array(
                        'id' => 'notification_bg_color',
                        'type' => 'color',
                        'title' => __('Notification Bar Background Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Choose notification bar background color.', 'couponxl'),
                        'transparent' => false,
                        'default' => '#DA1B36'
                    ),
                    array(
                        'id' => 'notification_font_color',
                        'type' => 'color',
                        'title' => __('Notification Bar Font Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Choose notification bar font color.', 'couponxl'),
                        'transparent' => false,
                        'default' => '#ffffff'
                    ),
                    array(
                        'id' => 'notification_bar_closeable',
                        'type' => 'select',
                        'options' => array(
                            'no' => __('No', 'couponxl'),
                            'yes' => __('Yes', 'couponxl')
                        ),
                        'title' => __('Enable Notification Bar To Close', 'couponxl'),
                        'desc' => __('Choose will you allow users to close notification bar.', 'couponxl'),
                        'default' => 'no'
                    ),                    


                )
            );

            // Direction //
            $this->sections[] = array(
                'title' => __('Content Direction', 'couponxl'),
                'desc' => __('Choose overall website text direction which can be RTL (right to left) or LTR (left to right).', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'direction',
                        'type' => 'select',
                        'options' => array(
                            'ltr' => __('LTR', 'couponxl'),
                            'rtl' => __('RTL', 'couponxl')
                        ),
                        'title' => __('Choose site content direction.', 'couponxl'),
                       // 'subtitle' => __('With the "section" field you can create indent option sections.', 'couponxl'), //
                        'desc' => __('Choose overall website text direction which can be RTL (right to left) or LTR (left to right).', 'couponxl'),
                        'default' => 'ltr'
                    )

                )
            );

            // Theme Usage //
            $this->sections[] = array(
                'title' => __('Theme Usage', 'couponxl'),
                'desc' => __('Choose will you use CouponXL for coupons only, deals only or for both.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'theme_usage',
                        'type' => 'select',
                        'options' => array(
                            'all' => __('Coupons & Deals', 'couponxl'),
                            'coupons' => __('Coupons Only', 'couponxl'),
                            'deals' => __('Deals Only', 'couponxl')
                        ),
                        'title' => __('Choose Purpose', 'couponxl'),
                        'desc' => __('Choose will you use CouponXL for coupons only, deals only or for both.', 'couponxl'),
                        'default' => 'all'
                    ),
                    //Number of home sidebars
                    array(
                        'id' => 'home_sidebars',
                        'type' => 'text',
                        'title' => __('Home Sidebars', 'couponxl'),
                        'desc' => __('Input hom many home sidebars you wish to use.', 'couponxl'),
                        'default' => '2'
                    ),                    
                )
            );

            // Theme Usage //
            $this->sections[] = array(
                'title' => __('Permalinks', 'couponxl'),
                'desc' => __('Translate permalinks.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'trans_offer_type',
                        'type' => 'text',
                        'title' => __('Offer Type Slug', 'couponxl'),
                        'desc' => __('Input custom slug for offer type ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'offer_type'
                    ),
                    array(
                        'id' => 'trans_offer_cat',
                        'type' => 'text',
                        'title' => __('Offer Category Slug', 'couponxl'),
                        'desc' => __('Input custom slug for offer category ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'offer_cat'
                    ),
                    array(
                        'id' => 'trans_offer_tag',
                        'type' => 'text',
                        'title' => __('Offer Tag Slug', 'couponxl'),
                        'desc' => __('Input custom slug for offer tag ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'offer_tag'
                    ),
                    array(
                        'id' => 'trans_location',
                        'type' => 'text',
                        'title' => __('Offer Location Slug', 'couponxl'),
                        'desc' => __('Input custom slug for offer location ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'location'
                    ),
                    array(
                        'id' => 'trans_offer_store',
                        'type' => 'text',
                        'title' => __('Offer Store Slug', 'couponxl'),
                        'desc' => __('Input custom slug for offer store for the search purposes ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'offer_store'
                    ),
                    array(
                        'id' => 'trans_offer_view',
                        'type' => 'text',
                        'title' => __('Offer View Slug', 'couponxl'),
                        'desc' => __('Input custom slug for offer view ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'offer_view'
                    ),
                    array(
                        'id' => 'trans_offer_sort',
                        'type' => 'text',
                        'title' => __('Offer Sort Slug', 'couponxl'),
                        'desc' => __('Input custom slug for offer sort ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'offer_sort'
                    ),
                    array(
                        'id' => 'trans_keyword',
                        'type' => 'text',
                        'title' => __('Offer Keyword Slug', 'couponxl'),
                        'desc' => __('Input custom slug for offer keyword ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'keyword'
                    ),
                    array(
                        'id' => 'trans_store',
                        'type' => 'text',
                        'title' => __('Store Custom Post Type Slug', 'couponxl'),
                        'desc' => __('Input custom slug for store custom post type ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'store'
                    ),
                    array(
                        'id' => 'trans_letter',
                        'type' => 'text',
                        'title' => __('Store Letter Custom Post Type Slug', 'couponxl'),
                        'desc' => __('Input custom slug for store letter custom post type ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'letter'
                    ),
                    array(
                        'id' => 'trans_offer',
                        'type' => 'text',
                        'title' => __('Offer Custom Post Type Slug', 'couponxl'),
                        'desc' => __('Input custom slug for offer custom post type ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'offer'
                    ),
                    array(
                        'id' => 'trans_coupon',
                        'type' => 'text',
                        'title' => __('Deal Coupon', 'couponxl'),
                        'desc' => __('Input custom slug for coupon slug ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'coupon'
                    ),
                    array(
                        'id' => 'trans_deal',
                        'type' => 'text',
                        'title' => __('Deal Slug', 'couponxl'),
                        'desc' => __('Input custom slug for deal slug ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'deal'
                    ),
                    array(
                        'id' => 'trans_confirmation_slug',
                        'type' => 'text',
                        'title' => __('Confirmation Hash Slug', 'couponxl'),
                        'desc' => __('Input custom slug for confirmation slug in the email verification email ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'confirmation_slug'
                    ),
                    array(
                        'id' => 'trans_username',
                        'type' => 'text',
                        'title' => __('Username Slug', 'couponxl'),
                        'desc' => __('Input custom slug for username in the email verification email ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'username'
                    ),
                    array(
                        'id' => 'trans_subpage',
                        'type' => 'text',
                        'title' => __('My Profile Subpage Slug', 'couponxl'),
                        'desc' => __('Input custom slug for subpage on my profile pages ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'subpage'
                    ),
                    array(
                        'id' => 'trans_offer_id',
                        'type' => 'text',
                        'title' => __('My Profile Offer ID Slug', 'couponxl'),
                        'desc' => __('Input custom slug for offer id on my profile pages ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'offer_id'
                    ),
                    array(
                        'id' => 'trans_action',
                        'type' => 'text',
                        'title' => __('My Profile Action Slug', 'couponxl'),
                        'desc' => __('Input custom slug for action on my profile pages ( only small letters and underscore ).', 'couponxl'),
                        'default' => 'action'
                    ),                    
                )
            );

            // Main Colors //
            $this->sections[] = array(
                'title' => __('Main Colors', 'couponxl'),
                'desc' => __('Choose overall main color of the website.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'main_color',
                        'type' => 'color',
                        'title' => __('Main Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Choose main website color.', 'couponxl'),
                        'transparent' => false,
                        'default' => '#5b0f70'
                    ),
                    array(
                        'id' => 'main_color_font',
                        'type' => 'color',
                        'title' => __('Font Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Choose font color for the elements with the main color as their background color.', 'couponxl'),
                        'transparent' => false,
                        'default' => '#ffffff'
                    ),
                    array(
                        'id' => 'body_bg_color',
                        'type' => 'color',
                        'title' => __('Background Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Choose overall background color for the site.', 'couponxl'),
                        'transparent' => false,
                        'default' => '#f4f4f4'
                    )

                )
            );
            // Button Colors // 
            $this->sections[] = array(
                'title' => __('Button Colors', 'couponxl'),
                'desc' => __('Choose call to action button colors.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'button_light_green_bg_color',
                        'type' => 'color',
                        'title' => __('Button Background Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Background color for the main buttons.', 'couponxl'),
                        'transparent' => false,
                        'default' => '#5ba835'
                    ),
                    array(
                        'id' => 'button_light_green_font_color',
                        'type' => 'color',
                        'title' => __('Button Font Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Font color for the main buttons.', 'couponxl'),
                        'transparent' => false,
                        'default' => '#ffffff'
                    ),
                    array(
                        'id' => 'button_light_green_bg_color_hvr',
                        'type' => 'color',
                        'title' => __('Main Button Background Color Hover', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Background color of main buttons when hovering', 'couponxl'),
                        'transparent' => false,
                        'default' => '#448722'
                    ),
                    array(
                        'id' => 'button_light_green_font_color_hvr',
                        'type' => 'color',
                        'title' => __('Main Button Font Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Font color of main buttons when hovering', 'couponxl'),
                        'transparent' => false,
                        'default' => '#ffffff'
                    )


                )
            );

            // Slider Setup //
            $this->sections[] = array(
                'title' => __('Slider Setup', 'couponxl'),
                'desc' => __('Choose overall slider settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'slider_auto_rotate',
                        'type' => 'select',
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'title' => __('Slider Auto Rotate', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Enable or disable slider automatic rotation of slides.', 'couponxl'),
                        'default' => 'no'
                    ),
                    array(
                        'id' => 'slider_speed',
                        'type' => 'text',
                        'title' => __('Slider Rotate Speed', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Choose rotation speed of slides', 'couponxl'),
                        'default' => 4000
                    ),
                    array(
                        'id' => 'slide_caption',
                        'type' => 'select',
                        'title' => __('Slide Caption', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Choose type for the slide captions', 'couponxl'),
                        'options' => array(
                        	'' => __( 'Over Image', 'couponxl' ),
                        	'relative' => __( 'Bellow Image', 'couponxl' ),
                        ),
                        'default' => ''
                    )
                )
            );

            // Location Search //
            $this->sections[] = array(
                'title' => __('Default Location', 'couponxl'),
                'desc' => __('Choose default or starting location of the website.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'initial_location',
                        'type' => 'select',
                        'title' => __('Default Location', 'couponxl'),
                        'data' => 'terms',
                        'args' => array(
                            'taxonomies' => 'location',
                            'args' => array()
                        ),
                        'compiler' => 'true',
                        'desc' => __('Assign initial/starting location for website so when visitors visit website they will see deals & coupons from default location.', 'couponxl')
                    )


                )
            );

            // Pick Font //
            $this->sections[] = array(
                'title' => __('Pick Font', 'couponxl'),
                'desc' => __('Choose fonts of the website', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'titles_font',
                        'type' => 'select',
                        'options' => couponxl_google_fonts(),
                        'title' => __('Titles Font', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select font for the titles', 'couponxl'),
                        'default' => 'Montserrat'
                    ),
                    array(
                        'id' => 'text_font',
                        'type' => 'select',
                        'options' => couponxl_google_fonts(),
                        'title' => __('Text Font', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select font for the text', 'couponxl'),
                        'default' => 'Open Sans'
                    )


                )
            );


            // Favicon //
            $this->sections[] = array(
                'title' => __('Favicon', 'couponxl'),
                'desc' => __('Upload favicon for website.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'site_favicon',
                        'type' => 'media',
                        'title' => __('Site Favicon', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Upload site favicon.', 'couponxl')
                    )


                )
            );

            /////////////////////////////////////////////////////////////////////////////////////// 2. TOP BAR //

            $this->sections[] = array(
                'title' => __('Top Bar', 'couponxl'),
                'desc' => __('Setup basic things for top bar. ', 'couponxl'),
                'icon' => '',
                'fields' => array(
                    array(
                        'title' => __('Title', 'couponxl'),
                        'desc' => __('Description and image maybe.', 'couponxl')
                    )
                )
            );


            // General //
            $this->sections[] = array(
                'title' => __('General', 'couponxl'),
                'desc' => __('Basic settings for top bar.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'show_top_bar',
                        'type' => 'select',
                        'title' => __('Show Top Bar', 'couponxl'),
                        'desc' => __('Enable or disable top bar', 'couponxl'),
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'default' => 'yes'
                    )

                )
            );

            // Social //
            $this->sections[] = array(
                'title' => __('Social', 'couponxl'),
                'desc' => __('Top bar social settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'top_bar_facebook_link',
                        'type' => 'text',
                        'title' => __('Facebook Link', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Link to your facebook page', 'couponxl')
                    ),
                    array(
                        'id' => 'top_bar_twitter_link',
                        'type' => 'text',
                        'title' => __('Twitter link', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Link to your twitter page', 'couponxl')
                    ),
                    array(
                        'id' => 'top_bar_google_link',
                        'type' => 'text',
                        'title' => __('Google link', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Link to your google+ page', 'couponxl')
                    )

                )
            );

            // Search //
            $this->sections[] = array(
                'title' => __('Search', 'couponxl'),
                'desc' => __('Top bar search settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'top_bar_location_placeholder',
                        'type' => 'text',
                        'title' => __('Location Placeholder', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input placeholder text for search by location', 'couponxl'),
                        'default' => __('Location ( New Yor, Chicago, ... )', 'couponxl')
                    ),
                    array(
                        'id' => 'top_bar_store_placeholder',
                        'type' => 'text',
                        'title' => __('Store Placeholder', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input placeholder text for search by store', 'couponxl'),
                        'default' => __('Store ( Addidas, nike, ... )', 'couponxl')
                    ),
                    array(
                        'id' => 'keyword_search_placeholder',
                        'type' => 'text',
                        'title' => __('Keyword Placeholder', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input placeholder text for search by keyword', 'couponxl'),
                        'default' => __('Search for... ( 20% off, great deal,... )', 'couponxl')
                    ),                    
                )
            );



            //////////////////////////////////////////////////////////////////////////// 3. HEADER //
            $this->sections[] = array(
                'title' => __('Header', 'couponxl'),
                'desc' => __('Header CouponXL Settings', 'couponxl'),
                'icon' => '',
                'fields' => array(
                    array(
                        'title' => __('Title', 'couponxl'),
                        'desc' => __('Description and image maybe.', 'couponxl')
                    )

                )
            );

            // Logo //
            $this->sections[] = array(
                'title' => __('Logo', 'couponxl'),
                'desc' => __('Upload logo for website.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'site_logo',
                        'type' => 'media',
                        'title' => __('Site Logo', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Upload site logo', 'couponxl')
                    ),
                    array(
                        'id' => 'site_logo_padding',
                        'type' => 'text',
                        'title' => __('Logo Padding', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Set padding for logo if needed ( set 0 if not )', 'couponxl')
                    )


                )
            );

            // Navigation //
            $this->sections[] = array(
                'title' => __('Navigation', 'couponxl'),
                'desc' => __('Set up basic things for navigation.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'navigation_font',
                        'type' => 'select',
                        'options' => couponxl_google_fonts(),
                        'title' => __('Navigation Font', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Font for the navigation', 'couponxl'),
                        'default' => 'Montserrat'
                    ),

                    array(
                        'id' => 'site_navigation_padding',
                        'type' => 'text',
                        'title' => __('Navigation Padding', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Set padding for navigation as needed ( leave 0 if not )', 'couponxl')
                    ),

                    array(
                        'id' => 'enable_sticky',
                        'type' => 'select',
                        'title' => __( 'Enable Sticky Navigation', 'couponxl' ),
                        'compiler' => 'true',
                        'options' => array(
                            'yes' => __( 'Yes', 'couponxl' ),
                            'no' => __( 'No', 'couponxl' ),
                        ),
                        'desc' => __( 'Show or hide sticky navigation', 'couponxl' ),
                        'std' => 'no'
                    )                    

                )
            );

            // Mega Menu //
            $this->sections[] = array(
                'title' => __('Mega Menu', 'couponxl'),
                'desc' => __('Set up mega menu.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'mega_menu_sidebars',
                        'type' => 'text',
                        'title' => __('Mega Menu Sidebars', 'couponxl'),
                        'desc' => __('Input number of mega menu sidebars you wish to use.', 'couponxl'),
                        'default' => '5'
                    ),
                    array(
                        'id' => 'mega_menu_min_height',
                        'type' => 'text',
                        'title' => __('Mega Menu Minimum Height', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input minimum height of the mega menu based on the content you are adding to it.', 'couponxl')
                    )

                )
            );


            ////////////////////////////////////////////////////////////////////// 4. FOOTER //
            $this->sections[] = array(
                'title' => __('Footer', 'couponxl'),
                'desc' => __('Footer CouponXL Settings', 'couponxl'),
                'icon' => '',
                'fields' => array(
                    array(
                        'title' => __('Title', 'couponxl'),
                        'desc' => __('Description and image maybe.', 'couponxl')
                    )

                )
            );


            // To Top //
            $this->sections[] = array(
                'title' => __('To Top', 'couponxl'),
                'desc' => __('To Top Settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'show_to_top',
                        'type' => 'select',
                        'title' => __('Show To Top', 'couponxl'),
                        'desc' => __('Enable or disable scroll to top button', 'couponxl'),
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'default' => 'no'
                    )

                )
            );


            // Copyrights //
            $this->sections[] = array(
                'title' => __('Copyrights', 'couponxl'),
                'desc' => __('Copyrights content.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'footer_copyrights',
                        'type' => 'text',
                        'title' => __('Copyrights', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input copyrights', 'couponxl')
                    )

                )
            );

            // Social //
            $this->sections[] = array(
                'title' => __('Social', 'couponxl'),
                'desc' => __('Setup social profiles in footer.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'footer_facebook',
                        'type' => 'text',
                        'title' => __('Facebook link', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input link to your facebook page', 'couponxl')
                    ),
                    array(
                        'id' => 'footer_twitter',
                        'type' => 'text',
                        'title' => __('Twitter', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input link to your twitter page', 'couponxl')
                    ),
                    array(
                        'id' => 'footer_google',
                        'type' => 'text',
                        'title' => __('Google+', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input link to your google+ page', 'couponxl')
                    )

                )
            );


            ///////////////////////////////////////////////////////////////////////////////////////////// 5. HOME PAGE //
            $this->sections[] = array(
                'title' => __('Home Page', 'couponxl'),
                'desc' => __('Home Page CouponXL Settings', 'couponxl'),
                'icon' => '',
                'fields' => array(
                    array(
                        'title' => __('Title', 'couponxl'),
                        'desc' => __('Description and image maybe.', 'couponxl')
                    )

                )
            );

            // Big Map //
            $this->sections[] = array(
                'title' => __('Geo Home Page', 'couponxl'),
                'desc' => __('Home page big map settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'show_big_map',
                        'type' => 'select',
                        'options' => array(
                            'no' => __( 'No', 'couponxl' ),
                            'yes' => __( 'Yes', 'couponxl' ),
                        ),
                        'title' => __('Show Big Map', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Show or hide big map', 'couponxl'),
                        'default' => 'no'
                    ),
                    array(
                        'id' => 'big_map_source',
                        'type' => 'select',
                        'options' => array(
                            'stores' => __( 'Stores', 'couponxl' ),
                            'deals' => __( 'Deals', 'couponxl' ),
                        ),
                        'title' => __('Big Map Marker Source', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select source of the markers for displaying on the big map', 'couponxl'),
                        'default' => 'stores'
                    ),
                    array(
                        'id' => 'big_map_height',
                        'type' => 'text',
                        'title' => __('Big Map Height', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input height of the big map in pixels', 'couponxl'),
                        'default' => '400px'
                    ),
                )
            );            

            // Background //
            $this->sections[] = array(
                'title' => __('Background', 'couponxl'),
                'desc' => __('Home page background settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'home_page_bg_image',
                        'type' => 'media',
                        'title' => __('Home Page Background Image', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background image for home page', 'couponxl')
                    ),
                    array(
                        'id' => 'home_page_bg_image_repeat',
                        'type' => 'select',
                        'title' => __('Home Page Background Image Repeat', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background image repeat for home page', 'couponxl'),
                        'options' => array(
                            'repeat' => __('Repeat', 'couponxl'),
                            'repeat-y' => __('Repeat Y', 'couponxl'),
                            'repeat-x' => __('Repeat X', 'couponxl'),
                            'no-repeat' => __('No Repeat', 'couponxl')
                        ),
                        'default' => 'no-repeat'
                    ),
                    array(
                        'id' => 'home_page_bg_image_size',
                        'type' => 'select',
                        'title' => __('Home Page Background Image Size', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background image size for home page', 'couponxl'),
                        'options' => array(
                            'auto' => __('Auto', 'couponxl'),
                            'cover' => __('Cover', 'couponxl'),
                            'contain' => __('Contain', 'couponxl')
                        ),
                        'default' => 'auto'
                    )

                )
            );

            // Intro Content //
            $this->sections[] = array(
                'title' => __('Intro Content', 'couponxl'),
                'desc' => __('Home page intro content.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'home_page_show_title',
                        'type' => 'select',
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'title' => __('Show Title / Subtitle', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Show or hide title and subtitle.', 'couponxl'),
                        'default' => 'yes'
                    ),
                    array(
                        'id' => 'home_page_title',
                        'type' => 'text',
                        'title' => __('Title', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input home page title here', 'couponxl')
                    ),
                    array(
                        'id' => 'home_page_subtitle',
                        'type' => 'text',
                        'title' => __('Subtitle', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input home page subtitle here. use %stores% to place stores number and %locations% to add number of available location if you desire.', 'couponxl')
                    )

                )
            );


            // Search //
            $this->sections[] = array(
                'title' => __('Search', 'couponxl'),
                'desc' => __('Search Settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'home_page_show_search',
                        'type' => 'select',
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'title' => __('Show Search', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Show or hide home page search bar.', 'couponxl'),
                        'default' => 'yes'
                    ),
                    array(
                        'id' => 'home_page_search_location_placeholder',
                        'type' => 'text',
                        'title' => __('Search Location Placeholder', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input text which will be placeholder for the search by location input box on home page.', 'couponxl'),
                        'default' => __('Location ( New York, Chicago... )', 'couponxl')
                    ),
                    array(
                        'id' => 'home_page_search_location_desc',
                        'type' => 'text',
                        'title' => __('Search Location Description', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input text which will be description for the search by location input box on home page.', 'couponxl'),
                        'default' => __('Example: Detroit US, Washington DC ...', 'couponxl')
                    ),
                    array(
                        'id' => 'home_page_search_store_placeholder',
                        'type' => 'text',
                        'title' => __('Search Store Placeholder', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input text which will be placeholder for the search by store input box on home page.', 'couponxl'),
                        'default' => __('What are you looking for?', 'couponxl')
                    ),
                    array(
                        'id' => 'home_page_search_store_desc',
                        'type' => 'text',
                        'title' => __('Search Store Description', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input text which will be description for the search by store input box on home page.', 'couponxl'),
                        'default' => __('Example: Wallmart, Nike, Reebok, Dell, Apple, Addidas ...', 'couponxl')
                    )

                )
            );


            // Home Slider //
            $this->sections[] = array(
                'title' => __('Slider Items', 'couponxl'),
                'desc' => __('Home page slider items.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'home_page_slider_items',
                        'type' => 'post_type_ajax',
                        'post_type' => 'offer',
                        'multi' => true,
                        'sortable' => true,
                        'title' => __('Slider Items', 'couponxl'),
                        'desc' => __('Select items you wish to display in home page slider ( click on whitespace )', 'couponxl'),
                        'additional' => array(
                            'meta_query' => array(
                                'relation' => 'AND',
                                array(
                                    'key' => 'offer_in_slider',
                                    'value' => 'yes',
                                    'compare' => '='
                                ),
                                array(
                                    'key' => 'offer_start',
                                    'value' => current_time('timestamp'),
                                    'compare' => '<='
                                ),
                                array(
                                    'key' => 'offer_expire',
                                    'value' => current_time('timestamp'),
                                    'compare' => '>='
                                ),
                                array(
                                    'key' => 'deal_status',
                                    'value' => 'has_items',
                                    'compare' => '='
                                ),
                            )
                        )
                    )
                )
            );

            // Colors //
            $this->sections[] = array(
                'title' => __('Colors', 'couponxl'),
                'desc' => __('Set up colors for search and content on home page.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'home_page_main_title_font_color',
                        'type' => 'color',
                        'title' => __('Home Page Main Title Font Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select font color for home page main title', 'couponxl'),
                        'transparent' => false,
                        'default' => '#ffffff'
                    ),

                    array(
                        'id' => 'home_page_search_input_bg_color',
                        'type' => 'color',
                        'title' => __('Home Page Search Input Bg Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background color for home page search input', 'couponxl'),
                        'transparent' => false,
                        'default' => '#ffffff'
                    ),
                    array(
                        'id' => 'home_page_search_input_border_color',
                        'type' => 'color',
                        'title' => __('Home Page Search Input Border Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select border color for home page search input', 'couponxl'),
                        'transparent' => false,
                        'default' => '#ffffff'
                    ),
                    array(
                        'id' => 'home_page_search_input_placeholder_color',
                        'type' => 'color',
                        'title' => __('Home Page Search Input Placeholder Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select font color for home page search input placeholder', 'couponxl'),
                        'transparent' => false,
                        'default' => '#2f3336'
                    ),
                    array(
                        'id' => 'home_page_search_input_font_color',
                        'type' => 'color',
                        'title' => __('Home Page Search Input Font Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select font color for home page search input', 'couponxl'),
                        'transparent' => false,
                        'default' => '#2f3336'
                    ),
                    array(
                        'id' => 'home_page_search_input_bg_color_focus',
                        'type' => 'color',
                        'title' => __('Home Page Search Input Bg Color On Focus', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background color for home page search input on focus ( when user is typing in it)', 'couponxl'),
                        'transparent' => false
                    ),
                    array(
                        'id' => 'home_page_search_input_border_color_focus',
                        'type' => 'color',
                        'title' => __('Home Page Search Input Border Color On Focus', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select border color for home page search input on focus ( when user is typing in it )', 'couponxl'),
                        'transparent' => false,
                        'default' => '#ffffff'
                    ),
                    array(
                        'id' => 'home_page_search_input_font_color_focus',
                        'type' => 'color',
                        'title' => __('Home Page Search Input Font Color On Focus', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select font color for home page search input on focus ( when user is typing in it )', 'couponxl'),
                        'transparent' => false,
                        'default' => '#ffffff'
                    ),
                    array(
                        'id' => 'home_page_search_dropdown_bg_color',
                        'type' => 'color',
                        'title' => __('Home Page Search Dropdown BG Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background color for home page search dropdown', 'couponxl'),
                        'transparent' => false,
                        'default' => '#ffffff'
                    ),
                    array(
                        'id' => 'home_page_search_dropdown_font_color',
                        'type' => 'color',
                        'title' => __('Home Page Search Dropdown Font Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select font color for home page search dropdown', 'couponxl'),
                        'transparent' => false,
                        'default' => '#202020'
                    ),
                    array(
                        'id' => 'home_page_search_dropdown_bg_color_hvr',
                        'type' => 'color',
                        'title' => __('Home Page Search Dropdown BG Color On Hover', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background color for home page search dropdown on hover', 'couponxl'),
                        'transparent' => false,
                        'default' => '#d4d4d4'
                    ),
                    array(
                        'id' => 'home_page_search_dropdown_font_color_hvr',
                        'type' => 'color',
                        'title' => __('Home Page Search Dropdown BG Color On Hover', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background color for home page search dropdown on hover', 'couponxl'),
                        'transparent' => false,
                        'default' => '#202020'
                    )

                )
            );


            /////////////////////////////////////////////////////////////////////////////////////////// 6. INNER PAGES //
            $this->sections[] = array(
                'title' => __('Inner Pages', 'couponxl'),
                'desc' => __('Setup basic things for inner pages.', 'couponxl'),
                'icon' => '',
                'fields' => array(
                    array(
                        'title' => __('Title', 'couponxl'),
                        'desc' => __('Description and image maybe.', 'couponxl')
                    )
                )
            );

            // Page Title //
            $this->sections[] = array(
                'title' => __('Page Title', 'couponxl'),
                'desc' => __('Choose basic things for page title on inner pages.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'page_title_bg_color',
                        'type' => 'color',
                        'title' => __('Page Title BG Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background color for the page titles', 'couponxl'),
                        'transparent' => false,
                        'default' => '#5b0f70'
                    ),
                    array(
                        'id' => 'page_title_bg_image',
                        'type' => 'media',
                        'title' => __('Page Title BG Image', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background image for the page titles', 'couponxl')
                    ),
                    array(
                        'id' => 'page_title_bg_image_repeat',
                        'type' => 'select',
                        'title' => __('Page Title Background Image Repeat', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background image repeat for the page title', 'couponxl'),
                        'options' => array(
                            'repeat' => __('Repeat', 'couponxl'),
                            'repeat-y' => __('Repeat Y', 'couponxl'),
                            'repeat-x' => __('Repeat X', 'couponxl'),
                            'no-repeat' => __('No Repeat', 'couponxl')
                        ),
                        'default' => 'no-repeat'
                    ),
                    array(
                        'id' => 'page_title_bg_image_size',
                        'type' => 'select',
                        'title' => __('Page Title Background Image Size', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background image size for the page title', 'couponxl'),
                        'options' => array(
                            'auto' => __('Auto', 'couponxl'),
                            'cover' => __('Cover', 'couponxl'),
                            'contain' => __('Contain', 'couponxl')
                        ),
                        'default' => 'auto'
                    ),
                    array(
                        'id' => 'page_title_font_color',
                        'type' => 'color',
                        'title' => __('Page Title Font Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select font color for the page titles', 'couponxl'),
                        'transparent' => false,
                        'default' => '#ffffff'
                    )
                )
            );

            // Blog Subtitle //
            $this->sections[] = array(
                'title' => __('Blog Subtitle', 'couponxl'),
                'desc' => __('Choose blog options.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'blog_subtitle',
                        'type' => 'text',
                        'title' => __('Blogs Subtitle', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input blog subtitle', 'couponxl'),
                    ),
                )
            );

            // Search Page //
            $this->sections[] = array(
                'title' => __('Search Page', 'couponxl'),
                'desc' => __('Set search page options.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'search_sidebar_location',
                        'type' => 'select',
                        'options' => array(
                            'left' => __( 'Left', 'couponxl' ),
                            'right' => __( 'Right', 'couponxl' ),
                        ),
                        'title' => __('Sidebar Position', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select position of the sidebar on the search page.', 'couponxl'),
                        'default' => 'left'
                    ),
                )
            );

            // Offer Subtitle //
            $this->sections[] = array(
                'title' => __('Offer Subtitle', 'couponxl'),
                'desc' => __('Choose offer options.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'offer_subtitle',
                        'type' => 'text',
                        'title' => __('Offers Subtitle', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input offers subtitle', 'couponxl'),
                    ),
                )
            );

            // Breadcrumbs //
            $this->sections[] = array(
                'title' => __('Breadcrumbs', 'couponxl'),
                'desc' => __('Setup breadcrumbs basic things on inner pages.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'show_breadcrumbs',
                        'type' => 'select',
                        'options' => array(
                            'no' => __('No', 'couponxl'),
                            'yes' => __('Yes', 'couponxl')
                        ),
                        'title' => __('Show Breadcrumbs', 'couponxl'),
                        'desc' => __('Show or hide breadcrumbs instead of the page title', 'couponxl'),
                        'default' => 'no'
                    ),
                    array(
                        'id' => 'breadcrumbs_bg_color',
                        'type' => 'color',
                        'title' => __('Breadcrumbs BG Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select background color for the breadcrumbs', 'couponxl'),
                        'transparent' => false
                    ),
                    array(
                        'id' => 'breadcrumbs_font_color',
                        'type' => 'color',
                        'title' => __('Breadcrumbs Font Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select font color for the breadcrumbs', 'couponxl'),
                        'transparent' => false
                    ),
                    array(
                        'id' => 'breadcrumbs_link_font_color',
                        'type' => 'color',
                        'title' => __('Breadcrumbs Link Font Color', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select link font color for the breadcrumbs', 'couponxl'),
                        'transparent' => false
                    ),
                    array(
                        'id' => 'breadcrumbs_link_font_color_hvr',
                        'type' => 'color',
                        'title' => __('Breadcrumbs Link Font Color On Hover', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select link font color for the breadcrumbs on hover', 'couponxl'),
                        'transparent' => false
                    )
                )
            );

            // All Categories Page //
            $this->sections[] = array(
                'title' => __('All Categories Page', 'couponxl'),
                'desc' => __('Set options for the all categories page.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'all_categories_sortby',
                        'type' => 'select',
                        'options' => array(
                            'name' => __( 'Name', 'couponxl' ),
                            'slug' => __( 'Slug', 'couponxl' ),
                            'count' => __( 'Offers Count', 'couponxl' ),
                        ),
                        'title' => __('Sort Categories By', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Choose by which field to sort listing of all categories', 'couponxl'),
                        'default' => 'name'
                    ),

                    array(
                        'id' => 'all_categories_sort',
                        'type' => 'select',
                        'options' => array(
                            'asc' => __( 'Ascending', 'couponxl' ),
                            'desc' => __( 'Descending', 'couponxl' ),
                        ),
                        'title' => __('Categories Sort Order', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Choose how to sort listing of all categories', 'couponxl'),
                        'default' => 'asc'
                    ),                    
                )
            );

            // All Locations Page //
            $this->sections[] = array(
                'title' => __('All Locations Page', 'couponxl'),
                'desc' => __('Set options for the all locations page.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'all_locations_sortby',
                        'type' => 'select',
                        'options' => array(
                            'name' => __( 'Name', 'couponxl' ),
                            'slug' => __( 'Slug', 'couponxl' ),
                            'count' => __( 'Offers Count', 'couponxl' ),
                        ),
                        'title' => __('Sort Locations By', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Choose by which field to sort listing of all locations', 'couponxl'),
                        'default' => 'name'
                    ),

                    array(
                        'id' => 'all_locations_sort',
                        'type' => 'select',
                        'options' => array(
                            'asc' => __( 'Ascending', 'couponxl' ),
                            'desc' => __( 'Descending', 'couponxl' ),
                        ),
                        'title' => __('Categories Sort Order', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Choose how to sort listing of all locations', 'couponxl'),
                        'default' => 'asc'
                    ),                    
                )
            );

            /////////////////////////////////////////////////////////////////////////////////////////// 7. CONTACT PAGE //
            $this->sections[] = array(
                'title' => __('Contact Page', 'couponxl'),
                'desc' => __('Contact page settings.', 'couponxl'),
                'icon' => '',
                'fields' => array(
                    array(
                        'title' => __('Title', 'couponxl'),
                        'desc' => __('Description and image maybe.', 'couponxl')
                    )
                )
            );


            // Contact Details //
            $this->sections[] = array(
                'title' => __('Contact Details', 'couponxl'),
                'desc' => __('Setup contact details here.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'contact_mail',
                        'type' => 'text',
                        'title' => __('Mail', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input email where sent messages will arrive', 'couponxl')
                    ),
                    array(
                        'id' => 'contact_form_subject',
                        'type' => 'text',
                        'title' => __('Mail Subject', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input subject for the message.', 'couponxl')
                    )

                )
            );

            // Google Map //
            $this->sections[] = array(
                'title' => __('Google Map', 'couponxl'),
                'desc' => __('Setup google map details here.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'contact_map',
                        'type' => 'multi_text',
                        'title' => __('Google Map Markers', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input longitudes and latitudes separated by comma for example 92.3123,-105.54353 (longitude,latitude). <a href="http://www.latlong.net/" target="_blank">Find Long/Lat</a>', 'couponxl')
                    ),
                    array(
                        'id' => 'contact_map_scroll_zoom',
                        'type' => 'select',
                        'title' => __('Disable Scroll Zoom', 'couponxl'),
                        'compiler' => 'true',
                        'options' => array(
                            'no' => __('No', 'couponxl'),
                            'yes' => __('Yes', 'couponxl')
                        ),
                        'desc' => __('Enable or disable zoom on scroll of the contact map.', 'couponxl'),
                        'default' => 'no'
                    ),
                    array(
                        'id' => 'contact_map_max_zoom',
                        'type' => 'text',
                        'title' => __('Google Map Max Zoom', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input value from 0 to 19 to set zoom or leave empty to zoom untill all markers are dispalyed.', 'couponxl')
                    ),

                )
            );

            /////////////////////////////////////////////////////////////////////////////////// 8. OFFERS //
            $this->sections[] = array(
                'title' => __('Offers', 'couponxl'),
                'desc' => __('Offers setup.', 'couponxl'),
                'icon' => '',
                'fields' => array(
                    array(
                        'title' => __('Title', 'couponxl'),
                        'desc' => __('Description and image maybe.', 'couponxl')
                    )
                )
            );

            // Terms //
            $this->sections[] = array(
                'title' => __('Terms', 'couponxl'),
                'desc' => __('Show terms and conditions on submit page.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'terms',
                        'type' => 'editor',
                        'title' => __('Terms & Conditions', 'couponxl'),
                        'desc' => __('Input terms and conditions which users must accept in order to submit offer or leave empty to disable.', 'couponxl'),
                        'default' => ''
                    )

                )
            );

            // Slider //
            $this->sections[] = array(
                'title' => __('Slider', 'couponxl'),
                'desc' => __('Show slider in listing/main search page.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'show_search_slider',
                        'type' => 'select',
                        'title' => __('Slider On Search Page', 'couponxl'),
                        'desc' => __('Show or hide slider on the search page', 'couponxl'),
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'default' => 'yes'
                    )

                )
            );


            // Listing //
            $this->sections[] = array(
                'title' => __('Listing', 'couponxl'),
                'desc' => __('Setup basic things for stores and offers pages.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'default_offer_listing',
                        'type' => 'select',
                        'options' => array(
                            'grid' => __('Grid', 'couponxl'),
                            'list' => __('List', 'couponxl')
                        ),
                        'title' => __('Default Offer Listing', 'couponxl'),
                        'desc' => __('Select default listing for the offers', 'couponxl'),
                        'default' => 'grid'
                    ),

                    array(
                        'id' => 'stores_per_page',
                        'type' => 'text',
                        'title' => __('Stores Per Page', 'couponxl'),
                        'desc' => __('Select how many stores to show per page', 'couponxl')
                    ),

                    array(
                        'id' => 'offers_per_page',
                        'type' => 'text',
                        'title' => __('Offers Per Page', 'couponxl'),
                        'desc' => __('Select how many offers to show per page', 'couponxl')
                    ),
                    array(
                        'id' => 'store_no_offers_message',
                        'type' => 'text',
                        'title' => __('No Offers From Store Message', 'couponxl'),
                        'desc' => __('Input notification text which will be disaplyed on the store single page when there is no associated offers.', 'couponxl'),
                        'std' => __( 'Currently there is no coupons and deals for this store.', 'couponxl' )
                    ),

                    array(
                        'id' => 'search_no_offers_message',
                        'type' => 'text',
                        'title' => __('No Search Results Message', 'couponxl'),
                        'desc' => __('Input notification text which will be disaplyed on the search page when there is no offers found.', 'couponxl'),
                        'std' => __( 'No deals and coupons found.', 'couponxl' )
                    ),                    

                )
            );

            // Filter By //
            $this->sections[] = array(
                'title' => __('Filter By', 'couponxl'),
                'desc' => __('Sidebar filter basic options.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'search_page_offer_type_filter_title',
                        'type' => 'text',
                        'title' => __('Offer Type Filter Title', 'couponxl'),
                        'desc' => __('Input title for the filter by offer type on search page', 'couponxl'),
                        'default' => __( 'I\'m looking for', 'couponxl' )
                    ),
                    array(
                        'id' => 'search_page_category_filter_title',
                        'type' => 'text',
                        'title' => __('Category Filter Title', 'couponxl'),
                        'desc' => __('Input title for the filter by category on search page', 'couponxl'),
                        'default' => __( 'Category', 'couponxl' )
                    ),
                    array(
                        'id' => 'search_page_location_filter_title',
                        'type' => 'text',
                        'title' => __('Location Filter Title', 'couponxl'),
                        'desc' => __('Input title for the filter by offer type on search page', 'couponxl'),
                        'default' => __( 'Location', 'couponxl' )
                    ),
                    array(
                        'id' => 'search_show_count',
                        'type' => 'select',
                        'title' => __('Search Filter Number Of Offers', 'couponxl'),
                        'desc' => __('Show or hide number of offers for a certain location / category on search page.', 'couponxl'),
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'default' => 'yes'
                    ),
                    array(
                        'id' => 'search_include_empty',
                        'type' => 'select',
                        'title' => __('Search Filter Show Empty', 'couponxl'),
                        'desc' => __('Show or hide empty locations / categories on the search page.', 'couponxl'),
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'default' => 'yes'
                    ),
                    array(
                        'id' => 'search_visible_categories_count',
                        'type' => 'text',
                        'title' => __('Visible Search Categories', 'couponxl'),
                        'desc' => __('Number of visible categories to show on the search page before show all categories button', 'couponxl'),
                        'default' => '6'
                    ),
                    array(
                        'id' => 'search_visible_locations_count',
                        'type' => 'text',
                        'title' => __('Visible Search Locations', 'couponxl'),
                        'desc' => __('Number of visible location to show on the search page before show all lcoations button', 'couponxl'),
                        'default' => '6'
                    )

                )
            );

            // Sort By //
            $this->sections[] = array(
                'title' => __('Sort By', 'couponxl'),
                'desc' => __('Body sort by filter basic options.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'show_filter_bar',
                        'type' => 'select',
                        'title' => __('Show Filter Bar', 'couponxl'),
                        'desc' => __('Show or hide sort by filter.', 'couponxl'),
                        'options' => array(
                            'yes' => __( 'Yes', 'couponxl' ),
                            'no' => __( 'No', 'couponxl' ),
                        ),
                        'default' => 'yes'
                    )

                )
            );


            // Deal Single //
            $this->sections[] = array(
                'title' => __('Deal Page', 'couponxl'),
                'desc' => __('Settings for deal single page.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'deal_show_bought',
                        'type' => 'select',
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'title' => __('Show Bought Information', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Show information on how many people bought deal', 'couponxl'),
                        'default' => 'yes'
                    ),
                    array(
                        'id' => 'deal_show_similar',
                        'type' => 'select',
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'title' => __('Show Similar Deals', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Show similar deals on deals single page', 'couponxl'),
                        'default' => 'yes'
                    ),
                    array(
                        'id' => 'similar_offers',
                        'type' => 'text',
                        'title' => __('Number Of Similar Deals', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input number of similar deals to show on deal single page', 'couponxl'),
                        'default' => '2'
                    ),
                    array(
                        'id' => 'deal_show_author',
                        'type' => 'select',
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'title' => __('Show Author On Deals Single Page', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Show author info on deal single page', 'couponxl'),
                        'default' => 'yes'
                    ),
                    array(
                        'id' => 'deal_map_max_zoom',
                        'type' => 'text',
                        'title' => __('Deal Map Max Zoom', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input value from 0 to 19 to set zoom or leave empty to zoom untill all markers are dispalyed.', 'couponxl')
                    ),
                )
            );

            // Coupon Single //
            $this->sections[] = array(
                'title' => __('Coupon Page', 'couponxl'),
                'desc' => __('Settings for coupon single page.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'coupon_modal_content',
                        'type' => 'select',
                        'options' => array(
                            'content' => __('Whole Content', 'couponxl'),
                            'excerpt' => __('Excerpt Only', 'couponxl')
                        ),
                        'title' => __('Modal Content', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Select what to show in modal', 'couponxl'),
                        'default' => 'content'
                    ),                    
                    array(
                        'id' => 'coupon_show_similar',
                        'type' => 'select',
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'title' => __('Show Similar Coupons', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Show similar coupon on deals single page', 'couponxl'),
                        'default' => 'yes'
                    ),
                    array(
                        'id' => 'coupon_similar_offers',
                        'type' => 'text',
                        'title' => __('Number Of Similar Coupons', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input number of similar coupon to show on deal single page', 'couponxl'),
                        'default' => '2'
                    ),
                    array(
                        'id' => 'coupon_show_author',
                        'type' => 'select',
                        'options' => array(
                            'yes' => __('Yes', 'couponxl'),
                            'no' => __('No', 'couponxl')
                        ),
                        'title' => __('Show Author On Coupon Single Page', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Show author info on coupon single page', 'couponxl'),
                        'default' => 'yes'
                    )
                )
            );

            // Payments //
            $this->sections[] = array(
                'title' => __('Payments', 'couponxl'),
                'desc' => __('Payments sharing setup.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'deal_owner_price_shared',
                        'type' => 'text',
                        'title' => __('Website Offer Fee', 'couponxl'),
                        'desc' => __('Input number without currency symbol for fixed fee. Input percentage with percentage symbol for percentage based fee.', 'couponxl')
                    ),
                    array(
                        'id' => 'deal_owner_price_not_shared',
                        'type' => 'text',
                        'title' => __('Store Offer Fee', 'couponxl'),
                        'desc' => __('Input number without currency symbol for fixed fee. Input percentage with percentage symbol for percentage based fee.', 'couponxl')
                    ),
                    array(
                        'id' => 'deal_submit_price',
                        'type' => 'text',
                        'title' => __('Submit Deal Fee', 'couponxl'),
                        'desc' => __('Input number without currency symbol. This is amount which will be charged from the seller for each submited deal. ( Leave empty to disable this fee. )', 'couponxl')
                    ),
                    array(
                        'id' => 'coupon_submit_price',
                        'type' => 'text',
                        'title' => __('Submit Coupon Fee', 'couponxl'),
                        'desc' => __('Input number without currency symbol. This is  amount which will be charged from the seller for each submited coupon. ( Leave empty to disable this fee. )', 'couponxl')
                    )

                )
            );

            // Submitting //
            $this->sections[] = array(
                'title' => __('Submitting', 'couponxl'),
                'desc' => __('Submitting deals & coupons settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'unlimited_expire',
                        'type' => 'select',
                        'title' => __('Allow Unlimited Expire Date', 'couponxl'),
                        'compiler' => 'true',
                        'options' => array(
                            'no' => __('No', 'couponxl'),
                            'yes' => __('Yes', 'couponxl')
                        ),
                        'desc' => __('Allow or disallow unlimited expire date for deals and coupons.', 'couponxl'),
                        'default' => 'no'
                    ),
                    array(
                        'id' => 'date_ranges',
                        'type' => 'text',
                        'title' => __('Maximum Date Ranges', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input maximum number of days between start and expire date.', 'couponxl')
                    )

                )
            );

            ///////////////////////////////////////////////////////////////////////////////////////// 9. MESSAGING //



            $this->sections[] = array(
                'title' => __('Messaging', 'couponxl'),
                'desc' => __('Interaction trough emails settings.', 'couponxl'),
                'icon' => '',
                'fields' => array(
                    array(
                        'title' => __('Title', 'couponxl'),
                        'desc' => __('Description and image maybe.', 'couponxl')
                    )
                )
            );

            // Registration //
            $this->sections[] = array(
                'title' => __('Registration', 'couponxl'),
                'desc' => __('Registration basic settings setup.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'registration_message',
                        'type' => 'textarea',
                        'title' => __('Registration Message', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input registration message which will be sent to the users to verify their email address. Put %LINK% in the place you want to show confirmation link.', 'couponxl')
                    ),
                    array(
                        'id' => 'registration_subject',
                        'type' => 'text',
                        'title' => __('Registration Message Subject', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input registration message subject.', 'couponxl')
                    ),
                    array(
                        'id' => 'register_terms',
                        'type' => 'editor',
                        'title' => __('Terms & Conditions', 'couponxl'),
                        'desc' => __('Input terms and conditions which users must accept in order to register on site .', 'couponxl'),
                        'default' => ''
                    )

                )
            );

            // Purchase //
            $this->sections[] = array(
                'title' => __('Purchase Message', 'couponxl'),
                'desc' => __('Purchase message basic settings setup.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'purchase_message',
                        'type' => 'textarea',
                        'title' => __('Purchase Message', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input purchase message which will be sent to the users after they purchase deal voucher. Input %TITLE% on the place where you would like to show deal title and %VOUCHER% on place where voucher should be displayed.', 'couponxl')
                    ),
                    array(
                        'id' => 'purchase_message_expire',
                        'type' => 'textarea',
                        'title' => __('Expire Message Part', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input expire message which will be sent to the users after they purchase deal voucher ( this will be added after the the prvious mesage ). Input %EXPIRE% on the place where you would like to show time until voucher is valid if it iset in deal.', 'couponxl')
                    ),
                    array(
                        'id' => 'purchase_message_subject',
                        'type' => 'text',
                        'title' => __('Purchase Message Subject', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input purchase message subject', 'couponxl')
                    )                    

                )
            );

            // Registration //
            $this->sections[] = array(
                'title' => __('New Offers', 'couponxl'),
                'desc' => __('New offers basic settings setup.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'new_offer_email',
                        'type' => 'text',
                        'title' => __('New Offer Email', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input email address on which information about new submission will arrive.', 'couponxl')
                    ),
                )
            );


            // Registration //
            $this->sections[] = array(
                'title' => __('Send To Friend', 'couponxl'),
                'desc' => __('Settings for send to friend action.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'send_friend_subject',
                        'type' => 'text',
                        'title' => __('Subject', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input email subject.', 'couponxl')
                    ),
                )
            );
            // Lost Password //
            $this->sections[] = array(
                'title' => __('Lost password', 'couponxl'),
                'desc' => __('Lost password basic settings setup.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'lost_password_message',
                        'type' => 'textarea',
                        'title' => __('Lost Password Message', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input lost password message which will be sent to the users to verify their email address. Put %PASSWORD% in the place you want to show new password and put %USERNAME% where to place username.', 'couponxl')
                    ),
                    array(
                        'id' => 'lost_password_subject',
                        'type' => 'text',
                        'title' => __('Lost Password Message Subject', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input lost password message subject.', 'couponxl')
                    ),
                    array(
                        'id' => 'email_sender',
                        'type' => 'text',
                        'title' => __('Email Of Sender', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input email address you wish to show on the email messages.', 'couponxl')
                    ),
                    array(
                        'id' => 'name_sender',
                        'type' => 'text',
                        'title' => __('Name Of Sender', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input name you wish to show on the email messages.', 'couponxl')
                    )

                )
            );
            // Discussion //
            $this->sections[] = array(
                'title' => __('Discussion', 'couponxl'),
                'desc' => __('Discussion basic settings setup.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'discussion_form_subject',
                        'type' => 'text',
                        'title' => __('Discussion Mail Subject', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input email subject for the discussion message.', 'couponxl')
                    ),
                    array(
                        'id' => 'discussion_form_mail',
                        'type' => 'text',
                        'title' => __('Discussion Mail', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input email where the discussion messages will arrive.', 'couponxl')
                    ),
                    array(
                        'id' => 'discussion_form_mail_name',
                        'type' => 'text',
                        'title' => __('Discussion Mail Sender Name', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input sender name for the discussion mail.', 'couponxl')
                    )

                )
            );

            ///////////////////////////////////////////////////////////////////////////////////////// 10. API //



            $this->sections[] = array(
                'title' => __('API Setup', 'couponxl'),
                'desc' => __('Setup external API needed for different website services.', 'couponxl'),
                'icon' => '',
                'fields' => array(
                    array(
                        'title' => __('Title', 'couponxl'),
                        'desc' => __('Description and image maybe.', 'couponxl')
                    )
                )
            );

            // PayPal API //
            $this->sections[] = array(
                'title' => __('PayPal API', 'couponxl'),
                'desc' => __('Important PayPal Settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'paypal_mode',
                        'type' => 'select',
                        'title' => __('PayPal Mode', 'couponxl'),
                        'compiler' => 'true',
                        'options' => array(
                            '' => __('Live mode', 'couponxl'),
                            '.sandbox' => __('Testing mode', 'couponxl')
                        )
                    ),
                    array(
                        'id' => 'unit',
                        'type' => 'text',
                        'title' => __('Main Currency Unit', 'couponxl'),
                        'desc' => __('Input main currency unit. ($, £, €, руб).', 'couponxl')
                    ),
                    array(
                        'id' => 'main_unit_abbr',
                        'type' => 'text',
                        'title' => __('Main Currency Unit Abbreviation', 'couponxl'),
                        'desc' => __('Input main currency unit abbreviation.  (USD, EUR, RUB, AUD, GBP...)', 'couponxl')
                    ),
                    array(
                        'id' => 'unit_position',
                        'title' => __('Unit Position', 'couponxl'),
                        'desc' => __('Select position of the unit.', 'couponxl'),
                        'type' => 'select',
                        'options' => array(
                            'front' => __('Front', 'couponxl'),
                            'back' => __('Back', 'couponxl')
                        )
                    ),
                    array(
                        'id' => 'paypal_username',
                        'type' => 'text',
                        'title' => __('Paypal API Username', 'couponxl'),
                        'desc' => __('Input paypal API username here.', 'couponxl')
                    ),
                    array(
                        'id' => 'paypal_password',
                        'type' => 'text',
                        'title' => __('Paypal API Password', 'couponxl'),
                        'desc' => __('Input paypal API password here.', 'couponxl')
                    ),
                    array(
                        'id' => 'paypal_signature',
                        'type' => 'text',
                        'title' => __('Paypal API Signature', 'couponxl'),
                        'desc' => __('Input paypal API signature here.', 'couponxl')
                    )

                )
            );

            // Stripe API //
            $this->sections[] = array(
                'title' => __('Stripe API', 'couponxl'),
                'desc' => __('Important Stripe Settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'pk_client_id',
                        'type' => 'text',
                        'title' => __('Public Client ID', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input your stripe public client ID', 'couponxl')
                    ),
                    array(
                        'id' => 'sk_client_id',
                        'type' => 'text',
                        'title' => __('Secret Client ID', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input your stripe secret client ID', 'couponxl')
                    ),
                    array(
                        'id' => 'ap_client_id',
                        'type' => 'text',
                        'title' => __('Application Client ID', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input your stripe secret application client ID', 'couponxl')
                    ),

                )
            );

            // Skrill API //
            $this->sections[] = array(
                'title' => __('Skrill API', 'couponxl'),
                'desc' => __('Important Skrill Settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'skrill_owner_mail',
                        'type' => 'text',
                        'title' => __('You skrill mail', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input your email which is connected with your skrill account.', 'couponxl')
                    ),
                    array(
                        'id' => 'skrill_secret_word',
                        'type' => 'text',
                        'title' => __('You skrill secret word', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input your scrill secret word.', 'couponxl')
                    ),
                    array(
                        'id' => 'skrill_api_mqi_password',
                        'type' => 'text',
                        'title' => __('Your API/MQI password.', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input your API/MQI password.', 'couponxl')
                    ),                    
                )
            );

            // iDEAL API //
            $this->sections[] = array(
                'title' => __('iDEAL API', 'couponxl'),
                'desc' => __('Important iDEAL Settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'mollie_id',
                        'type' => 'text',
                        'title' => __('Mollie ID', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input your mollie ID to connect to iDEAL', 'couponxl')
                    ),
                    array(
                        'id' => 'ideal_mode',
                        'type' => 'select',
                        'title' => __('iDEAL Model', 'couponxl'),
                        'compiler' => 'true',
                        'options' => array(
                            'live' => __( 'Live Mode', 'couponxl' ),
                            'test' => __( 'Test Mode', 'couponxl' )
                        ),
                        'desc' => __('Select iDEAL mode', 'couponxl'),
                        'default' => 'live'
                    ),
                )
            );

            // iDEAL API //
            $this->sections[] = array(
                'title' => __('PayU Money', 'couponxl'),
                'desc' => __('Important PayU Money Settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(
                    array(
                        'id' => 'payu_merchant_key',
                        'type' => 'text',
                        'title' => __('Merchant Key', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input your merchant key to connect to PayU', 'couponxl')
                    ),
                    array(
                        'id' => 'payu_merchant_salt',
                        'type' => 'text',
                        'title' => __('Merchant Salt', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input your merchant salt to connect to PayU', 'couponxl')
                    ),
                    array(
                        'id' => 'payu_mode',
                        'type' => 'select',
                        'title' => __('PayU Model', 'couponxl'),
                        'compiler' => 'true',
                        'options' => array(
                            'secure' => __( 'Live Mode', 'couponxl' ),
                            'test' => __( 'Test Mode', 'couponxl' )
                        ),
                        'desc' => __('Select PayU mode', 'couponxl'),
                        'default' => 'secure'
                    ),                    
                )
            );

            // Mailchimp API //
            $this->sections[] = array(
                'title' => __('Mail chimp API', 'couponxl'),
                'desc' => __('Important PayPal Settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    array(
                        'id' => 'mail_chimp_api',
                        'type' => 'text',
                        'title' => __('Mail Chimp API', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input API key of your MailChimp. More <a href="http://kb.mailchimp.com/accounts/management/about-api-keys" target="_blank">here</a>', 'couponxl')
                    ),
                    array(
                        'id' => 'mail_chimp_list_id',
                        'type' => 'text',
                        'title' => __('Mail Chimp List ID', 'couponxl'),
                        'compiler' => 'true',
                        'desc' => __('Input ID of the ailchimp list on which the users will subscribe. More <a href="http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id" target="_blank">here</a>', 'couponxl')
                    )

                )
            );
            // Twitter API //

            $this->sections[] = array(
                'title' => __('Twitter API', 'couponxl'),
                'desc' => __('Twitter API Settings.', 'couponxl'),
                'icon' => '',
                'subsection' => true,
                'fields' => array(

                    //Username
                    array(
                        'id' => 'twitter-username',
                        'type' => 'text',
                        'title' => __('Twitter Username', 'couponxl'),
                        'desc' => __('Input your twitter username.', 'couponxl')
                    ),
                    //Access Token 
                    array(
                        'id' => 'twitter-oauth_access_token',
                        'type' => 'text',
                        'title' => __('OAuth Access Token', 'couponxl'),
                        'desc' => __('Input your oauth access token.', 'couponxl')
                    ),
                    //Access Token Secret
                    array(
                        'id' => 'twitter-oauth_access_token_secret',
                        'type' => 'text',
                        'title' => __('OAuth Access Token Secret', 'couponxl'),
                        'desc' => __('Input your oauth access token secret.', 'couponxl')
                    ),

                    //Consumer Key 
                    array(
                        'id' => 'twitter-consumer_key',
                        'type' => 'text',
                        'title' => __('Consumer Key', 'couponxl'),
                        'desc' => __('Input your consumer key.', 'couponxl')
                    ),

                    //Consumer Key Secret
                    array(
                        'id' => 'twitter-consumer_secret',
                        'type' => 'text',
                        'title' => __('Consumer Secret', 'couponxl'),
                        'desc' => __('Input your consumer secret.', 'couponxl')
                    )

                )
            );


        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments()
        {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'couponxl_options',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'),
                // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'),
                // Version that appears at the top of your panel
                'menu_type' => 'menu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true,
                // Show the sections below the admin menu item or not
                'menu_title' => __('CouponXL', 'redux-framework-demo'),
                'page_title' => __('CouponXL', 'redux-framework-demo'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography' => true,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar' => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon' => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable' => '',
                // Set a different name for your global variable other than the opt_name
                'dev_mode' => false,
                // Show the time the page took to load, etc
                'update_notice' => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer' => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority' => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options',
                // Permissions needed to access the options panel.
                //'menu_icon'            => get_template_directory_uri().'/images/icon.png',
                // Specify a custom URL to an icon
                'last_tab' => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options',
                // Page slug used to denote the panel
                'save_defaults' => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show' => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false,
                // REMOVE

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
                        'style' => ''
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right'
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'mouseover'
                        ),
                        'hide' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'click mouseleave'
                        )
                    )
                )
            );


        }

    }

    global $couponxl_opts;
    $couponxl_opts = new CouponXL_Options();
} else {
    echo "The class named CouponXL_Options has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
}