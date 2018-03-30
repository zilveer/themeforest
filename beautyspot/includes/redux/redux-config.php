<?php

if (!class_exists('Redux_Framework_Beautyspot_config')) {

    class Redux_Framework_Beautyspot_config {

        public $args        = array();
        public $sections    = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if ( true == Redux_Helpers::isTheme(__FILE__) ) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }

        }

        public function initSettings() {

            // Just for demo purposes. Not needed per say.
            //$this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            //$this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
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
                'title' => __('Section via hook', 'beautyspot'),
                'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'beautyspot'),
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

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'beautyspot'), $this->theme->display('Name'));

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
                        <li><?php printf(__('By %s', 'beautyspot'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'beautyspot'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', 'beautyspot') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
            <?php
            if ($this->theme->parent()) {
                printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'beautyspot'), $this->theme->parent()->display('Name'));
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

/* -----------------------------------------------------------------------------

    SECTIONS

----------------------------------------------------------------------------- */

    $lsvr_theme_options = get_option( 'theme_options' );

	/* -------------------------------------------------------------------------
        GENERAL
    ------------------------------------------------------------------------- */

	$this->sections[] = array(
		'title'     => __( 'General Settings', 'beautyspot' ),
		'icon'      => 'el-icon-home',
		'fields'    => array(

            // LOGO
            array(
                'id' => 'default_logo',
				'type' => 'media',
				'title' => __( 'Site Logo', 'beautyspot' ),
                'subtitle' => __( 'This logo will be used for non-retina screens.', 'beautyspot' )
			),

            // LOGO 2x
            array(
                'id' => 'default_logo_2x',
				'type' => 'media',
				'title' => __( 'Site Logo (Retina)', 'beautyspot' ),
                'subtitle' => __( 'This logo will be used for Retina (HiDPI) screens. It should be twice as big as normal version.', 'beautyspot' )
			),

			// LOGO WIDTH
			array(
				'id'		=> 'default_logo_width',
				'type'		=> 'slider',
				'title'		=> __( 'Logo Width', 'beautyspot' ),
				'subtitle'	=> __( 'It should be the same as the width of non-retina logo.', 'beautyspot' ),
				'default' => '291',
                'min' => '100',
                'step' => '1',
                'max' => '500',
			),

            // FAVICON
            array(
                'id' => 'favicon',
				'type' => 'media',
				'title' => __( 'Favicon', 'beautyspot' ),
			),

            // SOCIAL ICONS
            array(
                'id' => 'social_links',
				'type' => 'sortable',
				'title' => __( 'Social Links', 'beautyspot' ),
                'subtitle' => __( 'Fill in the respective field with a full URL (starting with http:// or https:// respectively). You should not use more than 5 social links.', 'beautyspot' ),
                'label' => true,
                'options' => array(
                    'behance' => '',
                    'blogger' => '',
                    'deviantart' => '',
                    'digg' => '',
                    'dribbble' => '',
                    'ebay' => '',
					'email' => '',
                    'facebook' => '',
                    'flickr' => '',
                    'forrst' => '',
                    'github' => '',
                    'gplus' => '',
                    'instagram' => '',
					'lastfm' => '',
                    'linkedin' => '',
                    'myspace' => '',
                    'pinterest' => '',
					'rss' => '',
                    'soundcloud' => '',
                    'skype' => '',
                    'tumblr' => '',
                    'twitter' => '',
                    'vimeo' => '',
					'vk' => '',
                    'wordpress' => '',
					'yelp' => '',
                    'youtube' => '',
        	    ),
                'default' => array(
                    'behance' => 'Behance',
                    'blogger' => 'Blogger',
                    'deviantart' => 'DeviantArt',
                    'digg' => 'Digg',
                    'dribbble' => 'Dribbble',
                    'ebay' => 'Ebay',
					'email' => 'Email',
                    'facebook' => 'Facebook',
                    'flickr' => 'Flickr',
                    'forrst' => 'Forrst',
                    'github' => 'GitHub',
                    'gplus' => 'Google+',
                    'instagram' => 'Instagram',
					'lastfm' => 'last.fm',
                    'linkedin' => 'LinkedIn',
                    'myspace' => 'MySpace',
                    'pinterest' => 'Pinterest',
					'rss' => 'RSS',
                    'soundcloud' => 'SoundCloud',
                    'skype' => 'Skype',
                    'tumblr' => 'Tumblr',
                    'twitter' => 'Twitter',
                    'vimeo' => 'Vimeo',
					'vk' => 'VK',
                    'wordpress' => 'WordPress',
					'yelp' => 'Yelp',
                    'youtube' => 'YouTube',
        	    ),
				'required'  => array( 'enable_header_panel', "=", 1 ),
			),

			// SOCIAL ICONS TARGET
            array(
                'id' => 'social_links_target',
				'type' => 'switch',
				'title' => __( 'Open Social Links in New Tab', 'beautyspot' ),
                'default' => 0
			),

            // GOOGLE MAPS API
            array(
                'id' => 'gmap_api_key',
                'type' => 'text',
                'title' => __( 'Google Maps API Key', 'lsvrtheme' ),
                'subtitle' => __( 'The API key is required if you want to use Google Map element. Generate your own API key', 'lsvrtheme' ) . '<br><a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">https://developers.google.com/maps/documentation/javascript/get-api-key</a>',
            ),

		),
	);

    /* -------------------------------------------------------------------------
        HEADER
    ------------------------------------------------------------------------- */

	$this->sections[] = array(
		'title'     => __( 'Main Sidebar Settings', 'beautyspot' ),
		'icon'      => 'el-icon-cog',
		'fields'    => array(

            // BACKGROUND IMAGE
            array(
                'id' => 'header_bg_image',
				'type' => 'media',
				'title' => __( 'Sidebar Background Image', 'beautyspot' ),
				'subtitle' => __( 'This image will be displayed under color overlay.', 'beautyspot' ),
			),

			array(
				'id'   => 'header_divider_10',
				'type' => 'divide'
			),

            // ANIMATED HEADER BG
            array(
                'id' => 'enable_animated_header_bg',
				'type' => 'switch',
				'title' => __( 'Enable Animated Sidebar Background', 'beautyspot' ),
                'default' => 1
			),

			array(
				'id'   => 'header_divider_20',
				'type' => 'divide'
			),

			// HEADER SEARCH
            array(
                'id' => 'enable_header_search',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar Search', 'beautyspot' ),
                'default' => 1
			),

			array(
				'id'   => 'header_divider_30',
				'type' => 'divide'
			),

			// HEADER PANEL
            array(
                'id' => 'enable_header_panel',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar Panel', 'beautyspot' ),
                'default' => 1
			),

			array(
				'id'   => 'header_divider_35',
				'type' => 'divide',
				'required'  => array( 'enable_header_panel', "=", 1 ),
			),

			// HEADER PANEL CLOSED
            array(
                'id' => 'header_panel_closed',
				'type' => 'switch',
				'title' => __( 'Show Sidebar Panel as Closed', 'beautyspot' ),
				'subtitle' => __( 'By default, Sidebar Panel is always opened on screens bigger than 1400px. Enable this option to make it closed even on those screens.', 'beautyspot' ),
				'required'  => array( 'enable_header_panel', "=", 1 ),
                'default' => 0
			),

			array(
				'id'   => 'header_divider_40',
				'type' => 'divide',
				'required'  => array( 'enable_header_panel', "=", 1 ),
			),

			// RESERVATION FORM BUTTON
            array(
                'id' => 'enable_reservation_form_btn',
				'type' => 'switch',
				'title' => __( 'Enable Reservation Form Button', 'beautyspot' ),
                'default' => 1,
				'required'  => array( 'enable_header_panel', "=", 1 ),
			),

			// RESERVATION FORM BUTTON
            array(
                'id' => 'header_reservation_btn_label',
				'type' => 'text',
				'title' => __( 'Reservation Button Label', 'beautyspot' ),
                'default' => __( 'Make An Appointment', 'beautyspot' ),
				'required'  => array(
					array( 'enable_reservation_form_btn', "=", 1 ),
					array( 'enable_header_panel', "=", 1 ),
				),
			),

			array(
				'id'   => 'header_divider_50',
				'type' => 'divide',
				'required'  => array( 'enable_header_panel', "=", 1 ),
			),

			// HEADER CONTACT
            array(
                'id' => 'enable_header_contact',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar Contact', 'beautyspot' ),
                'default' => 1,
				'required'  => array( 'enable_header_panel', "=", 1 ),
			),

			// CONTACT INFO 1 ICO
            array(
                'id' => 'header_contact_1_ico',
				'type' => 'text',
				'title' => __( 'Contact Info 1 Icon', 'beautyspot' ),
				'subtitle' => __( 'Add a FontAwesome icon class (e.g. "fa-phone", "fa-map-marker"). Please refer to the documentation to learn more about using icons with this theme.', 'beautyspot' ),
                'default' => 'fa-phone',
				'required'  => array(
					array( 'enable_header_panel', "=", 1 ),
					array( 'enable_header_contact', "=", 1 ),
				),
			),

			// CONTACT INFO 1 TEXT
            array(
                'id' => 'header_contact_1_text',
				'type' => 'editor',
				'title' => __( 'Contact Info 1 Text', 'beautyspot' ),
                'default' => '<strong>321 654 987</strong>',
				'required'  => array(
					array( 'enable_header_panel', "=", 1 ),
					array( 'enable_header_contact', "=", 1 ),
				),
			),

			// CONTACT INFO 2 ICO
            array(
                'id' => 'header_contact_2_ico',
				'type' => 'text',
				'title' => __( 'Contact Info 2 Icon', 'beautyspot' ),
                'default' => 'fa-envelope-o',
				'required'  => array(
					array( 'enable_header_panel', "=", 1 ),
					array( 'enable_header_contact', "=", 1 ),
				),
			),

			// CONTACT INFO 2 TEXT
            array(
                'id' => 'header_contact_2_text',
				'type' => 'editor',
				'title' => __( 'Contact Info 2 Text', 'beautyspot' ),
                'default' => '<a href="#">hello@beautyspot.com</a>',
				'required'  => array(
					array( 'enable_header_panel', "=", 1 ),
					array( 'enable_header_contact', "=", 1 ),
				),
			),

			// CONTACT INFO 3 ICO
            array(
                'id' => 'header_contact_3_ico',
				'type' => 'text',
				'title' => __( 'Contact Info 3 Icon', 'beautyspot' ),
                'default' => 'fa-map-marker',
				'required'  => array(
					array( 'enable_header_panel', "=", 1 ),
					array( 'enable_header_contact', "=", 1 ),
				),
			),

			// CONTACT INFO 3 TEXT
            array(
                'id' => 'header_contact_3_text',
				'type' => 'editor',
				'title' => __( 'Contact Info 3 Text', 'beautyspot' ),
                'default' => '<p><strong>BEAUTYSPOT</strong><br>9015 Sunset Boulevard<br>Ca 90069</p>',
				'required'  => array(
					array( 'enable_header_panel', "=", 1 ),
					array( 'enable_header_contact', "=", 1 ),
				),
			),

			// CONTACT INFO 4 ICO
            array(
                'id' => 'header_contact_4_ico',
				'type' => 'text',
				'title' => __( 'Contact Info 4 Icon', 'beautyspot' ),
                'default' => 'fa-clock-o',
				'required'  => array(
					array( 'enable_header_panel', "=", 1 ),
					array( 'enable_header_contact', "=", 1 ),
				),
			),

			// CONTACT INFO 4 TEXT
            array(
                'id' => 'header_contact_4_text',
				'type' => 'editor',
				'title' => __( 'Contact Info 4 Text', 'beautyspot' ),
                'default' => '<dl><dt>Mo. - Fr.:</dt><dd>10:00 - 16:00</dd><dt>Sa.:</dt><dd>10:00 - 14:00</dd><dt>Su.:</dt><dd>Closed</dd></dl>',
				'required'  => array(
					array( 'enable_header_panel', "=", 1 ),
					array( 'enable_header_contact', "=", 1 ),
				),
			),

			array(
				'id'   => 'header_divider_60',
				'type' => 'divide',
				'required'  => array( 'enable_header_panel', "=", 1 ),
			),

		),
	);

    /* -------------------------------------------------------------------------
        FOOTER
    ------------------------------------------------------------------------- */

	$this->sections[] = array(
		'title'     => __( 'Footer Settings', 'beautyspot' ),
		'icon'      => 'el-icon-cog',
		'fields'    => array(

            // ENABLE BOTTOM PANEL
            array(
                'id' => 'enable_bottom_panel',
				'type' => 'switch',
				'title' => __( 'Enable Bottom Panel', 'beautyspot' ),
                'default' => 1
			),

            // BOTTOM PANEL BACKGROUND IMAGE
            array(
                'id' => 'bottom_panel_bg_image',
				'type' => 'media',
				'title' => __( 'Bottom Panel Background Image', 'beautyspot' ),
				'subtitle' => __( 'This image will be displayed under color overlay.', 'beautyspot' ),
				'required'  => array( 'enable_bottom_panel', "=", 1 ),
			),

			array(
				'id'   => 'footer_divider_10',
				'type' => 'divide'
			),

            // ENABLE FOOTER
            array(
                'id' => 'enable_footer',
				'type' => 'switch',
				'title' => __( 'Enable Footer', 'beautyspot' ),
                'default' => 1
			),

            // FOOTER TEXT
            array(
                'id' => 'footer_text',
				'type' => 'editor',
				'title' => __( 'Footer Text', 'beautyspot' ),
                'subtitle' => __( 'Ideal for copyright notice.', 'beautyspot' ),
                'required'  => array( 'enable_footer', "=", 1 ),
				'default' => '&copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' )
			),

		),
	);

	$this->sections[] = array(
		'type' => 'divide',
	);

    /* -------------------------------------------------------------------------
        STYLING
    ------------------------------------------------------------------------- */

	$this->sections[] = array(
        'title' => __( 'Styling', 'beautyspot' ),
		'icon' => 'el-icon-tint',
        'fields' => array(

            // THEME SKIN
            array(
                'id' => 'theme_skin',
				'type' => 'select',
				'title' => __( 'Theme Color Scheme', 'beautyspot' ),
                'options' => array(
                    'default' => __( 'Default', 'beautyspot' ),
                    'coral' => __( 'Coral', 'beautyspot' ),
                    'lavender' => __( 'Lavender', 'beautyspot' ),
                    'lime-breeze' => __( 'Lime Breeze', 'beautyspot' ),
					'mavericks' => __( 'Mavericks', 'beautyspot' ),
					'orient' => __( 'Orient', 'beautyspot' ),
					'red-sunset' => __( 'Red Sunset', 'beautyspot' ),
					'sunrise' => __( 'Sunrise', 'beautyspot' ),
                ),
                'default' => 'default',
				'required'  => array( 'enable_custom_theme_skin', "=", 0 ),
			),

            // ENABLE CUSTOM THEME SKIN
            array(
                'id' => 'enable_custom_theme_skin',
				'type' => 'switch',
				'title' => __( 'Enable Custom Color Scheme', 'beautyspot' ),
                'default' => 0
			),

            // CUSTOM THEME SKIN
			array(
				'id' => 'custom_theme_skin_info',
				'type' => 'info',
				'desc' => __( 'Add a name of your color scheme file. <strong>Your file must be located in "/library/css/skin"</strong>. For example.: If your file is called "vanilla.css", add "vanilla" to the following input (without quotes). If you are using the child theme (<strong>which is highly recommended</strong>), the "/library/css/skin" path is relative to child theme\'s root directory. Please refer to the documentation on how to create custom color schemes.', 'beautyspot' ),
				'required'  => array( 'enable_custom_theme_skin', "=", 1 ),
            ),
            array(
                'id' => 'custom_theme_skin_name',
				'type' => 'text',
				'title' => __( 'Custom Skin Name', 'beautyspot' ),
                'required'  => array( 'enable_custom_theme_skin', "=", 1 ),
			),

		),
	);

    /* -------------------------------------------------------------------------
        TYPOGRAPHY
    ------------------------------------------------------------------------- */

    $enable_google_fonts = $lsvr_theme_options && array_key_exists( 'enable_google_fonts', $lsvr_theme_options ) ? (bool) $lsvr_theme_options[ 'enable_google_fonts' ] : true;

	$this->sections[] = array(
        'title' => __( 'Typography', 'beautyspot' ),
		'icon' => 'el-icon-fontsize',
        'fields' => array(

            // ENABLE GOOGLE FONTS
            array(
                'id' => 'enable_google_fonts',
				'type' => 'switch',
				'title' => __( 'Enable Google Fonts', 'beautyspot' ),
                'default' => 1
			),

			// PRIMARY FONT
			array(
				'id'        => 'primary_font',
				'type'      => 'typography',
				'title'     => __( 'Primary Font', 'beautyspot' ),
				'subtitle'  => __( 'This is the default font.', 'beautyspot' ),
				'google'    => $enable_google_fonts,
				'all_styles' => true,
				'font-weight' => true,
				'font-style' => false,
				'line-height' => false,
				'text-align' => false,
				'subsets' => true,
				'color' => false,
				'default'   => array(
					'font-size'     => '16px',
					'font-weight'     => '400',
					'font-family'   => 'Source Sans Pro',
				),
				'required'  => array( 'enable_google_fonts', "=", 1 ),
			),

			// SECONDARY FONT
			array(
				'id'        => 'secondary_font',
				'type'      => 'typography',
				'title'     => __( 'Secondary Font', 'beautyspot' ),
				'subtitle'  => __( 'This font is used mainly for headings.', 'beautyspot' ),
				'google'    => $enable_google_fonts,
				'all_styles' => true,
				'font-size' => false,
				'font-weight' => true,
				'font-style' => false,
				'line-height' => false,
				'text-align' => false,
				'subsets' => true,
				'color' => false,
				'default'   => array(
					'font-weight'   => '700',
					'font-family'   => 'Montserrat',
				),
				'required'  => array( 'enable_google_fonts', "=", 1 ),
			),

		),
	);

	$this->sections[] = array(
		'type' => 'divide',
	);

    /* -------------------------------------------------------------------------
        BLOG
    ------------------------------------------------------------------------- */

	$this->sections[] = array(
        'title' => __( 'Blog', 'beautyspot' ),
		'icon' => 'el-icon-pencil',
        'fields' => array(

			// ENABLE AUTHOR ON LIST
            array(
                'id' => 'blog_list_enable_author',
				'type' => 'switch',
				'title' => __( 'Show Post Author in Blog List', 'beautyspot' ),
                'default' => 0,
			),

			// ENABLE AUTHOR BIO IN DETAIL
            array(
                'id' => 'blog_detail_enable_author_bio',
				'type' => 'switch',
				'title' => __( 'Show Author Bio in Blog Detail', 'beautyspot' ),
                'default' => 0,
			),


		)
    );

    /* -------------------------------------------------------------------------
        PAGES
    ------------------------------------------------------------------------- */

	$this->sections[] = array(
        'title' => __( 'Pages', 'beautyspot' ),
		'icon' => 'el-icon-file',
        'fields' => array(

			// ENABLE HOME LINK IN BREADCRUMBS
            array(
                'id' => 'breadcrumbs_home_enable',
				'type' => 'switch',
				'title' => __( 'Enable "Home" link in page breadcrumbs', 'beautyspot' ),
                'default' => 1,
			),

			// HOME LINK LABEL
            array(
                'id' => 'breadcrumbs_home_label',
				'type' => 'text',
				'title' => __( '"Home" link label', 'beautyspot' ),
				'default' => __( 'Home', 'beautyspot' ),
				'required'  => array( 'breadcrumbs_home_enable', "=", 1 ),
			),

		)
    );

    /* -------------------------------------------------------------------------
        SIDEBARS
    ------------------------------------------------------------------------- */

	$this->sections[] = array(
        'title' => __( 'Custom Sidebars', 'beautyspot' ),
		'icon' => 'el-icon-puzzle',
        'fields' => array(

			// INFO
			array(
				'id' => 'sidebars_info',
				'type' => 'info',
				'desc' => __( 'This theme supports <strong>up to 10 custom sidebars</strong>. Any of those sidebars (including Default Sidebar) can be assigned to any page. To use a custom sidebar you need to enable it first. Then go to "Appearance / Widgets" and insert any number of widgets to it. The final step is to assign your new sidebar to a page using "Sidebar Name" selectbox when editing a page.', 'beautyspot' ),
            ),

			array(
				'id'   => 'sidebars_divider_10',
				'type' => 'divide'
			),

			// ENABLE SIDEBAR 1
            array(
                'id' => 'enable_sidebar_1',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar 1', 'beautyspot' ),
                'default' => 1
			),

			// SIDEBAR 1 NAME
            array(
                'id' => 'sidebar_1_name',
				'type' => 'text',
				'title' => __( 'Sidebar 1 Name', 'beautyspot' ),
                'default' => 'Custom Sidebar 1',
				'required'  => array( 'enable_sidebar_1', "=", 1 ),
			),

			array(
				'id'   => 'sidebars_divider_20',
				'type' => 'divide'
			),

			// ENABLE SIDEBAR 2
            array(
                'id' => 'enable_sidebar_2',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar 2', 'beautyspot' ),
                'default' => 0
			),

			// SIDEBAR 2 NAME
            array(
                'id' => 'sidebar_2_name',
				'type' => 'text',
				'title' => __( 'Sidebar 2 Name', 'beautyspot' ),
                'default' => 'Custom Sidebar 2',
				'required'  => array( 'enable_sidebar_2', "=", 1 ),
			),

			array(
				'id'   => 'sidebars_divider_30',
				'type' => 'divide'
			),

			// ENABLE SIDEBAR 3
            array(
                'id' => 'enable_sidebar_3',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar 3', 'beautyspot' ),
                'default' => 0
			),

			// SIDEBAR 3 NAME
            array(
                'id' => 'sidebar_3_name',
				'type' => 'text',
				'title' => __( 'Sidebar 3 Name', 'beautyspot' ),
                'default' => 'Custom Sidebar 3',
				'required'  => array( 'enable_sidebar_3', "=", 1 ),
			),

			array(
				'id'   => 'sidebars_divider_40',
				'type' => 'divide'
			),

			// ENABLE SIDEBAR 4
            array(
                'id' => 'enable_sidebar_4',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar 4', 'beautyspot' ),
                'default' => 0
			),

			// SIDEBAR 4 NAME
            array(
                'id' => 'sidebar_4_name',
				'type' => 'text',
				'title' => __( 'Sidebar 4 Name', 'beautyspot' ),
                'default' => 'Custom Sidebar 4',
				'required'  => array( 'enable_sidebar_4', "=", 1 ),
			),

			array(
				'id'   => 'sidebars_divider_50',
				'type' => 'divide'
			),

			// ENABLE SIDEBAR 5
            array(
                'id' => 'enable_sidebar_5',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar 5', 'beautyspot' ),
                'default' => 0
			),

			// SIDEBAR 5 NAME
            array(
                'id' => 'sidebar_5_name',
				'type' => 'text',
				'title' => __( 'Sidebar 5 Name', 'beautyspot' ),
                'default' => 'Custom Sidebar 5',
				'required'  => array( 'enable_sidebar_5', "=", 1 ),
			),

			array(
				'id'   => 'sidebars_divider_60',
				'type' => 'divide'
			),

			// ENABLE SIDEBAR 6
            array(
                'id' => 'enable_sidebar_6',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar 6', 'beautyspot' ),
                'default' => 0
			),

			// SIDEBAR 6 NAME
            array(
                'id' => 'sidebar_6_name',
				'type' => 'text',
				'title' => __( 'Sidebar 6 Name', 'beautyspot' ),
                'default' => 'Custom Sidebar 6',
				'required'  => array( 'enable_sidebar_6', "=", 1 ),
			),

			array(
				'id'   => 'sidebars_divider_70',
				'type' => 'divide'
			),

			// ENABLE SIDEBAR 7
            array(
                'id' => 'enable_sidebar_7',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar 7', 'beautyspot' ),
                'default' => 0
			),

			// SIDEBAR 7 NAME
            array(
                'id' => 'sidebar_7_name',
				'type' => 'text',
				'title' => __( 'Sidebar 7 Name', 'beautyspot' ),
                'default' => 'Custom Sidebar 7',
				'required'  => array( 'enable_sidebar_7', "=", 1 ),
			),

			array(
				'id'   => 'sidebars_divider_80',
				'type' => 'divide'
			),

			// ENABLE SIDEBAR 8
            array(
                'id' => 'enable_sidebar_8',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar 8', 'beautyspot' ),
                'default' => 0
			),

			// SIDEBAR 8 NAME
            array(
                'id' => 'sidebar_8_name',
				'type' => 'text',
				'title' => __( 'Sidebar 8 Name', 'beautyspot' ),
                'default' => 'Custom Sidebar 8',
				'required'  => array( 'enable_sidebar_8', "=", 1 ),
			),

			array(
				'id'   => 'sidebars_divider_90',
				'type' => 'divide'
			),

			// ENABLE SIDEBAR 9
            array(
                'id' => 'enable_sidebar_9',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar 9', 'beautyspot' ),
                'default' => 0
			),

			// SIDEBAR 9 NAME
            array(
                'id' => 'sidebar_9_name',
				'type' => 'text',
				'title' => __( 'Sidebar 9 Name', 'beautyspot' ),
                'default' => 'Custom Sidebar 9',
				'required'  => array( 'enable_sidebar_9', "=", 1 ),
			),

			array(
				'id'   => 'sidebars_divider_100',
				'type' => 'divide'
			),

			// ENABLE SIDEBAR 10
            array(
                'id' => 'enable_sidebar_10',
				'type' => 'switch',
				'title' => __( 'Enable Sidebar 10', 'beautyspot' ),
                'default' => 0
			),

			// SIDEBAR 10 NAME
            array(
                'id' => 'sidebar_10_name',
				'type' => 'text',
				'title' => __( 'Sidebar 10 Name', 'beautyspot' ),
                'default' => 'Custom Sidebar 10',
				'required'  => array( 'enable_sidebar_10', "=", 1 ),
			),

		)
    );

    /* -------------------------------------------------------------------------
        PAGE 404
    ------------------------------------------------------------------------- */

	$this->sections[] = array(
        'title' => __( 'Page 404', 'beautyspot' ),
		'icon' => 'el-icon-minus-sign',
        'fields' => array(

			// PAGE TITLE
            array(
                'id' => 'page404_title',
				'type' => 'text',
				'title' => __( 'Title', 'beautyspot' ),
                'default' => __( '<span>404</span> Sorry, page not found.', 'beautyspot' ),
			),

			// PAGE SUBTITLE
            array(
                'id' => 'page404_subtitle',
				'type' => 'text',
				'title' => __( 'Subtitle', 'beautyspot' ),
                'default' => __( 'The page you are looking for is no longer available or has been moved.', 'beautyspot' ),
			),

            // PAGE 404 BACKGROUND IMAGE
            array(
                'id' => 'page404_bg_image',
				'type' => 'media',
				'title' => __( 'Background Image', 'beautyspot' ),
			),

			// ENABLE SEARCH
            array(
                'id' => 'page404_enable_search',
				'type' => 'switch',
				'title' => __( 'Display Search Form', 'beautyspot' ),
                'default' => 1,
			),


		)
    );

    /* -------------------------------------------------------------------------
        RESERVATION FORM
    ------------------------------------------------------------------------- */

	$this->sections[] = array(
        'title' => __( 'Reservation Form', 'beautyspot' ),
		'icon' => 'el-icon-envelope',
        'fields' => array(

			// INFO
			array(
				'id' => 'resform_info',
				'type' => 'info',
				'desc' => __( '<strong>Contact Form 7</strong> plugin must be installed for Reservation Form to work. You can <strong>open the Reservation Form with any link</strong> by adding "#reservation-form" to its URL. You can also <strong>enable the Reservation Form button in Main Sidebar</strong> under "Main Sidebar" section of Theme Options.', 'beautyspot' ),
            ),

            // RESERVATION FORM SC
            array(
                'id' => 'resform_shortcode',
				'type' => 'text',
				'title' => __( 'Form Shortcode', 'beautyspot' ),
				'subtitle' => __( 'Create a form under "Contact" and add its shortcode (e.g [contact-form-7 id="1828"]) to this field.', 'beautyspot' ),
                'default' => ''
			),

		)
    );

    /* -------------------------------------------------------------------------
        TWITTER FEED
    ------------------------------------------------------------------------- */

    $this->sections[] = array(
        'title' => __( 'Twitter', 'beautyspot' ),
		'icon' => 'el-icon-twitter',
        'fields' => array(

			// INFO
			array(
				'id' => 'twitter_info',
				'type' => 'info',
				'desc' => __( 'You will have to create your own Twitter App first. Please refer to the documentation for more info on Twitter feed.', 'beautyspot' ),
            ),

            // ENABLE TWITTER FEED
            array(
                'id' => 'enable_twitter_feed',
				'type' => 'switch',
				'title' => __( 'Enable Twitter Feed', 'beautyspot' ),
                'default' => 0
			),

            // CONSUMER KEY
            array(
                'id' => 'twitter_consumer_key',
				'type' => 'text',
				'title' => __( 'Consumer Key', 'beautyspot' ),
                'default' => '',
                'required'  => array( 'enable_twitter_feed', "=", 1 ),
			),

            // CONSUMER SECRET
            array(
                'id' => 'twitter_consumer_secret',
				'type' => 'text',
				'title' => __( 'Consumer Secret', 'beautyspot' ),
                'default' => '',
                'required'  => array( 'enable_twitter_feed', "=", 1 ),
			),

            // ACCESS TOKEN
            array(
                'id' => 'twitter_access_token',
				'type' => 'text',
				'title' => __( 'Access Token', 'beautyspot' ),
                'default' => '',
                'required'  => array( 'enable_twitter_feed', "=", 1 ),
			),

            // ACCESS TOKEN SECRET
            array(
                'id' => 'twitter_access_token_secret',
				'type' => 'text',
				'title' => __( 'Access Token Secret', 'beautyspot' ),
                'default' => '',
                'required'  => array( 'enable_twitter_feed', "=", 1 ),
			),

            // FEED TITLE
            array(
                'id' => 'twitter_feed_title',
				'type' => 'text',
				'title' => __( 'Feed Title', 'beautyspot' ),
                'default' => __( 'Twitter Feed', 'beautyspot' ),
                'required'  => array( 'enable_twitter_feed', "=", 1 ),
			),

            // USER NAME
            array(
                'id' => 'twitter_feed_username',
				'type' => 'text',
				'title' => __( 'Username', 'beautyspot' ),
                'default' => '',
                'required'  => array( 'enable_twitter_feed', "=", 1 ),
			),

            // NUMBER OF TWEETS
            array(
                'id' => 'twitter_feed_count',
				'type' => 'slider',
				'title' => __( 'Number of Tweets', 'beautyspot' ),
                'default' => '1',
                'min' => '1',
                'step' => '1',
                'max' => '10',
                'required'  => array( 'enable_twitter_feed', "=", 1 ),
			),

            // PAGINATED FEED
            array(
                'id' => 'twitter_feed_paginated',
				'type' => 'switch',
				'title' => __( 'Paginated Feed', 'beautyspot' ),
                'default' => 1,
                'required'  => array( 'enable_twitter_feed', "=", 1 ),
			),

            // SPEED
            array(
                'id' => 'twitter_feed_autoplay_speed',
				'type' => 'slider',
				'title' => __( 'Autoplay Speed (in Seconds)', 'beautyspot' ),
				'subtitle' => __( 'Set to 0 to disable autoplay.', 'beautyspot' ),
                'default' => '20',
                'min' => '0',
                'step' => '1',
                'max' => '60',
                'required'  => array( 'enable_twitter_feed', "=", 1 ),
			),

        )
    );

    /* -------------------------------------------------------------------------
        WOOCOMMERCE
    ------------------------------------------------------------------------- */

    $this->sections[] = array(
        'title' => __( 'Woocommerce', 'beautyspot' ),
		'icon' => 'el-icon-shopping-cart',
        'fields' => array(

            // ENABLE HEADER CART
            array(
                'id' => 'enable_header_cart',
				'type' => 'switch',
				'title' => __( 'Show Cart in Header', 'beautyspot' ),
                'default' => 1
			),

            // NUMBER OF PRODUCTS
            array(
                'id' => 'woo_index_products_per_page',
				'type' => 'slider',
				'title' => __( 'Products Per Page', 'beautyspot' ),
                'default' => '9',
                'min' => '1',
                'step' => '1',
                'max' => '30',
			),

        )
    );

	$this->sections[] = array(
		'type' => 'divide',
	);

    /* -------------------------------------------------------------------------
        CUSTOM CSS
    ------------------------------------------------------------------------- */

    $this->sections[] = array(
        'title' => __( 'Custom CSS/JS', 'beautyspot' ),
		'icon' => 'el-icon-cogs',
        'fields' => array(

			// CSS
			array(
				'id'        => 'custom_css_code',
				'type'      => 'ace_editor',
				'title'     => __( 'CSS Code', 'beautyspot' ),
				'subtitle'  => __( 'Paste your CSS code here.', 'beautyspot' ),
				'mode'      => 'css',
				'theme'     => 'chrome',
			),

			// JS
			array(
				'id'        => 'custom_js_code',
				'type'      => 'ace_editor',
				'title'     => __( 'JS Code', 'beautyspot' ),
				'subtitle'  => __( 'Paste your JS code here.', 'beautyspot' ),
				'mode'      => 'javascript',
				'theme'     => 'chrome',
			),

            // custom code
            array(
                'id' => 'custom_any_code',
				'type' => 'textarea',
				'title' => __( 'Any Custom Code', 'beautyspot' ),
                'subtitle' => __( 'This field can be used for adding any code which contains &lt;script&gt;&lt;/script&gt; tags. For example Google Analytics code.', 'beautyspot' )
			)

        )
    );

