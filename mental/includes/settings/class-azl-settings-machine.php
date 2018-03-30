<?php
/**
 * Wordpress Azelab Settigns Machine class
 *
 * @author: Vedmant <vedmant@gmail.com>
 * @version: 1.0.0
 * @link http://azelab.com
 */

defined( 'ABSPATH' ) OR exit( 'restricted access' ); // Protect against direct call

if ( ! class_exists( 'Azl_settings_machine' ) ) {
	/**
	 * Class Azl_settings_machine
	 */
	class Azl_Settings_Machine
	{
		static $instance = null;

		private $title = 'Settings Machine';
		private $copyright = '';
		private $menu_name = 'Theme Settings';
		private $menu_slug = 'theme-settings';
		private $option_name = 'azl_settings';
		private $default_tab = 'home';

		private $metabox_post_types = array( 'page', 'post' );

		/**
		 * @var array(
		 *    'tab_slug' => array(
		 *       'title' => 'Tab title',
		 *       'descr' => 'Tab description',
		 *       'sections' => array(
		 *          array(
		 *             'title' => 'Section title',
		 *             'descr' => 'Section description',
		 *          ),
		 *       )
		 *    ),
		 * );
		 */
		private $tabs_config = array();

		/**
		 * @var array(
		 *
		 *   'intro_text' => array(
		 *      'tab' => 'tab_slug',
		 *      'section' => 'section_slug',
		 *      'label' => 'Introduction:',
		 *      'description' => 'Enter the introductory text for the home page',
		 *      'default' => 'Default Intro',
		 *      'show_on' => array('global','page','post','gallery')
		 *   ),
		 *
		 *   'test_image' => array(
		 *      'tab' => 'tab_slug',
		 *      'section' => 'section_slug',
		 *      'label' => 'Test image:',
		 *      'description' => '',
		 *      'type' => 'image',
		 *      'default' => '',
		 *   ),
		 *
		 * );
		 */
		private $options_config = array();

		// =========================================================================
		// Constructor & Instance
		// =========================================================================

		/**
		 * Hook into the appropriate actions when the class is constructed.
		 *
		 * @param $option_name
		 */
		public function __construct($option_name)
		{
			self::$instance = $this;
			$this->option_name = $option_name;

			if ( is_admin() ) {
				add_action( 'admin_init', array( $this, 'admin_init' ) );
				add_action( 'admin_menu', array( $this, 'settings_page_init' ) );

				// Add mime types
				add_filter('upload_mimes', array( $this, 'add_mime_types' ));

				add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );
				add_action( 'save_post', array( $this, 'save_meta_box' ) );


				add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue_scripts' ) );
			}
		}

		/**
		 * Returns the *Singleton* instance of this class.
		 * @return Azl_Settings_Machine The *Singleton* instance.
		 */
		public static function instance()
		{
			return self::$instance;
		}

		// =========================================================================
		// Base callbacks
		// =========================================================================

		public function admin_enqueue_scripts()
		{
			global $pagenow;
			// Add media modal code and Admin script
			if ( $pagenow == 'themes.php' && isset( $_GET['page'] ) && $_GET['page'] == $this->menu_slug ) {
				wp_enqueue_script( 'media-upload' );
				wp_enqueue_media();
			}

			// Minicolors
			wp_enqueue_script( 'jquery-minicolors', get_template_directory_uri() . '/includes/settings/assets/jquery-minicolors/jquery.minicolors.min.js', array( 'jquery' ) );
			wp_enqueue_style( 'jquery-minicolors', get_template_directory_uri() . '/includes/settings/assets/jquery-minicolors/jquery.minicolors.css' );

			// Add admin.js
			wp_register_script( 'azl_admin', get_template_directory_uri() . '/includes/settings/assets/settings.js', array( 'jquery' ) );
			wp_enqueue_script( 'azl_admin' ); // Enqueue it!

			// Add admin.css
			wp_register_style( 'azl_admin', get_template_directory_uri() . '/includes/settings/assets/settings.css' );
			wp_enqueue_style( 'azl_admin' ); // Enqueue it!

		}

		// =========================================================================
		// Configuration
		// =========================================================================

		/**
		 * Set settings page title
		 *
		 * @param $title
		 *
		 * @return $this current class
		 */
		public function set_title( $title )
		{
			$this->title = $title;

			return $this;
		}

		/**
		 * Set settings copyright text
		 *
		 * @param $copyright
		 *
		 * @return $this
		 */
		public function set_copyright( $copyright )
		{
			$this->copyright = $copyright;

			return $this;
		}

		/**
		 * Set menu item
		 *
		 * @param string $menu_name Menu Item name
		 * @param string $menu_slug Menu Item slug
		 *
		 * @return $this current class
		 */
		public function set_menu( $menu_name, $menu_slug )
		{
			$this->menu_name = $menu_name;

			return $this;
		}

		/**
		 * Set post type to show settings metabox
		 *
		 * @param array $metabox_post_types
		 *
		 * @return $this
		 */
		public function set_metabox_post_types( $metabox_post_types )
		{
			$this->metabox_post_types = $metabox_post_types;

			return $this;
		}

		/**
		 * Set Wordpress option name to store options
		 *
		 * @param string $option_name
		 *
		 * @return $this current class
		 */
		public function set_option_name( $option_name )
		{
			$this->option_name = $option_name;

			return $this;
		}

		/**
		 * Set default tab
		 *
		 * @param $tab
		 * @return $this
		 */
		public function set_default_tab( $tab )
		{
			$this->default_tab = $tab;

			return $this;
		}

		/**
		 * Add settings page tab
		 *
		 * @param string $tab_slug Slug
		 * @param string $tab_title Tab title
		 * @param array $sections Sections array('slug' => array('title' => 'Section Title', 'descr' => 'Section Description'))
		 * @param string $tab_description
		 *
		 * @return $this current class
		 */
		public function add_tab( $tab_slug, $tab_title, $sections, $tab_description = '' )
		{
			$this->tabs_config[ $tab_slug ] = array(
				'title' => $tab_title,
				'descr' => $tab_description,
				'sections' => $sections
			);

			return $this;
		}

		/**
		 * Add Option
		 *
		 * @param string $tab Tab slug
		 * @param string $section Tab section slug
		 * @param string $name Option name
		 * @param array $settings Option settings, example:
		 * <code>
		 * $settings = array(
		 *    'label' => 'Option label:',
		 *    'description' => 'Option Description',
		 *    'type' => 'select',
		 *    'type_callback' => 'callback function name',
		 *    'options' => array( // Select options
		 *       'menubar' => 'Menu bar on the left',
		 *       'topmenu' => 'Top menu',
		 *    ),
		 *    'default' => 'menubar' // Default value
		 * );
		 * </code>
		 *
		 * @return $this current class
		 */
		public function add_option( $name, $settings )
		{
			$this->options_config[ $name ] = $settings;

			return $this;
		}


		// =========================================================================
		// Options
		// =========================================================================

		/**
		 * Get option value by key
		 *
		 * @param string $key option key
		 * @param string $default default value (if no key found)
		 * @param string $subkey option subkey for list type of option (checkbox list, etc...)
		 *
		 * @return string
		 */
		public function get_option( $key, $default = null, $subkey = '' )
		{
			$settings = get_option( $this->option_name );

			if( null === $default) $default = $this->options_config[ $key ][ 'default' ];

			// Override by post meta data if it was set
			if ( null !== get_post() ) {
				$post_meta = get_post_meta( get_post()->ID, $this->option_name, true );
				if ( isset( $post_meta[ $key ] ) ) {
					$settings = $post_meta;
				}
			}

			// Get subkey if set
			if ( ! empty( $subkey ) ) {
				return isset( $settings[ $key ][ $subkey ] ) ? $settings[ $key ][ $subkey ] : $default;
			} else {
				return isset( $settings[ $key ] ) ? $settings[ $key ] : $default;
			}
		}

		/**
		 * Remove option from saved settings
		 *
		 * @param $key
		 */
		public function remove_option( $key )
		{
			$settings = get_option( $this->option_name );

			if ( isset( $settings[ $key ] ) ) unset( $settings[ $key ] );

			update_option( $this->option_name, $settings );
		}

		/**
		 * Filters options_config variable and gets items only for
		 * specified tab and section
		 *
		 * @param $tab
		 * @param $section
		 *
		 * @return array
		 */
		public function get_options_config_filered( $tab, $section = '' )
		{
			$return = array();

			foreach($this->options_config as $name => $settings) {

				if( ( $settings['tab'] == $tab && $section == '')
				    || ( $settings['tab'] == $tab && $settings['section'] == $section ) )
					$return[ $name ] = $settings;
			}

			return $return;
		}

		// =========================================================================
		// Wordpress Settings page callbacks
		// =========================================================================

		/**
		 * Get Settings option from WP or add defaults if it's empty
		 */
		public function admin_init()
		{
			//delete_option($this->option_name); // Uncomment it to reset options
			$settings = get_option( $this->option_name );

			if ( empty( $settings ) ) {

				// Set defaults for each tab and group
				$settings      = array();

				foreach ( $this->options_config as $opt_name => $opt_settings ) {
					$settings[ $opt_name ] = isset($opt_settings['default']) ? $opt_settings['default'] : '';
				}

				add_option( $this->option_name, $settings, '', 'yes' );
			}
		}

		/**
		 * Add mimes for Font files, to make them uploadable via WP uploader
		 *
		 * @param $mimes
		 * @return mixed
		 */
		public function add_mime_types($mimes)
		{
			// Fonts
			$mimes['svg']  = 'image/svg+xml';
			$mimes['woff'] = 'application/font-woff';
			$mimes['ttf']  = 'application/font-ttf';
			$mimes['eot']  = 'application/vnd.ms-fontobject';

			return $mimes;
		}

		/**
		 * Add Theme Settings admin menu item
		 */
		public function settings_page_init()
		{
			$settings_page = add_theme_page( $this->menu_name, $this->menu_name, 'edit_theme_options', $this->menu_slug, array(
				$this,
				'settings_page'
			) );
			add_action( "load-{$settings_page}", array( $this, 'load_settings_page' ) );
		}

		/**
		 * Hook for saving Settings
		 */
		public function load_settings_page()
		{
			if ( isset( $_POST[ $this->menu_slug . "-submit" ] ) && $_POST[ $this->menu_slug . "-submit" ] == 'Y' ) {
				check_admin_referer( $this->menu_slug . "-page" );
				$this->save_theme_settings();
				$url_parameters = isset( $_GET['tab'] ) ? 'updated=true&tab=' . $_GET['tab'] : 'updated=true';
				wp_redirect( admin_url( 'themes.php?page=' . $this->menu_slug . '&' . $url_parameters ) );
				exit;
			}
		}

		/**
		 * Render Tabs
		 *
		 * @param string $current
		 */
		function admin_tabs( $current = 'home' )
		{
			$tabs = $this->tabs_config;

			echo '<div id="icon-themes" class="icon32"><br></div>';
			echo '<h2 class="nav-tab-wrapper azl-settings-tabs_config">';
			foreach ( $tabs as $tab => $tab_options ) {
				$class = ( $tab == $current ) ? ' nav-tab-active' : '';
				echo "<a class='nav-tab$class' href='?page=" . $this->menu_slug . "&tab=$tab'>$tab_options[title]</a>";

			}
			echo '</h2>';
		}

		/**
		 * Render Settings Page
		 */
		function settings_page()
		{
			$settings = get_option( $this->option_name );
			?>

			<div class="wrap azl-settings">
				<h2><?php echo esc_html($this->title); ?></h2>

				<?php
				// Updated message
				if ( isset($_GET['updated']) && 'true' == esc_attr( $_GET['updated'] ) ) {
					echo '<div class="updated notice is-dismissible" ><p>' . __( 'Theme Settings updated.', 'mental' ) . '</p></div>';
				}

				// Get current tab
				if ( isset ( $_GET['tab'] ) ) {
					$tab = $_GET['tab'];
				} else {
					$tab = $this->default_tab;
				}

				// Render tabs
				$this->admin_tabs( $tab );
				?>

				<form method="post" action="<?php admin_url( 'themes.php?page=' . $this->menu_slug ); ?>">
					<?php
					wp_nonce_field( $this->menu_slug . "-page" );

					//$tab_options_groups = $this->get_settings_options( $tab );

					if( !isset( $this->tabs_config[ $tab ] )) return; // Wrong tab slug!

					foreach ( $this->tabs_config[ $tab ]['sections'] as $section_slug => $section_options ) {
						echo '<div class="azl-options-section">
                        <h3 class="title azl-options-section-title">' . $section_options['title'] . '</h3>';
						if ( ! empty( $section_options['descr'] ) ) {
							echo '<p class="description">' . $section_options['descr'] . '</p>';
						}
						echo '<table class="form-table">';

						$options = $this->get_options_config_filered( $tab, $section_slug );

						foreach ( $options as $opt_name => $opt_settings ) {
							?>
							<tr>
								<th><label for="<?php echo esc_attr($opt_name); ?>-id"><?php echo esc_html($opt_settings['label']); ?></label>
								</th>
								<td>
									<?php
									// Get settings value or default value
									if ( ! isset( $opt_settings['default'] ) ) $opt_settings['default'] = '';
									$item_value = isset( $settings[ $opt_name ] ) ? $settings[ $opt_name ] : $opt_settings['default'];

									// Call field render callback
									if( isset($opt_settings['type']) )
									if ( method_exists( $this, 'get_field_' . $opt_settings['type'] ) ) {
										echo ( $this->{'get_field_' . $opt_settings['type']}( $opt_name, $opt_settings, $item_value ) );
									} else {
										echo "Wrong Field Type!";
									}
									?>
								</td>
							</tr>
						<?php
						}
						echo '</table>
                        </div>';
					}
					?>
					<p class="submit azl-sticky-submit" style="clear: both;">
						<input type="submit" name="Submit" class="button-primary" value="Update Settings"/>
						<input type="hidden" name="<?php echo esc_attr($this->menu_slug); ?>-submit" value="Y"/>
					</p>
				</form>
				<p><?php echo wp_kses( $this->copyright, array( 'a' => array( 'href' => array(), 'target' => array() ) ) ); ?></p>
			</div>
		<?php
		}

		/**
		 * Save theme settigns function
		 */
		public function save_theme_settings()
		{
			global $pagenow;

			// Check for right page
			if ( ! $pagenow == 'themes.php' || ! $_GET['page'] == $this->menu_slug ) { return; }

			// If import data was sent, import it
			if( ! empty ( $_POST['import'] ) ) {
				$this->import_data($_POST['import']);
				return;
			}

			$settings = get_option( $this->option_name );

			if ( isset ( $_GET['tab'] ) ) {
				$tab = $_GET['tab'];
			} else {
				$tab = $this->default_tab;
			}

			$options_config = $this->get_options_config_filered( $tab );

			// Update only options from $options_config
			foreach ( $options_config as $opt_name => $opt_options ) {
				if(isset($_POST[ $opt_name ])) {
					$settings[ $opt_name ] = $_POST[ $opt_name ];
				}
			}

			update_option( $this->option_name, $settings );
		}

		// =========================================================================
		// Wordpress Meta box callbacks
		// =========================================================================

		/**
		 * Adds the meta box container.
		 *
		 * @param $post_type
		 */
		public function add_meta_box( $post_type )
		{
			if ( in_array( $post_type, $this->metabox_post_types ) ) {
				add_meta_box(
					$this->option_name . '_metabox',
					$this->title,
					array( $this, 'render_meta_box_content' ),
					$post_type,
					'normal',
					'high'
				);
			}
		}

		/**
		 * Render Meta Box content.
		 *
		 * @param WP_Post $post The post object.
		 */
		public function render_meta_box_content( $post )
		{
			// Add an nonce field so we can check for it later.
			wp_nonce_field( $this->option_name . '_box', $this->option_name . '_nonce' );

			// Use get_post_meta to retrieve an existing value from the database.
			$values = get_post_meta( $post->ID, $this->option_name, true );
			?>

			<div id="<?php echo esc_attr($this->option_name . '_meta_tabs'); ?>" class="azl-settings categorydiv">
				<ul class="azl_tabs category-tabs">
					<?php $i = 0; foreach ( $this->tabs_config as $tab_slug => $tab_options ):
						// Skip Tab if it has no options for current post type
						if ( ! $this->has_tab_items( $tab_slug ) ) { continue; } ?>

						<li class="<?php echo ( $i == 0 ) ? 'tabs' : '' ?>"><a href="#azl-tab-<?php echo esc_attr($tab_slug); ?>"><?php echo esc_html($tab_options['title']); ?></a></li>
					<?php $i ++; endforeach ?>
				</ul>

				<?php $i = 0;
				foreach ( $this->tabs_config as $tab_slug => $tab_options ):

					if ( ! $this->has_tab_items( $tab_slug ) ) { continue; }

					?>

					<div id="azl-tab-<?php echo esc_attr($tab_slug); ?>" class="tabs-panel azl-metabox-tab" <?php if ( $i != 0 ) { echo ' style="display:none;"'; } ?>>

						<?php foreach ( $tab_options['sections'] as $section_slug => $section_options ):
							// Skip options group if it has no items
							if ( ! $this->has_section_items( $tab_slug, $section_slug) ) { continue; }

							$options = $this->get_options_config_filered( $tab_slug, $section_slug );
							?>

							<h3 class="title"><?php echo esc_html($section_options['title']); ?></h3>
							<?php if ( ! empty( $section_options['descr'] ) ) {
								echo '<p class="description">' . $section_options['descr'] . '</p>';
							} ?>
							<table class="form-table">

								<?php foreach ( $options as $opt_name => $opt_settings ):
									if ( empty( $opt_settings['show_on'] ) || ! in_array( get_post_type(), $opt_settings['show_on'] ) ) {
										continue;
									}
									?>
									<tr>
										<th>
											<label for="<?php echo esc_attr($opt_name); ?>-id"><?php echo esc_html($opt_settings['label']); ?></label><br>
											<label class="azl_meta_override">
												<?php _e( 'Override', 'mental' ) ?> <input
													id="<?php echo esc_attr($this->option_name . '[' . $opt_name . '-use]'); ?>"
													class="azl-override-checkbox"
													name="<?php echo esc_attr($this->option_name . '[' . $opt_name . '-use]'); ?>"
													type="checkbox" <?php echo ! isset( $values[ $opt_name ] ) ? '' : ' checked' ?>
													value="true"/>
											</label>
										</th>
										<td>
											<?php
											// Get settings value or default value
											$item_value = isset( $values[ $opt_name ] ) ? $values[ $opt_name ] : $this->get_option( $opt_name,  $opt_settings['default'] );

											// Call field render callback
											if ( method_exists( $this, 'get_field_' . $opt_settings['type'] ) ) {
												echo ( $this->{'get_field_' . $opt_settings['type']}( $this->option_name . '[' . $opt_name . ']', $opt_settings, $item_value ) );
											} else {
												echo "Wrong Field Type!";
											}
											?>
										</td>
									</tr>
								<?php endforeach ?>

							</table>
						<?php endforeach ?>

					</div>

					<?php $i ++; endforeach ?>

			</div>

		<?php

		}

		/**
		 * Save the meta when the post is saved.
		 *
		 * @param int $post_id The ID of the post being saved.
		 *
		 * @return int $post_id
		 */
		public function save_meta_box( $post_id )
		{
			/*
			  * We need to verify this came from the our screen and with proper authorization,
			  * because save_post can be triggered at other times.
			  */

			// Check if our nonce is set.
			if ( ! isset( $_POST[ $this->option_name . '_nonce' ] ) ) {
				return $post_id;
			}

			$nonce = $_POST[ $this->option_name . '_nonce' ];

			// Verify that the nonce is valid.
			if ( ! wp_verify_nonce( $nonce, $this->option_name . '_box' ) ) {
				return $post_id;
			}

			// If this is an autosave, our form has not been submitted,
			//     so we don't want to do anything.
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return $post_id;
			}

			// Check the user's permissions.
			if ( 'page' == $_POST['post_type'] ) {
				if ( ! current_user_can( 'edit_page', $post_id ) ) {
					return $post_id;
				}
			} else {
				if ( ! current_user_can( 'edit_post', $post_id ) ) {
					return $post_id;
				}
			}

			/* OK, its safe for us to save the data now. */

			$mydata = $_POST[ $this->option_name ];

			foreach ( $mydata as $key => $value ) {
				if ( strpos( $key, '-use' ) !== false ) {
					continue;
				}
				if ( empty( $mydata[ $key . '-use' ] ) ) {
					unset( $mydata[ $key ] );
				} else {
					unset( $mydata[ $key . '-use' ] );
				}
			}

			if ( empty( $mydata ) ) {
				delete_post_meta( $post_id, $this->option_name );
			} // Delete if no overrides
			else {
				update_post_meta( $post_id, $this->option_name, $mydata );
			} // Update the meta field
		}

		// =========================================================================
		// Helpers
		// =========================================================================

		/**
		 * Checks whether tab has any options for current post type
		 *
		 * @param array $tab_slug
		 *
		 * @return bool
		 */
		private function has_tab_items( $tab_slug )
		{
			$post_type = get_post_type();
			foreach ( $this->options_config as $opt_name => $opt_settings ) {
				if ( $opt_settings['tab'] == $tab_slug
				     && ! empty( $opt_settings['show_on'] )
				     && in_array( $post_type, $opt_settings['show_on'] ) )
					return true;
			}

			return false;
		}

		/**
		 * Checks whether options group has any options for current post type
		 *
		 * @param $tab_slug
		 * @param $section_slug
		 *
		 * @return bool
		 */
		private function has_section_items( $tab_slug, $section_slug )
		{
			$options = $this->get_options_config_filered( $tab_slug, $section_slug );

			$post_type = get_post_type();
			foreach ( $options as $opt_name => $opt_settings ) {
				if ( ! empty( $opt_settings['show_on'] ) && in_array( $post_type, $opt_settings['show_on'] ) )
					return true;
			}

			return false;
		}

		/**
		 * Checks whether array is associated array
		 *
		 * @param $array
		 *
		 * @return bool
		 */
		function is_assoc( $array )
		{
			return array_keys( $array ) !== range( 0, count( $array ) - 1 );
		}

		/**
		 * Get export data (serialized, gzcompressed, base64 encoded)
		 *
		 * @return string
		 */
		function get_export_data()
		{
			$settings = get_option( $this->option_name );

			return base64_encode( gzcompress( serialize( $settings ) ) );
		}

		/**
		 * Import data (serialized, gzcompressed, base64 encoded)
		 *
		 * @param $import
		 * @return bool
		 */
		function import_data($import)
		{
			$base_64_decodede = base64_decode( $import );
			if ( ! $base_64_decodede ) {
				return false;
			}

			$uncompressed = gzuncompress( $base_64_decodede );
			if ( ! $uncompressed ) {
				return false;
			}

			return update_option( $this->option_name, unserialize( $uncompressed ) );
		}

		/**
		 * Get fonts list from font_loader control
		 */
		function get_fonts_list()
		{
			if ( isset( $this->fonts_list ) ) {
				return $this->fonts_list;
			}

			$font_loader = $this->get_option( 'font_loader' );
			$fonts_list  = array();

			$fonts_list['default'] = array( 'Default' );

			// System fonts
			$fonts_list['system'] = array('Georgia', 'Palatino Linotype', 'Times New Roman', 'Arial', 'Arial Black', 'Comic Sans MS', 'Impact', 'Lucida Sans Unicode', 'Tahoma', 'Trebuchet MS', 'Verdana', 'Courier New', 'Lucida Console');

			foreach ( (array) $font_loader as $font ) {
				$font_name        = sanitize_text_field( @$font['name'] );
				$font_name_google = sanitize_text_field( @$font['name_google'] );

				$fonts = explode( ',', $font_name );
				foreach ( $fonts as $fnt ) {
					$fnt = sanitize_text_field( $fnt );
					if ( ! empty( $fnt ) ) $fonts_list[$font['type']][] = $fnt;
				}
				if ( empty( $font_name ) && ! empty( $font_name_google ) ) $fonts_list[$font['type']][] = $font_name_google;
			}
			foreach ( $fonts_list as &$font_type ) {
				$font_type = array_unique( $font_type );
			}

			$this->fonts_list = $fonts_list;

			return $fonts_list;
		}

		/**
		 * Get saved skins
		 *
		 * @return array
		 */
		function get_skins()
		{
			if ( isset( $this->skins ) ) {
				return $this->skins;
			}

			$skins = $this->get_option( 'skins' );

			foreach ( $skins as $key => $skin ) {
				$skins[ $key ]['slug'] = sanitize_title($skin['title']);
			}

			$this->skins = $skins;

			return $skins;
		}

		/**
		 * Get skin by skin slug
		 *
		 * @param $skin_slug
		 *
		 * @return array | bool
		 */
		function get_skin($skin_slug)
		{
			$skins = $this->get_skins();

			foreach ( $skins as $key => $skin ) {
				if( $skin['slug'] == $skin_slug ) {
					unset($skin['title'], $skin['slug']);
					return $skin;
				}
			}

			return false;
		}

		// =========================================================================
		// Fields callback functions
		// =========================================================================

		private function get_field_text( $name, $settings, $value = '' )
		{
			return '
            <input class="azl-text-field" id="' . $name . '" name="' . $name . '" type="text" value="' . $value . '" /><br>
            <span class="description">' . $settings['description'] . '</span>
         ';
		}

		private function get_field_textarea( $name, $settings, $value = '' )
		{
			return '
            <textarea id="' . $name . '" name="' . $name . '" cols="60" rows="5">' . stripslashes( $value ) . '</textarea><br>
            <span class="description">' . $settings['description'] . '</span>
         ';
		}

		private function get_field_checkbox( $name, $settings, $value = '' )
		{
			return '
            <input id="' . $name . '-false" name="' . $name . '" type="hidden" value="0">
            <input id="' . $name . '" name="' . $name . '" type="checkbox" ' . ( $value ? 'checked="checked"' : '' ) . ' value="1">
            <label for="' . $name . '">' . $settings['description'] . '</label>
         ';
		}

		private function get_field_select( $name, $settings, $value = '' )
		{
			$return = '
            <select id="' . $name . '" name="' . $name . '">';
			foreach ( $settings['options'] as $sel_val => $sel_name ) {
				$return .= '<option value="' . $sel_val . '"' . ( ( $sel_val == $value ) ? ' selected' : '' ) . '>' . $sel_name . '</option>';
			}
			$return .= '
            </select>
            <span class="description">' . $settings['description'] . '</span>
         ';

			return $return;
		}

		private function get_field_image( $name, $settings, $value = '' )
		{
			$image = wp_get_attachment_image( $value, 'thumbnail' );
			$image = str_replace( array( 'width="1"', 'height="1"' ), '', $image );

			$return = '
            <div class="image">
               <button type="button" class="button azl_upload_image_button" data-uploader_title="Choose Image for ' . rtrim( $settings['label'], ':' ) . '" data-uploader_button_text="Use Image">' . __( 'Choose Image', 'mental' ) . '</button>
               <div class="azl_field_image_preview">' . $image . '</div>
               <button type="button" class="button azl_remove_image_button ' . ( $image ? '' : 'hidden' ) . '">' . __( 'Remove Image', 'mental' ) . '</button>
               <input class="azl_field_image_id hide" id="' . $name . '" name="' . $name . '" type="text" value="' . $value . '" />
               <span class="description display-block">' . $settings['description'] . '</span>
            </div>
         ';

			return $return;
		}

		private function get_field_video( $name, $settings, $value = '' )
		{
			$urls = "";
			if(!empty($value)) {
				$url_value = explode(",", $value);
				foreach($url_value as $attachment_id){
					$urls[] = wp_get_attachment_url($attachment_id);
				}
				$urls = implode(',', $urls);
			}

			$return = '
            <div class="video">
               <input class="azl_field_video_url" id="' . $name . '" name="' . $name . '" type="text" value="' . $urls . '" /></br></br>
               <button type="button" class="button azl_upload_video_button" data-uploader_title="Choose Video for ' . rtrim( $settings['label'], ':' ) . '" data-uploader_button_text="Use Video">' . __( 'Choose Video', 'mental' ) . '</button>
               <button type="button" class="button azl_remove_video_button ' . ( $urls ? '' : 'hidden' ) . '">' . __( 'Remove Video', 'mental' ) . '</button>
               <input class="azl_field_video_id hide" id="' . $name . '" name="' . $name . '" type="text" value="' . $value . '" />
               <span class="description display-block">' . $settings['description'] . '</span>
            </div>
         ';

			return $return;
		}

		private function get_field_checkbox_list( $name, $settings, $value = array() )
		{
			$output = '';
			foreach ( $settings['checkboxes'] as $ch_name => $ch_title ) {
				$output .= '
               <p>
                  <input id="' . $name . '[' . $ch_name . '-false" name="' . $name . '[' . $ch_name . ']" type="hidden" value="0">
                  <input id="' . $name . '[' . $ch_name . ']" name="' . $name . '[' . $ch_name . ']" type="checkbox" ' . ( @$value[ $ch_name ] ? 'checked="checked"' : '' ) . ' value="1"  />
                  <label for="' . $name . '[' . $ch_name . ']">' . $ch_title . '</label>
               </p>
            ';
			}
			$output .= '<span class="description">' . $settings['description'] . '</span>';

			return $output;
		}

		private function get_field_social_links( $name, $settings, $value = array() )
		{
			$output = '';

			$output .= '<div class="azl_social_links">';

			$i = 0;
			foreach ( $value as $val_opts ) {
				$output .= '
               <div class="azl_social_item">
                  <div class="azl_si_wrapper">
	                  <i class="azl_social_item_drag"></i>
	                  <span class="azl_si_icon_part">' . __( 'Icon class:', 'mental' ) . ' <input type="text" name="' . $name . '[' . $i . '][class]" class="azl_si_input_class" value="' . $val_opts['class'] . '"></span>
	                  <span class="azl_si_link_part">' . __( 'Link:', 'mental' ) . ' <input type="text" name="' . $name . '[' . $i . '][link]" class="azl_si_input_link" value="' . $val_opts['link'] . '"></span>
	                  <button type="button" class="button azl_social_item_remove">' . __( 'Remove', 'mental' ) . '</button>
                  </div>
               </div>
            ';

				$i ++;
			}

			$output .= '</div>';

			// Item template
			$output .= '
            <div class="azl_social_item_template">
	            <div class="azl_si_wrapper">
	               <i class="azl_social_item_drag"></i>
	               <span class="azl_si_icon_part">' . __( 'Icon class:', 'mental' ) . ' <input type="text" name="' . $name . '[0][class]" class="azl_si_input_class" value="" disabled></span>
	               <span class="azl_si_link_part">' . __( 'Link:', 'mental' ) . ' <input type="text" name="' . $name . '[0][link]" class="azl_si_input_link" value="" disabled></span>
	               <button type="button" class="button azl_social_item_remove">' . __( 'Remove', 'mental' ) . '</button>
               </div>
            </div>';

			$output .= '<button type="button" class="button azl_add_social_item ">' . __( 'Add Item', 'mental' ) . '</button><br>';
			$output .= '<span class="description">' . $settings['description'] . '</span>';


			return $output;
		}

		private function get_field_color( $name, $settings, $value = '' )
		{
			return '
            <input class="azl-colorpicker"id="' . $name . '" name="' . $name . '" type="text" value="' . $value . '" '.( empty( $settings['opacity'] ) ? '' : 'data-has-opacity' ).'><br>
            <span class="description">' . $settings['description'] . '</span>
         ';
		}

		private function get_field_font( $name, $settings, $value = '' )
		{
			$fonts = $this->get_fonts_list();
			$sizes = array( '8px', '10px', '12px', '13px', '14px', '15px', '16px', '17px', '18px', '20px', '22px', '24px', '26px', '28px', '30px', '32px', '36px', '40px');
			$styles = array( 'normal' => 'Normal', 'italic' => 'Italic' );
			$weights = array( '400' => 'Normal', '100' => 'Thin', '200' => 'Extra-Light', '300' => 'Light', '600' => 'Semi-bold', '700' => 'Bold', '800' => 'Ultra-bold');

			if(!empty($settings['options']['size'])) $sizes = $settings['options']['size'];

			$return = '<select id="' . $name . '[font]" name="' . $name . '[font]">';
			foreach ( $fonts as $group => $opts ) {
				$return .= '<optgroup label="'.ucfirst($group).'">';
				foreach ($opts as $opt) {
					$return .= '<option value="' . $opt . '"' . ( ( $opt == $value['font'] ) ? ' selected' : '' ) . '>' . $opt . '</option>';
				}
				$return .= '</optgroup>';
			}
			$return .= '</select>';

			$return .= ' ' . __( 'Size:', 'mental' ) . ' <select id="' . $name . '[size]" name="' . $name . '[size]">';
			foreach ( $sizes as $sel_name ) {
				$return .= '<option value="' . $sel_name . '"' . ( ( $sel_name == $value['size'] ) ? ' selected' : '' ) . '>' . $sel_name . '</option>';
			}
			$return .= '</select>';

			$return .= ' ' . __( 'Style:', 'mental' ) . ' <select id="' . $name . '[style]" name="' . $name . '[style]">';
			foreach ( $styles as $sel_val => $sel_name ) {
				$return .= '<option value="' . $sel_val . '"' . ( ( $sel_val == $value['style'] ) ? ' selected' : '' ) . '>' . $sel_name . '</option>';
			}
			$return .= '</select>';

			$return .= ' ' . __( 'Weight:', 'mental' ) . ' <select id="' . $name . '[weight]" name="' . $name . '[weight]">';
			foreach ( $weights as $sel_val => $sel_name ) {
				$return .= '<option value="' . $sel_val . '"' . ( ( $sel_val == $value['weight'] ) ? ' selected' : '' ) . '>' . $sel_name . '</option>';
			}
			$return .= '</select>';

			$return .= '<span class="description">' . $settings['description'] . '</span>';

			return $return;
		}

		private function get_field_import( $name, $settings, $value = '' )
		{
			return '
            <textarea id="' . $name . '" name="' . $name . '" cols="60" rows="10">' . $this->get_export_data() . '</textarea><br>
            <span class="description">' . $settings['description'] . '</span>
         ';
		}

		private function get_field_font_loader( $name, $settings, $value = '' )
		{
			ob_start();
			?>

			<div class="azl-font-loader">

				<input type="hidden" name="<?php echo $name; ?>" value="">

				<div class="azl-fl-font-template" style="display: none;">
					<?php $this->field_font_loader_item(0, $name, '', true); ?>
				</div>

				<div class="azl-fl-fonts-container">
					<?php
					if( ! empty($value) )
						foreach((array)$value as $i => $val_item) $this->field_font_loader_item($i, $name, $val_item, false);
					?>
				</div>

				<div class="azl-fl-btn-panel">
					<button type="button" class="button azl-fl-addfont"><?php _e('Add Font', 'mental') ?></button>
				</div>

			</div>

			<?php
			return ob_get_clean();
		}

		function field_font_loader_item($idx, $name, $value = '', $template = false)
		{
			if(empty($value)) $value = array(
				'name'=>'', 'name_google'=>'', 'type'=>'', 'style'=>'', 'weight'=>'',
				'upload_eot'=>'', 'upload_woff'=>'', 'upload_ttf'=>'', 'upload_svg'=>'',
			);
			?>

			<div class="azl-fl-item">

				<div class="azl-fl-item-toggler">
					<div class="handlediv" title="Click to toggle"></div>
					<h3><?php _e('Font', 'mental') ?></h3>
				</div>

				<table class="form-table azl-fl-item-body">

					<tr class="azl-fl-type">
						<td><?php _e('Font source:', 'mental') ?></td>
						<td>
							<select name="<?php echo esc_attr($name) ?>[<?php echo (int) $idx; ?>][type]" class="azl-fl-type-selector" <?php if($template) echo 'disabled'; ?>>
								<option value="google" <?php if($value['type'] == 'google') echo 'selected' ?>><?php _e('Google Font', 'mental') ?></option>
								<option value="typekit" <?php if($value['type'] == 'typekit') echo 'selected' ?>><?php _e('Typekit', 'mental') ?></option>
								<option value="custom" <?php if($value['type'] == 'custom') echo 'selected' ?>><?php _e('Custom Font', 'mental') ?></option>
							</select>
							<span class="description"><?php _e('Choose in what way you\'re going to get font', 'mental') ?></span>
						</td>
					</tr>

					<tr class="azl-fl-var azl-fl-name-google" style="display: none;">
						<td><?php _e('Font name:', 'mental') ?></td>
						<td>
							<input type="text" class="azl-fl-input-name-google" name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][name_google]" value="<?php echo @$value['name_google'] ?>" <?php if($template) echo 'disabled'; ?>>
							<span class="description"><?php _e('You can choose any font name from <a href="http://www.google.com/fonts" target="_blank">Google Fonts</a>', 'mental') ?></span>
						</td>
					</tr>

					<tr class="azl-fl-var azl-fl-name" style="display: none;">
						<td><?php _e('Font name:', 'mental') ?></td>
						<td>
							<input type="text" class="azl-fl-input-name" name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][name]" value="<?php echo @$value['name'] ?>" <?php if($template) echo 'disabled'; ?>>
						</td>
					</tr>

					<tr class="azl-fl-var azl-fl-typekit-id" style="display: none;">
						<td><?php _e('Typekit ID:', 'mental') ?></td>
						<td>
							<input type="text" class="azl-fl-input-typekit-id" name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][typekit_id]" value="<?php echo @$value['typekit_id'] ?>" <?php if($template) echo 'disabled'; ?>>
							<span class="description"><?php _e('Type your TypeKit ID, you can get it after signing in to <a href="https://typekit.com/" target="_blank">TypeKit</a>. And please type in Font name field all fonts names from Kit.', 'mental') ?></span>
						</td>
					</tr>

					<tr class="azl-fl-var azl-fl-style" style="display: none;">
						<td><?php _e('Font style:', 'mental') ?></td>
						<td>
							<label>
								<?php _e('Font style:', 'mental') ?>
								<select class="azl-fl-input-style" name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][style]" <?php if($template) echo 'disabled'; ?>>
									<option value="normal" <?php if($value['style'] == 'normal') echo 'selected' ?>><?php _e('Normal', 'mental') ?></option>
									<option value="italic" <?php if($value['style'] == 'italic') echo 'selected' ?>><?php _e('Italic', 'mental') ?></option>
								</select><br>
								<?php _e('Font weight:', 'mental') ?>
								<select class="azl-fl-input-weight" name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][weight]" <?php if($template) echo 'disabled'; ?>>
									<option value="400" <?php if($value['weight'] == '400') echo 'selected' ?>><?php _e('Normal', 'mental') ?></option>
									<option value="100" <?php if($value['weight'] == '100') echo 'selected' ?>><?php _e('Thin', 'mental') ?></option>
									<option value="200" <?php if($value['weight'] == '200') echo 'selected' ?>><?php _e('Extra-Light', 'mental') ?></option>
									<option value="300" <?php if($value['weight'] == '300') echo 'selected' ?>><?php _e('Light', 'mental') ?></option>
									<option value="600" <?php if($value['weight'] == '600') echo 'selected' ?>><?php _e('Semi-bold', 'mental') ?></option>
									<option value="700" <?php if($value['weight'] == '700') echo 'selected' ?>><?php _e('Bold', 'mental') ?></option>
									<option value="800" <?php if($value['weight'] == '800') echo 'selected' ?>><?php _e('Ultra-bold', 'mental') ?></option>
								</select><br>
                                                                
                                                                <div class="azl-subset-google" style="display: none">
                                                                    <?php _e('Font style:', 'mental') ?><br>
                                                                    <label>
                                                                        <input type="checkbox" value="1" <?php echo ($value['subset']['greek'] == 1)? 'checked=""' : '' ?> name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][subset][greek]" /> Greek
                                                                    </label><br>
                                                                    <label>
                                                                        <input type="checkbox" value="1" <?php echo ($value['subset']['greek-ext'] == 1)? 'checked=""' : '' ?> name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][subset][greek-ext]" /> Greek Extended
                                                                    </label><br>
                                                                    <label>
                                                                        <input type="checkbox" value="1" <?php echo ($value['subset']['latin'] == 1)? 'checked=""' : '' ?> name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][subset][latin]" /> Latin
                                                                    </label><br>
                                                                    <label>
                                                                        <input type="checkbox" value="1" <?php echo ($value['subset']['vietnamese'] == 1)? 'checked=""' : '' ?> name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][subset][vietnamese]" /> Vietnamese
                                                                    </label><br>
                                                                    <label>
                                                                        <input type="checkbox" value="1" <?php echo ($value['subset']['cyrillic-ext'] == 1)? 'checked=""' : '' ?> name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][subset][cyrillic-ext]" /> Cyrillic Extended
                                                                    </label><br>
                                                                    <label>
                                                                        <input type="checkbox" value="1" <?php echo ($value['subset']['latin-ext'] == 1)? 'checked=""' : '' ?> name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][subset][latin-ext]" /> Latin Extended
                                                                    </label><br>
                                                                    <label>
                                                                        <input type="checkbox" value="1" <?php echo ($value['subset']['cyrillic'] == 1)? 'checked=""' : '' ?> name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][subset][cyrillic]" /> Cyrillic
                                                                    </label>
                                                                </div>
                                                                
							</label>
						</td>
					</tr>

					<tr class="azl-fl-var azl-fl-upload" style="display: none;">
						<td><?php _e('Upload URL:', 'mental') ?></td>
						<td>
							<label>
								<?php _e('Upload URL (embedded-opentype - eot):', 'mental') ?><br>
								<input type="text" name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][upload_eot]" value="<?php echo esc_attr(@$value['upload_eot']); ?>" <?php if($template) echo 'disabled'; ?>>
								<button type="button" class="button azl-fl-upload-font" data-title="Upload font (embedded-opentype - eot)" data-mime="vnd.ms-fontobject"><?php _e('Upload', 'mental') ?></button>
							</label>
							<br>
							<label>
								<?php _e('Upload URL (woff):', 'mental') ?><br>
								<input type="text" name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][upload_woff]" value="<?php echo esc_attr(@$value['upload_woff']); ?>" <?php if($template) echo 'disabled'; ?>>
								<button type="button" class="button azl-fl-upload-font" data-title="Upload font (woff)" data-title="font-woff"><?php _e('Upload', 'mental') ?></button>
							</label>
							<br>
							<label>
								<?php _e('Upload URL (truetype - ttf):', 'mental') ?><br>
								<input type="text" name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][upload_ttf]" value="<?php echo esc_attr(@$value['upload_ttf']); ?>" <?php if($template) echo 'disabled'; ?>>
								<button type="button" class="button azl-fl-upload-font" data-title="Upload font (truetype - ttf)" data-title="x-font-truetype"><?php _e('Upload', 'mental') ?></button>
							</label>
							<br>
							<label>
								<?php _e('Upload URL (svg):', 'mental') ?><br>
								<input type="text" name="<?php echo esc_attr($name); ?>[<?php echo (int) $idx; ?>][upload_svg]" value="<?php echo esc_attr(@$value['upload_svg']); ?>" <?php if($template) echo 'disabled'; ?>>
								<button type="button" class="button azl-fl-upload-font" data-title="Upload font (svg)" data-mime="svg+xml"><?php _e('Upload', 'mental') ?></button>
							</label>
						</td>
					</tr>

					<tr class="azl-fl-remove">
						<td></td><td><button type="button" class="button azl-fl-removefont"><?php _e('Remove Font', 'mental') ?></button></td>
					</tr>

				</table>

			</div>

			<?php
		}

		private function get_field_skins( $name, $settings, $value = '' )
		{
			ob_start();
			?>

			<div class="azl-skins">

				<input type="hidden" name="<?php echo $name; ?>" value="">

				<div class="azl-sk-item-template" style="display: none;">
					<?php $this->field_skins_item(0, $name, '', $settings, true); ?>
				</div>

				<div class="azl-sk-items-container">
					<?php
					if( ! empty($value) )
						foreach((array)$value as $i => $val_item) $this->field_skins_item($i, $name, $val_item, $settings, false);
					?>
				</div>

				<div class="azl-sk-btn-panel">
					<button type="button" class="button azl-sk-addskin"><?php _e('Add Skin', 'mental') ?></button>
				</div>

			</div>

			<?php
			return ob_get_clean();
		}

		function field_skins_item( $idx, $name, $value, $settings, $template = false )
		{
			// Default values
			if ( empty( $value ) ) {
				foreach ( $settings['fields'] as $fl_name => $fl_label )$value[ $fl_name ] = '';
				$value['title'] = '';
			}
			?>

			<div class="azl-sk-item">

				<div class="azl-sk-item-toggler">
					<div class="handlediv" title="<?php _e('Click to toggle', 'mental'); ?>"></div>
					<h3>
						<span><?php _e('Skin', 'mental') ?></span>
						<div class="azl-sk-colors-preview"></div>
					</h3>
				</div>

				<table class="form-table azl-sk-item-body">

					<tr class="azl-sk-field">
						<td><?php _e('Title', 'azl'); ?></td>
						<td>
							<input class="azl-skin-title"
							       name="<?php echo esc_attr( $name.'['.$idx.']'.'[title]' ); ?>" type="text"
							       value="<?php echo esc_attr( $value['title'] ); ?>" <?php if($template) echo 'disabled'; ?>>
						</td>
					</tr>

					<?php foreach($settings['fields'] as $fl_name => $fl_label): ?>

						<?php $opacity = isset($settings['options'][ $fl_name ]) && !empty($settings['options'][ $fl_name ]['opacity']); ?>

						<tr class="azl-sk-field">
							<td><?php echo esc_html($fl_label); ?></td>
							<td>
								<input class="azl-colorpicker<?php if($template) echo '-template'; ?>"
								       name="<?php echo esc_attr( $name.'['.$idx.']'.'['.$fl_name.']' ); ?>" type="text"
								       value="<?php echo esc_attr( $value[ $fl_name ] ); ?>" <?php if($template) echo 'disabled'; ?>
										 <?php if( $opacity ) echo 'data-has-opacity'; ?>>
							</td>
						</tr>

					<?php endforeach; ?>

					<tr class="azl-sk-remove">
						<td></td><td><button type="button" class="button azl-sk-removeskin"><?php _e('Remove Skin', 'mental') ?></button></td>
					</tr>

				</table>

			</div>

		<?php
		}

		private function get_field_skin_select( $name, $settings, $value = '' )
		{
			$options = $this->get_skins();

			// Default value
			array_unshift($options, array('title' => 'Default', 'slug' => 'default'));

			$return = '
            <select id="' . $name . '" name="' . $name . '">';
			foreach ( $options as $option ) {
				$return .= '<option value="' . $option['slug'] . '"' . ( ( $option['slug'] === $value ) ? ' selected' : '' ) . '>' . $option['title'] . '</option>';
			}
			$return .= '
            </select>
            <span class="description">' . $settings['description'] . '</span>
         ';

			return $return;
		}

	} // End Class
}