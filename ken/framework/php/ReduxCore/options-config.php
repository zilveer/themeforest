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
                $this->sections[] = array(
                    'title'  => __( 'Section via hook', 'mk_framework' ),
                    'desc'   => __( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'mk_framework' ),
                    'icon'   => 'el el-paper-clip',
                    // Leave this as a blank section, no options just some intro text set above.
                    'fields' => array()
                );

                return $sections;
            }

            /**
             * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
             * */
            function change_arguments( $args ) {
                $args['dev_mode'] = false;

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

                $customize_title = sprintf( __( 'Customize &#8220;%s&#8221;', 'mk_framework' ), $this->theme->display( 'Name' ) );

                ?>
                <div id="current-theme" class="<?php echo esc_attr( $class ); ?>">
                    <?php if ( $screenshot ) : ?>
                        <?php if ( current_user_can( 'edit_theme_options' ) ) : ?>
                            <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize"
                               title="<?php echo esc_attr( $customize_title ); ?>">
                                <img src="<?php echo esc_url( $screenshot ); ?>"
                                     alt="<?php esc_attr_e( 'Current theme preview', 'mk_framework' ); ?>"/>
                            </a>
                        <?php endif; ?>
                        <img class="hide-if-customize" src="<?php echo esc_url( $screenshot ); ?>"
                             alt="<?php esc_attr_e( 'Current theme preview', 'mk_framework' ); ?>"/>
                    <?php endif; ?>

                    <h4><?php echo $this->theme->display( 'Name' ); ?></h4>

                    <div>
                        <ul class="theme-info">
                            <li><?php printf( __( 'By %s', 'mk_framework' ), $this->theme->display( 'Author' ) ); ?></li>
                            <li><?php printf( __( 'Version %s', 'mk_framework' ), $this->theme->display( 'Version' ) ); ?></li>
                            <li><?php echo '<strong>' . __( 'Tags', 'mk_framework' ) . ':</strong> '; ?><?php printf( $this->theme->display( 'Tags' ) ); ?></li>
                        </ul>
                        <p class="theme-description"><?php echo $this->theme->display( 'Description' ); ?></p>
                        <?php
                            if ( $this->theme->parent() ) {
                                printf( ' <p class="howto">' . __( 'This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'mk_framework' ) . '</p>', __( 'http://codex.wordpress.org/Child_Themes', 'mk_framework' ), $this->theme->parent()->display( 'Name' ) );
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
		'title' => __('General Settings', 'mk_framework'),
		'desc' => __('', 'mk_framework'),
		'icon' => 'el-icon-globe-alt',
		// 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields' => array(

			array(
				'id' => 'favicon',
				'type' => 'media',
				'url' => true,
				'title' => __('Upload Favicon', 'mk_framework'),
				'mode' => false,
				'desc' => __('Using this option, You can upload your own custom favicon. This size should be 16X16 but if you want to support retina devices upload 32X32 png file.', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => false,
			),
			array(
				'id' => 'logo',
				'type' => 'media',
				'url' => true,
				'title' => __('Upload Logo', 'mk_framework'),
				'mode' => false,
				'desc' => __('', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => false,
			),

			array(
				'id' => 'logo-retina',
				'type' => 'media',
				'url' => true,
				'title' => __('Upload Retina Logo', 'mk_framework'),
				'mode' => false,
				'desc' => __('Please note that the image you are uploading should be exactly 2x size of the original logo you have uploaded in above option.', 'mk_framework'),
				'subtitle' => __('Use this option if you want your logo appear crystal clean in retina devices(eg. macbook retina, ipad, iphone).', 'mk_framework'),
				'default' => false,
			),

			array(
				'id' => 'logo-light',
				'type' => 'media',
				'url' => true,
				'title' => __('Upload Light Logo', 'mk_framework'),
				'mode' => false,
				'desc' => __('', 'mk_framework'),
				'subtitle' => __('This option will only be used if you have a transparent header in a page that you have chosen light skin for header elements.', 'mk_framework'),
				'default' => false,
			),

			array(
				'id' => 'logo-light-retina',
				'type' => 'media',
				'url' => true,
				'title' => __('Upload Retina Light Logo', 'mk_framework'),
				'mode' => false,
				'desc' => __('This option is for transparent header style logo in light skin. Please note that the image you are uploading should be exactly 2x size of the original logo you have uploaded in above option.', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => false,
			),

			array(
				'id' => 'preloader-logo',
				'type' => 'media',
				'url' => true,
				'title' => __('Pre-loader Overlay Logo', 'mk_framework'),
				'mode' => false,
				'desc' => __('This logo will be viewed in the pre-loader overlay. This overlay can be enabled form page meta option and mostly used for heavy pages with alot of content and images.', 'mk_framework'),
				'subtitle' => __('Image size is up to you.', 'mk_framework'),
				'default' => false,
			),

			array(
				'id' => 'mobile-logo',
				'type' => 'media',
				'url' => true,
				'title' => __('Upload Mobile Logo', 'mk_framework'),
				'mode' => false,
				'subtitle' => __('This option comes handly when your logo is just too long for a mobile device and you would like to upload a shorter and smaller logo just to fit the header area.', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'default' => false,
			),

			array(
				'id' => 'mobile-logo-retina',
				'type' => 'media',
				'url' => true,
				'title' => __('Upload Mobile Retina Logo', 'mk_framework'),
				'mode' => false,
				'desc' => __('Please note that the image you are uploading should be exactly 2x size of the original logo you have uploaded in above option (Upload Mobile Logo).', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => false,
			),

			array(
				'id' => 'res-nav-width',
				'type' => 'slider',
				'title' => __('Main Navigation Responsive Width', 'mk_framework'),
				'subtitle' => __('The width Main navigation converts to responsive mode.', 'mk_framework'),
				'desc' => __('Navigation item can vary from site to site and it totally depends on you to define a the best width Main Navigation convert to responsive mode. you can find the right value by just resizing the window to find the best fit coresponding to navigation items.', 'mk_framework'),
				"default" => "1140",
				"min" => "600",
				"step" => "1",
				"max" => "1380",
			),
			array(
				'id' => 'grid-width',
				'type' => 'slider',
				'title' => __('Main grid Width', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => "1140",
				"min" => "960",
				"step" => "1",
				"max" => "1380",
			),
			array(
				'id' => 'content-width',
				'type' => 'slider',
				'title' => __('Content Width', 'mk_framework'),
				'subtitle' => __('Using this option you can define the width of the content.', 'mk_framework'),
				'desc' => __('please note that this option is in percent, lets say if you set it 60%, sidebar will occupy 40% of the main content space.', 'mk_framework'),
				"default" => "70",
				"min" => "50",
				"step" => "1",
				"max" => "80",
			),
			array(
				'id' => 'side-dashboard',
				'type' => 'switch',
				'title' => __('Side Dashboard', 'mk_framework'),
				'subtitle' => __('The sliding widgetized dashboard section.', 'mk_framework'),
				'desc' => __('If you don\'t want this feature just disable it from this option.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'side-dashboard-icon',
				'type' => 'text',
				'title' => __('Side Dashboard Icon Class Name', 'mk_framework'),
				'desc' => __("This option will give you the ability to add any icon you want to use for side dashboard trigger icon. <a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name.", 'mk_framework'),
				'subtitle' => __("", 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'breadcrumb',
				'type' => 'switch',
				'title' => __('Breadcrumb', 'mk_framework'),
				'subtitle' => __('Breadcrumbs will appear horizontally across the top of all pages below header.', 'mk_framework'),
				'desc' => __('Using this option you can disable breadcrumbs throughout the site.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'smooth-scroll',
				'type' => 'switch',
				'title' => __('Smooth Scroll', 'mk_framework'),
				'subtitle' => __('Adds easing movement in page scroll and modifys browser native scrollbar', 'mk_framework'),
				'desc' => __('If you don\'t want this feature just disable it from this option.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'pages-comments',
				'type' => 'switch',
				'title' => __('Page Comments', 'mk_framework'),
				'subtitle' => __('Option to globally enable/disable comments in pages.', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => 0,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'custom-sidebar',
				'type' => 'multi_text',
				'title' => __('Custom Sidebars', 'mk_framework'),
				'validate' => 'no_special_chars',
				'subtitle' => __('Will create custom widget areas to help you make custom sidebars in pages & posts.', 'mk_framework'),
				'desc' => __('No Special characters please! eg: "contact page 3"', 'mk_framework')
			),
			array(
				'id' => 'typekit-id',
				'type' => 'text',
				'title' => __('Typekit Kit ID', 'mk_framework'),
				'desc' => __("If you want to use typekit in your site simply enter The Type Kit ID you get from Typekit site. <a target='_blank' href='http://help.typekit.com/customer/portal/articles/6840-using-typekit-with-wordpress-com'>Read More</a>", 'mk_framework'),
				'subtitle' => __("", 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'disable-quick-contact',
				'type' => 'switch',
				'title' => __('Quick Contact', 'mk_framework'),
				'subtitle' => __('You can enable or disable Quick Contact Form using this option.', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => 0,
				'on' => 'Enable',
				'off' => 'Disable',
			),
            
            array(
                'id' => 'email-quick-contact',
                'required' => array('disable-quick-contact', 'equals', '1'),
                'type' => 'text',
                'title' => __('Quick Contact Email Address', 'mk_framework'),
                'desc' => __('Email address you want to send emails', 'mk_framework'),
                'subtitle' => __('', 'mk_framework'),
                'default' => get_bloginfo( 'admin_email' ),
            ),

			array(
				'id' => 'skin-quick-contact',
                'required' => array('disable-quick-contact', 'equals', '1'),
				'type' => 'switch',
				'title' => __('Quick Contact Skin', 'mk_framework'),
				'subtitle' => __('You can choose Quick Contact Form skin color.', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => 0,
				'on' => 'Light',
				'off' => 'Dark',
			),
		),
	);

	$this->sections[] = array(
		'title' => __('Header', 'mk_framework'),
		'desc' => __('', 'mk_framework'),
		'icon' => 'el-icon-website',
		// 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields' => array(
			array(
				'id' => 'header-structure',
				'type' => 'button_set',
				'title' => __('Header Structure', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'options' => array('standard' => 'Standard', 'margin' => 'Margin', 'vertical' => 'Vertical'), //Must provide key => value pairs for radio options
				'default' => 'standard',
			),

			array(
				'id' => 'header-location',
				'type' => 'button_set',
				'required' => array('header-structure', 'equals', 'standard'),
				'title' => __('Header Location', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('Whether stay at the top or bottom of the screen.', 'mk_framework'),
				'options' => array('top' => 'Top', 'bottom' => 'Bottom'), //Must provide key => value pairs for radio options
				'default' => 'top'
			),

			array(
				'id' => 'vertical-header-state',
				'type' => 'button_set',
				'required' => array('header-structure', 'equals', 'vertical'),
				'title' => __('Vertical Header State', 'mk_framework'),
				'subtitle' => __('Choose vertical header defaut state.', 'mk_framework'),
				'desc' => __('If condensed header chosen, header will be narrow by default and by clicking burger icon it will be expanded to reveal logo and navigation.', 'mk_framework'),
				'options' => array('condensed' => 'Expandable', 'expanded' => 'Always Open'), //Must provide key => value pairs for radio options
				'default' => 'expanded'
			),
            array(
                'id' => 'vertical-header-align', 
                'type' => 'button_set',
                'title' => __('Vertical Header Align', 'mk_framework'),
                'subtitle' => __('Which side of the page would you like to show vertical header?', 'mk_framework'),
                'desc' => __('', 'mk_framework'),
                'required' => array('header-structure', 'equals', 'vertical'),
                'options' => array('left' => 'Left', 'right' => 'Right'), 
                'default' => 'left',
            ),
			array(
				'id' => 'header-vertical-width',
				'type' => 'slider',
				'required' => array('header-structure', 'equals', 'vertical'),
				'title' => __('Header Vertical Width?', 'mk_framework'),
				'subtitle' => __('Default : 280px', 'mk_framework'),
				'desc' => __('Using this option you can increase or decrease header width.', 'mk_framework'),
				"default" => "280",
				"min" => "200",
				"step" => "1",
				"max" => "500",
			),
			array(
				'id' => 'header-padding',
				'type' => 'slider',
				'title' => __('Header Padding', 'mk_framework'),
				'subtitle' => __('Top & Bottom. default : 30px', 'mk_framework'),
				'desc' => __('Using this option you can increase or decrease header padding from its top and bottom.', 'mk_framework'),
				"default" => "30",
				"min" => "0",
				"step" => "1",
				"max" => "200",
			),
			array(
				'id' => 'header-padding-vertical',
				'type' => 'slider',
				'required' => array('header-structure', 'equals', 'vertical'),
				'title' => __('Header Padding', 'mk_framework'),
				'subtitle' => __('Left & Right. default : 30px', 'mk_framework'),
				'desc' => __('Using this option you can increase or decrease header padding from its top and bottom.', 'mk_framework'),
				"default" => "30",
				"min" => "0",
				"step" => "1",
				"max" => "100",
			),
			array(
				'id' => 'header-align',
				'type' => 'button_set',
				'title' => __('Header Align', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('Please note that this option does not work for vertical header style. Use below option instead', 'mk_framework'),
				'options' => array('left' => 'Left', 'center' => 'Center', 'right' => 'Right'), //Must provide key => value pairs for radio options
				'default' => 'left'
			),
			array(
				'id' => 'nav-alignment', 
				'type' => 'button_set',
				'title' => __('Vertical Header Menu Align', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'options' => array('left' => 'Left', 'center' => 'Center', 'right' => 'Right'), 
				'default' => 'left',
			),
			array(
				'id' => 'boxed-header',
				'type' => 'switch',
				'title' => __('Boxed Header', 'mk_framework'),
				'subtitle' => __('Full screen wide header content or inside main grid?.', 'mk_framework'),
				'desc' => __('If you want the cotent be stretched screen wide, disable this option.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'sticky-header',
				'type' => 'switch',
				'title' => __('Sticky Header', 'mk_framework'),
				'subtitle' => __('Will make header stay in top of browser while scrolling down', 'mk_framework'),
				'desc' => __('If you don\'t want this feature just disable it from this option.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'squeeze-sticky-header',
				'type' => 'switch',
				'title' => __('Squeeze Sticky Header', 'mk_framework'),
				'subtitle' => __('This option to give you the control on whether to squeeze the sticky header or keep it same height as none-sticky.', 'mk_framework'),
				'desc' => __('Disable this option if you dont want this feature.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'header-border-top',
				'type' => 'switch',
				'title' => __('Show Header Border Top?', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'header-search',
				'type' => 'switch',
				'title' => __('Header Search Form', 'mk_framework'),
				'subtitle' => __('Will stay on right hand of main navigation.', 'mk_framework'),
				'desc' => __('If you don\'t want this feature just disable it from this option.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'header-search-location',
				'type' => 'button_set',
				'required' => array(array('header-align', 'equals', 'center'),array('header-search', 'equals', '1')),
				'title' => __('Header Search Location', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'options' => array('left' => 'Left', 'right' => 'Right'), //Must provide key => value pairs for radio options
				'default' => 'right'
			),
			array(
				'id' => 'header-wpml',
				'type' => 'switch',
				'title' => __('Header Wpml Language Selector', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('If you don\'t want this feature just disable it from this option.', 'mk_framework'),
				"default" => 2,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'page-title-pages',
				'type' => 'switch',
				'title' => __('Page Title : Pages', 'mk_framework'),
				'subtitle' => __('This option will affect Pages.', 'mk_framework'),
				'desc' => __('If you don\'t want to show page title section (title, breadcrumb) in Pages disable this option. this option will not affect archive, search, 404, category templates as well as blog and portfolio single posts.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				"title" => __("Main Navigation for Logged In User", "mk_framework"),
				"desc" => __("Please choose the menu location that you would like to show as global main navigation for logged in users. You should first <a target='_blank' href='" . admin_url('nav-menus.php') . "'>create menu</a> and then <a target='_blank' href='" . admin_url('nav-menus.php') . "?action=locations'>assign to menu locations</a>", "mk_framework"),
				"id" => "loggedin_menu",
				"default" => 'primary-menu',
				"options" => array(
					"primary-menu" => __('Primary Navigation', "mk_framework"),
					"second-menu" => __('Second Navigation', "mk_framework"),
					"third-menu" => __('Third Navigation', "mk_framework"),
					"fourth-menu" => __('Fourth Navigation', "mk_framework"),
					"fifth-menu" => __('Fifth Navigation', "mk_framework"),
					"sixth-menu" => __('Sixth Navigation', "mk_framework"),
					"seventh-menu" => __('Seventh Navigation', "mk_framework"),
				),
				"type" => "select"
			),
			array(
				"title" => __("Header Social Networks", "mk_framework"),
				"desc" => __("", "mk_framework"),
				"id" => "header-social-select",
				"default" => 'header-section',
				"options" => array(
					"header_section" => __('Header Section', "mk_framework"),
					"header_toolbar" => __('Header Toolbar', "mk_framework"),
					"disabled" => __('Disabled', "mk_framework")
				),
				"type" => "select"
			),
			array(
				'id' => 'header-toolbar',
				'type' => 'switch',
				'title' => __('Header Toolbar', 'mk_framework'),
				'subtitle' => __('Enable/Disable Header Toolbar', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => 0,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'header-toolbar-phone',
				'type' => 'text',
				'required' => array('header-toolbar', 'equals', '1'),
				'title' => __('Header Toolbar Phone Number', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'header-toolbar-phone-icon',
				'type' => 'text',
				'required' => array('header-toolbar', 'equals', '1'),
				'title' => __('Header Toolbar Phone Icon', 'mk_framework'),
				'desc' => __("This option will give you the ability to add any icon you want to use for front of the phone number. <a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name.", 'mk_framework'),
				'subtitle' => __("", 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'header-toolbar-email',
				'type' => 'text',
				'required' => array('header-toolbar', 'equals', '1'),
				'title' => __('Header Toolbar Email Address', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'header-toolbar-email-icon',
				'type' => 'text',
				'required' => array('header-toolbar', 'equals', '1'),
				'title' => __('Header Toolbar Email Icon', 'mk_framework'),
				'desc' => __("This option will give you the ability to add any icon you want to use for front of the email address. <a target='_blank' href='" . admin_url('admin.php?page=icon-library') . "'>Click here</a> to get the icon class name.", 'mk_framework'),
				'subtitle' => __("", 'mk_framework'),
				'default' => '',
			),
			
			array(
				"title" => __("Header Toolbar Custom Menu", "mk_framework"),
				"desc" => __("", "mk_framework"),
				'required' => array('header-toolbar', 'equals', '1'),
				"id" => "toolbar-custom-menu",
				"default" => '',
				"data" => 'menus',
				"type" => "select"
			),

			array(
				'id' => 'header-social-facebook',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Facebook', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'header-social-twitter',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Twitter', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'header-social-rss',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('RSS', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'header-social-dribbble',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Dribbble', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'header-social-pinterest',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Pinterest', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'header-social-instagram',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Instagram', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'header-social-google-plus',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Google Plus', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'header-social-linkedin',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Linkedin', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'header-social-youtube',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Youtube', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'header-social-vimeo',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Vimeo', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'header-social-spotify',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Spotify', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'header-social-tumblr',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Tumblr', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'header-social-behance',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Behance', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'header-social-WhatsApp',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('WhatsApp', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'header-social-qzone',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('qzone', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'header-social-vkcom',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('vk.com', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'header-social-imdb',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('IMDb', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'header-social-renren',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Renren', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'header-social-weibo',
				'required' => array('header-social-select', 'equals', array( 'header_toolbar', 'header_section' )),
				'type' => 'text',
				'title' => __('Weibo', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Header Social Networks', 'mk_framework'),
				'default' => '',
			)
		),
	);

	$this->sections[] = array(
		'title' => __('Footer', 'mk_framework'),
		'desc' => __('', 'mk_framework'),
		'icon' => 'el-icon-photo',
		// 'submenu' => false, // Setting submenu to false on a given section will hide it from the WordPress sidebar menu!
		'fields' => array(

			array(
				'id' => 'footer',
				'type' => 'switch',
				'title' => __('Footer', 'mk_framework'),
				'subtitle' => __('Will be located after content. Please note that sub footer will not be affected by this option.', 'mk_framework'),
				'desc' => __('If you don\'t want to have footer section you can disable it.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
            array(
                'id' => 'footer-type',
                'type' => 'button_set',
                'title' => __('Footer Type', 'mk_framework'),
                'subtitle' => __('', 'mk_framework'),
                'desc' => __('', 'mk_framework'),
                'options' => array('regular' => 'Regular', 'fixed' => 'Fixed'),
                'default' => 'regular',
            ),
			array(
				'id' => 'footer-layout',
				'required' => array('footer', 'equals', '1'),
				'type' => 'image_select',
				'title' => __('Footer Widget Area Columns', 'mk_framework'),
				'subtitle' => __('Defines in which strcuture footer widget areas would be divided', 'mk_framework'),
				'desc' => __('Please choose your footer widget area column strucutre.', 'mk_framework'),
				'options' => array(
					'1' => array('alt' => '1 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_1.png'),
					'2' => array('alt' => '2 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_2.png'),
					'3' => array('alt' => '3 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_3.png'),
					'4' => array('alt' => '4 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_4.png'),
					'5' => array('alt' => '5 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_5.png'),
					'6' => array('alt' => '6 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_6.png'),
					'half_sub_half' => array('alt' => 'Half Sub Half Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_half_sub_half.png'),
					'half_sub_third' => array('alt' => 'Half Sub Third Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_half_sub_third.png'),
					'third_sub_third' => array('alt' => 'Third Sub Third Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_third_sub_third.png'),
					'third_sub_fourth' => array('alt' => 'Third Sub Fourth Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_third_sub_fourth.png'),
					'sub_half_half' => array('alt' => 'Sub Half Half Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_sub_half_half.png'),
					'sub_third_half' => array('alt' => 'Sub Third Half Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_sub_third_half.png'),
					'sub_third_third' => array('alt' => 'Sub Third Third Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_sub_third_third.png'),
					'sub_fourth_third' => array('alt' => 'Sub Fourth Third Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/column_sub_fourth_third.png'),

				),
				'default' => '4'
			),

			array(
				'id' => 'sub-footer',
				'type' => 'switch',
				'title' => __('Sub Footer', 'mk_framework'),
				'subtitle' => __('Locates below footer.', 'mk_framework'),
				'desc' => __('If you don\'t want to have sub footer section you can disable it.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'footer-copyright',
				'type' => 'textarea',
				'required' => array('sub-footer', 'equals', '1'),
				'title' => __('Sub Footer Copyright text', 'mk_framework'),
				'subtitle' => __('You may write your site copyright information.', 'mk_framework'),
				'desc' => '',
				'default' => 'Copyright All Rights Reserved'
			),
			array(
				'id' => 'subfooter-logos-src',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'media',
				'url' => true,
				'title' => __('Sub Footer Right Section Logo Image', 'mk_framework'),
				'mode' => false,
				'desc' => __('', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => false,
			),
			array(
				'id' => 'subfooter-logos-link',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Sub Footer Right Section Logo Link', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-facebook',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Facebook', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-twitter',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Twitter', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-rss',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('RSS', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-dribbble',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Dribbble', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-pinterest',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Pinterest', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-instagram',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Instagram', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-google-plus',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Google Plus', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-linkedin',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Linkedin', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-youtube',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Youtube', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-vimeo',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Vimeo', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-spotify',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Spotify', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-tumblr',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Tumblr', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'social-behance',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Behance', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'social-whatsapp',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('WhatsApp', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'social-wechat',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Wechat', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'social-qzone',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('qzone', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'social-vkcom',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('vk.com', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'social-imdb',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('IMDb', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'social-renren',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Renren', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'social-weibo',
				'required' => array('sub-footer', 'equals', '1'),
				'type' => 'text',
				'title' => __('Weibo', 'mk_framework'),
				'desc' => __('Including http://', 'mk_framework'),
				'subtitle' => __('Sub Footer Social Networks', 'mk_framework'),
				'default' => '',
			),

		),
	);

	$this->sections[] = array(
		'title' => __('Typography', 'mk_framework'),
		'desc' => __('', 'mk_framework'),
		'icon' => 'el-icon-font',
		'fields' => array(

			array(
				'id' => 'body-font',
				'type' => 'typography',
				'title' => __('Body Font', 'mk_framework'),
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => true, // Select a backup non-google font in addition to a google font
				'font-style' => false, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets' => true, // Only appears if google is true and subsets not set to false
				'font-size' => true,
				'line-height' => false,
				//'word-spacing'=>true, // Defaults to false
				//'letter-spacing'=>true, // Defaults to false
				'color' => false,
				'preview' => true, // Disable the previewer
				'all_styles' => false, // Enable all Google Font style/weight variations to be added to the page
				'units' => 'px', // Defaults to px
				'subtitle' => __('Choose your body font properties.', 'mk_framework'),
				'default' => array(
					'font-family' => 'Open Sans',
					'google' => true,
					'font-size' => '13px',
				),
			),

			array(
				'id' => 'heading-font',
				'type' => 'typography',
				'title' => __('Headings Font', 'mk_framework'),
				'compiler' => false, // Use if you want to hook in your own CSS compiler
				'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => false, // Select a backup non-google font in addition to a google font
				'font-style' => false, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets' => true, // Only appears if google is true and subsets not set to false
				'font-size' => false,
				'line-height' => false,
				//'word-spacing'=>true, // Defaults to false
				//'letter-spacing'=>true, // Defaults to false
				'color' => false,
				'preview' => false, // Disable the previewer
				'all_styles' => false, // Enable all Google Font style/weight variations to be added to the page
				'units' => 'px', // Defaults to px
				'subtitle' => __('Choose your Heading fonts properties. <br>(will affect H1, H2, H3, H4, H5, H6)', 'mk_framework'),
				'default' => array(
					'font-family' => '',
					'google' => true,
					'font-weight' => '600',
				),
			),

			array(
				'id' => 'widget-title',
				'type' => 'typography',
				'title' => __('Widgets Title', 'mk_framework'),
				'compiler' => false, // Use if you want to hook in your own CSS compiler
				'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => false, // Select a backup non-google font in addition to a google font
				'font-style' => false, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets' => false, // Only appears if google is true and subsets not set to false
				'font-size' => true,
				'line-height' => false,
				//'word-spacing'=>true, // Defaults to false
				//'letter-spacing'=>true, // Defaults to false
				'color' => false,
				'preview' => false, // Disable the previewer
				'all_styles' => false, // Enable all Google Font style/weight variations to be added to the page
				'units' => 'px', // Defaults to px
				'subtitle' => __('This will apply to all widget areas title including footer, sidebar and side dashboard', 'mk_framework'),
				'default' => array(
					'font-family' => '',
					'google' => true,
					'font-size' => '13px',
					'font-weight' => 'bold',
				),
			),

			array(
				'id' => 'page-title-size',
				'type' => 'slider',
				'title' => __('Page Title Text Size', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => "18",
				"min" => "12",
				"step" => "1",
				"max" => "100",
			),
			array(
				'id' => 'p-text-size',
				'type' => 'slider',
				'title' => __('Paragraph Text Size', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => "13",
				"min" => "12",
				"step" => "1",
				"max" => "100",
			),
			array(
				'id' => 'p-line-height',
				'type' => 'slider',
				'title' => __('Paragraph Line Height', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => "26",
				"min" => "12",
				"step" => "1",
				"max" => "100",
			),

			array(
				'id' => 'main-nav-font',
				'type' => 'typography',
				'title' => __('Main Navigation Top level', 'mk_framework'),
				'compiler' => false, // Use if you want to hook in your own CSS compiler
				'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => false, // Select a backup non-google font in addition to a google font
				'font-style' => false, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets' => false, // Only appears if google is true and subsets not set to false
				'font-size' => true,
				'line-height' => false,
				//'word-spacing'=>true, // Defaults to false
				//'letter-spacing'=>true, // Defaults to false
				'color' => false,
				'preview' => false, // Disable the previewer
				'all_styles' => false, // Enable all Google Font style/weight variations to be added to the page
				'units' => 'px', // Defaults to px
				'subtitle' => __('', 'mk_framework'),
				'default' => array(
					'font-family' => '',
					'google' => true,
					'font-size' => '12px',
					'font-weight' => 'bold',
				),
			),
			
			array(
				'id' => 'main-nav-item-space',
				'type' => 'slider',
				'title' => __('Main Menu Items Gutter Space', 'mk_framework'),
				'subtitle' => __('Left & Right. default : 17px', 'mk_framework'),
				'desc' => __('This Value will be applied as padding to left and right of the item.', 'mk_framework'),
				"default" => "17",
				"min" => "0",
				"step" => "1",
				"max" => "100",
			),
			array(
				'id' => 'vertical-nav-item-space',
				'type' => 'slider',
				'required' => array('header-structure', 'equals', 'vertical'),
				'title' => __('Main Menu Items Top & Bottom Padding', 'mk_framework'),
				'subtitle' => __('Top & Bottom. default : 10px', 'mk_framework'),
				'desc' => __('This Value will be applied as padding to top and bottom of the item.', 'mk_framework'),
				"default" => "10",
				"min" => "0",
				"step" => "1",
				"max" => "25",
			),
			array(
				'id' => 'main-nav-top-transform',
				'type' => 'button_set',
				'title' => __('Main Menu Top Level Text Transform', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'options' => array('uppercase' => 'Uppercase', 'capitalize' => 'Capitalize', 'lowercase' => 'Lower Case'), 
				'default' => 'uppercase',
			),

			array(
				'id' => 'sub-nav-top-size',
				'type' => 'slider',
				'title' => __('Main Menu Sub Level Font Size', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => "12", 
				"min" => "10",
				"step" => "1",
				"max" => "50",
			),
			array(
				'id' => 'sub-nav-top-transform',
				'type' => 'button_set',
				'title' => __('Main Menu Sub Level Text Transform', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'options' => array('uppercase' => 'Uppercase', 'capitalize' => 'Capitalize', 'lowercase' => 'Lower Case'), 
				'default' => 'uppercase',
			),
			array(
				'id' => 'sub-nav-top-weight',
				'type' => 'button_set',
				'title' => __('Main Menu Sub Level Font Weight', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'options' => array('lighter' => 'Light (300)', 'normal' => 'Normal (400)', '500' => '500', '600' => '600', 'bold' => 'Bold (700)', 'bolder' => 'Bolder', '8000' => 'Extra Bold (800)', '900' => '900'), 
				'default' => 'normal',
			),
			array(
				'id' => 'toolbar-font',
				'type' => 'typography',
				'title' => __('Toolbar Font', 'mk_framework'),
				'compiler' => true, // Use if you want to hook in your own CSS compiler
				'google' => true, // Disable google fonts. Won't work if you haven't defined your google api key
				'font-backup' => false, // Select a backup non-google font in addition to a google font
				'font-style' => false, // Includes font-style and weight. Can use font-style or font-weight to declare
				'subsets' => false, // Only appears if google is true and subsets not set to false
				'font-size' => true,
				'line-height' => false,
				//'word-spacing'=>true, // Defaults to false
				//'letter-spacing'=>true, // Defaults to false
				'color' => false,
				'preview' => true, // Disable the previewer
				'all_styles' => false, // Enable all Google Font style/weight variations to be added to the page
				'units' => 'px', // Defaults to px
				'subtitle' => __('Choose your header toolbar font properties.', 'mk_framework')
			),
			array(
				'id' => 'typekit-info',
				'type' => 'info',
				'style' => 'warning',
				'desc' => __("Note: Adobe Typekit is a premium service. <a target='_blank' href='https://artbees.net/themes/docs/integrating-typekit/'>Learn More</a>", 'mk_framework'),
				'subtitle' => __("", 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'typekit-font-family',
				'type' => 'text',
				'title' => __('Choose a Typekit Font', 'mk_framework'),
				'desc' => __("Type the name of the font family you have picked from typekit library.", 'mk_framework'),
				'subtitle' => __("", 'mk_framework'),
				'default' => '',
			),
			array(
				'id' => 'typekit-element-names',
				'type' => 'text',
				'title' => __('Add Typekit Elements Class Names.', 'mk_framework'),
				'desc' => __("Add class names you want the Typekit apply the above font family. Add Class, ID or tag names (e.g. : body, p, #custom-id, .custom-class).", 'mk_framework'),
				'subtitle' => __("", 'mk_framework'),
				'default' => '',
			),
		),
	);

	$this->sections[] = array(
		'title' => __('Skin', 'mk_framework'),
		'desc' => __('', 'mk_framework'),
		'icon' => 'el-icon-tint',
		'fields' => array(

			array(
				'id' => 'accent-color',
				'type' => 'color',
				'title' => __('Accent Color', 'mk_framework'),
				'subtitle' => __('Main color scheme. Choose a vivid and bold color.', 'mk_framework'),
				'default' => '#ff4351',
				'validate' => 'color',
			),

			/*array(
				'id' => 'hover-overlay-color',
				'type' => 'color',
				'title' => __('Image Hover Overlay Color', 'mk_framework'),
				'subtitle' => __('Image Hover Overlay Color will affect all images that have some overlay layer.', 'mk_framework'),
				'default' => '#ff4351',
				'validate' => 'color',
			),*/

			array(
				'id' => 'body-txt-color',
				'type' => 'color',
				'title' => __('Body text Color', 'mk_framework'),
				'subtitle' => __('Will affect all texts if no color is defined for them.', 'mk_framework'),
				'default' => '#696969',
				'validate' => 'color',
			),
			array(
				'id' => 'heading-color',
				'type' => 'color',
				'title' => __('Headings Color', 'mk_framework'),
				'subtitle' => __('Will affect all headings (h1,h2,h3,h4,h5,h6)', 'mk_framework'),
				'default' => '#393836',
				'validate' => 'color',
			),
			array(
				'id' => 'link-color',
				'type' => 'link_color',
				'title' => __('Links Color', 'mk_framework'),
				'subtitle' => __('Will affect all links color.', 'mk_framework'),
				'regular' => true,
				'hover' => true,
				'default' => array(
					'regular' => '#333333',
					'hover' => '#ff4351',
				)
			),

			array(
				'id' => 'page-title-color',
				'type' => 'color',
				'title' => __('Page Title', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '#545454',
				'validate' => 'color',
			),

			array(
				'id' => 'dashboard-title-color',
				'type' => 'color',
				'title' => __('Dashboard Widget Title', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '#959595',
				'validate' => 'color',
			),

			array(
				'id' => 'dashboard-txt-color',
				'type' => 'color',
				'title' => __('Dashboard Widget Texts', 'mk_framework'),
				'subtitle' => __('Will affect all texts in side dashboard widget (unless there is a color value for the specific option in theme styles)', 'mk_framework'),
				'default' => '#6f6f6f',
				'validate' => 'color',
			),

			array(
				'id' => 'dashboard-link-color',
				'type' => 'link_color',
				'title' => __('Dashboard Widget Links', 'mk_framework'),
				'subtitle' => __('Will affect all links in side dashboard section.', 'mk_framework'),
				'regular' => true,
				'hover' => true,
				'default' => array(
					'regular' => '#afafaf',
					'hover' => '#ff4351',
				)
			),

			array(
				'id' => 'sidebar-title-color',
				'type' => 'color',
				'title' => __('Sidebar Widget Title', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '#555555',
				'validate' => 'color',
			),

			array(
				'id' => 'sidebar-txt-color',
				'type' => 'color',
				'title' => __('Sidebar Widget Texts', 'mk_framework'),
				'subtitle' => __('Will affect all texts in sidebar widget (unless there is a color value for the specific option in theme styles)', 'mk_framework'),
				'default' => '#666666',
				'validate' => 'color',
			),

			array(
				'id' => 'sidebar-link-color',
				'type' => 'link_color',
				'title' => __('Sidebar Widget Links', 'mk_framework'),
				'subtitle' => __('Will affect all links in sidebar section.', 'mk_framework'),
				'regular' => true,
				'hover' => true,
				'default' => array(
					'regular' => '#444',
					'hover' => '#ff4351',
				)
			),

			array(
				'id' => 'footer-title-color',
				'type' => 'color',
				'title' => __('Footer Widget Title', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '#959595',
				'validate' => 'color',
			),

			array(
				'id' => 'footer-txt-color',
				'type' => 'color',
				'title' => __('Footer Widget Texts', 'mk_framework'),
				'subtitle' => __('Will affect all texts in footer widget (unless there is a color value for the specific option in theme styles)', 'mk_framework'),
				'default' => '#6f6f6f',
				'validate' => 'color',
			),

			array(
				'id' => 'footer-link-color',
				'type' => 'link_color',
				'title' => __('Footer Widget Links', 'mk_framework'),
				'subtitle' => __('Will affect all links in footer section.', 'mk_framework'),
				'regular' => true,
				'hover' => true,
				'default' => array(
					'regular' => '#afafaf',
					'hover' => '#ff4351',
				)
			),
			array(
				'id' => 'sub-footer-border-top',
				'type' => 'switch',
				'title' => __('Show Sub Footer Border Top?', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'footer-social-color',
				'type' => 'link_color',
				'title' => __('Sub-Footer Social Networks Color', 'mk_framework'),
				'subtitle' => __('Will affect all social network icons in sub footer. you can set its active and hover values.', 'mk_framework'),
				'regular' => true,
				'hover' => true,
				'default' => array(
					'regular' => '#666666',
					'hover' => '#ff4351',
				)
			),
			array(
				'id' => 'footer-socket-color',
				'type' => 'color',
				'title' => __('Sub-Footer Copyright Color', 'mk_framework'),
				'subtitle' => __('Will affect sub footer left side copyright text.', 'mk_framework'),
				'default' => '#666666',
				'validate' => 'color',
			),
			array(
				'id' => 'widget-title-divider',
				'type' => 'switch',
				'title' => __('Show Widget Title Divider?', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('If you dont want to show widget title divider disabled this option.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'main-nav-top-color',
				'type' => 'nav_color',
				'title' => __('Main Navigation Top Level', 'mk_framework'),
				'subtitle' => __('Will affect main navigation top level links', 'mk_framework'),
				'regular' => true,
				'hover' => true,
				'bg' => true,
				'bg-hover' => true,
				'default' => array(
					'regular' => '#666666',
					'hover' => '#ff4351',
					'bg' => '',
					'bg-hover' => '',
				)
			),

			array(
				'id' => 'main-nav-sub-bg',
				'type' => 'color',
				'title' => __('Main Navigation Sub Level Background Color', 'mk_framework'),
				'subtitle' => __('This value will affect Sub level background color including mega menu.', 'mk_framework'),
				'default' => '#191919',
				'validate' => 'color',
			),

			array(
				'id' => 'main-nav-sub-color',
				'type' => 'nav_color',
				'title' => __('Main Navigation Sub Level', 'mk_framework'),
				'subtitle' => __('Will affect all links in sidebar section.', 'mk_framework'),
				'regular' => true,
				'hover' => true,
				'bg' => true,
				'bg-hover' => true,
				'default' => array(
					'regular' => '#fff',
					'hover' => '#000',
					'bg' => '',
					'bg-hover' => '#ff4351',
				)
			),
			array(
				'id' => 'navigation-border-top',
				'type' => 'switch',
				'title' => __('Show Main Navigation Border Top?', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'toolbar-border-top',
				'type' => 'switch',
				'title' => __('Show Toolbar Border Bottom?', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'toolbar-border-bottom-color',
				'type' => 'color',
				'title' => __('Header Toolbar Border Bottom Color', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => 'transparent',
				'validate' => 'color',
			),
			array(
				'id' => 'toolbar-text-color',
				'type' => 'color',
				'title' => __('Header Toolbar Text Color', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '#444444',
				'validate' => 'color',
			),
			array(
				'id' => 'toolbar-phone-email-icon-color',
				'type' => 'color',
				'title' => __('Header Toolbar Phone & Email Icon Color', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '#444444',
				'validate' => 'color',
			),
			array(
				'id' => 'toolbar-link-color',
				'type' => 'nav_color',
				'title' => __('Header Toolbar Link Color', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'regular' => true,
				'hover' => true,
				'default' => array(
					'regular' => '#444444',
					'hover' => '#d3b76c'
				)
			),
			array(
				'id' => 'toolbar-social-link-color',
				'type' => 'nav_color',
				'title' => __('Header Toolbar Social Network Link Color', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'regular' => true,
				'hover' => true,
				'default' => array(
					'regular' => '#444444',
					'hover' => '#d3b76c'
				)
			),
			array(
				'id' => 'header-search-icon-color',
				'type' => 'color',
				'title' => __('Header Search Icon Color', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '',
				'validate' => 'color',
			),

			array(
				'id' => 'preloader-txt-color',
				'type' => 'color',
				'title' => __('Preloader Text Color', 'mk_framework'),
				'subtitle' => __('Will affect global site preloader text color.', 'mk_framework'),
				'default' => '#444',
				'validate' => 'color',
			),

			array(
				'id' => 'preloader-bg-color',
				'type' => 'color',
				'title' => __('Preloader Backgroud Color', 'mk_framework'),
				'subtitle' => __('Will affect global site preloader Background color.', 'mk_framework'),
				'default' => '#fff',
				'validate' => 'color',
			),

			array(
				'id' => 'preloader-bar-color',
				'type' => 'color',
				'title' => __('Preloader Bar Color', 'mk_framework'),
				'subtitle' => __('Will affect global site preloader Bar color.', 'mk_framework'),
				'default' => '',
				'validate' => 'color',
			),
			array(
				'id' => 'breadcrumb-skin',
				'type' => 'select',
				'title' => __('Breadcrumb Skin', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'options' => array(
					'dark' => 'Dark',
					'light' => 'Light',
					'custom' => 'Custom',

				),
				'default' => 'light',
			),
			array(
				'id' => 'breadcrumb-skin-custom',
				'type' => 'nav_color',
				'title' => __('Breadcrumb Custom Skin Color', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'regular' => true,
				'hover' => true,
				'default' => array(
					'regular' => '#fff',
					'hover' => '#000'
				)
			),

			array(
				'id' => 'custom-css',
				'type' => 'ace_editor',
				'title' => __('Custom CSS', 'mk_framework'),
				'subtitle' => __('Add some quick css into this box.', 'mk_framework'),
				'desc' => __('For larger scale css modifications use custom.css file in theme root or consider using a child theme.', 'mk_framework'),
				'mode' => 'css',
				'theme' => 'monokai',
				'default' => "",
			),
			array(
				'id' => 'custom-js',
				'type' => 'ace_editor',
				'title' => __('Custom JS', 'mk_framework'),
				'subtitle' => __('Script will be placed in an script tag in document footer', 'mk_framework'),
				'mode' => 'javascript',
				'theme' => 'chrome',
				'desc' => 'For larger scale css modifications js custom.js file in theme root or consider using a child theme.',
				'default' => "jQuery(document).ready(function(){\n\n});",
			),



		),
	);

	$this->sections[] = array(
		'title' => __('Backgrounds', 'mk_framework'),
		'desc' => __('In this section you will customize your website backgrounds.', 'mk_framework'),
		'icon' => 'el-icon-brush',
		'fields' => array(

			array(
				'id' => 'body-layout',
				'type' => 'button_set',
				'title' => __('Site Layout', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('Boxed layout best works on standart header style.', 'mk_framework'),
				'options' => array('full' => 'Full Width', 'boxed' => 'Boxed'), //Must provide key => value pairs for radio options
				'default' => 'full',
			),

            array(
                'id' => 'boxed-layout-shadow',
                'type' => 'button_set',
                'title' => __('Boxed Layout Shadow', 'mk_framework'),
                'required' => array('body-layout', 'equals', 'boxed'),
                'subtitle' => __('', 'mk_framework'),
                'desc' => __('', 'mk_framework'),
                'options' => array('enabled' => 'Enable', 'disabled' => 'Disable'), //Must provide key => value pairs for radio options
                'default' => 'enabled',
            ),

			array(
				'id' => 'body-bg',
				'type' => 'bg_selector',
				'required' => array('body-layout', 'equals', 'boxed'),
				'title' => __('Body Background', 'mk_framework'),
				'subtitle' => __('Affects body background Properties, use this option when boxed layout is chosen.', 'mk_framework'),
				'preset' => false,
				'default' => array(
					'url' => '',
					'color' => '#fff',
					'position' => '',
					'repeat' => 'repeat',
					'attachment' => 'scroll',
					'cover' => '',
				)
			),

			array(
				'id' => 'header-bg',
				'type' => 'bg_selector',
				'title' => __('Header Background', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'preset' => false,
				'default' => array(
					'url' => '',
					'color' => '#fff',
					'position' => '',
					'repeat' => 'repeat',
					'attachment' => 'scroll',
					'cover' => '',
				)
			),
			array(
				'id' => 'header-bottom-border',
				'type' => 'color',
				'title' => __('Header Bottom Border Color', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '#e6e6e6',
				'validate' => 'color',
			),
			array(
				'id' => 'toolbar-bg',
				'type' => 'bg_selector',
				'title' => __('Header Toolbar Background', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'preset' => false,
				'default' => array(
					'url' => '',
					'color' => '#eeeeee',
					'position' => '',
					'repeat' => 'repeat',
					'attachment' => 'scroll',
					'cover' => '',
				)
			),	

			array(
				'id' => 'page-title-bg',
				'type' => 'bg_selector',
				'title' => __('Page Title Background', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'preset' => false,
				'border' => true,
				'default' => array(
					'url' => '',
					'color' => '#fafafa',
					'position' => '',
					'repeat' => 'repeat',
					'attachment' => 'scroll',
					'cover' => '',
					'border' => '#eeeeee',
				)
			),

			array(
				'id' => 'page-bg',
				'type' => 'bg_selector',
				'title' => __('Page Background', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'preset' => false,
				'default' => array(
					'url' => '',
					'color' => '#fff',
					'position' => '',
					'repeat' => 'repeat',
					'attachment' => 'scroll',
					'cover' => '',
				)
			),

			array(
				'id' => 'footer-bg',
				'type' => 'bg_selector',
				'title' => __('Footer Background', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'preset' => false,
				'default' => array(
					'url' => '',
					'color' => '#191919',
					'position' => '',
					'repeat' => 'repeat',
					'attachment' => 'scroll',
					'cover' => '',
				)
			),

			array(
				'id' => 'sub-footer-bg',
				'type' => 'color',
				'title' => __('Sub Footer Background Color', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '#262626',
				'validate' => 'color',
			),

			array(
				'id' => 'dashboard-bg',
				'type' => 'color',
				'title' => __('Side Dashboard Background Color', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '#191919',
				'validate' => 'color',
			),

			

		),
	);

	$this->sections[] = array(
		'title' => __('Blog', 'mk_framework'),
		'desc' => __('', 'mk_framework'),
		'icon' => 'el-icon-pencil',
		'fields' => array(
            array(
                'id' => 'blog-single-layout',
                'type' => 'select',
                'title' => __('Blog Single Layout', 'mk_framework'),
                'subtitle' => __('You can globally manage blog single layout using this option. If <strong>Feed From Meta Option</strong> is selected, then you will be able to control it locally through <strong>Ken Page Layout metabox</strong>', 'mk_framework'),
                "default" => 'meta-feed',
                'options' => array(
                    'meta-feed' => __('Feed From Meta Option', 'mk_framework'),
                    'right' => __('Right', 'mk_framework'),
                    'left' => __('Left', 'mk_framework'),
                    'full' => __('Full', 'mk_framework'),
                ),
            ),
			array(
				'id' => 'page-title-blog',
				'type' => 'switch',
				'title' => __('Page Title : Blog Posts', 'mk_framework'),
				'subtitle' => __('This option will affect Blog single posts.', 'mk_framework'),
				'desc' => __('If you don\'t want to show page title section (title, breadcrumb) in blog single posts disable this option.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				"title" => __("Previous & Next Arrows", 'mk_framework'),
				"subtitle" => __("Using this option you can turn on/off the navigation arrows when viewing the portfolio single page.", "mk_framework"),
				"id" => "blog_next_prev",
				"default" => 1,
				"type" => "switch",
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'blog-featured-image',
				'type' => 'switch',
				'title' => __('Blog Single Featured image, audio, video ', 'mk_framework'),
				'subtitle' => __('Will completely disable Featued Image, Video and Audio players from blog single post.', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'blog-image-crop',
				'type' => 'switch',
				'title' => __('Featured image hard cropping', 'mk_framework'),
				'subtitle' => __('This option will affect single blog post featrued image.', 'mk_framework'),
				'desc' => __('If you want to disable automatic image cropping for featured image, disable this option. The original image size will be used. However it will be responsive and fit to container.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'blog-single-image-height',
				'required' => array('blog-image-crop', 'equals', '1'),
				'type' => 'slider',
				'title' => __('Single Post Featured Image Height', 'mk_framework'),
				'subtitle' => __('This height applies to featured image and gallery post type slideshow..', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => "350",
				"min" => "100",
				"step" => "1",
				"max" => "1000",
			),

			array(
				'id' => 'blog-single-related-posts',
				'type' => 'switch',
				'title' => __('Related Posts', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'blog-single-about-author',
				'type' => 'switch',
				'title' => __('About Author Section', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'blog-single-social-share',
				'type' => 'switch',
				'title' => __('Blog Single Social Share', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'blog-single-comments',
				'type' => 'switch',
				'title' => __('Comments', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'archive-layout',
				'type' => 'image_select',
				'title' => __('Archive Layout', 'mk_framework'),
				'subtitle' => __('Defines archive loop layout.', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'options' => array(
					'left' => array('alt' => '1 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/left_layout.png'),
					'right' => array('alt' => '2 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/right_layout.png'),
					'full' => array('alt' => '3 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/full_layout.png'),
				),
				'default' => 'right'
			),
			array(
				'id' => 'archive-loop-style',
				'type' => 'select',
				'title' => __('Archive Loop Style', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				"default" => 'classic',
				'options' => array(
					'classic' => __('Classic', 'mk_framework'),
					'masonry' => __('Masonry', 'mk_framework'),
					'tile' => __('Tile', 'mk_framework'),
					'thumb' => __('Thumb', 'mk_framework'),
					'list' => __('List', 'mk_framework'),
				)
			),
			array(
				'id' => 'archive-page-title',
				'type' => 'switch',
				'title' => __('Archive Loop Page Title', 'mk_framework'),
				'subtitle' => __('Using this option you can enable/disable page title section (including breadcrumbs)', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

		),
	);

	$this->sections[] = array(
		'title' => __('Portfolio', 'mk_framework'),
		'desc' => __('', 'mk_framework'),
		'icon' => 'el-icon-briefcase',
		'fields' => array(

			array(
				'id' => 'page-title-portfolio',
				'type' => 'switch',
				'title' => __('Page Title : Portfolio Posts', 'mk_framework'),
				'subtitle' => __('This option will affect Portfolio single posts.', 'mk_framework'),
				'desc' => __('If you don\'t want to show page title section (title, breadcrumb) in Portfolio single posts disable this option.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'portfolio-slug',
				'type' => 'text',
				'title' => __('Portfolio Slug', 'mk_framework'),
				'subtitle' => __('If you modify this field please navigate to <a href="' . admin_url('options-permalink.php', 'https') . '">Permalinks</a> and hit the save button to update the permalink structure.', 'mk_framework'),
				'desc' => __('Portfolio Slug is the text that is displyed in the URL (e.g. www.domain.com/<strong>portfolio-posts</strong>/morbi-et-diam-massa/). As shown in the example, it is set to "portfolio-posts" by default but you can change it to anything to suite your preference. However you should not have the same slug in any page or other post slug and if so the pagination will return 404 error naturally due to the internal conflicts.', 'mk_framework'),
				'default' => 'portfolio-posts',
			),
			array(
				"title" => __("Previous & Next Arrows", 'mk_framework'),
				"subtitle" => __("Using this option you can turn on/off the navigation arrows when viewing the portfolio single page.", "mk_framework"),
				"id" => "portfolio_next_prev",
				"default" => '1',
				"type" => "switch",
				'on' => 'Enable',
				'off' => 'Disable',
			),
			array(
				'id' => 'portfolio-single-image',
				'type' => 'switch',
				'title' => __('Portfolio Single Featured Image', 'mk_framework'),
				'subtitle' => __('Using this option you can disable/enable portfolio single featured image, gallyer slidshow or video.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'portfolio-image-crop',
				'type' => 'switch',
				'required' => array('portfolio-single-image', 'equals', '1'),
				'title' => __('Featured image hard cropping', 'mk_framework'),
				'subtitle' => __('This option will affect single Portfolio post featrued image.', 'mk_framework'),
				'desc' => __('If you want to disable automatic image cropping for featured image, disable this option. The original image size will be used. However it will be responsive and fit to container.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'Portfolio-single-image-height',
				'type' => 'slider',
				'required' => array('portfolio-single-image', 'equals', '1'),
				'title' => __('Featured Image Height', 'mk_framework'),
				'subtitle' => __('This height applies to featured image and gallery post type slideshow..', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				"default" => "350",
				"min" => "100",
				"step" => "1",
				"max" => "1000",
			),

			array(
				'id' => 'portfolio-single-related',
				'type' => 'switch',
				'title' => __('Related Projects', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'portfolio-single-comments',
				'type' => 'switch',
				'title' => __('Comments', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				"default" => 0,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'portfolio-archive-loop-style',
				'type' => 'select',
				'title' => __('Portfolio Archive Loop Style', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				"default" => 'grid',
				'options' => array(
					"grid" => __("Grid", 'mk_framework'),
					"masonry" => __("Masonry", 'mk_framework'),
					"flip" => __("Flip", 'mk_framework'),
					"standard" => __("Standard", 'mk_framework'),
					"scroller" => __("Scroller", 'mk_framework')

				),
				'default' => 'classic',
			),

		),
	);

	$this->sections[] = array(
		'title' => __('Woocommerce', 'mk_framework'),
		'desc' => __('', 'mk_framework'),
		'icon' => 'el-icon-shopping-cart',
		'fields' => array(
			array(
				'id' => 'woo-shop-layout',
				'type' => 'image_select',
				'title' => __('Shop Layout', 'mk_framework'),
				'subtitle' => __('Defines shop loop layout.', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'options' => array(
					'left' => array('alt' => '1 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/left_layout.png'),
					'right' => array('alt' => '2 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/right_layout.png'),
					'full' => array('alt' => '3 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/full_layout.png'),
				),
				'default' => 'right'
			),

			array(
				'id' => 'woo-loop-thumb-height',
				'type' => 'slider',
				'title' => __('Product Loop Image Height', 'mk_framework'),
				'subtitle' => __('Using this option you can change the product loop image height.', 'mk_framework'),
				'desc' => __('default : 330', 'mk_framework'),
				"default" => "330",
				"min" => "100",
				"step" => "1",
				"max" => "1000",
			),
		    array(
		        "title" => __("Shop Loop Image Size", 'mk_framework'),
		        "id" => "woo_loop_image_size",
		        "default" => "crop",
		        "options" => array(
		            "crop" => __("Resize & Crop", 'mk_framework'),
		            "full" => __("Original Size", 'mk_framework'),
		            "large" => __("Large Size", 'mk_framework'),
		            "medium" => __("Medium Size", 'mk_framework'),
		        ),
		        "type" => "select"
		    ),
			array(
				'id' => 'woo-single-thumb-height',
				'type' => 'slider',
				'title' => __('Single Product Image Height', 'mk_framework'),
				'subtitle' => __('Using this option you can change the single product image height.', 'mk_framework'),
				'desc' => __('default : 800', 'mk_framework'),
				"default" => "800",
				"min" => "100",
				"step" => "1",
				"max" => "1000",
			),
		    array(
		        "title" => __("Shop Single Product Image Size", 'mk_framework'),
		        "id" => "woo_single_image_size",
		        "default" => "crop",
		        "options" => array(
		            "crop" => __("Resize & Crop", 'mk_framework'),
		            "full" => __("Original Size", 'mk_framework'),
		            "large" => __("Large Size", 'mk_framework'),
		            "medium" => __("Medium Size", 'mk_framework'),
		        ),
		        "type" => "select"
		    ),

			array(
				'id' => 'woo-single-layout',
				'type' => 'image_select',
				'title' => __('Single Layout', 'mk_framework'),
				'subtitle' => __('Defines shop single product layout.', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'options' => array(
					'left' => array('alt' => '1 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/left_layout.png'),
					'right' => array('alt' => '2 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/right_layout.png'),
					'full' => array('alt' => '3 Column', 'img' => THEME_ADMIN_ASSETS_URI . '/img/full_layout.png'),
				),
				'default' => 'right'
			),

			array(
				'id' => 'checkout-box',
				'type' => 'switch',
				'title' => __('Header Checkout/Shopping Box', 'mk_framework'),
				'subtitle' => __('Using This option you can remove header shopping box from header.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'woo-image-quality',
				'type' => 'button_set',
				'title' => __('Product Loops image quality', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'options' => array('1' => 'Normal Size', '2' => 'Retina Compatible'), //Must provide key => value pairs for radio options
				'default' => '1'
			),

			array(
				'id' => 'woo-single-title',
				'type' => 'switch',
				'title' => __('Show Product Category as Product Single Title.', 'mk_framework'),
				'subtitle' => __('If you want to show product category(if multiple only first will be used) as single product page title enable this option. having this option disabled shop page title will be used.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'woo-single-show-title',
				'type' => 'switch',
				'title' => __('Woocommerce Single Product Page Title', 'mk_framework'),
				'subtitle' => __('Using this option you can disable/enable single product page title (including breadcrumbs).', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'woo-shop-loop-title',
				'type' => 'switch',
				'title' => __('Woocommerce Shop Loop Page Title', 'mk_framework'),
				'subtitle' => __('Using this option you can disable/enable Shop product Loop title (including breadcrumbs).', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

		),
	);

	$this->sections[] = array(
		'title' => __('Third Party API', 'mk_framework'),
		'desc' => __('', 'mk_framework'),
		'icon' => 'el-icon-puzzle',
		'fields' => array(

			array(
				'id' => 'twitter-consumer-key',
				'type' => 'text',
				'title' => __('Twitter Consumer Key', 'mk_framework'),
				'desc' => __('<ol style="list-style-type:decimal !important;">
  <li>Go to "<a href="https://dev.twitter.com/apps">https://dev.twitter.com/apps</a>," login with your twitter account and click "Create a new application".</li>
  <li>Fill out the required fields, accept the rules of the road, and then click on the "Create your Twitter application" button. You will not need a callback URL for this app, so feel free to leave it blank.</li>
  <li>Once the app has been created, click the "Create my access token" button.</li>
  <li>You are done! You will need the following data later on:</ol>', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'twitter-consumer-secret',
				'type' => 'text',
				'title' => __('Twitter Consumer Secret', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'twitter-access-token',
				'type' => 'text',
				'title' => __('Twitter Access Token', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'twitter-access-token-secret',
				'type' => 'text',
				'title' => __('Twitter Access Token Secret', 'mk_framework'),
				'desc' => __('', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'flickr-api-key',
				'type' => 'text',
				'title' => __('Flickr API Key', 'mk_framework'),
				'desc' => __('You can obtain your API key from <a href="http://www.flickr.com/services/api/misc.api_keys.html">Flickr The App Garden</a>', 'mk_framework'),
				'subtitle' => __('You will need to fill this field if you want to use flickr widget or shrotcode', 'mk_framework'),
				'default' => '',
			),

			array(
				'id' => 'google-analytics',
				'type' => 'text',
				'title' => __('Google Analytics ID', 'mk_framework'),
				'desc' => __('Enter your Google Analytics ID here to track your site with Google Analytics.', 'mk_framework'),
				'subtitle' => __('', 'mk_framework'),
				'default' => '',
			),

            array(
                'id' => 'google-maps-key',
                'type' => 'text',
                'title' => __('Google Maps API Key', 'mk_framework'),
                'desc' => __('You will need to <a target="_blank" href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true">get an API key</a> for Google Maps. <br>
                1. Go to the <a target="_blank" href="https://console.developers.google.com/flows/enableapi?apiid=maps_backend,geocoding_backend,directions_backend,distance_matrix_backend,elevation_backend&keyType=CLIENT_SIDE&reusekey=true">Google Developers Console</a>. <br>
                2. Create or select a project. <br>
                3. Click Continue to enable the API and any related services.<br>
                4. On the Credentials page, get a Browser key (and set the API Credentials).', 'mk_framework'),
                'subtitle' => __('', 'mk_framework'),
                'default' => '',
            ),

		),
	);

	$this->sections[] = array(
		'title' => __('Manage Theme Speed', 'mk_framework'),
		'desc' => __('', 'mk_framework'),
		'icon' => 'el-icon-cogs',
		'fields' => array(
			array(
				'id' => 'minify-js',
				'type' => 'switch',
				'title' => __('Minify Java Script Files', 'mk_framework'),
				'subtitle' => __('Minifies file to decrease the file size by 40%', 'mk_framework'),
				'desc' => __('You can enable JS minification using this option. This option will only pickup the pre-minified JS files(theme-scripts-min.js & plugins.js). So use this option if you did not hack the JS files.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'minify-css',
				'type' => 'switch',
				'title' => __('Minify CSS Files', 'mk_framework'),
				'subtitle' => __('Minifies file to decrease the file size by 40%', 'mk_framework'),
				'desc' => __('You can enable CSS minification using this option. This option will only pickup the pre-minified CSS files. So use this option if you did not hack the CSS files.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

			array(
				'id' => 'remove-js-css-ver',
				'type' => 'switch',
				'title' => __('Remove query string from Static Files', 'mk_framework'),
				'subtitle' => __('Removes "ver" query string from JS and CSS files.', 'mk_framework'),
				'desc' => __('For More info Please <a href="https://developers.google.com/speed/docs/best-practices/caching#LeverageProxyCaching">Read Here</a>.', 'mk_framework'),
				"default" => 1,
				'on' => 'Enable',
				'off' => 'Disable',
			),

		),
	);


                $this->sections[] = array(
                    'title'  => __( 'Import / Export', 'mk_framework' ),
                    'desc'   => __( 'Import and Export your Redux Framework settings from file, text or URL.', 'mk_framework' ),
                    'icon'   => 'el el-refresh',
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


                if ( file_exists( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) ) {
                    $tabs['docs'] = array(
                        'icon'    => 'el el-book',
                        'title'   => __( 'Documentation', 'mk_framework' ),
                        'content' => nl2br( file_get_contents( trailingslashit( dirname( __FILE__ ) ) . 'README.html' ) )
                    );
                }
            }

            public function setHelpTabs() {

                // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-1',
                    'title'   => __( 'Theme Information 1', 'mk_framework' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'mk_framework' )
                );

                $this->args['help_tabs'][] = array(
                    'id'      => 'redux-help-tab-2',
                    'title'   => __( 'Theme Information 2', 'mk_framework' ),
                    'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'mk_framework' )
                );

                // Set the help sidebar
                $this->args['help_sidebar'] = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'mk_framework' );
            }

            /**
             * All the possible arguments for Redux.
             * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
             * */
            public function setArguments() {

                $theme = wp_get_theme(); // For use with some settings. Not necessary.

                $this->args = array(
                    // TYPICAL -> Change these values as you need/desire
                    'opt_name'             => 'mk_settings',
                    // This is where your data is stored in the database and also becomes your global variable name.
                    'display_name'         => $theme->get( 'Name' ),
                    // Name that appears at the top of your panel
                    'display_version'      => $theme->get( 'Version' ),
                    // Version that appears at the top of your panel
                    'menu_type'            => 'menu',
                    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                    'allow_sub_menu'       => true,
                    // Show the sections below the admin menu item or not
                    'menu_title'           => __( 'Theme Settings', 'mk_framework' ),
                    'page_title'           => __( 'Theme Settings', 'mk_framework' ),
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
                    'page_slug'            => 'theme_settings',
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
                        'icon'          => 'el el-question-sign',
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

               
                // Panel Intro text -> before the form
                if ( ! isset( $this->args['global_variable'] ) || $this->args['global_variable'] !== false ) {
                    if ( ! empty( $this->args['global_variable'] ) ) {
                        $v = $this->args['global_variable'];
                    } else {
                        $v = str_replace( '-', '_', $this->args['opt_name'] );
                    }
                    //$this->args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'mk_framework' ), $v );
                } else {
                    //$this->args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'mk_framework' );
                }

                // Add content after the form.
                //$this->args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'mk_framework' );
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

            public static function class_field_callback( $field, $value ) {
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

            $return['warning'] = $field;

            return $return;
        }
    endif;
