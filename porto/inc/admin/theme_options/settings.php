<?php

/**
 * Porto Settings Options
 */

if (!class_exists('Redux_Framework_porto_settings')) {

    class Redux_Framework_porto_settings {

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

            $page_layouts = porto_options_layouts();
            $sidebars = porto_options_sidebars();
            $body_wrapper = porto_options_body_wrapper();
            $banner_wrapper = porto_options_banner_wrapper();
            $wrapper = porto_options_wrapper();

            $porto_banner_pos = porto_ct_banner_pos();
            $porto_footer_view = porto_ct_footer_view();
            $porto_banner_type = porto_ct_banner_type();
            $porto_master_sliders = porto_ct_master_sliders();
            $porto_rev_sliders = porto_ct_rev_sliders();

            $porto_categories_orderby = porto_ct_categories_orderby();
            $porto_categories_order = porto_ct_categories_order();
            $porto_categories_sort_pos = porto_ct_categories_sort_pos();

            $porto_header_type = porto_options_header_types();
            $porto_footer_type = porto_options_footer_types();
            $porto_breadcrumbs_type = porto_options_breadcrumbs_types();

            $porto_footer_columns = porto_options_footer_columns();

            // General Settings
            $this->sections[] = array(
                'icon' => 'el-icon-dashboard',
                'icon_class' => 'icon',
                'title' => __('General', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'show-loading-overlay',
                        'type' => 'switch',
                        'title' => __('Loading Overlay', 'porto'),
                        'default' => false,
                        'on' => __('Show', 'porto'),
                        'off' => __('Hide', 'porto'),
                    ),
                    array(
                        'id'=>'wrapper',
                        'type' => 'image_select',
                        'title' => __('Body Wrapper', 'porto'),
                        'options' => $body_wrapper,
                        'default' => 'full'
                    ),
                    array(
                        'id'=>'layout',
                        'type' => 'image_select',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $page_layouts,
                        'default' => 'right-sidebar'
                    ),
                    array(
                        'id'=>'sidebar',
                        'type' => 'select',
                        'title' => __('Select Sidebar', 'porto'),
                        'required' => array('layout','equals',$sidebars),
                        'data' => 'sidebars',
                        'default' => 'blog-sidebar'
                    ),
                    array(
                        'id'=>'header-wrapper',
                        'type' => 'image_select',
                        'title' => __('Header Wrapper', 'porto'),
                        'required' => array('wrapper','equals',array('full', 'wide')),
                        'options' => $wrapper,
                        'default' => 'full'
                    ),
                    array(
                        'id'=>'banner-wrapper',
                        'type' => 'image_select',
                        'title' => __('Banner Wrapper', 'porto'),
                        'required' => array('wrapper','equals',array('full', 'wide')),
                        'options' => $banner_wrapper,
                        'default' => 'wide'
                    ),
                    array(
                        'id'=>'breadcrumbs-wrapper',
                        'type' => 'image_select',
                        'title' => __('Breadcrumbs Wrapper', 'porto'),
                        'required' => array('wrapper','equals',array('full', 'wide')),
                        'options' => $wrapper,
                        'default' => 'full'
                    ),
                    array(
                        'id'=>'main-wrapper',
                        'type' => 'image_select',
                        'title' => __('Page Content Wrapper', 'porto'),
                        'required' => array('wrapper','equals',array('full', 'wide')),
                        'options' => $banner_wrapper,
                        'default' => 'wide'
                    ),
                    array(
                        'id'=>'footer-wrapper',
                        'type' => 'image_select',
                        'title' => __('Footer Wrapper', 'porto'),
                        'required' => array('wrapper','equals',array('full', 'wide')),
                        'options' => $wrapper,
                        'default' => 'full'
                    ),
                    array(
                        'id'=>'sticky-sidebar',
                        'type' => 'switch',
                        'title' => __('Enable Sticky Sidebar', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto')
                    ),
                    array(
                        'id'=>'show-mobile-sidebar',
                        'type' => 'switch',
                        'title' => __('Show Sidebar in Navigation on Mobile', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'show-content-type-skin',
                        'type' => 'switch',
                        'title' => __('Show Content Type Skin Options', 'porto'),
                        'desc' => __('Show skin options when edit post, page, product, portfolio, member.', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'show-category-skin',
                        'type' => 'switch',
                        'title' => __('Show Category Skin Options', 'porto'),
                        'desc' => __('Show skin options when edit the category of post, product, portfolio, member.', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Theme Layout', 'porto'),
                'fields' => array(
                    array(
                        'id'        => '1',
                        'type'      => 'raw',
                        'content'   => '<img style="max-width: 100%;" src="'.porto_options_uri.'/layouts/theme_layout.jpg"/>'
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Logo, Icons', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Logo', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'logo',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Logo', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/logo.png'
                        )
                    ),
                    array(
                        'id'=>'logo-retina',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Retina Logo', 'porto')
                    ),
                    array(
                        'id'=>'sticky-logo',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Logo in Sticky Menu', 'porto'),
                        'desc' => __('if header type is like 1, 4, 13, 14', 'porto')
                    ),
                    array(
                        'id'=>'sticky-logo-retina',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Retina Logo in Sticky Menu', 'porto'),
                        'desc' => __('if header type is like 1, 4, 13, 14', 'porto'),
                    ),
                    array(
                        'id'=>'logo-retina-width',
                        'type' => 'text',
                        'title' => __('Default Logo Width', 'porto'),
                        'desc' => __('If retina logo is uploaded, please input the default logo width. unit: px', 'porto'),
                    ),
                    array(
                        'id'=>'logo-retina-height',
                        'type' => 'text',
                        'title' => __('Default Logo Height', 'porto'),
                        'desc' => __('If retina logo is uploaded, please input the default logo height. unit: px', 'porto'),
                    ),
                    array(
                        'id'=>'logo-width',
                        'type' => 'text',
                        'title' => __('Logo Max Width', 'porto'),
                        'desc' => __('unit: px', 'porto'),
                        'default' => '170'
                    ),
                    array(
                        'id'=>'logo-width-wide',
                        'type' => 'text',
                        'title' => __('Logo Max Width on Wide Screen', 'porto'),
                        'default' => '250'
                    ),
                    array(
                        'id'=>'logo-width-tablet',
                        'type' => 'text',
                        'title' => __('Logo Max Width on Tablet', 'porto'),
                        'default' => '110'
                    ),
                    array(
                        'id'=>'logo-width-mobile',
                        'type' => 'text',
                        'title' => __('Logo Max Width on Mobile', 'porto'),
                        'default' => '110'
                    ),
                    array(
                        'id'=>'logo-width-sticky',
                        'type' => 'text',
                        'title' => __('Logo Max Width in Sticky Header', 'porto'),
                        'default' => '80'
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Logo Overlay', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'logo-overlay',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Logo Overlay', 'porto')
                    ),
                    array(
                        'id'=>'logo-overlay-width',
                        'type' => 'text',
                        'title' => __('Logo Overlay Max Width', 'porto'),
                        'default' => '250'
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Icons', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'favicon',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Favicon', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/favicon.ico'
                        )
                    ),
                    array(
                        'id'=>'icon-iphone',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Apple iPhone Icon', 'porto'),
                        'desc' => __('Icon for Apple iPhone (60px X 60px)', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/apple-touch-icon.png'
                        )
                    ),
                    array(
                        'id'=>'icon-iphone-retina',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Apple iPhone Retina Icon', 'porto'),
                        'desc' => __('Icon for Apple iPhone Retina (120px X 120px)', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/apple-touch-icon_120x120.png'
                        )
                    ),
                    array(
                        'id'=>'icon-ipad',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Apple iPad Icon', 'porto'),
                        'desc' => __('Icon for Apple iPad (76px X 76px)', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/apple-touch-icon_76x76.png'
                        )
                    ),
                    array(
                        'id'=>'icon-ipad-retina',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Apple iPad Retina Icon', 'porto'),
                        'desc' => __('Icon for Apple iPad Retina (152px X 152px)', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/apple-touch-icon_152x152.png'
                        )
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'el-icon-edit',
                'title' => __('Javascript Code', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'js-code-head',
                        'type' => 'ace_editor',
                        'title' => __('JS Code before &lt;/head&gt;', 'porto'),
                        'subtitle' => __('Paste your JS code here.', 'porto'),
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'default' => ""
                    ),
                    array(
                        'id'=>'js-code',
                        'type' => 'ace_editor',
                        'title' => __('JS Code before &lt;/body&gt;', 'porto'),
                        'subtitle' => __('Paste your JS code here.', 'porto'),
                        'mode' => 'javascript',
                        'theme' => 'chrome',
                        'default' => "jQuery(document).ready(function(){});"
                    )
                )
            );

            // Skin
            $this->sections[] = array(
                'icon' => 'el-icon-broom',
                'icon_class' => 'icon',
                'title' => __('Skin', 'porto'),
                'fields' => array(
                    array(
                        'id'        => '1',
                        'type'      => 'info',
                        'title' => __('After save the changes, will be regenerate the css files (skin_' . get_current_blog_id() . '.css, skin_rtl_' . get_current_blog_id() . '.css) in ', 'porto') . '<strong>' . porto_dir . '/css</strong>.',
                        'style' => 'info'
                    ),
                    array(
                        'id'=>'compress-skin-css',
                        'type' => 'switch',
                        'title' => __('Minify CSS', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'button-style',
                        'type' => 'button_set',
                        'title' => __('Button Style', 'porto'),
                        'options' => array(
                            '' => __('Default', 'porto'),
                            'btn-borders' => __('Borders', 'porto'),
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'skin-color',
                        'type' => 'color',
                        'title' => __('Primary Color', 'porto'),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'skin-color-inverse',
                        'type' => 'color',
                        'title' => __('Primary Inverse Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'secondary-color',
                        'type' => 'color',
                        'title' => __('Secondary Color', 'porto'),
                        'default' => '#e36159',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'secondary-color-inverse',
                        'type' => 'color',
                        'title' => __('Secondary Inverse Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'tertiary-color',
                        'type' => 'color',
                        'title' => __('Tertiary Color', 'porto'),
                        'default' => '#2baab1',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'tertiary-color-inverse',
                        'type' => 'color',
                        'title' => __('Tertiary Inverse Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'quaternary-color',
                        'type' => 'color',
                        'title' => __('Quaternary Color', 'porto'),
                        'default' => '#383f48',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'quaternary-color-inverse',
                        'type' => 'color',
                        'title' => __('Quaternary Inverse Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'dark-color',
                        'type' => 'color',
                        'title' => __('Dark Color', 'porto'),
                        'default' => '#2e353e',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'dark-color-inverse',
                        'type' => 'color',
                        'title' => __('Dark Inverse Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'light-color',
                        'type' => 'color',
                        'title' => __('Light Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'light-color-inverse',
                        'type' => 'color',
                        'title' => __('Light Inverse Color', 'porto'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'social-color',
                        'type' => 'button_set',
                        'title' => __('Social Links Color', 'porto'),
                        'options' => array(
                            '' => __('Default', 'porto'),
                            'primary' => __('Primary Color', 'porto'),
                        ),
                        'default' => '',
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Compile Default CSS', 'porto'),
                'fields' => array(
                    array(
                        'id'        => '1',
                        'type'      => 'info',
                        'notice' => false,
                        'style' => 'info',
                        'title' => '<strong style="font-size:20px;">' . __('Compile CSS Files', 'porto') . '</strong>',
                        'desc' => '<br/>' . ((isset($_GET['compile_theme_success']) && $_GET['compile_theme_success'] == 'true')?'<strong style="font-size: 15px; color: #000;">' . __('Theme CSS compiled successfully!', 'porto') . '</strong><br/><br/>':'')
                            . ((isset($_GET['compile_theme_success']) && $_GET['compile_theme_success'] == 'false')?'<strong style="font-size: 15px; color: #000;">' . __('Failed Theme CSS compilation!', 'porto') . '</strong><br/><br/>':'')
                            . ((isset($_GET['compile_theme_rtl_success']) && $_GET['compile_theme_rtl_success'] == 'true')?'<strong style="font-size: 15px; color: #000;">' . __('Theme RTL CSS compiled successfully!', 'porto') . '</strong><br/><br/>':'')
                            . ((isset($_GET['compile_theme_rtl_success']) && $_GET['compile_theme_rtl_success'] == 'false')?'<strong style="font-size: 15px; color: #000;">' . __('Failed Theme RTL CSS compilation!', 'porto') . '</strong><br/><br/>':'')
                            . ((isset($_GET['compile_plugins_success']) && $_GET['compile_plugins_success'] == 'true')?'<strong style="font-size: 15px; color: #000;">' . __('Plugins CSS compiled successfully!', 'porto') . '</strong><br/><br/>':'')
                            . ((isset($_GET['compile_plugins_success']) && $_GET['compile_plugins_success'] == 'false')?'<strong style="font-size: 15px; color: #000;">' . __('Failed Plugins CSS compilation!', 'porto') . '</strong><br/><br/>':'')
                            . ((isset($_GET['compile_plugins_rtl_success']) && $_GET['compile_plugins_rtl_success'] == 'true')?'<strong style="font-size: 15px; color: #000;">' . __('Plugins RTL CSS compiled successfully!', 'porto') . '</strong><br/><br/>':'')
                            . ((isset($_GET['compile_plugins_rtl_success']) && $_GET['compile_plugins_rtl_success'] == 'false')?'<strong style="font-size: 15px; color: #000;">' . __('Failed Plugins RTL CSS compilation!', 'porto') . '</strong><br/><br/>':'')
                            . '<a href="'.admin_url('admin.php?page=porto_settings').'&compile_theme=true" class="button button-primary">' . __('Theme CSS', 'porto') . '</a> '
                            . '<a href="'.admin_url('admin.php?page=porto_settings').'&compile_theme_rtl=true" class="button button-primary">' . __('Theme RTL CSS', 'porto') . '</a> '
                            . '<a href="'.admin_url('admin.php?page=porto_settings').'&compile_plugins=true" class="button button-primary">' . __('Plugins CSS', 'porto') . '</a> '
                            . '<a href="'.admin_url('admin.php?page=porto_settings').'&compile_plugins_rtl=true" class="button button-primary">' . __('Plugins RTL CSS', 'porto') . '</a> '
                            . '<br/><br/><span style="color: red;">' . __('<strong>Before compile</strong>, please configure <strong>below options</strong> and click <strong>"Save Changes"</strong>.', 'porto') . '</span>'
                            . '<br/><span style="color: black;">'
                            . __('After compile, will be regenerate the css files (theme_' . get_current_blog_id() . '.css, theme_rtl_' . get_current_blog_id() . '.css, plugins_' . get_current_blog_id() . '.css, plugins_rtl_' . get_current_blog_id() . '.css in ', 'porto') . '<strong>' . porto_dir . '/css</strong>.</span>',
                    ),
                    array(
                        'id'=>'compress-default-css',
                        'type' => 'switch',
                        'title' => __('Minify CSS', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'css-type',
                        'type' => 'button_set',
                        'title' => __('Background Type', 'porto'),
                        'options' => array(
                            '' => __('Light', 'porto'),
                            'dark' => __('Dark', 'porto')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'color-dark',
                        'type' => 'color',
                        'required' => array('css-type','equals','dark'),
                        'title' => __('Basic Background Color', 'porto'),
                        'default' => '#1d2127',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'container-width',
                        'type' => 'button_set',
                        'title' => __('Container Max Width', 'porto'),
                        'options' => array(
                            '1020' => '1020px',
                            '1140' => '1140px',
                            '1260' => '1260px'
                        ),
                        'default' => '1140'
                    ),
                    array(
                        'id'=>'grid-gutter-width',
                        'type' => 'button_set',
                        'title' => __('Grid Gutter Width', 'porto'),
                        'options' => array(
                            '16' => '16px',
                            '20' => '20px',
                            '30' => '30px'
                        ),
                        'default' => '30'
                    ),
                    array(
                        'id'=>'border-radius',
                        'type' => 'switch',
                        'title' => __('Border Radius', 'porto'),
                        'default' => true
                    ),
                    array(
                        'id'=>'thumb-padding',
                        'type' => 'switch',
                        'title' => __('Thumbnail Padding', 'porto'),
                        'default' => true
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Typography', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'select-google-charset',
                        'type' => 'switch',
                        'title' => __('Select Google Font Character Sets', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'google-charsets',
                        'type' => 'button_set',
                        'title' => __('Google Font Character Sets', 'porto'),
                        'multi' => true,
                        'required' => array('select-google-charset','equals',true),
                        'options'=> array(
                            'cyrillic' => 'Cyrrilic',
                            'cyrillic-ext' => 'Cyrrilic Extended',
                            'greek' => 'Greek',
                            'greek-ext' => 'Greek Extended',
                            'khmer' => 'Khmer',
                            'latin' => 'Latin',
                            'latin-ext' => 'Latin Extneded',
                            'vietnamese' => 'Vietnamese'
                        ),
                        'default' => array('latin','greek-ext','cyrillic','latin-ext','greek','cyrillic-ext','vietnamese','khmer')
                    ),
                    array(
                        'id'=>'body-font',
                        'type' => 'typography',
                        'title' => __('Body Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'default'=> array(
                            'color'=>"#777777",
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'14px',
                            'line-height' => '22px'
                        ),
                    ),
                    array(
                        'id'=>'body-mobile-font',
                        'type' => 'typography',
                        'title' => __('Body Mobile Font', 'porto'),
                        'google' => false,
                        'subsets' => false,
                        'font-family' => false,
                        'font-weight' => false,
                        'text-align' => false,
                        'color' => false,
                        'font-style' => false,
                        'desc' => __('Will be change on mobile device(max width < 480).', 'porto'),
                        'default'=> array(
                            'font-size'=>'13px',
                            'line-height' => '20px'
                        ),
                    ),
                    array(
                        'id'=>'alt-font',
                        'type' => 'typography',
                        'title' => __('Alternative Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'font-size' => false,
                        'text-align' => false,
                        'color' => false,
                        'line-height' => false,
                        'desc' => __('You can use css class name "alternative-font" when edit html element.', 'porto'),
                        'default'=> array(
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Shadows Into Light',
                        ),
                    ),
                    array(
                        'id'=>'h1-font',
                        'type' => 'typography',
                        'title' => __('H1 Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'default'=> array(
                            'color'=>"#1d2127",
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'36px',
                            'line-height' => '44px'
                        ),
                    ),
                    array(
                        'id'=>'h2-font',
                        'type' => 'typography',
                        'title' => __('H2 Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'default'=> array(
                            'color'=>"#1d2127",
                            'google'=>true,
                            'font-weight'=>'300',
                            'font-family'=>'Open Sans',
                            'font-size'=>'30px',
                            'line-height' => '40px'
                        ),
                    ),
                    array(
                        'id'=>'h3-font',
                        'type' => 'typography',
                        'title' => __('H3 Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'default'=> array(
                            'color'=>"#1d2127",
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'25px',
                            'line-height' => '32px'
                        ),
                    ),
                    array(
                        'id'=>'h4-font',
                        'type' => 'typography',
                        'title' => __('H4 Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'default'=> array(
                            'color'=>"#1d2127",
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'20px',
                            'line-height' => '27px'
                        ),
                    ),
                    array(
                        'id'=>'h5-font',
                        'type' => 'typography',
                        'title' => __('H5 Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'default'=> array(
                            'color'=>"#1d2127",
                            'google'=>true,
                            'font-weight'=>'600',
                            'font-family'=>'Open Sans',
                            'font-size'=>'14px',
                            'line-height' => '18px'
                        ),
                    ),
                    array(
                        'id'=>'h6-font',
                        'type' => 'typography',
                        'title' => __('H6 Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'default'=> array(
                            'color'=>"#1d2127",
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'14px',
                            'line-height' => '18px'
                        ),
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Backgrounds', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Body Background', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'body-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto')
                    ),
                    array(
                        'id'=>'body-bg-gradient',
                        'type' => 'switch',
                        'title' => __('Enable Background Gradient', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'body-bg-gcolor',
                        'type' => 'color_gradient',
                        'title' => __('Background Gradient Color', 'porto'),
                        'required' => array('body-bg-gradient','equals',true),
                        'default' => array(
                            'from' => '',
                            'to' => ''
                        )
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Page Content Background', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'content-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto')
                    ),
                    array(
                        'id'=>'content-bg-gradient',
                        'type' => 'switch',
                        'title' => __('Enable Background Gradient', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'content-bg-gcolor',
                        'type' => 'color_gradient',
                        'title' => __('Background Gradient Color', 'porto'),
                        'required' => array('content-bg-gradient','equals',true),
                        'default' => array(
                            'from' => '',
                            'to' => ''
                        )
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Content Bottom Widgets Area', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'content-bottom-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto')
                    ),
                    array(
                        'id'=>'content-bottom-bg-gradient',
                        'type' => 'switch',
                        'title' => __('Enable Background Gradient', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'content-bottom-bg-gcolor',
                        'type' => 'color_gradient',
                        'title' => __('Background Gradient Color', 'porto'),
                        'required' => array('content-bottom-bg-gradient','equals',true),
                        'default' => array(
                            'from' => '',
                            'to' => ''
                        )
                    ),
                    array(
                        'id'=>'content-bottom-padding',
                        'type' => 'spacing',
                        'mode' => 'padding',
                        'title' => __('Padding', 'porto'),
                        'default' => array('padding-top' => 0, 'padding-bottom' => 20, 'padding-left' => 0, 'padding-right' => 0)
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Header', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Header Wrapper', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'header-wrap-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto'),
                        'default' => array(
                            'background-color' => 'transparent'
                        )
                    ),
                    array(
                        'id'=>'header-wrap-bg-gradient',
                        'type' => 'switch',
                        'title' => __('Background Gradient', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'header-wrap-bg-gcolor',
                        'type' => 'color_gradient',
                        'title' => __('Background Gradient Color', 'porto'),
                        'required' => array('header-wrap-bg-gradient','equals',true),
                        'default' => array(
                            'from' => '',
                            'to' => ''
                        )
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Header', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'header-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto'),
                        'default' => array(
                            'background-color' => '#ffffff'
                        )
                    ),
                    array(
                        'id'=>'header-bg-gradient',
                        'type' => 'switch',
                        'title' => __('Background Gradient', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'header-bg-gcolor',
                        'type' => 'color_gradient',
                        'title' => __('Background Gradient Color', 'porto'),
                        'required' => array('header-bg-gradient','equals',true),
                        'default' => array(
                            'from' => '#f6f6f6',
                            'to' => '#ffffff'
                        )
                    ),
                    array(
                        'id'=>'header-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#999999',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'header-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#999999',
                            'hover' => '#999999',
                        )
                    ),
                    array(
                        'id'=>'header-top-border',
                        'type' => 'border',
                        'all' => true,
                        'style' => false,
                        'title' => __('Top Border', 'porto'),
                        'default' => array('border-color' => '#ededed', 'border-top' => '5px')
                    ),
                    array(
                        'id'=>'header-margin',
                        'type' => 'spacing',
                        'mode' => 'margin',
                        'title' => __('Margin', 'porto'),
                        'default' => array('margin-top' => 0, 'margin-bottom' => 0, 'margin-left' => 0, 'margin-right' => 0)
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Sticky Header', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'sticky-header-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto'),
                        'default' => array(
                            'background-color' => '#ffffff'
                        )
                    ),
                    array(
                        'id'=>'sticky-header-bg-gradient',
                        'type' => 'switch',
                        'title' => __('Background Gradient', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'sticky-header-bg-gcolor',
                        'type' => 'color_gradient',
                        'title' => __('Background Gradient Color', 'porto'),
                        'required' => array('sticky-header-bg-gradient','equals',true),
                        'default' => array(
                            'from' => '#f6f6f6',
                            'to' => '#ffffff'
                        )
                    ),
                    array(
                        'id'=>'sticky-header-opacity',
                        'type' => 'text',
                        'title' => __('Background Opacity', 'porto'),
                        'default' => '100%'
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Skin option when banner show behind header', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'header-opacity',
                        'type' => 'text',
                        'title' => __('Header Opacity', 'porto'),
                        'default' => '80%'
                    ),
                    array(
                        'id'=>'searchform-opacity',
                        'type' => 'text',
                        'title' => __('Search Form Opacity', 'porto'),
                        'default' => '50%'
                    ),
                    array(
                        'id'=>'menuwrap-opacity',
                        'type' => 'text',
                        'title' => __('Menu Wrap Opacity', 'porto'),
                        'default' => '30%'
                    ),
                    array(
                        'id'=>'menu-opacity',
                        'type' => 'text',
                        'title' => __('Menu Opacity', 'porto'),
                        'default' => '30%'
                    ),
                    array(
                        'id'=>'header-fixed-show-bottom',
                        'type' => 'switch',
                        'title' => __('Show Bottom Border', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Header Top', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'header-top-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => '#f4f4f4',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'header-top-bottom-border',
                        'type' => 'border',
                        'all' => true,
                        'style' => false,
                        'title' => __('Bottom Border', 'porto'),
                        'default' => array('border-color' => '#ededed', 'border-top' => '1px')
                    ),
                    array(
                        'id'=>'header-top-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'header-top-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#0088cc',
                            'hover' => '#0099e6',
                        )
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Side Navigation', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'side-social-bg-color',
                        'type' => 'color',
                        'title' => __('Social Link Background Color', 'porto'),
                        'default' => '#9e9e9e',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'side-social-color',
                        'type' => 'color',
                        'title' => __('Social Link Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'side-copyright-color',
                        'type' => 'color',
                        'title' => __('Copyright Text Color', 'porto'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Main Menu', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'mainmenu-wrap-bg-color',
                        'type' => 'color',
                        'title' => __('Wrapper Background Color', 'porto'),
                        'default' => 'transparent',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'mainmenu-wrap-padding',
                        'type' => 'spacing',
                        'mode' => 'padding',
                        'title' => __('Wrapper Padding', 'porto'),
                        'default' => array('padding-top' => 0, 'padding-bottom' => 15, 'padding-left' => 0, 'padding-right' => 0)
                    ),
                    array(
                        'id'=>'mainmenu-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => 'transparent',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Top Level Menu Item', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'menu-font',
                        'type' => 'typography',
                        'title' => __('Menu Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'color' => false,
                        'default'=> array(
                            'google'=>true,
                            'font-weight'=>'700',
                            'font-family'=>'Open Sans',
                            'font-size'=>'12px',
                            'line-height' => '20px'
                        ),
                    ),
                    array(
                        'id'=>'menu-font-md',
                        'type' => 'typography',
                        'title' => __('Menu Font (window width < 992px)', 'porto'),
                        'google' => false,
                        'subsets' => false,
                        'font-style' => false,
                        'font-weight' => false,
                        'font-family' => false,
                        'text-align' => false,
                        'color' => false,
                        'default'=> array(
                            'font-size'=>'12px',
                            'line-height' => '20px'
                        ),
                    ),
                    array(
                        'id'=>'menu-side-font',
                        'type' => 'typography',
                        'title' => __('Side Menu Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'color' => false,
                        'default'=> array(
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'14px',
                            'line-height' => '18px'
                        ),
                    ),
                    array(
                        'id'=>'menu-text-transform',
                        'type' => 'button_set',
                        'title' => __('Text Transform', 'porto'),
                        'options' => array(
                            'none' => __('None', 'porto'),
                            'capitalize' => __('Capitalize', 'porto'),
                            'uppercase' => __('Uppercase', 'porto'),
                            'lowercase' => __('Lowercase', 'porto'),
                            'initial' => __('Initial', 'porto')
                        ),
                        'default' => 'uppercase'
                    ),
                    array(
                        'id'=>'mainmenu-toplevel-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#0088cc',
                            'hover' => '#ffffff'
                        )
                    ),
                    array(
                        'id'=>'mainmenu-toplevel-hbg-color',
                        'type' => 'color',
                        'title' => __('Hover Background Color', 'porto'),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'mainmenu-toplevel-config-active',
                        'type' => 'switch',
                        'title' => __('Configure Active Color', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'mainmenu-toplevel-alink-color',
                        'type' => 'color',
                        'title' => __('Active Link Color', 'porto'),
                        'required' => array('mainmenu-toplevel-config-active','equals',true),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'mainmenu-toplevel-abg-color',
                        'type' => 'color',
                        'title' => __('Active Background Color', 'porto'),
                        'required' => array('mainmenu-toplevel-config-active','equals',true),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'mainmenu-toplevel-padding1',
                        'type' => 'spacing',
                        'mode' => 'padding',
                        'title' => __('Padding on Desktop', 'porto'),
                        'desc' => __('if header type is like 1, 4, 13, 14', 'porto'),
                        'default' => array('padding-top' => 11, 'padding-bottom' => 9, 'padding-left' => 13, 'padding-right' => 13)
                    ),
                    array(
                        'id'=>'mainmenu-toplevel-padding2',
                        'type' => 'spacing',
                        'mode' => 'padding',
                        'title' => __('Padding on Desktop (width > 991px)', 'porto'),
                        'desc' => __('if header type is like 1, 4, 13, 14', 'porto'),
                        'default' => array('padding-top' => 9, 'padding-bottom' => 7, 'padding-left' => 10, 'padding-right' => 10)
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Menu Popup', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'menu-popup-font',
                        'type' => 'typography',
                        'title' => __('Menu Popup Font', 'porto'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'text-align' => false,
                        'color' => false,
                        'default'=> array(
                            'google'=>true,
                            'font-weight'=>'400',
                            'font-family'=>'Open Sans',
                            'font-size'=>'14px',
                            'line-height' => '24px'
                        ),
                    ),
                    array(
                        'id'=>'mainmenu-popup-border',
                        'type' => 'switch',
                        'title' => __('Show Border', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'mainmenu-popup-border-color',
                        'type' => 'color',
                        'title' => __('Border Color', 'porto'),
                        'required' => array('mainmenu-popup-border','equals',true),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'mainmenu-popup-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'mainmenu-popup-heading-color',
                        'type' => 'color',
                        'title' => __('Heading Color', 'porto'),
                        'default' => '#333333',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'mainmenu-popup-text-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#777777',
                            'hover' => '#777777',
                        )
                    ),
                    array(
                        'id'=>'mainmenu-popup-text-hbg-color',
                        'type' => 'color',
                        'title' => __('Link Hover Background Color', 'porto'),
                        'default' => '#f4f4f4',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'mainmenu-popup-narrow-type',
                        'type' => 'button_set',
                        'title' => __('Narrow Menu Style', 'porto'),
                        'desc' => __('if narrow menu style is "Style 2", please select "Top Level Menu Item / Hover Background Color".', 'porto'),
                        'options' => array(
                            '' => __('With Popup BG Color', 'porto'),
                            '1' => __('With Top Menu Hover Bg Color', 'porto')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Tip', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'mainmenu-tip-bg-color',
                        'type' => 'color',
                        'title' => __('Tip Background Color', 'porto'),
                        'default' => '#0cc485',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Menu Custom Content (if header type is like 1, 4, 9, 13, 14)', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'menu-custom-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'menu-custom-link',
                        'type' => 'link_color',
                        'title' => __('Link Color', 'porto'),
                        'active' => false,
                        'default' => array(
                            'regular' => '#0088cc',
                            'hover' => '#006fa4',
                        )
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Breadcrumbs', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'breadcrumbs-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto'),
                        'default' => array(
                            'background-color' => '#171717'
                        )
                    ),
                    array(
                        'id'=>'breadcrumbs-bg-gradient',
                        'type' => 'switch',
                        'title' => __('Background Gradient', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'breadcrumbs-bg-gcolor',
                        'type' => 'color_gradient',
                        'title' => __('Background Gradient Color', 'porto'),
                        'required' => array('breadcrumbs-bg-gradient','equals',true),
                        'default' => array(
                            'from' => '',
                            'to' => ''
                        )
                    ),
                    array(
                        'id'=>'breadcrumbs-parallax',
                        'type' => 'switch',
                        'title' => __('Enable Background Image Parallax', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'breadcrumbs-parallax-speed',
                        'type' => 'text',
                        'title' => __('Parallax Speed', 'porto'),
                        'default' => '1.5',
                        'required' => array('breadcrumbs-parallax','equals',true),
                    ),
                    array(
                        'id'=>'breadcrumbs-top-border',
                        'type' => 'border',
                        'all' => true,
                        'style' => false,
                        'title' => __('Top Border', 'porto'),
                        'default' => array('border-color' => '#384045', 'border-top' => '5px')
                    ),
                    array(
                        'id'=>'breadcrumbs-bottom-border',
                        'type' => 'border',
                        'all' => true,
                        'style' => false,
                        'title' => __('Bottom Border', 'porto'),
                        'default' => array('border-color' => '#cccccc', 'border-top' => '5px')
                    ),
                    array(
                        'id'=>'breadcrumbs-padding',
                        'type' => 'spacing',
                        'mode' => 'padding',
                        'title' => __('Content Padding', 'porto'),
                        'description' => __('default: 0 15 0 15', 'porto'),
                        'default' => array('padding-top' => 0, 'padding-bottom' => 0, 'padding-left' => 15, 'padding-right' => 15)
                    ),
                    array(
                        'id'=>'breadcrumbs-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'breadcrumbs-link-color',
                        'type' => 'color',
                        'title' => __('Link Color', 'porto'),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'breadcrumbs-title-color',
                        'type' => 'color',
                        'title' => __('Page Title Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'breadcrumbs-subtitle-color',
                        'type' => 'color',
                        'title' => __('Page Sub Title Color', 'porto'),
                        'default' => '#e6e6e6',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'breadcrumbs-subtitle-margin',
                        'type' => 'spacing',
                        'mode' => 'margin',
                        'title' => __('Page Sub Title Margin', 'porto'),
                        'default' => array('margin-top' => 0, 'margin-bottom' => 0, 'margin-left' => 0, 'margin-right' => 0)
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Footer', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'footer-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto'),
                        'default' => array(
                            'background-color' => '#0e0e0e'
                        )
                    ),
                    array(
                        'id'=>'footer-bg-gradient',
                        'type' => 'switch',
                        'title' => __('Background Gradient', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'footer-bg-gcolor',
                        'type' => 'color_gradient',
                        'title' => __('Background Gradient Color', 'porto'),
                        'required' => array('footer-bg-gradient','equals',true),
                        'default' => array(
                            'from' => '',
                            'to' => ''
                        )
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Footer Widgets Area', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'footer-main-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto'),
                        'default' => array(
                            'background-color' => 'transparent'
                        )
                    ),
                    array(
                        'id'=>'footer-main-bg-gradient',
                        'type' => 'switch',
                        'title' => __('Background Gradient', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'footer-main-bg-gcolor',
                        'type' => 'color_gradient',
                        'title' => __('Background Gradient Color', 'porto'),
                        'required' => array('footer-main-bg-gradient','equals',true),
                        'default' => array(
                            'from' => '',
                            'to' => ''
                        )
                    ),
                    array(
                        'id'=>'footer-heading-color',
                        'type' => 'color',
                        'title' => __('Heading Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'footer-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'footer-link-color',
                        'type'=>'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#ffffff',
                            'hover' => '#ffffff',
                        )
                    ),
                    array(
                        'id'=>'footer-ribbon-bg-color',
                        'type' => 'color',
                        'title' => __('Ribbon Background Color', 'porto'),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'footer-ribbon-text-color',
                        'type' => 'color',
                        'title' => __('Ribbon Text Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Footer Top Widget Area', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'footer-top-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto')
                    ),
                    array(
                        'id'=>'footer-top-bg-gradient',
                        'type' => 'switch',
                        'title' => __('Enable Background Gradient', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'footer-top-bg-gcolor',
                        'type' => 'color_gradient',
                        'title' => __('Background Gradient Color', 'porto'),
                        'required' => array('footer-top-bg-gradient','equals',true),
                        'default' => array(
                            'from' => '',
                            'to' => ''
                        )
                    ),
                    array(
                        'id'=>'footer-top-padding',
                        'type' => 'spacing',
                        'mode' => 'padding',
                        'title' => __('Padding', 'porto'),
                        'default' => array('padding-top' => 0, 'padding-bottom' => 0, 'padding-left' => 0, 'padding-right' => 0)
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Footer Bottom', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'footer-bottom-bg',
                        'type' => 'background',
                        'title' => __('Background', 'porto'),
                        'default' => array(
                            'background-color' => '#060606'
                        )
                    ),
                    array(
                        'id'=>'footer-bottom-bg-gradient',
                        'type' => 'switch',
                        'title' => __('Background Gradient', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'footer-bottom-bg-gcolor',
                        'type' => 'color_gradient',
                        'title' => __('Background Gradient Color', 'porto'),
                        'required' => array('footer-bottom-bg-gradient','equals',true),
                        'default' => array(
                            'from' => '',
                            'to' => ''
                        )
                    ),
                    array(
                        'id'=>'footer-bottom-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#555555',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'footer-bottom-link-color',
                        'type'=>'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#ffffff',
                            'hover' => '#ffffff',
                        )
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Background Opacity when footer show in fixed position', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'footer-opacity',
                        'type' => 'text',
                        'title' => __('Footer Opacity', 'porto'),
                        'default' => '80%'
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Follow Us Widget', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'footer-social-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'footer-social-link-color',
                        'type' => 'color',
                        'title' => __('Link Color', 'porto'),
                        'default' => '#555555',
                        'validate' => 'color',
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Mobile Panel', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'panel-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => '#1d2127',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'panel-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'panel-link-color',
                        'type'=>'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#ffffff',
                            'hover' => '#ffffff',
                        )
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('View, Currency Switcher', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'switcher-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => 'transparent',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'switcher-hbg-color',
                        'type' => 'color',
                        'title' => __('Hover Background Color', 'porto'),
                        'default' => '#ededed',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'switcher-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => __('Link Color', 'porto'),
                        'default' => array(
                            'regular' => '#777777',
                            'hover' => '#777777',
                        )
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Search Form', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'searchform-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'searchform-border-color',
                        'type' => 'color',
                        'title' => __('Border Color', 'porto'),
                        'default' => '#cccccc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'searchform-popup-border-color',
                        'type' => 'color',
                        'title' => __('Popup Border Color', 'porto'),
                        'default' => '#cccccc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'searchform-text-color',
                        'type' => 'color',
                        'title' => __('Text Color', 'porto'),
                        'default' => '#555555',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'searchform-hover-color',
                        'type' => 'color',
                        'title' => __('Hover Color', 'porto'),
                        'default' => '#333333',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('In Sticky Header (if header type is like 1, 4, 9, 13, 14)', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'sticky-searchform-popup-border-color',
                        'type' => 'color',
                        'title' => __('Popup Border Color', 'porto'),
                        'default' => '#cccccc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'sticky-searchform-toggle-text-color',
                        'type' => 'color',
                        'title' => __('Toggle Text Color', 'porto'),
                        'default' => '#777777',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'sticky-searchform-toggle-hover-color',
                        'type' => 'color',
                        'title' => __('Toggle Hover Color', 'porto'),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Mini Cart', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'minicart-icon-color',
                        'type' => 'color',
                        'title' => __('Icon Color', 'porto'),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'minicart-item-color',
                        'type' => 'color',
                        'title' => __('Item Color', 'porto'),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'minicart-border-color',
                        'type' => 'color',
                        'title' => __('Border Color', 'porto'),
                        'desc' => __('when mini cart type is 2', 'porto'),
                        'default' => 'transparent',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'minicart-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'desc' => __('when mini cart type is 2', 'porto'),
                        'default' => 'transparent',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'minicart-popup-border-color',
                        'type' => 'color',
                        'title' => __('Popup Border Color', 'porto'),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('In Sticky Header (if header type is like 1, 4, 9, 13, 14)', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'sticky-minicart-icon-color',
                        'type' => 'color',
                        'title' => __('Icon Color', 'porto'),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'sticky-minicart-item-color',
                        'type' => 'color',
                        'title' => __('Item Color', 'porto'),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'sticky-minicart-border-color',
                        'type' => 'color',
                        'title' => __('Border Color', 'porto'),
                        'desc' => __('when mini cart type is 2', 'porto'),
                        'default' => 'transparent',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'sticky-minicart-bg-color',
                        'type' => 'color',
                        'title' => __('Background Color', 'porto'),
                        'desc' => __('when mini cart type is 2', 'porto'),
                        'default' => 'transparent',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'sticky-minicart-popup-border-color',
                        'type' => 'color',
                        'title' => __('Popup Border Color', 'porto'),
                        'default' => '#0088cc',
                        'validate' => 'color',
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Shop', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'wishlist-color',
                        'type' => 'color',
                        'title' => __('Wishlist Color', 'porto'),
                        'default' => '#e36159',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'wishlist-color-inverse',
                        'type' => 'color',
                        'title' => __('Wishlist Inverse Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'quickview-color',
                        'type' => 'color',
                        'title' => __('Quick View Color', 'porto'),
                        'default' => '#2baab1',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'quickview-color-inverse',
                        'type' => 'color',
                        'title' => __('Quick View Inverse Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'hot-color',
                        'type' => 'color',
                        'title' => __('Hot Bg Color', 'porto'),
                        'default' => '#62b959',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'hot-color-inverse',
                        'type' => 'color',
                        'title' => __('Hot Text Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'sale-color',
                        'type' => 'color',
                        'title' => __('Sale Bg Color', 'porto'),
                        'default' => '#e27c7c',
                        'validate' => 'color',
                    ),
                    array(
                        'id'=>'sale-color-inverse',
                        'type' => 'color',
                        'title' => __('Sale Text Color', 'porto'),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Custom CSS', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'css-code',
                        'type' => 'ace_editor',
                        'title' => __('CSS Code', 'porto'),
                        'subtitle' => __('Paste your CSS code here.', 'porto'),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'default' => ""
                    ),
                )
            );

            // Header Settings
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'icon_class' => 'icon',
                'title' => __('Header', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'show-header-top',
                        'type' => 'switch',
                        'title' => __('Show Header Top', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'change-header-logo',
                        'type' => 'switch',
                        'title' => __('Change Logo Size in Sticky Header', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'welcome-msg',
                        'type' => 'textarea',
                        'title' => __('Welcome Message', 'porto'),
                        'default' => ""
                    ),
                    array(
                        'id'=>'header-contact-info',
                        'type' => 'textarea',
                        'title' => __('Contact Info', 'porto'),
                        'default' => "<ul class=\"nav nav-pills nav-top\">\r\n\t<li>\r\n\t\t<a href=\"#\" target=\"_blank\"><i class=\"fa fa-angle-right\"></i>About Us</a> \r\n\t</li>\r\n\t<li>\r\n\t\t<a href=\"#\" target=\"_blank\"><i class=\"fa fa-angle-right\"></i>Contact Us</a> \r\n\t</li>\r\n\t<li class=\"phone\">\r\n\t\t<span><i class=\"fa fa-phone\"></i>(123) 456-7890</span>\r\n\t</li>\r\n</ul>\r\n",
                    ),
                    array(
                        'id'=>'header-copyright',
                        'type' => 'textarea',
                        'title' => __('Side Navigation Copyright (Header Type: Side)', 'porto'),
                        'default' => sprintf( __('&copy; Copyright %s. All Rights Reserved.', 'porto'), date('Y') )
                    ),
                    array(
                        'id'=>'show-header-tooltip',
                        'type' => 'switch',
                        'title' => __('Show Tooltip', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'header-tooltip',
                        'type' => 'textarea',
                        'title' => __('Tooltip Content', 'porto'),
                        'required' => array('show-header-tooltip','equals',true),
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Header Type', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'header-type',
                        'type' => 'image_select',
                        'full_width' => true,
                        'title' => __('Header Type', 'porto'),
                        'options' => $porto_header_type,
                        'default' => '10'
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('View, Currency Switcher', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'wpml-switcher',
                        'type' => 'switch',
                        'title' => __('Show WPML Language Switcher', 'porto'),
                        'desc' => __('Show wpml language switcher instead of view switcher menu.', 'porto').' '.__('Compatible with Polylang and qTranslate X plugins.', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id' => "wpml-switcher-pos",
                        'type' => 'button_set',
                        'title' => __('Language Switcher Position', 'porto'),
                        'required' => array('wpml-switcher','equals',true),
                        'options' => array(
                            '' => __('Default', 'porto'),
                            'top_nav' => __('In Top Navigation', 'porto'),
                            'main_menu' => __('In Main Menu', 'porto')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'wcml-switcher',
                        'type' => 'switch',
                        'title' => __('Show WPML Currency Switcher', 'porto'),
                        'desc' => __('Show wpml currency switcher instead of currency switcher menu.', 'porto').' '.__('Compatible with Woocommerce Currency Switcher plugin.', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id' => "wcml-switcher-pos",
                        'type' => 'button_set',
                        'title' => __('Currency Switcher Position', 'porto'),
                        'required' => array('wcml-switcher','equals',true),
                        'options' => array(
                            '' => __('Default', 'porto'),
                            'top_nav' => __('In Top Navigation', 'porto'),
                            'main_menu' => __('In Main Menu', 'porto')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id' => "switcher-effect",
                        'type' => 'button_set',
                        'title' => __('Popup Effect', 'porto'),
                        'options' => array(
                            '' => __('None', 'porto'),
                            'effect-down' => __('Drop Down', 'porto'),
                            'effect-fadein-up' => __('Fade In Up', 'porto'),
                            'effect-fadein-down' => __('Fade In Down', 'porto'),
                            'effect-fadein' => __('Fade In', 'porto'),
                        ),
                        'default' => 'effect-down'
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Social Links', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'show-header-socials',
                        'type' => 'switch',
                        'title' => __('Show Social Links', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'header-socials-nofollow',
                        'type' => 'switch',
                        'title' => __('Add rel="nofollow" to social links', 'porto'),
                        'required' => array('show-header-socials','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id' => "header-social-facebook",
                        'type' => 'text',
                        'title' => __('Facebook', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-twitter",
                        'type' => 'text',
                        'title' => __('Twitter', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-rss",
                        'type' => 'text',
                        'title' => __('RSS', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-pinterest",
                        'type' => 'text',
                        'title' => __('Pinterest', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-youtube",
                        'type' => 'text',
                        'title' => __('Youtube', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-instagram",
                        'type' => 'text',
                        'title' => __('Instagram', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-skype",
                        'type' => 'text',
                        'title' => __('Skype', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-linkedin",
                        'type' => 'text',
                        'title' => __('LinkedIn', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-googleplus",
                        'type' => 'text',
                        'title' => __('Google Plus', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-vk",
                        'type' => 'text',
                        'title' => __('VK', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-xing",
                        'type' => 'text',
                        'title' => __('Xing', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-tumblr",
                        'type' => 'text',
                        'title' => __('Tumblr', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-reddit",
                        'type' => 'text',
                        'title' => __('Reddit', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-vimeo",
                        'type' => 'text',
                        'title' => __('Vimeo', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-telegram",
                        'type' => 'text',
                        'title' => __('Telegram', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-yelp",
                        'type' => 'text',
                        'title' => __('Yelp', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-flickr",
                        'type' => 'text',
                        'title' => __('Flickr', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                    array(
                        'id' => "header-social-whatsapp",
                        'type' => 'text',
                        'title' => __('WhatsApp', 'porto'),
                        'required' => array('show-header-socials','equals',true)
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Mini Cart', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'show-minicart',
                        'type' => 'switch',
                        'title' => __('Show Mini Cart', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'minicart-type',
                        'type' => 'image_select',
                        'title' => __('Minicart Type', 'porto'),
                        'required' => array('show-minicart','equals',true),
                        'options' => array(
                            '' => array('alt' => __('Minicart Type 1', 'porto'), 'img' => porto_options_uri.'/minicarts/minicart_01.png'),
                            'minicart-box' => array('alt' => __('Minicart Type 2', 'porto'), 'img' => porto_options_uri.'/minicarts/minicart_02.png'),
                            'minicart-inline' => array('alt' => __('Minicart Type 3', 'porto'), 'img' => porto_options_uri.'/minicarts/minicart_03.png'),
                        ),
                        'default' => 'minicart-inline'
                    ),
                    array(
                        'id'=>'minicart-icon',
                        'type' => 'image_select',
                        'title' => __('Minicart Icon', 'porto'),
                        'required' => array('show-minicart','equals',true),
                        'options' => array(
                            '' => array('alt' => __('Minicart Icon 1', 'porto'), 'img' => porto_options_uri.'/minicarts/minicart_icon_01.png'),
                            'minicart-icon2' => array('alt' => __('Minicart Icon 2', 'porto'), 'img' => porto_options_uri.'/minicarts/minicart_icon_02.png'),
                            'minicart-icon3' => array('alt' => __('Minicart Icon 3', 'porto'), 'img' => porto_options_uri.'/minicarts/minicart_icon_03.png'),
                            'minicart-icon4' => array('alt' => __('Minicart Icon 4', 'porto'), 'img' => porto_options_uri.'/minicarts/minicart_icon_04.png'),
                        ),
                        'default' => ''
                    ),
                    array(
                        'id' => "minicart-effect",
                        'type' => 'button_set',
                        'title' => __('Popup Effect', 'porto'),
                        'required' => array('show-minicart','equals',true),
                        'options' => array(
                            '' => __('None', 'porto'),
                            'effect-fadein-up' => __('Fade In Up', 'porto'),
                            'effect-fadein-down' => __('Fade In Down', 'porto'),
                            'effect-fadein' => __('Fade In', 'porto'),
                        ),
                        'default' => 'effect-fadein-up'
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Search Form', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'show-searchform',
                        'type' => 'switch',
                        'title' => __('Show Search Form', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'search-size',
                        'type' => 'button_set',
                        'title' => __('Search Form Size', 'porto'),
                        'required' => array('show-searchform','equals',true),
                        'options' => array('' => __('Large', 'porto'), 'search-md' => __('Medium', 'porto'), 'search-sm' => __('Small', 'porto')),
                        'default' => 'search-sm'
                    ),
                    array(
                        'id'=>'search-type',
                        'type' => 'button_set',
                        'title' => __('Search Content Type', 'porto'),
                        'required' => array('show-searchform','equals',true),
                        'options' => array('all' => __('All', 'porto'), 'post' => __('Post', 'porto'), 'product' => __('Product', 'porto'), 'portfolio' => __('Portfolio', 'porto')),
                        'default' => 'all'
                    ),
                    array(
                        'id'=>'search-cats',
                        'type' => 'switch',
                        'title' => __('Show Categories', 'porto'),
                        'required' => array('search-type','equals',array('post', 'product')),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Sticky Header', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'enable-sticky-header',
                        'type' => 'switch',
                        'title' => __('Enable Sticky Header', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'enable-sticky-header-tablet',
                        'type' => 'switch',
                        'title' => __('Enable on Tablet (width < 992px)', 'porto'),
                        'required' => array('enable-sticky-header','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'enable-sticky-header-mobile',
                        'type' => 'switch',
                        'title' => __('Enable on Mobile (width <= 480)', 'porto'),
                        'required' => array('enable-sticky-header-tablet','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id' => "sticky-header-effect",
                        'type' => 'button_set',
                        'title' => __('Sticky Header Effect', 'porto'),
                        'options' => array(
                            '' => __('None', 'porto'),
                            'reveal' => __('Reveal', 'porto'),
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('If header type is like 1, 4, 9, 13, 14', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'show-sticky-logo',
                        'type' => 'switch',
                        'title' => __('Show Logo', 'porto'),
                        'required' => array('enable-sticky-header','equals',true),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'show-sticky-searchform',
                        'type' => 'switch',
                        'title' => __('Show Search Form', 'porto'),
                        'required' => array('enable-sticky-header','equals',true),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'show-sticky-minicart',
                        'type' => 'switch',
                        'title' => __('Show Mini Cart', 'porto'),
                        'required' => array('enable-sticky-header','equals',true),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'show-sticky-menu-custom-content',
                        'type' => 'switch',
                        'title' => __('Show Menu Custom Content', 'porto'),
                        'required' => array('enable-sticky-header','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Mobile Panel', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'mobile-panel-pos',
                        'type' => 'button_set',
                        'title' => __('Position', 'porto'),
                        'options' => array(
                            '' => __('Default', 'porto'),
                            'panel-left' => __('Left', 'porto'),
                            'panel-right' => __('Right', 'porto')
                        ),
                        'default' => ''
                    )
                )
            );

            // Menu Settings
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'icon_class' => 'icon',
                'title' => __('Menu', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'menu-arrow',
                        'type' => 'switch',
                        'title' => __('Show Menu Arrow', 'porto'),
                        'desc' => __('If menu item have sub menus, show menu arrow.', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id' => "menu-type",
                        'type' => 'button_set',
                        'title' => __('Menu Type', 'porto'),
                        'options' => array(
                            '' => __('Normal', 'porto'),
                            'menu-flat' => __('Flat', 'porto'),
                            'menu-flat menu-flat-border' => __('Flat & Border', 'porto'),
                        ),
                        'default' => ''
                    ),
                    array(
                        'id' => "menu-login-pos",
                        'type' => 'button_set',
                        'title' => __('Display Login & Register / Logout Link', 'porto'),
                        'options' => array(
                            '' => __('None', 'porto'),
                            'top_nav' => __('In Top Navigation', 'porto'),
                            'main_menu' => __('In Main Menu', 'porto')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id' => "menu-enable-register",
                        'type' => 'switch',
                        'title' => __('Show Register Link', 'porto'),
                        'required' => array('menu-login-pos','equals',array('top_nav', 'main_menu')),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id' => "menu-effect",
                        'type' => 'button_set',
                        'title' => __('Popup Effect', 'porto'),
                        'options' => array(
                            '' => __('None', 'porto'),
                            'effect-down' => __('Drop Down', 'porto'),
                            'effect-fadein-up' => __('Fade In Up', 'porto'),
                            'effect-fadein-down' => __('Fade In Down', 'porto'),
                            'effect-fadein' => __('Fade In', 'porto'),
                        ),
                        'default' => 'effect-down'
                    ),
                    array(
                        'id' => "menu-sub-effect",
                        'type' => 'button_set',
                        'title' => __('Popup Sub Effect', 'porto'),
                        'options' => array(
                            '' => __('None', 'porto'),
                            'subeffect-down' => __('Drop Down', 'porto'),
                            'subeffect-fadein-left' => __('Fade In Left', 'porto'),
                            'subeffect-fadein-right' => __('Fade In Right', 'porto'),
                            'subeffect-fadein-up' => __('Fade In Up', 'porto'),
                            'subeffect-fadein-down' => __('Fade In Down', 'porto'),
                            'subeffect-fadein' => __('Fade In', 'porto'),
                        ),
                        'default' => 'subeffect-fadein-left'
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('If header type is like 1, 4, 13, 14', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'menu-align',
                        'type' => 'button_set',
                        'title' => __('Main Menu Align', 'porto'),
                        'options' => array(
                            '' => __('Left', 'porto'),
                            'centered' => __('Center', 'porto')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'menu-sidebar',
                        'type' => 'switch',
                        'title' => __('Show Main Menu in Sidebar', 'porto'),
                        'desc' => __('If the layout of a page is left sidebar or right sidebar, the main menu shows in the sidebar.', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id' => "menu-sidebar-title",
                        'type' => 'text',
                        'title' => __('Sidebar Menu Title', 'porto'),
                        'default' => __('All Department', 'porto')
                    ),
                    array(
                        'id' => "menu-sidebar-toggle",
                        'type' => 'switch',
                        'title' => __('Toggle Sidebar Menu', 'porto'),
                        'required' => array('menu-sidebar','equals',true),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id' => "menu-sidebar-home",
                        'type' => 'switch',
                        'title' => __('Show Main Menu in Sidebar only on Home', 'porto'),
                        'required' => array('menu-sidebar','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('If header type is 9', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id' => "menu-title",
                        'type' => 'text',
                        'title' => __('Main Menu Title', 'porto'),
                        'default' => __('All Department', 'porto')
                    ),
                    array(
                        'id' => "menu-toggle-onhome",
                        'type' => 'switch',
                        'title' => __('Toggle on home page', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('If header type is like 1, 4, 9, 13, 14', 'porto'),
                        'notice' => false
                    ),
                    array(
                        'id'=>'menu-block',
                        'type' => 'textarea',
                        'title' => __('Menu Custom Content', 'porto'),
                        'desc' => __('example: &lt;span&gt;Custom Message&lt;/span&gt;&lt;a href="#"&gt;Special Offer!&lt;/a&gt;&lt;a href="#"&gt;Buy this Theme!&lt;em class="tip hot"&gt;HOT&lt;i class="tip-arrow"&gt;&lt;/i&gt;&lt;/em&gt;&lt;/a&gt;', 'porto'),
                        'default' => ''
                    ),
                )
            );

            // Breadcrumbs Settings
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'icon_class' => 'icon',
                'title' => __('Breadcrumbs', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'show-pagetitle',
                        'type' => 'switch',
                        'title' => __('Show Page Title', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'pagetitle-archives',
                        'type' => 'switch',
                        'title' => __('Show Content Type Name in Singular', 'porto'),
                        'default' => false,
                        'required' => array('show-pagetitle','equals','1'),
                        'description' => __('Show Content Type Name in single content type.', 'porto'),
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'pagetitle-parent',
                        'type' => 'switch',
                        'title' => __('Show Parent Page Title in Page', 'porto'),
                        'default' => false,
                        'required' => array('show-pagetitle','equals','1'),
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'show-breadcrumbs',
                        'type' => 'switch',
                        'title' => __('Show Breadcrumbs', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'breadcrumbs-prefix',
                        'type' => 'text',
                        'title' => __('Breadcrumbs Prefix', 'porto'),
                        'required' => array('show-breadcrumbs','equals','1')
                    ),
                    array(
                        'id'=>'breadcrumbs-blog-link',
                        'type' => 'switch',
                        'title' => __('Show Blog Link', 'porto'),
                        'default' => true,
                        'required' => array('show-breadcrumbs','equals','1'),
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'breadcrumbs-archives-link',
                        'type' => 'switch',
                        'title' => __('Show Custom Post Type Archives Link', 'porto'),
                        'default' => true,
                        'required' => array('show-breadcrumbs','equals','1'),
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'breadcrumbs-categories',
                        'type' => 'switch',
                        'title' => __('Show Categories Link', 'porto'),
                        'default' => true,
                        'required' => array('show-breadcrumbs','equals','1'),
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'breadcrumbs-delimiter',
                        'type' => 'button_set',
                        'title' => __('Breadcrumbs Delimiter', 'porto'),
                        'required' => array('show-breadcrumbs','equals','1'),
                        'options' => array(
                            '' => __('/', 'porto'),
                            'delimiter-2' => __('>', 'porto'),
                        ),
                        'default' => ''
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Breadcrumbs Type', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'breadcrumbs-type',
                        'type' => 'image_select',
                        'full_width' => true,
                        'title' => __('Breadcrumbs Type', 'porto'),
                        'options' => $porto_breadcrumbs_type,
                        'default' => '1'
                    ),
                )
            );

            // Footer Settings
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'icon_class' => 'icon',
                'title' => __('Footer', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'footer-logo',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Footer Logo', 'porto'),
                        'default' => array(
                            'url' => porto_uri . '/images/logo/logo_footer.png'
                        )
                    ),
                    array(
                        'id' => "footer-ribbon",
                        'type' => 'text',
                        'title' => __('Ribbon Text', 'porto'),
                        'default' => ''
                    ),
                    array(
                        'id' => "footer-copyright",
                        'type' => 'textarea',
                        'title' => __('Copyright', 'porto'),
                        'default' => sprintf( __('&copy; Copyright %s. All Rights Reserved.', 'porto'), date('Y') )
                    ),
                    array(
                        'id' => "footer-copyright-pos",
                        'type' => 'button_set',
                        'title' => __('Copyright Position', 'porto'),
                        'options' => array(
                            'left' => __('Left', 'porto'),
                            'center' => __('Center', 'porto'),
                            'right' => __('Right', 'porto')
                        ),
                        'default' => 'left'
                    ),
                    array(
                        'id'=>'footer-payments',
                        'type' => 'switch',
                        'title' => __('Show Payments Logos', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'footer-payments-image',
                        'type' => 'media',
                        'url'=> true,
                        'readonly' => false,
                        'title' => __('Payments Image', 'porto'),
                        'required' => array('footer-payments','equals','1'),
                        'default' => array(
                            'url' => porto_uri . '/images/payments.png'
                        )
                    ),
                    array(
                        'id'=>'footer-payments-image-alt',
                        'type' => 'text',
                        'title' => __('Payments Image Alt', 'porto'),
                        'required' => array('footer-payments','equals','1'),
                        'default' => ''
                    ),
                    array(
                        'id'=>'footer-payments-link',
                        'type' => 'text',
                        'title' => __('Payments Link URL', 'porto'),
                        'required' => array('footer-payments','equals','1'),
                        'default' => ''
                    ),
                    array(
                        'id'=>'show-footer-tooltip',
                        'type' => 'switch',
                        'title' => __('Show Tooltip', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'footer-tooltip',
                        'type' => 'textarea',
                        'title' => __('Tooltip Content', 'porto'),
                        'required' => array('show-footer-tooltip','equals',true),
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Footer Type', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'footer-type',
                        'type' => 'image_select',
                        'full_width' => true,
                        'title' => __('Footer Type', 'porto'),
                        'options' => $porto_footer_type,
                        'default' => '1'
                    ),
                    array(
                        'id'=>'footer-customize',
                        'type' => 'switch',
                        'title' => __('Customize Footer Columns', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'footer-widget1',
                        'type' => 'select',
                        'title' => __('Widget 1', 'porto'),
                        'required' => array('footer-customize','equals',true),
                        'options' => $porto_footer_columns,
                        'default' => ""
                    ),
                    array(
                        'id'=>'footer-widget2',
                        'type' => 'select',
                        'title' => __('Widget 2', 'porto'),
                        'required' => array('footer-customize','equals',true),
                        'options' => $porto_footer_columns,
                        'default' => ""
                    ),
                    array(
                        'id'=>'footer-widget3',
                        'type' => 'select',
                        'title' => __('Widget 3', 'porto'),
                        'required' => array('footer-customize','equals',true),
                        'options' => $porto_footer_columns,
                        'default' => ""
                    ),
                    array(
                        'id'=>'footer-widget4',
                        'type' => 'select',
                        'title' => __('Widget 4', 'porto'),
                        'required' => array('footer-customize','equals',true),
                        'options' => $porto_footer_columns,
                        'default' => ""
                    ),
                )
            );

            // Page
            $this->sections[] = array(
                'icon' => 'el-icon-bookmark',
                'icon_class' => 'icon',
                'title' => __('Page', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'page-comment',
                        'type' => 'switch',
                        'title' => __('Show Comments', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'page-zoom',
                        'type' => 'switch',
                        'title' => __('Image Lightbox', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),
                    array(
                        'id'=>'page-share',
                        'type' => 'switch',
                        'title' => __('Show Social Share Links', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'page-microdata',
                        'type' => 'switch',
                        'title' => __('Microdata Rich Snippets', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),
                )
            );

            // Blog
            $this->sections[] = array(
                'icon' => 'el-icon-file',
                'icon_class' => 'icon',
                'title' => __('Post', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'post-format',
                        'type' => 'switch',
                        'title' => __('Show Post Format', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'hot-label',
                        'type' => 'text',
                        'title' => __('"HOT" Text', 'porto'),
                        'desc' => __('sticky post label', 'porto'),
                        'default' => ''
                    ),
                    array(
                        'id'=>'post-zoom',
                        'type' => 'switch',
                        'title' => __('Image Lightbox', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),
                    array(
                        'id'=>'post-metas',
                        'type' => 'button_set',
                        'title' => __('Post Meta', 'porto'),
                        'multi' => true,
                        'options'=> array(
                            'date' => __('Date', 'porto'),
                            'author' => __('Author', 'porto'),
                            'cats' => __('Categories', 'porto'),
                            'tags' => __('Tags', 'porto'),
                            'comments' => __('Comments', 'porto'),
                            '-' => 'None',
                        ),
                        'default' => array('date','author','cats','tags','comments', '-')
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Blog & Post Archives', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'post-archive-layout',
                        'type' => 'image_select',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $page_layouts,
                        'default' => 'right-sidebar'
                    ),
                    array(
                        'id'=>'post-archive-sticky-sidebar',
                        'type' => 'switch',
                        'title' => __('Enable Sticky Sidebar', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto')
                    ),
                    array(
                        'id'=>'post-layout',
                        'type' => 'image_select',
                        'title' => __('Archive Layout', 'porto'),
                        'options' => array(
                            "full" => array('alt' => __('Full', 'porto'), 'img' => porto_options_uri.'/images/post_archive_style_1.jpg'),
                            "large" => array('alt' => __('Large', 'porto'), 'img' => porto_options_uri.'/images/post_archive_style_2.jpg'),
                            "large-alt" => array('alt' => __('Large Alt', 'porto'), 'img' => porto_options_uri.'/images/post_archive_style_3.jpg'),
                            "medium" => array('alt' => __('Medium', 'porto'), 'img' => porto_options_uri.'/images/post_archive_style_4.jpg'),
                            "grid" => array('alt' => __('Grid', 'porto'), 'img' => porto_options_uri.'/images/post_archive_style_5.jpg'),
                            "timeline" => array('alt' => __('Timeline', 'porto'), 'img' => porto_options_uri.'/images/post_archive_style_6.jpg')
                        ),
                        'default' => 'full'
                    ),
                    array(
                        'id'=>'post-style',
                        'type' => 'button_set',
                        'title' => __('Post Style', 'porto'),
                        'required' => array('post-layout','equals',array('grid', 'timeline')),
                        'options' => array(
                            '' => __('Default', 'porto'),
                            'related' => __('Post Carousel Style', 'porto')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'grid-columns',
                        'type' => 'button_set',
                        'title' => __('Grid Columns', 'porto'),
                        'required' => array('post-layout','equals','grid'),
                        'options' => array(
                            '1' => '1',
                            '2' => '2',
                            '3' => '3',
                            '4' => '4'
                        ),
                        'default' => '3'
                    ),
                    array(
                        'id'=>'blog-infinite',
                        'type' => 'switch',
                        'title' => __('Enable Infinite Scroll', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'blog-excerpt',
                        'type' => 'switch',
                        'title' => __('Show Excerpt', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'blog-excerpt-length',
                        'type' => 'text',
                        'required' => array('blog-excerpt','equals',true),
                        'title' => __('Excerpt Length', 'porto'),
                        'desc' => __('The number of words', 'porto'),
                        'default' => '80',
                    ),
                    array(
                        'id'=>'blog-excerpt-type',
                        'type' => 'button_set',
                        'required' => array('blog-excerpt','equals',true),
                        'title' => __('Excerpt Type', 'porto'),
                        'options' => array('text' => __('Text', 'porto'),'html' => __('HTML', 'porto')),
                        'default' => 'text'
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Blog', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'blog-title',
                        'type' => 'text',
                        'title' => __('Page Title', 'porto'),
                        'default' => 'Blog'
                    ),
                    array(
                        'id'=>'blog-banner_pos',
                        'type' => 'select',
                        'title' => __('Blog Banner Position', 'porto'),
                        'options' => $porto_banner_pos,
                        'default' => ""
                    ),
                    array(
                        'id'=>'blog-footer_view',
                        'type' => 'select',
                        'title' => __('Blog Footer View', 'porto'),
                        'options' => $porto_footer_view,
                        'default' => ""
                    ),
                    array(
                        'id'=>'blog-banner_type',
                        'type' => 'select',
                        'title' => __('Blog Banner Type', 'porto'),
                        'options' => $porto_banner_type,
                        'default' => ""
                    ),
                    array(
                        'id'=>'blog-master_slider',
                        'type' => 'select',
                        'required' => array('blog-banner_type','equals','master_slider'),
                        'title' => __('Master Slider', 'porto'),
                        'options' => $porto_master_sliders,
                        'default' => ""
                    ),
                    array(
                        'id'=>'blog-rev_slider',
                        'type' => 'select',
                        'required' => array('blog-banner_type','equals','rev_slider'),
                        'title' => __('Revolution Slider', 'porto'),
                        'options' => $porto_rev_sliders,
                        'default' => ""
                    ),
                    array(
                        'id'=>'blog-banner_block',
                        'type' => 'editor',
                        'required' => array('blog-banner_type','equals','banner_block'),
                        'title' => __('Banner Block', 'porto'),
                        'desc' => __('Please input block slug name. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),
                    array(
                        'id'=>'blog-content_top',
                        'type' => 'text',
                        'title' => __('Content Top', 'porto'),
                        'desc' => __('Please input comma separated block slug names. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),
                    array(
                        'id'=>'blog-content_inner_top',
                        'type' => 'text',
                        'title' => __('Content Inner Top', 'porto'),
                        'desc' => __('Please input comma separated block slug names. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),
                    array(
                        'id'=>'blog-content_inner_bottom',
                        'type' => 'text',
                        'title' => __('Content Inner Bottom', 'porto'),
                        'desc' => __('Please input comma separated block slug names. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),
                    array(
                        'id'=>'blog-content_bottom',
                        'type' => 'text',
                        'title' => __('Content Bottom', 'porto'),
                        'desc' => __('Please input comma separated block slug names. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Single Post', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'post-single-layout',
                        'type' => 'image_select',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $page_layouts,
                        'default' => 'right-sidebar'
                    ),
                    array(
                        'id'=>'post-single-sticky-sidebar',
                        'type' => 'switch',
                        'title' => __('Enable Sticky Sidebar', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto')
                    ),
                    array(
                        'id'=>'post-banner-block',
                        'type' => 'text',
                        'title' => __('Global Banner Block', 'porto'),
                        'desc' => __('Please input comma separated block slug names. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),
                    array(
                        'id'=>'post-content-layout',
                        'type' => 'image_select',
                        'title' => __('Post Layout', 'porto'),
                        'options' => array(
                            "full" => array('alt' => __('Full', 'porto'), 'img' => porto_options_uri.'/images/post_single_style_1.jpg'),
                            "large" => array('alt' => __('Large', 'porto'), 'img' => porto_options_uri.'/images/post_single_style_2.jpg'),
                            "large-alt" => array('alt' => __('Large Alt', 'porto'), 'img' => porto_options_uri.'/images/post_single_style_3.jpg'),
                            "medium" => array('alt' => __('Medium', 'porto'), 'img' => porto_options_uri.'/images/post_single_style_4.jpg'),
                        ),
                        'default' => 'full'
                    ),
                    array(
                        'id'=>'post-title-style',
                        'type' => 'button_set',
                        'title' => __('Post Section Title Style', 'porto'),
                        'description' => __('Select title style of author, comment, etc.', 'porto'),
                        'options' => array(
                            '' => __('With Icon', 'porto'),
                            'without-icon' => __('Without Icon', 'porto'),
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'post-slideshow',
                        'type' => 'switch',
                        'title' => __('Show Slideshow', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'post-title',
                        'type' => 'switch',
                        'title' => __('Show Title', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'post-share',
                        'type' => 'switch',
                        'title' => __('Show Social Share Links', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'post-author',
                        'type' => 'switch',
                        'title' => __('Show Author Info', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'post-comments',
                        'type' => 'switch',
                        'title' => __('Show Comments', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'post-related',
                        'type' => 'switch',
                        'title' => __('Show Related Posts', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'post-related-count',
                        'type' => 'text',
                        'required' => array('post-related','equals',true),
                        'title' => __('Related Posts Count', 'porto'),
                        'desc' => __('If you want to show all the related posts, please input "-1".', 'porto'),
                        'default' => '10'
                    ),
                    array(
                        'id'=>'post-related-orderby',
                        'type' => 'button_set',
                        'required' => array('post-related','equals',true),
                        'title' => __('Related Posts Order by', 'porto'),
                        'options' => array(
                            'none' => __('None', 'porto'),
                            'rand' => __('Random', 'porto'),
                            'date' => __('Date', 'porto'),
                            'ID' => __('ID', 'porto'),
                            'modified' => __('Modified Date', 'porto'),
                            'comment_count' => __('Comment Count', 'porto')
                        ),
                        'default' => 'rand'
                    ),
                    array(
                        'id'=>'post-related-cols',
                        'type' => 'button_set',
                        'required' => array('post-related','equals',true),
                        'title' => __('Related Posts Columns', 'porto'),
                        'description' => __('reduce one column in left or right sidebar layout', 'porto'),
                        'options' => array(
                            '4' => '4',
                            '3' => '3',
                            '2' => '2',
                            '1' => '1',
                        ),
                        'default' => '4'
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Post Carousel', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'post-related-image-size',
                        'type' => 'dimensions',
                        'title' => __('Post Image Size', 'porto'),
                        'desc' => __('Please regenerate all the thumbnails in <strong>Tools > Regen.Thumbnails</strong> after save changes.', 'porto'),
                        'default' => array(
                            'width' => '450',
                            'height' => '231',
                        )
                    ),
                    array(
                        'id'=>'post-related-style',
                        'type' => 'image_select',
                        'title' => __('Post Style', 'porto'),
                        'options' => array(
                            "" => array('alt' => __('With Read More Link', 'porto'), 'img' => porto_options_uri.'/images/post_style_1.jpg'),
                            "style-2" => array('alt' => __('With Post Meta', 'porto'), 'img' => porto_options_uri.'/images/post_style_2.jpg'),
                            "style-3" => array('alt' => __('With Read More Button Link', 'porto'), 'img' => porto_options_uri.'/images/post_style_3.jpg'),
                            "style-4" => array('alt' => __('With Side Image', 'porto'), 'img' => porto_options_uri.'/images/post_style_4.jpg')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'post-related-excerpt-length',
                        'type' => 'text',
                        'title' => __('Excerpt Length', 'porto'),
                        'desc' => __('The number of words', 'porto'),
                        'default' => '20',
                    ),
                    array(
                        'id'=>'post-related-author',
                        'type' => 'switch',
                        'title' => __('Author Name', 'porto'),
                        'required' => array('post-related-style','equals',array('','style-3')),
                        'default' => false,
                        'on' => __('Show', 'porto'),
                        'off' => __('Hide', 'porto'),
                    ),
                    array(
                        'id'=>'post-related-btn-style',
                        'type' => 'button_set',
                        'title' => __('Button Style', 'porto'),
                        'required' => array('post-related-style','equals','style-3'),
                        'options' => array(
                            '' => __('Normal', 'porto'),
                            'btn-borders' => __('Borders', 'porto')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'post-related-btn-size',
                        'type' => 'button_set',
                        'title' => __('Button Size', 'porto'),
                        'required' => array('post-related-style','equals','style-3'),
                        'options' => array(
                            '' => __('Normal', 'porto'),
                            'btn-sm' => __('Small', 'porto'),
                            'btn-xs' => __('Extra Small', 'porto')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'post-related-btn-color',
                        'type' => 'button_set',
                        'title' => __('Button Color', 'porto'),
                        'required' => array('post-related-style','equals','style-3'),
                        'options' => array(
                            'btn-default' => __('Default', 'porto'),
                            'btn-primary' => __('Primary', 'porto'),
                            'btn-secondary' => __('Secondary', 'porto'),
                            'btn-tertiary' => __('Tertiary', 'porto'),
                            'btn-quaternary' => __('Quaternary', 'porto'),
                            'btn-dark' => __('Dark', 'porto'),
                            'btn-light' => __('Light', 'porto')
                        ),
                        'default' => 'btn-default'
                    ),
                )
            );

            // Portfolio
            $this->sections[] = array(
                'icon' => 'el-icon-picture',
                'icon_class' => 'icon',
                'title' => __('Portfolio', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'enable-portfolio',
                        'type' => 'switch',
                        'title' => __('Portfolio Content Type', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),
                    array(
                        'id' => "portfolio-slug-name",
                        'type' => 'text',
                        'title' => __('Slug Name', 'porto'),
                        'placeholder' => 'portfolio'
                    ),
                    array(
                        'id' => "portfolio-name",
                        'type' => 'text',
                        'title' => __('Name', 'porto'),
                        'placeholder' => __('Portfolios', 'porto'),
                    ),
                    array(
                        'id' => "portfolio-singular-name",
                        'type' => 'text',
                        'title' => __('Singular Name', 'porto'),
                        'placeholder' => __('Portfolio', 'porto'),
                    ),
                    array(
                        'id' => "portfolio-cat-slug-name",
                        'type' => 'text',
                        'title' => __('Category Slug Name', 'porto'),
                        'placeholder' => 'portfolio_cat'
                    ),
                    array(
                        'id' => "portfolio-skill-slug-name",
                        'type' => 'text',
                        'title' => __('Skill Slug Name', 'porto'),
                        'placeholder' => 'portfolio_skill'
                    ),
                    array(
                        'id' => "portfolio-archive-page",
                        'type' => 'select',
                        'data' => 'page',
                        'title' => __('Portfolios Page', 'porto')
                    ),
                    array(
                        'id'=>'portfolio-zoom',
                        'type' => 'switch',
                        'title' => __('Image Lightbox', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-metas',
                        'type' => 'button_set',
                        'title' => __('Portfolio Meta', 'porto'),
                        'multi' => true,
                        'options'=> array(
                            'like' => __('Like', 'porto'),
                            'date' => __('Date', 'porto'),
                            'cats' => __('Categories', 'porto'),
                            'skills' => __('Skills', 'porto'),
                            'location' => __('Location', 'porto'),
                            'client' => __('Client', 'porto'),
                            'quote' => __('Author', 'porto'),
                            '-' => 'None',
                        ),
                        'default' => array('like','date','cats','skills','location','client','quote','-')
                    ),
                    array(
                        'id'=>'portfolio-subtitle',
                        'type' => 'button_set',
                        'title' => __('Portfolio Sub Title', 'porto'),
                        'description' => __('Use this value in portfolio archives (grid, masonry, timeline layouts) and portfolio carousel.', 'porto'),
                        'options'=> array(
                            'none' => __('None', 'porto'),
                            'like' => __('Like', 'porto'),
                            'date' => __('Date', 'porto'),
                            'cats' => __('Categories', 'porto'),
                            'skills' => __('Skills', 'porto'),
                            'location' => __('Location', 'porto'),
                            'client_name' => __('Client Name', 'porto'),
                            'client_link' => __('Client URL(Link)', 'porto'),
                            'author_name' => __('Author Name', 'porto'),
                            'author_role' => __('Author Role', 'porto'),
                        ),
                        'default' => 'cats'
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Portfolio Archives', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'portfolio-title',
                        'type' => 'text',
                        'title' => __('Page Title', 'porto'),
                        'default' => 'Our <strong>Projects</strong>'
                    ),
                    array(
                        'id'=>'portfolio-sub-title',
                        'type' => 'textarea',
                        'title' => __('Page Sub Title', 'porto'),
                        'default' => ''
                    ),
                    array(
                        'id'=>'portfolio-archive-layout',
                        'type' => 'image_select',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $page_layouts,
                        'default' => 'fullwidth'
                    ),
                    array(
                        'id'=>'portfolio-archive-sticky-sidebar',
                        'type' => 'switch',
                        'title' => __('Enable Sticky Sidebar', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto')
                    ),
                    array(
                        'id'=>'portfolio-archive-ajax',
                        'type' => 'switch',
                        'title' => __('Enable Ajax Load', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto')
                    ),
                    array(
                        'id'=>'portfolio-archive-ajax-modal',
                        'type' => 'switch',
                        'title' => __('Ajax Load on Modal', 'porto'),
                        'required' => array('portfolio-archive-ajax','equals',true),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto')
                    ),
                    array(
                        'id'=>'portfolio-archive-sidebar',
                        'type' => 'select',
                        'title' => __('Select Sidebar', 'porto'),
                        'required' => array('portfolio-archive-layout','equals',$sidebars),
                        'data' => 'sidebars'
                    ),
                    array(
                        'id'=>'portfolio-infinite',
                        'type' => 'switch',
                        'title' => __('Enable Infinite Scroll', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-cat-orderby',
                        'type' => 'button_set',
                        'title' => __('Sort Categories Order By', 'porto'),
                        'options' => $porto_categories_orderby,
                        'default' => 'name'
                    ),
                    array(
                        'id'=>'portfolio-cat-order',
                        'type' => 'button_set',
                        'title' => __('Sort Order for Categories', 'porto'),
                        'options' => $porto_categories_order,
                        'default' => 'asc'
                    ),
                    array(
                        'id'=>'portfolio-cat-sort-pos',
                        'type' => 'button_set',
                        'title' => __('Filter Position', 'porto'),
                        'options' => $porto_categories_sort_pos,
                        'default' => 'content'
                    ),
                    array(
                        'id'=>'portfolio-layout',
                        'type' => 'image_select',
                        'title' => __('Archive Layout', 'porto'),
                        'options' => array(
                            "grid" => array('alt' => __('Grid', 'porto'), 'img' => porto_options_uri.'/images/portfolio_archive_style_1.jpg'),
                            "masonry" => array('alt' => __('Masonry', 'porto'), 'img' => porto_options_uri.'/images/portfolio_archive_style_2.jpg'),
                            "timeline" => array('alt' => __('Timeline', 'porto'), 'img' => porto_options_uri.'/images/portfolio_archive_style_3.jpg'),
                            "medium" => array('alt' => __('Medium', 'porto'), 'img' => porto_options_uri.'/images/portfolio_archive_style_4.jpg'),
                            "large" => array('alt' => __('Large', 'porto'), 'img' => porto_options_uri.'/images/portfolio_archive_style_5.jpg'),
                            "full" => array('alt' => __('Full', 'porto'), 'img' => porto_options_uri.'/images/portfolio_archive_style_6.jpg'),
                        ),
                        'default' => 'grid'
                    ),
                    array(
                        'id'=>'portfolio-archive-masonry-ratio',
                        'type' => 'text',
                        "title" => __("Masonry Image Aspect Ratio", 'porto'),
                        'required' => array('portfolio-layout','equals',array('masonry')),
                        'desc' => __('ratio = width / height. if ratio is large than this value, will take more space.', 'porto'),
                        'default' => '2.4'
                    ),
                    array(
                        'id'=>'portfolio-grid-columns',
                        'type' => 'button_set',
                        'title' => __('Columns', 'porto'),
                        'required' => array('portfolio-layout','equals',array('grid', 'masonry')),
                        'options' => array(
                            "1" => __("1 Column", 'porto'),
                            "2" => __("2 Columns", 'porto'),
                            "3" => __("3 Columns", 'porto'),
                            "4" => __("4 Columns", 'porto'),
                            "5" => __("5 Columns", 'porto'),
                            "6" => __("6 Columns", 'porto'),
                        ),
                        'default' => '4'
                    ),
                    array(
                        'id'=>'portfolio-grid-view',
                        'type' => 'image_select',
                        "title" => __("View Type", 'porto'),
                        'required' => array('portfolio-layout','equals',array('grid', 'masonry')),
                        'options' => array(
                            "default" => array('alt' => __('Default', 'porto'), 'img' => porto_options_uri.'/images/portfolio_archive_view_1.jpg'),
                            "full" => array('alt' => __('No Margin', 'porto'), 'img' => porto_options_uri.'/images/portfolio_archive_view_2.jpg'),
                            "outimage" => array('alt' => __('Out of Image', 'porto'), 'img' => porto_options_uri.'/images/portfolio_archive_view_3.jpg'),
                        ),
                        'default' => 'default'
                    ),
                    array(
                        'id'=>'portfolio-archive-thumb',
                        'type' => 'image_select',
                        "title" => __("Info View Type", 'porto'),
                        'required' => array('portfolio-layout','equals',array('grid', 'masonry', 'timeline')),
                        'options' => array(
                            "" => array('alt' => __('Left Info', 'porto'), 'img' => porto_options_uri.'/images/portfolio_info_view_1.jpg'),
                            "centered-info" => array('alt' => __('Centered Info', 'porto'), 'img' => porto_options_uri.'/images/portfolio_info_view_2.jpg'),
                            "bottom-info" => array('alt' => __('Bottom Info', 'porto'), 'img' => porto_options_uri.'/images/portfolio_info_view_3.jpg'),
                            "bottom-info-dark" => array('alt' => __('Bottom Info Dark', 'porto'), 'img' => porto_options_uri.'/images/portfolio_info_view_4.jpg'),
                            "hide-info-hover" => array('alt' => __('Hide Info Hover', 'porto'), 'img' => porto_options_uri.'/images/portfolio_info_view_5.jpg')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'portfolio-archive-thumb-bg',
                        'type' => 'button_set',
                        "title" => __("Image Overlay Background", 'porto'),
                        'options' => array(
                            "" => __('Darken', 'porto'),
                            "lighten" => __('Lighten', 'porto'),
                            "hide-wrapper-bg" => __('Transparent', 'porto')
                        ),
                        'default' => 'lighten'
                    ),
                    array(
                        'id'=>'portfolio-archive-thumb-image',
                        'type' => 'button_set',
                        "title" => __("Hover Image Effect", 'porto'),
                        'options' => array(
                            "" => __('Zoom', 'porto'),
                            "no-zoom" => __('No Zoom', 'porto'),
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'portfolio-archive-readmore',
                        'type' => 'switch',
                        "title" => __('Show "Read More" Link', 'porto'),
                        "description" => __('Show "Read More" link in "Out of Image" view type.', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-archive-readmore-label',
                        'type' => 'text',
                        "title" => __('"Read More" Label', 'porto'),
                        'required' => array('portfolio-archive-readmore','equals',true),
                        "placeholder" => __("View Project...", 'porto')
                    ),
                    array(
                        'id'=>'portfolio-archive-link',
                        'type' => 'switch',
                        "title" => __("Show Link Icon", 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-archive-all-images',
                        'type' => 'switch',
                        "title" => __("Show More Featured Images in Slideshow", 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-archive-images-count',
                        'type' => 'text',
                        "title" => __("Featured Images Count", 'porto'),
                        'required' => array('portfolio-archive-all-images','equals',true),
                        'default' => '2'
                    ),
                    array(
                        'id'=>'portfolio-archive-zoom',
                        'type' => 'switch',
                        'title' => __('Image Lightbox', 'porto'),
                        'default' => false,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-external-link',
                        'type' => 'switch',
                        'title' => __('Show External Link instead of Portfolio Link', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-excerpt',
                        'type' => 'switch',
                        'title' => __('Show Excerpt', 'porto'),
                        'desc' => __('If yes, will be show the excerpt. If no, will be show the content.', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-excerpt-length',
                        'type' => 'text',
                        'required' => array('portfolio-excerpt','equals',true),
                        'title' => __('Excerpt Length', 'porto'),
                        'desc' => __('The number of words', 'porto'),
                        'default' => '80',
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Single Portfolio', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'portfolio-single-layout',
                        'type' => 'image_select',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $page_layouts,
                        'default' => 'fullwidth'
                    ),
                    array(
                        'id'=>'portfolio-single-sidebar',
                        'type' => 'select',
                        'title' => __('Select Sidebar', 'porto'),
                        'required' => array('portfolio-single-layout','equals',$sidebars),
                        'data' => 'sidebars'
                    ),
                    array(
                        'id'=>'portfolio-single-sticky-sidebar',
                        'type' => 'switch',
                        'title' => __('Enable Sticky Sidebar', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto')
                    ),
                    array(
                        'id'=>'portfolio-banner-block',
                        'type' => 'text',
                        'title' => __('Global Banner Block', 'porto'),
                        'desc' => __('Please input comma separated block slug names. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),
                    array(
                        'id'=>'portfolio-page-nav',
                        'type' => 'switch',
                        'title' => __('Show Navigation', 'porto'),
                        'desc' => __('Show list and title, next/prev links.', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-content-layout',
                        'type' => 'image_select',
                        'title' => __('Portfolio Layout', 'porto'),
                        'options' => array(
                            "medium" => array('alt' => __('Medium Slider', 'porto'), 'img' => porto_options_uri.'/images/portfolio_single_style_1.jpg'),
                            "large" => array('alt' => __('Large Slider', 'porto'), 'img' => porto_options_uri.'/images/portfolio_single_style_2.jpg'),
                            "full" => array('alt' => __('Full Slider', 'porto'), 'img' => porto_options_uri.'/images/portfolio_single_style_3.jpg'),
                            "gallery" => array('alt' => __('Gallery', 'porto'), 'img' => porto_options_uri.'/images/portfolio_single_style_4.jpg'),
                            "carousel" => array('alt' => __('Carousel', 'porto'), 'img' => porto_options_uri.'/images/portfolio_single_style_5.jpg'),
                            "medias" => array('alt' => __('Medias', 'porto'), 'img' => porto_options_uri.'/images/portfolio_single_style_6.jpg'),
                            "full-video" => array('alt' => __('Full Width Video', 'porto'), 'img' => porto_options_uri.'/images/portfolio_single_style_7.jpg'),
                            "masonry" => array('alt' => __('Masonry Images', 'porto'), 'img' => porto_options_uri.'/images/portfolio_single_style_8.jpg'),
                            "full-images" => array('alt' => __('Full Images', 'porto'), 'img' => porto_options_uri.'/images/portfolio_single_style_9.jpg'),
                            "extended" => array('alt' => __('Extended', 'porto'), 'img' => porto_options_uri.'/images/portfolio_single_style_10.jpg'),
                        ),
                        'default' => 'medium'
                    ),
                    array(
                        'id'=>'portfolio-slider',
                        'type' => 'image_select',
                        'title' => __('Slider Type', 'porto'),
                        'required' => array('portfolio-content-layout','equals',array('medium','large','full')),
                        'options' => array(
                            "without-thumbs" => array('alt' => __('Without Thumbs', 'porto'), 'img' => porto_options_uri.'/images/portfolio_slideshow_1.jpg'),
                            "with-thumbs" => array('alt' => __('With Thumbs', 'porto'), 'img' => porto_options_uri.'/images/portfolio_slideshow_2.jpg'),
                        ),
                        'default' => 'without-thumbs'
                    ),
                    array(
                        'id'=>'portfolio-slider-thumbs-count',
                        'type' => 'text',
                        'title' => __('Slider Thumbs Count', 'porto'),
                        'required' => array('portfolio-slider','equals',array('with-thumbs')),
                        'default' => '4'
                    ),
                    array(
                        'id'=>'portfolio-share',
                        'type' => 'switch',
                        'title' => __('Show Social Share Links', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-author',
                        'type' => 'switch',
                        'title' => __('Show Author Info', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-comments',
                        'type' => 'switch',
                        'title' => __('Show Comments', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-related',
                        'type' => 'switch',
                        'title' => __('Show Related Portfolios', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'portfolio-related-count',
                        'type' => 'text',
                        'required' => array('portfolio-related','equals',true),
                        'title' => __('Related Portfolios Count', 'porto'),
                        'desc' => __('If you want to show all the related portfolios, please input "-1".', 'porto'),
                        'default' => '10'
                    ),
                    array(
                        'id'=>'portfolio-related-orderby',
                        'type' => 'button_set',
                        'required' => array('portfolio-related','equals',true),
                        'title' => __('Related Portfolios Order by', 'porto'),
                        'options' => array(
                            'none' => __('None', 'porto'),
                            'rand' => __('Random', 'porto'),
                            'date' => __('Date', 'porto'),
                            'ID' => __('ID', 'porto'),
                            'modified' => __('Modified Date', 'porto'),
                            'comment_count' => __('Comment Count', 'porto')
                        ),
                        'default' => 'rand'
                    ),
                    array(
                        'id'=>'portfolio-related-cols',
                        'type' => 'button_set',
                        'required' => array('portfolio-related','equals',true),
                        'title' => __('Related Portfolios Columns', 'porto'),
                        'description' => __('reduce one column in left or right sidebar layout', 'porto'),
                        'options' => array(
                            '4' => '4',
                            '3' => '3',
                            '2' => '2',
                        ),
                        'default' => '4'
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Portfolio Carousel', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'portfolio-related-style',
                        'type' => 'image_select',
                        'title' => __('Portfolio Style', 'porto'),
                        'options' => array(
                            "" => array('alt' => __('Default', 'porto'), 'img' => porto_options_uri.'/images/portfolio_archive_view_1.jpg'),
                            "full" => array('alt' => __('No Margin', 'porto'), 'img' => porto_options_uri.'/images/portfolio_archive_view_2.jpg'),
                            "outimage" => array('alt' => __('Out of Image', 'porto'), 'img' => porto_options_uri.'/images/portfolio_archive_view_3.jpg'),
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'portfolio-related-thumb',
                        'type' => 'image_select',
                        "title" => __("Info View Type", 'porto'),
                        'options' => array(
                            "" => array('alt' => __('Left Info', 'porto'), 'img' => porto_options_uri.'/images/portfolio_info_view_1.jpg'),
                            "centered-info" => array('alt' => __('Centered Info', 'porto'), 'img' => porto_options_uri.'/images/portfolio_info_view_2.jpg'),
                            "bottom-info" => array('alt' => __('Bottom Info', 'porto'), 'img' => porto_options_uri.'/images/portfolio_info_view_3.jpg'),
                            "bottom-info-dark" => array('alt' => __('Bottom Info Dark', 'porto'), 'img' => porto_options_uri.'/images/portfolio_info_view_4.jpg'),
                            "hide-info-hover" => array('alt' => __('Hide Info Hover', 'porto'), 'img' => porto_options_uri.'/images/portfolio_info_view_5.jpg')
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'portfolio-related-thumb-bg',
                        'type' => 'button_set',
                        "title" => __("Image Overlay Background", 'porto'),
                        'options' => array(
                            "" => __('Darken', 'porto'),
                            "lighten" => __('Lighten', 'porto'),
                            "hide-wrapper-bg" => __('Transparent', 'porto')
                        ),
                        'default' => 'lighten'
                    ),
                    array(
                        'id'=>'portfolio-related-thumb-image',
                        'type' => 'button_set',
                        "title" => __("Hover Image Effect", 'porto'),
                        'options' => array(
                            "" => __('Zoom', 'porto'),
                            "no-zoom" => __('No Zoom', 'porto'),
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'portfolio-related-link',
                        'type' => 'switch',
                        "title" => __("Show Link Icon", 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    )
                )
            );

            // Member
            $this->sections[] = array(
                'icon' => 'el-icon-user',
                'icon_class' => 'icon',
                'title' => __('Member', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'enable-member',
                        'type' => 'switch',
                        'title' => __('Member Content Type', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),
                    array(
                        'id' => "member-slug-name",
                        'type' => 'text',
                        'title' => __('Slug Name', 'porto'),
                        'placeholder' => 'member'
                    ),
                    array(
                        'id' => "member-name",
                        'type' => 'text',
                        'title' => __('Name', 'porto'),
                        'placeholder' => __('Members', 'porto')
                    ),
                    array(
                        'id' => "member-singular-name",
                        'type' => 'text',
                        'title' => __('Singular Name', 'porto'),
                        'placeholder' => __('Member', 'porto')
                    ),
                    array(
                        'id' => "member-cat-slug-name",
                        'type' => 'text',
                        'title' => __('Category Slug Name', 'porto'),
                        'placeholder' => 'member_cat'
                    ),
                    array(
                        'id' => "member-archive-page",
                        'type' => 'select',
                        'data' => 'page',
                        'title' => __('Members Page', 'porto')
                    ),
                    array(
                        'id'=>'member-zoom',
                        'type' => 'switch',
                        'title' => __('Image Lightbox', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),
                    array(
                        'id'=>'member-social-target',
                        'type' => 'switch',
                        'title' => __('Show Social Link in Blank Target', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Member Archives', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'member-title',
                        'type' => 'text',
                        'title' => __('Page Title', 'porto'),
                        'default' => 'Meet the <strong>Team</strong>'
                    ),
                    array(
                        'id'=>'member-sub-title',
                        'type' => 'textarea',
                        'title' => __('Page Sub Title', 'porto'),
                        'default' => ''
                    ),
                    array(
                        'id'=>'member-archive-layout',
                        'type' => 'image_select',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $page_layouts,
                        'default' => 'fullwidth'
                    ),
                    array(
                        'id'=>'member-archive-sidebar',
                        'type' => 'select',
                        'title' => __('Select Sidebar', 'porto'),
                        'required' => array('member-archive-layout','equals',$sidebars),
                        'data' => 'sidebars'
                    ),
                    array(
                        'id'=>'member-archive-sticky-sidebar',
                        'type' => 'switch',
                        'title' => __('Enable Sticky Sidebar', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto')
                    ),
                    array(
                        'id'=>'member-archive-ajax',
                        'type' => 'switch',
                        'title' => __('Enable Ajax Load', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto')
                    ),
                    array(
                        'id'=>'member-infinite',
                        'type' => 'switch',
                        'title' => __('Enable Infinite Scroll', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'member-cat-orderby',
                        'type' => 'button_set',
                        'title' => __('Sort Categories Order By', 'porto'),
                        'options' => $porto_categories_orderby,
                        'default' => 'name'
                    ),
                    array(
                        'id'=>'member-cat-order',
                        'type' => 'button_set',
                        'title' => __('Sort Order for Categories', 'porto'),
                        'options' => $porto_categories_order,
                        'default' => 'asc'
                    ),
                    array(
                        'id'=>'member-cat-sort-pos',
                        'type' => 'button_set',
                        'title' => __('Filter Position', 'porto'),
                        'options' => $porto_categories_sort_pos,
                        'default' => 'content'
                    ),
                    array(
                        'id'=>'member-columns',
                        'type' => 'button_set',
                        'title' => __('Member Columns', 'porto'),
                        'options' => array(
                            "2" => __("2 Columns", 'porto'),
                            "3" => __("3 Columns", 'porto'),
                            "4" => __("4 Columns", 'porto'),
                            "5" => __("5 Columns", 'porto'),
                            "6" => __("6 Columns", 'porto'),
                        ),
                        'default' => '4'
                    ),
                    array(
                        'id'=>'member-view-type',
                        'type' => 'image_select',
                        'title' => __('View Type', 'porto'),
                        'default' => '',
                        'options' => array(
                            "" => array('alt' => __('Type 1', 'porto'), 'img' => porto_options_uri.'/images/member_archive_view_1.jpg'),
                            "2" => array('alt' => __('Type 2', 'porto'), 'img' => porto_options_uri.'/images/member_archive_view_2.jpg'),
                            "3" => array('alt' => __('Type 3', 'porto'), 'img' => porto_options_uri.'/images/member_archive_view_3.jpg'),
                        )
                    ),
                    array(
                        'id'=>'member-image-size',
                        'type' => 'button_set',
                        'title' => __('Member Image Size', 'porto'),
                        'options' => array(
                            "" => __("Static", 'porto'),
                            "full" => __("Full", 'porto'),
                        ),
                        'default' => ''
                    ),
                    array(
                        'id'=>'member-archive-readmore',
                        'type' => 'switch',
                        "title" => __('Show "Read More" Link', 'porto'),
                        "description" => __('Show "Read More" link in "Type 2" view type.', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'member-archive-readmore-label',
                        'type' => 'text',
                        "title" => __('"Read More" Label', 'porto'),
                        'required' => array('member-archive-readmore','equals',true),
                        "placeholder" => __("View More...", 'porto')
                    ),
                    array(
                        'id'=>'member-external-link',
                        'type' => 'switch',
                        'title' => __('Show External Link instead of Member Link', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'member-overview',
                        'type' => 'switch',
                        'title' => __('Show Overview', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'member-excerpt',
                        'type' => 'switch',
                        'title' => __('Show Overview Excerpt', 'porto'),
                        'required' => array('member-overview','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'member-excerpt-length',
                        'type' => 'text',
                        'required' => array('member-excerpt','equals',true),
                        'title' => __('Excerpt Length', 'porto'),
                        'desc' => __('The number of words', 'porto'),
                        'default' => '15',
                    ),
                    array(
                        'id'=>'member-socials',
                        'type' => 'switch',
                        'title' => __('Show Social Links', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __('Single Member', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'member-single-layout',
                        'type' => 'image_select',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $page_layouts,
                        'default' => 'fullwidth'
                    ),
                    array(
                        'id'=>'member-single-sidebar',
                        'type' => 'select',
                        'title' => __('Select Sidebar', 'porto'),
                        'required' => array('member-single-layout','equals',$sidebars),
                        'data' => 'sidebars'
                    ),
                    array(
                        'id'=>'member-single-sticky-sidebar',
                        'type' => 'switch',
                        'title' => __('Enable Sticky Sidebar', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto')
                    ),
                    array(
                        'id'=>'member-banner-block',
                        'type' => 'text',
                        'title' => __('Global Banner Block', 'porto'),
                        'desc' => __('Please input comma separated block slug names. You can create a block in <strong>Blocks/Add New</strong>.', 'porto')
                    ),
                    array(
                        'id'=>'member-related',
                        'type' => 'switch',
                        'title' => __('Show Related Members', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'member-related-count',
                        'type' => 'text',
                        'required' => array('member-related','equals',true),
                        'title' => __('Related Members Count', 'porto'),
                        'desc' => __('If you want to show all the related members, please input "-1".', 'porto'),
                        'default' => '10'
                    ),
                    array(
                        'id'=>'member-related-orderby',
                        'type' => 'button_set',
                        'required' => array('member-related','equals',true),
                        'title' => __('Related Members Order by', 'porto'),
                        'options' => array(
                            'none' => __('None', 'porto'),
                            'rand' => __('Random', 'porto'),
                            'date' => __('Date', 'porto'),
                            'ID' => __('ID', 'porto'),
                            'modified' => __('Modified Date', 'porto')
                        ),
                        'default' => 'rand'
                    ),
                    array(
                        'id'=>'member-related-cols',
                        'type' => 'button_set',
                        'required' => array('member-related','equals',true),
                        'title' => __('Related Members Columns', 'porto'),
                        'description' => __('reduce one column in left or right sidebar layout', 'porto'),
                        'options' => array(
                            '4' => '4',
                            '3' => '3',
                            '2' => '2',
                        ),
                        'default' => '4'
                    ),
                    array(
                        'id'=>'member-socials-pos',
                        'type' => 'button_set',
                        'title' => __('Social Links Position', 'porto'),
                        'options' => array(
                            "" => __("Before Overview", 'porto'),
                            "after" => __("After Overview", 'porto'),
                        ),
                        'default' => ''
                    ),
                )
            );

            // FAQ
            $this->sections[] = array(
                'icon' => 'el-icon-question',
                'icon_class' => 'icon',
                'title' => __('FAQ', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'enable-faq',
                        'type' => 'switch',
                        'title' => __('FAQ Content Type', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),
                    array(
                        'id' => "faq-slug-name",
                        'type' => 'text',
                        'title' => __('Slug Name', 'porto'),
                        'placeholder' => 'faq'
                    ),
                    array(
                        'id' => "faq-name",
                        'type' => 'text',
                        'title' => __('Name', 'porto'),
                        'placeholder' => __('FAQs', 'porto')
                    ),
                    array(
                        'id' => "faq-singular-name",
                        'type' => 'text',
                        'title' => __('Singular Name', 'porto'),
                        'placeholder' => __('FAQ', 'porto')
                    ),
                    array(
                        'id' => "faq-cat-slug-name",
                        'type' => 'text',
                        'title' => __('Category Slug Name', 'porto'),
                        'placeholder' => 'faq_cat'
                    ),
                    array(
                        'id' => "faq-archive-page",
                        'type' => 'select',
                        'data' => 'page',
                        'title' => __('FAQs Page', 'porto')
                    ),
                    array(
                        'id'=>'faq-title',
                        'type' => 'text',
                        'title' => __('Page Title', 'porto'),
                        'default' => 'Frequently Asked <strong>Questions</strong>'
                    ),
                    array(
                        'id'=>'faq-sub-title',
                        'type' => 'textarea',
                        'title' => __('Page Sub Title', 'porto'),
                        'default' => ''
                    ),
                    array(
                        'id'=>'faq-cat-orderby',
                        'type' => 'button_set',
                        'title' => __('Sort Categories Order By', 'porto'),
                        'options' => $porto_categories_orderby,
                        'default' => 'name'
                    ),
                    array(
                        'id'=>'faq-cat-order',
                        'type' => 'button_set',
                        'title' => __('Sort Order for Categories', 'porto'),
                        'options' => $porto_categories_order,
                        'default' => 'asc'
                    ),
                    array(
                        'id'=>'faq-cat-sort-pos',
                        'type' => 'button_set',
                        'title' => __('Filter Position', 'porto'),
                        'options' => $porto_categories_sort_pos,
                        'default' => 'content'
                    ),
                    array(
                        'id'=>'faq-archive-layout',
                        'type' => 'image_select',
                        'title' => __('Page Layout', 'porto'),
                        'options' => $page_layouts,
                        'default' => 'fullwidth'
                    ),
                    array(
                        'id'=>'faq-archive-sidebar',
                        'type' => 'select',
                        'title' => __('Select Sidebar', 'porto'),
                        'required' => array('faq-archive-layout','equals',$sidebars),
                        'data' => 'sidebars'
                    ),
                    array(
                        'id'=>'faq-archive-sticky-sidebar',
                        'type' => 'switch',
                        'title' => __('Enable Sticky Sidebar', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto')
                    ),
                    array(
                        'id'=>'faq-infinite',
                        'type' => 'switch',
                        'title' => __('Enable Infinite Scroll', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                )
            );

            $this->sections[] = array(
                'icon_class' => 'el-icon-thumbs-up',
                'title' => __('SEO', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'rich-snippets',
                        'type' => 'switch',
                        'title' => __('Microdata Rich Snippets', 'porto'),
                        'default' => true,
                        'on' => __('Enable', 'porto'),
                        'off' => __('Disable', 'porto'),
                    ),
                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'title' => __('Compatible with Yoast SEO Plugin', 'porto'),
                        'descript' => __('Porto theme compatible with <a href="https://wordpress.org/plugins/wordpress-seo/">Yoast SEO</a> plugin.', 'porto'),
                        'notice' => false
                    ),
                )
            );

            // 404
            $this->sections[] = array(
                'icon' => 'el-icon-error',
                'icon_class' => 'icon',
                'title' => __('404 Error', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'error-block',
                        'type' => 'text',
                        'title' => __('Links Block', 'porto'),
                        'desc' => __('Input a block slug name', 'porto'),
                        'default' => 'error-404'
                    ),
                )
            );

            if ( class_exists( 'Woocommerce' ) ) :

                // Woocommerce
                $this->sections[] = array(
                    'icon' => 'el-icon-shopping-cart',
                    'icon_class' => 'icon',
                    'title' => __('Woocommerce', 'porto'),
                    'fields' => array(
                        array(
                            'id'=>'woo-show-rating',
                            'type' => 'switch',
                            'title' => __('Show Rating in Woocommerce Products Widget', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                    )
                );

                $this->sections[] = array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => __('Product Archives', 'porto'),
                    'fields' => array(
                        array(
                            'id'=>'product-archive-layout',
                            'type' => 'image_select',
                            'title' => __('Page Layout', 'porto'),
                            'options' => $page_layouts,
                            'default' => 'left-sidebar'
                        ),
                        array(
                            'id'=>'product-archive-sticky-sidebar',
                            'type' => 'switch',
                            'title' => __('Enable Sticky Sidebar', 'porto'),
                            'default' => false,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto')
                        ),
                        array(
                            'id'=>'category-ajax',
                            'type' => 'switch',
                            'title' => __('Enable Ajax Filter', 'porto'),
                            'default' => false,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'category-item',
                            'type' => 'text',
                            'title' => __('Products per Page', 'porto'),
                            'desc' => __('Comma separated list of product counts.', 'porto'),
                            'default' => '12,24,36'
                        ),
                        array(
                            'id'=>'category-view-mode',
                            'type' => 'button_set',
                            'title' => __('View Mode', 'porto'),
                            'options' => porto_ct_category_view_mode(),
                            'default' => '',
                        ),
                        array(
                            'id'=>'shop-product-cols',
                            'type' => 'button_set',
                            'title' => __('Shop Page Product Columns', 'porto'),
                            'options' => porto_ct_product_columns(),
                            'default' => '3',
                        ),
                        array(
                            'id'=>'product-cols',
                            'type' => 'button_set',
                            'title' => __('Category Product Columns', 'porto'),
                            'options' => porto_ct_product_columns(),
                            'default' => '3',
                        ),
                        array(
                            'id'=>'cat-view-type',
                            'type' => 'image_select',
                            'title' => __('Category View Type', 'porto'),
                            'default' => '',
                            'options' => array(
                                "" => array('alt' => __('Type 1', 'porto'), 'img' => porto_options_uri.'/images/product_cat_view_1.jpg'),
                                "2" => array('alt' => __('Type 2', 'porto'), 'img' => porto_options_uri.'/images/product_cat_view_2.jpg'),
                            )
                        ),
                        array(
                            'id'=>'category-image-hover',
                            'type' => 'switch',
                            'title' => __('Enable Image Hover Effect', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-stock',
                            'type' => 'switch',
                            'title' => __('Show "Out of stock" Status', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'1',
                            'type' => 'info',
                            'title' => __('Add Links Options', 'porto'),
                            'notice' => false
                        ),
                        array(
                            'id'=>'category-addlinks-convert',
                            'type' => 'switch',
                            'title' => __('Change "A" Tag to "SPAN" Tag', 'porto'),
                            'default' => false,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'category-addlinks-pos',
                            'type' => 'image_select',
                            'title' => __('Add Links Position', 'porto'),
                            'desc' => __('Select position of add to cart, add to wishlist, quickview.', 'porto'),
                            'options' => array(
                                "outimage" => array('alt' => __('Out of Image', 'porto'), 'img' => porto_options_uri.'/images/product_addlinks_style_1.jpg'),
                                "onimage" => array('alt' => __('On Image', 'porto'), 'img' => porto_options_uri.'/images/product_addlinks_style_2.jpg'),
                                "wq_onimage" => array('alt' => __('Wishlist, Quick View On Image', 'porto'), 'img' => porto_options_uri.'/images/product_addlinks_style_3.jpg'),
                            ),
                            'default' => 'outimage'
                        ),
                        array(
                            'id'=>'category-hover',
                            'type' => 'switch',
                            'title' => __('Enable Hover Effect', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-wishlist',
                            'type' => 'switch',
                            'title' => __('Show Wishlist', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-quickview',
                            'type' => 'switch',
                            'title' => __('Show Quick View', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto')
                        ),
                        array(
                            'id'=>'product-quickview-label',
                            'type' => 'text',
                            'required' => array('product-quickview','equals',true),
                            'title' => __('"Quick View" Text', 'porto'),
                            'default' => ''
                        ),
                    )
                );

                $this->sections[] = array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => __('Single Product', 'porto'),
                    'fields' => array(
                        array(
                            'id'=>'product-single-layout',
                            'type' => 'image_select',
                            'title' => __('Page Layout', 'porto'),
                            'options' => $page_layouts,
                            'default' => 'right-sidebar'
                        ),
                        array(
                            'id'=>'product-single-sticky-sidebar',
                            'type' => 'switch',
                            'title' => __('Enable Sticky Sidebar', 'porto'),
                            'default' => false,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto')
                        ),
                        array(
                            'id'=>'product-nav',
                            'type' => 'switch',
                            'title' => __('Show Prev/Next Product', 'porto'),
                            'desc' => __('Will be show in breadcrumbs', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-short-desc',
                            'type' => 'switch',
                            'title' => __('Show Short Description', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id' => "product-custom-tabs-count",
                            'type' => 'text',
                            'title' => __('Custom Tabs Count', 'porto'),
                            'default' => '2'
                        ),
                        array(
                            'id'=>'product-tabs',
                            'type' => 'button_set',
                            'title' => __('Tabs Type', 'porto'),
                            'options' => array('default' => __('Horizontal', 'porto'), 'vertical' => __('Vertical', 'porto'), 'accordion' => __('Accordion', 'porto')),
                            'default' => 'default'
                        ),
                        array(
                            'id'=>'product-tabs-pos',
                            'type' => 'button_set',
                            'title' => __('Tabs Position', 'porto'),
                            'options' => array('' => __('Default', 'porto'), 'below' => __('Below Price & Short Description', 'porto')),
                            'default' => ''
                        ),
                        array(
                            'id'=>'product-metas',
                            'type' => 'button_set',
                            'title' => __('Product Meta', 'porto'),
                            'multi' => true,
                            'options'=> array(
                                'sku' => __('SKU', 'porto'),
                                'cats' => __('Categories', 'porto'),
                                'tags' => __('Tags', 'porto'),
                                '-' => 'None',
                            ),
                            'default' => array('sku','cats','tags','-')
                        ),
                        array(
                            'id' => "product-tab-title",
                            'type' => 'text',
                            'title' => __('Global Product Custom Tab Title', 'porto'),
                            'default' => ''
                        ),
                        array(
                            'id' => "product-tab-block",
                            'type' => 'text',
                            'title' => __('Global Product Custom Tab Block', 'porto'),
                            'desc' => __('Input block slug name', 'porto'),
                            'default' => ''
                        ),
                        array(
                            'id' => "product-tab-priority",
                            'type' => 'text',
                            'title' => __('Global Product Custom Tab Priority', 'porto'),
                            'desc' => __('Input the custom tab priority. (Description: 10, Additional Information: 20, Reviews: 30)', 'porto'),
                            'default' => '60'
                        ),
                        array(
                            'id'=>'product-related',
                            'type' => 'switch',
                            'title' => __('Show Related Products', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-related-count',
                            'type' => 'text',
                            'required' => array('product-related','equals',true),
                            'title' => __('Related Products Count', 'porto'),
                            'default' => '10'
                        ),
                        array(
                            'id'=>'product-related-cols',
                            'type' => 'button_set',
                            'required' => array('product-related','equals',true),
                            'title' => __('Related Product Columns', 'porto'),
                            'options' => porto_ct_related_product_columns(),
                            'default' => '4',
                        ),
                        array(
                            'id'=>'product-upsells',
                            'type' => 'switch',
                            'title' => __('Show Up Sells', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-upsells-count',
                            'type' => 'text',
                            'required' => array('product-upsells','equals',true),
                            'title' => __('Up Sells Count', 'porto'),
                            'default' => '10'
                        ),
                        array(
                            'id'=>'product-upsells-cols',
                            'type' => 'button_set',
                            'required' => array('product-upsells','equals',true),
                            'title' => __('Up Sells Product Columns', 'porto'),
                            'options' => porto_ct_related_product_columns(),
                            'default' => '4',
                        ),
                        array(
                            'id'=>'product-hot',
                            'type' => 'switch',
                            'title' => __('Show "Hot" Label', 'porto'),
                            'desc' => __('Will be show in the featured product.', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-hot-label',
                            'type' => 'text',
                            'required' => array('product-hot','equals',true),
                            'title' => __('"Hot" Text', 'porto'),
                            'default' => ''
                        ),
                        array(
                            'id'=>'product-sale',
                            'type' => 'switch',
                            'title' => __('Show "Sale" Label', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-sale-label',
                            'type' => 'text',
                            'required' => array('product-sale','equals',true),
                            'title' => __('"Sale" Text', 'porto'),
                            'default' => ''
                        ),
                        array(
                            'id'=>'product-sale-percent',
                            'type' => 'switch',
                            'required' => array('product-sale','equals',true),
                            'title' => __('Show Saved Sale Price Percentage', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-share',
                            'type' => 'switch',
                            'title' => __('Show Social Share Links', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                    )
                );

                $this->sections[] = array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => __('Product Image & Zoom', 'porto'),
                    'fields' => array(
                        array(
                            'id'=>'product-thumbs',
                            'type' => 'switch',
                            'title' => __('Show Thumbnails', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-thumbs-count',
                            'type' => 'text',
                            'required' => array('product-thumbs','equals',true),
                            'title' => __('Thumbnails Count', 'porto'),
                            'default' => '4'
                        ),
                        array(
                            'id'=>'product-zoom',
                            'type' => 'switch',
                            'title' => __('Enable Image Zoom', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-zoom-mobile',
                            'type' => 'switch',
                            'title' => __('Enable Image Zoom on Mobile', 'porto'),
                            'required' => array('product-zoom','equals',true),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-image-popup',
                            'type' => 'switch',
                            'title' => __('Enable Image Popup', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'zoom-type',
                            'type' => 'button_set',
                            'title' => __('Zoom Type', 'porto'),
                            'options' => array('inner' => __('Inner', 'porto'), 'lens' => __('Lens', 'porto')),
                            'default' => 'inner'
                        ),
                        array(
                            'id'=>'zoom-scroll',
                            'type' => 'switch',
                            'required' => array('zoom-type','equals',array('lens')),
                            'title' => __('Scroll Zoom', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'zoom-lens-size',
                            'type' => 'text',
                            'required' => array('zoom-type','equals',array('lens')),
                            'title' => __('Lens Size', 'porto'),
                            'default' => '200'
                        ),
                        array(
                            'id'=>'zoom-lens-shape',
                            'type' => 'button_set',
                            'required' => array('zoom-type','equals',array('lens')),
                            'title' => __('Lens Shape', 'porto'),
                            'options' => array('round' => __('Round', 'porto'), 'square' => __('Square', 'porto')),
                            'default' => 'square'
                        ),
                        array(
                            'id'=>'zoom-contain-lens',
                            'type' => 'switch',
                            'required' => array('zoom-type','equals',array('lens')),
                            'title' => __('Contain Lens Zoom', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'zoom-lens-border',
                            'type' => 'text',
                            'required' => array('zoom-type','equals',array('lens')),
                            'title' => __('Lens Border', 'porto'),
                            'default' => true
                        ),
                        array(
                            'id'=>'zoom-border',
                            'type' => 'text',
                            'required' => array('zoom-type','equals',array('lens')),
                            'title' => __('Border Size', 'porto'),
                            'default' => '4'
                        ),
                        array(
                            'id'=>'zoom-border-color',
                            'type' => 'color',
                            'required' => array('zoom-type','equals',array('lens')),
                            'title' => __('Border Color', 'porto'),
                            'default' => '#888888'
                        ),
                    )
                );

                $this->sections[] = array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => __('Cart Page', 'porto'),
                    'fields' => array(
                        array(
                            'id'=>'product-crosssell',
                            'type' => 'switch',
                            'title' => __('Show Cross Sells', 'porto'),
                            'default' => true,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'product-crosssell-count',
                            'type' => 'text',
                            'required' => array('product-crosssell','equals',true),
                            'title' => __('Cross Sells Count', 'porto'),
                            'default' => '8'
                        ),
                    )
                );

                $this->sections[] = array(
                    'icon_class' => 'icon',
                    'subsection' => true,
                    'title' => __('Catalog Mode', 'porto'),
                    'fields' => array(
                        array(
                            'id'=>'catalog-enable',
                            'type' => 'switch',
                            'title' => __('Enable Catalog Mode', 'porto'),
                            'default' => false,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'catalog-price',
                            'type' => 'switch',
                            'title' => __('Show Price', 'porto'),
                            'default' => false,
                            'required' => array('catalog-enable','equals',true),
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'catalog-cart',
                            'type' => 'switch',
                            'title' => __('Show Add Cart Button', 'porto'),
                            'default' => false,
                            'required' => array('catalog-enable','equals',true),
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'catalog-readmore',
                            'type' => 'switch',
                            'title' => __('Show Read More Button', 'porto'),
                            'default' => false,
                            'required' => array('catalog-cart','equals',false),
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'catalog-readmore-target',
                            'type' => 'button_set',
                            'title' => __('Read More Button Target', 'porto'),
                            'required' => array('catalog-readmore','equals',true),
                            'options' => array(
                                '' => __('Self', 'porto'),
                                '_blank' => __('Blank', 'porto')
                            ),
                            'default' => ''
                        ),
                        array(
                            'id'=>'catalog-readmore-label',
                            'type' => 'text',
                            'required' => array('catalog-readmore','equals',true),
                            'title' => __('Read More Button Label', 'porto'),
                            'default' => 'Read More'
                        ),
                        array(
                            'id'=>'catalog-readmore-archive',
                            'type' => 'button_set',
                            'title' => __('Use Read More Link in', 'porto'),
                            'required' => array('catalog-readmore','equals',true),
                            'options' => array(
                                'all' => __('Product and Product Archives', 'porto'),
                                'product' => __('Product', 'porto')
                            ),
                            'default' => 'all'
                        ),
                        array(
                            'id'=>'catalog-review',
                            'type' => 'switch',
                            'title' => __('Show Reviews', 'porto'),
                            'default' => false,
                            'required' => array('catalog-enable','equals',true),
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        ),
                        array(
                            'id'=>'catalog-admin',
                            'type' => 'switch',
                            'title' => __('Enable also for administrators', 'porto'),
                            'default' => true,
                            'required' => array('catalog-enable','equals',true),
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto'),
                        )
                    )
                );

            endif;

            if (class_exists('bbPress') || class_exists('BuddyPress')) :

                // BBPress & BuddyPress
                $this->sections[] = array(
                    'icon' => 'el-icon-book',
                    'icon_class' => 'icon',
                    'title' => __('BBPress & BuddyPress', 'porto'),
                    'fields' => array(
                        array(
                            'id'=>'bb-layout',
                            'type' => 'image_select',
                            'title' => __('Page Layout', 'porto'),
                            'options' => $page_layouts,
                            'default' => 'fullwidth'
                        ),
                        array(
                            'id'=>'bb-sidebar',
                            'type' => 'select',
                            'title' => __('Select Sidebar', 'porto'),
                            'required' => array('bb-layout','equals',$sidebars),
                            'data' => 'sidebars'
                        ),
                        array(
                            'id'=>'bb-sticky-sidebar',
                            'type' => 'switch',
                            'title' => __('Enable Sticky Sidebar', 'porto'),
                            'default' => false,
                            'on' => __('Yes', 'porto'),
                            'off' => __('No', 'porto')
                        ),
                    )
                );

            endif;

            // Social Share
            $this->sections[] = array(
                'icon' => 'el-icon-share-alt',
                'icon_class' => 'icon',
                'title' => __('Social Share', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'share-enable',
                        'type' => 'switch',
                        'title' => __('Show Social Links', 'porto'),
                        'desc' => __('Show social links in post and product, page, portfolio, etc.', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'share-nofollow',
                        'type' => 'switch',
                        'title' => __('Add rel="nofollow" to social links', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'share-facebook',
                        'type' => 'switch',
                        'title' => __('Enable Facebook Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'share-twitter',
                        'type' => 'switch',
                        'title' => __('Enable Twitter Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'share-linkedin',
                        'type' => 'switch',
                        'title' => __('Enable LinkedIn Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'share-googleplus',
                        'type' => 'switch',
                        'title' => __('Enable Google + Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'share-pinterest',
                        'type' => 'switch',
                        'title' => __('Enable Pinterest Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'share-email',
                        'type' => 'switch',
                        'title' => __('Enable Email Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'share-vk',
                        'type' => 'switch',
                        'title' => __('Enable VK Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'share-xing',
                        'type' => 'switch',
                        'title' => __('Enable Xing Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'share-tumblr',
                        'type' => 'switch',
                        'title' => __('Enable Tumblr Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'share-reddit',
                        'type' => 'switch',
                        'title' => __('Enable Reddit Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'share-whatsapp',
                        'type' => 'switch',
                        'title' => __('Enable WhatsApp Share', 'porto'),
                        'required' => array('share-enable','equals',true),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                )
            );

            // Slider Config
            $this->sections[] = array(
                'icon' => 'el-icon-picture',
                'icon_class' => 'icon',
                'title' => __('Slider Config', 'porto'),
                'fields' => array(
                    array(
                        'id'=>'slider-loop',
                        'type' => 'switch',
                        'title' => __('Loop', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'slider-autoplay',
                        'type' => 'switch',
                        'title' => __('Auto Play', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'slider-speed',
                        'type' => 'text',
                        'title' => __('Play Speed', 'porto'),
                        'required' => array('slider-autoplay','equals',true),
                        'desc' => __('unit: millisecond', 'porto'),
                        'default' => 5000
                    ),
                    array(
                        'id'=>'slider-autoheight',
                        'type' => 'switch',
                        'title' => __('Auto Height', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'slider-nav',
                        'type' => 'switch',
                        'title' => __('Show Next/Prev Buttons', 'porto'),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'slider-nav-hover',
                        'type' => 'switch',
                        'title' => __('Show Next/Prev Buttons on Hover', 'porto'),
                        'required' => array('slider-nav','equals',true),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'slider-margin',
                        'type' => 'switch',
                        'title' => __('Enable Margin', 'porto'),
                        'required' => array('slider-nav-hover','equals',false),
                        'default' => false,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'slider-dots',
                        'type' => 'switch',
                        'title' => __('Show Dots Navigation', 'porto'),
                        'default' => true,
                        'on' => __('Yes', 'porto'),
                        'off' => __('No', 'porto'),
                    ),
                    array(
                        'id'=>'slider-animatein',
                        'type' => 'text',
                        'title' => __('Animate In', 'porto'),
                        'default' => '',
                        'desc' => __('Please input animation. Please reference <a href="http://daneden.github.io/animate.css/">animate.css</a>. ex: fadeIn', 'porto'),
                    ),
                    array(
                        'id'=>'slider-animateout',
                        'type' => 'text',
                        'title' => __('Animate Out', 'porto'),
                        'default' => '',
                        'desc' => __('Please input animation. Please reference <a href="http://daneden.github.io/animate.css/">animate.css</a>. ex: fadeOut', 'porto'),
                    ),
                )
            );
        }

        public function setHelpTabs() {

        }

        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name'          => 'porto_settings',
                'display_name'      => $theme->get('Name') . ' ' . __('Theme Options', 'porto') . '<a class="porto-theme-link" href="' . admin_url( 'admin.php?page=porto' ) . '">Welcome</a><a class="porto-theme-link" href="' . admin_url( 'admin.php?page=porto-system' ) . '">System Status</a><a class="porto-theme-link" href="' . admin_url( 'admin.php?page=porto-plugins' ) . '">Plugins</a><a class="porto-theme-link porto-theme-link-last" href="' . admin_url( 'admin.php?page=porto-demos' ) . '">Install Demos</a>',
                'display_version'   => __('Theme Version: ', 'porto') . porto_version,
                'menu_type'         => 'submenu',
                'allow_sub_menu'    => true,
                'menu_title'        => __('Theme Options', 'porto'),
                'page_title'        => __('Theme Options', 'porto'),
                'footer_credit'     => __('Theme Options', 'porto'),

                'google_api_key' => 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII',
                'disable_google_fonts_link' => true,

                'async_typography'  => false,
                'admin_bar'         => false,
                'admin_bar_icon'       => 'dashicons-admin-generic',
                'admin_bar_priority'   => 50,
                'global_variable'   => '',
                'dev_mode'          => false,
                'customizer'        => false,
                'compiler'          => false,

                'page_priority'     => null,
                'page_parent'       => 'themes.php',
                'page_permissions'  => 'manage_options',
                'menu_icon'         => '',
                'last_tab'          => '',
                'page_icon'         => 'icon-themes',
                'page_slug'         => 'porto_settings',
                'save_defaults'     => true,
                'default_show'      => false,
                'default_mark'      => '',
                'show_import_export' => true,
                'show_options_object' => false,

                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => false,
                'output_tag'        => false,

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
                ),
                'ajax_save'                 => false,
                'use_cdn'                   => true,
            );


            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
            }
            $this->args['intro_text'] = sprintf('<p style="color: #0088cc">'.__('Please regenerate again default css files in <strong>Skin > Compile Default CSS</strong> after <strong>update theme</strong>.', 'porto').'</p>', $v);
        }

    }

    global $reduxPortoSettings;
    $reduxPortoSettings = new Redux_Framework_porto_settings();
}