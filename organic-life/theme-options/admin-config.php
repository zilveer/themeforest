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
          It only runs if a field	set with compiler=>true is changed.

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
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }

            // ACTUAL DECLARATION OF SECTIONS


            /**********************************
            ********* Header Setting ***********
            ***********************************/
            $this->sections[] = array(
                'title'     => __('Header', 'Home Setting'),
                'icon'      => 'el-icon-bookmark',
                'icon_class' => 'el-icon-large',
                'fields'    => array(

                    array(
                        'id'        => 'header-fixed',
                        'type'      => 'switch',
                        'title'     => __('Sticky Header', 'themeum'),
                        'subtitle' => __('Enable or disable sicky Header', 'themeum'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'header-margin-top',
                        'type'      => 'text',
                        'title'     => __('Header Top Margin', 'themeum'),
                        'subtitle' => __('Enter custom header top marign', 'themeum'),
                        'default'   => '0',

                    ),  

                    array(
                        'id'        => 'header-margin-bottom',
                        'type'      => 'text',
                        'title'     => __('Header Bottom Margin', 'themeum'),
                        'subtitle' => __('Enter custom header bottom margin', 'themeum'),
                        'default'   => '30',

                    ),
                    array(
                        'id'        => 'hide-saerch',
                        'type'      => 'switch',
                        'title'     => __('Hide Search Icon', 'themeum'),
                        'subtitle'  => __('ON state will hide the Search Icon', 'themeum'),
                        'default'   => false,
                    ),                     

                    array(
                        'id'        => 'hide-cart',
                        'type'      => 'switch',
                        'title'     => __('Hide Cart Icon', 'themeum'),
                        'subtitle'  => __('ON state will hide the Cart Icon', 'themeum'),
                        'default'   => true,
                    ),                                                    

                )
            );



            /**********************************
            ********* Logo & Favicon ***********
            ***********************************/

            $this->sections[] = array(
                'title'     => __('Logo & favicon', 'themeum'),
                'icon'      => 'el-icon-leaf',
                'icon_class' => 'el-icon-large',
                'fields'    => array(

                    array( 
                        'id'        => 'favicon', 
                        'type'      => 'media',
                        'desc'      => 'upload favicon image',
                        'title'      => 'Favicon',
                        'subtitle' => __('Upload favicon image', 'themeum'),
                        'default' => array( 'url' => get_template_directory_uri() .'/images/favicon.ico' ), 
                    ),                 

                    array(
                        'id'=>'logo',
                        'url'=> false,
                        'type' => 'media', 
                        'title' => __('Logo', 'themeum'),
                        'default' => array( 'url' => get_template_directory_uri() .'/images/logo.png' ),
                        'subtitle' => __('Upload your custom site logo.', 'themeum'),
                    ),

                    array(
                        'id'        => 'logo-text-en',
                        'type'      => 'switch',
                        'title'     => __('Text Type Logo', 'themeum'),
                        'subtitle' => __('Enable or disable text type logo', 'themeum'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'logo-text',
                        'type'      => 'text',
                        'title'     => __('Logo Text', 'themeum'),
                        'subtitle' => __('Use your Custom logo text Ex. Prolog', 'themeum'),
                        'default'   => 'Organic',
                        'required'  => array('logo-text-en', "=", 1),

                    ),

                )
            );


            /**********************************
            ********* Layout & Styling ***********
            ***********************************/

            $this->sections[] = array(
                'icon' => 'el-icon-brush',
                'icon_class' => 'el-icon-large',
                'title'     => __('Layout & Styling', 'themeum'),
                'fields'    => array(

                   array(
                        'id'       => 'boxfull-en',
                        'type'     => 'select',
                        'title'    => __('Select Layout', 'themeum'), 
                        'subtitle' => __('Select BoxWidth of FullWidth', 'themeum'),
                        // Must provide key => value pairs for select options
                        'options'  => array(
                            'boxwidth' => 'BoxWidth',
                            'fullwidth' => 'FullWidth'
                        ),
                        'default'  => 'fullwidth',
                    ),  

                    array(
                        'id'        => 'box-background',
                        'type'      => 'background',
                        'output'    => array('.boxwidth-bg'),
                        'title'     => __('BoxWidth Body Background', 'themeum'),
                        'subtitle'  => __('You can set Background color or images or patterns for site body tag', 'themeum'),
                        'default'   => '#eeee',
                        'transparent'   =>false,
                    ),                            

                     array(
                        'id'        => 'link-color',
                        'type'      => 'color',
                        'title'     => __('Link Color', 'themeum'),
                        'subtitle'  => __('Pick a link color (default: #f9b840)', 'themeum'),
                        'default'   => '#62a83d',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),

                     array(
                        'id'        => 'hover-color',
                        'type'      => 'color',
                        'title'     => __('Hover Color', 'themeum'),
                        'subtitle'  => __('Pick a hover color (default: #4c832f)', 'themeum'),
                        'default'   => '#7BC256',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ), 

                    array(
                        'id'        => 'header-bg',
                        'type'      => 'color',
                        'title'     => __('Header Background Color', 'themeum'),
                        'subtitle'  => __('Pick a background color for the header (default: #62a83d).', 'themeum'),
                        'default'   => '#62a83d',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ), 

                    array(
                        'id'        => 'sticky-bg',
                        'type'      => 'color',
                        'title'     => __('Sticky Background Color', 'themeum'),
                        'subtitle'  => __('Pick a background color for the Sticky (default: #62a83d).', 'themeum'),
                        'default'   => '#62a83d',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),                     


                    array(
                        'id'        => 'body-bg',
                        'type'      => 'background',
                        'output'    => array('body'),
                        'title'     => __('Body Background', 'themeum'),
                        'subtitle'  => __('You can set Background color or images or patterns for site body tag', 'themeum'),
                        'default'   => '#ffffff',
                        'transparent'   =>false,
                    ),

                    array(
                        'id'        => 'footer-bg',
                        'type'      => 'color',
                        'title'     => __('Footer Background Color', 'themeum'),
                        'subtitle'  => __('Pick Color for Footer Background ( default: #62A83D )', 'themeum'),
                        'default'   => '#62A83D',
                        'validate'  => 'color',
                        'transparent'   =>false,
                    ),                                                              

                )
            );


            /**********************************
            ********* Typography ***********
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-font',
                'icon_class' => 'el-icon-large',                
                'title'     => __('Typography', 'themeum'),
                'fields'    => array(

                    array(
                        'id'            => 'body-font',
                        'type'          => 'typography',
                        'title'         => __('Body Font', 'themeum'),
                        'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        //'font-size'     => ture,
                        // 'text-align'    => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        =>array('body'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Select your website Body Font', 'themum'),
                        'default'       => array(
                            'color'         => '#1a1a1a',
                            'font-weight'    => '400',
                            'font-family'   => 'Raleway',
                            'google'        => true,
                            'font-size'     => '14px'),
                    ), 

                    array(
                        'id'            => 'headings-font',
                        'type'          => 'typography',
                        'title'         => __('Headings Font', 'themeum'),
                        'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => true,
                        // 'text-align'    => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => true,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        =>array('h1, h2, h3, h4, h5, h6'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Select your website Headings Font', 'themum'),
                        'default'       => array(
                            'color'         => '#1a1a1a',
                            'font-weight'    => '500',
                            'font-family'   => 'Raleway',
                            'google'        => true,
                            'font-size'     => ''),
                    ),  

                    array(
                        'id'            => 'menu-font',
                        'type'          => 'typography',
                        'title'         => __('Menu Font', 'themeum'),
                        'compiler'      => false,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => true, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        // 'text-align'    => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => false,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        =>array('#main-menu .nav>li>a, #main-menu ul.sub-menu li > a'),
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Select your website Menu Font', 'themum'),
                        'default'       => array(
                            'font-weight'    => '500',
                            'font-family'   => 'Raleway',
                            'google'        => true,),
                    ),  

                )
            );


            /**********************************
            ********* Blog  ***********
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-edit',
                'icon_class' => 'el-icon-large',                  
                'title'     => __('Blog', 'themeum'),
                'fields'    => array(

                    array(
                        'id'        => 'blog-comment',
                        'type'      => 'switch',
                        'title'     => __('Post Comment', 'themeum'),
                        'subtitle'  => __('Enable or disable post comment', 'themeum'),
                        'default'   => false,
                    ),                 

                    array(
                        'id'        => 'blog-author',
                        'type'      => 'switch',
                        'title'     => __('Blog Author', 'themeum'),
                        'subtitle'  => __('Enable Blog Author ex. Admin', 'themeum'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'blog-date',
                        'type'      => 'switch',
                        'title'     => __('Blog Date', 'themeum'),
                        'subtitle'  => __('Enable Blog Date ', 'themeum'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'blog-category',
                        'type'      => 'switch',
                        'title'     => __('Blog Category', 'themeum'),
                        'subtitle'  => __('Enable or disable blog category', 'themeum'),
                        'default'   => true,
                    ), 


                    array(
                        'id'        => 'blog-tag',
                        'type'      => 'switch',
                        'title'     => __('Blog Tag', 'themeum'),
                        'subtitle'  => __('Enable Blog Tag ', 'themeum'),
                        'default'   => false,
                    ),  

                    array(
                        'id'        => 'blog-edit-en',
                        'type'      => 'switch',
                        'title'     => __('Post Edit', 'themeum'),
                        'subtitle'  => __('Enable or disable post edit', 'themeum'),
                        'default'   => false,
                    ),                                        
                    
                    array(
                        'id'        => 'blog-single-comment-en',
                        'type'      => 'switch',
                        'title'     => __('Single Post Comment', 'themeum'),
                        'subtitle'  => __('Enable Single post comment ', 'themeum'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'post-nav-en',
                        'type'      => 'switch',
                        'title'     => __('Post navigation', 'themeum'),
                        'subtitle'  => __('Enable Post navigation ', 'themeum'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'blog-continue-en',
                        'type'      => 'switch',
                        'title'     => __('Blog Readmore', 'themeum'),
                        'subtitle'  => __('Enable Blog Readmore', 'themeum'),
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'blog-continue',
                        'type'      => 'text',
                        'title'     => __('Continue Reading', 'themeum'),
                        'subtitle' => __('Continue Reading', 'themeum'),
                        'default'   => __('Continue Reading', 'themeum'),
                        'required'  => array('blog-continue-en', "=", 1),
                    ),  

                )
            );

            $this->sections[] = array(
                'icon' => 'el-icon-brush',
                'icon_class' => 'el-icon-large',
                'title'     => __('Portfolio', 'themeum'),
                'fields'    => array(

                    array(
                        'id'        => 'disable-filter',
                        'type'      => 'switch',
                        'title'     => __('Disable Filter', 'themeum'),
                        'subtitle'  => __('ON state will disable the Filter area', 'themeum'),
                        'default'   => false,
                    ), 

                    array(
                        'id'        => 'disable-single',
                        'type'      => 'switch',
                        'title'     => __('Disable Portfolio Single View', 'themeum'),
                        'subtitle'  => __('ON state will disable the portfolio single view link on hover', 'themeum'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'disable-poup',
                        'type'      => 'switch',
                        'title'     => __('Disable Portfolio Image Pop-up', 'themeum'),
                        'subtitle'  => __('ON state will disable the portfolio image pop-up on hover', 'themeum'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'disable-load-more',
                        'type'      => 'switch',
                        'title'     => __('Disable Ajax Load More', 'themeum'),
                        'subtitle'  => __('ON state will disable the ajax load more on hover', 'themeum'),
                        'default'   => false,
                    ),
                )
            );

            /**********************************
            ********* Coming Soon  ***********
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-time',
                'icon_class' => 'el-icon-large',                  
                'title'     => __('Coming Soon', 'themeum'),
                'fields'    => array(

                    array( 
                        'id'        => 'comingsoon-logo', 
                        'type'      => 'media',
                        'desc'      => 'Upload Coming Soon Page Logo',
                        'title'     => esc_html__('Coming Soon Page Logo','themeum-core'),
                        'subtitle' => esc_html__('Upload Coming Soon Page Logo', 'themeum-core'),
                    ),

                    array(
                        'id'        => 'comingsoon-en',
                        'type'      => 'switch',
                        'title'     => __('Enable Coming Soon', 'themeum'),
                        'subtitle'  => __('Enable or disable coming soon mode', 'themeum'),
                        'default'   => false,
                    ),

                    array(
                        'id'        => 'comingsoon-date',
                        'type'      => 'date',
                        'title'     => __('Coming Soon date', 'themeum'),
                        'subtitle' => __('Coming Soon Date', 'themeum'),
                        'default'   => __('08/30/2015', 'themeum')
                        
                    ),

                    array(
                        'id'        => 'comingsoon-title',
                        'type'      => 'text',
                        'title'     => __('Title', 'themeum'),
                        'subtitle' => __('Coming Soon Title', 'themeum'),
                        'default'   => __('A Minty Surprize is Coming Your Way!', 'themeum')
                    ),

                    array(
                        'id'        => 'comingsoon-message-desc',
                        'type'      => 'text',
                        'title'     => __('Description', 'themeum'),
                        'subtitle' => __('Coming Soon Description', 'themeum'),
                        'default'   => __('We’re working hard and our estimated time before launch:', 'themeum')
                    ),

                    // social
                    array(
                        'id'        => 'wp-facebook',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Facebook URL', 'themeum-core'),
                    ),
                    array(
                        'id'        => 'wp-twitter',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Twitter URL', 'themeum-core'),
                    ),
                    array(
                        'id'        => 'wp-google-plus',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Google Plus URL', 'themeum-core'),
                    ),
                    array(
                        'id'        => 'wp-pinterest',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Pinterest URL', 'themeum-core'),
                    ),
                    array(
                        'id'        => 'wp-youtube',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Youtube URL', 'themeum-core'),
                    ),
                    array(
                        'id'        => 'wp-linkedin',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Linkedin URL', 'themeum-core'),
                    ),
                    array(
                        'id'        => 'wp-instagram',
                        'type'      => 'text',
                        'title'     => esc_html__('Add Instagram URL', 'themeum-core'),
                    ),

                )
            );


            /**********************************
            ********* Footer ***********
            ***********************************/

            $this->sections[] = array(
                'icon'      => 'el-icon-bookmark',
                'icon_class' => 'el-icon-large', 
                'title'     => __('Footer', 'themeum'),
                'fields'    => array(
                 

                    array(
                        'id'        => 'copyright-en',
                        'type'      => 'switch',
                        'title'     => __('Copyright', 'themeum'),
                        'subtitle'  => __('Enable Copyright Text', 'themeum'),
                        'default'   => true,
                    ),                    

                    array(
                        'id'        => 'copyright-text',
                        'type'      => 'editor',
                        'title'     => __('Copyright Text', 'themeum'),
                        'subtitle'  => __('Add Copyright Text', 'themeum'),
                        'default'   => __('<div class="pull-left">Copyright © 2014 Organic Life. All Right Reserved.</div>
<div class="pull-right">Designed by <a href="http://wwww.themeum.com/" target="_blank">Themeum</a></div>', 'themeum'),
                        'required'  => array('copyright-en', "=", 1),
                        
                    ),  

                    array(
                        'id'        => 'custom-css',
                        'type'      => 'textarea',
                        'title'     => __('Costom CSS', 'themeum'),
                        'subtitle'  => __('Write your own css here', 'themeum'),                                            
                    ),

                    array(
                        'id'        => 'google-analytics',
                        'type'      => 'textarea',
                        'title'     => __('Google Analytics Code', 'themeum'),
                        'subtitle'  => __('Paste Your Google Analytics Code Here. This code will added to the footer', 'themeum'),                                            
                    ),  
                )
            );


            /**********************************
            ********* Import / Export ***********
            ***********************************/

            $this->sections[] = array(
                'title'     => __('Import / Export', 'themum'),
                'desc'      => __('Import and Export your Theme Options settings from file, text or URL.', 'themum'),
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
                'opt_name'          => 'themeum_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'themeum'),
                'page_title'        => __('Theme Options', 'themeum'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'admin_bar'         => true,                    // Show the panel pages on the admin bar
                'global_variable'   => '',                      // Set a different name for your global variable other than the opt_name
                'dev_mode'          => false,                    // Show the time the page took to load, etc
                'customizer'        => true,                    // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

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
