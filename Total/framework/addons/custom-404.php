<?php
/**
 * Custom 404 Page Design
 *
 * @package Total WordPress theme
 * @subpackage Framework
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'WPEX_404_PAGE' ) ) {

	class WPEX_404_PAGE {

		/**
		 * Start things up
		 */
		public function __construct() {
			add_action( 'admin_menu', array( 'WPEX_404_PAGE', 'add_page' ) );
			add_action( 'admin_init', array( 'WPEX_404_PAGE','register_page_options' ) );
			if ( wpex_get_mod( 'error_page_redirect', false ) ) {
				add_filter( 'template_redirect', array( 'WPEX_404_PAGE', 'redirect' ) );
			}
			if ( wpex_get_mod( 'error_page_content_id' ) ) {
				add_filter( 'wpex_vc_css_ids', array( 'WPEX_404_PAGE', 'vc_css_ids' ) );
			}
		}

		/**
		 * Add sub menu page for the custom CSS input
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_page
		 */
		public static function add_page() {
			add_submenu_page(
				WPEX_THEME_PANEL_SLUG,
				esc_html__( 'Custom 404', 'total' ),
				esc_html__( 'Custom 404', 'total' ),
				'administrator',
				WPEX_THEME_PANEL_SLUG .'-404',
				array( 'WPEX_404_PAGE', 'create_admin_page' )
			);
		}

		/**
		 * Function that will register admin page options.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_setting
		 * @link http://codex.wordpress.org/Function_Reference/add_settings_section
		 * @link http://codex.wordpress.org/Function_Reference/add_settings_field
		 */
		public static function register_page_options() {

			// Register settings
			register_setting( 'wpex_error_page', 'error_page', array( 'WPEX_404_PAGE', 'sanitize' ) );

			// Add main section to our options page
			add_settings_section( 'wpex_error_page_main', false, array( 'WPEX_404_PAGE', 'section_main_callback' ), 'wpex-custom-error-page-admin' );

			// Redirect field
			add_settings_field(
				'redirect',
				esc_html__( 'Redirect 404\'s', 'total' ),
				array( 'WPEX_404_PAGE', 'redirect_field_callback' ),
				'wpex-custom-error-page-admin',
				'wpex_error_page_main'
			);

			// Custom Page ID
			add_settings_field(
				'error_page_id',
				esc_html__( 'Custom 404 Redirect', 'total' ),
				array( 'WPEX_404_PAGE', 'content_id_field_callback' ),
				'wpex-custom-error-page-admin',
				'wpex_error_page_main'
			);

			// Title field
			add_settings_field(
				'error_page_title',
				esc_html__( '404 Page Title', 'total' ),
				array( 'WPEX_404_PAGE', 'title_field_callback' ),
				'wpex-custom-error-page-admin',
				'wpex_error_page_main'
			);

			// Content field
			add_settings_field(
				'error_page_text',
				esc_html__( '404 Page Content', 'total' ),
				array( 'WPEX_404_PAGE', 'content_field_callback' ),
				'wpex-custom-error-page-admin',
				'wpex_error_page_main'
			);

		}

		/**
		 * Sanitization callback
		 */
		public static function sanitize( $options ) {

			// Set theme mods
			if ( isset( $options['redirect'] ) ) {
				set_theme_mod( 'error_page_redirect', 1 );
			} else {
				remove_theme_mod( 'error_page_redirect' );
			}

			if ( ! empty( $options['title'] ) ) {
				set_theme_mod( 'error_page_title', $options['title'] );
			} else {
				remove_theme_mod( 'error_page_title' );
			}

			if ( ! empty( $options['text'] ) ) {
				set_theme_mod( 'error_page_text', $options['text'] );
			} else {
				remove_theme_mod( 'error_page_text' );
			}

			if ( ! empty( $options['content_id'] ) ) {
				set_theme_mod( 'error_page_content_id', $options['content_id'] );
			} else {
				remove_theme_mod( 'error_page_content_id' );
			}

			// Set options to nothing since we are storing in the theme mods
			$options = '';
			return $options;
		}

		/**
		 * Main Settings section callback
		 */
		public static function section_main_callback( $options ) {
			// Leave blank
		}

		/**
		 * Fields callback functions
		 */

		// Redirect field
		public static function redirect_field_callback() {
			$val = wpex_get_mod( 'error_page_redirect' );
			echo '<input type="checkbox" name="error_page[redirect]" id="error-page-redirect" value="'. esc_attr( $val ) .'" '. checked( $val, true, false ) .'> ';
			echo '<span class="description">'. esc_html__( 'Automatically 301 redirect all 404 errors to your homepage.', 'total' ) .'</span>';
		}

		// Custom Error Page ID
		public static function content_id_field_callback() {
			wp_dropdown_pages( array(
				'echo'             => true,
				'selected'         => wpex_get_mod( 'error_page_content_id' ),
				'name'             => 'error_page[content_id]',
				'id'               => 'error-page-content-id',
				'show_option_none' => esc_html__( 'None', 'total' ),
			) ); ?>
			<br />
			<p class="description"><?php esc_html_e( 'Select a custom page if you want to use the Visual Composer to create your custom 404 page.', 'total' ) ?></p>
		<?php }

		// Title field
		public static function title_field_callback() { ?>
			<input type="text" name="error_page[title]" id="error-page-title" value="<?php echo wpex_get_mod( 'error_page_title' ); ?>">
			<p class="description"><?php esc_html_e( 'Enter a custom title for your 404 page.', 'total' ) ?></p>
		<?php }

		// Content field
		public static function content_field_callback() {
			wp_editor( wpex_get_mod( 'error_page_text' ), 'error_page_text', array(
				'textarea_name' => 'error_page[text]'
			) );
		}

		/**
		 * Settings page output
		 */
		public static function create_admin_page() { ?>
			<div class="wrap">
				<h2 style="padding-right:0;">
					<?php esc_html_e( 'Custom 404', 'total' ); ?>
				</h2>
				<form method="post" action="options.php">
					<?php settings_fields( 'wpex_error_page' ); ?>
					<?php do_settings_sections( 'wpex-custom-error-page-admin' ); ?>
					<?php submit_button(); ?>
				</form>
				<script>
					( function( $ ) {
						"use strict";

						// Hide/Show fields
						var	$redirectErrorPage = $( '#error-page-redirect' ),
							$pageIdSelect      = $( '#error-page-content-id' ),
							$pageIdVal         = $pageIdSelect.val(),
							$fieldsTohide      = $( '#error-page-title, #wp-error_page_text-wrap' );

						// Get tr of field to hide
						var $elementsTohide = $fieldsTohide.closest( 'tr' );

						// Check initial val
						if ( '1' == $redirectErrorPage.val() ) {
							$pageIdSelect.closest( 'tr' ).hide();
						}
						if ( $pageIdVal || '1' == $redirectErrorPage.val() ) {
							$elementsTohide.hide();
						}

						// Check on change
						$( $redirectErrorPage ).change(function () {
							if ( $(this ).is( ":checked" ) ) {
								$pageIdSelect.closest( 'tr' ).hide();
								$elementsTohide.hide();
							} else {
								$pageIdSelect.closest( 'tr' ).show();
								if ( ! $pageIdSelect.val() ) {
									$elementsTohide.show();
								}
							}
						} );
						$( $pageIdSelect ).change(function () {
							var $selected = $( this ).val();
							if ( $selected !== '' ) {
								$elementsTohide.hide();
							} else {
								$elementsTohide.show();
							}
						});

					} ) ( jQuery );
				</script>
			</div><!-- .wrap -->
		<?php }

		/**
		 * Redirect all pages to the under cronstruction page if user is not logged in
		 *
		 * @link  http://codex.wordpress.org/Plugin_API/Action_Reference/template_redirect
		 * @since 1.6.0
		 */
		public static function redirect() {
			if ( is_404() ) {
				wp_redirect( home_url( '/' ), 301 );
				exit();
			}
		}

		/**
		 * Custom VC CSS for 404 custom page design
		 */
		public static function vc_css_ids( $ids ) {
			if ( is_404() ) {
				$ids[] = wpex_global_obj( 'post_id' );
			}
			return $ids;
		}
		
	}

	new WPEX_404_PAGE();

}