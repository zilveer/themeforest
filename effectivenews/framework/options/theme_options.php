<?php
/**
  ReduxFramework Sample Config File
  For full documentation, please visit: https://github.com/ReduxFramework/ReduxFramework/wiki
 * */
if (!class_exists("ReduxFramework")) {
    return;
}
                $opt_name = 'mom_options';
                if(defined('ICL_LANGUAGE_CODE')) {
			    $default_lang = explode('_',get_locale());
			    $default_lang = $default_lang[0];
			    $lang = explode('-',ICL_LANGUAGE_CODE);
                            $lang = $lang[0];
                    if ($lang != $default_lang && $lang != '') {
                        $opt_name = 'mom_options_'.$lang;
                    }
                }
if (!class_exists("Redux_Framework_goodnews_config")) {

    class Redux_Framework_goodnews_config {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
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
            add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
            // Function to test the compiler hook and demo CSS output.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2); 
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            // Dynamically add a section. Can be also used to modify sections/fields
            add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        /**

          This is a test function that will let you see when the compiler hook occurs.
          It only runs if a field	set with compiler=>true is changed.

         * */
        function compiler_action($options, $css) {
            //echo "<h1>The compiler hook has run!";
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
            $defaults['str_replace'] = "Testing filter hook!";

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2);
            }

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
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
                            $name = explode(".", $sample_patterns_file);
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
	    $mom_textdomain = 'theme';
            $img_path = MOM_URI .'/framework/options/momizat/images';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', $mom_textdomain), $this->theme->display('Name'));
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

                <h4>
            <?php echo $this->theme->display('Name'); ?>
                </h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', $mom_textdomain), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', $mom_textdomain), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . __('Tags', $mom_textdomain) . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
                <?php
                if ($this->theme->parent()) {
                    printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', $mom_textdomain), $this->theme->parent()->display('Name'));
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

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __('General Settings', $mom_textdomain),
                'fields' => array(
                   		array (
					'desc' => __('Select theme style full-width or fixed width', $mom_textdomain),
					'id' => 'theme_style',
					'type' => 'image_select',
					'options' => array (
						'' => $img_path .'/full.png',
						'boxed' => $img_path .'/boxed.png',
						'boxed2' => $img_path . '/boxed2.png',
						'boxed-content' => $img_path . '/boxed3.png',
					),
					'title' => __('Theme Style', $mom_textdomain),
				),

                                    array (
					'desc' => __('Select main layout', $mom_textdomain),
					'id' => 'main_layout',
					'type' => 'image_select',
					'options' => array (
						'right-sidebar' => $img_path .'/right_side.png',
						'left-sidebar' => $img_path .'/left_side.png',
						'both-sidebars-all' => $img_path .'/both.png',
						'both-sidebars-right' => $img_path .'/both_right.png',
						'both-sidebars-left' => $img_path .'/both_left.png',
					),
					'title' => __('Layout', $mom_textdomain),
					'default' => 'right-sidebar',
				),                                

                                array(
                                'id'=>'site_width',
                                'type' => 'select', 
                                'title' => __('ٍSite width for one sidebar layout:', 'framework'),
                                'default' => 'cat',
                                'options' => array(
                                                'narrow' => __('Narrow', 'framework'),
                                                'wide' => __('Wide', 'framework')
                                                ),
                                'default' => 'narrow',
                                ), 

				array (
					'id' => 'both_sidebars_same_width',
					'desc' => __('just work when each sidebar on a different side', $mom_textdomain),
					'type' => 'switch',
					'title' => __('Both sidebars in same width', $mom_textdomain),
					'default' => 0,
				),
				
				array (
					'id' => 'date_format',
					'desc' => __('Change date format click <a href="http://codex.wordpress.org/Formatting_Date_and_Time">here</a> to see hwo to change it', $mom_textdomain),
					'type' => 'text',
					'title' => __('Date Format', $mom_textdomain),
					'default' => 'F d, Y',
				),
				array (
					'id' => 'enable_responsive',
					'desc' => __('Enable or disable responsive', $mom_textdomain),
					'type' => 'switch',
					'title' => __('Enable Responsive', $mom_textdomain),
					'default' => 1,
				),
						array (
							'id' => 'using_timthumb',
							'desc' => __('Timthumb requirements <a href="http://www.momizat.com/theme/multinews/documentation/#tab-1405343203888-15-10" target="_blank">Here</a>', 'framework'),
							'type' => 'switch',
							'title' => __('Using Timthumb', 'framework'),
							'default' => 0,
							'on'        => __('Enable', 'framework'),
                        'off'       => __('Disable', 'framework')
						),

                                
				array (
					'id' => 'breadcrumb',
					'desc' => __('Enable or disable breadcrumb', $mom_textdomain),
					'type' => 'switch',
					'title' => __('Breadcrumb', $mom_textdomain),
					'default' => 1,
				),
				array (
					'id' => 'fade_imgs',
					'desc' => __('if enable this the images will fade in if it visible in viewbort', $mom_textdomain),
					'type' => 'switch',
					'title' => __('fade in images', $mom_textdomain),
					'default' => true,
				),
				array (
					'id' => 'post_format_icons',
					'desc' => __('if enable this you will see the post format icons on posts in Newsboxes, Categories and blog', $mom_textdomain),
					'type' => 'switch',
					'title' => __('Post format icons', $mom_textdomain),
					'default' => true,
				),
				array (
					'id' => 'scroll_top_bt',
					'desc' => __('Enable or disable Scroll to top button', $mom_textdomain),
					'type' => 'switch',
					'title' => __('Scroll to top button', $mom_textdomain),
					'default' => true,
				),
				array (
					'desc' => __('upload your favicon', $mom_textdomain),
					'id' => 'custom_favicon',
					'type' => 'media',
					'title' => __('favicon', $mom_textdomain),
					'url' => true,
				),

				array (
					'id' => 'apple_touch_icon',
					'type' => 'media',
					'title' => __('Apple Touch icon', $mom_textdomain),
					'subtitle' => __('This icon used for iOS system if user add your site to home page size must be 152x152', $mom_textdomain),
					'url' => true,
				),


				array (
					'id' => 'default_avatar',
					'type' => 'media',
					'title' => __('Default Avatar', $mom_textdomain),
                                        'subtitle' => __('you will see this if user don\'t have gravatar', $mom_textdomain),
					'desc' => __('upload your custom default avatar and select it from settings -> Discussion', $mom_textdomain),
					'url' => true,
				),

				array (
					'desc' => __('it can be google analytics or any Script code, it will be add before closing of body tag', $mom_textdomain),
					'id' => 'footer_script',
					'type' => 'textarea',
					'title' => __('Footer scripts', $mom_textdomain),
				),
				array (
					'desc' => __('We not recommend adding scripts in header for page speed purpose, but if you need to do this add your scripts hear  ', $mom_textdomain),
					'id' => 'header_script',
					'type' => 'textarea',
					'title' => __('Header scripts', $mom_textdomain),
				),
                )
            );
            
$this->sections[] = array(
		'icon' => 'el-icon-twitter',
		'title' => __('Social Networks', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
				array (
					'id' => 'twitter_url',
					'type' => 'text',
					'title' => 'Twitter',
					'default' => '#',
				),
				array (
					'id' => 'facebook_url',
					'type' => 'text',
					'title' => 'Facebook',
					'default' => '#',
				),
				array (
					'id' => 'gplus_url',
					'type' => 'text',
					'title' => 'Google+',
					'default' => '#',
				),
				array (
					'id' => 'linkedin_url',
					'type' => 'text',
					'title' => 'Linkedin',
					'default' => '#',
				),
				array (
					'id' => 'youtube_url',
					'type' => 'text',
					'title' => 'Youtube',
				),
				array (
					'id' => 'skype_url',
					'type' => 'text',
					'title' => 'Skype Name',
				),
				array (
					'id' => 'flickr_url',
					'type' => 'text',
					'title' => 'Flickr',
				),
				array (
					'id' => 'picasa_url',
					'type' => 'text',
					'title' => 'Picasa',
				),
				array (
					'id' => 'vimeo_url',
					'type' => 'text',
					'title' => 'vimeo',
				),
				array (
					'id' => 'tumblr_url',
					'type' => 'text',
					'title' => 'tumblr',
				),
				array (
					'id' => 'rss_on_off',
					'type' => 'checkbox',
					'title' => 'RSS',
				),
				array (
					'id' => 'rss_custom',
					'type' => 'text',
					'desc' => 'leave empty to use default rss link',
					'title' => 'Custom RSS URL',
				),

                    array(
                        'id' => 'custom_social_icons',
                        'type' => 'sicons',
                        'title' => __('Custom Social Icons', $mom_textdomain),
                        'subtitle' => __('need more? add your custom', $mom_textdomain),
                        'placeholder' => array(
                            'title' => __('name', $mom_textdomain),
                            'url' => __('URL', $mom_textdomain),
                        ),
                    ),
		)
	);
	    
