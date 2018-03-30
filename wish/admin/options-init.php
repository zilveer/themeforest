<?php
/**
  ReduxFramework Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Wish_Redux_Framework_config')) {

    class Wish_Redux_Framework_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;

            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
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



            if (!isset($this->args['opt_name'])) { // No errors please

                return;

            }



            // If Redux is running as a plugin, this will remove the demo notice and links

            add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

            

            // Function to test the compiler hook and demo CSS output.

            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.

            add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

            

            // Change the arguments after they've been declared, but before the panel is created

            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );

            

            // Change the default value of a field after it's been set, but before it's been useds

            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );

            

            // Dynamically add a section. Can be also used to modify sections/fields

            //add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));



            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);

        }



        /**



          This is a test function that will let you see when the compiler hook occurs.

          It only runs if a field   set with compiler=>true is changed.



         * */

        function compiler_action($options, $css) {

              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = get_template_directory() . '/css/overrules.css';
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

        }//end of function


        /**
          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {

            //$sections = array();

            $sections[] = array(

                'title' => __('Section via hook', 'wish'),

                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'wish'),

                'icon' => 'el-icon-paper-clip',

                // Leave this as a blank section, no options just some intro text set above.

                'fields' => array()

            );



            return $sections;

        }



        /**



          Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.



         * */

        function change_arguments($args) {

            $args['dev_mode'] = false;



            return $args;

        }



        /**



          Filter hook for filtering the default value of any given field. Very useful in development mode.



         * */

        function change_defaults($defaults) {

            $defaults['str_replace'] = 'Testing filter hook!';



            return $defaults;

        }



        // Remove the demo link and the notice of integrated demo from the redux-framework plugin

        function remove_demo() {



            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.

            if (class_exists('ReduxFrameworkPlugin')) {

                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::instance(), 'plugin_metalinks'), null, 2);



                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.

                remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));

            }

        }



        public function setSections() {



            /**

              Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples

             * */

            // Background Patterns Reader

            $sample_patterns_path   = ReduxFramework::$_dir . '../sample/patterns/';

            $sample_patterns_url    = ReduxFramework::$_url . '../sample/patterns/';

            $sample_patterns        = array();



            if (is_dir($sample_patterns_path)) :



                if ($sample_patterns_dir = opendir($sample_patterns_path)) :

                    $sample_patterns = array();



                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {



                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {

                            $name = explode('.', $sample_patterns_file);

                            $name = str_replace('.' . end($name), '', $sample_patterns_file);

                            $sample_patterns[]  = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);

                        }

                    }

                endif;

            endif;



            ob_start();



            $ct             = wp_get_theme();

            $this->theme    = $ct;

            $item_name      = $this->theme->get('Name');

            $tags           = $this->theme->Tags;

            $screenshot     = $this->theme->get_screenshot();

            $class          = $screenshot ? 'has-screenshot' : '';



            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'wish'), $this->theme->display('Name'));

            

            ?>

            <div id="current-theme" class="<?php echo esc_attr($class); ?>">

            <?php if ($screenshot) : ?>

                <?php if (current_user_can('edit_theme_options')) : ?>

                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">

                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'wish'); ?>" />

                        </a>

                <?php endif; ?>

                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'wish'); ?>" />

                <?php endif; ?>



                <h4><?php echo esc_attr($this->theme->display('Name')); ?></h4>



                <div>

                    <ul class="theme-info">

                        <li><?php printf(__('By %s', 'wish'), $this->theme->display('Author')); ?></li>

                        <li><?php printf(__('Version %s', 'wish'), $this->theme->display('Version')); ?></li>

                        <li><?php echo '<strong>' . __('Tags', 'wish') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>

                    </ul>

                    <p class="theme-description"><?php echo esc_attr($this->theme->display('Description')); ?></p>

            <?php

            if ($this->theme->parent()) {

                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', "wish") . '</p>', __('http://codex.wordpress.org/Child_Themes', 'wish'), $this->theme->parent()->display('Name'));

            }

            ?>



                </div>

            </div>



            <?php

            $item_info = ob_get_contents();



            ob_end_clean();



            $sampleHTML = '';

            if (file_exists(dirname(__FILE__) . '/info-html.html')) {

                /** @global WP_Filesystem_Direct $wp_filesystem  */

                global $wp_filesystem;

                if (empty($wp_filesystem)) {

                    require_once(ABSPATH . '/wp-admin/includes/file.php');

                    WP_Filesystem();

                }

                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');

            }





            $this->sections[] = array(

                'icon'      => 'el-icon-cogs',
                'submenu' => false,
                'title'     => __('General Settings', 'wish'),
                'fields'    => array(

                    array(

                            'id'       => 'wish-logo-image',
                            'type'     => 'media',
                            'height'   => '60px',
                            'url'      => true,
                            'title'    => __('Logo', 'wish'),
                            'desc'     => __('Set the logo dimensions below, avoid uploading large images', 'wish'),
                            'subtitle' => __('Upload Any Image For The Site Logo', 'wish'),
                            'default'  => array(
                                'url'  => get_template_directory_uri() . '/images/logo/logo_dark.png'
                            ),
                        ),

                    array(

                            'id'       => 'wish-logo-image-transparent',
                            'type'     => 'media',
                            'height'   => '60px',
                            'url'      => true,
                            'title'    => __('Logo For Transparent Menu', 'wish'),
                            'desc'     => __('If you want different logo on home page (for transparent menu)', 'wish'),
                            'subtitle' => __('Upload Any Image For The Site Logo', 'wish'),
                            'default'  => array(
                                'url'  => get_template_directory_uri() . '/images/logo/logo.png'
                            ),
                        ),




                        array(
                            'id'       => 'wish_logo_dimensions',
                            'type'     => 'dimensions',
                            'units'    => array('em','px','%'),
                            'title'    => __('Dimensions (Width/Height) Of The Logo', 'wish'),
                            'subtitle' => __('Allows you to choose width, height, and/or unit for the logo.', 'wish'),
                            'desc'     => __('Change the logo size, leave blank for the default dimensions of the image', 'wish'),
                            'default'  => array(
                                'Width'   => '140', 
                                'Height'  => '24'
                            ),
                        ),



                        array(
                            'id'             => 'wish-logo-spacing',
                            'type'           => 'spacing',
                            'mode'           => 'margin',
                            'right'           => false,
                            'bottom'           => false,
                            'units'          => array('px'),
                            'units_extended' => 'false',
                            'title'          => __('Logo Position', 'wish'),
                            'subtitle'       => __('Allow you to set the logo position relative to its current position', 'wish'),
                            'desc'           => __('You can use negative numbers for reverse direction.', 'wish'),
                            'default'            => array(
                                'margin-top'     => '0px', 
                                'margin-right'   => '0px', 
                                'margin-bottom'  => '0px', 
                                'margin-left'    => '0px',
                                'units'          => 'px', 
                            )
                        ),


                    array(

                        'id'        => 'wish-theme-bg-color',
                        'type'      => 'color',
                        'title'     => __('Theme Background Color', 'wish'),
                        'subtitle'  => __('Theme Background Color, works for boxed layout.', 'wish'),
                        'default'  => '#FFFFFF',
                        'validate' => 'color',
                        'transparent'   => false,
                        'mode'      => 'background-color',
                    ),


                    array(

                        'id'        => 'wish-editor-css',
                        'type'      => 'ace_editor',
                        'title'     => __('CSS Code', 'wish'),
                        'subtitle'  => __('Paste your CSS code here.', 'wish'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                        'desc'      => 'Possible modes can be found at ace.c9.io',
                        'default'   => "#header{\nmargin: 0 auto;\n}",
                        'validate' => 'css',
                    ),

                    array(

                        'id'        => 'wish-editor-js',
                        'type'      => 'ace_editor',
                        'title'     => __('JS Code', 'wish'),
                        'subtitle'  => __('Paste your JS code here.', 'wish'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                        'desc'      => 'Possible modes can be found at ace.c9.io',
                        'default'   => "",
                        'validate' => 'js',

                    ),

                )

            );





            $this->sections[] = array(

                'icon'      => 'el-icon-website',

                'title'     => __('Styling Options', 'wish'),

                'submenu' => false,

                'fields'    => array(

                    /*large font size*/
                    // array(
                    //                             'id'        => 'wish-large-font-style',
                    //                             'type'      => 'typography',
                    //                             'title'     => __('Large Font', 'wish'),
                    //                             'color'  => false,
                    //                             'text-align' => false,
                    //                             'line-height' => false,
                    //                             'subtitle'  => __('Font Styles', 'wish'),
                    //                             'default'   => array(
                    //                                 'font-size'     => '60px',
                    //                                 'font-family'   => 'Montserrat',
                    //                                 'font-weight' => '700',
                    //                             ),
                    //                 ),

                    // array(
                    //                             'id'        => 'wish-page-regular-font-style',
                    //                             'type'      => 'typography',
                    //                             'title'     => __('Page Regular Font', 'wish'),
                    //                             'color'  => false,
                    //                             'text-align' => false,
                    //                             'line-height' => false,
                    //                             'subtitle'  => __('Font Styles', 'wish'),
                    //                             'default'   => array(
                    //                                 'font-size'     => '16px',
                    //                                 'font-family'   => 'Montserrat',
                    //                                 'font-weight' => '400',
                    //                             ),
                    //                 ),








                                            array( 
                                                'id'       => 'opt-raw',
                                                'type'     => 'raw',
                                                'title'    => __('', 'redux-framework-demo'),
                                                'subtitle' => __('', 'redux-framework-demo'),
                                                'desc'     => __('', 'redux-framework-demo'),
                                                'content'  => '<h3 class="redux-admin-subtitle">Extra Fonts</h3>',
                                            ),





                    array(
                                                'id'        => 'wish-page-extra-font1',
                                                'type'      => 'typography',
                                                'title'     => __('Extra Font 1', 'wish'),
                                                'color'  => false,
                                                'text-align' => false,
                                                'line-height' => false,
                                                'subtitle'  => __('Loads Extra Font in the frontend', 'wish'),
                                                'default'   => array(
                                                    'font-size'     => '14px',
                                                    'font-family'   => 'Montserrat',
                                                    'font-weight' => '400',
                                                ),
                                    ),

                    array(
                                                'id'        => 'wish-page-extra-font2',
                                                'type'      => 'typography',
                                                'title'     => __('Extra Font 2', 'wish'),
                                                'color'  => false,
                                                'text-align' => false,
                                                'line-height' => false,
                                                'subtitle'  => __('Loads Extra Font in the frontend', 'wish'),
                                                'default'   => array(
                                                    'font-size'     => '16px',
                                                    'font-family'   => 'Lato',
                                                    'font-weight' => '400',
                                                ),
                                    ),



                    // array(
                    //                             'id'        => 'wish-big-quote',
                    //                             'type'      => 'typography',
                    //                             'title'     => __('Big Quote', 'wish'),
                    //                             'color'  => false,
                    //                             'text-align' => false,
                    //                             'line-height' => false,
                    //                             'subtitle'  => __('Big Quote', 'wish'),
                    //                             'default'   => array(
                    //                                 'font-size'     => '60px',
                    //                                 'font-family'   => 'Lato',
                    //                                 'font-weight' => '700',
                    //                             ),
                    //                 ),






                ),


            );

            // $this->sections[] = array(

            //     'icon'      => 'el-icon-magic',
            //     'submenu'   => false,
            //     'title'     => __('Restaurant', 'wish'),
            //     'desc'      => __('<p class="description">Restaurant Styles</p>', 'wish'),
            //     'subsection' => true,
            //     'fields'    => array(

            //                                 // array( 
            //                                 //     'id'       => 'opt-raw',
            //                                 //     'type'     => 'raw',
            //                                 //     'title'    => __('', 'redux-framework-demo'),
            //                                 //     'subtitle' => __('', 'redux-framework-demo'),
            //                                 //     'desc'     => __('', 'redux-framework-demo'),
            //                                 //     'content'  => '<h3 class="redux-admin-subtitle">Restaurant Styling</h3>',
            //                                 // ),
            //                                 // array(
            //                                 //     'id'        => 'wish-restaurant-heading-style',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Restaurant Menu Heading Styles', 'wish'),
            //                                 //     'subtitle'  => __('Restaurant Menu Headings Styles', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'line-height' => false,
            //                                 //     'text-align' => false,
            //                                 //     'font-weight' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '60px',
            //                                 //         'font-family'   => 'Montserrat',
            //                                 //     ),
            //                                 // ),
                                            
            //                                 // array(
            //                                 //     'id'        => 'wish-restaurant-title-style-style',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Restaurant Menu Title Styles', 'wish'),
            //                                 //     'subtitle'  => __('Restaurant Menu Title Styles', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'line-height' => false,
            //                                 //     'text-align' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '20px',
            //                                 //         'font-family'   => 'Montserrat',
            //                                 //         'font-weight'  => '700',
            //                                 //     ),
            //                                 // ),



            //                                 // array(
            //                                 //     'id'        => 'wish-restaurant-subtitle-style-style',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Restaurant Menu Sub Title Styles', 'wish'),
            //                                 //     'subtitle'  => __('Restaurant Menu Sub Title Styles', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'line-height' => false,
            //                                 //     'text-align' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '16px',
            //                                 //         'font-family'   => 'Montserrat',
            //                                 //         'font-weight'  => '700',
            //                                 //     ),
            //                                 // ),
            //                                 // array(
            //                                 //     'id'        => 'wish-restaurant-details-style',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Restaurant Menu Details Styles', 'wish'),
            //                                 //     'subtitle'  => __('Restaurant Menu Details Styles', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'line-height' => false,
            //                                 //     'text-align' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '14px',
            //                                 //         'font-family'   => 'Montserrat',
            //                                 //         'font-weight'  => '400',
            //                                 //     ),
            //                                 // ),


            //                                 // array( 
            //                                 //     'id'       => 'opt-raw',
            //                                 //     'type'     => 'raw',
            //                                 //     'title'    => __('', 'redux-framework-demo'),
            //                                 //     'subtitle' => __('', 'redux-framework-demo'),
            //                                 //     'desc'     => __('', 'redux-framework-demo'),
            //                                 //     'content'  => '<h3 class="redux-admin-subtitle">Restaurant Menu 2 Styling</h3>',
            //                                 // ),
            //                                 // array(
            //                                 //     'id'        => 'wish-restaurant-menu2-heading',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Restaurant Menu 2 Heading Styles', 'wish'),
            //                                 //     'subtitle'  => __('Restaurant Menu 2 Heading Styles', 'wish'),
            //                                 //     'line-height' => false,
            //                                 //     'text-align' => false,
            //                                 //     'color' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '60px',
            //                                 //         'font-family'   => 'Montserrat',
            //                                 //         'font-weight'  => '700',
            //                                 //     ),
            //                                 // ),

            //                                 // array(
            //                                 //     'id'        => 'wish-restaurant-menu2-subheading',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Restaurant Menu 2 Sub Heading Styles', 'wish'),
            //                                 //     'subtitle'  => __('Restaurant Menu 2 Sub Heading Styles', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'line-height' => false,
            //                                 //     'subsets' => false,
            //                                 //     'text-align' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '14px',
            //                                 //         'font-family'   => 'Montserrat',
            //                                 //         'font-weight'  => '400',
            //                                 //     ),
            //                                 // ),
                                            
            //                                 // array(
            //                                 //     'id'        => 'wish-restaurant-menu2-title',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Restaurant Menu 2 Title Styles', 'wish'),
            //                                 //     'subtitle'  => __('Restaurant Menu 2 Title Styles', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'line-height' => false,
            //                                 //     'text-align' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '24px',
            //                                 //         'font-family'   => 'Montserrat',
            //                                 //         'font-weight'  => '700',
            //                                 //     ),
            //                                 // ),
            //                                 // array(
            //                                 //     'id'        => 'wish-restaurant-menu2-dish-name-styles',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Restaurant Menu 2 Dishes Name Styles', 'wish'),
            //                                 //     'subtitle'  => __('Restaurant Menu 2 Dishes Name Styles', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'line-height' => false,
            //                                 //     'text-align' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '14px',
            //                                 //         'font-family'   => 'Montserrat',
            //                                 //         'font-weight'  => '400',
            //                                 //     ),
            //                                 // ),
            //                                 // array(
            //                                 //     'id'        => 'wish-restaurant-menu2-dish-details-style',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Restaurant Menu 2 Dish Details Styles', 'wish'),
            //                                 //     'subtitle'  => __('Restaurant Menu 2 Dish Details Styles', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'line-height' => false,
            //                                 //     'text-align' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '12px',
            //                                 //         'font-family'   => 'Montserrat',
            //                                 //         'font-weight'  => '400',
            //                                 //     ),
            //                                 // ),

                                            
                                           


            //                                 // array( 
            //                                 //     'id'       => 'opt-raw',
            //                                 //     'type'     => 'raw',
            //                                 //     'title'    => __('', 'redux-framework-demo'),
            //                                 //     'subtitle' => __('', 'redux-framework-demo'),
            //                                 //     'desc'     => __('', 'redux-framework-demo'),
            //                                 //     'content'  => '<h3 class="redux-admin-subtitle">Chef Styling</h3>',
            //                                 // ),

            //                                 // array(
            //                                 //     'id'        => 'wish-chefs-heading',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Chef Heading', 'wish'),
            //                                 //     'subtitle'  => __('Chef Heading', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'line-height' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '55px',
            //                                 //         'font-family'   => 'Great Vibes',
            //                                 //         'font-weight' => '500',
            //                                 //         'text-align' => 'left',
            //                                 //     ),
            //                                 // ),

            //                                 // array(
            //                                 //     'id'        => 'wish-chefs-name',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Chef Name', 'wish'),
            //                                 //     'subtitle'  => __('Chef Name', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'line-height' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '20px',
            //                                 //         'font-family'   => 'Montserrat',
            //                                 //         'font-weight' => '400',
            //                                 //         'text-align' => 'left',
            //                                 //     ),
            //                                 // ),

            //                                 // array(
            //                                 //     'id'        => 'wish-chefs-title',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Chef Title', 'wish'),
            //                                 //     'subtitle'  => __('Chef Title', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'line-height' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '20px',
            //                                 //         'font-family'   => 'Montserrat',
            //                                 //         'font-weight' => '700',
            //                                 //         'text-align' => 'left',
            //                                 //     ),
            //                                 // ),

            //                                 // array(
            //                                 //     'id'        => 'wish-chefs-description',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Chef Description', 'wish'),
            //                                 //     'subtitle'  => __('Chef Description', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'line-height' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '14px',
            //                                 //         'font-family'   => 'Montserrat',
            //                                 //         'font-weight' => '400',
            //                                 //         'text-align' => 'left',
            //                                 //     ),
            //                                 // ),


            //                                 // array( 
            //                                 //     'id'       => 'opt-raw',
            //                                 //     'type'     => 'raw',
            //                                 //     'title'    => __('', 'redux-framework-demo'),
            //                                 //     'subtitle' => __('', 'redux-framework-demo'),
            //                                 //     'desc'     => __('', 'redux-framework-demo'),
            //                                 //     'content'  => '<h3 class="redux-admin-subtitle">Handwritten Testimonial Styling</h3>',
            //                                 // ),

            //                                 // array(
            //                                 //     'id'        => 'wish-handwritten-testimonial-title',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Hand Written Testimonial Title', 'wish'),
            //                                 //     'subtitle'  => __('Hand Written Testimonial Title', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '40px',
            //                                 //         'font-family'   => 'Oleo Script',
            //                                 //         'font-weight' => '400',
            //                                 //         'text-align' => 'left',
            //                                 //         'line-height' => '50px',
            //                                 //     ),
            //                                 // ),

            //                                 // array(
            //                                 //     'id'        => 'wish-handwritten-testimonial-subtitle',
            //                                 //     'type'      => 'typography',
            //                                 //     'title'     => __('Hand Written Testimonial Subtitle', 'wish'),
            //                                 //     'subtitle'  => __('Hand Written Testimonial Subtitle', 'wish'),
            //                                 //     'color' => false,
            //                                 //     'subsets' => false,
            //                                 //     'default'   => array(
            //                                 //         'font-size'     => '30px',
            //                                 //         'font-family'   => 'Just Another Hand',
            //                                 //         'font-weight' => '400',
            //                                 //         'text-align' => 'left',
            //                                 //         'line-height' => '30px',
            //                                 //     ),
            //                                 // ),
            //                     ),

            //  );

         // $this->sections[] = array(

         //        'icon'      => 'el-icon-magic',
         //        'submenu'   => false,
         //        'title'     => __('Pizza', 'wish'),
         //        'subsection' => true,
         //        'desc'      => __('<p class="description">Pizza Page Styles</p>', 'wish'),
         //        'fields'    => array(
         //                                array(
         //                                    'id'        => 'wish-our-selection-carousel-heading',
         //                                    'type'      => 'typography',
         //                                    'title'     => __('Selection Carousel Heading', 'wish'),
         //                                    'subtitle'  => __('Selection Carousel Heading', 'wish'),
         //                                    'default'   => array(
         //                                        'color'         => '#e06f00',
         //                                        'font-size'     => '16px',
         //                                        'font-family'   => 'Montserrat',
         //                                        'font-weight' => '500',
         //                                        'text-align' => 'left',
         //                                    ),
         //                                ),


         //                                    array(
         //                                        'id'        => 'wish-pizza-heading-style',
         //                                        'type'      => 'typography',
         //                                        'title'     => __('Page Heading Styles', 'wish'),
         //                                        'subtitle'  => __('Page Headings Styles', 'wish'),
         //                                        'color' => false,
         //                                        'line-height' => false,
         //                                        'text-align' => false,
         //                                        'font-weight' => false,
         //                                        'subsets' => false,
         //                                        'default'   => array(
         //                                            'font-size'     => '55px',
         //                                            'font-family'   => 'Great Vibes',
         //                                        ),
         //                                    ),

         //                                     array(
         //                                        'id'        => 'wish-pizza-font-regular',
         //                                        'type'      => 'typography',
         //                                        'title'     => __('Pizza Font Regular', 'wish'),
         //                                        'subtitle'  => __('Pizza Font Regular', 'wish'),
         //                                        'color' => false,
         //                                        'line-height' => false,
         //                                        'subsets' => false,
         //                                        'default'   => array(
         //                                            'font-size'     => '14px',
         //                                            'font-family'   => 'Montserrat',
         //                                            'font-weight' => '400',
         //                                            'text-align' => 'center',
         //                                        ),
         //                                    ),

         //                                    array(
         //                                        'id'        => 'wish-pizza-intro-title',
         //                                        'type'      => 'typography',
         //                                        'title'     => __('Pizza Intro Title', 'wish'),
         //                                        'subtitle'  => __('Pizza Intro Title', 'wish'),
         //                                        'color' => false,
         //                                        'line-height' => false,
         //                                        'subsets' => false,
         //                                        'default'   => array(
         //                                            'font-size'     => '24px',
         //                                            'font-family'   => 'Montserrat',
         //                                            'font-weight' => '500',
         //                                            'text-align' => 'center',
         //                                        ),
         //                                    ),

         //                                    array(
         //                                        'id'        => 'wish-pizza-intro-box',
         //                                        'type'      => 'typography',
         //                                        'title'     => __('Pizza Intro Box', 'wish'),
         //                                        'subtitle'  => __('Pizza Intro Box', 'wish'),
         //                                        'line-height' => false,
         //                                        'subsets' => false,
         //                                        'default'   => array(
         //                                            'color'         => '#ffffff',
         //                                            'font-size'     => '14px',
         //                                            'font-family'   => 'Montserrat',
         //                                            'font-weight' => '400',
         //                                            'text-align' => 'center',
         //                                        ),
         //                                    ),

         //                                    array(
         //                                        'id'        => 'wish-pizza-intro-box-link',
         //                                        'type'      => 'typography',
         //                                        'title'     => __('Pizza Intro Box Link', 'wish'),
         //                                        'subtitle'  => __('Pizza Intro Box Link', 'wish'),
         //                                        'color' => false,
         //                                        'line-height' => false,
         //                                        'subsets' => false,
         //                                        'default'   => array(
         //                                            'font-size'     => '16px',
         //                                            'font-family'   => 'Montserrat',
         //                                            'font-weight' => '400',
         //                                            'text-align' => 'center',
         //                                        ),
         //                                    ),




         //            ),

         //        );






             //    $this->sections[] = array(

             //    'icon'      => 'el-icon-magic',
             //    'submenu'   => false,
             //    'title'     => __('Construction', 'wish'),
             //    'desc'      => __('<p class="description">Construction Page Styling</p>', 'wish'),
             //    'subsection' => true,
             //    'fields'    => array(

             //                        // array(
             //                        //     'id'        => 'wish-construction-title-style',
             //                        //     'type'      => 'typography',
             //                        //     'title'     => __('Construction Title Styles', 'wish'),
             //                        //     'color'  => false,
             //                        //     'line-height' => false,
             //                        //     'text-align' => false,
             //                        //     'subtitle'  => __('Construction Title Styles', 'wish'),
             //                        //     'default'   => array(
             //                        //         'font-size'     => '18px',
             //                        //         'font-family'   => 'Montserrat',
             //                        //         'font-weight' => '400',
             //                        //     ),
             //                        // ),

                                    
             //                        // array(
             //                        //     'id'        => 'wish-construction-regular-font-style',
             //                        //     'type'      => 'typography',
             //                        //     'title'     => __('Construction Regular Font', 'wish'),
             //                        //     'color'  => false,
             //                        //     'text-align' => false,
             //                        //     'subtitle'  => __('Construction Regular Font', 'wish'),
             //                        //     'default'   => array(
             //                        //         'font-size'     => '14px',
             //                        //         'font-family'   => 'Montserrat',
             //                        //         'font-weight' => '400',
             //                        //         'line-height' => '30px',
             //                        //     ),
             //                        // ),
             //                    ),
             // );




         // $this->sections[] = array(

         //        'icon'      => 'el-icon-magic',
         //        'submenu'   => false,
         //        'title'     => __('Medical', 'wish'),
         //        'subsection' => true,
         //        'desc'      => __('<p class="description">Medical Styling</p>', 'wish'),
         //        'fields'    => array(

         //                            array(
         //                                        'id'        => 'wish-medical-heading-style',
         //                                        'type'      => 'typography',
         //                                        'title'     => __('Page Heading Styles', 'wish'),
         //                                        'color'  => false,
         //                                        'line-height' => false,
         //                                        'subtitle'  => __('Page Headings Styles', 'wish'),
         //                                        'default'   => array(
         //                                            'font-size'     => '30px',
         //                                            'font-family'   => 'Montserrat',
         //                                            'text-align'  => 'center',
         //                                            'font-weight' => '700',
         //                                        ),
         //                            ),

         //                            // array(
         //                            //             'id'        => 'wish-medical-our-mission-heading-style',
         //                            //             'type'      => 'typography',
         //                            //             'title'     => __('Our Mission Heading Styles', 'wish'),
         //                            //             'color'  => false,
         //                            //             'line-height' => false,
         //                            //             'subtitle'  => __('Medical Our Mission Headings Styles', 'wish'),
         //                            //             'default'   => array(
         //                            //                 'font-size'     => '20px',
         //                            //                 'font-family'   => 'Montserrat',
         //                            //                 'text-align'  => 'center',
         //                            //                 'font-weight' => '700',
         //                            //             ),
         //                            // ),


         //                            // array(
         //                            //             'id'        => 'wish-medical-regular-font-style',
         //                            //             'type'      => 'typography',
         //                            //             'title'     => __('Page Regular Font', 'wish'),
         //                            //             'color'  => false,
         //                            //             'text-align' => false,
         //                            //             'subtitle'  => __('Page Regular Font', 'wish'),
         //                            //             'default'   => array(
         //                            //                 'font-size'     => '14px',
         //                            //                 'font-family'   => 'Montserrat',
         //                            //                 'font-weight' => '400',
         //                            //                 'line-height' => '30px',
         //                            //             ),
         //                            // ),
                                    
         //                            // array(
         //                            //             'id'        => 'wish-img-with-details-font-style',
         //                            //             'type'      => 'typography',
         //                            //             'title'     => __('`Image with details` Section Font', 'wish'),
         //                            //             'color'  => false,
         //                            //             'text-align' => false,
         //                            //             'subtitle'  => __('Font Styles', 'wish'),
         //                            //             'default'   => array(
         //                            //                 'font-size'     => '24px',
         //                            //                 'font-family'   => 'Montserrat',
         //                            //                 'font-weight' => '400',
         //                            //                 'line-height' => '30px',
         //                            //             ),
         //                            // ),




         //                        ),
         //     );

        // $this->sections[] = array(

        //         'icon'      => 'el-icon-magic',
        //         'submenu'   => false,
        //         'title'     => __('Corporate', 'wish'),
        //         'subsection' => true,
        //         'desc'      => __('<p class="description">Corporate Styling</p>', 'wish'),
        //         'fields'    => array(
                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">2 Columns Textbox <a target="_blank" class="wish_admin_screenshot" href="http://i.imgur.com/HdT51Qt.png">(Screenshot)</a></h3>',
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-2col-textbox-title',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('2 Columns Textbox Title', 'wish'),
                                    //             'subtitle'  => __('Screenshot', 'wish'),
                                    //             'color'  => false,
                                    //             'default'   => array(
                                    //                 'font-size'     => '40px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //                 'text-align' => 'center',
                                    //                 'line-height' => '60px',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-2col-textbox-text',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('2 Columns Textbox Text', 'wish'),
                                    //             'subtitle'  => __('Screenshot', 'wish'),
                                    //             'color'  => false,
                                    //             'default'   => array(
                                    //                 'font-size'     => '14px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //                 'text-align' => 'left',
                                    //                 'line-height' => '30px',
                                    //             ),
                                    // ),

                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Services <a target="_blank" class="wish_admin_screenshot" href="http://i.imgur.com/AU4n1Gq.png">(Screenshot)</a></h3>',
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-services-title',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Services Title', 'wish'),
                                    //             'subtitle'  => __('Screenshot', 'wish'),
                                    //             'color'  => false,
                                    //             'default'   => array(
                                    //                 'font-size'     => '20px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //                 'text-align' => 'center',
                                                    
                                    //                 'line-height' => '20px',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-services-text',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Services Text', 'wish'),
                                    //             'subtitle'  => __('Screenshot', 'wish'),
                                    //             'color'  => false,
                                    //             'default'   => array(
                                    //                 'font-size'     => '14px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //                 'text-align' => 'center',
                                                    
                                    //                 'line-height' => '30px',
                                    //             ),
                                    // ),

                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Video Strip <a target="_blank" class="wish_admin_screenshot" href="http://i.imgur.com/Y0EZFW7.png">(Screenshot)</a></h3>',
                                    // ),


                                    // array(
                                    //             'id'        => 'wish-videostrip_font',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Video Strip Font', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '26px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //                 'line-height' => '65px',
                                    //             ),
                                    // ),




                                    // //featured projects
                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Featured Projects <a target="_blank" class="wish_admin_screenshot" href="http://i.imgur.com/N5u2vxq.png">(Screenshot)</a></h3>',
                                    // ),  

                                    // array(
                                    //             'id'        => 'wish-featured-projects-title-font',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Title Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'default'   => array(
                                    //                 'font-size'     => '30px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //                 'line-height' => '33px',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-featured-projects-subtitle-font',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Subtitle Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'default'   => array(
                                    //                 'font-size'     => '60px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //                 'line-height' => '66px',
                                    //             ),
                                    // ),


                                    // array(
                                    //             'id'        => 'wish-featured-projects-projects-font',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Project Title Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'default'   => array(
                                    //                 'font-size'     => '22px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //                 'line-height' => '30px',
                                    //             ),
                                    // ),

                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Team Gallery <a target="_blank" class="wish_admin_screenshot" href="http://i.imgur.com/8LhX6wN.png">(Screenshot)</a></h3>',
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-team-gallery-title-font',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Our Team Title', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'default'   => array(
                                    //                 'font-size'     => '30px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //                 'line-height' => '33px',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-team-gallery-subtitle-font',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Our Team Subtitle', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'default'   => array(
                                    //                 'font-size'     => '60px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //                 'line-height' => '66px',
                                    //             ),
                                    // ),





                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Funfacts Large Styling</h3>',
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-funfacts-large-heading1-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Funfacts Heading1 Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Funfacts Headings h1 Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '60px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-funfacts-large-heading3-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Funfacts Heading3 Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Funfacts Headings h3 Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '30px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),


                                    // array(
                                    //             'id'        => 'wish-funfacts-large-regular-font-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Funfacts Regular Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'line-height' => false,
                                    //             'subtitle'  => __('Funfacts Regular Font', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '16px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),
                                    
                                    // array(
                                    //             'id'        => 'wish-funfacts-large-count-font-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Funfacts Count Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'line-height' => false,
                                    //             'subtitle'  => __('Font Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '90px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-funfacts-large-caption-font-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Funfacts Caption Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'line-height' => false,
                                    //             'subtitle'  => __('Font Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '18px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),

                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">"What We DO" Section Styling</h3>',
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-whatwedo-section-heading3-font-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('"What We Do" section Heading h3 Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'line-height' => false,
                                    //             'subtitle'  => __('Font Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '30px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-whatwedo-section-heading1-font-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('"What We Do" section Heading h1 Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'line-height' => false,
                                    //             'subtitle'  => __('Font Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '50px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-whatwedo-section-regular-font-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('What We Do" section Regular Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'line-height' => false,
                                    //             'subtitle'  => __('Font Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '14px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),

                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Step Banner Styling</h3>',
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-steps-banners-heading1-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Steps Banners Heading1 Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Steps Banners Headings h1 Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '60px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-steps-banners-heading3-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Steps Banners Heading3 Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Steps Banners Headings h3 Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '30px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),


                                    // array(
                                    //             'id'        => 'wish-steps-banners-regular-font-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Steps Banners Regular Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'line-height' => false,
                                    //             'subtitle'  => __('Steps Banners Regular Font', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '16px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),
                                    

                                    /*our stats*/
                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Our Stats Styling</h3>',
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-our-stats-heading-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Our Stats Heading Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Our Stats Heading Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '30px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-our-stats-regular-font-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Our Stats Regular Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'line-height' => false,
                                    //             'subtitle'  => __('Our Stats Regular Font', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '11px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),


                                    // array(
                                    //             'id'        => 'wish-our-stats-count-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Our Stats Count Font', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Our Stats Count Font', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '30px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-our-stats-name-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Our Stats Name Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Our Stats Name Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '14px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //             ),
                                    // ),

                                    /*simple Banner 2 Columns*/
                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Simple Banner 2 Columns Styling</h3>',
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-simple-banner2-title-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Simple Banner2 Title Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Simple Banner 2 Columns Title Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '24px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //             ),
                                    // ),

                                    // /*simple Banner 3 Columns*/
                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Simple Banner 3 Columns Styling</h3>',
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-simple-banner3-title-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Simple Banner3 Title Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Simple Banner 3 Columns Title Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '24px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-simple-banner3-subtitle-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Simple Banner3 SubTitle Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Simple Banner 3 Columns SubTitle Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '18px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),

                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Blog Carousel Styling</h3>',
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-blog-carousel-title-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Blog Carousel Title Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Blog Carousel Title Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '30px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-blog-carousel-subtitle-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Blog Carousel Subtitle Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Blog Carousel Subtitle Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '20px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-blog-carousel-heading-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Blog Carousel Heading Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Blog Carousel Heading Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '40px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-blog-carousel-meta-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Blog Carousel Meta Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Blog Carousel Meta Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '14px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-blog-carousel-link-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Blog Carousel link Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Blog Carousel link Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '16px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),

                                    /*FAQs Styling*/

                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">FAQs Styling</h3>',
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-faqs-heading-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('FAQs Heading Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('FAQs Heading Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '20px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-faqs-details-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('FAQs Details Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('FAQs Details Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '14px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),


                                    // array(
                                    //             'id'        => 'wish-faqs-question-font-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Question Font Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'line-height' => false,
                                    //             'subtitle'  => __('Font Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '16px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),
                                    
                                    // array(
                                    //             'id'        => 'wish-faqs-answer-font-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Answer Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'line-height' => false,
                                    //             'subtitle'  => __('Font Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '14px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),


                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Big Intro Section 2 <a target="_blank" class="wish_admin_screenshot" href="http://i.imgur.com/1hAqSam.png">(Screenshot)</a></h3>',
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-big-intro-2-title',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Title Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Font Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '70px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //                 'line-height' => '77px',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-big-intro-2-text',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Text Font', 'wish'),
                                    //             'color'  => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Font Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '14px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //                 'line-height' => '30px',
                                    //             ),
                                    // ),


                                    

             //                    ),
             // );
        

         // $this->sections[] = array(

         //        'icon'      => 'el-icon-magic',
         //        'submenu'   => false,
         //        'title'     => __('Lawyers', 'wish'),
         //        'subsection' => true,
         //        'desc'      => __('<p class="description">Lawyers Styling</p>', 'wish'),
         //        'fields'    => array(
         //                            // array( 
         //                            //     'id'       => 'opt-raw',
         //                            //     'type'     => 'raw',
         //                            //     'title'    => __('', 'redux-framework-demo'),
         //                            //     'subtitle' => __('', 'redux-framework-demo'),
         //                            //     'desc'     => __('', 'redux-framework-demo'),
         //                            //     'content'  => '<h3 class="redux-admin-subtitle">Welcome</h3>',
         //                            // ),
         //                            // array(
         //                            //             'id'        => 'wish-welcome-title-font-style',
         //                            //             'type'      => 'typography',
         //                            //             'title'     => __('Title Font', 'wish'),
         //                            //             'color'  => false,
         //                            //             'line-height' => false,
         //                            //             'text-align' => false,
         //                            //             'subtitle'  => __('Welcome Title Font Styles', 'wish'),
         //                            //             'default'   => array(
         //                            //                 'font-size'     => '36px',
         //                            //                 'font-family'   => 'Montserrat',
         //                            //                 'font-weight' => '700',
         //                            //             ),
         //                            // ),

         //                            // array(
         //                            //             'id'        => 'wish-welcome-subtitle-font-style',
         //                            //             'type'      => 'typography',
         //                            //             'title'     => __('Subtitle Styles', 'wish'),
         //                            //             'color'  => false,
         //                            //             'line-height' => false,
         //                            //             'text-align' => false,
         //                            //             'subtitle'  => __('Welcome Subtitle Font Styles', 'wish'),
         //                            //             'default'   => array(
         //                            //                 'font-size'     => '24px',
         //                            //                 'font-family'   => 'Montserrat',
         //                            //                 'font-weight' => '700',
         //                            //             ),
         //                            // ),


         //                            // array(
         //                            //             'id'        => 'wish-welcome-details-font-style',
         //                            //             'type'      => 'typography',
         //                            //             'title'     => __('Description Font', 'wish'),
         //                            //             'color'  => false,
         //                            //             'text-align' => false,
         //                            //             'line-height' => false,
         //                            //             'subtitle'  => __('Description Font Styles', 'wish'),
         //                            //             'default'   => array(
         //                            //                 'font-size'     => '16px',
         //                            //                 'font-family'   => 'Montserrat',
         //                            //                 'font-weight' => '400',
         //                            //             ),
         //                            // ),

         //                            // array( 
         //                            //     'id'       => 'opt-raw',
         //                            //     'type'     => 'raw',
         //                            //     'title'    => __('', 'redux-framework-demo'),
         //                            //     'subtitle' => __('', 'redux-framework-demo'),
         //                            //     'desc'     => __('', 'redux-framework-demo'),
         //                            //     'content'  => '<h3 class="redux-admin-subtitle">Area of Practice</h3>',
         //                            // ),
         //                            // array(
         //                            //             'id'        => 'wish-aop-heading-font-style',
         //                            //             'type'      => 'typography',
         //                            //             'title'     => __('Area of Practice Heading Styles', 'wish'),
         //                            //             'color'  => false,
         //                            //             'line-height' => false,
         //                            //             'text-align' => false,
         //                            //             'subtitle'  => __('Area of Practice Heading Font Styles', 'wish'),
         //                            //             'default'   => array(
         //                            //                 'font-size'     => '40px',
         //                            //                 'font-family'   => 'Montserrat',
         //                            //                 'font-weight' => '700',
         //                            //             ),
         //                            // ),

         //                            // array(
         //                            //             'id'        => 'wish-aop-title-font-style',
         //                            //             'type'      => 'typography',
         //                            //             'title'     => __('Title Styles', 'wish'),
         //                            //             'color'  => false,
         //                            //             'line-height' => false,
         //                            //             'text-align' => false,
         //                            //             'subtitle'  => __('Area of Practice Title Font Styles', 'wish'),
         //                            //             'default'   => array(
         //                            //                 'font-size'     => '20px',
         //                            //                 'font-family'   => 'Montserrat',
         //                            //                 'font-weight' => '700',
         //                            //             ),
         //                            // ),


         //                            // array(
         //                            //             'id'        => 'wish-aop-details-font-style',
         //                            //             'type'      => 'typography',
         //                            //             'title'     => __('Description Font', 'wish'),
         //                            //             'color'  => false,
         //                            //             'text-align' => false,
         //                            //             'line-height' => false,
         //                            //             'subtitle'  => __('Area of Practice description Font Styles', 'wish'),
         //                            //             'default'   => array(
         //                            //                 'font-size'     => '16px',
         //                            //                 'font-family'   => 'Montserrat',
         //                            //                 'font-weight' => '400',
         //                            //             ),
         //                            // ),

         //                            // array( 
         //                            //     'id'       => 'opt-raw',
         //                            //     'type'     => 'raw',
         //                            //     'title'    => __('', 'redux-framework-demo'),
         //                            //     'subtitle' => __('', 'redux-framework-demo'),
         //                            //     'desc'     => __('', 'redux-framework-demo'),
         //                            //     'content'  => '<h3 class="redux-admin-subtitle">Latest News</h3>',
         //                            // ),
         //                            // array(
         //                            //             'id'        => 'wish-latest-news-title-font-style',
         //                            //             'type'      => 'typography',
         //                            //             'title'     => __('Title Styles', 'wish'),
         //                            //             'color'  => false,
         //                            //             'line-height' => false,
         //                            //             'text-align' => false,
         //                            //             'subtitle'  => __('Latest News Title Font Styles', 'wish'),
         //                            //             'default'   => array(
         //                            //                 'font-size'     => '24px',
         //                            //                 'font-family'   => 'Montserrat',
         //                            //                 'font-weight' => '700',
         //                            //             ),
         //                            // ),

         //                            // array(
         //                            //             'id'        => 'wish-latest-news-details-font-style',
         //                            //             'type'      => 'typography',
         //                            //             'title'     => __('Description Font', 'wish'),
         //                            //             'color'  => false,
         //                            //             'text-align' => false,
         //                            //             'line-height' => false,
         //                            //             'subtitle'  => __('Latest News Description Font Styles', 'wish'),
         //                            //             'default'   => array(
         //                            //                 'font-size'     => '16px',
         //                            //                 'font-family'   => 'Montserrat',
         //                            //                 'font-weight' => '400',
         //                            //             ),
         //                            // ),
                                    
         //                        ),
         //     );
            
            // $this->sections[] = array(

            //     'icon'      => 'el-icon-magic',
            //     'submenu'   => false,
            //     'title'     => __('Sliders and Tabs', 'wish'),
            //     'subsection' => true,
            //     'desc'      => __('<p class="description">Sliders and Tabs Styles</p>', 'wish'),
            //     'fields'    => array(

            //                         array( 
            //                             'id'       => 'opt-raw',
            //                             'type'     => 'raw',
            //                             'title'    => __('', 'redux-framework-demo'),
            //                             'subtitle' => __('', 'redux-framework-demo'),
            //                             'desc'     => __('', 'redux-framework-demo'),
            //                             'content'  => '<h3 class="redux-admin-subtitle">Typing Banner Styling</h3>',
            //                         ),

            //                         array(
            //                                     'id'        => 'wish-typing-banner-text-style',
            //                                     'type'      => 'typography',
            //                                     'title'     => __('Typing Banner Text Styles', 'wish'),
            //                                     'color'  => false,
            //                                     'line-height' => false,
            //                                     'text-align' => false,
            //                                     'subtitle'  => __('Typing Banner Text Styles', 'wish'),
            //                                     'default'   => array(
            //                                         'font-size'     => '40px',
            //                                         'font-family'   => 'Montserrat',
            //                                         'font-weight' => '400',
            //                                     ),
            //                         ),
                                    
                                    /*Timeline Horizontal*/
                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Timeline Horizontal Styling</h3>',
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-timeline-horizontal-title-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Timeline Horizontal Title Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Timeline Horizontal Title Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '30px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-timeline-horizontal-subtitle-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Timeline Horizontal Subtitle Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Timeline Horizontal Subtitle Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '80px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //             ),
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-timeline-horizontal-details-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Timeline Horizontal Description Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Timeline Horizontal Description Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '16px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-timeline-horizontal-span-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Timeline Horizontal Span Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Timeline Horizontal Span Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '14px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),
                                    
                                    /*Horizontal Tabs*/

                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Horizontal Tabs <a target="_blank" class="wish_admin_screenshot" href="http://i.imgur.com/FR7rXpg.png">(Screenshot)</a></h3>',
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-horizontal-component-title-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Horizontal Compenent Title Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Horizontal Component Title Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '36px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-horizontal-component-caption-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Horizontal Compenent Caption Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Horizontal Component Caption Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '16px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),

                                    // array(
                                    //             'id'        => 'wish-horizontal-tab-title-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Horizontal Tab Title Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Horizontal Tab Title Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '30px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-horizontal-tab-subtitle-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Horizontal Tab Subtitle Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Horizontal Tab Subtitle Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '70px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '700',
                                    //             ),
                                    // ),
                                    // array(
                                    //             'id'        => 'wish-horizontal-tab-details-style',
                                    //             'type'      => 'typography',
                                    //             'title'     => __('Horizontal Tab Description Styles', 'wish'),
                                    //             'color'  => false,
                                    //             'line-height' => false,
                                    //             'text-align' => false,
                                    //             'subtitle'  => __('Horizontal Tab Description Styles', 'wish'),
                                    //             'default'   => array(
                                    //                 'font-size'     => '14px',
                                    //                 'font-family'   => 'Montserrat',
                                    //                 'font-weight' => '400',
                                    //             ),
                                    // ),


                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Content Slider</h3>',
                                    // ),

                                    // array(
                                    //     'id'        => 'wish-content-slider-heading',
                                    //     'type'      => 'typography',
                                    //     'title'     => __('Content Slider Heading', 'wish'),
                                    //     'subtitle'  => __('Content Slider Heading', 'wish'),
                                    //     'line-height'=> false,
                                    //     'color' => false,
                                    //     'default'   => array(
                                    //         'font-size'     => '55px',
                                    //         'font-family'   => 'Montserrat',
                                    //         'font-weight' => '500',
                                    //         'text-align' => 'left',
                                    //     ),
                                    // ),

                                    // array(
                                    //     'id'        => 'wish-content-slider-description',
                                    //     'type'      => 'typography',
                                    //     'title'     => __('Content Slider Description', 'wish'),
                                    //     'subtitle'  => __('Content Slider Description', 'wish'),
                                    //     'color' => false,
                                    //     'default'   => array(
                                    //         'font-size'     => '14px',
                                    //         'font-family'   => 'Montserrat',
                                    //         'font-weight' => '400',
                                    //         'text-align' => 'left',
                                    //     ),
                                    // ),


                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Parallax Banner <a target="_blank" class="wish_admin_screenshot" href="http://i.imgur.com/aihDD56.png">(Screenshot)</a></h3>',
                                    // ),

                                    // array(
                                    //     'id'        => 'wish-parallax-banner-title-font',
                                    //     'type'      => 'typography',
                                    //     'title'     => __('Parallax Banner Title', 'wish'),
                                        
                                    //     'color' => false,
                                    //     'default'   => array(
                                    //         'font-size'     => '26px',
                                    //         'font-family'   => 'Montserrat',
                                    //         'font-weight' => '700',
                                    //         'text-align' => 'right',
                                    //         'line-height'  => '28px',
                                    //     ),
                                    // ),

                                    // array(
                                    //     'id'        => 'wish-parallax-banner-text-font',
                                    //     'type'      => 'typography',
                                    //     'title'     => __('Parallax Banner Text', 'wish'),
                                        
                                    //     'color' => false,
                                    //     'default'   => array(
                                    //         'font-size'     => '14px',
                                    //         'font-family'   => 'Montserrat',
                                    //         'font-weight' => '400',
                                    //         'text-align' => 'right',
                                    //         'line-height'  => '30px',
                                    //     ),
                                    // ),


                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Testimonials <a target="_blank" class="wish_admin_screenshot" href="http://i.imgur.com/9HkCrK3.png">(Screenshot)</a></h3>',
                                    // ),

                                    // array(
                                    //     'id'        => 'wish-testimonials-title-font',
                                    //     'type'      => 'typography',
                                    //     'title'     => __('Testimonials Title', 'wish'),
                                    //     'text-align' => false,
                                    //     'color' => false,
                                    //     'default'   => array(
                                    //         'font-size'     => '26px',
                                    //         'font-family'   => 'Montserrat',
                                    //         'font-weight' => '400',
                                    //         'line-height'  => '28px',
                                    //     ),
                                    // ),

                                    // array(
                                    //     'id'        => 'wish-testimonials-text-font',
                                    //     'type'      => 'typography',
                                    //     'title'     => __('Testimonials Text', 'wish'),
                                    //     'text-align' => false,
                                    //     'color' => false,
                                    //     'default'   => array(
                                    //         'font-size'     => '30px',
                                    //         'font-family'   => 'Montserrat',
                                    //         'font-weight' => '700',
                                    //         'line-height'  => '40px',
                                    //     ),
                                    // ),

                                    // array(
                                    //     'id'        => 'wish-testimonials-client-font',
                                    //     'type'      => 'typography',
                                    //     'title'     => __('Client Info Text', 'wish'),
                                    //     'text-align' => false,
                                    //     'color' => false,
                                    //     'default'   => array(
                                    //         'font-size'     => '14px',
                                    //         'font-family'   => 'Montserrat',
                                    //         'font-weight' => '400',
                                    //         'line-height'  => '30px',
                                    //     ),
                                    // ),


                                    // array( 
                                    //     'id'       => 'opt-raw',
                                    //     'type'     => 'raw',
                                    //     'title'    => __('Horizontal Tabs 2', 'redux-framework-demo'),
                                    //     'subtitle' => __('', 'redux-framework-demo'),
                                    //     'desc'     => __('', 'redux-framework-demo'),
                                    //     'content'  => '<h3 class="redux-admin-subtitle">Horizontal Tabs 2 <a target="_blank" class="wish_admin_screenshot" href="#">(Screenshot)</a></h3>',
                                    // ),

                                    // array(
                                    //     'id'        => 'wish-horizontal-tabs-2-heading-font',
                                    //     'type'      => 'typography',
                                    //     'title'     => __('Horizontal Tabs 2 Heading', 'wish'),
                                    //     'text-align' => false,
                                    //     'color' => false,
                                    //     'default'   => array(
                                    //         'font-size'     => '40px',
                                    //         'font-family'   => 'Montserrat',
                                    //         'font-weight' => '400',
                                    //     ),
                                    // ),

                                    // array(
                                    //     'id'        => 'wish-horizontal-tab-2-title-font1',
                                    //     'type'      => 'typography',
                                    //     'title'     => __('Horizontal Tab 2 Tilte Font 1', 'wish'),
                                    //     'text-align' => false,
                                    //     'color' => false,
                                    //     'default'   => array(
                                    //         'font-size'     => '22px',
                                    //         'font-family'   => 'Montserrat',
                                    //         'font-weight' => '400',
                                    //     ),
                                    // ),
                                    // array(
                                    //     'id'        => 'wish-horizontal-tab-2-title-font2',
                                    //     'type'      => 'typography',
                                    //     'title'     => __('Horizontal Tab 2 Tilte Font 2', 'wish'),
                                    //     'text-align' => false,
                                    //     'color' => false,
                                    //     'default'   => array(
                                    //         'font-size'     => '26px',
                                    //         'font-family'   => 'Montserrat',
                                    //         'font-weight' => '400',
                                    //     ),
                                    // ),

                                    // array(
                                    //     'id'        => 'wish-horizontal-tabs-2-details-font',
                                    //     'type'      => 'typography',
                                    //     'title'     => __('Horizontal Tab 2 Details', 'wish'),
                                    //     'text-align' => false,
                                    //     'color' => false,
                                    //     'default'   => array(
                                    //         'font-size'     => '14px',
                                    //         'font-family'   => 'Montserrat',
                                    //         'font-weight' => '400',
                                    //     ),
                                    // ),





                                    
             //                    ),
             // );
            
             // $this->sections[] = array(

             //    'icon'      => 'el-icon-magic',
             //    'submenu'   => false,
             //    'title'     => __('Portfolio', 'wish'),
             //    'subsection' => true,
             //    'desc'      => __('<p class="description">Portfolio Styles</p>', 'wish'),
             //    'fields'    => array(

             //                        array( 
             //                            'id'       => 'opt-raw',
             //                            'type'     => 'raw',
             //                            'title'    => __('', 'redux-framework-demo'),
             //                            'subtitle' => __('', 'redux-framework-demo'),
             //                            'desc'     => __('', 'redux-framework-demo'),
             //                            'content'  => '<h3 class="redux-admin-subtitle">Project Portfolio Styling</h3>',
             //                        ),

             //                        array(
             //                                    'id'        => 'wish-portfolio-title-text-style',
             //                                    'type'      => 'typography',
             //                                    'title'     => __('Typing Banner Text Styles', 'wish'),
             //                                    'color'  => false,
             //                                    'line-height' => false,
             //                                    'text-align' => false,
             //                                    'subtitle'  => __('Typing Banner Text Styles', 'wish'),
             //                                    'default'   => array(
             //                                        'font-size'     => '70px',
             //                                        'font-family'   => 'Montserrat',
             //                                        'font-weight' => '700',
             //                                    ),
             //                        ),
                                    
             //                        array(
             //                                    'id'        => 'wish-portfolio-caption-text-style',
             //                                    'type'      => 'typography',
             //                                    'title'     => __('Caption Text Styles', 'wish'),
             //                                    'color'  => false,
             //                                    'line-height' => false,
             //                                    'text-align' => false,
             //                                    'subtitle'  => __('Caption Text Styles', 'wish'),
             //                                    'default'   => array(
             //                                        'font-size'     => '18px',
             //                                        'font-family'   => 'Montserrat',
             //                                        'font-weight' => '700',
             //                                    ),
             //                        ),
                                    
             //                        array(
             //                                    'id'        => 'wish-portfolio-category-text-style',
             //                                    'type'      => 'typography',
             //                                    'title'     => __('Category Text Styles', 'wish'),
             //                                    'color'  => false,
             //                                    'line-height' => false,
             //                                    'text-align' => false,
             //                                    'subtitle'  => __('Category Text Styles', 'wish'),
             //                                    'default'   => array(
             //                                        'font-size'     => '14px',
             //                                        'font-family'   => 'Montserrat',
             //                                        'font-weight' => '400',
             //                                    ),
             //                        ),
                                    



                                    
             //                    ),
             // );

            
            $this->sections[] = array(

                'icon'      => 'el-icon-magic',
                'submenu'   => false,
                'title'     => __('Buttons & Links', 'wish'),
                'desc'      => __('<p class="description">Style Button & Links</p>', 'wish'),
                'fields'    => array(

                                    /*Links*/
                                    array( 
                                        'id'       => 'opt-raw',
                                        'type'     => 'raw',
                                        'title'    => __('', 'redux-framework-demo'),
                                        'subtitle' => __('', 'redux-framework-demo'),
                                        'desc'     => __('', 'redux-framework-demo'),
                                        'content'  => '<h3 class="redux-admin-subtitle">Body Links</h3>',
                                    ),

                                    array(
                                                'id'       => 'wish-body-links',
                                                'type'     => 'link_color',
                                                'title'    => __('Links Colors', 'redux-framework-demo'),
                                                'default'  => array(
                                                    'regular'  => '#E04B2C', 
                                                    'hover'    => '#E04B2C', 
                                                    'active'   => '#E04B2C', 
                                                    'visited'  => '#E04B2C', 
                                                    ),
                                    ),


                                    /*Regular Buttons*/
                                    array( 
                                        'id'       => 'opt-raw',
                                        'type'     => 'raw',
                                        'title'    => __('', 'redux-framework-demo'),
                                        'subtitle' => __('', 'redux-framework-demo'),
                                        'desc'     => __('', 'redux-framework-demo'),
                                        'content'  => '<h3 class="redux-admin-subtitle">Regular Button Styling</h3>',
                                    ),

                                    array(
                                        'id'       => 'wish-regular-button-bgcolor',
                                        'type'     => 'color',
                                        'title'    => __('Regular Button Background Color', 'wish'), 
                                        'subtitle' => __('Pick a background color for the Regular Button.', 'wish'),
                                        'default'  => '#df4322',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'background-color',
                                     ),

                                    array(

                                        'id'       => 'wish-regular-button-txt-color',

                                        'type'     => 'color',

                                        'title'    => __('Regular Button Text Color', 'wish'), 

                                        'subtitle' => __('Pick a Text color for the Regular Button.', 'wish'),

                                        'default'  => '#ffffff',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'color',

                                     ),

                                    array(

                                        'id'       => 'wish-regular-button-bgcolor-hover',

                                        'type'     => 'color',

                                        'title'    => __('Regular Button Background Color (Hover)', 'wish'), 

                                        'subtitle' => __('Pick a background color for the Regular Button (Hover).', 'wish'),

                                        'default'  => '#ffffff',

                                        'validate' => 'color',

                                        'transparent' => true,

                                        'mode'      => 'background-color',

                                     ),

                                    array(

                                        'id'       => 'wish-regular-button-txt-color-hover',

                                        'type'     => 'color',

                                        'title'    => __('Regular Button Text Color (Hover)', 'wish'), 

                                        'subtitle' => __('Pick a Text color for the Regular Button (Hover).', 'wish'),

                                        'default'  => '#df4322',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'color',

                                     ),

                                    array(

                                        'id'       => 'wish-regular-button-border-color',

                                        'type'     => 'color',

                                        'title'    => __('Regular Button Border Color', 'wish'), 

                                        'subtitle' => __('Pick a border color for the Regular Button.', 'wish'),

                                        'default'  => '#df4322',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'border-color',

                                     ),


                                    /*Transparent Regular Buttons*/
                                    array( 
                                        'id'       => 'opt-raw',
                                        'type'     => 'raw',
                                        'title'    => __('', 'redux-framework-demo'),
                                        'subtitle' => __('', 'redux-framework-demo'),
                                        'desc'     => __('', 'redux-framework-demo'),
                                        'content'  => '<h3 class="redux-admin-subtitle">Regular Transparent Button Styling</h3>',
                                    ),
                                    array(

                                        'id'       => 'wish-regular-transparent-button-bgcolor',

                                        'type'     => 'color',

                                        'title'    => __('Regular Transparent Button Background Color', 'wish'), 

                                        'subtitle' => __('Pick a background color for the Regular Transparent Button.', 'wish'),

                                        'default'  => '#df4322',

                                        'validate' => 'color',

                                        'transparent' => true,

                                        'mode'      => 'background-color',

                                     ),

                                    array(

                                        'id'       => 'wish-regular-transparent-button-txt-color',

                                        'type'     => 'color',

                                        'title'    => __('Regular Transparent Button Text Color', 'wish'), 

                                        'subtitle' => __('Pick a Text color for the Regular Transparent Button.', 'wish'),

                                        'default'  => '#ffffff',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'color',

                                     ),

                                    array(

                                        'id'       => 'wish-regular-transparent-button-bgcolor-hover',

                                        'type'     => 'color',

                                        'title'    => __('Regular Transparent Button Background Color (Hover)', 'wish'), 

                                        'subtitle' => __('Pick a background color for the Regular Transparent Button (Hover).', 'wish'),

                                        'default'  => '#ffffff',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'background-color',

                                     ),

                                    array(

                                        'id'       => 'wish-regular-transparent-button-txt-color-hover',

                                        'type'     => 'color',

                                        'title'    => __('Regular Transparent Button Text Color (Hover)', 'wish'), 

                                        'subtitle' => __('Pick a Text color for the Regular Transparent Button (Hover).', 'wish'),

                                        'default'  => '#df4322',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'color',

                                     ),


                                    /*Square Buttons*/
                                    array( 
                                        'id'       => 'opt-raw',
                                        'type'     => 'raw',
                                        'title'    => __('', 'redux-framework-demo'),
                                        'subtitle' => __('', 'redux-framework-demo'),
                                        'desc'     => __('', 'redux-framework-demo'),
                                        'content'  => '<h3 class="redux-admin-subtitle">Square Button Styling</h3>',
                                    ),
                                    array(

                                        'id'       => 'wish-square-button-bgcolor',

                                        'type'     => 'color',

                                        'title'    => __('Square Button Background Color', 'wish'), 

                                        'subtitle' => __('Pick a background color for the Square Button.', 'wish'),

                                        'default'  => '#296aa4',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'background-color',

                                     ),

                                    array(

                                        'id'       => 'wish-square-button-txt-color',

                                        'type'     => 'color',

                                        'title'    => __('Square Button Text Color', 'wish'), 

                                        'subtitle' => __('Pick a Text color for the Square Button.', 'wish'),

                                        'default'  => '#ffffff',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'color',

                                     ),

                                    array(

                                        'id'       => 'wish-square-button-bgcolor-hover',

                                        'type'     => 'color',

                                        'title'    => __('Square Button Background Color (Hover)', 'wish'), 

                                        'subtitle' => __('Pick a background color for the Square Button (Hover).', 'wish'),

                                        'default'  => '#296aa4',

                                        'validate' => 'color',

                                        'transparent' => true,

                                        'mode'      => 'background-color',

                                     ),

                                    array(

                                        'id'       => 'wish-square-button-txt-color-hover',

                                        'type'     => 'color',

                                        'title'    => __('Square Button Text Color (Hover)', 'wish'), 

                                        'subtitle' => __('Pick a Text color for the Square Button (Hover).', 'wish'),

                                        'default'  => '#296aa4',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'color',

                                     ),

                                    array(

                                        'id'       => 'wish-square-button-border-color',

                                        'type'     => 'color',

                                        'title'    => __('Square Button Border Color', 'wish'), 

                                        'subtitle' => __('Pick a border color for the Square Button.', 'wish'),

                                        'default'  => '#296aa4',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'border-color',

                                     ),

                                    /*Square Transparent Buttons*/
                                    array( 
                                        'id'       => 'opt-raw',
                                        'type'     => 'raw',
                                        'title'    => __('', 'redux-framework-demo'),
                                        'subtitle' => __('', 'redux-framework-demo'),
                                        'desc'     => __('', 'redux-framework-demo'),
                                        'content'  => '<h3 class="redux-admin-subtitle">Square Transparent Button Styling</h3>',
                                    ),
                                    array(

                                        'id'       => 'wish-transparent-square-button-bgcolor',

                                        'type'     => 'color',

                                        'title'    => __('Square Transparent Button Background Color', 'wish'), 

                                        'subtitle' => __('Pick a background color for the Square Transparent Button.', 'wish'),

                                        'default'  => '#296aa4',

                                        'validate' => 'color',

                                        'transparent' => true,

                                        'mode'      => 'background-color',

                                     ),

                                    array(

                                        'id'       => 'wish-transparent-square-button-txt-color',

                                        'type'     => 'color',

                                        'title'    => __('Square Transparent Button Text Color', 'wish'), 

                                        'subtitle' => __('Pick a Text color for the Square Transparent Button.', 'wish'),

                                        'default'  => '#296aa4',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'color',

                                     ),

                                    array(

                                        'id'       => 'wish-transparent-square-button-bgcolor-hover',

                                        'type'     => 'color',

                                        'title'    => __('Square Transparent Button Background Color (Hover)', 'wish'), 

                                        'subtitle' => __('Pick a background color for the Square Transparent Button (Hover).', 'wish'),

                                        'default'  => '#296aa4',

                                        'validate' => 'color',

                                        'transparent' => true,

                                        'mode'      => 'background-color',

                                     ),

                                    array(

                                        'id'       => 'wish-transparent-square-button-txt-color-hover',

                                        'type'     => 'color',

                                        'title'    => __('Square Transparent Button Text Color (Hover)', 'wish'), 

                                        'subtitle' => __('Pick a Text color for the Square Transparent Button (Hover).', 'wish'),

                                        'default'  => '#ffffff',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'color',

                                     ),

                                    ///////////
                                    /*Dark Square Buttons*/
                                    array( 
                                        'id'       => 'opt-raw',
                                        'type'     => 'raw',
                                        'title'    => __('', 'redux-framework-demo'),
                                        'subtitle' => __('', 'redux-framework-demo'),
                                        'desc'     => __('', 'redux-framework-demo'),
                                        'content'  => '<h3 class="redux-admin-subtitle">Dark Square Button Styling</h3>',
                                    ),
                                    array(

                                        'id'       => 'wish-dark-square-button-bgcolor',

                                        'type'     => 'color',

                                        'title'    => __('Dark Square Button Background Color', 'wish'), 

                                        'subtitle' => __('Pick a background color for the Dark Square Button.', 'wish'),

                                        'default'  => '#000',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'background-color',

                                     ),

                                    array(

                                        'id'       => 'wish-dark-square-button-txt-color',

                                        'type'     => 'color',

                                        'title'    => __('Dark Square Button Text Color', 'wish'), 

                                        'subtitle' => __('Pick a Text color for the Dark Square Button.', 'wish'),

                                        'default'  => '#ffffff',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'color',

                                     ),

                                    array(

                                        'id'       => 'wish-dark-square-button-bgcolor-hover',

                                        'type'     => 'color',

                                        'title'    => __('Dark Square Button Background Color (Hover)', 'wish'), 

                                        'subtitle' => __('Pick a background color for the Dark Square Button (Hover).', 'wish'),

                                        'default'  => '#000',

                                        'validate' => 'color',

                                        'transparent' => true,

                                        'mode'      => 'background-color',

                                     ),

                                    array(

                                        'id'       => 'wish-dark-square-button-txt-color-hover',

                                        'type'     => 'color',

                                        'title'    => __('Dark Square Button Text Color (Hover)', 'wish'), 

                                        'subtitle' => __('Pick a Text color for the Dark Square Button (Hover).', 'wish'),

                                        'default'  => '#000',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'color',

                                     ),

                                    array(

                                        'id'       => 'wish-dark-square-button-border-color',

                                        'type'     => 'color',

                                        'title'    => __('Dark Square Button Border Color', 'wish'), 

                                        'subtitle' => __('Pick a border color for the Dark Square Button.', 'wish'),

                                        'default'  => '#000',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'border-color',

                                     ),

                                    /*Dark Square Transparent Buttons*/
                                    array( 
                                        'id'       => 'opt-raw',
                                        'type'     => 'raw',
                                        'title'    => __('', 'redux-framework-demo'),
                                        'subtitle' => __('', 'redux-framework-demo'),
                                        'desc'     => __('', 'redux-framework-demo'),
                                        'content'  => '<h3 class="redux-admin-subtitle">Dark Square Transparent Button Styling</h3>',
                                    ),
                                    array(

                                        'id'       => 'wish-transparent-dark-square-button-bgcolor',

                                        'type'     => 'color',

                                        'title'    => __('Dark Square Transparent Button Background Color', 'wish'), 

                                        'subtitle' => __('Pick a background color for the Dark Square Transparent Button.', 'wish'),

                                        'default'  => '#000',

                                        'validate' => 'color',

                                        'transparent' => true,

                                        'mode'      => 'background-color',

                                     ),

                                    array(

                                        'id'       => 'wish-transparent-dark-square-button-txt-color',

                                        'type'     => 'color',

                                        'title'    => __('Dark Square Transparent Button Text Color', 'wish'), 

                                        'subtitle' => __('Pick a Text color for the Dark Square Transparent Button.', 'wish'),

                                        'default'  => '#000',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'color',

                                     ),

                                    array(

                                        'id'       => 'wish-transparent-dark-square-button-bgcolor-hover',

                                        'type'     => 'color',

                                        'title'    => __('Dark Square Transparent Button Background Color (Hover)', 'wish'), 

                                        'subtitle' => __('Pick a background color for the Dark Square Transparent Button (Hover).', 'wish'),

                                        'default'  => '#000',

                                        'validate' => 'color',

                                        'transparent' => true,

                                        'mode'      => 'background-color',

                                     ),

                                    array(

                                        'id'       => 'wish-transparent-dark-square-button-txt-color-hover',

                                        'type'     => 'color',

                                        'title'    => __('Dark Square Transparent Button Text Color (Hover)', 'wish'), 

                                        'subtitle' => __('Pick a Text color for the Dark Square Transparent Button (Hover).', 'wish'),

                                        'default'  => '#ffffff',

                                        'validate' => 'color',

                                        'transparent' => false,

                                        'mode'      => 'color',

                                     ),

                                ),

             );


            $this->sections[] = array(

                'icon'      => 'el-icon-magic',
                'submenu'   => false,
                'title'     => __('Menu Styling', 'wish'),
                'desc'      => __('<p class="description">Menu Styling</p>', 'wish'),
                'fields'    => array(

                                    /*Menu*/
                                    array( 
                                        'id'       => 'wish-menu-dropdown-bgcolor',
                                        'type'     => 'color_rgba',
                                        'title'    => __('Dropdown Background Color', 'wish'), 
                                        'subtitle' => __('Background color for the submenu', 'wish'),
                                        'default'  => array(
                                            'color' => '#ffffff', 
                                            'alpha' => '1.0'
                                        ),
                                        'mode'     => 'background',
                                    ),







                                    array( 
                                        'id'       => 'opt-raw',
                                        'type'     => 'raw',
                                        'title'    => __('', 'redux-framework-demo'),
                                        'subtitle' => __('', 'redux-framework-demo'),
                                        'desc'     => __('', 'redux-framework-demo'),
                                        'content'  => '<h3 class="redux-admin-subtitle">Floating Menu <a target="_blank" class="wish_admin_screenshot" href="http://i.imgur.com/llutAg0.png">(Screenshot)</a></h3>',
                                    ),


                                    // array(

                                    //             'id'       => 'wish-floating-menu',
                                    //             'type'     => 'checkbox',
                                    //             'title'    => __('Floating Menu', 'wish'), 
                                    //             'subtitle' => __('Floating menu on the home page', 'wish'),
                                    //             'default'  => '0'
                                    // ),


                                    array(
                                        'id'       => 'wish-floating-menu',
                                        'type'     => 'switch',
                                        'title'    => __('Floating Menu', 'wish'), 
                                        'subtitle' => __('Floating menu on the home page', 'wish'),
                                        'default'  => false,
                                    ),






                                    array(
                                        'id'             => 'wish-menu-top-margin',
                                        'type'           => 'spacing',
                                        'mode'           => 'margin',
                                        'right'           => false,
                                        'bottom'           => false,
                                        'margin-right'   => false, 
                                        'margin-bottom'  => false, 
                                        'margin-left'    => false,
                                        'left' => false,
                                        'units'          => array('px'),
                                        'units_extended' => 'false',
                                        'title'          => __('Menu Top Margin', 'wish'),
                                        'subtitle'       => __('Allow you to set top margin for the menu', 'wish'),
                                        'desc'           => __('You can use negative numbers for reverse direction.', 'wish'),
                                        'default'            => array(
                                            'margin-top'     => '15', 
                                            'units'          => 'px', 
                                        )
                                    ),


                                    array( 
                                        'id'       => 'wish-menu-bgcolor',
                                        'type'     => 'color_rgba',
                                        'title'    => __('Menu Background Color (Floating)', 'wish'), 
                                        'subtitle' => __('Pick a background color for the floating menu (if enabled)', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => array(
                                            'color' => '#ffffff', 
                                            'alpha' => '1.0'
                                        ),
                                        'mode'     => 'background',
                                    ),




                                    array(
                                        'id' => 'wish-menu-border-radius',
                                        'type' => 'slider',
                                        'title' => __('Menu Border Radius', 'wish'),
                                        'subtitle' => __('Set how curvy the menu borders are', 'wish'),
                                        "default" => 0,
                                        "min" => 0,
                                        "step" => 1,
                                        "max" => 20,
                                        'display_value' => 'text'
                                    ),


                                    array(
                                                'id'        => 'wish-menu-title',
                                                'type'      => 'typography',
                                                'title'     => __('Menu Title Styles (Floating)', 'wish'),
                                                'line-height' => false,
                                                'text-align' => false,
                                                'subtitle'  => __('Menu Title Styles', 'wish'),
                                                'default'   => array(
                                                    'font-size'     => '14px',
                                                    'font-family'   => 'Montserrat',
                                                    'font-weight' => '700',
                                                    'color'  => '#333',
                                                ),
                                    ),


                                    array(
                                        'id'       => 'wish-menu-float-title-color-hover',
                                        'type'     => 'color',
                                        'title'    => __('Menu Title Color (Hover)', 'wish'), 
                                        'subtitle' => __('Pick a color for the Menu Title when hover.', 'wish'),
                                        'default'  => '#333',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'color',
                                     ),




                                    array( 
                                        'id'       => 'opt-raw',
                                        'type'     => 'raw',
                                        'title'    => __('', 'redux-framework-demo'),
                                        'subtitle' => __('', 'redux-framework-demo'),
                                        'desc'     => __('', 'redux-framework-demo'),
                                        'content'  => '<h3 class="redux-admin-subtitle">Fixed Menu</h3>',
                                    ),


                                    array(
                                        'id'       => 'wish-menu-bgcolor-inner',
                                        'type'     => 'color',
                                        'title'    => __('Menu Background Color (Fixed)', 'wish'), 
                                        'subtitle' => __('Pick a background color for the fixed menu', 'wish'),
                                        'default'  => '#ffffff',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'background-color',
                                     ),








                                    array(
                                                'id'        => 'wish-menu-title-pages',
                                                'type'      => 'typography',
                                                'title'     => __('Menu Title Styles (Fixed)', 'wish'),
                                                'line-height' => false,
                                                'text-align' => false,
                                                'subtitle'  => __('Menu Styles for non-floating menu', 'wish'),
                                                'default'   => array(
                                                    'font-size'     => '14px',
                                                    'font-family'   => 'Montserrat',
                                                    'font-weight' => '700',
                                                    'color'  => '#333',
                                                ),
                                    ),


                                    array(
                                                'id'        => 'wish-mega-menu-title',
                                                'type'      => 'typography',
                                                'title'     => __('Mega Menu Title Styles', 'wish'),
                                                'line-height' => false,
                                                'text-align' => false,
                                                'subtitle'  => __('Mega Menu Title Styles', 'wish'),
                                                'default'   => array(
                                                    'font-size'     => '14px',
                                                    'font-family'   => 'Montserrat',
                                                    'font-weight' => '700',
                                                    'color'  => '#333',
                                                ),
                                    ),                                    


                                    array(
                                        'id'       => 'wish-menu-title-color-hover',
                                        'type'     => 'color',
                                        'title'    => __('Menu Title Color (Hover)', 'wish'), 
                                        'subtitle' => __('Pick a color for the Menu Title when hover.', 'wish'),
                                        'default'  => '#333',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'color',
                                     ),

                                    array(
                                                'id'        => 'wish-menu-font',
                                                'type'      => 'typography',
                                                'title'     => __('Menu Font', 'wish'),
                                                'line-height' => false,
                                                'text-align' => false,
                                                'subtitle'  => __('Submenu Font', 'wish'),
                                                'default'   => array(
                                                    'font-size'     => '14px',
                                                    'font-family'   => 'Montserrat',
                                                    'font-weight' => '400',
                                                    'color'  => '#333',
                                                ),
                                    ),

                                     array(
                                        'id'       => 'wish-menu-color-hover',
                                        'type'     => 'color',
                                        'title'    => __('Submenu Font Color (Hover)', 'wish'), 
                                        'subtitle' => __('Pick a color for the Menu when hover.', 'wish'),
                                        'default'  => '#169fda',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'color',
                                     ),

                                    

                                    /*Responsive Menu*/
                                    array( 
                                        'id'       => 'opt-raw',
                                        'type'     => 'raw',
                                        'title'    => __('', 'redux-framework-demo'),
                                        'subtitle' => __('', 'redux-framework-demo'),
                                        'desc'     => __('', 'redux-framework-demo'),
                                        'content'  => '<h3 class="redux-admin-subtitle">Responsive Menu</h3>',
                                    ),
                                   
                                    array(
                                        'id'       => 'wish-res-menu-bgcolor',
                                        'type'     => 'color',
                                        'title'    => __('Responsive Menu Background Color', 'wish'), 
                                        'subtitle' => __('Pick a background color for the Responsive Menu.', 'wish'),
                                        'default'  => '#141414',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'background-color',
                                     ),  

                                    array(
                                                'id'        => 'wish-res-menu-font',
                                                'type'      => 'typography',
                                                'title'     => __('Responsive Menu Font', 'wish'),
                                                'line-height' => false,
                                                'text-align' => false,
                                                'subtitle'  => __('Responsive Menu Font', 'wish'),
                                                'default'   => array(
                                                    'font-size'     => '14px',
                                                    'font-family'   => 'Montserrat',
                                                    'font-weight' => '400',
                                                    'color'  => '#fff',
                                                ),
                                    ),
                                    
                                ),

             );


         



            //loading screen settings
            $this->sections[] = array(

                'icon'      => 'el-icon-repeat-alt',
                'submenu'   => false,
                'title'     => __('Loading Screen', 'wish'),
                'desc'      => __('<p class="description">Settings For The Loading Screen</p>', 'wish'),
                'fields'    => array(

                                            array(

                                                'id'       => 'wish-show-progressbar',
                                                'type'     => 'switch',
                                                'title'    => __('Show Loading Screen?', 'wish'), 
                                                'subtitle' => __('Show Progress bar when loading pages?', 'wish'),
                                                'default'  => false,
                                            ),

                                            array(
                                                'id'       => 'wish-show-loading-logo',
                                                'type'     => 'switch',
                                                'title'    => __('Show Logo in Loading Screen', 'wish'), 
                                                'subtitle' => __('Show Logo in Loading Screen', 'wish'),
                                                'default'  => true,
                                                'customizer'       => false,
                                            ),

                                            array(

                                                'id'       => 'wish-loading-screen-image',
                                                'type'     => 'media',
                                                'height'   => '60px',
                                                'url'      => true,
                                                'title'    => __('Loading Image', 'wish'),
                                                'desc'     => __('', 'wish'),
                                                'subtitle' => __('Upload Any Image For The loading screen', 'wish'),
                                                'default'  => array(
                                                    'url'  => get_template_directory_uri() . '/images/icons/progress/progress.gif'
                                                ),
                                            ),

                                            array(
                                                'id'        => 'wish-loading-select-gif',
                                                'type'      => 'image_select',
                                                'title'     => __('Select A Preloader', 'wish'),
                                                'subtitle'  => __('Only works if the above loading image is empty', 'wish'),
                                                'options'   => array(
                                                                        '1' => array('alt' => '1',       'img' => get_template_directory_uri() . '/images/icons/progress/1.gif'),
                                                                        '2' => array('alt' => '2',       'img' => get_template_directory_uri() . '/images/icons/progress/2.gif'),
                                                                        '3' => array('alt' => '3',       'img' => get_template_directory_uri() . '/images/icons/progress/3.gif'),
                                                                        '4' => array('alt' => '4',       'img' => get_template_directory_uri() . '/images/icons/progress/4.gif'),
                                                                        '5' => array('alt' => '5',       'img' => get_template_directory_uri() . '/images/icons/progress/5.gif'),
                                                                        '6' => array('alt' => '6',       'img' => get_template_directory_uri() . '/images/icons/progress/6.gif'),
                                                                        '7' => array('alt' => '7',       'img' => get_template_directory_uri() . '/images/icons/progress/7.gif'),
                                                                        '8' => array('alt' => '8',       'img' => get_template_directory_uri() . '/images/icons/progress/8.gif'),
                                                                        '9' => array('alt' => '9',       'img' => get_template_directory_uri() . '/images/icons/progress/9.gif'),
                                                                        '10' => array('alt' => '10',       'img' => get_template_directory_uri() . '/images/icons/progress/10.gif'),
                                                                        '11' => array('alt' => '11',       'img' => get_template_directory_uri() . '/images/icons/progress/11.gif'),
                                                                        '12' => array('alt' => '12',       'img' => get_template_directory_uri() . '/images/icons/progress/12.gif'),
                                                                    ),
                                                                    'default'   => '12'
                                            ),





                                            array(
                                                'id'       => 'wish-loading-screen-bgcolor',
                                                'type'     => 'color',
                                                'title'    => __('Background', 'wish'), 
                                                'subtitle' => __('Pick a background color for Loading Screen', 'wish'),
                                                'default'  => '#ffffff',
                                                'validate' => 'color',
                                                'transparent' => false,
                                                'mode'      => 'background-color',
                                             ),


                                ),

             );




            //footer settings
            $this->sections[] = array(

                'icon'      => 'el-icon-inbox',
                'submenu'   => false,
                'title'     => __('Footer Settings', 'wish'),
                'desc'      => __('<p class="description">Settings for the theme footer</p>', 'wish'),
                'fields'    => array(
 
                                    array(

                                        'id'       => 'wish-hide-footer-level-1',
                                        'type'     => 'checkbox',
                                        'title'    => __('Hide Footer level 1', 'wish'), 
                                        'subtitle' => __('Hide Footer level 1', 'wish'),
                                        'default'  => true,
                                        'customizer'       => false,
                                    ),

                                    array(
                                        'id'        => 'wish-footer-pattern',
                                        'type'      => 'image_select',
                                        'title'     => __('Footer Type', 'wish'),
                                        'subtitle'  => __('Choose a footer type', 'wish'),
                                        'options'   => array(
                                            '1' => array('alt' => '1',       'img' => get_template_directory_uri() . '/images/footer/1.jpg'),
                                            '2' => array('alt' => '2',       'img' => get_template_directory_uri() . '/images/footer/2.jpg'),
                                            '3' => array('alt' => '3',       'img' => get_template_directory_uri() . '/images/footer/3.jpg'),
                                            '4' => array('alt' => '4',       'img' => get_template_directory_uri() . '/images/footer/4.jpg'),
                                            '5' => array('alt' => '5',       'img' => get_template_directory_uri() . '/images/footer/5.jpg'),
                                            '6' => array('alt' => '6',       'img' => get_template_directory_uri() . '/images/footer/6.jpg'),
                                        ),
                                        'default'   => '4'
                                    ),
                                    
                                    
                                    array(
                                        'id'       => 'get-in-touch',
                                        'type'     => 'checkbox',
                                        'title'    => __('Get in Touch', 'wish'), 
                                        'subtitle' => __('Show get in touch section', 'wish'),
                                        'default'  => '1'
                                    ),

                                    array(
                                        'id'       => 'getintouch-title',
                                        'type'     => 'text',
                                        'title'    => __('Title', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "Want to work with us?",
                                        'validate' => 'no_html'
                                    ),

                                    array(
                                        'id'       => 'getintouch-subtitle',
                                        'type'     => 'text',
                                        'title'    => __('Subtitle', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "Get in touch and we'll walk you through the rest.",
                                        'validate' => 'html'
                                    ),

                                    array(
                                        'id'       => 'getintouch-button-text',
                                        'type'     => 'text',
                                        'title'    => __('Subtitle', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "Get in Touch",
                                        'validate' => 'no_html'
                                    ),


                                    array(
                                        'id'       => 'getintouch-button-link',
                                        'type'     => 'text',
                                        'title'    => __('Link to the page', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "#",
                                        'validate' => 'url',
                                        'required' => false, 
                                    ),

                                ),
             );

            
            $this->sections[] = array(

                'icon'      => 'el-icon-inbox',
                'submenu'   => false,
                'title'     => __('Footer 1', 'wish'),
                'desc'      => __('<p class="description">Settings for the theme footer</p>', 'wish'),
                'subsection' => true,
                'fields'    => array(

                                    array(

                                        'id'       => 'wish-footer1-bgimage',
                                        'type'     => 'media',
                                        'height'   => '50px',
                                        'url'      => true,
                                        'title'    => __('Background Image', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'subtitle' => __('Upload Any Image For Background', 'wish'),
                                        'default'  => array(
                                            'url'  => get_template_directory_uri() . '/images/footer/map.jpg'
                                        ),
                                    ),

 
                                    
                                    array(
                                        'id'       => 'wish-footer1-social-area',
                                        'type'     => 'text',
                                        'title'    => __('Follow us', 'wish'),
                                        'subtitle' => __('Social Media Buttons', 'wish'),
                                        'desc'     => __('Social Media Buttons', 'wish'),
                                        'default'  => 'follow Us',
                                        'validate' => 'no_html'
                                    ),
                                    array(
                                                'id'        => 'wish-footer1-social-font',
                                                'type'      => 'typography',
                                                'title'     => __('Social Media title Font', 'wish'),
                                                'line-height' => false,
                                                'text-align' => false,
                                                'subtitle'  => __('Font Styles', 'wish'),
                                                'default'   => array(
                                                    'font-size'     => '30px',
                                                    'font-family'   => 'Montserrat',
                                                    'font-weight' => '400',
                                                    'color'  => '#df4322',
                                                ),
                                    ),
                                    array(
                                        'id'       => 'wish-footer1-facebook',
                                        'type'     => 'text',
                                        'title'    => __('Facebook', 'wish'),
                                        'subtitle' => __('Facebook Buttons', 'wish'),
                                        'desc'     => __('facebook link', 'wish'),
                                        'default'  => '',
                                        'validate' => 'url'
                                    ),
                                    array(
                                        'id'       => 'wish-footer1-twitter',
                                        'type'     => 'text',
                                        'title'    => __('Twitter', 'wish'),
                                        'subtitle' => __('Twitter Buttons', 'wish'),
                                        'desc'     => __('twitter link', 'wish'),
                                        'default'  => '',
                                        'validate' => 'url'
                                    ),
                                    array(
                                        'id'       => 'wish-footer1-google',
                                        'type'     => 'text',
                                        'title'    => __('Google +', 'wish'),
                                        'subtitle' => __('Google plus Buttons', 'wish'),
                                        'desc'     => __('Google plus link', 'wish'),
                                        'default'  => '',
                                        'validate' => 'url'
                                    ),

                                    array(
                                        'id'       => 'wish-footer1-title',
                                        'type'     => 'text',
                                        'title'    => __('Title', 'wish'),
                                        'subtitle' => __('', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "Let's make something great together",
                                        'validate' => 'html'
                                    ),

                                    array(
                                            'id'        => 'wish-footer1-title-font',
                                            'type'      => 'typography',
                                            'title'     => __('Footer title Font', 'wish'),
                                            'line-height' => false,
                                            'text-align' => false,
                                            'subtitle'  => __('Font Styles', 'wish'),
                                            'default'   => array(
                                                'font-size'     => '30px',
                                                'font-family'   => 'Montserrat',
                                                'font-weight' => '700',
                                                'color'  => '#df4322',
                                            ),
                                    ),
                                    
                                    array(
                                        'id'       => 'wish-footer1-phone',
                                        'type'     => 'text',
                                        'title'    => __('Phone', 'wish'),
                                        'subtitle' => __('Phone Number', 'wish'),
                                        'desc'     => __('Number', 'wish'),
                                        'default'  => "+97 5 9505613",
                                        'validate' => 'no_html'
                                    ),

                                    array(
                                        'id'       => 'wish-footer1-email',
                                        'type'     => 'text',
                                        'title'    => __('Email', 'wish'),
                                        'subtitle' => __('Email', 'wish'),
                                        'desc'     => __('Email Address', 'wish'),
                                        'default'  => "info@wish.co.uk",
                                        'validate' => 'email'
                                    ),

                                    array(
                                        'id'       => 'wish-footer1-web',
                                        'type'     => 'text',
                                        'title'    => __('Web', 'wish'),
                                        'subtitle' => __('Link to Web', 'wish'),
                                        'desc'     => __('Link to a website', 'wish'),
                                        'default'  => "http://wish.co.uk",
                                        'validate' => 'url'
                                    ),

                                    array(
                                            'id'        => 'wish-footer1-contact-font',
                                            'type'      => 'typography',
                                            'title'     => __('Contact Info Font', 'wish'),
                                            'text-align' => false,
                                            'subtitle'  => __('Font Styles', 'wish'),
                                            'default'   => array(
                                                'font-size'     => '26px',
                                                'font-family'   => 'Montserrat',
                                                'line-height' => '16px',
                                                'font-weight' => '700',
                                                'color'  => '#000',
                                            ),
                                    ),

                                    array(
                                        'id'       => 'wish-footer1-contact-shortcode',
                                        'type'     => 'text',
                                        'title'    => __('Contact Form Shortcode', 'wish'),
                                        'subtitle' => __('Leaving blank will remove the button', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "[contact-form-7 id='648' title='Footer Contact Form']"
                                    ),


                                    array(
                                        'id'       => 'wish-footer1-address',
                                        'type'     => 'textarea',
                                        'title'    => __('Address', 'wish'),
                                        'subtitle' => __('', 'wish'),
                                        'desc'     => __('address', 'wish'),
                                        'default'  => "32 Ave of the Americas, 5th Floor, New York, New York 10013",
                                        'validate' => 'html'
                                    ),

                                    array(
                                            'id'        => 'wish-footer1-address-font',
                                            'type'      => 'typography',
                                            'title'     => __('Address Font', 'wish'),
                                            'text-align' => false,
                                            'line-height' => false,
                                            'subtitle'  => __('Font Styles', 'wish'),
                                            'default'   => array(
                                                'font-size'     => '22px',
                                                'font-family'   => 'Montserrat',
                                                'font-weight' => '400',
                                                'color'  => '#000',
                                            ),
                                    ),


                                    array(
                                        'id'       => 'wish-footer1-contact-text',
                                        'type'     => 'text',
                                        'title'    => __('Contact Form Link Text', 'wish'),
                                        'desc'     => __('Leave Blank to hide the link', 'wish'),
                                        'default'  => "Web Form",
                                        'validate' => 'html'
                                    ),


                                    array(
                                        'id'       => 'wish-footer1-map-text',
                                        'type'     => 'text',
                                        'title'    => __('Map Link Text', 'wish'),
                                        'desc'     => __('Leave Blank to hide the link', 'wish'),
                                        'default'  => "View Map",
                                        'validate' => 'no_html',
                                    ),


                                    array(
                                            'id'        => 'wish-footer1-address-link-font',
                                            'type'      => 'typography',
                                            'title'     => __('Copyright Font', 'wish'),
                                            'text-align' => false,
                                            'line-height' => false,
                                            'subtitle'  => __('Font Styles', 'wish'),
                                            'default'   => array(
                                                'font-size'     => '20px',
                                                'font-family'   => 'Montserrat',
                                                'font-weight' => '400',
                                                'color'  => '#000',
                                            ),
                                    ),


                                    array(
                                        'id'       => 'wish-footer1-copyright',
                                        'type'     => 'text',
                                        'title'    => __('Copyright Text', 'wish'),
                                        'subtitle' => __('Bottom Bar Text', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "Copyright &copy; 2015 Wish Theme. All rights reserved.",
                                        'validate' => 'html'
                                    ),


                                    
                                ),
             );

            $this->sections[] = array(

                'icon'      => 'el-icon-inbox',
                'submenu'   => false,
                'title'     => __('Footer 2', 'wish'),
                'desc'      => __('<p class="description">Settings for the theme footer</p>', 'wish'),
                'subsection' => true,
                'fields'    => array(

                                    array(
                                        'id'       => 'wish-footer2-bg-color',
                                        'type'     => 'color',
                                        'title'    => __('Background', 'wish'), 
                                        'subtitle' => __('Pick a background color for the Icons', 'wish'),
                                        'default'  => '#F4F4F4',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'background-color',
                                     ),



                                    array(
                                            'id'        => 'wish-footer2-title-fonts',
                                            'type'      => 'typography',
                                            'title'     => __('Title Fonts', 'wish'),
                                            'text-align' => false,
                                            'line-height' => false,
                                            'subtitle'  => __('Font Styles', 'wish'),
                                            'default'   => array(
                                                'font-size'     => '30px',
                                                'font-family'   => 'Montserrat',
                                                'font-weight' => '400',
                                                'color'  => '#000',
                                            ),
                                    ),


                                    array(
                                            'id'        => 'wish-footer2-text-fonts',
                                            'type'      => 'typography',
                                            'title'     => __('Text Fonts', 'wish'),
                                            'text-align' => false,
                                            'line-height' => false,
                                            'subtitle'  => __('Font Styles', 'wish'),
                                            'default'   => array(
                                                'font-size'     => '16px',
                                                'font-family'   => 'Montserrat',
                                                'font-weight' => '400',
                                                'color'  => '#000',
                                            ),
                                    ),

                                    array(
                                        'id'       => 'wish-footer2-contact-icons-color',
                                        'type'     => 'color',
                                        'title'    => __('Icon Colors', 'wish'), 
                                        'subtitle' => __('Pick a color for the Icons', 'wish'),
                                        'default'  => '#000',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'color',
                                     ), 


 
                                    array( 
                                        'id'       => 'wish-footer2-getintouch-label',
                                        'type'     => 'raw',
                                        'title'    => __('', 'wish'),
                                        'subtitle' => __('', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'content'  => '<h3 class="redux-admin-subtitle">Contact Details</h3>',
                                    ),


                                    array(
                                        'id'       => 'wish-footer2-getintouch-text',
                                        'type'     => 'text',
                                        'title'    => __('Title Text', 'wish'),
                                        'subtitle' => __('Get In Touch Title Text', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "Get in Touch",
                                        'validate' => 'no_html'
                                    ),



                                    array(
                                        'id'       => 'wish-footer2-phone-text',
                                        'type'     => 'text',
                                        'title'    => __('Phone', 'wish'),
                                        'subtitle' => __('Phone Text', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => " +97 8498 3607 333",
                                        'validate' => 'no_html',
                                    ),


                                    array(
                                        'id'       => 'wish-footer2-time-text',
                                        'type'     => 'text',
                                        'title'    => __('Timing', 'wish'),
                                        'subtitle' => __('Date/Time Text', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => " Monday - Friday: 9am - 4pm",
                                        'validate' => 'html'
                                    ),

                                    array(
                                        'id'       => 'wish-footer2-fax-text',
                                        'type'     => 'text',
                                        'title'    => __('Fax', 'wish'),
                                        'subtitle' => __('Fax Text', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => " +97 0135 846 927",
                                        'validate' => 'no_html'

                                    ),

                                    array(
                                        'id'       => 'wish-footer2-address-text',
                                        'type'     => 'text',
                                        'title'    => __('Address', 'wish'),
                                        'subtitle' => __('Address Text', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => " 350 Fourth Avenue, 34th floor New York, USA",
                                        'validate' => 'no_html',
                                    ),





                                            array( 
                                                'id'       => 'wish-footer2-followus-label',
                                                'type'     => 'raw',
                                                'title'    => __('', 'wish'),
                                                'subtitle' => __('', 'wish'),
                                                'desc'     => __('', 'wish'),
                                                'content'  => '<h3 class="redux-admin-subtitle">Follow Us</h3>',
                                            ),



                                    array(
                                        'id'       => 'wish-footer2-followus-text',
                                        'type'     => 'text',
                                        'title'    => __('Follow Us Text', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "Follow Us",
                                        'validate' => 'no_html'
                                    ),

                                    array(
                                        'id'       => 'wish-footer2-followus-fb',
                                        'type'     => 'text',
                                        'title'    => __('Facebook Link', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "http://www.facebook.com",
                                        'validate' => 'url'
                                    ),

                                    array(
                                        'id'       => 'wish-footer2-followus-tw',
                                        'type'     => 'text',
                                        'title'    => __('Twitter Link', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "http://www.twitter.com",
                                        'validate' => 'url',

                                    ),

                                    array(
                                        'id'       => 'wish-footer2-followus-gp',
                                        'type'     => 'text',
                                        'title'    => __('Google Plus Link', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "http://www.plus.google.com",
                                        'validate' => 'url',
                                    ),

                                    array(
                                        'id'       => 'wish-footer2-followus-skype',
                                        'type'     => 'text',
                                        'title'    => __('Skype', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "asdasd",
                                        'validate' => 'no_html',
                                    ),

                                    array(
                                        'id'       => 'wish-footer2-followus-li',
                                        'type'     => 'text',
                                        'title'    => __('Linkedin Link', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "http://www.linkedin.com",
                                        'validate' => 'url',
                                    ),



                                            array( 
                                                'id'       => 'wish-footer2-contactform-label',
                                                'type'     => 'raw',
                                                'title'    => __('', 'wish'),
                                                'subtitle' => __('', 'wish'),
                                                'desc'     => __('', 'wish'),
                                                'content'  => '<h3 class="redux-admin-subtitle">Contact Form</h3>',
                                            ),


                                    array(
                                        'id'       => 'wish-footer2-contact-form',
                                        'type'     => 'text',
                                        'title'    => __('Contact Form 7 Shortcode', 'wish'),
                                        'subtitle' => __('Shortcode', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "[contact-form-7 id='653' title='Footer 2 Contact Form']",
                                    ),


                                    array(
                                        'id'       => 'wish-footer2-bottom-text',
                                        'type'     => 'text',
                                        'title'    => __('Bottom Text', 'wish'),
                                        'subtitle' => __('Copyright etc', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "Copyright &copy; 2015 Wish Theme. All rights reserved.",
                                        'validate' => 'html',
                                    ),

                                    
                                ),
             );

            $this->sections[] = array(

                'icon'      => 'el-icon-inbox',
                'submenu'   => false,
                'title'     => __('Footer 3', 'wish'),
                'desc'      => __('<p class="description">Settings for the theme footer</p>', 'wish'),
                'subsection' => true,
                'fields'    => array(
 
                                    array(
                                        'id'       => 'wish-footer3-bgcolor',
                                        'type'     => 'color',
                                        'title'    => __('background Color', 'wish'), 
                                        'subtitle' => __('Choose a color', 'wish'),
                                        'default'  => '#fff',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'background-color',
                                     ),

                                    array(
                                        'id'       => 'wish-footer3-left-text',
                                        'type'     => 'text',
                                        'title'    => __('Text on the left', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "Copyrights &copy; 2015, allrights reserved, Wish Theme",
                                        'validate' => 'html',
                                    ),

                                    array(
                                            'id'        => 'wish-footer3-title-font',
                                            'type'      => 'typography',
                                            'title'     => __('Title Text Font', 'wish'),
                                            'text-align' => false,
                                            'line-height' => false,
                                            'subtitle'  => __('Font Styles', 'wish'),
                                            'default'   => array(
                                                'font-size'     => '14px',
                                                'font-family'   => 'Roboto',
                                                'font-weight' => '400',
                                                'color'  => '#000',
                                            ),
                                    ),


                                            array( 
                                                'id'       => 'wish-footer3-social',
                                                'type'     => 'raw',
                                                'title'    => __('', 'wish'),
                                                'subtitle' => __('', 'wish'),
                                                'desc'     => __('', 'wish'),
                                                'content'  => '<h3 class="redux-admin-subtitle">Social Section (Right)</h3>',
                                            ),




                                    array(
                                        'id'       => 'wish-footer3-social-text',
                                        'type'     => 'text',
                                        'title'    => __('Social Links Title', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "Get social",
                                        'validate' => 'no_html',
                                    ),


                                    array(
                                        'id'       => 'wish-footer3-icons-color',
                                        'type'     => 'color',
                                        'title'    => __('Icons Colors', 'wish'), 
                                        'subtitle' => __('Choose a color', 'wish'),
                                        'default'  => '#747474',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'color',
                                     ),



                                    array(
                                        'id'       => 'wish-footer3-social-fb',
                                        'type'     => 'text',
                                        'title'    => __('Facebook Link', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "http://www.facebook.com",
                                        'validate' => 'url',
                                    ),

                                    array(
                                        'id'       => 'wish-footer3-social-tw',
                                        'type'     => 'text',
                                        'title'    => __('Twitter Link', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "http://www.twitter.com",
                                        'validate' => 'url',
                                    ),

                                    array(
                                        'id'       => 'wish-footer3-social-gp',
                                        'type'     => 'text',
                                        'title'    => __('Google Plus Link', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "http://www.plus.google.com",
                                        'validate' => 'url',
                                    ),

                                    array(
                                        'id'       => 'wish-footer3-social-li',
                                        'type'     => 'text',
                                        'title'    => __('Linkedin Link', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "http://www.linkedin.com",
                                        'validate' => 'url',
                                    ),

                                    
                                ),
             );

            $this->sections[] = array(

                'icon'      => 'el-icon-inbox',
                'submenu'   => false,
                'title'     => __('Footer 4', 'wish'),
                'desc'      => __('<p class="description">Settings for the theme footer 4</p>', 'wish'),
                'subsection' => true,
                'fields'    => array(

                                    array(

                                        'id'       => 'wish-footer4-bgcolor',
                                        'type'     => 'color',
                                        'title'    => __('Background Color', 'wish'), 
                                        'subtitle' => __('Only works if there is no background image pattern', 'wish'),
                                        'default'  => '#000000',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'background-color',

                                    ),

                                    array(

                                        'id'       => 'wish-footer4-bgimage',
                                        'type'     => 'media',
                                        'url'      => true,
                                        'title'    => __('Background Image Pattern', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'subtitle' => __('Upload Any Image For Background', 'wish'),
                                        'default'  => array(
                                            'url'  => get_template_directory_uri() . '/images/footer-pattern/8.png'
                                        ),
                                    ),

                                    array(
                                            'id'        => 'wish-footer4-title-font',
                                            'type'      => 'typography',
                                            'title'     => __('Title Text Font', 'wish'),
                                            'text-align' => false,
                                            'subtitle'  => __('Font Styles', 'wish'),
                                            'default'   => array(
                                                'font-size'     => '14px',
                                                'font-family'   => 'Montserrat',
                                                'font-weight' => '400',
                                                'color'  => '#fff',
                                                'line-height' => '30px',
                                            ),
                                    ),

                                    array(
                                            'id'        => 'wish-footer4-text-font',
                                            'type'      => 'typography',
                                            'title'     => __('Regular Text Font', 'wish'),
                                            'text-align' => false,
                                            'subtitle'  => __('Font Styles', 'wish'),
                                            'default'   => array(
                                                'font-size'     => '14px',
                                                'font-family'   => 'Montserrat',
                                                'font-weight' => '400',
                                                'color'  => '#fff',
                                                'line-height' => '30px',
                                            ),
                                    ),



                                    array(
                                        'id'       => 'wish-footer4-bottom-text',
                                        'type'     => 'text',
                                        'title'    => __('Bottom Text', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "Copyright &copy; 2015 Wish Theme. All rights reserved.",
                                        'validate' => 'no_html',
                                    ),


                                    array(
                                                'id'       => 'wish-footer4-links',
                                                'type'     => 'link_color',
                                                'title'    => __('Links Colors', 'redux-framework-demo'),
                                                'default'  => array(
                                                    'regular'  => '#E04B2C', 
                                                    'hover'    => '#E04B2C', 
                                                    'active'   => '#E04B2C', 
                                                    'visited'  => '#E04B2C', 
                                                    ),
                                    ),



 
                                    
                                ),
             );





            $this->sections[] = array(

                'icon'      => 'el-icon-inbox',
                'submenu'   => false,
                'title'     => __('Footer 5', 'wish'),
                'desc'      => __('<p class="description">Settings for the theme footer 5</p>', 'wish'),
                'subsection' => true,
                'fields'    => array(
                                             array(
                                                'id'       => 'wish-footer5-bgcolor',
                                                'type'     => 'color',
                                                'title'    => __('Background Color', 'wish'), 
                                                'default'  => '#ffffff',
                                                'validate' => 'color',
                                                'transparent' => false,
                                                'mode'      => 'background-color',
                                            ),


                                           array(
                                                    'id'        => 'wish-footer5-font',
                                                    'type'      => 'typography',
                                                    'title'     => __('Text Font', 'wish'),
                                                    'text-align' => false,
                                                    'subtitle'  => __('Font Styles', 'wish'),
                                                    'default'   => array(
                                                        'font-size'     => '14px',
                                                        'font-family'   => 'Montserrat',
                                                        'font-weight' => '400',
                                                        'color'  => '#000',
                                                        'line-height' => '30px',
                                                    ),
                                            ),



                                    array(
                                        'id'       => 'wish-footer5-email',
                                        'type'     => 'text',
                                        'title'    => __('Email', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "asd@asdasd.com",
                                        'validate' => 'email',
                                    ),

                                    array(
                                        'id'       => 'wish-footer5-phone',
                                        'type'     => 'text',
                                        'title'    => __('Phone Number', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "+7(021)9-556-700",
                                        'validate' => 'no_html',
                                    ),

                                    array(
                                        'id'       => 'wish-footer5-right-text',
                                        'type'     => 'textarea',
                                        'title'    => __('Text On The Right', 'wish'),
                                        'desc'     => __('<code>& middot;</code> is dot in the middle, <code>& copy;</code> is the copyright icon (without space)', 'wish'),
                                        'default'  => "&copy; Wish Theme 2015  &middot; 62 Triq San Pawl, Rabat, Malta  &middot;  Tel: +7(021)9-556-700",
                                        'validate' => 'html',
                                    ),


                                    
                                ),
             );





            $this->sections[] = array(

                'icon'      => 'el-icon-inbox',
                'submenu'   => false,
                'title'     => __('Footer 6', 'wish'),
                'desc'      => __('<p class="description">Settings for the footer 6</p>', 'wish'),
                'subsection' => true,
                'fields'    => array(
 
                                    array(
                                        'id'       => 'wish-footer6-bgcolor',
                                        'type'     => 'color',
                                        'title'    => __('Background Color', 'wish'), 
                                        'default'  => '#111111',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'background-color',
                                    ),

                                    array(
                                        'id'       => 'wish-footer6-title',
                                        'type'     => 'text',
                                        'title'    => __('Title', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "CONTACT",
                                        'validate' => 'no_special_chars',
                                    ),

                                   array(
                                            'id'        => 'wish-footer6-title-font',
                                            'type'      => 'typography',
                                            'title'     => __('Title Font', 'wish'),
                                            'text-align' => false,
                                            'subtitle'  => __('Font Styles', 'wish'),
                                            'default'   => array(
                                                'font-size'     => '20px',
                                                'font-family'   => 'Montserrat',
                                                'font-weight' => '500',
                                                'color'  => '#fff',
                                                'line-height' => '30px',
                                            ),
                                    ),

                                    array( 
                                        'id'       => 'wish-raw-footer6-social',
                                        'type'     => 'raw',
                                        'title'    => __('', 'wish'),
                                        'subtitle' => __('', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'content'  => '<h3 class="redux-admin-subtitle">Social Section</h3>',
                                    ),

                                    array(

                                        'id'       => 'wish-footer6-icon-colors',
                                        'type'     => 'color',
                                        'title'    => __('Icon Colors', 'wish'), 
                                        'default'  => '#3E3E3E',
                                        'validate' => 'color',
                                        'transparent' => false,
                                        'mode'      => 'color',

                                    ),

                                    array(
                                        'id'       => 'wish-footer6-fb',
                                        'type'     => 'text',
                                        'title'    => __('Facebook Link', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "http://www.fb.com",
                                        'validate' => 'url',
                                    ),

                                    array(
                                        'id'       => 'wish-footer6-tw',
                                        'type'     => 'text',
                                        'title'    => __('Twitter Link', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "http://www.twitter.com",
                                        'validate' => 'url',
                                    ),

                                    array(
                                        'id'       => 'wish-footer6-gp',
                                        'type'     => 'text',
                                        'title'    => __('Google Plus Link', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "http://www.plus.google.com",
                                        'validate' => 'url',
                                    ),

                                    array(
                                        'id'       => 'wish-footer6-ins',
                                        'type'     => 'text',
                                        'title'    => __('Instagram Link', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "http://www.instagram.com",
                                        'validate' => 'url',
                                    ),


                                            array( 
                                                'id'       => 'wish-raw-footer6-contact',
                                                'type'     => 'raw',
                                                'title'    => __('', 'wish'),
                                                'subtitle' => __('', 'wish'),
                                                'desc'     => __('', 'wish'),
                                                'content'  => '<h3 class="redux-admin-subtitle">Contact Section</h3>',
                                            ),


                                   array(
                                            'id'        => 'wish-footer6-contact-title-font',
                                            'type'      => 'typography',
                                            'title'     => __('Contact Titles Font', 'wish'),
                                            'text-align' => false,
                                            'subtitle'  => __('Font Styles', 'wish'),
                                            'default'   => array(
                                                'font-size'     => '14px',
                                                'font-family'   => 'Montserrat',
                                                'font-weight' => '500',
                                                'color'  => '#3E3E3E',
                                                'line-height' => '30px',
                                            ),
                                    ),


                                   array(
                                            'id'        => 'wish-footer6-contact-text-font',
                                            'type'      => 'typography',
                                            'title'     => __('Contact Text Font', 'wish'),
                                            'text-align' => false,
                                            'subtitle'  => __('Font Styles', 'wish'),
                                            'default'   => array(
                                                'font-size'     => '14px',
                                                'font-family'   => 'Montserrat',
                                                'font-weight' => '400',
                                                'color'  => '#FFF',
                                                'line-height' => '30px',
                                            ),
                                    ),


                                    array(
                                        'id'       => 'wish-footer6-phone-title',
                                        'type'     => 'text',
                                        'title'    => __('Phone Title', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "CALL US",
                                        'validate' => 'no_html',
                                    ),

                                    array(
                                        'id'       => 'wish-footer6-phone',
                                        'type'     => 'text',
                                        'title'    => __('Phone #', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "+7(021)9-556-700",
                                        'validate' => 'no_html',
                                    ),


                                    array(
                                        'id'       => 'wish-footer6-address-title',
                                        'type'     => 'text',
                                        'title'    => __('Address Title', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "ADDRESS",
                                        'validate' => 'no_html',
                                    ),

                                    array(
                                        'id'       => 'wish-footer6-address',
                                        'type'     => 'text',
                                        'title'    => __('Address', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "245 Quigley Blvd, Ste K",
                                        'validate' => 'no_html',
                                    ),


                                    array(
                                        'id'       => 'wish-footer6-email-title',
                                        'type'     => 'text',
                                        'title'    => __('Email Title', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "EMAIL",
                                        'validate' => 'no_html',
                                    ),

                                    array(
                                        'id'       => 'wish-footer6-email',
                                        'type'     => 'text',
                                        'title'    => __('Email', 'wish'),
                                        'desc'     => __('', 'wish'),
                                        'default'  => "photography@wishtheme.co.uk",
                                        'validate' => 'email'
                                    ),




                                    
                                ),
             );



            

            $this->sections[] = array(

                'icon'      => ' el-icon-shopping-cart-sign',

                'submenu' => false,

                'title'     => __('Woocommerce', 'wish'),

                'desc'      => __('<p class="description">Styling and other settings for woocommerce pages</p>', 'wish'),

                'fields'    => array(

                        array(
                            'id'        => 'wish-woocommerce-single-layout',
                            'type'      => 'image_select',
                            'title'     => __('Single Product Page Layout', 'wish'),
                            'subtitle'  => __('Choose between the 3 layouts', 'wish'),
                            'options'   => array(
                                                    'none' => array('alt' => 'Full Width',       'img' => ReduxFramework::$_url . 'assets/img/1c.png'),
                                                    'left' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                                                    'right' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                                                    //'4' => array('alt' => '2 Column Left', 'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                                                ),
                                                'default'   => 'left'
                        ),



                        array(
                            'id'        => 'wish-woocommerce-archive-layout',
                            'type'      => 'image_select',
                            'title'     => __('Products Archive Page Layout', 'wish'),
                            'subtitle'  => __('Choose between the 3 layouts', 'wish'),
                            'options'   => array(
                                                    'none' => array('alt' => 'Full Width',       'img' => ReduxFramework::$_url . 'assets/img/1c.png'),
                                                    'left' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                                                    'right' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                                                    //'4' => array('alt' => '2 Column Left', 'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                                                ),
                                                'default'   => 'left'
                        ),




                        array(
                            'id'       => 'wish-woocommerce-catalog-mode',
                            'type'     => 'switch', 
                            'title'    => __('Enable Catalog Mode', 'wish'),
                            'subtitle' => __('Catalog Mode removes buying features.', 'wish'),
                            'default'  => false,
                        ),

                        array(
                            'id'       => 'wish-woocommerce-show-prices',
                            'type'     => 'switch', 
                            'title'    => __('Show/Hide Prices', 'wish'),
                            'subtitle' => __('Show Hide Prices on product Archive Pages', 'wish'),
                            'default'  => false,
                        ),


                        array(
                            'id'       => 'wish-woocommerce-hover-flip',
                            'type'     => 'switch', 
                            'title'    => __('Flip Product Image on Mouse Hover', 'wish'),
                            'subtitle' => __('Show second product image when mouse hover.', 'wish'),
                            'default'  => false,
                        ),

                        array(
                            'id'       => 'wish-woocommerce-category-hide',
                            'type'     => 'switch', 
                            'title'    => __('Hide Category Name', 'wish'),
                            'subtitle' => __('Hide Category Name', 'wish'),
                            'default'  => false,
                        ),

                        array(
                            'id'       => 'wish-woo-stars-color',
                            'type'     => 'color',
                            'title'    => __('Rating Stars Color', 'wish'), 
                            'subtitle' => __('Pick a color for rating stars.', 'wish'),
                            'default'  => '#ffb027',
                            'validate' => 'color',
                            'mode'      => 'color',
                            'transparent'   => false,
                        ),



                        array( 
                            'id'       => 'wish-woo-archive-heading',
                            'type'     => 'raw',
                            'title'    => __('', 'wish'),
                            'subtitle' => __('', 'wish'),
                            'desc'     => __('', 'wish'),
                            'content'  => '<h3 class="redux-admin-subtitle">Archives Page</h3>',
                        ),


                       array(
                                'id'        => 'wish-woo-archive-product-title',
                                'type'      => 'typography',
                                'title'     => __('Product Title', 'wish'),
                                'text-align' => false,
                                'subtitle'  => __('Font Styles', 'wish'),
                                'default'   => array(
                                    'font-size'     => '17px',
                                    'font-family'   => 'Montserrat',
                                    'font-weight' => '400',
                                    'color'  => '#DF4423',
                                    'line-height' => '24px',
                                ),
                        ),



                       array(
                                'id'        => 'wish-woo-archive-product-category',
                                'type'      => 'typography',
                                'title'     => __('Product Category', 'wish'),
                                'text-align' => false,
                                'subtitle'  => __('Font Styles', 'wish'),
                                'default'   => array(
                                    'font-size'     => '16px',
                                    'font-family'   => 'Montserrat',
                                    'font-weight' => '400',
                                    'color'  => '#000',
                                    'line-height' => '30px',
                                ),
                        ),


                       array(
                                'id'        => 'wish-woo-archive-product-price',
                                'type'      => 'typography',
                                'title'     => __('Product Price', 'wish'),
                                'text-align' => false,
                                'subtitle'  => __('Font Styles', 'wish'),
                                'default'   => array(
                                    'font-size'     => '18px',
                                    'font-family'   => 'Montserrat',
                                    'font-weight' => '700',
                                    'color'  => '#000',
                                    'line-height' => '18px',
                                ),
                        ),



                    array(

                        'id'       => 'wish-woo-archive-bgcolor',
                        'type'     => 'color',
                        'title'    => __('Archive Page Background Color', 'wish'), 
                        'subtitle' => __('Pick a background color for the Shop Pages.', 'wish'),
                        'default'  => '#ffffff',
                        'validate' => 'color',
                        'transparent' => true,
                        'mode'      => 'background-color',
                        'transparent'   => false,
                    ),


                        array( 
                            'id'       => 'wish-woo-archive-heading',
                            'type'     => 'raw',
                            'title'    => __('', 'wish'),
                            'subtitle' => __('', 'wish'),
                            'desc'     => __('', 'wish'),
                            'content'  => '<h3 class="redux-admin-subtitle">Single Product Page</h3>',
                        ),


                       array(
                                'id'        => 'wish-woo-single-product-title',
                                'type'      => 'typography',
                                'title'     => __('Single Product Title', 'wish'),
                                'text-align' => false,
                                'subtitle'  => __('Font Styles', 'wish'),
                                'default'   => array(
                                    'font-size'     => '30px',
                                    'font-family'   => 'Montserrat',
                                    'font-weight' => '400',
                                    'color'  => '#000',
                                    'line-height' => '39px',
                                ),
                        ),

                       array(
                                'id'        => 'wish-woo-single-product-price',
                                'type'      => 'typography',
                                'title'     => __('Single Product Price', 'wish'),
                                'text-align' => false,
                                'subtitle'  => __('Font Styles', 'wish'),
                                'default'   => array(
                                    'font-size'     => '17pxpx',
                                    'font-family'   => 'Montserrat',
                                    'font-weight' => '400',
                                    'color'  => '#DF4322',
                                    'line-height' => '28px',
                                ),
                        ),


                        array(
                            'id'       => 'wish-woocommerce-show-fb-share',
                            'type'     => 'switch', 
                            'title'    => __('Show/Hide Facebook Sharing Icon', 'wish'),
                            'default'  => false,
                        ),

                        array(
                            'id'       => 'wish-woocommerce-show-tw-share',
                            'type'     => 'switch', 
                            'title'    => __('Show/Hide Twitter Sharing Icon', 'wish'),
                            'default'  => false,
                        ),


                        array(
                            'id'       => 'wish-woocommerce-show-pin-share',
                            'type'     => 'switch', 
                            'title'    => __('Show/Hide Pinterest Sharing Icon', 'wish'),
                            'default'  => false,
                        ),

                        array(
                            'id'       => 'wish-woocommerce-show-gp-share',
                            'type'     => 'switch', 
                            'title'    => __('Show/Hide Google Plus Sharing Icon', 'wish'),
                            'default'  => false,
                        ),                       


                    array(

                        'id'       => 'wish-woo-single-product-bgcolor',
                        'type'     => 'color',
                        'title'    => __('Single Product Background Color', 'wish'), 
                        'subtitle' => __('Pick a background color for the Shop Pages.', 'wish'),
                        'default'  => '#ffffff',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'transparent'   => false,
                    ),

                    



                    // end of fields

                )

            );



            $theme_info  = '<div class="redux-framework-section-desc">';

            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'wish') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';

            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'wish') . $this->theme->get('Author') . '</p>';

            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'wish') . $this->theme->get('Version') . '</p>';

            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';

            $tabs = $this->theme->get('Tags');

            if (!empty($tabs)) {

                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'wish') . implode(', ', $tabs) . '</p>';

            }

            $theme_info .= '</div>';

            

            // You can append a new section at any time.

            $this->sections[] = array(

                'icon'      => 'el-icon-file-edit',

                'submenu' => false,

                'title'     => __('Blog Settings', 'wish'),

                'desc'      => __('<p class="description">Settings For Blog Pages</p>', 'wish'),

                'fields'    => array(

                        array(
                            'id'        => 'wish-blog-single-layout',
                            'type'      => 'image_select',
                            'title'     => __('Single Post Layout', 'wish'),
                            'subtitle'  => __('Choose between the 3 layouts', 'wish'),
                            'options'   => array(
                                                    '1' => array('alt' => '3 Column',       'img' => ReduxFramework::$_url . 'assets/img/3cm.png'),
                                                    '2' => array('alt' => '2 Column Left',  'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                                                    //'3' => array('alt' => '2 Column Right', 'img' => ReduxFramework::$_url . 'assets/img/2cr.png'),
                                                    //'4' => array('alt' => '2 Column Left', 'img' => ReduxFramework::$_url . 'assets/img/2cl.png'),
                                                ),
                                                'default'   => '1'
                        ),



                                          array(
                                                    'id'        => 'wish-blog-title-font',
                                                    'type'      => 'typography',
                                                    'title'     => __('Title Font', 'wish'),
                                                    'text-align' => false,
                                                    'subtitle'  => __('Font Styles', 'wish'),
                                                    'default'   => array(
                                                        'font-size'     => '40px',
                                                        'font-family'   => 'Montserrat',
                                                        'font-weight' => '700',
                                                        'color'  => '#000',
                                                        'line-height' => '44px',
                                                    ),
                                            ),



                                          array(
                                                    'id'        => 'wish-blog-text-font',
                                                    'type'      => 'typography',
                                                    'title'     => __('Text Font', 'wish'),
                                                    'text-align' => false,
                                                    'subtitle'  => __('Font Styles', 'wish'),
                                                    'default'   => array(
                                                        'font-size'     => '14px',
                                                        'font-family'   => 'Montserrat',
                                                        'font-weight' => '400',
                                                        'color'  => '#000',
                                                        'line-height' => '30px',
                                                    ),
                                            ),



                    array(
                        'id'       => 'wish-blog-page-bgcolor',
                        'type'     => 'color',
                        'title'    => __('Blog Pages Background Color', 'wish'), 
                        'subtitle' => __('Pick a background color for the Blog Pages.', 'wish'),
                        'default'  => '#ffffff',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'transparent'   => false,
                    ),


                    array(
                        'id'       => 'wish-blog-page-sticky-bgcolor',
                        'type'     => 'color',
                        'title'    => __('Sticky Post Background Color', 'wish'), 
                        'subtitle' => __('Pick a background color for the Sticky Post in blog page', 'wish'),
                        'default'  => '#FCF8E3',
                        'validate' => 'color',
                        'mode'      => 'background-color',
                        'transparent'   => false,
                    ),


                                            array( 
                                                'id'       => 'opt-raw',
                                                'type'     => 'raw',
                                                'title'    => __('', 'redux-framework-demo'),
                                                'subtitle' => __('', 'redux-framework-demo'),
                                                'desc'     => __('', 'redux-framework-demo'),
                                                'content'  => '<h3 class="redux-admin-subtitle">Banners Setting</h3>',
                                            ),



                    array(
                            'id'       => 'wish-search-banner',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __('Search Page Banner', 'wish'),
                            'subtitle' => __('Banner to show on the search page', 'wish'),
                            'default'  => array(
                                'url'  => get_template_directory_uri() . '/images/parallax/search_para.jpg'
                            ),
                        ),


                    array(
                            'id'       => 'wish-archive-banner',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __('Archives Page Banner', 'wish'),
                            'subtitle' => __('Banner to show on the archives page', 'wish'),
                            'default'  => array(
                                'url'  => get_template_directory_uri() . '/images/parallax/search_para.jpg'
                            ),
                        ),



                    array(
                            'id'       => 'wish-author-banner',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __('Author Page Banner', 'wish'),
                            'subtitle' => __('Banner to show on the author page', 'wish'),
                            'default'  => array(
                                'url'  => get_template_directory_uri() . '/images/parallax/search_para.jpg'
                            ),
                        ),



                      array(
                                'id'        => 'wish-blog-banner-title-font',
                                'type'      => 'typography',
                                'title'     => __('Banner Title Font', 'wish'),
                                'text-align' => false,
                                'subtitle'  => __('Blog Banner Title Font', 'wish'),
                                'default'   => array(
                                    'font-size'     => '90px',
                                    'font-family'   => 'Montserrat',
                                    'font-weight' => '700',
                                    'color'  => '#fff',
                                    'line-height' => '100px',
                                ),
                        ),



                      array(
                                'id'        => 'wish-blog-banner-text-font',
                                'type'      => 'typography',
                                'title'     => __('Banner Subtitle Font', 'wish'),
                                'text-align' => false,
                                'subtitle'  => __('Blog Banner Subtitle Font', 'wish'),
                                'default'   => array(
                                    'font-size'     => '18px',
                                    'font-family'   => 'Montserrat',
                                    'font-weight' => '400',
                                    'color'  => '#fff',
                                    'line-height' => '24px',
                                ),
                        ),





                )//end of fields

            );




            // You can append a new section at any time.

            $this->sections[] = array(
                'icon'      => 'el-icon-minus',
                'submenu' => false,
                'title'     => __('Top Bar', 'wish'),
                'desc'      => __('<p class="description">Bar Above The Main Menu</p>', 'wish'),
                'fields'    => array(
                                        array(
                                            'id'       => 'wish-topbar-show',
                                            'type'     => 'checkbox',
                                            'title'    => __('Show Top Bar', 'wish'), 
                                            'subtitle' => __('Show/Hide The Top Bar.', 'wish'),
                                            'default'  => '1'
                                        ),



                                        array(
                                            'id'       => 'wish-topbar-show-float',
                                            'type'     => 'checkbox',
                                            'title'    => __('Show Top Bar only above floating menus', 'wish'), 
                                            'subtitle' => __('Show The Top Bar only on floating menus.', 'wish'),
                                            'default'  => '1'
                                        ),


                                        array(
                                            'id'        => 'wish-topbar-text',
                                            'type'      => 'textarea',
                                            'title'     => __('Text Right (Contact Links)', 'wish'),
                                            'subtitle'  => __('Each line is a section, put fontawesome codes like this example: |fa-phone|', 'wish'),
                                            'default'   => '|fa-envelope|info@wish.co.uk
|fa-phone|+7(021)9-556-700'
                                        ),


                                        array(
                                            'id'        => 'wish-topbar-text-left',
                                            'type'      => 'textarea',
                                            'title'     => __('Text Left (Social Links)', 'wish'),
                                            'subtitle'  => __('Add Social Icon Links', 'wish'),
                                            'default'   => '<a href="#"><i class="fa fa-facebook"></i></a>
<a href="#"><i class="fa fa-twitter"></i></a>
<a href="#"><i class="fa fa-instagram"></i></a>'
                                        ),




                                        array(
                                            'id'          => 'wish-topbar-font',
                                            'type'        => 'typography', 
                                            'title'       => __('Top Bar Font (Transparent Menu)', 'wish'),
                                            'text-align'    => false,
                                            'units'       =>'px',
                                            'default'   => array(
                                                'font-size'     => '14px',
                                                'font-family'   => 'Montserrat',
                                                'font-weight' => '400',
                                                'color'  => '#fff',
                                                'line-height' => '30px',

                                            ),
                                        ),

                                        array(
                                            'id'          => 'wish-topbar-font-regular',
                                            'type'        => 'typography', 
                                            'title'       => __('Top Bar Font (Regular Menu)', 'wish'),
                                            'text-align'    => false,
                                            'units'       =>'px',
                                            'default'   => array(
                                                'font-size'     => '14px',
                                                'font-family'   => 'Montserrat',
                                                'font-weight' => '400',
                                                'color'  => '#000',
                                                'line-height' => '30px',
                                            ),
                                        ),


                )//end of fields

            );




            $this->sections[] = array(

                'icon'      => 'el-icon-magic',
                'submenu'   => false,
                'title'     => __('Troubleshooting', 'wish'),
                'desc'      => __('<p class="description">Troubleshooting</p>', 'wish'),
                'fields'    => array(
                                            array( 
                                                'id'       => 'wish-troubleshooting-info',
                                                'type'     => 'raw',
                                                'title'    => __('', 'wish'),
                                                'subtitle' => __('', 'wish'),
                                                'desc'     => __('', 'wish'),
                                                'content'  => '<ol><li>In case there are theme styling issues after the theme update, you can just hit <b>Save Changes</b> button above and reload the site in the front-end.</li></ol>',
                                            ),

                                            array(
                                                'id'       => 'wish-underconstruction-enable',
                                                'type'     => 'switch', 
                                                'title'    => __('Enable Under Construction Mode', 'wish'),
                                                'subtitle' => __('Enable to show underconstruction page to non logged-in users', 'wish'),
                                                'default'  => false,
                                            ),


                                            array(
                                                'id'       => 'wish-underconstruct-page',
                                                'type'     => 'select',
                                                'title'    => __('Under Construction Page', 'wish'), 
                                                'subtitle' => __('Page to show when the site is underconstruction', 'wish'),
                                                // Must provide key => value pairs for select options
                                                'data'  => "pages",
                                                    
                                            ),



                                            array(
                                                'id'          => 'wish-underconstruct-date',
                                                'type'        => 'date',
                                                'title'       => __('Count down to date', 'wish'), 
                                                'subtitle'    => __('Date when the site comes back live', 'wish'),
                                                'placeholder' => 'Click to enter a date'
                                            ),







                            ),                    
             );     





            $this->sections[] = array(

                'title'     => __('Import / Export', 'wish'),

                'submenu' => false,

                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'wish'),

                'icon'      => 'el-icon-refresh',

                'fields'    => array(

                    array(

                        'id'            => 'opt-import-export',

                        'type'          => 'import_export',

                        'title'         => 'Import Export',

                        'subtitle'      => 'Save and restore your Redux options',

                        'full_width'    => false,

                    ),

                ),

            );                     




//disbaled for now, waiting for wordpress importer to remove deprecated functions

// $this->sections[] = array(
//                 'id' => 'wbc_importer_section',
//                 'title'  => esc_html__( 'Demo Content', 'wish' ),
//                 'desc'   => esc_html__( 'Import your favorite demo content from here.', 'wish' ),
//                 'icon'   => 'el-icon-website',
//                 'fields' => array(
//                                 array(
//                                     'id'   => 'wbc_demo_importer',
//                                     'type' => 'wbc_importer'
//                                     )
//                             )
//                 );

                    

            $this->sections[] = array(

                'type' => 'divide',

            );



            $this->sections[] = array(

                'icon'      => 'el-icon-info-sign',

                'title'     => __('Theme Information', 'wish'),

                'submenu' => false,

                'desc'      => __('<p class="description">wish - Evolutionary WordPress Theme</p>', 'wish'),

                'fields'    => array(

                    array(

                        'id'        => 'opt-raw-info',

                        'type'      => 'raw',

                        'content'   => $item_info,

                    )

                ),

            );

        }



        public function setHelpTabs() {



            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.

            $this->args['help_tabs'][] = array(

                'id'        => 'redux-help-tab-1',

                'title'     => __('Theme Information 1', 'wish'),

                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'wish')

            );



            $this->args['help_tabs'][] = array(

                'id'        => 'redux-help-tab-2',

                'title'     => __('Theme Information 2', 'wish'),

                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'wish')

            );



            // Set the help sidebar

            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'wish');

        }



        /**



          All the possible arguments for Redux.

          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments



         * */

        public function setArguments() {



            $theme = wp_get_theme(); // For use with some settings. Not necessary.



            $this->args = array(

                'opt_name' => 'redux_wish',

                'disable_tracking' => true,

                'display_name' => 'Wish Theme Settings',

                'display_version' => false,

                'page_slug' => '_options',

                'page_title' => 'Wish Theme Options',

                'google_api_key' => 'AIzaSyCLRtfL2sZr51rerBnAnCcamuYPCPGS2jU',

                'update_notice' => true,

                'menu_icon' =>  'dashicons-editor-paste-word',

                'dev_mode'  => false,

                //'intro_text' => '<p>wish Theme Settings Panel</p>',

                'footer_text' => '<p>Wish Theme Settings Panel</p>',

                'admin_bar' => true,

                'menu_type' => 'menu',

                'menu_title' => 'Wish Theme',

                'allow_sub_menu' => true,

                'page_parent_post_type' => 'your_post_type',

                'customizer' => true,

                'default_mark' => '*',

                'hints' => 

                array(

                  'icon' => 'el-icon-question-sign',

                  'icon_position' => 'right',

                  'icon_size' => 'normal',

                  'tip_style' => 

                  array(

                    'color' => 'light',

                  ),

                  'tip_position' => 

                  array(

                    'my' => 'top left',

                    'at' => 'bottom right',

                  ),

                  'tip_effect' => 

                  array(

                    'show' => 

                    array(

                      'duration' => '500',

                      'event' => 'mouseover',

                    ),

                    'hide' => 

                    array(

                      'duration' => '500',

                      'event' => 'mouseleave unfocus',

                    ),

                  ),

                ),

                'output' => true,

                'output_tag' => true,

                'compiler' => true,

                'page_icon' => 'icon-themes',

                'page_permissions' => 'manage_options',

                'save_defaults' => true,

                'show_import_export' => true,

                'transient_time' => '3600',

                'network_sites' => true,

              );



            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.

            $this->args['share_icons'][] = array(

                'url'   => 'https://github.com/ReduxFramework/ReduxFramework',

                'title' => 'Visit us on GitHub',

                'icon'  => 'el-icon-github'

                //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.

            );

            $this->args['share_icons'][] = array(

                'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',

                'title' => 'Like us on Facebook',

                'icon'  => 'el-icon-facebook'

            );

            $this->args['share_icons'][] = array(

                'url'   => 'http://twitter.com/reduxframework',

                'title' => 'Follow us on Twitter',

                'icon'  => 'el-icon-twitter'

            );

            $this->args['share_icons'][] = array(

                'url'   => 'http://www.linkedin.com/company/redux-framework',

                'title' => 'Find us on LinkedIn',

                'icon'  => 'el-icon-linkedin'

            );



        }









    }





    

    global $reduxConfig;

    $reduxConfig = new Wish_Redux_Framework_config();

}



/**

  Custom function for the callback referenced above

 */

if (!function_exists('admin_folder_my_custom_field')):

    function admin_folder_my_custom_field($field, $value) {

        print_r($field);

        echo '<br/>';

        print_r($value);

    }

endif;



/**

  Custom function for the callback validation referenced above

 * */

if (!function_exists('admin_folder_validate_callback_function')):

    function admin_folder_validate_callback_function($field, $value, $existing_value) {

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

        if ($error == true) {

            $return['error'] = $field;

        }

        return $return;

    }

endif;