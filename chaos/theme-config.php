<?php

/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */

if (!class_exists('Road_Theme_Config')) {

    class Road_Theme_Config {

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
                'title' => __('Section via hook', 'redux-framework'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework'),
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

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework'), $this->theme->display('Name'));
            
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'roadthemes'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_attr_e('Current theme preview', 'roadthemes'); ?>" />
                <?php endif; ?>

                <h4><?php echo $this->theme->display('Name'); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'redux-framework') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'redux-framework'), $this->theme->parent()->display('Name'));
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
	
            // General
            $this->sections[] = array(
                'title'     => __('General', 'redux-framework'),
                'desc'      => __('General theme options', 'redux-framework'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(

                    array(
                        'id'        => 'logo_main',
                        'type'      => 'media',
                        'title'     => __('Logo', 'redux-framework'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => __('Upload logo here.', 'redux-framework'),
                    ),
					array(
                        'id'        => 'opt-favicon',
                        'type'      => 'media',
                        'title'     => __('Favicon', 'redux-framework'),
                        'compiler'  => 'true',
                        'mode'      => false,
                        'desc'      => __('Upload favicon here.', 'redux-framework'),
                    ),
					array(
                        'id'        => 'background_error',
                        'type'      => 'background',
                        'output'    => array('body.error404'),
                        'title'     => __('Background 404', 'redux-framework'),
                        'subtitle'  => __('Background for 404 error page', 'redux-framework'),
						'default'   => '#000000',
                    ),
                ),
            );
			
			// Background
            $this->sections[] = array(
                'title'     => __('Background', 'redux-framework'),
                'desc'      => __('Use this section to upload background images, select background color', 'redux-framework'),
                'icon'      => 'el-icon-picture',
                'fields'    => array(
					
					array(
                        'id'        => 'background_opt',
                        'type'      => 'background',
                        'output'    => array('body'),
                        'title'     => __('Body Background', 'redux-framework'),
                        'subtitle'  => __('Body background with image, color. Only work with box layout', 'redux-framework'),
						'default'   => '#ffffff',
                    ),
                ),
            );
			// Colors
            $this->sections[] = array(
                'title'     => __('Colors', 'redux-framework'),
                'desc'      => __('Color options', 'redux-framework'),
                'icon'      => 'el-icon-tint',
                'fields'    => array(
					array(
                        'id'        => 'primary_color',
                        'type'      => 'color',
                        'title'     => __('Primary Color', 'redux-framework'),
                        'subtitle'  => __('Pick a color for primary color (default: #ecb3bd).', 'redux-framework'),
						'transparent' => false,
                        'default'   => '#ecb3bd',
                        'validate'  => 'color',
                    ),
					array(
                        'id'        => 'secondary_color',
                        'type'      => 'color',
                        'title'     => __('Secondary Color', 'redux-framework'),
                        'subtitle'  => __('Pick a color for secondary color (default: #bae9e6).', 'redux-framework'),
						'transparent' => false,
                        'default'   => '#bae9e6',
                        'validate'  => 'color',
                    ),
					array(
                        'id'        => 'sale_color',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => __('Sale Label BG Color', 'redux-framework'),
                        'subtitle'  => __('Pick a color for bg sale label (default: #ecb3bd).', 'redux-framework'),
						'transparent' => false,
                        'default'   => '#ecb3bd',
                        'validate'  => 'color',
                    ),
					
					array(
                        'id'        => 'saletext_color',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => __('Sale Label Text Color', 'redux-framework'),
                        'subtitle'  => __('Pick a color for sale label text (default: #ffffff).', 'redux-framework'),
						'transparent' => false,
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
					
					array(
                        'id'        => 'rate_color',
                        'type'      => 'color',
                        //'output'    => array(),
                        'title'     => __('Rating Star Color', 'redux-framework'),
                        'subtitle'  => __('Pick a color for star of rating (default: #ecb3bd).', 'redux-framework'),
						'transparent' => false,
                        'default'   => '#ecb3bd',
                        'validate'  => 'color',
                    ),
                ),
            );
			
			//Header
			$this->sections[] = array(
                'title'     => __('Header', 'redux-framework'),
                'desc'      => __('Header options', 'redux-framework'),
                'icon'      => 'el-icon-tasks',
                'fields'    => array(

					array(
                        'id'        => 'header_layout',
                        'type'      => 'select',
                        'title'     => __('Header Layout', 'redux-framework'),
                        'customizer_only'   => false,

                        //Must provide key => value pairs for select options
                        'options'   => array(
                            'default' => 'Default',
							'second' => 'Second',
							'third' => 'Third',
                        ),
                        'default'   => 'default'
                    ),
					array(
                        'id'        => 'slider_alias',
                        'type'      => 'text',
                        'title'     => __('Slider Alias', 'redux-framework'),
						'subtitle'     => __('Enter the slider alias', 'redux-framework'),
                        'default'   => 'home-slider1'
                    ),
					array(
                        'id'        => 'top_shipping',
                        'type'      => 'text',
                        'title'     => __('Top Shipping', 'redux-framework'),
                        'default'   => 'Free ship'
                    ),
					array(
                        'id'        => 'phone_number',
                        'type'      => 'text',
                        'title'     => __('Phone number', 'redux-framework'),
                        'default'   => '123 456 789'
                    ),
					array(
                        'id'        => 'mobile_menu_label',
                        'type'      => 'text',
                        'title'     => __('Mobile menu label', 'redux-framework'),
						'subtitle'     => __('The label for mobile menu (example: Menu, Go to...', 'redux-framework'),
                        'default'   => 'Menu'
                    ),
                ),
            );
			
			//Footer
			$this->sections[] = array(
                'title'     => __('Footer', 'redux-framework'),
                'desc'      => __('Footer options', 'redux-framework'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					
					array(
                        'id'        => 'footer_layout',
                        'type'      => 'select',
                        'title'     => __('Footer Layout', 'redux-framework'),
                        'customizer_only'   => false,

                        //Must provide key => value pairs for select options
                        'options'   => array(
                            'default' => 'Default',
                            'second' => 'Second',
                        ),
                        'default'   => 'default'
                    ),
					array(
                        'id'        => 'twitter_user',
                        'type'      => 'text',
                        'title'     => __('Twitter user name', 'redux-framework'),
                        'default'   => 'roadthemes'
                    ),
					array(
                        'id'        => 'twitter_title',
                        'type'      => 'text',
                        'title'     => __('Twitter title', 'redux-framework'),
                        'default'   => 'Twitter title'
                    ),
                ),
            );
			
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => __( 'About Us', 'redux-framework' ),
				'subsection' => true,
				'fields'     => array(
					array(
                        'id'        => 'about_title',
                        'type'      => 'text',
                        'title'     => __('About title', 'redux-framework'),
                        'default'   => 'About title'
                    ),
					array(
						'id'               => 'about_us',
						'type'             => 'editor',
						'title'    => __('About Us', 'redux-framework'),
						'subtitle'         => __('HTML tags allowed: a, img, br, em, strong, p', 'redux-framework'),
						'default'          => '',
						'args'   => array(
							'teeny'            => true,
							'media_buttons'	=> true,
						)
					),
				)
			);
			
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => __( 'Social Icons', 'redux-framework' ),
				'subsection' => true,
				'fields'     => array(
					array(
                        'id'        => 'follow_title',
                        'type'      => 'text',
                        'title'     => __('Follow title', 'redux-framework'),
                        'default'   => 'Follow title'
                    ),
					array(
						'id'       => 'social_icons',
						'type'     => 'sortable',
						'title'    => __('Social Icons', 'redux-framework'),
						'subtitle' => __('Enter social links', 'redux-framework'),
						'desc'     => __('Drag/drop to re-arrange', 'redux-framework'),
						'mode'     => 'text',
						'options'  => array(
							'facebook'     => '',
							'twitter'     => '',
							'instagram'	=> '',
							'tumblr'     => '',
							'pinterest'     => '',
							'google-plus'     => '',
							'linkedin'     => '',
							'behance'     => '',
							'dribbble'     => '',
							'youtube'     => '',
							'vimeo'     => '',
							'rss'     => '',
						),
						'default' => array(
						    'facebook'     => 'https://www.facebook.com/',
							'twitter'     => 'https://twitter.com/',
							'tumblr'     => 'https://www.tumblr.com/',
							'pinterest'     => '',
							'google-plus'     => 'https://plus.google.com/',
							'linkedin'     => '',
							'behance'     => '',
							'dribbble'     => 'https://dribbble.com/',
							'youtube'     => '',
							'vimeo'     => '',
							'rss'     => '',
						),
					),
				)
			);
			
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => __( 'Contact Us', 'redux-framework' ),
				'subsection' => true,
				'fields'     => array(
					array(
                        'id'        => 'contact_title',
                        'type'      => 'text',
                        'title'     => __('Contact Us title', 'redux-framework'),
                        'default'   => 'Contact Us'
                    ),
					array(
						'id'=>'contact_us',
						'type' => 'editor',
						'title' => __('Contact Us', 'redux-framework'), 
						'subtitle'         => __('HTML tags allowed: a, img, br, em, strong, p, ul, li', 'redux-framework'),
						'default' => '',
						'args'   => array(
							'teeny'            => true,
							'textarea_rows'    => 10
						)
					),
				)
			);
			
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => __( 'Menus', 'redux-framework' ),
				'subsection' => true,
				'fields'     => array(
					array(
						'id'       => 'footer_menu1',
						'type'     => 'select',
						'data'     => 'menus',
						'title'    => __( 'Menu #1', 'redux-framework' ),
						'subtitle' => __( 'Select a menu', 'redux-framework' ),
					),
					array(
						'id'       => 'footer_menu2',
						'type'     => 'select',
						'data'     => 'menus',
						'title'    => __( 'Menu #2', 'redux-framework' ),
						'subtitle' => __( 'Select a menu', 'redux-framework' ),
					),
					array(
						'id'       => 'footer_menu3',
						'type'     => 'select',
						'data'     => 'menus',
						'title'    => __( 'Menu #3', 'redux-framework' ),
						'subtitle' => __( 'Select a menu', 'redux-framework' ),
					),
					array(
						'id'       => 'footer_menu4',
						'type'     => 'select',
						'data'     => 'menus',
						'title'    => __( 'Menu #4', 'redux-framework' ),
						'subtitle' => __( 'Select a menu', 'redux-framework' ),
					),
				)
			);
			
			//Newsletter
			$this->sections[] = array(
				'icon'       => 'el-icon-website',
				'title'      => __( 'Newsletter', 'redux-framework' ),
				'fields'     => array(
					array(
                        'id'        => 'newsletter_title',
                        'type'      => 'text',
                        'title'     => __('Newsletter title', 'redux-framework'),
                        'default'   => 'Newsletter'
                    ),
					array(
						'id'       => 'newsletter_form',
						'type'     => 'text',
						'title'    => __('Newsletter form ID', 'redux-framework'),
						'subtitle' => __('The form ID of MailPoet plugin.', 'redux-framework'),
						'validate' => 'numeric',
						'msg'      => 'Please enter a form ID',
						'default'  => '1'
					),
				)
			);
			
			//Fonts
			$this->sections[] = array(
                'title'     => __('Fonts', 'redux-framework'),
                'desc'      => __('Fonts options', 'redux-framework'),
                'icon'      => 'el-icon-font',
                'fields'    => array(

                    array(
                        'id'            => 'bodyfont',
                        'type'          => 'typography',
                        'title'         => __('Body font', 'redux-framework'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => true,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
						'text-align'   => false,
                        //'font-size'     => false,
                        //'line-height'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('body'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Main body font.', 'redux-framework'),
                        'default'       => array(
                            'color'         => '#898989',
                            'font-weight'    => '400',
                            'font-family'   => 'Open Sans',
                            'google'        => true,
                            'font-size'     => '13px',
                            'line-height'   => '25px'),
                    ),
					array(
                        'id'            => 'headingfont',
                        'type'          => 'typography',
                        'title'         => __('Heading font', 'redux-framework'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'line-height'   => false,
						'text-align'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Heading font.', 'redux-framework'),
                        'default'       => array(
                            'color'         => '#252525',
                            'font-weight'    => '500',
                            'font-family'   => 'Open Sans',
                            'google'        => true,
						),
                    ),
					array(
                        'id'            => 'menufont',
                        'type'          => 'typography',
                        'title'         => __('Menu font', 'redux-framework'),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        //'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => false, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'line-height'   => false,
						'text-align'   => false,
                        //'word-spacing'  => true,  // Defaults to false
                        //'letter-spacing'=> true,  // Defaults to false
                        //'color'         => false,
                        //'preview'       => false, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        //'output'        => array('h1, h2, h3, h4, h5, h6'), // An array of CSS selectors to apply this font style to dynamically
                        //'compiler'      => array('h2.site-description-compiler'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                        'subtitle'      => __('Menu font.', 'redux-framework'),
                        'default'       => array(
                            'color'         => '#252525',
                            'font-style'    => '400',
                            'font-family'   => 'Montserrat',
                            'google'        => true,
						),
                    ),
                ),
            );
			
			// Layout
            $this->sections[] = array(
                'title'     => __('Layout', 'redux-framework'),
                'desc'      => __('Select page layout: Box or Full Width', 'redux-framework'),
                'icon'      => 'el-icon-align-justify',
                'fields'    => array(
					array(
						'id'       => 'page_layout',
						'type'     => 'select',
						'multi'    => false,
						'title'    => __('Page Layout', 'redux-framework'),
						'options'  => array(
							'full' => 'Full Width',
							'box' => 'Box'
						),
						'default'  => 'full'
					),
					array(
                        'id'        => 'preset_option',
                        'type'      => 'select',
                        'title'     => __('Preset', 'redux-framework'),
						'subtitle'      => __('Select a preset to quickly apply pre-defined colors and fonts', 'redux-framework'),
                        'customizer_only'   => false,
                        'options'   => array(
							'1' => 'Use options',
                            '2' => 'Preset 2',
							'3' => 'Preset 3',
							'4' => 'Preset 4',
                        ),
                        'default'   => '1'
                    ),
					array(
                        'id'        => 'enable_sswitcher',
                        'type'      => 'switch',
                        'title'     => __('Show Style Switcher', 'redux-framework'),
						'subtitle'     => __('The style switcher is only for preview on front-end', 'redux-framework'),
						'default'   => false,
                    ),
                ),
            );
			
			// Sidebar
			$this->sections[] = array(
                'title'     => __('Sidebar', 'redux-framework'),
                'desc'      => __('Sidebar options', 'redux-framework'),
                'icon'      => 'el-icon-cog',
                'fields'    => array(
					array(
						'id'       => 'sidebar_pos',
						'type'     => 'radio',
						'title'    => __('Main Sidebar Position', 'redux-framework'),
						'subtitle'      => __('Sidebar on category page', 'redux-framework'),
						'options'  => array(
							'left' => 'Left',
							'right' => 'Right'),
						'default'  => 'left'
					),
					array(
						'id'       => 'sidebarse_pos',
						'type'     => 'radio',
						'title'    => __('Secondary Sidebar Position', 'redux-framework'),
						'subtitle'      => __('Sidebar on pages', 'redux-framework'),
						'options'  => array(
							'left' => 'Left',
							'right' => 'Right'),
						'default'  => 'left'
					),
					array(
						'id'       => 'sidebarblog_pos',
						'type'     => 'radio',
						'title'    => __('Blog Sidebar Position', 'redux-framework'),
						'subtitle'      => __('Sidebar on Blog pages', 'redux-framework'),
						'options'  => array(
							'left' => 'Left',
							'right' => 'Right'),
						'default'  => 'right'
					),
                ),
            );
			
			// Product
            $this->sections[] = array(
                'title'     => __('Product', 'redux-framework'),
                'desc'      => __('Use this section to select options for product', 'redux-framework'),
                'icon'      => 'el-icon-tags',
                'fields'    => array(
					array(
                        'id'        => 'shop_layout',
                        'type'      => 'select',
                        'title'     => __('Shop Layout', 'redux-framework'),
                        'customizer_only'   => false,
                        'options'   => array(
							'sidebar' => 'Sidebar',
                            'fullwidth' => 'Full Width',
                        ),
                        'default'   => 'sidebar'
                    ),
					array(
                        'id'        => 'default_view',
                        'type'      => 'select',
                        'title'     => __('Shop default view', 'redux-framework'),
                        'customizer_only'   => false,
                        'options'   => array(
							'grid-view' => 'Grid View',
                            'list-view' => 'List View',
                        ),
                        'default'   => 'grid-view'
                    ),
					array(
						'id'        => 'product_per_page',
						'type'      => 'slider',
						'title'     => __('Products per page', 'redux-framework'),
						'subtitle'      => __('Amount of products per page on category page', 'redux-framework'),
						"default"   => 12,
						"min"       => 3,
						"step"      => 1,
						"max"       => 48,
						'display_value' => 'text'
					),
					array(
						'id'        => 'product_per_row',
						'type'      => 'slider',
						'title'     => __('Product columns', 'redux-framework'),
						'subtitle'      => __('Amount of product columns on category page', 'redux-framework'),
						'desc'      => __('Only works with: 1, 2, 3, 4, 6', 'redux-framework'),
						"default"   => 3,
						"min"       => 1,
						"step"      => 1,
						"max"       => 6,
						'display_value' => 'text'
					),
					array(
						'id'        => 'product_per_row_fw',
						'type'      => 'slider',
						'title'     => __('Product columns on full width shop', 'redux-framework'),
						'subtitle'      => __('Amount of product columns on full width category page', 'redux-framework'),
						'desc'      => __('Only works with: 1, 2, 3, 4, 6', 'redux-framework'),
						"default"   => 4,
						"min"       => 1,
						"step"      => 1,
						"max"       => 6,
						'display_value' => 'text'
					),
					array(
						'id'       => 'second_image',
						'type'     => 'switch',
						'title'    => __('Use secondary product image', 'redux-framework'),
						'default'  => false,
					),
					array(
                        'id'        => 'related_title',
                        'type'      => 'text',
                        'title'     => __('Related products title', 'redux-framework'),
                        'default'   => 'Related Products'
                    ),
					array(
						'id'        => 'related_amount',
						'type'      => 'slider',
						'title'     => __('Number of related products', 'redux-framework'),
						"default"   => 6,
						"min"       => 4,
						"step"      => 1,
						"max"       => 16,
						'display_value' => 'text'
					),
					array(
                        'id'        => 'upsells_title',
                        'type'      => 'text',
                        'title'     => __('Up-Sells title', 'redux-framework'),
                        'default'   => 'Up-Sells'
                    ),
					array(
                        'id'        => 'crosssells_title',
                        'type'      => 'text',
                        'title'     => __('Cross-Sells title', 'redux-framework'),
                        'default'   => 'Cross-Sells'
                    ),
					array(
                        'id'        => 'detail_link_text',
                        'type'      => 'text',
                        'title'     => __('View details text', 'redux-framework'),
                        'default'   => 'View details'
                    ),
					array(
                        'id'        => 'quickview_link_text',
                        'type'      => 'text',
                        'title'     => __('View all features text', 'redux-framework'),
						'desc'      => __('This is the text on quick view box', 'redux-framework'),
                        'default'   => 'See all features'
                    ),
                ),
            );
			
			// Blog options
            $this->sections[] = array(
                'title'     => __('Blog', 'redux-framework'),
                'desc'      => __('Use this section to select options for blog', 'redux-framework'),
                'icon'      => 'el-icon-file',
                'fields'    => array(
					array(
                        'id'        => 'readmore_text',
                        'type'      => 'text',
                        'title'     => __('Read more text', 'redux-framework'),
                        'default'   => 'read more'
                    ),
					array(
						'id'        => 'excerpt_length',
						'type'      => 'slider',
						'title'     => __('Excerpt length on blog page', 'redux-framework'),
						"default"   => 22,
						"min"       => 10,
						"step"      => 2,
						"max"       => 120,
						'display_value' => 'text'
					),
					array(
						'id'       => 'blogscroll',
						'type'     => 'switch',
						'title'    => __('Latest posts auto scroll', 'redux-framework'),
						'default'  => false,
					),
					array(
						'id'        => 'blogpause',
						'type'      => 'slider',
						'title'     => __('Pause in (seconds)', 'redux-framework'),
						'desc'      => __('Pause time, default value: 3000', 'redux-framework'),
						"default"   => 3000,
						"min"       => 1000,
						"step"      => 500,
						"max"       => 10000,
						'display_value' => 'text'
					),
					array(
						'id'        => 'bloganimate',
						'type'      => 'slider',
						'title'     => __('Animate in (seconds)', 'redux-framework'),
						'desc'      => __('Animate time, default value: 2000', 'redux-framework'),
						"default"   => 2000,
						"min"       => 300,
						"step"      => 100,
						"max"       => 5000,
						'display_value' => 'text'
					),
                ),
            );
			
			// Testimonials options
            $this->sections[] = array(
                'title'     => __('Testimonials', 'redux-framework'),
                'desc'      => __('Use this section to select options for Testimonials', 'redux-framework'),
                'icon'      => 'el-icon-comment',
                'fields'    => array(
					array(
						'id'       => 'testiscroll',
						'type'     => 'switch',
						'title'    => __('Auto scroll', 'redux-framework'),
						'default'  => false,
					),
					array(
						'id'        => 'testipause',
						'type'      => 'slider',
						'title'     => __('Pause in (seconds)', 'redux-framework'),
						'desc'      => __('Pause time, default value: 3000', 'redux-framework'),
						"default"   => 3000,
						"min"       => 1000,
						"step"      => 500,
						"max"       => 10000,
						'display_value' => 'text'
					),
					array(
						'id'        => 'testianimate',
						'type'      => 'slider',
						'title'     => __('Animate in (seconds)', 'redux-framework'),
						'desc'      => __('Animate time, default value: 2000', 'redux-framework'),
						"default"   => 2000,
						"min"       => 300,
						"step"      => 100,
						"max"       => 5000,
						'display_value' => 'text'
					),
                ),
            );
			
			// Contact Map
            $this->sections[] = array(
                'title'     => __('Contact Map', 'redux-framework'),
                'desc'      => __('Use this section to select options for Google Map on contact page', 'redux-framework'),
                'icon'      => 'el-icon-map-marker',
                'fields'    => array(
					array(
                        'id'        => 'enable_map',
                        'type'      => 'switch',
                        'title'     => __('Show map', 'redux-framework'),
						'subtitle'     => __('Show map on contact page', 'redux-framework'),
						'default'   => true,
                    ),
					array(
						'id'       => 'address_by',
						'type'     => 'radio',
						'title'    => __('Locate by', 'redux-framework'),
						'subtitle'      => __('Locate marker by address or coordinate', 'redux-framework'),
						'options'  => array(
							'address' => 'Address',
							'coordinate' => 'Coordinate'
						),
						'default'  => 'address'
					),
					array(
						'id'               => 'map_desc',
						'type'             => 'editor',
						'title'    => __('Map description', 'redux-framework'),
						'subtitle' => __('The text on map popup', 'redux-framework'),
						'default'          => '',
						'args'   => array(
							'teeny'            => true,
							'textarea_rows'    => 5,
							'media_buttons'	=> false,
						)
					),
					array(
                        'id'        => 'map_lat',
                        'type'      => 'text',
                        'title'     => __('Latitude', 'redux-framework'),
                        'default'   => '51.50657'
                    ),
					array(
                        'id'        => 'map_long',
                        'type'      => 'text',
                        'title'     => __('Longtitude', 'redux-framework'),
                        'default'   => '-0.13408'
                    ),
					array(
                        'id'        => 'map_address',
                        'type'      => 'text',
                        'title'     => __('Address', 'redux-framework'),
                        'default'   => 'Pall Mall, London England'
                    ),
					array(
						'id'        => 'map_zoom',
						'type'      => 'slider',
						'title'     => __('Zoom level', 'redux-framework'),
						"default"   => 17,
						"min"       => 0,
						"step"      => 1,
						"max"       => 21,
						'display_value' => 'text'
					),
					array(
                        'id'        => 'map_marker',
                        'type'      => 'media',
                        'title'     => __('Marker', 'redux-framework'),
                        'compiler'  => 'true',
                        'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc'      => __('Upload marker image here, the image size is 32x47 pixels.', 'redux-framework'),
                    ),
                ),
            );
			
			// Custom CSS
            $this->sections[] = array(
                'title'     => __('Custom CSS', 'redux-framework'),
                'desc'      => __('Add your Custom CSS code', 'redux-framework'),
                'icon'      => 'el-icon-pencil',
                'fields'    => array(
					array(
						'id'       => 'custom_css',
						'type'     => 'ace_editor',
						'title'    => __('CSS Code', 'redux-framework'),
						'subtitle' => __('Paste your CSS code here.', 'redux-framework'),
						'mode'     => 'css',
						'theme'    => 'monokai', //chrome
						'default'  => ""
					),
                ),
            );
			
			// Less Compiler
            $this->sections[] = array(
                'title'     => __('Less Compiler', 'redux-framework'),
                'desc'      => __('Turn on this option to apply all theme options. Turn of when you have finished changing theme options and your site is ready.', 'redux-framework'),
                'icon'      => 'el-icon-wrench',
                'fields'    => array(
					array(
                        'id'        => 'enable_less',
                        'type'      => 'switch',
                        'title'     => __('Enable Less Compiler', 'redux-framework'),
						'default'   => true,
                    ),
                ),
            );
			
            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'redux-framework') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'redux-framework') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'redux-framework') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'redux-framework') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            $this->sections[] = array(
                'title'     => __('Import / Export', 'redux-framework'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework'),
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
                'title'     => __('Theme Information', 'redux-framework'),
                //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework'),
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
                'title'     => __('Theme Information 1', 'redux-framework'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'redux-framework'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'road_opt',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'redux-framework'),
                'page_title'        => __('Theme Options', 'redux-framework'),
                
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => '', // Must be defined to add google fonts to the typography module
                
                'async_typography'  => true,                    // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
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

            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                //$this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework'), $v);
            } else {
                //$this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework');
            }

            // Add content after the form.
            //$this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework');
        }

    }
    
    global $reduxConfig;
    $reduxConfig = new Road_Theme_Config();
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
