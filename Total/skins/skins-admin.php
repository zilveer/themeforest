<?php
/**
 * Creates the admin panel for the customizer
 * This function has been deprecated but can be re-enabled via
 * the "wpex_enable_skins_panel" filter
 *
 * @package Total WordPress Theme
 * @subpackage Skins
 * @version 3.3.0
 *
 * @deprecated Since 3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Creates a beautiful admin panel for selecting your theme skin
 *
 * @since 1.6.0
 */
if ( ! class_exists( 'WPEX_Skins_Admin' ) ) {

	class WPEX_Skins_Admin {

		/**
		 * Start things up
		 */
		public function __construct() {
			add_action( 'admin_menu', array( $this, 'add_page' ), 20 );
			add_action( 'admin_init', array( $this, 'register_settings' ) );
			add_action( 'admin_print_styles-'. WPEX_ADMIN_PANEL_HOOK_PREFIX . '-skins', array( $this, 'css' ), 40 );
		}

		/**
		 * Add sub menu page
		 */
		public function add_page() {
			add_submenu_page(
				WPEX_THEME_PANEL_SLUG,
				'Theme Skins',
				'Theme Skins',
				'administrator',
				WPEX_THEME_PANEL_SLUG .'-skins',
				array( $this, 'create_admin_page' )
			);
		}
		
		/**
		 * Register a setting and its sanitization callback.
		 */
		public function register_settings() {
			register_setting( 'wpex_skins_options', 'theme_skin', array( $this, 'sanitize' ) );
		}

		/**
		 * Sanitization callback
		 */
		public function sanitize( $options ) {
			$skin = ! empty ( $options ) ? $options : 'base';
			if ( 'base' == $skin ) {
				remove_theme_mod( 'theme_skin' );
			} else {
				set_theme_mod( 'theme_skin', $skin );
			}
			$options = '';
		}

		/**
		 * Settings page output
		 */
		public function create_admin_page() { ?>

			<div class="wrap wpex-skins-admin">

				<h2>Theme Skins</h2>

				<?php
				// Check if admin is enabled
				$notice = apply_filters( 'wpex_skins_deprecated_notice', true );

				// Display notice
				if ( $notice ) { ?>

					<div class="notice error" style="display:block!important;padding:20px;">
						<h4 style="margin:0 0 10px;font-size:16px;">Important Notice</h4>
						<p>Skins have been deprecated since Total 3.0.0. The theme has enough settings to allow you to create a design that fits your needs without loading extra bloat. If you select the "base" skin this admin panel will be removed and you will see an error message. To re-enable please visit the online snippets for this theme.</p>
						<p>We highly recommend you select the BASE skin and make all your edits via the Customizer to get the design you want or use a child theme (both are more optimized methods).</p>
					</div>

				<?php }

				// Get skins array
				$skins = WPEX_Skin_Loader::skins_array();

				// Current skin from site_theme option
				$current_skin = wpex_active_skin();

				// Get fallback from redux
				if ( ! $current_skin ) {
					$data         = get_option( 'wpex_options' );
					$current_skin = isset( $data['site_theme'] ) ? $data['site_theme'] : 'base';
				} ?>

				<form method="post" action="options.php">

					<?php settings_fields( 'wpex_skins_options' ); ?>

					<div class="wpex-skins-select theme-browser" id="theme_skin">

						<?php
						// Loop through skins
						foreach ( $skins as $key => $val ) {
						$classes = 'wpex-skin theme';
						$checked = $active = '';
						if ( ! empty( $current_skin ) && $current_skin == $key ) {
							$checked = 'checked';
							$classes .= ' active';
						} ?>

						<div class="<?php echo $classes; ?>">

							<input type="radio" id="wpex-skin-<?php echo $key; ?>" name="theme_skin" value="<?php echo $key; ?>" <?php echo $checked; ?> class="wpex-skin-radio" />

							<?php if ( ! empty( $val['screenshot'] ) ) : ?>

								<div class="theme-screenshot">
									<img src="<?php echo esc_url( $val['screenshot'] ); ?>" alt="Screenshot" />
								</div>

							<?php elseif ( function_exists( 'wpex_placeholder_img_src' ) ) : ?>

								<div class="theme-screenshot">
									<img src="<?php echo wpex_placeholder_img_src(); ?>" />
								</div>

							<?php endif; ?>

							<h3 class="theme-name">
								<?php if ( 'active' == $active ) {
									echo '<strong>Active:</strong> ';
								} ?>
								<?php echo $val[ 'name' ]; ?>
							</h3>

						</div>
						
						<?php } ?>

					</div><!-- .wpex-skin -->

					<?php submit_button(); ?>

				</form>

			</div><!-- .wpex-skins-select -->

			<script type="text/javascript">
				( function($) {
					"use strict";
					$( '.wpex-skin' ).click( function() {
						$( '.wpex-skin' ).removeClass( 'active' );
						$( this ).addClass( 'active' );
						var radio = $(this).find( '.wpex-skin-radio' );
						radio.prop( 'checked', true );
						event.preventDefault();
					} );
				} ) ( jQuery );
			</script>

		<?php }

		/**
		 * Admin page CSS
		 */
		public static function css() { ?>

			<style type="text/css">
				.notice { display: none !important; }
				.wpex-skins-admin h2 { margin-bottom: 15px }
				.wpex-skins-select:after { content: ""; display: block; height: 0; clear: both; visibility: hidden; zoom: 1; }
				.wpex-skins-select .theme-screenshot img { display: block; position: relative; }
				.wpex-skins-select .theme-screenshot:hover img { opacity: 0.75 }
				.wpex-skin-radio { display: none !important }
				.wpex-skins-admin p.submit { margin: 0; padding: 0; }
			</style>

		<?php }

	}
}
$wpex_skins_admin = new WPEX_Skins_Admin();