<?php
/**
 * Berger Theme Config File
 */

if ( ! class_exists( 'Clapat_Bg_options_config' ) ) {

    class Clapat_Bg_options_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if ( ! class_exists( 'ReduxFramework' ) ) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme( __FILE__ ) ) {
                $this->initSettings();
            } else {
                add_action( 'plugins_loaded', array( $this, 'initSettings' ), 10 );
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

            if ( ! isset( $this->args['opt_name'] ) ) { // No errors please
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

            $this->ReduxFramework = new ReduxFramework( $this->sections, $this->args );
        }

        /**
         * This is a test function that will let you see when the compiler hook occurs.
         * It only runs if a field    set with compiler=>true is changed.
         * */
        function compiler_action( $options, $css, $changed_values ) {
            echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
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
         * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
         * Simply include this function in the child themes functions.php file.
         * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
         * so you must use get_template_directory_uri() if you want to use any of the built in icons
         * */
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => __( 'Section via hook', 'redux-framework-demo' ),
                'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo' ),
                'icon'   => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        /**
         * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
         * */
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }

        /**
         * Filter hook for filtering the default value of any given field. Very useful in development mode.
         * */
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }

        public function setSections() {

            /**
             * Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
             * */
            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns      = array();

            if ( is_dir( $sample_patterns_path ) ) :

                if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) :
                    $sample_patterns = array();

                    while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                        if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                            $name              = explode( '.', $sample_patterns_file );
                            $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                            $sample_patterns[] = array(
                                'alt' => $name,
                                'img' => $sample_patterns_url . $sample_patterns_file
                            );
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct          = wp_get_theme();
            $this->theme = $ct;
            $item_name   = $this->theme->get( 'Name' );
            $tags        = $this->theme->Tags;
            $screenshot  = $this->theme->get_screenshot();
            $class       = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'redux-framework-demo' ), $this->theme->display( 'Name' ) );

            ?>
            <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                <?php if ( $screenshot ) : ?>
                    <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                           title="<?php echo esc_attr( $customize_title ); ?>">
                            <img src="<?php echo esc_url( $screenshot ); ?>"
                                 alt="<?php esc_attr_e( 'Current theme preview', 'redux-framework-demo' ); ?>"/>
                        </a>
                    <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                         alt="<?php esc_attr_e( 'Current theme preview', 'redux-framework-demo' ); ?>"/>
                <?php endif; ?>

                <h4><?php echo $this->theme->display( 'Name' ); ?></h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf( __( 'By %s', 'redux-framework-demo' ), $this->theme->display( 'Author' ) ); ?></li>
                        <li><?php printf( __( 'Version %s', 'redux-framework-demo' ), $this->theme->display( 'Version' ) ); ?></li>
                        <li><?php echo '<strong>' . __( 'Tags', 'redux-framework-demo' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display( 'Description' ); ?></p>
                    <?php
                    if ( $this->theme->parent() ) {
                        printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'redux-framework-demo' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'redux-framework-demo' ), $this->theme->parent()->display( 'Name' ) );
                    }
                    ?>

                </div>
            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
                Redux_Functions::initWpFilesystem();

                global $wp_filesystem;

                $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
            }

            // ACTUAL DECLARATION OF SECTIONS
            $this->sections[] = array(
                'title'     => __('General Settings', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('General theme settings. You can set here the favicon of your website and the loading icon.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-wrench',
                'fields'    => array(

                    array(
                        'id'        => 'clapat_bg_favicon',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Custom Favicon', THEME_LANGUAGE_DOMAIN),
                        'compiler'  => 'true',
                        'desc'      => '',
                        'subtitle'  => __("You can put the url of an ico image that will represent your website's favicon<br>(16px x 16px)", THEME_LANGUAGE_DOMAIN),
                        'default'   => array('url' => get_template_directory_uri() . '/images/favicon.ico'),
                    ),
                    array(
                        'id'        => 'clapat_bg_loading_color',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Loader Color', THEME_LANGUAGE_DOMAIN),
                        'desc'      => '',
                        'subtitle'  => __('Pick a background color for the loader (default: #999).', THEME_LANGUAGE_DOMAIN),
                        'default'   => '#999',
                    	'validate'  => 'color',
                    ),
                    array(
                        'id'        => 'clapat_bg_loading_mask_color',
                        'type'      => 'color',
                        'title'     => __('Custom Loading Background Color', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Pick a background color for the loading mask (default: #FFFFFF).', THEME_LANGUAGE_DOMAIN),
                        'transparent' => false,
                        'default'   => '#FFFFFF',
                        'validate'  => 'color',
                    ),
					array(
                        'id'        => 'clapat_bg_back_to_top',
                        'type'      => 'switch',
                        'title'     => __('Display "Back To Top" button', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Show back to top arrow while scrolling the page content.', THEME_LANGUAGE_DOMAIN),
                        'default'   => true,
						'on'        => 'Yes',
                        'off'       => 'No',
                    ),
                    array(
                        'id'            => 'clapat_bg_space_head',
                        'type'          => 'textarea',
                        'title'         => __('Space before &lt;/head&gt;', THEME_LANGUAGE_DOMAIN),
                        'subtitle'      => __('Add code which is inserted before the &lt;/head&gt; tag.', THEME_LANGUAGE_DOMAIN),
                        'default'       => '',
                    ),

                ),
            );

            $this->sections[] = array(
                'title'     => __('Header Options', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Header Options. Select the logo displayed in the header.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-lines',
                'fields'    => array(

                    array(
                        'id'        => 'clapat_bg_logo_positive',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Logo - Positive', THEME_LANGUAGE_DOMAIN),
                        'desc'      => '',
                        'subtitle'  => __('Upload your logo for lighter backgrounds.', THEME_LANGUAGE_DOMAIN),
                        'default'   => array('url' => get_template_directory_uri() . '/images/logo.png'),
                    ),
					
					array(
                        'id'        => 'clapat_bg_logo_negative',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Header Logo - Negative', THEME_LANGUAGE_DOMAIN),
                        'desc'      => '',
                        'subtitle'  => __('Upload your logo for darker backgrounds.', THEME_LANGUAGE_DOMAIN),
                        'default'   => array('url' => get_template_directory_uri() . '/images/logo_white.png'),
                    ),
					
					array(
                        'id'        => 'clapat_bg_hide_header_scroll_down',
                        'type'      => 'switch',
                        'url'       => true,
                        'title'     => __('Hide Header When Scroll Down', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Hides the header when scrolling down, shows it when scrolling up', THEME_LANGUAGE_DOMAIN),
                        'default'   => false,
                    ),
                ),

            );

			$this->sections[] = array(
                'title'     => __('Menu Options', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Settings concerning the menu such as social links and copyright text.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-th-list',
                'fields'    => array(

					array(
                        'id'        => 'clapat_bg_menu_bknd_color',
                        'type'      => 'color',
                        'title'     => __('Menu Background Color', THEME_LANGUAGE_DOMAIN),
                        'transparent' => false,
						'default' => '#000000'
                        
                    ),
					
					array(
                        'id'            => 'clapat_bg_menu_bknd_color_opacity',
                        'type'          => 'slider',
                        'title'         =>  __('Menu Background Color Opacity', THEME_LANGUAGE_DOMAIN),
                        'default'       => 0.9,
                        'min'           => 0,
                        'step'          => .1,
                        'max'           => 1,
                        'resolution'    => 0.1,
                        'display_value' => 'text'
                    ),
					
					array(
                        'id'        => 'clapat_bg_menu_item_active',
                        'type'      => 'color',
                        'title'     => __('Active menu item color', THEME_LANGUAGE_DOMAIN),
						'subtitle'  => __('Color for the menu items when hovered or selected.', THEME_LANGUAGE_DOMAIN),
                        'transparent' => false,
						'output' => array( 'color' => '.clapat-overlay-menu .clapat-menu-container .categories li a:hover, .clapat-overlay-menu .clapat-menu-container .categories li a.is-active, .clapat-overlay-menu .clapat-menu-container .categories li a.active' ),
						'default' => '#FFFFFF'
                    ),
					
					array(
                        'id'        => 'clapat_bg_menu_item_default',
                        'type'      => 'color',
                        'title'     => __('Default menu item color', THEME_LANGUAGE_DOMAIN),
						'subtitle'  => __('Default color for the menu items in their normal state.', THEME_LANGUAGE_DOMAIN),
                        'transparent' => false,
						'output' => array( 'color' => '.clapat-overlay-menu .clapat-menu-container .categories li a' ),
						'default' => '#606060'
                        
                    ),
					
					array(
                        'id'        => 'clapat_bg_menu_copyright',
                        'type'      => 'switch',
                        'title'     => __('Show copyright text', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Display copyright text as defined in Footer options.', THEME_LANGUAGE_DOMAIN),
                        'default'   => true,
						'on'        => 'Yes',
                        'off'       => 'No',
                    ),
					
					array(
                        'id'        => 'clapat_bg_menu_socials',
                        'type'      => 'switch',
                        'title'     => __('Show social links', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Display social links as defined in Socials options.', THEME_LANGUAGE_DOMAIN),
                        'default'   => true,
						'on'        => 'Yes',
                        'off'       => 'No',
                    ),
                ),
            );
			
            $this->sections[] = array(
                'title'     => __('Footer Options', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Settings concerning the footer such us social links and copyright text.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-check-empty',
                'fields'    => array(

					array(
                        'id'        => 'clapat_bg_footer_layout',
                        'type'      => 'image_select',
                        'title'     => __('Select a Footer Layout', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Select the layout you wish to have for your footer', THEME_LANGUAGE_DOMAIN),

                        'options'   => array(
                            'v1' => array('alt' => 'First Footer Layout',   'img' => get_template_directory_uri() . '/images/footers/footer1.jpg'),
                            'v2' => array('alt' => 'Second Footer Layout',  'img' => get_template_directory_uri() . '/images/footers/footer2.jpg'),
                            'v3' => array('alt' => 'Third Footer Layout',   'img' => get_template_directory_uri() . '/images/footers/footer3.jpg')
                        ),
                        'default' => 'v1'
                    ),

                    array(
                        'id'        => 'clapat_bg_footer_socials_prefix',
                        'type'      => 'text',
                        'title'     => __('Socials Prefix', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Text displayed before the social links.', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'We are on',
                        'required'  => array( 'clapat_bg_footer_layout', '=', 'v2' )
                    ),

                    array(
                        'id'            => 'clapat_bg_footer_copyright',
                        'type'          => 'editor',
                        'title'         => __('Copyright text', THEME_LANGUAGE_DOMAIN),
                        'subtitle'      => __('This is the copyright text.', THEME_LANGUAGE_DOMAIN),
                        'default'       => '2015 &copy; Berger Template. All rights reserved.',
                    ),
                    
                    array(
                        'id'        => 'clapat_bg_styling_footer_color',
                        'type'      => 'color',
                        'title'     => __('Footer Background Color', THEME_LANGUAGE_DOMAIN),
                        'desc'      => '',
						'transparent' => false,
                        'default'   => '#eeeeee',
                        'validate'  => 'color',
                    ),
                ),
            );
			
			$this->sections[] = array(
                'title'     => __('Slider Options', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Settings concerning the Main Slider.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-tasks',
                'fields'    => array(

					array(
                        'id'        => 'clapat_bg_slider_transition',
                        'type'      => 'radio',
                        'title'     => __('Slider Transition', THEME_LANGUAGE_DOMAIN),

                        //Must provide key => value pairs for radio options
                        'options'   => array(
							'fade' => __('Fade', THEME_LANGUAGE_DOMAIN),
                            'slide' => __('Slide', THEME_LANGUAGE_DOMAIN)
                        ),
                        'default'   => 'fade'
                    ),
					
					array(
                        'id'        => 'clapat_bg_slider_direction',
                        'type'      => 'radio',
                        'title'     => __('Slider Direction', THEME_LANGUAGE_DOMAIN),

                        //Must provide key => value pairs for radio options
                        'options'   => array(
                            'horizontal' => __('Horizontal', THEME_LANGUAGE_DOMAIN),
                            'vertical' => __('Vertical', THEME_LANGUAGE_DOMAIN)
                        ),
                        'default'   => 'horizontal'
                    ),
					
                    array(
                        'id'        => 'clapat_bg_slider_autoplay',
                        'type'      => 'switch',
                        'title'     => __('Autoplay', THEME_LANGUAGE_DOMAIN),
                        'default'   => true,
                    ),
					
                    array(
                        'id'            => 'clapat_bg_slider_speed',
                        'type'          => 'slider',
                        'title'         => __('Slider Speed', THEME_LANGUAGE_DOMAIN),
                        'subtitle'      => __('Enter a value between 1 and 10.', THEME_LANGUAGE_DOMAIN),
                        'desc'          => __('Slider speed 1s-10s.', THEME_LANGUAGE_DOMAIN),
                        'default'       => 5,
                        'min'           => 1,
                        'step'          => 1,
                        'max'           => 10,
                        'display_value' => 'text'
                    ),
					
					array(
                        'id'        => 'clapat_bg_slider_arrow_cursor',
                        'type'      => 'switch',
                        'title'     => __('Enable Arrow Mouse Cursor', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Enable the arrow cursor to navigate between slides.', THEME_LANGUAGE_DOMAIN),
                        'on'        => 'Yes',
                        'off'       => 'No',
                        'default'   => true,
                    ),
				),
			);
			
			global $cpbg_social_links;
			$social_links_fields = array();
			$social_network_ids = array_keys( $cpbg_social_links );
			for( $idx = 1; $idx <= MAX_SOCIAL_LINKS; $idx++ ){
			
				$social_links_fields[] =	array(
													'id'        => 'clapat_bg_social_' . $idx,
													'type'      => 'select',
													'title'     => __('Social Network Name ' . $idx, THEME_LANGUAGE_DOMAIN),
													'options'   => $cpbg_social_links,
													'default'   => 'facebook'
												);
				$social_links_fields[] = array(
												'id'        => 'clapat_bg_social_url_' . $idx,
												'type'      => 'text',
												'title'     => __('Social Link URL ' . $idx, THEME_LANGUAGE_DOMAIN),
												'default'   => '',
											);
			}			
			$this->sections[] = array(
                'title'     => __('Social Links', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Define social links displayed in the footer and/or menu.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-slideshare',
                'fields'    => $social_links_fields
            );

            $this->sections[] = array(
                'title'     => __('Portfolio Options', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Settings concerning the portfolio section or portfolio pages.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-folder-open',
                'fields'    => array(

                    array(
                        'id'        => 'clapat_bg_portfolio_custom_slug',
                        'type'      => 'text',
                        'title'     => __('Custom Slug', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('If you want your portfolio post type to have a custom slug in the url, please enter it here. You will still have to refresh your permalinks after saving this! This is done by going to Settings > Permalinks and clicking save.', THEME_LANGUAGE_DOMAIN),
                        'default'   => '',
                    ),
					array(
                        'id'        => 'clapat_bg_portfolio_back_main_caption',
                        'type'      => 'text',
                        'title'     => __('Back To Projects Page Caption', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Caption of the button linking back to the main projects page displayed in each project (also known as portfolio item) page.', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Back To Works',
                    ),
					array(
                        'id'        => 'clapat_bg_portfolio_back_main_url',
                        'type'      => 'text',
                        'title'     => __('Back To Projects Page URL', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('URL of the button linking back to the main projects page displayed in each project (also known as portfolio item) page.', THEME_LANGUAGE_DOMAIN),
                        'validate'	=> 'url',
						'default'   => '',
                    ),
                    
                    // portfolio secondary menu
                    array(
                        'id'        => 'clapat_bg_portfolio_secondary_menu',
                        'type'      => 'switch',
                        'title'     => __('Enable Secondary Menu For Portfolio Pages', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Enable secondary menu in portfolio template pages allowing you to hide or show category filters.', THEME_LANGUAGE_DOMAIN),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'clapat_bg_portfolio_secondary_menu_hide',
                        'type'      => 'text',
                        'title'     => __('Caption When Filters Are Shown', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Caption of the secondary menu displayed when category filters are displayed.', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Hide',
                    	'required'  => array( 'clapat_bg_portfolio_secondary_menu', '=', true )
                    ),
                    array(
                        'id'        => 'clapat_bg_portfolio_secondary_menu_show',
                        'type'      => 'text',
                        'title'     => __('Caption When Filters Are Hidden', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Caption of the secondary menu displayed when category filters are hidden.', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Filters',
                    	'required'  => array( 'clapat_bg_portfolio_secondary_menu', '=', true )
                    ),
                    
                ),
            );

            $this->sections[] = array(
                'title'     => __('Blog Options', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Settings concerning the blog section or blog pages.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-bold',
                'fields'    => array(

                    array(
                        'id'        => 'clapat_bg_blog_post_title',
                        'type'      => 'switch',
                        'title'     => __('Show Post Title', THEME_LANGUAGE_DOMAIN),
                    	'subtitle'  => __('Shows or hides the title in blog page.', THEME_LANGUAGE_DOMAIN),
                        'on'        => 'Yes',
                        'off'       => 'No',
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'clapat_bg_blog_author_info',
                        'type'      => 'switch',
                        'title'     => __('Show Author Info Box', THEME_LANGUAGE_DOMAIN),
                    	'subtitle'  => __('Shows or hides the author in blog page.', THEME_LANGUAGE_DOMAIN),
                        'on'        => 'Yes',
                        'off'       => 'No',
                        'default'   => true,
                    ),

                    array(
                        'id'        => 'clapat_bg_blog_comments',
                        'type'      => 'switch',
                        'title'     => __('Show Comments Link', THEME_LANGUAGE_DOMAIN),
						'subtitle'  => __('Shows or hides the link to post\'s comments in blog page.', THEME_LANGUAGE_DOMAIN),
                        'on'        => 'Yes',
                        'off'       => 'No',
                        'default'   => true,
                    ),

                    // blog secondary menu
                    array(
                        'id'        => 'clapat_bg_blog_secondary_menu',
                        'type'      => 'switch',
                        'title'     => __('Enable Secondary Menu For Blog Pages', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Enable secondary menu in blog template pages allowing you to hide or show search box.', THEME_LANGUAGE_DOMAIN),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'clapat_bg_blog_secondary_menu_hide',
                        'type'      => 'text',
                        'title'     => __('Caption When Search Box Is Shown', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Caption of the secondary menu displayed when search box is displayed.', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Hide',
                    	'required'  => array( 'clapat_bg_blog_secondary_menu', '=', true )
                    ),
                    array(
                        'id'        => 'clapat_bg_blog_secondary_menu_show',
                        'type'      => 'text',
                        'title'     => __('Caption When Search Box Is Hidden', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Caption of the secondary menu displayed when search box is hidden.', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Search',
                    	'required'  => array( 'clapat_bg_blog_secondary_menu', '=', true )
                    ),
                    // blog post secondary menu
                    array(
                        'id'        => 'clapat_bg_blog_post_secondary_menu',
                        'type'      => 'switch',
                        'title'     => __('Enable Sharing Of Single Blog Pages', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Enable secondary menu in single blog post pages allowing you to hide or show the sharing box.', THEME_LANGUAGE_DOMAIN),
                        'default'   => false,
                    ),
                    array(
                        'id'        => 'clapat_bg_blog_post_secondary_menu_hide',
                        'type'      => 'text',
                        'title'     => __('Caption When Sharing Post Is Shown', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Caption of the secondary menu displayed when search box is displayed.', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Hide',
                    	'required'  => array( 'clapat_bg_blog_post_secondary_menu', '=', true )
                    ),
                    array(
                        'id'        => 'clapat_bg_blog_post_secondary_menu_show',
                        'type'      => 'text',
                        'title'     => __('Caption When Sharing Post Is Hidden', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Caption of the secondary menu displayed when sharing box is hidden.', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Share',
                    	'required'  => array( 'clapat_bg_blog_post_secondary_menu', '=', true )
                    ),
                    
                    array(
                        'id'        => 'clapat_bg_blog_post_share_facebook',
                        'type'      => 'switch',
                        'title'     => __('Share on Facebook', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Share blog posts on Facebook.', THEME_LANGUAGE_DOMAIN),
                        'default'   => true,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    	'required'  => array( 'clapat_bg_blog_post_secondary_menu', '=', true )
                    ),
                    
                    array(
                        'id'        => 'clapat_bg_blog_post_share_twitter',
                        'type'      => 'switch',
                        'title'     => __('Share on Twitter', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Share blog posts on Twitter.', THEME_LANGUAGE_DOMAIN),
                        'default'   => true,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    	'required'  => array( 'clapat_bg_blog_post_secondary_menu', '=', true )
                    ),
                    array(
                        'id'        => 'clapat_bg_blog_post_share_pinterest',
                        'type'      => 'switch',
                        'title'     => __('Share on Pinterest', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Share blog posts on Pinterest.', THEME_LANGUAGE_DOMAIN),
                        'default'   => true,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    	'required'  => array( 'clapat_bg_blog_post_secondary_menu', '=', true )
                    ),                    
                )
            );

			$this->sections[] = array(
                'title'     => __('Styling Options', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Settings concerning colors and custom CSS.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-brush',
                'fields'    => array(

					array(
                        'id'        => 'clapat_bg_theme_color',
                        'type'      => 'color',
                        'title'     => __('Theme Main Color', THEME_LANGUAGE_DOMAIN),
                        'desc'      => '',
						'output'	=> array( 'color' => 'a:hover, a:active, a:focus, .play-icon:hover i, #filters li a:hover, .meta-categories li a:hover, .entry-meta li a:hover, .blog-nav li a:hover, .post-share li a:hover, .hidden-box:hover .header-box, .clapat-button.outline-button:hover, .clapat-button.outline-button:active, .clapat-button.outline-button:focus, .socials li a:hover, .services-icon:hover i, .service-icon-top:hover i, .text-socials-minimal li a:hover, .product_list_widget li a:hover, .shop-nav li a:hover, .twitter-icon i, .twitter-slider li a:hover'	),
                        'transparent' => false,
                        'default'   => '#34d5cb',
                        'validate'  => 'color',
                    ),
                    
                    array(
                        'id'        => 'clapat_bg_styling_custom_css',
                        'type'      => 'textarea',
                        'title'     => __('Custom CSS', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Add here your custom CSS code.', THEME_LANGUAGE_DOMAIN),
                        'validate'  => 'css',
                    ),
				),
			);
				
			$this->sections[] = array(
                'title'     => __('Typography', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Font options to render the typography style of your website.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-fontsize',
                'fields'    => array(

                    array(
                        'id'        => 'clapat_bg_body_font',
                        'type'      => 'typography',
                        'output'    => array('html', 'body'),
                        'title'     => __('Body Font Options', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Select font options for the body', THEME_LANGUAGE_DOMAIN),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => true,
                        'font-weight' => true,
						'color' => false,
                        'default'   => array(
                            'google'      => true,
                            'font-size'     => '12px',
                            'font-family'   => 'Verdana, Geneva, sans-serif',
                            'line-height'   => '25px',
                            'font-weight'   => '400',
                        ),
                    ),

                    array(
                        'id'        => 'clapat_bg_heading_font',
                        'type'      => 'typography',
                        'output'    => array('h1, h2, h3, h4, h5, h6, .clapat-overlay-menu .clapat-menu-container .categories li a, .item-title, .prev-project .name-prev-project , .next-project .name-next-project, .all-projects, .post-title, .post-title-no-link, input[type="submit"], .clapat-button, .clapat-counter .number, .p-table-title, .p-table-num, .p-table-num sup, .radial-counter input, .quote, .twitter-slider li, .product_list_widget li a, .woocommerce .widget_shopping_cart_content .buttons a, .woocommerce ul.products li.product .button, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta strong'),
                        'title'     => __('Headings Font Options', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Select font options for the headings.', THEME_LANGUAGE_DOMAIN),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => false,
						'font-size'	=> false,
						'line-height' => false,
                        'font-weight' => true,
						'color' => false,
                        'default'   => array(
                            'google'      => true,
                            'font-family'   => 'Montserrat, sans-serif',
                            'font-weight'   => '400',
                        ),
                    ),
					
					array(
                        'id'        => 'clapat_bg_subtitle_font',
                        'type'      => 'typography',
                        'output'    => array('.monospace, .item-cat, .prev-project, .next-project, .meta-categories li a, .blog-nav li, .comment-date, .comment-reply-link, input[type="text"], input[type="email"], input[type="password"], textarea, .accordion dt, .toggle-title, ul.tabs li a, .progress-bar li p, .clapat-counter .subject, .p-table-list, .p-table-per, .text-socials-minimal li, blockquote span, .selectric .label, .shop-nav li, .woocommerce #reviews #comments ol.commentlist li .comment-text p.meta time'),
                        'title'     => __('Subheadings Font Options', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Select font options for subheadings.', THEME_LANGUAGE_DOMAIN),
                        'google'    => true,
                        'text-align'=> false,
                        'subsets'   => false,
						'line-height' => false,
                        'font-weight' => true,
						'color' => false,
                        'default'   => array(
                            'google'      	=> true,
							'font-size'     => '14px',
                            'font-family'   => 'Inconsolata',
                            'font-weight'   => '400',
                        ),
                    ),
				)
			);
			
            $this->sections[] = array(
                'title'     => __('Map Options', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Settings concerning the map section.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-map-marker',
                'fields'    => array(

					array(
                        'id'        => 'clapat_bg_map_marker',
                        'type'      => 'media',
                        'url'       => true,
                        'title'     => __('Map Marker', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Please choose an image file for the marker.', THEME_LANGUAGE_DOMAIN),
                        'default'   => array('url' => get_template_directory_uri() . '/images/marker.png'),
                    ),
					array(
                        'id'        => 'clapat_bg_map_address',
                        'type'      => 'text',
                        'title'     => __('Google Map Address', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Example: 775 New York Ave, Brooklyn, Kings, New York 11203. Or you can enter latitude and longitude for greater precision. Example: 41.40338, 2.17403 (in decimal degrees - DDD)', THEME_LANGUAGE_DOMAIN),
                        'default'   => '775 New York Ave, Brooklyn, Kings, New York 11203',
                    ),
					array(
                        'id'        => 'clapat_bg_map_zoom',
                        'type'      => 'text',
                        'title'     => __('Map Zoom Level', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Higher number will be more zoomed in.', THEME_LANGUAGE_DOMAIN),
                        'default'   => '16',
                    ),
                    array(
                        'id'        => 'clapat_bg_map_company_name',
                        'type'      => 'text',
                        'title'     => __('Pop-up marker title', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'BERGER',
                    ),
                    array(
                        'id'        => 'clapat_bg_map_company_info',
                        'type'      => 'text',
                        'title'     => __('Pop-up marker text', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Here we are. Come to drink a coffee!',
                    ),
                    array(
                        'id'        => 'clapat_bg_map_type',
                        'type'      => 'switch',
                        'title'     => __('Map type', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Set the map type as road map or satellite.', THEME_LANGUAGE_DOMAIN),
                        'on'        => 'Road',
                        'off'       => 'Satellite',
                        'default'   => true,
                    ),
					array(
                        'id'        => 'clapat_bg_map_api_key',
                        'type'      => 'text',
                        'title'     => esc_html__('Google Maps API Key', THEME_LANGUAGE_DOMAIN),
						'subtitle'  => esc_html__('Without it, the map may not be displayed. If you have an api key paste it here. More information on how to obtain a google maps api key: https://developers.google.com/maps/documentation/javascript/get-api-key#get-an-api-key', THEME_LANGUAGE_DOMAIN),
                        'default'   => '',
                    ),
                    // contact secondary menu
                    array(
                        'id'        => 'clapat_bg_map_secondary_menu',
                        'type'      => 'switch',
                        'title'     => __('Enable Secondary Menu For Contact Pages', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Enable secondary menu in contact template pages allowing you to hide or show contact info.', THEME_LANGUAGE_DOMAIN),
                        'default'   => true,
                    ),
                    array(
                        'id'        => 'clapat_bg_map_secondary_menu_hide',
                        'type'      => 'text',
                        'title'     => __('Caption When Contact Info Is Shown', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Caption of the secondary menu displayed when contact info is displayed.', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Hide',
                    	'required'  => array( 'clapat_bg_map_secondary_menu', '=', true )
                    ),
                    array(
                        'id'        => 'clapat_bg_map_secondary_menu_show',
                        'type'      => 'text',
                        'title'     => __('Caption When Contact Info Is Hidden', THEME_LANGUAGE_DOMAIN),
                        'desc'      => __('Caption of the secondary menu displayed when contact info is hidden.', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Contact',
                    	'required'  => array( 'clapat_bg_map_secondary_menu', '=', true )
                    ),                    
                )
            );

            $this->sections[] = array(
                'title'     => __('Shop Options', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Options concerning shop pages.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-shopping-cart',
                'fields'    => array(

                    array(	'id'        => 'clapat_bg_shop_columns',
							'type'      => 'select',
							'title'     => __( 'Shop Columns', THEME_LANGUAGE_DOMAIN ),
                    		'subtitle'  => __( 'Number of columns used to display products in the shop page', THEME_LANGUAGE_DOMAIN ),
							'options'   => array('2' => '2 Columns', '3' => '3 Columns'),
							'default'   => '3', 
                    ),
                    array(
                        'id'        => 'clapat_bg_shop_filters_hide',
                        'type'      => 'text',
                        'title'     => __('Caption When Products Filter Is Shown', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Caption of the secondary menu displayed when the products filter is displayed within the shop page.', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Hide'
                    ),
                    array(
                        'id'        => 'clapat_bg_shop_filters_show',
                        'type'      => 'text',
                        'title'     => __('Caption When Products Filter Is Hidden', THEME_LANGUAGE_DOMAIN),
                        'subtitle'  => __('Caption of the secondary menu displayed when the products filter is displayed within the shop page.', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Filters'
                    ), 
					
                ),

            );
            
            $this->sections[] = array(
                'title'     => __('Error Page Options', THEME_LANGUAGE_DOMAIN),
                'desc'      => __('Settings concerning the "error not found page (404)" section.', THEME_LANGUAGE_DOMAIN),
                'icon'      => 'el-icon-error-alt',
                'fields'    => array(

                    array(
                        'id'        => 'clapat_bg_error_title',
                        'type'      => 'text',
                        'title'     => __('Error Page Title', THEME_LANGUAGE_DOMAIN),
                        'default'   => '404',
                    ),
					array(
                        'id'        => 'clapat_bg_error_info',
                        'type'      => 'textarea',
                        'title'     => __('Error Page Info text', THEME_LANGUAGE_DOMAIN),
                        'validate'  => 'html',
                        'default'   => 'The page you are looking for could not be found.',
                    ),
                    array(
                        'id'        => 'clapat_bg_error_back_button',
                        'type'      => 'text',
                        'title'     => __('Back Button Caption', THEME_LANGUAGE_DOMAIN),
                        'default'   => 'Home Page',
                    ),
					
					array(
                        'id'        => 'clapat_bg_error_back_button_url',
                        'type'      => 'text',
                        'title'     => __('Back Button URL', THEME_LANGUAGE_DOMAIN),
                        'default'   => get_home_url(),
                    ),

                )
            );

            $this->sections[] = array(
                'title'     => __('Import / Export', 'redux-framework-demo'),
                'desc'      => __('Import and Export your settings from file, text or URL.', 'redux-framework-demo'),
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
                'id'      => 'redux-help-tab-1',
                'title'   => __( 'Theme Information 1', 'redux-framework-demo' ),
                'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
            );

            $this->args['help_tabs'][] = array(
                'id'      => 'redux-help-tab-2',
                'title'   => __( 'Theme Information 2', 'redux-framework-demo' ),
                'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo' )
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo' );
        }

        /**
         * All the possible arguments for Redux.
         * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'             => THEME_OPTIONS,
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'         => $theme->get( 'Name' ),
                // Name that appears at the top of your panel
                'display_version'      => $theme->get( 'Version' ),
                // Version that appears at the top of your panel
                'menu_type'            => 'submenu',
                //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'       => true,
                // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', THEME_LANGUAGE_DOMAIN),
                'page_title'        => $theme->get('Name') . __(' Theme Options', THEME_LANGUAGE_DOMAIN),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key'       => 'AIzaSyCo4U6ficbcj__7_LC1YpFDxtmTJ-pzoQ0',
                // Set it you want google fonts to update weekly. A google_api_key value is required.
                'google_update_weekly' => false,
                // Must be defined to add google fonts to the typography module
                'async_typography'     => false,
                // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar'            => true,
                // Show the panel pages on the admin bar
                'admin_bar_icon'     => 'dashicons-portfolio',
                // Choose an icon for the admin bar menu
                'admin_bar_priority' => 50,
                // Choose an priority for the admin bar menu
                'global_variable'      => 'clapat_bg_theme_options',
                // Set a different name for your global variable other than the opt_name
                'dev_mode'             => false,
                // Show the time the page took to load, etc
                'update_notice'        => true,
                // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
                'customizer'           => true,
                // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

                // OPTIONAL -> Give you extra features
                'page_priority'        => null,
                // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent'          => 'themes.php',
                // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions'     => 'manage_options',
                // Permissions needed to access the options panel.
                'menu_icon'            => '',
                // Specify a custom URL to an icon
                'last_tab'             => '',
                // Force your panel to always open to a specific tab (by id)
                'page_icon'            => 'icon-themes',
                // Icon displayed in the admin panel next to your menu_title
                'page_slug'            => '_options',
                // Page slug used to denote the panel
                'save_defaults'        => true,
                // On load save the defaults to DB before user clicks save or not
                'default_show'         => false,
                // If true, shows the default value next to each field that is not the default value.
                'default_mark'         => '',
                // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export'   => true,
                // Shows the Import/Export panel when not used as a field.

                // CAREFUL -> These options are for advanced use only
                'transient_time'       => 60 * MINUTE_IN_SECONDS,
                'output'               => true,
                // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag'           => true,
                // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database'             => '',
                // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info'          => false,
                // REMOVE

                // HINTS
                'hints'                => array(
                    'icon'          => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color'    => 'lightgray',
                    'icon_size'     => 'normal',
                    'tip_style'     => array(
                        'color'   => 'light',
                        'shadow'  => true,
                        'rounded' => false,
                        'style'   => '',
                    ),
                    'tip_position'  => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect'    => array(
                        'show' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'mouseover',
                        ),
                        'hide' => array(
                            'effect'   => 'slide',
                            'duration' => '500',
                            'event'    => 'click mouseleave',
                        ),
                    ),
                )
            );

            $this->args['footer_credit'] = $theme->get( 'Name' ) . ' ' . $theme->get( 'Version' ) . ' by Clapat';

            // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
            /*$this->args['admin_bar_links'][] = array(
                'id'    => 'redux-docs',
                'href'   => 'http://docs.reduxframework.com/',
                'title' => __( 'Documentation', 'redux-framework-demo' ),
            );

            $this->args['admin_bar_links'][] = array(
                //'id'    => 'redux-support',
                'href'   => 'https://github.com/ReduxFramework/redux-framework/issues',
                'title' => __( 'Support', 'redux-framework-demo' ),
            );

            $this->args['admin_bar_links'][] = array(
                'id'    => 'redux-extensions',
                'href'   => 'reduxframework.com/extensions',
                'title' => __( 'Extensions', 'redux-framework-demo' ),
            );*/

            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            /*$this->args['share_icons'][] = array(
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
            );*/

            // Panel Intro text -> before the form
            /*if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                if ( ! empty( $this->args['global_variable'] ) ) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace( '-', '_', $this->args['opt_name'] );
                }
                $this->args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
            } else {
                $this->args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
            }*/

            // Add content after the form.
            //$this->args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );
        }

        public function validate_callback_function( $field, $value, $existing_value ) {
            $error = true;
            $value = 'just testing';

            /*
          do your validation

          if(something) {
            $value = $value;
          } elseif(something else) {
            $error = true;
            $value = $existing_value;

          }
         */

            $return['value'] = $value;
            $field['msg']    = 'your custom error message';
            if ( $error == true ) {
                $return['error'] = $field;
            }

            return $return;
        }

        public function class_field_callback( $field, $value ) {
            print_r( $field );
            echo '<br/>CLASS CALLBACK';
            print_r( $value );
        }

    }

    global $ClapatBgConfig;
    $ClapatBgConfig = new Clapat_Bg_options_config();
} else {
    echo "The class named Redux_Framework_sample_config has already been called. <strong>Developers, you need to prefix this class with your company name or you'll run into problems!</strong>";
}

/**
 * Custom function for the callback referenced above
 */
if ( ! function_exists( 'redux_my_custom_field' ) ):
    function redux_my_custom_field( $field, $value ) {
        print_r( $field );
        echo '<br/>';
        print_r( $value );
    }
endif;

/**
 * Custom function for the callback validation referenced above
 * */
if ( ! function_exists( 'redux_validate_callback_function' ) ):
    function redux_validate_callback_function( $field, $value, $existing_value ) {
        $error = true;
        $value = 'just testing';

        /*
      do your validation

      if(something) {
        $value = $value;
      } elseif(something else) {
        $error = true;
        $value = $existing_value;

      }
     */

        $return['value'] = $value;
        $field['msg']    = 'your custom error message';
        if ( $error == true ) {
            $return['error'] = $field;
        }

        return $return;
    }
endif;
