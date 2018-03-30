<?php

/**
Venedor Settings File
For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_venedor_settings')) {

    class Redux_Framework_venedor_settings {

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
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        function compiler_action($options, $css, $changed_values) {

        }

        function dynamic_section($sections) {

            return $sections;
        }

        function change_arguments($args) {

            return $args;
        }

        function change_defaults($defaults) {

            return $defaults;
        }

        function remove_demo() {

        }

        public function setSections() {

            //Background Patterns Reader
            $venedor_patterns_path = get_template_directory() . '/images/_textures/';
            $venedor_patterns_url  = get_template_directory_uri() . '/images/_textures/';
            $venedor_patterns      = array();

            $venedor_banner_type = venedor_ct_banner_type();
            $venedor_banner_width = venedor_ct_banner_width();
            $venedor_rev_sliders = venedor_ct_rev_sliders();
            $venedor_layer_sliders = venedor_ct_layer_sliders();

            if ( is_dir( $venedor_patterns_path ) ) :

                if ( $venedor_patterns_dir = opendir( $venedor_patterns_path ) ) :
                    $venedor_patterns = array();

                    while ( ( $venedor_patterns_file = readdir( $venedor_patterns_dir ) ) !== false ) {

                        if( stristr( $venedor_patterns_file, '.png' ) !== false || stristr( $venedor_patterns_file, '.jpg' ) !== false ) {
                            $name = explode(".", $venedor_patterns_file);
                            $name = str_replace('.'.end($name), '', $venedor_patterns_file);
                            $venedor_patterns[] = array( 'alt'=>$name,'img' => $venedor_patterns_url . $venedor_patterns_file );
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct = wp_get_theme();
            $theme_data = $ct;
            $item_name = $theme_data->get('Name');
            $tags = $ct->Tags;
            $screenshot = $ct->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(  'Customize &#8220;%s&#8221;', $ct->display('Name') );

            ?>
        <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
            <?php if ( $screenshot ) : ?>
            <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr( $customize_title ); ?>">
                    <img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php echo 'Current theme preview' ; ?>" />
                </a>
                <?php endif; ?>
            <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php echo 'Current theme preview' ; ?>" />
            <?php endif; ?>

            <h4>
                <?php echo $ct->display('Name'); ?>
            </h4>

            <div>
                <ul class="theme-info">
                    <li><?php printf( 'By %s', $ct->display('Author') ); ?></li>
                    <li><?php printf( 'Version %s', $ct->display('Version') ); ?></li>
                    <li><?php echo '<strong>'.'Tags'.':</strong> '; ?><?php printf( $ct->display('Tags') ); ?></li>
                </ul>
                <p class="theme-description"><?php echo $ct->display('Description'); ?></p>
                <?php if ( $ct->parent() ) {
                printf( ' <p class="howto">' . 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' . '</p>',
                     'http://codex.wordpress.org/Child_Themes',
                    $ct->parent()->display( 'Name' ) );
            } ?>
            </div>
        </div>

        <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            // You can append a new section at any time.
            // General Settings
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'title' => 'General',
                'fields' => array(

                    array(
                        'id'=>'wrapper-layout',
                        'type' => 'switch',
                        'title' => 'Theme Wrapper',
                        'default' => '1',
                        'on' => 'Full Width',
                        'off' => 'Boxed',
                    ),

                    array(
                        'id'=>'layout',
                        'type' => 'image_select',
                        'compiler'=>true,
                        'title' => 'Main Layout',
                        'options' => array(
                            'fullwidth' => array('alt' => 'Full Width', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
                            'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cr.png')
                        ),
                        'default' => 'right-sidebar'
                    ),

                    array(
                        'id'=>'page-comment',
                        'type' => 'switch',
                        'title' => 'Show Comment Form on Page',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => 'Logo, Icons'
                    ),

                    array(
                        'id'=>'logo',
                        'type' => 'media',
                        'url'=> true,
                        'title' => 'Logo',
                        'compiler' => 'true',
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/logo/logo'.VENEDOR_SETTINGS.'.png',
                        )),

                    array(
                        'id'=>'logo-on-banner',
                        'type' => 'media',
                        'url'=> true,
                        'title' => 'Logo (Header on Banner)',
                        'compiler' => 'true',
                        'desc' => "This logo will be show when header appears on banner. If not set, will be show default logo.",
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/logo/logo_banner.png',
                        )),

                    array(
                        'id'=>'sticky-logo',
                        'type' => 'media',
                        'url'=> true,
                        'title' => 'Sticky Header Logo',
                        'compiler' => 'true',
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/logo/logo'.VENEDOR_SETTINGS.'.png',
                        )),

                    array(
                        'id'=>'favicon',
                        'type' => 'media',
                        'url'=> true,
                        'title' => 'Favicon',
                        'compiler' => 'true',
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/logo/favicon.ico',
                        )),

                    array(
                        'id'=>'icon-iphone',
                        'type' => 'media',
                        'url'=> true,
                        'title' => 'Apple iPhone Icon',
                        'compiler' => 'true',
                        'desc' => 'Icon for Apple iPhone (57px X 57px)',
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/logo/apple-touch-icon.png',
                        )),

                    array(
                        'id'=>'icon-iphone-retina',
                        'type' => 'media',
                        'url'=> true,
                        'title' => 'Apple iPhone Retina Icon',
                        'compiler' => 'true',
                        'desc' => 'Icon for Apple iPhone Retina (114px X 114px)',
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/logo/apple-touch-icon-114x114.png',
                        )),

                    array(
                        'id'=>'icon-ipad',
                        'type' => 'media',
                        'url'=> true,
                        'title' => 'Apple iPad Icon',
                        'compiler' => 'true',
                        'desc' => 'Icon for Apple iPad (72px X 72px)',
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/logo/apple-touch-icon-72x72.png',
                        )),

                    array(
                        'id'=>'icon-ipad-retina',
                        'type' => 'media',
                        'url'=> true,
                        'title' => 'Apple iPad Retina Icon',
                        'compiler' => 'true',
                        'desc' => 'Icon for Apple iPad Retina (144px X 144px)',
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/logo/apple-touch-icon-144x144.png',
                        )),

                    array(
                        'id'=>'4',
                        'type' => 'info',
                        'desc' => 'Tracking Code'
                    ),

                    array(
                        'id'=>'tracking-code',
                        'type' => 'textarea',
                        'title' => 'Tracking Code',
                        'subtitle' => 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.'
                    ),

                    array(
                        'id'=>'4',
                        'type' => 'info',
                        'desc' => 'Javascript Code'
                    ),

                    array(
                        'id'=>'js-code',
                        'type' => 'ace_editor',
                        'title' => 'JS Code',
                        'subtitle' => 'Paste your JS code here.',
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'desc' => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        'default' => "jQuery(document).ready(function(){\n\n});"
                    ),
                )
            );

            // Plugin Settings
            $this->sections[] = array(
                'icon' => 'el-icon-wrench',
                'icon_class' => 'icon',
                'title' => 'Plugin Settings',
                'fields' => array(

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => 'Enable / Disable Plugins Integrated Within The Theme'
                    ),

                    array(
                        'id'=>'posts-type-order',
                        'type' => 'switch',
                        'title' => 'Enable Posts Type Order Plugin',
                        'desc' => 'Note: It can break the order of next post/previous post links.',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    )
                ),
            );

            // Header Settings
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'icon_class' => 'icon',
                'title' => 'Header',
                'fields' => array(

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => 'Header Top'
                    ),

                    array(
                        'id'=>'show-header-top',
                        'type' => 'switch',
                        'title' => 'Show Header Top',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'show-header-login',
                        'type' => 'switch',
                        'title' => 'Show Login & Register / Logout Link',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'topnav-pos',
                        'type' => 'button_set',
                        'title' => 'Top Navigation Position',
                        'options' => array('none' => 'None','left' => 'Left','right' => 'Right'),
                        'default' => 'left'
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => 'Header'
                    ),

                    array(
                        'id'=>'logo-pos',
                        'type' => 'button_set',
                        'title' => 'Logo Position',
                        'options' => array('left' => 'Left', 'center' => 'Center'),
                        'default' => 'left'
                    ),

                    array(
                        'id'=>'wpml-switcher',
                        'type' => 'switch',
                        'title' => 'Show WPML Switcher',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'switcher-pos',
                        'type' => 'button_set',
                        'title' => 'View Switcher Position',
                        'options' => array('none' => 'None', 'top' => 'Top','middle' => 'Middle', 'bottom' => 'Bottom'),
                        'default' => 'top'
                    ),

                    array(
                        'id'=>'minicart-pos',
                        'type' => 'button_set',
                        'title' => 'Mini Cart Position',
                        'options' => array('none' => 'None', 'top' => 'Top','middle' => 'Middle', 'bottom' => 'Bottom'),
                        'default' => 'top'
                    ),

                    array(
                        'id'=>'show-minicart-icon',
                        'type' => 'switch',
                        'title' => 'Show Only Mini Cart Icon',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'show-searchform',
                        'type' => 'switch',
                        'title' => 'Show Search Form',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'search-type',
                        'type' => 'button_set',
                        'title' => 'Search Post Type',
                        'options' => array('all' => 'All', 'post' => 'Post','product' => 'Product'),
                        'default' => 'product'
                    ),

                    array(
                        'id'=>'search-pos',
                        'type' => 'button_set',
                        'title' => 'Search Form Position',
                        'options' => array('middle' => 'Middle', 'bottom' => 'Bottom'),
                        'default' => 'bottom'
                    ),

                    array(
                        'id'=>'search-popup',
                        'type' => 'switch',
                        'required' => array('show-searchform','equals','1'),
                        'title' => 'Toggle Search Form',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'welcome-msg',
                        'type' => 'text',
                        'title' => 'Welcome Message',
                        'default' => 'Welcome message!'
                    ),

                    array(
                        'id'=>'header-contact-block',
                        'type' => 'text',
                        'title' => 'Header Contact Block',
                        'desc' => 'Input static block name',
                        'default' => ''
                    ),

                    array(
                        'id'=>'header-contact-pos',
                        'type' => 'button_set',
                        'title' => 'Header Contact Position',
                        'options' => array('left' => 'Left', 'bottom' => 'Bottom'),
                        'default' => 'bottom'
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => 'Main Menu'
                    ),

                    array(
                        'id'=>'menu-align',
                        'type' => 'button_set',
                        'title' => 'Menu Position',
                        'options' => array('left' => 'Left','right' => 'Right'),
                        'default' => 'right'
                    ),

                    array(
                        'id'=>'menu-item-padding',
                        'type' => 'button_set',
                        'title' => 'Menu Item Padding in Level 1',
                        'options' => array('dynamic' => 'Dynamic', 'static' => 'Static'),
                        'desc' => 'If set to "Dynamic", menu wrapper width will be container width and menu item padding will be calculate dynamically.',
                        'default' => 'static'
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => 'Sticky Header'
                    ),

                    array(
                        'id'=>'enable-sticky-header',
                        'type' => 'switch',
                        'title' => 'Enable Sticky Header',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'show-sticky-logo',
                        'type' => 'switch',
                        'title' => 'Show Logo on Sticky Header',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'show-sticky-searchform',
                        'type' => 'switch',
                        'title' => 'Show Search Form',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'show-sticky-switcher',
                        'type' => 'switch',
                        'title' => 'Show Switcher',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'show-sticky-minicart',
                        'type' => 'switch',
                        'title' => 'Show Mini Cart',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'show-sticky-minicart-icon',
                        'type' => 'switch',
                        'title' => 'Show Only Mini Cart Icon',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),
                )
            );

            // Breadcrumbs Settings
            $this->sections[] = array(
                'icon' => 'el-icon-minus',
                'icon_class' => 'icon',
                'title' => 'Breadcrumbs',
                'fields' => array(
                    array(
                        'id'=>'show-breadcrumbs',
                        'type' => 'switch',
                        'title' => 'Show Breadcrumbs',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'breadcrumbs-before-banner',
                        'type' => 'switch',
                        'required' => array('show-breadcrumbs','equals','1'),
                        'title' => 'Show Breadcrumbs Before Banner',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'breadcrumbs-separator',
                        'type' => 'select',
                        'title' => 'Separator',
                        'options' => array('>'=>'>', '|'=>'|', '/'=>'/'),
                        'default' => '>',
                    )
                )
            );

            // Footer Settings
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'icon_class' => 'icon',
                'title' => 'Footer',
                'fields' => array(

                    array(
                        'id' => "footer-copyright",
                        'type' => 'textarea',
                        'title' => 'Copyright',
                        'default' => '&copy; 2014 Venedor Store. All Rights Reserved.'
                    ),

                    array(
                        'id' => '1',
                        'type' => 'info',
                        'desc' => 'Social Links'
                    ),

                    array(
                        'id' => "footer-social-facebook",
                        'type' => 'text',
                        'title' => 'Facebook',
                        'default' => '#'
                    ),

                    array(
                        'id' => "footer-social-twitter",
                        'type' => 'text',
                        'title' => 'Twitter',
                        'default' => '#'
                    ),

                    array(
                        'id' => "footer-social-rss",
                        'type' => 'text',
                        'title' => 'RSS',
                        'default' => '#'
                    ),

                    array(
                        'id' => "footer-social-pinterest",
                        'type' => 'text',
                        'title' => 'Pinterest',
                        'default' => '#'
                    ),

                    array(
                        'id' => "footer-social-youtube",
                        'type' => 'text',
                        'title' => 'Youtube',
                        'default' => '#'
                    ),

                    array(
                        'id' => "footer-social-instagram",
                        'type' => 'text',
                        'title' => 'Instagram',
                        'default' => '#'
                    ),

                    array(
                        'id' => "footer-social-skype",
                        'type' => 'text',
                        'title' => 'Skype',
                        'default' => '#'
                    ),

                    array(
                        'id' => "footer-social-linkedin",
                        'type' => 'text',
                        'title' => 'LinkedIn',
                        'default' => '#'
                    ),

                    array(
                        'id' => "footer-social-googleplus",
                        'type' => 'text',
                        'title' => 'Google Plus',
                        'default' => '#'
                    ),
                )
            );

            // Homepage
            $this->sections[] = array(
                'icon' => 'el-icon-home',
                'icon_class' => 'icon',
                'title' => 'Homepage',
                'fields' => array(

                    array(
                        'id' => '1',
                        'type' => 'info',
                        'desc' => '<strong>If select the home page to a static page, the settings will be ignore.</strong>'
                    ),

                    array(
                        'id'=>'home-layout',
                        'type' => 'image_select',
                        'compiler'=>true,
                        'title' => 'Main Layout',
                        'options' => array(
                            'fullwidth' => array('alt' => 'Full Width', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
                            'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cr.png')
                        ),
                        'default' => 'right-sidebar'
                    ),

                    array(
                        'id'=>'home-header-on-banner',
                        'type' => 'button_set',
                        'title' => 'Header on Banner',
                        'options' => array('header_on_banner' => 'Yes','' => 'No'),
                        'desc' => 'Show header on banner. When select <strong>"Banner Type"</strong> to <strong>"Layerslider"</strong>, <strong>"Revolution Slider"</strong> or <strong>"Banner"</strong>, this option will be work.',
                        'default' => ''
                    ),

                    array(
                        'id'=>'home-bg-slider',
                        'type' => 'select',
                        'compiler'=>true,
                        'title' => 'Home Background Slider',
                        'options' => $venedor_rev_sliders,
                        'desc' => 'Select the Background Revolution Slider. If you should select <strong>"Banner Type"</strong> to <strong>"Revolution Slider"</strong>, this will be <strong>synchronize</strong> with <strong>banner revolution slider</strong>.',
                        'default' => 0
                    ),

                    array(
                        'id'=>'home-banner-type',
                        'type' => 'select',
                        'compiler'=>true,
                        'title' => 'Home Banner Type',
                        'options' => $venedor_banner_type,
                        'default' => 0
                    ),

                    array(
                        'id'=>'home-banner-width',
                        'type' => 'select',
                        'compiler'=>true,
                        'title' => 'Home Banner Width',
                        'options' => $venedor_banner_width,
                        'default' => 'wide'
                    ),

                    array(
                        'id'=>'home-layerslider',
                        'type' => 'select',
                        'compiler'=>true,
                        'required' => array('home-banner-type','equals','layer_slider'),
                        'title' => 'Layer Slider',
                        'options' => $venedor_layer_sliders,
                        'default' => 0
                    ),

                    array(
                        'id'=>'home-revslider',
                        'type' => 'select',
                        'compiler'=>true,
                        'required' => array('home-banner-type','equals','rev_slider'),
                        'title' => 'Revolution Slider',
                        'options' => $venedor_rev_sliders,
                        'default' => 0
                    ),

                    array(
                        'id'=>'home-productslider',
                        'type' => 'text',
                        'required' => array('home-banner-type','equals','product_slider'),
                        'title' => 'Product IDs for Slider',
                        'desc' => 'Comma separated list of product ids.'
                    ),

                    array(
                        'id'=>'home-banner',
                        'type' => 'editor',
                        'required' => array('home-banner-type','equals','banner'),
                        'title' => 'Banner',
                        'desc' => 'You can edit using shortcodes.'
                    ),

                    array(
                        'id'=>'home-content-top',
                        'type' => 'text',
                        'title' => 'Content Top',
                        'desc' => 'Input the content top block.'
                    ),

                    array(
                        'id'=>'home-content-bottom',
                        'type' => 'text',
                        'title' => 'Content Bottom',
                        'desc' => 'Input the content bottom block.',
                        'default' => 'brands-slider'
                    ),
                )
            );

            // Blog
            $this->sections[] = array(
                'icon' => 'el-icon-bookmark',
                'icon_class' => 'icon',
                'title' => 'Blog & Single Post',
                'fields' => array(

                    array(
                        'id' => '1',
                        'type' => 'info',
                        'desc' => 'Blog'
                    ),

                    array(
                        'id'=>'blog-title',
                        'type' => 'text',
                        'title' => 'Blog Title',
                        'default' => 'Blog'
                    ),

                    array(
                        'id'=>'blog-layout',
                        'type' => 'image_select',
                        'compiler'=>true,
                        'title' => 'Main Layout',
                        'options' => array(
                            'fullwidth' => array('alt' => 'Full Width', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
                            'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cr.png')
                        ),
                        'default' => 'right-sidebar'
                    ),

                    array(
                        'id'=>'blog-header-on-banner',
                        'type' => 'button_set',
                        'title' => 'Header on Banner',
                        'options' => array('header_on_banner' => 'Yes','' => 'No'),
                        'desc' => 'Show header on banner. When select <strong>"Banner Type"</strong> to <strong>"Layerslider"</strong>, <strong>"Revolution Slider"</strong> or <strong>"Banner"</strong>, this option will be work.',
                        'default' => ''
                    ),

                    array(
                        'id'=>'blog-bg-slider',
                        'type' => 'select',
                        'compiler'=>true,
                        'title' => 'Blog Background Slider',
                        'options' => $venedor_rev_sliders,
                        'desc' => 'Select the Background Revolution Slider. If you should select <strong>"Banner Type"</strong> to <strong>"Revolution Slider"</strong>, this will be <strong>synchronize</strong> with <strong>banner revolution slider</strong>.',
                        'default' => 0
                    ),

                    array(
                        'id'=>'blog-banner-type',
                        'type' => 'select',
                        'compiler'=>true,
                        'title' => 'Blog Banner Type',
                        'options' => $venedor_banner_type,
                        'default' => 0
                    ),

                    array(
                        'id'=>'blog-banner-width',
                        'type' => 'select',
                        'compiler'=>true,
                        'title' => 'Blog Banner Width',
                        'options' => $venedor_banner_width,
                        'default' => 'wide'
                    ),

                    array(
                        'id'=>'blog-layerslider',
                        'type' => 'select',
                        'compiler'=>true,
                        'required' => array('blog-banner-type','equals','layer_slider'),
                        'title' => 'Layer Slider',
                        'options' => $venedor_layer_sliders,
                        'default' => 0
                    ),

                    array(
                        'id'=>'blog-revslider',
                        'type' => 'select',
                        'compiler'=>true,
                        'required' => array('blog-banner-type','equals','rev_slider'),
                        'title' => 'Revolution Slider',
                        'options' => $venedor_rev_sliders,
                        'default' => 0
                    ),

                    array(
                        'id'=>'blog-productslider',
                        'type' => 'text',
                        'required' => array('blog-banner-type','equals','product_slider'),
                        'title' => 'Product IDs for Slider',
                        'desc' => 'Comma separated list of product ids.'
                    ),

                    array(
                        'id'=>'blog-banner',
                        'type' => 'editor',
                        'required' => array('blog-banner-type','equals','banner'),
                        'title' => 'Banner',
                        'desc' => 'You can edit using shortcodes.'
                    ),

                    array(
                        'id'=>'blog-content-top',
                        'type' => 'text',
                        'title' => 'Content Top',
                        'desc' => 'Input the content top block.'
                    ),

                    array(
                        'id'=>'blog-content-bottom',
                        'type' => 'text',
                        'title' => 'Content Bottom',
                        'desc' => 'Input the content bottom block.',
                        'default' => ''
                    ),

                    array(
                        'id'=>'post-layout',
                        'type' => 'button_set',
                        'title' => 'Post Layout',
                        'options' => array('large-alt' => 'Large Alternate','medium-alt' => 'Medium Alternate', 'small-alt' => 'Small Alternate', 'grid' => 'Grid', 'timeline' => 'Timeline'),
                        'default' => 'medium-alt'
                    ),

                    array(
                        'id'=>'blog-infinite',
                        'type' => 'switch',
                        'title' => 'Enable Infinite Scroll',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'post-format',
                        'type' => 'switch',
                        'title' => 'Show Post Format',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'blog-excerpt',
                        'type' => 'switch',
                        'title' => 'Show Excerpt',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'blog-excerpt-length',
                        'type' => 'text',
                        'title' => 'Excerpt Length',
                        'desc' => 'The number of words',
                        'default' => '80',
                    ),

                    array(
                        'id'=>'blog-excerpt-type',
                        'type' => 'button_set',
                        'title' => 'Excerpt Type',
                        'options' => array('text' => 'Text','html' => 'HTML'),
                        'default' => 'text'
                    ),

                    array(
                        'id'=>'post-zoom',
                        'type' => 'switch',
                        'title' => 'Slideshow Zoom Effect',
                        'default' => '1',
                        'on' => 'Enable',
                        'off' => 'Disable',
                    ),

                    array(
                        'id' => '1',
                        'type' => 'info',
                        'desc' => 'Single Post'
                    ),

                    array(
                        'id'=>'single-post-layout',
                        'type' => 'image_select',
                        'compiler'=>true,
                        'title' => 'Main Layout',
                        'options' => array(
                            'fullwidth' => array('alt' => 'Full Width', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
                            'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cr.png')
                        ),
                        'default' => 'right-sidebar'
                    ),

                    array(
                        'id'=>'post-page-nav',
                        'type' => 'switch',
                        'title' => 'Show Prev/Next Navigation',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'post-slideshow-count',
                        'type' => 'text',
                        'title' => 'Number of Slideshow Images',
                        'desc' => 'The number of featurd image boxes for blog slideshows.',
                        'default' => '5'
                    ),

                    array(
                        'id'=>'post-content-layout',
                        'type' => 'button_set',
                        'title' => 'Post Layout',
                        'options' => array('large-alt' => 'Large Alternate','medium-alt' => 'Medium Alternate'),
                        'default' => 'medium-alt'
                    ),

                    array(
                        'id'=>'post-author',
                        'type' => 'switch',
                        'title' => 'Show Author Info',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'post-related',
                        'type' => 'switch',
                        'title' => 'Show Related Posts',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'post-comments',
                        'type' => 'switch',
                        'title' => 'Show Comments',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'post-addthis-above',
                        'type' => 'switch',
                        'title' => 'Show Addthis Buttons above Content',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'post-addthis-below',
                        'type' => 'switch',
                        'title' => 'Show Addthis Buttons below Content',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),
                )
            );

            // Portfolio
            $this->sections[] = array(
                'icon' => 'el-icon-camera',
                'icon_class' => 'icon',
                'title' => 'Portfolio',
                'fields' => array(

                    array(
                        'id' => "portfolio-slug-name",
                        'type' => 'text',
                        'title' => 'Slug Name',
                        'description' => 'You should click <strong>"Save Changes"</strong> in <strong>Settings > Permalinks</strong> after save changes.',
                        'default' => 'portfolio-items'
                    ),

                    array(
                        'id' => "portfolio-name",
                        'type' => 'text',
                        'title' => 'Name',
                        'default' => 'Portfolios'
                    ),

                    array(
                        'id' => "portfolio-singular-name",
                        'type' => 'text',
                        'title' => 'Singular Name',
                        'default' => 'Portfolio'
                    ),

                    array(
                        'id' => "portfolio-cat-slug-name",
                        'type' => 'text',
                        'title' => 'Category Slug Name',
                        'description' => 'You should click <strong>"Save Changes"</strong> in <strong>Settings > Permalinks</strong> after save changes.',
                        'default' => 'portfolio_cat'
                    ),

                    array(
                        'id' => "portfolio-skill-slug-name",
                        'type' => 'text',
                        'title' => 'Skill Slug Name',
                        'description' => 'You should click <strong>"Save Changes"</strong> in <strong>Settings > Permalinks</strong> after save changes.',
                        'default' => 'portfolio_skills'
                    ),

                    array(
                        'id'=>'portfolio-layout',
                        'type' => 'image_select',
                        'compiler'=>true,
                        'title' => 'Main Layout',
                        'options' => array(
                            'fullwidth' => array('alt' => 'Full Width', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
                            'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cr.png')
                        ),
                        'default' => 'right-sidebar'
                    ),

                    array(
                        'id'=>'portfolio-items',
                        'type' => 'text',
                        'title' => 'Number of Portfolios',
                        'desc' => 'The number of portfolios per portfolio page.',
                        'default' => '8'
                    ),

                    array(
                        'id'=>'portfolio-zoom',
                        'type' => 'switch',
                        'title' => 'Slideshow Zoom Effect',
                        'default' => '1',
                        'on' => 'Enable',
                        'off' => 'Disable',
                    ),

                    array(
                        'id'=>'portfolio-slideshow-count',
                        'type' => 'text',
                        'title' => 'Number of Slideshow Images',
                        'desc' => 'The number of featurd image boxes for portfolio slideshows.',
                        'default' => '5'
                    ),

                    array(
                        'id'=>'portfolio-page-nav',
                        'type' => 'switch',
                        'title' => 'Show Prev/Next Navigation',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'portfolio-content-layout',
                        'type' => 'button_set',
                        'title' => 'Portfolio Layout',
                        'options' => array('large-alt' => 'Large Alternate','medium-alt' => 'Medium Alternate'),
                        'default' => 'medium-alt'
                    ),

                    array(
                        'id'=>'portfolio-related',
                        'type' => 'switch',
                        'title' => 'Show Related Portfolios',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'portfolio-addthis',
                        'type' => 'switch',
                        'title' => 'Show Addthis Buttons',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),
                )
            );

            // FAQ
            $this->sections[] = array(
                'icon' => 'el-icon-question',
                'icon_class' => 'icon',
                'title' => 'FAQ',
                'fields' => array(

                    array(
                        'id' => "faq-slug-name",
                        'type' => 'text',
                        'title' => 'Slug Name',
                        'description' => 'You should click <strong>"Save Changes"</strong> in <strong>Settings > Permalinks</strong> after save changes.',
                        'default' => 'faq-items'
                    ),

                    array(
                        'id' => "faq-name",
                        'type' => 'text',
                        'title' => 'Name',
                        'default' => 'FAQs'
                    ),

                    array(
                        'id' => "faq-singular-name",
                        'type' => 'text',
                        'title' => 'Singular Name',
                        'default' => 'FAQ'
                    ),

                    array(
                        'id' => "faq-cat-slug-name",
                        'type' => 'text',
                        'title' => 'Category Slug Name',
                        'description' => 'You should click <strong>"Save Changes"</strong> in <strong>Settings > Permalinks</strong> after save changes.',
                        'default' => 'faq_cat'
                    ),
                )
            );

            // Image Sizes
            $this->sections[] = array(
                'icon' => 'el-icon-picture',
                'icon_class' => 'icon',
                'title' => 'Image Sizes',
                'fields' => array(

                    array(
                        'id' => '1',
                        'type' => 'info',
                        'desc' => 'You should regenerate the images in <strong>"Tools/Regen. Thumbnails"</strong> after <strong>"Save Changes"</strong>.'
                    ),

                    array(
                        'id' => '1',
                        'type' => 'info',
                        'desc' => 'Post'
                    ),

                    array(
                        'id'=>'related-post-w',
                        'type' => 'text',
                        'title' => 'Related Post Width',
                        'default' => '400'
                    ),

                    array(
                        'id'=>'related-post-h',
                        'type' => 'text',
                        'title' => 'Related Post Height',
                        'default' => '184'
                    ),

                    array(
                        'id' => '1',
                        'type' => 'info',
                        'desc' => 'Portfolio'
                    ),

                    array(
                        'id'=>'related-portfolio-w',
                        'type' => 'text',
                        'title' => 'Related Portfolio Width',
                        'default' => '400'
                    ),

                    array(
                        'id'=>'related-portfolio-h',
                        'type' => 'text',
                        'title' => 'Related Portfolio Height',
                        'default' => '320'
                    ),
                )
            );

            // Category
            $this->sections[] = array(
                'icon' => 'el-icon-briefcase',
                'icon_class' => 'icon',
                'title' => 'Shop & Category (Woocommerce)',
                'fields' => array(
                    array(
                        'id'=>'woocategory-layout',
                        'type' => 'image_select',
                        'compiler'=>true,
                        'title' => 'Main Layout',
                        'options' => array(
                            'fullwidth' => array('alt' => 'Full Width', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
                            'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cr.png')
                        ),
                        'default' => 'right-sidebar'
                    ),

                    array(
                        'id'=>'category-banner',
                        'type' => 'switch',
                        'title' => 'Show Category Banner',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'category-title',
                        'type' => 'switch',
                        'title' => 'Show Title',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'category-description',
                        'type' => 'switch',
                        'title' => 'Show Description',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'category-mobile-filter',
                        'type' => 'switch',
                        'title' => 'Show Filter Panel on Mobile',
                        'desc' => 'Show filter panel for mobile category view with sidebar.',
                        'default' => true,
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'category-view',
                        'type' => 'button_set',
                        'title' => 'Product View Type',
                        'options' => array('' => 'Default', 'grid' => 'Grid','list' => 'List'),
                        'default' => ''
                    ),

                    array(
                        'id'=>'category-item',
                        'type' => 'text',
                        'title' => 'Products per Page',
                        'desc' => 'Comma-separated.',
                        'default' => '9,15,30'
                    ),

                    array(
                        'id'=>'category-image-effect',
                        'type' => 'switch',
                        'title' => 'Show Image Hover Effect',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'category-calc-height',
                        'type' => 'switch',
                        'title' => 'Calculate Height in Grid View',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'category-hover',
                        'type' => 'switch',
                        'title' => 'Enable Hover Effect',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'category-addcart-icon',
                        'type' => 'switch',
                        'title' => 'Use Add Cart Icon when Hover in Grid View',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'category-align',
                        'type' => 'button_set',
                        'title' => 'Description Align',
                        'options' => array('left' => 'Left','center' => 'Center'),
                        'default' => 'center'
                    ),

                    array(
                        'id'=>'category-product-desc',
                        'type' => 'switch',
                        'title' => 'Show Product Short Description',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No'
                    ),

                    array(
                        'id'=>'category-quickview',
                        'type' => 'switch',
                        'title' => 'Show Quick View',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No'
                    ),

                    array(
                        'id'=>'category-quickview-pos',
                        'type' => 'button_set',
                        'title' => 'Quick View Position',
                        'options' => array('top-left' => 'Top Left','top-right' => 'Top Right', 'bottom-left' => 'Bottom Left', 'bottom-right' => 'Bottom Right'),
                        'default' => 'top-right'
                    ),
                )
            );

            // Product
            $this->sections[] = array(
                'icon' => 'el-icon-gift',
                'icon_class' => 'icon',
                'title' => 'Product (Woocommerce)',
                'fields' => array(

                    array(
                        'id'=>'wooproduct-layout',
                        'type' => 'image_select',
                        'compiler'=>true,
                        'title' => 'Main Layout',
                        'options' => array(
                            'fullwidth' => array('alt' => 'Full Width', 'img' => ReduxFramework::$_url.'assets/img/1col.png'),
                            'left-sidebar' => array('alt' => 'Left Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cl.png'),
                            'right-sidebar' => array('alt' => 'Right Sidebar', 'img' => ReduxFramework::$_url.'assets/img/2cr.png')
                        ),
                        'default' => 'fullwidth'
                    ),

                    array(
                        'id'=>'product-related',
                        'type' => 'switch',
                        'title' => 'Show Related Products',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'product-related-count',
                        'type' => 'text',
                        'required' => array('product-related','equals','1'),
                        'title' => 'Related Products Count',
                        'default' => '8'
                    ),

                    array(
                        'id'=>'product-crosssell',
                        'type' => 'switch',
                        'title' => 'Show Cross Sells in Cart Page',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'product-crosssell-count',
                        'type' => 'text',
                        'required' => array('product-crosssell','equals','1'),
                        'title' => 'Cross Sells Count',
                        'default' => '8'
                    ),

                    array(
                        'id'=>'product-price',
                        'type' => 'switch',
                        'title' => 'Show Price on Image',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'product-hot',
                        'type' => 'switch',
                        'title' => 'Show "Hot" Label',
                        'desc' => 'Will be show in the featured product.',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'product-hot-pos',
                        'type' => 'button_set',
                        'title' => '"Hot" Label Position',
                        'options' => array('top-left' => 'Top Left','top-right' => 'Top Right', 'bottom-left' => 'Bottom Left', 'bottom-right' => 'Bottom Right'),
                        'default' => 'top-left'
                    ),

                    array(
                        'id'=>'product-hot-wrap',
                        'type' => 'button_set',
                        'title' => '"Hot" Label Wrapper',
                        'options' => array('rect' => 'Rectangle','circle' => 'Circle'),
                        'default' => 'rect'
                    ),

                    array(
                        'id'=>'product-sale',
                        'type' => 'switch',
                        'title' => 'Show "Sale" Label',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'product-sale-percent',
                        'type' => 'switch',
                        'title' => 'Show Percentage Saved Sale Price',
                        'desc' => 'Will be hide "Sale" label if set to "Yes".',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'product-sale-pos',
                        'type' => 'button_set',
                        'title' => '"Sale" Label Position',
                        'options' => array('top-left' => 'Top Left','top-right' => 'Top Right', 'bottom-left' => 'Bottom Left', 'bottom-right' => 'Bottom Right'),
                        'default' => 'top-left'
                    ),

                    array(
                        'id'=>'product-sale-wrap',
                        'type' => 'button_set',
                        'title' => '"Sale" Label Wrapper',
                        'options' => array('rect' => 'Rectangle','circle' => 'Circle'),
                        'default' => 'rect'
                    ),

                    array(
                        'id'=>'product-price-pos',
                        'type' => 'button_set',
                        'title' => 'Price Box Position',
                        'options' => array('top-left' => 'Top Left','top-right' => 'Top Right', 'bottom-left' => 'Bottom Left', 'bottom-right' => 'Bottom Right'),
                        'default' => 'bottom-right'
                    ),

                    array(
                        'id'=>'product-addcart',
                        'type' => 'switch',
                        'title' => 'Show Add to Cart',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'product-wishlist',
                        'type' => 'switch',
                        'title' => 'Show Wishlist',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'product-compare',
                        'type' => 'switch',
                        'title' => 'Show Compare',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'product-addthis',
                        'type' => 'switch',
                        'title' => 'Addthis Social Links',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'product-tabs',
                        'type' => 'button_set',
                        'title' => 'Tabs Type',
                        'options' => array('default' => 'Horizontal', 'vertical' => 'Vertical', 'accordion' => 'Accordion'),
                        'default' => 'vertical'
                    ),
                )
            );

            // Product Zoom
            $this->sections[] = array(
                'icon' => 'el-icon-picture',
                'icon_class' => 'icon',
                'title' => 'Image Zoom (Woocommerce)',
                'fields' => array(
                    array(
                        'id'=>'image-zoom',
                        'type' => 'switch',
                        'title' => 'Enable Zoom',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'zoom-type',
                        'type' => 'button_set',
                        'title' => 'Type',
                        'options' => array('inner' => 'Inner', 'window' => 'Window', 'lens' => 'Lens'),
                        'default' => 'inner'
                    ),

                    array(
                        'id'=>'zoom-scroll',
                        'type' => 'switch',
                        'title' => 'Scroll Zoom',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'zoom-lens-size',
                        'type' => 'text',
                        'title' => 'Lens Size',
                        'default' => '200'
                    ),

                    array(
                        'id'=>'zoom-lens-shape',
                        'type' => 'button_set',
                        'title' => 'Lens Shape',
                        'options' => array('round' => 'Round', 'square' => 'Square'),
                        'default' => 'round'
                    ),

                    array(
                        'id'=>'zoom-contain-lens',
                        'type' => 'switch',
                        'title' => 'Contain Lens Zoom',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'zoom-window-width',
                        'type' => 'text',
                        'title' => 'Window Width',
                        'default' => '400'
                    ),

                    array(
                        'id'=>'zoom-window-height',
                        'type' => 'text',
                        'title' => 'Window Height',
                        'default' => '400'
                    ),

                    array(
                        'id'=>'zoom-window-offset-x',
                        'type' => 'text',
                        'title' => 'Window Offset X',
                        'default' => '0'
                    ),

                    array(
                        'id'=>'zoom-window-offset-y',
                        'type' => 'text',
                        'title' => 'Window Offset Y',
                        'default' => '0'
                    ),

                    array(
                        'id'=>'zoom-window-pos',
                        'type' => 'button_set',
                        'title' => 'Window Position',
                        'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7', '8' => '8', '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15', '16' => '16'),
                        'default' => '1'
                    ),

                    array(
                        'id'=>'zoom-cursor',
                        'type' => 'button_set',
                        'title' => 'Cursor',
                        'options' => array('default' => 'Default', 'pointer' => 'Pointer', 'crosshair' => 'Crosshair', 'move' => 'Move'),
                        'default' => 'pointer'
                    ),

                    array(
                        'id'=>'zoom-border',
                        'type' => 'text',
                        'title' => 'Border',
                        'default' => '4'
                    ),

                    array(
                        'id'=>'zoom-lens-border',
                        'type' => 'text',
                        'title' => 'Lens Border',
                        'default' => '1'
                    ),

                    array(
                        'id'=>'zoom-border-color',
                        'type' => 'color',
                        'title' => 'Border Color',
                        'default' => '#888888'
                    ),
                )
            );
        }

        public function setHelpTabs() {

        }

        /**

        All the possible arguments for Redux.
        For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name'          => 'venedor_settings',
                'display_name'      => $theme->get('Name') . ' ' . 'Settings',
                'display_version'   => $theme->get('Version'),
                'menu_type'         => 'menu',
                'allow_sub_menu'    => true,
                'menu_title'        => 'Theme Settings',
                'page_title'        => 'Theme Settings',

                'google_api_key' => 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII',

                'async_typography'  => false,
                'admin_bar'         => true,
                'global_variable'   => '',
                'dev_mode'          => false,
                'ajax_save'        => false,

                'page_priority'     => null,
                'page_parent'       => 'themes.php',
                'page_permissions'  => 'manage_options',
                'menu_icon'         => '',
                'last_tab'          => '',
                'page_icon'         => 'icon-themes',
                'page_slug'         => 'venedor_settings',
                'save_defaults'     => true,
                'default_show'      => false,
                'default_mark'      => '',
                'show_import_export' => true,

                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,
                'output_tag'        => true,
                'customizer'        => false,

                'database'              => '',
                'system_info'           => false,

                'hints' => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'         => 'light',
                        'shadow'        => true,
                        'rounded'       => false,
                        'style'         => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show'          => array(
                            'effect'        => 'slide',
                            'duration'      => '500',
                            'event'         => 'mouseover',
                        ),
                        'hide'      => array(
                            'effect'    => 'slide',
                            'duration'  => '500',
                            'event'     => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args['share_icons'][] = array(
                'url'   => 'http://twitter.com/eternalfriend38',
                'title' => 'Follow us on Twitter',
                'icon'  => 'el-icon-twitter'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf('<p>Did you know that Venedor sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', $v);
            } else {
                $this->args['intro_text'] = '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>';
            }

            // Add content after the form.
            //$this->args['footer_text'] = '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>';
        }

    }

    global $reduxVenedorSettings;
    $reduxVenedorSettings = new Redux_Framework_venedor_settings();
}