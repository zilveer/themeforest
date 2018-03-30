<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://docs.reduxframework.com
 * */
if (!class_exists('Redux_Framework_sample_config')) {

    class Redux_Framework_sample_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {

            if (!class_exists('ReduxFramework')) {
                return;
            }

            // This is needed. Bah WordPress bugs.  ;)
            if (true == Redux_Helpers::isTheme(__FILE__)) {
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
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode('.', $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';

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

            //========================
            // General Section
            //========================
            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __('General Settings', 'redux-framework-demo'),
                'fields' => array(
                    array(
                        'id' => 'fav_url',
                        'type' => 'media',
                        'title' => __('Favicon Uploader', 'redux-framework-demo'),
                        'desc' => __('This represents the minimalistic view. It does not have the preview box or the display URL in an input box. ', 'redux-framework-demo'),
                        'subtitle' => __('Upload any media using the WordPress native uploader', 'redux-framework-demo'),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/img/favicon.ico'
                        )
                    ),
                    array(
                        'id'       => 'opt-switch',
                        'type'     => 'switch', 
                        'title'    => __('Day Option Setiing', 'redux-framework-demo'),
                        'subtitle' => __('Enable, Disbale', 'redux-framework-demo'),
                        'default'  => true,
                    ),
                    array(
                        'id' => 'google_tracking',
                        'type' => 'ace_editor',
                        'title' => __('Tracking Code', 'redux-framework-demo'),
                        'subtitle' => __('Paste your Google Analytics (or other) tracking code here. This will be added into the footer template of your theme.', 'redux-framework-demo'),
                        'mode' => 'javascript',
                        'validate' => 'javascript',
                        'desc' => 'Validate that it\'s javascript! N.B: Just paste your traking code without any script tag.'
                    ),
                    array(
                        'id' => 'custom_css',
                        'type' => 'ace_editor',
                        'title' => __('CSS Code', 'redux-framework-demo'),
                        'subtitle' => __('Paste your CSS code here.', 'redux-framework-demo'),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'desc' => '',
                        'default' => "#header{\nmargin: 0 auto;\n}"
                    ),
                )
            );
            //========================
            // Header Section
            //========================
            $this->sections[] = array(
                'title' => __('Header Settings', 'redux-framework-demo'),
                'icon' => 'el-icon-home',
                'fields' => array(
                    array(
                        'id' => 'logo_url',
                        'type' => 'media',
                        'title' => __('Logo Uploader', 'redux-framework-demo'),
                        'desc' => __('Upload Your Logo', 'redux-framework-demo'),
                        'subtitle' => __('Upload any media using the WordPress native uploader', 'redux-framework-demo'),
                    ),
					array(
                        'id' => 'inner_url',
                        'type' => 'media',
                        'title' => __('Inner Page Header Image Uploader', 'redux-framework-demo'),
                        'desc' => __('Upload Your Inner Page Header Image', 'redux-framework-demo'),
                        'subtitle' => __('Upload any media using the WordPress native uploader', 'redux-framework-demo'),
                    ),
                )
            );
            //========================
            // Color Preset Section
            //========================
            $this->sections[] = array(
                'title' => __('Preset Settings', 'redux-framework-demo'),
                'subtitle' => __('Be Careful to change the color, Because it will overwrite your default style', 'redux-framework-demo'),
                'icon' => 'el-icon-adjust-alt',
                'fields' => array(
                    array(
                        'id' => 'opt-color-rgba',
                        'type' => 'color_rgba',
                        'title' => __('Background Color RGBA', 'redux-framework-demo'),
                        'subtitle' => __('Gives you the RGBA color.', 'redux-framework-demo'),
                        'desc' => __('This Color Only Work in Background. Be Careful to change the color, Because it will overwrite your default style', 'redux-framework-demo'),
                        'default' => array(
                            'color' => '#00a99d',
                            'alpha' => '1.0'
                        ),
						'important' => true,
                        'output' => array('.modal.fade.portfoliomodal,.modal.fade.contact_form,.mfp-bg,.speaker figcaption,.contact,.venue-address,.button-dark:hover,.button-dark:active,#days .owl-item.synced .item:hover,#days .owl-item .item:hover,.top-nav-collapse,.price-table-header,.button-dark,.event .icon,#days .owl-item.synced .item,.price-table-description li:nth-child(even),.wpcf7-form .wpcf7-submit,.button-dark,#sponsors h3,ul.sub-menu,.blog-all article .blog-post-date .post-date,#about .blog-all article .button-holder a,.widget .tagcloud a,.pagination > li > a.inactive,.modal.fade.portfoliomodal.in,.navbar.navbar-fixed-top.navbar-custom.top-nav-collapse,.navbar-custom .navbar-toggle .icon-bar'),
                        'mode' => 'background-color',
                    ),                  
                    array(
                        'id' => 'text-color-rgba',
                        'type' => 'color_rgba',
                        'title' => __('Text Color RGBA', 'redux-framework-demo'),
                        'subtitle' => __('Gives you the RGBA color.', 'redux-framework-demo'),
                        'desc' => __('This Color Only Work in Text Color. Be Careful to change the color, Because it will overwrite your default style', 'redux-framework-demo'),
                        'default' => array(
                            'color' => '#00a99d',
                            'alpha' => '1.0'
                        ),
                        'output' => array('.button-light:hover,.button-light:active,.social .fa-inverse,#overview i,#venue i,#venue h3,#faq i,a:hover,#speaker-detail h3,#speaker-detail a,.event h3,.blog-all h2 a,.blog-all .entry-meta span a,.widget ul li:before,.widget.widget_archive ul li:before,.widget.widget_categories ul li:before,.widget.widget_meta ul li:before,.speaker-detail h3,.speaker-detail a'),
                        'mode' => 'color',
                    ),
					array(
                        'id' => 'border-color-rgba',
                        'type' => 'color_rgba',
                        'title' => __('Border And Preloader Color', 'redux-framework-demo'),
                        'subtitle' => __('Gives you the RGBA color.', 'redux-framework-demo'),
                        'desc' => __('This Color Only Work in Border Color. Be Careful to change the color, Because it will overwrite your default style', 'redux-framework-demo'),
                        'default' => array(
                            'color' => '#00a99d',
                            'alpha' => '1.0'
                        ),
                        'output' => array('.blog-all article.stand .blog-post-date,.widget input,.widget input.search-submit,.blog-all article,.blog-all img, .blog-all iframe'),
                        'mode' => 'border-color',
                    ),
					array(
                        'id' => 'border-color-rgba',
                        'type' => 'color_rgba',
                        'title' => __('Border And Preloader Color', 'redux-framework-demo'),
                        'subtitle' => __('Gives you the RGBA color.', 'redux-framework-demo'),
                        'desc' => __('This Color Only Work in Border Color. Be Careful to change the color, Because it will overwrite your default style', 'redux-framework-demo'),
                        'default' => array(
                            'color' => '#00a99d',
                            'alpha' => '1.0'
                        ),
                        'output' => array('.loader'),
                        'mode' => 'border-left-color',
                    ) 					
                )
            );
            //========================
            // Contact Section
            //========================
            $this->sections[] = array(
                'title' => __('Contact Settings', 'redux-framework-demo'),
                'icon' => 'el-icon-envelope',
                'fields' => array(
                    array(
                        'id' => 'contacts_title',
                        'type' => 'editor',
                        'title' => __('Contact Title', 'redux-framework-demo'),
                        'subtitle' => __('You can add your contact area title here.', 'redux-framework-demo'),
                        'default' => 'Please add your contact Area Title here.',
                        'args' => array(
                            'teeny' => true,
                            'textarea_rows' => 10
                        )
                    ),
                    array(
                        'id' => 'contacts_content',
                        'type' => 'editor',
                        'title' => __('Contact Content', 'redux-framework-demo'),
                        'subtitle' => __('You can add your contact area content here.', 'redux-framework-demo'),
                        'default' => 'Please add your contact area content here.',
                        'args' => array(
                            'teeny' => true,
                            'textarea_rows' => 10
                        )
                    ),
                    array(
                        'id' => 'contact_form_id',
                        'type' => 'text',
                        'title' => __('Contactform7 Id', 'redux-framework-demo'),
                        'subtitle' => __('Make sure you installed CONTACT FORM 7 plugin already. You can use your form shortcode here. For better view use contact-form7.', 'redux-framework-demo'),
                        'default' => '117'
                    ),
                    array(
                        'id' => 'contact_form_title',
                        'type' => 'text',
                        'title' => __('Contactform7 Title', 'redux-framework-demo'),
                        'subtitle' => __('Make sure you installed CONTACT FORM 7 plugin already. You can use your form shortcode here. For better view use contact-form7.', 'redux-framework-demo'),
                        'default' => 'Please add your contactform7 Title here.'
                    ),
                )
            );
            //========================
            // Social Section
            //========================
            $this->sections[] = array(
                'title' => __('Social Settings', 'redux-framework-demo'),
                'icon' => 'el-icon-thumbs-up',
                'fields' => array(
                    array(
                        'id' => 'facebook_url',
                        'type' => 'text',
                        'title' => __('Facebook URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Facebook URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.facebbok.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'twitter_url',
                        'type' => 'text',
                        'title' => __('Twitter URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Twitter URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.twitter.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'google_url',
                        'type' => 'text',
                        'title' => __('Google+ URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Google Plus URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.google.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'linkedin_url',
                        'type' => 'text',
                        'title' => __('LinkedIn URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your LinkedIn URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.linkedin.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'youtube_url',
                        'type' => 'text',
                        'title' => __('Youtube URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Youtube URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.youtube.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'dribble_url',
                        'type' => 'text',
                        'title' => __('Dribble URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Dribble URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.dribble.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'pin_url',
                        'type' => 'text',
                        'title' => __('Pinterest URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Pinterest URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.pinterest.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'vimeo_url',
                        'type' => 'text',
                        'title' => __('Vimeo URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Vimeo URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.vimeo.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'rss_url',
                        'type' => 'text',
                        'title' => __('RSS URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your RSS URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.rss.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'skype_url',
                        'type' => 'text',
                        'title' => __('Skype URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Skype URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.skype.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'github_url',
                        'type' => 'text',
                        'title' => __('GitHub URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your GitHub URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.github.io',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'behance_url',
                        'type' => 'text',
                        'title' => __('Behance URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Behance URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.behance.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'flickr_url',
                        'type' => 'text',
                        'title' => __('Flickr URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Flicker URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.flickr.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'dropbox_url',
                        'type' => 'text',
                        'title' => __('Dropbox URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Dropbox URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.dropbox.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'bitbucket_url',
                        'type' => 'text',
                        'title' => __('Bitbucket URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Bitbucket URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.bitbucket.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'instagram_url',
                        'type' => 'text',
                        'title' => __('Instagram URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Instagram URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.instagram.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'soundcloud_url',
                        'type' => 'text',
                        'title' => __('SoundCloud URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your SoundCloud URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://www.soundcloud.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'stack_url',
                        'type' => 'text',
                        'title' => __('Stack Overflow URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Stack Overflow URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://stackoverflow.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'wordpress_url',
                        'type' => 'text',
                        'title' => __('WordPress URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your WordPress URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://wordpress.org',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                    array(
                        'id' => 'tumblr_url',
                        'type' => 'text',
                        'title' => __('Tumblr URL - URL Validated', 'redux-framework-demo'),
                        'subtitle' => __('This must be a URL.', 'redux-framework-demo'),
                        'desc' => __('Insert Your Tumblr URL Here', 'redux-framework-demo'),
                        'validate' => 'url',
                        'default' => 'http://tumblr.com',
//                        'text_hint' => array(
//                            'title'     => '',
//                            'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
//                        )
                    ),
                )
            );
            //========================
            // Footer Section
            //========================
            $this->sections[] = array(
                'title' => __('Footer Settings', 'redux-framework-demo'),
                'icon' => 'el-icon-tasks',
                'fields' => array(
                    array(
                        'id' => 'map_lat',
                        'type' => 'text',
                        'title' => __('Add your Google Map Latitude', 'redux-framework-demo'),
                        'subtitle' => __('You need to add your google map Latitude info here.', 'redux-framework-demo'),
                        'desc' => __('You need to add your google map Latitude info here. Then you can see your google map properly', 'redux-framework-demo'),
                        'default' => '23.835027'
                    ),
                    array(
                        'id' => 'map_lng',
                        'type' => 'text',
                        'title' => __('Add your Google Map Longitude', 'redux-framework-demo'),
                        'subtitle' => __('You need to add your google map Longitude info here.', 'redux-framework-demo'),
                        'desc' => __('You need to add your google map Longitude info here. Then you can see your google map properly', 'redux-framework-demo'),
                        'default' => '90.368574'
                    ),
                    array(
                        'id' => 'map_zoom',
                        'type' => 'text',
                        'title' => __('Add your Google Map Zoom Properly', 'redux-framework-demo'),
                        'subtitle' => __('You need to add your google map Zooming info here. Make sure it\'s betwwen 1 to 18', 'redux-framework-demo'),
                        'desc' => __('You need to add your google map Zooming info here. Then you can see your google map properly', 'redux-framework-demo'),
                        'validate' => 'numeric',
                        'default' => '16'
                    ),
                    array(
                        'id' => 'map_marker_title',
                        'type' => 'text',
                        'title' => __('Add your Google Map marker title', 'redux-framework-demo'),
                        'subtitle' => __('You need to add your google map marker title info here.', 'redux-framework-demo'),
                        'desc' => __('You need to add your google map marker title info here. Then you can see your google map properly', 'redux-framework-demo'),
                        'default' => 'ThemeonLab'
                    ),
                    array(
                        'id' => 'map_marker_content',
                        'type' => 'text',
                        'title' => __('Add your Google Map marker content', 'redux-framework-demo'),
                        'subtitle' => __('You need to add your google map marker content here.', 'redux-framework-demo'),
                        'desc' => __('You need to add your google map marker content info here. Then you can see your google map properly', 'redux-framework-demo'),
                        'default' => 'Quality Template Provide'
                    ),
                    array(
                        'id' => 'title_info',
                        'type' => 'textarea',
                        'title' => __('Title', 'redux-framework-demo'),
                        'subtitle' => __('Please add your contact info title here.', 'redux-framework-demo'),
                        'desc' => __('Please add a title from here.', 'redux-framework-demo'),
                        'validate' => 'html_custom',
                        'default' => 'Contact info',
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
                    array(
                        'id' => 'contact_content',
                        'type' => 'editor',
                        'title' => __('Contact Content', 'redux-framework-demo'),
                        'subtitle' => __('You can add additional content for your footer area.', 'redux-framework-demo'),
                        'default' => 'Please add your content here.',
                        'args' => array(
                            'teeny' => true,
                            'textarea_rows' => 10
                        )
                    ),
                    array(
                        'id' => 'address_info',
                        'type' => 'textarea',
                        'title' => __('Address', 'redux-framework-demo'),
                        'subtitle' => __('Please add your address area here', 'redux-framework-demo'),
                        'desc' => __('This is the Address field, You can add additional info.', 'redux-framework-demo'),
                        'validate' => 'html_custom',
                        'default' => 'House No: 318, Road No: 08, Mirpur 1216, Dhaka, Bangladesh.',
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
                    array(
                        'id' => 'mail_info',
                        'type' => 'text',
                        'title' => __('Email', 'redux-framework-demo'),
                        'subtitle' => __('Please add your email here.', 'redux-framework-demo'),
                        'desc' => __('Please add valide email.', 'redux-framework-demo'),
                        'validate' => 'email',
                        'msg' => 'Please add a valide email',
                        'default' => 'support@themeonlab.com'
                    ),
                    array(
                        'id' => 'phone_info',
                        'type' => 'textarea',
                        'title' => __('Phone', 'redux-framework-demo'),
                        'subtitle' => __('Please add your contact number here.', 'redux-framework-demo'),
                        'desc' => __('Please add valide Phone Number.', 'redux-framework-demo'),
                        'validate' => 'html_custom',
                        'default' => '+88 015 5330 3953',
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
                    array(
                        'id' => 'footer_copyright',
                        'type' => 'ace_editor',
                        'title' => __('Copyright', 'redux-framework-demo'),
                        'subtitle' => __('Add your footer copyright text.', 'redux-framework-demo'),
                        'mode' => 'html',
                        'theme' => 'monokai',
                        'default' => 'Made from <i class="fa fa-music"></i> and <i class="fa fa-coffee"></i> by <a href="#">ThemeonLab</a>',
                        'desc' => __('Add your copyright text. For better result use html. I.e: Copyright <a href="#">Themeonlab</a>', 'redux-framework-demo')
                    ),
                )
            );
            //========================
            // Blog Section
            //========================
            $this->sections[] = array(
                'title' => __('Blog Settings', 'redux-framework-demo'),
                'icon' => 'el-icon-home-alt',
                'fields' => array(
                    array(
                        'id' => 'blog_title',
                        'type' => 'text',
                        'title' => __('Footer Copyright Text', 'redux-framework-demo'),
                        'subtitle' => __('You decide.', 'redux-framework-demo'),
                        'desc' => __('This field\'s default value was changed by a filter hook!', 'redux-framework-demo'),
                        'validate' => 'no_special_chars',
                        'str' => array(
                            'search' => ' ',
                            'replacement' => 'thisisaspace'
                        ),
                        'default' => 'Blog.'
                    ),
                    array(
                        'id' => 'blog_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => __('Blog Layout Style', 'redux-framework-demo'),
                        'subtitle' => __('Select Blog Layout. Choose between 1 or 3 style hover. Please be careful this option only work when you select the post page blog in Settings>Readings', 'redux-framework-demo'),
                        'options' => array(
                            '1' => array('alt' => '1 Column', 'img' => get_template_directory_uri() . '/img/blog1.png'),
                            '2' => array('alt' => '2 Column', 'img' => get_template_directory_uri() . '/img/blog2.png'),
                            '3' => array('alt' => '3 Column', 'img' => get_template_directory_uri() . '/img/blog3.png')
                        ),
                        'default' => '1'
                    ),
                )
            );
            //========================
            // Single Page Section
            //========================
            $this->sections[] = array(
                'title' => __('Single Page Settings', 'redux-framework-demo'),
                'icon' => 'el-icon-edit',
                'fields' => array(
                    array(
                        'id' => 'single_layout',
                        'type' => 'image_select',
                        'compiler' => true,
                        'title' => __('Single Page Layout', 'redux-framework-demo'),
                        'subtitle' => __('Select Single Page Layout. Choose between 1 or 3 style layout.', 'redux-framework-demo'),
                        'options' => array(
                            '1' => array('alt' => '1 Column', 'img' => get_template_directory_uri() . '/img/blog1.png'),
                            '2' => array('alt' => '2 Column', 'img' => get_template_directory_uri() . '/img/blog2.png'),
                            '3' => array('alt' => '3 Column', 'img' => get_template_directory_uri() . '/img/blog3.png')
                        ),
                        'default' => '1'
                    ),
                )
            );


            $theme_info = '<div class="redux-framework-section-desc">';
            $theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'redux-framework-demo') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'redux-framework-demo') . $this->theme->get('Author') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'redux-framework-demo') . $this->theme->get('Version') . '</p>';
            $theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
            $tabs = $this->theme->get('Tags');
            if (!empty($tabs)) {
                $theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'redux-framework-demo') . implode(', ', $tabs) . '</p>';
            }
            $theme_info .= '</div>';

            $this->sections[] = array(
                'icon' => 'el-icon-list-alt',
                'title' => __('Customizer Only', 'redux-framework-demo'),
                'desc' => __('<p class="description">This Section should be visible only in Customizer</p>', 'redux-framework-demo'),
                'customizer_only' => true,
                'fields' => array(
                    array(
                        'id' => 'opt-customizer-only',
                        'type' => 'select',
                        'title' => __('Customizer Only Option', 'redux-framework-demo'),
                        'subtitle' => __('The subtitle is NOT visible in customizer', 'redux-framework-demo'),
                        'desc' => __('The field desc is NOT visible in customizer.', 'redux-framework-demo'),
                        'customizer_only' => true,
                        //Must provide key => value pairs for select options
                        'options' => array(
                            '1' => 'Opt 1',
                            '2' => 'Opt 2',
                            '3' => 'Opt 3'
                        ),
                        'default' => '2'
                    ),
                )
            );

            $this->sections[] = array(
                'title' => __('Import / Export', 'redux-framework-demo'),
                'desc' => __('Import and Export your Redux Framework settings from file, text or URL.', 'redux-framework-demo'),
                'icon' => 'el-icon-refresh',
                'fields' => array(
                    array(
                        'id' => 'opt-import-export',
                        'type' => 'import_export',
                        'title' => 'Import Export',
                        'subtitle' => 'Save and restore your Redux options',
                        'full_width' => false,
                    ),
                ),
            );

            $this->sections[] = array(
                'icon' => 'el-icon-info-sign',
                'title' => __('Theme Information', 'redux-framework-demo'),
                'desc' => __('<p class="description">This is the Description. Again HTML is allowed</p>', 'redux-framework-demo'),
                'fields' => array(
                    array(
                        'id' => 'opt-raw-info',
                        'type' => 'raw',
                        'content' => $item_info,
                    )
                ),
            );
        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-help-tab-1',
                'title' => __('Theme Information 1', 'redux-framework-demo'),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
            );

            $this->args['help_tabs'][] = array(
                'id' => 'redux-help-tab-2',
                'title' => __('Theme Information 2', 'redux-framework-demo'),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
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
                'opt_name' => 'tlazya_evential',
                // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Evential Options', 'redux-framework-demo'),
                'page_title' => __('Evential Options', 'redux-framework-demo'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyC_RignYykkn6NOBd0ZvkTE8u7i_lqwR4s', // Must be defined to add google fonts to the typography module
                'async_typography' => true, // Use a asynchronous font on the front end or font string
                //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
                'admin_bar' => true, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
                //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => get_template_directory_uri() . '/img/redux.png', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                'show_import_export' => true, // Shows the Import/Export panel when not used as a field.
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'system_info' => false, // REMOVE
                // HINTS
                'hints' => array(
                    'icon' => 'icon-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'light',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => '',
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'mouseover',
                        ),
                        'hide' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'click mouseleave',
                        ),
                    ),
                )
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
            // $this->args['share_icons'][] = array(
            // 'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
            // 'title' => 'Visit us on GitHub',
            // 'icon'  => 'el-icon-github'
            // //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
            // );
            // $this->args['share_icons'][] = array(
            // 'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
            // 'title' => 'Like us on Facebook',
            // 'icon'  => 'el-icon-facebook'
            // );
            // $this->args['share_icons'][] = array(
            // 'url'   => 'http://twitter.com/reduxframework',
            // 'title' => 'Follow us on Twitter',
            // 'icon'  => 'el-icon-twitter'
            // );
            // $this->args['share_icons'][] = array(
            // 'url'   => 'http://www.linkedin.com/company/redux-framework',
            // 'title' => 'Find us on LinkedIn',
            // 'icon'  => 'el-icon-linkedin'
            // );
            // Panel Intro text -> before the form
            // if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
            // if (!empty($this->args['global_variable'])) {
            // $v = $this->args['global_variable'];
            // } else {
            // $v = str_replace('-', '_', $this->args['opt_name']);
            // }
            // $this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo'), $v);
            // } else {
            // $this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo');
            // }
            // // Add content after the form.
            // $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo');
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
