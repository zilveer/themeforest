<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

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
            //add_action( 'redux/loaded', array( $this, 'remove_demo' ) );
            
            // Function to test the compiler hook and demo CSS output.
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 3);
            
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
        function compiler_action($options, $css, $changed_values) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r($changed_values); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
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
             */
        }

        /**

          Custom function for filtering the sections array. Good for child themes to override or add to the sections.
          Simply include this function in the child themes functions.php file.

          NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
          so you must use get_template_directory_uri() if you want to use any of the built in icons

         * */
        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => __('Section via hook', 'redux-framework-demo'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
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
            //$args['dev_mode'] = true;

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

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
            }
            ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                Redux_Functions::initWpFilesystem();
                
                global $wp_filesystem;

                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // API
            $this->sections[] = array(
                'title' => __('API', 'redux-framework-demo'),
                'desc'      => __('Welcome to the Ibuki Options Panel! Control and configure the general setup of your theme.', 'redux-framework-demo'),
                'fields' => array(
                    array(
                        'id' => 'google_map_api_key',
                        'type' => 'text',
                        'title' => __('Google Map API Key', 'redux-framework-demo'), 
                        'sub_desc' => __('<em>Required</em>. Get an API Key for activated the Google Maps Javascript API and any related services automatically.<br><br>
                                          NOTE: Read this for get an <a href="https://developers.google.com/maps/documentation/javascript/get-api-key#key" target="_blank">API Key</a>', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                )
            );

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title'     => __('General Options', 'redux-framework-demo'),
                'desc'      => __('Welcome to the Ibuki Options Panel! Control and configure the general setup of your theme.', 'redux-framework-demo'),
                'icon'      => 'font-icon-house',
                // 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
                'fields'    => array(
                    // Favicon
                    array(
                        'id'=>'favicon',
                        'type' => 'media', 
                        'title' => __('Favicon Upload', 'redux-framework-demo'),
                        'subtitle' => __('Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon.', 'redux-framework-demo'),
                        'desc'=> ''
                    ),

                    // Preloader
                    array(
                        'id' => 'enable-preloader',
                        'type' => 'switch',
                        'title' => __('Do you want Preloader?', 'redux-framework-demo'), 
                        'subtitle' => __('Enable/Disable preloader page for your site.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),

                    array(
                        'id' => 'preloader-selection',
                        'type' => 'button_set',
                        'required' => array('enable-preloader','=','1'),
                        'title' => __('Select Preloader Mode', 'redux-framework-demo'), 
                        'subtitle' => __('Here you can select the mode you prefer for preload.', 'redux-framework-demo'),
                        'desc' => 'If you select "Custom" inside on each page, posts or custom post type you can select if you enabled the preloader for this specified page with a metabox below the wordpress editor.',
                        'options' => array(
                                        '1' => 'All Page and Posts',
                                        '2' => 'Custom'
                                    ),
                        'default' => '2'
                    ),

                    array(
                        'id' => 'preloader-text',
                        'type' => 'text',
                        'required' => array('enable-preloader','=','1'),
                        'title' => __('Preloader Text', 'redux-framework-demo'), 
                        'subtitle' => __('Enter your preloader text if you need change the default value.', 'redux-framework-demo'),
                        'default' => 'Loading...'
                    ),

                    array(
                        'id' => 'preloader-design',
                        'type' => 'button_set',
                        'required' => array('enable-preloader','=','1'),
                        'title' => __('Preloader Design', 'redux-framework-demo'), 
                        'subtitle' => __('Here you can select your custom preloader.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                                        '1' => 'Default',
                                        '2' => 'Image'
                                    ),
                        'default' => '1'
                    ),

                    array(
                        'id'=>'preloader-media-image',
                        'type' => 'media', 
                        'required' => array('preloader-design','=','2'),
                        'title' => __('Preloader Custom Image', 'redux-framework-demo'),
                        'subtitle' => __('Upload a .png or .gif image that will be used in all applicable areas on your site as the loading image.', 'redux-framework-demo'),
                        'desc'=> ''
                    ),

                    array(
                        'id' => 'preloader-spinner-value',
                        'type' => 'button_set',
                        'required' => array('preloader-design','=','2'),
                        'title' => __('Preloader Spinner Options', 'redux-framework-demo'), 
                        'subtitle' => __('Here you can select your spinner mode.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                                        '1' => 'No Spinner/Percentage',
                                        '2' => 'Spinner Only',
                                        '3' => 'Spinner and Percentage'
                                    ),
                        'default' => '1'
                    ),

                    // Animation on Mobile Devices
                    array(
                        'id' => 'enable-animation-effects',
                        'type' => 'switch',
                        'title' => __('Do you want Animation Effects on mobile devices?', 'redux-framework-demo'), 
                        'subtitle' => __('Enable/Disable animation effects on mobile devices for items.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),

                    // Disable Right Click
                    array(
                        'id' => 'right-click-option',
                        'type' => 'switch',
                        'title' => __('Disable Right Click?', 'redux-framework-demo'), 
                        'subtitle' => __('Enable/Disable Right Click Feature.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),

                    // Back to Top
                    array(
                        'id' => 'enable-back-to-top',
                        'type' => 'switch',
                        'title' => __('Back to Top?', 'redux-framework-demo'), 
                        'subtitle' => __('Enable/Disable Back to Top Feature.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 1
                    ),

                    // Tracking Code
                    array(
                        'id'=>'tracking-code',
                        'type' => 'textarea',
                        'title' => __('Tracking Code', 'redux-framework-demo'), 
                        'subtitle' => __('Paste your Google Analytics (or other) tracking code here.<br/> It will be inserted before the closing head tag of your theme.', 'redux-framework-demo'),
                        'desc' => ''
                    ),

                )
            );

            // Custom CSS/JS Options
            $this->sections[] = array(
                'title' => __('Custom CSS/JS', 'redux-framework-demo'),
                'subsection' => true,
                'desc' => __('Welcome to the Ibuki Options Panel! Control and configure your custom css or js of your theme.', 'redux-framework-demo'),
                'icon' => 'font-icon-statistics',
                'fields' => array(
                    // Enable Custom CSS
                    array(
                        'id'=>'enable-custom-css',
                        'type' => 'switch', 
                        'title' => __('Custom CSS?', 'redux-framework-demo'),
                        'subtitle' => __('Do you want enable custom css?', 'redux-framework-demo'),
                        'desc'=> '',
                        'default' => 0
                    ),

                    // Custom CSS
                    array(
                        'id'        => 'custom-css',
                        'type'      => 'ace_editor',
                        'required' => array('enable-custom-css','=','1'),
                        'title'     => __('Custom CSS Code', 'redux-framework-demo'),
                        'subtitle' => __('If you have any custom CSS you would like added to the site, please enter it here.', 'redux-framework-demo'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                        'desc'      => ''
                    ),

                    // Enable Custom JS
                    array(
                        'id'=>'enable-custom-js',
                        'type' => 'switch', 
                        'title' => __('Custom JS?', 'redux-framework-demo'),
                        'subtitle' => __('Do you want enable custom js?', 'redux-framework-demo'),
                        'desc'=> '',
                        'default' => 0
                    ),

                    // Custom JS
                    array(
                        'id'        => 'custom-js',
                        'type'      => 'ace_editor',
                        'required' => array('enable-custom-js','=','1'),
                        'title'     => __('Custom JS Code', 'redux-framework-demo'),
                        'subtitle'  => __('If you have any custom CSS you would like added to the site, please enter it here.<br><br><em>Write only the javascript/jquery code</em>', 'redux-framework-demo'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                        'desc'      => ''
                    ),

                )
            );

            // Color Options
            $this->sections[] = array(
                'title' => __('Color Options', 'redux-framework-demo'),
                'desc' => __('Welcome to the Ibuki Options Panel! Control and configure the colors of your theme.', 'redux-framework-demo'),
                'icon' => 'font-icon-droplet',
                'fields' => array(
                    // Enable Custom Colors
                    array(
                        'id'=>'enable-custom-color',
                        'type' => 'switch', 
                        'title' => __('Custom Colors?', 'redux-framework-demo'),
                        'subtitle' => __('Do you want enable custom colors?', 'redux-framework-demo'),
                        'desc'=> '',
                        'default' => 0
                    ),

                    // Accent Color
                    array(
                        'id' => 'accent-color',
                        'type' => 'color',
                        'required' => array('enable-custom-color','=','1'),
                        'title' => __('Accent Color', 'redux-framework-demo'),
                        'subtitle' => __('Change this color to alter the accent color globally for your site.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => '#2ABB9B'
                    ),
                )
            );


            // Typography Options
            $this->sections[] = array(
                'title' => __('Typography Options', 'redux-framework-demo'),
                'desc' => __('Control and configure the typography of your theme.', 'redux-framework-demo'),
                'icon' => 'font-icon-pencil',
                'fields' => array(
                    array(
                        'id'=>'enable-custom-fonts',
                        'type' => 'switch', 
                        'title' => __('Use Custom Fonts?', 'redux-framework-demo'),
                        'subtitle' => __('Do you want enable custom fonts features?.', 'redux-framework-demo'),
                        'desc'=> '',
                        'default' => 0
                    ),

                    // Header Fonts
                    array(
                        'id'=>'enable-header-fonts',
                        'type' => 'switch',
                        'required' => array('enable-custom-fonts','=','1'), 
                        'title' => __('Use Header Custom Fonts?', 'redux-framework-demo'),
                        'subtitle' => __('Do you want enable custom fonts for header?.', 'redux-framework-demo'),
                        'desc'=> '',
                        'default' => 0
                    ),

                    // Logo
                    array(
                        'id' => 'logo-font',
                        'type' => 'typography',
                        'required' => array('enable-header-fonts','=','1'), 
                        'title' => __('Logo Font', 'redux-framework-demo'),
                        'subtitle' => __('Select the font for logo.<br/>
                                          <em>Font Family</em><br/>
                                          <em>Font Weight - Font Style</em><br/>
                                          <em>Subset</em><br/>
                                          <em>Font Size</em>', 'redux-framework-demo'),
                        'compiler' => false,
                        'google' => true,
                        'font-backup' => false,
                        'line-height'=> false,
                        'font-style' => true,
                        'font-weight' => true,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'subset' => true,
                        'color' => false,
                        'preview' => true,
                        'units' => 'px',
                        'all_styles' => true,
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => '26px',
                            'font-style' => 'normal',
                            'font-weight' => '700'
                        ),
                    ),

                    // Menu
                    array(
                        'id' => 'menu-font',
                        'type' => 'typography',
                        'required' => array('enable-header-fonts','=','1'), 
                        'title' => __('Header Menu Font', 'redux-framework-demo'),
                        'subtitle' => __('Select the font for header menu.<br/>
                                          <em>Font Family</em><br/>
                                          <em>Font Weight - Font Style</em><br/>
                                          <em>Subset</em><br/>
                                          <em>Font Size</em>', 'redux-framework-demo'),
                        'compiler' => false,
                        'google' => true,
                        'font-backup' => false,
                        'line-height'=> false,
                        'font-style' => true,
                        'font-size' => false,
                        'font-weight' => true,
                        'text-align' => false,
                        'subset' => true,
                        'color' => false,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'font-style' => 'normal',
                            'font-weight' => '700'
                        ),
                    ),

                    // Body
                    array(
                        'id'=>'enable-body-fonts',
                        'type' => 'switch',
                        'required' => array('enable-custom-fonts','=','1'), 
                        'title' => __('Use Body Custom Fonts?', 'redux-framework-demo'),
                        'subtitle' => __('Do you want enable custom fonts for body?', 'redux-framework-demo'),
                        'desc'=> '',
                        'default' => 0
                    ),

                    array(
                        'id' => 'body-font',
                        'type' => 'typography',
                        'required' => array('enable-body-fonts','=','1'),   
                        'title' => __('Body Font', 'redux-framework-demo'),
                        'subtitle' => __('Select the font for body.<br/>
                                          <em>Font Family</em><br/>
                                          <em>Font Weight - Font Style</em><br/>
                                          <em>Subset</em><br/>
                                          <em>Font Size</em><br/>
                                          <em>Line Height</em>', 'redux-framework-demo'),
                        'compiler' => false,
                        'google' => true,
                        'font-backup' => false,
                        'font-style' => true,
                        'font-weight' => true,
                        'text-align' => false,
                        'subset' => true,
                        'color' => false,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'font-family' => 'Lato',
                            'font-size' => '16px',
                            'font-style' => 'normal',
                            'font-weight' => '300',
                            'line-height' => '24'
                        ),
                    ),

                    // Headings Fonts
                    array(
                        'id'=>'enable-headings-fonts',
                        'type' => 'switch',
                        'required' => array('enable-custom-fonts','=','1'), 
                        'title' => __('Use Heading Custom Fonts?', 'redux-framework-demo'),
                        'subtitle' => __('Do you want enable custom fonts for heading and all other elements contains the default headeing font?', 'redux-framework-demo'),
                        'desc'=> '',
                        'default' => 0
                    ),

                    // Page Header and Caption
                    array(
                        'id' => 'pageheader-font',
                        'type' => 'typography',
                        'required' => array('enable-headings-fonts','=','1'),   
                        'title' => __('Page Header Font', 'redux-framework-demo'),
                        'subtitle' => __('Select the font for page header.<br/>
                                          <em>Font Family</em><br/>
                                          <em>Font Weight - Font Style</em><br/>
                                          <em>Subset</em><br/>
                                          <em>Font Size</em><br/>
                                          <em>Line Height</em>', 'redux-framework-demo'),
                        'compiler' => false,
                        'google' => true,
                        'font-backup' => false,
                        'font-style' => true,
                        'font-weight' => true,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'subset' => true,
                        'color' => false,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => '38px',
                            'font-style' => 'normal',
                            'font-weight' => '400',
                            'line-height' => '53'
                        ),
                    ),
                    array(
                        'id' => 'pagecaption-font',
                        'type' => 'typography',
                        'required' => array('enable-headings-fonts','=','1'),   
                        'title' => __('Page Header Caption Font', 'redux-framework-demo'),
                        'subtitle' => __('Select the font for page header caption.<br/>
                                          <em>Font Family</em><br/>
                                          <em>Font Weight - Font Style</em><br/>
                                          <em>Subset</em><br/>
                                          <em>Font Size</em><br/>
                                          <em>Line Height</em>', 'redux-framework-demo'),
                        'compiler' => false,
                        'google' => true,
                        'font-backup' => false,
                        'font-style' => true,
                        'font-weight' => true,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'subset' => true,
                        'color' => false,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => '12px',
                            'font-style' => 'normal',
                            'font-weight' => '400',
                            'line-height' => '16'
                        ),
                    ),

                    // Headings 
                    array(
                        'id' => 'heading1-font',
                        'type' => 'typography',
                        'required' => array('enable-headings-fonts','=','1'),   
                        'title' => __('Heading Font - H1', 'redux-framework-demo'),
                        'subtitle' => __('Select the font for H1.<br/>
                                          <em>Font Family</em><br/>
                                          <em>Font Weight - Font Style</em><br/>
                                          <em>Subset</em><br/>
                                          <em>Font Size</em><br/>
                                          <em>Line Height</em>', 'redux-framework-demo'),
                        'compiler' => false,
                        'google' => true,
                        'font-backup' => false,
                        'font-style' => true,
                        'font-weight' => true,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'subset' => true,
                        'color' => false,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => '32px',
                            'font-style' => 'normal',
                            'font-weight' => '700',
                            'line-height' => '48'
                        ),
                    ),
                    array(
                        'id' => 'heading2-font',
                        'type' => 'typography',
                        'required' => array('enable-headings-fonts','=','1'), 
                        'title' => __('Heading Font - H2', 'redux-framework-demo'),
                        'subtitle' => __('Select the font for H2.<br/>
                                          <em>Font Family</em><br/>
                                          <em>Font Weight - Font Style</em><br/>
                                          <em>Subset</em><br/>
                                          <em>Font Size</em><br/>
                                          <em>Line Height</em>', 'redux-framework-demo'),
                        'compiler' => false,
                        'google' => true,
                        'font-backup' => false,
                        'font-style' => true,
                        'font-weight' => true,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'subset' => true,
                        'color' => false,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => '28px',
                            'font-style' => 'normal',
                            'font-weight' => '700',
                            'line-height' => '42'
                        ),
                    ),
                    array(
                        'id' => 'heading3-font',
                        'type' => 'typography',
                        'required' => array('enable-headings-fonts','=','1'), 
                        'title' => __('Heading Font - H3', 'redux-framework-demo'),
                        'subtitle' => __('Select the font for H3.<br/>
                                          <em>Font Family</em><br/>
                                          <em>Font Weight - Font Style</em><br/>
                                          <em>Subset</em><br/>
                                          <em>Font Size</em><br/>
                                          <em>Line Height</em>', 'redux-framework-demo'),
                        'compiler' => false,
                        'google' => true,
                        'font-backup' => false,
                        'font-style' => true,
                        'font-weight' => true,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'subset' => true,
                        'color' => false,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => '24px',
                            'font-style' => 'normal',
                            'font-weight' => '700',
                            'line-height' => '36'
                        ),
                    ),
                    array(
                        'id' => 'heading4-font',
                        'type' => 'typography',
                        'required' => array('enable-headings-fonts','=','1'), 
                        'title' => __('Heading Font - H4', 'redux-framework-demo'),
                        'subtitle' => __('Select the font for H4.<br/>
                                          <em>Font Family</em><br/>
                                          <em>Font Weight - Font Style</em><br/>
                                          <em>Subset</em><br/>
                                          <em>Font Size</em><br/>
                                          <em>Line Height</em>', 'redux-framework-demo'),
                        'compiler' => false,
                        'google' => true,
                        'font-backup' => false,
                        'font-style' => true,
                        'font-weight' => true,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'subset' => true,
                        'color' => false,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => '20px',
                            'font-style' => 'normal',
                            'font-weight' => '700',
                            'line-height' => '30'
                        ),
                    ),
                    array(
                        'id' => 'heading5-font',
                        'type' => 'typography',
                        'required' => array('enable-headings-fonts','=','1'), 
                        'title' => __('Heading Font - H5', 'redux-framework-demo'),
                        'subtitle' => __('Select the font for H5.<br/>
                                          <em>Font Family</em><br/>
                                          <em>Font Weight - Font Style</em><br/>
                                          <em>Subset</em><br/>
                                          <em>Font Size</em><br/>
                                          <em>Line Height</em>', 'redux-framework-demo'),
                        'compiler' => false,
                        'google' => true,
                        'font-backup' => false,
                        'font-style' => true,
                        'font-weight' => true,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'subset' => true,
                        'color' => false,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => '18px',
                            'font-style' => 'normal',
                            'font-weight' => '700',
                            'line-height' => '27'
                        ),
                    ),
                    array(
                        'id' => 'heading6-font',
                        'type' => 'typography',
                        'required' => array('enable-headings-fonts','=','1'), 
                        'title' => __('Heading Font - H6', 'redux-framework-demo'),
                        'subtitle' => __('Select the font for H6.<br/>
                                          <em>Font Family</em><br/>
                                          <em>Font Weight - Font Style</em><br/>
                                          <em>Subset</em><br/>
                                          <em>Font Size</em><br/>
                                          <em>Line Height</em>', 'redux-framework-demo'),
                        'compiler' => false,
                        'google' => true,
                        'font-backup' => false,
                        'font-style' => true,
                        'font-weight' => true,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'subset' => true,
                        'color' => false,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'font-size' => '16px',
                            'font-style' => 'normal',
                            'font-weight' => '700',
                            'line-height' => '24'
                        ),
                    ),
                    
                    // All Other Elements
                    array(
                        'id' => 'heading-elements-font',
                        'type' => 'typography',
                        'required' => array('enable-headings-fonts','=','1'),   
                        'title' => __('Other Heading Elements Font', 'redux-framework-demo'),
                        'subtitle' => __('Select the font for page header caption.<br/>
                                          <em>Font Family</em><br/>
                                          <em>Subset</em><br/>', 'redux-framework-demo'),
                        'compiler' => false,
                        'google' => true,
                        'font-backup' => false,
                        'font-style' => true,
                        'font-size' => false,
                        'line-height' => false,
                        'font-weight' => true,
                        'text-align' => false,
                        'letter-spacing' => false,
                        'subset' => true,
                        'color' => false,
                        'preview' => true,
                        'all_styles' => true,
                        'units' => 'px',
                        'default' => array(
                            'font-family' => 'Montserrat',
                            'font-style' => 'normal'
                        ),
                    ),
                )
            );

            // Header Options
            $this->sections[] = array(
                'title' => __('Header Options', 'redux-framework-demo'),
                'desc' => __('Control and configure the general setup of your header.', 'redux-framework-demo'),
                'icon' => 'font-icon-list-2',
                'fields' => array(

                    // Header Type
                    array(
                        'id' => 'header-type',
                        'type' => 'select',
                        'title' => __('Header Type', 'redux-framework-demo'), 
                        'subtitle' => __('Please select your header format here.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            'header-left-button'    => 'Left with Button',
                            'header-left-opened'    => 'Left Open',
                            'header-right-button'   => 'Right with Button',
                            'header-right-opened'   => 'Right Open',
                            'header-normal'         => 'Normal',
                            'header-fixed'          => 'Fixed',
                            'header-sticky'         => 'Sticky'
                        ),
                        'default' => 'header-normal'
                    ),

                    // Container Header
                    array(
                        'id' => 'header-container',
                        'type' => 'image_select',
                        'required' => array('header-type', 'equals', array('header-normal', 'header-fixed', 'header-sticky')),          
                        'title' => __('Header Container Layout', 'redux-framework-demo'), 
                        'subtitle' => __('Select the layout for header normal, fixed or sticky.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            'container' => array('title' => 'Default', 'img' => ReduxFramework::$_url .'/assets/img/content_default.png'),
                            'container-fluid' => array('title' => 'Full Width', 'img' => ReduxFramework::$_url .'/assets/img/content_full.png')
                        ),
                        'default' => 'container'
                    ),

                    // Transparent Header
                    array(
                        'id' => 'use-transparent-header',
                        'type' => 'switch',
                        'required' => array('header-type','=','header-sticky'), 
                        'title' => __('Enable Transparent Header MetaBox?', 'redux-framework-demo'), 
                        'subtitle' => __('If you enabled the transparent header, you need enabled it for each page or post with a metabox below the wordpress editor', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),

                    // Logo Text or Logo Image
                    array(
                        'id' => 'use-logo',
                        'type' => 'switch',
                        'title' => __('Use Image for Logo?', 'redux-framework-demo'), 
                        'subtitle' => __('Upload a logo for your theme.<br/> Otherwise you will see the Plain Text Logo.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),
                    array(
                        'id' => 'logo',
                        'type' => 'media',
                        'required' => array('use-logo','=','1'),    
                        'title' => __('Logo PNG Upload', 'redux-framework-demo'), 
                        'subtitle' => __('Upload your logo.', 'redux-framework-demo'),
                        'desc' => ''  
                    ),
                    array(
                        'id' => 'retina-logo',
                        'type' => 'media',
                        'required' => array('use-logo','=','1'),
                        'title' => __('Retina PNG Logo Upload', 'redux-framework-demo'), 
                        'subtitle' => __('Upload your Retina Logo for Retina Devices. Double Size of Logo PNG.', 'redux-framework-demo'),
                        'desc' => ''  
                    ),

                    array(
                        'id' => 'logo-white',
                        'type' => 'media',
                        'required' => array('use-logo','=','1'),    
                        'title' => __('Logo White PNG Upload', 'redux-framework-demo'), 
                        'subtitle' => __('Upload your logo white only if you activate the the transparent header.', 'redux-framework-demo'),
                        'desc' => ''  
                    ),
                    array(
                        'id' => 'retina-logo-white',
                        'type' => 'media',
                        'required' => array('use-logo','=','1'),
                        'title' => __('Retina PNG Logo Upload', 'redux-framework-demo'), 
                        'subtitle' => __('Upload your Retina Logo White only if you activate the the transparent header for Retina Devices. Double Size of Logo PNG.', 'redux-framework-demo'),
                        'desc' => ''  
                    ),

                    // Copyright
                    array(
                        'id' => 'header-copyright-text',
                        'type' => 'textarea',
                        'required' => array('header-type', 'equals', array('header-left-button', 'header-left-opened', 'header-right-button', 'header-right-opened')), 
                        'title' => __('Copyright Section Text', 'redux-framework-demo'), 
                        'subtitle' => __('Please enter the copyright section text.<br/><br/><em>HTML is allowed.</em>', 'redux-framework-demo'),
                        'desc' => '',
                        'validate' => 'html'
                    ),

                    // Social Buttons
                    array(
                        'id' => 'use-social-button',
                        'type' => 'switch', 
                        'title' => __('Enable Social Profile Button?', 'redux-framework-demo'), 
                        'subtitle' => __('Activate this to enable social profile buttons on your header.<br/>You can set your social profile in <strong>Social Options Tabs</strong>.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),

                    // Search Buttons
                    array(
                        'id' => 'use-search-button',
                        'type' => 'switch',
                        'required' => array('header-type', 'equals', array('header-left-button', 'header-right-button', 'header-normal', 'header-fixed', 'header-sticky')), 
                        'title' => __('Enable Search Button?', 'redux-framework-demo'), 
                        'subtitle' => __('Activate this to enable search buttons on your header.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),
                )
            );

            // Footer Options
            $this->sections[] = array(
                'title' => __('Footer Options', 'redux-framework-demo'),
                'desc' => __('Control and configure of your footer area.', 'redux-framework-demo'),
                'icon' => 'font-icon-cone',
                'fields' => array(
                    array(
                        'id' => 'footer-widget-layout',
                        'type' => 'image_select',
                        'title' => __('Footer Widget Layout', 'redux-framework-demo'), 
                        'subtitle' => __('Select the layout for footer widget area.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            'default' => array('title' => 'Default', 'img' => ReduxFramework::$_url .'/assets/img/content_default.png'),
                            'full-width' => array('title' => 'Full Width', 'img' => ReduxFramework::$_url .'/assets/img/content_full.png')
                        ),
                        'default' => 'default'
                    ),

                    array(
                        'id' => 'footer-widget-columns',
                        'type' => 'image_select',
                        'title' => __('Footer Widget Area Columns', 'redux-framework-demo'), 
                        'subtitle' => __('Select the columns for footer widget area.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            '2' => array('title' => '2 Columns', 'img' => ReduxFramework::$_url .'/assets/img/2col.png'),
                            '3' => array('title' => '3 Columns', 'img' => ReduxFramework::$_url .'/assets/img/3col.png'),
                            '4' => array('title' => '4 Columns', 'img' => ReduxFramework::$_url .'/assets/img/4col.png')
                        ),
                        'default' => '3'
                    ),

                    // Copyright
                    array(
                        'id' => 'footer-copyright-text',
                        'type' => 'textarea',
                        'title' => __('Copyright Section Text', 'redux-framework-demo'), 
                        'subtitle' => __('Please enter the copyright section text.<br/><br/><em>HTML is allowed.</em>', 'redux-framework-demo'),
                        'desc' => '',
                        'validate' => 'html'
                    ),
                )
            );

            // Portfolio Options
            $this->sections[] = array(
                'title' => __('Portfolio Options', 'redux-framework-demo'),
                'desc' => __('Control and configure the general setup of your portfolio.', 'redux-framework-demo'),
                'icon' => 'font-icon-grid',
                'fields' => array( 
                    array(
                        'id' => 'back-to-portfolio',
                        'type' => 'switch',
                        'title' => __('Enable Back to Main Portfolio Page on navigation?', 'redux-framework-demo'), 
                        'subtitle' => __('Enable/Disable Back to Portfolio Button.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),
                    array(
                        'id' => 'back-to-portfolio-url',
                        'type' => 'text',
                        'required' => array('back-to-portfolio','=','1'),    
                        'title' => __('URL Portfolio Main Page', 'redux-framework-demo'), 
                        'subtitle' => __('Enter the full URL of your Main Portfolio Page (remember to include "http://").', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => ''  
                    ),
                    array(
                        'id' => 'enable-comment-portfolio-area',
                        'type' => 'switch',
                        'title' => __('Enable Comments Template on Single Portfolio Post?', 'redux-framework-demo'), 
                        'subtitle' => __('Enable/Disable Comments Template.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),
                    array(
                        'id' => 'portfolio_rewrite_slug', 
                        'type' => 'text', 
                        'title' => __('Custom Slug', 'redux-framework-demo'),
                        'subtitle' => __('If you want your portfolio post type to have a custom slug in the url, please enter it here. <br/><br/>
                                         <b>You will still have to refresh your permalinks after saving this!</b><br/><br/>
                                         This is done by going to <b>Settings -> Permalinks</b> and clicking save.', 'redux-framework-demo'),
                        'desc' => ''
                    )                          
                )
            );

            // Team Options
            $this->sections[] = array(
                'title' => __('Team Options', 'redux-framework-demo'),
                'desc' => __('Control and configure the general setup of your team.', 'redux-framework-demo'),
                'icon' => 'font-icon-group',
                'fields' => array(
                    array(
                        'id' => 'back-to-team',
                        'type' => 'switch',
                        'title' => __('Enable Back to Main Team Page on navigation?', 'redux-framework-demo'), 
                        'subtitle' => __('Enable/Disable Back to Team Button.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),
                    array(
                        'id' => 'back-to-team-url',
                        'type' => 'text',
                        'required' => array('back-to-team','=','1'),    
                        'title' => __('URL Team Main Page', 'redux-framework-demo'), 
                        'subtitle' => __('Enter the full URL of your Main Team Page (remember to include "http://").', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => ''  
                    ), 
                    array(
                        'id' => 'enable-comment-team-area',
                        'type' => 'switch',
                        'title' => __('Enable Comments Template on Single Team Post?', 'redux-framework-demo'), 
                        'subtitle' => __('Enable/Disable Comments Template.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),
                    array(
                        'id' => 'team_rewrite_slug', 
                        'type' => 'text', 
                        'title' => __('Custom Slug', 'redux-framework-demo'),
                        'subtitle' => __('If you want your team post type to have a custom slug in the url, please enter it here.<br/><br/>
                                         <b>You will still have to refresh your permalinks after saving this!</b><br/><br/>
                                         This is done by going to <b>Settings -> Permalinks</b> and clicking save.', 'redux-framework-demo'),
                        'desc' => ''
                    )                          
                )
            );

            // Shop Options
            $this->sections[] = array(
                'title' => __('Shop Options', 'redux-framework-demo'),
                'desc' => __('Control and configure the general setup of your team.', 'redux-framework-demo'),
                'icon' => 'font-icon-cart',
                'fields' => array(

                    // Cart Button
                    array(
                        'id' => 'enable-cart-button',
                        'type' => 'switch', 
                        'title' => __('Enable Cart Button?', 'redux-framework-demo'), 
                        'subtitle' => __('Activate this to enable cart button on header.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),  

                    // Shop Type
                    array(
                        'id' => 'shop_type',
                        'type' => 'select',
                        'title' => __('Shop Type', 'redux-framework-demo'), 
                        'subtitle' => __('Please select your shop format here.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            'fullwidth-shop' => 'FullWidth Shop',
                            'sidebar-shop' => 'Sidebar Shop'
                        ),
                        'default' => 'fullwidth-shop'
                    ),

                    // Shop Container
                    array(
                        'id' => 'shop_container',
                        'type' => 'image_select',        
                        'title' => __('Shop Container Layout', 'redux-framework-demo'), 
                        'subtitle' => __('Select the container for shop.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            'container' => array('title' => 'Default', 'img' => ReduxFramework::$_url .'/assets/img/content_default.png'),
                            'container-fluid' => array('title' => 'Full Width', 'img' => ReduxFramework::$_url .'/assets/img/content_full.png')
                        ),
                        'default' => 'container'
                    ),

                    // Shop Sidebar Layout
                    array(
                        'id' => 'shop_sidebar_layout',
                        'type' => 'image_select',
                        'required' => array('shop_type','=','sidebar-shop'),
                        'title' => __('Sidebar Shop Layout', 'redux-framework-demo'), 
                        'subtitle' => __('Select main content and sidebar alignment.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            'left_side' => array('title' => 'Left Sidebar', 'img' => ReduxFramework::$_url .'/assets/img/left_side.png'),
                            'right_side' => array('title' => 'Right Sidebar', 'img' => ReduxFramework::$_url .'/assets/img/right_side.png')
                        ),
                        'default' => 'right_side'
                    ),

                    // Shop Columns
                    array(
                        'id' => 'select-loop-columns',
                        'type' => 'image_select',
                        'title' => __('Number of Columns?', 'redux-framework-demo'), 
                        'subtitle' => __('Select Columns.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            '2' => array('title' => '2 Columns', 'img' => ReduxFramework::$_url .'/assets/img/2col.png'),
                            '3' => array('title' => '3 Columns', 'img' => ReduxFramework::$_url .'/assets/img/3col.png'),
                            '4' => array('title' => '4 Columns', 'img' => ReduxFramework::$_url .'/assets/img/4col.png')
                        ),
                        'default' => '3'
                    ),

                    // Single Product Container
                    array(
                        'id' => 'shop_single_product_container',
                        'type' => 'image_select',        
                        'title' => __('Single Product Container Layout', 'redux-framework-demo'), 
                        'subtitle' => __('Select the container for single product.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            'container' => array('title' => 'Default', 'img' => ReduxFramework::$_url .'/assets/img/content_default.png'),
                            'container-fluid' => array('title' => 'Full Width', 'img' => ReduxFramework::$_url .'/assets/img/content_full.png')
                        ),
                        'default' => 'container'
                    ),            
                )
            );

            // Blog Options
            $this->sections[] = array(
                'title' => __('Blog Options', 'redux-framework-demo'),
                'desc' => __('Control and configure the general setup of your blog.', 'redux-framework-demo'),
                'icon' => 'font-icon-align-left',
                'fields' => array(
                    array(
                        'id' => 'back-to-blog',
                        'type' => 'switch',
                        'title' => __('Enable Back to Main Blog Page on navigation?', 'redux-framework-demo'), 
                        'subtitle' => __('Enable/Disable Back to Blog Button.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),
                    array(
                        'id' => 'back-to-blog-url',
                        'type' => 'text',
                        'required' => array('back-to-blog','=','1'),    
                        'title' => __('URL Blog Main Page', 'redux-framework-demo'), 
                        'subtitle' => __('Enter the full URL of your Main Blog Page (remember to include "http://").', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => ''  
                    ), 
                    array(
                        'id' => 'enable-paginate-article',
                        'type' => 'switch',
                        'title' => __('Enable Paginate Single Posts?', 'redux-framework-demo'), 
                        'subtitle' => __('Enable paginate single posts.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),
                    array(
                        'id' => 'blog-social',
                        'type' => 'switch',
                        'title' => __('Social Media Sharing Buttons', 'redux-framework-demo'), 
                        'subtitle' => __('Activate this to enable social sharing buttons on your blog posts.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),  
                    array(
                        'id' => 'blog-facebook-sharing',
                        'type' => 'checkbox',
                        'required' => array('blog-social','=','1'),
                        'title' => __('Facebook', 'redux-framework-demo'), 
                        'subtitle' => 'Share it.',
                        'desc' => '',
                        'default' => '1'
                    ),
                    array(
                        'id' => 'blog-twitter-sharing',
                        'type' => 'checkbox',
                        'required' => array('blog-social','=','1'),
                        'title' => __('Twitter', 'redux-framework-demo'), 
                        'subtitle' => 'Tweet it.',
                        'desc' => '',
                        'default' => '1'
                    ),
                    array(
                        'id' => 'blog-google-sharing',
                        'type' => 'checkbox',
                        'required' => array('blog-social','=','1'),
                        'title' => __('Google Plus', 'redux-framework-demo'), 
                        'subtitle' => 'Google it.',
                        'desc' => '',
                        'default' => '1'
                    ),
                    array(
                        'id' => 'blog-pinterest-sharing',
                        'type' => 'checkbox',
                        'required' => array('blog-social','=','1'),
                        'title' => __('Pinterest', 'redux-framework-demo'), 
                        'subtitle' => 'Pin it.',
                        'desc' => '',
                        'default' => '1'
                    ),
                    
                    // Blog Type
                    array(
                        'id' => 'blog_type',
                        'type' => 'select',
                        'title' => __('Blog Type', 'redux-framework-demo'), 
                        'subtitle' => __('Please select your blog format here.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            'standard-blog' => 'Standard Blog',
                            'masonry-blog' => 'Masonry Blog',
                            'listed-blog' => 'Listed Blog',
                            'center-blog' => 'Center Blog'
                        ),
                        'default' => 'center-blog'
                    ),

                    // Blog Standard Sidebar Layout
                    array(
                        'id' => 'blog_standard_sidebar_layout',
                        'type' => 'image_select',
                        'required' => array('blog_type','=','standard-blog'),
                        'title' => __('Standard Blog Layout', 'redux-framework-demo'), 
                        'subtitle' => __('Select main content and sidebar alignment for blog.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            'no_side' => array('title' => 'No Sidebar', 'img' => ReduxFramework::$_url .'/assets/img/no_side.png'),
                            'left_side' => array('title' => 'Left Sidebar', 'img' => ReduxFramework::$_url .'/assets/img/left_side.png'),
                            'right_side' => array('title' => 'Right Sidebar', 'img' => ReduxFramework::$_url .'/assets/img/right_side.png')
                        ),
                        'default' => 'no_side'
                    ),

                    // Blog Masonry Container
                    array(
                        'id' => 'blog_masonry_container',
                        'type' => 'image_select',
                        'required' => array('blog_type','=','masonry-blog'),        
                        'title' => __('Blog Masonry Container Layout', 'redux-framework-demo'), 
                        'subtitle' => __('Select the container for masonry blog.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            'container' => array('title' => 'Default', 'img' => ReduxFramework::$_url .'/assets/img/content_default.png'),
                            'container-fluid' => array('title' => 'Full Width', 'img' => ReduxFramework::$_url .'/assets/img/content_full.png')
                        ),
                        'default' => 'container'
                    ),  

                    // Blog Masonry Columns
                    array(
                        'id' => 'blog_masonry_columns',
                        'type' => 'image_select',
                        'required' => array('blog_type','=','masonry-blog'),
                        'title' => __('Number of Columns?', 'redux-framework-demo'), 
                        'subtitle' => __('Select Columns.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            '2' => array('title' => '2 Columns', 'img' => ReduxFramework::$_url .'/assets/img/2col.png'),
                            '3' => array('title' => '3 Columns', 'img' => ReduxFramework::$_url .'/assets/img/3col.png'),
                            '4' => array('title' => '4 Columns', 'img' => ReduxFramework::$_url .'/assets/img/4col.png')
                        ),
                        'default' => '3'
                    ),

                    array(
                        'id' => 'blog_post_sidebar_layout',
                        'type' => 'image_select',
                        'title' => __('Single Post Blog Layout', 'redux-framework-demo'), 
                        'subtitle' => __('Select main content and sidebar alignment for single post.', 'redux-framework-demo'),
                        'desc' => '',
                        'options' => array(
                            'no_side' => array('title' => 'No Sidebar', 'img' => ReduxFramework::$_url .'/assets/img/no_side.png'),
                            'left_side' => array('title' => 'Left Sidebar', 'img' => ReduxFramework::$_url .'/assets/img/left_side.png'),
                            'right_side' => array('title' => 'Right Sidebar', 'img' => ReduxFramework::$_url .'/assets/img/right_side.png')
                        ),
                        'default' => 'no_side'
                    )
                )
            );

            // Misc Options
            $this->sections[] = array(
                'title' => __('Misc Options', 'redux-framework-demo'),
                'desc' => __('Control and configure the misc options available.', 'redux-framework-demo'),
                'icon' => 'font-icon-droplets',
                'fields' => array(
                    // 404
                    array(
                        'id'=>'error-custom-settings',
                        'type' => 'switch', 
                        'title' => __('Error Page Custom?', 'redux-framework-demo'),
                        'subtitle' => __('Do you want enable custom options for error page.', 'redux-framework-demo'),
                        'desc'=> '',
                        'default' => 0
                    ),

                    array(
                        'id' => 'error-custom-image',
                        'type' => 'media',
                        'required' => array('error-custom-settings','=','1'),    
                        'title' => __('Background Image Upload', 'redux-framework-demo'), 
                        'subtitle' => __('Upload your background image.', 'redux-framework-demo'),
                        'desc' => ''  
                    ),

                    // Search
                    array(
                        'id'=>'search-custom-settings',
                        'type' => 'switch', 
                        'title' => __('Search Page/Posts Custom?', 'redux-framework-demo'),
                        'subtitle' => __('Do you want enable custom options for search page.', 'redux-framework-demo'),
                        'desc'=> '',
                        'default' => 0
                    ),

                    array(
                        'id' => 'search-custom-image',
                        'type' => 'media',
                        'required' => array('search-custom-settings','=','1'),    
                        'title' => __('Background Image Upload', 'redux-framework-demo'), 
                        'subtitle' => __('Upload your background image.', 'redux-framework-demo'),
                        'desc' => ''  
                    ),

                    array(
                        'id' => 'search-full-area',
                        'type' => 'switch',
                        'required' => array('search-custom-settings','=','1'),  
                        'title' => __('Search Full Area?', 'redux-framework-demo'), 
                        'subtitle' => __('Activate this to enable search page header full area.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),  
                    array(
                        'id' => 'search-full-area-arrow',
                        'type' => 'checkbox',
                        'required' => array('search-full-area','=','1'),
                        'title' => __('Scroll to Section?', 'redux-framework-demo'), 
                        'subtitle' => 'Activate it.',
                        'desc' => '',
                        'default' => '0'
                    ),

                    // Search WooCommerce
                    array(
                        'id'=>'search-woocommerce-custom-settings',
                        'type' => 'switch', 
                        'title' => __('Search WooCommerce Products Custom?', 'redux-framework-demo'),
                        'subtitle' => __('Do you want enable custom options for search woocommerce products.', 'redux-framework-demo'),
                        'desc'=> '',
                        'default' => 0
                    ),

                    array(
                        'id' => 'search-woocommerce-custom-image',
                        'type' => 'media',
                        'required' => array('search-woocommerce-custom-settings','=','1'),    
                        'title' => __('Background Image Upload', 'redux-framework-demo'), 
                        'subtitle' => __('Upload your background image.', 'redux-framework-demo'),
                        'desc' => ''  
                    ),

                     array(
                        'id' => 'search-woocommerce-full-area',
                        'type' => 'switch',
                        'required' => array('search-woocommerce-custom-settings','=','1'),  
                        'title' => __('Search WooCommerce Full Area?', 'redux-framework-demo'), 
                        'subtitle' => __('Activate this to enable search page header full area.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),  
                    array(
                        'id' => 'search-woocommerce-full-area-arrow',
                        'type' => 'checkbox',
                        'required' => array('search-woocommerce-full-area','=','1'),
                        'title' => __('Scroll to Section?', 'redux-framework-demo'), 
                        'subtitle' => 'Activate it.',
                        'desc' => '',
                        'default' => '0'
                    ),

                    // Archive
                    array(
                        'id'=>'archive-custom-settings',
                        'type' => 'switch', 
                        'title' => __('Archive Page Custom?', 'redux-framework-demo'),
                        'subtitle' => __('Do you want enable custom options for archive page.', 'redux-framework-demo'),
                        'desc'=> '',
                        'default' => 0
                    ),

                    array(
                        'id' => 'archive-custom-image',
                        'type' => 'media',
                        'required' => array('archive-custom-settings','=','1'),    
                        'title' => __('Background Image Upload', 'redux-framework-demo'), 
                        'subtitle' => __('Upload your background image.', 'redux-framework-demo'),
                        'desc' => ''  
                    ),

                     array(
                        'id' => 'archive-full-area',
                        'type' => 'switch',
                        'required' => array('archive-custom-settings','=','1'),  
                        'title' => __('Archive Full Area?', 'redux-framework-demo'), 
                        'subtitle' => __('Activate this to enable archive page header full area.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),  
                    array(
                        'id' => 'archive-full-area-arrow',
                        'type' => 'checkbox',
                        'required' => array('archive-full-area','=','1'),
                        'title' => __('Scroll to Section?', 'redux-framework-demo'), 
                        'subtitle' => 'Activate it.',
                        'desc' => '',
                        'default' => '0'
                    ),

                )
            );

            // Social Options
            $this->sections[] = array(
                'title' => __('Social Options', 'redux-framework-demo'),
                'desc' => __('Control and configure the general setup of your social profile. <br/>Will be visible in the footer area (if enabled) and the social profile widget.', 'redux-framework-demo'),
                'icon' => 'font-icon-social-twitter',
                'fields' => array(
                    array(
                        'id' => '500px-url', 
                        'type' => 'text', 
                        'title' => __('500PX URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your 500PX URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'behance-url', 
                        'type' => 'text', 
                        'title' => __('Behance URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Behance URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'bebo-url', 
                        'type' => 'text', 
                        'title' => __('Bebo URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Bebo URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'blogger-url', 
                        'type' => 'text', 
                        'title' => __('Blogger URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Blogger URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'deviant-art-url', 
                        'type' => 'text', 
                        'title' => __('Deviant Art URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Deviant Art URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'digg-url', 
                        'type' => 'text', 
                        'title' => __('Digg URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Digg URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'dribbble-url', 
                        'type' => 'text', 
                        'title' => __('Dribbble URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Dribbble URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'email-url', 
                        'type' => 'text', 
                        'title' => __('Email URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Email URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'envato-url', 
                        'type' => 'text', 
                        'title' => __('Envato URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Envato URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'evernote-url', 
                        'type' => 'text', 
                        'title' => __('Evernote URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Envernote URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'facebook-url', 
                        'type' => 'text', 
                        'title' => __('Facebook URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Facebook URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'flickr-url', 
                        'type' => 'text', 
                        'title' => __('Flickr URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Flickr URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'forrst-url', 
                        'type' => 'text', 
                        'title' => __('Forrst URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Forrst URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'github-url', 
                        'type' => 'text', 
                        'title' => __('Github URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Github URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'google-plus-url', 
                        'type' => 'text', 
                        'title' => __('Google Plus URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Google Plus URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'grooveshark-url', 
                        'type' => 'text', 
                        'title' => __('Grooveshark URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Grooveshark URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'instagram-url', 
                        'type' => 'text', 
                        'title' => __('Instagram URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Instagram URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'last-fm-url', 
                        'type' => 'text', 
                        'title' => __('Last FM URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Last FM URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'linkedin-url', 
                        'type' => 'text', 
                        'title' => __('Linked In URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Linked In URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'paypal-url', 
                        'type' => 'text', 
                        'title' => __('Paypal URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Paypal URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'pinterest-url', 
                        'type' => 'text', 
                        'title' => __('Pinterest URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Pinterest URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'quora-url', 
                        'type' => 'text', 
                        'title' => __('Quora URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Quora URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'share-this-url', 
                        'type' => 'text', 
                        'title' => __('Share This URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Share This URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'skype-url', 
                        'type' => 'text', 
                        'title' => __('Skype URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Skype URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'soundcloud-url', 
                        'type' => 'text', 
                        'title' => __('Soundcloud URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Soundcloud URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'stumbleupon-url', 
                        'type' => 'text', 
                        'title' => __('Stumble Upon URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Stumble Upon URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'tumblr-url', 
                        'type' => 'text', 
                        'title' => __('Tumblr URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Tumblr URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'twitter-url', 
                        'type' => 'text', 
                        'title' => __('Twitter URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Twitter URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'viddler-url', 
                        'type' => 'text', 
                        'title' => __('Viddler URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Viddler URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'vimeo-url', 
                        'type' => 'text', 
                        'title' => __('Vimeo URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Vimeo URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'virb-url', 
                        'type' => 'text', 
                        'title' => __('Virb URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Virb URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'wordpress-url', 
                        'type' => 'text', 
                        'title' => __('Wordpress URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Wordpress URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'yahoo-url', 
                        'type' => 'text', 
                        'title' => __('Yahoo URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Yahoo URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'yelp-url', 
                        'type' => 'text', 
                        'title' => __('Yelp URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Yelp URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'youtube-url', 
                        'type' => 'text', 
                        'title' => __('You Tube URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your You Tube URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'xing-url', 
                        'type' => 'text', 
                        'title' => __('Xing URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Xing URL.', 'redux-framework-demo'),
                        'desc' => ''
                    ),
                    array(
                        'id' => 'zerply-url', 
                        'type' => 'text', 
                        'title' => __('Zerply URL', 'redux-framework-demo'),
                        'subtitle' => __('Please enter in your Zerply URL.', 'redux-framework-demo'),
                        'desc' => ''
                    )
                )
            );

            // Automatic Updates
            /*
            $this->sections[] = array(
                'title'     => __('Themes Updates', 'redux-framework-demo'),
                'desc'      => __('Here you can enabled the Automatic Update for Ibuki Theme.', 'redux-framework-demo'),
                'icon'      => 'font-icon-cycle',
                'fields'    => array(

                    array(
                        'id' => 'enable-auto-updates',
                        'type' => 'switch',
                        'title' => __('Enable Auto Updates', 'redux-framework-demo'), 
                        'subtitle' => __('Enable/Disable the automatic updates for your theme.', 'redux-framework-demo'),
                        'desc' => '',
                        'default' => 0
                    ),

                    array(
                        'id' => 'envato-license-key',
                        'type' => 'text',
                        'required' => array('enable-auto-updates','=','1'),
                        'title' => __('Item Purchase Code', 'redux-framework-demo'), 
                        'subtitle' => __('Enter your Envato license key here if you wish to receive auto updates for your theme.', 'redux-framework-demo'),
                        'default' => 'Insert here the License Key...'
                    ),
                )
            );
            */

            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'redux-framework-demo') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'redux-framework-demo') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'redux-framework-demo') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'redux-framework-demo') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon'      => 'el-icon-list-alt',
                    'title'     => __('Documentation', 'redux-framework-demo'),
                    'fields'    => array(
                        array(
                            'id'        => '17',
                            'type'      => 'raw',
                            'markdown'  => true,
                            'content'   => file_get_contents(dirname(__FILE__) . '/../README.md')
                        ),
                    ),
                );
            }
            
            $this->sections[] = array(
                'title'     => __('Import / Export', 'redux-framework-demo'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework-demo'),
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

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'redux-framework-demo'),
                'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework-demo'),
                'fields'    => array(
                    array(
                        'id'        => 'opt-raw-info',
                        'type'      => 'raw',
                        'content'   => $item_info,
                    )
                ),
            );

            if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
                $tabs['docs'] = array(
                    'icon'      => 'el-icon-book',
                    'title'     => __('Documentation', 'redux-framework-demo'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'redux-framework-demo'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'ibuki',                 // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  // Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Ibuki', 'redux-framework-demo'),
                'page_title'        => __('Ibuki', 'redux-framework-demo'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyAX_2L_UzCDPEnAHTG7zhESRVpMPS4ssII', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                     // Show the panel pages on the admin bar
                'global_variable'   => '',                       // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                     // Enable basic customizer support
                //'open_expanded'     => true,                   // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                   // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'     => null,                    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'       => 'themes.php',            // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'  => 'manage_options',        // Permissions needed to access the options panel.
                'menu_icon'         => '',                      // Specify a custom URL to an icon
                'last_tab'          => '',                      // Force your panel to always open to a specific tab (by id)
                'page_icon'         => 'icon-themes',           // Icon displayed in the admin panel next to your menu_title
                'page_slug'         => '_options',              // Page slug used to denote the panel
                'save_defaults'     => true,                    // On load save the defaults to DB before user clicks save or not
                'default_show'      => false,                   // If true, shows the default value next to each field that is not the default value.
                'default_mark'      => '',                      // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true,                   // Shows the Import/Export panel when not used as a field.
                
                // CAREFUL -> These options are for advanced use only
                'transient_time'    => 60 * MINUTE_IN_SECONDS,
                'output'            => true,                    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'        => true,                    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'              => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'           => false, // REMOVE

                // HINTS
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
            $this->args['share_icons']['twitter'] = array(
                'link' => 'http://twitter.com/bluxart',
                'title' => 'Follow me on Twitter', 
                'icon' => 'font-icon-social-twitter'
            );
            $this->args['share_icons']['dribbble'] = array(
                'link' => 'http://dribbble.com/Bluxart',
                'title' => 'Find me on Dribbble', 
                'icon' => 'font-icon-social-dribbble'
            );
            $this->args['share_icons']['forrst'] = array(
                'link' => 'http://forrst.com/people/Bluxart',
                'title' => 'Find me on Forrst', 
                'icon' => 'font-icon-social-forrst'
            );
            $this->args['share_icons']['behance'] = array(
                'link' => 'http://www.behance.net/alessioatzeni',
                'title' => 'Find me on Behance', 
                'icon' => 'font-icon-social-behance'
            );
            $this->args['share_icons']['facebook'] = array(
                'link' => 'https://www.facebook.com/atzenialessio',
                'title' => 'Follow me on Facebook', 
                'icon' => 'font-icon-social-facebook'
            );
            $this->args['share_icons']['google_plus'] = array(
                'link' => 'https://plus.google.com/105500420878314068694/posts',
                'title' => 'Find me on Google Plus', 
                'icon' => 'font-icon-social-google-plus'
            );
            $this->args['share_icons']['linked_in'] = array(
                'link' => 'http://www.linkedin.com/in/alessioatzeni',
                'title' => 'Find me on LinkedIn', 
                'icon' => 'font-icon-social-linkedin'
            );
            $this->args['share_icons']['envato'] = array(
                'link' => 'http://themeforest.net/user/Bluxart',
                'title' => 'Find me on Themeforest', 
                'icon' => 'font-icon-social-envato'
            );

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo'), $v);
            } else {
                $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
            }

            // Add content after the form.
            $this->args['footer_text'] = __('', 'redux-framework-demo');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Redux_Framework_sample_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('redux_my_custom_field')):
    function redux_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('redux_validate_callback_function')):
    function redux_validate_callback_function($field, $value, $existing_value) {
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
