<?php
/**
 * Main Customizer functions
 *
 * @package Total WordPress Theme
 * @subpackage Customizer
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define class global var for child theme edits
global $wpex_customizer;

/**
 * Total Customizer class
 *
 * @since 3.0.0
 */
if ( ! class_exists( 'WPEX_Customizer' ) ) {
	class WPEX_Customizer {
		private $customizer_dir_uri = null;
		private $customizer_dir     = null;
		private $admin_enabled      = true;
		private $panels             = array();
		private $enabled_panels     = array();
		public $sections            = array();
		private $settings           = array();
		private $enable_postMessage = true;

		/**
		 * Start things up
		 *
		 * @since 3.0.0
		 */
		public function __construct() {

			// Check if the customizer admin panel is enabled
			$this->admin_enabled = wpex_get_mod( 'customizer_panel_enable', true );

			// Add admin panel if enabled
			if ( is_admin() && $this->admin_enabled ) {
				add_action( 'admin_menu', array( $this, 'add_admin_page' ), 40 );
				add_action( 'admin_init', array( $this,'admin_options' ) );
				add_action( 'admin_print_styles-'. WPEX_ADMIN_PANEL_HOOK_PREFIX . '-customizer', array( $this,'admin_styles' ), 40 );
			}

			// Create an array of registered theme customizer panels
			$this->panels = apply_filters( 'wpex_customizer_panels', array(
				'general' => array(
					'title' => esc_html__( 'General Theme Options', 'total' ),
				),
				'layout' => array(
					'title' => esc_html__( 'Layout', 'total' ),
				),
				'typography' => array(
					'title' => esc_html__( 'Typography', 'total' ),
				),
				'togglebar' => array(
					'title' => esc_html__( 'Toggle Bar', 'total' ),
					'is_section' => true,
				),
				'topbar' => array(
					'title' => esc_html__( 'Top Bar', 'total' ),
				),
				'header' => array(
					'title' => esc_html__( 'Header', 'total' ),
				),
				'sidebar' => array(
					'title' => esc_html__( 'Sidebar', 'total' ),
					'is_section' => true,
				),
				'blog' => array(
					'title' => esc_html__( 'Blog', 'total' ),
				),
				'portfolio' => array(
					'title' => wpex_get_portfolio_name(),
					'condition' => WPEX_PORTFOLIO_IS_ACTIVE,
				),
				'staff' => array(
					'title' => wpex_get_staff_name(),
					'condition' => WPEX_STAFF_IS_ACTIVE,
				),
				'testimonials' => array(
					'title' => wpex_get_testimonials_name(),
					'condition' => WPEX_TESTIMONIALS_IS_ACTIVE,
					'is_section' => true,
				),
				'woocommerce' => array(
					'title' => esc_html__( 'WooCommerce', 'total' ),
					'condition' => WPEX_WOOCOMMERCE_ACTIVE,
				),
				'callout' => array(
					'title' => esc_html__( 'Callout', 'total' ),
					'is_section' => true,
				),
				'footer_widgets' => array(
					'title' => esc_html__( 'Footer Widgets', 'total' ),
					'is_section' => true,
				),
				'footer_bottom' => array(
					'title' => esc_html__( 'Footer Bottom', 'total' ),
					'is_section' => true,
				),
				'visual_composer' => array(
					'title' => esc_html__( 'Visual Composer', 'total' ),
					'is_section' => true,
					'condition' => WPEX_VC_ACTIVE,
				),
			) );

			// Get enabled panels
			$this->enabled_panels = get_option( 'wpex_customizer_panels', $this->panels );

			// Everything else is only needed on front end of if in the customizer
			if ( ! is_admin() || is_customize_preview() ) {

				// Define location vars
				$this->customizer_dir_uri = WPEX_FRAMEWORK_DIR_URI .'customizer/';
				$this->customizer_dir     = WPEX_FRAMEWORK_DIR .'customizer/';

				// Add sections (stores all sections in array if not already saved in DB)
				if ( ! $this->sections ) {
					$this->add_sections();
				}

				// Add custom controls and callbacks
				add_action( 'customize_register', array( $this, 'controls_callbacks' ) );

				// Remove core panels and sections
				add_action( 'customize_register', array( $this, 'remove_core_sections' ), 11 );

				// Add theme customizer sections and panels
				add_action( 'customize_register', array( $this, 'add_customizer_panels_sections' ), 40 );

				// Adds CSS for customizer custom controls
				add_action( 'customize_controls_print_styles', array( $this, 'customize_controls_print_styles' ) );

				// Load JS file for customizer
				add_action( 'customize_preview_init', array( $this, 'customize_preview_init' ) );

				// CSS output
				if ( is_customize_preview() && $this->enable_postMessage ) {
					add_action( 'wp_head', array( $this, 'live_preview_styles' ), 999 );
				} else {
					add_action( 'wpex_head_css', array( $this, 'head_css' ), 999 );
				}

			}

		}

		/**
		 * Add sub menu page for the custom CSS input
		 *
		 * @since 3.0.0
		 */
		public function add_admin_page() {
			add_submenu_page(
				WPEX_THEME_PANEL_SLUG,
				esc_html__( 'Customizer Manager', 'total' ),
				esc_html__( 'Customizer Manager', 'total' ),
				'administrator',
				WPEX_THEME_PANEL_SLUG .'-customizer',
				array( $this, 'create_admin_page' )
			);
		}

		/**
		 * Prints styles for the admin page
		 *
		 * @since 3.0.0
		 */
		public function admin_styles() { ?>

			<style type="text/css">
				.wpex-customizer-editor-table th,
				.wpex-customizer-editor-table td { padding: 7px 0 !important; }
			</style>

		<?php }

		/**
		 * Function that will register admin page options.
		 *
		 * @since 3.0.0
		 */
		public function admin_options() {
			register_setting( 'wpex_customizer_editor', 'wpex_customizer_panels' );
		}

		/**
		 * Settings page output
		 *
		 * @since 3.0.0
		 *
		 */
		public function create_admin_page() { ?>

			<div class="wrap">

				<h2><?php esc_html_e( 'Customizer Manager', 'total' ); ?></h2>
				<p style="max-width:70%;"><?php esc_html_e( 'It\'s best to disable the Customizer panels you\'re not currently changing or won\'t need to change anymore to speed things up. Your settings will still be set, so don\'t worry about them being reverted to their defaults.', 'total' ); ?></p>

				<?php
				// Customizer url
				$customize_url = add_query_arg( array(
					'return'                => urlencode( wp_unslash( $_SERVER['REQUEST_URI'] ) ),
					'wpex_theme_customizer' => 'true',
				), 'customize.php' ); ?>

				<h2 class="nav-tab-wrapper">
					<a href="#" class="nav-tab nav-tab-active"><?php esc_html_e( 'Enable Panels', 'total' ); ?></a>
					<a href="<?php echo esc_url( $customize_url ); ?>"  class="nav-tab"><?php esc_html_e( 'Customizer', 'total' ); ?><span class="dashicons dashicons-external" style="padding-left:7px;"></span></a>
				</h2>

				<div style="margin-top:20px;">
					<a href="#" class="wpex-customizer-check-all"><?php esc_html_e( 'Check all', 'total' ); ?></a> | <a href="#" class="wpex-customizer-uncheck-all"><?php esc_html_e( 'Uncheck all', 'total' ); ?></a>
				</div>

				<form method="post" action="options.php">

					<?php settings_fields( 'wpex_customizer_editor' ); ?>

					<table class="form-table wpex-customizer-editor-table">
						<?php
						// Get panels
						$panels = $this->panels;

						// Check if post types are enabled
						$post_types = wpex_theme_post_types();

						// Get options and set defaults
						$options = get_option( 'wpex_customizer_panels', $this->panels );

						// Loop through panels and add checkbox
						foreach ( $panels as $id => $val ) {

							// Parse panel data
							$title     = isset( $val['title'] ) ? $val['title'] : $val;
							$condition = isset( $val['condition'] ) ? $val['condition'] : true;

							// Get option
							$option = isset( $options[$id] ) ? 'on' : false;

							// Display option if condition is met
							if ( $condition ) { ?>

								<tr valign="top">
									<th scope="row"><?php echo $title; ?></th>
									<td>
										<fieldset>
											<input class="wpex-customizer-editor-checkbox" type="checkbox" name="wpex_customizer_panels[<?php echo $id; ?>]"<?php checked( $option, 'on' ); ?>>
										</fieldset>
									</td>
								</tr>

							<?php }

							// Condition isn't met so add it as a hidden item
							else { ?>

								<input type="hidden" name="wpex_customizer_panels[<?php echo $id; ?>]"<?php checked( $option, 'on' ); ?>>	

							<?php } ?>

						<?php } ?>

					</table>

					<?php submit_button(); ?>

				</form>

			</div><!-- .wrap -->

			<script>
				(function($) {
					"use strict";
						$( '.wpex-customizer-check-all' ).click( function() {
							$('.wpex-customizer-editor-checkbox').each( function() {
								this.checked = true;
							} );
							return false;
						} );
						$( '.wpex-customizer-uncheck-all' ).click( function() {
							$('.wpex-customizer-editor-checkbox').each( function() {
								this.checked = false;
							} );
							return false;
						} );
				} ) ( jQuery );
			</script>

		<?php } // END create_admin_page()

		/**
		 * Adds custom controls
		 *
		 * @since 3.0.0
		 */
		public function controls_callbacks() {
			require_once( $this->customizer_dir . 'customizer-controls.php' );
			require_once( $this->customizer_dir . 'customizer-helpers.php' );
		}

		/**
		 * Adds CSS for customizer custom controls
		 *
		 * @since 3.0.0
		 */
		public static function customize_controls_print_styles() {

			// Get post type icons
			$portfolio_icon    = wpex_dashicon_css_content( wpex_get_portfolio_menu_icon() );
			$staff_icon        = wpex_dashicon_css_content( wpex_get_staff_menu_icon() );
			$testimonials_icon = wpex_dashicon_css_content( wpex_get_testimonials_menu_icon() ); ?>
			
			 <style type="text/css" id="wpex-customizer-controls-css">

				/* Icons */
				#accordion-panel-wpex_general > h3:before,
				#accordion-panel-wpex_typography > h3:before,
				#accordion-panel-wpex_layout > h3:before,
				#accordion-section-wpex_togglebar > h3:before,
				#accordion-panel-wpex_topbar > h3:before,
				#accordion-panel-wpex_header > h3:before,
				#accordion-section-wpex_sidebar > h3:before,
				#accordion-panel-wpex_blog > h3:before,
				#accordion-panel-wpex_portfolio > h3:before,
				#accordion-panel-wpex_staff > h3:before,
				#accordion-section-wpex_testimonials > h3:before,
				#accordion-section-wpex_callout > h3:before,
				#accordion-section-wpex_footer_widgets > h3:before,
				#accordion-section-wpex_footer_bottom > h3:before,
				#accordion-section-wpex_visual_composer > h3:before,
				#accordion-panel-wpex_woocommerce > h3:before,
				#accordion-section-wpex_tribe_events > h3:before { display: inline-block; width: 20px; height: 20px; font-size: 20px; line-height: 1; font-family: dashicons; text-decoration: inherit; font-weight: 400; font-style: normal; vertical-align: top; text-align: center; -webkit-transition: color .1s ease-in 0; transition: color .1s ease-in 0; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale; color: #298cba; margin-right: 10px; font-family: "dashicons"; content: "\f108"; }

				#accordion-panel-wpex_typography > h3:before { content: "\f215" }
				#accordion-panel-wpex_layout > h3:before { content: "\f535" }
				#accordion-section-wpex_togglebar > h3:before { content: "\f132" }
				#accordion-panel-wpex_topbar > h3:before { content: "\f157" }
				#accordion-panel-wpex_header > h3:before { content: "\f175" }
				#accordion-section-wpex_sidebar > h3:before { content: "\f135" }
				#accordion-panel-wpex_blog > h3:before { content: "\f109" }
				#accordion-panel-wpex_portfolio > h3:before { content: "\<?php echo esc_attr( $portfolio_icon ); ?>" }
				#accordion-panel-wpex_staff > h3:before { content: "\<?php echo esc_attr( $staff_icon ); ?>" }
				#accordion-section-wpex_testimonials > h3:before { content: "\<?php echo esc_attr( $testimonials_icon ); ?>" }
				#accordion-section-wpex_callout > h3:before { content: "\f488" }
				#accordion-section-wpex_footer_widgets > h3:before { content: "\f209" }
				#accordion-section-wpex_footer_bottom > h3:before { content: "\f209"; }
				#accordion-section-wpex_visual_composer > h3:before { content: "\f540" }
				#accordion-panel-wpex_woocommerce > h3:before { content: "\f174" }
				#accordion-section-wpex_tribe_events > h3:before { content: "\f145" }

				/* General Tweaks */
				.customize-control-select select { min-width: 100% }

				/* Social Widgets */
				.wpex-social-widget-services-list { padding-top: 10px; }
				.wpex-social-widget-services-list li { background: #fafafa; padding: 10px; border: 1px solid #e5e5e5; margin-bottom: 10px; }
				.wpex-social-widget-services-list li p { margin: 0 }
				.wpex-social-widget-services-list li label { margin-bottom: 3px; display: block; color: #222; }
				.wpex-social-widget-services-list li label span.fa { margin-right: 10px }

				/* Slider UI */
				li.customize-control.customize-control-wpex_slider_ui input[type=text] { width: 20%; float: left; text-align: center; }
				li.customize-control.customize-control-wpex_slider_ui .ui-slider-horizontal.wpex-slider-ui { float: right; width: 75%; height: 5px; margin-top: 10px; color: #333; position: relative; border-radius: 5px; border: 1px solid #747474; border-bottom-color: #aeaeae; background-color: #cdcdcd; background: -webkit-linear-gradient(#aaaaaa, #cdcdcd); background: -o-linear-gradient(#aaaaaa, #cdcdcd); background: -moz-linear-gradient(#aaaaaa, #cdcdcd); background: linear-gradient(#aaaaaa, #cdcdcd); }
				li.customize-control.customize-control-wpex_slider_ui .ui-slider-horizontal .ui-slider-handle { position: absolute; z-index: 2; width: 17px; height: 17px; cursor: default; top: -7px; margin-left: -10px; border-radius: 50%; border: 1px solid #9e9e9e; -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.07); box-shadow: inset 0 1px 2px rgba(0,0,0,.07); cursor: pointer; background-color: #f5f5f5; background: -webkit-linear-gradient(#f8f8f8, #ededed); background: -o-linear-gradient(#f8f8f8, #ededed); background: -moz-linear-gradient(#f8f8f8, #ededed); background: linear-gradient(#f8f8f8, #ededed); box-shadow: 0 2px 2px rgba(0,0,0,0.24); }

				/* Sortable */
				.wpex-sortable ul { margin-top: 10px }
				.wpex-sortable li.wpex-sortable-li { cursor: move; background: #fff; padding: 0; padding-left: 15px; height: 40px; line-height: 40px; white-space: nowrap; border: 1px solid #dfdfdf; text-overflow: ellipsis; -webkit-user-select: none; -moz-user-select: none; -ms-user-select: none; user-select: none; color: #222; margin-bottom: 5px; margin-top: 0; overflow: hidden; position: relative; }
				.wpex-sortable li.wpex-sortable-li:hover { border-color: #999; z-index: 10; }
				.wpex-sortable li.wpex-sortable-li .fa { display: block; position: absolute; top: 0; right: 0; width: 42px; height: 40px; line-height: 40px; margin: 0; color: #5cb85c; text-align: center; font-size: 18px; }
				.wpex-sortable li.wpex-sortable-li .wpex-hide-sortee { cursor: pointer }
				.wpex-sortable ul li:last-child { margin-bottom: 0 }
				.wpex-sortable li.wpex-hide .fa { color: #d9534f; }
				.wpex-sortable li.wpex-hide { opacity: 0.65; }

				/* Custom Heading */
				.wpex-customizer-heading { display: block; padding-top: 30px; padding-bottom: 5px; border-bottom: 1px solid #ddd; font-size: 16px; font-weight: bold; }

			 </style>

		<?php }

		/**
		 * Removes core modules
		 *
		 * @since 3.0.0
		 */
		public static function remove_core_sections( $wp_customize ) {

			// Tweak default controls
			$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';

			// Remove core sections
			$wp_customize->remove_section( 'colors' );
			//$wp_customize->remove_section( 'nav' );
			$wp_customize->remove_section( 'themes' );
			//$wp_customize->remove_section( 'title_tagline' );
			$wp_customize->remove_section( 'background_image' );
			//$wp_customize->remove_section( 'static_front_page' );

			// Remove core controls
			$wp_customize->remove_control( 'blogdescription' ); // We don't use tagline

			// Display favicon only if Favicons admin is disabled
			if ( wpex_get_mod( 'favicons_enable', true ) ) {
				$wp_customize->remove_control( 'site_icon' );
			}

			$wp_customize->remove_control( 'header_textcolor' );
			$wp_customize->remove_control( 'background_color' );
			$wp_customize->remove_control( 'background_image' );

			// Remove default settings
			$wp_customize->remove_setting( 'background_color' );
			$wp_customize->remove_setting( 'background_image' );

			// Remove widgets
			//$wp_customize->remove_panel( 'widgets' ); // Re-added in 3.3.0 after WP 4.4 Customizer improvements

			/* Remove menus - slows things down - Re-added in 3.3.0 after WP 4.4 Customizer improvements
			$wp_customize->remove_panel( 'nav_menus' );
			remove_action( 'customize_controls_enqueue_scripts', array( $wp_customize->nav_menus, 'enqueue_scripts' ) );
			remove_action( 'customize_register', array( $wp_customize->nav_menus, 'customize_register' ), 11 );
			remove_filter( 'customize_dynamic_setting_args', array( $wp_customize->nav_menus, 'filter_dynamic_setting_args' ) );
			remove_filter( 'customize_dynamic_setting_class', array( $wp_customize->nav_menus, 'filter_dynamic_setting_class' ) );
			remove_action( 'customize_controls_print_footer_scripts', array( $wp_customize->nav_menus, 'print_templates' ) );
			remove_action( 'customize_controls_print_footer_scripts', array( $wp_customize->nav_menus, 'available_items_template' ) );
			remove_action( 'customize_preview_init', array( $wp_customize->nav_menus, 'customize_preview_init' ) );*/

		}

		/**
		 * Get all sections
		 *
		 * @since 3.0.0
		 */
		public function add_sections() {

			// Get panels
			$panels = $this->panels;

			// Return if there aren't any panels
			if ( ! $panels ) {
				return;
			}

			// Useful variables to pass along to customizer settings
			$post_layouts = wpex_get_post_layouts();

			// Loop through panels
			foreach( $panels as $id => $val ) {

				// These have their own sections outside the main class scope
				if ( 'typography' == $id ) {
					continue;
				}

				// Continue if condition isn't met
				if ( isset( $val['condition'] ) && ! $val['condition'] ) {
					continue;
				}

				// Section file location
				$file = isset( $val['settings'] ) ? $val['settings'] : $this->customizer_dir . 'settings/'. $id .'.php';

				// Include file and update sections var
				if ( file_exists( $file ) ) {
					require_once( $file );
				}

			}

			// Apply filters
			$this->sections = apply_filters( 'wpex_customizer_sections', $this->sections );

		}
 
		/**
		 * Registers new controls
		 * Removes default customizer sections and settings
		 * Adds new customizer sections, settings & controls
		 *
		 * @since 3.0.0
		 */
		public function add_customizer_panels_sections( $wp_customize ) {

			// Get panels
			$all_panels = $this->panels;

			// Get enabled panels
			$enabled_panels = $this->enabled_panels;

			// If there are panels enabled let's add them and get their controls
			if ( $enabled_panels ) {

				// Add Panels
				$priority = 140;
				foreach( $all_panels as $id => $val ) {
					$priority++;

					// Disabled so do nothing
					if ( ! isset( $enabled_panels[$id] ) ) {
						continue;
					}

					// No panel needed for these
					if ( 'styling' == $id || 'typography' == $id ) {
						continue;
					}

					// Continue if condition isn't met
					if ( isset( $val['condition'] ) && ! $val['condition'] ) {
						continue;
					}

					// Get title and check if panel or section
					$title      = isset( $val['title'] ) ? $val['title'] : $val;
					$is_section = isset( $val['is_section'] ) ? true : false;

					// Add section
					if ( $is_section ) {

						$wp_customize->add_section( 'wpex_'. $id, array(
							'priority' => $priority,
							'title'    => $title,
						) );

					}

					// Add Panel
					else {

						$wp_customize->add_panel( 'wpex_'. $id, array(
							'priority' => $priority,
							'title'    => $title,
						) );

					}

				}

				// Create the new customizer sections
				if ( ! empty( $this->sections ) ) {
					$this->create_sections( $wp_customize, $this->sections );
				}

				//print_r( $wp_customize ); // For testing

			} // $enabled_panels check

		} // END customize_register()

		/**
		 * Creates the Sections and controls for the customizer
		 *
		 * @since 3.0.0
		 */
		public function create_sections( $wp_customize ) {

			// Loop through sections and add create the customizer sections, settings & controls
			foreach ( $this->sections as $section_id => $section ) {

				// Get section settings
				$settings = ! empty( $section['settings'] ) ? $section['settings'] : null;

				// Return if no settings are found
				if ( ! $settings ) {
					return;
				}

				// Get section description
				$description = isset( $section['desc'] ) ? $section['desc'] : '';

				// Add customizer section
				if ( isset( $section['panel'] ) ) {
					$wp_customize->add_section( $section_id, array(
						'title'       => $section['title'],
						'panel'       => $section['panel'],
						'description' => $description,
					) );
				}

				// Add settings+controls
				foreach ( $settings as $setting ) {

					// Get vals
					$id           = $setting['id']; // Required no need to check
					$transport    = isset( $setting['transport'] ) ? $setting['transport'] : 'refresh';
					$default      = isset( $setting['default'] ) ? $setting['default'] : '';
					$control_type = isset( $setting['control']['type'] ) ? $setting['control']['type'] : 'text';

					// Get sanitize callback
					if ( isset( $setting['sanitize_callback'] ) ) {
						$sanitize_callback = $setting['sanitize_callback'];
					} else {
						$sanitize_callback = false;
					}

					// Add values to control
					$setting['control']['settings'] = $setting['id'];
					$setting['control']['section'] = $section_id;

					// All heading types are postMessage
					if ( 'wpex-heading' == $control_type ) {
						$transport = 'postMessage';
					}

					// Add description
					if ( isset( $setting['control']['desc'] ) ) {
						$setting['control']['description'] = $setting['control']['desc'];
					}

					// Control object
					if ( isset( $setting['control']['object'] ) ) {
						$control_object = $setting['control']['object'];
					} elseif ( 'image' == $control_type ) {
						$control_object = 'WP_Customize_Image_Control';
					} elseif ( 'color' == $control_type ) {
						$control_object = 'WP_Customize_Color_Control';
					} elseif ( 'wpex-heading' == $control_type ) {
						$control_object = 'WPEX_Customizer_Heading_Control';
					} elseif ( 'wpex-sortable' == $control_type ) {
						$control_object = 'WPEX_Customize_Control_Sorter';
					} elseif ( 'wpex-dropdown-pages' == $control_type ) {
						$control_object = 'WPEX_Customizer_Dropdown_Pages';
					} elseif ( 'wpex_textareaa' == $control_type ) {
						$control_object = 'WPEX_Customizer_Textarea_Control';
					} else {
						$control_object = 'WP_Customize_Control';
					}

					// If $id defined add setting and control
					if ( $id ) {

						// Add setting
						$wp_customize->add_setting( $id, array(
							'type'              => 'theme_mod',
							'transport'         => $transport,
							'default'           => $default,
							'sanitize_callback' => $sanitize_callback,
						) );

						// Add control
						$wp_customize->add_control( new $control_object (
							$wp_customize,
							$id, $setting['control'] )
						);

					}
				}
			}

		} // END create_sections()

		/**
		 * Loads js file for customizer preview
		 *
		 * @since 3.3.0
		 */
		public function customize_preview_init() {
			if ( $this->enable_postMessage ) {
				wp_enqueue_script( 'wpex-customize-preview',
					get_template_directory_uri() . '/framework/customizer/customize-preview.js',
					array( 'customize-preview' ),
					WPEX_THEME_VERSION,
					true
				);
			}
		}

		/**
		 * Generates inline CSS for styling options
		 *
		 * @since 1.0.0
		 */
		public function loop_through_inline_css( $return = 'css' ) {

			// Define vars
			$add_css           = '';
			$elements_to_alter = '';
			$preview_styles    = '';

			// Get customizer settings
			$settings = wp_list_pluck( $this->sections, 'settings' );

			// Return if there aren't any settings
			if ( empty( $settings ) ) {
				return;
			}

			// Loop through settings and find inline_css
			foreach ( $settings as $settings_array ) {

				foreach ( $settings_array as $setting ) {

					// Store setting ID and default value
					$setting_id = $setting['id']; // no need to check cause it's required

					// Get defaults & inline_css
					$inline_css = isset( $setting['inline_css'] ) ? $setting['inline_css'] : null;

					// Check condition
					$condition = isset( $inline_css['obj_condition'] ) ? $inline_css['obj_condition'] : '';

					// Don't add CSS if conditon isn't met
					if ( $condition && ! call_user_func( 'wpex_global_obj', $condition ) ) {
						continue;
					}

					// Get default and value
					$default    = isset ( $setting['default'] ) ? $setting['default'] : false;
					$theme_mod  = wpex_get_mod( $setting_id, $default );

					// If mod is equal to default and part of the mods let's remove it
					// This is a good place since we are looping through all settings anyway
					if ( apply_filters( 'wpex_remove_default_mods', false ) ) {
						$get_all_mods = wpex_get_mods();
						if ( $theme_mod == $default && $get_all_mods && isset( $get_all_mods[$setting_id] ) ) {
							remove_theme_mod( $setting_id );
						}
					}

					// These are required for outputting custom CSS
					if ( ! $theme_mod || ! $inline_css ) {
						continue;
					}

					// Get inline_css params
					$sanitize    = isset( $inline_css['sanitize'] ) ? $inline_css['sanitize'] : '';
					$target      = isset( $inline_css['target'] ) ? $inline_css['target'] : '';
					$alter       = isset( $inline_css['alter'] ) ? $inline_css['alter'] : '';
					$important   = isset( $inline_css['important'] ) ? '!important' : false;
					$media_query = isset( $inline_css['media_query'] ) ? $inline_css['media_query'] : false;

					// Add to preview_styles array
					if ( 'preview_styles' == $return ) {
						$preview_styles['customizer-'. $setting_id] = '';
					}

					// Target and alter vars are required, if they are empty continue onto the next setting
					if ( ! $target || ! $alter ) {
						continue;
					}

					// Sanitize data
					if ( $sanitize ) {
						$theme_mod = wpex_sanitize_data( $theme_mod, $sanitize );
					} else {
						$theme_mod = $theme_mod;
					}

					// Set to array if not
					$target = is_array( $target ) ? $target : array( $target );

					// Loop through items
					foreach( $target as $element ) {

						// Add to elements list if not already for CSS output only
						if ( 'css' == $return && ! isset( $elements_to_alter[$element] ) ) {
							$elements_to_alter[$element] = array( 'css' => '' );
						}

						// Return CSS or js
						if ( is_array( $alter ) ) {

							// Loop through elements to alter
							foreach( $alter as $alter_val ) {

								// Inline CSS
								if ( 'css' == $return ) {

									// If it has a media query it's its own thing
									if ( $media_query ) {
										$add_css .= '@media only screen and '. $media_query . '{'.$element .'{ '. $alter_val .':'. $theme_mod . $important .'; }}';
									} else {
										$elements_to_alter[$element]['css'] .= $alter_val .':'. $theme_mod . $important .';';
									}
								}

								// Live preview styles
								elseif ( 'preview_styles' == $return ) {

									// If it has a media query it's its own thing
									if ( $media_query ) {
										$preview_styles['customizer-'. $setting_id] .= '@media only screen and '. $media_query . '{'.$element .'{ '. $alter_val .':'. $theme_mod . $important .'; }}';
									}

									// Not media query
									else {
										$preview_styles['customizer-'. $setting_id] .= $element .'{ '. $alter_val .':'. $theme_mod . $important .'; }';
									}
								}
							}
						}

						// Single element to alter
						else {

							// Background image tweak
							if ( 'background-image' == $alter ) {
								$theme_mod = 'url('. esc_url( $theme_mod ) .')';
							}

							// Inline CSS
							if ( 'css' == $return ) {

								// If it has a media query it's its own thing
								if ( $media_query ) {
									$add_css .= '@media only screen and '. $media_query . '{'.$element .'{ '. $alter .':'. $theme_mod . $important .'; }}';
								}

								// Not media query
								else {
									$elements_to_alter[$element]['css'] .= $alter .':'. $theme_mod . $important .';';
								}

							}

							// Live preview styles
							elseif ( 'preview_styles' == $return ) {

								// If it has a media query it's its own thing
								if ( $media_query ) {
									$preview_styles['customizer-'. $setting_id] .= '@media only screen and '. $media_query . '{'.$element .'{ '. $alter .':'. $theme_mod . $important .'; }}';
								}

								// Not media query
								else {
									$preview_styles['customizer-'. $setting_id] .= $element .'{ '. $alter .':'. $theme_mod . $important .'; }';
								}

							}

						}

					}

				} // End settings_array

			} // End settings loop

			// Loop through elements for CSS only
			if ( 'css' == $return && $elements_to_alter ) {
				foreach( $elements_to_alter as $element => $array ) {
					if ( isset( $array['css'] ) ) {
						$add_css .= $element.'{'.$array['css'].'}';
					}
				}
			}

			// Return inline css
			if ( 'css' == $return ) {
				return $add_css;
			}

			// Return preview styles
			if ( 'preview_styles' == $return ) {
				return $preview_styles;
			}

		}

		/**
		 * Returns correct CSS to output to wp_head
		 *
		 * @since 1.0.0
		 */
		public function head_css( $output ) {
			$inline_css = $this->loop_through_inline_css( 'css' );
			if ( $inline_css ) {
				$output .= '/*CUSTOMIZER STYLING*/'. $inline_css;
			}
			return $output;
		}

		/**
		 * Returns correct CSS to output to wp_head
		 *
		 * @since 1.0.0
		 */
		public function live_preview_styles() {
			$live_preview_styles = $this->loop_through_inline_css( 'preview_styles' );
			if ( $live_preview_styles ) {
				foreach ( $live_preview_styles as $key => $val ) {
					if ( ! empty( $val ) ) {
						echo '<style class="'. $key .'"> '. $val .'</style>';
					}
				}
			}
		}

	}
}

// Start up class and set to global var
$wpex_customizer = new WPEX_Customizer();

/* Helper function generates customizer live preview js
// Better then looping through on every page load...same some time and allows for manually minifying
function wpex_generate_customizer_live_preview_js() {
	global $wpex_customizer;
	$output = '';
	$settings = wp_list_pluck( $wpex_customizer->sections, 'settings' );
	foreach ( $settings as $settings_array ) {
		foreach ( $settings_array as $setting ) {
			if ( ! isset( $setting['inline_css'] ) ) {
				continue;
			}
			$transport = isset( $setting['transport'] ) ? $setting['transport'] : 'refresh';
			if ( 'postMessage' == $transport ) {

				// Open js output
				$output .= 'api("'. $setting['id'] .'", function(value){value.bind(function(newval){';

				// Get inline css
				$inline_css  = $setting['inline_css'];
				$target      = isset( $inline_css['target'] ) ? $inline_css['target'] : '';
				$target      = is_array( $target ) ? $target : array( $target );
				$target      = implode( ',', $target );
				$is_hover    = isset( $inline_css['is_hover'] ) ? true : false;
				$alter       = isset( $inline_css['alter'] ) ? $inline_css['alter'] : '';
				$important   = isset( $inline_css['important'] ) ? '!important' : false;
				$media_query = isset( $inline_css['media_query'] ) ? $inline_css['media_query'] : false;

				// Generate style classname
				$style_class = 'customizer-'. $setting['id'];

				// Get output
				$mods = '';
				if ( is_array( $alter ) ) {
					foreach( $alter as $alter_val ) {
						$mods .= $alter_val .': \' + newval + \''. $important .';';
					}
				} else {
					$mods = $alter .': \' + newval + \''. $important .';';
				}

				// These are the styles to add inside the style tag
				$styles = $target .' { '. $mods .' }';

				// If it has a media query it's its own thing
				if ( $media_query ) {
					$styles = '@media only screen and '. $media_query . '{ '. $styles .' }';
				}

				$output .= '
					var el = $( \'.'. $style_class .'\' );
					if ( newval ) {
						var style = \'<style class="'. $style_class .'">'. $styles .'</style>\';
						if ( el.length ) {
							el.replaceWith( style );
						} else {
							 $( \'head\' ).append( style );
						}
					} else {
						el.remove();
					}
				';

				// Close js output
				$output .= '});});';

			}
		} // End foreach setting
	}
	$output = $output;
	echo $output;
	exit;
}
add_action( 'init', 'wpex_generate_customizer_live_preview_js' ); */