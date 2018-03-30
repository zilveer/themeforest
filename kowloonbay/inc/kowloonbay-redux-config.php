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
				'title' => __('Section via hook', 'KowloonBay'),
				'desc' => __('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'KowloonBay'),
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

			$customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'KowloonBay'), $this->theme->display('Name'));
			
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
						<li><?php printf(__('By %s', 'KowloonBay'), $this->theme->display('Author')); ?></li>
						<li><?php printf(__('Version %s', 'KowloonBay'), $this->theme->display('Version')); ?></li>
						<li><?php echo '<strong>' . __('Tags', 'KowloonBay') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
					</ul>
					<p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
			<?php
			if ($this->theme->parent()) {
				printf(' <p class="howto">' . __('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.') . '</p>', __('http://codex.wordpress.org/Child_Themes', 'KowloonBay'), $this->theme->parent()->display('Name'));
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
				'title' => 'General',
				'icon' => 'el-icon-website',
				'fields' => array(
					array(
						'id'        => 'general_disable_visual_editor',
						'type'      => 'checkbox',
						'title'     => __('Disable Visual Editor', 'KowloonBay'),
						'subtitle'     => __('This helps prevent the KowloonBay HTML code from being accidently modified by the visual editor. Uncheck this only when necessary.', 'KowloonBay'),
						'default'   => '1'// 1 = on | 0 = off
					),
					array(
						'id'       => 'general_use_as_logo',
						'type'     => 'radio',
						'title'    => __('Logo: Use HTML Code / Image', 'KowloonBay'), 
						'options'  => array(
							'html' => 'HTML Code', 
							'img' => 'Image', 
						),
						'default' => 'html'
					),
					array(
						'id'        => 'general_logo_html',
						'type'		=> 'ace_editor',
						'title'     => __('Logo: HTML Code', 'KowloonBay'),
						'subtitle' => __('Enter the HTML code to be used as logo. Effective only when using HTML code as logo.', 'KowloonBay'),
						'default' => '<strong>Kowloon</strong>Bay',
						'mode'		=> 'html',
						'theme'		=> 'monokai',
					),
					array(
						'id'        => 'general_logo_img',
						'type'      => 'media',
						'title'     => __('Logo: Image', 'KowloonBay'),
						'subtitle' => __('Select an image to be used as logo. Effective only when using image as logo.', 'KowloonBay'),
					),
					array(
						'id'        => 'general_auto_adjust_header_height',
						'type'      => 'checkbox',
						'title'     => __('Adjust Height of Header Automatically', 'KowloonBay'),
						'subtitle' => __('Useful when using image as logo.', 'KowloonBay'),
						'default' => '0',
					),
					array(
						'id'        => 'general_enable_preloader',
						'type'      => 'checkbox',
						'title'     => __('Preloader: Enable', 'KowloonBay'),
						'default' => '1'
					),
					array(
						'id'        => 'general_preloader_spinner',
						'type'      => 'select',
						'title'     => __('Preloader: Spinner Style', 'KowloonBay'),
						'subtitle'     => __('Select a spinner style in preloader.', 'KowloonBay'),
						'options'	=> array(
							'1'		=> 'Spinner Style 1',
							'2'		=> 'Spinner Style 2',
							'3'		=> 'Spinner Style 3',
							'6'		=> 'Spinner Style 4',
							'8'		=> 'Spinner Style 5',
						),
						'default' => '8',
					),
					array(
						'id'        => 'general_transition_duration',
						'type'      => 'text',
						'title'     => __('Transition Duration', 'KowloonBay'),
						'subtitle'      => __('Unit: second. Default: 0.3s.', 'KowloonBay'),
						'default'   => '0.3s'
					),
					array(
						'id'		=> 'general_meta_keywords',
						'type'		=> 'text',
						'title'		=> __('Meta Keywords', 'KowloonBay'),
						'subtitle'	=> __('Enter the keywords for this site in a comma separated list. Example: Keyword1, Keyword2, Keyword3.', 'KowloonBay'),
						'validate'	=> 'no_html',
						'msg'		=> 'No HTML tags allowed.',
						'default'	=> 'Keyword1, Keyword2, Keyword3'
					),
					array(
						'id'		=> 'general_meta_description',
						'type'		=> 'textarea',
						'title'		=> __('Meta Description', 'KowloonBay'),
						'subtitle'	=> __('A short and accurate summary of the content of this webpage in a single line.', 'KowloonBay'),
						'validate'	=> 'no_html',
						'msg'		=> 'No HTML tags allowed.',
						'default'	=> 'A short and accurate summary of the content of this webpage in a single line.'
					),
					array(
						'id'		=> 'general_footer_content',
						'type'		=> 'ace_editor',
						'title'		=> __('Footer Content', 'KowloonBay'),
						'subtitle'		=> __('Click "Reset Section" to retore the footer content if necessary.', 'KowloonBay'),
						'mode'		=> 'html',
						'theme'		=> 'monokai',
						'default'	=> "<!-- The HTML codes of other social icons are available at the code snippets page. -->\n<ul class=\"social list-inline\">\n	<li><a href=\"#\" class=\"facebook\" data-hover=\"&#xf09a;\"><i class=\"fa fa-facebook\"></i></a></li>\n	<li><a href=\"#\" class=\"twitter\" data-hover=\"&#xf099;\"><i class=\"fa fa-twitter\"></i></a></li>\n	<li><a href=\"#\" class=\"linkedin\" data-hover=\"&#xf0e1;\"><i class=\"fa fa-linkedin\"></i></a></li>\n	<li><a href=\"#\" class=\"google-plus\" data-hover=\"&#xf0d5;\"><i class=\"fa fa-google-plus\"></i></a></li>\n</ul>\n<p class=\"copyright\">Copyright &copy; 2014. All rights reserved.</p>"
					),
					array(
						'id'		=> 'general_custom_css',
						'type'		=> 'ace_editor',
						'title'		=> __('Custom CSS', 'KowloonBay'),
						'subtitle'	=> __('Paste your CSS code here.', 'KowloonBay'),
						'mode'		=> 'css',
						'theme'		=> 'monokai',
						'default'	=> ""
					),
					array(
						'id'		=> 'general_google_analytics_tracking_id',
						'type'		=> 'text',
						'title'		=> __('Tracking ID of Google Analytics', 'KowloonBay'),
						'subtitle'	=> __(esc_html('Enter the Tracking ID of your Google Analytics tracking code here to activate Google Analytics. Leave it empty to disable Google Analytics.'), 'KowloonBay'),
					)
				)
			);

			$this->sections[] = array(
				'title' => 'Typography',
				'icon' => 'el-icon-fontsize',
				'fields' => array(
					array(
						'id'			=> 'typography_body_text',
						'type'			=> 'typography',
						'title'			=> __('Body Font', 'KowloonBay'),
						'subtitle'		=> __('Specify the body font properties. Default: Raleway.', 'KowloonBay'),
						'google'		=> true,
						'subsets'		=> false,
						'text-align'	=> false,
						'font-weight'	=> false,
						'font-style'	=> false,
						'line-height'	=> false,
						'color'			=> false,
						'preview'		=> array(
											'text' => 'The quick brown fox jumps over the lazy dog',
											'font-size' => '24px',
											'always_display' => true
											),
						'default'		=> array(
											'font-size'     => '14px',
											'font-family'   => 'Raleway',
											'font-weight'   => '400',
											'line-height'	=> '23px'
											),
					),
					array(
						'id'		=> 'typography_body_light_font_weight',
						'type'      => 'select',
						'title'     => __('Body Font: Light Font Weight', 'KowloonBay'),
						'subtitle'  => __('Certain font weights may not be available for certain Google Fonts. Default: 200.', 'KowloonBay'),
						
						'options'   => array(
							'100' => '100', 
							'200' => '200', 
							'300' => '300',
							'400' => '400',
							'500' => '500',
							'600' => '600',
							'700' => '700',
							'800' => '800',
							'900' => '900',
						),
						'default'   => '200'
					),
					array(
						'id'		=> 'typography_body_medium_font_weight',
						'type'      => 'select',
						'title'     => __('Body Font: Medium Font Weight', 'KowloonBay'),
						'subtitle'  => __('Certain font weights may not be available for certain Google Fonts. Default: 400.', 'KowloonBay'),
						
						'options'   => array(
							'100' => '100', 
							'200' => '200', 
							'300' => '300',
							'400' => '400',
							'500' => '500',
							'600' => '600',
							'700' => '700',
							'800' => '800',
							'900' => '900',
						),
						'default'   => '400'
					),
					array(
						'id'		=> 'typography_body_heavy_font_weight',
						'type'      => 'select',
						'title'     => __('Body Font: Heavy Font Weight', 'KowloonBay'),
						'subtitle'  => __('Certain font weights may not be available for certain Google Fonts. Default: 800.', 'KowloonBay'),
						
						'options'   => array(
							'100' => '100', 
							'200' => '200', 
							'300' => '300',
							'400' => '400',
							'500' => '500',
							'600' => '600',
							'700' => '700',
							'800' => '800',
							'900' => '900',
						),
						'default'   => '800'
					),
					array(
						'id'		=> 'typography_body_text_letter_spacing',
						'type'      => 'text',
						'title'     => __('Body Font: Letter Spacing', 'KowloonBay'),
						'subtitle'     => __('CSS / LESS Syntax is used here. Default: 1px.', 'KowloonBay'),
						'default'   => '1px'
					),
					array(
						'id'			=> 'typography_title_text',
						'type'			=> 'typography',
						'title'			=> __('Title Font', 'KowloonBay'),
						'subtitle'		=> __('Specify the title font properties. Default: Montserrat.', 'KowloonBay'),
						'google'		=> true,
						'subsets'		=> false,
						'text-align'	=> false,
						'font-weight'	=> false,
						'font-style'	=> false,
						'line-height'	=> false,
						'font-size'		=> false,
						'color'			=> false,
						'preview'		=> array(
											'text' => 'The quick brown fox jumps over the lazy dog',
											'font-size' => '24px',
											'always_display' => true
											),
						'default'		=> array(
											'font-family'   => 'Montserrat',
											),
					),
					array(
						'id'		=> 'typography_title_medium_font_weight',
						'type'      => 'select',
						'title'     => __('Title Font: Medium Font Weight', 'KowloonBay'),
						'subtitle'  => __('Certain font weights may not be available for certain Google Fonts. Default: 400.', 'KowloonBay'),
						
						'options'   => array(
							'100' => '100', 
							'200' => '200', 
							'300' => '300',
							'400' => '400',
							'500' => '500',
							'600' => '600',
							'700' => '700',
							'800' => '800',
							'900' => '900',
						),
						'default'   => '400'
					),
					array(
						'id'		=> 'typography_title_heavy_font_weight',
						'type'      => 'select',
						'title'     => __('Title Font: Heavy Font Weight', 'KowloonBay'),
						'subtitle'  => __('Certain font weights may not be available for certain Google Fonts. Default: 700.', 'KowloonBay'),
						
						'options'   => array(
							'100' => '100', 
							'200' => '200', 
							'300' => '300',
							'400' => '400',
							'500' => '500',
							'600' => '600',
							'700' => '700',
							'800' => '800',
							'900' => '900',
						),
						'default'   => '700'
					),
					array(
						'id'		=> 'typography_enable_webkit_subpixel_antialiasing',
						'type'		=> 'checkbox',
						'title'		=> __('Enable Subpixel Antialiasing for Texts in Webkit Browsers', 'KowloonBay'),
						'default'	=> '0'
					),
				)
			);

			$this->sections[] = array(
				'title' => 'Dimensions',
				'icon' => 'el-icon-resize-horizontal',
				'fields' => array(
					array(
						'id'        => 'dim_base_line_height',
						'type'      => 'text',
						'title'     => __('Base Line Height', 'KowloonBay'),
						'subtitle'  => __('CSS / LESS syntax is used here. Defined as the LESS variable @baseLineHeight. Default: 23px.', 'KowloonBay'),
						'default'   => '23px',
					),
					array(
						'id'        => 'dim_base_height',
						'type'      => 'text',
						'title'     => __('Base Height (1X Height)', 'KowloonBay'),
						'subtitle'  => __('Base Height is used to when defining the heights of portfolio items, carousels, photos, etc. CSS / LESS syntax is used here. Default: @baseLineHeight*12.', 'KowloonBay'),
						'default'   => '@baseLineHeight*12',
					),
					array(
						'id'        => 'dim_page_padding_h',
						'type'      => 'text',
						'title'     => __('Page Padding: Horizontal', 'KowloonBay'),
						'subtitle'  => __('CSS / LESS syntax is used here. Default: @baseLineHeight*3.', 'KowloonBay'),
						'default'   => '@baseLineHeight*3',
					),
					array(
						'id'        => 'dim_page_padding_v',
						'type'      => 'text',
						'title'     => __('Page Padding: Vertical', 'KowloonBay'),
						'subtitle'  => __('CSS / LESS syntax is used here. Default: @baseLineHeight*4.', 'KowloonBay'),
						'default'   => '@baseLineHeight*4',
					),
					array(
						'id'        => 'dim_multi_level_menu_border_radius',
						'type'      => 'text',
						'title'     => __('Border Radius of Multi-Level Menu', 'KowloonBay'),
						'subtitle'  => __('CSS / LESS syntax is used here. Default: 4px.', 'KowloonBay'),
						'default'   => '4px',
					),
					array(
						'id'        => 'dim_gutter_width',
						'type'      => 'text',
						'title'     => __('Gutter Width of Grids', 'KowloonBay'),
						'subtitle'  => __('CSS / LESS syntax is used here. Default: 6px.', 'KowloonBay'),
						'default'   => '6px',
					),
				)
			);

			$this->sections[] = array(
				'title' => 'Color Scheme',
				'icon' => 'el-icon-brush',
				'fields' => array(
					array(
						'id'        => 'color_scheme_primary_color',
						'type'      => 'color',
						'title'     => __('Primary Color', 'KowloonBay'),
						'subtitle'  => __('Defined as the LESS variable @primaryColor. Default: #cabaa7.', 'KowloonBay'),
						'default'   => '#cabaa7',
						'validate'  => 'color',
					),
					array(
						'id'        => 'color_scheme_bg_color',
						'type'      => 'color',
						'title'     => __('Background Color', 'KowloonBay'),
						'subtitle'  => __('Defined as the LESS variable @bgColor. Default: #ffffff.', 'KowloonBay'),
						'default'   => '#ffffff',
						'validate'  => 'color',
					),
					array(
						'id'        => 'color_scheme_home_bg_color',
						'type'      => 'text',
						'title'     => __('Background Color of Homepage', 'KowloonBay'),
						'subtitle'  => __('CSS / LESS syntax is used here. Default: @titleTextColor.', 'KowloonBay'),
						'default'   => '@titleTextColor',
					),
					array(
						'id'        => 'color_scheme_body_text_color',
						'type'      => 'color',
						'title'     => __('Body Text Color', 'KowloonBay'),
						'subtitle'  => __('Defined as the LESS variable @bodyTextColor. Default: #444444.', 'KowloonBay'),
						'default'   => '#444444',
						'validate'  => 'color',
					),
					array(
						'id'        => 'color_scheme_title_text_color',
						'type'      => 'color',
						'title'     => __('Title Text Color', 'KowloonBay'),
						'subtitle'  => __('Defined as the LESS variable @titleTextColor. Default: #222222.', 'KowloonBay'),
						'default'   => '#222222',
						'validate'  => 'color',
					),
					array(
						'id'        => 'color_scheme_preloader_bg_color',
						'type'      => 'text',
						'title'     => __('Preloader Background Color', 'KowloonBay'),
						'subtitle'  => __('CSS / LESS syntax is used here. Default: @titleTextColor.', 'KowloonBay'),
						'default'   => '@titleTextColor',
					),
					array(
						'id'        => 'color_scheme_icon_color',
						'type'      => 'text',
						'title'     => __('Icon Color', 'KowloonBay'),
						'subtitle'      => __('CSS / LESS syntax is used here. Default: fadeout(desaturate(@primaryColor, 100%), 50%).', 'KowloonBay'),
						'default'   => 'fadeout(desaturate(@primaryColor, 100%), 50%)'
					),
					array(
						'id'        => 'color_scheme_link_color',
						'type'      => 'text',
						'title'     => __('Link Color', 'KowloonBay'),
						'subtitle'      => __('CSS / LESS syntax is used here. Default: @primaryColor.', 'KowloonBay'),
						'default'   => '@primaryColor'
					),
					array(
						'id'        => 'color_scheme_link_hover_color',
						'type'      => 'text',
						'title'     => __('Link Color (Hover)', 'KowloonBay'),
						'subtitle'      => __('CSS / LESS syntax is used here. Default: spin(@primaryColor, 180).', 'KowloonBay'),
						'default'   => 'spin(@primaryColor, 180)'
					),
					array(
						'id'        => 'color_scheme_image_hover_overlay_color',
						'type'      => 'text',
						'title'     => __('Overlay Color of Image Hover Effect', 'KowloonBay'),
						'subtitle'  => __('Image hover effect is used in portfolio items, team members and blog items. CSS / LESS syntax is used here. Default: @titleTextColor.', 'KowloonBay'),
						'default'   => '@titleTextColor',
					),
					array(
						'id'        => 'color_scheme_image_hover_overlay_opacity',
						'type'      => 'text',
						'title'     => __('Overlay Opacity of Image Hover Effect', 'KowloonBay'),
						'subtitle'  => __('Image hover effect is used in portfolio items, team members and blog items. Must be a decimal number between 0 and 1 here. Default: 0.5.', 'KowloonBay'),
						'default'   => '0.5',
					),
					array(
						'id'        => 'color_scheme_footer_text_color',
						'type'      => 'text',
						'title'     => __('Footer Text Color', 'KowloonBay'),
						'subtitle'      => __('CSS / LESS syntax is used here. Default: fadeout(@bodyTextColor, 50%).', 'KowloonBay'),
						'default'   => 'fadeout(@bodyTextColor, 50%)'
					),
				)
			);

			$this->sections[] = array(
				'title' => 'Homepage Video',
				'icon' => 'el-icon-play-alt',
				'fields' => array(
					array(
						'id'        => 'homepage_youtube_or_html5',
						'type'      => 'radio',
						'title'     => __('Use YouTube / HTML5 Video Background', 'KowloonBay'),
						'options'	=> array(
							'youtube'	=> 'YouTube',
							'html5'	=> 'HTML5 Video',
						),
						'default'	=> 'youtube',
					),
					array(
						'id'        => 'homepage_bg_video_poster',
						'type'      => 'media',
						'title'     => __('Video Poster', 'KowloonBay'),
						'subtitle'      => __('Fallback image to be shown for iOS Safari and to be displayed while the background video is downloading.', 'KowloonBay'),
					),
					array(
						'id'        => 'homepage_youtube_url',
						'type'      => 'text',
						'title'     => __('YouTube Background: URL', 'KowloonBay'),
						'subtitle'      => __('Specify the URL of the YouTube video to be used as video background.', 'KowloonBay'),
						'validate'  => 'url',
					),
					array(
						'id'        => 'homepage_youtube_quality',
						'type'      => 'select',
						'title'     => __('YouTube Background: Quality', 'KowloonBay'),
						'subtitle'      => __('Specify the quality of the YouTube video background.', 'KowloonBay'),
						'options'	=> array(
							'default'	=> 'Auto Detect',
							'small'	=> 'Small',
							'medium'	=> 'Medium',
							'large'	=> 'Large',
							'hd720'	=> 'HD720',
							'hd1080'	=> 'HD1080',
							'highre'	=> 'High Resolution',
						),
						'default'  => 'default',
					),
					array(
						'id'        => 'homepage_youtube_mute',
						'type'      => 'checkbox',
						'title'     => __('YouTube Background: Mute', 'KowloonBay'),
						'default'  => '1',
					),
					array(
						'id'        => 'homepage_youtube_loop',
						'type'      => 'checkbox',
						'title'     => __('YouTube Background: Loop', 'KowloonBay'),
						'default'  => '0',
					),
					array(
						'id'        => 'homepage_youtube_opacity',
						'type'      => 'select',
						'title'     => __('YouTube Background: Opacity', 'KowloonBay'),
						'options'	=> array(
							'1'		=> 1,
							'.8'	=> 0.8,
							'.5'	=> 0.5,
							'.3'	=> 0.3,
						),
						'default'  => '1',
					),
					array(
						'id'        => 'homepage_youtube_start_at',
						'type'      => 'text',
						'title'     => __('YouTube Background: Start at', 'KowloonBay'),
						'subtitle'     => __('Enter a number here without the unit. Unit: seconds. If left empty, the YouTube video will start at 0 sec.', 'KowloonBay'),
						'default'  => '',
					),
					array(
						'id'        => 'homepage_youtube_stop_at',
						'type'      => 'text',
						'title'     => __('YouTube Background: Stop at', 'KowloonBay'),
						'subtitle'     => __('Enter a number here without the unit. Unit: seconds. If left empty, the YouTube video will play till the end.', 'KowloonBay'),
						'default'  => '',
					),
					array(
						'id'        => 'homepage_bg_video_mp4',
						'type'      => 'text',
						'title'     => __('HTML5 Video Background: MP4', 'KowloonBay'),
						'subtitle'      => __('Specify the MP4 background video for homepage', 'KowloonBay'),
						'validate'  => 'url',
					),
					array(
						'id'        => 'homepage_bg_video_webm',
						'type'      => 'text',
						'title'     => __('HTML5 Video Background: WebM', 'KowloonBay'),
						'subtitle'      => __('Specify the WebM background video for homepage', 'KowloonBay'),
					),
					array(
						'id'        => 'homepage_bg_video_ogv',
						'type'      => 'text',
						'title'     => __('HTML5 Video Background: OGV', 'KowloonBay'),
						'subtitle'      => __('Specify the OGV background video for homepage', 'KowloonBay'),
					),
				)
			);

			$this->sections[] = array(
				'title' => 'Portfolio',
				'icon' => 'el-icon-th-large',
				'fields' => array(
					array(
						'id'        => 'portfolio_layout',
						'type'      => 'select',
						'title'     => __('Portfolio Layout', 'KowloonBay'),
						'options'   => array(
							'h' => 'Horizontal', 
							'm' => 'Masonry', 
							'2' => 'Two Columns', 
							'3' => 'Three Columns', 
							'4' => 'Four Columns', 
						),
						'default'   => 'h'
					),
					array(
						'id'        => 'portfolio_boxed',
						'type'      => 'checkbox',
						'title'     => __('Use Boxed Layout', 'KowloonBay'),
						'default'   => '0'// 1 = on | 0 = off
					),
					array(
						'id'        => 'portfolio_infinite_scroll',
						'type'      => 'checkbox',
						'title'     => __('Enable Infinite Scroll', 'KowloonBay'),
						'subtitle'      => __('If infinite scroll is disabled, all portfolio items will be loaded.', 'KowloonBay'),
						'default'   => '1'// 1 = on | 0 = off
					),
					array(
						'id'        => 'portfolio_posts_per_page',
						'type'      => 'text',
						'title'     => __('Number of Portfolio Items to Load Each Time', 'KowloonBay'),
						'subtitle'      => __('Effective only when infinite scroll is enabled. Must be a number. Default: 6.', 'KowloonBay'),
						'default'   => '6'
					),
					array(
						'id'        => 'portfolio_masonry_base_col_grid',
						'type'      => 'select',
						'title'     => __('Masonry Base Column Grid', 'KowloonBay'),
						'subtitle'     => __('Effective only when masonry layout is used.', 'KowloonBay'),
						'options'   => array(
							'2' => 'Two-Column Grid', 
							'3' => 'Three-Column Grid', 
							'4' => 'Four-Column Grid', 
						),
						'default'   => '3'
					),
					array(
						'id'        => 'portfolio_ordering',
						'type'      => 'radio',
						'title'     => __('Ordering of Portfolio Items', 'KowloonBay'),
						'subtitle'     => __('Default: Ascending.', 'KowloonBay'),
						'options'	=> array(
							'ASC'	=> 'Ascending',
							'DESC'	=> 'Descending',
						),
						'default'   => 'ASC'
					),
					array(
						'id'        => 'portfolio_hide_cat_icon',
						'type'      => 'checkbox',
						'title'     => __('Hide Icons above Portfolio Categories', 'KowloonBay'),
						'default'   => '0'
					),
					array(
						'id'        => 'portfolio_cat_all_label',
						'type'      => 'text',
						'title'     => __('Label for Portfolio Category "All"', 'KowloonBay'),
						'default'   => 'All'
					),
					array(
						'id'        => 'portfolio_cat_all_icon',
						'type'      => 'text',
						'title'     => __('Icon for Portfolio Category "All"', 'KowloonBay'),
						'subtitle'     => __('Enter a Font Awesome icon or an valid URL of icon image. Default: fa-th.', 'KowloonBay'),
						'default'   => 'fa-th'
					),
					array(
						'id'        => 'portfolio_show_related_projects',
						'type'      => 'checkbox',
						'title'     => __('Show Related Projects for Portfolio Items', 'KowloonBay'),
						'default'   => '1'
					),
					array(
						'id'        => 'portfolio_related_projects_label',
						'type'      => 'text',
						'title'     => __('Label for Related Projects', 'KowloonBay'),
						'default'   => 'Related Projects'
					),
					array(
						'id'        => 'portfolio_video_posters_always_cover',
						'type'      => 'checkbox',
						'title'     => __('Always Let Video Posters Cover the Whole Video Slider', 'KowloonBay'),
						'default'   => '1'
					),
					array(
						'id'        => 'portfolio_use_high_res_video_posters',
						'type'      => 'checkbox',
						'title'     => __('Detect and Use High-Resolution Video Posters', 'KowloonBay'),
						'default'   => '1'
					),
				)
			);

			$this->sections[] = array(
				'title' => 'Team',
				'icon' => 'el-icon-group',
				'fields' => array(
					array(
						'id'        => 'team_max_col',
						'type'      => 'text',
						'title'     => __('Maximum Number of Columns When Listing All Team Members', 'KowloonBay'),
						'subtitle'     => __('Must be a integer greater than 1. Default: 4.', 'KowloonBay'),
						'default'   => '4'
					),
					array(
						'id'        => 'team_show_others',
						'type'      => 'checkbox',
						'title'     => __('Show Other Team Members on Individual Member Page', 'KowloonBay'),
						'default'   => '1'
					),
					array(
						'id'        => 'team_label_others',
						'type'      => 'text',
						'title'     => __('Label for Other Team Members', 'KowloonBay'),
						'default'   => 'Other Team Members'
					),
				)
			);

			$this->sections[] = array(
				'title' => 'Blog',
				'icon' => 'el-icon-pencil',
				'fields' => array(
					array(
						'id'        => 'blog_layout',
						'type'      => 'select',
						'title'     => __('Blog Layout', 'KowloonBay'),
						'options'   => array(
							'masonry' => 'Masonry', 
							'no_sidebar' => 'No Sidebar', 
							'no_sidebar_full_width' => 'No Sidebar (Full Width)', 
							'left_sidebar' => 'Left Sidebar', 
							'right_sidebar' => 'Right Sidebar', 
						),
						'default'   => 'masonry'
					),
					array(
						'id'        => 'blog_post_full_width',
						'type'      => 'checkbox',
						'title'     => __('Use Full Width Layout on Single Post Pages when no sidebar exists', 'KowloonBay'),
						'default'   => '1'
					),
					array(
						'id'        => 'blog_clickable_block',
						'type'      => 'checkbox',
						'title'     => __('Make Blog Posts Clickable on Index Pages', 'KowloonBay'),
						'subtitle'      => __('This will make the whole area of each blog post clickable on blog index pages.', 'KowloonBay'),
						'default'   => '1'
					),
					array(
						'id'        => 'blog_infinite_scroll',
						'type'      => 'checkbox',
						'title'     => __('Enable Infinite Scroll', 'KowloonBay'),
						'subtitle'      => __('If infinite scroll is disabled, blog posts will be paged.', 'KowloonBay'),
						'default'   => '1'
					),
					array(
						'id'        => 'blog_pagination_align',
						'type'      => 'select',
						'title'     => __('Alignment of Pagination', 'KowloonBay'),
						'options'  => array(
							'left' => 'Left', 
							'center' => 'Center', 
							'right' => 'Right', 
						),
						'default'   => 'center'
					),
					array(
						'id'        => 'blog_label_continue_reading',
						'type'      => 'text',
						'title'     => __('Label for Continue Reading', 'KowloonBay'),
						'default'   => 'Continue Reading'
					),
					array(
						'id'        => 'blog_show_prev_next',
						'type'      => 'checkbox',
						'title'     => __('Show Previous / Next Post on Single Post Page', 'KowloonBay'),
						'default'   => '1'
					),
					array(
						'id'        => 'blog_toolbar_items',
						'type'      => 'checkbox',
						'title'     => __('Toolbar: Items', 'KowloonBay'),
						'subtitle'     => __('Select items to be shown in toolbar.', 'KowloonBay'),
						'options'	=> array(
							'a'		=> 'Archive',
							'c'		=> 'Categories',
							't'		=> 'Tags',
							's'		=> 'Search',
						),
						'default'   => array(
							'a'		=> '1',
							'c'		=> '1',
							't'		=> '1',
							's'		=> '1',
						)
					),
					array(
						'id'        => 'blog_toolbar_fa_icon_archive',
						'type'      => 'text',
						'title'     => __('Toolbar: Icon for Archive', 'KowloonBay'),
						'subtitle'     => __('Enter a Font Awesome icon class here. Default: fa-calendar.', 'KowloonBay'),
						'default'   => 'fa-calendar'
					),
					array(
						'id'        => 'blog_toolbar_fa_icon_cats',
						'type'      => 'text',
						'title'     => __('Toolbar: Icon for Categories', 'KowloonBay'),
						'subtitle'     => __('Enter a Font Awesome icon class here. Default: fa-bookmark-o.', 'KowloonBay'),
						'default'   => 'fa-bookmark-o'
					),
					array(
						'id'        => 'blog_toolbar_fa_icon_tags',
						'type'      => 'text',
						'title'     => __('Toolbar: Icon for Tags', 'KowloonBay'),
						'subtitle'     => __('Enter a Font Awesome icon class here. Default: fa-tags.', 'KowloonBay'),
						'default'   => 'fa-tags'
					),
					array(
						'id'        => 'blog_toolbar_fa_icon_search',
						'type'      => 'text',
						'title'     => __('Toolbar: Icon for Search', 'KowloonBay'),
						'subtitle'     => __('Enter a Font Awesome icon class here. Default: fa-search.', 'KowloonBay'),
						'default'   => 'fa-search'
					),

					array(
						'id'        => 'blog_toolbar_label_archive',
						'type'      => 'text',
						'title'     => __('Toolbar: Label for Archive', 'KowloonBay'),
						'default'   => 'Archive'
					),
					array(
						'id'        => 'blog_toolbar_label_cats',
						'type'      => 'text',
						'title'     => __('Toolbar: Label for Categories', 'KowloonBay'),
						'default'   => 'Categories'
					),
					array(
						'id'        => 'blog_toolbar_label_tags',
						'type'      => 'text',
						'title'     => __('Toolbar: Label for Tags', 'KowloonBay'),
						'default'   => 'Tags'
					),
					array(
						'id'        => 'blog_toolbar_label_search',
						'type'      => 'text',
						'title'     => __('Toolbar: Label for Search', 'KowloonBay'),
						'default'   => 'Search'
					),

					array(
						'id'        => 'blog_infobar_items',
						'type'      => 'checkbox',
						'title'     => __('Info: Items', 'KowloonBay'),
						'subtitle'     => __('Select items to be shown in infobar.', 'KowloonBay'),
						'options'	=> array(
							'd'		=> 'Date',
							'a'		=> 'Author',
							'c'		=> 'Category',
							'co'		=> 'Comments',
						),
						'default'   => array(
							'd'		=> '1',
							'a'		=> '0',
							'c'		=> '1',
							'co'		=> '1',
						)
					),
					array(
						'id'        => 'blog_infobar_fa_icon_date',
						'type'      => 'text',
						'title'     => __('Infobar: Icon for Date', 'KowloonBay'),
						'subtitle'     => __('Enter a Font Awesome icon class here. Default: fa-calendar.', 'KowloonBay'),
						'default'   => 'fa-calendar'
					),
					array(
						'id'        => 'blog_infobar_fa_icon_author',
						'type'      => 'text',
						'title'     => __('Infobar: Icon for Author', 'KowloonBay'),
						'subtitle'     => __('Enter a Font Awesome icon class here. Default: fa-user.', 'KowloonBay'),
						'default'   => 'fa-user'
					),
					array(
						'id'        => 'blog_infobar_fa_icon_cat',
						'type'      => 'text',
						'title'     => __('Infobar: Icon for Category', 'KowloonBay'),
						'subtitle'     => __('Enter a Font Awesome icon class here. Default: fa-bookmark-o.', 'KowloonBay'),
						'default'   => 'fa-bookmark-o'
					),
					array(
						'id'        => 'blog_infobar_fa_icon_comments',
						'type'      => 'text',
						'title'     => __('Infobar: Icon for Comments', 'KowloonBay'),
						'subtitle'     => __('Enter a Font Awesome icon class here. Default: fa-comments-o.', 'KowloonBay'),
						'default'   => 'fa-comments-o'
					),
					array(
						'id'        => 'blog_link_fa_icon',
						'type'      => 'text',
						'title'     => __('Post Icon: Link', 'KowloonBay'),
						'subtitle'     => __('Enter a Font Awesome icon class here. Default: fa-link.', 'KowloonBay'),
						'default'   => 'fa-link'
					),
					array(
						'id'        => 'blog_quote_fa_icon',
						'type'      => 'text',
						'title'     => __('Post Icon: Quote', 'KowloonBay'),
						'subtitle'     => __('Enter a Font Awesome icon class here. Default: fa-quote-left.', 'KowloonBay'),
						'default'   => 'fa-quote-left'
					),
					array(
						'id'        => 'blog_status_fa_icon',
						'type'      => 'text',
						'title'     => __('Post Icon: Status', 'KowloonBay'),
						'subtitle'     => __('Enter a Font Awesome icon class here. Default: fa-comment-o.', 'KowloonBay'),
						'default'   => 'fa-comment-o'
					),
				)
			);

			$this->sections[] = array(
				'title' => 'Google Maps',
				'icon'      => 'el-icon-map-marker',
				'fields' => array(
					array(
						'id'        => 'google_maps_lat',
						'type'      => 'text',
						'title'     => __('Latitude', 'KowloonBay'),
						'subtitle'      => __('Latitude for Google Maps. Example: 22.323663.', 'KowloonBay'),
						'default'   => '22.323663'
					),
					array(
						'id'        => 'google_maps_long',
						'type'      => 'text',
						'title'     => __('Longitude', 'KowloonBay'),
						'subtitle'      => __('Longitude for Google Maps. Example: 114.214035.', 'KowloonBay'),
						'default'   => '114.214035'
					),
					array(
						'id'        => 'google_maps_zoom',
						'type'      => 'text',
						'title'     => __('Zoom', 'KowloonBay'),
						'subtitle'      => __('Zoom level for Google Maps. Default: 15.', 'KowloonBay'),
						'default'   => '15'
					),
					array(
						'id'        => 'google_maps_styled',
						'type'      => 'checkbox',
						'title'     => __('Style Google Maps', 'KowloonBay'),
						'subtitle'     => __('Use styled Google Maps or the original version.', 'KowloonBay'),
						'default'   => '1'// 1 = on | 0 = off
					),
					array(
						'id'        => 'google_maps_marker_icon',
						'type'      => 'media',
						'title'     => __('Marker Icon', 'KowloonBay'),
						'subtitle'      => __('Enter the valid URL of an image to be used as the marker icon.', 'KowloonBay'),
						'default'   => ''
					),
					array(
						'id'        => 'google_maps_marker_animation',
						'type'      => 'select',
						'title'     => __('Marker Animation', 'KowloonBay'),
						'subtitle'      => __('Default: None.', 'KowloonBay'),
						'default'   => 'none',
						'options'	=> array(
							'none'	=> 'None',
							'drop'	=> 'Drop',
							'bounce'	=> 'Bounce',
							)
					),
					array(
						'id'        => 'google_maps_gamma',
						'type'      => 'text',
						'title'     => __('Gamma', 'KowloonBay'),
						'subtitle'      => __('Gamma value for coloring Google Maps. Effective only when styled Google Maps are used. Default: 1.75.', 'KowloonBay'),
						'default'   => '1.75'
					),
					array(
						'id'        => 'google_maps_saturation',
						'type'      => 'text',
						'title'     => __('Saturation', 'KowloonBay'),
						'subtitle'      => __('Saturation value for coloring Google Maps. Effective only when styled Google Maps are used. Default: -80.', 'KowloonBay'),
						'default'   => '-100'
					),
					array(
						'id'        => 'google_maps_lightness',
						'type'      => 'text',
						'title'     => __('Lightness', 'KowloonBay'),
						'subtitle'      => __('Lightness value for coloring Google Maps. Effective only when styled Google Maps are used. Default: -10.', 'KowloonBay'),
						'default'   => '-10'
					),
					array(
						'id'        => 'google_maps_invert_lightness',
						'type'      => 'checkbox',
						'title'     => __('Invert lightness', 'KowloonBay'),
						'subtitle'     => __('Light / Dark version of Google Maps. Effective only when styled Google Maps are used.', 'KowloonBay'),
						'default'   => '1'// 1 = on | 0 = off
					),
					array(
						'id'        => 'google_maps_disable_default_ui',
						'type'      => 'checkbox',
						'title'     => __('Disable Default Google Maps UI', 'KowloonBay'),
						'subtitle'     => __('Hide / Show the default Google Maps UI', 'KowloonBay'),
						'default'   => '0'// 1 = on | 0 = off
					),
					array(
						'id'        => 'google_maps_scrollwheel',
						'type'      => 'checkbox',
						'title'     => __('Enable Mouse Scrollwheel', 'KowloonBay'),
						'subtitle'     => __('Use the mouse scrollwheel to zoom in / out Google Maps', 'KowloonBay'),
						'default'   => '0'// 1 = on | 0 = off
					),
					array(
						'id'		=> 'google_maps_info_window_content_string',
						'type'		=> 'textarea',
						'title'     => __('Content string for info window', 'KowloonBay'),
						'subtitle'  => __('Please use JavaScript string syntax. Use \'\' (two single quotes) as value if you don\'t have any content in the info window.', 'KowloonBay'),
						'validate'	=> 'js',
						'msg'		=> 'No HTML tags allowed.',
						'default'   => '\'<h4>Info Window</h4>\' + \'<p>You can add content here</p>\''
					),
				)
			);

			$this->sections[] = array(
				'title' => 'Breadcrumb',
				'icon' => 'el-icon-chevron-right',
				'fields' => array(
					array(
						'id'        => 'breadcrumb_icon',
						'type'      => 'text',
						'title'     => __('Font Awesome Icon for Breadcrumb Symbol', 'KowloonBay'),
						'subtitle'     => __('Default: fa-caret-right.', 'KowloonBay'),
						'validate'  => 'not_empty',
						'default'   => 'fa-caret-right',
					),
					array(
						'id'        => 'breadcrumb_home_label',
						'type'      => 'text',
						'title'     => __('Label for Homepage in Breadcrumb', 'KowloonBay'),
						'validate'  => 'not_empty',
						'default'   => 'Home',
					),
					array(
						'id'        => 'breadcrumb_portfolio_display',
						'type'      => 'checkbox',
						'title'     => __('Portfolio: Display Breadcrumb', 'KowloonBay'),
						'default'   => '1'// 1 = on | 0 = off
					),
					array(
						'id'        => 'breadcrumb_portfolio_display_cat',
						'type'      => 'checkbox',
						'title'     => __('Portfolio: Display Category in Breadcrumb', 'KowloonBay'),
						'default'   => '1'// 1 = on | 0 = off
					),
					array(
						'id'        => 'breadcrumb_portfolio_label',
						'type'      => 'text',
						'title'     => __('Portfolio: Label in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, the title of the portfolio page specified above will be used.', 'KowloonBay'),
						'default'   => 'Portfolio',
					),
					array(
						'id'        => 'breadcrumb_portfolio_page_1',
						'type'      => 'select',
						'title'     => __('Portfolio #1: Page in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, "#" will be used as the URL for portfolio in breadcrumb.', 'KowloonBay'),
						'data'   => 'pages',
					),
					array(
						'id'        => 'breadcrumb_portfolio_page_2',
						'type'      => 'select',
						'title'     => __('Portfolio #2: Page in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, "#" will be used as the URL for portfolio in breadcrumb.', 'KowloonBay'),
						'data'   => 'pages',
					),array(
						'id'        => 'breadcrumb_portfolio_page_3',
						'type'      => 'select',
						'title'     => __('Portfolio #3: Page in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, "#" will be used as the URL for portfolio in breadcrumb.', 'KowloonBay'),
						'data'   => 'pages',
					),array(
						'id'        => 'breadcrumb_portfolio_page_4',
						'type'      => 'select',
						'title'     => __('Portfolio #4: Page in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, "#" will be used as the URL for portfolio in breadcrumb.', 'KowloonBay'),
						'data'   => 'pages',
					),array(
						'id'        => 'breadcrumb_portfolio_page_5',
						'type'      => 'select',
						'title'     => __('Portfolio #5: Page in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, "#" will be used as the URL for portfolio in breadcrumb.', 'KowloonBay'),
						'data'   => 'pages',
					),array(
						'id'        => 'breadcrumb_portfolio_page_6',
						'type'      => 'select',
						'title'     => __('Portfolio #6: Page in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, "#" will be used as the URL for portfolio in breadcrumb.', 'KowloonBay'),
						'data'   => 'pages',
					),array(
						'id'        => 'breadcrumb_portfolio_page_7',
						'type'      => 'select',
						'title'     => __('Portfolio #7: Page in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, "#" will be used as the URL for portfolio in breadcrumb.', 'KowloonBay'),
						'data'   => 'pages',
					),array(
						'id'        => 'breadcrumb_portfolio_page_8',
						'type'      => 'select',
						'title'     => __('Portfolio #8: Page in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, "#" will be used as the URL for portfolio in breadcrumb.', 'KowloonBay'),
						'data'   => 'pages',
					),array(
						'id'        => 'breadcrumb_portfolio_page_9',
						'type'      => 'select',
						'title'     => __('Portfolio #9: Page in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, "#" will be used as the URL for portfolio in breadcrumb.', 'KowloonBay'),
						'data'   => 'pages',
					),array(
						'id'        => 'breadcrumb_portfolio_page_10',
						'type'      => 'select',
						'title'     => __('Portfolio #10: Page in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, "#" will be used as the URL for portfolio in breadcrumb.', 'KowloonBay'),
						'data'   => 'pages',
					),
					array(
						'id'        => 'breadcrumb_team_display',
						'type'      => 'checkbox',
						'title'     => __('Team: Display Breadcrumb', 'KowloonBay'),
						'default'   => '1'// 1 = on | 0 = off
					),
					array(
						'id'        => 'breadcrumb_team_page',
						'type'      => 'select',
						'title'     => __('Team: Page in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, "#" will be used as the URL for team in breadcrumb.', 'KowloonBay'),
						'data'   => 'pages',
					),
					array(
						'id'        => 'breadcrumb_team_label',
						'type'      => 'text',
						'title'     => __('Team: Label in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, the title of the team page specified above will be used.', 'KowloonBay'),
						'default'   => 'Team',
					),
					array(
						'id'        => 'breadcrumb_services_display',
						'type'      => 'checkbox',
						'title'     => __('Services: Display Breadcrumb', 'KowloonBay'),
						'default'   => '1'// 1 = on | 0 = off
					),
					array(
						'id'        => 'breadcrumb_services_page',
						'type'      => 'select',
						'title'     => __('Services: Page in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, "#" will be used as the URL for services in breadcrumb.', 'KowloonBay'),
						'data'   => 'pages',
					),
					array(
						'id'        => 'breadcrumb_services_label',
						'type'      => 'text',
						'title'     => __('Services: Label in Breadcrumb', 'KowloonBay'),
						'subtitle'     => __('If left empty, the title of the services page specified above will be used.', 'KowloonBay'),
						'default'   => 'Services',
					),
				)
			);

			$noAnimation = array('no-animation' => '(No Animation)');
			
			$defaultAnimation = array('default-animation' => '(Default Animation)');

			$animations = array(
				"bounce" => "bounce",
				"flash" => "flash",
				"pulse" => "pulse",
				"rubberBand" => "rubberBand",
				"shake" => "shake",
				"swing" => "swing",
				"tada" => "tada",
				"wobble" => "wobble",

				"bounceIn" => "bounceIn",
				"bounceInDown" => "bounceInDown",
				"bounceInLeft" => "bounceInLeft",
				"bounceInRight" => "bounceInRight",
				"bounceInUp" => "bounceInUp",

				"bounceOut" => "bounceOut",
				"bounceOutDown" => "bounceOutDown",
				"bounceOutLeft" => "bounceOutLeft",
				"bounceOutRight" => "bounceOutRight",
				"bounceOutUp" => "bounceOutUp",

				"fadeIn" => "fadeIn",
				"fadeInDown" => "fadeInDown",
				"fadeInDownBig" => "fadeInDownBig",
				"fadeInLeft" => "fadeInLeft",
				"fadeInLeftBig" => "fadeInLeftBig",
				"fadeInRight" => "fadeInRight",
				"fadeInRightBig" => "fadeInRightBig",
				"fadeInUp" => "fadeInUp",
				"fadeInUpBig" => "fadeInUpBig",

				"fadeOut" => "fadeOut",
				"fadeOutDown" => "fadeOutDown",
				"fadeOutDownBig" => "fadeOutDownBig",
				"fadeOutLeft" => "fadeOutLeft",
				"fadeOutLeftBig" => "fadeOutLeftBig",
				"fadeOutRight" => "fadeOutRight",
				"fadeOutRightBig" => "fadeOutRightBig",
				"fadeOutUp" => "fadeOutUp",
				"fadeOutUpBig" => "fadeOutUpBig",

				"flip" => "flip",
				"flipInX" => "flipInX",
				"flipInY" => "flipInY",
				"flipOutX" => "flipOutX",
				"flipOutY" => "flipOutY",

				"lightSpeedIn" => "lightSpeedIn",
				"lightSpeedOut" => "lightSpeedOut",

				"rotateIn" => "rotateIn",
				"rotateInDownLeft" => "rotateInDownLeft",
				"rotateInDownRight" => "rotateInDownRight",
				"rotateInUpLeft" => "rotateInUpLeft",
				"rotateInUpRight" => "rotateInUpRight",

				"rotateOut" => "rotateOut",
				"rotateOutDownLeft" => "rotateOutDownLeft",
				"rotateOutDownRight" => "rotateOutDownRight",
				"rotateOutUpLeft" => "rotateOutUpLeft",
				"rotateOutUpRight" => "rotateOutUpRight",

				"hinge" => "hinge",
				"rollIn" => "rollIn",
				"rollOut" => "rollOut",

				"zoomIn" => "zoomIn",
				"zoomInDown" => "zoomInDown",
				"zoomInLeft" => "zoomInLeft",
				"zoomInRight" => "zoomInRight",
				"zoomInUp" => "zoomInUp",

				"zoomOut" => "zoomOut",
				"zoomOutDown" => "zoomOutDown",
				"zoomOutLeft" => "zoomOutLeft",
				"zoomOutRight" => "zoomOutRight",
				"zoomOutUp" => "zoomOutUp",
			);

			$animationsIn = array(
				"bounce" => "bounce",
				"flash" => "flash",
				"pulse" => "pulse",
				"rubberBand" => "rubberBand",
				"shake" => "shake",
				"swing" => "swing",
				"tada" => "tada",
				"wobble" => "wobble",

				"bounceIn" => "bounceIn",
				"bounceInDown" => "bounceInDown",
				"bounceInLeft" => "bounceInLeft",
				"bounceInRight" => "bounceInRight",
				"bounceInUp" => "bounceInUp",

				"fadeIn" => "fadeIn",
				"fadeInDown" => "fadeInDown",
				"fadeInDownBig" => "fadeInDownBig",
				"fadeInLeft" => "fadeInLeft",
				"fadeInLeftBig" => "fadeInLeftBig",
				"fadeInRight" => "fadeInRight",
				"fadeInRightBig" => "fadeInRightBig",
				"fadeInUp" => "fadeInUp",
				"fadeInUpBig" => "fadeInUpBig",

				"flip" => "flip",
				"flipInX" => "flipInX",
				"flipInY" => "flipInY",

				"lightSpeedIn" => "lightSpeedIn",

				"rotateIn" => "rotateIn",
				"rotateInDownLeft" => "rotateInDownLeft",
				"rotateInDownRight" => "rotateInDownRight",
				"rotateInUpLeft" => "rotateInUpLeft",
				"rotateInUpRight" => "rotateInUpRight",

				"rollIn" => "rollIn",

				"zoomIn" => "zoomIn",
				"zoomInDown" => "zoomInDown",
				"zoomInLeft" => "zoomInLeft",
				"zoomInRight" => "zoomInRight",
				"zoomInUp" => "zoomInUp",
			);

			$animationsOut = array(
				"bounceOut" => "bounceOut",
				"bounceOutDown" => "bounceOutDown",
				"bounceOutLeft" => "bounceOutLeft",
				"bounceOutRight" => "bounceOutRight",
				"bounceOutUp" => "bounceOutUp",

				"fadeOut" => "fadeOut",
				"fadeOutDown" => "fadeOutDown",
				"fadeOutDownBig" => "fadeOutDownBig",
				"fadeOutLeft" => "fadeOutLeft",
				"fadeOutLeftBig" => "fadeOutLeftBig",
				"fadeOutRight" => "fadeOutRight",
				"fadeOutRightBig" => "fadeOutRightBig",
				"fadeOutUp" => "fadeOutUp",
				"fadeOutUpBig" => "fadeOutUpBig",

				"flipOutX" => "flipOutX",
				"flipOutY" => "flipOutY",

				"lightSpeedOut" => "lightSpeedOut",

				"rotateOut" => "rotateOut",
				"rotateOutDownLeft" => "rotateOutDownLeft",
				"rotateOutDownRight" => "rotateOutDownRight",
				"rotateOutUpLeft" => "rotateOutUpLeft",
				"rotateOutUpRight" => "rotateOutUpRight",

				"hinge" => "hinge",
				"rollOut" => "rollOut",

				"zoomOut" => "zoomOut",
				"zoomOutDown" => "zoomOutDown",
				"zoomOutLeft" => "zoomOutLeft",
				"zoomOutRight" => "zoomOutRight",
				"zoomOutUp" => "zoomOutUp",
			);

			$this->sections[] = array(
				'title' => 'Animations',
				'icon' => 'el-icon-magic',
				'fields' => array(
					array(
						'id'        => 'animation_section_heading',
						'type'      => 'select',
						'title'     => __('Section Heading Animation', 'KowloonBay'),
						'subtitle'     => __('Default: flipInX.', 'KowloonBay'),
						'options'	=> array_merge($noAnimation, $animationsIn),
						'default'   => 'flipInX',
					),
					array(
						'id'        => 'animation_section_desc',
						'type'      => 'select',
						'title'     => __('Section Description Animation', 'KowloonBay'),
						'subtitle'     => __('Default: fadeIn.', 'KowloonBay'),
						'options'	=> array_merge($noAnimation, $animationsIn),
						'default'   => 'fadeIn',
					),
					array(
						'id'        => 'animation_section_desc_apply_to_letter',
						'type'      => 'checkbox',
						'title'     => __('Apply Animation to Each Letter of Section Description', 'KowloonBay'),
						'default'   => '0',
					),
					array(
						'id'        => 'animation_item_array',
						'type'      => 'select',
						'title'     => __('Item Array Animation', 'KowloonBay'),
						'subtitle'     => __('Item array animation is used in areas such as portfolio categories, testimonial counters, blog post info, contact methods, columns, etc. Default: fadeInRight.', 'KowloonBay'),
						'options'	=> array_merge($noAnimation, $animationsIn),
						'default'   => 'fadeInRight',
					),
					array(
						'id'        => 'animation_portfolio_slider',
						'type'      => 'select',
						'title'     => __('Portfolio Slider Animation', 'KowloonBay'),
						'subtitle'     => __('Animation for each slide. Default: rotateOutUpRight.', 'KowloonBay'),
						'options'	=> array_merge($defaultAnimation, $animationsOut),
						'default'   => 'rotateOutUpRight',
					),
					array(
						'id'        => 'animation_team_member_photo_left',
						'type'      => 'select',
						'title'     => __('Team Member Photo (Left) Animation', 'KowloonBay'),
						'subtitle'     => __('Default: rotateInUpRight.', 'KowloonBay'),
						'options'	=> array_merge($noAnimation, $animationsIn),
						'default'   => 'rotateInUpRight',
					),
					array(
						'id'        => 'animation_team_member_photo_right',
						'type'      => 'select',
						'title'     => __('Team Member Photo (Right) Animation', 'KowloonBay'),
						'subtitle'     => __('Default: rotateInUpLeft.', 'KowloonBay'),
						'options'	=> array_merge($noAnimation, $animationsIn),
						'default'   => 'rotateInUpLeft',
					),
					array(
						'id'        => 'animation_blog_post_title',
						'type'      => 'select',
						'title'     => __('Blog Post Title Animation', 'KowloonBay'),
						'subtitle'     => __('Default: fadeInUp.', 'KowloonBay'),
						'options'	=> array_merge($noAnimation, $animationsIn),
						'default'   => 'fadeInUp',
					),
					array(
						'id'        => 'animation_parallax_initial',
						'type'      => 'text',
						'title'     => __('Parallax: Initial State', 'KowloonBay'),
						'subtitle'  => __('CSS syntax is used here. Default: background-position:50% 30%;.', 'KowloonBay'),
						'default'   => 'background-position:50% 30%;',
					),
					array(
						'id'        => 'animation_parallax_final',
						'type'      => 'text',
						'title'     => __('Parallax: Final State', 'KowloonBay'),
						'subtitle'  => __('CSS syntax is used here. Default: background-position:50% 70%;.', 'KowloonBay'),
						'default'   => 'background-position:50% 70%;',
					),
				)
			);

			$this->sections[] = array(
				'title' => 'Durations',
				'icon' => 'el-icon-hourglass',
				'fields' => array(
					array(
						'id'        => 'duration_carousel_single_item_autoplay_timeout',
						'type'      => 'text',
						'title'     => __('Single-Item Image Carousels: Autoplay Timeout', 'KowloonBay'),
						'subtitle'     => __('Single-item image carousels are used in portfolio. Must be a integer greater than 0. Unit: milliseconds. Default: 3000.', 'KowloonBay'),
						'default'   => '3000',
					),
					array(
						'id'        => 'duration_carousel_multiple_items_autoplay_timeout',
						'type'      => 'text',
						'title'     => __('Multiple-Items Carousels: Autoplay Timeout', 'KowloonBay'),
						'subtitle'     => __('Multiple-items carousels are used in the page of all team members. Must be a integer greater than 0. Unit: milliseconds. Default: 3000.', 'KowloonBay'),
						'default'   => '3000',
					),
					array(
						'id'        => 'duration_carousel_related_items_autoplay_timeout',
						'type'      => 'text',
						'title'     => __('Related-Items Carousels: Autoplay Timeout', 'KowloonBay'),
						'subtitle'     => __('Related-items carousels are used in portfolio and individual member page. Must be a integer greater than 0. Unit: milliseconds. Default: 3000.', 'KowloonBay'),
						'default'   => '3000',
					),
					array(
						'id'        => 'duration_carousel_blog_gallery_autoplay_timeout',
						'type'      => 'text',
						'title'     => __('Blog-Gallery Carousels: Autoplay Timeout', 'KowloonBay'),
						'subtitle'     => __('Blog-gallery carousels are used in gallery blog posts. Must be a integer greater than 0. Unit: milliseconds. Default: 3000.', 'KowloonBay'),
						'default'   => '3000',
					),
				)
			);

			$this->sections[] = array(
				'title' => 'Miscellaneous',
				'icon' => 'el-icon-adjust-alt',
				'fields' => array(
					array(
						'id'        => 'misc_services_listing_mode',
						'title'     => __('Listing Mode of Services', 'TsingYi'),
						'type'      => 'select',
						'options'  => array(
							'horizontal' => 'Horizontal',
							'vertical' => 'Vertical',
						),
						'default' => 'horizontal',
					),
					array(
						'id'        => 'misc_loading_fa_icon',
						'type'      => 'text',
						'title'     => __('Loading Icon for Infinite Scroll', 'KowloonBay'),
						'subtitle'     => __('Specifies a Font Awesome icon to be used as loading icon for infinite scroll in portfolio and blog. Default: fa-circle-o-notch.', 'KowloonBay'),
						'default'	=> 'fa-circle-o-notch'
					),
					array(
						'id'        => 'misc_faq_label_expand_all',
						'type'      => 'text',
						'title'     => __('Label for the Expand All Button in FAQ', 'KowloonBay'),
						'default'	=> 'Expand All'
					),
					array(
						'id'        => 'misc_faq_label_collapse_all',
						'type'      => 'text',
						'title'     => __('Label for the Collapse All Button in FAQ', 'KowloonBay'),
						'default'	=> 'Collapse All'
					),
					array(
						'id'        => 'misc_testimonials_profile_pic_img_style',
						'type'      => 'select',
						'title'     => __('Image Style of Profile Pictures in Testimonials', 'MongKok'),
						'subtitle'      => __('Select the image style of the profile pictures in testimonials.', 'MongKok'),
						'options'   => array(
							'img-rounded' => 'Rounded', 
							'img-circle' => 'Circle', 
							'img-thumbnail' => 'Thumbnail'
						),
						'default'   => 'img-circle'
					),
					array(
						'id'        => 'misc_404_content',
						'type'      => 'editor',
						'title'     => __('Content of 404 Page', 'KowloonBay'),
						'default'   => "<h2 class=\"text-center\">404 - Page Not Found</h2>\n<p class=\"text-center\">The page you requested could not be found on our server.</p>"
					),
					array(
						'id'        => 'misc_rs_custom_hide_whitespaces',
						'type'      => 'checkbox',
						'title'     => __('Hide Trailing Whitespaces in Titles of Slider Revolution of the KowloonBay Theme (Experimental)', 'KowloonBay'),
						'subtitle'     => __('If you find that the titles in Slider Revolution change positions after switching tabs, you can try checking this option to hide the trailing whitespaces and see if this can solve the problem.', 'KowloonBay'),
						'default'	=> '0'
					),
					array(
						'id'        => 'misc_rs_custom_less',
						'type'      => 'checkbox',
						'title'     => __('Disable Slider Revolution Styling of the KowloonBay Theme', 'KowloonBay'),
						'subtitle'     => __('You may want to disable the Slider Revolution styling of the theme if you want to use your own slider.', 'KowloonBay'),
						'default'	=> '0'
					),
					array(
						'id'        => 'misc_disable_query_vars',
						'type'      => 'checkbox',
						'title'     => __('Disable Query Variables in URL', 'KowloonBay'),
						'subtitle'     => __('You can disable query variables to prevent theme settings from being temporarily changed through URL.', 'KowloonBay'),
						'default'   => '1'// 1 = on | 0 = off
					),
				)
			);

			$theme_info  = '<div class="redux-framework-section-desc">';
			$theme_info .= '<p class="redux-framework-theme-data description theme-uri">' . __('<strong>Theme URL:</strong> ', 'KowloonBay') . '<a href="' . $this->theme->get('ThemeURI') . '" target="_blank">' . $this->theme->get('ThemeURI') . '</a></p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-author">' . __('<strong>Author:</strong> ', 'KowloonBay') . $this->theme->get('Author') . '</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-version">' . __('<strong>Version:</strong> ', 'KowloonBay') . $this->theme->get('Version') . '</p>';
			$theme_info .= '<p class="redux-framework-theme-data description theme-description">' . $this->theme->get('Description') . '</p>';
			$tabs = $this->theme->get('Tags');
			if (!empty($tabs)) {
				$theme_info .= '<p class="redux-framework-theme-data description theme-tags">' . __('<strong>Tags:</strong> ', 'KowloonBay') . implode(', ', $tabs) . '</p>';
			}
			$theme_info .= '</div>';

			if (file_exists(dirname(__FILE__) . '/kowloonbay-html-shortcodes-info.md')) {
				$this->sections['theme_docs'] = array(
					'icon'      => 'el-icon-indent-left',
					'title'     => __('HTML Shortcodes', 'KowloonBay'),
					'fields'    => array(
						array(
							'id'        => '17',
							'type'      => 'raw',
							'markdown'  => true,
							'content'   => file_get_contents(dirname(__FILE__) . '/kowloonbay-html-shortcodes-info.md')
						),
					),
				);
			}

			if (file_exists(trailingslashit(dirname(__FILE__)) . 'README.html')) {
				$tabs['docs'] = array(
					'icon'      => 'el-icon-book',
					'title'     => __('Documentation', 'KowloonBay'),
					'content'   => nl2br(file_get_contents(trailingslashit(dirname(__FILE__)) . 'README.html'))
				);
			}
		}

		public function setHelpTabs() {

			// // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
			// $this->args['help_tabs'][] = array(
			// 	'id'        => 'redux-help-tab-1',
			// 	'title'     => __('Theme Information 1', 'KowloonBay'),
			// 	'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'KowloonBay')
			// );

			// $this->args['help_tabs'][] = array(
			// 	'id'        => 'redux-help-tab-2',
			// 	'title'     => __('Theme Information 2', 'KowloonBay'),
			// 	'content'   => __('<p>This is the tab content, HTML is allowed.</p>', 'KowloonBay')
			// );

			// // Set the help sidebar
			// $this->args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', 'KowloonBay');
		}

		/**

		  All the possible arguments for Redux.
		  For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments

		 * */
		public function setArguments() {

			$theme = wp_get_theme(); // For use with some settings. Not necessary.

			$this->args = array(
				// TYPICAL -> Change these values as you need/desire
				'opt_name'          => 'kowloonbay_redux_opts',            // This is where your data is stored in the database and also becomes your global variable name.
				'display_name'      => $theme->get('Name'),     // Name that appears at the top of your panel
				'display_version'   => $theme->get('Version'),  // Version that appears at the top of your panel
				'menu_type'         => 'menu',                  //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
				'allow_sub_menu'    => true,                    // Show the sections below the admin menu item or not
				'menu_title'        => __('KowloonBay', 'KowloonBay'),
				'page_title'        => __('KowloonBay Theme Options', 'KowloonBay'),
				
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


			// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
			// $this->args['share_icons'][] = array(
			// 	'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
			// 	'title' => 'Visit us on GitHub',
			// 	'icon'  => 'el-icon-github'
			// 	//'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
			// );
			// $this->args['share_icons'][] = array(
			// 	'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
			// 	'title' => 'Like us on Facebook',
			// 	'icon'  => 'el-icon-facebook'
			// );
			// $this->args['share_icons'][] = array(
			// 	'url'   => 'http://twitter.com/reduxframework',
			// 	'title' => 'Follow us on Twitter',
			// 	'icon'  => 'el-icon-twitter'
			// );
			// $this->args['share_icons'][] = array(
			// 	'url'   => 'http://www.linkedin.com/company/redux-framework',
			// 	'title' => 'Find us on LinkedIn',
			// 	'icon'  => 'el-icon-linkedin'
			// );

			// Panel Intro text -> before the form
			if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
				if (!empty($this->args['global_variable'])) {
					$v = $this->args['global_variable'];
				} else {
					$v = str_replace('-', '_', $this->args['opt_name']);
				}
				$this->args['intro_text'] = sprintf(__('<p>KowloonBay Theme Settings</p>', 'KowloonBay'), $v);
			} else {
				$this->args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'KowloonBay');
			}

			// Add content after the form.
			// $this->args['footer_text'] = __('<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'KowloonBay');
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
