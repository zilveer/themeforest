<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('newsstand_Redux_Framework_config')) {

    class newsstand_Redux_Framework_config {

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
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2);

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
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo '<h1>The compiler hook has run!';
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
                'title' => __('Section via hook', 'newsstand'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'newsstand'),
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

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'newsstand'), $this->theme->display('Name'));

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
                        <li><?php printf(__('By %s', 'newsstand'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'newsstand'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'newsstand') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'newsstand'), $this->theme->parent()->display('Name'));
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
            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title'     => __('Theme Customization', 'newsstand'),
                'desc'      => __('', 'newsstand'),
                'icon'      => 'el-icon-brush',
                'fields'    => array(
                	array(
                        'id'       => 'newsstand_custom_css',
                        'type'     => 'ace_editor',
                        'title'    => __( 'CSS Code', 'newsstand' ),
                        'subtitle' => __( 'Paste your CSS code here.', 'newsstand' ),
                        'mode'     => 'css',
                        'theme'    => 'monokai',
                        'desc'     => '',
                        'default'  => "#selector{\nmargin: 0 auto;\n}"
                    ),
                    array(
                        'id'        => 'newsstand_preloader_bg',
                        'type'      => 'color',
                        'title'     => __('Preloader Background Color', 'newsstand'),
                        'default'   => '#333',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'newsstand_preloader_spinner',
                        'type'      => 'color',
                        'title'     => __('Preloader Spinner Color', 'newsstand'),
                        'default'   => '#2dbda8',
                        'validate'  => 'color',
                    ),
                    array(
                        'id'       => 'newsstand-preloader-page',
                        'type'     => 'select',
                        'title'    => __( 'On what Pages should be Preloader?', 'iblog' ),
                        'subtitle' => __( '', 'iblog' ),
                        'options'  => array( '1' => 'Disabled', '2' => 'Only Home Page', '3' => 'All Pages' ),
                        'default'  => '1',
                    ),
                ),
            );

            $this->sections[] = array(
                'title'     => __('General Settings', 'newsstand'),
                'desc'      => __('', 'newsstand'),
                'icon'      => 'el-icon-cog-alt',
                'fields'    => array(
                	array(
                	    'id'        => 'newsstand_logo',
                	    'type'      => 'media',
                	    'title'     => __('Upload your Logo', 'newsstand'),
                	    'compiler'  => 'true',
                	    'mode'      => false,
                	),
                	array(
                	    'id'        => 'newsstand_header_style',
                	    'type'      => 'image_select',
                	    'presets'   => true,
                	    'title'     => __('Header Style', 'newsstand'),
                	    'default'   => 1,
                	    'options'   => array(
                	        '1'         => array('alt' => 'Style 1', 'img' => get_template_directory_uri() . '/img/redux/header_style_1.jpg'),
                	        '2'         => array('alt' => 'Style 2', 'img' => get_template_directory_uri() . '/img/redux/header_style_2.jpg'),
                	        '3'         => array('alt' => 'Style 3', 'img' => get_template_directory_uri() . '/img/redux/header_style_3.jpg'),
                	        '4'         => array('alt' => 'Style 4', 'img' => get_template_directory_uri() . '/img/redux/header_style_4.jpg'),
                	        '5'         => array('alt' => 'Style 5', 'img' => get_template_directory_uri() . '/img/redux/header_style_5.jpg'),
                	        '6'         => array('alt' => 'Style 6', 'img' => get_template_directory_uri() . '/img/redux/header_style_6.jpg'),
                	    ),
                	),
                	array(
                	    'id'        => 'newsstand_header_date_format',
                	    'type'      => 'select',
                	    'title'     => __('Header Date Format', 'newsstand'),
                	    'subtitle'  => __('How do you want to show Today\'s date?', 'newsstand'),
                	    'options'   => array('hide' => 'Hide Date', 'usa' => date('F jS Y'), 'eu' => date('jS F Y')),
                	    'default'   => 'eu',
                	),
                	array(
                	    'id'        => 'newsstand_header_weather',
                	    'type'      => 'select',
                	    'title'     => __('Show Weather in Header?', 'newsstand'),
                	    'subtitle'  => __('', 'newsstand'),
                	    'options'   => array('yes' => 'Yes', 'nope' => 'Nope'),
                	    'default'   => 'yes',
                	),
                	array(
                	    'id'        => 'newsstand-social',
                	    'type'      => 'slides',
                	    'title'     => __('Social Networks', 'newsstand'),
                	    'subtitle'  => __("For icon, go <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>here</a>, choose icon you like and then paste here name like this: <b>fa-university</b>.", 'newsstand'),
                	    'placeholder'   => array(
                	        'title'         => __('Social Network Name', 'newsstand'),
                	        'description'   => __('Icon Class', 'newsstand'),
                	        'url'           => __('URL', 'newsstand'),
                	    ),
                	),
                	array(
                	    'id'        => 'newsstand_fofbg',
                	    'type'      => 'media',
                	    'title'     => __('404 Background Image', 'newsstand'),
                	    'compiler'  => 'true',
                	    'mode'      => false,
                	),


                	array(
                	    'id'        => 'newsstand_footer_style',
                	    'type'      => 'image_select',
                	    'subtitle'	=> __('After you change style, come down again there will be additional fields to fill.','newsstand'),
                	    'presets'   => true,
                	    'title'     => __('Footer Style', 'newsstand'),
                	    'default'   => 1,
                	    'options'   => array(
                	        '1'         => array('alt' => 'Style 1', 'img' => get_template_directory_uri() . '/img/redux/footer_style_1.jpg'),
                	        '2'         => array('alt' => 'Style 2', 'img' => get_template_directory_uri() . '/img/redux/footer_style_2.jpg'),
                	        '3'         => array('alt' => 'Style 3', 'img' => get_template_directory_uri() . '/img/redux/footer_style_3.jpg'),
                	        '4'         => array('alt' => 'Style 4', 'img' => get_template_directory_uri() . '/img/redux/footer_style_4.jpg'),
                	        '5'         => array('alt' => 'Style 5', 'img' => get_template_directory_uri() . '/img/redux/footer_style_5.jpg'),
                	    ),
                	),

                	array(
                	    'id'        => 'newsstand_footer_logo',
                	    'type'      => 'media',
                	    'title'     => __('Upload your Logo for Footer', 'newsstand'),
                	    'compiler'  => 'true',
                	    'mode'      => false,
                	    'required'  => array('newsstand_footer_style', '!=', '4'),
                	),

                	array(
                	    'id'        => 'newsstand_footer_copyright',
                	    'type'      => 'text',
                	    'title'     => __('Copyright Text', 'newsstand'),
                	    'default' 	=> '<a href="http://avathemes.com" target="_blank">This Website Created by <b>AvaThemes</b></a>',
                	    'validate'  => 'html',
                	),

                	array(
                	    'id'        => 'newsstand_footer_bg',
                	    'subtitle'	=> __('If is transparent, it will use Footer Background color.','newsstand'),
                	    'type'      => 'color',
                	    'title'     => __('Footer Background', 'newsstand'),
                	    'default'   => '#222',
                	    'validate'  => 'color',
                	),

                	array(
                	    'id'        => 'newsstand_footer_nav_bg',
                	    'subtitle'	=> __('If is transparent, it will use Footer Background color.','newsstand'),
                	    'type'      => 'color',
                	    'title'     => __('Footer Navigation Part Background', 'newsstand'),
                	    'default'   => 'transparent',
                	    'validate'  => 'color',
                	    'required'  => array('newsstand_footer_style', '=', array(1,4)),
                	),

                	array(
                	    'id'        => 'newsstand_footer_copyright_bg',
                	    'subtitle'	=> __('If is transparent, it will use Footer Background color.','newsstand'),
                	    'type'      => 'color',
                	    'title'     => __('Footer Copyright Part Background', 'newsstand'),
                	    'default'   => 'transparent',
                	    'validate'  => 'color',
                	),

                	// Footer Boxes 1
                	array(
                	    'id'        => 'footer_boxes_1',
                	    'type'      => 'sortable',
                	    'label'		=> true,
                	    'title'     => __('Sort Footer Boxes', 'newsstand'),
                	    'subtitle'  => __('Type title of box if you don\'t want to use default title. Type <b>hidden</b> if you don\'t want that box', 'newsstand'),
                	    'required'  => array('newsstand_footer_style', '=', array(1,3)),
                	    'options'   => array(
                	        'About Text' 		=> 'A little bit about us',
                	        'Links 1' 			=> 'Links 1',
                	        'Links 2' 			=> 'Links 2',
                	        'Contact Info' 		=> 'Contact Info',
                	    )
                	),

                	// Footer Boxes 2
                	array(
                	    'id'        => 'footer_boxes_2',
                	    'type'      => 'sortable',
                	    'label'		=> true,
                	    'title'     => __('Sort Footer Boxes', 'newsstand'),
                	    'subtitle'  => __('Type title of box if you don\'t want to use default title. Type <b>hidden</b> if you don\'t want that box.', 'newsstand'),
                	    'required'  => array('newsstand_footer_style', '=', '2'),
                	    'options'   => array(
                	        'About Text' 			=> 'A little bit about us',
                	        'Links 1' 				=> 'Links 1',
                	        'Twtiter Feed' 			=> 'Twitter Feed',
                	        'Instagram Feed' 		=> 'Instagram Feed',
                	    )
                	),

                	// Footer Boxes 3
                	array(
                	    'id'        => 'footer_boxes_3',
                	    'type'      => 'sortable',
                	    'label'		=> true,
                	    'title'     => __('Sort Footer Boxes', 'newsstand'),
                	    'subtitle'  => __('Type title of box if you don\'t want to use default title. Type <b>hidden</b> if you don\'t want that box.', 'newsstand'),
                	    'required'  => array('newsstand_footer_style', '=', '5'),
                	    'options'   => array(
                	        'About Text' 			=> 'A little bit about us',
                	        'Twtiter Feed' 			=> 'Twitter Feed',
                	        'Newsletter' 			=> 'Newsletter',
                	    )
                	),

                	array(
                	    'id'        => 'footer_boxes_abouttext',
                	    'type'      => 'textarea',
                	    'title'     => __('About Text', 'newsstand'),
                	    'subtitle'	=> __('Type text about your site. You can use [logo] or [logofooter] if you want to insert logo in to text.','newsstand'),
                	    'required'  => array('newsstand_footer_style', '=', array(1,2,3,5)),
                	),

                	array(
                	    'id'        => 'footer_boxes_links1',
                	    'type'      => 'select',
                	    'data'		=> 'menu',
                	    'title'     => __('Links 1: Choose Menu', 'newsstand'),
                	    'required'  => array('newsstand_footer_style', '=', array(1,2,3)),
                	),

                	array(
                	    'id'        => 'footer_boxes_links2',
                	    'type'      => 'select',
                	    'data'		=> 'menu',
                	    'title'     => __('Links 2: Choose Menu', 'newsstand'),
                	    'required'  => array('newsstand_footer_style', '=', array(1,3)),
                	),

                	array(
                	    'id'        => 'footer_boxes_contact',
                	    'type'      => 'slides',
                	    'title'     => __('Contact Info:', 'newsstand'),
                	    'subtitle'  => __("For icon, go <a href='http://fortawesome.github.io/Font-Awesome/icons/' target='_blank'>here</a>, choose icon you like and then paste here name like this: <b>fa-university</b>.", 'newsstand'),
                	    'placeholder'   => array(
                	        'title'         => __('Icon Class', 'newsstand'),
                	        'description'   => __('Text', 'newsstand'),
                	        'url'           => __('URL (optional)', 'newsstand'),
                	    ),
                	    'required'  => array('newsstand_footer_style', '=', array(1,3)),
                	),

                    array(
                        'id'        => 'footer_instagram_id',
                        'type'      => 'text',
                        'title'     => __('Instagram Feed: User ID', 'newsstand'),
                        'subtitle'  => __('Get Instagram UserID <a href="http://jelled.com/instagram/lookup-user-id" target="_blank">here</a> and enter it here.', 'newsstand'),
                        'required'  => array('newsstand_footer_style', '=', '2'),
                    ),
                    array(
                        'id'        => 'footer_twitter_username',
                        'type'      => 'text',
                        'title'     => __('Twitter Feed: Twitter Username', 'newsstand'),
                        'required'  => array('newsstand_footer_style', '=', array(2,5)),
                    ),
                    array(
                        'id'        => 'footer_newsletter_shortcode',
                        'type'      => 'text',
                        'title'     => __('Newsletter Shortcode', 'newsstand'),
                        'subtitle'  => __('Enter Shortcode for Newsletter form (check out documentation if you need structure like on Demo Page).', 'newsstand'),
                        'required'  => array('newsstand_footer_style', '=', '5'),
                    ),

                    array(
                        'id'        => 'footer_newsletter_text',
                        'type'      => 'textarea',
                        'title'     => __('Newsletter Text', 'newsstand'),
                        'required'  => array('newsstand_footer_style', '=', '5'),
                    ),
                ),
            );

            $this->sections[] = array(
                'title'     => __('Instagram', 'newsstand'),
                'desc'      => __('', 'newsstand'),
                'icon'      => 'el-icon-instagram',
                'fields'    => array(
                    array(
                        'id'        => 'newsstand_instagram_userid',
                        'type'      => 'text',
                        'title'     => __('UserID', 'newsstand'),
                        'subtitle'  => __('You can get ID <a href="http://jelled.com/instagram/lookup-user-id" target="_blank">here</a>.', 'newsstand'),
                    ),
                ),
            );

            $this->sections[] = array(
                'title'     => __('Single Post', 'newsstand'),
                'desc'      => __('', 'newsstand'),
                'icon'      => 'el-icon-file',
                'fields'    => array(
                    array(
                        'id'        => 'newsstand_single_style',
                        'type'      => 'button_set',
                        'title'     => __('Choose how Single Post should look like.', 'redux-framework-demo'),
                        'options'   => array(
                            '1' => 'Style 1',
                            '2' => 'Style 2',
                        ),
                        'default'   => '1'
                    ),
                    array(
                        'id'        => 'newsstand_single_mostpopular',
                        'type'      => 'button_set',
                        'title'     => __('Show Most Popular Posts on top?', 'redux-framework-demo'),
                        'options'   => array(
                            'yes' => 'Yes',
                            'no' => 'No',
                        ),
                        'default'   => 'yes'
                    ),
                ),
            );

            $this->sections[] = array(
                'type' => 'divide',
            );

            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'newsstand') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'newsstand') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'newsstand') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'newsstand') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon'      => 'el-icon-list-alt',
                    'title'     => __('Documentation', 'newsstand'),
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
                'title'     => __('Import / Export', 'newsstand'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'newsstand'),
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
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'newsstand'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'newsstand')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'newsstand'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'newsstand')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'newsstand');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                'opt_name' => 'newsstand',
                'page_slug' => '_options',
                'page_title' => 'Theme Options',
                'update_notice' => true,
                'intro_text' => '',
                'footer_text' => '',
                'admin_bar' => true,
                'menu_type' => 'menu',
                'menu_title' => 'Theme Options',
                'allow_sub_menu' => true,
                'page_parent_post_type' => 'your_post_type',
                'page_priority' => '3',
                'customizer' => true,
                'default_mark' => '*',
                'hints' =>
                array(
                  'icon_position' => 'right',
                  'icon_color' => 'lightgray',
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

            $theme = wp_get_theme(); // For use with some settings. Not necessary.
            $this->args["display_name"] = $theme->get("Name");
            $this->args["display_version"] = $theme->get("Version");
        }

    }

    global $reduxConfig;
    $reduxConfig = new newsstand_Redux_Framework_config();
}

/**
  Custom function for the callback referenced above
 */
if (!function_exists('newsstand_my_custom_field')):
    function newsstand_my_custom_field($field, $value) {
        print_r($field);
        echo '<br/>';
        print_r($value);
    }
endif;

/**
  Custom function for the callback validation referenced above
 * */
if (!function_exists('newsstand_validate_callback_function')):
    function newsstand_validate_callback_function($field, $value, $existing_value) {
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
