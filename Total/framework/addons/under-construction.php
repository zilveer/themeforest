<?php
/**
 * Under Construction Addon
 *
 * @package Total WordPress Theme
 * @subpackage Framework
 * @version 3.5.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
class WPEX_Under_Construction {

	/**
	 * Start things up
	 *
	 * @since 2.0.0
	 */
	public function __construct() {
		add_action( 'admin_menu', array( 'WPEX_Under_Construction', 'add_page' ) );
		add_action( 'admin_init', array( 'WPEX_Under_Construction','register_page_options' ) );
		if ( ! is_admin() ) {
			add_filter( 'template_redirect', array( 'WPEX_Under_Construction', 'redirect' ) );
		}
	}

	/**
	 * Add sub menu page for the custom CSS input
	 *
	 * @since 2.0.0
	 */
	public static function add_page() {
		add_submenu_page(
			WPEX_THEME_PANEL_SLUG,
			esc_html__( 'Under Construction', 'total' ),
			esc_html__( 'Under Construction', 'total' ),
			'administrator',
			WPEX_THEME_PANEL_SLUG . '-under-construction',
			array( 'WPEX_Under_Construction', 'create_admin_page' )
		);
	}

	/**
	 * Function that will register admin page options.
	 *
	 * @since 2.0.0
	 */
	public static function register_page_options() {

		// Register settings
		register_setting( 'wpex_under_construction', 'under_construction', array( 'WPEX_Under_Construction', 'sanitize' ) );

		// Add main section to our options page
		add_settings_section( 'wpex_under_construction_main', false, array( 'WPEX_Under_Construction', 'section_main_callback' ), 'wpex-under-construction-admin' );

		// Redirect field
		add_settings_field(
			'under_construction',
			esc_html__( 'Enable Under Constuction', 'total' ),
			array( 'WPEX_Under_Construction', 'redirect_field_callback' ),
			'wpex-under-construction-admin',
			'wpex_under_construction_main'
		);

		// Custom Page ID
		add_settings_field(
			'under_construction_page_id',
			esc_html__( 'Under Construction page', 'total' ),
			array( 'WPEX_Under_Construction', 'content_id_field_callback' ),
			'wpex-under-construction-admin',
			'wpex_under_construction_main'
		);

	}

	/**
	 * Sanitization callback
	 *
	 * @since 2.0.0
	 */
	public static function sanitize( $options ) {

		// Set theme mods
		if ( isset ( $options['enable'] ) ) {
			set_theme_mod( 'under_construction', 1 ); // must be set to 1, bool won't work
		} else {
			remove_theme_mod( 'under_construction' );
		}

		if ( isset( $options['content_id'] ) ) {
			set_theme_mod( 'under_construction_page_id', $options['content_id'] );
		}

		// Set options to nothing since we are storing in the theme mods
		$options = '';
		return $options;
	}

	/**
	 * Main Settings section callback
	 *
	 * @since 2.0.0
	 */
	public static function section_main_callback( $options ) {
		// Leave blank
	}

	/**
	 * Fields callback functions
	 *
	 * @since 2.0.0
	 */

	// Enable admin field
	public static function redirect_field_callback() {
		$val    = wpex_get_mod( 'under_construction', false );
		$output = '<input type="checkbox" name="under_construction[enable]" value="'. esc_attr( $val ) .'" '. checked( $val, true, false ) .' id="wpex-under-construction-enable"> ';
		$output .= '<span class="description">'. esc_html__( 'Enable the Under Construction function.', 'total' ) .'</span>';
		echo $output;
	}

	// Page ID admin field
	public static function content_id_field_callback() { ?>

		<?php
		// Get construction page id
		$page_id = wpex_get_mod( 'under_construction_page_id' ); ?>

		<p><?php
		// Display dropdown of pages to select from
		wp_dropdown_pages( array(
			'echo'             => true,
			'id'               => 'wpex-under-construction-page-select',
			'selected'         => $page_id,
			'name'             => 'under_construction[content_id]',
			'show_option_none' => esc_html__( 'None', 'total' ),
			'exclude'          => get_option( 'page_for_posts' ),
		) ); ?></p>

		<p class="description"><?php esc_html_e( 'Select your custom page for your under construction display. Every page and post will redirect to your selected page for non-logged in users.', 'total' ) ?></p>

		<?php
		// Display edit and preview buttons
		if ( $page_id ) { ?>

			<p style="margin:20px 0 0;">

			<a href="<?php echo admin_url( 'post.php?post='. $page_id .'&action=edit' ); ?>" class="button" target="_blank">
                <?php esc_html_e( 'Backend Edit', 'total' ); ?>
            </a>

            <?php if ( WPEX_VC_ACTIVE ) { ?>
                <a href="<?php echo admin_url( 'post.php?vc_action=vc_inline&post_id='. $page_id .'&post_type=page' ); ?>" class="button" target="_blank">
                    <?php esc_html_e( 'Frontend Edit', 'total' ); ?>
                </a>
            <?php } ?>

            <a href="<?php echo get_permalink( $page_id ); ?>" class="button" target="_blank">
                <?php esc_html_e( 'Preview', 'total' ); ?>
            </a>

		<?php } ?>

	<?php }

	/**
	 * Settings page output
	 *
	 * @since 2.0.0
	 */
	public static function create_admin_page() { ?>

		<div class="wrap">
			<h2><?php esc_html_e( 'Under Construction', 'total' ); ?></h2>
			<form method="post" action="options.php">
				<?php settings_fields( 'wpex_under_construction' ); ?>
				<?php do_settings_sections( 'wpex-under-construction-admin' ); ?>
				<?php submit_button(); ?>
			</form>
			<script>
				( function( $ ) {
					"use strict";

					// Hide/Show fields
					var	$check  = $( '#wpex-under-construction-enable' ),
						$select = $( '#wpex-under-construction-page-select' );

					// Check initial val
					if ( ! $check.is( ":checked" ) ) {
						$select.closest( 'tr' ).hide();
					}

					// Check on change
					$( $check ).change(function () {
						if ( $( this ).is( ":checked" ) ) {
							$select.closest( 'tr' ).show();
						} else {
							$select.closest( 'tr' ).hide();
						}
					} );

				} ) ( jQuery );
			</script>
		</div><!-- .wrap -->

	<?php }

	/**
	 * Redirect all pages to the under cronstruction page if user is not logged in
	 *
	 * @since 1.6.0
	 */
	public static function redirect() {

		// Make sure under construction is enabled and a page id is defined
		if ( wpex_get_mod( 'under_construction' ) ) {

			// Get ID
			$page_id = intval( wpex_parse_obj_id( wpex_get_mod( 'under_construction_page_id' ), 'page' ) );

			// Return if ID not defined
			if ( ! $page_id ) {
				return;
			}

			// Return if under construction is the same as posts page because it creates an endless loop
			if ( $page_id == get_option( 'page_for_posts' ) ) {
				return;
			}

			// If user is not logged in redirect them
			if ( ! is_user_logged_in() ) {

				// Get permalink
				$permalink = get_permalink( $page_id );

				// Redirect to under construction page
				if ( $permalink && ! is_page( $page_id ) ) {
					wp_redirect( $permalink, 302 );
					exit();
				}

			}
		}

	}

}
new WPEX_Under_Construction();