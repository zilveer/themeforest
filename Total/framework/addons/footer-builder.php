<?php
/**
 * Footer Builder Addon
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
class WPEX_Footer_Builder {
	private $is_admin;

	/**
	 * Start things up
	 *
	 * @since 2.0.0
	 */
	public function __construct() {

		$this->is_admin = is_admin();

		if ( $this->is_admin ) {

			// Add admin page
			add_action( 'admin_menu', array( 'WPEX_Footer_Builder', 'add_page' ), 20 );

			// Admin scripts
			add_action( 'admin_enqueue_scripts',array( 'WPEX_Footer_Builder', 'scripts' ) );

			// Register admin options
			add_action( 'admin_init', array( 'WPEX_Footer_Builder', 'register_page_options' ) );

		}

		// Run actions and filters if footer_builder ID is defined
		if ( self::footer_builder_id() ) {

			// Do not register footer sidebars
			add_filter( 'wpex_register_footer_sidebars', '__return_false' );

			// Alter the footer on init
			add_action( 'wp', array( 'WPEX_Footer_Builder', 'alter_footer' ) );

			// Include ID for Visual Composer custom CSS
			add_filter( 'wpex_vc_css_ids', array( 'WPEX_Footer_Builder', 'wpex_vc_css_ids' ) );

			// Remove footer customizer settings
			add_filter( 'wpex_customizer_panels', array( 'WPEX_Footer_Builder', 'remove_customizer_footer_panel' ) );

			// Alter template for live editing
			if ( wpex_vc_is_inline() ) {
				add_filter( 'template_include', array( 'WPEX_Footer_Builder', 'builder_template' ), 9999 );
			}

			// Redirect live url for seo
			elseif ( ! $this->is_admin ) {
				add_action( 'template_redirect', array( 'WPEX_Footer_Builder', 'redirect' ) );
			}

			// CSS
			add_filter( 'wpex_head_css', array( 'WPEX_Footer_Builder', 'wpex_head_css' ), 99 );

		}

	}

	/**
	 * Add sub menu page
	 *
	 * @since 3.5.0
	 */
	public static function footer_builder_id() {
		$pageid = intval( apply_filters( 'wpex_footer_builder_page_id', wpex_get_mod( 'footer_builder_page_id' ) ) );
		return $pageid ? wpex_parse_obj_id( $pageid, 'page' ) : '';
	}

	/**
	 * Add sub menu page
	 *
	 * @since 2.0.0
	 */
	public static function add_page() {
		add_submenu_page(
			WPEX_THEME_PANEL_SLUG,
			esc_html__( 'Footer Builder', 'total' ),
			esc_html__( 'Footer Builder', 'total' ),
			'administrator',
			WPEX_THEME_PANEL_SLUG .'-footer-builder',
			array( 'WPEX_Footer_Builder', 'create_admin_page' )
		);
	}

	/**
	 * Load scripts for admin
	 *
	 * @since 1.6.0
	 */
	public static function scripts( $hook ) {

		if ( WPEX_ADMIN_PANEL_HOOK_PREFIX . '-footer-builder' != $hook ) {
			return;
		}

		// Media Uploader
		wp_enqueue_media();

		wp_enqueue_script(
			'wpex-media-uploader-field',
			WPEX_FRAMEWORK_DIR_URI .'addons/assets/admin-fields/media-uploader.js',
			array( 'media-upload' ),
			false,
			true
		);

		// Color Picker
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'wpex-color-picker-field', WPEX_FRAMEWORK_DIR_URI .'addons/assets/admin-fields/color-picker.js', false, false, true );

		// CSS
		wp_enqueue_style( 'wpex-admin', WPEX_FRAMEWORK_DIR_URI .'addons/assets/admin-fields/admin.css' );

	}

	/**
	 * Function that will register admin page options
	 *
	 * @since 2.0.0
	 */
	public static function register_page_options() {

		// Register settings
		register_setting( 'wpex_footer_builder', 'footer_builder', array( 'WPEX_Footer_Builder', 'sanitize' ) );

		// Add main section to our options page
		add_settings_section( 'wpex_footer_builder_main', false, array( 'WPEX_Footer_Builder', 'section_main_callback' ), 'wpex-footer-builder-admin' );

		// Custom Page ID
		add_settings_field(
			'footer_builder_page_id',
			esc_html__( 'Footer Builder page', 'total' ),
			array( 'WPEX_Footer_Builder', 'content_id_field_callback' ),
			'wpex-footer-builder-admin',
			'wpex_footer_builder_main'
		);

		// Footer Bottom
		add_settings_field(
			'footer_builder_footer_bottom',
			esc_html__( 'Footer Bottom', 'total' ),
			array( 'WPEX_Footer_Builder', 'footer_builder_footer_bottom_field_callback' ),
			'wpex-footer-builder-admin',
			'wpex_footer_builder_main'
		);

		// Fixed Footer
		add_settings_field(
			'fixed_footer',
			esc_html__( 'Fixed Footer', 'total' ),
			array( 'WPEX_Footer_Builder', 'fixed_footer_field_callback' ),
			'wpex-footer-builder-admin',
			'wpex_footer_builder_main'
		);

		// Footer Reveal
		add_settings_field(
			'footer_reveal',
			esc_html__( 'Footer Reveal', 'total' ),
			array( 'WPEX_Footer_Builder', 'footer_reveal_field_callback' ),
			'wpex-footer-builder-admin',
			'wpex_footer_builder_main'
		);

		// Bg
		add_settings_field(
			'bg',
			esc_html__( 'Background Color', 'total' ),
			array( 'WPEX_Footer_Builder', 'bg_field_callback' ),
			'wpex-footer-builder-admin',
			'wpex_footer_builder_main'
		);

		// BG img
		add_settings_field(
			'bg_img',
			esc_html__( 'Background Image', 'total' ),
			array( 'WPEX_Footer_Builder', 'bg_img_field_callback' ),
			'wpex-footer-builder-admin',
			'wpex_footer_builder_main'
		);

		// BG img style
		add_settings_field(
			'bg_img_style',
			esc_html__( 'Background Image Style', 'total' ),
			array( 'WPEX_Footer_Builder', 'bg_img_style_field_callback' ),
			'wpex-footer-builder-admin',
			'wpex_footer_builder_main'
		);

	}

	/**
	 * Sanitization callback
	 *
	 * @since 2.0.0
	 */
	public static function sanitize( $options ) {

		// Update footer builder page ID
		if ( ! empty( $options['content_id'] ) ) {
			set_theme_mod( 'footer_builder_page_id', $options['content_id'] );
		} else {
			remove_theme_mod( 'footer_builder_page_id' );
		}

		// Footer Bottom - Disabled by default
		if ( empty( $options['footer_builder_footer_bottom'] ) ) {
			remove_theme_mod( 'footer_builder_footer_bottom' );
		} else {
			set_theme_mod( 'footer_builder_footer_bottom', 1 );
		}

		// Update fixed footer - Disabled by default
		if ( empty( $options['fixed_footer'] ) ) {
			remove_theme_mod( 'fixed_footer' );
		} else {
			set_theme_mod( 'fixed_footer', 1 );
		}

		// Update footer Reveal - Disabled by default
		if ( empty( $options['footer_reveal'] ) ) {
			remove_theme_mod( 'footer_reveal' );
		} else {
			set_theme_mod( 'footer_reveal', true );
		}

		// Update bg
		if ( empty( $options['bg'] ) ) {
			remove_theme_mod( 'footer_builder_bg' );
		} else {
			set_theme_mod( 'footer_builder_bg', $options['bg'] );
		}

		// Update bg img
		if ( empty( $options['bg_img'] ) ) {
			remove_theme_mod( 'footer_builder_bg_img' );
		} else {
			set_theme_mod( 'footer_builder_bg_img', $options['bg_img'] );
		}

		// Update bg img style
		if ( empty( $options['bg_img_style'] ) ) {
			remove_theme_mod( 'footer_builder_bg_img_style' );
		} else {
			set_theme_mod( 'footer_builder_bg_img_style', $options['bg_img_style'] );
		}

		// Dont save anything in the options table
		$options = '';
		return;
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

	// Footer Builder Page ID
	public static function content_id_field_callback() { ?>

		<?php
		// Get footer builder page ID
		$page_id = wpex_get_mod( 'footer_builder_page_id' ); ?>

		<?php
		// Display dropdown of pages
		wp_dropdown_pages( array(
			'echo'             => true,
			'selected'         => $page_id,
			'name'             => 'footer_builder[content_id]',
			'id'               => 'wpex-footer-builder-select',
			'show_option_none' => esc_html__( 'None - Display Widgetized Footer', 'total' ),
		) ); ?>
		<br />

		<p class="description"><?php esc_html_e( 'Select your custom page for your footer layout.', 'total' ) ?></p>

		<br />

		<div id="wpex-footer-builder-edit-links">

			<a href="<?php echo admin_url( 'post.php?post='. $page_id .'&action=edit' ); ?>" class="button" target="_blank">
				<?php esc_html_e( 'Backend Edit', 'total' ); ?>
			</a>

			<?php if ( WPEX_VC_ACTIVE ) { ?>

				<a href="<?php echo admin_url( 'post.php?vc_action=vc_inline&post_id='. $page_id .'&post_type=page' ); ?>" class="button" target="_blank">
					<?php esc_html_e( 'Frontend Edit', 'total' ); ?>
				</a>

			<?php } ?>

			<a href="<?php echo home_url( '/' ); ?>" class="button" target="_blank">
				<?php esc_html_e( 'Preview', 'total' ); ?>
			</a>

		</div>
		
	<?php }

	/**
	 * Footer Bottom Callback
	 *
	 * @since 2.0.0
	 */
	public static function footer_builder_footer_bottom_field_callback() {

		// Get theme mod val
		$val = wpex_get_mod( 'footer_builder_footer_bottom', false );
		$val = $val ? 'on' : false; ?>
		
			<input type="checkbox" name="footer_builder[footer_builder_footer_bottom]" id="wpex-footer-builder-footer-bottom" <?php checked( $val, 'on' ); ?>>
		<?php
	}

	/**
	 * Fixed Footer Callback
	 *
	 * @since 2.0.0
	 */
	public static function fixed_footer_field_callback() {

		// Get theme mod val
		$val = wpex_get_mod( 'fixed_footer', false );
		$val = $val ? 'on' : false; ?>
		
			<input type="checkbox" name="footer_builder[fixed_footer]" id="wpex-footer-builder-fixed" <?php checked( $val, 'on' ); ?>>
		<?php
	}

	/**
	 * Footer Reveal Callback
	 *
	 * @since 2.0.0
	 */
	public static function footer_reveal_field_callback() {

		// Get theme mod val
		$val = wpex_get_mod( 'footer_reveal' );
		$val = $val ? 'on' : false; ?>

			<input type="checkbox" name="footer_builder[footer_reveal]" id="wpex-footer-builder-reveal" <?php checked( $val, 'on' ); ?>>

		<?php
	}

	// Background Setting
	public static function bg_field_callback() {

		// Get background
		$bg = wpex_get_mod( 'footer_builder_bg' ); ?>

		<input id="background_color" type="text" name="footer_builder[bg]" value="<?php echo esc_attr( $bg ); ?>" class="wpex-color-field">

	<?php }

	// Background Image Setting
	public static function bg_img_field_callback() {

		// Get background
		$bg = wpex_get_mod( 'footer_builder_bg_img' ); ?>

		<div class="uploader">
			<input class="wpex-media-input" type="text" name="footer_builder[bg_img]" value="<?php echo esc_attr( $bg ); ?>">
			<input class="wpex-media-upload-button button-secondary" type="button" value="<?php esc_html_e( 'Upload', 'total' ); ?>" />
			<?php $preview = wpex_sanitize_data( $bg, 'image_src_from_mod' ); ?>
			<a href="#" class="wpex-media-remove button-secondary" style="display:none;"><span class="dashicons dashicons-no-alt" style="line-height: inherit;"></span></a>
			<div class="wpex-media-live-preview">
				<?php if ( $preview ) { ?>
					<img src="<?php echo esc_url( $preview ); ?>" alt="<?php esc_html_e( 'Preview Image', 'total' ); ?>" />
				<?php } ?>
			</div>
		</div>

	<?php }

	// Background Image Style Setting
	public static function bg_img_style_field_callback() {

		// Get setting
		$style = wpex_get_mod( 'footer_builder_bg_img_style' ); ?>

			<select name="footer_builder[bg_img_style]">
			<?php
			$bg_styles = wpex_get_bg_img_styles();
			foreach ( $bg_styles as $key => $val ) { ?>
				<option value="<?php echo esc_attr( $key ); ?>" <?php selected( $style, $key, true ); ?>>
					<?php echo strip_tags( $val ); ?>
				</option>
			<?php } ?>
		</select>

	<?php }

	/**
	 * Settings page output
	 *
	 * @since 2.0.0
	 */
	public static function create_admin_page() { ?>
		<div id="wpex-admin-page" class="wrap">
			<h2><?php esc_html_e( 'Footer Builder', 'total' ); ?> <a href="#" id="wpex-help-toggle" aria-hidden="true" style="text-decoration:none;"><span class="dashicons dashicons-editor-help"></span></a></h2>
			<div id="wpex-notice" class="notice notice-info" style="display:none;">
				<p style="font-size:1.1em;">
					<?php echo esc_html__( 'By default the footer consists of a simple widgetized area. For more complex layouts you can use the option below to select a page which will hold the content and layout for your site footer. Selecting a custom footer will remove all footer functions (footer widgets and footer customizer options) so you can create an entire footer using the Visual Composer and not load that extra functions.', 'total' ); ?>
				</p>
			</div>
			<form method="post" action="options.php">
				<?php settings_fields( 'wpex_footer_builder' ); ?>
				<?php do_settings_sections( 'wpex-footer-builder-admin' ); ?>
				<?php submit_button(); ?>
			</form>
			<script>
				( function( $ ) {
					"use strict";

					// Notice
					$( 'a#wpex-help-toggle' ).click( function() {
						$( '#wpex-notice' ).toggle();
						return false;
					} );

					// Hide/Show fields
					var	$select      = $( '#wpex-footer-builder-select' );
					var $tableTr     = $( '#wpex-admin-page table tr' );
					var $selectTr    = $select.parents( 'tr' );
					var $footerLinks = $( '#wpex-footer-builder-edit-links' );

					// Check initial val
					if ( ! $select.val() ) {
						$tableTr.not( $selectTr ).hide();
						$footerLinks.hide();
					}

					// Check on change
					$( $select ).change(function () {
						if ( ! $( this ).val() ) {
							$tableTr.not( $selectTr ).hide();
							$footerLinks.hide();
						} else {
							$tableTr.show();
							$footerLinks.show();
						}
					} );
				} ) ( jQuery );
			</script>
		</div><!-- .wrap -->
	<?php }

	/**
	 * Alters get template
	 *
	 * @since 3.5.0
	 */
	public static function builder_template( $template ) {
		if ( is_page( wpex_global_obj( 'footer_builder' ) ) ) {
			$new_template = locate_template( array( 'partials/footer/builder-template.php' ) );
			if ( $new_template ) {
				return $new_template;
			}
		}
		return $template;
	}

	/**
	 * Remove the footer and add custom footer if enabled
	 *
	 * @since 2.0.0
	 */
	public static function alter_footer() {

		// Remove theme footer
		remove_action( 'wpex_hook_wrap_bottom', 'wpex_footer', 10 );

		// Remove all actions in footer hooks
		$hooks = wpex_theme_hooks();
		if ( isset( $hooks['footer']['hooks'] ) ) {
			foreach( $hooks['footer']['hooks'] as $hook ) {
				remove_all_actions( $hook, false );
			}
		}

		// Re add callout
		add_action( 'wpex_hook_footer_before', 'wpex_footer_callout' );

		// Re-add footer bottom if enabled
		if ( wpex_get_mod( 'footer_builder_footer_bottom', false ) ) {
			add_action( 'wpex_hook_footer_after', 'wpex_footer_bottom' );
		}

		// Re add reveal if enabled
		if ( get_theme_mod( 'footer_reveal' ) ) {
			add_action( 'wpex_hook_footer_before', 'wpex_footer_reveal_open', 0 );
			add_action( 'wpex_hook_footer_after', 'wpex_footer_reveal_close', 99 );
		}

		// Add builder footer
		add_action( 'wpex_hook_wrap_bottom', array( 'WPEX_Footer_Builder', 'get_part' ), 10 );

	}

	/**
	 * Add footer builder to array of ID's with CSS to load site-wide
	 *
	 * @since 2.0.0
	 */
	public static function wpex_vc_css_ids( $ids ) {
		$ids[] = wpex_global_obj( 'footer_builder' );
		return $ids;
	}

	/**
	 * Remove the footer and add custom footer if enabled
	 *
	 * @since 2.0.0
	 */
	public static function remove_customizer_footer_panel( $panels ) {
		unset( $panels['footer_widgets'] );
		if ( ! wpex_get_mod( 'footer_builder_footer_bottom', false ) ) {
			unset( $panels['footer_bottom'] );
		}
		return $panels;
	}

	/**
	 * Gets the footer builder template part if the footer is enabled
	 *
	 * @since 2.0.0
	 */
	public static function get_part() {
		if ( wpex_global_obj( 'has_footer' ) ) {
			get_template_part( 'partials/footer/footer-builder' );
		}
	}

	/**
	 * Redirect page to prevent issues with live site.
	 *
	 * @since 3.5.0
	 */
	public static function redirect() {
		if ( is_page( wpex_global_obj( 'footer_builder' ) ) ) {
			wp_redirect( home_url( '/' ), 301 );
		}
	}

	/**
	 * Custom CSS for footer builder
	 *
	 * @since 3.5.0
	 */
	public static function wpex_head_css( $css ) {
		$add_css = '';
		if ( $bg = wpex_get_mod( 'footer_builder_bg' ) ) {
			$add_css .= 'background-color:'. $bg .';';
		}
		if ( $bg_img = wpex_sanitize_data( wpex_get_mod( 'footer_builder_bg_img' ), 'image_src_from_mod' ) ) {
			$add_css .= 'background-image:url('. $bg_img .');';
		}
		if ( $bg_img && $bg_img_style = wpex_sanitize_data( wpex_get_mod( 'footer_builder_bg_img_style' ), 'background_style_css' ) ) {
			$add_css .= $bg_img_style;
		}
		if ( $add_css ) {
			$add_css = '#footer-builder{ '. $add_css .'}';
			$css .= '/*FOOTER BUILDER*/'. $add_css;
		}
		return $css;
	}


}
new WPEX_Footer_Builder();