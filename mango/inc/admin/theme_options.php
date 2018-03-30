<?php
/**
 * mango Settings File
 * For full documentation, please visit: https://docs.reduxframework.com
 * */

if ( !class_exists ( 'Redux_Framework_mango_settings' ) ) {
    class Redux_Framework_mango_settings {
        public $args = array ();
        public $sections = array ();
        public $theme;
        public $ReduxFramework;
        public function __construct () {
            if ( !class_exists ( 'ReduxFramework' ) ) {
                return;
            }
            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme ( __FILE__ ) ) {
                $this->initSettings ();
            } else {
                add_action ( 'plugins_loaded', array ( $this, 'initSettings' ), 10 );
            }
        }

        public function initSettings () {
            $this->theme = wp_get_theme ();
            // Set the default arguments
            $this->setArguments ();
            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs ();
            // Create the sections and fields
            $this->setSections ();
            if ( !isset( $this->args[ 'opt_name' ] ) ) { // No errors please
                return;
            }
            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }

        function compiler_action ( $options, $css, $changed_values ) {
        }

        function dynamic_section ( $sections ) {
            return $sections;
        }

        function change_arguments ( $args ) {
            return $args;
        }

        function change_defaults ( $defaults ) {
            return $defaults;
        }



        function remove_demo () {
        }

        public function setSections () {
            ob_start ();
            $ct = wp_get_theme ();
            $this->theme = $ct;
            $item_name = $this->theme->get ( 'Name' );
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot ();
            $class = $screenshot ? 'has-screenshot' : '';
            $customize_title = sprintf ( __ ( 'Customize &#8220;%s&#8221;', 'mango' ), $this->theme->display ( 'Name' ) );
            ?>
            <div id="current-theme" class="<?php echo esc_attr ( $class ); ?>">
                <?php if ( $screenshot ) : ?>
                    <?php if ( current_user_can ( 'edit_theme_options' ) ) : ?>
                        <a href="<?php echo wp_customize_url (); ?>" class="load-customize hide-if-no-customize"
                           title="<?php echo esc_attr ( $customize_title ); ?>">
                            <img src="<?php echo esc_url ( $screenshot ); ?>"
                                 alt="<?php esc_attr_e ( 'Current theme preview', 'mango' ); ?>"/>
                        </a>
                    <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url ( $screenshot ); ?>"
                         alt="<?php esc_attr_e ( 'Current theme preview', 'mango' ); ?>"/>
                <?php endif; ?>
                <h4><?php echo $this->theme->display ( 'Name' ); ?></h4>
                <div>
                    <ul class="theme-info">
                        <li><?php printf ( __ ( 'By %s', 'mango' ), $this->theme->display ( 'Author' ) ); ?></li>
                        <li><?php printf ( __ ( 'Version %s', 'mango' ), $this->theme->display ( 'Version' ) ); ?></li>
                        <li><?php echo '<strong>' . __ ( 'Tags', 'mango' ) . ':</strong> '; ?><?php printf ( $this->theme->display ( 'Tags' ) ); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display ( 'Description' ); ?></p>
                    <?php
                    if ( $this->theme->parent () ) { 
                        printf ( ' <p class="howto">' . __ ( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.','mango' ) . '</p>', __ ( 'http://codex.wordpress.org/Child_Themes', 'mango' ), $this->theme->parent ()->display ( 'Name' ) );
                    }
                    ?>
                </div>
            </div>
            <?php
            $item_info = ob_get_contents ();
            ob_end_clean ();
            $sampleHTML = '';
            if ( file_exists ( mango_inc . '/admin/info-html.html' ) ) {
                /** @global WP_Filesystem_Direct $wp_filesystem */
                global $wp_filesystem;
                if ( empty( $wp_filesystem ) ) {
                    require_once ( ABSPATH . '/wp-admin/includes/file.php' );
                    WP_Filesystem ();
                }
                $sampleHTML = $wp_filesystem->get_contents ( mango_inc . '/admin/info-html.html' );
            }
            $mango_font_awsome_list = mango_font_awesome_list ();
            $wp_registered_sidebars = wp_get_sidebars_widgets ();
            $mango_sidebar=array ();  
            foreach ( $wp_registered_sidebars as $sidebar => $sidebar_info ) {
                if ( $sidebar == 'wp_inactive_widgets' ) continue;
                $mango_sidebar[ $sidebar ] = ucwords ( str_replace ( array ( '_', '-' ), ' ', $sidebar ) );
            }
            // Skin tahir
            $this->sections[] = array (
                'icon' => 'el-icon-broom',
                'icon_class' => 'icon',
                'title' => __ ( 'Skin Options', 'mango' ),
                'fields' => array (
                    array (
                        'id' => 'mango_compile_css',
                        'type' => 'switch',
                        'title' => __ ( 'Compile Css', 'mango' ),
                        'compiler' => true,
                        'desc'=> __('Switch to "Yes" to generate a css file for skin options.','mango'),
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_body_typography',
                        'type' => 'typography',
                        'title' => __ ( 'Body Fonts', 'mango' ),
                        'google' => true,
                    //    'font-size' => false,
                        'subsets' => false,
                    //    'line-height' => false,
                        'font-backup' => true,
                        'text-align' => false,
                        'default' => array (
                            'color' => '#808080',
                        )
                    ),
                    array (
                        'id' => 'mango_site_color',
                        'type' => 'color',
                        'title' => __ ( 'Theme Main Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'mango_site_alternate_color',
                        'type' => 'color',
                        'title' => __ ( 'Theme Alternate Color', 'mango' ),
                        'default' => '#000000',
                        'validate' => 'color',
                    ),
                    array(
                        'id'       => 'css_editor',
                        'type'     => 'ace_editor',
                        'title'    => __('Custom CSS', 'mango'),
                        'subtitle' => __('Add Your Custom Css code here.', 'mango'),
                        'mode'     => 'css',
                        'theme'    => 'monokai',
                    )
                )

            );
            //body page tahir done
            $this->sections[] = array (
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __ ( 'Body, Page', 'mango' ),
                'fields' => array (
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'title' => __ ( 'Body', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_container_size',
                        'type' => 'button_set',
                        'title' => __('Use Full Width Body Size','mango'),
                        'options' => array (
                            'yes' => __ ( 'Yes', 'mango' ),
                            'no' => __ ( "No", "mango" ),
                        ),
                        'default' => 'no'
                    ),
                    array (
                        'id' => 'mango_theme_wrapper',
                        'type' => 'button_set',
                        'title' => __ ( 'Theme Layout', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                            'wide' => __ ( 'Wide', 'mango' ),
                            'boxed' => __ ( "Boxed", "mango" ),
                            'boxed-long' => __ ( "Boxed From Sides", "mango" ),
                        ),
                       'default' => 'wide'
                    ),
                    array (
                        'id' => 'mango_bg_mode',
                        'type' => 'button_set',
                        'title' => __ ( 'Background Mode', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                            'image' => __ ( "Image", "mango" ),
                            'custom-image' => __ ( "Custom Image", "mango" ),
                        ),
                        'default' => 'image',
                        'required' => array ( "mango_theme_wrapper", "!=", "wide" ),
                    ),
                    array (
                        'id' => 'mango_bg_select',
                        'type' => 'image_select',
                        'title' => __ ( 'Select Image', 'mango' ),
                        'compiler' => true,
                        'tiles' => true,
                        'options' => array (
                            mango_uri . '/images/bg-images/bg.jpg',
                            mango_uri . '/images/bg-images/bg1.jpg',
                            mango_uri . '/images/bg-images/bg2.jpg'
                        ),
                        'default' => mango_uri . '/images/bg-images/bg.jpg',
                        'required' => array ( "mango_bg_mode", "=", "image" ),
                    ),
                    array (
                        'id' => 'mango_bg_custom_select',
                        'type' => 'background',
                        'title' => __ ( 'Select Background', 'mango' ),
                        'background-position' => false,
                        'transparent' => false,
                        'preview_media' => true,
                        'background-color' => false,
                        'background-size' => false,
                        'background-attachment' => false,
                        'background-repeat' => false,
                        'compiler' => true,
                       'required' => array ( "mango_bg_mode", "=", "custom-image" ),
                    ),
                    array (
                        'id' => 'mango_bg_color',
                        'type' => 'color',
                        'title' => __ ( 'Background Color', 'mango' ),
                        'compiler' => true,
                        'required' => array ( "mango_theme_wrapper", "!=", "wide" ),
                    ),
                    array (
                        'id' => 'mango_bg_repeat',
                        'type' => 'select',
                        'title' => __ ( 'Background Repeat', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                            'no-repeat' => __ ( "No Repeat", "mango" ),
                            'repeat' => __ ( "Repeat All", "mango" ),
                            'repeat-x' => __ ( "Repeat Horizontally", "mango" ),
                            'repeat-y' => __ ( "Repeat Vertically", "mango" ),
                            'inherit' => __ ( "Inherit", "mango" ),
                        ),
                        'placeholder' => __ ( 'Background Repeat', 'mango' ),
                        'required' => array ( "mango_theme_wrapper", "!=", "wide" ),
                    ),
                    array (
                        'id' => 'mango_bg_position',
                        'type' => 'select',
                        'title' => __ ( 'Background Position', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                            "left top" => __ ( "Left Top", 'mango' ),
                            "left center" => __ ( "Left center", 'mango' ),
                            "left bottom" => __ ( "Left Bottom", 'mango' ),
                            "center top" => __ ( "Center Top", 'mango' ),
                            "center center" => __ ( "Center Center", 'mango' ),
                            "center bottom" => __ ( "Center Bottom", 'mango' ),
                            "right top" => __ ( "Right Top", 'mango' ),
                            "right center" => __ ( "Right center", 'mango' ),
                            "right bottom" => __ ( "Right Bottom", 'mango' ),
                        ),
                        'select2' => array ( 'allowClear' => false ),
                        'placeholder' => __ ( 'Background Position', 'mango' ),
                        'required' => array ( "mango_theme_wrapper", "!=", "wide" ),
                    ),
                    array (
                        'id' => 'mango_bg_size',
                        'type' => 'select',
                        'title' => __ ( 'Background Size', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                             "cover" => __ ( "Cover", 'mango' ),
                            "inherit" => __ ( "Inherit", 'mango' ),
                            "contain" => __ ( "Contain", 'mango' ),
                        ),
                        'placeholder' => __ ( 'Background Size', 'mango' ),
                        'required' => array ( "mango_theme_wrapper", "!=", "wide" ),
                    ),
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'title' => __ ( 'Page', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_content_background',
                        'type' => 'background',
                        'title' => __ ( 'Page Background', 'mango' ),
                        'preview_media' => true,
                        'default' => array (
                            'background-color' => '#FFFFFF',
                        )
                    )
                )
            );
            //header sajad
            $this->sections[] = array (
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __ ( 'Header', 'mango' ),
                'fields' => array (
                    array (
                        'id' => 'mango_customize_header',
                       'type' => 'switch',
                        'title' => __('Customize Headers','mango'),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                        'desc' => __("Switch to 'Yes' if you want to customize header",'mango')
                    ),
                    array (
                        'id' => '2',
                        'type' => 'info',
                        'desc' => __ ( 'Headers  1 , 2 , 3 , 4 , 5 , 10 , 12 , 13 , 14 , 15 , 18 , 20 setting', 'mango' ),
                       // 'required' => array ( 'mango_customize_header', '=', '1' )
                    ),
                    array (
                        'id' => 'header_background_light',
                        'type' => 'background',
                        'title' => __ ( 'Select Background', 'mango' ),
                        'compiler' => true,
                        'preview_media' => true,
                    ),
                    array (
                        'id' => 'header_text_light',
                        'type' => 'color',
                        'title' => __ ( 'Text Color', 'mango' ),
                        'default' => '#747474',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_hover_light',
                        'type' => 'color',
                        'title' => __ ( 'Hover Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_box_light',
                        'type' => 'color',
                        'title' => __ ( 'Box Color ', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
                    array (
                       'id' => '3',
                        'type' => 'info',
                       'desc' => __ ( 'Headers 6 & 7 setting', 'mango' ),
                    ),
                    array (
                        'id' => 'header_background_dark',
                        'type' => 'background',
                        'title' => __ ( 'Select Top Background', 'mango' ),
                        'compiler' => true,
                       'preview_media' => true,
                    ),
                    array (
                        'id' => 'header_background_dark_bottom',
                        'type' => 'background',
                        'preview_media' => true,
                        'title' => __ ( 'Select Bottom Background', 'mango' ),
                        //'default' => '#fff',
                        'compiler' => true,
                   ),
                    array (
                        'id' => 'header_text_dark',
                       'type' => 'color',
                       'title' => __ ( 'Text Color', 'mango' ),
                       'default' => '#fff',
                       'validate' => 'color',
                    ),
                    array (
                       'id' => 'header_text_dark_hover',
                       'type' => 'color',
                       'title' => __ ( 'Hover Color', 'mango' ),
                       'default' => '#ca1515',
                       'validate' => 'color',
                   ),
                    array (
                        'id' => 'header_cart_bg_dark',
                        'type' => 'color',
                        'title' => __ ( 'Cart Background Color', 'mango' ),
                        'default' => '#262626',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_cart_bg_dark_hover',
                        'type' => 'color',
                        'title' => __ ( 'Cart Background Color Hover', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_cart_text_dark',
                        'type' => 'color',
                        'title' => __ ( 'Cart Text Color', 'mango' ),
                        'default' => '#8c8c8c',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_cart_text_dark_hover',
                        'type' => 'color',
                        'title' => __ ( 'Cart Text Color Hover', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => '6',
                        'type' => 'info',
                        'desc' => __ ( 'Header 11 Settings', 'mango' ),
                    ),
                    array (
                        'id' => 'header_background_red',
                        'type' => 'background',
                        'title' => __ ( 'Select Background', 'mango' ),
                        //'default' => '#d62020',
                        'preview_media' => true,
                        'compiler' => true,
                    ),

                   array (
                        'id' => 'header_text_red',
                        'type' => 'color',
                        'title' => __ ( 'Text Color', 'mango' ),
                        'default' => '#f68e8e',
                        'validate' => 'color',
                    ),
                   array (
                        'id' => 'header_prize_red',
                        'type' => 'color',
                        'title' => __ ( 'Prize Color', 'mango' ),
                        'default' => '#fff',
                        'validate' => 'color',
                   ),
                  array (
                        'id' => 'header_box_red',
                        'type' => 'color',
                        'title' => __ ( 'Box Color', 'mango' ),
                        //'default' => '##ca1515',
                        'validate' => 'color',
                  ),
                  array (
                        'id' => 'header_hover_red',
                        'type' => 'color',
                        'title' => __ ( 'Hover Color', 'mango' ),
                        'default' => '#fff',
                        'validate' => 'color',
                  ),
                  array (
                        'id' => '4',
                       'type' => 'info',
                        'desc' => __ ( 'Header 8 & 16 Settings', 'mango' ),
                  ),

                    array (
                        'id' => 'header_background_custom',
                        'type' => 'background',
                        'title' => __ ( 'Select Top Background', 'mango' ),
                        // 'default' => '#b30f0f',
                        'compiler' => true,
                        'preview_media' => true,
                    ),

                    array (
                        'id' => 'header_background_custom_bottom',
                        'type' => 'background',
                        'title' => __ ( 'Select Bottom Background', 'mango' ),
//                        'default' => '#fff',
                        'preview_media' => true,
                        'compiler' => true,
                    ),

                    array (
                        'id' => 'header_text_custom',
                        'type' => 'color',
                        'title' => __ ( 'Text Color', 'mango' ),
                        'default' => '#fff',
                        'validate' => 'color',
                    ),

                    array (
                        'id' => 'header_text_custom_hover',
                        'type' => 'color',
                        'title' => __ ( 'Hover Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),

                    array (
                        'id' => 'header_box_custom',
                        'type' => 'color',
                        'title' => __ ( 'Box Color ', 'mango' ),
                        'default' => '#f5f5f5',
                        'validate' => 'color',
                    ),

                    array (
                        'id' => 'header_cart_bg_custom',
                        'type' => 'color',
                        'title' => __ ( 'Cart Background Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),

                    array (
                        'id' => 'header_cart_bg_custom_hover',
                        'type' => 'color',
                        'title' => __ ( 'Cart Background Color Hover', 'mango' ),
                        'default' => '#262626',
                        'validate' => 'color',
                    ),

                    array (
                        'id' => 'header_cart_text_custom',
                        'type' => 'color',
                        'title' => __ ( 'Cart Text Color', 'mango' ),
                        'default' => '#f68e8e',
                        'validate' => 'color',
                    ),

                    array (
                        'id' => 'header_cart_text_custom_hover',
                        'type' => 'color',
                        'title' => __ ( 'Cart Text Color Hover', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                    array (
                        'id' => '5',
                        'type' => 'info',
                        'desc' => __ ( 'Header 19 & 21  Settings', 'mango' ),
                    ),

                    array (
                        'id' => 'header_background_side_header',
                        'type' => 'background',
                        'title' => __ ( 'Select Background', 'mango' ),
                        //  'default' => '#3d3d3d',
                        'preview_media' => true,
                        'compiler' => true,
                    ),

                    array (
                        'id' => 'header_text_side_header',
                        'type' => 'color',
                        'title' => __ ( 'Text Color', 'mango' ),
                        'default' => '#fff',
                        'validate' => 'color',
                    ),

                    array (
                        'id' => 'header_prize_side_header',
                        'type' => 'color',
                        'title' => __ ( 'Prize Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),

                    array (
                        'id' => 'header_hover_side_header',
                        'type' => 'color',
                        'title' => __ ( 'Hover Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
					 array (
                        'id' => '6',
                        'type' => 'info',
                        'desc' => __ ( 'Header 17 Settings', 'mango' ),
                    ),
                    
					array (
                        'id' => 'header_background_nine17',
                        'type' => 'media',
                        'url' => true,
                        'title' => __ ( 'Select Background', 'mango' ),
						'compiler' => true
                    ),
					array (
                        'id' => 'header_text_nine17',
                       'type' => 'color',
                       'title' => __ ( 'Text Color', 'mango' ),
                       'default' => '#fff',
                       'validate' => 'color',
                    ),
                    array (
                       'id' => 'header_text_nine17_hover',
                       'type' => 'color',
                       'title' => __ ( 'Hover Color', 'mango' ),
                       'default' => '#ca1515',
                       'validate' => 'color',
                   ),
                    array (
                        'id' => 'header_cart_bg_nine17',
                        'type' => 'color',
                        'title' => __ ( 'Cart Background Color', 'mango' ),
                        'default' => '#000',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_cart_bg_nine17_hover',
                        'type' => 'color',
                        'title' => __ ( 'Cart Background Color Hover', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
					 array (
                        'id' => 'header_menu_btn_color',
                        'type' => 'color',
                        'title' => __ ( 'Menu Button Color', 'mango' ),
                        'default' => '#fff',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_menu_btn_hover_color',
                        'type' => 'color',
                        'title' => __ ( 'Menu Button Hover Color', 'mango' ),
                        'default' => '#000',
                        'validate' => 'color',
                    ),
					 array (
                        'id' => 'header_bag_color_nine17',
                        'type' => 'color',
                        'title' => __ ( 'Header background Color (if you are not using any Banner type)', 'mango' ),
                        'default' => '#000',
                        'validate' => 'color',
                    ),
                )
            );
            //menu sajad
            $this->sections[] = array (
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __ ( 'Main Menu', 'mango' ),
                'fields' => array (
					array (
						'id' => 'mango_customize_menu',
						'type' => 'switch',
						'title' => __('Customize Menu','mango'),
						'compiler' => true,
						'default' => '1',
						'on' => __('Yes','mango'),
						'off' => __('No','mango'),
                        'desc' => __("Switch to 'Yes' if you want to customize menu",'mango')
					 ),
                    array (
                        'id' => 'menu_customize_label_1',
                        'type' => 'info',
                        'desc' => __ ( 'Header 1 and Header 2 Menu Setting', 'mango' ),
                        //'required' => array ( 'mango_customize_menus', '=', '1' )
                    ),
                    array (
                        'id' => 'header_background_one_two',
                        'type' => 'color',
                        'title' => __ ( 'Background Color', 'mango' ),
                        'default' => '#323232',
                        'validate' => 'color',
                        //'required' => array ( 'mango_customize_menus', '=', '1' )
                    ),
                   array (
                        'id' => 'header_font_one_two',
                        'type' => 'color',
                        'title' => __ ( 'Font Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',

                    ),
                    array (
                        'id' => 'hover_font_color_h_1_2',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_background_chil_one_two',
                        'type' => 'color',
                        'title' => __ ( 'Background Submenu Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_font_chil_one_two',
                        'type' => 'color',
                        'title' => __ ( 'Font  Submenu Color', 'mango' ),
                        'default' => '#323232',
                        'validate' => 'color',
                    ),
				 array (
                       'id' => 'hover_font_submenu_color_h_1_2',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Submenu Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                        'default' => '',
                    ),
                    array (
                        'id' => 'menu_customize_label_4',
                        'type' => 'info',
                        'desc' => __ ( 'Header 3 Menu Settings', 'mango' ),
                    ),
                    array (
                        'id' => 'header_background_three',
                        'type' => 'color',
                        'title' => __ ( 'Background Color', 'mango' ),
                        'default' => '#ffffff',
						'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_font_three',
                        'type' => 'color',
                        'title' => __ ( 'Font Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                    ),
				array (
                      'id' => 'hover_font_color_h_3',
                      'type' => 'color',
                      'title' => __ ( 'Hover Font Color', 'mango' ),
                      'default' => '#3d3d3d',
                      'validate' => 'color',
                  ),
                array (
                       'id' => 'header_background_chil_three',
                       'type' => 'color',
                       'title' => __ ( 'Background Submenu Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                   ),
				array (
						'id' => 'header_font_chil_three',
                        'type' => 'color',
                        'title' => __ ( 'Font  Submenu Color', 'mango' ),
                        'default' => '#323232',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'hover_font_submenu_color_h_3',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Submenu Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'menu_customize_label_5',
                        'type' => 'info',
                        'desc' => __ ( 'Header 4 Menu Settings', 'mango' ),
                    ),
                    array (
                        'id' => 'header_background_four',
                        'type' => 'color',
                        'title' => __ ( 'Background Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_font_four',
                        'type' => 'color',
                        'title' => __ ( 'Font Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                        ),
                    array (
                        'id' => 'hover_font_color_h_4',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
				   ),
	                array (
                        'id' => 'header_background_chil_four',
                        'type' => 'color',
                        'title' => __ ( 'Background Submenu Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),

                   array (

                       'id' => 'header_font_chil_four',
                       'type' => 'color',
                       'title' => __ ( 'Font  Submenu Color', 'mango' ),
                       'default' => '#323232',
                       'validate' => 'color',
					),

                    array (
                        'id' => 'hover_font_submenu_color_h_4',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Submenu Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
					array (
                        'id' => 'menu_customize_label_6',
                        'type' => 'info',
                        'desc' => __ ( 'Header 5 and 6  Menu Settings', 'mango' ),
                      ),
				array (
                        'id' => 'header_background_five_six',
                        'type' => 'color',
                        'title' => __ ( 'Background Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_font_five_six',
                        'type' => 'color',
                        'title' => __ ( 'Font Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                    ),
                    array (
                       'id' => 'hover_font_color_h_5_6',
                       'type' => 'color',
                      'title' => __ ( 'Hover Font Color', 'mango' ),
                      'default' => '#3d3d3d',
                       'validate' => 'color',
                        ),

                   array (
                        'id' => 'header_background_chil_five_six',
                        'type' => 'color',
                        'title' => __ ( 'Background Submenu Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                   array (
                       'id' => 'header_font_chil_five_six',
                        'type' => 'color',
                        'title' => __ ( 'Font  Submenu Color', 'mango' ),
                        'default' => '#3d3d3d',
                       'validate' => 'color',
                    ),
                    array (
                       'id' => 'hover_font_submenu_color_h_5_6',
                       'type' => 'color',
                       'title' => __ ( 'Hover Font Submenu Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
                   array (
                      'id' => 'menu_customize_label_15',
                      'type' => 'info',
						'desc' => __ ( 'Header 7 and 8  Menu Settings', 'mango' ),
                    ),
                    array (
                        'id' => 'header_background_7_8',
                        'type' => 'color',
                        'title' => __ ( 'Background Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
					   ),
                    array (
                        'id' => 'header_font_7_8',
                        'type' => 'color',
                        'title' => __ ( 'Font Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
						),
	                array (
						'id' => 'hover_font_color_h_7_8',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                    ),
                   array (
                        'id' => 'header_background_chil_7_8',
                        'type' => 'color',
                        'title' => __ ( 'Background Submenu Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_font_chil_7_8',
                        'type' => 'color',
                        'title' => __ ( 'Font  Submenu Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                       ),
                    array (
                        'id' => 'hover_font_submenu_color_h_7_8',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Submenu Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                     ),
                    array (
                        'id' => 'menu_customize_label_16',
                        'type' => 'info',
                        'desc' => __ ( 'Header 9 , 10 and 17 Menu Settings', 'mango' ),
                     ),
                    array (
                        'id' => 'header_font_9',
                        'type' => 'color',
                        'title' => __ ( 'Font Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                     ),
                    array (
                        'id' => 'hover_font_color_h_9',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                              ),
                    array (
                        'id' => 'header_background_chil_9',
                        'type' => 'color',
                        'title' => __ ( 'Background Submenu Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
				    ),
                    array (
                        'id' => 'header_font_chil_9',
                        'type' => 'color',
                        'title' => __ ( 'Font  Submenu Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'hover_font_submenu_color_h_9',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Submenu Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                     ),
                    array (
                        'id' => 'menu_customize_label_7',
                        'type' => 'info',
                        'desc' => __ ( 'Header 11  Menu Settings', 'mango' ),
					 ),
	                   array (
                        'id' => 'header_background_11',
                        'type' => 'color',
                        'title' => __ ( 'Background Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
	                array (
                        'id' => 'header_font_11',
                        'type' => 'color',
                        'title' => __ ( 'Font Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
					 ),
                    array (
                        'id' => 'hover_font_color_h_11',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_background_chil_11',
                        'type' => 'color',
                        'title' => __ ( 'Background Submenu Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_font_chil_11',
                        'type' => 'color',
                        'title' => __ ( 'Font  Submenu Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                    ),
                    array (
                       'id' => 'hover_font_submenu_color_h_11',
                       'type' => 'color',
                       'title' => __ ( 'Hover Font Submenu Color', 'mango' ),
                       'default' => '#ca1515',
                       'validate' => 'color',
                    ),
                   array (
                        'id' => 'menu_customize_label_8',
                        'type' => 'info',
                       'desc' => __ ( 'Headers 12 , 18 , 20  Menu Setting', 'mango' ),
                    ),
                    array (
                        'id' => 'header_font_12_18_20',
                        'type' => 'color',
                        'title' => __ ( 'Font Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
					 ),
                    array (
                        'id' => 'hover_font_color_h_12_18_20',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'header_font_chil_12_18_20',
                        'type' => 'color',
                        'title' => __ ( 'Font  Submenu Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                    ),
                    array (

                       'id' => 'hover_font_submenu_color_h_12_18_20',
                       'type' => 'color',
                       'title' => __ ( 'Hover Font Submenu Color', 'mango' ),
                       'default' => '#ca1515',
                       'validate' => 'color',
                 ),
                 array (
                        'id' => 'menu_customize_label_10',
                       'type' => 'info',
                        'desc' => __ ( 'Header 13  Menu Settings', 'mango' ),
                  ),

                 array (
                        'id' => 'header_background_13',
                        'type' => 'color',
                        'title' => __ ( 'Background Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                 ),
                 array (
                        'id' => 'header_font_13',
                        'type' => 'color',
                        'title' => __ ( 'Font Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                  ),
                 array (
                       'id' => 'hover_font_color_h_13',
                       'type' => 'color',
                       'title' => __ ( 'Hover Font Color', 'mango' ),
                       'default' => '#ffffff',
                       'validate' => 'color',
                 ),
                 array (
                      'id' => 'header_background_chil_13',
                      'type' => 'color',
                      'title' => __ ( 'Background Submenu Color', 'mango' ),
                      'default' => '#ffffff',
                      'validate' => 'color',
                  ),
                 array (
                        'id' => 'header_font_chil_13',
                        'type' => 'color',
                        'title' => __ ( 'Font  Submenu Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                        'required' => array ( 'mango_customize_menu', '=', '1' )
                 ),
                 array (
                        'id' => 'hover_font_submenu_color_h_13',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Submenu Color', 'mango' ),
                         'default' => '#ca1515',
	                    'validate' => 'color',
                 ),
                 array (
                        'id' => 'menu_customize_label_11',
                        'type' => 'info',
                        'desc' => __ ( 'Header 14  Menu Settings', 'mango' ),
                 ),
                 array (
                        'id' => 'header_background_14',
                        'type' => 'color',
                        'title' => __ ( 'Background Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                 ),
                 array (
                        'id' => 'header_font_14',
                        'type' => 'color',
                        'title' => __ ( 'Font Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
    			 ),
                 array (
                        'id' => 'hover_font_color_h_14',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                 ),
                 array (
                        'id' => 'header_background_chil_14',
                        'type' => 'color',
                        'title' => __ ( 'Background Submenu Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
				 ),
                 array (
                        'id' => 'header_font_chil_14',
                        'type' => 'color',
                        'title' => __ ( 'Font  Submenu Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                 ),
                 array (
                        'id' => 'hover_font_submenu_color_h_14',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Submenu Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                  ),
                 array (
                        'id' => 'menu_customize_label_12',
                        'type' => 'info',
                        'desc' => __ ( 'Header 16  Menu Settings', 'mango' ),
                 ),
                 array (
                        'id' => 'header_background_16',
                        'type' => 'color',
                        'title' => __ ( 'Background Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                 ),
                 array (
                        'id' => 'header_font_16',
                        'type' => 'color',
                        'title' => __ ( 'Font Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                 ),
                 array (
                       'id' => 'hover_font_color_h_16',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                 ),
                 array (
                        'id' => 'header_background_chil_16',
                        'type' => 'color',
                        'title' => __ ( 'Background Submenu Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                 ),
                 array (
                        'id' => 'header_font_chil_16',
                        'type' => 'color',
                        'title' => __ ( 'Font  Submenu Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                 ),
                 array (
                        'id' => 'hover_font_submenu_color_h_16',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Submenu Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                 ),
                 array (
                        'id' => 'menu_customize_label_13',
                        'type' => 'info',
                        'desc' => __ ( 'Header 19 and 21  Menu Settings', 'mango' ),
                 ),
                 array (
                      'id' => 'header_font_19_21',
                      'type' => 'color',
                      'title' => __ ( 'Font Color', 'mango' ),
                      'default' => '#3d3d3d',
                      'validate' => 'color',
                 ),
                 array (
                       'id' => 'hover_font_color_h_19_21',
                       'type' => 'color',
                       'title' => __ ( 'Hover Font Color', 'mango' ),
                       'default' => '#3d3d3d',
                       'validate' => 'color',
                 ),
                 array (
                        'id' => 'header_background_chil_19_21',
                        'type' => 'color',
                        'title' => __ ( 'Background Submenu Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                 ),
                 array (
                        'id' => 'header_font_chil_19_21',
                        'type' => 'color',
                        'title' => __ ( 'Font  Submenu Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                 ),
                 array (
                        'id' => 'hover_font_submenu_color_h_19_21',
                        'type' => 'color',
                        'title' => __ ( 'Hover Font Submenu Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                  ),
                )
            );

            //mobile menu tahir done
            $this->sections[] = array (
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __ ( 'Mobile Panel', 'mango' ),
                'fields' => array (
                    array (
                        'id' => 'mobile_menu_enable_size',
                        'type' => 'slider',
                        'title' => __ ( 'Mobile Menu Activation Size', 'mango' ),
                        'min' => 320,
                        'max' => 1400,
                        'default' => 992,
                        'display_value' => 'text',
                        'desc' => __ ( 'Screen Width on which you want to show mobile menu', 'mango' )
                    ),

                    array (
                        'id' => 'mango_customize_mobile_menu',
                        'type' => 'switch',
                        'title' => __ ( 'Customize Mobile Menu', 'mango' ),
                        'compiler' => true,
                        'default' => '0',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                        'desc' => __("Switch to 'Yes' if you want to customize Mobile menu",'mango')
                    ),

                    array (
                        'id' => 'Mobile_Back_menu_color',
                        'type' => 'color',
                        'title' => __ ( 'Background  Color', 'mango' ),
                        'default' => '#3d3d3d',
                        'validate' => 'color',
                        'required' => array ( "mango_customize_mobile_menu", "=", '1' )
                    ),

                    array (
                        'id' => 'mobile_text_menu_color',
                        'type' => 'color',
                        'title' => __ ( 'Text Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                        'required' => array ( "mango_customize_mobile_menu", "=", '1' )
                    ),

                    array (
                        'id' => 'mobile_link_menu_color',
                        'type' => 'color',
                        'title' => __ ( 'Link Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                        'required' => array ( "mango_customize_mobile_menu", "=", '1' )
                    ),
                )
            );

            ////breadcrumb and title done
            $this->sections[] = array (
                'icon' => 'el-icon-minus',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __ ( 'Breadcrumb And title', 'mango' ),
                'fields' => array (
                    array (
                        'id' => 'mango_bread_title_bg',
                        'type' => 'button_set',
                        'title' => __('Breadcrumb And Title Background','mango'),
                        'compiler' => true,
                        'options' => array ( 'bg-img' => 'Background Image', 'bg-color' => 'Background Color' ),
                        'default' => 'bg-img',
                    ),

                    array (
                        'id' => 'mango_bread_title_image',
                        'type' => 'media',
                        'title' => __('Select Background Image','mango'),
                        'compiler' => true,
                        'default' => array (
                            'url' => get_template_directory_uri () . '/images/default/header-lightbg.jpg',
                        ),
                        'required' => array ( 'mango_bread_title_bg', '=', 'bg-img' ),
                    ),

                    array (
                        'id' => 'mango_use_parallax',
                        'type' => 'switch',
                        'title' => __('Use Parallax','mango'),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                        'required' => array ( 'mango_bread_title_bg', '=', 'bg-img' ),
                    ),
                    array (
                        'id' => 'mango_bread_title_bg_color',
                        'type' => 'color',
                        'title' => __('Background Color','mango'),
                        'compiler' => true,
                        'default' => '#3483c0',
                        'required' => array ( 'mango_bread_title_bg', '=', 'bg-color' ),
                    ),
                    array (
                        'id' => 'mango_bread_title_border_color',
                        'type' => 'color',
                        'title' => __('Border Color','mango'),
                        'compiler' => true,
                        'default' => '#4f94c8',
                    ),
                    array (
                        'id' => 'mango_bread_title_color',
                        'type' => 'color',
                        'title' => __('Text Color','mango'),
                        'compiler' => true,
                    ),
                )
            );

            ///footer asif done
            $this->sections[] = array (
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'subsection' => true,
                'title' => __ ( 'Footer', 'mango' ),
                'fields' => array (
                    array (
                        'id' => 'mango_enable_footer_customization',
                        'type' => 'switch',
                        'title' => __ ( 'Customize Footer', 'mango' ),
                        'default' => '0',
                        'compiler' => true,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                        'desc' => __ ( "Switch to 'Yes' if you want to customize footer area", 'mango' )
                    ),
					 array (
                        'id' => 'mango_footer_typography',
                        'type' => 'typography',
                        'title' => __ ( 'Footer Fonts', 'mango' ),
                        'google' => true,
                        'font-size' => false,
                        'subsets' => false,
                        'line-height' => false,
                        'font-backup' => false,
                        'text-align' => false,
                        'default' => array (
                            'color' => '#808080',
                        )
                    ),
                    array (
                        'id' => 'info_warning_ss',
                        'type' => 'info',
                        'desc' => __ ( 'Customizations for footers 1,6,7,8,9,10,11 ', 'mango' ),
                        //'required' => array ( 'mango_enable_footer_customization', '=', '1' )
                    ),
                    array (
                        'id' => 'mango_bg_custom_footer_light',
                        'type' => 'background',
                        'title' => __ ( 'Select Background', 'mango' ),
                        'compiler' => true,
                        'preview_media' => true,
                    ),
                   array (
                        'id' => 'footer_heading_color',
                        'type' => 'color',
                        'title' => __ ( 'Heading Color', 'mango' ),
                        'default' => '#343434',
                        'validate' => 'color',
                    ),
				   array(
                        'id' => 'footer_text_color',
                        'type' => 'color',
                        'title' => __ ( 'Text Color', 'mango' ),
                        'default' => '#a6a6a6',
                        'validate' => 'color',
                   ),
                   array (
                        'id' => 'footer_link_color',
                        //'type' => 'link_color',
                        'type' => 'color',
                        'title' => __ ( 'Link  Color', 'mango' ),
                        'default' => '#989898',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_link_hover_color',
                        // 'type' => 'link_color',
                        'type' => 'color',
                        'title' => __ ( 'Link  Hover Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
                   array (
                        'id' => 'footer_bottom_link_color',
                        'type' => 'color',
                        'title' => __ ( 'Bottom Link Color', 'mango' ),
                        'default' => '#464646',
                        'validate' => 'color',
                   ),
                    array (
                        'id' => 'footer_bottom_link_hover_color',
                        'type' => 'color',
                        'title' => __ ( 'Bottom Link Hover  Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_copyright_text_color',
                        'type' => 'color',
                        'title' => __ ( 'Copyright Text Color', 'mango' ),
                        'default' => '#7f7f7f',
                        'validate' => 'color',
                    ),
					array (
                        'id' => 'footer_copyright_background_color_1_3',
                        'type' => 'color',
                        'title' => __ ( 'Copyright Background Color', 'mango' ),
                        'default' => '#7f7f7f',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_copyright_link_color',
                        'type' => 'color',
                        'title' => __ ( 'Copyright Link Color', 'mango' ),
                        'default' => '#ca1515',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_copyright_link_hover_color',
                        'type' => 'color',
                        'title' => __ ( 'Copyright Link Hover Color', 'mango' ),
                        'default' => '#989898',
                        'validate' => 'color',
                   ),
     			    array (
                         'id' => 'info_warning_dark',
                         'type' => 'info',
                         'desc' => __ ( 'Customizations for footers 2,4,5 ', 'mango' ),
                         ),
			        array (
	                       'id' => 'mango_bg_custom_footer_dark',
                          'type' => 'background',
                          'title' => __ ( 'Select Background', 'mango' ),
                           'compiler' => true,
                           'preview_media' => true,
                    ),
                    array (
                        'id' => 'footer_heading_dark_color',
                        'type' => 'color',
                        'title' => __ ( 'Heading Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                   ),
                    array (
                        'id' => 'footer_text_dark_color',
                        'type' => 'color',
                        'title' => __ ( 'Text Color', 'mango' ),
                        'default' => '#a6a6a6',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_link_dark_color',
                        'type' => 'link_color',
                        'type' => 'color',
                        'title' => __ ( 'Link  Color', 'mango' ),
                        'default' => '#a6a6a6',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_link_hover_dark_color',
                        'type' => 'link_color',
                        'type' => 'color',
                       'title' => __ ( 'Link  Hover Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_bottom_link_dark_color',
                        'type' => 'color',
                        'title' => __ ( 'Bottom Link Color', 'mango' ),
                        'default' => '#a6a6a6',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_bottom_link_hover_dark__color',
                        'type' => 'color',
                        'title' => __ ( 'Bottom Link Hover  Color', 'mango' ),
                        'default' => '#ffffff',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_copyright_text_dark_color',
                        'type' => 'color',
                        'title' => __ ( 'Copyright Text Color', 'mango' ),
                        'default' => '#7f7f7f',
                        'validate' => 'color',
                    ),
					array (
                        'id' => 'footer_copyright_background_dark_color',
                        'type' => 'color',
                        'title' => __ ( 'Copyright Background Color  for two', 'mango' ),
                        'default' => '#7f7f7f',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_copyright_link_dark_color',
                        'type' => 'color',
                        'title' => __ ( 'Copyright Link Color 1', 'mango' ),
                        'default' => '#b30f0f',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_copyright_link_hover_dark_color',
                        'type' => 'color',
                        'title' => __ ( 'Copyright Link Hover Color', 'mango' ),
                        'default' => '#a6a6a6',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'info_warning_dark_3',
                        'type' => 'info',
                        'desc' => __ ( 'Customizations for footers 3 ', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_bg_custom_footer_three',
                        'type' => 'background',
                        'title' => __ ( 'Select Background', 'mango' ),
                        'compiler' => true,
                        'preview_media' => true,
                    ),
                    array (
                        'id' => 'footer_bottom_link_three_color',
                        'type' => 'color',
                        'title' => __ ( 'Bottom Link Color', 'mango' ),
                        'default' => '#a6a6a6',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_bottom_link_hover_three__color',
                        'type' => 'color',
                        'title' => __ ( 'Bottom Link Hover  Color', 'mango' ),
                        'default' => '#b30f0f',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_copyright_text_three_color',
                        'type' => 'color',
                        'title' => __ ( 'Copyright Text Color', 'mango' ),
                        'default' => '#a6a6a6',
                        'validate' => 'color',
                    ),
					array (
                        'id' => 'footer_copyright_background_three_color',
                        'type' => 'color',
                        'title' => __ ( 'Copyright Background Color', 'mango' ),
                        'default' => '#a6a6a6',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_copyright_link_three_color',
                        'type' => 'color',
                        'title' => __ ( 'Copyright Link Color 2', 'mango' ),
                        'default' => '#b30f0f',
                        'validate' => 'color',
                    ),
                    array (
                        'id' => 'footer_copyright_link_hover_three_color',
                        'type' => 'color',
                        'title' => __ ( 'Copyright Link Hover Color', 'mango' ),
                        'default' => '#a6a6a6',
                        'validate' => 'color',
                    ),
					//foooter top
                   array (
                       'id' => 'info_warning_dark_3s',
                       'type' => 'info',
                       'desc' => __ ( 'Customizations for footers top ', 'mango' ),
                   ),
                   array (
                        'id' => 'mango_bg_custom_footer_top',
                       'type' => 'background',
                       'title' => __ ( 'Select Background', 'mango' ),
                       'compiler' => true,
                       'preview_media' => true,
                   ),
                   array (
                        'id' => 'footer_top_title_color',
                        'type' => 'color',
                        'title' => __ ( 'Text Color', 'mango' ),
                        'default' => '#a6a6a6',
                        'validate' => 'color',
                   ),
                   array (
                        'id' => 'footer_top_link_color',
                        'type' => 'color',
                        'title' => __ ( 'Link Color', 'mango' ),
                        'default' => '#b30f0f',
                        'validate' => 'color',
                   ),
                   array (
                        'id' => 'footer_top_hover_color',
                        'type' => 'color',
                        'title' => __ ( 'Hover Color', 'mango' ),
                        'default' => '#a6a6a6',
                        'validate' => 'color',
                   ),
                )
            );

           $this->sections[] = array (
                'title' => __ ( 'General', 'mango' ),
                'icon' => 'el-icon-cogs',
                'fields' => array (
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'desc' => __ ( 'Logo, Icon', 'mango' ),
                    ),
                    array (
                        'id' => 'logo',
                        'type' => 'media',
                        'url' => true,
                        'title' => __ ( 'Logo', 'mango' ),
                        'compiler' => true,
                        'default' => array (
                        'url' => get_template_directory_uri () . '/images/logo/logo.png',
                         )
                    ),
                   array (
                       'id' => 'footer_logo',
                       'type' => 'media',
                       'url' => true,
                       'title' => __ ( 'Footer Logo', 'mango' ),
                       'compiler' => true,
                       'default' => array (
                       'url' => get_template_directory_uri () . '/images/logo/logo.png',
                       )
                    ),
                   /*array (
                        'id' => 'favicon',
                        'type' => 'media',
                        'title' => __ ( 'Favicon', 'mango' ),
                        'compiler' => true,
                        'default' => array (
                      'url' => get_template_directory_uri () . '/images/icons/favicon.png',
                      )
                    ),
                   array (
                        'id' => 'icon-iphone',
                        'type' => 'media',
                        'url' => true,
                        'title' => __ ( 'Apple iPhone Icon', 'mango' ),
                        'compiler' => true,
                        'desc' => __('Icon for Apple iPhone (57px X 57px)','mango'),
                        'default' => array (
                        'url' => get_template_directory_uri () . '/images/icons/faviconx57.png',
                        )
                   ),*/
                   array (
                        'id' => 'icon-iphone-retina',
                        'type' => 'media',
                        'url' => true,
                        'title' => __ ( 'Apple iPhone Retina Icon', 'mango' ),
                        'compiler' => true,
                        'desc' => __('Icon for Apple iPhone Retina (114px X 114px)','mango'),
                        'default' => array (
                        'url' => get_template_directory_uri () . '/images/icons/faviconx57@2x.png',
                       )
                    ),
                   array (
                        'id' => 'icon-ipad',
                        'type' => 'media',
                        'url' => true,
                        'title' => __ ( 'Apple iPad Icon', 'mango' ),
                        'compiler' => true,
                        'desc' => __('Icon for Apple iPad (72px X 72px)','mango'),
                        'default' => array (
                        'url' => get_template_directory_uri () . '/images/icons/faviconx72.png',
                        )
                    ),
                   array (
                        'id' => 'icon-ipad-retina',
                        'type' => 'media',
                        'url' => true,
                        'title' => __ ( 'Apple iPad Retina Icon', 'mango' ),
                        'compiler' => true,
                        'desc' => __('Icon for Apple iPad Retina (144px X 144px)','mango'),
                        'default' => array (
                        'url' => get_template_directory_uri () . '/images/icons/faviconx72@2x.png',
                        )
                    ),
                   array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'desc' => __ ( 'Javascript Code', 'mango' ),
                    ),
                   array (
                        'id' => 'mango_jscode',
                        'type' => 'ace_editor',
                        'title' => __ ( 'JS Code', 'mango' ),
                        'compiler' => true,
                        'subtitle' => __ ( 'Paste your JS code here.', 'mango' ),
                        'mode' => 'javascript',
                        'theme' => 'monokai',
                        'default' => "(function ($) {\n\n})(jQuery);"
                   ) ,
					 array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'desc' => __ ( 'Header JS Code', 'mango' ),
                    ),
                   array (
                        'id' => 'mango_header_jscode',
                        'type' => 'textarea',
                        'title' => __ ( 'Header JS Code', 'mango' ),
                        'compiler' => true,
                        'subtitle' => __ ( 'Add custom scripts inside HEAD tag. You need to have SCRIPT tag around the scripts.', 'mango' ),
						 
                        
                   )       
                )
           );
            //Header Settings
            $this->sections[] = array (
                'title' => __ ( 'Header', 'mango' ),
                'icon' => 'el-icon-website',
                'class' => 'icon',
                'fields' => array (
                    array (
                        'id' => 'mango_site_header',
                        'type' => 'image_select',
                        //'tiles' => true,
                        'title' => __ ( 'Site Header Type', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                        '1' => array (
                                      'alt' => 'Header 1',
                                      'img' => mango_uri . '/images/headers/Header1.png'
                            ),
                        '2' => array (
                                'alt' => 'Header 2',
                                'img' => mango_uri . '/images/headers/Header2.png'
                            ),
                        '3' => array (
                                'alt' => 'Header 3',
                                'img' => mango_uri . '/images/headers/Header3.png'
                        ),
                        '4' => array (
                                'alt' => 'Header 4',
                                'img' => mango_uri . '/images/headers/Header4.png'
                        ),
                        '5' => array (
                                'alt' => 'Header 5',
                                'img' => mango_uri . '/images/headers/Header5.png'
                        ),
                        '6' => array (
                               'alt' => 'Header 6',
                               'img' => mango_uri . '/images/headers/Header6.png'
                        ),
                       '7' => array (
                                'alt' => 'Header 7',
                                'img' => mango_uri . '/images/headers/Header7.png'
                       ),
                       '8' => array (
                                'alt' => 'Header 8',
                                'img' => mango_uri . '/images/headers/Header8.png'
                       ),
                      '9' => array (
                                'alt' => 'Header 9',
                                'img' => mango_uri . '/images/headers/Header9.png'
                      ),
                      '10' => array (
                                'alt' => 'Header 10',
                                'img' => mango_uri . '/images/headers/Header10.png'
                      ),
                      '11' => array (
                                'alt' => 'Header 11',
                                'img' => mango_uri . '/images/headers/Header11.png'
                      ),
                      '13' => array (
                                'alt' => 'Header 13',
                                'img' => mango_uri . '/images/headers/Header13.png'
                      ),
                      '14' => array (
                                'alt' => 'Header 14',
                                'img' => mango_uri . '/images/headers/Header14.png'
                      ),
                    '15' => array (
                               'alt' => 'Header 15',
                                'img' => mango_uri . '/images/headers/Header15.png'
                    ),
                    '17' => array (
                                'alt' => 'Header 17',
                                'img' => mango_uri . '/images/headers/Header17.png'
                    ),
                   '16' => array (
                                'alt' => 'Header 16',
                                'img' => mango_uri . '/images/headers/Header16.png'
                    ),
                   '12' => array (
                               'alt' => 'Header 12',
                               'img' => mango_uri . '/images/headers/Header12.png'
                    ),
                   '18' => array (
                               'alt' => 'Header 18',
                                'img' => mango_uri . '/images/headers/Header18.png'
                   ),
                   '19' => array (
                               'alt' => 'Header 19',
                               'img' => mango_uri . '/images/headers/Header19.png'
                   ),
                   '20' => array (
                               'alt' => 'Header 20',
                               'img' => mango_uri . '/images/headers/Header20.png'
                   ),
                   '21' => array (
                                'alt' => 'Header 21',
                                'img' => mango_uri . '/images/headers/Header21.png'
                   ),
				    '22' => array (
				'alt' => 'Header 22',
				'img' => mango_uri . '/images/headers/Header22.png'
                   ),
                   ),
                       'default' => '1'
                    ),
                   array (
                        'id' => 'mango_side_header_large',
                        'type' => 'switch',
                        'title' => __ ( 'Use Large Side Headers', 'mango' ),
                        'default' => '0',
                        'compiler' => true,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                        'desc' => __ ( "Used With Side Headers(12,18,19,20,21)", 'mango' )
                    ),
                   array (
                        'id' => 'show-wpml-switcher',
                        'type' => 'switch',
                        'title' => __('Show WPML language Switcher','mango'),
                        'default' => '0',
                        'compiler' => true,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                   ),
                   array (
                        'id' => 'show-currency-switcher',
                       'type' => 'switch',
                       'title' => __('Show Currency Switcher','mango'),
                       'default' => '0',
                       'compiler' => true,
                       'on' => __('Yes','mango'),
                       'off' => __('No','mango'),
                   ),
                    array (
                        'id' => 'header_social_icons',
                        'type' => 'switch',
                        'title' => __ ( 'Show Social Icons', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'show-minicart',
                        'type' => 'switch',
                        'title' => __('Show Mini cart','mango'),
                        'default' => '1',
                        'compiler' => true,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'show-wishlist-button',
                        'type' => 'switch',
                        'title' => __('Show Wishlist Button','mango'),
                        'default' => '1',
                        'compiler' => true,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => '6',
                        'type' => 'info',
                        'desc' => __('Phone Info','mango')
                    ),
                    array (
                        'id' => 'show-phoneinfo',
                        'type' => 'switch',
                        'title' => __('Show Phone Info','mango'),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'phone_text',
                        'type' => 'textarea',
                        'title' => __ ( 'Phone Text', 'mango' ),
                        'compiler' => true,
                        'default' => __ ( '<span class="hidden-sm">Any question?</span> Call Us', 'mango' ),
                        'allowed_html' => array ( 'a', 'span', 'em', 'strong' ),
                        'validate' => 'html',
                        'required' => array ( 'show-phoneinfo', '=', '1' )
                    ),
                   array (
                        'id' => 'phone_number',
                        'type' => 'text',
                        'validate' => 'no_html',
                        'title' => __ ( 'Phone Number', 'mango' ),
                        'compiler' => true,
                        'default' => __ ( '+987 123 654', 'mango' ),
                        'required' => array ( 'show-phoneinfo', '=', '1' )
                    ),
                    array (
                        'id' => 'mango_header13_left_title',
                        'type' => 'text',
                        'validate' => 'no_html',
                        'title' => __ ( 'Header 13 Side Title', 'mango' ),
                        'compiler' => true,
                        'default' => __ ( 'Product Categories', 'mango' ),
                        'desc' => __ ( 'Used in Header 13. Default is Product Categories', 'mango' )
                    ),
                   array (
                       'id' => 'mango_header14_menu_title',
                        'type' => 'text',
                        'validate' => 'no_html',
                        'title' => __ ( 'Header 14 Menu Title', 'mango' ),
                        'compiler' => true,
                        'default' => __ ( 'Menu', 'mango' ),
                        'desc' => __ ( 'Used in Header 14 special Menu. Choose menu from Appearance>Menus.', 'mango' )
                   ),
                   array (
                        'id' => '6',
                        'type' => 'info',
                        'desc' => __('Search Form','form')
                   ),
				   
				    array (
                        'id' => 'show-loginform',
                        'type' => 'switch',
                        'title' => __('Show Login Form','mango'),
                        'default' => '1',
                        'compiler' => true,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
					
                   array (
                        'id' => 'show-searchform',
                        'type' => 'switch',
                        'title' => __('Show Search Form','mango'),
                        'default' => '1',
                        'compiler' => true,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                   array (
                        'id' => 'search_field_placeholder',
                        'type' => 'text',
                        'validate' => 'no_html',
                        'title' => __ ( 'Search Field Placeholder', 'mango' ),
                        'compiler' => true,
                        'default' => __ ( 'Type text and hit enter', 'mango' ),
                        'required' => array ( "show-searchform", "=", "1" ),
                   ),
                   array (
                        'id' => 'mango_search_type',
                        'type' => 'button_set',
                        'title' => __('Search Post Type','mango'),
                        'compiler' => true,
                        'description' => __ ( "If the selected post type does not exists then the default post will be used", 'mango' ),
                        'options' => array (
                               'post' => 'Post',
                               'product' => 'Product',
                               'portfolio' => 'Portfolio'
                        ),
                        'default' => 'Product',
                        'required' => array ( "show-searchform", "=", "1" )
                    ),
                   array (
                        'id' => 'mango_search_dropdown_post',
                        'type' => 'button_set',
                        'title' => __('Select Dropdown','mango'),
                        'compiler' => true,
                        'default' => 'category',
                        'options' => array (
                            'category' => __ ( 'Category', 'mango' ),
                            'tag' => __ ( 'Tags', 'mango' ),
                            '' => __ ( 'No Dropdown', 'mango' )
                        ),
                       'required' => array ( "mango_search_type", "=", "post" )
                   ),
                   array (
                        'id' => 'mango_search_dropdown_portfolio',
                        'type' => 'switch',
                        'title' => __('Dropdown For portfolio Category','mango'),
                        'compiler' => true,
                        'default' => 'portfolio_category',
                        'on' => __ ( 'Show', 'mango' ),
                        'off' => __ ( 'Hide', 'mango' ),
                        'required' => array ( "mango_search_type", "=", "portfolio" )
                   ),
                    array (
                        'id' => 'mango_search_dropdown_product',
                        'type' => 'switch',
                        'title' => __('Dropdown For Product Category','mango'),
                        'compiler' => true,
                        'default' => 'product_category',
                        'on' => __ ( 'Show', 'mango' ),
                        'off' => __ ( 'Hide', 'mango' ),
                        'required' => array ( "mango_search_type", "=", "product" ),
	                    'desc'=>__('if "Woocommerce Ajax Search" plugin is active then the dropdown wont show.','mango')
                    ),
					
					array (
                      'id' => 'search-id',
                      'type' => 'switch',
                      'title' => __('Show Advance Search Option','mango'),
                      'compiler' => true,
                      'default' => '0',
                      'on' => __('Yes','mango'),
                      'off' => __('No','mango'),
                    ),
					
                    array (
                        'id' => '7',
                        'type' => 'info',
                        'title' => __('Header Boxes','mango'),
                        'desc' => __('Header Boxes used in header 8,11,13,16 only. Select number of boxes for each header.Select 0 to hide the boxes from the header.','mango')
                    ),
                    array (
                        'id' => 'mango_header_8_boxes',
                        'type' => 'button_set',
                        'title' => __('Header 8 Boxes','mango'),
                        'compiler' => true,
                        'default' => '3',
                        'options' => array ( 0, 1, 2, 3 )
                    ),
                    array (
                        'id' => 'mango_header_11_boxes',
                        'type' => 'button_set',
                        'title' => __('Header 11 Boxes','mango'),
                        'compiler' => true,
                        'default' => '2',
                        'options' => array ( 0, 1, 2, 3 )
                    ),
                    array (
                        'id' => 'mango_header_13_boxes',
                        'type' => 'button_set',
                        'title' => __('Header 13 Boxes','mango'),
                        'compiler' => true,
                        'default' => '2',
                        'options' => array ( 0, 1, 2, 3 )
                    ),
                    array (
                        'id' => 'mango_header_16_boxes',
                        'type' => 'button_set',
                        'title' => __('Header 16 Boxes','mango'),
                        'compiler' => true,
                        'default' => '1',
                        'options' => array ( 0, 1, 2, 3 )
                    ),
                    array (
                        'id' => '8',
                        'type' => 'info',
                        'title' => __('Header Box 1','mango'),
                    ),
                    array (
                        'id' => 'mango_header_box_icon_1',
                        'type' => 'select',
                        'class' => 'font-icons',
                        'title' => __ ( 'Select Icon', 'mango' ),
                        'options' => array (
                            $mango_font_awsome_list,
                        ),
                        'placeholder' => __ ( 'Select an Icon', 'mango' )
                    ),
                    array (
                        'id' => 'mango_header_box_icon_bordered_1',
                        'type' => 'switch',
                        'title' => __ ( 'Use Bordered Icon', 'mango' ),
                        'subtitle' => __('Used in header 8, 11 and 13 only.','mango'),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_header_box_title_1',
                        'type' => 'text',
                        'title' => __ ( 'Box 1 Title', 'mango' ),
                        'placeholder' => __('Box title','mango')
                    ),
                    array (
                        'id' => 'mango_header_box_subtitle_1',
                        'type' => 'text',
                        'title' => __ ( 'Box 1 Sub Title', 'mango' ),
                        'placeholder' => __('Box Sub title','mango')
                    ),
                    /*array (
                        'id' => 'mango_header_box_custom_1',
                        'type' => 'switch',
                        'title' => __ ( 'Use Custom Style', 'mango' ),
                        'subtitle' => __('Used in header 13 only.','mango'),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),*/
                    array (
                        'id' => '8',
                        'type' => 'info',
                        'title' => __('Header Box 2','mango'),
                    ),
                    array (
                        'id' => 'mango_header_box_icon_2',
                        'type' => 'select',
                        'class' => 'font-icons',
                        'title' => __ ( 'Select Icon', 'mango' ),
                        'options' => array (
                            $mango_font_awsome_list,
                        ),
                        'placeholder' => __ ( 'Select an Icon', 'mango' )
                    ),
                    array (
                        'id' => 'mango_header_box_icon_bordered_2',
                        'type' => 'switch',
                        'title' => __ ( 'Use Bordered Icon', 'mango' ),
                        'subtitle' => __('Used in header 8, 11 and 13 only.','mango'),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_header_box_title_2',
                        'type' => 'text',
                        'title' => __ ( 'Box 2 Title', 'mango' ),
                        'placeholder' => __('Box title','mango')
                    ),
                    array (
                        'id' => 'mango_header_box_subtitle_2',
                        'type' => 'text',
                        'title' => __ ( 'Box 2 Sub Title', 'mango' ),
                        'placeholder' => __('Box Sub title','mango')
                    ),
                    /*array (
                        'id' => 'mango_header_box_custom_2',
                        'type' => 'switch',
                        'title' => __ ( 'Use Custom Style', 'mango' ),
                        'subtitle' => __('Used in header 13 only.','mango'),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),*/
                    array (
                        'id' => '8',
                        'type' => 'info',
                        'title' => __('Header Box 3','mango'),
                    ),
                    array (
                        'id' => 'mango_header_box_icon_3',
                        'type' => 'select',
                        'class' => 'font-icons',
                       'title' => __ ( 'Select Icon', 'mango' ),
                       'options' => array (
                            $mango_font_awsome_list,
                        ),
                        'compiler' => true,
                        'placeholder' => __ ( 'Select an Icon', 'mango' )
                    ),
                    array (
                        'id' => 'mango_header_box_icon_bordered_3',
                        'type' => 'switch',
                        'title' => __ ( 'Use Bordered Icon', 'mango' ),
                        'subtitle' => __('Used in header 8, 11 and 13 only.','mango'),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_header_box_title_3',
                        'type' => 'text',
                        'title' => __ ( 'Box 3 Title', 'mango' ),
                        'placeholder' => __('Box title','mango')
                    ),
                    array (
                        'id' => 'mango_header_box_subtitle_3',
                        'type' => 'text',
                        'title' => __ ( 'Box 3 Sub Title', 'mango' ),
                        'placeholder' => __('Box Sub title','mango')
                    ),
                    /*array (
                        'id' => 'mango_header_box_custom_3',
                        'type' => 'switch',
                        'title' => __ ( 'Use Custom Style', 'mango' ),
                        'subtitle' => __('Used in header 13 only.','mango'),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ), */
                )
            );
           // Breadcrumbs And Tilte Settings
            $this->sections[] = array (
                'icon' => 'el-icon-minus',
                'icon_class' => 'icon',
                'title' => __('Title and Breadcrumbs','mango'),
                'fields' => array (
                    array (
                        'id' => 'mango_hide_breadcrumb',
                        'type' => 'switch',
                        'title' => __('Hide Breadcrumbs','mango'),
                        'compiler' => true,
                        'default' => '0',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_hide_page_title',
                        'type' => 'switch',
                        'title' => __('Hide Title','mango'),
                        'compiler' => true,
                        'default' => '0',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'breadcrumbs-separator',
                        'type' => 'select',
                        'title' => __('Separator','mango'),
                        'compiler' => true,
                        'options' => array ( '>' => '>', '<' => '<', '|' => '|', '/' => '/' ),
                        'default' => '>',
                        'select2' => array ( 'allowClear' => false )
                    ),
                    array (
                        'id' => 'mango_breadcrumb_title_position',
                        'type' => 'button_set',
                        'title' => __('Breadcrumb and Title Position','mango'),
                        'compiler' => true,
                        'options' => array (
                            'text-left' => __ ( 'Left', 'mango' ),
                            'text-center' => __ ( 'Center', 'mango' ),
                            'text-right' => __ ( 'Right', 'mango' ),
                        ),
                        'default' => 'left',
                    ),
                    array (
                        'id' => 'mango_breadcrumb_use_full',
                        'type' => 'switch',
                        'title' => __('Use 2 Columns','mango'),
                        'compiler' => true,
                        'default' => '0',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_bread_title_size',
                        'type' => 'button_set',
                        'title' => __('Breadcrumb and Title Size','mango'),
                        'compiler' => true,
                        'options' => array (
                            'small' => 'Small',
                            'larger' => 'Medium',
                            'largest' => 'Large'
                        ),
                        'default' => 'small',
                    )
                )
            );
            //Body Settings
            $this->sections[] = array (
                'title' => __ ( 'Body, Page', 'mango' ),
                'icon' => 'el-icon-laptop',
                'fields' => array (
                   array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'title' => __ ( 'Page Layout', 'mango' ),
                        'desc' => __ ( 'Select default page layout for the theme', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_page_layout',
                        'type' => 'image_select',
                        'title' => __ ( 'Page Layout', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                            'no' => array (
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1c.png'
                            ),
                            'left' => array (
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'right' => array (
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            ),
                            'both' => array (
                                'alt' => 'Both Sidebars',
                                'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                            ),
                        ),
                        'default' => 'left'
                    ),
                    array (
                        'id' => 'mango_page_sidebar_left',
                        'type' => 'select',
                        'title' => __ ( 'Page Left Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'select2' => array ( 'allowClear' => false ),
                        'default' => 'page-sidebar-1',
                        'required' => array ( "mango_page_layout", "=", array ( "left", "both" ) )
                    ),
                    array (
                        'id' => 'mango_page_sidebar_right',
                        'type' => 'select',
                        'select2' => array ( 'allowClear' => false ),
                        'title' => __ ( 'Page Right Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'default' => 'page-sidebar-2',
                        'required' => array ( "mango_page_layout", "=", array ( "right", "both" ) )
                    ),
                   array (
                       'id' => 'page-comment',
                        'type' => 'switch',
                        'title' => __('Show Comment Form on Page','mango'),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'desc' => __ ( 'Coming Soon', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_coming_soon_mode',
                        'type' => 'switch',
                        'title' => __ ( 'Coming Soon Mode', 'mango' ),
                        'compiler' => true,
                        'default' => '0',
                        'on' => __('Activate','mango'),
                        'off' => __('Deactivate','mango'),
                    ),
                   array (
                        'id' => 'mango_coming_soon_page',
                        'type' => 'select',
                        'select2' => array ( 'allowClear' => false ),
                        'title' => __ ( 'Select Coming Soon Page', 'mango' ),
                        'compiler' => true,
                        'desc' => __ ( 'Pages That has Coming Soon Template', 'mango' ),
                        'options' => mango_get_coming_soon_pages (),
                        'required' => array ( "mango_coming_soon_mode", "=", 1 )
                    ),
                   array (
                       'id' => 'info_warning',
                        'type' => 'info',
                        'desc' => __ ( 'Social Share Plugin', 'mango' ),
                   ),
                   array (
                        'id' => 'mango_social_share',
                        'type' => 'select',
                        'title' => __('Hide Social Share','mango'),
                        'desc' => __('select Post Type on which you want to hide social share plugin.Works only if the Font Awesome share Icons plugin is active','mango'),
                        'compiler' => true,
                        'placeholder' => __('Select post Types','mango'),
                        'data' => 'post_types',
                        'multi' => true
                    ),
                   array (
                       'id' => 'mango_social_share_label',
                      'type' => 'textarea',
                        'title' => __('Social Share Label','mango'),
                        'compiler' => true,
                        'allowed_html' => array ( 'a', 'span', 'em', 'strong' ),
                        'placeholder' => __('Social Share Label','mango'),
                        'validate' => 'html',
                        'default' => 'Share social:',
                    ),
                )
            );
           //Footer Settings
            $this->sections[] = array (
                'title' => __ ( 'Footer', 'mango' ),
                'icon' => 'el-icon-website',
                'fields' => array (
                    array (
                        'id' => 'mango_footer_type',
                        'type' => 'image_select',
                        'title' => __ ( 'Select Footer Type', 'mango' ),
                        'compiler' => true,
                        'default' => 1,
                        'options' => array (
                            '1' => array (
                                'alt' => 'Footer 1',
                                'img' => mango_uri . '/images/footers/Footer1.png'
                            ),
                            '2' => array (
                                'alt' => 'Footer 2',
                                'img' => mango_uri . '/images/footers/Footer2.png'
                            ),
                            '3' => array (
                                'alt' => 'Footer 3',
                                'img' => mango_uri . '/images/footers/Footer3.png'
                            ),
                            '4' => array (
                                'alt' => 'Footer 4',
                                'img' => mango_uri . '/images/footers/Footer4.png'
                            ),
                            '5' => array (
                                'alt' => 'Footer 5',
                                'img' => mango_uri . '/images/footers/Footer5.png'
                            ),
                            '6' => array (
                                'alt' => 'Footer 6',
                                'img' => mango_uri . '/images/footers/Footer6.png'
                            ),
                            '7' => array (
                                'alt' => 'Footer 7',
                                'img' => mango_uri . '/images/footers/Footer7.png'
                            ),
                            '8' => array (
                                'alt' => 'Footer 8',
                                'img' => mango_uri . '/images/footers/Footer8.png'
                            ),
                            '9' => array (
                                'alt' => 'Footer 9',
                                'img' => mango_uri . '/images/footers/Footer9.png'
                            ),
                            '10' => array (
                                'alt' => 'Footer 10',
                                'img' => mango_uri . '/images/footers/Footer10.png'
                            ),
                            '11' => array (
                                'alt' => 'Footer 11',
                                'img' => mango_uri . '/images/footers/Footer11.png'
                            ),
                        ),
                    ),
                    array (
                        'id' => 'mango_top_footer_widget_columns',
                        'type' => 'image_select',
                        'title' => __ ( 'Top Footer Widgets Columns', 'mango' ),
                        'compiler' => true,
                        'default' => '3',
                        'options' => array (
                            '1' => array (
                                'alt' => __ ( '1 Column', 'mango' ),
                                'img' => mango_uri . '/images/default/1col.png'
                            ),
                            '2' => array (
                                'alt' => __ ( '2 Columns', 'mango' ),
                                'img' => mango_uri . '/images/default/2col.png'
                            ),
                            '3' => array (
                                'alt' => __ ( '3 Columns', 'mango' ),
                                'img' => mango_uri . '/images/default/3col.png'
                            ),
                            '4' => array (
                                'alt' => __ ( '4 Columns', 'mango' ),
                                'img' => mango_uri . '/images/default/4col.png'
                            )
                        ),
                        'description' => __('Used in footer 1,2,6 and 7.','mango'),
                    ),
                    array (
                        'id' => 'mango_top_footer_widget_v2_columns',
                        'type' => 'image_select',
                        'title' => __ ( 'Top Footer Widgets v2 Columns', 'mango' ),
                        'compiler' => true,
                        'default' => '3',
                        'options' => array (
                            '1' => array (
                                'alt' => __ ( '1 Column', 'mango' ),
                                'img' => mango_uri . '/images/default/1col.png'
                            ),
                            '2' => array (
                                'alt' => __ ( '2 Columns', 'mango' ),
                                'img' => mango_uri . '/images/default/2col.png'
                            ),
                            '3' => array (
                                'alt' => __ ( '3 Columns', 'mango' ),
                                'img' => mango_uri . '/images/default/3col.png'
                            ),
                            '4' => array (
                                'alt' => __ ( '4 Columns', 'mango' ),
                                'img' => mango_uri . '/images/default/4col.png'
                            )
                        ),
                        'description' => __('Used in footer 9,10 and 11.','mango'),
                    ),
                    array (
                        'id' => 'mango_footer_widget_columns',
                        'type' => 'image_select',
                        'title' => __ ( 'Footer Widget Columns', 'mango' ),
                        'compiler' => true,
                        'default' => '5',
                        'options' => array (
                            '1' => array (
                                'alt' => __ ( '1 Column', 'mango' ),
                                'img' => mango_uri . '/images/default/1col.png'
                            ),
                            '2' => array (
                                'alt' => __ ( '2 Columns', 'mango' ),
                                'img' => mango_uri . '/images/default/2col.png'
                            ),
                            '3' => array (
                                'alt' => __ ( '3 Columns', 'mango' ),
                                'img' => mango_uri . '/images/default/3col.png'
                            ),
                            '4' => array (
                                'alt' => __ ( '4 Columns', 'mango' ),
                                'img' => mango_uri . '/images/default/4col.png'
                            ),
                            '5' => array (
                                'alt' => __ ( '4 Columns', 'mango' ),
                                'img' => mango_uri . '/images/default/5col.png'
                            )
                        ),
                        'description' => __('Used in footer 1,2,6,7 and 8','mango'),
                    ),
                    array (
                        'id' => 'mango_hide_footer_top_widgets',
                        'type' => 'switch',
                        'title' => __ ( 'Hide Footer Top Widgets', 'mango' ),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                        'description' => __('Used in footer 1,2,6 and 7.','mango'),
                    ),
					
					 array (
                        'id' => 'mango_hide_footer_bottom_widgets',
                        'type' => 'switch',
                        'title' => __ ( 'Hide Footer Bottom Widgets', 'mango' ),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                        'description' => __('Used in footer 1,2,6 and 7.','mango'),
                    ),

                    array (
                        'id' => 'mango_hide_footer_menu',
                        'type' => 'switch',
                        'title' => __ ( 'Hide Footer Menu', 'mango' ),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_copyright',
                        'type' => 'textarea',
                        'title' => __ ( 'Copyright Text', 'mango' ),
                        'default' => 'Created with by <a href="#">SW theme</a>. All right reserved',
                        'compiler' => true,
                        'validate' => 'html_custom',
                        'allowed_html' => array (
                            'a' => array (
                                'href' => array (),
                                'title' => array ()
                            ),
                            'br' => array (),
                            'em' => array (),
                            'strong' => array (),
                            'span' => array ()
                        ),
                        'desc' => __ ( 'HTML allowed tags a, br, em, strong, span (color white is applied to span text)', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_hide_payments',
                        'type' => 'switch',
                        'title' => __ ( 'Hide Payments Image', 'mango' ),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_payments_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Payments Image','mango'),
                        'compiler' => true,
                        'default' => array (
                            'url' => get_template_directory_uri () . '/images/default/payments.png',
                        )
                    ),
                )
            );
            //blog and single post
            $this->sections[] = array (
                'icon' => 'el-icon-blogger',
                'title' => __ ( 'Blog & Single Post', 'mango' ),
                'fields' => array (
                    // blog options
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'desc' => __ ( 'Blog Options', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_blog_layout',
                        'type' => 'image_select',
                        'title' => __ ( 'Blog Layout', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                            'no' => array (
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1c.png'
                            ),
                            'left' => array (
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'right' => array (
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            ),
                            'both' => array (
                                'alt' => 'Both Sidebars',
                                'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                            ),
                        ),
                        'default' => 'left'
                    ),
                    array (
                        'id' => 'mango_blog_sidebar_left',
                        'type' => 'select',
                        'title' => __ ( 'Blog Left Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'select2' => array ( 'allowClear' => false ),
                        'default' => 'blog-sidebar-1',
                        'required' => array ( "mango_blog_layout", "=", array ( "left", "both" ) )
                    ),
                    array (
                        'id' => 'mango_blog_sidebar_right',
                        'type' => 'select',
                        'select2' => array ( 'allowClear' => false ),
                        'title' => __ ( 'Blog Right Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'default' => 'blog-sidebar-2',
                        'required' => array ( "mango_blog_layout", "=", array ( "right", "both" ) )
                    ),
                    array (
                        'id' => 'mango_blog_type',
                        'type' => 'button_set',
                        'title' => __('Blog Type','mango'),
                        'compiler' => true,
                        'options' => array (
                            'classic' => __ ( 'Classic(Default)', "mango" ),
                            'timeline' => __ ( 'Timeline', "mango" ),
                            "blog-masonry" => __ ( "Blog Masonry", "mango" ),
                            "blog-list" => __ ( "Blog List", "mango" )
                        ),
                        'default' => 'classic'
                    ),
                    array (
                        'id' => 'mango_blog_masonry_columns',
                        'type' => 'image_select',
                        'title' => __ ( 'Select Blog Masonry Columns', "mango" ),
                        'compiler' => true,
                        'options' => array (
                            '2' => array (
                                'alt' => '2 Columns',
                                'img' => mango_uri . '/images/default/2col.png',
                            ),
                            "3" => array (
                                'alt' => '3 Columns',
                                'img' => mango_uri . '/images/default/3col.png',
                            ),
                            "4" => array (
                                'alt' => '4 Columns',
                                'img' => mango_uri . '/images/default/4col.png',
                            ),
                            "5" => array (
                                'alt' => '5 Columns',
                                'img' => mango_uri . '/images/default/5col.png',
                            ),
                            "6" => array (
                                'alt' => '6 Columns',
                                'img' => mango_uri . '/images/default/6col.png',
                            ),
                        ),
                        'default' => '3',
                        'required' => array ( 'mango_blog_type', '=', 'blog-masonry' ),
                    ),
                   //skip posts
                    array (
                        'id' => 'mango_exclude_posts',
                        'type' => 'text',
                        'validate' => 'comma_numeric',
                        'title' => __ ( 'Exclude Posts', 'mango' ),
                        'compiler' => true,
                        'description' => __('input post ids comma seperated','mango')
                    ),
                    // blog title
                    array (
                        'id' => 'mango_blog_title',
                        'type' => 'text',
                        'validate' => 'no_html',
                        'title' => __ ( 'Blog Page Title', 'mango' ),
                        'compiler' => true,
                        'default' => 'Blog'
                    ),
                    // blog pagination type
                    array (
                        'id' => 'mango_blog_pagination_type',
                        'type' => 'select',
                        'title' => __ ( 'Pagination Type', 'mango' ),
                        'compiler' => true,
                        'select2' => array ( 'allowClear' => false ),
                        // Must provide key => value pairs for select options
                        'options' => array (
                            'pagination' => 'Pagination',
                            'infinite_scroll' => 'Infinite Scroll',
                        ),
                        'default' => 'pagination'
                    ),
                    // hide blog post title
                    array (
                        'id' => 'mango_hide_blog_post_title',
                        'type' => 'switch',
                        'title' => __ ( 'Hide Blog Posts Title', 'mango' ),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    // hide blog post author
                    array (
                        'id' => 'mango_blog_excerpt',
                        'type' => 'switch',
                        'title' => __('Show Excerpt','mango'),
                        'default' => '0',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_blog_excerpt_length',
                        'type' => 'text',
                        'title' => __('Excerpt Length','mango'),
                        'desc' => __('The number of words','mango'),
                        'default' => '80',
                    ),
                    array (
                        'id' => 'mango_excerpt_type',
                        'type' => 'button_set',
                        'title' => __('Excerpt Type','mango'),
                        'options' => array ( 'text' => 'Text', 'html' => 'HTML' ),
                        'default' => 'html'
                    ),
                    array (
                        'id' => 'mango_hide_blog_post_author',
                        'type' => 'switch',
                        'title' => __ ( 'Hide Blog Posts Author Name', 'mango' ),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_hide_blog_post_category',
                        'type' => 'switch',
                        'title' => __ ( 'Hide Blog Posts Category', 'mango' ),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_hide_blog_post_tags',
                        'type' => 'switch',
                        'title' => __ ( 'Hide Blog Posts Tags', 'mango' ),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'desc' => __ ( 'Single Post Options', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_post_layout',
                        'type' => 'image_select',
                        'title' => __ ( 'Post Layout', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                           'no' => array (
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1c.png'
                            ),
                            'left' => array (
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                           'right' => array (
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                           ),
                          'both' => array (
                                'alt' => 'Both Sidebars',
                                'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                            )
                        ),
                        'default' => 'left'
                    ),
                    array (
                        'id' => 'mango_post_sidebar_left',
                        'type' => 'select',
                        'title' => __ ( 'Post Left Sidebar', 'mango' ),
                        'compiler' => true,
                        'select2' => array ( 'allowClear' => false ),
                        'options' => $mango_sidebar,
                        'default' => 'single-post-sidebar',
                        'required' => array ( "mango_post_layout", "=", array ( "left", "both" ) )
                    ),
                    array (
                       'id' => 'mango_post_sidebar_right',
                        'type' => 'select',
                        'select2' => array ( 'allowClear' => false ),
                        'title' => __ ( 'Post Right Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'default' => 'single-post-sidebar',
                        'required' => array ( "mango_post_layout", "=", array ( "right", "both" ) )
                    ),
                    //Show Prev/Next Navigation
                    array (
                        'id' => 'mango_post_page_nav',
                        'type' => 'switch',
                        'title' => __ ( 'Show Prev/Next Navigation', 'mango' ),
                        'compiler' => true,
                        'default' => 1,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),

                    //Show Author Info
                    array (
                        'id' => 'mango_hide_post_author',
                        'type' => 'switch',
                        'title' => __ ( 'Hide Blog Posts Author Name', 'mango' ),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),

                    array (
                        'id' => 'mango_hide_post_category',
                        'type' => 'switch',
                        'title' => __ ( 'Hide Posts Category', 'mango' ),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),

                    array (
                        'id' => 'mango_hide_post_tags',
                        'type' => 'switch',
                        'title' => __ ( 'Hide Posts Tags', 'mango' ),
                        'compiler' => true,
                        'default' => 0,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),

                    //Show Comments
                    array (
                        'id' => 'mango_post_comments',
                        'type' => 'switch',
                        'title' => __ ( 'Show Comments', 'mango' ),
                        'compiler' => true,
                        'default' => 1,
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),

                    //Show Addthis Buttons above Content
                )
            );

            $this->sections[] = array (
                'title' => __ ( 'Portfolio', 'mango' ),
                'icon' => 'el-icon-picture',
                'fields' => array (
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'desc' => __ ( 'Portfolio Options', 'mango' ),
                    ),

                    array (
                        'id' => 'mango_portfolio_layout',
                        'type' => 'image_select',
                        'title' => __ ( 'Portfolio Layout', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                            'no' => array (
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1c.png'
                            ),
                            'left' => array (
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'right' => array (
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            ),
                            'both' => array (
                                'alt' => 'Both Sidebars',
                                'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                            ),
                        ),
                        'default' => 'left'
                    ),

                    array (
                        'id' => 'mango_portfolio_sidebar_left',
                        'type' => 'select',
                        'select2' => array ( 'allowClear' => false ),
                        'title' => __ ( 'Portfolio Left Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'required' => array ( "mango_portfolio_layout", "=", array ( "left", "both" ) )
                    ),

                    array (
                        'id' => 'mango_portfolio_sidebar_right',
                        'type' => 'select',
                        'select2' => array ( 'allowClear' => false ),
                        'title' => __ ( 'Portfolio Right Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'required' => array ( "mango_portfolio_layout", "=", array ( "right", "both" ) )
                    ),

                    array (
                        'id' => 'mango_portfolio_style',
                        'type' => 'button_set',
                        'title' => __ ( 'Portfolio Style', 'mango' ),
                        'options' => array (
                            'default' => __ ( 'Default', 'mango' ),
                            'simple' => __ ( 'Simple', 'mango' ),
                            'custom' => __ ( 'Custom', 'mango' ),
                        ),
                        'default' => 'default'
                    ),

                    array (
                        'id' => 'mango_portfolio_page_style',
                        'type' => 'button_set',
                        'title' => __ ( 'Portfolio Page Style', 'mango' ),
                        'options' => array (
                            'grid' => __ ( 'Grid', 'mango' ),
                            'masonry' => __ ( 'Masonry', 'mango' )
                        ),
                        'default' => 'grid'
                    ),

                    array (
                        'id' => 'mango_portfolio_full_width',
                        'type' => 'button_set',
                        'title' => __ ( 'Use Portfolio Full Width', 'mango' ),
                        'options' => array (
                            'yes' => __ ( 'Yes', 'mango' ),
                            'no' => __ ( 'No', 'mango' )
                        ),
                        'default' => 'no',
                        'description' => __ ( 'If this option is enabled then the sidebars will not work', 'mango' ),
                    ),

                    array (
                        'id' => 'mango_portfolio_columns',
                        'type' => 'image_select',
                        'title' => __ ( 'Select Portfolio Columns', "mango" ),
                        'compiler' => true,
                        'options' => array (
                            '2' => array (
                                'alt' => '2 Columns',
                                'img' => mango_uri . '/images/default/2col.png',
                            ),
                            "3" => array (
                                'alt' => '3 Columns',
                                'img' => mango_uri . '/images/default/3col.png',
                            ),
                            "4" => array (
                                'alt' => '4 Columns',
                                'img' => mango_uri . '/images/default/4col.png',
                            ),
                            "5" => array (
                                'alt' => '5 Columns',
                                'img' => mango_uri . '/images/default/5col.png',
                            ),
                            "6" => array (
                                'alt' => '6 Columns',
                                'img' => mango_uri . '/images/default/6col.png',
                            ),
                        ),
                        'default' => '3',
                    ),
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'desc' => __ ( 'Portfolio Single Options', 'mango' ),
                    ),

                    array (
                        'id' => 'mango_portfolio_single_layout',
                        'type' => 'image_select',
                        'title' => __ ( 'Portfolio Single Layout', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                            'no' => array (
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1c.png'
                            ),
                            'left' => array (
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'right' => array (
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            ),
                            'both' => array (
                                'alt' => 'Both Sidebars',
                                'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                            ),
                        ),
                        'default' => 'left'
                    ),

                    array (
                        'id' => 'mango_portfolio_single_sidebar_left',
                        'type' => 'select',
                        'title' => __ ( 'Portfolio Single Left Sidebar', 'mango' ),
                        'compiler' => true,
                        'select2' => array ( 'allowClear' => false ),
                        'options' => $mango_sidebar,
                        'required' => array ( "mango_portfolio_single_layout", "=", array ( "left", "both" ) )
                    ),

                    array (
                        'id' => 'mango_portfolio_single_sidebar_right',
                        'type' => 'select',
                        'title' => __ ( 'Portfolio Single Right Sidebar', 'mango' ),
                        'compiler' => true,
                        'select2' => array ( 'allowClear' => false ),
                        'options' => $mango_sidebar,
                        'required' => array ( "mango_portfolio_single_layout", "=", array ( "right", "both" ) )
                    ),
                   array (
                        'id' => 'mango_portfolio_single_type',
                        'type' => 'button_set',
                        'title' => __ ( 'portfolio single Page Type', 'mango' ),
                        'options' => array (
                            'boxed' => __ ( 'Boxed', 'mango' ),
                            'full-width' => __ ( 'Full Width', 'mango' ),
                        ),
                        'default' => 'boxed'
                    ),
                   array (
                        'id' => 'mango_portfolio_related_work',
                        'type' => 'switch',
                        'title' => __ ( 'Show Related Work', 'mango' ),
                        'default' => '0',
                        'compiler' => true,
                        'on' =>  __( 'Yes', 'mango' ),
                        'off' => __( 'No', 'mango' ),
                    ),
                   array (
                        'id' => 'mango_portfolio_comment',
                        'type' => 'switch',
                        'title' => __ ( 'Show Comments', 'mango' ),
                        'compiler' => true,
                        'default' => '0',
                        'on' => __ ( 'Yes', 'mango' ),
                        'off' => __ ( 'No', 'mango' ),
                    ),
                )
            );
            $this->sections[] = array (
               'title' => __ ( 'Woocommerce', 'mango' ),
                'icon' => 'el-icon-gift',
                'fields' => array (
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'title' => __ ( 'General Woocommerce Settings', 'mango' )
                    ),
                    array (
                        'id' => 'mango_product_featured_label',
                        'type' => 'switch',
                        'title' => __ ( 'Show Featured Label', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __( 'Yes', 'mango' ),
                        'off' => __( 'No', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_product_featured_label_pos',
                        'type' => 'button_set',
                        'title' => __ ( 'Featured Label Position', 'mango' ),
                        'options' => array (
                            '' => __ ( 'Top Left', 'mango' ),
                            'top-right' => __ ( 'Top Right', 'mango' ),
                            'bottom-left' => __ ( 'Bottom Left', 'mango' ),
                            'bottom-right' => __ ( 'Bottom Right', 'mango' ),
                        ),
                        'default' => '',
                        'required' => array ( 'mango_product_featured_label', '=', '1' )
                    ),
                    array (
                        'id' => 'mango_product_featured_label_type',
                        'type' => 'button_set',
                        'title' => __ ( 'Featured Label Type', 'mango' ),
                        'options' => array (
                            'label-default' => __ ( 'Default', 'mango' ),
                            'label-primary' => __ ( 'Primary', 'mango' ),
                            'label-success' => __ ( 'Success', 'mango' ),
                            'label-info' => __ ( 'Info', 'mango' ),
                            'label-warning' => __ ( 'Warning', 'mango' ),
                            'label-popular' => __ ( 'Popular', 'mango' ),
                            'label-new' => __ ( 'New', 'mango' ),
                        ),
                        'default' => 'label-default',
                        'required' => array ( 'mango_product_featured_label', '=', '1' )
                    ),
                    array (
                        'id' => 'mango_product_featured_label_text',
                        'type' => 'text',
                        'title' => __ ( 'Featured Label Text', 'mango' ),
                        'default' => 'Hot',
                        'required' => array ( 'mango_product_featured_label', '=', '1' )
                    ),
                    array (
                        'id' => 'mango_product_sale_label',
                        'type' => 'switch',
                        'title' => __ ( 'Show Sale Label', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                         'on' => __ ( 'Yes', 'mango' ),
                         'off' => __ ( 'No', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_product_sale_label_pos',
                        'type' => 'button_set',
                        'title' => __ ( 'Sale Label Position', 'mango' ),
                        'options' => array (
                            '' => __ ( 'Top Left', 'mango' ),
                            'top-right' => __ ( 'Top Right', 'mango' ),
                            'bottom-left' => __ ( 'Bottom Left', 'mango' ),
                            'bottom-right' => __ ( 'Bottom Right', 'mango' ),
                        ),
                        'default' => '',
                       'required' => array ( 'mango_product_sale_label', '=', '1' )
                    ),
                    array (
                        'id' => 'mango_product_sale_label_type',
                        'type' => 'button_set',
                        'title' => __ ( 'Sale Label Type', 'mango' ),
                        'options' => array (
                            'label-default' => __ ( 'Default', 'mango' ),
                            'label-primary' => __ ( 'Primary', 'mango' ),
                            'label-success' => __ ( 'Success', 'mango' ),
                            'label-info' => __ ( 'Info', 'mango' ),
                            'label-warning' => __ ( 'Warning', 'mango' ),
                            'label-popular' => __ ( 'Popular', 'mango' ),
                            'label-new' => __ ( 'New', 'mango' ),
                        ),
                        'default' => 'label-default',
                        'required' => array ( 'mango_product_sale_label', '=', '1' )
                    ),
                    array (
                        'id' => 'mango_product_sale_label_text_type',
                        'type' => 'button_set',
                        'title' => __ ( 'Sale Label Text Type', 'mango' ),
                        'options' => array (
                            'custom-text' => __ ( 'Custom Text', 'mango' ),
                            'per_sale_price' => __ ( 'Percentage saved', 'mango' ),
                        ),
                        'default' => 'per_sale_price',
                        'required' => array ( 'mango_product_sale_label', '=', '1' )
                    ),
                    array (
                        'id' => 'mango_product_sale_label_text',
                        'type' => 'text',
                        'title' => __ ( 'Sale Label Text', 'mango' ),
                        'default' => 'Sale',
                        'required' => array ( 'mango_product_sale_label_text_type', '=', 'custom-text' )
                    ),
                    array (
                        'id' => 'mango_product_new_label',
                        'type' => 'switch',
                        'title' => __('Show New Label','mango'),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_product_new_label_time',
                        'type' => 'text',
                        'title' => __ ( 'New Label Time Period', 'mango' ),
                        'default' => '7',
                        'validate' => 'numeric',
                        'desc' => __ ( 'Number Of Days a product remains as new.Default is 7 days.', 'mango' ),
                        'required' => array ( 'mango_product_new_label', '=', '1' )
                    ),
                    array (
                        'id' => 'mango_product_new_label_pos',
                        'type' => 'button_set',
                        'title' => __ ( 'New Label Position', 'mango' ),
                        'options' => array (
                            '' => __ ( 'Top Left', 'mango' ),
                            'top-right' => __ ( 'Top Right', 'mango' ),
                            'bottom-left' => __ ( 'Bottom Left', 'mango' ),
                            'bottom-right' => __ ( 'Bottom Right', 'mango' ),
                        ),
                        'default' => '',
                        'required' => array ( 'mango_product_new_label', '=', '1' )
                    ),
                    array (
                        'id' => 'mango_product_new_label_type',
                        'type' => 'button_set',
                        'title' => __ ( 'New Label Type', 'mango' ),
                        'options' => array (
                            'label-default' => __ ( 'Default', 'mango' ),
                            'label-primary' => __ ( 'Primary', 'mango' ),
                            'label-success' => __ ( 'Success', 'mango' ),
                            'label-info' => __ ( 'Info', 'mango' ),
                            'label-warning' => __ ( 'Warning', 'mango' ),
                            'label-popular' => __ ( 'Popular', 'mango' ),
                            'label-new' => __ ( 'New', 'mango' ),
                        ),
                        'default' => 'label-default',
                        'required' => array ( 'mango_product_new_label', '=', '1' )
                    ),
                    array (
                        'id' => 'mango_product_new_label_text',
                        'type' => 'text',
                        'title' => __ ( 'New Label Text', 'mango' ),
                        'default' => 'New',
                        'required' => array ( 'mango_product_new_label', '=', '1' )
                    ),
                    array (
                        'id' => 'mango_show_add_to_cart_button',
                        'type' => 'switch',
                        'title' => __ ( 'Show Add To Cart', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_send_enquiry',
                        'type' => 'editor',
                        'title' => __ ( 'Send Enquiry', 'mango' ),
                        'desc' =>'Set above "Show Add To Cart" option as "NO" to display Send Enquiry button. Then place your send enquiry shortcode in this field.',
						'default' => 'shortcode',
                    ),
                    array (
                        'id' => 'mango_cart_color',
                        'type' => 'color',
                        'title' => __ ( 'Select Cart Color', 'mango' ),
                        'default' => '#747474',
                        'validate' => 'color',
                    ),
					array (
					'id' => 'mango_cart_icon_select',
					'type' => 'select',
					'class' => 'font-icons',
					'title' => __ ( 'Select Cart Icon', 'mango' ),
					'options' => array (
						$mango_font_awsome_list,
						),
					'default' => 'fa fa-shopping-cart',
					'placeholder' => __ ( 'Select an Icon', 'mango' )
					),

					array (
                        'id' => 'mango_show_quick_button',
                        'type' => 'switch',
                        'title' => __ ( 'Show Quick View', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					
					array (
                        'id' => 'mango_show_price',
                        'type' => 'switch',
                        'title' => __ ( 'Show Product Price', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_show_wishlist_button',
                        'type' => 'switch',
                        'title' => __ ( 'Show Wishlist', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' => __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_show_compare_button',
                        'type' => 'switch',
                        'title' => __ ( 'Show Compare', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_show_product_category',
                        'type' => 'switch',
                        'title' => __ ( 'Show Category', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
                    array (
                        'id' => 'mango_show_product_tags',
                        'type' => 'switch',
                        'title' => __ ( 'Show Tags', 'mango' ),
                        'compiler' => true,
                        'desc' => __ ( 'Tags visible on single product page only', 'mango' ),
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),

					array (
                        'id' => 'mango_show_collapse_tabs',
                        'type' => 'switch',
                        'title' => __ ( 'Show collapse tabs', 'mango' ),
                        'compiler' => true,
						'desc' => __ ( 'Disable the toggle tabs on checkout page', 'mango' ),
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'title' => __ ( 'Shop and Category Page', 'mango' )
                    ),
                    array (
                        'id' => 'mango_products_view',
                        'type' => 'button_set',
                        'title' => __ ( 'Products View', 'mango' ),
                        'options' => array (
                            'grid' => __ ( 'Grid', 'mango' ),
                            'list' => __ ( 'List', 'mango' ),
                        ),
                        'default' => 'grid'
                    ),
                    array (
                        'id' => 'mango_products_grid_version',
                        'type' => 'select',
                        'title' => __ ( 'Select Grid Style', 'mango' ),
                        'options' => array (
                            'v_1' => __ ( 'Version 1', 'mango' ),
                            'v_2' => __ ( 'Version 2', 'mango' ),
                            'v_3' => __ ( 'Version 3', 'mango' ),
                            'v_4' => __ ( 'Version 4', 'mango' ),
                        ),
                        'default' => 'v_1',
                        'select2' => array ( 'allowClear' => false )
                    ),
                    array (
                        'id' => 'mango_products_list_version',
                        'type' => 'select',
                        'title' => __ ( 'Select List Style', 'mango' ),
                        'options' => array (
                            'list' => __ ( 'List Left Aligned', 'mango' ),
                            'list_right' => __ ( 'List Right Aligned', 'mango' ),
                        ),
                        'default' => 'list',
                        'select2' => array ( 'allowClear' => false )
                    ),
                    array (
                        'id' => 'mango_products_grid_columns',
                        'type' => 'select',
                        'title' => __ ( 'Select Grid Columns', 'mango' ),
                        'options' => array (
                            '1' => "1",
                            '2' => "2",
                            '3' => "3",
                            '4' => "4",
                            '5' => "5",
                            '6' => "6",
                        ),
                        'select2' => array ( 'allowClear' => false ),
                        'default' => '4'
                    ),
                    array (
                        'id' => 'mango_products_perpage',
                        'type' => 'text',
                        'title' => __ ( 'Products per Page', 'mango' ),
                        'compiler' => true,
                        'validate' => 'comma_numeric',
                        'description' => __ ( 'Comma-seperated. Default: 9,15,30', 'mango' ),
                        'default' => '9,15,30'
                    ),
                    array (
                        'id' => 'mango_shop_layout',
                        'type' => 'image_select',
                        'title' => __ ( 'Shop Page Layout', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                            'no' => array (
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1c.png'
                            ),
                            'left' => array (
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'right' => array (
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            ),
                            'both' => array (
                                'alt' => 'Both Sidebars',
                                'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                            ),
                        ),
                        'default' => 'left'
                    ),
                    array (
                        'id' => 'mango_shop_sidebar_left',
                        'type' => 'select',
                        'title' => __ ( 'Shop Page Left Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'select2' => array ( 'allowClear' => false ),
                        'default' => 'page-sidebar-1',
                        'required' => array ( "mango_shop_layout", "=", array ( "left", "both" ) )
                    ),
                    array (
                        'id' => 'mango_shop_sidebar_right',
                        'type' => 'select',
                        'title' => __ ( 'Shop Page Right Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'default' => 'page-sidebar-2',
                        'select2' => array ( 'allowClear' => false ),
                        'required' => array ( "mango_shop_layout", "=", array ( "right", "both" ) )
                    ),
					
					
					 array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'title' => __ ( ' Filter Sidebar for Shop Page', 'mango' )
                    ),
					
					array (
                        'id' => 'mango_sidefilter_layout',
                        'type' => 'image_select',
                        'title' => __ ( 'Filter Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                           
                            'left' => array (
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'right' => array (
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            ),
                           
                        ),
                        'default' => 'left'
                    ),
					
					 array (
                        'id' => 'mango_sidebar_filter_left',
                        'type' => 'select',
                        'title' => __ ( 'Filter Left Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'default' => 'single-product-sidebar',
                        'select2' => array ( 'allowClear' => false ),
                        'required' => array ( "mango_sidefilter_layout", "=", array ( "left", "both" ) )
                    ),
					
					array (
                        'id' => 'mango_sidebar_filter_right',
                        'type' => 'select',
                        'title' => __ ( 'Filter Right Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'default' => 'single-product-sidebar',
                        'select2' => array ( 'allowClear' => false ),
                        'required' => array ( "mango_sidefilter_layout", "=", array ( "right", "both" ) )
                   ),
				   
					
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'title' => __ ( 'Product Page', 'mango' )
                    ),
					
					array (
                        'id' => 'mango_hide_next_prev',
                        'type' => 'switch',
                        'title' => __ ( 'Hide Next Previous Navigation', 'mango' ),
                        'compiler' => true,
						'desc' => __ ( 'Hide the Next Previous Navigation in single Product', 'mango' ),
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),

                    ),
                    array (
                        'id' => 'mango_product_page_style',
                        'type' => 'select',
                        'title' => __ ( 'Product Page Style', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                            'v_1' => __ ( 'Style 1', 'mango' ),
                            'v_2' => __ ( 'Style 2', 'mango' ),
							'v_3' => __ ( 'Style 3', 'mango' ),
                        ),
                        'default' => 'v_1',
                        'select2' => array ( 'allowClear' => false ),
                        'desc' => __ ( 'Choose Style for the product page. Default is style 1', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_product_layout',
                        'type' => 'image_select',
                        'title' => __ ( 'Product Page Layout', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                            'no' => array (
                                'alt' => 'Full Width',
                                'img' => ReduxFramework::$_url . 'assets/img/1c.png'
                            ),
                            'left' => array (
                                'alt' => 'Left Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                            ),
                            'right' => array (
                                'alt' => 'Right Sidebar',
                                'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                            ),
                            'both' => array (
                                'alt' => 'Both Sidebars',
                                'img' => ReduxFramework::$_url . 'assets/img/3cm.png'
                            ),
                        ),
                        'default' => 'left'
                    ),
                    array (
                        'id' => 'mango_product_sidebar_left',
                        'type' => 'select',
                        'title' => __ ( 'Product Page Left Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'default' => 'single-product-sidebar',
                        'select2' => array ( 'allowClear' => false ),
                        'required' => array ( "mango_product_layout", "=", array ( "left", "both" ) )
                    ),
                    array (
                        'id' => 'mango_product_sidebar_right',
                        'type' => 'select',
                        'title' => __ ( 'Product Page Right Sidebar', 'mango' ),
                        'compiler' => true,
                        'options' => $mango_sidebar,
                        'default' => 'single-product-sidebar',
                        'select2' => array ( 'allowClear' => false ),
                        'required' => array ( "mango_product_layout", "=", array ( "right", "both" ) )
                   ),
                    array (
                        'id' => 'mango_product_bottom_products',
                        'type' => 'sortable',
                        'title' => __ ( 'Select Product Types To Show at the bottom of Product', 'mango' ),
                        'compiler' => true,
                        'mode' => 'checkbox',
                        'options' => array (
                            'Featured' => __ ( 'Featured Products', 'mango' ),
                            'Popular' => __ ( 'Popular Products', 'mango' ),
                            'TopRated' => __ ( 'Top Rated Products', 'mango' ),
                            'Latest' => __ ( 'Latest Products', 'mango' )
                        ),
                    ),
					array (
                        'id' => 'mango_zoomer_active',
                        'type' => 'switch',
                        'title' => __ ( 'Zoomer Image', 'mango' ),
						 'desc' => __ ( 'Enable or Disable the Zoomer on product page', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Enable','mango'),
                        'off' =>  __('Disable','mango'),
                    ),
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'title' => __ ( 'Cart Page', 'mango' )
                    ),
                    array (
                        'id' => 'mango_woo_cart_ver',
                        'type' => 'button_set',
                        'title' => __ ( 'Cart Page Version', 'mango' ),
                        'compiler' => true,
                        'options' => array (
                            'v_1' => __ ( 'Version 1', 'mango' ),
                            'v_2' => __ ( 'Version 2', 'mango' ),
                        ),
                        'default' => 'v_1',
                    ),
                )
            );
			
				if ( class_exists('WC_Vendors') ) {
			 $this->sections[] = array (
               'title' => __ ( 'Wc Vendor', 'mango' ),
                'icon' => 'el el-usd',
                'fields' => array (
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'title' => __ ( 'General Wc Vendor Shop Settings', 'mango' )
                    ),
					
					/*array (
                        'id' => 'mango_wc_background',
                        'type' => 'background',
                        'title' => __ ( 'Shop Header Background', 'mango' ),
                        'preview_media' => true,
                        'default' => array (
                         'background-color' => '#dd3333',
                        )
                    ),*/
					
					array (
                        'id' => 'mango_wcvendors_phone',
                        'type' => 'switch',
                        'title' => __ ( 'Select Vendor Phone Number', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					
					
				
					
					
					array (
                        'id' => 'mango_wcvendors_email',
                        'type' => 'switch',
                        'title' => __ ( 'Show Vendor Email', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					
					array (
                        'id' => 'mango_wcvendors_url',
                        'type' => 'switch',
                        'title' => __ ( 'Show Vendor URL', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					
					
					
					  array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'title' => __ ( 'WC Vendors - Shop Page', 'mango' )
                    ),
				
					
					
					
					
					array (
                        'id' => 'mango_wcvendors_shop_description',
                        'type' => 'switch',
                        'title' => __ ( 'Vendor Description on Top of Shop Page', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
						
				  
					
					array (
                        'id' => 'mango_wcvendors_shop_avatar',
                        'type' => 'switch',
                        'title' => __ ( 'Show Vendor Avatar in Vendor Description', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					

					array (
                        'id' => 'mango_wcvendors_shop_profile',
                        'type' => 'switch',
                        'title' => __ ( 'Show Social and Contact Info in Vendor Description', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					
					
					
					array (
                        'id' => 'mango_wcvendors_shop_soldby',
                        'type' => 'switch',
                        'title' => __ ( 'Sold by" at Product List', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					
					
					 array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'title' => __ ( 'WC Vendors - Single Product Page', 'mango' )
                    ),

					
                  array (
                        'id' => 'mango_single_wcvendors_hide_header',
                        'type' => 'switch',
                        'title' => __ ( 'Vendor Single Product Page Show Header', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					
					array (
                        'id' => 'mango_single_wcvendors_product_description',
                        'type' => 'switch',
                        'title' => __ ( 'Vendor Description on Top of Single Product Page', 'mango' ),
                        'compiler' => true,
                        'default' => '0',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					
					
					
					array (
                        'id' => 'mangowcvendors_product_avatar',
                        'type' => 'switch',
                        'title' => __ ( 'Show Vendor Avatar in Vendor Description', 'mango' ),
                        'compiler' => true,
                        'default' => '0',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					

					array (
                        'id' => 'mango_wcvendors_product_profile',
                        'type' => 'switch',
                        'title' => __ ( 'Show Social and Contact Info in Vendor Description', 'mango' ),
                        'compiler' => true,
                        'default' => '0',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					
					array (
                        'id' => 'mango_wcvendors_product_tab',
                        'type' => 'switch',
                        'title' => __ ( '"Seller Info" at Product Tab', 'mango' ),
                        'compiler' => true,
                        'default' => '0',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					
					
					array (
                        'id' => 'mango_wcvendors_product_moreproducts',
                        'type' => 'switch',
                        'title' => __ ( '"More From This Seller" Products', 'mango' ),
                        'compiler' => true,
                        'default' => '0',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					
					
					array (
                        'id' => 'mango_wcvendors_product_soldby',
                        'type' => 'switch',
                        'title' => __ ( 'Sold by" at Product Meta', 'mango' ),
                        'compiler' => true,
                        'default' => '0',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					
					 array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'title' => __ ( 'WC Vendors - Cart Page', 'mango' )
                    ),
					
				
					
					array (
                        'id' => 'mango_wcvendors_cartpage_soldby',
                        'type' => 'switch',
                        'title' => __ ( '"Sold by" at Cart page', 'mango' ),
                        'compiler' => true,
                        'default' => '1',
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    )

						
					),
					);
					
				}
            $this->sections[] = array (
                'title' => __ ( '404 Page', 'mango' ),
                'icon' => 'el-icon-ban-circle',
                'fields' => array (
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'desc' => __ ( 'Add 404 Content Here.', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_404_title',
                        'type' => 'text',
                        'compiler' => true,
                        'title' => __ ( '404 Page Title', 'mango' ),
                        'placeholder' => __ ( '404 Page Title', 'mango' ),
                        'default' => '404'
                    ),
                    array (
                        'id' => 'mango_404_subtitle',
                        'type' => 'text',
                        'compiler' => true,
                        'title' => __ ( '404 Page Sub Title', 'mango' ),
                        'placeholder' => __ ( '404 Page Sub Title', 'mango' ),
                        'default' => __ ( "Page Not Found", 'mango' )
                    ),
                    array (
                        'id' => 'mango_404_content',
                        'type' => 'editor',
                        'compiler' => true,
                        'default' => __ ( 'The page you requested does not exist. <a href="#" title="Homepage">Click here</a> to continue shopping.', 'mango' ),
                        'title' => __ ( '404 Page Content', 'mango' )
                    ),
                )
            );
            $this->sections[] = array (
                'title' => __ ( 'Contact', 'mango' ),
                'icon' => 'el-icon-phone-alt',
                'fields' => array (
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'desc' => __ ( 'Add Your Address here. This will be added into the contact template of your theme.', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_google_map_address',
                        'type' => 'textarea',
                        'compiler' => true,
                        'title' => __ ( 'Google Map Address', 'mango' ),
                        'placeholder' => __ ( 'Your Address Here', 'mango' )
                    ),
                    array (
                        'id' => 'mango_map_social_icons',
                        'type' => 'switch',
                        'title' => __ ( 'Show Social Icons', 'mango' ),
                        'compiler' => true,
                        'default' => 1,
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
					array (
                        'id' => 'mango_show_maps',
                        'type' => 'switch',
                        'title' => __ ( 'Show Map', 'mango' ),
                        'compiler' => true,
						'default' => 1,
                        'on' => __('Yes','mango'),
                        'off' =>  __('No','mango'),
                    ),
                )
            );
           $this->sections[] = array (
                'title' => __ ( 'Social Links', 'mango' ),
                'icon' => 'el-icon-group',
                'fields' => array (
                    array (
                        'id' => 'info_warning',
                        'type' => 'info',
                        'desc' => __ ( 'Icons that you want to hide, just leave their fields empty.', 'mango' ),
                    ),
                    array (
                        'id' => 'mango_mail',
                        'type' => 'text',
                        'title' => __ ( 'Email', 'mango' ),
                        'validate' => 'email',
                        'compiler' => true,
                        'placeholder' => 'info@company.com'
                    ),
                    array (
                        'id' => 'mango_fb',
                        'type' => 'text',
                        'title' => __ ( 'Facebook', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'https://www.facebook.com/'
                    ),
                    array (
                        'id' => 'mango_twitter',
                        'type' => 'text',
                        'title' => __ ( 'Twitter', 'mango' ),
                        'validate' => 'url',
                        'compiler' => true,
                        'placeholder' => 'https://www.twitter.com/'
                    ),
                    array (
                        'id' => 'mango_gmail',
                        'type' => 'text',
                        'validate' => 'url',
                        'title' => __ ( 'Google+', 'mango' ),
                        'compiler' => true,
                        'placeholder' => 'https://plus.google.com/'
                    ),
                    array (
                        'id' => 'mango_li',
                        'type' => 'text',
                        'validate' => 'url',
                        'title' => __ ( 'LinkedIn', 'mango' ),
                        'compiler' => true,
                        'placeholder' => 'http://www.linkedin.com/'
                    ),
                    array (
                        'id' => 'mango_pin',
                        'type' => 'text',
                        'title' => __ ( 'Pinterest', 'mango' ),
                        'validate' => 'url',
                        'compiler' => true,
                        'placeholder' => 'http://pinterest.com/'
                    ),
                    array (
                        'id' => 'mango_vimeo',
                        'type' => 'text',
                        'title' => __ ( 'Vimeo', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'http://vimeo.com/'
                    ),
                    array (
                       'id' => 'mango_youtube',
                        'type' => 'text',
                        'title' => __ ( 'Youtube', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'http://www.youtube.com/'
                    ),
                    array (
                        'id' => 'mango_flickr',
                        'type' => 'text',
                        'title' => __ ( 'Flickr', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'http://www.flickr.com/'
                    ),
                    array (
                        'id' => 'mango_instagram',
                        'type' => 'text',
                        'title' => __ ( 'Instagram', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'https://instagram.com/'
                    ),
                    array (
                        'id' => 'mango_behance',
                        'type' => 'text',
                        'title' => __ ( 'Behance', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'https://www.behance.net/'
                    ),
                    array (
                        'id' => 'mango_dribbble',
                        'type' => 'text',
                        'title' => __ ( 'Dribbble', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'https://dribbble.com/'
                    ),
                    array (
                        'id' => 'mango_skype',
                        'type' => 'text',
                        'title' => __ ( 'Skype ', 'mango' ),
                        'compiler' => true,
                        'validate_callback' => 'mango_validate_skype_username',
                        'placeholder' => 'skype username'
                    ),
                    array (
                        'id' => 'mango_skype_tell',
                        'type' => 'text',
                        'title' => __ ( 'Skype Number', 'mango' ),
                        'compiler' => true,
                        'validate_callback' => 'mango_validate_skype_number',
                       'placeholder' => '+1234567789',
                        //    'default'  => '+123456789'
                    ),
                    array (
                        'id' => 'mango_soundcloud',
                        'type' => 'text',
                        'title' => __ ( 'Soundcloud', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'https://soundcloud.com/'
                    ),
                    array (
                        'id' => 'mango_yelp',
                        'type' => 'text',
                        'title' => __ ( 'Yelp', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'http://www.yelp.com/'
                    ),
                    array (
                        'id' => 'mango_tumblr',
                        'type' => 'text',
                        'title' => __ ( 'Tumblr', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'https://www.tumblr.com/'
                    ),
                    array (
                        'id' => 'mango_deviantart',
                        'type' => 'text',
                        'title' => __ ( 'Deviantart', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'http://www.deviantart.com/'
                    ),
                    array (
                        'id' => 'mango_weibo',
                        'type' => 'text',
                        'title' => __ ( 'Weibo', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'http://weibo.com/'
                    ),
                    array (
                        'id' => 'mango_github',
                        'type' => 'text',
                        'title' => __ ( 'Github', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'https://github.com/'
                    ),
                    array (
                        'id' => 'mango_slideshare',
                        'type' => 'text',
                        'title' => __ ( 'Slideshare', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'http://www.slideshare.net/'
                    ),
                    array (
                        'id' => 'mango_reddit',
                        'type' => 'text',
                        'title' => __ ( 'Reddit', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'http://www.reddit.com/'
                   ),
                    array (
                        'id' => 'mango_digg',
                        'type' => 'text',
                        'title' => __ ( 'Digg', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'http://digg.com/'
                    ),
                    array (
                        'id' => 'mango_xing',
                        'type' => 'text',
                        'title' => __ ( 'Xing', 'mango' ),
                        'compiler' => true,
                        'validate' => 'url',
                        'placeholder' => 'http://xing.com/'
                    ),
                )
            );
            $this->sections[] = array (
                'title' => __ ( 'Import / Export', 'mango' ),
                'desc' => __ ( 'Import and Export your settings from file, text or URL.', 'mango' ),
                'icon' => 'el-icon-refresh',
                'fields' => array (
                    array (
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => __('Import Export','mango'),
                        'subtitle' => __('Save and restore your Redux options','mango'),
                        'full_width' => false,
                    ),
                ),
            );
            $this->sections[] = array (
                'type' => 'divide',
            );
            if ( file_exists ( trailingslashit ( mango_inc . '/admin/README.html' ) ) ){
                $tabs[ 'docs' ] = array (
                    'icon' => 'el-icon-book',
                    'title' => __ ( 'Documentation', 'mango' ),
                    //'content' => nl2br ( $wp_filesystem->get_contents(trailingslashit ( mango_inc . '/admin/README.html') )
                    'content' => nl2br ( file_get_contents ( trailingslashit ( mango_inc . '/admin/README.html' ) ) )
                );
            }
        }
        public function setHelpTabs () {
        }
        /**
         *
         * All the possible arguments for Redux.

         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */

        public function setArguments () {
            $theme = wp_get_theme (); // For use with some settings. Not necessary.
            $this->args = array (
                'opt_name' => 'mango_settings',
                'display_name' => $theme->get ( 'Name' ) . ' ' . 'Settings',
                'display_version' => $theme->get ( 'Version' ),
                'menu_type' => 'menu',
                'allow_sub_menu' => true,
                'menu_title' => __ ( 'Theme Options', 'mango' ),
                'page_title' => __ ( 'Theme Options', 'mango' ),
                'google_api_key' => '',
                'async_typography' => false,
                'admin_bar' => true,
                'global_variable' => '',
                'dev_mode' => false,
                'customizer' => true,
                 'page_priority' => null,
                'page_parent' => 'themes.php',
                'page_permissions' => 'manage_options',
                'menu_icon' => '',
                'last_tab' => '',
                'page_icon' => 'icon-themes',
                'page_slug' => 'mango_options',
                'save_defaults' => true,
                'default_show' => false,
                'default_mark' => '',
                'show_import_export' => true,
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                'output_tag' => true,
                // 'footer_credit'     => '',
                'database' => '',
                'system_info' => false,
                'class' => 'mango_settings-panel',
                'hints' =>
                    array (
                        'icon' => 'el-icon-question',
                        'icon_position' => 'right',
                        'icon_size' => 'normal',
                        'tip_style' =>
                            array (
                                'color' => 'light',
                                'shadow' => '1',
                                'rounded' => '1',
                                'style' => 'bootstrap',
                            ),
                        'tip_position' =>
                            array (
                                'my' => 'top left',
                                'at' => 'bottom right',
                            ),
                        'tip_effect' =>
                            array (
                                'show' =>
                                    array (
                                        'effect' => 'fade',
                                        'duration' => '500',
                                        'event' => 'mouseover',
                                    ),
                                'hide' =>
                                    array (
                                        'effect' => 'fade',
                                        'duration' => '500',
                                        'event' => 'mouseleave unfocus',
                                    ),
                            ),
                    ),
            );

            $theme = wp_get_theme (); // For use with some settings. Not necessary.
            $this->args[ "display_name" ] = $theme->get ( "Name" );
            $this->args[ "display_version" ] = $theme->get ( "Version" );
           // $this->args[ "dev_mode" ]  = false;
            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            $this->args[ 'share_icons' ][] = array (
                'url' => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => __('Visit us on GitHub','mango'),
                'icon' => 'el-icon-github'
                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args[ 'share_icons' ][] = array (
                'url' => 'https://www.facebook.com/pages/mango/243141545850368',
                'title' => __('Like us on Facebook','mango'),
                'icon' => 'el-icon-facebook'
            );
            $this->args[ 'share_icons' ][] = array (
                'url' => 'http://twitter.com/reduxframework',
                'title' => __('Follow us on Twitter','mango'),
                'icon' => 'el-icon-twitter'
            );
            $this->args[ 'share_icons' ][] = array (
                'url' => 'http://www.linkedin.com/company/mango',
                'title' => __('Find us on LinkedIn','mango'),
                'icon' => 'el-icon-linkedin'
            );
           // Panel Intro text -> before the form
            if ( !isset( $this->args[ 'global_variable' ] ) || $this->args[ 'global_variable' ] !== false ) {
               if ( !empty( $this->args[ 'global_variable' ] ) ) {
                    $r = $this->args[ 'global_variable' ];
                } else {
                    $r = str_replace ( '-', '_', $this->args[ 'opt_name' ] );
                }
                $this->args[ 'intro_text' ] = sprintf ( '<p>Did you know that mango sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', $r );
            } else {
                $this->args[ 'intro_text' ] = '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>';
            }

            // Add content after the form.
            //$this->args['footer_text'] = '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>';

        }
    }

    global $reduxmangoSettings;
    $reduxmangoSettings = new Redux_Framework_mango_settings();
}