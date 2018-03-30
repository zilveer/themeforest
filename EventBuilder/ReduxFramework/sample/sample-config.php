<?php

    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: https://docs.reduxframework.com
     * */

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
                                     alt="<?php esc_attr_e( 'Current theme preview' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview' ); ?>"/>
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
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'redux-framework-demo' ), $this->theme->parent()->display( 'Name' ) );
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

                $this->sections[] = array(
                    'icon'   => 'el-icon-cogs',
                    'title'  => __( 'General Settings', 'redux-framework-demo' ),
                    'fields' => array(
                        array(
                            'id'=>'header_type',
                            'type' => 'radio',
                            'title' => __('Header type', 'redux-framework-demo'), 
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'options' => array('1' => 'Type 1'),//Must provide key => value pairs for radio options
                            'default' => '1'
                            ),
                        array(
                            'id'=>'hide_login',
                            'type' => 'radio',
                            'title' => __('Show/Hide login section', 'redux-framework-demo'), 
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'options' => array('1' => 'Show','2' => 'Hide'),//Must provide key => value pairs for radio options
                            'default' => '1'
                            ),
                        array(
                            'id'       => 'hide-sidebar-menu',
                            'type'     => 'radio',
                            'title'    => __('Hide sidebar menu', 'redux-framework-demo'), 
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc'     => __('', 'redux-framework-demo'),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                    '1' => 'Visible', 
                                    '2' => 'Hidden',
                                ),
                            'default' => '2'
                            ),
                        array(
                            'id'=>'title-image-bg',
                            'type' => 'media',
                            'url'=> true,
                            'title' => __('Default title image background', 'redux-framework-demo'),
                            'compiler' => 'true',
                            //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc'=> __('Upload your image.', 'redux-framework-demo'),
                            'subtitle' => __('Minimum width 1400px.', 'redux-framework-demo'),
                            'default' => '',
                        ),
                        array(
                            'id'=>'event-approve-message',
                            'type' => 'textarea',
                            'title' => __('Custom Event Approve Message', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('Add here the event approve message the user will get in email.', 'redux-framework-demo'),
                            'default' => 'Congratulations! Your event has beed approved.'
                        ),
                        array(
                            'id'=>'event-reject-message',
                            'type' => 'textarea',
                            'title' => __('Custom Event Reject Message', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('Add here the event reject text the user will get in email.', 'redux-framework-demo'),
                            'default' => 'Your event has been rejected.'
                        ),
                        array(
                            'id'=>'delete-elements-state',
                            'type' => 'radio',
                            'title' => __('Delete elements state', 'redux-framework-demo'), 
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'options' => array('1' => 'Update as Past', '2' => 'Delete', '3' => 'Update the date (only for demo)'),//Must provide key => value pairs for radio options
                            'default' => '1'
                            ),
                        array(
                            'id'=>'measure-system',
                            'type' => 'radio',
                            'title' => __('Measurement system', 'redux-framework-demo'), 
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'options' => array('1' => 'Miles', '2' => 'Kilometers'),//Must provide key => value pairs for radio options
                            'default' => '2'
                            ),
                        array(
                            'id'=>'max_range',
                            'type' => 'text',
                            'title' => __('Maxim Range', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('You can add the max geolocation range (default: 1000', 'redux-framework-demo'),
                            'default' => '1000'
                            ),
                        array(
                            'id'       => 'opt-ace-editor-css',
                            'type'     => 'ace_editor',
                            'title'    => __( 'CSS Code', 'redux-framework-demo' ),
                            'subtitle' => __( 'Paste your CSS code here.', 'redux-framework-demo' ),
                            'mode'     => 'css',
                            'theme'    => 'monokai',
                            'desc'     => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                            'default'  => ""
                        ),
                        array(
                            'id'=>'map-style',
                            'type' => 'textarea',
                            'title' => __('Map Styles', 'redux-framework-demo'), 
                            'subtitle' => __('Check <a href="http://snazzymaps.com/" target="_blank">snazzymaps.com</a> for a list of nice google map styles.', 'redux-framework-demo'),
                            'desc' => __('Ad here your google map style.', 'redux-framework-demo'),
                            'validate' => 'html_custom',
                            'default' => '',
                            'allowed_html' => array(
                                'a' => array(
                                    'href' => array(),
                                    'title' => array()
                                ),
                                'br' => array(),
                                'em' => array(),
                                'strong' => array()
                            )
                        ),
                        /*
                    array(
                        'id'        => 'opt-ace-editor-js',
                        'type'      => 'ace_editor',
                        'title'     => __('JS Code', 'redux-framework-demo'),
                        'subtitle'  => __('Paste your JS code here.', 'redux-framework-demo'),
                        'mode'      => 'javascript',
                        'theme'     => 'chrome',
                        'desc'      => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        'default'   => "jQuery(document).ready(function(){\n\n});"
                    ),
                    array(
                        'id'        => 'opt-ace-editor-php',
                        'type'      => 'ace_editor',
                        'title'     => __('PHP Code', 'redux-framework-demo'),
                        'subtitle'  => __('Paste your PHP code here.', 'redux-framework-demo'),
                        'mode'      => 'php',
                        'theme'     => 'chrome',
                        'desc'      => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        'default'   => '<?php\nisset ( $redux ) ? true : false;\n?>'
                    ),
                    */
                        array(
                            'id'=>'footer-copyright',
                            'type' => 'textarea',
                            'title' => __('Footer Copyright Text', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('You can add text and HTML in here.', 'redux-framework-demo'),
                            'default' => 'Developed by <a href="http://themeforest.net/user/themes-dojo">Alex Gurghis</a>. Designed by <a href="http://themeforest.net/user/themes-dojo">Radu Trifan</a>.'
                        )
                    )
                );

                $this->sections[] = array(
                    'icon'   => 'el-icon-star-alt',
                    'title'  => __( 'Logo', 'redux-framework-demo' ),
                    'fields' => array(
                        array(
                            'id'       => 'logo-type',
                            'type'     => 'switch',
                            'title'    => __( 'Select Logo Type', 'redux-framework-demo' ),
                            'subtitle' => __( '', 'redux-framework-demo' ),
                            'default'  => 1,
                            'on'       => 'Text',
                            'off'      => 'Image',
                        ),
                        array(
                            'id'=>'logo-text-icon',
                            'type' => 'text',
                            'required' => array( 'logo-type', '=', '1' ),
                            'title' => __('Logo Icon Code', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('Add here the code for text logo icon ex: fa-map-marker (from fontawesome: http://fontawesome.io/icons/)', 'redux-framework-demo'),
                            'default' => ''
                        ),
                        array(
                            'id'       => 'logo-text-icon-color',
                            'type'     => 'color',
                            'required' => array( 'logo-type', '=', '1' ),
                            'output'   => array( '.navbar-brand span' ),
                            'title'    => __( 'Logo Icon Color', 'redux-framework-demo' ),
                            'subtitle' => __( '', 'redux-framework-demo' ),
                            'desc' => __('Pick a color for logo icon (default: #0097a7).', 'redux-framework-demo'),
                            'default'  => '#0097a7',
                            'validate' => 'color',
                            'transparent' => false,
                        ),
                        array(
                            'id'=>'logo-text-text',
                            'type' => 'text',
                            'required' => array( 'logo-type', '=', '1' ),
                            'title' => __('Logo Text', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('Add here the logo text', 'redux-framework-demo'),
                            'default' => 'EventBuilder'
                        ),
                        array(
                            'id'       => 'logo-text-text-font',
                            'type' => 'typography',
                            'required' => array( 'logo-type', '=', '1' ),
                            'title' => __('Text Logo Font', 'redux-framework-demo'),
                            'subtitle' => __('Specify the logo font.', 'redux-framework-demo'),
                            'google' => true,
                            'units' => 'px',
                            'text-align' => false,
                            'output' => array('.navbar-brand'),
                            'default' => array(
                                'color' => '#0097a7',
                                'font-size' => '18px',
                                'font-family' => 'Robot',
                                'font-weight' => '400',
                                'line-height' => '28px',
                            ),
                        ),
                        array(
                            'id'=>'logo-image',
                            'type' => 'media',
                            'required' => array( 'logo-type', '=', '0' ), 
                            'url'=> true,
                            'title' => __('Logo Image', 'redux-framework-demo'),
                            'compiler' => 'true',
                            //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc'=> __('Upload your logo.', 'redux-framework-demo'),
                            'subtitle' => __('Maximum height 34px.', 'redux-framework-demo'),
                            'default' => '',
                        ),
                        array(
                            'id'=>'favicon-image',
                            'type' => 'media', 
                            'url'=> true,
                            'title' => __('Favicon Image', 'redux-framework-demo'),
                            'compiler' => 'true',
                            //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc'=> __('Upload your favicon.', 'redux-framework-demo'),
                            'default' => '',
                        )
                    )
                );

                $this->sections[] = array(
                    'icon'   => 'el-icon-adjust',
                    'title'  => __( 'Colors & Fonts', 'redux-framework-demo' ),
                    'fields' => array(

                        array(
                            'id'       => 'main-color',
                            'type'     => 'color',
                            'title'    => __('Main Color', 'redux-framework-demo'), 
                            'subtitle' => __('Pick main color (default: #2ecc71).', 'redux-framework-demo'),
                            'default'  => '#2ecc71',
                            'validate' => 'color',
                            'transparent' => false,
                        ),

                        array(
                            'id'       => 'main-color-hover',
                            'type'     => 'color',
                            'title'    => __('Main Color Hover', 'redux-framework-demo'), 
                            'subtitle' => __('Pick main color hover (default: #27ae60).', 'redux-framework-demo'),
                            'default'  => '#27ae60',
                            'validate' => 'color',
                            'transparent' => false,
                        ),

                        array(
                            'id' => 'h1-text',
                            'type' => 'typography',
                            'title' => __('H1 Font', 'redux-framework-demo'),
                            'subtitle' => __('Specify the headings font properties.', 'redux-framework-demo'),
                            'google' => true,
                            'output' => array('h1'),
                            'default' => array(
                                'color' => '#484848',
                                'font-size' => '56px',
                                'font-family' => 'PT Sans',
                                'font-weight' => '300',
                                'line-height' => '72px',
                            ),
                        ),

                        array(
                            'id' => 'h2-text',
                            'type' => 'typography',
                            'title' => __('H2 Font', 'redux-framework-demo'),
                            'subtitle' => __('Specify the headings font properties.', 'redux-framework-demo'),
                            'google' => true,
                            'output' => array('h2'),
                            'default' => array(
                                'color' => '#484848',
                                'font-size' => '48px',
                                'font-family' => 'PT Sans',
                                'font-weight' => '300',
                                'line-height' => '64px',
                            ),
                        ),

                        array(
                            'id' => 'h3-text',
                            'type' => 'typography',
                            'title' => __('H3 Font', 'redux-framework-demo'),
                            'subtitle' => __('Specify the headings font properties.', 'redux-framework-demo'),
                            'google' => true,
                            'output' => array('h3'),
                            'default' => array(
                                'color' => '#484848',
                                'font-size' => '40px',
                                'font-family' => 'PT Sans',
                                'font-weight' => '300',
                                'line-height' => '56px',
                            ),
                        ),

                        array(
                            'id' => 'h4-text',
                            'type' => 'typography',
                            'title' => __('H4 Font', 'redux-framework-demo'),
                            'subtitle' => __('Specify the headings font properties.', 'redux-framework-demo'),
                            'google' => true,
                            'output' => array('h4'),
                            'default' => array(
                                'color' => '#484848',
                                'font-size' => '32px',
                                'font-family' => 'PT Sans',
                                'font-weight' => '300',
                                'line-height' => '48px',
                            ),
                        ),

                        array(
                            'id' => 'h5-text',
                            'type' => 'typography',
                            'title' => __('H5 Font', 'redux-framework-demo'),
                            'subtitle' => __('Specify the headings font properties.', 'redux-framework-demo'),
                            'google' => true,
                            'output' => array('h5'),
                            'default' => array(
                                'color' => '#484848',
                                'font-size' => '24px',
                                'font-family' => 'PT Sans',
                                'font-weight' => '300',
                                'line-height' => '40px',
                            ),
                        ),

                        array(
                            'id' => 'h6-text',
                            'type' => 'typography',
                            'title' => __('H6 Font', 'redux-framework-demo'),
                            'subtitle' => __('Specify the headings font properties.', 'redux-framework-demo'),
                            'google' => true,
                            'output' => array('h6'),
                            'default' => array(
                                'color' => '#484848',
                                'font-size' => '16px',
                                'font-family' => 'PT Sans',
                                'font-weight' => '300',
                                'line-height' => '32px',
                            ),
                        ),

                        array(
                            'id' => 'p-text',
                            'type' => 'typography',
                            'title' => __('Body Font', 'redux-framework-demo'),
                            'subtitle' => __('Specify the headings font properties.', 'redux-framework-demo'),
                            'google' => true,
                            'output' => array('body, p'),
                            'default' => array(
                                'color' => '#999999',
                                'font-size' => '14px',
                                'font-family' => 'Montserrat',
                                'font-weight' => '400',
                                'line-height' => '24px',
                            ),
                        )

                    )
                );

                $this->sections[] = array(
                    'icon' => 'el-icon-file-edit',
                    'title' => __('Pages', 'redux-framework-demo'),
                    'fields' => array(

                        array(
                            'id'=>'page-url-price-plans',
                            'type' => 'select',
                            'data' => 'pages',
                            'multi' => false,
                            'title' => __('Pricing plans', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => ''
                        ),

                        array(
                            'id'=>'page-url-terms',
                            'type' => 'select',
                            'data' => 'pages',
                            'multi' => false,
                            'title' => __('Terms & conditions', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => ''
                        ),

                        array(
                            'id'=>'page-url-my-account',
                            'type' => 'select',
                            'data' => 'pages',
                            'multi' => false,
                            'title' => __('My account', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => ''
                        ),

                        array(
                            'id'=>'page-url-all-events',
                            'type' => 'select',
                            'data' => 'pages',
                            'multi' => false,
                            'title' => __('All Events', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => ''
                        ),

                        array(
                            'id'=>'page-url-upload-event',
                            'type' => 'select',
                            'data' => 'pages',
                            'multi' => false,
                            'title' => __('Upload event', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => ''
                        ),

                        array(
                            'id'=>'page-url-edit-event',
                            'type' => 'select',
                            'data' => 'pages',
                            'multi' => false,
                            'title' => __('Edit event', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => ''
                        ),

                        array(
                            'id'       => 'menu-upload-event',
                            'type'     => 'switch',
                            'required' => array( 'page-url-upload-event', '!=', '' ),
                            'title'    => __( 'Show "Add Event" button on menu (big button)', 'redux-framework-demo' ),
                            'subtitle' => __( '', 'redux-framework-demo' ),
                            'default'  => 'off',
                            'on'       => 'on',
                            'off'      => 'off',
                        ),

                    ),
                );

                $this->sections[] = array(
                    'icon'   => 'el-icon-file-edit',
                    'title'  => __( 'Advertising Spaces', 'redux-framework-demo' ),
                    'fields' => array(

                        array(
                        'id'=>'ads-event-sidebar',
                        'type' => 'textarea',
                        'title' => __('Event Sidebar (300 x 250)', 'redux-framework-demo'),
                        'subtitle' => __('', 'redux-framework-demo'),
                        'desc' => __('', 'redux-framework-demo'),
                        'default' => ''
                        ),

                    )
                );

                $this->sections[] = array(
                    'icon'   => 'el-icon-usd',
                    'title'  => __( 'Payment Settings', 'redux-framework-demo' ),
                    'fields' => array(
                        array(
                        'id'=>'currency-code',
                        'type' => 'text',
                        'title' => __('Currency Code', 'redux-framework-demo'),
                        'subtitle' => __('', 'redux-framework-demo'),
                        'desc' => __('Ex: USD for dollar.', 'redux-framework-demo'),
                        'default' => 'USD'
                        ),

                        array(
                        'id'=>'currency-symbol',
                        'type' => 'text',
                        'title' => __('Currency Symbol', 'redux-framework-demo'),
                        'subtitle' => __('', 'redux-framework-demo'),
                        'desc' => __('Ex: $ for dollar (USD).', 'redux-framework-demo'),
                        'default' => '$'
                        ),
                    )
                );

                $this->sections[] = array(
                    'icon' => 'el-icon-usd',
                    'title' => __('Stripe settings', 'redux-framework-demo'),
                    'fields' => array(

                        array(
                            'id'       => 'payment-activate-stripe',
                            'type'     => 'switch',
                            'title'    => __( 'Activate Stripe', 'redux-framework-demo' ),
                            'subtitle' => __( '', 'redux-framework-demo' ),
                            'default'  => 'off',
                            'on'       => 'On',
                            'off'      => 'Off',
                        ),

                        array(
                            'id'       => 'stripe-state',
                            'type'     => 'radio',
                            'required' => array( 'payment-activate-stripe', '=', '1' ),
                            'title'    => __('Stripe Test Mode', 'redux-framework-demo'), 
                            'subtitle' => __('Place Stripe in Test mode using your test API keys.', 'redux-framework-demo'),
                            'desc'     => __('Place Stripe in Test mode using your test API keys.', 'redux-framework-demo'),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                    '1' => 'Live', 
                                    '2' => 'Test'
                                ),
                            'default' => '2'
                            ),

                        array(
                            'id'=>'stripe-test-secret-key',
                            'type' => 'text',
                            'required' => array( 'payment-activate-stripe', '=', '1' ),
                            'title' => __('Test Secret Key', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('Enter your test secret key, found in your Stripe account settings.', 'redux-framework-demo'),
                            'default' => ''
                            ),

                        array(
                            'id'=>'stripe-test-publishable-key',
                            'type' => 'text',
                            'required' => array( 'payment-activate-stripe', '=', '1' ),
                            'title' => __('Test Publishable Key', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('Enter your test publishable key, found in your Stripe account settings.', 'redux-framework-demo'),
                            'default' => ''
                            ),

                        array(
                            'id'=>'stripe-live-secret-key',
                            'type' => 'text',
                            'required' => array( 'payment-activate-stripe', '=', '1' ),
                            'title' => __('Live Secret Key', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('Enter your live secret key, found in your Stripe account settings.', 'redux-framework-demo'),
                            'default' => ''
                            ),

                        array(
                            'id'=>'stripe-live-publishable-key',
                            'type' => 'text',
                            'required' => array( 'payment-activate-stripe', '=', '1' ),
                            'title' => __('Live Publishable Key', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('Enter your live publishable key, found in your Stripe account settings.', 'redux-framework-demo'),
                            'default' => ''
                            ),

                        ),
                );

                $this->sections[] = array(
                    'icon' => 'el-icon-usd',
                    'title' => __('Paypal settings', 'redux-framework-demo'),
                    'fields' => array(

                        array(
                            'id'       => 'payment-activate-paypal',
                            'type'     => 'switch',
                            'title'    => __( 'Activate Paypal', 'redux-framework-demo' ),
                            'subtitle' => __( '', 'redux-framework-demo' ),
                            'default'  => 'off',
                            'on'       => 'On',
                            'off'      => 'Off',
                        ),

                        array(
                            'id'=>'paypal_api_environment',
                            'type' => 'radio',
                            'required' => array( 'payment-activate-paypal', '=', '1' ),
                            'title' => __('PayPal environment', 'redux-framework-demo'), 
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'options' => array('1' => 'Sandbox - Testing', '2' => 'Live - Production'),//Must provide key => value pairs for radio options
                            'default' => '1'
                            ),
                        
                        array(
                            'id'=>'paypal_api_username',
                            'type' => 'text',
                            'required' => array( 'payment-activate-paypal', '=', '1' ),
                            'title' => __('API Username (required)', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => ''
                            ),  

                        array(
                            'id'=>'paypal_api_password',
                            'type' => 'text',
                            'required' => array( 'payment-activate-paypal', '=', '1' ),
                            'title' => __('API Password (required)', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => ''
                            ),

                        array(
                            'id'=>'paypal_api_signature',
                            'type' => 'text',
                            'required' => array( 'payment-activate-paypal', '=', '1' ),
                            'title' => __('API Signature (required)', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => ''
                            ),

                        array(
                            'id'=>'paypal_success',
                            'type' => 'text',
                            'required' => array( 'payment-activate-paypal', '=', '1' ),
                            'title' => __('Thank you page - after successful payment', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        array(
                            'id'=>'paypal_fail',
                            'type' => 'text',
                            'required' => array( 'payment-activate-paypal', '=', '1' ),
                            'title' => __('Thank you page - after failed payment', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        ),
                );

                $this->sections[] = array(
                    'icon' => 'el-icon-file-edit',
                    'title' => __('Contact Event Owner', 'redux-framework-demo'),
                    'fields' => array(

                        array(
                            'id'       => 'contact-owner-state',
                            'type'     => 'radio',
                            'title'    => __('Contact Owner Form', 'redux-framework-demo'), 
                            'subtitle' => __('Select the contact owner form', 'redux-framework-demo'),
                            'desc'     => __('', 'redux-framework-demo'),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                    '1' => 'Default', 
                                    '2' => 'Contact Form 7',
                                    '3' => 'Gravity Forms',
                                    '4' => 'Ninja Forms'
                                ),
                            'default' => '1'
                            ),

                        array(
                                'id'=>'contact-owner-contact-form-7',
                                'type' => 'textarea',
                                'required' => array( 'contact-owner-state', '=', '2' ),
                                'title' => __('Contact Form 7', 'redux-framework-demo'),
                                'subtitle' => __('', 'redux-framework-demo'),
                                'desc' => __('Add here the shortcode for contact form 7.', 'redux-framework-demo'),
                                'default' => ''
                            ),

                        array(
                                'id'=>'contact-owner-gravity-forms',
                                'type' => 'text',
                                'required' => array( 'contact-owner-state', '=', '3' ),
                                'title' => __('Gravity Form ID', 'redux-framework-demo'),
                                'subtitle' => __('', 'redux-framework-demo'),
                                'desc' => __('Add here the form ID.', 'redux-framework-demo'),
                                'default' => ''
                            ),

                        array(
                                'id'=>'contact-owner-ninja-forms',
                                'type' => 'textarea',
                                'required' => array( 'contact-owner-state', '=', '4' ),
                                'title' => __('Ninja Forms', 'redux-framework-demo'),
                                'subtitle' => __('', 'redux-framework-demo'),
                                'desc' => __('Add here the shortcode for ninja forms.', 'redux-framework-demo'),
                                'default' => ''
                            ),

                        ),
                );

                $this->sections[] = array(
                    'icon' => 'el-icon-glass',
                    'title' => __('Events Settings', 'redux-framework-demo'),
                    'fields' => array(

                        array(
                            'id'       => 'events-review',
                            'type'     => 'radio',
                            'title'    => __('Review uploaded events', 'redux-framework-demo'), 
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc'     => __('', 'redux-framework-demo'),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                    '1' => 'No', 
                                    '2' => 'Yes',
                                ),
                            'default' => '1'
                            ),

                        array(
                            'id'       => 'events-date-format',
                            'type'     => 'radio',
                            'title'    => __('Event date format', 'redux-framework-demo'), 
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc'     => __('', 'redux-framework-demo'),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                    '1' => 'm/d/Y', 
                                    '2' => 'd/m/Y',
                                ),
                            'default' => '1'
                            ),

                        array(
                            'id'       => 'events-time-format',
                            'type'     => 'radio',
                            'title'    => __('Event time format', 'redux-framework-demo'), 
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc'     => __('', 'redux-framework-demo'),
                            //Must provide key => value pairs for radio options
                            'options'  => array(
                                    '1' => '12 Hours', 
                                    '2' => '24 Hours',
                                ),
                            'default' => '1'
                            ),

                        ),
                );


                $this->sections[] = array(
                    'icon' => 'el-icon-envelope',
                    'title' => __('Contact Page', 'redux-framework-demo'),
                    'fields' => array(
                        
                        array(
                            'id'=>'contact-email',
                            'type' => 'text',
                            'title' => __('Your email address', 'redux-framework-demo'),
                            'subtitle' => __('This must be an email address.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'email',
                            'default' => ''
                            ),

                        array(
                            'id'=>'contact-thankyou-message',
                            'type' => 'text',
                            'title' => __('Thank you message', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => 'Thank you! We will get back to you as soon as possible.'
                            ),

                        array(
                            'id'=>'contact-latitude',
                            'type' => 'text',
                            'title' => __('Latitude', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => ''
                            ),

                        array(
                            'id'=>'contact-longitude',
                            'type' => 'text',
                            'title' => __('Longitude', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => ''
                            ),

                        array(
                            'id'=>'contact-zoom',
                            'type' => 'text',
                            'title' => __('Zoom level', 'redux-framework-demo'),
                            'subtitle' => __('', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'default' => ''
                            ),

                        array(
                            'id'=>'map-pin',
                            'type' => 'media', 
                            'url'=> true,
                            'title' => __('Map pin', 'redux-framework-demo'),
                            'compiler' => 'true',
                            //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc'=> __('Upload your map pin.', 'redux-framework-demo'),
                            'default' => '',
                            )

                        ),
                ); 

                $this->sections[] = array(
                    'icon' => 'el-icon-group',
                    'title' => __('Top Social Links', 'redux-framework-demo'),
                    'fields' => array(
                        
                        array(
                            'id'=>'facebook-link',
                            'type' => 'text',
                            'title' => __('Facebook Page URL', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        array(
                            'id'=>'twitter-link',
                            'type' => 'text',
                            'title' => __('Twitter Page URL', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        array(
                            'id'=>'dribbble-link',
                            'type' => 'text',
                            'title' => __('Dribbble Page URL', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        array(
                            'id'=>'flickr-link',
                            'type' => 'text',
                            'title' => __('Flickr Page URL', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        array(
                            'id'=>'github-link',
                            'type' => 'text',
                            'title' => __('Github Page URL', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        array(
                            'id'=>'pinterest-link',
                            'type' => 'text',
                            'title' => __('Pinterest Page URL', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        array(
                            'id'=>'youtube-link',
                            'type' => 'text',
                            'title' => __('Youtube Page URL', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        array(
                            'id'=>'google-plus-link',
                            'type' => 'text',
                            'title' => __('Google+ Page URL', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        array(
                            'id'=>'linkedin-link',
                            'type' => 'text',
                            'title' => __('LinkedIn Page URL', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        array(
                            'id'=>'tumblr-link',
                            'type' => 'text',
                            'title' => __('Tumblr Page URL', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        array(
                            'id'=>'vimeo-link',
                            'type' => 'text',
                            'title' => __('Vimeo Page URL', 'redux-framework-demo'),
                            'subtitle' => __('This must be an URL.', 'redux-framework-demo'),
                            'desc' => __('', 'redux-framework-demo'),
                            'validate' => 'url',
                            'default' => ''
                            ),

                        ),
                ); 

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
                    'opt_name'             => 'redux_demo',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'DB Settings', 'redux-framework-demo' ),
                    'page_title'           => __( 'DB Settings', 'redux-framework-demo' ),
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
                    'global_variable'      => '',
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
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    $this->args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
                } else {
                    $this->args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
                }

                // Add content after the form.
                $this->args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );
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
