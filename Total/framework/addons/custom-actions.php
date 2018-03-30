<?php
/**
 * User actions
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_User_Actions' ) ) {

	class WPEX_User_Actions {

		/**
		 * Start things up
		 *
		 * @since 3.0.0
		 */
		public function __construct() {

			// Actions
			if ( is_admin() ) {
				add_action( 'admin_menu', array( 'WPEX_User_Actions', 'add_page' ), 40 );
				add_action( 'admin_init', array( 'WPEX_User_Actions','register_settings' ) );
				add_action( 'admin_print_styles-'. WPEX_ADMIN_PANEL_HOOK_PREFIX . '-user-actions', array( 'WPEX_User_Actions','admin_css' ), 40 );
			} else {
				add_action( 'init', array( 'WPEX_User_Actions','output' ) );
			}

		}

		/**
		 * Add sub menu page
		 *
		 * @since 3.0.0
		 */
		public static function add_page() {
			$slug = WPEX_THEME_PANEL_SLUG;
			add_submenu_page(
				$slug,
				esc_html__( 'Custom Actions', 'total' ),
				esc_html__( 'Custom Actions', 'total' ),
				'administrator',
				$slug .'-user-actions',
				array( 'WPEX_User_Actions', 'create_admin_page' )
			);
		}

		/**
		 * Register a setting and its sanitization callback.
		 *
		 * @since 3.0.0
		 */
		public static function register_settings() {
			register_setting( 'wpex_custom_actions', 'wpex_custom_actions', array( 'WPEX_User_Actions', 'admin_sanitize' ) ); 
		}

		/**
		 * Main Sanitization callback
		 *
		 * @since 3.0.0
		 */
		public static function admin_sanitize( $options ) {
			if ( ! empty( $options ) ) {
				foreach ( $options as $key => $val ) {
					if ( empty( $val['action'] ) ) {
						unset( $options[$key] );
					}
					// Validate stuff
					else {

						if ( ! empty( $val['priority'] ) ) {
							$options[$key]['priority'] = intval( $val['priority'] );
						}

						if ( isset( $val['php'] ) ) {
							$options[$key]['php'] = true;
						}

					}
				}
				return $options;
			}
		}

		/**
		 * Settings page output
		 *
		 * @since 3.0.0
		 */
		public static function create_admin_page() { ?>

			<div class="wrap wpex-custom-actions-admin-wrap">
 
				<h1 style="padding-right:0;"><?php esc_html_e( 'Custom Actions', 'total' ); ?></h1>

				<?php
				// Error notice for WP_Debug
				if ( ! defined( 'WP_DEBUG' ) || WP_DEBUG == false ) { ?>

					<div class="notice error">
						<p><?php esc_html_e( 'WP_DEBUG is disabled is currently disabled. It is highly recommended to enable it before adding action hooks incase you make a PHP error.', 'total' ); ?></p>
					</div>

				<?php } ?>

				<form method="post" action="options.php">

					<?php settings_fields( 'wpex_custom_actions' ); ?>

					<?php $options = get_option( 'wpex_custom_actions' ); ?>

					<div id="poststuff" class="wpex-custom-actions">

						<div id="post-body" class="metabox-holder columns-2">

							<div id="post-body-content">

								<div id="post-body-content" class="postbox-container">

									<div class="meta-box-sortables ui-sortable">

										<?php
										// Get hooks
										$wp_hooks = array(
											'wp_hooks' => array(
												'label' => 'WordPress',
												'hooks' => array(
													'wp_head',
													'wp_footer',
												),
											),
										);
										$hooks = $wp_hooks + wpex_theme_hooks();

										// Loop through sections
										foreach( $hooks as $section ) { ?>

											<h2><?php wp_strip_all_tags( $section['label'] ); ?></h2>

											<?php
											// Loop through hooks
											$hooks = $section['hooks'];

											foreach ( $hooks as $hook ) {

												// Get data
												$action   = ! empty( $options[$hook]['action'] ) ? $options[$hook]['action'] : '';
												$php      = isset( $options[$hook]['php'] ) ? true : false;
												$priority = isset( $options[$hook]['priority'] ) ? intval( $options[$hook]['priority'] ) : 10;  ?>

												<div class="postbox closed">

													<div class="handlediv" title="Click to toggle"></div>

													<h3 class="hndle<?php if ( $action ) echo ' active'; ?>"><span><span class="dashicons dashicons-editor-code" style="padding-right:10px;"></span><?php echo wp_strip_all_tags( $hook ); ?></span></h3>

													<div class="inside">

														<p>
															<label><?php esc_html_e( 'Code', 'total' ); ?></label>
															<textarea placeholder="<?php esc_attr_e( 'Enter your custom action here&hellip;', 'total' ); ?>" name="wpex_custom_actions[<?php echo esc_attr( $hook ); ?>][action]" rows="10" cols="50" style="width:100%;" class="wpex-textarea"><?php echo esc_textarea( $action ); ?></textarea>
														</p>

														<p class="clr">
															<label><?php esc_html_e( 'Enable PHP', 'total' ); ?></label>
															<input name="wpex_custom_actions[<?php echo esc_attr( $hook ); ?>][php]" type="checkbox" value="" class="wpex-enable-php" <?php checked( $php, true ); ?>>
														</p>

														<p class="clr">
															<label><?php esc_html_e( 'Priority', 'total' ); ?></label>
															<input name="wpex_custom_actions[<?php echo esc_attr( $hook ); ?>][priority]" type="number" value="<?php echo esc_attr( $priority ); ?>" class="wpex-priority">
														</p>

													</div><!-- .inside -->

												</div><!-- .postbox -->

											<?php } ?>

										<?php } ?>

									</div><!-- .meta-box-sortables -->

								</div><!-- #post-body-content -->

								<div id="postbox-container-1" class="postbox-container">
									<div class="postbox">
										<h3 class='hndle'><span><span class="dashicons dashicons-flag" style="margin-right:7px;"></span><?php esc_html_e( 'Important PHP Notice', 'total' ); ?></span></h3>
										<div class="inside">
											<p><?php esc_html_e( 'If you have enabled PHP for any action you MUST wrap your code in PHP tags. The theme will use the eval() function for outputting your PHP. Please be aware of the possibly security vulnerabilities this entails.', 'total' ); ?></p>
											<a href="//php.net/manual/en/function.eval.php" title="<?php esc_html_e( 'Learn More', 'total' ); ?>" target="_blank" class="button button-secondary"><?php esc_html_e( 'Learn More', 'total' ); ?></a>
										</div><!-- .inside -->
									</div><!-- .postbox -->
									<div class="postbox">
										<h3 class='hndle'><span><span class="dashicons dashicons-upload" style="margin-right:7px;"></span><?php esc_html_e( 'Save Your Actions', 'total' ); ?></span></h3>
										<div class="inside">
											<p><?php esc_html_e( 'Click the button below to save your custom actions.', 'total' ); ?></p>
											<?php submit_button(); ?>
										</div><!-- .inside -->
									</div><!-- .postbox -->
								</div><!-- .postbox-container -->

							</div><!-- #post-body-content -->

						</div><!-- #post-body -->

					</div><!-- #poststuff -->

				</form>

				<script>
					( function( $ ) {
						"use strict";
						$( document ).ready( function() {
							$( '.wpex-custom-actions .handlediv, .wpex-custom-actions .hndle' ).click( function( e ) {
								e.preventDefault();
								$( this ).parent().toggleClass( 'closed' );
							} );
						} );
					} ) ( jQuery );
				</script>

			</div><!-- .wrap -->

		<?php }

		/**
		 * Outputs code on the front-end
		 *
		 * @since 3.0.0
		 */
		public static function output() {

			// Get actions
			$actions = get_option( 'wpex_custom_actions' );

			// Return if actions are empty
			if ( empty( $actions ) ) {
				return;
			}

			// Loop through options
			foreach ( $actions as $key => $val ) {
				if ( ! empty( $val['action'] ) ) {
					$priority = isset( $val['priority'] ) ? intval( $val['priority'] ) : 10;
					add_action( $key, array( 'WPEX_User_Actions', 'execute_action' ), $priority );
				}
			}

		}

		/**
		 * Used to execute an action
		 *
		 * @since 3.0.0
		 */
		public static function execute_action() {

			// Set main vars
			$hook    = current_filter();
			$actions = get_option( 'wpex_custom_actions' );
			$php     = ! empty( $actions[$hook]['php'] ) ?  true : false;
			$output  = $actions[$hook]['action'];

			// Output
			if ( $output ) {
				if ( $php ) {
					eval( "?>$output<?php " );
				} else {
					echo do_shortcode( $output );
				}
			}

		}

		/**
		 * Admin CSS
		 *
		 * @since 3.0.0
		 */
		public static function admin_css() { ?>

			<style type="text/css">
				.clr:after { content: ""; display: block; height: 0; clear: both; visibility: hidden; zoom: 1; }
				.wpex-custom-actions-admin-wrap #poststuff h2 { font-size: 16px; margin: 10px 0; padding: 0; color: #000; font-weight: bold; }
				.wpex-custom-actions-admin-wrap #poststuff h3 { color: #555; }
				.wpex-custom-actions-admin-wrap #poststuff h3.active { color: #0095dd; }
				.wpex-custom-actions textarea { margin: 12px 0 3px; background: #f5f5f5; color: #000; padding: 15px; font-family: 'Verdana'; }
				.wpex-custom-actions p.submit { margin: 0 !important; padding: 0 !important; }
				.wpex-custom-actions label { color: #555; font-weight: bold; margin: 0; padding: 0; min-width: 80px; display: block; float: left; }
				.wpex-custom-actions .wpex-priority { background: #f5f5f5; color: #000; width: 60px; }
			</style>
			
		<?php }
		
	}

	new WPEX_User_Actions();

}