$this->sections[] = array(
		'icon' => 'el-icon-folder-open',
		'title' => __('Category Settings', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                                    array (
					'desc' => __('This will apply for all Categories, if you leave it as none it will be same as the main layout', $mom_textdomain),
					'id' => 'cats_layout',
					'type' => 'image_select',
					'options' => array (
						'' => $img_path .'/none.png',
						'right-sidebar' => $img_path .'/right_side.png',
						'left-sidebar' => $img_path .'/left_side.png',
						'both-sidebars-all' => $img_path .'/both.png',
						'both-sidebars-right' => $img_path .'/both_right.png',
						'both-sidebars-left' => $img_path .'/both_left.png',
					),
					'title' => __('Categories Layout', $mom_textdomain),
					'default' => '',
				),   		    
                    array(
                        'id'        => 'cat-opt-info',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'success',
                        'title'     => __('Category Settings', $mom_textdomain),
                        'desc'      => __('this settings control in category page in general, you can overwrite this settings from each category edit page.', $mom_textdomain)
                    ),
                    
                    array(
                        'id'        => 'cat_slider',
                        'type'      => 'switch',
                        'title'     => __('Category Feature Slider', $mom_textdomain),
                        'subtitle'  => __('by enable this you will see feature slider on each category page', $mom_textdomain),
                        'default'   => 0,
                        'on'        => 'Enable',
                        'off'       => 'Disable',
                    ),
                    array(
                        'id'        => 'cat_slider_orderby',
                        'type'      => 'select',
                        'title'     => __('Slider Posts orderby ', $mom_textdomain),
                        'subtitle'  => __('it can be recent, popular, random or specific tag.', $mom_textdomain),
                        'required'  => array('cat_slider', '=', '1'),
                        'options'   => array(
                                             'recent' => __('Recent Posts', $mom_textdomain),
                                             'popular' => __('Popular Posts', $mom_textdomain),
                                            ),
                        'default'   => 'recent',
                    ),
                    array(
                        'id'            => 'cat_slider_count',
                        'type'          => 'slider',
                        'required'  => array('cat_slider', '=', '1'),
                        'title'         => __('Number of posts', $mom_textdomain),
                        'default'       => 7,
                        'min'           => -1,
                        'subtitle'          => __('-1 for show all posts', $mom_textdomain),
                        'step'          => 1,
                        'max'           => 50,
                        'display_value' => 'input'
                    ),                    
                    array(
                        'id'            => 'cat_slider_timeout',
                        'type'          => 'slider',
                        'required'  => array('cat_slider', '=', '1'),
                        'title'         => __('Timeout', $mom_textdomain),
                        'default'       => 4000,
                        'min'           => 1000,
                        'subtitle'          => __('time between each slide with ms', $mom_textdomain),
                        'step'          => 500,
                        'max'           => 10000,
                        'display_value' => 'input'
                    ),  
                    array(
                        'id'        => 'cat_slider_animation',
                        'type'      => 'select',
                        'title'     => __('Slider animation', $mom_textdomain),
                        'subtitle'  => __('transition between each slide.', $mom_textdomain),
                        'required'  => array('cat_slider', '=', '1'),
                        'options'   => array(
						"crossfade" => __('crossfade', 'framework'),
						"scroll" => __('scroll', 'framework'),
						"directscroll" => __('directscroll', 'framework'),
						"fade" => __('fade', 'framework'),
						"cover" => __('cover', 'framework'),
						"cover-fade" => __('cover-fade', 'framework'),
						"uncover" => __('uncover', 'framework'),
						"uncover-fade" => __('uncover-fade', 'framework'),
						"none" => __('none', 'framework'),
                                            ),
                        'default'   => 'crossfade',
                    ),                                        

                    array(
                        'id'            => 'cat_slider_ani_speed',
                        'type'          => 'slider',
                        'required'  => array('cat_slider', '=', '1'),
                        'title'         => __('Animation speed', $mom_textdomain),
                        'default'       => 600,
                        'min'           => 100,
                        'subtitle'          => __('Animation speed with ms', $mom_textdomain),
                        'step'          => 50,
                        'max'           => 2000,
                        'display_value' => 'input'
                    ),
                    
                    array(
                        'id'        => 'cat_slider_caption_style',
                        'type'      => 'select',
                        'title'     => __('Caption style', $mom_textdomain),
                        'subtitle'  => __('slider caption style.', $mom_textdomain),
                        'required'  => array('cat_slider', '=', '1'),
                        'options'   => array(
						"" => __('Style 1', 'framework'),
						"2" => __('Style 2', 'framework'),
                                            ),
                        'default'   => '',
                    ),                                        

                    array(
                        'id'        => 'cat_slider_nav_style',
                        'type'      => 'select',
                        'title'     => __('navigation style', $mom_textdomain),
                        'subtitle'  => __('slider caption style.', $mom_textdomain),
                        'required'  => array('cat_slider', '=', '1'),
                        'options'   => array(
						"bullets" => __('Bullets', 'framework'),
						"thumbs" => __('Thumbnails', 'framework'),
                                            ),
                        'default'   => 'bullets',
                    ),                                        

                    array(
                        'id'        => 'cat_layout',
                        'type'      => 'select',
                        'title'     => __('Posts Layout', $mom_textdomain),
                        'options'   => array(
						"m1" => __('Medium thumbnails', 'framework'),
						"m2" => __('Medium thumbnails 2', 'framework'),
						"l" => __('Large thumbnails', 'framework'),
						"g" => __('Grid', 'framework'),
						"t" => __('Timeline', 'framework'),
                                            ),
                        'default'   => 'm1',
                    ),
                    array(
                        'id'        => 'cat_share',
                        'type'      => 'switch',
                        'title'     => __('Share Icons', $mom_textdomain),
                        'subtitle'  => __('enable social share icons for each post, maybe caue some slowdown', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Enable',
                        'off'       => 'Disable',
                    ),                    
                    array(
                        'id'        => 'cat_sidebar',
                        'type'      => 'select',
                        'data'      => 'sidebars',
                        'title'     => __('Main Sidebar', 'framework'),
                    ),
                   
                    array(
                        'id'        => 'cat_sidebarl',
                        'type'      => 'select',
                        'data'      => 'sidebars',
                        'title'     => __('Secondary Sidebar', 'framework'),
                    ),
                    
                    array(
                        'id'        => 'cat_rss',
                        'type'      => 'switch',
                        'title'     => __('Category RSS', $mom_textdomain),
                        'subtitle'  => __('by enable this you will see small rss icon in the category breadcrumb by clicking on it you can see the category rss feed', $mom_textdomain),
                        'default'   => 0,
                        'on'        => 'Enable',
                        'off'       => 'Disable',
                    ),
                    array(
                        'id'        => 'category-ads-info',
                        'type'      => 'info',
                        'title'      => __('Ads', $mom_textdomain),
                        'desc' => __('this will be display between category posts', $mom_textdomain),
                    ),
				array (
					'id' => 'cat_ad_id',
					'type' => 'select',
					'data' => 'posts',
					'args' => array('post_type' => 'ads', 'posts_per_page' => -1, 'no_found_rows' => true, 'cache_results' => false),
    					'title' => __('Select Ad:', $mom_textdomain),
				),                   
				array (
					'id' => 'cat_ad_count',
					'type' => 'text',
					'default' => 3,
    					'title' => __('Display after x posts', $mom_textdomain),
    					'desc' => __('the number of posts to display ads after it. default is 3', $mom_textdomain),
				),                   
				array (
					'id' => 'cat_ad_repeat',
					'type' => 'switch',
					'default' => 0,
					'on'        => 'Yes',
					'off'       => 'No',
    					'title' => __('Repeat ad', $mom_textdomain),
    					'desc' => __('display the ad again after x posts', $mom_textdomain),
				),                   
		)
	);

$this->sections[] = array(
		'icon' => 'momizat-icon-file3',
		'title' => __('Post Settings', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                    array(
                        'id'        => 'post-opt-info',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'success',
                        'title'     => __('Post Settings', $mom_textdomain),
                        'desc'      => __('this settings control in all posts in general, you can overwrite this settings from each Post, note: most of this options works in single post only.', $mom_textdomain)
                    ),
                                    array (
					'desc' => __('This will apply for all posts, if you leave it as none it will be same as the main layout', $mom_textdomain),
					'id' => 'posts_layout',
					'type' => 'image_select',
					'options' => array (
						'' => $img_path .'/none.png',
						'right-sidebar' => $img_path .'/right_side.png',
						'left-sidebar' => $img_path .'/left_side.png',
						'both-sidebars-all' => $img_path .'/both.png',
						'both-sidebars-right' => $img_path .'/both_right.png',
						'both-sidebars-left' => $img_path .'/both_left.png',
						'fullwidth' => $img_path .'/full.png',
					),
					'title' => __('Posts Layout', $mom_textdomain),
					'default' => '',
				), 
                    array (
                            'id' => 'post_first_image',
                            'desc' => __('if you enable this, the post automatically use the first image in the post as feature image, if you don\'t upload feature image', $mom_textdomain),
                            'type' => 'switch',
                            'title' => __('Use first image as feature image', $mom_textdomain),
                            'default' => 0,
                            'on'        => 'Yes',
                            'off'       => 'No',
                    ),
                    
                     array(
                        'id'        => 'post_full_post',
                        'type'      => 'switch',
                        'title'     => __('Show full Post', $mom_textdomain),
                        'default'   => 0,
                        'on'        => 'Enable',
                        'off'       => 'Disable',
                        'desc'      => __('this option works only in blog and category, default is show excerpt or some text from the content, by enable this you can see the full post unless you use < !-- more -- > tag .', $mom_textdomain)
                    ),
                                         
                     array(
                        'id'        => 'post_feature',
                        'type'      => 'switch',
                        'title'     => __('Post feature area', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),
                     
                     array(
                        'id'        => 'post_tags',
                        'type'      => 'switch',
                        'title'     => __('Tags', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),
		     
		    array(
                        'id'        => 'post_share',
                        'type'      => 'switch',
                        'title'     => __('post Share icons', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),  
		     
                     array(
                        'id'        => 'post_np',
                        'type'      => 'switch',
                        'title'     => __('Next and previous post', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),  
                    
                     array(
                        'id'        => 'post_ab',
                        'type'      => 'switch',
                        'title'     => __('Author box', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),  

                     array(
                        'id'        => 'post_rp',
                        'type'      => 'switch',
                        'title'     => __('Related posts', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),
				array (
					'id' => 'post_rp_by',
					'type' => 'select',
                                        'default' => 'category',
                                        'required'  => array('post_rp', '=', 1),
					'title' => __('Related posts by', $mom_textdomain),
                                        'options' => array(
                                            'category' => __('Category', $mom_textdomain),
                                            'tags' => __('Tag', $mom_textdomain)
                                        )
				),                        


                     array(
                        'id'        => 'post_dc',
                        'type'      => 'switch',
                        'title'     => __('Disable comments', $mom_textdomain),
                        'subtitle'     => __('Completely disable post comments', $mom_textdomain),
                        'default'   => 0,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),  

                     array(
                        'id'        => 'post_cn',
                        'type'      => 'switch',
                        'title'     => __('Threaded Comments Numbering', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),  

                    array(
                        'id'        => 'post-meta-info',
                        'type'      => 'info',
                        'title'      => __('Post Meta', $mom_textdomain),
                    ),
		     array(
                        'id'        => 'post_share_facebook',
                        'type'      => 'switch',
                        'title'     => __('Facebook', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),

                    array(
                        'id'        => 'post_share_facebook_count',
                        'type'      => 'radio',
                        'title'     => __('Facebook Count', $mom_textdomain),
                        'required'  => array('post_share_facebook', '=', 1),
                        'default'   => 'share',
			'options'   => array(
			  'share' => __('Share Count', $mom_textdomain),
			  'like' => __('Like Count', $mom_textdomain),
			  'both' => __('Share + like', $mom_textdomain),
			),

                    ),
		    
                    array(
                        'id'        => 'post_share_twitter',
                        'type'      => 'switch',
                        'title'     => __('Twitter', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),

                    array(
                        'id'        => 'post_share_google',
                        'type'      => 'switch',
                        'title'     => __('Google+', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),
		    
                    array(
                        'id'        => 'post_share_linkedin',
                        'type'      => 'switch',
                        'title'     => __('Linkedin', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),		    
                    array(
                        'id'        => 'post_share_pin',
                        'type'      => 'switch',
                        'title'     => __('Pinterest', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),
                    array(
                        'id'        => 'post_meta-author',
                        'type'      => 'switch',
                        'title'     => __('Author', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ), 
                    array(
                        'id'        => 'post_meta-date',
                        'type'      => 'switch',
                        'title'     => __('Date', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ), 
                    array(
                        'id'        => 'post_meta-cat',
                        'type'      => 'switch',
                        'title'     => __('Category', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ), 
                    array(
                        'id'        => 'post_meta-comments',
                        'type'      => 'switch',
                        'title'     => __('Comments', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),
		    
                    array(
                        'id'        => 'post-sidebars-info',
                        'type'      => 'info',
                        'title'      => __('Post custom Sidebars', $mom_textdomain),
                        'desc'      => __('this will be apply for all posts, you can customize it for each post ', $mom_textdomain),
                    ),
                    
                    array(
                        'id'        => 'post_right_sidebar',
                        'type'      => 'select',
                        'data'      => 'sidebars',
                        'title'     => __('Main Sidebar', 'framework'),
                    ),
                   
                    array(
                        'id'        => 'post_left_sidebar',
                        'type'      => 'select',
                        'data'      => 'sidebars',
                        'title'     => __('Secondary Sidebar', 'framework'),
                    ),
                    

                    array(
                        'id'        => 'post-ads-info',
                        'type'      => 'info',
                        'title'      => __('Post Ads', $mom_textdomain),
                    ),

				array (
					'id' => 'post_top_ad',
					'type' => 'select',
					'data' => 'posts',
					'args' => array('post_type' => 'ads', 'posts_per_page' => -1, 'no_found_rows' => true, 'cache_results' => false),
    					'title' => __('Top ad', $mom_textdomain),
				),

				array (
					'id' => 'post_bottom_content_ad',
					'type' => 'select',
					'data' => 'posts',
					'args' => array('post_type' => 'ads', 'posts_per_page' => -1, 'no_found_rows' => true, 'cache_results' => false),
    					'title' => __('Content bottom ad', $mom_textdomain),
				),

				array (
					'id' => 'post_bottom_ad',
					'type' => 'select',
					'data' => 'posts',
					'args' => array('post_type' => 'ads', 'posts_per_page' => -1, 'no_found_rows' => true, 'cache_results' => false),
    					'title' => __('Bottom ad', $mom_textdomain),
				),

                    
                )
	);
$this->sections[] = array(
		'icon' => 'steady-icon-user',
		'title' => __('Author page Settings', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                    array(
                        'id'        => 'author-opt-info',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'success',
                        'title'     => __('Author Page Settings', $mom_textdomain),
                        'desc'      => __('this settings control in Author page, each author can overwrite this settings from author settings', $mom_textdomain)
                    ),
                    
                    array (
					'id' => 'author_bg',
					'subtitle' => __('default author background', $mom_textdomain),
					'type' => 'media',
					'title' => __('author background', $mom_textdomain),
					'url' => true,
			),
                    array(
                        'id'        => 'author_layout',
                        'type'      => 'select',
                        'title'     => __('Posts Layout', $mom_textdomain),
                        'options'   => array(
						"m1" => __('Medium thumbnails', 'framework'),
						"m2" => __('Medium thumbnails 2', 'framework'),
						"l" => __('Large thumbnails', 'framework'),
						"g" => __('Grid', 'framework'),
						"t" => __('Timeline', 'framework'),
                                            ),
                        'default'   => 'm1',
                    ),                    
                     array(
                        'id'        => 'author_np',
                        'type'      => 'switch',
                        'title'     => __('Number of Author posts', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Show',
                        'off'       => 'Hide',
                    ),

                    array(
                        'id'        => 'author_sidebar',
                        'type'      => 'select',
                        'data'      => 'sidebars',
                        'title'     => __('Main Sidebar', 'framework'),
                    ),
                   
                    array(
                        'id'        => 'author_sidebarl',
                        'type'      => 'select',
                        'data'      => 'sidebars',
                        'title'     => __('Secondary Sidebar', 'framework'),
                    ),

                )
	);

$this->sections[] = array(
		'icon' => 'el-icon-search',
		'title' => __('Search Page Settings', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                    array(
                        'id'        => 'search-opt-info',
                        'type'      => 'info',
                        'notice'    => true,
                        'style'     => 'success',
                        'title'     => __('Search Settings', $mom_textdomain),
                        'desc'      => __('this settings control in Search page.', $mom_textdomain)
                    ),
                     array(
                        'id'        => 'search_breadcrumbs',
                        'type'      => 'switch',
                        'title'     => __('Search Page breadcrmbs', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Enable',
                        'off'       => 'Disable',
                    ),                    
                     array(
                        'id'        => 'search_advanced',
                        'type'      => 'switch',
                        'title'     => __('Advanced Search', $mom_textdomain),
                        'subtitle'  => __('advanced search give you ability to filter your search results with various ways', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Enable',
                        'off'       => 'Disable',
                    ),
                     
                    array(
                        'id'        => 'search_style',
                        'type'      => 'select',
                        'title'     => __('Posts Style', 'framework'),
                        'options' => array(
                            'list' => 'List',
                            'blog' => 'Blog posts'
                        ),
                    ),
			array (
                                'id' => 'search_count',
                                'title' => __('Number of Posts per page', $mom_textdomain),
                                'step' => '1',
                                'min' => '1',
                                'max' => '50',
                                'type' => 'slider',
                                'default' => '10',
			),
                        
		)
	);
if (function_exists('is_bbpress')) {
	$this->sections[] = array(
		'icon' => 'fa-icon-comments-alt',
		'title' => __('bbPress settings', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                            array (
                                'desc' => __('Select main layout', $mom_textdomain),
                                'id' => 'bbpress_layout',
                                'type' => 'image_select',
                                'options' => array (
                                        'right-sidebar' => $img_path .'/right_side.png',
                                        'left-sidebar' => $img_path .'/left_side.png',
                                        'both-sidebars-all' => $img_path .'/both.png',
                                        'both-sidebars-right' => $img_path .'/both_right.png',
                                        'both-sidebars-left' => $img_path .'/both_left.png',
                                        'fullwidth' => $img_path .'/full.png',
                                ),
                                'title' => __('Layout', $mom_textdomain),
                                'default' => 'right-sidebar',
                        ),
                            
                    array(
                        'id'        => 'bbpress_right_sidebar',
                        'type'      => 'select',
                        'data'      => 'sidebars',
                        'title'     => __('Main Sidebar', 'framework'),
                    ),
                   
                    array(
                        'id'        => 'bbpress_left_sidebar',
                        'type'      => 'select',
                        'data'      => 'sidebars',
                        'title'     => __('Secondary Sidebar', 'framework'),
                    ),
  		)
	);
}


if (function_exists('is_buddypress')) {
	$this->sections[] = array(
		'icon' => 'fa-icon-comments-alt',
		'title' => __('buddypress settings', 'framework'),
                'subsection' => true,
		'fields' => array(
                            array (
                                'desc' => __('Select main layout', 'framework'),
                                'id' => 'buddypress_layout',
                                'type' => 'image_select',
                                'options' => array (
                                        'right-sidebar' => $img_path .'/right_side.png',
                                        'left-sidebar' => $img_path .'/left_side.png',
                                        'both-sidebars-all' => $img_path .'/both.png',
                                        'both-sidebars-right' => $img_path .'/both_right.png',
                                        'both-sidebars-left' => $img_path .'/both_left.png',
                                        'fullwidth' => $img_path .'/full.png',
                                                                        
                                ),
                                'title' => __('Layout', 'framework'),
                                'default' => 'right-sidebar',
                        ),
                            
                    array(
                        'id'        => 'buddypress_right_sidebar',
                        'type'      => 'select',
                        'data'      => 'sidebars',
                        'title'     => __('Main Sidebar', 'framework'),
                    ),
                   
                    array(
                        'id'        => 'buddypress_left_sidebar',
                        'type'      => 'select',
                        'data'      => 'sidebars',
                        'title'     => __('Secondary Sidebar', 'framework'),
                    ),
  		)
	);
}


if (class_exists('woocommerce')) {
	$this->sections[] = array(
		'icon' => 'fa-icon-shopping-cart',
		'title' => __('Woocommerce settings', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
				array (
					'id' => 'woo_products_per_page',
					'desc' => __('-1 for all products', $mom_textdomain),
					'step' => '1',
					'min' => '-1',
					'max' => '50',
					'suffix' => 'px',
					'type' => 'slider',
					'title' => __('Number of products per page', $mom_textdomain),
					'default' => '9',
				),
				array (
					'id' => 'nav_cart',
					'type' => 'switch',
                                        'default' => 2,
                                        'on' => 'Show',
                                        'off' => 'Hide',
					'title' => __('Cart In navigation', $mom_textdomain),
				),            

				array (
					'id' => 'nav_cart_in_woo',
					'type' => 'switch',
                                        'default' => 1,
                                        'required'  => array('nav_cart', '=', 1),
                                        'on' => 'Yes',
                                        'off' => 'No',
					'title' => __('Show cart in woocommerce pages only', $mom_textdomain),
					'desc' => __('if select no, the cart will display in whole site ', $mom_textdomain),
				),   
  		)
	);
}

	$this->sections[] = array(
		'icon' => 'el-icon-credit-card',
		'title' => __('Elements', $mom_textdomain),
                'desc'  => __('theme elements', $mom_textdomain),
		'fields' => array(
                                array(
                                    'id'        => 'opt-raw-info',
                                    'type'      => 'raw',
                                )
                    ),
                );

	$this->sections[] = array(
		'icon' => 'el-icon-credit-card',
		'title' => __('Top Banner', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
				array (
					'id' => 'top_banner',
					'type' => 'switch',
                                        'default' => 0,
                                        'on' => 'Enable',
                                        'off' => 'Disable',
					'title' => __('Top banner', $mom_textdomain),
				),

				array (
					'id' => 'top_banner_content',
					'type' => 'switch',
                                        'default' => 1,
                                        'on' => 'Ad',
                                        'off' => 'Custom',
					'title' => __('Top banner Content', $mom_textdomain),
				),
				array (
					'id' => 'top_banner_ad',
					'type' => 'select',
					'data' => 'posts',
					'args' => array('post_type' => 'ads', 'posts_per_page' => -1, 'no_found_rows' => true, 'cache_results' => false),
                                        'required'  => array('top_banner_content', '=', '1'),   
    					'title' => __('Select Top banner', $mom_textdomain),
				),
				array (
					'id' => 'top_banner_custom',
					'type' => 'editor',
                                        'args' => array(
                                        'teeny' => false,
                                        'drag_drop_upload' => true,
                                        'textarea_rows' => 20,
                                       ),

					'title' => __('Custom Content', $mom_textdomain),
					'subtitle' => __('You can use HTML or shortcodes here', $mom_textdomain),
                                        'required'  => array('top_banner_content', '=', '0'),
				),

				array (
					'id' => 'top_banner_close',
					'type' => 'switch',
                                        'default' => 0,
					'title' => __('Close button', $mom_textdomain),
				),                              
/*				array (
					'id' => 'top_banner_close_save',
					'type' => 'switch',
                                        'default' => 0,
                                        'required'  => array('top_banner_close', '=', '1'),   
					'title' => __('Save with cookies', $mom_textdomain),
					'subtitle' => __('Some servers don\'t allow cookies', $mom_textdomain),
					'desc' => __('this option will save the close state if any visitor close the top banner', $mom_textdomain),
				),
				array (
					'id' => 'top_banner_close_save_exp',
					'desc' => __('Days', $mom_textdomain),
					'step' => '1',
					'min' => '1',
					'max' => '356',
					'type' => 'slider',
					'title' => __('Delete cookies after', $mom_textdomain),
					'default' => '7',
				),
*/
                                
                    array(
                        'id'        => 'topbanner-customization-info',
                        'type'      => 'info',
                        'title'      => __('Customize', $mom_textdomain),
                    ),                                
                                
                    array (
                            'id' => 'tob_banner-bg',
                            'type' => 'color',
                            'title' => __('Background', $mom_textdomain),
                            'output' => array('color' => '', 'background-color' => '.top_banner')
                    ),                                 
                                
                    array (
                            'id' => 'tob_banner-color',
                            'type' => 'color',
                            'title' => __('Text Color', $mom_textdomain),
                            'output' => array('color' => '.top_banner')
                    ),                                 

                    array (
                            'id' => 'tob_banner-links',
                            'type' => 'color',
                            'title' => __('Links Color', $mom_textdomain),
                            'output' => array('color' => '.top_banner a')
                    ),                                 

                    array (
                            'id' => 'tob_banner-close',
                            'type' => 'color',
                            'title' => __('Close button color', $mom_textdomain),
                            'output' => array('color' => '.top_banner a.tob_banner_close')
                    ),                                 

                                
		)
	);
	                    
	$this->sections[] = array(
		'icon' => 'el-icon-credit-card',
		'title' => __('Topbar', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
				array (
					'id' => 'topbar',
					'type' => 'switch',
                                        'default' => 1,
                                        'on' => 'Enable',
                                        'off' => 'Disable',
					'title' => __('Topbar', $mom_textdomain),
				),
				
				array (
					'desc' => 'Enable / Disable Today Date in Topbar.',
					'id' => 'top_date',
					'type' => 'switch',
					'title' => 'Today Date',
					'default' => 1,
					'on' => 'Enable',
                                        'off' => 'Disable',
				),
				
				array (
					'id' => 'mom_data_format',
					'type' => 'text',
					'title' => 'Today Date Format',
					'default' => 'l, j F, Y',
					'required' => array (
						0 => 'top_date',
						1 => '=',
						2 => 1,
					),
				),
				array (
					'desc' => __('top navigation left content if select menu you must set it in appearance -> menus the menu location is "Top Menu"', $mom_textdomain),
					'id' => 'tn_left_content',
					'type' => 'select',
					'options' => array (
						'menu' => __('Menu', $mom_textdomain),
						'social' => __('Social Icons', $mom_textdomain),
						'search' => __('Search Box', $mom_textdomain),
						'custom' => __('Custom Content', $mom_textdomain),
					),
					'title' => __('Left Content', $mom_textdomain),
					'default' => 'menu',
				),
				
				array (
					'id' => 'tn_custom_text',
					'type' => 'editor',
					'title' => __('Custom Text', $mom_textdomain),
                                        'required'  => array('tn_left_content', '=', 'custom'),
				),

				array (
					'desc' => __('top navigation Right content if select menu you must set it in appearance -> menus the menu location is "Top Menu"', $mom_textdomain),
					'id' => 'tn_right_content',
					'type' => 'select',
					'options' => array (
						'social' => __('Social Icons', $mom_textdomain),
						'search' => __('Search Box', $mom_textdomain),
						'menu' => __('Menu', $mom_textdomain),
						'custom' => __('Custom Text', $mom_textdomain),
					),
					'title' => __('Right Content', $mom_textdomain),
					'default' => 'social',
				),
				array (
					'id' => 'tn_right_custom_text',
					'type' => 'editor',
					'title' => __('Custom Text', $mom_textdomain),
                                        'required'  => array('tn_right_content', '=', 'custom'),
				),

		)
	);
	    
	$this->sections[] = array(
		'icon' => 'el-icon-cog',
		'title' => __('Header', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
				
                    array(
                        'id'        => 'logo_type',
                        'type'      => 'switch',
                        'title'     => __('Logo type', $mom_textdomain),
                        'subtitle'  => __('set logo type', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Image',
                        'off'       => 'Text',
                    ),
                    
                    array (
					'id' => 'logo_img',
					'desc' => __('upload custom logo', $mom_textdomain),
					'type' => 'media',
                                        'required'  => array('logo_type', '=', '1'),
					'title' => __('The logo', $mom_textdomain),
					'url' => true,
				),
				array (
					'id' => 'retina_logo_img',
					'desc' => __('retina logo must be your logo in double size if original logo is 150*70 retina logo must be 300*140', $mom_textdomain),
					'type' => 'media',
					'title' => __('Retina Logo', $mom_textdomain),
                                        'required'  => array('logo_type', '=', '1'),
					'url' => true,
				),
				array (
					'id' => 'logo_width',
					'desc' => __('your original logo width which you upload under "the logo"', $mom_textdomain),
					'type' => 'text',
                                        'required'  => array('logo_type', '=', '1'),
					'title' => __('Original logo width', $mom_textdomain),
				),
				array (
					'id' => 'logo_height',
					'desc' => __('your original logo Height which you upload under "the logo"', $mom_textdomain),
					'type' => 'text',
                                        'required'  => array('logo_type', '=', '1'),
					'title' => __('Original logo Height', $mom_textdomain),
				),

				array (
					'id' => 'logo_text',
					'desc' => __('if leave blank it will be the site name', $mom_textdomain),
					'type' => 'text',
                                        'required'  => array('logo_type', '=', '0'),
					'title' => __('Text logo', $mom_textdomain),
				),

				array (
					'id' => 'header_height',
					'desc' => __('set the header height', $mom_textdomain),
					'step' => '1',
					'min' => '40',
					'max' => '300',
					'suffix' => 'px',
					'type' => 'slider',
					'title' => __('header Height', $mom_textdomain),
					'default' => '122',
				),

				array (
					'id' => 'header_banner',
					'desc' => __('enable/disable the header ad banner', $mom_textdomain),
					'type' => 'switch',
					'default' => true,
                                        'on'        => 'Banner',
                                        'off'       => 'Custom',                                        
    					'title' => __('Header content', $mom_textdomain),
    					'desc' => __('The content beside the logo', $mom_textdomain),
				),
				array (
					'id' => 'header_banner_id',
					'type' => 'select',
					'data' => 'posts',
					'args' => array('post_type' => 'ads', 'posts_per_page' => -1, 'no_found_rows' => true, 'cache_results' => false),
                                        'required'  => array('header_banner', '=', '1'),   
    					'title' => __('Select Header banner', $mom_textdomain),
				),
                                
				array (
					'id' => 'header_custom_content',
					'type' => 'textarea',
                                        'required'  => array('header_banner', '=', '0'),   
    					'title' => __('Custom content', $mom_textdomain),
    					'desc' => __('it can be text,html or shortcodes', $mom_textdomain),
				),                                

                    array(
                        'id'        => 'header_custom_content_mt',
                        'type'      => 'slider',
                        'required'  => array('header_banner', '=', '0'),   
                        'title'     => __('Custom content space from top', $mom_textdomain),
                        'default'       => 20,
                        'min'           => 0,
                        'step'          => 1,
                        'max'           => 200,
                        'display_value' => 'input'
                    ),
                    
		)
	);
	$this->sections[] = array(
		'icon' => 'el-icon-cog',
		'title' => __('Navigation', $mom_textdomain),
                'subsection' => true,
		'fields' => array(

                    array(
                        'id'        => 'nav_login',
                        'type'      => 'switch',
                        'title'     => __('Login Form', $mom_textdomain),
                        'subtitle'  => __('enable/disable login in navigation bar', $mom_textdomain),
                        'default'   => 0,
                        'on'        => 'enable',
                        'off'       => 'disable',
                    ),
                    array(
                        'id'        => 'nav_login_register_link',
                        'type'      => 'text',
                        'required'  => array('nav_login', '=', 1),
                        'title'     => __('Register Page Link', $mom_textdomain),
                    ),

                    array(
                        'id'        => 'nav_login_reset_link',
                        'type'      => 'text',
                        'required'  => array('nav_login', '=', 1),
                        'title'     => __('Lost password Page link', $mom_textdomain),
                    ),

                    array(
                        'id'        => 'nav_shadow',
                        'type'      => 'switch',
                        'title'     => __('Shadow', $mom_textdomain),
                        'subtitle'  => __('enable/disable Navigation  shadow', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'enable',
                        'off'       => 'disable',
                    ),
                    array (
					'id' => 'sticky_navigation',
					'type' => 'switch',
					'title' => __('Sticky Navigation', $mom_textdomain),
					'default' => 0,
                    ),
                    array(
                        'id'        => 'nav_highlight_ancestor',
                        'type'      => 'switch',
                        'title'     => __('highlight top level items', $mom_textdomain),
                        'subtitle'  => __('highlight top level menu items if open page/post from any item under it under it', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Yes',
                        'off'       => 'No',
                    ),                    
                    array(
                        'id'        => 'nav_dd_animation',
                        'type'      => 'select',
                        'title'     => __('Dropdown Animation ', $mom_textdomain),
                        'options'   => array(
                                             'fade' => __('Fade', $mom_textdomain),
                                             'slide' => __('Slide', $mom_textdomain),
                                             'skew' => __('Skew', $mom_textdomain),
                                            ),
                        'default'   => 'slide',
                    ),                    
		)
	);
	$this->sections[] = array(
		'icon' => 'el-icon-cog',
		'title' => __('News Ticker', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
		                        				
                    array(
                        'id'        => 'nt_search',
                        'type'      => 'switch',
                        'title'     => __('Search', $mom_textdomain),
                        'subtitle'  => __('enable/disable search in News Ticker bar', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'enable',
                        'off'       => 'disable',
                    ),

                    				
                    array(
                        'id'        => 'news_ticker',
                        'type'      => 'switch',
                        'title'     => __('News Ticker', $mom_textdomain),
                        'subtitle'  => __('enable/disable News Ticker', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'enable',
                        'off'       => 'disable',
                    ),
                  
                    array(
                        'id'        => 'news_ticker_title',
                        'type'      => 'text',
                        'title'     => __('Title', $mom_textdomain),
                        'default'   => __('BREAKING NEWS', $mom_textdomain),
                    ),
                    
                    array(
                        'id'        => 'news_ticker_display',
                        'type'      => 'select',
                        'title'     => __('Display', $mom_textdomain),
                        'subtitle'  => __('latest posts, specific category or specific tag, custom text', $mom_textdomain),
                        'default'   => '',
                        'options' => array(
                            '' => __('Latest Posts', $mom_textdomain),  
                            'category' => __('Category', $mom_textdomain),  
                            'tag' => __('Tag', $mom_textdomain),  
                            'custom' => __('Custom Text', $mom_textdomain),  
                        ),
                    ),

                    array(
                        'id'        => 'news_ticker_category',
                        'type'      => 'select',
                        'required'  => array('news_ticker_display', '=', 'category'),
                        'data'      => 'categories',
                        'title'     => __('Select Category', $mom_textdomain),
                    ),

                    array(
                        'id'        => 'news_ticker_tag',
                        'type'      => 'text',
                        'subtitle'  => __('Learn How to get tag Id from <a href="http://www.wpbeginner.com/beginners-guide/how-to-find-post-category-tag-comments-or-user-id-in-wordpress/" target="_blank">here</a>', $mom_textdomain),
                        'required'  => array('news_ticker_display', '=', 'tag'),
                        'title'     => __('Tag ID', $mom_textdomain),
                    ),

                    array(
                        'id'        => 'news_ticker_custom',
                        'type'      => 'textarea',
                        'required'  => array('news_ticker_display', '=', 'custom'),
                        'title'     => __('Custom text', $mom_textdomain),
                        'subtitle'  => __('item per line', $mom_textdomain),
                    ),

                    array(
                        'id'        => 'news_ticker_count',
                        'type'      => 'slider',
                        'required'  => array('news_ticker_display', '!=', 'custom'),
                        'title'     => __('Number of items', $mom_textdomain),
                        'subtitle'          => __('-1 for show all posts', $mom_textdomain),
                        'default'       => 10,
                        'min'           => -1,
                        'step'          => 1,
                        'max'           => 100,
                        'display_value' => 'input'
                    ),
		    
                    array (
                            'id' => 'news_ticker_time_suffix',
                            'type' => 'text',
                            'title' => __('Custom suffix', $mom_textdomain),
                    ),
		    
                    array (
                            'id' => 'news_ticker_icon',
                            'desc' => __('upload custom icon instead the arrows icon at the first of each item', $mom_textdomain),
                            'type' => 'media',
                            'title' => __('Custom icon', $mom_textdomain),
                            'url' => true,
                    ),
		    
                )
	);        
        
	$this->sections[] = array(
		'icon' => 'el-icon-cog',
		'title' => __('Content Ads', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                    array(
                        'id'        => 'content-ads-info',
                        'type'      => 'info',
                        'title'      => __('Content Ads', $mom_textdomain),
                        'desc'      => __('You should see this ads on left and right of main content', $mom_textdomain),
                    ),                    

                    array(
                        'id'        => 'content_ads_position',
                        'type'      => 'switch',
                        'title'     => __('Ads on scroll Down', $mom_textdomain),
                        'default'   => 1,
                        'on'        => 'Fixed',
                        'off'       => 'Scroll',
                    ),
                    
                    array (
					'id' => 'content_right_banner_id',
					'type' => 'select',
					'data' => 'posts',
					'args' => array('post_type' => 'ads', 'posts_per_page' => -1),
    					'title' => __('Right banner', $mom_textdomain),
				),
				
				array (
					'id' => 'content_left_banner_id',
					'type' => 'select',
					'data' => 'posts',
					'args' => array('post_type' => 'ads', 'posts_per_page' => -1),
    					'title' => __('Left banner', $mom_textdomain),
				),
		)
	);
        
	$this->sections[] = array(
		'icon' => 'el-icon-credit-card',
		'title' => __('Footer', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                    				array (
					'desc' => 'Select Footer layout',
					'id' => 'footer_layout',
					'type' => 'image_select',
					'options' => array (
						'one' => $img_path .'/footer/1.png',
						'one_half' => $img_path .'/footer/2.png',
						'third' => $img_path .'/footer/3.png',
						'fourth' => $img_path .'/footer/4.png',
						'fifth' => $img_path .'/footer/5.png',
						'sixth' => $img_path .'/footer/6.png',
						'half_twop' => $img_path .'/footer/half_twop.png',
						'twop_half' => $img_path .'/footer/twop_half.png',
						'half_threep' => $img_path .'/footer/half_threep.png',
						'threep_half' => $img_path .'/footer/threep_half.png',
						'third_threep' => $img_path .'/footer/third_threep.png',
						'threep_third' => $img_path .'/footer/threep_third.png',
						'third_fourp' => $img_path .'/footer/third_fourp.png',
						'fourp_third' => $img_path .'/footer/fourp_third.png',
					),
					'title' => __('Layout', $mom_textdomain),
					'default' => 'fourth',
				),
			
				array (
					'id' => 'hide_footer_widgets',
					'type' => 'switch',
                                        'default' => 0,
					'title' => __('Hide Footer widgets', $mom_textdomain),
				),

				array (
					'id' => 'hide_footer_c',
					'type' => 'switch',
                                        'default' => 0,
					'title' => __('Hide copyrights Area', $mom_textdomain),
				),
				array (
					'desc' => 'footer copyrights text',
					'id' => 'copyrights',
					'type' => 'textarea',
					'title' => 'copyrights',
					'default' => __('2014 Powered By Wordpress, Effective News Theme By <a href="http://www.themelions.com/">Themelions Team</a>', $mom_textdomain),
				),
				array (
					'id' => 'copyrights_right',
					'type' => 'select',
					'options' => array (
						'menu' => 'Menu',
						'social' => 'Social Icons',
					),
					'title' => __('Copyrights area right content', $mom_textdomain),
				),
		)
	);
	$this->sections[] = array(
		'icon' => 'fa-icon-text-width',
		'title' => __('Typography', $mom_textdomain),
		'fields' => array(
                    array(
                        'id'            => 'main_font',
                        'type'          => 'typography',
                        'title'         => __('Main Font', $mom_textdomain),
                        'subtitle'      => __('by default the main font is "play" from google font.', $mom_textdomain),
                        'display'      => __('this font is used for the navigation menus, widgets title, news boxes titles and more ...', $mom_textdomain),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'font-weight'     => false,
                        'text-align'     => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => false,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('.mom_main_font, .topbar, #navigation .main-menu, .breaking-news, .breaking-news .bn-title, .feature-slider li .slide-caption h2, .news-box .nb-header .nb-title, a.show-more, .widget .widget-title, .widget .mom-socials-counter ul li, .main_tabs .tabs a, .mom-login-widget, .mom-login-widget input,  .mom-newsletter h4, .mom-newsletter input, .mpsw-slider .slide-caption, .tagcloud a,
button,input,select,textarea, .weather-widget, .weather-widget h3, .search-wrap .search-results-title, .show_all_results, .mom-social-share .ss-icon span.count, .mom-timeline, .mom-reveiw-system .review-header h2, .mom-reveiw-system .review-summary h3, .mom-reveiw-system .user-rate h3, .mom-reveiw-system  .review-summary .review-score, .mom-reveiw-system .mom-bar, .mom-reveiw-system .review-footer, .mom-reveiw-system .stars-cr .cr, .mom-reveiw-system .review-circles .review-circle, .p-single .post-tags, .np-posts ul li .details .link, h2.single-title, .page-title, label, .portfolio-filter li, .pagination 
.main-title h1, .main-title h2, .main-title h3, .main-title h4, .main-title h5, .main-title h6, .mom-ad-empty, .user-star-rate .yr, .comment-wrap .commentnumber, .copyrights-area, .news-box .nb-footer a,
#bbpress-forums li.bbp-header, .bbp-forum-title, div.bbp-template-notice, div.indicator-hint, #bbpress-forums fieldset.bbp-form legend, .bbp-s-title, #bbpress-forums .bbp-admin-links a, #bbpress-forums #bbp-user-wrapper h2.entry-title,
.mom_breadcrumb, .single-author-box .articles-count, .not-found-wrap, .not-found-wrap h1, .gallery-post-slider.feature-slider li .slide-caption.fs-caption-alt p, .chat-author,
.accordion .acc_title, .acch_numbers, .logo span, .device-menu-holder, #navigation .device-menu, .widget li .cat_num, .wp-caption-text, .mom_quote, div.progress_bar span, .widget_display_stats dl,
#navigation .nav-button.nav-cart span,
.mom-main-font, .widget_display_stats, #buddypress div.item-list-tabs ul, #buddypress button, #buddypress a.button, #buddypress input[type=submit],#buddypress input[type=button], #buddypress input[type=reset], #buddypress ul.button-nav li a,#buddypress div.generic-button a,#buddypress .comment-reply-link,a.bp-title-button, #buddypress .activity-list li.load-more, #buddypress .activity-list li.load-newest, .widget.buddypress ul.item-list, .bp-login-widget-user-links, .feature-slider .fs-nav.numbers a, .nb_wrap .nb-header .nb-title, .mom-post-meta, .news-list .nl-item .news-summary h3, .scrolling-box .sb-item h3, .news-box .older-articles h4, .news-box .recent-news h3, .scrolling-box .sb-item h3,.news-box .nb1-older-articles ul li, .sidebar .widget .widget-title h3, .mom-reveiw-system .circle input, .single-related-posts li h4, .p-single .post-tile, .sidebar .default-search-form button, .sidebar .default-search-form input, .mom-newsletter .button'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                    ),
                    
                   array(
                        'id'            => 'sec_font',
                        'type'          => 'typography',
                        'title'         => __('Secondary Font', $mom_textdomain),
                        'subtitle'      => __('the default is Open Sans.', $mom_textdomain),
                        'desc'      => __('this font used for headings and post titles.', $mom_textdomain),
                        //'compiler'      => true,  // Use if you want to hook in your own CSS compiler
                        'google'        => true,    // Disable google fonts. Won't work if you haven't defined your google api key
                        'font-backup'   => false,    // Select a backup non-google font in addition to a google font
                        'font-style'    => false, // Includes font-style and weight. Can use font-style or font-weight to declare
                        'subsets'       => true, // Only appears if google is true and subsets not set to false
                        'font-size'     => false,
                        'font-weight'     => false,
                        'text-align'     => false,
                        'line-height'   => false,
                        'word-spacing'  => false,  // Defaults to false
                        'letter-spacing'=> false,  // Defaults to false
                        'color'         => false,
                        'preview'       => true, // Disable the previewer
                        'all_styles'    => true,    // Enable all Google Font style/weight variations to be added to the page
                        'output'        => array('.button, .widget ul li, .older-articles ul li, .copyrights-text, #comments .single-comment .comment-content .comment-reply-link, #comments .single-comment .comment-content .comment-edit-link, #navigation .main-menu > li .cats-mega-wrap .subcat li .subcat-title, .widget ul.twiter-list, #bbpress-forums ul.bbp-replies .bbp-reply-content .bbp-author-name'), // An array of CSS selectors to apply this font style to dynamically
                        'units'         => 'px', // Defaults to px
                    ),                    

                    array(
                        'id'        => 'body_typo',
                        'type'      => 'typography',
                        'title'     => __('Body Font', $mom_textdomain),
                        'subtitle'  => __('Specify the body font properties.', $mom_textdomain),
                        'google'    => true,
                        'output'    => array('body'),
                        'default'       => array(
                            'color'         => '#8e8e8e',
                            ),
                        ),

  		)
	);

	$this->sections[] = array(
		'icon' => 'momizat-icon-droplet',
		'title' => __('Colors', $mom_textdomain),
		'fields' => array(
		    
                    array(
                        'id'        => 'body_bg',
                        'type'      => 'background',
                        'title'     => __('Body Background', $mom_textdomain),
                        'subtitle'  => __('change background color or use image or pattern.', $mom_textdomain),
                        'output'    => array('body, body.layout-boxed'),
                     ),
                    
                    array(
                        'id'        => 'body_bg_link',
                        'type'      => 'text',
                        'title'     => __('Body Background Link', $mom_textdomain),
                        'subtitle'  => __('You can use this for ads, wiork with boxed layout only.', $mom_textdomain),
                     ),
                    
                    array(
                        'id'        => 'boxed_bg',
                        'type'      => 'background',
                        'title'     => __('Boxed Layout inner background', $mom_textdomain),
                        'subtitle'  => __('change background color or use image or pattern.', $mom_textdomain),
                        'output'    => array('.layout-boxed:not(.layout-boxed-content) .boxed-wrap, .layout-boxed-content .boxed-content-wrapper'),
                     ),                    
                    
                                array (
					'id' => 'main_color',
					'type' => 'color',
                                        'transparent' => false,
                                        'desc' => __('the main red color will be replaced with this color.', $mom_textdomain),
					'title' => __('Main Color', $mom_textdomain),
                                        'output' => array('color' => 'a, h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover, .news-ticker li a:hover, .mom-post-meta a:hover, .news-box .older-articles ul li a:hover, .news-box .nb1-older-articles ul li a:hover, .mom-login-widget .lw-user-info a:hover strong, .mpsw-slider ul.slides li .slide-caption:hover, .tagcloud a:hover, .mom-recent-comments .author_comment h4 span a:hover, .widget .twiter-list ul.twiter-buttons li a:hover, .copyrights-text a:hover, ul.main-menu li.mom_mega .mega_col_title  a:hover, #navigation .main-menu > li .cats-mega-wrap .subcat .mom-cat-latest li a:hover, #navigation .main-menu > li .cats-mega-wrap .subcat .mom-cat-latest .view_all_posts:hover, .base-box .read-more-link, .widget ul li a:hover, .main_tabs .tabs a.current, .button:hover, .weather-widget .next-days .day-summary .d-date span.dn, .np-posts ul li .details .link:hover, #comments .single-comment .comment-content .comment-reply-link:hover, #comments .single-comment .comment-content .comment-edit-link:hover, .single-author-box .articles-count, .star-rating, .blog-post .bp-head .bp-meta a:hover, ul.main-menu > li:not(.mom_mega) ul.sub-menu li a:hover,.not-found-wrap .ops, #bbpress-forums a, #navigation .main-menu > li:hover > a, #navigation .main-menu > li.current-menu-item > a, #navigation .main-menu > li.current-menu-ancestor > a, #navigation .main-menu > li:hover > a:before, #navigation .main-menu > li.current-menu-item > a:before, #navigation .main-menu > li.current-menu-ancestor > a:before, #navigation ul.device-menu li.dm-active > a, #navigation .device-menu li.dm-active > .responsive-caret, .widget li:hover .cat_num, .news-ticker li i, .mom_breadcrumb .sep, .scrollToTop:hover, ul.products li .mom_product_thumbnail .mom_woo_cart_bt .button:hover, .main_tabs .tabs li.active > a, .toggle_active .toggle_icon:before, #navigation .button.active, .mom-main-color, .mom-main-color a, #buddypress div#item-header div#item-meta a, #buddypress div#subnav.item-list-tabs ul li.selected a, #buddypress div#subnav.item-list-tabs ul li.current a, #buddypress div.item-list-tabs ul li span, #buddypress div#object-nav.item-list-tabs ul li.selected a, #buddypress div#object-nav.item-list-tabs ul li.current a, .mom_bp_tabbed_widgets .main_tabs .tabs a.selected, #buddypress div.activity-meta a.button, .generic-button a, .top_banner a, .topbar .top-nav > li a:hover, .topbar .top-nav > li.current-menu-item a',
							  
							  'background' => '.mom-social-icons li a.vector_icon:hover, .owl-dot.active span, .feature-slider .fs-nav .selected, #navigation .nav-button.nav-cart span.numofitems, .breaking-news .bn-title, #navigation .main-menu > li:hover > a:before, #navigation .main-menu > li.current-menu-item > a:before, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-ancestor > a:before, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-parent > a:before,  .nb_wrap .nb-header .nb-title a, .nb_wrap .nb-header .nb-title span, .main_tabs .tabs a.current:before, .button, #commentform #submit-comment, input[type="submit"], #bbpress-forums #bbp-single-user-details + ul li a',
							  
							  'border-color' => '#comments .single-comment .comment-content .comment-reply-link:hover, #comments .single-comment .comment-content .comment-edit-link:hover, .post.sticky, .nb-style4 .older-articles ul li h4 a:hover',
							  'border-left-color' => '.breaking-news .bn-title:after',
							  'border-right-color' => 'body.rtl .breaking-news .bn-title:after')
					
				),
                                array (
					'id' => 'headings_color',
					'type' => 'color',
                                        'transparent' => false,
					'title' => __('Headings Color', $mom_textdomain),
                                        'desc' => __('headings include the posts titles, newsboxes titles and widgets titles.', $mom_textdomain),
                                        'output' => array('color' => 'h1, h2, h3, h4, h5, h6')
				),                                 

                                array (
					'id' => 'selection_color',
					'type' => 'color',
                                        'transparent' => false,
					'title' => __('Text Selection Color ', $mom_textdomain),
                                        'desc' => __('the background color of selected text, you can overwrite the default blue.', $mom_textdomain),
				),                                 
                                
		                array(
							'id'=>'links-color',
							'type' => 'link_color',
							'title' => __('Links Color', 'framework'),
							//'regular' => false, // Disable Regular Color
							//'hover' => false, // Disable Hover Color
							//'active' => false, // Disable Active Color
							//'visited' => true, // Enable Visited Color
                                                        'output' => array('a'),
							'default' => array(
								'regular' => '',
								'hover' => '',
								'active' => '',
							)
						),
  		)
	);
	$this->sections[] = array(
		'icon' => 'momizat-icon-cog',
		'title' => __('Form Elements', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                    array(
                        'id'        => 'inputs-info',
                        'type'      => 'info',
                        'title'      => __('Input, Textarea and select', $mom_textdomain),
                    ),
                    
                    array(
                        'id'        => 'inputs_bg',
                        'type'      => 'color',
                        'transparent' => false, 
                        'title'     => __('Background', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => 'input,select,textarea, .mom-select, #footer input,#footer select, #footer textarea, #bbpress-forums #bbp-your-profile fieldset input, #bbpress-forums #bbp-your-profile fieldset textarea, .mom-select:before'),
                     ),                    

                    array(
                        'id'        => 'inputs_bd',
                        'type'      => 'color',
                        'transparent' => false, 
                        'title'     => __('Borders', $mom_textdomain),
                        'output'    => array('color' => '', 'border-color' => 'input,select,textarea, .mom-select, #footer input,#footer select, #footer textarea, #bbpress-forums #bbp-your-profile fieldset input, #bbpress-forums #bbp-your-profile fieldset textarea, .mom-select:before'),
                     ),
                    
                    array(
                        'id'        => 'inputs_txt',
                        'type'      => 'color',
                        'transparent' => false, 
                        'title'     => __('Text', $mom_textdomain),
                        'output'    => array('color' => 'input,select,textarea, .mom-select, #footer input,#footer select, #footer textarea, #bbpress-forums #bbp-your-profile fieldset input, #bbpress-forums #bbp-your-profile fieldset textarea, .mom-select:before'),
                     ),

                    array(
                        'id'        => 'buttons-info',
                        'type'      => 'info',
                        'title'      => __('Buttons', $mom_textdomain),
                    ),
                    array(
                        'id'        => 'buttons_bg',
                        'type'      => 'color',
                        'transparent' => false, 
                        'title'     => __('Background', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '.button, #commentform #submit-comment, input[type="submit"], #bbpress-forums #bbp-single-user-details + ul li a, #footer .button, .bbp-search-form #bbp_search_submit'),
                     ),                                        

                    array(
                        'id'        => 'buttons_txt',
                        'type'      => 'color',
                        'transparent' => false, 
                        'title'     => __('Text', $mom_textdomain),
                        'output'    => array('color' => '.button, #commentform #submit-comment, input[type="submit"], #bbpress-forums #bbp-single-user-details + ul li a, #footer .button, .bbp-search-form #bbp_search_submit'),
                     ),

                    array(
                        'id'        => 'buttons_txt_h',
                        'type'      => 'color',
                        'transparent' => false, 
                        'title'     => __('Text on hover', $mom_textdomain),
                        'output'    => array('color' => '.button:hover, #commentform #submit-comment:hover, input[type="submit"]:hover, #bbpress-forums #bbp-single-user-details + ul li a:hover, #footer .button:hover, .bbp-search-form #bbp_search_submit:hover'),
                     ),
                    
                    )
        );
                
	$this->sections[] = array(
		'icon' => 'momizat-icon-cog',
		'title' => __('Topbar & bottom bar', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                    array(
                        'id'        => 'topbar_bg',
                        'type'      => 'color',
                        'title'     => __('Background', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '.topbar, .copyrights-area, .topbar .top-nav > li ul.sub-menu li a:hover'),
                        //'output'    => array('color' => '', 'background-color' => '.topbar, .copyrights-area, .topbar .top-nav > li ul.sub-menu li a:hover'),
                     ),
                    array(
                        'id'        => 'topbar_text',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Menu Links and text colors', $mom_textdomain),
                        'output'    => array('color' => '.topbar, .copyrights-area, .topbar .top-nav li a, .copyrights-text, .footer_menu li a'),
                     ),   
  
                    array(
                        'id'        => 'topbar_menu_dbc',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Dropdown menu border color', $mom_textdomain),
                        'output'    => array('color' => '', 'border-color' => '.topbar .top-nav > li ul.sub-menu li, .topbar .top-nav > li ul.sub-menu li:hover, .topbar .top-nav > li ul.sub-menu li:hover+li, .topbar .top-nav > li ul.sub-menu li a:hover, .topbar .top-nav > li ul.sub-menu'),
                     ),
                    array(
                        'id'        => 'top_si',
                        'type'      => 'info',
                        'title'      => __('Social Icons', $mom_textdomain),
                    ),                    
                    array(
                        'id'        => 'topbar_si_bg',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Social Icons Background', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '.mom-social-icons li a.vector_icon'),
                     ),                      
                    array(
                        'id'        => 'topbar_si_cl',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Social Icons color', $mom_textdomain),
                        'output'    => array('color' => '.mom-social-icons li a.vector_icon'),
                     ),                       
                    array(
                        'id'        => 'top_search',
                        'type'      => 'info',
                        'title'      => __('Search Box', $mom_textdomain),
                    ),
                    array(
                        'id'        => 'topbar_s_bg',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Search box background', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '.topbar input, .topbar select, .topbar textarea'),
                     ),
                    array(
                        'id'        => 'topbar_s_cl',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Search box text color', $mom_textdomain),
                        'output'    => array('color' => '.topbar input, .topbar select, .topbar textarea'),
                     ),
                    array(
                        'id'        => 'topbar_sb_bg',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Search button background', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '.topbar .search-form button'),
                     ),
                    array(
                        'id'        => 'topbar_sb_cl',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Search button color', $mom_textdomain),
                        'output'    => array('color' => '.topbar .search-form button'),
                     ),
                    
        )
	);
	
	$this->sections[] = array(
			'icon' => 'momizat-icon-cog',
			'title' => __('News Ticker', $mom_textdomain),
			'subsection' => true,
			'fields' => array(
			    array(
				'id'        => 'breaking-news',
				'type'      => 'info',
				'title'      => __('Breaking News', $mom_textdomain),
			    ), 
			    array(
				'id'        => 'breaking-news-bg',
				'type'      => 'color',
				'transparent' => false,
				'title'     => __('Background', $mom_textdomain),
				'subtitle'     => __('', $mom_textdomain),
				'output'    => array('color' => '', 'background-color' => '.breaking-news'),
			     ),
			    array(
				'id'        => 'breaking-news',
				'type'      => 'color',
				'transparent' => false,
				'title'     => __('Border', $mom_textdomain),
				'subtitle'     => __('', $mom_textdomain),
				'output'    => array('border-color' => '.breaking-news'),
			     ),
			    array(
				'id'        => 'nt_title',
				'type'      => 'info',
				'title'      => __('The Title', $mom_textdomain),
			    ),   
	
			    array(
				'id'        => 'nt_title_bg',
				'type'      => 'color',
				'transparent' => false,
				'title'     => __('Title Background', $mom_textdomain),
				'subtitle'     => __('', $mom_textdomain),
				'output'    => array('color' => '', 'background-color' => '.breaking-news .bn-title', 'border-left-color' => '.breaking-news .bn-title:after', 'border-right-color' => 'body.rtl .breaking-news .bn-title:after'),
			     ),
			    
			    array(
				'id'        => 'nt_title_txt',
				'type'      => 'color',
				'transparent' => false,
				'title'     => __('Title Text', $mom_textdomain),
				'subtitle'     => __('', $mom_textdomain),
				'output'    => array('color' =>  '.breaking-news .bn-title'),
			     ),
	
			  array(
				'id'        => 'nt_ticker',
				'type'      => 'info',
				'title'      => __('The Ticker', $mom_textdomain),
			    ),   
	
			    array(
				'id'        => 'nt_ticker_bg',
				'type'      => 'color',
				'transparent' => false,
				'title'     => __('Background', $mom_textdomain),
				'subtitle'     => __('', $mom_textdomain),
				'output'    => array('color' => '', 'background-color' => '.news-ticker'),
			     ),
		    
			    array(
				'id'        => 'nt_ticker_bd',
				'type'      => 'color',
				'transparent' => false,
				'title'     => __('borders', $mom_textdomain),
				'subtitle'     => __('', $mom_textdomain),
				'output'    => array('color' => '', 'border-color' => '.news-ticker'),
			     ),
	
			    array(
				'id'        => 'nt_ticker_links',
				'type'      => 'color',
				'transparent' => false,
				'title'     => __('Text', $mom_textdomain),
				'subtitle'     => __('', $mom_textdomain),
				'output'    => array('color' => '.news-ticker li a, .news-ticker li'),
			     ),            
			    array(
				'id'        => 'nt_ticker_icon',
				'type'      => 'color',
				'transparent' => false,
				'title'     => __('Separator icon', $mom_textdomain),
				'subtitle'     => __('', $mom_textdomain),
				'output'    => array('color' => '.news-ticker li i'),
			     ),
			    array(
                                'id'        => 'search_info',
                                'type'      => 'info',
                                'title'      => __('Breaking News Search', $mom_textdomain),
                            ),
                          
                            array(
                                'id'        => 'search_icon',
                                'type'      => 'color',
                                'transparent' => false,
                                'title'     => __('Search icon color', $mom_textdomain),
                                'subtitle'     => __('', $mom_textdomain),
                                'output'    => array('color' => '.breaking-news .search-form .button i'),
                             ),
                            array(
                                'id'        => 'search_input',
                                'type'      => 'color',
                                'transparent' => false,
                                'title'     => __('Search field background', $mom_textdomain),
                                'subtitle'     => __('', $mom_textdomain),
                                'output'    => array('color' => '', 'background-color' => '.breaking-news .search-form .button'),
                             ),
                            array(
                                'id'        => 'search_input_text',
                                'type'      => 'color',
                                'transparent' => false,
                                'title'     => __('Search field text color', $mom_textdomain),
                                'subtitle'     => __('', $mom_textdomain),
                                'output'    => array('color' => '.search-form input'),
                             ),
                           array(
                                'id'        => 'search_field_button',
                                'type'      => 'color',
                                'transparent' => false,
                                'title'     => __('Search field button background', $mom_textdomain),
                                'subtitle'     => __('', $mom_textdomain),
                                'output'    => array('color' => '', 'background-color' => '.search-form .button'),
                             ),
                            array(
                                'id'        => 'search_field_button_text',
                                'type'      => 'color',
                                'transparent' => false,
                                'title'     => __('Search field button text color', $mom_textdomain),
                                'subtitle'     => __('', $mom_textdomain),
                                'output'    => array('color' => '.breaking-news .search-form .button'),
                             ),
                            array(
                                'id'        => 'search_field_bdr',
                                'type'      => 'color',
                                'transparent' => false,
                                'title'     => __('Search field Border color', $mom_textdomain),
                                'subtitle'     => __('', $mom_textdomain),
                                'output'    => array('color' => '', 'border-color' => '.search-form input'),
                             ),
	     )
	);
        
	$this->sections[] = array(
		'icon' => 'momizat-icon-cog',
		'title' => __('Header', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                    array(
                        'id'        => 'header_bg',
                        'type'      => 'background',
                        'transparent' => false,
                        'title'     => __('Header Background', $mom_textdomain),
                        'output'    => array('.header'),
                     ),
  		)
	); 

	$this->sections[] = array(
		'icon' => 'momizat-icon-cog',
		'title' => __('Navigaition ', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                    array(
                        'id'        => 'navigation_b_bg',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Navigation bottom Background', $mom_textdomain),
                        'subtitle'     => __('the little white background and current menu item background', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '#navigation, #navigation .main-menu > li:hover > a, #navigation .main-menu > li.current-menu-item > a, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-ancestor > a, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-parent > a, #navigation .main-menu > li:hover > a:before, #navigation .main-menu > li.current-menu-item > a:before, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-ancestor > a:before,  .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-parent > a:before, ul.main-menu > li:not(.mom_mega):not(.mom_mega_cats) ul.sub-menu, ul.main-menu > li:not(.mom_mega):not(.mom_mega_cats) ul.sub-menu li, #navigation .main-menu > li .cats-mega-wrap, ul.main-menu > li:not(.mom_mega) ul.sub-menu li, .main-menu .mom_mega.menu-item-depth-0 > .mom_mega_wrap:before, #navigation .main-menu li.mom_mega.menu-item-depth-0 > .mom_mega_wrap, .device-menu-holder, .device-menu-holder .mh-caret, .device-menu-holder.active:before, #navigation .device-menu, #navigation .device-menu li.dm-active > a, #navigation .device-menu li.dm-active > .responsive-caret, #navigation .main-menu > li .cats-mega-wrap .subcat'),
                     ),

                    array(
                        'id'        => 'navigation_bg',
                        'type'      => 'background',
                        'transparent' => false,
                        'title'     => __('Navigation Background', $mom_textdomain),
                        'subtitle'     => __('the little white background   ', $mom_textdomain),
                        'output'    => array('.navigation-inner,#navigation .nav-button, .nb-inner-wrap .search-results-title, .show_all_results, .nb-inner-wrap ul.s-results .s-img .post_format'),
                     ),
                    array(
                        'id'        => 'navigation_bd_cl',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Navigation Borders color 1', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '', 'border-color' => '.navigation-inner, #navigation .nav-button, .nb-inner-wrap ul.s-results li, .nb-inner-wrap .search-results-title, .show_all_results, .nb-inner-wrap ul.s-results .s-img .post_format, .nb-inner-wrap .nb-inner,ul.main-menu > li:not(.mom_mega):not(.mom_mega_cats) ul.sub-menu, ul.main-menu > li:not(.mom_mega):not(.mom_mega_cats) ul.sub-menu li, #navigation .main-menu > li .cats-mega-wrap, #navigation .main-menu > li .cats-mega-wrap .cats-mega-inner, ul.main-menu > li .cats-mega-wrap ul.sub-menu li, #navigation .main-menu > li .cats-mega-wrap .subcat .mom-cat-latest .view_all_posts, #navigation .main-menu > li .cats-mega-wrap .subcat ul li, #navigation .main-menu > li .cats-mega-wrap.mom_cats_horizontal .subcat .mom-cat-latest li, ul.main-menu li.mom_mega .mom_mega_wrap ul li a, ul.main-menu li.mom_mega .mega_col_title > a, #navigation, #navigation .main-menu > li:hover > a, #navigation .main-menu > li.current-menu-item > a, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-ancestor > a, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-parent > a, #navigation .main-menu > li:hover > a:before, #navigation .main-menu > li.current-menu-item > a:before, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-ancestor > a:before, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-parent > a:before, ul.main-menu > li:not(.mom_mega):not(.mom_mega_cats) ul.sub-menu, ul.main-menu > li:not(.mom_mega):not(.mom_mega_cats) ul.sub-menu li, #navigation .main-menu > li .cats-mega-wrap, ul.main-menu > li:not(.mom_mega) ul.sub-menu li, .main-menu .mom_mega.menu-item-depth-0 > .mom_mega_wrap:before, #navigation .main-menu li.mom_mega.menu-item-depth-0 > .mom_mega_wrap, .device-menu-holder, #navigation .device-menu, #navigation .device-menu li.menu-item, #navigation .device-menu li .responsive-caret, #navigation .device-menu li.dm-active.mom_mega.menu-item-depth-0 > a ',
                                             'border-left-color' => '#navigation .main-menu > li, #navigation .main-menu > li:last-child',
                                             'border-right-color' => '#navigation ul.main-menu',

                    'background-color' => '#navigation .main-menu > li .cats-mega-wrap .cats-mega-inner:before'),
                                         ),   
                    array(
                        'id'        => 'navigation_bd_cl2',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Navigation Borders color 2', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '',
					     'border-color' => '#navigation',
                                             'border-right-color' => '#navigation .main-menu > li',
                                             'border-left-color' => '#navigation ul.main-menu',
'background-color' => '#navigation .main-menu > li:hover > a, #navigation .main-menu > li.current-menu-item > a, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-ancestor > a, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-parent > a'),
                     ),
		    array(
			'id'        => 'navigation_hover_bdr',
			'type'      => 'color',
			'transparent' => false,
			'title'     => __('Navigation Border Hover Background color and', $mom_textdomain),
			'subtitle'     => __('', $mom_textdomain),
			'output'    => array('background-color' => '#navigation .main-menu > li:hover > a:before, #navigation .main-menu > li.current-menu-item > a:before, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-ancestor > a:before, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-parent > a:before'),
					 ),
                    array(
                        'id'        => 'navigation_links',
                        'type'      => 'typography',
                        'transparent' => false,
                        'title'     => __('Navigation Links typo', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'line-height' => false,
                        'google' => true,
                        'output'    => array('#navigation .main-menu > li > a, #navigation .nav-button, .nb-inner-wrap ul.s-results .s-details h4, .nb-inner-wrap .search-results-title, .show_all_results a,  .ajax_search_results .sw-not_found'),
                     ),   
                    array(
                        'id'        => 'navigation_links_c',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Current menu item ', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '#navigation .main-menu > li:hover > a, #navigation .main-menu > li.current-menu-item > a, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-ancestor > a, .navigation_highlight_ancestor #navigation .main-menu > li.current-menu-parent > a, ul.main-menu > li:not(.mom_mega) ul.sub-menu li a, ul.main-menu li.mom_mega .mega_col_title > a, ul.main-menu li.mom_mega .mom_mega_wrap ul li a, .device-menu-holder, .device-menu-holder .mh-icon, .the_menu_holder_area i, .device-menu-holder .mh-caret, #navigation .device-menu li.menu-item a i, #navigation .device-menu li.menu-item > a, #navigation .device-menu li .responsive-caret'),
                     ),
                    array(
                        'id'        => 'navigation_links_dda',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Dropdown menu arrow ', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => 'ul.main-menu > li.menu-item-has-children > a:after, ul.main-menu li:not(.mom_mega):not(.mom_mega_cats) ul.sub-menu li.menu-item-has-children > a:after, .nb-inner-wrap ul.s-results .s-details .mom-post-meta'),
                     ),                         
                    array(
                        'id'        => 'dropdown_menu_info',
                        'type'      => 'info',
                        'title'      => __('Drop down menu', $mom_textdomain),
                    ),

                    array(
                        'id'        => 'dropdown_cat_hightlight_color',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Category mega menu Highlight background', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => 'ul.main-menu > li .cats-mega-wrap ul.sub-menu li.active a, #navigation .main-menu > li .cats-mega-wrap .subcat'),
                     ),
                    array(
                        'id'        => 'dropdown_cat_links_color',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Category mega menu Highlight links color', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '#navigation .main-menu > li .cats-mega-wrap .subcat li .subcat-title a, ul.main-menu > li .cats-mega-wrap ul.sub-menu li.active a, ul.main-menu > li .cats-mega-wrap ul.sub-menu li.active a:before, #navigation .main-menu > li .cats-mega-wrap .subcat .mom-cat-latest .view_all_posts'),
                     ),
                    

                    array(
                        'id'        => 'dropdown_cat_date_color',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Category mega menu post date color', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '#navigation .main-menu > li .cats-mega-wrap .subcat li .subcat-title span'),
                     ),                            
                )
	); 

	$this->sections[] = array(
		'icon' => 'momizat-icon-cog',
		'title' => __('Boxes', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                    array(
                          'id'        => 'boxes-info',
                          'type'      => 'info',
                          'title'      => __('The Main Box', $mom_textdomain),
                          'desc'      => __('the main white box used for news boxes, widgets, feature slider and most of boxes in the theme', $mom_textdomain),
                      ),
                    array(
                        'id'        => 'bbox-bg',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Background', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '.base-box, .sidebar .widget .widget_content, .tabs-content-wrap, .nb-style4 .base-box, .comment-form, div.bbp-template-notice, div.indicator-hint, #bbpress-forums fieldset.bbp-form legend, .scrolling-box:before, .pagination span.current, .bbp-pagination-links span.current, .main_tabs .tabs a.current, .main_tabs .tabs a.current:before, .mom-socials-counter ul li'),
                    ),

                    array(
                        'id'        => 'bbox-bg-alt',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Alt Background', $mom_textdomain),
                        'desc'     => __('the alternate  background color, you can see it in most of news boxes', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '.news-box .older-articles, .nb-style1 .nb1-older-articles, .scrolling-box .sb-item, .mom-socials-counter .sc-count'),
                    ),
                    
                    array(
                        'id'        => 'bbox-bd',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('borders', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '', 'border-color' => '.base-box, .sidebar .widget .widget_content , .comment-form, div.bbp-template-notice, div.indicator-hint, #bbpress-forums fieldset.bbp-form legend, .scrolling-box:before, .news-box .older-articles ul.two-cols li, .news-box .older-articles ul li, .news-box .nb-footer, .nb-style3 .older-articles, .nb-style1 .nb1-older-articles ul.two-cols:before, .nb-style1 .recent-news, .sidebar .mom-posts-widget .mpw-post, .news-list .nl-item, .scrolling-box .owl-item, .mom-carousel .owl-wrapper, .sidebar .mom-recent-comments ul li, .blog-post .bp-head, .widget ul.twiter-list > li, .fs-image-nav .fs-prev, .fs-image-nav .fs-next, .fs-image-nav, .news-box .nb-header, .sidebar .widget .widget-head, .main_tabs .tabs li, .base-box .base-box, .tabs_v3 ul.tabs li, .tabs_v1 ul.tabs li, .tabs_v2 ul.tabs li, .tabs_v3 ul.tabs li, .main_tabs .tabs, .layout-boxed .base-box, .layout-boxed .sidebar .widget, .layout-boxed .comment-form, .layout-boxed div.bbp-template-notice, .layout-boxed div.indicator-hint, .layout-boxed #bbpress-forums fieldset.bbp-form legend, ul.products li .product-inner, ul.products li .product-inner, ul.products li .mom_product_thumbnail, .widget.woocommerce:not(.widget_product_categories):not(.widget_layered_nav) ul li, .summary .woocommerce-product-rating, .main_tabs .tab-content:before, .tabs-content-wrap, .sidebar .mom-login-widget .avatar, .news-box .news-image, .news-box ul li img, .news-box.new-in-pics img, .nb-style2 .older-articles .two-cols, .scrolling-box .sb-item, .mom-socials-counter ul li:nth-child(3n+1), .mom-socials-counter ul li, .mom-socials-counter .sc-head, .nb-style4 .news-summary, .nb-style4 .older-articles, .nb-2col .older-articles ul',
'background-color' => '.scrolling-box:after, .nb-style2 .older-articles .two-cols:before, .tabs_v3:before, .tabs_v1:before, .tabs_v2:before'),
                     ),

                    array(
                        'id'        => 'bbox-bdb',
                        'transparent' => true,
                        'type'      => 'color',
                        'title'     => __('Box bottom shadow', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '', 'border-color' => '.base-box:after, .sidebar .widget:after, div.bbp-template-notice:after, div.indicator-hint:after, #bbpress-forums fieldset.bbp-form legend:after'),
                     ),                    

                    array(
                        'id'        => 'bbox-head-bg',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Header Background', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '.nb_wrap .nb-header .nb-title a, .nb_wrap .nb-header .nb-title span, .main_tabs .tabs'),
                     ),
                    
                    array(
                        'id'        => 'bbox-head-txt',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Box header title', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '.news-box .nb-header, .sidebar .widget .widget-head, .news-box .nb-header .nb-title a, .news-box .nb-header .nb-title span, .sidebar .widget .widget-title span'),
                     ),
                                        
                    array(
                        'id'        => 'bbox-head-bdr',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Box Header Border', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '.nb_wrap .nb-header:after', 'border-color' => '.sidebar .widget .widget-title'),
                     ),
                    array(
                          'id'        => 'boxes-fs-info',
                          'type'      => 'info',
                          'title'      => __('Feature slider', $mom_textdomain),
                     ),
                    
                    array(
                        'id'        => 'bbox-fs-tumba-bg',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Thumbnails Arrows background', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '.fs-image-nav .fs-prev, .fs-image-nav .fs-next'),
                     ),                    

                    array(
                        'id'        => 'bbox-fs-tumba-txt',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Thumbnails Arrows color', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '.fs-image-nav .fs-prev, .fs-image-nav .fs-next'),
                     ),                    

                    array(
                          'id'        => 'boxes-sb-info',
                          'type'      => 'info',
                          'title'      => __('Scrolling Box', $mom_textdomain),
                     ),
                    
                    array(
                        'id'        => 'bbox-sb-bullets',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('bullets color ', $mom_textdomain),
                        'subtitle'     => __('', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '.owl-dot span'),
                     ), 

                    array(
                          'id'        => 'boxes-blog-info',
                          'type'      => 'info',
                          'title'      => __('blog', $mom_textdomain),
                     ),
                    array(
                        'id'        => 'bbox-blog-pm',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Posts meta color', $mom_textdomain),
                        'subtitle'     => __('author name, date, category and comments', $mom_textdomain),
                        'output'    => array('color' => '.mom-post-meta, .mom-post-meta a, .blog-post .bp-head .bp-meta, .blog-post .bp-head .bp-meta a, .bbp-reply-post-date, .news-box .nb-item-meta a, .widget ul.twiter-list > li time, .mom-login-widget .lw-user-info a:first-child, .mom-recent-comments .author_comment h4 time, .mom-recent-comments .author_comment h4 span a'),
                     ),
                    array(
                          'id'        => 'boxes-tabs-info',
                          'type'      => 'info',
                          'title'      => __('Tabs', $mom_textdomain),
                     ),
                    array(
                        'id'        => 'bbox-tabs-text',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Tabs titles color', $mom_textdomain),
                        'output'    => array('color' => '.main_tabs .tabs a'),
                     ),
                    
                    )
	);  

	$this->sections[] = array(
		'icon' => 'momizat-icon-cog',
		'title' => __('Footer', $mom_textdomain),
                'subsection' => true,
		'fields' => array(
                    array(
                        'id'        => 'footer_bg',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Background', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '#footer'),
                     ),      

                    array(
                        'id'        => 'footer_bd',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Top border', $mom_textdomain),
                        'output'    => array('color' => '', 'border-color' => '#footer'),
                     ), 

                    array(
                        'id'        => 'footer_w_title',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Widgets title color', $mom_textdomain),
                        'output'    => array('color' => '#footer .widget .widget-title'),
                     ), 
                    array(
                        'id'        => 'footer_w_title_bd',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Widgets title border bottom', $mom_textdomain),
                        'output'    => array('color' => '','border-color' => '#footer .widget .widget-title'),
                     ), 
                    array(
                        'id'        => 'footer_w_links',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Widgets links & text color', $mom_textdomain),
                        'output'    => array('color' => '#footer .widget, #footer .widget a'),
                     ),

                    array(
                        'id'        => 'footer_w_pm',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Widgets posts meta color', $mom_textdomain),
                        'output'    => array('color' => '#footer .mom-recent-comments .author_comment p, #footer .mom-post-meta, #footer .mom-recent-comments .author_comment h4 time, #footer .mom-recent-comments #footer .author_comment h4 span a'),
                     ),
                     
                    array(
                        'id'        => 'footer_w_links_bd',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Widgets links border bottom', $mom_textdomain),
                        'output'    => array('color' => '','border-color' => '#footer .widget ul li'),
                     ),


                    array(
                        'id'        => 'footer_inputs-info',
                        'type'      => 'info',
                        'title'      => __('Input, Textarea and select', $mom_textdomain),
                    ),
                    
                    array(
                        'id'        => 'footer_inputs_bg',
                        'type'      => 'color',
                        'transparent' => false, 
                        'title'     => __('Background', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '#footer input,#footer select, #footer textarea'),
                     ),                    

                    array(
                        'id'        => 'footer_inputs_bd',
                        'type'      => 'color',
                        'transparent' => false, 
                        'title'     => __('Borders', $mom_textdomain),
                        'output'    => array('color' => '', 'border-color' => '#footer input,#footer select, #footer textarea'),
                     ),
                    
                    array(
                        'id'        => 'footer_inputs_txt',
                        'type'      => 'color',
                        'transparent' => false, 
                        'title'     => __('Text', $mom_textdomain),
                        'output'    => array('color' => '#footer input,#footer select, #footer textarea'),
                     ),

                    array(
                        'id'        => 'footer_buttons-info',
                        'type'      => 'info',
                        'title'      => __('Buttons', $mom_textdomain),
                    ),
                    array(
                        'id'        => 'footer_buttons_bg',
                        'type'      => 'color',
                        'transparent' => false, 
                        'title'     => __('Background', $mom_textdomain),
                        'output'    => array('color' => '', 'background-color' => '#footer .button', 'border-color' => '#footer .button'),
                     ),                                        

                    array(
                        'id'        => 'footer_buttons_txt',
                        'type'      => 'color',
                        'transparent' => false, 
                        'title'     => __('Text', $mom_textdomain),
                        'output'    => array('color' => '#footer .button'),
                     ),

                    array(
                        'id'        => 'footer_buttons_txt_h',
                        'type'      => 'color',
                        'transparent' => false, 
                        'title'     => __('Text on hover', $mom_textdomain),
                        'output'    => array('color' => '#footer .button:hover'),
                     ),

                    array(
                       'id'        => 'footer_tw-info',
                        'type'      => 'info',
                        'title'      => __('Text Widgets', $mom_textdomain),
                    ), 
                    array(
                        'id'        => 'footer_tw_txt',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Text color', $mom_textdomain),
                        'output'    => array('color' => '#footer .widget, #footer .widget p'),
                     ),
                    
                    array(
                        'id'        => 'footer_tw_links',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('links color', $mom_textdomain),
                        'output'    => array('color' => '#footer .widget .textwidget a, #footer .widget .twitter-widget a'),
                     ),
                    
                    array(
                       'id'        => 'footer_stt-info',
                        'type'      => 'info',
                        'title'      => __('Scroll to top Button', $mom_textdomain),
                    ),                    
                    array(
                        'id'        => 'footer_scroll_top',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Scroll to top button background', $mom_textdomain),
                        'output'    => array('color' => '','background-color' => '.scrollToTop'),
                     ),
                    array(
                        'id'        => 'footer_scroll_top_a',
                        'type'      => 'color',
                        'transparent' => false,
                        'title'     => __('Scroll to top Arrow color', $mom_textdomain),
                        'output'    => array('color' => '.scrollToTop'),
                     ),                    
                     

  		)
	);                


	/*
         
         
        $this->sections[] = array(
		'icon' => 'momizat-icon-cog',
		'title' => __('Empty', $mom_textdomain),
                'subsection' => true,
		'fields' => array(

  		)
	);
	
	
	*/

        $this->sections[] = array(
		'icon' => 'momizat-icon-cog',
		'title' => __('Custom CSS', $mom_textdomain),
          	'fields' => array(
                    array(
                        'id'        => 'custom_css',
                        'type'      => 'ace_editor',
                        'title'     => __('Custom CSS', $mom_textdomain),
                        'subtitle'  => __('insert custom css.', 'redux-framework-demo'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                    ),
  		)
	);
	$this->sections[] = array(
		'icon' => 'el-icon-key',
		'title' => __('API\'s Authentication', $mom_textdomain),
                        'desc' => __('this section for connect with Different APIs such as twitter, mailchimp, instagram, etc ... some of theme function depend on this APIs so make sure you insert the Authentication information below.', $mom_textdomain),
		'fields' => array(


                        array(
                            'id' => 'notice_critical3ff4f5',
                            'type' => 'info',
                            'style' => 'warning',
                            'icon' => 'momizat-icon-facebook',
                            'title' => __('Facebook (required for social counter widget)', 'framework'),
                            'desc' => __('to get Facebook access token <a href="https://smashballoon.com/custom-facebook-feed/access-token/" target="_blank">Follow this</a>', 'framework')
                        ),
                        array (
                                'id' => 'facebook_access_token',
                                'type' => 'text',
                                'title' => __('Facebook access token', 'framework'),
                        ),


                    array(
                        'id' => 'auth_twi_info',
                        'type' => 'info',
                        'style' => 'warning',
                        'title' => __('Twitter (required for using twitter widgets and social counters widget)', $mom_textdomain),
                        'desc' => __('you can get twitter Authentication data by following this <a href="http://www.youtube.com/watch?v=zdSHhiHAxBA"  target="_blank">tutorial</a>', $mom_textdomain),
                    ),
                    
				array (
					'id' => 'twitter_ck',
					'type' => 'text',
					'title' => __('Consumer key', $mom_textdomain),
				),
				array (
					'id' => 'twitter_cs',
					'type' => 'text',
					'title' => __('Consumer secret', $mom_textdomain),
				),
				array (
					'id' => 'twitter_at',
					'type' => 'text',
					'title' => __('Access token', $mom_textdomain),
				),
				array (
					'id' => 'twitter_ats',
					'type' => 'text',
					'title' => __('Access token secret', $mom_textdomain),
				),

                    array(
                        'id' => 'auth_mc_info',
                        'type' => 'info',
                        'style' => 'warning',
                        'title' => __('Mailchimp (required for using newsletter widget)', $mom_textdomain),
                        'desc' => __('to find your API key <a href="http://kb.mailchimp.com/article/where-can-i-find-my-api-key" target="_blank">click here</a>', $mom_textdomain),
                    ),

                    array (
                            'id' => 'mailchimp_api_key',
                            'type' => 'text',
                            'title' => __('Mailchimp API Key', $mom_textdomain),
                    ),
                    
                    array(
                        'id' => 'auth_mc_info',
                        'type' => 'info',
                        'style' => 'warning',
                        'title' => __('Google+ (required for using social counter widget)', $mom_textdomain),
                        'desc' => __('to get Google+ API key <a href="http://www.youtube.com/watch?v=-wPKcfEadAc" target="_blank">Follow this</a>', $mom_textdomain),
                    ),

                    array (
                            'id' => 'googlep_api_key',
                            'type' => 'text',
                            'title' => __('Google+ API Key', $mom_textdomain),
                    ),

                    array(
                        'id' => 'auth_mc_info',
                        'type' => 'info',
                        'style' => 'warning',
                        'title' => __('Sound Cloud (required for using social counter widget)', $mom_textdomain),
                        'desc' => __('in documentation', $mom_textdomain),
                    ),

                    array (
                            'id' => 'soundcloud_client_id',
                            'type' => 'text',
                            'title' => __('Sound Cloud Client ID', $mom_textdomain),
                    ),
                    
                    array(
                        'id' => 'auth_mc_info',
                        'type' => 'info',
                        'style' => 'warning',
                        'title' => __('Behace (required for using social counter widget)', $mom_textdomain),
                        'desc' => __('in documentation', $mom_textdomain),
                    ),

                    array (
                            'id' => 'behance_api_key',
                            'type' => 'text',
                            'title' => __('Behance API key', $mom_textdomain),
                    ),                    

                    array(
                        'id' => 'auth_mc_info',
                        'type' => 'info',
                        'style' => 'warning',
                        'title' => __('Instagram (required for using social counter widget)', $mom_textdomain),
                        'desc' => __('<a href="http://www.pinceladasdaweb.com.br/instagram/access-token" target="_blank">Click Here</a> To get the Access Token', $mom_textdomain),
                    ),

                    array (
                            'id' => 'instagram_access_token',
                            'type' => 'text',
                            'title' => __('Instagram Access Token', $mom_textdomain),
                    ),

		)
	);	    
        }

        public function setHelpTabs() {

		$mom_textdomain = 'framework';
            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-1',
                'title' => __('Theme Information 1', $mom_textdomain),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', $mom_textdomain)
            );

            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-2',
                'title' => __('Theme Information 2', $mom_textdomain),
                'content' => __('<p>This is the tab content, HTML is allowed.</p>', $mom_textdomain)
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', $mom_textdomain);
        }

        /**

          All the possible arguments for Redux.
          For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

         * */
        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.
		$mom_textdomain = 'framework';
                global $opt_name;

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => $opt_name, // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => __('Options', $mom_textdomain),
                'page' => __('Options', $mom_textdomain),
                'google_api_key' => 'AIzaSyAPXYUZF718qjEDQZJ8I1xJuc1WOLVTBHA', // Must be defined to add google fonts to the typography module
                //'async_typography'  => false,                    // Use a asynchronous font on the front end or font string
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => false, // Show the time the page took to load, etc
                'customizer' => false, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => 'momizat_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                //'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'             	=> 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                'footer_credit'      	=> '<span></span>', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // __( '', $this->args['domain'] );            
            );




            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
                //$this->args['intro_text'] = sprintf(__('<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', $mom_textdomain), $v);
            } else {
                $this->args['intro_text'] = '';
            }

            // Add content after the form.
            $this->args['footer_text'] = '';
        }

    }

    new Redux_Framework_goodnews_config();
}


/**

  Custom function for the callback referenced above

 */
if (!function_exists('redux_my_custom_field')):

    function redux_my_custom_field($field, $value) {
        print_r($field);
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

function momizatCustomScripts() {
    wp_register_style(
        'momizat-options-css',
        MOM_URI . '/framework/options/momizat/momizat.css',
        array( 'redux-css' ), // Be sure to include redux-css so it's appended after the core css is applied
        time(),
        'all'
    );  
    wp_enqueue_style('momizat-options-css');

    wp_register_script(
        'momizat-options-js',
        MOM_URI . '/framework/options/momizat/momizat.js',
        array( 'jquery' ), // Be sure to include redux-css so it's appended after the core css is applied
        time(),
        'all'
    );
    	wp_localize_script( 'momizat-options-js', 'momAjaxOpt', array(
		'url' => admin_url( 'admin-ajax.php' ),
		'nonce' => wp_create_nonce( 'ajax-nonce' ),
		)
	);

    wp_enqueue_script('momizat-options-js');

}

// This example assumes your opt_name is set to redux_demo, replace with your opt_name value
add_action( 'redux/page/'.$opt_name.'/enqueue', 'momizatCustomScripts' );
if (!defined('FS_CHMOD_DIR')) {
   define( 'FS_CHMOD_DIR', ( 0755 & ~ umask() ) );
}
if (!defined('FS_CHMOD_FILE')) {
    define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );    
}

if (!function_exists('mom_gn_upgrade_action')):
    function mom_gn_upgrade_action() { ?>
        <a class="button mom_gn_upgrade_button" href="#"><?php _e('Upgrade Now', 'theme'); ?></a><span style="line-height: 30px; color: green; margin-left:5px;"></span>
    <?php }
endif;