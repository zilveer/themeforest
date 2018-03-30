<?php
/**
 * Creates the admin panel and custom JS output
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_Custom_JS' ) ) {
	class WPEX_Custom_JS {

		/**
		 * Start things up
		 *
		 * @since 1.6.0
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_page' ), 20 );
			add_action( 'admin_init', array( $this,'register_settings' ) );
			add_action( 'admin_enqueue_scripts',array( $this,'scripts' ) );
			add_action( 'admin_notices', array( $this, 'notices' ) );
			add_action( 'wp_footer' , array( $this, 'output_js' ), 99 );
		}

		/**
		 * Add sub menu page for the custom JS input
		 *
		 * @since 1.6.0
		 */
		public function add_page() {
			add_submenu_page(
				WPEX_THEME_PANEL_SLUG,
				esc_html__( 'Custom JS', 'total' ),
				esc_html__( 'Custom JS', 'total' ),
				'administrator',
				WPEX_THEME_PANEL_SLUG .'-custom-js',
				array( $this, 'create_admin_page' )
			);
		}

		/**
		 * Load scripts
		 *
		 * @since 1.6.0
		 */
		public function scripts( $hook ) {
			if ( WPEX_ADMIN_PANEL_HOOK_PREFIX . '-custom-js' == $hook ) {
				wp_deregister_script( 'ace-editor' );
				wp_enqueue_script( 'wpex-ace-editor',  WPEX_FRAMEWORK_DIR_URI .'addons/assets/ace.js', array(), true );
			}
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * @since 1.6.0
		 */
		public function register_settings() {
			register_setting( 'wpex_custom_js', 'wpex_custom_js', array( $this, 'sanitize' ) );
		}

		/**
		 * Displays all messages registered to 'wpex-custom_js-notices'
		 *
		 * @since 1.6.0
		 */
		public static function notices() {
			settings_errors( 'wpex_custom_js_notices' );
		}

		/**
		 * Sanitization callback
		 *
		 * @since 1.6.0
		 */
		public static function sanitize( $option ) {

			// Set option to theme mod
			set_theme_mod( 'custom_js', $option );

			// Return notice
			add_settings_error(
				'wpex_custom_js_notices',
				esc_attr( 'settings_updated' ),
				esc_html__( 'Settings saved.', 'total' ),
				'updated'
			);
			
			// no need to save in DB
			return;
		}

		/**
		 * Settings page output
		 *
		 * @since 1.6.0
		 */
		public static function create_admin_page() { ?>

			<div class="wrap">

				<h2><?php esc_html_e( 'Custom JS', 'total' ); ?></h2>

				<div>
					<form method="post" action="options.php">
						<?php settings_fields( 'wpex_custom_js' ); ?>
						<table class="form-table">
							<tr valign="top">
								<td style="padding:0;">
									<textarea rows="40" cols="50" id="wpex_custom_js" style="display:none;" name="wpex_custom_js"><?php echo wpex_get_mod( 'custom_js', null ); ?></textarea>
									<pre id="wpex_custom_js_editor" style="width:100%;height:800px;font-size:14px; border: 1px solid #BABABA;"><?php echo wpex_get_mod( 'custom_js', null ); ?></pre>
								</td>
							</tr>
						</table>
						<?php submit_button(); ?>
					</form>
				</div>

			</div><!-- .wrap -->

			<script>
				( function( $ ) {
					"use strict";
					jQuery( document ).ready( function( $ ) {

						// Start ace editor
						var $css_editor       = $( '#wpex_custom_js_editor' ),
							$css_editor_input = $( '#wpex_custom_js' ),
						 	$editor           = ace.edit( 'wpex_custom_js_editor' );
						$editor.getSession().setUseWorker(false);
						$editor.setTheme( "ace/theme/chrome" );
						$editor.getSession().setMode( "ace/mode/javascript" );
						$editor.find('needle',{
							backwards     : false,
							wrap          : false,
							caseSensitive : false,
							wholeWord     : false,
							regExp        : false
						});
						$editor.findNext();
						$editor.findPrevious();
						
						// Add val to hidden field
						$editor.on('input', function() {
							$css_editor_input.val( $editor.getValue() );
						} );

					} );
				} ) ( jQuery );
			</script>

		<?php }

		/**
		 * Outputs the custom JS to the wp_head
		 *
		 * @since 1.6.0
		 */
		public static function output_js() {
			$output = '';
			if ( wpex_get_mod( 'custom_js', null ) ) { ?>
				<!-- CUSTOM JS -->
				<script type="text/javascript">
					( function( $ ) {
						"use strict";
						<?php echo wpex_get_mod( 'custom_js', null ); ?>
					} ) ( jQuery );
				</script>
			<?php
			}
		}

	}
}
$wpex_custom_js = new WPEX_Custom_JS();