// SECTIONS END

            $theme_info  = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'beautyspot') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'beautyspot') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'beautyspot') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'beautyspot') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            if (file_exists(dirname(__FILE__) . '/../README.md')) {
                $this->sections['theme_docs'] = array(
                    'icon'      => 'el-icon-list-alt',
                    'title'     => __('Documentation', 'beautyspot'),
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
                'title'     => __('Import / Export', 'beautyspot'),
                'desc'      => __('Import and Export your Redux Framework settings from file, text or URL.', 'beautyspot'),
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
                'type' => 'divide',
            );

            $this->sections[] = array(
                'icon'      => 'el-icon-info-sign',
                'title'     => __('Theme Information', 'beautyspot'),
                //'desc'      => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'beautyspot'),
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
                    'title'     => __('Documentation', 'beautyspot'),
                    'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
                );
            }
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-1',
                'title'     => __('Theme Information 1', 'beautyspot'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'beautyspot')
            );

            $this->args['help_tabs'][] = array(
                'id'        => 'redux-help-tab-2',
                'title'     => __('Theme Information 2', 'beautyspot'),
                'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'beautyspot')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'beautyspot');
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name'          => 'theme_options',            // This is where your data is stored in the database and also becomes your global variable name.
                'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
                'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
                'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
                'menu_title'        => __('Theme Options', 'beautyspot'),
                'page_title'        => __('Theme Options', 'beautyspot'),

                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyDCOyIiq-EGJPTCJbrg2NeFDGd59ouIL3w', // Must be defined to add google fonts to the typography module

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


            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace('-', '_', $this->args['opt_name']);
                }
                //$this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'beautyspot'), $v);
            } else {
                //$this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'beautyspot');
            }

            // Add content after the form.
            //$this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'beautyspot');
        }

    }

    global $reduxConfig;
    $reduxConfig = new Redux_Framework_Beautyspot_config();
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
