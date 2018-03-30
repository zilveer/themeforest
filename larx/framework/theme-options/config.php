<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux_Framework_sample_config' ) ) {

        class Redux_Framework_sample_config {

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
                add_action( 'redux/loaded', array( $this, 'remove_demo' ) );

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
                    'icon'   => 'el-icon-cogs',
                    'title'  => __( 'General Settings', 'redux-framework-demo' ),
                    'fields' => array(
                        array(
                            'id'       => 'logo',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Logo image', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc'     => __( 'Upload your website\'s logo image.', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_template_directory_uri().'/assets/img/logo.png' ),
                        ),
                        array(
                            'id'       => 'retina_logo',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Retina Logo image', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc'     => __( 'Retina Logo should be 2x larger than Custom Logo (field is optional).', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_template_directory_uri().'/assets/img/logo@2x.png' ),
                        ),
                        array(
                            'id'            => 'initial_header_padding',
                            'type'          => 'spacing',
                            'mode'          => 'padding',    // absolute, padding, margin, defaults to padding
                            'top'           => true,     // Disable the top
                            'right'         => false,     // Disable the right
                            'bottom'        => false,     // Disable the bottom
                            'left'          => true,     // Disable the left
                            'title'         => __('Padding-Top/Padding-Left values for header`s Logo', 'redux-framework-demo'),
                            'desc'          => __('You can adjust the logo position in header by setting a top-padding to it. Values are defined in pixels.', 'redux-framework-demo'),
                            'default'       => array(
                                'padding-top'    => '10',
                                'padding-left' => '15',
                            )
                        ),
                        array(
                            'id'       => 'favicon',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Custom favicon', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc'     => __( 'Upload a 16px x 16px Png/Gif image that will represent your website\'s favicon', 'redux-framework-demo' ),
                            'default'  => array( 'url' => get_template_directory_uri().'/assets/img/favicon.ico' ),
                        ),
                        array(
                            'id'       => 'preloader',
                            'type'     => 'switch',
                            'title'    => __( 'Page loader', 'redux-framework-demo' ),
                            'desc'     => __( 'Enable or Disable the Page Loader', 'redux-framework-demo' ),
                            'default'  => true,
                        ),
                        array(
                            'id'       => 'login_logo',
                            'type'     => 'media',
                            'url'      => true,
                            'title'    => __( 'Custom login logo', 'redux-framework-demo' ),
                            'compiler' => 'true',
                            //'mode'      => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc'     => __( 'Add a custom logo for the Wordpress login screen', 'redux-framework-demo' )
                        ),
						array(
                            'id'       => 'enable_rtl_layout',
                            'type'     => 'switch',
                            'title'    => __( 'Enable RTL Layout', 'redux-framework-demo' ),
                            'desc'     => __( 'Enable RTL layour for the theme', 'redux-framework-demo' ),
                            'default'  => false,
                        ),
                    )
                );


                $this->sections[] = array(
                    'title'  => __( 'Header', 'redux-framework-demo' ),
                    'icon'   => 'el-icon-home',
                    'fields' => array(
                        array(
                            'id'       => 'theme_menu_style',
                            'type'     => 'select',
                            'title'    => __( 'Main menu style', 'redux-framework-demo' ),
                            'desc' => __( 'Choose a style for your menu.', 'redux-framework-demo' ),
                            'options'  => array( 'top' => 'Top Navbar', 'bottom' => 'Bottom Navbar', 'canvas' => 'Canvas Navbar' ),
                            'default'  => 'top',
                        ),
                        array(
                            'id'       => 'switch_social',
                            'type'     => 'switch',
                            'title'    => __( 'Enable or disable social icons on nav bar', 'redux-framework-demo' ),
                            'desc' => __( 'It\'s work only if is enabled canvas menu style', 'redux-framework-demo' ),
                            'default'  => 0,
                            'on'       => 'Enable',
                            'off'      => 'Disable',
                        ),
                        array(
                            'id' => 'pinterest_url',
                            'type' => 'text',
                            'required' => array( 'switch_social', '=', '1' ),
                            'title' => __('Pinterest URL', 'redux-framework-demo' ),
                            'desc' => __('Your Pinterest URL', 'redux-framework-demo' ),
                        ),
                        array(
                            'id' => 'skype_url',
                            'type' => 'text',
                            'required' => array( 'switch_social', '=', '1' ),
                            'title' => __('Skype URL', 'redux-framework-demo' ),
                            'desc' => __('Your Skype URL', 'redux-framework-demo' ),
                        ),
                        array(
                            'id' => 'twitter_url',
                            'type' => 'text',
                            'required' => array( 'switch_social', '=', '1' ),
                            'title' => __('Twitter URL', 'redux-framework-demo' ),
                            'desc' => __('Your Twitter URL', 'redux-framework-demo' ),
                        ),
                        array(
                            'id' => 'facebook_url',
                            'type' => 'text',
                            'required' => array( 'switch_social', '=', '1' ),
                            'title' => __('Facebook URL', 'redux-framework-demo' ),
                            'desc' => __('Your Facebook URL', 'redux-framework-demo' ),
                        ),
                        array(
                            'id' => 'custom_social',
                            'type' => 'textarea',
                            'required' => array( 'switch_social', '=', '1' ),
                            'title' => __('Custom Social URL', 'redux-framework-demo' ),
                            'subtitle' => __('Your Social URL', 'redux-framework-demo' ),
                            'description'=>__('Ex: &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;span class=&quot;fa-stack fa-lg&quot;&gt;&lt;i class=&quot;fa fa-circle fa-stack-2x&quot;&gt;&lt;/i&gt;&lt;i class=&quot;fa fa-facebook fa-stack-1x fa-inverse&quot;&gt;&lt;/i&gt;&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;<br> <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Click to get icon</a>', 'redux-framework-demo' )
                        ),
						array(
							'id'       => 'th_nav_data',
							'type'     => 'checkbox',
							'title'    => __( 'Multi page option (for menu data)', 'redux-framework-demo' ),
							'subtitle' => __( 'Check if you will use multi page style for your site.', 'redux-framework-demo' ),
							'desc'     => __( 'If is checked you can use navigation items in One and Multi page style. For additional information follow the instructions from documentation.', 'redux-framework-demo' ),
							'default'  => '0'// 1 = on | 0 = off
						),
                    ),
                );

                $this->sections[] = array(
                    'icon'       => 'el-icon-magic',
                    'title'      => __( 'Styling Options', 'redux-framework-demo' ),
                    'fields'     => array(
                        array(
                            'id'       => 'theme_style',
                            'type'     => 'select',
                            'title'    => __( 'Theme style', 'redux-framework-demo' ),
                            'desc' => __( 'Choose a style for your theme.', 'redux-framework-demo' ),
                            'options'  => array( 'white' => 'White', 'dark' => 'Dark'),
                            'default'  => 'white',
                        ),
						array(
                            'id'       => 'th_select_stylesheet',
                            'type'     => 'select',
                            'title'    => __( 'Theme Stylesheet', 'redux-framework-demo' ),
                            'subtitle' => __( 'Select your themes alternative color scheme.', 'redux-framework-demo' ),
                            'options'  => array( 'default.css' => 'default.css', 'blue.css'  => 'blue.css', 'brown.css'  => 'brown.css', 'green.css'  => 'green.css', 'orange.css'  => 'orange.css', 'purple.css'  => 'purple.css', 'red.css'  => 'red.css', ),
                            'default.css'  => 'default.css',
                        ),
                        array(
                            'id'       => 'th_custom_color',
                            'type'     => 'color',
                            'output'   => array( '.site-title' ),
                            'title'    => __( 'Custom theme color', 'redux-framework-demo' ),
                            'subtitle' => __( 'Pick a color for the theme elements (default: #d0ad55).', 'redux-framework-demo' ),
                            'default'  => '',
                            'validate' => 'color',
                        ),
						array(
                            'id'       => 'th_custom_hover_color',
                            'type'     => 'color',
                            'output'   => array( '.site-title' ),
                            'title'    => __( 'Custom theme color on hover', 'redux-framework-demo' ),
                            'subtitle' => __( 'Pick a color for the theme on hover (default: #D8BA6F).', 'redux-framework-demo' ),
                            'default'  => '',
                            'validate' => 'color',
                        ),
                        array(
                            'id'       => 'th_custom_nav_color',
                            'type'     => 'color',
                            'output'   => array( '.site-title' ),
                            'title'    => __( 'Custom navigation links color', 'redux-framework-demo' ),
                            'subtitle' => __( 'Pick a color for the links in navigation.', 'redux-framework-demo' ),
                            'default'  => '',
                            'validate' => 'color',
                        ),
                        array(
                            'id'       => 'th_custom_nav_hover_color',
                            'type'     => 'color',
                            'output'   => array( '.site-title' ),
                            'title'    => __( 'Custom navigation links on hover', 'redux-framework-demo' ),
                            'subtitle' => __( 'Pick a color for the navigation links on hover.', 'redux-framework-demo' ),
                            'default'  => '',
                            'validate' => 'color',
                        ),
                        array(
                            'id'       => 'opt-ace-editor-css',
                            'type'     => 'ace_editor',
                            'title'    => __( 'CSS Code', 'redux-framework-demo' ),
                            'subtitle' => __( 'Paste your CSS code here.', 'redux-framework-demo' ),
                            'mode'     => 'css',
                            'theme'    => 'monokai',
                            'desc'     => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                            'default'  => "#header{\nmargin: 0 auto;\n}"
                        ),


                    ),
                );

                $this->sections[] = array(
                    'icon'       => 'el-icon-website',
                    'title'      => __( 'Footer', 'redux-framework-demo' ),
                    'fields'     => array(
                        array(
                            'id'       => 'footer_text',
                            'type'     => 'editor',
                            'title'    => __( 'Footer Text', 'redux-framework-demo' ),
                            'desc' => __( 'Place here your copyright line. For ex: Copyright 2014 | My website.', 'redux-framework-demo' ),
                            'default'  => '&#169; Copyright LARX - All Rights Reserved',
                        ),
                        array(
                            'id'       => 'switch_footer_social',
                            'type'     => 'switch',
                            'title'    => __( 'Enable or disable footer social icons', 'redux-framework-demo' ),
                            'default'  => 0,
                            'on'       => 'Enable',
                            'off'      => 'Disable',
                        ),
                        array(
                            'id' => 'footer_pinterest_url',
                            'type' => 'text',
                            'required' => array( 'switch_footer_social', '=', '1' ),
                            'title' => __('Pinterest URL', 'redux-framework-demo' ),
                            'desc' => __('Your Pinterest URL', 'redux-framework-demo' ),
                        ),
                        array(
                            'id' => 'footer_skype_url',
                            'type' => 'text',
                            'required' => array( 'switch_footer_social', '=', '1' ),
                            'title' => __('Skype URL', 'redux-framework-demo' ),
                            'desc' => __('Your Skype URL', 'redux-framework-demo' ),
                        ),
                        array(
                            'id' => 'footer_twitter_url',
                            'type' => 'text',
                            'required' => array( 'switch_footer_social', '=', '1' ),
                            'title' => __('Twitter URL', 'redux-framework-demo' ),
                            'desc' => __('Your Twitter URL', 'redux-framework-demo' ),
                        ),
                        array(
                            'id' => 'footer_facebook_url',
                            'type' => 'text',
                            'required' => array( 'switch_footer_social', '=', '1' ),
                            'title' => __('Facebook URL', 'redux-framework-demo' ),
                            'desc' => __('Your Facebook URL', 'redux-framework-demo' ),
                        ),
                        array(
                            'id' => 'footer_custom_social',
                            'type' => 'textarea',
                            'required' => array( 'switch_footer_social', '=', '1' ),
                            'title' => __('Custom Social URL', 'redux-framework-demo' ),
                            'subtitle' => __('Your Social URL', 'redux-framework-demo' ),
                            'description'=>__('Ex: &lt;li&gt;&lt;a href=&quot;#&quot;&gt;&lt;span class=&quot;fa-stack fa-lg&quot;&gt;&lt;i class=&quot;fa fa-circle fa-stack-2x&quot;&gt;&lt;/i&gt;&lt;i class=&quot;fa fa-facebook fa-stack-1x fa-inverse&quot;&gt;&lt;/i&gt;&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;<br> <a href="http://fortawesome.github.io/Font-Awesome/icons/" target="_blank">Click to get icon</a>', 'redux-framework-demo' )
                        ),
						array(
							'id'       => 'th_footer_social_target',
							'type'     => 'select',
							 'required' => array( 'switch_footer_social', '=', '1' ),
							'title'    => __('Target', 'redux-framework-demo'), 
							'desc'     => __('The target attribute specifies where to open the linked document..', 'redux-framework-demo'),
							'options'  => array(
								'_self' => 'Same window',
								'_blank' => 'New window',
							),
							'default'  => '_self',
						),
                        array(
                            'id'       => 'footer_tracking_code',
                            'type'     => 'textarea',
                            'title'    => __( 'Tracking Code', 'redux-framework-demo' ),
                            'desc'     => __( 'Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme', 'redux-framework-demo' ),
                        ),

                    ),
                );

                $this->sections[] = array(
                    'icon'       => 'el-icon-screen',
                    'title'      => __( 'Portfolio', 'redux-framework-demo' ),
                    'fields'     => array(
                        array(
                            'id'       => 'head_is_overlay',
                            'type'     => 'switch',
                            'title'    => __( 'Add Overlay', 'redux-framework-demo' ),
                            'desc'    => __( 'Enable or disable overlay effect for header image in single project page', 'redux-framework-demo' ),
                            'default'  => 1,
                            'on'       => 'Enable',
                            'off'      => 'Disable',
                        ),
                        array(
                            'id'       => 'switch_project_client',
                            'type'     => 'switch',
                            'title'    => __( 'Client', 'redux-framework-demo' ),
                            'desc'    => __( 'Enable or disable portfolio client fileld in single project page', 'redux-framework-demo' ),
                            'default'  => 1,
                            'on'       => 'Enable',
                            'off'      => 'Disable',
                        ),
                        array(
                            'id'       => 'switch_project_website',
                            'type'     => 'switch',
                            'title'    => __( 'Website', 'redux-framework-demo' ),
                            'desc'    => __( 'Enable or disable portfolio website fileld in single project page', 'redux-framework-demo' ),
                            'default'  => 1,
                            'on'       => 'Enable',
                            'off'      => 'Disable',
                        ),
                        array(
                            'id'       => 'switch_project_social',
                            'type'     => 'switch',
                            'title'    => __( 'Social Icons', 'redux-framework-demo' ),
                            'desc'    => __( 'Enable or disable portfolio social links in single project page', 'redux-framework-demo' ),
                            'default'  => 1,
                            'on'       => 'Enable',
                            'off'      => 'Disable',
                        ),
                    ),
                );

                $this->sections[] = array(
                    'icon'       => 'el-icon-lines',
                    'title'      => __( 'Blog', 'redux-framework-demo' ),
                    'fields'     => array(
                        array(
                            'id'       => 'excerpt_length',
                            'type'     => 'text',
                            'title'    => __( 'Excerpt length', 'redux-framework-demo' ),
                            'desc'     => __( 'Add your own custom blog excerpt length', 'redux-framework-demo' ),
                            'validate' => 'numeric',
                            'default'  => '70',
                        ),
                        array(
                            'id'       => 'home_sidebar_position',
                            'type'     => 'image_select',
                            'compiler' => true,
                            'title'    => __( 'Sidebar Position', 'redux-framework-demo' ),
                            'desc' => __( 'Choose a default page layout for your pages: Fullwidth, Sidebar Left  or Sidebar Right', 'redux-framework-demo' ),
                            'options'  => array(
                                'no' => array(
                                    'alt' => '1 Column',
                                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                                ),
                                'left' => array(
                                    'alt' => '2 Column Left',
                                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                                ),
                                'right' => array(
                                    'alt' => '2 Column Right',
                                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                                )
                            ),
                            'default'  => 'right'
                        ),
                        array(
                            'id'        => 'blog_sidebar_id',
                            'type'      => 'select',
                            'title'     => __('Sidebar name for blog related pages', 'redux-framework-demo'),
                            'desc'  => __('Select the sidebar which will be applied to blog related pages, including single posts, index page, archive pages and search result pages', 'redux-framework-demo'),
                            'data'      => 'sidebars',
                            'default' => 'blog_sidebar',
                        ),
                        array(
                            'id'       => 'switch_about_author',
                            'type'     => 'switch',
                            'title'    => __( 'Enable author box for blog posts inner pages', 'redux-framework-demo' ),
                            'desc'    => __( 'If the option is enabled, the author box will be displayed', 'redux-framework-demo' ),
                            'default'  => 0,
                            'on'       => 'Enable',
                            'off'      => 'Disable',
                        ),
                        array(
                            'id'       => 'switch_social_share',
                            'type'     => 'switch',
                            'title'    => __( 'Enable social share icons for blog posts inner pages', 'redux-framework-demo' ),
                            'desc'    => __( 'If the option is enabled, the social icons for sharing the post will be displayed', 'redux-framework-demo' ),
                            'default'  => 1,
                            'on'       => 'Enable',
                            'off'      => 'Disable',
                        ),
                        array(
                            'id'       => 'switch_next_prev',
                            'type'     => 'switch',
                            'title'    => __( 'Enable Prev/Next posts links for blog posts', 'redux-framework-demo' ),
                            'desc'    => __( 'If the option is enabled, links for Prev/Next posts will be displayed', 'redux-framework-demo' ),
                            'default'  => 1,
                            'on'       => 'Enable',
                            'off'      => 'Disable',
                        ),
                        array(
                            'id'       => 'switch_continue_reading_button',
                            'type'     => 'switch',
                            'title'    => __( 'Read more button', 'redux-framework-demo' ),
                            'desc'    => __( 'If the option is enabled, Read More Button will be displayed on blog entries', 'redux-framework-demo' ),
                            'default'  => 1,
                            'on'       => 'Enable',
                            'off'      => 'Disable',
                        ),
                    ),
                );

                $theme_info = '<div class="redux-framework-section-desc">';
                $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __( '<strong>Theme URL:</strong> ', 'redux-framework-demo' ) . '<a href="' . $this->theme->get( 'ThemeURI' ) . '" target="_blank">' . $this->theme->get( 'ThemeURI' ) . '</a></p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __( '<strong>Author:</strong> ', 'redux-framework-demo' ) . $this->theme->get( 'Author' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __( '<strong>Version:</strong> ', 'redux-framework-demo' ) . $this->theme->get( 'Version' ) . '</p>';
                $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get( 'Description' ) . '</p>';
                $tabs = $this->theme->get( 'Tags' );
                if ( ! empty( $tabs ) ) {
                    $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __( '<strong>Tags:</strong> ', 'redux-framework-demo' ) . implode( ', ', $tabs ) . '</p>';
                }
                $theme_info .= '</div>';

                if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
                    $this->sections['theme_docs'] = array(
                        'icon'   => 'el-icon-list-alt',
                        'title'  => __( 'Documentation', 'redux-framework-demo' ),
                        'fields' => array(
                            array(
                                'id'       => '17',
                                'type'     => 'raw',
                                'markdown' => true,
                                'content'  => file_get_contents( dirname( __FILE__ ) . '/../README.md' )
                            ),
                        ),
                    );
                }

                $this->sections[] = array(
                    'title'  => __( 'Import / Export', 'redux-framework-demo' ),
                    'desc'   => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework-demo' ),
                    'icon'   => 'el-icon-refresh',
                    'fields' => array(
                        array(
                            'id'         => 'opt-import-export',
                            'type'       => 'import_export',
                            'title'      => 'Import Export',
                            'subtitle'   => 'Save and restore your Redux options',
                            'full_width' => false,
                        ),
                    ),
                );

                $this->sections[] = array(
                    'type' => 'divide',
                );

                $this->sections[] = array(
                    'icon'   => 'el-icon-info-sign',
                    'title'  => __( 'Theme Information', 'redux-framework-demo' ),
                    'desc'   => __( '<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework-demo' ),
                    'fields' => array(
                        array(
                            'id'      => 'opt-raw-info',
                            'type'    => 'raw',
                            'content' => $item_info,
                        )
                    ),
                );

                if ( file_exists( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) ) {
                    $tabs['docs'] = array(
                        'icon'    => 'el-icon-book',
                        'title'   => __( 'Documentation', 'redux-framework-demo' ),
                        'content' => nl2br( file_get_contents( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) )
                    );
                }
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
                    'opt_name'             => 'theme_data',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'LARX', 'redux-framework-demo' ),
                    'page_title'           => __( 'LARX', 'redux-framework-demo' ),
                    // You will need to generate a Google API key to use this feature.
                    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                    'google_api_key'       => '',
                    // Set it you want google fonts to update weekly. A google_api_key value is required.
                    'google_update_weekly' => false,
                    // Must be defined to add google fonts to the typography module
                    'async_typography'     => true,
                    // Use a asynchronous font on the front end or font string
                    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                    'admin_bar'            => true,
                    // Show the panel pages on the admin bar
                    'admin_bar_icon'     => 'dashicons-portfolio',
                    // Choose an icon for the admin bar menu
                    'admin_bar_priority' => 50,
                    // Choose an priority for the admin bar menu
                    'global_variable'      => 'th_theme_data',
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

                // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
/*                 $this->args['admin_bar_links'][] = array(
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
                ); */

                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    $this->args['intro_text'] = sprintf( __( '<p></p>', 'redux-framework-demo' ), $v );
                } else {
                    $this->args['intro_text'] = __( '<p></p>', 'redux-framework-demo' );
                }

                // Add content after the form.
                $this->args['footer_text'] = __( '<p></p>', 'redux-framework-demo' );
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

        global $reduxConfig;
        $reduxConfig = new Redux_Framework_sample_config();
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
