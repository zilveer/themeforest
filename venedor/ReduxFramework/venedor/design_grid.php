<?php

/**
Venedor Design File
For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_venedor_design')) {

    class Redux_Framework_venedor_design {

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
                            <img src="<?php echo esc_url( $screenshot ); ?>" alt="<?php echo 'Current theme preview'; ?>" />
                        </a>
                    <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>" alt="<?php echo 'Current theme preview'; ?>" />
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
            // General Styles
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'title' => 'General',
                'fields' => array(
                    array(
                        'id'=>'use-animate-css',
                        'type' => 'switch',
                        'title' => 'Use Animate Styles',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'disable-mobile-animate',
                        'type' => 'switch',
                        'title' => 'Disable Animate Styles on Mobile',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'link-color',
                        'type' => 'link_color',
                        'show_active' => false,
                        'title' => 'Links Color',
                        'default' => array(
                            'regular' => '#a17e47',
                            'hover' => '#838383',
                        )
                    ),

                    array(
                        'id'=>'1',
                        'type' => 'info',
                        'desc' => 'General Buttons'
                    ),

                    array(
                        'id'=>'btn-font',
                        'type' => 'typography',
                        'title' => 'Button Font',
                        'google' => true,
                        'color' => false,
                        'font-size'=>false,
                        'default'=> array(
                            'font-weight'=>'400',
                            'font-family'=>'Arial, Helvetica, sans-serif'),
                    ),

                    array(
                        'id'=>'btn-text-transform',
                        'type' => 'select',
                        'title' => 'Text Transform',
                        'options' => array('none'=>'None', 'uppercase'=>'Uppercase', 'lowercase' => 'Lowercase', 'capitalize' => 'Capitalize'),
                        'default' => 'uppercase',
                    ),

                    array(
                        'id'=>'btn-border-radius',
                        'type' => 'spacing',
                        'mode' => 'absolute',
                        'all' => true,
                        'title' => 'Border Radius',
                        'default' => array('top' => 3, 'bottom' => 3, 'left'=>3, 'right'=>3)
                    ),

                    array(
                        'id'=>'btn-shadow',
                        'type' => 'switch',
                        'title' => 'Shadow Effect',
                        'default' => '1',
                        'on' => 'Enable',
                        'off' => 'Disable',
                    ),

                    array(
                        'id'=>'btn-text-color',
                        'type' => 'color',
                        'title' => 'Text Color',
                        'default' => '#e8e8e8',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'btn-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#48443f',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'btn-border',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Border',
                        'default' => array('color' => '#48443f', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'btn-hcolor',
                        'type' => 'color',
                        'title' => 'Hover Text Color #1',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'btn-hbg-color',
                        'type' => 'color',
                        'title' => 'Hover Background Color #1',
                        'default' => '#a17e47',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'btn-hborder',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Hover Border #1',
                        'default' => array('color' => '#a17e47', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'btn-shcolor',
                        'type' => 'color',
                        'title' => 'Hover Text Color #2',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'btn-sbg-color',
                        'type' => 'color',
                        'title' => 'Hover Background Color #2',
                        'default' => '#c0aa77',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'btn-sborder',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Hover Border #2',
                        'default' => array('color' => '#c0aa77', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => 'Toolbar, Slider, Pagination Buttons'
                    ),

                    array(
                        'id'=>'arrow-border-radius',
                        'type' => 'spacing',
                        'mode' => 'absolute',
                        'all' => true,
                        'title' => 'Border Radius',
                        'default' => array('top' => 3, 'bottom' => 3, 'left'=>3, 'right'=>3)
                    ),

                    array(
                        'id'=>'arrow-text-color',
                        'type' => 'color',
                        'title' => 'Text Color',
                        'default' => '#9f9f9f',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'arrow-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#fafafa',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'arrow-border',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Border',
                        'default' => array('color' => '#e0e0e0', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'arrow-hcolor',
                        'type' => 'color',
                        'title' => 'Hover Text Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'arrow-hbg-color',
                        'type' => 'color',
                        'title' => 'Hover Background Color',
                        'default' => '#a17e47',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'arrow-hborder',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Hover Border',
                        'default' => array('color' => '#a17e47', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'toolbar-btn-bg-color',
                        'type' => 'color',
                        'title' => 'Toolbar Button Background Color',
                        'default' => '#f2f2f2',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'3',
                        'type' => 'info',
                        'desc' => 'Input Box, Text Area, Select Box, etc'
                    ),

                    array(
                        'id'=>'input-text-color',
                        'type' => 'color',
                        'title' => 'Text Color',
                        'default' => '#a4a4a4',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'input-border-radius',
                        'type' => 'spacing',
                        'mode' => 'absolute',
                        'all' => true,
                        'title' => 'Border Radius',
                        'default' => array('top' => 3, 'bottom' => 3, 'left'=>3, 'right'=>3)
                    ),

                    array(
                        'id'=>'input-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'input-border',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Border',
                        'default' => array('color' => '#e0e0e0', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),
                )
            );

            // Body
            $this->sections[] = array(
                'icon' => 'el-icon-picture',
                'icon_class' => 'icon',
                'title' => 'Body',
                'fields' => array(
                    array(
                        'id'=>'body-font',
                        'type' => 'typography',
                        'title' => 'Body Font',
                        'google' => true,
                        'default'=> array(
                            'color'=>"#8f9290",
                            'font-weight'=>'400',
                            'font-family'=>'Arial, Helvetica, sans-serif',
                            'font-size'=>'15px'),
                    ),

                    array(
                        'id'=>'body-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'body-bg-mode',
                        'type' => 'select',
                        'title' => 'Background Mode',
                        'options' => array('texture'=>'Texture', 'image'=>'Image'),
                        'default' => '',
                    ),

                    array(
                        'id'=>'body-bg-texture',
                        'type' => 'image_select',
                        'tiles' => true,
                        'required' => array('body-bg-mode','equals','texture'),
                        'title' => 'Background Texture',
                        'default' => 0,
                        'options' => $venedor_patterns
                    ),

                    array(
                        'id'=>'body-bg-image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => 'Background Image',
                        'required' => array('body-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'body-bg-repeat',
                        'type' => 'select',
                        'title' => 'Background Repeat',
                        'options' => array('repeat'=>'Repeat', 'no-repeat'=>'No Repeat', 'repeat-x' => 'Repeat X', 'repeat-y' => 'Repeat Y'),
                        'default' => 'repeat',
                        'required' => array('body-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'body-bg-attachment',
                        'type' => 'select',
                        'title' => 'Background Attachment',
                        'options' => array('scroll'=>'Scroll', 'fixed'=>'Fixed'),
                        'default' => 'scroll',
                        'required' => array('body-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'body-bg-pos-x',
                        'type' => 'select',
                        'title' => 'Background Position X',
                        'options' => array('left'=>'Left', 'center'=>'Center', 'right'=>'Right'),
                        'default' => 'center',
                        'required' => array('body-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'body-bg-pos-y',
                        'type' => 'select',
                        'title' => 'Background Position Y',
                        'options' => array('top'=>'Top', 'center'=>'Center', 'bottom'=>'Bottom'),
                        'default' => 'top',
                        'required' => array('body-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => 'Theme Wrapper'
                    ),


                    array(
                        'id'=>'wrapper-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'wrapper-bg-mode',
                        'type' => 'select',
                        'title' => 'Background Mode',
                        'options' => array('texture'=>'Texture', 'image'=>'Image'),
                        'default' => '',
                    ),

                    array(
                        'id'=>'wrapper-bg-texture',
                        'type' => 'image_select',
                        'tiles' => true,
                        'required' => array('wrapper-bg-mode','equals','texture'),
                        'title' => 'Background Texture',
                        'default' => 0,
                        'options' => $venedor_patterns
                    ),

                    array(
                        'id'=>'wrapper-bg-image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => 'Background Image',
                        'required' => array('wrapper-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'wrapper-bg-repeat',
                        'type' => 'select',
                        'title' => 'Background Repeat',
                        'options' => array('repeat'=>'Repeat', 'no-repeat'=>'No Repeat', 'repeat-x' => 'Repeat X', 'repeat-y' => 'Repeat Y'),
                        'default' => 'repeat',
                        'required' => array('wrapper-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'wrapper-bg-attachment',
                        'type' => 'select',
                        'title' => 'Background Attachment',
                        'options' => array('scroll'=>'Scroll', 'fixed'=>'Fixed'),
                        'default' => 'scroll',
                        'required' => array('wrapper-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'wrapper-bg-pos-x',
                        'type' => 'select',
                        'title' => 'Background Position X',
                        'options' => array('left'=>'Left', 'center'=>'Center', 'right'=>'Right'),
                        'default' => 'center',
                        'required' => array('wrapper-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'wrapper-bg-pos-y',
                        'type' => 'select',
                        'title' => 'Background Position Y',
                        'options' => array('top'=>'Top', 'center'=>'Center', 'bottom'=>'Bottom'),
                        'default' => 'top',
                        'required' => array('wrapper-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'heading-font',
                        'type' => 'typography',
                        'title' => 'Heading Font',
                        'google' => true,
                        'font-size' => false,
                        'default'=> array(
                            'color'=>"#444645",
                            'font-weight'=>'400',
                            'font-family'=>'Oswald'),
                    ),

                    array(
                        'id'=>'heading-desc-font',
                        'type' => 'typography',
                        'title' => 'Heading Description Font',
                        'google' => true,
                        'font-size' => false,
                        'default'=> array(
                            'color'=>"#737373",
                            'font-weight'=>'400',
                            'font-family'=>'PT Sans'),
                    ),
                )
            );

            // Header Styles
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'icon_class' => 'icon',
                'title' => 'Header',
                'fields' => array(
                    array(
                        'id'=>'header-font',
                        'type' => 'typography',
                        'title' => 'Header Font',
                        'google' => true,
                        'default'=> array(
                            'color'=>"#868076",
                            'font-weight'=>'400',
                            'font-size'=>'14px',
                            'font-family'=>'Arial, Helvetica, sans-serif', ),
                    ),

                    array(
                        'id'=>'4',
                        'type' => 'info',
                        'desc' => 'Header on Banner'
                    ),

                    array(
                        'id'=>'header-on-banner-color',
                        'type' => 'color',
                        'title' => 'Default Color',
                        'desc' => 'Will be show all texts, mini cart and search form as this color.',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'4',
                        'type' => 'info',
                        'desc' => 'Header Top Styles'
                    ),

                    array(
                        'id'=>'header-top-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#f6f5f2',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'header-top-bg-mode',
                        'type' => 'select',
                        'title' => 'Background Mode',
                        'options' => array('texture'=>'Texture'),
                        'default' => '',
                    ),

                    array(
                        'id'=>'header-top-bg-texture',
                        'type' => 'image_select',
                        'tiles' => true,
                        'required' => array('header-top-bg-mode','equals','texture'),
                        'title' => 'Background Texture',
                        'default' => 0,
                        'options' => $venedor_patterns
                    ),

                    array(
                        'id'=>'header-top-border',
                        'type' => 'border',
                        'all' => false,
                        'title' => 'Border',
                        'default' => array('color' => '#c0aa77', 'style' => 'solid', 'left' => 0, 'right' => 0, 'top' => 3, 'bottom' => 0)
                    ),

                    array(
                        'id'=>'header-top-link-color',
                        'type' => 'link_color',
                        'show_active' => false,
                        'title' => 'Links Color',
                        'default' => array(
                            'regular' => '#868076',
                            'hover' => '#c0aa77',
                        )
                    ),

                    array(
                        'id'=>'header-top-icon-color',
                        'type' => 'link_color',
                        'show_active' => false,
                        'title' => 'Icon Color',
                        'default' => array(
                            'regular' => '#cfb985',
                            'hover' => '#c0aa77',
                        )
                    ),

                    array(
                        'id'=>'5',
                        'type' => 'info',
                        'desc' => 'Header Styles'
                    ),

                    array(
                        'id'=>'header-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'header-bg-mode',
                        'type' => 'select',
                        'title' => 'Background Mode',
                        'options' => array('texture'=>'Texture'),
                        'default' => '',
                    ),

                    array(
                        'id'=>'header-bg-texture',
                        'type' => 'image_select',
                        'tiles' => true,
                        'required' => array('header-bg-mode','equals','texture'),
                        'title' => 'Background Texture',
                        'default' => 0,
                        'options' => $venedor_patterns
                    ),

                    array(
                        'id'=>'header-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => 'Text Color',
                        'default' => array(
                            'regular' => '#868076',
                            'hover' => '#c0aa77',
                        )
                    ),

                    array(
                        'id'=>'header-padding',
                        'type' => 'spacing',
                        'mode' => 'padding',
                        'title' => 'Padding',
                        'default' => array('top' => 52, 'bottom' => 0, 'left' => 0, 'right' => 0)
                    ),

                    array(
                        'id'=>'header-logo-margin',
                        'type' => 'spacing',
                        'mode' => 'margin',
                        'title' => 'Logo Margin',
                        'default' => array('top' => -9, 'bottom' => 0, 'left' => 0, 'right' => 0)
                    ),

                    array(
                        'id'=>'header-shadow',
                        'type' => 'switch',
                        'title' => 'Header Shadow',
                        'default' => '0',
                        'on' => 'Enable',
                        'off' => 'Disable',
                    ),

                    array(
                        'id'=>'6',
                        'type' => 'info',
                        'desc' => 'View Switcher'
                    ),

                    array(
                        'id'=>'view-switcher-width',
                        'type' => 'text',
                        'title' => 'Switcher Width',
                        'default' => '92px'
                    ),

                    array(
                        'id'=>'view-switcher-customize',
                        'type' => 'switch',
                        'title' => 'Customize Switcher',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'view-switcher-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'required' => array('view-switcher-customize','=','1'),
                        'title' => 'Links Color',
                        'default' => array(
                            'regular' => '#ffffff',
                            'hover' => '#ffffff',
                        )),

                    array(
                        'id'=>'view-switcher-bg-color',
                        'type' => 'color',
                        'required' => array('view-switcher-customize','=','1'),
                        'title' => 'Background Color',
                        'default' => '#c0aa77'
                    ),

                    array(
                        'id'=>'view-switcher-hbg-color',
                        'type' => 'color',
                        'required' => array('view-switcher-customize','=','1'),
                        'title' => 'Hover Background Color',
                        'default' => '#c0aa77'
                    ),

                    array(
                        'id'=>'view-switcher-plink-color',
                        'type' => 'link_color',
                        'active' => false,
                        'required' => array('view-switcher-customize','=','1'),
                        'title' => 'Dropdown Links Color',
                        'default' => array(
                            'regular' => '#878177',
                            'hover' => '#ffffff',
                        )),

                    array(
                        'id'=>'view-switcher-pbg-color',
                        'type' => 'color',
                        'title' => 'Dropdown Background Color',
                        'default' => '#e9e3d6',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'view-switcher-phbg-color',
                        'type' => 'color',
                        'title' => 'Dropdown Hover Background Color',
                        'default' => '#c0aa77',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'6',
                        'type' => 'info',
                        'desc' => 'Mini Cart'
                    ),

                    array(
                        'id'=>'mini-cart-customize',
                        'type' => 'switch',
                        'title' => 'Customize Mini Cart',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'mini-cart-separate',
                        'type' => 'switch',
                        'required' => array('mini-cart-customize','=','1'),
                        'title' => 'Separate icon and items',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'mini-cart-text-color',
                        'type' => 'color',
                        'required' => array('mini-cart-customize','=','1'),
                        'title' => 'Text Color',
                        'default' => '#8d877c'
                    ),

                    array(
                        'id'=>'mini-cart-icon-color',
                        'type' => 'color',
                        'required' => array('mini-cart-customize','=','1'),
                        'title' => 'Cart Icon Color',
                        'default' => '#c0aa77'
                    ),

                    array(
                        'id'=>'mini-cart-bg-color',
                        'type' => 'color',
                        'required' => array('mini-cart-customize','=','1'),
                        'title' => 'Background Color',
                        'default' => '#ffffff'
                    ),

                    array(
                        'id'=>'mini-cart-border',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('mini-cart-customize','=','1'),
                        'title' => 'Border',
                        'default' => array('color' => '#e8e8e8', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'mini-cart-hcolor',
                        'type' => 'color',
                        'required' => array('mini-cart-customize','=','1'),
                        'title' => 'Hover Text Color',
                        'default' => '#ffffff'
                    ),

                    array(
                        'id'=>'mini-cart-hbg-color',
                        'type' => 'color',
                        'required' => array('mini-cart-customize','=','1'),
                        'title' => 'Hover Background Color',
                        'default' => '#c0aa77'
                    ),

                    array(
                        'id'=>'mini-cart-hborder',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('mini-cart-customize','=','1'),
                        'title' => 'Hover Border',
                        'default' => array('color' => '#c0aa77', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'mini-cart-popup-border',
                        'type' => 'border',
                        'all' => false,
                        'title' => 'Popup Border',
                        'default' => array('color' => '#c0aa77', 'style' => 'solid', 'left' => 0, 'right' => 0, 'top' => 3, 'bottom' => 0)
                    ),

                    array(
                        'id'=>'6',
                        'type' => 'info',
                        'desc' => 'Search Form'
                    ),

                    array(
                        'id'=>'search-form-customize',
                        'type' => 'switch',
                        'title' => 'Customize Search Form',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'search-form-textbox-color',
                        'type' => 'color',
                        'required' => array('search-form-customize','=','1'),
                        'title' => 'Textbox Color',
                        'default' => '#8d877c'
                    ),

                    array(
                        'id'=>'search-form-textbox-bg-color',
                        'type' => 'color',
                        'required' => array('search-form-customize','=','1'),
                        'title' => 'Textbox Background Color',
                        'default' => '#ffffff'
                    ),

                    array(
                        'id'=>'search-form-textbox-border',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('search-form-customize','=','1'),
                        'title' => 'Textbox Border',
                        'default' => array('color' => '#e8e8e8', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'search-form-btn-color',
                        'type' => 'color',
                        'required' => array('search-form-customize','=','1'),
                        'title' => 'Button Color',
                        'default' => '#c0aa77'
                    ),

                    array(
                        'id'=>'search-form-btn-bg-color',
                        'type' => 'color',
                        'required' => array('search-form-customize','=','1'),
                        'title' => 'Button Background Color',
                        'default' => '#ffffff'
                    ),

                    array(
                        'id'=>'search-form-btn-border',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('search-form-customize','=','1'),
                        'title' => 'Button Border',
                        'default' => array('color' => '#e8e8e8', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'search-form-btn-hcolor',
                        'type' => 'color',
                        'required' => array('search-form-customize','=','1'),
                        'title' => 'Button Hover Color',
                        'default' => '#ffffff'
                    ),

                    array(
                        'id'=>'search-form-btn-hbg-color',
                        'type' => 'color',
                        'required' => array('search-form-customize','=','1'),
                        'title' => 'Button Hover Background Color',
                        'default' => '#c0aa77'
                    ),

                    array(
                        'id'=>'search-form-btn-hborder',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('search-form-customize','=','1'),
                        'title' => 'Button Hover Border',
                        'default' => array('color' => '#c0aa77', 'style' => 'solid', 'left' => 0, 'right' => 0, 'top' => 0, 'bottom' => 0)
                    ),
                )
            );

            // Menu Styles
            $this->sections[] = array(
                'icon' => 'el-icon-th-large',
                'icon_class' => 'icon',
                'title' => 'Menu',
                'fields' => array(
                    array(
                        'id'=>'menu-font',
                        'type' => 'typography',
                        'title' => 'Menu Font',
                        'google' => true,
                        'color' => false,
                        'default'=> array(
                            'font-weight'=>'700',
                            'font-size'=>'17px',
                            'font-family'=>'PT Sans'),
                    ),

                    array(
                        'id'=>'menu-text-transform',
                        'type' => 'select',
                        'title' => 'Menu Text Transform',
                        'options' => array('none'=>'None', 'uppercase'=>'Uppercase', 'lowercase' => 'Lowercase', 'capitalize' => 'Capitalize'),
                        'default' => 'uppercase',
                    ),

                    array(
                        'id'=>'menu-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'menu-bg-mode',
                        'type' => 'select',
                        'title' => 'Background Mode',
                        'options' => array('texture'=>'Texture'),
                        'default' => '',
                    ),

                    array(
                        'id'=>'menu-bg-texture',
                        'type' => 'image_select',
                        'tiles' => true,
                        'required' => array('menu-bg-mode','equals','texture'),
                        'title' => 'Background Texture',
                        'default' => 0,
                        'options' => $venedor_patterns
                    ),

                    array(
                        'id'=>'menu-margin',
                        'type' => 'spacing',
                        'mode' => 'margin',
                        'title' => 'Menu Margin',
                        'default' => array('top' => 17, 'bottom' => 0, 'left' => 0, 'right' => 0)
                    ),

                    array(
                        'id'=>'menu-padding',
                        'type' => 'spacing',
                        'mode' => 'padding',
                        'title' => 'Menu Padding',
                        'default' => array('top' => 0, 'bottom' => 6, 'left' => 0, 'right' => 0)
                    ),

                    array(
                        'id'=>'menu-in-container',
                        'type' => 'switch',
                        'title' => 'Show Menu in Container',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'menu-border',
                        'type' => 'border',
                        'all' => false,
                        'title' => 'Menu Border',
                        'default' => array('color' => '#d1d5d6', 'style' => 'solid', 'left' => 0, 'right' => 0, 'top' => 0, 'bottom' => 0)
                    ),

                    array(
                        'id'=>'menu-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => 'Links Color',
                        'default' => array(
                            'regular' => '#504b3e',
                            'hover' => '#a17e47',
                        )
                    ),

                    array(
                        'id'=>'menu-link-bg-color',
                        'type' => 'color',
                        'title' => 'Link Background Color',
                        'default' => 'transparent',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'menu-link-hover-bg-color',
                        'type' => 'color',
                        'title' => 'Link Hover Background Color',
                        'default' => 'transparent',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'menu-main-arrow',
                        'type' => 'switch',
                        'title' => 'Menu Item Arrow in Level 1',
                        'desc' => 'If menu item have sub menus, can show/hide menu arrow.',
                        'default' => '0',
                        'on' => 'Show',
                        'off' => 'Hide',
                    ),

                    array(
                        'id'=>'menu-link-border',
                        'type' => 'switch',
                        'title' => 'Top Link Left/Right Border',
                        'default' => '0',
                        'on' => 'Show',
                        'off' => 'Hide',
                    ),

                    array(
                        'id'=>'menu-link-left-border-color',
                        'type' => 'text',
                        'required' => array('menu-link-border','equals','1'),
                        'title' => 'Left Border Color',
                        'default' => 'rgba(200, 200, 200, 0.2)'
                    ),

                    array(
                        'id'=>'menu-link-right-border-color',
                        'type' => 'text',
                        'required' => array('menu-link-border','equals','1'),
                        'title' => 'Right Border Color',
                        'default' => 'rgba(0, 0, 0, 0.4)'
                    ),

                    array(
                        'id'=>'7',
                        'type' => 'info',
                        'desc' => 'Sub Menu & Popup'
                    ),

                    array(
                        'id'=>'submenu-font',
                        'type' => 'typography',
                        'title' => 'Sub Menu Font',
                        'google' => true,
                        'color' => false,
                        'default'=> array(
                            'font-weight'=>'700',
                            'font-size'=>'16px',
                            'font-family'=>'Gudea'),
                    ),

                    array(
                        'id'=>'submenu-text-transform',
                        'type' => 'select',
                        'title' => 'Sub Menu Text Transform',
                        'options' => array('none'=>'None', 'uppercase'=>'Uppercase', 'lowercase' => 'Lowercase', 'capitalize' => 'Capitalize'),
                        'default' => 'uppercase',
                    ),

                    array(
                        'id'=>'submenu-border',
                        'type' => 'border',
                        'all' => false,
                        'title' => 'Border',
                        'default' => array('color' => '#c0aa77', 'style' => 'solid', 'left' => 0, 'right' => 0, 'top' => 3, 'bottom' => 0)
                    ),

                    array(
                        'id'=>'submenu-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'submenu-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => 'Links Color',
                        'default' => array(
                            'regular' => '#504b3e',
                            'hover' => '#b99b55',
                        )),

                    array(
                        'id'=>'submenu2-bg-color',
                        'type' => 'color',
                        'title' => 'Mobile Popup Level-2 BG Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'submenu3-bg-color',
                        'type' => 'color',
                        'title' => 'Mobile Popup Level-3 BG Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                )
            );

            // Breadcrumbs Styles
            $this->sections[] = array(
                'icon' => 'el-icon-minus',
                'icon_class' => 'icon',
                'title' => 'Breadcrumbs',
                'fields' => array(

                    array(
                        'id'=>'breadcrumbs-font',
                        'type' => 'typography',
                        'title' => 'Breadcrumbs Font',
                        'google' => true,
                        'color' => false,
                        'default'=> array(
                            'font-weight'=>'400',
                            'font-size'=>'13px',
                            'font-family'=>'Oswald'),
                    ),

                    array(
                        'id'=>'breadcrumbs-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => 'Links Color',
                        'default' => array(
                            'regular' => '#ffffff',
                            'hover' => '#eeeeee',
                        )
                    ),

                    array(
                        'id'=>'breadcrumbs-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#c0aa77',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'breadcrumbs-bg-mode',
                        'type' => 'select',
                        'title' => 'Background Mode',
                        'options' => array('texture'=>'Texture'),
                        'default' => '',
                    ),

                    array(
                        'id'=>'breadcrumbs-bg-texture',
                        'type' => 'image_select',
                        'tiles' => true,
                        'required' => array('breadcrumbs-bg-mode','equals','texture'),
                        'title' => 'Background Texture',
                        'default' => 0,
                        'options' => $venedor_patterns
                    ),

                    array(
                        'id'=>'breadcrumbs-border',
                        'type' => 'border',
                        'all' => false,
                        'title' => 'Border',
                        'default' => array('color' => '#d5d5d5', 'style' => 'solid', 'left' => 0, 'right' => 0, 'top' => 0, 'bottom' => 0)
                    ),
                )
            );

            // Footer Styles
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'icon_class' => 'icon',
                'title' => 'Footer',
                'fields' => array(
                    array(
                        'id'=>'8',
                        'type' => 'info',
                        'desc' => 'Content Bottom Widget Area'
                    ),

                    array(
                        'id'=>'content-bottom-padding-top',
                        'type' => 'text',
                        'title' => 'Padding Top',
                        'default' => '60px'
                    ),

                    array(
                        'id'=>'content-bottom-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#f8f6f0',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'content-bottom-bg-mode',
                        'type' => 'select',
                        'title' => 'Background Mode',
                        'options' => array('texture'=>'Texture'),
                        'default' => '',
                    ),

                    array(
                        'id'=>'content-bottom-bg-texture',
                        'type' => 'image_select',
                        'tiles' => true,
                        'required' => array('content-bottom-bg-mode','equals','texture'),
                        'title' => 'Background Texture',
                        'default' => 0,
                        'options' => $venedor_patterns
                    ),

                    array(
                        'id'=>'8',
                        'type' => 'info',
                        'desc' => 'Footer Top'
                    ),

                    array(
                        'id'=>'footer-top-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#f7efd9',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'footer-top-bg-mode',
                        'type' => 'select',
                        'title' => 'Background Mode',
                        'options' => array('texture'=>'Texture'),
                        'default' => '',
                    ),

                    array(
                        'id'=>'footer-top-bg-texture',
                        'type' => 'image_select',
                        'tiles' => true,
                        'required' => array('footer-top-bg-mode','equals','texture'),
                        'title' => 'Background Texture',
                        'default' => 0,
                        'options' => $venedor_patterns
                    ),

                    array(
                        'id'=>'footer-top-color',
                        'type' => 'color',
                        'title' => 'Text Color',
                        'default' => '#564d41'
                    ),

                    array(
                        'id'=>'footer-top-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => 'Links Color',
                        'default' => array(
                            'regular' => '#a17e47',
                            'hover' => '#b99b55',
                        )
                    ),

                    array(
                        'id'=>'footer-top-textbox-color',
                        'type' => 'color',
                        'title' => 'Textbox Color',
                        'default' => '#727b7c'
                    ),

                    array(
                        'id'=>'footer-top-textbox-bg-color',
                        'type' => 'color',
                        'title' => 'Textbox Background Color',
                        'default' => '#d6d6d6'
                    ),

                    array(
                        'id'=>'footer-top-textbox-border',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Textbox Border',
                        'default' => array('color' => '#ffe019', 'style' => 'solid', 'left' => 3, 'right' => 3, 'top' => 3, 'bottom' => 3)
                    ),

                    array(
                        'id'=>'footer-top-btn-color',
                        'type' => 'color',
                        'title' => 'Button Color',
                        'default' => '#564d41'
                    ),

                    array(
                        'id'=>'footer-top-btn-bg-color',
                        'type' => 'color',
                        'title' => 'Button Background Color',
                        'default' => '#f7efd9'
                    ),

                    array(
                        'id'=>'footer-top-btn-border',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Button Border',
                        'default' => array('color' => '#f7efd9', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'footer-top-btn-hcolor',
                        'type' => 'color',
                        'title' => 'Button Hover Color',
                        'default' => '#e8e8e8'
                    ),

                    array(
                        'id'=>'footer-top-btn-hbg-color',
                        'type' => 'color',
                        'title' => 'Button Hover Background Color',
                        'default' => '#444645'
                    ),

                    array(
                        'id'=>'footer-top-btn-hborder',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Button Hover Border',
                        'default' => array('color' => '#444645', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'8',
                        'type' => 'info',
                        'desc' => 'Footer'
                    ),

                    array(
                        'id'=>'footer-heading-font',
                        'type' => 'typography',
                        'title' => 'Footer Heading Font',
                        'google' => true,
                        'default'=> array(
                            'color'=>"#ffffff",
                            'font-weight'=>'400',
                            'font-size'=>'19px',
                            'font-family'=>'Oswald'),
                    ),

                    array(
                        'id'=>'footer-font',
                        'type' => 'typography',
                        'title' => 'Footer Font',
                        'google' => true,
                        'font-size' => false,
                        'default'=> array(
                            'color'=>"#e0ded4",
                            'font-weight'=>'400',
                            'font-size'=>'15px',
                            'font-family'=>'Gudea'),
                    ),

                    array(
                        'id'=>'footer-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#443e36',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'footer-bg-mode',
                        'type' => 'select',
                        'title' => 'Background Mode',
                        'options' => array('texture'=>'Texture'),
                        'default' => '',
                    ),

                    array(
                        'id'=>'footer-bg-texture',
                        'type' => 'image_select',
                        'tiles' => true,
                        'required' => array('footer-bg-mode','equals','texture'),
                        'title' => 'Background Texture',
                        'default' => 0,
                        'options' => $venedor_patterns
                    ),

                    array(
                        'id'=>'footer-widget-border',
                        'type' => 'border',
                        'all' => false,
                        'title' => 'Footer Border',
                        'default' => array('color' => '#383938', 'style' => 'solid', 'left' => 0, 'right' => 0, 'top' => 0, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'footer-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => 'Links Color',
                        'default' => array(
                            'regular' => '#e0ded4',
                            'hover' => '#c0aa77',
                        )
                    ),

                    array(
                        'id'=>'8',
                        'type' => 'info',
                        'desc' => 'Social Links & Copyright'
                    ),

                    array(
                        'id'=>'footer-bottom-border',
                        'type' => 'border',
                        'all' => false,
                        'title' => 'Border',
                        'default' => array('color' => '#534d46', 'style' => 'solid', 'left' => 0, 'right' => 0, 'top' => 1, 'bottom' => 0)
                    ),

                    array(
                        'id'=>'footer-bottom-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#443e36',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'footer-bottom-bg-mode',
                        'type' => 'select',
                        'title' => 'Background Mode',
                        'options' => array('texture'=>'Texture'),
                        'default' => '',
                    ),

                    array(
                        'id'=>'footer-bottom-bg-texture',
                        'type' => 'image_select',
                        'tiles' => true,
                        'required' => array('footer-bottom-bg-mode','equals','texture'),
                        'title' => 'Background Texture',
                        'default' => 0,
                        'options' => $venedor_patterns
                    ),

                    array(
                        'id'=>'footer-bottom-text-color',
                        'type' => 'color',
                        'title' => 'Text Color',
                        'default' => '#c2bcae',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'footer-bottom-link-color',
                        'type' => 'link_color',
                        'active' => false,
                        'title' => 'Links Color',
                        'default' => array(
                            'regular' => '#c2bcae',
                            'hover' => '#c0aa77',
                        )
                    ),

                    array(
                        'id'=>'footer-social-color',
                        'type' => 'color',
                        'title' => 'Social Link Color',
                        'default' => '#fafafa',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'footer-social-bg-color',
                        'type' => 'color',
                        'title' => 'Social Link BG Color',
                        'default' => '#626664',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'footer-social-border',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Social Link Border',
                        'default' => array('color' => '#626664', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),
                )
            );

            // Block, Sidebar, Table, Form Styles
            $this->sections[] = array(
                'icon' => 'el-icon-check-empty',
                'icon_class' => 'icon',
                'title' => 'Block, Sidebar, Table, Form',
                'fields' => array(
                    array(
                        'id'=>'table-heading-font',
                        'type' => 'typography',
                        'title' => 'Table Heading Font',
                        'google' => true,
                        'font-size'=>false,
                        'font-weight'=>false,
                        'default'=> array(
                            'color'=>"#565656",
                            'font-family'=>'Gudea'),
                    ),

                    array(
                        'id'=>'sidebar-font',
                        'type' => 'typography',
                        'title' => 'Sidebar Font',
                        'google' => true,
                        'default'=> array(
                            'color'=>"#737373",
                            'font-weight'=>'400',
                            'font-size'=>'15px',
                            'font-family'=>'Gudea'),
                    ),

                    array(
                        'id'=>'block-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#f7f7f7',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'block-border',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Border',
                        'default' => array('color' => '#dcdcdc', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'block-border-radius',
                        'type' => 'spacing',
                        'mode' => 'absolute',
                        'all' => true,
                        'title' => 'Border Radius',
                        'default' => array('top' => 3, 'bottom' => 3, 'left' => 3, 'right' => 3)
                    ),

                    array(
                        'id'=>'sidebar-style',
                        'type' => 'button_set',
                        'title' => 'Sidebar Style',
                        'options' => array('background' => 'Customize','' => 'Default'),
                        'default' => ''
                    ),

                    array(
                        'id'=>'sidebar-heading1-bg-color',
                        'type' => 'color',
                        'required' => array('sidebar-style','equals','background'),
                        'title' => 'Sidebar Heading #1 BG Color',
                        'default' => '#a17e47'
                    ),

                    array(
                        'id'=>'sidebar-heading1-text-color',
                        'type' => 'color',
                        'required' => array('sidebar-style','equals','background'),
                        'title' => 'Sidebar Heading #1 Text Color',
                        'default' => '#ffffff'
                    ),

                    array(
                        'id'=>'sidebar-heading2-bg-color',
                        'type' => 'color',
                        'required' => array('sidebar-style','equals','background'),
                        'title' => 'Sidebar Heading #2 BG Color',
                        'default' => '#c0aa77'
                    ),

                    array(
                        'id'=>'sidebar-heading2-text-color',
                        'type' => 'color',
                        'required' => array('sidebar-style','equals','background'),
                        'title' => 'Sidebar Heading #2 Text Color',
                        'default' => '#ffffff'
                    ),

                    array(
                        'id'=>'sidebar-content-bg-color',
                        'type' => 'color',
                        'required' => array('sidebar-style','equals','background'),
                        'title' => 'Sidebar Content BG Color',
                        'default' => '#ffffff'
                    ),

                    array(
                        'id'=>'sidebar-scroll',
                        'type' => 'switch',
                        'title' => 'Sidebar Scroll Effect',
                        'default' => '1',
                        'on' => 'Enable',
                        'off' => 'Disable',
                    ),

                    array(
                        'id'=>'block-title-color',
                        'type' => 'color',
                        'title' => 'Block, Table Heading Color',
                        'default' => '#565656',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'block-title-bg-color',
                        'type' => 'color',
                        'title' => 'Block, Table Heading BG Color',
                        'default' => '#f4f4f4',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'filter-title-color',
                        'type' => 'color',
                        'title' => 'Product Filter Heading Color',
                        'default' => '#777777',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'filter-text-color',
                        'type' => 'color',
                        'title' => 'Product Filter Text Color',
                        'default' => '#888888',
                        'validate' => 'color',
                    ),
                )
            );

            // Testimonial Styles
            $this->sections[] = array(
                'icon' => 'el-icon-quotes',
                'icon_class' => 'icon',
                'title' => 'Testimonial',
                'fields' => array(
                    array(
                        'id'=>'testimonial-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#f6f6f6',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'testimonial-border-color',
                        'type' => 'color',
                        'title' => 'Border Color',
                        'default' => '#dcdcdc',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'testimonial-arrow',
                        'type' => 'media',
                        'url'=> true,
                        'title' => 'Arrow Image',
                        'compiler' => 'true',
                        'default' => array(
                            'url' => get_template_directory_uri() . '/images/testimonial-arrow.png',
                        )),

                    array(
                        'id'=>'testimonial-title-color',
                        'type' => 'color',
                        'title' => 'Title Color',
                        'default' => '#757978',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'testimonial-text-color',
                        'type' => 'color',
                        'title' => 'Text Color',
                        'default' => '#8f9290',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'testimonial-quote-color',
                        'type' => 'color',
                        'title' => 'Quote Mark Color',
                        'default' => '#d8d7d7',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'testimonial-name-color',
                        'type' => 'color',
                        'title' => 'Name Color',
                        'default' => '#a17e47',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'testimonial-link-color',
                        'type' => 'color',
                        'title' => 'Link Color',
                        'default' => '#757978',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'testimonial-date-color',
                        'type' => 'color',
                        'title' => 'Date Color',
                        'default' => '#bdbdbd',
                        'validate' => 'color',
                    ),
                )
            );

            // Banner
            $this->sections[] = array(
                'icon' => 'el-icon-picture',
                'icon_class' => 'icon',
                'title' => 'Banner',
                'fields' => array(

                    array(
                        'id'=>'banner-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#f2f2f2',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'banner-bg-mode',
                        'type' => 'select',
                        'title' => 'Background Mode',
                        'options' => array('texture'=>'Texture', 'image'=>'Image'),
                        'default' => '',
                    ),

                    array(
                        'id'=>'banner-bg-texture',
                        'type' => 'image_select',
                        'tiles' => true,
                        'required' => array('banner-bg-mode','equals','texture'),
                        'title' => 'Background Texture',
                        'default' => 0,
                        'options' => $venedor_patterns
                    ),

                    array(
                        'id'=>'banner-bg-image',
                        'type' => 'media',
                        'url'=> true,
                        'title' => 'Background Image',
                        'required' => array('banner-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'banner-bg-repeat',
                        'type' => 'select',
                        'title' => 'Background Repeat',
                        'options' => array('repeat'=>'Repeat', 'no-repeat'=>'No Repeat', 'repeat-x' => 'Repeat X', 'repeat-y' => 'Repeat Y'),
                        'default' => 'repeat',
                        'required' => array('banner-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'banner-bg-attachment',
                        'type' => 'select',
                        'title' => 'Background Attachment',
                        'options' => array('scroll'=>'Scroll', 'fixed'=>'Fixed'),
                        'default' => 'scroll',
                        'required' => array('banner-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'banner-bg-pos-x',
                        'type' => 'select',
                        'title' => 'Background Position X',
                        'options' => array('left'=>'Left', 'center'=>'Center', 'right'=>'Right'),
                        'default' => 'center',
                        'required' => array('banner-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'banner-bg-pos-y',
                        'type' => 'select',
                        'title' => 'Background Position Y',
                        'options' => array('top'=>'Top', 'center'=>'Center', 'bottom'=>'Bottom'),
                        'default' => 'top',
                        'required' => array('banner-bg-mode','equals','image'),
                    ),

                    array(
                        'id'=>'banner-text-color',
                        'type' => 'color',
                        'title' => 'Text Color',
                        'default' => '#585858',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'banner-border-top',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Border Top',
                        'default' => array('color' => '#d5d5d5', 'style' => 'solid', 'left' => 0, 'right' => 0, 'top' => 0, 'bottom' => 0)
                    ),

                    array(
                        'id'=>'banner-border-bottom',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Border Bottom',
                        'default' => array('color' => '#d5d5d5', 'style' => 'solid', 'left' => 0, 'right' => 0, 'top' => 0, 'bottom' => 0)
                    ),

                    array(
                        'id'=>'6',
                        'type' => 'info',
                        'desc' => 'Banner Arrow Button'
                    ),

                    array(
                        'id'=>'banner-nav-customize',
                        'type' => 'switch',
                        'title' => 'Customize Banner Arrow Button',
                        'default' => '1',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'banner-nav-color',
                        'type' => 'color',
                        'required' => array('banner-nav-customize','=','1'),
                        'title' => 'Text Color',
                        'default' => '#a3a3a3'
                    ),

                    array(
                        'id'=>'banner-nav-bg-color',
                        'type' => 'color',
                        'required' => array('banner-nav-customize','=','1'),
                        'title' => 'Background Color',
                        'default' => '#fafafa'
                    ),

                    array(
                        'id'=>'banner-nav-border',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('banner-nav-customize','=','1'),
                        'title' => 'Border',
                        'default' => array('color' => '#e0e0e0', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'banner-nav-border-radius',
                        'type' => 'spacing',
                        'mode' => 'absolute',
                        'all' => true,
                        'required' => array('banner-nav-customize','=','1'),
                        'title' => 'Arrow Border Radius',
                        'default' => array('top' => 3, 'bottom' => 3, 'left'=>3, 'right'=>3)
                    ),

                    array(
                        'id'=>'banner-nav-hcolor',
                        'type' => 'color',
                        'required' => array('banner-nav-customize','=','1'),
                        'title' => 'Hover Text Color',
                        'default' => '#ffffff'
                    ),

                    array(
                        'id'=>'banner-nav-hbg-color',
                        'type' => 'color',
                        'required' => array('banner-nav-customize','=','1'),
                        'title' => 'Hover Background Color',
                        'default' => '#c0aa77'
                    ),

                    array(
                        'id'=>'banner-nav-hborder',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('banner-nav-customize','=','1'),
                        'title' => 'Hover Border',
                        'default' => array('color' => '#c0aa77', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'banner-bullet-bg-color',
                        'type' => 'color',
                        'required' => array('banner-nav-customize','=','1'),
                        'title' => 'Pagination Background Color',
                        'default' => '#fafafa'
                    ),

                    array(
                        'id'=>'banner-bullet-border',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('banner-nav-customize','=','1'),
                        'title' => 'Pagination Border',
                        'default' => array('color' => 'transparent', 'style' => 'solid', 'left' => 0, 'right' => 0, 'top' => 0, 'bottom' => 0)
                    ),

                    array(
                        'id'=>'banner-bullet-hbg-color',
                        'type' => 'color',
                        'required' => array('banner-nav-customize','=','1'),
                        'title' => 'Pagination Hover Background Color',
                        'default' => '#c0aa77'
                    ),

                    array(
                        'id'=>'banner-bullet-hborder',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('banner-nav-customize','=','1'),
                        'title' => 'Pagination Hover Border',
                        'default' => array('color' => 'transparent', 'style' => 'solid', 'left' => 0, 'right' => 0, 'top' => 0, 'bottom' => 0)
                    ),
                )
            );

            // Category Styles
            $this->sections[] = array(
                'icon' => 'el-icon-briefcase',
                'icon_class' => 'icon',
                'title' => 'Shop & Category (Woocommerce)',
                'fields' => array(

                    array(
                        'id'=>'9',
                        'type' => 'info',
                        'desc' => 'Category Item'
                    ),

                    array(
                        'id'=>'category-item-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'category-item-border',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Border',
                        'default' => array('color' => 'transparent', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'category-hitem-bg-color',
                        'type' => 'color',
                        'title' => 'Hover Background Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'category-hitem-border',
                        'type' => 'border',
                        'all' => true,
                        'title' => 'Hover Border',
                        'default' => array('color' => '#e8e8e8', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),
                )
            );

            // Product Styles
            $this->sections[] = array(
                'icon' => 'el-icon-gift',
                'icon_class' => 'icon',
                'title' => 'Product (Woocommerce)',
                'fields' => array(
                    array(
                        'id'=>'product-name-font',
                        'type' => 'typography',
                        'title' => 'Product Name Font',
                        'google' => true,
                        'font-size' => false,
                        'font-weight' => false,
                        'default'=> array(
                            'color'=>"#737373",
                            'font-family'=>'PT Sans'),
                    ),

                    array(
                        'id'=>'product-rating-star-color',
                        'type' => 'color',
                        'title' => 'Rating Star Color',
                        'default' => '#edc567',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'product-rating-color',
                        'type' => 'color',
                        'title' => 'Rating Text Color',
                        'default' => '#bdbdbd',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'10',
                        'type' => 'info',
                        'desc' => 'Price'
                    ),

                    array(
                        'id'=>'product-price-font',
                        'type' => 'typography',
                        'title' => 'Product Price Font',
                        'google' => true,
                        'color' => false,
                        'font-size' => false,
                        'default'=> array(
                            'font-weight'=>'700',
                            'font-family'=>'Gudea'),
                    ),

                    array(
                        'id'=>'product-price-color',
                        'type' => 'color',
                        'title' => 'Price Color',
                        'default' => '#b93524',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'product-oprice-color',
                        'type' => 'color',
                        'title' => 'Old Price Color',
                        'default' => '#626564',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'product-sprice-color',
                        'type' => 'color',
                        'title' => 'Special Price Color',
                        'desc' => 'will be use in the price box on the product image',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'product-price-bg-color',
                        'type' => 'color',
                        'title' => 'Background Color',
                        'default' => '#c0aa77',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'10',
                        'type' => 'info',
                        'desc' => '"Hot", "Sale" Labels'
                    ),

                    array(
                        'id'=>'product-sales-font',
                        'type' => 'typography',
                        'title' => '"Hot", "Sale" Label Font',
                        'google' => true,
                        'font-size' => false,
                        'default'=> array(
                            'color'=>"#fff",
                            'font-weight'=>'700',
                            'font-family'=>'PT Sans'),
                    ),

                    array(
                        'id'=>'product-hot-color',
                        'type' => 'color',
                        'title' => '"Hot" Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'product-hot-bg-color',
                        'type' => 'color',
                        'title' => '"Hot" Background Color',
                        'default' => '#a17e47',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'product-sale-color',
                        'type' => 'color',
                        'title' => '"Sale" Color',
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'product-sale-bg-color',
                        'type' => 'color',
                        'title' => '"Sale" Background Color',
                        'default' => '#b93524',
                        'validate' => 'color',
                    ),

                    array(
                        'id'=>'6',
                        'type' => 'info',
                        'desc' => 'Add to Cart Button'
                    ),

                    array(
                        'id'=>'addcart-customize',
                        'type' => 'switch',
                        'title' => 'Customize Add to Cart Button',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'addcart-color',
                        'type' => 'color',
                        'required' => array('addcart-customize','=','1'),
                        'title' => 'Text Color',
                        'default' => '#e8e8e8'
                    ),

                    array(
                        'id'=>'addcart-bg-color',
                        'type' => 'color',
                        'required' => array('addcart-customize','=','1'),
                        'title' => 'Background Color',
                        'default' => '#48443f'
                    ),

                    array(
                        'id'=>'addcart-border',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('addcart-customize','=','1'),
                        'title' => 'Border',
                        'default' => array('color' => '#48443f', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'addcart-hcolor',
                        'type' => 'color',
                        'required' => array('addcart-customize','=','1'),
                        'title' => 'Hover Text Color',
                        'default' => '#ffffff'
                    ),

                    array(
                        'id'=>'addcart-hbg-color',
                        'type' => 'color',
                        'required' => array('addcart-customize','=','1'),
                        'title' => 'Hover Background Color',
                        'default' => '#a17e47'
                    ),

                    array(
                        'id'=>'addcart-hborder',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('addcart-customize','=','1'),
                        'title' => 'Hover Border',
                        'default' => array('color' => '#a17e47', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'6',
                        'type' => 'info',
                        'desc' => 'Add to Wishlist, Compare Button'
                    ),

                    array(
                        'id'=>'addto-customize',
                        'type' => 'switch',
                        'title' => 'Customize Add to Wishlist, Compare Button',
                        'default' => '0',
                        'on' => 'Yes',
                        'off' => 'No',
                    ),

                    array(
                        'id'=>'addto-color',
                        'type' => 'color',
                        'required' => array('addto-customize','=','1'),
                        'title' => 'Text Color',
                        'default' => '#ffffff'
                    ),

                    array(
                        'id'=>'addto-bg-color',
                        'type' => 'color',
                        'required' => array('addto-customize','=','1'),
                        'title' => 'Background Color',
                        'default' => '#a17e47'
                    ),

                    array(
                        'id'=>'addto-border',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('addto-customize','=','1'),
                        'title' => 'Border',
                        'default' => array('color' => '#a17e47', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),

                    array(
                        'id'=>'addto-hcolor',
                        'type' => 'color',
                        'required' => array('addto-customize','=','1'),
                        'title' => 'Hover Text Color',
                        'default' => '#e8e8e8'
                    ),

                    array(
                        'id'=>'addto-hbg-color',
                        'type' => 'color',
                        'required' => array('addto-customize','=','1'),
                        'title' => 'Hover Background Color',
                        'default' => '#48443f'
                    ),

                    array(
                        'id'=>'addto-hborder',
                        'type' => 'border',
                        'all' => true,
                        'required' => array('addto-customize','=','1'),
                        'title' => 'Hover Border',
                        'default' => array('color' => '#48443f', 'style' => 'solid', 'left' => 1, 'right' => 1, 'top' => 1, 'bottom' => 1)
                    ),
                )
            );

            // Custom CSS Code Settings
            $this->sections[] = array(
                'icon' => 'el-icon-eye-open',
                'icon_class' => 'icon',
                'title' => 'Custom CSS',
                'fields' => array(
                    array(
                        'id'=>'css-code',
                        'type' => 'ace_editor',
                        'title' => 'CSS Code',
                        'subtitle' => 'Paste your CSS code here.',
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'desc' => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        'default' => ""
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
                'opt_name'          => 'venedor_design',
                'display_name'      => $theme->get('Name') . ' ' . 'Design',
                'display_version'   => $theme->get('Version'),
                'menu_type'         => 'menu',
                'allow_sub_menu'    => true,
                'menu_title'        => 'Theme Design',
                'page_title'        => 'Theme Design',

                'google_api_key' => 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII',

                'async_typography'  => false,
                'admin_bar'         => true,
                'global_variable'   => '',
                'dev_mode'          => false,
                'ajax_save'        => false,

                'page_priority'     => null,
                'page_parent'       => 'themes.php',
                'page_permissions'  => 'manage_options',
                'menu_icon'         => 'dashicons-admin-appearance',
                'last_tab'          => '',
                'page_icon'         => 'icon-themes',
                'page_slug'         => 'venedor_design',
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

    global $reduxVenedorDesign;
    $reduxVenedorDesign = new Redux_Framework_venedor_design();
}