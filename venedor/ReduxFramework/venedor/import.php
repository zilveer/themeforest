<?php

/**
Venedor Import File
For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_venedor_import')) {

    class Redux_Framework_venedor_import {

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

            global $wp;

            ob_end_clean();

            // You can append a new section at any time.
            // General Settings
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'title' => 'Theme Type',
                'fields' => array(

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => 'After change, you should click <strong>"Reset All"</strong> and <strong>"Save Changes"</strong> in <strong>Theme Settings</strong> and <strong>Theme Design</strong> menus.'
                    ),

                    array(
                        'id'=>'theme-settings',
                        'type' => 'select',
                        'title' => 'Theme Settings',
                        'options' => array(
                            ''              => 'Demo #1 (Default)',
                            '_red'          => 'Demo #2 (Red)',
                            '_brown'        => 'Demo #3 (Brown)',
                            '_blue_orange'  => 'Demo #4 (Blue-Orange)',
                            '_blue'         => 'Demo #5 (Blue)',
                            '_green_pink'   => 'Demo #6 (Green-Pink)',
                            '_orange'       => 'Demo #7 (Orange)',
                            '_yellow'       => 'Demo #8 (Yellow)',
                            '_clean'        => 'Demo #9 (Clean)',
                            '_pink'         => 'Demo #10 (Pink)',
                            '_green'        => 'Demo #11 (Green)',
                            '_grid'         => 'Demo #12 (Grid)',
                            '_parallax'     => 'Demo #13 (Parallax)'
                        ),
                        'desc' => 'You should click "Reset All" and "Save Changes" in <strong>Theme Settings</strong> after change this option.',
                        'default' => '',
                    ),

                    array(
                        'id'=>'theme-design',
                        'type' => 'select',
                        'title' => 'Theme Design',
                        'options' => array(
                            ''              => 'Demo #1 (Default)',
                            '_red'          => 'Demo #2 (Red)',
                            '_brown'        => 'Demo #3 (Brown)',
                            '_blue_orange'  => 'Demo #4 (Blue-Orange)',
                            '_blue'         => 'Demo #5 (Blue)',
                            '_green_pink'   => 'Demo #6 (Green-Pink)',
                            '_orange'       => 'Demo #7 (Orange)',
                            '_yellow'       => 'Demo #8 (Yellow)',
                            '_clean'        => 'Demo #9 (Clean)',
                            '_pink'         => 'Demo #10 (Pink)',
                            '_green'        => 'Demo #11 (Green)',
                            '_grid'         => 'Demo #12 (Grid)',
                            '_parallax'     => 'Demo #13 (Parallax)'
                        ),
                        'desc' => 'You should click "Reset All" and "Save Changes" in <strong>Theme Design</strong> after change this option.',
                        'default' => '',
                    )
                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'icon_class' => 'icon',
                'title' => 'Import',
                'fields' => array(

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => '<strong>Import Sample Content using the Traditional Method</strong>'
                    ),

                    array(
                        'id'        => '17',
                        'type'      => 'raw',
                        'markdown'  => true,
                        'content'   => (isset($_GET['import_success'])?'<strong>Successfully Imported!</strong><br/><br/>':'').'<a href="'.admin_url('admin.php?page=venedor_import').'&import_sample_content=true" class="button button-primary">'.'Import'.'</a>'
                    ),

                    array(
                        'id'=>'2',
                        'type' => 'info',
                        'desc' => '<strong>Import Demo using the Alternative Method.</strong><br>Please reference Theme Install > Import Demo - Alternative Method in documentation.'
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
                'opt_name'          => 'venedor_import',
                'display_name'      => $theme->get('Name') . ' ' . 'Import',
                'display_version'   => $theme->get('Version'),
                'menu_type'         => 'menu',
                'allow_sub_menu'    => true,
                'menu_title'        => 'Theme Import',
                'page_title'        => 'Theme Import',

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
                'page_slug'         => 'venedor_import',
                'save_defaults'     => true,
                'default_show'      => false,
                'default_mark'      => '',
                'show_import_export' => false,

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

    global $reduxVenedorImport;
    $reduxVenedorImport = new Redux_Framework_venedor_import();
}